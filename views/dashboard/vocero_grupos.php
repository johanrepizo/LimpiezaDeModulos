<?php
$titulo = 'Mis Grupos de Limpieza';
if (session_status() === PHP_SESSION_NONE) session_start();
if (!isset($_SESSION['usuario']) || (int)$_SESSION['usuario']['rol'] !== 2) {
    header("Location: ../usuarios/login.php"); exit;
}
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../models/Grupo.php';
require_once __DIR__ . '/../../models/Ficha.php';
require_once __DIR__ . '/../../models/Turno.php';

$db     = (new Database())->conectar();
$alert  = $_SESSION['alert'] ?? null;
unset($_SESSION['alert']);

$idUsuario = (int)$_SESSION['usuario']['id_usuario'];
$stmtV     = $db->prepare("SELECT * FROM voceros WHERE id_usuario=:id AND activo=1 LIMIT 1");
$stmtV->execute([':id' => $idUsuario]);
$vocero    = $stmtV->fetch(PDO::FETCH_ASSOC);
$idVocero  = $vocero ? (int)$vocero['id_vocero'] : 0;
$idFicha   = $vocero ? (int)$vocero['id_ficha']  : 0;

$modelGrupo = new Grupo($db);
$grupos     = $modelGrupo->obtenerPorVocero($idVocero);

// ── Actualización automática de fechas vencidas ──────────────────────────
// Si un grupo tiene fecha de limpieza ya pasada, se le asigna automáticamente
// el siguiente turno libre de la asignación (queda último en la rotación).
if (!empty($grupos)) {
    $modelTurno = new Turno($db);
    $hoy        = date('Y-m-d');
    $huboActualizacion = false;

    foreach ($grupos as &$g) {
        if ($g['fecha_limpieza'] >= $hoy) continue; // fecha futura o hoy: no tocar

        $idAsignacion = (int)$g['id_asignacion'];
        $nuevaFecha   = $modelTurno->proximaFechaLibre($idAsignacion);
        if (!$nuevaFecha) continue; // no hay turnos libres

        // Actualizar fecha en BD
        $db->prepare("UPDATE grupos SET fecha_limpieza = :f, fecha_modificacion = NOW() WHERE id_grupo = :id")
           ->execute([':f' => $nuevaFecha, ':id' => $g['id_grupo']]);

        // Vincular el nuevo turno al grupo
        $modelTurno->asignarGrupoAlTurno($idAsignacion, $nuevaFecha, (int)$g['id_grupo']);

        // Actualizar en el array local para que la vista muestre la fecha correcta
        $g['fecha_limpieza'] = $nuevaFecha;
        $huboActualizacion = true;
    }
    unset($g);

    // Si hubo cambios, recargar grupos con orden correcto
    if ($huboActualizacion) {
        $grupos = $modelGrupo->obtenerPorVocero($idVocero);
    }
}

// Cargar integrantes de todos los grupos de una sola vez
$integrantesPorGrupo = [];
if (!empty($grupos)) {
    $ids   = implode(',', array_column($grupos, 'id_grupo'));
    $stmtI = $db->query(
        "SELECT gi.id_grupo, ap.nombres, ap.apellidos, ap.documento, ap.celular, ap.correo
         FROM grupo_integrantes gi
         JOIN aprendices ap ON ap.id_aprendiz = gi.id_aprendiz
         WHERE gi.id_grupo IN ($ids)
         ORDER BY ap.apellidos ASC"
    );
    foreach ($stmtI->fetchAll(PDO::FETCH_ASSOC) as $row) {
        $integrantesPorGrupo[(int)$row['id_grupo']][] = $row;
    }
}

// Asignación activa
$stmtAsig = $db->prepare(
    "SELECT a.*, m.nombre AS nombre_modulo, m.ubicacion, f.numero_ficha
     FROM asignaciones a
     JOIN modulos m ON m.id_modulo = a.id_modulo
     JOIN fichas  f ON f.id_ficha  = a.id_ficha
     WHERE a.id_ficha = :fic AND a.estado = 'Activa'
     ORDER BY a.fecha_creacion DESC LIMIT 1"
);
$stmtAsig->execute([':fic' => $idFicha]);
$asignacion = $stmtAsig->fetch(PDO::FETCH_ASSOC);

