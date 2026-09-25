<?php
$titulo = 'Evidencias';
if (session_status() === PHP_SESSION_NONE) session_start();
if (!isset($_SESSION['usuario']) || (int)$_SESSION['usuario']['rol'] !== 1) {
    header("Location: ../usuarios/login.php"); exit;
}
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../models/Programa.php';
require_once __DIR__ . '/../../models/Ficha.php';
require_once __DIR__ . '/../../models/Evidencia.php';

$db        = (new Database())->conectar();
$modelProg = new Programa($db);
$modelFich = new Ficha($db);
$modelEv   = new Evidencia($db);
$alert     = $_SESSION['alert'] ?? null;
unset($_SESSION['alert']);

$vistaPrograma = (int)($_GET['programa'] ?? 0);
$vistaFicha    = (int)($_GET['ficha']    ?? 0);

$programas     = $modelProg->obtenerTodos();
$programaAct   = null;
$fichasDelProg = [];
$fichaAct      = null;
$evidencias    = [];
$pares         = [];
$turnos        = [];
$eventos       = [];

if ($vistaPrograma) {
    $programaAct = $modelProg->obtenerPorId($vistaPrograma);
    $stmtF = $db->prepare(
        "SELECT f.*,
                ANY_VALUE(v.nombres)   AS vocero_nombres,
                ANY_VALUE(v.apellidos) AS vocero_apellidos,
                COUNT(DISTINCT ap.id_aprendiz) AS total_aprendices
         FROM fichas f
         LEFT JOIN voceros    v  ON v.id_ficha  = f.id_ficha AND v.activo = 1
         LEFT JOIN aprendices ap ON ap.id_ficha = f.id_ficha AND ap.activo = 1
         WHERE f.id_programa = :prog AND f.activo = 1
         GROUP BY f.id_ficha ORDER BY f.numero_ficha"
    );
    $stmtF->execute([':prog' => $vistaPrograma]);
    $fichasDelProg = $stmtF->fetchAll(PDO::FETCH_ASSOC);
}

