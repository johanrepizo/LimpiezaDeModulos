# Documentación Línea por Línea: `views/dashboard/admin_voceros.php`

## 1. Ficha Técnica del Archivo

- **Archivo:** `admin_voceros.php`
- **Ruta en el proyecto:** `views/dashboard/admin_voceros.php`
- **Cantidad total de líneas:** `549`
- **Tipo de archivo:** `PHP`
- **Propósito general:** Panel de control y auditoría de los aprendices designados como voceros principales de las fichas.

---

## 2. Explicación Detallada Línea por Línea

A continuación se presenta cada línea de código numerada de forma consecutiva, acompañada de su fragmento exacto y la explicación exhaustiva de su funcionamiento y responsabilidad en el sistema:

| Línea | Código Fuente | Explicación Detallada |
|---|---|---|
| `1` | ``<?php`` | Apertura obligatoria de la etiqueta PHP para ejecución del código del lado del servidor. |
| `2` | `$titulo = 'Voceros';` | Instrucción de ejecución en el contexto del script: `$titulo = 'Voceros';`. |
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
| `22` | `// ── Stats globales ───────────────────────────────────────────────────...` | Comentario explicativo en el código: `── Stats globales ──────────────────────────────────────────────────────...`. |
| `23` | `$programas   = $modelProg->obtenerTodos();` | Instrucción de ejecución en el contexto del script: `$programas   = $modelProg->obtenerTodos();`. |
| `24` | `$stmtTotV    = $db->query("SELECT COUNT(*) FROM voceros WHERE activo = 1");` | Instrucción de ejecución en el contexto del script: `$stmtTotV    = $db->query("SELECT COUNT(*) FROM voceros WHERE activo = 1");`. |
| `25` | `$totalVoceros = (int)$stmtTotV->fetchColumn();` | Recupera el valor escalar de la primera columna del resultado de la consulta. |
| `26` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `27` | `// ── Nivel 1: fichas del programa ─────────────────────────────────────...` | Comentario explicativo en el código: `── Nivel 1: fichas del programa ────────────────────────────────────────...`. |
| `28` | `$programaAct   = null;` | Instrucción de ejecución en el contexto del script: `$programaAct   = null;`. |
| `29` | `$fichasDelProg = [];` | Instrucción de ejecución en el contexto del script: `$fichasDelProg = [];`. |
| `30` | `if ($vistaPrograma) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if ($vistaPrograma) {`. |
| `31` | `$programaAct = $modelProg->obtenerPorId($vistaPrograma);` | Instrucción de ejecución en el contexto del script: `$programaAct = $modelProg->obtenerPorId($vistaPrograma);`. |
| `32` | `$stmtF = $db->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmtF = $db->prepare(`. |
| `33` | `"SELECT f.*,` | Instrucción de ejecución en el contexto del script: `"SELECT f.*,`. |
| `34` | `ANY_VALUE(v.nombres)   AS vocero_nombres,` | Instrucción de ejecución en el contexto del script: `ANY_VALUE(v.nombres)   AS vocero_nombres,`. |
| `35` | `ANY_VALUE(v.apellidos) AS vocero_apellidos,` | Instrucción de ejecución en el contexto del script: `ANY_VALUE(v.apellidos) AS vocero_apellidos,`. |
| `36` | `COUNT(DISTINCT ap.id_aprendiz) AS total_aprendices,` | Instrucción de ejecución en el contexto del script: `COUNT(DISTINCT ap.id_aprendiz) AS total_aprendices,`. |
| `37` | `COUNT(DISTINCT v.id_vocero)    AS tiene_vocero` | Instrucción de ejecución en el contexto del script: `COUNT(DISTINCT v.id_vocero)    AS tiene_vocero`. |
| `38` | `FROM fichas f` | Instrucción de ejecución en el contexto del script: `FROM fichas f`. |
| `39` | `LEFT JOIN voceros    v  ON v.id_ficha  = f.id_ficha AND v.activo = 1` | Instrucción de ejecución en el contexto del script: `LEFT JOIN voceros    v  ON v.id_ficha  = f.id_ficha AND v.activo = 1`. |
| `40` | `LEFT JOIN aprendices ap ON ap.id_ficha = f.id_ficha AND ap.activo = 1` | Instrucción de ejecución en el contexto del script: `LEFT JOIN aprendices ap ON ap.id_ficha = f.id_ficha AND ap.activo = 1`. |
| `41` | `WHERE f.id_programa = :prog AND f.activo = 1` | Instrucción de ejecución en el contexto del script: `WHERE f.id_programa = :prog AND f.activo = 1`. |
| `42` | `GROUP BY f.id_ficha` | Instrucción de ejecución en el contexto del script: `GROUP BY f.id_ficha`. |
| `43` | `ORDER BY f.numero_ficha"` | Instrucción de ejecución en el contexto del script: `ORDER BY f.numero_ficha"`. |
| `44` | ``);`` | Cierre de estructura de arreglo o invocación de función. |
| `45` | `$stmtF->execute([':prog' => $vistaPrograma]);` | Ejecuta la sentencia SQL preparada vinculando los parámetros correspondientes: `$stmtF->execute([':prog' => $vistaPrograma]);`. |
| `46` | `$fichasDelProg = $stmtF->fetchAll(PDO::FETCH_ASSOC);` | Obtiene todos los registros coincidentes de la consulta en un arreglo asociativo. |
| `47` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `48` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `49` | `// ── Nivel 2: voceros de una ficha ────────────────────────────────────...` | Comentario explicativo en el código: `── Nivel 2: voceros de una ficha ───────────────────────────────────────...`. |
| `50` | `$fichaAct = null;` | Instrucción de ejecución en el contexto del script: `$fichaAct = null;`. |
| `51` | `$voceros  = [];` | Instrucción de ejecución en el contexto del script: `$voceros  = [];`. |
| `52` | `if ($vistaFicha) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if ($vistaFicha) {`. |
| `53` | `$fichaAct = $modelFich->obtenerPorId($vistaFicha);` | Instrucción de ejecución en el contexto del script: `$fichaAct = $modelFich->obtenerPorId($vistaFicha);`. |
| `54` | `if ($fichaAct) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if ($fichaAct) {`. |
| `55` | `$vistaPrograma = (int)$fichaAct['id_programa'];` | Instrucción de ejecución en el contexto del script: `$vistaPrograma = (int)$fichaAct['id_programa'];`. |
| `56` | `$programaAct   = $modelProg->obtenerPorId($vistaPrograma);` | Instrucción de ejecución en el contexto del script: `$programaAct   = $modelProg->obtenerPorId($vistaPrograma);`. |
| `57` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `58` | `$stmtF2 = $db->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmtF2 = $db->prepare(`. |
| `59` | `"SELECT f.*,` | Instrucción de ejecución en el contexto del script: `"SELECT f.*,`. |
| `60` | `ANY_VALUE(v.nombres) AS vocero_nombres,` | Instrucción de ejecución en el contexto del script: `ANY_VALUE(v.nombres) AS vocero_nombres,`. |
| `61` | `COUNT(DISTINCT ap.id_aprendiz) AS total_aprendices,` | Instrucción de ejecución en el contexto del script: `COUNT(DISTINCT ap.id_aprendiz) AS total_aprendices,`. |
| `62` | `COUNT(DISTINCT v.id_vocero)    AS tiene_vocero` | Instrucción de ejecución en el contexto del script: `COUNT(DISTINCT v.id_vocero)    AS tiene_vocero`. |
| `63` | `FROM fichas f` | Instrucción de ejecución en el contexto del script: `FROM fichas f`. |
| `64` | `LEFT JOIN voceros    v  ON v.id_ficha  = f.id_ficha AND v.activo = 1` | Instrucción de ejecución en el contexto del script: `LEFT JOIN voceros    v  ON v.id_ficha  = f.id_ficha AND v.activo = 1`. |
| `65` | `LEFT JOIN aprendices ap ON ap.id_ficha = f.id_ficha AND ap.activo = 1` | Instrucción de ejecución en el contexto del script: `LEFT JOIN aprendices ap ON ap.id_ficha = f.id_ficha AND ap.activo = 1`. |
| `66` | `WHERE f.id_programa = :prog AND f.activo = 1` | Instrucción de ejecución en el contexto del script: `WHERE f.id_programa = :prog AND f.activo = 1`. |
| `67` | `GROUP BY f.id_ficha ORDER BY f.numero_ficha"` | Instrucción de ejecución en el contexto del script: `GROUP BY f.id_ficha ORDER BY f.numero_ficha"`. |
| `68` | ``);`` | Cierre de estructura de arreglo o invocación de función. |
| `69` | `$stmtF2->execute([':prog' => $vistaPrograma]);` | Ejecuta la sentencia SQL preparada vinculando los parámetros correspondientes: `$stmtF2->execute([':prog' => $vistaPrograma]);`. |
| `70` | `$fichasDelProg = $stmtF2->fetchAll(PDO::FETCH_ASSOC);` | Obtiene todos los registros coincidentes de la consulta en un arreglo asociativo. |
| `71` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `72` | `$where  = ['v.id_ficha = :fic', 'v.activo = 1'];` | Instrucción de ejecución en el contexto del script: `$where  = ['v.id_ficha = :fic', 'v.activo = 1'];`. |
| `73` | `$params = [':fic' => $vistaFicha];` | Instrucción de ejecución en el contexto del script: `$params = [':fic' => $vistaFicha];`. |
| `74` | `if ($busqueda) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if ($busqueda) {`. |
| `75` | `$like = '%' . $busqueda . '%';` | Instrucción de ejecución en el contexto del script: `$like = '%' . $busqueda . '%';`. |
| `76` | `$where[] = '(v.nombres LIKE :q OR v.apellidos LIKE :q2 OR v.documento LI...` | Instrucción de ejecución en el contexto del script: `$where[] = '(v.nombres LIKE :q OR v.apellidos LIKE :q2 OR v.documento LI...`. |
| `77` | `$params[':q'] = $like; $params[':q2'] = $like;` | Instrucción de ejecución en el contexto del script: `$params[':q'] = $like; $params[':q2'] = $like;`. |
| `78` | `$params[':q3'] = $like; $params[':q4'] = $like;` | Instrucción de ejecución en el contexto del script: `$params[':q3'] = $like; $params[':q4'] = $like;`. |
| `79` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `80` | `$stmtV = $db->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmtV = $db->prepare(`. |
| `81` | `"SELECT v.*, u.correo, u.activo AS usuario_activo, u.primer_acceso` | Instrucción de ejecución en el contexto del script: `"SELECT v.*, u.correo, u.activo AS usuario_activo, u.primer_acceso`. |
| `82` | `FROM voceros v` | Instrucción de ejecución en el contexto del script: `FROM voceros v`. |
| `83` | `JOIN usuarios u ON u.id_usuario = v.id_usuario` | Instrucción de ejecución en el contexto del script: `JOIN usuarios u ON u.id_usuario = v.id_usuario`. |
| `84` | `WHERE " . implode(' AND ', $where) . "` | Instrucción de ejecución en el contexto del script: `WHERE " . implode(' AND ', $where) . "`. |
| `85` | `ORDER BY v.apellidos, v.nombres"` | Instrucción de ejecución en el contexto del script: `ORDER BY v.apellidos, v.nombres"`. |
| `86` | ``);`` | Cierre de estructura de arreglo o invocación de función. |
| `87` | `$stmtV->execute($params);` | Ejecuta la sentencia SQL preparada vinculando los parámetros correspondientes: `$stmtV->execute($params);`. |
| `88` | `$voceros = $stmtV->fetchAll(PDO::FETCH_ASSOC);` | Obtiene todos los registros coincidentes de la consulta en un arreglo asociativo. |
| `89` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `90` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `91` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `92` | `require_once __DIR__ . '/../layouts/header.php';` | Importación e inclusión obligatoria del archivo de dependencia requerido: `require_once __DIR__ . '/../layouts/header.php';`. |
| `93` | ``?>`` | Cierre de la etiqueta PHP para alternar a salida HTML o fin del archivo. |
| `94` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `95` | `<!-- ══ BREADCRUMB + CABECERA ══════════════════════════════════════════...` | Instrucción de ejecución en el contexto del script: `<!-- ══ BREADCRUMB + CABECERA ══════════════════════════════════════════...`. |
| `96` | `<div class="d-flex justify-content-between align-items-start mb-4 flex-w...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="d-flex justify-content-between align-items-start mb-4 flex-w...`. |
| `97` | `<div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div>`. |
| `98` | `<nav aria-label="breadcrumb" class="mb-1">` | Instrucción de ejecución en el contexto del script: `<nav aria-label="breadcrumb" class="mb-1">`. |
| `99` | `<ol class="breadcrumb mb-0" style="font-size:.82rem;">` | Instrucción de ejecución en el contexto del script: `<ol class="breadcrumb mb-0" style="font-size:.82rem;">`. |
| `100` | `<li class="breadcrumb-item">` | Instrucción de ejecución en el contexto del script: `<li class="breadcrumb-item">`. |
| `101` | `<a href="admin_voceros.php" class="text-success text-decoration-none fw-...` | Instrucción de ejecución en el contexto del script: `<a href="admin_voceros.php" class="text-success text-decoration-none fw-...`. |
| `102` | `<i class="fas fa-user-tie me-1"></i>Voceros` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-user-tie me-1"></i>Voceros`. |
| `103` | `</a>` | Instrucción de ejecución en el contexto del script: `</a>`. |
| `104` | `</li>` | Instrucción de ejecución en el contexto del script: `</li>`. |
| `105` | `<?php if ($programaAct): ?>` | Instrucción de ejecución en el contexto del script: `<?php if ($programaAct): ?>`. |
| `106` | `<li class="breadcrumb-item">` | Instrucción de ejecución en el contexto del script: `<li class="breadcrumb-item">`. |
| `107` | `<?php if ($fichaAct): ?>` | Instrucción de ejecución en el contexto del script: `<?php if ($fichaAct): ?>`. |
| `108` | `<a href="admin_voceros.php?programa=<?= $vistaPrograma ?>"` | Instrucción de ejecución en el contexto del script: `<a href="admin_voceros.php?programa=<?= $vistaPrograma ?>"`. |
| `109` | `class="text-success text-decoration-none">` | Instrucción de ejecución en el contexto del script: `class="text-success text-decoration-none">`. |
| `110` | `<?= htmlspecialchars($programaAct['nombre']) ?>` | Instrucción de ejecución en el contexto del script: `<?= htmlspecialchars($programaAct['nombre']) ?>`. |
| `111` | `</a>` | Instrucción de ejecución en el contexto del script: `</a>`. |
| `112` | `<?php else: ?>` | Instrucción de ejecución en el contexto del script: `<?php else: ?>`. |
| `113` | `<span class="text-dark fw-semibold"><?= htmlspecialchars($programaAct['n...` | Instrucción de ejecución en el contexto del script: `<span class="text-dark fw-semibold"><?= htmlspecialchars($programaAct['n...`. |
| `114` | `<?php endif; ?>` | Cierre de estructura condicional embebida en la plantilla HTML. |
| `115` | `</li>` | Instrucción de ejecución en el contexto del script: `</li>`. |
| `116` | `<?php endif; ?>` | Cierre de estructura condicional embebida en la plantilla HTML. |
| `117` | `<?php if ($fichaAct): ?>` | Instrucción de ejecución en el contexto del script: `<?php if ($fichaAct): ?>`. |
| `118` | `<li class="breadcrumb-item active">` | Instrucción de ejecución en el contexto del script: `<li class="breadcrumb-item active">`. |
| `119` | `Ficha <strong class="font-monospace"><?= htmlspecialchars($fichaAct['num...` | Instrucción de ejecución en el contexto del script: `Ficha <strong class="font-monospace"><?= htmlspecialchars($fichaAct['num...`. |
| `120` | `</li>` | Instrucción de ejecución en el contexto del script: `</li>`. |
| `121` | `<?php endif; ?>` | Cierre de estructura condicional embebida en la plantilla HTML. |
| `122` | `</ol>` | Instrucción de ejecución en el contexto del script: `</ol>`. |
| `123` | `</nav>` | Instrucción de ejecución en el contexto del script: `</nav>`. |
| `124` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `125` | `<h4 class="fw-bold mb-0">` | Instrucción de ejecución en el contexto del script: `<h4 class="fw-bold mb-0">`. |
| `126` | `<?php if ($fichaAct): ?>` | Instrucción de ejecución en el contexto del script: `<?php if ($fichaAct): ?>`. |
| `127` | `<i class="fas fa-user-tie text-success me-2"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-user-tie text-success me-2"></i>`. |
| `128` | `Voceros — Ficha <span class="font-monospace"><?= htmlspecialchars($ficha...` | Instrucción de ejecución en el contexto del script: `Voceros — Ficha <span class="font-monospace"><?= htmlspecialchars($ficha...`. |
| `129` | `<?php elseif ($programaAct): ?>` | Instrucción de ejecución en el contexto del script: `<?php elseif ($programaAct): ?>`. |
| `130` | `<i class="fas fa-id-card text-success me-2"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-id-card text-success me-2"></i>`. |
| `131` | `Fichas — <?= htmlspecialchars($programaAct['nombre']) ?>` | Instrucción de ejecución en el contexto del script: `Fichas — <?= htmlspecialchars($programaAct['nombre']) ?>`. |
| `132` | `<?php else: ?>` | Instrucción de ejecución en el contexto del script: `<?php else: ?>`. |
| `133` | `<i class="fas fa-user-tie text-success me-2"></i>Voceros` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-user-tie text-success me-2"></i>Voceros`. |
| `134` | `<?php endif; ?>` | Cierre de estructura condicional embebida en la plantilla HTML. |
| `135` | `</h4>` | Instrucción de ejecución en el contexto del script: `</h4>`. |
| `136` | `<p class="text-muted small mb-0">` | Instrucción de ejecución en el contexto del script: `<p class="text-muted small mb-0">`. |
| `137` | `<?php if ($fichaAct): ?>` | Instrucción de ejecución en el contexto del script: `<?php if ($fichaAct): ?>`. |
| `138` | `<?= count($voceros) ?> vocero(s) en esta ficha` | Instrucción de ejecución en el contexto del script: `<?= count($voceros) ?> vocero(s) en esta ficha`. |
| `139` | `<?php elseif ($programaAct): ?>` | Instrucción de ejecución en el contexto del script: `<?php elseif ($programaAct): ?>`. |
| `140` | `Selecciona una ficha para ver sus voceros` | Instrucción de ejecución en el contexto del script: `Selecciona una ficha para ver sus voceros`. |
| `141` | `<?php else: ?>` | Instrucción de ejecución en el contexto del script: `<?php else: ?>`. |
| `142` | `Selecciona un programa de formación` | Instrucción de ejecución en el contexto del script: `Selecciona un programa de formación`. |
| `143` | `<?php endif; ?>` | Cierre de estructura condicional embebida en la plantilla HTML. |
| `144` | `</p>` | Instrucción de ejecución en el contexto del script: `</p>`. |
| `145` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `146` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `147` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `148` | `<!-- ══ NIVEL 0: GRID DE PROGRAMAS ═════════════════════════════════════...` | Instrucción de ejecución en el contexto del script: `<!-- ══ NIVEL 0: GRID DE PROGRAMAS ═════════════════════════════════════...`. |
| `149` | `<?php if (!$vistaPrograma && !$vistaFicha): ?>` | Instrucción de ejecución en el contexto del script: `<?php if (!$vistaPrograma && !$vistaFicha): ?>`. |
| `150` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `151` | `<div class="row g-3 mb-4">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="row g-3 mb-4">`. |
| `152` | `<div class="col-sm-4">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="col-sm-4">`. |
| `153` | `<div class="stat-card bg-white">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="stat-card bg-white">`. |
| `154` | `<div class="d-flex align-items-center gap-3">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="d-flex align-items-center gap-3">`. |
| `155` | `<div class="stat-icon" style="background:rgba(57,169,0,.12);color:#39a90...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="stat-icon" style="background:rgba(57,169,0,.12);color:#39a90...`. |
| `156` | `<i class="fas fa-graduation-cap"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-graduation-cap"></i>`. |
| `157` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `158` | `<div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div>`. |
| `159` | `<div class="fs-4 fw-bold"><?= count($programas) ?></div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="fs-4 fw-bold"><?= count($programas) ?></div>`. |
| `160` | `<div class="text-muted small">Programas</div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="text-muted small">Programas</div>`. |
| `161` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `162` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `163` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `164` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `165` | `<div class="col-sm-4">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="col-sm-4">`. |
| `166` | `<div class="stat-card bg-white">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="stat-card bg-white">`. |
| `167` | `<div class="d-flex align-items-center gap-3">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="d-flex align-items-center gap-3">`. |
| `168` | `<div class="stat-icon" style="background:rgba(37,99,235,.1);color:#2563e...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="stat-icon" style="background:rgba(37,99,235,.1);color:#2563e...`. |
| `169` | `<i class="fas fa-id-card"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-id-card"></i>`. |
| `170` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `171` | `<div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div>`. |
| `172` | `<div class="fs-4 fw-bold"><?= array_sum(array_column($programas, 'total_...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="fs-4 fw-bold"><?= array_sum(array_column($programas, 'total_...`. |
| `173` | `<div class="text-muted small">Fichas activas</div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="text-muted small">Fichas activas</div>`. |
| `174` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `175` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `176` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `177` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `178` | `<div class="col-sm-4">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="col-sm-4">`. |
| `179` | `<div class="stat-card bg-white">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="stat-card bg-white">`. |
| `180` | `<div class="d-flex align-items-center gap-3">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="d-flex align-items-center gap-3">`. |
| `181` | `<div class="stat-icon" style="background:rgba(234,179,8,.1);color:#d9770...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="stat-icon" style="background:rgba(234,179,8,.1);color:#d9770...`. |
| `182` | `<i class="fas fa-user-tie"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-user-tie"></i>`. |
| `183` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `184` | `<div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div>`. |
| `185` | `<div class="fs-4 fw-bold"><?= $totalVoceros ?></div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="fs-4 fw-bold"><?= $totalVoceros ?></div>`. |
| `186` | `<div class="text-muted small">Voceros registrados</div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="text-muted small">Voceros registrados</div>`. |
| `187` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `188` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `189` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `190` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `191` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `192` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `193` | `<div class="mb-3">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="mb-3">`. |
| `194` | `<div class="input-group input-group-sm" style="max-width:320px;">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="input-group input-group-sm" style="max-width:320px;">`. |
| `195` | `<span class="input-group-text bg-white"><i class="fas fa-search text-mut...` | Instrucción de ejecución en el contexto del script: `<span class="input-group-text bg-white"><i class="fas fa-search text-mut...`. |
| `196` | `<input type="text" id="buscPrograma" class="form-control border-start-0"...` | Campo de entrada interactivo para datos del usuario: `<input type="text" id="buscPrograma" class="form-control border-start-0"...`. |
| `197` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `198` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `199` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `200` | `<div class="row g-3" id="gridProgramas">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="row g-3" id="gridProgramas">`. |
| `201` | `<?php foreach ($programas as $p):` | Instrucción de ejecución en el contexto del script: `<?php foreach ($programas as $p):`. |
| `202` | `// Contar voceros en este programa` | Comentario explicativo en el código: `Contar voceros en este programa`. |
| `203` | `$stmtVC = $db->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmtVC = $db->prepare(`. |
| `204` | `"SELECT COUNT(DISTINCT v.id_vocero) FROM voceros v` | Instrucción de ejecución en el contexto del script: `"SELECT COUNT(DISTINCT v.id_vocero) FROM voceros v`. |
| `205` | `JOIN fichas f ON f.id_ficha = v.id_ficha` | Instrucción de ejecución en el contexto del script: `JOIN fichas f ON f.id_ficha = v.id_ficha`. |
| `206` | `WHERE f.id_programa = :prog AND v.activo = 1"` | Instrucción de ejecución en el contexto del script: `WHERE f.id_programa = :prog AND v.activo = 1"`. |
| `207` | ``);`` | Cierre de estructura de arreglo o invocación de función. |
| `208` | `$stmtVC->execute([':prog' => $p['id_programa']]);` | Ejecuta la sentencia SQL preparada vinculando los parámetros correspondientes: `$stmtVC->execute([':prog' => $p['id_programa']]);`. |
| `209` | `$cntVoc = (int)$stmtVC->fetchColumn();` | Recupera el valor escalar de la primera columna del resultado de la consulta. |
| `210` | ``?>`` | Cierre de la etiqueta PHP para alternar a salida HTML o fin del archivo. |
| `211` | `<div class="col-md-6 col-lg-4 prog-item">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="col-md-6 col-lg-4 prog-item">`. |
| `212` | `<a href="admin_voceros.php?programa=<?= $p['id_programa'] ?>" class="tex...` | Instrucción de ejecución en el contexto del script: `<a href="admin_voceros.php?programa=<?= $p['id_programa'] ?>" class="tex...`. |
| `213` | `<div class="card border-0 shadow-sm h-100 prog-card" style="border-radiu...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="card border-0 shadow-sm h-100 prog-card" style="border-radiu...`. |
| `214` | `<div class="card-body p-4">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="card-body p-4">`. |
| `215` | `<div class="d-flex align-items-start justify-content-between mb-3">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="d-flex align-items-start justify-content-between mb-3">`. |
| `216` | `<div style="width:44px;height:44px;border-radius:10px;` | Contenedor visual estructurado con Bootstrap/CSS: `<div style="width:44px;height:44px;border-radius:10px;`. |
| `217` | `background:rgba(234,179,8,.1);color:#d97706;` | Instrucción de ejecución en el contexto del script: `background:rgba(234,179,8,.1);color:#d97706;`. |
| `218` | `display:flex;align-items:center;justify-content:center;font-size:1.2rem;">` | Instrucción de ejecución en el contexto del script: `display:flex;align-items:center;justify-content:center;font-size:1.2rem;">`. |
| `219` | `<i class="fas fa-user-tie"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-user-tie"></i>`. |
| `220` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `221` | `<span class="badge bg-light text-dark border" style="font-size:.72rem;">` | Instrucción de ejecución en el contexto del script: `<span class="badge bg-light text-dark border" style="font-size:.72rem;">`. |
| `222` | `<?= htmlspecialchars($p['nivel'] ?? 'Sin nivel') ?>` | Instrucción de ejecución en el contexto del script: `<?= htmlspecialchars($p['nivel'] ?? 'Sin nivel') ?>`. |
| `223` | `</span>` | Instrucción de ejecución en el contexto del script: `</span>`. |
| `224` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `225` | `<h6 class="fw-bold mb-3 text-dark" style="font-size:.88rem;line-height:1...` | Instrucción de ejecución en el contexto del script: `<h6 class="fw-bold mb-3 text-dark" style="font-size:.88rem;line-height:1...`. |
| `226` | `<?= htmlspecialchars($p['nombre']) ?>` | Instrucción de ejecución en el contexto del script: `<?= htmlspecialchars($p['nombre']) ?>`. |
| `227` | `</h6>` | Instrucción de ejecución en el contexto del script: `</h6>`. |
| `228` | `<div class="d-flex gap-3 pt-3" style="border-top:1px solid #e5e7eb;">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="d-flex gap-3 pt-3" style="border-top:1px solid #e5e7eb;">`. |
| `229` | `<div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div>`. |
| `230` | `<div class="fw-bold text-warning" style="font-size:1.3rem;"><?= $cntVoc ...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="fw-bold text-warning" style="font-size:1.3rem;"><?= $cntVoc ...`. |
| `231` | `<div class="text-muted" style="font-size:.72rem;">Voceros</div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="text-muted" style="font-size:.72rem;">Voceros</div>`. |
| `232` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `233` | `<div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div>`. |
| `234` | `<div class="fw-bold text-success" style="font-size:1.3rem;"><?= (int)$p[...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="fw-bold text-success" style="font-size:1.3rem;"><?= (int)$p[...`. |
| `235` | `<div class="text-muted" style="font-size:.72rem;">Fichas</div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="text-muted" style="font-size:.72rem;">Fichas</div>`. |
| `236` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `237` | `<div class="ms-auto d-flex align-items-center text-success" style="font-...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="ms-auto d-flex align-items-center text-success" style="font-...`. |
| `238` | `Ver fichas <i class="fas fa-arrow-right ms-1"></i>` | Instrucción de ejecución en el contexto del script: `Ver fichas <i class="fas fa-arrow-right ms-1"></i>`. |
| `239` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `240` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `241` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `242` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `243` | `</a>` | Instrucción de ejecución en el contexto del script: `</a>`. |
| `244` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `245` | `<?php endforeach; ?>` | Cierre de ciclo iterativo foreach embebido en la plantilla HTML. |
| `246` | `<?php if (empty($programas)): ?>` | Instrucción de ejecución en el contexto del script: `<?php if (empty($programas)): ?>`. |
| `247` | `<div class="col-12">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="col-12">`. |
| `248` | `<div class="card border-0 shadow-sm text-center py-5 text-muted">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="card border-0 shadow-sm text-center py-5 text-muted">`. |
| `249` | `<i class="fas fa-graduation-cap fa-3x mb-3 opacity-25 d-block"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-graduation-cap fa-3x mb-3 opacity-25 d-block"></i>`. |
| `250` | `No hay programas registrados.` | Instrucción de ejecución en el contexto del script: `No hay programas registrados.`. |
| `251` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `252` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `253` | `<?php endif; ?>` | Cierre de estructura condicional embebida en la plantilla HTML. |
| `254` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `255` | `<?php endif; ?>` | Cierre de estructura condicional embebida en la plantilla HTML. |
| `256` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `257` | `<!-- ══ NIVEL 1: FICHAS DEL PROGRAMA ═══════════════════════════════════...` | Instrucción de ejecución en el contexto del script: `<!-- ══ NIVEL 1: FICHAS DEL PROGRAMA ═══════════════════════════════════...`. |
| `258` | `<?php if ($vistaPrograma && !$vistaFicha): ?>` | Instrucción de ejecución en el contexto del script: `<?php if ($vistaPrograma && !$vistaFicha): ?>`. |
| `259` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `260` | ``<?php`` | Apertura obligatoria de la etiqueta PHP para ejecución del código del lado del servidor. |
| `261` | `$fichasConVocero    = count(array_filter($fichasDelProg, fn($f) => (int)...` | Instrucción de ejecución en el contexto del script: `$fichasConVocero    = count(array_filter($fichasDelProg, fn($f) => (int)...`. |
| `262` | `$fichasSinVocero    = count($fichasDelProg) - $fichasConVocero;` | Instrucción de ejecución en el contexto del script: `$fichasSinVocero    = count($fichasDelProg) - $fichasConVocero;`. |
| `263` | ``?>`` | Cierre de la etiqueta PHP para alternar a salida HTML o fin del archivo. |
| `264` | `<div class="row g-3 mb-4">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="row g-3 mb-4">`. |
| `265` | `<div class="col-sm-4">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="col-sm-4">`. |
| `266` | `<div class="stat-card bg-white">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="stat-card bg-white">`. |
| `267` | `<div class="d-flex align-items-center gap-3">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="d-flex align-items-center gap-3">`. |
| `268` | `<div class="stat-icon" style="background:rgba(37,99,235,.1);color:#2563e...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="stat-icon" style="background:rgba(37,99,235,.1);color:#2563e...`. |
| `269` | `<i class="fas fa-id-card"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-id-card"></i>`. |
| `270` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `271` | `<div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div>`. |
| `272` | `<div class="fs-4 fw-bold"><?= count($fichasDelProg) ?></div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="fs-4 fw-bold"><?= count($fichasDelProg) ?></div>`. |
| `273` | `<div class="text-muted small">Fichas en el programa</div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="text-muted small">Fichas en el programa</div>`. |
| `274` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `275` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `276` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `277` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `278` | `<div class="col-sm-4">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="col-sm-4">`. |
| `279` | `<div class="stat-card bg-white">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="stat-card bg-white">`. |
| `280` | `<div class="d-flex align-items-center gap-3">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="d-flex align-items-center gap-3">`. |
| `281` | `<div class="stat-icon" style="background:rgba(57,169,0,.12);color:#39a90...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="stat-icon" style="background:rgba(57,169,0,.12);color:#39a90...`. |
| `282` | `<i class="fas fa-check-circle"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-check-circle"></i>`. |
| `283` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `284` | `<div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div>`. |
| `285` | `<div class="fs-4 fw-bold"><?= $fichasConVocero ?></div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="fs-4 fw-bold"><?= $fichasConVocero ?></div>`. |
| `286` | `<div class="text-muted small">Fichas con vocero</div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="text-muted small">Fichas con vocero</div>`. |
| `287` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `288` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `289` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `290` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `291` | `<div class="col-sm-4">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="col-sm-4">`. |
| `292` | `<div class="stat-card bg-white">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="stat-card bg-white">`. |
| `293` | `<div class="d-flex align-items-center gap-3">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="d-flex align-items-center gap-3">`. |
| `294` | `<div class="stat-icon" style="background:rgba(239,68,68,.1);color:#ef444...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="stat-icon" style="background:rgba(239,68,68,.1);color:#ef444...`. |
| `295` | `<i class="fas fa-circle-xmark"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-circle-xmark"></i>`. |
| `296` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `297` | `<div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div>`. |
| `298` | `<div class="fs-4 fw-bold"><?= $fichasSinVocero ?></div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="fs-4 fw-bold"><?= $fichasSinVocero ?></div>`. |
| `299` | `<div class="text-muted small">Sin vocero asignado</div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="text-muted small">Sin vocero asignado</div>`. |
| `300` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `301` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `302` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `303` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `304` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `305` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `306` | `<div class="row g-3">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="row g-3">`. |
| `307` | `<?php foreach ($fichasDelProg as $f):` | Instrucción de ejecución en el contexto del script: `<?php foreach ($fichasDelProg as $f):`. |
| `308` | `$tieneVocero = (int)$f['tiene_vocero'] > 0;` | Instrucción de ejecución en el contexto del script: `$tieneVocero = (int)$f['tiene_vocero'] > 0;`. |
| `309` | ``?>`` | Cierre de la etiqueta PHP para alternar a salida HTML o fin del archivo. |
| `310` | `<div class="col-md-6 col-lg-4">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="col-md-6 col-lg-4">`. |
| `311` | `<a href="admin_voceros.php?ficha=<?= $f['id_ficha'] ?>" class="text-deco...` | Instrucción de ejecución en el contexto del script: `<a href="admin_voceros.php?ficha=<?= $f['id_ficha'] ?>" class="text-deco...`. |
| `312` | `<div class="card border-0 shadow-sm h-100 prog-card"` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="card border-0 shadow-sm h-100 prog-card"`. |
| `313` | `style="border-radius:12px; border-left:4px solid <?= $tieneVocero ? '#39...` | Instrucción de ejecución en el contexto del script: `style="border-radius:12px; border-left:4px solid <?= $tieneVocero ? '#39...`. |
| `314` | `<div class="card-body p-4">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="card-body p-4">`. |
| `315` | `<div class="d-flex align-items-start justify-content-between mb-3">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="d-flex align-items-start justify-content-between mb-3">`. |
| `316` | `<div style="width:44px;height:44px;border-radius:10px;` | Contenedor visual estructurado con Bootstrap/CSS: `<div style="width:44px;height:44px;border-radius:10px;`. |
| `317` | `background:<?= $tieneVocero ? 'rgba(57,169,0,.12)' : 'rgba(239,68,68,.1)...` | Instrucción de ejecución en el contexto del script: `background:<?= $tieneVocero ? 'rgba(57,169,0,.12)' : 'rgba(239,68,68,.1)...`. |
| `318` | `color:<?= $tieneVocero ? '#39a900' : '#ef4444' ?>;` | Instrucción de ejecución en el contexto del script: `color:<?= $tieneVocero ? '#39a900' : '#ef4444' ?>;`. |
| `319` | `display:flex;align-items:center;justify-content:center;font-size:1.1rem;">` | Instrucción de ejecución en el contexto del script: `display:flex;align-items:center;justify-content:center;font-size:1.1rem;">`. |
| `320` | `<i class="fas fa-<?= $tieneVocero ? 'user-tie' : 'user-slash' ?>"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-<?= $tieneVocero ? 'user-tie' : 'user-slash' ?>"></i>`. |
| `321` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `322` | `<span class="badge <?= $tieneVocero ? 'bg-success' : 'bg-danger' ?>">` | Instrucción de ejecución en el contexto del script: `<span class="badge <?= $tieneVocero ? 'bg-success' : 'bg-danger' ?>">`. |
| `323` | `<?= $tieneVocero ? 'Con vocero' : 'Sin vocero' ?>` | Instrucción de ejecución en el contexto del script: `<?= $tieneVocero ? 'Con vocero' : 'Sin vocero' ?>`. |
| `324` | `</span>` | Instrucción de ejecución en el contexto del script: `</span>`. |
| `325` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `326` | `<div class="fw-bold text-success font-monospace mb-1" style="font-size:1...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="fw-bold text-success font-monospace mb-1" style="font-size:1...`. |
| `327` | `<?= htmlspecialchars($f['numero_ficha']) ?>` | Instrucción de ejecución en el contexto del script: `<?= htmlspecialchars($f['numero_ficha']) ?>`. |
| `328` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `329` | `<div class="text-muted small mb-3">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="text-muted small mb-3">`. |
| `330` | `<?php if ($tieneVocero): ?>` | Instrucción de ejecución en el contexto del script: `<?php if ($tieneVocero): ?>`. |
| `331` | `<i class="fas fa-user-tie text-success me-1" style="font-size:.75rem;"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-user-tie text-success me-1" style="font-size:.75rem;"></i>`. |
| `332` | `<?= htmlspecialchars($f['vocero_nombres']) ?>` | Instrucción de ejecución en el contexto del script: `<?= htmlspecialchars($f['vocero_nombres']) ?>`. |
| `333` | `<?php else: ?>` | Instrucción de ejecución en el contexto del script: `<?php else: ?>`. |
| `334` | `<span class="text-danger"><i class="fas fa-exclamation-circle me-1"></i>...` | Instrucción de ejecución en el contexto del script: `<span class="text-danger"><i class="fas fa-exclamation-circle me-1"></i>...`. |
| `335` | `<?php endif; ?>` | Cierre de estructura condicional embebida en la plantilla HTML. |
| `336` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `337` | `<div class="d-flex gap-3 pt-3" style="border-top:1px solid #e5e7eb;">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="d-flex gap-3 pt-3" style="border-top:1px solid #e5e7eb;">`. |
| `338` | `<div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div>`. |
| `339` | `<div class="fw-bold text-muted" style="font-size:1rem;"><?= htmlspecialc...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="fw-bold text-muted" style="font-size:1rem;"><?= htmlspecialc...`. |
| `340` | `<div class="text-muted" style="font-size:.72rem;">Jornada</div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="text-muted" style="font-size:.72rem;">Jornada</div>`. |
| `341` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `342` | `<div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div>`. |
| `343` | `<div class="fw-bold" style="font-size:1rem;"><?= (int)$f['total_aprendic...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="fw-bold" style="font-size:1rem;"><?= (int)$f['total_aprendic...`. |
| `344` | `<div class="text-muted" style="font-size:.72rem;">Aprendices</div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="text-muted" style="font-size:.72rem;">Aprendices</div>`. |
| `345` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `346` | `<div class="ms-auto d-flex align-items-center text-success" style="font-...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="ms-auto d-flex align-items-center text-success" style="font-...`. |
| `347` | `Ver voceros <i class="fas fa-arrow-right ms-1"></i>` | Instrucción de ejecución en el contexto del script: `Ver voceros <i class="fas fa-arrow-right ms-1"></i>`. |
| `348` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `349` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `350` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `351` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `352` | `</a>` | Instrucción de ejecución en el contexto del script: `</a>`. |
| `353` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `354` | `<?php endforeach; ?>` | Cierre de ciclo iterativo foreach embebido en la plantilla HTML. |
| `355` | `<?php if (empty($fichasDelProg)): ?>` | Instrucción de ejecución en el contexto del script: `<?php if (empty($fichasDelProg)): ?>`. |
| `356` | `<div class="col-12">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="col-12">`. |
| `357` | `<div class="card border-0 shadow-sm text-center py-5 text-muted">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="card border-0 shadow-sm text-center py-5 text-muted">`. |
| `358` | `<i class="fas fa-id-card fa-3x mb-3 opacity-25 d-block"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-id-card fa-3x mb-3 opacity-25 d-block"></i>`. |
| `359` | `No hay fichas registradas en este programa.` | Instrucción de ejecución en el contexto del script: `No hay fichas registradas en este programa.`. |
| `360` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `361` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `362` | `<?php endif; ?>` | Cierre de estructura condicional embebida en la plantilla HTML. |
| `363` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `364` | `<?php endif; ?>` | Cierre de estructura condicional embebida en la plantilla HTML. |
| `365` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `366` | `<!-- ══ NIVEL 2: VOCEROS DE LA FICHA ═══════════════════════════════════...` | Instrucción de ejecución en el contexto del script: `<!-- ══ NIVEL 2: VOCEROS DE LA FICHA ═══════════════════════════════════...`. |
| `367` | `<?php if ($vistaFicha && $fichaAct): ?>` | Instrucción de ejecución en el contexto del script: `<?php if ($vistaFicha && $fichaAct): ?>`. |
| `368` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `369` | `<div class="row g-3 mb-4">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="row g-3 mb-4">`. |
| `370` | `<div class="col-sm-4">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="col-sm-4">`. |
| `371` | `<div class="stat-card bg-white">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="stat-card bg-white">`. |
| `372` | `<div class="d-flex align-items-center gap-3">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="d-flex align-items-center gap-3">`. |
| `373` | `<div class="stat-icon" style="background:rgba(234,179,8,.1);color:#d9770...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="stat-icon" style="background:rgba(234,179,8,.1);color:#d9770...`. |
| `374` | `<i class="fas fa-user-tie"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-user-tie"></i>`. |
| `375` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `376` | `<div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div>`. |
| `377` | `<div class="fs-4 fw-bold"><?= count($voceros) ?></div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="fs-4 fw-bold"><?= count($voceros) ?></div>`. |
| `378` | `<div class="text-muted small">Vocero(s) en la ficha</div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="text-muted small">Vocero(s) en la ficha</div>`. |
| `379` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `380` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `381` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `382` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `383` | `<div class="col-sm-4">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="col-sm-4">`. |
| `384` | `<div class="stat-card bg-white">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="stat-card bg-white">`. |
| `385` | `<div class="d-flex align-items-center gap-3">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="d-flex align-items-center gap-3">`. |
| `386` | `<div class="stat-icon" style="background:rgba(57,169,0,.12);color:#39a90...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="stat-icon" style="background:rgba(57,169,0,.12);color:#39a90...`. |
| `387` | `<i class="fas fa-check-circle"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-check-circle"></i>`. |
| `388` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `389` | `<div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div>`. |
| `390` | `<div class="fs-4 fw-bold">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="fs-4 fw-bold">`. |
| `391` | `<?= count(array_filter($voceros, fn($v) => !(int)$v['primer_acceso'])) ?>` | Instrucción de ejecución en el contexto del script: `<?= count(array_filter($voceros, fn($v) => !(int)$v['primer_acceso'])) ?>`. |
| `392` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `393` | `<div class="text-muted small">Con acceso activo</div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="text-muted small">Con acceso activo</div>`. |
| `394` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `395` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `396` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `397` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `398` | `<div class="col-sm-4">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="col-sm-4">`. |
| `399` | `<div class="stat-card bg-white">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="stat-card bg-white">`. |
| `400` | `<div class="d-flex align-items-center gap-3">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="d-flex align-items-center gap-3">`. |
| `401` | `<div class="stat-icon" style="background:rgba(239,68,68,.1);color:#ef444...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="stat-icon" style="background:rgba(239,68,68,.1);color:#ef444...`. |
| `402` | `<i class="fas fa-clock"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-clock"></i>`. |
| `403` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `404` | `<div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div>`. |
| `405` | `<div class="fs-4 fw-bold">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="fs-4 fw-bold">`. |
| `406` | `<?= count(array_filter($voceros, fn($v) => (int)$v['primer_acceso'])) ?>` | Instrucción de ejecución en el contexto del script: `<?= count(array_filter($voceros, fn($v) => (int)$v['primer_acceso'])) ?>`. |
| `407` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `408` | `<div class="text-muted small">Pendiente primer acceso</div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="text-muted small">Pendiente primer acceso</div>`. |
| `409` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `410` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `411` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `412` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `413` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `414` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `415` | `<div class="card shadow-sm border-0">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="card shadow-sm border-0">`. |
| `416` | `<div class="card-header bg-white border-0 py-3 d-flex justify-content-be...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="card-header bg-white border-0 py-3 d-flex justify-content-be...`. |
| `417` | `<h6 class="fw-bold mb-0">` | Instrucción de ejecución en el contexto del script: `<h6 class="fw-bold mb-0">`. |
| `418` | `<i class="fas fa-user-tie text-success me-2"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-user-tie text-success me-2"></i>`. |
| `419` | `Voceros de la Ficha` | Instrucción de ejecución en el contexto del script: `Voceros de la Ficha`. |
| `420` | `<span class="text-muted fw-normal small ms-2">— <?= htmlspecialchars($fi...` | Instrucción de ejecución en el contexto del script: `<span class="text-muted fw-normal small ms-2">— <?= htmlspecialchars($fi...`. |
| `421` | `</h6>` | Instrucción de ejecución en el contexto del script: `</h6>`. |
| `422` | `<div class="d-flex gap-2 align-items-center">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="d-flex gap-2 align-items-center">`. |
| `423` | `<span class="badge bg-success"><?= count($voceros) ?> vocero(s)</span>` | Instrucción de ejecución en el contexto del script: `<span class="badge bg-success"><?= count($voceros) ?> vocero(s)</span>`. |
| `424` | `<form method="GET" class="d-flex gap-1">` | Formulario interactivo para captura y envío de datos: `<form method="GET" class="d-flex gap-1">`. |
| `425` | `<input type="hidden" name="ficha" value="<?= $vistaFicha ?>">` | Campo de entrada interactivo para datos del usuario: `<input type="hidden" name="ficha" value="<?= $vistaFicha ?>">`. |
| `426` | `<div class="input-group input-group-sm" style="max-width:220px;">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="input-group input-group-sm" style="max-width:220px;">`. |
| `427` | `<span class="input-group-text bg-white"><i class="fas fa-search text-mut...` | Instrucción de ejecución en el contexto del script: `<span class="input-group-text bg-white"><i class="fas fa-search text-mut...`. |
| `428` | `<input type="text" name="q" class="form-control border-start-0"` | Campo de entrada interactivo para datos del usuario: `<input type="text" name="q" class="form-control border-start-0"`. |
| `429` | `placeholder="Buscar…" value="<?= htmlspecialchars($busqueda) ?>">` | Instrucción de ejecución en el contexto del script: `placeholder="Buscar…" value="<?= htmlspecialchars($busqueda) ?>">`. |
| `430` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `431` | `<button type="submit" class="btn btn-sm btn-success"><i class="fas fa-se...` | Botón de acción interactivo para el usuario: `<button type="submit" class="btn btn-sm btn-success"><i class="fas fa-se...`. |
| `432` | `<?php if ($busqueda): ?>` | Instrucción de ejecución en el contexto del script: `<?php if ($busqueda): ?>`. |
| `433` | `<a href="admin_voceros.php?ficha=<?= $vistaFicha ?>"` | Instrucción de ejecución en el contexto del script: `<a href="admin_voceros.php?ficha=<?= $vistaFicha ?>"`. |
| `434` | `class="btn btn-sm btn-outline-secondary"><i class="fas fa-xmark"></i></a>` | Instrucción de ejecución en el contexto del script: `class="btn btn-sm btn-outline-secondary"><i class="fas fa-xmark"></i></a>`. |
| `435` | `<?php endif; ?>` | Cierre de estructura condicional embebida en la plantilla HTML. |
| `436` | ``</form>`` | Cierre de formulario interactivo. |
| `437` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `438` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `439` | `<div class="card-body p-0">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="card-body p-0">`. |
| `440` | `<?php if (empty($voceros)): ?>` | Instrucción de ejecución en el contexto del script: `<?php if (empty($voceros)): ?>`. |
| `441` | `<div class="text-center py-5 text-muted">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="text-center py-5 text-muted">`. |
| `442` | `<i class="fas fa-user-tie fa-3x mb-3 opacity-25 d-block"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-user-tie fa-3x mb-3 opacity-25 d-block"></i>`. |
| `443` | `<p class="small mb-0">` | Instrucción de ejecución en el contexto del script: `<p class="small mb-0">`. |
| `444` | `<?= $busqueda` | Instrucción de ejecución en el contexto del script: `<?= $busqueda`. |
| `445` | `? 'No hay resultados para "' . htmlspecialchars($busqueda) . '".'` | Instrucción de ejecución en el contexto del script: `? 'No hay resultados para "' . htmlspecialchars($busqueda) . '".'`. |
| `446` | `: 'No hay voceros asignados a esta ficha.' ?>` | Instrucción de ejecución en el contexto del script: `: 'No hay voceros asignados a esta ficha.' ?>`. |
| `447` | `</p>` | Instrucción de ejecución en el contexto del script: `</p>`. |
| `448` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `449` | `<?php else: ?>` | Instrucción de ejecución en el contexto del script: `<?php else: ?>`. |
| `450` | `<div class="table-responsive">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="table-responsive">`. |
| `451` | `<table class="table tabla-limpia align-middle mb-0">` | Tabla de datos para despliegue estructurado de información. |
| `452` | `<thead class="table-light">` | Definición de estructura semántica de cabecera o cuerpo de tabla. |
| `453` | ``<tr>`` | Fila contenedora de datos dentro de la tabla. |
| `454` | `<th>Nombre Completo</th>` | Celda de encabezado de columna: `<th>Nombre Completo</th>`. |
| `455` | `<th>Documento</th>` | Celda de encabezado de columna: `<th>Documento</th>`. |
| `456` | `<th>Celular</th>` | Celda de encabezado de columna: `<th>Celular</th>`. |
| `457` | `<th>Correo</th>` | Celda de encabezado de columna: `<th>Correo</th>`. |
| `458` | `<th>Acceso</th>` | Celda de encabezado de columna: `<th>Acceso</th>`. |
| `459` | `<th class="text-center">Acciones</th>` | Celda de encabezado de columna: `<th class="text-center">Acciones</th>`. |
| `460` | ``</tr>`` | Cierre de fila contenedora de tabla. |
| `461` | `</thead>` | Definición de estructura semántica de cabecera o cuerpo de tabla. |
| `462` | `<tbody>` | Definición de estructura semántica de cabecera o cuerpo de tabla. |
| `463` | `<?php foreach ($voceros as $v): ?>` | Instrucción de ejecución en el contexto del script: `<?php foreach ($voceros as $v): ?>`. |
| `464` | ``<tr>`` | Fila contenedora de datos dentro de la tabla. |
| `465` | `<td>` | Celda de contenido de tabla: `<td>`. |
| `466` | `<div class="fw-semibold small">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="fw-semibold small">`. |
| `467` | `<?= htmlspecialchars($v['apellidos'] . ', ' . $v['nombres']) ?>` | Instrucción de ejecución en el contexto del script: `<?= htmlspecialchars($v['apellidos'] . ', ' . $v['nombres']) ?>`. |
| `468` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `469` | `</td>` | Instrucción de ejecución en el contexto del script: `</td>`. |
| `470` | `<td class="small text-muted"><?= htmlspecialchars($v['documento'] ?? '—'...` | Celda de contenido de tabla: `<td class="small text-muted"><?= htmlspecialchars($v['documento'] ?? '—'...`. |
| `471` | `<td class="small"><?= htmlspecialchars($v['celular'] ?? '—') ?></td>` | Celda de contenido de tabla: `<td class="small"><?= htmlspecialchars($v['celular'] ?? '—') ?></td>`. |
| `472` | `<td class="small text-muted"><?= htmlspecialchars($v['correo']) ?></td>` | Celda de contenido de tabla: `<td class="small text-muted"><?= htmlspecialchars($v['correo']) ?></td>`. |
| `473` | `<td>` | Celda de contenido de tabla: `<td>`. |
| `474` | `<?php if ((int)$v['primer_acceso']): ?>` | Instrucción de ejecución en el contexto del script: `<?php if ((int)$v['primer_acceso']): ?>`. |
| `475` | `<span class="badge bg-warning text-dark">` | Instrucción de ejecución en el contexto del script: `<span class="badge bg-warning text-dark">`. |
| `476` | `<i class="fas fa-clock me-1"></i>Pendiente` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-clock me-1"></i>Pendiente`. |
| `477` | `</span>` | Instrucción de ejecución en el contexto del script: `</span>`. |
| `478` | `<?php else: ?>` | Instrucción de ejecución en el contexto del script: `<?php else: ?>`. |
| `479` | `<span class="badge bg-success">` | Instrucción de ejecución en el contexto del script: `<span class="badge bg-success">`. |
| `480` | `<i class="fas fa-check me-1"></i>Activo` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-check me-1"></i>Activo`. |
| `481` | `</span>` | Instrucción de ejecución en el contexto del script: `</span>`. |
| `482` | `<?php endif; ?>` | Cierre de estructura condicional embebida en la plantilla HTML. |
| `483` | `</td>` | Instrucción de ejecución en el contexto del script: `</td>`. |
| `484` | `<td class="text-center">` | Celda de contenido de tabla: `<td class="text-center">`. |
| `485` | `<form action="../../controllers/AdminController.php" method="POST"` | Formulario interactivo para captura y envío de datos: `<form action="../../controllers/AdminController.php" method="POST"`. |
| `486` | `class="d-inline form-credenciales"` | Instrucción de ejecución en el contexto del script: `class="d-inline form-credenciales"`. |
| `487` | `id="form-cred-<?= $v['id_vocero'] ?>">` | Instrucción de ejecución en el contexto del script: `id="form-cred-<?= $v['id_vocero'] ?>">`. |
| `488` | `<input type="hidden" name="accion"    value="reenviar_credenciales">` | Campo de entrada interactivo para datos del usuario: `<input type="hidden" name="accion"    value="reenviar_credenciales">`. |
| `489` | `<input type="hidden" name="id_vocero" value="<?= $v['id_vocero'] ?>">` | Campo de entrada interactivo para datos del usuario: `<input type="hidden" name="id_vocero" value="<?= $v['id_vocero'] ?>">`. |
| `490` | `<button type="button" class="btn btn-sm btn-outline-warning"` | Botón de acción interactivo para el usuario: `<button type="button" class="btn btn-sm btn-outline-warning"`. |
| `491` | `onclick="confirmarCredenciales(<?= $v['id_vocero'] ?>, '<?= addslashes($...` | Instrucción de ejecución en el contexto del script: `onclick="confirmarCredenciales(<?= $v['id_vocero'] ?>, '<?= addslashes($...`. |
| `492` | `title="Reenviar credenciales">` | Instrucción de ejecución en el contexto del script: `title="Reenviar credenciales">`. |
| `493` | `<i class="fas fa-key me-1"></i>Credenciales` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-key me-1"></i>Credenciales`. |
| `494` | `</button>` | Instrucción de ejecución en el contexto del script: `</button>`. |
| `495` | ``</form>`` | Cierre de formulario interactivo. |
| `496` | `</td>` | Instrucción de ejecución en el contexto del script: `</td>`. |
| `497` | ``</tr>`` | Cierre de fila contenedora de tabla. |
| `498` | `<?php endforeach; ?>` | Cierre de ciclo iterativo foreach embebido en la plantilla HTML. |
| `499` | `</tbody>` | Definición de estructura semántica de cabecera o cuerpo de tabla. |
| `500` | ``</table>`` | Cierre de tabla de datos. |
| `501` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `502` | `<?php endif; ?>` | Cierre de estructura condicional embebida en la plantilla HTML. |
| `503` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `504` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `505` | `<?php endif; ?>` | Cierre de estructura condicional embebida en la plantilla HTML. |
| `506` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `507` | `<!-- ══ ESTILOS + JS ═══════════════════════════════════════════════════...` | Instrucción de ejecución en el contexto del script: `<!-- ══ ESTILOS + JS ═══════════════════════════════════════════════════...`. |
| `508` | ``<style>`` | Bloque de estilos CSS personalizados para la interfaz. |
| `509` | `.prog-card { transition: transform .2s, box-shadow .2s; cursor: pointer; }` | Instrucción de ejecución en el contexto del script: `.prog-card { transition: transform .2s, box-shadow .2s; cursor: pointer; }`. |
| `510` | `.prog-card:hover { transform: translateY(-3px); box-shadow: 0 8px 24px r...` | Instrucción de ejecución en el contexto del script: `.prog-card:hover { transform: translateY(-3px); box-shadow: 0 8px 24px r...`. |
| `511` | `.breadcrumb-item + .breadcrumb-item::before { color: #9ca3af; }` | Instrucción de ejecución en el contexto del script: `.breadcrumb-item + .breadcrumb-item::before { color: #9ca3af; }`. |
| `512` | ``</style>`` | Cierre de bloque de estilos CSS. |
| `513` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `514` | ``<script>`` | Bloque o etiqueta de vinculación para scripts JavaScript del lado del cliente. |
| `515` | `const bP = document.getElementById('buscPrograma');` | Instrucción de ejecución en el contexto del script: `const bP = document.getElementById('buscPrograma');`. |
| `516` | `if (bP) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (bP) {`. |
| `517` | `bP.addEventListener('input', function () {` | Registra un escucha de eventos del DOM para interactividad en tiempo real: `bP.addEventListener('input', function () {`. |
| `518` | `const q = this.value.toLowerCase();` | Instrucción de ejecución en el contexto del script: `const q = this.value.toLowerCase();`. |
| `519` | `document.querySelectorAll('.prog-item').forEach(el => {` | Instrucción de ejecución en el contexto del script: `document.querySelectorAll('.prog-item').forEach(el => {`. |
| `520` | `el.style.display = !q \|\| el.textContent.toLowerCase().includes(q) ? ''...` | Instrucción de ejecución en el contexto del script: `el.style.display = !q \|\| el.textContent.toLowerCase().includes(q) ? ''...`. |
| `521` | `});` | Instrucción de ejecución en el contexto del script: `});`. |
| `522` | `});` | Instrucción de ejecución en el contexto del script: `});`. |
| `523` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `524` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `525` | `function confirmarCredenciales(idVocero, nombre) {` | Instrucción de ejecución en el contexto del script: `function confirmarCredenciales(idVocero, nombre) {`. |
| `526` | `Swal.fire({` | Despliega una alerta modal estética e interactiva con SweetAlert2. |
| `527` | `title: '¿Reenviar credenciales?',` | Instrucción de ejecución en el contexto del script: `title: '¿Reenviar credenciales?',`. |
| `528` | `text:  'Se generará una nueva contraseña temporal para ' + nombre + ' y ...` | Instrucción de ejecución en el contexto del script: `text:  'Se generará una nueva contraseña temporal para ' + nombre + ' y ...`. |
| `529` | `icon:  'question',` | Instrucción de ejecución en el contexto del script: `icon:  'question',`. |
| `530` | `showCancelButton:   true,` | Instrucción de ejecución en el contexto del script: `showCancelButton:   true,`. |
| `531` | `confirmButtonText:  'Sí, reenviar',` | Instrucción de ejecución en el contexto del script: `confirmButtonText:  'Sí, reenviar',`. |
| `532` | `cancelButtonText:   'Cancelar',` | Instrucción de ejecución en el contexto del script: `cancelButtonText:   'Cancelar',`. |
| `533` | `confirmButtonColor: '#39a900',` | Instrucción de ejecución en el contexto del script: `confirmButtonColor: '#39a900',`. |
| `534` | `cancelButtonColor:  '#6b7280',` | Instrucción de ejecución en el contexto del script: `cancelButtonColor:  '#6b7280',`. |
| `535` | `}).then(function(result) {` | Instrucción de ejecución en el contexto del script: `}).then(function(result) {`. |
| `536` | `if (result.isConfirmed) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (result.isConfirmed) {`. |
| `537` | `document.getElementById('form-cred-' + idVocero).submit();` | Instrucción de ejecución en el contexto del script: `document.getElementById('form-cred-' + idVocero).submit();`. |
| `538` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `539` | `});` | Instrucción de ejecución en el contexto del script: `});`. |
| `540` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `541` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `542` | `<?php if ($alert): ?>` | Instrucción de ejecución en el contexto del script: `<?php if ($alert): ?>`. |
| `543` | `document.addEventListener('DOMContentLoaded', function () {` | Registra un escucha de eventos del DOM para interactividad en tiempo real: `document.addEventListener('DOMContentLoaded', function () {`. |
| `544` | `Swal.fire({ icon:'<?= addslashes($alert['icon']) ?>', title:'<?= addslas...` | Despliega una alerta modal estética e interactiva con SweetAlert2. |
| `545` | `});` | Instrucción de ejecución en el contexto del script: `});`. |
| `546` | `<?php endif; ?>` | Cierre de estructura condicional embebida en la plantilla HTML. |
| `547` | ``</script>`` | Cierre de bloque de script JavaScript. |
| `548` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `549` | `<?php require_once __DIR__ . '/../layouts/footer.php'; ?>` | Importación e inclusión obligatoria del archivo de dependencia requerido: `<?php require_once __DIR__ . '/../layouts/footer.php'; ?>`. |

---

## 3. Resumen y Flujo de Interacción

El archivo `admin_voceros.php` cumple un rol indispensable en `views/dashboard/admin_voceros.php`. 
Panel de control y auditoría de los aprendices designados como voceros principales de las fichas. Garantiza la robustez, el orden y la estabilidad de la arquitectura del proyecto `systemLimpieza`.

---

Generado automáticamente para el repositorio [johanrepizo/LimpiezaDeModulos](https://github.com/johanrepizo/LimpiezaDeModulos).
