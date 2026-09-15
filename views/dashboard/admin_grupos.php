<?php
$titulo = 'Grupos de Limpieza';
if (session_status() === PHP_SESSION_NONE) session_start();
if (!isset($_SESSION['usuario']) || (int)$_SESSION['usuario']['rol'] !== 1) {
    header("Location: ../usuarios/login.php"); exit;
}
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../models/Grupo.php';
require_once __DIR__ . '/../../models/Programa.php';
require_once __DIR__ . '/../../models/Ficha.php';

$db        = (new Database())->conectar();
$alert     = $_SESSION['alert'] ?? null;
unset($_SESSION['alert']);

$modelProg = new Programa($db);
$modelFich = new Ficha($db);
$modelGrup = new Grupo($db);

$vistaPrograma = (int)($_GET['programa'] ?? 0);
$vistaFicha    = (int)($_GET['ficha']    ?? 0);
$busqueda      = trim($_GET['q']         ?? '');
$filtroEstado  = trim($_GET['estado']    ?? '');

// Nivel 0: todos los programas
$programas = $modelProg->obtenerTodos();

// Nivel 1: fichas del programa
$programaAct   = null;
$fichasDelProg = [];
if ($vistaPrograma) {
    $programaAct = $modelProg->obtenerPorId($vistaPrograma);
    $stmtF = $db->prepare(
        "SELECT f.*,
                ANY_VALUE(v.nombres)   AS vocero_nombres,
                ANY_VALUE(v.apellidos) AS vocero_apellidos,
                COUNT(DISTINCT g.id_grupo) AS total_grupos,
                COUNT(DISTINCT ap.id_aprendiz) AS total_aprendices
         FROM fichas f
         LEFT JOIN voceros    v  ON v.id_ficha  = f.id_ficha AND v.activo = 1
         LEFT JOIN grupos     g  ON g.id_vocero = v.id_vocero
         LEFT JOIN aprendices ap ON ap.id_ficha = f.id_ficha AND ap.activo = 1
         WHERE f.id_programa = :prog AND f.activo = 1
         GROUP BY f.id_ficha
         ORDER BY f.numero_ficha"
    );
    $stmtF->execute([':prog' => $vistaPrograma]);
    $fichasDelProg = $stmtF->fetchAll(PDO::FETCH_ASSOC);
}

// Nivel 2: grupos de la ficha
$fichaAct = null;
$grupos   = [];
if ($vistaFicha) {
    $fichaAct = $modelFich->obtenerPorId($vistaFicha);
    if ($fichaAct) {
        $vistaPrograma = (int)$fichaAct['id_programa'];
        $programaAct   = $modelProg->obtenerPorId($vistaPrograma);

        $stmtF2 = $db->prepare(
            "SELECT f.*,
                    ANY_VALUE(v.nombres) AS vocero_nombres,
                    COUNT(DISTINCT g.id_grupo) AS total_grupos
             FROM fichas f
             LEFT JOIN voceros v ON v.id_ficha = f.id_ficha AND v.activo = 1
             LEFT JOIN grupos  g ON g.id_vocero = v.id_vocero
             WHERE f.id_programa = :prog AND f.activo = 1
             GROUP BY f.id_ficha ORDER BY f.numero_ficha"
        );
        $stmtF2->execute([':prog' => $vistaPrograma]);
        $fichasDelProg = $stmtF2->fetchAll(PDO::FETCH_ASSOC);

        // Grupos con filtros
        $where  = ['a.id_ficha = :fic'];
        $params = [':fic' => $vistaFicha];
        if ($filtroEstado) { $where[] = 'g.estado = :est'; $params[':est'] = $filtroEstado; }
        if ($busqueda) {
            $like = '%' . $busqueda . '%';
            $where[] = '(g.nombre_grupo LIKE :q OR v.nombres LIKE :q2 OR v.apellidos LIKE :q3 OR m.nombre LIKE :q4)';
            $params[':q'] = $like; $params[':q2'] = $like;
            $params[':q3'] = $like; $params[':q4'] = $like;
        }
        $whereStr = implode(' AND ', $where);

        $stmtG = $db->prepare(
            "SELECT g.*,
                    m.nombre  AS nombre_modulo,
                    f.numero_ficha,
                    v.nombres AS vocero_nombres, v.apellidos AS vocero_apellidos,
                    (SELECT COUNT(*) FROM evidencias e WHERE e.id_grupo = g.id_grupo) AS tiene_evidencia,
                    (SELECT COUNT(*) FROM grupo_integrantes gi WHERE gi.id_grupo = g.id_grupo) AS total_integrantes
             FROM grupos g
             JOIN asignaciones a ON a.id_asignacion = g.id_asignacion
             JOIN modulos      m ON m.id_modulo     = a.id_modulo
             JOIN fichas       f ON f.id_ficha      = a.id_ficha
             JOIN voceros      v ON v.id_vocero     = g.id_vocero
             WHERE {$whereStr}
             ORDER BY g.fecha_limpieza DESC"
        );
        $stmtG->execute($params);
        $grupos = $stmtG->fetchAll(PDO::FETCH_ASSOC);
    }
}

