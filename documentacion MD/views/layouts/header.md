# Documentación Línea por Línea: `views/layouts/header.php`

## 1. Ficha Técnica del Archivo

- **Archivo:** `header.php`
- **Ruta en el proyecto:** `views/layouts/header.php`
- **Cantidad total de líneas:** `268`
- **Tipo de archivo:** `PHP`
- **Propósito general:** Plantilla reutilizable con barra superior institucional SENA, menú lateral (sidebar), metadatos HTML, estilos CSS y control visual de sesión.

---

## 2. Explicación Detallada Línea por Línea

A continuación se presenta cada línea de código numerada de forma consecutiva, acompañada de su fragmento exacto y la explicación exhaustiva de su funcionamiento y responsabilidad en el sistema:

| Línea | Código Fuente | Explicación Detallada |
|---|---|---|
| `1` | `<?php` | Apertura obligatoria de la etiqueta PHP para ejecución del código del lado del servidor. |
| `2` | `if (session_status() === PHP_SESSION_NONE) session_start();` | Inicia o reanuda la sesión PHP del usuario si no se encontraba activa previamente. |
| `3` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `4` | `if (!isset($_SESSION['usuario'])) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (!isset($_SESSION['usuario'])) {`. |
| `5` | `    header("Location: ../usuarios/login.php");` | Emite cabecera HTTP de redirección en el navegador: `header("Location: ../usuarios/login.php");`. |
| `6` | `    exit;` | Detiene inmediatamente la ejecución del script PHP en el servidor. |
| `7` | `}` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `8` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `9` | `$usuario       = $_SESSION['usuario'];` | Accede o almacena información de identidad del usuario en la sesión activa: `$usuario       = $_SESSION['usuario'];`. |
| `10` | `$titulo        = $titulo ?? 'Dashboard';` | Instrucción de ejecución en el contexto del script: `$titulo        = $titulo ?? 'Dashboard';`. |
| `11` | `$rolId         = (int)($usuario['rol'] ?? 0);` | Instrucción de ejecución en el contexto del script: `$rolId         = (int)($usuario['rol'] ?? 0);`. |
| `12` | `$nombreCompleto = trim(($usuario['nombres'] ?? '') . ' ' . ($usuario['apell...` | Instrucción de ejecución en el contexto del script: `$nombreCompleto = trim(($usuario['nombres'] ?? '') . ' ' . ($usuario['apellidos'] ?? ''));`. |
| `13` | `$paginaActual  = basename($_SERVER['PHP_SELF']);` | Instrucción de ejecución en el contexto del script: `$paginaActual  = basename($_SERVER['PHP_SELF']);`. |
| `14` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `15` | `// Notificaciones no leídas` | Comentario de línea explicativo: `Notificaciones no leídas`. |
| `16` | `require_once __DIR__ . '/../../config/database.php';` | Importación e inclusión obligatoria del archivo de dependencia requerido: `require_once __DIR__ . '/../../config/database.php';`. |
| `17` | `require_once __DIR__ . '/../../models/Notificacion.php';` | Importación e inclusión obligatoria del archivo de dependencia requerido: `require_once __DIR__ . '/../../models/Notificacion.php';`. |
| `18` | `$_db          = (new Database())->conectar();` | Instrucción de ejecución en el contexto del script: `$_db          = (new Database())->conectar();`. |
| `19` | `$_modelNoti   = new Notificacion($_db);` | Instrucción de ejecución en el contexto del script: `$_modelNoti   = new Notificacion($_db);`. |
| `20` | `$_countNoti   = $_modelNoti->contarNoLeidas($usuario['id_usuario']);` | Instrucción de ejecución en el contexto del script: `$_countNoti   = $_modelNoti->contarNoLeidas($usuario['id_usuario']);`. |
| `21` | `?>` | Cierre de la etiqueta PHP para alternar a salida HTML o fin del archivo. |
| `22` | `<!DOCTYPE html>` | Declaración estándar del tipo de documento HTML5. |
| `23` | `<html lang="es">` | Etiqueta raíz que delimita el documento HTML. |
| `24` | `<head>` | Cabecera del documento web para inclusión de metadatos, fuentes y hojas de estilo. |
| `25` | `    <meta charset="UTF-8">` | Metadato de configuración de la página (charset, viewport, etc.): `<meta charset="UTF-8">`. |
| `26` | `    <meta name="viewport" content="width=device-width, initial-scale=1.0">` | Metadato de configuración de la página (charset, viewport, etc.): `<meta name="viewport" content="width=device-width, initial-scale=1.0">`. |
| `27` | `    <title><?= htmlspecialchars($titulo) ?> – GestiLimpieza SENA</title>` | Título de la pestaña de navegación de la página web: `<title><?= htmlspecialchars($titulo) ?> – GestiLimpieza SENA</title>`. |
| `28` | `    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/boots...` | Enlace externo a recursos de estilo CSS o fuentes web: `<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">`. |
| `29` | `    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fon...` | Enlace externo a recursos de estilo CSS o fuentes web: `<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">`. |
| `30` | `    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>` | Bloque o etiqueta de vinculación para scripts JavaScript del lado del cliente. |
| `31` | `    <style>` | Instrucción de ejecución en el contexto del script: `<style>`. |
| `32` | `        * { box-sizing: border-box; }` | Comentario de bloque o anotación informativa dentro del código. |
| `33` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `34` | `        :root {` | Instrucción de ejecución en el contexto del script: `:root {`. |
| `35` | `            --sena-green:  #39a900;` | Instrucción de ejecución en el contexto del script: `--sena-green:  #39a900;`. |
| `36` | `            --sena-dark:   #1e5c00;` | Instrucción de ejecución en el contexto del script: `--sena-dark:   #1e5c00;`. |
| `37` | `            --sena-light:  #d4edda;` | Instrucción de ejecución en el contexto del script: `--sena-light:  #d4edda;`. |
| `38` | `            --sidebar-bg:  #0a1a00;` | Instrucción de ejecución en el contexto del script: `--sidebar-bg:  #0a1a00;`. |
| `39` | `            --sidebar-border: rgba(57,169,0,.15);` | Instrucción de ejecución en el contexto del script: `--sidebar-border: rgba(57,169,0,.15);`. |
| `40` | `            --topbar-bg:   #0a1a00;` | Instrucción de ejecución en el contexto del script: `--topbar-bg:   #0a1a00;`. |
| `41` | `            --content-bg:  #f0f4f0;` | Instrucción de ejecución en el contexto del script: `--content-bg:  #f0f4f0;`. |
| `42` | `        }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `43` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `44` | `        body {` | Instrucción de ejecución en el contexto del script: `body {`. |
| `45` | `            background: var(--content-bg);` | Instrucción de ejecución en el contexto del script: `background: var(--content-bg);`. |
| `46` | `            min-height: 100vh;` | Instrucción de ejecución en el contexto del script: `min-height: 100vh;`. |
| `47` | `            font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;` | Instrucción de ejecución en el contexto del script: `font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;`. |
| `48` | `            margin: 0; padding: 0;` | Instrucción de ejecución en el contexto del script: `margin: 0; padding: 0;`. |
| `49` | `        }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `50` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `51` | `        /* ── SIDEBAR ─────────────────────────────────────────────────────...` | Comentario de bloque o anotación informativa dentro del código. |
| `52` | `        #sidebar {` | Instrucción de ejecución en el contexto del script: `#sidebar {`. |
| `53` | `            width: 260px; min-width: 260px;` | Instrucción de ejecución en el contexto del script: `width: 260px; min-width: 260px;`. |
| `54` | `            background: var(--sidebar-bg);` | Instrucción de ejecución en el contexto del script: `background: var(--sidebar-bg);`. |
| `55` | `            border-right: 1px solid var(--sidebar-border);` | Instrucción de ejecución en el contexto del script: `border-right: 1px solid var(--sidebar-border);`. |
| `56` | `            min-height: 100vh;` | Instrucción de ejecución en el contexto del script: `min-height: 100vh;`. |
| `57` | `            position: sticky; top: 0;` | Instrucción de ejecución en el contexto del script: `position: sticky; top: 0;`. |
| `58` | `            display: flex; flex-direction: column;` | Instrucción de ejecución en el contexto del script: `display: flex; flex-direction: column;`. |
| `59` | `            z-index: 100;` | Instrucción de ejecución en el contexto del script: `z-index: 100;`. |
| `60` | `        }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `61` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `62` | `        .sidebar-brand {` | Instrucción de ejecución en el contexto del script: `.sidebar-brand {`. |
| `63` | `            padding: 1.4rem 1.2rem;` | Instrucción de ejecución en el contexto del script: `padding: 1.4rem 1.2rem;`. |
| `64` | `            border-bottom: 1px solid var(--sidebar-border);` | Instrucción de ejecución en el contexto del script: `border-bottom: 1px solid var(--sidebar-border);`. |
| `65` | `            display: flex; align-items: center; gap: .85rem;` | Instrucción de ejecución en el contexto del script: `display: flex; align-items: center; gap: .85rem;`. |
| `66` | `        }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `67` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `68` | `        .brand-icon-box {` | Instrucción de ejecución en el contexto del script: `.brand-icon-box {`. |
| `69` | `            width: 42px; height: 42px;` | Instrucción de ejecución en el contexto del script: `width: 42px; height: 42px;`. |
| `70` | `            background: var(--sena-green);` | Instrucción de ejecución en el contexto del script: `background: var(--sena-green);`. |
| `71` | `            border-radius: 10px;` | Instrucción de ejecución en el contexto del script: `border-radius: 10px;`. |
| `72` | `            display: flex; align-items: center; justify-content: center;` | Instrucción de ejecución en el contexto del script: `display: flex; align-items: center; justify-content: center;`. |
| `73` | `            flex-shrink: 0;` | Instrucción de ejecución en el contexto del script: `flex-shrink: 0;`. |
| `74` | `        }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `75` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `76` | `        .brand-name {` | Instrucción de ejecución en el contexto del script: `.brand-name {`. |
| `77` | `            color: #f0fff0;` | Instrucción de ejecución en el contexto del script: `color: #f0fff0;`. |
| `78` | `            font-size: .95rem; font-weight: 700; line-height: 1.25;` | Instrucción de ejecución en el contexto del script: `font-size: .95rem; font-weight: 700; line-height: 1.25;`. |
| `79` | `        }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `80` | `        .brand-sub {` | Instrucción de ejecución en el contexto del script: `.brand-sub {`. |
| `81` | `            color: #5a8a50;` | Instrucción de ejecución en el contexto del script: `color: #5a8a50;`. |
| `82` | `            font-size: .7rem; margin-top: 2px;` | Instrucción de ejecución en el contexto del script: `font-size: .7rem; margin-top: 2px;`. |
| `83` | `        }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `84` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `85` | `        .sidebar-nav    { padding: .8rem .6rem; flex: 1; overflow-y: auto; }` | Instrucción de ejecución en el contexto del script: `.sidebar-nav    { padding: .8rem .6rem; flex: 1; overflow-y: auto; }`. |
| `86` | `        .sidebar-section {` | Instrucción de ejecución en el contexto del script: `.sidebar-section {`. |
| `87` | `            color: #3a6030;` | Instrucción de ejecución en el contexto del script: `color: #3a6030;`. |
| `88` | `            font-size: .68rem; font-weight: 700;` | Instrucción de ejecución en el contexto del script: `font-size: .68rem; font-weight: 700;`. |
| `89` | `            letter-spacing: 1px; text-transform: uppercase;` | Instrucción de ejecución en el contexto del script: `letter-spacing: 1px; text-transform: uppercase;`. |
| `90` | `            padding: .9rem 1rem .4rem;` | Instrucción de ejecución en el contexto del script: `padding: .9rem 1rem .4rem;`. |
| `91` | `        }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `92` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `93` | `        .sidebar-nav .nav-link {` | Instrucción de ejecución en el contexto del script: `.sidebar-nav .nav-link {`. |
| `94` | `            color: #7aaa70;` | Instrucción de ejecución en el contexto del script: `color: #7aaa70;`. |
| `95` | `            padding: .65rem 1rem; border-radius: 8px; margin-bottom: 2px;` | Instrucción de ejecución en el contexto del script: `padding: .65rem 1rem; border-radius: 8px; margin-bottom: 2px;`. |
| `96` | `            font-size: .875rem; font-weight: 500;` | Instrucción de ejecución en el contexto del script: `font-size: .875rem; font-weight: 500;`. |
| `97` | `            transition: all .18s ease;` | Instrucción de ejecución en el contexto del script: `transition: all .18s ease;`. |
| `98` | `            display: flex; align-items: center; gap: .75rem;` | Instrucción de ejecución en el contexto del script: `display: flex; align-items: center; gap: .75rem;`. |
| `99` | `            text-decoration: none;` | Instrucción de ejecución en el contexto del script: `text-decoration: none;`. |
| `100` | `        }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `101` | `        .sidebar-nav .nav-link i { width: 18px; text-align: center; font-si...` | Instrucción de ejecución en el contexto del script: `.sidebar-nav .nav-link i { width: 18px; text-align: center; font-size: .95rem; }`. |
| `102` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `103` | `        .sidebar-nav .nav-link:hover,` | Instrucción de ejecución en el contexto del script: `.sidebar-nav .nav-link:hover,`. |
| `104` | `        .sidebar-nav .nav-link.active {` | Instrucción de ejecución en el contexto del script: `.sidebar-nav .nav-link.active {`. |
| `105` | `            background: rgba(57,169,0,.18) !important;` | Instrucción de ejecución en el contexto del script: `background: rgba(57,169,0,.18) !important;`. |
| `106` | `            color: #a8f090 !important;` | Instrucción de ejecución en el contexto del script: `color: #a8f090 !important;`. |
| `107` | `        }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `108` | `        .sidebar-nav .nav-link.active { font-weight: 600; }` | Instrucción de ejecución en el contexto del script: `.sidebar-nav .nav-link.active { font-weight: 600; }`. |
| `109` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `110` | `        /* ── TOPBAR ──────────────────────────────────────────────────────...` | Comentario de bloque o anotación informativa dentro del código. |
| `111` | `        #topbar {` | Instrucción de ejecución en el contexto del script: `#topbar {`. |
| `112` | `            background: var(--topbar-bg);` | Instrucción de ejecución en el contexto del script: `background: var(--topbar-bg);`. |
| `113` | `            height: 64px; padding: 0 1.5rem;` | Instrucción de ejecución en el contexto del script: `height: 64px; padding: 0 1.5rem;`. |
| `114` | `            display: flex; align-items: center; justify-content: flex-end;` | Instrucción de ejecución en el contexto del script: `display: flex; align-items: center; justify-content: flex-end;`. |
| `115` | `            border-bottom: 1px solid var(--sidebar-border);` | Instrucción de ejecución en el contexto del script: `border-bottom: 1px solid var(--sidebar-border);`. |
| `116` | `            flex-shrink: 0;` | Instrucción de ejecución en el contexto del script: `flex-shrink: 0;`. |
| `117` | `        }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `118` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `119` | `        .topbar-name { color: #f0fff0; font-size: .88rem; font-weight: 700; }` | Instrucción de ejecución en el contexto del script: `.topbar-name { color: #f0fff0; font-size: .88rem; font-weight: 700; }`. |
| `120` | `        .topbar-role { color: #5a8a50;  font-size: .75rem; }` | Instrucción de ejecución en el contexto del script: `.topbar-role { color: #5a8a50;  font-size: .75rem; }`. |
| `121` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `122` | `        .user-badge {` | Instrucción de ejecución en el contexto del script: `.user-badge {`. |
| `123` | `            width: 38px; height: 38px; border-radius: 50%;` | Instrucción de ejecución en el contexto del script: `width: 38px; height: 38px; border-radius: 50%;`. |
| `124` | `            background: rgba(57,169,0,.15);` | Instrucción de ejecución en el contexto del script: `background: rgba(57,169,0,.15);`. |
| `125` | `            border: 1px solid rgba(57,169,0,.3);` | Instrucción de ejecución en el contexto del script: `border: 1px solid rgba(57,169,0,.3);`. |
| `126` | `            display: flex; align-items: center; justify-content: center;` | Instrucción de ejecución en el contexto del script: `display: flex; align-items: center; justify-content: center;`. |
| `127` | `            font-size: 1rem; color: var(--sena-green);` | Instrucción de ejecución en el contexto del script: `font-size: 1rem; color: var(--sena-green);`. |
| `128` | `        }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `129` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `130` | `        .btn-salir {` | Instrucción de ejecución en el contexto del script: `.btn-salir {`. |
| `131` | `            background: transparent;` | Instrucción de ejecución en el contexto del script: `background: transparent;`. |
| `132` | `            border: 1px solid rgba(239,68,68,.45);` | Instrucción de ejecución en el contexto del script: `border: 1px solid rgba(239,68,68,.45);`. |
| `133` | `            color: #f87171;` | Instrucción de ejecución en el contexto del script: `color: #f87171;`. |
| `134` | `            padding: .35rem .9rem; border-radius: 8px;` | Instrucción de ejecución en el contexto del script: `padding: .35rem .9rem; border-radius: 8px;`. |
| `135` | `            font-size: .82rem; font-weight: 600;` | Instrucción de ejecución en el contexto del script: `font-size: .82rem; font-weight: 600;`. |
| `136` | `            display: inline-flex; align-items: center; gap: .4rem;` | Instrucción de ejecución en el contexto del script: `display: inline-flex; align-items: center; gap: .4rem;`. |
| `137` | `            text-decoration: none; transition: all .2s;` | Instrucción de ejecución en el contexto del script: `text-decoration: none; transition: all .2s;`. |
| `138` | `        }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `139` | `        .btn-salir:hover { background: rgba(239,68,68,.12); color: #fca5a5;...` | Instrucción de ejecución en el contexto del script: `.btn-salir:hover { background: rgba(239,68,68,.12); color: #fca5a5; border-color: #f87171; }`. |
| `140` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `141` | `        .btn-notif {` | Instrucción de ejecución en el contexto del script: `.btn-notif {`. |
| `142` | `            position: relative;` | Instrucción de ejecución en el contexto del script: `position: relative;`. |
| `143` | `            background: transparent;` | Instrucción de ejecución en el contexto del script: `background: transparent;`. |
| `144` | `            border: 1px solid var(--sidebar-border);` | Instrucción de ejecución en el contexto del script: `border: 1px solid var(--sidebar-border);`. |
| `145` | `            color: #7aaa70;` | Instrucción de ejecución en el contexto del script: `color: #7aaa70;`. |
| `146` | `            width: 38px; height: 38px; border-radius: 50%;` | Instrucción de ejecución en el contexto del script: `width: 38px; height: 38px; border-radius: 50%;`. |
| `147` | `            display: flex; align-items: center; justify-content: center;` | Instrucción de ejecución en el contexto del script: `display: flex; align-items: center; justify-content: center;`. |
| `148` | `            font-size: 1rem; text-decoration: none; transition: all .2s;` | Instrucción de ejecución en el contexto del script: `font-size: 1rem; text-decoration: none; transition: all .2s;`. |
| `149` | `        }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `150` | `        .btn-notif:hover { background: rgba(57,169,0,.12); color: var(--sen...` | Instrucción de ejecución en el contexto del script: `.btn-notif:hover { background: rgba(57,169,0,.12); color: var(--sena-green); }`. |
| `151` | `        .notif-badge {` | Instrucción de ejecución en el contexto del script: `.notif-badge {`. |
| `152` | `            position: absolute; top: -4px; right: -4px;` | Instrucción de ejecución en el contexto del script: `position: absolute; top: -4px; right: -4px;`. |
| `153` | `            background: #ef4444; color: #fff;` | Instrucción de ejecución en el contexto del script: `background: #ef4444; color: #fff;`. |
| `154` | `            font-size: .6rem; font-weight: 700;` | Instrucción de ejecución en el contexto del script: `font-size: .6rem; font-weight: 700;`. |
| `155` | `            width: 17px; height: 17px; border-radius: 50%;` | Instrucción de ejecución en el contexto del script: `width: 17px; height: 17px; border-radius: 50%;`. |
| `156` | `            display: flex; align-items: center; justify-content: center;` | Instrucción de ejecución en el contexto del script: `display: flex; align-items: center; justify-content: center;`. |
| `157` | `        }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `158` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `159` | `        /* ── LAYOUT ──────────────────────────────────────────────────────...` | Comentario de bloque o anotación informativa dentro del código. |
| `160` | `        #mainContent { flex: 1; overflow-x: hidden; display: flex; flex-dir...` | Instrucción de ejecución en el contexto del script: `#mainContent { flex: 1; overflow-x: hidden; display: flex; flex-direction: column; }`. |
| `161` | `        #pageContent  { padding: 2rem; flex: 1; background: var(--content-b...` | Instrucción de ejecución en el contexto del script: `#pageContent  { padding: 2rem; flex: 1; background: var(--content-bg); }`. |
| `162` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `163` | `        /* Tarjetas de stats */` | Comentario de bloque o anotación informativa dentro del código. |
| `164` | `        .stat-card {` | Instrucción de ejecución en el contexto del script: `.stat-card {`. |
| `165` | `            border-radius: 12px; padding: 1.5rem;` | Instrucción de ejecución en el contexto del script: `border-radius: 12px; padding: 1.5rem;`. |
| `166` | `            border: none; box-shadow: 0 1px 3px rgba(0,0,0,.08);` | Instrucción de ejecución en el contexto del script: `border: none; box-shadow: 0 1px 3px rgba(0,0,0,.08);`. |
| `167` | `        }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `168` | `        .stat-icon {` | Instrucción de ejecución en el contexto del script: `.stat-icon {`. |
| `169` | `            width: 48px; height: 48px; border-radius: 10px;` | Instrucción de ejecución en el contexto del script: `width: 48px; height: 48px; border-radius: 10px;`. |
| `170` | `            display: flex; align-items: center; justify-content: center;` | Instrucción de ejecución en el contexto del script: `display: flex; align-items: center; justify-content: center;`. |
| `171` | `            font-size: 1.3rem;` | Instrucción de ejecución en el contexto del script: `font-size: 1.3rem;`. |
| `172` | `        }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `173` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `174` | `        /* Tabla estilo limpio */` | Comentario de bloque o anotación informativa dentro del código. |
| `175` | `        .tabla-limpia { font-size: .875rem; }` | Instrucción de ejecución en el contexto del script: `.tabla-limpia { font-size: .875rem; }`. |
| `176` | `        .tabla-limpia thead th { font-size: .78rem; font-weight: 700; text-...` | Instrucción de ejecución en el contexto del script: `.tabla-limpia thead th { font-size: .78rem; font-weight: 700; text-transform: uppercase; letter-spacing: .5px; color: #6b7280; border-bottom: 2px solid #e5e7eb; }`. |
| `177` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `178` | `        @media (max-width: 768px) { #sidebar { display: none; } }` | Instrucción de ejecución en el contexto del script: `@media (max-width: 768px) { #sidebar { display: none; } }`. |
| `179` | `    </style>` | Instrucción de ejecución en el contexto del script: `</style>`. |
| `180` | `</head>` | Cabecera del documento web para inclusión de metadatos, fuentes y hojas de estilo. |
| `181` | `<body>` | Cuerpo principal donde se renderiza la interfaz visual del usuario. |
| `182` | `<div class="d-flex" style="min-height:100vh;">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="d-flex" style="min-height:100vh;">`. |
| `183` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `184` | `<!-- ══ SIDEBAR ═══════════════════════════════════════════════════════════...` | Instrucción de ejecución en el contexto del script: `<!-- ══ SIDEBAR ══════════════════════════════════════════════════════════════ -->`. |
| `185` | `<nav id="sidebar">` | Barra o elemento de navegación del sistema. |
| `186` | `    <div class="sidebar-brand">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="sidebar-brand">`. |
| `187` | `        <div class="brand-icon-box">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="brand-icon-box">`. |
| `188` | `            <i class="fas fa-broom text-white fs-5"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-broom text-white fs-5"></i>`. |
| `189` | `        </div>` | Cierre de contenedor visual `<div>`. |
| `190` | `        <div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div>`. |
| `191` | `            <div class="brand-name">GestiLimpieza</div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="brand-name">GestiLimpieza</div>`. |
| `192` | `            <div class="brand-sub">SENA – SICEFA</div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="brand-sub">SENA – SICEFA</div>`. |
| `193` | `        </div>` | Cierre de contenedor visual `<div>`. |
| `194` | `    </div>` | Cierre de contenedor visual `<div>`. |
| `195` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `196` | `    <div class="sidebar-nav">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="sidebar-nav">`. |
| `197` | `        <?php if ($rolId === 1): // ADMINISTRADOR ?>` | Instrucción de ejecución en el contexto del script: `<?php if ($rolId === 1): // ADMINISTRADOR ?>`. |
| `198` | `            <div class="sidebar-section">Principal</div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="sidebar-section">Principal</div>`. |
| `199` | `            <a href="admin_dashboard.php"  class="nav-link <?= $paginaActua...` | Enlace hipertexto de navegación o acción: `<a href="admin_dashboard.php"  class="nav-link <?= $paginaActual==='admin_dashboard.php' ?'active':'' ?>"><i class="fas fa-border-all"></i> Dashboard</a>`. |
| `200` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `201` | `            <div class="sidebar-section">Gestión Académica</div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="sidebar-section">Gestión Académica</div>`. |
| `202` | `            <a href="admin_programas.php"  class="nav-link <?= in_array($pa...` | Enlace hipertexto de navegación o acción: `<a href="admin_programas.php"  class="nav-link <?= in_array($paginaActual, ['admin_programas.php','admin_fichas.php']) ?'active':'' ?>">`. |
| `203` | `                <i class="fas fa-graduation-cap"></i> Programas y Fichas` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-graduation-cap"></i> Programas y Fichas`. |
| `204` | `            </a>` | Instrucción de ejecución en el contexto del script: `</a>`. |
| `205` | `            <a href="admin_aprendices.php" class="nav-link <?= $paginaActua...` | Enlace hipertexto de navegación o acción: `<a href="admin_aprendices.php" class="nav-link <?= $paginaActual==='admin_aprendices.php'?'active':'' ?>"><i class="fas fa-users"></i> Aprendices</a>`. |
| `206` | `            <a href="admin_voceros.php"    class="nav-link <?= $paginaActua...` | Enlace hipertexto de navegación o acción: `<a href="admin_voceros.php"    class="nav-link <?= $paginaActual==='admin_voceros.php'   ?'active':'' ?>"><i class="fas fa-user-tie"></i> Voceros</a>`. |
| `207` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `208` | `            <div class="sidebar-section">Limpieza</div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="sidebar-section">Limpieza</div>`. |
| `209` | `            <a href="admin_modulos.php"    class="nav-link <?= $paginaActua...` | Enlace hipertexto de navegación o acción: `<a href="admin_modulos.php"    class="nav-link <?= $paginaActual==='admin_modulos.php'   ?'active':'' ?>"><i class="fas fa-door-open"></i> Módulos y Asignaciones</a>`. |
| `210` | `            <a href="admin_evidencias.php" class="nav-link <?= $paginaActua...` | Enlace hipertexto de navegación o acción: `<a href="admin_evidencias.php" class="nav-link <?= $paginaActual==='admin_evidencias.php' ?'active':'' ?>"><i class="fas fa-images"></i> Evidencias</a>`. |
| `211` | `            <a href="admin_grupos.php"     class="nav-link <?= $paginaActua...` | Enlace hipertexto de navegación o acción: `<a href="admin_grupos.php"     class="nav-link <?= $paginaActual==='admin_grupos.php'    ?'active':'' ?>"><i class="fas fa-people-group"></i> Grupos</a>`. |
| `212` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `213` | `            <div class="sidebar-section">Sistema</div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="sidebar-section">Sistema</div>`. |
| `214` | `            <a href="admin_notificaciones.php" class="nav-link <?= $paginaA...` | Enlace hipertexto de navegación o acción: `<a href="admin_notificaciones.php" class="nav-link <?= $paginaActual==='admin_notificaciones.php'?'active':'' ?>">`. |
| `215` | `                <i class="fas fa-bell"></i> Notificaciones` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-bell"></i> Notificaciones`. |
| `216` | `                <?php if ($_countNoti > 0): ?>` | Instrucción de ejecución en el contexto del script: `<?php if ($_countNoti > 0): ?>`. |
| `217` | `                    <span class="badge bg-danger ms-auto"><?= $_countNoti ?...` | Instrucción de ejecución en el contexto del script: `<span class="badge bg-danger ms-auto"><?= $_countNoti ?></span>`. |
| `218` | `                <?php endif; ?>` | Instrucción de ejecución en el contexto del script: `<?php endif; ?>`. |
| `219` | `            </a>` | Instrucción de ejecución en el contexto del script: `</a>`. |
| `220` | `            <a href="admin_sincronizacion.php" class="nav-link <?= $paginaA...` | Enlace hipertexto de navegación o acción: `<a href="admin_sincronizacion.php" class="nav-link <?= $paginaActual==='admin_sincronizacion.php'?'active':'' ?>"><i class="fas fa-rotate"></i> Sincronización SICEFA</a>`. |
| `221` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `222` | `        <?php else: // VOCERO ?>` | Instrucción de ejecución en el contexto del script: `<?php else: // VOCERO ?>`. |
| `223` | `            <div class="sidebar-section">Mi Panel</div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="sidebar-section">Mi Panel</div>`. |
| `224` | `            <a href="vocero_dashboard.php"   class="nav-link <?= $paginaAct...` | Enlace hipertexto de navegación o acción: `<a href="vocero_dashboard.php"   class="nav-link <?= $paginaActual==='vocero_dashboard.php'  ?'active':'' ?>"><i class="fas fa-border-all"></i> Inicio</a>`. |
| `225` | `            <a href="vocero_aprendices.php"  class="nav-link <?= $paginaAct...` | Enlace hipertexto de navegación o acción: `<a href="vocero_aprendices.php"  class="nav-link <?= $paginaActual==='vocero_aprendices.php' ?'active':'' ?>"><i class="fas fa-users"></i> Aprendices</a>`. |
| `226` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `227` | `            <div class="sidebar-section">Limpieza</div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="sidebar-section">Limpieza</div>`. |
| `228` | `            <a href="vocero_grupos.php"            class="nav-link <?= $pag...` | Enlace hipertexto de navegación o acción: `<a href="vocero_grupos.php"            class="nav-link <?= $paginaActual==='vocero_grupos.php'            ?'active':'' ?>"><i class="fas fa-people-group"></i> Mis Grupos</a>`. |
| `229` | `            <a href="vocero_subir_evidencia.php"   class="nav-link <?= $pag...` | Enlace hipertexto de navegación o acción: `<a href="vocero_subir_evidencia.php"   class="nav-link <?= $paginaActual==='vocero_subir_evidencia.php'   ?'active':'' ?>"><i class="fas fa-camera"></i> Subir Evidencia</a>`. |
| `230` | `            <a href="vocero_evidencias.php"        class="nav-link <?= $pag...` | Enlace hipertexto de navegación o acción: `<a href="vocero_evidencias.php"        class="nav-link <?= $paginaActual==='vocero_evidencias.php'        ?'active':'' ?>"><i class="fas fa-images"></i> Historial Evidencias</a>`. |
| `231` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `232` | `            <div class="sidebar-section">Sistema</div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="sidebar-section">Sistema</div>`. |
| `233` | `            <a href="vocero_notificaciones.php" class="nav-link <?= $pagina...` | Enlace hipertexto de navegación o acción: `<a href="vocero_notificaciones.php" class="nav-link <?= $paginaActual==='vocero_notificaciones.php'?'active':'' ?>">`. |
| `234` | `                <i class="fas fa-bell"></i> Notificaciones` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-bell"></i> Notificaciones`. |
| `235` | `                <?php if ($_countNoti > 0): ?>` | Instrucción de ejecución en el contexto del script: `<?php if ($_countNoti > 0): ?>`. |
| `236` | `                    <span class="badge bg-danger ms-auto"><?= $_countNoti ?...` | Instrucción de ejecución en el contexto del script: `<span class="badge bg-danger ms-auto"><?= $_countNoti ?></span>`. |
| `237` | `                <?php endif; ?>` | Instrucción de ejecución en el contexto del script: `<?php endif; ?>`. |
| `238` | `            </a>` | Instrucción de ejecución en el contexto del script: `</a>`. |
| `239` | `        <?php endif; ?>` | Instrucción de ejecución en el contexto del script: `<?php endif; ?>`. |
| `240` | `    </div>` | Cierre de contenedor visual `<div>`. |
| `241` | `</nav>` | Barra o elemento de navegación del sistema. |
| `242` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `243` | `<!-- ══ MAIN CONTENT ══════════════════════════════════════════════════════...` | Instrucción de ejecución en el contexto del script: `<!-- ══ MAIN CONTENT ═════════════════════════════════════════════════════════ -->`. |
| `244` | `<div id="mainContent">` | Contenedor visual estructurado con Bootstrap/CSS: `<div id="mainContent">`. |
| `245` | `    <header id="topbar">` | Instrucción de ejecución en el contexto del script: `<header id="topbar">`. |
| `246` | `        <div class="d-flex align-items-center gap-3">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="d-flex align-items-center gap-3">`. |
| `247` | `            <!-- Notificaciones -->` | Instrucción de ejecución en el contexto del script: `<!-- Notificaciones -->`. |
| `248` | `            <?php` | Apertura obligatoria de la etiqueta PHP para ejecución del código del lado del servidor. |
| `249` | `            $urlNoti = $rolId === 1 ? 'admin_notificaciones.php' : 'vocero_...` | Instrucción de ejecución en el contexto del script: `$urlNoti = $rolId === 1 ? 'admin_notificaciones.php' : 'vocero_notificaciones.php';`. |
| `250` | `            ?>` | Cierre de la etiqueta PHP para alternar a salida HTML o fin del archivo. |
| `251` | `            <a href="<?= $urlNoti ?>" class="btn-notif">` | Enlace hipertexto de navegación o acción: `<a href="<?= $urlNoti ?>" class="btn-notif">`. |
| `252` | `                <i class="fas fa-bell"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-bell"></i>`. |
| `253` | `                <?php if ($_countNoti > 0): ?>` | Instrucción de ejecución en el contexto del script: `<?php if ($_countNoti > 0): ?>`. |
| `254` | `                    <span class="notif-badge"><?= $_countNoti ?></span>` | Instrucción de ejecución en el contexto del script: `<span class="notif-badge"><?= $_countNoti ?></span>`. |
| `255` | `                <?php endif; ?>` | Instrucción de ejecución en el contexto del script: `<?php endif; ?>`. |
| `256` | `            </a>` | Instrucción de ejecución en el contexto del script: `</a>`. |
| `257` | `            <div class="text-end">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="text-end">`. |
| `258` | `                <div class="topbar-name"><?= htmlspecialchars($nombreComple...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="topbar-name"><?= htmlspecialchars($nombreCompleto) ?></div>`. |
| `259` | `                <div class="topbar-role"><?= $rolId === 1 ? 'Administrador'...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="topbar-role"><?= $rolId === 1 ? 'Administrador' : 'Vocero' ?></div>`. |
| `260` | `            </div>` | Cierre de contenedor visual `<div>`. |
| `261` | `            <div class="user-badge"><i class="fas fa-user"></i></div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="user-badge"><i class="fas fa-user"></i></div>`. |
| `262` | `            <a href="../../controllers/AuthController.php?accion=logout" cl...` | Enlace hipertexto de navegación o acción: `<a href="../../controllers/AuthController.php?accion=logout" class="btn-salir">`. |
| `263` | `                <i class="fas fa-power-off"></i> Salir` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-power-off"></i> Salir`. |
| `264` | `            </a>` | Instrucción de ejecución en el contexto del script: `</a>`. |
| `265` | `        </div>` | Cierre de contenedor visual `<div>`. |
| `266` | `    </header>` | Instrucción de ejecución en el contexto del script: `</header>`. |
| `267` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `268` | `    <section id="pageContent">` | Instrucción de ejecución en el contexto del script: `<section id="pageContent">`. |

---

## 3. Resumen y Flujo de Interacción

El archivo `header.php` cumple un rol indispensable en `views/layouts/header.php`. 
Plantilla reutilizable con barra superior institucional SENA, menú lateral (sidebar), metadatos HTML, estilos CSS y control visual de sesión. Garantiza la robustez, el orden y la estabilidad de la arquitectura del proyecto `systemLimpieza`.
