<?php
$titulo = 'Grupos de Limpieza';
if (session_status() === PHP_SESSION_NONE) session_start();
if (!isset($_SESSION['usuario']) || (int)$_SESSION['usuario']['rol'] !== 1) {
    header("Location: ../usuarios/login.php"); exit;
}
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../models/Grupo.php';
require_once __DIR__ . '/../../models/Programa.php';
require_once __DIR__ . '/../../models/Ficha.php';

$db        = (new Database())->conectar();
$alert     = $_SESSION['alert'] ?? null;
unset($_SESSION['alert']);

$modelProg = new Programa($db);
$modelFich = new Ficha($db);
$modelGrup = new Grupo($db);

$vistaPrograma = (int)($_GET['programa'] ?? 0);
$vistaFicha    = (int)($_GET['ficha']    ?? 0);
$busqueda      = trim($_GET['q']         ?? '');
$filtroEstado  = trim($_GET['estado']    ?? '');

// Nivel 0: todos los programas
$programas = $modelProg->obtenerTodos();

// Nivel 1: fichas del programa
$programaAct   = null;
$fichasDelProg = [];
if ($vistaPrograma) {
    $programaAct = $modelProg->obtenerPorId($vistaPrograma);
    $stmtF = $db->prepare(
        "SELECT f.*,
                ANY_VALUE(v.nombres)   AS vocero_nombres,
                ANY_VALUE(v.apellidos) AS vocero_apellidos,
                COUNT(DISTINCT g.id_grupo) AS total_grupos,
                COUNT(DISTINCT ap.id_aprendiz) AS total_aprendices
         FROM fichas f
         LEFT JOIN voceros    v  ON v.id_ficha  = f.id_ficha AND v.activo = 1
         LEFT JOIN grupos     g  ON g.id_vocero = v.id_vocero
         LEFT JOIN aprendices ap ON ap.id_ficha = f.id_ficha AND ap.activo = 1
         WHERE f.id_programa = :prog AND f.activo = 1
         GROUP BY f.id_ficha
         ORDER BY f.numero_ficha"
    );
    $stmtF->execute([':prog' => $vistaPrograma]);
    $fichasDelProg = $stmtF->fetchAll(PDO::FETCH_ASSOC);
}

// Nivel 2: grupos de la ficha
$fichaAct = null;
$grupos   = [];
if ($vistaFicha) {
    $fichaAct = $modelFich->obtenerPorId($vistaFicha);
    if ($fichaAct) {
        $vistaPrograma = (int)$fichaAct['id_programa'];
        $programaAct   = $modelProg->obtenerPorId($vistaPrograma);

        $stmtF2 = $db->prepare(
            "SELECT f.*,
                    ANY_VALUE(v.nombres) AS vocero_nombres,
                    COUNT(DISTINCT g.id_grupo) AS total_grupos
             FROM fichas f
             LEFT JOIN voceros v ON v.id_ficha = f.id_ficha AND v.activo = 1
             LEFT JOIN grupos  g ON g.id_vocero = v.id_vocero
             WHERE f.id_programa = :prog AND f.activo = 1
             GROUP BY f.id_ficha ORDER BY f.numero_ficha"
        );
        $stmtF2->execute([':prog' => $vistaPrograma]);
        $fichasDelProg = $stmtF2->fetchAll(PDO::FETCH_ASSOC);

        // Todos los grupos de la ficha ordenados por id_grupo ASC
        $stmtG = $db->prepare(
            "SELECT g.*,
                    m.nombre  AS nombre_modulo,
                    f.numero_ficha,
                    v.nombres AS vocero_nombres, v.apellidos AS vocero_apellidos,
                    (SELECT COUNT(*) FROM evidencias e WHERE e.id_grupo = g.id_grupo) AS tiene_evidencia,
                    (SELECT COUNT(*) FROM grupo_integrantes gi WHERE gi.id_grupo = g.id_grupo) AS total_integrantes
             FROM grupos g
             JOIN asignaciones a ON a.id_asignacion = g.id_asignacion
             JOIN modulos      m ON m.id_modulo     = a.id_modulo
             JOIN fichas       f ON f.id_ficha      = a.id_ficha
             JOIN voceros      v ON v.id_vocero     = g.id_vocero
             WHERE a.id_ficha = :fic
             ORDER BY g.id_grupo ASC"
        );
        $stmtG->execute([':fic' => $vistaFicha]);
        $grupos = $stmtG->fetchAll(PDO::FETCH_ASSOC);

        // Cargar integrantes de todos los grupos de una sola vez
        $integrantesPorGrupo = [];
        if (!empty($grupos)) {
            $ids = implode(',', array_column($grupos, 'id_grupo'));
            $stmtI = $db->query(
                "SELECT gi.id_grupo, ap.apellidos, ap.nombres, ap.documento, ap.celular, ap.correo
                 FROM grupo_integrantes gi
                 JOIN aprendices ap ON ap.id_aprendiz = gi.id_aprendiz
                 WHERE gi.id_grupo IN ($ids)
                 ORDER BY gi.id_grupo ASC, ap.apellidos ASC"
            );
            foreach ($stmtI->fetchAll(PDO::FETCH_ASSOC) as $row) {
                $integrantesPorGrupo[(int)$row['id_grupo']][] = $row;
            }
        }
    }
}

