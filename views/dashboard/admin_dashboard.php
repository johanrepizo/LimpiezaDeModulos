<?php
$titulo = 'Dashboard Administrador';
if (session_status() === PHP_SESSION_NONE) session_start();
if (!isset($_SESSION['usuario']) || (int)$_SESSION['usuario']['rol'] !== 1) {
    header("Location: ../usuarios/login.php"); exit;
}

require_once __DIR__ . '/../../config/database.php';
$db    = (new Database())->conectar();
$alert = $_SESSION['alert'] ?? null;
unset($_SESSION['alert']);

// ── Stats ──
$totalFichas    = $db->query("SELECT COUNT(*) FROM fichas WHERE activo=1")->fetchColumn();
$totalVoceros   = $db->query("SELECT COUNT(*) FROM voceros WHERE activo=1")->fetchColumn();
$totalModulos   = $db->query("SELECT COUNT(*) FROM modulos WHERE activo=1")->fetchColumn();
$asignActivas   = $db->query("SELECT COUNT(*) FROM asignaciones WHERE estado='Activa'")->fetchColumn();

// Evidencias del mes actual
$evMes = $db->query(
    "SELECT COUNT(*) FROM evidencias WHERE MONTH(fecha_subida)=MONTH(NOW()) AND YEAR(fecha_subida)=YEAR(NOW())"
)->fetchColumn();

// Incumplimientos: asignaciones vencidas sin evidencia
$incumplimientos = $db->query(
    "SELECT COUNT(*) FROM asignaciones a
     WHERE a.fecha_limite_evidencia < NOW() AND a.estado='Activa'
     AND NOT EXISTS (
         SELECT 1 FROM grupos g
         JOIN evidencias e ON e.id_grupo = g.id_grupo
         WHERE g.id_asignacion = a.id_asignacion
     )"
)->fetchColumn();

// Fichas con turno hoy sin evidencia
$stmtAlertaHoy = $db->query(
    "SELECT COUNT(DISTINCT a.id_ficha) AS total
     FROM turnos t
     JOIN asignaciones a ON a.id_asignacion = t.id_asignacion
     WHERE t.fecha_turno = CURDATE()
       AND t.estado IN ('Abierto','Pendiente')
       AND NOT EXISTS (SELECT 1 FROM evidencias e WHERE e.id_turno = t.id_turno)"
);
$fichasConTurnoHoy = (int)$stmtAlertaHoy->fetchColumn();

// Últimas 5 evidencias
$ultimasEvidencias = $db->query(
    "SELECT e.fecha_subida, e.nombre_archivo, e.ruta_archivo,
            v.nombres AS vocero, v.apellidos AS vocero_ap,
            f.numero_ficha, m.nombre AS modulo
     FROM evidencias e
     JOIN voceros v ON v.id_vocero = e.id_vocero
     JOIN grupos g ON g.id_grupo = e.id_grupo
     JOIN asignaciones a ON a.id_asignacion = g.id_asignacion
     JOIN fichas f ON f.id_ficha = a.id_ficha
     JOIN modulos m ON m.id_modulo = a.id_modulo
     ORDER BY e.fecha_subida DESC LIMIT 5"
)->fetchAll(PDO::FETCH_ASSOC);

// Incumplimientos recientes (últimos 5)
$ultimosIncump = $db->query(
    "SELECT a.id_asignacion, a.fecha_limite_evidencia,
            f.numero_ficha, m.nombre AS modulo,
            v.nombres AS vocero, v.apellidos AS vocero_ap, v.correo
     FROM asignaciones a
     JOIN fichas f ON f.id_ficha = a.id_ficha
     JOIN modulos m ON m.id_modulo = a.id_modulo
     LEFT JOIN voceros v ON v.id_ficha = a.id_ficha AND v.activo=1
     WHERE a.fecha_limite_evidencia < NOW() AND a.estado='Activa'
     AND NOT EXISTS (
         SELECT 1 FROM grupos g
         JOIN evidencias e ON e.id_grupo = g.id_grupo
         WHERE g.id_asignacion = a.id_asignacion
     )
     ORDER BY a.fecha_limite_evidencia DESC LIMIT 5"
)->fetchAll(PDO::FETCH_ASSOC);

