# Documentación Línea por Línea: `views/dashboard/vocero_evidencias.php`

## 1. Ficha Técnica del Archivo

- **Archivo:** `vocero_evidencias.php`
- **Ruta en el proyecto:** `views/dashboard/vocero_evidencias.php`
- **Cantidad total de líneas:** `385`
- **Tipo de archivo:** `PHP`
- **Propósito general:** Calendario mensual y modal de evidencias de limpieza subidas por el vocero con estado en tiempo real.

---

## 2. Explicación Detallada Línea por Línea

A continuación se presenta cada línea de código numerada de forma consecutiva, acompañada de su fragmento exacto y la explicación exhaustiva de su funcionamiento y responsabilidad en el sistema:

| Línea | Código Fuente | Explicación Detallada |
|---|---|---|
| `1` | ``<?php`` | Apertura obligatoria de la etiqueta PHP para ejecución del código del lado del servidor. |
| `2` | `$titulo = 'Historial de Evidencias';` | Instrucción de ejecución en el contexto del script: `$titulo = 'Historial de Evidencias';`. |
| `3` | `if (session_status() === PHP_SESSION_NONE) session_start();` | Inicia o reanuda la sesión PHP del usuario si no se encontraba activa previamente. |
| `4` | `if (!isset($_SESSION['usuario']) \|\| (int)$_SESSION['usuario']['rol'] !...` | Verifica autenticación y rol del usuario; redirige al login si no tiene permisos. |
| `5` | `header("Location: ../usuarios/login.php"); exit;` | Emite cabecera HTTP de redirección en el navegador y detiene la ejecución: `header("Location: ../usuarios/login.php"); exit;`. |
| `6` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `7` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `8` | `require_once __DIR__ . '/../../config/database.php';` | Importación e inclusión obligatoria del archivo de dependencia requerido: `require_once __DIR__ . '/../../config/database.php';`. |
| `9` | `require_once __DIR__ . '/../../models/Evidencia.php';` | Importación e inclusión obligatoria del archivo de dependencia requerido: `require_once __DIR__ . '/../../models/Evidencia.php';`. |
| `10` | `require_once __DIR__ . '/../../models/Grupo.php';` | Importación e inclusión obligatoria del archivo de dependencia requerido: `require_once __DIR__ . '/../../models/Grupo.php';`. |
| `11` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `12` | `$db    = (new Database())->conectar();` | Instrucción de ejecución en el contexto del script: `$db    = (new Database())->conectar();`. |
| `13` | `$alert = $_SESSION['alert'] ?? null;` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección. |
| `14` | `unset($_SESSION['alert']);` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección. |
| `15` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `16` | `$idUsuario = (int)$_SESSION['usuario']['id_usuario'];` | Instrucción de ejecución en el contexto del script: `$idUsuario = (int)$_SESSION['usuario']['id_usuario'];`. |
| `17` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `18` | `// Vocero` | Comentario explicativo en el código: `Vocero`. |
| `19` | `$stmtV = $db->prepare("SELECT * FROM voceros WHERE id_usuario = :id AND ...` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmtV = $db->prepare("SELECT * FROM voceros WHERE id_usuario = :id AND ...`. |
| `20` | `$stmtV->execute([':id' => $idUsuario]);` | Ejecuta la sentencia SQL preparada vinculando los parámetros correspondientes: `$stmtV->execute([':id' => $idUsuario]);`. |
| `21` | `$vocero   = $stmtV->fetch(PDO::FETCH_ASSOC);` | Recupera una única fila o registro resultante de la consulta. |
| `22` | `$idVocero = $vocero ? (int)$vocero['id_vocero'] : 0;` | Instrucción de ejecución en el contexto del script: `$idVocero = $vocero ? (int)$vocero['id_vocero'] : 0;`. |
| `23` | `$idFicha  = $vocero ? (int)$vocero['id_ficha']  : 0;` | Instrucción de ejecución en el contexto del script: `$idFicha  = $vocero ? (int)$vocero['id_ficha']  : 0;`. |
| `24` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `25` | `// Todos los turnos de la ficha (pasados y futuros)` | Comentario explicativo en el código: `Todos los turnos de la ficha (pasados y futuros)`. |
| `26` | `// con info de evidencias y grupo` | Comentario explicativo en el código: `con info de evidencias y grupo`. |
| `27` | `$stmtTurnos = $db->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmtTurnos = $db->prepare(`. |
| `28` | `"SELECT` | Instrucción de ejecución en el contexto del script: `"SELECT`. |
| `29` | `t.fecha_turno,` | Instrucción de ejecución en el contexto del script: `t.fecha_turno,`. |
| `30` | `t.id_turno,` | Instrucción de ejecución en el contexto del script: `t.id_turno,`. |
| `31` | `t.estado        AS turno_estado,` | Instrucción de ejecución en el contexto del script: `t.estado        AS turno_estado,`. |
| `32` | `g.id_grupo,` | Instrucción de ejecución en el contexto del script: `g.id_grupo,`. |
| `33` | `g.nombre_grupo,` | Instrucción de ejecución en el contexto del script: `g.nombre_grupo,`. |
| `34` | `m.nombre        AS nombre_modulo,` | Instrucción de ejecución en el contexto del script: `m.nombre        AS nombre_modulo,`. |
| `35` | `(SELECT COUNT(DISTINCT e.tipo)` | Instrucción de ejecución en el contexto del script: `(SELECT COUNT(DISTINCT e.tipo)`. |
| `36` | `FROM evidencias e` | Instrucción de ejecución en el contexto del script: `FROM evidencias e`. |
| `37` | `WHERE e.id_turno = t.id_turno` | Instrucción de ejecución en el contexto del script: `WHERE e.id_turno = t.id_turno`. |
| `38` | `AND e.tipo IN ('antes','despues')) AS fotos_subidas` | Instrucción de ejecución en el contexto del script: `AND e.tipo IN ('antes','despues')) AS fotos_subidas`. |
| `39` | `FROM turnos t` | Instrucción de ejecución en el contexto del script: `FROM turnos t`. |
| `40` | `JOIN asignaciones a ON a.id_asignacion = t.id_asignacion` | Instrucción de ejecución en el contexto del script: `JOIN asignaciones a ON a.id_asignacion = t.id_asignacion`. |
| `41` | `JOIN modulos m      ON m.id_modulo     = a.id_modulo` | Instrucción de ejecución en el contexto del script: `JOIN modulos m      ON m.id_modulo     = a.id_modulo`. |
| `42` | `LEFT JOIN grupos g  ON g.id_grupo      = t.id_grupo` | Instrucción de ejecución en el contexto del script: `LEFT JOIN grupos g  ON g.id_grupo      = t.id_grupo`. |
| `43` | `WHERE a.id_ficha = :fic` | Instrucción de ejecución en el contexto del script: `WHERE a.id_ficha = :fic`. |
| `44` | `ORDER BY t.fecha_turno ASC"` | Instrucción de ejecución en el contexto del script: `ORDER BY t.fecha_turno ASC"`. |
| `45` | ``);`` | Cierre de estructura de arreglo o invocación de función. |
| `46` | `$stmtTurnos->execute([':fic' => $idFicha]);` | Ejecuta la sentencia SQL preparada vinculando los parámetros correspondientes: `$stmtTurnos->execute([':fic' => $idFicha]);`. |
| `47` | `$turnos = $stmtTurnos->fetchAll(PDO::FETCH_ASSOC);` | Obtiene todos los registros coincidentes de la consulta en un arreglo asociativo. |
| `48` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `49` | `$hoy = date('Y-m-d');` | Instrucción de ejecución en el contexto del script: `$hoy = date('Y-m-d');`. |
| `50` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `51` | `// Construir eventos para FullCalendar` | Comentario explicativo en el código: `Construir eventos para FullCalendar`. |
| `52` | `$eventos = [];` | Instrucción de ejecución en el contexto del script: `$eventos = [];`. |
| `53` | `foreach ($turnos as $t) {` | Estructura de control iterativa para recorrer colecciones o arreglos: `foreach ($turnos as $t) {`. |
| `54` | `$fecha      = $t['fecha_turno'];` | Instrucción de ejecución en el contexto del script: `$fecha      = $t['fecha_turno'];`. |
| `55` | `$esPasado   = $fecha < $hoy;` | Instrucción de ejecución en el contexto del script: `$esPasado   = $fecha < $hoy;`. |
| `56` | `$esHoy      = $fecha === $hoy;` | Instrucción de ejecución en el contexto del script: `$esHoy      = $fecha === $hoy;`. |
| `57` | `$tieneEv    = (int)$t['fotos_subidas'] >= 2;` | Instrucción de ejecución en el contexto del script: `$tieneEv    = (int)$t['fotos_subidas'] >= 2;`. |
| `58` | `$sinGrupo   = empty($t['id_grupo']);` | Instrucción de ejecución en el contexto del script: `$sinGrupo   = empty($t['id_grupo']);`. |
| `59` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `60` | `if ($tieneEv) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if ($tieneEv) {`. |
| `61` | `// Verde — evidencias entregadas` | Comentario explicativo en el código: `Verde — evidencias entregadas`. |
| `62` | `$color      = '#16a34a';` | Instrucción de ejecución en el contexto del script: `$color      = '#16a34a';`. |
| `63` | `$textColor  = '#fff';` | Instrucción de ejecución en el contexto del script: `$textColor  = '#fff';`. |
| `64` | `$estado     = 'entregada';` | Instrucción de ejecución en el contexto del script: `$estado     = 'entregada';`. |
| `65` | `} elseif ($esPasado \|\| $esHoy) {` | Evaluación condicional alternativa `elseif`: `} elseif ($esPasado \|\| $esHoy) {`. |
| `66` | `if ($sinGrupo) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if ($sinGrupo) {`. |
| `67` | `// Gris — pasado sin grupo asignado` | Comentario explicativo en el código: `Gris — pasado sin grupo asignado`. |
| `68` | `$color     = '#9ca3af';` | Instrucción de ejecución en el contexto del script: `$color     = '#9ca3af';`. |
| `69` | `$textColor = '#fff';` | Instrucción de ejecución en el contexto del script: `$textColor = '#fff';`. |
| `70` | `$estado    = 'sin_grupo';` | Instrucción de ejecución en el contexto del script: `$estado    = 'sin_grupo';`. |
| `71` | `} else {` | Instrucción de ejecución en el contexto del script: `} else {`. |
| `72` | `// Rojo — venció sin evidencia` | Comentario explicativo en el código: `Rojo — venció sin evidencia`. |
| `73` | `$color     = '#ef4444';` | Instrucción de ejecución en el contexto del script: `$color     = '#ef4444';`. |
| `74` | `$textColor = '#fff';` | Instrucción de ejecución en el contexto del script: `$textColor = '#fff';`. |
| `75` | `$estado    = 'vencida';` | Instrucción de ejecución en el contexto del script: `$estado    = 'vencida';`. |
| `76` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `77` | `} else {` | Instrucción de ejecución en el contexto del script: `} else {`. |
| `78` | `// Gris claro — fecha futura` | Comentario explicativo en el código: `Gris claro — fecha futura`. |
| `79` | `$color     = '#d1d5db';` | Instrucción de ejecución en el contexto del script: `$color     = '#d1d5db';`. |
| `80` | `$textColor = '#374151';` | Instrucción de ejecución en el contexto del script: `$textColor = '#374151';`. |
| `81` | `$estado    = 'proxima';` | Instrucción de ejecución en el contexto del script: `$estado    = 'proxima';`. |
| `82` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `83` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `84` | `$titulo_ev = $t['nombre_grupo'] ?? ($t['nombre_modulo'] ?? 'Limpieza');` | Instrucción de ejecución en el contexto del script: `$titulo_ev = $t['nombre_grupo'] ?? ($t['nombre_modulo'] ?? 'Limpieza');`. |
| `85` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `86` | `$eventos[] = [` | Instrucción de ejecución en el contexto del script: `$eventos[] = [`. |
| `87` | `'id'         => $t['id_turno'],` | Instrucción de ejecución en el contexto del script: `'id'         => $t['id_turno'],`. |
| `88` | `'title'      => $titulo_ev,` | Instrucción de ejecución en el contexto del script: `'title'      => $titulo_ev,`. |
| `89` | `'start'      => $fecha,` | Instrucción de ejecución en el contexto del script: `'start'      => $fecha,`. |
| `90` | `'color'      => $color,` | Instrucción de ejecución en el contexto del script: `'color'      => $color,`. |
| `91` | `'textColor'  => $textColor,` | Instrucción de ejecución en el contexto del script: `'textColor'  => $textColor,`. |
| `92` | `'extendedProps' => [` | Instrucción de ejecución en el contexto del script: `'extendedProps' => [`. |
| `93` | `'estado'        => $estado,` | Instrucción de ejecución en el contexto del script: `'estado'        => $estado,`. |
| `94` | `'id_turno'      => $t['id_turno'],` | Instrucción de ejecución en el contexto del script: `'id_turno'      => $t['id_turno'],`. |
| `95` | `'id_grupo'      => $t['id_grupo'],` | Instrucción de ejecución en el contexto del script: `'id_grupo'      => $t['id_grupo'],`. |
| `96` | `'nombre_grupo'  => $t['nombre_grupo']  ?? '',` | Instrucción de ejecución en el contexto del script: `'nombre_grupo'  => $t['nombre_grupo']  ?? '',`. |
| `97` | `'nombre_modulo' => $t['nombre_modulo'] ?? '',` | Instrucción de ejecución en el contexto del script: `'nombre_modulo' => $t['nombre_modulo'] ?? '',`. |
| `98` | `'fotos'         => (int)$t['fotos_subidas'],` | Instrucción de ejecución en el contexto del script: `'fotos'         => (int)$t['fotos_subidas'],`. |
| `99` | `],` | Instrucción de ejecución en el contexto del script: `],`. |
| `100` | ``];`` | Cierre de estructura de arreglo o invocación de función. |
| `101` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `102` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `103` | `// Evidencias por turno (para el modal al hacer clic)` | Comentario explicativo en el código: `Evidencias por turno (para el modal al hacer clic)`. |
| `104` | `// Se cargan vía AJAX desde VoceroController` | Comentario explicativo en el código: `Se cargan vía AJAX desde VoceroController`. |
| `105` | `require_once __DIR__ . '/../layouts/header.php';` | Importación e inclusión obligatoria del archivo de dependencia requerido: `require_once __DIR__ . '/../layouts/header.php';`. |
| `106` | ``?>`` | Cierre de la etiqueta PHP para alternar a salida HTML o fin del archivo. |
| `107` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `108` | `<div class="d-flex justify-content-between align-items-start mb-4">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="d-flex justify-content-between align-items-start mb-4">`. |
| `109` | `<div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div>`. |
| `110` | `<h4 class="fw-bold mb-0">` | Instrucción de ejecución en el contexto del script: `<h4 class="fw-bold mb-0">`. |
| `111` | `<i class="fas fa-calendar-days text-success me-2"></i>Historial de Evide...` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-calendar-days text-success me-2"></i>Historial de Evide...`. |
| `112` | `</h4>` | Instrucción de ejecución en el contexto del script: `</h4>`. |
| `113` | `<p class="text-muted small mb-0">` | Instrucción de ejecución en el contexto del script: `<p class="text-muted small mb-0">`. |
| `114` | `Calendario de limpiezas — haz clic en una fecha para ver las evidencias` | Instrucción de ejecución en el contexto del script: `Calendario de limpiezas — haz clic en una fecha para ver las evidencias`. |
| `115` | `</p>` | Instrucción de ejecución en el contexto del script: `</p>`. |
| `116` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `117` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `118` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `119` | `<!-- Leyenda -->` | Instrucción de ejecución en el contexto del script: `<!-- Leyenda -->`. |
| `120` | `<div class="d-flex gap-3 flex-wrap mb-3" style="font-size:.8rem;">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="d-flex gap-3 flex-wrap mb-3" style="font-size:.8rem;">`. |
| `121` | `<span class="d-flex align-items-center gap-1">` | Instrucción de ejecución en el contexto del script: `<span class="d-flex align-items-center gap-1">`. |
| `122` | `<span style="width:14px;height:14px;border-radius:4px;background:#16a34a...` | Instrucción de ejecución en el contexto del script: `<span style="width:14px;height:14px;border-radius:4px;background:#16a34a...`. |
| `123` | `Evidencia entregada` | Instrucción de ejecución en el contexto del script: `Evidencia entregada`. |
| `124` | `</span>` | Instrucción de ejecución en el contexto del script: `</span>`. |
| `125` | `<span class="d-flex align-items-center gap-1">` | Instrucción de ejecución en el contexto del script: `<span class="d-flex align-items-center gap-1">`. |
| `126` | `<span style="width:14px;height:14px;border-radius:4px;background:#ef4444...` | Instrucción de ejecución en el contexto del script: `<span style="width:14px;height:14px;border-radius:4px;background:#ef4444...`. |
| `127` | `Vencida sin evidencia` | Instrucción de ejecución en el contexto del script: `Vencida sin evidencia`. |
| `128` | `</span>` | Instrucción de ejecución en el contexto del script: `</span>`. |
| `129` | `<span class="d-flex align-items-center gap-1">` | Instrucción de ejecución en el contexto del script: `<span class="d-flex align-items-center gap-1">`. |
| `130` | `<span style="width:14px;height:14px;border-radius:4px;background:#d1d5db...` | Instrucción de ejecución en el contexto del script: `<span style="width:14px;height:14px;border-radius:4px;background:#d1d5db...`. |
| `131` | `Próxima limpieza` | Instrucción de ejecución en el contexto del script: `Próxima limpieza`. |
| `132` | `</span>` | Instrucción de ejecución en el contexto del script: `</span>`. |
| `133` | `<span class="d-flex align-items-center gap-1">` | Instrucción de ejecución en el contexto del script: `<span class="d-flex align-items-center gap-1">`. |
| `134` | `<span style="width:14px;height:14px;border-radius:4px;background:#9ca3af...` | Instrucción de ejecución en el contexto del script: `<span style="width:14px;height:14px;border-radius:4px;background:#9ca3af...`. |
| `135` | `Sin grupo asignado` | Instrucción de ejecución en el contexto del script: `Sin grupo asignado`. |
| `136` | `</span>` | Instrucción de ejecución en el contexto del script: `</span>`. |
| `137` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `138` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `139` | `<!-- Calendario -->` | Instrucción de ejecución en el contexto del script: `<!-- Calendario -->`. |
| `140` | `<div class="card border-0 shadow-sm" style="border-radius:14px;overflow:...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="card border-0 shadow-sm" style="border-radius:14px;overflow:...`. |
| `141` | `<div class="card-body p-3 p-md-4">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="card-body p-3 p-md-4">`. |
| `142` | `<div id="calendario"></div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div id="calendario"></div>`. |
| `143` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `144` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `145` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `146` | `<!-- Modal detalle del día -->` | Instrucción de ejecución en el contexto del script: `<!-- Modal detalle del día -->`. |
| `147` | `<div class="modal fade" id="modalDia" tabindex="-1" aria-hidden="true">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="modal fade" id="modalDia" tabindex="-1" aria-hidden="true">`. |
| `148` | `<div class="modal-dialog modal-dialog-centered modal-lg">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="modal-dialog modal-dialog-centered modal-lg">`. |
| `149` | `<div class="modal-content border-0 shadow">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="modal-content border-0 shadow">`. |
| `150` | `<div class="modal-header border-0" style="background:#0f2200;color:#fff;">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="modal-header border-0" style="background:#0f2200;color:#fff;">`. |
| `151` | `<div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div>`. |
| `152` | `<h6 class="modal-title fw-bold mb-0" id="modalDiaTitulo">` | Instrucción de ejecución en el contexto del script: `<h6 class="modal-title fw-bold mb-0" id="modalDiaTitulo">`. |
| `153` | `<i class="fas fa-calendar-day me-2 text-success"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-calendar-day me-2 text-success"></i>`. |
| `154` | `</h6>` | Instrucción de ejecución en el contexto del script: `</h6>`. |
| `155` | `<div class="small mt-1 opacity-75" id="modalDiaSub"></div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="small mt-1 opacity-75" id="modalDiaSub"></div>`. |
| `156` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `157` | `<button type="button" class="btn-close btn-close-white" data-bs-dismiss=...` | Botón de acción interactivo para el usuario: `<button type="button" class="btn-close btn-close-white" data-bs-dismiss=...`. |
| `158` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `159` | `<div class="modal-body p-0" id="modalDiaCuerpo">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="modal-body p-0" id="modalDiaCuerpo">`. |
| `160` | `<div class="text-center py-5 text-muted">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="text-center py-5 text-muted">`. |
| `161` | `<i class="fas fa-spinner fa-spin fa-lg d-block mb-2"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-spinner fa-spin fa-lg d-block mb-2"></i>`. |
| `162` | `Cargando…` | Instrucción de ejecución en el contexto del script: `Cargando…`. |
| `163` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `164` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `165` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `166` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `167` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `168` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `169` | `<!-- FullCalendar -->` | Instrucción de ejecución en el contexto del script: `<!-- FullCalendar -->`. |
| `170` | `<link  href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.glob...` | Vinculación de hoja de estilos o recurso externo: `<link  href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.glob...`. |
| `171` | ``<script>`` | Bloque o etiqueta de vinculación para scripts JavaScript del lado del cliente. |
| `172` | ``<script>`` | Bloque o etiqueta de vinculación para scripts JavaScript del lado del cliente. |
| `173` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `174` | ``<style>`` | Bloque de estilos CSS personalizados para la interfaz. |
| `175` | `/* ── FullCalendar overrides ── */` | Comentario multilínea de documentación o aclaración técnica. |
| `176` | `#calendario { font-family: inherit; }` | Comentario explicativo en el código: `calendario { font-family: inherit; }`. |
| `177` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `178` | `.fc .fc-toolbar-title {` | Instrucción de ejecución en el contexto del script: `.fc .fc-toolbar-title {`. |
| `179` | `font-size: 1.1rem;` | Instrucción de ejecución en el contexto del script: `font-size: 1.1rem;`. |
| `180` | `font-weight: 700;` | Instrucción de ejecución en el contexto del script: `font-weight: 700;`. |
| `181` | `color: #111827;` | Instrucción de ejecución en el contexto del script: `color: #111827;`. |
| `182` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `183` | `.fc .fc-button {` | Instrucción de ejecución en el contexto del script: `.fc .fc-button {`. |
| `184` | `background: #39a900 !important;` | Instrucción de ejecución en el contexto del script: `background: #39a900 !important;`. |
| `185` | `border-color: #39a900 !important;` | Instrucción de ejecución en el contexto del script: `border-color: #39a900 !important;`. |
| `186` | `font-size: .82rem !important;` | Instrucción de ejecución en el contexto del script: `font-size: .82rem !important;`. |
| `187` | `padding: .3rem .75rem !important;` | Instrucción de ejecución en el contexto del script: `padding: .3rem .75rem !important;`. |
| `188` | `border-radius: 7px !important;` | Instrucción de ejecución en el contexto del script: `border-radius: 7px !important;`. |
| `189` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `190` | `.fc .fc-button:hover { background: #2d8400 !important; border-color: #2d...` | Instrucción de ejecución en el contexto del script: `.fc .fc-button:hover { background: #2d8400 !important; border-color: #2d...`. |
| `191` | `.fc .fc-button-active { background: #2d8400 !important; }` | Instrucción de ejecución en el contexto del script: `.fc .fc-button-active { background: #2d8400 !important; }`. |
| `192` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `193` | `.fc .fc-daygrid-day-number {` | Instrucción de ejecución en el contexto del script: `.fc .fc-daygrid-day-number {`. |
| `194` | `font-size: .82rem;` | Instrucción de ejecución en el contexto del script: `font-size: .82rem;`. |
| `195` | `font-weight: 600;` | Instrucción de ejecución en el contexto del script: `font-weight: 600;`. |
| `196` | `color: #374151;` | Instrucción de ejecución en el contexto del script: `color: #374151;`. |
| `197` | `padding: .3rem .5rem;` | Instrucción de ejecución en el contexto del script: `padding: .3rem .5rem;`. |
| `198` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `199` | `.fc .fc-day-today { background: rgba(57,169,0,.06) !important; }` | Instrucción de ejecución en el contexto del script: `.fc .fc-day-today { background: rgba(57,169,0,.06) !important; }`. |
| `200` | `.fc .fc-day-today .fc-daygrid-day-number { color: #39a900; }` | Instrucción de ejecución en el contexto del script: `.fc .fc-day-today .fc-daygrid-day-number { color: #39a900; }`. |
| `201` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `202` | `.fc-event {` | Instrucción de ejecución en el contexto del script: `.fc-event {`. |
| `203` | `border-radius: 6px !important;` | Instrucción de ejecución en el contexto del script: `border-radius: 6px !important;`. |
| `204` | `border: none !important;` | Instrucción de ejecución en el contexto del script: `border: none !important;`. |
| `205` | `font-size: .75rem !important;` | Instrucción de ejecución en el contexto del script: `font-size: .75rem !important;`. |
| `206` | `font-weight: 600 !important;` | Instrucción de ejecución en el contexto del script: `font-weight: 600 !important;`. |
| `207` | `padding: .1rem .35rem !important;` | Instrucción de ejecución en el contexto del script: `padding: .1rem .35rem !important;`. |
| `208` | `cursor: pointer !important;` | Instrucción de ejecución en el contexto del script: `cursor: pointer !important;`. |
| `209` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `210` | `.fc-daygrid-event-dot { display: none !important; }` | Instrucción de ejecución en el contexto del script: `.fc-daygrid-event-dot { display: none !important; }`. |
| `211` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `212` | `/* Par de fotos en modal */` | Comentario multilínea de documentación o aclaración técnica. |
| `213` | `.par-modal {` | Instrucción de ejecución en el contexto del script: `.par-modal {`. |
| `214` | `display: grid;` | Instrucción de ejecución en el contexto del script: `display: grid;`. |
| `215` | `grid-template-columns: 1fr 1fr;` | Instrucción de ejecución en el contexto del script: `grid-template-columns: 1fr 1fr;`. |
| `216` | `gap: .75rem;` | Instrucción de ejecución en el contexto del script: `gap: .75rem;`. |
| `217` | `padding: 1.25rem;` | Instrucción de ejecución en el contexto del script: `padding: 1.25rem;`. |
| `218` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `219` | `@media (max-width: 500px) { .par-modal { grid-template-columns: 1fr; } }` | Instrucción de ejecución en el contexto del script: `@media (max-width: 500px) { .par-modal { grid-template-columns: 1fr; } }`. |
| `220` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `221` | `.foto-modal { position: relative; border-radius: 10px; overflow: hidden; }` | Instrucción de ejecución en el contexto del script: `.foto-modal { position: relative; border-radius: 10px; overflow: hidden; }`. |
| `222` | `.foto-modal img {` | Instrucción de ejecución en el contexto del script: `.foto-modal img {`. |
| `223` | `width: 100%; height: 220px; object-fit: cover; display: block;` | Instrucción de ejecución en el contexto del script: `width: 100%; height: 220px; object-fit: cover; display: block;`. |
| `224` | `cursor: pointer; transition: transform .3s;` | Instrucción de ejecución en el contexto del script: `cursor: pointer; transition: transform .3s;`. |
| `225` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `226` | `.foto-modal:hover img { transform: scale(1.03); }` | Instrucción de ejecución en el contexto del script: `.foto-modal:hover img { transform: scale(1.03); }`. |
| `227` | `.foto-label {` | Instrucción de ejecución en el contexto del script: `.foto-label {`. |
| `228` | `position: absolute; top: .5rem; left: .5rem;` | Instrucción de ejecución en el contexto del script: `position: absolute; top: .5rem; left: .5rem;`. |
| `229` | `padding: .18rem .55rem; border-radius: 20px;` | Instrucción de ejecución en el contexto del script: `padding: .18rem .55rem; border-radius: 20px;`. |
| `230` | `font-size: .7rem; font-weight: 700;` | Instrucción de ejecución en el contexto del script: `font-size: .7rem; font-weight: 700;`. |
| `231` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `232` | `.label-antes   { background: rgba(234,179,8,.9);  color: #78350f; }` | Instrucción de ejecución en el contexto del script: `.label-antes   { background: rgba(234,179,8,.9);  color: #78350f; }`. |
| `233` | `.label-despues { background: rgba(22,163,74,.9);   color: #fff; }` | Instrucción de ejecución en el contexto del script: `.label-despues { background: rgba(22,163,74,.9);   color: #fff; }`. |
| `234` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `235` | `.sin-foto {` | Instrucción de ejecución en el contexto del script: `.sin-foto {`. |
| `236` | `height: 220px; background: #f3f4f6; border-radius: 10px;` | Instrucción de ejecución en el contexto del script: `height: 220px; background: #f3f4f6; border-radius: 10px;`. |
| `237` | `display: flex; flex-direction: column;` | Instrucción de ejecución en el contexto del script: `display: flex; flex-direction: column;`. |
| `238` | `align-items: center; justify-content: center;` | Instrucción de ejecución en el contexto del script: `align-items: center; justify-content: center;`. |
| `239` | `color: #9ca3af; font-size: .8rem; gap: .4rem;` | Instrucción de ejecución en el contexto del script: `color: #9ca3af; font-size: .8rem; gap: .4rem;`. |
| `240` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `241` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `242` | `.estado-banner {` | Instrucción de ejecución en el contexto del script: `.estado-banner {`. |
| `243` | `padding: .75rem 1.25rem;` | Instrucción de ejecución en el contexto del script: `padding: .75rem 1.25rem;`. |
| `244` | `border-bottom: 1px solid #e5e7eb;` | Instrucción de ejecución en el contexto del script: `border-bottom: 1px solid #e5e7eb;`. |
| `245` | `display: flex; align-items: center; gap: .75rem;` | Instrucción de ejecución en el contexto del script: `display: flex; align-items: center; gap: .75rem;`. |
| `246` | `font-size: .85rem;` | Instrucción de ejecución en el contexto del script: `font-size: .85rem;`. |
| `247` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `248` | ``</style>`` | Cierre de bloque de estilos CSS. |
| `249` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `250` | ``<script>`` | Bloque o etiqueta de vinculación para scripts JavaScript del lado del cliente. |
| `251` | `const eventosData = <?= json_encode($eventos, JSON_UNESCAPED_UNICODE) ?>;` | Instrucción de ejecución en el contexto del script: `const eventosData = <?= json_encode($eventos, JSON_UNESCAPED_UNICODE) ?>;`. |
| `252` | `const idVocero    = <?= $idVocero ?>;` | Instrucción de ejecución en el contexto del script: `const idVocero    = <?= $idVocero ?>;`. |
| `253` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `254` | `document.addEventListener('DOMContentLoaded', function () {` | Registra un escucha de eventos del DOM para interactividad en tiempo real: `document.addEventListener('DOMContentLoaded', function () {`. |
| `255` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `256` | `const cal = new FullCalendar.Calendar(document.getElementById('calendari...` | Instancia y configura el calendario mensual interactivo FullCalendar. |
| `257` | `locale:         'es',` | Instrucción de ejecución en el contexto del script: `locale:         'es',`. |
| `258` | `initialView:    'dayGridMonth',` | Instrucción de ejecución en el contexto del script: `initialView:    'dayGridMonth',`. |
| `259` | `height:         'auto',` | Instrucción de ejecución en el contexto del script: `height:         'auto',`. |
| `260` | `headerToolbar: {` | Instrucción de ejecución en el contexto del script: `headerToolbar: {`. |
| `261` | `left:   'prev,next today',` | Instrucción de ejecución en el contexto del script: `left:   'prev,next today',`. |
| `262` | `center: 'title',` | Instrucción de ejecución en el contexto del script: `center: 'title',`. |
| `263` | `right:  'dayGridMonth,dayGridYear'` | Instrucción de ejecución en el contexto del script: `right:  'dayGridMonth,dayGridYear'`. |
| `264` | `},` | Instrucción de ejecución en el contexto del script: `},`. |
| `265` | `buttonText: { today: 'Hoy', month: 'Mes', year: 'Año' },` | Instrucción de ejecución en el contexto del script: `buttonText: { today: 'Hoy', month: 'Mes', year: 'Año' },`. |
| `266` | `events: eventosData,` | Instrucción de ejecución en el contexto del script: `events: eventosData,`. |
| `267` | `eventClick: function (info) {` | Instrucción de ejecución en el contexto del script: `eventClick: function (info) {`. |
| `268` | `const p = info.event.extendedProps;` | Instrucción de ejecución en el contexto del script: `const p = info.event.extendedProps;`. |
| `269` | `abrirModalDia(` | Función JavaScript para desplegar el modal interactivo con el detalle y fotos del turno. |
| `270` | `info.event.startStr,` | Instrucción de ejecución en el contexto del script: `info.event.startStr,`. |
| `271` | `p.id_turno,` | Instrucción de ejecución en el contexto del script: `p.id_turno,`. |
| `272` | `p.id_grupo,` | Instrucción de ejecución en el contexto del script: `p.id_grupo,`. |
| `273` | `p.nombre_grupo,` | Instrucción de ejecución en el contexto del script: `p.nombre_grupo,`. |
| `274` | `p.nombre_modulo,` | Instrucción de ejecución en el contexto del script: `p.nombre_modulo,`. |
| `275` | `p.estado,` | Instrucción de ejecución en el contexto del script: `p.estado,`. |
| `276` | `p.fotos` | Instrucción de ejecución en el contexto del script: `p.fotos`. |
| `277` | ``);`` | Cierre de estructura de arreglo o invocación de función. |
| `278` | `},` | Instrucción de ejecución en el contexto del script: `},`. |
| `279` | `dayMaxEvents: 3,` | Instrucción de ejecución en el contexto del script: `dayMaxEvents: 3,`. |
| `280` | `moreLinkText: n => `+${n} más`,` | Instrucción de ejecución en el contexto del script: `moreLinkText: n => `+${n} más`,`. |
| `281` | `});` | Instrucción de ejecución en el contexto del script: `});`. |
| `282` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `283` | `cal.render();` | Instrucción de ejecución en el contexto del script: `cal.render();`. |
| `284` | `});` | Instrucción de ejecución en el contexto del script: `});`. |
| `285` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `286` | `function abrirModalDia(fecha, idTurno, idGrupo, nombreGrupo, modulo, est...` | Función JavaScript para desplegar el modal interactivo con el detalle y fotos del turno. |
| `287` | `const fechaFmt = new Date(fecha + 'T12:00:00').toLocaleDateString('es-CO...` | Instrucción de ejecución en el contexto del script: `const fechaFmt = new Date(fecha + 'T12:00:00').toLocaleDateString('es-CO...`. |
| `288` | `weekday: 'long', year: 'numeric', month: 'long', day: 'numeric'` | Instrucción de ejecución en el contexto del script: `weekday: 'long', year: 'numeric', month: 'long', day: 'numeric'`. |
| `289` | `});` | Instrucción de ejecución en el contexto del script: `});`. |
| `290` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `291` | `document.getElementById('modalDiaTitulo').innerHTML =` | Instrucción de ejecución en el contexto del script: `document.getElementById('modalDiaTitulo').innerHTML =`. |
| `292` | `'<i class="fas fa-calendar-day me-2 text-success"></i>' + fechaFmt;` | Instrucción de ejecución en el contexto del script: `'<i class="fas fa-calendar-day me-2 text-success"></i>' + fechaFmt;`. |
| `293` | `document.getElementById('modalDiaSub').textContent =` | Instrucción de ejecución en el contexto del script: `document.getElementById('modalDiaSub').textContent =`. |
| `294` | `modulo + (nombreGrupo ? ' · ' + nombreGrupo : '');` | Instrucción de ejecución en el contexto del script: `modulo + (nombreGrupo ? ' · ' + nombreGrupo : '');`. |
| `295` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `296` | `const cuerpo = document.getElementById('modalDiaCuerpo');` | Instrucción de ejecución en el contexto del script: `const cuerpo = document.getElementById('modalDiaCuerpo');`. |
| `297` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `298` | `// Banner de estado` | Comentario explicativo en el código: `Banner de estado`. |
| `299` | `const estadoHtml = {` | Instrucción de ejecución en el contexto del script: `const estadoHtml = {`. |
| `300` | `entregada: `<div class="estado-banner" style="background:#f0fdf4;color:#...` | Instrucción de ejecución en el contexto del script: `entregada: `<div class="estado-banner" style="background:#f0fdf4;color:#...`. |
| `301` | `<i class="fas fa-circle-check fa-lg"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-circle-check fa-lg"></i>`. |
| `302` | `<div><strong>Evidencias entregadas</strong><div class="text-muted" style...` | Contenedor visual estructurado con Bootstrap/CSS: `<div><strong>Evidencias entregadas</strong><div class="text-muted" style...`. |
| `303` | `</div>`,` | Instrucción de ejecución en el contexto del script: `</div>`,`. |
| `304` | `vencida: `<div class="estado-banner" style="background:#fef2f2;color:#99...` | Instrucción de ejecución en el contexto del script: `vencida: `<div class="estado-banner" style="background:#fef2f2;color:#99...`. |
| `305` | `<i class="fas fa-circle-xmark fa-lg"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-circle-xmark fa-lg"></i>`. |
| `306` | `<div><strong>No se subió evidencia</strong><div class="text-muted" style...` | Contenedor visual estructurado con Bootstrap/CSS: `<div><strong>No se subió evidencia</strong><div class="text-muted" style...`. |
| `307` | `</div>`,` | Instrucción de ejecución en el contexto del script: `</div>`,`. |
| `308` | `proxima: `<div class="estado-banner" style="background:#f9fafb;color:#37...` | Instrucción de ejecución en el contexto del script: `proxima: `<div class="estado-banner" style="background:#f9fafb;color:#37...`. |
| `309` | `<i class="fas fa-clock fa-lg text-muted"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-clock fa-lg text-muted"></i>`. |
| `310` | `<div><strong>Próxima limpieza</strong><div class="text-muted" style="fon...` | Contenedor visual estructurado con Bootstrap/CSS: `<div><strong>Próxima limpieza</strong><div class="text-muted" style="fon...`. |
| `311` | `</div>`,` | Instrucción de ejecución en el contexto del script: `</div>`,`. |
| `312` | `sin_grupo: `<div class="estado-banner" style="background:#f3f4f6;color:#...` | Instrucción de ejecución en el contexto del script: `sin_grupo: `<div class="estado-banner" style="background:#f3f4f6;color:#...`. |
| `313` | `<i class="fas fa-users-slash fa-lg text-muted"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-users-slash fa-lg text-muted"></i>`. |
| `314` | `<div><strong>Sin grupo asignado</strong><div class="text-muted" style="f...` | Contenedor visual estructurado con Bootstrap/CSS: `<div><strong>Sin grupo asignado</strong><div class="text-muted" style="f...`. |
| `315` | `</div>`,` | Instrucción de ejecución en el contexto del script: `</div>`,`. |
| `316` | `}[estado] \|\| '';` | Instrucción de ejecución en el contexto del script: `}[estado] \|\| '';`. |
| `317` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `318` | `if (estado !== 'entregada' \|\| !idTurno) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (estado !== 'entregada' \|\| !idTurno) {`. |
| `319` | `cuerpo.innerHTML = estadoHtml +` | Instrucción de ejecución en el contexto del script: `cuerpo.innerHTML = estadoHtml +`. |
| `320` | `'<div class="text-center py-5 text-muted small">No hay fotos para mostra...` | Instrucción de ejecución en el contexto del script: `'<div class="text-center py-5 text-muted small">No hay fotos para mostra...`. |
| `321` | `new bootstrap.Modal(document.getElementById('modalDia')).show();` | Instrucción de ejecución en el contexto del script: `new bootstrap.Modal(document.getElementById('modalDia')).show();`. |
| `322` | `return;` | Finaliza la ejecución de la función o script. |
| `323` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `324` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `325` | `cuerpo.innerHTML = estadoHtml +` | Instrucción de ejecución en el contexto del script: `cuerpo.innerHTML = estadoHtml +`. |
| `326` | `'<div class="text-center py-4"><i class="fas fa-spinner fa-spin fa-lg te...` | Instrucción de ejecución en el contexto del script: `'<div class="text-center py-4"><i class="fas fa-spinner fa-spin fa-lg te...`. |
| `327` | `new bootstrap.Modal(document.getElementById('modalDia')).show();` | Instrucción de ejecución en el contexto del script: `new bootstrap.Modal(document.getElementById('modalDia')).show();`. |
| `328` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `329` | `// Cargar fotos vía AJAX` | Comentario explicativo en el código: `Cargar fotos vía AJAX`. |
| `330` | `fetch(`../../controllers/VoceroController.php?accion=get_evidencia_turno...` | Petición asíncrona AJAX vía fetch API hacia el backend para cargar datos dinámicos. |
| `331` | `.then(r => r.json())` | Instrucción de ejecución en el contexto del script: `.then(r => r.json())`. |
| `332` | `.then(data => {` | Instrucción de ejecución en el contexto del script: `.then(data => {`. |
| `333` | `const par = data.par \|\| {};` | Instrucción de ejecución en el contexto del script: `const par = data.par \|\| {};`. |
| `334` | `let html = estadoHtml + '<div class="par-modal">';` | Instrucción de ejecución en el contexto del script: `let html = estadoHtml + '<div class="par-modal">';`. |
| `335` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `336` | `const fotoHtml = (foto, tipo) => {` | Instrucción de ejecución en el contexto del script: `const fotoHtml = (foto, tipo) => {`. |
| `337` | `if (!foto) return `<div class="sin-foto">` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (!foto) return `<div class="sin-foto">`. |
| `338` | `<i class="fas fa-${tipo==='antes'?'clock':'circle-check'} fa-xl opacity-...` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-${tipo==='antes'?'clock':'circle-check'} fa-xl opacity-...`. |
| `339` | `<span>Foto ${tipo} no disponible</span>` | Instrucción de ejecución en el contexto del script: `<span>Foto ${tipo} no disponible</span>`. |
| `340` | `</div>`;` | Instrucción de ejecución en el contexto del script: `</div>`;`. |
| `341` | `return `<div class="foto-modal" onclick="verFoto('../../public/${foto.ru...` | Instrucción de retorno que finaliza la ejecución entregando el resultado: `return `<div class="foto-modal" onclick="verFoto('../../public/${foto.ru...`. |
| `342` | `<img src="../../public/${foto.ruta}" alt="${tipo}">` | Instrucción de ejecución en el contexto del script: `<img src="../../public/${foto.ruta}" alt="${tipo}">`. |
| `343` | `<span class="foto-label ${tipo==='antes'?'label-antes':'label-despues'}">` | Instrucción de ejecución en el contexto del script: `<span class="foto-label ${tipo==='antes'?'label-antes':'label-despues'}">`. |
| `344` | `<i class="fas fa-${tipo==='antes'?'clock':'circle-check'} me-1"></i>${ti...` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-${tipo==='antes'?'clock':'circle-check'} me-1"></i>${ti...`. |
| `345` | `</span>` | Instrucción de ejecución en el contexto del script: `</span>`. |
| `346` | `</div>`;` | Instrucción de ejecución en el contexto del script: `</div>`;`. |
| `347` | `};` | Instrucción de ejecución en el contexto del script: `};`. |
| `348` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `349` | `html += fotoHtml(par.antes,   'antes');` | Instrucción de ejecución en el contexto del script: `html += fotoHtml(par.antes,   'antes');`. |
| `350` | `html += fotoHtml(par.despues, 'despues');` | Instrucción de ejecución en el contexto del script: `html += fotoHtml(par.despues, 'despues');`. |
| `351` | `html += '</div>';` | Instrucción de ejecución en el contexto del script: `html += '</div>';`. |
| `352` | `if (data.observaciones) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (data.observaciones) {`. |
| `353` | `html += `<div class="px-4 pb-3 text-muted small">` | Instrucción de ejecución en el contexto del script: `html += `<div class="px-4 pb-3 text-muted small">`. |
| `354` | `<i class="fas fa-comment me-1"></i>${data.observaciones}` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-comment me-1"></i>${data.observaciones}`. |
| `355` | `</div>`;` | Instrucción de ejecución en el contexto del script: `</div>`;`. |
| `356` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `357` | `cuerpo.innerHTML = html;` | Instrucción de ejecución en el contexto del script: `cuerpo.innerHTML = html;`. |
| `358` | `})` | Instrucción de ejecución en el contexto del script: `})`. |
| `359` | `.catch(() => {` | Instrucción de ejecución en el contexto del script: `.catch(() => {`. |
| `360` | `cuerpo.innerHTML = estadoHtml +` | Instrucción de ejecución en el contexto del script: `cuerpo.innerHTML = estadoHtml +`. |
| `361` | `'<div class="text-center py-4 text-muted small">Error al cargar las foto...` | Instrucción de ejecución en el contexto del script: `'<div class="text-center py-4 text-muted small">Error al cargar las foto...`. |
| `362` | `});` | Instrucción de ejecución en el contexto del script: `});`. |
| `363` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `364` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `365` | `function verFoto(url, titulo, sub) {` | Función JavaScript para previsualizar la fotografía en alta resolución con SweetAlert2. |
| `366` | `Swal.fire({` | Despliega una alerta modal estética e interactiva con SweetAlert2. |
| `367` | `imageUrl: url, imageAlt: titulo,` | Instrucción de ejecución en el contexto del script: `imageUrl: url, imageAlt: titulo,`. |
| `368` | `title: titulo, text: sub,` | Instrucción de ejecución en el contexto del script: `title: titulo, text: sub,`. |
| `369` | `confirmButtonColor: '#39a900', width: 720, showCloseButton: true` | Instrucción de ejecución en el contexto del script: `confirmButtonColor: '#39a900', width: 720, showCloseButton: true`. |
| `370` | `});` | Instrucción de ejecución en el contexto del script: `});`. |
| `371` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `372` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `373` | `<?php if ($alert): ?>` | Instrucción de ejecución en el contexto del script: `<?php if ($alert): ?>`. |
| `374` | `document.addEventListener('DOMContentLoaded', function () {` | Registra un escucha de eventos del DOM para interactividad en tiempo real: `document.addEventListener('DOMContentLoaded', function () {`. |
| `375` | `Swal.fire({` | Despliega una alerta modal estética e interactiva con SweetAlert2. |
| `376` | `icon: '<?= addslashes($alert['icon']) ?>',` | Instrucción de ejecución en el contexto del script: `icon: '<?= addslashes($alert['icon']) ?>',`. |
| `377` | `title: '<?= addslashes($alert['title']) ?>',` | Instrucción de ejecución en el contexto del script: `title: '<?= addslashes($alert['title']) ?>',`. |
| `378` | `text: '<?= addslashes($alert['text']) ?>',` | Instrucción de ejecución en el contexto del script: `text: '<?= addslashes($alert['text']) ?>',`. |
| `379` | `confirmButtonColor: '#39a900'` | Instrucción de ejecución en el contexto del script: `confirmButtonColor: '#39a900'`. |
| `380` | `});` | Instrucción de ejecución en el contexto del script: `});`. |
| `381` | `});` | Instrucción de ejecución en el contexto del script: `});`. |
| `382` | `<?php endif; ?>` | Cierre de estructura condicional embebida en la plantilla HTML. |
| `383` | ``</script>`` | Cierre de bloque de script JavaScript. |
| `384` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `385` | `<?php require_once __DIR__ . '/../layouts/footer.php'; ?>` | Importación e inclusión obligatoria del archivo de dependencia requerido: `<?php require_once __DIR__ . '/../layouts/footer.php'; ?>`. |

---

## 3. Resumen y Flujo de Interacción

El archivo `vocero_evidencias.php` cumple un rol indispensable en `views/dashboard/vocero_evidencias.php`. 
Calendario mensual y modal de evidencias de limpieza subidas por el vocero con estado en tiempo real. Garantiza la robustez, el orden y la estabilidad de la arquitectura del proyecto `systemLimpieza`.

---

Generado automáticamente para el repositorio [johanrepizo/LimpiezaDeModulos](https://github.com/johanrepizo/LimpiezaDeModulos).
