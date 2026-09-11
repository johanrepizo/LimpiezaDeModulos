<?php
$titulo = 'Programas y Fichas';
if (session_status() === PHP_SESSION_NONE) session_start();
if (!isset($_SESSION['usuario']) || (int)$_SESSION['usuario']['rol'] !== 1) {
    header("Location: ../usuarios/login.php"); exit;
}
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../models/Programa.php';
require_once __DIR__ . '/../../models/Ficha.php';

$db        = (new Database())->conectar();
$modelProg = new Programa($db);
$modelFich = new Ficha($db);

$alert = $_SESSION['alert'] ?? null;
unset($_SESSION['alert']);

// Nivel de navegación: base | programa | ficha
$vistaPrograma = (int)($_GET['programa'] ?? 0);
$vistaFicha    = (int)($_GET['ficha']    ?? 0);

// Datos según nivel
$programas    = $modelProg->obtenerTodos();
$programaAct  = $vistaPrograma ? $modelProg->obtenerPorId($vistaPrograma) : null;
$fichasDelProg = [];
$fichaAct      = null;

if ($vistaPrograma) {
    // Fichas del programa seleccionado
    $stmtF = $db->prepare(
        "SELECT f.*,
                ANY_VALUE(v.nombres)   AS vocero_nombres,
                ANY_VALUE(v.apellidos) AS vocero_apellidos,
                COUNT(DISTINCT a.id_aprendiz) AS total_aprendices
         FROM fichas f
         LEFT JOIN voceros   v ON v.id_ficha  = f.id_ficha AND v.activo = 1
         LEFT JOIN aprendices a ON a.id_ficha = f.id_ficha AND a.activo = 1
         WHERE f.id_programa = :prog AND f.activo = 1
         GROUP BY f.id_ficha
         ORDER BY f.numero_ficha"
    );
    $stmtF->execute([':prog' => $vistaPrograma]);
    $fichasDelProg = $stmtF->fetchAll(PDO::FETCH_ASSOC);
}

if ($vistaFicha) {
    // Obtener ficha con vocero incluido
    $stmtFichaAct = $db->prepare(
        "SELECT f.*,
                p.nombre AS nombre_programa,
                ANY_VALUE(v.nombres)   AS vocero_nombres,
                ANY_VALUE(v.apellidos) AS vocero_apellidos
         FROM fichas f
         JOIN programas p ON p.id_programa = f.id_programa
         LEFT JOIN voceros v ON v.id_ficha = f.id_ficha AND v.activo = 1
         WHERE f.id_ficha = :id
         GROUP BY f.id_ficha
         LIMIT 1"
    );
    $stmtFichaAct->execute([':id' => $vistaFicha]);
    $fichaAct = $stmtFichaAct->fetch(PDO::FETCH_ASSOC);

    if ($fichaAct) {
        $vistaPrograma = (int)$fichaAct['id_programa'];
        $programaAct   = $modelProg->obtenerPorId($vistaPrograma);
        // Fichas del programa (para poder volver)
        $stmtF2 = $db->prepare(
            "SELECT f.*,
                    ANY_VALUE(v.nombres)   AS vocero_nombres,
                    ANY_VALUE(v.apellidos) AS vocero_apellidos,
                    COUNT(DISTINCT a.id_aprendiz) AS total_aprendices
             FROM fichas f
             LEFT JOIN voceros   v ON v.id_ficha  = f.id_ficha AND v.activo = 1
             LEFT JOIN aprendices a ON a.id_ficha = f.id_ficha AND a.activo = 1
             WHERE f.id_programa = :prog AND f.activo = 1
             GROUP BY f.id_ficha
             ORDER BY f.numero_ficha"
        );
        $stmtF2->execute([':prog' => $vistaPrograma]);
        $fichasDelProg = $stmtF2->fetchAll(PDO::FETCH_ASSOC);
        // NO cargamos evidencias aquí — están en admin_evidencias.php
    }
}

// Totales generales para nivel raíz
$totalProgramas = count($programas);
$totalFichas    = array_sum(array_column($programas, 'total_fichas'));

require_once __DIR__ . '/../layouts/header.php';
?>

