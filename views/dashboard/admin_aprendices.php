<?php
$titulo = 'Aprendices';
if (session_status() === PHP_SESSION_NONE) session_start();
if (!isset($_SESSION['usuario']) || (int)$_SESSION['usuario']['rol'] !== 1) {
    header("Location: ../usuarios/login.php"); exit;
}
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../models/Programa.php';
require_once __DIR__ . '/../../models/Ficha.php';

$db        = (new Database())->conectar();
$alert     = $_SESSION['alert'] ?? null;
unset($_SESSION['alert']);

$vistaPrograma = (int)($_GET['programa'] ?? 0);
$vistaFicha    = (int)($_GET['ficha']    ?? 0);
$busqueda      = trim($_GET['q']         ?? '');

$modelProg = new Programa($db);
$modelFich = new Ficha($db);

// ── Nivel 0: todos los programas con stats ──────────────────────────────────
$programas = $modelProg->obtenerTodos();

// Stats globales
$stmtTotal = $db->query("SELECT COUNT(*) FROM aprendices WHERE activo = 1");
$totalAprendices = (int)$stmtTotal->fetchColumn();

// ── Nivel 1: fichas del programa ────────────────────────────────────────────
$programaAct   = null;
$fichasDelProg = [];
if ($vistaPrograma) {
    $programaAct = $modelProg->obtenerPorId($vistaPrograma);
    $stmtF = $db->prepare(
        "SELECT f.*,
                ANY_VALUE(v.nombres)   AS vocero_nombres,
                ANY_VALUE(v.apellidos) AS vocero_apellidos,
                COUNT(DISTINCT a.id_aprendiz) AS total_aprendices
         FROM fichas f
         LEFT JOIN voceros    v ON v.id_ficha  = f.id_ficha AND v.activo = 1
         LEFT JOIN aprendices a ON a.id_ficha  = f.id_ficha AND a.activo = 1
         WHERE f.id_programa = :prog AND f.activo = 1
         GROUP BY f.id_ficha
         ORDER BY f.numero_ficha"
    );
    $stmtF->execute([':prog' => $vistaPrograma]);
    $fichasDelProg = $stmtF->fetchAll(PDO::FETCH_ASSOC);
}

