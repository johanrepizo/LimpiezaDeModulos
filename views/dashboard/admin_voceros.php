<?php
$titulo = 'Voceros';
if (session_status() === PHP_SESSION_NONE) session_start();
if (!isset($_SESSION['usuario']) || (int)$_SESSION['usuario']['rol'] !== 1) {
    header("Location: ../usuarios/login.php"); exit;
}
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../models/Programa.php';
require_once __DIR__ . '/../../models/Ficha.php';

$db        = (new Database())->conectar();
$alert     = $_SESSION['alert'] ?? null;
unset($_SESSION['alert']);

$vistaPrograma = (int)($_GET['programa'] ?? 0);
$vistaFicha    = (int)($_GET['ficha']    ?? 0);
$busqueda      = trim($_GET['q']         ?? '');

$modelProg = new Programa($db);
$modelFich = new Ficha($db);

// ── Stats globales ──────────────────────────────────────────────────────────
$programas   = $modelProg->obtenerTodos();
$stmtTotV    = $db->query("SELECT COUNT(*) FROM voceros WHERE activo = 1");
$totalVoceros = (int)$stmtTotV->fetchColumn();

// ── Nivel 1: fichas del programa ────────────────────────────────────────────
$programaAct   = null;
$fichasDelProg = [];
if ($vistaPrograma) {
    $programaAct = $modelProg->obtenerPorId($vistaPrograma);
    $stmtF = $db->prepare(
        "SELECT f.*,
                ANY_VALUE(v.nombres)   AS vocero_nombres,
                ANY_VALUE(v.apellidos) AS vocero_apellidos,
                COUNT(DISTINCT ap.id_aprendiz) AS total_aprendices,
                COUNT(DISTINCT v.id_vocero)    AS tiene_vocero
         FROM fichas f
         LEFT JOIN voceros    v  ON v.id_ficha  = f.id_ficha AND v.activo = 1
         LEFT JOIN aprendices ap ON ap.id_ficha = f.id_ficha AND ap.activo = 1
         WHERE f.id_programa = :prog AND f.activo = 1
         GROUP BY f.id_ficha
         ORDER BY f.numero_ficha"
    );
    $stmtF->execute([':prog' => $vistaPrograma]);
    $fichasDelProg = $stmtF->fetchAll(PDO::FETCH_ASSOC);
}

// ── Nivel 2: voceros de una ficha ────────────────────────────────────────────
$fichaAct = null;
$voceros  = [];
if ($vistaFicha) {
    $fichaAct = $modelFich->obtenerPorId($vistaFicha);
    if ($fichaAct) {
        $vistaPrograma = (int)$fichaAct['id_programa'];
        $programaAct   = $modelProg->obtenerPorId($vistaPrograma);

        $stmtF2 = $db->prepare(
            "SELECT f.*,
                    ANY_VALUE(v.nombres) AS vocero_nombres,
                    COUNT(DISTINCT ap.id_aprendiz) AS total_aprendices,
                    COUNT(DISTINCT v.id_vocero)    AS tiene_vocero
             FROM fichas f
             LEFT JOIN voceros    v  ON v.id_ficha  = f.id_ficha AND v.activo = 1
             LEFT JOIN aprendices ap ON ap.id_ficha = f.id_ficha AND ap.activo = 1
             WHERE f.id_programa = :prog AND f.activo = 1
             GROUP BY f.id_ficha ORDER BY f.numero_ficha"
        );
        $stmtF2->execute([':prog' => $vistaPrograma]);
        $fichasDelProg = $stmtF2->fetchAll(PDO::FETCH_ASSOC);

        $where  = ['v.id_ficha = :fic', 'v.activo = 1'];
        $params = [':fic' => $vistaFicha];
        if ($busqueda) {
            $like = '%' . $busqueda . '%';
            $where[] = '(v.nombres LIKE :q OR v.apellidos LIKE :q2 OR v.documento LIKE :q3 OR u.correo LIKE :q4)';
            $params[':q'] = $like; $params[':q2'] = $like;
            $params[':q3'] = $like; $params[':q4'] = $like;
        }
        $stmtV = $db->prepare(
            "SELECT v.*, u.correo, u.activo AS usuario_activo, u.primer_acceso
             FROM voceros v
             JOIN usuarios u ON u.id_usuario = v.id_usuario
             WHERE " . implode(' AND ', $where) . "
             ORDER BY v.apellidos, v.nombres"
        );
        $stmtV->execute($params);
        $voceros = $stmtV->fetchAll(PDO::FETCH_ASSOC);
    }
}

require_once __DIR__ . '/../layouts/header.php';
?>