require_once __DIR__ . '/../layouts/header.php';
?>

<?php if ($fichasConTurnoHoy > 0): ?>
<div class="alert border-0 shadow-sm mb-4 d-flex align-items-start gap-3"
     style="background:#fff7ed; border-left:4px solid #f97316 !important; border-radius:10px;">
    <i class="fas fa-calendar-day mt-1" style="color:#f97316; font-size:1.2rem; flex-shrink:0;"></i>
    <div>
        <div class="fw-bold" style="color:#9a3412;">Hoy hay <?= $fichasConTurnoHoy ?> ficha(s) con turno de limpieza pendiente</div>
        <div class="small text-muted">
            Estas fichas deben subir su evidencia fotográfica antes de las <strong>11:59 PM</strong>.
            Revisa la sección de Evidencias para hacer seguimiento.
        </div>
        <a href="admin_evidencias.php" class="btn btn-sm mt-2 fw-semibold"
           style="background:#f97316; color:#fff; border:none; border-radius:7px;">
            <i class="fas fa-images me-1"></i>Ver evidencias
        </a>
    </div>
</div>
<?php endif; ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-0"><i class="fas fa-border-all text-success me-2"></i>Dashboard</h4>
        <p class="text-muted small mb-0">Resumen general del sistema – <?= date('d \d\e F, Y') ?></p>
    </div>
</div>

<!-- ── STATS CARDS ── -->
<div class="row g-3 mb-4">

    <div class="col-sm-6 col-xl-3">
        <div class="stat-card bg-white">
            <div class="d-flex align-items-center gap-3">
                <div class="stat-icon" style="background:rgba(57,169,0,.12); color:#39a900;">
                    <i class="fas fa-id-card"></i>
                </div>
                <div>
                    <div class="fs-4 fw-bold"><?= $totalFichas ?></div>
                    <div class="text-muted small">Fichas Activas</div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-xl-3">
        <div class="stat-card bg-white">
            <div class="d-flex align-items-center gap-3">
                <div class="stat-icon" style="background:rgba(37,99,235,.1); color:#2563eb;">
                    <i class="fas fa-user-tie"></i>
                </div>
                <div>
                    <div class="fs-4 fw-bold"><?= $totalVoceros ?></div>
                    <div class="text-muted small">Voceros Registrados</div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-xl-3">
        <div class="stat-card bg-white">
            <div class="d-flex align-items-center gap-3">
                <div class="stat-icon" style="background:rgba(234,179,8,.1); color:#d97706;">
                    <i class="fas fa-door-open"></i>
                </div>
                <div>
                    <div class="fs-4 fw-bold"><?= $asignActivas ?></div>
                    <div class="text-muted small">Asignaciones Activas</div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-xl-3">
        <div class="stat-card bg-white">
            <div class="d-flex align-items-center gap-3">
                <div class="stat-icon" style="background:rgba(239,68,68,.1); color:#ef4444;">
                    <i class="fas fa-triangle-exclamation"></i>
                </div>
                <div>
                    <div class="fs-4 fw-bold text-danger"><?= $incumplimientos ?></div>
                    <div class="text-muted small">Incumplimientos</div>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- ── DOS COLUMNAS ── -->