<!-- ══ CABECERA + BREADCRUMB ════════════════════════════════════════════════ -->
<div class="d-flex justify-content-between align-items-start mb-4 flex-wrap gap-3">
    <div>
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-1">
            <ol class="breadcrumb mb-0" style="font-size:.82rem;">
                <li class="breadcrumb-item">
                    <a href="admin_programas.php" class="text-success text-decoration-none fw-semibold">
                        <i class="fas fa-graduation-cap me-1"></i>Programas
                    </a>
                </li>
                <?php if ($programaAct): ?>
                <li class="breadcrumb-item">
                    <?php if ($fichaAct): ?>
                        <a href="admin_programas.php?programa=<?= $vistaPrograma ?>"
                           class="text-success text-decoration-none">
                            <?= htmlspecialchars($programaAct['nombre']) ?>
                        </a>
                    <?php else: ?>
                        <span class="text-dark"><?= htmlspecialchars($programaAct['nombre']) ?></span>
                    <?php endif; ?>
                </li>
                <?php endif; ?>
                <?php if ($fichaAct): ?>
                <li class="breadcrumb-item active">
                    Ficha <strong><?= htmlspecialchars($fichaAct['numero_ficha']) ?></strong>
                    <span class="ms-1 text-muted">— Evidencias</span>
                </li>
                <?php endif; ?>
            </ol>
        </nav>

        <h4 class="fw-bold mb-0">
            <?php if ($fichaAct): ?>
                <i class="fas fa-images text-success me-2"></i>
                Evidencias — Ficha <?= htmlspecialchars($fichaAct['numero_ficha']) ?>
            <?php elseif ($programaAct): ?>
                <i class="fas fa-id-card text-success me-2"></i>
                Fichas de <?= htmlspecialchars($programaAct['nombre']) ?>
            <?php else: ?>
                <i class="fas fa-graduation-cap text-success me-2"></i>
                Programas de Formación
            <?php endif; ?>
        </h4>
        <p class="text-muted small mb-0">
            <?php if ($fichaAct): ?>
                Evidencias fotográficas registradas en esta ficha
            <?php elseif ($programaAct): ?>
                Selecciona una ficha para ver sus evidencias
            <?php else: ?>
                Selecciona un programa para explorar sus fichas y evidencias
            <?php endif; ?>
        </p>
    </div>

    <!-- Botón acción principal según nivel -->
    <?php if (!$vistaPrograma && !$vistaFicha): ?>
    <button class="btn btn-success btn-sm fw-semibold" data-bs-toggle="modal" data-bs-target="#modalPrograma">
        <i class="fas fa-plus me-1"></i>Nuevo Programa
    </button>
    <?php endif; ?>
</div>

<!-- ══ NIVEL 0: STATS + CARDS DE PROGRAMAS ══════════════════════════════════ -->
<?php if (!$vistaPrograma && !$vistaFicha): ?>

<!-- Stats rápidos -->
<div class="row g-3 mb-4">
    <div class="col-sm-6">
        <div class="stat-card bg-white">
            <div class="d-flex align-items-center gap-3">
                <div class="stat-icon" style="background:rgba(57,169,0,.12);color:#39a900;">
                    <i class="fas fa-graduation-cap"></i>
                </div>
                <div>
                    <div class="fs-4 fw-bold"><?= $totalProgramas ?></div>
                    <div class="text-muted small">Programas activos</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="stat-card bg-white">
            <div class="d-flex align-items-center gap-3">
                <div class="stat-icon" style="background:rgba(37,99,235,.1);color:#2563eb;">
                    <i class="fas fa-id-card"></i>
                </div>
                <div>
                    <div class="fs-4 fw-bold"><?= $totalFichas ?></div>
                    <div class="text-muted small">Fichas registradas</div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Buscador -->
<div class="mb-3">
    <div class="input-group input-group-sm" style="max-width:340px;">
        <span class="input-group-text bg-white"><i class="fas fa-search text-muted"></i></span>
        <input type="text" id="buscPrograma" class="form-control border-start-0"
               placeholder="Buscar programa…">
    </div>
</div>

