# Documentación Línea por Línea: `views/usuarios/cambiar_password.php`

## 1. Ficha Técnica del Archivo

- **Archivo:** `cambiar_password.php`
- **Ruta en el proyecto:** `views/usuarios/cambiar_password.php`
- **Cantidad total de líneas:** `211`
- **Tipo de archivo:** `PHP`
- **Propósito general:** Vista para el cambio obligatorio de contraseña en el primer acceso del usuario o recuperación de credenciales.

---

## 2. Explicación Detallada Línea por Línea

A continuación se presenta cada línea de código numerada de forma consecutiva, acompañada de su fragmento exacto y la explicación exhaustiva de su funcionamiento y responsabilidad en el sistema:

| Línea | Código Fuente | Explicación Detallada |
|---|---|---|
| `1` | `<?php` | Apertura obligatoria de la etiqueta PHP para ejecución del código del lado del servidor. |
| `2` | `session_start();` | Inicia o reanuda la sesión PHP del usuario si no se encontraba activa previamente. |
| `3` | `if (!isset($_SESSION['usuario'])) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (!isset($_SESSION['usuario'])) {`. |
| `4` | `    header("Location: login.php"); exit;` | Emite cabecera HTTP de redirección en el navegador: `header("Location: login.php"); exit;`. |
| `5` | `}` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `6` | `// Solo voceros en primer acceso` | Comentario de línea explicativo: `Solo voceros en primer acceso`. |
| `7` | `if ((int)$_SESSION['usuario']['rol'] !== 2) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if ((int)$_SESSION['usuario']['rol'] !== 2) {`. |
| `8` | `    header("Location: ../dashboard/admin_dashboard.php"); exit;` | Emite cabecera HTTP de redirección en el navegador: `header("Location: ../dashboard/admin_dashboard.php"); exit;`. |
| `9` | `}` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `10` | `$alert = $_SESSION['alert'] ?? null;` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección: `$alert = $_SESSION['alert'] ?? null;`. |
| `11` | `unset($_SESSION['alert']);` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección: `unset($_SESSION['alert']);`. |
| `12` | `?>` | Cierre de la etiqueta PHP para alternar a salida HTML o fin del archivo. |
| `13` | `<!DOCTYPE html>` | Declaración estándar del tipo de documento HTML5. |
| `14` | `<html lang="es">` | Etiqueta raíz que delimita el documento HTML. |
| `15` | `<head>` | Cabecera del documento web para inclusión de metadatos, fuentes y hojas de estilo. |
| `16` | `    <meta charset="UTF-8">` | Metadato de configuración de la página (charset, viewport, etc.): `<meta charset="UTF-8">`. |
| `17` | `    <meta name="viewport" content="width=device-width, initial-scale=1.0">` | Metadato de configuración de la página (charset, viewport, etc.): `<meta name="viewport" content="width=device-width, initial-scale=1.0">`. |
| `18` | `    <title>Cambio de Contraseña – GestiLimpieza SENA</title>` | Título de la pestaña de navegación de la página web: `<title>Cambio de Contraseña – GestiLimpieza SENA</title>`. |
| `19` | `    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/boots...` | Enlace externo a recursos de estilo CSS o fuentes web: `<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">`. |
| `20` | `    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fon...` | Enlace externo a recursos de estilo CSS o fuentes web: `<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">`. |
| `21` | `    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600...` | Enlace externo a recursos de estilo CSS o fuentes web: `<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">`. |
| `22` | `    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>` | Bloque o etiqueta de vinculación para scripts JavaScript del lado del cliente. |
| `23` | `    <style>` | Instrucción de ejecución en el contexto del script: `<style>`. |
| `24` | `        :root { --sena-green:#39a900; --bg-dark:#071200; --panel-dark:#0f22...` | Instrucción de ejecución en el contexto del script: `:root { --sena-green:#39a900; --bg-dark:#071200; --panel-dark:#0f2200; }`. |
| `25` | `        body {` | Instrucción de ejecución en el contexto del script: `body {`. |
| `26` | `            background: var(--bg-dark);` | Instrucción de ejecución en el contexto del script: `background: var(--bg-dark);`. |
| `27` | `            min-height: 100vh;` | Instrucción de ejecución en el contexto del script: `min-height: 100vh;`. |
| `28` | `            font-family: 'Inter', sans-serif; color: #f0fff0;` | Instrucción de ejecución en el contexto del script: `font-family: 'Inter', sans-serif; color: #f0fff0;`. |
| `29` | `            display: flex; align-items: center; justify-content: center; pa...` | Instrucción de ejecución en el contexto del script: `display: flex; align-items: center; justify-content: center; padding: 1rem;`. |
| `30` | `        }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `31` | `        .change-card {` | Instrucción de ejecución en el contexto del script: `.change-card {`. |
| `32` | `            max-width: 480px; width: 100%;` | Instrucción de ejecución en el contexto del script: `max-width: 480px; width: 100%;`. |
| `33` | `            background: var(--panel-dark);` | Instrucción de ejecución en el contexto del script: `background: var(--panel-dark);`. |
| `34` | `            border-radius: 20px; padding: 2.5rem;` | Instrucción de ejecución en el contexto del script: `border-radius: 20px; padding: 2.5rem;`. |
| `35` | `            border: 1px solid rgba(57,169,0,.12);` | Instrucción de ejecución en el contexto del script: `border: 1px solid rgba(57,169,0,.12);`. |
| `36` | `            box-shadow: 0 20px 40px rgba(0,0,0,.5);` | Instrucción de ejecución en el contexto del script: `box-shadow: 0 20px 40px rgba(0,0,0,.5);`. |
| `37` | `        }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `38` | `        .icon-box {` | Instrucción de ejecución en el contexto del script: `.icon-box {`. |
| `39` | `            width: 56px; height: 56px; border-radius: 14px;` | Instrucción de ejecución en el contexto del script: `width: 56px; height: 56px; border-radius: 14px;`. |
| `40` | `            background: rgba(57,169,0,.15);` | Instrucción de ejecución en el contexto del script: `background: rgba(57,169,0,.15);`. |
| `41` | `            border: 1px solid rgba(57,169,0,.2);` | Instrucción de ejecución en el contexto del script: `border: 1px solid rgba(57,169,0,.2);`. |
| `42` | `            display: flex; align-items: center; justify-content: center;` | Instrucción de ejecución en el contexto del script: `display: flex; align-items: center; justify-content: center;`. |
| `43` | `            font-size: 1.5rem; color: var(--sena-green);` | Instrucción de ejecución en el contexto del script: `font-size: 1.5rem; color: var(--sena-green);`. |
| `44` | `            margin: 0 auto 1.5rem;` | Instrucción de ejecución en el contexto del script: `margin: 0 auto 1.5rem;`. |
| `45` | `        }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `46` | `        .form-label { font-size:.83rem; font-weight:600; color:#c0dcc0; mar...` | Instrucción de ejecución en el contexto del script: `.form-label { font-size:.83rem; font-weight:600; color:#c0dcc0; margin-bottom:.4rem; }`. |
| `47` | `        .input-group-text {` | Instrucción de ejecución en el contexto del script: `.input-group-text {`. |
| `48` | `            background:rgba(7,18,0,.6); border:1px solid rgba(57,169,0,.15);` | Instrucción de ejecución en el contexto del script: `background:rgba(7,18,0,.6); border:1px solid rgba(57,169,0,.15);`. |
| `49` | `            border-right:0; color:var(--sena-green);` | Instrucción de ejecución en el contexto del script: `border-right:0; color:var(--sena-green);`. |
| `50` | `        }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `51` | `        .form-control {` | Instrucción de ejecución en el contexto del script: `.form-control {`. |
| `52` | `            background:rgba(7,18,0,.6); border:1px solid rgba(57,169,0,.15);` | Instrucción de ejecución en el contexto del script: `background:rgba(7,18,0,.6); border:1px solid rgba(57,169,0,.15);`. |
| `53` | `            border-left:0; color:#fff; padding:.72rem 1rem;` | Instrucción de ejecución en el contexto del script: `border-left:0; color:#fff; padding:.72rem 1rem;`. |
| `54` | `        }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `55` | `        .form-control:focus { background:rgba(7,18,0,.8); box-shadow:none; ...` | Instrucción de ejecución en el contexto del script: `.form-control:focus { background:rgba(7,18,0,.8); box-shadow:none; border-color:var(--sena-green); color:#fff; }`. |
| `56` | `        .form-control::placeholder { color:#3a6030; }` | Instrucción de ejecución en el contexto del script: `.form-control::placeholder { color:#3a6030; }`. |
| `57` | `        .btn-eye {` | Instrucción de ejecución en el contexto del script: `.btn-eye {`. |
| `58` | `            background:rgba(7,18,0,.6); border:1px solid rgba(57,169,0,.15);` | Instrucción de ejecución en el contexto del script: `background:rgba(7,18,0,.6); border:1px solid rgba(57,169,0,.15);`. |
| `59` | `            border-left:0; color:#5a8a50;` | Instrucción de ejecución en el contexto del script: `border-left:0; color:#5a8a50;`. |
| `60` | `        }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `61` | `        .btn-eye:hover { color:var(--sena-green); }` | Instrucción de ejecución en el contexto del script: `.btn-eye:hover { color:var(--sena-green); }`. |
| `62` | `        .btn-guardar {` | Instrucción de ejecución en el contexto del script: `.btn-guardar {`. |
| `63` | `            background:var(--sena-green); color:#fff; border:none;` | Instrucción de ejecución en el contexto del script: `background:var(--sena-green); color:#fff; border:none;`. |
| `64` | `            border-radius:8px; font-size:1rem; font-weight:600;` | Instrucción de ejecución en el contexto del script: `border-radius:8px; font-size:1rem; font-weight:600;`. |
| `65` | `            padding:.75rem; width:100%; transition:all .3s;` | Instrucción de ejecución en el contexto del script: `padding:.75rem; width:100%; transition:all .3s;`. |
| `66` | `            box-shadow: 0 4px 15px rgba(57,169,0,.35);` | Instrucción de ejecución en el contexto del script: `box-shadow: 0 4px 15px rgba(57,169,0,.35);`. |
| `67` | `        }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `68` | `        .btn-guardar:hover { background:#2d8700; transform:translateY(-2px); }` | Instrucción de ejecución en el contexto del script: `.btn-guardar:hover { background:#2d8700; transform:translateY(-2px); }`. |
| `69` | `        .req-item { font-size:.78rem; color:#3a6030; margin-bottom:.2rem; t...` | Instrucción de ejecución en el contexto del script: `.req-item { font-size:.78rem; color:#3a6030; margin-bottom:.2rem; transition:color .2s; }`. |
| `70` | `        .req-item.ok { color:#39a900; }` | Instrucción de ejecución en el contexto del script: `.req-item.ok { color:#39a900; }`. |
| `71` | `        .req-box {` | Instrucción de ejecución en el contexto del script: `.req-box {`. |
| `72` | `            background:rgba(7,18,0,.4); border-radius:8px; padding:.8rem 1rem;` | Instrucción de ejecución en el contexto del script: `background:rgba(7,18,0,.4); border-radius:8px; padding:.8rem 1rem;`. |
| `73` | `            border:1px solid rgba(57,169,0,.1); margin-bottom:1rem;` | Instrucción de ejecución en el contexto del script: `border:1px solid rgba(57,169,0,.1); margin-bottom:1rem;`. |
| `74` | `        }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `75` | `        .alert-warning-custom {` | Instrucción de ejecución en el contexto del script: `.alert-warning-custom {`. |
| `76` | `            background:rgba(234,179,8,.1); border:1px solid rgba(234,179,8,...` | Instrucción de ejecución en el contexto del script: `background:rgba(234,179,8,.1); border:1px solid rgba(234,179,8,.3);`. |
| `77` | `            border-radius:10px; padding:1rem; color:#fbbf24; font-size:.85rem;` | Instrucción de ejecución en el contexto del script: `border-radius:10px; padding:1rem; color:#fbbf24; font-size:.85rem;`. |
| `78` | `            margin-bottom:1.5rem;` | Instrucción de ejecución en el contexto del script: `margin-bottom:1.5rem;`. |
| `79` | `        }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `80` | `    </style>` | Instrucción de ejecución en el contexto del script: `</style>`. |
| `81` | `</head>` | Cabecera del documento web para inclusión de metadatos, fuentes y hojas de estilo. |
| `82` | `<body>` | Cuerpo principal donde se renderiza la interfaz visual del usuario. |
| `83` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `84` | `<div class="change-card">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="change-card">`. |
| `85` | `    <div class="icon-box"><i class="fas fa-key"></i></div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="icon-box"><i class="fas fa-key"></i></div>`. |
| `86` | `    <h5 class="text-center fw-bold mb-1" style="color:#fff;">Cambio de Cont...` | Instrucción de ejecución en el contexto del script: `<h5 class="text-center fw-bold mb-1" style="color:#fff;">Cambio de Contraseña Obligatorio</h5>`. |
| `87` | `    <p class="text-center mb-4" style="color:#5a8a50; font-size:.88rem;">` | Instrucción de ejecución en el contexto del script: `<p class="text-center mb-4" style="color:#5a8a50; font-size:.88rem;">`. |
| `88` | `        Por seguridad debes cambiar tu contraseña temporal antes de continuar.` | Instrucción de ejecución en el contexto del script: `Por seguridad debes cambiar tu contraseña temporal antes de continuar.`. |
| `89` | `    </p>` | Instrucción de ejecución en el contexto del script: `</p>`. |
| `90` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `91` | `    <div class="alert-warning-custom">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="alert-warning-custom">`. |
| `92` | `        <i class="fas fa-triangle-exclamation me-2"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-triangle-exclamation me-2"></i>`. |
| `93` | `        No podrás acceder al sistema hasta completar este paso.` | Instrucción de ejecución en el contexto del script: `No podrás acceder al sistema hasta completar este paso.`. |
| `94` | `    </div>` | Cierre de contenedor visual `<div>`. |
| `95` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `96` | `    <form action="../../controllers/AuthController.php?accion=cambiar_passw...` | Formulario para recolección y envío de datos del usuario: `<form action="../../controllers/AuthController.php?accion=cambiar_password" method="POST" id="formCambio">`. |
| `97` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `98` | `        <div class="mb-4">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="mb-4">`. |
| `99` | `            <label class="form-label">Contraseña Actual (temporal)</label>` | Instrucción de ejecución en el contexto del script: `<label class="form-label">Contraseña Actual (temporal)</label>`. |
| `100` | `            <div class="input-group">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="input-group">`. |
| `101` | `                <span class="input-group-text"><i class="fas fa-lock-open">...` | Instrucción de ejecución en el contexto del script: `<span class="input-group-text"><i class="fas fa-lock-open"></i></span>`. |
| `102` | `                <input type="password" name="password_actual" id="passActual"` | Campo de entrada interactivo para datos del usuario: `<input type="password" name="password_actual" id="passActual"`. |
| `103` | `                       class="form-control" placeholder="Tu contraseña temp...` | Instrucción de ejecución en el contexto del script: `class="form-control" placeholder="Tu contraseña temporal" required>`. |
| `104` | `                <button type="button" class="btn btn-eye"` | Botón de acción interactivo para el usuario: `<button type="button" class="btn btn-eye"`. |
| `105` | `                        onclick="togglePass('passActual','eyeActual')">` | Instrucción de ejecución en el contexto del script: `onclick="togglePass('passActual','eyeActual')">`. |
| `106` | `                    <i class="fas fa-eye" id="eyeActual"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-eye" id="eyeActual"></i>`. |
| `107` | `                </button>` | Botón de acción interactivo para el usuario: `</button>`. |
| `108` | `            </div>` | Cierre de contenedor visual `<div>`. |
| `109` | `        </div>` | Cierre de contenedor visual `<div>`. |
| `110` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `111` | `        <div class="mb-3">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="mb-3">`. |
| `112` | `            <label class="form-label">Nueva Contraseña</label>` | Instrucción de ejecución en el contexto del script: `<label class="form-label">Nueva Contraseña</label>`. |
| `113` | `            <div class="input-group mb-2">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="input-group mb-2">`. |
| `114` | `                <span class="input-group-text"><i class="fas fa-lock"></i><...` | Instrucción de ejecución en el contexto del script: `<span class="input-group-text"><i class="fas fa-lock"></i></span>`. |
| `115` | `                <input type="password" name="password_nueva" id="passNueva"` | Campo de entrada interactivo para datos del usuario: `<input type="password" name="password_nueva" id="passNueva"`. |
| `116` | `                       class="form-control" placeholder="Mín. 8 caracteres"` | Instrucción de ejecución en el contexto del script: `class="form-control" placeholder="Mín. 8 caracteres"`. |
| `117` | `                       required oninput="checkReqs(this.value)">` | Instrucción de ejecución en el contexto del script: `required oninput="checkReqs(this.value)">`. |
| `118` | `                <button type="button" class="btn btn-eye"` | Botón de acción interactivo para el usuario: `<button type="button" class="btn btn-eye"`. |
| `119` | `                        onclick="togglePass('passNueva','eyeNueva')">` | Instrucción de ejecución en el contexto del script: `onclick="togglePass('passNueva','eyeNueva')">`. |
| `120` | `                    <i class="fas fa-eye" id="eyeNueva"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-eye" id="eyeNueva"></i>`. |
| `121` | `                </button>` | Botón de acción interactivo para el usuario: `</button>`. |
| `122` | `            </div>` | Cierre de contenedor visual `<div>`. |
| `123` | `            <!-- Requisitos -->` | Instrucción de ejecución en el contexto del script: `<!-- Requisitos -->`. |
| `124` | `            <div class="req-box">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="req-box">`. |
| `125` | `                <div id="req-len"   class="req-item"><i class="fas fa-circl...` | Contenedor visual estructurado con Bootstrap/CSS: `<div id="req-len"   class="req-item"><i class="fas fa-circle me-1" style="font-size:.45rem;"></i> Al menos 8 caracteres</div>`. |
| `126` | `                <div id="req-upper" class="req-item"><i class="fas fa-circl...` | Contenedor visual estructurado con Bootstrap/CSS: `<div id="req-upper" class="req-item"><i class="fas fa-circle me-1" style="font-size:.45rem;"></i> Al menos una letra mayúscula</div>`. |
| `127` | `                <div id="req-num"   class="req-item"><i class="fas fa-circl...` | Contenedor visual estructurado con Bootstrap/CSS: `<div id="req-num"   class="req-item"><i class="fas fa-circle me-1" style="font-size:.45rem;"></i> Al menos un número</div>`. |
| `128` | `                <div id="req-spec"  class="req-item"><i class="fas fa-circl...` | Contenedor visual estructurado con Bootstrap/CSS: `<div id="req-spec"  class="req-item"><i class="fas fa-circle me-1" style="font-size:.45rem;"></i> Al menos un carácter especial (!@#$...)</div>`. |
| `129` | `            </div>` | Cierre de contenedor visual `<div>`. |
| `130` | `        </div>` | Cierre de contenedor visual `<div>`. |
| `131` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `132` | `        <div class="mb-4">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="mb-4">`. |
| `133` | `            <label class="form-label">Confirmar Nueva Contraseña</label>` | Instrucción de ejecución en el contexto del script: `<label class="form-label">Confirmar Nueva Contraseña</label>`. |
| `134` | `            <div class="input-group">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="input-group">`. |
| `135` | `                <span class="input-group-text"><i class="fas fa-lock"></i><...` | Instrucción de ejecución en el contexto del script: `<span class="input-group-text"><i class="fas fa-lock"></i></span>`. |
| `136` | `                <input type="password" name="password_confirm" id="passConf...` | Campo de entrada interactivo para datos del usuario: `<input type="password" name="password_confirm" id="passConfirm"`. |
| `137` | `                       class="form-control" placeholder="Repite la contrase...` | Instrucción de ejecución en el contexto del script: `class="form-control" placeholder="Repite la contraseña" required>`. |
| `138` | `                <button type="button" class="btn btn-eye"` | Botón de acción interactivo para el usuario: `<button type="button" class="btn btn-eye"`. |
| `139` | `                        onclick="togglePass('passConfirm','eyeConfirm')">` | Instrucción de ejecución en el contexto del script: `onclick="togglePass('passConfirm','eyeConfirm')">`. |
| `140` | `                    <i class="fas fa-eye" id="eyeConfirm"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-eye" id="eyeConfirm"></i>`. |
| `141` | `                </button>` | Botón de acción interactivo para el usuario: `</button>`. |
| `142` | `            </div>` | Cierre de contenedor visual `<div>`. |
| `143` | `            <div id="passError" class="text-danger d-none mt-2" style="font...` | Contenedor visual estructurado con Bootstrap/CSS: `<div id="passError" class="text-danger d-none mt-2" style="font-size:.8rem;">`. |
| `144` | `                <i class="fas fa-circle-exclamation me-1"></i> Las contrase...` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-circle-exclamation me-1"></i> Las contraseñas no coinciden.`. |
| `145` | `            </div>` | Cierre de contenedor visual `<div>`. |
| `146` | `        </div>` | Cierre de contenedor visual `<div>`. |
| `147` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `148` | `        <button type="submit" class="btn-guardar">` | Botón de acción interactivo para el usuario: `<button type="submit" class="btn-guardar">`. |
| `149` | `            <i class="fas fa-shield-halved me-2"></i> Guardar Nueva Contraseña` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-shield-halved me-2"></i> Guardar Nueva Contraseña`. |
| `150` | `        </button>` | Botón de acción interactivo para el usuario: `</button>`. |
| `151` | `    </form>` | Cierre de formulario HTML. |
| `152` | `</div>` | Cierre de contenedor visual `<div>`. |
| `153` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `154` | `<?php if ($alert): ?>` | Instrucción de ejecución en el contexto del script: `<?php if ($alert): ?>`. |
| `155` | `<script>` | Bloque o etiqueta de vinculación para scripts JavaScript del lado del cliente. |
| `156` | `    document.addEventListener('DOMContentLoaded', function () {` | Declaración de método o función con su firma y parámetros: `document.addEventListener('DOMContentLoaded', function () {`. |
| `157` | `        Swal.fire({` | Instrucción de ejecución en el contexto del script: `Swal.fire({`. |
| `158` | `            icon:  '<?= htmlspecialchars($alert['icon'])  ?>',` | Instrucción de ejecución en el contexto del script: `icon:  '<?= htmlspecialchars($alert['icon'])  ?>',`. |
| `159` | `            title: '<?= htmlspecialchars($alert['title']) ?>',` | Instrucción de ejecución en el contexto del script: `title: '<?= htmlspecialchars($alert['title']) ?>',`. |
| `160` | `            text:  '<?= htmlspecialchars($alert['text'])  ?>',` | Instrucción de ejecución en el contexto del script: `text:  '<?= htmlspecialchars($alert['text'])  ?>',`. |
| `161` | `            confirmButtonColor: '#39a900',` | Instrucción de ejecución en el contexto del script: `confirmButtonColor: '#39a900',`. |
| `162` | `            background: '#0f2200',` | Instrucción de ejecución en el contexto del script: `background: '#0f2200',`. |
| `163` | `            color: '#f0fff0'` | Instrucción de ejecución en el contexto del script: `color: '#f0fff0'`. |
| `164` | `        });` | Instrucción de ejecución en el contexto del script: `});`. |
| `165` | `    });` | Instrucción de ejecución en el contexto del script: `});`. |
| `166` | `</script>` | Bloque o etiqueta de vinculación para scripts JavaScript del lado del cliente. |
| `167` | `<?php endif; ?>` | Instrucción de ejecución en el contexto del script: `<?php endif; ?>`. |
| `168` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `169` | `<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap...` | Bloque o etiqueta de vinculación para scripts JavaScript del lado del cliente. |
| `170` | `<script>` | Bloque o etiqueta de vinculación para scripts JavaScript del lado del cliente. |
| `171` | `function togglePass(inputId, iconId) {` | Declaración de método o función con su firma y parámetros: `function togglePass(inputId, iconId) {`. |
| `172` | `    const inp = document.getElementById(inputId);` | Instrucción de ejecución en el contexto del script: `const inp = document.getElementById(inputId);`. |
| `173` | `    const ico = document.getElementById(iconId);` | Instrucción de ejecución en el contexto del script: `const ico = document.getElementById(iconId);`. |
| `174` | `    inp.type = inp.type === 'password' ? 'text' : 'password';` | Instrucción de ejecución en el contexto del script: `inp.type = inp.type === 'password' ? 'text' : 'password';`. |
| `175` | `    ico.classList.toggle('fa-eye');` | Instrucción de ejecución en el contexto del script: `ico.classList.toggle('fa-eye');`. |
| `176` | `    ico.classList.toggle('fa-eye-slash');` | Instrucción de ejecución en el contexto del script: `ico.classList.toggle('fa-eye-slash');`. |
| `177` | `}` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `178` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `179` | `function checkReqs(val) {` | Declaración de método o función con su firma y parámetros: `function checkReqs(val) {`. |
| `180` | `    const checks = {` | Instrucción de ejecución en el contexto del script: `const checks = {`. |
| `181` | `        len:   val.length >= 8,` | Instrucción de ejecución en el contexto del script: `len:   val.length >= 8,`. |
| `182` | `        upper: /[A-Z]/.test(val),` | Instrucción de ejecución en el contexto del script: `upper: /[A-Z]/.test(val),`. |
| `183` | `        num:   /[0-9]/.test(val),` | Instrucción de ejecución en el contexto del script: `num:   /[0-9]/.test(val),`. |
| `184` | `        spec:  /[\W_]/.test(val),` | Instrucción de ejecución en el contexto del script: `spec:  /[\W_]/.test(val),`. |
| `185` | `    };` | Instrucción de ejecución en el contexto del script: `};`. |
| `186` | `    for (const [k, v] of Object.entries(checks)) {` | Instrucción de ejecución en el contexto del script: `for (const [k, v] of Object.entries(checks)) {`. |
| `187` | `        const el = document.getElementById('req-' + k);` | Instrucción de ejecución en el contexto del script: `const el = document.getElementById('req-' + k);`. |
| `188` | `        if (el) el.classList.toggle('ok', v);` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (el) el.classList.toggle('ok', v);`. |
| `189` | `    }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `190` | `}` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `191` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `192` | `document.getElementById('formCambio').addEventListener('submit', function(e) {` | Instrucción de ejecución en el contexto del script: `document.getElementById('formCambio').addEventListener('submit', function(e) {`. |
| `193` | `    const p1  = document.getElementById('passNueva').value;` | Instrucción de ejecución en el contexto del script: `const p1  = document.getElementById('passNueva').value;`. |
| `194` | `    const p2  = document.getElementById('passConfirm').value;` | Instrucción de ejecución en el contexto del script: `const p2  = document.getElementById('passConfirm').value;`. |
| `195` | `    const err = document.getElementById('passError');` | Instrucción de ejecución en el contexto del script: `const err = document.getElementById('passError');`. |
| `196` | `    if (p1 !== p2) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (p1 !== p2) {`. |
| `197` | `        e.preventDefault();` | Instrucción de ejecución en el contexto del script: `e.preventDefault();`. |
| `198` | `        err.classList.remove('d-none');` | Instrucción de ejecución en el contexto del script: `err.classList.remove('d-none');`. |
| `199` | `        document.getElementById('passConfirm').focus();` | Instrucción de ejecución en el contexto del script: `document.getElementById('passConfirm').focus();`. |
| `200` | `    } else {` | Bloque alternativo `else`: se ejecuta si ninguna condición previa resultó verdadera. |
| `201` | `        err.classList.add('d-none');` | Instrucción de ejecución en el contexto del script: `err.classList.add('d-none');`. |
| `202` | `    }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `203` | `});` | Instrucción de ejecución en el contexto del script: `});`. |
| `204` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `205` | `document.getElementById('passConfirm').addEventListener('input', function () {` | Declaración de método o función con su firma y parámetros: `document.getElementById('passConfirm').addEventListener('input', function () {`. |
| `206` | `    const p1 = document.getElementById('passNueva').value;` | Instrucción de ejecución en el contexto del script: `const p1 = document.getElementById('passNueva').value;`. |
| `207` | `    document.getElementById('passError').classList.toggle('d-none', this.va...` | Instrucción de ejecución en el contexto del script: `document.getElementById('passError').classList.toggle('d-none', this.value === p1 \|\| this.value === '');`. |
| `208` | `});` | Instrucción de ejecución en el contexto del script: `});`. |
| `209` | `</script>` | Bloque o etiqueta de vinculación para scripts JavaScript del lado del cliente. |
| `210` | `</body>` | Cuerpo principal donde se renderiza la interfaz visual del usuario. |
| `211` | `</html>` | Etiqueta raíz que delimita el documento HTML. |

---

## 3. Resumen y Flujo de Interacción

El archivo `cambiar_password.php` cumple un rol indispensable en `views/usuarios/cambiar_password.php`. 
Vista para el cambio obligatorio de contraseña en el primer acceso del usuario o recuperación de credenciales. Garantiza la robustez, el orden y la estabilidad de la arquitectura del proyecto `systemLimpieza`.