<div class="row g-4">

    <!-- Últimas evidencias -->
    <div class="col-lg-7">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-white border-0 py-3 d-flex justify-content-between align-items-center">
                <h6 class="fw-bold mb-0"><i class="fas fa-images text-success me-2"></i>Últimas Evidencias</h6>
                <a href="admin_evidencias.php" class="btn btn-sm btn-outline-success btn-sm">Ver todas</a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table tabla-limpia align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Vocero</th>
                                <th>Ficha</th>
                                <th>Módulo</th>
                                <th>Fecha</th>
                                <th>✓</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($ultimasEvidencias as $ev): ?>
                        <tr>
                            <td class="small fw-semibold"><?= htmlspecialchars($ev['vocero'] . ' ' . $ev['vocero_ap']) ?></td>
                            <td><span class="badge bg-light text-dark border"><?= htmlspecialchars($ev['numero_ficha']) ?></span></td>
                            <td class="small"><?= htmlspecialchars($ev['modulo']) ?></td>
                            <td class="small text-muted"><?= date('d/m/Y H:i', strtotime($ev['fecha_subida'])) ?></td>
                            <td><span class="text-success fw-bold">✓</span></td>
                        </tr>
                        <?php endforeach; ?>
                        <?php if (empty($ultimasEvidencias)): ?>
                        <tr><td colspan="5" class="text-center text-muted py-4 small">Sin evidencias registradas aún.</td></tr>
                        <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Incumplimientos recientes -->
    <div class="col-lg-5">
        <div class="card border-0 shadow-sm h-100" style="border-left: 3px solid #ef4444 !important;">
            <div class="card-header bg-white border-0 py-3 d-flex justify-content-between align-items-center">
                <h6 class="fw-bold mb-0 text-danger"><i class="fas fa-triangle-exclamation me-2"></i>Incumplimientos</h6>
                <?php if ($incumplimientos > 0): ?>
                    <span class="badge bg-danger"><?= $incumplimientos ?> total</span>
                <?php endif; ?>
            </div>
            <div class="card-body p-0">
                <?php if (empty($ultimosIncump)): ?>
                    <div class="text-center py-5 text-muted">
                        <i class="fas fa-check-circle text-success fa-2x mb-2 d-block"></i>
                        <span class="small">Sin incumplimientos activos</span>
                    </div>
                <?php else: ?>
                    <ul class="list-group list-group-flush">
                    <?php foreach ($ultimosIncump as $inc): ?>
                        <li class="list-group-item border-0 py-3">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <div class="fw-semibold small">Ficha <?= htmlspecialchars($inc['numero_ficha']) ?> – <?= htmlspecialchars($inc['modulo']) ?></div>
                                    <div class="text-muted" style="font-size:.78rem;">
                                        Vocero: <?= htmlspecialchars($inc['vocero'] . ' ' . $inc['vocero_ap']) ?>
                                    </div>
                                    <div class="text-muted" style="font-size:.75rem;">
                                        Venció: <?= date('d/m/Y H:i', strtotime($inc['fecha_limite_evidencia'])) ?>
                                    </div>
                                </div>
                                <span class="badge bg-danger-subtle text-danger border border-danger-subtle">Vencido</span>
                            </div>
                        </li>
                    <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </div>
        </div>
    </div>

</div>

<!-- Stats secundarias -->
<div class="row g-3 mt-2">
    <div class="col-sm-6 col-lg-3">
        <div class="card border-0 shadow-sm text-center py-3 px-2">
            <div class="text-success fw-bold fs-3"><?= $evMes ?></div>
            <div class="text-muted small">Evidencias este mes</div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-3">
        <div class="card border-0 shadow-sm text-center py-3 px-2">
            <div class="fw-bold fs-3"><?= $totalModulos ?></div>
            <div class="text-muted small">Módulos registrados</div>
        </div>
    </div>
</div>

<?php if ($alert): ?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    Swal.fire({
        icon:  '<?= addslashes($alert['icon']) ?>',
        title: '<?= addslashes($alert['title']) ?>',
        text:  '<?= addslashes($alert['text']) ?>',
        confirmButtonColor: '#39a900',
        background: '#fff'
    });
});
</script>
<?php endif; ?>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
