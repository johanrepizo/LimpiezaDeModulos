<?php
$titulo = 'Mis Grupos de Limpieza';
if (session_status() === PHP_SESSION_NONE) session_start();
if (!isset($_SESSION['usuario']) || (int)$_SESSION['usuario']['rol'] !== 2) {
    header("Location: ../usuarios/login.php"); exit;
}
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../models/Grupo.php';
require_once __DIR__ . '/../../models/Ficha.php';

$db     = (new Database())->conectar();
$alert  = $_SESSION['alert'] ?? null;
unset($_SESSION['alert']);

$idUsuario = (int)$_SESSION['usuario']['id_usuario'];
$stmtV     = $db->prepare("SELECT * FROM voceros WHERE id_usuario=:id AND activo=1 LIMIT 1");
$stmtV->execute([':id' => $idUsuario]);
$vocero    = $stmtV->fetch(PDO::FETCH_ASSOC);
$idVocero  = $vocero ? (int)$vocero['id_vocero'] : 0;
$idFicha   = $vocero ? (int)$vocero['id_ficha']  : 0;

$grupos = (new Grupo($db))->obtenerPorVocero($idVocero);

// Asignación activa de la ficha (solo puede haber UNA)
$stmtAsig = $db->prepare(
    "SELECT a.*, m.nombre AS nombre_modulo, m.ubicacion,
            f.numero_ficha
     FROM asignaciones a
     JOIN modulos m ON m.id_modulo = a.id_modulo
     JOIN fichas  f ON f.id_ficha  = a.id_ficha
     WHERE a.id_ficha = :fic AND a.estado = 'Activa'
     ORDER BY a.fecha_creacion DESC LIMIT 1"
);
$stmtAsig->execute([':fic' => $idFicha]);
$asignacion = $stmtAsig->fetch(PDO::FETCH_ASSOC);

// Próxima fecha libre (turno sin grupo) para mostrar en el modal
$modelTurno    = new \stdClass(); // placeholder
require_once __DIR__ . '/../../models/Turno.php';
$modelTurno      = new Turno($db);
$proximaFecha    = $asignacion ? $modelTurno->proximaFechaLibre((int)$asignacion['id_asignacion']) : false;
$turnosRestantes = $asignacion ? $modelTurno->turnosLibresRestantes((int)$asignacion['id_asignacion']) : 0;

$diasES = ['Domingo','Lunes','Martes','Miércoles','Jueves','Viernes','Sábado'];

// Aprendices de la ficha
$aprendices = (new Ficha($db))->obtenerAprendicesDeFicha($idFicha);

require_once __DIR__ . '/../layouts/header.php';
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-0"><i class="fas fa-people-group text-success me-2"></i>Mis Grupos de Limpieza</h4>
        <p class="text-muted small mb-0">Registra y gestiona los grupos responsables de la limpieza</p>
    </div>
    <button class="btn btn-success btn-sm fw-semibold" data-bs-toggle="modal" data-bs-target="#modalGrupo">
        <i class="fas fa-plus me-1"></i> Nuevo Grupo
    </button>
</div>