<!-- ══ BREADCRUMB + CABECERA ════════════════════════════════════════════════ -->
<div class="d-flex justify-content-between align-items-start mb-4 flex-wrap gap-3">
    <div>
        <nav aria-label="breadcrumb" class="mb-1">
            <ol class="breadcrumb mb-0" style="font-size:.82rem;">
                <li class="breadcrumb-item">
                    <a href="admin_voceros.php" class="text-success text-decoration-none fw-semibold">
                        <i class="fas fa-user-tie me-1"></i>Voceros
                    </a>
                </li>
                <?php if ($programaAct): ?>
                <li class="breadcrumb-item">
                    <?php if ($fichaAct): ?>
                        <a href="admin_voceros.php?programa=<?= $vistaPrograma ?>"
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
                <i class="fas fa-user-tie text-success me-2"></i>
                Voceros — Ficha <span class="font-monospace"><?= htmlspecialchars($fichaAct['numero_ficha']) ?></span>
            <?php elseif ($programaAct): ?>
                <i class="fas fa-id-card text-success me-2"></i>
                Fichas — <?= htmlspecialchars($programaAct['nombre']) ?>
            <?php else: ?>
                <i class="fas fa-user-tie text-success me-2"></i>Voceros
            <?php endif; ?>
        </h4>
        <p class="text-muted small mb-0">
            <?php if ($fichaAct): ?>
                <?= count($voceros) ?> vocero(s) en esta ficha
            <?php elseif ($programaAct): ?>
                Selecciona una ficha para ver sus voceros
            <?php else: ?>
                Selecciona un programa de formación
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
                    <div class="fs-4 fw-bold"><?= array_sum(array_column($programas, 'total_fichas')) ?></div>
                    <div class="text-muted small">Fichas activas</div>
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
                    <div class="fs-4 fw-bold"><?= $totalVoceros ?></div>
                    <div class="text-muted small">Voceros registrados</div>
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
        // Contar voceros en este programa
        $stmtVC = $db->prepare(
            "SELECT COUNT(DISTINCT v.id_vocero) FROM voceros v
             JOIN fichas f ON f.id_ficha = v.id_ficha
             WHERE f.id_programa = :prog AND v.activo = 1"
        );
        $stmtVC->execute([':prog' => $p['id_programa']]);
        $cntVoc = (int)$stmtVC->fetchColumn();
    ?>
    <div class="col-md-6 col-lg-4 prog-item">
        <a href="admin_voceros.php?programa=<?= $p['id_programa'] ?>" class="text-decoration-none">
            <div class="card border-0 shadow-sm h-100 prog-card" style="border-radius:12px;">
                <div class="card-body p-4">
                    <div class="d-flex align-items-start justify-content-between mb-3">
                        <div style="width:44px;height:44px;border-radius:10px;
                                    background:rgba(234,179,8,.1);color:#d97706;
                                    display:flex;align-items:center;justify-content:center;font-size:1.2rem;">
                            <i class="fas fa-user-tie"></i>
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
                            <div class="fw-bold text-warning" style="font-size:1.3rem;"><?= $cntVoc ?></div>
                            <div class="text-muted" style="font-size:.72rem;">Voceros</div>
                        </div>
                        <div>
                            <div class="fw-bold text-success" style="font-size:1.3rem;"><?= (int)$p['total_fichas'] ?></div>
                            <div class="text-muted" style="font-size:.72rem;">Fichas</div>
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

