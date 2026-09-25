# Documentación Línea por Línea: `views/dashboard/vocero_grupos.php`

## 1. Ficha Técnica del Archivo

- **Archivo:** `vocero_grupos.php`
- **Ruta en el proyecto:** `views/dashboard/vocero_grupos.php`
- **Cantidad total de líneas:** `483`
- **Tipo de archivo:** `PHP`
- **Propósito general:** Módulo donde el vocero organiza, crea y edita los grupos de aprendices para la rotación de limpieza.

---

## 2. Explicación Detallada Línea por Línea

A continuación se presenta cada línea de código numerada de forma consecutiva, acompañada de su fragmento exacto y la explicación exhaustiva de su funcionamiento y responsabilidad en el sistema:

| Línea | Código Fuente | Explicación Detallada |
|---|---|---|
| `1` | ``<?php`` | Apertura obligatoria de la etiqueta PHP para ejecución del código del lado del servidor. |
| `2` | `$titulo = 'Mis Grupos de Limpieza';` | Instrucción de ejecución en el contexto del script: `$titulo = 'Mis Grupos de Limpieza';`. |
| `3` | `if (session_status() === PHP_SESSION_NONE) session_start();` | Inicia o reanuda la sesión PHP del usuario si no se encontraba activa previamente. |
| `4` | `if (!isset($_SESSION['usuario']) \|\| (int)$_SESSION['usuario']['rol'] !...` | Verifica autenticación y rol del usuario; redirige al login si no tiene permisos. |
| `5` | `header("Location: ../usuarios/login.php"); exit;` | Emite cabecera HTTP de redirección en el navegador y detiene la ejecución: `header("Location: ../usuarios/login.php"); exit;`. |
| `6` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `7` | `require_once __DIR__ . '/../../config/database.php';` | Importación e inclusión obligatoria del archivo de dependencia requerido: `require_once __DIR__ . '/../../config/database.php';`. |
| `8` | `require_once __DIR__ . '/../../models/Grupo.php';` | Importación e inclusión obligatoria del archivo de dependencia requerido: `require_once __DIR__ . '/../../models/Grupo.php';`. |
| `9` | `require_once __DIR__ . '/../../models/Ficha.php';` | Importación e inclusión obligatoria del archivo de dependencia requerido: `require_once __DIR__ . '/../../models/Ficha.php';`. |
| `10` | `require_once __DIR__ . '/../../models/Turno.php';` | Importación e inclusión obligatoria del archivo de dependencia requerido: `require_once __DIR__ . '/../../models/Turno.php';`. |
| `11` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `12` | `$db     = (new Database())->conectar();` | Instrucción de ejecución en el contexto del script: `$db     = (new Database())->conectar();`. |
| `13` | `$alert  = $_SESSION['alert'] ?? null;` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección. |
| `14` | `unset($_SESSION['alert']);` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección. |
| `15` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `16` | `$idUsuario = (int)$_SESSION['usuario']['id_usuario'];` | Instrucción de ejecución en el contexto del script: `$idUsuario = (int)$_SESSION['usuario']['id_usuario'];`. |
| `17` | `$stmtV     = $db->prepare("SELECT * FROM voceros WHERE id_usuario=:id AN...` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmtV     = $db->prepare("SELECT * FROM voceros WHERE id_usuario=:id AN...`. |
| `18` | `$stmtV->execute([':id' => $idUsuario]);` | Ejecuta la sentencia SQL preparada vinculando los parámetros correspondientes: `$stmtV->execute([':id' => $idUsuario]);`. |
| `19` | `$vocero    = $stmtV->fetch(PDO::FETCH_ASSOC);` | Recupera una única fila o registro resultante de la consulta. |
| `20` | `$idVocero  = $vocero ? (int)$vocero['id_vocero'] : 0;` | Instrucción de ejecución en el contexto del script: `$idVocero  = $vocero ? (int)$vocero['id_vocero'] : 0;`. |
| `21` | `$idFicha   = $vocero ? (int)$vocero['id_ficha']  : 0;` | Instrucción de ejecución en el contexto del script: `$idFicha   = $vocero ? (int)$vocero['id_ficha']  : 0;`. |
| `22` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `23` | `$modelGrupo = new Grupo($db);` | Instrucción de ejecución en el contexto del script: `$modelGrupo = new Grupo($db);`. |
| `24` | `$grupos     = $modelGrupo->obtenerPorVocero($idVocero);` | Instrucción de ejecución en el contexto del script: `$grupos     = $modelGrupo->obtenerPorVocero($idVocero);`. |
| `25` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `26` | `// ── Actualización automática de fechas vencidas ──────────────────────...` | Comentario explicativo en el código: `── Actualización automática de fechas vencidas ──────────────────────────`. |
| `27` | `// Si un grupo tiene fecha de limpieza ya pasada, se le asigna automátic...` | Comentario explicativo en el código: `Si un grupo tiene fecha de limpieza ya pasada, se le asigna automáticamente`. |
| `28` | `// el siguiente turno libre de la asignación (queda último en la rotación).` | Comentario explicativo en el código: `el siguiente turno libre de la asignación (queda último en la rotación).`. |
| `29` | `if (!empty($grupos)) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (!empty($grupos)) {`. |
| `30` | `$modelTurno = new Turno($db);` | Instrucción de ejecución en el contexto del script: `$modelTurno = new Turno($db);`. |
| `31` | `$hoy        = date('Y-m-d');` | Instrucción de ejecución en el contexto del script: `$hoy        = date('Y-m-d');`. |
| `32` | `$huboActualizacion = false;` | Instrucción de ejecución en el contexto del script: `$huboActualizacion = false;`. |
| `33` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `34` | `foreach ($grupos as &$g) {` | Estructura de control iterativa para recorrer colecciones o arreglos: `foreach ($grupos as &$g) {`. |
| `35` | `if ($g['fecha_limpieza'] >= $hoy) continue; // fecha futura o hoy: no tocar` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if ($g['fecha_limpieza'] >= $hoy) continue; // fecha futura o hoy: no tocar`. |
| `36` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `37` | `$idAsignacion = (int)$g['id_asignacion'];` | Instrucción de ejecución en el contexto del script: `$idAsignacion = (int)$g['id_asignacion'];`. |
| `38` | `$nuevaFecha   = $modelTurno->proximaFechaLibre($idAsignacion);` | Instrucción de ejecución en el contexto del script: `$nuevaFecha   = $modelTurno->proximaFechaLibre($idAsignacion);`. |
| `39` | `if (!$nuevaFecha) continue; // no hay turnos libres` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (!$nuevaFecha) continue; // no hay turnos libres`. |
| `40` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `41` | `// Actualizar fecha en BD` | Comentario explicativo en el código: `Actualizar fecha en BD`. |
| `42` | `$db->prepare("UPDATE grupos SET fecha_limpieza = :f, fecha_modificacion ...` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$db->prepare("UPDATE grupos SET fecha_limpieza = :f, fecha_modificacion ...`. |
| `43` | `->execute([':f' => $nuevaFecha, ':id' => $g['id_grupo']]);` | Ejecuta la sentencia SQL preparada vinculando los parámetros correspondientes: `->execute([':f' => $nuevaFecha, ':id' => $g['id_grupo']]);`. |
| `44` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `45` | `// Vincular el nuevo turno al grupo` | Comentario explicativo en el código: `Vincular el nuevo turno al grupo`. |
| `46` | `$modelTurno->asignarGrupoAlTurno($idAsignacion, $nuevaFecha, (int)$g['id...` | Instrucción de ejecución en el contexto del script: `$modelTurno->asignarGrupoAlTurno($idAsignacion, $nuevaFecha, (int)$g['id...`. |
| `47` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `48` | `// Actualizar en el array local para que la vista muestre la fecha correcta` | Comentario explicativo en el código: `Actualizar en el array local para que la vista muestre la fecha correcta`. |
| `49` | `$g['fecha_limpieza'] = $nuevaFecha;` | Instrucción de ejecución en el contexto del script: `$g['fecha_limpieza'] = $nuevaFecha;`. |
| `50` | `$huboActualizacion = true;` | Instrucción de ejecución en el contexto del script: `$huboActualizacion = true;`. |
| `51` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `52` | `unset($g);` | Instrucción de ejecución en el contexto del script: `unset($g);`. |
| `53` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `54` | `// Si hubo cambios, recargar grupos con orden correcto` | Comentario explicativo en el código: `Si hubo cambios, recargar grupos con orden correcto`. |
| `55` | `if ($huboActualizacion) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if ($huboActualizacion) {`. |
| `56` | `$grupos = $modelGrupo->obtenerPorVocero($idVocero);` | Instrucción de ejecución en el contexto del script: `$grupos = $modelGrupo->obtenerPorVocero($idVocero);`. |
| `57` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `58` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `59` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `60` | `// Cargar integrantes de todos los grupos de una sola vez` | Comentario explicativo en el código: `Cargar integrantes de todos los grupos de una sola vez`. |
| `61` | `$integrantesPorGrupo = [];` | Instrucción de ejecución en el contexto del script: `$integrantesPorGrupo = [];`. |
| `62` | `if (!empty($grupos)) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (!empty($grupos)) {`. |
| `63` | `$ids   = implode(',', array_column($grupos, 'id_grupo'));` | Instrucción de ejecución en el contexto del script: `$ids   = implode(',', array_column($grupos, 'id_grupo'));`. |
| `64` | `$stmtI = $db->query(` | Instrucción de ejecución en el contexto del script: `$stmtI = $db->query(`. |
| `65` | `"SELECT gi.id_grupo, ap.nombres, ap.apellidos, ap.documento, ap.celular,...` | Instrucción de ejecución en el contexto del script: `"SELECT gi.id_grupo, ap.nombres, ap.apellidos, ap.documento, ap.celular,...`. |
| `66` | `FROM grupo_integrantes gi` | Instrucción de ejecución en el contexto del script: `FROM grupo_integrantes gi`. |
| `67` | `JOIN aprendices ap ON ap.id_aprendiz = gi.id_aprendiz` | Instrucción de ejecución en el contexto del script: `JOIN aprendices ap ON ap.id_aprendiz = gi.id_aprendiz`. |
| `68` | `WHERE gi.id_grupo IN ($ids)` | Instrucción de ejecución en el contexto del script: `WHERE gi.id_grupo IN ($ids)`. |
| `69` | `ORDER BY ap.apellidos ASC"` | Instrucción de ejecución en el contexto del script: `ORDER BY ap.apellidos ASC"`. |
| `70` | ``);`` | Cierre de estructura de arreglo o invocación de función. |
| `71` | `foreach ($stmtI->fetchAll(PDO::FETCH_ASSOC) as $row) {` | Estructura de control iterativa para recorrer colecciones o arreglos: `foreach ($stmtI->fetchAll(PDO::FETCH_ASSOC) as $row) {`. |
| `72` | `$integrantesPorGrupo[(int)$row['id_grupo']][] = $row;` | Instrucción de ejecución en el contexto del script: `$integrantesPorGrupo[(int)$row['id_grupo']][] = $row;`. |
| `73` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `74` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `75` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `76` | `// Asignación activa` | Comentario explicativo en el código: `Asignación activa`. |
| `77` | `$stmtAsig = $db->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmtAsig = $db->prepare(`. |
| `78` | `"SELECT a.*, m.nombre AS nombre_modulo, m.ubicacion, f.numero_ficha` | Instrucción de ejecución en el contexto del script: `"SELECT a.*, m.nombre AS nombre_modulo, m.ubicacion, f.numero_ficha`. |
| `79` | `FROM asignaciones a` | Instrucción de ejecución en el contexto del script: `FROM asignaciones a`. |
| `80` | `JOIN modulos m ON m.id_modulo = a.id_modulo` | Instrucción de ejecución en el contexto del script: `JOIN modulos m ON m.id_modulo = a.id_modulo`. |
| `81` | `JOIN fichas  f ON f.id_ficha  = a.id_ficha` | Instrucción de ejecución en el contexto del script: `JOIN fichas  f ON f.id_ficha  = a.id_ficha`. |
| `82` | `WHERE a.id_ficha = :fic AND a.estado = 'Activa'` | Instrucción de ejecución en el contexto del script: `WHERE a.id_ficha = :fic AND a.estado = 'Activa'`. |
| `83` | `ORDER BY a.fecha_creacion DESC LIMIT 1"` | Instrucción de ejecución en el contexto del script: `ORDER BY a.fecha_creacion DESC LIMIT 1"`. |
| `84` | ``);`` | Cierre de estructura de arreglo o invocación de función. |
| `85` | `$stmtAsig->execute([':fic' => $idFicha]);` | Ejecuta la sentencia SQL preparada vinculando los parámetros correspondientes: `$stmtAsig->execute([':fic' => $idFicha]);`. |
| `86` | `$asignacion = $stmtAsig->fetch(PDO::FETCH_ASSOC);` | Recupera una única fila o registro resultante de la consulta. |
| `87` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `88` | `$modelTurno      = new Turno($db);` | Instrucción de ejecución en el contexto del script: `$modelTurno      = new Turno($db);`. |
| `89` | `$proximaFecha    = $asignacion ? $modelTurno->proximaFechaLibre((int)$as...` | Instrucción de ejecución en el contexto del script: `$proximaFecha    = $asignacion ? $modelTurno->proximaFechaLibre((int)$as...`. |
| `90` | `$turnosRestantes = $asignacion ? $modelTurno->turnosLibresRestantes((int...` | Instrucción de ejecución en el contexto del script: `$turnosRestantes = $asignacion ? $modelTurno->turnosLibresRestantes((int...`. |
| `91` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `92` | `$diasES = ['Domingo','Lunes','Martes','Miércoles','Jueves','Viernes','Sá...` | Instrucción de ejecución en el contexto del script: `$diasES = ['Domingo','Lunes','Martes','Miércoles','Jueves','Viernes','Sá...`. |
| `93` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `94` | `// Aprendices de la ficha + cuáles ya están ocupados en algún grupo` | Comentario explicativo en el código: `Aprendices de la ficha + cuáles ya están ocupados en algún grupo`. |
| `95` | `$aprendices    = (new Ficha($db))->obtenerAprendicesDeFicha($idFicha);` | Instrucción de ejecución en el contexto del script: `$aprendices    = (new Ficha($db))->obtenerAprendicesDeFicha($idFicha);`. |
| `96` | `$aprendicesOcupados = $modelGrupo->aprendicesOcupadosEnFicha($idFicha);` | Instrucción de ejecución en el contexto del script: `$aprendicesOcupados = $modelGrupo->aprendicesOcupadosEnFicha($idFicha);`. |
| `97` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `98` | `require_once __DIR__ . '/../layouts/header.php';` | Importación e inclusión obligatoria del archivo de dependencia requerido: `require_once __DIR__ . '/../layouts/header.php';`. |
| `99` | ``?>`` | Cierre de la etiqueta PHP para alternar a salida HTML o fin del archivo. |
| `100` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `101` | `<div class="d-flex justify-content-between align-items-center mb-4">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="d-flex justify-content-between align-items-center mb-4">`. |
| `102` | `<div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div>`. |
| `103` | `<h4 class="fw-bold mb-0"><i class="fas fa-people-group text-success me-2...` | Instrucción de ejecución en el contexto del script: `<h4 class="fw-bold mb-0"><i class="fas fa-people-group text-success me-2...`. |
| `104` | `<p class="text-muted small mb-0">Registra y gestiona los grupos responsa...` | Instrucción de ejecución en el contexto del script: `<p class="text-muted small mb-0">Registra y gestiona los grupos responsa...`. |
| `105` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `106` | `<button class="btn btn-success btn-sm fw-semibold" data-bs-toggle="modal...` | Botón de acción interactivo para el usuario: `<button class="btn btn-success btn-sm fw-semibold" data-bs-toggle="modal...`. |
| `107` | `<i class="fas fa-plus me-1"></i> Nuevo Grupo` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-plus me-1"></i> Nuevo Grupo`. |
| `108` | `</button>` | Instrucción de ejecución en el contexto del script: `</button>`. |
| `109` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `110` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `111` | `<!-- Módulo activo -->` | Instrucción de ejecución en el contexto del script: `<!-- Módulo activo -->`. |
| `112` | `<?php if ($asignacion): ?>` | Instrucción de ejecución en el contexto del script: `<?php if ($asignacion): ?>`. |
| `113` | `<div class="card border-0 shadow-sm mb-3"` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="card border-0 shadow-sm mb-3"`. |
| `114` | `style="border-left:4px solid #39a900; background:linear-gradient(135deg,...` | Instrucción de ejecución en el contexto del script: `style="border-left:4px solid #39a900; background:linear-gradient(135deg,...`. |
| `115` | `<div class="card-body py-3 px-4 d-flex align-items-center gap-3 flex-wrap">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="card-body py-3 px-4 d-flex align-items-center gap-3 flex-wrap">`. |
| `116` | `<div style="width:42px;height:42px;border-radius:10px;background:#39a900;` | Contenedor visual estructurado con Bootstrap/CSS: `<div style="width:42px;height:42px;border-radius:10px;background:#39a900;`. |
| `117` | `color:#fff;display:flex;align-items:center;justify-content:center;flex-s...` | Instrucción de ejecución en el contexto del script: `color:#fff;display:flex;align-items:center;justify-content:center;flex-s...`. |
| `118` | `<i class="fas fa-door-open"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-door-open"></i>`. |
| `119` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `120` | `<div class="flex-grow-1">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="flex-grow-1">`. |
| `121` | `<div class="text-muted" style="font-size:.72rem;text-transform:uppercase...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="text-muted" style="font-size:.72rem;text-transform:uppercase...`. |
| `122` | `<div class="fw-bold"><?= htmlspecialchars($asignacion['nombre_modulo']) ...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="fw-bold"><?= htmlspecialchars($asignacion['nombre_modulo']) ...`. |
| `123` | `<?php if ($asignacion['ubicacion']): ?>` | Instrucción de ejecución en el contexto del script: `<?php if ($asignacion['ubicacion']): ?>`. |
| `124` | `<div class="text-muted small"><i class="fas fa-location-dot me-1"></i><?...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="text-muted small"><i class="fas fa-location-dot me-1"></i><?...`. |
| `125` | `<?php endif; ?>` | Cierre de estructura condicional embebida en la plantilla HTML. |
| `126` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `127` | `<div class="text-center px-3 py-2 rounded-3" style="background:rgba(57,1...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="text-center px-3 py-2 rounded-3" style="background:rgba(57,1...`. |
| `128` | `<div class="text-muted" style="font-size:.7rem;text-transform:uppercase;...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="text-muted" style="font-size:.7rem;text-transform:uppercase;...`. |
| `129` | `<?php if ($proximaFecha): ?>` | Instrucción de ejecución en el contexto del script: `<?php if ($proximaFecha): ?>`. |
| `130` | `<div class="fw-bold text-success" style="font-size:1rem;"><?= date('d/m/...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="fw-bold text-success" style="font-size:1rem;"><?= date('d/m/...`. |
| `131` | `<div class="text-muted" style="font-size:.75rem;"><?= $diasES[(int)(new ...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="text-muted" style="font-size:.75rem;"><?= $diasES[(int)(new ...`. |
| `132` | `<?php else: ?>` | Instrucción de ejecución en el contexto del script: `<?php else: ?>`. |
| `133` | `<div class="text-muted small">Sin turnos<br>pendientes</div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="text-muted small">Sin turnos<br>pendientes</div>`. |
| `134` | `<?php endif; ?>` | Cierre de estructura condicional embebida en la plantilla HTML. |
| `135` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `136` | `<div class="text-center px-3 py-2 rounded-3" style="background:rgba(37,9...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="text-center px-3 py-2 rounded-3" style="background:rgba(37,9...`. |
| `137` | `<div class="text-muted" style="font-size:.7rem;text-transform:uppercase;...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="text-muted" style="font-size:.7rem;text-transform:uppercase;...`. |
| `138` | `<div class="fw-bold" style="font-size:1rem;color:#2563eb;"><?= $turnosRe...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="fw-bold" style="font-size:1rem;color:#2563eb;"><?= $turnosRe...`. |
| `139` | `<div class="text-muted" style="font-size:.75rem;">disponibles</div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="text-muted" style="font-size:.75rem;">disponibles</div>`. |
| `140` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `141` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `142` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `143` | `<?php else: ?>` | Instrucción de ejecución en el contexto del script: `<?php else: ?>`. |
| `144` | `<div class="alert alert-warning border-0 shadow-sm mb-3 py-2 small">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="alert alert-warning border-0 shadow-sm mb-3 py-2 small">`. |
| `145` | `<i class="fas fa-triangle-exclamation me-1"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-triangle-exclamation me-1"></i>`. |
| `146` | `Tu ficha no tiene ningún módulo asignado. El administrador debe asignarl...` | Instrucción de ejecución en el contexto del script: `Tu ficha no tiene ningún módulo asignado. El administrador debe asignarl...`. |
| `147` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `148` | `<?php endif; ?>` | Cierre de estructura condicional embebida en la plantilla HTML. |
| `149` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `150` | `<!-- Lista de grupos -->` | Instrucción de ejecución en el contexto del script: `<!-- Lista de grupos -->`. |
| `151` | `<?php if (empty($grupos)): ?>` | Instrucción de ejecución en el contexto del script: `<?php if (empty($grupos)): ?>`. |
| `152` | `<div class="card border-0 shadow-sm text-center py-5 text-muted">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="card border-0 shadow-sm text-center py-5 text-muted">`. |
| `153` | `<i class="fas fa-people-group fa-3x mb-3 opacity-25 d-block"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-people-group fa-3x mb-3 opacity-25 d-block"></i>`. |
| `154` | `<p class="small mb-0">No has registrado ningún grupo de limpieza aún.</p>` | Instrucción de ejecución en el contexto del script: `<p class="small mb-0">No has registrado ningún grupo de limpieza aún.</p>`. |
| `155` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `156` | `<?php else: ?>` | Instrucción de ejecución en el contexto del script: `<?php else: ?>`. |
| `157` | `<?php foreach ($grupos as $numGrupo => $g):` | Instrucción de ejecución en el contexto del script: `<?php foreach ($grupos as $numGrupo => $g):`. |
| `158` | `$integrantes = $integrantesPorGrupo[(int)$g['id_grupo']] ?? [];` | Instrucción de ejecución en el contexto del script: `$integrantes = $integrantesPorGrupo[(int)$g['id_grupo']] ?? [];`. |
| `159` | `$esHoy       = date('Y-m-d', strtotime($g['fecha_limpieza'])) === date('...` | Instrucción de ejecución en el contexto del script: `$esHoy       = date('Y-m-d', strtotime($g['fecha_limpieza'])) === date('...`. |
| `160` | `$vencido     = strtotime($g['fecha_limpieza']) < strtotime('today');` | Instrucción de ejecución en el contexto del script: `$vencido     = strtotime($g['fecha_limpieza']) < strtotime('today');`. |
| `161` | `$badge       = match($g['estado']) {` | Instrucción de ejecución en el contexto del script: `$badge       = match($g['estado']) {`. |
| `162` | `'Completado' => ['bg'=>'#dbeafe','color'=>'#1d4ed8'],` | Instrucción de ejecución en el contexto del script: `'Completado' => ['bg'=>'#dbeafe','color'=>'#1d4ed8'],`. |
| `163` | `'Sancionado' => ['bg'=>'#fee2e2','color'=>'#991b1b'],` | Instrucción de ejecución en el contexto del script: `'Sancionado' => ['bg'=>'#fee2e2','color'=>'#991b1b'],`. |
| `164` | `default      => ['bg'=>'#dcfce7','color'=>'#166534'],` | Instrucción de ejecución en el contexto del script: `default      => ['bg'=>'#dcfce7','color'=>'#166534'],`. |
| `165` | `};` | Instrucción de ejecución en el contexto del script: `};`. |
| `166` | ``?>`` | Cierre de la etiqueta PHP para alternar a salida HTML o fin del archivo. |
| `167` | `<div class="card border-0 shadow-sm mb-3" style="border-radius:12px;over...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="card border-0 shadow-sm mb-3" style="border-radius:12px;over...`. |
| `168` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `169` | `<!-- Cabecera del grupo -->` | Instrucción de ejecución en el contexto del script: `<!-- Cabecera del grupo -->`. |
| `170` | `<div class="d-flex align-items-center gap-3 px-4 py-3"` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="d-flex align-items-center gap-3 px-4 py-3"`. |
| `171` | `style="background:#f9fafb;border-bottom:1px solid #e5e7eb;">` | Instrucción de ejecución en el contexto del script: `style="background:#f9fafb;border-bottom:1px solid #e5e7eb;">`. |
| `172` | `<div style="width:38px;height:38px;border-radius:9px;background:#39a900;` | Contenedor visual estructurado con Bootstrap/CSS: `<div style="width:38px;height:38px;border-radius:9px;background:#39a900;`. |
| `173` | `color:#fff;font-weight:700;font-size:1rem;flex-shrink:0;` | Instrucción de ejecución en el contexto del script: `color:#fff;font-weight:700;font-size:1rem;flex-shrink:0;`. |
| `174` | `display:flex;align-items:center;justify-content:center;">` | Instrucción de ejecución en el contexto del script: `display:flex;align-items:center;justify-content:center;">`. |
| `175` | `<?= $numGrupo + 1 ?>` | Instrucción de ejecución en el contexto del script: `<?= $numGrupo + 1 ?>`. |
| `176` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `177` | `<div class="flex-grow-1">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="flex-grow-1">`. |
| `178` | `<div class="fw-bold" style="font-size:.95rem;color:#111827;">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="fw-bold" style="font-size:.95rem;color:#111827;">`. |
| `179` | `<?= htmlspecialchars($g['nombre_grupo']) ?>` | Instrucción de ejecución en el contexto del script: `<?= htmlspecialchars($g['nombre_grupo']) ?>`. |
| `180` | `<?php if ($esHoy): ?>` | Instrucción de ejecución en el contexto del script: `<?php if ($esHoy): ?>`. |
| `181` | `<span class="badge bg-warning text-dark ms-1" style="font-size:.63rem;">...` | Instrucción de ejecución en el contexto del script: `<span class="badge bg-warning text-dark ms-1" style="font-size:.63rem;">...`. |
| `182` | `<?php endif; ?>` | Cierre de estructura condicional embebida en la plantilla HTML. |
| `183` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `184` | `<div class="text-muted" style="font-size:.78rem;">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="text-muted" style="font-size:.78rem;">`. |
| `185` | `<i class="fas fa-calendar me-1"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-calendar me-1"></i>`. |
| `186` | `<?= date('d/m/Y', strtotime($g['fecha_limpieza'])) ?>` | Instrucción de ejecución en el contexto del script: `<?= date('d/m/Y', strtotime($g['fecha_limpieza'])) ?>`. |
| `187` | `· <?= $diasES[(int)(new DateTime($g['fecha_limpieza']))->format('w')] ?>` | Instrucción de ejecución en el contexto del script: `· <?= $diasES[(int)(new DateTime($g['fecha_limpieza']))->format('w')] ?>`. |
| `188` | `<span class="mx-2">·</span>` | Instrucción de ejecución en el contexto del script: `<span class="mx-2">·</span>`. |
| `189` | `<i class="fas fa-door-open me-1"></i><?= htmlspecialchars($g['nombre_mod...` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-door-open me-1"></i><?= htmlspecialchars($g['nombre_mod...`. |
| `190` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `191` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `192` | `<div class="d-flex align-items-center gap-2 flex-shrink-0 flex-wrap">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="d-flex align-items-center gap-2 flex-shrink-0 flex-wrap">`. |
| `193` | `<!-- Estado -->` | Instrucción de ejecución en el contexto del script: `<!-- Estado -->`. |
| `194` | `<span style="background:<?= $badge['bg'] ?>;color:<?= $badge['color'] ?>;` | Instrucción de ejecución en el contexto del script: `<span style="background:<?= $badge['bg'] ?>;color:<?= $badge['color'] ?>;`. |
| `195` | `padding:.25rem .65rem;border-radius:20px;font-size:.72rem;font-weight:60...` | Instrucción de ejecución en el contexto del script: `padding:.25rem .65rem;border-radius:20px;font-size:.72rem;font-weight:60...`. |
| `196` | `<?= $g['estado'] ?>` | Instrucción de ejecución en el contexto del script: `<?= $g['estado'] ?>`. |
| `197` | `</span>` | Instrucción de ejecución en el contexto del script: `</span>`. |
| `198` | `<!-- Integrantes -->` | Instrucción de ejecución en el contexto del script: `<!-- Integrantes -->`. |
| `199` | `<button class="btn btn-sm btn-outline-success"` | Botón de acción interactivo para el usuario: `<button class="btn btn-sm btn-outline-success"`. |
| `200` | `onclick="verIntegrantes(<?= $g['id_grupo'] ?>, '<?= addslashes($g['nombr...` | Instrucción de ejecución en el contexto del script: `onclick="verIntegrantes(<?= $g['id_grupo'] ?>, '<?= addslashes($g['nombr...`. |
| `201` | `title="Ver integrantes">` | Instrucción de ejecución en el contexto del script: `title="Ver integrantes">`. |
| `202` | `<i class="fas fa-users me-1"></i><?= count($integrantes) ?>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-users me-1"></i><?= count($integrantes) ?>`. |
| `203` | `</button>` | Instrucción de ejecución en el contexto del script: `</button>`. |
| `204` | `<!-- Editar siempre disponible -->` | Instrucción de ejecución en el contexto del script: `<!-- Editar siempre disponible -->`. |
| `205` | `<button class="btn btn-sm btn-outline-primary"` | Botón de acción interactivo para el usuario: `<button class="btn btn-sm btn-outline-primary"`. |
| `206` | `onclick='abrirEdicion(<?= json_encode(['id_grupo'=>$g['id_grupo'],'nombr...` | Instrucción de ejecución en el contexto del script: `onclick='abrirEdicion(<?= json_encode(['id_grupo'=>$g['id_grupo'],'nombr...`. |
| `207` | `title="Editar integrantes">` | Instrucción de ejecución en el contexto del script: `title="Editar integrantes">`. |
| `208` | `<i class="fas fa-pen"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-pen"></i>`. |
| `209` | `</button>` | Instrucción de ejecución en el contexto del script: `</button>`. |
| `210` | `<!-- Eliminar siempre disponible -->` | Instrucción de ejecución en el contexto del script: `<!-- Eliminar siempre disponible -->`. |
| `211` | `<form action="../../controllers/VoceroController.php" method="POST" clas...` | Formulario interactivo para captura y envío de datos: `<form action="../../controllers/VoceroController.php" method="POST" clas...`. |
| `212` | `id="form-del-<?= $g['id_grupo'] ?>">` | Instrucción de ejecución en el contexto del script: `id="form-del-<?= $g['id_grupo'] ?>">`. |
| `213` | `<input type="hidden" name="accion"   value="eliminar_grupo">` | Campo de entrada interactivo para datos del usuario: `<input type="hidden" name="accion"   value="eliminar_grupo">`. |
| `214` | `<input type="hidden" name="id_grupo" value="<?= $g['id_grupo'] ?>">` | Campo de entrada interactivo para datos del usuario: `<input type="hidden" name="id_grupo" value="<?= $g['id_grupo'] ?>">`. |
| `215` | `<button type="button" class="btn btn-sm btn-outline-danger"` | Botón de acción interactivo para el usuario: `<button type="button" class="btn btn-sm btn-outline-danger"`. |
| `216` | `onclick="confirmarEliminar(<?= $g['id_grupo'] ?>, '<?= addslashes($g['no...` | Instrucción de ejecución en el contexto del script: `onclick="confirmarEliminar(<?= $g['id_grupo'] ?>, '<?= addslashes($g['no...`. |
| `217` | `title="Eliminar">` | Instrucción de ejecución en el contexto del script: `title="Eliminar">`. |
| `218` | `<i class="fas fa-trash"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-trash"></i>`. |
| `219` | `</button>` | Instrucción de ejecución en el contexto del script: `</button>`. |
| `220` | ``</form>`` | Cierre de formulario interactivo. |
| `221` | `<?php if ($esHoy && (int)$g['tiene_evidencia'] === 0): ?>` | Instrucción de ejecución en el contexto del script: `<?php if ($esHoy && (int)$g['tiene_evidencia'] === 0): ?>`. |
| `222` | `<a href="vocero_subir_evidencia.php" class="btn btn-sm btn-success fw-se...` | Instrucción de ejecución en el contexto del script: `<a href="vocero_subir_evidencia.php" class="btn btn-sm btn-success fw-se...`. |
| `223` | `<i class="fas fa-camera me-1"></i>Subir evidencia` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-camera me-1"></i>Subir evidencia`. |
| `224` | `</a>` | Instrucción de ejecución en el contexto del script: `</a>`. |
| `225` | `<?php endif; ?>` | Cierre de estructura condicional embebida en la plantilla HTML. |
| `226` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `227` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `228` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `229` | `<!-- Integrantes inline (siempre visibles) -->` | Instrucción de ejecución en el contexto del script: `<!-- Integrantes inline (siempre visibles) -->`. |
| `230` | `<?php if (empty($integrantes)): ?>` | Instrucción de ejecución en el contexto del script: `<?php if (empty($integrantes)): ?>`. |
| `231` | `<div class="px-4 py-3 text-muted small">Sin integrantes registrados.</div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="px-4 py-3 text-muted small">Sin integrantes registrados.</div>`. |
| `232` | `<?php else: ?>` | Instrucción de ejecución en el contexto del script: `<?php else: ?>`. |
| `233` | `<div class="table-responsive">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="table-responsive">`. |
| `234` | `<table class="table mb-0" style="font-size:.82rem;">` | Tabla de datos para despliegue estructurado de información. |
| `235` | `<thead>` | Definición de estructura semántica de cabecera o cuerpo de tabla. |
| `236` | ``<tr>`` | Fila contenedora de datos dentro de la tabla. |
| `237` | `<th style="padding:.45rem 1rem;font-weight:700;color:#6b7280;font-size:....` | Celda de encabezado de columna: `<th style="padding:.45rem 1rem;font-weight:700;color:#6b7280;font-size:....`. |
| `238` | `<th style="padding:.45rem .75rem;font-weight:700;color:#6b7280;font-size...` | Celda de encabezado de columna: `<th style="padding:.45rem .75rem;font-weight:700;color:#6b7280;font-size...`. |
| `239` | `<th style="padding:.45rem .75rem;font-weight:700;color:#6b7280;font-size...` | Celda de encabezado de columna: `<th style="padding:.45rem .75rem;font-weight:700;color:#6b7280;font-size...`. |
| `240` | `<th style="padding:.45rem .75rem;font-weight:700;color:#6b7280;font-size...` | Celda de encabezado de columna: `<th style="padding:.45rem .75rem;font-weight:700;color:#6b7280;font-size...`. |
| `241` | `<th style="padding:.45rem .75rem;font-weight:700;color:#6b7280;font-size...` | Celda de encabezado de columna: `<th style="padding:.45rem .75rem;font-weight:700;color:#6b7280;font-size...`. |
| `242` | ``</tr>`` | Cierre de fila contenedora de tabla. |
| `243` | `</thead>` | Definición de estructura semántica de cabecera o cuerpo de tabla. |
| `244` | `<tbody>` | Definición de estructura semántica de cabecera o cuerpo de tabla. |
| `245` | `<?php foreach ($integrantes as $idx => $ap): ?>` | Instrucción de ejecución en el contexto del script: `<?php foreach ($integrantes as $idx => $ap): ?>`. |
| `246` | ``<tr>`` | Fila contenedora de datos dentro de la tabla. |
| `247` | `<td style="padding:.5rem 1rem;color:#9ca3af;"><?= $idx + 1 ?></td>` | Celda de contenido de tabla: `<td style="padding:.5rem 1rem;color:#9ca3af;"><?= $idx + 1 ?></td>`. |
| `248` | `<td style="padding:.5rem .75rem;font-weight:600;color:#111827;"><?= html...` | Celda de contenido de tabla: `<td style="padding:.5rem .75rem;font-weight:600;color:#111827;"><?= html...`. |
| `249` | `<td style="padding:.5rem .75rem;color:#374151;"><?= htmlspecialchars($ap...` | Celda de contenido de tabla: `<td style="padding:.5rem .75rem;color:#374151;"><?= htmlspecialchars($ap...`. |
| `250` | `<td style="padding:.5rem .75rem;color:#6b7280;"><?= htmlspecialchars($ap...` | Celda de contenido de tabla: `<td style="padding:.5rem .75rem;color:#6b7280;"><?= htmlspecialchars($ap...`. |
| `251` | `<td style="padding:.5rem .75rem;">` | Celda de contenido de tabla: `<td style="padding:.5rem .75rem;">`. |
| `252` | `<?php if (!empty($ap['celular'])): ?>` | Instrucción de ejecución en el contexto del script: `<?php if (!empty($ap['celular'])): ?>`. |
| `253` | `<a href="tel:<?= htmlspecialchars($ap['celular']) ?>" class="text-decora...` | Instrucción de ejecución en el contexto del script: `<a href="tel:<?= htmlspecialchars($ap['celular']) ?>" class="text-decora...`. |
| `254` | `<i class="fas fa-phone text-success me-1" style="font-size:.68rem;"></i>...` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-phone text-success me-1" style="font-size:.68rem;"></i>...`. |
| `255` | `</a>` | Instrucción de ejecución en el contexto del script: `</a>`. |
| `256` | `<?php else: ?><span class="text-muted">—</span><?php endif; ?>` | Instrucción de ejecución en el contexto del script: `<?php else: ?><span class="text-muted">—</span><?php endif; ?>`. |
| `257` | `</td>` | Instrucción de ejecución en el contexto del script: `</td>`. |
| `258` | ``</tr>`` | Cierre de fila contenedora de tabla. |
| `259` | `<?php endforeach; ?>` | Cierre de ciclo iterativo foreach embebido en la plantilla HTML. |
| `260` | `</tbody>` | Definición de estructura semántica de cabecera o cuerpo de tabla. |
| `261` | ``</table>`` | Cierre de tabla de datos. |
| `262` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `263` | `<?php endif; ?>` | Cierre de estructura condicional embebida en la plantilla HTML. |
| `264` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `265` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `266` | `<?php endforeach; ?>` | Cierre de ciclo iterativo foreach embebido en la plantilla HTML. |
| `267` | `<?php endif; ?>` | Cierre de estructura condicional embebida en la plantilla HTML. |
| `268` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `269` | `<!-- ══ Modal Nuevo / Editar Grupo ══ -->` | Instrucción de ejecución en el contexto del script: `<!-- ══ Modal Nuevo / Editar Grupo ══ -->`. |
| `270` | `<div class="modal fade" id="modalGrupo" tabindex="-1" aria-hidden="true">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="modal fade" id="modalGrupo" tabindex="-1" aria-hidden="true">`. |
| `271` | `<div class="modal-dialog modal-dialog-centered modal-lg">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="modal-dialog modal-dialog-centered modal-lg">`. |
| `272` | `<div class="modal-content shadow">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="modal-content shadow">`. |
| `273` | `<div class="modal-header" style="background:#0f2200;color:#fff;">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="modal-header" style="background:#0f2200;color:#fff;">`. |
| `274` | `<h6 class="modal-title fw-bold" id="titModalGrupo">` | Instrucción de ejecución en el contexto del script: `<h6 class="modal-title fw-bold" id="titModalGrupo">`. |
| `275` | `<i class="fas fa-people-group me-2 text-success"></i>Nuevo Grupo de Limp...` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-people-group me-2 text-success"></i>Nuevo Grupo de Limp...`. |
| `276` | `</h6>` | Instrucción de ejecución en el contexto del script: `</h6>`. |
| `277` | `<button type="button" class="btn-close btn-close-white" data-bs-dismiss=...` | Botón de acción interactivo para el usuario: `<button type="button" class="btn-close btn-close-white" data-bs-dismiss=...`. |
| `278` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `279` | `<form action="../../controllers/VoceroController.php" method="POST" id="...` | Formulario interactivo para captura y envío de datos: `<form action="../../controllers/VoceroController.php" method="POST" id="...`. |
| `280` | `<input type="hidden" name="accion"        id="accionGrupo"  value="guard...` | Campo de entrada interactivo para datos del usuario: `<input type="hidden" name="accion"        id="accionGrupo"  value="guard...`. |
| `281` | `<input type="hidden" name="id_grupo"      id="id_grupo"     value="">` | Campo de entrada interactivo para datos del usuario: `<input type="hidden" name="id_grupo"      id="id_grupo"     value="">`. |
| `282` | `<input type="hidden" name="id_asignacion" value="<?= $asignacion ? $asig...` | Campo de entrada interactivo para datos del usuario: `<input type="hidden" name="id_asignacion" value="<?= $asignacion ? $asig...`. |
| `283` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `284` | `<div class="modal-body px-4 py-4">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="modal-body px-4 py-4">`. |
| `285` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `286` | `<?php if ($asignacion): ?>` | Instrucción de ejecución en el contexto del script: `<?php if ($asignacion): ?>`. |
| `287` | `<div class="rounded-3 p-3 mb-3 d-flex align-items-center gap-3"` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="rounded-3 p-3 mb-3 d-flex align-items-center gap-3"`. |
| `288` | `style="background:#f0fff4;border:1px solid #86efac;">` | Instrucción de ejecución en el contexto del script: `style="background:#f0fff4;border:1px solid #86efac;">`. |
| `289` | `<div style="width:38px;height:38px;border-radius:8px;background:#39a900;` | Contenedor visual estructurado con Bootstrap/CSS: `<div style="width:38px;height:38px;border-radius:8px;background:#39a900;`. |
| `290` | `color:#fff;display:flex;align-items:center;justify-content:center;flex-s...` | Instrucción de ejecución en el contexto del script: `color:#fff;display:flex;align-items:center;justify-content:center;flex-s...`. |
| `291` | `<i class="fas fa-door-open"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-door-open"></i>`. |
| `292` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `293` | `<div class="flex-grow-1">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="flex-grow-1">`. |
| `294` | `<div class="text-muted" style="font-size:.7rem;text-transform:uppercase;...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="text-muted" style="font-size:.7rem;text-transform:uppercase;...`. |
| `295` | `<div class="fw-bold"><?= htmlspecialchars($asignacion['nombre_modulo']) ...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="fw-bold"><?= htmlspecialchars($asignacion['nombre_modulo']) ...`. |
| `296` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `297` | `<?php if ($proximaFecha): ?>` | Instrucción de ejecución en el contexto del script: `<?php if ($proximaFecha): ?>`. |
| `298` | `<div class="text-end">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="text-end">`. |
| `299` | `<div class="text-muted" style="font-size:.7rem;">Fecha automática</div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="text-muted" style="font-size:.7rem;">Fecha automática</div>`. |
| `300` | `<div class="fw-bold text-success"><?= date('d/m/Y', strtotime($proximaFe...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="fw-bold text-success"><?= date('d/m/Y', strtotime($proximaFe...`. |
| `301` | `<div class="text-muted" style="font-size:.72rem;"><?= $diasES[(int)(new ...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="text-muted" style="font-size:.72rem;"><?= $diasES[(int)(new ...`. |
| `302` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `303` | `<?php endif; ?>` | Cierre de estructura condicional embebida en la plantilla HTML. |
| `304` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `305` | `<?php else: ?>` | Instrucción de ejecución en el contexto del script: `<?php else: ?>`. |
| `306` | `<div class="alert alert-warning py-2 small mb-3">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="alert alert-warning py-2 small mb-3">`. |
| `307` | `<i class="fas fa-triangle-exclamation me-1"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-triangle-exclamation me-1"></i>`. |
| `308` | `Tu ficha no tiene módulo asignado activo. Contacta al administrador.` | Instrucción de ejecución en el contexto del script: `Tu ficha no tiene módulo asignado activo. Contacta al administrador.`. |
| `309` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `310` | `<?php endif; ?>` | Cierre de estructura condicional embebida en la plantilla HTML. |
| `311` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `312` | `<?php if (!$proximaFecha && $asignacion): ?>` | Instrucción de ejecución en el contexto del script: `<?php if (!$proximaFecha && $asignacion): ?>`. |
| `313` | `<div class="alert alert-danger py-2 small mb-3">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="alert alert-danger py-2 small mb-3">`. |
| `314` | `<i class="fas fa-ban me-1"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-ban me-1"></i>`. |
| `315` | `No hay turnos disponibles. Todos ya tienen grupo asignado.` | Instrucción de ejecución en el contexto del script: `No hay turnos disponibles. Todos ya tienen grupo asignado.`. |
| `316` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `317` | `<?php endif; ?>` | Cierre de estructura condicional embebida en la plantilla HTML. |
| `318` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `319` | `<!-- Integrantes -->` | Instrucción de ejecución en el contexto del script: `<!-- Integrantes -->`. |
| `320` | `<div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div>`. |
| `321` | `<label class="form-label fw-semibold small">` | Instrucción de ejecución en el contexto del script: `<label class="form-label fw-semibold small">`. |
| `322` | `Integrantes <span class="text-danger">*</span>` | Instrucción de ejecución en el contexto del script: `Integrantes <span class="text-danger">*</span>`. |
| `323` | `<span class="text-muted fw-normal">(aprendices en gris ya están en otro ...` | Instrucción de ejecución en el contexto del script: `<span class="text-muted fw-normal">(aprendices en gris ya están en otro ...`. |
| `324` | `</label>` | Instrucción de ejecución en el contexto del script: `</label>`. |
| `325` | `<?php if (empty($aprendices)): ?>` | Instrucción de ejecución en el contexto del script: `<?php if (empty($aprendices)): ?>`. |
| `326` | `<div class="alert alert-warning py-2 small">No hay aprendices sincroniza...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="alert alert-warning py-2 small">No hay aprendices sincroniza...`. |
| `327` | `<?php else: ?>` | Instrucción de ejecución en el contexto del script: `<?php else: ?>`. |
| `328` | `<div style="max-height:240px;overflow-y:auto;border:1px solid #dee2e6;bo...` | Contenedor visual estructurado con Bootstrap/CSS: `<div style="max-height:240px;overflow-y:auto;border:1px solid #dee2e6;bo...`. |
| `329` | `<?php foreach ($aprendices as $ap):` | Instrucción de ejecución en el contexto del script: `<?php foreach ($aprendices as $ap):`. |
| `330` | `$ocupado = in_array((int)$ap['id_aprendiz'], $aprendicesOcupados);` | Instrucción de ejecución en el contexto del script: `$ocupado = in_array((int)$ap['id_aprendiz'], $aprendicesOcupados);`. |
| `331` | ``?>`` | Cierre de la etiqueta PHP para alternar a salida HTML o fin del archivo. |
| `332` | `<div class="form-check py-1">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="form-check py-1">`. |
| `333` | `<input class="form-check-input" type="checkbox"` | Campo de entrada interactivo para datos del usuario: `<input class="form-check-input" type="checkbox"`. |
| `334` | `name="aprendices[]" value="<?= $ap['id_aprendiz'] ?>"` | Instrucción de ejecución en el contexto del script: `name="aprendices[]" value="<?= $ap['id_aprendiz'] ?>"`. |
| `335` | `id="ap_<?= $ap['id_aprendiz'] ?>"` | Instrucción de ejecución en el contexto del script: `id="ap_<?= $ap['id_aprendiz'] ?>"`. |
| `336` | `<?= $ocupado ? 'disabled' : '' ?>>` | Instrucción de ejecución en el contexto del script: `<?= $ocupado ? 'disabled' : '' ?>>`. |
| `337` | `<label class="form-check-label small <?= $ocupado ? 'text-muted' : '' ?>"` | Instrucción de ejecución en el contexto del script: `<label class="form-check-label small <?= $ocupado ? 'text-muted' : '' ?>"`. |
| `338` | `for="ap_<?= $ap['id_aprendiz'] ?>">` | Instrucción de ejecución en el contexto del script: `for="ap_<?= $ap['id_aprendiz'] ?>">`. |
| `339` | `<?= htmlspecialchars($ap['apellidos'] . ', ' . $ap['nombres']) ?>` | Instrucción de ejecución en el contexto del script: `<?= htmlspecialchars($ap['apellidos'] . ', ' . $ap['nombres']) ?>`. |
| `340` | `<?php if ($ap['documento']): ?>` | Instrucción de ejecución en el contexto del script: `<?php if ($ap['documento']): ?>`. |
| `341` | `<span class="text-muted"> — <?= htmlspecialchars($ap['documento']) ?></s...` | Instrucción de ejecución en el contexto del script: `<span class="text-muted"> — <?= htmlspecialchars($ap['documento']) ?></s...`. |
| `342` | `<?php endif; ?>` | Cierre de estructura condicional embebida en la plantilla HTML. |
| `343` | `<?php if ($ocupado): ?>` | Instrucción de ejecución en el contexto del script: `<?php if ($ocupado): ?>`. |
| `344` | `<span class="badge bg-secondary ms-1" style="font-size:.6rem;">En otro g...` | Instrucción de ejecución en el contexto del script: `<span class="badge bg-secondary ms-1" style="font-size:.6rem;">En otro g...`. |
| `345` | `<?php endif; ?>` | Cierre de estructura condicional embebida en la plantilla HTML. |
| `346` | `</label>` | Instrucción de ejecución en el contexto del script: `</label>`. |
| `347` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `348` | `<?php endforeach; ?>` | Cierre de ciclo iterativo foreach embebido en la plantilla HTML. |
| `349` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `350` | `<?php endif; ?>` | Cierre de estructura condicional embebida en la plantilla HTML. |
| `351` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `352` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `353` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `354` | `<div class="modal-footer px-4">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="modal-footer px-4">`. |
| `355` | `<button type="button" class="btn btn-sm btn-outline-secondary"` | Botón de acción interactivo para el usuario: `<button type="button" class="btn btn-sm btn-outline-secondary"`. |
| `356` | `data-bs-dismiss="modal">Cancelar</button>` | Instrucción de ejecución en el contexto del script: `data-bs-dismiss="modal">Cancelar</button>`. |
| `357` | `<button type="submit" class="btn btn-sm btn-success fw-semibold px-4"` | Botón de acción interactivo para el usuario: `<button type="submit" class="btn btn-sm btn-success fw-semibold px-4"`. |
| `358` | `<?= (!$asignacion \|\| !$proximaFecha) ? 'disabled' : '' ?>>` | Instrucción de ejecución en el contexto del script: `<?= (!$asignacion \|\| !$proximaFecha) ? 'disabled' : '' ?>>`. |
| `359` | `<i class="fas fa-save me-1"></i>Guardar Grupo` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-save me-1"></i>Guardar Grupo`. |
| `360` | `</button>` | Instrucción de ejecución en el contexto del script: `</button>`. |
| `361` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `362` | ``</form>`` | Cierre de formulario interactivo. |
| `363` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `364` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `365` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `366` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `367` | `<!-- ══ Modal Integrantes (AJAX) ══ -->` | Instrucción de ejecución en el contexto del script: `<!-- ══ Modal Integrantes (AJAX) ══ -->`. |
| `368` | `<div class="modal fade" id="modalIntegrantes" tabindex="-1" aria-hidden=...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="modal fade" id="modalIntegrantes" tabindex="-1" aria-hidden=...`. |
| `369` | `<div class="modal-dialog modal-dialog-centered">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="modal-dialog modal-dialog-centered">`. |
| `370` | `<div class="modal-content shadow border-0">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="modal-content shadow border-0">`. |
| `371` | `<div class="modal-header" style="background:#0f2200;color:#fff;">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="modal-header" style="background:#0f2200;color:#fff;">`. |
| `372` | `<h6 class="modal-title fw-bold" id="titModalInt">` | Instrucción de ejecución en el contexto del script: `<h6 class="modal-title fw-bold" id="titModalInt">`. |
| `373` | `<i class="fas fa-users me-2 text-success"></i>Integrantes` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-users me-2 text-success"></i>Integrantes`. |
| `374` | `</h6>` | Instrucción de ejecución en el contexto del script: `</h6>`. |
| `375` | `<button type="button" class="btn-close btn-close-white" data-bs-dismiss=...` | Botón de acción interactivo para el usuario: `<button type="button" class="btn-close btn-close-white" data-bs-dismiss=...`. |
| `376` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `377` | `<div class="modal-body p-0" id="cuerpoModalInt">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="modal-body p-0" id="cuerpoModalInt">`. |
| `378` | `<div class="text-center py-4 text-muted small">Cargando…</div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="text-center py-4 text-muted small">Cargando…</div>`. |
| `379` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `380` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `381` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `382` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `383` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `384` | `<?php if ($alert): ?>` | Instrucción de ejecución en el contexto del script: `<?php if ($alert): ?>`. |
| `385` | ``<script>`` | Bloque o etiqueta de vinculación para scripts JavaScript del lado del cliente. |
| `386` | `document.addEventListener('DOMContentLoaded', function() {` | Registra un escucha de eventos del DOM para interactividad en tiempo real: `document.addEventListener('DOMContentLoaded', function() {`. |
| `387` | `Swal.fire({ icon:'<?= addslashes($alert['icon']) ?>', title:'<?= addslas...` | Despliega una alerta modal estética e interactiva con SweetAlert2. |
| `388` | `});` | Instrucción de ejecución en el contexto del script: `});`. |
| `389` | ``</script>`` | Cierre de bloque de script JavaScript. |
| `390` | `<?php endif; ?>` | Cierre de estructura condicional embebida en la plantilla HTML. |
| `391` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `392` | ``<script>`` | Bloque o etiqueta de vinculación para scripts JavaScript del lado del cliente. |
| `393` | `// Datos de integrantes ya cargados en PHP` | Comentario explicativo en el código: `Datos de integrantes ya cargados en PHP`. |
| `394` | `const integrantesPorGrupo = <?= json_encode($integrantesPorGrupo) ?>;` | Instrucción de ejecución en el contexto del script: `const integrantesPorGrupo = <?= json_encode($integrantesPorGrupo) ?>;`. |
| `395` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `396` | `function verIntegrantes(idGrupo, nombreGrupo) {` | Instrucción de ejecución en el contexto del script: `function verIntegrantes(idGrupo, nombreGrupo) {`. |
| `397` | `document.getElementById('titModalInt').innerHTML =` | Instrucción de ejecución en el contexto del script: `document.getElementById('titModalInt').innerHTML =`. |
| `398` | `'<i class="fas fa-users me-2 text-success"></i>' + nombreGrupo;` | Instrucción de ejecución en el contexto del script: `'<i class="fas fa-users me-2 text-success"></i>' + nombreGrupo;`. |
| `399` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `400` | `const lista = integrantesPorGrupo[idGrupo] \|\| [];` | Instrucción de ejecución en el contexto del script: `const lista = integrantesPorGrupo[idGrupo] \|\| [];`. |
| `401` | `let html = '';` | Instrucción de ejecución en el contexto del script: `let html = '';`. |
| `402` | `if (lista.length === 0) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (lista.length === 0) {`. |
| `403` | `html = '<div class="text-center py-4 text-muted small">Sin integrantes r...` | Instrucción de ejecución en el contexto del script: `html = '<div class="text-center py-4 text-muted small">Sin integrantes r...`. |
| `404` | `} else {` | Instrucción de ejecución en el contexto del script: `} else {`. |
| `405` | `html = '<table class="table mb-0" style="font-size:.82rem;">';` | Instrucción de ejecución en el contexto del script: `html = '<table class="table mb-0" style="font-size:.82rem;">';`. |
| `406` | `html += '<thead><tr style="background:#f9fafb;">';` | Instrucción de ejecución en el contexto del script: `html += '<thead><tr style="background:#f9fafb;">';`. |
| `407` | `html += '<th style="padding:.45rem 1rem;color:#6b7280;font-size:.7rem;">...` | Instrucción de ejecución en el contexto del script: `html += '<th style="padding:.45rem 1rem;color:#6b7280;font-size:.7rem;">...`. |
| `408` | `html += '<th style="padding:.45rem .75rem;color:#6b7280;font-size:.7rem;...` | Instrucción de ejecución en el contexto del script: `html += '<th style="padding:.45rem .75rem;color:#6b7280;font-size:.7rem;...`. |
| `409` | `html += '<th style="padding:.45rem .75rem;color:#6b7280;font-size:.7rem;...` | Instrucción de ejecución en el contexto del script: `html += '<th style="padding:.45rem .75rem;color:#6b7280;font-size:.7rem;...`. |
| `410` | `html += '<th style="padding:.45rem .75rem;color:#6b7280;font-size:.7rem;...` | Instrucción de ejecución en el contexto del script: `html += '<th style="padding:.45rem .75rem;color:#6b7280;font-size:.7rem;...`. |
| `411` | `html += '</tr></thead><tbody>';` | Instrucción de ejecución en el contexto del script: `html += '</tr></thead><tbody>';`. |
| `412` | `lista.forEach((ap, i) => {` | Instrucción de ejecución en el contexto del script: `lista.forEach((ap, i) => {`. |
| `413` | `html += `<tr style="border-bottom:1px solid #f3f4f6;">` | Instrucción de ejecución en el contexto del script: `html += `<tr style="border-bottom:1px solid #f3f4f6;">`. |
| `414` | `<td style="padding:.5rem 1rem;color:#9ca3af;">${i+1}</td>` | Celda de contenido de tabla: `<td style="padding:.5rem 1rem;color:#9ca3af;">${i+1}</td>`. |
| `415` | `<td style="padding:.5rem .75rem;font-weight:600;">${ap.apellidos}</td>` | Celda de contenido de tabla: `<td style="padding:.5rem .75rem;font-weight:600;">${ap.apellidos}</td>`. |
| `416` | `<td style="padding:.5rem .75rem;">${ap.nombres}</td>` | Celda de contenido de tabla: `<td style="padding:.5rem .75rem;">${ap.nombres}</td>`. |
| `417` | `<td style="padding:.5rem .75rem;color:#6b7280;">${ap.documento \|\| '—'}...` | Celda de contenido de tabla: `<td style="padding:.5rem .75rem;color:#6b7280;">${ap.documento \|\| '—'}...`. |
| `418` | `</tr>`;` | Instrucción de ejecución en el contexto del script: `</tr>`;`. |
| `419` | `});` | Instrucción de ejecución en el contexto del script: `});`. |
| `420` | `html += '</tbody></table>';` | Instrucción de ejecución en el contexto del script: `html += '</tbody></table>';`. |
| `421` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `422` | `document.getElementById('cuerpoModalInt').innerHTML = html;` | Instrucción de ejecución en el contexto del script: `document.getElementById('cuerpoModalInt').innerHTML = html;`. |
| `423` | `new bootstrap.Modal(document.getElementById('modalIntegrantes')).show();` | Instrucción de ejecución en el contexto del script: `new bootstrap.Modal(document.getElementById('modalIntegrantes')).show();`. |
| `424` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `425` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `426` | `function abrirEdicion(g) {` | Instrucción de ejecución en el contexto del script: `function abrirEdicion(g) {`. |
| `427` | `document.getElementById('titModalGrupo').innerHTML =` | Instrucción de ejecución en el contexto del script: `document.getElementById('titModalGrupo').innerHTML =`. |
| `428` | `'<i class="fas fa-pen me-2 text-success"></i>Editar Integrantes — ' + g....` | Instrucción de ejecución en el contexto del script: `'<i class="fas fa-pen me-2 text-success"></i>Editar Integrantes — ' + g....`. |
| `429` | `document.getElementById('accionGrupo').value = 'editar_grupo';` | Instrucción de ejecución en el contexto del script: `document.getElementById('accionGrupo').value = 'editar_grupo';`. |
| `430` | `document.getElementById('id_grupo').value    = g.id_grupo;` | Instrucción de ejecución en el contexto del script: `document.getElementById('id_grupo').value    = g.id_grupo;`. |
| `431` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `432` | `// Para edición: desmarcar todos primero, luego marcar los del grupo` | Comentario explicativo en el código: `Para edición: desmarcar todos primero, luego marcar los del grupo`. |
| `433` | `document.querySelectorAll('#formGrupo input[type=checkbox]').forEach(cb ...` | Instrucción de ejecución en el contexto del script: `document.querySelectorAll('#formGrupo input[type=checkbox]').forEach(cb ...`. |
| `434` | `if (!cb.disabled) cb.checked = false;` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (!cb.disabled) cb.checked = false;`. |
| `435` | `});` | Instrucción de ejecución en el contexto del script: `});`. |
| `436` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `437` | `// Marcar los integrantes actuales del grupo (que no estén disabled)` | Comentario explicativo en el código: `Marcar los integrantes actuales del grupo (que no estén disabled)`. |
| `438` | `const actuales = (integrantesPorGrupo[g.id_grupo] \|\| []);` | Instrucción de ejecución en el contexto del script: `const actuales = (integrantesPorGrupo[g.id_grupo] \|\| []);`. |
| `439` | `// No tenemos id_aprendiz aquí — hacemos fetch o los pasamos via data` | Comentario explicativo en el código: `No tenemos id_aprendiz aquí — hacemos fetch o los pasamos via data`. |
| `440` | `// Como los integrantes en el modal ya están en el DOM, usamos los checkbox` | Comentario explicativo en el código: `Como los integrantes en el modal ya están en el DOM, usamos los checkbox`. |
| `441` | `// que coincidan con los del grupo. Necesitamos los IDs.` | Comentario explicativo en el código: `que coincidan con los del grupo. Necesitamos los IDs.`. |
| `442` | `// Los pasamos via data-attr en el botón editar (ver PHP arriba no los t...` | Comentario explicativo en el código: `Los pasamos via data-attr en el botón editar (ver PHP arriba no los tiene).`. |
| `443` | `// Solución: recargar la página no es viable, así que los buscamos en el...` | Comentario explicativo en el código: `Solución: recargar la página no es viable, así que los buscamos en el JSON.`. |
| `444` | `// Pero integrantesPorGrupo no tiene id_aprendiz. Recargamos con fetch:` | Comentario explicativo en el código: `Pero integrantesPorGrupo no tiene id_aprendiz. Recargamos con fetch:`. |
| `445` | `fetch(`../../controllers/VoceroController.php?accion=get_integrantes_ids...` | Petición asíncrona AJAX vía fetch API hacia el backend para cargar datos dinámicos. |
| `446` | `.then(r => r.json())` | Instrucción de ejecución en el contexto del script: `.then(r => r.json())`. |
| `447` | `.then(ids => {` | Instrucción de ejecución en el contexto del script: `.then(ids => {`. |
| `448` | `ids.forEach(id => {` | Instrucción de ejecución en el contexto del script: `ids.forEach(id => {`. |
| `449` | `const cb = document.getElementById('ap_' + id);` | Instrucción de ejecución en el contexto del script: `const cb = document.getElementById('ap_' + id);`. |
| `450` | `if (cb && !cb.disabled) cb.checked = true;` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (cb && !cb.disabled) cb.checked = true;`. |
| `451` | `});` | Instrucción de ejecución en el contexto del script: `});`. |
| `452` | `});` | Instrucción de ejecución en el contexto del script: `});`. |
| `453` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `454` | `new bootstrap.Modal(document.getElementById('modalGrupo')).show();` | Instrucción de ejecución en el contexto del script: `new bootstrap.Modal(document.getElementById('modalGrupo')).show();`. |
| `455` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `456` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `457` | `document.getElementById('modalGrupo').addEventListener('hidden.bs.modal'...` | Registra un escucha de eventos del DOM para interactividad en tiempo real: `document.getElementById('modalGrupo').addEventListener('hidden.bs.modal'...`. |
| `458` | `document.getElementById('titModalGrupo').innerHTML =` | Instrucción de ejecución en el contexto del script: `document.getElementById('titModalGrupo').innerHTML =`. |
| `459` | `'<i class="fas fa-people-group me-2 text-success"></i>Nuevo Grupo de Lim...` | Instrucción de ejecución en el contexto del script: `'<i class="fas fa-people-group me-2 text-success"></i>Nuevo Grupo de Lim...`. |
| `460` | `document.getElementById('accionGrupo').value = 'guardar_grupo';` | Instrucción de ejecución en el contexto del script: `document.getElementById('accionGrupo').value = 'guardar_grupo';`. |
| `461` | `document.getElementById('id_grupo').value    = '';` | Instrucción de ejecución en el contexto del script: `document.getElementById('id_grupo').value    = '';`. |
| `462` | `document.querySelectorAll('#formGrupo input[type=checkbox]').forEach(cb ...` | Instrucción de ejecución en el contexto del script: `document.querySelectorAll('#formGrupo input[type=checkbox]').forEach(cb ...`. |
| `463` | `if (!cb.disabled) cb.checked = false;` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (!cb.disabled) cb.checked = false;`. |
| `464` | `});` | Instrucción de ejecución en el contexto del script: `});`. |
| `465` | `});` | Instrucción de ejecución en el contexto del script: `});`. |
| `466` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `467` | `function confirmarEliminar(idGrupo, nombre) {` | Instrucción de ejecución en el contexto del script: `function confirmarEliminar(idGrupo, nombre) {`. |
| `468` | `Swal.fire({` | Despliega una alerta modal estética e interactiva con SweetAlert2. |
| `469` | `title: '¿Eliminar grupo?',` | Instrucción de ejecución en el contexto del script: `title: '¿Eliminar grupo?',`. |
| `470` | `text:  'Se eliminará el grupo "' + nombre + '" y sus integrantes.',` | Instrucción de ejecución en el contexto del script: `text:  'Se eliminará el grupo "' + nombre + '" y sus integrantes.',`. |
| `471` | `icon:  'warning',` | Instrucción de ejecución en el contexto del script: `icon:  'warning',`. |
| `472` | `showCancelButton:   true,` | Instrucción de ejecución en el contexto del script: `showCancelButton:   true,`. |
| `473` | `confirmButtonText:  'Sí, eliminar',` | Instrucción de ejecución en el contexto del script: `confirmButtonText:  'Sí, eliminar',`. |
| `474` | `cancelButtonText:   'Cancelar',` | Instrucción de ejecución en el contexto del script: `cancelButtonText:   'Cancelar',`. |
| `475` | `confirmButtonColor: '#ef4444',` | Instrucción de ejecución en el contexto del script: `confirmButtonColor: '#ef4444',`. |
| `476` | `cancelButtonColor:  '#6b7280',` | Instrucción de ejecución en el contexto del script: `cancelButtonColor:  '#6b7280',`. |
| `477` | `}).then(r => {` | Instrucción de ejecución en el contexto del script: `}).then(r => {`. |
| `478` | `if (r.isConfirmed) document.getElementById('form-del-' + idGrupo).submit();` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (r.isConfirmed) document.getElementById('form-del-' + idGrupo).submit();`. |
| `479` | `});` | Instrucción de ejecución en el contexto del script: `});`. |
| `480` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `481` | ``</script>`` | Cierre de bloque de script JavaScript. |
| `482` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `483` | `<?php require_once __DIR__ . '/../layouts/footer.php'; ?>` | Importación e inclusión obligatoria del archivo de dependencia requerido: `<?php require_once __DIR__ . '/../layouts/footer.php'; ?>`. |

---

## 3. Resumen y Flujo de Interacción

El archivo `vocero_grupos.php` cumple un rol indispensable en `views/dashboard/vocero_grupos.php`. 
Módulo donde el vocero organiza, crea y edita los grupos de aprendices para la rotación de limpieza. Garantiza la robustez, el orden y la estabilidad de la arquitectura del proyecto `systemLimpieza`.

---

Generado automáticamente para el repositorio [johanrepizo/LimpiezaDeModulos](https://github.com/johanrepizo/LimpiezaDeModulos).