// Detalle integrantes si se pide
$grupoDetalle   = null;
$integrantesDet = [];
if (!empty($_GET['grupo'])) {
    $grupoDetalle   = $modelGrup->obtenerPorId((int)$_GET['grupo']);
    $integrantesDet = $modelGrup->obtenerIntegrantes((int)$_GET['grupo']);
}

require_once __DIR__ . '/../layouts/header.php';
?>

<!-- ══ BREADCRUMB + CABECERA ════════════════════════════════════════════════ -->
<div class="d-flex justify-content-between align-items-start mb-4 flex-wrap gap-3">
    <div>
        <nav aria-label="breadcrumb" class="mb-1">
            <ol class="breadcrumb mb-0" style="font-size:.82rem;">
                <li class="breadcrumb-item">
                    <a href="admin_grupos.php" class="text-success text-decoration-none fw-semibold">
                        <i class="fas fa-people-group me-1"></i>Grupos
                    </a>
                </li>
                <?php if ($programaAct): ?>
                <li class="breadcrumb-item">
                    <?php if ($fichaAct): ?>
                        <a href="admin_grupos.php?programa=<?= $vistaPrograma ?>"
                           class="text-success text-decoration-none">
                            <?= htmlspecialchars($programaAct['nombre']) ?>
                        </a>
                    <?php else: ?>
                        <span class="text-dark fw-semibold"><?= htmlspecialchars($programaAct['nombre']) ?></span>
                    <?php endif; ?>
                </li>
                <?php endif; ?>
                <?php if ($fichaAct): ?>
                <li class="breadcrumb-item active">
                    Ficha <strong class="font-monospace"><?= htmlspecialchars($fichaAct['numero_ficha']) ?></strong>
                </li>
                <?php endif; ?>
            </ol>
        </nav>
        <h4 class="fw-bold mb-0">
            <?php if ($fichaAct): ?>
                <i class="fas fa-people-group text-success me-2"></i>
                Grupos — Ficha <span class="font-monospace"><?= htmlspecialchars($fichaAct['numero_ficha']) ?></span>
            <?php elseif ($programaAct): ?>
                <i class="fas fa-id-card text-success me-2"></i>
                Fichas — <?= htmlspecialchars($programaAct['nombre']) ?>
            <?php else: ?>
                <i class="fas fa-people-group text-success me-2"></i>Grupos de Limpieza
            <?php endif; ?>
        </h4>
        <p class="text-muted small mb-0">
            <?php if ($fichaAct): ?>
                <?= count($grupos) ?> grupo(s) registrados en esta ficha
            <?php elseif ($programaAct): ?>
                Selecciona una ficha para ver sus grupos
            <?php else: ?>
                Selecciona un programa de formación
            <?php endif; ?>
        </p>
    </div>
</div>

<!-- ══ NIVEL 0: GRID DE PROGRAMAS ════════════════════════════════════════════ -->
<?php if (!$vistaPrograma && !$vistaFicha): ?>

