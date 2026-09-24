<?php
$titulo = 'Evidencias';
if (session_status() === PHP_SESSION_NONE) session_start();
if (!isset($_SESSION['usuario']) || (int)$_SESSION['usuario']['rol'] !== 1) {
    header("Location: ../usuarios/login.php"); exit;
}
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../models/Programa.php';
require_once __DIR__ . '/../../models/Ficha.php';
require_once __DIR__ . '/../../models/Evidencia.php';

$db        = (new Database())->conectar();
$modelProg = new Programa($db);
$modelFich = new Ficha($db);
$modelEv   = new Evidencia($db);
$alert     = $_SESSION['alert'] ?? null;
unset($_SESSION['alert']);

$vistaPrograma = (int)($_GET['programa'] ?? 0);
$vistaFicha    = (int)($_GET['ficha']    ?? 0);

$programas     = $modelProg->obtenerTodos();
$programaAct   = null;
$fichasDelProg = [];
$fichaAct      = null;
$evidencias    = [];

if ($vistaPrograma) {
    $programaAct = $modelProg->obtenerPorId($vistaPrograma);
    $stmtF = $db->prepare(
        "SELECT f.*,
                ANY_VALUE(v.nombres)   AS vocero_nombres,
                ANY_VALUE(v.apellidos) AS vocero_apellidos,
                COUNT(DISTINCT ap.id_aprendiz) AS total_aprendices
         FROM fichas f
         LEFT JOIN voceros    v  ON v.id_ficha  = f.id_ficha AND v.activo = 1
         LEFT JOIN aprendices ap ON ap.id_ficha = f.id_ficha AND ap.activo = 1
         WHERE f.id_programa = :prog AND f.activo = 1
         GROUP BY f.id_ficha ORDER BY f.numero_ficha"
    );
    $stmtF->execute([':prog' => $vistaPrograma]);
    $fichasDelProg = $stmtF->fetchAll(PDO::FETCH_ASSOC);
}

if ($vistaFicha) {
    $stmtFA = $db->prepare(
        "SELECT f.*, p.nombre AS nombre_programa,
                ANY_VALUE(v.nombres)   AS vocero_nombres,
                ANY_VALUE(v.apellidos) AS vocero_apellidos
         FROM fichas f
         JOIN programas p ON p.id_programa = f.id_programa
         LEFT JOIN voceros v ON v.id_ficha = f.id_ficha AND v.activo = 1
         WHERE f.id_ficha = :id GROUP BY f.id_ficha LIMIT 1"
    );
    $stmtFA->execute([':id' => $vistaFicha]);
    $fichaAct = $stmtFA->fetch(PDO::FETCH_ASSOC);

    if ($fichaAct) {
        $vistaPrograma = (int)$fichaAct['id_programa'];
        $programaAct   = $modelProg->obtenerPorId($vistaPrograma);

        $stmtF2 = $db->prepare(
            "SELECT f.*,
                    ANY_VALUE(v.nombres)   AS vocero_nombres,
                    ANY_VALUE(v.apellidos) AS vocero_apellidos,
                    COUNT(DISTINCT ap.id_aprendiz) AS total_aprendices
             FROM fichas f
             LEFT JOIN voceros    v  ON v.id_ficha  = f.id_ficha AND v.activo = 1
             LEFT JOIN aprendices ap ON ap.id_ficha = f.id_ficha AND ap.activo = 1
             WHERE f.id_programa = :prog AND f.activo = 1
             GROUP BY f.id_ficha ORDER BY f.numero_ficha"
        );
        $stmtF2->execute([':prog' => $vistaPrograma]);
        $fichasDelProg = $stmtF2->fetchAll(PDO::FETCH_ASSOC);

        $evidencias = $modelEv->obtenerTodas(['id_ficha' => $vistaFicha]);
    }
}

// Totales globales
$stmtTotEv = $db->query("SELECT COUNT(*) FROM evidencias");
$totalEvTotal = (int)$stmtTotEv->fetchColumn();

require_once __DIR__ . '/../layouts/header.php';
?>

