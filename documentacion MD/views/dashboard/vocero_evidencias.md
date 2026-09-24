# Documentación Línea por Línea: `views/dashboard/vocero_evidencias.php`

## 1. Ficha Técnica del Archivo

- **Archivo:** `vocero_evidencias.php`
- **Ruta en el proyecto:** `views/dashboard/vocero_evidencias.php`
- **Cantidad total de líneas:** `485`
- **Tipo de archivo:** `PHP`
- **Propósito general:** Listado histórico de evidencias de limpieza subidas por el vocero con su respectivo estado.

---

## 2. Explicación Detallada Línea por Línea

A continuación se presenta cada línea de código numerada de forma consecutiva, acompañada de su fragmento exacto y la explicación exhaustiva de su funcionamiento y responsabilidad en el sistema:

| Línea | Código Fuente | Explicación Detallada |
|---|---|---|
| `1` | `<?php` | Apertura obligatoria de la etiqueta PHP para ejecución del código del lado del servidor. |
| `2` | `$titulo = 'Mis Evidencias';` | Instrucción de ejecución en el contexto del script: `$titulo = 'Mis Evidencias';`. |
| `3` | `if (session_status() === PHP_SESSION_NONE) session_start();` | Inicia o reanuda la sesión PHP del usuario si no se encontraba activa previamente. |
| `4` | `if (!isset($_SESSION['usuario']) \|\| (int)$_SESSION['usuario']['rol'] !== ...` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (!isset($_SESSION['usuario']) \|\| (int)$_SESSION['usuario']['rol'] !== 2) {`. |
| `5` | `    header("Location: ../usuarios/login.php"); exit;` | Emite cabecera HTTP de redirección en el navegador: `header("Location: ../usuarios/login.php"); exit;`. |
| `6` | `}` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `7` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `8` | `require_once __DIR__ . '/../../config/database.php';` | Importación e inclusión obligatoria del archivo de dependencia requerido: `require_once __DIR__ . '/../../config/database.php';`. |
| `9` | `require_once __DIR__ . '/../../models/Evidencia.php';` | Importación e inclusión obligatoria del archivo de dependencia requerido: `require_once __DIR__ . '/../../models/Evidencia.php';`. |
| `10` | `require_once __DIR__ . '/../../models/Grupo.php';` | Importación e inclusión obligatoria del archivo de dependencia requerido: `require_once __DIR__ . '/../../models/Grupo.php';`. |
| `11` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `12` | `$db    = (new Database())->conectar();` | Instrucción de ejecución en el contexto del script: `$db    = (new Database())->conectar();`. |
| `13` | `$alert = $_SESSION['alert'] ?? null;` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección: `$alert = $_SESSION['alert'] ?? null;`. |
| `14` | `unset($_SESSION['alert']);` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección: `unset($_SESSION['alert']);`. |
| `15` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `16` | `$idUsuario = (int)$_SESSION['usuario']['id_usuario'];` | Accede o almacena información de identidad del usuario en la sesión activa: `$idUsuario = (int)$_SESSION['usuario']['id_usuario'];`. |
| `17` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `18` | `// Datos del vocero` | Comentario de línea explicativo: `Datos del vocero`. |
| `19` | `$stmtV = $db->prepare("SELECT * FROM voceros WHERE id_usuario = :id AND act...` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmtV = $db->prepare("SELECT * FROM voceros WHERE id_usuario = :id AND activo = 1 LIMIT 1");`. |
| `20` | `$stmtV->execute([':id' => $idUsuario]);` | Ejecuta la sentencia SQL preparada vinculando los datos correspondientes: `$stmtV->execute([':id' => $idUsuario]);`. |
| `21` | `$vocero   = $stmtV->fetch(PDO::FETCH_ASSOC);` | Recupera una única fila o registro resultante de la consulta. |
| `22` | `$idVocero = $vocero ? (int)$vocero['id_vocero'] : 0;` | Instrucción de ejecución en el contexto del script: `$idVocero = $vocero ? (int)$vocero['id_vocero'] : 0;`. |
| `23` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `24` | `// Asignaciones de la ficha (para el selector de módulo)` | Comentario de línea explicativo: `Asignaciones de la ficha (para el selector de módulo)`. |
| `25` | `$stmtAsig = $db->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmtAsig = $db->prepare(`. |
| `26` | `    "SELECT a.id_asignacion, m.id_modulo, m.nombre AS nombre_modulo,` | Instrucción de ejecución en el contexto del script: `"SELECT a.id_asignacion, m.id_modulo, m.nombre AS nombre_modulo,`. |
| `27` | `            a.fecha_inicio, a.fecha_fin, a.fecha_limite_evidencia, a.estado` | Instrucción de ejecución en el contexto del script: `a.fecha_inicio, a.fecha_fin, a.fecha_limite_evidencia, a.estado`. |
| `28` | `     FROM asignaciones a` | Instrucción de ejecución en el contexto del script: `FROM asignaciones a`. |
| `29` | `     JOIN modulos m ON m.id_modulo = a.id_modulo` | Instrucción de ejecución en el contexto del script: `JOIN modulos m ON m.id_modulo = a.id_modulo`. |
| `30` | `     WHERE a.id_ficha = :fic` | Instrucción de ejecución en el contexto del script: `WHERE a.id_ficha = :fic`. |
| `31` | `     ORDER BY a.estado DESC, a.fecha_limite_evidencia DESC"` | Instrucción de ejecución en el contexto del script: `ORDER BY a.estado DESC, a.fecha_limite_evidencia DESC"`. |
| `32` | `);` | Instrucción de ejecución en el contexto del script: `);`. |
| `33` | `$stmtAsig->execute([':fic' => $vocero['id_ficha'] ?? 0]);` | Ejecuta la sentencia SQL preparada vinculando los datos correspondientes: `$stmtAsig->execute([':fic' => $vocero['id_ficha'] ?? 0]);`. |
| `34` | `$asignaciones = $stmtAsig->fetchAll(PDO::FETCH_ASSOC);` | Obtiene todos los registros coincidentes de la consulta en un arreglo asociativo. |
| `35` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `36` | `// Filtro por asignación seleccionada` | Comentario de línea explicativo: `Filtro por asignación seleccionada`. |
| `37` | `$filtroAsig = (int)($_GET['asig'] ?? 0);` | Captura y sanitiza parámetros enviados por el cliente mediante petición HTTP: `$filtroAsig = (int)($_GET['asig'] ?? 0);`. |
| `38` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `39` | `// Grupos del vocero con conteo de evidencias` | Comentario de línea explicativo: `Grupos del vocero con conteo de evidencias`. |
| `40` | `$sqlGrupos = "SELECT g.id_grupo, g.nombre_grupo, g.fecha_limpieza, g.estado,` | Instrucción de ejecución en el contexto del script: `$sqlGrupos = "SELECT g.id_grupo, g.nombre_grupo, g.fecha_limpieza, g.estado,`. |
| `41` | `                     a.id_asignacion, a.fecha_limite_evidencia,` | Instrucción de ejecución en el contexto del script: `a.id_asignacion, a.fecha_limite_evidencia,`. |
| `42` | `                     m.nombre AS nombre_modulo,` | Instrucción de ejecución en el contexto del script: `m.nombre AS nombre_modulo,`. |
| `43` | `                     (SELECT COUNT(*) FROM evidencias e WHERE e.id_grupo = ...` | Instrucción de ejecución en el contexto del script: `(SELECT COUNT(*) FROM evidencias e WHERE e.id_grupo = g.id_grupo) AS tiene_evidencia`. |
| `44` | `              FROM grupos g` | Instrucción de ejecución en el contexto del script: `FROM grupos g`. |
| `45` | `              JOIN asignaciones a ON a.id_asignacion = g.id_asignacion` | Instrucción de ejecución en el contexto del script: `JOIN asignaciones a ON a.id_asignacion = g.id_asignacion`. |
| `46` | `              JOIN modulos m ON m.id_modulo = a.id_modulo` | Instrucción de ejecución en el contexto del script: `JOIN modulos m ON m.id_modulo = a.id_modulo`. |
| `47` | `              WHERE g.id_vocero = :idv";` | Instrucción de ejecución en el contexto del script: `WHERE g.id_vocero = :idv";`. |
| `48` | `if ($filtroAsig) $sqlGrupos .= " AND a.id_asignacion = :asig";` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if ($filtroAsig) $sqlGrupos .= " AND a.id_asignacion = :asig";`. |
| `49` | `$sqlGrupos .= " ORDER BY a.fecha_limite_evidencia DESC, g.fecha_limpieza DE...` | Instrucción de ejecución en el contexto del script: `$sqlGrupos .= " ORDER BY a.fecha_limite_evidencia DESC, g.fecha_limpieza DESC";`. |
| `50` | `$stmtGrupos = $db->prepare($sqlGrupos);` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmtGrupos = $db->prepare($sqlGrupos);`. |
| `51` | `$paramsGrupos = [':idv' => $idVocero];` | Instrucción de ejecución en el contexto del script: `$paramsGrupos = [':idv' => $idVocero];`. |
| `52` | `if ($filtroAsig) $paramsGrupos[':asig'] = $filtroAsig;` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if ($filtroAsig) $paramsGrupos[':asig'] = $filtroAsig;`. |
| `53` | `$stmtGrupos->execute($paramsGrupos);` | Ejecuta la sentencia SQL preparada vinculando los datos correspondientes: `$stmtGrupos->execute($paramsGrupos);`. |
| `54` | `$grupos = $stmtGrupos->fetchAll(PDO::FETCH_ASSOC);` | Obtiene todos los registros coincidentes de la consulta en un arreglo asociativo. |
| `55` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `56` | `// Historial de evidencias del vocero (con filtro opcional)` | Comentario de línea explicativo: `Historial de evidencias del vocero (con filtro opcional)`. |
| `57` | `$evidencias = (new Evidencia($db))->obtenerPorVocero($idVocero, $filtroAsig...` | Instrucción de ejecución en el contexto del script: `$evidencias = (new Evidencia($db))->obtenerPorVocero($idVocero, $filtroAsig ?: null);`. |
| `58` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `59` | `// Totales` | Comentario de línea explicativo: `Totales`. |
| `60` | `$totalEv       = count($evidencias);` | Instrucción de ejecución en el contexto del script: `$totalEv       = count($evidencias);`. |
| `61` | `$totalPendientes = count(array_filter($grupos, fn($g) => (int)$g['tiene_evi...` | Instrucción de ejecución en el contexto del script: `$totalPendientes = count(array_filter($grupos, fn($g) => (int)$g['tiene_evidencia'] === 0));`. |
| `62` | `$totalVencidos   = count(array_filter($grupos, fn($g) =>` | Instrucción de ejecución en el contexto del script: `$totalVencidos   = count(array_filter($grupos, fn($g) =>`. |
| `63` | `    (int)$g['tiene_evidencia'] === 0 && strtotime($g['fecha_limite_evidenci...` | Instrucción de ejecución en el contexto del script: `(int)$g['tiene_evidencia'] === 0 && strtotime($g['fecha_limite_evidencia']) < time()));`. |
| `64` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `65` | `require_once __DIR__ . '/../layouts/header.php';` | Importación e inclusión obligatoria del archivo de dependencia requerido: `require_once __DIR__ . '/../layouts/header.php';`. |
| `66` | `?>` | Cierre de la etiqueta PHP para alternar a salida HTML o fin del archivo. |
| `67` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `68` | `<!-- ══ CABECERA ══════════════════════════════════════════════════════════...` | Instrucción de ejecución en el contexto del script: `<!-- ══ CABECERA ══════════════════════════════════════════════════════════════ -->`. |
| `69` | `<div class="d-flex justify-content-between align-items-start mb-4 flex-wrap...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="d-flex justify-content-between align-items-start mb-4 flex-wrap gap-3">`. |
| `70` | `    <div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div>`. |
| `71` | `        <h4 class="fw-bold mb-1">` | Instrucción de ejecución en el contexto del script: `<h4 class="fw-bold mb-1">`. |
| `72` | `            <i class="fas fa-images text-success me-2"></i>Mis Evidencias d...` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-images text-success me-2"></i>Mis Evidencias de Módulos`. |
| `73` | `        </h4>` | Instrucción de ejecución en el contexto del script: `</h4>`. |
| `74` | `        <p class="text-muted small mb-0">` | Instrucción de ejecución en el contexto del script: `<p class="text-muted small mb-0">`. |
| `75` | `            Registra las fotografías que demuestran la limpieza realizada e...` | Instrucción de ejecución en el contexto del script: `Registra las fotografías que demuestran la limpieza realizada en cada módulo asignado.`. |
| `76` | `        </p>` | Instrucción de ejecución en el contexto del script: `</p>`. |
| `77` | `    </div>` | Cierre de contenedor visual `<div>`. |
| `78` | `</div>` | Cierre de contenedor visual `<div>`. |
| `79` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `80` | `<!-- ══ STATS ═════════════════════════════════════════════════════════════...` | Instrucción de ejecución en el contexto del script: `<!-- ══ STATS ═════════════════════════════════════════════════════════════════ -->`. |
| `81` | `<div class="row g-3 mb-4">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="row g-3 mb-4">`. |
| `82` | `    <div class="col-sm-4">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="col-sm-4">`. |
| `83` | `        <div class="stat-card bg-white">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="stat-card bg-white">`. |
| `84` | `            <div class="d-flex align-items-center gap-3">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="d-flex align-items-center gap-3">`. |
| `85` | `                <div class="stat-icon" style="background:rgba(57,169,0,.12)...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="stat-icon" style="background:rgba(57,169,0,.12); color:#39a900;">`. |
| `86` | `                    <i class="fas fa-check-circle"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-check-circle"></i>`. |
| `87` | `                </div>` | Cierre de contenedor visual `<div>`. |
| `88` | `                <div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div>`. |
| `89` | `                    <div class="fs-4 fw-bold"><?= $totalEv ?></div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="fs-4 fw-bold"><?= $totalEv ?></div>`. |
| `90` | `                    <div class="text-muted small">Evidencias enviadas</div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="text-muted small">Evidencias enviadas</div>`. |
| `91` | `                </div>` | Cierre de contenedor visual `<div>`. |
| `92` | `            </div>` | Cierre de contenedor visual `<div>`. |
| `93` | `        </div>` | Cierre de contenedor visual `<div>`. |
| `94` | `    </div>` | Cierre de contenedor visual `<div>`. |
| `95` | `    <div class="col-sm-4">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="col-sm-4">`. |
| `96` | `        <div class="stat-card bg-white">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="stat-card bg-white">`. |
| `97` | `            <div class="d-flex align-items-center gap-3">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="d-flex align-items-center gap-3">`. |
| `98` | `                <div class="stat-icon" style="background:rgba(234,179,8,.1)...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="stat-icon" style="background:rgba(234,179,8,.1); color:#d97706;">`. |
| `99` | `                    <i class="fas fa-clock"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-clock"></i>`. |
| `100` | `                </div>` | Cierre de contenedor visual `<div>`. |
| `101` | `                <div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div>`. |
| `102` | `                    <div class="fs-4 fw-bold"><?= $totalPendientes ?></div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="fs-4 fw-bold"><?= $totalPendientes ?></div>`. |
| `103` | `                    <div class="text-muted small">Grupos sin evidencia</div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="text-muted small">Grupos sin evidencia</div>`. |
| `104` | `                </div>` | Cierre de contenedor visual `<div>`. |
| `105` | `            </div>` | Cierre de contenedor visual `<div>`. |
| `106` | `        </div>` | Cierre de contenedor visual `<div>`. |
| `107` | `    </div>` | Cierre de contenedor visual `<div>`. |
| `108` | `    <div class="col-sm-4">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="col-sm-4">`. |
| `109` | `        <div class="stat-card bg-white">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="stat-card bg-white">`. |
| `110` | `            <div class="d-flex align-items-center gap-3">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="d-flex align-items-center gap-3">`. |
| `111` | `                <div class="stat-icon" style="background:rgba(239,68,68,.1)...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="stat-icon" style="background:rgba(239,68,68,.1); color:#ef4444;">`. |
| `112` | `                    <i class="fas fa-triangle-exclamation"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-triangle-exclamation"></i>`. |
| `113` | `                </div>` | Cierre de contenedor visual `<div>`. |
| `114` | `                <div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div>`. |
| `115` | `                    <div class="fs-4 fw-bold"><?= $totalVencidos ?></div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="fs-4 fw-bold"><?= $totalVencidos ?></div>`. |
| `116` | `                    <div class="text-muted small">Vencidos sin evidencia</div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="text-muted small">Vencidos sin evidencia</div>`. |
| `117` | `                </div>` | Cierre de contenedor visual `<div>`. |
| `118` | `            </div>` | Cierre de contenedor visual `<div>`. |
| `119` | `        </div>` | Cierre de contenedor visual `<div>`. |
| `120` | `    </div>` | Cierre de contenedor visual `<div>`. |
| `121` | `</div>` | Cierre de contenedor visual `<div>`. |
| `122` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `123` | `<!-- ══ FILTRO POR MÓDULO ═════════════════════════════════════════════════...` | Instrucción de ejecución en el contexto del script: `<!-- ══ FILTRO POR MÓDULO ══════════════════════════════════════════════════════ -->`. |
| `124` | `<div class="card shadow-sm border-0 mb-4">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="card shadow-sm border-0 mb-4">`. |
| `125` | `    <div class="card-body py-2 px-3">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="card-body py-2 px-3">`. |
| `126` | `        <form method="GET" class="d-flex align-items-center gap-3 flex-wrap">` | Formulario para recolección y envío de datos del usuario: `<form method="GET" class="d-flex align-items-center gap-3 flex-wrap">`. |
| `127` | `            <label class="fw-semibold small text-nowrap mb-0">` | Instrucción de ejecución en el contexto del script: `<label class="fw-semibold small text-nowrap mb-0">`. |
| `128` | `                <i class="fas fa-filter text-success me-1"></i>Filtrar módulo:` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-filter text-success me-1"></i>Filtrar módulo:`. |
| `129` | `            </label>` | Instrucción de ejecución en el contexto del script: `</label>`. |
| `130` | `            <select name="asig" class="form-select form-select-sm" style="m...` | Menú desplegable de opciones de selección: `<select name="asig" class="form-select form-select-sm" style="max-width:380px;"`. |
| `131` | `                    onchange="this.form.submit()">` | Instrucción de ejecución en el contexto del script: `onchange="this.form.submit()">`. |
| `132` | `                <option value="">— Todos los módulos —</option>` | Elemento de opción seleccionable dentro de una lista: `<option value="">— Todos los módulos —</option>`. |
| `133` | `                <?php foreach ($asignaciones as $a): ?>` | Instrucción de ejecución en el contexto del script: `<?php foreach ($asignaciones as $a): ?>`. |
| `134` | `                <option value="<?= $a['id_asignacion'] ?>"` | Elemento de opción seleccionable dentro de una lista: `<option value="<?= $a['id_asignacion'] ?>"`. |
| `135` | `                    <?= $filtroAsig === (int)$a['id_asignacion'] ? 'selecte...` | Instrucción de ejecución en el contexto del script: `<?= $filtroAsig === (int)$a['id_asignacion'] ? 'selected' : '' ?>>`. |
| `136` | `                    <?= htmlspecialchars($a['nombre_modulo']) ?>` | Instrucción de ejecución en el contexto del script: `<?= htmlspecialchars($a['nombre_modulo']) ?>`. |
| `137` | `                    (<?= htmlspecialchars($a['estado']) ?> · Límite: <?= da...` | Instrucción de ejecución en el contexto del script: `(<?= htmlspecialchars($a['estado']) ?> · Límite: <?= date('d/m/Y', strtotime($a['fecha_limite_evidencia'])) ?>)`. |
| `138` | `                </option>` | Instrucción de ejecución en el contexto del script: `</option>`. |
| `139` | `                <?php endforeach; ?>` | Instrucción de ejecución en el contexto del script: `<?php endforeach; ?>`. |
| `140` | `            </select>` | Menú desplegable de opciones de selección: `</select>`. |
| `141` | `            <?php if ($filtroAsig): ?>` | Instrucción de ejecución en el contexto del script: `<?php if ($filtroAsig): ?>`. |
| `142` | `                <a href="vocero_evidencias.php" class="btn btn-sm btn-outli...` | Enlace hipertexto de navegación o acción: `<a href="vocero_evidencias.php" class="btn btn-sm btn-outline-secondary">`. |
| `143` | `                    <i class="fas fa-xmark me-1"></i>Limpiar` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-xmark me-1"></i>Limpiar`. |
| `144` | `                </a>` | Instrucción de ejecución en el contexto del script: `</a>`. |
| `145` | `            <?php endif; ?>` | Instrucción de ejecución en el contexto del script: `<?php endif; ?>`. |
| `146` | `        </form>` | Cierre de formulario HTML. |
| `147` | `    </div>` | Cierre de contenedor visual `<div>`. |
| `148` | `</div>` | Cierre de contenedor visual `<div>`. |
| `149` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `150` | `<!-- ══ TABLA DE GRUPOS ═══════════════════════════════════════════════════...` | Instrucción de ejecución en el contexto del script: `<!-- ══ TABLA DE GRUPOS ════════════════════════════════════════════════════════ -->`. |
| `151` | `<div class="card shadow-sm mb-4" style="border-left:4px solid #39a900;">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="card shadow-sm mb-4" style="border-left:4px solid #39a900;">`. |
| `152` | `    <div class="card-header bg-white border-0 py-3 d-flex justify-content-b...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="card-header bg-white border-0 py-3 d-flex justify-content-between align-items-center">`. |
| `153` | `        <h6 class="fw-bold mb-0">` | Instrucción de ejecución en el contexto del script: `<h6 class="fw-bold mb-0">`. |
| `154` | `            <i class="fas fa-people-group text-success me-2"></i>Estado de ...` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-people-group text-success me-2"></i>Estado de mis Grupos`. |
| `155` | `        </h6>` | Instrucción de ejecución en el contexto del script: `</h6>`. |
| `156` | `        <span class="badge bg-secondary"><?= count($grupos) ?> grupo(s)</span>` | Instrucción de ejecución en el contexto del script: `<span class="badge bg-secondary"><?= count($grupos) ?> grupo(s)</span>`. |
| `157` | `    </div>` | Cierre de contenedor visual `<div>`. |
| `158` | `    <div class="card-body p-0">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="card-body p-0">`. |
| `159` | `        <?php if (empty($grupos)): ?>` | Instrucción de ejecución en el contexto del script: `<?php if (empty($grupos)): ?>`. |
| `160` | `        <div class="text-center py-5 text-muted">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="text-center py-5 text-muted">`. |
| `161` | `            <i class="fas fa-people-group fa-2x mb-2 opacity-25 d-block"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-people-group fa-2x mb-2 opacity-25 d-block"></i>`. |
| `162` | `            <span class="small">No tienes grupos registrados<?= $filtroAsig...` | Instrucción de ejecución en el contexto del script: `<span class="small">No tienes grupos registrados<?= $filtroAsig ? ' en este módulo' : '' ?>.</span>`. |
| `163` | `        </div>` | Cierre de contenedor visual `<div>`. |
| `164` | `        <?php else: ?>` | Instrucción de ejecución en el contexto del script: `<?php else: ?>`. |
| `165` | `        <div class="table-responsive">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="table-responsive">`. |
| `166` | `            <table class="table tabla-limpia align-middle mb-0">` | Tabla de datos para despliegue estructurado de información: `<table class="table tabla-limpia align-middle mb-0">`. |
| `167` | `                <thead class="table-light">` | Celda de tabla con contenido de datos o encabezado de columna: `<thead class="table-light">`. |
| `168` | `                    <tr>` | Fila contenedora de datos dentro de la tabla. |
| `169` | `                        <th>Módulo</th>` | Celda de tabla con contenido de datos o encabezado de columna: `<th>Módulo</th>`. |
| `170` | `                        <th>Nombre del Grupo</th>` | Celda de tabla con contenido de datos o encabezado de columna: `<th>Nombre del Grupo</th>`. |
| `171` | `                        <th>Fecha Limpieza</th>` | Celda de tabla con contenido de datos o encabezado de columna: `<th>Fecha Limpieza</th>`. |
| `172` | `                        <th>Plazo Evidencia</th>` | Celda de tabla con contenido de datos o encabezado de columna: `<th>Plazo Evidencia</th>`. |
| `173` | `                        <th>Estado</th>` | Celda de tabla con contenido de datos o encabezado de columna: `<th>Estado</th>`. |
| `174` | `                        <th class="text-center">Evidencia</th>` | Celda de tabla con contenido de datos o encabezado de columna: `<th class="text-center">Evidencia</th>`. |
| `175` | `                        <th class="text-center">Acción</th>` | Celda de tabla con contenido de datos o encabezado de columna: `<th class="text-center">Acción</th>`. |
| `176` | `                    </tr>` | Fila contenedora de datos dentro de la tabla. |
| `177` | `                </thead>` | Instrucción de ejecución en el contexto del script: `</thead>`. |
| `178` | `                <tbody>` | Instrucción de ejecución en el contexto del script: `<tbody>`. |
| `179` | `                <?php foreach ($grupos as $g):` | Instrucción de ejecución en el contexto del script: `<?php foreach ($grupos as $g):`. |
| `180` | `                    $vencido  = strtotime($g['fecha_limite_evidencia']) < t...` | Instrucción de ejecución en el contexto del script: `$vencido  = strtotime($g['fecha_limite_evidencia']) < time();`. |
| `181` | `                    $tieneEv  = (int)$g['tiene_evidencia'] > 0;` | Instrucción de ejecución en el contexto del script: `$tieneEv  = (int)$g['tiene_evidencia'] > 0;`. |
| `182` | `                    $diasRest = (int) ceil((strtotime($g['fecha_limite_evid...` | Instrucción de ejecución en el contexto del script: `$diasRest = (int) ceil((strtotime($g['fecha_limite_evidencia']) - time()) / 86400);`. |
| `183` | `                ?>` | Cierre de la etiqueta PHP para alternar a salida HTML o fin del archivo. |
| `184` | `                <tr class="<?= (!$tieneEv && $vencido) ? 'table-danger bg-o...` | Fila contenedora de datos dentro de la tabla. |
| `185` | `                    <td class="small fw-semibold"><?= htmlspecialchars($g['...` | Celda de tabla con contenido de datos o encabezado de columna: `<td class="small fw-semibold"><?= htmlspecialchars($g['nombre_modulo']) ?></td>`. |
| `186` | `                    <td class="small"><?= htmlspecialchars($g['nombre_grupo...` | Celda de tabla con contenido de datos o encabezado de columna: `<td class="small"><?= htmlspecialchars($g['nombre_grupo']) ?></td>`. |
| `187` | `                    <td class="small"><?= date('d/m/Y', strtotime($g['fecha...` | Celda de tabla con contenido de datos o encabezado de columna: `<td class="small"><?= date('d/m/Y', strtotime($g['fecha_limpieza'])) ?></td>`. |
| `188` | `                    <td class="small <?= (!$tieneEv && $vencido) ? 'text-da...` | Celda de tabla con contenido de datos o encabezado de columna: `<td class="small <?= (!$tieneEv && $vencido) ? 'text-danger fw-semibold' : '' ?>">`. |
| `189` | `                        <?= date('d/m/Y H:i', strtotime($g['fecha_limite_ev...` | Instrucción de ejecución en el contexto del script: `<?= date('d/m/Y H:i', strtotime($g['fecha_limite_evidencia'])) ?>`. |
| `190` | `                        <?php if (!$tieneEv && !$vencido && $diasRest <= 2)...` | Instrucción de ejecución en el contexto del script: `<?php if (!$tieneEv && !$vencido && $diasRest <= 2): ?>`. |
| `191` | `                            <span class="badge bg-warning text-dark ms-1" s...` | Instrucción de ejecución en el contexto del script: `<span class="badge bg-warning text-dark ms-1" style="font-size:.65rem;">`. |
| `192` | `                                ¡<?= $diasRest ?>d!` | Instrucción de ejecución en el contexto del script: `¡<?= $diasRest ?>d!`. |
| `193` | `                            </span>` | Instrucción de ejecución en el contexto del script: `</span>`. |
| `194` | `                        <?php endif; ?>` | Instrucción de ejecución en el contexto del script: `<?php endif; ?>`. |
| `195` | `                    </td>` | Celda de tabla con contenido de datos o encabezado de columna: `</td>`. |
| `196` | `                    <td>` | Celda de tabla con contenido de datos o encabezado de columna: `<td>`. |
| `197` | `                        <?php if ($tieneEv): ?>` | Instrucción de ejecución en el contexto del script: `<?php if ($tieneEv): ?>`. |
| `198` | `                            <span class="badge bg-success">` | Instrucción de ejecución en el contexto del script: `<span class="badge bg-success">`. |
| `199` | `                                <i class="fas fa-check me-1"></i>Completado` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-check me-1"></i>Completado`. |
| `200` | `                            </span>` | Instrucción de ejecución en el contexto del script: `</span>`. |
| `201` | `                        <?php elseif ($vencido): ?>` | Instrucción de ejecución en el contexto del script: `<?php elseif ($vencido): ?>`. |
| `202` | `                            <span class="badge bg-danger">` | Instrucción de ejecución en el contexto del script: `<span class="badge bg-danger">`. |
| `203` | `                                <i class="fas fa-xmark me-1"></i>Vencido` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-xmark me-1"></i>Vencido`. |
| `204` | `                            </span>` | Instrucción de ejecución en el contexto del script: `</span>`. |
| `205` | `                        <?php else: ?>` | Instrucción de ejecución en el contexto del script: `<?php else: ?>`. |
| `206` | `                            <span class="badge bg-warning text-dark">` | Instrucción de ejecución en el contexto del script: `<span class="badge bg-warning text-dark">`. |
| `207` | `                                <i class="fas fa-clock me-1"></i>Pendiente` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-clock me-1"></i>Pendiente`. |
| `208` | `                            </span>` | Instrucción de ejecución en el contexto del script: `</span>`. |
| `209` | `                        <?php endif; ?>` | Instrucción de ejecución en el contexto del script: `<?php endif; ?>`. |
| `210` | `                    </td>` | Celda de tabla con contenido de datos o encabezado de columna: `</td>`. |
| `211` | `                    <td class="text-center">` | Celda de tabla con contenido de datos o encabezado de columna: `<td class="text-center">`. |
| `212` | `                        <?php if ($tieneEv): ?>` | Instrucción de ejecución en el contexto del script: `<?php if ($tieneEv): ?>`. |
| `213` | `                            <span class="text-success fs-5 fw-bold" title="...` | Instrucción de ejecución en el contexto del script: `<span class="text-success fs-5 fw-bold" title="Evidencia entregada">✓</span>`. |
| `214` | `                        <?php else: ?>` | Instrucción de ejecución en el contexto del script: `<?php else: ?>`. |
| `215` | `                            <span class="text-muted small">—</span>` | Instrucción de ejecución en el contexto del script: `<span class="text-muted small">—</span>`. |
| `216` | `                        <?php endif; ?>` | Instrucción de ejecución en el contexto del script: `<?php endif; ?>`. |
| `217` | `                    </td>` | Celda de tabla con contenido de datos o encabezado de columna: `</td>`. |
| `218` | `                    <td class="text-center">` | Celda de tabla con contenido de datos o encabezado de columna: `<td class="text-center">`. |
| `219` | `                        <?php if (!$tieneEv && !$vencido): ?>` | Instrucción de ejecución en el contexto del script: `<?php if (!$tieneEv && !$vencido): ?>`. |
| `220` | `                            <button class="btn btn-sm btn-success fw-semibold"` | Botón de acción interactivo para el usuario: `<button class="btn btn-sm btn-success fw-semibold"`. |
| `221` | `                                onclick="abrirModalSubir(` | Instrucción de ejecución en el contexto del script: `onclick="abrirModalSubir(`. |
| `222` | `                                    <?= $g['id_grupo'] ?>,` | Instrucción de ejecución en el contexto del script: `<?= $g['id_grupo'] ?>,`. |
| `223` | `                                    <?= json_encode($g['nombre_grupo']) ?>,` | Instrucción de ejecución en el contexto del script: `<?= json_encode($g['nombre_grupo']) ?>,`. |
| `224` | `                                    <?= json_encode($g['nombre_modulo']) ?>,` | Instrucción de ejecución en el contexto del script: `<?= json_encode($g['nombre_modulo']) ?>,`. |
| `225` | `                                    <?= json_encode(date('d/m/Y H:i', strto...` | Instrucción de ejecución en el contexto del script: `<?= json_encode(date('d/m/Y H:i', strtotime($g['fecha_limite_evidencia']))) ?>`. |
| `226` | `                                )">` | Instrucción de ejecución en el contexto del script: `)">`. |
| `227` | `                                <i class="fas fa-upload me-1"></i>Subir foto` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-upload me-1"></i>Subir foto`. |
| `228` | `                            </button>` | Botón de acción interactivo para el usuario: `</button>`. |
| `229` | `                        <?php elseif ($tieneEv): ?>` | Instrucción de ejecución en el contexto del script: `<?php elseif ($tieneEv): ?>`. |
| `230` | `                            <button class="btn btn-sm btn-outline-primary"` | Botón de acción interactivo para el usuario: `<button class="btn btn-sm btn-outline-primary"`. |
| `231` | `                                    onclick="verEvidencia(<?= $g['id_grupo'...` | Instrucción de ejecución en el contexto del script: `onclick="verEvidencia(<?= $g['id_grupo'] ?>)">`. |
| `232` | `                                <i class="fas fa-eye me-1"></i>Ver` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-eye me-1"></i>Ver`. |
| `233` | `                            </button>` | Botón de acción interactivo para el usuario: `</button>`. |
| `234` | `                        <?php else: ?>` | Instrucción de ejecución en el contexto del script: `<?php else: ?>`. |
| `235` | `                            <span class="text-danger small">` | Instrucción de ejecución en el contexto del script: `<span class="text-danger small">`. |
| `236` | `                                <i class="fas fa-lock me-1"></i>Vencido` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-lock me-1"></i>Vencido`. |
| `237` | `                            </span>` | Instrucción de ejecución en el contexto del script: `</span>`. |
| `238` | `                        <?php endif; ?>` | Instrucción de ejecución en el contexto del script: `<?php endif; ?>`. |
| `239` | `                    </td>` | Celda de tabla con contenido de datos o encabezado de columna: `</td>`. |
| `240` | `                </tr>` | Fila contenedora de datos dentro de la tabla. |
| `241` | `                <?php endforeach; ?>` | Instrucción de ejecución en el contexto del script: `<?php endforeach; ?>`. |
| `242` | `                </tbody>` | Instrucción de ejecución en el contexto del script: `</tbody>`. |
| `243` | `            </table>` | Tabla de datos para despliegue estructurado de información: `</table>`. |
| `244` | `        </div>` | Cierre de contenedor visual `<div>`. |
| `245` | `        <?php endif; ?>` | Instrucción de ejecución en el contexto del script: `<?php endif; ?>`. |
| `246` | `    </div>` | Cierre de contenedor visual `<div>`. |
| `247` | `</div>` | Cierre de contenedor visual `<div>`. |
| `248` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `249` | `<!-- ══ GALERÍA DE EVIDENCIAS ═════════════════════════════════════════════...` | Instrucción de ejecución en el contexto del script: `<!-- ══ GALERÍA DE EVIDENCIAS ══════════════════════════════════════════════════ -->`. |
| `250` | `<div class="card shadow-sm border-0 mb-4">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="card shadow-sm border-0 mb-4">`. |
| `251` | `    <div class="card-header bg-white border-0 py-3 d-flex justify-content-b...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="card-header bg-white border-0 py-3 d-flex justify-content-between align-items-center">`. |
| `252` | `        <h6 class="fw-bold mb-0">` | Instrucción de ejecución en el contexto del script: `<h6 class="fw-bold mb-0">`. |
| `253` | `            <i class="fas fa-photo-film text-success me-2"></i>Galería de E...` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-photo-film text-success me-2"></i>Galería de Evidencias`. |
| `254` | `        </h6>` | Instrucción de ejecución en el contexto del script: `</h6>`. |
| `255` | `        <span class="badge bg-success"><?= $totalEv ?> foto(s)</span>` | Instrucción de ejecución en el contexto del script: `<span class="badge bg-success"><?= $totalEv ?> foto(s)</span>`. |
| `256` | `    </div>` | Cierre de contenedor visual `<div>`. |
| `257` | `    <div class="card-body">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="card-body">`. |
| `258` | `        <?php if (empty($evidencias)): ?>` | Instrucción de ejecución en el contexto del script: `<?php if (empty($evidencias)): ?>`. |
| `259` | `        <div class="text-center py-5 text-muted">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="text-center py-5 text-muted">`. |
| `260` | `            <i class="fas fa-images fa-3x mb-3 opacity-25 d-block"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-images fa-3x mb-3 opacity-25 d-block"></i>`. |
| `261` | `            <p class="small mb-0">` | Instrucción de ejecución en el contexto del script: `<p class="small mb-0">`. |
| `262` | `                Aún no has registrado evidencias<?= $filtroAsig ? ' en este...` | Instrucción de ejecución en el contexto del script: `Aún no has registrado evidencias<?= $filtroAsig ? ' en este módulo' : '' ?>.`. |
| `263` | `            </p>` | Instrucción de ejecución en el contexto del script: `</p>`. |
| `264` | `        </div>` | Cierre de contenedor visual `<div>`. |
| `265` | `        <?php else: ?>` | Instrucción de ejecución en el contexto del script: `<?php else: ?>`. |
| `266` | `        <div class="row g-3">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="row g-3">`. |
| `267` | `            <?php foreach ($evidencias as $ev): ?>` | Instrucción de ejecución en el contexto del script: `<?php foreach ($evidencias as $ev): ?>`. |
| `268` | `            <div class="col-md-4 col-sm-6">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="col-md-4 col-sm-6">`. |
| `269` | `                <div class="card border-0 shadow-sm h-100 ev-card"` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="card border-0 shadow-sm h-100 ev-card"`. |
| `270` | `                     style="border-radius:10px; overflow:hidden; cursor:poi...` | Instrucción de ejecución en el contexto del script: `style="border-radius:10px; overflow:hidden; cursor:pointer;"`. |
| `271` | `                     onclick="abrirLightbox(` | Instrucción de ejecución en el contexto del script: `onclick="abrirLightbox(`. |
| `272` | `                         <?= json_encode('../../public/' . $ev['ruta_archiv...` | Instrucción de ejecución en el contexto del script: `<?= json_encode('../../public/' . $ev['ruta_archivo']) ?>,`. |
| `273` | `                         <?= json_encode($ev['nombre_grupo']) ?>,` | Instrucción de ejecución en el contexto del script: `<?= json_encode($ev['nombre_grupo']) ?>,`. |
| `274` | `                         <?= json_encode($ev['nombre_modulo']) ?>,` | Instrucción de ejecución en el contexto del script: `<?= json_encode($ev['nombre_modulo']) ?>,`. |
| `275` | `                         <?= json_encode(date('d/m/Y H:i', strtotime($ev['f...` | Instrucción de ejecución en el contexto del script: `<?= json_encode(date('d/m/Y H:i', strtotime($ev['fecha_subida']))) ?>`. |
| `276` | `                     )">` | Instrucción de ejecución en el contexto del script: `)">`. |
| `277` | `                    <div class="position-relative ev-img-wrap">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="position-relative ev-img-wrap">`. |
| `278` | `                        <img src="../../public/<?= htmlspecialchars($ev['ru...` | Instrucción de ejecución en el contexto del script: `<img src="../../public/<?= htmlspecialchars($ev['ruta_archivo']) ?>"`. |
| `279` | `                             alt="Evidencia <?= htmlspecialchars($ev['nombr...` | Instrucción de ejecución en el contexto del script: `alt="Evidencia <?= htmlspecialchars($ev['nombre_grupo']) ?>"`. |
| `280` | `                             style="object-fit:cover; height:200px; width:1...` | Instrucción de ejecución en el contexto del script: `style="object-fit:cover; height:200px; width:100%;">`. |
| `281` | `                        <div class="ev-overlay d-flex flex-column justify-c...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="ev-overlay d-flex flex-column justify-content-center align-items-center text-white text-center p-2">`. |
| `282` | `                            <i class="fas fa-expand fa-lg mb-1"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-expand fa-lg mb-1"></i>`. |
| `283` | `                            <div class="fw-semibold" style="font-size:.8rem;">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="fw-semibold" style="font-size:.8rem;">`. |
| `284` | `                                <?= htmlspecialchars($ev['nombre_grupo']) ?>` | Instrucción de ejecución en el contexto del script: `<?= htmlspecialchars($ev['nombre_grupo']) ?>`. |
| `285` | `                            </div>` | Cierre de contenedor visual `<div>`. |
| `286` | `                            <div style="font-size:.72rem; opacity:.85;">` | Contenedor visual estructurado con Bootstrap/CSS: `<div style="font-size:.72rem; opacity:.85;">`. |
| `287` | `                                <?= htmlspecialchars($ev['nombre_modulo']) ?>` | Instrucción de ejecución en el contexto del script: `<?= htmlspecialchars($ev['nombre_modulo']) ?>`. |
| `288` | `                            </div>` | Cierre de contenedor visual `<div>`. |
| `289` | `                        </div>` | Cierre de contenedor visual `<div>`. |
| `290` | `                    </div>` | Cierre de contenedor visual `<div>`. |
| `291` | `                    <div class="card-footer bg-white border-0 pt-2 pb-2 px-3">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="card-footer bg-white border-0 pt-2 pb-2 px-3">`. |
| `292` | `                        <div class="d-flex justify-content-between align-it...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="d-flex justify-content-between align-items-center">`. |
| `293` | `                            <span class="small fw-semibold text-truncate" s...` | Instrucción de ejecución en el contexto del script: `<span class="small fw-semibold text-truncate" style="max-width:65%;">`. |
| `294` | `                                <?= htmlspecialchars($ev['nombre_modulo']) ?>` | Instrucción de ejecución en el contexto del script: `<?= htmlspecialchars($ev['nombre_modulo']) ?>`. |
| `295` | `                            </span>` | Instrucción de ejecución en el contexto del script: `</span>`. |
| `296` | `                            <span class="text-muted" style="font-size:.75re...` | Instrucción de ejecución en el contexto del script: `<span class="text-muted" style="font-size:.75rem;">`. |
| `297` | `                                <?= date('d/m/Y', strtotime($ev['fecha_subi...` | Instrucción de ejecución en el contexto del script: `<?= date('d/m/Y', strtotime($ev['fecha_subida'])) ?>`. |
| `298` | `                            </span>` | Instrucción de ejecución en el contexto del script: `</span>`. |
| `299` | `                        </div>` | Cierre de contenedor visual `<div>`. |
| `300` | `                    </div>` | Cierre de contenedor visual `<div>`. |
| `301` | `                </div>` | Cierre de contenedor visual `<div>`. |
| `302` | `            </div>` | Cierre de contenedor visual `<div>`. |
| `303` | `            <?php endforeach; ?>` | Instrucción de ejecución en el contexto del script: `<?php endforeach; ?>`. |
| `304` | `        </div>` | Cierre de contenedor visual `<div>`. |
| `305` | `        <?php endif; ?>` | Instrucción de ejecución en el contexto del script: `<?php endif; ?>`. |
| `306` | `    </div>` | Cierre de contenedor visual `<div>`. |
| `307` | `</div>` | Cierre de contenedor visual `<div>`. |
| `308` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `309` | `<!-- ══ MODAL SUBIR EVIDENCIA ═════════════════════════════════════════════...` | Instrucción de ejecución en el contexto del script: `<!-- ══ MODAL SUBIR EVIDENCIA ═════════════════════════════════════════════════ -->`. |
| `310` | `<div class="modal fade" id="modalSubirEvidencia" tabindex="-1" aria-hidden=...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="modal fade" id="modalSubirEvidencia" tabindex="-1" aria-hidden="true">`. |
| `311` | `    <div class="modal-dialog modal-dialog-centered">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="modal-dialog modal-dialog-centered">`. |
| `312` | `        <div class="modal-content border-0 shadow">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="modal-content border-0 shadow">`. |
| `313` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `314` | `            <div class="modal-header border-0" style="background:#0f2200; c...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="modal-header border-0" style="background:#0f2200; color:#fff;">`. |
| `315` | `                <div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div>`. |
| `316` | `                    <h5 class="modal-title fw-bold mb-0">` | Instrucción de ejecución en el contexto del script: `<h5 class="modal-title fw-bold mb-0">`. |
| `317` | `                        <i class="fas fa-camera me-2"></i>Subir Evidencia F...` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-camera me-2"></i>Subir Evidencia Fotográfica`. |
| `318` | `                    </h5>` | Instrucción de ejecución en el contexto del script: `</h5>`. |
| `319` | `                    <div class="small mt-1" style="opacity:.8;">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="small mt-1" style="opacity:.8;">`. |
| `320` | `                        Grupo: <strong id="modalTituloGrupo">—</strong>` | Instrucción de ejecución en el contexto del script: `Grupo: <strong id="modalTituloGrupo">—</strong>`. |
| `321` | `                    </div>` | Cierre de contenedor visual `<div>`. |
| `322` | `                </div>` | Cierre de contenedor visual `<div>`. |
| `323` | `                <button type="button" class="btn-close btn-close-white" dat...` | Botón de acción interactivo para el usuario: `<button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>`. |
| `324` | `            </div>` | Cierre de contenedor visual `<div>`. |
| `325` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `326` | `            <form action="../../controllers/VoceroController.php" method="P...` | Formulario para recolección y envío de datos del usuario: `<form action="../../controllers/VoceroController.php" method="POST"`. |
| `327` | `                  enctype="multipart/form-data">` | Instrucción de ejecución en el contexto del script: `enctype="multipart/form-data">`. |
| `328` | `                <input type="hidden" name="accion" value="subir_evidencia">` | Campo de entrada interactivo para datos del usuario: `<input type="hidden" name="accion" value="subir_evidencia">`. |
| `329` | `                <input type="hidden" name="id_grupo" id="modalIdGrupo">` | Campo de entrada interactivo para datos del usuario: `<input type="hidden" name="id_grupo" id="modalIdGrupo">`. |
| `330` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `331` | `                <div class="modal-body px-4">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="modal-body px-4">`. |
| `332` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `333` | `                    <!-- Info del grupo -->` | Instrucción de ejecución en el contexto del script: `<!-- Info del grupo -->`. |
| `334` | `                    <div class="rounded p-3 mb-3" style="background:#f0f9f0...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="rounded p-3 mb-3" style="background:#f0f9f0; border:1px solid #d4edda;">`. |
| `335` | `                        <div class="d-flex flex-wrap gap-2">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="d-flex flex-wrap gap-2">`. |
| `336` | `                            <span class="badge bg-success px-3 py-2">` | Instrucción de ejecución en el contexto del script: `<span class="badge bg-success px-3 py-2">`. |
| `337` | `                                <i class="fas fa-door-open me-1"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-door-open me-1"></i>`. |
| `338` | `                                Módulo: <span id="modalInfoModulo">—</span>` | Instrucción de ejecución en el contexto del script: `Módulo: <span id="modalInfoModulo">—</span>`. |
| `339` | `                            </span>` | Instrucción de ejecución en el contexto del script: `</span>`. |
| `340` | `                            <span class="badge bg-warning text-dark px-3 py...` | Instrucción de ejecución en el contexto del script: `<span class="badge bg-warning text-dark px-3 py-2">`. |
| `341` | `                                <i class="fas fa-calendar-xmark me-1"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-calendar-xmark me-1"></i>`. |
| `342` | `                                Plazo: <span id="modalInfoPlazo">—</span>` | Instrucción de ejecución en el contexto del script: `Plazo: <span id="modalInfoPlazo">—</span>`. |
| `343` | `                            </span>` | Instrucción de ejecución en el contexto del script: `</span>`. |
| `344` | `                        </div>` | Cierre de contenedor visual `<div>`. |
| `345` | `                    </div>` | Cierre de contenedor visual `<div>`. |
| `346` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `347` | `                    <!-- Input de foto -->` | Instrucción de ejecución en el contexto del script: `<!-- Input de foto -->`. |
| `348` | `                    <div class="mb-3">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="mb-3">`. |
| `349` | `                        <label class="form-label fw-semibold small">` | Instrucción de ejecución en el contexto del script: `<label class="form-label fw-semibold small">`. |
| `350` | `                            <i class="fas fa-image me-1 text-success"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-image me-1 text-success"></i>`. |
| `351` | `                            Seleccionar fotografía <span class="text-danger...` | Instrucción de ejecución en el contexto del script: `Seleccionar fotografía <span class="text-danger">*</span>`. |
| `352` | `                        </label>` | Instrucción de ejecución en el contexto del script: `</label>`. |
| `353` | `                        <input type="file" class="form-control form-control...` | Campo de entrada interactivo para datos del usuario: `<input type="file" class="form-control form-control-sm" name="evidencia"`. |
| `354` | `                               id="inputFoto" accept=".jpg,.jpeg,.png"` | Instrucción de ejecución en el contexto del script: `id="inputFoto" accept=".jpg,.jpeg,.png"`. |
| `355` | `                               onchange="previsualizarFoto(this)" required>` | Instrucción de ejecución en el contexto del script: `onchange="previsualizarFoto(this)" required>`. |
| `356` | `                        <div class="form-text text-muted mt-1">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="form-text text-muted mt-1">`. |
| `357` | `                            <i class="fas fa-circle-info me-1"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-circle-info me-1"></i>`. |
| `358` | `                            La foto debe mostrar claramente el módulo limpio.` | Instrucción de ejecución en el contexto del script: `La foto debe mostrar claramente el módulo limpio.`. |
| `359` | `                            Formatos: JPG, PNG. Máx. 10 MB.` | Instrucción de ejecución en el contexto del script: `Formatos: JPG, PNG. Máx. 10 MB.`. |
| `360` | `                        </div>` | Cierre de contenedor visual `<div>`. |
| `361` | `                    </div>` | Cierre de contenedor visual `<div>`. |
| `362` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `363` | `                    <!-- Previsualización -->` | Instrucción de ejecución en el contexto del script: `<!-- Previsualización -->`. |
| `364` | `                    <div id="previewBox" class="d-none mb-3 text-center">` | Contenedor visual estructurado con Bootstrap/CSS: `<div id="previewBox" class="d-none mb-3 text-center">`. |
| `365` | `                        <div class="small text-muted mb-1 fw-semibold">Vist...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="small text-muted mb-1 fw-semibold">Vista previa:</div>`. |
| `366` | `                        <img id="previewImg" src="#" alt="Vista previa"` | Instrucción de ejecución en el contexto del script: `<img id="previewImg" src="#" alt="Vista previa"`. |
| `367` | `                             class="img-fluid rounded shadow-sm"` | Instrucción de ejecución en el contexto del script: `class="img-fluid rounded shadow-sm"`. |
| `368` | `                             style="max-height:220px; border:2px solid #39a...` | Instrucción de ejecución en el contexto del script: `style="max-height:220px; border:2px solid #39a900;">`. |
| `369` | `                    </div>` | Cierre de contenedor visual `<div>`. |
| `370` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `371` | `                </div>` | Cierre de contenedor visual `<div>`. |
| `372` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `373` | `                <div class="modal-footer border-0 px-4 pb-4 pt-0">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="modal-footer border-0 px-4 pb-4 pt-0">`. |
| `374` | `                    <button type="button" class="btn btn-outline-secondary"` | Botón de acción interactivo para el usuario: `<button type="button" class="btn btn-outline-secondary"`. |
| `375` | `                            data-bs-dismiss="modal">` | Instrucción de ejecución en el contexto del script: `data-bs-dismiss="modal">`. |
| `376` | `                        <i class="fas fa-xmark me-1"></i>Cancelar` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-xmark me-1"></i>Cancelar`. |
| `377` | `                    </button>` | Botón de acción interactivo para el usuario: `</button>`. |
| `378` | `                    <button type="submit" class="btn btn-success fw-bold">` | Botón de acción interactivo para el usuario: `<button type="submit" class="btn btn-success fw-bold">`. |
| `379` | `                        <i class="fas fa-paper-plane me-1"></i>Enviar Evide...` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-paper-plane me-1"></i>Enviar Evidencia`. |
| `380` | `                    </button>` | Botón de acción interactivo para el usuario: `</button>`. |
| `381` | `                </div>` | Cierre de contenedor visual `<div>`. |
| `382` | `            </form>` | Cierre de formulario HTML. |
| `383` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `384` | `        </div>` | Cierre de contenedor visual `<div>`. |
| `385` | `    </div>` | Cierre de contenedor visual `<div>`. |
| `386` | `</div>` | Cierre de contenedor visual `<div>`. |
| `387` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `388` | `<!-- ══ ESTILOS GALERÍA ═══════════════════════════════════════════════════...` | Instrucción de ejecución en el contexto del script: `<!-- ══ ESTILOS GALERÍA ════════════════════════════════════════════════════════ -->`. |
| `389` | `<style>` | Instrucción de ejecución en el contexto del script: `<style>`. |
| `390` | `.ev-img-wrap { position: relative; overflow: hidden; }` | Instrucción de ejecución en el contexto del script: `.ev-img-wrap { position: relative; overflow: hidden; }`. |
| `391` | `.ev-overlay {` | Instrucción de ejecución en el contexto del script: `.ev-overlay {`. |
| `392` | `    position: absolute; inset: 0;` | Instrucción de ejecución en el contexto del script: `position: absolute; inset: 0;`. |
| `393` | `    background: rgba(0,0,0,.6);` | Instrucción de ejecución en el contexto del script: `background: rgba(0,0,0,.6);`. |
| `394` | `    opacity: 0;` | Instrucción de ejecución en el contexto del script: `opacity: 0;`. |
| `395` | `    transition: opacity .25s ease;` | Instrucción de ejecución en el contexto del script: `transition: opacity .25s ease;`. |
| `396` | `}` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `397` | `.ev-card:hover .ev-overlay { opacity: 1; }` | Instrucción de ejecución en el contexto del script: `.ev-card:hover .ev-overlay { opacity: 1; }`. |
| `398` | `.ev-card:hover img { transform: scale(1.04); transition: transform .3s ease; }` | Instrucción de ejecución en el contexto del script: `.ev-card:hover img { transform: scale(1.04); transition: transform .3s ease; }`. |
| `399` | `</style>` | Instrucción de ejecución en el contexto del script: `</style>`. |
| `400` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `401` | `<!-- ══ JAVASCRIPT ════════════════════════════════════════════════════════...` | Instrucción de ejecución en el contexto del script: `<!-- ══ JAVASCRIPT ══════════════════════════════════════════════════════════════ -->`. |
| `402` | `<script>` | Bloque o etiqueta de vinculación para scripts JavaScript del lado del cliente. |
| `403` | `function abrirModalSubir(idGrupo, nombreGrupo, nombreModulo, plazo) {` | Declaración de método o función con su firma y parámetros: `function abrirModalSubir(idGrupo, nombreGrupo, nombreModulo, plazo) {`. |
| `404` | `    document.getElementById('modalIdGrupo').value      = idGrupo;` | Instrucción de ejecución en el contexto del script: `document.getElementById('modalIdGrupo').value      = idGrupo;`. |
| `405` | `    document.getElementById('modalTituloGrupo').textContent = nombreGrupo;` | Instrucción de ejecución en el contexto del script: `document.getElementById('modalTituloGrupo').textContent = nombreGrupo;`. |
| `406` | `    document.getElementById('modalInfoModulo').textContent  = nombreModulo;` | Instrucción de ejecución en el contexto del script: `document.getElementById('modalInfoModulo').textContent  = nombreModulo;`. |
| `407` | `    document.getElementById('modalInfoPlazo').textContent   = plazo;` | Instrucción de ejecución en el contexto del script: `document.getElementById('modalInfoPlazo').textContent   = plazo;`. |
| `408` | `    document.getElementById('previewBox').classList.add('d-none');` | Instrucción de ejecución en el contexto del script: `document.getElementById('previewBox').classList.add('d-none');`. |
| `409` | `    document.getElementById('previewImg').src  = '#';` | Instrucción de ejecución en el contexto del script: `document.getElementById('previewImg').src  = '#';`. |
| `410` | `    document.getElementById('inputFoto').value = '';` | Instrucción de ejecución en el contexto del script: `document.getElementById('inputFoto').value = '';`. |
| `411` | `    new bootstrap.Modal(document.getElementById('modalSubirEvidencia')).sho...` | Instrucción de ejecución en el contexto del script: `new bootstrap.Modal(document.getElementById('modalSubirEvidencia')).show();`. |
| `412` | `}` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `413` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `414` | `function previsualizarFoto(input) {` | Declaración de método o función con su firma y parámetros: `function previsualizarFoto(input) {`. |
| `415` | `    const box = document.getElementById('previewBox');` | Instrucción de ejecución en el contexto del script: `const box = document.getElementById('previewBox');`. |
| `416` | `    const img = document.getElementById('previewImg');` | Instrucción de ejecución en el contexto del script: `const img = document.getElementById('previewImg');`. |
| `417` | `    if (input.files && input.files[0]) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (input.files && input.files[0]) {`. |
| `418` | `        const reader = new FileReader();` | Instrucción de ejecución en el contexto del script: `const reader = new FileReader();`. |
| `419` | `        reader.onload = e => {` | Instrucción de ejecución en el contexto del script: `reader.onload = e => {`. |
| `420` | `            img.src = e.target.result;` | Instrucción de ejecución en el contexto del script: `img.src = e.target.result;`. |
| `421` | `            box.classList.remove('d-none');` | Instrucción de ejecución en el contexto del script: `box.classList.remove('d-none');`. |
| `422` | `        };` | Instrucción de ejecución en el contexto del script: `};`. |
| `423` | `        reader.readAsDataURL(input.files[0]);` | Instrucción de ejecución en el contexto del script: `reader.readAsDataURL(input.files[0]);`. |
| `424` | `    } else {` | Bloque alternativo `else`: se ejecuta si ninguna condición previa resultó verdadera. |
| `425` | `        box.classList.add('d-none');` | Instrucción de ejecución en el contexto del script: `box.classList.add('d-none');`. |
| `426` | `    }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `427` | `}` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `428` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `429` | `function verEvidencia(idGrupo) {` | Declaración de método o función con su firma y parámetros: `function verEvidencia(idGrupo) {`. |
| `430` | `    fetch('../../controllers/VoceroController.php?accion=get_evidencia&id_g...` | Instrucción de ejecución en el contexto del script: `fetch(`../../controllers/VoceroController.php?accion=get_evidencia&id_grupo=${idGrupo}`)`. |
| `431` | `        .then(r => r.json())` | Instrucción de ejecución en el contexto del script: `.then(r => r.json())`. |
| `432` | `        .then(data => {` | Instrucción de ejecución en el contexto del script: `.then(data => {`. |
| `433` | `            if (data.ruta) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (data.ruta) {`. |
| `434` | `                Swal.fire({` | Instrucción de ejecución en el contexto del script: `Swal.fire({`. |
| `435` | `                    imageUrl: '../../public/${data.ruta}',` | Instrucción de ejecución en el contexto del script: `imageUrl: `../../public/${data.ruta}`,`. |
| `436` | `                    imageAlt: 'Evidencia',` | Instrucción de ejecución en el contexto del script: `imageAlt: 'Evidencia',`. |
| `437` | `                    title: data.grupo,` | Instrucción de ejecución en el contexto del script: `title: data.grupo,`. |
| `438` | `                    text: data.modulo + ' · ' + data.fecha,` | Instrucción de ejecución en el contexto del script: `text: data.modulo + ' · ' + data.fecha,`. |
| `439` | `                    confirmButtonColor: '#39a900',` | Instrucción de ejecución en el contexto del script: `confirmButtonColor: '#39a900',`. |
| `440` | `                    width: 700` | Instrucción de ejecución en el contexto del script: `width: 700`. |
| `441` | `                });` | Instrucción de ejecución en el contexto del script: `});`. |
| `442` | `            } else {` | Bloque alternativo `else`: se ejecuta si ninguna condición previa resultó verdadera. |
| `443` | `                Swal.fire({` | Instrucción de ejecución en el contexto del script: `Swal.fire({`. |
| `444` | `                    icon: 'info',` | Instrucción de ejecución en el contexto del script: `icon: 'info',`. |
| `445` | `                    title: 'Sin evidencia',` | Instrucción de ejecución en el contexto del script: `title: 'Sin evidencia',`. |
| `446` | `                    text: 'No se encontró evidencia registrada para este gr...` | Instrucción de ejecución en el contexto del script: `text: 'No se encontró evidencia registrada para este grupo.',`. |
| `447` | `                    confirmButtonColor: '#39a900'` | Instrucción de ejecución en el contexto del script: `confirmButtonColor: '#39a900'`. |
| `448` | `                });` | Instrucción de ejecución en el contexto del script: `});`. |
| `449` | `            }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `450` | `        })` | Instrucción de ejecución en el contexto del script: `})`. |
| `451` | `        .catch(() => {` | Instrucción de ejecución en el contexto del script: `.catch(() => {`. |
| `452` | `            Swal.fire({` | Instrucción de ejecución en el contexto del script: `Swal.fire({`. |
| `453` | `                icon: 'error',` | Instrucción de ejecución en el contexto del script: `icon: 'error',`. |
| `454` | `                title: 'Error',` | Instrucción de ejecución en el contexto del script: `title: 'Error',`. |
| `455` | `                text: 'No se pudo obtener la evidencia. Intenta de nuevo.',` | Instrucción de ejecución en el contexto del script: `text: 'No se pudo obtener la evidencia. Intenta de nuevo.',`. |
| `456` | `                confirmButtonColor: '#39a900'` | Instrucción de ejecución en el contexto del script: `confirmButtonColor: '#39a900'`. |
| `457` | `            });` | Instrucción de ejecución en el contexto del script: `});`. |
| `458` | `        });` | Instrucción de ejecución en el contexto del script: `});`. |
| `459` | `}` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `460` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `461` | `function abrirLightbox(rutaImg, grupo, modulo, fecha) {` | Declaración de método o función con su firma y parámetros: `function abrirLightbox(rutaImg, grupo, modulo, fecha) {`. |
| `462` | `    Swal.fire({` | Instrucción de ejecución en el contexto del script: `Swal.fire({`. |
| `463` | `        imageUrl: rutaImg,` | Instrucción de ejecución en el contexto del script: `imageUrl: rutaImg,`. |
| `464` | `        imageAlt: grupo,` | Instrucción de ejecución en el contexto del script: `imageAlt: grupo,`. |
| `465` | `        title: grupo,` | Instrucción de ejecución en el contexto del script: `title: grupo,`. |
| `466` | `        text: modulo + ' · ' + fecha,` | Instrucción de ejecución en el contexto del script: `text: modulo + ' · ' + fecha,`. |
| `467` | `        confirmButtonColor: '#39a900',` | Instrucción de ejecución en el contexto del script: `confirmButtonColor: '#39a900',`. |
| `468` | `        width: 700,` | Instrucción de ejecución en el contexto del script: `width: 700,`. |
| `469` | `        showCloseButton: true` | Instrucción de ejecución en el contexto del script: `showCloseButton: true`. |
| `470` | `    });` | Instrucción de ejecución en el contexto del script: `});`. |
| `471` | `}` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `472` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `473` | `<?php if ($alert): ?>` | Instrucción de ejecución en el contexto del script: `<?php if ($alert): ?>`. |
| `474` | `document.addEventListener('DOMContentLoaded', function () {` | Declaración de método o función con su firma y parámetros: `document.addEventListener('DOMContentLoaded', function () {`. |
| `475` | `    Swal.fire({` | Instrucción de ejecución en el contexto del script: `Swal.fire({`. |
| `476` | `        icon:  '<?= addslashes($alert['icon']) ?>',` | Instrucción de ejecución en el contexto del script: `icon:  '<?= addslashes($alert['icon']) ?>',`. |
| `477` | `        title: '<?= addslashes($alert['title']) ?>',` | Instrucción de ejecución en el contexto del script: `title: '<?= addslashes($alert['title']) ?>',`. |
| `478` | `        text:  '<?= addslashes($alert['text']) ?>',` | Instrucción de ejecución en el contexto del script: `text:  '<?= addslashes($alert['text']) ?>',`. |
| `479` | `        confirmButtonColor: '#39a900'` | Instrucción de ejecución en el contexto del script: `confirmButtonColor: '#39a900'`. |
| `480` | `    });` | Instrucción de ejecución en el contexto del script: `});`. |
| `481` | `});` | Instrucción de ejecución en el contexto del script: `});`. |
| `482` | `<?php endif; ?>` | Instrucción de ejecución en el contexto del script: `<?php endif; ?>`. |
| `483` | `</script>` | Bloque o etiqueta de vinculación para scripts JavaScript del lado del cliente. |
| `484` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `485` | `<?php require_once __DIR__ . '/../layouts/footer.php'; ?>` | Instrucción de ejecución en el contexto del script: `<?php require_once __DIR__ . '/../layouts/footer.php'; ?>`. |

---

## 3. Resumen y Flujo de Interacción

El archivo `vocero_evidencias.php` cumple un rol indispensable en `views/dashboard/vocero_evidencias.php`. 
Listado histórico de evidencias de limpieza subidas por el vocero con su respectivo estado. Garantiza la robustez, el orden y la estabilidad de la arquitectura del proyecto `systemLimpieza`.
