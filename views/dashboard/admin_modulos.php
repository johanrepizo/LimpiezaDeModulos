<?php
$titulo = 'Módulos y Asignaciones';
if (session_status() === PHP_SESSION_NONE) session_start();
if (!isset($_SESSION['usuario']) || (int)$_SESSION['usuario']['rol'] !== 1) {
    header("Location: ../usuarios/login.php"); exit;
}
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../models/Modulo.php';
require_once __DIR__ . '/../../models/Ficha.php';

$db       = (new Database())->conectar();
$modModel = new Modulo($db);
$ficModel = new Ficha($db);

$modulos      = $modModel->obtenerTodos();
$fichas       = $ficModel->obtenerTodas();
$asignaciones = $modModel->obtenerAsignaciones();
$alert        = $_SESSION['alert'] ?? null;
unset($_SESSION['alert']);

require_once __DIR__ . '/../layouts/header.php';
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-0"><i class="fas fa-door-open text-success me-2"></i>Módulos y Asignaciones</h4>
        <p class="text-muted small mb-0">Inventario de módulos y control de asignaciones por ficha</p>
    </div>
    <div class="d-flex gap-2">
        <button class="btn btn-outline-success btn-sm" data-bs-toggle="modal" data-bs-target="#modalModulo">
            <i class="fas fa-plus me-1"></i> Nuevo Módulo
        </button>
        <button class="btn btn-success btn-sm fw-semibold" data-bs-toggle="modal" data-bs-target="#modalAsignacion">
            <i class="fas fa-link me-1"></i> Asignar Módulo
        </button>
    </div>
</div>

<!-- ── TABS ── -->
<ul class="nav nav-tabs mb-0" id="tabsModulos">
    <li class="nav-item">
        <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#tabModulos">
            <i class="fas fa-door-open me-1"></i>Módulos (<?= count($modulos) ?>)
        </button>
    </li>
    <li class="nav-item">
        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#tabAsignaciones">
            <i class="fas fa-link me-1"></i>Asignaciones (<?= count($asignaciones) ?>)
        </button>
    </li>
</ul>

