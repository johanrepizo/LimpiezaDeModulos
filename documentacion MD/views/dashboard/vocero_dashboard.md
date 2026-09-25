# Documentación Línea por Línea: `views/dashboard/vocero_dashboard.php`

## 1. Ficha Técnica del Archivo

- **Archivo:** `vocero_dashboard.php`
- **Ruta en el proyecto:** `views/dashboard/vocero_dashboard.php`
- **Cantidad total de líneas:** `266`
- **Tipo de archivo:** `PHP`
- **Propósito general:** Panel principal del vocero con información del módulo asignado, próximo turno y accesos rápidos.

---

## 2. Explicación Detallada Línea por Línea

A continuación se presenta cada línea de código numerada de forma consecutiva, acompañada de su fragmento exacto y la explicación exhaustiva de su funcionamiento y responsabilidad en el sistema:

| Línea | Código Fuente | Explicación Detallada |
|---|---|---|
| `1` | ``<?php`` | Apertura obligatoria de la etiqueta PHP para ejecución del código del lado del servidor. |
| `2` | `$titulo = 'Mi Panel – Vocero';` | Instrucción de ejecución en el contexto del script: `$titulo = 'Mi Panel – Vocero';`. |
| `3` | `if (session_status() === PHP_SESSION_NONE) session_start();` | Inicia o reanuda la sesión PHP del usuario si no se encontraba activa previamente. |
| `4` | `if (!isset($_SESSION['usuario']) \|\| (int)$_SESSION['usuario']['rol'] !...` | Verifica autenticación y rol del usuario; redirige al login si no tiene permisos. |
| `5` | `header("Location: ../usuarios/login.php"); exit;` | Emite cabecera HTTP de redirección en el navegador y detiene la ejecución: `header("Location: ../usuarios/login.php"); exit;`. |
| `6` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `7` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `8` | `require_once __DIR__ . '/../../config/database.php';` | Importación e inclusión obligatoria del archivo de dependencia requerido: `require_once __DIR__ . '/../../config/database.php';`. |
| `9` | `$db    = (new Database())->conectar();` | Instrucción de ejecución en el contexto del script: `$db    = (new Database())->conectar();`. |
| `10` | `$alert = $_SESSION['alert'] ?? null;` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección. |
| `11` | `unset($_SESSION['alert']);` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección. |
| `12` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `13` | `$idUsuario = (int)$_SESSION['usuario']['id_usuario'];` | Instrucción de ejecución en el contexto del script: `$idUsuario = (int)$_SESSION['usuario']['id_usuario'];`. |
| `14` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `15` | `// Obtener datos del vocero` | Comentario explicativo en el código: `Obtener datos del vocero`. |
| `16` | `$stmtV = $db->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmtV = $db->prepare(`. |
| `17` | `"SELECT v.*, f.numero_ficha, p.nombre AS nombre_programa` | Instrucción de ejecución en el contexto del script: `"SELECT v.*, f.numero_ficha, p.nombre AS nombre_programa`. |
| `18` | `FROM voceros v` | Instrucción de ejecución en el contexto del script: `FROM voceros v`. |
| `19` | `JOIN fichas   f ON f.id_ficha    = v.id_ficha` | Instrucción de ejecución en el contexto del script: `JOIN fichas   f ON f.id_ficha    = v.id_ficha`. |
| `20` | `JOIN programas p ON p.id_programa = f.id_programa` | Instrucción de ejecución en el contexto del script: `JOIN programas p ON p.id_programa = f.id_programa`. |
| `21` | `WHERE v.id_usuario = :id AND v.activo = 1 LIMIT 1"` | Instrucción de ejecución en el contexto del script: `WHERE v.id_usuario = :id AND v.activo = 1 LIMIT 1"`. |
| `22` | ``);`` | Cierre de estructura de arreglo o invocación de función. |
| `23` | `$stmtV->execute([':id' => $idUsuario]);` | Ejecuta la sentencia SQL preparada vinculando los parámetros correspondientes: `$stmtV->execute([':id' => $idUsuario]);`. |
| `24` | `$vocero = $stmtV->fetch(PDO::FETCH_ASSOC);` | Recupera una única fila o registro resultante de la consulta. |
| `25` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `26` | `if (!$vocero) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (!$vocero) {`. |
| `27` | `// Usuario con rol vocero pero sin perfil de vocero creado todavía` | Comentario explicativo en el código: `Usuario con rol vocero pero sin perfil de vocero creado todavía`. |
| `28` | `// NO destruimos la sesión — mostramos mensaje de espera` | Comentario explicativo en el código: `NO destruimos la sesión — mostramos mensaje de espera`. |
| `29` | `require_once __DIR__ . '/../layouts/header.php';` | Importación e inclusión obligatoria del archivo de dependencia requerido: `require_once __DIR__ . '/../layouts/header.php';`. |
| `30` | `echo '` | Instrucción de ejecución en el contexto del script: `echo '`. |
| `31` | `<div class="d-flex align-items-center justify-content-center" style="min...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="d-flex align-items-center justify-content-center" style="min...`. |
| `32` | `<div class="text-center" style="max-width:440px;">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="text-center" style="max-width:440px;">`. |
| `33` | `<div class="mb-4" style="font-size:3.5rem;">⏳</div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="mb-4" style="font-size:3.5rem;">⏳</div>`. |
| `34` | `<h5 class="fw-bold mb-2">Perfil en configuración</h5>` | Instrucción de ejecución en el contexto del script: `<h5 class="fw-bold mb-2">Perfil en configuración</h5>`. |
| `35` | `<p class="text-muted small mb-4">` | Instrucción de ejecución en el contexto del script: `<p class="text-muted small mb-4">`. |
| `36` | `Tu cuenta fue creada correctamente, pero el administrador aún no ha` | Instrucción de ejecución en el contexto del script: `Tu cuenta fue creada correctamente, pero el administrador aún no ha`. |
| `37` | `vinculado tu perfil de vocero a una ficha.<br>` | Instrucción de ejecución en el contexto del script: `vinculado tu perfil de vocero a una ficha.<br>`. |
| `38` | `Contacta al administrador para que complete la configuración.` | Instrucción de ejecución en el contexto del script: `Contacta al administrador para que complete la configuración.`. |
| `39` | `</p>` | Instrucción de ejecución en el contexto del script: `</p>`. |
| `40` | `<a href="../../controllers/AuthController.php?accion=logout"` | Instrucción de ejecución en el contexto del script: `<a href="../../controllers/AuthController.php?accion=logout"`. |
| `41` | `class="btn btn-sm btn-outline-danger">` | Instrucción de ejecución en el contexto del script: `class="btn btn-sm btn-outline-danger">`. |
| `42` | `<i class="fas fa-power-off me-1"></i>Cerrar sesión` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-power-off me-1"></i>Cerrar sesión`. |
| `43` | `</a>` | Instrucción de ejecución en el contexto del script: `</a>`. |
| `44` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `45` | `</div>';` | Instrucción de ejecución en el contexto del script: `</div>';`. |
| `46` | `require_once __DIR__ . '/../layouts/footer.php';` | Importación e inclusión obligatoria del archivo de dependencia requerido: `require_once __DIR__ . '/../layouts/footer.php';`. |
| `47` | `exit;` | Finaliza la ejecución de la función o script. |
| `48` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `49` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `50` | `$idVocero = (int)$vocero['id_vocero'];` | Instrucción de ejecución en el contexto del script: `$idVocero = (int)$vocero['id_vocero'];`. |
| `51` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `52` | `// Verificar si hoy hay turno de limpieza para esta ficha` | Comentario explicativo en el código: `Verificar si hoy hay turno de limpieza para esta ficha`. |
| `53` | `require_once __DIR__ . '/../../models/Turno.php';` | Importación e inclusión obligatoria del archivo de dependencia requerido: `require_once __DIR__ . '/../../models/Turno.php';`. |
| `54` | `$modelTurnoHoy = new Turno($db);` | Instrucción de ejecución en el contexto del script: `$modelTurnoHoy = new Turno($db);`. |
| `55` | `$turnoAlerta   = $idVocero ? $modelTurnoHoy->turnoActivoHoy($vocero['id_...` | Instrucción de ejecución en el contexto del script: `$turnoAlerta   = $idVocero ? $modelTurnoHoy->turnoActivoHoy($vocero['id_...`. |
| `56` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `57` | `// Stats` | Comentario explicativo en el código: `Stats`. |
| `58` | `$totalGrupos = $db->prepare("SELECT COUNT(*) FROM grupos WHERE id_vocero...` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$totalGrupos = $db->prepare("SELECT COUNT(*) FROM grupos WHERE id_vocero...`. |
| `59` | `$totalGrupos->execute([':id' => $idVocero]);` | Ejecuta la sentencia SQL preparada vinculando los parámetros correspondientes: `$totalGrupos->execute([':id' => $idVocero]);`. |
| `60` | `$totalGrupos = $totalGrupos->fetchColumn();` | Recupera el valor escalar de la primera columna del resultado de la consulta. |
| `61` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `62` | `$totalEvidencias = $db->prepare("SELECT COUNT(*) FROM evidencias WHERE i...` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$totalEvidencias = $db->prepare("SELECT COUNT(*) FROM evidencias WHERE i...`. |
| `63` | `$totalEvidencias->execute([':id' => $idVocero]);` | Ejecuta la sentencia SQL preparada vinculando los parámetros correspondientes: `$totalEvidencias->execute([':id' => $idVocero]);`. |
| `64` | `$totalEvidencias = $totalEvidencias->fetchColumn();` | Recupera el valor escalar de la primera columna del resultado de la consulta. |
| `65` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `66` | `$totalAprendices = $db->prepare("SELECT COUNT(*) FROM aprendices WHERE i...` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$totalAprendices = $db->prepare("SELECT COUNT(*) FROM aprendices WHERE i...`. |
| `67` | `$totalAprendices->execute([':id' => $vocero['id_ficha']]);` | Ejecuta la sentencia SQL preparada vinculando los parámetros correspondientes: `$totalAprendices->execute([':id' => $vocero['id_ficha']]);`. |
| `68` | `$totalAprendices = $totalAprendices->fetchColumn();` | Recupera el valor escalar de la primera columna del resultado de la consulta. |
| `69` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `70` | `// Asignaciones activas de mi ficha` | Comentario explicativo en el código: `Asignaciones activas de mi ficha`. |
| `71` | `$asignaciones = $db->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$asignaciones = $db->prepare(`. |
| `72` | `"SELECT a.*, m.nombre AS nombre_modulo, a.fecha_limite_evidencia,` | Instrucción de ejecución en el contexto del script: `"SELECT a.*, m.nombre AS nombre_modulo, a.fecha_limite_evidencia,`. |
| `73` | `(SELECT COUNT(*) FROM grupos g` | Instrucción de ejecución en el contexto del script: `(SELECT COUNT(*) FROM grupos g`. |
| `74` | `JOIN evidencias e ON e.id_grupo = g.id_grupo` | Instrucción de ejecución en el contexto del script: `JOIN evidencias e ON e.id_grupo = g.id_grupo`. |
| `75` | `WHERE g.id_asignacion = a.id_asignacion` | Instrucción de ejecución en el contexto del script: `WHERE g.id_asignacion = a.id_asignacion`. |
| `76` | `AND g.id_vocero = :idv) AS tiene_evidencia` | Instrucción de ejecución en el contexto del script: `AND g.id_vocero = :idv) AS tiene_evidencia`. |
| `77` | `FROM asignaciones a` | Instrucción de ejecución en el contexto del script: `FROM asignaciones a`. |
| `78` | `JOIN modulos m ON m.id_modulo = a.id_modulo` | Instrucción de ejecución en el contexto del script: `JOIN modulos m ON m.id_modulo = a.id_modulo`. |
| `79` | `WHERE a.id_ficha = :fic AND a.estado = 'Activa'` | Instrucción de ejecución en el contexto del script: `WHERE a.id_ficha = :fic AND a.estado = 'Activa'`. |
| `80` | `ORDER BY a.fecha_limite_evidencia"` | Instrucción de ejecución en el contexto del script: `ORDER BY a.fecha_limite_evidencia"`. |
| `81` | ``);`` | Cierre de estructura de arreglo o invocación de función. |
| `82` | `$asignaciones->execute([':fic' => $vocero['id_ficha'], ':idv' => $idVoce...` | Ejecuta la sentencia SQL preparada vinculando los parámetros correspondientes: `$asignaciones->execute([':fic' => $vocero['id_ficha'], ':idv' => $idVoce...`. |
| `83` | `$asignaciones = $asignaciones->fetchAll(PDO::FETCH_ASSOC);` | Obtiene todos los registros coincidentes de la consulta en un arreglo asociativo. |
| `84` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `85` | `// Últimas evidencias` | Comentario explicativo en el código: `Últimas evidencias`. |
| `86` | `$ultimasEv = $db->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$ultimasEv = $db->prepare(`. |
| `87` | `"SELECT e.fecha_subida, e.ruta_archivo,` | Instrucción de ejecución en el contexto del script: `"SELECT e.fecha_subida, e.ruta_archivo,`. |
| `88` | `g.nombre_grupo, g.fecha_limpieza,` | Instrucción de ejecución en el contexto del script: `g.nombre_grupo, g.fecha_limpieza,`. |
| `89` | `m.nombre AS modulo` | Instrucción de ejecución en el contexto del script: `m.nombre AS modulo`. |
| `90` | `FROM evidencias e` | Instrucción de ejecución en el contexto del script: `FROM evidencias e`. |
| `91` | `JOIN grupos g ON g.id_grupo = e.id_grupo` | Instrucción de ejecución en el contexto del script: `JOIN grupos g ON g.id_grupo = e.id_grupo`. |
| `92` | `JOIN asignaciones a ON a.id_asignacion = g.id_asignacion` | Instrucción de ejecución en el contexto del script: `JOIN asignaciones a ON a.id_asignacion = g.id_asignacion`. |
| `93` | `JOIN modulos m ON m.id_modulo = a.id_modulo` | Instrucción de ejecución en el contexto del script: `JOIN modulos m ON m.id_modulo = a.id_modulo`. |
| `94` | `WHERE e.id_vocero = :id` | Instrucción de ejecución en el contexto del script: `WHERE e.id_vocero = :id`. |
| `95` | `ORDER BY e.fecha_subida DESC LIMIT 4"` | Instrucción de ejecución en el contexto del script: `ORDER BY e.fecha_subida DESC LIMIT 4"`. |
| `96` | ``);`` | Cierre de estructura de arreglo o invocación de función. |
| `97` | `$ultimasEv->execute([':id' => $idVocero]);` | Ejecuta la sentencia SQL preparada vinculando los parámetros correspondientes: `$ultimasEv->execute([':id' => $idVocero]);`. |
| `98` | `$ultimasEv = $ultimasEv->fetchAll(PDO::FETCH_ASSOC);` | Obtiene todos los registros coincidentes de la consulta en un arreglo asociativo. |
| `99` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `100` | `require_once __DIR__ . '/../layouts/header.php';` | Importación e inclusión obligatoria del archivo de dependencia requerido: `require_once __DIR__ . '/../layouts/header.php';`. |
| `101` | ``?>`` | Cierre de la etiqueta PHP para alternar a salida HTML o fin del archivo. |
| `102` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `103` | `<?php if ($turnoAlerta && (int)$turnoAlerta['tiene_evidencia'] === 0): ?>` | Instrucción de ejecución en el contexto del script: `<?php if ($turnoAlerta && (int)$turnoAlerta['tiene_evidencia'] === 0): ?>`. |
| `104` | `<div class="alert border-0 shadow-sm mb-4 d-flex align-items-start gap-3"` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="alert border-0 shadow-sm mb-4 d-flex align-items-start gap-3"`. |
| `105` | `style="background:#fffbeb; border-left:4px solid #f59e0b !important; bor...` | Instrucción de ejecución en el contexto del script: `style="background:#fffbeb; border-left:4px solid #f59e0b !important; bor...`. |
| `106` | `<i class="fas fa-triangle-exclamation mt-1" style="color:#f59e0b; font-s...` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-triangle-exclamation mt-1" style="color:#f59e0b; font-s...`. |
| `107` | `<div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div>`. |
| `108` | `<div class="fw-bold" style="color:#92400e;">¡Hoy es día de limpieza!</div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="fw-bold" style="color:#92400e;">¡Hoy es día de limpieza!</div>`. |
| `109` | `<div class="small text-muted">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="small text-muted">`. |
| `110` | `Hoy le corresponde limpiar el módulo <strong><?= htmlspecialchars($turno...` | Instrucción de ejecución en el contexto del script: `Hoy le corresponde limpiar el módulo <strong><?= htmlspecialchars($turno...`. |
| `111` | `Recuerda subir la evidencia fotográfica antes de las <strong>11:59 PM</s...` | Instrucción de ejecución en el contexto del script: `Recuerda subir la evidencia fotográfica antes de las <strong>11:59 PM</s...`. |
| `112` | `<?php if ($turnoAlerta['nombre_grupo']): ?>` | Instrucción de ejecución en el contexto del script: `<?php if ($turnoAlerta['nombre_grupo']): ?>`. |
| `113` | `Grupo responsable: <strong><?= htmlspecialchars($turnoAlerta['nombre_gru...` | Instrucción de ejecución en el contexto del script: `Grupo responsable: <strong><?= htmlspecialchars($turnoAlerta['nombre_gru...`. |
| `114` | `<?php endif; ?>` | Cierre de estructura condicional embebida en la plantilla HTML. |
| `115` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `116` | `<a href="vocero_subir_evidencia.php" class="btn btn-sm mt-2 fw-semibold"` | Instrucción de ejecución en el contexto del script: `<a href="vocero_subir_evidencia.php" class="btn btn-sm mt-2 fw-semibold"`. |
| `117` | `style="background:#f59e0b; color:#fff; border:none; border-radius:7px;">` | Instrucción de ejecución en el contexto del script: `style="background:#f59e0b; color:#fff; border:none; border-radius:7px;">`. |
| `118` | `<i class="fas fa-camera me-1"></i>Subir evidencia ahora` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-camera me-1"></i>Subir evidencia ahora`. |
| `119` | `</a>` | Instrucción de ejecución en el contexto del script: `</a>`. |
| `120` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `121` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `122` | `<?php endif; ?>` | Cierre de estructura condicional embebida en la plantilla HTML. |
| `123` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `124` | `<div class="d-flex justify-content-between align-items-center mb-4">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="d-flex justify-content-between align-items-center mb-4">`. |
| `125` | `<div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div>`. |
| `126` | `<h4 class="fw-bold mb-0">` | Instrucción de ejecución en el contexto del script: `<h4 class="fw-bold mb-0">`. |
| `127` | `<i class="fas fa-border-all text-success me-2"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-border-all text-success me-2"></i>`. |
| `128` | `Bienvenido, <?= htmlspecialchars($vocero['nombres']) ?>` | Instrucción de ejecución en el contexto del script: `Bienvenido, <?= htmlspecialchars($vocero['nombres']) ?>`. |
| `129` | `</h4>` | Instrucción de ejecución en el contexto del script: `</h4>`. |
| `130` | `<p class="text-muted small mb-0">` | Instrucción de ejecución en el contexto del script: `<p class="text-muted small mb-0">`. |
| `131` | `Ficha <strong><?= htmlspecialchars($vocero['numero_ficha']) ?></strong>` | Instrucción de ejecución en el contexto del script: `Ficha <strong><?= htmlspecialchars($vocero['numero_ficha']) ?></strong>`. |
| `132` | `&bull; <?= htmlspecialchars($vocero['nombre_programa']) ?>` | Instrucción de ejecución en el contexto del script: `&bull; <?= htmlspecialchars($vocero['nombre_programa']) ?>`. |
| `133` | `</p>` | Instrucción de ejecución en el contexto del script: `</p>`. |
| `134` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `135` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `136` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `137` | `<!-- Stats -->` | Instrucción de ejecución en el contexto del script: `<!-- Stats -->`. |
| `138` | `<div class="row g-3 mb-4">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="row g-3 mb-4">`. |
| `139` | `<div class="col-sm-4">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="col-sm-4">`. |
| `140` | `<div class="stat-card bg-white">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="stat-card bg-white">`. |
| `141` | `<div class="d-flex align-items-center gap-3">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="d-flex align-items-center gap-3">`. |
| `142` | `<div class="stat-icon" style="background:rgba(57,169,0,.12); color:#39a9...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="stat-icon" style="background:rgba(57,169,0,.12); color:#39a9...`. |
| `143` | `<div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div>`. |
| `144` | `<div class="fs-4 fw-bold"><?= $totalAprendices ?></div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="fs-4 fw-bold"><?= $totalAprendices ?></div>`. |
| `145` | `<div class="text-muted small">Aprendices en mi ficha</div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="text-muted small">Aprendices en mi ficha</div>`. |
| `146` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `147` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `148` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `149` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `150` | `<div class="col-sm-4">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="col-sm-4">`. |
| `151` | `<div class="stat-card bg-white">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="stat-card bg-white">`. |
| `152` | `<div class="d-flex align-items-center gap-3">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="d-flex align-items-center gap-3">`. |
| `153` | `<div class="stat-icon" style="background:rgba(37,99,235,.1); color:#2563...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="stat-icon" style="background:rgba(37,99,235,.1); color:#2563...`. |
| `154` | `<div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div>`. |
| `155` | `<div class="fs-4 fw-bold"><?= $totalGrupos ?></div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="fs-4 fw-bold"><?= $totalGrupos ?></div>`. |
| `156` | `<div class="text-muted small">Grupos registrados</div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="text-muted small">Grupos registrados</div>`. |
| `157` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `158` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `159` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `160` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `161` | `<div class="col-sm-4">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="col-sm-4">`. |
| `162` | `<div class="stat-card bg-white">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="stat-card bg-white">`. |
| `163` | `<div class="d-flex align-items-center gap-3">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="d-flex align-items-center gap-3">`. |
| `164` | `<div class="stat-icon" style="background:rgba(234,179,8,.1); color:#d977...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="stat-icon" style="background:rgba(234,179,8,.1); color:#d977...`. |
| `165` | `<div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div>`. |
| `166` | `<div class="fs-4 fw-bold"><?= $totalEvidencias ?></div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="fs-4 fw-bold"><?= $totalEvidencias ?></div>`. |
| `167` | `<div class="text-muted small">Evidencias subidas</div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="text-muted small">Evidencias subidas</div>`. |
| `168` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `169` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `170` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `171` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `172` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `173` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `174` | `<!-- Asignaciones activas -->` | Instrucción de ejecución en el contexto del script: `<!-- Asignaciones activas -->`. |
| `175` | `<div class="row g-4">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="row g-4">`. |
| `176` | `<div class="col-lg-7">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="col-lg-7">`. |
| `177` | `<div class="card border-0 shadow-sm">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="card border-0 shadow-sm">`. |
| `178` | `<div class="card-header bg-white border-0 py-3">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="card-header bg-white border-0 py-3">`. |
| `179` | `<h6 class="fw-bold mb-0"><i class="fas fa-door-open text-success me-2"><...` | Instrucción de ejecución en el contexto del script: `<h6 class="fw-bold mb-0"><i class="fas fa-door-open text-success me-2"><...`. |
| `180` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `181` | `<div class="card-body p-0">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="card-body p-0">`. |
| `182` | `<?php if (empty($asignaciones)): ?>` | Instrucción de ejecución en el contexto del script: `<?php if (empty($asignaciones)): ?>`. |
| `183` | `<div class="text-center py-5 text-muted">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="text-center py-5 text-muted">`. |
| `184` | `<i class="fas fa-door-open fa-2x mb-2 opacity-25 d-block"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-door-open fa-2x mb-2 opacity-25 d-block"></i>`. |
| `185` | `<span class="small">No tienes módulos asignados actualmente.</span>` | Instrucción de ejecución en el contexto del script: `<span class="small">No tienes módulos asignados actualmente.</span>`. |
| `186` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `187` | `<?php else: ?>` | Instrucción de ejecución en el contexto del script: `<?php else: ?>`. |
| `188` | `<ul class="list-group list-group-flush">` | Instrucción de ejecución en el contexto del script: `<ul class="list-group list-group-flush">`. |
| `189` | `<?php foreach ($asignaciones as $a):` | Instrucción de ejecución en el contexto del script: `<?php foreach ($asignaciones as $a):`. |
| `190` | `$vencido   = strtotime($a['fecha_limite_evidencia']) < time();` | Instrucción de ejecución en el contexto del script: `$vencido   = strtotime($a['fecha_limite_evidencia']) < time();`. |
| `191` | `$cumple    = (int)$a['tiene_evidencia'] > 0;` | Instrucción de ejecución en el contexto del script: `$cumple    = (int)$a['tiene_evidencia'] > 0;`. |
| `192` | ``?>`` | Cierre de la etiqueta PHP para alternar a salida HTML o fin del archivo. |
| `193` | `<li class="list-group-item border-0 py-3">` | Instrucción de ejecución en el contexto del script: `<li class="list-group-item border-0 py-3">`. |
| `194` | `<div class="d-flex justify-content-between align-items-start">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="d-flex justify-content-between align-items-start">`. |
| `195` | `<div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div>`. |
| `196` | `<div class="fw-semibold small"><?= htmlspecialchars($a['nombre_modulo'])...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="fw-semibold small"><?= htmlspecialchars($a['nombre_modulo'])...`. |
| `197` | `<div class="text-muted" style="font-size:.78rem;">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="text-muted" style="font-size:.78rem;">`. |
| `198` | `Límite: <?= date('d/m/Y H:i', strtotime($a['fecha_limite_evidencia'])) ?>` | Instrucción de ejecución en el contexto del script: `Límite: <?= date('d/m/Y H:i', strtotime($a['fecha_limite_evidencia'])) ?>`. |
| `199` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `200` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `201` | `<div class="d-flex flex-column align-items-end gap-1">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="d-flex flex-column align-items-end gap-1">`. |
| `202` | `<?php if ($cumple): ?>` | Instrucción de ejecución en el contexto del script: `<?php if ($cumple): ?>`. |
| `203` | `<span class="badge bg-success">✓ Entregada</span>` | Instrucción de ejecución en el contexto del script: `<span class="badge bg-success">✓ Entregada</span>`. |
| `204` | `<?php elseif ($vencido): ?>` | Instrucción de ejecución en el contexto del script: `<?php elseif ($vencido): ?>`. |
| `205` | `<span class="badge bg-danger">Vencido</span>` | Instrucción de ejecución en el contexto del script: `<span class="badge bg-danger">Vencido</span>`. |
| `206` | `<?php else: ?>` | Instrucción de ejecución en el contexto del script: `<?php else: ?>`. |
| `207` | `<span class="badge bg-warning text-dark">Pendiente</span>` | Instrucción de ejecución en el contexto del script: `<span class="badge bg-warning text-dark">Pendiente</span>`. |
| `208` | `<?php endif; ?>` | Cierre de estructura condicional embebida en la plantilla HTML. |
| `209` | `<?php if (!$cumple && !$vencido): ?>` | Instrucción de ejecución en el contexto del script: `<?php if (!$cumple && !$vencido): ?>`. |
| `210` | `<a href="vocero_evidencias.php?asig=<?= $a['id_asignacion'] ?>"` | Instrucción de ejecución en el contexto del script: `<a href="vocero_evidencias.php?asig=<?= $a['id_asignacion'] ?>"`. |
| `211` | `class="btn btn-sm btn-success py-0 px-2" style="font-size:.75rem;">` | Instrucción de ejecución en el contexto del script: `class="btn btn-sm btn-success py-0 px-2" style="font-size:.75rem;">`. |
| `212` | `<i class="fas fa-upload me-1"></i>Subir evidencia` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-upload me-1"></i>Subir evidencia`. |
| `213` | `</a>` | Instrucción de ejecución en el contexto del script: `</a>`. |
| `214` | `<?php endif; ?>` | Cierre de estructura condicional embebida en la plantilla HTML. |
| `215` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `216` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `217` | `</li>` | Instrucción de ejecución en el contexto del script: `</li>`. |
| `218` | `<?php endforeach; ?>` | Cierre de ciclo iterativo foreach embebido en la plantilla HTML. |
| `219` | `</ul>` | Instrucción de ejecución en el contexto del script: `</ul>`. |
| `220` | `<?php endif; ?>` | Cierre de estructura condicional embebida en la plantilla HTML. |
| `221` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `222` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `223` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `224` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `225` | `<!-- Últimas evidencias -->` | Instrucción de ejecución en el contexto del script: `<!-- Últimas evidencias -->`. |
| `226` | `<div class="col-lg-5">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="col-lg-5">`. |
| `227` | `<div class="card border-0 shadow-sm">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="card border-0 shadow-sm">`. |
| `228` | `<div class="card-header bg-white border-0 py-3">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="card-header bg-white border-0 py-3">`. |
| `229` | `<h6 class="fw-bold mb-0"><i class="fas fa-clock-rotate-left text-success...` | Instrucción de ejecución en el contexto del script: `<h6 class="fw-bold mb-0"><i class="fas fa-clock-rotate-left text-success...`. |
| `230` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `231` | `<div class="card-body">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="card-body">`. |
| `232` | `<?php if (empty($ultimasEv)): ?>` | Instrucción de ejecución en el contexto del script: `<?php if (empty($ultimasEv)): ?>`. |
| `233` | `<p class="text-muted small text-center py-3">Aún no has subido evidencia...` | Instrucción de ejecución en el contexto del script: `<p class="text-muted small text-center py-3">Aún no has subido evidencia...`. |
| `234` | `<?php else: ?>` | Instrucción de ejecución en el contexto del script: `<?php else: ?>`. |
| `235` | `<div class="row g-2">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="row g-2">`. |
| `236` | `<?php foreach ($ultimasEv as $ev): ?>` | Instrucción de ejecución en el contexto del script: `<?php foreach ($ultimasEv as $ev): ?>`. |
| `237` | `<div class="col-6">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="col-6">`. |
| `238` | `<div class="position-relative" style="border-radius:8px; overflow:hidden...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="position-relative" style="border-radius:8px; overflow:hidden...`. |
| `239` | `<img src="../../public/<?= htmlspecialchars($ev['ruta_archivo']) ?>"` | Instrucción de ejecución en el contexto del script: `<img src="../../public/<?= htmlspecialchars($ev['ruta_archivo']) ?>"`. |
| `240` | `alt="Evidencia"` | Instrucción de ejecución en el contexto del script: `alt="Evidencia"`. |
| `241` | `style="width:100%; height:80px; object-fit:cover;">` | Instrucción de ejecución en el contexto del script: `style="width:100%; height:80px; object-fit:cover;">`. |
| `242` | `<div style="position:absolute; bottom:0; left:0; right:0; background:rgb...` | Contenedor visual estructurado con Bootstrap/CSS: `<div style="position:absolute; bottom:0; left:0; right:0; background:rgb...`. |
| `243` | `<?= htmlspecialchars($ev['modulo']) ?><br>` | Instrucción de ejecución en el contexto del script: `<?= htmlspecialchars($ev['modulo']) ?><br>`. |
| `244` | `<?= date('d/m/Y', strtotime($ev['fecha_subida'])) ?>` | Instrucción de ejecución en el contexto del script: `<?= date('d/m/Y', strtotime($ev['fecha_subida'])) ?>`. |
| `245` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `246` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `247` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `248` | `<?php endforeach; ?>` | Cierre de ciclo iterativo foreach embebido en la plantilla HTML. |
| `249` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `250` | `<a href="vocero_evidencias.php" class="btn btn-sm btn-outline-success w-...` | Instrucción de ejecución en el contexto del script: `<a href="vocero_evidencias.php" class="btn btn-sm btn-outline-success w-...`. |
| `251` | `<?php endif; ?>` | Cierre de estructura condicional embebida en la plantilla HTML. |
| `252` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `253` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `254` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `255` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `256` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `257` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `258` | `<?php if ($alert): ?>` | Instrucción de ejecución en el contexto del script: `<?php if ($alert): ?>`. |
| `259` | ``<script>`` | Bloque o etiqueta de vinculación para scripts JavaScript del lado del cliente. |
| `260` | `document.addEventListener('DOMContentLoaded', function() {` | Registra un escucha de eventos del DOM para interactividad en tiempo real: `document.addEventListener('DOMContentLoaded', function() {`. |
| `261` | `Swal.fire({ icon:'<?= addslashes($alert['icon']) ?>', title:'<?= addslas...` | Despliega una alerta modal estética e interactiva con SweetAlert2. |
| `262` | `});` | Instrucción de ejecución en el contexto del script: `});`. |
| `263` | ``</script>`` | Cierre de bloque de script JavaScript. |
| `264` | `<?php endif; ?>` | Cierre de estructura condicional embebida en la plantilla HTML. |
| `265` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `266` | `<?php require_once __DIR__ . '/../layouts/footer.php'; ?>` | Importación e inclusión obligatoria del archivo de dependencia requerido: `<?php require_once __DIR__ . '/../layouts/footer.php'; ?>`. |

---

## 3. Resumen y Flujo de Interacción

El archivo `vocero_dashboard.php` cumple un rol indispensable en `views/dashboard/vocero_dashboard.php`. 
Panel principal del vocero con información del módulo asignado, próximo turno y accesos rápidos. Garantiza la robustez, el orden y la estabilidad de la arquitectura del proyecto `systemLimpieza`.

---

Generado automáticamente para el repositorio [johanrepizo/LimpiezaDeModulos](https://github.com/johanrepizo/LimpiezaDeModulos).
