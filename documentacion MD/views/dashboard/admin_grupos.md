# Documentación Línea por Línea: `views/dashboard/admin_grupos.php`

## 1. Ficha Técnica del Archivo

- **Archivo:** `admin_grupos.php`
- **Ruta en el proyecto:** `views/dashboard/admin_grupos.php`
- **Cantidad total de líneas:** `514`
- **Tipo de archivo:** `PHP`
- **Propósito general:** Vista administrativa para supervisar la conformación de grupos de limpieza y aprendices asignados.

---

## 2. Explicación Detallada Línea por Línea

A continuación se presenta cada línea de código numerada de forma consecutiva, acompañada de su fragmento exacto y la explicación exhaustiva de su funcionamiento y responsabilidad en el sistema:

| Línea | Código Fuente | Explicación Detallada |
|---|---|---|
| `1` | `<?php` | Apertura obligatoria de la etiqueta PHP para ejecución del código del lado del servidor. |
| `2` | `$titulo = 'Grupos de Limpieza';` | Instrucción de ejecución en el contexto del script: `$titulo = 'Grupos de Limpieza';`. |
| `3` | `if (session_status() === PHP_SESSION_NONE) session_start();` | Inicia o reanuda la sesión PHP del usuario si no se encontraba activa previamente. |
| `4` | `if (!isset($_SESSION['usuario']) \|\| (int)$_SESSION['usuario']['rol'] !== ...` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (!isset($_SESSION['usuario']) \|\| (int)$_SESSION['usuario']['rol'] !== 1) {`. |
| `5` | `    header("Location: ../usuarios/login.php"); exit;` | Emite cabecera HTTP de redirección en el navegador: `header("Location: ../usuarios/login.php"); exit;`. |
| `6` | `}` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `7` | `require_once __DIR__ . '/../../config/database.php';` | Importación e inclusión obligatoria del archivo de dependencia requerido: `require_once __DIR__ . '/../../config/database.php';`. |
| `8` | `require_once __DIR__ . '/../../models/Grupo.php';` | Importación e inclusión obligatoria del archivo de dependencia requerido: `require_once __DIR__ . '/../../models/Grupo.php';`. |
| `9` | `require_once __DIR__ . '/../../models/Programa.php';` | Importación e inclusión obligatoria del archivo de dependencia requerido: `require_once __DIR__ . '/../../models/Programa.php';`. |
| `10` | `require_once __DIR__ . '/../../models/Ficha.php';` | Importación e inclusión obligatoria del archivo de dependencia requerido: `require_once __DIR__ . '/../../models/Ficha.php';`. |
| `11` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `12` | `$db        = (new Database())->conectar();` | Instrucción de ejecución en el contexto del script: `$db        = (new Database())->conectar();`. |
| `13` | `$alert     = $_SESSION['alert'] ?? null;` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección: `$alert     = $_SESSION['alert'] ?? null;`. |
| `14` | `unset($_SESSION['alert']);` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección: `unset($_SESSION['alert']);`. |
| `15` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `16` | `$modelProg = new Programa($db);` | Instrucción de ejecución en el contexto del script: `$modelProg = new Programa($db);`. |
| `17` | `$modelFich = new Ficha($db);` | Instrucción de ejecución en el contexto del script: `$modelFich = new Ficha($db);`. |
| `18` | `$modelGrup = new Grupo($db);` | Instrucción de ejecución en el contexto del script: `$modelGrup = new Grupo($db);`. |
| `19` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `20` | `$vistaPrograma = (int)($_GET['programa'] ?? 0);` | Captura y sanitiza parámetros enviados por el cliente mediante petición HTTP: `$vistaPrograma = (int)($_GET['programa'] ?? 0);`. |
| `21` | `$vistaFicha    = (int)($_GET['ficha']    ?? 0);` | Captura y sanitiza parámetros enviados por el cliente mediante petición HTTP: `$vistaFicha    = (int)($_GET['ficha']    ?? 0);`. |
| `22` | `$busqueda      = trim($_GET['q']         ?? '');` | Captura y sanitiza parámetros enviados por el cliente mediante petición HTTP: `$busqueda      = trim($_GET['q']         ?? '');`. |
| `23` | `$filtroEstado  = trim($_GET['estado']    ?? '');` | Captura y sanitiza parámetros enviados por el cliente mediante petición HTTP: `$filtroEstado  = trim($_GET['estado']    ?? '');`. |
| `24` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `25` | `// Nivel 0: todos los programas` | Comentario de línea explicativo: `Nivel 0: todos los programas`. |
| `26` | `$programas = $modelProg->obtenerTodos();` | Instrucción de ejecución en el contexto del script: `$programas = $modelProg->obtenerTodos();`. |
| `27` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `28` | `// Nivel 1: fichas del programa` | Comentario de línea explicativo: `Nivel 1: fichas del programa`. |
| `29` | `$programaAct   = null;` | Instrucción de ejecución en el contexto del script: `$programaAct   = null;`. |
| `30` | `$fichasDelProg = [];` | Instrucción de ejecución en el contexto del script: `$fichasDelProg = [];`. |
| `31` | `if ($vistaPrograma) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if ($vistaPrograma) {`. |
| `32` | `    $programaAct = $modelProg->obtenerPorId($vistaPrograma);` | Instrucción de ejecución en el contexto del script: `$programaAct = $modelProg->obtenerPorId($vistaPrograma);`. |
| `33` | `    $stmtF = $db->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmtF = $db->prepare(`. |
| `34` | `        "SELECT f.*,` | Instrucción de ejecución en el contexto del script: `"SELECT f.*,`. |
| `35` | `                ANY_VALUE(v.nombres)   AS vocero_nombres,` | Instrucción de ejecución en el contexto del script: `ANY_VALUE(v.nombres)   AS vocero_nombres,`. |
| `36` | `                ANY_VALUE(v.apellidos) AS vocero_apellidos,` | Instrucción de ejecución en el contexto del script: `ANY_VALUE(v.apellidos) AS vocero_apellidos,`. |
| `37` | `                COUNT(DISTINCT g.id_grupo) AS total_grupos,` | Instrucción de ejecución en el contexto del script: `COUNT(DISTINCT g.id_grupo) AS total_grupos,`. |
| `38` | `                COUNT(DISTINCT ap.id_aprendiz) AS total_aprendices` | Instrucción de ejecución en el contexto del script: `COUNT(DISTINCT ap.id_aprendiz) AS total_aprendices`. |
| `39` | `         FROM fichas f` | Instrucción de ejecución en el contexto del script: `FROM fichas f`. |
| `40` | `         LEFT JOIN voceros    v  ON v.id_ficha  = f.id_ficha AND v.activo = 1` | Instrucción de ejecución en el contexto del script: `LEFT JOIN voceros    v  ON v.id_ficha  = f.id_ficha AND v.activo = 1`. |
| `41` | `         LEFT JOIN grupos     g  ON g.id_vocero = v.id_vocero` | Instrucción de ejecución en el contexto del script: `LEFT JOIN grupos     g  ON g.id_vocero = v.id_vocero`. |
| `42` | `         LEFT JOIN aprendices ap ON ap.id_ficha = f.id_ficha AND ap.activo = 1` | Instrucción de ejecución en el contexto del script: `LEFT JOIN aprendices ap ON ap.id_ficha = f.id_ficha AND ap.activo = 1`. |
| `43` | `         WHERE f.id_programa = :prog AND f.activo = 1` | Instrucción de ejecución en el contexto del script: `WHERE f.id_programa = :prog AND f.activo = 1`. |
| `44` | `         GROUP BY f.id_ficha` | Instrucción de ejecución en el contexto del script: `GROUP BY f.id_ficha`. |
| `45` | `         ORDER BY f.numero_ficha"` | Instrucción de ejecución en el contexto del script: `ORDER BY f.numero_ficha"`. |
| `46` | `    );` | Instrucción de ejecución en el contexto del script: `);`. |
| `47` | `    $stmtF->execute([':prog' => $vistaPrograma]);` | Ejecuta la sentencia SQL preparada vinculando los datos correspondientes: `$stmtF->execute([':prog' => $vistaPrograma]);`. |
| `48` | `    $fichasDelProg = $stmtF->fetchAll(PDO::FETCH_ASSOC);` | Obtiene todos los registros coincidentes de la consulta en un arreglo asociativo. |
| `49` | `}` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `50` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `51` | `// Nivel 2: grupos de la ficha` | Comentario de línea explicativo: `Nivel 2: grupos de la ficha`. |
| `52` | `$fichaAct = null;` | Instrucción de ejecución en el contexto del script: `$fichaAct = null;`. |
| `53` | `$grupos   = [];` | Instrucción de ejecución en el contexto del script: `$grupos   = [];`. |
| `54` | `if ($vistaFicha) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if ($vistaFicha) {`. |
| `55` | `    $fichaAct = $modelFich->obtenerPorId($vistaFicha);` | Instrucción de ejecución en el contexto del script: `$fichaAct = $modelFich->obtenerPorId($vistaFicha);`. |
| `56` | `    if ($fichaAct) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if ($fichaAct) {`. |
| `57` | `        $vistaPrograma = (int)$fichaAct['id_programa'];` | Instrucción de ejecución en el contexto del script: `$vistaPrograma = (int)$fichaAct['id_programa'];`. |
| `58` | `        $programaAct   = $modelProg->obtenerPorId($vistaPrograma);` | Instrucción de ejecución en el contexto del script: `$programaAct   = $modelProg->obtenerPorId($vistaPrograma);`. |
| `59` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `60` | `        $stmtF2 = $db->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmtF2 = $db->prepare(`. |
| `61` | `            "SELECT f.*,` | Instrucción de ejecución en el contexto del script: `"SELECT f.*,`. |
| `62` | `                    ANY_VALUE(v.nombres) AS vocero_nombres,` | Instrucción de ejecución en el contexto del script: `ANY_VALUE(v.nombres) AS vocero_nombres,`. |
| `63` | `                    COUNT(DISTINCT g.id_grupo) AS total_grupos` | Instrucción de ejecución en el contexto del script: `COUNT(DISTINCT g.id_grupo) AS total_grupos`. |
| `64` | `             FROM fichas f` | Instrucción de ejecución en el contexto del script: `FROM fichas f`. |
| `65` | `             LEFT JOIN voceros v ON v.id_ficha = f.id_ficha AND v.activo = 1` | Instrucción de ejecución en el contexto del script: `LEFT JOIN voceros v ON v.id_ficha = f.id_ficha AND v.activo = 1`. |
| `66` | `             LEFT JOIN grupos  g ON g.id_vocero = v.id_vocero` | Instrucción de ejecución en el contexto del script: `LEFT JOIN grupos  g ON g.id_vocero = v.id_vocero`. |
| `67` | `             WHERE f.id_programa = :prog AND f.activo = 1` | Instrucción de ejecución en el contexto del script: `WHERE f.id_programa = :prog AND f.activo = 1`. |
| `68` | `             GROUP BY f.id_ficha ORDER BY f.numero_ficha"` | Instrucción de ejecución en el contexto del script: `GROUP BY f.id_ficha ORDER BY f.numero_ficha"`. |
| `69` | `        );` | Instrucción de ejecución en el contexto del script: `);`. |
| `70` | `        $stmtF2->execute([':prog' => $vistaPrograma]);` | Ejecuta la sentencia SQL preparada vinculando los datos correspondientes: `$stmtF2->execute([':prog' => $vistaPrograma]);`. |
| `71` | `        $fichasDelProg = $stmtF2->fetchAll(PDO::FETCH_ASSOC);` | Obtiene todos los registros coincidentes de la consulta en un arreglo asociativo. |
| `72` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `73` | `        // Grupos con filtros` | Comentario de línea explicativo: `Grupos con filtros`. |
| `74` | `        $where  = ['a.id_ficha = :fic'];` | Instrucción de ejecución en el contexto del script: `$where  = ['a.id_ficha = :fic'];`. |
| `75` | `        $params = [':fic' => $vistaFicha];` | Instrucción de ejecución en el contexto del script: `$params = [':fic' => $vistaFicha];`. |
| `76` | `        if ($filtroEstado) { $where[] = 'g.estado = :est'; $params[':est'] ...` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if ($filtroEstado) { $where[] = 'g.estado = :est'; $params[':est'] = $filtroEstado; }`. |
| `77` | `        if ($busqueda) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if ($busqueda) {`. |
| `78` | `            $like = '%' . $busqueda . '%';` | Instrucción de ejecución en el contexto del script: `$like = '%' . $busqueda . '%';`. |
| `79` | `            $where[] = '(g.nombre_grupo LIKE :q OR v.nombres LIKE :q2 OR v....` | Instrucción de ejecución en el contexto del script: `$where[] = '(g.nombre_grupo LIKE :q OR v.nombres LIKE :q2 OR v.apellidos LIKE :q3 OR m.nombre LIKE :q4)';`. |
| `80` | `            $params[':q'] = $like; $params[':q2'] = $like;` | Instrucción de ejecución en el contexto del script: `$params[':q'] = $like; $params[':q2'] = $like;`. |
| `81` | `            $params[':q3'] = $like; $params[':q4'] = $like;` | Instrucción de ejecución en el contexto del script: `$params[':q3'] = $like; $params[':q4'] = $like;`. |
| `82` | `        }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `83` | `        $whereStr = implode(' AND ', $where);` | Instrucción de ejecución en el contexto del script: `$whereStr = implode(' AND ', $where);`. |
| `84` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `85` | `        $stmtG = $db->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmtG = $db->prepare(`. |
| `86` | `            "SELECT g.*,` | Instrucción de ejecución en el contexto del script: `"SELECT g.*,`. |
| `87` | `                    m.nombre  AS nombre_modulo,` | Instrucción de ejecución en el contexto del script: `m.nombre  AS nombre_modulo,`. |
| `88` | `                    f.numero_ficha,` | Instrucción de ejecución en el contexto del script: `f.numero_ficha,`. |
| `89` | `                    v.nombres AS vocero_nombres, v.apellidos AS vocero_apel...` | Instrucción de ejecución en el contexto del script: `v.nombres AS vocero_nombres, v.apellidos AS vocero_apellidos,`. |
| `90` | `                    (SELECT COUNT(*) FROM evidencias e WHERE e.id_grupo = g...` | Instrucción de ejecución en el contexto del script: `(SELECT COUNT(*) FROM evidencias e WHERE e.id_grupo = g.id_grupo) AS tiene_evidencia,`. |
| `91` | `                    (SELECT COUNT(*) FROM grupo_integrantes gi WHERE gi.id_...` | Instrucción de ejecución en el contexto del script: `(SELECT COUNT(*) FROM grupo_integrantes gi WHERE gi.id_grupo = g.id_grupo) AS total_integrantes`. |
| `92` | `             FROM grupos g` | Instrucción de ejecución en el contexto del script: `FROM grupos g`. |
| `93` | `             JOIN asignaciones a ON a.id_asignacion = g.id_asignacion` | Instrucción de ejecución en el contexto del script: `JOIN asignaciones a ON a.id_asignacion = g.id_asignacion`. |
| `94` | `             JOIN modulos      m ON m.id_modulo     = a.id_modulo` | Instrucción de ejecución en el contexto del script: `JOIN modulos      m ON m.id_modulo     = a.id_modulo`. |
| `95` | `             JOIN fichas       f ON f.id_ficha      = a.id_ficha` | Instrucción de ejecución en el contexto del script: `JOIN fichas       f ON f.id_ficha      = a.id_ficha`. |
| `96` | `             JOIN voceros      v ON v.id_vocero     = g.id_vocero` | Instrucción de ejecución en el contexto del script: `JOIN voceros      v ON v.id_vocero     = g.id_vocero`. |
| `97` | `             WHERE {$whereStr}` | Instrucción de ejecución en el contexto del script: `WHERE {$whereStr}`. |
| `98` | `             ORDER BY g.fecha_limpieza DESC"` | Instrucción de ejecución en el contexto del script: `ORDER BY g.fecha_limpieza DESC"`. |
| `99` | `        );` | Instrucción de ejecución en el contexto del script: `);`. |
| `100` | `        $stmtG->execute($params);` | Ejecuta la sentencia SQL preparada vinculando los datos correspondientes: `$stmtG->execute($params);`. |
| `101` | `        $grupos = $stmtG->fetchAll(PDO::FETCH_ASSOC);` | Obtiene todos los registros coincidentes de la consulta en un arreglo asociativo. |
| `102` | `    }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `103` | `}` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `104` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `105` | `// Detalle integrantes si se pide` | Comentario de línea explicativo: `Detalle integrantes si se pide`. |
| `106` | `$grupoDetalle   = null;` | Instrucción de ejecución en el contexto del script: `$grupoDetalle   = null;`. |
| `107` | `$integrantesDet = [];` | Instrucción de ejecución en el contexto del script: `$integrantesDet = [];`. |
| `108` | `if (!empty($_GET['grupo'])) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (!empty($_GET['grupo'])) {`. |
| `109` | `    $grupoDetalle   = $modelGrup->obtenerPorId((int)$_GET['grupo']);` | Captura y sanitiza parámetros enviados por el cliente mediante petición HTTP: `$grupoDetalle   = $modelGrup->obtenerPorId((int)$_GET['grupo']);`. |
| `110` | `    $integrantesDet = $modelGrup->obtenerIntegrantes((int)$_GET['grupo']);` | Captura y sanitiza parámetros enviados por el cliente mediante petición HTTP: `$integrantesDet = $modelGrup->obtenerIntegrantes((int)$_GET['grupo']);`. |
| `111` | `}` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `112` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `113` | `require_once __DIR__ . '/../layouts/header.php';` | Importación e inclusión obligatoria del archivo de dependencia requerido: `require_once __DIR__ . '/../layouts/header.php';`. |
| `114` | `?>` | Cierre de la etiqueta PHP para alternar a salida HTML o fin del archivo. |
| `115` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `116` | `<!-- ══ BREADCRUMB + CABECERA ═════════════════════════════════════════════...` | Instrucción de ejecución en el contexto del script: `<!-- ══ BREADCRUMB + CABECERA ════════════════════════════════════════════════ -->`. |
| `117` | `<div class="d-flex justify-content-between align-items-start mb-4 flex-wrap...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="d-flex justify-content-between align-items-start mb-4 flex-wrap gap-3">`. |
| `118` | `    <div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div>`. |
| `119` | `        <nav aria-label="breadcrumb" class="mb-1">` | Barra o elemento de navegación del sistema. |
| `120` | `            <ol class="breadcrumb mb-0" style="font-size:.82rem;">` | Instrucción de ejecución en el contexto del script: `<ol class="breadcrumb mb-0" style="font-size:.82rem;">`. |
| `121` | `                <li class="breadcrumb-item">` | Instrucción de ejecución en el contexto del script: `<li class="breadcrumb-item">`. |
| `122` | `                    <a href="admin_grupos.php" class="text-success text-dec...` | Enlace hipertexto de navegación o acción: `<a href="admin_grupos.php" class="text-success text-decoration-none fw-semibold">`. |
| `123` | `                        <i class="fas fa-people-group me-1"></i>Grupos` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-people-group me-1"></i>Grupos`. |
| `124` | `                    </a>` | Instrucción de ejecución en el contexto del script: `</a>`. |
| `125` | `                </li>` | Instrucción de ejecución en el contexto del script: `</li>`. |
| `126` | `                <?php if ($programaAct): ?>` | Instrucción de ejecución en el contexto del script: `<?php if ($programaAct): ?>`. |
| `127` | `                <li class="breadcrumb-item">` | Instrucción de ejecución en el contexto del script: `<li class="breadcrumb-item">`. |
| `128` | `                    <?php if ($fichaAct): ?>` | Instrucción de ejecución en el contexto del script: `<?php if ($fichaAct): ?>`. |
| `129` | `                        <a href="admin_grupos.php?programa=<?= $vistaProgra...` | Enlace hipertexto de navegación o acción: `<a href="admin_grupos.php?programa=<?= $vistaPrograma ?>"`. |
| `130` | `                           class="text-success text-decoration-none">` | Instrucción de ejecución en el contexto del script: `class="text-success text-decoration-none">`. |
| `131` | `                            <?= htmlspecialchars($programaAct['nombre']) ?>` | Instrucción de ejecución en el contexto del script: `<?= htmlspecialchars($programaAct['nombre']) ?>`. |
| `132` | `                        </a>` | Instrucción de ejecución en el contexto del script: `</a>`. |
| `133` | `                    <?php else: ?>` | Instrucción de ejecución en el contexto del script: `<?php else: ?>`. |
| `134` | `                        <span class="text-dark fw-semibold"><?= htmlspecial...` | Instrucción de ejecución en el contexto del script: `<span class="text-dark fw-semibold"><?= htmlspecialchars($programaAct['nombre']) ?></span>`. |
| `135` | `                    <?php endif; ?>` | Instrucción de ejecución en el contexto del script: `<?php endif; ?>`. |
| `136` | `                </li>` | Instrucción de ejecución en el contexto del script: `</li>`. |
| `137` | `                <?php endif; ?>` | Instrucción de ejecución en el contexto del script: `<?php endif; ?>`. |
| `138` | `                <?php if ($fichaAct): ?>` | Instrucción de ejecución en el contexto del script: `<?php if ($fichaAct): ?>`. |
| `139` | `                <li class="breadcrumb-item active">` | Instrucción de ejecución en el contexto del script: `<li class="breadcrumb-item active">`. |
| `140` | `                    Ficha <strong class="font-monospace"><?= htmlspecialcha...` | Instrucción de ejecución en el contexto del script: `Ficha <strong class="font-monospace"><?= htmlspecialchars($fichaAct['numero_ficha']) ?></strong>`. |
| `141` | `                </li>` | Instrucción de ejecución en el contexto del script: `</li>`. |
| `142` | `                <?php endif; ?>` | Instrucción de ejecución en el contexto del script: `<?php endif; ?>`. |
| `143` | `            </ol>` | Instrucción de ejecución en el contexto del script: `</ol>`. |
| `144` | `        </nav>` | Barra o elemento de navegación del sistema. |
| `145` | `        <h4 class="fw-bold mb-0">` | Instrucción de ejecución en el contexto del script: `<h4 class="fw-bold mb-0">`. |
| `146` | `            <?php if ($fichaAct): ?>` | Instrucción de ejecución en el contexto del script: `<?php if ($fichaAct): ?>`. |
| `147` | `                <i class="fas fa-people-group text-success me-2"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-people-group text-success me-2"></i>`. |
| `148` | `                Grupos — Ficha <span class="font-monospace"><?= htmlspecial...` | Instrucción de ejecución en el contexto del script: `Grupos — Ficha <span class="font-monospace"><?= htmlspecialchars($fichaAct['numero_ficha']) ?></span>`. |
| `149` | `            <?php elseif ($programaAct): ?>` | Instrucción de ejecución en el contexto del script: `<?php elseif ($programaAct): ?>`. |
| `150` | `                <i class="fas fa-id-card text-success me-2"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-id-card text-success me-2"></i>`. |
| `151` | `                Fichas — <?= htmlspecialchars($programaAct['nombre']) ?>` | Instrucción de ejecución en el contexto del script: `Fichas — <?= htmlspecialchars($programaAct['nombre']) ?>`. |
| `152` | `            <?php else: ?>` | Instrucción de ejecución en el contexto del script: `<?php else: ?>`. |
| `153` | `                <i class="fas fa-people-group text-success me-2"></i>Grupos...` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-people-group text-success me-2"></i>Grupos de Limpieza`. |
| `154` | `            <?php endif; ?>` | Instrucción de ejecución en el contexto del script: `<?php endif; ?>`. |
| `155` | `        </h4>` | Instrucción de ejecución en el contexto del script: `</h4>`. |
| `156` | `        <p class="text-muted small mb-0">` | Instrucción de ejecución en el contexto del script: `<p class="text-muted small mb-0">`. |
| `157` | `            <?php if ($fichaAct): ?>` | Instrucción de ejecución en el contexto del script: `<?php if ($fichaAct): ?>`. |
| `158` | `                <?= count($grupos) ?> grupo(s) registrados en esta ficha` | Instrucción de ejecución en el contexto del script: `<?= count($grupos) ?> grupo(s) registrados en esta ficha`. |
| `159` | `            <?php elseif ($programaAct): ?>` | Instrucción de ejecución en el contexto del script: `<?php elseif ($programaAct): ?>`. |
| `160` | `                Selecciona una ficha para ver sus grupos` | Instrucción de ejecución en el contexto del script: `Selecciona una ficha para ver sus grupos`. |
| `161` | `            <?php else: ?>` | Instrucción de ejecución en el contexto del script: `<?php else: ?>`. |
| `162` | `                Selecciona un programa de formación` | Instrucción de ejecución en el contexto del script: `Selecciona un programa de formación`. |
| `163` | `            <?php endif; ?>` | Instrucción de ejecución en el contexto del script: `<?php endif; ?>`. |
| `164` | `        </p>` | Instrucción de ejecución en el contexto del script: `</p>`. |
| `165` | `    </div>` | Cierre de contenedor visual `<div>`. |
| `166` | `</div>` | Cierre de contenedor visual `<div>`. |
| `167` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `168` | `<!-- ══ NIVEL 0: GRID DE PROGRAMAS ════════════════════════════════════════...` | Instrucción de ejecución en el contexto del script: `<!-- ══ NIVEL 0: GRID DE PROGRAMAS ════════════════════════════════════════════ -->`. |
| `169` | `<?php if (!$vistaPrograma && !$vistaFicha): ?>` | Instrucción de ejecución en el contexto del script: `<?php if (!$vistaPrograma && !$vistaFicha): ?>`. |
| `170` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `171` | `<?php` | Apertura obligatoria de la etiqueta PHP para ejecución del código del lado del servidor. |
| `172` | `$stmtTotG = $db->query("SELECT COUNT(*) FROM grupos");` | Instrucción de ejecución en el contexto del script: `$stmtTotG = $db->query("SELECT COUNT(*) FROM grupos");`. |
| `173` | `$totalGrupos = (int)$stmtTotG->fetchColumn();` | Obtiene el valor de una columna única de la primera fila resultante. |
| `174` | `$stmtTotEv = $db->query("SELECT COUNT(*) FROM evidencias");` | Instrucción de ejecución en el contexto del script: `$stmtTotEv = $db->query("SELECT COUNT(*) FROM evidencias");`. |
| `175` | `$totalEv = (int)$stmtTotEv->fetchColumn();` | Obtiene el valor de una columna única de la primera fila resultante. |
| `176` | `?>` | Cierre de la etiqueta PHP para alternar a salida HTML o fin del archivo. |
| `177` | `<div class="row g-3 mb-4">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="row g-3 mb-4">`. |
| `178` | `    <div class="col-sm-4">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="col-sm-4">`. |
| `179` | `        <div class="stat-card bg-white">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="stat-card bg-white">`. |
| `180` | `            <div class="d-flex align-items-center gap-3">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="d-flex align-items-center gap-3">`. |
| `181` | `                <div class="stat-icon" style="background:rgba(57,169,0,.12)...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="stat-icon" style="background:rgba(57,169,0,.12);color:#39a900;">`. |
| `182` | `                    <i class="fas fa-graduation-cap"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-graduation-cap"></i>`. |
| `183` | `                </div>` | Cierre de contenedor visual `<div>`. |
| `184` | `                <div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div>`. |
| `185` | `                    <div class="fs-4 fw-bold"><?= count($programas) ?></div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="fs-4 fw-bold"><?= count($programas) ?></div>`. |
| `186` | `                    <div class="text-muted small">Programas</div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="text-muted small">Programas</div>`. |
| `187` | `                </div>` | Cierre de contenedor visual `<div>`. |
| `188` | `            </div>` | Cierre de contenedor visual `<div>`. |
| `189` | `        </div>` | Cierre de contenedor visual `<div>`. |
| `190` | `    </div>` | Cierre de contenedor visual `<div>`. |
| `191` | `    <div class="col-sm-4">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="col-sm-4">`. |
| `192` | `        <div class="stat-card bg-white">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="stat-card bg-white">`. |
| `193` | `            <div class="d-flex align-items-center gap-3">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="d-flex align-items-center gap-3">`. |
| `194` | `                <div class="stat-icon" style="background:rgba(37,99,235,.1)...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="stat-icon" style="background:rgba(37,99,235,.1);color:#2563eb;">`. |
| `195` | `                    <i class="fas fa-people-group"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-people-group"></i>`. |
| `196` | `                </div>` | Cierre de contenedor visual `<div>`. |
| `197` | `                <div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div>`. |
| `198` | `                    <div class="fs-4 fw-bold"><?= $totalGrupos ?></div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="fs-4 fw-bold"><?= $totalGrupos ?></div>`. |
| `199` | `                    <div class="text-muted small">Grupos registrados</div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="text-muted small">Grupos registrados</div>`. |
| `200` | `                </div>` | Cierre de contenedor visual `<div>`. |
| `201` | `            </div>` | Cierre de contenedor visual `<div>`. |
| `202` | `        </div>` | Cierre de contenedor visual `<div>`. |
| `203` | `    </div>` | Cierre de contenedor visual `<div>`. |
| `204` | `    <div class="col-sm-4">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="col-sm-4">`. |
| `205` | `        <div class="stat-card bg-white">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="stat-card bg-white">`. |
| `206` | `            <div class="d-flex align-items-center gap-3">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="d-flex align-items-center gap-3">`. |
| `207` | `                <div class="stat-icon" style="background:rgba(234,179,8,.1)...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="stat-icon" style="background:rgba(234,179,8,.1);color:#d97706;">`. |
| `208` | `                    <i class="fas fa-images"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-images"></i>`. |
| `209` | `                </div>` | Cierre de contenedor visual `<div>`. |
| `210` | `                <div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div>`. |
| `211` | `                    <div class="fs-4 fw-bold"><?= $totalEv ?></div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="fs-4 fw-bold"><?= $totalEv ?></div>`. |
| `212` | `                    <div class="text-muted small">Evidencias registradas</div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="text-muted small">Evidencias registradas</div>`. |
| `213` | `                </div>` | Cierre de contenedor visual `<div>`. |
| `214` | `            </div>` | Cierre de contenedor visual `<div>`. |
| `215` | `        </div>` | Cierre de contenedor visual `<div>`. |
| `216` | `    </div>` | Cierre de contenedor visual `<div>`. |
| `217` | `</div>` | Cierre de contenedor visual `<div>`. |
| `218` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `219` | `<div class="mb-3">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="mb-3">`. |
| `220` | `    <div class="input-group input-group-sm" style="max-width:320px;">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="input-group input-group-sm" style="max-width:320px;">`. |
| `221` | `        <span class="input-group-text bg-white"><i class="fas fa-search tex...` | Instrucción de ejecución en el contexto del script: `<span class="input-group-text bg-white"><i class="fas fa-search text-muted"></i></span>`. |
| `222` | `        <input type="text" id="buscPrograma" class="form-control border-sta...` | Campo de entrada interactivo para datos del usuario: `<input type="text" id="buscPrograma" class="form-control border-start-0" placeholder="Buscar programa…">`. |
| `223` | `    </div>` | Cierre de contenedor visual `<div>`. |
| `224` | `</div>` | Cierre de contenedor visual `<div>`. |
| `225` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `226` | `<div class="row g-3" id="gridProgramas">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="row g-3" id="gridProgramas">`. |
| `227` | `    <?php foreach ($programas as $p):` | Instrucción de ejecución en el contexto del script: `<?php foreach ($programas as $p):`. |
| `228` | `        $stmtGC = $db->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmtGC = $db->prepare(`. |
| `229` | `            "SELECT COUNT(DISTINCT g.id_grupo)` | Instrucción de ejecución en el contexto del script: `"SELECT COUNT(DISTINCT g.id_grupo)`. |
| `230` | `             FROM grupos g` | Instrucción de ejecución en el contexto del script: `FROM grupos g`. |
| `231` | `             JOIN asignaciones a ON a.id_asignacion = g.id_asignacion` | Instrucción de ejecución en el contexto del script: `JOIN asignaciones a ON a.id_asignacion = g.id_asignacion`. |
| `232` | `             WHERE a.id_ficha IN (SELECT id_ficha FROM fichas WHERE id_prog...` | Instrucción de ejecución en el contexto del script: `WHERE a.id_ficha IN (SELECT id_ficha FROM fichas WHERE id_programa = :prog)"`. |
| `233` | `        );` | Instrucción de ejecución en el contexto del script: `);`. |
| `234` | `        $stmtGC->execute([':prog' => $p['id_programa']]);` | Ejecuta la sentencia SQL preparada vinculando los datos correspondientes: `$stmtGC->execute([':prog' => $p['id_programa']]);`. |
| `235` | `        $cntG = (int)$stmtGC->fetchColumn();` | Obtiene el valor de una columna única de la primera fila resultante. |
| `236` | `    ?>` | Cierre de la etiqueta PHP para alternar a salida HTML o fin del archivo. |
| `237` | `    <div class="col-md-6 col-lg-4 prog-item">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="col-md-6 col-lg-4 prog-item">`. |
| `238` | `        <a href="admin_grupos.php?programa=<?= $p['id_programa'] ?>" class=...` | Enlace hipertexto de navegación o acción: `<a href="admin_grupos.php?programa=<?= $p['id_programa'] ?>" class="text-decoration-none">`. |
| `239` | `            <div class="card border-0 shadow-sm h-100 prog-card" style="bor...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="card border-0 shadow-sm h-100 prog-card" style="border-radius:12px;">`. |
| `240` | `                <div class="card-body p-4">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="card-body p-4">`. |
| `241` | `                    <div class="d-flex align-items-start justify-content-be...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="d-flex align-items-start justify-content-between mb-3">`. |
| `242` | `                        <div style="width:44px;height:44px;border-radius:10px;` | Contenedor visual estructurado con Bootstrap/CSS: `<div style="width:44px;height:44px;border-radius:10px;`. |
| `243` | `                                    background:rgba(37,99,235,.1);color:#25...` | Instrucción de ejecución en el contexto del script: `background:rgba(37,99,235,.1);color:#2563eb;`. |
| `244` | `                                    display:flex;align-items:center;justify...` | Instrucción de ejecución en el contexto del script: `display:flex;align-items:center;justify-content:center;font-size:1.2rem;">`. |
| `245` | `                            <i class="fas fa-people-group"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-people-group"></i>`. |
| `246` | `                        </div>` | Cierre de contenedor visual `<div>`. |
| `247` | `                        <span class="badge bg-light text-dark border" style...` | Instrucción de ejecución en el contexto del script: `<span class="badge bg-light text-dark border" style="font-size:.72rem;">`. |
| `248` | `                            <?= htmlspecialchars($p['nivel'] ?? 'Sin nivel'...` | Instrucción de ejecución en el contexto del script: `<?= htmlspecialchars($p['nivel'] ?? 'Sin nivel') ?>`. |
| `249` | `                        </span>` | Instrucción de ejecución en el contexto del script: `</span>`. |
| `250` | `                    </div>` | Cierre de contenedor visual `<div>`. |
| `251` | `                    <h6 class="fw-bold mb-3 text-dark" style="font-size:.88...` | Instrucción de ejecución en el contexto del script: `<h6 class="fw-bold mb-3 text-dark" style="font-size:.88rem;line-height:1.3;">`. |
| `252` | `                        <?= htmlspecialchars($p['nombre']) ?>` | Instrucción de ejecución en el contexto del script: `<?= htmlspecialchars($p['nombre']) ?>`. |
| `253` | `                    </h6>` | Instrucción de ejecución en el contexto del script: `</h6>`. |
| `254` | `                    <div class="d-flex gap-3 pt-3" style="border-top:1px so...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="d-flex gap-3 pt-3" style="border-top:1px solid #e5e7eb;">`. |
| `255` | `                        <div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div>`. |
| `256` | `                            <div class="fw-bold text-success fs-5"><?= (int...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="fw-bold text-success fs-5"><?= (int)$p['total_fichas'] ?></div>`. |
| `257` | `                            <div class="text-muted" style="font-size:.72rem...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="text-muted" style="font-size:.72rem;">Fichas</div>`. |
| `258` | `                        </div>` | Cierre de contenedor visual `<div>`. |
| `259` | `                        <div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div>`. |
| `260` | `                            <div class="fw-bold text-primary fs-5"><?= $cnt...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="fw-bold text-primary fs-5"><?= $cntG ?></div>`. |
| `261` | `                            <div class="text-muted" style="font-size:.72rem...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="text-muted" style="font-size:.72rem;">Grupos</div>`. |
| `262` | `                        </div>` | Cierre de contenedor visual `<div>`. |
| `263` | `                        <div class="ms-auto d-flex align-items-center text-...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="ms-auto d-flex align-items-center text-success" style="font-size:.82rem;">`. |
| `264` | `                            Ver fichas <i class="fas fa-arrow-right ms-1"></i>` | Instrucción de ejecución en el contexto del script: `Ver fichas <i class="fas fa-arrow-right ms-1"></i>`. |
| `265` | `                        </div>` | Cierre de contenedor visual `<div>`. |
| `266` | `                    </div>` | Cierre de contenedor visual `<div>`. |
| `267` | `                </div>` | Cierre de contenedor visual `<div>`. |
| `268` | `            </div>` | Cierre de contenedor visual `<div>`. |
| `269` | `        </a>` | Instrucción de ejecución en el contexto del script: `</a>`. |
| `270` | `    </div>` | Cierre de contenedor visual `<div>`. |
| `271` | `    <?php endforeach; ?>` | Instrucción de ejecución en el contexto del script: `<?php endforeach; ?>`. |
| `272` | `    <?php if (empty($programas)): ?>` | Instrucción de ejecución en el contexto del script: `<?php if (empty($programas)): ?>`. |
| `273` | `    <div class="col-12 text-center py-5 text-muted">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="col-12 text-center py-5 text-muted">`. |
| `274` | `        <i class="fas fa-graduation-cap fa-3x mb-3 opacity-25 d-block"></i>...` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-graduation-cap fa-3x mb-3 opacity-25 d-block"></i>No hay programas.`. |
| `275` | `    </div>` | Cierre de contenedor visual `<div>`. |
| `276` | `    <?php endif; ?>` | Instrucción de ejecución en el contexto del script: `<?php endif; ?>`. |
| `277` | `</div>` | Cierre de contenedor visual `<div>`. |
| `278` | `<?php endif; ?>` | Instrucción de ejecución en el contexto del script: `<?php endif; ?>`. |
| `279` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `280` | `<!-- ══ NIVEL 1: FICHAS DEL PROGRAMA ══════════════════════════════════════...` | Instrucción de ejecución en el contexto del script: `<!-- ══ NIVEL 1: FICHAS DEL PROGRAMA ═════════════════════════════════════════ -->`. |
| `281` | `<?php if ($vistaPrograma && !$vistaFicha): ?>` | Instrucción de ejecución en el contexto del script: `<?php if ($vistaPrograma && !$vistaFicha): ?>`. |
| `282` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `283` | `<div class="row g-3">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="row g-3">`. |
| `284` | `    <?php foreach ($fichasDelProg as $f): ?>` | Instrucción de ejecución en el contexto del script: `<?php foreach ($fichasDelProg as $f): ?>`. |
| `285` | `    <div class="col-md-6 col-lg-4">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="col-md-6 col-lg-4">`. |
| `286` | `        <a href="admin_grupos.php?programa=<?= $vistaPrograma ?>&ficha=<?= ...` | Enlace hipertexto de navegación o acción: `<a href="admin_grupos.php?programa=<?= $vistaPrograma ?>&ficha=<?= $f['id_ficha'] ?>" class="text-decoration-none">`. |
| `287` | `            <div class="card border-0 shadow-sm h-100 prog-card" style="bor...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="card border-0 shadow-sm h-100 prog-card" style="border-radius:12px;">`. |
| `288` | `                <div class="card-body p-4">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="card-body p-4">`. |
| `289` | `                    <div class="d-flex align-items-start justify-content-be...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="d-flex align-items-start justify-content-between mb-3">`. |
| `290` | `                        <div style="width:44px;height:44px;border-radius:10px;` | Contenedor visual estructurado con Bootstrap/CSS: `<div style="width:44px;height:44px;border-radius:10px;`. |
| `291` | `                                    background:rgba(37,99,235,.1);color:#25...` | Instrucción de ejecución en el contexto del script: `background:rgba(37,99,235,.1);color:#2563eb;`. |
| `292` | `                                    display:flex;align-items:center;justify...` | Instrucción de ejecución en el contexto del script: `display:flex;align-items:center;justify-content:center;font-size:1.1rem;">`. |
| `293` | `                            <i class="fas fa-id-card"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-id-card"></i>`. |
| `294` | `                        </div>` | Cierre de contenedor visual `<div>`. |
| `295` | `                        <span class="badge bg-light text-dark border"><?= h...` | Instrucción de ejecución en el contexto del script: `<span class="badge bg-light text-dark border"><?= htmlspecialchars($f['jornada']) ?></span>`. |
| `296` | `                    </div>` | Cierre de contenedor visual `<div>`. |
| `297` | `                    <div class="fw-bold text-success font-monospace mb-1" s...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="fw-bold text-success font-monospace mb-1" style="font-size:1.3rem;">`. |
| `298` | `                        <?= htmlspecialchars($f['numero_ficha']) ?>` | Instrucción de ejecución en el contexto del script: `<?= htmlspecialchars($f['numero_ficha']) ?>`. |
| `299` | `                    </div>` | Cierre de contenedor visual `<div>`. |
| `300` | `                    <div class="text-muted small mb-3">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="text-muted small mb-3">`. |
| `301` | `                        <?php if ($f['vocero_nombres']): ?>` | Instrucción de ejecución en el contexto del script: `<?php if ($f['vocero_nombres']): ?>`. |
| `302` | `                            <i class="fas fa-user-tie text-success me-1" st...` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-user-tie text-success me-1" style="font-size:.75rem;"></i>`. |
| `303` | `                            <?= htmlspecialchars($f['vocero_nombres']) ?>` | Instrucción de ejecución en el contexto del script: `<?= htmlspecialchars($f['vocero_nombres']) ?>`. |
| `304` | `                        <?php else: ?>` | Instrucción de ejecución en el contexto del script: `<?php else: ?>`. |
| `305` | `                            <span class="text-warning"><i class="fas fa-exc...` | Instrucción de ejecución en el contexto del script: `<span class="text-warning"><i class="fas fa-exclamation-circle me-1"></i>Sin vocero</span>`. |
| `306` | `                        <?php endif; ?>` | Instrucción de ejecución en el contexto del script: `<?php endif; ?>`. |
| `307` | `                    </div>` | Cierre de contenedor visual `<div>`. |
| `308` | `                    <div class="d-flex gap-3 pt-3" style="border-top:1px so...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="d-flex gap-3 pt-3" style="border-top:1px solid #e5e7eb;">`. |
| `309` | `                        <div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div>`. |
| `310` | `                            <div class="fw-bold text-primary fs-5"><?= (int...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="fw-bold text-primary fs-5"><?= (int)$f['total_grupos'] ?></div>`. |
| `311` | `                            <div class="text-muted" style="font-size:.72rem...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="text-muted" style="font-size:.72rem;">Grupos</div>`. |
| `312` | `                        </div>` | Cierre de contenedor visual `<div>`. |
| `313` | `                        <div class="ms-auto d-flex align-items-center text-...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="ms-auto d-flex align-items-center text-success" style="font-size:.82rem;">`. |
| `314` | `                            Ver grupos <i class="fas fa-arrow-right ms-1"></i>` | Instrucción de ejecución en el contexto del script: `Ver grupos <i class="fas fa-arrow-right ms-1"></i>`. |
| `315` | `                        </div>` | Cierre de contenedor visual `<div>`. |
| `316` | `                    </div>` | Cierre de contenedor visual `<div>`. |
| `317` | `                </div>` | Cierre de contenedor visual `<div>`. |
| `318` | `            </div>` | Cierre de contenedor visual `<div>`. |
| `319` | `        </a>` | Instrucción de ejecución en el contexto del script: `</a>`. |
| `320` | `    </div>` | Cierre de contenedor visual `<div>`. |
| `321` | `    <?php endforeach; ?>` | Instrucción de ejecución en el contexto del script: `<?php endforeach; ?>`. |
| `322` | `    <?php if (empty($fichasDelProg)): ?>` | Instrucción de ejecución en el contexto del script: `<?php if (empty($fichasDelProg)): ?>`. |
| `323` | `    <div class="col-12 text-center py-5 text-muted">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="col-12 text-center py-5 text-muted">`. |
| `324` | `        <i class="fas fa-id-card fa-3x mb-3 opacity-25 d-block"></i>No hay ...` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-id-card fa-3x mb-3 opacity-25 d-block"></i>No hay fichas en este programa.`. |
| `325` | `    </div>` | Cierre de contenedor visual `<div>`. |
| `326` | `    <?php endif; ?>` | Instrucción de ejecución en el contexto del script: `<?php endif; ?>`. |
| `327` | `</div>` | Cierre de contenedor visual `<div>`. |
| `328` | `<?php endif; ?>` | Instrucción de ejecución en el contexto del script: `<?php endif; ?>`. |
| `329` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `330` | `<!-- ══ NIVEL 2: GRUPOS DE LA FICHA ═══════════════════════════════════════...` | Instrucción de ejecución en el contexto del script: `<!-- ══ NIVEL 2: GRUPOS DE LA FICHA ══════════════════════════════════════════ -->`. |
| `331` | `<?php if ($vistaFicha && $fichaAct): ?>` | Instrucción de ejecución en el contexto del script: `<?php if ($vistaFicha && $fichaAct): ?>`. |
| `332` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `333` | `<!-- Filtros -->` | Instrucción de ejecución en el contexto del script: `<!-- Filtros -->`. |
| `334` | `<form method="GET" class="card shadow-sm border-0 mb-3">` | Formulario para recolección y envío de datos del usuario: `<form method="GET" class="card shadow-sm border-0 mb-3">`. |
| `335` | `    <div class="card-body py-2 px-3">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="card-body py-2 px-3">`. |
| `336` | `        <input type="hidden" name="programa" value="<?= $vistaPrograma ?>">` | Campo de entrada interactivo para datos del usuario: `<input type="hidden" name="programa" value="<?= $vistaPrograma ?>">`. |
| `337` | `        <input type="hidden" name="ficha"    value="<?= $vistaFicha ?>">` | Campo de entrada interactivo para datos del usuario: `<input type="hidden" name="ficha"    value="<?= $vistaFicha ?>">`. |
| `338` | `        <div class="d-flex gap-2 align-items-center flex-wrap">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="d-flex gap-2 align-items-center flex-wrap">`. |
| `339` | `            <select name="estado" class="form-select form-select-sm" style=...` | Menú desplegable de opciones de selección: `<select name="estado" class="form-select form-select-sm" style="max-width:140px;" onchange="this.form.submit()">`. |
| `340` | `                <option value="">Todos los estados</option>` | Elemento de opción seleccionable dentro de una lista: `<option value="">Todos los estados</option>`. |
| `341` | `                <option value="Activo"     <?= $filtroEstado==='Activo'    ...` | Elemento de opción seleccionable dentro de una lista: `<option value="Activo"     <?= $filtroEstado==='Activo'     ?'selected':'' ?>>Activo</option>`. |
| `342` | `                <option value="Completado" <?= $filtroEstado==='Completado'...` | Elemento de opción seleccionable dentro de una lista: `<option value="Completado" <?= $filtroEstado==='Completado' ?'selected':'' ?>>Completado</option>`. |
| `343` | `                <option value="Sancionado" <?= $filtroEstado==='Sancionado'...` | Elemento de opción seleccionable dentro de una lista: `<option value="Sancionado" <?= $filtroEstado==='Sancionado' ?'selected':'' ?>>Sancionado</option>`. |
| `344` | `            </select>` | Menú desplegable de opciones de selección: `</select>`. |
| `345` | `            <div class="input-group input-group-sm" style="max-width:240px;">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="input-group input-group-sm" style="max-width:240px;">`. |
| `346` | `                <span class="input-group-text bg-white"><i class="fas fa-se...` | Instrucción de ejecución en el contexto del script: `<span class="input-group-text bg-white"><i class="fas fa-search text-muted"></i></span>`. |
| `347` | `                <input type="text" name="q" class="form-control border-star...` | Campo de entrada interactivo para datos del usuario: `<input type="text" name="q" class="form-control border-start-0"`. |
| `348` | `                       placeholder="Buscar grupo, vocero…" value="<?= htmls...` | Instrucción de ejecución en el contexto del script: `placeholder="Buscar grupo, vocero…" value="<?= htmlspecialchars($busqueda) ?>">`. |
| `349` | `            </div>` | Cierre de contenedor visual `<div>`. |
| `350` | `            <button type="submit" class="btn btn-success btn-sm">` | Botón de acción interactivo para el usuario: `<button type="submit" class="btn btn-success btn-sm">`. |
| `351` | `                <i class="fas fa-filter me-1"></i>Filtrar` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-filter me-1"></i>Filtrar`. |
| `352` | `            </button>` | Botón de acción interactivo para el usuario: `</button>`. |
| `353` | `            <?php if ($filtroEstado \|\| $busqueda): ?>` | Instrucción de ejecución en el contexto del script: `<?php if ($filtroEstado \|\| $busqueda): ?>`. |
| `354` | `            <a href="admin_grupos.php?programa=<?= $vistaPrograma ?>&ficha=...` | Enlace hipertexto de navegación o acción: `<a href="admin_grupos.php?programa=<?= $vistaPrograma ?>&ficha=<?= $vistaFicha ?>"`. |
| `355` | `               class="btn btn-sm btn-outline-secondary"><i class="fas fa-xm...` | Instrucción de ejecución en el contexto del script: `class="btn btn-sm btn-outline-secondary"><i class="fas fa-xmark"></i></a>`. |
| `356` | `            <?php endif; ?>` | Instrucción de ejecución en el contexto del script: `<?php endif; ?>`. |
| `357` | `        </div>` | Cierre de contenedor visual `<div>`. |
| `358` | `    </div>` | Cierre de contenedor visual `<div>`. |
| `359` | `</form>` | Cierre de formulario HTML. |
| `360` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `361` | `<!-- Tabla de grupos -->` | Instrucción de ejecución en el contexto del script: `<!-- Tabla de grupos -->`. |
| `362` | `<div class="card shadow-sm border-0">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="card shadow-sm border-0">`. |
| `363` | `    <div class="card-header bg-white border-0 py-3 d-flex justify-content-b...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="card-header bg-white border-0 py-3 d-flex justify-content-between align-items-center">`. |
| `364` | `        <h6 class="fw-bold mb-0">` | Instrucción de ejecución en el contexto del script: `<h6 class="fw-bold mb-0">`. |
| `365` | `            <i class="fas fa-people-group text-success me-2"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-people-group text-success me-2"></i>`. |
| `366` | `            Grupos — <?= htmlspecialchars($fichaAct['nombre_programa']) ?>` | Instrucción de ejecución en el contexto del script: `Grupos — <?= htmlspecialchars($fichaAct['nombre_programa']) ?>`. |
| `367` | `        </h6>` | Instrucción de ejecución en el contexto del script: `</h6>`. |
| `368` | `        <span class="badge bg-secondary"><?= count($grupos) ?> grupo(s)</span>` | Instrucción de ejecución en el contexto del script: `<span class="badge bg-secondary"><?= count($grupos) ?> grupo(s)</span>`. |
| `369` | `    </div>` | Cierre de contenedor visual `<div>`. |
| `370` | `    <div class="card-body p-0">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="card-body p-0">`. |
| `371` | `        <?php if (empty($grupos)): ?>` | Instrucción de ejecución en el contexto del script: `<?php if (empty($grupos)): ?>`. |
| `372` | `        <div class="text-center py-5 text-muted">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="text-center py-5 text-muted">`. |
| `373` | `            <i class="fas fa-people-group fa-3x mb-3 opacity-25 d-block"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-people-group fa-3x mb-3 opacity-25 d-block"></i>`. |
| `374` | `            <p class="small mb-0">No hay grupos registrados en esta ficha.</p>` | Instrucción de ejecución en el contexto del script: `<p class="small mb-0">No hay grupos registrados en esta ficha.</p>`. |
| `375` | `        </div>` | Cierre de contenedor visual `<div>`. |
| `376` | `        <?php else: ?>` | Instrucción de ejecución en el contexto del script: `<?php else: ?>`. |
| `377` | `        <div class="table-responsive">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="table-responsive">`. |
| `378` | `            <table class="table tabla-limpia align-middle mb-0">` | Tabla de datos para despliegue estructurado de información: `<table class="table tabla-limpia align-middle mb-0">`. |
| `379` | `                <thead class="table-light">` | Celda de tabla con contenido de datos o encabezado de columna: `<thead class="table-light">`. |
| `380` | `                    <tr>` | Fila contenedora de datos dentro de la tabla. |
| `381` | `                        <th>Grupo</th>` | Celda de tabla con contenido de datos o encabezado de columna: `<th>Grupo</th>`. |
| `382` | `                        <th>Vocero</th>` | Celda de tabla con contenido de datos o encabezado de columna: `<th>Vocero</th>`. |
| `383` | `                        <th>Módulo</th>` | Celda de tabla con contenido de datos o encabezado de columna: `<th>Módulo</th>`. |
| `384` | `                        <th>Fecha Limpieza</th>` | Celda de tabla con contenido de datos o encabezado de columna: `<th>Fecha Limpieza</th>`. |
| `385` | `                        <th class="text-center">Evidencia</th>` | Celda de tabla con contenido de datos o encabezado de columna: `<th class="text-center">Evidencia</th>`. |
| `386` | `                        <th>Estado</th>` | Celda de tabla con contenido de datos o encabezado de columna: `<th>Estado</th>`. |
| `387` | `                        <th class="text-center">Integrantes</th>` | Celda de tabla con contenido de datos o encabezado de columna: `<th class="text-center">Integrantes</th>`. |
| `388` | `                    </tr>` | Fila contenedora de datos dentro de la tabla. |
| `389` | `                </thead>` | Instrucción de ejecución en el contexto del script: `</thead>`. |
| `390` | `                <tbody>` | Instrucción de ejecución en el contexto del script: `<tbody>`. |
| `391` | `                <?php foreach ($grupos as $g):` | Instrucción de ejecución en el contexto del script: `<?php foreach ($grupos as $g):`. |
| `392` | `                    $badge = match($g['estado']) {` | Instrucción de ejecución en el contexto del script: `$badge = match($g['estado']) {`. |
| `393` | `                        'Completado' => 'bg-primary',` | Instrucción de ejecución en el contexto del script: `'Completado' => 'bg-primary',`. |
| `394` | `                        'Sancionado' => 'bg-danger',` | Instrucción de ejecución en el contexto del script: `'Sancionado' => 'bg-danger',`. |
| `395` | `                        default      => 'bg-success',` | Instrucción de ejecución en el contexto del script: `default      => 'bg-success',`. |
| `396` | `                    };` | Instrucción de ejecución en el contexto del script: `};`. |
| `397` | `                    $esHoy = date('Y-m-d', strtotime($g['fecha_limpieza']))...` | Instrucción de ejecución en el contexto del script: `$esHoy = date('Y-m-d', strtotime($g['fecha_limpieza'])) === date('Y-m-d');`. |
| `398` | `                ?>` | Cierre de la etiqueta PHP para alternar a salida HTML o fin del archivo. |
| `399` | `                <tr>` | Fila contenedora de datos dentro de la tabla. |
| `400` | `                    <td class="fw-semibold small">` | Celda de tabla con contenido de datos o encabezado de columna: `<td class="fw-semibold small">`. |
| `401` | `                        <?= htmlspecialchars($g['nombre_grupo']) ?>` | Instrucción de ejecución en el contexto del script: `<?= htmlspecialchars($g['nombre_grupo']) ?>`. |
| `402` | `                        <?php if ($esHoy): ?>` | Instrucción de ejecución en el contexto del script: `<?php if ($esHoy): ?>`. |
| `403` | `                            <span class="badge bg-warning text-dark ms-1" s...` | Instrucción de ejecución en el contexto del script: `<span class="badge bg-warning text-dark ms-1" style="font-size:.65rem;">Hoy</span>`. |
| `404` | `                        <?php endif; ?>` | Instrucción de ejecución en el contexto del script: `<?php endif; ?>`. |
| `405` | `                    </td>` | Celda de tabla con contenido de datos o encabezado de columna: `</td>`. |
| `406` | `                    <td class="small"><?= htmlspecialchars($g['vocero_nombr...` | Celda de tabla con contenido de datos o encabezado de columna: `<td class="small"><?= htmlspecialchars($g['vocero_nombres'] . ' ' . $g['vocero_apellidos']) ?></td>`. |
| `407` | `                    <td class="small text-muted"><?= htmlspecialchars($g['n...` | Celda de tabla con contenido de datos o encabezado de columna: `<td class="small text-muted"><?= htmlspecialchars($g['nombre_modulo']) ?></td>`. |
| `408` | `                    <td class="small"><?= date('d/m/Y', strtotime($g['fecha...` | Celda de tabla con contenido de datos o encabezado de columna: `<td class="small"><?= date('d/m/Y', strtotime($g['fecha_limpieza'])) ?></td>`. |
| `409` | `                    <td class="text-center">` | Celda de tabla con contenido de datos o encabezado de columna: `<td class="text-center">`. |
| `410` | `                        <?php if ((int)$g['tiene_evidencia'] > 0): ?>` | Instrucción de ejecución en el contexto del script: `<?php if ((int)$g['tiene_evidencia'] > 0): ?>`. |
| `411` | `                            <span class="text-success fw-bold fs-5">✓</span>` | Instrucción de ejecución en el contexto del script: `<span class="text-success fw-bold fs-5">✓</span>`. |
| `412` | `                        <?php else: ?>` | Instrucción de ejecución en el contexto del script: `<?php else: ?>`. |
| `413` | `                            <span class="text-danger">✗</span>` | Instrucción de ejecución en el contexto del script: `<span class="text-danger">✗</span>`. |
| `414` | `                        <?php endif; ?>` | Instrucción de ejecución en el contexto del script: `<?php endif; ?>`. |
| `415` | `                    </td>` | Celda de tabla con contenido de datos o encabezado de columna: `</td>`. |
| `416` | `                    <td><span class="badge <?= $badge ?>"><?= $g['estado'] ...` | Celda de tabla con contenido de datos o encabezado de columna: `<td><span class="badge <?= $badge ?>"><?= $g['estado'] ?></span></td>`. |
| `417` | `                    <td class="text-center">` | Celda de tabla con contenido de datos o encabezado de columna: `<td class="text-center">`. |
| `418` | `                        <a href="?programa=<?= $vistaPrograma ?>&ficha=<?= ...` | Enlace hipertexto de navegación o acción: `<a href="?programa=<?= $vistaPrograma ?>&ficha=<?= $vistaFicha ?>&grupo=<?= $g['id_grupo'] ?><?= $filtroEstado ? '&estado='.urlencode($filtroEstado) : '' ?><?= $busqueda ? '&q='.urlencode($busqueda) : '' ?>"`. |
| `419` | `                           class="btn btn-sm btn-outline-success" title="Ve...` | Instrucción de ejecución en el contexto del script: `class="btn btn-sm btn-outline-success" title="Ver integrantes">`. |
| `420` | `                            <i class="fas fa-users me-1"></i><?= (int)$g['t...` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-users me-1"></i><?= (int)$g['total_integrantes'] ?>`. |
| `421` | `                        </a>` | Instrucción de ejecución en el contexto del script: `</a>`. |
| `422` | `                    </td>` | Celda de tabla con contenido de datos o encabezado de columna: `</td>`. |
| `423` | `                </tr>` | Fila contenedora de datos dentro de la tabla. |
| `424` | `                <?php endforeach; ?>` | Instrucción de ejecución en el contexto del script: `<?php endforeach; ?>`. |
| `425` | `                </tbody>` | Instrucción de ejecución en el contexto del script: `</tbody>`. |
| `426` | `            </table>` | Tabla de datos para despliegue estructurado de información: `</table>`. |
| `427` | `        </div>` | Cierre de contenedor visual `<div>`. |
| `428` | `        <?php endif; ?>` | Instrucción de ejecución en el contexto del script: `<?php endif; ?>`. |
| `429` | `    </div>` | Cierre de contenedor visual `<div>`. |
| `430` | `</div>` | Cierre de contenedor visual `<div>`. |
| `431` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `432` | `<!-- Panel integrantes -->` | Instrucción de ejecución en el contexto del script: `<!-- Panel integrantes -->`. |
| `433` | `<?php if ($grupoDetalle): ?>` | Instrucción de ejecución en el contexto del script: `<?php if ($grupoDetalle): ?>`. |
| `434` | `<div class="card shadow-sm border-0 mt-4" style="border-top:3px solid #39a9...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="card shadow-sm border-0 mt-4" style="border-top:3px solid #39a900 !important;">`. |
| `435` | `    <div class="card-header bg-white border-0 py-3 d-flex justify-content-b...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="card-header bg-white border-0 py-3 d-flex justify-content-between align-items-center">`. |
| `436` | `        <h6 class="fw-bold mb-0">` | Instrucción de ejecución en el contexto del script: `<h6 class="fw-bold mb-0">`. |
| `437` | `            <i class="fas fa-users text-success me-2"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-users text-success me-2"></i>`. |
| `438` | `            Integrantes — <?= htmlspecialchars($grupoDetalle['nombre_grupo'...` | Instrucción de ejecución en el contexto del script: `Integrantes — <?= htmlspecialchars($grupoDetalle['nombre_grupo']) ?>`. |
| `439` | `            <span class="text-muted fw-normal small ms-2">` | Instrucción de ejecución en el contexto del script: `<span class="text-muted fw-normal small ms-2">`. |
| `440` | `                <?= htmlspecialchars($grupoDetalle['nombre_modulo']) ?> · <...` | Instrucción de ejecución en el contexto del script: `<?= htmlspecialchars($grupoDetalle['nombre_modulo']) ?> · <?= date('d/m/Y', strtotime($grupoDetalle['fecha_limpieza'])) ?>`. |
| `441` | `            </span>` | Instrucción de ejecución en el contexto del script: `</span>`. |
| `442` | `        </h6>` | Instrucción de ejecución en el contexto del script: `</h6>`. |
| `443` | `        <div class="d-flex gap-2 align-items-center">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="d-flex gap-2 align-items-center">`. |
| `444` | `            <span class="badge bg-success"><?= count($integrantesDet) ?> in...` | Instrucción de ejecución en el contexto del script: `<span class="badge bg-success"><?= count($integrantesDet) ?> integrante(s)</span>`. |
| `445` | `            <a href="admin_grupos.php?programa=<?= $vistaPrograma ?>&ficha=...` | Enlace hipertexto de navegación o acción: `<a href="admin_grupos.php?programa=<?= $vistaPrograma ?>&ficha=<?= $vistaFicha ?>"`. |
| `446` | `               class="btn btn-sm btn-outline-secondary"><i class="fas fa-xm...` | Instrucción de ejecución en el contexto del script: `class="btn btn-sm btn-outline-secondary"><i class="fas fa-xmark"></i></a>`. |
| `447` | `        </div>` | Cierre de contenedor visual `<div>`. |
| `448` | `    </div>` | Cierre de contenedor visual `<div>`. |
| `449` | `    <div class="card-body p-0">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="card-body p-0">`. |
| `450` | `        <?php if (empty($integrantesDet)): ?>` | Instrucción de ejecución en el contexto del script: `<?php if (empty($integrantesDet)): ?>`. |
| `451` | `            <div class="text-center py-4 text-muted small">No hay integrant...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="text-center py-4 text-muted small">No hay integrantes.</div>`. |
| `452` | `        <?php else: ?>` | Instrucción de ejecución en el contexto del script: `<?php else: ?>`. |
| `453` | `        <table class="table tabla-limpia align-middle mb-0">` | Tabla de datos para despliegue estructurado de información: `<table class="table tabla-limpia align-middle mb-0">`. |
| `454` | `            <thead class="table-light">` | Celda de tabla con contenido de datos o encabezado de columna: `<thead class="table-light">`. |
| `455` | `                <tr><th>#</th><th>Apellidos</th><th>Nombres</th><th>Documen...` | Fila contenedora de datos dentro de la tabla. |
| `456` | `            </thead>` | Instrucción de ejecución en el contexto del script: `</thead>`. |
| `457` | `            <tbody>` | Instrucción de ejecución en el contexto del script: `<tbody>`. |
| `458` | `            <?php foreach ($integrantesDet as $i => $ap): ?>` | Instrucción de ejecución en el contexto del script: `<?php foreach ($integrantesDet as $i => $ap): ?>`. |
| `459` | `            <tr>` | Fila contenedora de datos dentro de la tabla. |
| `460` | `                <td class="text-muted small"><?= $i + 1 ?></td>` | Celda de tabla con contenido de datos o encabezado de columna: `<td class="text-muted small"><?= $i + 1 ?></td>`. |
| `461` | `                <td class="fw-semibold small"><?= htmlspecialchars($ap['ape...` | Celda de tabla con contenido de datos o encabezado de columna: `<td class="fw-semibold small"><?= htmlspecialchars($ap['apellidos']) ?></td>`. |
| `462` | `                <td class="small"><?= htmlspecialchars($ap['nombres']) ?></td>` | Celda de tabla con contenido de datos o encabezado de columna: `<td class="small"><?= htmlspecialchars($ap['nombres']) ?></td>`. |
| `463` | `                <td class="small text-muted"><?= htmlspecialchars($ap['docu...` | Celda de tabla con contenido de datos o encabezado de columna: `<td class="small text-muted"><?= htmlspecialchars($ap['documento'] ?? '—') ?></td>`. |
| `464` | `                <td class="small">` | Celda de tabla con contenido de datos o encabezado de columna: `<td class="small">`. |
| `465` | `                    <?php if (!empty($ap['celular'])): ?>` | Instrucción de ejecución en el contexto del script: `<?php if (!empty($ap['celular'])): ?>`. |
| `466` | `                        <a href="tel:<?= htmlspecialchars($ap['celular']) ?...` | Enlace hipertexto de navegación o acción: `<a href="tel:<?= htmlspecialchars($ap['celular']) ?>" class="text-decoration-none text-dark">`. |
| `467` | `                            <i class="fas fa-phone text-success me-1" style...` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-phone text-success me-1" style="font-size:.72rem;"></i><?= htmlspecialchars($ap['celular']) ?>`. |
| `468` | `                        </a>` | Instrucción de ejecución en el contexto del script: `</a>`. |
| `469` | `                    <?php else: ?><span class="text-muted">—</span><?php en...` | Instrucción de ejecución en el contexto del script: `<?php else: ?><span class="text-muted">—</span><?php endif; ?>`. |
| `470` | `                </td>` | Celda de tabla con contenido de datos o encabezado de columna: `</td>`. |
| `471` | `                <td class="small">` | Celda de tabla con contenido de datos o encabezado de columna: `<td class="small">`. |
| `472` | `                    <?php if (!empty($ap['correo'])): ?>` | Instrucción de ejecución en el contexto del script: `<?php if (!empty($ap['correo'])): ?>`. |
| `473` | `                        <a href="mailto:<?= htmlspecialchars($ap['correo'])...` | Enlace hipertexto de navegación o acción: `<a href="mailto:<?= htmlspecialchars($ap['correo']) ?>"`. |
| `474` | `                           class="text-decoration-none text-dark text-trunc...` | Instrucción de ejecución en el contexto del script: `class="text-decoration-none text-dark text-truncate d-inline-block"`. |
| `475` | `                           style="max-width:160px;" title="<?= htmlspecialc...` | Instrucción de ejecución en el contexto del script: `style="max-width:160px;" title="<?= htmlspecialchars($ap['correo']) ?>">`. |
| `476` | `                            <i class="fas fa-envelope text-success me-1" st...` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-envelope text-success me-1" style="font-size:.72rem;"></i><?= htmlspecialchars($ap['correo']) ?>`. |
| `477` | `                        </a>` | Instrucción de ejecución en el contexto del script: `</a>`. |
| `478` | `                    <?php else: ?><span class="text-muted">—</span><?php en...` | Instrucción de ejecución en el contexto del script: `<?php else: ?><span class="text-muted">—</span><?php endif; ?>`. |
| `479` | `                </td>` | Celda de tabla con contenido de datos o encabezado de columna: `</td>`. |
| `480` | `            </tr>` | Fila contenedora de datos dentro de la tabla. |
| `481` | `            <?php endforeach; ?>` | Instrucción de ejecución en el contexto del script: `<?php endforeach; ?>`. |
| `482` | `            </tbody>` | Instrucción de ejecución en el contexto del script: `</tbody>`. |
| `483` | `        </table>` | Tabla de datos para despliegue estructurado de información: `</table>`. |
| `484` | `        <?php endif; ?>` | Instrucción de ejecución en el contexto del script: `<?php endif; ?>`. |
| `485` | `    </div>` | Cierre de contenedor visual `<div>`. |
| `486` | `</div>` | Cierre de contenedor visual `<div>`. |
| `487` | `<?php endif; ?>` | Instrucción de ejecución en el contexto del script: `<?php endif; ?>`. |
| `488` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `489` | `<?php endif; ?>` | Instrucción de ejecución en el contexto del script: `<?php endif; ?>`. |
| `490` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `491` | `<style>` | Instrucción de ejecución en el contexto del script: `<style>`. |
| `492` | `.prog-card { transition: transform .2s, box-shadow .2s; cursor: pointer; }` | Instrucción de ejecución en el contexto del script: `.prog-card { transition: transform .2s, box-shadow .2s; cursor: pointer; }`. |
| `493` | `.prog-card:hover { transform: translateY(-3px); box-shadow: 0 8px 24px rgba...` | Instrucción de ejecución en el contexto del script: `.prog-card:hover { transform: translateY(-3px); box-shadow: 0 8px 24px rgba(0,0,0,.1) !important; }`. |
| `494` | `.breadcrumb-item + .breadcrumb-item::before { color: #9ca3af; }` | Instrucción de ejecución en el contexto del script: `.breadcrumb-item + .breadcrumb-item::before { color: #9ca3af; }`. |
| `495` | `</style>` | Instrucción de ejecución en el contexto del script: `</style>`. |
| `496` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `497` | `<script>` | Bloque o etiqueta de vinculación para scripts JavaScript del lado del cliente. |
| `498` | `const bP = document.getElementById('buscPrograma');` | Instrucción de ejecución en el contexto del script: `const bP = document.getElementById('buscPrograma');`. |
| `499` | `if (bP) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (bP) {`. |
| `500` | `    bP.addEventListener('input', function () {` | Declaración de método o función con su firma y parámetros: `bP.addEventListener('input', function () {`. |
| `501` | `        const q = this.value.toLowerCase();` | Instrucción de ejecución en el contexto del script: `const q = this.value.toLowerCase();`. |
| `502` | `        document.querySelectorAll('.prog-item').forEach(el => {` | Instrucción de ejecución en el contexto del script: `document.querySelectorAll('.prog-item').forEach(el => {`. |
| `503` | `            el.style.display = !q \|\| el.textContent.toLowerCase().include...` | Instrucción de ejecución en el contexto del script: `el.style.display = !q \|\| el.textContent.toLowerCase().includes(q) ? '' : 'none';`. |
| `504` | `        });` | Instrucción de ejecución en el contexto del script: `});`. |
| `505` | `    });` | Instrucción de ejecución en el contexto del script: `});`. |
| `506` | `}` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `507` | `<?php if ($alert): ?>` | Instrucción de ejecución en el contexto del script: `<?php if ($alert): ?>`. |
| `508` | `document.addEventListener('DOMContentLoaded', function () {` | Declaración de método o función con su firma y parámetros: `document.addEventListener('DOMContentLoaded', function () {`. |
| `509` | `    Swal.fire({ icon:'<?= addslashes($alert['icon']) ?>', title:'<?= addsla...` | Instrucción de ejecución en el contexto del script: `Swal.fire({ icon:'<?= addslashes($alert['icon']) ?>', title:'<?= addslashes($alert['title']) ?>', text:'<?= addslashes($alert['text']) ?>', confirmButtonColor:'#39a900' });`. |
| `510` | `});` | Instrucción de ejecución en el contexto del script: `});`. |
| `511` | `<?php endif; ?>` | Instrucción de ejecución en el contexto del script: `<?php endif; ?>`. |
| `512` | `</script>` | Bloque o etiqueta de vinculación para scripts JavaScript del lado del cliente. |
| `513` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `514` | `<?php require_once __DIR__ . '/../layouts/footer.php'; ?>` | Instrucción de ejecución en el contexto del script: `<?php require_once __DIR__ . '/../layouts/footer.php'; ?>`. |

---

## 3. Resumen y Flujo de Interacción

El archivo `admin_grupos.php` cumple un rol indispensable en `views/dashboard/admin_grupos.php`. 
Vista administrativa para supervisar la conformación de grupos de limpieza y aprendices asignados. Garantiza la robustez, el orden y la estabilidad de la arquitectura del proyecto `systemLimpieza`.
