# Documentación Línea por Línea: `views/dashboard/vocero_notificaciones.php`

## 1. Ficha Técnica del Archivo

- **Archivo:** `vocero_notificaciones.php`
- **Ruta en el proyecto:** `views/dashboard/vocero_notificaciones.php`
- **Cantidad total de líneas:** `131`
- **Tipo de archivo:** `PHP`
- **Propósito general:** Bandeja de notificaciones dirigida al vocero sobre advertencias, turnos pendientes o felicitaciones.

---

## 2. Explicación Detallada Línea por Línea

A continuación se presenta cada línea de código numerada de forma consecutiva, acompañada de su fragmento exacto y la explicación exhaustiva de su funcionamiento y responsabilidad en el sistema:

| Línea | Código Fuente | Explicación Detallada |
|---|---|---|
| `1` | `<?php` | Apertura obligatoria de la etiqueta PHP para ejecución del código del lado del servidor. |
| `2` | `$titulo = 'Mis Notificaciones';` | Instrucción de ejecución en el contexto del script: `$titulo = 'Mis Notificaciones';`. |
| `3` | `if (session_status() === PHP_SESSION_NONE) session_start();` | Inicia o reanuda la sesión PHP del usuario si no se encontraba activa previamente. |
| `4` | `if (!isset($_SESSION['usuario']) \|\| (int)$_SESSION['usuario']['rol'] !== ...` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (!isset($_SESSION['usuario']) \|\| (int)$_SESSION['usuario']['rol'] !== 2) {`. |
| `5` | `    header("Location: ../usuarios/login.php"); exit;` | Emite cabecera HTTP de redirección en el navegador: `header("Location: ../usuarios/login.php"); exit;`. |
| `6` | `}` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `7` | `require_once __DIR__ . '/../../config/database.php';` | Importación e inclusión obligatoria del archivo de dependencia requerido: `require_once __DIR__ . '/../../config/database.php';`. |
| `8` | `require_once __DIR__ . '/../../models/Notificacion.php';` | Importación e inclusión obligatoria del archivo de dependencia requerido: `require_once __DIR__ . '/../../models/Notificacion.php';`. |
| `9` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `10` | `$db        = (new Database())->conectar();` | Instrucción de ejecución en el contexto del script: `$db        = (new Database())->conectar();`. |
| `11` | `$idUsuario = (int)$_SESSION['usuario']['id_usuario'];` | Accede o almacena información de identidad del usuario en la sesión activa: `$idUsuario = (int)$_SESSION['usuario']['id_usuario'];`. |
| `12` | `$model     = new Notificacion($db);` | Instrucción de ejecución en el contexto del script: `$model     = new Notificacion($db);`. |
| `13` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `14` | `// Marcar todas como leídas al entrar` | Comentario de línea explicativo: `Marcar todas como leídas al entrar`. |
| `15` | `$model->marcarTodasLeidas($idUsuario);` | Instrucción de ejecución en el contexto del script: `$model->marcarTodasLeidas($idUsuario);`. |
| `16` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `17` | `// Historial completo` | Comentario de línea explicativo: `Historial completo`. |
| `18` | `$notificaciones = $model->obtenerPorUsuario($idUsuario);` | Instrucción de ejecución en el contexto del script: `$notificaciones = $model->obtenerPorUsuario($idUsuario);`. |
| `19` | `$incumplimientos = $model->obtenerHistorialIncumplimientos($idUsuario);` | Instrucción de ejecución en el contexto del script: `$incumplimientos = $model->obtenerHistorialIncumplimientos($idUsuario);`. |
| `20` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `21` | `require_once __DIR__ . '/../layouts/header.php';` | Importación e inclusión obligatoria del archivo de dependencia requerido: `require_once __DIR__ . '/../layouts/header.php';`. |
| `22` | `?>` | Cierre de la etiqueta PHP para alternar a salida HTML o fin del archivo. |
| `23` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `24` | `<div class="d-flex justify-content-between align-items-center mb-4">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="d-flex justify-content-between align-items-center mb-4">`. |
| `25` | `    <div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div>`. |
| `26` | `        <h4 class="fw-bold mb-0"><i class="fas fa-bell text-success me-2"><...` | Instrucción de ejecución en el contexto del script: `<h4 class="fw-bold mb-0"><i class="fas fa-bell text-success me-2"></i>Mis Notificaciones</h4>`. |
| `27` | `        <p class="text-muted small mb-0">Alertas e incumplimientos de tu fi...` | Instrucción de ejecución en el contexto del script: `<p class="text-muted small mb-0">Alertas e incumplimientos de tu ficha</p>`. |
| `28` | `    </div>` | Cierre de contenedor visual `<div>`. |
| `29` | `</div>` | Cierre de contenedor visual `<div>`. |
| `30` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `31` | `<!-- Tabs -->` | Instrucción de ejecución en el contexto del script: `<!-- Tabs -->`. |
| `32` | `<ul class="nav nav-tabs mb-0">` | Instrucción de ejecución en el contexto del script: `<ul class="nav nav-tabs mb-0">`. |
| `33` | `    <li class="nav-item">` | Instrucción de ejecución en el contexto del script: `<li class="nav-item">`. |
| `34` | `        <button class="nav-link active" data-bs-toggle="tab" data-bs-target...` | Botón de acción interactivo para el usuario: `<button class="nav-link active" data-bs-toggle="tab" data-bs-target="#tabTodas">`. |
| `35` | `            <i class="fas fa-bell me-1"></i>Todas (<?= count($notificacione...` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-bell me-1"></i>Todas (<?= count($notificaciones) ?>)`. |
| `36` | `        </button>` | Botón de acción interactivo para el usuario: `</button>`. |
| `37` | `    </li>` | Instrucción de ejecución en el contexto del script: `</li>`. |
| `38` | `    <li class="nav-item">` | Instrucción de ejecución en el contexto del script: `<li class="nav-item">`. |
| `39` | `        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#tabI...` | Botón de acción interactivo para el usuario: `<button class="nav-link" data-bs-toggle="tab" data-bs-target="#tabIncumplimientos">`. |
| `40` | `            <i class="fas fa-triangle-exclamation me-1"></i>Incumplimientos...` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-triangle-exclamation me-1"></i>Incumplimientos (<?= count($incumplimientos) ?>)`. |
| `41` | `        </button>` | Botón de acción interactivo para el usuario: `</button>`. |
| `42` | `    </li>` | Instrucción de ejecución en el contexto del script: `</li>`. |
| `43` | `</ul>` | Instrucción de ejecución en el contexto del script: `</ul>`. |
| `44` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `45` | `<div class="tab-content">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="tab-content">`. |
| `46` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `47` | `    <!-- Todas -->` | Instrucción de ejecución en el contexto del script: `<!-- Todas -->`. |
| `48` | `    <div class="tab-pane fade show active" id="tabTodas">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="tab-pane fade show active" id="tabTodas">`. |
| `49` | `        <div class="card shadow-sm rounded-top-0">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="card shadow-sm rounded-top-0">`. |
| `50` | `            <div class="card-body p-0">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="card-body p-0">`. |
| `51` | `                <?php if (empty($notificaciones)): ?>` | Instrucción de ejecución en el contexto del script: `<?php if (empty($notificaciones)): ?>`. |
| `52` | `                    <div class="text-center py-5 text-muted">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="text-center py-5 text-muted">`. |
| `53` | `                        <i class="fas fa-bell-slash fa-2x mb-2 opacity-25 d...` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-bell-slash fa-2x mb-2 opacity-25 d-block"></i>`. |
| `54` | `                        <span class="small">No tienes notificaciones.</span>` | Instrucción de ejecución en el contexto del script: `<span class="small">No tienes notificaciones.</span>`. |
| `55` | `                    </div>` | Cierre de contenedor visual `<div>`. |
| `56` | `                <?php else: ?>` | Instrucción de ejecución en el contexto del script: `<?php else: ?>`. |
| `57` | `                <ul class="list-group list-group-flush">` | Instrucción de ejecución en el contexto del script: `<ul class="list-group list-group-flush">`. |
| `58` | `                <?php foreach ($notificaciones as $n):` | Instrucción de ejecución en el contexto del script: `<?php foreach ($notificaciones as $n):`. |
| `59` | `                    $iconos = ['incumplimiento' => 'triangle-exclamation te...` | Instrucción de ejecución en el contexto del script: `$iconos = ['incumplimiento' => 'triangle-exclamation text-danger',`. |
| `60` | `                               'credenciales'   => 'key text-warning',` | Instrucción de ejecución en el contexto del script: `'credenciales'   => 'key text-warning',`. |
| `61` | `                               'recordatorio'   => 'clock text-info',` | Instrucción de ejecución en el contexto del script: `'recordatorio'   => 'clock text-info',`. |
| `62` | `                               'info'           => 'circle-info text-primar...` | Instrucción de ejecución en el contexto del script: `'info'           => 'circle-info text-primary'];`. |
| `63` | `                    $icono = $iconos[$n['tipo']] ?? 'bell text-secondary';` | Instrucción de ejecución en el contexto del script: `$icono = $iconos[$n['tipo']] ?? 'bell text-secondary';`. |
| `64` | `                ?>` | Cierre de la etiqueta PHP para alternar a salida HTML o fin del archivo. |
| `65` | `                <li class="list-group-item border-0 py-3">` | Instrucción de ejecución en el contexto del script: `<li class="list-group-item border-0 py-3">`. |
| `66` | `                    <div class="d-flex align-items-start gap-3">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="d-flex align-items-start gap-3">`. |
| `67` | `                        <div style="margin-top:2px;">` | Contenedor visual estructurado con Bootstrap/CSS: `<div style="margin-top:2px;">`. |
| `68` | `                            <i class="fas fa-<?= $icono ?> fa-lg"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-<?= $icono ?> fa-lg"></i>`. |
| `69` | `                        </div>` | Cierre de contenedor visual `<div>`. |
| `70` | `                        <div class="flex-grow-1">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="flex-grow-1">`. |
| `71` | `                            <div class="fw-semibold small"><?= htmlspecialc...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="fw-semibold small"><?= htmlspecialchars($n['titulo']) ?></div>`. |
| `72` | `                            <div class="text-muted small"><?= htmlspecialch...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="text-muted small"><?= htmlspecialchars($n['mensaje']) ?></div>`. |
| `73` | `                        </div>` | Cierre de contenedor visual `<div>`. |
| `74` | `                        <div class="text-muted" style="font-size:.75rem; wh...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="text-muted" style="font-size:.75rem; white-space:nowrap;">`. |
| `75` | `                            <?= date('d/m/Y H:i', strtotime($n['fecha'])) ?>` | Instrucción de ejecución en el contexto del script: `<?= date('d/m/Y H:i', strtotime($n['fecha'])) ?>`. |
| `76` | `                        </div>` | Cierre de contenedor visual `<div>`. |
| `77` | `                    </div>` | Cierre de contenedor visual `<div>`. |
| `78` | `                </li>` | Instrucción de ejecución en el contexto del script: `</li>`. |
| `79` | `                <?php endforeach; ?>` | Instrucción de ejecución en el contexto del script: `<?php endforeach; ?>`. |
| `80` | `                </ul>` | Instrucción de ejecución en el contexto del script: `</ul>`. |
| `81` | `                <?php endif; ?>` | Instrucción de ejecución en el contexto del script: `<?php endif; ?>`. |
| `82` | `            </div>` | Cierre de contenedor visual `<div>`. |
| `83` | `        </div>` | Cierre de contenedor visual `<div>`. |
| `84` | `    </div>` | Cierre de contenedor visual `<div>`. |
| `85` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `86` | `    <!-- Incumplimientos -->` | Instrucción de ejecución en el contexto del script: `<!-- Incumplimientos -->`. |
| `87` | `    <div class="tab-pane fade" id="tabIncumplimientos">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="tab-pane fade" id="tabIncumplimientos">`. |
| `88` | `        <div class="card shadow-sm rounded-top-0">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="card shadow-sm rounded-top-0">`. |
| `89` | `            <div class="card-body p-0">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="card-body p-0">`. |
| `90` | `                <?php if (empty($incumplimientos)): ?>` | Instrucción de ejecución en el contexto del script: `<?php if (empty($incumplimientos)): ?>`. |
| `91` | `                    <div class="text-center py-5 text-muted">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="text-center py-5 text-muted">`. |
| `92` | `                        <i class="fas fa-check-circle text-success fa-2x mb...` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-check-circle text-success fa-2x mb-2 d-block"></i>`. |
| `93` | `                        <span class="small">Sin incumplimientos registrados...` | Instrucción de ejecución en el contexto del script: `<span class="small">Sin incumplimientos registrados.</span>`. |
| `94` | `                    </div>` | Cierre de contenedor visual `<div>`. |
| `95` | `                <?php else: ?>` | Instrucción de ejecución en el contexto del script: `<?php else: ?>`. |
| `96` | `                <div class="table-responsive">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="table-responsive">`. |
| `97` | `                    <table class="table tabla-limpia align-middle mb-0">` | Tabla de datos para despliegue estructurado de información: `<table class="table tabla-limpia align-middle mb-0">`. |
| `98` | `                        <thead class="table-light">` | Celda de tabla con contenido de datos o encabezado de columna: `<thead class="table-light">`. |
| `99` | `                            <tr>` | Fila contenedora de datos dentro de la tabla. |
| `100` | `                                <th>Fecha</th>` | Celda de tabla con contenido de datos o encabezado de columna: `<th>Fecha</th>`. |
| `101` | `                                <th>Ficha</th>` | Celda de tabla con contenido de datos o encabezado de columna: `<th>Ficha</th>`. |
| `102` | `                                <th>Módulo</th>` | Celda de tabla con contenido de datos o encabezado de columna: `<th>Módulo</th>`. |
| `103` | `                                <th>Detalle</th>` | Celda de tabla con contenido de datos o encabezado de columna: `<th>Detalle</th>`. |
| `104` | `                            </tr>` | Fila contenedora de datos dentro de la tabla. |
| `105` | `                        </thead>` | Instrucción de ejecución en el contexto del script: `</thead>`. |
| `106` | `                        <tbody>` | Instrucción de ejecución en el contexto del script: `<tbody>`. |
| `107` | `                        <?php foreach ($incumplimientos as $n): ?>` | Instrucción de ejecución en el contexto del script: `<?php foreach ($incumplimientos as $n): ?>`. |
| `108` | `                        <tr>` | Fila contenedora de datos dentro de la tabla. |
| `109` | `                            <td class="small text-muted"><?= date('d/m/Y H:...` | Celda de tabla con contenido de datos o encabezado de columna: `<td class="small text-muted"><?= date('d/m/Y H:i', strtotime($n['fecha'])) ?></td>`. |
| `110` | `                            <td><span class="badge bg-light text-dark borde...` | Celda de tabla con contenido de datos o encabezado de columna: `<td><span class="badge bg-light text-dark border"><?= htmlspecialchars($n['numero_ficha'] ?? '—') ?></span></td>`. |
| `111` | `                            <td class="small"><?= htmlspecialchars($n['nomb...` | Celda de tabla con contenido de datos o encabezado de columna: `<td class="small"><?= htmlspecialchars($n['nombre_modulo'] ?? '—') ?></td>`. |
| `112` | `                            <td class="small text-muted"><?= htmlspecialcha...` | Celda de tabla con contenido de datos o encabezado de columna: `<td class="small text-muted"><?= htmlspecialchars($n['mensaje']) ?></td>`. |
| `113` | `                        </tr>` | Fila contenedora de datos dentro de la tabla. |
| `114` | `                        <?php endforeach; ?>` | Instrucción de ejecución en el contexto del script: `<?php endforeach; ?>`. |
| `115` | `                        </tbody>` | Instrucción de ejecución en el contexto del script: `</tbody>`. |
| `116` | `                    </table>` | Tabla de datos para despliegue estructurado de información: `</table>`. |
| `117` | `                </div>` | Cierre de contenedor visual `<div>`. |
| `118` | `                <?php endif; ?>` | Instrucción de ejecución en el contexto del script: `<?php endif; ?>`. |
| `119` | `            </div>` | Cierre de contenedor visual `<div>`. |
| `120` | `        </div>` | Cierre de contenedor visual `<div>`. |
| `121` | `    </div>` | Cierre de contenedor visual `<div>`. |
| `122` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `123` | `</div>` | Cierre de contenedor visual `<div>`. |
| `124` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `125` | `<style>` | Instrucción de ejecución en el contexto del script: `<style>`. |
| `126` | `.rounded-top-0 { border-top-left-radius:0!important; border-top-right-radiu...` | Instrucción de ejecución en el contexto del script: `.rounded-top-0 { border-top-left-radius:0!important; border-top-right-radius:0!important; }`. |
| `127` | `.nav-tabs .nav-link { font-size:.875rem; color:#64748b; }` | Instrucción de ejecución en el contexto del script: `.nav-tabs .nav-link { font-size:.875rem; color:#64748b; }`. |
| `128` | `.nav-tabs .nav-link.active { color:#39a900; font-weight:600; }` | Instrucción de ejecución en el contexto del script: `.nav-tabs .nav-link.active { color:#39a900; font-weight:600; }`. |
| `129` | `</style>` | Instrucción de ejecución en el contexto del script: `</style>`. |
| `130` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `131` | `<?php require_once __DIR__ . '/../layouts/footer.php'; ?>` | Instrucción de ejecución en el contexto del script: `<?php require_once __DIR__ . '/../layouts/footer.php'; ?>`. |

---

## 3. Resumen y Flujo de Interacción

El archivo `vocero_notificaciones.php` cumple un rol indispensable en `views/dashboard/vocero_notificaciones.php`. 
Bandeja de notificaciones dirigida al vocero sobre advertencias, turnos pendientes o felicitaciones. Garantiza la robustez, el orden y la estabilidad de la arquitectura del proyecto `systemLimpieza`.