if ($vistaFicha) {
    $stmtFA = $db->prepare(
        "SELECT f.*, p.nombre AS nombre_programa,
                ANY_VALUE(v.nombres)   AS vocero_nombres,
                ANY_VALUE(v.apellidos) AS vocero_apellidos
         FROM fichas f
         JOIN programas p ON p.id_programa = f.id_programa
         LEFT JOIN voceros v ON v.id_ficha = f.id_ficha AND v.activo = 1
         WHERE f.id_ficha = :id GROUP BY f.id_ficha LIMIT 1"
    );
    $stmtFA->execute([':id' => $vistaFicha]);
    $fichaAct = $stmtFA->fetch(PDO::FETCH_ASSOC);

    if ($fichaAct) {
        $vistaPrograma = (int)$fichaAct['id_programa'];
        $programaAct   = $modelProg->obtenerPorId($vistaPrograma);

        $stmtF2 = $db->prepare(
            "SELECT f.*,
                    ANY_VALUE(v.nombres)   AS vocero_nombres,
                    ANY_VALUE(v.apellidos) AS vocero_apellidos,
                    COUNT(DISTINCT ap.id_aprendiz) AS total_aprendices
             FROM fichas f
             LEFT JOIN voceros    v  ON v.id_ficha  = f.id_ficha AND v.activo = 1
             LEFT JOIN aprendices ap ON ap.id_ficha = f.id_ficha AND ap.activo = 1
             WHERE f.id_programa = :prog AND f.activo = 1
             GROUP BY f.id_ficha ORDER BY f.numero_ficha"
        );
        $stmtF2->execute([':prog' => $vistaPrograma]);
        $fichasDelProg = $stmtF2->fetchAll(PDO::FETCH_ASSOC);

        // Turnos para el calendario de la ficha
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
        $stmtTurnos->execute([':fic' => $vistaFicha]);
        $turnos = $stmtTurnos->fetchAll(PDO::FETCH_ASSOC);

        $hoy = date('Y-m-d');
        foreach ($turnos as $t) {
            $fecha      = $t['fecha_turno'];
            $esPasado   = $fecha < $hoy;
            $esHoy      = $fecha === $hoy;
            $tieneEv    = (int)$t['fotos_subidas'] >= 2;
            $sinGrupo   = empty($t['id_grupo']);

            if ($tieneEv) {
                $color      = '#16a34a';
                $textColor  = '#fff';
                $estado     = 'entregada';
            } elseif ($esPasado || $esHoy) {
                if ($sinGrupo) {
                    $color     = '#9ca3af';
                    $textColor = '#fff';
                    $estado    = 'sin_grupo';
                } else {
                    $color     = '#ef4444';
                    $textColor = '#fff';
                    $estado    = 'vencida';
                }
            } else {
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

        // Evidencias ordenadas: fecha DESC, tipo ASC (antes primero)
        $evidencias = $modelEv->obtenerTodas(['id_ficha' => $vistaFicha]);

        // Agrupar en pares por fecha_limpieza + id_grupo
        foreach ($evidencias as $ev) {
            $clave = $ev['fecha_limpieza'] . '|' . $ev['id_grupo'];
            if (!isset($pares[$clave])) {
                $pares[$clave] = [
                    'fecha_limpieza'   => $ev['fecha_limpieza'],
                    'nombre_grupo'     => $ev['nombre_grupo'],
                    'nombre_modulo'    => $ev['nombre_modulo'],
                    'numero_ficha'     => $ev['numero_ficha'],
                    'vocero_nombres'   => $ev['vocero_nombres'],
                    'vocero_apellidos' => $ev['vocero_apellidos'],
                    'antes'            => null,
                    'despues'          => null,
                ];
            }
            $pares[$clave][$ev['tipo']] = $ev;
        }
        // Ordenar por fecha_limpieza DESC
        usort($pares, fn($a,$b) => strcmp($b['fecha_limpieza'], $a['fecha_limpieza']));
    }
}

// Contadores globales: contar pares completos (2 fotos distintas)
$stmtTotPares = $db->query(
    "SELECT COUNT(*) FROM (
        SELECT id_grupo, fecha_limpieza
        FROM (
            SELECT e.id_grupo, g.fecha_limpieza
            FROM evidencias e
            JOIN grupos g ON g.id_grupo = e.id_grupo
            GROUP BY e.id_grupo, g.fecha_limpieza
            HAVING COUNT(DISTINCT e.tipo) >= 2
        ) t
    ) u"
);
$totalParesCompletos = (int)$stmtTotPares->fetchColumn();

require_once __DIR__ . '/../layouts/header.php';
?>

<style>
.prog-card { transition: transform .2s, box-shadow .2s; cursor: pointer; }
.prog-card:hover { transform: translateY(-3px); box-shadow: 0 8px 24px rgba(0,0,0,.1) !important; }
.breadcrumb-item + .breadcrumb-item::before { color: #9ca3af; }

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

/* Par de fotos en modal del calendario */
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

.nav-pills .nav-link.active {
    background-color: #39a900 !important;
    color: #fff !important;
}
.nav-pills .nav-link {
    color: #4b5563;
}

/* ── Par de fotos galería ── */
.par-card {
    background: #fff; border: 1px solid #e5e7eb;
    border-radius: 12px; overflow: hidden; margin-bottom: 1rem;
}
.par-header {
    padding: .6rem 1rem; background: #f9fafb;
    border-bottom: 1px solid #e5e7eb;
    display: flex; align-items: center; gap: .65rem; flex-wrap: wrap;
}
.par-modulo { font-size: .82rem; font-weight: 700; color: #111827; }
.par-vocero { font-size: .75rem; color: #6b7280; }
.par-grupo  { font-size: .75rem; color: #9ca3af; }
.par-fecha  { font-size: .74rem; color: #9ca3af; margin-left: auto; white-space: nowrap; }

.par-fotos { display: grid; grid-template-columns: 1fr 1fr; }
@media (max-width: 500px) { .par-fotos { grid-template-columns: 1fr; } }

.par-foto { position: relative; overflow: hidden; cursor: pointer; }
.par-foto img {
    width: 100%; height: 200px; object-fit: cover; display: block;
    transition: transform .3s ease;
}
.par-foto:hover img { transform: scale(1.04); }
.par-foto-label {
    position: absolute; top: .5rem; left: .5rem;
    padding: .18rem .55rem; border-radius: 20px;
    font-size: .7rem; font-weight: 700;
}
.label-antes   { background: rgba(234,179,8,.85);  color: #78350f; }
.label-despues { background: rgba(22,163,74,.85);   color: #fff; }
.par-foto-overlay {
    position: absolute; inset: 0;
    background: rgba(0,0,0,.42);
    display: flex; align-items: center; justify-content: center;
    opacity: 0; transition: opacity .25s;
    color: #fff; font-size: 1.3rem;
}
.par-foto:hover .par-foto-overlay { opacity: 1; }

.par-foto-missing {
    height: 200px; background: #f3f4f6;
    display: flex; flex-direction: column;
    align-items: center; justify-content: center;
    color: #9ca3af; font-size: .78rem; gap: .35rem;
}
</style>

<!-- ══ BREADCRUMB ══════════════════════════════════════════════════════════════ -->
<div class="d-flex justify-content-between align-items-start mb-4 flex-wrap gap-3">
    <div>
        <nav aria-label="breadcrumb" class="mb-1">
            <ol class="breadcrumb mb-0" style="font-size:.82rem;">
                <li class="breadcrumb-item">
                    <a href="admin_evidencias.php" class="text-success text-decoration-none fw-semibold">
                        <i class="fas fa-images me-1"></i>Evidencias
                    </a>
                </li>
                <?php if ($programaAct): ?>
                <li class="breadcrumb-item">
                    <?php if ($fichaAct): ?>
                        <a href="admin_evidencias.php?programa=<?= $vistaPrograma ?>"
                           class="text-success text-decoration-none">
                            <?= htmlspecialchars($programaAct['nombre']) ?>
                        </a>
                    <?php else: ?>
                        <span class="text-dark fw-semibold"><?= htmlspecialchars($programaAct['nombre']) ?></span>
                    <?php endif; ?>
                </li>
                <?php endif; ?>
                <?php if ($fichaAct): ?>
                <li class="breadcrumb-item active">
                    Ficha <strong class="font-monospace"><?= htmlspecialchars($fichaAct['numero_ficha']) ?></strong>
                </li>
                <?php endif; ?>
            </ol>
        </nav>
        <h4 class="fw-bold mb-0">
            <?php if ($fichaAct): ?>
                <i class="fas fa-images text-success me-2"></i>
                Evidencias — Ficha <span class="font-monospace"><?= htmlspecialchars($fichaAct['numero_ficha']) ?></span>
            <?php elseif ($programaAct): ?>
                <i class="fas fa-id-card text-success me-2"></i>
                Fichas — <?= htmlspecialchars($programaAct['nombre']) ?>
            <?php else: ?>
                <i class="fas fa-images text-success me-2"></i>Evidencias de Limpieza
            <?php endif; ?>
        </h4>
        <p class="text-muted small mb-0">
            <?php if ($fichaAct): ?>
                Historial de pares antes/después registrados por el vocero · ordenados por fecha de limpieza
            <?php elseif ($programaAct): ?>
                Selecciona una ficha para ver su historial de evidencias
            <?php else: ?>
                Seguimiento centralizado de evidencias por programa y ficha
            <?php endif; ?>
        </p>
    </div>
</div>

<!-- ══ NIVEL 0: GRID DE PROGRAMAS ════════════════════════════════════════════ -->
<?php if (!$vistaPrograma && !$vistaFicha): ?>

<div class="row g-3 mb-4">
    <div class="col-sm-4">
        <div class="stat-card bg-white">
            <div class="d-flex align-items-center gap-3">
                <div class="stat-icon" style="background:rgba(57,169,0,.12);color:#39a900;">
                    <i class="fas fa-graduation-cap"></i>
                </div>
                <div>
                    <div class="fs-4 fw-bold"><?= count($programas) ?></div>
                    <div class="text-muted small">Programas</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="stat-card bg-white">
            <div class="d-flex align-items-center gap-3">
                <div class="stat-icon" style="background:rgba(37,99,235,.1);color:#2563eb;">
                    <i class="fas fa-id-card"></i>
                </div>
                <div>
                    <div class="fs-4 fw-bold"><?= array_sum(array_column($programas,'total_fichas')) ?></div>
                    <div class="text-muted small">Fichas activas</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="stat-card bg-white">
            <div class="d-flex align-items-center gap-3">
                <div class="stat-icon" style="background:rgba(234,179,8,.1);color:#d97706;">
                    <i class="fas fa-images"></i>
                </div>
                <div>
                    <div class="fs-4 fw-bold"><?= $totalParesCompletos ?></div>
                    <div class="text-muted small">Pares completos</div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="mb-3">
    <div class="input-group input-group-sm" style="max-width:340px;">
        <span class="input-group-text bg-white"><i class="fas fa-search text-muted"></i></span>
        <input type="text" id="buscPrograma" class="form-control border-start-0" placeholder="Buscar programa…">
    </div>
</div>

<div class="row g-3" id="gridProgramas">
    <?php foreach ($programas as $p):
        // Pares completos de este programa
        $stmtEC = $db->prepare(
            "SELECT COUNT(*) FROM (
                SELECT e.id_grupo FROM evidencias e
                JOIN grupos g   ON g.id_grupo     = e.id_grupo
                JOIN asignaciones a ON a.id_asignacion = g.id_asignacion
                WHERE a.id_ficha IN (SELECT id_ficha FROM fichas WHERE id_programa = :prog)
                GROUP BY e.id_grupo, g.fecha_limpieza
                HAVING COUNT(DISTINCT e.tipo) >= 2
             ) t"
        );
        $stmtEC->execute([':prog' => $p['id_programa']]);
        $cntPares = (int)$stmtEC->fetchColumn();
    ?>
    <div class="col-md-6 col-lg-4 prog-item">
        <a href="admin_evidencias.php?programa=<?= $p['id_programa'] ?>" class="text-decoration-none">
            <div class="card border-0 shadow-sm h-100 prog-card" style="border-radius:12px;">
                <div class="card-body p-4">
                    <div class="d-flex align-items-start justify-content-between mb-3">
                        <div style="width:44px;height:44px;border-radius:10px;
                                    background:rgba(57,169,0,.12);color:#39a900;
                                    display:flex;align-items:center;justify-content:center;font-size:1.2rem;">
                            <i class="fas fa-graduation-cap"></i>
                        </div>
                        <span class="badge bg-light text-dark border" style="font-size:.72rem;">
                            <?= htmlspecialchars($p['nivel'] ?? 'Sin nivel') ?>
                        </span>
                    </div>
                    <h6 class="fw-bold mb-3 text-dark" style="font-size:.88rem;line-height:1.3;">
                        <?= htmlspecialchars($p['nombre']) ?>
                    </h6>
                    <div class="d-flex gap-3 pt-3" style="border-top:1px solid #e5e7eb;">
                        <div>
                            <div class="fw-bold text-success fs-5"><?= (int)$p['total_fichas'] ?></div>
                            <div class="text-muted" style="font-size:.72rem;">Fichas</div>
                        </div>
                        <div>
                            <div class="fw-bold text-warning fs-5"><?= $cntPares ?></div>
                            <div class="text-muted" style="font-size:.72rem;">Pares completos</div>
                        </div>
                        <div class="ms-auto d-flex align-items-center text-success" style="font-size:.82rem;">
                            Ver fichas <i class="fas fa-arrow-right ms-1"></i>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <?php endforeach; ?>
    <?php if (empty($programas)): ?>
    <div class="col-12 text-center py-5 text-muted">
        <i class="fas fa-graduation-cap fa-3x mb-3 opacity-25 d-block"></i>No hay programas registrados.
    </div>
    <?php endif; ?>
</div>
<?php endif; ?>

<!-- ══ NIVEL 1: FICHAS DEL PROGRAMA ══════════════════════════════════════════ -->
<?php if ($vistaPrograma && !$vistaFicha): ?>
<div class="row g-3">
    <?php foreach ($fichasDelProg as $f):
        $stmtEF = $db->prepare(
            "SELECT COUNT(*) FROM (
                SELECT e.id_grupo FROM evidencias e
                JOIN grupos g ON g.id_grupo = e.id_grupo
                JOIN asignaciones a ON a.id_asignacion = g.id_asignacion
                WHERE a.id_ficha = :fic
                GROUP BY e.id_grupo, g.fecha_limpieza
                HAVING COUNT(DISTINCT e.tipo) >= 2
             ) t"
        );
        $stmtEF->execute([':fic' => $f['id_ficha']]);
        $cntParFicha = (int)$stmtEF->fetchColumn();
    ?>
    <div class="col-md-6 col-lg-4">
        <a href="admin_evidencias.php?ficha=<?= $f['id_ficha'] ?>" class="text-decoration-none">
            <div class="card border-0 shadow-sm h-100 prog-card" style="border-radius:12px;">
                <div class="card-body p-4">
                    <div class="d-flex align-items-start justify-content-between mb-3">
                        <div style="width:44px;height:44px;border-radius:10px;
                                    background:rgba(37,99,235,.1);color:#2563eb;
                                    display:flex;align-items:center;justify-content:center;font-size:1.1rem;">
                            <i class="fas fa-id-card"></i>
                        </div>
                        <span class="badge bg-light text-dark border"><?= htmlspecialchars($f['jornada']) ?></span>
                    </div>
                    <div class="fw-bold text-success font-monospace mb-1" style="font-size:1.3rem;">
                        <?= htmlspecialchars($f['numero_ficha']) ?>
                    </div>
                    <div class="text-muted small mb-3">
                        <?php if ($f['vocero_nombres']): ?>
                            <i class="fas fa-user-tie text-success me-1" style="font-size:.75rem;"></i>
                            <?= htmlspecialchars($f['vocero_nombres'] . ' ' . $f['vocero_apellidos']) ?>
                        <?php else: ?>
                            <span class="text-warning"><i class="fas fa-exclamation-circle me-1"></i>Sin vocero</span>
                        <?php endif; ?>
                    </div>
                    <div class="d-flex gap-3 pt-3" style="border-top:1px solid #e5e7eb;">
                        <div>
                            <div class="fw-bold text-warning fs-5"><?= $cntParFicha ?></div>
                            <div class="text-muted" style="font-size:.72rem;">Pares completos</div>
                        </div>
                        <div>
                            <div class="fw-bold text-muted" style="font-size:1rem;"><?= (int)$f['total_aprendices'] ?></div>
                            <div class="text-muted" style="font-size:.72rem;">Aprendices</div>
                        </div>
                        <div class="ms-auto d-flex align-items-center text-success" style="font-size:.82rem;">
                            Ver evidencias <i class="fas fa-arrow-right ms-1"></i>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <?php endforeach; ?>
    <?php if (empty($fichasDelProg)): ?>
    <div class="col-12 text-center py-5 text-muted">
        <i class="fas fa-id-card fa-3x mb-3 opacity-25 d-block"></i>No hay fichas en este programa.
    </div>
    <?php endif; ?>
</div>
<?php endif; ?>

<!-- ══ NIVEL 2: CALENDARIO Y GALERÍA DE LA FICHA ══════════════════════════════ -->
<?php if ($vistaFicha && $fichaAct): ?>

<!-- FullCalendar Assets -->
<link  href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/locales/es.global.min.js"></script>

<?php
$stmtGC = $db->prepare("SELECT COUNT(*) FROM grupos g JOIN asignaciones a ON a.id_asignacion=g.id_asignacion WHERE a.id_ficha=:fic");
$stmtGC->execute([':fic' => $vistaFicha]);
$cntGrupos       = (int)$stmtGC->fetchColumn();
$voceroNombre    = trim(($fichaAct['vocero_nombres'] ?? '') . ' ' . ($fichaAct['vocero_apellidos'] ?? ''));
$turnosCompletos = count(array_filter($turnos, fn($t) => (int)$t['fotos_subidas'] >= 2));
?>

<div class="row g-3 mb-4">
    <div class="col-sm-4">
        <div class="stat-card bg-white">
            <div class="d-flex align-items-center gap-3">
                <div class="stat-icon" style="background:rgba(57,169,0,.12);color:#39a900;"><i class="fas fa-calendar-check"></i></div>
                <div>
                    <div class="fs-4 fw-bold"><?= $turnosCompletos ?> / <?= count($turnos) ?></div>
                    <div class="text-muted small">Turnos con evidencia</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="stat-card bg-white">
            <div class="d-flex align-items-center gap-3">
                <div class="stat-icon" style="background:rgba(37,99,235,.1);color:#2563eb;"><i class="fas fa-people-group"></i></div>
                <div>
                    <div class="fs-4 fw-bold"><?= $cntGrupos ?></div>
                    <div class="text-muted small">Grupos de limpieza</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="stat-card bg-white">
            <div class="d-flex align-items-center gap-3">
                <div class="stat-icon" style="background:rgba(234,179,8,.1);color:#d97706;"><i class="fas fa-user-tie"></i></div>
                <div>
                    <div class="fw-bold" style="font-size:.9rem;"><?= htmlspecialchars($voceroNombre ?: '—') ?></div>
                    <div class="text-muted small">Vocero asignado</div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Selector de vista: Calendario / Galería -->
<div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-3">
    <div>
        <h6 class="fw-bold mb-0">
            <i class="fas fa-calendar-days text-success me-2"></i>
            Evidencias — <span class="font-monospace text-success"><?= htmlspecialchars($fichaAct['numero_ficha']) ?></span>
            <span class="text-muted fw-normal small ms-1">— <?= htmlspecialchars($fichaAct['nombre_programa']) ?></span>
        </h6>
        <p class="text-muted small mb-0 mt-1">
            Calendario de limpiezas — haz clic en una fecha para ver las evidencias
        </p>
    </div>
    <ul class="nav nav-pills" id="pills-vista" role="tablist">
        <li class="nav-item">
            <button class="nav-link active fw-semibold btn-sm" id="tab-calendario-btn" data-bs-toggle="pill" data-bs-target="#vista-calendario" type="button">
                <i class="fas fa-calendar-days me-1"></i>Calendario
            </button>
        </li>
        <li class="nav-item">
            <button class="nav-link fw-semibold btn-sm" id="tab-galeria-btn" data-bs-toggle="pill" data-bs-target="#vista-galeria" type="button">
                <i class="fas fa-images me-1"></i>Galería de Fotos (<?= count($pares) ?>)
            </button>
        </li>
    </ul>
</div>

<div class="tab-content" id="pills-vistaContent">
    <!-- PESTAÑA 1: CALENDARIO -->
    <div class="tab-pane fade show active" id="vista-calendario" role="tabpanel">
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
    </div>

    <!-- PESTAÑA 2: GALERÍA DE FOTOS -->
    <div class="tab-pane fade" id="vista-galeria" role="tabpanel">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-3">
            <span class="badge bg-success"><?= count($pares) ?> registro(s)</span>
            <div class="input-group input-group-sm" style="max-width:220px;">
                <span class="input-group-text bg-white"><i class="fas fa-search text-muted"></i></span>
                <input type="text" id="buscEv" class="form-control border-start-0" placeholder="Buscar grupo o módulo…">
            </div>
        </div>

        <?php if (empty($pares)): ?>
        <div class="card shadow-sm border-0">
            <div class="card-body text-center py-5 text-muted">
                <i class="fas fa-images fa-3x mb-3 opacity-25 d-block"></i>
                <p class="small mb-0">No hay evidencias registradas para esta ficha aún.</p>
            </div>
        </div>
        <?php else: ?>
        <div id="contPares">
        <?php foreach ($pares as $par):
            $vocPar = trim(($par['vocero_nombres'] ?? '') . ' ' . ($par['vocero_apellidos'] ?? ''));
            $completo = $par['antes'] && $par['despues'];
        ?>
        <div class="par-card par-item"
             data-search="<?= strtolower(htmlspecialchars($par['nombre_grupo'] . ' ' . $par['nombre_modulo'] . ' ' . $vocPar)) ?>">
            <!-- Cabecera -->
            <div class="par-header">
                <i class="fas fa-door-open text-success" style="font-size:.8rem;"></i>
                <span class="par-modulo"><?= htmlspecialchars($par['nombre_modulo']) ?></span>
                <span class="par-grupo">· <?= htmlspecialchars($par['nombre_grupo']) ?></span>
                <?php if ($vocPar): ?>
                <span class="par-vocero">
                    <i class="fas fa-user-tie me-1 text-success" style="font-size:.7rem;"></i>
                    <?= htmlspecialchars($vocPar) ?>
                </span>
                <?php endif; ?>
                <span class="par-fecha">
                    <i class="fas fa-calendar me-1"></i>
                    <?= date('d/m/Y', strtotime($par['fecha_limpieza'])) ?>
                </span>
                <?php if ($completo): ?>
                <span class="badge ms-1" style="background:#dcfce7;color:#166534;font-size:.68rem;">
                    <i class="fas fa-check me-1"></i>Par completo
                </span>
                <?php else: ?>
                <span class="badge ms-1" style="background:#fef3c7;color:#92400e;font-size:.68rem;">
                    Incompleto
                </span>
                <?php endif; ?>
            </div>

            <!-- Fotos lado a lado -->
            <div class="par-fotos">
                <?php if ($par['antes']): ?>
                <div class="par-foto"
                     onclick="verFoto(
                         <?= json_encode('../../public/' . $par['antes']['ruta_archivo']) ?>,
                         <?= json_encode('Antes — ' . $par['nombre_grupo']) ?>,
                         <?= json_encode($par['nombre_modulo'] . ' · ' . date('d/m/Y', strtotime($par['fecha_limpieza']))) ?>
                     )">
                    <img src="../../public/<?= htmlspecialchars($par['antes']['ruta_archivo']) ?>"
                         alt="Antes">
                    <span class="par-foto-label label-antes">
                        <i class="fas fa-clock me-1"></i>Antes
                    </span>
                    <div class="par-foto-overlay"><i class="fas fa-expand"></i></div>
                </div>
                <?php else: ?>
                <div class="par-foto-missing">
                    <i class="fas fa-clock fa-lg opacity-30"></i>
                    <span>Foto antes no subida</span>
                </div>
                <?php endif; ?>

                <?php if ($par['despues']): ?>
                <div class="par-foto"
                     onclick="verFoto(
                         <?= json_encode('../../public/' . $par['despues']['ruta_archivo']) ?>,
                         <?= json_encode('Después — ' . $par['nombre_grupo']) ?>,
                         <?= json_encode($par['nombre_modulo'] . ' · ' . date('d/m/Y', strtotime($par['fecha_limpieza']))) ?>
                     )">
                    <img src="../../public/<?= htmlspecialchars($par['despues']['ruta_archivo']) ?>"
                         alt="Después">
                    <span class="par-foto-label label-despues">
                        <i class="fas fa-circle-check me-1"></i>Después
                    </span>
                    <div class="par-foto-overlay"><i class="fas fa-expand"></i></div>
                </div>
                <?php else: ?>
                <div class="par-foto-missing" style="border-left:1px dashed #d1d5db;">
                    <i class="fas fa-circle-check fa-lg opacity-30"></i>
                    <span>Foto después no subida</span>
                </div>
                <?php endif; ?>
            </div>
        </div>
        <?php endforeach; ?>
        </div><!-- /contPares -->
        <?php endif; ?>
    </div>
</div>

<!-- Modal detalle del día (FullCalendar) -->
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

<?php endif; ?>

<!-- ══ JS ═════════════════════════════════════════════════════════════════════ -->
<script>
// Buscador programas
const buscProg = document.getElementById('buscPrograma');
if (buscProg) {
    buscProg.addEventListener('input', function () {
        const q = this.value.toLowerCase();
        document.querySelectorAll('.prog-item').forEach(el => {
            el.style.display = !q || el.textContent.toLowerCase().includes(q) ? '' : 'none';
        });
    });
}

// Buscador pares (nivel 2 - galería)
const buscEv = document.getElementById('buscEv');
if (buscEv) {
    buscEv.addEventListener('input', function () {
        const q = this.value.toLowerCase();
        document.querySelectorAll('.par-item').forEach(el => {
            el.style.display = !q || el.dataset.search.includes(q) ? '' : 'none';
        });
    });
}

// FullCalendar para nivel 2 (Ficha)
<?php if ($vistaFicha && $fichaAct): ?>
const eventosData = <?= json_encode($eventos ?? [], JSON_UNESCAPED_UNICODE) ?>;
let calInstance   = null;

document.addEventListener('DOMContentLoaded', function () {
    const calEl = document.getElementById('calendario');
    if (calEl && typeof FullCalendar !== 'undefined') {
        calInstance = new FullCalendar.Calendar(calEl, {
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
        calInstance.render();

        const tabCalBtn = document.getElementById('tab-calendario-btn');
        if (tabCalBtn) {
            tabCalBtn.addEventListener('shown.bs.tab', function () {
                if (calInstance) calInstance.updateSize();
            });
        }
    }
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

    // Cargar fotos vía AJAX desde AdminController
    fetch(`../../controllers/AdminController.php?accion=get_evidencia_turno&id_turno=${idTurno}`)
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
<?php endif; ?>

// Lightbox foto individual
function verFoto(url, titulo, subtitulo) {
    Swal.fire({
        imageUrl:  url,
        imageAlt:  titulo,
        title:     titulo,
        text:      subtitulo,
        confirmButtonColor: '#39a900',
        width: 720,
        showCloseButton: true
    });
}

<?php if ($alert): ?>
document.addEventListener('DOMContentLoaded', function () {
    Swal.fire({
        icon:  '<?= addslashes($alert['icon'])  ?>',
        title: '<?= addslashes($alert['title']) ?>',
        text:  '<?= addslashes($alert['text'])  ?>',
        confirmButtonColor: '#39a900'
    });
});
<?php endif; ?>
</script>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
