<?php
$titulo = 'Mis Evidencias';
if (session_status() === PHP_SESSION_NONE) session_start();
if (!isset($_SESSION['usuario']) || (int)$_SESSION['usuario']['rol'] !== 2) {
    header("Location: ../usuarios/login.php"); exit;
}

require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../models/Evidencia.php';
require_once __DIR__ . '/../../models/Grupo.php';

$db    = (new Database())->conectar();
$alert = $_SESSION['alert'] ?? null;
unset($_SESSION['alert']);

$idUsuario = (int)$_SESSION['usuario']['id_usuario'];

// Datos del vocero
$stmtV = $db->prepare("SELECT * FROM voceros WHERE id_usuario = :id AND activo = 1 LIMIT 1");
$stmtV->execute([':id' => $idUsuario]);
$vocero   = $stmtV->fetch(PDO::FETCH_ASSOC);
$idVocero = $vocero ? (int)$vocero['id_vocero'] : 0;

// Asignaciones de la ficha (para el selector de módulo)
$stmtAsig = $db->prepare(
    "SELECT a.id_asignacion, m.id_modulo, m.nombre AS nombre_modulo,
            a.fecha_inicio, a.fecha_fin, a.fecha_limite_evidencia, a.estado
     FROM asignaciones a
     JOIN modulos m ON m.id_modulo = a.id_modulo
     WHERE a.id_ficha = :fic
     ORDER BY a.estado DESC, a.fecha_limite_evidencia DESC"
);
$stmtAsig->execute([':fic' => $vocero['id_ficha'] ?? 0]);
$asignaciones = $stmtAsig->fetchAll(PDO::FETCH_ASSOC);

// Filtro por asignación seleccionada
$filtroAsig = (int)($_GET['asig'] ?? 0);

// Grupos del vocero con conteo de evidencias
$sqlGrupos = "SELECT g.id_grupo, g.nombre_grupo, g.fecha_limpieza, g.estado,
                     a.id_asignacion, a.fecha_limite_evidencia,
                     m.nombre AS nombre_modulo,
                     (SELECT COUNT(*) FROM evidencias e WHERE e.id_grupo = g.id_grupo) AS tiene_evidencia
              FROM grupos g
              JOIN asignaciones a ON a.id_asignacion = g.id_asignacion
              JOIN modulos m ON m.id_modulo = a.id_modulo
              WHERE g.id_vocero = :idv";
if ($filtroAsig) $sqlGrupos .= " AND a.id_asignacion = :asig";
$sqlGrupos .= " ORDER BY a.fecha_limite_evidencia DESC, g.fecha_limpieza DESC";
$stmtGrupos = $db->prepare($sqlGrupos);
$paramsGrupos = [':idv' => $idVocero];
if ($filtroAsig) $paramsGrupos[':asig'] = $filtroAsig;
$stmtGrupos->execute($paramsGrupos);
$grupos = $stmtGrupos->fetchAll(PDO::FETCH_ASSOC);

// Historial de evidencias del vocero (con filtro opcional)
$evidencias = (new Evidencia($db))->obtenerPorVocero($idVocero, $filtroAsig ?: null);

// Totales
$totalEv       = count($evidencias);
$totalPendientes = count(array_filter($grupos, fn($g) => (int)$g['tiene_evidencia'] === 0));
$totalVencidos   = count(array_filter($grupos, fn($g) =>
    (int)$g['tiene_evidencia'] === 0 && strtotime($g['fecha_limite_evidencia']) < time()));

require_once __DIR__ . '/../layouts/header.php';
?>

<!-- ══ CABECERA ══════════════════════════════════════════════════════════════ -->
<div class="d-flex justify-content-between align-items-start mb-4 flex-wrap gap-3">
    <div>
        <h4 class="fw-bold mb-1">
            <i class="fas fa-images text-success me-2"></i>Mis Evidencias de Módulos
        </h4>
        <p class="text-muted small mb-0">
            Registra las fotografías que demuestran la limpieza realizada en cada módulo asignado.
        </p>
    </div>
</div>

<!-- ══ STATS ═════════════════════════════════════════════════════════════════ -->
<div class="row g-3 mb-4">
    <div class="col-sm-4">
        <div class="stat-card bg-white">
            <div class="d-flex align-items-center gap-3">
                <div class="stat-icon" style="background:rgba(57,169,0,.12); color:#39a900;">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div>
                    <div class="fs-4 fw-bold"><?= $totalEv ?></div>
                    <div class="text-muted small">Evidencias enviadas</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="stat-card bg-white">
            <div class="d-flex align-items-center gap-3">
                <div class="stat-icon" style="background:rgba(234,179,8,.1); color:#d97706;">
                    <i class="fas fa-clock"></i>
                </div>
                <div>
                    <div class="fs-4 fw-bold"><?= $totalPendientes ?></div>
                    <div class="text-muted small">Grupos sin evidencia</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="stat-card bg-white">
            <div class="d-flex align-items-center gap-3">
                <div class="stat-icon" style="background:rgba(239,68,68,.1); color:#ef4444;">
                    <i class="fas fa-triangle-exclamation"></i>
                </div>
                <div>
                    <div class="fs-4 fw-bold"><?= $totalVencidos ?></div>
                    <div class="text-muted small">Vencidos sin evidencia</div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ══ FILTRO POR MÓDULO ══════════════════════════════════════════════════════ -->
