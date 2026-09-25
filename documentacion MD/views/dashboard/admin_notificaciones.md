# Documentación Línea por Línea: `views/dashboard/admin_notificaciones.php`

## 1. Ficha Técnica del Archivo

- **Archivo:** `admin_notificaciones.php`
- **Ruta en el proyecto:** `views/dashboard/admin_notificaciones.php`
- **Cantidad total de líneas:** `133`
- **Tipo de archivo:** `PHP`
- **Propósito general:** Bandeja de notificaciones y alertas de incumplimiento recibidas por los administradores.

---

## 2. Explicación Detallada Línea por Línea

A continuación se presenta cada línea de código numerada de forma consecutiva, acompañada de su fragmento exacto y la explicación exhaustiva de su funcionamiento y responsabilidad en el sistema:

| Línea | Código Fuente | Explicación Detallada |
|---|---|---|
| `1` | ``<?php`` | Apertura obligatoria de la etiqueta PHP para ejecución del código del lado del servidor. |
| `2` | `$titulo = 'Notificaciones';` | Instrucción de ejecución en el contexto del script: `$titulo = 'Notificaciones';`. |
| `3` | `if (session_status() === PHP_SESSION_NONE) session_start();` | Inicia o reanuda la sesión PHP del usuario si no se encontraba activa previamente. |
| `4` | `if (!isset($_SESSION['usuario']) \|\| (int)$_SESSION['usuario']['rol'] !...` | Verifica autenticación y rol del usuario; redirige al login si no tiene permisos. |
| `5` | `header("Location: ../usuarios/login.php"); exit;` | Emite cabecera HTTP de redirección en el navegador y detiene la ejecución: `header("Location: ../usuarios/login.php"); exit;`. |
| `6` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `7` | `require_once __DIR__ . '/../../config/database.php';` | Importación e inclusión obligatoria del archivo de dependencia requerido: `require_once __DIR__ . '/../../config/database.php';`. |
| `8` | `require_once __DIR__ . '/../../models/Notificacion.php';` | Importación e inclusión obligatoria del archivo de dependencia requerido: `require_once __DIR__ . '/../../models/Notificacion.php';`. |
| `9` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `10` | `$db        = (new Database())->conectar();` | Instrucción de ejecución en el contexto del script: `$db        = (new Database())->conectar();`. |
| `11` | `$idUsuario = (int)$_SESSION['usuario']['id_usuario'];` | Instrucción de ejecución en el contexto del script: `$idUsuario = (int)$_SESSION['usuario']['id_usuario'];`. |
| `12` | `$model     = new Notificacion($db);` | Instrucción de ejecución en el contexto del script: `$model     = new Notificacion($db);`. |
| `13` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `14` | `$model->marcarTodasLeidas($idUsuario);` | Instrucción de ejecución en el contexto del script: `$model->marcarTodasLeidas($idUsuario);`. |
| `15` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `16` | `$notificaciones  = $model->obtenerPorUsuario($idUsuario);` | Instrucción de ejecución en el contexto del script: `$notificaciones  = $model->obtenerPorUsuario($idUsuario);`. |
| `17` | `$incumplimientos = $model->obtenerHistorialIncumplimientos($idUsuario);` | Instrucción de ejecución en el contexto del script: `$incumplimientos = $model->obtenerHistorialIncumplimientos($idUsuario);`. |
| `18` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `19` | `require_once __DIR__ . '/../layouts/header.php';` | Importación e inclusión obligatoria del archivo de dependencia requerido: `require_once __DIR__ . '/../layouts/header.php';`. |
| `20` | ``?>`` | Cierre de la etiqueta PHP para alternar a salida HTML o fin del archivo. |
| `21` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `22` | `<div class="d-flex justify-content-between align-items-center mb-4">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="d-flex justify-content-between align-items-center mb-4">`. |
| `23` | `<div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div>`. |
| `24` | `<h4 class="fw-bold mb-0"><i class="fas fa-bell text-success me-2"></i>No...` | Instrucción de ejecución en el contexto del script: `<h4 class="fw-bold mb-0"><i class="fas fa-bell text-success me-2"></i>No...`. |
| `25` | `<p class="text-muted small mb-0">Alertas del sistema e historial de incu...` | Instrucción de ejecución en el contexto del script: `<p class="text-muted small mb-0">Alertas del sistema e historial de incu...`. |
| `26` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `27` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `28` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `29` | `<ul class="nav nav-tabs mb-0">` | Instrucción de ejecución en el contexto del script: `<ul class="nav nav-tabs mb-0">`. |
| `30` | `<li class="nav-item">` | Instrucción de ejecución en el contexto del script: `<li class="nav-item">`. |
| `31` | `<button class="nav-link active" data-bs-toggle="tab" data-bs-target="#ta...` | Botón de acción interactivo para el usuario: `<button class="nav-link active" data-bs-toggle="tab" data-bs-target="#ta...`. |
| `32` | `<i class="fas fa-bell me-1"></i>Todas (<?= count($notificaciones) ?>)` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-bell me-1"></i>Todas (<?= count($notificaciones) ?>)`. |
| `33` | `</button>` | Instrucción de ejecución en el contexto del script: `</button>`. |
| `34` | `</li>` | Instrucción de ejecución en el contexto del script: `</li>`. |
| `35` | `<li class="nav-item">` | Instrucción de ejecución en el contexto del script: `<li class="nav-item">`. |
| `36` | `<button class="nav-link" data-bs-toggle="tab" data-bs-target="#tabIncump">` | Botón de acción interactivo para el usuario: `<button class="nav-link" data-bs-toggle="tab" data-bs-target="#tabIncump">`. |
| `37` | `<i class="fas fa-triangle-exclamation me-1 text-danger"></i>Incumplimien...` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-triangle-exclamation me-1 text-danger"></i>Incumplimien...`. |
| `38` | `</button>` | Instrucción de ejecución en el contexto del script: `</button>`. |
| `39` | `</li>` | Instrucción de ejecución en el contexto del script: `</li>`. |
| `40` | `</ul>` | Instrucción de ejecución en el contexto del script: `</ul>`. |
| `41` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `42` | `<div class="tab-content">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="tab-content">`. |
| `43` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `44` | `<div class="tab-pane fade show active" id="tabTodas">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="tab-pane fade show active" id="tabTodas">`. |
| `45` | `<div class="card shadow-sm rounded-top-0">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="card shadow-sm rounded-top-0">`. |
| `46` | `<div class="card-body p-0">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="card-body p-0">`. |
| `47` | `<?php if (empty($notificaciones)): ?>` | Instrucción de ejecución en el contexto del script: `<?php if (empty($notificaciones)): ?>`. |
| `48` | `<div class="text-center py-5 text-muted">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="text-center py-5 text-muted">`. |
| `49` | `<i class="fas fa-bell-slash fa-2x mb-2 opacity-25 d-block"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-bell-slash fa-2x mb-2 opacity-25 d-block"></i>`. |
| `50` | `<span class="small">Sin notificaciones.</span>` | Instrucción de ejecución en el contexto del script: `<span class="small">Sin notificaciones.</span>`. |
| `51` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `52` | `<?php else: ?>` | Instrucción de ejecución en el contexto del script: `<?php else: ?>`. |
| `53` | `<ul class="list-group list-group-flush">` | Instrucción de ejecución en el contexto del script: `<ul class="list-group list-group-flush">`. |
| `54` | `<?php foreach ($notificaciones as $n):` | Instrucción de ejecución en el contexto del script: `<?php foreach ($notificaciones as $n):`. |
| `55` | `$iconos = ['incumplimiento' => 'triangle-exclamation text-danger',` | Instrucción de ejecución en el contexto del script: `$iconos = ['incumplimiento' => 'triangle-exclamation text-danger',`. |
| `56` | `'credenciales'   => 'key text-warning',` | Instrucción de ejecución en el contexto del script: `'credenciales'   => 'key text-warning',`. |
| `57` | `'recordatorio'   => 'clock text-info',` | Instrucción de ejecución en el contexto del script: `'recordatorio'   => 'clock text-info',`. |
| `58` | `'info'           => 'circle-info text-primary'];` | Instrucción de ejecución en el contexto del script: `'info'           => 'circle-info text-primary'];`. |
| `59` | `$icono  = $iconos[$n['tipo']] ?? 'bell text-secondary';` | Instrucción de ejecución en el contexto del script: `$icono  = $iconos[$n['tipo']] ?? 'bell text-secondary';`. |
| `60` | ``?>`` | Cierre de la etiqueta PHP para alternar a salida HTML o fin del archivo. |
| `61` | `<li class="list-group-item border-0 py-3">` | Instrucción de ejecución en el contexto del script: `<li class="list-group-item border-0 py-3">`. |
| `62` | `<div class="d-flex align-items-start gap-3">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="d-flex align-items-start gap-3">`. |
| `63` | `<div style="margin-top:2px;"><i class="fas fa-<?= $icono ?> fa-lg"></i><...` | Contenedor visual estructurado con Bootstrap/CSS: `<div style="margin-top:2px;"><i class="fas fa-<?= $icono ?> fa-lg"></i><...`. |
| `64` | `<div class="flex-grow-1">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="flex-grow-1">`. |
| `65` | `<div class="fw-semibold small"><?= htmlspecialchars($n['titulo']) ?></div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="fw-semibold small"><?= htmlspecialchars($n['titulo']) ?></div>`. |
| `66` | `<div class="text-muted small"><?= htmlspecialchars($n['mensaje']) ?></div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="text-muted small"><?= htmlspecialchars($n['mensaje']) ?></div>`. |
| `67` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `68` | `<div class="text-muted text-end" style="font-size:.75rem; white-space:no...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="text-muted text-end" style="font-size:.75rem; white-space:no...`. |
| `69` | `<?= date('d/m/Y H:i', strtotime($n['fecha'])) ?>` | Instrucción de ejecución en el contexto del script: `<?= date('d/m/Y H:i', strtotime($n['fecha'])) ?>`. |
| `70` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `71` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `72` | `</li>` | Instrucción de ejecución en el contexto del script: `</li>`. |
| `73` | `<?php endforeach; ?>` | Cierre de ciclo iterativo foreach embebido en la plantilla HTML. |
| `74` | `</ul>` | Instrucción de ejecución en el contexto del script: `</ul>`. |
| `75` | `<?php endif; ?>` | Cierre de estructura condicional embebida en la plantilla HTML. |
| `76` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `77` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `78` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `79` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `80` | `<div class="tab-pane fade" id="tabIncump">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="tab-pane fade" id="tabIncump">`. |
| `81` | `<div class="card shadow-sm rounded-top-0">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="card shadow-sm rounded-top-0">`. |
| `82` | `<div class="card-body p-0">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="card-body p-0">`. |
| `83` | `<?php if (empty($incumplimientos)): ?>` | Instrucción de ejecución en el contexto del script: `<?php if (empty($incumplimientos)): ?>`. |
| `84` | `<div class="text-center py-5 text-muted">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="text-center py-5 text-muted">`. |
| `85` | `<i class="fas fa-check-circle text-success fa-2x mb-2 d-block"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-check-circle text-success fa-2x mb-2 d-block"></i>`. |
| `86` | `<span class="small">Sin incumplimientos registrados. ¡Excelente gestión!...` | Instrucción de ejecución en el contexto del script: `<span class="small">Sin incumplimientos registrados. ¡Excelente gestión!...`. |
| `87` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `88` | `<?php else: ?>` | Instrucción de ejecución en el contexto del script: `<?php else: ?>`. |
| `89` | `<div class="table-responsive">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="table-responsive">`. |
| `90` | `<table class="table tabla-limpia align-middle mb-0">` | Tabla de datos para despliegue estructurado de información. |
| `91` | `<thead class="table-light">` | Definición de estructura semántica de cabecera o cuerpo de tabla. |
| `92` | ``<tr>`` | Fila contenedora de datos dentro de la tabla. |
| `93` | `<th>Fecha</th>` | Celda de encabezado de columna: `<th>Fecha</th>`. |
| `94` | `<th>Ficha</th>` | Celda de encabezado de columna: `<th>Ficha</th>`. |
| `95` | `<th>Módulo</th>` | Celda de encabezado de columna: `<th>Módulo</th>`. |
| `96` | `<th>Detalle</th>` | Celda de encabezado de columna: `<th>Detalle</th>`. |
| `97` | `<th>Acciones</th>` | Celda de encabezado de columna: `<th>Acciones</th>`. |
| `98` | ``</tr>`` | Cierre de fila contenedora de tabla. |
| `99` | `</thead>` | Definición de estructura semántica de cabecera o cuerpo de tabla. |
| `100` | `<tbody>` | Definición de estructura semántica de cabecera o cuerpo de tabla. |
| `101` | `<?php foreach ($incumplimientos as $n): ?>` | Instrucción de ejecución en el contexto del script: `<?php foreach ($incumplimientos as $n): ?>`. |
| `102` | ``<tr>`` | Fila contenedora de datos dentro de la tabla. |
| `103` | `<td class="small text-muted"><?= date('d/m/Y H:i', strtotime($n['fecha']...` | Celda de contenido de tabla: `<td class="small text-muted"><?= date('d/m/Y H:i', strtotime($n['fecha']...`. |
| `104` | `<td><span class="badge bg-light text-dark border"><?= htmlspecialchars($...` | Celda de contenido de tabla: `<td><span class="badge bg-light text-dark border"><?= htmlspecialchars($...`. |
| `105` | `<td class="small"><?= htmlspecialchars($n['nombre_modulo'] ?? '—') ?></td>` | Celda de contenido de tabla: `<td class="small"><?= htmlspecialchars($n['nombre_modulo'] ?? '—') ?></td>`. |
| `106` | `<td class="small text-muted"><?= htmlspecialchars(substr($n['mensaje'], ...` | Celda de contenido de tabla: `<td class="small text-muted"><?= htmlspecialchars(substr($n['mensaje'], ...`. |
| `107` | `<td>` | Celda de contenido de tabla: `<td>`. |
| `108` | `<?php if (!empty($n['id_ficha'])): ?>` | Instrucción de ejecución en el contexto del script: `<?php if (!empty($n['id_ficha'])): ?>`. |
| `109` | `<a href="admin_fichas.php?ficha=<?= $n['id_ficha'] ?>"` | Instrucción de ejecución en el contexto del script: `<a href="admin_fichas.php?ficha=<?= $n['id_ficha'] ?>"`. |
| `110` | `class="btn btn-sm btn-outline-success" title="Ver vocero">` | Instrucción de ejecución en el contexto del script: `class="btn btn-sm btn-outline-success" title="Ver vocero">`. |
| `111` | `<i class="fas fa-user-tie me-1"></i>Ver vocero` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-user-tie me-1"></i>Ver vocero`. |
| `112` | `</a>` | Instrucción de ejecución en el contexto del script: `</a>`. |
| `113` | `<?php endif; ?>` | Cierre de estructura condicional embebida en la plantilla HTML. |
| `114` | `</td>` | Instrucción de ejecución en el contexto del script: `</td>`. |
| `115` | ``</tr>`` | Cierre de fila contenedora de tabla. |
| `116` | `<?php endforeach; ?>` | Cierre de ciclo iterativo foreach embebido en la plantilla HTML. |
| `117` | `</tbody>` | Definición de estructura semántica de cabecera o cuerpo de tabla. |
| `118` | ``</table>`` | Cierre de tabla de datos. |
| `119` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `120` | `<?php endif; ?>` | Cierre de estructura condicional embebida en la plantilla HTML. |
| `121` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `122` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `123` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `124` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `125` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `126` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `127` | ``<style>`` | Bloque de estilos CSS personalizados para la interfaz. |
| `128` | `.rounded-top-0 { border-top-left-radius:0!important; border-top-right-ra...` | Instrucción de ejecución en el contexto del script: `.rounded-top-0 { border-top-left-radius:0!important; border-top-right-ra...`. |
| `129` | `.nav-tabs .nav-link { font-size:.875rem; color:#64748b; }` | Instrucción de ejecución en el contexto del script: `.nav-tabs .nav-link { font-size:.875rem; color:#64748b; }`. |
| `130` | `.nav-tabs .nav-link.active { color:#39a900; font-weight:600; }` | Instrucción de ejecución en el contexto del script: `.nav-tabs .nav-link.active { color:#39a900; font-weight:600; }`. |
| `131` | ``</style>`` | Cierre de bloque de estilos CSS. |
| `132` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `133` | `<?php require_once __DIR__ . '/../layouts/footer.php'; ?>` | Importación e inclusión obligatoria del archivo de dependencia requerido: `<?php require_once __DIR__ . '/../layouts/footer.php'; ?>`. |

---

## 3. Resumen y Flujo de Interacción

El archivo `admin_notificaciones.php` cumple un rol indispensable en `views/dashboard/admin_notificaciones.php`. 
Bandeja de notificaciones y alertas de incumplimiento recibidas por los administradores. Garantiza la robustez, el orden y la estabilidad de la arquitectura del proyecto `systemLimpieza`.

---

Generado automáticamente para el repositorio [johanrepizo/LimpiezaDeModulos](https://github.com/johanrepizo/LimpiezaDeModulos).
