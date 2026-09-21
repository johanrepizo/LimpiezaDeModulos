<?php
$titulo = 'Subir Evidencia';
if (session_status() === PHP_SESSION_NONE) session_start();
if (!isset($_SESSION['usuario']) || (int)$_SESSION['usuario']['rol'] !== 2) {
    header("Location: ../usuarios/login.php"); exit;
}
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../models/Turno.php';

$db    = (new Database())->conectar();
$alert = $_SESSION['alert'] ?? null;
unset($_SESSION['alert']);

$idUsuario = (int)$_SESSION['usuario']['id_usuario'];
$stmtV = $db->prepare("SELECT * FROM voceros WHERE id_usuario = :id AND activo = 1 LIMIT 1");
$stmtV->execute([':id' => $idUsuario]);
$vocero   = $stmtV->fetch(PDO::FETCH_ASSOC);
$idVocero = $vocero ? (int)$vocero['id_vocero'] : 0;
$idFicha  = $vocero ? (int)$vocero['id_ficha']  : 0;

// Obtener info de la ficha
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

$diasES = ['Domingo','Lunes','Martes','Miércoles','Jueves','Viernes','Sábado'];
$hoy    = new DateTime();

require_once __DIR__ . '/../layouts/header.php';
?>

<style>
/* ── Estilos específicos de esta página ── */
.ev-page {
    max-width: 680px;
    margin: 0 auto;
}
.ev-card {
    background: #fff;
    border: 1px solid #e5e7eb;
    border-radius: 12px;
    padding: 1.5rem 1.75rem;
    margin-bottom: 1.25rem;
}
.ev-card-title {
    font-size: .95rem;
    font-weight: 700;
    color: #111827;
    margin-bottom: .2rem;
}
.ev-card-sub {
    font-size: .8rem;
    color: #6b7280;
    margin-bottom: 1.1rem;
}
.ev-info-banner {
    background: #f0f4ff;
    border: 1px solid #dbe4ff;
    border-radius: 10px;
    padding: 1rem 1.25rem;
    margin-bottom: 1.25rem;
}
.ev-info-banner .banner-title {
    font-size: .88rem;
    font-weight: 700;
    color: #3730a3;
    margin-bottom: .15rem;
}
.ev-info-banner .banner-sub {
    font-size: .78rem;
    color: #4f46e5;
}
.ev-chip {
    background: #fff;
    border: 1px solid #e5e7eb;
    border-radius: 10px;
    padding: .75rem 1rem;
    display: flex;
    align-items: center;
    gap: .85rem;
    flex: 1;
}
.ev-chip-icon {
    width: 42px; height: 42px;
    border-radius: 10px;
    display: flex; align-items: center; justify-content: center;
    font-size: 1.1rem;
    flex-shrink: 0;
}
.ev-chip-label {
    font-size: .72rem;
    color: #6b7280;
    margin-bottom: .1rem;
}
.ev-chip-value {
    font-size: .95rem;
    font-weight: 700;
    color: #111827;
}
.ev-field label {
    font-size: .875rem;
    font-weight: 600;
    color: #374151;
    display: block;
    margin-bottom: .4rem;
}
.ev-field .form-control,
.ev-field .form-control:disabled,
.ev-field .form-control[readonly] {
    font-size: .875rem;
    border: 1px solid #e5e7eb;
    border-radius: 8px;
    padding: .6rem .85rem;
    color: #374151;
    background: #f9fafb;
}
.ev-field .form-control:not(:disabled):not([readonly]) {
    background: #fff;
}
.ev-field .field-hint {
    font-size: .75rem;
    color: #9ca3af;
    margin-top: .25rem;
}
.ev-drop-zone {
    border: 2px dashed #d1d5db;
    border-radius: 10px;
    background: #f9fafb;
    min-height: 160px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: border-color .2s, background .2s;
    position: relative;
    overflow: hidden;
    padding: 1.5rem;
    text-align: center;
}
.ev-drop-zone:hover,
.ev-drop-zone.drag-over {
    border-color: #4f46e5;
    background: #f0f4ff;
}
.ev-drop-zone .drop-icon {
    font-size: 2rem;
    color: #9ca3af;
    margin-bottom: .6rem;
}
.ev-drop-zone .drop-text {
    font-size: .82rem;
    color: #6b7280;
    margin-bottom: .2rem;
}
.ev-drop-zone .drop-hint {
    font-size: .74rem;
    color: #9ca3af;
}
.ev-drop-zone img {
    width: 100%; height: 200px;
    object-fit: cover;
    border-radius: 8px;
}
.ev-file-input {
    margin-top: .6rem;
    font-size: .82rem;
}
.btn-enviar {
    background: #4f46e5;
    color: #fff;
    border: none;
    border-radius: 10px;
    width: 100%;
    padding: .85rem;
    font-size: .95rem;
    font-weight: 600;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: .5rem;
    transition: background .2s, transform .15s;
}
.btn-enviar:hover { background: #4338ca; transform: translateY(-1px); }
.btn-enviar:active { transform: translateY(0); }
.ev-success-banner {
    background: #f0fdf4;
    border: 1px solid #86efac;
    border-radius: 10px;
    padding: 1.25rem 1.5rem;
    display: flex;
    align-items: center;
    gap: 1rem;
    margin-bottom: 1.25rem;
}
.ev-no-turno {
    background: #f9fafb;
    border: 1px dashed #d1d5db;
    border-radius: 12px;
    padding: 2.5rem 1.5rem;
    text-align: center;
    margin-bottom: 1.25rem;
}
/* Historial */
.hist-table th {
    font-size: .72rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: .4px;
    color: #6b7280;
    border-bottom: 2px solid #e5e7eb;
    padding: .6rem .75rem;
    background: #f9fafb;
}
.hist-table td {
    font-size: .82rem;
    padding: .65rem .75rem;
    border-bottom: 1px solid #f3f4f6;
    color: #374151;
    vertical-align: middle;
}
</style>

<div class="ev-page">

    <!-- ══ TÍTULO ══════════════════════════════════════════════════════════ -->
    <div class="text-center mb-4">
        <h3 class="fw-bold mb-1" style="color:#111827;">Subir Evidencia de Limpieza</h3>
        <p class="text-muted small mb-0">
            Carga fotografías que demuestren el cumplimiento de la limpieza del módulo asignado
        </p>
    </div>

    <!-- ══ BANNER TURNO HOY ════════════════════════════════════════════════ -->
    <?php if ($turnoHoy): ?>
    <div class="ev-info-banner">
        <div class="banner-title">
            <i class="fas fa-circle-check me-1"></i>
            Información de Limpieza — <?= $diasES[(int)(new DateTime($turnoHoy['fecha_turno']))->format('w')] ?>
        </div>
        <div class="banner-sub mb-3">
            Datos asignados automáticamente según tu ficha y calendario de rotación
        </div>
        <div class="d-flex gap-3 flex-wrap">
            <!-- Módulo -->
            <div class="ev-chip">
                <div class="ev-chip-icon" style="background:#eef2ff; color:#4f46e5;">
                    <i class="fas fa-building-columns"></i>
                </div>
                <div>
                    <div class="ev-chip-label">Módulo Asignado</div>
                    <div class="ev-chip-value"><?= htmlspecialchars($turnoHoy['nombre_modulo']) ?></div>
                </div>
            </div>
            <!-- Grupo -->
            <div class="ev-chip">
                <div class="ev-chip-icon" style="background:#f5f3ff; color:#7c3aed;">
                    <i class="fas fa-people-group"></i>
                </div>
                <div>
                    <div class="ev-chip-label">Grupo de Hoy</div>
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
        <div class="text-muted small">
            Revisa el historial para ver tu próxima fecha de limpieza.
        </div>
    </div>
    <?php endif; ?>

    <!-- ══ EVIDENCIA YA ENTREGADA ══════════════════════════════════════════ -->
    <?php if ($turnoHoy && (int)$turnoHoy['tiene_evidencia'] > 0): ?>
    <div class="ev-success-banner">
        <i class="fas fa-circle-check text-success fa-2x flex-shrink-0"></i>
        <div>
            <div class="fw-bold text-success mb-0">¡Evidencia del día ya entregada!</div>
            <div class="text-muted small">
                Ya registraste la evidencia de limpieza de hoy correctamente.
                Puedes ver el historial más abajo.
            </div>
        </div>
    </div>
    <?php endif; ?>

    <!-- ══ FORMULARIO NUEVA EVIDENCIA ══════════════════════════════════════ -->
    <?php if ($turnoHoy && (int)$turnoHoy['tiene_evidencia'] === 0): ?>
    <div class="ev-card">
        <div class="ev-card-title">Nueva Evidencia</div>
        <div class="ev-card-sub">La información del módulo y grupo se completó automáticamente</div>

        <form action="../../controllers/VoceroController.php"
              method="POST" enctype="multipart/form-data" id="formEvidencia">
            <input type="hidden" name="accion"   value="subir_evidencia_turno">
            <input type="hidden" name="id_turno" value="<?= $turnoHoy['id_turno'] ?>">
            <input type="hidden" name="id_grupo" value="<?= $turnoHoy['id_grupo_turno'] ?? '' ?>">

            <!-- Módulo -->
            <div class="ev-field mb-3">
                <label>Módulo</label>
                <input type="text" class="form-control"
                       value="<?= htmlspecialchars($turnoHoy['nombre_modulo']) ?>" disabled>
                <div class="field-hint">
                    Este es el módulo asignado a tu ficha
                    <?= $fichaInfo ? htmlspecialchars($fichaInfo['numero_ficha']) : '' ?>
                </div>
            </div>

            <!-- Fecha -->
            <div class="ev-field mb-3">
                <label>Fecha de Limpieza</label>
                <input type="text" class="form-control"
                       value="<?= date('d/m/Y', strtotime($turnoHoy['fecha_turno'])) ?>" disabled>
            </div>

            <!-- Grupo -->
            <div class="ev-field mb-3">
                <label>Grupo Responsable</label>
                <input type="text" class="form-control"
                       value="<?= $turnoHoy['nombre_grupo']
                                   ? htmlspecialchars($turnoHoy['nombre_grupo'])
                                   : 'Sin grupo asignado' ?>" disabled>
                <div class="field-hint">Grupo asignado automáticamente según calendario de rotación</div>
            </div>

            <!-- Observaciones -->
            <div class="ev-field mb-4">
                <label>Observaciones <span style="color:#9ca3af;font-weight:400;">(opcional)</span></label>
                <textarea name="observaciones" class="form-control" rows="3"
                          placeholder="Agrega cualquier comentario relevante…"
                          style="resize:none; background:#fff;"></textarea>
            </div>

            <!-- Foto -->
            <div class="ev-field mb-4">
                <label>Fotografía de Evidencia</label>
                <div class="ev-drop-zone" id="dropZone"
                     onclick="document.getElementById('inputFoto').click()"
                     ondragover="event.preventDefault(); this.classList.add('drag-over')"
                     ondragleave="this.classList.remove('drag-over')"
                     ondrop="handleDrop(event)">
                    <div id="dropContent">
                        <div class="drop-icon"><i class="fas fa-camera"></i></div>
                        <div class="drop-text">Haz clic para seleccionar una imagen</div>
                        <div class="drop-hint">JPG, JPEG o PNG (máx. 10 MB)</div>
                    </div>
                    <img id="previewImg" src="#" alt="Vista previa" class="d-none">
                </div>
                <input type="file" id="inputFoto" name="evidencia"
                       accept=".jpg,.jpeg,.png" required
                       class="form-control ev-file-input"
                       onchange="previsualizarFoto(this)">
            </div>

            <!-- Botón agregar segunda foto -->
            <div class="mt-2 mb-1">
                <button type="button" class="btn btn-sm btn-outline-secondary" onclick="toggleFoto2()">
                    <i class="fas fa-plus me-1"></i>Agregar segunda foto
                </button>
            </div>

            <!-- Segunda foto (oculta por defecto) -->
            <div class="ev-field mb-4" id="foto2Section" style="display:none;">
                <label class="form-label fw-semibold small">
                    Segunda Fotografía <span class="text-muted fw-normal">(opcional)</span>
                </label>
                <div id="dropZone2"
                     onclick="document.getElementById('inputFoto2').click()"
                     ondragover="event.preventDefault(); activarDrop2()"
                     ondragleave="desactivarDrop2()"
                     ondrop="handleDrop2(event)"
                     style="border:2px dashed #d1d5db; border-radius:14px; min-height:160px;
                            display:flex; flex-direction:column; align-items:center;
                            justify-content:center; cursor:pointer; transition:all .25s;
                            background:#fafafa; padding:1.5rem; text-align:center;">
                    <div id="dropContent2">
                        <i class="fas fa-camera fa-2x mb-2 text-muted opacity-40"></i>
                        <div class="text-muted small fw-semibold">Segunda foto (opcional)</div>
                        <div class="text-muted" style="font-size:.75rem;">JPG, JPEG o PNG (máx. 10 MB)</div>
                    </div>
                    <img id="previewImg2" src="#" alt="Vista previa 2" class="d-none"
                         style="width:100%; height:180px; object-fit:cover; border-radius:10px;">
                </div>
                <input type="file" id="inputFoto2" name="evidencia2"
                       accept=".jpg,.jpeg,.png"
                       class="form-control form-control-sm mt-2"
                       onchange="previsualizarFoto2(this)">
            </div>

            <!-- Botón enviar -->
            <button type="submit" class="btn-enviar">
                <i class="fas fa-upload"></i> Enviar Evidencia
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
                        <th class="text-center">✓</th>
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
                    $b = $badgeMap[$t['estado']] ?? ['bg'=>'#f3f4f6','color'=>'#374151'];
                    $esFuturo = strtotime($t['fecha_turno']) > strtotime('today');
                ?>
                <tr style="<?= $esFuturo ? 'opacity:.45' : '' ?>">
                    <td class="fw-semibold">
                        <?= date('d/m/Y', strtotime($t['fecha_turno'])) ?>
                        <div style="font-size:.72rem; color:#9ca3af;">
                            <?= $diasES[(int)(new DateTime($t['fecha_turno']))->format('w')] ?>
                        </div>
                    </td>
                    <td><?= htmlspecialchars($t['nombre_modulo']) ?></td>
                    <td style="color:#6b7280;">
                        <?= $t['nombre_grupo'] ? htmlspecialchars($t['nombre_grupo']) : '—' ?>
                    </td>
                    <td>
                        <span style="background:<?= $b['bg'] ?>; color:<?= $b['color'] ?>;
                                     border-radius:20px; padding:.2rem .7rem;
                                     font-size:.75rem; font-weight:600;">
                            <?= htmlspecialchars($t['estado']) ?>
                        </span>
                    </td>
                    <td class="text-center">
                        <?php if ((int)$t['tiene_evidencia'] > 0): ?>
                            <span style="color:#16a34a; font-weight:700; font-size:1.1rem;">✓</span>
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
        icon:  '<?= addslashes($alert['icon']) ?>',
        title: '<?= addslashes($alert['title']) ?>',
        text:  '<?= addslashes($alert['text']) ?>',
        confirmButtonColor: '#4f46e5'
    });
});
</script>
<?php endif; ?>