<!-- ══ BREADCRUMB + CABECERA ════════════════════════════════════════════════ -->
<div class="d-flex justify-content-between align-items-start mb-4 flex-wrap gap-3">
    <div>
        <nav aria-label="breadcrumb" class="mb-1">
            <ol class="breadcrumb mb-0" style="font-size:.82rem;">
                <li class="breadcrumb-item">
                    <a href="admin_evidencias.php" class="text-success text-decoration-none fw-semibold">
                        <i class="fas fa-images me-1"></i>Evidencias
                    </a>
                </li>
                <?php if ($programaAct): ?>
                <li class="breadcrumb-item">
                    <?php if ($fichaAct): ?>
                        <a href="admin_evidencias.php?programa=<?= $vistaPrograma ?>"
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
                <i class="fas fa-images text-success me-2"></i>
                Evidencias — Ficha <span class="font-monospace"><?= htmlspecialchars($fichaAct['numero_ficha']) ?></span>
            <?php elseif ($programaAct): ?>
                <i class="fas fa-id-card text-success me-2"></i>
                Fichas — <?= htmlspecialchars($programaAct['nombre']) ?>
            <?php else: ?>
                <i class="fas fa-images text-success me-2"></i>Evidencias de Limpieza
            <?php endif; ?>
        </h4>
        <p class="text-muted small mb-0">
            <?php if ($fichaAct): ?>
                Historial de evidencias fotográficas registradas por el vocero
            <?php elseif ($programaAct): ?>
                Selecciona una ficha para ver el historial de evidencias
            <?php else: ?>
                Seguimiento centralizado de evidencias por programa y ficha
            <?php endif; ?>
        </p>
    </div>
</div>

<!-- ══ NIVEL 0: GRID DE PROGRAMAS ════════════════════════════════════════════ -->
<?php if (!$vistaPrograma && !$vistaFicha): ?>

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
                    <i class="fas fa-id-card"></i>
                </div>
                <div>
                    <div class="fs-4 fw-bold"><?= array_sum(array_column($programas,'total_fichas')) ?></div>
                    <div class="text-muted small">Fichas activas</div>
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
                    <div class="fs-4 fw-bold"><?= $totalEvTotal ?></div>
                    <div class="text-muted small">Evidencias registradas</div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="mb-3">
    <div class="input-group input-group-sm" style="max-width:340px;">
        <span class="input-group-text bg-white"><i class="fas fa-search text-muted"></i></span>
        <input type="text" id="buscPrograma" class="form-control border-start-0" placeholder="Buscar programa…">
    </div>
</div>

<div class="row g-3" id="gridProgramas">
    <?php foreach ($programas as $p):
        $stmtEC = $db->prepare(
            "SELECT COUNT(*) FROM evidencias e
             JOIN grupos g ON g.id_grupo = e.id_grupo
             JOIN asignaciones a ON a.id_asignacion = g.id_asignacion
             WHERE a.id_ficha IN (SELECT id_ficha FROM fichas WHERE id_programa = :prog)"
        );
        $stmtEC->execute([':prog' => $p['id_programa']]);
        $cntEv = (int)$stmtEC->fetchColumn();
    ?>
    <div class="col-md-6 col-lg-4 prog-item">
        <a href="admin_evidencias.php?programa=<?= $p['id_programa'] ?>" class="text-decoration-none">
            <div class="card border-0 shadow-sm h-100 prog-card" style="border-radius:12px;">
                <div class="card-body p-4">
                    <div class="d-flex align-items-start justify-content-between mb-3">
                        <div style="width:44px;height:44px;border-radius:10px;
                                    background:rgba(57,169,0,.12);color:#39a900;
                                    display:flex;align-items:center;justify-content:center;font-size:1.2rem;">
                            <i class="fas fa-graduation-cap"></i>
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
                            <div class="fw-bold text-warning fs-5"><?= $cntEv ?></div>
                            <div class="text-muted" style="font-size:.72rem;">Evidencias</div>
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
        <i class="fas fa-graduation-cap fa-3x mb-3 opacity-25 d-block"></i>No hay programas registrados.
    </div>
    <?php endif; ?>
</div>
<?php endif; ?>

<!-- ══ NIVEL 1: FICHAS DEL PROGRAMA ═════════════════════════════════════════ -->
<?php if ($vistaPrograma && !$vistaFicha): ?>

<div class="row g-3">
    <?php foreach ($fichasDelProg as $f):
        $stmtEF = $db->prepare(
            "SELECT COUNT(*) FROM evidencias e
             JOIN grupos g ON g.id_grupo = e.id_grupo
             JOIN asignaciones a ON a.id_asignacion = g.id_asignacion
             WHERE a.id_ficha = :fic"
        );
        $stmtEF->execute([':fic' => $f['id_ficha']]);
        $cntEvFicha = (int)$stmtEF->fetchColumn();
    ?>
    <div class="col-md-6 col-lg-4">
        <a href="admin_evidencias.php?ficha=<?= $f['id_ficha'] ?>" class="text-decoration-none">
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
                            <?= htmlspecialchars($f['vocero_nombres'] . ' ' . $f['vocero_apellidos']) ?>
                        <?php else: ?>
                            <span class="text-warning"><i class="fas fa-exclamation-circle me-1"></i>Sin vocero</span>
                        <?php endif; ?>
                    </div>
                    <div class="d-flex gap-3 pt-3" style="border-top:1px solid #e5e7eb;">
                        <div>
                            <div class="fw-bold text-warning fs-5"><?= $cntEvFicha ?></div>
                            <div class="text-muted" style="font-size:.72rem;">Evidencias</div>
                        </div>
                        <div>
                            <div class="fw-bold text-muted" style="font-size:1rem;"><?= (int)$f['total_aprendices'] ?></div>
                            <div class="text-muted" style="font-size:.72rem;">Aprendices</div>
                        </div>
                        <div class="ms-auto d-flex align-items-center text-success" style="font-size:.82rem;">
                            Ver evidencias <i class="fas fa-arrow-right ms-1"></i>
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