$modelTurno      = new Turno($db);
$proximaFecha    = $asignacion ? $modelTurno->proximaFechaLibre((int)$asignacion['id_asignacion']) : false;
$turnosRestantes = $asignacion ? $modelTurno->turnosLibresRestantes((int)$asignacion['id_asignacion']) : 0;

$diasES = ['Domingo','Lunes','Martes','Miércoles','Jueves','Viernes','Sábado'];

// Aprendices de la ficha + cuáles ya están ocupados en algún grupo
$aprendices    = (new Ficha($db))->obtenerAprendicesDeFicha($idFicha);
$aprendicesOcupados = $modelGrupo->aprendicesOcupadosEnFicha($idFicha);

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

<!-- Módulo activo -->
<?php if ($asignacion): ?>
<div class="card border-0 shadow-sm mb-3"
     style="border-left:4px solid #39a900; background:linear-gradient(135deg,#f0fff4,#fff);">
    <div class="card-body py-3 px-4 d-flex align-items-center gap-3 flex-wrap">
        <div style="width:42px;height:42px;border-radius:10px;background:#39a900;
                    color:#fff;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
            <i class="fas fa-door-open"></i>
        </div>
        <div class="flex-grow-1">
            <div class="text-muted" style="font-size:.72rem;text-transform:uppercase;letter-spacing:.4px;">Módulo asignado a tu ficha</div>
            <div class="fw-bold"><?= htmlspecialchars($asignacion['nombre_modulo']) ?></div>
            <?php if ($asignacion['ubicacion']): ?>
            <div class="text-muted small"><i class="fas fa-location-dot me-1"></i><?= htmlspecialchars($asignacion['ubicacion']) ?></div>
            <?php endif; ?>
        </div>
        <div class="text-center px-3 py-2 rounded-3" style="background:rgba(57,169,0,.08);border:1px solid rgba(57,169,0,.2);">
            <div class="text-muted" style="font-size:.7rem;text-transform:uppercase;letter-spacing:.4px;">Próxima limpieza</div>
            <?php if ($proximaFecha): ?>
                <div class="fw-bold text-success" style="font-size:1rem;"><?= date('d/m/Y', strtotime($proximaFecha)) ?></div>
                <div class="text-muted" style="font-size:.75rem;"><?= $diasES[(int)(new DateTime($proximaFecha))->format('w')] ?></div>
            <?php else: ?>
                <div class="text-muted small">Sin turnos<br>pendientes</div>
            <?php endif; ?>
        </div>
        <div class="text-center px-3 py-2 rounded-3" style="background:rgba(37,99,235,.06);border:1px solid rgba(37,99,235,.15);">
            <div class="text-muted" style="font-size:.7rem;text-transform:uppercase;letter-spacing:.4px;">Turnos sin grupo</div>
            <div class="fw-bold" style="font-size:1rem;color:#2563eb;"><?= $turnosRestantes ?></div>
            <div class="text-muted" style="font-size:.75rem;">disponibles</div>
        </div>
    </div>
</div>
<?php else: ?>
<div class="alert alert-warning border-0 shadow-sm mb-3 py-2 small">
    <i class="fas fa-triangle-exclamation me-1"></i>
    Tu ficha no tiene ningún módulo asignado. El administrador debe asignarlo antes de crear grupos.
</div>
<?php endif; ?>

<!-- Lista de grupos -->
<?php if (empty($grupos)): ?>
<div class="card border-0 shadow-sm text-center py-5 text-muted">
    <i class="fas fa-people-group fa-3x mb-3 opacity-25 d-block"></i>
    <p class="small mb-0">No has registrado ningún grupo de limpieza aún.</p>