require_once __DIR__ . '/../layouts/header.php';
?>

<!-- ══ BREADCRUMB + CABECERA ════════════════════════════════════════════════ -->
<div class="d-flex justify-content-between align-items-start mb-4 flex-wrap gap-3">
    <div>
        <nav aria-label="breadcrumb" class="mb-1">
            <ol class="breadcrumb mb-0" style="font-size:.82rem;">
                <li class="breadcrumb-item">
                    <a href="admin_grupos.php" class="text-success text-decoration-none fw-semibold">
                        <i class="fas fa-people-group me-1"></i>Grupos
                    </a>
                </li>
                <?php if ($programaAct): ?>
                <li class="breadcrumb-item">
                    <?php if ($fichaAct): ?>
                        <a href="admin_grupos.php?programa=<?= $vistaPrograma ?>"
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
                <i class="fas fa-people-group text-success me-2"></i>
                Grupos — Ficha <span class="font-monospace"><?= htmlspecialchars($fichaAct['numero_ficha']) ?></span>
            <?php elseif ($programaAct): ?>
                <i class="fas fa-id-card text-success me-2"></i>
                Fichas — <?= htmlspecialchars($programaAct['nombre']) ?>
            <?php else: ?>
                <i class="fas fa-people-group text-success me-2"></i>Grupos de Limpieza
            <?php endif; ?>
        </h4>
        <p class="text-muted small mb-0">
            <?php if ($fichaAct): ?>
                <?= count($grupos) ?> grupo(s) registrados en esta ficha
            <?php elseif ($programaAct): ?>
                Selecciona una ficha para ver sus grupos
            <?php else: ?>
                Selecciona un programa de formación
            <?php endif; ?>
        </p>
    </div>
</div>

<!-- ══ NIVEL 0: GRID DE PROGRAMAS ════════════════════════════════════════════ -->
<?php if (!$vistaPrograma && !$vistaFicha): ?>

<?php
$stmtTotG = $db->query("SELECT COUNT(*) FROM grupos");
$totalGrupos = (int)$stmtTotG->fetchColumn();
$stmtTotEv = $db->query("SELECT COUNT(*) FROM evidencias");
$totalEv = (int)$stmtTotEv->fetchColumn();
?>
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
                    <i class="fas fa-people-group"></i>
                </div>
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
                <div class="stat-icon" style="background:rgba(234,179,8,.1);color:#d97706;">
                    <i class="fas fa-images"></i>
                </div>
                <div>
                    <div class="fs-4 fw-bold"><?= $totalEv ?></div>
                    <div class="text-muted small">Evidencias registradas</div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="mb-3">
    <div class="input-group input-group-sm" style="max-width:320px;">
        <span class="input-group-text bg-white"><i class="fas fa-search text-muted"></i></span>
        <input type="text" id="buscPrograma" class="form-control border-start-0" placeholder="Buscar programa…">
    </div>
