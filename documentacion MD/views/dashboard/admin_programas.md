# Documentación Línea por Línea: `views/dashboard/admin_programas.php`

## 1. Ficha Técnica del Archivo

- **Archivo:** `admin_programas.php`
- **Ruta en el proyecto:** `views/dashboard/admin_programas.php`
- **Cantidad total de líneas:** `563`
- **Tipo de archivo:** `PHP`
- **Propósito general:** Módulo administrativo para el mantenimiento CRUD de los programas académicos del SENA.

---

## 2. Explicación Detallada Línea por Línea

A continuación se presenta cada línea de código numerada de forma consecutiva, acompañada de su fragmento exacto y la explicación exhaustiva de su funcionamiento y responsabilidad en el sistema:

| Línea | Código Fuente | Explicación Detallada |
|---|---|---|
| `1` | `<?php` | Apertura obligatoria de la etiqueta PHP para ejecución del código del lado del servidor. |
| `2` | `$titulo = 'Programas y Fichas';` | Instrucción de ejecución en el contexto del script: `$titulo = 'Programas y Fichas';`. |
| `3` | `if (session_status() === PHP_SESSION_NONE) session_start();` | Inicia o reanuda la sesión PHP del usuario si no se encontraba activa previamente. |
| `4` | `if (!isset($_SESSION['usuario']) \|\| (int)$_SESSION['usuario']['rol'] !== ...` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (!isset($_SESSION['usuario']) \|\| (int)$_SESSION['usuario']['rol'] !== 1) {`. |
| `5` | `    header("Location: ../usuarios/login.php"); exit;` | Emite cabecera HTTP de redirección en el navegador: `header("Location: ../usuarios/login.php"); exit;`. |
| `6` | `}` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `7` | `require_once __DIR__ . '/../../config/database.php';` | Importación e inclusión obligatoria del archivo de dependencia requerido: `require_once __DIR__ . '/../../config/database.php';`. |
| `8` | `require_once __DIR__ . '/../../models/Programa.php';` | Importación e inclusión obligatoria del archivo de dependencia requerido: `require_once __DIR__ . '/../../models/Programa.php';`. |
| `9` | `require_once __DIR__ . '/../../models/Ficha.php';` | Importación e inclusión obligatoria del archivo de dependencia requerido: `require_once __DIR__ . '/../../models/Ficha.php';`. |
| `10` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `11` | `$db        = (new Database())->conectar();` | Instrucción de ejecución en el contexto del script: `$db        = (new Database())->conectar();`. |
| `12` | `$modelProg = new Programa($db);` | Instrucción de ejecución en el contexto del script: `$modelProg = new Programa($db);`. |
| `13` | `$modelFich = new Ficha($db);` | Instrucción de ejecución en el contexto del script: `$modelFich = new Ficha($db);`. |
| `14` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `15` | `$alert = $_SESSION['alert'] ?? null;` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección: `$alert = $_SESSION['alert'] ?? null;`. |
| `16` | `unset($_SESSION['alert']);` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección: `unset($_SESSION['alert']);`. |
| `17` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `18` | `// Nivel de navegación: base \| programa \| ficha` | Comentario de línea explicativo: `Nivel de navegación: base \| programa \| ficha`. |
| `19` | `$vistaPrograma = (int)($_GET['programa'] ?? 0);` | Captura y sanitiza parámetros enviados por el cliente mediante petición HTTP: `$vistaPrograma = (int)($_GET['programa'] ?? 0);`. |
| `20` | `$vistaFicha    = (int)($_GET['ficha']    ?? 0);` | Captura y sanitiza parámetros enviados por el cliente mediante petición HTTP: `$vistaFicha    = (int)($_GET['ficha']    ?? 0);`. |
| `21` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `22` | `// Datos según nivel` | Comentario de línea explicativo: `Datos según nivel`. |
| `23` | `$programas    = $modelProg->obtenerTodos();` | Instrucción de ejecución en el contexto del script: `$programas    = $modelProg->obtenerTodos();`. |
| `24` | `$programaAct  = $vistaPrograma ? $modelProg->obtenerPorId($vistaPrograma) :...` | Instrucción de ejecución en el contexto del script: `$programaAct  = $vistaPrograma ? $modelProg->obtenerPorId($vistaPrograma) : null;`. |
| `25` | `$fichasDelProg = [];` | Instrucción de ejecución en el contexto del script: `$fichasDelProg = [];`. |
| `26` | `$fichaAct      = null;` | Instrucción de ejecución en el contexto del script: `$fichaAct      = null;`. |
| `27` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `28` | `if ($vistaPrograma) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if ($vistaPrograma) {`. |
| `29` | `    // Fichas del programa seleccionado` | Comentario de línea explicativo: `Fichas del programa seleccionado`. |
| `30` | `    $stmtF = $db->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmtF = $db->prepare(`. |
| `31` | `        "SELECT f.*,` | Instrucción de ejecución en el contexto del script: `"SELECT f.*,`. |
| `32` | `                ANY_VALUE(v.nombres)   AS vocero_nombres,` | Instrucción de ejecución en el contexto del script: `ANY_VALUE(v.nombres)   AS vocero_nombres,`. |
| `33` | `                ANY_VALUE(v.apellidos) AS vocero_apellidos,` | Instrucción de ejecución en el contexto del script: `ANY_VALUE(v.apellidos) AS vocero_apellidos,`. |
| `34` | `                COUNT(DISTINCT a.id_aprendiz) AS total_aprendices` | Instrucción de ejecución en el contexto del script: `COUNT(DISTINCT a.id_aprendiz) AS total_aprendices`. |
| `35` | `         FROM fichas f` | Instrucción de ejecución en el contexto del script: `FROM fichas f`. |
| `36` | `         LEFT JOIN voceros   v ON v.id_ficha  = f.id_ficha AND v.activo = 1` | Instrucción de ejecución en el contexto del script: `LEFT JOIN voceros   v ON v.id_ficha  = f.id_ficha AND v.activo = 1`. |
| `37` | `         LEFT JOIN aprendices a ON a.id_ficha = f.id_ficha AND a.activo = 1` | Instrucción de ejecución en el contexto del script: `LEFT JOIN aprendices a ON a.id_ficha = f.id_ficha AND a.activo = 1`. |
| `38` | `         WHERE f.id_programa = :prog AND f.activo = 1` | Instrucción de ejecución en el contexto del script: `WHERE f.id_programa = :prog AND f.activo = 1`. |
| `39` | `         GROUP BY f.id_ficha` | Instrucción de ejecución en el contexto del script: `GROUP BY f.id_ficha`. |
| `40` | `         ORDER BY f.numero_ficha"` | Instrucción de ejecución en el contexto del script: `ORDER BY f.numero_ficha"`. |
| `41` | `    );` | Instrucción de ejecución en el contexto del script: `);`. |
| `42` | `    $stmtF->execute([':prog' => $vistaPrograma]);` | Ejecuta la sentencia SQL preparada vinculando los datos correspondientes: `$stmtF->execute([':prog' => $vistaPrograma]);`. |
| `43` | `    $fichasDelProg = $stmtF->fetchAll(PDO::FETCH_ASSOC);` | Obtiene todos los registros coincidentes de la consulta en un arreglo asociativo. |
| `44` | `}` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `45` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `46` | `if ($vistaFicha) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if ($vistaFicha) {`. |
| `47` | `    // Obtener ficha con vocero incluido` | Comentario de línea explicativo: `Obtener ficha con vocero incluido`. |
| `48` | `    $stmtFichaAct = $db->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmtFichaAct = $db->prepare(`. |
| `49` | `        "SELECT f.*,` | Instrucción de ejecución en el contexto del script: `"SELECT f.*,`. |
| `50` | `                p.nombre AS nombre_programa,` | Instrucción de ejecución en el contexto del script: `p.nombre AS nombre_programa,`. |
| `51` | `                ANY_VALUE(v.nombres)   AS vocero_nombres,` | Instrucción de ejecución en el contexto del script: `ANY_VALUE(v.nombres)   AS vocero_nombres,`. |
| `52` | `                ANY_VALUE(v.apellidos) AS vocero_apellidos` | Instrucción de ejecución en el contexto del script: `ANY_VALUE(v.apellidos) AS vocero_apellidos`. |
| `53` | `         FROM fichas f` | Instrucción de ejecución en el contexto del script: `FROM fichas f`. |
| `54` | `         JOIN programas p ON p.id_programa = f.id_programa` | Instrucción de ejecución en el contexto del script: `JOIN programas p ON p.id_programa = f.id_programa`. |
| `55` | `         LEFT JOIN voceros v ON v.id_ficha = f.id_ficha AND v.activo = 1` | Instrucción de ejecución en el contexto del script: `LEFT JOIN voceros v ON v.id_ficha = f.id_ficha AND v.activo = 1`. |
| `56` | `         WHERE f.id_ficha = :id` | Instrucción de ejecución en el contexto del script: `WHERE f.id_ficha = :id`. |
| `57` | `         GROUP BY f.id_ficha` | Instrucción de ejecución en el contexto del script: `GROUP BY f.id_ficha`. |
| `58` | `         LIMIT 1"` | Instrucción de ejecución en el contexto del script: `LIMIT 1"`. |
| `59` | `    );` | Instrucción de ejecución en el contexto del script: `);`. |
| `60` | `    $stmtFichaAct->execute([':id' => $vistaFicha]);` | Ejecuta la sentencia SQL preparada vinculando los datos correspondientes: `$stmtFichaAct->execute([':id' => $vistaFicha]);`. |
| `61` | `    $fichaAct = $stmtFichaAct->fetch(PDO::FETCH_ASSOC);` | Recupera una única fila o registro resultante de la consulta. |
| `62` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `63` | `    if ($fichaAct) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if ($fichaAct) {`. |
| `64` | `        $vistaPrograma = (int)$fichaAct['id_programa'];` | Instrucción de ejecución en el contexto del script: `$vistaPrograma = (int)$fichaAct['id_programa'];`. |
| `65` | `        $programaAct   = $modelProg->obtenerPorId($vistaPrograma);` | Instrucción de ejecución en el contexto del script: `$programaAct   = $modelProg->obtenerPorId($vistaPrograma);`. |
| `66` | `        // Fichas del programa (para poder volver)` | Comentario de línea explicativo: `Fichas del programa (para poder volver)`. |
| `67` | `        $stmtF2 = $db->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmtF2 = $db->prepare(`. |
| `68` | `            "SELECT f.*,` | Instrucción de ejecución en el contexto del script: `"SELECT f.*,`. |
| `69` | `                    ANY_VALUE(v.nombres)   AS vocero_nombres,` | Instrucción de ejecución en el contexto del script: `ANY_VALUE(v.nombres)   AS vocero_nombres,`. |
| `70` | `                    ANY_VALUE(v.apellidos) AS vocero_apellidos,` | Instrucción de ejecución en el contexto del script: `ANY_VALUE(v.apellidos) AS vocero_apellidos,`. |
| `71` | `                    COUNT(DISTINCT a.id_aprendiz) AS total_aprendices` | Instrucción de ejecución en el contexto del script: `COUNT(DISTINCT a.id_aprendiz) AS total_aprendices`. |
| `72` | `             FROM fichas f` | Instrucción de ejecución en el contexto del script: `FROM fichas f`. |
| `73` | `             LEFT JOIN voceros   v ON v.id_ficha  = f.id_ficha AND v.activo...` | Instrucción de ejecución en el contexto del script: `LEFT JOIN voceros   v ON v.id_ficha  = f.id_ficha AND v.activo = 1`. |
| `74` | `             LEFT JOIN aprendices a ON a.id_ficha = f.id_ficha AND a.activo...` | Instrucción de ejecución en el contexto del script: `LEFT JOIN aprendices a ON a.id_ficha = f.id_ficha AND a.activo = 1`. |
| `75` | `             WHERE f.id_programa = :prog AND f.activo = 1` | Instrucción de ejecución en el contexto del script: `WHERE f.id_programa = :prog AND f.activo = 1`. |
| `76` | `             GROUP BY f.id_ficha` | Instrucción de ejecución en el contexto del script: `GROUP BY f.id_ficha`. |
| `77` | `             ORDER BY f.numero_ficha"` | Instrucción de ejecución en el contexto del script: `ORDER BY f.numero_ficha"`. |
| `78` | `        );` | Instrucción de ejecución en el contexto del script: `);`. |
| `79` | `        $stmtF2->execute([':prog' => $vistaPrograma]);` | Ejecuta la sentencia SQL preparada vinculando los datos correspondientes: `$stmtF2->execute([':prog' => $vistaPrograma]);`. |
| `80` | `        $fichasDelProg = $stmtF2->fetchAll(PDO::FETCH_ASSOC);` | Obtiene todos los registros coincidentes de la consulta en un arreglo asociativo. |
| `81` | `        // NO cargamos evidencias aquí — están en admin_evidencias.php` | Comentario de línea explicativo: `NO cargamos evidencias aquí — están en admin_evidencias.php`. |
| `82` | `    }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `83` | `}` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `84` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `85` | `// Totales generales para nivel raíz` | Comentario de línea explicativo: `Totales generales para nivel raíz`. |
| `86` | `$totalProgramas = count($programas);` | Instrucción de ejecución en el contexto del script: `$totalProgramas = count($programas);`. |
| `87` | `$totalFichas    = array_sum(array_column($programas, 'total_fichas'));` | Instrucción de ejecución en el contexto del script: `$totalFichas    = array_sum(array_column($programas, 'total_fichas'));`. |
| `88` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `89` | `require_once __DIR__ . '/../layouts/header.php';` | Importación e inclusión obligatoria del archivo de dependencia requerido: `require_once __DIR__ . '/../layouts/header.php';`. |
| `90` | `?>` | Cierre de la etiqueta PHP para alternar a salida HTML o fin del archivo. |
| `91` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `92` | `<!-- ══ CABECERA + BREADCRUMB ═════════════════════════════════════════════...` | Instrucción de ejecución en el contexto del script: `<!-- ══ CABECERA + BREADCRUMB ════════════════════════════════════════════════ -->`. |
| `93` | `<div class="d-flex justify-content-between align-items-start mb-4 flex-wrap...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="d-flex justify-content-between align-items-start mb-4 flex-wrap gap-3">`. |
| `94` | `    <div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div>`. |
| `95` | `        <!-- Breadcrumb -->` | Instrucción de ejecución en el contexto del script: `<!-- Breadcrumb -->`. |
| `96` | `        <nav aria-label="breadcrumb" class="mb-1">` | Barra o elemento de navegación del sistema. |
| `97` | `            <ol class="breadcrumb mb-0" style="font-size:.82rem;">` | Instrucción de ejecución en el contexto del script: `<ol class="breadcrumb mb-0" style="font-size:.82rem;">`. |
| `98` | `                <li class="breadcrumb-item">` | Instrucción de ejecución en el contexto del script: `<li class="breadcrumb-item">`. |
| `99` | `                    <a href="admin_programas.php" class="text-success text-...` | Enlace hipertexto de navegación o acción: `<a href="admin_programas.php" class="text-success text-decoration-none fw-semibold">`. |
| `100` | `                        <i class="fas fa-graduation-cap me-1"></i>Programas` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-graduation-cap me-1"></i>Programas`. |
| `101` | `                    </a>` | Instrucción de ejecución en el contexto del script: `</a>`. |
| `102` | `                </li>` | Instrucción de ejecución en el contexto del script: `</li>`. |
| `103` | `                <?php if ($programaAct): ?>` | Instrucción de ejecución en el contexto del script: `<?php if ($programaAct): ?>`. |
| `104` | `                <li class="breadcrumb-item">` | Instrucción de ejecución en el contexto del script: `<li class="breadcrumb-item">`. |
| `105` | `                    <?php if ($fichaAct): ?>` | Instrucción de ejecución en el contexto del script: `<?php if ($fichaAct): ?>`. |
| `106` | `                        <a href="admin_programas.php?programa=<?= $vistaPro...` | Enlace hipertexto de navegación o acción: `<a href="admin_programas.php?programa=<?= $vistaPrograma ?>"`. |
| `107` | `                           class="text-success text-decoration-none">` | Instrucción de ejecución en el contexto del script: `class="text-success text-decoration-none">`. |
| `108` | `                            <?= htmlspecialchars($programaAct['nombre']) ?>` | Instrucción de ejecución en el contexto del script: `<?= htmlspecialchars($programaAct['nombre']) ?>`. |
| `109` | `                        </a>` | Instrucción de ejecución en el contexto del script: `</a>`. |
| `110` | `                    <?php else: ?>` | Instrucción de ejecución en el contexto del script: `<?php else: ?>`. |
| `111` | `                        <span class="text-dark"><?= htmlspecialchars($progr...` | Instrucción de ejecución en el contexto del script: `<span class="text-dark"><?= htmlspecialchars($programaAct['nombre']) ?></span>`. |
| `112` | `                    <?php endif; ?>` | Instrucción de ejecución en el contexto del script: `<?php endif; ?>`. |
| `113` | `                </li>` | Instrucción de ejecución en el contexto del script: `</li>`. |
| `114` | `                <?php endif; ?>` | Instrucción de ejecución en el contexto del script: `<?php endif; ?>`. |
| `115` | `                <?php if ($fichaAct): ?>` | Instrucción de ejecución en el contexto del script: `<?php if ($fichaAct): ?>`. |
| `116` | `                <li class="breadcrumb-item active">` | Instrucción de ejecución en el contexto del script: `<li class="breadcrumb-item active">`. |
| `117` | `                    Ficha <strong><?= htmlspecialchars($fichaAct['numero_fi...` | Instrucción de ejecución en el contexto del script: `Ficha <strong><?= htmlspecialchars($fichaAct['numero_ficha']) ?></strong>`. |
| `118` | `                    <span class="ms-1 text-muted">— Evidencias</span>` | Instrucción de ejecución en el contexto del script: `<span class="ms-1 text-muted">— Evidencias</span>`. |
| `119` | `                </li>` | Instrucción de ejecución en el contexto del script: `</li>`. |
| `120` | `                <?php endif; ?>` | Instrucción de ejecución en el contexto del script: `<?php endif; ?>`. |
| `121` | `            </ol>` | Instrucción de ejecución en el contexto del script: `</ol>`. |
| `122` | `        </nav>` | Barra o elemento de navegación del sistema. |
| `123` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `124` | `        <h4 class="fw-bold mb-0">` | Instrucción de ejecución en el contexto del script: `<h4 class="fw-bold mb-0">`. |
| `125` | `            <?php if ($fichaAct): ?>` | Instrucción de ejecución en el contexto del script: `<?php if ($fichaAct): ?>`. |
| `126` | `                <i class="fas fa-images text-success me-2"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-images text-success me-2"></i>`. |
| `127` | `                Evidencias — Ficha <?= htmlspecialchars($fichaAct['numero_f...` | Instrucción de ejecución en el contexto del script: `Evidencias — Ficha <?= htmlspecialchars($fichaAct['numero_ficha']) ?>`. |
| `128` | `            <?php elseif ($programaAct): ?>` | Instrucción de ejecución en el contexto del script: `<?php elseif ($programaAct): ?>`. |
| `129` | `                <i class="fas fa-id-card text-success me-2"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-id-card text-success me-2"></i>`. |
| `130` | `                Fichas de <?= htmlspecialchars($programaAct['nombre']) ?>` | Instrucción de ejecución en el contexto del script: `Fichas de <?= htmlspecialchars($programaAct['nombre']) ?>`. |
| `131` | `            <?php else: ?>` | Instrucción de ejecución en el contexto del script: `<?php else: ?>`. |
| `132` | `                <i class="fas fa-graduation-cap text-success me-2"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-graduation-cap text-success me-2"></i>`. |
| `133` | `                Programas de Formación` | Instrucción de ejecución en el contexto del script: `Programas de Formación`. |
| `134` | `            <?php endif; ?>` | Instrucción de ejecución en el contexto del script: `<?php endif; ?>`. |
| `135` | `        </h4>` | Instrucción de ejecución en el contexto del script: `</h4>`. |
| `136` | `        <p class="text-muted small mb-0">` | Instrucción de ejecución en el contexto del script: `<p class="text-muted small mb-0">`. |
| `137` | `            <?php if ($fichaAct): ?>` | Instrucción de ejecución en el contexto del script: `<?php if ($fichaAct): ?>`. |
| `138` | `                Evidencias fotográficas registradas en esta ficha` | Instrucción de ejecución en el contexto del script: `Evidencias fotográficas registradas en esta ficha`. |
| `139` | `            <?php elseif ($programaAct): ?>` | Instrucción de ejecución en el contexto del script: `<?php elseif ($programaAct): ?>`. |
| `140` | `                Selecciona una ficha para ver sus evidencias` | Instrucción de ejecución en el contexto del script: `Selecciona una ficha para ver sus evidencias`. |
| `141` | `            <?php else: ?>` | Instrucción de ejecución en el contexto del script: `<?php else: ?>`. |
| `142` | `                Selecciona un programa para explorar sus fichas y evidencias` | Instrucción de ejecución en el contexto del script: `Selecciona un programa para explorar sus fichas y evidencias`. |
| `143` | `            <?php endif; ?>` | Instrucción de ejecución en el contexto del script: `<?php endif; ?>`. |
| `144` | `        </p>` | Instrucción de ejecución en el contexto del script: `</p>`. |
| `145` | `    </div>` | Cierre de contenedor visual `<div>`. |
| `146` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `147` | `    <!-- Botón acción principal según nivel -->` | Instrucción de ejecución en el contexto del script: `<!-- Botón acción principal según nivel -->`. |
| `148` | `    <?php if (!$vistaPrograma && !$vistaFicha): ?>` | Instrucción de ejecución en el contexto del script: `<?php if (!$vistaPrograma && !$vistaFicha): ?>`. |
| `149` | `    <button class="btn btn-success btn-sm fw-semibold" data-bs-toggle="moda...` | Botón de acción interactivo para el usuario: `<button class="btn btn-success btn-sm fw-semibold" data-bs-toggle="modal" data-bs-target="#modalPrograma">`. |
| `150` | `        <i class="fas fa-plus me-1"></i>Nuevo Programa` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-plus me-1"></i>Nuevo Programa`. |
| `151` | `    </button>` | Botón de acción interactivo para el usuario: `</button>`. |
| `152` | `    <?php endif; ?>` | Instrucción de ejecución en el contexto del script: `<?php endif; ?>`. |
| `153` | `</div>` | Cierre de contenedor visual `<div>`. |
| `154` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `155` | `<!-- ══ NIVEL 0: STATS + CARDS DE PROGRAMAS ═══════════════════════════════...` | Instrucción de ejecución en el contexto del script: `<!-- ══ NIVEL 0: STATS + CARDS DE PROGRAMAS ══════════════════════════════════ -->`. |
| `156` | `<?php if (!$vistaPrograma && !$vistaFicha): ?>` | Instrucción de ejecución en el contexto del script: `<?php if (!$vistaPrograma && !$vistaFicha): ?>`. |
| `157` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `158` | `<!-- Stats rápidos -->` | Instrucción de ejecución en el contexto del script: `<!-- Stats rápidos -->`. |
| `159` | `<div class="row g-3 mb-4">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="row g-3 mb-4">`. |
| `160` | `    <div class="col-sm-6">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="col-sm-6">`. |
| `161` | `        <div class="stat-card bg-white">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="stat-card bg-white">`. |
| `162` | `            <div class="d-flex align-items-center gap-3">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="d-flex align-items-center gap-3">`. |
| `163` | `                <div class="stat-icon" style="background:rgba(57,169,0,.12)...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="stat-icon" style="background:rgba(57,169,0,.12);color:#39a900;">`. |
| `164` | `                    <i class="fas fa-graduation-cap"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-graduation-cap"></i>`. |
| `165` | `                </div>` | Cierre de contenedor visual `<div>`. |
| `166` | `                <div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div>`. |
| `167` | `                    <div class="fs-4 fw-bold"><?= $totalProgramas ?></div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="fs-4 fw-bold"><?= $totalProgramas ?></div>`. |
| `168` | `                    <div class="text-muted small">Programas activos</div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="text-muted small">Programas activos</div>`. |
| `169` | `                </div>` | Cierre de contenedor visual `<div>`. |
| `170` | `            </div>` | Cierre de contenedor visual `<div>`. |
| `171` | `        </div>` | Cierre de contenedor visual `<div>`. |
| `172` | `    </div>` | Cierre de contenedor visual `<div>`. |
| `173` | `    <div class="col-sm-6">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="col-sm-6">`. |
| `174` | `        <div class="stat-card bg-white">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="stat-card bg-white">`. |
| `175` | `            <div class="d-flex align-items-center gap-3">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="d-flex align-items-center gap-3">`. |
| `176` | `                <div class="stat-icon" style="background:rgba(37,99,235,.1)...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="stat-icon" style="background:rgba(37,99,235,.1);color:#2563eb;">`. |
| `177` | `                    <i class="fas fa-id-card"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-id-card"></i>`. |
| `178` | `                </div>` | Cierre de contenedor visual `<div>`. |
| `179` | `                <div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div>`. |
| `180` | `                    <div class="fs-4 fw-bold"><?= $totalFichas ?></div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="fs-4 fw-bold"><?= $totalFichas ?></div>`. |
| `181` | `                    <div class="text-muted small">Fichas registradas</div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="text-muted small">Fichas registradas</div>`. |
| `182` | `                </div>` | Cierre de contenedor visual `<div>`. |
| `183` | `            </div>` | Cierre de contenedor visual `<div>`. |
| `184` | `        </div>` | Cierre de contenedor visual `<div>`. |
| `185` | `    </div>` | Cierre de contenedor visual `<div>`. |
| `186` | `</div>` | Cierre de contenedor visual `<div>`. |
| `187` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `188` | `<!-- Buscador -->` | Instrucción de ejecución en el contexto del script: `<!-- Buscador -->`. |
| `189` | `<div class="mb-3">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="mb-3">`. |
| `190` | `    <div class="input-group input-group-sm" style="max-width:340px;">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="input-group input-group-sm" style="max-width:340px;">`. |
| `191` | `        <span class="input-group-text bg-white"><i class="fas fa-search tex...` | Instrucción de ejecución en el contexto del script: `<span class="input-group-text bg-white"><i class="fas fa-search text-muted"></i></span>`. |
| `192` | `        <input type="text" id="buscPrograma" class="form-control border-sta...` | Campo de entrada interactivo para datos del usuario: `<input type="text" id="buscPrograma" class="form-control border-start-0"`. |
| `193` | `               placeholder="Buscar programa…">` | Instrucción de ejecución en el contexto del script: `placeholder="Buscar programa…">`. |
| `194` | `    </div>` | Cierre de contenedor visual `<div>`. |
| `195` | `</div>` | Cierre de contenedor visual `<div>`. |
| `196` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `197` | `<!-- Grid de programas -->` | Instrucción de ejecución en el contexto del script: `<!-- Grid de programas -->`. |
| `198` | `<div class="row g-3" id="gridProgramas">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="row g-3" id="gridProgramas">`. |
| `199` | `    <?php foreach ($programas as $p): ?>` | Instrucción de ejecución en el contexto del script: `<?php foreach ($programas as $p): ?>`. |
| `200` | `    <div class="col-md-6 col-lg-4 prog-item">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="col-md-6 col-lg-4 prog-item">`. |
| `201` | `        <div class="card border-0 shadow-sm h-100 prog-card"` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="card border-0 shadow-sm h-100 prog-card"`. |
| `202` | `             style="border-radius:12px; cursor:pointer; transition:all .2s;"` | Instrucción de ejecución en el contexto del script: `style="border-radius:12px; cursor:pointer; transition:all .2s;"`. |
| `203` | `             onclick="location.href='admin_programas.php?programa=<?= $p['i...` | Instrucción de ejecución en el contexto del script: `onclick="location.href='admin_programas.php?programa=<?= $p['id_programa'] ?>'">`. |
| `204` | `            <div class="card-body p-4">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="card-body p-4">`. |
| `205` | `                <div class="d-flex align-items-start justify-content-betwee...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="d-flex align-items-start justify-content-between mb-3">`. |
| `206` | `                    <div class="prog-icon"` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="prog-icon"`. |
| `207` | `                         style="width:44px;height:44px;border-radius:10px;` | Instrucción de ejecución en el contexto del script: `style="width:44px;height:44px;border-radius:10px;`. |
| `208` | `                                background:rgba(57,169,0,.12);color:#39a900;` | Instrucción de ejecución en el contexto del script: `background:rgba(57,169,0,.12);color:#39a900;`. |
| `209` | `                                display:flex;align-items:center;justify-con...` | Instrucción de ejecución en el contexto del script: `display:flex;align-items:center;justify-content:center;font-size:1.2rem;">`. |
| `210` | `                        <i class="fas fa-graduation-cap"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-graduation-cap"></i>`. |
| `211` | `                    </div>` | Cierre de contenedor visual `<div>`. |
| `212` | `                    <div class="d-flex gap-1">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="d-flex gap-1">`. |
| `213` | `                        <span class="badge <?= $p['activo'] ? 'bg-success' ...` | Instrucción de ejecución en el contexto del script: `<span class="badge <?= $p['activo'] ? 'bg-success' : 'bg-secondary' ?>">`. |
| `214` | `                            <?= $p['activo'] ? 'Activo' : 'Inactivo' ?>` | Instrucción de ejecución en el contexto del script: `<?= $p['activo'] ? 'Activo' : 'Inactivo' ?>`. |
| `215` | `                        </span>` | Instrucción de ejecución en el contexto del script: `</span>`. |
| `216` | `                    </div>` | Cierre de contenedor visual `<div>`. |
| `217` | `                </div>` | Cierre de contenedor visual `<div>`. |
| `218` | `                <h6 class="fw-bold mb-1" style="font-size:.9rem; line-heigh...` | Instrucción de ejecución en el contexto del script: `<h6 class="fw-bold mb-1" style="font-size:.9rem; line-height:1.3;">`. |
| `219` | `                    <?= htmlspecialchars($p['nombre']) ?>` | Instrucción de ejecución en el contexto del script: `<?= htmlspecialchars($p['nombre']) ?>`. |
| `220` | `                </h6>` | Instrucción de ejecución en el contexto del script: `</h6>`. |
| `221` | `                <?php if ($p['nivel']): ?>` | Instrucción de ejecución en el contexto del script: `<?php if ($p['nivel']): ?>`. |
| `222` | `                <span class="badge bg-light text-dark border mb-2" style="f...` | Instrucción de ejecución en el contexto del script: `<span class="badge bg-light text-dark border mb-2" style="font-size:.72rem;">`. |
| `223` | `                    <?= htmlspecialchars($p['nivel']) ?>` | Instrucción de ejecución en el contexto del script: `<?= htmlspecialchars($p['nivel']) ?>`. |
| `224` | `                </span>` | Instrucción de ejecución en el contexto del script: `</span>`. |
| `225` | `                <?php endif; ?>` | Instrucción de ejecución en el contexto del script: `<?php endif; ?>`. |
| `226` | `                <div class="d-flex align-items-center gap-3 mt-3 pt-3"` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="d-flex align-items-center gap-3 mt-3 pt-3"`. |
| `227` | `                     style="border-top:1px solid #e5e7eb;">` | Instrucción de ejecución en el contexto del script: `style="border-top:1px solid #e5e7eb;">`. |
| `228` | `                    <div class="text-center">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="text-center">`. |
| `229` | `                        <div class="fw-bold text-success"><?= (int)$p['tota...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="fw-bold text-success"><?= (int)$p['total_fichas'] ?></div>`. |
| `230` | `                        <div class="text-muted" style="font-size:.72rem;">F...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="text-muted" style="font-size:.72rem;">Fichas</div>`. |
| `231` | `                    </div>` | Cierre de contenedor visual `<div>`. |
| `232` | `                    <div class="ms-auto d-flex gap-1" onclick="event.stopPr...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="ms-auto d-flex gap-1" onclick="event.stopPropagation()">`. |
| `233` | `                        <button class="btn btn-sm btn-outline-primary"` | Botón de acción interactivo para el usuario: `<button class="btn btn-sm btn-outline-primary"`. |
| `234` | `                                onclick='editarPrograma(<?= json_encode($p)...` | Instrucción de ejecución en el contexto del script: `onclick='editarPrograma(<?= json_encode($p) ?>)' title="Editar">`. |
| `235` | `                            <i class="fas fa-pen"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-pen"></i>`. |
| `236` | `                        </button>` | Botón de acción interactivo para el usuario: `</button>`. |
| `237` | `                        <form action="../../controllers/AdminController.php...` | Formulario para recolección y envío de datos del usuario: `<form action="../../controllers/AdminController.php" method="POST" class="d-inline">`. |
| `238` | `                            <input type="hidden" name="accion"      value="...` | Campo de entrada interactivo para datos del usuario: `<input type="hidden" name="accion"      value="eliminar_programa">`. |
| `239` | `                            <input type="hidden" name="id_programa" value="...` | Campo de entrada interactivo para datos del usuario: `<input type="hidden" name="id_programa" value="<?= $p['id_programa'] ?>">`. |
| `240` | `                            <button type="submit" class="btn btn-sm btn-out...` | Botón de acción interactivo para el usuario: `<button type="submit" class="btn btn-sm btn-outline-danger"`. |
| `241` | `                                    onclick="return confirm('¿Eliminar este...` | Instrucción de ejecución en el contexto del script: `onclick="return confirm('¿Eliminar este programa?')" title="Eliminar">`. |
| `242` | `                                <i class="fas fa-trash"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-trash"></i>`. |
| `243` | `                            </button>` | Botón de acción interactivo para el usuario: `</button>`. |
| `244` | `                        </form>` | Cierre de formulario HTML. |
| `245` | `                        <a href="admin_programas.php?programa=<?= $p['id_pr...` | Enlace hipertexto de navegación o acción: `<a href="admin_programas.php?programa=<?= $p['id_programa'] ?>"`. |
| `246` | `                           class="btn btn-sm btn-outline-success" title="Ve...` | Instrucción de ejecución en el contexto del script: `class="btn btn-sm btn-outline-success" title="Ver fichas">`. |
| `247` | `                            <i class="fas fa-arrow-right"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-arrow-right"></i>`. |
| `248` | `                        </a>` | Instrucción de ejecución en el contexto del script: `</a>`. |
| `249` | `                    </div>` | Cierre de contenedor visual `<div>`. |
| `250` | `                </div>` | Cierre de contenedor visual `<div>`. |
| `251` | `            </div>` | Cierre de contenedor visual `<div>`. |
| `252` | `        </div>` | Cierre de contenedor visual `<div>`. |
| `253` | `    </div>` | Cierre de contenedor visual `<div>`. |
| `254` | `    <?php endforeach; ?>` | Instrucción de ejecución en el contexto del script: `<?php endforeach; ?>`. |
| `255` | `    <?php if (empty($programas)): ?>` | Instrucción de ejecución en el contexto del script: `<?php if (empty($programas)): ?>`. |
| `256` | `    <div class="col-12">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="col-12">`. |
| `257` | `        <div class="card border-0 shadow-sm text-center py-5 text-muted">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="card border-0 shadow-sm text-center py-5 text-muted">`. |
| `258` | `            <i class="fas fa-graduation-cap fa-3x mb-3 opacity-25 d-block">...` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-graduation-cap fa-3x mb-3 opacity-25 d-block"></i>`. |
| `259` | `            No hay programas registrados.` | Instrucción de ejecución en el contexto del script: `No hay programas registrados.`. |
| `260` | `        </div>` | Cierre de contenedor visual `<div>`. |
| `261` | `    </div>` | Cierre de contenedor visual `<div>`. |
| `262` | `    <?php endif; ?>` | Instrucción de ejecución en el contexto del script: `<?php endif; ?>`. |
| `263` | `</div>` | Cierre de contenedor visual `<div>`. |
| `264` | `<?php endif; ?>` | Instrucción de ejecución en el contexto del script: `<?php endif; ?>`. |
| `265` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `266` | `<!-- ══ NIVEL 1: FICHAS DEL PROGRAMA ══════════════════════════════════════...` | Instrucción de ejecución en el contexto del script: `<!-- ══ NIVEL 1: FICHAS DEL PROGRAMA ═════════════════════════════════════════ -->`. |
| `267` | `<?php if ($vistaPrograma && !$vistaFicha): ?>` | Instrucción de ejecución en el contexto del script: `<?php if ($vistaPrograma && !$vistaFicha): ?>`. |
| `268` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `269` | `<div class="row g-3 mb-4">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="row g-3 mb-4">`. |
| `270` | `    <div class="col-sm-4">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="col-sm-4">`. |
| `271` | `        <div class="stat-card bg-white">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="stat-card bg-white">`. |
| `272` | `            <div class="d-flex align-items-center gap-3">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="d-flex align-items-center gap-3">`. |
| `273` | `                <div class="stat-icon" style="background:rgba(37,99,235,.1)...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="stat-icon" style="background:rgba(37,99,235,.1);color:#2563eb;">`. |
| `274` | `                    <i class="fas fa-id-card"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-id-card"></i>`. |
| `275` | `                </div>` | Cierre de contenedor visual `<div>`. |
| `276` | `                <div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div>`. |
| `277` | `                    <div class="fs-4 fw-bold"><?= count($fichasDelProg) ?><...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="fs-4 fw-bold"><?= count($fichasDelProg) ?></div>`. |
| `278` | `                    <div class="text-muted small">Fichas en este programa</...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="text-muted small">Fichas en este programa</div>`. |
| `279` | `                </div>` | Cierre de contenedor visual `<div>`. |
| `280` | `            </div>` | Cierre de contenedor visual `<div>`. |
| `281` | `        </div>` | Cierre de contenedor visual `<div>`. |
| `282` | `    </div>` | Cierre de contenedor visual `<div>`. |
| `283` | `    <?php` | Apertura obligatoria de la etiqueta PHP para ejecución del código del lado del servidor. |
| `284` | `    $aprendicesTotal = array_sum(array_column($fichasDelProg, 'total_aprend...` | Instrucción de ejecución en el contexto del script: `$aprendicesTotal = array_sum(array_column($fichasDelProg, 'total_aprendices'));`. |
| `285` | `    $conVocero = count(array_filter($fichasDelProg, fn($f) => !empty($f['vo...` | Instrucción de ejecución en el contexto del script: `$conVocero = count(array_filter($fichasDelProg, fn($f) => !empty($f['vocero_nombres'])));`. |
| `286` | `    ?>` | Cierre de la etiqueta PHP para alternar a salida HTML o fin del archivo. |
| `287` | `    <div class="col-sm-4">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="col-sm-4">`. |
| `288` | `        <div class="stat-card bg-white">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="stat-card bg-white">`. |
| `289` | `            <div class="d-flex align-items-center gap-3">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="d-flex align-items-center gap-3">`. |
| `290` | `                <div class="stat-icon" style="background:rgba(57,169,0,.12)...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="stat-icon" style="background:rgba(57,169,0,.12);color:#39a900;">`. |
| `291` | `                    <i class="fas fa-users"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-users"></i>`. |
| `292` | `                </div>` | Cierre de contenedor visual `<div>`. |
| `293` | `                <div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div>`. |
| `294` | `                    <div class="fs-4 fw-bold"><?= $aprendicesTotal ?></div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="fs-4 fw-bold"><?= $aprendicesTotal ?></div>`. |
| `295` | `                    <div class="text-muted small">Aprendices en el programa...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="text-muted small">Aprendices en el programa</div>`. |
| `296` | `                </div>` | Cierre de contenedor visual `<div>`. |
| `297` | `            </div>` | Cierre de contenedor visual `<div>`. |
| `298` | `        </div>` | Cierre de contenedor visual `<div>`. |
| `299` | `    </div>` | Cierre de contenedor visual `<div>`. |
| `300` | `    <div class="col-sm-4">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="col-sm-4">`. |
| `301` | `        <div class="stat-card bg-white">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="stat-card bg-white">`. |
| `302` | `            <div class="d-flex align-items-center gap-3">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="d-flex align-items-center gap-3">`. |
| `303` | `                <div class="stat-icon" style="background:rgba(234,179,8,.1)...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="stat-icon" style="background:rgba(234,179,8,.1);color:#d97706;">`. |
| `304` | `                    <i class="fas fa-user-tie"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-user-tie"></i>`. |
| `305` | `                </div>` | Cierre de contenedor visual `<div>`. |
| `306` | `                <div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div>`. |
| `307` | `                    <div class="fs-4 fw-bold"><?= $conVocero ?>/<?= count($...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="fs-4 fw-bold"><?= $conVocero ?>/<?= count($fichasDelProg) ?></div>`. |
| `308` | `                    <div class="text-muted small">Fichas con vocero asignad...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="text-muted small">Fichas con vocero asignado</div>`. |
| `309` | `                </div>` | Cierre de contenedor visual `<div>`. |
| `310` | `            </div>` | Cierre de contenedor visual `<div>`. |
| `311` | `        </div>` | Cierre de contenedor visual `<div>`. |
| `312` | `    </div>` | Cierre de contenedor visual `<div>`. |
| `313` | `</div>` | Cierre de contenedor visual `<div>`. |
| `314` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `315` | `<div class="card shadow-sm border-0">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="card shadow-sm border-0">`. |
| `316` | `    <div class="card-header bg-white border-0 py-3 d-flex justify-content-b...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="card-header bg-white border-0 py-3 d-flex justify-content-between align-items-center">`. |
| `317` | `        <h6 class="fw-bold mb-0">` | Instrucción de ejecución en el contexto del script: `<h6 class="fw-bold mb-0">`. |
| `318` | `            <i class="fas fa-id-card text-success me-2"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-id-card text-success me-2"></i>`. |
| `319` | `            Fichas — <?= htmlspecialchars($programaAct['nombre']) ?>` | Instrucción de ejecución en el contexto del script: `Fichas — <?= htmlspecialchars($programaAct['nombre']) ?>`. |
| `320` | `        </h6>` | Instrucción de ejecución en el contexto del script: `</h6>`. |
| `321` | `        <span class="badge bg-success"><?= count($fichasDelProg) ?> ficha(s...` | Instrucción de ejecución en el contexto del script: `<span class="badge bg-success"><?= count($fichasDelProg) ?> ficha(s)</span>`. |
| `322` | `    </div>` | Cierre de contenedor visual `<div>`. |
| `323` | `    <div class="card-body p-0">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="card-body p-0">`. |
| `324` | `        <?php if (empty($fichasDelProg)): ?>` | Instrucción de ejecución en el contexto del script: `<?php if (empty($fichasDelProg)): ?>`. |
| `325` | `        <div class="text-center py-5 text-muted">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="text-center py-5 text-muted">`. |
| `326` | `            <i class="fas fa-id-card fa-2x mb-2 opacity-25 d-block"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-id-card fa-2x mb-2 opacity-25 d-block"></i>`. |
| `327` | `            <span class="small">No hay fichas registradas en este programa....` | Instrucción de ejecución en el contexto del script: `<span class="small">No hay fichas registradas en este programa.</span>`. |
| `328` | `        </div>` | Cierre de contenedor visual `<div>`. |
| `329` | `        <?php else: ?>` | Instrucción de ejecución en el contexto del script: `<?php else: ?>`. |
| `330` | `        <div class="table-responsive">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="table-responsive">`. |
| `331` | `            <table class="table tabla-limpia align-middle mb-0">` | Tabla de datos para despliegue estructurado de información: `<table class="table tabla-limpia align-middle mb-0">`. |
| `332` | `                <thead class="table-light">` | Celda de tabla con contenido de datos o encabezado de columna: `<thead class="table-light">`. |
| `333` | `                    <tr>` | Fila contenedora de datos dentro de la tabla. |
| `334` | `                        <th>N° Ficha</th>` | Celda de tabla con contenido de datos o encabezado de columna: `<th>N° Ficha</th>`. |
| `335` | `                        <th>Jornada</th>` | Celda de tabla con contenido de datos o encabezado de columna: `<th>Jornada</th>`. |
| `336` | `                        <th>Aprendices</th>` | Celda de tabla con contenido de datos o encabezado de columna: `<th>Aprendices</th>`. |
| `337` | `                        <th>Vocero</th>` | Celda de tabla con contenido de datos o encabezado de columna: `<th>Vocero</th>`. |
| `338` | `                        <th>Estado</th>` | Celda de tabla con contenido de datos o encabezado de columna: `<th>Estado</th>`. |
| `339` | `                        <th class="text-center">Evidencias</th>` | Celda de tabla con contenido de datos o encabezado de columna: `<th class="text-center">Evidencias</th>`. |
| `340` | `                        <th class="text-center">Acciones</th>` | Celda de tabla con contenido de datos o encabezado de columna: `<th class="text-center">Acciones</th>`. |
| `341` | `                    </tr>` | Fila contenedora de datos dentro de la tabla. |
| `342` | `                </thead>` | Instrucción de ejecución en el contexto del script: `</thead>`. |
| `343` | `                <tbody>` | Instrucción de ejecución en el contexto del script: `<tbody>`. |
| `344` | `                <?php foreach ($fichasDelProg as $f):` | Instrucción de ejecución en el contexto del script: `<?php foreach ($fichasDelProg as $f):`. |
| `345` | `                    // Contar evidencias de esta ficha` | Comentario de línea explicativo: `Contar evidencias de esta ficha`. |
| `346` | `                    $stmtEvC = $db->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmtEvC = $db->prepare(`. |
| `347` | `                        "SELECT COUNT(*) FROM evidencias e` | Instrucción de ejecución en el contexto del script: `"SELECT COUNT(*) FROM evidencias e`. |
| `348` | `                         JOIN grupos g ON g.id_grupo = e.id_grupo` | Instrucción de ejecución en el contexto del script: `JOIN grupos g ON g.id_grupo = e.id_grupo`. |
| `349` | `                         JOIN asignaciones a ON a.id_asignacion = g.id_asig...` | Instrucción de ejecución en el contexto del script: `JOIN asignaciones a ON a.id_asignacion = g.id_asignacion`. |
| `350` | `                         WHERE a.id_ficha = :fic"` | Instrucción de ejecución en el contexto del script: `WHERE a.id_ficha = :fic"`. |
| `351` | `                    );` | Instrucción de ejecución en el contexto del script: `);`. |
| `352` | `                    $stmtEvC->execute([':fic' => $f['id_ficha']]);` | Ejecuta la sentencia SQL preparada vinculando los datos correspondientes: `$stmtEvC->execute([':fic' => $f['id_ficha']]);`. |
| `353` | `                    $cntEv = (int)$stmtEvC->fetchColumn();` | Obtiene el valor de una columna única de la primera fila resultante. |
| `354` | `                ?>` | Cierre de la etiqueta PHP para alternar a salida HTML o fin del archivo. |
| `355` | `                <tr style="cursor:pointer;" onclick="location.href='admin_p...` | Fila contenedora de datos dentro de la tabla. |
| `356` | `                    <td>` | Celda de tabla con contenido de datos o encabezado de columna: `<td>`. |
| `357` | `                        <span class="fw-bold text-success font-monospace">` | Instrucción de ejecución en el contexto del script: `<span class="fw-bold text-success font-monospace">`. |
| `358` | `                            <?= htmlspecialchars($f['numero_ficha']) ?>` | Instrucción de ejecución en el contexto del script: `<?= htmlspecialchars($f['numero_ficha']) ?>`. |
| `359` | `                        </span>` | Instrucción de ejecución en el contexto del script: `</span>`. |
| `360` | `                    </td>` | Celda de tabla con contenido de datos o encabezado de columna: `</td>`. |
| `361` | `                    <td>` | Celda de tabla con contenido de datos o encabezado de columna: `<td>`. |
| `362` | `                        <span class="badge bg-light text-dark border">` | Instrucción de ejecución en el contexto del script: `<span class="badge bg-light text-dark border">`. |
| `363` | `                            <?= htmlspecialchars($f['jornada']) ?>` | Instrucción de ejecución en el contexto del script: `<?= htmlspecialchars($f['jornada']) ?>`. |
| `364` | `                        </span>` | Instrucción de ejecución en el contexto del script: `</span>`. |
| `365` | `                    </td>` | Celda de tabla con contenido de datos o encabezado de columna: `</td>`. |
| `366` | `                    <td class="small"><?= (int)$f['total_aprendices'] ?></td>` | Celda de tabla con contenido de datos o encabezado de columna: `<td class="small"><?= (int)$f['total_aprendices'] ?></td>`. |
| `367` | `                    <td class="small">` | Celda de tabla con contenido de datos o encabezado de columna: `<td class="small">`. |
| `368` | `                        <?php if ($f['vocero_nombres']): ?>` | Instrucción de ejecución en el contexto del script: `<?php if ($f['vocero_nombres']): ?>`. |
| `369` | `                            <i class="fas fa-user-tie text-success me-1" st...` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-user-tie text-success me-1" style="font-size:.75rem;"></i>`. |
| `370` | `                            <?= htmlspecialchars($f['vocero_nombres'] . ' '...` | Instrucción de ejecución en el contexto del script: `<?= htmlspecialchars($f['vocero_nombres'] . ' ' . $f['vocero_apellidos']) ?>`. |
| `371` | `                        <?php else: ?>` | Instrucción de ejecución en el contexto del script: `<?php else: ?>`. |
| `372` | `                            <span class="text-muted">Sin asignar</span>` | Instrucción de ejecución en el contexto del script: `<span class="text-muted">Sin asignar</span>`. |
| `373` | `                        <?php endif; ?>` | Instrucción de ejecución en el contexto del script: `<?php endif; ?>`. |
| `374` | `                    </td>` | Celda de tabla con contenido de datos o encabezado de columna: `</td>`. |
| `375` | `                    <td>` | Celda de tabla con contenido de datos o encabezado de columna: `<td>`. |
| `376` | `                        <span class="badge <?= $f['activo'] ? 'bg-success' ...` | Instrucción de ejecución en el contexto del script: `<span class="badge <?= $f['activo'] ? 'bg-success' : 'bg-secondary' ?>">`. |
| `377` | `                            <?= $f['activo'] ? 'Activa' : 'Inactiva' ?>` | Instrucción de ejecución en el contexto del script: `<?= $f['activo'] ? 'Activa' : 'Inactiva' ?>`. |
| `378` | `                        </span>` | Instrucción de ejecución en el contexto del script: `</span>`. |
| `379` | `                    </td>` | Celda de tabla con contenido de datos o encabezado de columna: `</td>`. |
| `380` | `                    <td class="text-center">` | Celda de tabla con contenido de datos o encabezado de columna: `<td class="text-center">`. |
| `381` | `                        <?php if ($cntEv > 0): ?>` | Instrucción de ejecución en el contexto del script: `<?php if ($cntEv > 0): ?>`. |
| `382` | `                            <span class="badge bg-success"><?= $cntEv ?></s...` | Instrucción de ejecución en el contexto del script: `<span class="badge bg-success"><?= $cntEv ?></span>`. |
| `383` | `                        <?php else: ?>` | Instrucción de ejecución en el contexto del script: `<?php else: ?>`. |
| `384` | `                            <span class="text-muted small">—</span>` | Instrucción de ejecución en el contexto del script: `<span class="text-muted small">—</span>`. |
| `385` | `                        <?php endif; ?>` | Instrucción de ejecución en el contexto del script: `<?php endif; ?>`. |
| `386` | `                    </td>` | Celda de tabla con contenido de datos o encabezado de columna: `</td>`. |
| `387` | `                    <td class="text-center" onclick="event.stopPropagation()">` | Celda de tabla con contenido de datos o encabezado de columna: `<td class="text-center" onclick="event.stopPropagation()">`. |
| `388` | `                        <a href="admin_programas.php?ficha=<?= $f['id_ficha...` | Enlace hipertexto de navegación o acción: `<a href="admin_programas.php?ficha=<?= $f['id_ficha'] ?>"`. |
| `389` | `                           class="btn btn-sm btn-success fw-semibold">` | Instrucción de ejecución en el contexto del script: `class="btn btn-sm btn-success fw-semibold">`. |
| `390` | `                            <i class="fas fa-images me-1"></i>Ver evidencias` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-images me-1"></i>Ver evidencias`. |
| `391` | `                        </a>` | Instrucción de ejecución en el contexto del script: `</a>`. |
| `392` | `                    </td>` | Celda de tabla con contenido de datos o encabezado de columna: `</td>`. |
| `393` | `                </tr>` | Fila contenedora de datos dentro de la tabla. |
| `394` | `                <?php endforeach; ?>` | Instrucción de ejecución en el contexto del script: `<?php endforeach; ?>`. |
| `395` | `                </tbody>` | Instrucción de ejecución en el contexto del script: `</tbody>`. |
| `396` | `            </table>` | Tabla de datos para despliegue estructurado de información: `</table>`. |
| `397` | `        </div>` | Cierre de contenedor visual `<div>`. |
| `398` | `        <?php endif; ?>` | Instrucción de ejecución en el contexto del script: `<?php endif; ?>`. |
| `399` | `    </div>` | Cierre de contenedor visual `<div>`. |
| `400` | `</div>` | Cierre de contenedor visual `<div>`. |
| `401` | `<?php endif; ?>` | Instrucción de ejecución en el contexto del script: `<?php endif; ?>`. |
| `402` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `403` | `<!-- ══ NIVEL 2: INFO DE LA FICHA ═════════════════════════════════════════...` | Instrucción de ejecución en el contexto del script: `<!-- ══ NIVEL 2: INFO DE LA FICHA ════════════════════════════════════════════ -->`. |
| `404` | `<?php if ($vistaFicha && $fichaAct): ?>` | Instrucción de ejecución en el contexto del script: `<?php if ($vistaFicha && $fichaAct): ?>`. |
| `405` | `<?php` | Apertura obligatoria de la etiqueta PHP para ejecución del código del lado del servidor. |
| `406` | `$stmtGC = $db->prepare("SELECT COUNT(*) FROM grupos g JOIN asignaciones a O...` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmtGC = $db->prepare("SELECT COUNT(*) FROM grupos g JOIN asignaciones a ON a.id_asignacion = g.id_asignacion WHERE a.id_ficha = :fic");`. |
| `407` | `$stmtGC->execute([':fic' => $vistaFicha]);` | Ejecuta la sentencia SQL preparada vinculando los datos correspondientes: `$stmtGC->execute([':fic' => $vistaFicha]);`. |
| `408` | `$cntGrupos = (int)$stmtGC->fetchColumn();` | Obtiene el valor de una columna única de la primera fila resultante. |
| `409` | `$stmtAp2 = $db->prepare("SELECT COUNT(*) FROM aprendices WHERE id_ficha = :...` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmtAp2 = $db->prepare("SELECT COUNT(*) FROM aprendices WHERE id_ficha = :fic AND activo=1");`. |
| `410` | `$stmtAp2->execute([':fic' => $vistaFicha]);` | Ejecuta la sentencia SQL preparada vinculando los datos correspondientes: `$stmtAp2->execute([':fic' => $vistaFicha]);`. |
| `411` | `$cntAp = (int)$stmtAp2->fetchColumn();` | Obtiene el valor de una columna única de la primera fila resultante. |
| `412` | `$voceroNombre = trim(($fichaAct['vocero_nombres'] ?? '') . ' ' . ($fichaAct...` | Instrucción de ejecución en el contexto del script: `$voceroNombre = trim(($fichaAct['vocero_nombres'] ?? '') . ' ' . ($fichaAct['vocero_apellidos'] ?? ''));`. |
| `413` | `?>` | Cierre de la etiqueta PHP para alternar a salida HTML o fin del archivo. |
| `414` | `<div class="row g-3 mb-4">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="row g-3 mb-4">`. |
| `415` | `    <div class="col-sm-4">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="col-sm-4">`. |
| `416` | `        <div class="stat-card bg-white">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="stat-card bg-white">`. |
| `417` | `            <div class="d-flex align-items-center gap-3">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="d-flex align-items-center gap-3">`. |
| `418` | `                <div class="stat-icon" style="background:rgba(57,169,0,.12)...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="stat-icon" style="background:rgba(57,169,0,.12);color:#39a900;"><i class="fas fa-users"></i></div>`. |
| `419` | `                <div><div class="fs-4 fw-bold"><?= $cntAp ?></div><div clas...` | Contenedor visual estructurado con Bootstrap/CSS: `<div><div class="fs-4 fw-bold"><?= $cntAp ?></div><div class="text-muted small">Aprendices</div></div>`. |
| `420` | `            </div>` | Cierre de contenedor visual `<div>`. |
| `421` | `        </div>` | Cierre de contenedor visual `<div>`. |
| `422` | `    </div>` | Cierre de contenedor visual `<div>`. |
| `423` | `    <div class="col-sm-4">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="col-sm-4">`. |
| `424` | `        <div class="stat-card bg-white">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="stat-card bg-white">`. |
| `425` | `            <div class="d-flex align-items-center gap-3">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="d-flex align-items-center gap-3">`. |
| `426` | `                <div class="stat-icon" style="background:rgba(37,99,235,.1)...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="stat-icon" style="background:rgba(37,99,235,.1);color:#2563eb;"><i class="fas fa-people-group"></i></div>`. |
| `427` | `                <div><div class="fs-4 fw-bold"><?= $cntGrupos ?></div><div ...` | Contenedor visual estructurado con Bootstrap/CSS: `<div><div class="fs-4 fw-bold"><?= $cntGrupos ?></div><div class="text-muted small">Grupos de limpieza</div></div>`. |
| `428` | `            </div>` | Cierre de contenedor visual `<div>`. |
| `429` | `        </div>` | Cierre de contenedor visual `<div>`. |
| `430` | `    </div>` | Cierre de contenedor visual `<div>`. |
| `431` | `    <div class="col-sm-4">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="col-sm-4">`. |
| `432` | `        <div class="stat-card bg-white">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="stat-card bg-white">`. |
| `433` | `            <div class="d-flex align-items-center gap-3">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="d-flex align-items-center gap-3">`. |
| `434` | `                <div class="stat-icon" style="background:rgba(234,179,8,.1)...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="stat-icon" style="background:rgba(234,179,8,.1);color:#d97706;"><i class="fas fa-user-tie"></i></div>`. |
| `435` | `                <div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div>`. |
| `436` | `                    <div class="fw-bold" style="font-size:.9rem;"><?= $voce...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="fw-bold" style="font-size:.9rem;"><?= $voceroNombre ?: '—' ?></div>`. |
| `437` | `                    <div class="text-muted small">Vocero asignado</div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="text-muted small">Vocero asignado</div>`. |
| `438` | `                </div>` | Cierre de contenedor visual `<div>`. |
| `439` | `            </div>` | Cierre de contenedor visual `<div>`. |
| `440` | `        </div>` | Cierre de contenedor visual `<div>`. |
| `441` | `    </div>` | Cierre de contenedor visual `<div>`. |
| `442` | `</div>` | Cierre de contenedor visual `<div>`. |
| `443` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `444` | `<div class="card border-0 shadow-sm text-center py-5">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="card border-0 shadow-sm text-center py-5">`. |
| `445` | `    <div class="card-body">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="card-body">`. |
| `446` | `        <i class="fas fa-images fa-3x mb-3 opacity-25 d-block text-success"...` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-images fa-3x mb-3 opacity-25 d-block text-success"></i>`. |
| `447` | `        <p class="text-muted mb-3 small">` | Instrucción de ejecución en el contexto del script: `<p class="text-muted mb-3 small">`. |
| `448` | `            Las evidencias de esta ficha se gestionan desde la sección <str...` | Instrucción de ejecución en el contexto del script: `Las evidencias de esta ficha se gestionan desde la sección <strong>Evidencias</strong>.`. |
| `449` | `        </p>` | Instrucción de ejecución en el contexto del script: `</p>`. |
| `450` | `        <a href="admin_evidencias.php?ficha=<?= $vistaFicha ?>"` | Enlace hipertexto de navegación o acción: `<a href="admin_evidencias.php?ficha=<?= $vistaFicha ?>"`. |
| `451` | `           class="btn btn-success fw-semibold px-4">` | Instrucción de ejecución en el contexto del script: `class="btn btn-success fw-semibold px-4">`. |
| `452` | `            <i class="fas fa-images me-2"></i>Ver Evidencias de esta Ficha` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-images me-2"></i>Ver Evidencias de esta Ficha`. |
| `453` | `        </a>` | Instrucción de ejecución en el contexto del script: `</a>`. |
| `454` | `    </div>` | Cierre de contenedor visual `<div>`. |
| `455` | `</div>` | Cierre de contenedor visual `<div>`. |
| `456` | `<?php endif; ?>` | Instrucción de ejecución en el contexto del script: `<?php endif; ?>`. |
| `457` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `458` | `<!-- ══ MODAL CREAR/EDITAR PROGRAMA ═══════════════════════════════════════...` | Instrucción de ejecución en el contexto del script: `<!-- ══ MODAL CREAR/EDITAR PROGRAMA ══════════════════════════════════════════ -->`. |
| `459` | `<div class="modal fade" id="modalPrograma" tabindex="-1" aria-hidden="true">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="modal fade" id="modalPrograma" tabindex="-1" aria-hidden="true">`. |
| `460` | `    <div class="modal-dialog modal-dialog-centered">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="modal-dialog modal-dialog-centered">`. |
| `461` | `        <div class="modal-content shadow border-0">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="modal-content shadow border-0">`. |
| `462` | `            <div class="modal-header" style="background:#0f2200;color:#fff;">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="modal-header" style="background:#0f2200;color:#fff;">`. |
| `463` | `                <h6 class="modal-title fw-bold mb-0" id="modalProgramaTitulo">` | Instrucción de ejecución en el contexto del script: `<h6 class="modal-title fw-bold mb-0" id="modalProgramaTitulo">`. |
| `464` | `                    <i class="fas fa-graduation-cap me-2 text-success"></i>...` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-graduation-cap me-2 text-success"></i>Nuevo Programa`. |
| `465` | `                </h6>` | Instrucción de ejecución en el contexto del script: `</h6>`. |
| `466` | `                <button type="button" class="btn-close btn-close-white" dat...` | Botón de acción interactivo para el usuario: `<button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>`. |
| `467` | `            </div>` | Cierre de contenedor visual `<div>`. |
| `468` | `            <form action="../../controllers/AdminController.php" method="PO...` | Formulario para recolección y envío de datos del usuario: `<form action="../../controllers/AdminController.php" method="POST">`. |
| `469` | `                <input type="hidden" name="accion"      value="guardar_prog...` | Campo de entrada interactivo para datos del usuario: `<input type="hidden" name="accion"      value="guardar_programa">`. |
| `470` | `                <input type="hidden" name="id_programa" id="id_programa" va...` | Campo de entrada interactivo para datos del usuario: `<input type="hidden" name="id_programa" id="id_programa" value="">`. |
| `471` | `                <div class="modal-body px-4 py-4">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="modal-body px-4 py-4">`. |
| `472` | `                    <div class="mb-3">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="mb-3">`. |
| `473` | `                        <label class="form-label fw-semibold small">` | Instrucción de ejecución en el contexto del script: `<label class="form-label fw-semibold small">`. |
| `474` | `                            Nombre del Programa <span class="text-danger">*...` | Instrucción de ejecución en el contexto del script: `Nombre del Programa <span class="text-danger">*</span>`. |
| `475` | `                        </label>` | Instrucción de ejecución en el contexto del script: `</label>`. |
| `476` | `                        <input type="text" name="nombre" id="prog_nombre" c...` | Campo de entrada interactivo para datos del usuario: `<input type="text" name="nombre" id="prog_nombre" class="form-control" required`. |
| `477` | `                               placeholder="Ej: Tecnología en Análisis y De...` | Instrucción de ejecución en el contexto del script: `placeholder="Ej: Tecnología en Análisis y Desarrollo de Software">`. |
| `478` | `                    </div>` | Cierre de contenedor visual `<div>`. |
| `479` | `                    <div class="mb-3">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="mb-3">`. |
| `480` | `                        <label class="form-label fw-semibold small">Nivel d...` | Instrucción de ejecución en el contexto del script: `<label class="form-label fw-semibold small">Nivel de Formación</label>`. |
| `481` | `                        <select name="nivel" id="prog_nivel" class="form-se...` | Menú desplegable de opciones de selección: `<select name="nivel" id="prog_nivel" class="form-select">`. |
| `482` | `                            <option value="">-- Seleccionar --</option>` | Elemento de opción seleccionable dentro de una lista: `<option value="">-- Seleccionar --</option>`. |
| `483` | `                            <option value="Técnico">Técnico</option>` | Elemento de opción seleccionable dentro de una lista: `<option value="Técnico">Técnico</option>`. |
| `484` | `                            <option value="Tecnólogo">Tecnólogo</option>` | Elemento de opción seleccionable dentro de una lista: `<option value="Tecnólogo">Tecnólogo</option>`. |
| `485` | `                            <option value="Especialización Tecnológica">Esp...` | Elemento de opción seleccionable dentro de una lista: `<option value="Especialización Tecnológica">Especialización Tecnológica</option>`. |
| `486` | `                            <option value="Complementaria">Complementaria</...` | Elemento de opción seleccionable dentro de una lista: `<option value="Complementaria">Complementaria</option>`. |
| `487` | `                        </select>` | Menú desplegable de opciones de selección: `</select>`. |
| `488` | `                    </div>` | Cierre de contenedor visual `<div>`. |
| `489` | `                    <div class="mb-1">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="mb-1">`. |
| `490` | `                        <label class="form-label fw-semibold small">Descrip...` | Instrucción de ejecución en el contexto del script: `<label class="form-label fw-semibold small">Descripción</label>`. |
| `491` | `                        <textarea name="descripcion" id="prog_desc" class="...` | Instrucción de ejecución en el contexto del script: `<textarea name="descripcion" id="prog_desc" class="form-control" rows="3"`. |
| `492` | `                                  placeholder="Descripción general del prog...` | Instrucción de ejecución en el contexto del script: `placeholder="Descripción general del programa…"></textarea>`. |
| `493` | `                    </div>` | Cierre de contenedor visual `<div>`. |
| `494` | `                </div>` | Cierre de contenedor visual `<div>`. |
| `495` | `                <div class="modal-footer px-4">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="modal-footer px-4">`. |
| `496` | `                    <button type="button" class="btn btn-sm btn-outline-sec...` | Botón de acción interactivo para el usuario: `<button type="button" class="btn btn-sm btn-outline-secondary"`. |
| `497` | `                            data-bs-dismiss="modal">Cancelar</button>` | Botón de acción interactivo para el usuario: `data-bs-dismiss="modal">Cancelar</button>`. |
| `498` | `                    <button type="submit" class="btn btn-sm btn-success fw-...` | Botón de acción interactivo para el usuario: `<button type="submit" class="btn btn-sm btn-success fw-semibold px-4">`. |
| `499` | `                        <i class="fas fa-save me-1"></i>Guardar` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-save me-1"></i>Guardar`. |
| `500` | `                    </button>` | Botón de acción interactivo para el usuario: `</button>`. |
| `501` | `                </div>` | Cierre de contenedor visual `<div>`. |
| `502` | `            </form>` | Cierre de formulario HTML. |
| `503` | `        </div>` | Cierre de contenedor visual `<div>`. |
| `504` | `    </div>` | Cierre de contenedor visual `<div>`. |
| `505` | `</div>` | Cierre de contenedor visual `<div>`. |
| `506` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `507` | `<!-- ══ ESTILOS ═══════════════════════════════════════════════════════════...` | Instrucción de ejecución en el contexto del script: `<!-- ══ ESTILOS ═══════════════════════════════════════════════════════════════ -->`. |
| `508` | `<style>` | Instrucción de ejecución en el contexto del script: `<style>`. |
| `509` | `.prog-card:hover {` | Instrucción de ejecución en el contexto del script: `.prog-card:hover {`. |
| `510` | `    transform: translateY(-3px);` | Instrucción de ejecución en el contexto del script: `transform: translateY(-3px);`. |
| `511` | `    box-shadow: 0 8px 24px rgba(0,0,0,.1) !important;` | Instrucción de ejecución en el contexto del script: `box-shadow: 0 8px 24px rgba(0,0,0,.1) !important;`. |
| `512` | `}` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `513` | `.breadcrumb-item + .breadcrumb-item::before { color: #9ca3af; }` | Instrucción de ejecución en el contexto del script: `.breadcrumb-item + .breadcrumb-item::before { color: #9ca3af; }`. |
| `514` | `</style>` | Instrucción de ejecución en el contexto del script: `</style>`. |
| `515` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `516` | `<!-- ══ JAVASCRIPT ════════════════════════════════════════════════════════...` | Instrucción de ejecución en el contexto del script: `<!-- ══ JAVASCRIPT ══════════════════════════════════════════════════════════════ -->`. |
| `517` | `<script>` | Bloque o etiqueta de vinculación para scripts JavaScript del lado del cliente. |
| `518` | `// Buscador programas` | Comentario de línea explicativo: `Buscador programas`. |
| `519` | `const buscProg = document.getElementById('buscPrograma');` | Instrucción de ejecución en el contexto del script: `const buscProg = document.getElementById('buscPrograma');`. |
| `520` | `if (buscProg) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (buscProg) {`. |
| `521` | `    buscProg.addEventListener('input', function () {` | Declaración de método o función con su firma y parámetros: `buscProg.addEventListener('input', function () {`. |
| `522` | `        const q = this.value.toLowerCase();` | Instrucción de ejecución en el contexto del script: `const q = this.value.toLowerCase();`. |
| `523` | `        document.querySelectorAll('.prog-item').forEach(el => {` | Instrucción de ejecución en el contexto del script: `document.querySelectorAll('.prog-item').forEach(el => {`. |
| `524` | `            el.style.display = !q \|\| el.textContent.toLowerCase().include...` | Instrucción de ejecución en el contexto del script: `el.style.display = !q \|\| el.textContent.toLowerCase().includes(q) ? '' : 'none';`. |
| `525` | `        });` | Instrucción de ejecución en el contexto del script: `});`. |
| `526` | `    });` | Instrucción de ejecución en el contexto del script: `});`. |
| `527` | `}` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `528` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `529` | `// Buscador evidencias - eliminado (ver admin_evidencias.php)` | Comentario de línea explicativo: `Buscador evidencias - eliminado (ver admin_evidencias.php)`. |
| `530` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `531` | `// Modal editar programa` | Comentario de línea explicativo: `Modal editar programa`. |
| `532` | `function editarPrograma(p) {` | Declaración de método o función con su firma y parámetros: `function editarPrograma(p) {`. |
| `533` | `    document.getElementById('modalProgramaTitulo').innerHTML =` | Instrucción de ejecución en el contexto del script: `document.getElementById('modalProgramaTitulo').innerHTML =`. |
| `534` | `        '<i class="fas fa-pen me-2 text-success"></i>Editar Programa';` | Instrucción de ejecución en el contexto del script: `'<i class="fas fa-pen me-2 text-success"></i>Editar Programa';`. |
| `535` | `    document.getElementById('id_programa').value = p.id_programa;` | Instrucción de ejecución en el contexto del script: `document.getElementById('id_programa').value = p.id_programa;`. |
| `536` | `    document.getElementById('prog_nombre').value = p.nombre;` | Instrucción de ejecución en el contexto del script: `document.getElementById('prog_nombre').value = p.nombre;`. |
| `537` | `    document.getElementById('prog_nivel').value  = p.nivel  \|\| '';` | Instrucción de ejecución en el contexto del script: `document.getElementById('prog_nivel').value  = p.nivel  \|\| '';`. |
| `538` | `    document.getElementById('prog_desc').value   = p.descripcion \|\| '';` | Instrucción de ejecución en el contexto del script: `document.getElementById('prog_desc').value   = p.descripcion \|\| '';`. |
| `539` | `    new bootstrap.Modal(document.getElementById('modalPrograma')).show();` | Instrucción de ejecución en el contexto del script: `new bootstrap.Modal(document.getElementById('modalPrograma')).show();`. |
| `540` | `}` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `541` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `542` | `document.getElementById('modalPrograma').addEventListener('hidden.bs.modal'...` | Declaración de método o función con su firma y parámetros: `document.getElementById('modalPrograma').addEventListener('hidden.bs.modal', function () {`. |
| `543` | `    document.getElementById('id_programa').value = '';` | Instrucción de ejecución en el contexto del script: `document.getElementById('id_programa').value = '';`. |
| `544` | `    document.getElementById('prog_nombre').value = '';` | Instrucción de ejecución en el contexto del script: `document.getElementById('prog_nombre').value = '';`. |
| `545` | `    document.getElementById('prog_nivel').value  = '';` | Instrucción de ejecución en el contexto del script: `document.getElementById('prog_nivel').value  = '';`. |
| `546` | `    document.getElementById('prog_desc').value   = '';` | Instrucción de ejecución en el contexto del script: `document.getElementById('prog_desc').value   = '';`. |
| `547` | `    document.getElementById('modalProgramaTitulo').innerHTML =` | Instrucción de ejecución en el contexto del script: `document.getElementById('modalProgramaTitulo').innerHTML =`. |
| `548` | `        '<i class="fas fa-graduation-cap me-2 text-success"></i>Nuevo Progr...` | Instrucción de ejecución en el contexto del script: `'<i class="fas fa-graduation-cap me-2 text-success"></i>Nuevo Programa';`. |
| `549` | `});` | Instrucción de ejecución en el contexto del script: `});`. |
| `550` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `551` | `<?php if ($alert): ?>` | Instrucción de ejecución en el contexto del script: `<?php if ($alert): ?>`. |
| `552` | `document.addEventListener('DOMContentLoaded', function () {` | Declaración de método o función con su firma y parámetros: `document.addEventListener('DOMContentLoaded', function () {`. |
| `553` | `    Swal.fire({` | Instrucción de ejecución en el contexto del script: `Swal.fire({`. |
| `554` | `        icon:  '<?= addslashes($alert['icon']) ?>',` | Instrucción de ejecución en el contexto del script: `icon:  '<?= addslashes($alert['icon']) ?>',`. |
| `555` | `        title: '<?= addslashes($alert['title']) ?>',` | Instrucción de ejecución en el contexto del script: `title: '<?= addslashes($alert['title']) ?>',`. |
| `556` | `        text:  '<?= addslashes($alert['text']) ?>',` | Instrucción de ejecución en el contexto del script: `text:  '<?= addslashes($alert['text']) ?>',`. |
| `557` | `        confirmButtonColor: '#39a900'` | Instrucción de ejecución en el contexto del script: `confirmButtonColor: '#39a900'`. |
| `558` | `    });` | Instrucción de ejecución en el contexto del script: `});`. |
| `559` | `});` | Instrucción de ejecución en el contexto del script: `});`. |
| `560` | `<?php endif; ?>` | Instrucción de ejecución en el contexto del script: `<?php endif; ?>`. |
| `561` | `</script>` | Bloque o etiqueta de vinculación para scripts JavaScript del lado del cliente. |
| `562` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `563` | `<?php require_once __DIR__ . '/../layouts/footer.php'; ?>` | Instrucción de ejecución en el contexto del script: `<?php require_once __DIR__ . '/../layouts/footer.php'; ?>`. |

---

## 3. Resumen y Flujo de Interacción

El archivo `admin_programas.php` cumple un rol indispensable en `views/dashboard/admin_programas.php`. 
Módulo administrativo para el mantenimiento CRUD de los programas académicos del SENA. Garantiza la robustez, el orden y la estabilidad de la arquitectura del proyecto `systemLimpieza`.