<!-- ══ NIVEL 2: HISTORIAL DE EVIDENCIAS DE LA FICHA ═════════════════════════ -->
<?php if ($vistaFicha && $fichaAct): ?>

<?php
$stmtGC = $db->prepare("SELECT COUNT(*) FROM grupos g JOIN asignaciones a ON a.id_asignacion=g.id_asignacion WHERE a.id_ficha=:fic");
$stmtGC->execute([':fic' => $vistaFicha]);
$cntGrupos = (int)$stmtGC->fetchColumn();
$voceroNombre = trim(($fichaAct['vocero_nombres'] ?? '') . ' ' . ($fichaAct['vocero_apellidos'] ?? ''));
?>

<div class="row g-3 mb-4">
    <div class="col-sm-4">
        <div class="stat-card bg-white">
            <div class="d-flex align-items-center gap-3">
                <div class="stat-icon" style="background:rgba(57,169,0,.12);color:#39a900;"><i class="fas fa-images"></i></div>
                <div>
                    <div class="fs-4 fw-bold"><?= count($evidencias) ?></div>
                    <div class="text-muted small">Evidencias registradas</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="stat-card bg-white">
            <div class="d-flex align-items-center gap-3">
                <div class="stat-icon" style="background:rgba(37,99,235,.1);color:#2563eb;"><i class="fas fa-people-group"></i></div>
                <div>
                    <div class="fs-4 fw-bold"><?= $cntGrupos ?></div>
                    <div class="text-muted small">Grupos de limpieza</div>
                </div>
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

<div class="card shadow-sm border-0">
    <div class="card-header bg-white border-0 py-3 d-flex justify-content-between align-items-center flex-wrap gap-2">
        <h6 class="fw-bold mb-0">
            <i class="fas fa-images text-success me-2"></i>
            Historial de Evidencias — <span class="font-monospace text-success"><?= htmlspecialchars($fichaAct['numero_ficha']) ?></span>
            <span class="text-muted fw-normal small ms-2">— <?= htmlspecialchars($fichaAct['nombre_programa']) ?></span>
        </h6>
        <div class="d-flex gap-2 align-items-center">
            <span class="badge bg-success"><?= count($evidencias) ?> evidencia(s)</span>
            <div class="input-group input-group-sm" style="max-width:220px;">
                <span class="input-group-text bg-white"><i class="fas fa-search text-muted"></i></span>
                <input type="text" id="buscEv" class="form-control border-start-0" placeholder="Buscar…">
            </div>
        </div>
    </div>
    <div class="card-body p-0">
        <?php if (empty($evidencias)): ?>
        <div class="text-center py-5 text-muted">
            <i class="fas fa-images fa-3x mb-3 opacity-25 d-block"></i>
            <p class="small mb-0">No hay evidencias registradas para esta ficha aún.</p>
        </div>
        <?php else: ?>
        <div class="table-responsive">
            <table class="table tabla-limpia align-middle mb-0" id="tblEv">
                <thead class="table-light">
                    <tr>
                        <th>Foto</th>
                        <th>Vocero</th>
                        <th>Grupo</th>
                        <th>Módulo</th>
                        <th>Fecha Limpieza</th>
                        <th>Fecha Subida</th>
                        <th class="text-center">Ver</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($evidencias as $e):
                    $dataEv = json_encode([
                        'ruta'     => $e['ruta_archivo'],
                        'vocero'   => ($e['vocero_nombres'] ?? '') . ' ' . ($e['vocero_apellidos'] ?? ''),
                        'modulo'   => $e['nombre_modulo'] ?? '—',
                        'grupo'    => $e['nombre_grupo']  ?? '—',
                        'ficha'    => $e['numero_ficha']  ?? '—',
                        'limpieza' => date('d/m/Y', strtotime($e['fecha_limpieza'])),
                        'subida'   => date('d/m/Y H:i',  strtotime($e['fecha_subida'])),
                    ], JSON_HEX_QUOT | JSON_HEX_APOS);
                ?>
                <tr>
                    <td>
                        <img src="../../public/<?= htmlspecialchars($e['ruta_archivo']) ?>"
                             alt="Evidencia"
                             style="width:52px;height:52px;object-fit:cover;border-radius:8px;
                                    border:1px solid #e5e7eb;cursor:pointer;"
                             data-ev="<?= htmlspecialchars($dataEv, ENT_QUOTES) ?>"
                             onclick="verDetalle(this)" title="Ampliar">
                    </td>
                    <td class="small fw-semibold">
                        <?= htmlspecialchars(($e['vocero_nombres'] ?? '') . ' ' . ($e['vocero_apellidos'] ?? '')) ?>
                    </td>
                    <td class="small text-muted"><?= htmlspecialchars($e['nombre_grupo'] ?? '—') ?></td>
                    <td class="small"><?= htmlspecialchars($e['nombre_modulo'] ?? '—') ?></td>
                    <td class="small"><?= date('d/m/Y', strtotime($e['fecha_limpieza'])) ?></td>
                    <td class="small text-muted"><?= date('d/m/Y H:i', strtotime($e['fecha_subida'])) ?></td>
                    <td class="text-center">
                        <button class="btn btn-sm btn-outline-success"
                                data-ev="<?= htmlspecialchars($dataEv, ENT_QUOTES) ?>"
                                onclick="verDetalle(this)" title="Ver detalle">
                            <i class="fas fa-eye"></i>
                        </button>
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