<?php
$stmtTotG = $db->query("SELECT COUNT(*) FROM grupos");
$totalGrupos = (int)$stmtTotG->fetchColumn();
$stmtTotEv = $db->query("SELECT COUNT(*) FROM evidencias");
$totalEv = (int)$stmtTotEv->fetchColumn();
?>
<div class="row g-3 mb-4">
    <div class="col-sm-4">
        <div class="stat-card bg-white">
            <div class="d-flex align-items-center gap-3">
                <div class="stat-icon" style="background:rgba(57,169,0,.12);color:#39a900;">
                    <i class="fas fa-graduation-cap"></i>
                </div>
                <div>
                    <div class="fs-4 fw-bold"><?= count($programas) ?></div>
                    <div class="text-muted small">Programas</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="stat-card bg-white">
            <div class="d-flex align-items-center gap-3">
                <div class="stat-icon" style="background:rgba(37,99,235,.1);color:#2563eb;">
                    <i class="fas fa-people-group"></i>
                </div>
                <div>
                    <div class="fs-4 fw-bold"><?= $totalGrupos ?></div>
                    <div class="text-muted small">Grupos registrados</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="stat-card bg-white">
            <div class="d-flex align-items-center gap-3">
                <div class="stat-icon" style="background:rgba(234,179,8,.1);color:#d97706;">
                    <i class="fas fa-images"></i>
                </div>
                <div>
                    <div class="fs-4 fw-bold"><?= $totalEv ?></div>
                    <div class="text-muted small">Evidencias registradas</div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="mb-3">
    <div class="input-group input-group-sm" style="max-width:320px;">
        <span class="input-group-text bg-white"><i class="fas fa-search text-muted"></i></span>
        <input type="text" id="buscPrograma" class="form-control border-start-0" placeholder="Buscar programa…">
    </div>
</div>

<div class="row g-3" id="gridProgramas">
    <?php foreach ($programas as $p):
        $stmtGC = $db->prepare(
            "SELECT COUNT(DISTINCT g.id_grupo)
             FROM grupos g
             JOIN asignaciones a ON a.id_asignacion = g.id_asignacion
             WHERE a.id_ficha IN (SELECT id_ficha FROM fichas WHERE id_programa = :prog)"
        );
        $stmtGC->execute([':prog' => $p['id_programa']]);
        $cntG = (int)$stmtGC->fetchColumn();
    ?>
    <div class="col-md-6 col-lg-4 prog-item">
        <a href="admin_grupos.php?programa=<?= $p['id_programa'] ?>" class="text-decoration-none">
            <div class="card border-0 shadow-sm h-100 prog-card" style="border-radius:12px;">
                <div class="card-body p-4">
                    <div class="d-flex align-items-start justify-content-between mb-3">
                        <div style="width:44px;height:44px;border-radius:10px;
                                    background:rgba(37,99,235,.1);color:#2563eb;
                                    display:flex;align-items:center;justify-content:center;font-size:1.2rem;">
                            <i class="fas fa-people-group"></i>
                        </div>
                        <span class="badge bg-light text-dark border" style="font-size:.72rem;">
                            <?= htmlspecialchars($p['nivel'] ?? 'Sin nivel') ?>
                        </span>
                    </div>
                    <h6 class="fw-bold mb-3 text-dark" style="font-size:.88rem;line-height:1.3;">
                        <?= htmlspecialchars($p['nombre']) ?>
                    </h6>
                    <div class="d-flex gap-3 pt-3" style="border-top:1px solid #e5e7eb;">
                        <div>
                            <div class="fw-bold text-success fs-5"><?= (int)$p['total_fichas'] ?></div>
                            <div class="text-muted" style="font-size:.72rem;">Fichas</div>
                        </div>
                        <div>
                            <div class="fw-bold text-primary fs-5"><?= $cntG ?></div>
                            <div class="text-muted" style="font-size:.72rem;">Grupos</div>
                        </div>
                        <div class="ms-auto d-flex align-items-center text-success" style="font-size:.82rem;">
                            Ver fichas <i class="fas fa-arrow-right ms-1"></i>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <?php endforeach; ?>
    <?php if (empty($programas)): ?>
    <div class="col-12 text-center py-5 text-muted">
        <i class="fas fa-graduation-cap fa-3x mb-3 opacity-25 d-block"></i>No hay programas.
    </div>
    <?php endif; ?>
