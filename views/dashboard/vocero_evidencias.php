<?php
$titulo = 'Historial de Evidencias';
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

// Vocero
$stmtV = $db->prepare("SELECT * FROM voceros WHERE id_usuario = :id AND activo = 1 LIMIT 1");
$stmtV->execute([':id' => $idUsuario]);
$vocero   = $stmtV->fetch(PDO::FETCH_ASSOC);
$idVocero = $vocero ? (int)$vocero['id_vocero'] : 0;
$idFicha  = $vocero ? (int)$vocero['id_ficha']  : 0;

// Todos los turnos de la ficha (pasados y futuros)
// con info de evidencias y grupo
$stmtTurnos = $db->prepare(
    "SELECT
        t.fecha_turno,
        t.id_turno,
        t.estado        AS turno_estado,
        g.id_grupo,
        g.nombre_grupo,
        m.nombre        AS nombre_modulo,
        (SELECT COUNT(DISTINCT e.tipo)
         FROM evidencias e
         WHERE e.id_turno = t.id_turno
           AND e.tipo IN ('antes','despues')) AS fotos_subidas
     FROM turnos t
     JOIN asignaciones a ON a.id_asignacion = t.id_asignacion
     JOIN modulos m      ON m.id_modulo     = a.id_modulo
     LEFT JOIN grupos g  ON g.id_grupo      = t.id_grupo
     WHERE a.id_ficha = :fic
     ORDER BY t.fecha_turno ASC"
);
$stmtTurnos->execute([':fic' => $idFicha]);
$turnos = $stmtTurnos->fetchAll(PDO::FETCH_ASSOC);

$hoy = date('Y-m-d');

// Construir eventos para FullCalendar
$eventos = [];
foreach ($turnos as $t) {
    $fecha      = $t['fecha_turno'];
    $esPasado   = $fecha < $hoy;
    $esHoy      = $fecha === $hoy;
    $tieneEv    = (int)$t['fotos_subidas'] >= 2;
    $sinGrupo   = empty($t['id_grupo']);

    if ($tieneEv) {
        // Verde — evidencias entregadas
        $color      = '#16a34a';
        $textColor  = '#fff';
        $estado     = 'entregada';
    } elseif ($esPasado || $esHoy) {
        if ($sinGrupo) {
            // Gris — pasado sin grupo asignado
            $color     = '#9ca3af';
            $textColor = '#fff';
            $estado    = 'sin_grupo';
        } else {
            // Rojo — venció sin evidencia
            $color     = '#ef4444';
            $textColor = '#fff';
            $estado    = 'vencida';
        }
    } else {
        // Gris claro — fecha futura
        $color     = '#d1d5db';
        $textColor = '#374151';
        $estado    = 'proxima';
    }

    $titulo_ev = $t['nombre_grupo'] ?? ($t['nombre_modulo'] ?? 'Limpieza');

    $eventos[] = [
        'id'         => $t['id_turno'],
        'title'      => $titulo_ev,
        'start'      => $fecha,
        'color'      => $color,
        'textColor'  => $textColor,
        'extendedProps' => [
            'estado'        => $estado,
            'id_turno'      => $t['id_turno'],
            'id_grupo'      => $t['id_grupo'],
            'nombre_grupo'  => $t['nombre_grupo']  ?? '',
            'nombre_modulo' => $t['nombre_modulo'] ?? '',
            'fotos'         => (int)$t['fotos_subidas'],
        ],
    ];
}

// Evidencias por turno (para el modal al hacer clic)
// Se cargan vía AJAX desde VoceroController
require_once __DIR__ . '/../layouts/header.php';
?>

<div class="d-flex justify-content-between align-items-start mb-4">
    <div>
        <h4 class="fw-bold mb-0">
            <i class="fas fa-calendar-days text-success me-2"></i>Historial de Evidencias
        </h4>
        <p class="text-muted small mb-0">
            Calendario de limpiezas — haz clic en una fecha para ver las evidencias
        </p>
    </div>
</div>

<!-- Leyenda -->
<div class="d-flex gap-3 flex-wrap mb-3" style="font-size:.8rem;">
    <span class="d-flex align-items-center gap-1">
        <span style="width:14px;height:14px;border-radius:4px;background:#16a34a;display:inline-block;"></span>
        Evidencia entregada
    </span>
    <span class="d-flex align-items-center gap-1">
        <span style="width:14px;height:14px;border-radius:4px;background:#ef4444;display:inline-block;"></span>
        Vencida sin evidencia
    </span>
    <span class="d-flex align-items-center gap-1">
        <span style="width:14px;height:14px;border-radius:4px;background:#d1d5db;display:inline-block;"></span>
        Próxima limpieza
    </span>
    <span class="d-flex align-items-center gap-1">
        <span style="width:14px;height:14px;border-radius:4px;background:#9ca3af;display:inline-block;"></span>
        Sin grupo asignado
    </span>
