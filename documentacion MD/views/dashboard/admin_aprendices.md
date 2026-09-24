# Documentación Línea por Línea: `views/dashboard/admin_aprendices.php`

## 1. Ficha Técnica del Archivo

- **Archivo:** `admin_aprendices.php`
- **Ruta en el proyecto:** `views/dashboard/admin_aprendices.php`
- **Cantidad total de líneas:** `626`
- **Tipo de archivo:** `PHP`
- **Propósito general:** Interfaz del administrador para consultar, buscar y gestionar la información de aprendices vinculados a las fichas.

---

## 2. Explicación Detallada Línea por Línea

A continuación se presenta cada línea de código numerada de forma consecutiva, acompañada de su fragmento exacto y la explicación exhaustiva de su funcionamiento y responsabilidad en el sistema:

| Línea | Código Fuente | Explicación Detallada |
|---|---|---|
| `1` | `<?php` | Apertura obligatoria de la etiqueta PHP para ejecución del código del lado del servidor. |
| `2` | `$titulo = 'Aprendices';` | Instrucción de ejecución en el contexto del script: `$titulo = 'Aprendices';`. |
| `3` | `if (session_status() === PHP_SESSION_NONE) session_start();` | Inicia o reanuda la sesión PHP del usuario si no se encontraba activa previamente. |
| `4` | `if (!isset($_SESSION['usuario']) \|\| (int)$_SESSION['usuario']['rol'] !== ...` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (!isset($_SESSION['usuario']) \|\| (int)$_SESSION['usuario']['rol'] !== 1) {`. |
| `5` | `    header("Location: ../usuarios/login.php"); exit;` | Emite cabecera HTTP de redirección en el navegador: `header("Location: ../usuarios/login.php"); exit;`. |
| `6` | `}` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `7` | `require_once __DIR__ . '/../../config/database.php';` | Importación e inclusión obligatoria del archivo de dependencia requerido: `require_once __DIR__ . '/../../config/database.php';`. |
| `8` | `require_once __DIR__ . '/../../models/Programa.php';` | Importación e inclusión obligatoria del archivo de dependencia requerido: `require_once __DIR__ . '/../../models/Programa.php';`. |
| `9` | `require_once __DIR__ . '/../../models/Ficha.php';` | Importación e inclusión obligatoria del archivo de dependencia requerido: `require_once __DIR__ . '/../../models/Ficha.php';`. |
| `10` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `11` | `$db        = (new Database())->conectar();` | Instrucción de ejecución en el contexto del script: `$db        = (new Database())->conectar();`. |
| `12` | `$alert     = $_SESSION['alert'] ?? null;` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección: `$alert     = $_SESSION['alert'] ?? null;`. |
| `13` | `unset($_SESSION['alert']);` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección: `unset($_SESSION['alert']);`. |
| `14` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `15` | `$vistaPrograma = (int)($_GET['programa'] ?? 0);` | Captura y sanitiza parámetros enviados por el cliente mediante petición HTTP: `$vistaPrograma = (int)($_GET['programa'] ?? 0);`. |
| `16` | `$vistaFicha    = (int)($_GET['ficha']    ?? 0);` | Captura y sanitiza parámetros enviados por el cliente mediante petición HTTP: `$vistaFicha    = (int)($_GET['ficha']    ?? 0);`. |
| `17` | `$busqueda      = trim($_GET['q']         ?? '');` | Captura y sanitiza parámetros enviados por el cliente mediante petición HTTP: `$busqueda      = trim($_GET['q']         ?? '');`. |
| `18` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `19` | `$modelProg = new Programa($db);` | Instrucción de ejecución en el contexto del script: `$modelProg = new Programa($db);`. |
| `20` | `$modelFich = new Ficha($db);` | Instrucción de ejecución en el contexto del script: `$modelFich = new Ficha($db);`. |
| `21` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `22` | `// ── Nivel 0: todos los programas con stats ──────────────────────────────...` | Comentario de línea explicativo: `── Nivel 0: todos los programas con stats ──────────────────────────────────`. |
| `23` | `$programas = $modelProg->obtenerTodos();` | Instrucción de ejecución en el contexto del script: `$programas = $modelProg->obtenerTodos();`. |
| `24` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `25` | `// Stats globales` | Comentario de línea explicativo: `Stats globales`. |
| `26` | `$stmtTotal = $db->query("SELECT COUNT(*) FROM aprendices WHERE activo = 1");` | Instrucción de ejecución en el contexto del script: `$stmtTotal = $db->query("SELECT COUNT(*) FROM aprendices WHERE activo = 1");`. |
| `27` | `$totalAprendices = (int)$stmtTotal->fetchColumn();` | Obtiene el valor de una columna única de la primera fila resultante. |
| `28` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `29` | `// ── Nivel 1: fichas del programa ────────────────────────────────────────...` | Comentario de línea explicativo: `── Nivel 1: fichas del programa ────────────────────────────────────────────`. |
| `30` | `$programaAct   = null;` | Instrucción de ejecución en el contexto del script: `$programaAct   = null;`. |
| `31` | `$fichasDelProg = [];` | Instrucción de ejecución en el contexto del script: `$fichasDelProg = [];`. |
| `32` | `if ($vistaPrograma) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if ($vistaPrograma) {`. |
| `33` | `    $programaAct = $modelProg->obtenerPorId($vistaPrograma);` | Instrucción de ejecución en el contexto del script: `$programaAct = $modelProg->obtenerPorId($vistaPrograma);`. |
| `34` | `    $stmtF = $db->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmtF = $db->prepare(`. |
| `35` | `        "SELECT f.*,` | Instrucción de ejecución en el contexto del script: `"SELECT f.*,`. |
| `36` | `                ANY_VALUE(v.nombres)   AS vocero_nombres,` | Instrucción de ejecución en el contexto del script: `ANY_VALUE(v.nombres)   AS vocero_nombres,`. |
| `37` | `                ANY_VALUE(v.apellidos) AS vocero_apellidos,` | Instrucción de ejecución en el contexto del script: `ANY_VALUE(v.apellidos) AS vocero_apellidos,`. |
| `38` | `                COUNT(DISTINCT a.id_aprendiz) AS total_aprendices` | Instrucción de ejecución en el contexto del script: `COUNT(DISTINCT a.id_aprendiz) AS total_aprendices`. |
| `39` | `         FROM fichas f` | Instrucción de ejecución en el contexto del script: `FROM fichas f`. |
| `40` | `         LEFT JOIN voceros    v ON v.id_ficha  = f.id_ficha AND v.activo = 1` | Instrucción de ejecución en el contexto del script: `LEFT JOIN voceros    v ON v.id_ficha  = f.id_ficha AND v.activo = 1`. |
| `41` | `         LEFT JOIN aprendices a ON a.id_ficha  = f.id_ficha AND a.activo = 1` | Instrucción de ejecución en el contexto del script: `LEFT JOIN aprendices a ON a.id_ficha  = f.id_ficha AND a.activo = 1`. |
| `42` | `         WHERE f.id_programa = :prog AND f.activo = 1` | Instrucción de ejecución en el contexto del script: `WHERE f.id_programa = :prog AND f.activo = 1`. |
| `43` | `         GROUP BY f.id_ficha` | Instrucción de ejecución en el contexto del script: `GROUP BY f.id_ficha`. |
| `44` | `         ORDER BY f.numero_ficha"` | Instrucción de ejecución en el contexto del script: `ORDER BY f.numero_ficha"`. |
| `45` | `    );` | Instrucción de ejecución en el contexto del script: `);`. |
| `46` | `    $stmtF->execute([':prog' => $vistaPrograma]);` | Ejecuta la sentencia SQL preparada vinculando los datos correspondientes: `$stmtF->execute([':prog' => $vistaPrograma]);`. |
| `47` | `    $fichasDelProg = $stmtF->fetchAll(PDO::FETCH_ASSOC);` | Obtiene todos los registros coincidentes de la consulta en un arreglo asociativo. |
| `48` | `}` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `49` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `50` | `// ── Nivel 2: aprendices de una ficha ───────────────────────────────────────` | Comentario de línea explicativo: `── Nivel 2: aprendices de una ficha ───────────────────────────────────────`. |
| `51` | `$fichaAct   = null;` | Instrucción de ejecución en el contexto del script: `$fichaAct   = null;`. |
| `52` | `$aprendices = [];` | Instrucción de ejecución en el contexto del script: `$aprendices = [];`. |
| `53` | `if ($vistaFicha) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if ($vistaFicha) {`. |
| `54` | `    $fichaAct = $modelFich->obtenerPorId($vistaFicha);` | Instrucción de ejecución en el contexto del script: `$fichaAct = $modelFich->obtenerPorId($vistaFicha);`. |
| `55` | `    if ($fichaAct) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if ($fichaAct) {`. |
| `56` | `        $vistaPrograma = (int)$fichaAct['id_programa'];` | Instrucción de ejecución en el contexto del script: `$vistaPrograma = (int)$fichaAct['id_programa'];`. |
| `57` | `        $programaAct   = $modelProg->obtenerPorId($vistaPrograma);` | Instrucción de ejecución en el contexto del script: `$programaAct   = $modelProg->obtenerPorId($vistaPrograma);`. |
| `58` | `        // Volver a cargar fichas del programa para el breadcrumb` | Comentario de línea explicativo: `Volver a cargar fichas del programa para el breadcrumb`. |
| `59` | `        $stmtF2 = $db->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmtF2 = $db->prepare(`. |
| `60` | `            "SELECT f.*,` | Instrucción de ejecución en el contexto del script: `"SELECT f.*,`. |
| `61` | `                    ANY_VALUE(v.nombres)   AS vocero_nombres,` | Instrucción de ejecución en el contexto del script: `ANY_VALUE(v.nombres)   AS vocero_nombres,`. |
| `62` | `                    COUNT(DISTINCT a.id_aprendiz) AS total_aprendices` | Instrucción de ejecución en el contexto del script: `COUNT(DISTINCT a.id_aprendiz) AS total_aprendices`. |
| `63` | `             FROM fichas f` | Instrucción de ejecución en el contexto del script: `FROM fichas f`. |
| `64` | `             LEFT JOIN voceros    v ON v.id_ficha = f.id_ficha AND v.activo...` | Instrucción de ejecución en el contexto del script: `LEFT JOIN voceros    v ON v.id_ficha = f.id_ficha AND v.activo = 1`. |
| `65` | `             LEFT JOIN aprendices a ON a.id_ficha = f.id_ficha AND a.activo...` | Instrucción de ejecución en el contexto del script: `LEFT JOIN aprendices a ON a.id_ficha = f.id_ficha AND a.activo = 1`. |
| `66` | `             WHERE f.id_programa = :prog AND f.activo = 1` | Instrucción de ejecución en el contexto del script: `WHERE f.id_programa = :prog AND f.activo = 1`. |
| `67` | `             GROUP BY f.id_ficha ORDER BY f.numero_ficha"` | Instrucción de ejecución en el contexto del script: `GROUP BY f.id_ficha ORDER BY f.numero_ficha"`. |
| `68` | `        );` | Instrucción de ejecución en el contexto del script: `);`. |
| `69` | `        $stmtF2->execute([':prog' => $vistaPrograma]);` | Ejecuta la sentencia SQL preparada vinculando los datos correspondientes: `$stmtF2->execute([':prog' => $vistaPrograma]);`. |
| `70` | `        $fichasDelProg = $stmtF2->fetchAll(PDO::FETCH_ASSOC);` | Obtiene todos los registros coincidentes de la consulta en un arreglo asociativo. |
| `71` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `72` | `        $likeFiltro = '';` | Instrucción de ejecución en el contexto del script: `$likeFiltro = '';`. |
| `73` | `        $params = [':fic' => $vistaFicha, ':fic2' => $vistaFicha];` | Instrucción de ejecución en el contexto del script: `$params = [':fic' => $vistaFicha, ':fic2' => $vistaFicha];`. |
| `74` | `        if ($busqueda) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if ($busqueda) {`. |
| `75` | `            $like = '%' . $busqueda . '%';` | Instrucción de ejecución en el contexto del script: `$like = '%' . $busqueda . '%';`. |
| `76` | `            $likeFiltro = "AND (nombres LIKE :q OR apellidos LIKE :q2 OR do...` | Instrucción de ejecución en el contexto del script: `$likeFiltro = "AND (nombres LIKE :q OR apellidos LIKE :q2 OR documento LIKE :q3)";`. |
| `77` | `            $params[':q'] = $like; $params[':q2'] = $like; $params[':q3'] =...` | Instrucción de ejecución en el contexto del script: `$params[':q'] = $like; $params[':q2'] = $like; $params[':q3'] = $like;`. |
| `78` | `            $params[':q4'] = $like; $params[':q5'] = $like; $params[':q6'] ...` | Instrucción de ejecución en el contexto del script: `$params[':q4'] = $like; $params[':q5'] = $like; $params[':q6'] = $like;`. |
| `79` | `        }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `80` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `81` | `        // Traer TODOS: aprendices de la ficha + voceros que no están en ap...` | Comentario de línea explicativo: `Traer TODOS: aprendices de la ficha + voceros que no están en aprendices`. |
| `82` | `        $stmtAp = $db->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmtAp = $db->prepare(`. |
| `83` | `            "SELECT` | Instrucción de ejecución en el contexto del script: `"SELECT`. |
| `84` | `                a.id_aprendiz,` | Instrucción de ejecución en el contexto del script: `a.id_aprendiz,`. |
| `85` | `                a.nombres,` | Instrucción de ejecución en el contexto del script: `a.nombres,`. |
| `86` | `                a.apellidos,` | Instrucción de ejecución en el contexto del script: `a.apellidos,`. |
| `87` | `                a.documento,` | Instrucción de ejecución en el contexto del script: `a.documento,`. |
| `88` | `                a.celular,` | Instrucción de ejecución en el contexto del script: `a.celular,`. |
| `89` | `                a.correo,` | Instrucción de ejecución en el contexto del script: `a.correo,`. |
| `90` | `                v.id_vocero,` | Instrucción de ejecución en el contexto del script: `v.id_vocero,`. |
| `91` | `                v.activo       AS vocero_activo,` | Instrucción de ejecución en el contexto del script: `v.activo       AS vocero_activo,`. |
| `92` | `                u.primer_acceso,` | Instrucción de ejecución en el contexto del script: `u.primer_acceso,`. |
| `93` | `                u.activo       AS usuario_activo` | Instrucción de ejecución en el contexto del script: `u.activo       AS usuario_activo`. |
| `94` | `             FROM aprendices a` | Instrucción de ejecución en el contexto del script: `FROM aprendices a`. |
| `95` | `             LEFT JOIN voceros  v ON v.id_ficha  = a.id_ficha` | Instrucción de ejecución en el contexto del script: `LEFT JOIN voceros  v ON v.id_ficha  = a.id_ficha`. |
| `96` | `                                 AND v.documento = a.documento` | Instrucción de ejecución en el contexto del script: `AND v.documento = a.documento`. |
| `97` | `             LEFT JOIN usuarios u ON u.id_usuario = v.id_usuario` | Instrucción de ejecución en el contexto del script: `LEFT JOIN usuarios u ON u.id_usuario = v.id_usuario`. |
| `98` | `             WHERE a.id_ficha = :fic AND a.activo = 1` | Instrucción de ejecución en el contexto del script: `WHERE a.id_ficha = :fic AND a.activo = 1`. |
| `99` | `             " . ($busqueda ? "AND (a.nombres LIKE :q OR a.apellidos LIKE :...` | Instrucción de ejecución en el contexto del script: `" . ($busqueda ? "AND (a.nombres LIKE :q OR a.apellidos LIKE :q2 OR a.documento LIKE :q3)" : "") . "`. |
| `100` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `101` | `             UNION` | Instrucción de ejecución en el contexto del script: `UNION`. |
| `102` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `103` | `             SELECT` | Instrucción de ejecución en el contexto del script: `SELECT`. |
| `104` | `                NULL           AS id_aprendiz,` | Instrucción de ejecución en el contexto del script: `NULL           AS id_aprendiz,`. |
| `105` | `                v2.nombres,` | Instrucción de ejecución en el contexto del script: `v2.nombres,`. |
| `106` | `                v2.apellidos,` | Instrucción de ejecución en el contexto del script: `v2.apellidos,`. |
| `107` | `                v2.documento,` | Instrucción de ejecución en el contexto del script: `v2.documento,`. |
| `108` | `                v2.celular,` | Instrucción de ejecución en el contexto del script: `v2.celular,`. |
| `109` | `                v2.correo,` | Instrucción de ejecución en el contexto del script: `v2.correo,`. |
| `110` | `                v2.id_vocero,` | Instrucción de ejecución en el contexto del script: `v2.id_vocero,`. |
| `111` | `                v2.activo      AS vocero_activo,` | Instrucción de ejecución en el contexto del script: `v2.activo      AS vocero_activo,`. |
| `112` | `                u2.primer_acceso,` | Instrucción de ejecución en el contexto del script: `u2.primer_acceso,`. |
| `113` | `                u2.activo      AS usuario_activo` | Instrucción de ejecución en el contexto del script: `u2.activo      AS usuario_activo`. |
| `114` | `             FROM voceros v2` | Instrucción de ejecución en el contexto del script: `FROM voceros v2`. |
| `115` | `             JOIN usuarios u2 ON u2.id_usuario = v2.id_usuario` | Instrucción de ejecución en el contexto del script: `JOIN usuarios u2 ON u2.id_usuario = v2.id_usuario`. |
| `116` | `             WHERE v2.id_ficha = :fic2` | Instrucción de ejecución en el contexto del script: `WHERE v2.id_ficha = :fic2`. |
| `117` | `               AND NOT EXISTS (` | Instrucción de ejecución en el contexto del script: `AND NOT EXISTS (`. |
| `118` | `                   SELECT 1 FROM aprendices a2` | Instrucción de ejecución en el contexto del script: `SELECT 1 FROM aprendices a2`. |
| `119` | `                   WHERE a2.id_ficha   = v2.id_ficha` | Instrucción de ejecución en el contexto del script: `WHERE a2.id_ficha   = v2.id_ficha`. |
| `120` | `                     AND a2.documento  = v2.documento` | Instrucción de ejecución en el contexto del script: `AND a2.documento  = v2.documento`. |
| `121` | `                     AND a2.activo     = 1` | Instrucción de ejecución en el contexto del script: `AND a2.activo     = 1`. |
| `122` | `               )` | Instrucción de ejecución en el contexto del script: `)`. |
| `123` | `             " . ($busqueda ? "AND (v2.nombres LIKE :q4 OR v2.apellidos LIK...` | Instrucción de ejecución en el contexto del script: `" . ($busqueda ? "AND (v2.nombres LIKE :q4 OR v2.apellidos LIKE :q5 OR v2.documento LIKE :q6)" : "") . "`. |
| `124` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `125` | `             ORDER BY apellidos, nombres"` | Instrucción de ejecución en el contexto del script: `ORDER BY apellidos, nombres"`. |
| `126` | `        );` | Instrucción de ejecución en el contexto del script: `);`. |
| `127` | `        $stmtAp->execute($params);` | Ejecuta la sentencia SQL preparada vinculando los datos correspondientes: `$stmtAp->execute($params);`. |
| `128` | `        $aprendices = $stmtAp->fetchAll(PDO::FETCH_ASSOC);` | Obtiene todos los registros coincidentes de la consulta en un arreglo asociativo. |
| `129` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `130` | `        // ¿Cuántos voceros activos tiene esta ficha? (máximo 2)` | Comentario de línea explicativo: `¿Cuántos voceros activos tiene esta ficha? (máximo 2)`. |
| `131` | `        $stmtVAct = $db->prepare("SELECT COUNT(*) FROM voceros WHERE id_fic...` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmtVAct = $db->prepare("SELECT COUNT(*) FROM voceros WHERE id_ficha = :fic AND activo = 1");`. |
| `132` | `        $stmtVAct->execute([':fic' => $vistaFicha]);` | Ejecuta la sentencia SQL preparada vinculando los datos correspondientes: `$stmtVAct->execute([':fic' => $vistaFicha]);`. |
| `133` | `        $totalVocerosActivos = (int)$stmtVAct->fetchColumn();` | Obtiene el valor de una columna única de la primera fila resultante. |
| `134` | `        $hayVoceroActivo = $totalVocerosActivos >= 2; // bloquear si ya hay 2` | Instrucción de ejecución en el contexto del script: `$hayVoceroActivo = $totalVocerosActivos >= 2; // bloquear si ya hay 2`. |
| `135` | `    }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `136` | `}` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `137` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `138` | `require_once __DIR__ . '/../layouts/header.php';` | Importación e inclusión obligatoria del archivo de dependencia requerido: `require_once __DIR__ . '/../layouts/header.php';`. |
| `139` | `?>` | Cierre de la etiqueta PHP para alternar a salida HTML o fin del archivo. |
| `140` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `141` | `<!-- ══ BREADCRUMB + CABECERA ═════════════════════════════════════════════...` | Instrucción de ejecución en el contexto del script: `<!-- ══ BREADCRUMB + CABECERA ════════════════════════════════════════════════ -->`. |
| `142` | `<div class="d-flex justify-content-between align-items-start mb-4 flex-wrap...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="d-flex justify-content-between align-items-start mb-4 flex-wrap gap-3">`. |
| `143` | `    <div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div>`. |
| `144` | `        <nav aria-label="breadcrumb" class="mb-1">` | Barra o elemento de navegación del sistema. |
| `145` | `            <ol class="breadcrumb mb-0" style="font-size:.82rem;">` | Instrucción de ejecución en el contexto del script: `<ol class="breadcrumb mb-0" style="font-size:.82rem;">`. |
| `146` | `                <li class="breadcrumb-item">` | Instrucción de ejecución en el contexto del script: `<li class="breadcrumb-item">`. |
| `147` | `                    <a href="admin_aprendices.php" class="text-success text...` | Enlace hipertexto de navegación o acción: `<a href="admin_aprendices.php" class="text-success text-decoration-none fw-semibold">`. |
| `148` | `                        <i class="fas fa-users me-1"></i>Aprendices` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-users me-1"></i>Aprendices`. |
| `149` | `                    </a>` | Instrucción de ejecución en el contexto del script: `</a>`. |
| `150` | `                </li>` | Instrucción de ejecución en el contexto del script: `</li>`. |
| `151` | `                <?php if ($programaAct): ?>` | Instrucción de ejecución en el contexto del script: `<?php if ($programaAct): ?>`. |
| `152` | `                <li class="breadcrumb-item">` | Instrucción de ejecución en el contexto del script: `<li class="breadcrumb-item">`. |
| `153` | `                    <?php if ($fichaAct): ?>` | Instrucción de ejecución en el contexto del script: `<?php if ($fichaAct): ?>`. |
| `154` | `                        <a href="admin_aprendices.php?programa=<?= $vistaPr...` | Enlace hipertexto de navegación o acción: `<a href="admin_aprendices.php?programa=<?= $vistaPrograma ?>"`. |
| `155` | `                           class="text-success text-decoration-none">` | Instrucción de ejecución en el contexto del script: `class="text-success text-decoration-none">`. |
| `156` | `                            <?= htmlspecialchars($programaAct['nombre']) ?>` | Instrucción de ejecución en el contexto del script: `<?= htmlspecialchars($programaAct['nombre']) ?>`. |
| `157` | `                        </a>` | Instrucción de ejecución en el contexto del script: `</a>`. |
| `158` | `                    <?php else: ?>` | Instrucción de ejecución en el contexto del script: `<?php else: ?>`. |
| `159` | `                        <span class="text-dark fw-semibold"><?= htmlspecial...` | Instrucción de ejecución en el contexto del script: `<span class="text-dark fw-semibold"><?= htmlspecialchars($programaAct['nombre']) ?></span>`. |
| `160` | `                    <?php endif; ?>` | Instrucción de ejecución en el contexto del script: `<?php endif; ?>`. |
| `161` | `                </li>` | Instrucción de ejecución en el contexto del script: `</li>`. |
| `162` | `                <?php endif; ?>` | Instrucción de ejecución en el contexto del script: `<?php endif; ?>`. |
| `163` | `                <?php if ($fichaAct): ?>` | Instrucción de ejecución en el contexto del script: `<?php if ($fichaAct): ?>`. |
| `164` | `                <li class="breadcrumb-item active">` | Instrucción de ejecución en el contexto del script: `<li class="breadcrumb-item active">`. |
| `165` | `                    Ficha <strong class="font-monospace"><?= htmlspecialcha...` | Instrucción de ejecución en el contexto del script: `Ficha <strong class="font-monospace"><?= htmlspecialchars($fichaAct['numero_ficha']) ?></strong>`. |
| `166` | `                </li>` | Instrucción de ejecución en el contexto del script: `</li>`. |
| `167` | `                <?php endif; ?>` | Instrucción de ejecución en el contexto del script: `<?php endif; ?>`. |
| `168` | `            </ol>` | Instrucción de ejecución en el contexto del script: `</ol>`. |
| `169` | `        </nav>` | Barra o elemento de navegación del sistema. |
| `170` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `171` | `        <h4 class="fw-bold mb-0">` | Instrucción de ejecución en el contexto del script: `<h4 class="fw-bold mb-0">`. |
| `172` | `            <?php if ($fichaAct): ?>` | Instrucción de ejecución en el contexto del script: `<?php if ($fichaAct): ?>`. |
| `173` | `                <i class="fas fa-users text-success me-2"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-users text-success me-2"></i>`. |
| `174` | `                Aprendices — Ficha <span class="font-monospace"><?= htmlspe...` | Instrucción de ejecución en el contexto del script: `Aprendices — Ficha <span class="font-monospace"><?= htmlspecialchars($fichaAct['numero_ficha']) ?></span>`. |
| `175` | `            <?php elseif ($programaAct): ?>` | Instrucción de ejecución en el contexto del script: `<?php elseif ($programaAct): ?>`. |
| `176` | `                <i class="fas fa-id-card text-success me-2"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-id-card text-success me-2"></i>`. |
| `177` | `                Fichas — <?= htmlspecialchars($programaAct['nombre']) ?>` | Instrucción de ejecución en el contexto del script: `Fichas — <?= htmlspecialchars($programaAct['nombre']) ?>`. |
| `178` | `            <?php else: ?>` | Instrucción de ejecución en el contexto del script: `<?php else: ?>`. |
| `179` | `                <i class="fas fa-users text-success me-2"></i>Aprendices` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-users text-success me-2"></i>Aprendices`. |
| `180` | `            <?php endif; ?>` | Instrucción de ejecución en el contexto del script: `<?php endif; ?>`. |
| `181` | `        </h4>` | Instrucción de ejecución en el contexto del script: `</h4>`. |
| `182` | `        <p class="text-muted small mb-0">` | Instrucción de ejecución en el contexto del script: `<p class="text-muted small mb-0">`. |
| `183` | `            <?php if ($fichaAct): ?>` | Instrucción de ejecución en el contexto del script: `<?php if ($fichaAct): ?>`. |
| `184` | `                <?= count($aprendices) ?> aprendice(s) en esta ficha` | Instrucción de ejecución en el contexto del script: `<?= count($aprendices) ?> aprendice(s) en esta ficha`. |
| `185` | `            <?php elseif ($programaAct): ?>` | Instrucción de ejecución en el contexto del script: `<?php elseif ($programaAct): ?>`. |
| `186` | `                Selecciona una ficha para ver sus aprendices` | Instrucción de ejecución en el contexto del script: `Selecciona una ficha para ver sus aprendices`. |
| `187` | `            <?php else: ?>` | Instrucción de ejecución en el contexto del script: `<?php else: ?>`. |
| `188` | `                Selecciona un programa de formación` | Instrucción de ejecución en el contexto del script: `Selecciona un programa de formación`. |
| `189` | `            <?php endif; ?>` | Instrucción de ejecución en el contexto del script: `<?php endif; ?>`. |
| `190` | `        </p>` | Instrucción de ejecución en el contexto del script: `</p>`. |
| `191` | `    </div>` | Cierre de contenedor visual `<div>`. |
| `192` | `</div>` | Cierre de contenedor visual `<div>`. |
| `193` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `194` | `<!-- ══ NIVEL 0: GRID DE PROGRAMAS ════════════════════════════════════════...` | Instrucción de ejecución en el contexto del script: `<!-- ══ NIVEL 0: GRID DE PROGRAMAS ════════════════════════════════════════════ -->`. |
| `195` | `<?php if (!$vistaPrograma && !$vistaFicha): ?>` | Instrucción de ejecución en el contexto del script: `<?php if (!$vistaPrograma && !$vistaFicha): ?>`. |
| `196` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `197` | `<div class="row g-3 mb-4">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="row g-3 mb-4">`. |
| `198` | `    <div class="col-sm-4">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="col-sm-4">`. |
| `199` | `        <div class="stat-card bg-white">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="stat-card bg-white">`. |
| `200` | `            <div class="d-flex align-items-center gap-3">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="d-flex align-items-center gap-3">`. |
| `201` | `                <div class="stat-icon" style="background:rgba(57,169,0,.12)...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="stat-icon" style="background:rgba(57,169,0,.12);color:#39a900;">`. |
| `202` | `                    <i class="fas fa-graduation-cap"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-graduation-cap"></i>`. |
| `203` | `                </div>` | Cierre de contenedor visual `<div>`. |
| `204` | `                <div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div>`. |
| `205` | `                    <div class="fs-4 fw-bold"><?= count($programas) ?></div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="fs-4 fw-bold"><?= count($programas) ?></div>`. |
| `206` | `                    <div class="text-muted small">Programas</div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="text-muted small">Programas</div>`. |
| `207` | `                </div>` | Cierre de contenedor visual `<div>`. |
| `208` | `            </div>` | Cierre de contenedor visual `<div>`. |
| `209` | `        </div>` | Cierre de contenedor visual `<div>`. |
| `210` | `    </div>` | Cierre de contenedor visual `<div>`. |
| `211` | `    <div class="col-sm-4">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="col-sm-4">`. |
| `212` | `        <div class="stat-card bg-white">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="stat-card bg-white">`. |
| `213` | `            <div class="d-flex align-items-center gap-3">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="d-flex align-items-center gap-3">`. |
| `214` | `                <div class="stat-icon" style="background:rgba(37,99,235,.1)...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="stat-icon" style="background:rgba(37,99,235,.1);color:#2563eb;">`. |
| `215` | `                    <i class="fas fa-id-card"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-id-card"></i>`. |
| `216` | `                </div>` | Cierre de contenedor visual `<div>`. |
| `217` | `                <div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div>`. |
| `218` | `                    <div class="fs-4 fw-bold"><?= array_sum(array_column($p...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="fs-4 fw-bold"><?= array_sum(array_column($programas, 'total_fichas')) ?></div>`. |
| `219` | `                    <div class="text-muted small">Fichas activas</div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="text-muted small">Fichas activas</div>`. |
| `220` | `                </div>` | Cierre de contenedor visual `<div>`. |
| `221` | `            </div>` | Cierre de contenedor visual `<div>`. |
| `222` | `        </div>` | Cierre de contenedor visual `<div>`. |
| `223` | `    </div>` | Cierre de contenedor visual `<div>`. |
| `224` | `    <div class="col-sm-4">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="col-sm-4">`. |
| `225` | `        <div class="stat-card bg-white">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="stat-card bg-white">`. |
| `226` | `            <div class="d-flex align-items-center gap-3">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="d-flex align-items-center gap-3">`. |
| `227` | `                <div class="stat-icon" style="background:rgba(234,179,8,.1)...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="stat-icon" style="background:rgba(234,179,8,.1);color:#d97706;">`. |
| `228` | `                    <i class="fas fa-users"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-users"></i>`. |
| `229` | `                </div>` | Cierre de contenedor visual `<div>`. |
| `230` | `                <div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div>`. |
| `231` | `                    <div class="fs-4 fw-bold"><?= $totalAprendices ?></div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="fs-4 fw-bold"><?= $totalAprendices ?></div>`. |
| `232` | `                    <div class="text-muted small">Total aprendices</div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="text-muted small">Total aprendices</div>`. |
| `233` | `                </div>` | Cierre de contenedor visual `<div>`. |
| `234` | `            </div>` | Cierre de contenedor visual `<div>`. |
| `235` | `        </div>` | Cierre de contenedor visual `<div>`. |
| `236` | `    </div>` | Cierre de contenedor visual `<div>`. |
| `237` | `</div>` | Cierre de contenedor visual `<div>`. |
| `238` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `239` | `<div class="mb-3">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="mb-3">`. |
| `240` | `    <div class="input-group input-group-sm" style="max-width:320px;">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="input-group input-group-sm" style="max-width:320px;">`. |
| `241` | `        <span class="input-group-text bg-white"><i class="fas fa-search tex...` | Instrucción de ejecución en el contexto del script: `<span class="input-group-text bg-white"><i class="fas fa-search text-muted"></i></span>`. |
| `242` | `        <input type="text" id="buscPrograma" class="form-control border-sta...` | Campo de entrada interactivo para datos del usuario: `<input type="text" id="buscPrograma" class="form-control border-start-0" placeholder="Buscar programa…">`. |
| `243` | `    </div>` | Cierre de contenedor visual `<div>`. |
| `244` | `</div>` | Cierre de contenedor visual `<div>`. |
| `245` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `246` | `<div class="row g-3" id="gridProgramas">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="row g-3" id="gridProgramas">`. |
| `247` | `    <?php foreach ($programas as $p): ?>` | Instrucción de ejecución en el contexto del script: `<?php foreach ($programas as $p): ?>`. |
| `248` | `    <div class="col-md-6 col-lg-4 prog-item">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="col-md-6 col-lg-4 prog-item">`. |
| `249` | `        <a href="admin_aprendices.php?programa=<?= $p['id_programa'] ?>"` | Enlace hipertexto de navegación o acción: `<a href="admin_aprendices.php?programa=<?= $p['id_programa'] ?>"`. |
| `250` | `           class="text-decoration-none">` | Instrucción de ejecución en el contexto del script: `class="text-decoration-none">`. |
| `251` | `            <div class="card border-0 shadow-sm h-100 prog-card" style="bor...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="card border-0 shadow-sm h-100 prog-card" style="border-radius:12px;">`. |
| `252` | `                <div class="card-body p-4">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="card-body p-4">`. |
| `253` | `                    <div class="d-flex align-items-start justify-content-be...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="d-flex align-items-start justify-content-between mb-3">`. |
| `254` | `                        <div style="width:44px;height:44px;border-radius:10px;` | Contenedor visual estructurado con Bootstrap/CSS: `<div style="width:44px;height:44px;border-radius:10px;`. |
| `255` | `                                    background:rgba(57,169,0,.12);color:#39...` | Instrucción de ejecución en el contexto del script: `background:rgba(57,169,0,.12);color:#39a900;`. |
| `256` | `                                    display:flex;align-items:center;justify...` | Instrucción de ejecución en el contexto del script: `display:flex;align-items:center;justify-content:center;font-size:1.2rem;">`. |
| `257` | `                            <i class="fas fa-graduation-cap"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-graduation-cap"></i>`. |
| `258` | `                        </div>` | Cierre de contenedor visual `<div>`. |
| `259` | `                        <span class="badge bg-light text-dark border" style...` | Instrucción de ejecución en el contexto del script: `<span class="badge bg-light text-dark border" style="font-size:.72rem;">`. |
| `260` | `                            <?= htmlspecialchars($p['nivel'] ?? 'Sin nivel'...` | Instrucción de ejecución en el contexto del script: `<?= htmlspecialchars($p['nivel'] ?? 'Sin nivel') ?>`. |
| `261` | `                        </span>` | Instrucción de ejecución en el contexto del script: `</span>`. |
| `262` | `                    </div>` | Cierre de contenedor visual `<div>`. |
| `263` | `                    <h6 class="fw-bold mb-3 text-dark" style="font-size:.88...` | Instrucción de ejecución en el contexto del script: `<h6 class="fw-bold mb-3 text-dark" style="font-size:.88rem;line-height:1.3;">`. |
| `264` | `                        <?= htmlspecialchars($p['nombre']) ?>` | Instrucción de ejecución en el contexto del script: `<?= htmlspecialchars($p['nombre']) ?>`. |
| `265` | `                    </h6>` | Instrucción de ejecución en el contexto del script: `</h6>`. |
| `266` | `                    <div class="d-flex gap-3 pt-3" style="border-top:1px so...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="d-flex gap-3 pt-3" style="border-top:1px solid #e5e7eb;">`. |
| `267` | `                        <div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div>`. |
| `268` | `                            <div class="fw-bold text-success fs-5"><?= (int...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="fw-bold text-success fs-5"><?= (int)$p['total_fichas'] ?></div>`. |
| `269` | `                            <div class="text-muted" style="font-size:.72rem...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="text-muted" style="font-size:.72rem;">Fichas</div>`. |
| `270` | `                        </div>` | Cierre de contenedor visual `<div>`. |
| `271` | `                        <div class="ms-auto d-flex align-items-center text-...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="ms-auto d-flex align-items-center text-success" style="font-size:.82rem;">`. |
| `272` | `                            Ver fichas <i class="fas fa-arrow-right ms-1"></i>` | Instrucción de ejecución en el contexto del script: `Ver fichas <i class="fas fa-arrow-right ms-1"></i>`. |
| `273` | `                        </div>` | Cierre de contenedor visual `<div>`. |
| `274` | `                    </div>` | Cierre de contenedor visual `<div>`. |
| `275` | `                </div>` | Cierre de contenedor visual `<div>`. |
| `276` | `            </div>` | Cierre de contenedor visual `<div>`. |
| `277` | `        </a>` | Instrucción de ejecución en el contexto del script: `</a>`. |
| `278` | `    </div>` | Cierre de contenedor visual `<div>`. |
| `279` | `    <?php endforeach; ?>` | Instrucción de ejecución en el contexto del script: `<?php endforeach; ?>`. |
| `280` | `    <?php if (empty($programas)): ?>` | Instrucción de ejecución en el contexto del script: `<?php if (empty($programas)): ?>`. |
| `281` | `    <div class="col-12">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="col-12">`. |
| `282` | `        <div class="card border-0 shadow-sm text-center py-5 text-muted">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="card border-0 shadow-sm text-center py-5 text-muted">`. |
| `283` | `            <i class="fas fa-graduation-cap fa-3x mb-3 opacity-25 d-block">...` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-graduation-cap fa-3x mb-3 opacity-25 d-block"></i>`. |
| `284` | `            No hay programas registrados.` | Instrucción de ejecución en el contexto del script: `No hay programas registrados.`. |
| `285` | `        </div>` | Cierre de contenedor visual `<div>`. |
| `286` | `    </div>` | Cierre de contenedor visual `<div>`. |
| `287` | `    <?php endif; ?>` | Instrucción de ejecución en el contexto del script: `<?php endif; ?>`. |
| `288` | `</div>` | Cierre de contenedor visual `<div>`. |
| `289` | `<?php endif; ?>` | Instrucción de ejecución en el contexto del script: `<?php endif; ?>`. |
| `290` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `291` | `<!-- ══ NIVEL 1: FICHAS DEL PROGRAMA ══════════════════════════════════════...` | Instrucción de ejecución en el contexto del script: `<!-- ══ NIVEL 1: FICHAS DEL PROGRAMA ═════════════════════════════════════════ -->`. |
| `292` | `<?php if ($vistaPrograma && !$vistaFicha): ?>` | Instrucción de ejecución en el contexto del script: `<?php if ($vistaPrograma && !$vistaFicha): ?>`. |
| `293` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `294` | `<?php $totalApProg = array_sum(array_column($fichasDelProg, 'total_aprendic...` | Instrucción de ejecución en el contexto del script: `<?php $totalApProg = array_sum(array_column($fichasDelProg, 'total_aprendices')); ?>`. |
| `295` | `<div class="row g-3 mb-4">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="row g-3 mb-4">`. |
| `296` | `    <div class="col-sm-4">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="col-sm-4">`. |
| `297` | `        <div class="stat-card bg-white">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="stat-card bg-white">`. |
| `298` | `            <div class="d-flex align-items-center gap-3">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="d-flex align-items-center gap-3">`. |
| `299` | `                <div class="stat-icon" style="background:rgba(37,99,235,.1)...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="stat-icon" style="background:rgba(37,99,235,.1);color:#2563eb;">`. |
| `300` | `                    <i class="fas fa-id-card"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-id-card"></i>`. |
| `301` | `                </div>` | Cierre de contenedor visual `<div>`. |
| `302` | `                <div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div>`. |
| `303` | `                    <div class="fs-4 fw-bold"><?= count($fichasDelProg) ?><...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="fs-4 fw-bold"><?= count($fichasDelProg) ?></div>`. |
| `304` | `                    <div class="text-muted small">Fichas en el programa</div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="text-muted small">Fichas en el programa</div>`. |
| `305` | `                </div>` | Cierre de contenedor visual `<div>`. |
| `306` | `            </div>` | Cierre de contenedor visual `<div>`. |
| `307` | `        </div>` | Cierre de contenedor visual `<div>`. |
| `308` | `    </div>` | Cierre de contenedor visual `<div>`. |
| `309` | `    <div class="col-sm-4">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="col-sm-4">`. |
| `310` | `        <div class="stat-card bg-white">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="stat-card bg-white">`. |
| `311` | `            <div class="d-flex align-items-center gap-3">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="d-flex align-items-center gap-3">`. |
| `312` | `                <div class="stat-icon" style="background:rgba(57,169,0,.12)...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="stat-icon" style="background:rgba(57,169,0,.12);color:#39a900;">`. |
| `313` | `                    <i class="fas fa-users"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-users"></i>`. |
| `314` | `                </div>` | Cierre de contenedor visual `<div>`. |
| `315` | `                <div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div>`. |
| `316` | `                    <div class="fs-4 fw-bold"><?= $totalApProg ?></div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="fs-4 fw-bold"><?= $totalApProg ?></div>`. |
| `317` | `                    <div class="text-muted small">Aprendices en el programa...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="text-muted small">Aprendices en el programa</div>`. |
| `318` | `                </div>` | Cierre de contenedor visual `<div>`. |
| `319` | `            </div>` | Cierre de contenedor visual `<div>`. |
| `320` | `        </div>` | Cierre de contenedor visual `<div>`. |
| `321` | `    </div>` | Cierre de contenedor visual `<div>`. |
| `322` | `    <div class="col-sm-4">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="col-sm-4">`. |
| `323` | `        <div class="stat-card bg-white">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="stat-card bg-white">`. |
| `324` | `            <div class="d-flex align-items-center gap-3">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="d-flex align-items-center gap-3">`. |
| `325` | `                <div class="stat-icon" style="background:rgba(234,179,8,.1)...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="stat-icon" style="background:rgba(234,179,8,.1);color:#d97706;">`. |
| `326` | `                    <i class="fas fa-user-tie"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-user-tie"></i>`. |
| `327` | `                </div>` | Cierre de contenedor visual `<div>`. |
| `328` | `                <div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div>`. |
| `329` | `                    <div class="fs-4 fw-bold">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="fs-4 fw-bold">`. |
| `330` | `                        <?= count(array_filter($fichasDelProg, fn($f) => !e...` | Instrucción de ejecución en el contexto del script: `<?= count(array_filter($fichasDelProg, fn($f) => !empty($f['vocero_nombres']))) ?>`. |
| `331` | `                        /<?= count($fichasDelProg) ?>` | Instrucción de ejecución en el contexto del script: `/<?= count($fichasDelProg) ?>`. |
| `332` | `                    </div>` | Cierre de contenedor visual `<div>`. |
| `333` | `                    <div class="text-muted small">Con vocero asignado</div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="text-muted small">Con vocero asignado</div>`. |
| `334` | `                </div>` | Cierre de contenedor visual `<div>`. |
| `335` | `            </div>` | Cierre de contenedor visual `<div>`. |
| `336` | `        </div>` | Cierre de contenedor visual `<div>`. |
| `337` | `    </div>` | Cierre de contenedor visual `<div>`. |
| `338` | `</div>` | Cierre de contenedor visual `<div>`. |
| `339` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `340` | `<div class="row g-3">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="row g-3">`. |
| `341` | `    <?php foreach ($fichasDelProg as $f): ?>` | Instrucción de ejecución en el contexto del script: `<?php foreach ($fichasDelProg as $f): ?>`. |
| `342` | `    <div class="col-md-6 col-lg-4">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="col-md-6 col-lg-4">`. |
| `343` | `        <a href="admin_aprendices.php?ficha=<?= $f['id_ficha'] ?>" class="t...` | Enlace hipertexto de navegación o acción: `<a href="admin_aprendices.php?ficha=<?= $f['id_ficha'] ?>" class="text-decoration-none">`. |
| `344` | `            <div class="card border-0 shadow-sm h-100 prog-card" style="bor...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="card border-0 shadow-sm h-100 prog-card" style="border-radius:12px;">`. |
| `345` | `                <div class="card-body p-4">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="card-body p-4">`. |
| `346` | `                    <div class="d-flex align-items-start justify-content-be...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="d-flex align-items-start justify-content-between mb-3">`. |
| `347` | `                        <div style="width:44px;height:44px;border-radius:10px;` | Contenedor visual estructurado con Bootstrap/CSS: `<div style="width:44px;height:44px;border-radius:10px;`. |
| `348` | `                                    background:rgba(37,99,235,.1);color:#25...` | Instrucción de ejecución en el contexto del script: `background:rgba(37,99,235,.1);color:#2563eb;`. |
| `349` | `                                    display:flex;align-items:center;justify...` | Instrucción de ejecución en el contexto del script: `display:flex;align-items:center;justify-content:center;font-size:1.1rem;">`. |
| `350` | `                            <i class="fas fa-id-card"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-id-card"></i>`. |
| `351` | `                        </div>` | Cierre de contenedor visual `<div>`. |
| `352` | `                        <span class="badge bg-light text-dark border">` | Instrucción de ejecución en el contexto del script: `<span class="badge bg-light text-dark border">`. |
| `353` | `                            <?= htmlspecialchars($f['jornada']) ?>` | Instrucción de ejecución en el contexto del script: `<?= htmlspecialchars($f['jornada']) ?>`. |
| `354` | `                        </span>` | Instrucción de ejecución en el contexto del script: `</span>`. |
| `355` | `                    </div>` | Cierre de contenedor visual `<div>`. |
| `356` | `                    <div class="fw-bold text-success font-monospace mb-1" s...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="fw-bold text-success font-monospace mb-1" style="font-size:1.3rem;">`. |
| `357` | `                        <?= htmlspecialchars($f['numero_ficha']) ?>` | Instrucción de ejecución en el contexto del script: `<?= htmlspecialchars($f['numero_ficha']) ?>`. |
| `358` | `                    </div>` | Cierre de contenedor visual `<div>`. |
| `359` | `                    <div class="text-muted small mb-3">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="text-muted small mb-3">`. |
| `360` | `                        <?php if ($f['vocero_nombres']): ?>` | Instrucción de ejecución en el contexto del script: `<?php if ($f['vocero_nombres']): ?>`. |
| `361` | `                            <i class="fas fa-user-tie me-1" style="font-siz...` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-user-tie me-1" style="font-size:.75rem;"></i>`. |
| `362` | `                            <?= htmlspecialchars($f['vocero_nombres']) ?>` | Instrucción de ejecución en el contexto del script: `<?= htmlspecialchars($f['vocero_nombres']) ?>`. |
| `363` | `                        <?php else: ?>` | Instrucción de ejecución en el contexto del script: `<?php else: ?>`. |
| `364` | `                            <span class="text-warning"><i class="fas fa-exc...` | Instrucción de ejecución en el contexto del script: `<span class="text-warning"><i class="fas fa-exclamation-circle me-1"></i>Sin vocero</span>`. |
| `365` | `                        <?php endif; ?>` | Instrucción de ejecución en el contexto del script: `<?php endif; ?>`. |
| `366` | `                    </div>` | Cierre de contenedor visual `<div>`. |
| `367` | `                    <div class="d-flex gap-3 pt-3" style="border-top:1px so...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="d-flex gap-3 pt-3" style="border-top:1px solid #e5e7eb;">`. |
| `368` | `                        <div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div>`. |
| `369` | `                            <div class="fw-bold text-success fs-5"><?= (int...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="fw-bold text-success fs-5"><?= (int)$f['total_aprendices'] ?></div>`. |
| `370` | `                            <div class="text-muted" style="font-size:.72rem...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="text-muted" style="font-size:.72rem;">Aprendices</div>`. |
| `371` | `                        </div>` | Cierre de contenedor visual `<div>`. |
| `372` | `                        <div class="ms-auto d-flex align-items-center text-...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="ms-auto d-flex align-items-center text-success" style="font-size:.82rem;">`. |
| `373` | `                            Ver lista <i class="fas fa-arrow-right ms-1"></i>` | Instrucción de ejecución en el contexto del script: `Ver lista <i class="fas fa-arrow-right ms-1"></i>`. |
| `374` | `                        </div>` | Cierre de contenedor visual `<div>`. |
| `375` | `                    </div>` | Cierre de contenedor visual `<div>`. |
| `376` | `                </div>` | Cierre de contenedor visual `<div>`. |
| `377` | `            </div>` | Cierre de contenedor visual `<div>`. |
| `378` | `        </a>` | Instrucción de ejecución en el contexto del script: `</a>`. |
| `379` | `    </div>` | Cierre de contenedor visual `<div>`. |
| `380` | `    <?php endforeach; ?>` | Instrucción de ejecución en el contexto del script: `<?php endforeach; ?>`. |
| `381` | `    <?php if (empty($fichasDelProg)): ?>` | Instrucción de ejecución en el contexto del script: `<?php if (empty($fichasDelProg)): ?>`. |
| `382` | `    <div class="col-12">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="col-12">`. |
| `383` | `        <div class="card border-0 shadow-sm text-center py-5 text-muted">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="card border-0 shadow-sm text-center py-5 text-muted">`. |
| `384` | `            <i class="fas fa-id-card fa-3x mb-3 opacity-25 d-block"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-id-card fa-3x mb-3 opacity-25 d-block"></i>`. |
| `385` | `            No hay fichas registradas en este programa.` | Instrucción de ejecución en el contexto del script: `No hay fichas registradas en este programa.`. |
| `386` | `        </div>` | Cierre de contenedor visual `<div>`. |
| `387` | `    </div>` | Cierre de contenedor visual `<div>`. |
| `388` | `    <?php endif; ?>` | Instrucción de ejecución en el contexto del script: `<?php endif; ?>`. |
| `389` | `</div>` | Cierre de contenedor visual `<div>`. |
| `390` | `<?php endif; ?>` | Instrucción de ejecución en el contexto del script: `<?php endif; ?>`. |
| `391` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `392` | `<!-- ══ NIVEL 2: APRENDICES DE LA FICHA ═══════════════════════════════════...` | Instrucción de ejecución en el contexto del script: `<!-- ══ NIVEL 2: APRENDICES DE LA FICHA ══════════════════════════════════════ -->`. |
| `393` | `<?php if ($vistaFicha && $fichaAct): ?>` | Instrucción de ejecución en el contexto del script: `<?php if ($vistaFicha && $fichaAct): ?>`. |
| `394` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `395` | `<div class="row g-3 mb-4">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="row g-3 mb-4">`. |
| `396` | `    <div class="col-sm-4">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="col-sm-4">`. |
| `397` | `        <div class="stat-card bg-white">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="stat-card bg-white">`. |
| `398` | `            <div class="d-flex align-items-center gap-3">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="d-flex align-items-center gap-3">`. |
| `399` | `                <div class="stat-icon" style="background:rgba(57,169,0,.12)...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="stat-icon" style="background:rgba(57,169,0,.12);color:#39a900;">`. |
| `400` | `                    <i class="fas fa-users"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-users"></i>`. |
| `401` | `                </div>` | Cierre de contenedor visual `<div>`. |
| `402` | `                <div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div>`. |
| `403` | `                    <div class="fs-4 fw-bold"><?= count($aprendices) ?></div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="fs-4 fw-bold"><?= count($aprendices) ?></div>`. |
| `404` | `                    <div class="text-muted small">Aprendices en la ficha</div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="text-muted small">Aprendices en la ficha</div>`. |
| `405` | `                </div>` | Cierre de contenedor visual `<div>`. |
| `406` | `            </div>` | Cierre de contenedor visual `<div>`. |
| `407` | `        </div>` | Cierre de contenedor visual `<div>`. |
| `408` | `    </div>` | Cierre de contenedor visual `<div>`. |
| `409` | `    <div class="col-sm-4">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="col-sm-4">`. |
| `410` | `        <div class="stat-card bg-white">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="stat-card bg-white">`. |
| `411` | `            <div class="d-flex align-items-center gap-3">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="d-flex align-items-center gap-3">`. |
| `412` | `                <div class="stat-icon" style="background:rgba(234,179,8,.1)...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="stat-icon" style="background:rgba(234,179,8,.1);color:#d97706;">`. |
| `413` | `                    <i class="fas fa-user-tie"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-user-tie"></i>`. |
| `414` | `                </div>` | Cierre de contenedor visual `<div>`. |
| `415` | `                <div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div>`. |
| `416` | `                    <div class="fs-4 fw-bold"><?= $totalVocerosActivos ?>/2...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="fs-4 fw-bold"><?= $totalVocerosActivos ?>/2</div>`. |
| `417` | `                    <div class="text-muted small">Voceros activos</div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="text-muted small">Voceros activos</div>`. |
| `418` | `                </div>` | Cierre de contenedor visual `<div>`. |
| `419` | `            </div>` | Cierre de contenedor visual `<div>`. |
| `420` | `        </div>` | Cierre de contenedor visual `<div>`. |
| `421` | `    </div>` | Cierre de contenedor visual `<div>`. |
| `422` | `    <div class="col-sm-4">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="col-sm-4">`. |
| `423` | `        <div class="stat-card bg-white">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="stat-card bg-white">`. |
| `424` | `            <div class="d-flex align-items-center gap-3">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="d-flex align-items-center gap-3">`. |
| `425` | `                <div class="stat-icon" style="background:rgba(37,99,235,.1)...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="stat-icon" style="background:rgba(37,99,235,.1);color:#2563eb;">`. |
| `426` | `                    <i class="fas fa-clock"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-clock"></i>`. |
| `427` | `                </div>` | Cierre de contenedor visual `<div>`. |
| `428` | `                <div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div>`. |
| `429` | `                    <div class="fw-bold"><?= htmlspecialchars($fichaAct['jo...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="fw-bold"><?= htmlspecialchars($fichaAct['jornada']) ?></div>`. |
| `430` | `                    <div class="text-muted small">Jornada</div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="text-muted small">Jornada</div>`. |
| `431` | `                </div>` | Cierre de contenedor visual `<div>`. |
| `432` | `            </div>` | Cierre de contenedor visual `<div>`. |
| `433` | `        </div>` | Cierre de contenedor visual `<div>`. |
| `434` | `    </div>` | Cierre de contenedor visual `<div>`. |
| `435` | `</div>` | Cierre de contenedor visual `<div>`. |
| `436` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `437` | `<!-- Buscador inline -->` | Instrucción de ejecución en el contexto del script: `<!-- Buscador inline -->`. |
| `438` | `<div class="card shadow-sm border-0">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="card shadow-sm border-0">`. |
| `439` | `    <div class="card-header bg-white border-0 py-3 d-flex justify-content-b...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="card-header bg-white border-0 py-3 d-flex justify-content-between align-items-center flex-wrap gap-2">`. |
| `440` | `        <h6 class="fw-bold mb-0">` | Instrucción de ejecución en el contexto del script: `<h6 class="fw-bold mb-0">`. |
| `441` | `            <i class="fas fa-users text-success me-2"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-users text-success me-2"></i>`. |
| `442` | `            Listado de Aprendices` | Instrucción de ejecución en el contexto del script: `Listado de Aprendices`. |
| `443` | `            <span class="text-muted fw-normal small ms-2">— <?= htmlspecial...` | Instrucción de ejecución en el contexto del script: `<span class="text-muted fw-normal small ms-2">— <?= htmlspecialchars($fichaAct['nombre_programa']) ?></span>`. |
| `444` | `        </h6>` | Instrucción de ejecución en el contexto del script: `</h6>`. |
| `445` | `        <div class="d-flex gap-2 align-items-center">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="d-flex gap-2 align-items-center">`. |
| `446` | `            <span class="badge bg-success"><?= count($aprendices) ?> aprend...` | Instrucción de ejecución en el contexto del script: `<span class="badge bg-success"><?= count($aprendices) ?> aprendice(s)</span>`. |
| `447` | `            <form method="GET" class="d-flex gap-1">` | Formulario para recolección y envío de datos del usuario: `<form method="GET" class="d-flex gap-1">`. |
| `448` | `                <input type="hidden" name="ficha" value="<?= $vistaFicha ?>">` | Campo de entrada interactivo para datos del usuario: `<input type="hidden" name="ficha" value="<?= $vistaFicha ?>">`. |
| `449` | `                <div class="input-group input-group-sm" style="max-width:22...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="input-group input-group-sm" style="max-width:220px;">`. |
| `450` | `                    <span class="input-group-text bg-white"><i class="fas f...` | Instrucción de ejecución en el contexto del script: `<span class="input-group-text bg-white"><i class="fas fa-search text-muted"></i></span>`. |
| `451` | `                    <input type="text" name="q" class="form-control border-...` | Campo de entrada interactivo para datos del usuario: `<input type="text" name="q" class="form-control border-start-0"`. |
| `452` | `                           placeholder="Buscar…" value="<?= htmlspecialchar...` | Instrucción de ejecución en el contexto del script: `placeholder="Buscar…" value="<?= htmlspecialchars($busqueda) ?>">`. |
| `453` | `                </div>` | Cierre de contenedor visual `<div>`. |
| `454` | `                <button type="submit" class="btn btn-sm btn-success"><i cla...` | Botón de acción interactivo para el usuario: `<button type="submit" class="btn btn-sm btn-success"><i class="fas fa-search"></i></button>`. |
| `455` | `                <?php if ($busqueda): ?>` | Instrucción de ejecución en el contexto del script: `<?php if ($busqueda): ?>`. |
| `456` | `                    <a href="admin_aprendices.php?ficha=<?= $vistaFicha ?>"` | Enlace hipertexto de navegación o acción: `<a href="admin_aprendices.php?ficha=<?= $vistaFicha ?>"`. |
| `457` | `                       class="btn btn-sm btn-outline-secondary"><i class="f...` | Instrucción de ejecución en el contexto del script: `class="btn btn-sm btn-outline-secondary"><i class="fas fa-xmark"></i></a>`. |
| `458` | `                <?php endif; ?>` | Instrucción de ejecución en el contexto del script: `<?php endif; ?>`. |
| `459` | `            </form>` | Cierre de formulario HTML. |
| `460` | `        </div>` | Cierre de contenedor visual `<div>`. |
| `461` | `    </div>` | Cierre de contenedor visual `<div>`. |
| `462` | `    <!-- Nota informativa -->` | Instrucción de ejecución en el contexto del script: `<!-- Nota informativa -->`. |
| `463` | `    <div class="px-4 py-2" style="background:#f8fafc; border-bottom:1px sol...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="px-4 py-2" style="background:#f8fafc; border-bottom:1px solid #e5e7eb; font-size:.8rem; color:#64748b;">`. |
| `464` | `        <i class="fas fa-circle-info me-1 text-success"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-circle-info me-1 text-success"></i>`. |
| `465` | `        Cambia el rol de un aprendiz a <strong>Vocero</strong> para activar...` | Instrucción de ejecución en el contexto del script: `Cambia el rol de un aprendiz a <strong>Vocero</strong> para activar su cuenta de acceso al sistema.`. |
| `466` | `        Puede haber <strong>máximo 2 voceros activos</strong> por ficha (vo...` | Instrucción de ejecución en el contexto del script: `Puede haber <strong>máximo 2 voceros activos</strong> por ficha (vocero y subvocero).`. |
| `467` | `        Al cambiarlo a <strong>Aprendiz</strong> su cuenta queda desactivada.` | Instrucción de ejecución en el contexto del script: `Al cambiarlo a <strong>Aprendiz</strong> su cuenta queda desactivada.`. |
| `468` | `    </div>` | Cierre de contenedor visual `<div>`. |
| `469` | `    <div class="card-body p-0">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="card-body p-0">`. |
| `470` | `        <?php if (empty($aprendices)): ?>` | Instrucción de ejecución en el contexto del script: `<?php if (empty($aprendices)): ?>`. |
| `471` | `        <div class="text-center py-5 text-muted">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="text-center py-5 text-muted">`. |
| `472` | `            <i class="fas fa-users fa-3x mb-3 opacity-25 d-block"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-users fa-3x mb-3 opacity-25 d-block"></i>`. |
| `473` | `            <p class="small mb-0">` | Instrucción de ejecución en el contexto del script: `<p class="small mb-0">`. |
| `474` | `                <?= $busqueda ? 'No hay resultados para "' . htmlspecialcha...` | Instrucción de ejecución en el contexto del script: `<?= $busqueda ? 'No hay resultados para "' . htmlspecialchars($busqueda) . '".' : 'No hay aprendices sincronizados en esta ficha.' ?>`. |
| `475` | `            </p>` | Instrucción de ejecución en el contexto del script: `</p>`. |
| `476` | `        </div>` | Cierre de contenedor visual `<div>`. |
| `477` | `        <?php else: ?>` | Instrucción de ejecución en el contexto del script: `<?php else: ?>`. |
| `478` | `        <div class="table-responsive">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="table-responsive">`. |
| `479` | `            <table class="table tabla-limpia align-middle mb-0">` | Tabla de datos para despliegue estructurado de información: `<table class="table tabla-limpia align-middle mb-0">`. |
| `480` | `                <thead class="table-light">` | Celda de tabla con contenido de datos o encabezado de columna: `<thead class="table-light">`. |
| `481` | `                    <tr>` | Fila contenedora de datos dentro de la tabla. |
| `482` | `                        <th>#</th>` | Celda de tabla con contenido de datos o encabezado de columna: `<th>#</th>`. |
| `483` | `                        <th>Apellidos</th>` | Celda de tabla con contenido de datos o encabezado de columna: `<th>Apellidos</th>`. |
| `484` | `                        <th>Nombres</th>` | Celda de tabla con contenido de datos o encabezado de columna: `<th>Nombres</th>`. |
| `485` | `                        <th>Documento</th>` | Celda de tabla con contenido de datos o encabezado de columna: `<th>Documento</th>`. |
| `486` | `                        <th>Celular</th>` | Celda de tabla con contenido de datos o encabezado de columna: `<th>Celular</th>`. |
| `487` | `                        <th>Correo</th>` | Celda de tabla con contenido de datos o encabezado de columna: `<th>Correo</th>`. |
| `488` | `                        <th class="text-center">Rol</th>` | Celda de tabla con contenido de datos o encabezado de columna: `<th class="text-center">Rol</th>`. |
| `489` | `                        <th class="text-center">Acceso</th>` | Celda de tabla con contenido de datos o encabezado de columna: `<th class="text-center">Acceso</th>`. |
| `490` | `                    </tr>` | Fila contenedora de datos dentro de la tabla. |
| `491` | `                </thead>` | Instrucción de ejecución en el contexto del script: `</thead>`. |
| `492` | `                <tbody>` | Instrucción de ejecución en el contexto del script: `<tbody>`. |
| `493` | `                <?php foreach ($aprendices as $i => $ap):` | Instrucción de ejecución en el contexto del script: `<?php foreach ($aprendices as $i => $ap):`. |
| `494` | `                    $tieneVoceroActivo   = !empty($ap['id_vocero']) && (int...` | Instrucción de ejecución en el contexto del script: `$tieneVoceroActivo   = !empty($ap['id_vocero']) && (int)($ap['vocero_activo'] ?? 0) === 1;`. |
| `495` | `                    $tieneVoceroInactivo = !empty($ap['id_vocero']) && (int...` | Instrucción de ejecución en el contexto del script: `$tieneVoceroInactivo = !empty($ap['id_vocero']) && (int)($ap['vocero_activo'] ?? 0) === 0;`. |
| `496` | `                    $celular = $ap['celular'] ?? null;` | Instrucción de ejecución en el contexto del script: `$celular = $ap['celular'] ?? null;`. |
| `497` | `                    $correo  = $ap['correo']  ?? null;` | Instrucción de ejecución en el contexto del script: `$correo  = $ap['correo']  ?? null;`. |
| `498` | `                ?>` | Cierre de la etiqueta PHP para alternar a salida HTML o fin del archivo. |
| `499` | `                <tr class="<?= $tieneVoceroActivo ? 'table-warning bg-opaci...` | Fila contenedora de datos dentro de la tabla. |
| `500` | `                    <td class="text-muted small"><?= $i + 1 ?></td>` | Celda de tabla con contenido de datos o encabezado de columna: `<td class="text-muted small"><?= $i + 1 ?></td>`. |
| `501` | `                    <td class="fw-semibold small"><?= htmlspecialchars($ap[...` | Celda de tabla con contenido de datos o encabezado de columna: `<td class="fw-semibold small"><?= htmlspecialchars($ap['apellidos']) ?></td>`. |
| `502` | `                    <td class="small"><?= htmlspecialchars($ap['nombres']) ...` | Celda de tabla con contenido de datos o encabezado de columna: `<td class="small"><?= htmlspecialchars($ap['nombres']) ?></td>`. |
| `503` | `                    <td class="small text-muted"><?= htmlspecialchars($ap['...` | Celda de tabla con contenido de datos o encabezado de columna: `<td class="small text-muted"><?= htmlspecialchars($ap['documento'] ?? '—') ?></td>`. |
| `504` | `                    <td class="small">` | Celda de tabla con contenido de datos o encabezado de columna: `<td class="small">`. |
| `505` | `                        <?php if ($celular): ?>` | Instrucción de ejecución en el contexto del script: `<?php if ($celular): ?>`. |
| `506` | `                            <a href="tel:<?= htmlspecialchars($celular) ?>"...` | Enlace hipertexto de navegación o acción: `<a href="tel:<?= htmlspecialchars($celular) ?>" class="text-decoration-none text-dark">`. |
| `507` | `                                <i class="fas fa-phone text-success me-1" s...` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-phone text-success me-1" style="font-size:.72rem;"></i><?= htmlspecialchars($celular) ?>`. |
| `508` | `                            </a>` | Instrucción de ejecución en el contexto del script: `</a>`. |
| `509` | `                        <?php else: ?><span class="text-muted">—</span><?ph...` | Instrucción de ejecución en el contexto del script: `<?php else: ?><span class="text-muted">—</span><?php endif; ?>`. |
| `510` | `                    </td>` | Celda de tabla con contenido de datos o encabezado de columna: `</td>`. |
| `511` | `                    <td class="small">` | Celda de tabla con contenido de datos o encabezado de columna: `<td class="small">`. |
| `512` | `                        <?php if ($correo): ?>` | Instrucción de ejecución en el contexto del script: `<?php if ($correo): ?>`. |
| `513` | `                            <a href="mailto:<?= htmlspecialchars($correo) ?>"` | Enlace hipertexto de navegación o acción: `<a href="mailto:<?= htmlspecialchars($correo) ?>"`. |
| `514` | `                               class="text-decoration-none text-dark text-t...` | Instrucción de ejecución en el contexto del script: `class="text-decoration-none text-dark text-truncate d-inline-block"`. |
| `515` | `                               style="max-width:160px;" title="<?= htmlspec...` | Instrucción de ejecución en el contexto del script: `style="max-width:160px;" title="<?= htmlspecialchars($correo) ?>">`. |
| `516` | `                                <i class="fas fa-envelope text-success me-1...` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-envelope text-success me-1" style="font-size:.72rem;"></i><?= htmlspecialchars($correo) ?>`. |
| `517` | `                            </a>` | Instrucción de ejecución en el contexto del script: `</a>`. |
| `518` | `                        <?php else: ?><span class="text-muted">—</span><?ph...` | Instrucción de ejecución en el contexto del script: `<?php else: ?><span class="text-muted">—</span><?php endif; ?>`. |
| `519` | `                    </td>` | Celda de tabla con contenido de datos o encabezado de columna: `</td>`. |
| `520` | `                    <td class="text-center" style="width:160px;">` | Celda de tabla con contenido de datos o encabezado de columna: `<td class="text-center" style="width:160px;">`. |
| `521` | `                        <form action="../../controllers/AdminController.php...` | Formulario para recolección y envío de datos del usuario: `<form action="../../controllers/AdminController.php" method="POST">`. |
| `522` | `                            <input type="hidden" name="id_aprendiz" value="...` | Campo de entrada interactivo para datos del usuario: `<input type="hidden" name="id_aprendiz" value="<?= $ap['id_aprendiz'] ?? '' ?>">`. |
| `523` | `                            <input type="hidden" name="id_ficha"    value="...` | Campo de entrada interactivo para datos del usuario: `<input type="hidden" name="id_ficha"    value="<?= $vistaFicha ?>">`. |
| `524` | `                            <?php` | Apertura obligatoria de la etiqueta PHP para ejecución del código del lado del servidor. |
| `525` | `                            $tieneVoceroActivo   = !empty($ap['id_vocero'])...` | Instrucción de ejecución en el contexto del script: `$tieneVoceroActivo   = !empty($ap['id_vocero']) && (int)($ap['vocero_activo'] ?? 0) === 1;`. |
| `526` | `                            $tieneVoceroInactivo = !empty($ap['id_vocero'])...` | Instrucción de ejecución en el contexto del script: `$tieneVoceroInactivo = !empty($ap['id_vocero']) && (int)($ap['vocero_activo'] ?? 0) === 0;`. |
| `527` | `                            ?>` | Cierre de la etiqueta PHP para alternar a salida HTML o fin del archivo. |
| `528` | `                            <?php if ($tieneVoceroActivo): ?>` | Instrucción de ejecución en el contexto del script: `<?php if ($tieneVoceroActivo): ?>`. |
| `529` | `                                <!-- Vocero activo → puede desactivarse -->` | Instrucción de ejecución en el contexto del script: `<!-- Vocero activo → puede desactivarse -->`. |
| `530` | `                                <input type="hidden" name="id_vocero" value...` | Campo de entrada interactivo para datos del usuario: `<input type="hidden" name="id_vocero" value="<?= $ap['id_vocero'] ?>">`. |
| `531` | `                                <input type="hidden" name="accion"    value...` | Campo de entrada interactivo para datos del usuario: `<input type="hidden" name="accion"    value="desactivar_vocero">`. |
| `532` | `                                <select class="form-select form-select-sm"` | Menú desplegable de opciones de selección: `<select class="form-select form-select-sm"`. |
| `533` | `                                        onchange="this.form.submit()"` | Instrucción de ejecución en el contexto del script: `onchange="this.form.submit()"`. |
| `534` | `                                        style="border-color:#39a900;color:#...` | Instrucción de ejecución en el contexto del script: `style="border-color:#39a900;color:#166534;background:#f0fdf4;font-weight:600;">`. |
| `535` | `                                    <option value="aprendiz">Aprendiz</option>` | Elemento de opción seleccionable dentro de una lista: `<option value="aprendiz">Aprendiz</option>`. |
| `536` | `                                    <option value="vocero" selected>Vocero<...` | Elemento de opción seleccionable dentro de una lista: `<option value="vocero" selected>Vocero</option>`. |
| `537` | `                                </select>` | Menú desplegable de opciones de selección: `</select>`. |
| `538` | `                            <?php elseif ($tieneVoceroInactivo): ?>` | Instrucción de ejecución en el contexto del script: `<?php elseif ($tieneVoceroInactivo): ?>`. |
| `539` | `                                <!-- Vocero inactivo → puede reactivarse si...` | Instrucción de ejecución en el contexto del script: `<!-- Vocero inactivo → puede reactivarse si hay cupo -->`. |
| `540` | `                                <?php if (!$hayVoceroActivo): ?>` | Instrucción de ejecución en el contexto del script: `<?php if (!$hayVoceroActivo): ?>`. |
| `541` | `                                <input type="hidden" name="id_vocero" value...` | Campo de entrada interactivo para datos del usuario: `<input type="hidden" name="id_vocero" value="<?= $ap['id_vocero'] ?>">`. |
| `542` | `                                <input type="hidden" name="accion"    value...` | Campo de entrada interactivo para datos del usuario: `<input type="hidden" name="accion"    value="reactivar_vocero">`. |
| `543` | `                                <select class="form-select form-select-sm"` | Menú desplegable de opciones de selección: `<select class="form-select form-select-sm"`. |
| `544` | `                                        onchange="this.form.submit()"` | Instrucción de ejecución en el contexto del script: `onchange="this.form.submit()"`. |
| `545` | `                                        style="color:#6b7280;">` | Instrucción de ejecución en el contexto del script: `style="color:#6b7280;">`. |
| `546` | `                                    <option value="aprendiz" selected>Apren...` | Elemento de opción seleccionable dentro de una lista: `<option value="aprendiz" selected>Aprendiz</option>`. |
| `547` | `                                    <option value="vocero">Vocero</option>` | Elemento de opción seleccionable dentro de una lista: `<option value="vocero">Vocero</option>`. |
| `548` | `                                </select>` | Menú desplegable de opciones de selección: `</select>`. |
| `549` | `                                <?php else: ?>` | Instrucción de ejecución en el contexto del script: `<?php else: ?>`. |
| `550` | `                                <select class="form-select form-select-sm" ...` | Menú desplegable de opciones de selección: `<select class="form-select form-select-sm" disabled`. |
| `551` | `                                        style="color:#9ca3af;" title="Ya ha...` | Instrucción de ejecución en el contexto del script: `style="color:#9ca3af;" title="Ya hay 2 voceros activos">`. |
| `552` | `                                    <option>Aprendiz</option>` | Elemento de opción seleccionable dentro de una lista: `<option>Aprendiz</option>`. |
| `553` | `                                </select>` | Menú desplegable de opciones de selección: `</select>`. |
| `554` | `                                <?php endif; ?>` | Instrucción de ejecución en el contexto del script: `<?php endif; ?>`. |
| `555` | `                            <?php elseif (!$hayVoceroActivo): ?>` | Instrucción de ejecución en el contexto del script: `<?php elseif (!$hayVoceroActivo): ?>`. |
| `556` | `                                <!-- Sin cuenta de vocero → activar por pri...` | Instrucción de ejecución en el contexto del script: `<!-- Sin cuenta de vocero → activar por primera vez -->`. |
| `557` | `                                <input type="hidden" name="accion" value="a...` | Campo de entrada interactivo para datos del usuario: `<input type="hidden" name="accion" value="activar_vocero">`. |
| `558` | `                                <select class="form-select form-select-sm"` | Menú desplegable de opciones de selección: `<select class="form-select form-select-sm"`. |
| `559` | `                                        onchange="this.form.submit()"` | Instrucción de ejecución en el contexto del script: `onchange="this.form.submit()"`. |
| `560` | `                                        style="color:#6b7280;">` | Instrucción de ejecución en el contexto del script: `style="color:#6b7280;">`. |
| `561` | `                                    <option value="aprendiz" selected>Apren...` | Elemento de opción seleccionable dentro de una lista: `<option value="aprendiz" selected>Aprendiz</option>`. |
| `562` | `                                    <option value="vocero">Vocero</option>` | Elemento de opción seleccionable dentro de una lista: `<option value="vocero">Vocero</option>`. |
| `563` | `                                </select>` | Menú desplegable de opciones de selección: `</select>`. |
| `564` | `                            <?php else: ?>` | Instrucción de ejecución en el contexto del script: `<?php else: ?>`. |
| `565` | `                                <!-- Ya hay 2 voceros activos -->` | Instrucción de ejecución en el contexto del script: `<!-- Ya hay 2 voceros activos -->`. |
| `566` | `                                <select class="form-select form-select-sm" ...` | Menú desplegable de opciones de selección: `<select class="form-select form-select-sm" disabled`. |
| `567` | `                                        style="color:#9ca3af;" title="Ya ha...` | Instrucción de ejecución en el contexto del script: `style="color:#9ca3af;" title="Ya hay 2 voceros activos en esta ficha">`. |
| `568` | `                                    <option>Aprendiz</option>` | Elemento de opción seleccionable dentro de una lista: `<option>Aprendiz</option>`. |
| `569` | `                                </select>` | Menú desplegable de opciones de selección: `</select>`. |
| `570` | `                            <?php endif; ?>` | Instrucción de ejecución en el contexto del script: `<?php endif; ?>`. |
| `571` | `                        </form>` | Cierre de formulario HTML. |
| `572` | `                    </td>` | Celda de tabla con contenido de datos o encabezado de columna: `</td>`. |
| `573` | `                    <td class="text-center">` | Celda de tabla con contenido de datos o encabezado de columna: `<td class="text-center">`. |
| `574` | `                        <?php if ($tieneVoceroActivo): ?>` | Instrucción de ejecución en el contexto del script: `<?php if ($tieneVoceroActivo): ?>`. |
| `575` | `                            <?php if ((int)($ap['primer_acceso'] ?? 1) === ...` | Instrucción de ejecución en el contexto del script: `<?php if ((int)($ap['primer_acceso'] ?? 1) === 0): ?>`. |
| `576` | `                                <span class="badge bg-success">` | Instrucción de ejecución en el contexto del script: `<span class="badge bg-success">`. |
| `577` | `                                    <i class="fas fa-check me-1"></i>Activo` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-check me-1"></i>Activo`. |
| `578` | `                                </span>` | Instrucción de ejecución en el contexto del script: `</span>`. |
| `579` | `                            <?php else: ?>` | Instrucción de ejecución en el contexto del script: `<?php else: ?>`. |
| `580` | `                                <span class="badge bg-warning text-dark" st...` | Instrucción de ejecución en el contexto del script: `<span class="badge bg-warning text-dark" style="font-size:.7rem;">`. |
| `581` | `                                    <i class="fas fa-clock me-1"></i>1er ac...` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-clock me-1"></i>1er acceso`. |
| `582` | `                                </span>` | Instrucción de ejecución en el contexto del script: `</span>`. |
| `583` | `                            <?php endif; ?>` | Instrucción de ejecución en el contexto del script: `<?php endif; ?>`. |
| `584` | `                        <?php elseif ($tieneVoceroInactivo): ?>` | Instrucción de ejecución en el contexto del script: `<?php elseif ($tieneVoceroInactivo): ?>`. |
| `585` | `                            <span class="badge bg-secondary" style="font-si...` | Instrucción de ejecución en el contexto del script: `<span class="badge bg-secondary" style="font-size:.7rem;">`. |
| `586` | `                                <i class="fas fa-ban me-1"></i>Inactivo` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-ban me-1"></i>Inactivo`. |
| `587` | `                            </span>` | Instrucción de ejecución en el contexto del script: `</span>`. |
| `588` | `                        <?php else: ?>` | Instrucción de ejecución en el contexto del script: `<?php else: ?>`. |
| `589` | `                            <span class="text-muted" style="font-size:.75re...` | Instrucción de ejecución en el contexto del script: `<span class="text-muted" style="font-size:.75rem;">—</span>`. |
| `590` | `                        <?php endif; ?>` | Instrucción de ejecución en el contexto del script: `<?php endif; ?>`. |
| `591` | `                    </td>` | Celda de tabla con contenido de datos o encabezado de columna: `</td>`. |
| `592` | `                </tr>` | Fila contenedora de datos dentro de la tabla. |
| `593` | `                <?php endforeach; ?>` | Instrucción de ejecución en el contexto del script: `<?php endforeach; ?>`. |
| `594` | `                </tbody>` | Instrucción de ejecución en el contexto del script: `</tbody>`. |
| `595` | `            </table>` | Tabla de datos para despliegue estructurado de información: `</table>`. |
| `596` | `        </div>` | Cierre de contenedor visual `<div>`. |
| `597` | `        <?php endif; ?>` | Instrucción de ejecución en el contexto del script: `<?php endif; ?>`. |
| `598` | `    </div>` | Cierre de contenedor visual `<div>`. |
| `599` | `</div>` | Cierre de contenedor visual `<div>`. |
| `600` | `<?php endif; ?>` | Instrucción de ejecución en el contexto del script: `<?php endif; ?>`. |
| `601` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `602` | `<!-- ══ ESTILOS + JS ══════════════════════════════════════════════════════...` | Instrucción de ejecución en el contexto del script: `<!-- ══ ESTILOS + JS ═══════════════════════════════════════════════════════════ -->`. |
| `603` | `<style>` | Instrucción de ejecución en el contexto del script: `<style>`. |
| `604` | `.prog-card { transition: transform .2s, box-shadow .2s; cursor: pointer; }` | Instrucción de ejecución en el contexto del script: `.prog-card { transition: transform .2s, box-shadow .2s; cursor: pointer; }`. |
| `605` | `.prog-card:hover { transform: translateY(-3px); box-shadow: 0 8px 24px rgba...` | Instrucción de ejecución en el contexto del script: `.prog-card:hover { transform: translateY(-3px); box-shadow: 0 8px 24px rgba(0,0,0,.1) !important; }`. |
| `606` | `.breadcrumb-item + .breadcrumb-item::before { color: #9ca3af; }` | Instrucción de ejecución en el contexto del script: `.breadcrumb-item + .breadcrumb-item::before { color: #9ca3af; }`. |
| `607` | `</style>` | Instrucción de ejecución en el contexto del script: `</style>`. |
| `608` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `609` | `<script>` | Bloque o etiqueta de vinculación para scripts JavaScript del lado del cliente. |
| `610` | `const bP = document.getElementById('buscPrograma');` | Instrucción de ejecución en el contexto del script: `const bP = document.getElementById('buscPrograma');`. |
| `611` | `if (bP) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (bP) {`. |
| `612` | `    bP.addEventListener('input', function () {` | Declaración de método o función con su firma y parámetros: `bP.addEventListener('input', function () {`. |
| `613` | `        const q = this.value.toLowerCase();` | Instrucción de ejecución en el contexto del script: `const q = this.value.toLowerCase();`. |
| `614` | `        document.querySelectorAll('.prog-item').forEach(el => {` | Instrucción de ejecución en el contexto del script: `document.querySelectorAll('.prog-item').forEach(el => {`. |
| `615` | `            el.style.display = !q \|\| el.textContent.toLowerCase().include...` | Instrucción de ejecución en el contexto del script: `el.style.display = !q \|\| el.textContent.toLowerCase().includes(q) ? '' : 'none';`. |
| `616` | `        });` | Instrucción de ejecución en el contexto del script: `});`. |
| `617` | `    });` | Instrucción de ejecución en el contexto del script: `});`. |
| `618` | `}` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `619` | `<?php if ($alert): ?>` | Instrucción de ejecución en el contexto del script: `<?php if ($alert): ?>`. |
| `620` | `document.addEventListener('DOMContentLoaded', function () {` | Declaración de método o función con su firma y parámetros: `document.addEventListener('DOMContentLoaded', function () {`. |
| `621` | `    Swal.fire({ icon:'<?= addslashes($alert['icon']) ?>', title:'<?= addsla...` | Instrucción de ejecución en el contexto del script: `Swal.fire({ icon:'<?= addslashes($alert['icon']) ?>', title:'<?= addslashes($alert['title']) ?>', text:'<?= addslashes($alert['text']) ?>', confirmButtonColor:'#39a900' });`. |
| `622` | `});` | Instrucción de ejecución en el contexto del script: `});`. |
| `623` | `<?php endif; ?>` | Instrucción de ejecución en el contexto del script: `<?php endif; ?>`. |
| `624` | `</script>` | Bloque o etiqueta de vinculación para scripts JavaScript del lado del cliente. |
| `625` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `626` | `<?php require_once __DIR__ . '/../layouts/footer.php'; ?>` | Instrucción de ejecución en el contexto del script: `<?php require_once __DIR__ . '/../layouts/footer.php'; ?>`. |

---

## 3. Resumen y Flujo de Interacción

El archivo `admin_aprendices.php` cumple un rol indispensable en `views/dashboard/admin_aprendices.php`. 
Interfaz del administrador para consultar, buscar y gestionar la información de aprendices vinculados a las fichas. Garantiza la robustez, el orden y la estabilidad de la arquitectura del proyecto `systemLimpieza`.