<!-- Grid de programas -->
<div class="row g-3" id="gridProgramas">
    <?php foreach ($programas as $p): ?>
    <div class="col-md-6 col-lg-4 prog-item">
        <div class="card border-0 shadow-sm h-100 prog-card"
             style="border-radius:12px; cursor:pointer; transition:all .2s;"
             onclick="location.href='admin_programas.php?programa=<?= $p['id_programa'] ?>'">
            <div class="card-body p-4">
                <div class="d-flex align-items-start justify-content-between mb-3">
                    <div class="prog-icon"
                         style="width:44px;height:44px;border-radius:10px;
                                background:rgba(57,169,0,.12);color:#39a900;
                                display:flex;align-items:center;justify-content:center;font-size:1.2rem;">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                    <div class="d-flex gap-1">
                        <span class="badge <?= $p['activo'] ? 'bg-success' : 'bg-secondary' ?>">
                            <?= $p['activo'] ? 'Activo' : 'Inactivo' ?>
                        </span>
                    </div>
                </div>
                <h6 class="fw-bold mb-1" style="font-size:.9rem; line-height:1.3;">
                    <?= htmlspecialchars($p['nombre']) ?>
                </h6>
                <?php if ($p['nivel']): ?>
                <span class="badge bg-light text-dark border mb-2" style="font-size:.72rem;">
                    <?= htmlspecialchars($p['nivel']) ?>
                </span>
                <?php endif; ?>
                <div class="d-flex align-items-center gap-3 mt-3 pt-3"
                     style="border-top:1px solid #e5e7eb;">
                    <div class="text-center">
                        <div class="fw-bold text-success"><?= (int)$p['total_fichas'] ?></div>
                        <div class="text-muted" style="font-size:.72rem;">Fichas</div>
                    </div>
                    <div class="ms-auto d-flex gap-1" onclick="event.stopPropagation()">
                        <button class="btn btn-sm btn-outline-primary"
                                onclick='editarPrograma(<?= json_encode($p) ?>)' title="Editar">
                            <i class="fas fa-pen"></i>
                        </button>
                        <form action="../../controllers/AdminController.php" method="POST" class="d-inline">
                            <input type="hidden" name="accion"      value="eliminar_programa">
                            <input type="hidden" name="id_programa" value="<?= $p['id_programa'] ?>">
                            <button type="submit" class="btn btn-sm btn-outline-danger"
                                    onclick="return confirm('¿Eliminar este programa?')" title="Eliminar">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                        <a href="admin_programas.php?programa=<?= $p['id_programa'] ?>"
                           class="btn btn-sm btn-outline-success" title="Ver fichas">
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
    <?php if (empty($programas)): ?>
    <div class="col-12">
        <div class="card border-0 shadow-sm text-center py-5 text-muted">
            <i class="fas fa-graduation-cap fa-3x mb-3 opacity-25 d-block"></i>
            No hay programas registrados.
        </div>
    </div>
    <?php endif; ?>
</div>
<?php endif; ?>

<!-- ══ NIVEL 1: FICHAS DEL PROGRAMA ═════════════════════════════════════════ -->
<?php if ($vistaPrograma && !$vistaFicha): ?>

<div class="row g-3 mb-4">
    <div class="col-sm-4">
        <div class="stat-card bg-white">
            <div class="d-flex align-items-center gap-3">
                <div class="stat-icon" style="background:rgba(37,99,235,.1);color:#2563eb;">
                    <i class="fas fa-id-card"></i>
                </div>
                <div>
                    <div class="fs-4 fw-bold"><?= count($fichasDelProg) ?></div>
                    <div class="text-muted small">Fichas en este programa</div>
                </div>
            </div>
        </div>
    </div>
    <?php
    $aprendicesTotal = array_sum(array_column($fichasDelProg, 'total_aprendices'));
    $conVocero = count(array_filter($fichasDelProg, fn($f) => !empty($f['vocero_nombres'])));
    ?>
    <div class="col-sm-4">
        <div class="stat-card bg-white">
            <div class="d-flex align-items-center gap-3">
                <div class="stat-icon" style="background:rgba(57,169,0,.12);color:#39a900;">
                    <i class="fas fa-users"></i>
                </div>
                <div>
                    <div class="fs-4 fw-bold"><?= $aprendicesTotal ?></div>
                    <div class="text-muted small">Aprendices en el programa</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="stat-card bg-white">
            <div class="d-flex align-items-center gap-3">
                <div class="stat-icon" style="background:rgba(234,179,8,.1);color:#d97706;">
                    <i class="fas fa-user-tie"></i>
                </div>
                <div>
                    <div class="fs-4 fw-bold"><?= $conVocero ?>/<?= count($fichasDelProg) ?></div>
                    <div class="text-muted small">Fichas con vocero asignado</div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card shadow-sm border-0">
    <div class="card-header bg-white border-0 py-3 d-flex justify-content-between align-items-center">
        <h6 class="fw-bold mb-0">
            <i class="fas fa-id-card text-success me-2"></i>
            Fichas — <?= htmlspecialchars($programaAct['nombre']) ?>
        </h6>
        <span class="badge bg-success"><?= count($fichasDelProg) ?> ficha(s)</span>
    </div>
    <div class="card-body p-0">
        <?php if (empty($fichasDelProg)): ?>
        <div class="text-center py-5 text-muted">
            <i class="fas fa-id-card fa-2x mb-2 opacity-25 d-block"></i>
            <span class="small">No hay fichas registradas en este programa.</span>
        </div>
        <?php else: ?>
        <div class="table-responsive">
            <table class="table tabla-limpia align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>N° Ficha</th>
                        <th>Jornada</th>
                        <th>Aprendices</th>
                        <th>Vocero</th>
                        <th>Estado</th>
                        <th class="text-center">Evidencias</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($fichasDelProg as $f):
                    // Contar evidencias de esta ficha
                    $stmtEvC = $db->prepare(
                        "SELECT COUNT(*) FROM evidencias e
                         JOIN grupos g ON g.id_grupo = e.id_grupo
                         JOIN asignaciones a ON a.id_asignacion = g.id_asignacion
                         WHERE a.id_ficha = :fic"
                    );
                    $stmtEvC->execute([':fic' => $f['id_ficha']]);
                    $cntEv = (int)$stmtEvC->fetchColumn();
                ?>
                <tr style="cursor:pointer;" onclick="location.href='admin_programas.php?ficha=<?= $f['id_ficha'] ?>'">
                    <td>
                        <span class="fw-bold text-success font-monospace">
                            <?= htmlspecialchars($f['numero_ficha']) ?>
                        </span>
                    </td>
                    <td>
                        <span class="badge bg-light text-dark border">
                            <?= htmlspecialchars($f['jornada']) ?>
                        </span>
                    </td>
                    <td class="small"><?= (int)$f['total_aprendices'] ?></td>
                    <td class="small">
                        <?php if ($f['vocero_nombres']): ?>
                            <i class="fas fa-user-tie text-success me-1" style="font-size:.75rem;"></i>
                            <?= htmlspecialchars($f['vocero_nombres'] . ' ' . $f['vocero_apellidos']) ?>
                        <?php else: ?>
                            <span class="text-muted">Sin asignar</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <span class="badge <?= $f['activo'] ? 'bg-success' : 'bg-secondary' ?>">
                            <?= $f['activo'] ? 'Activa' : 'Inactiva' ?>
                        </span>
                    </td>
                    <td class="text-center">
                        <?php if ($cntEv > 0): ?>
                            <span class="badge bg-success"><?= $cntEv ?></span>
                        <?php else: ?>
                            <span class="text-muted small">—</span>
                        <?php endif; ?>
                    </td>
                    <td class="text-center" onclick="event.stopPropagation()">
                        <a href="admin_programas.php?ficha=<?= $f['id_ficha'] ?>"
                           class="btn btn-sm btn-success fw-semibold">
                            <i class="fas fa-images me-1"></i>Ver evidencias
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php endif; ?>
    </div>