</div>

<!-- Calendario -->
<div class="card border-0 shadow-sm" style="border-radius:14px;overflow:hidden;">
    <div class="card-body p-3 p-md-4">
        <div id="calendario"></div>
    </div>
</div>

<!-- Modal detalle del día -->
<div class="modal fade" id="modalDia" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow">
            <div class="modal-header border-0" style="background:#0f2200;color:#fff;">
                <div>
                    <h6 class="modal-title fw-bold mb-0" id="modalDiaTitulo">
                        <i class="fas fa-calendar-day me-2 text-success"></i>
                    </h6>
                    <div class="small mt-1 opacity-75" id="modalDiaSub"></div>
                </div>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-0" id="modalDiaCuerpo">
                <div class="text-center py-5 text-muted">
                    <i class="fas fa-spinner fa-spin fa-lg d-block mb-2"></i>
                    Cargando…
                </div>
            </div>
        </div>
    </div>
</div>

<!-- FullCalendar -->
<link  href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/locales/es.global.min.js"></script>

<style>
/* ── FullCalendar overrides ── */
#calendario { font-family: inherit; }

.fc .fc-toolbar-title {
    font-size: 1.1rem;
    font-weight: 700;
    color: #111827;
}
.fc .fc-button {
    background: #39a900 !important;
    border-color: #39a900 !important;
    font-size: .82rem !important;
    padding: .3rem .75rem !important;
    border-radius: 7px !important;
}
.fc .fc-button:hover { background: #2d8400 !important; border-color: #2d8400 !important; }
.fc .fc-button-active { background: #2d8400 !important; }

.fc .fc-daygrid-day-number {
    font-size: .82rem;
    font-weight: 600;
    color: #374151;
    padding: .3rem .5rem;
}
.fc .fc-day-today { background: rgba(57,169,0,.06) !important; }
.fc .fc-day-today .fc-daygrid-day-number { color: #39a900; }

.fc-event {
    border-radius: 6px !important;
    border: none !important;
    font-size: .75rem !important;
    font-weight: 600 !important;
    padding: .1rem .35rem !important;
    cursor: pointer !important;
}
.fc-daygrid-event-dot { display: none !important; }

/* Par de fotos en modal */
.par-modal {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: .75rem;
    padding: 1.25rem;
}
@media (max-width: 500px) { .par-modal { grid-template-columns: 1fr; } }

.foto-modal { position: relative; border-radius: 10px; overflow: hidden; }
.foto-modal img {
    width: 100%; height: 220px; object-fit: cover; display: block;
    cursor: pointer; transition: transform .3s;
}
.foto-modal:hover img { transform: scale(1.03); }
.foto-label {
    position: absolute; top: .5rem; left: .5rem;
    padding: .18rem .55rem; border-radius: 20px;
    font-size: .7rem; font-weight: 700;
}
.label-antes   { background: rgba(234,179,8,.9);  color: #78350f; }
.label-despues { background: rgba(22,163,74,.9);   color: #fff; }

.sin-foto {
    height: 220px; background: #f3f4f6; border-radius: 10px;
    display: flex; flex-direction: column;
    align-items: center; justify-content: center;
    color: #9ca3af; font-size: .8rem; gap: .4rem;
}

.estado-banner {
    padding: .75rem 1.25rem;
    border-bottom: 1px solid #e5e7eb;
    display: flex; align-items: center; gap: .75rem;
    font-size: .85rem;
}
</style>

<script>
const eventosData = <?= json_encode($eventos, JSON_UNESCAPED_UNICODE) ?>;
const idVocero    = <?= $idVocero ?>;

document.addEventListener('DOMContentLoaded', function () {

    const cal = new FullCalendar.Calendar(document.getElementById('calendario'), {
        locale:         'es',
        initialView:    'dayGridMonth',
        height:         'auto',
        headerToolbar: {
            left:   'prev,next today',
            center: 'title',
            right:  'dayGridMonth,dayGridYear'
        },
        buttonText: { today: 'Hoy', month: 'Mes', year: 'Año' },
        events: eventosData,
        eventClick: function (info) {
            const p = info.event.extendedProps;
            abrirModalDia(
                info.event.startStr,
                p.id_turno,
                p.id_grupo,
                p.nombre_grupo,
                p.nombre_modulo,
                p.estado,
                p.fotos
            );
        },
        dayMaxEvents: 3,
        moreLinkText: n => `+${n} más`,
    });

    cal.render();
});

function abrirModalDia(fecha, idTurno, idGrupo, nombreGrupo, modulo, estado, fotos) {
    const fechaFmt = new Date(fecha + 'T12:00:00').toLocaleDateString('es-CO', {
        weekday: 'long', year: 'numeric', month: 'long', day: 'numeric'
    });

    document.getElementById('modalDiaTitulo').innerHTML =
        '<i class="fas fa-calendar-day me-2 text-success"></i>' + fechaFmt;
    document.getElementById('modalDiaSub').textContent =
        modulo + (nombreGrupo ? ' · ' + nombreGrupo : '');

    const cuerpo = document.getElementById('modalDiaCuerpo');

    // Banner de estado
    const estadoHtml = {
        entregada: `<div class="estado-banner" style="background:#f0fdf4;color:#166534;">
            <i class="fas fa-circle-check fa-lg"></i>
            <div><strong>Evidencias entregadas</strong><div class="text-muted" style="font-size:.78rem;">Se subieron las dos fotos correctamente.</div></div>
        </div>`,
        vencida: `<div class="estado-banner" style="background:#fef2f2;color:#991b1b;">
            <i class="fas fa-circle-xmark fa-lg"></i>
            <div><strong>No se subió evidencia</strong><div class="text-muted" style="font-size:.78rem;">El plazo de esta limpieza ya venció sin evidencia registrada.</div></div>
        </div>`,
        proxima: `<div class="estado-banner" style="background:#f9fafb;color:#374151;">
            <i class="fas fa-clock fa-lg text-muted"></i>
            <div><strong>Próxima limpieza</strong><div class="text-muted" style="font-size:.78rem;">Aún no ha llegado la fecha.</div></div>
        </div>`,
        sin_grupo: `<div class="estado-banner" style="background:#f3f4f6;color:#374151;">
            <i class="fas fa-users-slash fa-lg text-muted"></i>
            <div><strong>Sin grupo asignado</strong><div class="text-muted" style="font-size:.78rem;">No hay grupo responsable para este turno.</div></div>
        </div>`,
    }[estado] || '';

    if (estado !== 'entregada' || !idTurno) {
        cuerpo.innerHTML = estadoHtml +
            '<div class="text-center py-5 text-muted small">No hay fotos para mostrar.</div>';
        new bootstrap.Modal(document.getElementById('modalDia')).show();
        return;
    }

    cuerpo.innerHTML = estadoHtml +
        '<div class="text-center py-4"><i class="fas fa-spinner fa-spin fa-lg text-muted"></i></div>';
    new bootstrap.Modal(document.getElementById('modalDia')).show();

    // Cargar fotos vía AJAX
    fetch(`../../controllers/VoceroController.php?accion=get_evidencia_turno&id_turno=${idTurno}`)
        .then(r => r.json())
        .then(data => {
            const par = data.par || {};
            let html = estadoHtml + '<div class="par-modal">';

            const fotoHtml = (foto, tipo) => {
                if (!foto) return `<div class="sin-foto">
                    <i class="fas fa-${tipo==='antes'?'clock':'circle-check'} fa-xl opacity-30"></i>
                    <span>Foto ${tipo} no disponible</span>
                </div>`;
                return `<div class="foto-modal" onclick="verFoto('../../public/${foto.ruta}','${tipo==='antes'?'Antes':'Después'} — ${nombreGrupo}','${modulo}')">
                    <img src="../../public/${foto.ruta}" alt="${tipo}">
                    <span class="foto-label ${tipo==='antes'?'label-antes':'label-despues'}">
                        <i class="fas fa-${tipo==='antes'?'clock':'circle-check'} me-1"></i>${tipo==='antes'?'Antes':'Después'}
                    </span>
                </div>`;
            };

            html += fotoHtml(par.antes,   'antes');
            html += fotoHtml(par.despues, 'despues');
            html += '</div>';
            if (data.observaciones) {
                html += `<div class="px-4 pb-3 text-muted small">
                    <i class="fas fa-comment me-1"></i>${data.observaciones}
                </div>`;
            }
            cuerpo.innerHTML = html;
        })
        .catch(() => {
            cuerpo.innerHTML = estadoHtml +
                '<div class="text-center py-4 text-muted small">Error al cargar las fotos.</div>';
        });
}

function verFoto(url, titulo, sub) {
    Swal.fire({
        imageUrl: url, imageAlt: titulo,
        title: titulo, text: sub,
        confirmButtonColor: '#39a900', width: 720, showCloseButton: true
    });
}

<?php if ($alert): ?>
document.addEventListener('DOMContentLoaded', function () {
    Swal.fire({
        icon: '<?= addslashes($alert['icon']) ?>',
        title: '<?= addslashes($alert['title']) ?>',
        text: '<?= addslashes($alert['text']) ?>',
        confirmButtonColor: '#39a900'
    });
});
<?php endif; ?>
</script>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