<div class="card shadow-sm border-0 mb-4">
    <div class="card-body py-2 px-3">
        <form method="GET" class="d-flex align-items-center gap-3 flex-wrap">
            <label class="fw-semibold small text-nowrap mb-0">
                <i class="fas fa-filter text-success me-1"></i>Filtrar módulo:
            </label>
            <select name="asig" class="form-select form-select-sm" style="max-width:380px;"
                    onchange="this.form.submit()">
                <option value="">— Todos los módulos —</option>
                <?php foreach ($asignaciones as $a): ?>
                <option value="<?= $a['id_asignacion'] ?>"
                    <?= $filtroAsig === (int)$a['id_asignacion'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($a['nombre_modulo']) ?>
                    (<?= htmlspecialchars($a['estado']) ?> · Límite: <?= date('d/m/Y', strtotime($a['fecha_limite_evidencia'])) ?>)
                </option>
                <?php endforeach; ?>
            </select>
            <?php if ($filtroAsig): ?>
                <a href="vocero_evidencias.php" class="btn btn-sm btn-outline-secondary">
                    <i class="fas fa-xmark me-1"></i>Limpiar
                </a>
            <?php endif; ?>
        </form>
    </div>
</div>

<!-- ══ TABLA DE GRUPOS ════════════════════════════════════════════════════════ -->
<div class="card shadow-sm mb-4" style="border-left:4px solid #39a900;">
    <div class="card-header bg-white border-0 py-3 d-flex justify-content-between align-items-center">
        <h6 class="fw-bold mb-0">
            <i class="fas fa-people-group text-success me-2"></i>Estado de mis Grupos
        </h6>
        <span class="badge bg-secondary"><?= count($grupos) ?> grupo(s)</span>
    </div>
    <div class="card-body p-0">
        <?php if (empty($grupos)): ?>
        <div class="text-center py-5 text-muted">
            <i class="fas fa-people-group fa-2x mb-2 opacity-25 d-block"></i>
            <span class="small">No tienes grupos registrados<?= $filtroAsig ? ' en este módulo' : '' ?>.</span>
        </div>
        <?php else: ?>
        <div class="table-responsive">
            <table class="table tabla-limpia align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Módulo</th>
                        <th>Nombre del Grupo</th>
                        <th>Fecha Limpieza</th>
                        <th>Plazo Evidencia</th>
                        <th>Estado</th>
                        <th class="text-center">Evidencia</th>
                        <th class="text-center">Acción</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($grupos as $g):
                    $vencido  = strtotime($g['fecha_limite_evidencia']) < time();
                    $tieneEv  = (int)$g['tiene_evidencia'] > 0;
                    $diasRest = (int) ceil((strtotime($g['fecha_limite_evidencia']) - time()) / 86400);
                ?>
                <tr class="<?= (!$tieneEv && $vencido) ? 'table-danger bg-opacity-10' : '' ?>">
                    <td class="small fw-semibold"><?= htmlspecialchars($g['nombre_modulo']) ?></td>
                    <td class="small"><?= htmlspecialchars($g['nombre_grupo']) ?></td>
                    <td class="small"><?= date('d/m/Y', strtotime($g['fecha_limpieza'])) ?></td>
                    <td class="small <?= (!$tieneEv && $vencido) ? 'text-danger fw-semibold' : '' ?>">
                        <?= date('d/m/Y H:i', strtotime($g['fecha_limite_evidencia'])) ?>
                        <?php if (!$tieneEv && !$vencido && $diasRest <= 2): ?>
                            <span class="badge bg-warning text-dark ms-1" style="font-size:.65rem;">
                                ¡<?= $diasRest ?>d!
                            </span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if ($tieneEv): ?>
                            <span class="badge bg-success">
                                <i class="fas fa-check me-1"></i>Completado
                            </span>
                        <?php elseif ($vencido): ?>
                            <span class="badge bg-danger">
                                <i class="fas fa-xmark me-1"></i>Vencido
                            </span>
                        <?php else: ?>
                            <span class="badge bg-warning text-dark">
                                <i class="fas fa-clock me-1"></i>Pendiente
                            </span>
                        <?php endif; ?>
                    </td>
                    <td class="text-center">
                        <?php if ($tieneEv): ?>
                            <span class="text-success fs-5 fw-bold" title="Evidencia entregada">✓</span>
                        <?php else: ?>
                            <span class="text-muted small">—</span>
                        <?php endif; ?>
                    </td>
                    <td class="text-center">
                        <?php if (!$tieneEv && !$vencido): ?>
                            <button class="btn btn-sm btn-success fw-semibold"
                                onclick="abrirModalSubir(
                                    <?= $g['id_grupo'] ?>,
                                    <?= json_encode($g['nombre_grupo']) ?>,
                                    <?= json_encode($g['nombre_modulo']) ?>,
                                    <?= json_encode(date('d/m/Y H:i', strtotime($g['fecha_limite_evidencia']))) ?>
                                )">
                                <i class="fas fa-upload me-1"></i>Subir foto
                            </button>
                        <?php elseif ($tieneEv): ?>
                            <button class="btn btn-sm btn-outline-primary"
                                    onclick="verEvidencia(<?= $g['id_grupo'] ?>)">
                                <i class="fas fa-eye me-1"></i>Ver
                            </button>
                        <?php else: ?>
                            <span class="text-danger small">
                                <i class="fas fa-lock me-1"></i>Vencido
                            </span>
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