</div>
<?php endif; ?>

<!-- ══ NIVEL 2: INFO DE LA FICHA ════════════════════════════════════════════ -->
<?php if ($vistaFicha && $fichaAct): ?>
<?php
$stmtGC = $db->prepare("SELECT COUNT(*) FROM grupos g JOIN asignaciones a ON a.id_asignacion = g.id_asignacion WHERE a.id_ficha = :fic");
$stmtGC->execute([':fic' => $vistaFicha]);
$cntGrupos = (int)$stmtGC->fetchColumn();
$stmtAp2 = $db->prepare("SELECT COUNT(*) FROM aprendices WHERE id_ficha = :fic AND activo=1");
$stmtAp2->execute([':fic' => $vistaFicha]);
$cntAp = (int)$stmtAp2->fetchColumn();
$voceroNombre = trim(($fichaAct['vocero_nombres'] ?? '') . ' ' . ($fichaAct['vocero_apellidos'] ?? ''));
?>
<div class="row g-3 mb-4">
    <div class="col-sm-4">
        <div class="stat-card bg-white">
            <div class="d-flex align-items-center gap-3">
                <div class="stat-icon" style="background:rgba(57,169,0,.12);color:#39a900;"><i class="fas fa-users"></i></div>
                <div><div class="fs-4 fw-bold"><?= $cntAp ?></div><div class="text-muted small">Aprendices</div></div>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="stat-card bg-white">
            <div class="d-flex align-items-center gap-3">
                <div class="stat-icon" style="background:rgba(37,99,235,.1);color:#2563eb;"><i class="fas fa-people-group"></i></div>
                <div><div class="fs-4 fw-bold"><?= $cntGrupos ?></div><div class="text-muted small">Grupos de limpieza</div></div>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="stat-card bg-white">
            <div class="d-flex align-items-center gap-3">
                <div class="stat-icon" style="background:rgba(234,179,8,.1);color:#d97706;"><i class="fas fa-user-tie"></i></div>
                <div>
                    <div class="fw-bold" style="font-size:.9rem;"><?= $voceroNombre ?: '—' ?></div>
                    <div class="text-muted small">Vocero asignado</div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card border-0 shadow-sm text-center py-5">
    <div class="card-body">
        <i class="fas fa-images fa-3x mb-3 opacity-25 d-block text-success"></i>
        <p class="text-muted mb-3 small">
            Las evidencias de esta ficha se gestionan desde la sección <strong>Evidencias</strong>.
        </p>
        <a href="admin_evidencias.php?ficha=<?= $vistaFicha ?>"
           class="btn btn-success fw-semibold px-4">
            <i class="fas fa-images me-2"></i>Ver Evidencias de esta Ficha
        </a>
    </div>