</div>
<?php else: ?>
<?php foreach ($grupos as $numGrupo => $g):
    $integrantes = $integrantesPorGrupo[(int)$g['id_grupo']] ?? [];
    $esHoy       = date('Y-m-d', strtotime($g['fecha_limpieza'])) === date('Y-m-d');
    $vencido     = strtotime($g['fecha_limpieza']) < strtotime('today');
    $badge       = match($g['estado']) {
        'Completado' => ['bg'=>'#dbeafe','color'=>'#1d4ed8'],
        'Sancionado' => ['bg'=>'#fee2e2','color'=>'#991b1b'],
        default      => ['bg'=>'#dcfce7','color'=>'#166534'],
    };
?>
<div class="card border-0 shadow-sm mb-3" style="border-radius:12px;overflow:hidden;">

    <!-- Cabecera del grupo -->
    <div class="d-flex align-items-center gap-3 px-4 py-3"
         style="background:#f9fafb;border-bottom:1px solid #e5e7eb;">
        <div style="width:38px;height:38px;border-radius:9px;background:#39a900;
                    color:#fff;font-weight:700;font-size:1rem;flex-shrink:0;
                    display:flex;align-items:center;justify-content:center;">
            <?= $numGrupo + 1 ?>
        </div>
        <div class="flex-grow-1">
            <div class="fw-bold" style="font-size:.95rem;color:#111827;">
                <?= htmlspecialchars($g['nombre_grupo']) ?>
                <?php if ($esHoy): ?>
                    <span class="badge bg-warning text-dark ms-1" style="font-size:.63rem;">Hoy</span>
                <?php endif; ?>
            </div>
            <div class="text-muted" style="font-size:.78rem;">
                <i class="fas fa-calendar me-1"></i>
                <?= date('d/m/Y', strtotime($g['fecha_limpieza'])) ?>
                · <?= $diasES[(int)(new DateTime($g['fecha_limpieza']))->format('w')] ?>
                <span class="mx-2">·</span>
                <i class="fas fa-door-open me-1"></i><?= htmlspecialchars($g['nombre_modulo']) ?>
            </div>
        </div>
        <div class="d-flex align-items-center gap-2 flex-shrink-0 flex-wrap">
            <!-- Estado -->
            <span style="background:<?= $badge['bg'] ?>;color:<?= $badge['color'] ?>;
                         padding:.25rem .65rem;border-radius:20px;font-size:.72rem;font-weight:600;">
                <?= $g['estado'] ?>
            </span>
            <!-- Integrantes -->
            <button class="btn btn-sm btn-outline-success"
                    onclick="verIntegrantes(<?= $g['id_grupo'] ?>, '<?= addslashes($g['nombre_grupo']) ?>')"
                    title="Ver integrantes">
                <i class="fas fa-users me-1"></i><?= count($integrantes) ?>
            </button>
            <!-- Editar siempre disponible -->
            <button class="btn btn-sm btn-outline-primary"
                    onclick='abrirEdicion(<?= json_encode(['id_grupo'=>$g['id_grupo'],'nombre_grupo'=>$g['nombre_grupo'],'fecha_limpieza'=>$g['fecha_limpieza']]) ?>)'
                    title="Editar integrantes">
                <i class="fas fa-pen"></i>
            </button>
            <!-- Eliminar siempre disponible -->
            <form action="../../controllers/VoceroController.php" method="POST" class="d-inline"
                  id="form-del-<?= $g['id_grupo'] ?>">
                <input type="hidden" name="accion"   value="eliminar_grupo">
                <input type="hidden" name="id_grupo" value="<?= $g['id_grupo'] ?>">
                <button type="button" class="btn btn-sm btn-outline-danger"
                        onclick="confirmarEliminar(<?= $g['id_grupo'] ?>, '<?= addslashes($g['nombre_grupo']) ?>')"
                        title="Eliminar">
                    <i class="fas fa-trash"></i>
                </button>
            </form>
            <?php if ($esHoy && (int)$g['tiene_evidencia'] === 0): ?>
            <a href="vocero_subir_evidencia.php" class="btn btn-sm btn-success fw-semibold">
                <i class="fas fa-camera me-1"></i>Subir evidencia
            </a>
            <?php endif; ?>
        </div>
    </div>

    <!-- Integrantes inline (siempre visibles) -->
    <?php if (empty($integrantes)): ?>
    <div class="px-4 py-3 text-muted small">Sin integrantes registrados.</div>
    <?php else: ?>
    <div class="table-responsive">
        <table class="table mb-0" style="font-size:.82rem;">
            <thead>
                <tr style="background:#f9fafb;border-bottom:1px solid #e5e7eb;">
                    <th style="padding:.45rem 1rem;font-weight:700;color:#6b7280;font-size:.7rem;text-transform:uppercase;letter-spacing:.4px;">#</th>
                    <th style="padding:.45rem .75rem;font-weight:700;color:#6b7280;font-size:.7rem;text-transform:uppercase;letter-spacing:.4px;">Apellidos</th>
                    <th style="padding:.45rem .75rem;font-weight:700;color:#6b7280;font-size:.7rem;text-transform:uppercase;letter-spacing:.4px;">Nombres</th>
                    <th style="padding:.45rem .75rem;font-weight:700;color:#6b7280;font-size:.7rem;text-transform:uppercase;letter-spacing:.4px;">Documento</th>
                    <th style="padding:.45rem .75rem;font-weight:700;color:#6b7280;font-size:.7rem;text-transform:uppercase;letter-spacing:.4px;">Celular</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($integrantes as $idx => $ap): ?>
            <tr style="border-bottom:1px solid #f3f4f6;">
                <td style="padding:.5rem 1rem;color:#9ca3af;"><?= $idx + 1 ?></td>
                <td style="padding:.5rem .75rem;font-weight:600;color:#111827;"><?= htmlspecialchars($ap['apellidos']) ?></td>
                <td style="padding:.5rem .75rem;color:#374151;"><?= htmlspecialchars($ap['nombres']) ?></td>
                <td style="padding:.5rem .75rem;color:#6b7280;"><?= htmlspecialchars($ap['documento'] ?? '—') ?></td>
                <td style="padding:.5rem .75rem;">
                    <?php if (!empty($ap['celular'])): ?>
                        <a href="tel:<?= htmlspecialchars($ap['celular']) ?>" class="text-decoration-none text-dark">
                            <i class="fas fa-phone text-success me-1" style="font-size:.68rem;"></i><?= htmlspecialchars($ap['celular']) ?>
                        </a>
                    <?php else: ?><span class="text-muted">—</span><?php endif; ?>
                </td>
            </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php endif; ?>

