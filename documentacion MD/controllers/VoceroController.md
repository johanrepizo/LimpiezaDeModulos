# Documentación Línea por Línea: `controllers/VoceroController.php`

## 1. Ficha Técnica del Archivo

- **Archivo:** `VoceroController.php`
- **Ruta en el proyecto:** `controllers/VoceroController.php`
- **Cantidad total de líneas:** `544`
- **Tipo de archivo:** `PHP`
- **Propósito general:** Controlador para el rol Vocero. Permite registrar y editar grupos de limpieza de la ficha, asignar aprendices y subir evidencias fotográficas de los turnos.

---

## 2. Explicación Detallada Línea por Línea

A continuación se presenta cada línea de código numerada de forma consecutiva, acompañada de su fragmento exacto y la explicación exhaustiva de su funcionamiento y responsabilidad en el sistema:

| Línea | Código Fuente | Explicación Detallada |
|---|---|---|
| `1` | ``<?php`` | Apertura obligatoria de la etiqueta PHP para ejecución del código del lado del servidor. |
| `2` | `if (session_status() === PHP_SESSION_NONE) session_start();` | Inicia o reanuda la sesión PHP del usuario si no se encontraba activa previamente. |
| `3` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `4` | `require_once __DIR__ . '/../config/database.php';` | Importación e inclusión obligatoria del archivo de dependencia requerido: `require_once __DIR__ . '/../config/database.php';`. |
| `5` | `require_once __DIR__ . '/../models/Grupo.php';` | Importación e inclusión obligatoria del archivo de dependencia requerido: `require_once __DIR__ . '/../models/Grupo.php';`. |
| `6` | `require_once __DIR__ . '/../models/Evidencia.php';` | Importación e inclusión obligatoria del archivo de dependencia requerido: `require_once __DIR__ . '/../models/Evidencia.php';`. |
| `7` | `require_once __DIR__ . '/../models/Ficha.php';` | Importación e inclusión obligatoria del archivo de dependencia requerido: `require_once __DIR__ . '/../models/Ficha.php';`. |
| `8` | `require_once __DIR__ . '/../models/Notificacion.php';` | Importación e inclusión obligatoria del archivo de dependencia requerido: `require_once __DIR__ . '/../models/Notificacion.php';`. |
| `9` | `require_once __DIR__ . '/../models/Turno.php';` | Importación e inclusión obligatoria del archivo de dependencia requerido: `require_once __DIR__ . '/../models/Turno.php';`. |
| `10` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `11` | `class VoceroController` | Declaración de la clase del componente: `class VoceroController`. |
| `12` | ``{`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `13` | `private PDO $db;` | Definición de propiedad de clase para el estado interno del componente: `private PDO $db;`. |
| `14` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `15` | `public function __construct()` | Declaración de método o función con su firma y parámetros: `public function __construct()`. |
| `16` | ``{`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `17` | `$this->db = (new Database())->conectar();` | Instrucción de ejecución en el contexto del script: `$this->db = (new Database())->conectar();`. |
| `18` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `19` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `20` | `// ── GUARDAR GRUPO ──────────────────────────────────────────────────────` | Comentario explicativo en el código: `── GUARDAR GRUPO ──────────────────────────────────────────────────────`. |
| `21` | `public function guardarGrupo(): void` | Declaración de método o función con su firma y parámetros: `public function guardarGrupo(): void`. |
| `22` | ``{`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `23` | `$this->requireVocero();` | Instrucción de ejecución en el contexto del script: `$this->requireVocero();`. |
| `24` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `25` | `$idVocero     = $this->getIdVocero();` | Instrucción de ejecución en el contexto del script: `$idVocero     = $this->getIdVocero();`. |
| `26` | `$idAsignacion = (int)($_POST['id_asignacion'] ?? 0);` | Instrucción de ejecución en el contexto del script: `$idAsignacion = (int)($_POST['id_asignacion'] ?? 0);`. |
| `27` | `$aprendices   = $_POST['aprendices'] ?? [];` | Instrucción de ejecución en el contexto del script: `$aprendices   = $_POST['aprendices'] ?? [];`. |
| `28` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `29` | `if (!$idAsignacion) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (!$idAsignacion) {`. |
| `30` | `$_SESSION['alert'] = ['icon'=>'warning','title'=>'Sin módulo asignado','...` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección. |
| `31` | `header("Location: ../views/dashboard/vocero_grupos.php"); exit;` | Emite cabecera HTTP de redirección en el navegador y detiene la ejecución: `header("Location: ../views/dashboard/vocero_grupos.php"); exit;`. |
| `32` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `33` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `34` | `if (empty($aprendices)) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (empty($aprendices)) {`. |
| `35` | `$_SESSION['alert'] = ['icon'=>'warning','title'=>'Sin integrantes','text...` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección. |
| `36` | `header("Location: ../views/dashboard/vocero_grupos.php"); exit;` | Emite cabecera HTTP de redirección en el navegador y detiene la ejecución: `header("Location: ../views/dashboard/vocero_grupos.php"); exit;`. |
| `37` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `38` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `39` | `// Obtener id_ficha de la asignación` | Comentario explicativo en el código: `Obtener id_ficha de la asignación`. |
| `40` | `$stmtA = $this->db->prepare("SELECT id_ficha FROM asignaciones WHERE id_...` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmtA = $this->db->prepare("SELECT id_ficha FROM asignaciones WHERE id_...`. |
| `41` | `$stmtA->execute([':id' => $idAsignacion]);` | Ejecuta la sentencia SQL preparada vinculando los parámetros correspondientes: `$stmtA->execute([':id' => $idAsignacion]);`. |
| `42` | `$idFicha = (int)($stmtA->fetchColumn() ?: 0);` | Recupera el valor escalar de la primera columna del resultado de la consulta. |
| `43` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `44` | `$modelGrupo = new Grupo($this->db);` | Instrucción de ejecución en el contexto del script: `$modelGrupo = new Grupo($this->db);`. |
| `45` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `46` | `// Validar que ningún aprendiz ya esté en otro grupo de esta ficha` | Comentario explicativo en el código: `Validar que ningún aprendiz ya esté en otro grupo de esta ficha`. |
| `47` | `$ocupados = $modelGrupo->aprendicesOcupadosEnFicha($idFicha);` | Instrucción de ejecución en el contexto del script: `$ocupados = $modelGrupo->aprendicesOcupadosEnFicha($idFicha);`. |
| `48` | `$repetidos = array_intersect(array_map('intval', $aprendices), $ocupados);` | Instrucción de ejecución en el contexto del script: `$repetidos = array_intersect(array_map('intval', $aprendices), $ocupados);`. |
| `49` | `if (!empty($repetidos)) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (!empty($repetidos)) {`. |
| `50` | `$_SESSION['alert'] = ['icon'=>'error','title'=>'Aprendiz ya asignado','t...` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección. |
| `51` | `header("Location: ../views/dashboard/vocero_grupos.php"); exit;` | Emite cabecera HTTP de redirección en el navegador y detiene la ejecución: `header("Location: ../views/dashboard/vocero_grupos.php"); exit;`. |
| `52` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `53` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `54` | `// Nombre automático` | Comentario explicativo en el código: `Nombre automático`. |
| `55` | `$nombreGrupo = $modelGrupo->proximoNombreGrupo($idVocero);` | Instrucción de ejecución en el contexto del script: `$nombreGrupo = $modelGrupo->proximoNombreGrupo($idVocero);`. |
| `56` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `57` | `// Próximo turno libre` | Comentario explicativo en el código: `Próximo turno libre`. |
| `58` | `$modelTurno    = new Turno($this->db);` | Instrucción de ejecución en el contexto del script: `$modelTurno    = new Turno($this->db);`. |
| `59` | `$fechaLimpieza = $modelTurno->proximaFechaLibre($idAsignacion);` | Instrucción de ejecución en el contexto del script: `$fechaLimpieza = $modelTurno->proximaFechaLibre($idAsignacion);`. |
| `60` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `61` | `if (!$fechaLimpieza) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (!$fechaLimpieza) {`. |
| `62` | `$_SESSION['alert'] = ['icon'=>'error','title'=>'Sin turnos disponibles',...` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección. |
| `63` | `header("Location: ../views/dashboard/vocero_grupos.php"); exit;` | Emite cabecera HTTP de redirección en el navegador y detiene la ejecución: `header("Location: ../views/dashboard/vocero_grupos.php"); exit;`. |
| `64` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `65` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `66` | `$resultado = $modelGrupo->crear([` | Instrucción de ejecución en el contexto del script: `$resultado = $modelGrupo->crear([`. |
| `67` | `'id_asignacion'  => $idAsignacion,` | Instrucción de ejecución en el contexto del script: `'id_asignacion'  => $idAsignacion,`. |
| `68` | `'id_vocero'      => $idVocero,` | Instrucción de ejecución en el contexto del script: `'id_vocero'      => $idVocero,`. |
| `69` | `'nombre_grupo'   => $nombreGrupo,` | Instrucción de ejecución en el contexto del script: `'nombre_grupo'   => $nombreGrupo,`. |
| `70` | `'fecha_limpieza' => $fechaLimpieza,` | Instrucción de ejecución en el contexto del script: `'fecha_limpieza' => $fechaLimpieza,`. |
| `71` | `], $aprendices);` | Instrucción de ejecución en el contexto del script: `], $aprendices);`. |
| `72` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `73` | `if ($resultado) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if ($resultado) {`. |
| `74` | `$modelTurno->asignarGrupoAlTurno($idAsignacion, $fechaLimpieza, $resulta...` | Instrucción de ejecución en el contexto del script: `$modelTurno->asignarGrupoAlTurno($idAsignacion, $fechaLimpieza, $resulta...`. |
| `75` | `$modelGrupo->registrarHistorial(` | Instrucción de ejecución en el contexto del script: `$modelGrupo->registrarHistorial(`. |
| `76` | `$resultado,` | Instrucción de ejecución en el contexto del script: `$resultado,`. |
| `77` | `"Grupo '{$nombreGrupo}' creado con " . count($aprendices) . " integrante...` | Instrucción de ejecución en el contexto del script: `"Grupo '{$nombreGrupo}' creado con " . count($aprendices) . " integrante...`. |
| `78` | `$_SESSION['usuario']['id_usuario']` | Instrucción de ejecución en el contexto del script: `$_SESSION['usuario']['id_usuario']`. |
| `79` | ``);`` | Cierre de estructura de arreglo o invocación de función. |
| `80` | `$_SESSION['alert'] = [` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección. |
| `81` | `'icon'  => 'success',` | Instrucción de ejecución en el contexto del script: `'icon'  => 'success',`. |
| `82` | `'title' => '¡Grupo registrado!',` | Instrucción de ejecución en el contexto del script: `'title' => '¡Grupo registrado!',`. |
| `83` | `'text'  => "{$nombreGrupo} · Fecha de limpieza: " . date('d/m/Y', strtot...` | Instrucción de ejecución en el contexto del script: `'text'  => "{$nombreGrupo} · Fecha de limpieza: " . date('d/m/Y', strtot...`. |
| `84` | ``];`` | Cierre de estructura de arreglo o invocación de función. |
| `85` | `} else {` | Instrucción de ejecución en el contexto del script: `} else {`. |
| `86` | `$_SESSION['alert'] = ['icon'=>'error','title'=>'Error','text'=>'No se pu...` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección. |
| `87` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `88` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `89` | `header("Location: ../views/dashboard/vocero_grupos.php"); exit;` | Emite cabecera HTTP de redirección en el navegador y detiene la ejecución: `header("Location: ../views/dashboard/vocero_grupos.php"); exit;`. |
| `90` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `91` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `92` | `// ── EDITAR GRUPO ───────────────────────────────────────────────────────` | Comentario explicativo en el código: `── EDITAR GRUPO ───────────────────────────────────────────────────────`. |
| `93` | `public function editarGrupo(): void` | Declaración de método o función con su firma y parámetros: `public function editarGrupo(): void`. |
| `94` | ``{`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `95` | `$this->requireVocero();` | Instrucción de ejecución en el contexto del script: `$this->requireVocero();`. |
| `96` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `97` | `$idGrupo    = (int)($_POST['id_grupo']  ?? 0);` | Instrucción de ejecución en el contexto del script: `$idGrupo    = (int)($_POST['id_grupo']  ?? 0);`. |
| `98` | `$aprendices = $_POST['aprendices']      ?? [];` | Instrucción de ejecución en el contexto del script: `$aprendices = $_POST['aprendices']      ?? [];`. |
| `99` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `100` | `if (!$idGrupo \|\| empty($aprendices)) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (!$idGrupo \|\| empty($aprendices)) {`. |
| `101` | `$_SESSION['alert'] = ['icon'=>'warning','title'=>'Datos incompletos','te...` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección. |
| `102` | `header("Location: ../views/dashboard/vocero_grupos.php"); exit;` | Emite cabecera HTTP de redirección en el navegador y detiene la ejecución: `header("Location: ../views/dashboard/vocero_grupos.php"); exit;`. |
| `103` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `104` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `105` | `$modelGrupo = new Grupo($this->db);` | Instrucción de ejecución en el contexto del script: `$modelGrupo = new Grupo($this->db);`. |
| `106` | `$grupo      = $modelGrupo->obtenerPorId($idGrupo);` | Instrucción de ejecución en el contexto del script: `$grupo      = $modelGrupo->obtenerPorId($idGrupo);`. |
| `107` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `108` | `if (!$grupo) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (!$grupo) {`. |
| `109` | `$_SESSION['alert'] = ['icon'=>'error','title'=>'No encontrado','text'=>'...` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección. |
| `110` | `header("Location: ../views/dashboard/vocero_grupos.php"); exit;` | Emite cabecera HTTP de redirección en el navegador y detiene la ejecución: `header("Location: ../views/dashboard/vocero_grupos.php"); exit;`. |
| `111` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `112` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `113` | `// Validar que ningún aprendiz nuevo ya esté en otro grupo de la ficha` | Comentario explicativo en el código: `Validar que ningún aprendiz nuevo ya esté en otro grupo de la ficha`. |
| `114` | `$idFicha = (int)($grupo['id_ficha'] ?? 0);` | Instrucción de ejecución en el contexto del script: `$idFicha = (int)($grupo['id_ficha'] ?? 0);`. |
| `115` | `if ($idFicha) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if ($idFicha) {`. |
| `116` | `$ocupados  = $modelGrupo->aprendicesOcupadosEnFicha($idFicha, $idGrupo);` | Instrucción de ejecución en el contexto del script: `$ocupados  = $modelGrupo->aprendicesOcupadosEnFicha($idFicha, $idGrupo);`. |
| `117` | `$repetidos = array_intersect(array_map('intval', $aprendices), $ocupados);` | Instrucción de ejecución en el contexto del script: `$repetidos = array_intersect(array_map('intval', $aprendices), $ocupados);`. |
| `118` | `if (!empty($repetidos)) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (!empty($repetidos)) {`. |
| `119` | `$_SESSION['alert'] = ['icon'=>'error','title'=>'Aprendiz ya asignado','t...` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección. |
| `120` | `header("Location: ../views/dashboard/vocero_grupos.php"); exit;` | Emite cabecera HTTP de redirección en el navegador y detiene la ejecución: `header("Location: ../views/dashboard/vocero_grupos.php"); exit;`. |
| `121` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `122` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `123` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `124` | `// Si la fecha ya pasó, reasignar automáticamente al próximo turno libre` | Comentario explicativo en el código: `Si la fecha ya pasó, reasignar automáticamente al próximo turno libre`. |
| `125` | `$fechaLimpieza = $grupo['fecha_limpieza'];` | Instrucción de ejecución en el contexto del script: `$fechaLimpieza = $grupo['fecha_limpieza'];`. |
| `126` | `if (strtotime($fechaLimpieza) < strtotime('today')) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (strtotime($fechaLimpieza) < strtotime('today')) {`. |
| `127` | `$modelTurno    = new Turno($this->db);` | Instrucción de ejecución en el contexto del script: `$modelTurno    = new Turno($this->db);`. |
| `128` | `$idAsignacion  = (int)$grupo['id_asignacion'];` | Instrucción de ejecución en el contexto del script: `$idAsignacion  = (int)$grupo['id_asignacion'];`. |
| `129` | `$nuevaFecha    = $modelTurno->proximaFechaLibre($idAsignacion);` | Instrucción de ejecución en el contexto del script: `$nuevaFecha    = $modelTurno->proximaFechaLibre($idAsignacion);`. |
| `130` | `if ($nuevaFecha) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if ($nuevaFecha) {`. |
| `131` | `$fechaLimpieza = $nuevaFecha;` | Instrucción de ejecución en el contexto del script: `$fechaLimpieza = $nuevaFecha;`. |
| `132` | `// Vincular turno al grupo` | Comentario explicativo en el código: `Vincular turno al grupo`. |
| `133` | `$modelTurno->asignarGrupoAlTurno($idAsignacion, $nuevaFecha, $idGrupo);` | Instrucción de ejecución en el contexto del script: `$modelTurno->asignarGrupoAlTurno($idAsignacion, $nuevaFecha, $idGrupo);`. |
| `134` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `135` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `136` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `137` | `$resultado = $modelGrupo->actualizar($idGrupo, [` | Instrucción de ejecución en el contexto del script: `$resultado = $modelGrupo->actualizar($idGrupo, [`. |
| `138` | `'nombre_grupo'   => $grupo['nombre_grupo'],` | Instrucción de ejecución en el contexto del script: `'nombre_grupo'   => $grupo['nombre_grupo'],`. |
| `139` | `'fecha_limpieza' => $fechaLimpieza,` | Instrucción de ejecución en el contexto del script: `'fecha_limpieza' => $fechaLimpieza,`. |
| `140` | `], $aprendices);` | Instrucción de ejecución en el contexto del script: `], $aprendices);`. |
| `141` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `142` | `if ($resultado) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if ($resultado) {`. |
| `143` | `$modelGrupo->registrarHistorial(` | Instrucción de ejecución en el contexto del script: `$modelGrupo->registrarHistorial(`. |
| `144` | `$idGrupo,` | Instrucción de ejecución en el contexto del script: `$idGrupo,`. |
| `145` | `"Grupo editado: integrantes actualizados. Fecha: {$fechaLimpieza}.",` | Instrucción de ejecución en el contexto del script: `"Grupo editado: integrantes actualizados. Fecha: {$fechaLimpieza}.",`. |
| `146` | `$_SESSION['usuario']['id_usuario']` | Instrucción de ejecución en el contexto del script: `$_SESSION['usuario']['id_usuario']`. |
| `147` | ``);`` | Cierre de estructura de arreglo o invocación de función. |
| `148` | `$_SESSION['alert'] = [` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección. |
| `149` | `'icon'  => 'success',` | Instrucción de ejecución en el contexto del script: `'icon'  => 'success',`. |
| `150` | `'title' => 'Grupo actualizado',` | Instrucción de ejecución en el contexto del script: `'title' => 'Grupo actualizado',`. |
| `151` | `'text'  => 'Integrantes actualizados. Próxima limpieza: ' . date('d/m/Y'...` | Instrucción de ejecución en el contexto del script: `'text'  => 'Integrantes actualizados. Próxima limpieza: ' . date('d/m/Y'...`. |
| `152` | ``];`` | Cierre de estructura de arreglo o invocación de función. |
| `153` | `} else {` | Instrucción de ejecución en el contexto del script: `} else {`. |
| `154` | `$_SESSION['alert'] = ['icon'=>'error','title'=>'Error','text'=>'No se pu...` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección. |
| `155` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `156` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `157` | `header("Location: ../views/dashboard/vocero_grupos.php"); exit;` | Emite cabecera HTTP de redirección en el navegador y detiene la ejecución: `header("Location: ../views/dashboard/vocero_grupos.php"); exit;`. |
| `158` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `159` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `160` | `// ── ELIMINAR GRUPO ─────────────────────────────────────────────────────` | Comentario explicativo en el código: `── ELIMINAR GRUPO ─────────────────────────────────────────────────────`. |
| `161` | `public function eliminarGrupo(): void` | Declaración de método o función con su firma y parámetros: `public function eliminarGrupo(): void`. |
| `162` | ``{`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `163` | `$this->requireVocero();` | Instrucción de ejecución en el contexto del script: `$this->requireVocero();`. |
| `164` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `165` | `$idGrupo    = (int)($_POST['id_grupo'] ?? 0);` | Instrucción de ejecución en el contexto del script: `$idGrupo    = (int)($_POST['id_grupo'] ?? 0);`. |
| `166` | `$idVocero   = $this->getIdVocero();` | Instrucción de ejecución en el contexto del script: `$idVocero   = $this->getIdVocero();`. |
| `167` | `$modelGrupo = new Grupo($this->db);` | Instrucción de ejecución en el contexto del script: `$modelGrupo = new Grupo($this->db);`. |
| `168` | `$resultado  = $modelGrupo->eliminar($idGrupo);` | Instrucción de ejecución en el contexto del script: `$resultado  = $modelGrupo->eliminar($idGrupo);`. |
| `169` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `170` | `if ($resultado) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if ($resultado) {`. |
| `171` | `// Renumerar los grupos restantes para que queden consecutivos` | Comentario explicativo en el código: `Renumerar los grupos restantes para que queden consecutivos`. |
| `172` | `$modelGrupo->renumerarGrupos($idVocero);` | Instrucción de ejecución en el contexto del script: `$modelGrupo->renumerarGrupos($idVocero);`. |
| `173` | `$_SESSION['alert'] = ['icon'=>'success','title'=>'Grupo eliminado','text...` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección. |
| `174` | `} else {` | Instrucción de ejecución en el contexto del script: `} else {`. |
| `175` | `$_SESSION['alert'] = ['icon'=>'error','title'=>'Error','text'=>'No se pu...` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección. |
| `176` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `177` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `178` | `header("Location: ../views/dashboard/vocero_grupos.php"); exit;` | Emite cabecera HTTP de redirección en el navegador y detiene la ejecución: `header("Location: ../views/dashboard/vocero_grupos.php"); exit;`. |
| `179` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `180` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `181` | `// ── SUBIR EVIDENCIA (flujo antiguo por grupo — mantiene compatibilidad...` | Comentario explicativo en el código: `── SUBIR EVIDENCIA (flujo antiguo por grupo — mantiene compatibilidad) ──`. |
| `182` | `public function subirEvidencia(): void` | Declaración de método o función con su firma y parámetros: `public function subirEvidencia(): void`. |
| `183` | ``{`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `184` | `$this->requireVocero();` | Instrucción de ejecución en el contexto del script: `$this->requireVocero();`. |
| `185` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `186` | `$idGrupo  = (int)($_POST['id_grupo'] ?? 0);` | Instrucción de ejecución en el contexto del script: `$idGrupo  = (int)($_POST['id_grupo'] ?? 0);`. |
| `187` | `$idVocero = $this->getIdVocero();` | Instrucción de ejecución en el contexto del script: `$idVocero = $this->getIdVocero();`. |
| `188` | `$modelEv  = new Evidencia($this->db);` | Instrucción de ejecución en el contexto del script: `$modelEv  = new Evidencia($this->db);`. |
| `189` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `190` | `$modelGrupo = new Grupo($this->db);` | Instrucción de ejecución en el contexto del script: `$modelGrupo = new Grupo($this->db);`. |
| `191` | `$grupo      = $modelGrupo->obtenerPorId($idGrupo);` | Instrucción de ejecución en el contexto del script: `$grupo      = $modelGrupo->obtenerPorId($idGrupo);`. |
| `192` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `193` | `if (!$grupo) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (!$grupo) {`. |
| `194` | `$_SESSION['alert'] = ['icon'=>'error','title'=>'Error','text'=>'Grupo no...` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección. |
| `195` | `header("Location: ../views/dashboard/vocero_evidencias.php"); exit;` | Emite cabecera HTTP de redirección en el navegador y detiene la ejecución: `header("Location: ../views/dashboard/vocero_evidencias.php"); exit;`. |
| `196` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `197` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `198` | `// Verificar plazo` | Comentario explicativo en el código: `Verificar plazo`. |
| `199` | `if (strtotime($grupo['fecha_limite_evidencia']) < time()) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (strtotime($grupo['fecha_limite_evidencia']) < time()) {`. |
| `200` | `$_SESSION['alert'] = ['icon'=>'error','title'=>'Plazo vencido','text'=>'...` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección. |
| `201` | `header("Location: ../views/dashboard/vocero_evidencias.php"); exit;` | Emite cabecera HTTP de redirección en el navegador y detiene la ejecución: `header("Location: ../views/dashboard/vocero_evidencias.php"); exit;`. |
| `202` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `203` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `204` | `// Verificar que ya no tenga el par completo` | Comentario explicativo en el código: `Verificar que ya no tenga el par completo`. |
| `205` | `if ($modelEv->grupoCompleto($idGrupo)) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if ($modelEv->grupoCompleto($idGrupo)) {`. |
| `206` | `$_SESSION['alert'] = ['icon'=>'warning','title'=>'Ya completado','text'=...` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección. |
| `207` | `header("Location: ../views/dashboard/vocero_evidencias.php"); exit;` | Emite cabecera HTTP de redirección en el navegador y detiene la ejecución: `header("Location: ../views/dashboard/vocero_evidencias.php"); exit;`. |
| `208` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `209` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `210` | `$carpeta = __DIR__ . '/../public/uploads/evidencias/';` | Instrucción de ejecución en el contexto del script: `$carpeta = __DIR__ . '/../public/uploads/evidencias/';`. |
| `211` | `if (!is_dir($carpeta)) mkdir($carpeta, 0755, true);` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (!is_dir($carpeta)) mkdir($carpeta, 0755, true);`. |
| `212` | `$maxSize = 10 * 1024 * 1024;` | Instrucción de ejecución en el contexto del script: `$maxSize = 10 * 1024 * 1024;`. |
| `213` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `214` | `// ── Helper para validar y mover un archivo ──────────────────────────` | Comentario explicativo en el código: `── Helper para validar y mover un archivo ──────────────────────────`. |
| `215` | `$procesarArchivo = function(array $file, string $prefijo) use ($carpeta,...` | Instrucción de ejecución en el contexto del script: `$procesarArchivo = function(array $file, string $prefijo) use ($carpeta,...`. |
| `216` | `if (empty($file['name']) \|\| $file['error'] !== UPLOAD_ERR_OK) return f...` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (empty($file['name']) \|\| $file['error'] !== UPLOAD_ERR_OK) return f...`. |
| `217` | `$ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));` | Instrucción de ejecución en el contexto del script: `$ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));`. |
| `218` | `if (!in_array($ext, ['jpg','jpeg','png'])) return false;` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (!in_array($ext, ['jpg','jpeg','png'])) return false;`. |
| `219` | `if ($file['size'] > $maxSize) return false;` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if ($file['size'] > $maxSize) return false;`. |
| `220` | `$nombre   = $prefijo . '_' . uniqid() . '.' . $ext;` | Instrucción de ejecución en el contexto del script: `$nombre   = $prefijo . '_' . uniqid() . '.' . $ext;`. |
| `221` | `$fisica   = $carpeta . $nombre;` | Instrucción de ejecución en el contexto del script: `$fisica   = $carpeta . $nombre;`. |
| `222` | `$relativa = 'uploads/evidencias/' . $nombre;` | Instrucción de ejecución en el contexto del script: `$relativa = 'uploads/evidencias/' . $nombre;`. |
| `223` | `return move_uploaded_file($file['tmp_name'], $fisica)` | Instrucción de retorno que finaliza la ejecución entregando el resultado: `return move_uploaded_file($file['tmp_name'], $fisica)`. |
| `224` | `? ['nombre' => $nombre, 'ruta' => $relativa]` | Instrucción de ejecución en el contexto del script: `? ['nombre' => $nombre, 'ruta' => $relativa]`. |
| `225` | `: false;` | Instrucción de ejecución en el contexto del script: `: false;`. |
| `226` | `};` | Instrucción de ejecución en el contexto del script: `};`. |
| `227` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `228` | `$fAntes   = $_FILES['foto_antes']   ?? [];` | Instrucción de ejecución en el contexto del script: `$fAntes   = $_FILES['foto_antes']   ?? [];`. |
| `229` | `$fDespues = $_FILES['foto_despues'] ?? [];` | Instrucción de ejecución en el contexto del script: `$fDespues = $_FILES['foto_despues'] ?? [];`. |
| `230` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `231` | `if (empty($fAntes['name']) \|\| empty($fDespues['name'])) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (empty($fAntes['name']) \|\| empty($fDespues['name'])) {`. |
| `232` | `$_SESSION['alert'] = ['icon'=>'warning','title'=>'Fotos incompletas','te...` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección. |
| `233` | `header("Location: ../views/dashboard/vocero_evidencias.php"); exit;` | Emite cabecera HTTP de redirección en el navegador y detiene la ejecución: `header("Location: ../views/dashboard/vocero_evidencias.php"); exit;`. |
| `234` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `235` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `236` | `$antes   = $procesarArchivo($fAntes,   'ev_g' . $idGrupo . '_antes');` | Instrucción de ejecución en el contexto del script: `$antes   = $procesarArchivo($fAntes,   'ev_g' . $idGrupo . '_antes');`. |
| `237` | `$despues = $procesarArchivo($fDespues, 'ev_g' . $idGrupo . '_despues');` | Instrucción de ejecución en el contexto del script: `$despues = $procesarArchivo($fDespues, 'ev_g' . $idGrupo . '_despues');`. |
| `238` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `239` | `if (!$antes \|\| !$despues) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (!$antes \|\| !$despues) {`. |
| `240` | `$_SESSION['alert'] = ['icon'=>'error','title'=>'Error al subir','text'=>...` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección. |
| `241` | `header("Location: ../views/dashboard/vocero_evidencias.php"); exit;` | Emite cabecera HTTP de redirección en el navegador y detiene la ejecución: `header("Location: ../views/dashboard/vocero_evidencias.php"); exit;`. |
| `242` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `243` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `244` | `try {` | Instrucción de ejecución en el contexto del script: `try {`. |
| `245` | `$modelEv->registrar(['id_grupo' => $idGrupo, 'id_vocero' => $idVocero,` | Instrucción de ejecución en el contexto del script: `$modelEv->registrar(['id_grupo' => $idGrupo, 'id_vocero' => $idVocero,`. |
| `246` | `'tipo' => 'antes',   'nombre_archivo' => $antes['nombre'],   'ruta_archi...` | Instrucción de ejecución en el contexto del script: `'tipo' => 'antes',   'nombre_archivo' => $antes['nombre'],   'ruta_archi...`. |
| `247` | `$modelEv->registrar(['id_grupo' => $idGrupo, 'id_vocero' => $idVocero,` | Instrucción de ejecución en el contexto del script: `$modelEv->registrar(['id_grupo' => $idGrupo, 'id_vocero' => $idVocero,`. |
| `248` | `'tipo' => 'despues', 'nombre_archivo' => $despues['nombre'], 'ruta_archi...` | Instrucción de ejecución en el contexto del script: `'tipo' => 'despues', 'nombre_archivo' => $despues['nombre'], 'ruta_archi...`. |
| `249` | `$_SESSION['alert'] = ['icon'=>'success','title'=>'¡Evidencias enviadas!'...` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección. |
| `250` | `} catch (Exception $e) {` | Instrucción de ejecución en el contexto del script: `} catch (Exception $e) {`. |
| `251` | `$_SESSION['alert'] = ['icon'=>'error','title'=>'Error','text'=>'No se pu...` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección. |
| `252` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `253` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `254` | `header("Location: ../views/dashboard/vocero_evidencias.php"); exit;` | Emite cabecera HTTP de redirección en el navegador y detiene la ejecución: `header("Location: ../views/dashboard/vocero_evidencias.php"); exit;`. |
| `255` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `256` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `257` | `// ── SUBIR EVIDENCIA CON TURNO (2 fotos obligatorias: antes + después) ───` | Comentario explicativo en el código: `── SUBIR EVIDENCIA CON TURNO (2 fotos obligatorias: antes + después) ───`. |
| `258` | `public function subirEvidenciaTurno(): void` | Declaración de método o función con su firma y parámetros: `public function subirEvidenciaTurno(): void`. |
| `259` | ``{`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `260` | `$this->requireVocero();` | Instrucción de ejecución en el contexto del script: `$this->requireVocero();`. |
| `261` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `262` | `$idTurno  = (int)($_POST['id_turno'] ?? 0);` | Instrucción de ejecución en el contexto del script: `$idTurno  = (int)($_POST['id_turno'] ?? 0);`. |
| `263` | `$idGrupo  = (int)($_POST['id_grupo'] ?? 0);` | Instrucción de ejecución en el contexto del script: `$idGrupo  = (int)($_POST['id_grupo'] ?? 0);`. |
| `264` | `$obs      = trim($_POST['observaciones'] ?? '');` | Instrucción de ejecución en el contexto del script: `$obs      = trim($_POST['observaciones'] ?? '');`. |
| `265` | `$idVocero = $this->getIdVocero();` | Instrucción de ejecución en el contexto del script: `$idVocero = $this->getIdVocero();`. |
| `266` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `267` | `if (!$idTurno) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (!$idTurno) {`. |
| `268` | `$_SESSION['alert'] = ['icon'=>'error','title'=>'Error','text'=>'Turno no...` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección. |
| `269` | `header("Location: ../views/dashboard/vocero_subir_evidencia.php"); exit;` | Emite cabecera HTTP de redirección en el navegador y detiene la ejecución: `header("Location: ../views/dashboard/vocero_subir_evidencia.php"); exit;`. |
| `270` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `271` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `272` | `// Verificar que el turno esté abierto hoy` | Comentario explicativo en el código: `Verificar que el turno esté abierto hoy`. |
| `273` | `$stmtT = $this->db->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmtT = $this->db->prepare(`. |
| `274` | `"SELECT * FROM turnos WHERE id_turno = :id AND estado IN ('Abierto','Pen...` | Instrucción de ejecución en el contexto del script: `"SELECT * FROM turnos WHERE id_turno = :id AND estado IN ('Abierto','Pen...`. |
| `275` | `AND NOW() BETWEEN fecha_apertura AND fecha_cierre LIMIT 1"` | Instrucción de ejecución en el contexto del script: `AND NOW() BETWEEN fecha_apertura AND fecha_cierre LIMIT 1"`. |
| `276` | ``);`` | Cierre de estructura de arreglo o invocación de función. |
| `277` | `$stmtT->execute([':id' => $idTurno]);` | Ejecuta la sentencia SQL preparada vinculando los parámetros correspondientes: `$stmtT->execute([':id' => $idTurno]);`. |
| `278` | `$turno = $stmtT->fetch(PDO::FETCH_ASSOC);` | Recupera una única fila o registro resultante de la consulta. |
| `279` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `280` | `if (!$turno) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (!$turno) {`. |
| `281` | `$_SESSION['alert'] = ['icon'=>'error','title'=>'Turno cerrado','text'=>'...` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección. |
| `282` | `header("Location: ../views/dashboard/vocero_subir_evidencia.php"); exit;` | Emite cabecera HTTP de redirección en el navegador y detiene la ejecución: `header("Location: ../views/dashboard/vocero_subir_evidencia.php"); exit;`. |
| `283` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `284` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `285` | `// Verificar que el turno no tenga ya el par completo` | Comentario explicativo en el código: `Verificar que el turno no tenga ya el par completo`. |
| `286` | `$modelEv = new Evidencia($this->db);` | Instrucción de ejecución en el contexto del script: `$modelEv = new Evidencia($this->db);`. |
| `287` | `if ($modelEv->turnoCompleto($idTurno)) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if ($modelEv->turnoCompleto($idTurno)) {`. |
| `288` | `$_SESSION['alert'] = ['icon'=>'warning','title'=>'Ya completado','text'=...` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección. |
| `289` | `header("Location: ../views/dashboard/vocero_subir_evidencia.php"); exit;` | Emite cabecera HTTP de redirección en el navegador y detiene la ejecución: `header("Location: ../views/dashboard/vocero_subir_evidencia.php"); exit;`. |
| `290` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `291` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `292` | `// ── Validar que ambas fotos estén presentes ─────────────────────────` | Comentario explicativo en el código: `── Validar que ambas fotos estén presentes ─────────────────────────`. |
| `293` | `$fAntes   = $_FILES['foto_antes']   ?? [];` | Instrucción de ejecución en el contexto del script: `$fAntes   = $_FILES['foto_antes']   ?? [];`. |
| `294` | `$fDespues = $_FILES['foto_despues'] ?? [];` | Instrucción de ejecución en el contexto del script: `$fDespues = $_FILES['foto_despues'] ?? [];`. |
| `295` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `296` | `if (empty($fAntes['name'])   \|\| ($fAntes['error']   ?? UPLOAD_ERR_NO_F...` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (empty($fAntes['name'])   \|\| ($fAntes['error']   ?? UPLOAD_ERR_NO_F...`. |
| `297` | `empty($fDespues['name']) \|\| ($fDespues['error'] ?? UPLOAD_ERR_NO_FILE)...` | Instrucción de ejecución en el contexto del script: `empty($fDespues['name']) \|\| ($fDespues['error'] ?? UPLOAD_ERR_NO_FILE)...`. |
| `298` | `$_SESSION['alert'] = ['icon'=>'warning','title'=>'Fotos incompletas','te...` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección. |
| `299` | `header("Location: ../views/dashboard/vocero_subir_evidencia.php"); exit;` | Emite cabecera HTTP de redirección en el navegador y detiene la ejecución: `header("Location: ../views/dashboard/vocero_subir_evidencia.php"); exit;`. |
| `300` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `301` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `302` | `$maxSize = 10 * 1024 * 1024;` | Instrucción de ejecución en el contexto del script: `$maxSize = 10 * 1024 * 1024;`. |
| `303` | `$extsOk  = ['jpg','jpeg','png'];` | Instrucción de ejecución en el contexto del script: `$extsOk  = ['jpg','jpeg','png'];`. |
| `304` | `$carpeta = __DIR__ . '/../public/uploads/evidencias/';` | Instrucción de ejecución en el contexto del script: `$carpeta = __DIR__ . '/../public/uploads/evidencias/';`. |
| `305` | `if (!is_dir($carpeta)) mkdir($carpeta, 0755, true);` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (!is_dir($carpeta)) mkdir($carpeta, 0755, true);`. |
| `306` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `307` | `// ── Helper para validar y mover un archivo ──────────────────────────` | Comentario explicativo en el código: `── Helper para validar y mover un archivo ──────────────────────────`. |
| `308` | `$procesarArchivo = function(array $file, string $prefijo) use ($carpeta,...` | Instrucción de ejecución en el contexto del script: `$procesarArchivo = function(array $file, string $prefijo) use ($carpeta,...`. |
| `309` | `$ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));` | Instrucción de ejecución en el contexto del script: `$ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));`. |
| `310` | `if (!in_array($ext, $extsOk)) return false;` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (!in_array($ext, $extsOk)) return false;`. |
| `311` | `if ($file['size'] > $maxSize)  return false;` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if ($file['size'] > $maxSize)  return false;`. |
| `312` | `$nombre   = 'ev_t' . $idTurno . '_' . $prefijo . '_' . uniqid() . '.' . ...` | Instrucción de ejecución en el contexto del script: `$nombre   = 'ev_t' . $idTurno . '_' . $prefijo . '_' . uniqid() . '.' . ...`. |
| `313` | `$fisica   = $carpeta . $nombre;` | Instrucción de ejecución en el contexto del script: `$fisica   = $carpeta . $nombre;`. |
| `314` | `$relativa = 'uploads/evidencias/' . $nombre;` | Instrucción de ejecución en el contexto del script: `$relativa = 'uploads/evidencias/' . $nombre;`. |
| `315` | `return move_uploaded_file($file['tmp_name'], $fisica)` | Instrucción de retorno que finaliza la ejecución entregando el resultado: `return move_uploaded_file($file['tmp_name'], $fisica)`. |
| `316` | `? ['nombre' => $nombre, 'ruta' => $relativa]` | Instrucción de ejecución en el contexto del script: `? ['nombre' => $nombre, 'ruta' => $relativa]`. |
| `317` | `: false;` | Instrucción de ejecución en el contexto del script: `: false;`. |
| `318` | `};` | Instrucción de ejecución en el contexto del script: `};`. |
| `319` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `320` | `$antes   = $procesarArchivo($fAntes,   'antes');` | Instrucción de ejecución en el contexto del script: `$antes   = $procesarArchivo($fAntes,   'antes');`. |
| `321` | `$despues = $procesarArchivo($fDespues, 'despues');` | Instrucción de ejecución en el contexto del script: `$despues = $procesarArchivo($fDespues, 'despues');`. |
| `322` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `323` | `if (!$antes) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (!$antes) {`. |
| `324` | `$_SESSION['alert'] = ['icon'=>'error','title'=>'Error en foto "Antes"','...` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección. |
| `325` | `header("Location: ../views/dashboard/vocero_subir_evidencia.php"); exit;` | Emite cabecera HTTP de redirección en el navegador y detiene la ejecución: `header("Location: ../views/dashboard/vocero_subir_evidencia.php"); exit;`. |
| `326` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `327` | `if (!$despues) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (!$despues) {`. |
| `328` | `// Limpiar la foto antes ya movida` | Comentario explicativo en el código: `Limpiar la foto antes ya movida`. |
| `329` | `@unlink(__DIR__ . '/../public/uploads/evidencias/' . $antes['nombre']);` | Instrucción de ejecución en el contexto del script: `@unlink(__DIR__ . '/../public/uploads/evidencias/' . $antes['nombre']);`. |
| `330` | `$_SESSION['alert'] = ['icon'=>'error','title'=>'Error en foto "Después"'...` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección. |
| `331` | `header("Location: ../views/dashboard/vocero_subir_evidencia.php"); exit;` | Emite cabecera HTTP de redirección en el navegador y detiene la ejecución: `header("Location: ../views/dashboard/vocero_subir_evidencia.php"); exit;`. |
| `332` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `333` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `334` | `// ── Resolver id_grupo ───────────────────────────────────────────────` | Comentario explicativo en el código: `── Resolver id_grupo ───────────────────────────────────────────────`. |
| `335` | `if (!$idGrupo && $turno['id_grupo']) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (!$idGrupo && $turno['id_grupo']) {`. |
| `336` | `$idGrupo = (int)$turno['id_grupo'];` | Instrucción de ejecución en el contexto del script: `$idGrupo = (int)$turno['id_grupo'];`. |
| `337` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `338` | `if (!$idGrupo) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (!$idGrupo) {`. |
| `339` | `$stmtG = $this->db->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmtG = $this->db->prepare(`. |
| `340` | `"SELECT g.id_grupo FROM grupos g` | Instrucción de ejecución en el contexto del script: `"SELECT g.id_grupo FROM grupos g`. |
| `341` | `JOIN asignaciones a ON a.id_asignacion = g.id_asignacion` | Instrucción de ejecución en el contexto del script: `JOIN asignaciones a ON a.id_asignacion = g.id_asignacion`. |
| `342` | `WHERE g.id_vocero = :idv AND a.estado = 'Activa'` | Instrucción de ejecución en el contexto del script: `WHERE g.id_vocero = :idv AND a.estado = 'Activa'`. |
| `343` | `ORDER BY g.fecha_creacion DESC LIMIT 1"` | Instrucción de ejecución en el contexto del script: `ORDER BY g.fecha_creacion DESC LIMIT 1"`. |
| `344` | ``);`` | Cierre de estructura de arreglo o invocación de función. |
| `345` | `$stmtG->execute([':idv' => $idVocero]);` | Ejecuta la sentencia SQL preparada vinculando los parámetros correspondientes: `$stmtG->execute([':idv' => $idVocero]);`. |
| `346` | `$rowG    = $stmtG->fetch(PDO::FETCH_ASSOC);` | Recupera una única fila o registro resultante de la consulta. |
| `347` | `$idGrupo = $rowG ? (int)$rowG['id_grupo'] : 0;` | Instrucción de ejecución en el contexto del script: `$idGrupo = $rowG ? (int)$rowG['id_grupo'] : 0;`. |
| `348` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `349` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `350` | `if (!$idGrupo) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (!$idGrupo) {`. |
| `351` | `$_SESSION['alert'] = ['icon'=>'error','title'=>'Sin grupo','text'=>'No h...` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección. |
| `352` | `header("Location: ../views/dashboard/vocero_subir_evidencia.php"); exit;` | Emite cabecera HTTP de redirección en el navegador y detiene la ejecución: `header("Location: ../views/dashboard/vocero_subir_evidencia.php"); exit;`. |
| `353` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `354` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `355` | `// ── Registrar ambas fotos ───────────────────────────────────────────` | Comentario explicativo en el código: `── Registrar ambas fotos ───────────────────────────────────────────`. |
| `356` | `try {` | Instrucción de ejecución en el contexto del script: `try {`. |
| `357` | `$idEvAntes   = $modelEv->registrar([` | Instrucción de ejecución en el contexto del script: `$idEvAntes   = $modelEv->registrar([`. |
| `358` | `'id_grupo'       => $idGrupo,` | Instrucción de ejecución en el contexto del script: `'id_grupo'       => $idGrupo,`. |
| `359` | `'id_vocero'      => $idVocero,` | Instrucción de ejecución en el contexto del script: `'id_vocero'      => $idVocero,`. |
| `360` | `'id_turno'       => $idTurno,` | Instrucción de ejecución en el contexto del script: `'id_turno'       => $idTurno,`. |
| `361` | `'tipo'           => 'antes',` | Instrucción de ejecución en el contexto del script: `'tipo'           => 'antes',`. |
| `362` | `'nombre_archivo' => $antes['nombre'],` | Instrucción de ejecución en el contexto del script: `'nombre_archivo' => $antes['nombre'],`. |
| `363` | `'ruta_archivo'   => $antes['ruta'],` | Instrucción de ejecución en el contexto del script: `'ruta_archivo'   => $antes['ruta'],`. |
| `364` | `'observaciones'  => $obs ?: null,` | Instrucción de ejecución en el contexto del script: `'observaciones'  => $obs ?: null,`. |
| `365` | `]);` | Instrucción de ejecución en el contexto del script: `]);`. |
| `366` | `$idEvDespues = $modelEv->registrar([` | Instrucción de ejecución en el contexto del script: `$idEvDespues = $modelEv->registrar([`. |
| `367` | `'id_grupo'       => $idGrupo,` | Instrucción de ejecución en el contexto del script: `'id_grupo'       => $idGrupo,`. |
| `368` | `'id_vocero'      => $idVocero,` | Instrucción de ejecución en el contexto del script: `'id_vocero'      => $idVocero,`. |
| `369` | `'id_turno'       => $idTurno,` | Instrucción de ejecución en el contexto del script: `'id_turno'       => $idTurno,`. |
| `370` | `'tipo'           => 'despues',` | Instrucción de ejecución en el contexto del script: `'tipo'           => 'despues',`. |
| `371` | `'nombre_archivo' => $despues['nombre'],` | Instrucción de ejecución en el contexto del script: `'nombre_archivo' => $despues['nombre'],`. |
| `372` | `'ruta_archivo'   => $despues['ruta'],` | Instrucción de ejecución en el contexto del script: `'ruta_archivo'   => $despues['ruta'],`. |
| `373` | `'observaciones'  => $obs ?: null,` | Instrucción de ejecución en el contexto del script: `'observaciones'  => $obs ?: null,`. |
| `374` | `]);` | Instrucción de ejecución en el contexto del script: `]);`. |
| `375` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `376` | `// ── Snapshot de integrantes del grupo en este momento ───────────` | Comentario explicativo en el código: `── Snapshot de integrantes del grupo en este momento ───────────`. |
| `377` | `if ($idEvAntes \|\| $idEvDespues) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if ($idEvAntes \|\| $idEvDespues) {`. |
| `378` | `$stmtInts = $this->db->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmtInts = $this->db->prepare(`. |
| `379` | `"SELECT ap.id_aprendiz, ap.nombres, ap.apellidos, ap.documento` | Instrucción de ejecución en el contexto del script: `"SELECT ap.id_aprendiz, ap.nombres, ap.apellidos, ap.documento`. |
| `380` | `FROM grupo_integrantes gi` | Instrucción de ejecución en el contexto del script: `FROM grupo_integrantes gi`. |
| `381` | `JOIN aprendices ap ON ap.id_aprendiz = gi.id_aprendiz` | Instrucción de ejecución en el contexto del script: `JOIN aprendices ap ON ap.id_aprendiz = gi.id_aprendiz`. |
| `382` | `WHERE gi.id_grupo = :g"` | Instrucción de ejecución en el contexto del script: `WHERE gi.id_grupo = :g"`. |
| `383` | ``);`` | Cierre de estructura de arreglo o invocación de función. |
| `384` | `$stmtInts->execute([':g' => $idGrupo]);` | Ejecuta la sentencia SQL preparada vinculando los parámetros correspondientes: `$stmtInts->execute([':g' => $idGrupo]);`. |
| `385` | `$ints = $stmtInts->fetchAll(PDO::FETCH_ASSOC);` | Obtiene todos los registros coincidentes de la consulta en un arreglo asociativo. |
| `386` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `387` | `$insSnap = $this->db->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$insSnap = $this->db->prepare(`. |
| `388` | `"INSERT INTO evidencia_integrantes` | Instrucción de ejecución en el contexto del script: `"INSERT INTO evidencia_integrantes`. |
| `389` | `(id_evidencia, id_aprendiz, nombres, apellidos, documento)` | Instrucción de ejecución en el contexto del script: `(id_evidencia, id_aprendiz, nombres, apellidos, documento)`. |
| `390` | `VALUES (:ev, :ap, :nom, :ape, :doc)"` | Instrucción de ejecución en el contexto del script: `VALUES (:ev, :ap, :nom, :ape, :doc)"`. |
| `391` | ``);`` | Cierre de estructura de arreglo o invocación de función. |
| `392` | `foreach ($ints as $ap) {` | Estructura de control iterativa para recorrer colecciones o arreglos: `foreach ($ints as $ap) {`. |
| `393` | `foreach (array_filter([$idEvAntes, $idEvDespues]) as $idEv) {` | Estructura de control iterativa para recorrer colecciones o arreglos: `foreach (array_filter([$idEvAntes, $idEvDespues]) as $idEv) {`. |
| `394` | `$insSnap->execute([` | Ejecuta la sentencia SQL preparada vinculando los parámetros correspondientes: `$insSnap->execute([`. |
| `395` | `':ev'  => $idEv,` | Instrucción de ejecución en el contexto del script: `':ev'  => $idEv,`. |
| `396` | `':ap'  => $ap['id_aprendiz'],` | Instrucción de ejecución en el contexto del script: `':ap'  => $ap['id_aprendiz'],`. |
| `397` | `':nom' => $ap['nombres'],` | Instrucción de ejecución en el contexto del script: `':nom' => $ap['nombres'],`. |
| `398` | `':ape' => $ap['apellidos'],` | Instrucción de ejecución en el contexto del script: `':ape' => $ap['apellidos'],`. |
| `399` | `':doc' => $ap['documento'],` | Instrucción de ejecución en el contexto del script: `':doc' => $ap['documento'],`. |
| `400` | `]);` | Instrucción de ejecución en el contexto del script: `]);`. |
| `401` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `402` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `403` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `404` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `405` | `// Marcar turno como cumplido y avanzar al siguiente turno en el ciclo` | Comentario explicativo en el código: `Marcar turno como cumplido y avanzar al siguiente turno en el ciclo`. |
| `406` | `$modelTurnoInst = new Turno($this->db);` | Instrucción de ejecución en el contexto del script: `$modelTurnoInst = new Turno($this->db);`. |
| `407` | `$modelTurnoInst->marcarCumplido($idTurno);` | Instrucción de ejecución en el contexto del script: `$modelTurnoInst->marcarCumplido($idTurno);`. |
| `408` | `$modelTurnoInst->avanzarTurnoGrupo($idTurno, $idGrupo);` | Instrucción de ejecución en el contexto del script: `$modelTurnoInst->avanzarTurnoGrupo($idTurno, $idGrupo);`. |
| `409` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `410` | `$_SESSION['alert'] = ['icon'=>'success','title'=>'¡Evidencias enviadas!'...` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección. |
| `411` | `} catch (Exception $e) {` | Instrucción de ejecución en el contexto del script: `} catch (Exception $e) {`. |
| `412` | `$_SESSION['alert'] = ['icon'=>'error','title'=>'Error','text'=>'No se pu...` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección. |
| `413` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `414` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `415` | `header("Location: ../views/dashboard/vocero_subir_evidencia.php"); exit;` | Emite cabecera HTTP de redirección en el navegador y detiene la ejecución: `header("Location: ../views/dashboard/vocero_subir_evidencia.php"); exit;`. |
| `416` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `417` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `418` | `// ── GET EVIDENCIA POR TURNO (JSON para el calendario) ───────────────────` | Comentario explicativo en el código: `── GET EVIDENCIA POR TURNO (JSON para el calendario) ───────────────────`. |
| `419` | `public function getEvidenciaTurno(): void` | Declaración de método o función con su firma y parámetros: `public function getEvidenciaTurno(): void`. |
| `420` | ``{`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `421` | `header('Content-Type: application/json');` | Emite cabecera HTTP de respuesta hacia el cliente: `header('Content-Type: application/json');`. |
| `422` | `$this->requireVocero();` | Instrucción de ejecución en el contexto del script: `$this->requireVocero();`. |
| `423` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `424` | `$idTurno = (int)($_GET['id_turno'] ?? 0);` | Instrucción de ejecución en el contexto del script: `$idTurno = (int)($_GET['id_turno'] ?? 0);`. |
| `425` | `if (!$idTurno) { echo json_encode(['par' => null]); exit; }` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (!$idTurno) { echo json_encode(['par' => null]); exit; }`. |
| `426` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `427` | `$stmt = $this->db->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmt = $this->db->prepare(`. |
| `428` | `"SELECT tipo, ruta_archivo AS ruta, observaciones` | Instrucción de ejecución en el contexto del script: `"SELECT tipo, ruta_archivo AS ruta, observaciones`. |
| `429` | `FROM evidencias` | Instrucción de ejecución en el contexto del script: `FROM evidencias`. |
| `430` | `WHERE id_turno = :id` | Instrucción de ejecución en el contexto del script: `WHERE id_turno = :id`. |
| `431` | `AND tipo IN ('antes','despues')` | Instrucción de ejecución en el contexto del script: `AND tipo IN ('antes','despues')`. |
| `432` | `ORDER BY tipo ASC"` | Instrucción de ejecución en el contexto del script: `ORDER BY tipo ASC"`. |
| `433` | ``);`` | Cierre de estructura de arreglo o invocación de función. |
| `434` | `$stmt->execute([':id' => $idTurno]);` | Ejecuta la sentencia SQL preparada vinculando los parámetros correspondientes: `$stmt->execute([':id' => $idTurno]);`. |
| `435` | `$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);` | Obtiene todos los registros coincidentes de la consulta en un arreglo asociativo. |
| `436` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `437` | `$par = ['antes' => null, 'despues' => null];` | Instrucción de ejecución en el contexto del script: `$par = ['antes' => null, 'despues' => null];`. |
| `438` | `$obs = '';` | Instrucción de ejecución en el contexto del script: `$obs = '';`. |
| `439` | `foreach ($rows as $r) {` | Estructura de control iterativa para recorrer colecciones o arreglos: `foreach ($rows as $r) {`. |
| `440` | `$par[$r['tipo']] = ['ruta' => $r['ruta']];` | Instrucción de ejecución en el contexto del script: `$par[$r['tipo']] = ['ruta' => $r['ruta']];`. |
| `441` | `if ($r['observaciones']) $obs = $r['observaciones'];` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if ($r['observaciones']) $obs = $r['observaciones'];`. |
| `442` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `443` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `444` | `echo json_encode(['par' => $par, 'observaciones' => $obs]);` | Instrucción de ejecución en el contexto del script: `echo json_encode(['par' => $par, 'observaciones' => $obs]);`. |
| `445` | `exit;` | Finaliza la ejecución de la función o script. |
| `446` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `447` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `448` | `// ── GET EVIDENCIA (JSON) — devuelve el par antes/después de un grupo ────` | Comentario explicativo en el código: `── GET EVIDENCIA (JSON) — devuelve el par antes/después de un grupo ────`. |
| `449` | `public function getEvidencia(): void` | Declaración de método o función con su firma y parámetros: `public function getEvidencia(): void`. |
| `450` | ``{`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `451` | `header('Content-Type: application/json');` | Emite cabecera HTTP de respuesta hacia el cliente: `header('Content-Type: application/json');`. |
| `452` | `$this->requireVocero();` | Instrucción de ejecución en el contexto del script: `$this->requireVocero();`. |
| `453` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `454` | `$idGrupo = (int)($_GET['id_grupo'] ?? 0);` | Instrucción de ejecución en el contexto del script: `$idGrupo = (int)($_GET['id_grupo'] ?? 0);`. |
| `455` | `$modelEv = new Evidencia($this->db);` | Instrucción de ejecución en el contexto del script: `$modelEv = new Evidencia($this->db);`. |
| `456` | `$rows    = $modelEv->obtenerTodasPorGrupo($idGrupo);` | Instrucción de ejecución en el contexto del script: `$rows    = $modelEv->obtenerTodasPorGrupo($idGrupo);`. |
| `457` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `458` | `if (empty($rows)) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (empty($rows)) {`. |
| `459` | `echo json_encode(['par' => null]); exit;` | Instrucción de ejecución en el contexto del script: `echo json_encode(['par' => null]); exit;`. |
| `460` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `461` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `462` | `// Buscar datos del módulo/grupo en la primera fila` | Comentario explicativo en el código: `Buscar datos del módulo/grupo en la primera fila`. |
| `463` | `$stmt = $this->db->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmt = $this->db->prepare(`. |
| `464` | `"SELECT m.nombre AS modulo, g.nombre_grupo AS grupo, g.fecha_limpieza` | Instrucción de ejecución en el contexto del script: `"SELECT m.nombre AS modulo, g.nombre_grupo AS grupo, g.fecha_limpieza`. |
| `465` | `FROM grupos g` | Instrucción de ejecución en el contexto del script: `FROM grupos g`. |
| `466` | `JOIN asignaciones a ON a.id_asignacion = g.id_asignacion` | Instrucción de ejecución en el contexto del script: `JOIN asignaciones a ON a.id_asignacion = g.id_asignacion`. |
| `467` | `JOIN modulos m ON m.id_modulo = a.id_modulo` | Instrucción de ejecución en el contexto del script: `JOIN modulos m ON m.id_modulo = a.id_modulo`. |
| `468` | `WHERE g.id_grupo = :id LIMIT 1"` | Instrucción de ejecución en el contexto del script: `WHERE g.id_grupo = :id LIMIT 1"`. |
| `469` | ``);`` | Cierre de estructura de arreglo o invocación de función. |
| `470` | `$stmt->execute([':id' => $idGrupo]);` | Ejecuta la sentencia SQL preparada vinculando los parámetros correspondientes: `$stmt->execute([':id' => $idGrupo]);`. |
| `471` | `$meta = $stmt->fetch(PDO::FETCH_ASSOC);` | Recupera una única fila o registro resultante de la consulta. |
| `472` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `473` | `$par = ['antes' => null, 'despues' => null];` | Instrucción de ejecución en el contexto del script: `$par = ['antes' => null, 'despues' => null];`. |
| `474` | `foreach ($rows as $r) {` | Estructura de control iterativa para recorrer colecciones o arreglos: `foreach ($rows as $r) {`. |
| `475` | `$tipo = $r['tipo'] ?? 'antes';` | Instrucción de ejecución en el contexto del script: `$tipo = $r['tipo'] ?? 'antes';`. |
| `476` | `$par[$tipo] = [` | Instrucción de ejecución en el contexto del script: `$par[$tipo] = [`. |
| `477` | `'ruta'  => $r['ruta_archivo'],` | Instrucción de ejecución en el contexto del script: `'ruta'  => $r['ruta_archivo'],`. |
| `478` | `'fecha' => date('d/m/Y H:i', strtotime($r['fecha_subida'])),` | Instrucción de ejecución en el contexto del script: `'fecha' => date('d/m/Y H:i', strtotime($r['fecha_subida'])),`. |
| `479` | ``];`` | Cierre de estructura de arreglo o invocación de función. |
| `480` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `481` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `482` | `echo json_encode([` | Instrucción de ejecución en el contexto del script: `echo json_encode([`. |
| `483` | `'par'    => $par,` | Instrucción de ejecución en el contexto del script: `'par'    => $par,`. |
| `484` | `'grupo'  => $meta['grupo']          ?? '',` | Instrucción de ejecución en el contexto del script: `'grupo'  => $meta['grupo']          ?? '',`. |
| `485` | `'modulo' => $meta['modulo']          ?? '',` | Instrucción de ejecución en el contexto del script: `'modulo' => $meta['modulo']          ?? '',`. |
| `486` | `'fecha'  => $meta['fecha_limpieza']` | Instrucción de ejecución en el contexto del script: `'fecha'  => $meta['fecha_limpieza']`. |
| `487` | `? date('d/m/Y', strtotime($meta['fecha_limpieza']))` | Instrucción de ejecución en el contexto del script: `? date('d/m/Y', strtotime($meta['fecha_limpieza']))`. |
| `488` | `: '',` | Instrucción de ejecución en el contexto del script: `: '',`. |
| `489` | `]);` | Instrucción de ejecución en el contexto del script: `]);`. |
| `490` | `exit;` | Finaliza la ejecución de la función o script. |
| `491` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `492` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `493` | `// ── GET INTEGRANTES IDS (JSON para edición) ─────────────────────────────` | Comentario explicativo en el código: `── GET INTEGRANTES IDS (JSON para edición) ─────────────────────────────`. |
| `494` | `public function getIntegrantesIds(): void` | Declaración de método o función con su firma y parámetros: `public function getIntegrantesIds(): void`. |
| `495` | ``{`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `496` | `header('Content-Type: application/json');` | Emite cabecera HTTP de respuesta hacia el cliente: `header('Content-Type: application/json');`. |
| `497` | `$this->requireVocero();` | Instrucción de ejecución en el contexto del script: `$this->requireVocero();`. |
| `498` | `$idGrupo = (int)($_GET['id_grupo'] ?? 0);` | Instrucción de ejecución en el contexto del script: `$idGrupo = (int)($_GET['id_grupo'] ?? 0);`. |
| `499` | `$stmt    = $this->db->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmt    = $this->db->prepare(`. |
| `500` | `"SELECT id_aprendiz FROM grupo_integrantes WHERE id_grupo = :id"` | Instrucción de ejecución en el contexto del script: `"SELECT id_aprendiz FROM grupo_integrantes WHERE id_grupo = :id"`. |
| `501` | ``);`` | Cierre de estructura de arreglo o invocación de función. |
| `502` | `$stmt->execute([':id' => $idGrupo]);` | Ejecuta la sentencia SQL preparada vinculando los parámetros correspondientes: `$stmt->execute([':id' => $idGrupo]);`. |
| `503` | `echo json_encode(array_column($stmt->fetchAll(PDO::FETCH_ASSOC), 'id_apr...` | Obtiene todos los registros coincidentes de la consulta en un arreglo asociativo. |
| `504` | `exit;` | Finaliza la ejecución de la función o script. |
| `505` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `506` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `507` | `// ── HELPERS ────────────────────────────────────────────────────────────` | Comentario explicativo en el código: `── HELPERS ────────────────────────────────────────────────────────────`. |
| `508` | `private function requireVocero(): void` | Declaración de método o función con su firma y parámetros: `private function requireVocero(): void`. |
| `509` | ``{`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `510` | `if (!isset($_SESSION['usuario']) \|\| (int)$_SESSION['usuario']['rol'] !...` | Verifica autenticación y rol del usuario; redirige al login si no tiene permisos. |
| `511` | `header("Location: ../views/usuarios/login.php"); exit;` | Emite cabecera HTTP de redirección en el navegador y detiene la ejecución: `header("Location: ../views/usuarios/login.php"); exit;`. |
| `512` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `513` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `514` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `515` | `private function getIdVocero(): int` | Declaración de método o función con su firma y parámetros: `private function getIdVocero(): int`. |
| `516` | ``{`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `517` | `// Buscar el id_vocero del usuario en sesión` | Comentario explicativo en el código: `Buscar el id_vocero del usuario en sesión`. |
| `518` | `$stmt = $this->db->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmt = $this->db->prepare(`. |
| `519` | `"SELECT id_vocero FROM voceros WHERE id_usuario = :id AND activo = 1 LIM...` | Instrucción de ejecución en el contexto del script: `"SELECT id_vocero FROM voceros WHERE id_usuario = :id AND activo = 1 LIM...`. |
| `520` | ``);`` | Cierre de estructura de arreglo o invocación de función. |
| `521` | `$stmt->execute([':id' => $_SESSION['usuario']['id_usuario']]);` | Ejecuta la sentencia SQL preparada vinculando los parámetros correspondientes: `$stmt->execute([':id' => $_SESSION['usuario']['id_usuario']]);`. |
| `522` | `$row = $stmt->fetch(PDO::FETCH_ASSOC);` | Recupera una única fila o registro resultante de la consulta. |
| `523` | `return $row ? (int)$row['id_vocero'] : 0;` | Instrucción de retorno que finaliza la ejecución entregando el resultado: `return $row ? (int)$row['id_vocero'] : 0;`. |
| `524` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `525` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `526` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `527` | `// ── Dispatcher ───────────────────────────────────────────────────────...` | Comentario explicativo en el código: `── Dispatcher ────────────────────────────────────────────────────────────`. |
| `528` | `if (basename(__FILE__) === basename($_SERVER['SCRIPT_FILENAME'])) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (basename(__FILE__) === basename($_SERVER['SCRIPT_FILENAME'])) {`. |
| `529` | `$controller = new VoceroController();` | Instrucción de ejecución en el contexto del script: `$controller = new VoceroController();`. |
| `530` | `$accion     = $_POST['accion'] ?? $_GET['accion'] ?? '';` | Instrucción de ejecución en el contexto del script: `$accion     = $_POST['accion'] ?? $_GET['accion'] ?? '';`. |
| `531` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `532` | `match ($accion) {` | Estructura de coincidencia condicional `match` para despacho de acciones del controlador. |
| `533` | `'guardar_grupo'   => $controller->guardarGrupo(),` | Instrucción de ejecución en el contexto del script: `'guardar_grupo'   => $controller->guardarGrupo(),`. |
| `534` | `'editar_grupo'    => $controller->editarGrupo(),` | Instrucción de ejecución en el contexto del script: `'editar_grupo'    => $controller->editarGrupo(),`. |
| `535` | `'eliminar_grupo'  => $controller->eliminarGrupo(),` | Instrucción de ejecución en el contexto del script: `'eliminar_grupo'  => $controller->eliminarGrupo(),`. |
| `536` | `'subir_evidencia' => $controller->subirEvidencia(),` | Instrucción de ejecución en el contexto del script: `'subir_evidencia' => $controller->subirEvidencia(),`. |
| `537` | `'subir_evidencia_turno' => $controller->subirEvidenciaTurno(),` | Instrucción de ejecución en el contexto del script: `'subir_evidencia_turno' => $controller->subirEvidenciaTurno(),`. |
| `538` | `'get_evidencia'         => $controller->getEvidencia(),` | Instrucción de ejecución en el contexto del script: `'get_evidencia'         => $controller->getEvidencia(),`. |
| `539` | `'get_evidencia_turno'   => $controller->getEvidenciaTurno(),` | Instrucción de ejecución en el contexto del script: `'get_evidencia_turno'   => $controller->getEvidenciaTurno(),`. |
| `540` | `'get_integrantes_ids'   => $controller->getIntegrantesIds(),` | Instrucción de ejecución en el contexto del script: `'get_integrantes_ids'   => $controller->getIntegrantesIds(),`. |
| `541` | `default           => header("Location: ../views/dashboard/vocero_dashboa...` | Emite cabecera HTTP de respuesta hacia el cliente: `default           => header("Location: ../views/dashboard/vocero_dashboa...`. |
| `542` | `};` | Instrucción de ejecución en el contexto del script: `};`. |
| `543` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `544` | ``?>`` | Cierre de la etiqueta PHP para alternar a salida HTML o fin del archivo. |

---

## 3. Resumen y Flujo de Interacción

El archivo `VoceroController.php` cumple un rol indispensable en `controllers/VoceroController.php`. 
Controlador para el rol Vocero. Permite registrar y editar grupos de limpieza de la ficha, asignar aprendices y subir evidencias fotográficas de los turnos. Garantiza la robustez, el orden y la estabilidad de la arquitectura del proyecto `systemLimpieza`.

---

Generado automáticamente para el repositorio [johanrepizo/LimpiezaDeModulos](https://github.com/johanrepizo/LimpiezaDeModulos).
