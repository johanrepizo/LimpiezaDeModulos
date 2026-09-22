<?php
$titulo = 'Notificaciones';
if (session_status() === PHP_SESSION_NONE) session_start();
if (!isset($_SESSION['usuario']) || (int)$_SESSION['usuario']['rol'] !== 1) {
    header("Location: ../usuarios/login.php"); exit;
}
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../models/Notificacion.php';

$db        = (new Database())->conectar();
$idUsuario = (int)$_SESSION['usuario']['id_usuario'];
$model     = new Notificacion($db);

$model->marcarTodasLeidas($idUsuario);

$notificaciones  = $model->obtenerPorUsuario($idUsuario);
$incumplimientos = $model->obtenerHistorialIncumplimientos($idUsuario);

require_once __DIR__ . '/../layouts/header.php';
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-0"><i class="fas fa-bell text-success me-2"></i>Notificaciones</h4>
        <p class="text-muted small mb-0">Alertas del sistema e historial de incumplimientos</p>
    </div>
</div>

<ul class="nav nav-tabs mb-0">
    <li class="nav-item">
        <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#tabTodas">
            <i class="fas fa-bell me-1"></i>Todas (<?= count($notificaciones) ?>)
        </button>
    </li>
    <li class="nav-item">
        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#tabIncump">
            <i class="fas fa-triangle-exclamation me-1 text-danger"></i>Incumplimientos (<?= count($incumplimientos) ?>)
        </button>
    </li>
</ul>

<div class="tab-content">

    <div class="tab-pane fade show active" id="tabTodas">
        <div class="card shadow-sm rounded-top-0">
            <div class="card-body p-0">
                <?php if (empty($notificaciones)): ?>
                    <div class="text-center py-5 text-muted">
                        <i class="fas fa-bell-slash fa-2x mb-2 opacity-25 d-block"></i>
                        <span class="small">Sin notificaciones.</span>
                    </div>
                <?php else: ?>
                <ul class="list-group list-group-flush">
                <?php foreach ($notificaciones as $n):
                    $iconos = ['incumplimiento' => 'triangle-exclamation text-danger',
                               'credenciales'   => 'key text-warning',
                               'recordatorio'   => 'clock text-info',
                               'info'           => 'circle-info text-primary'];
                    $icono  = $iconos[$n['tipo']] ?? 'bell text-secondary';
                ?>
                <li class="list-group-item border-0 py-3">
                    <div class="d-flex align-items-start gap-3">
                        <div style="margin-top:2px;"><i class="fas fa-<?= $icono ?> fa-lg"></i></div>
                        <div class="flex-grow-1">
                            <div class="fw-semibold small"><?= htmlspecialchars($n['titulo']) ?></div>
                            <div class="text-muted small"><?= htmlspecialchars($n['mensaje']) ?></div>
                        </div>
                        <div class="text-muted text-end" style="font-size:.75rem; white-space:nowrap;">
                            <?= date('d/m/Y H:i', strtotime($n['fecha'])) ?>
                        </div>
                    </div>
                </li>
                <?php endforeach; ?>
                </ul>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="tab-pane fade" id="tabIncump">
        <div class="card shadow-sm rounded-top-0">
            <div class="card-body p-0">
                <?php if (empty($incumplimientos)): ?>
                    <div class="text-center py-5 text-muted">
                        <i class="fas fa-check-circle text-success fa-2x mb-2 d-block"></i>
                        <span class="small">Sin incumplimientos registrados. ¡Excelente gestión!</span>
                    </div>
                <?php else: ?>
                <div class="table-responsive">
                    <table class="table tabla-limpia align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Fecha</th>
                                <th>Ficha</th>
                                <th>Módulo</th>
                                <th>Detalle</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($incumplimientos as $n): ?>
                        <tr>
                            <td class="small text-muted"><?= date('d/m/Y H:i', strtotime($n['fecha'])) ?></td>
                            <td><span class="badge bg-light text-dark border"><?= htmlspecialchars($n['numero_ficha'] ?? '—') ?></span></td>
                            <td class="small"><?= htmlspecialchars($n['nombre_modulo'] ?? '—') ?></td>
                            <td class="small text-muted"><?= htmlspecialchars(substr($n['mensaje'], 0, 80)) ?>…</td>
                            <td>
                                <?php if (!empty($n['id_ficha'])): ?>
                                <a href="admin_fichas.php?ficha=<?= $n['id_ficha'] ?>"
                                   class="btn btn-sm btn-outline-success" title="Ver vocero">
                                    <i class="fas fa-user-tie me-1"></i>Ver vocero
                                </a>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

</div>

<style>
.rounded-top-0 { border-top-left-radius:0!important; border-top-right-radius:0!important; }
.nav-tabs .nav-link { font-size:.875rem; color:#64748b; }
.nav-tabs .nav-link.active { color:#39a900; font-weight:600; }
</style>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
