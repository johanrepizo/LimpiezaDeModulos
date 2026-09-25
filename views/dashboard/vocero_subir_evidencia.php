<?php
$titulo = 'Subir Evidencia';
if (session_status() === PHP_SESSION_NONE) session_start();
if (!isset($_SESSION['usuario']) || (int)$_SESSION['usuario']['rol'] !== 2) {
    header("Location: ../usuarios/login.php"); exit;
}
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../models/Turno.php';
require_once __DIR__ . '/../../models/Evidencia.php';

$db    = (new Database())->conectar();
$alert = $_SESSION['alert'] ?? null;
unset($_SESSION['alert']);

$idUsuario = (int)$_SESSION['usuario']['id_usuario'];
$stmtV = $db->prepare("SELECT * FROM voceros WHERE id_usuario = :id AND activo = 1 LIMIT 1");
$stmtV->execute([':id' => $idUsuario]);
$vocero   = $stmtV->fetch(PDO::FETCH_ASSOC);
$idVocero = $vocero ? (int)$vocero['id_vocero'] : 0;
$idFicha  = $vocero ? (int)$vocero['id_ficha']  : 0;

$fichaInfo = null;
if ($idFicha) {
    $stmtF = $db->prepare(
        "SELECT f.numero_ficha, p.nombre AS nombre_programa
         FROM fichas f JOIN programas p ON p.id_programa = f.id_programa
         WHERE f.id_ficha = :id LIMIT 1"
    );
    $stmtF->execute([':id' => $idFicha]);
    $fichaInfo = $stmtF->fetch(PDO::FETCH_ASSOC);
}

$modelTurno = new Turno($db);
if ($idFicha) {
    $modelTurno->abrirTurnosHoy();
    $modelTurno->cerrarTurnosVencidos();
}

$turnoHoy  = $idFicha ? $modelTurno->turnoActivoHoy($idFicha)    : false;
$historial = $idFicha ? $modelTurno->historialFicha($idFicha, 10) : [];

// ¿El turno ya tiene el par completo antes+después?
$modelEv      = new Evidencia($db);
$turnoCompleto = $turnoHoy && $modelEv->turnoCompleto((int)$turnoHoy['id_turno']);

$diasES = ['Domingo','Lunes','Martes','Miércoles','Jueves','Viernes','Sábado'];

require_once __DIR__ . '/../layouts/header.php';
?>

<style>
.ev-page { max-width: 720px; margin: 0 auto; }