<!-- ══ MODAL DETALLE ═════════════════════════════════════════════════════════ -->
<div class="modal fade" id="modalDetalle" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow">
            <div class="modal-header border-0" style="background:#0f2200;color:#fff;">
                <h6 class="modal-title fw-bold mb-0">
                    <i class="fas fa-images me-2 text-success"></i>Detalle de Evidencia
                </h6>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-0">
                <div class="row g-0">
                    <div class="col-md-7 bg-dark d-flex align-items-center justify-content-center"
                         style="min-height:320px;">
                        <img id="detalleImg" src="" alt="Evidencia"
                             style="max-width:100%;max-height:420px;object-fit:contain;padding:1rem;">
                    </div>
                    <div class="col-md-5 p-4">
                        <h6 class="fw-bold mb-3">Información</h6>
                        <?php foreach (['detalleVocero'=>'Vocero','detalleGrupo'=>'Grupo','detalleModulo'=>'Módulo','detalleFicha'=>'Ficha','detalleLimpieza'=>'Fecha Limpieza','detalleSubida'=>'Fecha Subida'] as $id => $label): ?>
                        <div class="mb-3">
                            <div class="text-muted" style="font-size:.72rem;text-transform:uppercase;letter-spacing:.5px;"><?= $label ?></div>
                            <div class="fw-semibold small <?= $id==='detalleFicha' ? 'font-monospace text-success' : '' ?>" id="<?= $id ?>">—</div>
                        </div>
                        <?php endforeach; ?>
                        <div class="mt-3 pt-3" style="border-top:1px solid #e5e7eb;">
                            <span class="badge bg-success px-3 py-2">
                                <i class="fas fa-check me-1"></i>Evidencia verificada
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.prog-card { transition: transform .2s, box-shadow .2s; cursor: pointer; }
.prog-card:hover { transform: translateY(-3px); box-shadow: 0 8px 24px rgba(0,0,0,.1) !important; }
.breadcrumb-item + .breadcrumb-item::before { color: #9ca3af; }
</style>

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

// Buscador evidencias
const buscEv = document.getElementById('buscEv');
if (buscEv) {
    buscEv.addEventListener('input', function () {
        const q = this.value.toLowerCase();
        document.querySelectorAll('#tblEv tbody tr').forEach(tr => {
            tr.style.display = !q || tr.textContent.toLowerCase().includes(q) ? '' : 'none';
        });
    });
}

// Modal detalle
function verDetalle(el) {
    const data = JSON.parse(el.dataset.ev);
    const base = window.location.origin
               + window.location.pathname.replace(/\/views\/dashboard\/.*$/, '/public/');
    document.getElementById('detalleImg').src              = base + data.ruta;
    document.getElementById('detalleVocero').textContent   = data.vocero   || '—';
    document.getElementById('detalleGrupo').textContent    = data.grupo    || '—';
    document.getElementById('detalleModulo').textContent   = data.modulo   || '—';
    document.getElementById('detalleFicha').textContent    = data.ficha    || '—';
    document.getElementById('detalleLimpieza').textContent = data.limpieza || '—';
    document.getElementById('detalleSubida').textContent   = data.subida   || '—';
    new bootstrap.Modal(document.getElementById('modalDetalle')).show();
}

<?php if ($alert): ?>
document.addEventListener('DOMContentLoaded', function () {
    Swal.fire({ icon:'<?= addslashes($alert['icon']) ?>', title:'<?= addslashes($alert['title']) ?>', text:'<?= addslashes($alert['text']) ?>', confirmButtonColor:'#39a900' });
});
<?php endif; ?>
</script>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