<?php
$fichasConVocero    = count(array_filter($fichasDelProg, fn($f) => (int)$f['tiene_vocero'] > 0));
$fichasSinVocero    = count($fichasDelProg) - $fichasConVocero;
?>
<div class="row g-3 mb-4">
    <div class="col-sm-4">
        <div class="stat-card bg-white">
            <div class="d-flex align-items-center gap-3">
                <div class="stat-icon" style="background:rgba(37,99,235,.1);color:#2563eb;">
                    <i class="fas fa-id-card"></i>
                </div>
                <div>
                    <div class="fs-4 fw-bold"><?= count($fichasDelProg) ?></div>
                    <div class="text-muted small">Fichas en el programa</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="stat-card bg-white">
            <div class="d-flex align-items-center gap-3">
                <div class="stat-icon" style="background:rgba(57,169,0,.12);color:#39a900;">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div>
                    <div class="fs-4 fw-bold"><?= $fichasConVocero ?></div>
                    <div class="text-muted small">Fichas con vocero</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="stat-card bg-white">
            <div class="d-flex align-items-center gap-3">
                <div class="stat-icon" style="background:rgba(239,68,68,.1);color:#ef4444;">
                    <i class="fas fa-circle-xmark"></i>
                </div>
                <div>
                    <div class="fs-4 fw-bold"><?= $fichasSinVocero ?></div>
                    <div class="text-muted small">Sin vocero asignado</div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-3">
    <?php foreach ($fichasDelProg as $f):
        $tieneVocero = (int)$f['tiene_vocero'] > 0;
    ?>
    <div class="col-md-6 col-lg-4">
        <a href="admin_voceros.php?ficha=<?= $f['id_ficha'] ?>" class="text-decoration-none">
            <div class="card border-0 shadow-sm h-100 prog-card"
                 style="border-radius:12px; border-left:4px solid <?= $tieneVocero ? '#39a900' : '#ef4444' ?> !important;">
                <div class="card-body p-4">
                    <div class="d-flex align-items-start justify-content-between mb-3">
                        <div style="width:44px;height:44px;border-radius:10px;
                                    background:<?= $tieneVocero ? 'rgba(57,169,0,.12)' : 'rgba(239,68,68,.1)' ?>;
                                    color:<?= $tieneVocero ? '#39a900' : '#ef4444' ?>;
                                    display:flex;align-items:center;justify-content:center;font-size:1.1rem;">
                            <i class="fas fa-<?= $tieneVocero ? 'user-tie' : 'user-slash' ?>"></i>
                        </div>
                        <span class="badge <?= $tieneVocero ? 'bg-success' : 'bg-danger' ?>">
                            <?= $tieneVocero ? 'Con vocero' : 'Sin vocero' ?>
                        </span>
                    </div>
                    <div class="fw-bold text-success font-monospace mb-1" style="font-size:1.3rem;">
                        <?= htmlspecialchars($f['numero_ficha']) ?>
                    </div>
                    <div class="text-muted small mb-3">
                        <?php if ($tieneVocero): ?>
                            <i class="fas fa-user-tie text-success me-1" style="font-size:.75rem;"></i>
                            <?= htmlspecialchars($f['vocero_nombres']) ?>
                        <?php else: ?>
                            <span class="text-danger"><i class="fas fa-exclamation-circle me-1"></i>Sin vocero asignado</span>
                        <?php endif; ?>
                    </div>
                    <div class="d-flex gap-3 pt-3" style="border-top:1px solid #e5e7eb;">
                        <div>
                            <div class="fw-bold text-muted" style="font-size:1rem;"><?= htmlspecialchars($f['jornada']) ?></div>
                            <div class="text-muted" style="font-size:.72rem;">Jornada</div>
                        </div>
                        <div>
                            <div class="fw-bold" style="font-size:1rem;"><?= (int)$f['total_aprendices'] ?></div>
                            <div class="text-muted" style="font-size:.72rem;">Aprendices</div>
                        </div>
                        <div class="ms-auto d-flex align-items-center text-success" style="font-size:.82rem;">
                            Ver voceros <i class="fas fa-arrow-right ms-1"></i>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <?php endforeach; ?>
    <?php if (empty($fichasDelProg)): ?>
    <div class="col-12">
        <div class="card border-0 shadow-sm text-center py-5 text-muted">
            <i class="fas fa-id-card fa-3x mb-3 opacity-25 d-block"></i>
            No hay fichas registradas en este programa.
        </div>
    </div>
    <?php endif; ?>
</div>
<?php endif; ?>

<!-- ══ NIVEL 2: VOCEROS DE LA FICHA ══════════════════════════════════════════ -->
<?php if ($vistaFicha && $fichaAct): ?>