// ── Nivel 2: aprendices de una ficha ───────────────────────────────────────
$fichaAct   = null;
$aprendices = [];
if ($vistaFicha) {
    $fichaAct = $modelFich->obtenerPorId($vistaFicha);
    if ($fichaAct) {
        $vistaPrograma = (int)$fichaAct['id_programa'];
        $programaAct   = $modelProg->obtenerPorId($vistaPrograma);
        // Volver a cargar fichas del programa para el breadcrumb
        $stmtF2 = $db->prepare(
            "SELECT f.*,
                    ANY_VALUE(v.nombres)   AS vocero_nombres,
                    COUNT(DISTINCT a.id_aprendiz) AS total_aprendices
             FROM fichas f
             LEFT JOIN voceros    v ON v.id_ficha = f.id_ficha AND v.activo = 1
             LEFT JOIN aprendices a ON a.id_ficha = f.id_ficha AND a.activo = 1
             WHERE f.id_programa = :prog AND f.activo = 1
             GROUP BY f.id_ficha ORDER BY f.numero_ficha"
        );
        $stmtF2->execute([':prog' => $vistaPrograma]);
        $fichasDelProg = $stmtF2->fetchAll(PDO::FETCH_ASSOC);

        // Primero traer los voceros activos e inactivos de esta ficha indexados por id_aprendiz
        $stmtVoc = $db->prepare(
            "SELECT v.id_vocero, v.id_aprendiz, v.activo AS vocero_activo,
                    u.primer_acceso, u.activo AS usuario_activo
             FROM voceros v
             JOIN usuarios u ON u.id_usuario = v.id_usuario
             WHERE v.id_ficha = :fic AND v.id_aprendiz IS NOT NULL
             ORDER BY v.activo DESC, v.id_vocero DESC"
        );
        $stmtVoc->execute([':fic' => $vistaFicha]);
        // Un mapa id_aprendiz → vocero (activo tiene prioridad)
        $vocPorAprendiz = [];
        foreach ($stmtVoc->fetchAll(PDO::FETCH_ASSOC) as $voc) {
            $idAp = (int)$voc['id_aprendiz'];
            if (!isset($vocPorAprendiz[$idAp])) {
                $vocPorAprendiz[$idAp] = $voc;
            } elseif ((int)$voc['vocero_activo'] === 1 && (int)$vocPorAprendiz[$idAp]['vocero_activo'] === 0) {
                $vocPorAprendiz[$idAp] = $voc;
            }
        }

        // Traer aprendices con query limpia (sin JOIN a voceros)
        $sqlAp = "SELECT a.id_aprendiz, a.nombres, a.apellidos, a.documento,
                         a.celular, a.correo
                  FROM aprendices a
                  WHERE a.id_ficha = :fic AND a.activo = 1";
        if ($busqueda) {
            $sqlAp .= " AND (a.nombres LIKE :q OR a.apellidos LIKE :q2 OR a.documento LIKE :q3)";
        }
        $sqlAp .= " ORDER BY a.apellidos, a.nombres";
        $stmtAp = $db->prepare($sqlAp);
        $paramsAp = [':fic' => $vistaFicha];
        if ($busqueda) {
            $like = '%' . $busqueda . '%';
            $paramsAp[':q'] = $like; $paramsAp[':q2'] = $like; $paramsAp[':q3'] = $like;
        }
        $stmtAp->execute($paramsAp);
        $aprendices = $stmtAp->fetchAll(PDO::FETCH_ASSOC);

        // Cruzar cada aprendiz con su vocero exacto por id_aprendiz (1:1 garantizado)
        foreach ($aprendices as &$ap) {
            $idAp = (int)$ap['id_aprendiz'];
            if (isset($vocPorAprendiz[$idAp])) {
                $ap['id_vocero']      = $vocPorAprendiz[$idAp]['id_vocero'];
                $ap['vocero_activo']  = $vocPorAprendiz[$idAp]['vocero_activo'];
                $ap['primer_acceso']  = $vocPorAprendiz[$idAp]['primer_acceso'];
                $ap['usuario_activo'] = $vocPorAprendiz[$idAp]['usuario_activo'];
            } else {
                $ap['id_vocero']      = null;
                $ap['vocero_activo']  = null;
                $ap['primer_acceso']  = null;
                $ap['usuario_activo'] = null;
            }
        }
        unset($ap);

        // ¿Cuántos voceros activos tiene esta ficha? (máximo 2)
        $stmtVAct = $db->prepare("SELECT COUNT(*) FROM voceros WHERE id_ficha = :fic AND activo = 1");
        $stmtVAct->execute([':fic' => $vistaFicha]);
        $totalVocerosActivos = (int)$stmtVAct->fetchColumn();
        $hayVoceroActivo = $totalVocerosActivos >= 2; // bloquear si ya hay 2
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
                    <a href="admin_aprendices.php" class="text-success text-decoration-none fw-semibold">
                        <i class="fas fa-users me-1"></i>Aprendices
                    </a>
                </li>
                <?php if ($programaAct): ?>
                <li class="breadcrumb-item">
                    <?php if ($fichaAct): ?>
                        <a href="admin_aprendices.php?programa=<?= $vistaPrograma ?>"
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
                <i class="fas fa-users text-success me-2"></i>
                Aprendices — Ficha <span class="font-monospace"><?= htmlspecialchars($fichaAct['numero_ficha']) ?></span>
            <?php elseif ($programaAct): ?>
                <i class="fas fa-id-card text-success me-2"></i>
                Fichas — <?= htmlspecialchars($programaAct['nombre']) ?>
            <?php else: ?>
                <i class="fas fa-users text-success me-2"></i>Aprendices
            <?php endif; ?>
        </h4>
        <p class="text-muted small mb-0">
            <?php if ($fichaAct): ?>
                <?= count($aprendices) ?> aprendice(s) en esta ficha
            <?php elseif ($programaAct): ?>
                Selecciona una ficha para ver sus aprendices
            <?php else: ?>
                Selecciona un programa de formación
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
                    <div class="fs-4 fw-bold"><?= array_sum(array_column($programas, 'total_fichas')) ?></div>
                    <div class="text-muted small">Fichas activas</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="stat-card bg-white">
            <div class="d-flex align-items-center gap-3">
                <div class="stat-icon" style="background:rgba(234,179,8,.1);color:#d97706;">
                    <i class="fas fa-users"></i>
                </div>
                <div>
                    <div class="fs-4 fw-bold"><?= $totalAprendices ?></div>
                    <div class="text-muted small">Total aprendices</div>
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
    <?php foreach ($programas as $p): ?>
    <div class="col-md-6 col-lg-4 prog-item">
        <a href="admin_aprendices.php?programa=<?= $p['id_programa'] ?>"
           class="text-decoration-none">
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
    <div class="col-12">
        <div class="card border-0 shadow-sm text-center py-5 text-muted">
            <i class="fas fa-graduation-cap fa-3x mb-3 opacity-25 d-block"></i>
            No hay programas registrados.
        </div>
    </div>
    <?php endif; ?>
</div>
<?php endif; ?>

<!-- ══ NIVEL 1: FICHAS DEL PROGRAMA ═════════════════════════════════════════ -->
<?php if ($vistaPrograma && !$vistaFicha): ?>

<?php $totalApProg = array_sum(array_column($fichasDelProg, 'total_aprendices')); ?>
<div class="row g-3 mb-4">
    <div class="col-sm-4">
        <div class="stat-card bg-white">
            <div class="d-flex align-items-center gap-3">
                <div class="stat-icon" style="background:rgba(37,99,235,.1);color:#2563eb;">
                    <i class="fas fa-id-card"></i>
                </div>
                <div>
                    <div class="fs-4 fw-bold"><?= count($fichasDelProg) ?></div>
                    <div class="text-muted small">Fichas en el programa</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="stat-card bg-white">
            <div class="d-flex align-items-center gap-3">
                <div class="stat-icon" style="background:rgba(57,169,0,.12);color:#39a900;">
                    <i class="fas fa-users"></i>
                </div>
                <div>
                    <div class="fs-4 fw-bold"><?= $totalApProg ?></div>
                    <div class="text-muted small">Aprendices en el programa</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="stat-card bg-white">
            <div class="d-flex align-items-center gap-3">
                <div class="stat-icon" style="background:rgba(234,179,8,.1);color:#d97706;">
                    <i class="fas fa-user-tie"></i>
                </div>
                <div>
                    <div class="fs-4 fw-bold">
                        <?= count(array_filter($fichasDelProg, fn($f) => !empty($f['vocero_nombres']))) ?>
                        /<?= count($fichasDelProg) ?>
                    </div>
                    <div class="text-muted small">Con vocero asignado</div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-3">
    <?php foreach ($fichasDelProg as $f): ?>
    <div class="col-md-6 col-lg-4">
        <a href="admin_aprendices.php?ficha=<?= $f['id_ficha'] ?>" class="text-decoration-none">
            <div class="card border-0 shadow-sm h-100 prog-card" style="border-radius:12px;">
                <div class="card-body p-4">
                    <div class="d-flex align-items-start justify-content-between mb-3">
                        <div style="width:44px;height:44px;border-radius:10px;
                                    background:rgba(37,99,235,.1);color:#2563eb;
                                    display:flex;align-items:center;justify-content:center;font-size:1.1rem;">
                            <i class="fas fa-id-card"></i>
                        </div>
                        <span class="badge bg-light text-dark border">
                            <?= htmlspecialchars($f['jornada']) ?>
                        </span>
                    </div>
                    <div class="fw-bold text-success font-monospace mb-1" style="font-size:1.3rem;">
                        <?= htmlspecialchars($f['numero_ficha']) ?>
                    </div>
                    <div class="text-muted small mb-3">
                        <?php if ($f['vocero_nombres']): ?>
                            <i class="fas fa-user-tie me-1" style="font-size:.75rem;"></i>
                            <?= htmlspecialchars($f['vocero_nombres']) ?>
                        <?php else: ?>
                            <span class="text-warning"><i class="fas fa-exclamation-circle me-1"></i>Sin vocero</span>
                        <?php endif; ?>
                    </div>
                    <div class="d-flex gap-3 pt-3" style="border-top:1px solid #e5e7eb;">
                        <div>
                            <div class="fw-bold text-success fs-5"><?= (int)$f['total_aprendices'] ?></div>
                            <div class="text-muted" style="font-size:.72rem;">Aprendices</div>
                        </div>
                        <div class="ms-auto d-flex align-items-center text-success" style="font-size:.82rem;">
                            Ver lista <i class="fas fa-arrow-right ms-1"></i>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <?php endforeach; ?>
    <?php if (empty($fichasDelProg)): ?>
    <div class="col-12">
        <div class="card border-0 shadow-sm text-center py-5 text-muted">
            <i class="fas fa-id-card fa-3x mb-3 opacity-25 d-block"></i>
            No hay fichas registradas en este programa.
        </div>
    </div>
    <?php endif; ?>
</div>
<?php endif; ?>

<!-- ══ NIVEL 2: APRENDICES DE LA FICHA ══════════════════════════════════════ -->
<?php if ($vistaFicha && $fichaAct): ?>

<div class="row g-3 mb-4">
    <div class="col-sm-4">
        <div class="stat-card bg-white">
            <div class="d-flex align-items-center gap-3">
                <div class="stat-icon" style="background:rgba(57,169,0,.12);color:#39a900;">
                    <i class="fas fa-users"></i>
                </div>
                <div>
                    <div class="fs-4 fw-bold"><?= count($aprendices) ?></div>
                    <div class="text-muted small">Aprendices en la ficha</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="stat-card bg-white">
            <div class="d-flex align-items-center gap-3">
                <div class="stat-icon" style="background:rgba(234,179,8,.1);color:#d97706;">
                    <i class="fas fa-user-tie"></i>
                </div>
                <div>
                    <div class="fs-4 fw-bold"><?= $totalVocerosActivos ?>/2</div>
                    <div class="text-muted small">Voceros activos</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="stat-card bg-white">
            <div class="d-flex align-items-center gap-3">
                <div class="stat-icon" style="background:rgba(37,99,235,.1);color:#2563eb;">
                    <i class="fas fa-clock"></i>
                </div>
                <div>
                    <div class="fw-bold"><?= htmlspecialchars($fichaAct['jornada']) ?></div>
                    <div class="text-muted small">Jornada</div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Buscador inline -->
<div class="card shadow-sm border-0">
    <div class="card-header bg-white border-0 py-3 d-flex justify-content-between align-items-center flex-wrap gap-2">
        <h6 class="fw-bold mb-0">
            <i class="fas fa-users text-success me-2"></i>
            Listado de Aprendices
            <span class="text-muted fw-normal small ms-2">— <?= htmlspecialchars($fichaAct['nombre_programa']) ?></span>
        </h6>
        <div class="d-flex gap-2 align-items-center">
            <span class="badge bg-success"><?= count($aprendices) ?> aprendice(s)</span>
            <form method="GET" class="d-flex gap-1">
                <input type="hidden" name="ficha" value="<?= $vistaFicha ?>">
                <div class="input-group input-group-sm" style="max-width:220px;">
                    <span class="input-group-text bg-white"><i class="fas fa-search text-muted"></i></span>
                    <input type="text" name="q" class="form-control border-start-0"
                           placeholder="Buscar…" value="<?= htmlspecialchars($busqueda) ?>">
                </div>
                <button type="submit" class="btn btn-sm btn-success"><i class="fas fa-search"></i></button>
                <?php if ($busqueda): ?>
                    <a href="admin_aprendices.php?ficha=<?= $vistaFicha ?>"
                       class="btn btn-sm btn-outline-secondary"><i class="fas fa-xmark"></i></a>
                <?php endif; ?>
            </form>
        </div>
    </div>
    <!-- Nota informativa -->
    <div class="px-4 py-2" style="background:#f8fafc; border-bottom:1px solid #e5e7eb; font-size:.8rem; color:#64748b;">
        <i class="fas fa-circle-info me-1 text-success"></i>
        Cambia el rol de un aprendiz a <strong>Vocero</strong> para activar su cuenta de acceso al sistema.
        Puede haber <strong>máximo 2 voceros activos</strong> por ficha (vocero y subvocero).
        Al cambiarlo a <strong>Aprendiz</strong> su cuenta queda desactivada.
    </div>
    <div class="card-body p-0">
        <?php if (empty($aprendices)): ?>
        <div class="text-center py-5 text-muted">
            <i class="fas fa-users fa-3x mb-3 opacity-25 d-block"></i>
            <p class="small mb-0">
                <?= $busqueda ? 'No hay resultados para "' . htmlspecialchars($busqueda) . '".' : 'No hay aprendices sincronizados en esta ficha.' ?>
            </p>
        </div>
        <?php else: ?>
        <div class="table-responsive">
            <table class="table tabla-limpia align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Apellidos</th>
                        <th>Nombres</th>
                        <th>Documento</th>
                        <th>Celular</th>
                        <th>Correo</th>
                        <th class="text-center">Rol</th>
                        <th class="text-center">Acceso</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($aprendices as $i => $ap):
                    $tieneVoceroActivo   = !empty($ap['id_vocero']) && (int)($ap['vocero_activo'] ?? 0) === 1;
                    $tieneVoceroInactivo = !empty($ap['id_vocero']) && (int)($ap['vocero_activo'] ?? 0) === 0;
                    $celular = $ap['celular'] ?? null;
                    $correo  = $ap['correo']  ?? null;
                ?>
                <tr class="<?= $tieneVoceroActivo ? 'table-warning bg-opacity-25' : ($tieneVoceroInactivo ? 'table-secondary bg-opacity-10' : '') ?>">
                    <td class="text-muted small"><?= $i + 1 ?></td>
                    <td class="fw-semibold small"><?= htmlspecialchars($ap['apellidos']) ?></td>
                    <td class="small"><?= htmlspecialchars($ap['nombres']) ?></td>
                    <td class="small text-muted"><?= htmlspecialchars($ap['documento'] ?? '—') ?></td>
                    <td class="small">
                        <?php if ($celular): ?>
                            <a href="tel:<?= htmlspecialchars($celular) ?>" class="text-decoration-none text-dark">
                                <i class="fas fa-phone text-success me-1" style="font-size:.72rem;"></i><?= htmlspecialchars($celular) ?>
                            </a>
                        <?php else: ?><span class="text-muted">—</span><?php endif; ?>
                    </td>
                    <td class="small">
                        <?php if ($correo): ?>
                            <a href="mailto:<?= htmlspecialchars($correo) ?>"
                               class="text-decoration-none text-dark text-truncate d-inline-block"
                               style="max-width:160px;" title="<?= htmlspecialchars($correo) ?>">
                                <i class="fas fa-envelope text-success me-1" style="font-size:.72rem;"></i><?= htmlspecialchars($correo) ?>
                            </a>
                        <?php else: ?><span class="text-muted">—</span><?php endif; ?>
                    </td>
                    <td class="text-center" style="width:160px;">
                        <?php
                        $tieneVoceroActivo   = !empty($ap['id_vocero']) && (int)($ap['vocero_activo'] ?? 0) === 1;
                        $tieneVoceroInactivo = !empty($ap['id_vocero']) && (int)($ap['vocero_activo'] ?? 0) === 0;
                        // ID único por fila: usa id_aprendiz si existe, sino id_vocero con prefijo v
                        $uid = $ap['id_aprendiz'] ?? 'v' . ($ap['id_vocero'] ?? $i);
                        ?>
                        <form action="../../controllers/AdminController.php" method="POST"
                              id="form-ap-<?= $uid ?>">
                            <input type="hidden" name="id_aprendiz" value="<?= $ap['id_aprendiz'] ?? '' ?>">
                            <input type="hidden" name="id_ficha"    value="<?= $vistaFicha ?>">
                            <input type="hidden" name="id_vocero"   value="<?= $ap['id_vocero'] ?? '' ?>">
                            <input type="hidden" name="accion"      id="accion-<?= $uid ?>">

                            <?php if ($tieneVoceroActivo): ?>
                                <select class="form-select form-select-sm rol-select"
                                        data-uid="<?= $uid ?>"
                                        data-form="form-ap-<?= $uid ?>"
                                        data-accion-up="reactivar_vocero"
                                        data-accion-down="desactivar_vocero"
                                        data-nombre="<?= htmlspecialchars($ap['nombres'] . ' ' . $ap['apellidos']) ?>"
                                        style="border-color:#39a900;color:#166534;background:#f0fdf4;font-weight:600;">
                                    <option value="aprendiz">Aprendiz</option>
                                    <option value="vocero" selected>Vocero</option>
                                </select>
                            <?php elseif ($tieneVoceroInactivo && !$hayVoceroActivo): ?>
                                <select class="form-select form-select-sm rol-select"
                                        data-uid="<?= $uid ?>"
                                        data-form="form-ap-<?= $uid ?>"
                                        data-accion-up="reactivar_vocero"
                                        data-accion-down="desactivar_vocero"
                                        data-nombre="<?= htmlspecialchars($ap['nombres'] . ' ' . $ap['apellidos']) ?>"
                                        style="color:#6b7280;">
                                    <option value="aprendiz" selected>Aprendiz</option>
                                    <option value="vocero">Vocero</option>
                                </select>
                            <?php elseif (!$tieneVoceroActivo && !$tieneVoceroInactivo && !$hayVoceroActivo): ?>
                                <select class="form-select form-select-sm rol-select"
                                        data-uid="<?= $uid ?>"
                                        data-form="form-ap-<?= $uid ?>"
                                        data-accion-up="activar_vocero"
                                        data-accion-down=""
                                        data-nombre="<?= htmlspecialchars($ap['nombres'] . ' ' . $ap['apellidos']) ?>"
                                        style="color:#6b7280;">
                                    <option value="aprendiz" selected>Aprendiz</option>
                                    <option value="vocero">Vocero</option>
                                </select>
                            <?php else: ?>
                                <select class="form-select form-select-sm" disabled
                                        style="color:#9ca3af;"
                                        title="<?= $tieneVoceroInactivo ? 'Ya hay 2 voceros activos' : 'Ya hay 2 voceros activos en esta ficha' ?>">
                                    <option>Aprendiz</option>
                                </select>
                            <?php endif; ?>
                        </form>
                    </td>
                    <td class="text-center">
                        <?php if ($tieneVoceroActivo): ?>
                            <?php if ((int)($ap['primer_acceso'] ?? 1) === 0): ?>
                                <span class="badge bg-success">
                                    <i class="fas fa-check me-1"></i>Activo
                                </span>
                            <?php else: ?>
                                <span class="badge bg-warning text-dark" style="font-size:.7rem;">
                                    <i class="fas fa-clock me-1"></i>1er acceso
                                </span>
                            <?php endif; ?>
                        <?php elseif ($tieneVoceroInactivo): ?>
                            <span class="badge bg-secondary" style="font-size:.7rem;">
                                <i class="fas fa-ban me-1"></i>Inactivo
                            </span>
                        <?php else: ?>
                            <span class="text-muted" style="font-size:.75rem;">—</span>
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
<?php endif; ?>

<!-- ══ ESTILOS + JS ═══════════════════════════════════════════════════════════ -->
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

// ── Selects de rol ────────────────────────────────────────────────────────
// Se usa change con confirmación SweetAlert para evitar disparos accidentales
// (bfcache, autocomplete del navegador, etc.)
document.querySelectorAll('.rol-select').forEach(function(sel) {
    // Guardar el valor original al cargar la página
    const valorOriginal = sel.value;

    sel.addEventListener('change', function() {
        const nuevoValor = this.value;
        const nombre     = this.dataset.nombre;
        const formId     = this.dataset.form;
        const accionUp   = this.dataset.accionUp;   // vocero → activar/reactivar
        const accionDown = this.dataset.accionDown; // aprendiz → desactivar
        const accionInput = document.getElementById('accion-' + this.dataset.uid);

        const esSubida = (nuevoValor === 'vocero');
        const accion   = esSubida ? accionUp : accionDown;

        // Si no hay acción definida para este sentido, revertir y salir
        if (!accion) {
            this.value = valorOriginal;
            return;
        }

        const titulo  = esSubida
            ? '¿Activar como Vocero?'
            : '¿Quitar rol de Vocero?';
        const mensaje = esSubida
            ? `${nombre} obtendrá acceso al sistema como vocero.`
            : `${nombre} volverá a ser aprendiz y perderá acceso al sistema.`;
        const btnColor = esSubida ? '#39a900' : '#ef4444';

        // Guardar referencia al select para poder revertir si cancela
        const selectRef = this;

        Swal.fire({
            title:              titulo,
            text:               mensaje,
            icon:               esSubida ? 'question' : 'warning',
            showCancelButton:   true,
            confirmButtonText:  'Sí, confirmar',
            cancelButtonText:   'Cancelar',
            confirmButtonColor: btnColor,
            cancelButtonColor:  '#6b7280',
        }).then(function(result) {
            if (result.isConfirmed) {
                accionInput.value = accion;
                document.getElementById(formId).submit();
            } else {
                // Revertir el select al valor original
                selectRef.value = valorOriginal;
            }
        });
    });
});

<?php if ($alert): ?>
document.addEventListener('DOMContentLoaded', function () {
    Swal.fire({ icon:'<?= addslashes($alert['icon']) ?>', title:'<?= addslashes($alert['title']) ?>', text:'<?= addslashes($alert['text']) ?>', confirmButtonColor:'#39a900' });
});
<?php endif; ?>
</script>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
