# Documentación Línea por Línea: `views/usuarios/login.php`

## 1. Ficha Técnica del Archivo

- **Archivo:** `login.php`
- **Ruta en el proyecto:** `views/usuarios/login.php`
- **Cantidad total de líneas:** `514`
- **Tipo de archivo:** `PHP`
- **Propósito general:** Vista interactiva del formulario de inicio de sesión con validaciones visuales, mensajes flash de error y recuperación.

---

## 2. Explicación Detallada Línea por Línea

A continuación se presenta cada línea de código numerada de forma consecutiva, acompañada de su fragmento exacto y la explicación exhaustiva de su funcionamiento y responsabilidad en el sistema:

| Línea | Código Fuente | Explicación Detallada |
|---|---|---|
| `1` | `<?php` | Apertura obligatoria de la etiqueta PHP para ejecución del código del lado del servidor. |
| `2` | `session_start();` | Inicia o reanuda la sesión PHP del usuario si no se encontraba activa previamente. |
| `3` | `$alert      = $_SESSION['alert'] ?? null;` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección: `$alert      = $_SESSION['alert'] ?? null;`. |
| `4` | `unset($_SESSION['alert']);` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección: `unset($_SESSION['alert']);`. |
| `5` | `$abrirPanel = ($_GET['panel'] ?? '') === 'recuperar';` | Captura y sanitiza parámetros enviados por el cliente mediante petición HTTP: `$abrirPanel = ($_GET['panel'] ?? '') === 'recuperar';`. |
| `6` | `?>` | Cierre de la etiqueta PHP para alternar a salida HTML o fin del archivo. |
| `7` | `<!DOCTYPE html>` | Declaración estándar del tipo de documento HTML5. |
| `8` | `<html lang="es">` | Etiqueta raíz que delimita el documento HTML. |
| `9` | `<head>` | Cabecera del documento web para inclusión de metadatos, fuentes y hojas de estilo. |
| `10` | `    <meta charset="UTF-8">` | Metadato de configuración de la página (charset, viewport, etc.): `<meta charset="UTF-8">`. |
| `11` | `    <meta name="viewport" content="width=device-width, initial-scale=1.0">` | Metadato de configuración de la página (charset, viewport, etc.): `<meta name="viewport" content="width=device-width, initial-scale=1.0">`. |
| `12` | `    <title>Iniciar Sesión – GestiLimpieza SENA</title>` | Título de la pestaña de navegación de la página web: `<title>Iniciar Sesión – GestiLimpieza SENA</title>`. |
| `13` | `    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/boots...` | Enlace externo a recursos de estilo CSS o fuentes web: `<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">`. |
| `14` | `    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fon...` | Enlace externo a recursos de estilo CSS o fuentes web: `<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">`. |
| `15` | `    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400...` | Enlace externo a recursos de estilo CSS o fuentes web: `<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">`. |
| `16` | `    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>` | Bloque o etiqueta de vinculación para scripts JavaScript del lado del cliente. |
| `17` | `    <style>` | Instrucción de ejecución en el contexto del script: `<style>`. |
| `18` | `        :root {` | Instrucción de ejecución en el contexto del script: `:root {`. |
| `19` | `            --green:       #39a900;` | Instrucción de ejecución en el contexto del script: `--green:       #39a900;`. |
| `20` | `            --green-dark:  #2d8400;` | Instrucción de ejecución en el contexto del script: `--green-dark:  #2d8400;`. |
| `21` | `            --green-soft:  #f0faf0;` | Instrucción de ejecución en el contexto del script: `--green-soft:  #f0faf0;`. |
| `22` | `            --gray-50:     #f8fafc;` | Instrucción de ejecución en el contexto del script: `--gray-50:     #f8fafc;`. |
| `23` | `            --gray-100:    #f1f5f9;` | Instrucción de ejecución en el contexto del script: `--gray-100:    #f1f5f9;`. |
| `24` | `            --gray-200:    #e2e8f0;` | Instrucción de ejecución en el contexto del script: `--gray-200:    #e2e8f0;`. |
| `25` | `            --gray-500:    #64748b;` | Instrucción de ejecución en el contexto del script: `--gray-500:    #64748b;`. |
| `26` | `            --gray-700:    #334155;` | Instrucción de ejecución en el contexto del script: `--gray-700:    #334155;`. |
| `27` | `            --gray-900:    #0f172a;` | Instrucción de ejecución en el contexto del script: `--gray-900:    #0f172a;`. |
| `28` | `        }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `29` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `30` | `        * { box-sizing: border-box; }` | Comentario de bloque o anotación informativa dentro del código. |
| `31` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `32` | `        body {` | Instrucción de ejecución en el contexto del script: `body {`. |
| `33` | `            font-family: 'Inter', sans-serif;` | Instrucción de ejecución en el contexto del script: `font-family: 'Inter', sans-serif;`. |
| `34` | `            background: var(--gray-50);` | Instrucción de ejecución en el contexto del script: `background: var(--gray-50);`. |
| `35` | `            min-height: 100vh;` | Instrucción de ejecución en el contexto del script: `min-height: 100vh;`. |
| `36` | `            display: flex;` | Instrucción de ejecución en el contexto del script: `display: flex;`. |
| `37` | `            flex-direction: column;` | Instrucción de ejecución en el contexto del script: `flex-direction: column;`. |
| `38` | `            margin: 0;` | Instrucción de ejecución en el contexto del script: `margin: 0;`. |
| `39` | `        }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `40` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `41` | `        /* ── TOPBAR ── */` | Comentario de bloque o anotación informativa dentro del código. |
| `42` | `        .topbar {` | Instrucción de ejecución en el contexto del script: `.topbar {`. |
| `43` | `            background: #fff;` | Instrucción de ejecución en el contexto del script: `background: #fff;`. |
| `44` | `            border-bottom: 1px solid var(--gray-200);` | Instrucción de ejecución en el contexto del script: `border-bottom: 1px solid var(--gray-200);`. |
| `45` | `            padding: .75rem 0;` | Instrucción de ejecución en el contexto del script: `padding: .75rem 0;`. |
| `46` | `        }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `47` | `        .topbar-brand {` | Instrucción de ejecución en el contexto del script: `.topbar-brand {`. |
| `48` | `            display: flex; align-items: center; gap: .55rem;` | Instrucción de ejecución en el contexto del script: `display: flex; align-items: center; gap: .55rem;`. |
| `49` | `            font-weight: 700; font-size: 1rem; color: var(--gray-900);` | Instrucción de ejecución en el contexto del script: `font-weight: 700; font-size: 1rem; color: var(--gray-900);`. |
| `50` | `            text-decoration: none;` | Instrucción de ejecución en el contexto del script: `text-decoration: none;`. |
| `51` | `        }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `52` | `        .brand-icon {` | Instrucción de ejecución en el contexto del script: `.brand-icon {`. |
| `53` | `            width: 32px; height: 32px; border-radius: 8px;` | Instrucción de ejecución en el contexto del script: `width: 32px; height: 32px; border-radius: 8px;`. |
| `54` | `            background: var(--green); color: #fff;` | Instrucción de ejecución en el contexto del script: `background: var(--green); color: #fff;`. |
| `55` | `            display: flex; align-items: center; justify-content: center;` | Instrucción de ejecución en el contexto del script: `display: flex; align-items: center; justify-content: center;`. |
| `56` | `            font-size: .82rem;` | Instrucción de ejecución en el contexto del script: `font-size: .82rem;`. |
| `57` | `        }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `58` | `        .btn-back {` | Instrucción de ejecución en el contexto del script: `.btn-back {`. |
| `59` | `            font-size: .85rem; color: var(--gray-500);` | Instrucción de ejecución en el contexto del script: `font-size: .85rem; color: var(--gray-500);`. |
| `60` | `            text-decoration: none; font-weight: 500;` | Instrucción de ejecución en el contexto del script: `text-decoration: none; font-weight: 500;`. |
| `61` | `            display: flex; align-items: center; gap: .35rem;` | Instrucción de ejecución en el contexto del script: `display: flex; align-items: center; gap: .35rem;`. |
| `62` | `            transition: color .15s;` | Instrucción de ejecución en el contexto del script: `transition: color .15s;`. |
| `63` | `        }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `64` | `        .btn-back:hover { color: var(--green); }` | Instrucción de ejecución en el contexto del script: `.btn-back:hover { color: var(--green); }`. |
| `65` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `66` | `        /* ── LAYOUT ── */` | Comentario de bloque o anotación informativa dentro del código. |
| `67` | `        .login-wrapper {` | Instrucción de ejecución en el contexto del script: `.login-wrapper {`. |
| `68` | `            flex: 1;` | Instrucción de ejecución en el contexto del script: `flex: 1;`. |
| `69` | `            display: flex;` | Instrucción de ejecución en el contexto del script: `display: flex;`. |
| `70` | `            align-items: stretch;` | Instrucción de ejecución en el contexto del script: `align-items: stretch;`. |
| `71` | `        }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `72` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `73` | `        /* ── PANEL IZQUIERDO ── */` | Comentario de bloque o anotación informativa dentro del código. |
| `74` | `        .panel-left {` | Instrucción de ejecución en el contexto del script: `.panel-left {`. |
| `75` | `            background: linear-gradient(160deg, #0a1a00 0%, #1b4200 60%, #0...` | Instrucción de ejecución en el contexto del script: `background: linear-gradient(160deg, #0a1a00 0%, #1b4200 60%, #0d2800 100%);`. |
| `76` | `            display: flex; flex-direction: column; justify-content: center;` | Instrucción de ejecución en el contexto del script: `display: flex; flex-direction: column; justify-content: center;`. |
| `77` | `            padding: 3.5rem;` | Instrucción de ejecución en el contexto del script: `padding: 3.5rem;`. |
| `78` | `            position: relative; overflow: hidden;` | Instrucción de ejecución en el contexto del script: `position: relative; overflow: hidden;`. |
| `79` | `        }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `80` | `        .panel-left::before {` | Instrucción de ejecución en el contexto del script: `.panel-left::before {`. |
| `81` | `            content: '';` | Instrucción de ejecución en el contexto del script: `content: '';`. |
| `82` | `            position: absolute; inset: 0; opacity: .4;` | Instrucción de ejecución en el contexto del script: `position: absolute; inset: 0; opacity: .4;`. |
| `83` | `            background-image: radial-gradient(circle at 30% 70%, rgba(57,16...` | Instrucción de ejecución en el contexto del script: `background-image: radial-gradient(circle at 30% 70%, rgba(57,169,0,.25) 0%, transparent 60%),`. |
| `84` | `                              radial-gradient(circle at 80% 20%, rgba(57,16...` | Instrucción de ejecución en el contexto del script: `radial-gradient(circle at 80% 20%, rgba(57,169,0,.15) 0%, transparent 50%);`. |
| `85` | `        }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `86` | `        .panel-left-inner { position: relative; z-index: 1; }` | Instrucción de ejecución en el contexto del script: `.panel-left-inner { position: relative; z-index: 1; }`. |
| `87` | `        .pl-badge {` | Instrucción de ejecución en el contexto del script: `.pl-badge {`. |
| `88` | `            display: inline-flex; align-items: center; gap: .5rem;` | Instrucción de ejecución en el contexto del script: `display: inline-flex; align-items: center; gap: .5rem;`. |
| `89` | `            background: rgba(57,169,0,.15); color: #7ddd5a;` | Instrucción de ejecución en el contexto del script: `background: rgba(57,169,0,.15); color: #7ddd5a;`. |
| `90` | `            border: 1px solid rgba(57,169,0,.25); border-radius: 20px;` | Instrucción de ejecución en el contexto del script: `border: 1px solid rgba(57,169,0,.25); border-radius: 20px;`. |
| `91` | `            padding: .3rem .85rem; font-size: .78rem; font-weight: 600;` | Instrucción de ejecución en el contexto del script: `padding: .3rem .85rem; font-size: .78rem; font-weight: 600;`. |
| `92` | `            margin-bottom: 2rem;` | Instrucción de ejecución en el contexto del script: `margin-bottom: 2rem;`. |
| `93` | `        }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `94` | `        .panel-left h2 {` | Instrucción de ejecución en el contexto del script: `.panel-left h2 {`. |
| `95` | `            color: #fff; font-size: 2rem; font-weight: 800;` | Instrucción de ejecución en el contexto del script: `color: #fff; font-size: 2rem; font-weight: 800;`. |
| `96` | `            line-height: 1.2; margin-bottom: 1rem;` | Instrucción de ejecución en el contexto del script: `line-height: 1.2; margin-bottom: 1rem;`. |
| `97` | `        }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `98` | `        .panel-left p {` | Instrucción de ejecución en el contexto del script: `.panel-left p {`. |
| `99` | `            color: rgba(255,255,255,.6); font-size: .9rem; line-height: 1.7;` | Instrucción de ejecución en el contexto del script: `color: rgba(255,255,255,.6); font-size: .9rem; line-height: 1.7;`. |
| `100` | `            margin-bottom: 2rem; max-width: 320px;` | Instrucción de ejecución en el contexto del script: `margin-bottom: 2rem; max-width: 320px;`. |
| `101` | `        }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `102` | `        .pl-feature {` | Instrucción de ejecución en el contexto del script: `.pl-feature {`. |
| `103` | `            display: flex; align-items: center; gap: .65rem;` | Instrucción de ejecución en el contexto del script: `display: flex; align-items: center; gap: .65rem;`. |
| `104` | `            color: rgba(255,255,255,.65); font-size: .83rem;` | Instrucción de ejecución en el contexto del script: `color: rgba(255,255,255,.65); font-size: .83rem;`. |
| `105` | `            margin-bottom: .7rem;` | Instrucción de ejecución en el contexto del script: `margin-bottom: .7rem;`. |
| `106` | `        }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `107` | `        .pl-feature-dot {` | Instrucción de ejecución en el contexto del script: `.pl-feature-dot {`. |
| `108` | `            width: 28px; height: 28px; border-radius: 7px;` | Instrucción de ejecución en el contexto del script: `width: 28px; height: 28px; border-radius: 7px;`. |
| `109` | `            background: rgba(57,169,0,.2); color: #7ddd5a;` | Instrucción de ejecución en el contexto del script: `background: rgba(57,169,0,.2); color: #7ddd5a;`. |
| `110` | `            display: flex; align-items: center; justify-content: center;` | Instrucción de ejecución en el contexto del script: `display: flex; align-items: center; justify-content: center;`. |
| `111` | `            font-size: .75rem; flex-shrink: 0;` | Instrucción de ejecución en el contexto del script: `font-size: .75rem; flex-shrink: 0;`. |
| `112` | `        }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `113` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `114` | `        /* ── PANEL DERECHO ── */` | Comentario de bloque o anotación informativa dentro del código. |
| `115` | `        .panel-right {` | Instrucción de ejecución en el contexto del script: `.panel-right {`. |
| `116` | `            background: #fff;` | Instrucción de ejecución en el contexto del script: `background: #fff;`. |
| `117` | `            display: flex; flex-direction: column; justify-content: center;` | Instrucción de ejecución en el contexto del script: `display: flex; flex-direction: column; justify-content: center;`. |
| `118` | `            padding: 3rem 3.5rem;` | Instrucción de ejecución en el contexto del script: `padding: 3rem 3.5rem;`. |
| `119` | `        }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `120` | `        .login-title {` | Instrucción de ejecución en el contexto del script: `.login-title {`. |
| `121` | `            font-size: 1.65rem; font-weight: 800;` | Instrucción de ejecución en el contexto del script: `font-size: 1.65rem; font-weight: 800;`. |
| `122` | `            color: var(--gray-900); margin-bottom: .35rem;` | Instrucción de ejecución en el contexto del script: `color: var(--gray-900); margin-bottom: .35rem;`. |
| `123` | `        }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `124` | `        .login-sub {` | Instrucción de ejecución en el contexto del script: `.login-sub {`. |
| `125` | `            font-size: .875rem; color: var(--gray-500);` | Instrucción de ejecución en el contexto del script: `font-size: .875rem; color: var(--gray-500);`. |
| `126` | `            margin-bottom: 2rem;` | Instrucción de ejecución en el contexto del script: `margin-bottom: 2rem;`. |
| `127` | `        }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `128` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `129` | `        /* ── FORM ── */` | Comentario de bloque o anotación informativa dentro del código. |
| `130` | `        .form-label {` | Instrucción de ejecución en el contexto del script: `.form-label {`. |
| `131` | `            font-size: .82rem; font-weight: 600;` | Instrucción de ejecución en el contexto del script: `font-size: .82rem; font-weight: 600;`. |
| `132` | `            color: var(--gray-700); margin-bottom: .4rem;` | Instrucción de ejecución en el contexto del script: `color: var(--gray-700); margin-bottom: .4rem;`. |
| `133` | `        }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `134` | `        .input-wrap {` | Instrucción de ejecución en el contexto del script: `.input-wrap {`. |
| `135` | `            position: relative;` | Instrucción de ejecución en el contexto del script: `position: relative;`. |
| `136` | `        }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `137` | `        .input-icon {` | Instrucción de ejecución en el contexto del script: `.input-icon {`. |
| `138` | `            position: absolute; left: .9rem; top: 50%; transform: translate...` | Instrucción de ejecución en el contexto del script: `position: absolute; left: .9rem; top: 50%; transform: translateY(-50%);`. |
| `139` | `            color: var(--gray-500); font-size: .85rem; pointer-events: none;` | Instrucción de ejecución en el contexto del script: `color: var(--gray-500); font-size: .85rem; pointer-events: none;`. |
| `140` | `            z-index: 2;` | Instrucción de ejecución en el contexto del script: `z-index: 2;`. |
| `141` | `        }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `142` | `        .form-field {` | Instrucción de ejecución en el contexto del script: `.form-field {`. |
| `143` | `            width: 100%; border: 1.5px solid var(--gray-200);` | Instrucción de ejecución en el contexto del script: `width: 100%; border: 1.5px solid var(--gray-200);`. |
| `144` | `            border-radius: 10px; padding: .72rem .9rem .72rem 2.5rem;` | Instrucción de ejecución en el contexto del script: `border-radius: 10px; padding: .72rem .9rem .72rem 2.5rem;`. |
| `145` | `            font-size: .9rem; color: var(--gray-900);` | Instrucción de ejecución en el contexto del script: `font-size: .9rem; color: var(--gray-900);`. |
| `146` | `            font-family: 'Inter', sans-serif;` | Instrucción de ejecución en el contexto del script: `font-family: 'Inter', sans-serif;`. |
| `147` | `            background: var(--gray-50);` | Instrucción de ejecución en el contexto del script: `background: var(--gray-50);`. |
| `148` | `            transition: border-color .2s, box-shadow .2s, background .2s;` | Instrucción de ejecución en el contexto del script: `transition: border-color .2s, box-shadow .2s, background .2s;`. |
| `149` | `            outline: none;` | Instrucción de ejecución en el contexto del script: `outline: none;`. |
| `150` | `        }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `151` | `        .form-field:focus {` | Instrucción de ejecución en el contexto del script: `.form-field:focus {`. |
| `152` | `            border-color: var(--green);` | Instrucción de ejecución en el contexto del script: `border-color: var(--green);`. |
| `153` | `            background: #fff;` | Instrucción de ejecución en el contexto del script: `background: #fff;`. |
| `154` | `            box-shadow: 0 0 0 3px rgba(57,169,0,.1);` | Instrucción de ejecución en el contexto del script: `box-shadow: 0 0 0 3px rgba(57,169,0,.1);`. |
| `155` | `        }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `156` | `        .form-field::placeholder { color: #adb5bd; }` | Instrucción de ejecución en el contexto del script: `.form-field::placeholder { color: #adb5bd; }`. |
| `157` | `        .btn-toggle-pass {` | Instrucción de ejecución en el contexto del script: `.btn-toggle-pass {`. |
| `158` | `            position: absolute; right: .75rem; top: 50%; transform: transla...` | Instrucción de ejecución en el contexto del script: `position: absolute; right: .75rem; top: 50%; transform: translateY(-50%);`. |
| `159` | `            background: none; border: none; color: var(--gray-500);` | Instrucción de ejecución en el contexto del script: `background: none; border: none; color: var(--gray-500);`. |
| `160` | `            cursor: pointer; padding: .2rem; font-size: .9rem;` | Instrucción de ejecución en el contexto del script: `cursor: pointer; padding: .2rem; font-size: .9rem;`. |
| `161` | `            transition: color .15s;` | Instrucción de ejecución en el contexto del script: `transition: color .15s;`. |
| `162` | `        }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `163` | `        .btn-toggle-pass:hover { color: var(--green); }` | Instrucción de ejecución en el contexto del script: `.btn-toggle-pass:hover { color: var(--green); }`. |
| `164` | `        .field-with-toggle .form-field { padding-right: 2.5rem; }` | Instrucción de ejecución en el contexto del script: `.field-with-toggle .form-field { padding-right: 2.5rem; }`. |
| `165` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `166` | `        .link-forgot {` | Instrucción de ejecución en el contexto del script: `.link-forgot {`. |
| `167` | `            font-size: .8rem; color: var(--green);` | Instrucción de ejecución en el contexto del script: `font-size: .8rem; color: var(--green);`. |
| `168` | `            background: none; border: none; padding: 0;` | Instrucción de ejecución en el contexto del script: `background: none; border: none; padding: 0;`. |
| `169` | `            cursor: pointer; text-decoration: none; font-weight: 500;` | Instrucción de ejecución en el contexto del script: `cursor: pointer; text-decoration: none; font-weight: 500;`. |
| `170` | `        }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `171` | `        .link-forgot:hover { text-decoration: underline; }` | Instrucción de ejecución en el contexto del script: `.link-forgot:hover { text-decoration: underline; }`. |
| `172` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `173` | `        .btn-login {` | Instrucción de ejecución en el contexto del script: `.btn-login {`. |
| `174` | `            width: 100%; padding: .8rem;` | Instrucción de ejecución en el contexto del script: `width: 100%; padding: .8rem;`. |
| `175` | `            background: var(--green); color: #fff;` | Instrucción de ejecución en el contexto del script: `background: var(--green); color: #fff;`. |
| `176` | `            border: none; border-radius: 10px;` | Instrucción de ejecución en el contexto del script: `border: none; border-radius: 10px;`. |
| `177` | `            font-size: .95rem; font-weight: 700;` | Instrucción de ejecución en el contexto del script: `font-size: .95rem; font-weight: 700;`. |
| `178` | `            cursor: pointer;` | Instrucción de ejecución en el contexto del script: `cursor: pointer;`. |
| `179` | `            transition: background .2s, transform .15s, box-shadow .2s;` | Instrucción de ejecución en el contexto del script: `transition: background .2s, transform .15s, box-shadow .2s;`. |
| `180` | `            box-shadow: 0 4px 14px rgba(57,169,0,.3);` | Instrucción de ejecución en el contexto del script: `box-shadow: 0 4px 14px rgba(57,169,0,.3);`. |
| `181` | `            display: flex; align-items: center; justify-content: center; ga...` | Instrucción de ejecución en el contexto del script: `display: flex; align-items: center; justify-content: center; gap: .5rem;`. |
| `182` | `        }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `183` | `        .btn-login:hover { background: var(--green-dark); transform: transl...` | Instrucción de ejecución en el contexto del script: `.btn-login:hover { background: var(--green-dark); transform: translateY(-1px); box-shadow: 0 6px 20px rgba(57,169,0,.35); }`. |
| `184` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `185` | `        .divider {` | Instrucción de ejecución en el contexto del script: `.divider {`. |
| `186` | `            display: flex; align-items: center; gap: .75rem;` | Instrucción de ejecución en el contexto del script: `display: flex; align-items: center; gap: .75rem;`. |
| `187` | `            color: var(--gray-500); font-size: .78rem; margin: 1.5rem 0;` | Instrucción de ejecución en el contexto del script: `color: var(--gray-500); font-size: .78rem; margin: 1.5rem 0;`. |
| `188` | `        }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `189` | `        .divider::before, .divider::after {` | Instrucción de ejecución en el contexto del script: `.divider::before, .divider::after {`. |
| `190` | `            content: ''; flex: 1; height: 1px; background: var(--gray-200);` | Instrucción de ejecución en el contexto del script: `content: ''; flex: 1; height: 1px; background: var(--gray-200);`. |
| `191` | `        }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `192` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `193` | `        .login-footer-text {` | Instrucción de ejecución en el contexto del script: `.login-footer-text {`. |
| `194` | `            font-size: .8rem; color: var(--gray-500);` | Instrucción de ejecución en el contexto del script: `font-size: .8rem; color: var(--gray-500);`. |
| `195` | `            text-align: center; margin-top: 1.5rem;` | Instrucción de ejecución en el contexto del script: `text-align: center; margin-top: 1.5rem;`. |
| `196` | `        }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `197` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `198` | `        /* ── MODAL ── */` | Comentario de bloque o anotación informativa dentro del código. |
| `199` | `        .modal-content {` | Instrucción de ejecución en el contexto del script: `.modal-content {`. |
| `200` | `            border: 1px solid var(--gray-200);` | Instrucción de ejecución en el contexto del script: `border: 1px solid var(--gray-200);`. |
| `201` | `            border-radius: 16px;` | Instrucción de ejecución en el contexto del script: `border-radius: 16px;`. |
| `202` | `            box-shadow: 0 20px 60px rgba(0,0,0,.12);` | Instrucción de ejecución en el contexto del script: `box-shadow: 0 20px 60px rgba(0,0,0,.12);`. |
| `203` | `        }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `204` | `        .modal-hdr {` | Instrucción de ejecución en el contexto del script: `.modal-hdr {`. |
| `205` | `            border-bottom: 1px solid var(--gray-200);` | Instrucción de ejecución en el contexto del script: `border-bottom: 1px solid var(--gray-200);`. |
| `206` | `            padding: 1.25rem 1.5rem;` | Instrucción de ejecución en el contexto del script: `padding: 1.25rem 1.5rem;`. |
| `207` | `        }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `208` | `        .modal-hdr h6 { font-weight: 700; color: var(--gray-900); margin: 0; }` | Instrucción de ejecución en el contexto del script: `.modal-hdr h6 { font-weight: 700; color: var(--gray-900); margin: 0; }`. |
| `209` | `        .modal-footer { border-top: 1px solid var(--gray-200); }` | Instrucción de ejecución en el contexto del script: `.modal-footer { border-top: 1px solid var(--gray-200); }`. |
| `210` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `211` | `        /* Inputs del modal */` | Comentario de bloque o anotación informativa dentro del código. |
| `212` | `        .modal .form-control {` | Instrucción de ejecución en el contexto del script: `.modal .form-control {`. |
| `213` | `            border: 1.5px solid var(--gray-200); border-radius: 9px;` | Instrucción de ejecución en el contexto del script: `border: 1.5px solid var(--gray-200); border-radius: 9px;`. |
| `214` | `            font-size: .875rem; padding: .65rem .9rem;` | Instrucción de ejecución en el contexto del script: `font-size: .875rem; padding: .65rem .9rem;`. |
| `215` | `            transition: border-color .2s, box-shadow .2s;` | Instrucción de ejecución en el contexto del script: `transition: border-color .2s, box-shadow .2s;`. |
| `216` | `        }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `217` | `        .modal .form-control:focus {` | Instrucción de ejecución en el contexto del script: `.modal .form-control:focus {`. |
| `218` | `            border-color: var(--green); box-shadow: 0 0 0 3px rgba(57,169,0...` | Instrucción de ejecución en el contexto del script: `border-color: var(--green); box-shadow: 0 0 0 3px rgba(57,169,0,.1);`. |
| `219` | `        }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `220` | `        .modal .input-group-text {` | Instrucción de ejecución en el contexto del script: `.modal .input-group-text {`. |
| `221` | `            background: var(--gray-50); border: 1.5px solid var(--gray-200);` | Instrucción de ejecución en el contexto del script: `background: var(--gray-50); border: 1.5px solid var(--gray-200);`. |
| `222` | `            border-right: 0; color: var(--gray-500);` | Instrucción de ejecución en el contexto del script: `border-right: 0; color: var(--gray-500);`. |
| `223` | `        }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `224` | `        .modal .form-control { border-left: 0; }` | Instrucción de ejecución en el contexto del script: `.modal .form-control { border-left: 0; }`. |
| `225` | `        .modal .btn-eye {` | Instrucción de ejecución en el contexto del script: `.modal .btn-eye {`. |
| `226` | `            background: var(--gray-50); border: 1.5px solid var(--gray-200);` | Instrucción de ejecución en el contexto del script: `background: var(--gray-50); border: 1.5px solid var(--gray-200);`. |
| `227` | `            border-left: 0; color: var(--gray-500);` | Instrucción de ejecución en el contexto del script: `border-left: 0; color: var(--gray-500);`. |
| `228` | `        }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `229` | `        .modal .btn-eye:hover { color: var(--green); }` | Instrucción de ejecución en el contexto del script: `.modal .btn-eye:hover { color: var(--green); }`. |
| `230` | `        .req-item { font-size: .78rem; color: #adb5bd; margin-bottom: .2rem...` | Instrucción de ejecución en el contexto del script: `.req-item { font-size: .78rem; color: #adb5bd; margin-bottom: .2rem; transition: color .2s; }`. |
| `231` | `        .req-item.ok { color: var(--green); }` | Instrucción de ejecución en el contexto del script: `.req-item.ok { color: var(--green); }`. |
| `232` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `233` | `        @media (max-width: 767px) {` | Instrucción de ejecución en el contexto del script: `@media (max-width: 767px) {`. |
| `234` | `            .panel-left { display: none !important; }` | Instrucción de ejecución en el contexto del script: `.panel-left { display: none !important; }`. |
| `235` | `            .panel-right { padding: 2rem 1.5rem; }` | Instrucción de ejecución en el contexto del script: `.panel-right { padding: 2rem 1.5rem; }`. |
| `236` | `            .login-wrapper { align-items: flex-start; }` | Instrucción de ejecución en el contexto del script: `.login-wrapper { align-items: flex-start; }`. |
| `237` | `        }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `238` | `    </style>` | Instrucción de ejecución en el contexto del script: `</style>`. |
| `239` | `</head>` | Cabecera del documento web para inclusión de metadatos, fuentes y hojas de estilo. |
| `240` | `<body>` | Cuerpo principal donde se renderiza la interfaz visual del usuario. |
| `241` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `242` | `<!-- ── TOPBAR ── -->` | Instrucción de ejecución en el contexto del script: `<!-- ── TOPBAR ── -->`. |
| `243` | `<nav class="topbar">` | Barra o elemento de navegación del sistema. |
| `244` | `    <div class="container d-flex align-items-center justify-content-between">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="container d-flex align-items-center justify-content-between">`. |
| `245` | `        <a href="../../public/index.php" class="topbar-brand">` | Enlace hipertexto de navegación o acción: `<a href="../../public/index.php" class="topbar-brand">`. |
| `246` | `            <div class="brand-icon"><i class="fas fa-broom"></i></div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="brand-icon"><i class="fas fa-broom"></i></div>`. |
| `247` | `            GestiLimpieza` | Instrucción de ejecución en el contexto del script: `GestiLimpieza`. |
| `248` | `        </a>` | Instrucción de ejecución en el contexto del script: `</a>`. |
| `249` | `        <a href="../../public/index.php" class="btn-back">` | Enlace hipertexto de navegación o acción: `<a href="../../public/index.php" class="btn-back">`. |
| `250` | `            <i class="fas fa-arrow-left"></i> Volver al inicio` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-arrow-left"></i> Volver al inicio`. |
| `251` | `        </a>` | Instrucción de ejecución en el contexto del script: `</a>`. |
| `252` | `    </div>` | Cierre de contenedor visual `<div>`. |
| `253` | `</nav>` | Barra o elemento de navegación del sistema. |
| `254` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `255` | `<!-- ── LAYOUT ── -->` | Instrucción de ejecución en el contexto del script: `<!-- ── LAYOUT ── -->`. |
| `256` | `<div class="login-wrapper">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="login-wrapper">`. |
| `257` | `    <div class="container-fluid p-0 d-flex" style="flex:1;">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="container-fluid p-0 d-flex" style="flex:1;">`. |
| `258` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `259` | `        <!-- Panel izquierdo -->` | Instrucción de ejecución en el contexto del script: `<!-- Panel izquierdo -->`. |
| `260` | `        <div class="col-md-5 col-lg-5 panel-left d-none d-md-flex flex-colu...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="col-md-5 col-lg-5 panel-left d-none d-md-flex flex-column">`. |
| `261` | `            <div class="panel-left-inner">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="panel-left-inner">`. |
| `262` | `                <div class="pl-badge">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="pl-badge">`. |
| `263` | `                    <i class="fas fa-rotate fa-sm"></i> Integrado con SICEFA` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-rotate fa-sm"></i> Integrado con SICEFA`. |
| `264` | `                </div>` | Cierre de contenedor visual `<div>`. |
| `265` | `                <h2>Gestión de<br>Limpieza de<br>Módulos</h2>` | Instrucción de ejecución en el contexto del script: `<h2>Gestión de<br>Limpieza de<br>Módulos</h2>`. |
| `266` | `                <p>Plataforma oficial del SENA para el registro, seguimient...` | Instrucción de ejecución en el contexto del script: `<p>Plataforma oficial del SENA para el registro, seguimiento y verificación del proceso de limpieza de módulos académicos.</p>`. |
| `267` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `268` | `                <div class="pl-feature">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="pl-feature">`. |
| `269` | `                    <div class="pl-feature-dot"><i class="fas fa-shield-hal...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="pl-feature-dot"><i class="fas fa-shield-halved"></i></div>`. |
| `270` | `                    Acceso seguro con credenciales institucionales` | Instrucción de ejecución en el contexto del script: `Acceso seguro con credenciales institucionales`. |
| `271` | `                </div>` | Cierre de contenedor visual `<div>`. |
| `272` | `                <div class="pl-feature">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="pl-feature">`. |
| `273` | `                    <div class="pl-feature-dot"><i class="fas fa-camera"></...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="pl-feature-dot"><i class="fas fa-camera"></i></div>`. |
| `274` | `                    Evidencias fotográficas por módulo y turno` | Instrucción de ejecución en el contexto del script: `Evidencias fotográficas por módulo y turno`. |
| `275` | `                </div>` | Cierre de contenedor visual `<div>`. |
| `276` | `                <div class="pl-feature">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="pl-feature">`. |
| `277` | `                    <div class="pl-feature-dot"><i class="fas fa-bell"></i>...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="pl-feature-dot"><i class="fas fa-bell"></i></div>`. |
| `278` | `                    Notificaciones de incumplimiento` | Instrucción de ejecución en el contexto del script: `Notificaciones de incumplimiento`. |
| `279` | `                </div>` | Cierre de contenedor visual `<div>`. |
| `280` | `                <div class="pl-feature">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="pl-feature">`. |
| `281` | `                    <div class="pl-feature-dot"><i class="fas fa-people-gro...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="pl-feature-dot"><i class="fas fa-people-group"></i></div>`. |
| `282` | `                    Rotación automática de grupos semanal` | Instrucción de ejecución en el contexto del script: `Rotación automática de grupos semanal`. |
| `283` | `                </div>` | Cierre de contenedor visual `<div>`. |
| `284` | `            </div>` | Cierre de contenedor visual `<div>`. |
| `285` | `        </div>` | Cierre de contenedor visual `<div>`. |
| `286` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `287` | `        <!-- Panel derecho -->` | Instrucción de ejecución en el contexto del script: `<!-- Panel derecho -->`. |
| `288` | `        <div class="col-md-7 col-lg-7 panel-right">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="col-md-7 col-lg-7 panel-right">`. |
| `289` | `            <div style="max-width: 420px; width: 100%; margin: 0 auto;">` | Contenedor visual estructurado con Bootstrap/CSS: `<div style="max-width: 420px; width: 100%; margin: 0 auto;">`. |
| `290` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `291` | `                <!-- Mobile brand -->` | Instrucción de ejecución en el contexto del script: `<!-- Mobile brand -->`. |
| `292` | `                <div class="d-md-none text-center mb-4">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="d-md-none text-center mb-4">`. |
| `293` | `                    <div class="brand-icon mx-auto mb-2" style="width:44px;...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="brand-icon mx-auto mb-2" style="width:44px;height:44px;font-size:1.1rem;border-radius:10px;">`. |
| `294` | `                        <i class="fas fa-broom"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-broom"></i>`. |
| `295` | `                    </div>` | Cierre de contenedor visual `<div>`. |
| `296` | `                    <span style="font-weight:700;font-size:1rem;">GestiLimp...` | Instrucción de ejecución en el contexto del script: `<span style="font-weight:700;font-size:1rem;">GestiLimpieza</span>`. |
| `297` | `                </div>` | Cierre de contenedor visual `<div>`. |
| `298` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `299` | `                <h4 class="login-title">Iniciar sesión</h4>` | Instrucción de ejecución en el contexto del script: `<h4 class="login-title">Iniciar sesión</h4>`. |
| `300` | `                <p class="login-sub">Ingresa las credenciales enviadas a tu...` | Instrucción de ejecución en el contexto del script: `<p class="login-sub">Ingresa las credenciales enviadas a tu correo institucional</p>`. |
| `301` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `302` | `                <form action="../../controllers/AuthController.php" method=...` | Formulario para recolección y envío de datos del usuario: `<form action="../../controllers/AuthController.php" method="POST">`. |
| `303` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `304` | `                    <div class="mb-3">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="mb-3">`. |
| `305` | `                        <label class="form-label">Correo institucional</label>` | Instrucción de ejecución en el contexto del script: `<label class="form-label">Correo institucional</label>`. |
| `306` | `                        <div class="input-wrap">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="input-wrap">`. |
| `307` | `                            <i class="fas fa-envelope input-icon"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-envelope input-icon"></i>`. |
| `308` | `                            <input type="email" name="correo" class="form-f...` | Campo de entrada interactivo para datos del usuario: `<input type="email" name="correo" class="form-field"`. |
| `309` | `                                   placeholder="usuario@sena.edu.co" requir...` | Instrucción de ejecución en el contexto del script: `placeholder="usuario@sena.edu.co" required autocomplete="username">`. |
| `310` | `                        </div>` | Cierre de contenedor visual `<div>`. |
| `311` | `                    </div>` | Cierre de contenedor visual `<div>`. |
| `312` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `313` | `                    <div class="mb-2">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="mb-2">`. |
| `314` | `                        <label class="form-label">Contraseña</label>` | Instrucción de ejecución en el contexto del script: `<label class="form-label">Contraseña</label>`. |
| `315` | `                        <div class="input-wrap field-with-toggle">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="input-wrap field-with-toggle">`. |
| `316` | `                            <i class="fas fa-lock input-icon"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-lock input-icon"></i>`. |
| `317` | `                            <input type="password" name="password" id="pass...` | Campo de entrada interactivo para datos del usuario: `<input type="password" name="password" id="passLogin"`. |
| `318` | `                                   class="form-field" placeholder="••••••••...` | Instrucción de ejecución en el contexto del script: `class="form-field" placeholder="••••••••" required autocomplete="current-password">`. |
| `319` | `                            <button type="button" class="btn-toggle-pass"` | Botón de acción interactivo para el usuario: `<button type="button" class="btn-toggle-pass"`. |
| `320` | `                                    onclick="togglePass('passLogin','eyeLog...` | Instrucción de ejecución en el contexto del script: `onclick="togglePass('passLogin','eyeLogin')">`. |
| `321` | `                                <i class="fas fa-eye" id="eyeLogin"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-eye" id="eyeLogin"></i>`. |
| `322` | `                            </button>` | Botón de acción interactivo para el usuario: `</button>`. |
| `323` | `                        </div>` | Cierre de contenedor visual `<div>`. |
| `324` | `                    </div>` | Cierre de contenedor visual `<div>`. |
| `325` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `326` | `                    <div class="text-end mb-4">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="text-end mb-4">`. |
| `327` | `                        <button type="button" class="link-forgot"` | Botón de acción interactivo para el usuario: `<button type="button" class="link-forgot"`. |
| `328` | `                                data-bs-toggle="modal" data-bs-target="#mod...` | Instrucción de ejecución en el contexto del script: `data-bs-toggle="modal" data-bs-target="#modalRecuperar">`. |
| `329` | `                            ¿Olvidaste tu contraseña?` | Instrucción de ejecución en el contexto del script: `¿Olvidaste tu contraseña?`. |
| `330` | `                        </button>` | Botón de acción interactivo para el usuario: `</button>`. |
| `331` | `                    </div>` | Cierre de contenedor visual `<div>`. |
| `332` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `333` | `                    <button type="submit" class="btn-login">` | Botón de acción interactivo para el usuario: `<button type="submit" class="btn-login">`. |
| `334` | `                        <i class="fas fa-arrow-right-to-bracket"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-arrow-right-to-bracket"></i>`. |
| `335` | `                        Ingresar al sistema` | Instrucción de ejecución en el contexto del script: `Ingresar al sistema`. |
| `336` | `                    </button>` | Botón de acción interactivo para el usuario: `</button>`. |
| `337` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `338` | `                </form>` | Cierre de formulario HTML. |
| `339` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `340` | `                <div class="login-footer-text">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="login-footer-text">`. |
| `341` | `                    ¿No recibiste tus credenciales?` | Instrucción de ejecución en el contexto del script: `¿No recibiste tus credenciales?`. |
| `342` | `                    <button type="button" class="link-forgot fw-semibold"` | Botón de acción interactivo para el usuario: `<button type="button" class="link-forgot fw-semibold"`. |
| `343` | `                            data-bs-toggle="modal" data-bs-target="#modalRe...` | Instrucción de ejecución en el contexto del script: `data-bs-toggle="modal" data-bs-target="#modalRecuperar">`. |
| `344` | `                        Contacta al administrador` | Instrucción de ejecución en el contexto del script: `Contacta al administrador`. |
| `345` | `                    </button>` | Botón de acción interactivo para el usuario: `</button>`. |
| `346` | `                </div>` | Cierre de contenedor visual `<div>`. |
| `347` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `348` | `            </div>` | Cierre de contenedor visual `<div>`. |
| `349` | `        </div>` | Cierre de contenedor visual `<div>`. |
| `350` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `351` | `    </div>` | Cierre de contenedor visual `<div>`. |
| `352` | `</div>` | Cierre de contenedor visual `<div>`. |
| `353` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `354` | `<!-- ══ Modal Recuperar ═══════════════════════════════════════════════════...` | Instrucción de ejecución en el contexto del script: `<!-- ══ Modal Recuperar ══════════════════════════════════════════════════════ -->`. |
| `355` | `<div class="modal fade" id="modalRecuperar" tabindex="-1" aria-hidden="true">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="modal fade" id="modalRecuperar" tabindex="-1" aria-hidden="true">`. |
| `356` | `    <div class="modal-dialog modal-dialog-centered">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="modal-dialog modal-dialog-centered">`. |
| `357` | `        <div class="modal-content">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="modal-content">`. |
| `358` | `            <div class="modal-hdr d-flex align-items-center justify-content...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="modal-hdr d-flex align-items-center justify-content-between">`. |
| `359` | `                <div class="d-flex align-items-center gap-2">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="d-flex align-items-center gap-2">`. |
| `360` | `                    <div style="width:32px;height:32px;background:var(--gre...` | Contenedor visual estructurado con Bootstrap/CSS: `<div style="width:32px;height:32px;background:var(--green-soft);color:var(--green);border-radius:8px;display:flex;align-items:center;justify-content:center;">`. |
| `361` | `                        <i class="fas fa-key fa-sm"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-key fa-sm"></i>`. |
| `362` | `                    </div>` | Cierre de contenedor visual `<div>`. |
| `363` | `                    <h6>Restablecer Contraseña</h6>` | Instrucción de ejecución en el contexto del script: `<h6>Restablecer Contraseña</h6>`. |
| `364` | `                </div>` | Cierre de contenedor visual `<div>`. |
| `365` | `                <button type="button" class="btn-close" data-bs-dismiss="mo...` | Botón de acción interactivo para el usuario: `<button type="button" class="btn-close" data-bs-dismiss="modal"></button>`. |
| `366` | `            </div>` | Cierre de contenedor visual `<div>`. |
| `367` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `368` | `            <form action="../../controllers/AuthController.php?accion=recup...` | Formulario para recolección y envío de datos del usuario: `<form action="../../controllers/AuthController.php?accion=recuperar" method="POST" id="formRecuperar">`. |
| `369` | `                <div class="modal-body px-4 py-4">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="modal-body px-4 py-4">`. |
| `370` | `                    <p class="text-muted small mb-4">` | Instrucción de ejecución en el contexto del script: `<p class="text-muted small mb-4">`. |
| `371` | `                        Ingresa tu correo institucional y crea una nueva co...` | Instrucción de ejecución en el contexto del script: `Ingresa tu correo institucional y crea una nueva contraseña segura.`. |
| `372` | `                    </p>` | Instrucción de ejecución en el contexto del script: `</p>`. |
| `373` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `374` | `                    <div class="mb-4">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="mb-4">`. |
| `375` | `                        <label class="form-label fw-semibold small">Correo ...` | Instrucción de ejecución en el contexto del script: `<label class="form-label fw-semibold small">Correo Institucional</label>`. |
| `376` | `                        <div class="input-group">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="input-group">`. |
| `377` | `                            <span class="input-group-text"><i class="fas fa...` | Instrucción de ejecución en el contexto del script: `<span class="input-group-text"><i class="fas fa-envelope"></i></span>`. |
| `378` | `                            <input type="email" name="correo" class="form-c...` | Campo de entrada interactivo para datos del usuario: `<input type="email" name="correo" class="form-control"`. |
| `379` | `                                   placeholder="usuario@sena.edu.co" required>` | Instrucción de ejecución en el contexto del script: `placeholder="usuario@sena.edu.co" required>`. |
| `380` | `                        </div>` | Cierre de contenedor visual `<div>`. |
| `381` | `                    </div>` | Cierre de contenedor visual `<div>`. |
| `382` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `383` | `                    <hr class="my-3">` | Instrucción de ejecución en el contexto del script: `<hr class="my-3">`. |
| `384` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `385` | `                    <div class="mb-3">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="mb-3">`. |
| `386` | `                        <label class="form-label fw-semibold small">Nueva C...` | Instrucción de ejecución en el contexto del script: `<label class="form-label fw-semibold small">Nueva Contraseña</label>`. |
| `387` | `                        <div class="input-group mb-2">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="input-group mb-2">`. |
| `388` | `                            <span class="input-group-text"><i class="fas fa...` | Instrucción de ejecución en el contexto del script: `<span class="input-group-text"><i class="fas fa-lock"></i></span>`. |
| `389` | `                            <input type="password" name="password_nueva" id...` | Campo de entrada interactivo para datos del usuario: `<input type="password" name="password_nueva" id="passNueva"`. |
| `390` | `                                   class="form-control" placeholder="Mín. 8...` | Instrucción de ejecución en el contexto del script: `class="form-control" placeholder="Mín. 8 caracteres"`. |
| `391` | `                                   required oninput="checkStrength(this.val...` | Instrucción de ejecución en el contexto del script: `required oninput="checkStrength(this.value)">`. |
| `392` | `                            <button type="button" class="btn btn-eye"` | Botón de acción interactivo para el usuario: `<button type="button" class="btn btn-eye"`. |
| `393` | `                                    onclick="togglePass('passNueva','eyeNue...` | Instrucción de ejecución en el contexto del script: `onclick="togglePass('passNueva','eyeNueva')">`. |
| `394` | `                                <i class="fas fa-eye" id="eyeNueva"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-eye" id="eyeNueva"></i>`. |
| `395` | `                            </button>` | Botón de acción interactivo para el usuario: `</button>`. |
| `396` | `                        </div>` | Cierre de contenedor visual `<div>`. |
| `397` | `                        <div class="progress mb-1" style="height:4px;">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="progress mb-1" style="height:4px;">`. |
| `398` | `                            <div id="strengthBar" class="progress-bar" styl...` | Contenedor visual estructurado con Bootstrap/CSS: `<div id="strengthBar" class="progress-bar" style="width:0%;transition:all .3s;"></div>`. |
| `399` | `                        </div>` | Cierre de contenedor visual `<div>`. |
| `400` | `                        <div id="strengthText" style="font-size:.74rem;min-...` | Contenedor visual estructurado con Bootstrap/CSS: `<div id="strengthText" style="font-size:.74rem;min-height:1rem;color:var(--gray-500);"></div>`. |
| `401` | `                    </div>` | Cierre de contenedor visual `<div>`. |
| `402` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `403` | `                    <div class="mb-4 p-3 rounded-3" id="reqBox"` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="mb-4 p-3 rounded-3" id="reqBox"`. |
| `404` | `                         style="display:none;background:var(--gray-50);bord...` | Instrucción de ejecución en el contexto del script: `style="display:none;background:var(--gray-50);border:1px solid var(--gray-200);">`. |
| `405` | `                        <div id="req-len"   class="req-item"><i class="fas ...` | Contenedor visual estructurado con Bootstrap/CSS: `<div id="req-len"   class="req-item"><i class="fas fa-circle me-1" style="font-size:.45rem;"></i> Al menos 8 caracteres</div>`. |
| `406` | `                        <div id="req-upper" class="req-item"><i class="fas ...` | Contenedor visual estructurado con Bootstrap/CSS: `<div id="req-upper" class="req-item"><i class="fas fa-circle me-1" style="font-size:.45rem;"></i> Al menos una mayúscula</div>`. |
| `407` | `                        <div id="req-num"   class="req-item"><i class="fas ...` | Contenedor visual estructurado con Bootstrap/CSS: `<div id="req-num"   class="req-item"><i class="fas fa-circle me-1" style="font-size:.45rem;"></i> Al menos un número</div>`. |
| `408` | `                        <div id="req-spec"  class="req-item"><i class="fas ...` | Contenedor visual estructurado con Bootstrap/CSS: `<div id="req-spec"  class="req-item"><i class="fas fa-circle me-1" style="font-size:.45rem;"></i> Al menos un carácter especial</div>`. |
| `409` | `                    </div>` | Cierre de contenedor visual `<div>`. |
| `410` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `411` | `                    <div class="mb-1">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="mb-1">`. |
| `412` | `                        <label class="form-label fw-semibold small">Confirm...` | Instrucción de ejecución en el contexto del script: `<label class="form-label fw-semibold small">Confirmar Contraseña</label>`. |
| `413` | `                        <div class="input-group">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="input-group">`. |
| `414` | `                            <span class="input-group-text"><i class="fas fa...` | Instrucción de ejecución en el contexto del script: `<span class="input-group-text"><i class="fas fa-lock"></i></span>`. |
| `415` | `                            <input type="password" name="password_confirm" ...` | Campo de entrada interactivo para datos del usuario: `<input type="password" name="password_confirm" id="passConfirm"`. |
| `416` | `                                   class="form-control" placeholder="Repite...` | Instrucción de ejecución en el contexto del script: `class="form-control" placeholder="Repite la contraseña" required>`. |
| `417` | `                            <button type="button" class="btn btn-eye"` | Botón de acción interactivo para el usuario: `<button type="button" class="btn btn-eye"`. |
| `418` | `                                    onclick="togglePass('passConfirm','eyeC...` | Instrucción de ejecución en el contexto del script: `onclick="togglePass('passConfirm','eyeConfirm')">`. |
| `419` | `                                <i class="fas fa-eye" id="eyeConfirm"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-eye" id="eyeConfirm"></i>`. |
| `420` | `                            </button>` | Botón de acción interactivo para el usuario: `</button>`. |
| `421` | `                        </div>` | Cierre de contenedor visual `<div>`. |
| `422` | `                        <div id="passError" class="text-danger d-none mt-2"...` | Contenedor visual estructurado con Bootstrap/CSS: `<div id="passError" class="text-danger d-none mt-2" style="font-size:.8rem;">`. |
| `423` | `                            <i class="fas fa-circle-exclamation me-1"></i> ...` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-circle-exclamation me-1"></i> Las contraseñas no coinciden.`. |
| `424` | `                        </div>` | Cierre de contenedor visual `<div>`. |
| `425` | `                    </div>` | Cierre de contenedor visual `<div>`. |
| `426` | `                </div>` | Cierre de contenedor visual `<div>`. |
| `427` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `428` | `                <div class="modal-footer px-4 py-3">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="modal-footer px-4 py-3">`. |
| `429` | `                    <button type="button" class="btn btn-sm btn-outline-sec...` | Botón de acción interactivo para el usuario: `<button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>`. |
| `430` | `                    <button type="submit" class="btn btn-sm fw-semibold px-4"` | Botón de acción interactivo para el usuario: `<button type="submit" class="btn btn-sm fw-semibold px-4"`. |
| `431` | `                            style="background:var(--green);border:none;colo...` | Instrucción de ejecución en el contexto del script: `style="background:var(--green);border:none;color:#fff;border-radius:8px;">`. |
| `432` | `                        <i class="fas fa-rotate-right me-1"></i> Restablecer` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-rotate-right me-1"></i> Restablecer`. |
| `433` | `                    </button>` | Botón de acción interactivo para el usuario: `</button>`. |
| `434` | `                </div>` | Cierre de contenedor visual `<div>`. |
| `435` | `            </form>` | Cierre de formulario HTML. |
| `436` | `        </div>` | Cierre de contenedor visual `<div>`. |
| `437` | `    </div>` | Cierre de contenedor visual `<div>`. |
| `438` | `</div>` | Cierre de contenedor visual `<div>`. |
| `439` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `440` | `<?php if ($alert): ?>` | Instrucción de ejecución en el contexto del script: `<?php if ($alert): ?>`. |
| `441` | `<script>` | Bloque o etiqueta de vinculación para scripts JavaScript del lado del cliente. |
| `442` | `document.addEventListener('DOMContentLoaded', function () {` | Declaración de método o función con su firma y parámetros: `document.addEventListener('DOMContentLoaded', function () {`. |
| `443` | `    Swal.fire({` | Instrucción de ejecución en el contexto del script: `Swal.fire({`. |
| `444` | `        icon:  '<?= htmlspecialchars($alert['icon'])  ?>',` | Instrucción de ejecución en el contexto del script: `icon:  '<?= htmlspecialchars($alert['icon'])  ?>',`. |
| `445` | `        title: '<?= htmlspecialchars($alert['title']) ?>',` | Instrucción de ejecución en el contexto del script: `title: '<?= htmlspecialchars($alert['title']) ?>',`. |
| `446` | `        text:  '<?= htmlspecialchars($alert['text'])  ?>',` | Instrucción de ejecución en el contexto del script: `text:  '<?= htmlspecialchars($alert['text'])  ?>',`. |
| `447` | `        confirmButtonText:  'Aceptar',` | Instrucción de ejecución en el contexto del script: `confirmButtonText:  'Aceptar',`. |
| `448` | `        confirmButtonColor: '#39a900'` | Instrucción de ejecución en el contexto del script: `confirmButtonColor: '#39a900'`. |
| `449` | `    });` | Instrucción de ejecución en el contexto del script: `});`. |
| `450` | `});` | Instrucción de ejecución en el contexto del script: `});`. |
| `451` | `</script>` | Bloque o etiqueta de vinculación para scripts JavaScript del lado del cliente. |
| `452` | `<?php endif; ?>` | Instrucción de ejecución en el contexto del script: `<?php endif; ?>`. |
| `453` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `454` | `<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap...` | Bloque o etiqueta de vinculación para scripts JavaScript del lado del cliente. |
| `455` | `<script>` | Bloque o etiqueta de vinculación para scripts JavaScript del lado del cliente. |
| `456` | `<?php if ($abrirPanel): ?>` | Instrucción de ejecución en el contexto del script: `<?php if ($abrirPanel): ?>`. |
| `457` | `document.addEventListener('DOMContentLoaded', function () {` | Declaración de método o función con su firma y parámetros: `document.addEventListener('DOMContentLoaded', function () {`. |
| `458` | `    new bootstrap.Modal(document.getElementById('modalRecuperar')).show();` | Instrucción de ejecución en el contexto del script: `new bootstrap.Modal(document.getElementById('modalRecuperar')).show();`. |
| `459` | `});` | Instrucción de ejecución en el contexto del script: `});`. |
| `460` | `<?php endif; ?>` | Instrucción de ejecución en el contexto del script: `<?php endif; ?>`. |
| `461` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `462` | `function togglePass(inputId, iconId) {` | Declaración de método o función con su firma y parámetros: `function togglePass(inputId, iconId) {`. |
| `463` | `    const inp = document.getElementById(inputId);` | Instrucción de ejecución en el contexto del script: `const inp = document.getElementById(inputId);`. |
| `464` | `    const ico = document.getElementById(iconId);` | Instrucción de ejecución en el contexto del script: `const ico = document.getElementById(iconId);`. |
| `465` | `    if (!inp \|\| !ico) return;` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (!inp \|\| !ico) return;`. |
| `466` | `    inp.type = inp.type === 'password' ? 'text' : 'password';` | Instrucción de ejecución en el contexto del script: `inp.type = inp.type === 'password' ? 'text' : 'password';`. |
| `467` | `    ico.classList.toggle('fa-eye');` | Instrucción de ejecución en el contexto del script: `ico.classList.toggle('fa-eye');`. |
| `468` | `    ico.classList.toggle('fa-eye-slash');` | Instrucción de ejecución en el contexto del script: `ico.classList.toggle('fa-eye-slash');`. |
| `469` | `}` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `470` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `471` | `function checkStrength(val) {` | Declaración de método o función con su firma y parámetros: `function checkStrength(val) {`. |
| `472` | `    const bar  = document.getElementById('strengthBar');` | Instrucción de ejecución en el contexto del script: `const bar  = document.getElementById('strengthBar');`. |
| `473` | `    const text = document.getElementById('strengthText');` | Instrucción de ejecución en el contexto del script: `const text = document.getElementById('strengthText');`. |
| `474` | `    const box  = document.getElementById('reqBox');` | Instrucción de ejecución en el contexto del script: `const box  = document.getElementById('reqBox');`. |
| `475` | `    const checks = {` | Instrucción de ejecución en el contexto del script: `const checks = {`. |
| `476` | `        len:   val.length >= 8,` | Instrucción de ejecución en el contexto del script: `len:   val.length >= 8,`. |
| `477` | `        upper: /[A-Z]/.test(val),` | Instrucción de ejecución en el contexto del script: `upper: /[A-Z]/.test(val),`. |
| `478` | `        num:   /[0-9]/.test(val),` | Instrucción de ejecución en el contexto del script: `num:   /[0-9]/.test(val),`. |
| `479` | `        spec:  /[\W_]/.test(val),` | Instrucción de ejecución en el contexto del script: `spec:  /[\W_]/.test(val),`. |
| `480` | `    };` | Instrucción de ejecución en el contexto del script: `};`. |
| `481` | `    box.style.display = val.length ? 'block' : 'none';` | Instrucción de ejecución en el contexto del script: `box.style.display = val.length ? 'block' : 'none';`. |
| `482` | `    for (const [k, v] of Object.entries(checks)) {` | Instrucción de ejecución en el contexto del script: `for (const [k, v] of Object.entries(checks)) {`. |
| `483` | `        const el = document.getElementById('req-' + k);` | Instrucción de ejecución en el contexto del script: `const el = document.getElementById('req-' + k);`. |
| `484` | `        if (el) el.classList.toggle('ok', v);` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (el) el.classList.toggle('ok', v);`. |
| `485` | `    }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `486` | `    const score = Object.values(checks).filter(Boolean).length;` | Instrucción de ejecución en el contexto del script: `const score = Object.values(checks).filter(Boolean).length;`. |
| `487` | `    const levels = [` | Instrucción de ejecución en el contexto del script: `const levels = [`. |
| `488` | `        { pct:'20%', color:'#ef4444', label:'Muy débil'  },` | Instrucción de ejecución en el contexto del script: `{ pct:'20%', color:'#ef4444', label:'Muy débil'  },`. |
| `489` | `        { pct:'40%', color:'#f97316', label:'Débil'      },` | Instrucción de ejecución en el contexto del script: `{ pct:'40%', color:'#f97316', label:'Débil'      },`. |
| `490` | `        { pct:'60%', color:'#eab308', label:'Regular'    },` | Instrucción de ejecución en el contexto del script: `{ pct:'60%', color:'#eab308', label:'Regular'    },`. |
| `491` | `        { pct:'80%', color:'#22c55e', label:'Fuerte'     },` | Instrucción de ejecución en el contexto del script: `{ pct:'80%', color:'#22c55e', label:'Fuerte'     },`. |
| `492` | `        { pct:'100%',color:'#16a34a', label:'Muy fuerte' },` | Instrucción de ejecución en el contexto del script: `{ pct:'100%',color:'#16a34a', label:'Muy fuerte' },`. |
| `493` | `    ];` | Instrucción de ejecución en el contexto del script: `];`. |
| `494` | `    const lvl = levels[Math.max(0, score - 1)];` | Instrucción de ejecución en el contexto del script: `const lvl = levels[Math.max(0, score - 1)];`. |
| `495` | `    bar.style.width           = val.length ? lvl.pct   : '0%';` | Instrucción de ejecución en el contexto del script: `bar.style.width           = val.length ? lvl.pct   : '0%';`. |
| `496` | `    bar.style.backgroundColor = val.length ? lvl.color : '';` | Instrucción de ejecución en el contexto del script: `bar.style.backgroundColor = val.length ? lvl.color : '';`. |
| `497` | `    text.textContent          = val.length ? lvl.label : '';` | Instrucción de ejecución en el contexto del script: `text.textContent          = val.length ? lvl.label : '';`. |
| `498` | `}` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `499` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `500` | `document.getElementById('formRecuperar').addEventListener('submit', functio...` | Instrucción de ejecución en el contexto del script: `document.getElementById('formRecuperar').addEventListener('submit', function(e) {`. |
| `501` | `    const p1  = document.getElementById('passNueva').value;` | Instrucción de ejecución en el contexto del script: `const p1  = document.getElementById('passNueva').value;`. |
| `502` | `    const p2  = document.getElementById('passConfirm').value;` | Instrucción de ejecución en el contexto del script: `const p2  = document.getElementById('passConfirm').value;`. |
| `503` | `    const err = document.getElementById('passError');` | Instrucción de ejecución en el contexto del script: `const err = document.getElementById('passError');`. |
| `504` | `    if (p1 !== p2) { e.preventDefault(); err.classList.remove('d-none'); }` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (p1 !== p2) { e.preventDefault(); err.classList.remove('d-none'); }`. |
| `505` | `    else err.classList.add('d-none');` | Instrucción de ejecución en el contexto del script: `else err.classList.add('d-none');`. |
| `506` | `});` | Instrucción de ejecución en el contexto del script: `});`. |
| `507` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `508` | `document.getElementById('passConfirm').addEventListener('input', function () {` | Declaración de método o función con su firma y parámetros: `document.getElementById('passConfirm').addEventListener('input', function () {`. |
| `509` | `    const p1 = document.getElementById('passNueva').value;` | Instrucción de ejecución en el contexto del script: `const p1 = document.getElementById('passNueva').value;`. |
| `510` | `    document.getElementById('passError').classList.toggle('d-none', this.va...` | Instrucción de ejecución en el contexto del script: `document.getElementById('passError').classList.toggle('d-none', this.value === p1 \|\| !this.value);`. |
| `511` | `});` | Instrucción de ejecución en el contexto del script: `});`. |
| `512` | `</script>` | Bloque o etiqueta de vinculación para scripts JavaScript del lado del cliente. |
| `513` | `</body>` | Cuerpo principal donde se renderiza la interfaz visual del usuario. |
| `514` | `</html>` | Etiqueta raíz que delimita el documento HTML. |

---

## 3. Resumen y Flujo de Interacción

El archivo `login.php` cumple un rol indispensable en `views/usuarios/login.php`. 
Vista interactiva del formulario de inicio de sesión con validaciones visuales, mensajes flash de error y recuperación. Garantiza la robustez, el orden y la estabilidad de la arquitectura del proyecto `systemLimpieza`.
