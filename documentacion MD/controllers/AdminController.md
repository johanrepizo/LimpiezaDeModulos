# Documentación Línea por Línea: `controllers/AdminController.php`

## 1. Ficha Técnica del Archivo

- **Archivo:** `AdminController.php`
- **Ruta en el proyecto:** `controllers/AdminController.php`
- **Cantidad total de líneas:** `617`
- **Tipo de archivo:** `PHP`
- **Propósito general:** Controlador principal del módulo de administración. Gestiona programas de formación, fichas, módulos, asignaciones de grupos, voceros, turnos y supervisión de evidencias.

---

## 2. Explicación Detallada Línea por Línea

A continuación se presenta cada línea de código numerada de forma consecutiva, acompañada de su fragmento exacto y la explicación exhaustiva de su funcionamiento y responsabilidad en el sistema:

| Línea | Código Fuente | Explicación Detallada |
|---|---|---|
| `1` | ``<?php`` | Apertura obligatoria de la etiqueta PHP para ejecución del código del lado del servidor. |
| `2` | `if (session_status() === PHP_SESSION_NONE) session_start();` | Inicia o reanuda la sesión PHP del usuario si no se encontraba activa previamente. |
| `3` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `4` | `require_once __DIR__ . '/../config/database.php';` | Importación e inclusión obligatoria del archivo de dependencia requerido: `require_once __DIR__ . '/../config/database.php';`. |
| `5` | `require_once __DIR__ . '/../models/Programa.php';` | Importación e inclusión obligatoria del archivo de dependencia requerido: `require_once __DIR__ . '/../models/Programa.php';`. |
| `6` | `require_once __DIR__ . '/../models/Ficha.php';` | Importación e inclusión obligatoria del archivo de dependencia requerido: `require_once __DIR__ . '/../models/Ficha.php';`. |
| `7` | `require_once __DIR__ . '/../models/Modulo.php';` | Importación e inclusión obligatoria del archivo de dependencia requerido: `require_once __DIR__ . '/../models/Modulo.php';`. |
| `8` | `require_once __DIR__ . '/../models/Usuario.php';` | Importación e inclusión obligatoria del archivo de dependencia requerido: `require_once __DIR__ . '/../models/Usuario.php';`. |
| `9` | `require_once __DIR__ . '/../models/Notificacion.php';` | Importación e inclusión obligatoria del archivo de dependencia requerido: `require_once __DIR__ . '/../models/Notificacion.php';`. |
| `10` | `require_once __DIR__ . '/../models/Turno.php';` | Importación e inclusión obligatoria del archivo de dependencia requerido: `require_once __DIR__ . '/../models/Turno.php';`. |
| `11` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `12` | `class AdminController` | Declaración de la clase del componente: `class AdminController`. |
| `13` | ``{`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `14` | `private PDO $db;` | Definición de propiedad de clase para el estado interno del componente: `private PDO $db;`. |
| `15` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `16` | `public function __construct()` | Declaración de método o función con su firma y parámetros: `public function __construct()`. |
| `17` | ``{`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `18` | `$this->db = (new Database())->conectar();` | Instrucción de ejecución en el contexto del script: `$this->db = (new Database())->conectar();`. |
| `19` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `20` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `21` | `// ════════════════════════════════════════════════════════════════════════` | Comentario explicativo en el código: `════════════════════════════════════════════════════════════════════════`. |
| `22` | `// PROGRAMAS` | Comentario explicativo en el código: `PROGRAMAS`. |
| `23` | `// ════════════════════════════════════════════════════════════════════════` | Comentario explicativo en el código: `════════════════════════════════════════════════════════════════════════`. |
| `24` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `25` | `public function guardarPrograma(): void` | Declaración de método o función con su firma y parámetros: `public function guardarPrograma(): void`. |
| `26` | ``{`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `27` | `$this->requireAdmin();` | Instrucción de ejecución en el contexto del script: `$this->requireAdmin();`. |
| `28` | `$model  = new Programa($this->db);` | Instrucción de ejecución en el contexto del script: `$model  = new Programa($this->db);`. |
| `29` | `$id     = (int)($_POST['id_programa'] ?? 0);` | Instrucción de ejecución en el contexto del script: `$id     = (int)($_POST['id_programa'] ?? 0);`. |
| `30` | `$datos  = [` | Instrucción de ejecución en el contexto del script: `$datos  = [`. |
| `31` | `'nombre'      => trim($_POST['nombre']      ?? ''),` | Instrucción de ejecución en el contexto del script: `'nombre'      => trim($_POST['nombre']      ?? ''),`. |
| `32` | `'descripcion' => trim($_POST['descripcion'] ?? ''),` | Instrucción de ejecución en el contexto del script: `'descripcion' => trim($_POST['descripcion'] ?? ''),`. |
| `33` | `'nivel'       => trim($_POST['nivel']       ?? ''),` | Instrucción de ejecución en el contexto del script: `'nivel'       => trim($_POST['nivel']       ?? ''),`. |
| `34` | ``];`` | Cierre de estructura de arreglo o invocación de función. |
| `35` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `36` | `if (empty($datos['nombre'])) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (empty($datos['nombre'])) {`. |
| `37` | `$_SESSION['alert'] = ['icon'=>'warning','title'=>'Campo requerido','text...` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección. |
| `38` | `header("Location: ../views/dashboard/admin_programas.php"); exit;` | Emite cabecera HTTP de redirección en el navegador y detiene la ejecución: `header("Location: ../views/dashboard/admin_programas.php"); exit;`. |
| `39` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `40` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `41` | `if ($id) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if ($id) {`. |
| `42` | `$model->actualizar($id, $datos);` | Instrucción de ejecución en el contexto del script: `$model->actualizar($id, $datos);`. |
| `43` | `$_SESSION['alert'] = ['icon'=>'success','title'=>'Programa actualizado',...` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección. |
| `44` | `} else {` | Instrucción de ejecución en el contexto del script: `} else {`. |
| `45` | `$model->crear($datos);` | Instrucción de ejecución en el contexto del script: `$model->crear($datos);`. |
| `46` | `$_SESSION['alert'] = ['icon'=>'success','title'=>'Programa creado','text...` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección. |
| `47` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `48` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `49` | `header("Location: ../views/dashboard/admin_programas.php"); exit;` | Emite cabecera HTTP de redirección en el navegador y detiene la ejecución: `header("Location: ../views/dashboard/admin_programas.php"); exit;`. |
| `50` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `51` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `52` | `public function eliminarPrograma(): void` | Declaración de método o función con su firma y parámetros: `public function eliminarPrograma(): void`. |
| `53` | ``{`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `54` | `$this->requireAdmin();` | Instrucción de ejecución en el contexto del script: `$this->requireAdmin();`. |
| `55` | `$id    = (int)($_POST['id_programa'] ?? 0);` | Instrucción de ejecución en el contexto del script: `$id    = (int)($_POST['id_programa'] ?? 0);`. |
| `56` | `$model = new Programa($this->db);` | Instrucción de ejecución en el contexto del script: `$model = new Programa($this->db);`. |
| `57` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `58` | `if ($model->tieneFichasActivas($id)) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if ($model->tieneFichasActivas($id)) {`. |
| `59` | `$_SESSION['alert'] = ['icon'=>'error','title'=>'No se puede eliminar','t...` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección. |
| `60` | `} else {` | Instrucción de ejecución en el contexto del script: `} else {`. |
| `61` | `$model->eliminar($id);` | Instrucción de ejecución en el contexto del script: `$model->eliminar($id);`. |
| `62` | `$_SESSION['alert'] = ['icon'=>'success','title'=>'Programa eliminado','t...` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección. |
| `63` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `64` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `65` | `header("Location: ../views/dashboard/admin_programas.php"); exit;` | Emite cabecera HTTP de redirección en el navegador y detiene la ejecución: `header("Location: ../views/dashboard/admin_programas.php"); exit;`. |
| `66` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `67` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `68` | `// ════════════════════════════════════════════════════════════════════════` | Comentario explicativo en el código: `════════════════════════════════════════════════════════════════════════`. |
| `69` | `// FICHAS` | Comentario explicativo en el código: `FICHAS`. |
| `70` | `// ════════════════════════════════════════════════════════════════════════` | Comentario explicativo en el código: `════════════════════════════════════════════════════════════════════════`. |
| `71` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `72` | `public function guardarFicha(): void` | Declaración de método o función con su firma y parámetros: `public function guardarFicha(): void`. |
| `73` | ``{`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `74` | `$this->requireAdmin();` | Instrucción de ejecución en el contexto del script: `$this->requireAdmin();`. |
| `75` | `$model = new Ficha($this->db);` | Instrucción de ejecución en el contexto del script: `$model = new Ficha($this->db);`. |
| `76` | `$id    = (int)($_POST['id_ficha'] ?? 0);` | Instrucción de ejecución en el contexto del script: `$id    = (int)($_POST['id_ficha'] ?? 0);`. |
| `77` | `$datos = [` | Instrucción de ejecución en el contexto del script: `$datos = [`. |
| `78` | `'id_programa'    => (int)($_POST['id_programa']    ?? 0),` | Instrucción de ejecución en el contexto del script: `'id_programa'    => (int)($_POST['id_programa']    ?? 0),`. |
| `79` | `'numero_ficha'   => trim($_POST['numero_ficha']    ?? ''),` | Instrucción de ejecución en el contexto del script: `'numero_ficha'   => trim($_POST['numero_ficha']    ?? ''),`. |
| `80` | `'jornada'        => trim($_POST['jornada']         ?? 'Diurna'),` | Instrucción de ejecución en el contexto del script: `'jornada'        => trim($_POST['jornada']         ?? 'Diurna'),`. |
| `81` | `'num_aprendices' => (int)($_POST['num_aprendices'] ?? 0) ?: null,` | Instrucción de ejecución en el contexto del script: `'num_aprendices' => (int)($_POST['num_aprendices'] ?? 0) ?: null,`. |
| `82` | ``];`` | Cierre de estructura de arreglo o invocación de función. |
| `83` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `84` | `if (!$datos['id_programa'] \|\| empty($datos['numero_ficha'])) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (!$datos['id_programa'] \|\| empty($datos['numero_ficha'])) {`. |
| `85` | `$_SESSION['alert'] = ['icon'=>'warning','title'=>'Datos incompletos','te...` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección. |
| `86` | `header("Location: ../views/dashboard/admin_fichas.php"); exit;` | Emite cabecera HTTP de redirección en el navegador y detiene la ejecución: `header("Location: ../views/dashboard/admin_fichas.php"); exit;`. |
| `87` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `88` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `89` | `if ($model->existeDuplicado($datos['numero_ficha'], $datos['id_programa'...` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if ($model->existeDuplicado($datos['numero_ficha'], $datos['id_programa'...`. |
| `90` | `$_SESSION['alert'] = ['icon'=>'error','title'=>'Ficha duplicada','text'=...` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección. |
| `91` | `header("Location: ../views/dashboard/admin_fichas.php"); exit;` | Emite cabecera HTTP de redirección en el navegador y detiene la ejecución: `header("Location: ../views/dashboard/admin_fichas.php"); exit;`. |
| `92` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `93` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `94` | `if ($id) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if ($id) {`. |
| `95` | `$model->actualizar($id, $datos);` | Instrucción de ejecución en el contexto del script: `$model->actualizar($id, $datos);`. |
| `96` | `$_SESSION['alert'] = ['icon'=>'success','title'=>'Ficha actualizada','te...` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección. |
| `97` | `} else {` | Instrucción de ejecución en el contexto del script: `} else {`. |
| `98` | `$model->crear($datos);` | Instrucción de ejecución en el contexto del script: `$model->crear($datos);`. |
| `99` | `$_SESSION['alert'] = ['icon'=>'success','title'=>'Ficha creada','text'=>...` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección. |
| `100` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `101` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `102` | `header("Location: ../views/dashboard/admin_fichas.php"); exit;` | Emite cabecera HTTP de redirección en el navegador y detiene la ejecución: `header("Location: ../views/dashboard/admin_fichas.php"); exit;`. |
| `103` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `104` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `105` | `public function eliminarFicha(): void` | Declaración de método o función con su firma y parámetros: `public function eliminarFicha(): void`. |
| `106` | ``{`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `107` | `$this->requireAdmin();` | Instrucción de ejecución en el contexto del script: `$this->requireAdmin();`. |
| `108` | `$id    = (int)($_POST['id_ficha'] ?? 0);` | Instrucción de ejecución en el contexto del script: `$id    = (int)($_POST['id_ficha'] ?? 0);`. |
| `109` | `$model = new Ficha($this->db);` | Instrucción de ejecución en el contexto del script: `$model = new Ficha($this->db);`. |
| `110` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `111` | `if ($model->tieneAsignacionesActivas($id)) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if ($model->tieneAsignacionesActivas($id)) {`. |
| `112` | `$_SESSION['alert'] = ['icon'=>'error','title'=>'No se puede eliminar','t...` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección. |
| `113` | `} else {` | Instrucción de ejecución en el contexto del script: `} else {`. |
| `114` | `$model->eliminar($id);` | Instrucción de ejecución en el contexto del script: `$model->eliminar($id);`. |
| `115` | `$_SESSION['alert'] = ['icon'=>'success','title'=>'Ficha eliminada','text...` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección. |
| `116` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `117` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `118` | `header("Location: ../views/dashboard/admin_fichas.php"); exit;` | Emite cabecera HTTP de redirección en el navegador y detiene la ejecución: `header("Location: ../views/dashboard/admin_fichas.php"); exit;`. |
| `119` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `120` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `121` | `// ════════════════════════════════════════════════════════════════════════` | Comentario explicativo en el código: `════════════════════════════════════════════════════════════════════════`. |
| `122` | `// MÓDULOS` | Comentario explicativo en el código: `MÓDULOS`. |
| `123` | `// ════════════════════════════════════════════════════════════════════════` | Comentario explicativo en el código: `════════════════════════════════════════════════════════════════════════`. |
| `124` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `125` | `public function guardarModulo(): void` | Declaración de método o función con su firma y parámetros: `public function guardarModulo(): void`. |
| `126` | ``{`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `127` | `$this->requireAdmin();` | Instrucción de ejecución en el contexto del script: `$this->requireAdmin();`. |
| `128` | `$model = new Modulo($this->db);` | Instrucción de ejecución en el contexto del script: `$model = new Modulo($this->db);`. |
| `129` | `$id    = (int)($_POST['id_modulo'] ?? 0);` | Instrucción de ejecución en el contexto del script: `$id    = (int)($_POST['id_modulo'] ?? 0);`. |
| `130` | `$datos = [` | Instrucción de ejecución en el contexto del script: `$datos = [`. |
| `131` | `'nombre'      => trim($_POST['nombre']      ?? ''),` | Instrucción de ejecución en el contexto del script: `'nombre'      => trim($_POST['nombre']      ?? ''),`. |
| `132` | `'ubicacion'   => trim($_POST['ubicacion']   ?? ''),` | Instrucción de ejecución en el contexto del script: `'ubicacion'   => trim($_POST['ubicacion']   ?? ''),`. |
| `133` | `'capacidad'   => (int)($_POST['capacidad']  ?? 0) ?: null,` | Instrucción de ejecución en el contexto del script: `'capacidad'   => (int)($_POST['capacidad']  ?? 0) ?: null,`. |
| `134` | `'descripcion' => trim($_POST['descripcion'] ?? ''),` | Instrucción de ejecución en el contexto del script: `'descripcion' => trim($_POST['descripcion'] ?? ''),`. |
| `135` | ``];`` | Cierre de estructura de arreglo o invocación de función. |
| `136` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `137` | `if (empty($datos['nombre'])) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (empty($datos['nombre'])) {`. |
| `138` | `$_SESSION['alert'] = ['icon'=>'warning','title'=>'Campo requerido','text...` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección. |
| `139` | `header("Location: ../views/dashboard/admin_modulos.php"); exit;` | Emite cabecera HTTP de redirección en el navegador y detiene la ejecución: `header("Location: ../views/dashboard/admin_modulos.php"); exit;`. |
| `140` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `141` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `142` | `if ($id) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if ($id) {`. |
| `143` | `$model->actualizar($id, $datos);` | Instrucción de ejecución en el contexto del script: `$model->actualizar($id, $datos);`. |
| `144` | `$_SESSION['alert'] = ['icon'=>'success','title'=>'Módulo actualizado','t...` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección. |
| `145` | `} else {` | Instrucción de ejecución en el contexto del script: `} else {`. |
| `146` | `$model->crear($datos);` | Instrucción de ejecución en el contexto del script: `$model->crear($datos);`. |
| `147` | `$_SESSION['alert'] = ['icon'=>'success','title'=>'Módulo creado','text'=...` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección. |
| `148` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `149` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `150` | `header("Location: ../views/dashboard/admin_modulos.php"); exit;` | Emite cabecera HTTP de redirección en el navegador y detiene la ejecución: `header("Location: ../views/dashboard/admin_modulos.php"); exit;`. |
| `151` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `152` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `153` | `public function asignarModulo(): void` | Declaración de método o función con su firma y parámetros: `public function asignarModulo(): void`. |
| `154` | ``{`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `155` | `$this->requireAdmin();` | Instrucción de ejecución en el contexto del script: `$this->requireAdmin();`. |
| `156` | `$model       = new Modulo($this->db);` | Instrucción de ejecución en el contexto del script: `$model       = new Modulo($this->db);`. |
| `157` | `$idModulo    = (int)($_POST['id_modulo']   ?? 0);` | Instrucción de ejecución en el contexto del script: `$idModulo    = (int)($_POST['id_modulo']   ?? 0);`. |
| `158` | `$idFicha     = (int)($_POST['id_ficha']    ?? 0);` | Instrucción de ejecución en el contexto del script: `$idFicha     = (int)($_POST['id_ficha']    ?? 0);`. |
| `159` | `$fechaInicio = trim($_POST['fecha_inicio'] ?? '');` | Instrucción de ejecución en el contexto del script: `$fechaInicio = trim($_POST['fecha_inicio'] ?? '');`. |
| `160` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `161` | `if (!$idModulo \|\| !$idFicha \|\| empty($fechaInicio)) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (!$idModulo \|\| !$idFicha \|\| empty($fechaInicio)) {`. |
| `162` | `$_SESSION['alert'] = ['icon'=>'warning','title'=>'Datos incompletos','te...` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección. |
| `163` | `header("Location: ../views/dashboard/admin_modulos.php"); exit;` | Emite cabecera HTTP de redirección en el navegador y detiene la ejecución: `header("Location: ../views/dashboard/admin_modulos.php"); exit;`. |
| `164` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `165` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `166` | `// Fecha fin = 2 años desde inicio (recurrente indefinido en la práctica)` | Comentario explicativo en el código: `Fecha fin = 2 años desde inicio (recurrente indefinido en la práctica)`. |
| `167` | `$fechaFin    = (new DateTime($fechaInicio))->modify('+2 years')->format(...` | Instrucción de ejecución en el contexto del script: `$fechaFin    = (new DateTime($fechaInicio))->modify('+2 years')->format(...`. |
| `168` | `// Fecha límite evidencia = 23:59 del mismo día del turno (se usa a nive...` | Comentario explicativo en el código: `Fecha límite evidencia = 23:59 del mismo día del turno (se usa a nivel d...`. |
| `169` | `$fechaLimite = $fechaInicio . ' 23:59:00';` | Instrucción de ejecución en el contexto del script: `$fechaLimite = $fechaInicio . ' 23:59:00';`. |
| `170` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `171` | `if ($model->estaAsignadoEnPeriodo($idModulo, $fechaInicio, $fechaFin)) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if ($model->estaAsignadoEnPeriodo($idModulo, $fechaInicio, $fechaFin)) {`. |
| `172` | `$_SESSION['alert'] = ['icon'=>'error','title'=>'Módulo ya asignado','tex...` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección. |
| `173` | `header("Location: ../views/dashboard/admin_modulos.php"); exit;` | Emite cabecera HTTP de redirección en el navegador y detiene la ejecución: `header("Location: ../views/dashboard/admin_modulos.php"); exit;`. |
| `174` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `175` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `176` | `if ($model->fichaYaTieneAsignacion($idFicha)) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if ($model->fichaYaTieneAsignacion($idFicha)) {`. |
| `177` | `$_SESSION['alert'] = ['icon'=>'error','title'=>'Ficha ya tiene módulo','...` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección. |
| `178` | `header("Location: ../views/dashboard/admin_modulos.php"); exit;` | Emite cabecera HTTP de redirección en el navegador y detiene la ejecución: `header("Location: ../views/dashboard/admin_modulos.php"); exit;`. |
| `179` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `180` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `181` | `$idAsignacion = $model->crearAsignacion([` | Instrucción de ejecución en el contexto del script: `$idAsignacion = $model->crearAsignacion([`. |
| `182` | `'id_modulo'               => $idModulo,` | Instrucción de ejecución en el contexto del script: `'id_modulo'               => $idModulo,`. |
| `183` | `'id_ficha'                => $idFicha,` | Instrucción de ejecución en el contexto del script: `'id_ficha'                => $idFicha,`. |
| `184` | `'fecha_inicio'            => $fechaInicio,` | Instrucción de ejecución en el contexto del script: `'fecha_inicio'            => $fechaInicio,`. |
| `185` | `'fecha_fin'               => $fechaFin,` | Instrucción de ejecución en el contexto del script: `'fecha_fin'               => $fechaFin,`. |
| `186` | `'fecha_limite_evidencia'  => $fechaLimite,` | Instrucción de ejecución en el contexto del script: `'fecha_limite_evidencia'  => $fechaLimite,`. |
| `187` | `]);` | Instrucción de ejecución en el contexto del script: `]);`. |
| `188` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `189` | `if ($idAsignacion) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if ($idAsignacion) {`. |
| `190` | `$diaSemana = (int)(new DateTime($fechaInicio))->format('w');` | Instrucción de ejecución en el contexto del script: `$diaSemana = (int)(new DateTime($fechaInicio))->format('w');`. |
| `191` | `$this->db->prepare("UPDATE asignaciones SET dia_semana = :d WHERE id_asi...` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$this->db->prepare("UPDATE asignaciones SET dia_semana = :d WHERE id_asi...`. |
| `192` | `->execute([':d' => $diaSemana, ':id' => $idAsignacion]);` | Ejecuta la sentencia SQL preparada vinculando los parámetros correspondientes: `->execute([':d' => $diaSemana, ':id' => $idAsignacion]);`. |
| `193` | `(new Turno($this->db))->generarTurnosAsignacion($idAsignacion);` | Instrucción de ejecución en el contexto del script: `(new Turno($this->db))->generarTurnosAsignacion($idAsignacion);`. |
| `194` | `$this->notificarVoceroAsignacion($idFicha, $idAsignacion);` | Instrucción de ejecución en el contexto del script: `$this->notificarVoceroAsignacion($idFicha, $idAsignacion);`. |
| `195` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `196` | `$diasES = ['Domingo','Lunes','Martes','Miércoles','Jueves','Viernes','Sá...` | Instrucción de ejecución en el contexto del script: `$diasES = ['Domingo','Lunes','Martes','Miércoles','Jueves','Viernes','Sá...`. |
| `197` | `$diaNom = $diasES[$diaSemana];` | Instrucción de ejecución en el contexto del script: `$diaNom = $diasES[$diaSemana];`. |
| `198` | `$_SESSION['alert'] = [` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección. |
| `199` | `'icon'  => 'success',` | Instrucción de ejecución en el contexto del script: `'icon'  => 'success',`. |
| `200` | `'title' => 'Módulo asignado',` | Instrucción de ejecución en el contexto del script: `'title' => 'Módulo asignado',`. |
| `201` | `'text'  => "La limpieza se programó todos los {$diaNom}s a partir del " ...` | Instrucción de ejecución en el contexto del script: `'text'  => "La limpieza se programó todos los {$diaNom}s a partir del " ...`. |
| `202` | ``];`` | Cierre de estructura de arreglo o invocación de función. |
| `203` | `} else {` | Instrucción de ejecución en el contexto del script: `} else {`. |
| `204` | `$_SESSION['alert'] = ['icon'=>'error','title'=>'Error','text'=>'No se pu...` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección. |
| `205` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `206` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `207` | `header("Location: ../views/dashboard/admin_modulos.php"); exit;` | Emite cabecera HTTP de redirección en el navegador y detiene la ejecución: `header("Location: ../views/dashboard/admin_modulos.php"); exit;`. |
| `208` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `209` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `210` | `public function editarAsignacion(): void` | Declaración de método o función con su firma y parámetros: `public function editarAsignacion(): void`. |
| `211` | ``{`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `212` | `$this->requireAdmin();` | Instrucción de ejecución en el contexto del script: `$this->requireAdmin();`. |
| `213` | `$model        = new Modulo($this->db);` | Instrucción de ejecución en el contexto del script: `$model        = new Modulo($this->db);`. |
| `214` | `$idAsignacion = (int)($_POST['id_asignacion'] ?? 0);` | Instrucción de ejecución en el contexto del script: `$idAsignacion = (int)($_POST['id_asignacion'] ?? 0);`. |
| `215` | `$idFicha      = (int)($_POST['id_ficha']      ?? 0);` | Instrucción de ejecución en el contexto del script: `$idFicha      = (int)($_POST['id_ficha']      ?? 0);`. |
| `216` | `$fechaInicio  = trim($_POST['fecha_inicio']   ?? '');` | Instrucción de ejecución en el contexto del script: `$fechaInicio  = trim($_POST['fecha_inicio']   ?? '');`. |
| `217` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `218` | `if (!$idAsignacion \|\| !$idFicha \|\| empty($fechaInicio)) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (!$idAsignacion \|\| !$idFicha \|\| empty($fechaInicio)) {`. |
| `219` | `$_SESSION['alert'] = ['icon'=>'warning','title'=>'Datos incompletos','te...` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección. |
| `220` | `header("Location: ../views/dashboard/admin_modulos.php"); exit;` | Emite cabecera HTTP de redirección en el navegador y detiene la ejecución: `header("Location: ../views/dashboard/admin_modulos.php"); exit;`. |
| `221` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `222` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `223` | `$stmtA = $this->db->prepare("SELECT id_modulo FROM asignaciones WHERE id...` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmtA = $this->db->prepare("SELECT id_modulo FROM asignaciones WHERE id...`. |
| `224` | `$stmtA->execute([':id' => $idAsignacion]);` | Ejecuta la sentencia SQL preparada vinculando los parámetros correspondientes: `$stmtA->execute([':id' => $idAsignacion]);`. |
| `225` | `$asigActual = $stmtA->fetch(PDO::FETCH_ASSOC);` | Recupera una única fila o registro resultante de la consulta. |
| `226` | `if (!$asigActual) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (!$asigActual) {`. |
| `227` | `$_SESSION['alert'] = ['icon'=>'error','title'=>'No encontrada','text'=>'...` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección. |
| `228` | `header("Location: ../views/dashboard/admin_modulos.php"); exit;` | Emite cabecera HTTP de redirección en el navegador y detiene la ejecución: `header("Location: ../views/dashboard/admin_modulos.php"); exit;`. |
| `229` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `230` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `231` | `$fechaFin    = (new DateTime($fechaInicio))->modify('+2 years')->format(...` | Instrucción de ejecución en el contexto del script: `$fechaFin    = (new DateTime($fechaInicio))->modify('+2 years')->format(...`. |
| `232` | `$fechaLimite = $fechaInicio . ' 23:59:00';` | Instrucción de ejecución en el contexto del script: `$fechaLimite = $fechaInicio . ' 23:59:00';`. |
| `233` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `234` | `if ($model->estaAsignadoEnPeriodo((int)$asigActual['id_modulo'], $fechaI...` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if ($model->estaAsignadoEnPeriodo((int)$asigActual['id_modulo'], $fechaI...`. |
| `235` | `$_SESSION['alert'] = ['icon'=>'error','title'=>'Conflicto','text'=>'Ese ...` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección. |
| `236` | `header("Location: ../views/dashboard/admin_modulos.php"); exit;` | Emite cabecera HTTP de redirección en el navegador y detiene la ejecución: `header("Location: ../views/dashboard/admin_modulos.php"); exit;`. |
| `237` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `238` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `239` | `if ($model->fichaYaTieneAsignacion($idFicha, $idAsignacion)) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if ($model->fichaYaTieneAsignacion($idFicha, $idAsignacion)) {`. |
| `240` | `$_SESSION['alert'] = ['icon'=>'error','title'=>'Ficha ya tiene módulo','...` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección. |
| `241` | `header("Location: ../views/dashboard/admin_modulos.php"); exit;` | Emite cabecera HTTP de redirección en el navegador y detiene la ejecución: `header("Location: ../views/dashboard/admin_modulos.php"); exit;`. |
| `242` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `243` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `244` | `$diaSemana = (int)(new DateTime($fechaInicio))->format('w');` | Instrucción de ejecución en el contexto del script: `$diaSemana = (int)(new DateTime($fechaInicio))->format('w');`. |
| `245` | `$stmt = $this->db->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmt = $this->db->prepare(`. |
| `246` | `"UPDATE asignaciones` | Instrucción de ejecución en el contexto del script: `"UPDATE asignaciones`. |
| `247` | `SET id_ficha = :ficha, fecha_inicio = :inicio, fecha_fin = :fin,` | Instrucción de ejecución en el contexto del script: `SET id_ficha = :ficha, fecha_inicio = :inicio, fecha_fin = :fin,`. |
| `248` | `fecha_limite_evidencia = :limite, dia_semana = :dia` | Instrucción de ejecución en el contexto del script: `fecha_limite_evidencia = :limite, dia_semana = :dia`. |
| `249` | `WHERE id_asignacion = :id"` | Instrucción de ejecución en el contexto del script: `WHERE id_asignacion = :id"`. |
| `250` | ``);`` | Cierre de estructura de arreglo o invocación de función. |
| `251` | `$ok = $stmt->execute([` | Ejecuta la sentencia SQL preparada vinculando los parámetros correspondientes: `$ok = $stmt->execute([`. |
| `252` | `':ficha'  => $idFicha,` | Instrucción de ejecución en el contexto del script: `':ficha'  => $idFicha,`. |
| `253` | `':inicio' => $fechaInicio,` | Instrucción de ejecución en el contexto del script: `':inicio' => $fechaInicio,`. |
| `254` | `':fin'    => $fechaFin,` | Instrucción de ejecución en el contexto del script: `':fin'    => $fechaFin,`. |
| `255` | `':limite' => $fechaLimite,` | Instrucción de ejecución en el contexto del script: `':limite' => $fechaLimite,`. |
| `256` | `':dia'    => $diaSemana,` | Instrucción de ejecución en el contexto del script: `':dia'    => $diaSemana,`. |
| `257` | `':id'     => $idAsignacion,` | Instrucción de ejecución en el contexto del script: `':id'     => $idAsignacion,`. |
| `258` | `]);` | Instrucción de ejecución en el contexto del script: `]);`. |
| `259` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `260` | `if ($ok) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if ($ok) {`. |
| `261` | `$this->db->prepare("DELETE FROM turnos WHERE id_asignacion = :id")` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$this->db->prepare("DELETE FROM turnos WHERE id_asignacion = :id")`. |
| `262` | `->execute([':id' => $idAsignacion]);` | Ejecuta la sentencia SQL preparada vinculando los parámetros correspondientes: `->execute([':id' => $idAsignacion]);`. |
| `263` | `(new Turno($this->db))->generarTurnosAsignacion($idAsignacion);` | Instrucción de ejecución en el contexto del script: `(new Turno($this->db))->generarTurnosAsignacion($idAsignacion);`. |
| `264` | `(new Turno($this->db))->asignarGruposRotacion($idAsignacion);` | Instrucción de ejecución en el contexto del script: `(new Turno($this->db))->asignarGruposRotacion($idAsignacion);`. |
| `265` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `266` | `$diasES = ['Domingo','Lunes','Martes','Miércoles','Jueves','Viernes','Sá...` | Instrucción de ejecución en el contexto del script: `$diasES = ['Domingo','Lunes','Martes','Miércoles','Jueves','Viernes','Sá...`. |
| `267` | `$_SESSION['alert'] = [` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección. |
| `268` | `'icon'  => 'success',` | Instrucción de ejecución en el contexto del script: `'icon'  => 'success',`. |
| `269` | `'title' => 'Asignación actualizada',` | Instrucción de ejecución en el contexto del script: `'title' => 'Asignación actualizada',`. |
| `270` | `'text'  => 'Los turnos se regeneraron. La limpieza será cada ' . $diasES...` | Instrucción de ejecución en el contexto del script: `'text'  => 'Los turnos se regeneraron. La limpieza será cada ' . $diasES...`. |
| `271` | ``];`` | Cierre de estructura de arreglo o invocación de función. |
| `272` | `} else {` | Instrucción de ejecución en el contexto del script: `} else {`. |
| `273` | `$_SESSION['alert'] = ['icon'=>'error','title'=>'Error','text'=>'No se pu...` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección. |
| `274` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `275` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `276` | `header("Location: ../views/dashboard/admin_modulos.php"); exit;` | Emite cabecera HTTP de redirección en el navegador y detiene la ejecución: `header("Location: ../views/dashboard/admin_modulos.php"); exit;`. |
| `277` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `278` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `279` | `public function cancelarAsignacion(): void` | Declaración de método o función con su firma y parámetros: `public function cancelarAsignacion(): void`. |
| `280` | ``{`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `281` | `$this->requireAdmin();` | Instrucción de ejecución en el contexto del script: `$this->requireAdmin();`. |
| `282` | `$idAsignacion = (int)($_POST['id_asignacion'] ?? 0);` | Instrucción de ejecución en el contexto del script: `$idAsignacion = (int)($_POST['id_asignacion'] ?? 0);`. |
| `283` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `284` | `$this->db->prepare("UPDATE asignaciones SET estado = 'Cancelada' WHERE i...` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$this->db->prepare("UPDATE asignaciones SET estado = 'Cancelada' WHERE i...`. |
| `285` | `->execute([':id' => $idAsignacion]);` | Ejecuta la sentencia SQL preparada vinculando los parámetros correspondientes: `->execute([':id' => $idAsignacion]);`. |
| `286` | `$this->db->prepare("DELETE FROM turnos WHERE id_asignacion = :id")` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$this->db->prepare("DELETE FROM turnos WHERE id_asignacion = :id")`. |
| `287` | `->execute([':id' => $idAsignacion]);` | Ejecuta la sentencia SQL preparada vinculando los parámetros correspondientes: `->execute([':id' => $idAsignacion]);`. |
| `288` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `289` | `$_SESSION['alert'] = ['icon'=>'success','title'=>'Asignación cancelada',...` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección. |
| `290` | `header("Location: ../views/dashboard/admin_modulos.php"); exit;` | Emite cabecera HTTP de redirección en el navegador y detiene la ejecución: `header("Location: ../views/dashboard/admin_modulos.php"); exit;`. |
| `291` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `292` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `293` | `// ════════════════════════════════════════════════════════════════════════` | Comentario explicativo en el código: `════════════════════════════════════════════════════════════════════════`. |
| `294` | `// VOCEROS / USUARIOS` | Comentario explicativo en el código: `VOCEROS / USUARIOS`. |
| `295` | `// ════════════════════════════════════════════════════════════════════════` | Comentario explicativo en el código: `════════════════════════════════════════════════════════════════════════`. |
| `296` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `297` | `public function reenviarCredenciales(): void` | Declaración de método o función con su firma y parámetros: `public function reenviarCredenciales(): void`. |
| `298` | ``{`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `299` | `$this->requireAdmin();` | Instrucción de ejecución en el contexto del script: `$this->requireAdmin();`. |
| `300` | `$idVocero = (int)($_POST['id_vocero'] ?? 0);` | Instrucción de ejecución en el contexto del script: `$idVocero = (int)($_POST['id_vocero'] ?? 0);`. |
| `301` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `302` | `$stmt = $this->db->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmt = $this->db->prepare(`. |
| `303` | `"SELECT v.*, u.id_usuario FROM voceros v` | Instrucción de ejecución en el contexto del script: `"SELECT v.*, u.id_usuario FROM voceros v`. |
| `304` | `JOIN usuarios u ON u.id_usuario = v.id_usuario` | Instrucción de ejecución en el contexto del script: `JOIN usuarios u ON u.id_usuario = v.id_usuario`. |
| `305` | `WHERE v.id_vocero = :id LIMIT 1"` | Instrucción de ejecución en el contexto del script: `WHERE v.id_vocero = :id LIMIT 1"`. |
| `306` | ``);`` | Cierre de estructura de arreglo o invocación de función. |
| `307` | `$stmt->execute([':id' => $idVocero]);` | Ejecuta la sentencia SQL preparada vinculando los parámetros correspondientes: `$stmt->execute([':id' => $idVocero]);`. |
| `308` | `$vocero = $stmt->fetch(PDO::FETCH_ASSOC);` | Recupera una única fila o registro resultante de la consulta. |
| `309` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `310` | `if (!$vocero) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (!$vocero) {`. |
| `311` | `$_SESSION['alert'] = ['icon'=>'error','title'=>'No encontrado','text'=>'...` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección. |
| `312` | `header("Location: ../views/dashboard/admin_voceros.php"); exit;` | Emite cabecera HTTP de redirección en el navegador y detiene la ejecución: `header("Location: ../views/dashboard/admin_voceros.php"); exit;`. |
| `313` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `314` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `315` | `// Generar nueva contraseña temporal` | Comentario explicativo en el código: `Generar nueva contraseña temporal`. |
| `316` | `$nuevaPassword = $this->generarPasswordTemporal();` | Instrucción de ejecución en el contexto del script: `$nuevaPassword = $this->generarPasswordTemporal();`. |
| `317` | `$modelUser     = new Usuario($this->db);` | Instrucción de ejecución en el contexto del script: `$modelUser     = new Usuario($this->db);`. |
| `318` | `$modelUser->actualizarPassword($vocero['id_usuario'], password_hash($nue...` | Instrucción de ejecución en el contexto del script: `$modelUser->actualizarPassword($vocero['id_usuario'], password_hash($nue...`. |
| `319` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `320` | `// NO se resetea primer_acceso: el vocero ya completó su primer acceso,` | Comentario explicativo en el código: `NO se resetea primer_acceso: el vocero ya completó su primer acceso,`. |
| `321` | `// solo se le entrega una nueva contraseña para que inicie sesión normal...` | Comentario explicativo en el código: `solo se le entrega una nueva contraseña para que inicie sesión normalmente.`. |
| `322` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `323` | `// En producción aquí se enviaría el correo con PHPMailer/SMTP` | Comentario explicativo en el código: `En producción aquí se enviaría el correo con PHPMailer/SMTP`. |
| `324` | `// Por ahora almacenamos en sesión para mostrar en pantalla` | Comentario explicativo en el código: `Por ahora almacenamos en sesión para mostrar en pantalla`. |
| `325` | `$_SESSION['alert'] = [` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección. |
| `326` | `'icon'  => 'success',` | Instrucción de ejecución en el contexto del script: `'icon'  => 'success',`. |
| `327` | `'title' => 'Credenciales reenviadas',` | Instrucción de ejecución en el contexto del script: `'title' => 'Credenciales reenviadas',`. |
| `328` | `'text'  => "Se generó nueva contraseña temporal para {$vocero['nombres']...` | Instrucción de ejecución en el contexto del script: `'text'  => "Se generó nueva contraseña temporal para {$vocero['nombres']...`. |
| `329` | ``];`` | Cierre de estructura de arreglo o invocación de función. |
| `330` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `331` | `header("Location: ../views/dashboard/admin_voceros.php"); exit;` | Emite cabecera HTTP de redirección en el navegador y detiene la ejecución: `header("Location: ../views/dashboard/admin_voceros.php"); exit;`. |
| `332` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `333` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `334` | `// ── ACTIVAR APRENDIZ COMO VOCERO ───────────────────────────────────────` | Comentario explicativo en el código: `── ACTIVAR APRENDIZ COMO VOCERO ───────────────────────────────────────`. |
| `335` | `public function activarVocero(): void` | Declaración de método o función con su firma y parámetros: `public function activarVocero(): void`. |
| `336` | ``{`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `337` | `$this->requireAdmin();` | Instrucción de ejecución en el contexto del script: `$this->requireAdmin();`. |
| `338` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `339` | `$idAprendiz = (int)($_POST['id_aprendiz'] ?? 0);` | Instrucción de ejecución en el contexto del script: `$idAprendiz = (int)($_POST['id_aprendiz'] ?? 0);`. |
| `340` | `$idFicha    = (int)($_POST['id_ficha']    ?? 0);` | Instrucción de ejecución en el contexto del script: `$idFicha    = (int)($_POST['id_ficha']    ?? 0);`. |
| `341` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `342` | `if (!$idAprendiz \|\| !$idFicha) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (!$idAprendiz \|\| !$idFicha) {`. |
| `343` | `$_SESSION['alert'] = ['icon'=>'warning','title'=>'Datos incompletos','te...` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección. |
| `344` | `header("Location: ../views/dashboard/admin_aprendices.php?ficha={$idFich...` | Emite cabecera HTTP de redirección en el navegador y detiene la ejecución: `header("Location: ../views/dashboard/admin_aprendices.php?ficha={$idFich...`. |
| `345` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `346` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `347` | `// Verificar que no haya ya 2 voceros activos` | Comentario explicativo en el código: `Verificar que no haya ya 2 voceros activos`. |
| `348` | `$stmtChk = $this->db->prepare("SELECT COUNT(*) FROM voceros WHERE id_fic...` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmtChk = $this->db->prepare("SELECT COUNT(*) FROM voceros WHERE id_fic...`. |
| `349` | `$stmtChk->execute([':fic' => $idFicha]);` | Ejecuta la sentencia SQL preparada vinculando los parámetros correspondientes: `$stmtChk->execute([':fic' => $idFicha]);`. |
| `350` | `if ((int)$stmtChk->fetchColumn() >= 2) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if ((int)$stmtChk->fetchColumn() >= 2) {`. |
| `351` | `$_SESSION['alert'] = ['icon'=>'error','title'=>'Límite alcanzado','text'...` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección. |
| `352` | `header("Location: ../views/dashboard/admin_aprendices.php?ficha={$idFich...` | Emite cabecera HTTP de redirección en el navegador y detiene la ejecución: `header("Location: ../views/dashboard/admin_aprendices.php?ficha={$idFich...`. |
| `353` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `354` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `355` | `// Datos del aprendiz` | Comentario explicativo en el código: `Datos del aprendiz`. |
| `356` | `$stmtAp = $this->db->prepare("SELECT * FROM aprendices WHERE id_aprendiz...` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmtAp = $this->db->prepare("SELECT * FROM aprendices WHERE id_aprendiz...`. |
| `357` | `$stmtAp->execute([':id' => $idAprendiz]);` | Ejecuta la sentencia SQL preparada vinculando los parámetros correspondientes: `$stmtAp->execute([':id' => $idAprendiz]);`. |
| `358` | `$aprendiz = $stmtAp->fetch(PDO::FETCH_ASSOC);` | Recupera una única fila o registro resultante de la consulta. |
| `359` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `360` | `if (!$aprendiz) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (!$aprendiz) {`. |
| `361` | `$_SESSION['alert'] = ['icon'=>'error','title'=>'No encontrado','text'=>'...` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección. |
| `362` | `header("Location: ../views/dashboard/admin_aprendices.php?ficha={$idFich...` | Emite cabecera HTTP de redirección en el navegador y detiene la ejecución: `header("Location: ../views/dashboard/admin_aprendices.php?ficha={$idFich...`. |
| `363` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `364` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `365` | `// Correo único usando id_aprendiz para evitar colisiones por documentos...` | Comentario explicativo en el código: `Correo único usando id_aprendiz para evitar colisiones por documentos du...`. |
| `366` | `$correo           = 'ap' . $idAprendiz . '@sena.edu.co';` | Instrucción de ejecución en el contexto del script: `$correo           = 'ap' . $idAprendiz . '@sena.edu.co';`. |
| `367` | `$passwordTemporal = $this->generarPasswordTemporal();` | Instrucción de ejecución en el contexto del script: `$passwordTemporal = $this->generarPasswordTemporal();`. |
| `368` | `$modelUser        = new Usuario($this->db);` | Instrucción de ejecución en el contexto del script: `$modelUser        = new Usuario($this->db);`. |
| `369` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `370` | `// Buscar si ya existe un vocero para ESTE aprendiz específico (por id_a...` | Comentario explicativo en el código: `Buscar si ya existe un vocero para ESTE aprendiz específico (por id_apre...`. |
| `371` | `$stmtVEx = $this->db->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmtVEx = $this->db->prepare(`. |
| `372` | `"SELECT v.id_vocero, v.id_usuario, v.activo` | Instrucción de ejecución en el contexto del script: `"SELECT v.id_vocero, v.id_usuario, v.activo`. |
| `373` | `FROM voceros v` | Instrucción de ejecución en el contexto del script: `FROM voceros v`. |
| `374` | `WHERE v.id_aprendiz = :idap AND v.id_ficha = :fic` | Instrucción de ejecución en el contexto del script: `WHERE v.id_aprendiz = :idap AND v.id_ficha = :fic`. |
| `375` | `LIMIT 1"` | Instrucción de ejecución en el contexto del script: `LIMIT 1"`. |
| `376` | ``);`` | Cierre de estructura de arreglo o invocación de función. |
| `377` | `$stmtVEx->execute([':idap' => $idAprendiz, ':fic' => $idFicha]);` | Ejecuta la sentencia SQL preparada vinculando los parámetros correspondientes: `$stmtVEx->execute([':idap' => $idAprendiz, ':fic' => $idFicha]);`. |
| `378` | `$voceroExistente = $stmtVEx->fetch(PDO::FETCH_ASSOC);` | Recupera una única fila o registro resultante de la consulta. |
| `379` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `380` | `if ($voceroExistente) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if ($voceroExistente) {`. |
| `381` | `// Ya existe: reactivar usuario y vocero` | Comentario explicativo en el código: `Ya existe: reactivar usuario y vocero`. |
| `382` | `$idUsuario = (int)$voceroExistente['id_usuario'];` | Instrucción de ejecución en el contexto del script: `$idUsuario = (int)$voceroExistente['id_usuario'];`. |
| `383` | `$this->db->prepare("UPDATE voceros SET activo = 1 WHERE id_vocero = :id")` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$this->db->prepare("UPDATE voceros SET activo = 1 WHERE id_vocero = :id")`. |
| `384` | `->execute([':id' => $voceroExistente['id_vocero']]);` | Ejecuta la sentencia SQL preparada vinculando los parámetros correspondientes: `->execute([':id' => $voceroExistente['id_vocero']]);`. |
| `385` | `$this->db->prepare("UPDATE usuarios SET activo = 1, id_rol = 2, primer_a...` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$this->db->prepare("UPDATE usuarios SET activo = 1, id_rol = 2, primer_a...`. |
| `386` | `->execute([':id' => $idUsuario]);` | Ejecuta la sentencia SQL preparada vinculando los parámetros correspondientes: `->execute([':id' => $idUsuario]);`. |
| `387` | `$modelUser->actualizarPassword($idUsuario, password_hash($passwordTempor...` | Instrucción de ejecución en el contexto del script: `$modelUser->actualizarPassword($idUsuario, password_hash($passwordTempor...`. |
| `388` | `} else {` | Instrucción de ejecución en el contexto del script: `} else {`. |
| `389` | `// Crear nuevo usuario para este aprendiz (correo único por id_aprendiz)` | Comentario explicativo en el código: `Crear nuevo usuario para este aprendiz (correo único por id_aprendiz)`. |
| `390` | `$idUsuario = $modelUser->crearVocero([` | Instrucción de ejecución en el contexto del script: `$idUsuario = $modelUser->crearVocero([`. |
| `391` | `'nombres'   => $aprendiz['nombres'],` | Instrucción de ejecución en el contexto del script: `'nombres'   => $aprendiz['nombres'],`. |
| `392` | `'apellidos' => $aprendiz['apellidos'],` | Instrucción de ejecución en el contexto del script: `'apellidos' => $aprendiz['apellidos'],`. |
| `393` | `'documento' => $aprendiz['documento'],` | Instrucción de ejecución en el contexto del script: `'documento' => $aprendiz['documento'],`. |
| `394` | `'celular'   => $aprendiz['celular'] ?? null,` | Instrucción de ejecución en el contexto del script: `'celular'   => $aprendiz['celular'] ?? null,`. |
| `395` | `'correo'    => $correo,` | Instrucción de ejecución en el contexto del script: `'correo'    => $correo,`. |
| `396` | `'password'  => password_hash($passwordTemporal, PASSWORD_DEFAULT),` | Instrucción de ejecución en el contexto del script: `'password'  => password_hash($passwordTemporal, PASSWORD_DEFAULT),`. |
| `397` | `]);` | Instrucción de ejecución en el contexto del script: `]);`. |
| `398` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `399` | `if (!$idUsuario) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (!$idUsuario) {`. |
| `400` | `$_SESSION['alert'] = ['icon'=>'error','title'=>'Error','text'=>'No se pu...` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección. |
| `401` | `header("Location: ../views/dashboard/admin_aprendices.php?ficha={$idFich...` | Emite cabecera HTTP de redirección en el navegador y detiene la ejecución: `header("Location: ../views/dashboard/admin_aprendices.php?ficha={$idFich...`. |
| `402` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `403` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `404` | `// Crear registro en voceros vinculado al id_aprendiz` | Comentario explicativo en el código: `Crear registro en voceros vinculado al id_aprendiz`. |
| `405` | `$this->db->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$this->db->prepare(`. |
| `406` | `"INSERT INTO voceros (id_usuario, id_ficha, id_aprendiz, nombres, apelli...` | Instrucción de ejecución en el contexto del script: `"INSERT INTO voceros (id_usuario, id_ficha, id_aprendiz, nombres, apelli...`. |
| `407` | `VALUES (:idu, :fic, :idap, :nom, :ape, :doc, :cor, 1)"` | Instrucción de ejecución en el contexto del script: `VALUES (:idu, :fic, :idap, :nom, :ape, :doc, :cor, 1)"`. |
| `408` | `)->execute([` | Ejecuta la sentencia SQL preparada vinculando los parámetros correspondientes: `)->execute([`. |
| `409` | `':idu'  => $idUsuario,` | Instrucción de ejecución en el contexto del script: `':idu'  => $idUsuario,`. |
| `410` | `':fic'  => $idFicha,` | Instrucción de ejecución en el contexto del script: `':fic'  => $idFicha,`. |
| `411` | `':idap' => $idAprendiz,` | Instrucción de ejecución en el contexto del script: `':idap' => $idAprendiz,`. |
| `412` | `':nom'  => $aprendiz['nombres'],` | Instrucción de ejecución en el contexto del script: `':nom'  => $aprendiz['nombres'],`. |
| `413` | `':ape'  => $aprendiz['apellidos'],` | Instrucción de ejecución en el contexto del script: `':ape'  => $aprendiz['apellidos'],`. |
| `414` | `':doc'  => $aprendiz['documento'],` | Instrucción de ejecución en el contexto del script: `':doc'  => $aprendiz['documento'],`. |
| `415` | `':cor'  => $correo,` | Instrucción de ejecución en el contexto del script: `':cor'  => $correo,`. |
| `416` | `]);` | Instrucción de ejecución en el contexto del script: `]);`. |
| `417` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `418` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `419` | `// Notificación interna con credenciales` | Comentario explicativo en el código: `Notificación interna con credenciales`. |
| `420` | `(new Notificacion($this->db))->crear([` | Instrucción de ejecución en el contexto del script: `(new Notificacion($this->db))->crear([`. |
| `421` | `'id_usuario'    => $idUsuario,` | Instrucción de ejecución en el contexto del script: `'id_usuario'    => $idUsuario,`. |
| `422` | `'id_asignacion' => null,` | Instrucción de ejecución en el contexto del script: `'id_asignacion' => null,`. |
| `423` | `'tipo'          => 'credenciales',` | Instrucción de ejecución en el contexto del script: `'tipo'          => 'credenciales',`. |
| `424` | `'titulo'        => 'Cuenta de Vocero activada',` | Instrucción de ejecución en el contexto del script: `'titulo'        => 'Cuenta de Vocero activada',`. |
| `425` | `'mensaje'       => "Tu cuenta fue activada. Correo: {$correo} \| Contras...` | Instrucción de ejecución en el contexto del script: `'mensaje'       => "Tu cuenta fue activada. Correo: {$correo} \| Contras...`. |
| `426` | `]);` | Instrucción de ejecución en el contexto del script: `]);`. |
| `427` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `428` | `$_SESSION['alert'] = [` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección. |
| `429` | `'icon'  => 'success',` | Instrucción de ejecución en el contexto del script: `'icon'  => 'success',`. |
| `430` | `'title' => 'Cuenta de vocero activada',` | Instrucción de ejecución en el contexto del script: `'title' => 'Cuenta de vocero activada',`. |
| `431` | `'text'  => 'Credenciales enviadas al vocero.',` | Instrucción de ejecución en el contexto del script: `'text'  => 'Credenciales enviadas al vocero.',`. |
| `432` | ``];`` | Cierre de estructura de arreglo o invocación de función. |
| `433` | `header("Location: ../views/dashboard/admin_aprendices.php?ficha={$idFich...` | Emite cabecera HTTP de redirección en el navegador y detiene la ejecución: `header("Location: ../views/dashboard/admin_aprendices.php?ficha={$idFich...`. |
| `434` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `435` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `436` | `// ── DESACTIVAR VOCERO ──────────────────────────────────────────────────` | Comentario explicativo en el código: `── DESACTIVAR VOCERO ──────────────────────────────────────────────────`. |
| `437` | `public function desactivarVocero(): void` | Declaración de método o función con su firma y parámetros: `public function desactivarVocero(): void`. |
| `438` | ``{`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `439` | `$this->requireAdmin();` | Instrucción de ejecución en el contexto del script: `$this->requireAdmin();`. |
| `440` | `$idVocero = (int)($_POST['id_vocero'] ?? 0);` | Instrucción de ejecución en el contexto del script: `$idVocero = (int)($_POST['id_vocero'] ?? 0);`. |
| `441` | `$idFicha  = (int)($_POST['id_ficha']  ?? 0);` | Instrucción de ejecución en el contexto del script: `$idFicha  = (int)($_POST['id_ficha']  ?? 0);`. |
| `442` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `443` | `if (!$idVocero) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (!$idVocero) {`. |
| `444` | `header("Location: ../views/dashboard/admin_aprendices.php?ficha={$idFich...` | Emite cabecera HTTP de redirección en el navegador y detiene la ejecución: `header("Location: ../views/dashboard/admin_aprendices.php?ficha={$idFich...`. |
| `445` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `446` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `447` | `// Leer el id_usuario ANTES de modificar el registro` | Comentario explicativo en el código: `Leer el id_usuario ANTES de modificar el registro`. |
| `448` | `$stmtU = $this->db->prepare("SELECT id_usuario FROM voceros WHERE id_voc...` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmtU = $this->db->prepare("SELECT id_usuario FROM voceros WHERE id_voc...`. |
| `449` | `$stmtU->execute([':id' => $idVocero]);` | Ejecuta la sentencia SQL preparada vinculando los parámetros correspondientes: `$stmtU->execute([':id' => $idVocero]);`. |
| `450` | `$row = $stmtU->fetch(PDO::FETCH_ASSOC);` | Recupera una única fila o registro resultante de la consulta. |
| `451` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `452` | `// Desactivar vocero` | Comentario explicativo en el código: `Desactivar vocero`. |
| `453` | `$this->db->prepare("UPDATE voceros SET activo = 0 WHERE id_vocero = :id")` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$this->db->prepare("UPDATE voceros SET activo = 0 WHERE id_vocero = :id")`. |
| `454` | `->execute([':id' => $idVocero]);` | Ejecuta la sentencia SQL preparada vinculando los parámetros correspondientes: `->execute([':id' => $idVocero]);`. |
| `455` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `456` | `// Desactivar usuario asociado solo si no tiene otro vocero activo en ot...` | Comentario explicativo en el código: `Desactivar usuario asociado solo si no tiene otro vocero activo en otra ...`. |
| `457` | `if ($row) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if ($row) {`. |
| `458` | `$stmtOtros = $this->db->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmtOtros = $this->db->prepare(`. |
| `459` | `"SELECT COUNT(*) FROM voceros` | Instrucción de ejecución en el contexto del script: `"SELECT COUNT(*) FROM voceros`. |
| `460` | `WHERE id_usuario = :uid AND activo = 1 AND id_vocero != :vid"` | Instrucción de ejecución en el contexto del script: `WHERE id_usuario = :uid AND activo = 1 AND id_vocero != :vid"`. |
| `461` | ``);`` | Cierre de estructura de arreglo o invocación de función. |
| `462` | `$stmtOtros->execute([':uid' => $row['id_usuario'], ':vid' => $idVocero]);` | Ejecuta la sentencia SQL preparada vinculando los parámetros correspondientes: `$stmtOtros->execute([':uid' => $row['id_usuario'], ':vid' => $idVocero]);`. |
| `463` | `if ((int)$stmtOtros->fetchColumn() === 0) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if ((int)$stmtOtros->fetchColumn() === 0) {`. |
| `464` | `// No tiene otros registros de vocero activos → desactivar la cuenta` | Comentario explicativo en el código: `No tiene otros registros de vocero activos → desactivar la cuenta`. |
| `465` | `$this->db->prepare("UPDATE usuarios SET activo = 0 WHERE id_usuario = :id")` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$this->db->prepare("UPDATE usuarios SET activo = 0 WHERE id_usuario = :id")`. |
| `466` | `->execute([':id' => $row['id_usuario']]);` | Ejecuta la sentencia SQL preparada vinculando los parámetros correspondientes: `->execute([':id' => $row['id_usuario']]);`. |
| `467` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `468` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `469` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `470` | `$_SESSION['alert'] = ['icon'=>'success','title'=>'Vocero desactivado','t...` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección. |
| `471` | `header("Location: ../views/dashboard/admin_aprendices.php?ficha={$idFich...` | Emite cabecera HTTP de redirección en el navegador y detiene la ejecución: `header("Location: ../views/dashboard/admin_aprendices.php?ficha={$idFich...`. |
| `472` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `473` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `474` | `// ── REACTIVAR VOCERO INACTIVO ──────────────────────────────────────────` | Comentario explicativo en el código: `── REACTIVAR VOCERO INACTIVO ──────────────────────────────────────────`. |
| `475` | `public function reactivarVocero(): void` | Declaración de método o función con su firma y parámetros: `public function reactivarVocero(): void`. |
| `476` | ``{`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `477` | `$this->requireAdmin();` | Instrucción de ejecución en el contexto del script: `$this->requireAdmin();`. |
| `478` | `$idVocero = (int)($_POST['id_vocero'] ?? 0);` | Instrucción de ejecución en el contexto del script: `$idVocero = (int)($_POST['id_vocero'] ?? 0);`. |
| `479` | `$idFicha  = (int)($_POST['id_ficha']  ?? 0);` | Instrucción de ejecución en el contexto del script: `$idFicha  = (int)($_POST['id_ficha']  ?? 0);`. |
| `480` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `481` | `// Verificar límite de 2` | Comentario explicativo en el código: `Verificar límite de 2`. |
| `482` | `$stmtChk = $this->db->prepare("SELECT COUNT(*) FROM voceros WHERE id_fic...` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmtChk = $this->db->prepare("SELECT COUNT(*) FROM voceros WHERE id_fic...`. |
| `483` | `$stmtChk->execute([':fic' => $idFicha]);` | Ejecuta la sentencia SQL preparada vinculando los parámetros correspondientes: `$stmtChk->execute([':fic' => $idFicha]);`. |
| `484` | `if ((int)$stmtChk->fetchColumn() >= 2) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if ((int)$stmtChk->fetchColumn() >= 2) {`. |
| `485` | `$_SESSION['alert'] = ['icon'=>'error','title'=>'Límite alcanzado','text'...` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección. |
| `486` | `header("Location: ../views/dashboard/admin_aprendices.php?ficha={$idFich...` | Emite cabecera HTTP de redirección en el navegador y detiene la ejecución: `header("Location: ../views/dashboard/admin_aprendices.php?ficha={$idFich...`. |
| `487` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `488` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `489` | `// Reactivar vocero y su usuario` | Comentario explicativo en el código: `Reactivar vocero y su usuario`. |
| `490` | `$stmtV = $this->db->prepare("SELECT id_usuario FROM voceros WHERE id_voc...` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmtV = $this->db->prepare("SELECT id_usuario FROM voceros WHERE id_voc...`. |
| `491` | `$stmtV->execute([':id' => $idVocero]);` | Ejecuta la sentencia SQL preparada vinculando los parámetros correspondientes: `$stmtV->execute([':id' => $idVocero]);`. |
| `492` | `$row = $stmtV->fetch(PDO::FETCH_ASSOC);` | Recupera una única fila o registro resultante de la consulta. |
| `493` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `494` | `$this->db->prepare("UPDATE voceros SET activo = 1 WHERE id_vocero = :id")` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$this->db->prepare("UPDATE voceros SET activo = 1 WHERE id_vocero = :id")`. |
| `495` | `->execute([':id' => $idVocero]);` | Ejecuta la sentencia SQL preparada vinculando los parámetros correspondientes: `->execute([':id' => $idVocero]);`. |
| `496` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `497` | `if ($row) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if ($row) {`. |
| `498` | `$this->db->prepare("UPDATE usuarios SET activo = 1, primer_acceso = 1 WH...` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$this->db->prepare("UPDATE usuarios SET activo = 1, primer_acceso = 1 WH...`. |
| `499` | `->execute([':id' => $row['id_usuario']]);` | Ejecuta la sentencia SQL preparada vinculando los parámetros correspondientes: `->execute([':id' => $row['id_usuario']]);`. |
| `500` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `501` | `$nuevaPassword = $this->generarPasswordTemporal();` | Instrucción de ejecución en el contexto del script: `$nuevaPassword = $this->generarPasswordTemporal();`. |
| `502` | `(new Usuario($this->db))->actualizarPassword(` | Instrucción de ejecución en el contexto del script: `(new Usuario($this->db))->actualizarPassword(`. |
| `503` | `(int)$row['id_usuario'],` | Instrucción de ejecución en el contexto del script: `(int)$row['id_usuario'],`. |
| `504` | `password_hash($nuevaPassword, PASSWORD_DEFAULT)` | Instrucción de ejecución en el contexto del script: `password_hash($nuevaPassword, PASSWORD_DEFAULT)`. |
| `505` | ``);`` | Cierre de estructura de arreglo o invocación de función. |
| `506` | `// Resetear primer_acceso` | Comentario explicativo en el código: `Resetear primer_acceso`. |
| `507` | `$this->db->prepare("UPDATE usuarios SET primer_acceso = 1 WHERE id_usuar...` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$this->db->prepare("UPDATE usuarios SET primer_acceso = 1 WHERE id_usuar...`. |
| `508` | `->execute([':id' => $row['id_usuario']]);` | Ejecuta la sentencia SQL preparada vinculando los parámetros correspondientes: `->execute([':id' => $row['id_usuario']]);`. |
| `509` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `510` | `$_SESSION['alert'] = [` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección. |
| `511` | `'icon'  => 'success',` | Instrucción de ejecución en el contexto del script: `'icon'  => 'success',`. |
| `512` | `'title' => 'Cuenta de vocero activada',` | Instrucción de ejecución en el contexto del script: `'title' => 'Cuenta de vocero activada',`. |
| `513` | `'text'  => 'Credenciales enviadas al vocero.',` | Instrucción de ejecución en el contexto del script: `'text'  => 'Credenciales enviadas al vocero.',`. |
| `514` | ``];`` | Cierre de estructura de arreglo o invocación de función. |
| `515` | `} else {` | Instrucción de ejecución en el contexto del script: `} else {`. |
| `516` | `$_SESSION['alert'] = ['icon'=>'success','title'=>'Cuenta de vocero activ...` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección. |
| `517` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `518` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `519` | `header("Location: ../views/dashboard/admin_aprendices.php?ficha={$idFich...` | Emite cabecera HTTP de redirección en el navegador y detiene la ejecución: `header("Location: ../views/dashboard/admin_aprendices.php?ficha={$idFich...`. |
| `520` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `521` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `522` | `// ── HELPERS ────────────────────────────────────────────────────────────` | Comentario explicativo en el código: `── HELPERS ────────────────────────────────────────────────────────────`. |
| `523` | `private function requireAdmin(): void` | Declaración de método o función con su firma y parámetros: `private function requireAdmin(): void`. |
| `524` | ``{`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `525` | `if (!isset($_SESSION['usuario']) \|\| (int)$_SESSION['usuario']['rol'] !...` | Verifica autenticación y rol del usuario; redirige al login si no tiene permisos. |
| `526` | `header("Location: ../views/usuarios/login.php"); exit;` | Emite cabecera HTTP de redirección en el navegador y detiene la ejecución: `header("Location: ../views/usuarios/login.php"); exit;`. |
| `527` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `528` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `529` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `530` | `private function notificarVoceroAsignacion(int $idFicha, int $idAsignaci...` | Declaración de método o función con su firma y parámetros: `private function notificarVoceroAsignacion(int $idFicha, int $idAsignaci...`. |
| `531` | ``{`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `532` | `$stmt = $this->db->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmt = $this->db->prepare(`. |
| `533` | `"SELECT v.id_usuario, m.nombre AS nombre_modulo, a.fecha_limite_evidencia` | Instrucción de ejecución en el contexto del script: `"SELECT v.id_usuario, m.nombre AS nombre_modulo, a.fecha_limite_evidencia`. |
| `534` | `FROM voceros v` | Instrucción de ejecución en el contexto del script: `FROM voceros v`. |
| `535` | `JOIN asignaciones a ON a.id_asignacion = :asig` | Instrucción de ejecución en el contexto del script: `JOIN asignaciones a ON a.id_asignacion = :asig`. |
| `536` | `JOIN modulos m ON m.id_modulo = a.id_modulo` | Instrucción de ejecución en el contexto del script: `JOIN modulos m ON m.id_modulo = a.id_modulo`. |
| `537` | `WHERE v.id_ficha = :ficha AND v.activo = 1 LIMIT 1"` | Instrucción de ejecución en el contexto del script: `WHERE v.id_ficha = :ficha AND v.activo = 1 LIMIT 1"`. |
| `538` | ``);`` | Cierre de estructura de arreglo o invocación de función. |
| `539` | `$stmt->execute([':asig' => $idAsignacion, ':ficha' => $idFicha]);` | Ejecuta la sentencia SQL preparada vinculando los parámetros correspondientes: `$stmt->execute([':asig' => $idAsignacion, ':ficha' => $idFicha]);`. |
| `540` | `$data = $stmt->fetch(PDO::FETCH_ASSOC);` | Recupera una única fila o registro resultante de la consulta. |
| `541` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `542` | `if (!$data) return;` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (!$data) return;`. |
| `543` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `544` | `$noti = new Notificacion($this->db);` | Instrucción de ejecución en el contexto del script: `$noti = new Notificacion($this->db);`. |
| `545` | `$noti->crear([` | Instrucción de ejecución en el contexto del script: `$noti->crear([`. |
| `546` | `'id_usuario'    => $data['id_usuario'],` | Instrucción de ejecución en el contexto del script: `'id_usuario'    => $data['id_usuario'],`. |
| `547` | `'id_asignacion' => $idAsignacion,` | Instrucción de ejecución en el contexto del script: `'id_asignacion' => $idAsignacion,`. |
| `548` | `'tipo'          => 'info',` | Instrucción de ejecución en el contexto del script: `'tipo'          => 'info',`. |
| `549` | `'titulo'        => 'Nuevo módulo asignado',` | Instrucción de ejecución en el contexto del script: `'titulo'        => 'Nuevo módulo asignado',`. |
| `550` | `'mensaje'       => "Se te ha asignado el módulo «{$data['nombre_modulo']...` | Instrucción de ejecución en el contexto del script: `'mensaje'       => "Se te ha asignado el módulo «{$data['nombre_modulo']...`. |
| `551` | `]);` | Instrucción de ejecución en el contexto del script: `]);`. |
| `552` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `553` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `554` | `private function generarPasswordTemporal(): string` | Declaración de método o función con su firma y parámetros: `private function generarPasswordTemporal(): string`. |
| `555` | ``{`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `556` | `$chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789...` | Instrucción de ejecución en el contexto del script: `$chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789...`. |
| `557` | `return substr(str_shuffle($chars), 0, 10);` | Instrucción de retorno que finaliza la ejecución entregando el resultado: `return substr(str_shuffle($chars), 0, 10);`. |
| `558` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `559` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `560` | `// ── GET EVIDENCIA POR TURNO (JSON para el calendario) ───────────────────` | Comentario explicativo en el código: `── GET EVIDENCIA POR TURNO (JSON para el calendario) ───────────────────`. |
| `561` | `public function getEvidenciaTurno(): void` | Declaración de método o función con su firma y parámetros: `public function getEvidenciaTurno(): void`. |
| `562` | ``{`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `563` | `header('Content-Type: application/json');` | Emite cabecera HTTP de respuesta hacia el cliente: `header('Content-Type: application/json');`. |
| `564` | `if (!isset($_SESSION['usuario']) \|\| (int)$_SESSION['usuario']['rol'] !...` | Verifica autenticación y rol del usuario; redirige al login si no tiene permisos. |
| `565` | `http_response_code(403);` | Instrucción de ejecución en el contexto del script: `http_response_code(403);`. |
| `566` | `echo json_encode(['error' => 'No autorizado']);` | Instrucción de ejecución en el contexto del script: `echo json_encode(['error' => 'No autorizado']);`. |
| `567` | `exit;` | Finaliza la ejecución de la función o script. |
| `568` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `569` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `570` | `$idTurno = (int)($_GET['id_turno'] ?? 0);` | Instrucción de ejecución en el contexto del script: `$idTurno = (int)($_GET['id_turno'] ?? 0);`. |
| `571` | `if (!$idTurno) { echo json_encode(['par' => null]); exit; }` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (!$idTurno) { echo json_encode(['par' => null]); exit; }`. |
| `572` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `573` | `$stmt = $this->db->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmt = $this->db->prepare(`. |
| `574` | `"SELECT tipo, ruta_archivo AS ruta, observaciones` | Instrucción de ejecución en el contexto del script: `"SELECT tipo, ruta_archivo AS ruta, observaciones`. |
| `575` | `FROM evidencias` | Instrucción de ejecución en el contexto del script: `FROM evidencias`. |
| `576` | `WHERE id_turno = :id` | Instrucción de ejecución en el contexto del script: `WHERE id_turno = :id`. |
| `577` | `AND tipo IN ('antes','despues')` | Instrucción de ejecución en el contexto del script: `AND tipo IN ('antes','despues')`. |
| `578` | `ORDER BY tipo ASC"` | Instrucción de ejecución en el contexto del script: `ORDER BY tipo ASC"`. |
| `579` | ``);`` | Cierre de estructura de arreglo o invocación de función. |
| `580` | `$stmt->execute([':id' => $idTurno]);` | Ejecuta la sentencia SQL preparada vinculando los parámetros correspondientes: `$stmt->execute([':id' => $idTurno]);`. |
| `581` | `$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);` | Obtiene todos los registros coincidentes de la consulta en un arreglo asociativo. |
| `582` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `583` | `$par = ['antes' => null, 'despues' => null];` | Instrucción de ejecución en el contexto del script: `$par = ['antes' => null, 'despues' => null];`. |
| `584` | `$obs = '';` | Instrucción de ejecución en el contexto del script: `$obs = '';`. |
| `585` | `foreach ($rows as $r) {` | Estructura de control iterativa para recorrer colecciones o arreglos: `foreach ($rows as $r) {`. |
| `586` | `$par[$r['tipo']] = ['ruta' => $r['ruta']];` | Instrucción de ejecución en el contexto del script: `$par[$r['tipo']] = ['ruta' => $r['ruta']];`. |
| `587` | `if (!empty($r['observaciones'])) $obs = $r['observaciones'];` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (!empty($r['observaciones'])) $obs = $r['observaciones'];`. |
| `588` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `589` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `590` | `echo json_encode(['par' => $par, 'observaciones' => $obs]);` | Instrucción de ejecución en el contexto del script: `echo json_encode(['par' => $par, 'observaciones' => $obs]);`. |
| `591` | `exit;` | Finaliza la ejecución de la función o script. |
| `592` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `593` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `594` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `595` | `// ── Dispatcher ───────────────────────────────────────────────────────...` | Comentario explicativo en el código: `── Dispatcher ────────────────────────────────────────────────────────────`. |
| `596` | `if (basename(__FILE__) === basename($_SERVER['SCRIPT_FILENAME'])) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (basename(__FILE__) === basename($_SERVER['SCRIPT_FILENAME'])) {`. |
| `597` | `$controller = new AdminController();` | Instrucción de ejecución en el contexto del script: `$controller = new AdminController();`. |
| `598` | `$accion     = $_POST['accion'] ?? $_GET['accion'] ?? '';` | Instrucción de ejecución en el contexto del script: `$accion     = $_POST['accion'] ?? $_GET['accion'] ?? '';`. |
| `599` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `600` | `match ($accion) {` | Estructura de coincidencia condicional `match` para despacho de acciones del controlador. |
| `601` | `'guardar_programa'   => $controller->guardarPrograma(),` | Instrucción de ejecución en el contexto del script: `'guardar_programa'   => $controller->guardarPrograma(),`. |
| `602` | `'eliminar_programa'  => $controller->eliminarPrograma(),` | Instrucción de ejecución en el contexto del script: `'eliminar_programa'  => $controller->eliminarPrograma(),`. |
| `603` | `'guardar_ficha'      => $controller->guardarFicha(),` | Instrucción de ejecución en el contexto del script: `'guardar_ficha'      => $controller->guardarFicha(),`. |
| `604` | `'eliminar_ficha'     => $controller->eliminarFicha(),` | Instrucción de ejecución en el contexto del script: `'eliminar_ficha'     => $controller->eliminarFicha(),`. |
| `605` | `'guardar_modulo'     => $controller->guardarModulo(),` | Instrucción de ejecución en el contexto del script: `'guardar_modulo'     => $controller->guardarModulo(),`. |
| `606` | `'asignar_modulo'     => $controller->asignarModulo(),` | Instrucción de ejecución en el contexto del script: `'asignar_modulo'     => $controller->asignarModulo(),`. |
| `607` | `'editar_asignacion'  => $controller->editarAsignacion(),` | Instrucción de ejecución en el contexto del script: `'editar_asignacion'  => $controller->editarAsignacion(),`. |
| `608` | `'cancelar_asignacion'=> $controller->cancelarAsignacion(),` | Instrucción de ejecución en el contexto del script: `'cancelar_asignacion'=> $controller->cancelarAsignacion(),`. |
| `609` | `'reenviar_credenciales' => $controller->reenviarCredenciales(),` | Instrucción de ejecución en el contexto del script: `'reenviar_credenciales' => $controller->reenviarCredenciales(),`. |
| `610` | `'activar_vocero'        => $controller->activarVocero(),` | Instrucción de ejecución en el contexto del script: `'activar_vocero'        => $controller->activarVocero(),`. |
| `611` | `'desactivar_vocero'     => $controller->desactivarVocero(),` | Instrucción de ejecución en el contexto del script: `'desactivar_vocero'     => $controller->desactivarVocero(),`. |
| `612` | `'reactivar_vocero'      => $controller->reactivarVocero(),` | Instrucción de ejecución en el contexto del script: `'reactivar_vocero'      => $controller->reactivarVocero(),`. |
| `613` | `'get_evidencia_turno'   => $controller->getEvidenciaTurno(),` | Instrucción de ejecución en el contexto del script: `'get_evidencia_turno'   => $controller->getEvidenciaTurno(),`. |
| `614` | `default              => header("Location: ../views/dashboard/admin_dashb...` | Emite cabecera HTTP de respuesta hacia el cliente: `default              => header("Location: ../views/dashboard/admin_dashb...`. |
| `615` | `};` | Instrucción de ejecución en el contexto del script: `};`. |
| `616` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `617` | ``?>`` | Cierre de la etiqueta PHP para alternar a salida HTML o fin del archivo. |

---

## 3. Resumen y Flujo de Interacción

El archivo `AdminController.php` cumple un rol indispensable en `controllers/AdminController.php`. 
Controlador principal del módulo de administración. Gestiona programas de formación, fichas, módulos, asignaciones de grupos, voceros, turnos y supervisión de evidencias. Garantiza la robustez, el orden y la estabilidad de la arquitectura del proyecto `systemLimpieza`.

---

Generado automáticamente para el repositorio [johanrepizo/LimpiezaDeModulos](https://github.com/johanrepizo/LimpiezaDeModulos).