<div class="tab-content">

    <!-- Tab Módulos -->
    <div class="tab-pane fade show active" id="tabModulos">
        <div class="card shadow-sm rounded-top-0">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table tabla-limpia align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Nombre</th>
                                <th>Ubicación</th>
                                <th>Capacidad</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($modulos as $m): ?>
                        <tr>
                            <td class="fw-semibold small"><?= htmlspecialchars($m['nombre']) ?></td>
                            <td class="small text-muted"><?= htmlspecialchars($m['ubicacion'] ?? '—') ?></td>
                            <td class="small"><?= $m['capacidad'] ? $m['capacidad'] . ' personas' : '—' ?></td>
                            <td>
                                <?php if ($m['id_asignacion']): ?>
                                    <span class="badge bg-warning text-dark">Asignado</span>
                                <?php else: ?>
                                    <span class="badge bg-success">Disponible</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <button class="btn btn-sm btn-outline-primary"
                                        onclick='editarModulo(<?= json_encode($m) ?>)' title="Editar">
                                    <i class="fas fa-pen"></i>
                                </button>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        <?php if (empty($modulos)): ?>
                        <tr><td colspan="5" class="text-center text-muted py-5">No hay módulos registrados.</td></tr>
                        <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Tab Asignaciones -->
    <div class="tab-pane fade" id="tabAsignaciones">
        <div class="card shadow-sm rounded-top-0">
            <!-- Aviso regla -->
            <div class="px-4 py-2" style="background:#eff6ff; border-bottom:1px solid #bfdbfe; font-size:.8rem; color:#1d4ed8;">
                <i class="fas fa-circle-info me-1"></i>
                <strong>Regla:</strong> Cada ficha solo puede tener <strong>un módulo activo</strong> a la vez.
                Los grupos de esa ficha limpian ese módulo en rotación semanal —
                semana 1 → Grupo A, semana 2 → Grupo B, y así sucesivamente.
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table tabla-limpia align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Módulo</th>
                                <th>Ficha</th>
                                <th>Programa</th>
                                <th>Vocero</th>
                                <th class="text-center">Día rotación</th>
                                <th>Período</th>
                                <th>Estado</th>
                                <th class="text-center">Evid.</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        $diasES = ['Dom','Lun','Mar','Mié','Jue','Vie','Sáb'];
                        foreach ($asignaciones as $a):
                            $badgeAsig = match($a['estado']) {
                                'Activa'     => 'bg-success',
                                'Completada' => 'bg-primary',
                                'Vencida'    => 'bg-danger',
                                'Cancelada'  => 'bg-secondary',
                                default      => 'bg-secondary',
                            };
                            $editable  = $a['estado'] === 'Activa';
                            $diaNombre = $diasES[(int)($a['dia_semana'] ?? 0)];
                        ?>
                        <tr>
                            <td class="fw-semibold small"><?= htmlspecialchars($a['nombre_modulo']) ?></td>
                            <td><span class="badge bg-light text-dark border font-monospace"><?= htmlspecialchars($a['numero_ficha']) ?></span></td>
                            <td class="small text-muted"><?= htmlspecialchars(substr($a['nombre_programa'], 0, 22)) ?>…</td>
                            <td class="small"><?= htmlspecialchars(trim(($a['vocero_nombres'] ?? '') . ' ' . ($a['vocero_apellidos'] ?? ''))) ?: '<span class="text-muted">—</span>' ?></td>
                            <td class="text-center">
                                <span class="badge" style="background:#eef2ff;color:#4f46e5;font-size:.8rem;padding:.35rem .75rem;">
                                    <i class="fas fa-rotate me-1"></i><?= $diaNombre ?>s
                                </span>
                            </td>
                            <td class="small text-muted text-nowrap">
                                <?= date('d/m/Y', strtotime($a['fecha_inicio'])) ?> → <?= date('d/m/Y', strtotime($a['fecha_fin'])) ?>
                            </td>
                            <td><span class="badge <?= $badgeAsig ?>"><?= $a['estado'] ?></span></td>
                            <td class="text-center small"><?= (int)$a['total_evidencias'] ?></td>
                            <td>
                                <div class="d-flex gap-1">
                                    <?php if ($editable): ?>
                                    <button class="btn btn-sm btn-outline-primary"
                                            onclick='abrirEditarAsignacion(<?= json_encode($a) ?>)'
                                            title="Editar asignación">
                                        <i class="fas fa-pen"></i>
                                    </button>
                                    <form action="../../controllers/AdminController.php" method="POST"
                                          class="d-inline" id="form-cancel-<?= $a['id_asignacion'] ?>">
                                        <input type="hidden" name="accion"        value="cancelar_asignacion">
                                        <input type="hidden" name="id_asignacion" value="<?= $a['id_asignacion'] ?>">
                                        <button type="button" class="btn btn-sm btn-outline-danger"
                                                onclick="confirmarCancelarAsignacion(<?= $a['id_asignacion'] ?>)"
                                                title="Cancelar asignación">
                                            <i class="fas fa-ban"></i>
                                        </button>
                                    </form>
                                    <?php else: ?>
                                    <span class="text-muted small">—</span>
                                    <?php endif; ?>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        <?php if (empty($asignaciones)): ?>
                        <tr><td colspan="9" class="text-center text-muted py-5">No hay asignaciones registradas.</td></tr>
                        <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div><!-- /tab-content -->

