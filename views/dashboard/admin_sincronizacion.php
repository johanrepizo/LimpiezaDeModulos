<?php
$titulo = 'Sincronización SICEFA';
if (session_status() === PHP_SESSION_NONE) session_start();
if (!isset($_SESSION['usuario']) || (int)$_SESSION['usuario']['rol'] !== 1) {
    header("Location: ../usuarios/login.php"); exit;
}
require_once __DIR__ . '/../../config/database.php';

$db    = (new Database())->conectar();
$alert = $_SESSION['alert'] ?? null;
unset($_SESSION['alert']);

// Historial de sincronizaciones
$logs = $db->query(
    "SELECT * FROM log_sincronizacion ORDER BY fecha DESC LIMIT 20"
)->fetchAll(PDO::FETCH_ASSOC);

$ultimaSync = $logs[0] ?? null;

// Stats
$totalAprendices = $db->query("SELECT COUNT(*) FROM aprendices WHERE activo=1")->fetchColumn();
$totalVoceros    = $db->query("SELECT COUNT(*) FROM voceros WHERE activo=1")->fetchColumn();

require_once __DIR__ . '/../layouts/header.php';
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-0"><i class="fas fa-rotate text-success me-2"></i>Sincronización con SICEFA</h4>
        <p class="text-muted small mb-0">Estado de integración y control de cuentas de voceros</p>
    </div>
</div>

<!-- Panel de estado -->
<div class="row g-3 mb-4">

    <div class="col-sm-6 col-lg-3">
        <div class="stat-card bg-white">
            <div class="d-flex align-items-center gap-3">
                <div class="stat-icon" style="background:rgba(57,169,0,.12); color:#39a900;">
                    <i class="fas fa-users"></i>
                </div>
                <div>
                    <div class="fs-4 fw-bold"><?= $totalAprendices ?></div>
                    <div class="text-muted small">Aprendices sincronizados</div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-lg-3">
        <div class="stat-card bg-white">
            <div class="d-flex align-items-center gap-3">
                <div class="stat-icon" style="background:rgba(37,99,235,.1); color:#2563eb;">
                    <i class="fas fa-user-tie"></i>
                </div>
                <div>
                    <div class="fs-4 fw-bold"><?= $totalVoceros ?></div>
                    <div class="text-muted small">Cuentas de voceros activas</div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-lg-3">
        <div class="stat-card bg-white">
            <div class="d-flex align-items-center gap-3">
                <div class="stat-icon" style="background:<?= $ultimaSync && $ultimaSync['estado']==='exitoso' ? 'rgba(57,169,0,.12)' : 'rgba(239,68,68,.1)' ?>; color:<?= $ultimaSync && $ultimaSync['estado']==='exitoso' ? '#39a900' : '#ef4444' ?>;">
                    <i class="fas fa-<?= $ultimaSync && $ultimaSync['estado']==='exitoso' ? 'check-circle' : 'exclamation-triangle' ?>"></i>
                </div>
                <div>
                    <div class="fw-bold small"><?= $ultimaSync ? ucfirst($ultimaSync['estado']) : 'Sin datos' ?></div>
                    <div class="text-muted small">Estado última sync</div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-lg-3">
        <div class="stat-card bg-white">
            <div class="d-flex align-items-center gap-3">
                <div class="stat-icon" style="background:rgba(234,179,8,.1); color:#d97706;">
                    <i class="fas fa-clock"></i>
                </div>
                <div>
                    <div class="fw-bold small"><?= $ultimaSync ? date('d/m/Y H:i', strtotime($ultimaSync['fecha'])) : '—' ?></div>
                    <div class="text-muted small">Última sincronización</div>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- Info SICEFA -->
<div class="card border-0 shadow-sm mb-4" style="border-left:4px solid #39a900 !important;">
    <div class="card-body px-4 py-3">
        <h6 class="fw-bold mb-2"><i class="fas fa-circle-info text-success me-2"></i>Sobre la sincronización con SICEFA</h6>
        <p class="text-muted small mb-2">
            El sistema obtiene automáticamente la información de aprendices y voceros desde la base de datos de SICEFA.
            Cuando se detectan nuevos voceros, el sistema crea sus cuentas y les envía las credenciales de acceso al correo institucional registrado en SICEFA.
        </p>
        <ul class="text-muted small mb-0">
            <li>Los aprendices se sincronizan por ficha y programa de formación.</li>
            <li>Los voceros con primer acceso deben cambiar su contraseña temporal al ingresar.</li>
            <li>Si un vocero no recibió sus credenciales, usa la opción <strong>"Reenviar credenciales"</strong> en la sección de Voceros.</li>
            <li>En producción, esta sincronización se ejecuta automáticamente de forma programada (cron job).</li>
        </ul>
    </div>
</div>

<!-- Log de sincronizaciones -->
<div class="card shadow-sm">
    <div class="card-header bg-white border-0 py-3">
        <h6 class="fw-bold mb-0"><i class="fas fa-list-check text-success me-2"></i>Historial de Sincronizaciones</h6>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table tabla-limpia align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Fecha</th>
                        <th>Estado</th>
                        <th>Aprendices sync</th>
                        <th>Voceros creados</th>
                        <th>Correos enviados</th>
                        <th>Error</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($logs as $log):
                    $badge = match($log['estado']) {
                        'exitoso'  => 'bg-success',
                        'parcial'  => 'bg-warning text-dark',
                        default    => 'bg-danger',
                    };
                ?>
                <tr>
                    <td class="small"><?= date('d/m/Y H:i:s', strtotime($log['fecha'])) ?></td>
                    <td><span class="badge <?= $badge ?>"><?= ucfirst($log['estado']) ?></span></td>
                    <td class="small text-center"><?= (int)$log['aprendices_sync'] ?></td>
                    <td class="small text-center"><?= (int)$log['voceros_creados'] ?></td>
                    <td class="small text-center"><?= (int)$log['correos_enviados'] ?></td>
                    <td class="small text-danger"><?= htmlspecialchars($log['detalle_error'] ?? '—') ?></td>
                </tr>
                <?php endforeach; ?>
                <?php if (empty($logs)): ?>
                <tr><td colspan="6" class="text-center text-muted py-5">Sin historial de sincronizaciones.</td></tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php if ($alert): ?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    Swal.fire({ icon:'<?= addslashes($alert['icon']) ?>', title:'<?= addslashes($alert['title']) ?>', text:'<?= addslashes($alert['text']) ?>', confirmButtonColor:'#39a900' });
});
</script>
<?php endif; ?>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