</div>
<?php endforeach; ?>
<?php endif; ?>

<!-- ══ Modal Nuevo / Editar Grupo ══ -->
<div class="modal fade" id="modalGrupo" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content shadow">
            <div class="modal-header" style="background:#0f2200;color:#fff;">
                <h6 class="modal-title fw-bold" id="titModalGrupo">
                    <i class="fas fa-people-group me-2 text-success"></i>Nuevo Grupo de Limpieza
                </h6>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form action="../../controllers/VoceroController.php" method="POST" id="formGrupo">
                <input type="hidden" name="accion"        id="accionGrupo"  value="guardar_grupo">
                <input type="hidden" name="id_grupo"      id="id_grupo"     value="">
                <input type="hidden" name="id_asignacion" value="<?= $asignacion ? $asignacion['id_asignacion'] : '' ?>">

                <div class="modal-body px-4 py-4">

                    <?php if ($asignacion): ?>
                    <div class="rounded-3 p-3 mb-3 d-flex align-items-center gap-3"
                         style="background:#f0fff4;border:1px solid #86efac;">
                        <div style="width:38px;height:38px;border-radius:8px;background:#39a900;
                                    color:#fff;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                            <i class="fas fa-door-open"></i>
                        </div>
                        <div class="flex-grow-1">
                            <div class="text-muted" style="font-size:.7rem;text-transform:uppercase;letter-spacing:.4px;">Módulo asignado</div>
                            <div class="fw-bold"><?= htmlspecialchars($asignacion['nombre_modulo']) ?></div>
                        </div>
                        <?php if ($proximaFecha): ?>
                        <div class="text-end">
                            <div class="text-muted" style="font-size:.7rem;">Fecha automática</div>
                            <div class="fw-bold text-success"><?= date('d/m/Y', strtotime($proximaFecha)) ?></div>
                            <div class="text-muted" style="font-size:.72rem;"><?= $diasES[(int)(new DateTime($proximaFecha))->format('w')] ?></div>
                        </div>
                        <?php endif; ?>
                    </div>
                    <?php else: ?>
                    <div class="alert alert-warning py-2 small mb-3">
                        <i class="fas fa-triangle-exclamation me-1"></i>
                        Tu ficha no tiene módulo asignado activo. Contacta al administrador.
                    </div>
                    <?php endif; ?>

                    <?php if (!$proximaFecha && $asignacion): ?>
                    <div class="alert alert-danger py-2 small mb-3">
                        <i class="fas fa-ban me-1"></i>
                        No hay turnos disponibles. Todos ya tienen grupo asignado.
                    </div>
                    <?php endif; ?>

                    <!-- Integrantes -->
                    <div>
                        <label class="form-label fw-semibold small">
                            Integrantes <span class="text-danger">*</span>
                            <span class="text-muted fw-normal">(aprendices en gris ya están en otro grupo)</span>
                        </label>
                        <?php if (empty($aprendices)): ?>
                        <div class="alert alert-warning py-2 small">No hay aprendices sincronizados en tu ficha.</div>
                        <?php else: ?>
                        <div style="max-height:240px;overflow-y:auto;border:1px solid #dee2e6;border-radius:8px;padding:.5rem;">
                            <?php foreach ($aprendices as $ap):
                                $ocupado = in_array((int)$ap['id_aprendiz'], $aprendicesOcupados);
                            ?>
                            <div class="form-check py-1">
                                <input class="form-check-input" type="checkbox"
                                       name="aprendices[]" value="<?= $ap['id_aprendiz'] ?>"
                                       id="ap_<?= $ap['id_aprendiz'] ?>"
                                       <?= $ocupado ? 'disabled' : '' ?>>
                                <label class="form-check-label small <?= $ocupado ? 'text-muted' : '' ?>"
                                       for="ap_<?= $ap['id_aprendiz'] ?>">
                                    <?= htmlspecialchars($ap['apellidos'] . ', ' . $ap['nombres']) ?>
                                    <?php if ($ap['documento']): ?>
                                        <span class="text-muted"> — <?= htmlspecialchars($ap['documento']) ?></span>
                                    <?php endif; ?>
                                    <?php if ($ocupado): ?>
                                        <span class="badge bg-secondary ms-1" style="font-size:.6rem;">En otro grupo</span>
                                    <?php endif; ?>
                                </label>
                            </div>
                            <?php endforeach; ?>
                        </div>
                        <?php endif; ?>
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

