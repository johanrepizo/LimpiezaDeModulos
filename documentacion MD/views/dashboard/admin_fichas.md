# Documentación Línea por Línea: `views/dashboard/admin_fichas.php`

## 1. Ficha Técnica del Archivo

- **Archivo:** `admin_fichas.php`
- **Ruta en el proyecto:** `views/dashboard/admin_fichas.php`
- **Cantidad total de líneas:** `251`
- **Tipo de archivo:** `PHP`
- **Propósito general:** Interfaz de administración para listar, registrar, editar y asignar voceros a las fichas de formación.

---

## 2. Explicación Detallada Línea por Línea

A continuación se presenta cada línea de código numerada de forma consecutiva, acompañada de su fragmento exacto y la explicación exhaustiva de su funcionamiento y responsabilidad en el sistema:

| Línea | Código Fuente | Explicación Detallada |
|---|---|---|
| `1` | ``<?php`` | Apertura obligatoria de la etiqueta PHP para ejecución del código del lado del servidor. |
| `2` | `$titulo = 'Fichas';` | Instrucción de ejecución en el contexto del script: `$titulo = 'Fichas';`. |
| `3` | `if (session_status() === PHP_SESSION_NONE) session_start();` | Inicia o reanuda la sesión PHP del usuario si no se encontraba activa previamente. |
| `4` | `if (!isset($_SESSION['usuario']) \|\| (int)$_SESSION['usuario']['rol'] !...` | Verifica autenticación y rol del usuario; redirige al login si no tiene permisos. |
| `5` | `header("Location: ../usuarios/login.php"); exit;` | Emite cabecera HTTP de redirección en el navegador y detiene la ejecución: `header("Location: ../usuarios/login.php"); exit;`. |
| `6` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `7` | `require_once __DIR__ . '/../../config/database.php';` | Importación e inclusión obligatoria del archivo de dependencia requerido: `require_once __DIR__ . '/../../config/database.php';`. |
| `8` | `require_once __DIR__ . '/../../models/Ficha.php';` | Importación e inclusión obligatoria del archivo de dependencia requerido: `require_once __DIR__ . '/../../models/Ficha.php';`. |
| `9` | `require_once __DIR__ . '/../../models/Programa.php';` | Importación e inclusión obligatoria del archivo de dependencia requerido: `require_once __DIR__ . '/../../models/Programa.php';`. |
| `10` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `11` | `$db       = (new Database())->conectar();` | Instrucción de ejecución en el contexto del script: `$db       = (new Database())->conectar();`. |
| `12` | `$fichas   = (new Ficha($db))->obtenerTodas();` | Instrucción de ejecución en el contexto del script: `$fichas   = (new Ficha($db))->obtenerTodas();`. |
| `13` | `$programas = (new Programa($db))->obtenerTodos();` | Instrucción de ejecución en el contexto del script: `$programas = (new Programa($db))->obtenerTodos();`. |
| `14` | `$alert    = $_SESSION['alert'] ?? null;` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección. |
| `15` | `unset($_SESSION['alert']);` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección. |
| `16` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `17` | `// Detalle de ficha solicitado` | Comentario explicativo en el código: `Detalle de ficha solicitado`. |
| `18` | `$fichaDetalle   = null;` | Instrucción de ejecución en el contexto del script: `$fichaDetalle   = null;`. |
| `19` | `$aprendicesDet  = [];` | Instrucción de ejecución en el contexto del script: `$aprendicesDet  = [];`. |
| `20` | `if (!empty($_GET['ficha'])) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (!empty($_GET['ficha'])) {`. |
| `21` | `$fichaModel   = new Ficha($db);` | Instrucción de ejecución en el contexto del script: `$fichaModel   = new Ficha($db);`. |
| `22` | `$fichaDetalle = $fichaModel->obtenerPorId((int)$_GET['ficha']);` | Instrucción de ejecución en el contexto del script: `$fichaDetalle = $fichaModel->obtenerPorId((int)$_GET['ficha']);`. |
| `23` | `if ($fichaDetalle) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if ($fichaDetalle) {`. |
| `24` | `$aprendicesDet = $fichaModel->obtenerAprendicesDeFicha((int)$_GET['ficha...` | Instrucción de ejecución en el contexto del script: `$aprendicesDet = $fichaModel->obtenerAprendicesDeFicha((int)$_GET['ficha...`. |
| `25` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `26` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `27` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `28` | `require_once __DIR__ . '/../layouts/header.php';` | Importación e inclusión obligatoria del archivo de dependencia requerido: `require_once __DIR__ . '/../layouts/header.php';`. |
| `29` | ``?>`` | Cierre de la etiqueta PHP para alternar a salida HTML o fin del archivo. |
| `30` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `31` | `<div class="d-flex justify-content-between align-items-center mb-4">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="d-flex justify-content-between align-items-center mb-4">`. |
| `32` | `<div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div>`. |
| `33` | `<h4 class="fw-bold mb-0"><i class="fas fa-id-card text-success me-2"></i...` | Instrucción de ejecución en el contexto del script: `<h4 class="fw-bold mb-0"><i class="fas fa-id-card text-success me-2"></i...`. |
| `34` | `<p class="text-muted small mb-0">Gestiona las fichas del centro de forma...` | Instrucción de ejecución en el contexto del script: `<p class="text-muted small mb-0">Gestiona las fichas del centro de forma...`. |
| `35` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `36` | `<button class="btn btn-success btn-sm fw-semibold" data-bs-toggle="modal...` | Botón de acción interactivo para el usuario: `<button class="btn btn-success btn-sm fw-semibold" data-bs-toggle="modal...`. |
| `37` | `<i class="fas fa-plus me-1"></i> Nueva Ficha` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-plus me-1"></i> Nueva Ficha`. |
| `38` | `</button>` | Instrucción de ejecución en el contexto del script: `</button>`. |
| `39` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `40` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `41` | `<!-- Buscador -->` | Instrucción de ejecución en el contexto del script: `<!-- Buscador -->`. |
| `42` | `<div class="card shadow-sm mb-3">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="card shadow-sm mb-3">`. |
| `43` | `<div class="card-body py-2">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="card-body py-2">`. |
| `44` | `<div class="input-group input-group-sm" style="max-width:380px;">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="input-group input-group-sm" style="max-width:380px;">`. |
| `45` | `<span class="input-group-text bg-white"><i class="fas fa-search text-mut...` | Instrucción de ejecución en el contexto del script: `<span class="input-group-text bg-white"><i class="fas fa-search text-mut...`. |
| `46` | `<input type="text" id="buscador" class="form-control border-start-0"` | Campo de entrada interactivo para datos del usuario: `<input type="text" id="buscador" class="form-control border-start-0"`. |
| `47` | `placeholder="Buscar por número de ficha o programa…">` | Instrucción de ejecución en el contexto del script: `placeholder="Buscar por número de ficha o programa…">`. |
| `48` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `49` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `50` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `51` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `52` | `<div class="card shadow-sm">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="card shadow-sm">`. |
| `53` | `<div class="card-body p-0">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="card-body p-0">`. |
| `54` | `<div class="table-responsive">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="table-responsive">`. |
| `55` | `<table class="table tabla-limpia align-middle mb-0" id="tblFichas">` | Tabla de datos para despliegue estructurado de información. |
| `56` | `<thead class="table-light">` | Definición de estructura semántica de cabecera o cuerpo de tabla. |
| `57` | ``<tr>`` | Fila contenedora de datos dentro de la tabla. |
| `58` | `<th>N° Ficha</th>` | Celda de encabezado de columna: `<th>N° Ficha</th>`. |
| `59` | `<th>Programa</th>` | Celda de encabezado de columna: `<th>Programa</th>`. |
| `60` | `<th>Jornada</th>` | Celda de encabezado de columna: `<th>Jornada</th>`. |
| `61` | `<th>Aprendices</th>` | Celda de encabezado de columna: `<th>Aprendices</th>`. |
| `62` | `<th>Vocero</th>` | Celda de encabezado de columna: `<th>Vocero</th>`. |
| `63` | `<th>Estado</th>` | Celda de encabezado de columna: `<th>Estado</th>`. |
| `64` | `<th>Acciones</th>` | Celda de encabezado de columna: `<th>Acciones</th>`. |
| `65` | ``</tr>`` | Cierre de fila contenedora de tabla. |
| `66` | `</thead>` | Definición de estructura semántica de cabecera o cuerpo de tabla. |
| `67` | `<tbody>` | Definición de estructura semántica de cabecera o cuerpo de tabla. |
| `68` | `<?php foreach ($fichas as $f): ?>` | Instrucción de ejecución en el contexto del script: `<?php foreach ($fichas as $f): ?>`. |
| `69` | ``<tr>`` | Fila contenedora de datos dentro de la tabla. |
| `70` | `<td>` | Celda de contenido de tabla: `<td>`. |
| `71` | `<a href="?ficha=<?= $f['id_ficha'] ?>"` | Instrucción de ejecución en el contexto del script: `<a href="?ficha=<?= $f['id_ficha'] ?>"`. |
| `72` | `class="fw-bold text-decoration-none text-success font-monospace">` | Instrucción de ejecución en el contexto del script: `class="fw-bold text-decoration-none text-success font-monospace">`. |
| `73` | `<?= htmlspecialchars($f['numero_ficha']) ?>` | Instrucción de ejecución en el contexto del script: `<?= htmlspecialchars($f['numero_ficha']) ?>`. |
| `74` | `</a>` | Instrucción de ejecución en el contexto del script: `</a>`. |
| `75` | `</td>` | Instrucción de ejecución en el contexto del script: `</td>`. |
| `76` | `<td class="small"><?= htmlspecialchars(substr($f['nombre_programa'], 0, ...` | Celda de contenido de tabla: `<td class="small"><?= htmlspecialchars(substr($f['nombre_programa'], 0, ...`. |
| `77` | `<td><span class="badge bg-light text-dark border"><?= htmlspecialchars($...` | Celda de contenido de tabla: `<td><span class="badge bg-light text-dark border"><?= htmlspecialchars($...`. |
| `78` | `<td class="small"><?= (int)$f['total_aprendices'] ?></td>` | Celda de contenido de tabla: `<td class="small"><?= (int)$f['total_aprendices'] ?></td>`. |
| `79` | `<td class="small">` | Celda de contenido de tabla: `<td class="small">`. |
| `80` | `<?php if ($f['vocero_nombres']): ?>` | Instrucción de ejecución en el contexto del script: `<?php if ($f['vocero_nombres']): ?>`. |
| `81` | `<?= htmlspecialchars($f['vocero_nombres'] . ' ' . $f['vocero_apellidos']...` | Instrucción de ejecución en el contexto del script: `<?= htmlspecialchars($f['vocero_nombres'] . ' ' . $f['vocero_apellidos']...`. |
| `82` | `<?php else: ?>` | Instrucción de ejecución en el contexto del script: `<?php else: ?>`. |
| `83` | `<span class="text-muted">Sin asignar</span>` | Instrucción de ejecución en el contexto del script: `<span class="text-muted">Sin asignar</span>`. |
| `84` | `<?php endif; ?>` | Cierre de estructura condicional embebida en la plantilla HTML. |
| `85` | `</td>` | Instrucción de ejecución en el contexto del script: `</td>`. |
| `86` | `<td><span class="badge <?= $f['activo'] ? 'bg-success' : 'bg-secondary' ...` | Celda de contenido de tabla: `<td><span class="badge <?= $f['activo'] ? 'bg-success' : 'bg-secondary' ...`. |
| `87` | `<td>` | Celda de contenido de tabla: `<td>`. |
| `88` | `<div class="d-flex gap-1">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="d-flex gap-1">`. |
| `89` | `<button class="btn btn-sm btn-outline-primary"` | Botón de acción interactivo para el usuario: `<button class="btn btn-sm btn-outline-primary"`. |
| `90` | `onclick='editarFicha(<?= json_encode($f) ?>)' title="Editar">` | Instrucción de ejecución en el contexto del script: `onclick='editarFicha(<?= json_encode($f) ?>)' title="Editar">`. |
| `91` | `<i class="fas fa-pen"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-pen"></i>`. |
| `92` | `</button>` | Instrucción de ejecución en el contexto del script: `</button>`. |
| `93` | `<a href="?ficha=<?= $f['id_ficha'] ?>" class="btn btn-sm btn-outline-suc...` | Instrucción de ejecución en el contexto del script: `<a href="?ficha=<?= $f['id_ficha'] ?>" class="btn btn-sm btn-outline-suc...`. |
| `94` | `<i class="fas fa-users"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-users"></i>`. |
| `95` | `</a>` | Instrucción de ejecución en el contexto del script: `</a>`. |
| `96` | `<form action="../../controllers/AdminController.php" method="POST" class...` | Formulario interactivo para captura y envío de datos: `<form action="../../controllers/AdminController.php" method="POST" class...`. |
| `97` | `<input type="hidden" name="accion"    value="eliminar_ficha">` | Campo de entrada interactivo para datos del usuario: `<input type="hidden" name="accion"    value="eliminar_ficha">`. |
| `98` | `<input type="hidden" name="id_ficha"  value="<?= $f['id_ficha'] ?>">` | Campo de entrada interactivo para datos del usuario: `<input type="hidden" name="id_ficha"  value="<?= $f['id_ficha'] ?>">`. |
| `99` | `<button type="submit" class="btn btn-sm btn-outline-danger"` | Botón de acción interactivo para el usuario: `<button type="submit" class="btn btn-sm btn-outline-danger"`. |
| `100` | `onclick="return confirm('¿Eliminar esta ficha?')">` | Instrucción de ejecución en el contexto del script: `onclick="return confirm('¿Eliminar esta ficha?')">`. |
| `101` | `<i class="fas fa-trash"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-trash"></i>`. |
| `102` | `</button>` | Instrucción de ejecución en el contexto del script: `</button>`. |
| `103` | ``</form>`` | Cierre de formulario interactivo. |
| `104` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `105` | `</td>` | Instrucción de ejecución en el contexto del script: `</td>`. |
| `106` | ``</tr>`` | Cierre de fila contenedora de tabla. |
| `107` | `<?php endforeach; ?>` | Cierre de ciclo iterativo foreach embebido en la plantilla HTML. |
| `108` | `<?php if (empty($fichas)): ?>` | Instrucción de ejecución en el contexto del script: `<?php if (empty($fichas)): ?>`. |
| `109` | ``<tr>`` | Fila contenedora de datos dentro de la tabla. |
| `110` | `<?php endif; ?>` | Cierre de estructura condicional embebida en la plantilla HTML. |
| `111` | `</tbody>` | Definición de estructura semántica de cabecera o cuerpo de tabla. |
| `112` | ``</table>`` | Cierre de tabla de datos. |
| `113` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `114` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `115` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `116` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `117` | `<!-- Panel de aprendices de la ficha seleccionada -->` | Instrucción de ejecución en el contexto del script: `<!-- Panel de aprendices de la ficha seleccionada -->`. |
| `118` | `<?php if ($fichaDetalle): ?>` | Instrucción de ejecución en el contexto del script: `<?php if ($fichaDetalle): ?>`. |
| `119` | `<div class="card shadow-sm mt-4" style="border-top:3px solid #39a900;">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="card shadow-sm mt-4" style="border-top:3px solid #39a900;">`. |
| `120` | `<div class="card-header bg-white border-0 py-3 d-flex justify-content-be...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="card-header bg-white border-0 py-3 d-flex justify-content-be...`. |
| `121` | `<h6 class="fw-bold mb-0">` | Instrucción de ejecución en el contexto del script: `<h6 class="fw-bold mb-0">`. |
| `122` | `<i class="fas fa-users text-success me-2"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-users text-success me-2"></i>`. |
| `123` | `Aprendices – Ficha <span class="font-monospace"><?= htmlspecialchars($fi...` | Instrucción de ejecución en el contexto del script: `Aprendices – Ficha <span class="font-monospace"><?= htmlspecialchars($fi...`. |
| `124` | `<span class="text-muted fw-normal small ms-2"><?= htmlspecialchars($fich...` | Instrucción de ejecución en el contexto del script: `<span class="text-muted fw-normal small ms-2"><?= htmlspecialchars($fich...`. |
| `125` | `</h6>` | Instrucción de ejecución en el contexto del script: `</h6>`. |
| `126` | `<div class="d-flex gap-2 align-items-center">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="d-flex gap-2 align-items-center">`. |
| `127` | `<span class="badge bg-success"><?= count($aprendicesDet) ?> aprendice(s)...` | Instrucción de ejecución en el contexto del script: `<span class="badge bg-success"><?= count($aprendicesDet) ?> aprendice(s)...`. |
| `128` | `<a href="admin_fichas.php" class="btn btn-sm btn-outline-secondary">` | Instrucción de ejecución en el contexto del script: `<a href="admin_fichas.php" class="btn btn-sm btn-outline-secondary">`. |
| `129` | `<i class="fas fa-times"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-times"></i>`. |
| `130` | `</a>` | Instrucción de ejecución en el contexto del script: `</a>`. |
| `131` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `132` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `133` | `<div class="card-body p-0">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="card-body p-0">`. |
| `134` | `<?php if (empty($aprendicesDet)): ?>` | Instrucción de ejecución en el contexto del script: `<?php if (empty($aprendicesDet)): ?>`. |
| `135` | `<div class="text-center py-5 text-muted small">Sin aprendices sincroniza...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="text-center py-5 text-muted small">Sin aprendices sincroniza...`. |
| `136` | `<?php else: ?>` | Instrucción de ejecución en el contexto del script: `<?php else: ?>`. |
| `137` | `<div class="p-3">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="p-3">`. |
| `138` | `<input type="text" id="buscAp" class="form-control form-control-sm mb-3"` | Campo de entrada interactivo para datos del usuario: `<input type="text" id="buscAp" class="form-control form-control-sm mb-3"`. |
| `139` | `style="max-width:300px;" placeholder="Buscar aprendiz…">` | Instrucción de ejecución en el contexto del script: `style="max-width:300px;" placeholder="Buscar aprendiz…">`. |
| `140` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `141` | `<div class="table-responsive">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="table-responsive">`. |
| `142` | `<table class="table tabla-limpia align-middle mb-0" id="tblApDet">` | Tabla de datos para despliegue estructurado de información. |
| `143` | `<thead class="table-light">` | Definición de estructura semántica de cabecera o cuerpo de tabla. |
| `144` | ``<tr>`` | Fila contenedora de datos dentro de la tabla. |
| `145` | `</thead>` | Definición de estructura semántica de cabecera o cuerpo de tabla. |
| `146` | `<tbody>` | Definición de estructura semántica de cabecera o cuerpo de tabla. |
| `147` | `<?php foreach ($aprendicesDet as $i => $ap): ?>` | Instrucción de ejecución en el contexto del script: `<?php foreach ($aprendicesDet as $i => $ap): ?>`. |
| `148` | ``<tr>`` | Fila contenedora de datos dentro de la tabla. |
| `149` | `<td class="text-muted small"><?= $i + 1 ?></td>` | Celda de contenido de tabla: `<td class="text-muted small"><?= $i + 1 ?></td>`. |
| `150` | `<td class="fw-semibold small"><?= htmlspecialchars($ap['apellidos']) ?><...` | Celda de contenido de tabla: `<td class="fw-semibold small"><?= htmlspecialchars($ap['apellidos']) ?><...`. |
| `151` | `<td class="small"><?= htmlspecialchars($ap['nombres']) ?></td>` | Celda de contenido de tabla: `<td class="small"><?= htmlspecialchars($ap['nombres']) ?></td>`. |
| `152` | `<td class="small text-muted"><?= htmlspecialchars($ap['documento'] ?? '—...` | Celda de contenido de tabla: `<td class="small text-muted"><?= htmlspecialchars($ap['documento'] ?? '—...`. |
| `153` | ``</tr>`` | Cierre de fila contenedora de tabla. |
| `154` | `<?php endforeach; ?>` | Cierre de ciclo iterativo foreach embebido en la plantilla HTML. |
| `155` | `</tbody>` | Definición de estructura semántica de cabecera o cuerpo de tabla. |
| `156` | ``</table>`` | Cierre de tabla de datos. |
| `157` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `158` | `<?php endif; ?>` | Cierre de estructura condicional embebida en la plantilla HTML. |
| `159` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `160` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `161` | `<?php endif; ?>` | Cierre de estructura condicional embebida en la plantilla HTML. |
| `162` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `163` | `<!-- Modal Ficha -->` | Instrucción de ejecución en el contexto del script: `<!-- Modal Ficha -->`. |
| `164` | `<div class="modal fade" id="modalFicha" tabindex="-1" aria-hidden="true">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="modal fade" id="modalFicha" tabindex="-1" aria-hidden="true">`. |
| `165` | `<div class="modal-dialog modal-dialog-centered">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="modal-dialog modal-dialog-centered">`. |
| `166` | `<div class="modal-content shadow">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="modal-content shadow">`. |
| `167` | `<div class="modal-header" style="background:#0f2200; color:#fff;">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="modal-header" style="background:#0f2200; color:#fff;">`. |
| `168` | `<h6 class="modal-title fw-bold" id="titModalFicha">` | Instrucción de ejecución en el contexto del script: `<h6 class="modal-title fw-bold" id="titModalFicha">`. |
| `169` | `<i class="fas fa-id-card me-2 text-success"></i>Nueva Ficha` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-id-card me-2 text-success"></i>Nueva Ficha`. |
| `170` | `</h6>` | Instrucción de ejecución en el contexto del script: `</h6>`. |
| `171` | `<button type="button" class="btn-close btn-close-white" data-bs-dismiss=...` | Botón de acción interactivo para el usuario: `<button type="button" class="btn-close btn-close-white" data-bs-dismiss=...`. |
| `172` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `173` | `<form action="../../controllers/AdminController.php" method="POST">` | Formulario interactivo para captura y envío de datos: `<form action="../../controllers/AdminController.php" method="POST">`. |
| `174` | `<input type="hidden" name="accion"    value="guardar_ficha">` | Campo de entrada interactivo para datos del usuario: `<input type="hidden" name="accion"    value="guardar_ficha">`. |
| `175` | `<input type="hidden" name="id_ficha"  id="id_ficha" value="">` | Campo de entrada interactivo para datos del usuario: `<input type="hidden" name="id_ficha"  id="id_ficha" value="">`. |
| `176` | `<div class="modal-body px-4 py-4">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="modal-body px-4 py-4">`. |
| `177` | `<div class="mb-3">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="mb-3">`. |
| `178` | `<label class="form-label fw-semibold small">Programa de Formación <span ...` | Instrucción de ejecución en el contexto del script: `<label class="form-label fw-semibold small">Programa de Formación <span ...`. |
| `179` | `<select name="id_programa" id="fic_prog" class="form-select" required>` | Menú desplegable para selección de opciones. |
| `180` | `<option value="">-- Seleccionar --</option>` | Instrucción de ejecución en el contexto del script: `<option value="">-- Seleccionar --</option>`. |
| `181` | `<?php foreach ($programas as $p): ?>` | Instrucción de ejecución en el contexto del script: `<?php foreach ($programas as $p): ?>`. |
| `182` | `<option value="<?= $p['id_programa'] ?>"><?= htmlspecialchars($p['nombre...` | Instrucción de ejecución en el contexto del script: `<option value="<?= $p['id_programa'] ?>"><?= htmlspecialchars($p['nombre...`. |
| `183` | `<?php endforeach; ?>` | Cierre de ciclo iterativo foreach embebido en la plantilla HTML. |
| `184` | `</select>` | Instrucción de ejecución en el contexto del script: `</select>`. |
| `185` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `186` | `<div class="mb-3">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="mb-3">`. |
| `187` | `<label class="form-label fw-semibold small">Número de Ficha <span class=...` | Instrucción de ejecución en el contexto del script: `<label class="form-label fw-semibold small">Número de Ficha <span class=...`. |
| `188` | `<input type="text" name="numero_ficha" id="fic_num" class="form-control"...` | Campo de entrada interactivo para datos del usuario: `<input type="text" name="numero_ficha" id="fic_num" class="form-control"...`. |
| `189` | `placeholder="Ej: 2795681">` | Instrucción de ejecución en el contexto del script: `placeholder="Ej: 2795681">`. |
| `190` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `191` | `<div class="row g-3">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="row g-3">`. |
| `192` | `<div class="col-6">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="col-6">`. |
| `193` | `<label class="form-label fw-semibold small">Jornada</label>` | Instrucción de ejecución en el contexto del script: `<label class="form-label fw-semibold small">Jornada</label>`. |
| `194` | `<select name="jornada" id="fic_jornada" class="form-select">` | Menú desplegable para selección de opciones. |
| `195` | `<option value="Diurna">Diurna</option>` | Instrucción de ejecución en el contexto del script: `<option value="Diurna">Diurna</option>`. |
| `196` | `<option value="Nocturna">Nocturna</option>` | Instrucción de ejecución en el contexto del script: `<option value="Nocturna">Nocturna</option>`. |
| `197` | `<option value="Mixta">Mixta</option>` | Instrucción de ejecución en el contexto del script: `<option value="Mixta">Mixta</option>`. |
| `198` | `</select>` | Instrucción de ejecución en el contexto del script: `</select>`. |
| `199` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `200` | `<div class="col-6">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="col-6">`. |
| `201` | `<label class="form-label fw-semibold small">N° Aprendices</label>` | Instrucción de ejecución en el contexto del script: `<label class="form-label fw-semibold small">N° Aprendices</label>`. |
| `202` | `<input type="number" name="num_aprendices" id="fic_apren" class="form-co...` | Campo de entrada interactivo para datos del usuario: `<input type="number" name="num_aprendices" id="fic_apren" class="form-co...`. |
| `203` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `204` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `205` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `206` | `<div class="modal-footer px-4">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="modal-footer px-4">`. |
| `207` | `<button type="button" class="btn btn-sm btn-outline-secondary" data-bs-d...` | Botón de acción interactivo para el usuario: `<button type="button" class="btn btn-sm btn-outline-secondary" data-bs-d...`. |
| `208` | `<button type="submit" class="btn btn-sm btn-success fw-semibold px-4"><i...` | Botón de acción interactivo para el usuario: `<button type="submit" class="btn btn-sm btn-success fw-semibold px-4"><i...`. |
| `209` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `210` | ``</form>`` | Cierre de formulario interactivo. |
| `211` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `212` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `213` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `214` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `215` | `<?php if ($alert): ?>` | Instrucción de ejecución en el contexto del script: `<?php if ($alert): ?>`. |
| `216` | ``<script>`` | Bloque o etiqueta de vinculación para scripts JavaScript del lado del cliente. |
| `217` | `document.addEventListener('DOMContentLoaded', function() {` | Registra un escucha de eventos del DOM para interactividad en tiempo real: `document.addEventListener('DOMContentLoaded', function() {`. |
| `218` | `Swal.fire({ icon:'<?= addslashes($alert['icon']) ?>', title:'<?= addslas...` | Despliega una alerta modal estética e interactiva con SweetAlert2. |
| `219` | `});` | Instrucción de ejecución en el contexto del script: `});`. |
| `220` | ``</script>`` | Cierre de bloque de script JavaScript. |
| `221` | `<?php endif; ?>` | Cierre de estructura condicional embebida en la plantilla HTML. |
| `222` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `223` | ``<script>`` | Bloque o etiqueta de vinculación para scripts JavaScript del lado del cliente. |
| `224` | `document.getElementById('buscador').addEventListener('input', function() {` | Registra un escucha de eventos del DOM para interactividad en tiempo real: `document.getElementById('buscador').addEventListener('input', function() {`. |
| `225` | `const q = this.value.toLowerCase();` | Instrucción de ejecución en el contexto del script: `const q = this.value.toLowerCase();`. |
| `226` | `document.querySelectorAll('#tblFichas tbody tr').forEach(tr => {` | Instrucción de ejecución en el contexto del script: `document.querySelectorAll('#tblFichas tbody tr').forEach(tr => {`. |
| `227` | `tr.style.display = !q \|\| tr.textContent.toLowerCase().includes(q) ? ''...` | Instrucción de ejecución en el contexto del script: `tr.style.display = !q \|\| tr.textContent.toLowerCase().includes(q) ? ''...`. |
| `228` | `});` | Instrucción de ejecución en el contexto del script: `});`. |
| `229` | `});` | Instrucción de ejecución en el contexto del script: `});`. |
| `230` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `231` | `<?php if ($fichaDetalle): ?>` | Instrucción de ejecución en el contexto del script: `<?php if ($fichaDetalle): ?>`. |
| `232` | `document.getElementById('buscAp').addEventListener('input', function() {` | Registra un escucha de eventos del DOM para interactividad en tiempo real: `document.getElementById('buscAp').addEventListener('input', function() {`. |
| `233` | `const q = this.value.toLowerCase();` | Instrucción de ejecución en el contexto del script: `const q = this.value.toLowerCase();`. |
| `234` | `document.querySelectorAll('#tblApDet tbody tr').forEach(tr => {` | Instrucción de ejecución en el contexto del script: `document.querySelectorAll('#tblApDet tbody tr').forEach(tr => {`. |
| `235` | `tr.style.display = !q \|\| tr.textContent.toLowerCase().includes(q) ? ''...` | Instrucción de ejecución en el contexto del script: `tr.style.display = !q \|\| tr.textContent.toLowerCase().includes(q) ? ''...`. |
| `236` | `});` | Instrucción de ejecución en el contexto del script: `});`. |
| `237` | `});` | Instrucción de ejecución en el contexto del script: `});`. |
| `238` | `<?php endif; ?>` | Cierre de estructura condicional embebida en la plantilla HTML. |
| `239` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `240` | `function editarFicha(f) {` | Instrucción de ejecución en el contexto del script: `function editarFicha(f) {`. |
| `241` | `document.getElementById('titModalFicha').innerHTML = '<i class="fas fa-p...` | Instrucción de ejecución en el contexto del script: `document.getElementById('titModalFicha').innerHTML = '<i class="fas fa-p...`. |
| `242` | `document.getElementById('id_ficha').value     = f.id_ficha;` | Instrucción de ejecución en el contexto del script: `document.getElementById('id_ficha').value     = f.id_ficha;`. |
| `243` | `document.getElementById('fic_prog').value     = f.id_programa;` | Instrucción de ejecución en el contexto del script: `document.getElementById('fic_prog').value     = f.id_programa;`. |
| `244` | `document.getElementById('fic_num').value      = f.numero_ficha;` | Instrucción de ejecución en el contexto del script: `document.getElementById('fic_num').value      = f.numero_ficha;`. |
| `245` | `document.getElementById('fic_jornada').value  = f.jornada;` | Instrucción de ejecución en el contexto del script: `document.getElementById('fic_jornada').value  = f.jornada;`. |
| `246` | `document.getElementById('fic_apren').value    = f.num_aprendices \|\| '';` | Instrucción de ejecución en el contexto del script: `document.getElementById('fic_apren').value    = f.num_aprendices \|\| '';`. |
| `247` | `new bootstrap.Modal(document.getElementById('modalFicha')).show();` | Instrucción de ejecución en el contexto del script: `new bootstrap.Modal(document.getElementById('modalFicha')).show();`. |
| `248` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `249` | ``</script>`` | Cierre de bloque de script JavaScript. |
| `250` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `251` | `<?php require_once __DIR__ . '/../layouts/footer.php'; ?>` | Importación e inclusión obligatoria del archivo de dependencia requerido: `<?php require_once __DIR__ . '/../layouts/footer.php'; ?>`. |

---

## 3. Resumen y Flujo de Interacción

El archivo `admin_fichas.php` cumple un rol indispensable en `views/dashboard/admin_fichas.php`. 
Interfaz de administración para listar, registrar, editar y asignar voceros a las fichas de formación. Garantiza la robustez, el orden y la estabilidad de la arquitectura del proyecto `systemLimpieza`.

---

Generado automáticamente para el repositorio [johanrepizo/LimpiezaDeModulos](https://github.com/johanrepizo/LimpiezaDeModulos).