</div>
<?php endif; ?>

<!-- ══ NIVEL 1: FICHAS DEL PROGRAMA ═════════════════════════════════════════ -->
<?php if ($vistaPrograma && !$vistaFicha): ?>

<div class="row g-3">
    <?php foreach ($fichasDelProg as $f): ?>
    <div class="col-md-6 col-lg-4">
        <a href="admin_grupos.php?programa=<?= $vistaPrograma ?>&ficha=<?= $f['id_ficha'] ?>" class="text-decoration-none">
            <div class="card border-0 shadow-sm h-100 prog-card" style="border-radius:12px;">
                <div class="card-body p-4">
                    <div class="d-flex align-items-start justify-content-between mb-3">
                        <div style="width:44px;height:44px;border-radius:10px;
                                    background:rgba(37,99,235,.1);color:#2563eb;
                                    display:flex;align-items:center;justify-content:center;font-size:1.1rem;">
                            <i class="fas fa-id-card"></i>
                        </div>
                        <span class="badge bg-light text-dark border"><?= htmlspecialchars($f['jornada']) ?></span>
                    </div>
                    <div class="fw-bold text-success font-monospace mb-1" style="font-size:1.3rem;">
                        <?= htmlspecialchars($f['numero_ficha']) ?>
                    </div>
                    <div class="text-muted small mb-3">
                        <?php if ($f['vocero_nombres']): ?>
                            <i class="fas fa-user-tie text-success me-1" style="font-size:.75rem;"></i>
                            <?= htmlspecialchars($f['vocero_nombres']) ?>
                        <?php else: ?>
                            <span class="text-warning"><i class="fas fa-exclamation-circle me-1"></i>Sin vocero</span>
                        <?php endif; ?>
                    </div>
                    <div class="d-flex gap-3 pt-3" style="border-top:1px solid #e5e7eb;">
                        <div>
                            <div class="fw-bold text-primary fs-5"><?= (int)$f['total_grupos'] ?></div>
                            <div class="text-muted" style="font-size:.72rem;">Grupos</div>
                        </div>
                        <div class="ms-auto d-flex align-items-center text-success" style="font-size:.82rem;">
                            Ver grupos <i class="fas fa-arrow-right ms-1"></i>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <?php endforeach; ?>
    <?php if (empty($fichasDelProg)): ?>
    <div class="col-12 text-center py-5 text-muted">
        <i class="fas fa-id-card fa-3x mb-3 opacity-25 d-block"></i>No hay fichas en este programa.
    </div>
    <?php endif; ?>
</div>
<?php endif; ?>

<!-- ══ NIVEL 2: GRUPOS DE LA FICHA ══════════════════════════════════════════ -->
<?php if ($vistaFicha && $fichaAct): ?>

<!-- Filtros -->
<form method="GET" class="card shadow-sm border-0 mb-3">
    <div class="card-body py-2 px-3">
        <input type="hidden" name="programa" value="<?= $vistaPrograma ?>">
        <input type="hidden" name="ficha"    value="<?= $vistaFicha ?>">
        <div class="d-flex gap-2 align-items-center flex-wrap">
            <select name="estado" class="form-select form-select-sm" style="max-width:140px;" onchange="this.form.submit()">
                <option value="">Todos los estados</option>
                <option value="Activo"     <?= $filtroEstado==='Activo'     ?'selected':'' ?>>Activo</option>
                <option value="Completado" <?= $filtroEstado==='Completado' ?'selected':'' ?>>Completado</option>
                <option value="Sancionado" <?= $filtroEstado==='Sancionado' ?'selected':'' ?>>Sancionado</option>
            </select>
            <div class="input-group input-group-sm" style="max-width:240px;">
                <span class="input-group-text bg-white"><i class="fas fa-search text-muted"></i></span>
                <input type="text" name="q" class="form-control border-start-0"
                       placeholder="Buscar grupo, vocero…" value="<?= htmlspecialchars($busqueda) ?>">
            </div>
            <button type="submit" class="btn btn-success btn-sm">
                <i class="fas fa-filter me-1"></i>Filtrar
            </button>
            <?php if ($filtroEstado || $busqueda): ?>
            <a href="admin_grupos.php?programa=<?= $vistaPrograma ?>&ficha=<?= $vistaFicha ?>"
               class="btn btn-sm btn-outline-secondary"><i class="fas fa-xmark"></i></a>
            <?php endif; ?>
        </div>
    </div>