<div class="row g-3 mb-4">
    <div class="col-sm-4">
        <div class="stat-card bg-white">
            <div class="d-flex align-items-center gap-3">
                <div class="stat-icon" style="background:rgba(234,179,8,.1);color:#d97706;">
                    <i class="fas fa-user-tie"></i>
                </div>
                <div>
                    <div class="fs-4 fw-bold"><?= count($voceros) ?></div>
                    <div class="text-muted small">Vocero(s) en la ficha</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="stat-card bg-white">
            <div class="d-flex align-items-center gap-3">
                <div class="stat-icon" style="background:rgba(57,169,0,.12);color:#39a900;">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div>
                    <div class="fs-4 fw-bold">
                        <?= count(array_filter($voceros, fn($v) => !(int)$v['primer_acceso'])) ?>
                    </div>
                    <div class="text-muted small">Con acceso activo</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="stat-card bg-white">
            <div class="d-flex align-items-center gap-3">
                <div class="stat-icon" style="background:rgba(239,68,68,.1);color:#ef4444;">
                    <i class="fas fa-clock"></i>
                </div>
                <div>
                    <div class="fs-4 fw-bold">
                        <?= count(array_filter($voceros, fn($v) => (int)$v['primer_acceso'])) ?>
                    </div>
                    <div class="text-muted small">Pendiente primer acceso</div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card shadow-sm border-0">
    <div class="card-header bg-white border-0 py-3 d-flex justify-content-between align-items-center flex-wrap gap-2">
        <h6 class="fw-bold mb-0">
            <i class="fas fa-user-tie text-success me-2"></i>
            Voceros de la Ficha
            <span class="text-muted fw-normal small ms-2">— <?= htmlspecialchars($fichaAct['nombre_programa']) ?></span>
        </h6>
        <div class="d-flex gap-2 align-items-center">
            <span class="badge bg-success"><?= count($voceros) ?> vocero(s)</span>
            <form method="GET" class="d-flex gap-1">
                <input type="hidden" name="ficha" value="<?= $vistaFicha ?>">
                <div class="input-group input-group-sm" style="max-width:220px;">
                    <span class="input-group-text bg-white"><i class="fas fa-search text-muted"></i></span>
                    <input type="text" name="q" class="form-control border-start-0"
                           placeholder="Buscar…" value="<?= htmlspecialchars($busqueda) ?>">
                </div>
                <button type="submit" class="btn btn-sm btn-success"><i class="fas fa-search"></i></button>
                <?php if ($busqueda): ?>
                    <a href="admin_voceros.php?ficha=<?= $vistaFicha ?>"
                       class="btn btn-sm btn-outline-secondary"><i class="fas fa-xmark"></i></a>
                <?php endif; ?>
            </form>
        </div>
    </div>
    <div class="card-body p-0">
        <?php if (empty($voceros)): ?>
        <div class="text-center py-5 text-muted">
            <i class="fas fa-user-tie fa-3x mb-3 opacity-25 d-block"></i>
            <p class="small mb-0">
                <?= $busqueda
                    ? 'No hay resultados para "' . htmlspecialchars($busqueda) . '".'
                    : 'No hay voceros asignados a esta ficha.' ?>
            </p>
        </div>
        <?php else: ?>
        <div class="table-responsive">
            <table class="table tabla-limpia align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Nombre Completo</th>
                        <th>Documento</th>
                        <th>Celular</th>
                        <th>Correo</th>
                        <th>Acceso</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($voceros as $v): ?>
                <tr>
                    <td>
                        <div class="fw-semibold small">
                            <?= htmlspecialchars($v['apellidos'] . ', ' . $v['nombres']) ?>
                        </div>
                    </td>
                    <td class="small text-muted"><?= htmlspecialchars($v['documento'] ?? '—') ?></td>
                    <td class="small"><?= htmlspecialchars($v['celular'] ?? '—') ?></td>
                    <td class="small text-muted"><?= htmlspecialchars($v['correo']) ?></td>
                    <td>
                        <?php if ((int)$v['primer_acceso']): ?>
                            <span class="badge bg-warning text-dark">
                                <i class="fas fa-clock me-1"></i>Pendiente
                            </span>
                        <?php else: ?>
                            <span class="badge bg-success">
                                <i class="fas fa-check me-1"></i>Activo
                            </span>
                        <?php endif; ?>
                    </td>
                    <td class="text-center">
                        <form action="../../controllers/AdminController.php" method="POST"
                              class="d-inline form-credenciales"
                              id="form-cred-<?= $v['id_vocero'] ?>">
                            <input type="hidden" name="accion"    value="reenviar_credenciales">
                            <input type="hidden" name="id_vocero" value="<?= $v['id_vocero'] ?>">
                            <button type="button" class="btn btn-sm btn-outline-warning"
                                    onclick="confirmarCredenciales(<?= $v['id_vocero'] ?>, '<?= addslashes($v['nombres'] . ' ' . $v['apellidos']) ?>')"
                                    title="Reenviar credenciales">
                                <i class="fas fa-key me-1"></i>Credenciales
                            </button>
                        </form>
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

<!-- ══ ESTILOS + JS ═══════════════════════════════════════════════════════════ -->
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

function confirmarCredenciales(idVocero, nombre) {
    Swal.fire({
        title: '¿Reenviar credenciales?',
        text:  'Se generará una nueva contraseña temporal para ' + nombre + ' y se le enviará por notificación.',
        icon:  'question',
        showCancelButton:   true,
        confirmButtonText:  'Sí, reenviar',
        cancelButtonText:   'Cancelar',
        confirmButtonColor: '#39a900',
        cancelButtonColor:  '#6b7280',
    }).then(function(result) {
        if (result.isConfirmed) {
            document.getElementById('form-cred-' + idVocero).submit();
        }
    });
}

<?php if ($alert): ?>
document.addEventListener('DOMContentLoaded', function () {
    Swal.fire({ icon:'<?= addslashes($alert['icon']) ?>', title:'<?= addslashes($alert['title']) ?>', text:'<?= addslashes($alert['text']) ?>', confirmButtonColor:'#39a900' });
});
<?php endif; ?>
</script>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