.ev-card {
    background: #fff;
    border: 1px solid #e5e7eb;
    border-radius: 12px;
    padding: 1.5rem 1.75rem;
    margin-bottom: 1.25rem;
}
.ev-card-title { font-size: .95rem; font-weight: 700; color: #111827; margin-bottom: .2rem; }
.ev-card-sub   { font-size: .8rem; color: #6b7280; margin-bottom: 1.1rem; }

.ev-info-banner {
    background: #f0f4ff; border: 1px solid #dbe4ff;
    border-radius: 10px; padding: 1rem 1.25rem; margin-bottom: 1.25rem;
}
.ev-info-banner .banner-title { font-size: .88rem; font-weight: 700; color: #3730a3; margin-bottom: .15rem; }
.ev-info-banner .banner-sub   { font-size: .78rem; color: #4f46e5; }

.ev-chip {
    background: #fff; border: 1px solid #e5e7eb; border-radius: 10px;
    padding: .75rem 1rem; display: flex; align-items: center; gap: .85rem; flex: 1;
}
.ev-chip-icon  { width:42px;height:42px;border-radius:10px;display:flex;align-items:center;justify-content:center;font-size:1.1rem;flex-shrink:0; }
.ev-chip-label { font-size:.72rem;color:#6b7280;margin-bottom:.1rem; }
.ev-chip-value { font-size:.95rem;font-weight:700;color:#111827; }

.ev-field label { font-size:.875rem;font-weight:600;color:#374151;display:block;margin-bottom:.4rem; }
.ev-field .form-control,
.ev-field .form-control:disabled,
.ev-field .form-control[readonly] {
    font-size:.875rem;border:1px solid #e5e7eb;border-radius:8px;
    padding:.6rem .85rem;color:#374151;background:#f9fafb;
}
.ev-field .form-control:not(:disabled):not([readonly]) { background:#fff; }
.ev-field .field-hint { font-size:.75rem;color:#9ca3af;margin-top:.25rem; }

/* ── Zonas de foto ── */
.foto-par {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1rem;
    margin-bottom: 1.25rem;
}
@media (max-width: 560px) { .foto-par { grid-template-columns: 1fr; } }

.foto-slot { display: flex; flex-direction: column; }
.foto-slot-label {
    font-size: .82rem; font-weight: 700;
    margin-bottom: .5rem;
    display: flex; align-items: center; gap: .4rem;
}
.foto-slot-label .badge-tipo {
    display: inline-flex; align-items: center; gap: .3rem;
    padding: .25rem .65rem; border-radius: 20px;
    font-size: .75rem; font-weight: 700;
}
.badge-antes   { background: #fef3c7; color: #92400e; }
.badge-despues { background: #dcfce7; color: #14532d; }

.drop-zone {
    border: 2px dashed #d1d5db;
    border-radius: 10px;
    background: #f9fafb;
    min-height: 170px;
    display: flex; flex-direction: column;
    align-items: center; justify-content: center;
    cursor: pointer;
    transition: border-color .2s, background .2s;
    overflow: hidden; padding: 1.25rem;
    text-align: center; position: relative;
    flex: 1;
}
.drop-zone:hover, .drop-zone.drag-over { border-color: #4f46e5; background: #f0f4ff; }
.drop-zone.has-file-antes             { border-color: #d97706; background: #fffbeb; }
.drop-zone.has-file-despues           { border-color: #16a34a; background: #f0fdf4; }
.drop-zone .drop-icon   { font-size: 1.8rem; color: #9ca3af; margin-bottom: .5rem; }
.drop-zone .drop-text   { font-size: .8rem; color: #6b7280; margin-bottom: .2rem; font-weight:600; }
.drop-zone .drop-hint   { font-size: .72rem; color: #9ca3af; }
.drop-zone .required-dot {
    position:absolute; top:.5rem; right:.6rem;
    color:#ef4444; font-size:.9rem; font-weight:700;
}
.drop-zone img {
    width:100%; height:160px; object-fit:cover; border-radius:8px;
    display: none;
}
.drop-zone.previewing img          { display: block; }
.drop-zone.previewing .drop-inner  { display: none; }

/* ── Botón enviar ── */
.btn-enviar {
    background: #39a900; color: #fff; border: none;
    border-radius: 10px; width: 100%; padding: .85rem;
    font-size: .95rem; font-weight: 600; cursor: pointer;
    display: flex; align-items: center; justify-content: center; gap: .5rem;
    transition: background .2s, transform .15s;
    box-shadow: 0 4px 14px rgba(57,169,0,.25);
}
.btn-enviar:hover    { background: #2d8400; transform: translateY(-1px); }
.btn-enviar:disabled { background: #9ca3af; box-shadow: none; cursor: not-allowed; transform: none; }

/* ── Banner éxito / sin turno ── */
.ev-success-banner {
    background: #f0fdf4; border: 1px solid #86efac; border-radius: 10px;
    padding: 1.25rem 1.5rem; display: flex; align-items: center; gap: 1rem; margin-bottom: 1.25rem;
}
.ev-no-turno {
    background: #f9fafb; border: 1px dashed #d1d5db; border-radius: 12px;
    padding: 2.5rem 1.5rem; text-align: center; margin-bottom: 1.25rem;
}

/* ── Historial ── */
.hist-table th {
    font-size:.72rem;font-weight:700;text-transform:uppercase;letter-spacing:.4px;
    color:#6b7280;border-bottom:2px solid #e5e7eb;padding:.6rem .75rem;background:#f9fafb;
}
.hist-table td {
    font-size:.82rem;padding:.65rem .75rem;
    border-bottom:1px solid #f3f4f6;color:#374151;vertical-align:middle;
}
</style>

<div class="ev-page">

    <!-- ══ TÍTULO ══════════════════════════════════════════════════════════ -->
    <div class="text-center mb-4">
        <h3 class="fw-bold mb-1" style="color:#111827;">Subir Evidencia de Limpieza</h3>
        <p class="text-muted small mb-0">
            Sube las dos fotos obligatorias: <strong>antes</strong> y <strong>después</strong> de la limpieza del módulo
        </p>
    </div>

    <!-- ══ BANNER INFO TURNO ═══════════════════════════════════════════════ -->
    <?php if ($turnoHoy): ?>
    <div class="ev-info-banner">
        <div class="banner-title">
            <i class="fas fa-circle-check me-1"></i>
            Limpieza del <?= $diasES[(int)(new DateTime($turnoHoy['fecha_turno']))->format('w')] ?>
            <?= date('d/m/Y', strtotime($turnoHoy['fecha_turno'])) ?>
        </div>
        <div class="banner-sub mb-3">Datos asignados automáticamente según tu ficha y calendario de rotación</div>
        <div class="d-flex gap-3 flex-wrap">
            <div class="ev-chip">
                <div class="ev-chip-icon" style="background:#eef2ff;color:#4f46e5;">
                    <i class="fas fa-building-columns"></i>
                </div>
                <div>
                    <div class="ev-chip-label">Módulo Asignado</div>
                    <div class="ev-chip-value"><?= htmlspecialchars($turnoHoy['nombre_modulo']) ?></div>
                </div>
            </div>
            <div class="ev-chip">
                <div class="ev-chip-icon" style="background:#f5f3ff;color:#7c3aed;">
                    <i class="fas fa-people-group"></i>
                </div>
                <div>
                    <div class="ev-chip-label">Grupo Responsable</div>
                    <div class="ev-chip-value">
                        <?= $turnoHoy['nombre_grupo']
                            ? htmlspecialchars($turnoHoy['nombre_grupo'])
                            : '<span style="color:#f59e0b;font-size:.85rem;">Sin grupo</span>' ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php elseif ($idFicha): ?>
    <div class="ev-no-turno">
        <i class="fas fa-calendar-xmark fa-2x text-muted opacity-40 d-block mb-3"></i>
        <div class="fw-semibold text-muted mb-1">No hay turno de limpieza programado para hoy</div>
        <div class="text-muted small">Revisa el historial para ver tu próxima fecha de limpieza.</div>
    </div>
    <?php endif; ?>

    <!-- ══ PAR YA ENTREGADO ════════════════════════════════════════════════ -->
    <?php if ($turnoHoy && $turnoCompleto): ?>
    <div class="ev-success-banner">
        <i class="fas fa-circle-check text-success fa-2x flex-shrink-0"></i>
        <div>
            <div class="fw-bold text-success mb-1">¡Evidencias del día entregadas!</div>
            <div class="text-muted small">
                Ya registraste las fotos <strong>antes</strong> y <strong>después</strong> de la limpieza de hoy.
                Puedes revisar el historial más abajo.
            </div>
        </div>
    </div>
    <?php endif; ?>

    <!-- ══ FORMULARIO ═════════════════════════════════════════════════════ -->
    <?php if ($turnoHoy && !$turnoCompleto): ?>
    <div class="ev-card">
        <div class="ev-card-title">Nueva Evidencia</div>
        <div class="ev-card-sub">
            Ambas fotos son <strong>obligatorias</strong> — sube la del estado del módulo
            antes de limpiar y la del resultado final.
        </div>

        <form action="../../controllers/VoceroController.php"
              method="POST" enctype="multipart/form-data" id="formEvidencia">
            <input type="hidden" name="accion"   value="subir_evidencia_turno">
            <input type="hidden" name="id_turno" value="<?= (int)$turnoHoy['id_turno'] ?>">
            <input type="hidden" name="id_grupo" value="<?= (int)($turnoHoy['id_grupo_turno'] ?? 0) ?>">

            <!-- Info readonly -->
            <div class="row g-3 mb-4">
                <div class="col-sm-6 ev-field">
                    <label>Módulo</label>
                    <input type="text" class="form-control"
                           value="<?= htmlspecialchars($turnoHoy['nombre_modulo']) ?>" disabled>
                </div>
                <div class="col-sm-6 ev-field">
                    <label>Grupo</label>
                    <input type="text" class="form-control"
                           value="<?= $turnoHoy['nombre_grupo']
                                       ? htmlspecialchars($turnoHoy['nombre_grupo'])
                                       : 'Sin grupo asignado' ?>" disabled>
                </div>
            </div>

            <!-- ── Par de fotos ─────────────────────────────────────────── -->
            <div class="foto-par">

                <!-- ANTES -->
                <div class="foto-slot">
                    <div class="foto-slot-label">
                        <span class="badge-tipo badge-antes">
                            <i class="fas fa-clock"></i> Antes
                        </span>
                        <span style="color:#ef4444; font-size:.85rem;">*</span>
                    </div>
                    <div class="drop-zone" id="dz-antes"
                         onclick="document.getElementById('inp-antes').click()"
                         ondragover="event.preventDefault(); dzDragOver('dz-antes','antes')"
                         ondragleave="dzDragLeave('dz-antes')"
                         ondrop="dzDrop(event,'dz-antes','inp-antes','prev-antes','antes')">
                        <span class="required-dot" title="Obligatorio">●</span>
                        <div class="drop-inner">
                            <div class="drop-icon"><i class="fas fa-camera"></i></div>
                            <div class="drop-text">Estado antes de limpiar</div>
                            <div class="drop-hint">JPG / PNG · máx. 10 MB</div>
                        </div>
                        <img id="prev-antes" src="#" alt="Vista previa antes">
                    </div>
                    <input type="file" id="inp-antes" name="foto_antes"
                           accept=".jpg,.jpeg,.png" required class="form-control form-control-sm mt-2"
                           onchange="dzPreview(this,'dz-antes','prev-antes','antes')">
                </div>

                <!-- DESPUÉS -->
                <div class="foto-slot">
                    <div class="foto-slot-label">
                        <span class="badge-tipo badge-despues">
                            <i class="fas fa-circle-check"></i> Después
                        </span>
                        <span style="color:#ef4444; font-size:.85rem;">*</span>
                    </div>
                    <div class="drop-zone" id="dz-despues"
                         onclick="document.getElementById('inp-despues').click()"
                         ondragover="event.preventDefault(); dzDragOver('dz-despues','despues')"
                         ondragleave="dzDragLeave('dz-despues')"
                         ondrop="dzDrop(event,'dz-despues','inp-despues','prev-despues','despues')">
                        <span class="required-dot" title="Obligatorio">●</span>
                        <div class="drop-inner">
                            <div class="drop-icon"><i class="fas fa-circle-check"></i></div>
                            <div class="drop-text">Resultado después de limpiar</div>
                            <div class="drop-hint">JPG / PNG · máx. 10 MB</div>
                        </div>
                        <img id="prev-despues" src="#" alt="Vista previa después">
                    </div>
                    <input type="file" id="inp-despues" name="foto_despues"
                           accept=".jpg,.jpeg,.png" required class="form-control form-control-sm mt-2"
                           onchange="dzPreview(this,'dz-despues','prev-despues','despues')">
                </div>

            </div><!-- /foto-par -->

            <!-- Observaciones -->
            <div class="ev-field mb-4">
                <label>Observaciones <span style="color:#9ca3af;font-weight:400;">(opcional)</span></label>
                <textarea name="observaciones" class="form-control" rows="2"
                          placeholder="Agrega cualquier comentario relevante…"
                          style="resize:none;background:#fff;"></textarea>
            </div>

            <!-- Indicador de progreso -->
            <div id="progreso" class="mb-3 d-flex align-items-center gap-2"
                 style="font-size:.82rem;color:#6b7280;">
                <span id="prog-antes"   style="color:#d1d5db;"><i class="fas fa-circle"></i> Foto antes</span>
                <span style="color:#d1d5db;">·</span>
                <span id="prog-despues" style="color:#d1d5db;"><i class="fas fa-circle"></i> Foto después</span>
            </div>

            <button type="submit" class="btn-enviar" id="btnEnviar" disabled>
                <i class="fas fa-upload"></i> Enviar Evidencias
            </button>
        </form>
    </div>
    <?php endif; ?>

    <!-- ══ HISTORIAL DE TURNOS ═════════════════════════════════════════════ -->
    <?php if (!empty($historial)): ?>
    <div class="ev-card" style="padding:0; overflow:hidden;">
        <div style="padding:1rem 1.5rem; border-bottom:1px solid #f3f4f6;">
            <span class="fw-bold" style="font-size:.9rem;">Historial de Turnos</span>
            <span class="badge bg-secondary ms-2" style="font-size:.7rem;"><?= count($historial) ?></span>
        </div>
        <div class="table-responsive">
            <table class="table mb-0 hist-table">
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Módulo</th>
                        <th>Grupo</th>
                        <th>Estado</th>
                        <th class="text-center">Fotos</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($historial as $t):
                    $badgeMap = [
                        'Cumplido'   => ['bg'=>'#dcfce7','color'=>'#166534'],
                        'Incumplido' => ['bg'=>'#fee2e2','color'=>'#991b1b'],
                        'Abierto'    => ['bg'=>'#fef9c3','color'=>'#854d0e'],
                        'Cerrado'    => ['bg'=>'#f3f4f6','color'=>'#374151'],
                        'Pendiente'  => ['bg'=>'#f3f4f6','color'=>'#6b7280'],
                    ];
                    $b        = $badgeMap[$t['estado']] ?? ['bg'=>'#f3f4f6','color'=>'#374151'];
                    $esFuturo = strtotime($t['fecha_turno']) > strtotime('today');
                    $nFotos   = (int)($t['tiene_evidencia'] ?? 0);
                ?>
                <tr style="<?= $esFuturo ? 'opacity:.45' : '' ?>">
                    <td class="fw-semibold">
                        <?= date('d/m/Y', strtotime($t['fecha_turno'])) ?>
                        <div style="font-size:.72rem;color:#9ca3af;">
                            <?= $diasES[(int)(new DateTime($t['fecha_turno']))->format('w')] ?>
                        </div>
                    </td>
                    <td><?= htmlspecialchars($t['nombre_modulo']) ?></td>
                    <td style="color:#6b7280;">
                        <?= $t['nombre_grupo'] ? htmlspecialchars($t['nombre_grupo']) : '—' ?>
                    </td>
                    <td>
                        <span style="background:<?= $b['bg'] ?>;color:<?= $b['color'] ?>;
                                     border-radius:20px;padding:.2rem .7rem;
                                     font-size:.75rem;font-weight:600;">
                            <?= htmlspecialchars($t['estado']) ?>
                        </span>
                    </td>
                    <td class="text-center">
                        <?php if ($nFotos >= 2): ?>
                            <span class="badge" style="background:#dcfce7;color:#166534;font-size:.72rem;">
                                <i class="fas fa-check me-1"></i>2/2
                            </span>
                        <?php elseif ($nFotos === 1): ?>
                            <span class="badge" style="background:#fef3c7;color:#92400e;font-size:.72rem;">
                                1/2
                            </span>
                        <?php else: ?>
                            <span style="color:#d1d5db;">—</span>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php endif; ?>

</div><!-- /ev-page -->

<?php if ($alert): ?>
<script>
document.addEventListener('DOMContentLoaded', function () {
    Swal.fire({
        icon:  '<?= addslashes($alert['icon'])  ?>',
        title: '<?= addslashes($alert['title']) ?>',
        text:  '<?= addslashes($alert['text'])  ?>',
        confirmButtonColor: '#39a900'
    });
});
</script>
<?php endif; ?>

<script>
// Estado de selección
const seleccionado = { antes: false, despues: false };

function actualizarBtn() {
    const btn      = document.getElementById('btnEnviar');
    const pAntes   = document.getElementById('prog-antes');
    const pDespues = document.getElementById('prog-despues');
    if (!btn) return;

    if (seleccionado.antes) {
        pAntes.style.color = '#d97706';
        pAntes.innerHTML   = '<i class="fas fa-check-circle"></i> Foto antes';
    } else {
        pAntes.style.color = '#d1d5db';
        pAntes.innerHTML   = '<i class="fas fa-circle"></i> Foto antes';
    }
    if (seleccionado.despues) {
        pDespues.style.color = '#16a34a';
        pDespues.innerHTML   = '<i class="fas fa-check-circle"></i> Foto después';
    } else {
        pDespues.style.color = '#d1d5db';
        pDespues.innerHTML   = '<i class="fas fa-circle"></i> Foto después';
    }

    btn.disabled = !(seleccionado.antes && seleccionado.despues);
}

function dzPreview(input, dzId, imgId, tipo) {
    const dz  = document.getElementById(dzId);
    const img = document.getElementById(imgId);
    if (!input.files || !input.files[0]) return;
    const reader = new FileReader();
    reader.onload = e => {
        img.src = e.target.result;
        dz.classList.add('previewing');
        dz.classList.remove('drag-over');
        dz.classList.add('has-file-' + tipo);
    };
    reader.readAsDataURL(input.files[0]);
    seleccionado[tipo] = true;
    actualizarBtn();
}

function dzDragOver(dzId, tipo) {
    document.getElementById(dzId).classList.add('drag-over');
}
function dzDragLeave(dzId) {
    document.getElementById(dzId).classList.remove('drag-over');
}
function dzDrop(e, dzId, inputId, imgId, tipo) {
    e.preventDefault();
    dzDragLeave(dzId);
    const files = e.dataTransfer.files;
    if (!files.length) return;
    const input = document.getElementById(inputId);
    try { const dt = new DataTransfer(); dt.items.add(files[0]); input.files = dt.files; }
    catch(err) {}
    dzPreview(input, dzId, imgId, tipo);
}

document.addEventListener('DOMContentLoaded', actualizarBtn);
</script>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