</div>
<?php endif; ?>

<!-- ══ MODAL CREAR/EDITAR PROGRAMA ══════════════════════════════════════════ -->
<div class="modal fade" id="modalPrograma" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content shadow border-0">
            <div class="modal-header" style="background:#0f2200;color:#fff;">
                <h6 class="modal-title fw-bold mb-0" id="modalProgramaTitulo">
                    <i class="fas fa-graduation-cap me-2 text-success"></i>Nuevo Programa
                </h6>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form action="../../controllers/AdminController.php" method="POST">
                <input type="hidden" name="accion"      value="guardar_programa">
                <input type="hidden" name="id_programa" id="id_programa" value="">
                <div class="modal-body px-4 py-4">
                    <div class="mb-3">
                        <label class="form-label fw-semibold small">
                            Nombre del Programa <span class="text-danger">*</span>
                        </label>
                        <input type="text" name="nombre" id="prog_nombre" class="form-control" required
                               placeholder="Ej: Tecnología en Análisis y Desarrollo de Software">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold small">Nivel de Formación</label>
                        <select name="nivel" id="prog_nivel" class="form-select">
                            <option value="">-- Seleccionar --</option>
                            <option value="Técnico">Técnico</option>
                            <option value="Tecnólogo">Tecnólogo</option>
                            <option value="Especialización Tecnológica">Especialización Tecnológica</option>
                            <option value="Complementaria">Complementaria</option>
                        </select>
                    </div>
                    <div class="mb-1">
                        <label class="form-label fw-semibold small">Descripción</label>
                        <textarea name="descripcion" id="prog_desc" class="form-control" rows="3"
                                  placeholder="Descripción general del programa…"></textarea>
                    </div>
                </div>
                <div class="modal-footer px-4">
                    <button type="button" class="btn btn-sm btn-outline-secondary"
                            data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-sm btn-success fw-semibold px-4">
                        <i class="fas fa-save me-1"></i>Guardar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- ══ ESTILOS ═══════════════════════════════════════════════════════════════ -->
<style>
.prog-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 24px rgba(0,0,0,.1) !important;
}
.breadcrumb-item + .breadcrumb-item::before { color: #9ca3af; }
</style>

<!-- ══ JAVASCRIPT ══════════════════════════════════════════════════════════════ -->
<script>
// Buscador programas
const buscProg = document.getElementById('buscPrograma');
if (buscProg) {
    buscProg.addEventListener('input', function () {
        const q = this.value.toLowerCase();
        document.querySelectorAll('.prog-item').forEach(el => {
            el.style.display = !q || el.textContent.toLowerCase().includes(q) ? '' : 'none';
        });
    });
}

// Buscador evidencias - eliminado (ver admin_evidencias.php)

// Modal editar programa
function editarPrograma(p) {
    document.getElementById('modalProgramaTitulo').innerHTML =
        '<i class="fas fa-pen me-2 text-success"></i>Editar Programa';
    document.getElementById('id_programa').value = p.id_programa;
    document.getElementById('prog_nombre').value = p.nombre;
    document.getElementById('prog_nivel').value  = p.nivel  || '';
    document.getElementById('prog_desc').value   = p.descripcion || '';
    new bootstrap.Modal(document.getElementById('modalPrograma')).show();
}

document.getElementById('modalPrograma').addEventListener('hidden.bs.modal', function () {
    document.getElementById('id_programa').value = '';
    document.getElementById('prog_nombre').value = '';
    document.getElementById('prog_nivel').value  = '';
    document.getElementById('prog_desc').value   = '';
    document.getElementById('modalProgramaTitulo').innerHTML =
        '<i class="fas fa-graduation-cap me-2 text-success"></i>Nuevo Programa';
});

<?php if ($alert): ?>
document.addEventListener('DOMContentLoaded', function () {
    Swal.fire({
        icon:  '<?= addslashes($alert['icon']) ?>',
        title: '<?= addslashes($alert['title']) ?>',
        text:  '<?= addslashes($alert['text']) ?>',
        confirmButtonColor: '#39a900'
    });
});
<?php endif; ?>
</script>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