</form>

<!-- Tabla de grupos -->
<div class="card shadow-sm border-0">
    <div class="card-header bg-white border-0 py-3 d-flex justify-content-between align-items-center">
        <h6 class="fw-bold mb-0">
            <i class="fas fa-people-group text-success me-2"></i>
            Grupos — <?= htmlspecialchars($fichaAct['nombre_programa']) ?>
        </h6>
        <span class="badge bg-secondary"><?= count($grupos) ?> grupo(s)</span>
    </div>
    <div class="card-body p-0">
        <?php if (empty($grupos)): ?>
        <div class="text-center py-5 text-muted">
            <i class="fas fa-people-group fa-3x mb-3 opacity-25 d-block"></i>
            <p class="small mb-0">No hay grupos registrados en esta ficha.</p>
        </div>
        <?php else: ?>
        <div class="table-responsive">
            <table class="table tabla-limpia align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Grupo</th>
                        <th>Vocero</th>
                        <th>Módulo</th>
                        <th>Fecha Limpieza</th>
                        <th class="text-center">Evidencia</th>
                        <th>Estado</th>
                        <th class="text-center">Integrantes</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($grupos as $g):
                    $badge = match($g['estado']) {
                        'Completado' => 'bg-primary',
                        'Sancionado' => 'bg-danger',
                        default      => 'bg-success',
                    };
                    $esHoy = date('Y-m-d', strtotime($g['fecha_limpieza'])) === date('Y-m-d');
                ?>
                <tr>
                    <td class="fw-semibold small">
                        <?= htmlspecialchars($g['nombre_grupo']) ?>
                        <?php if ($esHoy): ?>
                            <span class="badge bg-warning text-dark ms-1" style="font-size:.65rem;">Hoy</span>
                        <?php endif; ?>
                    </td>
                    <td class="small"><?= htmlspecialchars($g['vocero_nombres'] . ' ' . $g['vocero_apellidos']) ?></td>
                    <td class="small text-muted"><?= htmlspecialchars($g['nombre_modulo']) ?></td>
                    <td class="small"><?= date('d/m/Y', strtotime($g['fecha_limpieza'])) ?></td>
                    <td class="text-center">
                        <?php if ((int)$g['tiene_evidencia'] > 0): ?>
                            <span class="text-success fw-bold fs-5">✓</span>
                        <?php else: ?>
                            <span class="text-danger">✗</span>
                        <?php endif; ?>
                    </td>
                    <td><span class="badge <?= $badge ?>"><?= $g['estado'] ?></span></td>
                    <td class="text-center">
                        <a href="?programa=<?= $vistaPrograma ?>&ficha=<?= $vistaFicha ?>&grupo=<?= $g['id_grupo'] ?><?= $filtroEstado ? '&estado='.urlencode($filtroEstado) : '' ?><?= $busqueda ? '&q='.urlencode($busqueda) : '' ?>"
                           class="btn btn-sm btn-outline-success" title="Ver integrantes">
                            <i class="fas fa-users me-1"></i><?= (int)$g['total_integrantes'] ?>
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