<!-- Modal Módulo -->
<div class="modal fade" id="modalModulo" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content shadow">
            <div class="modal-header" style="background:#0f2200; color:#fff;">
                <h6 class="modal-title fw-bold" id="titModalModulo"><i class="fas fa-door-open me-2 text-success"></i>Nuevo Módulo</h6>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form action="../../controllers/AdminController.php" method="POST">
                <input type="hidden" name="accion"    value="guardar_modulo">
                <input type="hidden" name="id_modulo" id="id_modulo" value="">
                <div class="modal-body px-4 py-4">
                    <div class="mb-3">
                        <label class="form-label fw-semibold small">Nombre del Módulo <span class="text-danger">*</span></label>
                        <input type="text" name="nombre" id="mod_nombre" class="form-control" required placeholder="Ej: Módulo 12 – Sistemas">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold small">Ubicación</label>
                        <input type="text" name="ubicacion" id="mod_ubicacion" class="form-control" placeholder="Ej: Bloque B, Piso 2">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold small">Capacidad (personas)</label>
                        <input type="number" name="capacidad" id="mod_capacidad" class="form-control" min="1" placeholder="30">
                    </div>
                    <div class="mb-1">
                        <label class="form-label fw-semibold small">Descripción</label>
                        <textarea name="descripcion" id="mod_desc" class="form-control" rows="2" placeholder="Descripción opcional…"></textarea>
                    </div>
                </div>
                <div class="modal-footer px-4">
                    <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-sm btn-success fw-semibold px-4"><i class="fas fa-save me-1"></i>Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Asignación -->
