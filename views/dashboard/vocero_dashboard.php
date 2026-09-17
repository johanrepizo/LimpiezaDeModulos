<?php
$titulo = 'Mi Panel – Vocero';
if (session_status() === PHP_SESSION_NONE) session_start();
if (!isset($_SESSION['usuario']) || (int)$_SESSION['usuario']['rol'] !== 2) {
    header("Location: ../usuarios/login.php"); exit;
}

require_once __DIR__ . '/../../config/database.php';
$db    = (new Database())->conectar();
$alert = $_SESSION['alert'] ?? null;
unset($_SESSION['alert']);

$idUsuario = (int)$_SESSION['usuario']['id_usuario'];

// Obtener datos del vocero
$stmtV = $db->prepare(
    "SELECT v.*, f.numero_ficha, p.nombre AS nombre_programa
     FROM voceros v
     JOIN fichas   f ON f.id_ficha    = v.id_ficha
     JOIN programas p ON p.id_programa = f.id_programa
     WHERE v.id_usuario = :id AND v.activo = 1 LIMIT 1"
);
$stmtV->execute([':id' => $idUsuario]);
$vocero = $stmtV->fetch(PDO::FETCH_ASSOC);

if (!$vocero) {
    // Usuario con rol vocero pero sin perfil de vocero creado todavía
    // NO destruimos la sesión — mostramos mensaje de espera
    require_once __DIR__ . '/../layouts/header.php';
    echo '
    <div class="d-flex align-items-center justify-content-center" style="min-height:60vh;">
        <div class="text-center" style="max-width:440px;">
            <div class="mb-4" style="font-size:3.5rem;">⏳</div>
            <h5 class="fw-bold mb-2">Perfil en configuración</h5>
            <p class="text-muted small mb-4">
                Tu cuenta fue creada correctamente, pero el administrador aún no ha
                vinculado tu perfil de vocero a una ficha.<br>
                Contacta al administrador para que complete la configuración.
            </p>
            <a href="../../controllers/AuthController.php?accion=logout"
               class="btn btn-sm btn-outline-danger">
                <i class="fas fa-power-off me-1"></i>Cerrar sesión
            </a>
        </div>
    </div>';
    require_once __DIR__ . '/../layouts/footer.php';
    exit;
}

$idVocero = (int)$vocero['id_vocero'];

// Verificar si hoy hay turno de limpieza para esta ficha
require_once __DIR__ . '/../../models/Turno.php';
$modelTurnoHoy = new Turno($db);
$turnoAlerta   = $idVocero ? $modelTurnoHoy->turnoActivoHoy($vocero['id_ficha']) : false;

// Stats
$totalGrupos = $db->prepare("SELECT COUNT(*) FROM grupos WHERE id_vocero = :id");
$totalGrupos->execute([':id' => $idVocero]);
$totalGrupos = $totalGrupos->fetchColumn();

$totalEvidencias = $db->prepare("SELECT COUNT(*) FROM evidencias WHERE id_vocero = :id");
$totalEvidencias->execute([':id' => $idVocero]);
$totalEvidencias = $totalEvidencias->fetchColumn();

$totalAprendices = $db->prepare("SELECT COUNT(*) FROM aprendices WHERE id_ficha = :id AND activo=1");
$totalAprendices->execute([':id' => $vocero['id_ficha']]);
$totalAprendices = $totalAprendices->fetchColumn();

// Asignaciones activas de mi ficha
$asignaciones = $db->prepare(
    "SELECT a.*, m.nombre AS nombre_modulo, a.fecha_limite_evidencia,
            (SELECT COUNT(*) FROM grupos g
             JOIN evidencias e ON e.id_grupo = g.id_grupo
             WHERE g.id_asignacion = a.id_asignacion
               AND g.id_vocero = :idv) AS tiene_evidencia
     FROM asignaciones a
     JOIN modulos m ON m.id_modulo = a.id_modulo
     WHERE a.id_ficha = :fic AND a.estado = 'Activa'
     ORDER BY a.fecha_limite_evidencia"
);
$asignaciones->execute([':fic' => $vocero['id_ficha'], ':idv' => $idVocero]);
$asignaciones = $asignaciones->fetchAll(PDO::FETCH_ASSOC);

// Últimas evidencias
$ultimasEv = $db->prepare(
    "SELECT e.fecha_subida, e.ruta_archivo,
            g.nombre_grupo, g.fecha_limpieza,
            m.nombre AS modulo
     FROM evidencias e
     JOIN grupos g ON g.id_grupo = e.id_grupo
     JOIN asignaciones a ON a.id_asignacion = g.id_asignacion
     JOIN modulos m ON m.id_modulo = a.id_modulo
     WHERE e.id_vocero = :id
     ORDER BY e.fecha_subida DESC LIMIT 4"
);
$ultimasEv->execute([':id' => $idVocero]);
$ultimasEv = $ultimasEv->fetchAll(PDO::FETCH_ASSOC);

require_once __DIR__ . '/../layouts/header.php';
?>