<!-- Panel integrantes -->
<?php if ($grupoDetalle): ?>
<div class="card shadow-sm border-0 mt-4" style="border-top:3px solid #39a900 !important;">
    <div class="card-header bg-white border-0 py-3 d-flex justify-content-between align-items-center">
        <h6 class="fw-bold mb-0">
            <i class="fas fa-users text-success me-2"></i>
            Integrantes — <?= htmlspecialchars($grupoDetalle['nombre_grupo']) ?>
            <span class="text-muted fw-normal small ms-2">
                <?= htmlspecialchars($grupoDetalle['nombre_modulo']) ?> · <?= date('d/m/Y', strtotime($grupoDetalle['fecha_limpieza'])) ?>
            </span>
        </h6>
        <div class="d-flex gap-2 align-items-center">
            <span class="badge bg-success"><?= count($integrantesDet) ?> integrante(s)</span>
            <a href="admin_grupos.php?programa=<?= $vistaPrograma ?>&ficha=<?= $vistaFicha ?>"
               class="btn btn-sm btn-outline-secondary"><i class="fas fa-xmark"></i></a>
        </div>
    </div>
    <div class="card-body p-0">
        <?php if (empty($integrantesDet)): ?>
            <div class="text-center py-4 text-muted small">No hay integrantes.</div>
        <?php else: ?>
        <table class="table tabla-limpia align-middle mb-0">
            <thead class="table-light">
                <tr><th>#</th><th>Apellidos</th><th>Nombres</th><th>Documento</th><th>Celular</th><th>Correo</th></tr>
            </thead>
            <tbody>
            <?php foreach ($integrantesDet as $i => $ap): ?>
            <tr>
                <td class="text-muted small"><?= $i + 1 ?></td>
                <td class="fw-semibold small"><?= htmlspecialchars($ap['apellidos']) ?></td>
                <td class="small"><?= htmlspecialchars($ap['nombres']) ?></td>
                <td class="small text-muted"><?= htmlspecialchars($ap['documento'] ?? '—') ?></td>
                <td class="small">
                    <?php if (!empty($ap['celular'])): ?>
                        <a href="tel:<?= htmlspecialchars($ap['celular']) ?>" class="text-decoration-none text-dark">
                            <i class="fas fa-phone text-success me-1" style="font-size:.72rem;"></i><?= htmlspecialchars($ap['celular']) ?>
                        </a>
                    <?php else: ?><span class="text-muted">—</span><?php endif; ?>
                </td>
                <td class="small">
                    <?php if (!empty($ap['correo'])): ?>
                        <a href="mailto:<?= htmlspecialchars($ap['correo']) ?>"
                           class="text-decoration-none text-dark text-truncate d-inline-block"
                           style="max-width:160px;" title="<?= htmlspecialchars($ap['correo']) ?>">
                            <i class="fas fa-envelope text-success me-1" style="font-size:.72rem;"></i><?= htmlspecialchars($ap['correo']) ?>
                        </a>
                    <?php else: ?><span class="text-muted">—</span><?php endif; ?>
                </td>
            </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        <?php endif; ?>
    </div>
</div>
<?php endif; ?>

<?php endif; ?>

<style>
.prog-card { transition: transform .2s, box-shadow .2s; cursor: pointer; }
.prog-card:hover { transform: translateY(-3px); box-shadow: 0 8px 24px rgba(0,0,0,.1) !important; }
.breadcrumb-item + .breadcrumb-item::before { color: #9ca3af; }
</style>

<script>
const bP = document.getElementById('buscPrograma');
if (bP) {
    bP.addEventListener('input', function () {
        const q = this.value.toLowerCase();
        document.querySelectorAll('.prog-item').forEach(el => {
            el.style.display = !q || el.textContent.toLowerCase().includes(q) ? '' : 'none';
        });
    });
}
<?php if ($alert): ?>
document.addEventListener('DOMContentLoaded', function () {
    Swal.fire({ icon:'<?= addslashes($alert['icon']) ?>', title:'<?= addslashes($alert['title']) ?>', text:'<?= addslashes($alert['text']) ?>', confirmButtonColor:'#39a900' });
});
<?php endif; ?>
</script>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