<!-- Módulo activo de la ficha -->
<?php if ($asignacion): ?>
<div class="card border-0 shadow-sm mb-3"
     style="border-left:4px solid #39a900; background:linear-gradient(135deg,#f0fff4,#fff);">
    <div class="card-body py-3 px-4 d-flex align-items-center gap-3 flex-wrap">
        <div style="width:42px;height:42px;border-radius:10px;background:#39a900;
                    color:#fff;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
            <i class="fas fa-door-open"></i>
        </div>
        <div class="flex-grow-1">
            <div class="text-muted" style="font-size:.72rem;text-transform:uppercase;letter-spacing:.4px;">
                Módulo asignado a tu ficha
            </div>
            <div class="fw-bold"><?= htmlspecialchars($asignacion['nombre_modulo']) ?></div>
            <?php if ($asignacion['ubicacion']): ?>
            <div class="text-muted small">
                <i class="fas fa-location-dot me-1"></i><?= htmlspecialchars($asignacion['ubicacion']) ?>
            </div>
            <?php endif; ?>
        </div>
        <!-- Próxima fecha libre -->
        <div class="text-center px-3 py-2 rounded-3" style="background:rgba(57,169,0,.08); border:1px solid rgba(57,169,0,.2);">
            <div class="text-muted" style="font-size:.7rem;text-transform:uppercase;letter-spacing:.4px;">Próxima limpieza</div>
            <?php if ($proximaFecha): ?>
                <div class="fw-bold text-success" style="font-size:1rem;">
                    <?= date('d/m/Y', strtotime($proximaFecha)) ?>
                </div>
                <div class="text-muted" style="font-size:.75rem;">
                    <?= $diasES[(int)(new DateTime($proximaFecha))->format('w')] ?>
                </div>
            <?php else: ?>
                <div class="text-muted small">Sin turnos<br>pendientes</div>
            <?php endif; ?>
        </div>
        <div class="text-center px-3 py-2 rounded-3" style="background:rgba(37,99,235,.06); border:1px solid rgba(37,99,235,.15);">
            <div class="text-muted" style="font-size:.7rem;text-transform:uppercase;letter-spacing:.4px;">Turnos sin grupo</div>
            <div class="fw-bold" style="font-size:1rem; color:#2563eb;"><?= $turnosRestantes ?></div>
            <div class="text-muted" style="font-size:.75rem;">disponibles</div>
        </div>
        <div class="text-end">
            <div class="text-muted" style="font-size:.72rem;">Cada</div>
            <div class="fw-bold small">
                <?= $diasES[(int)($asignacion['dia_semana'] ?? 0)] ?>
            </div>
            <div class="text-muted" style="font-size:.72rem;">
                <?= date('d/m/Y', strtotime($asignacion['fecha_inicio'])) ?>
                → <?= date('d/m/Y', strtotime($asignacion['fecha_fin'])) ?>
            </div>
        </div>
    </div>
</div>
<?php else: ?>
<div class="alert alert-warning border-0 shadow-sm mb-3 py-2 small">
    <i class="fas fa-triangle-exclamation me-1"></i>
    Tu ficha no tiene ningún módulo asignado todavía. Cuando el administrador asigne uno,
    aparecerá aquí y podrás crear grupos de limpieza.
</div>
<?php endif; ?>

<div class="card shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table tabla-limpia align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Nombre del Grupo</th>
                        <th>Módulo</th>
                        <th>Fecha Limpieza</th>
                        <th>Evidencia</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($grupos as $g):
                    $vencido  = strtotime($g['fecha_limpieza']) < strtotime('today');
                    $esHoy    = date('Y-m-d', strtotime($g['fecha_limpieza'])) === date('Y-m-d');
                    $badgeEst = match($g['estado']) { 'Completado' => 'bg-primary', 'Sancionado' => 'bg-danger', default => 'bg-success' };
                ?>
                <tr>
                    <td class="fw-semibold small"><?= htmlspecialchars($g['nombre_grupo']) ?></td>
                    <td class="small"><?= htmlspecialchars($g['nombre_modulo']) ?></td>
                    <td class="small">
                        <div class="fw-semibold <?= $esHoy ? 'text-success' : ($vencido ? 'text-muted' : '') ?>">
                            <?= date('d/m/Y', strtotime($g['fecha_limpieza'])) ?>
                            <?php if ($esHoy): ?>
                                <span class="badge bg-success ms-1" style="font-size:.65rem;">Hoy</span>
                            <?php endif; ?>
                        </div>
                        <div class="text-muted" style="font-size:.73rem;">
                            <?= $diasES[(int)(new DateTime($g['fecha_limpieza']))->format('w')] ?>
                        </div>
                    </td>
                    <td>
                        <?php if ((int)$g['tiene_evidencia'] > 0): ?>
                            <span class="badge bg-success"><i class="fas fa-check me-1"></i>Entregada</span>
                        <?php elseif ($vencido): ?>
                            <span class="badge bg-danger">Sin evidencia</span>
                        <?php elseif ($esHoy): ?>
                            <span class="badge bg-warning text-dark">Entregar hoy</span>
                        <?php else: ?>
                            <span class="badge bg-light text-dark border">Pendiente</span>
                        <?php endif; ?>
                    </td>
                    <td><span class="badge <?= $badgeEst ?>"><?= $g['estado'] ?></span></td>
                    <td>
                        <div class="d-flex gap-1">
                            <?php if (!$vencido && (int)$g['tiene_evidencia'] === 0): ?>
                            <button class="btn btn-sm btn-outline-primary"
                                    onclick='abrirEdicion(<?= json_encode($g) ?>)'
                                    title="Editar integrantes">
                                <i class="fas fa-pen"></i>
                            </button>
                            <form action="../../controllers/VoceroController.php" method="POST" class="d-inline">
                                <input type="hidden" name="accion"   value="eliminar_grupo">
                                <input type="hidden" name="id_grupo" value="<?= $g['id_grupo'] ?>">
                                <button type="submit" class="btn btn-sm btn-outline-danger"
                                        onclick="return confirm('¿Eliminar este grupo?')" title="Eliminar">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                            <?php endif; ?>
                            <?php if ($esHoy && (int)$g['tiene_evidencia'] === 0): ?>
                            <a href="vocero_subir_evidencia.php"
                               class="btn btn-sm btn-success fw-semibold" title="Subir evidencia de hoy">
                                <i class="fas fa-camera me-1"></i>Subir
                            </a>
                            <?php endif; ?>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php if (empty($grupos)): ?>
                <tr>
                    <td colspan="7" class="text-center text-muted py-5">
                        <i class="fas fa-people-group fa-2x mb-2 opacity-25 d-block"></i>
                        No has registrado ningún grupo de limpieza aún.
                    </td>
                </tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Crear/Editar Grupo -->
