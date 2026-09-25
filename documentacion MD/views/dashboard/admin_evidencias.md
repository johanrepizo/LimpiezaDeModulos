# Documentación Línea por Línea: `views/dashboard/admin_evidencias.php`

## 1. Ficha Técnica del Archivo

- **Archivo:** `admin_evidencias.php`
- **Ruta en el proyecto:** `views/dashboard/admin_evidencias.php`
- **Cantidad total de líneas:** `963`
- **Tipo de archivo:** `PHP`
- **Propósito general:** Módulo administrativo con vista de calendario interactivo FullCalendar y galería para auditar las evidencias fotográficas de cada ficha.

---

## 2. Explicación Detallada Línea por Línea

A continuación se presenta cada línea de código numerada de forma consecutiva, acompañada de su fragmento exacto y la explicación exhaustiva de su funcionamiento y responsabilidad en el sistema:

| Línea | Código Fuente | Explicación Detallada |
|---|---|---|
| `1` | ``<?php`` | Apertura obligatoria de la etiqueta PHP para ejecución del código del lado del servidor. |
| `2` | `$titulo = 'Evidencias';` | Instrucción de ejecución en el contexto del script: `$titulo = 'Evidencias';`. |
| `3` | `if (session_status() === PHP_SESSION_NONE) session_start();` | Inicia o reanuda la sesión PHP del usuario si no se encontraba activa previamente. |
| `4` | `if (!isset($_SESSION['usuario']) \|\| (int)$_SESSION['usuario']['rol'] !...` | Verifica autenticación y rol del usuario; redirige al login si no tiene permisos. |
| `5` | `header("Location: ../usuarios/login.php"); exit;` | Emite cabecera HTTP de redirección en el navegador y detiene la ejecución: `header("Location: ../usuarios/login.php"); exit;`. |
| `6` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `7` | `require_once __DIR__ . '/../../config/database.php';` | Importación e inclusión obligatoria del archivo de dependencia requerido: `require_once __DIR__ . '/../../config/database.php';`. |
| `8` | `require_once __DIR__ . '/../../models/Programa.php';` | Importación e inclusión obligatoria del archivo de dependencia requerido: `require_once __DIR__ . '/../../models/Programa.php';`. |
| `9` | `require_once __DIR__ . '/../../models/Ficha.php';` | Importación e inclusión obligatoria del archivo de dependencia requerido: `require_once __DIR__ . '/../../models/Ficha.php';`. |
| `10` | `require_once __DIR__ . '/../../models/Evidencia.php';` | Importación e inclusión obligatoria del archivo de dependencia requerido: `require_once __DIR__ . '/../../models/Evidencia.php';`. |
| `11` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `12` | `$db        = (new Database())->conectar();` | Instrucción de ejecución en el contexto del script: `$db        = (new Database())->conectar();`. |
| `13` | `$modelProg = new Programa($db);` | Instrucción de ejecución en el contexto del script: `$modelProg = new Programa($db);`. |
| `14` | `$modelFich = new Ficha($db);` | Instrucción de ejecución en el contexto del script: `$modelFich = new Ficha($db);`. |
| `15` | `$modelEv   = new Evidencia($db);` | Instrucción de ejecución en el contexto del script: `$modelEv   = new Evidencia($db);`. |
| `16` | `$alert     = $_SESSION['alert'] ?? null;` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección. |
| `17` | `unset($_SESSION['alert']);` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección. |
| `18` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `19` | `$vistaPrograma = (int)($_GET['programa'] ?? 0);` | Instrucción de ejecución en el contexto del script: `$vistaPrograma = (int)($_GET['programa'] ?? 0);`. |
| `20` | `$vistaFicha    = (int)($_GET['ficha']    ?? 0);` | Instrucción de ejecución en el contexto del script: `$vistaFicha    = (int)($_GET['ficha']    ?? 0);`. |
| `21` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `22` | `$programas     = $modelProg->obtenerTodos();` | Instrucción de ejecución en el contexto del script: `$programas     = $modelProg->obtenerTodos();`. |
| `23` | `$programaAct   = null;` | Instrucción de ejecución en el contexto del script: `$programaAct   = null;`. |
| `24` | `$fichasDelProg = [];` | Instrucción de ejecución en el contexto del script: `$fichasDelProg = [];`. |
| `25` | `$fichaAct      = null;` | Instrucción de ejecución en el contexto del script: `$fichaAct      = null;`. |
| `26` | `$evidencias    = [];` | Instrucción de ejecución en el contexto del script: `$evidencias    = [];`. |
| `27` | `$pares         = [];` | Instrucción de ejecución en el contexto del script: `$pares         = [];`. |
| `28` | `$turnos        = [];` | Instrucción de ejecución en el contexto del script: `$turnos        = [];`. |
| `29` | `$eventos       = [];` | Instrucción de ejecución en el contexto del script: `$eventos       = [];`. |
| `30` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `31` | `if ($vistaPrograma) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if ($vistaPrograma) {`. |
| `32` | `$programaAct = $modelProg->obtenerPorId($vistaPrograma);` | Instrucción de ejecución en el contexto del script: `$programaAct = $modelProg->obtenerPorId($vistaPrograma);`. |
| `33` | `$stmtF = $db->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmtF = $db->prepare(`. |
| `34` | `"SELECT f.*,` | Instrucción de ejecución en el contexto del script: `"SELECT f.*,`. |
| `35` | `ANY_VALUE(v.nombres)   AS vocero_nombres,` | Instrucción de ejecución en el contexto del script: `ANY_VALUE(v.nombres)   AS vocero_nombres,`. |
| `36` | `ANY_VALUE(v.apellidos) AS vocero_apellidos,` | Instrucción de ejecución en el contexto del script: `ANY_VALUE(v.apellidos) AS vocero_apellidos,`. |
| `37` | `COUNT(DISTINCT ap.id_aprendiz) AS total_aprendices` | Instrucción de ejecución en el contexto del script: `COUNT(DISTINCT ap.id_aprendiz) AS total_aprendices`. |
| `38` | `FROM fichas f` | Instrucción de ejecución en el contexto del script: `FROM fichas f`. |
| `39` | `LEFT JOIN voceros    v  ON v.id_ficha  = f.id_ficha AND v.activo = 1` | Instrucción de ejecución en el contexto del script: `LEFT JOIN voceros    v  ON v.id_ficha  = f.id_ficha AND v.activo = 1`. |
| `40` | `LEFT JOIN aprendices ap ON ap.id_ficha = f.id_ficha AND ap.activo = 1` | Instrucción de ejecución en el contexto del script: `LEFT JOIN aprendices ap ON ap.id_ficha = f.id_ficha AND ap.activo = 1`. |
| `41` | `WHERE f.id_programa = :prog AND f.activo = 1` | Instrucción de ejecución en el contexto del script: `WHERE f.id_programa = :prog AND f.activo = 1`. |
| `42` | `GROUP BY f.id_ficha ORDER BY f.numero_ficha"` | Instrucción de ejecución en el contexto del script: `GROUP BY f.id_ficha ORDER BY f.numero_ficha"`. |
| `43` | ``);`` | Cierre de estructura de arreglo o invocación de función. |
| `44` | `$stmtF->execute([':prog' => $vistaPrograma]);` | Ejecuta la sentencia SQL preparada vinculando los parámetros correspondientes: `$stmtF->execute([':prog' => $vistaPrograma]);`. |
| `45` | `$fichasDelProg = $stmtF->fetchAll(PDO::FETCH_ASSOC);` | Obtiene todos los registros coincidentes de la consulta en un arreglo asociativo. |
| `46` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `47` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `48` | `if ($vistaFicha) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if ($vistaFicha) {`. |
| `49` | `$stmtFA = $db->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmtFA = $db->prepare(`. |
| `50` | `"SELECT f.*, p.nombre AS nombre_programa,` | Instrucción de ejecución en el contexto del script: `"SELECT f.*, p.nombre AS nombre_programa,`. |
| `51` | `ANY_VALUE(v.nombres)   AS vocero_nombres,` | Instrucción de ejecución en el contexto del script: `ANY_VALUE(v.nombres)   AS vocero_nombres,`. |
| `52` | `ANY_VALUE(v.apellidos) AS vocero_apellidos` | Instrucción de ejecución en el contexto del script: `ANY_VALUE(v.apellidos) AS vocero_apellidos`. |
| `53` | `FROM fichas f` | Instrucción de ejecución en el contexto del script: `FROM fichas f`. |
| `54` | `JOIN programas p ON p.id_programa = f.id_programa` | Instrucción de ejecución en el contexto del script: `JOIN programas p ON p.id_programa = f.id_programa`. |
| `55` | `LEFT JOIN voceros v ON v.id_ficha = f.id_ficha AND v.activo = 1` | Instrucción de ejecución en el contexto del script: `LEFT JOIN voceros v ON v.id_ficha = f.id_ficha AND v.activo = 1`. |
| `56` | `WHERE f.id_ficha = :id GROUP BY f.id_ficha LIMIT 1"` | Instrucción de ejecución en el contexto del script: `WHERE f.id_ficha = :id GROUP BY f.id_ficha LIMIT 1"`. |
| `57` | ``);`` | Cierre de estructura de arreglo o invocación de función. |
| `58` | `$stmtFA->execute([':id' => $vistaFicha]);` | Ejecuta la sentencia SQL preparada vinculando los parámetros correspondientes: `$stmtFA->execute([':id' => $vistaFicha]);`. |
| `59` | `$fichaAct = $stmtFA->fetch(PDO::FETCH_ASSOC);` | Recupera una única fila o registro resultante de la consulta. |
| `60` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `61` | `if ($fichaAct) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if ($fichaAct) {`. |
| `62` | `$vistaPrograma = (int)$fichaAct['id_programa'];` | Instrucción de ejecución en el contexto del script: `$vistaPrograma = (int)$fichaAct['id_programa'];`. |
| `63` | `$programaAct   = $modelProg->obtenerPorId($vistaPrograma);` | Instrucción de ejecución en el contexto del script: `$programaAct   = $modelProg->obtenerPorId($vistaPrograma);`. |
| `64` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `65` | `$stmtF2 = $db->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmtF2 = $db->prepare(`. |
| `66` | `"SELECT f.*,` | Instrucción de ejecución en el contexto del script: `"SELECT f.*,`. |
| `67` | `ANY_VALUE(v.nombres)   AS vocero_nombres,` | Instrucción de ejecución en el contexto del script: `ANY_VALUE(v.nombres)   AS vocero_nombres,`. |
| `68` | `ANY_VALUE(v.apellidos) AS vocero_apellidos,` | Instrucción de ejecución en el contexto del script: `ANY_VALUE(v.apellidos) AS vocero_apellidos,`. |
| `69` | `COUNT(DISTINCT ap.id_aprendiz) AS total_aprendices` | Instrucción de ejecución en el contexto del script: `COUNT(DISTINCT ap.id_aprendiz) AS total_aprendices`. |
| `70` | `FROM fichas f` | Instrucción de ejecución en el contexto del script: `FROM fichas f`. |
| `71` | `LEFT JOIN voceros    v  ON v.id_ficha  = f.id_ficha AND v.activo = 1` | Instrucción de ejecución en el contexto del script: `LEFT JOIN voceros    v  ON v.id_ficha  = f.id_ficha AND v.activo = 1`. |
| `72` | `LEFT JOIN aprendices ap ON ap.id_ficha = f.id_ficha AND ap.activo = 1` | Instrucción de ejecución en el contexto del script: `LEFT JOIN aprendices ap ON ap.id_ficha = f.id_ficha AND ap.activo = 1`. |
| `73` | `WHERE f.id_programa = :prog AND f.activo = 1` | Instrucción de ejecución en el contexto del script: `WHERE f.id_programa = :prog AND f.activo = 1`. |
| `74` | `GROUP BY f.id_ficha ORDER BY f.numero_ficha"` | Instrucción de ejecución en el contexto del script: `GROUP BY f.id_ficha ORDER BY f.numero_ficha"`. |
| `75` | ``);`` | Cierre de estructura de arreglo o invocación de función. |
| `76` | `$stmtF2->execute([':prog' => $vistaPrograma]);` | Ejecuta la sentencia SQL preparada vinculando los parámetros correspondientes: `$stmtF2->execute([':prog' => $vistaPrograma]);`. |
| `77` | `$fichasDelProg = $stmtF2->fetchAll(PDO::FETCH_ASSOC);` | Obtiene todos los registros coincidentes de la consulta en un arreglo asociativo. |
| `78` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `79` | `// Turnos para el calendario de la ficha` | Comentario explicativo en el código: `Turnos para el calendario de la ficha`. |
| `80` | `$stmtTurnos = $db->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmtTurnos = $db->prepare(`. |
| `81` | `"SELECT` | Instrucción de ejecución en el contexto del script: `"SELECT`. |
| `82` | `t.fecha_turno,` | Instrucción de ejecución en el contexto del script: `t.fecha_turno,`. |
| `83` | `t.id_turno,` | Instrucción de ejecución en el contexto del script: `t.id_turno,`. |
| `84` | `t.estado        AS turno_estado,` | Instrucción de ejecución en el contexto del script: `t.estado        AS turno_estado,`. |
| `85` | `g.id_grupo,` | Instrucción de ejecución en el contexto del script: `g.id_grupo,`. |
| `86` | `g.nombre_grupo,` | Instrucción de ejecución en el contexto del script: `g.nombre_grupo,`. |
| `87` | `m.nombre        AS nombre_modulo,` | Instrucción de ejecución en el contexto del script: `m.nombre        AS nombre_modulo,`. |
| `88` | `(SELECT COUNT(DISTINCT e.tipo)` | Instrucción de ejecución en el contexto del script: `(SELECT COUNT(DISTINCT e.tipo)`. |
| `89` | `FROM evidencias e` | Instrucción de ejecución en el contexto del script: `FROM evidencias e`. |
| `90` | `WHERE e.id_turno = t.id_turno` | Instrucción de ejecución en el contexto del script: `WHERE e.id_turno = t.id_turno`. |
| `91` | `AND e.tipo IN ('antes','despues')) AS fotos_subidas` | Instrucción de ejecución en el contexto del script: `AND e.tipo IN ('antes','despues')) AS fotos_subidas`. |
| `92` | `FROM turnos t` | Instrucción de ejecución en el contexto del script: `FROM turnos t`. |
| `93` | `JOIN asignaciones a ON a.id_asignacion = t.id_asignacion` | Instrucción de ejecución en el contexto del script: `JOIN asignaciones a ON a.id_asignacion = t.id_asignacion`. |
| `94` | `JOIN modulos m      ON m.id_modulo     = a.id_modulo` | Instrucción de ejecución en el contexto del script: `JOIN modulos m      ON m.id_modulo     = a.id_modulo`. |
| `95` | `LEFT JOIN grupos g  ON g.id_grupo      = t.id_grupo` | Instrucción de ejecución en el contexto del script: `LEFT JOIN grupos g  ON g.id_grupo      = t.id_grupo`. |
| `96` | `WHERE a.id_ficha = :fic` | Instrucción de ejecución en el contexto del script: `WHERE a.id_ficha = :fic`. |
| `97` | `ORDER BY t.fecha_turno ASC"` | Instrucción de ejecución en el contexto del script: `ORDER BY t.fecha_turno ASC"`. |
| `98` | ``);`` | Cierre de estructura de arreglo o invocación de función. |
| `99` | `$stmtTurnos->execute([':fic' => $vistaFicha]);` | Ejecuta la sentencia SQL preparada vinculando los parámetros correspondientes: `$stmtTurnos->execute([':fic' => $vistaFicha]);`. |
| `100` | `$turnos = $stmtTurnos->fetchAll(PDO::FETCH_ASSOC);` | Obtiene todos los registros coincidentes de la consulta en un arreglo asociativo. |
| `101` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `102` | `$hoy = date('Y-m-d');` | Instrucción de ejecución en el contexto del script: `$hoy = date('Y-m-d');`. |
| `103` | `foreach ($turnos as $t) {` | Estructura de control iterativa para recorrer colecciones o arreglos: `foreach ($turnos as $t) {`. |
| `104` | `$fecha      = $t['fecha_turno'];` | Instrucción de ejecución en el contexto del script: `$fecha      = $t['fecha_turno'];`. |
| `105` | `$esPasado   = $fecha < $hoy;` | Instrucción de ejecución en el contexto del script: `$esPasado   = $fecha < $hoy;`. |
| `106` | `$esHoy      = $fecha === $hoy;` | Instrucción de ejecución en el contexto del script: `$esHoy      = $fecha === $hoy;`. |
| `107` | `$tieneEv    = (int)$t['fotos_subidas'] >= 2;` | Instrucción de ejecución en el contexto del script: `$tieneEv    = (int)$t['fotos_subidas'] >= 2;`. |
| `108` | `$sinGrupo   = empty($t['id_grupo']);` | Instrucción de ejecución en el contexto del script: `$sinGrupo   = empty($t['id_grupo']);`. |
| `109` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `110` | `if ($tieneEv) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if ($tieneEv) {`. |
| `111` | `$color      = '#16a34a';` | Instrucción de ejecución en el contexto del script: `$color      = '#16a34a';`. |
| `112` | `$textColor  = '#fff';` | Instrucción de ejecución en el contexto del script: `$textColor  = '#fff';`. |
| `113` | `$estado     = 'entregada';` | Instrucción de ejecución en el contexto del script: `$estado     = 'entregada';`. |
| `114` | `} elseif ($esPasado \|\| $esHoy) {` | Evaluación condicional alternativa `elseif`: `} elseif ($esPasado \|\| $esHoy) {`. |
| `115` | `if ($sinGrupo) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if ($sinGrupo) {`. |
| `116` | `$color     = '#9ca3af';` | Instrucción de ejecución en el contexto del script: `$color     = '#9ca3af';`. |
| `117` | `$textColor = '#fff';` | Instrucción de ejecución en el contexto del script: `$textColor = '#fff';`. |
| `118` | `$estado    = 'sin_grupo';` | Instrucción de ejecución en el contexto del script: `$estado    = 'sin_grupo';`. |
| `119` | `} else {` | Instrucción de ejecución en el contexto del script: `} else {`. |
| `120` | `$color     = '#ef4444';` | Instrucción de ejecución en el contexto del script: `$color     = '#ef4444';`. |
| `121` | `$textColor = '#fff';` | Instrucción de ejecución en el contexto del script: `$textColor = '#fff';`. |
| `122` | `$estado    = 'vencida';` | Instrucción de ejecución en el contexto del script: `$estado    = 'vencida';`. |
| `123` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `124` | `} else {` | Instrucción de ejecución en el contexto del script: `} else {`. |
| `125` | `$color     = '#d1d5db';` | Instrucción de ejecución en el contexto del script: `$color     = '#d1d5db';`. |
| `126` | `$textColor = '#374151';` | Instrucción de ejecución en el contexto del script: `$textColor = '#374151';`. |
| `127` | `$estado    = 'proxima';` | Instrucción de ejecución en el contexto del script: `$estado    = 'proxima';`. |
| `128` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `129` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `130` | `$titulo_ev = $t['nombre_grupo'] ?? ($t['nombre_modulo'] ?? 'Limpieza');` | Instrucción de ejecución en el contexto del script: `$titulo_ev = $t['nombre_grupo'] ?? ($t['nombre_modulo'] ?? 'Limpieza');`. |
| `131` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `132` | `$eventos[] = [` | Instrucción de ejecución en el contexto del script: `$eventos[] = [`. |
| `133` | `'id'         => $t['id_turno'],` | Instrucción de ejecución en el contexto del script: `'id'         => $t['id_turno'],`. |
| `134` | `'title'      => $titulo_ev,` | Instrucción de ejecución en el contexto del script: `'title'      => $titulo_ev,`. |
| `135` | `'start'      => $fecha,` | Instrucción de ejecución en el contexto del script: `'start'      => $fecha,`. |
| `136` | `'color'      => $color,` | Instrucción de ejecución en el contexto del script: `'color'      => $color,`. |
| `137` | `'textColor'  => $textColor,` | Instrucción de ejecución en el contexto del script: `'textColor'  => $textColor,`. |
| `138` | `'extendedProps' => [` | Instrucción de ejecución en el contexto del script: `'extendedProps' => [`. |
| `139` | `'estado'        => $estado,` | Instrucción de ejecución en el contexto del script: `'estado'        => $estado,`. |
| `140` | `'id_turno'      => $t['id_turno'],` | Instrucción de ejecución en el contexto del script: `'id_turno'      => $t['id_turno'],`. |
| `141` | `'id_grupo'      => $t['id_grupo'],` | Instrucción de ejecución en el contexto del script: `'id_grupo'      => $t['id_grupo'],`. |
| `142` | `'nombre_grupo'  => $t['nombre_grupo']  ?? '',` | Instrucción de ejecución en el contexto del script: `'nombre_grupo'  => $t['nombre_grupo']  ?? '',`. |
| `143` | `'nombre_modulo' => $t['nombre_modulo'] ?? '',` | Instrucción de ejecución en el contexto del script: `'nombre_modulo' => $t['nombre_modulo'] ?? '',`. |
| `144` | `'fotos'         => (int)$t['fotos_subidas'],` | Instrucción de ejecución en el contexto del script: `'fotos'         => (int)$t['fotos_subidas'],`. |
| `145` | `],` | Instrucción de ejecución en el contexto del script: `],`. |
| `146` | ``];`` | Cierre de estructura de arreglo o invocación de función. |
| `147` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `148` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `149` | `// Evidencias ordenadas: fecha DESC, tipo ASC (antes primero)` | Comentario explicativo en el código: `Evidencias ordenadas: fecha DESC, tipo ASC (antes primero)`. |
| `150` | `$evidencias = $modelEv->obtenerTodas(['id_ficha' => $vistaFicha]);` | Instrucción de ejecución en el contexto del script: `$evidencias = $modelEv->obtenerTodas(['id_ficha' => $vistaFicha]);`. |
| `151` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `152` | `// Agrupar en pares por fecha_limpieza + id_grupo` | Comentario explicativo en el código: `Agrupar en pares por fecha_limpieza + id_grupo`. |
| `153` | `foreach ($evidencias as $ev) {` | Estructura de control iterativa para recorrer colecciones o arreglos: `foreach ($evidencias as $ev) {`. |
| `154` | `$clave = $ev['fecha_limpieza'] . '\|' . $ev['id_grupo'];` | Instrucción de ejecución en el contexto del script: `$clave = $ev['fecha_limpieza'] . '\|' . $ev['id_grupo'];`. |
| `155` | `if (!isset($pares[$clave])) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (!isset($pares[$clave])) {`. |
| `156` | `$pares[$clave] = [` | Instrucción de ejecución en el contexto del script: `$pares[$clave] = [`. |
| `157` | `'fecha_limpieza'   => $ev['fecha_limpieza'],` | Instrucción de ejecución en el contexto del script: `'fecha_limpieza'   => $ev['fecha_limpieza'],`. |
| `158` | `'nombre_grupo'     => $ev['nombre_grupo'],` | Instrucción de ejecución en el contexto del script: `'nombre_grupo'     => $ev['nombre_grupo'],`. |
| `159` | `'nombre_modulo'    => $ev['nombre_modulo'],` | Instrucción de ejecución en el contexto del script: `'nombre_modulo'    => $ev['nombre_modulo'],`. |
| `160` | `'numero_ficha'     => $ev['numero_ficha'],` | Instrucción de ejecución en el contexto del script: `'numero_ficha'     => $ev['numero_ficha'],`. |
| `161` | `'vocero_nombres'   => $ev['vocero_nombres'],` | Instrucción de ejecución en el contexto del script: `'vocero_nombres'   => $ev['vocero_nombres'],`. |
| `162` | `'vocero_apellidos' => $ev['vocero_apellidos'],` | Instrucción de ejecución en el contexto del script: `'vocero_apellidos' => $ev['vocero_apellidos'],`. |
| `163` | `'antes'            => null,` | Instrucción de ejecución en el contexto del script: `'antes'            => null,`. |
| `164` | `'despues'          => null,` | Instrucción de ejecución en el contexto del script: `'despues'          => null,`. |
| `165` | ``];`` | Cierre de estructura de arreglo o invocación de función. |
| `166` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `167` | `$pares[$clave][$ev['tipo']] = $ev;` | Instrucción de ejecución en el contexto del script: `$pares[$clave][$ev['tipo']] = $ev;`. |
| `168` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `169` | `// Ordenar por fecha_limpieza DESC` | Comentario explicativo en el código: `Ordenar por fecha_limpieza DESC`. |
| `170` | `usort($pares, fn($a,$b) => strcmp($b['fecha_limpieza'], $a['fecha_limpie...` | Instrucción de ejecución en el contexto del script: `usort($pares, fn($a,$b) => strcmp($b['fecha_limpieza'], $a['fecha_limpie...`. |
| `171` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `172` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `173` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `174` | `// Contadores globales: contar pares completos (2 fotos distintas)` | Comentario explicativo en el código: `Contadores globales: contar pares completos (2 fotos distintas)`. |
| `175` | `$stmtTotPares = $db->query(` | Instrucción de ejecución en el contexto del script: `$stmtTotPares = $db->query(`. |
| `176` | `"SELECT COUNT(*) FROM (` | Instrucción de ejecución en el contexto del script: `"SELECT COUNT(*) FROM (`. |
| `177` | `SELECT id_grupo, fecha_limpieza` | Instrucción de ejecución en el contexto del script: `SELECT id_grupo, fecha_limpieza`. |
| `178` | `FROM (` | Instrucción de ejecución en el contexto del script: `FROM (`. |
| `179` | `SELECT e.id_grupo, g.fecha_limpieza` | Instrucción de ejecución en el contexto del script: `SELECT e.id_grupo, g.fecha_limpieza`. |
| `180` | `FROM evidencias e` | Instrucción de ejecución en el contexto del script: `FROM evidencias e`. |
| `181` | `JOIN grupos g ON g.id_grupo = e.id_grupo` | Instrucción de ejecución en el contexto del script: `JOIN grupos g ON g.id_grupo = e.id_grupo`. |
| `182` | `GROUP BY e.id_grupo, g.fecha_limpieza` | Instrucción de ejecución en el contexto del script: `GROUP BY e.id_grupo, g.fecha_limpieza`. |
| `183` | `HAVING COUNT(DISTINCT e.tipo) >= 2` | Instrucción de ejecución en el contexto del script: `HAVING COUNT(DISTINCT e.tipo) >= 2`. |
| `184` | `) t` | Instrucción de ejecución en el contexto del script: `) t`. |
| `185` | `) u"` | Instrucción de ejecución en el contexto del script: `) u"`. |
| `186` | ``);`` | Cierre de estructura de arreglo o invocación de función. |
| `187` | `$totalParesCompletos = (int)$stmtTotPares->fetchColumn();` | Recupera el valor escalar de la primera columna del resultado de la consulta. |
| `188` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `189` | `require_once __DIR__ . '/../layouts/header.php';` | Importación e inclusión obligatoria del archivo de dependencia requerido: `require_once __DIR__ . '/../layouts/header.php';`. |
| `190` | ``?>`` | Cierre de la etiqueta PHP para alternar a salida HTML o fin del archivo. |
| `191` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `192` | ``<style>`` | Bloque de estilos CSS personalizados para la interfaz. |
| `193` | `.prog-card { transition: transform .2s, box-shadow .2s; cursor: pointer; }` | Instrucción de ejecución en el contexto del script: `.prog-card { transition: transform .2s, box-shadow .2s; cursor: pointer; }`. |
| `194` | `.prog-card:hover { transform: translateY(-3px); box-shadow: 0 8px 24px r...` | Instrucción de ejecución en el contexto del script: `.prog-card:hover { transform: translateY(-3px); box-shadow: 0 8px 24px r...`. |
| `195` | `.breadcrumb-item + .breadcrumb-item::before { color: #9ca3af; }` | Instrucción de ejecución en el contexto del script: `.breadcrumb-item + .breadcrumb-item::before { color: #9ca3af; }`. |
| `196` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `197` | `/* ── FullCalendar overrides ── */` | Comentario multilínea de documentación o aclaración técnica. |
| `198` | `#calendario { font-family: inherit; }` | Comentario explicativo en el código: `calendario { font-family: inherit; }`. |
| `199` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `200` | `.fc .fc-toolbar-title {` | Instrucción de ejecución en el contexto del script: `.fc .fc-toolbar-title {`. |
| `201` | `font-size: 1.1rem;` | Instrucción de ejecución en el contexto del script: `font-size: 1.1rem;`. |
| `202` | `font-weight: 700;` | Instrucción de ejecución en el contexto del script: `font-weight: 700;`. |
| `203` | `color: #111827;` | Instrucción de ejecución en el contexto del script: `color: #111827;`. |
| `204` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `205` | `.fc .fc-button {` | Instrucción de ejecución en el contexto del script: `.fc .fc-button {`. |
| `206` | `background: #39a900 !important;` | Instrucción de ejecución en el contexto del script: `background: #39a900 !important;`. |
| `207` | `border-color: #39a900 !important;` | Instrucción de ejecución en el contexto del script: `border-color: #39a900 !important;`. |
| `208` | `font-size: .82rem !important;` | Instrucción de ejecución en el contexto del script: `font-size: .82rem !important;`. |
| `209` | `padding: .3rem .75rem !important;` | Instrucción de ejecución en el contexto del script: `padding: .3rem .75rem !important;`. |
| `210` | `border-radius: 7px !important;` | Instrucción de ejecución en el contexto del script: `border-radius: 7px !important;`. |
| `211` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `212` | `.fc .fc-button:hover { background: #2d8400 !important; border-color: #2d...` | Instrucción de ejecución en el contexto del script: `.fc .fc-button:hover { background: #2d8400 !important; border-color: #2d...`. |
| `213` | `.fc .fc-button-active { background: #2d8400 !important; }` | Instrucción de ejecución en el contexto del script: `.fc .fc-button-active { background: #2d8400 !important; }`. |
| `214` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `215` | `.fc .fc-daygrid-day-number {` | Instrucción de ejecución en el contexto del script: `.fc .fc-daygrid-day-number {`. |
| `216` | `font-size: .82rem;` | Instrucción de ejecución en el contexto del script: `font-size: .82rem;`. |
| `217` | `font-weight: 600;` | Instrucción de ejecución en el contexto del script: `font-weight: 600;`. |
| `218` | `color: #374151;` | Instrucción de ejecución en el contexto del script: `color: #374151;`. |
| `219` | `padding: .3rem .5rem;` | Instrucción de ejecución en el contexto del script: `padding: .3rem .5rem;`. |
| `220` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `221` | `.fc .fc-day-today { background: rgba(57,169,0,.06) !important; }` | Instrucción de ejecución en el contexto del script: `.fc .fc-day-today { background: rgba(57,169,0,.06) !important; }`. |
| `222` | `.fc .fc-day-today .fc-daygrid-day-number { color: #39a900; }` | Instrucción de ejecución en el contexto del script: `.fc .fc-day-today .fc-daygrid-day-number { color: #39a900; }`. |
| `223` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `224` | `.fc-event {` | Instrucción de ejecución en el contexto del script: `.fc-event {`. |
| `225` | `border-radius: 6px !important;` | Instrucción de ejecución en el contexto del script: `border-radius: 6px !important;`. |
| `226` | `border: none !important;` | Instrucción de ejecución en el contexto del script: `border: none !important;`. |
| `227` | `font-size: .75rem !important;` | Instrucción de ejecución en el contexto del script: `font-size: .75rem !important;`. |
| `228` | `font-weight: 600 !important;` | Instrucción de ejecución en el contexto del script: `font-weight: 600 !important;`. |
| `229` | `padding: .1rem .35rem !important;` | Instrucción de ejecución en el contexto del script: `padding: .1rem .35rem !important;`. |
| `230` | `cursor: pointer !important;` | Instrucción de ejecución en el contexto del script: `cursor: pointer !important;`. |
| `231` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `232` | `.fc-daygrid-event-dot { display: none !important; }` | Instrucción de ejecución en el contexto del script: `.fc-daygrid-event-dot { display: none !important; }`. |
| `233` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `234` | `/* Par de fotos en modal del calendario */` | Comentario multilínea de documentación o aclaración técnica. |
| `235` | `.par-modal {` | Instrucción de ejecución en el contexto del script: `.par-modal {`. |
| `236` | `display: grid;` | Instrucción de ejecución en el contexto del script: `display: grid;`. |
| `237` | `grid-template-columns: 1fr 1fr;` | Instrucción de ejecución en el contexto del script: `grid-template-columns: 1fr 1fr;`. |
| `238` | `gap: .75rem;` | Instrucción de ejecución en el contexto del script: `gap: .75rem;`. |
| `239` | `padding: 1.25rem;` | Instrucción de ejecución en el contexto del script: `padding: 1.25rem;`. |
| `240` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `241` | `@media (max-width: 500px) { .par-modal { grid-template-columns: 1fr; } }` | Instrucción de ejecución en el contexto del script: `@media (max-width: 500px) { .par-modal { grid-template-columns: 1fr; } }`. |
| `242` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `243` | `.foto-modal { position: relative; border-radius: 10px; overflow: hidden; }` | Instrucción de ejecución en el contexto del script: `.foto-modal { position: relative; border-radius: 10px; overflow: hidden; }`. |
| `244` | `.foto-modal img {` | Instrucción de ejecución en el contexto del script: `.foto-modal img {`. |
| `245` | `width: 100%; height: 220px; object-fit: cover; display: block;` | Instrucción de ejecución en el contexto del script: `width: 100%; height: 220px; object-fit: cover; display: block;`. |
| `246` | `cursor: pointer; transition: transform .3s;` | Instrucción de ejecución en el contexto del script: `cursor: pointer; transition: transform .3s;`. |
| `247` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `248` | `.foto-modal:hover img { transform: scale(1.03); }` | Instrucción de ejecución en el contexto del script: `.foto-modal:hover img { transform: scale(1.03); }`. |
| `249` | `.foto-label {` | Instrucción de ejecución en el contexto del script: `.foto-label {`. |
| `250` | `position: absolute; top: .5rem; left: .5rem;` | Instrucción de ejecución en el contexto del script: `position: absolute; top: .5rem; left: .5rem;`. |
| `251` | `padding: .18rem .55rem; border-radius: 20px;` | Instrucción de ejecución en el contexto del script: `padding: .18rem .55rem; border-radius: 20px;`. |
| `252` | `font-size: .7rem; font-weight: 700;` | Instrucción de ejecución en el contexto del script: `font-size: .7rem; font-weight: 700;`. |
| `253` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `254` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `255` | `.sin-foto {` | Instrucción de ejecución en el contexto del script: `.sin-foto {`. |
| `256` | `height: 220px; background: #f3f4f6; border-radius: 10px;` | Instrucción de ejecución en el contexto del script: `height: 220px; background: #f3f4f6; border-radius: 10px;`. |
| `257` | `display: flex; flex-direction: column;` | Instrucción de ejecución en el contexto del script: `display: flex; flex-direction: column;`. |
| `258` | `align-items: center; justify-content: center;` | Instrucción de ejecución en el contexto del script: `align-items: center; justify-content: center;`. |
| `259` | `color: #9ca3af; font-size: .8rem; gap: .4rem;` | Instrucción de ejecución en el contexto del script: `color: #9ca3af; font-size: .8rem; gap: .4rem;`. |
| `260` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `261` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `262` | `.estado-banner {` | Instrucción de ejecución en el contexto del script: `.estado-banner {`. |
| `263` | `padding: .75rem 1.25rem;` | Instrucción de ejecución en el contexto del script: `padding: .75rem 1.25rem;`. |
| `264` | `border-bottom: 1px solid #e5e7eb;` | Instrucción de ejecución en el contexto del script: `border-bottom: 1px solid #e5e7eb;`. |
| `265` | `display: flex; align-items: center; gap: .75rem;` | Instrucción de ejecución en el contexto del script: `display: flex; align-items: center; gap: .75rem;`. |
| `266` | `font-size: .85rem;` | Instrucción de ejecución en el contexto del script: `font-size: .85rem;`. |
| `267` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `268` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `269` | `.nav-pills .nav-link.active {` | Instrucción de ejecución en el contexto del script: `.nav-pills .nav-link.active {`. |
| `270` | `background-color: #39a900 !important;` | Instrucción de ejecución en el contexto del script: `background-color: #39a900 !important;`. |
| `271` | `color: #fff !important;` | Instrucción de ejecución en el contexto del script: `color: #fff !important;`. |
| `272` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `273` | `.nav-pills .nav-link {` | Instrucción de ejecución en el contexto del script: `.nav-pills .nav-link {`. |
| `274` | `color: #4b5563;` | Instrucción de ejecución en el contexto del script: `color: #4b5563;`. |
| `275` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `276` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `277` | `/* ── Par de fotos galería ── */` | Comentario multilínea de documentación o aclaración técnica. |
| `278` | `.par-card {` | Instrucción de ejecución en el contexto del script: `.par-card {`. |
| `279` | `background: #fff; border: 1px solid #e5e7eb;` | Instrucción de ejecución en el contexto del script: `background: #fff; border: 1px solid #e5e7eb;`. |
| `280` | `border-radius: 12px; overflow: hidden; margin-bottom: 1rem;` | Instrucción de ejecución en el contexto del script: `border-radius: 12px; overflow: hidden; margin-bottom: 1rem;`. |
| `281` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `282` | `.par-header {` | Instrucción de ejecución en el contexto del script: `.par-header {`. |
| `283` | `padding: .6rem 1rem; background: #f9fafb;` | Instrucción de ejecución en el contexto del script: `padding: .6rem 1rem; background: #f9fafb;`. |
| `284` | `border-bottom: 1px solid #e5e7eb;` | Instrucción de ejecución en el contexto del script: `border-bottom: 1px solid #e5e7eb;`. |
| `285` | `display: flex; align-items: center; gap: .65rem; flex-wrap: wrap;` | Instrucción de ejecución en el contexto del script: `display: flex; align-items: center; gap: .65rem; flex-wrap: wrap;`. |
| `286` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `287` | `.par-modulo { font-size: .82rem; font-weight: 700; color: #111827; }` | Instrucción de ejecución en el contexto del script: `.par-modulo { font-size: .82rem; font-weight: 700; color: #111827; }`. |
| `288` | `.par-vocero { font-size: .75rem; color: #6b7280; }` | Instrucción de ejecución en el contexto del script: `.par-vocero { font-size: .75rem; color: #6b7280; }`. |
| `289` | `.par-grupo  { font-size: .75rem; color: #9ca3af; }` | Instrucción de ejecución en el contexto del script: `.par-grupo  { font-size: .75rem; color: #9ca3af; }`. |
| `290` | `.par-fecha  { font-size: .74rem; color: #9ca3af; margin-left: auto; whit...` | Instrucción de ejecución en el contexto del script: `.par-fecha  { font-size: .74rem; color: #9ca3af; margin-left: auto; whit...`. |
| `291` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `292` | `.par-fotos { display: grid; grid-template-columns: 1fr 1fr; }` | Instrucción de ejecución en el contexto del script: `.par-fotos { display: grid; grid-template-columns: 1fr 1fr; }`. |
| `293` | `@media (max-width: 500px) { .par-fotos { grid-template-columns: 1fr; } }` | Instrucción de ejecución en el contexto del script: `@media (max-width: 500px) { .par-fotos { grid-template-columns: 1fr; } }`. |
| `294` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `295` | `.par-foto { position: relative; overflow: hidden; cursor: pointer; }` | Instrucción de ejecución en el contexto del script: `.par-foto { position: relative; overflow: hidden; cursor: pointer; }`. |
| `296` | `.par-foto img {` | Instrucción de ejecución en el contexto del script: `.par-foto img {`. |
| `297` | `width: 100%; height: 200px; object-fit: cover; display: block;` | Instrucción de ejecución en el contexto del script: `width: 100%; height: 200px; object-fit: cover; display: block;`. |
| `298` | `transition: transform .3s ease;` | Instrucción de ejecución en el contexto del script: `transition: transform .3s ease;`. |
| `299` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `300` | `.par-foto:hover img { transform: scale(1.04); }` | Instrucción de ejecución en el contexto del script: `.par-foto:hover img { transform: scale(1.04); }`. |
| `301` | `.par-foto-label {` | Instrucción de ejecución en el contexto del script: `.par-foto-label {`. |
| `302` | `position: absolute; top: .5rem; left: .5rem;` | Instrucción de ejecución en el contexto del script: `position: absolute; top: .5rem; left: .5rem;`. |
| `303` | `padding: .18rem .55rem; border-radius: 20px;` | Instrucción de ejecución en el contexto del script: `padding: .18rem .55rem; border-radius: 20px;`. |
| `304` | `font-size: .7rem; font-weight: 700;` | Instrucción de ejecución en el contexto del script: `font-size: .7rem; font-weight: 700;`. |
| `305` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `306` | `.label-antes   { background: rgba(234,179,8,.85);  color: #78350f; }` | Instrucción de ejecución en el contexto del script: `.label-antes   { background: rgba(234,179,8,.85);  color: #78350f; }`. |
| `307` | `.label-despues { background: rgba(22,163,74,.85);   color: #fff; }` | Instrucción de ejecución en el contexto del script: `.label-despues { background: rgba(22,163,74,.85);   color: #fff; }`. |
| `308` | `.par-foto-overlay {` | Instrucción de ejecución en el contexto del script: `.par-foto-overlay {`. |
| `309` | `position: absolute; inset: 0;` | Instrucción de ejecución en el contexto del script: `position: absolute; inset: 0;`. |
| `310` | `background: rgba(0,0,0,.42);` | Instrucción de ejecución en el contexto del script: `background: rgba(0,0,0,.42);`. |
| `311` | `display: flex; align-items: center; justify-content: center;` | Instrucción de ejecución en el contexto del script: `display: flex; align-items: center; justify-content: center;`. |
| `312` | `opacity: 0; transition: opacity .25s;` | Instrucción de ejecución en el contexto del script: `opacity: 0; transition: opacity .25s;`. |
| `313` | `color: #fff; font-size: 1.3rem;` | Instrucción de ejecución en el contexto del script: `color: #fff; font-size: 1.3rem;`. |
| `314` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `315` | `.par-foto:hover .par-foto-overlay { opacity: 1; }` | Instrucción de ejecución en el contexto del script: `.par-foto:hover .par-foto-overlay { opacity: 1; }`. |
| `316` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `317` | `.par-foto-missing {` | Instrucción de ejecución en el contexto del script: `.par-foto-missing {`. |
| `318` | `height: 200px; background: #f3f4f6;` | Instrucción de ejecución en el contexto del script: `height: 200px; background: #f3f4f6;`. |
| `319` | `display: flex; flex-direction: column;` | Instrucción de ejecución en el contexto del script: `display: flex; flex-direction: column;`. |
| `320` | `align-items: center; justify-content: center;` | Instrucción de ejecución en el contexto del script: `align-items: center; justify-content: center;`. |
| `321` | `color: #9ca3af; font-size: .78rem; gap: .35rem;` | Instrucción de ejecución en el contexto del script: `color: #9ca3af; font-size: .78rem; gap: .35rem;`. |
| `322` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `323` | ``</style>`` | Cierre de bloque de estilos CSS. |
| `324` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `325` | `<!-- ══ BREADCRUMB ═════════════════════════════════════════════════════...` | Instrucción de ejecución en el contexto del script: `<!-- ══ BREADCRUMB ═════════════════════════════════════════════════════...`. |
| `326` | `<div class="d-flex justify-content-between align-items-start mb-4 flex-w...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="d-flex justify-content-between align-items-start mb-4 flex-w...`. |
| `327` | `<div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div>`. |
| `328` | `<nav aria-label="breadcrumb" class="mb-1">` | Instrucción de ejecución en el contexto del script: `<nav aria-label="breadcrumb" class="mb-1">`. |
| `329` | `<ol class="breadcrumb mb-0" style="font-size:.82rem;">` | Instrucción de ejecución en el contexto del script: `<ol class="breadcrumb mb-0" style="font-size:.82rem;">`. |
| `330` | `<li class="breadcrumb-item">` | Instrucción de ejecución en el contexto del script: `<li class="breadcrumb-item">`. |
| `331` | `<a href="admin_evidencias.php" class="text-success text-decoration-none ...` | Instrucción de ejecución en el contexto del script: `<a href="admin_evidencias.php" class="text-success text-decoration-none ...`. |
| `332` | `<i class="fas fa-images me-1"></i>Evidencias` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-images me-1"></i>Evidencias`. |
| `333` | `</a>` | Instrucción de ejecución en el contexto del script: `</a>`. |
| `334` | `</li>` | Instrucción de ejecución en el contexto del script: `</li>`. |
| `335` | `<?php if ($programaAct): ?>` | Instrucción de ejecución en el contexto del script: `<?php if ($programaAct): ?>`. |
| `336` | `<li class="breadcrumb-item">` | Instrucción de ejecución en el contexto del script: `<li class="breadcrumb-item">`. |
| `337` | `<?php if ($fichaAct): ?>` | Instrucción de ejecución en el contexto del script: `<?php if ($fichaAct): ?>`. |
| `338` | `<a href="admin_evidencias.php?programa=<?= $vistaPrograma ?>"` | Instrucción de ejecución en el contexto del script: `<a href="admin_evidencias.php?programa=<?= $vistaPrograma ?>"`. |
| `339` | `class="text-success text-decoration-none">` | Instrucción de ejecución en el contexto del script: `class="text-success text-decoration-none">`. |
| `340` | `<?= htmlspecialchars($programaAct['nombre']) ?>` | Instrucción de ejecución en el contexto del script: `<?= htmlspecialchars($programaAct['nombre']) ?>`. |
| `341` | `</a>` | Instrucción de ejecución en el contexto del script: `</a>`. |
| `342` | `<?php else: ?>` | Instrucción de ejecución en el contexto del script: `<?php else: ?>`. |
| `343` | `<span class="text-dark fw-semibold"><?= htmlspecialchars($programaAct['n...` | Instrucción de ejecución en el contexto del script: `<span class="text-dark fw-semibold"><?= htmlspecialchars($programaAct['n...`. |
| `344` | `<?php endif; ?>` | Cierre de estructura condicional embebida en la plantilla HTML. |
| `345` | `</li>` | Instrucción de ejecución en el contexto del script: `</li>`. |
| `346` | `<?php endif; ?>` | Cierre de estructura condicional embebida en la plantilla HTML. |
| `347` | `<?php if ($fichaAct): ?>` | Instrucción de ejecución en el contexto del script: `<?php if ($fichaAct): ?>`. |
| `348` | `<li class="breadcrumb-item active">` | Instrucción de ejecución en el contexto del script: `<li class="breadcrumb-item active">`. |
| `349` | `Ficha <strong class="font-monospace"><?= htmlspecialchars($fichaAct['num...` | Instrucción de ejecución en el contexto del script: `Ficha <strong class="font-monospace"><?= htmlspecialchars($fichaAct['num...`. |
| `350` | `</li>` | Instrucción de ejecución en el contexto del script: `</li>`. |
| `351` | `<?php endif; ?>` | Cierre de estructura condicional embebida en la plantilla HTML. |
| `352` | `</ol>` | Instrucción de ejecución en el contexto del script: `</ol>`. |
| `353` | `</nav>` | Instrucción de ejecución en el contexto del script: `</nav>`. |
| `354` | `<h4 class="fw-bold mb-0">` | Instrucción de ejecución en el contexto del script: `<h4 class="fw-bold mb-0">`. |
| `355` | `<?php if ($fichaAct): ?>` | Instrucción de ejecución en el contexto del script: `<?php if ($fichaAct): ?>`. |
| `356` | `<i class="fas fa-images text-success me-2"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-images text-success me-2"></i>`. |
| `357` | `Evidencias — Ficha <span class="font-monospace"><?= htmlspecialchars($fi...` | Instrucción de ejecución en el contexto del script: `Evidencias — Ficha <span class="font-monospace"><?= htmlspecialchars($fi...`. |
| `358` | `<?php elseif ($programaAct): ?>` | Instrucción de ejecución en el contexto del script: `<?php elseif ($programaAct): ?>`. |
| `359` | `<i class="fas fa-id-card text-success me-2"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-id-card text-success me-2"></i>`. |
| `360` | `Fichas — <?= htmlspecialchars($programaAct['nombre']) ?>` | Instrucción de ejecución en el contexto del script: `Fichas — <?= htmlspecialchars($programaAct['nombre']) ?>`. |
| `361` | `<?php else: ?>` | Instrucción de ejecución en el contexto del script: `<?php else: ?>`. |
| `362` | `<i class="fas fa-images text-success me-2"></i>Evidencias de Limpieza` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-images text-success me-2"></i>Evidencias de Limpieza`. |
| `363` | `<?php endif; ?>` | Cierre de estructura condicional embebida en la plantilla HTML. |
| `364` | `</h4>` | Instrucción de ejecución en el contexto del script: `</h4>`. |
| `365` | `<p class="text-muted small mb-0">` | Instrucción de ejecución en el contexto del script: `<p class="text-muted small mb-0">`. |
| `366` | `<?php if ($fichaAct): ?>` | Instrucción de ejecución en el contexto del script: `<?php if ($fichaAct): ?>`. |
| `367` | `Historial de pares antes/después registrados por el vocero · ordenados p...` | Instrucción de ejecución en el contexto del script: `Historial de pares antes/después registrados por el vocero · ordenados p...`. |
| `368` | `<?php elseif ($programaAct): ?>` | Instrucción de ejecución en el contexto del script: `<?php elseif ($programaAct): ?>`. |
| `369` | `Selecciona una ficha para ver su historial de evidencias` | Instrucción de ejecución en el contexto del script: `Selecciona una ficha para ver su historial de evidencias`. |
| `370` | `<?php else: ?>` | Instrucción de ejecución en el contexto del script: `<?php else: ?>`. |
| `371` | `Seguimiento centralizado de evidencias por programa y ficha` | Instrucción de ejecución en el contexto del script: `Seguimiento centralizado de evidencias por programa y ficha`. |
| `372` | `<?php endif; ?>` | Cierre de estructura condicional embebida en la plantilla HTML. |
| `373` | `</p>` | Instrucción de ejecución en el contexto del script: `</p>`. |
| `374` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `375` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `376` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `377` | `<!-- ══ NIVEL 0: GRID DE PROGRAMAS ═════════════════════════════════════...` | Instrucción de ejecución en el contexto del script: `<!-- ══ NIVEL 0: GRID DE PROGRAMAS ═════════════════════════════════════...`. |
| `378` | `<?php if (!$vistaPrograma && !$vistaFicha): ?>` | Instrucción de ejecución en el contexto del script: `<?php if (!$vistaPrograma && !$vistaFicha): ?>`. |
| `379` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `380` | `<div class="row g-3 mb-4">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="row g-3 mb-4">`. |
| `381` | `<div class="col-sm-4">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="col-sm-4">`. |
| `382` | `<div class="stat-card bg-white">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="stat-card bg-white">`. |
| `383` | `<div class="d-flex align-items-center gap-3">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="d-flex align-items-center gap-3">`. |
| `384` | `<div class="stat-icon" style="background:rgba(57,169,0,.12);color:#39a90...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="stat-icon" style="background:rgba(57,169,0,.12);color:#39a90...`. |
| `385` | `<i class="fas fa-graduation-cap"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-graduation-cap"></i>`. |
| `386` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `387` | `<div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div>`. |
| `388` | `<div class="fs-4 fw-bold"><?= count($programas) ?></div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="fs-4 fw-bold"><?= count($programas) ?></div>`. |
| `389` | `<div class="text-muted small">Programas</div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="text-muted small">Programas</div>`. |
| `390` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `391` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `392` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `393` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `394` | `<div class="col-sm-4">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="col-sm-4">`. |
| `395` | `<div class="stat-card bg-white">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="stat-card bg-white">`. |
| `396` | `<div class="d-flex align-items-center gap-3">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="d-flex align-items-center gap-3">`. |
| `397` | `<div class="stat-icon" style="background:rgba(37,99,235,.1);color:#2563e...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="stat-icon" style="background:rgba(37,99,235,.1);color:#2563e...`. |
| `398` | `<i class="fas fa-id-card"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-id-card"></i>`. |
| `399` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `400` | `<div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div>`. |
| `401` | `<div class="fs-4 fw-bold"><?= array_sum(array_column($programas,'total_f...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="fs-4 fw-bold"><?= array_sum(array_column($programas,'total_f...`. |
| `402` | `<div class="text-muted small">Fichas activas</div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="text-muted small">Fichas activas</div>`. |
| `403` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `404` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `405` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `406` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `407` | `<div class="col-sm-4">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="col-sm-4">`. |
| `408` | `<div class="stat-card bg-white">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="stat-card bg-white">`. |
| `409` | `<div class="d-flex align-items-center gap-3">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="d-flex align-items-center gap-3">`. |
| `410` | `<div class="stat-icon" style="background:rgba(234,179,8,.1);color:#d9770...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="stat-icon" style="background:rgba(234,179,8,.1);color:#d9770...`. |
| `411` | `<i class="fas fa-images"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-images"></i>`. |
| `412` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `413` | `<div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div>`. |
| `414` | `<div class="fs-4 fw-bold"><?= $totalParesCompletos ?></div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="fs-4 fw-bold"><?= $totalParesCompletos ?></div>`. |
| `415` | `<div class="text-muted small">Pares completos</div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="text-muted small">Pares completos</div>`. |
| `416` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `417` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `418` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `419` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `420` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `421` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `422` | `<div class="mb-3">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="mb-3">`. |
| `423` | `<div class="input-group input-group-sm" style="max-width:340px;">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="input-group input-group-sm" style="max-width:340px;">`. |
| `424` | `<span class="input-group-text bg-white"><i class="fas fa-search text-mut...` | Instrucción de ejecución en el contexto del script: `<span class="input-group-text bg-white"><i class="fas fa-search text-mut...`. |
| `425` | `<input type="text" id="buscPrograma" class="form-control border-start-0"...` | Campo de entrada interactivo para datos del usuario: `<input type="text" id="buscPrograma" class="form-control border-start-0"...`. |
| `426` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `427` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `428` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `429` | `<div class="row g-3" id="gridProgramas">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="row g-3" id="gridProgramas">`. |
| `430` | `<?php foreach ($programas as $p):` | Instrucción de ejecución en el contexto del script: `<?php foreach ($programas as $p):`. |
| `431` | `// Pares completos de este programa` | Comentario explicativo en el código: `Pares completos de este programa`. |
| `432` | `$stmtEC = $db->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmtEC = $db->prepare(`. |
| `433` | `"SELECT COUNT(*) FROM (` | Instrucción de ejecución en el contexto del script: `"SELECT COUNT(*) FROM (`. |
| `434` | `SELECT e.id_grupo FROM evidencias e` | Instrucción de ejecución en el contexto del script: `SELECT e.id_grupo FROM evidencias e`. |
| `435` | `JOIN grupos g   ON g.id_grupo     = e.id_grupo` | Instrucción de ejecución en el contexto del script: `JOIN grupos g   ON g.id_grupo     = e.id_grupo`. |
| `436` | `JOIN asignaciones a ON a.id_asignacion = g.id_asignacion` | Instrucción de ejecución en el contexto del script: `JOIN asignaciones a ON a.id_asignacion = g.id_asignacion`. |
| `437` | `WHERE a.id_ficha IN (SELECT id_ficha FROM fichas WHERE id_programa = :prog)` | Instrucción de ejecución en el contexto del script: `WHERE a.id_ficha IN (SELECT id_ficha FROM fichas WHERE id_programa = :prog)`. |
| `438` | `GROUP BY e.id_grupo, g.fecha_limpieza` | Instrucción de ejecución en el contexto del script: `GROUP BY e.id_grupo, g.fecha_limpieza`. |
| `439` | `HAVING COUNT(DISTINCT e.tipo) >= 2` | Instrucción de ejecución en el contexto del script: `HAVING COUNT(DISTINCT e.tipo) >= 2`. |
| `440` | `) t"` | Instrucción de ejecución en el contexto del script: `) t"`. |
| `441` | ``);`` | Cierre de estructura de arreglo o invocación de función. |
| `442` | `$stmtEC->execute([':prog' => $p['id_programa']]);` | Ejecuta la sentencia SQL preparada vinculando los parámetros correspondientes: `$stmtEC->execute([':prog' => $p['id_programa']]);`. |
| `443` | `$cntPares = (int)$stmtEC->fetchColumn();` | Recupera el valor escalar de la primera columna del resultado de la consulta. |
| `444` | ``?>`` | Cierre de la etiqueta PHP para alternar a salida HTML o fin del archivo. |
| `445` | `<div class="col-md-6 col-lg-4 prog-item">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="col-md-6 col-lg-4 prog-item">`. |
| `446` | `<a href="admin_evidencias.php?programa=<?= $p['id_programa'] ?>" class="...` | Instrucción de ejecución en el contexto del script: `<a href="admin_evidencias.php?programa=<?= $p['id_programa'] ?>" class="...`. |
| `447` | `<div class="card border-0 shadow-sm h-100 prog-card" style="border-radiu...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="card border-0 shadow-sm h-100 prog-card" style="border-radiu...`. |
| `448` | `<div class="card-body p-4">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="card-body p-4">`. |
| `449` | `<div class="d-flex align-items-start justify-content-between mb-3">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="d-flex align-items-start justify-content-between mb-3">`. |
| `450` | `<div style="width:44px;height:44px;border-radius:10px;` | Contenedor visual estructurado con Bootstrap/CSS: `<div style="width:44px;height:44px;border-radius:10px;`. |
| `451` | `background:rgba(57,169,0,.12);color:#39a900;` | Instrucción de ejecución en el contexto del script: `background:rgba(57,169,0,.12);color:#39a900;`. |
| `452` | `display:flex;align-items:center;justify-content:center;font-size:1.2rem;">` | Instrucción de ejecución en el contexto del script: `display:flex;align-items:center;justify-content:center;font-size:1.2rem;">`. |
| `453` | `<i class="fas fa-graduation-cap"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-graduation-cap"></i>`. |
| `454` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `455` | `<span class="badge bg-light text-dark border" style="font-size:.72rem;">` | Instrucción de ejecución en el contexto del script: `<span class="badge bg-light text-dark border" style="font-size:.72rem;">`. |
| `456` | `<?= htmlspecialchars($p['nivel'] ?? 'Sin nivel') ?>` | Instrucción de ejecución en el contexto del script: `<?= htmlspecialchars($p['nivel'] ?? 'Sin nivel') ?>`. |
| `457` | `</span>` | Instrucción de ejecución en el contexto del script: `</span>`. |
| `458` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `459` | `<h6 class="fw-bold mb-3 text-dark" style="font-size:.88rem;line-height:1...` | Instrucción de ejecución en el contexto del script: `<h6 class="fw-bold mb-3 text-dark" style="font-size:.88rem;line-height:1...`. |
| `460` | `<?= htmlspecialchars($p['nombre']) ?>` | Instrucción de ejecución en el contexto del script: `<?= htmlspecialchars($p['nombre']) ?>`. |
| `461` | `</h6>` | Instrucción de ejecución en el contexto del script: `</h6>`. |
| `462` | `<div class="d-flex gap-3 pt-3" style="border-top:1px solid #e5e7eb;">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="d-flex gap-3 pt-3" style="border-top:1px solid #e5e7eb;">`. |
| `463` | `<div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div>`. |
| `464` | `<div class="fw-bold text-success fs-5"><?= (int)$p['total_fichas'] ?></div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="fw-bold text-success fs-5"><?= (int)$p['total_fichas'] ?></div>`. |
| `465` | `<div class="text-muted" style="font-size:.72rem;">Fichas</div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="text-muted" style="font-size:.72rem;">Fichas</div>`. |
| `466` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `467` | `<div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div>`. |
| `468` | `<div class="fw-bold text-warning fs-5"><?= $cntPares ?></div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="fw-bold text-warning fs-5"><?= $cntPares ?></div>`. |
| `469` | `<div class="text-muted" style="font-size:.72rem;">Pares completos</div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="text-muted" style="font-size:.72rem;">Pares completos</div>`. |
| `470` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `471` | `<div class="ms-auto d-flex align-items-center text-success" style="font-...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="ms-auto d-flex align-items-center text-success" style="font-...`. |
| `472` | `Ver fichas <i class="fas fa-arrow-right ms-1"></i>` | Instrucción de ejecución en el contexto del script: `Ver fichas <i class="fas fa-arrow-right ms-1"></i>`. |
| `473` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `474` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `475` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `476` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `477` | `</a>` | Instrucción de ejecución en el contexto del script: `</a>`. |
| `478` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `479` | `<?php endforeach; ?>` | Cierre de ciclo iterativo foreach embebido en la plantilla HTML. |
| `480` | `<?php if (empty($programas)): ?>` | Instrucción de ejecución en el contexto del script: `<?php if (empty($programas)): ?>`. |
| `481` | `<div class="col-12 text-center py-5 text-muted">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="col-12 text-center py-5 text-muted">`. |
| `482` | `<i class="fas fa-graduation-cap fa-3x mb-3 opacity-25 d-block"></i>No ha...` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-graduation-cap fa-3x mb-3 opacity-25 d-block"></i>No ha...`. |
| `483` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `484` | `<?php endif; ?>` | Cierre de estructura condicional embebida en la plantilla HTML. |
| `485` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `486` | `<?php endif; ?>` | Cierre de estructura condicional embebida en la plantilla HTML. |
| `487` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `488` | `<!-- ══ NIVEL 1: FICHAS DEL PROGRAMA ═══════════════════════════════════...` | Instrucción de ejecución en el contexto del script: `<!-- ══ NIVEL 1: FICHAS DEL PROGRAMA ═══════════════════════════════════...`. |
| `489` | `<?php if ($vistaPrograma && !$vistaFicha): ?>` | Instrucción de ejecución en el contexto del script: `<?php if ($vistaPrograma && !$vistaFicha): ?>`. |
| `490` | `<div class="row g-3">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="row g-3">`. |
| `491` | `<?php foreach ($fichasDelProg as $f):` | Instrucción de ejecución en el contexto del script: `<?php foreach ($fichasDelProg as $f):`. |
| `492` | `$stmtEF = $db->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmtEF = $db->prepare(`. |
| `493` | `"SELECT COUNT(*) FROM (` | Instrucción de ejecución en el contexto del script: `"SELECT COUNT(*) FROM (`. |
| `494` | `SELECT e.id_grupo FROM evidencias e` | Instrucción de ejecución en el contexto del script: `SELECT e.id_grupo FROM evidencias e`. |
| `495` | `JOIN grupos g ON g.id_grupo = e.id_grupo` | Instrucción de ejecución en el contexto del script: `JOIN grupos g ON g.id_grupo = e.id_grupo`. |
| `496` | `JOIN asignaciones a ON a.id_asignacion = g.id_asignacion` | Instrucción de ejecución en el contexto del script: `JOIN asignaciones a ON a.id_asignacion = g.id_asignacion`. |
| `497` | `WHERE a.id_ficha = :fic` | Instrucción de ejecución en el contexto del script: `WHERE a.id_ficha = :fic`. |
| `498` | `GROUP BY e.id_grupo, g.fecha_limpieza` | Instrucción de ejecución en el contexto del script: `GROUP BY e.id_grupo, g.fecha_limpieza`. |
| `499` | `HAVING COUNT(DISTINCT e.tipo) >= 2` | Instrucción de ejecución en el contexto del script: `HAVING COUNT(DISTINCT e.tipo) >= 2`. |
| `500` | `) t"` | Instrucción de ejecución en el contexto del script: `) t"`. |
| `501` | ``);`` | Cierre de estructura de arreglo o invocación de función. |
| `502` | `$stmtEF->execute([':fic' => $f['id_ficha']]);` | Ejecuta la sentencia SQL preparada vinculando los parámetros correspondientes: `$stmtEF->execute([':fic' => $f['id_ficha']]);`. |
| `503` | `$cntParFicha = (int)$stmtEF->fetchColumn();` | Recupera el valor escalar de la primera columna del resultado de la consulta. |
| `504` | ``?>`` | Cierre de la etiqueta PHP para alternar a salida HTML o fin del archivo. |
| `505` | `<div class="col-md-6 col-lg-4">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="col-md-6 col-lg-4">`. |
| `506` | `<a href="admin_evidencias.php?ficha=<?= $f['id_ficha'] ?>" class="text-d...` | Instrucción de ejecución en el contexto del script: `<a href="admin_evidencias.php?ficha=<?= $f['id_ficha'] ?>" class="text-d...`. |
| `507` | `<div class="card border-0 shadow-sm h-100 prog-card" style="border-radiu...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="card border-0 shadow-sm h-100 prog-card" style="border-radiu...`. |
| `508` | `<div class="card-body p-4">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="card-body p-4">`. |
| `509` | `<div class="d-flex align-items-start justify-content-between mb-3">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="d-flex align-items-start justify-content-between mb-3">`. |
| `510` | `<div style="width:44px;height:44px;border-radius:10px;` | Contenedor visual estructurado con Bootstrap/CSS: `<div style="width:44px;height:44px;border-radius:10px;`. |
| `511` | `background:rgba(37,99,235,.1);color:#2563eb;` | Instrucción de ejecución en el contexto del script: `background:rgba(37,99,235,.1);color:#2563eb;`. |
| `512` | `display:flex;align-items:center;justify-content:center;font-size:1.1rem;">` | Instrucción de ejecución en el contexto del script: `display:flex;align-items:center;justify-content:center;font-size:1.1rem;">`. |
| `513` | `<i class="fas fa-id-card"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-id-card"></i>`. |
| `514` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `515` | `<span class="badge bg-light text-dark border"><?= htmlspecialchars($f['j...` | Instrucción de ejecución en el contexto del script: `<span class="badge bg-light text-dark border"><?= htmlspecialchars($f['j...`. |
| `516` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `517` | `<div class="fw-bold text-success font-monospace mb-1" style="font-size:1...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="fw-bold text-success font-monospace mb-1" style="font-size:1...`. |
| `518` | `<?= htmlspecialchars($f['numero_ficha']) ?>` | Instrucción de ejecución en el contexto del script: `<?= htmlspecialchars($f['numero_ficha']) ?>`. |
| `519` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `520` | `<div class="text-muted small mb-3">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="text-muted small mb-3">`. |
| `521` | `<?php if ($f['vocero_nombres']): ?>` | Instrucción de ejecución en el contexto del script: `<?php if ($f['vocero_nombres']): ?>`. |
| `522` | `<i class="fas fa-user-tie text-success me-1" style="font-size:.75rem;"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-user-tie text-success me-1" style="font-size:.75rem;"></i>`. |
| `523` | `<?= htmlspecialchars($f['vocero_nombres'] . ' ' . $f['vocero_apellidos']...` | Instrucción de ejecución en el contexto del script: `<?= htmlspecialchars($f['vocero_nombres'] . ' ' . $f['vocero_apellidos']...`. |
| `524` | `<?php else: ?>` | Instrucción de ejecución en el contexto del script: `<?php else: ?>`. |
| `525` | `<span class="text-warning"><i class="fas fa-exclamation-circle me-1"></i...` | Instrucción de ejecución en el contexto del script: `<span class="text-warning"><i class="fas fa-exclamation-circle me-1"></i...`. |
| `526` | `<?php endif; ?>` | Cierre de estructura condicional embebida en la plantilla HTML. |
| `527` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `528` | `<div class="d-flex gap-3 pt-3" style="border-top:1px solid #e5e7eb;">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="d-flex gap-3 pt-3" style="border-top:1px solid #e5e7eb;">`. |
| `529` | `<div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div>`. |
| `530` | `<div class="fw-bold text-warning fs-5"><?= $cntParFicha ?></div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="fw-bold text-warning fs-5"><?= $cntParFicha ?></div>`. |
| `531` | `<div class="text-muted" style="font-size:.72rem;">Pares completos</div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="text-muted" style="font-size:.72rem;">Pares completos</div>`. |
| `532` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `533` | `<div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div>`. |
| `534` | `<div class="fw-bold text-muted" style="font-size:1rem;"><?= (int)$f['tot...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="fw-bold text-muted" style="font-size:1rem;"><?= (int)$f['tot...`. |
| `535` | `<div class="text-muted" style="font-size:.72rem;">Aprendices</div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="text-muted" style="font-size:.72rem;">Aprendices</div>`. |
| `536` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `537` | `<div class="ms-auto d-flex align-items-center text-success" style="font-...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="ms-auto d-flex align-items-center text-success" style="font-...`. |
| `538` | `Ver evidencias <i class="fas fa-arrow-right ms-1"></i>` | Instrucción de ejecución en el contexto del script: `Ver evidencias <i class="fas fa-arrow-right ms-1"></i>`. |
| `539` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `540` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `541` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `542` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `543` | `</a>` | Instrucción de ejecución en el contexto del script: `</a>`. |
| `544` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `545` | `<?php endforeach; ?>` | Cierre de ciclo iterativo foreach embebido en la plantilla HTML. |
| `546` | `<?php if (empty($fichasDelProg)): ?>` | Instrucción de ejecución en el contexto del script: `<?php if (empty($fichasDelProg)): ?>`. |
| `547` | `<div class="col-12 text-center py-5 text-muted">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="col-12 text-center py-5 text-muted">`. |
| `548` | `<i class="fas fa-id-card fa-3x mb-3 opacity-25 d-block"></i>No hay ficha...` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-id-card fa-3x mb-3 opacity-25 d-block"></i>No hay ficha...`. |
| `549` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `550` | `<?php endif; ?>` | Cierre de estructura condicional embebida en la plantilla HTML. |
| `551` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `552` | `<?php endif; ?>` | Cierre de estructura condicional embebida en la plantilla HTML. |
| `553` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `554` | `<!-- ══ NIVEL 2: CALENDARIO Y GALERÍA DE LA FICHA ══════════════════════...` | Instrucción de ejecución en el contexto del script: `<!-- ══ NIVEL 2: CALENDARIO Y GALERÍA DE LA FICHA ══════════════════════...`. |
| `555` | `<?php if ($vistaFicha && $fichaAct): ?>` | Instrucción de ejecución en el contexto del script: `<?php if ($vistaFicha && $fichaAct): ?>`. |
| `556` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `557` | `<!-- FullCalendar Assets -->` | Instrucción de ejecución en el contexto del script: `<!-- FullCalendar Assets -->`. |
| `558` | `<link  href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.glob...` | Vinculación de hoja de estilos o recurso externo: `<link  href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.glob...`. |
| `559` | ``<script>`` | Bloque o etiqueta de vinculación para scripts JavaScript del lado del cliente. |
| `560` | ``<script>`` | Bloque o etiqueta de vinculación para scripts JavaScript del lado del cliente. |
| `561` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `562` | ``<?php`` | Apertura obligatoria de la etiqueta PHP para ejecución del código del lado del servidor. |
| `563` | `$stmtGC = $db->prepare("SELECT COUNT(*) FROM grupos g JOIN asignaciones ...` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmtGC = $db->prepare("SELECT COUNT(*) FROM grupos g JOIN asignaciones ...`. |
| `564` | `$stmtGC->execute([':fic' => $vistaFicha]);` | Ejecuta la sentencia SQL preparada vinculando los parámetros correspondientes: `$stmtGC->execute([':fic' => $vistaFicha]);`. |
| `565` | `$cntGrupos       = (int)$stmtGC->fetchColumn();` | Recupera el valor escalar de la primera columna del resultado de la consulta. |
| `566` | `$voceroNombre    = trim(($fichaAct['vocero_nombres'] ?? '') . ' ' . ($fi...` | Instrucción de ejecución en el contexto del script: `$voceroNombre    = trim(($fichaAct['vocero_nombres'] ?? '') . ' ' . ($fi...`. |
| `567` | `$turnosCompletos = count(array_filter($turnos, fn($t) => (int)$t['fotos_...` | Instrucción de ejecución en el contexto del script: `$turnosCompletos = count(array_filter($turnos, fn($t) => (int)$t['fotos_...`. |
| `568` | ``?>`` | Cierre de la etiqueta PHP para alternar a salida HTML o fin del archivo. |
| `569` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `570` | `<div class="row g-3 mb-4">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="row g-3 mb-4">`. |
| `571` | `<div class="col-sm-4">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="col-sm-4">`. |
| `572` | `<div class="stat-card bg-white">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="stat-card bg-white">`. |
| `573` | `<div class="d-flex align-items-center gap-3">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="d-flex align-items-center gap-3">`. |
| `574` | `<div class="stat-icon" style="background:rgba(57,169,0,.12);color:#39a90...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="stat-icon" style="background:rgba(57,169,0,.12);color:#39a90...`. |
| `575` | `<div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div>`. |
| `576` | `<div class="fs-4 fw-bold"><?= $turnosCompletos ?> / <?= count($turnos) ?...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="fs-4 fw-bold"><?= $turnosCompletos ?> / <?= count($turnos) ?...`. |
| `577` | `<div class="text-muted small">Turnos con evidencia</div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="text-muted small">Turnos con evidencia</div>`. |
| `578` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `579` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `580` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `581` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `582` | `<div class="col-sm-4">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="col-sm-4">`. |
| `583` | `<div class="stat-card bg-white">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="stat-card bg-white">`. |
| `584` | `<div class="d-flex align-items-center gap-3">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="d-flex align-items-center gap-3">`. |
| `585` | `<div class="stat-icon" style="background:rgba(37,99,235,.1);color:#2563e...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="stat-icon" style="background:rgba(37,99,235,.1);color:#2563e...`. |
| `586` | `<div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div>`. |
| `587` | `<div class="fs-4 fw-bold"><?= $cntGrupos ?></div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="fs-4 fw-bold"><?= $cntGrupos ?></div>`. |
| `588` | `<div class="text-muted small">Grupos de limpieza</div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="text-muted small">Grupos de limpieza</div>`. |
| `589` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `590` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `591` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `592` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `593` | `<div class="col-sm-4">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="col-sm-4">`. |
| `594` | `<div class="stat-card bg-white">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="stat-card bg-white">`. |
| `595` | `<div class="d-flex align-items-center gap-3">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="d-flex align-items-center gap-3">`. |
| `596` | `<div class="stat-icon" style="background:rgba(234,179,8,.1);color:#d9770...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="stat-icon" style="background:rgba(234,179,8,.1);color:#d9770...`. |
| `597` | `<div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div>`. |
| `598` | `<div class="fw-bold" style="font-size:.9rem;"><?= htmlspecialchars($voce...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="fw-bold" style="font-size:.9rem;"><?= htmlspecialchars($voce...`. |
| `599` | `<div class="text-muted small">Vocero asignado</div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="text-muted small">Vocero asignado</div>`. |
| `600` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `601` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `602` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `603` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `604` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `605` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `606` | `<!-- Selector de vista: Calendario / Galería -->` | Instrucción de ejecución en el contexto del script: `<!-- Selector de vista: Calendario / Galería -->`. |
| `607` | `<div class="d-flex justify-content-between align-items-center flex-wrap ...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="d-flex justify-content-between align-items-center flex-wrap ...`. |
| `608` | `<div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div>`. |
| `609` | `<h6 class="fw-bold mb-0">` | Instrucción de ejecución en el contexto del script: `<h6 class="fw-bold mb-0">`. |
| `610` | `<i class="fas fa-calendar-days text-success me-2"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-calendar-days text-success me-2"></i>`. |
| `611` | `Evidencias — <span class="font-monospace text-success"><?= htmlspecialch...` | Instrucción de ejecución en el contexto del script: `Evidencias — <span class="font-monospace text-success"><?= htmlspecialch...`. |
| `612` | `<span class="text-muted fw-normal small ms-1">— <?= htmlspecialchars($fi...` | Instrucción de ejecución en el contexto del script: `<span class="text-muted fw-normal small ms-1">— <?= htmlspecialchars($fi...`. |
| `613` | `</h6>` | Instrucción de ejecución en el contexto del script: `</h6>`. |
| `614` | `<p class="text-muted small mb-0 mt-1">` | Instrucción de ejecución en el contexto del script: `<p class="text-muted small mb-0 mt-1">`. |
| `615` | `Calendario de limpiezas — haz clic en una fecha para ver las evidencias` | Instrucción de ejecución en el contexto del script: `Calendario de limpiezas — haz clic en una fecha para ver las evidencias`. |
| `616` | `</p>` | Instrucción de ejecución en el contexto del script: `</p>`. |
| `617` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `618` | `<ul class="nav nav-pills" id="pills-vista" role="tablist">` | Instrucción de ejecución en el contexto del script: `<ul class="nav nav-pills" id="pills-vista" role="tablist">`. |
| `619` | `<li class="nav-item">` | Instrucción de ejecución en el contexto del script: `<li class="nav-item">`. |
| `620` | `<button class="nav-link active fw-semibold btn-sm" id="tab-calendario-bt...` | Botón de acción interactivo para el usuario: `<button class="nav-link active fw-semibold btn-sm" id="tab-calendario-bt...`. |
| `621` | `<i class="fas fa-calendar-days me-1"></i>Calendario` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-calendar-days me-1"></i>Calendario`. |
| `622` | `</button>` | Instrucción de ejecución en el contexto del script: `</button>`. |
| `623` | `</li>` | Instrucción de ejecución en el contexto del script: `</li>`. |
| `624` | `<li class="nav-item">` | Instrucción de ejecución en el contexto del script: `<li class="nav-item">`. |
| `625` | `<button class="nav-link fw-semibold btn-sm" id="tab-galeria-btn" data-bs...` | Botón de acción interactivo para el usuario: `<button class="nav-link fw-semibold btn-sm" id="tab-galeria-btn" data-bs...`. |
| `626` | `<i class="fas fa-images me-1"></i>Galería de Fotos (<?= count($pares) ?>)` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-images me-1"></i>Galería de Fotos (<?= count($pares) ?>)`. |
| `627` | `</button>` | Instrucción de ejecución en el contexto del script: `</button>`. |
| `628` | `</li>` | Instrucción de ejecución en el contexto del script: `</li>`. |
| `629` | `</ul>` | Instrucción de ejecución en el contexto del script: `</ul>`. |
| `630` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `631` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `632` | `<div class="tab-content" id="pills-vistaContent">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="tab-content" id="pills-vistaContent">`. |
| `633` | `<!-- PESTAÑA 1: CALENDARIO -->` | Instrucción de ejecución en el contexto del script: `<!-- PESTAÑA 1: CALENDARIO -->`. |
| `634` | `<div class="tab-pane fade show active" id="vista-calendario" role="tabpa...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="tab-pane fade show active" id="vista-calendario" role="tabpa...`. |
| `635` | `<!-- Leyenda -->` | Instrucción de ejecución en el contexto del script: `<!-- Leyenda -->`. |
| `636` | `<div class="d-flex gap-3 flex-wrap mb-3" style="font-size:.8rem;">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="d-flex gap-3 flex-wrap mb-3" style="font-size:.8rem;">`. |
| `637` | `<span class="d-flex align-items-center gap-1">` | Instrucción de ejecución en el contexto del script: `<span class="d-flex align-items-center gap-1">`. |
| `638` | `<span style="width:14px;height:14px;border-radius:4px;background:#16a34a...` | Instrucción de ejecución en el contexto del script: `<span style="width:14px;height:14px;border-radius:4px;background:#16a34a...`. |
| `639` | `Evidencia entregada` | Instrucción de ejecución en el contexto del script: `Evidencia entregada`. |
| `640` | `</span>` | Instrucción de ejecución en el contexto del script: `</span>`. |
| `641` | `<span class="d-flex align-items-center gap-1">` | Instrucción de ejecución en el contexto del script: `<span class="d-flex align-items-center gap-1">`. |
| `642` | `<span style="width:14px;height:14px;border-radius:4px;background:#ef4444...` | Instrucción de ejecución en el contexto del script: `<span style="width:14px;height:14px;border-radius:4px;background:#ef4444...`. |
| `643` | `Vencida sin evidencia` | Instrucción de ejecución en el contexto del script: `Vencida sin evidencia`. |
| `644` | `</span>` | Instrucción de ejecución en el contexto del script: `</span>`. |
| `645` | `<span class="d-flex align-items-center gap-1">` | Instrucción de ejecución en el contexto del script: `<span class="d-flex align-items-center gap-1">`. |
| `646` | `<span style="width:14px;height:14px;border-radius:4px;background:#d1d5db...` | Instrucción de ejecución en el contexto del script: `<span style="width:14px;height:14px;border-radius:4px;background:#d1d5db...`. |
| `647` | `Próxima limpieza` | Instrucción de ejecución en el contexto del script: `Próxima limpieza`. |
| `648` | `</span>` | Instrucción de ejecución en el contexto del script: `</span>`. |
| `649` | `<span class="d-flex align-items-center gap-1">` | Instrucción de ejecución en el contexto del script: `<span class="d-flex align-items-center gap-1">`. |
| `650` | `<span style="width:14px;height:14px;border-radius:4px;background:#9ca3af...` | Instrucción de ejecución en el contexto del script: `<span style="width:14px;height:14px;border-radius:4px;background:#9ca3af...`. |
| `651` | `Sin grupo asignado` | Instrucción de ejecución en el contexto del script: `Sin grupo asignado`. |
| `652` | `</span>` | Instrucción de ejecución en el contexto del script: `</span>`. |
| `653` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `654` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `655` | `<!-- Calendario -->` | Instrucción de ejecución en el contexto del script: `<!-- Calendario -->`. |
| `656` | `<div class="card border-0 shadow-sm" style="border-radius:14px;overflow:...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="card border-0 shadow-sm" style="border-radius:14px;overflow:...`. |
| `657` | `<div class="card-body p-3 p-md-4">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="card-body p-3 p-md-4">`. |
| `658` | `<div id="calendario"></div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div id="calendario"></div>`. |
| `659` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `660` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `661` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `662` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `663` | `<!-- PESTAÑA 2: GALERÍA DE FOTOS -->` | Instrucción de ejecución en el contexto del script: `<!-- PESTAÑA 2: GALERÍA DE FOTOS -->`. |
| `664` | `<div class="tab-pane fade" id="vista-galeria" role="tabpanel">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="tab-pane fade" id="vista-galeria" role="tabpanel">`. |
| `665` | `<div class="d-flex justify-content-between align-items-center flex-wrap ...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="d-flex justify-content-between align-items-center flex-wrap ...`. |
| `666` | `<span class="badge bg-success"><?= count($pares) ?> registro(s)</span>` | Instrucción de ejecución en el contexto del script: `<span class="badge bg-success"><?= count($pares) ?> registro(s)</span>`. |
| `667` | `<div class="input-group input-group-sm" style="max-width:220px;">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="input-group input-group-sm" style="max-width:220px;">`. |
| `668` | `<span class="input-group-text bg-white"><i class="fas fa-search text-mut...` | Instrucción de ejecución en el contexto del script: `<span class="input-group-text bg-white"><i class="fas fa-search text-mut...`. |
| `669` | `<input type="text" id="buscEv" class="form-control border-start-0" place...` | Campo de entrada interactivo para datos del usuario: `<input type="text" id="buscEv" class="form-control border-start-0" place...`. |
| `670` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `671` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `672` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `673` | `<?php if (empty($pares)): ?>` | Instrucción de ejecución en el contexto del script: `<?php if (empty($pares)): ?>`. |
| `674` | `<div class="card shadow-sm border-0">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="card shadow-sm border-0">`. |
| `675` | `<div class="card-body text-center py-5 text-muted">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="card-body text-center py-5 text-muted">`. |
| `676` | `<i class="fas fa-images fa-3x mb-3 opacity-25 d-block"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-images fa-3x mb-3 opacity-25 d-block"></i>`. |
| `677` | `<p class="small mb-0">No hay evidencias registradas para esta ficha aún....` | Instrucción de ejecución en el contexto del script: `<p class="small mb-0">No hay evidencias registradas para esta ficha aún....`. |
| `678` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `679` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `680` | `<?php else: ?>` | Instrucción de ejecución en el contexto del script: `<?php else: ?>`. |
| `681` | `<div id="contPares">` | Contenedor visual estructurado con Bootstrap/CSS: `<div id="contPares">`. |
| `682` | `<?php foreach ($pares as $par):` | Instrucción de ejecución en el contexto del script: `<?php foreach ($pares as $par):`. |
| `683` | `$vocPar = trim(($par['vocero_nombres'] ?? '') . ' ' . ($par['vocero_apel...` | Instrucción de ejecución en el contexto del script: `$vocPar = trim(($par['vocero_nombres'] ?? '') . ' ' . ($par['vocero_apel...`. |
| `684` | `$completo = $par['antes'] && $par['despues'];` | Instrucción de ejecución en el contexto del script: `$completo = $par['antes'] && $par['despues'];`. |
| `685` | ``?>`` | Cierre de la etiqueta PHP para alternar a salida HTML o fin del archivo. |
| `686` | `<div class="par-card par-item"` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="par-card par-item"`. |
| `687` | `data-search="<?= strtolower(htmlspecialchars($par['nombre_grupo'] . ' ' ...` | Instrucción de ejecución en el contexto del script: `data-search="<?= strtolower(htmlspecialchars($par['nombre_grupo'] . ' ' ...`. |
| `688` | `<!-- Cabecera -->` | Instrucción de ejecución en el contexto del script: `<!-- Cabecera -->`. |
| `689` | `<div class="par-header">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="par-header">`. |
| `690` | `<i class="fas fa-door-open text-success" style="font-size:.8rem;"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-door-open text-success" style="font-size:.8rem;"></i>`. |
| `691` | `<span class="par-modulo"><?= htmlspecialchars($par['nombre_modulo']) ?><...` | Instrucción de ejecución en el contexto del script: `<span class="par-modulo"><?= htmlspecialchars($par['nombre_modulo']) ?><...`. |
| `692` | `<span class="par-grupo">· <?= htmlspecialchars($par['nombre_grupo']) ?><...` | Instrucción de ejecución en el contexto del script: `<span class="par-grupo">· <?= htmlspecialchars($par['nombre_grupo']) ?><...`. |
| `693` | `<?php if ($vocPar): ?>` | Instrucción de ejecución en el contexto del script: `<?php if ($vocPar): ?>`. |
| `694` | `<span class="par-vocero">` | Instrucción de ejecución en el contexto del script: `<span class="par-vocero">`. |
| `695` | `<i class="fas fa-user-tie me-1 text-success" style="font-size:.7rem;"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-user-tie me-1 text-success" style="font-size:.7rem;"></i>`. |
| `696` | `<?= htmlspecialchars($vocPar) ?>` | Instrucción de ejecución en el contexto del script: `<?= htmlspecialchars($vocPar) ?>`. |
| `697` | `</span>` | Instrucción de ejecución en el contexto del script: `</span>`. |
| `698` | `<?php endif; ?>` | Cierre de estructura condicional embebida en la plantilla HTML. |
| `699` | `<span class="par-fecha">` | Instrucción de ejecución en el contexto del script: `<span class="par-fecha">`. |
| `700` | `<i class="fas fa-calendar me-1"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-calendar me-1"></i>`. |
| `701` | `<?= date('d/m/Y', strtotime($par['fecha_limpieza'])) ?>` | Instrucción de ejecución en el contexto del script: `<?= date('d/m/Y', strtotime($par['fecha_limpieza'])) ?>`. |
| `702` | `</span>` | Instrucción de ejecución en el contexto del script: `</span>`. |
| `703` | `<?php if ($completo): ?>` | Instrucción de ejecución en el contexto del script: `<?php if ($completo): ?>`. |
| `704` | `<span class="badge ms-1" style="background:#dcfce7;color:#166534;font-si...` | Instrucción de ejecución en el contexto del script: `<span class="badge ms-1" style="background:#dcfce7;color:#166534;font-si...`. |
| `705` | `<i class="fas fa-check me-1"></i>Par completo` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-check me-1"></i>Par completo`. |
| `706` | `</span>` | Instrucción de ejecución en el contexto del script: `</span>`. |
| `707` | `<?php else: ?>` | Instrucción de ejecución en el contexto del script: `<?php else: ?>`. |
| `708` | `<span class="badge ms-1" style="background:#fef3c7;color:#92400e;font-si...` | Instrucción de ejecución en el contexto del script: `<span class="badge ms-1" style="background:#fef3c7;color:#92400e;font-si...`. |
| `709` | `Incompleto` | Instrucción de ejecución en el contexto del script: `Incompleto`. |
| `710` | `</span>` | Instrucción de ejecución en el contexto del script: `</span>`. |
| `711` | `<?php endif; ?>` | Cierre de estructura condicional embebida en la plantilla HTML. |
| `712` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `713` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `714` | `<!-- Fotos lado a lado -->` | Instrucción de ejecución en el contexto del script: `<!-- Fotos lado a lado -->`. |
| `715` | `<div class="par-fotos">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="par-fotos">`. |
| `716` | `<?php if ($par['antes']): ?>` | Instrucción de ejecución en el contexto del script: `<?php if ($par['antes']): ?>`. |
| `717` | `<div class="par-foto"` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="par-foto"`. |
| `718` | `onclick="verFoto(` | Función JavaScript para previsualizar la fotografía en alta resolución con SweetAlert2. |
| `719` | `<?= json_encode('../../public/' . $par['antes']['ruta_archivo']) ?>,` | Instrucción de ejecución en el contexto del script: `<?= json_encode('../../public/' . $par['antes']['ruta_archivo']) ?>,`. |
| `720` | `<?= json_encode('Antes — ' . $par['nombre_grupo']) ?>,` | Instrucción de ejecución en el contexto del script: `<?= json_encode('Antes — ' . $par['nombre_grupo']) ?>,`. |
| `721` | `<?= json_encode($par['nombre_modulo'] . ' · ' . date('d/m/Y', strtotime(...` | Instrucción de ejecución en el contexto del script: `<?= json_encode($par['nombre_modulo'] . ' · ' . date('d/m/Y', strtotime(...`. |
| `722` | `)">` | Instrucción de ejecución en el contexto del script: `)">`. |
| `723` | `<img src="../../public/<?= htmlspecialchars($par['antes']['ruta_archivo'...` | Instrucción de ejecución en el contexto del script: `<img src="../../public/<?= htmlspecialchars($par['antes']['ruta_archivo'...`. |
| `724` | `alt="Antes">` | Instrucción de ejecución en el contexto del script: `alt="Antes">`. |
| `725` | `<span class="par-foto-label label-antes">` | Instrucción de ejecución en el contexto del script: `<span class="par-foto-label label-antes">`. |
| `726` | `<i class="fas fa-clock me-1"></i>Antes` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-clock me-1"></i>Antes`. |
| `727` | `</span>` | Instrucción de ejecución en el contexto del script: `</span>`. |
| `728` | `<div class="par-foto-overlay"><i class="fas fa-expand"></i></div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="par-foto-overlay"><i class="fas fa-expand"></i></div>`. |
| `729` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `730` | `<?php else: ?>` | Instrucción de ejecución en el contexto del script: `<?php else: ?>`. |
| `731` | `<div class="par-foto-missing">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="par-foto-missing">`. |
| `732` | `<i class="fas fa-clock fa-lg opacity-30"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-clock fa-lg opacity-30"></i>`. |
| `733` | `<span>Foto antes no subida</span>` | Instrucción de ejecución en el contexto del script: `<span>Foto antes no subida</span>`. |
| `734` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `735` | `<?php endif; ?>` | Cierre de estructura condicional embebida en la plantilla HTML. |
| `736` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `737` | `<?php if ($par['despues']): ?>` | Instrucción de ejecución en el contexto del script: `<?php if ($par['despues']): ?>`. |
| `738` | `<div class="par-foto"` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="par-foto"`. |
| `739` | `onclick="verFoto(` | Función JavaScript para previsualizar la fotografía en alta resolución con SweetAlert2. |
| `740` | `<?= json_encode('../../public/' . $par['despues']['ruta_archivo']) ?>,` | Instrucción de ejecución en el contexto del script: `<?= json_encode('../../public/' . $par['despues']['ruta_archivo']) ?>,`. |
| `741` | `<?= json_encode('Después — ' . $par['nombre_grupo']) ?>,` | Instrucción de ejecución en el contexto del script: `<?= json_encode('Después — ' . $par['nombre_grupo']) ?>,`. |
| `742` | `<?= json_encode($par['nombre_modulo'] . ' · ' . date('d/m/Y', strtotime(...` | Instrucción de ejecución en el contexto del script: `<?= json_encode($par['nombre_modulo'] . ' · ' . date('d/m/Y', strtotime(...`. |
| `743` | `)">` | Instrucción de ejecución en el contexto del script: `)">`. |
| `744` | `<img src="../../public/<?= htmlspecialchars($par['despues']['ruta_archiv...` | Instrucción de ejecución en el contexto del script: `<img src="../../public/<?= htmlspecialchars($par['despues']['ruta_archiv...`. |
| `745` | `alt="Después">` | Instrucción de ejecución en el contexto del script: `alt="Después">`. |
| `746` | `<span class="par-foto-label label-despues">` | Instrucción de ejecución en el contexto del script: `<span class="par-foto-label label-despues">`. |
| `747` | `<i class="fas fa-circle-check me-1"></i>Después` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-circle-check me-1"></i>Después`. |
| `748` | `</span>` | Instrucción de ejecución en el contexto del script: `</span>`. |
| `749` | `<div class="par-foto-overlay"><i class="fas fa-expand"></i></div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="par-foto-overlay"><i class="fas fa-expand"></i></div>`. |
| `750` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `751` | `<?php else: ?>` | Instrucción de ejecución en el contexto del script: `<?php else: ?>`. |
| `752` | `<div class="par-foto-missing" style="border-left:1px dashed #d1d5db;">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="par-foto-missing" style="border-left:1px dashed #d1d5db;">`. |
| `753` | `<i class="fas fa-circle-check fa-lg opacity-30"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-circle-check fa-lg opacity-30"></i>`. |
| `754` | `<span>Foto después no subida</span>` | Instrucción de ejecución en el contexto del script: `<span>Foto después no subida</span>`. |
| `755` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `756` | `<?php endif; ?>` | Cierre de estructura condicional embebida en la plantilla HTML. |
| `757` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `758` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `759` | `<?php endforeach; ?>` | Cierre de ciclo iterativo foreach embebido en la plantilla HTML. |
| `760` | `</div><!-- /contPares -->` | Instrucción de ejecución en el contexto del script: `</div><!-- /contPares -->`. |
| `761` | `<?php endif; ?>` | Cierre de estructura condicional embebida en la plantilla HTML. |
| `762` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `763` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `764` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `765` | `<!-- Modal detalle del día (FullCalendar) -->` | Instrucción de ejecución en el contexto del script: `<!-- Modal detalle del día (FullCalendar) -->`. |
| `766` | `<div class="modal fade" id="modalDia" tabindex="-1" aria-hidden="true">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="modal fade" id="modalDia" tabindex="-1" aria-hidden="true">`. |
| `767` | `<div class="modal-dialog modal-dialog-centered modal-lg">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="modal-dialog modal-dialog-centered modal-lg">`. |
| `768` | `<div class="modal-content border-0 shadow">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="modal-content border-0 shadow">`. |
| `769` | `<div class="modal-header border-0" style="background:#0f2200;color:#fff;">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="modal-header border-0" style="background:#0f2200;color:#fff;">`. |
| `770` | `<div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div>`. |
| `771` | `<h6 class="modal-title fw-bold mb-0" id="modalDiaTitulo">` | Instrucción de ejecución en el contexto del script: `<h6 class="modal-title fw-bold mb-0" id="modalDiaTitulo">`. |
| `772` | `<i class="fas fa-calendar-day me-2 text-success"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-calendar-day me-2 text-success"></i>`. |
| `773` | `</h6>` | Instrucción de ejecución en el contexto del script: `</h6>`. |
| `774` | `<div class="small mt-1 opacity-75" id="modalDiaSub"></div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="small mt-1 opacity-75" id="modalDiaSub"></div>`. |
| `775` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `776` | `<button type="button" class="btn-close btn-close-white" data-bs-dismiss=...` | Botón de acción interactivo para el usuario: `<button type="button" class="btn-close btn-close-white" data-bs-dismiss=...`. |
| `777` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `778` | `<div class="modal-body p-0" id="modalDiaCuerpo">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="modal-body p-0" id="modalDiaCuerpo">`. |
| `779` | `<div class="text-center py-5 text-muted">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="text-center py-5 text-muted">`. |
| `780` | `<i class="fas fa-spinner fa-spin fa-lg d-block mb-2"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-spinner fa-spin fa-lg d-block mb-2"></i>`. |
| `781` | `Cargando…` | Instrucción de ejecución en el contexto del script: `Cargando…`. |
| `782` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `783` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `784` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `785` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `786` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `787` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `788` | `<?php endif; ?>` | Cierre de estructura condicional embebida en la plantilla HTML. |
| `789` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `790` | `<!-- ══ JS ═════════════════════════════════════════════════════════════...` | Instrucción de ejecución en el contexto del script: `<!-- ══ JS ═════════════════════════════════════════════════════════════...`. |
| `791` | ``<script>`` | Bloque o etiqueta de vinculación para scripts JavaScript del lado del cliente. |
| `792` | `// Buscador programas` | Comentario explicativo en el código: `Buscador programas`. |
| `793` | `const buscProg = document.getElementById('buscPrograma');` | Instrucción de ejecución en el contexto del script: `const buscProg = document.getElementById('buscPrograma');`. |
| `794` | `if (buscProg) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (buscProg) {`. |
| `795` | `buscProg.addEventListener('input', function () {` | Registra un escucha de eventos del DOM para interactividad en tiempo real: `buscProg.addEventListener('input', function () {`. |
| `796` | `const q = this.value.toLowerCase();` | Instrucción de ejecución en el contexto del script: `const q = this.value.toLowerCase();`. |
| `797` | `document.querySelectorAll('.prog-item').forEach(el => {` | Instrucción de ejecución en el contexto del script: `document.querySelectorAll('.prog-item').forEach(el => {`. |
| `798` | `el.style.display = !q \|\| el.textContent.toLowerCase().includes(q) ? ''...` | Instrucción de ejecución en el contexto del script: `el.style.display = !q \|\| el.textContent.toLowerCase().includes(q) ? ''...`. |
| `799` | `});` | Instrucción de ejecución en el contexto del script: `});`. |
| `800` | `});` | Instrucción de ejecución en el contexto del script: `});`. |
| `801` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `802` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `803` | `// Buscador pares (nivel 2 - galería)` | Comentario explicativo en el código: `Buscador pares (nivel 2 - galería)`. |
| `804` | `const buscEv = document.getElementById('buscEv');` | Instrucción de ejecución en el contexto del script: `const buscEv = document.getElementById('buscEv');`. |
| `805` | `if (buscEv) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (buscEv) {`. |
| `806` | `buscEv.addEventListener('input', function () {` | Registra un escucha de eventos del DOM para interactividad en tiempo real: `buscEv.addEventListener('input', function () {`. |
| `807` | `const q = this.value.toLowerCase();` | Instrucción de ejecución en el contexto del script: `const q = this.value.toLowerCase();`. |
| `808` | `document.querySelectorAll('.par-item').forEach(el => {` | Instrucción de ejecución en el contexto del script: `document.querySelectorAll('.par-item').forEach(el => {`. |
| `809` | `el.style.display = !q \|\| el.dataset.search.includes(q) ? '' : 'none';` | Instrucción de ejecución en el contexto del script: `el.style.display = !q \|\| el.dataset.search.includes(q) ? '' : 'none';`. |
| `810` | `});` | Instrucción de ejecución en el contexto del script: `});`. |
| `811` | `});` | Instrucción de ejecución en el contexto del script: `});`. |
| `812` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `813` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `814` | `// FullCalendar para nivel 2 (Ficha)` | Comentario explicativo en el código: `FullCalendar para nivel 2 (Ficha)`. |
| `815` | `<?php if ($vistaFicha && $fichaAct): ?>` | Instrucción de ejecución en el contexto del script: `<?php if ($vistaFicha && $fichaAct): ?>`. |
| `816` | `const eventosData = <?= json_encode($eventos ?? [], JSON_UNESCAPED_UNICO...` | Instrucción de ejecución en el contexto del script: `const eventosData = <?= json_encode($eventos ?? [], JSON_UNESCAPED_UNICO...`. |
| `817` | `let calInstance   = null;` | Instrucción de ejecución en el contexto del script: `let calInstance   = null;`. |
| `818` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `819` | `document.addEventListener('DOMContentLoaded', function () {` | Registra un escucha de eventos del DOM para interactividad en tiempo real: `document.addEventListener('DOMContentLoaded', function () {`. |
| `820` | `const calEl = document.getElementById('calendario');` | Instrucción de ejecución en el contexto del script: `const calEl = document.getElementById('calendario');`. |
| `821` | `if (calEl && typeof FullCalendar !== 'undefined') {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (calEl && typeof FullCalendar !== 'undefined') {`. |
| `822` | `calInstance = new FullCalendar.Calendar(calEl, {` | Instancia y configura el calendario mensual interactivo FullCalendar. |
| `823` | `locale:         'es',` | Instrucción de ejecución en el contexto del script: `locale:         'es',`. |
| `824` | `initialView:    'dayGridMonth',` | Instrucción de ejecución en el contexto del script: `initialView:    'dayGridMonth',`. |
| `825` | `height:         'auto',` | Instrucción de ejecución en el contexto del script: `height:         'auto',`. |
| `826` | `headerToolbar: {` | Instrucción de ejecución en el contexto del script: `headerToolbar: {`. |
| `827` | `left:   'prev,next today',` | Instrucción de ejecución en el contexto del script: `left:   'prev,next today',`. |
| `828` | `center: 'title',` | Instrucción de ejecución en el contexto del script: `center: 'title',`. |
| `829` | `right:  'dayGridMonth,dayGridYear'` | Instrucción de ejecución en el contexto del script: `right:  'dayGridMonth,dayGridYear'`. |
| `830` | `},` | Instrucción de ejecución en el contexto del script: `},`. |
| `831` | `buttonText: { today: 'Hoy', month: 'Mes', year: 'Año' },` | Instrucción de ejecución en el contexto del script: `buttonText: { today: 'Hoy', month: 'Mes', year: 'Año' },`. |
| `832` | `events: eventosData,` | Instrucción de ejecución en el contexto del script: `events: eventosData,`. |
| `833` | `eventClick: function (info) {` | Instrucción de ejecución en el contexto del script: `eventClick: function (info) {`. |
| `834` | `const p = info.event.extendedProps;` | Instrucción de ejecución en el contexto del script: `const p = info.event.extendedProps;`. |
| `835` | `abrirModalDia(` | Función JavaScript para desplegar el modal interactivo con el detalle y fotos del turno. |
| `836` | `info.event.startStr,` | Instrucción de ejecución en el contexto del script: `info.event.startStr,`. |
| `837` | `p.id_turno,` | Instrucción de ejecución en el contexto del script: `p.id_turno,`. |
| `838` | `p.id_grupo,` | Instrucción de ejecución en el contexto del script: `p.id_grupo,`. |
| `839` | `p.nombre_grupo,` | Instrucción de ejecución en el contexto del script: `p.nombre_grupo,`. |
| `840` | `p.nombre_modulo,` | Instrucción de ejecución en el contexto del script: `p.nombre_modulo,`. |
| `841` | `p.estado,` | Instrucción de ejecución en el contexto del script: `p.estado,`. |
| `842` | `p.fotos` | Instrucción de ejecución en el contexto del script: `p.fotos`. |
| `843` | ``);`` | Cierre de estructura de arreglo o invocación de función. |
| `844` | `},` | Instrucción de ejecución en el contexto del script: `},`. |
| `845` | `dayMaxEvents: 3,` | Instrucción de ejecución en el contexto del script: `dayMaxEvents: 3,`. |
| `846` | `moreLinkText: n => `+${n} más`,` | Instrucción de ejecución en el contexto del script: `moreLinkText: n => `+${n} más`,`. |
| `847` | `});` | Instrucción de ejecución en el contexto del script: `});`. |
| `848` | `calInstance.render();` | Instrucción de ejecución en el contexto del script: `calInstance.render();`. |
| `849` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `850` | `const tabCalBtn = document.getElementById('tab-calendario-btn');` | Instrucción de ejecución en el contexto del script: `const tabCalBtn = document.getElementById('tab-calendario-btn');`. |
| `851` | `if (tabCalBtn) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (tabCalBtn) {`. |
| `852` | `tabCalBtn.addEventListener('shown.bs.tab', function () {` | Registra un escucha de eventos del DOM para interactividad en tiempo real: `tabCalBtn.addEventListener('shown.bs.tab', function () {`. |
| `853` | `if (calInstance) calInstance.updateSize();` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (calInstance) calInstance.updateSize();`. |
| `854` | `});` | Instrucción de ejecución en el contexto del script: `});`. |
| `855` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `856` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `857` | `});` | Instrucción de ejecución en el contexto del script: `});`. |
| `858` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `859` | `function abrirModalDia(fecha, idTurno, idGrupo, nombreGrupo, modulo, est...` | Función JavaScript para desplegar el modal interactivo con el detalle y fotos del turno. |
| `860` | `const fechaFmt = new Date(fecha + 'T12:00:00').toLocaleDateString('es-CO...` | Instrucción de ejecución en el contexto del script: `const fechaFmt = new Date(fecha + 'T12:00:00').toLocaleDateString('es-CO...`. |
| `861` | `weekday: 'long', year: 'numeric', month: 'long', day: 'numeric'` | Instrucción de ejecución en el contexto del script: `weekday: 'long', year: 'numeric', month: 'long', day: 'numeric'`. |
| `862` | `});` | Instrucción de ejecución en el contexto del script: `});`. |
| `863` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `864` | `document.getElementById('modalDiaTitulo').innerHTML =` | Instrucción de ejecución en el contexto del script: `document.getElementById('modalDiaTitulo').innerHTML =`. |
| `865` | `'<i class="fas fa-calendar-day me-2 text-success"></i>' + fechaFmt;` | Instrucción de ejecución en el contexto del script: `'<i class="fas fa-calendar-day me-2 text-success"></i>' + fechaFmt;`. |
| `866` | `document.getElementById('modalDiaSub').textContent =` | Instrucción de ejecución en el contexto del script: `document.getElementById('modalDiaSub').textContent =`. |
| `867` | `modulo + (nombreGrupo ? ' · ' + nombreGrupo : '');` | Instrucción de ejecución en el contexto del script: `modulo + (nombreGrupo ? ' · ' + nombreGrupo : '');`. |
| `868` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `869` | `const cuerpo = document.getElementById('modalDiaCuerpo');` | Instrucción de ejecución en el contexto del script: `const cuerpo = document.getElementById('modalDiaCuerpo');`. |
| `870` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `871` | `const estadoHtml = {` | Instrucción de ejecución en el contexto del script: `const estadoHtml = {`. |
| `872` | `entregada: `<div class="estado-banner" style="background:#f0fdf4;color:#...` | Instrucción de ejecución en el contexto del script: `entregada: `<div class="estado-banner" style="background:#f0fdf4;color:#...`. |
| `873` | `<i class="fas fa-circle-check fa-lg"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-circle-check fa-lg"></i>`. |
| `874` | `<div><strong>Evidencias entregadas</strong><div class="text-muted" style...` | Contenedor visual estructurado con Bootstrap/CSS: `<div><strong>Evidencias entregadas</strong><div class="text-muted" style...`. |
| `875` | `</div>`,` | Instrucción de ejecución en el contexto del script: `</div>`,`. |
| `876` | `vencida: `<div class="estado-banner" style="background:#fef2f2;color:#99...` | Instrucción de ejecución en el contexto del script: `vencida: `<div class="estado-banner" style="background:#fef2f2;color:#99...`. |
| `877` | `<i class="fas fa-circle-xmark fa-lg"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-circle-xmark fa-lg"></i>`. |
| `878` | `<div><strong>No se subió evidencia</strong><div class="text-muted" style...` | Contenedor visual estructurado con Bootstrap/CSS: `<div><strong>No se subió evidencia</strong><div class="text-muted" style...`. |
| `879` | `</div>`,` | Instrucción de ejecución en el contexto del script: `</div>`,`. |
| `880` | `proxima: `<div class="estado-banner" style="background:#f9fafb;color:#37...` | Instrucción de ejecución en el contexto del script: `proxima: `<div class="estado-banner" style="background:#f9fafb;color:#37...`. |
| `881` | `<i class="fas fa-clock fa-lg text-muted"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-clock fa-lg text-muted"></i>`. |
| `882` | `<div><strong>Próxima limpieza</strong><div class="text-muted" style="fon...` | Contenedor visual estructurado con Bootstrap/CSS: `<div><strong>Próxima limpieza</strong><div class="text-muted" style="fon...`. |
| `883` | `</div>`,` | Instrucción de ejecución en el contexto del script: `</div>`,`. |
| `884` | `sin_grupo: `<div class="estado-banner" style="background:#f3f4f6;color:#...` | Instrucción de ejecución en el contexto del script: `sin_grupo: `<div class="estado-banner" style="background:#f3f4f6;color:#...`. |
| `885` | `<i class="fas fa-users-slash fa-lg text-muted"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-users-slash fa-lg text-muted"></i>`. |
| `886` | `<div><strong>Sin grupo asignado</strong><div class="text-muted" style="f...` | Contenedor visual estructurado con Bootstrap/CSS: `<div><strong>Sin grupo asignado</strong><div class="text-muted" style="f...`. |
| `887` | `</div>`,` | Instrucción de ejecución en el contexto del script: `</div>`,`. |
| `888` | `}[estado] \|\| '';` | Instrucción de ejecución en el contexto del script: `}[estado] \|\| '';`. |
| `889` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `890` | `if (estado !== 'entregada' \|\| !idTurno) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (estado !== 'entregada' \|\| !idTurno) {`. |
| `891` | `cuerpo.innerHTML = estadoHtml +` | Instrucción de ejecución en el contexto del script: `cuerpo.innerHTML = estadoHtml +`. |
| `892` | `'<div class="text-center py-5 text-muted small">No hay fotos para mostra...` | Instrucción de ejecución en el contexto del script: `'<div class="text-center py-5 text-muted small">No hay fotos para mostra...`. |
| `893` | `new bootstrap.Modal(document.getElementById('modalDia')).show();` | Instrucción de ejecución en el contexto del script: `new bootstrap.Modal(document.getElementById('modalDia')).show();`. |
| `894` | `return;` | Finaliza la ejecución de la función o script. |
| `895` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `896` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `897` | `cuerpo.innerHTML = estadoHtml +` | Instrucción de ejecución en el contexto del script: `cuerpo.innerHTML = estadoHtml +`. |
| `898` | `'<div class="text-center py-4"><i class="fas fa-spinner fa-spin fa-lg te...` | Instrucción de ejecución en el contexto del script: `'<div class="text-center py-4"><i class="fas fa-spinner fa-spin fa-lg te...`. |
| `899` | `new bootstrap.Modal(document.getElementById('modalDia')).show();` | Instrucción de ejecución en el contexto del script: `new bootstrap.Modal(document.getElementById('modalDia')).show();`. |
| `900` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `901` | `// Cargar fotos vía AJAX desde AdminController` | Comentario explicativo en el código: `Cargar fotos vía AJAX desde AdminController`. |
| `902` | `fetch(`../../controllers/AdminController.php?accion=get_evidencia_turno&...` | Petición asíncrona AJAX vía fetch API hacia el backend para cargar datos dinámicos. |
| `903` | `.then(r => r.json())` | Instrucción de ejecución en el contexto del script: `.then(r => r.json())`. |
| `904` | `.then(data => {` | Instrucción de ejecución en el contexto del script: `.then(data => {`. |
| `905` | `const par = data.par \|\| {};` | Instrucción de ejecución en el contexto del script: `const par = data.par \|\| {};`. |
| `906` | `let html = estadoHtml + '<div class="par-modal">';` | Instrucción de ejecución en el contexto del script: `let html = estadoHtml + '<div class="par-modal">';`. |
| `907` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `908` | `const fotoHtml = (foto, tipo) => {` | Instrucción de ejecución en el contexto del script: `const fotoHtml = (foto, tipo) => {`. |
| `909` | `if (!foto) return `<div class="sin-foto">` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (!foto) return `<div class="sin-foto">`. |
| `910` | `<i class="fas fa-${tipo==='antes'?'clock':'circle-check'} fa-xl opacity-...` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-${tipo==='antes'?'clock':'circle-check'} fa-xl opacity-...`. |
| `911` | `<span>Foto ${tipo} no disponible</span>` | Instrucción de ejecución en el contexto del script: `<span>Foto ${tipo} no disponible</span>`. |
| `912` | `</div>`;` | Instrucción de ejecución en el contexto del script: `</div>`;`. |
| `913` | `return `<div class="foto-modal" onclick="verFoto('../../public/${foto.ru...` | Instrucción de retorno que finaliza la ejecución entregando el resultado: `return `<div class="foto-modal" onclick="verFoto('../../public/${foto.ru...`. |
| `914` | `<img src="../../public/${foto.ruta}" alt="${tipo}">` | Instrucción de ejecución en el contexto del script: `<img src="../../public/${foto.ruta}" alt="${tipo}">`. |
| `915` | `<span class="foto-label ${tipo==='antes'?'label-antes':'label-despues'}">` | Instrucción de ejecución en el contexto del script: `<span class="foto-label ${tipo==='antes'?'label-antes':'label-despues'}">`. |
| `916` | `<i class="fas fa-${tipo==='antes'?'clock':'circle-check'} me-1"></i>${ti...` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-${tipo==='antes'?'clock':'circle-check'} me-1"></i>${ti...`. |
| `917` | `</span>` | Instrucción de ejecución en el contexto del script: `</span>`. |
| `918` | `</div>`;` | Instrucción de ejecución en el contexto del script: `</div>`;`. |
| `919` | `};` | Instrucción de ejecución en el contexto del script: `};`. |
| `920` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `921` | `html += fotoHtml(par.antes,   'antes');` | Instrucción de ejecución en el contexto del script: `html += fotoHtml(par.antes,   'antes');`. |
| `922` | `html += fotoHtml(par.despues, 'despues');` | Instrucción de ejecución en el contexto del script: `html += fotoHtml(par.despues, 'despues');`. |
| `923` | `html += '</div>';` | Instrucción de ejecución en el contexto del script: `html += '</div>';`. |
| `924` | `if (data.observaciones) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (data.observaciones) {`. |
| `925` | `html += `<div class="px-4 pb-3 text-muted small">` | Instrucción de ejecución en el contexto del script: `html += `<div class="px-4 pb-3 text-muted small">`. |
| `926` | `<i class="fas fa-comment me-1"></i>${data.observaciones}` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-comment me-1"></i>${data.observaciones}`. |
| `927` | `</div>`;` | Instrucción de ejecución en el contexto del script: `</div>`;`. |
| `928` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `929` | `cuerpo.innerHTML = html;` | Instrucción de ejecución en el contexto del script: `cuerpo.innerHTML = html;`. |
| `930` | `})` | Instrucción de ejecución en el contexto del script: `})`. |
| `931` | `.catch(() => {` | Instrucción de ejecución en el contexto del script: `.catch(() => {`. |
| `932` | `cuerpo.innerHTML = estadoHtml +` | Instrucción de ejecución en el contexto del script: `cuerpo.innerHTML = estadoHtml +`. |
| `933` | `'<div class="text-center py-4 text-muted small">Error al cargar las foto...` | Instrucción de ejecución en el contexto del script: `'<div class="text-center py-4 text-muted small">Error al cargar las foto...`. |
| `934` | `});` | Instrucción de ejecución en el contexto del script: `});`. |
| `935` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `936` | `<?php endif; ?>` | Cierre de estructura condicional embebida en la plantilla HTML. |
| `937` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `938` | `// Lightbox foto individual` | Comentario explicativo en el código: `Lightbox foto individual`. |
| `939` | `function verFoto(url, titulo, subtitulo) {` | Función JavaScript para previsualizar la fotografía en alta resolución con SweetAlert2. |
| `940` | `Swal.fire({` | Despliega una alerta modal estética e interactiva con SweetAlert2. |
| `941` | `imageUrl:  url,` | Instrucción de ejecución en el contexto del script: `imageUrl:  url,`. |
| `942` | `imageAlt:  titulo,` | Instrucción de ejecución en el contexto del script: `imageAlt:  titulo,`. |
| `943` | `title:     titulo,` | Instrucción de ejecución en el contexto del script: `title:     titulo,`. |
| `944` | `text:      subtitulo,` | Instrucción de ejecución en el contexto del script: `text:      subtitulo,`. |
| `945` | `confirmButtonColor: '#39a900',` | Instrucción de ejecución en el contexto del script: `confirmButtonColor: '#39a900',`. |
| `946` | `width: 720,` | Instrucción de ejecución en el contexto del script: `width: 720,`. |
| `947` | `showCloseButton: true` | Instrucción de ejecución en el contexto del script: `showCloseButton: true`. |
| `948` | `});` | Instrucción de ejecución en el contexto del script: `});`. |
| `949` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `950` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `951` | `<?php if ($alert): ?>` | Instrucción de ejecución en el contexto del script: `<?php if ($alert): ?>`. |
| `952` | `document.addEventListener('DOMContentLoaded', function () {` | Registra un escucha de eventos del DOM para interactividad en tiempo real: `document.addEventListener('DOMContentLoaded', function () {`. |
| `953` | `Swal.fire({` | Despliega una alerta modal estética e interactiva con SweetAlert2. |
| `954` | `icon:  '<?= addslashes($alert['icon'])  ?>',` | Instrucción de ejecución en el contexto del script: `icon:  '<?= addslashes($alert['icon'])  ?>',`. |
| `955` | `title: '<?= addslashes($alert['title']) ?>',` | Instrucción de ejecución en el contexto del script: `title: '<?= addslashes($alert['title']) ?>',`. |
| `956` | `text:  '<?= addslashes($alert['text'])  ?>',` | Instrucción de ejecución en el contexto del script: `text:  '<?= addslashes($alert['text'])  ?>',`. |
| `957` | `confirmButtonColor: '#39a900'` | Instrucción de ejecución en el contexto del script: `confirmButtonColor: '#39a900'`. |
| `958` | `});` | Instrucción de ejecución en el contexto del script: `});`. |
| `959` | `});` | Instrucción de ejecución en el contexto del script: `});`. |
| `960` | `<?php endif; ?>` | Cierre de estructura condicional embebida en la plantilla HTML. |
| `961` | ``</script>`` | Cierre de bloque de script JavaScript. |
| `962` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `963` | `<?php require_once __DIR__ . '/../layouts/footer.php'; ?>` | Importación e inclusión obligatoria del archivo de dependencia requerido: `<?php require_once __DIR__ . '/../layouts/footer.php'; ?>`. |

---

## 3. Resumen y Flujo de Interacción

El archivo `admin_evidencias.php` cumple un rol indispensable en `views/dashboard/admin_evidencias.php`. 
Módulo administrativo con vista de calendario interactivo FullCalendar y galería para auditar las evidencias fotográficas de cada ficha. Garantiza la robustez, el orden y la estabilidad de la arquitectura del proyecto `systemLimpieza`.

---

Generado automáticamente para el repositorio [johanrepizo/LimpiezaDeModulos](https://github.com/johanrepizo/LimpiezaDeModulos).
