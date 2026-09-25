# Documentación Línea por Línea: `views/dashboard/admin_aprendices.php`

## 1. Ficha Técnica del Archivo

- **Archivo:** `admin_aprendices.php`
- **Ruta en el proyecto:** `views/dashboard/admin_aprendices.php`
- **Cantidad total de líneas:** `684`
- **Tipo de archivo:** `PHP`
- **Propósito general:** Interfaz del administrador para consultar, buscar y gestionar la información de aprendices vinculados a las fichas.

---

## 2. Explicación Detallada Línea por Línea

A continuación se presenta cada línea de código numerada de forma consecutiva, acompañada de su fragmento exacto y la explicación exhaustiva de su funcionamiento y responsabilidad en el sistema:

| Línea | Código Fuente | Explicación Detallada |
|---|---|---|
| `1` | ``<?php`` | Apertura obligatoria de la etiqueta PHP para ejecución del código del lado del servidor. |
| `2` | `$titulo = 'Aprendices';` | Instrucción de ejecución en el contexto del script: `$titulo = 'Aprendices';`. |
| `3` | `if (session_status() === PHP_SESSION_NONE) session_start();` | Inicia o reanuda la sesión PHP del usuario si no se encontraba activa previamente. |
| `4` | `if (!isset($_SESSION['usuario']) \|\| (int)$_SESSION['usuario']['rol'] !...` | Verifica autenticación y rol del usuario; redirige al login si no tiene permisos. |
| `5` | `header("Location: ../usuarios/login.php"); exit;` | Emite cabecera HTTP de redirección en el navegador y detiene la ejecución: `header("Location: ../usuarios/login.php"); exit;`. |
| `6` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `7` | `require_once __DIR__ . '/../../config/database.php';` | Importación e inclusión obligatoria del archivo de dependencia requerido: `require_once __DIR__ . '/../../config/database.php';`. |
| `8` | `require_once __DIR__ . '/../../models/Programa.php';` | Importación e inclusión obligatoria del archivo de dependencia requerido: `require_once __DIR__ . '/../../models/Programa.php';`. |
| `9` | `require_once __DIR__ . '/../../models/Ficha.php';` | Importación e inclusión obligatoria del archivo de dependencia requerido: `require_once __DIR__ . '/../../models/Ficha.php';`. |
| `10` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `11` | `$db        = (new Database())->conectar();` | Instrucción de ejecución en el contexto del script: `$db        = (new Database())->conectar();`. |
| `12` | `$alert     = $_SESSION['alert'] ?? null;` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección. |
| `13` | `unset($_SESSION['alert']);` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección. |
| `14` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `15` | `$vistaPrograma = (int)($_GET['programa'] ?? 0);` | Instrucción de ejecución en el contexto del script: `$vistaPrograma = (int)($_GET['programa'] ?? 0);`. |
| `16` | `$vistaFicha    = (int)($_GET['ficha']    ?? 0);` | Instrucción de ejecución en el contexto del script: `$vistaFicha    = (int)($_GET['ficha']    ?? 0);`. |
| `17` | `$busqueda      = trim($_GET['q']         ?? '');` | Instrucción de ejecución en el contexto del script: `$busqueda      = trim($_GET['q']         ?? '');`. |
| `18` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `19` | `$modelProg = new Programa($db);` | Instrucción de ejecución en el contexto del script: `$modelProg = new Programa($db);`. |
| `20` | `$modelFich = new Ficha($db);` | Instrucción de ejecución en el contexto del script: `$modelFich = new Ficha($db);`. |
| `21` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `22` | `// ── Nivel 0: todos los programas con stats ───────────────────────────...` | Comentario explicativo en el código: `── Nivel 0: todos los programas con stats ──────────────────────────────...`. |
| `23` | `$programas = $modelProg->obtenerTodos();` | Instrucción de ejecución en el contexto del script: `$programas = $modelProg->obtenerTodos();`. |
| `24` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `25` | `// Stats globales` | Comentario explicativo en el código: `Stats globales`. |
| `26` | `$stmtTotal = $db->query("SELECT COUNT(*) FROM aprendices WHERE activo = ...` | Instrucción de ejecución en el contexto del script: `$stmtTotal = $db->query("SELECT COUNT(*) FROM aprendices WHERE activo = ...`. |
| `27` | `$totalAprendices = (int)$stmtTotal->fetchColumn();` | Recupera el valor escalar de la primera columna del resultado de la consulta. |
| `28` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `29` | `// ── Nivel 1: fichas del programa ─────────────────────────────────────...` | Comentario explicativo en el código: `── Nivel 1: fichas del programa ────────────────────────────────────────...`. |
| `30` | `$programaAct   = null;` | Instrucción de ejecución en el contexto del script: `$programaAct   = null;`. |
| `31` | `$fichasDelProg = [];` | Instrucción de ejecución en el contexto del script: `$fichasDelProg = [];`. |
| `32` | `if ($vistaPrograma) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if ($vistaPrograma) {`. |
| `33` | `$programaAct = $modelProg->obtenerPorId($vistaPrograma);` | Instrucción de ejecución en el contexto del script: `$programaAct = $modelProg->obtenerPorId($vistaPrograma);`. |
| `34` | `$stmtF = $db->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmtF = $db->prepare(`. |
| `35` | `"SELECT f.*,` | Instrucción de ejecución en el contexto del script: `"SELECT f.*,`. |
| `36` | `ANY_VALUE(v.nombres)   AS vocero_nombres,` | Instrucción de ejecución en el contexto del script: `ANY_VALUE(v.nombres)   AS vocero_nombres,`. |
| `37` | `ANY_VALUE(v.apellidos) AS vocero_apellidos,` | Instrucción de ejecución en el contexto del script: `ANY_VALUE(v.apellidos) AS vocero_apellidos,`. |
| `38` | `COUNT(DISTINCT a.id_aprendiz) AS total_aprendices` | Instrucción de ejecución en el contexto del script: `COUNT(DISTINCT a.id_aprendiz) AS total_aprendices`. |
| `39` | `FROM fichas f` | Instrucción de ejecución en el contexto del script: `FROM fichas f`. |
| `40` | `LEFT JOIN voceros    v ON v.id_ficha  = f.id_ficha AND v.activo = 1` | Instrucción de ejecución en el contexto del script: `LEFT JOIN voceros    v ON v.id_ficha  = f.id_ficha AND v.activo = 1`. |
| `41` | `LEFT JOIN aprendices a ON a.id_ficha  = f.id_ficha AND a.activo = 1` | Instrucción de ejecución en el contexto del script: `LEFT JOIN aprendices a ON a.id_ficha  = f.id_ficha AND a.activo = 1`. |
| `42` | `WHERE f.id_programa = :prog AND f.activo = 1` | Instrucción de ejecución en el contexto del script: `WHERE f.id_programa = :prog AND f.activo = 1`. |
| `43` | `GROUP BY f.id_ficha` | Instrucción de ejecución en el contexto del script: `GROUP BY f.id_ficha`. |
| `44` | `ORDER BY f.numero_ficha"` | Instrucción de ejecución en el contexto del script: `ORDER BY f.numero_ficha"`. |
| `45` | ``);`` | Cierre de estructura de arreglo o invocación de función. |
| `46` | `$stmtF->execute([':prog' => $vistaPrograma]);` | Ejecuta la sentencia SQL preparada vinculando los parámetros correspondientes: `$stmtF->execute([':prog' => $vistaPrograma]);`. |
| `47` | `$fichasDelProg = $stmtF->fetchAll(PDO::FETCH_ASSOC);` | Obtiene todos los registros coincidentes de la consulta en un arreglo asociativo. |
| `48` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `49` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `50` | `// ── Nivel 2: aprendices de una ficha ─────────────────────────────────...` | Comentario explicativo en el código: `── Nivel 2: aprendices de una ficha ───────────────────────────────────────`. |
| `51` | `$fichaAct   = null;` | Instrucción de ejecución en el contexto del script: `$fichaAct   = null;`. |
| `52` | `$aprendices = [];` | Instrucción de ejecución en el contexto del script: `$aprendices = [];`. |
| `53` | `if ($vistaFicha) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if ($vistaFicha) {`. |
| `54` | `$fichaAct = $modelFich->obtenerPorId($vistaFicha);` | Instrucción de ejecución en el contexto del script: `$fichaAct = $modelFich->obtenerPorId($vistaFicha);`. |
| `55` | `if ($fichaAct) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if ($fichaAct) {`. |
| `56` | `$vistaPrograma = (int)$fichaAct['id_programa'];` | Instrucción de ejecución en el contexto del script: `$vistaPrograma = (int)$fichaAct['id_programa'];`. |
| `57` | `$programaAct   = $modelProg->obtenerPorId($vistaPrograma);` | Instrucción de ejecución en el contexto del script: `$programaAct   = $modelProg->obtenerPorId($vistaPrograma);`. |
| `58` | `// Volver a cargar fichas del programa para el breadcrumb` | Comentario explicativo en el código: `Volver a cargar fichas del programa para el breadcrumb`. |
| `59` | `$stmtF2 = $db->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmtF2 = $db->prepare(`. |
| `60` | `"SELECT f.*,` | Instrucción de ejecución en el contexto del script: `"SELECT f.*,`. |
| `61` | `ANY_VALUE(v.nombres)   AS vocero_nombres,` | Instrucción de ejecución en el contexto del script: `ANY_VALUE(v.nombres)   AS vocero_nombres,`. |
| `62` | `COUNT(DISTINCT a.id_aprendiz) AS total_aprendices` | Instrucción de ejecución en el contexto del script: `COUNT(DISTINCT a.id_aprendiz) AS total_aprendices`. |
| `63` | `FROM fichas f` | Instrucción de ejecución en el contexto del script: `FROM fichas f`. |
| `64` | `LEFT JOIN voceros    v ON v.id_ficha = f.id_ficha AND v.activo = 1` | Instrucción de ejecución en el contexto del script: `LEFT JOIN voceros    v ON v.id_ficha = f.id_ficha AND v.activo = 1`. |
| `65` | `LEFT JOIN aprendices a ON a.id_ficha = f.id_ficha AND a.activo = 1` | Instrucción de ejecución en el contexto del script: `LEFT JOIN aprendices a ON a.id_ficha = f.id_ficha AND a.activo = 1`. |
| `66` | `WHERE f.id_programa = :prog AND f.activo = 1` | Instrucción de ejecución en el contexto del script: `WHERE f.id_programa = :prog AND f.activo = 1`. |
| `67` | `GROUP BY f.id_ficha ORDER BY f.numero_ficha"` | Instrucción de ejecución en el contexto del script: `GROUP BY f.id_ficha ORDER BY f.numero_ficha"`. |
| `68` | ``);`` | Cierre de estructura de arreglo o invocación de función. |
| `69` | `$stmtF2->execute([':prog' => $vistaPrograma]);` | Ejecuta la sentencia SQL preparada vinculando los parámetros correspondientes: `$stmtF2->execute([':prog' => $vistaPrograma]);`. |
| `70` | `$fichasDelProg = $stmtF2->fetchAll(PDO::FETCH_ASSOC);` | Obtiene todos los registros coincidentes de la consulta en un arreglo asociativo. |
| `71` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `72` | `// Primero traer los voceros activos e inactivos de esta ficha indexados...` | Comentario explicativo en el código: `Primero traer los voceros activos e inactivos de esta ficha indexados po...`. |
| `73` | `$stmtVoc = $db->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmtVoc = $db->prepare(`. |
| `74` | `"SELECT v.id_vocero, v.id_aprendiz, v.activo AS vocero_activo,` | Instrucción de ejecución en el contexto del script: `"SELECT v.id_vocero, v.id_aprendiz, v.activo AS vocero_activo,`. |
| `75` | `u.primer_acceso, u.activo AS usuario_activo` | Instrucción de ejecución en el contexto del script: `u.primer_acceso, u.activo AS usuario_activo`. |
| `76` | `FROM voceros v` | Instrucción de ejecución en el contexto del script: `FROM voceros v`. |
| `77` | `JOIN usuarios u ON u.id_usuario = v.id_usuario` | Instrucción de ejecución en el contexto del script: `JOIN usuarios u ON u.id_usuario = v.id_usuario`. |
| `78` | `WHERE v.id_ficha = :fic AND v.id_aprendiz IS NOT NULL` | Instrucción de ejecución en el contexto del script: `WHERE v.id_ficha = :fic AND v.id_aprendiz IS NOT NULL`. |
| `79` | `ORDER BY v.activo DESC, v.id_vocero DESC"` | Instrucción de ejecución en el contexto del script: `ORDER BY v.activo DESC, v.id_vocero DESC"`. |
| `80` | ``);`` | Cierre de estructura de arreglo o invocación de función. |
| `81` | `$stmtVoc->execute([':fic' => $vistaFicha]);` | Ejecuta la sentencia SQL preparada vinculando los parámetros correspondientes: `$stmtVoc->execute([':fic' => $vistaFicha]);`. |
| `82` | `// Un mapa id_aprendiz → vocero (activo tiene prioridad)` | Comentario explicativo en el código: `Un mapa id_aprendiz → vocero (activo tiene prioridad)`. |
| `83` | `$vocPorAprendiz = [];` | Instrucción de ejecución en el contexto del script: `$vocPorAprendiz = [];`. |
| `84` | `foreach ($stmtVoc->fetchAll(PDO::FETCH_ASSOC) as $voc) {` | Estructura de control iterativa para recorrer colecciones o arreglos: `foreach ($stmtVoc->fetchAll(PDO::FETCH_ASSOC) as $voc) {`. |
| `85` | `$idAp = (int)$voc['id_aprendiz'];` | Instrucción de ejecución en el contexto del script: `$idAp = (int)$voc['id_aprendiz'];`. |
| `86` | `if (!isset($vocPorAprendiz[$idAp])) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (!isset($vocPorAprendiz[$idAp])) {`. |
| `87` | `$vocPorAprendiz[$idAp] = $voc;` | Instrucción de ejecución en el contexto del script: `$vocPorAprendiz[$idAp] = $voc;`. |
| `88` | `} elseif ((int)$voc['vocero_activo'] === 1 && (int)$vocPorAprendiz[$idAp...` | Evaluación condicional alternativa `elseif`: `} elseif ((int)$voc['vocero_activo'] === 1 && (int)$vocPorAprendiz[$idAp...`. |
| `89` | `$vocPorAprendiz[$idAp] = $voc;` | Instrucción de ejecución en el contexto del script: `$vocPorAprendiz[$idAp] = $voc;`. |
| `90` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `91` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `92` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `93` | `// Traer aprendices con query limpia (sin JOIN a voceros)` | Comentario explicativo en el código: `Traer aprendices con query limpia (sin JOIN a voceros)`. |
| `94` | `$sqlAp = "SELECT a.id_aprendiz, a.nombres, a.apellidos, a.documento,` | Instrucción de ejecución en el contexto del script: `$sqlAp = "SELECT a.id_aprendiz, a.nombres, a.apellidos, a.documento,`. |
| `95` | `a.celular, a.correo` | Instrucción de ejecución en el contexto del script: `a.celular, a.correo`. |
| `96` | `FROM aprendices a` | Instrucción de ejecución en el contexto del script: `FROM aprendices a`. |
| `97` | `WHERE a.id_ficha = :fic AND a.activo = 1";` | Instrucción de ejecución en el contexto del script: `WHERE a.id_ficha = :fic AND a.activo = 1";`. |
| `98` | `if ($busqueda) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if ($busqueda) {`. |
| `99` | `$sqlAp .= " AND (a.nombres LIKE :q OR a.apellidos LIKE :q2 OR a.document...` | Instrucción de ejecución en el contexto del script: `$sqlAp .= " AND (a.nombres LIKE :q OR a.apellidos LIKE :q2 OR a.document...`. |
| `100` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `101` | `$sqlAp .= " ORDER BY a.apellidos, a.nombres";` | Instrucción de ejecución en el contexto del script: `$sqlAp .= " ORDER BY a.apellidos, a.nombres";`. |
| `102` | `$stmtAp = $db->prepare($sqlAp);` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmtAp = $db->prepare($sqlAp);`. |
| `103` | `$paramsAp = [':fic' => $vistaFicha];` | Instrucción de ejecución en el contexto del script: `$paramsAp = [':fic' => $vistaFicha];`. |
| `104` | `if ($busqueda) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if ($busqueda) {`. |
| `105` | `$like = '%' . $busqueda . '%';` | Instrucción de ejecución en el contexto del script: `$like = '%' . $busqueda . '%';`. |
| `106` | `$paramsAp[':q'] = $like; $paramsAp[':q2'] = $like; $paramsAp[':q3'] = $l...` | Instrucción de ejecución en el contexto del script: `$paramsAp[':q'] = $like; $paramsAp[':q2'] = $like; $paramsAp[':q3'] = $l...`. |
| `107` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `108` | `$stmtAp->execute($paramsAp);` | Ejecuta la sentencia SQL preparada vinculando los parámetros correspondientes: `$stmtAp->execute($paramsAp);`. |
| `109` | `$aprendices = $stmtAp->fetchAll(PDO::FETCH_ASSOC);` | Obtiene todos los registros coincidentes de la consulta en un arreglo asociativo. |
| `110` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `111` | `// Cruzar cada aprendiz con su vocero exacto por id_aprendiz (1:1 garant...` | Comentario explicativo en el código: `Cruzar cada aprendiz con su vocero exacto por id_aprendiz (1:1 garantizado)`. |
| `112` | `foreach ($aprendices as &$ap) {` | Estructura de control iterativa para recorrer colecciones o arreglos: `foreach ($aprendices as &$ap) {`. |
| `113` | `$idAp = (int)$ap['id_aprendiz'];` | Instrucción de ejecución en el contexto del script: `$idAp = (int)$ap['id_aprendiz'];`. |
| `114` | `if (isset($vocPorAprendiz[$idAp])) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (isset($vocPorAprendiz[$idAp])) {`. |
| `115` | `$ap['id_vocero']      = $vocPorAprendiz[$idAp]['id_vocero'];` | Instrucción de ejecución en el contexto del script: `$ap['id_vocero']      = $vocPorAprendiz[$idAp]['id_vocero'];`. |
| `116` | `$ap['vocero_activo']  = $vocPorAprendiz[$idAp]['vocero_activo'];` | Instrucción de ejecución en el contexto del script: `$ap['vocero_activo']  = $vocPorAprendiz[$idAp]['vocero_activo'];`. |
| `117` | `$ap['primer_acceso']  = $vocPorAprendiz[$idAp]['primer_acceso'];` | Instrucción de ejecución en el contexto del script: `$ap['primer_acceso']  = $vocPorAprendiz[$idAp]['primer_acceso'];`. |
| `118` | `$ap['usuario_activo'] = $vocPorAprendiz[$idAp]['usuario_activo'];` | Instrucción de ejecución en el contexto del script: `$ap['usuario_activo'] = $vocPorAprendiz[$idAp]['usuario_activo'];`. |
| `119` | `} else {` | Instrucción de ejecución en el contexto del script: `} else {`. |
| `120` | `$ap['id_vocero']      = null;` | Instrucción de ejecución en el contexto del script: `$ap['id_vocero']      = null;`. |
| `121` | `$ap['vocero_activo']  = null;` | Instrucción de ejecución en el contexto del script: `$ap['vocero_activo']  = null;`. |
| `122` | `$ap['primer_acceso']  = null;` | Instrucción de ejecución en el contexto del script: `$ap['primer_acceso']  = null;`. |
| `123` | `$ap['usuario_activo'] = null;` | Instrucción de ejecución en el contexto del script: `$ap['usuario_activo'] = null;`. |
| `124` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `125` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `126` | `unset($ap);` | Instrucción de ejecución en el contexto del script: `unset($ap);`. |
| `127` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `128` | `// ¿Cuántos voceros activos tiene esta ficha? (máximo 2)` | Comentario explicativo en el código: `¿Cuántos voceros activos tiene esta ficha? (máximo 2)`. |
| `129` | `$stmtVAct = $db->prepare("SELECT COUNT(*) FROM voceros WHERE id_ficha = ...` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmtVAct = $db->prepare("SELECT COUNT(*) FROM voceros WHERE id_ficha = ...`. |
| `130` | `$stmtVAct->execute([':fic' => $vistaFicha]);` | Ejecuta la sentencia SQL preparada vinculando los parámetros correspondientes: `$stmtVAct->execute([':fic' => $vistaFicha]);`. |
| `131` | `$totalVocerosActivos = (int)$stmtVAct->fetchColumn();` | Recupera el valor escalar de la primera columna del resultado de la consulta. |
| `132` | `$hayVoceroActivo = $totalVocerosActivos >= 2; // bloquear si ya hay 2` | Instrucción de ejecución en el contexto del script: `$hayVoceroActivo = $totalVocerosActivos >= 2; // bloquear si ya hay 2`. |
| `133` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `134` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `135` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `136` | `require_once __DIR__ . '/../layouts/header.php';` | Importación e inclusión obligatoria del archivo de dependencia requerido: `require_once __DIR__ . '/../layouts/header.php';`. |
| `137` | ``?>`` | Cierre de la etiqueta PHP para alternar a salida HTML o fin del archivo. |
| `138` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `139` | `<!-- ══ BREADCRUMB + CABECERA ══════════════════════════════════════════...` | Instrucción de ejecución en el contexto del script: `<!-- ══ BREADCRUMB + CABECERA ══════════════════════════════════════════...`. |
| `140` | `<div class="d-flex justify-content-between align-items-start mb-4 flex-w...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="d-flex justify-content-between align-items-start mb-4 flex-w...`. |
| `141` | `<div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div>`. |
| `142` | `<nav aria-label="breadcrumb" class="mb-1">` | Instrucción de ejecución en el contexto del script: `<nav aria-label="breadcrumb" class="mb-1">`. |
| `143` | `<ol class="breadcrumb mb-0" style="font-size:.82rem;">` | Instrucción de ejecución en el contexto del script: `<ol class="breadcrumb mb-0" style="font-size:.82rem;">`. |
| `144` | `<li class="breadcrumb-item">` | Instrucción de ejecución en el contexto del script: `<li class="breadcrumb-item">`. |
| `145` | `<a href="admin_aprendices.php" class="text-success text-decoration-none ...` | Instrucción de ejecución en el contexto del script: `<a href="admin_aprendices.php" class="text-success text-decoration-none ...`. |
| `146` | `<i class="fas fa-users me-1"></i>Aprendices` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-users me-1"></i>Aprendices`. |
| `147` | `</a>` | Instrucción de ejecución en el contexto del script: `</a>`. |
| `148` | `</li>` | Instrucción de ejecución en el contexto del script: `</li>`. |
| `149` | `<?php if ($programaAct): ?>` | Instrucción de ejecución en el contexto del script: `<?php if ($programaAct): ?>`. |
| `150` | `<li class="breadcrumb-item">` | Instrucción de ejecución en el contexto del script: `<li class="breadcrumb-item">`. |
| `151` | `<?php if ($fichaAct): ?>` | Instrucción de ejecución en el contexto del script: `<?php if ($fichaAct): ?>`. |
| `152` | `<a href="admin_aprendices.php?programa=<?= $vistaPrograma ?>"` | Instrucción de ejecución en el contexto del script: `<a href="admin_aprendices.php?programa=<?= $vistaPrograma ?>"`. |
| `153` | `class="text-success text-decoration-none">` | Instrucción de ejecución en el contexto del script: `class="text-success text-decoration-none">`. |
| `154` | `<?= htmlspecialchars($programaAct['nombre']) ?>` | Instrucción de ejecución en el contexto del script: `<?= htmlspecialchars($programaAct['nombre']) ?>`. |
| `155` | `</a>` | Instrucción de ejecución en el contexto del script: `</a>`. |
| `156` | `<?php else: ?>` | Instrucción de ejecución en el contexto del script: `<?php else: ?>`. |
| `157` | `<span class="text-dark fw-semibold"><?= htmlspecialchars($programaAct['n...` | Instrucción de ejecución en el contexto del script: `<span class="text-dark fw-semibold"><?= htmlspecialchars($programaAct['n...`. |
| `158` | `<?php endif; ?>` | Cierre de estructura condicional embebida en la plantilla HTML. |
| `159` | `</li>` | Instrucción de ejecución en el contexto del script: `</li>`. |
| `160` | `<?php endif; ?>` | Cierre de estructura condicional embebida en la plantilla HTML. |
| `161` | `<?php if ($fichaAct): ?>` | Instrucción de ejecución en el contexto del script: `<?php if ($fichaAct): ?>`. |
| `162` | `<li class="breadcrumb-item active">` | Instrucción de ejecución en el contexto del script: `<li class="breadcrumb-item active">`. |
| `163` | `Ficha <strong class="font-monospace"><?= htmlspecialchars($fichaAct['num...` | Instrucción de ejecución en el contexto del script: `Ficha <strong class="font-monospace"><?= htmlspecialchars($fichaAct['num...`. |
| `164` | `</li>` | Instrucción de ejecución en el contexto del script: `</li>`. |
| `165` | `<?php endif; ?>` | Cierre de estructura condicional embebida en la plantilla HTML. |
| `166` | `</ol>` | Instrucción de ejecución en el contexto del script: `</ol>`. |
| `167` | `</nav>` | Instrucción de ejecución en el contexto del script: `</nav>`. |
| `168` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `169` | `<h4 class="fw-bold mb-0">` | Instrucción de ejecución en el contexto del script: `<h4 class="fw-bold mb-0">`. |
| `170` | `<?php if ($fichaAct): ?>` | Instrucción de ejecución en el contexto del script: `<?php if ($fichaAct): ?>`. |
| `171` | `<i class="fas fa-users text-success me-2"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-users text-success me-2"></i>`. |
| `172` | `Aprendices — Ficha <span class="font-monospace"><?= htmlspecialchars($fi...` | Instrucción de ejecución en el contexto del script: `Aprendices — Ficha <span class="font-monospace"><?= htmlspecialchars($fi...`. |
| `173` | `<?php elseif ($programaAct): ?>` | Instrucción de ejecución en el contexto del script: `<?php elseif ($programaAct): ?>`. |
| `174` | `<i class="fas fa-id-card text-success me-2"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-id-card text-success me-2"></i>`. |
| `175` | `Fichas — <?= htmlspecialchars($programaAct['nombre']) ?>` | Instrucción de ejecución en el contexto del script: `Fichas — <?= htmlspecialchars($programaAct['nombre']) ?>`. |
| `176` | `<?php else: ?>` | Instrucción de ejecución en el contexto del script: `<?php else: ?>`. |
| `177` | `<i class="fas fa-users text-success me-2"></i>Aprendices` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-users text-success me-2"></i>Aprendices`. |
| `178` | `<?php endif; ?>` | Cierre de estructura condicional embebida en la plantilla HTML. |
| `179` | `</h4>` | Instrucción de ejecución en el contexto del script: `</h4>`. |
| `180` | `<p class="text-muted small mb-0">` | Instrucción de ejecución en el contexto del script: `<p class="text-muted small mb-0">`. |
| `181` | `<?php if ($fichaAct): ?>` | Instrucción de ejecución en el contexto del script: `<?php if ($fichaAct): ?>`. |
| `182` | `<?= count($aprendices) ?> aprendice(s) en esta ficha` | Instrucción de ejecución en el contexto del script: `<?= count($aprendices) ?> aprendice(s) en esta ficha`. |
| `183` | `<?php elseif ($programaAct): ?>` | Instrucción de ejecución en el contexto del script: `<?php elseif ($programaAct): ?>`. |
| `184` | `Selecciona una ficha para ver sus aprendices` | Instrucción de ejecución en el contexto del script: `Selecciona una ficha para ver sus aprendices`. |
| `185` | `<?php else: ?>` | Instrucción de ejecución en el contexto del script: `<?php else: ?>`. |
| `186` | `Selecciona un programa de formación` | Instrucción de ejecución en el contexto del script: `Selecciona un programa de formación`. |
| `187` | `<?php endif; ?>` | Cierre de estructura condicional embebida en la plantilla HTML. |
| `188` | `</p>` | Instrucción de ejecución en el contexto del script: `</p>`. |
| `189` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `190` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `191` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `192` | `<!-- ══ NIVEL 0: GRID DE PROGRAMAS ═════════════════════════════════════...` | Instrucción de ejecución en el contexto del script: `<!-- ══ NIVEL 0: GRID DE PROGRAMAS ═════════════════════════════════════...`. |
| `193` | `<?php if (!$vistaPrograma && !$vistaFicha): ?>` | Instrucción de ejecución en el contexto del script: `<?php if (!$vistaPrograma && !$vistaFicha): ?>`. |
| `194` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `195` | `<div class="row g-3 mb-4">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="row g-3 mb-4">`. |
| `196` | `<div class="col-sm-4">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="col-sm-4">`. |
| `197` | `<div class="stat-card bg-white">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="stat-card bg-white">`. |
| `198` | `<div class="d-flex align-items-center gap-3">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="d-flex align-items-center gap-3">`. |
| `199` | `<div class="stat-icon" style="background:rgba(57,169,0,.12);color:#39a90...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="stat-icon" style="background:rgba(57,169,0,.12);color:#39a90...`. |
| `200` | `<i class="fas fa-graduation-cap"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-graduation-cap"></i>`. |
| `201` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `202` | `<div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div>`. |
| `203` | `<div class="fs-4 fw-bold"><?= count($programas) ?></div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="fs-4 fw-bold"><?= count($programas) ?></div>`. |
| `204` | `<div class="text-muted small">Programas</div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="text-muted small">Programas</div>`. |
| `205` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `206` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `207` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `208` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `209` | `<div class="col-sm-4">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="col-sm-4">`. |
| `210` | `<div class="stat-card bg-white">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="stat-card bg-white">`. |
| `211` | `<div class="d-flex align-items-center gap-3">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="d-flex align-items-center gap-3">`. |
| `212` | `<div class="stat-icon" style="background:rgba(37,99,235,.1);color:#2563e...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="stat-icon" style="background:rgba(37,99,235,.1);color:#2563e...`. |
| `213` | `<i class="fas fa-id-card"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-id-card"></i>`. |
| `214` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `215` | `<div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div>`. |
| `216` | `<div class="fs-4 fw-bold"><?= array_sum(array_column($programas, 'total_...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="fs-4 fw-bold"><?= array_sum(array_column($programas, 'total_...`. |
| `217` | `<div class="text-muted small">Fichas activas</div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="text-muted small">Fichas activas</div>`. |
| `218` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `219` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `220` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `221` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `222` | `<div class="col-sm-4">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="col-sm-4">`. |
| `223` | `<div class="stat-card bg-white">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="stat-card bg-white">`. |
| `224` | `<div class="d-flex align-items-center gap-3">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="d-flex align-items-center gap-3">`. |
| `225` | `<div class="stat-icon" style="background:rgba(234,179,8,.1);color:#d9770...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="stat-icon" style="background:rgba(234,179,8,.1);color:#d9770...`. |
| `226` | `<i class="fas fa-users"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-users"></i>`. |
| `227` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `228` | `<div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div>`. |
| `229` | `<div class="fs-4 fw-bold"><?= $totalAprendices ?></div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="fs-4 fw-bold"><?= $totalAprendices ?></div>`. |
| `230` | `<div class="text-muted small">Total aprendices</div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="text-muted small">Total aprendices</div>`. |
| `231` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `232` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `233` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `234` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `235` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `236` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `237` | `<div class="mb-3">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="mb-3">`. |
| `238` | `<div class="input-group input-group-sm" style="max-width:320px;">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="input-group input-group-sm" style="max-width:320px;">`. |
| `239` | `<span class="input-group-text bg-white"><i class="fas fa-search text-mut...` | Instrucción de ejecución en el contexto del script: `<span class="input-group-text bg-white"><i class="fas fa-search text-mut...`. |
| `240` | `<input type="text" id="buscPrograma" class="form-control border-start-0"...` | Campo de entrada interactivo para datos del usuario: `<input type="text" id="buscPrograma" class="form-control border-start-0"...`. |
| `241` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `242` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `243` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `244` | `<div class="row g-3" id="gridProgramas">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="row g-3" id="gridProgramas">`. |
| `245` | `<?php foreach ($programas as $p): ?>` | Instrucción de ejecución en el contexto del script: `<?php foreach ($programas as $p): ?>`. |
| `246` | `<div class="col-md-6 col-lg-4 prog-item">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="col-md-6 col-lg-4 prog-item">`. |
| `247` | `<a href="admin_aprendices.php?programa=<?= $p['id_programa'] ?>"` | Instrucción de ejecución en el contexto del script: `<a href="admin_aprendices.php?programa=<?= $p['id_programa'] ?>"`. |
| `248` | `class="text-decoration-none">` | Instrucción de ejecución en el contexto del script: `class="text-decoration-none">`. |
| `249` | `<div class="card border-0 shadow-sm h-100 prog-card" style="border-radiu...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="card border-0 shadow-sm h-100 prog-card" style="border-radiu...`. |
| `250` | `<div class="card-body p-4">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="card-body p-4">`. |
| `251` | `<div class="d-flex align-items-start justify-content-between mb-3">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="d-flex align-items-start justify-content-between mb-3">`. |
| `252` | `<div style="width:44px;height:44px;border-radius:10px;` | Contenedor visual estructurado con Bootstrap/CSS: `<div style="width:44px;height:44px;border-radius:10px;`. |
| `253` | `background:rgba(57,169,0,.12);color:#39a900;` | Instrucción de ejecución en el contexto del script: `background:rgba(57,169,0,.12);color:#39a900;`. |
| `254` | `display:flex;align-items:center;justify-content:center;font-size:1.2rem;">` | Instrucción de ejecución en el contexto del script: `display:flex;align-items:center;justify-content:center;font-size:1.2rem;">`. |
| `255` | `<i class="fas fa-graduation-cap"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-graduation-cap"></i>`. |
| `256` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `257` | `<span class="badge bg-light text-dark border" style="font-size:.72rem;">` | Instrucción de ejecución en el contexto del script: `<span class="badge bg-light text-dark border" style="font-size:.72rem;">`. |
| `258` | `<?= htmlspecialchars($p['nivel'] ?? 'Sin nivel') ?>` | Instrucción de ejecución en el contexto del script: `<?= htmlspecialchars($p['nivel'] ?? 'Sin nivel') ?>`. |
| `259` | `</span>` | Instrucción de ejecución en el contexto del script: `</span>`. |
| `260` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `261` | `<h6 class="fw-bold mb-3 text-dark" style="font-size:.88rem;line-height:1...` | Instrucción de ejecución en el contexto del script: `<h6 class="fw-bold mb-3 text-dark" style="font-size:.88rem;line-height:1...`. |
| `262` | `<?= htmlspecialchars($p['nombre']) ?>` | Instrucción de ejecución en el contexto del script: `<?= htmlspecialchars($p['nombre']) ?>`. |
| `263` | `</h6>` | Instrucción de ejecución en el contexto del script: `</h6>`. |
| `264` | `<div class="d-flex gap-3 pt-3" style="border-top:1px solid #e5e7eb;">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="d-flex gap-3 pt-3" style="border-top:1px solid #e5e7eb;">`. |
| `265` | `<div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div>`. |
| `266` | `<div class="fw-bold text-success fs-5"><?= (int)$p['total_fichas'] ?></div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="fw-bold text-success fs-5"><?= (int)$p['total_fichas'] ?></div>`. |
| `267` | `<div class="text-muted" style="font-size:.72rem;">Fichas</div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="text-muted" style="font-size:.72rem;">Fichas</div>`. |
| `268` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `269` | `<div class="ms-auto d-flex align-items-center text-success" style="font-...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="ms-auto d-flex align-items-center text-success" style="font-...`. |
| `270` | `Ver fichas <i class="fas fa-arrow-right ms-1"></i>` | Instrucción de ejecución en el contexto del script: `Ver fichas <i class="fas fa-arrow-right ms-1"></i>`. |
| `271` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `272` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `273` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `274` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `275` | `</a>` | Instrucción de ejecución en el contexto del script: `</a>`. |
| `276` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `277` | `<?php endforeach; ?>` | Cierre de ciclo iterativo foreach embebido en la plantilla HTML. |
| `278` | `<?php if (empty($programas)): ?>` | Instrucción de ejecución en el contexto del script: `<?php if (empty($programas)): ?>`. |
| `279` | `<div class="col-12">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="col-12">`. |
| `280` | `<div class="card border-0 shadow-sm text-center py-5 text-muted">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="card border-0 shadow-sm text-center py-5 text-muted">`. |
| `281` | `<i class="fas fa-graduation-cap fa-3x mb-3 opacity-25 d-block"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-graduation-cap fa-3x mb-3 opacity-25 d-block"></i>`. |
| `282` | `No hay programas registrados.` | Instrucción de ejecución en el contexto del script: `No hay programas registrados.`. |
| `283` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `284` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `285` | `<?php endif; ?>` | Cierre de estructura condicional embebida en la plantilla HTML. |
| `286` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `287` | `<?php endif; ?>` | Cierre de estructura condicional embebida en la plantilla HTML. |
| `288` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `289` | `<!-- ══ NIVEL 1: FICHAS DEL PROGRAMA ═══════════════════════════════════...` | Instrucción de ejecución en el contexto del script: `<!-- ══ NIVEL 1: FICHAS DEL PROGRAMA ═══════════════════════════════════...`. |
| `290` | `<?php if ($vistaPrograma && !$vistaFicha): ?>` | Instrucción de ejecución en el contexto del script: `<?php if ($vistaPrograma && !$vistaFicha): ?>`. |
| `291` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `292` | `<?php $totalApProg = array_sum(array_column($fichasDelProg, 'total_apren...` | Instrucción de ejecución en el contexto del script: `<?php $totalApProg = array_sum(array_column($fichasDelProg, 'total_apren...`. |
| `293` | `<div class="row g-3 mb-4">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="row g-3 mb-4">`. |
| `294` | `<div class="col-sm-4">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="col-sm-4">`. |
| `295` | `<div class="stat-card bg-white">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="stat-card bg-white">`. |
| `296` | `<div class="d-flex align-items-center gap-3">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="d-flex align-items-center gap-3">`. |
| `297` | `<div class="stat-icon" style="background:rgba(37,99,235,.1);color:#2563e...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="stat-icon" style="background:rgba(37,99,235,.1);color:#2563e...`. |
| `298` | `<i class="fas fa-id-card"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-id-card"></i>`. |
| `299` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `300` | `<div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div>`. |
| `301` | `<div class="fs-4 fw-bold"><?= count($fichasDelProg) ?></div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="fs-4 fw-bold"><?= count($fichasDelProg) ?></div>`. |
| `302` | `<div class="text-muted small">Fichas en el programa</div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="text-muted small">Fichas en el programa</div>`. |
| `303` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `304` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `305` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `306` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `307` | `<div class="col-sm-4">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="col-sm-4">`. |
| `308` | `<div class="stat-card bg-white">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="stat-card bg-white">`. |
| `309` | `<div class="d-flex align-items-center gap-3">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="d-flex align-items-center gap-3">`. |
| `310` | `<div class="stat-icon" style="background:rgba(57,169,0,.12);color:#39a90...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="stat-icon" style="background:rgba(57,169,0,.12);color:#39a90...`. |
| `311` | `<i class="fas fa-users"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-users"></i>`. |
| `312` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `313` | `<div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div>`. |
| `314` | `<div class="fs-4 fw-bold"><?= $totalApProg ?></div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="fs-4 fw-bold"><?= $totalApProg ?></div>`. |
| `315` | `<div class="text-muted small">Aprendices en el programa</div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="text-muted small">Aprendices en el programa</div>`. |
| `316` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `317` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `318` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `319` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `320` | `<div class="col-sm-4">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="col-sm-4">`. |
| `321` | `<div class="stat-card bg-white">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="stat-card bg-white">`. |
| `322` | `<div class="d-flex align-items-center gap-3">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="d-flex align-items-center gap-3">`. |
| `323` | `<div class="stat-icon" style="background:rgba(234,179,8,.1);color:#d9770...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="stat-icon" style="background:rgba(234,179,8,.1);color:#d9770...`. |
| `324` | `<i class="fas fa-user-tie"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-user-tie"></i>`. |
| `325` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `326` | `<div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div>`. |
| `327` | `<div class="fs-4 fw-bold">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="fs-4 fw-bold">`. |
| `328` | `<?= count(array_filter($fichasDelProg, fn($f) => !empty($f['vocero_nombr...` | Instrucción de ejecución en el contexto del script: `<?= count(array_filter($fichasDelProg, fn($f) => !empty($f['vocero_nombr...`. |
| `329` | `/<?= count($fichasDelProg) ?>` | Instrucción de ejecución en el contexto del script: `/<?= count($fichasDelProg) ?>`. |
| `330` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `331` | `<div class="text-muted small">Con vocero asignado</div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="text-muted small">Con vocero asignado</div>`. |
| `332` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `333` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `334` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `335` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `336` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `337` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `338` | `<div class="row g-3">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="row g-3">`. |
| `339` | `<?php foreach ($fichasDelProg as $f): ?>` | Instrucción de ejecución en el contexto del script: `<?php foreach ($fichasDelProg as $f): ?>`. |
| `340` | `<div class="col-md-6 col-lg-4">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="col-md-6 col-lg-4">`. |
| `341` | `<a href="admin_aprendices.php?ficha=<?= $f['id_ficha'] ?>" class="text-d...` | Instrucción de ejecución en el contexto del script: `<a href="admin_aprendices.php?ficha=<?= $f['id_ficha'] ?>" class="text-d...`. |
| `342` | `<div class="card border-0 shadow-sm h-100 prog-card" style="border-radiu...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="card border-0 shadow-sm h-100 prog-card" style="border-radiu...`. |
| `343` | `<div class="card-body p-4">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="card-body p-4">`. |
| `344` | `<div class="d-flex align-items-start justify-content-between mb-3">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="d-flex align-items-start justify-content-between mb-3">`. |
| `345` | `<div style="width:44px;height:44px;border-radius:10px;` | Contenedor visual estructurado con Bootstrap/CSS: `<div style="width:44px;height:44px;border-radius:10px;`. |
| `346` | `background:rgba(37,99,235,.1);color:#2563eb;` | Instrucción de ejecución en el contexto del script: `background:rgba(37,99,235,.1);color:#2563eb;`. |
| `347` | `display:flex;align-items:center;justify-content:center;font-size:1.1rem;">` | Instrucción de ejecución en el contexto del script: `display:flex;align-items:center;justify-content:center;font-size:1.1rem;">`. |
| `348` | `<i class="fas fa-id-card"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-id-card"></i>`. |
| `349` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `350` | `<span class="badge bg-light text-dark border">` | Instrucción de ejecución en el contexto del script: `<span class="badge bg-light text-dark border">`. |
| `351` | `<?= htmlspecialchars($f['jornada']) ?>` | Instrucción de ejecución en el contexto del script: `<?= htmlspecialchars($f['jornada']) ?>`. |
| `352` | `</span>` | Instrucción de ejecución en el contexto del script: `</span>`. |
| `353` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `354` | `<div class="fw-bold text-success font-monospace mb-1" style="font-size:1...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="fw-bold text-success font-monospace mb-1" style="font-size:1...`. |
| `355` | `<?= htmlspecialchars($f['numero_ficha']) ?>` | Instrucción de ejecución en el contexto del script: `<?= htmlspecialchars($f['numero_ficha']) ?>`. |
| `356` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `357` | `<div class="text-muted small mb-3">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="text-muted small mb-3">`. |
| `358` | `<?php if ($f['vocero_nombres']): ?>` | Instrucción de ejecución en el contexto del script: `<?php if ($f['vocero_nombres']): ?>`. |
| `359` | `<i class="fas fa-user-tie me-1" style="font-size:.75rem;"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-user-tie me-1" style="font-size:.75rem;"></i>`. |
| `360` | `<?= htmlspecialchars($f['vocero_nombres']) ?>` | Instrucción de ejecución en el contexto del script: `<?= htmlspecialchars($f['vocero_nombres']) ?>`. |
| `361` | `<?php else: ?>` | Instrucción de ejecución en el contexto del script: `<?php else: ?>`. |
| `362` | `<span class="text-warning"><i class="fas fa-exclamation-circle me-1"></i...` | Instrucción de ejecución en el contexto del script: `<span class="text-warning"><i class="fas fa-exclamation-circle me-1"></i...`. |
| `363` | `<?php endif; ?>` | Cierre de estructura condicional embebida en la plantilla HTML. |
| `364` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `365` | `<div class="d-flex gap-3 pt-3" style="border-top:1px solid #e5e7eb;">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="d-flex gap-3 pt-3" style="border-top:1px solid #e5e7eb;">`. |
| `366` | `<div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div>`. |
| `367` | `<div class="fw-bold text-success fs-5"><?= (int)$f['total_aprendices'] ?...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="fw-bold text-success fs-5"><?= (int)$f['total_aprendices'] ?...`. |
| `368` | `<div class="text-muted" style="font-size:.72rem;">Aprendices</div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="text-muted" style="font-size:.72rem;">Aprendices</div>`. |
| `369` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `370` | `<div class="ms-auto d-flex align-items-center text-success" style="font-...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="ms-auto d-flex align-items-center text-success" style="font-...`. |
| `371` | `Ver lista <i class="fas fa-arrow-right ms-1"></i>` | Instrucción de ejecución en el contexto del script: `Ver lista <i class="fas fa-arrow-right ms-1"></i>`. |
| `372` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `373` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `374` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `375` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `376` | `</a>` | Instrucción de ejecución en el contexto del script: `</a>`. |
| `377` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `378` | `<?php endforeach; ?>` | Cierre de ciclo iterativo foreach embebido en la plantilla HTML. |
| `379` | `<?php if (empty($fichasDelProg)): ?>` | Instrucción de ejecución en el contexto del script: `<?php if (empty($fichasDelProg)): ?>`. |
| `380` | `<div class="col-12">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="col-12">`. |
| `381` | `<div class="card border-0 shadow-sm text-center py-5 text-muted">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="card border-0 shadow-sm text-center py-5 text-muted">`. |
| `382` | `<i class="fas fa-id-card fa-3x mb-3 opacity-25 d-block"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-id-card fa-3x mb-3 opacity-25 d-block"></i>`. |
| `383` | `No hay fichas registradas en este programa.` | Instrucción de ejecución en el contexto del script: `No hay fichas registradas en este programa.`. |
| `384` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `385` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `386` | `<?php endif; ?>` | Cierre de estructura condicional embebida en la plantilla HTML. |
| `387` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `388` | `<?php endif; ?>` | Cierre de estructura condicional embebida en la plantilla HTML. |
| `389` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `390` | `<!-- ══ NIVEL 2: APRENDICES DE LA FICHA ════════════════════════════════...` | Instrucción de ejecución en el contexto del script: `<!-- ══ NIVEL 2: APRENDICES DE LA FICHA ════════════════════════════════...`. |
| `391` | `<?php if ($vistaFicha && $fichaAct): ?>` | Instrucción de ejecución en el contexto del script: `<?php if ($vistaFicha && $fichaAct): ?>`. |
| `392` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `393` | `<div class="row g-3 mb-4">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="row g-3 mb-4">`. |
| `394` | `<div class="col-sm-4">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="col-sm-4">`. |
| `395` | `<div class="stat-card bg-white">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="stat-card bg-white">`. |
| `396` | `<div class="d-flex align-items-center gap-3">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="d-flex align-items-center gap-3">`. |
| `397` | `<div class="stat-icon" style="background:rgba(57,169,0,.12);color:#39a90...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="stat-icon" style="background:rgba(57,169,0,.12);color:#39a90...`. |
| `398` | `<i class="fas fa-users"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-users"></i>`. |
| `399` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `400` | `<div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div>`. |
| `401` | `<div class="fs-4 fw-bold"><?= count($aprendices) ?></div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="fs-4 fw-bold"><?= count($aprendices) ?></div>`. |
| `402` | `<div class="text-muted small">Aprendices en la ficha</div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="text-muted small">Aprendices en la ficha</div>`. |
| `403` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `404` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `405` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `406` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `407` | `<div class="col-sm-4">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="col-sm-4">`. |
| `408` | `<div class="stat-card bg-white">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="stat-card bg-white">`. |
| `409` | `<div class="d-flex align-items-center gap-3">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="d-flex align-items-center gap-3">`. |
| `410` | `<div class="stat-icon" style="background:rgba(234,179,8,.1);color:#d9770...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="stat-icon" style="background:rgba(234,179,8,.1);color:#d9770...`. |
| `411` | `<i class="fas fa-user-tie"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-user-tie"></i>`. |
| `412` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `413` | `<div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div>`. |
| `414` | `<div class="fs-4 fw-bold"><?= $totalVocerosActivos ?>/2</div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="fs-4 fw-bold"><?= $totalVocerosActivos ?>/2</div>`. |
| `415` | `<div class="text-muted small">Voceros activos</div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="text-muted small">Voceros activos</div>`. |
| `416` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `417` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `418` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `419` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `420` | `<div class="col-sm-4">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="col-sm-4">`. |
| `421` | `<div class="stat-card bg-white">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="stat-card bg-white">`. |
| `422` | `<div class="d-flex align-items-center gap-3">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="d-flex align-items-center gap-3">`. |
| `423` | `<div class="stat-icon" style="background:rgba(37,99,235,.1);color:#2563e...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="stat-icon" style="background:rgba(37,99,235,.1);color:#2563e...`. |
| `424` | `<i class="fas fa-clock"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-clock"></i>`. |
| `425` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `426` | `<div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div>`. |
| `427` | `<div class="fw-bold"><?= htmlspecialchars($fichaAct['jornada']) ?></div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="fw-bold"><?= htmlspecialchars($fichaAct['jornada']) ?></div>`. |
| `428` | `<div class="text-muted small">Jornada</div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="text-muted small">Jornada</div>`. |
| `429` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `430` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `431` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `432` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `433` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `434` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `435` | `<!-- Buscador inline -->` | Instrucción de ejecución en el contexto del script: `<!-- Buscador inline -->`. |
| `436` | `<div class="card shadow-sm border-0">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="card shadow-sm border-0">`. |
| `437` | `<div class="card-header bg-white border-0 py-3 d-flex justify-content-be...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="card-header bg-white border-0 py-3 d-flex justify-content-be...`. |
| `438` | `<h6 class="fw-bold mb-0">` | Instrucción de ejecución en el contexto del script: `<h6 class="fw-bold mb-0">`. |
| `439` | `<i class="fas fa-users text-success me-2"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-users text-success me-2"></i>`. |
| `440` | `Listado de Aprendices` | Instrucción de ejecución en el contexto del script: `Listado de Aprendices`. |
| `441` | `<span class="text-muted fw-normal small ms-2">— <?= htmlspecialchars($fi...` | Instrucción de ejecución en el contexto del script: `<span class="text-muted fw-normal small ms-2">— <?= htmlspecialchars($fi...`. |
| `442` | `</h6>` | Instrucción de ejecución en el contexto del script: `</h6>`. |
| `443` | `<div class="d-flex gap-2 align-items-center">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="d-flex gap-2 align-items-center">`. |
| `444` | `<span class="badge bg-success"><?= count($aprendices) ?> aprendice(s)</s...` | Instrucción de ejecución en el contexto del script: `<span class="badge bg-success"><?= count($aprendices) ?> aprendice(s)</s...`. |
| `445` | `<form method="GET" class="d-flex gap-1">` | Formulario interactivo para captura y envío de datos: `<form method="GET" class="d-flex gap-1">`. |
| `446` | `<input type="hidden" name="ficha" value="<?= $vistaFicha ?>">` | Campo de entrada interactivo para datos del usuario: `<input type="hidden" name="ficha" value="<?= $vistaFicha ?>">`. |
| `447` | `<div class="input-group input-group-sm" style="max-width:220px;">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="input-group input-group-sm" style="max-width:220px;">`. |
| `448` | `<span class="input-group-text bg-white"><i class="fas fa-search text-mut...` | Instrucción de ejecución en el contexto del script: `<span class="input-group-text bg-white"><i class="fas fa-search text-mut...`. |
| `449` | `<input type="text" name="q" class="form-control border-start-0"` | Campo de entrada interactivo para datos del usuario: `<input type="text" name="q" class="form-control border-start-0"`. |
| `450` | `placeholder="Buscar…" value="<?= htmlspecialchars($busqueda) ?>">` | Instrucción de ejecución en el contexto del script: `placeholder="Buscar…" value="<?= htmlspecialchars($busqueda) ?>">`. |
| `451` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `452` | `<button type="submit" class="btn btn-sm btn-success"><i class="fas fa-se...` | Botón de acción interactivo para el usuario: `<button type="submit" class="btn btn-sm btn-success"><i class="fas fa-se...`. |
| `453` | `<?php if ($busqueda): ?>` | Instrucción de ejecución en el contexto del script: `<?php if ($busqueda): ?>`. |
| `454` | `<a href="admin_aprendices.php?ficha=<?= $vistaFicha ?>"` | Instrucción de ejecución en el contexto del script: `<a href="admin_aprendices.php?ficha=<?= $vistaFicha ?>"`. |
| `455` | `class="btn btn-sm btn-outline-secondary"><i class="fas fa-xmark"></i></a>` | Instrucción de ejecución en el contexto del script: `class="btn btn-sm btn-outline-secondary"><i class="fas fa-xmark"></i></a>`. |
| `456` | `<?php endif; ?>` | Cierre de estructura condicional embebida en la plantilla HTML. |
| `457` | ``</form>`` | Cierre de formulario interactivo. |
| `458` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `459` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `460` | `<!-- Nota informativa -->` | Instrucción de ejecución en el contexto del script: `<!-- Nota informativa -->`. |
| `461` | `<div class="px-4 py-2" style="background:#f8fafc; border-bottom:1px soli...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="px-4 py-2" style="background:#f8fafc; border-bottom:1px soli...`. |
| `462` | `<i class="fas fa-circle-info me-1 text-success"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-circle-info me-1 text-success"></i>`. |
| `463` | `Cambia el rol de un aprendiz a <strong>Vocero</strong> para activar su c...` | Instrucción de ejecución en el contexto del script: `Cambia el rol de un aprendiz a <strong>Vocero</strong> para activar su c...`. |
| `464` | `Puede haber <strong>máximo 2 voceros activos</strong> por ficha (vocero ...` | Instrucción de ejecución en el contexto del script: `Puede haber <strong>máximo 2 voceros activos</strong> por ficha (vocero ...`. |
| `465` | `Al cambiarlo a <strong>Aprendiz</strong> su cuenta queda desactivada.` | Instrucción de ejecución en el contexto del script: `Al cambiarlo a <strong>Aprendiz</strong> su cuenta queda desactivada.`. |
| `466` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `467` | `<div class="card-body p-0">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="card-body p-0">`. |
| `468` | `<?php if (empty($aprendices)): ?>` | Instrucción de ejecución en el contexto del script: `<?php if (empty($aprendices)): ?>`. |
| `469` | `<div class="text-center py-5 text-muted">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="text-center py-5 text-muted">`. |
| `470` | `<i class="fas fa-users fa-3x mb-3 opacity-25 d-block"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-users fa-3x mb-3 opacity-25 d-block"></i>`. |
| `471` | `<p class="small mb-0">` | Instrucción de ejecución en el contexto del script: `<p class="small mb-0">`. |
| `472` | `<?= $busqueda ? 'No hay resultados para "' . htmlspecialchars($busqueda)...` | Instrucción de ejecución en el contexto del script: `<?= $busqueda ? 'No hay resultados para "' . htmlspecialchars($busqueda)...`. |
| `473` | `</p>` | Instrucción de ejecución en el contexto del script: `</p>`. |
| `474` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `475` | `<?php else: ?>` | Instrucción de ejecución en el contexto del script: `<?php else: ?>`. |
| `476` | `<div class="table-responsive">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="table-responsive">`. |
| `477` | `<table class="table tabla-limpia align-middle mb-0">` | Tabla de datos para despliegue estructurado de información. |
| `478` | `<thead class="table-light">` | Definición de estructura semántica de cabecera o cuerpo de tabla. |
| `479` | ``<tr>`` | Fila contenedora de datos dentro de la tabla. |
| `480` | `<th>#</th>` | Celda de encabezado de columna: `<th>#</th>`. |
| `481` | `<th>Apellidos</th>` | Celda de encabezado de columna: `<th>Apellidos</th>`. |
| `482` | `<th>Nombres</th>` | Celda de encabezado de columna: `<th>Nombres</th>`. |
| `483` | `<th>Documento</th>` | Celda de encabezado de columna: `<th>Documento</th>`. |
| `484` | `<th>Celular</th>` | Celda de encabezado de columna: `<th>Celular</th>`. |
| `485` | `<th>Correo</th>` | Celda de encabezado de columna: `<th>Correo</th>`. |
| `486` | `<th class="text-center">Rol</th>` | Celda de encabezado de columna: `<th class="text-center">Rol</th>`. |
| `487` | `<th class="text-center">Acceso</th>` | Celda de encabezado de columna: `<th class="text-center">Acceso</th>`. |
| `488` | ``</tr>`` | Cierre de fila contenedora de tabla. |
| `489` | `</thead>` | Definición de estructura semántica de cabecera o cuerpo de tabla. |
| `490` | `<tbody>` | Definición de estructura semántica de cabecera o cuerpo de tabla. |
| `491` | `<?php foreach ($aprendices as $i => $ap):` | Instrucción de ejecución en el contexto del script: `<?php foreach ($aprendices as $i => $ap):`. |
| `492` | `$tieneVoceroActivo   = !empty($ap['id_vocero']) && (int)($ap['vocero_act...` | Instrucción de ejecución en el contexto del script: `$tieneVoceroActivo   = !empty($ap['id_vocero']) && (int)($ap['vocero_act...`. |
| `493` | `$tieneVoceroInactivo = !empty($ap['id_vocero']) && (int)($ap['vocero_act...` | Instrucción de ejecución en el contexto del script: `$tieneVoceroInactivo = !empty($ap['id_vocero']) && (int)($ap['vocero_act...`. |
| `494` | `$celular = $ap['celular'] ?? null;` | Instrucción de ejecución en el contexto del script: `$celular = $ap['celular'] ?? null;`. |
| `495` | `$correo  = $ap['correo']  ?? null;` | Instrucción de ejecución en el contexto del script: `$correo  = $ap['correo']  ?? null;`. |
| `496` | ``?>`` | Cierre de la etiqueta PHP para alternar a salida HTML o fin del archivo. |
| `497` | ``<tr>`` | Fila contenedora de datos dentro de la tabla. |
| `498` | `<td class="text-muted small"><?= $i + 1 ?></td>` | Celda de contenido de tabla: `<td class="text-muted small"><?= $i + 1 ?></td>`. |
| `499` | `<td class="fw-semibold small"><?= htmlspecialchars($ap['apellidos']) ?><...` | Celda de contenido de tabla: `<td class="fw-semibold small"><?= htmlspecialchars($ap['apellidos']) ?><...`. |
| `500` | `<td class="small"><?= htmlspecialchars($ap['nombres']) ?></td>` | Celda de contenido de tabla: `<td class="small"><?= htmlspecialchars($ap['nombres']) ?></td>`. |
| `501` | `<td class="small text-muted"><?= htmlspecialchars($ap['documento'] ?? '—...` | Celda de contenido de tabla: `<td class="small text-muted"><?= htmlspecialchars($ap['documento'] ?? '—...`. |
| `502` | `<td class="small">` | Celda de contenido de tabla: `<td class="small">`. |
| `503` | `<?php if ($celular): ?>` | Instrucción de ejecución en el contexto del script: `<?php if ($celular): ?>`. |
| `504` | `<a href="tel:<?= htmlspecialchars($celular) ?>" class="text-decoration-n...` | Instrucción de ejecución en el contexto del script: `<a href="tel:<?= htmlspecialchars($celular) ?>" class="text-decoration-n...`. |
| `505` | `<i class="fas fa-phone text-success me-1" style="font-size:.72rem;"></i>...` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-phone text-success me-1" style="font-size:.72rem;"></i>...`. |
| `506` | `</a>` | Instrucción de ejecución en el contexto del script: `</a>`. |
| `507` | `<?php else: ?><span class="text-muted">—</span><?php endif; ?>` | Instrucción de ejecución en el contexto del script: `<?php else: ?><span class="text-muted">—</span><?php endif; ?>`. |
| `508` | `</td>` | Instrucción de ejecución en el contexto del script: `</td>`. |
| `509` | `<td class="small">` | Celda de contenido de tabla: `<td class="small">`. |
| `510` | `<?php if ($correo): ?>` | Instrucción de ejecución en el contexto del script: `<?php if ($correo): ?>`. |
| `511` | `<a href="mailto:<?= htmlspecialchars($correo) ?>"` | Instrucción de ejecución en el contexto del script: `<a href="mailto:<?= htmlspecialchars($correo) ?>"`. |
| `512` | `class="text-decoration-none text-dark text-truncate d-inline-block"` | Instrucción de ejecución en el contexto del script: `class="text-decoration-none text-dark text-truncate d-inline-block"`. |
| `513` | `style="max-width:160px;" title="<?= htmlspecialchars($correo) ?>">` | Instrucción de ejecución en el contexto del script: `style="max-width:160px;" title="<?= htmlspecialchars($correo) ?>">`. |
| `514` | `<i class="fas fa-envelope text-success me-1" style="font-size:.72rem;"><...` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-envelope text-success me-1" style="font-size:.72rem;"><...`. |
| `515` | `</a>` | Instrucción de ejecución en el contexto del script: `</a>`. |
| `516` | `<?php else: ?><span class="text-muted">—</span><?php endif; ?>` | Instrucción de ejecución en el contexto del script: `<?php else: ?><span class="text-muted">—</span><?php endif; ?>`. |
| `517` | `</td>` | Instrucción de ejecución en el contexto del script: `</td>`. |
| `518` | `<td class="text-center" style="width:160px;">` | Celda de contenido de tabla: `<td class="text-center" style="width:160px;">`. |
| `519` | ``<?php`` | Apertura obligatoria de la etiqueta PHP para ejecución del código del lado del servidor. |
| `520` | `$tieneVoceroActivo   = !empty($ap['id_vocero']) && (int)($ap['vocero_act...` | Instrucción de ejecución en el contexto del script: `$tieneVoceroActivo   = !empty($ap['id_vocero']) && (int)($ap['vocero_act...`. |
| `521` | `$tieneVoceroInactivo = !empty($ap['id_vocero']) && (int)($ap['vocero_act...` | Instrucción de ejecución en el contexto del script: `$tieneVoceroInactivo = !empty($ap['id_vocero']) && (int)($ap['vocero_act...`. |
| `522` | `// ID único por fila: usa id_aprendiz si existe, sino id_vocero con pref...` | Comentario explicativo en el código: `ID único por fila: usa id_aprendiz si existe, sino id_vocero con prefijo v`. |
| `523` | `$uid = $ap['id_aprendiz'] ?? 'v' . ($ap['id_vocero'] ?? $i);` | Instrucción de ejecución en el contexto del script: `$uid = $ap['id_aprendiz'] ?? 'v' . ($ap['id_vocero'] ?? $i);`. |
| `524` | ``?>`` | Cierre de la etiqueta PHP para alternar a salida HTML o fin del archivo. |
| `525` | `<form action="../../controllers/AdminController.php" method="POST"` | Formulario interactivo para captura y envío de datos: `<form action="../../controllers/AdminController.php" method="POST"`. |
| `526` | `id="form-ap-<?= $uid ?>">` | Instrucción de ejecución en el contexto del script: `id="form-ap-<?= $uid ?>">`. |
| `527` | `<input type="hidden" name="id_aprendiz" value="<?= $ap['id_aprendiz'] ??...` | Campo de entrada interactivo para datos del usuario: `<input type="hidden" name="id_aprendiz" value="<?= $ap['id_aprendiz'] ??...`. |
| `528` | `<input type="hidden" name="id_ficha"    value="<?= $vistaFicha ?>">` | Campo de entrada interactivo para datos del usuario: `<input type="hidden" name="id_ficha"    value="<?= $vistaFicha ?>">`. |
| `529` | `<input type="hidden" name="id_vocero"   value="<?= $ap['id_vocero'] ?? '...` | Campo de entrada interactivo para datos del usuario: `<input type="hidden" name="id_vocero"   value="<?= $ap['id_vocero'] ?? '...`. |
| `530` | `<input type="hidden" name="accion"      id="accion-<?= $uid ?>">` | Campo de entrada interactivo para datos del usuario: `<input type="hidden" name="accion"      id="accion-<?= $uid ?>">`. |
| `531` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `532` | `<?php if ($tieneVoceroActivo): ?>` | Instrucción de ejecución en el contexto del script: `<?php if ($tieneVoceroActivo): ?>`. |
| `533` | `<select class="form-select form-select-sm rol-select"` | Menú desplegable para selección de opciones. |
| `534` | `data-uid="<?= $uid ?>"` | Instrucción de ejecución en el contexto del script: `data-uid="<?= $uid ?>"`. |
| `535` | `data-form="form-ap-<?= $uid ?>"` | Instrucción de ejecución en el contexto del script: `data-form="form-ap-<?= $uid ?>"`. |
| `536` | `data-accion-up="reactivar_vocero"` | Instrucción de ejecución en el contexto del script: `data-accion-up="reactivar_vocero"`. |
| `537` | `data-accion-down="desactivar_vocero"` | Instrucción de ejecución en el contexto del script: `data-accion-down="desactivar_vocero"`. |
| `538` | `data-nombre="<?= htmlspecialchars($ap['nombres'] . ' ' . $ap['apellidos'...` | Instrucción de ejecución en el contexto del script: `data-nombre="<?= htmlspecialchars($ap['nombres'] . ' ' . $ap['apellidos'...`. |
| `539` | `style="border-color:#39a900;color:#166534;background:#f0fdf4;font-weight...` | Instrucción de ejecución en el contexto del script: `style="border-color:#39a900;color:#166534;background:#f0fdf4;font-weight...`. |
| `540` | `<option value="aprendiz">Aprendiz</option>` | Instrucción de ejecución en el contexto del script: `<option value="aprendiz">Aprendiz</option>`. |
| `541` | `<option value="vocero" selected>Vocero</option>` | Instrucción de ejecución en el contexto del script: `<option value="vocero" selected>Vocero</option>`. |
| `542` | `</select>` | Instrucción de ejecución en el contexto del script: `</select>`. |
| `543` | `<?php elseif ($tieneVoceroInactivo && !$hayVoceroActivo): ?>` | Instrucción de ejecución en el contexto del script: `<?php elseif ($tieneVoceroInactivo && !$hayVoceroActivo): ?>`. |
| `544` | `<select class="form-select form-select-sm rol-select"` | Menú desplegable para selección de opciones. |
| `545` | `data-uid="<?= $uid ?>"` | Instrucción de ejecución en el contexto del script: `data-uid="<?= $uid ?>"`. |
| `546` | `data-form="form-ap-<?= $uid ?>"` | Instrucción de ejecución en el contexto del script: `data-form="form-ap-<?= $uid ?>"`. |
| `547` | `data-accion-up="reactivar_vocero"` | Instrucción de ejecución en el contexto del script: `data-accion-up="reactivar_vocero"`. |
| `548` | `data-accion-down="desactivar_vocero"` | Instrucción de ejecución en el contexto del script: `data-accion-down="desactivar_vocero"`. |
| `549` | `data-nombre="<?= htmlspecialchars($ap['nombres'] . ' ' . $ap['apellidos'...` | Instrucción de ejecución en el contexto del script: `data-nombre="<?= htmlspecialchars($ap['nombres'] . ' ' . $ap['apellidos'...`. |
| `550` | `style="color:#6b7280;">` | Instrucción de ejecución en el contexto del script: `style="color:#6b7280;">`. |
| `551` | `<option value="aprendiz" selected>Aprendiz</option>` | Instrucción de ejecución en el contexto del script: `<option value="aprendiz" selected>Aprendiz</option>`. |
| `552` | `<option value="vocero">Vocero</option>` | Instrucción de ejecución en el contexto del script: `<option value="vocero">Vocero</option>`. |
| `553` | `</select>` | Instrucción de ejecución en el contexto del script: `</select>`. |
| `554` | `<?php elseif (!$tieneVoceroActivo && !$tieneVoceroInactivo && !$hayVocer...` | Instrucción de ejecución en el contexto del script: `<?php elseif (!$tieneVoceroActivo && !$tieneVoceroInactivo && !$hayVocer...`. |
| `555` | `<select class="form-select form-select-sm rol-select"` | Menú desplegable para selección de opciones. |
| `556` | `data-uid="<?= $uid ?>"` | Instrucción de ejecución en el contexto del script: `data-uid="<?= $uid ?>"`. |
| `557` | `data-form="form-ap-<?= $uid ?>"` | Instrucción de ejecución en el contexto del script: `data-form="form-ap-<?= $uid ?>"`. |
| `558` | `data-accion-up="activar_vocero"` | Instrucción de ejecución en el contexto del script: `data-accion-up="activar_vocero"`. |
| `559` | `data-accion-down=""` | Instrucción de ejecución en el contexto del script: `data-accion-down=""`. |
| `560` | `data-nombre="<?= htmlspecialchars($ap['nombres'] . ' ' . $ap['apellidos'...` | Instrucción de ejecución en el contexto del script: `data-nombre="<?= htmlspecialchars($ap['nombres'] . ' ' . $ap['apellidos'...`. |
| `561` | `style="color:#6b7280;">` | Instrucción de ejecución en el contexto del script: `style="color:#6b7280;">`. |
| `562` | `<option value="aprendiz" selected>Aprendiz</option>` | Instrucción de ejecución en el contexto del script: `<option value="aprendiz" selected>Aprendiz</option>`. |
| `563` | `<option value="vocero">Vocero</option>` | Instrucción de ejecución en el contexto del script: `<option value="vocero">Vocero</option>`. |
| `564` | `</select>` | Instrucción de ejecución en el contexto del script: `</select>`. |
| `565` | `<?php else: ?>` | Instrucción de ejecución en el contexto del script: `<?php else: ?>`. |
| `566` | `<select class="form-select form-select-sm" disabled` | Menú desplegable para selección de opciones. |
| `567` | `style="color:#9ca3af;"` | Instrucción de ejecución en el contexto del script: `style="color:#9ca3af;"`. |
| `568` | `title="<?= $tieneVoceroInactivo ? 'Ya hay 2 voceros activos' : 'Ya hay 2...` | Instrucción de ejecución en el contexto del script: `title="<?= $tieneVoceroInactivo ? 'Ya hay 2 voceros activos' : 'Ya hay 2...`. |
| `569` | `<option>Aprendiz</option>` | Instrucción de ejecución en el contexto del script: `<option>Aprendiz</option>`. |
| `570` | `</select>` | Instrucción de ejecución en el contexto del script: `</select>`. |
| `571` | `<?php endif; ?>` | Cierre de estructura condicional embebida en la plantilla HTML. |
| `572` | ``</form>`` | Cierre de formulario interactivo. |
| `573` | `</td>` | Instrucción de ejecución en el contexto del script: `</td>`. |
| `574` | `<td class="text-center">` | Celda de contenido de tabla: `<td class="text-center">`. |
| `575` | `<?php if ($tieneVoceroActivo): ?>` | Instrucción de ejecución en el contexto del script: `<?php if ($tieneVoceroActivo): ?>`. |
| `576` | `<?php if ((int)($ap['primer_acceso'] ?? 1) === 0): ?>` | Instrucción de ejecución en el contexto del script: `<?php if ((int)($ap['primer_acceso'] ?? 1) === 0): ?>`. |
| `577` | `<span class="badge bg-success">` | Instrucción de ejecución en el contexto del script: `<span class="badge bg-success">`. |
| `578` | `<i class="fas fa-check me-1"></i>Activo` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-check me-1"></i>Activo`. |
| `579` | `</span>` | Instrucción de ejecución en el contexto del script: `</span>`. |
| `580` | `<?php else: ?>` | Instrucción de ejecución en el contexto del script: `<?php else: ?>`. |
| `581` | `<span class="badge bg-warning text-dark" style="font-size:.7rem;">` | Instrucción de ejecución en el contexto del script: `<span class="badge bg-warning text-dark" style="font-size:.7rem;">`. |
| `582` | `<i class="fas fa-clock me-1"></i>1er acceso` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-clock me-1"></i>1er acceso`. |
| `583` | `</span>` | Instrucción de ejecución en el contexto del script: `</span>`. |
| `584` | `<?php endif; ?>` | Cierre de estructura condicional embebida en la plantilla HTML. |
| `585` | `<?php elseif ($tieneVoceroInactivo): ?>` | Instrucción de ejecución en el contexto del script: `<?php elseif ($tieneVoceroInactivo): ?>`. |
| `586` | `<span class="badge bg-secondary" style="font-size:.7rem;">` | Instrucción de ejecución en el contexto del script: `<span class="badge bg-secondary" style="font-size:.7rem;">`. |
| `587` | `<i class="fas fa-ban me-1"></i>Inactivo` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-ban me-1"></i>Inactivo`. |
| `588` | `</span>` | Instrucción de ejecución en el contexto del script: `</span>`. |
| `589` | `<?php else: ?>` | Instrucción de ejecución en el contexto del script: `<?php else: ?>`. |
| `590` | `<span class="text-muted" style="font-size:.75rem;">—</span>` | Instrucción de ejecución en el contexto del script: `<span class="text-muted" style="font-size:.75rem;">—</span>`. |
| `591` | `<?php endif; ?>` | Cierre de estructura condicional embebida en la plantilla HTML. |
| `592` | `</td>` | Instrucción de ejecución en el contexto del script: `</td>`. |
| `593` | ``</tr>`` | Cierre de fila contenedora de tabla. |
| `594` | `<?php endforeach; ?>` | Cierre de ciclo iterativo foreach embebido en la plantilla HTML. |
| `595` | `</tbody>` | Definición de estructura semántica de cabecera o cuerpo de tabla. |
| `596` | ``</table>`` | Cierre de tabla de datos. |
| `597` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `598` | `<?php endif; ?>` | Cierre de estructura condicional embebida en la plantilla HTML. |
| `599` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `600` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `601` | `<?php endif; ?>` | Cierre de estructura condicional embebida en la plantilla HTML. |
| `602` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `603` | `<!-- ══ ESTILOS + JS ═══════════════════════════════════════════════════...` | Instrucción de ejecución en el contexto del script: `<!-- ══ ESTILOS + JS ═══════════════════════════════════════════════════...`. |
| `604` | ``<style>`` | Bloque de estilos CSS personalizados para la interfaz. |
| `605` | `.prog-card { transition: transform .2s, box-shadow .2s; cursor: pointer; }` | Instrucción de ejecución en el contexto del script: `.prog-card { transition: transform .2s, box-shadow .2s; cursor: pointer; }`. |
| `606` | `.prog-card:hover { transform: translateY(-3px); box-shadow: 0 8px 24px r...` | Instrucción de ejecución en el contexto del script: `.prog-card:hover { transform: translateY(-3px); box-shadow: 0 8px 24px r...`. |
| `607` | `.breadcrumb-item + .breadcrumb-item::before { color: #9ca3af; }` | Instrucción de ejecución en el contexto del script: `.breadcrumb-item + .breadcrumb-item::before { color: #9ca3af; }`. |
| `608` | ``</style>`` | Cierre de bloque de estilos CSS. |
| `609` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `610` | ``<script>`` | Bloque o etiqueta de vinculación para scripts JavaScript del lado del cliente. |
| `611` | `const bP = document.getElementById('buscPrograma');` | Instrucción de ejecución en el contexto del script: `const bP = document.getElementById('buscPrograma');`. |
| `612` | `if (bP) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (bP) {`. |
| `613` | `bP.addEventListener('input', function () {` | Registra un escucha de eventos del DOM para interactividad en tiempo real: `bP.addEventListener('input', function () {`. |
| `614` | `const q = this.value.toLowerCase();` | Instrucción de ejecución en el contexto del script: `const q = this.value.toLowerCase();`. |
| `615` | `document.querySelectorAll('.prog-item').forEach(el => {` | Instrucción de ejecución en el contexto del script: `document.querySelectorAll('.prog-item').forEach(el => {`. |
| `616` | `el.style.display = !q \|\| el.textContent.toLowerCase().includes(q) ? ''...` | Instrucción de ejecución en el contexto del script: `el.style.display = !q \|\| el.textContent.toLowerCase().includes(q) ? ''...`. |
| `617` | `});` | Instrucción de ejecución en el contexto del script: `});`. |
| `618` | `});` | Instrucción de ejecución en el contexto del script: `});`. |
| `619` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `620` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `621` | `// ── Selects de rol ───────────────────────────────────────────────────...` | Comentario explicativo en el código: `── Selects de rol ────────────────────────────────────────────────────────`. |
| `622` | `// Se usa change con confirmación SweetAlert para evitar disparos accide...` | Comentario explicativo en el código: `Se usa change con confirmación SweetAlert para evitar disparos accidentales`. |
| `623` | `// (bfcache, autocomplete del navegador, etc.)` | Comentario explicativo en el código: `(bfcache, autocomplete del navegador, etc.)`. |
| `624` | `document.querySelectorAll('.rol-select').forEach(function(sel) {` | Instrucción de ejecución en el contexto del script: `document.querySelectorAll('.rol-select').forEach(function(sel) {`. |
| `625` | `// Guardar el valor original al cargar la página` | Comentario explicativo en el código: `Guardar el valor original al cargar la página`. |
| `626` | `const valorOriginal = sel.value;` | Instrucción de ejecución en el contexto del script: `const valorOriginal = sel.value;`. |
| `627` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `628` | `sel.addEventListener('change', function() {` | Registra un escucha de eventos del DOM para interactividad en tiempo real: `sel.addEventListener('change', function() {`. |
| `629` | `const nuevoValor = this.value;` | Instrucción de ejecución en el contexto del script: `const nuevoValor = this.value;`. |
| `630` | `const nombre     = this.dataset.nombre;` | Instrucción de ejecución en el contexto del script: `const nombre     = this.dataset.nombre;`. |
| `631` | `const formId     = this.dataset.form;` | Instrucción de ejecución en el contexto del script: `const formId     = this.dataset.form;`. |
| `632` | `const accionUp   = this.dataset.accionUp;   // vocero → activar/reactivar` | Instrucción de ejecución en el contexto del script: `const accionUp   = this.dataset.accionUp;   // vocero → activar/reactivar`. |
| `633` | `const accionDown = this.dataset.accionDown; // aprendiz → desactivar` | Instrucción de ejecución en el contexto del script: `const accionDown = this.dataset.accionDown; // aprendiz → desactivar`. |
| `634` | `const accionInput = document.getElementById('accion-' + this.dataset.uid);` | Instrucción de ejecución en el contexto del script: `const accionInput = document.getElementById('accion-' + this.dataset.uid);`. |
| `635` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `636` | `const esSubida = (nuevoValor === 'vocero');` | Instrucción de ejecución en el contexto del script: `const esSubida = (nuevoValor === 'vocero');`. |
| `637` | `const accion   = esSubida ? accionUp : accionDown;` | Instrucción de ejecución en el contexto del script: `const accion   = esSubida ? accionUp : accionDown;`. |
| `638` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `639` | `// Si no hay acción definida para este sentido, revertir y salir` | Comentario explicativo en el código: `Si no hay acción definida para este sentido, revertir y salir`. |
| `640` | `if (!accion) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (!accion) {`. |
| `641` | `this.value = valorOriginal;` | Instrucción de ejecución en el contexto del script: `this.value = valorOriginal;`. |
| `642` | `return;` | Finaliza la ejecución de la función o script. |
| `643` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `644` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `645` | `const titulo  = esSubida` | Instrucción de ejecución en el contexto del script: `const titulo  = esSubida`. |
| `646` | `? '¿Activar como Vocero?'` | Instrucción de ejecución en el contexto del script: `? '¿Activar como Vocero?'`. |
| `647` | `: '¿Quitar rol de Vocero?';` | Instrucción de ejecución en el contexto del script: `: '¿Quitar rol de Vocero?';`. |
| `648` | `const mensaje = esSubida` | Instrucción de ejecución en el contexto del script: `const mensaje = esSubida`. |
| `649` | `? `${nombre} obtendrá acceso al sistema como vocero.`` | Instrucción de ejecución en el contexto del script: `? `${nombre} obtendrá acceso al sistema como vocero.``. |
| `650` | `: `${nombre} volverá a ser aprendiz y perderá acceso al sistema.`;` | Instrucción de ejecución en el contexto del script: `: `${nombre} volverá a ser aprendiz y perderá acceso al sistema.`;`. |
| `651` | `const btnColor = esSubida ? '#39a900' : '#ef4444';` | Instrucción de ejecución en el contexto del script: `const btnColor = esSubida ? '#39a900' : '#ef4444';`. |
| `652` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `653` | `// Guardar referencia al select para poder revertir si cancela` | Comentario explicativo en el código: `Guardar referencia al select para poder revertir si cancela`. |
| `654` | `const selectRef = this;` | Instrucción de ejecución en el contexto del script: `const selectRef = this;`. |
| `655` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `656` | `Swal.fire({` | Despliega una alerta modal estética e interactiva con SweetAlert2. |
| `657` | `title:              titulo,` | Instrucción de ejecución en el contexto del script: `title:              titulo,`. |
| `658` | `text:               mensaje,` | Instrucción de ejecución en el contexto del script: `text:               mensaje,`. |
| `659` | `icon:               esSubida ? 'question' : 'warning',` | Instrucción de ejecución en el contexto del script: `icon:               esSubida ? 'question' : 'warning',`. |
| `660` | `showCancelButton:   true,` | Instrucción de ejecución en el contexto del script: `showCancelButton:   true,`. |
| `661` | `confirmButtonText:  'Sí, confirmar',` | Instrucción de ejecución en el contexto del script: `confirmButtonText:  'Sí, confirmar',`. |
| `662` | `cancelButtonText:   'Cancelar',` | Instrucción de ejecución en el contexto del script: `cancelButtonText:   'Cancelar',`. |
| `663` | `confirmButtonColor: btnColor,` | Instrucción de ejecución en el contexto del script: `confirmButtonColor: btnColor,`. |
| `664` | `cancelButtonColor:  '#6b7280',` | Instrucción de ejecución en el contexto del script: `cancelButtonColor:  '#6b7280',`. |
| `665` | `}).then(function(result) {` | Instrucción de ejecución en el contexto del script: `}).then(function(result) {`. |
| `666` | `if (result.isConfirmed) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (result.isConfirmed) {`. |
| `667` | `accionInput.value = accion;` | Instrucción de ejecución en el contexto del script: `accionInput.value = accion;`. |
| `668` | `document.getElementById(formId).submit();` | Instrucción de ejecución en el contexto del script: `document.getElementById(formId).submit();`. |
| `669` | `} else {` | Instrucción de ejecución en el contexto del script: `} else {`. |
| `670` | `// Revertir el select al valor original` | Comentario explicativo en el código: `Revertir el select al valor original`. |
| `671` | `selectRef.value = valorOriginal;` | Instrucción de ejecución en el contexto del script: `selectRef.value = valorOriginal;`. |
| `672` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `673` | `});` | Instrucción de ejecución en el contexto del script: `});`. |
| `674` | `});` | Instrucción de ejecución en el contexto del script: `});`. |
| `675` | `});` | Instrucción de ejecución en el contexto del script: `});`. |
| `676` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `677` | `<?php if ($alert): ?>` | Instrucción de ejecución en el contexto del script: `<?php if ($alert): ?>`. |
| `678` | `document.addEventListener('DOMContentLoaded', function () {` | Registra un escucha de eventos del DOM para interactividad en tiempo real: `document.addEventListener('DOMContentLoaded', function () {`. |
| `679` | `Swal.fire({ icon:'<?= addslashes($alert['icon']) ?>', title:'<?= addslas...` | Despliega una alerta modal estética e interactiva con SweetAlert2. |
| `680` | `});` | Instrucción de ejecución en el contexto del script: `});`. |
| `681` | `<?php endif; ?>` | Cierre de estructura condicional embebida en la plantilla HTML. |
| `682` | ``</script>`` | Cierre de bloque de script JavaScript. |
| `683` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `684` | `<?php require_once __DIR__ . '/../layouts/footer.php'; ?>` | Importación e inclusión obligatoria del archivo de dependencia requerido: `<?php require_once __DIR__ . '/../layouts/footer.php'; ?>`. |

---

## 3. Resumen y Flujo de Interacción

El archivo `admin_aprendices.php` cumple un rol indispensable en `views/dashboard/admin_aprendices.php`. 
Interfaz del administrador para consultar, buscar y gestionar la información de aprendices vinculados a las fichas. Garantiza la robustez, el orden y la estabilidad de la arquitectura del proyecto `systemLimpieza`.

---

Generado automáticamente para el repositorio [johanrepizo/LimpiezaDeModulos](https://github.com/johanrepizo/LimpiezaDeModulos).
