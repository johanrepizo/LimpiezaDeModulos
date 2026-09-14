<?php
$titulo = 'Fichas';
if (session_status() === PHP_SESSION_NONE) session_start();
if (!isset($_SESSION['usuario']) || (int)$_SESSION['usuario']['rol'] !== 1) {
    header("Location: ../usuarios/login.php"); exit;
}
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../models/Ficha.php';
require_once __DIR__ . '/../../models/Programa.php';

$db       = (new Database())->conectar();
$fichas   = (new Ficha($db))->obtenerTodas();
$programas = (new Programa($db))->obtenerTodos();
$alert    = $_SESSION['alert'] ?? null;
unset($_SESSION['alert']);

// Detalle de ficha solicitado
$fichaDetalle   = null;
$aprendicesDet  = [];
if (!empty($_GET['ficha'])) {
    $fichaModel   = new Ficha($db);
    $fichaDetalle = $fichaModel->obtenerPorId((int)$_GET['ficha']);
    if ($fichaDetalle) {
        $aprendicesDet = $fichaModel->obtenerAprendicesDeFicha((int)$_GET['ficha']);
    }
}

require_once __DIR__ . '/../layouts/header.php';
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-0"><i class="fas fa-id-card text-success me-2"></i>Fichas</h4>
        <p class="text-muted small mb-0">Gestiona las fichas del centro de formación</p>
    </div>
    <button class="btn btn-success btn-sm fw-semibold" data-bs-toggle="modal" data-bs-target="#modalFicha">
        <i class="fas fa-plus me-1"></i> Nueva Ficha
    </button>
</div>

<!-- Buscador -->
<div class="card shadow-sm mb-3">
    <div class="card-body py-2">
        <div class="input-group input-group-sm" style="max-width:380px;">
            <span class="input-group-text bg-white"><i class="fas fa-search text-muted"></i></span>
            <input type="text" id="buscador" class="form-control border-start-0"
                   placeholder="Buscar por número de ficha o programa…">
        </div>
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table tabla-limpia align-middle mb-0" id="tblFichas">
                <thead class="table-light">
                    <tr>
                        <th>N° Ficha</th>
                        <th>Programa</th>
                        <th>Jornada</th>
                        <th>Aprendices</th>
                        <th>Vocero</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($fichas as $f): ?>
                <tr>
                    <td>
                        <a href="?ficha=<?= $f['id_ficha'] ?>"
                           class="fw-bold text-decoration-none text-success font-monospace">
                            <?= htmlspecialchars($f['numero_ficha']) ?>
                        </a>
                    </td>
                    <td class="small"><?= htmlspecialchars(substr($f['nombre_programa'], 0, 35)) ?>…</td>
                    <td><span class="badge bg-light text-dark border"><?= htmlspecialchars($f['jornada']) ?></span></td>
                    <td class="small"><?= (int)$f['total_aprendices'] ?></td>
                    <td class="small">
                        <?php if ($f['vocero_nombres']): ?>
                            <?= htmlspecialchars($f['vocero_nombres'] . ' ' . $f['vocero_apellidos']) ?>
                        <?php else: ?>
                            <span class="text-muted">Sin asignar</span>
                        <?php endif; ?>
                    </td>
                    <td><span class="badge <?= $f['activo'] ? 'bg-success' : 'bg-secondary' ?>"><?= $f['activo'] ? 'Activa' : 'Inactiva' ?></span></td>
                    <td>
                        <div class="d-flex gap-1">
                            <button class="btn btn-sm btn-outline-primary"
                                    onclick='editarFicha(<?= json_encode($f) ?>)' title="Editar">
                                <i class="fas fa-pen"></i>
                            </button>
                            <a href="?ficha=<?= $f['id_ficha'] ?>" class="btn btn-sm btn-outline-success" title="Ver aprendices">
                                <i class="fas fa-users"></i>
                            </a>
                            <form action="../../controllers/AdminController.php" method="POST" class="d-inline">
                                <input type="hidden" name="accion"    value="eliminar_ficha">
                                <input type="hidden" name="id_ficha"  value="<?= $f['id_ficha'] ?>">
                                <button type="submit" class="btn btn-sm btn-outline-danger"
                                        onclick="return confirm('¿Eliminar esta ficha?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php if (empty($fichas)): ?>
                <tr><td colspan="7" class="text-center text-muted py-5">No hay fichas registradas.</td></tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Panel de aprendices de la ficha seleccionada -->
