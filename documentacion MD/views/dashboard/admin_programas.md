# Documentación Línea por Línea: `views/dashboard/admin_programas.php`

## 1. Ficha Técnica del Archivo

- **Archivo:** `admin_programas.php`
- **Ruta en el proyecto:** `views/dashboard/admin_programas.php`
- **Cantidad total de líneas:** `258`
- **Tipo de archivo:** `PHP`
- **Propósito general:** Módulo administrativo para el mantenimiento CRUD de los programas académicos y fichas del SENA.

---

## 2. Explicación Detallada Línea por Línea

A continuación se presenta cada línea de código numerada de forma consecutiva, acompañada de su fragmento exacto y la explicación exhaustiva de su funcionamiento y responsabilidad en el sistema:

| Línea | Código Fuente | Explicación Detallada |
|---|---|---|
| `1` | ``<?php`` | Apertura obligatoria de la etiqueta PHP para ejecución del código del lado del servidor. |
| `2` | `$titulo = 'Programas y Fichas';` | Instrucción de ejecución en el contexto del script: `$titulo = 'Programas y Fichas';`. |
| `3` | `if (session_status() === PHP_SESSION_NONE) session_start();` | Inicia o reanuda la sesión PHP del usuario si no se encontraba activa previamente. |
| `4` | `if (!isset($_SESSION['usuario']) \|\| (int)$_SESSION['usuario']['rol'] !...` | Verifica autenticación y rol del usuario; redirige al login si no tiene permisos. |
| `5` | `header("Location: ../usuarios/login.php"); exit;` | Emite cabecera HTTP de redirección en el navegador y detiene la ejecución: `header("Location: ../usuarios/login.php"); exit;`. |
| `6` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `7` | `require_once __DIR__ . '/../../config/database.php';` | Importación e inclusión obligatoria del archivo de dependencia requerido: `require_once __DIR__ . '/../../config/database.php';`. |
| `8` | `require_once __DIR__ . '/../../models/Programa.php';` | Importación e inclusión obligatoria del archivo de dependencia requerido: `require_once __DIR__ . '/../../models/Programa.php';`. |
| `9` | `require_once __DIR__ . '/../../models/Ficha.php';` | Importación e inclusión obligatoria del archivo de dependencia requerido: `require_once __DIR__ . '/../../models/Ficha.php';`. |
| `10` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `11` | `$db        = (new Database())->conectar();` | Instrucción de ejecución en el contexto del script: `$db        = (new Database())->conectar();`. |
| `12` | `$modelProg = new Programa($db);` | Instrucción de ejecución en el contexto del script: `$modelProg = new Programa($db);`. |
| `13` | `$modelFich = new Ficha($db);` | Instrucción de ejecución en el contexto del script: `$modelFich = new Ficha($db);`. |
| `14` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `15` | `$alert = $_SESSION['alert'] ?? null;` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección. |
| `16` | `unset($_SESSION['alert']);` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección. |
| `17` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `18` | `$vistaPrograma = (int)($_GET['programa'] ?? 0);` | Instrucción de ejecución en el contexto del script: `$vistaPrograma = (int)($_GET['programa'] ?? 0);`. |
| `19` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `20` | `$programas     = $modelProg->obtenerTodos();` | Instrucción de ejecución en el contexto del script: `$programas     = $modelProg->obtenerTodos();`. |
| `21` | `$programaAct   = $vistaPrograma ? $modelProg->obtenerPorId($vistaProgram...` | Instrucción de ejecución en el contexto del script: `$programaAct   = $vistaPrograma ? $modelProg->obtenerPorId($vistaProgram...`. |
| `22` | `$fichasDelProg = [];` | Instrucción de ejecución en el contexto del script: `$fichasDelProg = [];`. |
| `23` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `24` | `if ($vistaPrograma) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if ($vistaPrograma) {`. |
| `25` | `$stmtF = $db->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmtF = $db->prepare(`. |
| `26` | `"SELECT f.*,` | Instrucción de ejecución en el contexto del script: `"SELECT f.*,`. |
| `27` | `ANY_VALUE(v.nombres)   AS vocero_nombres,` | Instrucción de ejecución en el contexto del script: `ANY_VALUE(v.nombres)   AS vocero_nombres,`. |
| `28` | `ANY_VALUE(v.apellidos) AS vocero_apellidos,` | Instrucción de ejecución en el contexto del script: `ANY_VALUE(v.apellidos) AS vocero_apellidos,`. |
| `29` | `COUNT(DISTINCT a.id_aprendiz) AS total_aprendices` | Instrucción de ejecución en el contexto del script: `COUNT(DISTINCT a.id_aprendiz) AS total_aprendices`. |
| `30` | `FROM fichas f` | Instrucción de ejecución en el contexto del script: `FROM fichas f`. |
| `31` | `LEFT JOIN voceros   v ON v.id_ficha  = f.id_ficha AND v.activo = 1` | Instrucción de ejecución en el contexto del script: `LEFT JOIN voceros   v ON v.id_ficha  = f.id_ficha AND v.activo = 1`. |
| `32` | `LEFT JOIN aprendices a ON a.id_ficha = f.id_ficha AND a.activo = 1` | Instrucción de ejecución en el contexto del script: `LEFT JOIN aprendices a ON a.id_ficha = f.id_ficha AND a.activo = 1`. |
| `33` | `WHERE f.id_programa = :prog AND f.activo = 1` | Instrucción de ejecución en el contexto del script: `WHERE f.id_programa = :prog AND f.activo = 1`. |
| `34` | `GROUP BY f.id_ficha` | Instrucción de ejecución en el contexto del script: `GROUP BY f.id_ficha`. |
| `35` | `ORDER BY f.numero_ficha"` | Instrucción de ejecución en el contexto del script: `ORDER BY f.numero_ficha"`. |
| `36` | ``);`` | Cierre de estructura de arreglo o invocación de función. |
| `37` | `$stmtF->execute([':prog' => $vistaPrograma]);` | Ejecuta la sentencia SQL preparada vinculando los parámetros correspondientes: `$stmtF->execute([':prog' => $vistaPrograma]);`. |
| `38` | `$fichasDelProg = $stmtF->fetchAll(PDO::FETCH_ASSOC);` | Obtiene todos los registros coincidentes de la consulta en un arreglo asociativo. |
| `39` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `40` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `41` | `$totalProgramas = count($programas);` | Instrucción de ejecución en el contexto del script: `$totalProgramas = count($programas);`. |
| `42` | `$totalFichas    = array_sum(array_column($programas, 'total_fichas'));` | Instrucción de ejecución en el contexto del script: `$totalFichas    = array_sum(array_column($programas, 'total_fichas'));`. |
| `43` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `44` | `require_once __DIR__ . '/../layouts/header.php';` | Importación e inclusión obligatoria del archivo de dependencia requerido: `require_once __DIR__ . '/../layouts/header.php';`. |
| `45` | ``?>`` | Cierre de la etiqueta PHP para alternar a salida HTML o fin del archivo. |
| `46` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `47` | `<!-- ══ CABECERA + BREADCRUMB ══════════════════════════════════════════...` | Instrucción de ejecución en el contexto del script: `<!-- ══ CABECERA + BREADCRUMB ══════════════════════════════════════════...`. |
| `48` | `<div class="d-flex justify-content-between align-items-start mb-4 flex-w...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="d-flex justify-content-between align-items-start mb-4 flex-w...`. |
| `49` | `<div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div>`. |
| `50` | `<nav aria-label="breadcrumb" class="mb-1">` | Instrucción de ejecución en el contexto del script: `<nav aria-label="breadcrumb" class="mb-1">`. |
| `51` | `<ol class="breadcrumb mb-0" style="font-size:.82rem;">` | Instrucción de ejecución en el contexto del script: `<ol class="breadcrumb mb-0" style="font-size:.82rem;">`. |
| `52` | `<li class="breadcrumb-item">` | Instrucción de ejecución en el contexto del script: `<li class="breadcrumb-item">`. |
| `53` | `<a href="admin_programas.php" class="text-success text-decoration-none f...` | Instrucción de ejecución en el contexto del script: `<a href="admin_programas.php" class="text-success text-decoration-none f...`. |
| `54` | `<i class="fas fa-graduation-cap me-1"></i>Programas` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-graduation-cap me-1"></i>Programas`. |
| `55` | `</a>` | Instrucción de ejecución en el contexto del script: `</a>`. |
| `56` | `</li>` | Instrucción de ejecución en el contexto del script: `</li>`. |
| `57` | `<?php if ($programaAct): ?>` | Instrucción de ejecución en el contexto del script: `<?php if ($programaAct): ?>`. |
| `58` | `<li class="breadcrumb-item active">` | Instrucción de ejecución en el contexto del script: `<li class="breadcrumb-item active">`. |
| `59` | `<span class="text-dark"><?= htmlspecialchars($programaAct['nombre']) ?><...` | Instrucción de ejecución en el contexto del script: `<span class="text-dark"><?= htmlspecialchars($programaAct['nombre']) ?><...`. |
| `60` | `</li>` | Instrucción de ejecución en el contexto del script: `</li>`. |
| `61` | `<?php endif; ?>` | Cierre de estructura condicional embebida en la plantilla HTML. |
| `62` | `</ol>` | Instrucción de ejecución en el contexto del script: `</ol>`. |
| `63` | `</nav>` | Instrucción de ejecución en el contexto del script: `</nav>`. |
| `64` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `65` | `<h4 class="fw-bold mb-0">` | Instrucción de ejecución en el contexto del script: `<h4 class="fw-bold mb-0">`. |
| `66` | `<?php if ($programaAct): ?>` | Instrucción de ejecución en el contexto del script: `<?php if ($programaAct): ?>`. |
| `67` | `<i class="fas fa-id-card text-success me-2"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-id-card text-success me-2"></i>`. |
| `68` | `Fichas de <?= htmlspecialchars($programaAct['nombre']) ?>` | Instrucción de ejecución en el contexto del script: `Fichas de <?= htmlspecialchars($programaAct['nombre']) ?>`. |
| `69` | `<?php else: ?>` | Instrucción de ejecución en el contexto del script: `<?php else: ?>`. |
| `70` | `<i class="fas fa-graduation-cap text-success me-2"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-graduation-cap text-success me-2"></i>`. |
| `71` | `Programas de Formación` | Instrucción de ejecución en el contexto del script: `Programas de Formación`. |
| `72` | `<?php endif; ?>` | Cierre de estructura condicional embebida en la plantilla HTML. |
| `73` | `</h4>` | Instrucción de ejecución en el contexto del script: `</h4>`. |
| `74` | `<p class="text-muted small mb-0">` | Instrucción de ejecución en el contexto del script: `<p class="text-muted small mb-0">`. |
| `75` | `<?php if ($programaAct): ?>` | Instrucción de ejecución en el contexto del script: `<?php if ($programaAct): ?>`. |
| `76` | `Fichas del programa` | Instrucción de ejecución en el contexto del script: `Fichas del programa`. |
| `77` | `<?php else: ?>` | Instrucción de ejecución en el contexto del script: `<?php else: ?>`. |
| `78` | `Programas de formación sincronizados con SICEFA` | Instrucción de ejecución en el contexto del script: `Programas de formación sincronizados con SICEFA`. |
| `79` | `<?php endif; ?>` | Cierre de estructura condicional embebida en la plantilla HTML. |
| `80` | `</p>` | Instrucción de ejecución en el contexto del script: `</p>`. |
| `81` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `82` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `83` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `84` | `<!-- ══ NIVEL 0: STATS + CARDS DE PROGRAMAS ════════════════════════════...` | Instrucción de ejecución en el contexto del script: `<!-- ══ NIVEL 0: STATS + CARDS DE PROGRAMAS ════════════════════════════...`. |
| `85` | `<?php if (!$vistaPrograma): ?>` | Instrucción de ejecución en el contexto del script: `<?php if (!$vistaPrograma): ?>`. |
| `86` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `87` | `<div class="row g-3 mb-4">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="row g-3 mb-4">`. |
| `88` | `<div class="col-sm-6">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="col-sm-6">`. |
| `89` | `<div class="stat-card bg-white">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="stat-card bg-white">`. |
| `90` | `<div class="d-flex align-items-center gap-3">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="d-flex align-items-center gap-3">`. |
| `91` | `<div class="stat-icon" style="background:rgba(57,169,0,.12);color:#39a90...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="stat-icon" style="background:rgba(57,169,0,.12);color:#39a90...`. |
| `92` | `<i class="fas fa-graduation-cap"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-graduation-cap"></i>`. |
| `93` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `94` | `<div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div>`. |
| `95` | `<div class="fs-4 fw-bold"><?= $totalProgramas ?></div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="fs-4 fw-bold"><?= $totalProgramas ?></div>`. |
| `96` | `<div class="text-muted small">Programas activos</div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="text-muted small">Programas activos</div>`. |
| `97` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `98` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `99` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `100` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `101` | `<div class="col-sm-6">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="col-sm-6">`. |
| `102` | `<div class="stat-card bg-white">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="stat-card bg-white">`. |
| `103` | `<div class="d-flex align-items-center gap-3">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="d-flex align-items-center gap-3">`. |
| `104` | `<div class="stat-icon" style="background:rgba(37,99,235,.1);color:#2563e...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="stat-icon" style="background:rgba(37,99,235,.1);color:#2563e...`. |
| `105` | `<i class="fas fa-id-card"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-id-card"></i>`. |
| `106` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `107` | `<div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div>`. |
| `108` | `<div class="fs-4 fw-bold"><?= $totalFichas ?></div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="fs-4 fw-bold"><?= $totalFichas ?></div>`. |
| `109` | `<div class="text-muted small">Fichas registradas</div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="text-muted small">Fichas registradas</div>`. |
| `110` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `111` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `112` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `113` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `114` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `115` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `116` | `<div class="mb-3">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="mb-3">`. |
| `117` | `<div class="input-group input-group-sm" style="max-width:340px;">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="input-group input-group-sm" style="max-width:340px;">`. |
| `118` | `<span class="input-group-text bg-white"><i class="fas fa-search text-mut...` | Instrucción de ejecución en el contexto del script: `<span class="input-group-text bg-white"><i class="fas fa-search text-mut...`. |
| `119` | `<input type="text" id="buscPrograma" class="form-control border-start-0"` | Campo de entrada interactivo para datos del usuario: `<input type="text" id="buscPrograma" class="form-control border-start-0"`. |
| `120` | `placeholder="Buscar programa…">` | Instrucción de ejecución en el contexto del script: `placeholder="Buscar programa…">`. |
| `121` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `122` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `123` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `124` | `<div class="row g-3" id="gridProgramas">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="row g-3" id="gridProgramas">`. |
| `125` | `<?php foreach ($programas as $p): ?>` | Instrucción de ejecución en el contexto del script: `<?php foreach ($programas as $p): ?>`. |
| `126` | `<div class="col-md-6 col-lg-4 prog-item">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="col-md-6 col-lg-4 prog-item">`. |
| `127` | `<a href="admin_programas.php?programa=<?= $p['id_programa'] ?>" class="t...` | Instrucción de ejecución en el contexto del script: `<a href="admin_programas.php?programa=<?= $p['id_programa'] ?>" class="t...`. |
| `128` | `<div class="card border-0 shadow-sm h-100 prog-card" style="border-radiu...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="card border-0 shadow-sm h-100 prog-card" style="border-radiu...`. |
| `129` | `<div class="card-body p-4">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="card-body p-4">`. |
| `130` | `<div class="d-flex align-items-start justify-content-between mb-3">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="d-flex align-items-start justify-content-between mb-3">`. |
| `131` | `<div style="width:44px;height:44px;border-radius:10px;` | Contenedor visual estructurado con Bootstrap/CSS: `<div style="width:44px;height:44px;border-radius:10px;`. |
| `132` | `background:rgba(57,169,0,.12);color:#39a900;` | Instrucción de ejecución en el contexto del script: `background:rgba(57,169,0,.12);color:#39a900;`. |
| `133` | `display:flex;align-items:center;justify-content:center;font-size:1.2rem;">` | Instrucción de ejecución en el contexto del script: `display:flex;align-items:center;justify-content:center;font-size:1.2rem;">`. |
| `134` | `<i class="fas fa-graduation-cap"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-graduation-cap"></i>`. |
| `135` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `136` | `<span class="badge <?= $p['activo'] ? 'bg-success' : 'bg-secondary' ?>">` | Instrucción de ejecución en el contexto del script: `<span class="badge <?= $p['activo'] ? 'bg-success' : 'bg-secondary' ?>">`. |
| `137` | `<?= $p['activo'] ? 'Activo' : 'Inactivo' ?>` | Instrucción de ejecución en el contexto del script: `<?= $p['activo'] ? 'Activo' : 'Inactivo' ?>`. |
| `138` | `</span>` | Instrucción de ejecución en el contexto del script: `</span>`. |
| `139` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `140` | `<h6 class="fw-bold mb-1" style="font-size:.9rem;line-height:1.3;color:#1...` | Instrucción de ejecución en el contexto del script: `<h6 class="fw-bold mb-1" style="font-size:.9rem;line-height:1.3;color:#1...`. |
| `141` | `<?= htmlspecialchars($p['nombre']) ?>` | Instrucción de ejecución en el contexto del script: `<?= htmlspecialchars($p['nombre']) ?>`. |
| `142` | `</h6>` | Instrucción de ejecución en el contexto del script: `</h6>`. |
| `143` | `<?php if ($p['nivel']): ?>` | Instrucción de ejecución en el contexto del script: `<?php if ($p['nivel']): ?>`. |
| `144` | `<span class="badge bg-light text-dark border mb-2" style="font-size:.72r...` | Instrucción de ejecución en el contexto del script: `<span class="badge bg-light text-dark border mb-2" style="font-size:.72r...`. |
| `145` | `<?= htmlspecialchars($p['nivel']) ?>` | Instrucción de ejecución en el contexto del script: `<?= htmlspecialchars($p['nivel']) ?>`. |
| `146` | `</span>` | Instrucción de ejecución en el contexto del script: `</span>`. |
| `147` | `<?php endif; ?>` | Cierre de estructura condicional embebida en la plantilla HTML. |
| `148` | `<div class="d-flex align-items-center gap-3 mt-3 pt-3"` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="d-flex align-items-center gap-3 mt-3 pt-3"`. |
| `149` | `style="border-top:1px solid #e5e7eb;">` | Instrucción de ejecución en el contexto del script: `style="border-top:1px solid #e5e7eb;">`. |
| `150` | `<div class="text-center">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="text-center">`. |
| `151` | `<div class="fw-bold text-success"><?= (int)$p['total_fichas'] ?></div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="fw-bold text-success"><?= (int)$p['total_fichas'] ?></div>`. |
| `152` | `<div class="text-muted" style="font-size:.72rem;">Fichas</div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="text-muted" style="font-size:.72rem;">Fichas</div>`. |
| `153` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `154` | `<div class="ms-auto text-success" style="font-size:.82rem;">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="ms-auto text-success" style="font-size:.82rem;">`. |
| `155` | `Ver fichas <i class="fas fa-arrow-right ms-1"></i>` | Instrucción de ejecución en el contexto del script: `Ver fichas <i class="fas fa-arrow-right ms-1"></i>`. |
| `156` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `157` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `158` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `159` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `160` | `</a>` | Instrucción de ejecución en el contexto del script: `</a>`. |
| `161` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `162` | `<?php endforeach; ?>` | Cierre de ciclo iterativo foreach embebido en la plantilla HTML. |
| `163` | `<?php if (empty($programas)): ?>` | Instrucción de ejecución en el contexto del script: `<?php if (empty($programas)): ?>`. |
| `164` | `<div class="col-12">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="col-12">`. |
| `165` | `<div class="card border-0 shadow-sm text-center py-5 text-muted">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="card border-0 shadow-sm text-center py-5 text-muted">`. |
| `166` | `<i class="fas fa-graduation-cap fa-3x mb-3 opacity-25 d-block"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-graduation-cap fa-3x mb-3 opacity-25 d-block"></i>`. |
| `167` | `No hay programas registrados.` | Instrucción de ejecución en el contexto del script: `No hay programas registrados.`. |
| `168` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `169` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `170` | `<?php endif; ?>` | Cierre de estructura condicional embebida en la plantilla HTML. |
| `171` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `172` | `<?php endif; ?>` | Cierre de estructura condicional embebida en la plantilla HTML. |
| `173` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `174` | `<!-- ══ NIVEL 1: FICHAS DEL PROGRAMA ═══════════════════════════════════...` | Instrucción de ejecución en el contexto del script: `<!-- ══ NIVEL 1: FICHAS DEL PROGRAMA ═══════════════════════════════════...`. |
| `175` | `<?php if ($vistaPrograma): ?>` | Instrucción de ejecución en el contexto del script: `<?php if ($vistaPrograma): ?>`. |
| `176` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `177` | `<div class="row g-3">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="row g-3">`. |
| `178` | `<?php foreach ($fichasDelProg as $f): ?>` | Instrucción de ejecución en el contexto del script: `<?php foreach ($fichasDelProg as $f): ?>`. |
| `179` | `<div class="col-md-6 col-lg-4">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="col-md-6 col-lg-4">`. |
| `180` | `<div class="card border-0 shadow-sm h-100 prog-card" style="border-radiu...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="card border-0 shadow-sm h-100 prog-card" style="border-radiu...`. |
| `181` | `<div class="card-body p-4">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="card-body p-4">`. |
| `182` | `<div class="d-flex align-items-start justify-content-between mb-3">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="d-flex align-items-start justify-content-between mb-3">`. |
| `183` | `<div style="width:44px;height:44px;border-radius:10px;` | Contenedor visual estructurado con Bootstrap/CSS: `<div style="width:44px;height:44px;border-radius:10px;`. |
| `184` | `background:rgba(37,99,235,.1);color:#2563eb;` | Instrucción de ejecución en el contexto del script: `background:rgba(37,99,235,.1);color:#2563eb;`. |
| `185` | `display:flex;align-items:center;justify-content:center;font-size:1.1rem;">` | Instrucción de ejecución en el contexto del script: `display:flex;align-items:center;justify-content:center;font-size:1.1rem;">`. |
| `186` | `<i class="fas fa-id-card"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-id-card"></i>`. |
| `187` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `188` | `<span class="badge bg-light text-dark border" style="font-size:.72rem;">` | Instrucción de ejecución en el contexto del script: `<span class="badge bg-light text-dark border" style="font-size:.72rem;">`. |
| `189` | `<?= htmlspecialchars($f['jornada']) ?>` | Instrucción de ejecución en el contexto del script: `<?= htmlspecialchars($f['jornada']) ?>`. |
| `190` | `</span>` | Instrucción de ejecución en el contexto del script: `</span>`. |
| `191` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `192` | `<div class="fw-bold text-success font-monospace mb-1" style="font-size:1...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="fw-bold text-success font-monospace mb-1" style="font-size:1...`. |
| `193` | `<?= htmlspecialchars($f['numero_ficha']) ?>` | Instrucción de ejecución en el contexto del script: `<?= htmlspecialchars($f['numero_ficha']) ?>`. |
| `194` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `195` | `<div class="text-muted small mb-3">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="text-muted small mb-3">`. |
| `196` | `<?php if ($f['vocero_nombres']): ?>` | Instrucción de ejecución en el contexto del script: `<?php if ($f['vocero_nombres']): ?>`. |
| `197` | `<i class="fas fa-user-tie text-success me-1" style="font-size:.75rem;"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-user-tie text-success me-1" style="font-size:.75rem;"></i>`. |
| `198` | `<?= htmlspecialchars($f['vocero_nombres'] . ' ' . $f['vocero_apellidos']...` | Instrucción de ejecución en el contexto del script: `<?= htmlspecialchars($f['vocero_nombres'] . ' ' . $f['vocero_apellidos']...`. |
| `199` | `<?php else: ?>` | Instrucción de ejecución en el contexto del script: `<?php else: ?>`. |
| `200` | `<span class="text-warning"><i class="fas fa-exclamation-circle me-1"></i...` | Instrucción de ejecución en el contexto del script: `<span class="text-warning"><i class="fas fa-exclamation-circle me-1"></i...`. |
| `201` | `<?php endif; ?>` | Cierre de estructura condicional embebida en la plantilla HTML. |
| `202` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `203` | `<div class="d-flex gap-3 pt-3" style="border-top:1px solid #e5e7eb;">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="d-flex gap-3 pt-3" style="border-top:1px solid #e5e7eb;">`. |
| `204` | `<div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div>`. |
| `205` | `<div class="fw-bold text-success"><?= (int)$f['total_aprendices'] ?></div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="fw-bold text-success"><?= (int)$f['total_aprendices'] ?></div>`. |
| `206` | `<div class="text-muted" style="font-size:.72rem;">Aprendices</div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="text-muted" style="font-size:.72rem;">Aprendices</div>`. |
| `207` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `208` | `<div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div>`. |
| `209` | `<div class="fw-bold <?= $f['activo'] ? 'text-success' : 'text-secondary'...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="fw-bold <?= $f['activo'] ? 'text-success' : 'text-secondary'...`. |
| `210` | `<?= $f['activo'] ? 'Activa' : 'Inactiva' ?>` | Instrucción de ejecución en el contexto del script: `<?= $f['activo'] ? 'Activa' : 'Inactiva' ?>`. |
| `211` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `212` | `<div class="text-muted" style="font-size:.72rem;">Estado</div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="text-muted" style="font-size:.72rem;">Estado</div>`. |
| `213` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `214` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `215` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `216` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `217` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `218` | `<?php endforeach; ?>` | Cierre de ciclo iterativo foreach embebido en la plantilla HTML. |
| `219` | `<?php if (empty($fichasDelProg)): ?>` | Instrucción de ejecución en el contexto del script: `<?php if (empty($fichasDelProg)): ?>`. |
| `220` | `<div class="col-12">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="col-12">`. |
| `221` | `<div class="card border-0 shadow-sm text-center py-5 text-muted">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="card border-0 shadow-sm text-center py-5 text-muted">`. |
| `222` | `<i class="fas fa-id-card fa-3x mb-3 opacity-25 d-block"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-id-card fa-3x mb-3 opacity-25 d-block"></i>`. |
| `223` | `No hay fichas registradas en este programa.` | Instrucción de ejecución en el contexto del script: `No hay fichas registradas en este programa.`. |
| `224` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `225` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `226` | `<?php endif; ?>` | Cierre de estructura condicional embebida en la plantilla HTML. |
| `227` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `228` | `<?php endif; ?>` | Cierre de estructura condicional embebida en la plantilla HTML. |
| `229` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `230` | ``<style>`` | Bloque de estilos CSS personalizados para la interfaz. |
| `231` | `.prog-card { transition: transform .2s, box-shadow .2s; }` | Instrucción de ejecución en el contexto del script: `.prog-card { transition: transform .2s, box-shadow .2s; }`. |
| `232` | `.prog-card:hover { transform: translateY(-3px); box-shadow: 0 8px 24px r...` | Instrucción de ejecución en el contexto del script: `.prog-card:hover { transform: translateY(-3px); box-shadow: 0 8px 24px r...`. |
| `233` | `.breadcrumb-item + .breadcrumb-item::before { color: #9ca3af; }` | Instrucción de ejecución en el contexto del script: `.breadcrumb-item + .breadcrumb-item::before { color: #9ca3af; }`. |
| `234` | ``</style>`` | Cierre de bloque de estilos CSS. |
| `235` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `236` | ``<script>`` | Bloque o etiqueta de vinculación para scripts JavaScript del lado del cliente. |
| `237` | `const buscProg = document.getElementById('buscPrograma');` | Instrucción de ejecución en el contexto del script: `const buscProg = document.getElementById('buscPrograma');`. |
| `238` | `if (buscProg) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (buscProg) {`. |
| `239` | `buscProg.addEventListener('input', function () {` | Registra un escucha de eventos del DOM para interactividad en tiempo real: `buscProg.addEventListener('input', function () {`. |
| `240` | `const q = this.value.toLowerCase();` | Instrucción de ejecución en el contexto del script: `const q = this.value.toLowerCase();`. |
| `241` | `document.querySelectorAll('.prog-item').forEach(el => {` | Instrucción de ejecución en el contexto del script: `document.querySelectorAll('.prog-item').forEach(el => {`. |
| `242` | `el.style.display = !q \|\| el.textContent.toLowerCase().includes(q) ? ''...` | Instrucción de ejecución en el contexto del script: `el.style.display = !q \|\| el.textContent.toLowerCase().includes(q) ? ''...`. |
| `243` | `});` | Instrucción de ejecución en el contexto del script: `});`. |
| `244` | `});` | Instrucción de ejecución en el contexto del script: `});`. |
| `245` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `246` | `<?php if ($alert): ?>` | Instrucción de ejecución en el contexto del script: `<?php if ($alert): ?>`. |
| `247` | `document.addEventListener('DOMContentLoaded', function () {` | Registra un escucha de eventos del DOM para interactividad en tiempo real: `document.addEventListener('DOMContentLoaded', function () {`. |
| `248` | `Swal.fire({` | Despliega una alerta modal estética e interactiva con SweetAlert2. |
| `249` | `icon:  '<?= addslashes($alert['icon']) ?>',` | Instrucción de ejecución en el contexto del script: `icon:  '<?= addslashes($alert['icon']) ?>',`. |
| `250` | `title: '<?= addslashes($alert['title']) ?>',` | Instrucción de ejecución en el contexto del script: `title: '<?= addslashes($alert['title']) ?>',`. |
| `251` | `text:  '<?= addslashes($alert['text']) ?>',` | Instrucción de ejecución en el contexto del script: `text:  '<?= addslashes($alert['text']) ?>',`. |
| `252` | `confirmButtonColor: '#39a900'` | Instrucción de ejecución en el contexto del script: `confirmButtonColor: '#39a900'`. |
| `253` | `});` | Instrucción de ejecución en el contexto del script: `});`. |
| `254` | `});` | Instrucción de ejecución en el contexto del script: `});`. |
| `255` | `<?php endif; ?>` | Cierre de estructura condicional embebida en la plantilla HTML. |
| `256` | ``</script>`` | Cierre de bloque de script JavaScript. |
| `257` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `258` | `<?php require_once __DIR__ . '/../layouts/footer.php'; ?>` | Importación e inclusión obligatoria del archivo de dependencia requerido: `<?php require_once __DIR__ . '/../layouts/footer.php'; ?>`. |

---

## 3. Resumen y Flujo de Interacción

El archivo `admin_programas.php` cumple un rol indispensable en `views/dashboard/admin_programas.php`. 
Módulo administrativo para el mantenimiento CRUD de los programas académicos y fichas del SENA. Garantiza la robustez, el orden y la estabilidad de la arquitectura del proyecto `systemLimpieza`.

---

Generado automáticamente para el repositorio [johanrepizo/LimpiezaDeModulos](https://github.com/johanrepizo/LimpiezaDeModulos).
