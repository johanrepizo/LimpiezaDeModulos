# Documentación Línea por Línea: `controllers/AuthController.php`

## 1. Ficha Técnica del Archivo

- **Archivo:** `AuthController.php`
- **Ruta en el proyecto:** `controllers/AuthController.php`
- **Cantidad total de líneas:** `212`
- **Tipo de archivo:** `PHP`
- **Propósito general:** Controlador de autenticación y seguridad. Gestiona inicio de sesión, verificación de roles, cambio obligatorio de contraseña y cierre de sesión seguro.

---

## 2. Explicación Detallada Línea por Línea

A continuación se presenta cada línea de código numerada de forma consecutiva, acompañada de su fragmento exacto y la explicación exhaustiva de su funcionamiento y responsabilidad en el sistema:

| Línea | Código Fuente | Explicación Detallada |
|---|---|---|
| `1` | ``<?php`` | Apertura obligatoria de la etiqueta PHP para ejecución del código del lado del servidor. |
| `2` | `if (session_status() === PHP_SESSION_NONE) session_start();` | Inicia o reanuda la sesión PHP del usuario si no se encontraba activa previamente. |
| `3` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `4` | `require_once __DIR__ . '/../config/database.php';` | Importación e inclusión obligatoria del archivo de dependencia requerido: `require_once __DIR__ . '/../config/database.php';`. |
| `5` | `require_once __DIR__ . '/../models/Usuario.php';` | Importación e inclusión obligatoria del archivo de dependencia requerido: `require_once __DIR__ . '/../models/Usuario.php';`. |
| `6` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `7` | `class AuthController` | Declaración de la clase del componente: `class AuthController`. |
| `8` | ``{`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `9` | `// ── LOGIN ──────────────────────────────────────────────────────────────` | Comentario explicativo en el código: `── LOGIN ──────────────────────────────────────────────────────────────`. |
| `10` | `public function login(): void` | Declaración de método o función con su firma y parámetros: `public function login(): void`. |
| `11` | ``{`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `12` | `if ($_SERVER['REQUEST_METHOD'] !== 'POST') {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if ($_SERVER['REQUEST_METHOD'] !== 'POST') {`. |
| `13` | `header("Location: ../views/usuarios/login.php");` | Emite cabecera HTTP de respuesta hacia el cliente: `header("Location: ../views/usuarios/login.php");`. |
| `14` | `exit;` | Finaliza la ejecución de la función o script. |
| `15` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `16` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `17` | `$correo   = trim($_POST['correo']   ?? '');` | Instrucción de ejecución en el contexto del script: `$correo   = trim($_POST['correo']   ?? '');`. |
| `18` | `$password = trim($_POST['password'] ?? '');` | Instrucción de ejecución en el contexto del script: `$password = trim($_POST['password'] ?? '');`. |
| `19` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `20` | `if (empty($correo) \|\| empty($password)) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (empty($correo) \|\| empty($password)) {`. |
| `21` | `$_SESSION['alert'] = ['icon'=>'warning','title'=>'Campos incompletos','t...` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección. |
| `22` | `header("Location: ../views/usuarios/login.php"); exit;` | Emite cabecera HTTP de redirección en el navegador y detiene la ejecución: `header("Location: ../views/usuarios/login.php"); exit;`. |
| `23` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `24` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `25` | `$db      = (new Database())->conectar();` | Instrucción de ejecución en el contexto del script: `$db      = (new Database())->conectar();`. |
| `26` | `$model   = new Usuario($db);` | Instrucción de ejecución en el contexto del script: `$model   = new Usuario($db);`. |
| `27` | `$usuario = $model->obtenerPorEmail($correo);` | Instrucción de ejecución en el contexto del script: `$usuario = $model->obtenerPorEmail($correo);`. |
| `28` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `29` | `if (!$usuario) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (!$usuario) {`. |
| `30` | `$_SESSION['alert'] = ['icon'=>'error','title'=>'Acceso denegado','text'=...` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección. |
| `31` | `header("Location: ../views/usuarios/login.php"); exit;` | Emite cabecera HTTP de redirección en el navegador y detiene la ejecución: `header("Location: ../views/usuarios/login.php"); exit;`. |
| `32` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `33` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `34` | `if ((int)$usuario['activo'] === 0) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if ((int)$usuario['activo'] === 0) {`. |
| `35` | `$_SESSION['alert'] = ['icon'=>'error','title'=>'Cuenta inactiva','text'=...` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección. |
| `36` | `header("Location: ../views/usuarios/login.php"); exit;` | Emite cabecera HTTP de redirección en el navegador y detiene la ejecución: `header("Location: ../views/usuarios/login.php"); exit;`. |
| `37` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `38` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `39` | `if (!empty($usuario['bloqueado_hasta']) && strtotime($usuario['bloqueado...` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (!empty($usuario['bloqueado_hasta']) && strtotime($usuario['bloqueado...`. |
| `40` | `$minutos = ceil((strtotime($usuario['bloqueado_hasta']) - time()) / 60);` | Instrucción de ejecución en el contexto del script: `$minutos = ceil((strtotime($usuario['bloqueado_hasta']) - time()) / 60);`. |
| `41` | `$_SESSION['alert'] = [` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección. |
| `42` | `'icon'  => 'error',` | Instrucción de ejecución en el contexto del script: `'icon'  => 'error',`. |
| `43` | `'title' => 'Cuenta bloqueada',` | Instrucción de ejecución en el contexto del script: `'title' => 'Cuenta bloqueada',`. |
| `44` | `'text'  => "Demasiados intentos fallidos. Intenta de nuevo en {$minutos}...` | Instrucción de ejecución en el contexto del script: `'text'  => "Demasiados intentos fallidos. Intenta de nuevo en {$minutos}...`. |
| `45` | ``];`` | Cierre de estructura de arreglo o invocación de función. |
| `46` | `header("Location: ../views/usuarios/login.php"); exit;` | Emite cabecera HTTP de redirección en el navegador y detiene la ejecución: `header("Location: ../views/usuarios/login.php"); exit;`. |
| `47` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `48` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `49` | `if (!password_verify($password, $usuario['password'])) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (!password_verify($password, $usuario['password'])) {`. |
| `50` | `$model->registrarIntentoFallido($usuario['id_usuario']);` | Instrucción de ejecución en el contexto del script: `$model->registrarIntentoFallido($usuario['id_usuario']);`. |
| `51` | `// Re-leer para saber cuántos intentos quedan` | Comentario explicativo en el código: `Re-leer para saber cuántos intentos quedan`. |
| `52` | `$actualizado = $model->obtenerPorId($usuario['id_usuario']);` | Instrucción de ejecución en el contexto del script: `$actualizado = $model->obtenerPorId($usuario['id_usuario']);`. |
| `53` | `$intentos    = (int)($actualizado['intentos_fallidos'] ?? 0);` | Instrucción de ejecución en el contexto del script: `$intentos    = (int)($actualizado['intentos_fallidos'] ?? 0);`. |
| `54` | `$restantes   = max(0, 3 - $intentos);` | Instrucción de ejecución en el contexto del script: `$restantes   = max(0, 3 - $intentos);`. |
| `55` | `$texto = $restantes > 0` | Instrucción de ejecución en el contexto del script: `$texto = $restantes > 0`. |
| `56` | `? "Usuario o contraseña incorrectos. Te quedan {$restantes} intento(s)."` | Instrucción de ejecución en el contexto del script: `? "Usuario o contraseña incorrectos. Te quedan {$restantes} intento(s)."`. |
| `57` | `: "Demasiados intentos fallidos. Tu cuenta ha sido bloqueada temporalmen...` | Instrucción de ejecución en el contexto del script: `: "Demasiados intentos fallidos. Tu cuenta ha sido bloqueada temporalmen...`. |
| `58` | `$_SESSION['alert'] = ['icon'=>'error','title'=>'Acceso denegado','text'=...` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección. |
| `59` | `header("Location: ../views/usuarios/login.php"); exit;` | Emite cabecera HTTP de redirección en el navegador y detiene la ejecución: `header("Location: ../views/usuarios/login.php"); exit;`. |
| `60` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `61` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `62` | `$model->resetearIntentos($usuario['id_usuario']);` | Instrucción de ejecución en el contexto del script: `$model->resetearIntentos($usuario['id_usuario']);`. |
| `63` | `session_regenerate_id(true);` | Instrucción de ejecución en el contexto del script: `session_regenerate_id(true);`. |
| `64` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `65` | `$_SESSION['usuario'] = [` | Instrucción de ejecución en el contexto del script: `$_SESSION['usuario'] = [`. |
| `66` | `'id_usuario' => $usuario['id_usuario'],` | Instrucción de ejecución en el contexto del script: `'id_usuario' => $usuario['id_usuario'],`. |
| `67` | `'nombres'    => $usuario['nombres'],` | Instrucción de ejecución en el contexto del script: `'nombres'    => $usuario['nombres'],`. |
| `68` | `'apellidos'  => $usuario['apellidos'],` | Instrucción de ejecución en el contexto del script: `'apellidos'  => $usuario['apellidos'],`. |
| `69` | `'correo'     => $usuario['correo'],` | Instrucción de ejecución en el contexto del script: `'correo'     => $usuario['correo'],`. |
| `70` | `'rol'        => (int)$usuario['id_rol'],` | Instrucción de ejecución en el contexto del script: `'rol'        => (int)$usuario['id_rol'],`. |
| `71` | ``];`` | Cierre de estructura de arreglo o invocación de función. |
| `72` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `73` | `// Si es primer acceso, forzar cambio de contraseña (solo voceros)` | Comentario explicativo en el código: `Si es primer acceso, forzar cambio de contraseña (solo voceros)`. |
| `74` | `if ((int)$usuario['primer_acceso'] === 1 && (int)$usuario['id_rol'] === ...` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if ((int)$usuario['primer_acceso'] === 1 && (int)$usuario['id_rol'] === ...`. |
| `75` | `header("Location: ../views/usuarios/cambiar_password.php"); exit;` | Emite cabecera HTTP de redirección en el navegador y detiene la ejecución: `header("Location: ../views/usuarios/cambiar_password.php"); exit;`. |
| `76` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `77` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `78` | `match ((int)$usuario['id_rol']) {` | Estructura de coincidencia condicional `match` para despacho de acciones del controlador. |
| `79` | `1       => header("Location: ../views/dashboard/admin_dashboard.php"),` | Emite cabecera HTTP de respuesta hacia el cliente: `1       => header("Location: ../views/dashboard/admin_dashboard.php"),`. |
| `80` | `default => header("Location: ../views/dashboard/vocero_dashboard.php"),` | Emite cabecera HTTP de respuesta hacia el cliente: `default => header("Location: ../views/dashboard/vocero_dashboard.php"),`. |
| `81` | `};` | Instrucción de ejecución en el contexto del script: `};`. |
| `82` | `exit;` | Finaliza la ejecución de la función o script. |
| `83` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `84` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `85` | `// ── CAMBIO OBLIGATORIO DE CONTRASEÑA (PRIMER ACCESO) ──────────────────` | Comentario explicativo en el código: `── CAMBIO OBLIGATORIO DE CONTRASEÑA (PRIMER ACCESO) ──────────────────`. |
| `86` | `public function cambiarPassword(): void` | Declaración de método o función con su firma y parámetros: `public function cambiarPassword(): void`. |
| `87` | ``{`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `88` | `if ($_SERVER['REQUEST_METHOD'] !== 'POST') {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if ($_SERVER['REQUEST_METHOD'] !== 'POST') {`. |
| `89` | `header("Location: ../views/usuarios/cambiar_password.php"); exit;` | Emite cabecera HTTP de redirección en el navegador y detiene la ejecución: `header("Location: ../views/usuarios/cambiar_password.php"); exit;`. |
| `90` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `91` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `92` | `if (!isset($_SESSION['usuario'])) {` | Verifica autenticación y rol del usuario; redirige al login si no tiene permisos. |
| `93` | `header("Location: ../views/usuarios/login.php"); exit;` | Emite cabecera HTTP de redirección en el navegador y detiene la ejecución: `header("Location: ../views/usuarios/login.php"); exit;`. |
| `94` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `95` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `96` | `$passwordActual  = trim($_POST['password_actual']  ?? '');` | Instrucción de ejecución en el contexto del script: `$passwordActual  = trim($_POST['password_actual']  ?? '');`. |
| `97` | `$passwordNueva   = trim($_POST['password_nueva']   ?? '');` | Instrucción de ejecución en el contexto del script: `$passwordNueva   = trim($_POST['password_nueva']   ?? '');`. |
| `98` | `$passwordConfirm = trim($_POST['password_confirm'] ?? '');` | Instrucción de ejecución en el contexto del script: `$passwordConfirm = trim($_POST['password_confirm'] ?? '');`. |
| `99` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `100` | `$db      = (new Database())->conectar();` | Instrucción de ejecución en el contexto del script: `$db      = (new Database())->conectar();`. |
| `101` | `$model   = new Usuario($db);` | Instrucción de ejecución en el contexto del script: `$model   = new Usuario($db);`. |
| `102` | `$usuario = $model->obtenerPorId($_SESSION['usuario']['id_usuario']);` | Instrucción de ejecución en el contexto del script: `$usuario = $model->obtenerPorId($_SESSION['usuario']['id_usuario']);`. |
| `103` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `104` | `// Verificar contraseña actual` | Comentario explicativo en el código: `Verificar contraseña actual`. |
| `105` | `if (!password_verify($passwordActual, $usuario['password'])) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (!password_verify($passwordActual, $usuario['password'])) {`. |
| `106` | `$_SESSION['alert'] = ['icon'=>'error','title'=>'Contraseña incorrecta','...` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección. |
| `107` | `header("Location: ../views/usuarios/cambiar_password.php"); exit;` | Emite cabecera HTTP de redirección en el navegador y detiene la ejecución: `header("Location: ../views/usuarios/cambiar_password.php"); exit;`. |
| `108` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `109` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `110` | `// Validar que la nueva no sea igual a la temporal` | Comentario explicativo en el código: `Validar que la nueva no sea igual a la temporal`. |
| `111` | `if (password_verify($passwordNueva, $usuario['password'])) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (password_verify($passwordNueva, $usuario['password'])) {`. |
| `112` | `$_SESSION['alert'] = ['icon'=>'error','title'=>'Contraseña inválida','te...` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección. |
| `113` | `header("Location: ../views/usuarios/cambiar_password.php"); exit;` | Emite cabecera HTTP de redirección en el navegador y detiene la ejecución: `header("Location: ../views/usuarios/cambiar_password.php"); exit;`. |
| `114` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `115` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `116` | `// Validar requisitos` | Comentario explicativo en el código: `Validar requisitos`. |
| `117` | `$errores = $this->validarRequisitosPassword($passwordNueva);` | Instrucción de ejecución en el contexto del script: `$errores = $this->validarRequisitosPassword($passwordNueva);`. |
| `118` | `if (!empty($errores)) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (!empty($errores)) {`. |
| `119` | `$_SESSION['alert'] = ['icon'=>'error','title'=>'Contraseña no válida','t...` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección. |
| `120` | `header("Location: ../views/usuarios/cambiar_password.php"); exit;` | Emite cabecera HTTP de redirección en el navegador y detiene la ejecución: `header("Location: ../views/usuarios/cambiar_password.php"); exit;`. |
| `121` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `122` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `123` | `if ($passwordNueva !== $passwordConfirm) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if ($passwordNueva !== $passwordConfirm) {`. |
| `124` | `$_SESSION['alert'] = ['icon'=>'error','title'=>'Las contraseñas no coinc...` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección. |
| `125` | `header("Location: ../views/usuarios/cambiar_password.php"); exit;` | Emite cabecera HTTP de redirección en el navegador y detiene la ejecución: `header("Location: ../views/usuarios/cambiar_password.php"); exit;`. |
| `126` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `127` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `128` | `$model->actualizarPassword($_SESSION['usuario']['id_usuario'], password_...` | Instrucción de ejecución en el contexto del script: `$model->actualizarPassword($_SESSION['usuario']['id_usuario'], password_...`. |
| `129` | `// Actualizar sesión para que no vuelva a pedir cambio de contraseña` | Comentario explicativo en el código: `Actualizar sesión para que no vuelva a pedir cambio de contraseña`. |
| `130` | `$_SESSION['usuario']['primer_acceso'] = 0;` | Instrucción de ejecución en el contexto del script: `$_SESSION['usuario']['primer_acceso'] = 0;`. |
| `131` | `$_SESSION['alert'] = ['icon'=>'success','title'=>'¡Contraseña actualizad...` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección. |
| `132` | `header("Location: ../views/dashboard/vocero_dashboard.php"); exit;` | Emite cabecera HTTP de redirección en el navegador y detiene la ejecución: `header("Location: ../views/dashboard/vocero_dashboard.php"); exit;`. |
| `133` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `134` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `135` | `// ── RECUPERAR CONTRASEÑA ───────────────────────────────────────────────` | Comentario explicativo en el código: `── RECUPERAR CONTRASEÑA ───────────────────────────────────────────────`. |
| `136` | `public function recuperar(): void` | Declaración de método o función con su firma y parámetros: `public function recuperar(): void`. |
| `137` | ``{`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `138` | `if ($_SERVER['REQUEST_METHOD'] !== 'POST') {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if ($_SERVER['REQUEST_METHOD'] !== 'POST') {`. |
| `139` | `header("Location: ../views/usuarios/login.php"); exit;` | Emite cabecera HTTP de redirección en el navegador y detiene la ejecución: `header("Location: ../views/usuarios/login.php"); exit;`. |
| `140` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `141` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `142` | `$correo          = trim($_POST['correo']           ?? '');` | Instrucción de ejecución en el contexto del script: `$correo          = trim($_POST['correo']           ?? '');`. |
| `143` | `$passwordNueva   = trim($_POST['password_nueva']   ?? '');` | Instrucción de ejecución en el contexto del script: `$passwordNueva   = trim($_POST['password_nueva']   ?? '');`. |
| `144` | `$passwordConfirm = trim($_POST['password_confirm'] ?? '');` | Instrucción de ejecución en el contexto del script: `$passwordConfirm = trim($_POST['password_confirm'] ?? '');`. |
| `145` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `146` | `if (empty($correo) \|\| empty($passwordNueva)) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (empty($correo) \|\| empty($passwordNueva)) {`. |
| `147` | `$_SESSION['alert'] = ['icon'=>'warning','title'=>'Campos incompletos','t...` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección. |
| `148` | `header("Location: ../views/usuarios/login.php?panel=recuperar"); exit;` | Emite cabecera HTTP de redirección en el navegador y detiene la ejecución: `header("Location: ../views/usuarios/login.php?panel=recuperar"); exit;`. |
| `149` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `150` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `151` | `$errores = $this->validarRequisitosPassword($passwordNueva);` | Instrucción de ejecución en el contexto del script: `$errores = $this->validarRequisitosPassword($passwordNueva);`. |
| `152` | `if (!empty($errores)) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (!empty($errores)) {`. |
| `153` | `$_SESSION['alert'] = ['icon'=>'error','title'=>'Contraseña no válida','t...` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección. |
| `154` | `header("Location: ../views/usuarios/login.php?panel=recuperar"); exit;` | Emite cabecera HTTP de redirección en el navegador y detiene la ejecución: `header("Location: ../views/usuarios/login.php?panel=recuperar"); exit;`. |
| `155` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `156` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `157` | `if ($passwordNueva !== $passwordConfirm) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if ($passwordNueva !== $passwordConfirm) {`. |
| `158` | `$_SESSION['alert'] = ['icon'=>'error','title'=>'Las contraseñas no coinc...` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección. |
| `159` | `header("Location: ../views/usuarios/login.php?panel=recuperar"); exit;` | Emite cabecera HTTP de redirección en el navegador y detiene la ejecución: `header("Location: ../views/usuarios/login.php?panel=recuperar"); exit;`. |
| `160` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `161` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `162` | `$db    = (new Database())->conectar();` | Instrucción de ejecución en el contexto del script: `$db    = (new Database())->conectar();`. |
| `163` | `$model = new Usuario($db);` | Instrucción de ejecución en el contexto del script: `$model = new Usuario($db);`. |
| `164` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `165` | `// Por seguridad mostramos el mismo mensaje exista o no el correo` | Comentario explicativo en el código: `Por seguridad mostramos el mismo mensaje exista o no el correo`. |
| `166` | `if ($model->existeCorreo($correo)) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if ($model->existeCorreo($correo)) {`. |
| `167` | `$model->actualizarPasswordPorCorreo($correo, password_hash($passwordNuev...` | Instrucción de ejecución en el contexto del script: `$model->actualizarPasswordPorCorreo($correo, password_hash($passwordNuev...`. |
| `168` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `169` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `170` | `$_SESSION['alert'] = ['icon'=>'success','title'=>'Solicitud procesada','...` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección. |
| `171` | `header("Location: ../views/usuarios/login.php"); exit;` | Emite cabecera HTTP de redirección en el navegador y detiene la ejecución: `header("Location: ../views/usuarios/login.php"); exit;`. |
| `172` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `173` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `174` | `// ── LOGOUT ─────────────────────────────────────────────────────────────` | Comentario explicativo en el código: `── LOGOUT ─────────────────────────────────────────────────────────────`. |
| `175` | `public function logout(): void` | Declaración de método o función con su firma y parámetros: `public function logout(): void`. |
| `176` | ``{`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `177` | `// Evitar que el navegador sirva la página del dashboard desde caché` | Comentario explicativo en el código: `Evitar que el navegador sirva la página del dashboard desde caché`. |
| `178` | `header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");` | Emite cabecera HTTP de respuesta hacia el cliente: `header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");`. |
| `179` | `header("Cache-Control: post-check=0, pre-check=0", false);` | Emite cabecera HTTP de respuesta hacia el cliente: `header("Cache-Control: post-check=0, pre-check=0", false);`. |
| `180` | `header("Pragma: no-cache");` | Emite cabecera HTTP de respuesta hacia el cliente: `header("Pragma: no-cache");`. |
| `181` | `header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");` | Emite cabecera HTTP de respuesta hacia el cliente: `header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");`. |
| `182` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `183` | `session_unset();` | Instrucción de ejecución en el contexto del script: `session_unset();`. |
| `184` | `session_destroy();` | Instrucción de ejecución en el contexto del script: `session_destroy();`. |
| `185` | `header("Location: ../views/usuarios/login.php"); exit;` | Emite cabecera HTTP de redirección en el navegador y detiene la ejecución: `header("Location: ../views/usuarios/login.php"); exit;`. |
| `186` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `187` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `188` | `// ── HELPER: VALIDACIÓN DE CONTRASEÑA ──────────────────────────────────` | Comentario explicativo en el código: `── HELPER: VALIDACIÓN DE CONTRASEÑA ──────────────────────────────────`. |
| `189` | `private function validarRequisitosPassword(string $password): array` | Declaración de método o función con su firma y parámetros: `private function validarRequisitosPassword(string $password): array`. |
| `190` | ``{`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `191` | `$errores = [];` | Instrucción de ejecución en el contexto del script: `$errores = [];`. |
| `192` | `if (strlen($password) < 8)             $errores[] = 'Debe tener al menos...` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (strlen($password) < 8)             $errores[] = 'Debe tener al menos...`. |
| `193` | `if (!preg_match('/[A-Z]/', $password))  $errores[] = 'Debe incluir al me...` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (!preg_match('/[A-Z]/', $password))  $errores[] = 'Debe incluir al me...`. |
| `194` | `if (!preg_match('/[0-9]/', $password))  $errores[] = 'Debe incluir al me...` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (!preg_match('/[0-9]/', $password))  $errores[] = 'Debe incluir al me...`. |
| `195` | `if (!preg_match('/[\W_]/', $password))  $errores[] = 'Debe incluir al me...` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (!preg_match('/[\W_]/', $password))  $errores[] = 'Debe incluir al me...`. |
| `196` | `return $errores;` | Instrucción de retorno que finaliza la ejecución entregando el resultado: `return $errores;`. |
| `197` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `198` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `199` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `200` | `// ── Dispatcher ───────────────────────────────────────────────────────...` | Comentario explicativo en el código: `── Dispatcher ────────────────────────────────────────────────────────────`. |
| `201` | `if (basename(__FILE__) === basename($_SERVER['SCRIPT_FILENAME'])) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (basename(__FILE__) === basename($_SERVER['SCRIPT_FILENAME'])) {`. |
| `202` | `$controller = new AuthController();` | Instrucción de ejecución en el contexto del script: `$controller = new AuthController();`. |
| `203` | `$accion     = $_GET['accion'] ?? 'login';` | Instrucción de ejecución en el contexto del script: `$accion     = $_GET['accion'] ?? 'login';`. |
| `204` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `205` | `match ($accion) {` | Estructura de coincidencia condicional `match` para despacho de acciones del controlador. |
| `206` | `'logout'           => $controller->logout(),` | Instrucción de ejecución en el contexto del script: `'logout'           => $controller->logout(),`. |
| `207` | `'recuperar'        => $controller->recuperar(),` | Instrucción de ejecución en el contexto del script: `'recuperar'        => $controller->recuperar(),`. |
| `208` | `'cambiar_password' => $controller->cambiarPassword(),` | Instrucción de ejecución en el contexto del script: `'cambiar_password' => $controller->cambiarPassword(),`. |
| `209` | `default            => $controller->login(),` | Instrucción de ejecución en el contexto del script: `default            => $controller->login(),`. |
| `210` | `};` | Instrucción de ejecución en el contexto del script: `};`. |
| `211` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `212` | ``?>`` | Cierre de la etiqueta PHP para alternar a salida HTML o fin del archivo. |

---

## 3. Resumen y Flujo de Interacción

El archivo `AuthController.php` cumple un rol indispensable en `controllers/AuthController.php`. 
Controlador de autenticación y seguridad. Gestiona inicio de sesión, verificación de roles, cambio obligatorio de contraseña y cierre de sesión seguro. Garantiza la robustez, el orden y la estabilidad de la arquitectura del proyecto `systemLimpieza`.

---

Generado automáticamente para el repositorio [johanrepizo/LimpiezaDeModulos](https://github.com/johanrepizo/LimpiezaDeModulos).
