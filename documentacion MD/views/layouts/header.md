# Documentación Línea por Línea: `views/layouts/header.php`

## 1. Ficha Técnica del Archivo

- **Archivo:** `header.php`
- **Ruta en el proyecto:** `views/layouts/header.php`
- **Cantidad total de líneas:** `288`
- **Tipo de archivo:** `PHP`
- **Propósito general:** Plantilla reutilizable con barra superior institucional SENA, menú lateral (sidebar), metadatos HTML, estilos CSS y control visual de sesión.

---

## 2. Explicación Detallada Línea por Línea

A continuación se presenta cada línea de código numerada de forma consecutiva, acompañada de su fragmento exacto y la explicación exhaustiva de su funcionamiento y responsabilidad en el sistema:

| Línea | Código Fuente | Explicación Detallada |
|---|---|---|
| `1` | ``<?php`` | Apertura obligatoria de la etiqueta PHP para ejecución del código del lado del servidor. |
| `2` | `if (session_status() === PHP_SESSION_NONE) session_start();` | Inicia o reanuda la sesión PHP del usuario si no se encontraba activa previamente. |
| `3` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `4` | `// Evitar que el navegador cachee las páginas protegidas.` | Comentario explicativo en el código: `Evitar que el navegador cachee las páginas protegidas.`. |
| `5` | `// Así el botón "atrás" siempre hace una nueva petición al servidor` | Comentario explicativo en el código: `Así el botón "atrás" siempre hace una nueva petición al servidor`. |
| `6` | `// y el guard de sesión se ejecuta correctamente.` | Comentario explicativo en el código: `y el guard de sesión se ejecuta correctamente.`. |
| `7` | `header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");` | Emite cabecera HTTP de respuesta hacia el cliente: `header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");`. |
| `8` | `header("Cache-Control: post-check=0, pre-check=0", false);` | Emite cabecera HTTP de respuesta hacia el cliente: `header("Cache-Control: post-check=0, pre-check=0", false);`. |
| `9` | `header("Pragma: no-cache");` | Emite cabecera HTTP de respuesta hacia el cliente: `header("Pragma: no-cache");`. |
| `10` | `header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");` | Emite cabecera HTTP de respuesta hacia el cliente: `header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");`. |
| `11` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `12` | `if (!isset($_SESSION['usuario'])) {` | Verifica autenticación y rol del usuario; redirige al login si no tiene permisos. |
| `13` | `header("Location: ../usuarios/login.php");` | Emite cabecera HTTP de respuesta hacia el cliente: `header("Location: ../usuarios/login.php");`. |
| `14` | `exit;` | Finaliza la ejecución de la función o script. |
| `15` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `16` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `17` | `$usuario       = $_SESSION['usuario'];` | Instrucción de ejecución en el contexto del script: `$usuario       = $_SESSION['usuario'];`. |
| `18` | `$titulo        = $titulo ?? 'Dashboard';` | Instrucción de ejecución en el contexto del script: `$titulo        = $titulo ?? 'Dashboard';`. |
| `19` | `$rolId         = (int)($usuario['rol'] ?? 0);` | Instrucción de ejecución en el contexto del script: `$rolId         = (int)($usuario['rol'] ?? 0);`. |
| `20` | `$nombreCompleto = trim(($usuario['nombres'] ?? '') . ' ' . ($usuario['ap...` | Instrucción de ejecución en el contexto del script: `$nombreCompleto = trim(($usuario['nombres'] ?? '') . ' ' . ($usuario['ap...`. |
| `21` | `$paginaActual  = basename($_SERVER['PHP_SELF']);` | Instrucción de ejecución en el contexto del script: `$paginaActual  = basename($_SERVER['PHP_SELF']);`. |
| `22` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `23` | `// Notificaciones no leídas` | Comentario explicativo en el código: `Notificaciones no leídas`. |
| `24` | `require_once __DIR__ . '/../../config/database.php';` | Importación e inclusión obligatoria del archivo de dependencia requerido: `require_once __DIR__ . '/../../config/database.php';`. |
| `25` | `require_once __DIR__ . '/../../models/Notificacion.php';` | Importación e inclusión obligatoria del archivo de dependencia requerido: `require_once __DIR__ . '/../../models/Notificacion.php';`. |
| `26` | `$_db          = (new Database())->conectar();` | Instrucción de ejecución en el contexto del script: `$_db          = (new Database())->conectar();`. |
| `27` | `$_modelNoti   = new Notificacion($_db);` | Instrucción de ejecución en el contexto del script: `$_modelNoti   = new Notificacion($_db);`. |
| `28` | `$_countNoti   = $_modelNoti->contarNoLeidas($usuario['id_usuario']);` | Instrucción de ejecución en el contexto del script: `$_countNoti   = $_modelNoti->contarNoLeidas($usuario['id_usuario']);`. |
| `29` | ``?>`` | Cierre de la etiqueta PHP para alternar a salida HTML o fin del archivo. |
| `30` | `<!DOCTYPE html>` | Instrucción de ejecución en el contexto del script: `<!DOCTYPE html>`. |
| `31` | `<html lang="es">` | Instrucción de ejecución en el contexto del script: `<html lang="es">`. |
| `32` | `<head>` | Instrucción de ejecución en el contexto del script: `<head>`. |
| `33` | `<meta charset="UTF-8">` | Instrucción de ejecución en el contexto del script: `<meta charset="UTF-8">`. |
| `34` | `<meta name="viewport" content="width=device-width, initial-scale=1.0">` | Instrucción de ejecución en el contexto del script: `<meta name="viewport" content="width=device-width, initial-scale=1.0">`. |
| `35` | `<title><?= htmlspecialchars($titulo) ?> – GestiLimpieza SENA</title>` | Instrucción de ejecución en el contexto del script: `<title><?= htmlspecialchars($titulo) ?> – GestiLimpieza SENA</title>`. |
| `36` | `<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootst...` | Vinculación de hoja de estilos o recurso externo: `<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootst...`. |
| `37` | `<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font...` | Vinculación de hoja de estilos o recurso externo: `<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font...`. |
| `38` | ``<script>`` | Bloque o etiqueta de vinculación para scripts JavaScript del lado del cliente. |
| `39` | ``<style>`` | Bloque de estilos CSS personalizados para la interfaz. |
| `40` | `* { box-sizing: border-box; }` | Comentario multilínea de documentación o aclaración técnica. |
| `41` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `42` | `:root {` | Instrucción de ejecución en el contexto del script: `:root {`. |
| `43` | `--sena-green:  #39a900;` | Comentario explicativo SQL: `sena-green:  #39a900;`. |
| `44` | `--sena-dark:   #1e5c00;` | Comentario explicativo SQL: `sena-dark:   #1e5c00;`. |
| `45` | `--sena-light:  #d4edda;` | Comentario explicativo SQL: `sena-light:  #d4edda;`. |
| `46` | `--sidebar-bg:  #0a1a00;` | Comentario explicativo SQL: `sidebar-bg:  #0a1a00;`. |
| `47` | `--sidebar-border: rgba(57,169,0,.15);` | Comentario explicativo SQL: `sidebar-border: rgba(57,169,0,.15);`. |
| `48` | `--topbar-bg:   #0a1a00;` | Comentario explicativo SQL: `topbar-bg:   #0a1a00;`. |
| `49` | `--content-bg:  #f0f4f0;` | Comentario explicativo SQL: `content-bg:  #f0f4f0;`. |
| `50` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `51` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `52` | `body {` | Instrucción de ejecución en el contexto del script: `body {`. |
| `53` | `background: var(--content-bg);` | Instrucción de ejecución en el contexto del script: `background: var(--content-bg);`. |
| `54` | `min-height: 100vh;` | Instrucción de ejecución en el contexto del script: `min-height: 100vh;`. |
| `55` | `font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;` | Instrucción de ejecución en el contexto del script: `font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;`. |
| `56` | `margin: 0; padding: 0;` | Instrucción de ejecución en el contexto del script: `margin: 0; padding: 0;`. |
| `57` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `58` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `59` | `/* ── SIDEBAR ─────────────────────────────────────────────────────── */` | Comentario multilínea de documentación o aclaración técnica. |
| `60` | `#sidebar {` | Comentario explicativo en el código: `sidebar {`. |
| `61` | `width: 260px; min-width: 260px;` | Instrucción de ejecución en el contexto del script: `width: 260px; min-width: 260px;`. |
| `62` | `background: var(--sidebar-bg);` | Instrucción de ejecución en el contexto del script: `background: var(--sidebar-bg);`. |
| `63` | `border-right: 1px solid var(--sidebar-border);` | Instrucción de ejecución en el contexto del script: `border-right: 1px solid var(--sidebar-border);`. |
| `64` | `min-height: 100vh;` | Instrucción de ejecución en el contexto del script: `min-height: 100vh;`. |
| `65` | `position: sticky; top: 0;` | Instrucción de ejecución en el contexto del script: `position: sticky; top: 0;`. |
| `66` | `display: flex; flex-direction: column;` | Instrucción de ejecución en el contexto del script: `display: flex; flex-direction: column;`. |
| `67` | `z-index: 100;` | Instrucción de ejecución en el contexto del script: `z-index: 100;`. |
| `68` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `69` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `70` | `.sidebar-brand {` | Instrucción de ejecución en el contexto del script: `.sidebar-brand {`. |
| `71` | `padding: 1.4rem 1.2rem;` | Instrucción de ejecución en el contexto del script: `padding: 1.4rem 1.2rem;`. |
| `72` | `border-bottom: 1px solid var(--sidebar-border);` | Instrucción de ejecución en el contexto del script: `border-bottom: 1px solid var(--sidebar-border);`. |
| `73` | `display: flex; align-items: center; gap: .85rem;` | Instrucción de ejecución en el contexto del script: `display: flex; align-items: center; gap: .85rem;`. |
| `74` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `75` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `76` | `.brand-icon-box {` | Instrucción de ejecución en el contexto del script: `.brand-icon-box {`. |
| `77` | `width: 42px; height: 42px;` | Instrucción de ejecución en el contexto del script: `width: 42px; height: 42px;`. |
| `78` | `background: var(--sena-green);` | Instrucción de ejecución en el contexto del script: `background: var(--sena-green);`. |
| `79` | `border-radius: 10px;` | Instrucción de ejecución en el contexto del script: `border-radius: 10px;`. |
| `80` | `display: flex; align-items: center; justify-content: center;` | Instrucción de ejecución en el contexto del script: `display: flex; align-items: center; justify-content: center;`. |
| `81` | `flex-shrink: 0;` | Instrucción de ejecución en el contexto del script: `flex-shrink: 0;`. |
| `82` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `83` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `84` | `.brand-name {` | Instrucción de ejecución en el contexto del script: `.brand-name {`. |
| `85` | `color: #f0fff0;` | Instrucción de ejecución en el contexto del script: `color: #f0fff0;`. |
| `86` | `font-size: .95rem; font-weight: 700; line-height: 1.25;` | Instrucción de ejecución en el contexto del script: `font-size: .95rem; font-weight: 700; line-height: 1.25;`. |
| `87` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `88` | `.brand-sub {` | Instrucción de ejecución en el contexto del script: `.brand-sub {`. |
| `89` | `color: #5a8a50;` | Instrucción de ejecución en el contexto del script: `color: #5a8a50;`. |
| `90` | `font-size: .7rem; margin-top: 2px;` | Instrucción de ejecución en el contexto del script: `font-size: .7rem; margin-top: 2px;`. |
| `91` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `92` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `93` | `.sidebar-nav    { padding: .8rem .6rem; flex: 1; overflow-y: auto; }` | Instrucción de ejecución en el contexto del script: `.sidebar-nav    { padding: .8rem .6rem; flex: 1; overflow-y: auto; }`. |
| `94` | `.sidebar-section {` | Instrucción de ejecución en el contexto del script: `.sidebar-section {`. |
| `95` | `color: #3a6030;` | Instrucción de ejecución en el contexto del script: `color: #3a6030;`. |
| `96` | `font-size: .68rem; font-weight: 700;` | Instrucción de ejecución en el contexto del script: `font-size: .68rem; font-weight: 700;`. |
| `97` | `letter-spacing: 1px; text-transform: uppercase;` | Instrucción de ejecución en el contexto del script: `letter-spacing: 1px; text-transform: uppercase;`. |
| `98` | `padding: .9rem 1rem .4rem;` | Instrucción de ejecución en el contexto del script: `padding: .9rem 1rem .4rem;`. |
| `99` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `100` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `101` | `.sidebar-nav .nav-link {` | Instrucción de ejecución en el contexto del script: `.sidebar-nav .nav-link {`. |
| `102` | `color: #7aaa70;` | Instrucción de ejecución en el contexto del script: `color: #7aaa70;`. |
| `103` | `padding: .65rem 1rem; border-radius: 8px; margin-bottom: 2px;` | Instrucción de ejecución en el contexto del script: `padding: .65rem 1rem; border-radius: 8px; margin-bottom: 2px;`. |
| `104` | `font-size: .875rem; font-weight: 500;` | Instrucción de ejecución en el contexto del script: `font-size: .875rem; font-weight: 500;`. |
| `105` | `transition: all .18s ease;` | Instrucción de ejecución en el contexto del script: `transition: all .18s ease;`. |
| `106` | `display: flex; align-items: center; gap: .75rem;` | Instrucción de ejecución en el contexto del script: `display: flex; align-items: center; gap: .75rem;`. |
| `107` | `text-decoration: none;` | Instrucción de ejecución en el contexto del script: `text-decoration: none;`. |
| `108` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `109` | `.sidebar-nav .nav-link i { width: 18px; text-align: center; font-size: ....` | Instrucción de ejecución en el contexto del script: `.sidebar-nav .nav-link i { width: 18px; text-align: center; font-size: ....`. |
| `110` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `111` | `.sidebar-nav .nav-link:hover,` | Instrucción de ejecución en el contexto del script: `.sidebar-nav .nav-link:hover,`. |
| `112` | `.sidebar-nav .nav-link.active {` | Instrucción de ejecución en el contexto del script: `.sidebar-nav .nav-link.active {`. |
| `113` | `background: rgba(57,169,0,.18) !important;` | Instrucción de ejecución en el contexto del script: `background: rgba(57,169,0,.18) !important;`. |
| `114` | `color: #a8f090 !important;` | Instrucción de ejecución en el contexto del script: `color: #a8f090 !important;`. |
| `115` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `116` | `.sidebar-nav .nav-link.active { font-weight: 600; }` | Instrucción de ejecución en el contexto del script: `.sidebar-nav .nav-link.active { font-weight: 600; }`. |
| `117` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `118` | `/* ── TOPBAR ──────────────────────────────────────────────────────── */` | Comentario multilínea de documentación o aclaración técnica. |
| `119` | `#topbar {` | Comentario explicativo en el código: `topbar {`. |
| `120` | `background: var(--topbar-bg);` | Instrucción de ejecución en el contexto del script: `background: var(--topbar-bg);`. |
| `121` | `height: 64px; padding: 0 1.5rem;` | Instrucción de ejecución en el contexto del script: `height: 64px; padding: 0 1.5rem;`. |
| `122` | `display: flex; align-items: center; justify-content: flex-end;` | Instrucción de ejecución en el contexto del script: `display: flex; align-items: center; justify-content: flex-end;`. |
| `123` | `border-bottom: 1px solid var(--sidebar-border);` | Instrucción de ejecución en el contexto del script: `border-bottom: 1px solid var(--sidebar-border);`. |
| `124` | `flex-shrink: 0;` | Instrucción de ejecución en el contexto del script: `flex-shrink: 0;`. |
| `125` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `126` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `127` | `.topbar-name { color: #f0fff0; font-size: .88rem; font-weight: 700; }` | Instrucción de ejecución en el contexto del script: `.topbar-name { color: #f0fff0; font-size: .88rem; font-weight: 700; }`. |
| `128` | `.topbar-role { color: #5a8a50;  font-size: .75rem; }` | Instrucción de ejecución en el contexto del script: `.topbar-role { color: #5a8a50;  font-size: .75rem; }`. |
| `129` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `130` | `.user-badge {` | Instrucción de ejecución en el contexto del script: `.user-badge {`. |
| `131` | `width: 38px; height: 38px; border-radius: 50%;` | Instrucción de ejecución en el contexto del script: `width: 38px; height: 38px; border-radius: 50%;`. |
| `132` | `background: rgba(57,169,0,.15);` | Instrucción de ejecución en el contexto del script: `background: rgba(57,169,0,.15);`. |
| `133` | `border: 1px solid rgba(57,169,0,.3);` | Instrucción de ejecución en el contexto del script: `border: 1px solid rgba(57,169,0,.3);`. |
| `134` | `display: flex; align-items: center; justify-content: center;` | Instrucción de ejecución en el contexto del script: `display: flex; align-items: center; justify-content: center;`. |
| `135` | `font-size: 1rem; color: var(--sena-green);` | Instrucción de ejecución en el contexto del script: `font-size: 1rem; color: var(--sena-green);`. |
| `136` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `137` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `138` | `.btn-salir {` | Instrucción de ejecución en el contexto del script: `.btn-salir {`. |
| `139` | `background: transparent;` | Instrucción de ejecución en el contexto del script: `background: transparent;`. |
| `140` | `border: 1px solid rgba(239,68,68,.45);` | Instrucción de ejecución en el contexto del script: `border: 1px solid rgba(239,68,68,.45);`. |
| `141` | `color: #f87171;` | Instrucción de ejecución en el contexto del script: `color: #f87171;`. |
| `142` | `padding: .35rem .9rem; border-radius: 8px;` | Instrucción de ejecución en el contexto del script: `padding: .35rem .9rem; border-radius: 8px;`. |
| `143` | `font-size: .82rem; font-weight: 600;` | Instrucción de ejecución en el contexto del script: `font-size: .82rem; font-weight: 600;`. |
| `144` | `display: inline-flex; align-items: center; gap: .4rem;` | Instrucción de ejecución en el contexto del script: `display: inline-flex; align-items: center; gap: .4rem;`. |
| `145` | `text-decoration: none; transition: all .2s;` | Instrucción de ejecución en el contexto del script: `text-decoration: none; transition: all .2s;`. |
| `146` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `147` | `.btn-salir:hover { background: rgba(239,68,68,.12); color: #fca5a5; bord...` | Instrucción de ejecución en el contexto del script: `.btn-salir:hover { background: rgba(239,68,68,.12); color: #fca5a5; bord...`. |
| `148` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `149` | `.btn-notif {` | Instrucción de ejecución en el contexto del script: `.btn-notif {`. |
| `150` | `position: relative;` | Instrucción de ejecución en el contexto del script: `position: relative;`. |
| `151` | `background: transparent;` | Instrucción de ejecución en el contexto del script: `background: transparent;`. |
| `152` | `border: 1px solid var(--sidebar-border);` | Instrucción de ejecución en el contexto del script: `border: 1px solid var(--sidebar-border);`. |
| `153` | `color: #7aaa70;` | Instrucción de ejecución en el contexto del script: `color: #7aaa70;`. |
| `154` | `width: 38px; height: 38px; border-radius: 50%;` | Instrucción de ejecución en el contexto del script: `width: 38px; height: 38px; border-radius: 50%;`. |
| `155` | `display: flex; align-items: center; justify-content: center;` | Instrucción de ejecución en el contexto del script: `display: flex; align-items: center; justify-content: center;`. |
| `156` | `font-size: 1rem; text-decoration: none; transition: all .2s;` | Instrucción de ejecución en el contexto del script: `font-size: 1rem; text-decoration: none; transition: all .2s;`. |
| `157` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `158` | `.btn-notif:hover { background: rgba(57,169,0,.12); color: var(--sena-gre...` | Instrucción de ejecución en el contexto del script: `.btn-notif:hover { background: rgba(57,169,0,.12); color: var(--sena-gre...`. |
| `159` | `.notif-badge {` | Instrucción de ejecución en el contexto del script: `.notif-badge {`. |
| `160` | `position: absolute; top: -4px; right: -4px;` | Instrucción de ejecución en el contexto del script: `position: absolute; top: -4px; right: -4px;`. |
| `161` | `background: #ef4444; color: #fff;` | Instrucción de ejecución en el contexto del script: `background: #ef4444; color: #fff;`. |
| `162` | `font-size: .6rem; font-weight: 700;` | Instrucción de ejecución en el contexto del script: `font-size: .6rem; font-weight: 700;`. |
| `163` | `width: 17px; height: 17px; border-radius: 50%;` | Instrucción de ejecución en el contexto del script: `width: 17px; height: 17px; border-radius: 50%;`. |
| `164` | `display: flex; align-items: center; justify-content: center;` | Instrucción de ejecución en el contexto del script: `display: flex; align-items: center; justify-content: center;`. |
| `165` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `166` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `167` | `/* ── LAYOUT ──────────────────────────────────────────────────────── */` | Comentario multilínea de documentación o aclaración técnica. |
| `168` | `#mainContent { flex: 1; overflow-x: hidden; display: flex; flex-directio...` | Comentario explicativo en el código: `mainContent { flex: 1; overflow-x: hidden; display: flex; flex-direction...`. |
| `169` | `#pageContent  { padding: 2rem; flex: 1; background: var(--content-bg); }` | Comentario explicativo en el código: `pageContent  { padding: 2rem; flex: 1; background: var(--content-bg); }`. |
| `170` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `171` | `/* Tarjetas de stats */` | Comentario multilínea de documentación o aclaración técnica. |
| `172` | `.stat-card {` | Instrucción de ejecución en el contexto del script: `.stat-card {`. |
| `173` | `border-radius: 12px; padding: 1.5rem;` | Instrucción de ejecución en el contexto del script: `border-radius: 12px; padding: 1.5rem;`. |
| `174` | `border: none; box-shadow: 0 1px 3px rgba(0,0,0,.08);` | Instrucción de ejecución en el contexto del script: `border: none; box-shadow: 0 1px 3px rgba(0,0,0,.08);`. |
| `175` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `176` | `.stat-icon {` | Instrucción de ejecución en el contexto del script: `.stat-icon {`. |
| `177` | `width: 48px; height: 48px; border-radius: 10px;` | Instrucción de ejecución en el contexto del script: `width: 48px; height: 48px; border-radius: 10px;`. |
| `178` | `display: flex; align-items: center; justify-content: center;` | Instrucción de ejecución en el contexto del script: `display: flex; align-items: center; justify-content: center;`. |
| `179` | `font-size: 1.3rem;` | Instrucción de ejecución en el contexto del script: `font-size: 1.3rem;`. |
| `180` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `181` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `182` | `/* Tabla estilo limpio */` | Comentario multilínea de documentación o aclaración técnica. |
| `183` | `.tabla-limpia { font-size: .875rem; }` | Instrucción de ejecución en el contexto del script: `.tabla-limpia { font-size: .875rem; }`. |
| `184` | `.tabla-limpia thead th { font-size: .78rem; font-weight: 700; text-trans...` | Instrucción de ejecución en el contexto del script: `.tabla-limpia thead th { font-size: .78rem; font-weight: 700; text-trans...`. |
| `185` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `186` | `@media (max-width: 768px) { #sidebar { display: none; } }` | Instrucción de ejecución en el contexto del script: `@media (max-width: 768px) { #sidebar { display: none; } }`. |
| `187` | ``</style>`` | Cierre de bloque de estilos CSS. |
| `188` | ``<script>`` | Bloque o etiqueta de vinculación para scripts JavaScript del lado del cliente. |
| `189` | `// Bloquear el bfcache (Back-Forward Cache) de los navegadores modernos.` | Comentario explicativo en el código: `Bloquear el bfcache (Back-Forward Cache) de los navegadores modernos.`. |
| `190` | `// Cuando el usuario presiona "atrás" después de cerrar sesión, el naveg...` | Comentario explicativo en el código: `Cuando el usuario presiona "atrás" después de cerrar sesión, el navegador`. |
| `191` | `// normalmente restaura la página desde memoria sin consultar el servidor.` | Comentario explicativo en el código: `normalmente restaura la página desde memoria sin consultar el servidor.`. |
| `192` | `// pageshow se dispara tanto en carga normal como en restauración desde ...` | Comentario explicativo en el código: `pageshow se dispara tanto en carga normal como en restauración desde bfc...`. |
| `193` | `window.addEventListener('pageshow', function(e) {` | Registra un escucha de eventos del DOM para interactividad en tiempo real: `window.addEventListener('pageshow', function(e) {`. |
| `194` | `if (e.persisted) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (e.persisted) {`. |
| `195` | `// La página fue restaurada desde bfcache — forzar recarga del servidor` | Comentario explicativo en el código: `La página fue restaurada desde bfcache — forzar recarga del servidor`. |
| `196` | `window.location.reload();` | Instrucción de ejecución en el contexto del script: `window.location.reload();`. |
| `197` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `198` | `});` | Instrucción de ejecución en el contexto del script: `});`. |
| `199` | ``</script>`` | Cierre de bloque de script JavaScript. |
| `200` | `</head>` | Instrucción de ejecución en el contexto del script: `</head>`. |
| `201` | `<body>` | Instrucción de ejecución en el contexto del script: `<body>`. |
| `202` | `<div class="d-flex" style="min-height:100vh;">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="d-flex" style="min-height:100vh;">`. |
| `203` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `204` | `<!-- ══ SIDEBAR ════════════════════════════════════════════════════════...` | Instrucción de ejecución en el contexto del script: `<!-- ══ SIDEBAR ════════════════════════════════════════════════════════...`. |
| `205` | `<nav id="sidebar">` | Instrucción de ejecución en el contexto del script: `<nav id="sidebar">`. |
| `206` | `<div class="sidebar-brand">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="sidebar-brand">`. |
| `207` | `<div class="brand-icon-box">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="brand-icon-box">`. |
| `208` | `<i class="fas fa-broom text-white fs-5"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-broom text-white fs-5"></i>`. |
| `209` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `210` | `<div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div>`. |
| `211` | `<div class="brand-name">GestiLimpieza</div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="brand-name">GestiLimpieza</div>`. |
| `212` | `<div class="brand-sub">SENA – SICEFA</div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="brand-sub">SENA – SICEFA</div>`. |
| `213` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `214` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `215` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `216` | `<div class="sidebar-nav">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="sidebar-nav">`. |
| `217` | `<?php if ($rolId === 1): // ADMINISTRADOR ?>` | Instrucción de ejecución en el contexto del script: `<?php if ($rolId === 1): // ADMINISTRADOR ?>`. |
| `218` | `<div class="sidebar-section">Principal</div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="sidebar-section">Principal</div>`. |
| `219` | `<a href="admin_dashboard.php"  class="nav-link <?= $paginaActual==='admi...` | Instrucción de ejecución en el contexto del script: `<a href="admin_dashboard.php"  class="nav-link <?= $paginaActual==='admi...`. |
| `220` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `221` | `<div class="sidebar-section">Gestión Académica</div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="sidebar-section">Gestión Académica</div>`. |
| `222` | `<a href="admin_programas.php"  class="nav-link <?= in_array($paginaActua...` | Instrucción de ejecución en el contexto del script: `<a href="admin_programas.php"  class="nav-link <?= in_array($paginaActua...`. |
| `223` | `<i class="fas fa-graduation-cap"></i> Programas y Fichas` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-graduation-cap"></i> Programas y Fichas`. |
| `224` | `</a>` | Instrucción de ejecución en el contexto del script: `</a>`. |
| `225` | `<a href="admin_aprendices.php" class="nav-link <?= $paginaActual==='admi...` | Instrucción de ejecución en el contexto del script: `<a href="admin_aprendices.php" class="nav-link <?= $paginaActual==='admi...`. |
| `226` | `<a href="admin_voceros.php"    class="nav-link <?= $paginaActual==='admi...` | Instrucción de ejecución en el contexto del script: `<a href="admin_voceros.php"    class="nav-link <?= $paginaActual==='admi...`. |
| `227` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `228` | `<div class="sidebar-section">Limpieza</div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="sidebar-section">Limpieza</div>`. |
| `229` | `<a href="admin_modulos.php"    class="nav-link <?= $paginaActual==='admi...` | Instrucción de ejecución en el contexto del script: `<a href="admin_modulos.php"    class="nav-link <?= $paginaActual==='admi...`. |
| `230` | `<a href="admin_evidencias.php" class="nav-link <?= $paginaActual==='admi...` | Instrucción de ejecución en el contexto del script: `<a href="admin_evidencias.php" class="nav-link <?= $paginaActual==='admi...`. |
| `231` | `<a href="admin_grupos.php"     class="nav-link <?= $paginaActual==='admi...` | Instrucción de ejecución en el contexto del script: `<a href="admin_grupos.php"     class="nav-link <?= $paginaActual==='admi...`. |
| `232` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `233` | `<div class="sidebar-section">Sistema</div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="sidebar-section">Sistema</div>`. |
| `234` | `<a href="admin_notificaciones.php" class="nav-link <?= $paginaActual==='...` | Instrucción de ejecución en el contexto del script: `<a href="admin_notificaciones.php" class="nav-link <?= $paginaActual==='...`. |
| `235` | `<i class="fas fa-bell"></i> Notificaciones` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-bell"></i> Notificaciones`. |
| `236` | `<?php if ($_countNoti > 0): ?>` | Instrucción de ejecución en el contexto del script: `<?php if ($_countNoti > 0): ?>`. |
| `237` | `<span class="badge bg-danger ms-auto"><?= $_countNoti ?></span>` | Instrucción de ejecución en el contexto del script: `<span class="badge bg-danger ms-auto"><?= $_countNoti ?></span>`. |
| `238` | `<?php endif; ?>` | Cierre de estructura condicional embebida en la plantilla HTML. |
| `239` | `</a>` | Instrucción de ejecución en el contexto del script: `</a>`. |
| `240` | `<a href="admin_sincronizacion.php" class="nav-link <?= $paginaActual==='...` | Instrucción de ejecución en el contexto del script: `<a href="admin_sincronizacion.php" class="nav-link <?= $paginaActual==='...`. |
| `241` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `242` | `<?php else: // VOCERO ?>` | Instrucción de ejecución en el contexto del script: `<?php else: // VOCERO ?>`. |
| `243` | `<div class="sidebar-section">Mi Panel</div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="sidebar-section">Mi Panel</div>`. |
| `244` | `<a href="vocero_dashboard.php"   class="nav-link <?= $paginaActual==='vo...` | Instrucción de ejecución en el contexto del script: `<a href="vocero_dashboard.php"   class="nav-link <?= $paginaActual==='vo...`. |
| `245` | `<a href="vocero_aprendices.php"  class="nav-link <?= $paginaActual==='vo...` | Instrucción de ejecución en el contexto del script: `<a href="vocero_aprendices.php"  class="nav-link <?= $paginaActual==='vo...`. |
| `246` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `247` | `<div class="sidebar-section">Limpieza</div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="sidebar-section">Limpieza</div>`. |
| `248` | `<a href="vocero_grupos.php"            class="nav-link <?= $paginaActual...` | Instrucción de ejecución en el contexto del script: `<a href="vocero_grupos.php"            class="nav-link <?= $paginaActual...`. |
| `249` | `<a href="vocero_subir_evidencia.php"   class="nav-link <?= $paginaActual...` | Instrucción de ejecución en el contexto del script: `<a href="vocero_subir_evidencia.php"   class="nav-link <?= $paginaActual...`. |
| `250` | `<a href="vocero_evidencias.php"        class="nav-link <?= $paginaActual...` | Instrucción de ejecución en el contexto del script: `<a href="vocero_evidencias.php"        class="nav-link <?= $paginaActual...`. |
| `251` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `252` | `<div class="sidebar-section">Sistema</div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="sidebar-section">Sistema</div>`. |
| `253` | `<a href="vocero_notificaciones.php" class="nav-link <?= $paginaActual===...` | Instrucción de ejecución en el contexto del script: `<a href="vocero_notificaciones.php" class="nav-link <?= $paginaActual===...`. |
| `254` | `<i class="fas fa-bell"></i> Notificaciones` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-bell"></i> Notificaciones`. |
| `255` | `<?php if ($_countNoti > 0): ?>` | Instrucción de ejecución en el contexto del script: `<?php if ($_countNoti > 0): ?>`. |
| `256` | `<span class="badge bg-danger ms-auto"><?= $_countNoti ?></span>` | Instrucción de ejecución en el contexto del script: `<span class="badge bg-danger ms-auto"><?= $_countNoti ?></span>`. |
| `257` | `<?php endif; ?>` | Cierre de estructura condicional embebida en la plantilla HTML. |
| `258` | `</a>` | Instrucción de ejecución en el contexto del script: `</a>`. |
| `259` | `<?php endif; ?>` | Cierre de estructura condicional embebida en la plantilla HTML. |
| `260` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `261` | `</nav>` | Instrucción de ejecución en el contexto del script: `</nav>`. |
| `262` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `263` | `<!-- ══ MAIN CONTENT ═══════════════════════════════════════════════════...` | Instrucción de ejecución en el contexto del script: `<!-- ══ MAIN CONTENT ═══════════════════════════════════════════════════...`. |
| `264` | `<div id="mainContent">` | Contenedor visual estructurado con Bootstrap/CSS: `<div id="mainContent">`. |
| `265` | `<header id="topbar">` | Instrucción de ejecución en el contexto del script: `<header id="topbar">`. |
| `266` | `<div class="d-flex align-items-center gap-3">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="d-flex align-items-center gap-3">`. |
| `267` | `<!-- Notificaciones -->` | Instrucción de ejecución en el contexto del script: `<!-- Notificaciones -->`. |
| `268` | ``<?php`` | Apertura obligatoria de la etiqueta PHP para ejecución del código del lado del servidor. |
| `269` | `$urlNoti = $rolId === 1 ? 'admin_notificaciones.php' : 'vocero_notificac...` | Instrucción de ejecución en el contexto del script: `$urlNoti = $rolId === 1 ? 'admin_notificaciones.php' : 'vocero_notificac...`. |
| `270` | ``?>`` | Cierre de la etiqueta PHP para alternar a salida HTML o fin del archivo. |
| `271` | `<a href="<?= $urlNoti ?>" class="btn-notif">` | Instrucción de ejecución en el contexto del script: `<a href="<?= $urlNoti ?>" class="btn-notif">`. |
| `272` | `<i class="fas fa-bell"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-bell"></i>`. |
| `273` | `<?php if ($_countNoti > 0): ?>` | Instrucción de ejecución en el contexto del script: `<?php if ($_countNoti > 0): ?>`. |
| `274` | `<span class="notif-badge"><?= $_countNoti ?></span>` | Instrucción de ejecución en el contexto del script: `<span class="notif-badge"><?= $_countNoti ?></span>`. |
| `275` | `<?php endif; ?>` | Cierre de estructura condicional embebida en la plantilla HTML. |
| `276` | `</a>` | Instrucción de ejecución en el contexto del script: `</a>`. |
| `277` | `<div class="text-end">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="text-end">`. |
| `278` | `<div class="topbar-name"><?= htmlspecialchars($nombreCompleto) ?></div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="topbar-name"><?= htmlspecialchars($nombreCompleto) ?></div>`. |
| `279` | `<div class="topbar-role"><?= $rolId === 1 ? 'Administrador' : 'Vocero' ?...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="topbar-role"><?= $rolId === 1 ? 'Administrador' : 'Vocero' ?...`. |
| `280` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `281` | `<div class="user-badge"><i class="fas fa-user"></i></div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="user-badge"><i class="fas fa-user"></i></div>`. |
| `282` | `<a href="../../controllers/AuthController.php?accion=logout" class="btn-...` | Instrucción de ejecución en el contexto del script: `<a href="../../controllers/AuthController.php?accion=logout" class="btn-...`. |
| `283` | `<i class="fas fa-power-off"></i> Salir` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-power-off"></i> Salir`. |
| `284` | `</a>` | Instrucción de ejecución en el contexto del script: `</a>`. |
| `285` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `286` | `</header>` | Instrucción de ejecución en el contexto del script: `</header>`. |
| `287` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `288` | `<section id="pageContent">` | Instrucción de ejecución en el contexto del script: `<section id="pageContent">`. |

---

## 3. Resumen y Flujo de Interacción

El archivo `header.php` cumple un rol indispensable en `views/layouts/header.php`. 
Plantilla reutilizable con barra superior institucional SENA, menú lateral (sidebar), metadatos HTML, estilos CSS y control visual de sesión. Garantiza la robustez, el orden y la estabilidad de la arquitectura del proyecto `systemLimpieza`.

---

Generado automáticamente para el repositorio [johanrepizo/LimpiezaDeModulos](https://github.com/johanrepizo/LimpiezaDeModulos).
