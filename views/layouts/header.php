<?php
if (session_status() === PHP_SESSION_NONE) session_start();

// Evitar que el navegador cachee las páginas protegidas.
// Así el botón "atrás" siempre hace una nueva petición al servidor
// y el guard de sesión se ejecuta correctamente.
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");

if (!isset($_SESSION['usuario'])) {
    header("Location: ../usuarios/login.php");
    exit;
}

$usuario       = $_SESSION['usuario'];
$titulo        = $titulo ?? 'Dashboard';
$rolId         = (int)($usuario['rol'] ?? 0);
$nombreCompleto = trim(($usuario['nombres'] ?? '') . ' ' . ($usuario['apellidos'] ?? ''));
$paginaActual  = basename($_SERVER['PHP_SELF']);

// Notificaciones no leídas
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../models/Notificacion.php';
$_db          = (new Database())->conectar();
$_modelNoti   = new Notificacion($_db);
$_countNoti   = $_modelNoti->contarNoLeidas($usuario['id_usuario']);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($titulo) ?> – GestiLimpieza SENA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        * { box-sizing: border-box; }

        :root {
            --sena-green:  #39a900;
            --sena-dark:   #1e5c00;
            --sena-light:  #d4edda;
            --sidebar-bg:  #0a1a00;
            --sidebar-border: rgba(57,169,0,.15);
            --topbar-bg:   #0a1a00;
            --content-bg:  #f0f4f0;
        }

        body {
            background: var(--content-bg);
            min-height: 100vh;
            font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            margin: 0; padding: 0;
        }

        /* ── SIDEBAR ─────────────────────────────────────────────────────── */
        #sidebar {
            width: 260px; min-width: 260px;
            background: var(--sidebar-bg);
            border-right: 1px solid var(--sidebar-border);
            min-height: 100vh;
            position: sticky; top: 0;
            display: flex; flex-direction: column;
            z-index: 100;
        }

        .sidebar-brand {
            padding: 1.4rem 1.2rem;
            border-bottom: 1px solid var(--sidebar-border);
            display: flex; align-items: center; gap: .85rem;
        }

        .brand-icon-box {
            width: 42px; height: 42px;
            background: var(--sena-green);
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }

        .brand-name {
            color: #f0fff0;
            font-size: .95rem; font-weight: 700; line-height: 1.25;
        }
        .brand-sub {
            color: #5a8a50;
            font-size: .7rem; margin-top: 2px;
        }

        .sidebar-nav    { padding: .8rem .6rem; flex: 1; overflow-y: auto; }
        .sidebar-section {
            color: #3a6030;
            font-size: .68rem; font-weight: 700;
            letter-spacing: 1px; text-transform: uppercase;
            padding: .9rem 1rem .4rem;
        }

        .sidebar-nav .nav-link {
            color: #7aaa70;
            padding: .65rem 1rem; border-radius: 8px; margin-bottom: 2px;
            font-size: .875rem; font-weight: 500;
            transition: all .18s ease;
            display: flex; align-items: center; gap: .75rem;
            text-decoration: none;
        }
        .sidebar-nav .nav-link i { width: 18px; text-align: center; font-size: .95rem; }

        .sidebar-nav .nav-link:hover,
        .sidebar-nav .nav-link.active {
            background: rgba(57,169,0,.18) !important;
            color: #a8f090 !important;
        }
        .sidebar-nav .nav-link.active { font-weight: 600; }

        /* ── TOPBAR ──────────────────────────────────────────────────────── */
        #topbar {
            background: var(--topbar-bg);
            height: 64px; padding: 0 1.5rem;
            display: flex; align-items: center; justify-content: flex-end;
            border-bottom: 1px solid var(--sidebar-border);
            flex-shrink: 0;
        }

        .topbar-name { color: #f0fff0; font-size: .88rem; font-weight: 700; }
        .topbar-role { color: #5a8a50;  font-size: .75rem; }

        .user-badge {
            width: 38px; height: 38px; border-radius: 50%;
            background: rgba(57,169,0,.15);
            border: 1px solid rgba(57,169,0,.3);
            display: flex; align-items: center; justify-content: center;
            font-size: 1rem; color: var(--sena-green);
        }

        .btn-salir {
            background: transparent;
            border: 1px solid rgba(239,68,68,.45);
            color: #f87171;
            padding: .35rem .9rem; border-radius: 8px;
            font-size: .82rem; font-weight: 600;
            display: inline-flex; align-items: center; gap: .4rem;
            text-decoration: none; transition: all .2s;
        }
        .btn-salir:hover { background: rgba(239,68,68,.12); color: #fca5a5; border-color: #f87171; }

        .btn-notif {
            position: relative;
            background: transparent;
            border: 1px solid var(--sidebar-border);
            color: #7aaa70;
            width: 38px; height: 38px; border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-size: 1rem; text-decoration: none; transition: all .2s;
        }
        .btn-notif:hover { background: rgba(57,169,0,.12); color: var(--sena-green); }
        .notif-badge {
            position: absolute; top: -4px; right: -4px;
            background: #ef4444; color: #fff;
            font-size: .6rem; font-weight: 700;
            width: 17px; height: 17px; border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
        }

        /* ── LAYOUT ──────────────────────────────────────────────────────── */
        #mainContent { flex: 1; overflow-x: hidden; display: flex; flex-direction: column; }
        #pageContent  { padding: 2rem; flex: 1; background: var(--content-bg); }

        /* Tarjetas de stats */
        .stat-card {
            border-radius: 12px; padding: 1.5rem;
            border: none; box-shadow: 0 1px 3px rgba(0,0,0,.08);
        }
        .stat-icon {
            width: 48px; height: 48px; border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.3rem;
        }

        /* Tabla estilo limpio */
        .tabla-limpia { font-size: .875rem; }
        .tabla-limpia thead th { font-size: .78rem; font-weight: 700; text-transform: uppercase; letter-spacing: .5px; color: #6b7280; border-bottom: 2px solid #e5e7eb; }

        @media (max-width: 768px) { #sidebar { display: none; } }
    </style>
    <script>
        // Bloquear el bfcache (Back-Forward Cache) de los navegadores modernos.
        // Cuando el usuario presiona "atrás" después de cerrar sesión, el navegador
        // normalmente restaura la página desde memoria sin consultar el servidor.
        // pageshow se dispara tanto en carga normal como en restauración desde bfcache.
        window.addEventListener('pageshow', function(e) {
            if (e.persisted) {
                // La página fue restaurada desde bfcache — forzar recarga del servidor
                window.location.reload();
            }
        });
    </script>
</head>
<body>
<div class="d-flex" style="min-height:100vh;">

<!-- ══ SIDEBAR ══════════════════════════════════════════════════════════════ -->
<nav id="sidebar">
    <div class="sidebar-brand">
        <div class="brand-icon-box">
            <i class="fas fa-broom text-white fs-5"></i>
        </div>
        <div>
            <div class="brand-name">GestiLimpieza</div>
            <div class="brand-sub">SENA – SICEFA</div>
        </div>
    </div>

    <div class="sidebar-nav">
        <?php if ($rolId === 1): // ADMINISTRADOR ?>
            <div class="sidebar-section">Principal</div>
            <a href="admin_dashboard.php"  class="nav-link <?= $paginaActual==='admin_dashboard.php' ?'active':'' ?>"><i class="fas fa-border-all"></i> Dashboard</a>

            <div class="sidebar-section">Gestión Académica</div>
            <a href="admin_programas.php"  class="nav-link <?= in_array($paginaActual, ['admin_programas.php','admin_fichas.php']) ?'active':'' ?>">
                <i class="fas fa-graduation-cap"></i> Programas y Fichas
            </a>
            <a href="admin_aprendices.php" class="nav-link <?= $paginaActual==='admin_aprendices.php'?'active':'' ?>"><i class="fas fa-users"></i> Aprendices</a>
            <a href="admin_voceros.php"    class="nav-link <?= $paginaActual==='admin_voceros.php'   ?'active':'' ?>"><i class="fas fa-user-tie"></i> Voceros</a>

            <div class="sidebar-section">Limpieza</div>
            <a href="admin_modulos.php"    class="nav-link <?= $paginaActual==='admin_modulos.php'   ?'active':'' ?>"><i class="fas fa-door-open"></i> Módulos y Asignaciones</a>
            <a href="admin_evidencias.php" class="nav-link <?= $paginaActual==='admin_evidencias.php' ?'active':'' ?>"><i class="fas fa-images"></i> Evidencias</a>
            <a href="admin_grupos.php"     class="nav-link <?= $paginaActual==='admin_grupos.php'    ?'active':'' ?>"><i class="fas fa-people-group"></i> Grupos</a>

            <div class="sidebar-section">Sistema</div>
            <a href="admin_notificaciones.php" class="nav-link <?= $paginaActual==='admin_notificaciones.php'?'active':'' ?>">
                <i class="fas fa-bell"></i> Notificaciones
                <?php if ($_countNoti > 0): ?>
                    <span class="badge bg-danger ms-auto"><?= $_countNoti ?></span>
                <?php endif; ?>
            </a>
            <a href="admin_sincronizacion.php" class="nav-link <?= $paginaActual==='admin_sincronizacion.php'?'active':'' ?>"><i class="fas fa-rotate"></i> Sincronización SICEFA</a>

        <?php else: // VOCERO ?>
            <div class="sidebar-section">Mi Panel</div>
            <a href="vocero_dashboard.php"   class="nav-link <?= $paginaActual==='vocero_dashboard.php'  ?'active':'' ?>"><i class="fas fa-border-all"></i> Inicio</a>
            <a href="vocero_aprendices.php"  class="nav-link <?= $paginaActual==='vocero_aprendices.php' ?'active':'' ?>"><i class="fas fa-users"></i> Aprendices</a>

            <div class="sidebar-section">Limpieza</div>
            <a href="vocero_grupos.php"            class="nav-link <?= $paginaActual==='vocero_grupos.php'            ?'active':'' ?>"><i class="fas fa-people-group"></i> Mis Grupos</a>
            <a href="vocero_subir_evidencia.php"   class="nav-link <?= $paginaActual==='vocero_subir_evidencia.php'   ?'active':'' ?>"><i class="fas fa-camera"></i> Subir Evidencia</a>
            <a href="vocero_evidencias.php"        class="nav-link <?= $paginaActual==='vocero_evidencias.php'        ?'active':'' ?>"><i class="fas fa-images"></i> Historial Evidencias</a>

            <div class="sidebar-section">Sistema</div>
            <a href="vocero_notificaciones.php" class="nav-link <?= $paginaActual==='vocero_notificaciones.php'?'active':'' ?>">
                <i class="fas fa-bell"></i> Notificaciones
                <?php if ($_countNoti > 0): ?>
                    <span class="badge bg-danger ms-auto"><?= $_countNoti ?></span>
                <?php endif; ?>
            </a>
        <?php endif; ?>
    </div>
</nav>

<!-- ══ MAIN CONTENT ═════════════════════════════════════════════════════════ -->
<div id="mainContent">
    <header id="topbar">
        <div class="d-flex align-items-center gap-3">
            <!-- Notificaciones -->
            <?php
            $urlNoti = $rolId === 1 ? 'admin_notificaciones.php' : 'vocero_notificaciones.php';
            ?>
            <a href="<?= $urlNoti ?>" class="btn-notif">
                <i class="fas fa-bell"></i>
                <?php if ($_countNoti > 0): ?>
                    <span class="notif-badge"><?= $_countNoti ?></span>
                <?php endif; ?>
            </a>
            <div class="text-end">
                <div class="topbar-name"><?= htmlspecialchars($nombreCompleto) ?></div>
                <div class="topbar-role"><?= $rolId === 1 ? 'Administrador' : 'Vocero' ?></div>
            </div>
            <div class="user-badge"><i class="fas fa-user"></i></div>
            <a href="../../controllers/AuthController.php?accion=logout" class="btn-salir">
                <i class="fas fa-power-off"></i> Salir
            </a>
        </div>
    </header>

    <section id="pageContent">