<script>
function previsualizarFoto(input) {
    const content = document.getElementById('dropContent');
    const img     = document.getElementById('previewImg');
    const zone    = document.getElementById('dropZone');
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => {
            img.src = e.target.result;
            img.classList.remove('d-none');
            content.classList.add('d-none');
            zone.style.borderColor = '#4f46e5';
            zone.style.background  = '#f0f4ff';
        };
        reader.readAsDataURL(input.files[0]);
    }
}

function handleDrop(e) {
    e.preventDefault();
    const zone = document.getElementById('dropZone');
    zone.classList.remove('drag-over');
    const files = e.dataTransfer.files;
    if (files.length) {
        const input = document.getElementById('inputFoto');
        try {
            const dt = new DataTransfer();
            dt.items.add(files[0]);
            input.files = dt.files;
        } catch(err) { /* fallback silencioso */ }
        previsualizarFoto(input);
    }
}

function toggleFoto2() {
    const s = document.getElementById('foto2Section');
    s.style.display = s.style.display === 'none' ? 'block' : 'none';
}
function previsualizarFoto2(input) {
    const c2 = document.getElementById('dropContent2');
    const i2 = document.getElementById('previewImg2');
    if (input.files && input.files[0]) {
        const r = new FileReader();
        r.onload = e => { i2.src = e.target.result; i2.classList.remove('d-none'); c2.classList.add('d-none'); document.getElementById('dropZone2').style.borderColor='#39a900'; };
        r.readAsDataURL(input.files[0]);
    }
}
function activarDrop2() { document.getElementById('dropZone2').style.borderColor='#39a900'; }
function desactivarDrop2() { document.getElementById('dropZone2').style.borderColor='#d1d5db'; }
function handleDrop2(e) {
    e.preventDefault(); desactivarDrop2();
    const files = e.dataTransfer.files;
    if (files.length) { try { const dt=new DataTransfer(); dt.items.add(files[0]); document.getElementById('inputFoto2').files=dt.files; } catch(err){} previsualizarFoto2(document.getElementById('inputFoto2')); }
}
</script>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
