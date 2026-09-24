# Documentación Línea por Línea: `views/dashboard/admin_modulos.php`

## 1. Ficha Técnica del Archivo

- **Archivo:** `admin_modulos.php`
- **Ruta en el proyecto:** `views/dashboard/admin_modulos.php`
- **Cantidad total de líneas:** `389`
- **Tipo de archivo:** `PHP`
- **Propósito general:** Interfaz para crear y administrar los ambientes o módulos físicos del centro y vincularlos con las fichas.

---

## 2. Explicación Detallada Línea por Línea

A continuación se presenta cada línea de código numerada de forma consecutiva, acompañada de su fragmento exacto y la explicación exhaustiva de su funcionamiento y responsabilidad en el sistema:

| Línea | Código Fuente | Explicación Detallada |
|---|---|---|
| `1` | `<?php` | Apertura obligatoria de la etiqueta PHP para ejecución del código del lado del servidor. |
| `2` | `$titulo = 'Módulos y Asignaciones';` | Instrucción de ejecución en el contexto del script: `$titulo = 'Módulos y Asignaciones';`. |
| `3` | `if (session_status() === PHP_SESSION_NONE) session_start();` | Inicia o reanuda la sesión PHP del usuario si no se encontraba activa previamente. |
| `4` | `if (!isset($_SESSION['usuario']) \|\| (int)$_SESSION['usuario']['rol'] !== ...` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (!isset($_SESSION['usuario']) \|\| (int)$_SESSION['usuario']['rol'] !== 1) {`. |
| `5` | `    header("Location: ../usuarios/login.php"); exit;` | Emite cabecera HTTP de redirección en el navegador: `header("Location: ../usuarios/login.php"); exit;`. |
| `6` | `}` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `7` | `require_once __DIR__ . '/../../config/database.php';` | Importación e inclusión obligatoria del archivo de dependencia requerido: `require_once __DIR__ . '/../../config/database.php';`. |
| `8` | `require_once __DIR__ . '/../../models/Modulo.php';` | Importación e inclusión obligatoria del archivo de dependencia requerido: `require_once __DIR__ . '/../../models/Modulo.php';`. |
| `9` | `require_once __DIR__ . '/../../models/Ficha.php';` | Importación e inclusión obligatoria del archivo de dependencia requerido: `require_once __DIR__ . '/../../models/Ficha.php';`. |
| `10` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `11` | `$db       = (new Database())->conectar();` | Instrucción de ejecución en el contexto del script: `$db       = (new Database())->conectar();`. |
| `12` | `$modModel = new Modulo($db);` | Instrucción de ejecución en el contexto del script: `$modModel = new Modulo($db);`. |
| `13` | `$ficModel = new Ficha($db);` | Instrucción de ejecución en el contexto del script: `$ficModel = new Ficha($db);`. |
| `14` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `15` | `$modulos      = $modModel->obtenerTodos();` | Instrucción de ejecución en el contexto del script: `$modulos      = $modModel->obtenerTodos();`. |
| `16` | `$fichas       = $ficModel->obtenerTodas();` | Instrucción de ejecución en el contexto del script: `$fichas       = $ficModel->obtenerTodas();`. |
| `17` | `$asignaciones = $modModel->obtenerAsignaciones();` | Instrucción de ejecución en el contexto del script: `$asignaciones = $modModel->obtenerAsignaciones();`. |
| `18` | `$alert        = $_SESSION['alert'] ?? null;` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección: `$alert        = $_SESSION['alert'] ?? null;`. |
| `19` | `unset($_SESSION['alert']);` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección: `unset($_SESSION['alert']);`. |
| `20` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `21` | `require_once __DIR__ . '/../layouts/header.php';` | Importación e inclusión obligatoria del archivo de dependencia requerido: `require_once __DIR__ . '/../layouts/header.php';`. |
| `22` | `?>` | Cierre de la etiqueta PHP para alternar a salida HTML o fin del archivo. |
| `23` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `24` | `<div class="d-flex justify-content-between align-items-center mb-4">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="d-flex justify-content-between align-items-center mb-4">`. |
| `25` | `    <div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div>`. |
| `26` | `        <h4 class="fw-bold mb-0"><i class="fas fa-door-open text-success me...` | Instrucción de ejecución en el contexto del script: `<h4 class="fw-bold mb-0"><i class="fas fa-door-open text-success me-2"></i>Módulos y Asignaciones</h4>`. |
| `27` | `        <p class="text-muted small mb-0">Inventario de módulos y control de...` | Instrucción de ejecución en el contexto del script: `<p class="text-muted small mb-0">Inventario de módulos y control de asignaciones por ficha</p>`. |
| `28` | `    </div>` | Cierre de contenedor visual `<div>`. |
| `29` | `    <div class="d-flex gap-2">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="d-flex gap-2">`. |
| `30` | `        <button class="btn btn-outline-success btn-sm" data-bs-toggle="moda...` | Botón de acción interactivo para el usuario: `<button class="btn btn-outline-success btn-sm" data-bs-toggle="modal" data-bs-target="#modalModulo">`. |
| `31` | `            <i class="fas fa-plus me-1"></i> Nuevo Módulo` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-plus me-1"></i> Nuevo Módulo`. |
| `32` | `        </button>` | Botón de acción interactivo para el usuario: `</button>`. |
| `33` | `        <button class="btn btn-success btn-sm fw-semibold" data-bs-toggle="...` | Botón de acción interactivo para el usuario: `<button class="btn btn-success btn-sm fw-semibold" data-bs-toggle="modal" data-bs-target="#modalAsignacion">`. |
| `34` | `            <i class="fas fa-link me-1"></i> Asignar Módulo` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-link me-1"></i> Asignar Módulo`. |
| `35` | `        </button>` | Botón de acción interactivo para el usuario: `</button>`. |
| `36` | `    </div>` | Cierre de contenedor visual `<div>`. |
| `37` | `</div>` | Cierre de contenedor visual `<div>`. |
| `38` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `39` | `<!-- ── TABS ── -->` | Instrucción de ejecución en el contexto del script: `<!-- ── TABS ── -->`. |
| `40` | `<ul class="nav nav-tabs mb-0" id="tabsModulos">` | Instrucción de ejecución en el contexto del script: `<ul class="nav nav-tabs mb-0" id="tabsModulos">`. |
| `41` | `    <li class="nav-item">` | Instrucción de ejecución en el contexto del script: `<li class="nav-item">`. |
| `42` | `        <button class="nav-link active" data-bs-toggle="tab" data-bs-target...` | Botón de acción interactivo para el usuario: `<button class="nav-link active" data-bs-toggle="tab" data-bs-target="#tabModulos">`. |
| `43` | `            <i class="fas fa-door-open me-1"></i>Módulos (<?= count($modulo...` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-door-open me-1"></i>Módulos (<?= count($modulos) ?>)`. |
| `44` | `        </button>` | Botón de acción interactivo para el usuario: `</button>`. |
| `45` | `    </li>` | Instrucción de ejecución en el contexto del script: `</li>`. |
| `46` | `    <li class="nav-item">` | Instrucción de ejecución en el contexto del script: `<li class="nav-item">`. |
| `47` | `        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#tabA...` | Botón de acción interactivo para el usuario: `<button class="nav-link" data-bs-toggle="tab" data-bs-target="#tabAsignaciones">`. |
| `48` | `            <i class="fas fa-link me-1"></i>Asignaciones (<?= count($asigna...` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-link me-1"></i>Asignaciones (<?= count($asignaciones) ?>)`. |
| `49` | `        </button>` | Botón de acción interactivo para el usuario: `</button>`. |
| `50` | `    </li>` | Instrucción de ejecución en el contexto del script: `</li>`. |
| `51` | `</ul>` | Instrucción de ejecución en el contexto del script: `</ul>`. |
| `52` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `53` | `<div class="tab-content">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="tab-content">`. |
| `54` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `55` | `    <!-- Tab Módulos -->` | Instrucción de ejecución en el contexto del script: `<!-- Tab Módulos -->`. |
| `56` | `    <div class="tab-pane fade show active" id="tabModulos">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="tab-pane fade show active" id="tabModulos">`. |
| `57` | `        <div class="card shadow-sm rounded-top-0">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="card shadow-sm rounded-top-0">`. |
| `58` | `            <div class="card-body p-0">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="card-body p-0">`. |
| `59` | `                <div class="table-responsive">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="table-responsive">`. |
| `60` | `                    <table class="table tabla-limpia align-middle mb-0">` | Tabla de datos para despliegue estructurado de información: `<table class="table tabla-limpia align-middle mb-0">`. |
| `61` | `                        <thead class="table-light">` | Celda de tabla con contenido de datos o encabezado de columna: `<thead class="table-light">`. |
| `62` | `                            <tr>` | Fila contenedora de datos dentro de la tabla. |
| `63` | `                                <th>Nombre</th>` | Celda de tabla con contenido de datos o encabezado de columna: `<th>Nombre</th>`. |
| `64` | `                                <th>Ubicación</th>` | Celda de tabla con contenido de datos o encabezado de columna: `<th>Ubicación</th>`. |
| `65` | `                                <th>Capacidad</th>` | Celda de tabla con contenido de datos o encabezado de columna: `<th>Capacidad</th>`. |
| `66` | `                                <th>Estado</th>` | Celda de tabla con contenido de datos o encabezado de columna: `<th>Estado</th>`. |
| `67` | `                                <th>Acciones</th>` | Celda de tabla con contenido de datos o encabezado de columna: `<th>Acciones</th>`. |
| `68` | `                            </tr>` | Fila contenedora de datos dentro de la tabla. |
| `69` | `                        </thead>` | Instrucción de ejecución en el contexto del script: `</thead>`. |
| `70` | `                        <tbody>` | Instrucción de ejecución en el contexto del script: `<tbody>`. |
| `71` | `                        <?php foreach ($modulos as $m): ?>` | Instrucción de ejecución en el contexto del script: `<?php foreach ($modulos as $m): ?>`. |
| `72` | `                        <tr>` | Fila contenedora de datos dentro de la tabla. |
| `73` | `                            <td class="fw-semibold small"><?= htmlspecialch...` | Celda de tabla con contenido de datos o encabezado de columna: `<td class="fw-semibold small"><?= htmlspecialchars($m['nombre']) ?></td>`. |
| `74` | `                            <td class="small text-muted"><?= htmlspecialcha...` | Celda de tabla con contenido de datos o encabezado de columna: `<td class="small text-muted"><?= htmlspecialchars($m['ubicacion'] ?? '—') ?></td>`. |
| `75` | `                            <td class="small"><?= $m['capacidad'] ? $m['cap...` | Celda de tabla con contenido de datos o encabezado de columna: `<td class="small"><?= $m['capacidad'] ? $m['capacidad'] . ' personas' : '—' ?></td>`. |
| `76` | `                            <td>` | Celda de tabla con contenido de datos o encabezado de columna: `<td>`. |
| `77` | `                                <?php if ($m['id_asignacion']): ?>` | Instrucción de ejecución en el contexto del script: `<?php if ($m['id_asignacion']): ?>`. |
| `78` | `                                    <span class="badge bg-warning text-dark...` | Instrucción de ejecución en el contexto del script: `<span class="badge bg-warning text-dark">Asignado</span>`. |
| `79` | `                                <?php else: ?>` | Instrucción de ejecución en el contexto del script: `<?php else: ?>`. |
| `80` | `                                    <span class="badge bg-success">Disponib...` | Instrucción de ejecución en el contexto del script: `<span class="badge bg-success">Disponible</span>`. |
| `81` | `                                <?php endif; ?>` | Instrucción de ejecución en el contexto del script: `<?php endif; ?>`. |
| `82` | `                            </td>` | Celda de tabla con contenido de datos o encabezado de columna: `</td>`. |
| `83` | `                            <td>` | Celda de tabla con contenido de datos o encabezado de columna: `<td>`. |
| `84` | `                                <button class="btn btn-sm btn-outline-primary"` | Botón de acción interactivo para el usuario: `<button class="btn btn-sm btn-outline-primary"`. |
| `85` | `                                        onclick='editarModulo(<?= json_enco...` | Instrucción de ejecución en el contexto del script: `onclick='editarModulo(<?= json_encode($m) ?>)' title="Editar">`. |
| `86` | `                                    <i class="fas fa-pen"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-pen"></i>`. |
| `87` | `                                </button>` | Botón de acción interactivo para el usuario: `</button>`. |
| `88` | `                            </td>` | Celda de tabla con contenido de datos o encabezado de columna: `</td>`. |
| `89` | `                        </tr>` | Fila contenedora de datos dentro de la tabla. |
| `90` | `                        <?php endforeach; ?>` | Instrucción de ejecución en el contexto del script: `<?php endforeach; ?>`. |
| `91` | `                        <?php if (empty($modulos)): ?>` | Instrucción de ejecución en el contexto del script: `<?php if (empty($modulos)): ?>`. |
| `92` | `                        <tr><td colspan="5" class="text-center text-muted p...` | Fila contenedora de datos dentro de la tabla. |
| `93` | `                        <?php endif; ?>` | Instrucción de ejecución en el contexto del script: `<?php endif; ?>`. |
| `94` | `                        </tbody>` | Instrucción de ejecución en el contexto del script: `</tbody>`. |
| `95` | `                    </table>` | Tabla de datos para despliegue estructurado de información: `</table>`. |
| `96` | `                </div>` | Cierre de contenedor visual `<div>`. |
| `97` | `            </div>` | Cierre de contenedor visual `<div>`. |
| `98` | `        </div>` | Cierre de contenedor visual `<div>`. |
| `99` | `    </div>` | Cierre de contenedor visual `<div>`. |
| `100` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `101` | `    <!-- Tab Asignaciones -->` | Instrucción de ejecución en el contexto del script: `<!-- Tab Asignaciones -->`. |
| `102` | `    <div class="tab-pane fade" id="tabAsignaciones">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="tab-pane fade" id="tabAsignaciones">`. |
| `103` | `        <div class="card shadow-sm rounded-top-0">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="card shadow-sm rounded-top-0">`. |
| `104` | `            <!-- Aviso regla -->` | Instrucción de ejecución en el contexto del script: `<!-- Aviso regla -->`. |
| `105` | `            <div class="px-4 py-2" style="background:#eff6ff; border-bottom...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="px-4 py-2" style="background:#eff6ff; border-bottom:1px solid #bfdbfe; font-size:.8rem; color:#1d4ed8;">`. |
| `106` | `                <i class="fas fa-circle-info me-1"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-circle-info me-1"></i>`. |
| `107` | `                <strong>Regla:</strong> Cada ficha solo puede tener <strong...` | Instrucción de ejecución en el contexto del script: `<strong>Regla:</strong> Cada ficha solo puede tener <strong>un módulo activo</strong> a la vez.`. |
| `108` | `                Los grupos de esa ficha limpian ese módulo en rotación sema...` | Instrucción de ejecución en el contexto del script: `Los grupos de esa ficha limpian ese módulo en rotación semanal —`. |
| `109` | `                semana 1 → Grupo A, semana 2 → Grupo B, y así sucesivamente.` | Instrucción de ejecución en el contexto del script: `semana 1 → Grupo A, semana 2 → Grupo B, y así sucesivamente.`. |
| `110` | `            </div>` | Cierre de contenedor visual `<div>`. |
| `111` | `            <div class="card-body p-0">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="card-body p-0">`. |
| `112` | `                <div class="table-responsive">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="table-responsive">`. |
| `113` | `                    <table class="table tabla-limpia align-middle mb-0">` | Tabla de datos para despliegue estructurado de información: `<table class="table tabla-limpia align-middle mb-0">`. |
| `114` | `                        <thead class="table-light">` | Celda de tabla con contenido de datos o encabezado de columna: `<thead class="table-light">`. |
| `115` | `                            <tr>` | Fila contenedora de datos dentro de la tabla. |
| `116` | `                                <th>Módulo</th>` | Celda de tabla con contenido de datos o encabezado de columna: `<th>Módulo</th>`. |
| `117` | `                                <th>Ficha</th>` | Celda de tabla con contenido de datos o encabezado de columna: `<th>Ficha</th>`. |
| `118` | `                                <th>Programa</th>` | Celda de tabla con contenido de datos o encabezado de columna: `<th>Programa</th>`. |
| `119` | `                                <th>Vocero</th>` | Celda de tabla con contenido de datos o encabezado de columna: `<th>Vocero</th>`. |
| `120` | `                                <th class="text-center">Día rotación</th>` | Celda de tabla con contenido de datos o encabezado de columna: `<th class="text-center">Día rotación</th>`. |
| `121` | `                                <th>Período</th>` | Celda de tabla con contenido de datos o encabezado de columna: `<th>Período</th>`. |
| `122` | `                                <th>Estado</th>` | Celda de tabla con contenido de datos o encabezado de columna: `<th>Estado</th>`. |
| `123` | `                                <th class="text-center">Evid.</th>` | Celda de tabla con contenido de datos o encabezado de columna: `<th class="text-center">Evid.</th>`. |
| `124` | `                                <th>Acciones</th>` | Celda de tabla con contenido de datos o encabezado de columna: `<th>Acciones</th>`. |
| `125` | `                            </tr>` | Fila contenedora de datos dentro de la tabla. |
| `126` | `                        </thead>` | Instrucción de ejecución en el contexto del script: `</thead>`. |
| `127` | `                        <tbody>` | Instrucción de ejecución en el contexto del script: `<tbody>`. |
| `128` | `                        <?php` | Apertura obligatoria de la etiqueta PHP para ejecución del código del lado del servidor. |
| `129` | `                        $diasES = ['Dom','Lun','Mar','Mié','Jue','Vie','Sáb'];` | Instrucción de ejecución en el contexto del script: `$diasES = ['Dom','Lun','Mar','Mié','Jue','Vie','Sáb'];`. |
| `130` | `                        foreach ($asignaciones as $a):` | Bucle de iteración `foreach` para recorrer arreglos o colecciones de registros: `foreach ($asignaciones as $a):`. |
| `131` | `                            $badgeAsig = match($a['estado']) {` | Instrucción de ejecución en el contexto del script: `$badgeAsig = match($a['estado']) {`. |
| `132` | `                                'Activa'     => 'bg-success',` | Instrucción de ejecución en el contexto del script: `'Activa'     => 'bg-success',`. |
| `133` | `                                'Completada' => 'bg-primary',` | Instrucción de ejecución en el contexto del script: `'Completada' => 'bg-primary',`. |
| `134` | `                                'Vencida'    => 'bg-danger',` | Instrucción de ejecución en el contexto del script: `'Vencida'    => 'bg-danger',`. |
| `135` | `                                'Cancelada'  => 'bg-secondary',` | Instrucción de ejecución en el contexto del script: `'Cancelada'  => 'bg-secondary',`. |
| `136` | `                                default      => 'bg-secondary',` | Instrucción de ejecución en el contexto del script: `default      => 'bg-secondary',`. |
| `137` | `                            };` | Instrucción de ejecución en el contexto del script: `};`. |
| `138` | `                            $editable  = $a['estado'] === 'Activa';` | Instrucción de ejecución en el contexto del script: `$editable  = $a['estado'] === 'Activa';`. |
| `139` | `                            $diaNombre = $diasES[(int)($a['dia_semana'] ?? ...` | Instrucción de ejecución en el contexto del script: `$diaNombre = $diasES[(int)($a['dia_semana'] ?? 0)];`. |
| `140` | `                        ?>` | Cierre de la etiqueta PHP para alternar a salida HTML o fin del archivo. |
| `141` | `                        <tr>` | Fila contenedora de datos dentro de la tabla. |
| `142` | `                            <td class="fw-semibold small"><?= htmlspecialch...` | Celda de tabla con contenido de datos o encabezado de columna: `<td class="fw-semibold small"><?= htmlspecialchars($a['nombre_modulo']) ?></td>`. |
| `143` | `                            <td><span class="badge bg-light text-dark borde...` | Celda de tabla con contenido de datos o encabezado de columna: `<td><span class="badge bg-light text-dark border font-monospace"><?= htmlspecialchars($a['numero_ficha']) ?></span></td>`. |
| `144` | `                            <td class="small text-muted"><?= htmlspecialcha...` | Celda de tabla con contenido de datos o encabezado de columna: `<td class="small text-muted"><?= htmlspecialchars(substr($a['nombre_programa'], 0, 22)) ?>…</td>`. |
| `145` | `                            <td class="small"><?= htmlspecialchars(trim(($a...` | Celda de tabla con contenido de datos o encabezado de columna: `<td class="small"><?= htmlspecialchars(trim(($a['vocero_nombres'] ?? '') . ' ' . ($a['vocero_apellidos'] ?? ''))) ?: '<span class="text-muted">—</span>' ?></td>`. |
| `146` | `                            <td class="text-center">` | Celda de tabla con contenido de datos o encabezado de columna: `<td class="text-center">`. |
| `147` | `                                <span class="badge" style="background:#eef2...` | Instrucción de ejecución en el contexto del script: `<span class="badge" style="background:#eef2ff;color:#4f46e5;font-size:.8rem;padding:.35rem .75rem;">`. |
| `148` | `                                    <i class="fas fa-rotate me-1"></i><?= $...` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-rotate me-1"></i><?= $diaNombre ?>s`. |
| `149` | `                                </span>` | Instrucción de ejecución en el contexto del script: `</span>`. |
| `150` | `                            </td>` | Celda de tabla con contenido de datos o encabezado de columna: `</td>`. |
| `151` | `                            <td class="small text-muted text-nowrap">` | Celda de tabla con contenido de datos o encabezado de columna: `<td class="small text-muted text-nowrap">`. |
| `152` | `                                <?= date('d/m/Y', strtotime($a['fecha_inici...` | Instrucción de ejecución en el contexto del script: `<?= date('d/m/Y', strtotime($a['fecha_inicio'])) ?> → <?= date('d/m/Y', strtotime($a['fecha_fin'])) ?>`. |
| `153` | `                            </td>` | Celda de tabla con contenido de datos o encabezado de columna: `</td>`. |
| `154` | `                            <td><span class="badge <?= $badgeAsig ?>"><?= $...` | Celda de tabla con contenido de datos o encabezado de columna: `<td><span class="badge <?= $badgeAsig ?>"><?= $a['estado'] ?></span></td>`. |
| `155` | `                            <td class="text-center small"><?= (int)$a['tota...` | Celda de tabla con contenido de datos o encabezado de columna: `<td class="text-center small"><?= (int)$a['total_evidencias'] ?></td>`. |
| `156` | `                            <td>` | Celda de tabla con contenido de datos o encabezado de columna: `<td>`. |
| `157` | `                                <div class="d-flex gap-1">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="d-flex gap-1">`. |
| `158` | `                                    <?php if ($editable): ?>` | Instrucción de ejecución en el contexto del script: `<?php if ($editable): ?>`. |
| `159` | `                                    <button class="btn btn-sm btn-outline-p...` | Botón de acción interactivo para el usuario: `<button class="btn btn-sm btn-outline-primary"`. |
| `160` | `                                            onclick='abrirEditarAsignacion(...` | Instrucción de ejecución en el contexto del script: `onclick='abrirEditarAsignacion(<?= json_encode($a) ?>)'`. |
| `161` | `                                            title="Editar asignación">` | Instrucción de ejecución en el contexto del script: `title="Editar asignación">`. |
| `162` | `                                        <i class="fas fa-pen"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-pen"></i>`. |
| `163` | `                                    </button>` | Botón de acción interactivo para el usuario: `</button>`. |
| `164` | `                                    <form action="../../controllers/AdminCo...` | Formulario para recolección y envío de datos del usuario: `<form action="../../controllers/AdminController.php" method="POST" class="d-inline">`. |
| `165` | `                                        <input type="hidden" name="accion" ...` | Campo de entrada interactivo para datos del usuario: `<input type="hidden" name="accion"        value="cancelar_asignacion">`. |
| `166` | `                                        <input type="hidden" name="id_asign...` | Campo de entrada interactivo para datos del usuario: `<input type="hidden" name="id_asignacion" value="<?= $a['id_asignacion'] ?>">`. |
| `167` | `                                        <button type="submit" class="btn bt...` | Botón de acción interactivo para el usuario: `<button type="submit" class="btn btn-sm btn-outline-danger"`. |
| `168` | `                                                onclick="return confirm('¿C...` | Instrucción de ejecución en el contexto del script: `onclick="return confirm('¿Cancelar esta asignación? Se eliminarán los turnos pendientes.')"`. |
| `169` | `                                                title="Cancelar asignación">` | Instrucción de ejecución en el contexto del script: `title="Cancelar asignación">`. |
| `170` | `                                            <i class="fas fa-ban"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-ban"></i>`. |
| `171` | `                                        </button>` | Botón de acción interactivo para el usuario: `</button>`. |
| `172` | `                                    </form>` | Cierre de formulario HTML. |
| `173` | `                                    <?php else: ?>` | Instrucción de ejecución en el contexto del script: `<?php else: ?>`. |
| `174` | `                                    <span class="text-muted small">—</span>` | Instrucción de ejecución en el contexto del script: `<span class="text-muted small">—</span>`. |
| `175` | `                                    <?php endif; ?>` | Instrucción de ejecución en el contexto del script: `<?php endif; ?>`. |
| `176` | `                                </div>` | Cierre de contenedor visual `<div>`. |
| `177` | `                            </td>` | Celda de tabla con contenido de datos o encabezado de columna: `</td>`. |
| `178` | `                        </tr>` | Fila contenedora de datos dentro de la tabla. |
| `179` | `                        <?php endforeach; ?>` | Instrucción de ejecución en el contexto del script: `<?php endforeach; ?>`. |
| `180` | `                        <?php if (empty($asignaciones)): ?>` | Instrucción de ejecución en el contexto del script: `<?php if (empty($asignaciones)): ?>`. |
| `181` | `                        <tr><td colspan="9" class="text-center text-muted p...` | Fila contenedora de datos dentro de la tabla. |
| `182` | `                        <?php endif; ?>` | Instrucción de ejecución en el contexto del script: `<?php endif; ?>`. |
| `183` | `                        </tbody>` | Instrucción de ejecución en el contexto del script: `</tbody>`. |
| `184` | `                    </table>` | Tabla de datos para despliegue estructurado de información: `</table>`. |
| `185` | `                </div>` | Cierre de contenedor visual `<div>`. |
| `186` | `            </div>` | Cierre de contenedor visual `<div>`. |
| `187` | `        </div>` | Cierre de contenedor visual `<div>`. |
| `188` | `    </div>` | Cierre de contenedor visual `<div>`. |
| `189` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `190` | `</div><!-- /tab-content -->` | Cierre de contenedor visual `<div>`. |
| `191` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `192` | `<!-- Modal Módulo -->` | Instrucción de ejecución en el contexto del script: `<!-- Modal Módulo -->`. |
| `193` | `<div class="modal fade" id="modalModulo" tabindex="-1" aria-hidden="true">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="modal fade" id="modalModulo" tabindex="-1" aria-hidden="true">`. |
| `194` | `    <div class="modal-dialog modal-dialog-centered">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="modal-dialog modal-dialog-centered">`. |
| `195` | `        <div class="modal-content shadow">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="modal-content shadow">`. |
| `196` | `            <div class="modal-header" style="background:#0f2200; color:#fff;">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="modal-header" style="background:#0f2200; color:#fff;">`. |
| `197` | `                <h6 class="modal-title fw-bold" id="titModalModulo"><i clas...` | Instrucción de ejecución en el contexto del script: `<h6 class="modal-title fw-bold" id="titModalModulo"><i class="fas fa-door-open me-2 text-success"></i>Nuevo Módulo</h6>`. |
| `198` | `                <button type="button" class="btn-close btn-close-white" dat...` | Botón de acción interactivo para el usuario: `<button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>`. |
| `199` | `            </div>` | Cierre de contenedor visual `<div>`. |
| `200` | `            <form action="../../controllers/AdminController.php" method="PO...` | Formulario para recolección y envío de datos del usuario: `<form action="../../controllers/AdminController.php" method="POST">`. |
| `201` | `                <input type="hidden" name="accion"    value="guardar_modulo">` | Campo de entrada interactivo para datos del usuario: `<input type="hidden" name="accion"    value="guardar_modulo">`. |
| `202` | `                <input type="hidden" name="id_modulo" id="id_modulo" value="">` | Campo de entrada interactivo para datos del usuario: `<input type="hidden" name="id_modulo" id="id_modulo" value="">`. |
| `203` | `                <div class="modal-body px-4 py-4">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="modal-body px-4 py-4">`. |
| `204` | `                    <div class="mb-3">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="mb-3">`. |
| `205` | `                        <label class="form-label fw-semibold small">Nombre ...` | Instrucción de ejecución en el contexto del script: `<label class="form-label fw-semibold small">Nombre del Módulo <span class="text-danger">*</span></label>`. |
| `206` | `                        <input type="text" name="nombre" id="mod_nombre" cl...` | Campo de entrada interactivo para datos del usuario: `<input type="text" name="nombre" id="mod_nombre" class="form-control" required placeholder="Ej: Módulo 12 – Sistemas">`. |
| `207` | `                    </div>` | Cierre de contenedor visual `<div>`. |
| `208` | `                    <div class="mb-3">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="mb-3">`. |
| `209` | `                        <label class="form-label fw-semibold small">Ubicaci...` | Instrucción de ejecución en el contexto del script: `<label class="form-label fw-semibold small">Ubicación</label>`. |
| `210` | `                        <input type="text" name="ubicacion" id="mod_ubicaci...` | Campo de entrada interactivo para datos del usuario: `<input type="text" name="ubicacion" id="mod_ubicacion" class="form-control" placeholder="Ej: Bloque B, Piso 2">`. |
| `211` | `                    </div>` | Cierre de contenedor visual `<div>`. |
| `212` | `                    <div class="mb-3">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="mb-3">`. |
| `213` | `                        <label class="form-label fw-semibold small">Capacid...` | Instrucción de ejecución en el contexto del script: `<label class="form-label fw-semibold small">Capacidad (personas)</label>`. |
| `214` | `                        <input type="number" name="capacidad" id="mod_capac...` | Campo de entrada interactivo para datos del usuario: `<input type="number" name="capacidad" id="mod_capacidad" class="form-control" min="1" placeholder="30">`. |
| `215` | `                    </div>` | Cierre de contenedor visual `<div>`. |
| `216` | `                    <div class="mb-1">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="mb-1">`. |
| `217` | `                        <label class="form-label fw-semibold small">Descrip...` | Instrucción de ejecución en el contexto del script: `<label class="form-label fw-semibold small">Descripción</label>`. |
| `218` | `                        <textarea name="descripcion" id="mod_desc" class="f...` | Instrucción de ejecución en el contexto del script: `<textarea name="descripcion" id="mod_desc" class="form-control" rows="2" placeholder="Descripción opcional…"></textarea>`. |
| `219` | `                    </div>` | Cierre de contenedor visual `<div>`. |
| `220` | `                </div>` | Cierre de contenedor visual `<div>`. |
| `221` | `                <div class="modal-footer px-4">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="modal-footer px-4">`. |
| `222` | `                    <button type="button" class="btn btn-sm btn-outline-sec...` | Botón de acción interactivo para el usuario: `<button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>`. |
| `223` | `                    <button type="submit" class="btn btn-sm btn-success fw-...` | Botón de acción interactivo para el usuario: `<button type="submit" class="btn btn-sm btn-success fw-semibold px-4"><i class="fas fa-save me-1"></i>Guardar</button>`. |
| `224` | `                </div>` | Cierre de contenedor visual `<div>`. |
| `225` | `            </form>` | Cierre de formulario HTML. |
| `226` | `        </div>` | Cierre de contenedor visual `<div>`. |
| `227` | `    </div>` | Cierre de contenedor visual `<div>`. |
| `228` | `</div>` | Cierre de contenedor visual `<div>`. |
| `229` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `230` | `<!-- Modal Asignación -->` | Instrucción de ejecución en el contexto del script: `<!-- Modal Asignación -->`. |
| `231` | `<div class="modal fade" id="modalAsignacion" tabindex="-1" aria-hidden="true">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="modal fade" id="modalAsignacion" tabindex="-1" aria-hidden="true">`. |
| `232` | `    <div class="modal-dialog modal-dialog-centered">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="modal-dialog modal-dialog-centered">`. |
| `233` | `        <div class="modal-content shadow">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="modal-content shadow">`. |
| `234` | `            <div class="modal-header" style="background:#0f2200; color:#fff;">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="modal-header" style="background:#0f2200; color:#fff;">`. |
| `235` | `                <h6 class="modal-title fw-bold"><i class="fas fa-link me-2 ...` | Instrucción de ejecución en el contexto del script: `<h6 class="modal-title fw-bold"><i class="fas fa-link me-2 text-success"></i>Asignar Módulo a Ficha</h6>`. |
| `236` | `                <button type="button" class="btn-close btn-close-white" dat...` | Botón de acción interactivo para el usuario: `<button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>`. |
| `237` | `            </div>` | Cierre de contenedor visual `<div>`. |
| `238` | `            <form action="../../controllers/AdminController.php" method="PO...` | Formulario para recolección y envío de datos del usuario: `<form action="../../controllers/AdminController.php" method="POST">`. |
| `239` | `                <input type="hidden" name="accion" value="asignar_modulo">` | Campo de entrada interactivo para datos del usuario: `<input type="hidden" name="accion" value="asignar_modulo">`. |
| `240` | `                <div class="modal-body px-4 py-4">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="modal-body px-4 py-4">`. |
| `241` | `                    <div class="mb-3">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="mb-3">`. |
| `242` | `                        <label class="form-label fw-semibold small">Módulo ...` | Instrucción de ejecución en el contexto del script: `<label class="form-label fw-semibold small">Módulo <span class="text-danger">*</span></label>`. |
| `243` | `                        <select name="id_modulo" class="form-select" required>` | Menú desplegable de opciones de selección: `<select name="id_modulo" class="form-select" required>`. |
| `244` | `                            <option value="">-- Seleccionar módulo --</option>` | Elemento de opción seleccionable dentro de una lista: `<option value="">-- Seleccionar módulo --</option>`. |
| `245` | `                            <?php foreach ($modulos as $m): ?>` | Instrucción de ejecución en el contexto del script: `<?php foreach ($modulos as $m): ?>`. |
| `246` | `                            <option value="<?= $m['id_modulo'] ?>"><?= html...` | Elemento de opción seleccionable dentro de una lista: `<option value="<?= $m['id_modulo'] ?>"><?= htmlspecialchars($m['nombre']) ?></option>`. |
| `247` | `                            <?php endforeach; ?>` | Instrucción de ejecución en el contexto del script: `<?php endforeach; ?>`. |
| `248` | `                        </select>` | Menú desplegable de opciones de selección: `</select>`. |
| `249` | `                    </div>` | Cierre de contenedor visual `<div>`. |
| `250` | `                    <div class="mb-3">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="mb-3">`. |
| `251` | `                        <label class="form-label fw-semibold small">Ficha <...` | Instrucción de ejecución en el contexto del script: `<label class="form-label fw-semibold small">Ficha <span class="text-danger">*</span></label>`. |
| `252` | `                        <select name="id_ficha" class="form-select" required>` | Menú desplegable de opciones de selección: `<select name="id_ficha" class="form-select" required>`. |
| `253` | `                            <option value="">-- Seleccionar ficha --</option>` | Elemento de opción seleccionable dentro de una lista: `<option value="">-- Seleccionar ficha --</option>`. |
| `254` | `                            <?php foreach ($fichas as $f): ?>` | Instrucción de ejecución en el contexto del script: `<?php foreach ($fichas as $f): ?>`. |
| `255` | `                            <option value="<?= $f['id_ficha'] ?>"><?= htmls...` | Elemento de opción seleccionable dentro de una lista: `<option value="<?= $f['id_ficha'] ?>"><?= htmlspecialchars($f['numero_ficha'] . ' – ' . $f['nombre_programa']) ?></option>`. |
| `256` | `                            <?php endforeach; ?>` | Instrucción de ejecución en el contexto del script: `<?php endforeach; ?>`. |
| `257` | `                        </select>` | Menú desplegable de opciones de selección: `</select>`. |
| `258` | `                    </div>` | Cierre de contenedor visual `<div>`. |
| `259` | `                    <div class="mb-1">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="mb-1">`. |
| `260` | `                        <label class="form-label fw-semibold small">` | Instrucción de ejecución en el contexto del script: `<label class="form-label fw-semibold small">`. |
| `261` | `                            Fecha de inicio de limpieza <span class="text-d...` | Instrucción de ejecución en el contexto del script: `Fecha de inicio de limpieza <span class="text-danger">*</span>`. |
| `262` | `                        </label>` | Instrucción de ejecución en el contexto del script: `</label>`. |
| `263` | `                        <input type="date" name="fecha_inicio" id="asig_fec...` | Campo de entrada interactivo para datos del usuario: `<input type="date" name="fecha_inicio" id="asig_fecha_inicio"`. |
| `264` | `                               class="form-control" required` | Instrucción de ejecución en el contexto del script: `class="form-control" required`. |
| `265` | `                               min="<?= date('Y-m-d') ?>">` | Instrucción de ejecución en el contexto del script: `min="<?= date('Y-m-d') ?>">`. |
| `266` | `                        <div class="form-text" style="color:#4f46e5; font-s...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="form-text" style="color:#4f46e5; font-size:.8rem;">`. |
| `267` | `                            <i class="fas fa-rotate me-1"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-rotate me-1"></i>`. |
| `268` | `                            Según este día de la semana se programará la li...` | Instrucción de ejecución en el contexto del script: `Según este día de la semana se programará la limpieza <strong>cada semana</strong> de forma automática.`. |
| `269` | `                            Por ejemplo, si eliges un miércoles, la limpiez...` | Instrucción de ejecución en el contexto del script: `Por ejemplo, si eliges un miércoles, la limpieza será todos los miércoles.`. |
| `270` | `                        </div>` | Cierre de contenedor visual `<div>`. |
| `271` | `                    </div>` | Cierre de contenedor visual `<div>`. |
| `272` | `                </div>` | Cierre de contenedor visual `<div>`. |
| `273` | `                <div class="modal-footer px-4">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="modal-footer px-4">`. |
| `274` | `                    <button type="button" class="btn btn-sm btn-outline-sec...` | Botón de acción interactivo para el usuario: `<button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>`. |
| `275` | `                    <button type="submit" class="btn btn-sm btn-success fw-...` | Botón de acción interactivo para el usuario: `<button type="submit" class="btn btn-sm btn-success fw-semibold px-4"><i class="fas fa-link me-1"></i>Asignar</button>`. |
| `276` | `                </div>` | Cierre de contenedor visual `<div>`. |
| `277` | `            </form>` | Cierre de formulario HTML. |
| `278` | `        </div>` | Cierre de contenedor visual `<div>`. |
| `279` | `    </div>` | Cierre de contenedor visual `<div>`. |
| `280` | `</div>` | Cierre de contenedor visual `<div>`. |
| `281` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `282` | `<!-- Modal Editar Asignación -->` | Instrucción de ejecución en el contexto del script: `<!-- Modal Editar Asignación -->`. |
| `283` | `<div class="modal fade" id="modalEditarAsig" tabindex="-1" aria-hidden="true">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="modal fade" id="modalEditarAsig" tabindex="-1" aria-hidden="true">`. |
| `284` | `    <div class="modal-dialog modal-dialog-centered">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="modal-dialog modal-dialog-centered">`. |
| `285` | `        <div class="modal-content shadow">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="modal-content shadow">`. |
| `286` | `            <div class="modal-header" style="background:#0f2200; color:#fff;">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="modal-header" style="background:#0f2200; color:#fff;">`. |
| `287` | `                <h6 class="modal-title fw-bold">` | Instrucción de ejecución en el contexto del script: `<h6 class="modal-title fw-bold">`. |
| `288` | `                    <i class="fas fa-pen me-2 text-success"></i>Editar Asig...` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-pen me-2 text-success"></i>Editar Asignación`. |
| `289` | `                </h6>` | Instrucción de ejecución en el contexto del script: `</h6>`. |
| `290` | `                <button type="button" class="btn-close btn-close-white" dat...` | Botón de acción interactivo para el usuario: `<button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>`. |
| `291` | `            </div>` | Cierre de contenedor visual `<div>`. |
| `292` | `            <form action="../../controllers/AdminController.php" method="PO...` | Formulario para recolección y envío de datos del usuario: `<form action="../../controllers/AdminController.php" method="POST">`. |
| `293` | `                <input type="hidden" name="accion"        value="editar_asi...` | Campo de entrada interactivo para datos del usuario: `<input type="hidden" name="accion"        value="editar_asignacion">`. |
| `294` | `                <input type="hidden" name="id_asignacion" id="ea_id">` | Campo de entrada interactivo para datos del usuario: `<input type="hidden" name="id_asignacion" id="ea_id">`. |
| `295` | `                <div class="modal-body px-4 py-4">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="modal-body px-4 py-4">`. |
| `296` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `297` | `                    <!-- Módulo (solo lectura) -->` | Instrucción de ejecución en el contexto del script: `<!-- Módulo (solo lectura) -->`. |
| `298` | `                    <div class="mb-3">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="mb-3">`. |
| `299` | `                        <label class="form-label fw-semibold small">Módulo<...` | Instrucción de ejecución en el contexto del script: `<label class="form-label fw-semibold small">Módulo</label>`. |
| `300` | `                        <input type="text" id="ea_modulo" class="form-contr...` | Campo de entrada interactivo para datos del usuario: `<input type="text" id="ea_modulo" class="form-control bg-light" disabled>`. |
| `301` | `                        <div class="form-text text-muted">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="form-text text-muted">`. |
| `302` | `                            El módulo no puede cambiarse. Cancela y crea un...` | Instrucción de ejecución en el contexto del script: `El módulo no puede cambiarse. Cancela y crea una nueva asignación si necesitas otro módulo.`. |
| `303` | `                        </div>` | Cierre de contenedor visual `<div>`. |
| `304` | `                    </div>` | Cierre de contenedor visual `<div>`. |
| `305` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `306` | `                    <!-- Ficha -->` | Instrucción de ejecución en el contexto del script: `<!-- Ficha -->`. |
| `307` | `                    <div class="mb-3">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="mb-3">`. |
| `308` | `                        <label class="form-label fw-semibold small">Ficha <...` | Instrucción de ejecución en el contexto del script: `<label class="form-label fw-semibold small">Ficha <span class="text-danger">*</span></label>`. |
| `309` | `                        <select name="id_ficha" id="ea_ficha" class="form-s...` | Menú desplegable de opciones de selección: `<select name="id_ficha" id="ea_ficha" class="form-select" required>`. |
| `310` | `                            <option value="">-- Seleccionar ficha --</option>` | Elemento de opción seleccionable dentro de una lista: `<option value="">-- Seleccionar ficha --</option>`. |
| `311` | `                            <?php foreach ($fichas as $f): ?>` | Instrucción de ejecución en el contexto del script: `<?php foreach ($fichas as $f): ?>`. |
| `312` | `                            <option value="<?= $f['id_ficha'] ?>">` | Elemento de opción seleccionable dentro de una lista: `<option value="<?= $f['id_ficha'] ?>">`. |
| `313` | `                                <?= htmlspecialchars($f['numero_ficha'] . '...` | Instrucción de ejecución en el contexto del script: `<?= htmlspecialchars($f['numero_ficha'] . ' – ' . $f['nombre_programa']) ?>`. |
| `314` | `                            </option>` | Instrucción de ejecución en el contexto del script: `</option>`. |
| `315` | `                            <?php endforeach; ?>` | Instrucción de ejecución en el contexto del script: `<?php endforeach; ?>`. |
| `316` | `                        </select>` | Menú desplegable de opciones de selección: `</select>`. |
| `317` | `                    </div>` | Cierre de contenedor visual `<div>`. |
| `318` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `319` | `                    <!-- Solo fecha de inicio -->` | Instrucción de ejecución en el contexto del script: `<!-- Solo fecha de inicio -->`. |
| `320` | `                    <div class="mb-1">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="mb-1">`. |
| `321` | `                        <label class="form-label fw-semibold small">` | Instrucción de ejecución en el contexto del script: `<label class="form-label fw-semibold small">`. |
| `322` | `                            Fecha de inicio de limpieza <span class="text-d...` | Instrucción de ejecución en el contexto del script: `Fecha de inicio de limpieza <span class="text-danger">*</span>`. |
| `323` | `                        </label>` | Instrucción de ejecución en el contexto del script: `</label>`. |
| `324` | `                        <input type="date" name="fecha_inicio" id="ea_inici...` | Campo de entrada interactivo para datos del usuario: `<input type="date" name="fecha_inicio" id="ea_inicio" class="form-control" required>`. |
| `325` | `                        <div class="form-text" style="color:#4f46e5; font-s...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="form-text" style="color:#4f46e5; font-size:.8rem;">`. |
| `326` | `                            <i class="fas fa-rotate me-1"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-rotate me-1"></i>`. |
| `327` | `                            Según este día de la semana se programará la li...` | Instrucción de ejecución en el contexto del script: `Según este día de la semana se programará la limpieza <strong>cada semana</strong> de forma automática.`. |
| `328` | `                        </div>` | Cierre de contenedor visual `<div>`. |
| `329` | `                        <div class="form-text text-warning fw-semibold mt-1">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="form-text text-warning fw-semibold mt-1">`. |
| `330` | `                            <i class="fas fa-triangle-exclamation me-1"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-triangle-exclamation me-1"></i>`. |
| `331` | `                            Al guardar, los turnos anteriores se eliminarán...` | Instrucción de ejecución en el contexto del script: `Al guardar, los turnos anteriores se eliminarán y se regenerarán desde la nueva fecha.`. |
| `332` | `                        </div>` | Cierre de contenedor visual `<div>`. |
| `333` | `                    </div>` | Cierre de contenedor visual `<div>`. |
| `334` | `                </div>` | Cierre de contenedor visual `<div>`. |
| `335` | `                <div class="modal-footer px-4">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="modal-footer px-4">`. |
| `336` | `                    <button type="button" class="btn btn-sm btn-outline-sec...` | Botón de acción interactivo para el usuario: `<button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>`. |
| `337` | `                    <button type="submit" class="btn btn-sm btn-success fw-...` | Botón de acción interactivo para el usuario: `<button type="submit" class="btn btn-sm btn-success fw-semibold px-4">`. |
| `338` | `                        <i class="fas fa-save me-1"></i>Guardar cambios` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-save me-1"></i>Guardar cambios`. |
| `339` | `                    </button>` | Botón de acción interactivo para el usuario: `</button>`. |
| `340` | `                </div>` | Cierre de contenedor visual `<div>`. |
| `341` | `            </form>` | Cierre de formulario HTML. |
| `342` | `        </div>` | Cierre de contenedor visual `<div>`. |
| `343` | `    </div>` | Cierre de contenedor visual `<div>`. |
| `344` | `</div>` | Cierre de contenedor visual `<div>`. |
| `345` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `346` | `<?php if ($alert): ?>` | Instrucción de ejecución en el contexto del script: `<?php if ($alert): ?>`. |
| `347` | `<script>` | Bloque o etiqueta de vinculación para scripts JavaScript del lado del cliente. |
| `348` | `document.addEventListener('DOMContentLoaded', function() {` | Instrucción de ejecución en el contexto del script: `document.addEventListener('DOMContentLoaded', function() {`. |
| `349` | `    Swal.fire({ icon:'<?= addslashes($alert['icon']) ?>', title:'<?= addsla...` | Instrucción de ejecución en el contexto del script: `Swal.fire({ icon:'<?= addslashes($alert['icon']) ?>', title:'<?= addslashes($alert['title']) ?>', text:'<?= addslashes($alert['text']) ?>', confirmButtonColor:'#39a900' });`. |
| `350` | `});` | Instrucción de ejecución en el contexto del script: `});`. |
| `351` | `</script>` | Bloque o etiqueta de vinculación para scripts JavaScript del lado del cliente. |
| `352` | `<?php endif; ?>` | Instrucción de ejecución en el contexto del script: `<?php endif; ?>`. |
| `353` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `354` | `<script>` | Bloque o etiqueta de vinculación para scripts JavaScript del lado del cliente. |
| `355` | `function editarModulo(m) {` | Declaración de método o función con su firma y parámetros: `function editarModulo(m) {`. |
| `356` | `    document.getElementById('titModalModulo').innerHTML = '<i class="fas fa...` | Instrucción de ejecución en el contexto del script: `document.getElementById('titModalModulo').innerHTML = '<i class="fas fa-pen me-2 text-success"></i>Editar Módulo';`. |
| `357` | `    document.getElementById('id_modulo').value    = m.id_modulo;` | Instrucción de ejecución en el contexto del script: `document.getElementById('id_modulo').value    = m.id_modulo;`. |
| `358` | `    document.getElementById('mod_nombre').value   = m.nombre;` | Instrucción de ejecución en el contexto del script: `document.getElementById('mod_nombre').value   = m.nombre;`. |
| `359` | `    document.getElementById('mod_ubicacion').value= m.ubicacion  \|\| '';` | Instrucción de ejecución en el contexto del script: `document.getElementById('mod_ubicacion').value= m.ubicacion  \|\| '';`. |
| `360` | `    document.getElementById('mod_capacidad').value= m.capacidad  \|\| '';` | Instrucción de ejecución en el contexto del script: `document.getElementById('mod_capacidad').value= m.capacidad  \|\| '';`. |
| `361` | `    document.getElementById('mod_desc').value     = m.descripcion\|\| '';` | Instrucción de ejecución en el contexto del script: `document.getElementById('mod_desc').value     = m.descripcion\|\| '';`. |
| `362` | `    new bootstrap.Modal(document.getElementById('modalModulo')).show();` | Instrucción de ejecución en el contexto del script: `new bootstrap.Modal(document.getElementById('modalModulo')).show();`. |
| `363` | `}` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `364` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `365` | `document.getElementById('modalModulo').addEventListener('hidden.bs.modal', ...` | Instrucción de ejecución en el contexto del script: `document.getElementById('modalModulo').addEventListener('hidden.bs.modal', function() {`. |
| `366` | `    document.getElementById('id_modulo').value     = '';` | Instrucción de ejecución en el contexto del script: `document.getElementById('id_modulo').value     = '';`. |
| `367` | `    document.getElementById('mod_nombre').value    = '';` | Instrucción de ejecución en el contexto del script: `document.getElementById('mod_nombre').value    = '';`. |
| `368` | `    document.getElementById('mod_ubicacion').value = '';` | Instrucción de ejecución en el contexto del script: `document.getElementById('mod_ubicacion').value = '';`. |
| `369` | `    document.getElementById('mod_capacidad').value = '';` | Instrucción de ejecución en el contexto del script: `document.getElementById('mod_capacidad').value = '';`. |
| `370` | `    document.getElementById('mod_desc').value      = '';` | Instrucción de ejecución en el contexto del script: `document.getElementById('mod_desc').value      = '';`. |
| `371` | `    document.getElementById('titModalModulo').innerHTML = '<i class="fas fa...` | Instrucción de ejecución en el contexto del script: `document.getElementById('titModalModulo').innerHTML = '<i class="fas fa-door-open me-2 text-success"></i>Nuevo Módulo';`. |
| `372` | `});` | Instrucción de ejecución en el contexto del script: `});`. |
| `373` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `374` | `function abrirEditarAsignacion(a) {` | Declaración de método o función con su firma y parámetros: `function abrirEditarAsignacion(a) {`. |
| `375` | `    document.getElementById('ea_id').value     = a.id_asignacion;` | Instrucción de ejecución en el contexto del script: `document.getElementById('ea_id').value     = a.id_asignacion;`. |
| `376` | `    document.getElementById('ea_modulo').value = a.nombre_modulo;` | Instrucción de ejecución en el contexto del script: `document.getElementById('ea_modulo').value = a.nombre_modulo;`. |
| `377` | `    document.getElementById('ea_ficha').value  = a.id_ficha;` | Instrucción de ejecución en el contexto del script: `document.getElementById('ea_ficha').value  = a.id_ficha;`. |
| `378` | `    document.getElementById('ea_inicio').value = a.fecha_inicio;` | Instrucción de ejecución en el contexto del script: `document.getElementById('ea_inicio').value = a.fecha_inicio;`. |
| `379` | `    new bootstrap.Modal(document.getElementById('modalEditarAsig')).show();` | Instrucción de ejecución en el contexto del script: `new bootstrap.Modal(document.getElementById('modalEditarAsig')).show();`. |
| `380` | `}` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `381` | `</script>` | Bloque o etiqueta de vinculación para scripts JavaScript del lado del cliente. |
| `382` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `383` | `<style>` | Instrucción de ejecución en el contexto del script: `<style>`. |
| `384` | `.rounded-top-0 { border-top-left-radius:0!important; border-top-right-radiu...` | Instrucción de ejecución en el contexto del script: `.rounded-top-0 { border-top-left-radius:0!important; border-top-right-radius:0!important; }`. |
| `385` | `.nav-tabs .nav-link { font-size:.875rem; color:#64748b; }` | Instrucción de ejecución en el contexto del script: `.nav-tabs .nav-link { font-size:.875rem; color:#64748b; }`. |
| `386` | `.nav-tabs .nav-link.active { color:#39a900; font-weight:600; }` | Instrucción de ejecución en el contexto del script: `.nav-tabs .nav-link.active { color:#39a900; font-weight:600; }`. |
| `387` | `</style>` | Instrucción de ejecución en el contexto del script: `</style>`. |
| `388` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `389` | `<?php require_once __DIR__ . '/../layouts/footer.php'; ?>` | Instrucción de ejecución en el contexto del script: `<?php require_once __DIR__ . '/../layouts/footer.php'; ?>`. |

---

## 3. Resumen y Flujo de Interacción

El archivo `admin_modulos.php` cumple un rol indispensable en `views/dashboard/admin_modulos.php`. 
Interfaz para crear y administrar los ambientes o módulos físicos del centro y vincularlos con las fichas. Garantiza la robustez, el orden y la estabilidad de la arquitectura del proyecto `systemLimpieza`.
