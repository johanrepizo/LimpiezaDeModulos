# Documentación Línea por Línea: `views/dashboard/admin_modulos.php`

## 1. Ficha Técnica del Archivo

- **Archivo:** `admin_modulos.php`
- **Ruta en el proyecto:** `views/dashboard/admin_modulos.php`
- **Cantidad total de líneas:** `407`
- **Tipo de archivo:** `PHP`
- **Propósito general:** Interfaz para crear y administrar los ambientes o módulos físicos del centro y vincularlos con las fichas.

---

## 2. Explicación Detallada Línea por Línea

A continuación se presenta cada línea de código numerada de forma consecutiva, acompañada de su fragmento exacto y la explicación exhaustiva de su funcionamiento y responsabilidad en el sistema:

| Línea | Código Fuente | Explicación Detallada |
|---|---|---|
| `1` | ``<?php`` | Apertura obligatoria de la etiqueta PHP para ejecución del código del lado del servidor. |
| `2` | `$titulo = 'Módulos y Asignaciones';` | Instrucción de ejecución en el contexto del script: `$titulo = 'Módulos y Asignaciones';`. |
| `3` | `if (session_status() === PHP_SESSION_NONE) session_start();` | Inicia o reanuda la sesión PHP del usuario si no se encontraba activa previamente. |
| `4` | `if (!isset($_SESSION['usuario']) \|\| (int)$_SESSION['usuario']['rol'] !...` | Verifica autenticación y rol del usuario; redirige al login si no tiene permisos. |
| `5` | `header("Location: ../usuarios/login.php"); exit;` | Emite cabecera HTTP de redirección en el navegador y detiene la ejecución: `header("Location: ../usuarios/login.php"); exit;`. |
| `6` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `7` | `require_once __DIR__ . '/../../config/database.php';` | Importación e inclusión obligatoria del archivo de dependencia requerido: `require_once __DIR__ . '/../../config/database.php';`. |
| `8` | `require_once __DIR__ . '/../../models/Modulo.php';` | Importación e inclusión obligatoria del archivo de dependencia requerido: `require_once __DIR__ . '/../../models/Modulo.php';`. |
| `9` | `require_once __DIR__ . '/../../models/Ficha.php';` | Importación e inclusión obligatoria del archivo de dependencia requerido: `require_once __DIR__ . '/../../models/Ficha.php';`. |
| `10` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `11` | `$db       = (new Database())->conectar();` | Instrucción de ejecución en el contexto del script: `$db       = (new Database())->conectar();`. |
| `12` | `$modModel = new Modulo($db);` | Instrucción de ejecución en el contexto del script: `$modModel = new Modulo($db);`. |
| `13` | `$ficModel = new Ficha($db);` | Instrucción de ejecución en el contexto del script: `$ficModel = new Ficha($db);`. |
| `14` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `15` | `$modulos      = $modModel->obtenerTodos();` | Instrucción de ejecución en el contexto del script: `$modulos      = $modModel->obtenerTodos();`. |
| `16` | `$fichas       = $ficModel->obtenerTodas();` | Instrucción de ejecución en el contexto del script: `$fichas       = $ficModel->obtenerTodas();`. |
| `17` | `$asignaciones = $modModel->obtenerAsignaciones();` | Instrucción de ejecución en el contexto del script: `$asignaciones = $modModel->obtenerAsignaciones();`. |
| `18` | `$alert        = $_SESSION['alert'] ?? null;` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección. |
| `19` | `unset($_SESSION['alert']);` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección. |
| `20` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `21` | `require_once __DIR__ . '/../layouts/header.php';` | Importación e inclusión obligatoria del archivo de dependencia requerido: `require_once __DIR__ . '/../layouts/header.php';`. |
| `22` | ``?>`` | Cierre de la etiqueta PHP para alternar a salida HTML o fin del archivo. |
| `23` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `24` | `<div class="d-flex justify-content-between align-items-center mb-4">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="d-flex justify-content-between align-items-center mb-4">`. |
| `25` | `<div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div>`. |
| `26` | `<h4 class="fw-bold mb-0"><i class="fas fa-door-open text-success me-2"><...` | Instrucción de ejecución en el contexto del script: `<h4 class="fw-bold mb-0"><i class="fas fa-door-open text-success me-2"><...`. |
| `27` | `<p class="text-muted small mb-0">Inventario de módulos y control de asig...` | Instrucción de ejecución en el contexto del script: `<p class="text-muted small mb-0">Inventario de módulos y control de asig...`. |
| `28` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `29` | `<div class="d-flex gap-2">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="d-flex gap-2">`. |
| `30` | `<button class="btn btn-outline-success btn-sm" data-bs-toggle="modal" da...` | Botón de acción interactivo para el usuario: `<button class="btn btn-outline-success btn-sm" data-bs-toggle="modal" da...`. |
| `31` | `<i class="fas fa-plus me-1"></i> Nuevo Módulo` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-plus me-1"></i> Nuevo Módulo`. |
| `32` | `</button>` | Instrucción de ejecución en el contexto del script: `</button>`. |
| `33` | `<button class="btn btn-success btn-sm fw-semibold" data-bs-toggle="modal...` | Botón de acción interactivo para el usuario: `<button class="btn btn-success btn-sm fw-semibold" data-bs-toggle="modal...`. |
| `34` | `<i class="fas fa-link me-1"></i> Asignar Módulo` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-link me-1"></i> Asignar Módulo`. |
| `35` | `</button>` | Instrucción de ejecución en el contexto del script: `</button>`. |
| `36` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `37` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `38` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `39` | `<!-- ── TABS ── -->` | Instrucción de ejecución en el contexto del script: `<!-- ── TABS ── -->`. |
| `40` | `<ul class="nav nav-tabs mb-0" id="tabsModulos">` | Instrucción de ejecución en el contexto del script: `<ul class="nav nav-tabs mb-0" id="tabsModulos">`. |
| `41` | `<li class="nav-item">` | Instrucción de ejecución en el contexto del script: `<li class="nav-item">`. |
| `42` | `<button class="nav-link active" data-bs-toggle="tab" data-bs-target="#ta...` | Botón de acción interactivo para el usuario: `<button class="nav-link active" data-bs-toggle="tab" data-bs-target="#ta...`. |
| `43` | `<i class="fas fa-door-open me-1"></i>Módulos (<?= count($modulos) ?>)` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-door-open me-1"></i>Módulos (<?= count($modulos) ?>)`. |
| `44` | `</button>` | Instrucción de ejecución en el contexto del script: `</button>`. |
| `45` | `</li>` | Instrucción de ejecución en el contexto del script: `</li>`. |
| `46` | `<li class="nav-item">` | Instrucción de ejecución en el contexto del script: `<li class="nav-item">`. |
| `47` | `<button class="nav-link" data-bs-toggle="tab" data-bs-target="#tabAsigna...` | Botón de acción interactivo para el usuario: `<button class="nav-link" data-bs-toggle="tab" data-bs-target="#tabAsigna...`. |
| `48` | `<i class="fas fa-link me-1"></i>Asignaciones (<?= count($asignaciones) ?>)` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-link me-1"></i>Asignaciones (<?= count($asignaciones) ?>)`. |
| `49` | `</button>` | Instrucción de ejecución en el contexto del script: `</button>`. |
| `50` | `</li>` | Instrucción de ejecución en el contexto del script: `</li>`. |
| `51` | `</ul>` | Instrucción de ejecución en el contexto del script: `</ul>`. |
| `52` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `53` | `<div class="tab-content">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="tab-content">`. |
| `54` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `55` | `<!-- Tab Módulos -->` | Instrucción de ejecución en el contexto del script: `<!-- Tab Módulos -->`. |
| `56` | `<div class="tab-pane fade show active" id="tabModulos">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="tab-pane fade show active" id="tabModulos">`. |
| `57` | `<div class="card shadow-sm rounded-top-0">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="card shadow-sm rounded-top-0">`. |
| `58` | `<div class="card-body p-0">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="card-body p-0">`. |
| `59` | `<div class="table-responsive">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="table-responsive">`. |
| `60` | `<table class="table tabla-limpia align-middle mb-0">` | Tabla de datos para despliegue estructurado de información. |
| `61` | `<thead class="table-light">` | Definición de estructura semántica de cabecera o cuerpo de tabla. |
| `62` | ``<tr>`` | Fila contenedora de datos dentro de la tabla. |
| `63` | `<th>Nombre</th>` | Celda de encabezado de columna: `<th>Nombre</th>`. |
| `64` | `<th>Ubicación</th>` | Celda de encabezado de columna: `<th>Ubicación</th>`. |
| `65` | `<th>Capacidad</th>` | Celda de encabezado de columna: `<th>Capacidad</th>`. |
| `66` | `<th>Estado</th>` | Celda de encabezado de columna: `<th>Estado</th>`. |
| `67` | `<th>Acciones</th>` | Celda de encabezado de columna: `<th>Acciones</th>`. |
| `68` | ``</tr>`` | Cierre de fila contenedora de tabla. |
| `69` | `</thead>` | Definición de estructura semántica de cabecera o cuerpo de tabla. |
| `70` | `<tbody>` | Definición de estructura semántica de cabecera o cuerpo de tabla. |
| `71` | `<?php foreach ($modulos as $m): ?>` | Instrucción de ejecución en el contexto del script: `<?php foreach ($modulos as $m): ?>`. |
| `72` | ``<tr>`` | Fila contenedora de datos dentro de la tabla. |
| `73` | `<td class="fw-semibold small"><?= htmlspecialchars($m['nombre']) ?></td>` | Celda de contenido de tabla: `<td class="fw-semibold small"><?= htmlspecialchars($m['nombre']) ?></td>`. |
| `74` | `<td class="small text-muted"><?= htmlspecialchars($m['ubicacion'] ?? '—'...` | Celda de contenido de tabla: `<td class="small text-muted"><?= htmlspecialchars($m['ubicacion'] ?? '—'...`. |
| `75` | `<td class="small"><?= $m['capacidad'] ? $m['capacidad'] . ' personas' : ...` | Celda de contenido de tabla: `<td class="small"><?= $m['capacidad'] ? $m['capacidad'] . ' personas' : ...`. |
| `76` | `<td>` | Celda de contenido de tabla: `<td>`. |
| `77` | `<?php if ($m['id_asignacion']): ?>` | Instrucción de ejecución en el contexto del script: `<?php if ($m['id_asignacion']): ?>`. |
| `78` | `<span class="badge bg-warning text-dark">Asignado</span>` | Instrucción de ejecución en el contexto del script: `<span class="badge bg-warning text-dark">Asignado</span>`. |
| `79` | `<?php else: ?>` | Instrucción de ejecución en el contexto del script: `<?php else: ?>`. |
| `80` | `<span class="badge bg-success">Disponible</span>` | Instrucción de ejecución en el contexto del script: `<span class="badge bg-success">Disponible</span>`. |
| `81` | `<?php endif; ?>` | Cierre de estructura condicional embebida en la plantilla HTML. |
| `82` | `</td>` | Instrucción de ejecución en el contexto del script: `</td>`. |
| `83` | `<td>` | Celda de contenido de tabla: `<td>`. |
| `84` | `<button class="btn btn-sm btn-outline-primary"` | Botón de acción interactivo para el usuario: `<button class="btn btn-sm btn-outline-primary"`. |
| `85` | `onclick='editarModulo(<?= json_encode($m) ?>)' title="Editar">` | Instrucción de ejecución en el contexto del script: `onclick='editarModulo(<?= json_encode($m) ?>)' title="Editar">`. |
| `86` | `<i class="fas fa-pen"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-pen"></i>`. |
| `87` | `</button>` | Instrucción de ejecución en el contexto del script: `</button>`. |
| `88` | `</td>` | Instrucción de ejecución en el contexto del script: `</td>`. |
| `89` | ``</tr>`` | Cierre de fila contenedora de tabla. |
| `90` | `<?php endforeach; ?>` | Cierre de ciclo iterativo foreach embebido en la plantilla HTML. |
| `91` | `<?php if (empty($modulos)): ?>` | Instrucción de ejecución en el contexto del script: `<?php if (empty($modulos)): ?>`. |
| `92` | ``<tr>`` | Fila contenedora de datos dentro de la tabla. |
| `93` | `<?php endif; ?>` | Cierre de estructura condicional embebida en la plantilla HTML. |
| `94` | `</tbody>` | Definición de estructura semántica de cabecera o cuerpo de tabla. |
| `95` | ``</table>`` | Cierre de tabla de datos. |
| `96` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `97` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `98` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `99` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `100` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `101` | `<!-- Tab Asignaciones -->` | Instrucción de ejecución en el contexto del script: `<!-- Tab Asignaciones -->`. |
| `102` | `<div class="tab-pane fade" id="tabAsignaciones">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="tab-pane fade" id="tabAsignaciones">`. |
| `103` | `<div class="card shadow-sm rounded-top-0">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="card shadow-sm rounded-top-0">`. |
| `104` | `<!-- Aviso regla -->` | Instrucción de ejecución en el contexto del script: `<!-- Aviso regla -->`. |
| `105` | `<div class="px-4 py-2" style="background:#eff6ff; border-bottom:1px soli...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="px-4 py-2" style="background:#eff6ff; border-bottom:1px soli...`. |
| `106` | `<i class="fas fa-circle-info me-1"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-circle-info me-1"></i>`. |
| `107` | `<strong>Regla:</strong> Cada ficha solo puede tener <strong>un módulo ac...` | Instrucción de ejecución en el contexto del script: `<strong>Regla:</strong> Cada ficha solo puede tener <strong>un módulo ac...`. |
| `108` | `Los grupos de esa ficha limpian ese módulo en rotación semanal —` | Instrucción de ejecución en el contexto del script: `Los grupos de esa ficha limpian ese módulo en rotación semanal —`. |
| `109` | `semana 1 → Grupo A, semana 2 → Grupo B, y así sucesivamente.` | Instrucción de ejecución en el contexto del script: `semana 1 → Grupo A, semana 2 → Grupo B, y así sucesivamente.`. |
| `110` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `111` | `<div class="card-body p-0">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="card-body p-0">`. |
| `112` | `<div class="table-responsive">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="table-responsive">`. |
| `113` | `<table class="table tabla-limpia align-middle mb-0">` | Tabla de datos para despliegue estructurado de información. |
| `114` | `<thead class="table-light">` | Definición de estructura semántica de cabecera o cuerpo de tabla. |
| `115` | ``<tr>`` | Fila contenedora de datos dentro de la tabla. |
| `116` | `<th>Módulo</th>` | Celda de encabezado de columna: `<th>Módulo</th>`. |
| `117` | `<th>Ficha</th>` | Celda de encabezado de columna: `<th>Ficha</th>`. |
| `118` | `<th>Programa</th>` | Celda de encabezado de columna: `<th>Programa</th>`. |
| `119` | `<th>Vocero</th>` | Celda de encabezado de columna: `<th>Vocero</th>`. |
| `120` | `<th class="text-center">Día rotación</th>` | Celda de encabezado de columna: `<th class="text-center">Día rotación</th>`. |
| `121` | `<th>Período</th>` | Celda de encabezado de columna: `<th>Período</th>`. |
| `122` | `<th>Estado</th>` | Celda de encabezado de columna: `<th>Estado</th>`. |
| `123` | `<th class="text-center">Evid.</th>` | Celda de encabezado de columna: `<th class="text-center">Evid.</th>`. |
| `124` | `<th>Acciones</th>` | Celda de encabezado de columna: `<th>Acciones</th>`. |
| `125` | ``</tr>`` | Cierre de fila contenedora de tabla. |
| `126` | `</thead>` | Definición de estructura semántica de cabecera o cuerpo de tabla. |
| `127` | `<tbody>` | Definición de estructura semántica de cabecera o cuerpo de tabla. |
| `128` | ``<?php`` | Apertura obligatoria de la etiqueta PHP para ejecución del código del lado del servidor. |
| `129` | `$diasES = ['Dom','Lun','Mar','Mié','Jue','Vie','Sáb'];` | Instrucción de ejecución en el contexto del script: `$diasES = ['Dom','Lun','Mar','Mié','Jue','Vie','Sáb'];`. |
| `130` | `foreach ($asignaciones as $a):` | Estructura de control iterativa para recorrer colecciones o arreglos: `foreach ($asignaciones as $a):`. |
| `131` | `$badgeAsig = match($a['estado']) {` | Instrucción de ejecución en el contexto del script: `$badgeAsig = match($a['estado']) {`. |
| `132` | `'Activa'     => 'bg-success',` | Instrucción de ejecución en el contexto del script: `'Activa'     => 'bg-success',`. |
| `133` | `'Completada' => 'bg-primary',` | Instrucción de ejecución en el contexto del script: `'Completada' => 'bg-primary',`. |
| `134` | `'Vencida'    => 'bg-danger',` | Instrucción de ejecución en el contexto del script: `'Vencida'    => 'bg-danger',`. |
| `135` | `'Cancelada'  => 'bg-secondary',` | Instrucción de ejecución en el contexto del script: `'Cancelada'  => 'bg-secondary',`. |
| `136` | `default      => 'bg-secondary',` | Instrucción de ejecución en el contexto del script: `default      => 'bg-secondary',`. |
| `137` | `};` | Instrucción de ejecución en el contexto del script: `};`. |
| `138` | `$editable  = $a['estado'] === 'Activa';` | Instrucción de ejecución en el contexto del script: `$editable  = $a['estado'] === 'Activa';`. |
| `139` | `$diaNombre = $diasES[(int)($a['dia_semana'] ?? 0)];` | Instrucción de ejecución en el contexto del script: `$diaNombre = $diasES[(int)($a['dia_semana'] ?? 0)];`. |
| `140` | ``?>`` | Cierre de la etiqueta PHP para alternar a salida HTML o fin del archivo. |
| `141` | ``<tr>`` | Fila contenedora de datos dentro de la tabla. |
| `142` | `<td class="fw-semibold small"><?= htmlspecialchars($a['nombre_modulo']) ...` | Celda de contenido de tabla: `<td class="fw-semibold small"><?= htmlspecialchars($a['nombre_modulo']) ...`. |
| `143` | `<td><span class="badge bg-light text-dark border font-monospace"><?= htm...` | Celda de contenido de tabla: `<td><span class="badge bg-light text-dark border font-monospace"><?= htm...`. |
| `144` | `<td class="small text-muted"><?= htmlspecialchars(substr($a['nombre_prog...` | Celda de contenido de tabla: `<td class="small text-muted"><?= htmlspecialchars(substr($a['nombre_prog...`. |
| `145` | `<td class="small"><?= htmlspecialchars(trim(($a['vocero_nombres'] ?? '')...` | Celda de contenido de tabla: `<td class="small"><?= htmlspecialchars(trim(($a['vocero_nombres'] ?? '')...`. |
| `146` | `<td class="text-center">` | Celda de contenido de tabla: `<td class="text-center">`. |
| `147` | `<span class="badge" style="background:#eef2ff;color:#4f46e5;font-size:.8...` | Instrucción de ejecución en el contexto del script: `<span class="badge" style="background:#eef2ff;color:#4f46e5;font-size:.8...`. |
| `148` | `<i class="fas fa-rotate me-1"></i><?= $diaNombre ?>s` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-rotate me-1"></i><?= $diaNombre ?>s`. |
| `149` | `</span>` | Instrucción de ejecución en el contexto del script: `</span>`. |
| `150` | `</td>` | Instrucción de ejecución en el contexto del script: `</td>`. |
| `151` | `<td class="small text-muted text-nowrap">` | Celda de contenido de tabla: `<td class="small text-muted text-nowrap">`. |
| `152` | `<?= date('d/m/Y', strtotime($a['fecha_inicio'])) ?> → <?= date('d/m/Y', ...` | Instrucción de ejecución en el contexto del script: `<?= date('d/m/Y', strtotime($a['fecha_inicio'])) ?> → <?= date('d/m/Y', ...`. |
| `153` | `</td>` | Instrucción de ejecución en el contexto del script: `</td>`. |
| `154` | `<td><span class="badge <?= $badgeAsig ?>"><?= $a['estado'] ?></span></td>` | Celda de contenido de tabla: `<td><span class="badge <?= $badgeAsig ?>"><?= $a['estado'] ?></span></td>`. |
| `155` | `<td class="text-center small"><?= (int)$a['total_evidencias'] ?></td>` | Celda de contenido de tabla: `<td class="text-center small"><?= (int)$a['total_evidencias'] ?></td>`. |
| `156` | `<td>` | Celda de contenido de tabla: `<td>`. |
| `157` | `<div class="d-flex gap-1">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="d-flex gap-1">`. |
| `158` | `<?php if ($editable): ?>` | Instrucción de ejecución en el contexto del script: `<?php if ($editable): ?>`. |
| `159` | `<button class="btn btn-sm btn-outline-primary"` | Botón de acción interactivo para el usuario: `<button class="btn btn-sm btn-outline-primary"`. |
| `160` | `onclick='abrirEditarAsignacion(<?= json_encode($a) ?>)'` | Instrucción de ejecución en el contexto del script: `onclick='abrirEditarAsignacion(<?= json_encode($a) ?>)'`. |
| `161` | `title="Editar asignación">` | Instrucción de ejecución en el contexto del script: `title="Editar asignación">`. |
| `162` | `<i class="fas fa-pen"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-pen"></i>`. |
| `163` | `</button>` | Instrucción de ejecución en el contexto del script: `</button>`. |
| `164` | `<form action="../../controllers/AdminController.php" method="POST"` | Formulario interactivo para captura y envío de datos: `<form action="../../controllers/AdminController.php" method="POST"`. |
| `165` | `class="d-inline" id="form-cancel-<?= $a['id_asignacion'] ?>">` | Instrucción de ejecución en el contexto del script: `class="d-inline" id="form-cancel-<?= $a['id_asignacion'] ?>">`. |
| `166` | `<input type="hidden" name="accion"        value="cancelar_asignacion">` | Campo de entrada interactivo para datos del usuario: `<input type="hidden" name="accion"        value="cancelar_asignacion">`. |
| `167` | `<input type="hidden" name="id_asignacion" value="<?= $a['id_asignacion']...` | Campo de entrada interactivo para datos del usuario: `<input type="hidden" name="id_asignacion" value="<?= $a['id_asignacion']...`. |
| `168` | `<button type="button" class="btn btn-sm btn-outline-danger"` | Botón de acción interactivo para el usuario: `<button type="button" class="btn btn-sm btn-outline-danger"`. |
| `169` | `onclick="confirmarCancelarAsignacion(<?= $a['id_asignacion'] ?>)"` | Instrucción de ejecución en el contexto del script: `onclick="confirmarCancelarAsignacion(<?= $a['id_asignacion'] ?>)"`. |
| `170` | `title="Cancelar asignación">` | Instrucción de ejecución en el contexto del script: `title="Cancelar asignación">`. |
| `171` | `<i class="fas fa-ban"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-ban"></i>`. |
| `172` | `</button>` | Instrucción de ejecución en el contexto del script: `</button>`. |
| `173` | ``</form>`` | Cierre de formulario interactivo. |
| `174` | `<?php else: ?>` | Instrucción de ejecución en el contexto del script: `<?php else: ?>`. |
| `175` | `<span class="text-muted small">—</span>` | Instrucción de ejecución en el contexto del script: `<span class="text-muted small">—</span>`. |
| `176` | `<?php endif; ?>` | Cierre de estructura condicional embebida en la plantilla HTML. |
| `177` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `178` | `</td>` | Instrucción de ejecución en el contexto del script: `</td>`. |
| `179` | ``</tr>`` | Cierre de fila contenedora de tabla. |
| `180` | `<?php endforeach; ?>` | Cierre de ciclo iterativo foreach embebido en la plantilla HTML. |
| `181` | `<?php if (empty($asignaciones)): ?>` | Instrucción de ejecución en el contexto del script: `<?php if (empty($asignaciones)): ?>`. |
| `182` | ``<tr>`` | Fila contenedora de datos dentro de la tabla. |
| `183` | `<?php endif; ?>` | Cierre de estructura condicional embebida en la plantilla HTML. |
| `184` | `</tbody>` | Definición de estructura semántica de cabecera o cuerpo de tabla. |
| `185` | ``</table>`` | Cierre de tabla de datos. |
| `186` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `187` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `188` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `189` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `190` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `191` | `</div><!-- /tab-content -->` | Instrucción de ejecución en el contexto del script: `</div><!-- /tab-content -->`. |
| `192` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `193` | `<!-- Modal Módulo -->` | Instrucción de ejecución en el contexto del script: `<!-- Modal Módulo -->`. |
| `194` | `<div class="modal fade" id="modalModulo" tabindex="-1" aria-hidden="true">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="modal fade" id="modalModulo" tabindex="-1" aria-hidden="true">`. |
| `195` | `<div class="modal-dialog modal-dialog-centered">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="modal-dialog modal-dialog-centered">`. |
| `196` | `<div class="modal-content shadow">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="modal-content shadow">`. |
| `197` | `<div class="modal-header" style="background:#0f2200; color:#fff;">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="modal-header" style="background:#0f2200; color:#fff;">`. |
| `198` | `<h6 class="modal-title fw-bold" id="titModalModulo"><i class="fas fa-doo...` | Instrucción de ejecución en el contexto del script: `<h6 class="modal-title fw-bold" id="titModalModulo"><i class="fas fa-doo...`. |
| `199` | `<button type="button" class="btn-close btn-close-white" data-bs-dismiss=...` | Botón de acción interactivo para el usuario: `<button type="button" class="btn-close btn-close-white" data-bs-dismiss=...`. |
| `200` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `201` | `<form action="../../controllers/AdminController.php" method="POST">` | Formulario interactivo para captura y envío de datos: `<form action="../../controllers/AdminController.php" method="POST">`. |
| `202` | `<input type="hidden" name="accion"    value="guardar_modulo">` | Campo de entrada interactivo para datos del usuario: `<input type="hidden" name="accion"    value="guardar_modulo">`. |
| `203` | `<input type="hidden" name="id_modulo" id="id_modulo" value="">` | Campo de entrada interactivo para datos del usuario: `<input type="hidden" name="id_modulo" id="id_modulo" value="">`. |
| `204` | `<div class="modal-body px-4 py-4">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="modal-body px-4 py-4">`. |
| `205` | `<div class="mb-3">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="mb-3">`. |
| `206` | `<label class="form-label fw-semibold small">Nombre del Módulo <span clas...` | Instrucción de ejecución en el contexto del script: `<label class="form-label fw-semibold small">Nombre del Módulo <span clas...`. |
| `207` | `<input type="text" name="nombre" id="mod_nombre" class="form-control" re...` | Campo de entrada interactivo para datos del usuario: `<input type="text" name="nombre" id="mod_nombre" class="form-control" re...`. |
| `208` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `209` | `<div class="mb-3">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="mb-3">`. |
| `210` | `<label class="form-label fw-semibold small">Ubicación</label>` | Instrucción de ejecución en el contexto del script: `<label class="form-label fw-semibold small">Ubicación</label>`. |
| `211` | `<input type="text" name="ubicacion" id="mod_ubicacion" class="form-contr...` | Campo de entrada interactivo para datos del usuario: `<input type="text" name="ubicacion" id="mod_ubicacion" class="form-contr...`. |
| `212` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `213` | `<div class="mb-3">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="mb-3">`. |
| `214` | `<label class="form-label fw-semibold small">Capacidad (personas)</label>` | Instrucción de ejecución en el contexto del script: `<label class="form-label fw-semibold small">Capacidad (personas)</label>`. |
| `215` | `<input type="number" name="capacidad" id="mod_capacidad" class="form-con...` | Campo de entrada interactivo para datos del usuario: `<input type="number" name="capacidad" id="mod_capacidad" class="form-con...`. |
| `216` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `217` | `<div class="mb-1">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="mb-1">`. |
| `218` | `<label class="form-label fw-semibold small">Descripción</label>` | Instrucción de ejecución en el contexto del script: `<label class="form-label fw-semibold small">Descripción</label>`. |
| `219` | `<textarea name="descripcion" id="mod_desc" class="form-control" rows="2"...` | Instrucción de ejecución en el contexto del script: `<textarea name="descripcion" id="mod_desc" class="form-control" rows="2"...`. |
| `220` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `221` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `222` | `<div class="modal-footer px-4">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="modal-footer px-4">`. |
| `223` | `<button type="button" class="btn btn-sm btn-outline-secondary" data-bs-d...` | Botón de acción interactivo para el usuario: `<button type="button" class="btn btn-sm btn-outline-secondary" data-bs-d...`. |
| `224` | `<button type="submit" class="btn btn-sm btn-success fw-semibold px-4"><i...` | Botón de acción interactivo para el usuario: `<button type="submit" class="btn btn-sm btn-success fw-semibold px-4"><i...`. |
| `225` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `226` | ``</form>`` | Cierre de formulario interactivo. |
| `227` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `228` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `229` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `230` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `231` | `<!-- Modal Asignación -->` | Instrucción de ejecución en el contexto del script: `<!-- Modal Asignación -->`. |
| `232` | `<div class="modal fade" id="modalAsignacion" tabindex="-1" aria-hidden="...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="modal fade" id="modalAsignacion" tabindex="-1" aria-hidden="...`. |
| `233` | `<div class="modal-dialog modal-dialog-centered">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="modal-dialog modal-dialog-centered">`. |
| `234` | `<div class="modal-content shadow">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="modal-content shadow">`. |
| `235` | `<div class="modal-header" style="background:#0f2200; color:#fff;">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="modal-header" style="background:#0f2200; color:#fff;">`. |
| `236` | `<h6 class="modal-title fw-bold"><i class="fas fa-link me-2 text-success"...` | Instrucción de ejecución en el contexto del script: `<h6 class="modal-title fw-bold"><i class="fas fa-link me-2 text-success"...`. |
| `237` | `<button type="button" class="btn-close btn-close-white" data-bs-dismiss=...` | Botón de acción interactivo para el usuario: `<button type="button" class="btn-close btn-close-white" data-bs-dismiss=...`. |
| `238` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `239` | `<form action="../../controllers/AdminController.php" method="POST">` | Formulario interactivo para captura y envío de datos: `<form action="../../controllers/AdminController.php" method="POST">`. |
| `240` | `<input type="hidden" name="accion" value="asignar_modulo">` | Campo de entrada interactivo para datos del usuario: `<input type="hidden" name="accion" value="asignar_modulo">`. |
| `241` | `<div class="modal-body px-4 py-4">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="modal-body px-4 py-4">`. |
| `242` | `<div class="mb-3">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="mb-3">`. |
| `243` | `<label class="form-label fw-semibold small">Módulo <span class="text-dan...` | Instrucción de ejecución en el contexto del script: `<label class="form-label fw-semibold small">Módulo <span class="text-dan...`. |
| `244` | `<select name="id_modulo" class="form-select" required>` | Menú desplegable para selección de opciones. |
| `245` | `<option value="">-- Seleccionar módulo --</option>` | Instrucción de ejecución en el contexto del script: `<option value="">-- Seleccionar módulo --</option>`. |
| `246` | `<?php foreach ($modulos as $m): ?>` | Instrucción de ejecución en el contexto del script: `<?php foreach ($modulos as $m): ?>`. |
| `247` | `<option value="<?= $m['id_modulo'] ?>"><?= htmlspecialchars($m['nombre']...` | Instrucción de ejecución en el contexto del script: `<option value="<?= $m['id_modulo'] ?>"><?= htmlspecialchars($m['nombre']...`. |
| `248` | `<?php endforeach; ?>` | Cierre de ciclo iterativo foreach embebido en la plantilla HTML. |
| `249` | `</select>` | Instrucción de ejecución en el contexto del script: `</select>`. |
| `250` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `251` | `<div class="mb-3">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="mb-3">`. |
| `252` | `<label class="form-label fw-semibold small">Ficha <span class="text-dang...` | Instrucción de ejecución en el contexto del script: `<label class="form-label fw-semibold small">Ficha <span class="text-dang...`. |
| `253` | `<select name="id_ficha" class="form-select" required>` | Menú desplegable para selección de opciones. |
| `254` | `<option value="">-- Seleccionar ficha --</option>` | Instrucción de ejecución en el contexto del script: `<option value="">-- Seleccionar ficha --</option>`. |
| `255` | `<?php foreach ($fichas as $f): ?>` | Instrucción de ejecución en el contexto del script: `<?php foreach ($fichas as $f): ?>`. |
| `256` | `<option value="<?= $f['id_ficha'] ?>"><?= htmlspecialchars($f['numero_fi...` | Instrucción de ejecución en el contexto del script: `<option value="<?= $f['id_ficha'] ?>"><?= htmlspecialchars($f['numero_fi...`. |
| `257` | `<?php endforeach; ?>` | Cierre de ciclo iterativo foreach embebido en la plantilla HTML. |
| `258` | `</select>` | Instrucción de ejecución en el contexto del script: `</select>`. |
| `259` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `260` | `<div class="mb-1">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="mb-1">`. |
| `261` | `<label class="form-label fw-semibold small">` | Instrucción de ejecución en el contexto del script: `<label class="form-label fw-semibold small">`. |
| `262` | `Fecha de inicio de limpieza <span class="text-danger">*</span>` | Instrucción de ejecución en el contexto del script: `Fecha de inicio de limpieza <span class="text-danger">*</span>`. |
| `263` | `</label>` | Instrucción de ejecución en el contexto del script: `</label>`. |
| `264` | `<input type="date" name="fecha_inicio" id="asig_fecha_inicio"` | Campo de entrada interactivo para datos del usuario: `<input type="date" name="fecha_inicio" id="asig_fecha_inicio"`. |
| `265` | `class="form-control" required` | Instrucción de ejecución en el contexto del script: `class="form-control" required`. |
| `266` | `min="<?= date('Y-m-d') ?>">` | Instrucción de ejecución en el contexto del script: `min="<?= date('Y-m-d') ?>">`. |
| `267` | `<div class="form-text" style="color:#4f46e5; font-size:.8rem;">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="form-text" style="color:#4f46e5; font-size:.8rem;">`. |
| `268` | `<i class="fas fa-rotate me-1"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-rotate me-1"></i>`. |
| `269` | `Según este día de la semana se programará la limpieza <strong>cada seman...` | Instrucción de ejecución en el contexto del script: `Según este día de la semana se programará la limpieza <strong>cada seman...`. |
| `270` | `Por ejemplo, si eliges un miércoles, la limpieza será todos los miércoles.` | Instrucción de ejecución en el contexto del script: `Por ejemplo, si eliges un miércoles, la limpieza será todos los miércoles.`. |
| `271` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `272` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `273` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `274` | `<div class="modal-footer px-4">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="modal-footer px-4">`. |
| `275` | `<button type="button" class="btn btn-sm btn-outline-secondary" data-bs-d...` | Botón de acción interactivo para el usuario: `<button type="button" class="btn btn-sm btn-outline-secondary" data-bs-d...`. |
| `276` | `<button type="submit" class="btn btn-sm btn-success fw-semibold px-4"><i...` | Botón de acción interactivo para el usuario: `<button type="submit" class="btn btn-sm btn-success fw-semibold px-4"><i...`. |
| `277` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `278` | ``</form>`` | Cierre de formulario interactivo. |
| `279` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `280` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `281` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `282` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `283` | `<!-- Modal Editar Asignación -->` | Instrucción de ejecución en el contexto del script: `<!-- Modal Editar Asignación -->`. |
| `284` | `<div class="modal fade" id="modalEditarAsig" tabindex="-1" aria-hidden="...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="modal fade" id="modalEditarAsig" tabindex="-1" aria-hidden="...`. |
| `285` | `<div class="modal-dialog modal-dialog-centered">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="modal-dialog modal-dialog-centered">`. |
| `286` | `<div class="modal-content shadow">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="modal-content shadow">`. |
| `287` | `<div class="modal-header" style="background:#0f2200; color:#fff;">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="modal-header" style="background:#0f2200; color:#fff;">`. |
| `288` | `<h6 class="modal-title fw-bold">` | Instrucción de ejecución en el contexto del script: `<h6 class="modal-title fw-bold">`. |
| `289` | `<i class="fas fa-pen me-2 text-success"></i>Editar Asignación` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-pen me-2 text-success"></i>Editar Asignación`. |
| `290` | `</h6>` | Instrucción de ejecución en el contexto del script: `</h6>`. |
| `291` | `<button type="button" class="btn-close btn-close-white" data-bs-dismiss=...` | Botón de acción interactivo para el usuario: `<button type="button" class="btn-close btn-close-white" data-bs-dismiss=...`. |
| `292` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `293` | `<form action="../../controllers/AdminController.php" method="POST">` | Formulario interactivo para captura y envío de datos: `<form action="../../controllers/AdminController.php" method="POST">`. |
| `294` | `<input type="hidden" name="accion"        value="editar_asignacion">` | Campo de entrada interactivo para datos del usuario: `<input type="hidden" name="accion"        value="editar_asignacion">`. |
| `295` | `<input type="hidden" name="id_asignacion" id="ea_id">` | Campo de entrada interactivo para datos del usuario: `<input type="hidden" name="id_asignacion" id="ea_id">`. |
| `296` | `<div class="modal-body px-4 py-4">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="modal-body px-4 py-4">`. |
| `297` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `298` | `<!-- Módulo (solo lectura) -->` | Instrucción de ejecución en el contexto del script: `<!-- Módulo (solo lectura) -->`. |
| `299` | `<div class="mb-3">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="mb-3">`. |
| `300` | `<label class="form-label fw-semibold small">Módulo</label>` | Instrucción de ejecución en el contexto del script: `<label class="form-label fw-semibold small">Módulo</label>`. |
| `301` | `<input type="text" id="ea_modulo" class="form-control bg-light" disabled>` | Campo de entrada interactivo para datos del usuario: `<input type="text" id="ea_modulo" class="form-control bg-light" disabled>`. |
| `302` | `<div class="form-text text-muted">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="form-text text-muted">`. |
| `303` | `El módulo no puede cambiarse. Cancela y crea una nueva asignación si nec...` | Instrucción de ejecución en el contexto del script: `El módulo no puede cambiarse. Cancela y crea una nueva asignación si nec...`. |
| `304` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `305` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `306` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `307` | `<!-- Ficha -->` | Instrucción de ejecución en el contexto del script: `<!-- Ficha -->`. |
| `308` | `<div class="mb-3">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="mb-3">`. |
| `309` | `<label class="form-label fw-semibold small">Ficha <span class="text-dang...` | Instrucción de ejecución en el contexto del script: `<label class="form-label fw-semibold small">Ficha <span class="text-dang...`. |
| `310` | `<select name="id_ficha" id="ea_ficha" class="form-select" required>` | Menú desplegable para selección de opciones. |
| `311` | `<option value="">-- Seleccionar ficha --</option>` | Instrucción de ejecución en el contexto del script: `<option value="">-- Seleccionar ficha --</option>`. |
| `312` | `<?php foreach ($fichas as $f): ?>` | Instrucción de ejecución en el contexto del script: `<?php foreach ($fichas as $f): ?>`. |
| `313` | `<option value="<?= $f['id_ficha'] ?>">` | Instrucción de ejecución en el contexto del script: `<option value="<?= $f['id_ficha'] ?>">`. |
| `314` | `<?= htmlspecialchars($f['numero_ficha'] . ' – ' . $f['nombre_programa']) ?>` | Instrucción de ejecución en el contexto del script: `<?= htmlspecialchars($f['numero_ficha'] . ' – ' . $f['nombre_programa']) ?>`. |
| `315` | `</option>` | Instrucción de ejecución en el contexto del script: `</option>`. |
| `316` | `<?php endforeach; ?>` | Cierre de ciclo iterativo foreach embebido en la plantilla HTML. |
| `317` | `</select>` | Instrucción de ejecución en el contexto del script: `</select>`. |
| `318` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `319` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `320` | `<!-- Solo fecha de inicio -->` | Instrucción de ejecución en el contexto del script: `<!-- Solo fecha de inicio -->`. |
| `321` | `<div class="mb-1">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="mb-1">`. |
| `322` | `<label class="form-label fw-semibold small">` | Instrucción de ejecución en el contexto del script: `<label class="form-label fw-semibold small">`. |
| `323` | `Fecha de inicio de limpieza <span class="text-danger">*</span>` | Instrucción de ejecución en el contexto del script: `Fecha de inicio de limpieza <span class="text-danger">*</span>`. |
| `324` | `</label>` | Instrucción de ejecución en el contexto del script: `</label>`. |
| `325` | `<input type="date" name="fecha_inicio" id="ea_inicio" class="form-contro...` | Campo de entrada interactivo para datos del usuario: `<input type="date" name="fecha_inicio" id="ea_inicio" class="form-contro...`. |
| `326` | `<div class="form-text" style="color:#4f46e5; font-size:.8rem;">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="form-text" style="color:#4f46e5; font-size:.8rem;">`. |
| `327` | `<i class="fas fa-rotate me-1"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-rotate me-1"></i>`. |
| `328` | `Según este día de la semana se programará la limpieza <strong>cada seman...` | Instrucción de ejecución en el contexto del script: `Según este día de la semana se programará la limpieza <strong>cada seman...`. |
| `329` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `330` | `<div class="form-text text-warning fw-semibold mt-1">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="form-text text-warning fw-semibold mt-1">`. |
| `331` | `<i class="fas fa-triangle-exclamation me-1"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-triangle-exclamation me-1"></i>`. |
| `332` | `Al guardar, los turnos anteriores se eliminarán y se regenerarán desde l...` | Instrucción de ejecución en el contexto del script: `Al guardar, los turnos anteriores se eliminarán y se regenerarán desde l...`. |
| `333` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `334` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `335` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `336` | `<div class="modal-footer px-4">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="modal-footer px-4">`. |
| `337` | `<button type="button" class="btn btn-sm btn-outline-secondary" data-bs-d...` | Botón de acción interactivo para el usuario: `<button type="button" class="btn btn-sm btn-outline-secondary" data-bs-d...`. |
| `338` | `<button type="submit" class="btn btn-sm btn-success fw-semibold px-4">` | Botón de acción interactivo para el usuario: `<button type="submit" class="btn btn-sm btn-success fw-semibold px-4">`. |
| `339` | `<i class="fas fa-save me-1"></i>Guardar cambios` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-save me-1"></i>Guardar cambios`. |
| `340` | `</button>` | Instrucción de ejecución en el contexto del script: `</button>`. |
| `341` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `342` | ``</form>`` | Cierre de formulario interactivo. |
| `343` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `344` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `345` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `346` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `347` | `<?php if ($alert): ?>` | Instrucción de ejecución en el contexto del script: `<?php if ($alert): ?>`. |
| `348` | ``<script>`` | Bloque o etiqueta de vinculación para scripts JavaScript del lado del cliente. |
| `349` | `document.addEventListener('DOMContentLoaded', function() {` | Registra un escucha de eventos del DOM para interactividad en tiempo real: `document.addEventListener('DOMContentLoaded', function() {`. |
| `350` | `Swal.fire({ icon:'<?= addslashes($alert['icon']) ?>', title:'<?= addslas...` | Despliega una alerta modal estética e interactiva con SweetAlert2. |
| `351` | `});` | Instrucción de ejecución en el contexto del script: `});`. |
| `352` | ``</script>`` | Cierre de bloque de script JavaScript. |
| `353` | `<?php endif; ?>` | Cierre de estructura condicional embebida en la plantilla HTML. |
| `354` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `355` | ``<script>`` | Bloque o etiqueta de vinculación para scripts JavaScript del lado del cliente. |
| `356` | `function confirmarCancelarAsignacion(idAsignacion) {` | Instrucción de ejecución en el contexto del script: `function confirmarCancelarAsignacion(idAsignacion) {`. |
| `357` | `Swal.fire({` | Despliega una alerta modal estética e interactiva con SweetAlert2. |
| `358` | `title:              '¿Cancelar esta asignación?',` | Instrucción de ejecución en el contexto del script: `title:              '¿Cancelar esta asignación?',`. |
| `359` | `text:               'Se eliminarán todos los turnos pendientes. Esta acc...` | Instrucción de ejecución en el contexto del script: `text:               'Se eliminarán todos los turnos pendientes. Esta acc...`. |
| `360` | `icon:               'warning',` | Instrucción de ejecución en el contexto del script: `icon:               'warning',`. |
| `361` | `showCancelButton:   true,` | Instrucción de ejecución en el contexto del script: `showCancelButton:   true,`. |
| `362` | `confirmButtonText:  'Sí, cancelar asignación',` | Instrucción de ejecución en el contexto del script: `confirmButtonText:  'Sí, cancelar asignación',`. |
| `363` | `cancelButtonText:   'No, mantener',` | Instrucción de ejecución en el contexto del script: `cancelButtonText:   'No, mantener',`. |
| `364` | `confirmButtonColor: '#ef4444',` | Instrucción de ejecución en el contexto del script: `confirmButtonColor: '#ef4444',`. |
| `365` | `cancelButtonColor:  '#6b7280',` | Instrucción de ejecución en el contexto del script: `cancelButtonColor:  '#6b7280',`. |
| `366` | `}).then(function(result) {` | Instrucción de ejecución en el contexto del script: `}).then(function(result) {`. |
| `367` | `if (result.isConfirmed) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (result.isConfirmed) {`. |
| `368` | `document.getElementById('form-cancel-' + idAsignacion).submit();` | Instrucción de ejecución en el contexto del script: `document.getElementById('form-cancel-' + idAsignacion).submit();`. |
| `369` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `370` | `});` | Instrucción de ejecución en el contexto del script: `});`. |
| `371` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `372` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `373` | `function editarModulo(m) {` | Instrucción de ejecución en el contexto del script: `function editarModulo(m) {`. |
| `374` | `document.getElementById('titModalModulo').innerHTML = '<i class="fas fa-...` | Instrucción de ejecución en el contexto del script: `document.getElementById('titModalModulo').innerHTML = '<i class="fas fa-...`. |
| `375` | `document.getElementById('id_modulo').value    = m.id_modulo;` | Instrucción de ejecución en el contexto del script: `document.getElementById('id_modulo').value    = m.id_modulo;`. |
| `376` | `document.getElementById('mod_nombre').value   = m.nombre;` | Instrucción de ejecución en el contexto del script: `document.getElementById('mod_nombre').value   = m.nombre;`. |
| `377` | `document.getElementById('mod_ubicacion').value= m.ubicacion  \|\| '';` | Instrucción de ejecución en el contexto del script: `document.getElementById('mod_ubicacion').value= m.ubicacion  \|\| '';`. |
| `378` | `document.getElementById('mod_capacidad').value= m.capacidad  \|\| '';` | Instrucción de ejecución en el contexto del script: `document.getElementById('mod_capacidad').value= m.capacidad  \|\| '';`. |
| `379` | `document.getElementById('mod_desc').value     = m.descripcion\|\| '';` | Instrucción de ejecución en el contexto del script: `document.getElementById('mod_desc').value     = m.descripcion\|\| '';`. |
| `380` | `new bootstrap.Modal(document.getElementById('modalModulo')).show();` | Instrucción de ejecución en el contexto del script: `new bootstrap.Modal(document.getElementById('modalModulo')).show();`. |
| `381` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `382` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `383` | `document.getElementById('modalModulo').addEventListener('hidden.bs.modal...` | Registra un escucha de eventos del DOM para interactividad en tiempo real: `document.getElementById('modalModulo').addEventListener('hidden.bs.modal...`. |
| `384` | `document.getElementById('id_modulo').value     = '';` | Instrucción de ejecución en el contexto del script: `document.getElementById('id_modulo').value     = '';`. |
| `385` | `document.getElementById('mod_nombre').value    = '';` | Instrucción de ejecución en el contexto del script: `document.getElementById('mod_nombre').value    = '';`. |
| `386` | `document.getElementById('mod_ubicacion').value = '';` | Instrucción de ejecución en el contexto del script: `document.getElementById('mod_ubicacion').value = '';`. |
| `387` | `document.getElementById('mod_capacidad').value = '';` | Instrucción de ejecución en el contexto del script: `document.getElementById('mod_capacidad').value = '';`. |
| `388` | `document.getElementById('mod_desc').value      = '';` | Instrucción de ejecución en el contexto del script: `document.getElementById('mod_desc').value      = '';`. |
| `389` | `document.getElementById('titModalModulo').innerHTML = '<i class="fas fa-...` | Instrucción de ejecución en el contexto del script: `document.getElementById('titModalModulo').innerHTML = '<i class="fas fa-...`. |
| `390` | `});` | Instrucción de ejecución en el contexto del script: `});`. |
| `391` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `392` | `function abrirEditarAsignacion(a) {` | Instrucción de ejecución en el contexto del script: `function abrirEditarAsignacion(a) {`. |
| `393` | `document.getElementById('ea_id').value     = a.id_asignacion;` | Instrucción de ejecución en el contexto del script: `document.getElementById('ea_id').value     = a.id_asignacion;`. |
| `394` | `document.getElementById('ea_modulo').value = a.nombre_modulo;` | Instrucción de ejecución en el contexto del script: `document.getElementById('ea_modulo').value = a.nombre_modulo;`. |
| `395` | `document.getElementById('ea_ficha').value  = a.id_ficha;` | Instrucción de ejecución en el contexto del script: `document.getElementById('ea_ficha').value  = a.id_ficha;`. |
| `396` | `document.getElementById('ea_inicio').value = a.fecha_inicio;` | Instrucción de ejecución en el contexto del script: `document.getElementById('ea_inicio').value = a.fecha_inicio;`. |
| `397` | `new bootstrap.Modal(document.getElementById('modalEditarAsig')).show();` | Instrucción de ejecución en el contexto del script: `new bootstrap.Modal(document.getElementById('modalEditarAsig')).show();`. |
| `398` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `399` | ``</script>`` | Cierre de bloque de script JavaScript. |
| `400` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `401` | ``<style>`` | Bloque de estilos CSS personalizados para la interfaz. |
| `402` | `.rounded-top-0 { border-top-left-radius:0!important; border-top-right-ra...` | Instrucción de ejecución en el contexto del script: `.rounded-top-0 { border-top-left-radius:0!important; border-top-right-ra...`. |
| `403` | `.nav-tabs .nav-link { font-size:.875rem; color:#64748b; }` | Instrucción de ejecución en el contexto del script: `.nav-tabs .nav-link { font-size:.875rem; color:#64748b; }`. |
| `404` | `.nav-tabs .nav-link.active { color:#39a900; font-weight:600; }` | Instrucción de ejecución en el contexto del script: `.nav-tabs .nav-link.active { color:#39a900; font-weight:600; }`. |
| `405` | ``</style>`` | Cierre de bloque de estilos CSS. |
| `406` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `407` | `<?php require_once __DIR__ . '/../layouts/footer.php'; ?>` | Importación e inclusión obligatoria del archivo de dependencia requerido: `<?php require_once __DIR__ . '/../layouts/footer.php'; ?>`. |

---

## 3. Resumen y Flujo de Interacción

El archivo `admin_modulos.php` cumple un rol indispensable en `views/dashboard/admin_modulos.php`. 
Interfaz para crear y administrar los ambientes o módulos físicos del centro y vincularlos con las fichas. Garantiza la robustez, el orden y la estabilidad de la arquitectura del proyecto `systemLimpieza`.

---

Generado automáticamente para el repositorio [johanrepizo/LimpiezaDeModulos](https://github.com/johanrepizo/LimpiezaDeModulos).