<div class="modal fade" id="modalAsignacion" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content shadow">
            <div class="modal-header" style="background:#0f2200; color:#fff;">
                <h6 class="modal-title fw-bold"><i class="fas fa-link me-2 text-success"></i>Asignar Módulo a Ficha</h6>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form action="../../controllers/AdminController.php" method="POST">
                <input type="hidden" name="accion" value="asignar_modulo">
                <div class="modal-body px-4 py-4">
                    <div class="mb-3">
                        <label class="form-label fw-semibold small">Módulo <span class="text-danger">*</span></label>
                        <select name="id_modulo" class="form-select" required>
                            <option value="">-- Seleccionar módulo --</option>
                            <?php foreach ($modulos as $m): ?>
                            <option value="<?= $m['id_modulo'] ?>"><?= htmlspecialchars($m['nombre']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold small">Ficha <span class="text-danger">*</span></label>
                        <select name="id_ficha" class="form-select" required>
                            <option value="">-- Seleccionar ficha --</option>
                            <?php foreach ($fichas as $f): ?>
                            <option value="<?= $f['id_ficha'] ?>"><?= htmlspecialchars($f['numero_ficha'] . ' – ' . $f['nombre_programa']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-1">
                        <label class="form-label fw-semibold small">
                            Fecha de inicio de limpieza <span class="text-danger">*</span>
                        </label>
                        <input type="date" name="fecha_inicio" id="asig_fecha_inicio"
                               class="form-control" required
                               min="<?= date('Y-m-d') ?>">
                        <div class="form-text" style="color:#4f46e5; font-size:.8rem;">
                            <i class="fas fa-rotate me-1"></i>
                            Según este día de la semana se programará la limpieza <strong>cada semana</strong> de forma automática.
                            Por ejemplo, si eliges un miércoles, la limpieza será todos los miércoles.
                        </div>
                    </div>
                </div>
                <div class="modal-footer px-4">
                    <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-sm btn-success fw-semibold px-4"><i class="fas fa-link me-1"></i>Asignar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Editar Asignación -->
<div class="modal fade" id="modalEditarAsig" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content shadow">
            <div class="modal-header" style="background:#0f2200; color:#fff;">
                <h6 class="modal-title fw-bold">
                    <i class="fas fa-pen me-2 text-success"></i>Editar Asignación
                </h6>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form action="../../controllers/AdminController.php" method="POST">
                <input type="hidden" name="accion"        value="editar_asignacion">
                <input type="hidden" name="id_asignacion" id="ea_id">
                <div class="modal-body px-4 py-4">

                    <!-- Módulo (solo lectura) -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold small">Módulo</label>
                        <input type="text" id="ea_modulo" class="form-control bg-light" disabled>
                        <div class="form-text text-muted">
                            El módulo no puede cambiarse. Cancela y crea una nueva asignación si necesitas otro módulo.
                        </div>
                    </div>

                    <!-- Ficha -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold small">Ficha <span class="text-danger">*</span></label>
                        <select name="id_ficha" id="ea_ficha" class="form-select" required>
                            <option value="">-- Seleccionar ficha --</option>
                            <?php foreach ($fichas as $f): ?>
                            <option value="<?= $f['id_ficha'] ?>">
                                <?= htmlspecialchars($f['numero_ficha'] . ' – ' . $f['nombre_programa']) ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- Solo fecha de inicio -->
                    <div class="mb-1">
                        <label class="form-label fw-semibold small">
                            Fecha de inicio de limpieza <span class="text-danger">*</span>
                        </label>
                        <input type="date" name="fecha_inicio" id="ea_inicio" class="form-control" required>
                        <div class="form-text" style="color:#4f46e5; font-size:.8rem;">
                            <i class="fas fa-rotate me-1"></i>
                            Según este día de la semana se programará la limpieza <strong>cada semana</strong> de forma automática.
                        </div>
                        <div class="form-text text-warning fw-semibold mt-1">
                            <i class="fas fa-triangle-exclamation me-1"></i>
                            Al guardar, los turnos anteriores se eliminarán y se regenerarán desde la nueva fecha.
                        </div>
                    </div>
                </div>
                <div class="modal-footer px-4">
                    <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-sm btn-success fw-semibold px-4">
                        <i class="fas fa-save me-1"></i>Guardar cambios
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
function confirmarCancelarAsignacion(idAsignacion) {
    Swal.fire({
        title:              '¿Cancelar esta asignación?',
        text:               'Se eliminarán todos los turnos pendientes. Esta acción no se puede deshacer.',
        icon:               'warning',
        showCancelButton:   true,
        confirmButtonText:  'Sí, cancelar asignación',
        cancelButtonText:   'No, mantener',
        confirmButtonColor: '#ef4444',
        cancelButtonColor:  '#6b7280',
    }).then(function(result) {
        if (result.isConfirmed) {
            document.getElementById('form-cancel-' + idAsignacion).submit();
        }
    });
}

function editarModulo(m) {
    document.getElementById('titModalModulo').innerHTML = '<i class="fas fa-pen me-2 text-success"></i>Editar Módulo';
    document.getElementById('id_modulo').value    = m.id_modulo;
    document.getElementById('mod_nombre').value   = m.nombre;
    document.getElementById('mod_ubicacion').value= m.ubicacion  || '';
    document.getElementById('mod_capacidad').value= m.capacidad  || '';
    document.getElementById('mod_desc').value     = m.descripcion|| '';
    new bootstrap.Modal(document.getElementById('modalModulo')).show();
}

document.getElementById('modalModulo').addEventListener('hidden.bs.modal', function() {
    document.getElementById('id_modulo').value     = '';
    document.getElementById('mod_nombre').value    = '';
    document.getElementById('mod_ubicacion').value = '';
    document.getElementById('mod_capacidad').value = '';
    document.getElementById('mod_desc').value      = '';
    document.getElementById('titModalModulo').innerHTML = '<i class="fas fa-door-open me-2 text-success"></i>Nuevo Módulo';
});

function abrirEditarAsignacion(a) {
    document.getElementById('ea_id').value     = a.id_asignacion;
    document.getElementById('ea_modulo').value = a.nombre_modulo;
    document.getElementById('ea_ficha').value  = a.id_ficha;
    document.getElementById('ea_inicio').value = a.fecha_inicio;
    new bootstrap.Modal(document.getElementById('modalEditarAsig')).show();
}
</script>

<style>
.rounded-top-0 { border-top-left-radius:0!important; border-top-right-radius:0!important; }
.nav-tabs .nav-link { font-size:.875rem; color:#64748b; }
.nav-tabs .nav-link.active { color:#39a900; font-weight:600; }
</style>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
