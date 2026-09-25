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

$vistaPrograma = (int)($_GET['programa'] ?? 0);

$programas     = $modelProg->obtenerTodos();
$programaAct   = $vistaPrograma ? $modelProg->obtenerPorId($vistaPrograma) : null;
$fichasDelProg = [];

if ($vistaPrograma) {
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

$totalProgramas = count($programas);
$totalFichas    = array_sum(array_column($programas, 'total_fichas'));

require_once __DIR__ . '/../layouts/header.php';
?>

<!-- ══ CABECERA + BREADCRUMB ════════════════════════════════════════════════ -->
<div class="d-flex justify-content-between align-items-start mb-4 flex-wrap gap-3">
    <div>
        <nav aria-label="breadcrumb" class="mb-1">
            <ol class="breadcrumb mb-0" style="font-size:.82rem;">
                <li class="breadcrumb-item">
                    <a href="admin_programas.php" class="text-success text-decoration-none fw-semibold">
                        <i class="fas fa-graduation-cap me-1"></i>Programas
                    </a>
                </li>
                <?php if ($programaAct): ?>
                <li class="breadcrumb-item active">
                    <span class="text-dark"><?= htmlspecialchars($programaAct['nombre']) ?></span>
                </li>
                <?php endif; ?>
            </ol>
        </nav>

        <h4 class="fw-bold mb-0">
            <?php if ($programaAct): ?>
                <i class="fas fa-id-card text-success me-2"></i>
                Fichas de <?= htmlspecialchars($programaAct['nombre']) ?>
            <?php else: ?>
                <i class="fas fa-graduation-cap text-success me-2"></i>
                Programas de Formación
            <?php endif; ?>
        </h4>
        <p class="text-muted small mb-0">
            <?php if ($programaAct): ?>
                Fichas del programa
            <?php else: ?>
                Programas de formación sincronizados con SICEFA
            <?php endif; ?>
        </p>
    </div>
</div>

<!-- ══ NIVEL 0: STATS + CARDS DE PROGRAMAS ══════════════════════════════════ -->
<?php if (!$vistaPrograma): ?>

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

<div class="mb-3">
    <div class="input-group input-group-sm" style="max-width:340px;">
        <span class="input-group-text bg-white"><i class="fas fa-search text-muted"></i></span>
        <input type="text" id="buscPrograma" class="form-control border-start-0"
               placeholder="Buscar programa…">
    </div>
</div>

<div class="row g-3" id="gridProgramas">
    <?php foreach ($programas as $p): ?>
    <div class="col-md-6 col-lg-4 prog-item">
        <a href="admin_programas.php?programa=<?= $p['id_programa'] ?>" class="text-decoration-none">
            <div class="card border-0 shadow-sm h-100 prog-card" style="border-radius:12px;">
                <div class="card-body p-4">
                    <div class="d-flex align-items-start justify-content-between mb-3">
                        <div style="width:44px;height:44px;border-radius:10px;
                                    background:rgba(57,169,0,.12);color:#39a900;
                                    display:flex;align-items:center;justify-content:center;font-size:1.2rem;">
                            <i class="fas fa-graduation-cap"></i>
                        </div>
                        <span class="badge <?= $p['activo'] ? 'bg-success' : 'bg-secondary' ?>">
                            <?= $p['activo'] ? 'Activo' : 'Inactivo' ?>
                        </span>
                    </div>
                    <h6 class="fw-bold mb-1" style="font-size:.9rem;line-height:1.3;color:#111827;">
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
                        <div class="ms-auto text-success" style="font-size:.82rem;">
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
<?php if ($vistaPrograma): ?>

<div class="row g-3">
    <?php foreach ($fichasDelProg as $f): ?>
    <div class="col-md-6 col-lg-4">
        <div class="card border-0 shadow-sm h-100 prog-card" style="border-radius:12px;">
            <div class="card-body p-4">
                <div class="d-flex align-items-start justify-content-between mb-3">
                    <div style="width:44px;height:44px;border-radius:10px;
                                background:rgba(37,99,235,.1);color:#2563eb;
                                display:flex;align-items:center;justify-content:center;font-size:1.1rem;">
                        <i class="fas fa-id-card"></i>
                    </div>
                    <span class="badge bg-light text-dark border" style="font-size:.72rem;">
                        <?= htmlspecialchars($f['jornada']) ?>
                    </span>
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
                        <div class="fw-bold text-success"><?= (int)$f['total_aprendices'] ?></div>
                        <div class="text-muted" style="font-size:.72rem;">Aprendices</div>
                    </div>
                    <div>
                        <div class="fw-bold <?= $f['activo'] ? 'text-success' : 'text-secondary' ?>">
                            <?= $f['activo'] ? 'Activa' : 'Inactiva' ?>
                        </div>
                        <div class="text-muted" style="font-size:.72rem;">Estado</div>
                    </div>
                </div>
            </div>
        </div>
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

<style>
.prog-card { transition: transform .2s, box-shadow .2s; }
.prog-card:hover { transform: translateY(-3px); box-shadow: 0 8px 24px rgba(0,0,0,.1) !important; }
.breadcrumb-item + .breadcrumb-item::before { color: #9ca3af; }
</style>

<script>
const buscProg = document.getElementById('buscPrograma');
if (buscProg) {
    buscProg.addEventListener('input', function () {
        const q = this.value.toLowerCase();
        document.querySelectorAll('.prog-item').forEach(el => {
            el.style.display = !q || el.textContent.toLowerCase().includes(q) ? '' : 'none';
        });
    });
}
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