<!-- ══ GALERÍA DE EVIDENCIAS ══════════════════════════════════════════════════ -->
<div class="card shadow-sm border-0 mb-4">
    <div class="card-header bg-white border-0 py-3 d-flex justify-content-between align-items-center">
        <h6 class="fw-bold mb-0">
            <i class="fas fa-photo-film text-success me-2"></i>Galería de Evidencias
        </h6>
        <span class="badge bg-success"><?= $totalEv ?> foto(s)</span>
    </div>
    <div class="card-body">
        <?php if (empty($evidencias)): ?>
        <div class="text-center py-5 text-muted">
            <i class="fas fa-images fa-3x mb-3 opacity-25 d-block"></i>
            <p class="small mb-0">
                Aún no has registrado evidencias<?= $filtroAsig ? ' en este módulo' : '' ?>.
            </p>
        </div>
        <?php else: ?>
        <div class="row g-3">
            <?php foreach ($evidencias as $ev): ?>
            <div class="col-md-4 col-sm-6">
                <div class="card border-0 shadow-sm h-100 ev-card"
                     style="border-radius:10px; overflow:hidden; cursor:pointer;"
                     onclick="abrirLightbox(
                         <?= json_encode('../../public/' . $ev['ruta_archivo']) ?>,
                         <?= json_encode($ev['nombre_grupo']) ?>,
                         <?= json_encode($ev['nombre_modulo']) ?>,
                         <?= json_encode(date('d/m/Y H:i', strtotime($ev['fecha_subida']))) ?>
                     )">
                    <div class="position-relative ev-img-wrap">
                        <img src="../../public/<?= htmlspecialchars($ev['ruta_archivo']) ?>"
                             alt="Evidencia <?= htmlspecialchars($ev['nombre_grupo']) ?>"
                             style="object-fit:cover; height:200px; width:100%;">
                        <div class="ev-overlay d-flex flex-column justify-content-center align-items-center text-white text-center p-2">
                            <i class="fas fa-expand fa-lg mb-1"></i>
                            <div class="fw-semibold" style="font-size:.8rem;">
                                <?= htmlspecialchars($ev['nombre_grupo']) ?>
                            </div>
                            <div style="font-size:.72rem; opacity:.85;">
                                <?= htmlspecialchars($ev['nombre_modulo']) ?>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-white border-0 pt-2 pb-2 px-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="small fw-semibold text-truncate" style="max-width:65%;">
                                <?= htmlspecialchars($ev['nombre_modulo']) ?>
                            </span>
                            <span class="text-muted" style="font-size:.75rem;">
                                <?= date('d/m/Y', strtotime($ev['fecha_subida'])) ?>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
    </div>
</div>