<?php if ($turnoAlerta && (int)$turnoAlerta['tiene_evidencia'] === 0): ?>
<div class="alert border-0 shadow-sm mb-4 d-flex align-items-start gap-3"
     style="background:#fffbeb; border-left:4px solid #f59e0b !important; border-radius:10px;">
    <i class="fas fa-triangle-exclamation mt-1" style="color:#f59e0b; font-size:1.2rem; flex-shrink:0;"></i>
    <div>
        <div class="fw-bold" style="color:#92400e;">¡Hoy es día de limpieza!</div>
        <div class="small text-muted">
            Hoy le corresponde limpiar el módulo <strong><?= htmlspecialchars($turnoAlerta['nombre_modulo']) ?></strong>.
            Recuerda subir la evidencia fotográfica antes de las <strong>11:59 PM</strong>.
            <?php if ($turnoAlerta['nombre_grupo']): ?>
                Grupo responsable: <strong><?= htmlspecialchars($turnoAlerta['nombre_grupo']) ?></strong>.
            <?php endif; ?>
        </div>
        <a href="vocero_subir_evidencia.php" class="btn btn-sm mt-2 fw-semibold"
           style="background:#f59e0b; color:#fff; border:none; border-radius:7px;">
            <i class="fas fa-camera me-1"></i>Subir evidencia ahora
        </a>
    </div>
</div>
<?php endif; ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-0">
            <i class="fas fa-border-all text-success me-2"></i>
            Bienvenido, <?= htmlspecialchars($vocero['nombres']) ?>
        </h4>
        <p class="text-muted small mb-0">
            Ficha <strong><?= htmlspecialchars($vocero['numero_ficha']) ?></strong>
            &bull; <?= htmlspecialchars($vocero['nombre_programa']) ?>
        </p>
    </div>
</div>

<!-- Stats -->
<div class="row g-3 mb-4">
    <div class="col-sm-4">
        <div class="stat-card bg-white">
            <div class="d-flex align-items-center gap-3">
                <div class="stat-icon" style="background:rgba(57,169,0,.12); color:#39a900;"><i class="fas fa-users"></i></div>
                <div>
                    <div class="fs-4 fw-bold"><?= $totalAprendices ?></div>
                    <div class="text-muted small">Aprendices en mi ficha</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="stat-card bg-white">
            <div class="d-flex align-items-center gap-3">
                <div class="stat-icon" style="background:rgba(37,99,235,.1); color:#2563eb;"><i class="fas fa-people-group"></i></div>
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
                <div class="stat-icon" style="background:rgba(234,179,8,.1); color:#d97706;"><i class="fas fa-images"></i></div>
                <div>
                    <div class="fs-4 fw-bold"><?= $totalEvidencias ?></div>
                    <div class="text-muted small">Evidencias subidas</div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Asignaciones activas -->
<div class="row g-4">
    <div class="col-lg-7">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-0 py-3">
                <h6 class="fw-bold mb-0"><i class="fas fa-door-open text-success me-2"></i>Mis Módulos Asignados</h6>
            </div>
            <div class="card-body p-0">
                <?php if (empty($asignaciones)): ?>
                    <div class="text-center py-5 text-muted">
                        <i class="fas fa-door-open fa-2x mb-2 opacity-25 d-block"></i>
                        <span class="small">No tienes módulos asignados actualmente.</span>
                    </div>
                <?php else: ?>
                    <ul class="list-group list-group-flush">
                    <?php foreach ($asignaciones as $a):
                        $vencido   = strtotime($a['fecha_limite_evidencia']) < time();
                        $cumple    = (int)$a['tiene_evidencia'] > 0;
                    ?>
                    <li class="list-group-item border-0 py-3">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <div class="fw-semibold small"><?= htmlspecialchars($a['nombre_modulo']) ?></div>
                                <div class="text-muted" style="font-size:.78rem;">
                                    Límite: <?= date('d/m/Y H:i', strtotime($a['fecha_limite_evidencia'])) ?>
                                </div>
                            </div>
                            <div class="d-flex flex-column align-items-end gap-1">
                                <?php if ($cumple): ?>
                                    <span class="badge bg-success">✓ Entregada</span>
                                <?php elseif ($vencido): ?>
                                    <span class="badge bg-danger">Vencido</span>
                                <?php else: ?>
                                    <span class="badge bg-warning text-dark">Pendiente</span>
                                <?php endif; ?>
                                <?php if (!$cumple && !$vencido): ?>
                                    <a href="vocero_evidencias.php?asig=<?= $a['id_asignacion'] ?>"
                                       class="btn btn-sm btn-success py-0 px-2" style="font-size:.75rem;">
                                        <i class="fas fa-upload me-1"></i>Subir evidencia
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </li>
                    <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Últimas evidencias -->
    <div class="col-lg-5">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-0 py-3">
                <h6 class="fw-bold mb-0"><i class="fas fa-clock-rotate-left text-success me-2"></i>Últimas Evidencias</h6>
            </div>
            <div class="card-body">
                <?php if (empty($ultimasEv)): ?>
                    <p class="text-muted small text-center py-3">Aún no has subido evidencias.</p>
                <?php else: ?>
                    <div class="row g-2">
                    <?php foreach ($ultimasEv as $ev): ?>
                    <div class="col-6">
                        <div class="position-relative" style="border-radius:8px; overflow:hidden; border:1px solid #e5e7eb;">
                            <img src="../../public/<?= htmlspecialchars($ev['ruta_archivo']) ?>"
                                 alt="Evidencia"
                                 style="width:100%; height:80px; object-fit:cover;">
                            <div style="position:absolute; bottom:0; left:0; right:0; background:rgba(0,0,0,.6); color:#fff; font-size:.65rem; padding:3px 6px;">
                                <?= htmlspecialchars($ev['modulo']) ?><br>
                                <?= date('d/m/Y', strtotime($ev['fecha_subida'])) ?>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                    </div>
                    <a href="vocero_evidencias.php" class="btn btn-sm btn-outline-success w-100 mt-3">Ver todas</a>
                <?php endif; ?>
            </div>
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