</div>

<div class="row g-3" id="gridProgramas">
    <?php foreach ($programas as $p):
        $stmtGC = $db->prepare(
            "SELECT COUNT(DISTINCT g.id_grupo)
             FROM grupos g
             JOIN asignaciones a ON a.id_asignacion = g.id_asignacion
             WHERE a.id_ficha IN (SELECT id_ficha FROM fichas WHERE id_programa = :prog)"
        );
        $stmtGC->execute([':prog' => $p['id_programa']]);
        $cntG = (int)$stmtGC->fetchColumn();
    ?>
    <div class="col-md-6 col-lg-4 prog-item">
        <a href="admin_grupos.php?programa=<?= $p['id_programa'] ?>" class="text-decoration-none">
            <div class="card border-0 shadow-sm h-100 prog-card" style="border-radius:12px;">
                <div class="card-body p-4">
                    <div class="d-flex align-items-start justify-content-between mb-3">
                        <div style="width:44px;height:44px;border-radius:10px;
                                    background:rgba(37,99,235,.1);color:#2563eb;
                                    display:flex;align-items:center;justify-content:center;font-size:1.2rem;">
                            <i class="fas fa-people-group"></i>
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
                            <div class="fw-bold text-primary fs-5"><?= $cntG ?></div>
                            <div class="text-muted" style="font-size:.72rem;">Grupos</div>
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
        <i class="fas fa-graduation-cap fa-3x mb-3 opacity-25 d-block"></i>No hay programas.
    </div>
    <?php endif; ?>
</div>
<?php endif; ?>

<!-- ══ NIVEL 1: FICHAS DEL PROGRAMA ═════════════════════════════════════════ -->
<?php if ($vistaPrograma && !$vistaFicha): ?>

<div class="row g-3">
    <?php foreach ($fichasDelProg as $f): ?>
    <div class="col-md-6 col-lg-4">
        <a href="admin_grupos.php?programa=<?= $vistaPrograma ?>&ficha=<?= $f['id_ficha'] ?>" class="text-decoration-none">
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
                            <?= htmlspecialchars($f['vocero_nombres']) ?>
                        <?php else: ?>
                            <span class="text-warning"><i class="fas fa-exclamation-circle me-1"></i>Sin vocero</span>
                        <?php endif; ?>
                    </div>
                    <div class="d-flex gap-3 pt-3" style="border-top:1px solid #e5e7eb;">
                        <div>
                            <div class="fw-bold text-primary fs-5"><?= (int)$f['total_grupos'] ?></div>
                            <div class="text-muted" style="font-size:.72rem;">Grupos</div>
                        </div>
                        <div class="ms-auto d-flex align-items-center text-success" style="font-size:.82rem;">
                            Ver grupos <i class="fas fa-arrow-right ms-1"></i>
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

<!-- ══ NIVEL 2: GRUPOS DE LA FICHA ══════════════════════════════════════════ -->
<?php if ($vistaFicha && $fichaAct): ?>

<?php if (empty($grupos)): ?>
<div class="card border-0 shadow-sm text-center py-5 text-muted">
    <i class="fas fa-people-group fa-3x mb-3 opacity-25 d-block"></i>
    <p class="small mb-0">No hay grupos registrados en esta ficha.</p>
</div>
<?php else: ?>

<div class="d-flex align-items-center justify-content-between mb-3 flex-wrap gap-2">
    <span class="text-muted small"><?= count($grupos) ?> grupo(s) · ordenados por creación</span>
</div>

