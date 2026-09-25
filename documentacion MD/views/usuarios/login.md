# Documentación Línea por Línea: `views/usuarios/login.php`

## 1. Ficha Técnica del Archivo

- **Archivo:** `login.php`
- **Ruta en el proyecto:** `views/usuarios/login.php`
- **Cantidad total de líneas:** `526`
- **Tipo de archivo:** `PHP`
- **Propósito general:** Vista interactiva del formulario de inicio de sesión con validaciones visuales, mensajes flash de error y recuperación.

---

## 2. Explicación Detallada Línea por Línea

A continuación se presenta cada línea de código numerada de forma consecutiva, acompañada de su fragmento exacto y la explicación exhaustiva de su funcionamiento y responsabilidad en el sistema:

| Línea | Código Fuente | Explicación Detallada |
|---|---|---|
| `1` | ``<?php`` | Apertura obligatoria de la etiqueta PHP para ejecución del código del lado del servidor. |
| `2` | `session_start();` | Instrucción de ejecución en el contexto del script: `session_start();`. |
| `3` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `4` | `// Si ya hay sesión activa, redirigir directamente al dashboard correspo...` | Comentario explicativo en el código: `Si ya hay sesión activa, redirigir directamente al dashboard correspondi...`. |
| `5` | `if (isset($_SESSION['usuario'])) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (isset($_SESSION['usuario'])) {`. |
| `6` | `$rol = (int)($_SESSION['usuario']['rol'] ?? 0);` | Instrucción de ejecución en el contexto del script: `$rol = (int)($_SESSION['usuario']['rol'] ?? 0);`. |
| `7` | `if ($rol === 1) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if ($rol === 1) {`. |
| `8` | `header("Location: ../dashboard/admin_dashboard.php"); exit;` | Emite cabecera HTTP de redirección en el navegador y detiene la ejecución: `header("Location: ../dashboard/admin_dashboard.php"); exit;`. |
| `9` | `} else {` | Instrucción de ejecución en el contexto del script: `} else {`. |
| `10` | `header("Location: ../dashboard/vocero_dashboard.php"); exit;` | Emite cabecera HTTP de redirección en el navegador y detiene la ejecución: `header("Location: ../dashboard/vocero_dashboard.php"); exit;`. |
| `11` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `12` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `13` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `14` | `$alert      = $_SESSION['alert'] ?? null;` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección. |
| `15` | `unset($_SESSION['alert']);` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección. |
| `16` | `$abrirPanel = ($_GET['panel'] ?? '') === 'recuperar';` | Instrucción de ejecución en el contexto del script: `$abrirPanel = ($_GET['panel'] ?? '') === 'recuperar';`. |
| `17` | ``?>`` | Cierre de la etiqueta PHP para alternar a salida HTML o fin del archivo. |
| `18` | `<!DOCTYPE html>` | Instrucción de ejecución en el contexto del script: `<!DOCTYPE html>`. |
| `19` | `<html lang="es">` | Instrucción de ejecución en el contexto del script: `<html lang="es">`. |
| `20` | `<head>` | Instrucción de ejecución en el contexto del script: `<head>`. |
| `21` | `<meta charset="UTF-8">` | Instrucción de ejecución en el contexto del script: `<meta charset="UTF-8">`. |
| `22` | `<meta name="viewport" content="width=device-width, initial-scale=1.0">` | Instrucción de ejecución en el contexto del script: `<meta name="viewport" content="width=device-width, initial-scale=1.0">`. |
| `23` | `<title>Iniciar Sesión – GestiLimpieza SENA</title>` | Instrucción de ejecución en el contexto del script: `<title>Iniciar Sesión – GestiLimpieza SENA</title>`. |
| `24` | `<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootst...` | Vinculación de hoja de estilos o recurso externo: `<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootst...`. |
| `25` | `<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font...` | Vinculación de hoja de estilos o recurso externo: `<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font...`. |
| `26` | `<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;...` | Vinculación de hoja de estilos o recurso externo: `<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;...`. |
| `27` | ``<script>`` | Bloque o etiqueta de vinculación para scripts JavaScript del lado del cliente. |
| `28` | ``<style>`` | Bloque de estilos CSS personalizados para la interfaz. |
| `29` | `:root {` | Instrucción de ejecución en el contexto del script: `:root {`. |
| `30` | `--green:       #39a900;` | Comentario explicativo SQL: `green:       #39a900;`. |
| `31` | `--green-dark:  #2d8400;` | Comentario explicativo SQL: `green-dark:  #2d8400;`. |
| `32` | `--green-soft:  #f0faf0;` | Comentario explicativo SQL: `green-soft:  #f0faf0;`. |
| `33` | `--gray-50:     #f8fafc;` | Comentario explicativo SQL: `gray-50:     #f8fafc;`. |
| `34` | `--gray-100:    #f1f5f9;` | Comentario explicativo SQL: `gray-100:    #f1f5f9;`. |
| `35` | `--gray-200:    #e2e8f0;` | Comentario explicativo SQL: `gray-200:    #e2e8f0;`. |
| `36` | `--gray-500:    #64748b;` | Comentario explicativo SQL: `gray-500:    #64748b;`. |
| `37` | `--gray-700:    #334155;` | Comentario explicativo SQL: `gray-700:    #334155;`. |
| `38` | `--gray-900:    #0f172a;` | Comentario explicativo SQL: `gray-900:    #0f172a;`. |
| `39` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `40` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `41` | `* { box-sizing: border-box; }` | Comentario multilínea de documentación o aclaración técnica. |
| `42` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `43` | `body {` | Instrucción de ejecución en el contexto del script: `body {`. |
| `44` | `font-family: 'Inter', sans-serif;` | Instrucción de ejecución en el contexto del script: `font-family: 'Inter', sans-serif;`. |
| `45` | `background: var(--gray-50);` | Instrucción de ejecución en el contexto del script: `background: var(--gray-50);`. |
| `46` | `min-height: 100vh;` | Instrucción de ejecución en el contexto del script: `min-height: 100vh;`. |
| `47` | `display: flex;` | Instrucción de ejecución en el contexto del script: `display: flex;`. |
| `48` | `flex-direction: column;` | Instrucción de ejecución en el contexto del script: `flex-direction: column;`. |
| `49` | `margin: 0;` | Instrucción de ejecución en el contexto del script: `margin: 0;`. |
| `50` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `51` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `52` | `/* ── TOPBAR ── */` | Comentario multilínea de documentación o aclaración técnica. |
| `53` | `.topbar {` | Instrucción de ejecución en el contexto del script: `.topbar {`. |
| `54` | `background: #fff;` | Instrucción de ejecución en el contexto del script: `background: #fff;`. |
| `55` | `border-bottom: 1px solid var(--gray-200);` | Instrucción de ejecución en el contexto del script: `border-bottom: 1px solid var(--gray-200);`. |
| `56` | `padding: .75rem 0;` | Instrucción de ejecución en el contexto del script: `padding: .75rem 0;`. |
| `57` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `58` | `.topbar-brand {` | Instrucción de ejecución en el contexto del script: `.topbar-brand {`. |
| `59` | `display: flex; align-items: center; gap: .55rem;` | Instrucción de ejecución en el contexto del script: `display: flex; align-items: center; gap: .55rem;`. |
| `60` | `font-weight: 700; font-size: 1rem; color: var(--gray-900);` | Instrucción de ejecución en el contexto del script: `font-weight: 700; font-size: 1rem; color: var(--gray-900);`. |
| `61` | `text-decoration: none;` | Instrucción de ejecución en el contexto del script: `text-decoration: none;`. |
| `62` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `63` | `.brand-icon {` | Instrucción de ejecución en el contexto del script: `.brand-icon {`. |
| `64` | `width: 32px; height: 32px; border-radius: 8px;` | Instrucción de ejecución en el contexto del script: `width: 32px; height: 32px; border-radius: 8px;`. |
| `65` | `background: var(--green); color: #fff;` | Instrucción de ejecución en el contexto del script: `background: var(--green); color: #fff;`. |
| `66` | `display: flex; align-items: center; justify-content: center;` | Instrucción de ejecución en el contexto del script: `display: flex; align-items: center; justify-content: center;`. |
| `67` | `font-size: .82rem;` | Instrucción de ejecución en el contexto del script: `font-size: .82rem;`. |
| `68` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `69` | `.btn-back {` | Instrucción de ejecución en el contexto del script: `.btn-back {`. |
| `70` | `font-size: .85rem; color: var(--gray-500);` | Instrucción de ejecución en el contexto del script: `font-size: .85rem; color: var(--gray-500);`. |
| `71` | `text-decoration: none; font-weight: 500;` | Instrucción de ejecución en el contexto del script: `text-decoration: none; font-weight: 500;`. |
| `72` | `display: flex; align-items: center; gap: .35rem;` | Instrucción de ejecución en el contexto del script: `display: flex; align-items: center; gap: .35rem;`. |
| `73` | `transition: color .15s;` | Instrucción de ejecución en el contexto del script: `transition: color .15s;`. |
| `74` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `75` | `.btn-back:hover { color: var(--green); }` | Instrucción de ejecución en el contexto del script: `.btn-back:hover { color: var(--green); }`. |
| `76` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `77` | `/* ── LAYOUT ── */` | Comentario multilínea de documentación o aclaración técnica. |
| `78` | `.login-wrapper {` | Instrucción de ejecución en el contexto del script: `.login-wrapper {`. |
| `79` | `flex: 1;` | Instrucción de ejecución en el contexto del script: `flex: 1;`. |
| `80` | `display: flex;` | Instrucción de ejecución en el contexto del script: `display: flex;`. |
| `81` | `align-items: stretch;` | Instrucción de ejecución en el contexto del script: `align-items: stretch;`. |
| `82` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `83` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `84` | `/* ── PANEL IZQUIERDO ── */` | Comentario multilínea de documentación o aclaración técnica. |
| `85` | `.panel-left {` | Instrucción de ejecución en el contexto del script: `.panel-left {`. |
| `86` | `background: linear-gradient(160deg, #0a1a00 0%, #1b4200 60%, #0d2800 100%);` | Instrucción de ejecución en el contexto del script: `background: linear-gradient(160deg, #0a1a00 0%, #1b4200 60%, #0d2800 100%);`. |
| `87` | `display: flex; flex-direction: column; justify-content: center;` | Instrucción de ejecución en el contexto del script: `display: flex; flex-direction: column; justify-content: center;`. |
| `88` | `padding: 3.5rem;` | Instrucción de ejecución en el contexto del script: `padding: 3.5rem;`. |
| `89` | `position: relative; overflow: hidden;` | Instrucción de ejecución en el contexto del script: `position: relative; overflow: hidden;`. |
| `90` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `91` | `.panel-left::before {` | Instrucción de ejecución en el contexto del script: `.panel-left::before {`. |
| `92` | `content: '';` | Instrucción de ejecución en el contexto del script: `content: '';`. |
| `93` | `position: absolute; inset: 0; opacity: .4;` | Instrucción de ejecución en el contexto del script: `position: absolute; inset: 0; opacity: .4;`. |
| `94` | `background-image: radial-gradient(circle at 30% 70%, rgba(57,169,0,.25) ...` | Instrucción de ejecución en el contexto del script: `background-image: radial-gradient(circle at 30% 70%, rgba(57,169,0,.25) ...`. |
| `95` | `radial-gradient(circle at 80% 20%, rgba(57,169,0,.15) 0%, transparent 50%);` | Instrucción de ejecución en el contexto del script: `radial-gradient(circle at 80% 20%, rgba(57,169,0,.15) 0%, transparent 50%);`. |
| `96` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `97` | `.panel-left-inner { position: relative; z-index: 1; }` | Instrucción de ejecución en el contexto del script: `.panel-left-inner { position: relative; z-index: 1; }`. |
| `98` | `.pl-badge {` | Instrucción de ejecución en el contexto del script: `.pl-badge {`. |
| `99` | `display: inline-flex; align-items: center; gap: .5rem;` | Instrucción de ejecución en el contexto del script: `display: inline-flex; align-items: center; gap: .5rem;`. |
| `100` | `background: rgba(57,169,0,.15); color: #7ddd5a;` | Instrucción de ejecución en el contexto del script: `background: rgba(57,169,0,.15); color: #7ddd5a;`. |
| `101` | `border: 1px solid rgba(57,169,0,.25); border-radius: 20px;` | Instrucción de ejecución en el contexto del script: `border: 1px solid rgba(57,169,0,.25); border-radius: 20px;`. |
| `102` | `padding: .3rem .85rem; font-size: .78rem; font-weight: 600;` | Instrucción de ejecución en el contexto del script: `padding: .3rem .85rem; font-size: .78rem; font-weight: 600;`. |
| `103` | `margin-bottom: 2rem;` | Instrucción de ejecución en el contexto del script: `margin-bottom: 2rem;`. |
| `104` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `105` | `.panel-left h2 {` | Instrucción de ejecución en el contexto del script: `.panel-left h2 {`. |
| `106` | `color: #fff; font-size: 2rem; font-weight: 800;` | Instrucción de ejecución en el contexto del script: `color: #fff; font-size: 2rem; font-weight: 800;`. |
| `107` | `line-height: 1.2; margin-bottom: 1rem;` | Instrucción de ejecución en el contexto del script: `line-height: 1.2; margin-bottom: 1rem;`. |
| `108` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `109` | `.panel-left p {` | Instrucción de ejecución en el contexto del script: `.panel-left p {`. |
| `110` | `color: rgba(255,255,255,.6); font-size: .9rem; line-height: 1.7;` | Instrucción de ejecución en el contexto del script: `color: rgba(255,255,255,.6); font-size: .9rem; line-height: 1.7;`. |
| `111` | `margin-bottom: 2rem; max-width: 320px;` | Instrucción de ejecución en el contexto del script: `margin-bottom: 2rem; max-width: 320px;`. |
| `112` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `113` | `.pl-feature {` | Instrucción de ejecución en el contexto del script: `.pl-feature {`. |
| `114` | `display: flex; align-items: center; gap: .65rem;` | Instrucción de ejecución en el contexto del script: `display: flex; align-items: center; gap: .65rem;`. |
| `115` | `color: rgba(255,255,255,.65); font-size: .83rem;` | Instrucción de ejecución en el contexto del script: `color: rgba(255,255,255,.65); font-size: .83rem;`. |
| `116` | `margin-bottom: .7rem;` | Instrucción de ejecución en el contexto del script: `margin-bottom: .7rem;`. |
| `117` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `118` | `.pl-feature-dot {` | Instrucción de ejecución en el contexto del script: `.pl-feature-dot {`. |
| `119` | `width: 28px; height: 28px; border-radius: 7px;` | Instrucción de ejecución en el contexto del script: `width: 28px; height: 28px; border-radius: 7px;`. |
| `120` | `background: rgba(57,169,0,.2); color: #7ddd5a;` | Instrucción de ejecución en el contexto del script: `background: rgba(57,169,0,.2); color: #7ddd5a;`. |
| `121` | `display: flex; align-items: center; justify-content: center;` | Instrucción de ejecución en el contexto del script: `display: flex; align-items: center; justify-content: center;`. |
| `122` | `font-size: .75rem; flex-shrink: 0;` | Instrucción de ejecución en el contexto del script: `font-size: .75rem; flex-shrink: 0;`. |
| `123` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `124` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `125` | `/* ── PANEL DERECHO ── */` | Comentario multilínea de documentación o aclaración técnica. |
| `126` | `.panel-right {` | Instrucción de ejecución en el contexto del script: `.panel-right {`. |
| `127` | `background: #fff;` | Instrucción de ejecución en el contexto del script: `background: #fff;`. |
| `128` | `display: flex; flex-direction: column; justify-content: center;` | Instrucción de ejecución en el contexto del script: `display: flex; flex-direction: column; justify-content: center;`. |
| `129` | `padding: 3rem 3.5rem;` | Instrucción de ejecución en el contexto del script: `padding: 3rem 3.5rem;`. |
| `130` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `131` | `.login-title {` | Instrucción de ejecución en el contexto del script: `.login-title {`. |
| `132` | `font-size: 1.65rem; font-weight: 800;` | Instrucción de ejecución en el contexto del script: `font-size: 1.65rem; font-weight: 800;`. |
| `133` | `color: var(--gray-900); margin-bottom: .35rem;` | Instrucción de ejecución en el contexto del script: `color: var(--gray-900); margin-bottom: .35rem;`. |
| `134` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `135` | `.login-sub {` | Instrucción de ejecución en el contexto del script: `.login-sub {`. |
| `136` | `font-size: .875rem; color: var(--gray-500);` | Instrucción de ejecución en el contexto del script: `font-size: .875rem; color: var(--gray-500);`. |
| `137` | `margin-bottom: 2rem;` | Instrucción de ejecución en el contexto del script: `margin-bottom: 2rem;`. |
| `138` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `139` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `140` | `/* ── FORM ── */` | Comentario multilínea de documentación o aclaración técnica. |
| `141` | `.form-label {` | Instrucción de ejecución en el contexto del script: `.form-label {`. |
| `142` | `font-size: .82rem; font-weight: 600;` | Instrucción de ejecución en el contexto del script: `font-size: .82rem; font-weight: 600;`. |
| `143` | `color: var(--gray-700); margin-bottom: .4rem;` | Instrucción de ejecución en el contexto del script: `color: var(--gray-700); margin-bottom: .4rem;`. |
| `144` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `145` | `.input-wrap {` | Instrucción de ejecución en el contexto del script: `.input-wrap {`. |
| `146` | `position: relative;` | Instrucción de ejecución en el contexto del script: `position: relative;`. |
| `147` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `148` | `.input-icon {` | Instrucción de ejecución en el contexto del script: `.input-icon {`. |
| `149` | `position: absolute; left: .9rem; top: 50%; transform: translateY(-50%);` | Instrucción de ejecución en el contexto del script: `position: absolute; left: .9rem; top: 50%; transform: translateY(-50%);`. |
| `150` | `color: var(--gray-500); font-size: .85rem; pointer-events: none;` | Instrucción de ejecución en el contexto del script: `color: var(--gray-500); font-size: .85rem; pointer-events: none;`. |
| `151` | `z-index: 2;` | Instrucción de ejecución en el contexto del script: `z-index: 2;`. |
| `152` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `153` | `.form-field {` | Instrucción de ejecución en el contexto del script: `.form-field {`. |
| `154` | `width: 100%; border: 1.5px solid var(--gray-200);` | Instrucción de ejecución en el contexto del script: `width: 100%; border: 1.5px solid var(--gray-200);`. |
| `155` | `border-radius: 10px; padding: .72rem .9rem .72rem 2.5rem;` | Instrucción de ejecución en el contexto del script: `border-radius: 10px; padding: .72rem .9rem .72rem 2.5rem;`. |
| `156` | `font-size: .9rem; color: var(--gray-900);` | Instrucción de ejecución en el contexto del script: `font-size: .9rem; color: var(--gray-900);`. |
| `157` | `font-family: 'Inter', sans-serif;` | Instrucción de ejecución en el contexto del script: `font-family: 'Inter', sans-serif;`. |
| `158` | `background: var(--gray-50);` | Instrucción de ejecución en el contexto del script: `background: var(--gray-50);`. |
| `159` | `transition: border-color .2s, box-shadow .2s, background .2s;` | Instrucción de ejecución en el contexto del script: `transition: border-color .2s, box-shadow .2s, background .2s;`. |
| `160` | `outline: none;` | Instrucción de ejecución en el contexto del script: `outline: none;`. |
| `161` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `162` | `.form-field:focus {` | Instrucción de ejecución en el contexto del script: `.form-field:focus {`. |
| `163` | `border-color: var(--green);` | Instrucción de ejecución en el contexto del script: `border-color: var(--green);`. |
| `164` | `background: #fff;` | Instrucción de ejecución en el contexto del script: `background: #fff;`. |
| `165` | `box-shadow: 0 0 0 3px rgba(57,169,0,.1);` | Instrucción de ejecución en el contexto del script: `box-shadow: 0 0 0 3px rgba(57,169,0,.1);`. |
| `166` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `167` | `.form-field::placeholder { color: #adb5bd; }` | Instrucción de ejecución en el contexto del script: `.form-field::placeholder { color: #adb5bd; }`. |
| `168` | `.btn-toggle-pass {` | Instrucción de ejecución en el contexto del script: `.btn-toggle-pass {`. |
| `169` | `position: absolute; right: .75rem; top: 50%; transform: translateY(-50%);` | Instrucción de ejecución en el contexto del script: `position: absolute; right: .75rem; top: 50%; transform: translateY(-50%);`. |
| `170` | `background: none; border: none; color: var(--gray-500);` | Instrucción de ejecución en el contexto del script: `background: none; border: none; color: var(--gray-500);`. |
| `171` | `cursor: pointer; padding: .2rem; font-size: .9rem;` | Instrucción de ejecución en el contexto del script: `cursor: pointer; padding: .2rem; font-size: .9rem;`. |
| `172` | `transition: color .15s;` | Instrucción de ejecución en el contexto del script: `transition: color .15s;`. |
| `173` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `174` | `.btn-toggle-pass:hover { color: var(--green); }` | Instrucción de ejecución en el contexto del script: `.btn-toggle-pass:hover { color: var(--green); }`. |
| `175` | `.field-with-toggle .form-field { padding-right: 2.5rem; }` | Instrucción de ejecución en el contexto del script: `.field-with-toggle .form-field { padding-right: 2.5rem; }`. |
| `176` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `177` | `.link-forgot {` | Instrucción de ejecución en el contexto del script: `.link-forgot {`. |
| `178` | `font-size: .8rem; color: var(--green);` | Instrucción de ejecución en el contexto del script: `font-size: .8rem; color: var(--green);`. |
| `179` | `background: none; border: none; padding: 0;` | Instrucción de ejecución en el contexto del script: `background: none; border: none; padding: 0;`. |
| `180` | `cursor: pointer; text-decoration: none; font-weight: 500;` | Instrucción de ejecución en el contexto del script: `cursor: pointer; text-decoration: none; font-weight: 500;`. |
| `181` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `182` | `.link-forgot:hover { text-decoration: underline; }` | Instrucción de ejecución en el contexto del script: `.link-forgot:hover { text-decoration: underline; }`. |
| `183` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `184` | `.btn-login {` | Instrucción de ejecución en el contexto del script: `.btn-login {`. |
| `185` | `width: 100%; padding: .8rem;` | Instrucción de ejecución en el contexto del script: `width: 100%; padding: .8rem;`. |
| `186` | `background: var(--green); color: #fff;` | Instrucción de ejecución en el contexto del script: `background: var(--green); color: #fff;`. |
| `187` | `border: none; border-radius: 10px;` | Instrucción de ejecución en el contexto del script: `border: none; border-radius: 10px;`. |
| `188` | `font-size: .95rem; font-weight: 700;` | Instrucción de ejecución en el contexto del script: `font-size: .95rem; font-weight: 700;`. |
| `189` | `cursor: pointer;` | Instrucción de ejecución en el contexto del script: `cursor: pointer;`. |
| `190` | `transition: background .2s, transform .15s, box-shadow .2s;` | Instrucción de ejecución en el contexto del script: `transition: background .2s, transform .15s, box-shadow .2s;`. |
| `191` | `box-shadow: 0 4px 14px rgba(57,169,0,.3);` | Instrucción de ejecución en el contexto del script: `box-shadow: 0 4px 14px rgba(57,169,0,.3);`. |
| `192` | `display: flex; align-items: center; justify-content: center; gap: .5rem;` | Instrucción de ejecución en el contexto del script: `display: flex; align-items: center; justify-content: center; gap: .5rem;`. |
| `193` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `194` | `.btn-login:hover { background: var(--green-dark); transform: translateY(...` | Instrucción de ejecución en el contexto del script: `.btn-login:hover { background: var(--green-dark); transform: translateY(...`. |
| `195` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `196` | `.divider {` | Instrucción de ejecución en el contexto del script: `.divider {`. |
| `197` | `display: flex; align-items: center; gap: .75rem;` | Instrucción de ejecución en el contexto del script: `display: flex; align-items: center; gap: .75rem;`. |
| `198` | `color: var(--gray-500); font-size: .78rem; margin: 1.5rem 0;` | Instrucción de ejecución en el contexto del script: `color: var(--gray-500); font-size: .78rem; margin: 1.5rem 0;`. |
| `199` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `200` | `.divider::before, .divider::after {` | Instrucción de ejecución en el contexto del script: `.divider::before, .divider::after {`. |
| `201` | `content: ''; flex: 1; height: 1px; background: var(--gray-200);` | Instrucción de ejecución en el contexto del script: `content: ''; flex: 1; height: 1px; background: var(--gray-200);`. |
| `202` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `203` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `204` | `.login-footer-text {` | Instrucción de ejecución en el contexto del script: `.login-footer-text {`. |
| `205` | `font-size: .8rem; color: var(--gray-500);` | Instrucción de ejecución en el contexto del script: `font-size: .8rem; color: var(--gray-500);`. |
| `206` | `text-align: center; margin-top: 1.5rem;` | Instrucción de ejecución en el contexto del script: `text-align: center; margin-top: 1.5rem;`. |
| `207` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `208` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `209` | `/* ── MODAL ── */` | Comentario multilínea de documentación o aclaración técnica. |
| `210` | `.modal-content {` | Instrucción de ejecución en el contexto del script: `.modal-content {`. |
| `211` | `border: 1px solid var(--gray-200);` | Instrucción de ejecución en el contexto del script: `border: 1px solid var(--gray-200);`. |
| `212` | `border-radius: 16px;` | Instrucción de ejecución en el contexto del script: `border-radius: 16px;`. |
| `213` | `box-shadow: 0 20px 60px rgba(0,0,0,.12);` | Instrucción de ejecución en el contexto del script: `box-shadow: 0 20px 60px rgba(0,0,0,.12);`. |
| `214` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `215` | `.modal-hdr {` | Instrucción de ejecución en el contexto del script: `.modal-hdr {`. |
| `216` | `border-bottom: 1px solid var(--gray-200);` | Instrucción de ejecución en el contexto del script: `border-bottom: 1px solid var(--gray-200);`. |
| `217` | `padding: 1.25rem 1.5rem;` | Instrucción de ejecución en el contexto del script: `padding: 1.25rem 1.5rem;`. |
| `218` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `219` | `.modal-hdr h6 { font-weight: 700; color: var(--gray-900); margin: 0; }` | Instrucción de ejecución en el contexto del script: `.modal-hdr h6 { font-weight: 700; color: var(--gray-900); margin: 0; }`. |
| `220` | `.modal-footer { border-top: 1px solid var(--gray-200); }` | Instrucción de ejecución en el contexto del script: `.modal-footer { border-top: 1px solid var(--gray-200); }`. |
| `221` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `222` | `/* Inputs del modal */` | Comentario multilínea de documentación o aclaración técnica. |
| `223` | `.modal .form-control {` | Instrucción de ejecución en el contexto del script: `.modal .form-control {`. |
| `224` | `border: 1.5px solid var(--gray-200); border-radius: 9px;` | Instrucción de ejecución en el contexto del script: `border: 1.5px solid var(--gray-200); border-radius: 9px;`. |
| `225` | `font-size: .875rem; padding: .65rem .9rem;` | Instrucción de ejecución en el contexto del script: `font-size: .875rem; padding: .65rem .9rem;`. |
| `226` | `transition: border-color .2s, box-shadow .2s;` | Instrucción de ejecución en el contexto del script: `transition: border-color .2s, box-shadow .2s;`. |
| `227` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `228` | `.modal .form-control:focus {` | Instrucción de ejecución en el contexto del script: `.modal .form-control:focus {`. |
| `229` | `border-color: var(--green); box-shadow: 0 0 0 3px rgba(57,169,0,.1);` | Instrucción de ejecución en el contexto del script: `border-color: var(--green); box-shadow: 0 0 0 3px rgba(57,169,0,.1);`. |
| `230` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `231` | `.modal .input-group-text {` | Instrucción de ejecución en el contexto del script: `.modal .input-group-text {`. |
| `232` | `background: var(--gray-50); border: 1.5px solid var(--gray-200);` | Instrucción de ejecución en el contexto del script: `background: var(--gray-50); border: 1.5px solid var(--gray-200);`. |
| `233` | `border-right: 0; color: var(--gray-500); border-radius: 9px 0 0 9px;` | Instrucción de ejecución en el contexto del script: `border-right: 0; color: var(--gray-500); border-radius: 9px 0 0 9px;`. |
| `234` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `235` | `.modal .form-control { border-left: 0; border-radius: 0 9px 9px 0; }` | Instrucción de ejecución en el contexto del script: `.modal .form-control { border-left: 0; border-radius: 0 9px 9px 0; }`. |
| `236` | `.modal .btn-eye {` | Instrucción de ejecución en el contexto del script: `.modal .btn-eye {`. |
| `237` | `background: var(--gray-50); border: 1.5px solid var(--gray-200);` | Instrucción de ejecución en el contexto del script: `background: var(--gray-50); border: 1.5px solid var(--gray-200);`. |
| `238` | `border-left: 0; color: var(--gray-500); border-radius: 0 9px 9px 0;` | Instrucción de ejecución en el contexto del script: `border-left: 0; color: var(--gray-500); border-radius: 0 9px 9px 0;`. |
| `239` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `240` | `.modal .btn-eye:hover { color: var(--green); }` | Instrucción de ejecución en el contexto del script: `.modal .btn-eye:hover { color: var(--green); }`. |
| `241` | `.req-item { font-size: .78rem; color: #adb5bd; margin-bottom: .2rem; tra...` | Instrucción de ejecución en el contexto del script: `.req-item { font-size: .78rem; color: #adb5bd; margin-bottom: .2rem; tra...`. |
| `242` | `.req-item.ok { color: var(--green); }` | Instrucción de ejecución en el contexto del script: `.req-item.ok { color: var(--green); }`. |
| `243` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `244` | `@media (max-width: 767px) {` | Instrucción de ejecución en el contexto del script: `@media (max-width: 767px) {`. |
| `245` | `.panel-left { display: none !important; }` | Instrucción de ejecución en el contexto del script: `.panel-left { display: none !important; }`. |
| `246` | `.panel-right { padding: 2rem 1.5rem; }` | Instrucción de ejecución en el contexto del script: `.panel-right { padding: 2rem 1.5rem; }`. |
| `247` | `.login-wrapper { align-items: flex-start; }` | Instrucción de ejecución en el contexto del script: `.login-wrapper { align-items: flex-start; }`. |
| `248` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `249` | ``</style>`` | Cierre de bloque de estilos CSS. |
| `250` | `</head>` | Instrucción de ejecución en el contexto del script: `</head>`. |
| `251` | `<body>` | Instrucción de ejecución en el contexto del script: `<body>`. |
| `252` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `253` | `<!-- ── TOPBAR ── -->` | Instrucción de ejecución en el contexto del script: `<!-- ── TOPBAR ── -->`. |
| `254` | `<nav class="topbar">` | Instrucción de ejecución en el contexto del script: `<nav class="topbar">`. |
| `255` | `<div class="container d-flex align-items-center justify-content-between">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="container d-flex align-items-center justify-content-between">`. |
| `256` | `<a href="../../public/index.php" class="topbar-brand">` | Instrucción de ejecución en el contexto del script: `<a href="../../public/index.php" class="topbar-brand">`. |
| `257` | `<div class="brand-icon"><i class="fas fa-broom"></i></div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="brand-icon"><i class="fas fa-broom"></i></div>`. |
| `258` | `GestiLimpieza` | Instrucción de ejecución en el contexto del script: `GestiLimpieza`. |
| `259` | `</a>` | Instrucción de ejecución en el contexto del script: `</a>`. |
| `260` | `<a href="../../public/index.php" class="btn-back">` | Instrucción de ejecución en el contexto del script: `<a href="../../public/index.php" class="btn-back">`. |
| `261` | `<i class="fas fa-arrow-left"></i> Volver al inicio` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-arrow-left"></i> Volver al inicio`. |
| `262` | `</a>` | Instrucción de ejecución en el contexto del script: `</a>`. |
| `263` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `264` | `</nav>` | Instrucción de ejecución en el contexto del script: `</nav>`. |
| `265` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `266` | `<!-- ── LAYOUT ── -->` | Instrucción de ejecución en el contexto del script: `<!-- ── LAYOUT ── -->`. |
| `267` | `<div class="login-wrapper">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="login-wrapper">`. |
| `268` | `<div class="container-fluid p-0 d-flex" style="flex:1;">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="container-fluid p-0 d-flex" style="flex:1;">`. |
| `269` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `270` | `<!-- Panel izquierdo -->` | Instrucción de ejecución en el contexto del script: `<!-- Panel izquierdo -->`. |
| `271` | `<div class="col-md-5 col-lg-5 panel-left d-none d-md-flex flex-column">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="col-md-5 col-lg-5 panel-left d-none d-md-flex flex-column">`. |
| `272` | `<div class="panel-left-inner">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="panel-left-inner">`. |
| `273` | `<div class="pl-badge">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="pl-badge">`. |
| `274` | `<i class="fas fa-rotate fa-sm"></i> Integrado con SICEFA` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-rotate fa-sm"></i> Integrado con SICEFA`. |
| `275` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `276` | `<h2>Gestión de<br>Limpieza de<br>Módulos</h2>` | Instrucción de ejecución en el contexto del script: `<h2>Gestión de<br>Limpieza de<br>Módulos</h2>`. |
| `277` | `<p>Plataforma oficial del SENA para el registro, seguimiento y verificac...` | Instrucción de ejecución en el contexto del script: `<p>Plataforma oficial del SENA para el registro, seguimiento y verificac...`. |
| `278` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `279` | `<div class="pl-feature">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="pl-feature">`. |
| `280` | `<div class="pl-feature-dot"><i class="fas fa-shield-halved"></i></div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="pl-feature-dot"><i class="fas fa-shield-halved"></i></div>`. |
| `281` | `Acceso seguro con credenciales institucionales` | Instrucción de ejecución en el contexto del script: `Acceso seguro con credenciales institucionales`. |
| `282` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `283` | `<div class="pl-feature">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="pl-feature">`. |
| `284` | `<div class="pl-feature-dot"><i class="fas fa-camera"></i></div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="pl-feature-dot"><i class="fas fa-camera"></i></div>`. |
| `285` | `Evidencias fotográficas por módulo y turno` | Instrucción de ejecución en el contexto del script: `Evidencias fotográficas por módulo y turno`. |
| `286` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `287` | `<div class="pl-feature">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="pl-feature">`. |
| `288` | `<div class="pl-feature-dot"><i class="fas fa-bell"></i></div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="pl-feature-dot"><i class="fas fa-bell"></i></div>`. |
| `289` | `Notificaciones de incumplimiento` | Instrucción de ejecución en el contexto del script: `Notificaciones de incumplimiento`. |
| `290` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `291` | `<div class="pl-feature">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="pl-feature">`. |
| `292` | `<div class="pl-feature-dot"><i class="fas fa-people-group"></i></div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="pl-feature-dot"><i class="fas fa-people-group"></i></div>`. |
| `293` | `Rotación automática de grupos semanal` | Instrucción de ejecución en el contexto del script: `Rotación automática de grupos semanal`. |
| `294` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `295` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `296` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `297` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `298` | `<!-- Panel derecho -->` | Instrucción de ejecución en el contexto del script: `<!-- Panel derecho -->`. |
| `299` | `<div class="col-md-7 col-lg-7 panel-right">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="col-md-7 col-lg-7 panel-right">`. |
| `300` | `<div style="max-width: 420px; width: 100%; margin: 0 auto;">` | Contenedor visual estructurado con Bootstrap/CSS: `<div style="max-width: 420px; width: 100%; margin: 0 auto;">`. |
| `301` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `302` | `<!-- Mobile brand -->` | Instrucción de ejecución en el contexto del script: `<!-- Mobile brand -->`. |
| `303` | `<div class="d-md-none text-center mb-4">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="d-md-none text-center mb-4">`. |
| `304` | `<div class="brand-icon mx-auto mb-2" style="width:44px;height:44px;font-...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="brand-icon mx-auto mb-2" style="width:44px;height:44px;font-...`. |
| `305` | `<i class="fas fa-broom"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-broom"></i>`. |
| `306` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `307` | `<span style="font-weight:700;font-size:1rem;">GestiLimpieza</span>` | Instrucción de ejecución en el contexto del script: `<span style="font-weight:700;font-size:1rem;">GestiLimpieza</span>`. |
| `308` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `309` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `310` | `<h4 class="login-title">Iniciar sesión</h4>` | Instrucción de ejecución en el contexto del script: `<h4 class="login-title">Iniciar sesión</h4>`. |
| `311` | `<p class="login-sub">Ingresa las credenciales enviadas a tu correo insti...` | Instrucción de ejecución en el contexto del script: `<p class="login-sub">Ingresa las credenciales enviadas a tu correo insti...`. |
| `312` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `313` | `<form action="../../controllers/AuthController.php" method="POST">` | Formulario interactivo para captura y envío de datos: `<form action="../../controllers/AuthController.php" method="POST">`. |
| `314` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `315` | `<div class="mb-3">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="mb-3">`. |
| `316` | `<label class="form-label">Correo institucional</label>` | Instrucción de ejecución en el contexto del script: `<label class="form-label">Correo institucional</label>`. |
| `317` | `<div class="input-wrap">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="input-wrap">`. |
| `318` | `<i class="fas fa-envelope input-icon"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-envelope input-icon"></i>`. |
| `319` | `<input type="email" name="correo" class="form-field"` | Campo de entrada interactivo para datos del usuario: `<input type="email" name="correo" class="form-field"`. |
| `320` | `placeholder="usuario@sena.edu.co" required autocomplete="username">` | Instrucción de ejecución en el contexto del script: `placeholder="usuario@sena.edu.co" required autocomplete="username">`. |
| `321` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `322` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `323` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `324` | `<div class="mb-2">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="mb-2">`. |
| `325` | `<label class="form-label">Contraseña</label>` | Instrucción de ejecución en el contexto del script: `<label class="form-label">Contraseña</label>`. |
| `326` | `<div class="input-wrap field-with-toggle">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="input-wrap field-with-toggle">`. |
| `327` | `<i class="fas fa-lock input-icon"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-lock input-icon"></i>`. |
| `328` | `<input type="password" name="password" id="passLogin"` | Campo de entrada interactivo para datos del usuario: `<input type="password" name="password" id="passLogin"`. |
| `329` | `class="form-field" placeholder="••••••••" required autocomplete="current...` | Instrucción de ejecución en el contexto del script: `class="form-field" placeholder="••••••••" required autocomplete="current...`. |
| `330` | `<button type="button" class="btn-toggle-pass"` | Botón de acción interactivo para el usuario: `<button type="button" class="btn-toggle-pass"`. |
| `331` | `onclick="togglePass('passLogin','eyeLogin')">` | Instrucción de ejecución en el contexto del script: `onclick="togglePass('passLogin','eyeLogin')">`. |
| `332` | `<i class="fas fa-eye" id="eyeLogin"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-eye" id="eyeLogin"></i>`. |
| `333` | `</button>` | Instrucción de ejecución en el contexto del script: `</button>`. |
| `334` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `335` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `336` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `337` | `<div class="text-end mb-4">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="text-end mb-4">`. |
| `338` | `<button type="button" class="link-forgot"` | Botón de acción interactivo para el usuario: `<button type="button" class="link-forgot"`. |
| `339` | `data-bs-toggle="modal" data-bs-target="#modalRecuperar">` | Instrucción de ejecución en el contexto del script: `data-bs-toggle="modal" data-bs-target="#modalRecuperar">`. |
| `340` | `¿Olvidaste tu contraseña?` | Instrucción de ejecución en el contexto del script: `¿Olvidaste tu contraseña?`. |
| `341` | `</button>` | Instrucción de ejecución en el contexto del script: `</button>`. |
| `342` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `343` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `344` | `<button type="submit" class="btn-login">` | Botón de acción interactivo para el usuario: `<button type="submit" class="btn-login">`. |
| `345` | `<i class="fas fa-arrow-right-to-bracket"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-arrow-right-to-bracket"></i>`. |
| `346` | `Ingresar al sistema` | Instrucción de ejecución en el contexto del script: `Ingresar al sistema`. |
| `347` | `</button>` | Instrucción de ejecución en el contexto del script: `</button>`. |
| `348` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `349` | ``</form>`` | Cierre de formulario interactivo. |
| `350` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `351` | `<div class="login-footer-text">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="login-footer-text">`. |
| `352` | `¿No recibiste tus credenciales?` | Instrucción de ejecución en el contexto del script: `¿No recibiste tus credenciales?`. |
| `353` | `<button type="button" class="link-forgot fw-semibold"` | Botón de acción interactivo para el usuario: `<button type="button" class="link-forgot fw-semibold"`. |
| `354` | `data-bs-toggle="modal" data-bs-target="#modalRecuperar">` | Instrucción de ejecución en el contexto del script: `data-bs-toggle="modal" data-bs-target="#modalRecuperar">`. |
| `355` | `Contacta al administrador` | Instrucción de ejecución en el contexto del script: `Contacta al administrador`. |
| `356` | `</button>` | Instrucción de ejecución en el contexto del script: `</button>`. |
| `357` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `358` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `359` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `360` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `361` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `362` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `363` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `364` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `365` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `366` | `<!-- ══ Modal Recuperar ════════════════════════════════════════════════...` | Instrucción de ejecución en el contexto del script: `<!-- ══ Modal Recuperar ════════════════════════════════════════════════...`. |
| `367` | `<div class="modal fade" id="modalRecuperar" tabindex="-1" aria-hidden="t...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="modal fade" id="modalRecuperar" tabindex="-1" aria-hidden="t...`. |
| `368` | `<div class="modal-dialog modal-dialog-centered">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="modal-dialog modal-dialog-centered">`. |
| `369` | `<div class="modal-content">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="modal-content">`. |
| `370` | `<div class="modal-hdr d-flex align-items-center justify-content-between">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="modal-hdr d-flex align-items-center justify-content-between">`. |
| `371` | `<div class="d-flex align-items-center gap-2">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="d-flex align-items-center gap-2">`. |
| `372` | `<div style="width:32px;height:32px;background:var(--green-soft);color:va...` | Contenedor visual estructurado con Bootstrap/CSS: `<div style="width:32px;height:32px;background:var(--green-soft);color:va...`. |
| `373` | `<i class="fas fa-key fa-sm"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-key fa-sm"></i>`. |
| `374` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `375` | `<h6>Restablecer Contraseña</h6>` | Instrucción de ejecución en el contexto del script: `<h6>Restablecer Contraseña</h6>`. |
| `376` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `377` | `<button type="button" class="btn-close" data-bs-dismiss="modal"></button>` | Botón de acción interactivo para el usuario: `<button type="button" class="btn-close" data-bs-dismiss="modal"></button>`. |
| `378` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `379` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `380` | `<form action="../../controllers/AuthController.php?accion=recuperar" met...` | Formulario interactivo para captura y envío de datos: `<form action="../../controllers/AuthController.php?accion=recuperar" met...`. |
| `381` | `<div class="modal-body px-4 py-4">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="modal-body px-4 py-4">`. |
| `382` | `<p class="text-muted small mb-4">` | Instrucción de ejecución en el contexto del script: `<p class="text-muted small mb-4">`. |
| `383` | `Ingresa tu correo institucional y crea una nueva contraseña segura.` | Instrucción de ejecución en el contexto del script: `Ingresa tu correo institucional y crea una nueva contraseña segura.`. |
| `384` | `</p>` | Instrucción de ejecución en el contexto del script: `</p>`. |
| `385` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `386` | `<div class="mb-4">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="mb-4">`. |
| `387` | `<label class="form-label fw-semibold small">Correo Institucional</label>` | Instrucción de ejecución en el contexto del script: `<label class="form-label fw-semibold small">Correo Institucional</label>`. |
| `388` | `<div class="input-group">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="input-group">`. |
| `389` | `<span class="input-group-text"><i class="fas fa-envelope"></i></span>` | Instrucción de ejecución en el contexto del script: `<span class="input-group-text"><i class="fas fa-envelope"></i></span>`. |
| `390` | `<input type="email" name="correo" class="form-control"` | Campo de entrada interactivo para datos del usuario: `<input type="email" name="correo" class="form-control"`. |
| `391` | `placeholder="usuario@sena.edu.co" required>` | Instrucción de ejecución en el contexto del script: `placeholder="usuario@sena.edu.co" required>`. |
| `392` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `393` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `394` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `395` | `<hr class="my-3">` | Instrucción de ejecución en el contexto del script: `<hr class="my-3">`. |
| `396` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `397` | `<div class="mb-3">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="mb-3">`. |
| `398` | `<label class="form-label fw-semibold small">Nueva Contraseña</label>` | Instrucción de ejecución en el contexto del script: `<label class="form-label fw-semibold small">Nueva Contraseña</label>`. |
| `399` | `<div class="input-group mb-2">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="input-group mb-2">`. |
| `400` | `<span class="input-group-text"><i class="fas fa-lock"></i></span>` | Instrucción de ejecución en el contexto del script: `<span class="input-group-text"><i class="fas fa-lock"></i></span>`. |
| `401` | `<input type="password" name="password_nueva" id="passNueva"` | Campo de entrada interactivo para datos del usuario: `<input type="password" name="password_nueva" id="passNueva"`. |
| `402` | `class="form-control" placeholder="Mín. 8 caracteres"` | Instrucción de ejecución en el contexto del script: `class="form-control" placeholder="Mín. 8 caracteres"`. |
| `403` | `required oninput="checkStrength(this.value)">` | Instrucción de ejecución en el contexto del script: `required oninput="checkStrength(this.value)">`. |
| `404` | `<button type="button" class="btn btn-eye"` | Botón de acción interactivo para el usuario: `<button type="button" class="btn btn-eye"`. |
| `405` | `onclick="togglePass('passNueva','eyeNueva')">` | Instrucción de ejecución en el contexto del script: `onclick="togglePass('passNueva','eyeNueva')">`. |
| `406` | `<i class="fas fa-eye" id="eyeNueva"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-eye" id="eyeNueva"></i>`. |
| `407` | `</button>` | Instrucción de ejecución en el contexto del script: `</button>`. |
| `408` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `409` | `<div class="progress mb-1" style="height:4px;">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="progress mb-1" style="height:4px;">`. |
| `410` | `<div id="strengthBar" class="progress-bar" style="width:0%;transition:al...` | Contenedor visual estructurado con Bootstrap/CSS: `<div id="strengthBar" class="progress-bar" style="width:0%;transition:al...`. |
| `411` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `412` | `<div id="strengthText" style="font-size:.74rem;min-height:1rem;color:var...` | Contenedor visual estructurado con Bootstrap/CSS: `<div id="strengthText" style="font-size:.74rem;min-height:1rem;color:var...`. |
| `413` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `414` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `415` | `<div class="mb-4 p-3 rounded-3" id="reqBox"` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="mb-4 p-3 rounded-3" id="reqBox"`. |
| `416` | `style="display:none;background:var(--gray-50);border:1px solid var(--gra...` | Instrucción de ejecución en el contexto del script: `style="display:none;background:var(--gray-50);border:1px solid var(--gra...`. |
| `417` | `<div id="req-len"   class="req-item"><i class="fas fa-circle me-1" style...` | Contenedor visual estructurado con Bootstrap/CSS: `<div id="req-len"   class="req-item"><i class="fas fa-circle me-1" style...`. |
| `418` | `<div id="req-upper" class="req-item"><i class="fas fa-circle me-1" style...` | Contenedor visual estructurado con Bootstrap/CSS: `<div id="req-upper" class="req-item"><i class="fas fa-circle me-1" style...`. |
| `419` | `<div id="req-num"   class="req-item"><i class="fas fa-circle me-1" style...` | Contenedor visual estructurado con Bootstrap/CSS: `<div id="req-num"   class="req-item"><i class="fas fa-circle me-1" style...`. |
| `420` | `<div id="req-spec"  class="req-item"><i class="fas fa-circle me-1" style...` | Contenedor visual estructurado con Bootstrap/CSS: `<div id="req-spec"  class="req-item"><i class="fas fa-circle me-1" style...`. |
| `421` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `422` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `423` | `<div class="mb-1">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="mb-1">`. |
| `424` | `<label class="form-label fw-semibold small">Confirmar Contraseña</label>` | Instrucción de ejecución en el contexto del script: `<label class="form-label fw-semibold small">Confirmar Contraseña</label>`. |
| `425` | `<div class="input-group">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="input-group">`. |
| `426` | `<span class="input-group-text"><i class="fas fa-lock"></i></span>` | Instrucción de ejecución en el contexto del script: `<span class="input-group-text"><i class="fas fa-lock"></i></span>`. |
| `427` | `<input type="password" name="password_confirm" id="passConfirm"` | Campo de entrada interactivo para datos del usuario: `<input type="password" name="password_confirm" id="passConfirm"`. |
| `428` | `class="form-control" placeholder="Repite la contraseña" required>` | Instrucción de ejecución en el contexto del script: `class="form-control" placeholder="Repite la contraseña" required>`. |
| `429` | `<button type="button" class="btn btn-eye"` | Botón de acción interactivo para el usuario: `<button type="button" class="btn btn-eye"`. |
| `430` | `onclick="togglePass('passConfirm','eyeConfirm')">` | Instrucción de ejecución en el contexto del script: `onclick="togglePass('passConfirm','eyeConfirm')">`. |
| `431` | `<i class="fas fa-eye" id="eyeConfirm"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-eye" id="eyeConfirm"></i>`. |
| `432` | `</button>` | Instrucción de ejecución en el contexto del script: `</button>`. |
| `433` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `434` | `<div id="passError" class="text-danger d-none mt-2" style="font-size:.8r...` | Contenedor visual estructurado con Bootstrap/CSS: `<div id="passError" class="text-danger d-none mt-2" style="font-size:.8r...`. |
| `435` | `<i class="fas fa-circle-exclamation me-1"></i> Las contraseñas no coinci...` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-circle-exclamation me-1"></i> Las contraseñas no coinci...`. |
| `436` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `437` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `438` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `439` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `440` | `<div class="modal-footer px-4 py-3">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="modal-footer px-4 py-3">`. |
| `441` | `<button type="button" class="btn btn-sm btn-outline-secondary" data-bs-d...` | Botón de acción interactivo para el usuario: `<button type="button" class="btn btn-sm btn-outline-secondary" data-bs-d...`. |
| `442` | `<button type="submit" class="btn btn-sm fw-semibold px-4"` | Botón de acción interactivo para el usuario: `<button type="submit" class="btn btn-sm fw-semibold px-4"`. |
| `443` | `style="background:var(--green);border:none;color:#fff;border-radius:8px;">` | Instrucción de ejecución en el contexto del script: `style="background:var(--green);border:none;color:#fff;border-radius:8px;">`. |
| `444` | `<i class="fas fa-rotate-right me-1"></i> Restablecer` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-rotate-right me-1"></i> Restablecer`. |
| `445` | `</button>` | Instrucción de ejecución en el contexto del script: `</button>`. |
| `446` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `447` | ``</form>`` | Cierre de formulario interactivo. |
| `448` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `449` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `450` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `451` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `452` | `<?php if ($alert): ?>` | Instrucción de ejecución en el contexto del script: `<?php if ($alert): ?>`. |
| `453` | ``<script>`` | Bloque o etiqueta de vinculación para scripts JavaScript del lado del cliente. |
| `454` | `document.addEventListener('DOMContentLoaded', function () {` | Registra un escucha de eventos del DOM para interactividad en tiempo real: `document.addEventListener('DOMContentLoaded', function () {`. |
| `455` | `Swal.fire({` | Despliega una alerta modal estética e interactiva con SweetAlert2. |
| `456` | `icon:  '<?= htmlspecialchars($alert['icon'])  ?>',` | Instrucción de ejecución en el contexto del script: `icon:  '<?= htmlspecialchars($alert['icon'])  ?>',`. |
| `457` | `title: '<?= htmlspecialchars($alert['title']) ?>',` | Instrucción de ejecución en el contexto del script: `title: '<?= htmlspecialchars($alert['title']) ?>',`. |
| `458` | `text:  '<?= htmlspecialchars($alert['text'])  ?>',` | Instrucción de ejecución en el contexto del script: `text:  '<?= htmlspecialchars($alert['text'])  ?>',`. |
| `459` | `confirmButtonText:  'Aceptar',` | Instrucción de ejecución en el contexto del script: `confirmButtonText:  'Aceptar',`. |
| `460` | `confirmButtonColor: '#39a900'` | Instrucción de ejecución en el contexto del script: `confirmButtonColor: '#39a900'`. |
| `461` | `});` | Instrucción de ejecución en el contexto del script: `});`. |
| `462` | `});` | Instrucción de ejecución en el contexto del script: `});`. |
| `463` | ``</script>`` | Cierre de bloque de script JavaScript. |
| `464` | `<?php endif; ?>` | Cierre de estructura condicional embebida en la plantilla HTML. |
| `465` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `466` | ``<script>`` | Bloque o etiqueta de vinculación para scripts JavaScript del lado del cliente. |
| `467` | ``<script>`` | Bloque o etiqueta de vinculación para scripts JavaScript del lado del cliente. |
| `468` | `<?php if ($abrirPanel): ?>` | Instrucción de ejecución en el contexto del script: `<?php if ($abrirPanel): ?>`. |
| `469` | `document.addEventListener('DOMContentLoaded', function () {` | Registra un escucha de eventos del DOM para interactividad en tiempo real: `document.addEventListener('DOMContentLoaded', function () {`. |
| `470` | `new bootstrap.Modal(document.getElementById('modalRecuperar')).show();` | Instrucción de ejecución en el contexto del script: `new bootstrap.Modal(document.getElementById('modalRecuperar')).show();`. |
| `471` | `});` | Instrucción de ejecución en el contexto del script: `});`. |
| `472` | `<?php endif; ?>` | Cierre de estructura condicional embebida en la plantilla HTML. |
| `473` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `474` | `function togglePass(inputId, iconId) {` | Instrucción de ejecución en el contexto del script: `function togglePass(inputId, iconId) {`. |
| `475` | `const inp = document.getElementById(inputId);` | Instrucción de ejecución en el contexto del script: `const inp = document.getElementById(inputId);`. |
| `476` | `const ico = document.getElementById(iconId);` | Instrucción de ejecución en el contexto del script: `const ico = document.getElementById(iconId);`. |
| `477` | `if (!inp \|\| !ico) return;` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (!inp \|\| !ico) return;`. |
| `478` | `inp.type = inp.type === 'password' ? 'text' : 'password';` | Instrucción de ejecución en el contexto del script: `inp.type = inp.type === 'password' ? 'text' : 'password';`. |
| `479` | `ico.classList.toggle('fa-eye');` | Instrucción de ejecución en el contexto del script: `ico.classList.toggle('fa-eye');`. |
| `480` | `ico.classList.toggle('fa-eye-slash');` | Instrucción de ejecución en el contexto del script: `ico.classList.toggle('fa-eye-slash');`. |
| `481` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `482` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `483` | `function checkStrength(val) {` | Instrucción de ejecución en el contexto del script: `function checkStrength(val) {`. |
| `484` | `const bar    = document.getElementById('strengthBar');` | Instrucción de ejecución en el contexto del script: `const bar    = document.getElementById('strengthBar');`. |
| `485` | `const text   = document.getElementById('strengthText');` | Instrucción de ejecución en el contexto del script: `const text   = document.getElementById('strengthText');`. |
| `486` | `const box    = document.getElementById('reqBox');` | Instrucción de ejecución en el contexto del script: `const box    = document.getElementById('reqBox');`. |
| `487` | `const checks = {` | Instrucción de ejecución en el contexto del script: `const checks = {`. |
| `488` | `len:   val.length >= 8,` | Instrucción de ejecución en el contexto del script: `len:   val.length >= 8,`. |
| `489` | `upper: /[A-Z]/.test(val),` | Instrucción de ejecución en el contexto del script: `upper: /[A-Z]/.test(val),`. |
| `490` | `num:   /[0-9]/.test(val),` | Instrucción de ejecución en el contexto del script: `num:   /[0-9]/.test(val),`. |
| `491` | `spec:  /[\W_]/.test(val),` | Instrucción de ejecución en el contexto del script: `spec:  /[\W_]/.test(val),`. |
| `492` | `};` | Instrucción de ejecución en el contexto del script: `};`. |
| `493` | `box.style.display = val.length ? 'block' : 'none';` | Instrucción de ejecución en el contexto del script: `box.style.display = val.length ? 'block' : 'none';`. |
| `494` | `for (const [k, v] of Object.entries(checks)) {` | Bucle iterativo `for` para repeticiones controladas: `for (const [k, v] of Object.entries(checks)) {`. |
| `495` | `const el = document.getElementById('req-' + k);` | Instrucción de ejecución en el contexto del script: `const el = document.getElementById('req-' + k);`. |
| `496` | `if (el) el.classList.toggle('ok', v);` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (el) el.classList.toggle('ok', v);`. |
| `497` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `498` | `const score  = Object.values(checks).filter(Boolean).length;` | Instrucción de ejecución en el contexto del script: `const score  = Object.values(checks).filter(Boolean).length;`. |
| `499` | `const levels = [` | Instrucción de ejecución en el contexto del script: `const levels = [`. |
| `500` | `{ pct:'20%', color:'#ef4444', label:'Muy débil'  },` | Instrucción de ejecución en el contexto del script: `{ pct:'20%', color:'#ef4444', label:'Muy débil'  },`. |
| `501` | `{ pct:'40%', color:'#f97316', label:'Débil'      },` | Instrucción de ejecución en el contexto del script: `{ pct:'40%', color:'#f97316', label:'Débil'      },`. |
| `502` | `{ pct:'60%', color:'#eab308', label:'Regular'    },` | Instrucción de ejecución en el contexto del script: `{ pct:'60%', color:'#eab308', label:'Regular'    },`. |
| `503` | `{ pct:'80%', color:'#22c55e', label:'Fuerte'     },` | Instrucción de ejecución en el contexto del script: `{ pct:'80%', color:'#22c55e', label:'Fuerte'     },`. |
| `504` | `{ pct:'100%',color:'#16a34a', label:'Muy fuerte' },` | Instrucción de ejecución en el contexto del script: `{ pct:'100%',color:'#16a34a', label:'Muy fuerte' },`. |
| `505` | ``];`` | Cierre de estructura de arreglo o invocación de función. |
| `506` | `const lvl = levels[Math.max(0, score - 1)];` | Instrucción de ejecución en el contexto del script: `const lvl = levels[Math.max(0, score - 1)];`. |
| `507` | `bar.style.width           = val.length ? lvl.pct   : '0%';` | Instrucción de ejecución en el contexto del script: `bar.style.width           = val.length ? lvl.pct   : '0%';`. |
| `508` | `bar.style.backgroundColor = val.length ? lvl.color : '';` | Instrucción de ejecución en el contexto del script: `bar.style.backgroundColor = val.length ? lvl.color : '';`. |
| `509` | `text.textContent          = val.length ? lvl.label : '';` | Instrucción de ejecución en el contexto del script: `text.textContent          = val.length ? lvl.label : '';`. |
| `510` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `511` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `512` | `document.getElementById('formRecuperar').addEventListener('submit', func...` | Registra un escucha de eventos del DOM para interactividad en tiempo real: `document.getElementById('formRecuperar').addEventListener('submit', func...`. |
| `513` | `const p1  = document.getElementById('passNueva').value;` | Instrucción de ejecución en el contexto del script: `const p1  = document.getElementById('passNueva').value;`. |
| `514` | `const p2  = document.getElementById('passConfirm').value;` | Instrucción de ejecución en el contexto del script: `const p2  = document.getElementById('passConfirm').value;`. |
| `515` | `const err = document.getElementById('passError');` | Instrucción de ejecución en el contexto del script: `const err = document.getElementById('passError');`. |
| `516` | `if (p1 !== p2) { e.preventDefault(); err.classList.remove('d-none'); }` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (p1 !== p2) { e.preventDefault(); err.classList.remove('d-none'); }`. |
| `517` | `else err.classList.add('d-none');` | Instrucción de ejecución en el contexto del script: `else err.classList.add('d-none');`. |
| `518` | `});` | Instrucción de ejecución en el contexto del script: `});`. |
| `519` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `520` | `document.getElementById('passConfirm').addEventListener('input', functio...` | Registra un escucha de eventos del DOM para interactividad en tiempo real: `document.getElementById('passConfirm').addEventListener('input', functio...`. |
| `521` | `const p1 = document.getElementById('passNueva').value;` | Instrucción de ejecución en el contexto del script: `const p1 = document.getElementById('passNueva').value;`. |
| `522` | `document.getElementById('passError').classList.toggle('d-none', this.val...` | Instrucción de ejecución en el contexto del script: `document.getElementById('passError').classList.toggle('d-none', this.val...`. |
| `523` | `});` | Instrucción de ejecución en el contexto del script: `});`. |
| `524` | ``</script>`` | Cierre de bloque de script JavaScript. |
| `525` | `</body>` | Instrucción de ejecución en el contexto del script: `</body>`. |
| `526` | `</html>` | Instrucción de ejecución en el contexto del script: `</html>`. |

---

## 3. Resumen y Flujo de Interacción

El archivo `login.php` cumple un rol indispensable en `views/usuarios/login.php`. 
Vista interactiva del formulario de inicio de sesión con validaciones visuales, mensajes flash de error y recuperación. Garantiza la robustez, el orden y la estabilidad de la arquitectura del proyecto `systemLimpieza`.

---

Generado automáticamente para el repositorio [johanrepizo/LimpiezaDeModulos](https://github.com/johanrepizo/LimpiezaDeModulos).
