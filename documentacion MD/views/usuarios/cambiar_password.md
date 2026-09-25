# Documentación Línea por Línea: `views/usuarios/cambiar_password.php`

## 1. Ficha Técnica del Archivo

- **Archivo:** `cambiar_password.php`
- **Ruta en el proyecto:** `views/usuarios/cambiar_password.php`
- **Cantidad total de líneas:** `309`
- **Tipo de archivo:** `PHP`
- **Propósito general:** Vista para el cambio obligatorio de contraseña en el primer acceso del usuario o recuperación de credenciales.

---

## 2. Explicación Detallada Línea por Línea

A continuación se presenta cada línea de código numerada de forma consecutiva, acompañada de su fragmento exacto y la explicación exhaustiva de su funcionamiento y responsabilidad en el sistema:

| Línea | Código Fuente | Explicación Detallada |
|---|---|---|
| `1` | ``<?php`` | Apertura obligatoria de la etiqueta PHP para ejecución del código del lado del servidor. |
| `2` | `session_start();` | Instrucción de ejecución en el contexto del script: `session_start();`. |
| `3` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `4` | `// Evitar caché del navegador` | Comentario explicativo en el código: `Evitar caché del navegador`. |
| `5` | `header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");` | Emite cabecera HTTP de respuesta hacia el cliente: `header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");`. |
| `6` | `header("Cache-Control: post-check=0, pre-check=0", false);` | Emite cabecera HTTP de respuesta hacia el cliente: `header("Cache-Control: post-check=0, pre-check=0", false);`. |
| `7` | `header("Pragma: no-cache");` | Emite cabecera HTTP de respuesta hacia el cliente: `header("Pragma: no-cache");`. |
| `8` | `header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");` | Emite cabecera HTTP de respuesta hacia el cliente: `header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");`. |
| `9` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `10` | `if (!isset($_SESSION['usuario'])) {` | Verifica autenticación y rol del usuario; redirige al login si no tiene permisos. |
| `11` | `header("Location: login.php"); exit;` | Emite cabecera HTTP de redirección en el navegador y detiene la ejecución: `header("Location: login.php"); exit;`. |
| `12` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `13` | `// Solo voceros en primer acceso` | Comentario explicativo en el código: `Solo voceros en primer acceso`. |
| `14` | `if ((int)$_SESSION['usuario']['rol'] !== 2) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if ((int)$_SESSION['usuario']['rol'] !== 2) {`. |
| `15` | `header("Location: ../dashboard/admin_dashboard.php"); exit;` | Emite cabecera HTTP de redirección en el navegador y detiene la ejecución: `header("Location: ../dashboard/admin_dashboard.php"); exit;`. |
| `16` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `17` | `$alert = $_SESSION['alert'] ?? null;` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección. |
| `18` | `unset($_SESSION['alert']);` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección. |
| `19` | ``?>`` | Cierre de la etiqueta PHP para alternar a salida HTML o fin del archivo. |
| `20` | `<!DOCTYPE html>` | Instrucción de ejecución en el contexto del script: `<!DOCTYPE html>`. |
| `21` | `<html lang="es">` | Instrucción de ejecución en el contexto del script: `<html lang="es">`. |
| `22` | `<head>` | Instrucción de ejecución en el contexto del script: `<head>`. |
| `23` | `<meta charset="UTF-8">` | Instrucción de ejecución en el contexto del script: `<meta charset="UTF-8">`. |
| `24` | `<meta name="viewport" content="width=device-width, initial-scale=1.0">` | Instrucción de ejecución en el contexto del script: `<meta name="viewport" content="width=device-width, initial-scale=1.0">`. |
| `25` | `<title>Cambio de Contraseña – GestiLimpieza SENA</title>` | Instrucción de ejecución en el contexto del script: `<title>Cambio de Contraseña – GestiLimpieza SENA</title>`. |
| `26` | `<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootst...` | Vinculación de hoja de estilos o recurso externo: `<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootst...`. |
| `27` | `<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font...` | Vinculación de hoja de estilos o recurso externo: `<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font...`. |
| `28` | `<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;...` | Vinculación de hoja de estilos o recurso externo: `<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;...`. |
| `29` | ``<script>`` | Bloque o etiqueta de vinculación para scripts JavaScript del lado del cliente. |
| `30` | ``<style>`` | Bloque de estilos CSS personalizados para la interfaz. |
| `31` | `:root {` | Instrucción de ejecución en el contexto del script: `:root {`. |
| `32` | `--green:      #39a900;` | Comentario explicativo SQL: `green:      #39a900;`. |
| `33` | `--green-dark: #2d8400;` | Comentario explicativo SQL: `green-dark: #2d8400;`. |
| `34` | `--green-soft: #f0faf0;` | Comentario explicativo SQL: `green-soft: #f0faf0;`. |
| `35` | `--gray-50:    #f8fafc;` | Comentario explicativo SQL: `gray-50:    #f8fafc;`. |
| `36` | `--gray-100:   #f1f5f9;` | Comentario explicativo SQL: `gray-100:   #f1f5f9;`. |
| `37` | `--gray-200:   #e2e8f0;` | Comentario explicativo SQL: `gray-200:   #e2e8f0;`. |
| `38` | `--gray-500:   #64748b;` | Comentario explicativo SQL: `gray-500:   #64748b;`. |
| `39` | `--gray-700:   #334155;` | Comentario explicativo SQL: `gray-700:   #334155;`. |
| `40` | `--gray-900:   #0f172a;` | Comentario explicativo SQL: `gray-900:   #0f172a;`. |
| `41` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `42` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `43` | `* { box-sizing: border-box; }` | Comentario multilínea de documentación o aclaración técnica. |
| `44` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `45` | `body {` | Instrucción de ejecución en el contexto del script: `body {`. |
| `46` | `font-family: 'Inter', sans-serif;` | Instrucción de ejecución en el contexto del script: `font-family: 'Inter', sans-serif;`. |
| `47` | `background: var(--gray-50);` | Instrucción de ejecución en el contexto del script: `background: var(--gray-50);`. |
| `48` | `min-height: 100vh;` | Instrucción de ejecución en el contexto del script: `min-height: 100vh;`. |
| `49` | `display: flex;` | Instrucción de ejecución en el contexto del script: `display: flex;`. |
| `50` | `align-items: center;` | Instrucción de ejecución en el contexto del script: `align-items: center;`. |
| `51` | `justify-content: center;` | Instrucción de ejecución en el contexto del script: `justify-content: center;`. |
| `52` | `padding: 1.5rem;` | Instrucción de ejecución en el contexto del script: `padding: 1.5rem;`. |
| `53` | `margin: 0;` | Instrucción de ejecución en el contexto del script: `margin: 0;`. |
| `54` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `55` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `56` | `.change-card {` | Instrucción de ejecución en el contexto del script: `.change-card {`. |
| `57` | `max-width: 460px;` | Instrucción de ejecución en el contexto del script: `max-width: 460px;`. |
| `58` | `width: 100%;` | Instrucción de ejecución en el contexto del script: `width: 100%;`. |
| `59` | `background: #fff;` | Instrucción de ejecución en el contexto del script: `background: #fff;`. |
| `60` | `border-radius: 16px;` | Instrucción de ejecución en el contexto del script: `border-radius: 16px;`. |
| `61` | `padding: 2.5rem 2.25rem;` | Instrucción de ejecución en el contexto del script: `padding: 2.5rem 2.25rem;`. |
| `62` | `border: 1px solid var(--gray-200);` | Instrucción de ejecución en el contexto del script: `border: 1px solid var(--gray-200);`. |
| `63` | `box-shadow: 0 4px 24px rgba(0,0,0,.07);` | Instrucción de ejecución en el contexto del script: `box-shadow: 0 4px 24px rgba(0,0,0,.07);`. |
| `64` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `65` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `66` | `.icon-box {` | Instrucción de ejecución en el contexto del script: `.icon-box {`. |
| `67` | `width: 52px; height: 52px;` | Instrucción de ejecución en el contexto del script: `width: 52px; height: 52px;`. |
| `68` | `border-radius: 12px;` | Instrucción de ejecución en el contexto del script: `border-radius: 12px;`. |
| `69` | `background: var(--green-soft);` | Instrucción de ejecución en el contexto del script: `background: var(--green-soft);`. |
| `70` | `border: 1px solid #b7f0b7;` | Instrucción de ejecución en el contexto del script: `border: 1px solid #b7f0b7;`. |
| `71` | `display: flex; align-items: center; justify-content: center;` | Instrucción de ejecución en el contexto del script: `display: flex; align-items: center; justify-content: center;`. |
| `72` | `font-size: 1.4rem; color: var(--green);` | Instrucción de ejecución en el contexto del script: `font-size: 1.4rem; color: var(--green);`. |
| `73` | `margin: 0 auto 1.25rem;` | Instrucción de ejecución en el contexto del script: `margin: 0 auto 1.25rem;`. |
| `74` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `75` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `76` | `.card-title {` | Instrucción de ejecución en el contexto del script: `.card-title {`. |
| `77` | `font-size: 1.2rem;` | Instrucción de ejecución en el contexto del script: `font-size: 1.2rem;`. |
| `78` | `font-weight: 700;` | Instrucción de ejecución en el contexto del script: `font-weight: 700;`. |
| `79` | `color: var(--gray-900);` | Instrucción de ejecución en el contexto del script: `color: var(--gray-900);`. |
| `80` | `text-align: center;` | Instrucción de ejecución en el contexto del script: `text-align: center;`. |
| `81` | `margin-bottom: .35rem;` | Instrucción de ejecución en el contexto del script: `margin-bottom: .35rem;`. |
| `82` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `83` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `84` | `.card-subtitle {` | Instrucción de ejecución en el contexto del script: `.card-subtitle {`. |
| `85` | `font-size: .85rem;` | Instrucción de ejecución en el contexto del script: `font-size: .85rem;`. |
| `86` | `color: var(--gray-500);` | Instrucción de ejecución en el contexto del script: `color: var(--gray-500);`. |
| `87` | `text-align: center;` | Instrucción de ejecución en el contexto del script: `text-align: center;`. |
| `88` | `margin-bottom: 1.75rem;` | Instrucción de ejecución en el contexto del script: `margin-bottom: 1.75rem;`. |
| `89` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `90` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `91` | `.form-label {` | Instrucción de ejecución en el contexto del script: `.form-label {`. |
| `92` | `font-size: .82rem;` | Instrucción de ejecución en el contexto del script: `font-size: .82rem;`. |
| `93` | `font-weight: 600;` | Instrucción de ejecución en el contexto del script: `font-weight: 600;`. |
| `94` | `color: var(--gray-700);` | Instrucción de ejecución en el contexto del script: `color: var(--gray-700);`. |
| `95` | `margin-bottom: .4rem;` | Instrucción de ejecución en el contexto del script: `margin-bottom: .4rem;`. |
| `96` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `97` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `98` | `.input-group-text {` | Instrucción de ejecución en el contexto del script: `.input-group-text {`. |
| `99` | `background: var(--gray-100);` | Instrucción de ejecución en el contexto del script: `background: var(--gray-100);`. |
| `100` | `border: 1px solid var(--gray-200);` | Instrucción de ejecución en el contexto del script: `border: 1px solid var(--gray-200);`. |
| `101` | `border-right: 0;` | Instrucción de ejecución en el contexto del script: `border-right: 0;`. |
| `102` | `color: var(--gray-500);` | Instrucción de ejecución en el contexto del script: `color: var(--gray-500);`. |
| `103` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `104` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `105` | `.form-control {` | Instrucción de ejecución en el contexto del script: `.form-control {`. |
| `106` | `background: #fff;` | Instrucción de ejecución en el contexto del script: `background: #fff;`. |
| `107` | `border: 1px solid var(--gray-200);` | Instrucción de ejecución en el contexto del script: `border: 1px solid var(--gray-200);`. |
| `108` | `border-left: 0;` | Instrucción de ejecución en el contexto del script: `border-left: 0;`. |
| `109` | `color: var(--gray-900);` | Instrucción de ejecución en el contexto del script: `color: var(--gray-900);`. |
| `110` | `padding: .68rem 1rem;` | Instrucción de ejecución en el contexto del script: `padding: .68rem 1rem;`. |
| `111` | `font-size: .9rem;` | Instrucción de ejecución en el contexto del script: `font-size: .9rem;`. |
| `112` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `113` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `114` | `.form-control:focus {` | Instrucción de ejecución en el contexto del script: `.form-control:focus {`. |
| `115` | `background: #fff;` | Instrucción de ejecución en el contexto del script: `background: #fff;`. |
| `116` | `box-shadow: none;` | Instrucción de ejecución en el contexto del script: `box-shadow: none;`. |
| `117` | `border-color: var(--green);` | Instrucción de ejecución en el contexto del script: `border-color: var(--green);`. |
| `118` | `color: var(--gray-900);` | Instrucción de ejecución en el contexto del script: `color: var(--gray-900);`. |
| `119` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `120` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `121` | `.form-control::placeholder { color: #94a3b8; }` | Instrucción de ejecución en el contexto del script: `.form-control::placeholder { color: #94a3b8; }`. |
| `122` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `123` | `.btn-eye {` | Instrucción de ejecución en el contexto del script: `.btn-eye {`. |
| `124` | `background: var(--gray-100);` | Instrucción de ejecución en el contexto del script: `background: var(--gray-100);`. |
| `125` | `border: 1px solid var(--gray-200);` | Instrucción de ejecución en el contexto del script: `border: 1px solid var(--gray-200);`. |
| `126` | `border-left: 0;` | Instrucción de ejecución en el contexto del script: `border-left: 0;`. |
| `127` | `color: var(--gray-500);` | Instrucción de ejecución en el contexto del script: `color: var(--gray-500);`. |
| `128` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `129` | `.btn-eye:hover { color: var(--green); background: var(--gray-100); }` | Instrucción de ejecución en el contexto del script: `.btn-eye:hover { color: var(--green); background: var(--gray-100); }`. |
| `130` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `131` | `/* cuando el input tiene foco, sincronizar borde del btn-eye */` | Comentario multilínea de documentación o aclaración técnica. |
| `132` | `.input-group:focus-within .btn-eye,` | Instrucción de ejecución en el contexto del script: `.input-group:focus-within .btn-eye,`. |
| `133` | `.input-group:focus-within .input-group-text {` | Instrucción de ejecución en el contexto del script: `.input-group:focus-within .input-group-text {`. |
| `134` | `border-color: var(--green);` | Instrucción de ejecución en el contexto del script: `border-color: var(--green);`. |
| `135` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `136` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `137` | `.req-box {` | Instrucción de ejecución en el contexto del script: `.req-box {`. |
| `138` | `background: var(--gray-50);` | Instrucción de ejecución en el contexto del script: `background: var(--gray-50);`. |
| `139` | `border: 1px solid var(--gray-200);` | Instrucción de ejecución en el contexto del script: `border: 1px solid var(--gray-200);`. |
| `140` | `border-radius: 8px;` | Instrucción de ejecución en el contexto del script: `border-radius: 8px;`. |
| `141` | `padding: .75rem 1rem;` | Instrucción de ejecución en el contexto del script: `padding: .75rem 1rem;`. |
| `142` | `margin-top: .5rem;` | Instrucción de ejecución en el contexto del script: `margin-top: .5rem;`. |
| `143` | `margin-bottom: 1rem;` | Instrucción de ejecución en el contexto del script: `margin-bottom: 1rem;`. |
| `144` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `145` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `146` | `.req-item {` | Instrucción de ejecución en el contexto del script: `.req-item {`. |
| `147` | `font-size: .78rem;` | Instrucción de ejecución en el contexto del script: `font-size: .78rem;`. |
| `148` | `color: #94a3b8;` | Instrucción de ejecución en el contexto del script: `color: #94a3b8;`. |
| `149` | `margin-bottom: .2rem;` | Instrucción de ejecución en el contexto del script: `margin-bottom: .2rem;`. |
| `150` | `display: flex;` | Instrucción de ejecución en el contexto del script: `display: flex;`. |
| `151` | `align-items: center;` | Instrucción de ejecución en el contexto del script: `align-items: center;`. |
| `152` | `gap: .4rem;` | Instrucción de ejecución en el contexto del script: `gap: .4rem;`. |
| `153` | `transition: color .2s;` | Instrucción de ejecución en el contexto del script: `transition: color .2s;`. |
| `154` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `155` | `.req-item i { font-size: .55rem; }` | Instrucción de ejecución en el contexto del script: `.req-item i { font-size: .55rem; }`. |
| `156` | `.req-item.ok { color: var(--green); }` | Instrucción de ejecución en el contexto del script: `.req-item.ok { color: var(--green); }`. |
| `157` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `158` | `.btn-guardar {` | Instrucción de ejecución en el contexto del script: `.btn-guardar {`. |
| `159` | `background: var(--green);` | Instrucción de ejecución en el contexto del script: `background: var(--green);`. |
| `160` | `color: #fff;` | Instrucción de ejecución en el contexto del script: `color: #fff;`. |
| `161` | `border: none;` | Instrucción de ejecución en el contexto del script: `border: none;`. |
| `162` | `border-radius: 8px;` | Instrucción de ejecución en el contexto del script: `border-radius: 8px;`. |
| `163` | `font-size: .95rem;` | Instrucción de ejecución en el contexto del script: `font-size: .95rem;`. |
| `164` | `font-weight: 600;` | Instrucción de ejecución en el contexto del script: `font-weight: 600;`. |
| `165` | `padding: .75rem;` | Instrucción de ejecución en el contexto del script: `padding: .75rem;`. |
| `166` | `width: 100%;` | Instrucción de ejecución en el contexto del script: `width: 100%;`. |
| `167` | `transition: background .2s, transform .15s, box-shadow .2s;` | Instrucción de ejecución en el contexto del script: `transition: background .2s, transform .15s, box-shadow .2s;`. |
| `168` | `box-shadow: 0 4px 14px rgba(57,169,0,.25);` | Instrucción de ejecución en el contexto del script: `box-shadow: 0 4px 14px rgba(57,169,0,.25);`. |
| `169` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `170` | `.btn-guardar:hover {` | Instrucción de ejecución en el contexto del script: `.btn-guardar:hover {`. |
| `171` | `background: var(--green-dark);` | Instrucción de ejecución en el contexto del script: `background: var(--green-dark);`. |
| `172` | `transform: translateY(-1px);` | Instrucción de ejecución en el contexto del script: `transform: translateY(-1px);`. |
| `173` | `box-shadow: 0 6px 18px rgba(57,169,0,.3);` | Instrucción de ejecución en el contexto del script: `box-shadow: 0 6px 18px rgba(57,169,0,.3);`. |
| `174` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `175` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `176` | `.text-danger-soft {` | Instrucción de ejecución en el contexto del script: `.text-danger-soft {`. |
| `177` | `font-size: .8rem;` | Instrucción de ejecución en el contexto del script: `font-size: .8rem;`. |
| `178` | `color: #ef4444;` | Instrucción de ejecución en el contexto del script: `color: #ef4444;`. |
| `179` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `180` | ``</style>`` | Cierre de bloque de estilos CSS. |
| `181` | ``<script>`` | Bloque o etiqueta de vinculación para scripts JavaScript del lado del cliente. |
| `182` | `window.addEventListener('pageshow', function(e) {` | Registra un escucha de eventos del DOM para interactividad en tiempo real: `window.addEventListener('pageshow', function(e) {`. |
| `183` | `if (e.persisted) { window.location.reload(); }` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (e.persisted) { window.location.reload(); }`. |
| `184` | `});` | Instrucción de ejecución en el contexto del script: `});`. |
| `185` | ``</script>`` | Cierre de bloque de script JavaScript. |
| `186` | `</head>` | Instrucción de ejecución en el contexto del script: `</head>`. |
| `187` | `<body>` | Instrucción de ejecución en el contexto del script: `<body>`. |
| `188` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `189` | `<div class="change-card">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="change-card">`. |
| `190` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `191` | `<div class="icon-box"><i class="fas fa-key"></i></div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="icon-box"><i class="fas fa-key"></i></div>`. |
| `192` | `<div class="card-title">Cambio de contraseña</div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="card-title">Cambio de contraseña</div>`. |
| `193` | `<div class="card-subtitle">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="card-subtitle">`. |
| `194` | `Por seguridad debes establecer una nueva contraseña antes de continuar.` | Instrucción de ejecución en el contexto del script: `Por seguridad debes establecer una nueva contraseña antes de continuar.`. |
| `195` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `196` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `197` | `<form action="../../controllers/AuthController.php?accion=cambiar_passwo...` | Formulario interactivo para captura y envío de datos: `<form action="../../controllers/AuthController.php?accion=cambiar_passwo...`. |
| `198` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `199` | `<div class="mb-3">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="mb-3">`. |
| `200` | `<label class="form-label">Contraseña actual (temporal)</label>` | Instrucción de ejecución en el contexto del script: `<label class="form-label">Contraseña actual (temporal)</label>`. |
| `201` | `<div class="input-group">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="input-group">`. |
| `202` | `<span class="input-group-text"><i class="fas fa-lock-open fa-sm"></i></s...` | Instrucción de ejecución en el contexto del script: `<span class="input-group-text"><i class="fas fa-lock-open fa-sm"></i></s...`. |
| `203` | `<input type="password" name="password_actual" id="passActual"` | Campo de entrada interactivo para datos del usuario: `<input type="password" name="password_actual" id="passActual"`. |
| `204` | `class="form-control" placeholder="Tu contraseña temporal" required>` | Instrucción de ejecución en el contexto del script: `class="form-control" placeholder="Tu contraseña temporal" required>`. |
| `205` | `<button type="button" class="btn btn-eye" onclick="togglePass('passActua...` | Botón de acción interactivo para el usuario: `<button type="button" class="btn btn-eye" onclick="togglePass('passActua...`. |
| `206` | `<i class="fas fa-eye fa-sm" id="eyeActual"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-eye fa-sm" id="eyeActual"></i>`. |
| `207` | `</button>` | Instrucción de ejecución en el contexto del script: `</button>`. |
| `208` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `209` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `210` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `211` | `<div class="mb-1">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="mb-1">`. |
| `212` | `<label class="form-label">Nueva contraseña</label>` | Instrucción de ejecución en el contexto del script: `<label class="form-label">Nueva contraseña</label>`. |
| `213` | `<div class="input-group">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="input-group">`. |
| `214` | `<span class="input-group-text"><i class="fas fa-lock fa-sm"></i></span>` | Instrucción de ejecución en el contexto del script: `<span class="input-group-text"><i class="fas fa-lock fa-sm"></i></span>`. |
| `215` | `<input type="password" name="password_nueva" id="passNueva"` | Campo de entrada interactivo para datos del usuario: `<input type="password" name="password_nueva" id="passNueva"`. |
| `216` | `class="form-control" placeholder="Mín. 8 caracteres"` | Instrucción de ejecución en el contexto del script: `class="form-control" placeholder="Mín. 8 caracteres"`. |
| `217` | `required oninput="checkReqs(this.value)">` | Instrucción de ejecución en el contexto del script: `required oninput="checkReqs(this.value)">`. |
| `218` | `<button type="button" class="btn btn-eye" onclick="togglePass('passNueva...` | Botón de acción interactivo para el usuario: `<button type="button" class="btn btn-eye" onclick="togglePass('passNueva...`. |
| `219` | `<i class="fas fa-eye fa-sm" id="eyeNueva"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-eye fa-sm" id="eyeNueva"></i>`. |
| `220` | `</button>` | Instrucción de ejecución en el contexto del script: `</button>`. |
| `221` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `222` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `223` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `224` | `<!-- Requisitos -->` | Instrucción de ejecución en el contexto del script: `<!-- Requisitos -->`. |
| `225` | `<div class="req-box">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="req-box">`. |
| `226` | `<div id="req-len"   class="req-item"><i class="fas fa-circle"></i> Al me...` | Contenedor visual estructurado con Bootstrap/CSS: `<div id="req-len"   class="req-item"><i class="fas fa-circle"></i> Al me...`. |
| `227` | `<div id="req-upper" class="req-item"><i class="fas fa-circle"></i> Al me...` | Contenedor visual estructurado con Bootstrap/CSS: `<div id="req-upper" class="req-item"><i class="fas fa-circle"></i> Al me...`. |
| `228` | `<div id="req-num"   class="req-item"><i class="fas fa-circle"></i> Al me...` | Contenedor visual estructurado con Bootstrap/CSS: `<div id="req-num"   class="req-item"><i class="fas fa-circle"></i> Al me...`. |
| `229` | `<div id="req-spec"  class="req-item"><i class="fas fa-circle"></i> Al me...` | Contenedor visual estructurado con Bootstrap/CSS: `<div id="req-spec"  class="req-item"><i class="fas fa-circle"></i> Al me...`. |
| `230` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `231` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `232` | `<div class="mb-4">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="mb-4">`. |
| `233` | `<label class="form-label">Confirmar nueva contraseña</label>` | Instrucción de ejecución en el contexto del script: `<label class="form-label">Confirmar nueva contraseña</label>`. |
| `234` | `<div class="input-group">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="input-group">`. |
| `235` | `<span class="input-group-text"><i class="fas fa-lock fa-sm"></i></span>` | Instrucción de ejecución en el contexto del script: `<span class="input-group-text"><i class="fas fa-lock fa-sm"></i></span>`. |
| `236` | `<input type="password" name="password_confirm" id="passConfirm"` | Campo de entrada interactivo para datos del usuario: `<input type="password" name="password_confirm" id="passConfirm"`. |
| `237` | `class="form-control" placeholder="Repite la contraseña" required>` | Instrucción de ejecución en el contexto del script: `class="form-control" placeholder="Repite la contraseña" required>`. |
| `238` | `<button type="button" class="btn btn-eye" onclick="togglePass('passConfi...` | Botón de acción interactivo para el usuario: `<button type="button" class="btn btn-eye" onclick="togglePass('passConfi...`. |
| `239` | `<i class="fas fa-eye fa-sm" id="eyeConfirm"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-eye fa-sm" id="eyeConfirm"></i>`. |
| `240` | `</button>` | Instrucción de ejecución en el contexto del script: `</button>`. |
| `241` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `242` | `<div id="passError" class="text-danger-soft d-none mt-2">` | Contenedor visual estructurado con Bootstrap/CSS: `<div id="passError" class="text-danger-soft d-none mt-2">`. |
| `243` | `<i class="fas fa-circle-exclamation me-1"></i> Las contraseñas no coinci...` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-circle-exclamation me-1"></i> Las contraseñas no coinci...`. |
| `244` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `245` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `246` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `247` | `<button type="submit" class="btn-guardar">` | Botón de acción interactivo para el usuario: `<button type="submit" class="btn-guardar">`. |
| `248` | `<i class="fas fa-shield-halved me-2"></i> Guardar nueva contraseña` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-shield-halved me-2"></i> Guardar nueva contraseña`. |
| `249` | `</button>` | Instrucción de ejecución en el contexto del script: `</button>`. |
| `250` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `251` | ``</form>`` | Cierre de formulario interactivo. |
| `252` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `253` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `254` | `<?php if ($alert): ?>` | Instrucción de ejecución en el contexto del script: `<?php if ($alert): ?>`. |
| `255` | ``<script>`` | Bloque o etiqueta de vinculación para scripts JavaScript del lado del cliente. |
| `256` | `document.addEventListener('DOMContentLoaded', function () {` | Registra un escucha de eventos del DOM para interactividad en tiempo real: `document.addEventListener('DOMContentLoaded', function () {`. |
| `257` | `Swal.fire({` | Despliega una alerta modal estética e interactiva con SweetAlert2. |
| `258` | `icon:  '<?= htmlspecialchars($alert['icon'])  ?>',` | Instrucción de ejecución en el contexto del script: `icon:  '<?= htmlspecialchars($alert['icon'])  ?>',`. |
| `259` | `title: '<?= htmlspecialchars($alert['title']) ?>',` | Instrucción de ejecución en el contexto del script: `title: '<?= htmlspecialchars($alert['title']) ?>',`. |
| `260` | `text:  '<?= htmlspecialchars($alert['text'])  ?>',` | Instrucción de ejecución en el contexto del script: `text:  '<?= htmlspecialchars($alert['text'])  ?>',`. |
| `261` | `confirmButtonColor: '#39a900'` | Instrucción de ejecución en el contexto del script: `confirmButtonColor: '#39a900'`. |
| `262` | `});` | Instrucción de ejecución en el contexto del script: `});`. |
| `263` | `});` | Instrucción de ejecución en el contexto del script: `});`. |
| `264` | ``</script>`` | Cierre de bloque de script JavaScript. |
| `265` | `<?php endif; ?>` | Cierre de estructura condicional embebida en la plantilla HTML. |
| `266` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `267` | ``<script>`` | Bloque o etiqueta de vinculación para scripts JavaScript del lado del cliente. |
| `268` | ``<script>`` | Bloque o etiqueta de vinculación para scripts JavaScript del lado del cliente. |
| `269` | `function togglePass(inputId, iconId) {` | Instrucción de ejecución en el contexto del script: `function togglePass(inputId, iconId) {`. |
| `270` | `const inp = document.getElementById(inputId);` | Instrucción de ejecución en el contexto del script: `const inp = document.getElementById(inputId);`. |
| `271` | `const ico = document.getElementById(iconId);` | Instrucción de ejecución en el contexto del script: `const ico = document.getElementById(iconId);`. |
| `272` | `inp.type = inp.type === 'password' ? 'text' : 'password';` | Instrucción de ejecución en el contexto del script: `inp.type = inp.type === 'password' ? 'text' : 'password';`. |
| `273` | `ico.classList.toggle('fa-eye');` | Instrucción de ejecución en el contexto del script: `ico.classList.toggle('fa-eye');`. |
| `274` | `ico.classList.toggle('fa-eye-slash');` | Instrucción de ejecución en el contexto del script: `ico.classList.toggle('fa-eye-slash');`. |
| `275` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `276` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `277` | `function checkReqs(val) {` | Instrucción de ejecución en el contexto del script: `function checkReqs(val) {`. |
| `278` | `const checks = {` | Instrucción de ejecución en el contexto del script: `const checks = {`. |
| `279` | `len:   val.length >= 8,` | Instrucción de ejecución en el contexto del script: `len:   val.length >= 8,`. |
| `280` | `upper: /[A-Z]/.test(val),` | Instrucción de ejecución en el contexto del script: `upper: /[A-Z]/.test(val),`. |
| `281` | `num:   /[0-9]/.test(val),` | Instrucción de ejecución en el contexto del script: `num:   /[0-9]/.test(val),`. |
| `282` | `spec:  /[\W_]/.test(val),` | Instrucción de ejecución en el contexto del script: `spec:  /[\W_]/.test(val),`. |
| `283` | `};` | Instrucción de ejecución en el contexto del script: `};`. |
| `284` | `for (const [k, v] of Object.entries(checks)) {` | Bucle iterativo `for` para repeticiones controladas: `for (const [k, v] of Object.entries(checks)) {`. |
| `285` | `const el = document.getElementById('req-' + k);` | Instrucción de ejecución en el contexto del script: `const el = document.getElementById('req-' + k);`. |
| `286` | `if (el) el.classList.toggle('ok', v);` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (el) el.classList.toggle('ok', v);`. |
| `287` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `288` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `289` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `290` | `document.getElementById('formCambio').addEventListener('submit', functio...` | Registra un escucha de eventos del DOM para interactividad en tiempo real: `document.getElementById('formCambio').addEventListener('submit', functio...`. |
| `291` | `const p1  = document.getElementById('passNueva').value;` | Instrucción de ejecución en el contexto del script: `const p1  = document.getElementById('passNueva').value;`. |
| `292` | `const p2  = document.getElementById('passConfirm').value;` | Instrucción de ejecución en el contexto del script: `const p2  = document.getElementById('passConfirm').value;`. |
| `293` | `const err = document.getElementById('passError');` | Instrucción de ejecución en el contexto del script: `const err = document.getElementById('passError');`. |
| `294` | `if (p1 !== p2) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (p1 !== p2) {`. |
| `295` | `e.preventDefault();` | Instrucción de ejecución en el contexto del script: `e.preventDefault();`. |
| `296` | `err.classList.remove('d-none');` | Instrucción de ejecución en el contexto del script: `err.classList.remove('d-none');`. |
| `297` | `document.getElementById('passConfirm').focus();` | Instrucción de ejecución en el contexto del script: `document.getElementById('passConfirm').focus();`. |
| `298` | `} else {` | Instrucción de ejecución en el contexto del script: `} else {`. |
| `299` | `err.classList.add('d-none');` | Instrucción de ejecución en el contexto del script: `err.classList.add('d-none');`. |
| `300` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `301` | `});` | Instrucción de ejecución en el contexto del script: `});`. |
| `302` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `303` | `document.getElementById('passConfirm').addEventListener('input', functio...` | Registra un escucha de eventos del DOM para interactividad en tiempo real: `document.getElementById('passConfirm').addEventListener('input', functio...`. |
| `304` | `const p1 = document.getElementById('passNueva').value;` | Instrucción de ejecución en el contexto del script: `const p1 = document.getElementById('passNueva').value;`. |
| `305` | `document.getElementById('passError').classList.toggle('d-none', this.val...` | Instrucción de ejecución en el contexto del script: `document.getElementById('passError').classList.toggle('d-none', this.val...`. |
| `306` | `});` | Instrucción de ejecución en el contexto del script: `});`. |
| `307` | ``</script>`` | Cierre de bloque de script JavaScript. |
| `308` | `</body>` | Instrucción de ejecución en el contexto del script: `</body>`. |
| `309` | `</html>` | Instrucción de ejecución en el contexto del script: `</html>`. |

---

## 3. Resumen y Flujo de Interacción

El archivo `cambiar_password.php` cumple un rol indispensable en `views/usuarios/cambiar_password.php`. 
Vista para el cambio obligatorio de contraseña en el primer acceso del usuario o recuperación de credenciales. Garantiza la robustez, el orden y la estabilidad de la arquitectura del proyecto `systemLimpieza`.

---

Generado automáticamente para el repositorio [johanrepizo/LimpiezaDeModulos](https://github.com/johanrepizo/LimpiezaDeModulos).