<!-- ══ MODAL SUBIR EVIDENCIA ═════════════════════════════════════════════════ -->
<div class="modal fade" id="modalSubirEvidencia" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">

            <div class="modal-header border-0" style="background:#0f2200; color:#fff;">
                <div>
                    <h5 class="modal-title fw-bold mb-0">
                        <i class="fas fa-camera me-2"></i>Subir Evidencia Fotográfica
                    </h5>
                    <div class="small mt-1" style="opacity:.8;">
                        Grupo: <strong id="modalTituloGrupo">—</strong>
                    </div>
                </div>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <form action="../../controllers/VoceroController.php" method="POST"
                  enctype="multipart/form-data">
                <input type="hidden" name="accion" value="subir_evidencia">
                <input type="hidden" name="id_grupo" id="modalIdGrupo">

                <div class="modal-body px-4">

                    <!-- Info del grupo -->
                    <div class="rounded p-3 mb-3" style="background:#f0f9f0; border:1px solid #d4edda;">
                        <div class="d-flex flex-wrap gap-2">
                            <span class="badge bg-success px-3 py-2">
                                <i class="fas fa-door-open me-1"></i>
                                Módulo: <span id="modalInfoModulo">—</span>
                            </span>
                            <span class="badge bg-warning text-dark px-3 py-2">
                                <i class="fas fa-calendar-xmark me-1"></i>
                                Plazo: <span id="modalInfoPlazo">—</span>
                            </span>
                        </div>
                    </div>

                    <!-- Input de foto -->
                    <div class="mb-3">
                        <label class="form-label fw-semibold small">
                            <i class="fas fa-image me-1 text-success"></i>
                            Seleccionar fotografía <span class="text-danger">*</span>
                        </label>
                        <input type="file" class="form-control form-control-sm" name="evidencia"
                               id="inputFoto" accept=".jpg,.jpeg,.png"
                               onchange="previsualizarFoto(this)" required>
                        <div class="form-text text-muted mt-1">
                            <i class="fas fa-circle-info me-1"></i>
                            La foto debe mostrar claramente el módulo limpio.
                            Formatos: JPG, PNG. Máx. 10 MB.
                        </div>
                    </div>

                    <!-- Previsualización -->
                    <div id="previewBox" class="d-none mb-3 text-center">
                        <div class="small text-muted mb-1 fw-semibold">Vista previa:</div>
                        <img id="previewImg" src="#" alt="Vista previa"
                             class="img-fluid rounded shadow-sm"
                             style="max-height:220px; border:2px solid #39a900;">
                    </div>

                </div>

                <div class="modal-footer border-0 px-4 pb-4 pt-0">
                    <button type="button" class="btn btn-outline-secondary"
                            data-bs-dismiss="modal">
                        <i class="fas fa-xmark me-1"></i>Cancelar
                    </button>
                    <button type="submit" class="btn btn-success fw-bold">
                        <i class="fas fa-paper-plane me-1"></i>Enviar Evidencia
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>

<!-- ══ ESTILOS GALERÍA ════════════════════════════════════════════════════════ -->
<style>
.ev-img-wrap { position: relative; overflow: hidden; }
.ev-overlay {
    position: absolute; inset: 0;
    background: rgba(0,0,0,.6);
    opacity: 0;
    transition: opacity .25s ease;
}
.ev-card:hover .ev-overlay { opacity: 1; }
.ev-card:hover img { transform: scale(1.04); transition: transform .3s ease; }
</style>

<!-- ══ JAVASCRIPT ══════════════════════════════════════════════════════════════ -->
<script>
function abrirModalSubir(idGrupo, nombreGrupo, nombreModulo, plazo) {
    document.getElementById('modalIdGrupo').value      = idGrupo;
    document.getElementById('modalTituloGrupo').textContent = nombreGrupo;
    document.getElementById('modalInfoModulo').textContent  = nombreModulo;
    document.getElementById('modalInfoPlazo').textContent   = plazo;
    document.getElementById('previewBox').classList.add('d-none');
    document.getElementById('previewImg').src  = '#';
    document.getElementById('inputFoto').value = '';
    new bootstrap.Modal(document.getElementById('modalSubirEvidencia')).show();
}

function previsualizarFoto(input) {
    const box = document.getElementById('previewBox');
    const img = document.getElementById('previewImg');
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => {
            img.src = e.target.result;
            box.classList.remove('d-none');
        };
        reader.readAsDataURL(input.files[0]);
    } else {
        box.classList.add('d-none');
    }
}

function verEvidencia(idGrupo) {
    fetch(`../../controllers/VoceroController.php?accion=get_evidencia&id_grupo=${idGrupo}`)
        .then(r => r.json())
        .then(data => {
            if (data.ruta) {
                Swal.fire({
                    imageUrl: `../../public/${data.ruta}`,
                    imageAlt: 'Evidencia',
                    title: data.grupo,
                    text: data.modulo + ' · ' + data.fecha,
                    confirmButtonColor: '#39a900',
                    width: 700
                });
            } else {
                Swal.fire({
                    icon: 'info',
                    title: 'Sin evidencia',
                    text: 'No se encontró evidencia registrada para este grupo.',
                    confirmButtonColor: '#39a900'
                });
            }
        })
        .catch(() => {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'No se pudo obtener la evidencia. Intenta de nuevo.',
                confirmButtonColor: '#39a900'
            });
        });
}

function abrirLightbox(rutaImg, grupo, modulo, fecha) {
    Swal.fire({
        imageUrl: rutaImg,
        imageAlt: grupo,
        title: grupo,
        text: modulo + ' · ' + fecha,
        confirmButtonColor: '#39a900',
        width: 700,
        showCloseButton: true
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
