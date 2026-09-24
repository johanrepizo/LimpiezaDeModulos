# Documentación Línea por Línea: `views/dashboard/admin_evidencias.php`

## 1. Ficha Técnica del Archivo

- **Archivo:** `admin_evidencias.php`
- **Ruta en el proyecto:** `views/dashboard/admin_evidencias.php`
- **Cantidad total de líneas:** `522`
- **Tipo de archivo:** `PHP`
- **Propósito general:** Módulo administrativo para revisar, filtrar y auditar las evidencias fotográficas subidas por los voceros de cada módulo.

---

## 2. Explicación Detallada Línea por Línea

A continuación se presenta cada línea de código numerada de forma consecutiva, acompañada de su fragmento exacto y la explicación exhaustiva de su funcionamiento y responsabilidad en el sistema:

| Línea | Código Fuente | Explicación Detallada |
|---|---|---|
| `1` | `<?php` | Apertura obligatoria de la etiqueta PHP para ejecución del código del lado del servidor. |
| `2` | `$titulo = 'Evidencias';` | Instrucción de ejecución en el contexto del script: `$titulo = 'Evidencias';`. |
| `3` | `if (session_status() === PHP_SESSION_NONE) session_start();` | Inicia o reanuda la sesión PHP del usuario si no se encontraba activa previamente. |
| `4` | `if (!isset($_SESSION['usuario']) \|\| (int)$_SESSION['usuario']['rol'] !== ...` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (!isset($_SESSION['usuario']) \|\| (int)$_SESSION['usuario']['rol'] !== 1) {`. |
| `5` | `    header("Location: ../usuarios/login.php"); exit;` | Emite cabecera HTTP de redirección en el navegador: `header("Location: ../usuarios/login.php"); exit;`. |
| `6` | `}` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `7` | `require_once __DIR__ . '/../../config/database.php';` | Importación e inclusión obligatoria del archivo de dependencia requerido: `require_once __DIR__ . '/../../config/database.php';`. |
| `8` | `require_once __DIR__ . '/../../models/Programa.php';` | Importación e inclusión obligatoria del archivo de dependencia requerido: `require_once __DIR__ . '/../../models/Programa.php';`. |
| `9` | `require_once __DIR__ . '/../../models/Ficha.php';` | Importación e inclusión obligatoria del archivo de dependencia requerido: `require_once __DIR__ . '/../../models/Ficha.php';`. |
| `10` | `require_once __DIR__ . '/../../models/Evidencia.php';` | Importación e inclusión obligatoria del archivo de dependencia requerido: `require_once __DIR__ . '/../../models/Evidencia.php';`. |
| `11` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `12` | `$db        = (new Database())->conectar();` | Instrucción de ejecución en el contexto del script: `$db        = (new Database())->conectar();`. |
| `13` | `$modelProg = new Programa($db);` | Instrucción de ejecución en el contexto del script: `$modelProg = new Programa($db);`. |
| `14` | `$modelFich = new Ficha($db);` | Instrucción de ejecución en el contexto del script: `$modelFich = new Ficha($db);`. |
| `15` | `$modelEv   = new Evidencia($db);` | Instrucción de ejecución en el contexto del script: `$modelEv   = new Evidencia($db);`. |
| `16` | `$alert     = $_SESSION['alert'] ?? null;` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección: `$alert     = $_SESSION['alert'] ?? null;`. |
| `17` | `unset($_SESSION['alert']);` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección: `unset($_SESSION['alert']);`. |
| `18` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `19` | `$vistaPrograma = (int)($_GET['programa'] ?? 0);` | Captura y sanitiza parámetros enviados por el cliente mediante petición HTTP: `$vistaPrograma = (int)($_GET['programa'] ?? 0);`. |
| `20` | `$vistaFicha    = (int)($_GET['ficha']    ?? 0);` | Captura y sanitiza parámetros enviados por el cliente mediante petición HTTP: `$vistaFicha    = (int)($_GET['ficha']    ?? 0);`. |
| `21` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `22` | `$programas     = $modelProg->obtenerTodos();` | Instrucción de ejecución en el contexto del script: `$programas     = $modelProg->obtenerTodos();`. |
| `23` | `$programaAct   = null;` | Instrucción de ejecución en el contexto del script: `$programaAct   = null;`. |
| `24` | `$fichasDelProg = [];` | Instrucción de ejecución en el contexto del script: `$fichasDelProg = [];`. |
| `25` | `$fichaAct      = null;` | Instrucción de ejecución en el contexto del script: `$fichaAct      = null;`. |
| `26` | `$evidencias    = [];` | Instrucción de ejecución en el contexto del script: `$evidencias    = [];`. |
| `27` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `28` | `if ($vistaPrograma) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if ($vistaPrograma) {`. |
| `29` | `    $programaAct = $modelProg->obtenerPorId($vistaPrograma);` | Instrucción de ejecución en el contexto del script: `$programaAct = $modelProg->obtenerPorId($vistaPrograma);`. |
| `30` | `    $stmtF = $db->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmtF = $db->prepare(`. |
| `31` | `        "SELECT f.*,` | Instrucción de ejecución en el contexto del script: `"SELECT f.*,`. |
| `32` | `                ANY_VALUE(v.nombres)   AS vocero_nombres,` | Instrucción de ejecución en el contexto del script: `ANY_VALUE(v.nombres)   AS vocero_nombres,`. |
| `33` | `                ANY_VALUE(v.apellidos) AS vocero_apellidos,` | Instrucción de ejecución en el contexto del script: `ANY_VALUE(v.apellidos) AS vocero_apellidos,`. |
| `34` | `                COUNT(DISTINCT ap.id_aprendiz) AS total_aprendices` | Instrucción de ejecución en el contexto del script: `COUNT(DISTINCT ap.id_aprendiz) AS total_aprendices`. |
| `35` | `         FROM fichas f` | Instrucción de ejecución en el contexto del script: `FROM fichas f`. |
| `36` | `         LEFT JOIN voceros    v  ON v.id_ficha  = f.id_ficha AND v.activo = 1` | Instrucción de ejecución en el contexto del script: `LEFT JOIN voceros    v  ON v.id_ficha  = f.id_ficha AND v.activo = 1`. |
| `37` | `         LEFT JOIN aprendices ap ON ap.id_ficha = f.id_ficha AND ap.activo = 1` | Instrucción de ejecución en el contexto del script: `LEFT JOIN aprendices ap ON ap.id_ficha = f.id_ficha AND ap.activo = 1`. |
| `38` | `         WHERE f.id_programa = :prog AND f.activo = 1` | Instrucción de ejecución en el contexto del script: `WHERE f.id_programa = :prog AND f.activo = 1`. |
| `39` | `         GROUP BY f.id_ficha ORDER BY f.numero_ficha"` | Instrucción de ejecución en el contexto del script: `GROUP BY f.id_ficha ORDER BY f.numero_ficha"`. |
| `40` | `    );` | Instrucción de ejecución en el contexto del script: `);`. |
| `41` | `    $stmtF->execute([':prog' => $vistaPrograma]);` | Ejecuta la sentencia SQL preparada vinculando los datos correspondientes: `$stmtF->execute([':prog' => $vistaPrograma]);`. |
| `42` | `    $fichasDelProg = $stmtF->fetchAll(PDO::FETCH_ASSOC);` | Obtiene todos los registros coincidentes de la consulta en un arreglo asociativo. |
| `43` | `}` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `44` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `45` | `if ($vistaFicha) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if ($vistaFicha) {`. |
| `46` | `    $stmtFA = $db->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmtFA = $db->prepare(`. |
| `47` | `        "SELECT f.*, p.nombre AS nombre_programa,` | Instrucción de ejecución en el contexto del script: `"SELECT f.*, p.nombre AS nombre_programa,`. |
| `48` | `                ANY_VALUE(v.nombres)   AS vocero_nombres,` | Instrucción de ejecución en el contexto del script: `ANY_VALUE(v.nombres)   AS vocero_nombres,`. |
| `49` | `                ANY_VALUE(v.apellidos) AS vocero_apellidos` | Instrucción de ejecución en el contexto del script: `ANY_VALUE(v.apellidos) AS vocero_apellidos`. |
| `50` | `         FROM fichas f` | Instrucción de ejecución en el contexto del script: `FROM fichas f`. |
| `51` | `         JOIN programas p ON p.id_programa = f.id_programa` | Instrucción de ejecución en el contexto del script: `JOIN programas p ON p.id_programa = f.id_programa`. |
| `52` | `         LEFT JOIN voceros v ON v.id_ficha = f.id_ficha AND v.activo = 1` | Instrucción de ejecución en el contexto del script: `LEFT JOIN voceros v ON v.id_ficha = f.id_ficha AND v.activo = 1`. |
| `53` | `         WHERE f.id_ficha = :id GROUP BY f.id_ficha LIMIT 1"` | Instrucción de ejecución en el contexto del script: `WHERE f.id_ficha = :id GROUP BY f.id_ficha LIMIT 1"`. |
| `54` | `    );` | Instrucción de ejecución en el contexto del script: `);`. |
| `55` | `    $stmtFA->execute([':id' => $vistaFicha]);` | Ejecuta la sentencia SQL preparada vinculando los datos correspondientes: `$stmtFA->execute([':id' => $vistaFicha]);`. |
| `56` | `    $fichaAct = $stmtFA->fetch(PDO::FETCH_ASSOC);` | Recupera una única fila o registro resultante de la consulta. |
| `57` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `58` | `    if ($fichaAct) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if ($fichaAct) {`. |
| `59` | `        $vistaPrograma = (int)$fichaAct['id_programa'];` | Instrucción de ejecución en el contexto del script: `$vistaPrograma = (int)$fichaAct['id_programa'];`. |
| `60` | `        $programaAct   = $modelProg->obtenerPorId($vistaPrograma);` | Instrucción de ejecución en el contexto del script: `$programaAct   = $modelProg->obtenerPorId($vistaPrograma);`. |
| `61` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `62` | `        $stmtF2 = $db->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmtF2 = $db->prepare(`. |
| `63` | `            "SELECT f.*,` | Instrucción de ejecución en el contexto del script: `"SELECT f.*,`. |
| `64` | `                    ANY_VALUE(v.nombres)   AS vocero_nombres,` | Instrucción de ejecución en el contexto del script: `ANY_VALUE(v.nombres)   AS vocero_nombres,`. |
| `65` | `                    ANY_VALUE(v.apellidos) AS vocero_apellidos,` | Instrucción de ejecución en el contexto del script: `ANY_VALUE(v.apellidos) AS vocero_apellidos,`. |
| `66` | `                    COUNT(DISTINCT ap.id_aprendiz) AS total_aprendices` | Instrucción de ejecución en el contexto del script: `COUNT(DISTINCT ap.id_aprendiz) AS total_aprendices`. |
| `67` | `             FROM fichas f` | Instrucción de ejecución en el contexto del script: `FROM fichas f`. |
| `68` | `             LEFT JOIN voceros    v  ON v.id_ficha  = f.id_ficha AND v.acti...` | Instrucción de ejecución en el contexto del script: `LEFT JOIN voceros    v  ON v.id_ficha  = f.id_ficha AND v.activo = 1`. |
| `69` | `             LEFT JOIN aprendices ap ON ap.id_ficha = f.id_ficha AND ap.act...` | Instrucción de ejecución en el contexto del script: `LEFT JOIN aprendices ap ON ap.id_ficha = f.id_ficha AND ap.activo = 1`. |
| `70` | `             WHERE f.id_programa = :prog AND f.activo = 1` | Instrucción de ejecución en el contexto del script: `WHERE f.id_programa = :prog AND f.activo = 1`. |
| `71` | `             GROUP BY f.id_ficha ORDER BY f.numero_ficha"` | Instrucción de ejecución en el contexto del script: `GROUP BY f.id_ficha ORDER BY f.numero_ficha"`. |
| `72` | `        );` | Instrucción de ejecución en el contexto del script: `);`. |
| `73` | `        $stmtF2->execute([':prog' => $vistaPrograma]);` | Ejecuta la sentencia SQL preparada vinculando los datos correspondientes: `$stmtF2->execute([':prog' => $vistaPrograma]);`. |
| `74` | `        $fichasDelProg = $stmtF2->fetchAll(PDO::FETCH_ASSOC);` | Obtiene todos los registros coincidentes de la consulta en un arreglo asociativo. |
| `75` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `76` | `        $evidencias = $modelEv->obtenerTodas(['id_ficha' => $vistaFicha]);` | Instrucción de ejecución en el contexto del script: `$evidencias = $modelEv->obtenerTodas(['id_ficha' => $vistaFicha]);`. |
| `77` | `    }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `78` | `}` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `79` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `80` | `// Totales globales` | Comentario de línea explicativo: `Totales globales`. |
| `81` | `$stmtTotEv = $db->query("SELECT COUNT(*) FROM evidencias");` | Instrucción de ejecución en el contexto del script: `$stmtTotEv = $db->query("SELECT COUNT(*) FROM evidencias");`. |
| `82` | `$totalEvTotal = (int)$stmtTotEv->fetchColumn();` | Obtiene el valor de una columna única de la primera fila resultante. |
| `83` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `84` | `require_once __DIR__ . '/../layouts/header.php';` | Importación e inclusión obligatoria del archivo de dependencia requerido: `require_once __DIR__ . '/../layouts/header.php';`. |
| `85` | `?>` | Cierre de la etiqueta PHP para alternar a salida HTML o fin del archivo. |
| `86` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `87` | `<!-- ══ BREADCRUMB + CABECERA ═════════════════════════════════════════════...` | Instrucción de ejecución en el contexto del script: `<!-- ══ BREADCRUMB + CABECERA ════════════════════════════════════════════════ -->`. |
| `88` | `<div class="d-flex justify-content-between align-items-start mb-4 flex-wrap...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="d-flex justify-content-between align-items-start mb-4 flex-wrap gap-3">`. |
| `89` | `    <div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div>`. |
| `90` | `        <nav aria-label="breadcrumb" class="mb-1">` | Barra o elemento de navegación del sistema. |
| `91` | `            <ol class="breadcrumb mb-0" style="font-size:.82rem;">` | Instrucción de ejecución en el contexto del script: `<ol class="breadcrumb mb-0" style="font-size:.82rem;">`. |
| `92` | `                <li class="breadcrumb-item">` | Instrucción de ejecución en el contexto del script: `<li class="breadcrumb-item">`. |
| `93` | `                    <a href="admin_evidencias.php" class="text-success text...` | Enlace hipertexto de navegación o acción: `<a href="admin_evidencias.php" class="text-success text-decoration-none fw-semibold">`. |
| `94` | `                        <i class="fas fa-images me-1"></i>Evidencias` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-images me-1"></i>Evidencias`. |
| `95` | `                    </a>` | Instrucción de ejecución en el contexto del script: `</a>`. |
| `96` | `                </li>` | Instrucción de ejecución en el contexto del script: `</li>`. |
| `97` | `                <?php if ($programaAct): ?>` | Instrucción de ejecución en el contexto del script: `<?php if ($programaAct): ?>`. |
| `98` | `                <li class="breadcrumb-item">` | Instrucción de ejecución en el contexto del script: `<li class="breadcrumb-item">`. |
| `99` | `                    <?php if ($fichaAct): ?>` | Instrucción de ejecución en el contexto del script: `<?php if ($fichaAct): ?>`. |
| `100` | `                        <a href="admin_evidencias.php?programa=<?= $vistaPr...` | Enlace hipertexto de navegación o acción: `<a href="admin_evidencias.php?programa=<?= $vistaPrograma ?>"`. |
| `101` | `                           class="text-success text-decoration-none">` | Instrucción de ejecución en el contexto del script: `class="text-success text-decoration-none">`. |
| `102` | `                            <?= htmlspecialchars($programaAct['nombre']) ?>` | Instrucción de ejecución en el contexto del script: `<?= htmlspecialchars($programaAct['nombre']) ?>`. |
| `103` | `                        </a>` | Instrucción de ejecución en el contexto del script: `</a>`. |
| `104` | `                    <?php else: ?>` | Instrucción de ejecución en el contexto del script: `<?php else: ?>`. |
| `105` | `                        <span class="text-dark fw-semibold"><?= htmlspecial...` | Instrucción de ejecución en el contexto del script: `<span class="text-dark fw-semibold"><?= htmlspecialchars($programaAct['nombre']) ?></span>`. |
| `106` | `                    <?php endif; ?>` | Instrucción de ejecución en el contexto del script: `<?php endif; ?>`. |
| `107` | `                </li>` | Instrucción de ejecución en el contexto del script: `</li>`. |
| `108` | `                <?php endif; ?>` | Instrucción de ejecución en el contexto del script: `<?php endif; ?>`. |
| `109` | `                <?php if ($fichaAct): ?>` | Instrucción de ejecución en el contexto del script: `<?php if ($fichaAct): ?>`. |
| `110` | `                <li class="breadcrumb-item active">` | Instrucción de ejecución en el contexto del script: `<li class="breadcrumb-item active">`. |
| `111` | `                    Ficha <strong class="font-monospace"><?= htmlspecialcha...` | Instrucción de ejecución en el contexto del script: `Ficha <strong class="font-monospace"><?= htmlspecialchars($fichaAct['numero_ficha']) ?></strong>`. |
| `112` | `                </li>` | Instrucción de ejecución en el contexto del script: `</li>`. |
| `113` | `                <?php endif; ?>` | Instrucción de ejecución en el contexto del script: `<?php endif; ?>`. |
| `114` | `            </ol>` | Instrucción de ejecución en el contexto del script: `</ol>`. |
| `115` | `        </nav>` | Barra o elemento de navegación del sistema. |
| `116` | `        <h4 class="fw-bold mb-0">` | Instrucción de ejecución en el contexto del script: `<h4 class="fw-bold mb-0">`. |
| `117` | `            <?php if ($fichaAct): ?>` | Instrucción de ejecución en el contexto del script: `<?php if ($fichaAct): ?>`. |
| `118` | `                <i class="fas fa-images text-success me-2"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-images text-success me-2"></i>`. |
| `119` | `                Evidencias — Ficha <span class="font-monospace"><?= htmlspe...` | Instrucción de ejecución en el contexto del script: `Evidencias — Ficha <span class="font-monospace"><?= htmlspecialchars($fichaAct['numero_ficha']) ?></span>`. |
| `120` | `            <?php elseif ($programaAct): ?>` | Instrucción de ejecución en el contexto del script: `<?php elseif ($programaAct): ?>`. |
| `121` | `                <i class="fas fa-id-card text-success me-2"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-id-card text-success me-2"></i>`. |
| `122` | `                Fichas — <?= htmlspecialchars($programaAct['nombre']) ?>` | Instrucción de ejecución en el contexto del script: `Fichas — <?= htmlspecialchars($programaAct['nombre']) ?>`. |
| `123` | `            <?php else: ?>` | Instrucción de ejecución en el contexto del script: `<?php else: ?>`. |
| `124` | `                <i class="fas fa-images text-success me-2"></i>Evidencias d...` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-images text-success me-2"></i>Evidencias de Limpieza`. |
| `125` | `            <?php endif; ?>` | Instrucción de ejecución en el contexto del script: `<?php endif; ?>`. |
| `126` | `        </h4>` | Instrucción de ejecución en el contexto del script: `</h4>`. |
| `127` | `        <p class="text-muted small mb-0">` | Instrucción de ejecución en el contexto del script: `<p class="text-muted small mb-0">`. |
| `128` | `            <?php if ($fichaAct): ?>` | Instrucción de ejecución en el contexto del script: `<?php if ($fichaAct): ?>`. |
| `129` | `                Historial de evidencias fotográficas registradas por el vocero` | Instrucción de ejecución en el contexto del script: `Historial de evidencias fotográficas registradas por el vocero`. |
| `130` | `            <?php elseif ($programaAct): ?>` | Instrucción de ejecución en el contexto del script: `<?php elseif ($programaAct): ?>`. |
| `131` | `                Selecciona una ficha para ver el historial de evidencias` | Instrucción de ejecución en el contexto del script: `Selecciona una ficha para ver el historial de evidencias`. |
| `132` | `            <?php else: ?>` | Instrucción de ejecución en el contexto del script: `<?php else: ?>`. |
| `133` | `                Seguimiento centralizado de evidencias por programa y ficha` | Instrucción de ejecución en el contexto del script: `Seguimiento centralizado de evidencias por programa y ficha`. |
| `134` | `            <?php endif; ?>` | Instrucción de ejecución en el contexto del script: `<?php endif; ?>`. |
| `135` | `        </p>` | Instrucción de ejecución en el contexto del script: `</p>`. |
| `136` | `    </div>` | Cierre de contenedor visual `<div>`. |
| `137` | `</div>` | Cierre de contenedor visual `<div>`. |
| `138` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `139` | `<!-- ══ NIVEL 0: GRID DE PROGRAMAS ════════════════════════════════════════...` | Instrucción de ejecución en el contexto del script: `<!-- ══ NIVEL 0: GRID DE PROGRAMAS ════════════════════════════════════════════ -->`. |
| `140` | `<?php if (!$vistaPrograma && !$vistaFicha): ?>` | Instrucción de ejecución en el contexto del script: `<?php if (!$vistaPrograma && !$vistaFicha): ?>`. |
| `141` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `142` | `<div class="row g-3 mb-4">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="row g-3 mb-4">`. |
| `143` | `    <div class="col-sm-4">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="col-sm-4">`. |
| `144` | `        <div class="stat-card bg-white">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="stat-card bg-white">`. |
| `145` | `            <div class="d-flex align-items-center gap-3">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="d-flex align-items-center gap-3">`. |
| `146` | `                <div class="stat-icon" style="background:rgba(57,169,0,.12)...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="stat-icon" style="background:rgba(57,169,0,.12);color:#39a900;">`. |
| `147` | `                    <i class="fas fa-graduation-cap"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-graduation-cap"></i>`. |
| `148` | `                </div>` | Cierre de contenedor visual `<div>`. |
| `149` | `                <div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div>`. |
| `150` | `                    <div class="fs-4 fw-bold"><?= count($programas) ?></div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="fs-4 fw-bold"><?= count($programas) ?></div>`. |
| `151` | `                    <div class="text-muted small">Programas</div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="text-muted small">Programas</div>`. |
| `152` | `                </div>` | Cierre de contenedor visual `<div>`. |
| `153` | `            </div>` | Cierre de contenedor visual `<div>`. |
| `154` | `        </div>` | Cierre de contenedor visual `<div>`. |
| `155` | `    </div>` | Cierre de contenedor visual `<div>`. |
| `156` | `    <div class="col-sm-4">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="col-sm-4">`. |
| `157` | `        <div class="stat-card bg-white">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="stat-card bg-white">`. |
| `158` | `            <div class="d-flex align-items-center gap-3">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="d-flex align-items-center gap-3">`. |
| `159` | `                <div class="stat-icon" style="background:rgba(37,99,235,.1)...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="stat-icon" style="background:rgba(37,99,235,.1);color:#2563eb;">`. |
| `160` | `                    <i class="fas fa-id-card"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-id-card"></i>`. |
| `161` | `                </div>` | Cierre de contenedor visual `<div>`. |
| `162` | `                <div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div>`. |
| `163` | `                    <div class="fs-4 fw-bold"><?= array_sum(array_column($p...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="fs-4 fw-bold"><?= array_sum(array_column($programas,'total_fichas')) ?></div>`. |
| `164` | `                    <div class="text-muted small">Fichas activas</div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="text-muted small">Fichas activas</div>`. |
| `165` | `                </div>` | Cierre de contenedor visual `<div>`. |
| `166` | `            </div>` | Cierre de contenedor visual `<div>`. |
| `167` | `        </div>` | Cierre de contenedor visual `<div>`. |
| `168` | `    </div>` | Cierre de contenedor visual `<div>`. |
| `169` | `    <div class="col-sm-4">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="col-sm-4">`. |
| `170` | `        <div class="stat-card bg-white">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="stat-card bg-white">`. |
| `171` | `            <div class="d-flex align-items-center gap-3">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="d-flex align-items-center gap-3">`. |
| `172` | `                <div class="stat-icon" style="background:rgba(234,179,8,.1)...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="stat-icon" style="background:rgba(234,179,8,.1);color:#d97706;">`. |
| `173` | `                    <i class="fas fa-images"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-images"></i>`. |
| `174` | `                </div>` | Cierre de contenedor visual `<div>`. |
| `175` | `                <div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div>`. |
| `176` | `                    <div class="fs-4 fw-bold"><?= $totalEvTotal ?></div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="fs-4 fw-bold"><?= $totalEvTotal ?></div>`. |
| `177` | `                    <div class="text-muted small">Evidencias registradas</div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="text-muted small">Evidencias registradas</div>`. |
| `178` | `                </div>` | Cierre de contenedor visual `<div>`. |
| `179` | `            </div>` | Cierre de contenedor visual `<div>`. |
| `180` | `        </div>` | Cierre de contenedor visual `<div>`. |
| `181` | `    </div>` | Cierre de contenedor visual `<div>`. |
| `182` | `</div>` | Cierre de contenedor visual `<div>`. |
| `183` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `184` | `<div class="mb-3">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="mb-3">`. |
| `185` | `    <div class="input-group input-group-sm" style="max-width:340px;">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="input-group input-group-sm" style="max-width:340px;">`. |
| `186` | `        <span class="input-group-text bg-white"><i class="fas fa-search tex...` | Instrucción de ejecución en el contexto del script: `<span class="input-group-text bg-white"><i class="fas fa-search text-muted"></i></span>`. |
| `187` | `        <input type="text" id="buscPrograma" class="form-control border-sta...` | Campo de entrada interactivo para datos del usuario: `<input type="text" id="buscPrograma" class="form-control border-start-0" placeholder="Buscar programa…">`. |
| `188` | `    </div>` | Cierre de contenedor visual `<div>`. |
| `189` | `</div>` | Cierre de contenedor visual `<div>`. |
| `190` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `191` | `<div class="row g-3" id="gridProgramas">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="row g-3" id="gridProgramas">`. |
| `192` | `    <?php foreach ($programas as $p):` | Instrucción de ejecución en el contexto del script: `<?php foreach ($programas as $p):`. |
| `193` | `        $stmtEC = $db->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmtEC = $db->prepare(`. |
| `194` | `            "SELECT COUNT(*) FROM evidencias e` | Instrucción de ejecución en el contexto del script: `"SELECT COUNT(*) FROM evidencias e`. |
| `195` | `             JOIN grupos g ON g.id_grupo = e.id_grupo` | Instrucción de ejecución en el contexto del script: `JOIN grupos g ON g.id_grupo = e.id_grupo`. |
| `196` | `             JOIN asignaciones a ON a.id_asignacion = g.id_asignacion` | Instrucción de ejecución en el contexto del script: `JOIN asignaciones a ON a.id_asignacion = g.id_asignacion`. |
| `197` | `             WHERE a.id_ficha IN (SELECT id_ficha FROM fichas WHERE id_prog...` | Instrucción de ejecución en el contexto del script: `WHERE a.id_ficha IN (SELECT id_ficha FROM fichas WHERE id_programa = :prog)"`. |
| `198` | `        );` | Instrucción de ejecución en el contexto del script: `);`. |
| `199` | `        $stmtEC->execute([':prog' => $p['id_programa']]);` | Ejecuta la sentencia SQL preparada vinculando los datos correspondientes: `$stmtEC->execute([':prog' => $p['id_programa']]);`. |
| `200` | `        $cntEv = (int)$stmtEC->fetchColumn();` | Obtiene el valor de una columna única de la primera fila resultante. |
| `201` | `    ?>` | Cierre de la etiqueta PHP para alternar a salida HTML o fin del archivo. |
| `202` | `    <div class="col-md-6 col-lg-4 prog-item">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="col-md-6 col-lg-4 prog-item">`. |
| `203` | `        <a href="admin_evidencias.php?programa=<?= $p['id_programa'] ?>" cl...` | Enlace hipertexto de navegación o acción: `<a href="admin_evidencias.php?programa=<?= $p['id_programa'] ?>" class="text-decoration-none">`. |
| `204` | `            <div class="card border-0 shadow-sm h-100 prog-card" style="bor...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="card border-0 shadow-sm h-100 prog-card" style="border-radius:12px;">`. |
| `205` | `                <div class="card-body p-4">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="card-body p-4">`. |
| `206` | `                    <div class="d-flex align-items-start justify-content-be...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="d-flex align-items-start justify-content-between mb-3">`. |
| `207` | `                        <div style="width:44px;height:44px;border-radius:10px;` | Contenedor visual estructurado con Bootstrap/CSS: `<div style="width:44px;height:44px;border-radius:10px;`. |
| `208` | `                                    background:rgba(57,169,0,.12);color:#39...` | Instrucción de ejecución en el contexto del script: `background:rgba(57,169,0,.12);color:#39a900;`. |
| `209` | `                                    display:flex;align-items:center;justify...` | Instrucción de ejecución en el contexto del script: `display:flex;align-items:center;justify-content:center;font-size:1.2rem;">`. |
| `210` | `                            <i class="fas fa-graduation-cap"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-graduation-cap"></i>`. |
| `211` | `                        </div>` | Cierre de contenedor visual `<div>`. |
| `212` | `                        <span class="badge bg-light text-dark border" style...` | Instrucción de ejecución en el contexto del script: `<span class="badge bg-light text-dark border" style="font-size:.72rem;">`. |
| `213` | `                            <?= htmlspecialchars($p['nivel'] ?? 'Sin nivel'...` | Instrucción de ejecución en el contexto del script: `<?= htmlspecialchars($p['nivel'] ?? 'Sin nivel') ?>`. |
| `214` | `                        </span>` | Instrucción de ejecución en el contexto del script: `</span>`. |
| `215` | `                    </div>` | Cierre de contenedor visual `<div>`. |
| `216` | `                    <h6 class="fw-bold mb-3 text-dark" style="font-size:.88...` | Instrucción de ejecución en el contexto del script: `<h6 class="fw-bold mb-3 text-dark" style="font-size:.88rem;line-height:1.3;">`. |
| `217` | `                        <?= htmlspecialchars($p['nombre']) ?>` | Instrucción de ejecución en el contexto del script: `<?= htmlspecialchars($p['nombre']) ?>`. |
| `218` | `                    </h6>` | Instrucción de ejecución en el contexto del script: `</h6>`. |
| `219` | `                    <div class="d-flex gap-3 pt-3" style="border-top:1px so...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="d-flex gap-3 pt-3" style="border-top:1px solid #e5e7eb;">`. |
| `220` | `                        <div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div>`. |
| `221` | `                            <div class="fw-bold text-success fs-5"><?= (int...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="fw-bold text-success fs-5"><?= (int)$p['total_fichas'] ?></div>`. |
| `222` | `                            <div class="text-muted" style="font-size:.72rem...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="text-muted" style="font-size:.72rem;">Fichas</div>`. |
| `223` | `                        </div>` | Cierre de contenedor visual `<div>`. |
| `224` | `                        <div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div>`. |
| `225` | `                            <div class="fw-bold text-warning fs-5"><?= $cnt...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="fw-bold text-warning fs-5"><?= $cntEv ?></div>`. |
| `226` | `                            <div class="text-muted" style="font-size:.72rem...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="text-muted" style="font-size:.72rem;">Evidencias</div>`. |
| `227` | `                        </div>` | Cierre de contenedor visual `<div>`. |
| `228` | `                        <div class="ms-auto d-flex align-items-center text-...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="ms-auto d-flex align-items-center text-success" style="font-size:.82rem;">`. |
| `229` | `                            Ver fichas <i class="fas fa-arrow-right ms-1"></i>` | Instrucción de ejecución en el contexto del script: `Ver fichas <i class="fas fa-arrow-right ms-1"></i>`. |
| `230` | `                        </div>` | Cierre de contenedor visual `<div>`. |
| `231` | `                    </div>` | Cierre de contenedor visual `<div>`. |
| `232` | `                </div>` | Cierre de contenedor visual `<div>`. |
| `233` | `            </div>` | Cierre de contenedor visual `<div>`. |
| `234` | `        </a>` | Instrucción de ejecución en el contexto del script: `</a>`. |
| `235` | `    </div>` | Cierre de contenedor visual `<div>`. |
| `236` | `    <?php endforeach; ?>` | Instrucción de ejecución en el contexto del script: `<?php endforeach; ?>`. |
| `237` | `    <?php if (empty($programas)): ?>` | Instrucción de ejecución en el contexto del script: `<?php if (empty($programas)): ?>`. |
| `238` | `    <div class="col-12 text-center py-5 text-muted">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="col-12 text-center py-5 text-muted">`. |
| `239` | `        <i class="fas fa-graduation-cap fa-3x mb-3 opacity-25 d-block"></i>...` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-graduation-cap fa-3x mb-3 opacity-25 d-block"></i>No hay programas registrados.`. |
| `240` | `    </div>` | Cierre de contenedor visual `<div>`. |
| `241` | `    <?php endif; ?>` | Instrucción de ejecución en el contexto del script: `<?php endif; ?>`. |
| `242` | `</div>` | Cierre de contenedor visual `<div>`. |
| `243` | `<?php endif; ?>` | Instrucción de ejecución en el contexto del script: `<?php endif; ?>`. |
| `244` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `245` | `<!-- ══ NIVEL 1: FICHAS DEL PROGRAMA ══════════════════════════════════════...` | Instrucción de ejecución en el contexto del script: `<!-- ══ NIVEL 1: FICHAS DEL PROGRAMA ═════════════════════════════════════════ -->`. |
| `246` | `<?php if ($vistaPrograma && !$vistaFicha): ?>` | Instrucción de ejecución en el contexto del script: `<?php if ($vistaPrograma && !$vistaFicha): ?>`. |
| `247` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `248` | `<div class="row g-3">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="row g-3">`. |
| `249` | `    <?php foreach ($fichasDelProg as $f):` | Instrucción de ejecución en el contexto del script: `<?php foreach ($fichasDelProg as $f):`. |
| `250` | `        $stmtEF = $db->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmtEF = $db->prepare(`. |
| `251` | `            "SELECT COUNT(*) FROM evidencias e` | Instrucción de ejecución en el contexto del script: `"SELECT COUNT(*) FROM evidencias e`. |
| `252` | `             JOIN grupos g ON g.id_grupo = e.id_grupo` | Instrucción de ejecución en el contexto del script: `JOIN grupos g ON g.id_grupo = e.id_grupo`. |
| `253` | `             JOIN asignaciones a ON a.id_asignacion = g.id_asignacion` | Instrucción de ejecución en el contexto del script: `JOIN asignaciones a ON a.id_asignacion = g.id_asignacion`. |
| `254` | `             WHERE a.id_ficha = :fic"` | Instrucción de ejecución en el contexto del script: `WHERE a.id_ficha = :fic"`. |
| `255` | `        );` | Instrucción de ejecución en el contexto del script: `);`. |
| `256` | `        $stmtEF->execute([':fic' => $f['id_ficha']]);` | Ejecuta la sentencia SQL preparada vinculando los datos correspondientes: `$stmtEF->execute([':fic' => $f['id_ficha']]);`. |
| `257` | `        $cntEvFicha = (int)$stmtEF->fetchColumn();` | Obtiene el valor de una columna única de la primera fila resultante. |
| `258` | `    ?>` | Cierre de la etiqueta PHP para alternar a salida HTML o fin del archivo. |
| `259` | `    <div class="col-md-6 col-lg-4">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="col-md-6 col-lg-4">`. |
| `260` | `        <a href="admin_evidencias.php?ficha=<?= $f['id_ficha'] ?>" class="t...` | Enlace hipertexto de navegación o acción: `<a href="admin_evidencias.php?ficha=<?= $f['id_ficha'] ?>" class="text-decoration-none">`. |
| `261` | `            <div class="card border-0 shadow-sm h-100 prog-card" style="bor...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="card border-0 shadow-sm h-100 prog-card" style="border-radius:12px;">`. |
| `262` | `                <div class="card-body p-4">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="card-body p-4">`. |
| `263` | `                    <div class="d-flex align-items-start justify-content-be...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="d-flex align-items-start justify-content-between mb-3">`. |
| `264` | `                        <div style="width:44px;height:44px;border-radius:10px;` | Contenedor visual estructurado con Bootstrap/CSS: `<div style="width:44px;height:44px;border-radius:10px;`. |
| `265` | `                                    background:rgba(37,99,235,.1);color:#25...` | Instrucción de ejecución en el contexto del script: `background:rgba(37,99,235,.1);color:#2563eb;`. |
| `266` | `                                    display:flex;align-items:center;justify...` | Instrucción de ejecución en el contexto del script: `display:flex;align-items:center;justify-content:center;font-size:1.1rem;">`. |
| `267` | `                            <i class="fas fa-id-card"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-id-card"></i>`. |
| `268` | `                        </div>` | Cierre de contenedor visual `<div>`. |
| `269` | `                        <span class="badge bg-light text-dark border"><?= h...` | Instrucción de ejecución en el contexto del script: `<span class="badge bg-light text-dark border"><?= htmlspecialchars($f['jornada']) ?></span>`. |
| `270` | `                    </div>` | Cierre de contenedor visual `<div>`. |
| `271` | `                    <div class="fw-bold text-success font-monospace mb-1" s...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="fw-bold text-success font-monospace mb-1" style="font-size:1.3rem;">`. |
| `272` | `                        <?= htmlspecialchars($f['numero_ficha']) ?>` | Instrucción de ejecución en el contexto del script: `<?= htmlspecialchars($f['numero_ficha']) ?>`. |
| `273` | `                    </div>` | Cierre de contenedor visual `<div>`. |
| `274` | `                    <div class="text-muted small mb-3">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="text-muted small mb-3">`. |
| `275` | `                        <?php if ($f['vocero_nombres']): ?>` | Instrucción de ejecución en el contexto del script: `<?php if ($f['vocero_nombres']): ?>`. |
| `276` | `                            <i class="fas fa-user-tie text-success me-1" st...` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-user-tie text-success me-1" style="font-size:.75rem;"></i>`. |
| `277` | `                            <?= htmlspecialchars($f['vocero_nombres'] . ' '...` | Instrucción de ejecución en el contexto del script: `<?= htmlspecialchars($f['vocero_nombres'] . ' ' . $f['vocero_apellidos']) ?>`. |
| `278` | `                        <?php else: ?>` | Instrucción de ejecución en el contexto del script: `<?php else: ?>`. |
| `279` | `                            <span class="text-warning"><i class="fas fa-exc...` | Instrucción de ejecución en el contexto del script: `<span class="text-warning"><i class="fas fa-exclamation-circle me-1"></i>Sin vocero</span>`. |
| `280` | `                        <?php endif; ?>` | Instrucción de ejecución en el contexto del script: `<?php endif; ?>`. |
| `281` | `                    </div>` | Cierre de contenedor visual `<div>`. |
| `282` | `                    <div class="d-flex gap-3 pt-3" style="border-top:1px so...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="d-flex gap-3 pt-3" style="border-top:1px solid #e5e7eb;">`. |
| `283` | `                        <div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div>`. |
| `284` | `                            <div class="fw-bold text-warning fs-5"><?= $cnt...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="fw-bold text-warning fs-5"><?= $cntEvFicha ?></div>`. |
| `285` | `                            <div class="text-muted" style="font-size:.72rem...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="text-muted" style="font-size:.72rem;">Evidencias</div>`. |
| `286` | `                        </div>` | Cierre de contenedor visual `<div>`. |
| `287` | `                        <div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div>`. |
| `288` | `                            <div class="fw-bold text-muted" style="font-siz...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="fw-bold text-muted" style="font-size:1rem;"><?= (int)$f['total_aprendices'] ?></div>`. |
| `289` | `                            <div class="text-muted" style="font-size:.72rem...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="text-muted" style="font-size:.72rem;">Aprendices</div>`. |
| `290` | `                        </div>` | Cierre de contenedor visual `<div>`. |
| `291` | `                        <div class="ms-auto d-flex align-items-center text-...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="ms-auto d-flex align-items-center text-success" style="font-size:.82rem;">`. |
| `292` | `                            Ver evidencias <i class="fas fa-arrow-right ms-...` | Instrucción de ejecución en el contexto del script: `Ver evidencias <i class="fas fa-arrow-right ms-1"></i>`. |
| `293` | `                        </div>` | Cierre de contenedor visual `<div>`. |
| `294` | `                    </div>` | Cierre de contenedor visual `<div>`. |
| `295` | `                </div>` | Cierre de contenedor visual `<div>`. |
| `296` | `            </div>` | Cierre de contenedor visual `<div>`. |
| `297` | `        </a>` | Instrucción de ejecución en el contexto del script: `</a>`. |
| `298` | `    </div>` | Cierre de contenedor visual `<div>`. |
| `299` | `    <?php endforeach; ?>` | Instrucción de ejecución en el contexto del script: `<?php endforeach; ?>`. |
| `300` | `    <?php if (empty($fichasDelProg)): ?>` | Instrucción de ejecución en el contexto del script: `<?php if (empty($fichasDelProg)): ?>`. |
| `301` | `    <div class="col-12 text-center py-5 text-muted">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="col-12 text-center py-5 text-muted">`. |
| `302` | `        <i class="fas fa-id-card fa-3x mb-3 opacity-25 d-block"></i>No hay ...` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-id-card fa-3x mb-3 opacity-25 d-block"></i>No hay fichas en este programa.`. |
| `303` | `    </div>` | Cierre de contenedor visual `<div>`. |
| `304` | `    <?php endif; ?>` | Instrucción de ejecución en el contexto del script: `<?php endif; ?>`. |
| `305` | `</div>` | Cierre de contenedor visual `<div>`. |
| `306` | `<?php endif; ?>` | Instrucción de ejecución en el contexto del script: `<?php endif; ?>`. |
| `307` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `308` | `<!-- ══ NIVEL 2: HISTORIAL DE EVIDENCIAS DE LA FICHA ══════════════════════...` | Instrucción de ejecución en el contexto del script: `<!-- ══ NIVEL 2: HISTORIAL DE EVIDENCIAS DE LA FICHA ═════════════════════════ -->`. |
| `309` | `<?php if ($vistaFicha && $fichaAct): ?>` | Instrucción de ejecución en el contexto del script: `<?php if ($vistaFicha && $fichaAct): ?>`. |
| `310` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `311` | `<?php` | Apertura obligatoria de la etiqueta PHP para ejecución del código del lado del servidor. |
| `312` | `$stmtGC = $db->prepare("SELECT COUNT(*) FROM grupos g JOIN asignaciones a O...` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmtGC = $db->prepare("SELECT COUNT(*) FROM grupos g JOIN asignaciones a ON a.id_asignacion=g.id_asignacion WHERE a.id_ficha=:fic");`. |
| `313` | `$stmtGC->execute([':fic' => $vistaFicha]);` | Ejecuta la sentencia SQL preparada vinculando los datos correspondientes: `$stmtGC->execute([':fic' => $vistaFicha]);`. |
| `314` | `$cntGrupos = (int)$stmtGC->fetchColumn();` | Obtiene el valor de una columna única de la primera fila resultante. |
| `315` | `$voceroNombre = trim(($fichaAct['vocero_nombres'] ?? '') . ' ' . ($fichaAct...` | Instrucción de ejecución en el contexto del script: `$voceroNombre = trim(($fichaAct['vocero_nombres'] ?? '') . ' ' . ($fichaAct['vocero_apellidos'] ?? ''));`. |
| `316` | `?>` | Cierre de la etiqueta PHP para alternar a salida HTML o fin del archivo. |
| `317` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `318` | `<div class="row g-3 mb-4">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="row g-3 mb-4">`. |
| `319` | `    <div class="col-sm-4">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="col-sm-4">`. |
| `320` | `        <div class="stat-card bg-white">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="stat-card bg-white">`. |
| `321` | `            <div class="d-flex align-items-center gap-3">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="d-flex align-items-center gap-3">`. |
| `322` | `                <div class="stat-icon" style="background:rgba(57,169,0,.12)...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="stat-icon" style="background:rgba(57,169,0,.12);color:#39a900;"><i class="fas fa-images"></i></div>`. |
| `323` | `                <div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div>`. |
| `324` | `                    <div class="fs-4 fw-bold"><?= count($evidencias) ?></div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="fs-4 fw-bold"><?= count($evidencias) ?></div>`. |
| `325` | `                    <div class="text-muted small">Evidencias registradas</div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="text-muted small">Evidencias registradas</div>`. |
| `326` | `                </div>` | Cierre de contenedor visual `<div>`. |
| `327` | `            </div>` | Cierre de contenedor visual `<div>`. |
| `328` | `        </div>` | Cierre de contenedor visual `<div>`. |
| `329` | `    </div>` | Cierre de contenedor visual `<div>`. |
| `330` | `    <div class="col-sm-4">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="col-sm-4">`. |
| `331` | `        <div class="stat-card bg-white">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="stat-card bg-white">`. |
| `332` | `            <div class="d-flex align-items-center gap-3">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="d-flex align-items-center gap-3">`. |
| `333` | `                <div class="stat-icon" style="background:rgba(37,99,235,.1)...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="stat-icon" style="background:rgba(37,99,235,.1);color:#2563eb;"><i class="fas fa-people-group"></i></div>`. |
| `334` | `                <div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div>`. |
| `335` | `                    <div class="fs-4 fw-bold"><?= $cntGrupos ?></div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="fs-4 fw-bold"><?= $cntGrupos ?></div>`. |
| `336` | `                    <div class="text-muted small">Grupos de limpieza</div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="text-muted small">Grupos de limpieza</div>`. |
| `337` | `                </div>` | Cierre de contenedor visual `<div>`. |
| `338` | `            </div>` | Cierre de contenedor visual `<div>`. |
| `339` | `        </div>` | Cierre de contenedor visual `<div>`. |
| `340` | `    </div>` | Cierre de contenedor visual `<div>`. |
| `341` | `    <div class="col-sm-4">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="col-sm-4">`. |
| `342` | `        <div class="stat-card bg-white">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="stat-card bg-white">`. |
| `343` | `            <div class="d-flex align-items-center gap-3">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="d-flex align-items-center gap-3">`. |
| `344` | `                <div class="stat-icon" style="background:rgba(234,179,8,.1)...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="stat-icon" style="background:rgba(234,179,8,.1);color:#d97706;"><i class="fas fa-user-tie"></i></div>`. |
| `345` | `                <div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div>`. |
| `346` | `                    <div class="fw-bold" style="font-size:.9rem;"><?= $voce...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="fw-bold" style="font-size:.9rem;"><?= $voceroNombre ?: '—' ?></div>`. |
| `347` | `                    <div class="text-muted small">Vocero asignado</div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="text-muted small">Vocero asignado</div>`. |
| `348` | `                </div>` | Cierre de contenedor visual `<div>`. |
| `349` | `            </div>` | Cierre de contenedor visual `<div>`. |
| `350` | `        </div>` | Cierre de contenedor visual `<div>`. |
| `351` | `    </div>` | Cierre de contenedor visual `<div>`. |
| `352` | `</div>` | Cierre de contenedor visual `<div>`. |
| `353` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `354` | `<div class="card shadow-sm border-0">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="card shadow-sm border-0">`. |
| `355` | `    <div class="card-header bg-white border-0 py-3 d-flex justify-content-b...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="card-header bg-white border-0 py-3 d-flex justify-content-between align-items-center flex-wrap gap-2">`. |
| `356` | `        <h6 class="fw-bold mb-0">` | Instrucción de ejecución en el contexto del script: `<h6 class="fw-bold mb-0">`. |
| `357` | `            <i class="fas fa-images text-success me-2"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-images text-success me-2"></i>`. |
| `358` | `            Historial de Evidencias — <span class="font-monospace text-succ...` | Instrucción de ejecución en el contexto del script: `Historial de Evidencias — <span class="font-monospace text-success"><?= htmlspecialchars($fichaAct['numero_ficha']) ?></span>`. |
| `359` | `            <span class="text-muted fw-normal small ms-2">— <?= htmlspecial...` | Instrucción de ejecución en el contexto del script: `<span class="text-muted fw-normal small ms-2">— <?= htmlspecialchars($fichaAct['nombre_programa']) ?></span>`. |
| `360` | `        </h6>` | Instrucción de ejecución en el contexto del script: `</h6>`. |
| `361` | `        <div class="d-flex gap-2 align-items-center">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="d-flex gap-2 align-items-center">`. |
| `362` | `            <span class="badge bg-success"><?= count($evidencias) ?> eviden...` | Instrucción de ejecución en el contexto del script: `<span class="badge bg-success"><?= count($evidencias) ?> evidencia(s)</span>`. |
| `363` | `            <div class="input-group input-group-sm" style="max-width:220px;">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="input-group input-group-sm" style="max-width:220px;">`. |
| `364` | `                <span class="input-group-text bg-white"><i class="fas fa-se...` | Instrucción de ejecución en el contexto del script: `<span class="input-group-text bg-white"><i class="fas fa-search text-muted"></i></span>`. |
| `365` | `                <input type="text" id="buscEv" class="form-control border-s...` | Campo de entrada interactivo para datos del usuario: `<input type="text" id="buscEv" class="form-control border-start-0" placeholder="Buscar…">`. |
| `366` | `            </div>` | Cierre de contenedor visual `<div>`. |
| `367` | `        </div>` | Cierre de contenedor visual `<div>`. |
| `368` | `    </div>` | Cierre de contenedor visual `<div>`. |
| `369` | `    <div class="card-body p-0">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="card-body p-0">`. |
| `370` | `        <?php if (empty($evidencias)): ?>` | Instrucción de ejecución en el contexto del script: `<?php if (empty($evidencias)): ?>`. |
| `371` | `        <div class="text-center py-5 text-muted">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="text-center py-5 text-muted">`. |
| `372` | `            <i class="fas fa-images fa-3x mb-3 opacity-25 d-block"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-images fa-3x mb-3 opacity-25 d-block"></i>`. |
| `373` | `            <p class="small mb-0">No hay evidencias registradas para esta f...` | Instrucción de ejecución en el contexto del script: `<p class="small mb-0">No hay evidencias registradas para esta ficha aún.</p>`. |
| `374` | `        </div>` | Cierre de contenedor visual `<div>`. |
| `375` | `        <?php else: ?>` | Instrucción de ejecución en el contexto del script: `<?php else: ?>`. |
| `376` | `        <div class="table-responsive">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="table-responsive">`. |
| `377` | `            <table class="table tabla-limpia align-middle mb-0" id="tblEv">` | Tabla de datos para despliegue estructurado de información: `<table class="table tabla-limpia align-middle mb-0" id="tblEv">`. |
| `378` | `                <thead class="table-light">` | Celda de tabla con contenido de datos o encabezado de columna: `<thead class="table-light">`. |
| `379` | `                    <tr>` | Fila contenedora de datos dentro de la tabla. |
| `380` | `                        <th>Foto</th>` | Celda de tabla con contenido de datos o encabezado de columna: `<th>Foto</th>`. |
| `381` | `                        <th>Vocero</th>` | Celda de tabla con contenido de datos o encabezado de columna: `<th>Vocero</th>`. |
| `382` | `                        <th>Grupo</th>` | Celda de tabla con contenido de datos o encabezado de columna: `<th>Grupo</th>`. |
| `383` | `                        <th>Módulo</th>` | Celda de tabla con contenido de datos o encabezado de columna: `<th>Módulo</th>`. |
| `384` | `                        <th>Fecha Limpieza</th>` | Celda de tabla con contenido de datos o encabezado de columna: `<th>Fecha Limpieza</th>`. |
| `385` | `                        <th>Fecha Subida</th>` | Celda de tabla con contenido de datos o encabezado de columna: `<th>Fecha Subida</th>`. |
| `386` | `                        <th class="text-center">Ver</th>` | Celda de tabla con contenido de datos o encabezado de columna: `<th class="text-center">Ver</th>`. |
| `387` | `                    </tr>` | Fila contenedora de datos dentro de la tabla. |
| `388` | `                </thead>` | Instrucción de ejecución en el contexto del script: `</thead>`. |
| `389` | `                <tbody>` | Instrucción de ejecución en el contexto del script: `<tbody>`. |
| `390` | `                <?php foreach ($evidencias as $e):` | Instrucción de ejecución en el contexto del script: `<?php foreach ($evidencias as $e):`. |
| `391` | `                    $dataEv = json_encode([` | Instrucción de ejecución en el contexto del script: `$dataEv = json_encode([`. |
| `392` | `                        'ruta'     => $e['ruta_archivo'],` | Instrucción de ejecución en el contexto del script: `'ruta'     => $e['ruta_archivo'],`. |
| `393` | `                        'vocero'   => ($e['vocero_nombres'] ?? '') . ' ' . ...` | Instrucción de ejecución en el contexto del script: `'vocero'   => ($e['vocero_nombres'] ?? '') . ' ' . ($e['vocero_apellidos'] ?? ''),`. |
| `394` | `                        'modulo'   => $e['nombre_modulo'] ?? '—',` | Instrucción de ejecución en el contexto del script: `'modulo'   => $e['nombre_modulo'] ?? '—',`. |
| `395` | `                        'grupo'    => $e['nombre_grupo']  ?? '—',` | Instrucción de ejecución en el contexto del script: `'grupo'    => $e['nombre_grupo']  ?? '—',`. |
| `396` | `                        'ficha'    => $e['numero_ficha']  ?? '—',` | Instrucción de ejecución en el contexto del script: `'ficha'    => $e['numero_ficha']  ?? '—',`. |
| `397` | `                        'limpieza' => date('d/m/Y', strtotime($e['fecha_lim...` | Instrucción de ejecución en el contexto del script: `'limpieza' => date('d/m/Y', strtotime($e['fecha_limpieza'])),`. |
| `398` | `                        'subida'   => date('d/m/Y H:i',  strtotime($e['fech...` | Instrucción de ejecución en el contexto del script: `'subida'   => date('d/m/Y H:i',  strtotime($e['fecha_subida'])),`. |
| `399` | `                    ], JSON_HEX_QUOT \| JSON_HEX_APOS);` | Instrucción de ejecución en el contexto del script: `], JSON_HEX_QUOT \| JSON_HEX_APOS);`. |
| `400` | `                ?>` | Cierre de la etiqueta PHP para alternar a salida HTML o fin del archivo. |
| `401` | `                <tr>` | Fila contenedora de datos dentro de la tabla. |
| `402` | `                    <td>` | Celda de tabla con contenido de datos o encabezado de columna: `<td>`. |
| `403` | `                        <img src="../../public/<?= htmlspecialchars($e['rut...` | Instrucción de ejecución en el contexto del script: `<img src="../../public/<?= htmlspecialchars($e['ruta_archivo']) ?>"`. |
| `404` | `                             alt="Evidencia"` | Instrucción de ejecución en el contexto del script: `alt="Evidencia"`. |
| `405` | `                             style="width:52px;height:52px;object-fit:cover...` | Instrucción de ejecución en el contexto del script: `style="width:52px;height:52px;object-fit:cover;border-radius:8px;`. |
| `406` | `                                    border:1px solid #e5e7eb;cursor:pointer;"` | Instrucción de ejecución en el contexto del script: `border:1px solid #e5e7eb;cursor:pointer;"`. |
| `407` | `                             data-ev="<?= htmlspecialchars($dataEv, ENT_QUO...` | Instrucción de ejecución en el contexto del script: `data-ev="<?= htmlspecialchars($dataEv, ENT_QUOTES) ?>"`. |
| `408` | `                             onclick="verDetalle(this)" title="Ampliar">` | Instrucción de ejecución en el contexto del script: `onclick="verDetalle(this)" title="Ampliar">`. |
| `409` | `                    </td>` | Celda de tabla con contenido de datos o encabezado de columna: `</td>`. |
| `410` | `                    <td class="small fw-semibold">` | Celda de tabla con contenido de datos o encabezado de columna: `<td class="small fw-semibold">`. |
| `411` | `                        <?= htmlspecialchars(($e['vocero_nombres'] ?? '') ....` | Instrucción de ejecución en el contexto del script: `<?= htmlspecialchars(($e['vocero_nombres'] ?? '') . ' ' . ($e['vocero_apellidos'] ?? '')) ?>`. |
| `412` | `                    </td>` | Celda de tabla con contenido de datos o encabezado de columna: `</td>`. |
| `413` | `                    <td class="small text-muted"><?= htmlspecialchars($e['n...` | Celda de tabla con contenido de datos o encabezado de columna: `<td class="small text-muted"><?= htmlspecialchars($e['nombre_grupo'] ?? '—') ?></td>`. |
| `414` | `                    <td class="small"><?= htmlspecialchars($e['nombre_modul...` | Celda de tabla con contenido de datos o encabezado de columna: `<td class="small"><?= htmlspecialchars($e['nombre_modulo'] ?? '—') ?></td>`. |
| `415` | `                    <td class="small"><?= date('d/m/Y', strtotime($e['fecha...` | Celda de tabla con contenido de datos o encabezado de columna: `<td class="small"><?= date('d/m/Y', strtotime($e['fecha_limpieza'])) ?></td>`. |
| `416` | `                    <td class="small text-muted"><?= date('d/m/Y H:i', strt...` | Celda de tabla con contenido de datos o encabezado de columna: `<td class="small text-muted"><?= date('d/m/Y H:i', strtotime($e['fecha_subida'])) ?></td>`. |
| `417` | `                    <td class="text-center">` | Celda de tabla con contenido de datos o encabezado de columna: `<td class="text-center">`. |
| `418` | `                        <button class="btn btn-sm btn-outline-success"` | Botón de acción interactivo para el usuario: `<button class="btn btn-sm btn-outline-success"`. |
| `419` | `                                data-ev="<?= htmlspecialchars($dataEv, ENT_...` | Instrucción de ejecución en el contexto del script: `data-ev="<?= htmlspecialchars($dataEv, ENT_QUOTES) ?>"`. |
| `420` | `                                onclick="verDetalle(this)" title="Ver detal...` | Instrucción de ejecución en el contexto del script: `onclick="verDetalle(this)" title="Ver detalle">`. |
| `421` | `                            <i class="fas fa-eye"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-eye"></i>`. |
| `422` | `                        </button>` | Botón de acción interactivo para el usuario: `</button>`. |
| `423` | `                    </td>` | Celda de tabla con contenido de datos o encabezado de columna: `</td>`. |
| `424` | `                </tr>` | Fila contenedora de datos dentro de la tabla. |
| `425` | `                <?php endforeach; ?>` | Instrucción de ejecución en el contexto del script: `<?php endforeach; ?>`. |
| `426` | `                </tbody>` | Instrucción de ejecución en el contexto del script: `</tbody>`. |
| `427` | `            </table>` | Tabla de datos para despliegue estructurado de información: `</table>`. |
| `428` | `        </div>` | Cierre de contenedor visual `<div>`. |
| `429` | `        <?php endif; ?>` | Instrucción de ejecución en el contexto del script: `<?php endif; ?>`. |
| `430` | `    </div>` | Cierre de contenedor visual `<div>`. |
| `431` | `</div>` | Cierre de contenedor visual `<div>`. |
| `432` | `<?php endif; ?>` | Instrucción de ejecución en el contexto del script: `<?php endif; ?>`. |
| `433` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `434` | `<!-- ══ MODAL DETALLE ═════════════════════════════════════════════════════...` | Instrucción de ejecución en el contexto del script: `<!-- ══ MODAL DETALLE ═════════════════════════════════════════════════════════ -->`. |
| `435` | `<div class="modal fade" id="modalDetalle" tabindex="-1" aria-hidden="true">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="modal fade" id="modalDetalle" tabindex="-1" aria-hidden="true">`. |
| `436` | `    <div class="modal-dialog modal-dialog-centered modal-lg">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="modal-dialog modal-dialog-centered modal-lg">`. |
| `437` | `        <div class="modal-content border-0 shadow">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="modal-content border-0 shadow">`. |
| `438` | `            <div class="modal-header border-0" style="background:#0f2200;co...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="modal-header border-0" style="background:#0f2200;color:#fff;">`. |
| `439` | `                <h6 class="modal-title fw-bold mb-0">` | Instrucción de ejecución en el contexto del script: `<h6 class="modal-title fw-bold mb-0">`. |
| `440` | `                    <i class="fas fa-images me-2 text-success"></i>Detalle ...` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-images me-2 text-success"></i>Detalle de Evidencia`. |
| `441` | `                </h6>` | Instrucción de ejecución en el contexto del script: `</h6>`. |
| `442` | `                <button type="button" class="btn-close btn-close-white" dat...` | Botón de acción interactivo para el usuario: `<button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>`. |
| `443` | `            </div>` | Cierre de contenedor visual `<div>`. |
| `444` | `            <div class="modal-body p-0">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="modal-body p-0">`. |
| `445` | `                <div class="row g-0">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="row g-0">`. |
| `446` | `                    <div class="col-md-7 bg-dark d-flex align-items-center ...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="col-md-7 bg-dark d-flex align-items-center justify-content-center"`. |
| `447` | `                         style="min-height:320px;">` | Instrucción de ejecución en el contexto del script: `style="min-height:320px;">`. |
| `448` | `                        <img id="detalleImg" src="" alt="Evidencia"` | Instrucción de ejecución en el contexto del script: `<img id="detalleImg" src="" alt="Evidencia"`. |
| `449` | `                             style="max-width:100%;max-height:420px;object-...` | Instrucción de ejecución en el contexto del script: `style="max-width:100%;max-height:420px;object-fit:contain;padding:1rem;">`. |
| `450` | `                    </div>` | Cierre de contenedor visual `<div>`. |
| `451` | `                    <div class="col-md-5 p-4">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="col-md-5 p-4">`. |
| `452` | `                        <h6 class="fw-bold mb-3">Información</h6>` | Instrucción de ejecución en el contexto del script: `<h6 class="fw-bold mb-3">Información</h6>`. |
| `453` | `                        <?php foreach (['detalleVocero'=>'Vocero','detalleG...` | Instrucción de ejecución en el contexto del script: `<?php foreach (['detalleVocero'=>'Vocero','detalleGrupo'=>'Grupo','detalleModulo'=>'Módulo','detalleFicha'=>'Ficha','detalleLimpieza'=>'Fecha Limpieza','detalleSubida'=>'Fecha Subida'] as $id => $label): ?>`. |
| `454` | `                        <div class="mb-3">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="mb-3">`. |
| `455` | `                            <div class="text-muted" style="font-size:.72rem...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="text-muted" style="font-size:.72rem;text-transform:uppercase;letter-spacing:.5px;"><?= $label ?></div>`. |
| `456` | `                            <div class="fw-semibold small <?= $id==='detall...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="fw-semibold small <?= $id==='detalleFicha' ? 'font-monospace text-success' : '' ?>" id="<?= $id ?>">—</div>`. |
| `457` | `                        </div>` | Cierre de contenedor visual `<div>`. |
| `458` | `                        <?php endforeach; ?>` | Instrucción de ejecución en el contexto del script: `<?php endforeach; ?>`. |
| `459` | `                        <div class="mt-3 pt-3" style="border-top:1px solid ...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="mt-3 pt-3" style="border-top:1px solid #e5e7eb;">`. |
| `460` | `                            <span class="badge bg-success px-3 py-2">` | Instrucción de ejecución en el contexto del script: `<span class="badge bg-success px-3 py-2">`. |
| `461` | `                                <i class="fas fa-check me-1"></i>Evidencia ...` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-check me-1"></i>Evidencia verificada`. |
| `462` | `                            </span>` | Instrucción de ejecución en el contexto del script: `</span>`. |
| `463` | `                        </div>` | Cierre de contenedor visual `<div>`. |
| `464` | `                    </div>` | Cierre de contenedor visual `<div>`. |
| `465` | `                </div>` | Cierre de contenedor visual `<div>`. |
| `466` | `            </div>` | Cierre de contenedor visual `<div>`. |
| `467` | `        </div>` | Cierre de contenedor visual `<div>`. |
| `468` | `    </div>` | Cierre de contenedor visual `<div>`. |
| `469` | `</div>` | Cierre de contenedor visual `<div>`. |
| `470` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `471` | `<style>` | Instrucción de ejecución en el contexto del script: `<style>`. |
| `472` | `.prog-card { transition: transform .2s, box-shadow .2s; cursor: pointer; }` | Instrucción de ejecución en el contexto del script: `.prog-card { transition: transform .2s, box-shadow .2s; cursor: pointer; }`. |
| `473` | `.prog-card:hover { transform: translateY(-3px); box-shadow: 0 8px 24px rgba...` | Instrucción de ejecución en el contexto del script: `.prog-card:hover { transform: translateY(-3px); box-shadow: 0 8px 24px rgba(0,0,0,.1) !important; }`. |
| `474` | `.breadcrumb-item + .breadcrumb-item::before { color: #9ca3af; }` | Instrucción de ejecución en el contexto del script: `.breadcrumb-item + .breadcrumb-item::before { color: #9ca3af; }`. |
| `475` | `</style>` | Instrucción de ejecución en el contexto del script: `</style>`. |
| `476` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `477` | `<script>` | Bloque o etiqueta de vinculación para scripts JavaScript del lado del cliente. |
| `478` | `// Buscador programas` | Comentario de línea explicativo: `Buscador programas`. |
| `479` | `const buscProg = document.getElementById('buscPrograma');` | Instrucción de ejecución en el contexto del script: `const buscProg = document.getElementById('buscPrograma');`. |
| `480` | `if (buscProg) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (buscProg) {`. |
| `481` | `    buscProg.addEventListener('input', function () {` | Declaración de método o función con su firma y parámetros: `buscProg.addEventListener('input', function () {`. |
| `482` | `        const q = this.value.toLowerCase();` | Instrucción de ejecución en el contexto del script: `const q = this.value.toLowerCase();`. |
| `483` | `        document.querySelectorAll('.prog-item').forEach(el => {` | Instrucción de ejecución en el contexto del script: `document.querySelectorAll('.prog-item').forEach(el => {`. |
| `484` | `            el.style.display = !q \|\| el.textContent.toLowerCase().include...` | Instrucción de ejecución en el contexto del script: `el.style.display = !q \|\| el.textContent.toLowerCase().includes(q) ? '' : 'none';`. |
| `485` | `        });` | Instrucción de ejecución en el contexto del script: `});`. |
| `486` | `    });` | Instrucción de ejecución en el contexto del script: `});`. |
| `487` | `}` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `488` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `489` | `// Buscador evidencias` | Comentario de línea explicativo: `Buscador evidencias`. |
| `490` | `const buscEv = document.getElementById('buscEv');` | Instrucción de ejecución en el contexto del script: `const buscEv = document.getElementById('buscEv');`. |
| `491` | `if (buscEv) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (buscEv) {`. |
| `492` | `    buscEv.addEventListener('input', function () {` | Declaración de método o función con su firma y parámetros: `buscEv.addEventListener('input', function () {`. |
| `493` | `        const q = this.value.toLowerCase();` | Instrucción de ejecución en el contexto del script: `const q = this.value.toLowerCase();`. |
| `494` | `        document.querySelectorAll('#tblEv tbody tr').forEach(tr => {` | Instrucción de ejecución en el contexto del script: `document.querySelectorAll('#tblEv tbody tr').forEach(tr => {`. |
| `495` | `            tr.style.display = !q \|\| tr.textContent.toLowerCase().include...` | Instrucción de ejecución en el contexto del script: `tr.style.display = !q \|\| tr.textContent.toLowerCase().includes(q) ? '' : 'none';`. |
| `496` | `        });` | Instrucción de ejecución en el contexto del script: `});`. |
| `497` | `    });` | Instrucción de ejecución en el contexto del script: `});`. |
| `498` | `}` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `499` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `500` | `// Modal detalle` | Comentario de línea explicativo: `Modal detalle`. |
| `501` | `function verDetalle(el) {` | Declaración de método o función con su firma y parámetros: `function verDetalle(el) {`. |
| `502` | `    const data = JSON.parse(el.dataset.ev);` | Instrucción de ejecución en el contexto del script: `const data = JSON.parse(el.dataset.ev);`. |
| `503` | `    const base = window.location.origin` | Instrucción de ejecución en el contexto del script: `const base = window.location.origin`. |
| `504` | `               + window.location.pathname.replace(/\/views\/dashboard\/.*$/...` | Instrucción de ejecución en el contexto del script: `+ window.location.pathname.replace(/\/views\/dashboard\/.*$/, '/public/');`. |
| `505` | `    document.getElementById('detalleImg').src              = base + data.ruta;` | Instrucción de ejecución en el contexto del script: `document.getElementById('detalleImg').src              = base + data.ruta;`. |
| `506` | `    document.getElementById('detalleVocero').textContent   = data.vocero   ...` | Instrucción de ejecución en el contexto del script: `document.getElementById('detalleVocero').textContent   = data.vocero   \|\| '—';`. |
| `507` | `    document.getElementById('detalleGrupo').textContent    = data.grupo    ...` | Instrucción de ejecución en el contexto del script: `document.getElementById('detalleGrupo').textContent    = data.grupo    \|\| '—';`. |
| `508` | `    document.getElementById('detalleModulo').textContent   = data.modulo   ...` | Instrucción de ejecución en el contexto del script: `document.getElementById('detalleModulo').textContent   = data.modulo   \|\| '—';`. |
| `509` | `    document.getElementById('detalleFicha').textContent    = data.ficha    ...` | Instrucción de ejecución en el contexto del script: `document.getElementById('detalleFicha').textContent    = data.ficha    \|\| '—';`. |
| `510` | `    document.getElementById('detalleLimpieza').textContent = data.limpieza ...` | Instrucción de ejecución en el contexto del script: `document.getElementById('detalleLimpieza').textContent = data.limpieza \|\| '—';`. |
| `511` | `    document.getElementById('detalleSubida').textContent   = data.subida   ...` | Instrucción de ejecución en el contexto del script: `document.getElementById('detalleSubida').textContent   = data.subida   \|\| '—';`. |
| `512` | `    new bootstrap.Modal(document.getElementById('modalDetalle')).show();` | Instrucción de ejecución en el contexto del script: `new bootstrap.Modal(document.getElementById('modalDetalle')).show();`. |
| `513` | `}` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `514` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `515` | `<?php if ($alert): ?>` | Instrucción de ejecución en el contexto del script: `<?php if ($alert): ?>`. |
| `516` | `document.addEventListener('DOMContentLoaded', function () {` | Declaración de método o función con su firma y parámetros: `document.addEventListener('DOMContentLoaded', function () {`. |
| `517` | `    Swal.fire({ icon:'<?= addslashes($alert['icon']) ?>', title:'<?= addsla...` | Instrucción de ejecución en el contexto del script: `Swal.fire({ icon:'<?= addslashes($alert['icon']) ?>', title:'<?= addslashes($alert['title']) ?>', text:'<?= addslashes($alert['text']) ?>', confirmButtonColor:'#39a900' });`. |
| `518` | `});` | Instrucción de ejecución en el contexto del script: `});`. |
| `519` | `<?php endif; ?>` | Instrucción de ejecución en el contexto del script: `<?php endif; ?>`. |
| `520` | `</script>` | Bloque o etiqueta de vinculación para scripts JavaScript del lado del cliente. |
| `521` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `522` | `<?php require_once __DIR__ . '/../layouts/footer.php'; ?>` | Instrucción de ejecución en el contexto del script: `<?php require_once __DIR__ . '/../layouts/footer.php'; ?>`. |

---

## 3. Resumen y Flujo de Interacción

El archivo `admin_evidencias.php` cumple un rol indispensable en `views/dashboard/admin_evidencias.php`. 
Módulo administrativo para revisar, filtrar y auditar las evidencias fotográficas subidas por los voceros de cada módulo. Garantiza la robustez, el orden y la estabilidad de la arquitectura del proyecto `systemLimpieza`.