<?php foreach ($grupos as $numGrupo => $g):
    $integrantes = $integrantesPorGrupo[(int)$g['id_grupo']] ?? [];
    $badge = match($g['estado']) {
        'Completado' => ['bg'=>'#dbeafe','color'=>'#1d4ed8','label'=>'Completado'],
        'Sancionado' => ['bg'=>'#fee2e2','color'=>'#991b1b','label'=>'Sancionado'],
        default      => ['bg'=>'#dcfce7','color'=>'#166534','label'=>'Activo'],
    };
    $esHoy = date('Y-m-d', strtotime($g['fecha_limpieza'])) === date('Y-m-d');
?>
<div class="card border-0 shadow-sm mb-3" style="border-radius:12px; overflow:hidden;">

    <!-- Cabecera del grupo -->
    <div class="d-flex align-items-center gap-3 px-4 py-3"
         style="background:#f9fafb; border-bottom:1px solid #e5e7eb;">
        <!-- Número de grupo -->
        <div style="width:38px;height:38px;border-radius:9px;background:#39a900;
                    display:flex;align-items:center;justify-content:center;
                    color:#fff;font-weight:700;font-size:1rem;flex-shrink:0;">
            <?= $numGrupo + 1 ?>
        </div>
        <div class="flex-grow-1">
            <div class="fw-bold" style="font-size:.95rem;color:#111827;">
                <?= htmlspecialchars($g['nombre_grupo']) ?>
                <?php if ($esHoy): ?>
                    <span class="badge bg-warning text-dark ms-1" style="font-size:.65rem;">Hoy</span>
                <?php endif; ?>
            </div>
            <div class="text-muted" style="font-size:.78rem;">
                <i class="fas fa-user-tie me-1 text-success"></i>
                <?= htmlspecialchars($g['vocero_nombres'] . ' ' . $g['vocero_apellidos']) ?>
                <span class="mx-2">·</span>
                <i class="fas fa-door-open me-1"></i><?= htmlspecialchars($g['nombre_modulo']) ?>
                <span class="mx-2">·</span>
                <i class="fas fa-calendar me-1"></i><?= date('d/m/Y', strtotime($g['fecha_limpieza'])) ?>
            </div>
        </div>
        <div class="d-flex align-items-center gap-2 flex-shrink-0">
            <!-- Evidencia -->
            <?php if ((int)$g['tiene_evidencia'] > 0): ?>
                <span title="Con evidencia"
                      style="background:#dcfce7;color:#166534;padding:.25rem .6rem;
                             border-radius:20px;font-size:.72rem;font-weight:600;">
                    <i class="fas fa-check me-1"></i>Evidencia
                </span>
            <?php else: ?>
                <span style="background:#fee2e2;color:#991b1b;padding:.25rem .6rem;
                              border-radius:20px;font-size:.72rem;font-weight:600;">
                    <i class="fas fa-xmark me-1"></i>Sin evidencia
                </span>
            <?php endif; ?>
            <!-- Estado -->
            <span style="background:<?= $badge['bg'] ?>;color:<?= $badge['color'] ?>;
                         padding:.25rem .65rem;border-radius:20px;
                         font-size:.72rem;font-weight:600;">
                <?= $badge['label'] ?>
            </span>
            <!-- Conteo integrantes -->
            <span style="background:#f3f4f6;color:#374151;padding:.25rem .65rem;
                         border-radius:20px;font-size:.72rem;font-weight:600;">
                <i class="fas fa-users me-1"></i><?= count($integrantes) ?>
            </span>
        </div>
    </div>

    <!-- Integrantes -->
    <?php if (empty($integrantes)): ?>
    <div class="px-4 py-3 text-muted small">Sin integrantes registrados.</div>
    <?php else: ?>
    <div class="table-responsive">
        <table class="table mb-0" style="font-size:.82rem;">
            <thead>
                <tr style="background:#f9fafb; border-bottom:1px solid #e5e7eb;">
                    <th style="padding:.5rem 1rem;font-weight:700;color:#6b7280;font-size:.72rem;text-transform:uppercase;letter-spacing:.4px;">#</th>
                    <th style="padding:.5rem .75rem;font-weight:700;color:#6b7280;font-size:.72rem;text-transform:uppercase;letter-spacing:.4px;">Apellidos</th>
                    <th style="padding:.5rem .75rem;font-weight:700;color:#6b7280;font-size:.72rem;text-transform:uppercase;letter-spacing:.4px;">Nombres</th>
                    <th style="padding:.5rem .75rem;font-weight:700;color:#6b7280;font-size:.72rem;text-transform:uppercase;letter-spacing:.4px;">Documento</th>
                    <th style="padding:.5rem .75rem;font-weight:700;color:#6b7280;font-size:.72rem;text-transform:uppercase;letter-spacing:.4px;">Celular</th>
                    <th style="padding:.5rem .75rem;font-weight:700;color:#6b7280;font-size:.72rem;text-transform:uppercase;letter-spacing:.4px;">Correo</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($integrantes as $idx => $ap): ?>
            <tr style="border-bottom:1px solid #f3f4f6;">
                <td style="padding:.55rem 1rem;color:#9ca3af;"><?= $idx + 1 ?></td>
                <td style="padding:.55rem .75rem;font-weight:600;color:#111827;"><?= htmlspecialchars($ap['apellidos']) ?></td>
                <td style="padding:.55rem .75rem;color:#374151;"><?= htmlspecialchars($ap['nombres']) ?></td>
                <td style="padding:.55rem .75rem;color:#6b7280;"><?= htmlspecialchars($ap['documento'] ?? '—') ?></td>
                <td style="padding:.55rem .75rem;">
                    <?php if (!empty($ap['celular'])): ?>
                        <a href="tel:<?= htmlspecialchars($ap['celular']) ?>"
                           class="text-decoration-none text-dark">
                            <i class="fas fa-phone text-success me-1" style="font-size:.68rem;"></i><?= htmlspecialchars($ap['celular']) ?>
                        </a>
                    <?php else: ?><span class="text-muted">—</span><?php endif; ?>
                </td>
                <td style="padding:.55rem .75rem;">
                    <?php if (!empty($ap['correo'])): ?>
                        <a href="mailto:<?= htmlspecialchars($ap['correo']) ?>"
                           class="text-decoration-none text-dark text-truncate d-inline-block"
                           style="max-width:180px;" title="<?= htmlspecialchars($ap['correo']) ?>">
                            <i class="fas fa-envelope text-success me-1" style="font-size:.68rem;"></i><?= htmlspecialchars($ap['correo']) ?>
                        </a>
                    <?php else: ?><span class="text-muted">—</span><?php endif; ?>
                </td>
            </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php endif; ?>

</div><!-- /card grupo -->
<?php endforeach; ?>

<?php endif; ?>
<?php endif; ?>

<style>
.prog-card { transition: transform .2s, box-shadow .2s; cursor: pointer; }
.prog-card:hover { transform: translateY(-3px); box-shadow: 0 8px 24px rgba(0,0,0,.1) !important; }
.breadcrumb-item + .breadcrumb-item::before { color: #9ca3af; }
</style>

<script>
const bP = document.getElementById('buscPrograma');
if (bP) {
    bP.addEventListener('input', function () {
        const q = this.value.toLowerCase();
        document.querySelectorAll('.prog-item').forEach(el => {
            el.style.display = !q || el.textContent.toLowerCase().includes(q) ? '' : 'none';
        });
    });
}
<?php if ($alert): ?>
document.addEventListener('DOMContentLoaded', function () {
    Swal.fire({ icon:'<?= addslashes($alert['icon']) ?>', title:'<?= addslashes($alert['title']) ?>', text:'<?= addslashes($alert['text']) ?>', confirmButtonColor:'#39a900' });
});
<?php endif; ?>
</script>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