<!-- ══ Modal Integrantes (AJAX) ══ -->
<div class="modal fade" id="modalIntegrantes" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content shadow border-0">
            <div class="modal-header" style="background:#0f2200;color:#fff;">
                <h6 class="modal-title fw-bold" id="titModalInt">
                    <i class="fas fa-users me-2 text-success"></i>Integrantes
                </h6>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-0" id="cuerpoModalInt">
                <div class="text-center py-4 text-muted small">Cargando…</div>
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

<script>
// Datos de integrantes ya cargados en PHP
const integrantesPorGrupo = <?= json_encode($integrantesPorGrupo) ?>;

function verIntegrantes(idGrupo, nombreGrupo) {
    document.getElementById('titModalInt').innerHTML =
        '<i class="fas fa-users me-2 text-success"></i>' + nombreGrupo;

    const lista = integrantesPorGrupo[idGrupo] || [];
    let html = '';
    if (lista.length === 0) {
        html = '<div class="text-center py-4 text-muted small">Sin integrantes registrados.</div>';
    } else {
        html = '<table class="table mb-0" style="font-size:.82rem;">';
        html += '<thead><tr style="background:#f9fafb;">';
        html += '<th style="padding:.45rem 1rem;color:#6b7280;font-size:.7rem;">#</th>';
        html += '<th style="padding:.45rem .75rem;color:#6b7280;font-size:.7rem;">APELLIDOS</th>';
        html += '<th style="padding:.45rem .75rem;color:#6b7280;font-size:.7rem;">NOMBRES</th>';
        html += '<th style="padding:.45rem .75rem;color:#6b7280;font-size:.7rem;">DOCUMENTO</th>';
        html += '</tr></thead><tbody>';
        lista.forEach((ap, i) => {
            html += `<tr style="border-bottom:1px solid #f3f4f6;">
                <td style="padding:.5rem 1rem;color:#9ca3af;">${i+1}</td>
                <td style="padding:.5rem .75rem;font-weight:600;">${ap.apellidos}</td>
                <td style="padding:.5rem .75rem;">${ap.nombres}</td>
                <td style="padding:.5rem .75rem;color:#6b7280;">${ap.documento || '—'}</td>
            </tr>`;
        });
        html += '</tbody></table>';
    }
    document.getElementById('cuerpoModalInt').innerHTML = html;
    new bootstrap.Modal(document.getElementById('modalIntegrantes')).show();
}

