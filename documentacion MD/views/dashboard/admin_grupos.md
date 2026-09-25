# Documentación Línea por Línea: `views/dashboard/admin_grupos.php`

## 1. Ficha Técnica del Archivo

- **Archivo:** `admin_grupos.php`
- **Ruta en el proyecto:** `views/dashboard/admin_grupos.php`
- **Cantidad total de líneas:** `481`
- **Tipo de archivo:** `PHP`
- **Propósito general:** Vista administrativa para supervisar la conformación de grupos de limpieza y aprendices asignados.

---

## 2. Explicación Detallada Línea por Línea

A continuación se presenta cada línea de código numerada de forma consecutiva, acompañada de su fragmento exacto y la explicación exhaustiva de su funcionamiento y responsabilidad en el sistema:

| Línea | Código Fuente | Explicación Detallada |
|---|---|---|
| `1` | ``<?php`` | Apertura obligatoria de la etiqueta PHP para ejecución del código del lado del servidor. |
| `2` | `$titulo = 'Grupos de Limpieza';` | Instrucción de ejecución en el contexto del script: `$titulo = 'Grupos de Limpieza';`. |
| `3` | `if (session_status() === PHP_SESSION_NONE) session_start();` | Inicia o reanuda la sesión PHP del usuario si no se encontraba activa previamente. |
| `4` | `if (!isset($_SESSION['usuario']) \|\| (int)$_SESSION['usuario']['rol'] !...` | Verifica autenticación y rol del usuario; redirige al login si no tiene permisos. |
| `5` | `header("Location: ../usuarios/login.php"); exit;` | Emite cabecera HTTP de redirección en el navegador y detiene la ejecución: `header("Location: ../usuarios/login.php"); exit;`. |
| `6` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `7` | `require_once __DIR__ . '/../../config/database.php';` | Importación e inclusión obligatoria del archivo de dependencia requerido: `require_once __DIR__ . '/../../config/database.php';`. |
| `8` | `require_once __DIR__ . '/../../models/Grupo.php';` | Importación e inclusión obligatoria del archivo de dependencia requerido: `require_once __DIR__ . '/../../models/Grupo.php';`. |
| `9` | `require_once __DIR__ . '/../../models/Programa.php';` | Importación e inclusión obligatoria del archivo de dependencia requerido: `require_once __DIR__ . '/../../models/Programa.php';`. |
| `10` | `require_once __DIR__ . '/../../models/Ficha.php';` | Importación e inclusión obligatoria del archivo de dependencia requerido: `require_once __DIR__ . '/../../models/Ficha.php';`. |
| `11` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `12` | `$db        = (new Database())->conectar();` | Instrucción de ejecución en el contexto del script: `$db        = (new Database())->conectar();`. |
| `13` | `$alert     = $_SESSION['alert'] ?? null;` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección. |
| `14` | `unset($_SESSION['alert']);` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección. |
| `15` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `16` | `$modelProg = new Programa($db);` | Instrucción de ejecución en el contexto del script: `$modelProg = new Programa($db);`. |
| `17` | `$modelFich = new Ficha($db);` | Instrucción de ejecución en el contexto del script: `$modelFich = new Ficha($db);`. |
| `18` | `$modelGrup = new Grupo($db);` | Instrucción de ejecución en el contexto del script: `$modelGrup = new Grupo($db);`. |
| `19` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `20` | `$vistaPrograma = (int)($_GET['programa'] ?? 0);` | Instrucción de ejecución en el contexto del script: `$vistaPrograma = (int)($_GET['programa'] ?? 0);`. |
| `21` | `$vistaFicha    = (int)($_GET['ficha']    ?? 0);` | Instrucción de ejecución en el contexto del script: `$vistaFicha    = (int)($_GET['ficha']    ?? 0);`. |
| `22` | `$busqueda      = trim($_GET['q']         ?? '');` | Instrucción de ejecución en el contexto del script: `$busqueda      = trim($_GET['q']         ?? '');`. |
| `23` | `$filtroEstado  = trim($_GET['estado']    ?? '');` | Instrucción de ejecución en el contexto del script: `$filtroEstado  = trim($_GET['estado']    ?? '');`. |
| `24` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `25` | `// Nivel 0: todos los programas` | Comentario explicativo en el código: `Nivel 0: todos los programas`. |
| `26` | `$programas = $modelProg->obtenerTodos();` | Instrucción de ejecución en el contexto del script: `$programas = $modelProg->obtenerTodos();`. |
| `27` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `28` | `// Nivel 1: fichas del programa` | Comentario explicativo en el código: `Nivel 1: fichas del programa`. |
| `29` | `$programaAct   = null;` | Instrucción de ejecución en el contexto del script: `$programaAct   = null;`. |
| `30` | `$fichasDelProg = [];` | Instrucción de ejecución en el contexto del script: `$fichasDelProg = [];`. |
| `31` | `if ($vistaPrograma) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if ($vistaPrograma) {`. |
| `32` | `$programaAct = $modelProg->obtenerPorId($vistaPrograma);` | Instrucción de ejecución en el contexto del script: `$programaAct = $modelProg->obtenerPorId($vistaPrograma);`. |
| `33` | `$stmtF = $db->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmtF = $db->prepare(`. |
| `34` | `"SELECT f.*,` | Instrucción de ejecución en el contexto del script: `"SELECT f.*,`. |
| `35` | `ANY_VALUE(v.nombres)   AS vocero_nombres,` | Instrucción de ejecución en el contexto del script: `ANY_VALUE(v.nombres)   AS vocero_nombres,`. |
| `36` | `ANY_VALUE(v.apellidos) AS vocero_apellidos,` | Instrucción de ejecución en el contexto del script: `ANY_VALUE(v.apellidos) AS vocero_apellidos,`. |
| `37` | `COUNT(DISTINCT g.id_grupo) AS total_grupos,` | Instrucción de ejecución en el contexto del script: `COUNT(DISTINCT g.id_grupo) AS total_grupos,`. |
| `38` | `COUNT(DISTINCT ap.id_aprendiz) AS total_aprendices` | Instrucción de ejecución en el contexto del script: `COUNT(DISTINCT ap.id_aprendiz) AS total_aprendices`. |
| `39` | `FROM fichas f` | Instrucción de ejecución en el contexto del script: `FROM fichas f`. |
| `40` | `LEFT JOIN voceros    v  ON v.id_ficha  = f.id_ficha AND v.activo = 1` | Instrucción de ejecución en el contexto del script: `LEFT JOIN voceros    v  ON v.id_ficha  = f.id_ficha AND v.activo = 1`. |
| `41` | `LEFT JOIN grupos     g  ON g.id_vocero = v.id_vocero` | Instrucción de ejecución en el contexto del script: `LEFT JOIN grupos     g  ON g.id_vocero = v.id_vocero`. |
| `42` | `LEFT JOIN aprendices ap ON ap.id_ficha = f.id_ficha AND ap.activo = 1` | Instrucción de ejecución en el contexto del script: `LEFT JOIN aprendices ap ON ap.id_ficha = f.id_ficha AND ap.activo = 1`. |
| `43` | `WHERE f.id_programa = :prog AND f.activo = 1` | Instrucción de ejecución en el contexto del script: `WHERE f.id_programa = :prog AND f.activo = 1`. |
| `44` | `GROUP BY f.id_ficha` | Instrucción de ejecución en el contexto del script: `GROUP BY f.id_ficha`. |
| `45` | `ORDER BY f.numero_ficha"` | Instrucción de ejecución en el contexto del script: `ORDER BY f.numero_ficha"`. |
| `46` | ``);`` | Cierre de estructura de arreglo o invocación de función. |
| `47` | `$stmtF->execute([':prog' => $vistaPrograma]);` | Ejecuta la sentencia SQL preparada vinculando los parámetros correspondientes: `$stmtF->execute([':prog' => $vistaPrograma]);`. |
| `48` | `$fichasDelProg = $stmtF->fetchAll(PDO::FETCH_ASSOC);` | Obtiene todos los registros coincidentes de la consulta en un arreglo asociativo. |
| `49` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `50` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `51` | `// Nivel 2: grupos de la ficha` | Comentario explicativo en el código: `Nivel 2: grupos de la ficha`. |
| `52` | `$fichaAct = null;` | Instrucción de ejecución en el contexto del script: `$fichaAct = null;`. |
| `53` | `$grupos   = [];` | Instrucción de ejecución en el contexto del script: `$grupos   = [];`. |
| `54` | `if ($vistaFicha) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if ($vistaFicha) {`. |
| `55` | `$fichaAct = $modelFich->obtenerPorId($vistaFicha);` | Instrucción de ejecución en el contexto del script: `$fichaAct = $modelFich->obtenerPorId($vistaFicha);`. |
| `56` | `if ($fichaAct) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if ($fichaAct) {`. |
| `57` | `$vistaPrograma = (int)$fichaAct['id_programa'];` | Instrucción de ejecución en el contexto del script: `$vistaPrograma = (int)$fichaAct['id_programa'];`. |
| `58` | `$programaAct   = $modelProg->obtenerPorId($vistaPrograma);` | Instrucción de ejecución en el contexto del script: `$programaAct   = $modelProg->obtenerPorId($vistaPrograma);`. |
| `59` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `60` | `$stmtF2 = $db->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmtF2 = $db->prepare(`. |
| `61` | `"SELECT f.*,` | Instrucción de ejecución en el contexto del script: `"SELECT f.*,`. |
| `62` | `ANY_VALUE(v.nombres) AS vocero_nombres,` | Instrucción de ejecución en el contexto del script: `ANY_VALUE(v.nombres) AS vocero_nombres,`. |
| `63` | `COUNT(DISTINCT g.id_grupo) AS total_grupos` | Instrucción de ejecución en el contexto del script: `COUNT(DISTINCT g.id_grupo) AS total_grupos`. |
| `64` | `FROM fichas f` | Instrucción de ejecución en el contexto del script: `FROM fichas f`. |
| `65` | `LEFT JOIN voceros v ON v.id_ficha = f.id_ficha AND v.activo = 1` | Instrucción de ejecución en el contexto del script: `LEFT JOIN voceros v ON v.id_ficha = f.id_ficha AND v.activo = 1`. |
| `66` | `LEFT JOIN grupos  g ON g.id_vocero = v.id_vocero` | Instrucción de ejecución en el contexto del script: `LEFT JOIN grupos  g ON g.id_vocero = v.id_vocero`. |
| `67` | `WHERE f.id_programa = :prog AND f.activo = 1` | Instrucción de ejecución en el contexto del script: `WHERE f.id_programa = :prog AND f.activo = 1`. |
| `68` | `GROUP BY f.id_ficha ORDER BY f.numero_ficha"` | Instrucción de ejecución en el contexto del script: `GROUP BY f.id_ficha ORDER BY f.numero_ficha"`. |
| `69` | ``);`` | Cierre de estructura de arreglo o invocación de función. |
| `70` | `$stmtF2->execute([':prog' => $vistaPrograma]);` | Ejecuta la sentencia SQL preparada vinculando los parámetros correspondientes: `$stmtF2->execute([':prog' => $vistaPrograma]);`. |
| `71` | `$fichasDelProg = $stmtF2->fetchAll(PDO::FETCH_ASSOC);` | Obtiene todos los registros coincidentes de la consulta en un arreglo asociativo. |
| `72` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `73` | `// Todos los grupos de la ficha ordenados por id_grupo ASC` | Comentario explicativo en el código: `Todos los grupos de la ficha ordenados por id_grupo ASC`. |
| `74` | `$stmtG = $db->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmtG = $db->prepare(`. |
| `75` | `"SELECT g.*,` | Instrucción de ejecución en el contexto del script: `"SELECT g.*,`. |
| `76` | `m.nombre  AS nombre_modulo,` | Instrucción de ejecución en el contexto del script: `m.nombre  AS nombre_modulo,`. |
| `77` | `f.numero_ficha,` | Instrucción de ejecución en el contexto del script: `f.numero_ficha,`. |
| `78` | `v.nombres AS vocero_nombres, v.apellidos AS vocero_apellidos,` | Instrucción de ejecución en el contexto del script: `v.nombres AS vocero_nombres, v.apellidos AS vocero_apellidos,`. |
| `79` | `(SELECT COUNT(*) FROM evidencias e WHERE e.id_grupo = g.id_grupo) AS tie...` | Instrucción de ejecución en el contexto del script: `(SELECT COUNT(*) FROM evidencias e WHERE e.id_grupo = g.id_grupo) AS tie...`. |
| `80` | `(SELECT COUNT(*) FROM grupo_integrantes gi WHERE gi.id_grupo = g.id_grup...` | Instrucción de ejecución en el contexto del script: `(SELECT COUNT(*) FROM grupo_integrantes gi WHERE gi.id_grupo = g.id_grup...`. |
| `81` | `FROM grupos g` | Instrucción de ejecución en el contexto del script: `FROM grupos g`. |
| `82` | `JOIN asignaciones a ON a.id_asignacion = g.id_asignacion` | Instrucción de ejecución en el contexto del script: `JOIN asignaciones a ON a.id_asignacion = g.id_asignacion`. |
| `83` | `JOIN modulos      m ON m.id_modulo     = a.id_modulo` | Instrucción de ejecución en el contexto del script: `JOIN modulos      m ON m.id_modulo     = a.id_modulo`. |
| `84` | `JOIN fichas       f ON f.id_ficha      = a.id_ficha` | Instrucción de ejecución en el contexto del script: `JOIN fichas       f ON f.id_ficha      = a.id_ficha`. |
| `85` | `JOIN voceros      v ON v.id_vocero     = g.id_vocero` | Instrucción de ejecución en el contexto del script: `JOIN voceros      v ON v.id_vocero     = g.id_vocero`. |
| `86` | `WHERE a.id_ficha = :fic` | Instrucción de ejecución en el contexto del script: `WHERE a.id_ficha = :fic`. |
| `87` | `ORDER BY g.id_grupo ASC"` | Instrucción de ejecución en el contexto del script: `ORDER BY g.id_grupo ASC"`. |
| `88` | ``);`` | Cierre de estructura de arreglo o invocación de función. |
| `89` | `$stmtG->execute([':fic' => $vistaFicha]);` | Ejecuta la sentencia SQL preparada vinculando los parámetros correspondientes: `$stmtG->execute([':fic' => $vistaFicha]);`. |
| `90` | `$grupos = $stmtG->fetchAll(PDO::FETCH_ASSOC);` | Obtiene todos los registros coincidentes de la consulta en un arreglo asociativo. |
| `91` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `92` | `// Cargar integrantes de todos los grupos de una sola vez` | Comentario explicativo en el código: `Cargar integrantes de todos los grupos de una sola vez`. |
| `93` | `$integrantesPorGrupo = [];` | Instrucción de ejecución en el contexto del script: `$integrantesPorGrupo = [];`. |
| `94` | `if (!empty($grupos)) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (!empty($grupos)) {`. |
| `95` | `$ids = implode(',', array_column($grupos, 'id_grupo'));` | Instrucción de ejecución en el contexto del script: `$ids = implode(',', array_column($grupos, 'id_grupo'));`. |
| `96` | `$stmtI = $db->query(` | Instrucción de ejecución en el contexto del script: `$stmtI = $db->query(`. |
| `97` | `"SELECT gi.id_grupo, ap.apellidos, ap.nombres, ap.documento, ap.celular,...` | Instrucción de ejecución en el contexto del script: `"SELECT gi.id_grupo, ap.apellidos, ap.nombres, ap.documento, ap.celular,...`. |
| `98` | `FROM grupo_integrantes gi` | Instrucción de ejecución en el contexto del script: `FROM grupo_integrantes gi`. |
| `99` | `JOIN aprendices ap ON ap.id_aprendiz = gi.id_aprendiz` | Instrucción de ejecución en el contexto del script: `JOIN aprendices ap ON ap.id_aprendiz = gi.id_aprendiz`. |
| `100` | `WHERE gi.id_grupo IN ($ids)` | Instrucción de ejecución en el contexto del script: `WHERE gi.id_grupo IN ($ids)`. |
| `101` | `ORDER BY gi.id_grupo ASC, ap.apellidos ASC"` | Instrucción de ejecución en el contexto del script: `ORDER BY gi.id_grupo ASC, ap.apellidos ASC"`. |
| `102` | ``);`` | Cierre de estructura de arreglo o invocación de función. |
| `103` | `foreach ($stmtI->fetchAll(PDO::FETCH_ASSOC) as $row) {` | Estructura de control iterativa para recorrer colecciones o arreglos: `foreach ($stmtI->fetchAll(PDO::FETCH_ASSOC) as $row) {`. |
| `104` | `$integrantesPorGrupo[(int)$row['id_grupo']][] = $row;` | Instrucción de ejecución en el contexto del script: `$integrantesPorGrupo[(int)$row['id_grupo']][] = $row;`. |
| `105` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `106` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `107` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `108` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `109` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `110` | `require_once __DIR__ . '/../layouts/header.php';` | Importación e inclusión obligatoria del archivo de dependencia requerido: `require_once __DIR__ . '/../layouts/header.php';`. |
| `111` | ``?>`` | Cierre de la etiqueta PHP para alternar a salida HTML o fin del archivo. |
| `112` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `113` | `<!-- ══ BREADCRUMB + CABECERA ══════════════════════════════════════════...` | Instrucción de ejecución en el contexto del script: `<!-- ══ BREADCRUMB + CABECERA ══════════════════════════════════════════...`. |
| `114` | `<div class="d-flex justify-content-between align-items-start mb-4 flex-w...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="d-flex justify-content-between align-items-start mb-4 flex-w...`. |
| `115` | `<div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div>`. |
| `116` | `<nav aria-label="breadcrumb" class="mb-1">` | Instrucción de ejecución en el contexto del script: `<nav aria-label="breadcrumb" class="mb-1">`. |
| `117` | `<ol class="breadcrumb mb-0" style="font-size:.82rem;">` | Instrucción de ejecución en el contexto del script: `<ol class="breadcrumb mb-0" style="font-size:.82rem;">`. |
| `118` | `<li class="breadcrumb-item">` | Instrucción de ejecución en el contexto del script: `<li class="breadcrumb-item">`. |
| `119` | `<a href="admin_grupos.php" class="text-success text-decoration-none fw-s...` | Instrucción de ejecución en el contexto del script: `<a href="admin_grupos.php" class="text-success text-decoration-none fw-s...`. |
| `120` | `<i class="fas fa-people-group me-1"></i>Grupos` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-people-group me-1"></i>Grupos`. |
| `121` | `</a>` | Instrucción de ejecución en el contexto del script: `</a>`. |
| `122` | `</li>` | Instrucción de ejecución en el contexto del script: `</li>`. |
| `123` | `<?php if ($programaAct): ?>` | Instrucción de ejecución en el contexto del script: `<?php if ($programaAct): ?>`. |
| `124` | `<li class="breadcrumb-item">` | Instrucción de ejecución en el contexto del script: `<li class="breadcrumb-item">`. |
| `125` | `<?php if ($fichaAct): ?>` | Instrucción de ejecución en el contexto del script: `<?php if ($fichaAct): ?>`. |
| `126` | `<a href="admin_grupos.php?programa=<?= $vistaPrograma ?>"` | Instrucción de ejecución en el contexto del script: `<a href="admin_grupos.php?programa=<?= $vistaPrograma ?>"`. |
| `127` | `class="text-success text-decoration-none">` | Instrucción de ejecución en el contexto del script: `class="text-success text-decoration-none">`. |
| `128` | `<?= htmlspecialchars($programaAct['nombre']) ?>` | Instrucción de ejecución en el contexto del script: `<?= htmlspecialchars($programaAct['nombre']) ?>`. |
| `129` | `</a>` | Instrucción de ejecución en el contexto del script: `</a>`. |
| `130` | `<?php else: ?>` | Instrucción de ejecución en el contexto del script: `<?php else: ?>`. |
| `131` | `<span class="text-dark fw-semibold"><?= htmlspecialchars($programaAct['n...` | Instrucción de ejecución en el contexto del script: `<span class="text-dark fw-semibold"><?= htmlspecialchars($programaAct['n...`. |
| `132` | `<?php endif; ?>` | Cierre de estructura condicional embebida en la plantilla HTML. |
| `133` | `</li>` | Instrucción de ejecución en el contexto del script: `</li>`. |
| `134` | `<?php endif; ?>` | Cierre de estructura condicional embebida en la plantilla HTML. |
| `135` | `<?php if ($fichaAct): ?>` | Instrucción de ejecución en el contexto del script: `<?php if ($fichaAct): ?>`. |
| `136` | `<li class="breadcrumb-item active">` | Instrucción de ejecución en el contexto del script: `<li class="breadcrumb-item active">`. |
| `137` | `Ficha <strong class="font-monospace"><?= htmlspecialchars($fichaAct['num...` | Instrucción de ejecución en el contexto del script: `Ficha <strong class="font-monospace"><?= htmlspecialchars($fichaAct['num...`. |
| `138` | `</li>` | Instrucción de ejecución en el contexto del script: `</li>`. |
| `139` | `<?php endif; ?>` | Cierre de estructura condicional embebida en la plantilla HTML. |
| `140` | `</ol>` | Instrucción de ejecución en el contexto del script: `</ol>`. |
| `141` | `</nav>` | Instrucción de ejecución en el contexto del script: `</nav>`. |
| `142` | `<h4 class="fw-bold mb-0">` | Instrucción de ejecución en el contexto del script: `<h4 class="fw-bold mb-0">`. |
| `143` | `<?php if ($fichaAct): ?>` | Instrucción de ejecución en el contexto del script: `<?php if ($fichaAct): ?>`. |
| `144` | `<i class="fas fa-people-group text-success me-2"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-people-group text-success me-2"></i>`. |
| `145` | `Grupos — Ficha <span class="font-monospace"><?= htmlspecialchars($fichaA...` | Instrucción de ejecución en el contexto del script: `Grupos — Ficha <span class="font-monospace"><?= htmlspecialchars($fichaA...`. |
| `146` | `<?php elseif ($programaAct): ?>` | Instrucción de ejecución en el contexto del script: `<?php elseif ($programaAct): ?>`. |
| `147` | `<i class="fas fa-id-card text-success me-2"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-id-card text-success me-2"></i>`. |
| `148` | `Fichas — <?= htmlspecialchars($programaAct['nombre']) ?>` | Instrucción de ejecución en el contexto del script: `Fichas — <?= htmlspecialchars($programaAct['nombre']) ?>`. |
| `149` | `<?php else: ?>` | Instrucción de ejecución en el contexto del script: `<?php else: ?>`. |
| `150` | `<i class="fas fa-people-group text-success me-2"></i>Grupos de Limpieza` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-people-group text-success me-2"></i>Grupos de Limpieza`. |
| `151` | `<?php endif; ?>` | Cierre de estructura condicional embebida en la plantilla HTML. |
| `152` | `</h4>` | Instrucción de ejecución en el contexto del script: `</h4>`. |
| `153` | `<p class="text-muted small mb-0">` | Instrucción de ejecución en el contexto del script: `<p class="text-muted small mb-0">`. |
| `154` | `<?php if ($fichaAct): ?>` | Instrucción de ejecución en el contexto del script: `<?php if ($fichaAct): ?>`. |
| `155` | `<?= count($grupos) ?> grupo(s) registrados en esta ficha` | Instrucción de ejecución en el contexto del script: `<?= count($grupos) ?> grupo(s) registrados en esta ficha`. |
| `156` | `<?php elseif ($programaAct): ?>` | Instrucción de ejecución en el contexto del script: `<?php elseif ($programaAct): ?>`. |
| `157` | `Selecciona una ficha para ver sus grupos` | Instrucción de ejecución en el contexto del script: `Selecciona una ficha para ver sus grupos`. |
| `158` | `<?php else: ?>` | Instrucción de ejecución en el contexto del script: `<?php else: ?>`. |
| `159` | `Selecciona un programa de formación` | Instrucción de ejecución en el contexto del script: `Selecciona un programa de formación`. |
| `160` | `<?php endif; ?>` | Cierre de estructura condicional embebida en la plantilla HTML. |
| `161` | `</p>` | Instrucción de ejecución en el contexto del script: `</p>`. |
| `162` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `163` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `164` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `165` | `<!-- ══ NIVEL 0: GRID DE PROGRAMAS ═════════════════════════════════════...` | Instrucción de ejecución en el contexto del script: `<!-- ══ NIVEL 0: GRID DE PROGRAMAS ═════════════════════════════════════...`. |
| `166` | `<?php if (!$vistaPrograma && !$vistaFicha): ?>` | Instrucción de ejecución en el contexto del script: `<?php if (!$vistaPrograma && !$vistaFicha): ?>`. |
| `167` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `168` | ``<?php`` | Apertura obligatoria de la etiqueta PHP para ejecución del código del lado del servidor. |
| `169` | `$stmtTotG = $db->query("SELECT COUNT(*) FROM grupos");` | Instrucción de ejecución en el contexto del script: `$stmtTotG = $db->query("SELECT COUNT(*) FROM grupos");`. |
| `170` | `$totalGrupos = (int)$stmtTotG->fetchColumn();` | Recupera el valor escalar de la primera columna del resultado de la consulta. |
| `171` | `$stmtTotEv = $db->query("SELECT COUNT(*) FROM evidencias");` | Instrucción de ejecución en el contexto del script: `$stmtTotEv = $db->query("SELECT COUNT(*) FROM evidencias");`. |
| `172` | `$totalEv = (int)$stmtTotEv->fetchColumn();` | Recupera el valor escalar de la primera columna del resultado de la consulta. |
| `173` | ``?>`` | Cierre de la etiqueta PHP para alternar a salida HTML o fin del archivo. |
| `174` | `<div class="row g-3 mb-4">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="row g-3 mb-4">`. |
| `175` | `<div class="col-sm-4">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="col-sm-4">`. |
| `176` | `<div class="stat-card bg-white">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="stat-card bg-white">`. |
| `177` | `<div class="d-flex align-items-center gap-3">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="d-flex align-items-center gap-3">`. |
| `178` | `<div class="stat-icon" style="background:rgba(57,169,0,.12);color:#39a90...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="stat-icon" style="background:rgba(57,169,0,.12);color:#39a90...`. |
| `179` | `<i class="fas fa-graduation-cap"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-graduation-cap"></i>`. |
| `180` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `181` | `<div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div>`. |
| `182` | `<div class="fs-4 fw-bold"><?= count($programas) ?></div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="fs-4 fw-bold"><?= count($programas) ?></div>`. |
| `183` | `<div class="text-muted small">Programas</div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="text-muted small">Programas</div>`. |
| `184` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `185` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `186` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `187` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `188` | `<div class="col-sm-4">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="col-sm-4">`. |
| `189` | `<div class="stat-card bg-white">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="stat-card bg-white">`. |
| `190` | `<div class="d-flex align-items-center gap-3">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="d-flex align-items-center gap-3">`. |
| `191` | `<div class="stat-icon" style="background:rgba(37,99,235,.1);color:#2563e...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="stat-icon" style="background:rgba(37,99,235,.1);color:#2563e...`. |
| `192` | `<i class="fas fa-people-group"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-people-group"></i>`. |
| `193` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `194` | `<div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div>`. |
| `195` | `<div class="fs-4 fw-bold"><?= $totalGrupos ?></div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="fs-4 fw-bold"><?= $totalGrupos ?></div>`. |
| `196` | `<div class="text-muted small">Grupos registrados</div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="text-muted small">Grupos registrados</div>`. |
| `197` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `198` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `199` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `200` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `201` | `<div class="col-sm-4">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="col-sm-4">`. |
| `202` | `<div class="stat-card bg-white">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="stat-card bg-white">`. |
| `203` | `<div class="d-flex align-items-center gap-3">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="d-flex align-items-center gap-3">`. |
| `204` | `<div class="stat-icon" style="background:rgba(234,179,8,.1);color:#d9770...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="stat-icon" style="background:rgba(234,179,8,.1);color:#d9770...`. |
| `205` | `<i class="fas fa-images"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-images"></i>`. |
| `206` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `207` | `<div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div>`. |
| `208` | `<div class="fs-4 fw-bold"><?= $totalEv ?></div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="fs-4 fw-bold"><?= $totalEv ?></div>`. |
| `209` | `<div class="text-muted small">Evidencias registradas</div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="text-muted small">Evidencias registradas</div>`. |
| `210` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `211` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `212` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `213` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `214` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `215` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `216` | `<div class="mb-3">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="mb-3">`. |
| `217` | `<div class="input-group input-group-sm" style="max-width:320px;">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="input-group input-group-sm" style="max-width:320px;">`. |
| `218` | `<span class="input-group-text bg-white"><i class="fas fa-search text-mut...` | Instrucción de ejecución en el contexto del script: `<span class="input-group-text bg-white"><i class="fas fa-search text-mut...`. |
| `219` | `<input type="text" id="buscPrograma" class="form-control border-start-0"...` | Campo de entrada interactivo para datos del usuario: `<input type="text" id="buscPrograma" class="form-control border-start-0"...`. |
| `220` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `221` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `222` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `223` | `<div class="row g-3" id="gridProgramas">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="row g-3" id="gridProgramas">`. |
| `224` | `<?php foreach ($programas as $p):` | Instrucción de ejecución en el contexto del script: `<?php foreach ($programas as $p):`. |
| `225` | `$stmtGC = $db->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmtGC = $db->prepare(`. |
| `226` | `"SELECT COUNT(DISTINCT g.id_grupo)` | Instrucción de ejecución en el contexto del script: `"SELECT COUNT(DISTINCT g.id_grupo)`. |
| `227` | `FROM grupos g` | Instrucción de ejecución en el contexto del script: `FROM grupos g`. |
| `228` | `JOIN asignaciones a ON a.id_asignacion = g.id_asignacion` | Instrucción de ejecución en el contexto del script: `JOIN asignaciones a ON a.id_asignacion = g.id_asignacion`. |
| `229` | `WHERE a.id_ficha IN (SELECT id_ficha FROM fichas WHERE id_programa = :pr...` | Instrucción de ejecución en el contexto del script: `WHERE a.id_ficha IN (SELECT id_ficha FROM fichas WHERE id_programa = :pr...`. |
| `230` | ``);`` | Cierre de estructura de arreglo o invocación de función. |
| `231` | `$stmtGC->execute([':prog' => $p['id_programa']]);` | Ejecuta la sentencia SQL preparada vinculando los parámetros correspondientes: `$stmtGC->execute([':prog' => $p['id_programa']]);`. |
| `232` | `$cntG = (int)$stmtGC->fetchColumn();` | Recupera el valor escalar de la primera columna del resultado de la consulta. |
| `233` | ``?>`` | Cierre de la etiqueta PHP para alternar a salida HTML o fin del archivo. |
| `234` | `<div class="col-md-6 col-lg-4 prog-item">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="col-md-6 col-lg-4 prog-item">`. |
| `235` | `<a href="admin_grupos.php?programa=<?= $p['id_programa'] ?>" class="text...` | Instrucción de ejecución en el contexto del script: `<a href="admin_grupos.php?programa=<?= $p['id_programa'] ?>" class="text...`. |
| `236` | `<div class="card border-0 shadow-sm h-100 prog-card" style="border-radiu...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="card border-0 shadow-sm h-100 prog-card" style="border-radiu...`. |
| `237` | `<div class="card-body p-4">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="card-body p-4">`. |
| `238` | `<div class="d-flex align-items-start justify-content-between mb-3">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="d-flex align-items-start justify-content-between mb-3">`. |
| `239` | `<div style="width:44px;height:44px;border-radius:10px;` | Contenedor visual estructurado con Bootstrap/CSS: `<div style="width:44px;height:44px;border-radius:10px;`. |
| `240` | `background:rgba(37,99,235,.1);color:#2563eb;` | Instrucción de ejecución en el contexto del script: `background:rgba(37,99,235,.1);color:#2563eb;`. |
| `241` | `display:flex;align-items:center;justify-content:center;font-size:1.2rem;">` | Instrucción de ejecución en el contexto del script: `display:flex;align-items:center;justify-content:center;font-size:1.2rem;">`. |
| `242` | `<i class="fas fa-people-group"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-people-group"></i>`. |
| `243` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `244` | `<span class="badge bg-light text-dark border" style="font-size:.72rem;">` | Instrucción de ejecución en el contexto del script: `<span class="badge bg-light text-dark border" style="font-size:.72rem;">`. |
| `245` | `<?= htmlspecialchars($p['nivel'] ?? 'Sin nivel') ?>` | Instrucción de ejecución en el contexto del script: `<?= htmlspecialchars($p['nivel'] ?? 'Sin nivel') ?>`. |
| `246` | `</span>` | Instrucción de ejecución en el contexto del script: `</span>`. |
| `247` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `248` | `<h6 class="fw-bold mb-3 text-dark" style="font-size:.88rem;line-height:1...` | Instrucción de ejecución en el contexto del script: `<h6 class="fw-bold mb-3 text-dark" style="font-size:.88rem;line-height:1...`. |
| `249` | `<?= htmlspecialchars($p['nombre']) ?>` | Instrucción de ejecución en el contexto del script: `<?= htmlspecialchars($p['nombre']) ?>`. |
| `250` | `</h6>` | Instrucción de ejecución en el contexto del script: `</h6>`. |
| `251` | `<div class="d-flex gap-3 pt-3" style="border-top:1px solid #e5e7eb;">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="d-flex gap-3 pt-3" style="border-top:1px solid #e5e7eb;">`. |
| `252` | `<div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div>`. |
| `253` | `<div class="fw-bold text-success fs-5"><?= (int)$p['total_fichas'] ?></div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="fw-bold text-success fs-5"><?= (int)$p['total_fichas'] ?></div>`. |
| `254` | `<div class="text-muted" style="font-size:.72rem;">Fichas</div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="text-muted" style="font-size:.72rem;">Fichas</div>`. |
| `255` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `256` | `<div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div>`. |
| `257` | `<div class="fw-bold text-primary fs-5"><?= $cntG ?></div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="fw-bold text-primary fs-5"><?= $cntG ?></div>`. |
| `258` | `<div class="text-muted" style="font-size:.72rem;">Grupos</div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="text-muted" style="font-size:.72rem;">Grupos</div>`. |
| `259` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `260` | `<div class="ms-auto d-flex align-items-center text-success" style="font-...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="ms-auto d-flex align-items-center text-success" style="font-...`. |
| `261` | `Ver fichas <i class="fas fa-arrow-right ms-1"></i>` | Instrucción de ejecución en el contexto del script: `Ver fichas <i class="fas fa-arrow-right ms-1"></i>`. |
| `262` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `263` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `264` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `265` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `266` | `</a>` | Instrucción de ejecución en el contexto del script: `</a>`. |
| `267` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `268` | `<?php endforeach; ?>` | Cierre de ciclo iterativo foreach embebido en la plantilla HTML. |
| `269` | `<?php if (empty($programas)): ?>` | Instrucción de ejecución en el contexto del script: `<?php if (empty($programas)): ?>`. |
| `270` | `<div class="col-12 text-center py-5 text-muted">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="col-12 text-center py-5 text-muted">`. |
| `271` | `<i class="fas fa-graduation-cap fa-3x mb-3 opacity-25 d-block"></i>No ha...` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-graduation-cap fa-3x mb-3 opacity-25 d-block"></i>No ha...`. |
| `272` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `273` | `<?php endif; ?>` | Cierre de estructura condicional embebida en la plantilla HTML. |
| `274` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `275` | `<?php endif; ?>` | Cierre de estructura condicional embebida en la plantilla HTML. |
| `276` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `277` | `<!-- ══ NIVEL 1: FICHAS DEL PROGRAMA ═══════════════════════════════════...` | Instrucción de ejecución en el contexto del script: `<!-- ══ NIVEL 1: FICHAS DEL PROGRAMA ═══════════════════════════════════...`. |
| `278` | `<?php if ($vistaPrograma && !$vistaFicha): ?>` | Instrucción de ejecución en el contexto del script: `<?php if ($vistaPrograma && !$vistaFicha): ?>`. |
| `279` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `280` | `<div class="row g-3">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="row g-3">`. |
| `281` | `<?php foreach ($fichasDelProg as $f): ?>` | Instrucción de ejecución en el contexto del script: `<?php foreach ($fichasDelProg as $f): ?>`. |
| `282` | `<div class="col-md-6 col-lg-4">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="col-md-6 col-lg-4">`. |
| `283` | `<a href="admin_grupos.php?programa=<?= $vistaPrograma ?>&ficha=<?= $f['i...` | Instrucción de ejecución en el contexto del script: `<a href="admin_grupos.php?programa=<?= $vistaPrograma ?>&ficha=<?= $f['i...`. |
| `284` | `<div class="card border-0 shadow-sm h-100 prog-card" style="border-radiu...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="card border-0 shadow-sm h-100 prog-card" style="border-radiu...`. |
| `285` | `<div class="card-body p-4">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="card-body p-4">`. |
| `286` | `<div class="d-flex align-items-start justify-content-between mb-3">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="d-flex align-items-start justify-content-between mb-3">`. |
| `287` | `<div style="width:44px;height:44px;border-radius:10px;` | Contenedor visual estructurado con Bootstrap/CSS: `<div style="width:44px;height:44px;border-radius:10px;`. |
| `288` | `background:rgba(37,99,235,.1);color:#2563eb;` | Instrucción de ejecución en el contexto del script: `background:rgba(37,99,235,.1);color:#2563eb;`. |
| `289` | `display:flex;align-items:center;justify-content:center;font-size:1.1rem;">` | Instrucción de ejecución en el contexto del script: `display:flex;align-items:center;justify-content:center;font-size:1.1rem;">`. |
| `290` | `<i class="fas fa-id-card"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-id-card"></i>`. |
| `291` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `292` | `<span class="badge bg-light text-dark border"><?= htmlspecialchars($f['j...` | Instrucción de ejecución en el contexto del script: `<span class="badge bg-light text-dark border"><?= htmlspecialchars($f['j...`. |
| `293` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `294` | `<div class="fw-bold text-success font-monospace mb-1" style="font-size:1...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="fw-bold text-success font-monospace mb-1" style="font-size:1...`. |
| `295` | `<?= htmlspecialchars($f['numero_ficha']) ?>` | Instrucción de ejecución en el contexto del script: `<?= htmlspecialchars($f['numero_ficha']) ?>`. |
| `296` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `297` | `<div class="text-muted small mb-3">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="text-muted small mb-3">`. |
| `298` | `<?php if ($f['vocero_nombres']): ?>` | Instrucción de ejecución en el contexto del script: `<?php if ($f['vocero_nombres']): ?>`. |
| `299` | `<i class="fas fa-user-tie text-success me-1" style="font-size:.75rem;"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-user-tie text-success me-1" style="font-size:.75rem;"></i>`. |
| `300` | `<?= htmlspecialchars($f['vocero_nombres']) ?>` | Instrucción de ejecución en el contexto del script: `<?= htmlspecialchars($f['vocero_nombres']) ?>`. |
| `301` | `<?php else: ?>` | Instrucción de ejecución en el contexto del script: `<?php else: ?>`. |
| `302` | `<span class="text-warning"><i class="fas fa-exclamation-circle me-1"></i...` | Instrucción de ejecución en el contexto del script: `<span class="text-warning"><i class="fas fa-exclamation-circle me-1"></i...`. |
| `303` | `<?php endif; ?>` | Cierre de estructura condicional embebida en la plantilla HTML. |
| `304` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `305` | `<div class="d-flex gap-3 pt-3" style="border-top:1px solid #e5e7eb;">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="d-flex gap-3 pt-3" style="border-top:1px solid #e5e7eb;">`. |
| `306` | `<div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div>`. |
| `307` | `<div class="fw-bold text-primary fs-5"><?= (int)$f['total_grupos'] ?></div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="fw-bold text-primary fs-5"><?= (int)$f['total_grupos'] ?></div>`. |
| `308` | `<div class="text-muted" style="font-size:.72rem;">Grupos</div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="text-muted" style="font-size:.72rem;">Grupos</div>`. |
| `309` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `310` | `<div class="ms-auto d-flex align-items-center text-success" style="font-...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="ms-auto d-flex align-items-center text-success" style="font-...`. |
| `311` | `Ver grupos <i class="fas fa-arrow-right ms-1"></i>` | Instrucción de ejecución en el contexto del script: `Ver grupos <i class="fas fa-arrow-right ms-1"></i>`. |
| `312` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `313` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `314` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `315` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `316` | `</a>` | Instrucción de ejecución en el contexto del script: `</a>`. |
| `317` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `318` | `<?php endforeach; ?>` | Cierre de ciclo iterativo foreach embebido en la plantilla HTML. |
| `319` | `<?php if (empty($fichasDelProg)): ?>` | Instrucción de ejecución en el contexto del script: `<?php if (empty($fichasDelProg)): ?>`. |
| `320` | `<div class="col-12 text-center py-5 text-muted">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="col-12 text-center py-5 text-muted">`. |
| `321` | `<i class="fas fa-id-card fa-3x mb-3 opacity-25 d-block"></i>No hay ficha...` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-id-card fa-3x mb-3 opacity-25 d-block"></i>No hay ficha...`. |
| `322` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `323` | `<?php endif; ?>` | Cierre de estructura condicional embebida en la plantilla HTML. |
| `324` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `325` | `<?php endif; ?>` | Cierre de estructura condicional embebida en la plantilla HTML. |
| `326` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `327` | `<!-- ══ NIVEL 2: GRUPOS DE LA FICHA ════════════════════════════════════...` | Instrucción de ejecución en el contexto del script: `<!-- ══ NIVEL 2: GRUPOS DE LA FICHA ════════════════════════════════════...`. |
| `328` | `<?php if ($vistaFicha && $fichaAct): ?>` | Instrucción de ejecución en el contexto del script: `<?php if ($vistaFicha && $fichaAct): ?>`. |
| `329` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `330` | `<?php if (empty($grupos)): ?>` | Instrucción de ejecución en el contexto del script: `<?php if (empty($grupos)): ?>`. |
| `331` | `<div class="card border-0 shadow-sm text-center py-5 text-muted">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="card border-0 shadow-sm text-center py-5 text-muted">`. |
| `332` | `<i class="fas fa-people-group fa-3x mb-3 opacity-25 d-block"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-people-group fa-3x mb-3 opacity-25 d-block"></i>`. |
| `333` | `<p class="small mb-0">No hay grupos registrados en esta ficha.</p>` | Instrucción de ejecución en el contexto del script: `<p class="small mb-0">No hay grupos registrados en esta ficha.</p>`. |
| `334` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `335` | `<?php else: ?>` | Instrucción de ejecución en el contexto del script: `<?php else: ?>`. |
| `336` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `337` | `<div class="d-flex align-items-center justify-content-between mb-3 flex-...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="d-flex align-items-center justify-content-between mb-3 flex-...`. |
| `338` | `<span class="text-muted small"><?= count($grupos) ?> grupo(s) · ordenado...` | Instrucción de ejecución en el contexto del script: `<span class="text-muted small"><?= count($grupos) ?> grupo(s) · ordenado...`. |
| `339` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `340` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `341` | `<?php foreach ($grupos as $numGrupo => $g):` | Instrucción de ejecución en el contexto del script: `<?php foreach ($grupos as $numGrupo => $g):`. |
| `342` | `$integrantes = $integrantesPorGrupo[(int)$g['id_grupo']] ?? [];` | Instrucción de ejecución en el contexto del script: `$integrantes = $integrantesPorGrupo[(int)$g['id_grupo']] ?? [];`. |
| `343` | `$badge = match($g['estado']) {` | Instrucción de ejecución en el contexto del script: `$badge = match($g['estado']) {`. |
| `344` | `'Completado' => ['bg'=>'#dbeafe','color'=>'#1d4ed8','label'=>'Completado'],` | Instrucción de ejecución en el contexto del script: `'Completado' => ['bg'=>'#dbeafe','color'=>'#1d4ed8','label'=>'Completado'],`. |
| `345` | `'Sancionado' => ['bg'=>'#fee2e2','color'=>'#991b1b','label'=>'Sancionado'],` | Instrucción de ejecución en el contexto del script: `'Sancionado' => ['bg'=>'#fee2e2','color'=>'#991b1b','label'=>'Sancionado'],`. |
| `346` | `default      => ['bg'=>'#dcfce7','color'=>'#166534','label'=>'Activo'],` | Instrucción de ejecución en el contexto del script: `default      => ['bg'=>'#dcfce7','color'=>'#166534','label'=>'Activo'],`. |
| `347` | `};` | Instrucción de ejecución en el contexto del script: `};`. |
| `348` | `$esHoy = date('Y-m-d', strtotime($g['fecha_limpieza'])) === date('Y-m-d');` | Instrucción de ejecución en el contexto del script: `$esHoy = date('Y-m-d', strtotime($g['fecha_limpieza'])) === date('Y-m-d');`. |
| `349` | ``?>`` | Cierre de la etiqueta PHP para alternar a salida HTML o fin del archivo. |
| `350` | `<div class="card border-0 shadow-sm mb-3" style="border-radius:12px; ove...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="card border-0 shadow-sm mb-3" style="border-radius:12px; ove...`. |
| `351` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `352` | `<!-- Cabecera del grupo -->` | Instrucción de ejecución en el contexto del script: `<!-- Cabecera del grupo -->`. |
| `353` | `<div class="d-flex align-items-center gap-3 px-4 py-3"` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="d-flex align-items-center gap-3 px-4 py-3"`. |
| `354` | `style="background:#f9fafb; border-bottom:1px solid #e5e7eb;">` | Instrucción de ejecución en el contexto del script: `style="background:#f9fafb; border-bottom:1px solid #e5e7eb;">`. |
| `355` | `<!-- Número de grupo -->` | Instrucción de ejecución en el contexto del script: `<!-- Número de grupo -->`. |
| `356` | `<div style="width:38px;height:38px;border-radius:9px;background:#39a900;` | Contenedor visual estructurado con Bootstrap/CSS: `<div style="width:38px;height:38px;border-radius:9px;background:#39a900;`. |
| `357` | `display:flex;align-items:center;justify-content:center;` | Instrucción de ejecución en el contexto del script: `display:flex;align-items:center;justify-content:center;`. |
| `358` | `color:#fff;font-weight:700;font-size:1rem;flex-shrink:0;">` | Instrucción de ejecución en el contexto del script: `color:#fff;font-weight:700;font-size:1rem;flex-shrink:0;">`. |
| `359` | `<?= $numGrupo + 1 ?>` | Instrucción de ejecución en el contexto del script: `<?= $numGrupo + 1 ?>`. |
| `360` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `361` | `<div class="flex-grow-1">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="flex-grow-1">`. |
| `362` | `<div class="fw-bold" style="font-size:.95rem;color:#111827;">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="fw-bold" style="font-size:.95rem;color:#111827;">`. |
| `363` | `<?= htmlspecialchars($g['nombre_grupo']) ?>` | Instrucción de ejecución en el contexto del script: `<?= htmlspecialchars($g['nombre_grupo']) ?>`. |
| `364` | `<?php if ($esHoy): ?>` | Instrucción de ejecución en el contexto del script: `<?php if ($esHoy): ?>`. |
| `365` | `<span class="badge bg-warning text-dark ms-1" style="font-size:.65rem;">...` | Instrucción de ejecución en el contexto del script: `<span class="badge bg-warning text-dark ms-1" style="font-size:.65rem;">...`. |
| `366` | `<?php endif; ?>` | Cierre de estructura condicional embebida en la plantilla HTML. |
| `367` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `368` | `<div class="text-muted" style="font-size:.78rem;">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="text-muted" style="font-size:.78rem;">`. |
| `369` | `<i class="fas fa-user-tie me-1 text-success"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-user-tie me-1 text-success"></i>`. |
| `370` | `<?= htmlspecialchars($g['vocero_nombres'] . ' ' . $g['vocero_apellidos']...` | Instrucción de ejecución en el contexto del script: `<?= htmlspecialchars($g['vocero_nombres'] . ' ' . $g['vocero_apellidos']...`. |
| `371` | `<span class="mx-2">·</span>` | Instrucción de ejecución en el contexto del script: `<span class="mx-2">·</span>`. |
| `372` | `<i class="fas fa-door-open me-1"></i><?= htmlspecialchars($g['nombre_mod...` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-door-open me-1"></i><?= htmlspecialchars($g['nombre_mod...`. |
| `373` | `<span class="mx-2">·</span>` | Instrucción de ejecución en el contexto del script: `<span class="mx-2">·</span>`. |
| `374` | `<i class="fas fa-calendar me-1"></i><?= date('d/m/Y', strtotime($g['fech...` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-calendar me-1"></i><?= date('d/m/Y', strtotime($g['fech...`. |
| `375` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `376` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `377` | `<div class="d-flex align-items-center gap-2 flex-shrink-0">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="d-flex align-items-center gap-2 flex-shrink-0">`. |
| `378` | `<!-- Evidencia -->` | Instrucción de ejecución en el contexto del script: `<!-- Evidencia -->`. |
| `379` | `<?php if ((int)$g['tiene_evidencia'] > 0): ?>` | Instrucción de ejecución en el contexto del script: `<?php if ((int)$g['tiene_evidencia'] > 0): ?>`. |
| `380` | `<span title="Con evidencia"` | Instrucción de ejecución en el contexto del script: `<span title="Con evidencia"`. |
| `381` | `style="background:#dcfce7;color:#166534;padding:.25rem .6rem;` | Instrucción de ejecución en el contexto del script: `style="background:#dcfce7;color:#166534;padding:.25rem .6rem;`. |
| `382` | `border-radius:20px;font-size:.72rem;font-weight:600;">` | Instrucción de ejecución en el contexto del script: `border-radius:20px;font-size:.72rem;font-weight:600;">`. |
| `383` | `<i class="fas fa-check me-1"></i>Evidencia` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-check me-1"></i>Evidencia`. |
| `384` | `</span>` | Instrucción de ejecución en el contexto del script: `</span>`. |
| `385` | `<?php else: ?>` | Instrucción de ejecución en el contexto del script: `<?php else: ?>`. |
| `386` | `<span style="background:#fee2e2;color:#991b1b;padding:.25rem .6rem;` | Instrucción de ejecución en el contexto del script: `<span style="background:#fee2e2;color:#991b1b;padding:.25rem .6rem;`. |
| `387` | `border-radius:20px;font-size:.72rem;font-weight:600;">` | Instrucción de ejecución en el contexto del script: `border-radius:20px;font-size:.72rem;font-weight:600;">`. |
| `388` | `<i class="fas fa-xmark me-1"></i>Sin evidencia` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-xmark me-1"></i>Sin evidencia`. |
| `389` | `</span>` | Instrucción de ejecución en el contexto del script: `</span>`. |
| `390` | `<?php endif; ?>` | Cierre de estructura condicional embebida en la plantilla HTML. |
| `391` | `<!-- Estado -->` | Instrucción de ejecución en el contexto del script: `<!-- Estado -->`. |
| `392` | `<span style="background:<?= $badge['bg'] ?>;color:<?= $badge['color'] ?>;` | Instrucción de ejecución en el contexto del script: `<span style="background:<?= $badge['bg'] ?>;color:<?= $badge['color'] ?>;`. |
| `393` | `padding:.25rem .65rem;border-radius:20px;` | Instrucción de ejecución en el contexto del script: `padding:.25rem .65rem;border-radius:20px;`. |
| `394` | `font-size:.72rem;font-weight:600;">` | Instrucción de ejecución en el contexto del script: `font-size:.72rem;font-weight:600;">`. |
| `395` | `<?= $badge['label'] ?>` | Instrucción de ejecución en el contexto del script: `<?= $badge['label'] ?>`. |
| `396` | `</span>` | Instrucción de ejecución en el contexto del script: `</span>`. |
| `397` | `<!-- Conteo integrantes -->` | Instrucción de ejecución en el contexto del script: `<!-- Conteo integrantes -->`. |
| `398` | `<span style="background:#f3f4f6;color:#374151;padding:.25rem .65rem;` | Instrucción de ejecución en el contexto del script: `<span style="background:#f3f4f6;color:#374151;padding:.25rem .65rem;`. |
| `399` | `border-radius:20px;font-size:.72rem;font-weight:600;">` | Instrucción de ejecución en el contexto del script: `border-radius:20px;font-size:.72rem;font-weight:600;">`. |
| `400` | `<i class="fas fa-users me-1"></i><?= count($integrantes) ?>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-users me-1"></i><?= count($integrantes) ?>`. |
| `401` | `</span>` | Instrucción de ejecución en el contexto del script: `</span>`. |
| `402` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `403` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `404` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `405` | `<!-- Integrantes -->` | Instrucción de ejecución en el contexto del script: `<!-- Integrantes -->`. |
| `406` | `<?php if (empty($integrantes)): ?>` | Instrucción de ejecución en el contexto del script: `<?php if (empty($integrantes)): ?>`. |
| `407` | `<div class="px-4 py-3 text-muted small">Sin integrantes registrados.</div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="px-4 py-3 text-muted small">Sin integrantes registrados.</div>`. |
| `408` | `<?php else: ?>` | Instrucción de ejecución en el contexto del script: `<?php else: ?>`. |
| `409` | `<div class="table-responsive">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="table-responsive">`. |
| `410` | `<table class="table mb-0" style="font-size:.82rem;">` | Tabla de datos para despliegue estructurado de información. |
| `411` | `<thead>` | Definición de estructura semántica de cabecera o cuerpo de tabla. |
| `412` | ``<tr>`` | Fila contenedora de datos dentro de la tabla. |
| `413` | `<th style="padding:.5rem 1rem;font-weight:700;color:#6b7280;font-size:.7...` | Celda de encabezado de columna: `<th style="padding:.5rem 1rem;font-weight:700;color:#6b7280;font-size:.7...`. |
| `414` | `<th style="padding:.5rem .75rem;font-weight:700;color:#6b7280;font-size:...` | Celda de encabezado de columna: `<th style="padding:.5rem .75rem;font-weight:700;color:#6b7280;font-size:...`. |
| `415` | `<th style="padding:.5rem .75rem;font-weight:700;color:#6b7280;font-size:...` | Celda de encabezado de columna: `<th style="padding:.5rem .75rem;font-weight:700;color:#6b7280;font-size:...`. |
| `416` | `<th style="padding:.5rem .75rem;font-weight:700;color:#6b7280;font-size:...` | Celda de encabezado de columna: `<th style="padding:.5rem .75rem;font-weight:700;color:#6b7280;font-size:...`. |
| `417` | `<th style="padding:.5rem .75rem;font-weight:700;color:#6b7280;font-size:...` | Celda de encabezado de columna: `<th style="padding:.5rem .75rem;font-weight:700;color:#6b7280;font-size:...`. |
| `418` | `<th style="padding:.5rem .75rem;font-weight:700;color:#6b7280;font-size:...` | Celda de encabezado de columna: `<th style="padding:.5rem .75rem;font-weight:700;color:#6b7280;font-size:...`. |
| `419` | ``</tr>`` | Cierre de fila contenedora de tabla. |
| `420` | `</thead>` | Definición de estructura semántica de cabecera o cuerpo de tabla. |
| `421` | `<tbody>` | Definición de estructura semántica de cabecera o cuerpo de tabla. |
| `422` | `<?php foreach ($integrantes as $idx => $ap): ?>` | Instrucción de ejecución en el contexto del script: `<?php foreach ($integrantes as $idx => $ap): ?>`. |
| `423` | ``<tr>`` | Fila contenedora de datos dentro de la tabla. |
| `424` | `<td style="padding:.55rem 1rem;color:#9ca3af;"><?= $idx + 1 ?></td>` | Celda de contenido de tabla: `<td style="padding:.55rem 1rem;color:#9ca3af;"><?= $idx + 1 ?></td>`. |
| `425` | `<td style="padding:.55rem .75rem;font-weight:600;color:#111827;"><?= htm...` | Celda de contenido de tabla: `<td style="padding:.55rem .75rem;font-weight:600;color:#111827;"><?= htm...`. |
| `426` | `<td style="padding:.55rem .75rem;color:#374151;"><?= htmlspecialchars($a...` | Celda de contenido de tabla: `<td style="padding:.55rem .75rem;color:#374151;"><?= htmlspecialchars($a...`. |
| `427` | `<td style="padding:.55rem .75rem;color:#6b7280;"><?= htmlspecialchars($a...` | Celda de contenido de tabla: `<td style="padding:.55rem .75rem;color:#6b7280;"><?= htmlspecialchars($a...`. |
| `428` | `<td style="padding:.55rem .75rem;">` | Celda de contenido de tabla: `<td style="padding:.55rem .75rem;">`. |
| `429` | `<?php if (!empty($ap['celular'])): ?>` | Instrucción de ejecución en el contexto del script: `<?php if (!empty($ap['celular'])): ?>`. |
| `430` | `<a href="tel:<?= htmlspecialchars($ap['celular']) ?>"` | Instrucción de ejecución en el contexto del script: `<a href="tel:<?= htmlspecialchars($ap['celular']) ?>"`. |
| `431` | `class="text-decoration-none text-dark">` | Instrucción de ejecución en el contexto del script: `class="text-decoration-none text-dark">`. |
| `432` | `<i class="fas fa-phone text-success me-1" style="font-size:.68rem;"></i>...` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-phone text-success me-1" style="font-size:.68rem;"></i>...`. |
| `433` | `</a>` | Instrucción de ejecución en el contexto del script: `</a>`. |
| `434` | `<?php else: ?><span class="text-muted">—</span><?php endif; ?>` | Instrucción de ejecución en el contexto del script: `<?php else: ?><span class="text-muted">—</span><?php endif; ?>`. |
| `435` | `</td>` | Instrucción de ejecución en el contexto del script: `</td>`. |
| `436` | `<td style="padding:.55rem .75rem;">` | Celda de contenido de tabla: `<td style="padding:.55rem .75rem;">`. |
| `437` | `<?php if (!empty($ap['correo'])): ?>` | Instrucción de ejecución en el contexto del script: `<?php if (!empty($ap['correo'])): ?>`. |
| `438` | `<a href="mailto:<?= htmlspecialchars($ap['correo']) ?>"` | Instrucción de ejecución en el contexto del script: `<a href="mailto:<?= htmlspecialchars($ap['correo']) ?>"`. |
| `439` | `class="text-decoration-none text-dark text-truncate d-inline-block"` | Instrucción de ejecución en el contexto del script: `class="text-decoration-none text-dark text-truncate d-inline-block"`. |
| `440` | `style="max-width:180px;" title="<?= htmlspecialchars($ap['correo']) ?>">` | Instrucción de ejecución en el contexto del script: `style="max-width:180px;" title="<?= htmlspecialchars($ap['correo']) ?>">`. |
| `441` | `<i class="fas fa-envelope text-success me-1" style="font-size:.68rem;"><...` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-envelope text-success me-1" style="font-size:.68rem;"><...`. |
| `442` | `</a>` | Instrucción de ejecución en el contexto del script: `</a>`. |
| `443` | `<?php else: ?><span class="text-muted">—</span><?php endif; ?>` | Instrucción de ejecución en el contexto del script: `<?php else: ?><span class="text-muted">—</span><?php endif; ?>`. |
| `444` | `</td>` | Instrucción de ejecución en el contexto del script: `</td>`. |
| `445` | ``</tr>`` | Cierre de fila contenedora de tabla. |
| `446` | `<?php endforeach; ?>` | Cierre de ciclo iterativo foreach embebido en la plantilla HTML. |
| `447` | `</tbody>` | Definición de estructura semántica de cabecera o cuerpo de tabla. |
| `448` | ``</table>`` | Cierre de tabla de datos. |
| `449` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `450` | `<?php endif; ?>` | Cierre de estructura condicional embebida en la plantilla HTML. |
| `451` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `452` | `</div><!-- /card grupo -->` | Instrucción de ejecución en el contexto del script: `</div><!-- /card grupo -->`. |
| `453` | `<?php endforeach; ?>` | Cierre de ciclo iterativo foreach embebido en la plantilla HTML. |
| `454` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `455` | `<?php endif; ?>` | Cierre de estructura condicional embebida en la plantilla HTML. |
| `456` | `<?php endif; ?>` | Cierre de estructura condicional embebida en la plantilla HTML. |
| `457` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `458` | ``<style>`` | Bloque de estilos CSS personalizados para la interfaz. |
| `459` | `.prog-card { transition: transform .2s, box-shadow .2s; cursor: pointer; }` | Instrucción de ejecución en el contexto del script: `.prog-card { transition: transform .2s, box-shadow .2s; cursor: pointer; }`. |
| `460` | `.prog-card:hover { transform: translateY(-3px); box-shadow: 0 8px 24px r...` | Instrucción de ejecución en el contexto del script: `.prog-card:hover { transform: translateY(-3px); box-shadow: 0 8px 24px r...`. |
| `461` | `.breadcrumb-item + .breadcrumb-item::before { color: #9ca3af; }` | Instrucción de ejecución en el contexto del script: `.breadcrumb-item + .breadcrumb-item::before { color: #9ca3af; }`. |
| `462` | ``</style>`` | Cierre de bloque de estilos CSS. |
| `463` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `464` | ``<script>`` | Bloque o etiqueta de vinculación para scripts JavaScript del lado del cliente. |
| `465` | `const bP = document.getElementById('buscPrograma');` | Instrucción de ejecución en el contexto del script: `const bP = document.getElementById('buscPrograma');`. |
| `466` | `if (bP) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (bP) {`. |
| `467` | `bP.addEventListener('input', function () {` | Registra un escucha de eventos del DOM para interactividad en tiempo real: `bP.addEventListener('input', function () {`. |
| `468` | `const q = this.value.toLowerCase();` | Instrucción de ejecución en el contexto del script: `const q = this.value.toLowerCase();`. |
| `469` | `document.querySelectorAll('.prog-item').forEach(el => {` | Instrucción de ejecución en el contexto del script: `document.querySelectorAll('.prog-item').forEach(el => {`. |
| `470` | `el.style.display = !q \|\| el.textContent.toLowerCase().includes(q) ? ''...` | Instrucción de ejecución en el contexto del script: `el.style.display = !q \|\| el.textContent.toLowerCase().includes(q) ? ''...`. |
| `471` | `});` | Instrucción de ejecución en el contexto del script: `});`. |
| `472` | `});` | Instrucción de ejecución en el contexto del script: `});`. |
| `473` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `474` | `<?php if ($alert): ?>` | Instrucción de ejecución en el contexto del script: `<?php if ($alert): ?>`. |
| `475` | `document.addEventListener('DOMContentLoaded', function () {` | Registra un escucha de eventos del DOM para interactividad en tiempo real: `document.addEventListener('DOMContentLoaded', function () {`. |
| `476` | `Swal.fire({ icon:'<?= addslashes($alert['icon']) ?>', title:'<?= addslas...` | Despliega una alerta modal estética e interactiva con SweetAlert2. |
| `477` | `});` | Instrucción de ejecución en el contexto del script: `});`. |
| `478` | `<?php endif; ?>` | Cierre de estructura condicional embebida en la plantilla HTML. |
| `479` | ``</script>`` | Cierre de bloque de script JavaScript. |
| `480` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `481` | `<?php require_once __DIR__ . '/../layouts/footer.php'; ?>` | Importación e inclusión obligatoria del archivo de dependencia requerido: `<?php require_once __DIR__ . '/../layouts/footer.php'; ?>`. |

---

## 3. Resumen y Flujo de Interacción

El archivo `admin_grupos.php` cumple un rol indispensable en `views/dashboard/admin_grupos.php`. 
Vista administrativa para supervisar la conformación de grupos de limpieza y aprendices asignados. Garantiza la robustez, el orden y la estabilidad de la arquitectura del proyecto `systemLimpieza`.

---

Generado automáticamente para el repositorio [johanrepizo/LimpiezaDeModulos](https://github.com/johanrepizo/LimpiezaDeModulos).