<?php if ($fichaDetalle): ?>
<div class="card shadow-sm mt-4" style="border-top:3px solid #39a900;">
    <div class="card-header bg-white border-0 py-3 d-flex justify-content-between align-items-center">
        <h6 class="fw-bold mb-0">
            <i class="fas fa-users text-success me-2"></i>
            Aprendices – Ficha <span class="font-monospace"><?= htmlspecialchars($fichaDetalle['numero_ficha']) ?></span>
            <span class="text-muted fw-normal small ms-2"><?= htmlspecialchars($fichaDetalle['nombre_programa']) ?></span>
        </h6>
        <div class="d-flex gap-2 align-items-center">
            <span class="badge bg-success"><?= count($aprendicesDet) ?> aprendice(s)</span>
            <a href="admin_fichas.php" class="btn btn-sm btn-outline-secondary">
                <i class="fas fa-times"></i>
            </a>
        </div>
    </div>
    <div class="card-body p-0">
        <?php if (empty($aprendicesDet)): ?>
            <div class="text-center py-5 text-muted small">Sin aprendices sincronizados para esta ficha.</div>
        <?php else: ?>
        <div class="p-3">
            <input type="text" id="buscAp" class="form-control form-control-sm mb-3"
                   style="max-width:300px;" placeholder="Buscar aprendiz…">
        </div>
        <div class="table-responsive">
            <table class="table tabla-limpia align-middle mb-0" id="tblApDet">
                <thead class="table-light">
                    <tr><th>#</th><th>Apellidos</th><th>Nombres</th><th>Documento</th></tr>
                </thead>
                <tbody>
                <?php foreach ($aprendicesDet as $i => $ap): ?>
                <tr>
                    <td class="text-muted small"><?= $i + 1 ?></td>
                    <td class="fw-semibold small"><?= htmlspecialchars($ap['apellidos']) ?></td>
                    <td class="small"><?= htmlspecialchars($ap['nombres']) ?></td>
                    <td class="small text-muted"><?= htmlspecialchars($ap['documento'] ?? '—') ?></td>
                </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php endif; ?>
    </div>
</div>
<?php endif; ?>

<!-- Modal Ficha -->
<div class="modal fade" id="modalFicha" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content shadow">
            <div class="modal-header" style="background:#0f2200; color:#fff;">
                <h6 class="modal-title fw-bold" id="titModalFicha">
                    <i class="fas fa-id-card me-2 text-success"></i>Nueva Ficha
                </h6>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form action="../../controllers/AdminController.php" method="POST">
                <input type="hidden" name="accion"    value="guardar_ficha">
                <input type="hidden" name="id_ficha"  id="id_ficha" value="">
                <div class="modal-body px-4 py-4">
                    <div class="mb-3">
                        <label class="form-label fw-semibold small">Programa de Formación <span class="text-danger">*</span></label>
                        <select name="id_programa" id="fic_prog" class="form-select" required>
                            <option value="">-- Seleccionar --</option>
                            <?php foreach ($programas as $p): ?>
                            <option value="<?= $p['id_programa'] ?>"><?= htmlspecialchars($p['nombre']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold small">Número de Ficha <span class="text-danger">*</span></label>
                        <input type="text" name="numero_ficha" id="fic_num" class="form-control" required
                               placeholder="Ej: 2795681">
                    </div>
                    <div class="row g-3">
                        <div class="col-6">
                            <label class="form-label fw-semibold small">Jornada</label>
                            <select name="jornada" id="fic_jornada" class="form-select">
                                <option value="Diurna">Diurna</option>
                                <option value="Nocturna">Nocturna</option>
                                <option value="Mixta">Mixta</option>
                            </select>
                        </div>
                        <div class="col-6">
                            <label class="form-label fw-semibold small">N° Aprendices</label>
                            <input type="number" name="num_aprendices" id="fic_apren" class="form-control" min="1" placeholder="30">
                        </div>
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

<?php if ($alert): ?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    Swal.fire({ icon:'<?= addslashes($alert['icon']) ?>', title:'<?= addslashes($alert['title']) ?>', text:'<?= addslashes($alert['text']) ?>', confirmButtonColor:'#39a900' });
});
</script>
<?php endif; ?>

<script>
document.getElementById('buscador').addEventListener('input', function() {
    const q = this.value.toLowerCase();
    document.querySelectorAll('#tblFichas tbody tr').forEach(tr => {
        tr.style.display = !q || tr.textContent.toLowerCase().includes(q) ? '' : 'none';
    });
});

<?php if ($fichaDetalle): ?>
document.getElementById('buscAp').addEventListener('input', function() {
    const q = this.value.toLowerCase();
    document.querySelectorAll('#tblApDet tbody tr').forEach(tr => {
        tr.style.display = !q || tr.textContent.toLowerCase().includes(q) ? '' : 'none';
    });
});
<?php endif; ?>

function editarFicha(f) {
    document.getElementById('titModalFicha').innerHTML = '<i class="fas fa-pen me-2 text-success"></i>Editar Ficha';
    document.getElementById('id_ficha').value     = f.id_ficha;
    document.getElementById('fic_prog').value     = f.id_programa;
    document.getElementById('fic_num').value      = f.numero_ficha;
    document.getElementById('fic_jornada').value  = f.jornada;
    document.getElementById('fic_apren').value    = f.num_aprendices || '';
    new bootstrap.Modal(document.getElementById('modalFicha')).show();
}
</script>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
