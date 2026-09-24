# Documentación Línea por Línea: `views/dashboard/vocero_grupos.php`

## 1. Ficha Técnica del Archivo

- **Archivo:** `vocero_grupos.php`
- **Ruta en el proyecto:** `views/dashboard/vocero_grupos.php`
- **Cantidad total de líneas:** `376`
- **Tipo de archivo:** `PHP`
- **Propósito general:** Módulo donde el vocero organiza, crea y edita los grupos de aprendices para la rotación de limpieza.

---

## 2. Explicación Detallada Línea por Línea

A continuación se presenta cada línea de código numerada de forma consecutiva, acompañada de su fragmento exacto y la explicación exhaustiva de su funcionamiento y responsabilidad en el sistema:

| Línea | Código Fuente | Explicación Detallada |
|---|---|---|
| `1` | `<?php` | Apertura obligatoria de la etiqueta PHP para ejecución del código del lado del servidor. |
| `2` | `$titulo = 'Mis Grupos de Limpieza';` | Instrucción de ejecución en el contexto del script: `$titulo = 'Mis Grupos de Limpieza';`. |
| `3` | `if (session_status() === PHP_SESSION_NONE) session_start();` | Inicia o reanuda la sesión PHP del usuario si no se encontraba activa previamente. |
| `4` | `if (!isset($_SESSION['usuario']) \|\| (int)$_SESSION['usuario']['rol'] !== ...` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (!isset($_SESSION['usuario']) \|\| (int)$_SESSION['usuario']['rol'] !== 2) {`. |
| `5` | `    header("Location: ../usuarios/login.php"); exit;` | Emite cabecera HTTP de redirección en el navegador: `header("Location: ../usuarios/login.php"); exit;`. |
| `6` | `}` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `7` | `require_once __DIR__ . '/../../config/database.php';` | Importación e inclusión obligatoria del archivo de dependencia requerido: `require_once __DIR__ . '/../../config/database.php';`. |
| `8` | `require_once __DIR__ . '/../../models/Grupo.php';` | Importación e inclusión obligatoria del archivo de dependencia requerido: `require_once __DIR__ . '/../../models/Grupo.php';`. |
| `9` | `require_once __DIR__ . '/../../models/Ficha.php';` | Importación e inclusión obligatoria del archivo de dependencia requerido: `require_once __DIR__ . '/../../models/Ficha.php';`. |
| `10` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `11` | `$db     = (new Database())->conectar();` | Instrucción de ejecución en el contexto del script: `$db     = (new Database())->conectar();`. |
| `12` | `$alert  = $_SESSION['alert'] ?? null;` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección: `$alert  = $_SESSION['alert'] ?? null;`. |
| `13` | `unset($_SESSION['alert']);` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección: `unset($_SESSION['alert']);`. |
| `14` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `15` | `$idUsuario = (int)$_SESSION['usuario']['id_usuario'];` | Accede o almacena información de identidad del usuario en la sesión activa: `$idUsuario = (int)$_SESSION['usuario']['id_usuario'];`. |
| `16` | `$stmtV     = $db->prepare("SELECT * FROM voceros WHERE id_usuario=:id AND a...` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmtV     = $db->prepare("SELECT * FROM voceros WHERE id_usuario=:id AND activo=1 LIMIT 1");`. |
| `17` | `$stmtV->execute([':id' => $idUsuario]);` | Ejecuta la sentencia SQL preparada vinculando los datos correspondientes: `$stmtV->execute([':id' => $idUsuario]);`. |
| `18` | `$vocero    = $stmtV->fetch(PDO::FETCH_ASSOC);` | Recupera una única fila o registro resultante de la consulta. |
| `19` | `$idVocero  = $vocero ? (int)$vocero['id_vocero'] : 0;` | Instrucción de ejecución en el contexto del script: `$idVocero  = $vocero ? (int)$vocero['id_vocero'] : 0;`. |
| `20` | `$idFicha   = $vocero ? (int)$vocero['id_ficha']  : 0;` | Instrucción de ejecución en el contexto del script: `$idFicha   = $vocero ? (int)$vocero['id_ficha']  : 0;`. |
| `21` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `22` | `$grupos = (new Grupo($db))->obtenerPorVocero($idVocero);` | Instrucción de ejecución en el contexto del script: `$grupos = (new Grupo($db))->obtenerPorVocero($idVocero);`. |
| `23` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `24` | `// Asignación activa de la ficha (solo puede haber UNA)` | Comentario de línea explicativo: `Asignación activa de la ficha (solo puede haber UNA)`. |
| `25` | `$stmtAsig = $db->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmtAsig = $db->prepare(`. |
| `26` | `    "SELECT a.*, m.nombre AS nombre_modulo, m.ubicacion,` | Instrucción de ejecución en el contexto del script: `"SELECT a.*, m.nombre AS nombre_modulo, m.ubicacion,`. |
| `27` | `            f.numero_ficha` | Instrucción de ejecución en el contexto del script: `f.numero_ficha`. |
| `28` | `     FROM asignaciones a` | Instrucción de ejecución en el contexto del script: `FROM asignaciones a`. |
| `29` | `     JOIN modulos m ON m.id_modulo = a.id_modulo` | Instrucción de ejecución en el contexto del script: `JOIN modulos m ON m.id_modulo = a.id_modulo`. |
| `30` | `     JOIN fichas  f ON f.id_ficha  = a.id_ficha` | Instrucción de ejecución en el contexto del script: `JOIN fichas  f ON f.id_ficha  = a.id_ficha`. |
| `31` | `     WHERE a.id_ficha = :fic AND a.estado = 'Activa'` | Instrucción de ejecución en el contexto del script: `WHERE a.id_ficha = :fic AND a.estado = 'Activa'`. |
| `32` | `     ORDER BY a.fecha_creacion DESC LIMIT 1"` | Instrucción de ejecución en el contexto del script: `ORDER BY a.fecha_creacion DESC LIMIT 1"`. |
| `33` | `);` | Instrucción de ejecución en el contexto del script: `);`. |
| `34` | `$stmtAsig->execute([':fic' => $idFicha]);` | Ejecuta la sentencia SQL preparada vinculando los datos correspondientes: `$stmtAsig->execute([':fic' => $idFicha]);`. |
| `35` | `$asignacion = $stmtAsig->fetch(PDO::FETCH_ASSOC);` | Recupera una única fila o registro resultante de la consulta. |
| `36` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `37` | `// Próxima fecha libre (turno sin grupo) para mostrar en el modal` | Comentario de línea explicativo: `Próxima fecha libre (turno sin grupo) para mostrar en el modal`. |
| `38` | `$modelTurno    = new \stdClass(); // placeholder` | Instrucción de ejecución en el contexto del script: `$modelTurno    = new \stdClass(); // placeholder`. |
| `39` | `require_once __DIR__ . '/../../models/Turno.php';` | Importación e inclusión obligatoria del archivo de dependencia requerido: `require_once __DIR__ . '/../../models/Turno.php';`. |
| `40` | `$modelTurno      = new Turno($db);` | Instrucción de ejecución en el contexto del script: `$modelTurno      = new Turno($db);`. |
| `41` | `$proximaFecha    = $asignacion ? $modelTurno->proximaFechaLibre((int)$asign...` | Instrucción de ejecución en el contexto del script: `$proximaFecha    = $asignacion ? $modelTurno->proximaFechaLibre((int)$asignacion['id_asignacion']) : false;`. |
| `42` | `$turnosRestantes = $asignacion ? $modelTurno->turnosLibresRestantes((int)$a...` | Instrucción de ejecución en el contexto del script: `$turnosRestantes = $asignacion ? $modelTurno->turnosLibresRestantes((int)$asignacion['id_asignacion']) : 0;`. |
| `43` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `44` | `$diasES = ['Domingo','Lunes','Martes','Miércoles','Jueves','Viernes','Sábad...` | Instrucción de ejecución en el contexto del script: `$diasES = ['Domingo','Lunes','Martes','Miércoles','Jueves','Viernes','Sábado'];`. |
| `45` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `46` | `// Aprendices de la ficha` | Comentario de línea explicativo: `Aprendices de la ficha`. |
| `47` | `$aprendices = (new Ficha($db))->obtenerAprendicesDeFicha($idFicha);` | Instrucción de ejecución en el contexto del script: `$aprendices = (new Ficha($db))->obtenerAprendicesDeFicha($idFicha);`. |
| `48` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `49` | `require_once __DIR__ . '/../layouts/header.php';` | Importación e inclusión obligatoria del archivo de dependencia requerido: `require_once __DIR__ . '/../layouts/header.php';`. |
| `50` | `?>` | Cierre de la etiqueta PHP para alternar a salida HTML o fin del archivo. |
| `51` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `52` | `<div class="d-flex justify-content-between align-items-center mb-4">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="d-flex justify-content-between align-items-center mb-4">`. |
| `53` | `    <div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div>`. |
| `54` | `        <h4 class="fw-bold mb-0"><i class="fas fa-people-group text-success...` | Instrucción de ejecución en el contexto del script: `<h4 class="fw-bold mb-0"><i class="fas fa-people-group text-success me-2"></i>Mis Grupos de Limpieza</h4>`. |
| `55` | `        <p class="text-muted small mb-0">Registra y gestiona los grupos res...` | Instrucción de ejecución en el contexto del script: `<p class="text-muted small mb-0">Registra y gestiona los grupos responsables de la limpieza</p>`. |
| `56` | `    </div>` | Cierre de contenedor visual `<div>`. |
| `57` | `    <button class="btn btn-success btn-sm fw-semibold" data-bs-toggle="moda...` | Botón de acción interactivo para el usuario: `<button class="btn btn-success btn-sm fw-semibold" data-bs-toggle="modal" data-bs-target="#modalGrupo">`. |
| `58` | `        <i class="fas fa-plus me-1"></i> Nuevo Grupo` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-plus me-1"></i> Nuevo Grupo`. |
| `59` | `    </button>` | Botón de acción interactivo para el usuario: `</button>`. |
| `60` | `</div>` | Cierre de contenedor visual `<div>`. |
| `61` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `62` | `<!-- Módulo activo de la ficha -->` | Instrucción de ejecución en el contexto del script: `<!-- Módulo activo de la ficha -->`. |
| `63` | `<?php if ($asignacion): ?>` | Instrucción de ejecución en el contexto del script: `<?php if ($asignacion): ?>`. |
| `64` | `<div class="card border-0 shadow-sm mb-3"` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="card border-0 shadow-sm mb-3"`. |
| `65` | `     style="border-left:4px solid #39a900; background:linear-gradient(135de...` | Instrucción de ejecución en el contexto del script: `style="border-left:4px solid #39a900; background:linear-gradient(135deg,#f0fff4,#fff);">`. |
| `66` | `    <div class="card-body py-3 px-4 d-flex align-items-center gap-3 flex-wr...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="card-body py-3 px-4 d-flex align-items-center gap-3 flex-wrap">`. |
| `67` | `        <div style="width:42px;height:42px;border-radius:10px;background:#3...` | Contenedor visual estructurado con Bootstrap/CSS: `<div style="width:42px;height:42px;border-radius:10px;background:#39a900;`. |
| `68` | `                    color:#fff;display:flex;align-items:center;justify-cont...` | Instrucción de ejecución en el contexto del script: `color:#fff;display:flex;align-items:center;justify-content:center;flex-shrink:0;">`. |
| `69` | `            <i class="fas fa-door-open"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-door-open"></i>`. |
| `70` | `        </div>` | Cierre de contenedor visual `<div>`. |
| `71` | `        <div class="flex-grow-1">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="flex-grow-1">`. |
| `72` | `            <div class="text-muted" style="font-size:.72rem;text-transform:...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="text-muted" style="font-size:.72rem;text-transform:uppercase;letter-spacing:.4px;">`. |
| `73` | `                Módulo asignado a tu ficha` | Instrucción de ejecución en el contexto del script: `Módulo asignado a tu ficha`. |
| `74` | `            </div>` | Cierre de contenedor visual `<div>`. |
| `75` | `            <div class="fw-bold"><?= htmlspecialchars($asignacion['nombre_m...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="fw-bold"><?= htmlspecialchars($asignacion['nombre_modulo']) ?></div>`. |
| `76` | `            <?php if ($asignacion['ubicacion']): ?>` | Instrucción de ejecución en el contexto del script: `<?php if ($asignacion['ubicacion']): ?>`. |
| `77` | `            <div class="text-muted small">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="text-muted small">`. |
| `78` | `                <i class="fas fa-location-dot me-1"></i><?= htmlspecialchar...` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-location-dot me-1"></i><?= htmlspecialchars($asignacion['ubicacion']) ?>`. |
| `79` | `            </div>` | Cierre de contenedor visual `<div>`. |
| `80` | `            <?php endif; ?>` | Instrucción de ejecución en el contexto del script: `<?php endif; ?>`. |
| `81` | `        </div>` | Cierre de contenedor visual `<div>`. |
| `82` | `        <!-- Próxima fecha libre -->` | Instrucción de ejecución en el contexto del script: `<!-- Próxima fecha libre -->`. |
| `83` | `        <div class="text-center px-3 py-2 rounded-3" style="background:rgba...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="text-center px-3 py-2 rounded-3" style="background:rgba(57,169,0,.08); border:1px solid rgba(57,169,0,.2);">`. |
| `84` | `            <div class="text-muted" style="font-size:.7rem;text-transform:u...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="text-muted" style="font-size:.7rem;text-transform:uppercase;letter-spacing:.4px;">Próxima limpieza</div>`. |
| `85` | `            <?php if ($proximaFecha): ?>` | Instrucción de ejecución en el contexto del script: `<?php if ($proximaFecha): ?>`. |
| `86` | `                <div class="fw-bold text-success" style="font-size:1rem;">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="fw-bold text-success" style="font-size:1rem;">`. |
| `87` | `                    <?= date('d/m/Y', strtotime($proximaFecha)) ?>` | Instrucción de ejecución en el contexto del script: `<?= date('d/m/Y', strtotime($proximaFecha)) ?>`. |
| `88` | `                </div>` | Cierre de contenedor visual `<div>`. |
| `89` | `                <div class="text-muted" style="font-size:.75rem;">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="text-muted" style="font-size:.75rem;">`. |
| `90` | `                    <?= $diasES[(int)(new DateTime($proximaFecha))->format(...` | Instrucción de ejecución en el contexto del script: `<?= $diasES[(int)(new DateTime($proximaFecha))->format('w')] ?>`. |
| `91` | `                </div>` | Cierre de contenedor visual `<div>`. |
| `92` | `            <?php else: ?>` | Instrucción de ejecución en el contexto del script: `<?php else: ?>`. |
| `93` | `                <div class="text-muted small">Sin turnos<br>pendientes</div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="text-muted small">Sin turnos<br>pendientes</div>`. |
| `94` | `            <?php endif; ?>` | Instrucción de ejecución en el contexto del script: `<?php endif; ?>`. |
| `95` | `        </div>` | Cierre de contenedor visual `<div>`. |
| `96` | `        <div class="text-center px-3 py-2 rounded-3" style="background:rgba...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="text-center px-3 py-2 rounded-3" style="background:rgba(37,99,235,.06); border:1px solid rgba(37,99,235,.15);">`. |
| `97` | `            <div class="text-muted" style="font-size:.7rem;text-transform:u...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="text-muted" style="font-size:.7rem;text-transform:uppercase;letter-spacing:.4px;">Turnos sin grupo</div>`. |
| `98` | `            <div class="fw-bold" style="font-size:1rem; color:#2563eb;"><?=...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="fw-bold" style="font-size:1rem; color:#2563eb;"><?= $turnosRestantes ?></div>`. |
| `99` | `            <div class="text-muted" style="font-size:.75rem;">disponibles</...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="text-muted" style="font-size:.75rem;">disponibles</div>`. |
| `100` | `        </div>` | Cierre de contenedor visual `<div>`. |
| `101` | `        <div class="text-end">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="text-end">`. |
| `102` | `            <div class="text-muted" style="font-size:.72rem;">Cada</div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="text-muted" style="font-size:.72rem;">Cada</div>`. |
| `103` | `            <div class="fw-bold small">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="fw-bold small">`. |
| `104` | `                <?= $diasES[(int)($asignacion['dia_semana'] ?? 0)] ?>` | Instrucción de ejecución en el contexto del script: `<?= $diasES[(int)($asignacion['dia_semana'] ?? 0)] ?>`. |
| `105` | `            </div>` | Cierre de contenedor visual `<div>`. |
| `106` | `            <div class="text-muted" style="font-size:.72rem;">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="text-muted" style="font-size:.72rem;">`. |
| `107` | `                <?= date('d/m/Y', strtotime($asignacion['fecha_inicio'])) ?>` | Instrucción de ejecución en el contexto del script: `<?= date('d/m/Y', strtotime($asignacion['fecha_inicio'])) ?>`. |
| `108` | `                → <?= date('d/m/Y', strtotime($asignacion['fecha_fin'])) ?>` | Instrucción de ejecución en el contexto del script: `→ <?= date('d/m/Y', strtotime($asignacion['fecha_fin'])) ?>`. |
| `109` | `            </div>` | Cierre de contenedor visual `<div>`. |
| `110` | `        </div>` | Cierre de contenedor visual `<div>`. |
| `111` | `    </div>` | Cierre de contenedor visual `<div>`. |
| `112` | `</div>` | Cierre de contenedor visual `<div>`. |
| `113` | `<?php else: ?>` | Instrucción de ejecución en el contexto del script: `<?php else: ?>`. |
| `114` | `<div class="alert alert-warning border-0 shadow-sm mb-3 py-2 small">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="alert alert-warning border-0 shadow-sm mb-3 py-2 small">`. |
| `115` | `    <i class="fas fa-triangle-exclamation me-1"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-triangle-exclamation me-1"></i>`. |
| `116` | `    Tu ficha no tiene ningún módulo asignado todavía. Cuando el administrad...` | Instrucción de ejecución en el contexto del script: `Tu ficha no tiene ningún módulo asignado todavía. Cuando el administrador asigne uno,`. |
| `117` | `    aparecerá aquí y podrás crear grupos de limpieza.` | Instrucción de ejecución en el contexto del script: `aparecerá aquí y podrás crear grupos de limpieza.`. |
| `118` | `</div>` | Cierre de contenedor visual `<div>`. |
| `119` | `<?php endif; ?>` | Instrucción de ejecución en el contexto del script: `<?php endif; ?>`. |
| `120` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `121` | `<div class="card shadow-sm">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="card shadow-sm">`. |
| `122` | `    <div class="card-body p-0">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="card-body p-0">`. |
| `123` | `        <div class="table-responsive">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="table-responsive">`. |
| `124` | `            <table class="table tabla-limpia align-middle mb-0">` | Tabla de datos para despliegue estructurado de información: `<table class="table tabla-limpia align-middle mb-0">`. |
| `125` | `                <thead class="table-light">` | Celda de tabla con contenido de datos o encabezado de columna: `<thead class="table-light">`. |
| `126` | `                    <tr>` | Fila contenedora de datos dentro de la tabla. |
| `127` | `                        <th>Nombre del Grupo</th>` | Celda de tabla con contenido de datos o encabezado de columna: `<th>Nombre del Grupo</th>`. |
| `128` | `                        <th>Módulo</th>` | Celda de tabla con contenido de datos o encabezado de columna: `<th>Módulo</th>`. |
| `129` | `                        <th>Fecha Limpieza</th>` | Celda de tabla con contenido de datos o encabezado de columna: `<th>Fecha Limpieza</th>`. |
| `130` | `                        <th>Evidencia</th>` | Celda de tabla con contenido de datos o encabezado de columna: `<th>Evidencia</th>`. |
| `131` | `                        <th>Estado</th>` | Celda de tabla con contenido de datos o encabezado de columna: `<th>Estado</th>`. |
| `132` | `                        <th>Acciones</th>` | Celda de tabla con contenido de datos o encabezado de columna: `<th>Acciones</th>`. |
| `133` | `                    </tr>` | Fila contenedora de datos dentro de la tabla. |
| `134` | `                </thead>` | Instrucción de ejecución en el contexto del script: `</thead>`. |
| `135` | `                <tbody>` | Instrucción de ejecución en el contexto del script: `<tbody>`. |
| `136` | `                <?php foreach ($grupos as $g):` | Instrucción de ejecución en el contexto del script: `<?php foreach ($grupos as $g):`. |
| `137` | `                    $vencido  = strtotime($g['fecha_limpieza']) < strtotime...` | Instrucción de ejecución en el contexto del script: `$vencido  = strtotime($g['fecha_limpieza']) < strtotime('today');`. |
| `138` | `                    $esHoy    = date('Y-m-d', strtotime($g['fecha_limpieza'...` | Instrucción de ejecución en el contexto del script: `$esHoy    = date('Y-m-d', strtotime($g['fecha_limpieza'])) === date('Y-m-d');`. |
| `139` | `                    $badgeEst = match($g['estado']) { 'Completado' => 'bg-p...` | Instrucción de ejecución en el contexto del script: `$badgeEst = match($g['estado']) { 'Completado' => 'bg-primary', 'Sancionado' => 'bg-danger', default => 'bg-success' };`. |
| `140` | `                ?>` | Cierre de la etiqueta PHP para alternar a salida HTML o fin del archivo. |
| `141` | `                <tr>` | Fila contenedora de datos dentro de la tabla. |
| `142` | `                    <td class="fw-semibold small"><?= htmlspecialchars($g['...` | Celda de tabla con contenido de datos o encabezado de columna: `<td class="fw-semibold small"><?= htmlspecialchars($g['nombre_grupo']) ?></td>`. |
| `143` | `                    <td class="small"><?= htmlspecialchars($g['nombre_modul...` | Celda de tabla con contenido de datos o encabezado de columna: `<td class="small"><?= htmlspecialchars($g['nombre_modulo']) ?></td>`. |
| `144` | `                    <td class="small">` | Celda de tabla con contenido de datos o encabezado de columna: `<td class="small">`. |
| `145` | `                        <div class="fw-semibold <?= $esHoy ? 'text-success'...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="fw-semibold <?= $esHoy ? 'text-success' : ($vencido ? 'text-muted' : '') ?>">`. |
| `146` | `                            <?= date('d/m/Y', strtotime($g['fecha_limpieza'...` | Instrucción de ejecución en el contexto del script: `<?= date('d/m/Y', strtotime($g['fecha_limpieza'])) ?>`. |
| `147` | `                            <?php if ($esHoy): ?>` | Instrucción de ejecución en el contexto del script: `<?php if ($esHoy): ?>`. |
| `148` | `                                <span class="badge bg-success ms-1" style="...` | Instrucción de ejecución en el contexto del script: `<span class="badge bg-success ms-1" style="font-size:.65rem;">Hoy</span>`. |
| `149` | `                            <?php endif; ?>` | Instrucción de ejecución en el contexto del script: `<?php endif; ?>`. |
| `150` | `                        </div>` | Cierre de contenedor visual `<div>`. |
| `151` | `                        <div class="text-muted" style="font-size:.73rem;">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="text-muted" style="font-size:.73rem;">`. |
| `152` | `                            <?= $diasES[(int)(new DateTime($g['fecha_limpie...` | Instrucción de ejecución en el contexto del script: `<?= $diasES[(int)(new DateTime($g['fecha_limpieza']))->format('w')] ?>`. |
| `153` | `                        </div>` | Cierre de contenedor visual `<div>`. |
| `154` | `                    </td>` | Celda de tabla con contenido de datos o encabezado de columna: `</td>`. |
| `155` | `                    <td>` | Celda de tabla con contenido de datos o encabezado de columna: `<td>`. |
| `156` | `                        <?php if ((int)$g['tiene_evidencia'] > 0): ?>` | Instrucción de ejecución en el contexto del script: `<?php if ((int)$g['tiene_evidencia'] > 0): ?>`. |
| `157` | `                            <span class="badge bg-success"><i class="fas fa...` | Instrucción de ejecución en el contexto del script: `<span class="badge bg-success"><i class="fas fa-check me-1"></i>Entregada</span>`. |
| `158` | `                        <?php elseif ($vencido): ?>` | Instrucción de ejecución en el contexto del script: `<?php elseif ($vencido): ?>`. |
| `159` | `                            <span class="badge bg-danger">Sin evidencia</span>` | Instrucción de ejecución en el contexto del script: `<span class="badge bg-danger">Sin evidencia</span>`. |
| `160` | `                        <?php elseif ($esHoy): ?>` | Instrucción de ejecución en el contexto del script: `<?php elseif ($esHoy): ?>`. |
| `161` | `                            <span class="badge bg-warning text-dark">Entreg...` | Instrucción de ejecución en el contexto del script: `<span class="badge bg-warning text-dark">Entregar hoy</span>`. |
| `162` | `                        <?php else: ?>` | Instrucción de ejecución en el contexto del script: `<?php else: ?>`. |
| `163` | `                            <span class="badge bg-light text-dark border">P...` | Instrucción de ejecución en el contexto del script: `<span class="badge bg-light text-dark border">Pendiente</span>`. |
| `164` | `                        <?php endif; ?>` | Instrucción de ejecución en el contexto del script: `<?php endif; ?>`. |
| `165` | `                    </td>` | Celda de tabla con contenido de datos o encabezado de columna: `</td>`. |
| `166` | `                    <td><span class="badge <?= $badgeEst ?>"><?= $g['estado...` | Celda de tabla con contenido de datos o encabezado de columna: `<td><span class="badge <?= $badgeEst ?>"><?= $g['estado'] ?></span></td>`. |
| `167` | `                    <td>` | Celda de tabla con contenido de datos o encabezado de columna: `<td>`. |
| `168` | `                        <div class="d-flex gap-1">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="d-flex gap-1">`. |
| `169` | `                            <?php if (!$vencido && (int)$g['tiene_evidencia...` | Instrucción de ejecución en el contexto del script: `<?php if (!$vencido && (int)$g['tiene_evidencia'] === 0): ?>`. |
| `170` | `                            <button class="btn btn-sm btn-outline-primary"` | Botón de acción interactivo para el usuario: `<button class="btn btn-sm btn-outline-primary"`. |
| `171` | `                                    onclick='abrirEdicion(<?= json_encode($...` | Instrucción de ejecución en el contexto del script: `onclick='abrirEdicion(<?= json_encode($g) ?>)'`. |
| `172` | `                                    title="Editar integrantes">` | Instrucción de ejecución en el contexto del script: `title="Editar integrantes">`. |
| `173` | `                                <i class="fas fa-pen"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-pen"></i>`. |
| `174` | `                            </button>` | Botón de acción interactivo para el usuario: `</button>`. |
| `175` | `                            <form action="../../controllers/VoceroControlle...` | Formulario para recolección y envío de datos del usuario: `<form action="../../controllers/VoceroController.php" method="POST" class="d-inline">`. |
| `176` | `                                <input type="hidden" name="accion"   value=...` | Campo de entrada interactivo para datos del usuario: `<input type="hidden" name="accion"   value="eliminar_grupo">`. |
| `177` | `                                <input type="hidden" name="id_grupo" value=...` | Campo de entrada interactivo para datos del usuario: `<input type="hidden" name="id_grupo" value="<?= $g['id_grupo'] ?>">`. |
| `178` | `                                <button type="submit" class="btn btn-sm btn...` | Botón de acción interactivo para el usuario: `<button type="submit" class="btn btn-sm btn-outline-danger"`. |
| `179` | `                                        onclick="return confirm('¿Eliminar ...` | Instrucción de ejecución en el contexto del script: `onclick="return confirm('¿Eliminar este grupo?')" title="Eliminar">`. |
| `180` | `                                    <i class="fas fa-trash"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-trash"></i>`. |
| `181` | `                                </button>` | Botón de acción interactivo para el usuario: `</button>`. |
| `182` | `                            </form>` | Cierre de formulario HTML. |
| `183` | `                            <?php endif; ?>` | Instrucción de ejecución en el contexto del script: `<?php endif; ?>`. |
| `184` | `                            <?php if ($esHoy && (int)$g['tiene_evidencia'] ...` | Instrucción de ejecución en el contexto del script: `<?php if ($esHoy && (int)$g['tiene_evidencia'] === 0): ?>`. |
| `185` | `                            <a href="vocero_subir_evidencia.php"` | Enlace hipertexto de navegación o acción: `<a href="vocero_subir_evidencia.php"`. |
| `186` | `                               class="btn btn-sm btn-success fw-semibold" t...` | Instrucción de ejecución en el contexto del script: `class="btn btn-sm btn-success fw-semibold" title="Subir evidencia de hoy">`. |
| `187` | `                                <i class="fas fa-camera me-1"></i>Subir` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-camera me-1"></i>Subir`. |
| `188` | `                            </a>` | Instrucción de ejecución en el contexto del script: `</a>`. |
| `189` | `                            <?php endif; ?>` | Instrucción de ejecución en el contexto del script: `<?php endif; ?>`. |
| `190` | `                        </div>` | Cierre de contenedor visual `<div>`. |
| `191` | `                    </td>` | Celda de tabla con contenido de datos o encabezado de columna: `</td>`. |
| `192` | `                </tr>` | Fila contenedora de datos dentro de la tabla. |
| `193` | `                <?php endforeach; ?>` | Instrucción de ejecución en el contexto del script: `<?php endforeach; ?>`. |
| `194` | `                <?php if (empty($grupos)): ?>` | Instrucción de ejecución en el contexto del script: `<?php if (empty($grupos)): ?>`. |
| `195` | `                <tr>` | Fila contenedora de datos dentro de la tabla. |
| `196` | `                    <td colspan="7" class="text-center text-muted py-5">` | Celda de tabla con contenido de datos o encabezado de columna: `<td colspan="7" class="text-center text-muted py-5">`. |
| `197` | `                        <i class="fas fa-people-group fa-2x mb-2 opacity-25...` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-people-group fa-2x mb-2 opacity-25 d-block"></i>`. |
| `198` | `                        No has registrado ningún grupo de limpieza aún.` | Instrucción de ejecución en el contexto del script: `No has registrado ningún grupo de limpieza aún.`. |
| `199` | `                    </td>` | Celda de tabla con contenido de datos o encabezado de columna: `</td>`. |
| `200` | `                </tr>` | Fila contenedora de datos dentro de la tabla. |
| `201` | `                <?php endif; ?>` | Instrucción de ejecución en el contexto del script: `<?php endif; ?>`. |
| `202` | `                </tbody>` | Instrucción de ejecución en el contexto del script: `</tbody>`. |
| `203` | `            </table>` | Tabla de datos para despliegue estructurado de información: `</table>`. |
| `204` | `        </div>` | Cierre de contenedor visual `<div>`. |
| `205` | `    </div>` | Cierre de contenedor visual `<div>`. |
| `206` | `</div>` | Cierre de contenedor visual `<div>`. |
| `207` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `208` | `<!-- Modal Crear/Editar Grupo -->` | Instrucción de ejecución en el contexto del script: `<!-- Modal Crear/Editar Grupo -->`. |
| `209` | `<div class="modal fade" id="modalGrupo" tabindex="-1" aria-hidden="true">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="modal fade" id="modalGrupo" tabindex="-1" aria-hidden="true">`. |
| `210` | `    <div class="modal-dialog modal-dialog-centered modal-lg">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="modal-dialog modal-dialog-centered modal-lg">`. |
| `211` | `        <div class="modal-content shadow">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="modal-content shadow">`. |
| `212` | `            <div class="modal-header" style="background:#0f2200; color:#fff;">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="modal-header" style="background:#0f2200; color:#fff;">`. |
| `213` | `                <h6 class="modal-title fw-bold" id="titModalGrupo">` | Instrucción de ejecución en el contexto del script: `<h6 class="modal-title fw-bold" id="titModalGrupo">`. |
| `214` | `                    <i class="fas fa-people-group me-2 text-success"></i>Nu...` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-people-group me-2 text-success"></i>Nuevo Grupo de Limpieza`. |
| `215` | `                </h6>` | Instrucción de ejecución en el contexto del script: `</h6>`. |
| `216` | `                <button type="button" class="btn-close btn-close-white" dat...` | Botón de acción interactivo para el usuario: `<button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>`. |
| `217` | `            </div>` | Cierre de contenedor visual `<div>`. |
| `218` | `            <form action="../../controllers/VoceroController.php" method="P...` | Formulario para recolección y envío de datos del usuario: `<form action="../../controllers/VoceroController.php" method="POST" id="formGrupo">`. |
| `219` | `                <input type="hidden" name="accion"        id="accionGrupo" ...` | Campo de entrada interactivo para datos del usuario: `<input type="hidden" name="accion"        id="accionGrupo"  value="guardar_grupo">`. |
| `220` | `                <input type="hidden" name="id_grupo"      id="id_grupo"    ...` | Campo de entrada interactivo para datos del usuario: `<input type="hidden" name="id_grupo"      id="id_grupo"     value="">`. |
| `221` | `                <!-- id_asignacion viene automático del único módulo activo...` | Instrucción de ejecución en el contexto del script: `<!-- id_asignacion viene automático del único módulo activo de la ficha -->`. |
| `222` | `                <input type="hidden" name="id_asignacion" value="<?= $asign...` | Campo de entrada interactivo para datos del usuario: `<input type="hidden" name="id_asignacion" value="<?= $asignacion ? $asignacion['id_asignacion'] : '' ?>">`. |
| `223` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `224` | `                <div class="modal-body px-4 py-4">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="modal-body px-4 py-4">`. |
| `225` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `226` | `                    <?php if ($asignacion): ?>` | Instrucción de ejecución en el contexto del script: `<?php if ($asignacion): ?>`. |
| `227` | `                    <!-- Info del módulo asignado (solo lectura) -->` | Instrucción de ejecución en el contexto del script: `<!-- Info del módulo asignado (solo lectura) -->`. |
| `228` | `                    <div class="rounded-3 p-3 mb-3 d-flex align-items-cente...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="rounded-3 p-3 mb-3 d-flex align-items-center gap-3"`. |
| `229` | `                         style="background:#f0fff4; border:1px solid #86efa...` | Instrucción de ejecución en el contexto del script: `style="background:#f0fff4; border:1px solid #86efac;">`. |
| `230` | `                        <div style="width:40px;height:40px;border-radius:10...` | Contenedor visual estructurado con Bootstrap/CSS: `<div style="width:40px;height:40px;border-radius:10px;background:#39a900;`. |
| `231` | `                                    color:#fff;display:flex;align-items:cen...` | Instrucción de ejecución en el contexto del script: `color:#fff;display:flex;align-items:center;justify-content:center;flex-shrink:0;">`. |
| `232` | `                            <i class="fas fa-door-open"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-door-open"></i>`. |
| `233` | `                        </div>` | Cierre de contenedor visual `<div>`. |
| `234` | `                        <div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div>`. |
| `235` | `                            <div class="text-muted" style="font-size:.72rem...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="text-muted" style="font-size:.72rem;text-transform:uppercase;letter-spacing:.4px;">`. |
| `236` | `                                Módulo asignado a tu ficha` | Instrucción de ejecución en el contexto del script: `Módulo asignado a tu ficha`. |
| `237` | `                            </div>` | Cierre de contenedor visual `<div>`. |
| `238` | `                            <div class="fw-bold"><?= htmlspecialchars($asig...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="fw-bold"><?= htmlspecialchars($asignacion['nombre_modulo']) ?></div>`. |
| `239` | `                            <?php if ($asignacion['ubicacion']): ?>` | Instrucción de ejecución en el contexto del script: `<?php if ($asignacion['ubicacion']): ?>`. |
| `240` | `                            <div class="text-muted" style="font-size:.75rem;">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="text-muted" style="font-size:.75rem;">`. |
| `241` | `                                <i class="fas fa-location-dot me-1"></i><?=...` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-location-dot me-1"></i><?= htmlspecialchars($asignacion['ubicacion']) ?>`. |
| `242` | `                            </div>` | Cierre de contenedor visual `<div>`. |
| `243` | `                            <?php endif; ?>` | Instrucción de ejecución en el contexto del script: `<?php endif; ?>`. |
| `244` | `                        </div>` | Cierre de contenedor visual `<div>`. |
| `245` | `                        <div class="ms-auto text-end">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="ms-auto text-end">`. |
| `246` | `                            <div class="text-muted" style="font-size:.72rem...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="text-muted" style="font-size:.72rem;">Período</div>`. |
| `247` | `                            <div class="small fw-semibold">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="small fw-semibold">`. |
| `248` | `                                <?= date('d/m/Y', strtotime($asignacion['fe...` | Instrucción de ejecución en el contexto del script: `<?= date('d/m/Y', strtotime($asignacion['fecha_inicio'])) ?>`. |
| `249` | `                                →` | Instrucción de ejecución en el contexto del script: `→`. |
| `250` | `                                <?= date('d/m/Y', strtotime($asignacion['fe...` | Instrucción de ejecución en el contexto del script: `<?= date('d/m/Y', strtotime($asignacion['fecha_fin'])) ?>`. |
| `251` | `                            </div>` | Cierre de contenedor visual `<div>`. |
| `252` | `                        </div>` | Cierre de contenedor visual `<div>`. |
| `253` | `                    </div>` | Cierre de contenedor visual `<div>`. |
| `254` | `                    <?php else: ?>` | Instrucción de ejecución en el contexto del script: `<?php else: ?>`. |
| `255` | `                    <div class="alert alert-warning py-2 small mb-3">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="alert alert-warning py-2 small mb-3">`. |
| `256` | `                        <i class="fas fa-triangle-exclamation me-1"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-triangle-exclamation me-1"></i>`. |
| `257` | `                        Tu ficha no tiene ningún módulo asignado activo. Co...` | Instrucción de ejecución en el contexto del script: `Tu ficha no tiene ningún módulo asignado activo. Contacta al administrador.`. |
| `258` | `                    </div>` | Cierre de contenedor visual `<div>`. |
| `259` | `                    <?php endif; ?>` | Instrucción de ejecución en el contexto del script: `<?php endif; ?>`. |
| `260` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `261` | `                    <div class="row g-3">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="row g-3">`. |
| `262` | `                        <div class="col-12">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="col-12">`. |
| `263` | `                            <label class="form-label fw-semibold small">` | Instrucción de ejecución en el contexto del script: `<label class="form-label fw-semibold small">`. |
| `264` | `                                Nombre del Grupo <span class="text-danger">...` | Instrucción de ejecución en el contexto del script: `Nombre del Grupo <span class="text-danger">*</span>`. |
| `265` | `                            </label>` | Instrucción de ejecución en el contexto del script: `</label>`. |
| `266` | `                            <input type="text" name="nombre_grupo" id="grp_...` | Campo de entrada interactivo para datos del usuario: `<input type="text" name="nombre_grupo" id="grp_nombre"`. |
| `267` | `                                   class="form-control" required placeholde...` | Instrucción de ejecución en el contexto del script: `class="form-control" required placeholder="Ej: Grupo Alpha">`. |
| `268` | `                        </div>` | Cierre de contenedor visual `<div>`. |
| `269` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `270` | `                        <!-- Fecha asignada automáticamente -->` | Instrucción de ejecución en el contexto del script: `<!-- Fecha asignada automáticamente -->`. |
| `271` | `                        <?php if ($proximaFecha): ?>` | Instrucción de ejecución en el contexto del script: `<?php if ($proximaFecha): ?>`. |
| `272` | `                        <div class="col-12">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="col-12">`. |
| `273` | `                            <div class="rounded-3 p-3 d-flex align-items-ce...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="rounded-3 p-3 d-flex align-items-center gap-3"`. |
| `274` | `                                 style="background:#f0f9ff; border:1px soli...` | Instrucción de ejecución en el contexto del script: `style="background:#f0f9ff; border:1px solid #bae6fd;">`. |
| `275` | `                                <div style="width:38px;height:38px;border-r...` | Contenedor visual estructurado con Bootstrap/CSS: `<div style="width:38px;height:38px;border-radius:8px;background:#0284c7;`. |
| `276` | `                                            color:#fff;display:flex;align-i...` | Instrucción de ejecución en el contexto del script: `color:#fff;display:flex;align-items:center;justify-content:center;flex-shrink:0;">`. |
| `277` | `                                    <i class="fas fa-calendar-check"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-calendar-check"></i>`. |
| `278` | `                                </div>` | Cierre de contenedor visual `<div>`. |
| `279` | `                                <div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div>`. |
| `280` | `                                    <div class="text-muted" style="font-siz...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="text-muted" style="font-size:.72rem;text-transform:uppercase;letter-spacing:.4px;">`. |
| `281` | `                                        Fecha de limpieza asignada automáti...` | Instrucción de ejecución en el contexto del script: `Fecha de limpieza asignada automáticamente`. |
| `282` | `                                    </div>` | Cierre de contenedor visual `<div>`. |
| `283` | `                                    <div class="fw-bold" style="color:#0369...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="fw-bold" style="color:#0369a1;">`. |
| `284` | `                                        <?= date('d/m/Y', strtotime($proxim...` | Instrucción de ejecución en el contexto del script: `<?= date('d/m/Y', strtotime($proximaFecha)) ?>`. |
| `285` | `                                        <span class="fw-normal text-muted m...` | Instrucción de ejecución en el contexto del script: `<span class="fw-normal text-muted ms-1" style="font-size:.85rem;">`. |
| `286` | `                                            (<?= $diasES[(int)(new DateTime...` | Instrucción de ejecución en el contexto del script: `(<?= $diasES[(int)(new DateTime($proximaFecha))->format('w')] ?>)`. |
| `287` | `                                        </span>` | Instrucción de ejecución en el contexto del script: `</span>`. |
| `288` | `                                    </div>` | Cierre de contenedor visual `<div>`. |
| `289` | `                                    <div class="text-muted" style="font-siz...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="text-muted" style="font-size:.75rem;">`. |
| `290` | `                                        Corresponde al siguiente turno libr...` | Instrucción de ejecución en el contexto del script: `Corresponde al siguiente turno libre del módulo`. |
| `291` | `                                    </div>` | Cierre de contenedor visual `<div>`. |
| `292` | `                                </div>` | Cierre de contenedor visual `<div>`. |
| `293` | `                            </div>` | Cierre de contenedor visual `<div>`. |
| `294` | `                        </div>` | Cierre de contenedor visual `<div>`. |
| `295` | `                        <?php else: ?>` | Instrucción de ejecución en el contexto del script: `<?php else: ?>`. |
| `296` | `                        <div class="col-12">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="col-12">`. |
| `297` | `                            <div class="alert alert-danger py-2 small mb-0">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="alert alert-danger py-2 small mb-0">`. |
| `298` | `                                <i class="fas fa-ban me-1"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-ban me-1"></i>`. |
| `299` | `                                No hay turnos de limpieza disponibles. Todo...` | Instrucción de ejecución en el contexto del script: `No hay turnos de limpieza disponibles. Todos los turnos ya tienen grupo asignado o el período finalizó.`. |
| `300` | `                            </div>` | Cierre de contenedor visual `<div>`. |
| `301` | `                        </div>` | Cierre de contenedor visual `<div>`. |
| `302` | `                        <?php endif; ?>` | Instrucción de ejecución en el contexto del script: `<?php endif; ?>`. |
| `303` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `304` | `                        <div class="col-12">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="col-12">`. |
| `305` | `                            <label class="form-label fw-semibold small">` | Instrucción de ejecución en el contexto del script: `<label class="form-label fw-semibold small">`. |
| `306` | `                                Integrantes <span class="text-danger">*</span>` | Instrucción de ejecución en el contexto del script: `Integrantes <span class="text-danger">*</span>`. |
| `307` | `                                <span class="text-muted fw-normal">(selecci...` | Instrucción de ejecución en el contexto del script: `<span class="text-muted fw-normal">(selecciona de tu ficha)</span>`. |
| `308` | `                            </label>` | Instrucción de ejecución en el contexto del script: `</label>`. |
| `309` | `                            <?php if (empty($aprendices)): ?>` | Instrucción de ejecución en el contexto del script: `<?php if (empty($aprendices)): ?>`. |
| `310` | `                                <div class="alert alert-warning py-2 small">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="alert alert-warning py-2 small">`. |
| `311` | `                                    No hay aprendices sincronizados en tu f...` | Instrucción de ejecución en el contexto del script: `No hay aprendices sincronizados en tu ficha.`. |
| `312` | `                                </div>` | Cierre de contenedor visual `<div>`. |
| `313` | `                            <?php else: ?>` | Instrucción de ejecución en el contexto del script: `<?php else: ?>`. |
| `314` | `                            <div style="max-height:220px; overflow-y:auto; ...` | Contenedor visual estructurado con Bootstrap/CSS: `<div style="max-height:220px; overflow-y:auto; border:1px solid #dee2e6;`. |
| `315` | `                                        border-radius:8px; padding:.5rem;">` | Instrucción de ejecución en el contexto del script: `border-radius:8px; padding:.5rem;">`. |
| `316` | `                                <?php foreach ($aprendices as $ap): ?>` | Instrucción de ejecución en el contexto del script: `<?php foreach ($aprendices as $ap): ?>`. |
| `317` | `                                <div class="form-check py-1">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="form-check py-1">`. |
| `318` | `                                    <input class="form-check-input" type="c...` | Campo de entrada interactivo para datos del usuario: `<input class="form-check-input" type="checkbox"`. |
| `319` | `                                           name="aprendices[]" value="<?= $...` | Instrucción de ejecución en el contexto del script: `name="aprendices[]" value="<?= $ap['id_aprendiz'] ?>"`. |
| `320` | `                                           id="ap_<?= $ap['id_aprendiz'] ?>">` | Instrucción de ejecución en el contexto del script: `id="ap_<?= $ap['id_aprendiz'] ?>">`. |
| `321` | `                                    <label class="form-check-label small" f...` | Instrucción de ejecución en el contexto del script: `<label class="form-check-label small" for="ap_<?= $ap['id_aprendiz'] ?>">`. |
| `322` | `                                        <?= htmlspecialchars($ap['apellidos...` | Instrucción de ejecución en el contexto del script: `<?= htmlspecialchars($ap['apellidos'] . ', ' . $ap['nombres']) ?>`. |
| `323` | `                                        <?php if ($ap['documento']): ?>` | Instrucción de ejecución en el contexto del script: `<?php if ($ap['documento']): ?>`. |
| `324` | `                                            <span class="text-muted"> — <?=...` | Instrucción de ejecución en el contexto del script: `<span class="text-muted"> — <?= htmlspecialchars($ap['documento']) ?></span>`. |
| `325` | `                                        <?php endif; ?>` | Instrucción de ejecución en el contexto del script: `<?php endif; ?>`. |
| `326` | `                                    </label>` | Instrucción de ejecución en el contexto del script: `</label>`. |
| `327` | `                                </div>` | Cierre de contenedor visual `<div>`. |
| `328` | `                                <?php endforeach; ?>` | Instrucción de ejecución en el contexto del script: `<?php endforeach; ?>`. |
| `329` | `                            </div>` | Cierre de contenedor visual `<div>`. |
| `330` | `                            <?php endif; ?>` | Instrucción de ejecución en el contexto del script: `<?php endif; ?>`. |
| `331` | `                        </div>` | Cierre de contenedor visual `<div>`. |
| `332` | `                    </div>` | Cierre de contenedor visual `<div>`. |
| `333` | `                </div>` | Cierre de contenedor visual `<div>`. |
| `334` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `335` | `                <div class="modal-footer px-4">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="modal-footer px-4">`. |
| `336` | `                    <button type="button" class="btn btn-sm btn-outline-sec...` | Botón de acción interactivo para el usuario: `<button type="button" class="btn btn-sm btn-outline-secondary"`. |
| `337` | `                            data-bs-dismiss="modal">Cancelar</button>` | Botón de acción interactivo para el usuario: `data-bs-dismiss="modal">Cancelar</button>`. |
| `338` | `                    <button type="submit" class="btn btn-sm btn-success fw-...` | Botón de acción interactivo para el usuario: `<button type="submit" class="btn btn-sm btn-success fw-semibold px-4"`. |
| `339` | `                            <?= (!$asignacion \|\| !$proximaFecha) ? 'disab...` | Instrucción de ejecución en el contexto del script: `<?= (!$asignacion \|\| !$proximaFecha) ? 'disabled' : '' ?>>`. |
| `340` | `                        <i class="fas fa-save me-1"></i>Guardar Grupo` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-save me-1"></i>Guardar Grupo`. |
| `341` | `                    </button>` | Botón de acción interactivo para el usuario: `</button>`. |
| `342` | `                </div>` | Cierre de contenedor visual `<div>`. |
| `343` | `            </form>` | Cierre de formulario HTML. |
| `344` | `        </div>` | Cierre de contenedor visual `<div>`. |
| `345` | `    </div>` | Cierre de contenedor visual `<div>`. |
| `346` | `</div>` | Cierre de contenedor visual `<div>`. |
| `347` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `348` | `<?php if ($alert): ?>` | Instrucción de ejecución en el contexto del script: `<?php if ($alert): ?>`. |
| `349` | `<script>` | Bloque o etiqueta de vinculación para scripts JavaScript del lado del cliente. |
| `350` | `document.addEventListener('DOMContentLoaded', function() {` | Instrucción de ejecución en el contexto del script: `document.addEventListener('DOMContentLoaded', function() {`. |
| `351` | `    Swal.fire({ icon:'<?= addslashes($alert['icon']) ?>', title:'<?= addsla...` | Instrucción de ejecución en el contexto del script: `Swal.fire({ icon:'<?= addslashes($alert['icon']) ?>', title:'<?= addslashes($alert['title']) ?>', text:'<?= addslashes($alert['text']) ?>', confirmButtonColor:'#39a900' });`. |
| `352` | `});` | Instrucción de ejecución en el contexto del script: `});`. |
| `353` | `</script>` | Bloque o etiqueta de vinculación para scripts JavaScript del lado del cliente. |
| `354` | `<?php endif; ?>` | Instrucción de ejecución en el contexto del script: `<?php endif; ?>`. |
| `355` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `356` | `<script>` | Bloque o etiqueta de vinculación para scripts JavaScript del lado del cliente. |
| `357` | `function abrirEdicion(g) {` | Declaración de método o función con su firma y parámetros: `function abrirEdicion(g) {`. |
| `358` | `    document.getElementById('titModalGrupo').innerHTML = '<i class="fas fa-...` | Instrucción de ejecución en el contexto del script: `document.getElementById('titModalGrupo').innerHTML = '<i class="fas fa-pen me-2 text-success"></i>Editar Grupo';`. |
| `359` | `    document.getElementById('accionGrupo').value = 'editar_grupo';` | Instrucción de ejecución en el contexto del script: `document.getElementById('accionGrupo').value = 'editar_grupo';`. |
| `360` | `    document.getElementById('id_grupo').value    = g.id_grupo;` | Instrucción de ejecución en el contexto del script: `document.getElementById('id_grupo').value    = g.id_grupo;`. |
| `361` | `    document.getElementById('grp_nombre').value  = g.nombre_grupo;` | Instrucción de ejecución en el contexto del script: `document.getElementById('grp_nombre').value  = g.nombre_grupo;`. |
| `362` | `    document.getElementById('grp_fecha').value   = g.fecha_limpieza;` | Instrucción de ejecución en el contexto del script: `document.getElementById('grp_fecha').value   = g.fecha_limpieza;`. |
| `363` | `    new bootstrap.Modal(document.getElementById('modalGrupo')).show();` | Instrucción de ejecución en el contexto del script: `new bootstrap.Modal(document.getElementById('modalGrupo')).show();`. |
| `364` | `}` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `365` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `366` | `document.getElementById('modalGrupo').addEventListener('hidden.bs.modal', f...` | Instrucción de ejecución en el contexto del script: `document.getElementById('modalGrupo').addEventListener('hidden.bs.modal', function() {`. |
| `367` | `    document.getElementById('titModalGrupo').innerHTML = '<i class="fas fa-...` | Instrucción de ejecución en el contexto del script: `document.getElementById('titModalGrupo').innerHTML = '<i class="fas fa-people-group me-2 text-success"></i>Nuevo Grupo de Limpieza';`. |
| `368` | `    document.getElementById('accionGrupo').value = 'guardar_grupo';` | Instrucción de ejecución en el contexto del script: `document.getElementById('accionGrupo').value = 'guardar_grupo';`. |
| `369` | `    document.getElementById('id_grupo').value    = '';` | Instrucción de ejecución en el contexto del script: `document.getElementById('id_grupo').value    = '';`. |
| `370` | `    document.getElementById('grp_nombre').value  = '';` | Instrucción de ejecución en el contexto del script: `document.getElementById('grp_nombre').value  = '';`. |
| `371` | `    document.getElementById('grp_fecha').value   = '';` | Instrucción de ejecución en el contexto del script: `document.getElementById('grp_fecha').value   = '';`. |
| `372` | `    document.querySelectorAll('#formGrupo input[type=checkbox]').forEach(cb...` | Instrucción de ejecución en el contexto del script: `document.querySelectorAll('#formGrupo input[type=checkbox]').forEach(cb => cb.checked = false);`. |
| `373` | `});` | Instrucción de ejecución en el contexto del script: `});`. |
| `374` | `</script>` | Bloque o etiqueta de vinculación para scripts JavaScript del lado del cliente. |
| `375` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `376` | `<?php require_once __DIR__ . '/../layouts/footer.php'; ?>` | Instrucción de ejecución en el contexto del script: `<?php require_once __DIR__ . '/../layouts/footer.php'; ?>`. |

---

## 3. Resumen y Flujo de Interacción

El archivo `vocero_grupos.php` cumple un rol indispensable en `views/dashboard/vocero_grupos.php`. 
Módulo donde el vocero organiza, crea y edita los grupos de aprendices para la rotación de limpieza. Garantiza la robustez, el orden y la estabilidad de la arquitectura del proyecto `systemLimpieza`.
