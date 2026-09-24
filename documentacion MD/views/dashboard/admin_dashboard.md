# Documentación Línea por Línea: `views/dashboard/admin_dashboard.php`

## 1. Ficha Técnica del Archivo

- **Archivo:** `admin_dashboard.php`
- **Ruta en el proyecto:** `views/dashboard/admin_dashboard.php`
- **Cantidad total de líneas:** `280`
- **Tipo de archivo:** `PHP`
- **Propósito general:** Panel principal del administrador con tarjetas de estadísticas, resúmenes de turnos, gráficas de cumplimiento y accesos directos.

---

## 2. Explicación Detallada Línea por Línea

A continuación se presenta cada línea de código numerada de forma consecutiva, acompañada de su fragmento exacto y la explicación exhaustiva de su funcionamiento y responsabilidad en el sistema:

| Línea | Código Fuente | Explicación Detallada |
|---|---|---|
| `1` | `<?php` | Apertura obligatoria de la etiqueta PHP para ejecución del código del lado del servidor. |
| `2` | `$titulo = 'Dashboard Administrador';` | Instrucción de ejecución en el contexto del script: `$titulo = 'Dashboard Administrador';`. |
| `3` | `if (session_status() === PHP_SESSION_NONE) session_start();` | Inicia o reanuda la sesión PHP del usuario si no se encontraba activa previamente. |
| `4` | `if (!isset($_SESSION['usuario']) \|\| (int)$_SESSION['usuario']['rol'] !== ...` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (!isset($_SESSION['usuario']) \|\| (int)$_SESSION['usuario']['rol'] !== 1) {`. |
| `5` | `    header("Location: ../usuarios/login.php"); exit;` | Emite cabecera HTTP de redirección en el navegador: `header("Location: ../usuarios/login.php"); exit;`. |
| `6` | `}` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `7` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `8` | `require_once __DIR__ . '/../../config/database.php';` | Importación e inclusión obligatoria del archivo de dependencia requerido: `require_once __DIR__ . '/../../config/database.php';`. |
| `9` | `$db    = (new Database())->conectar();` | Instrucción de ejecución en el contexto del script: `$db    = (new Database())->conectar();`. |
| `10` | `$alert = $_SESSION['alert'] ?? null;` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección: `$alert = $_SESSION['alert'] ?? null;`. |
| `11` | `unset($_SESSION['alert']);` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección: `unset($_SESSION['alert']);`. |
| `12` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `13` | `// ── Stats ──` | Comentario de línea explicativo: `── Stats ──`. |
| `14` | `$totalFichas    = $db->query("SELECT COUNT(*) FROM fichas WHERE activo=1")-...` | Obtiene el valor de una columna única de la primera fila resultante. |
| `15` | `$totalVoceros   = $db->query("SELECT COUNT(*) FROM voceros WHERE activo=1")...` | Obtiene el valor de una columna única de la primera fila resultante. |
| `16` | `$totalModulos   = $db->query("SELECT COUNT(*) FROM modulos WHERE activo=1")...` | Obtiene el valor de una columna única de la primera fila resultante. |
| `17` | `$asignActivas   = $db->query("SELECT COUNT(*) FROM asignaciones WHERE estad...` | Obtiene el valor de una columna única de la primera fila resultante. |
| `18` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `19` | `// Evidencias del mes actual` | Comentario de línea explicativo: `Evidencias del mes actual`. |
| `20` | `$evMes = $db->query(` | Instrucción de ejecución en el contexto del script: `$evMes = $db->query(`. |
| `21` | `    "SELECT COUNT(*) FROM evidencias WHERE MONTH(fecha_subida)=MONTH(NOW())...` | Instrucción de ejecución en el contexto del script: `"SELECT COUNT(*) FROM evidencias WHERE MONTH(fecha_subida)=MONTH(NOW()) AND YEAR(fecha_subida)=YEAR(NOW())"`. |
| `22` | `)->fetchColumn();` | Obtiene el valor de una columna única de la primera fila resultante. |
| `23` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `24` | `// Incumplimientos: asignaciones vencidas sin evidencia` | Comentario de línea explicativo: `Incumplimientos: asignaciones vencidas sin evidencia`. |
| `25` | `$incumplimientos = $db->query(` | Instrucción de ejecución en el contexto del script: `$incumplimientos = $db->query(`. |
| `26` | `    "SELECT COUNT(*) FROM asignaciones a` | Instrucción de ejecución en el contexto del script: `"SELECT COUNT(*) FROM asignaciones a`. |
| `27` | `     WHERE a.fecha_limite_evidencia < NOW() AND a.estado='Activa'` | Instrucción de ejecución en el contexto del script: `WHERE a.fecha_limite_evidencia < NOW() AND a.estado='Activa'`. |
| `28` | `     AND NOT EXISTS (` | Instrucción de ejecución en el contexto del script: `AND NOT EXISTS (`. |
| `29` | `         SELECT 1 FROM grupos g` | Instrucción de ejecución en el contexto del script: `SELECT 1 FROM grupos g`. |
| `30` | `         JOIN evidencias e ON e.id_grupo = g.id_grupo` | Instrucción de ejecución en el contexto del script: `JOIN evidencias e ON e.id_grupo = g.id_grupo`. |
| `31` | `         WHERE g.id_asignacion = a.id_asignacion` | Instrucción de ejecución en el contexto del script: `WHERE g.id_asignacion = a.id_asignacion`. |
| `32` | `     )"` | Instrucción de ejecución en el contexto del script: `)"`. |
| `33` | `)->fetchColumn();` | Obtiene el valor de una columna única de la primera fila resultante. |
| `34` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `35` | `// Fichas con turno hoy sin evidencia` | Comentario de línea explicativo: `Fichas con turno hoy sin evidencia`. |
| `36` | `$stmtAlertaHoy = $db->query(` | Instrucción de ejecución en el contexto del script: `$stmtAlertaHoy = $db->query(`. |
| `37` | `    "SELECT COUNT(DISTINCT a.id_ficha) AS total` | Instrucción de ejecución en el contexto del script: `"SELECT COUNT(DISTINCT a.id_ficha) AS total`. |
| `38` | `     FROM turnos t` | Instrucción de ejecución en el contexto del script: `FROM turnos t`. |
| `39` | `     JOIN asignaciones a ON a.id_asignacion = t.id_asignacion` | Instrucción de ejecución en el contexto del script: `JOIN asignaciones a ON a.id_asignacion = t.id_asignacion`. |
| `40` | `     WHERE t.fecha_turno = CURDATE()` | Instrucción de ejecución en el contexto del script: `WHERE t.fecha_turno = CURDATE()`. |
| `41` | `       AND t.estado IN ('Abierto','Pendiente')` | Instrucción de ejecución en el contexto del script: `AND t.estado IN ('Abierto','Pendiente')`. |
| `42` | `       AND NOT EXISTS (SELECT 1 FROM evidencias e WHERE e.id_turno = t.id_t...` | Instrucción de ejecución en el contexto del script: `AND NOT EXISTS (SELECT 1 FROM evidencias e WHERE e.id_turno = t.id_turno)"`. |
| `43` | `);` | Instrucción de ejecución en el contexto del script: `);`. |
| `44` | `$fichasConTurnoHoy = (int)$stmtAlertaHoy->fetchColumn();` | Obtiene el valor de una columna única de la primera fila resultante. |
| `45` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `46` | `// Últimas 5 evidencias` | Comentario de línea explicativo: `Últimas 5 evidencias`. |
| `47` | `$ultimasEvidencias = $db->query(` | Instrucción de ejecución en el contexto del script: `$ultimasEvidencias = $db->query(`. |
| `48` | `    "SELECT e.fecha_subida, e.nombre_archivo, e.ruta_archivo,` | Instrucción de ejecución en el contexto del script: `"SELECT e.fecha_subida, e.nombre_archivo, e.ruta_archivo,`. |
| `49` | `            v.nombres AS vocero, v.apellidos AS vocero_ap,` | Instrucción de ejecución en el contexto del script: `v.nombres AS vocero, v.apellidos AS vocero_ap,`. |
| `50` | `            f.numero_ficha, m.nombre AS modulo` | Instrucción de ejecución en el contexto del script: `f.numero_ficha, m.nombre AS modulo`. |
| `51` | `     FROM evidencias e` | Instrucción de ejecución en el contexto del script: `FROM evidencias e`. |
| `52` | `     JOIN voceros v ON v.id_vocero = e.id_vocero` | Instrucción de ejecución en el contexto del script: `JOIN voceros v ON v.id_vocero = e.id_vocero`. |
| `53` | `     JOIN grupos g ON g.id_grupo = e.id_grupo` | Instrucción de ejecución en el contexto del script: `JOIN grupos g ON g.id_grupo = e.id_grupo`. |
| `54` | `     JOIN asignaciones a ON a.id_asignacion = g.id_asignacion` | Instrucción de ejecución en el contexto del script: `JOIN asignaciones a ON a.id_asignacion = g.id_asignacion`. |
| `55` | `     JOIN fichas f ON f.id_ficha = a.id_ficha` | Instrucción de ejecución en el contexto del script: `JOIN fichas f ON f.id_ficha = a.id_ficha`. |
| `56` | `     JOIN modulos m ON m.id_modulo = a.id_modulo` | Instrucción de ejecución en el contexto del script: `JOIN modulos m ON m.id_modulo = a.id_modulo`. |
| `57` | `     ORDER BY e.fecha_subida DESC LIMIT 5"` | Instrucción de ejecución en el contexto del script: `ORDER BY e.fecha_subida DESC LIMIT 5"`. |
| `58` | `)->fetchAll(PDO::FETCH_ASSOC);` | Obtiene todos los registros coincidentes de la consulta en un arreglo asociativo. |
| `59` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `60` | `// Incumplimientos recientes (últimos 5)` | Comentario de línea explicativo: `Incumplimientos recientes (últimos 5)`. |
| `61` | `$ultimosIncump = $db->query(` | Instrucción de ejecución en el contexto del script: `$ultimosIncump = $db->query(`. |
| `62` | `    "SELECT a.id_asignacion, a.fecha_limite_evidencia,` | Instrucción de ejecución en el contexto del script: `"SELECT a.id_asignacion, a.fecha_limite_evidencia,`. |
| `63` | `            f.numero_ficha, m.nombre AS modulo,` | Instrucción de ejecución en el contexto del script: `f.numero_ficha, m.nombre AS modulo,`. |
| `64` | `            v.nombres AS vocero, v.apellidos AS vocero_ap, v.correo` | Instrucción de ejecución en el contexto del script: `v.nombres AS vocero, v.apellidos AS vocero_ap, v.correo`. |
| `65` | `     FROM asignaciones a` | Instrucción de ejecución en el contexto del script: `FROM asignaciones a`. |
| `66` | `     JOIN fichas f ON f.id_ficha = a.id_ficha` | Instrucción de ejecución en el contexto del script: `JOIN fichas f ON f.id_ficha = a.id_ficha`. |
| `67` | `     JOIN modulos m ON m.id_modulo = a.id_modulo` | Instrucción de ejecución en el contexto del script: `JOIN modulos m ON m.id_modulo = a.id_modulo`. |
| `68` | `     LEFT JOIN voceros v ON v.id_ficha = a.id_ficha AND v.activo=1` | Instrucción de ejecución en el contexto del script: `LEFT JOIN voceros v ON v.id_ficha = a.id_ficha AND v.activo=1`. |
| `69` | `     WHERE a.fecha_limite_evidencia < NOW() AND a.estado='Activa'` | Instrucción de ejecución en el contexto del script: `WHERE a.fecha_limite_evidencia < NOW() AND a.estado='Activa'`. |
| `70` | `     AND NOT EXISTS (` | Instrucción de ejecución en el contexto del script: `AND NOT EXISTS (`. |
| `71` | `         SELECT 1 FROM grupos g` | Instrucción de ejecución en el contexto del script: `SELECT 1 FROM grupos g`. |
| `72` | `         JOIN evidencias e ON e.id_grupo = g.id_grupo` | Instrucción de ejecución en el contexto del script: `JOIN evidencias e ON e.id_grupo = g.id_grupo`. |
| `73` | `         WHERE g.id_asignacion = a.id_asignacion` | Instrucción de ejecución en el contexto del script: `WHERE g.id_asignacion = a.id_asignacion`. |
| `74` | `     )` | Instrucción de ejecución en el contexto del script: `)`. |
| `75` | `     ORDER BY a.fecha_limite_evidencia DESC LIMIT 5"` | Instrucción de ejecución en el contexto del script: `ORDER BY a.fecha_limite_evidencia DESC LIMIT 5"`. |
| `76` | `)->fetchAll(PDO::FETCH_ASSOC);` | Obtiene todos los registros coincidentes de la consulta en un arreglo asociativo. |
| `77` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `78` | `require_once __DIR__ . '/../layouts/header.php';` | Importación e inclusión obligatoria del archivo de dependencia requerido: `require_once __DIR__ . '/../layouts/header.php';`. |
| `79` | `?>` | Cierre de la etiqueta PHP para alternar a salida HTML o fin del archivo. |
| `80` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `81` | `<?php if ($fichasConTurnoHoy > 0): ?>` | Instrucción de ejecución en el contexto del script: `<?php if ($fichasConTurnoHoy > 0): ?>`. |
| `82` | `<div class="alert border-0 shadow-sm mb-4 d-flex align-items-start gap-3"` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="alert border-0 shadow-sm mb-4 d-flex align-items-start gap-3"`. |
| `83` | `     style="background:#fff7ed; border-left:4px solid #f97316 !important; b...` | Instrucción de ejecución en el contexto del script: `style="background:#fff7ed; border-left:4px solid #f97316 !important; border-radius:10px;">`. |
| `84` | `    <i class="fas fa-calendar-day mt-1" style="color:#f97316; font-size:1.2...` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-calendar-day mt-1" style="color:#f97316; font-size:1.2rem; flex-shrink:0;"></i>`. |
| `85` | `    <div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div>`. |
| `86` | `        <div class="fw-bold" style="color:#9a3412;">Hoy hay <?= $fichasConT...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="fw-bold" style="color:#9a3412;">Hoy hay <?= $fichasConTurnoHoy ?> ficha(s) con turno de limpieza pendiente</div>`. |
| `87` | `        <div class="small text-muted">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="small text-muted">`. |
| `88` | `            Estas fichas deben subir su evidencia fotográfica antes de las ...` | Instrucción de ejecución en el contexto del script: `Estas fichas deben subir su evidencia fotográfica antes de las <strong>11:59 PM</strong>.`. |
| `89` | `            Revisa la sección de Evidencias para hacer seguimiento.` | Instrucción de ejecución en el contexto del script: `Revisa la sección de Evidencias para hacer seguimiento.`. |
| `90` | `        </div>` | Cierre de contenedor visual `<div>`. |
| `91` | `        <a href="admin_evidencias.php" class="btn btn-sm mt-2 fw-semibold"` | Enlace hipertexto de navegación o acción: `<a href="admin_evidencias.php" class="btn btn-sm mt-2 fw-semibold"`. |
| `92` | `           style="background:#f97316; color:#fff; border:none; border-radiu...` | Instrucción de ejecución en el contexto del script: `style="background:#f97316; color:#fff; border:none; border-radius:7px;">`. |
| `93` | `            <i class="fas fa-images me-1"></i>Ver evidencias` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-images me-1"></i>Ver evidencias`. |
| `94` | `        </a>` | Instrucción de ejecución en el contexto del script: `</a>`. |
| `95` | `    </div>` | Cierre de contenedor visual `<div>`. |
| `96` | `</div>` | Cierre de contenedor visual `<div>`. |
| `97` | `<?php endif; ?>` | Instrucción de ejecución en el contexto del script: `<?php endif; ?>`. |
| `98` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `99` | `<div class="d-flex justify-content-between align-items-center mb-4">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="d-flex justify-content-between align-items-center mb-4">`. |
| `100` | `    <div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div>`. |
| `101` | `        <h4 class="fw-bold mb-0"><i class="fas fa-border-all text-success m...` | Instrucción de ejecución en el contexto del script: `<h4 class="fw-bold mb-0"><i class="fas fa-border-all text-success me-2"></i>Dashboard</h4>`. |
| `102` | `        <p class="text-muted small mb-0">Resumen general del sistema – <?= ...` | Instrucción de ejecución en el contexto del script: `<p class="text-muted small mb-0">Resumen general del sistema – <?= date('d \d\e F, Y') ?></p>`. |
| `103` | `    </div>` | Cierre de contenedor visual `<div>`. |
| `104` | `</div>` | Cierre de contenedor visual `<div>`. |
| `105` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `106` | `<!-- ── STATS CARDS ── -->` | Instrucción de ejecución en el contexto del script: `<!-- ── STATS CARDS ── -->`. |
| `107` | `<div class="row g-3 mb-4">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="row g-3 mb-4">`. |
| `108` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `109` | `    <div class="col-sm-6 col-xl-3">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="col-sm-6 col-xl-3">`. |
| `110` | `        <div class="stat-card bg-white">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="stat-card bg-white">`. |
| `111` | `            <div class="d-flex align-items-center gap-3">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="d-flex align-items-center gap-3">`. |
| `112` | `                <div class="stat-icon" style="background:rgba(57,169,0,.12)...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="stat-icon" style="background:rgba(57,169,0,.12); color:#39a900;">`. |
| `113` | `                    <i class="fas fa-id-card"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-id-card"></i>`. |
| `114` | `                </div>` | Cierre de contenedor visual `<div>`. |
| `115` | `                <div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div>`. |
| `116` | `                    <div class="fs-4 fw-bold"><?= $totalFichas ?></div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="fs-4 fw-bold"><?= $totalFichas ?></div>`. |
| `117` | `                    <div class="text-muted small">Fichas Activas</div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="text-muted small">Fichas Activas</div>`. |
| `118` | `                </div>` | Cierre de contenedor visual `<div>`. |
| `119` | `            </div>` | Cierre de contenedor visual `<div>`. |
| `120` | `        </div>` | Cierre de contenedor visual `<div>`. |
| `121` | `    </div>` | Cierre de contenedor visual `<div>`. |
| `122` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `123` | `    <div class="col-sm-6 col-xl-3">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="col-sm-6 col-xl-3">`. |
| `124` | `        <div class="stat-card bg-white">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="stat-card bg-white">`. |
| `125` | `            <div class="d-flex align-items-center gap-3">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="d-flex align-items-center gap-3">`. |
| `126` | `                <div class="stat-icon" style="background:rgba(37,99,235,.1)...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="stat-icon" style="background:rgba(37,99,235,.1); color:#2563eb;">`. |
| `127` | `                    <i class="fas fa-user-tie"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-user-tie"></i>`. |
| `128` | `                </div>` | Cierre de contenedor visual `<div>`. |
| `129` | `                <div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div>`. |
| `130` | `                    <div class="fs-4 fw-bold"><?= $totalVoceros ?></div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="fs-4 fw-bold"><?= $totalVoceros ?></div>`. |
| `131` | `                    <div class="text-muted small">Voceros Registrados</div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="text-muted small">Voceros Registrados</div>`. |
| `132` | `                </div>` | Cierre de contenedor visual `<div>`. |
| `133` | `            </div>` | Cierre de contenedor visual `<div>`. |
| `134` | `        </div>` | Cierre de contenedor visual `<div>`. |
| `135` | `    </div>` | Cierre de contenedor visual `<div>`. |
| `136` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `137` | `    <div class="col-sm-6 col-xl-3">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="col-sm-6 col-xl-3">`. |
| `138` | `        <div class="stat-card bg-white">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="stat-card bg-white">`. |
| `139` | `            <div class="d-flex align-items-center gap-3">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="d-flex align-items-center gap-3">`. |
| `140` | `                <div class="stat-icon" style="background:rgba(234,179,8,.1)...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="stat-icon" style="background:rgba(234,179,8,.1); color:#d97706;">`. |
| `141` | `                    <i class="fas fa-door-open"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-door-open"></i>`. |
| `142` | `                </div>` | Cierre de contenedor visual `<div>`. |
| `143` | `                <div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div>`. |
| `144` | `                    <div class="fs-4 fw-bold"><?= $asignActivas ?></div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="fs-4 fw-bold"><?= $asignActivas ?></div>`. |
| `145` | `                    <div class="text-muted small">Asignaciones Activas</div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="text-muted small">Asignaciones Activas</div>`. |
| `146` | `                </div>` | Cierre de contenedor visual `<div>`. |
| `147` | `            </div>` | Cierre de contenedor visual `<div>`. |
| `148` | `        </div>` | Cierre de contenedor visual `<div>`. |
| `149` | `    </div>` | Cierre de contenedor visual `<div>`. |
| `150` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `151` | `    <div class="col-sm-6 col-xl-3">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="col-sm-6 col-xl-3">`. |
| `152` | `        <div class="stat-card bg-white">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="stat-card bg-white">`. |
| `153` | `            <div class="d-flex align-items-center gap-3">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="d-flex align-items-center gap-3">`. |
| `154` | `                <div class="stat-icon" style="background:rgba(239,68,68,.1)...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="stat-icon" style="background:rgba(239,68,68,.1); color:#ef4444;">`. |
| `155` | `                    <i class="fas fa-triangle-exclamation"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-triangle-exclamation"></i>`. |
| `156` | `                </div>` | Cierre de contenedor visual `<div>`. |
| `157` | `                <div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div>`. |
| `158` | `                    <div class="fs-4 fw-bold text-danger"><?= $incumplimien...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="fs-4 fw-bold text-danger"><?= $incumplimientos ?></div>`. |
| `159` | `                    <div class="text-muted small">Incumplimientos</div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="text-muted small">Incumplimientos</div>`. |
| `160` | `                </div>` | Cierre de contenedor visual `<div>`. |
| `161` | `            </div>` | Cierre de contenedor visual `<div>`. |
| `162` | `        </div>` | Cierre de contenedor visual `<div>`. |
| `163` | `    </div>` | Cierre de contenedor visual `<div>`. |
| `164` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `165` | `</div>` | Cierre de contenedor visual `<div>`. |
| `166` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `167` | `<!-- ── DOS COLUMNAS ── -->` | Instrucción de ejecución en el contexto del script: `<!-- ── DOS COLUMNAS ── -->`. |
| `168` | `<div class="row g-4">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="row g-4">`. |
| `169` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `170` | `    <!-- Últimas evidencias -->` | Instrucción de ejecución en el contexto del script: `<!-- Últimas evidencias -->`. |
| `171` | `    <div class="col-lg-7">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="col-lg-7">`. |
| `172` | `        <div class="card border-0 shadow-sm h-100">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="card border-0 shadow-sm h-100">`. |
| `173` | `            <div class="card-header bg-white border-0 py-3 d-flex justify-c...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="card-header bg-white border-0 py-3 d-flex justify-content-between align-items-center">`. |
| `174` | `                <h6 class="fw-bold mb-0"><i class="fas fa-images text-succe...` | Instrucción de ejecución en el contexto del script: `<h6 class="fw-bold mb-0"><i class="fas fa-images text-success me-2"></i>Últimas Evidencias</h6>`. |
| `175` | `                <a href="admin_evidencias.php" class="btn btn-sm btn-outlin...` | Enlace hipertexto de navegación o acción: `<a href="admin_evidencias.php" class="btn btn-sm btn-outline-success btn-sm">Ver todas</a>`. |
| `176` | `            </div>` | Cierre de contenedor visual `<div>`. |
| `177` | `            <div class="card-body p-0">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="card-body p-0">`. |
| `178` | `                <div class="table-responsive">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="table-responsive">`. |
| `179` | `                    <table class="table tabla-limpia align-middle mb-0">` | Tabla de datos para despliegue estructurado de información: `<table class="table tabla-limpia align-middle mb-0">`. |
| `180` | `                        <thead class="table-light">` | Celda de tabla con contenido de datos o encabezado de columna: `<thead class="table-light">`. |
| `181` | `                            <tr>` | Fila contenedora de datos dentro de la tabla. |
| `182` | `                                <th>Vocero</th>` | Celda de tabla con contenido de datos o encabezado de columna: `<th>Vocero</th>`. |
| `183` | `                                <th>Ficha</th>` | Celda de tabla con contenido de datos o encabezado de columna: `<th>Ficha</th>`. |
| `184` | `                                <th>Módulo</th>` | Celda de tabla con contenido de datos o encabezado de columna: `<th>Módulo</th>`. |
| `185` | `                                <th>Fecha</th>` | Celda de tabla con contenido de datos o encabezado de columna: `<th>Fecha</th>`. |
| `186` | `                                <th>✓</th>` | Celda de tabla con contenido de datos o encabezado de columna: `<th>✓</th>`. |
| `187` | `                            </tr>` | Fila contenedora de datos dentro de la tabla. |
| `188` | `                        </thead>` | Instrucción de ejecución en el contexto del script: `</thead>`. |
| `189` | `                        <tbody>` | Instrucción de ejecución en el contexto del script: `<tbody>`. |
| `190` | `                        <?php foreach ($ultimasEvidencias as $ev): ?>` | Instrucción de ejecución en el contexto del script: `<?php foreach ($ultimasEvidencias as $ev): ?>`. |
| `191` | `                        <tr>` | Fila contenedora de datos dentro de la tabla. |
| `192` | `                            <td class="small fw-semibold"><?= htmlspecialch...` | Celda de tabla con contenido de datos o encabezado de columna: `<td class="small fw-semibold"><?= htmlspecialchars($ev['vocero'] . ' ' . $ev['vocero_ap']) ?></td>`. |
| `193` | `                            <td><span class="badge bg-light text-dark borde...` | Celda de tabla con contenido de datos o encabezado de columna: `<td><span class="badge bg-light text-dark border"><?= htmlspecialchars($ev['numero_ficha']) ?></span></td>`. |
| `194` | `                            <td class="small"><?= htmlspecialchars($ev['mod...` | Celda de tabla con contenido de datos o encabezado de columna: `<td class="small"><?= htmlspecialchars($ev['modulo']) ?></td>`. |
| `195` | `                            <td class="small text-muted"><?= date('d/m/Y H:...` | Celda de tabla con contenido de datos o encabezado de columna: `<td class="small text-muted"><?= date('d/m/Y H:i', strtotime($ev['fecha_subida'])) ?></td>`. |
| `196` | `                            <td><span class="text-success fw-bold">✓</span>...` | Celda de tabla con contenido de datos o encabezado de columna: `<td><span class="text-success fw-bold">✓</span></td>`. |
| `197` | `                        </tr>` | Fila contenedora de datos dentro de la tabla. |
| `198` | `                        <?php endforeach; ?>` | Instrucción de ejecución en el contexto del script: `<?php endforeach; ?>`. |
| `199` | `                        <?php if (empty($ultimasEvidencias)): ?>` | Instrucción de ejecución en el contexto del script: `<?php if (empty($ultimasEvidencias)): ?>`. |
| `200` | `                        <tr><td colspan="5" class="text-center text-muted p...` | Fila contenedora de datos dentro de la tabla. |
| `201` | `                        <?php endif; ?>` | Instrucción de ejecución en el contexto del script: `<?php endif; ?>`. |
| `202` | `                        </tbody>` | Instrucción de ejecución en el contexto del script: `</tbody>`. |
| `203` | `                    </table>` | Tabla de datos para despliegue estructurado de información: `</table>`. |
| `204` | `                </div>` | Cierre de contenedor visual `<div>`. |
| `205` | `            </div>` | Cierre de contenedor visual `<div>`. |
| `206` | `        </div>` | Cierre de contenedor visual `<div>`. |
| `207` | `    </div>` | Cierre de contenedor visual `<div>`. |
| `208` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `209` | `    <!-- Incumplimientos recientes -->` | Instrucción de ejecución en el contexto del script: `<!-- Incumplimientos recientes -->`. |
| `210` | `    <div class="col-lg-5">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="col-lg-5">`. |
| `211` | `        <div class="card border-0 shadow-sm h-100" style="border-left: 3px ...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="card border-0 shadow-sm h-100" style="border-left: 3px solid #ef4444 !important;">`. |
| `212` | `            <div class="card-header bg-white border-0 py-3 d-flex justify-c...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="card-header bg-white border-0 py-3 d-flex justify-content-between align-items-center">`. |
| `213` | `                <h6 class="fw-bold mb-0 text-danger"><i class="fas fa-trian...` | Instrucción de ejecución en el contexto del script: `<h6 class="fw-bold mb-0 text-danger"><i class="fas fa-triangle-exclamation me-2"></i>Incumplimientos</h6>`. |
| `214` | `                <?php if ($incumplimientos > 0): ?>` | Instrucción de ejecución en el contexto del script: `<?php if ($incumplimientos > 0): ?>`. |
| `215` | `                    <span class="badge bg-danger"><?= $incumplimientos ?> t...` | Instrucción de ejecución en el contexto del script: `<span class="badge bg-danger"><?= $incumplimientos ?> total</span>`. |
| `216` | `                <?php endif; ?>` | Instrucción de ejecución en el contexto del script: `<?php endif; ?>`. |
| `217` | `            </div>` | Cierre de contenedor visual `<div>`. |
| `218` | `            <div class="card-body p-0">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="card-body p-0">`. |
| `219` | `                <?php if (empty($ultimosIncump)): ?>` | Instrucción de ejecución en el contexto del script: `<?php if (empty($ultimosIncump)): ?>`. |
| `220` | `                    <div class="text-center py-5 text-muted">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="text-center py-5 text-muted">`. |
| `221` | `                        <i class="fas fa-check-circle text-success fa-2x mb...` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-check-circle text-success fa-2x mb-2 d-block"></i>`. |
| `222` | `                        <span class="small">Sin incumplimientos activos</span>` | Instrucción de ejecución en el contexto del script: `<span class="small">Sin incumplimientos activos</span>`. |
| `223` | `                    </div>` | Cierre de contenedor visual `<div>`. |
| `224` | `                <?php else: ?>` | Instrucción de ejecución en el contexto del script: `<?php else: ?>`. |
| `225` | `                    <ul class="list-group list-group-flush">` | Instrucción de ejecución en el contexto del script: `<ul class="list-group list-group-flush">`. |
| `226` | `                    <?php foreach ($ultimosIncump as $inc): ?>` | Instrucción de ejecución en el contexto del script: `<?php foreach ($ultimosIncump as $inc): ?>`. |
| `227` | `                        <li class="list-group-item border-0 py-3">` | Instrucción de ejecución en el contexto del script: `<li class="list-group-item border-0 py-3">`. |
| `228` | `                            <div class="d-flex justify-content-between alig...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="d-flex justify-content-between align-items-start">`. |
| `229` | `                                <div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div>`. |
| `230` | `                                    <div class="fw-semibold small">Ficha <?...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="fw-semibold small">Ficha <?= htmlspecialchars($inc['numero_ficha']) ?> – <?= htmlspecialchars($inc['modulo']) ?></div>`. |
| `231` | `                                    <div class="text-muted" style="font-siz...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="text-muted" style="font-size:.78rem;">`. |
| `232` | `                                        Vocero: <?= htmlspecialchars($inc['...` | Instrucción de ejecución en el contexto del script: `Vocero: <?= htmlspecialchars($inc['vocero'] . ' ' . $inc['vocero_ap']) ?>`. |
| `233` | `                                    </div>` | Cierre de contenedor visual `<div>`. |
| `234` | `                                    <div class="text-muted" style="font-siz...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="text-muted" style="font-size:.75rem;">`. |
| `235` | `                                        Venció: <?= date('d/m/Y H:i', strto...` | Instrucción de ejecución en el contexto del script: `Venció: <?= date('d/m/Y H:i', strtotime($inc['fecha_limite_evidencia'])) ?>`. |
| `236` | `                                    </div>` | Cierre de contenedor visual `<div>`. |
| `237` | `                                </div>` | Cierre de contenedor visual `<div>`. |
| `238` | `                                <span class="badge bg-danger-subtle text-da...` | Instrucción de ejecución en el contexto del script: `<span class="badge bg-danger-subtle text-danger border border-danger-subtle">Vencido</span>`. |
| `239` | `                            </div>` | Cierre de contenedor visual `<div>`. |
| `240` | `                        </li>` | Instrucción de ejecución en el contexto del script: `</li>`. |
| `241` | `                    <?php endforeach; ?>` | Instrucción de ejecución en el contexto del script: `<?php endforeach; ?>`. |
| `242` | `                    </ul>` | Instrucción de ejecución en el contexto del script: `</ul>`. |
| `243` | `                <?php endif; ?>` | Instrucción de ejecución en el contexto del script: `<?php endif; ?>`. |
| `244` | `            </div>` | Cierre de contenedor visual `<div>`. |
| `245` | `        </div>` | Cierre de contenedor visual `<div>`. |
| `246` | `    </div>` | Cierre de contenedor visual `<div>`. |
| `247` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `248` | `</div>` | Cierre de contenedor visual `<div>`. |
| `249` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `250` | `<!-- Stats secundarias -->` | Instrucción de ejecución en el contexto del script: `<!-- Stats secundarias -->`. |
| `251` | `<div class="row g-3 mt-2">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="row g-3 mt-2">`. |
| `252` | `    <div class="col-sm-6 col-lg-3">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="col-sm-6 col-lg-3">`. |
| `253` | `        <div class="card border-0 shadow-sm text-center py-3 px-2">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="card border-0 shadow-sm text-center py-3 px-2">`. |
| `254` | `            <div class="text-success fw-bold fs-3"><?= $evMes ?></div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="text-success fw-bold fs-3"><?= $evMes ?></div>`. |
| `255` | `            <div class="text-muted small">Evidencias este mes</div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="text-muted small">Evidencias este mes</div>`. |
| `256` | `        </div>` | Cierre de contenedor visual `<div>`. |
| `257` | `    </div>` | Cierre de contenedor visual `<div>`. |
| `258` | `    <div class="col-sm-6 col-lg-3">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="col-sm-6 col-lg-3">`. |
| `259` | `        <div class="card border-0 shadow-sm text-center py-3 px-2">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="card border-0 shadow-sm text-center py-3 px-2">`. |
| `260` | `            <div class="fw-bold fs-3"><?= $totalModulos ?></div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="fw-bold fs-3"><?= $totalModulos ?></div>`. |
| `261` | `            <div class="text-muted small">Módulos registrados</div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="text-muted small">Módulos registrados</div>`. |
| `262` | `        </div>` | Cierre de contenedor visual `<div>`. |
| `263` | `    </div>` | Cierre de contenedor visual `<div>`. |
| `264` | `</div>` | Cierre de contenedor visual `<div>`. |
| `265` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `266` | `<?php if ($alert): ?>` | Instrucción de ejecución en el contexto del script: `<?php if ($alert): ?>`. |
| `267` | `<script>` | Bloque o etiqueta de vinculación para scripts JavaScript del lado del cliente. |
| `268` | `document.addEventListener('DOMContentLoaded', function() {` | Instrucción de ejecución en el contexto del script: `document.addEventListener('DOMContentLoaded', function() {`. |
| `269` | `    Swal.fire({` | Instrucción de ejecución en el contexto del script: `Swal.fire({`. |
| `270` | `        icon:  '<?= addslashes($alert['icon']) ?>',` | Instrucción de ejecución en el contexto del script: `icon:  '<?= addslashes($alert['icon']) ?>',`. |
| `271` | `        title: '<?= addslashes($alert['title']) ?>',` | Instrucción de ejecución en el contexto del script: `title: '<?= addslashes($alert['title']) ?>',`. |
| `272` | `        text:  '<?= addslashes($alert['text']) ?>',` | Instrucción de ejecución en el contexto del script: `text:  '<?= addslashes($alert['text']) ?>',`. |
| `273` | `        confirmButtonColor: '#39a900',` | Instrucción de ejecución en el contexto del script: `confirmButtonColor: '#39a900',`. |
| `274` | `        background: '#fff'` | Instrucción de ejecución en el contexto del script: `background: '#fff'`. |
| `275` | `    });` | Instrucción de ejecución en el contexto del script: `});`. |
| `276` | `});` | Instrucción de ejecución en el contexto del script: `});`. |
| `277` | `</script>` | Bloque o etiqueta de vinculación para scripts JavaScript del lado del cliente. |
| `278` | `<?php endif; ?>` | Instrucción de ejecución en el contexto del script: `<?php endif; ?>`. |
| `279` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `280` | `<?php require_once __DIR__ . '/../layouts/footer.php'; ?>` | Instrucción de ejecución en el contexto del script: `<?php require_once __DIR__ . '/../layouts/footer.php'; ?>`. |

---

## 3. Resumen y Flujo de Interacción

El archivo `admin_dashboard.php` cumple un rol indispensable en `views/dashboard/admin_dashboard.php`. 
Panel principal del administrador con tarjetas de estadísticas, resúmenes de turnos, gráficas de cumplimiento y accesos directos. Garantiza la robustez, el orden y la estabilidad de la arquitectura del proyecto `systemLimpieza`.