function abrirEdicion(g) {
    document.getElementById('titModalGrupo').innerHTML =
        '<i class="fas fa-pen me-2 text-success"></i>Editar Integrantes — ' + g.nombre_grupo;
    document.getElementById('accionGrupo').value = 'editar_grupo';
    document.getElementById('id_grupo').value    = g.id_grupo;

    // Para edición: desmarcar todos primero, luego marcar los del grupo
    document.querySelectorAll('#formGrupo input[type=checkbox]').forEach(cb => {
        if (!cb.disabled) cb.checked = false;
    });

    // Marcar los integrantes actuales del grupo (que no estén disabled)
    const actuales = (integrantesPorGrupo[g.id_grupo] || []);
    // No tenemos id_aprendiz aquí — hacemos fetch o los pasamos via data
    // Como los integrantes en el modal ya están en el DOM, usamos los checkbox
    // que coincidan con los del grupo. Necesitamos los IDs.
    // Los pasamos via data-attr en el botón editar (ver PHP arriba no los tiene).
    // Solución: recargar la página no es viable, así que los buscamos en el JSON.
    // Pero integrantesPorGrupo no tiene id_aprendiz. Recargamos con fetch:
    fetch(`../../controllers/VoceroController.php?accion=get_integrantes_ids&id_grupo=${g.id_grupo}`)
        .then(r => r.json())
        .then(ids => {
            ids.forEach(id => {
                const cb = document.getElementById('ap_' + id);
                if (cb && !cb.disabled) cb.checked = true;
            });
        });

    new bootstrap.Modal(document.getElementById('modalGrupo')).show();
}

document.getElementById('modalGrupo').addEventListener('hidden.bs.modal', function() {
    document.getElementById('titModalGrupo').innerHTML =
        '<i class="fas fa-people-group me-2 text-success"></i>Nuevo Grupo de Limpieza';
    document.getElementById('accionGrupo').value = 'guardar_grupo';
    document.getElementById('id_grupo').value    = '';
    document.querySelectorAll('#formGrupo input[type=checkbox]').forEach(cb => {
        if (!cb.disabled) cb.checked = false;
    });
});

function confirmarEliminar(idGrupo, nombre) {
    Swal.fire({
        title: '¿Eliminar grupo?',
        text:  'Se eliminará el grupo "' + nombre + '" y sus integrantes.',
        icon:  'warning',
        showCancelButton:   true,
        confirmButtonText:  'Sí, eliminar',
        cancelButtonText:   'Cancelar',
        confirmButtonColor: '#ef4444',
        cancelButtonColor:  '#6b7280',
    }).then(r => {
        if (r.isConfirmed) document.getElementById('form-del-' + idGrupo).submit();
    });
}
</script>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