<div class="modal fade" id="modalGrupo" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content shadow">
            <div class="modal-header" style="background:#0f2200; color:#fff;">
                <h6 class="modal-title fw-bold" id="titModalGrupo">
                    <i class="fas fa-people-group me-2 text-success"></i>Nuevo Grupo de Limpieza
                </h6>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form action="../../controllers/VoceroController.php" method="POST" id="formGrupo">
                <input type="hidden" name="accion"        id="accionGrupo"  value="guardar_grupo">
                <input type="hidden" name="id_grupo"      id="id_grupo"     value="">
                <!-- id_asignacion viene automático del único módulo activo de la ficha -->
                <input type="hidden" name="id_asignacion" value="<?= $asignacion ? $asignacion['id_asignacion'] : '' ?>">

                <div class="modal-body px-4 py-4">

                    <?php if ($asignacion): ?>
                    <!-- Info del módulo asignado (solo lectura) -->
                    <div class="rounded-3 p-3 mb-3 d-flex align-items-center gap-3"
                         style="background:#f0fff4; border:1px solid #86efac;">
                        <div style="width:40px;height:40px;border-radius:10px;background:#39a900;
                                    color:#fff;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                            <i class="fas fa-door-open"></i>
                        </div>
                        <div>
                            <div class="text-muted" style="font-size:.72rem;text-transform:uppercase;letter-spacing:.4px;">
                                Módulo asignado a tu ficha
                            </div>
                            <div class="fw-bold"><?= htmlspecialchars($asignacion['nombre_modulo']) ?></div>
                            <?php if ($asignacion['ubicacion']): ?>
                            <div class="text-muted" style="font-size:.75rem;">
                                <i class="fas fa-location-dot me-1"></i><?= htmlspecialchars($asignacion['ubicacion']) ?>
                            </div>
                            <?php endif; ?>
                        </div>
                        <div class="ms-auto text-end">
                            <div class="text-muted" style="font-size:.72rem;">Período</div>
                            <div class="small fw-semibold">
                                <?= date('d/m/Y', strtotime($asignacion['fecha_inicio'])) ?>
                                →
                                <?= date('d/m/Y', strtotime($asignacion['fecha_fin'])) ?>
                            </div>
                        </div>
                    </div>
                    <?php else: ?>
                    <div class="alert alert-warning py-2 small mb-3">
                        <i class="fas fa-triangle-exclamation me-1"></i>
                        Tu ficha no tiene ningún módulo asignado activo. Contacta al administrador.
                    </div>
                    <?php endif; ?>

                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label fw-semibold small">
                                Nombre del Grupo <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="nombre_grupo" id="grp_nombre"
                                   class="form-control" required placeholder="Ej: Grupo Alpha">
                        </div>

                        <!-- Fecha asignada automáticamente -->
                        <?php if ($proximaFecha): ?>
                        <div class="col-12">
                            <div class="rounded-3 p-3 d-flex align-items-center gap-3"
                                 style="background:#f0f9ff; border:1px solid #bae6fd;">
                                <div style="width:38px;height:38px;border-radius:8px;background:#0284c7;
                                            color:#fff;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                                    <i class="fas fa-calendar-check"></i>
                                </div>
                                <div>
                                    <div class="text-muted" style="font-size:.72rem;text-transform:uppercase;letter-spacing:.4px;">
                                        Fecha de limpieza asignada automáticamente
                                    </div>
                                    <div class="fw-bold" style="color:#0369a1;">
                                        <?= date('d/m/Y', strtotime($proximaFecha)) ?>
                                        <span class="fw-normal text-muted ms-1" style="font-size:.85rem;">
                                            (<?= $diasES[(int)(new DateTime($proximaFecha))->format('w')] ?>)
                                        </span>
                                    </div>
                                    <div class="text-muted" style="font-size:.75rem;">
                                        Corresponde al siguiente turno libre del módulo
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php else: ?>
                        <div class="col-12">
                            <div class="alert alert-danger py-2 small mb-0">
                                <i class="fas fa-ban me-1"></i>
                                No hay turnos de limpieza disponibles. Todos los turnos ya tienen grupo asignado o el período finalizó.
                            </div>
                        </div>
                        <?php endif; ?>

                        <div class="col-12">
                            <label class="form-label fw-semibold small">
                                Integrantes <span class="text-danger">*</span>
                                <span class="text-muted fw-normal">(selecciona de tu ficha)</span>
                            </label>
                            <?php if (empty($aprendices)): ?>
                                <div class="alert alert-warning py-2 small">
                                    No hay aprendices sincronizados en tu ficha.
                                </div>
                            <?php else: ?>
                            <div style="max-height:220px; overflow-y:auto; border:1px solid #dee2e6;
                                        border-radius:8px; padding:.5rem;">
                                <?php foreach ($aprendices as $ap): ?>
                                <div class="form-check py-1">
                                    <input class="form-check-input" type="checkbox"
                                           name="aprendices[]" value="<?= $ap['id_aprendiz'] ?>"
                                           id="ap_<?= $ap['id_aprendiz'] ?>">
                                    <label class="form-check-label small" for="ap_<?= $ap['id_aprendiz'] ?>">
                                        <?= htmlspecialchars($ap['apellidos'] . ', ' . $ap['nombres']) ?>
                                        <?php if ($ap['documento']): ?>
                                            <span class="text-muted"> — <?= htmlspecialchars($ap['documento']) ?></span>
                                        <?php endif; ?>
                                    </label>
                                </div>
                                <?php endforeach; ?>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <div class="modal-footer px-4">
                    <button type="button" class="btn btn-sm btn-outline-secondary"
                            data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-sm btn-success fw-semibold px-4"
                            <?= (!$asignacion || !$proximaFecha) ? 'disabled' : '' ?>>
                        <i class="fas fa-save me-1"></i>Guardar Grupo
                    </button>
                </div>
            </form>
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

<script>
function abrirEdicion(g) {
    document.getElementById('titModalGrupo').innerHTML = '<i class="fas fa-pen me-2 text-success"></i>Editar Grupo';
    document.getElementById('accionGrupo').value = 'editar_grupo';
    document.getElementById('id_grupo').value    = g.id_grupo;
    document.getElementById('grp_nombre').value  = g.nombre_grupo;
    document.getElementById('grp_fecha').value   = g.fecha_limpieza;
    new bootstrap.Modal(document.getElementById('modalGrupo')).show();
}

document.getElementById('modalGrupo').addEventListener('hidden.bs.modal', function() {
    document.getElementById('titModalGrupo').innerHTML = '<i class="fas fa-people-group me-2 text-success"></i>Nuevo Grupo de Limpieza';
    document.getElementById('accionGrupo').value = 'guardar_grupo';
    document.getElementById('id_grupo').value    = '';
    document.getElementById('grp_nombre').value  = '';
    document.getElementById('grp_fecha').value   = '';
    document.querySelectorAll('#formGrupo input[type=checkbox]').forEach(cb => cb.checked = false);
});
</script>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
