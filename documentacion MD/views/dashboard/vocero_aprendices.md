# Documentación Línea por Línea: `views/dashboard/vocero_aprendices.php`

## 1. Ficha Técnica del Archivo

- **Archivo:** `vocero_aprendices.php`
- **Ruta en el proyecto:** `views/dashboard/vocero_aprendices.php`
- **Cantidad total de líneas:** `124`
- **Tipo de archivo:** `PHP`
- **Propósito general:** Vista del vocero para consultar aprendices de su ficha mostrando el grupo de limpieza asignado o estado no asignado.

---

## 2. Explicación Detallada Línea por Línea

A continuación se presenta cada línea de código numerada de forma consecutiva, acompañada de su fragmento exacto y la explicación exhaustiva de su funcionamiento y responsabilidad en el sistema:

| Línea | Código Fuente | Explicación Detallada |
|---|---|---|
| `1` | ``<?php`` | Apertura obligatoria de la etiqueta PHP para ejecución del código del lado del servidor. |
| `2` | `$titulo = 'Mis Aprendices';` | Instrucción de ejecución en el contexto del script: `$titulo = 'Mis Aprendices';`. |
| `3` | `if (session_status() === PHP_SESSION_NONE) session_start();` | Inicia o reanuda la sesión PHP del usuario si no se encontraba activa previamente. |
| `4` | `if (!isset($_SESSION['usuario']) \|\| (int)$_SESSION['usuario']['rol'] !...` | Verifica autenticación y rol del usuario; redirige al login si no tiene permisos. |
| `5` | `header("Location: ../usuarios/login.php"); exit;` | Emite cabecera HTTP de redirección en el navegador y detiene la ejecución: `header("Location: ../usuarios/login.php"); exit;`. |
| `6` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `7` | `require_once __DIR__ . '/../../config/database.php';` | Importación e inclusión obligatoria del archivo de dependencia requerido: `require_once __DIR__ . '/../../config/database.php';`. |
| `8` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `9` | `$db        = (new Database())->conectar();` | Instrucción de ejecución en el contexto del script: `$db        = (new Database())->conectar();`. |
| `10` | `$idUsuario = (int)$_SESSION['usuario']['id_usuario'];` | Instrucción de ejecución en el contexto del script: `$idUsuario = (int)$_SESSION['usuario']['id_usuario'];`. |
| `11` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `12` | `$stmtV = $db->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmtV = $db->prepare(`. |
| `13` | `"SELECT v.*, f.numero_ficha, p.nombre AS nombre_programa` | Instrucción de ejecución en el contexto del script: `"SELECT v.*, f.numero_ficha, p.nombre AS nombre_programa`. |
| `14` | `FROM voceros v` | Instrucción de ejecución en el contexto del script: `FROM voceros v`. |
| `15` | `JOIN fichas   f ON f.id_ficha     = v.id_ficha` | Instrucción de ejecución en el contexto del script: `JOIN fichas   f ON f.id_ficha     = v.id_ficha`. |
| `16` | `JOIN programas p ON p.id_programa = f.id_programa` | Instrucción de ejecución en el contexto del script: `JOIN programas p ON p.id_programa = f.id_programa`. |
| `17` | `WHERE v.id_usuario = :id AND v.activo = 1 LIMIT 1"` | Instrucción de ejecución en el contexto del script: `WHERE v.id_usuario = :id AND v.activo = 1 LIMIT 1"`. |
| `18` | ``);`` | Cierre de estructura de arreglo o invocación de función. |
| `19` | `$stmtV->execute([':id' => $idUsuario]);` | Ejecuta la sentencia SQL preparada vinculando los parámetros correspondientes: `$stmtV->execute([':id' => $idUsuario]);`. |
| `20` | `$vocero = $stmtV->fetch(PDO::FETCH_ASSOC);` | Recupera una única fila o registro resultante de la consulta. |
| `21` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `22` | `// Aprendices de la ficha del vocero con su grupo de limpieza asignado` | Comentario explicativo en el código: `Aprendices de la ficha del vocero con su grupo de limpieza asignado`. |
| `23` | `$stmtAp = $db->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmtAp = $db->prepare(`. |
| `24` | `"SELECT a.*, f.numero_ficha, p.nombre AS nombre_programa,` | Instrucción de ejecución en el contexto del script: `"SELECT a.*, f.numero_ficha, p.nombre AS nombre_programa,`. |
| `25` | `GROUP_CONCAT(DISTINCT g.nombre_grupo ORDER BY g.nombre_grupo SEPARATOR '...` | Instrucción de ejecución en el contexto del script: `GROUP_CONCAT(DISTINCT g.nombre_grupo ORDER BY g.nombre_grupo SEPARATOR '...`. |
| `26` | `FROM aprendices a` | Instrucción de ejecución en el contexto del script: `FROM aprendices a`. |
| `27` | `JOIN fichas   f ON f.id_ficha     = a.id_ficha` | Instrucción de ejecución en el contexto del script: `JOIN fichas   f ON f.id_ficha     = a.id_ficha`. |
| `28` | `JOIN programas p ON p.id_programa = f.id_programa` | Instrucción de ejecución en el contexto del script: `JOIN programas p ON p.id_programa = f.id_programa`. |
| `29` | `LEFT JOIN grupo_integrantes gi   ON gi.id_aprendiz = a.id_aprendiz` | Instrucción de ejecución en el contexto del script: `LEFT JOIN grupo_integrantes gi   ON gi.id_aprendiz = a.id_aprendiz`. |
| `30` | `LEFT JOIN grupos g               ON g.id_grupo     = gi.id_grupo` | Instrucción de ejecución en el contexto del script: `LEFT JOIN grupos g               ON g.id_grupo     = gi.id_grupo`. |
| `31` | `WHERE a.id_ficha = :fic AND a.activo = 1` | Instrucción de ejecución en el contexto del script: `WHERE a.id_ficha = :fic AND a.activo = 1`. |
| `32` | `GROUP BY a.id_aprendiz` | Instrucción de ejecución en el contexto del script: `GROUP BY a.id_aprendiz`. |
| `33` | `ORDER BY a.apellidos, a.nombres"` | Instrucción de ejecución en el contexto del script: `ORDER BY a.apellidos, a.nombres"`. |
| `34` | ``);`` | Cierre de estructura de arreglo o invocación de función. |
| `35` | `$stmtAp->execute([':fic' => $vocero['id_ficha'] ?? 0]);` | Ejecuta la sentencia SQL preparada vinculando los parámetros correspondientes: `$stmtAp->execute([':fic' => $vocero['id_ficha'] ?? 0]);`. |
| `36` | `$aprendices = $stmtAp->fetchAll(PDO::FETCH_ASSOC);` | Obtiene todos los registros coincidentes de la consulta en un arreglo asociativo. |
| `37` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `38` | `require_once __DIR__ . '/../layouts/header.php';` | Importación e inclusión obligatoria del archivo de dependencia requerido: `require_once __DIR__ . '/../layouts/header.php';`. |
| `39` | ``?>`` | Cierre de la etiqueta PHP para alternar a salida HTML o fin del archivo. |
| `40` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `41` | `<div class="d-flex justify-content-between align-items-center mb-4">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="d-flex justify-content-between align-items-center mb-4">`. |
| `42` | `<div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div>`. |
| `43` | `<h4 class="fw-bold mb-0"><i class="fas fa-users text-success me-2"></i>A...` | Instrucción de ejecución en el contexto del script: `<h4 class="fw-bold mb-0"><i class="fas fa-users text-success me-2"></i>A...`. |
| `44` | `<p class="text-muted small mb-0">` | Instrucción de ejecución en el contexto del script: `<p class="text-muted small mb-0">`. |
| `45` | `Ficha <strong><?= htmlspecialchars($vocero['numero_ficha'] ?? '—') ?></s...` | Instrucción de ejecución en el contexto del script: `Ficha <strong><?= htmlspecialchars($vocero['numero_ficha'] ?? '—') ?></s...`. |
| `46` | `&bull; <?= htmlspecialchars($vocero['nombre_programa'] ?? '') ?>` | Instrucción de ejecución en el contexto del script: `&bull; <?= htmlspecialchars($vocero['nombre_programa'] ?? '') ?>`. |
| `47` | `&bull; <strong><?= count($aprendices) ?></strong> aprendice(s)` | Instrucción de ejecución en el contexto del script: `&bull; <strong><?= count($aprendices) ?></strong> aprendice(s)`. |
| `48` | `</p>` | Instrucción de ejecución en el contexto del script: `</p>`. |
| `49` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `50` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `51` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `52` | `<!-- Buscador -->` | Instrucción de ejecución en el contexto del script: `<!-- Buscador -->`. |
| `53` | `<div class="card shadow-sm mb-3">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="card shadow-sm mb-3">`. |
| `54` | `<div class="card-body py-2">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="card-body py-2">`. |
| `55` | `<div class="input-group input-group-sm" style="max-width:350px;">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="input-group input-group-sm" style="max-width:350px;">`. |
| `56` | `<span class="input-group-text bg-white"><i class="fas fa-search text-mut...` | Instrucción de ejecución en el contexto del script: `<span class="input-group-text bg-white"><i class="fas fa-search text-mut...`. |
| `57` | `<input type="text" id="buscador" class="form-control border-start-0"` | Campo de entrada interactivo para datos del usuario: `<input type="text" id="buscador" class="form-control border-start-0"`. |
| `58` | `placeholder="Buscar por nombre, apellido o grupo…">` | Instrucción de ejecución en el contexto del script: `placeholder="Buscar por nombre, apellido o grupo…">`. |
| `59` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `60` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `61` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `62` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `63` | `<div class="card shadow-sm">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="card shadow-sm">`. |
| `64` | `<div class="card-body p-0">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="card-body p-0">`. |
| `65` | `<div class="table-responsive">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="table-responsive">`. |
| `66` | `<table class="table tabla-limpia align-middle mb-0" id="tblAprendices">` | Tabla de datos para despliegue estructurado de información. |
| `67` | `<thead class="table-light">` | Definición de estructura semántica de cabecera o cuerpo de tabla. |
| `68` | ``<tr>`` | Fila contenedora de datos dentro de la tabla. |
| `69` | `<th>#</th>` | Celda de encabezado de columna: `<th>#</th>`. |
| `70` | `<th>Apellidos</th>` | Celda de encabezado de columna: `<th>Apellidos</th>`. |
| `71` | `<th>Nombres</th>` | Celda de encabezado de columna: `<th>Nombres</th>`. |
| `72` | `<th>Documento</th>` | Celda de encabezado de columna: `<th>Documento</th>`. |
| `73` | `<th>Ficha</th>` | Celda de encabezado de columna: `<th>Ficha</th>`. |
| `74` | `<th>Programa</th>` | Celda de encabezado de columna: `<th>Programa</th>`. |
| `75` | `<th>Grupo de Limpieza</th>` | Celda de encabezado de columna: `<th>Grupo de Limpieza</th>`. |
| `76` | ``</tr>`` | Cierre de fila contenedora de tabla. |
| `77` | `</thead>` | Definición de estructura semántica de cabecera o cuerpo de tabla. |
| `78` | `<tbody>` | Definición de estructura semántica de cabecera o cuerpo de tabla. |
| `79` | `<?php if (empty($aprendices)): ?>` | Instrucción de ejecución en el contexto del script: `<?php if (empty($aprendices)): ?>`. |
| `80` | ``<tr>`` | Fila contenedora de datos dentro de la tabla. |
| `81` | `<td colspan="7" class="text-center text-muted py-5">` | Celda de contenido de tabla: `<td colspan="7" class="text-center text-muted py-5">`. |
| `82` | `<i class="fas fa-users fa-2x mb-2 opacity-25 d-block"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-users fa-2x mb-2 opacity-25 d-block"></i>`. |
| `83` | `No hay aprendices sincronizados en tu ficha. Contacta al administrador.` | Instrucción de ejecución en el contexto del script: `No hay aprendices sincronizados en tu ficha. Contacta al administrador.`. |
| `84` | `</td>` | Instrucción de ejecución en el contexto del script: `</td>`. |
| `85` | ``</tr>`` | Cierre de fila contenedora de tabla. |
| `86` | `<?php else: ?>` | Instrucción de ejecución en el contexto del script: `<?php else: ?>`. |
| `87` | `<?php foreach ($aprendices as $i => $ap): ?>` | Instrucción de ejecución en el contexto del script: `<?php foreach ($aprendices as $i => $ap): ?>`. |
| `88` | ``<tr>`` | Fila contenedora de datos dentro de la tabla. |
| `89` | `<td class="text-muted small"><?= $i + 1 ?></td>` | Celda de contenido de tabla: `<td class="text-muted small"><?= $i + 1 ?></td>`. |
| `90` | `<td class="fw-semibold small"><?= htmlspecialchars($ap['apellidos']) ?><...` | Celda de contenido de tabla: `<td class="fw-semibold small"><?= htmlspecialchars($ap['apellidos']) ?><...`. |
| `91` | `<td class="small"><?= htmlspecialchars($ap['nombres']) ?></td>` | Celda de contenido de tabla: `<td class="small"><?= htmlspecialchars($ap['nombres']) ?></td>`. |
| `92` | `<td class="small text-muted"><?= htmlspecialchars($ap['documento'] ?? '—...` | Celda de contenido de tabla: `<td class="small text-muted"><?= htmlspecialchars($ap['documento'] ?? '—...`. |
| `93` | `<td><span class="badge bg-light text-dark border"><?= htmlspecialchars($...` | Celda de contenido de tabla: `<td><span class="badge bg-light text-dark border"><?= htmlspecialchars($...`. |
| `94` | `<td class="small text-muted"><?= htmlspecialchars(substr($ap['nombre_pro...` | Celda de contenido de tabla: `<td class="small text-muted"><?= htmlspecialchars(substr($ap['nombre_pro...`. |
| `95` | `<td>` | Celda de contenido de tabla: `<td>`. |
| `96` | `<?php if (!empty($ap['nombre_grupo'])): ?>` | Instrucción de ejecución en el contexto del script: `<?php if (!empty($ap['nombre_grupo'])): ?>`. |
| `97` | `<span class="badge bg-success-subtle text-success border border-success-...` | Instrucción de ejecución en el contexto del script: `<span class="badge bg-success-subtle text-success border border-success-...`. |
| `98` | `<i class="fas fa-people-group me-1"></i><?= htmlspecialchars($ap['nombre...` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-people-group me-1"></i><?= htmlspecialchars($ap['nombre...`. |
| `99` | `</span>` | Instrucción de ejecución en el contexto del script: `</span>`. |
| `100` | `<?php else: ?>` | Instrucción de ejecución en el contexto del script: `<?php else: ?>`. |
| `101` | `<span class="badge bg-secondary-subtle text-muted border px-2 py-1 fw-no...` | Instrucción de ejecución en el contexto del script: `<span class="badge bg-secondary-subtle text-muted border px-2 py-1 fw-no...`. |
| `102` | `<i class="fas fa-minus-circle me-1"></i>No asignado` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-minus-circle me-1"></i>No asignado`. |
| `103` | `</span>` | Instrucción de ejecución en el contexto del script: `</span>`. |
| `104` | `<?php endif; ?>` | Cierre de estructura condicional embebida en la plantilla HTML. |
| `105` | `</td>` | Instrucción de ejecución en el contexto del script: `</td>`. |
| `106` | ``</tr>`` | Cierre de fila contenedora de tabla. |
| `107` | `<?php endforeach; ?>` | Cierre de ciclo iterativo foreach embebido en la plantilla HTML. |
| `108` | `<?php endif; ?>` | Cierre de estructura condicional embebida en la plantilla HTML. |
| `109` | `</tbody>` | Definición de estructura semántica de cabecera o cuerpo de tabla. |
| `110` | ``</table>`` | Cierre de tabla de datos. |
| `111` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `112` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `113` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `114` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `115` | ``<script>`` | Bloque o etiqueta de vinculación para scripts JavaScript del lado del cliente. |
| `116` | `document.getElementById('buscador').addEventListener('input', function() {` | Registra un escucha de eventos del DOM para interactividad en tiempo real: `document.getElementById('buscador').addEventListener('input', function() {`. |
| `117` | `const q = this.value.toLowerCase();` | Instrucción de ejecución en el contexto del script: `const q = this.value.toLowerCase();`. |
| `118` | `document.querySelectorAll('#tblAprendices tbody tr').forEach(tr => {` | Instrucción de ejecución en el contexto del script: `document.querySelectorAll('#tblAprendices tbody tr').forEach(tr => {`. |
| `119` | `tr.style.display = !q \|\| tr.textContent.toLowerCase().includes(q) ? ''...` | Instrucción de ejecución en el contexto del script: `tr.style.display = !q \|\| tr.textContent.toLowerCase().includes(q) ? ''...`. |
| `120` | `});` | Instrucción de ejecución en el contexto del script: `});`. |
| `121` | `});` | Instrucción de ejecución en el contexto del script: `});`. |
| `122` | ``</script>`` | Cierre de bloque de script JavaScript. |
| `123` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `124` | `<?php require_once __DIR__ . '/../layouts/footer.php'; ?>` | Importación e inclusión obligatoria del archivo de dependencia requerido: `<?php require_once __DIR__ . '/../layouts/footer.php'; ?>`. |

---

## 3. Resumen y Flujo de Interacción

El archivo `vocero_aprendices.php` cumple un rol indispensable en `views/dashboard/vocero_aprendices.php`. 
Vista del vocero para consultar aprendices de su ficha mostrando el grupo de limpieza asignado o estado no asignado. Garantiza la robustez, el orden y la estabilidad de la arquitectura del proyecto `systemLimpieza`.

---

Generado automáticamente para el repositorio [johanrepizo/LimpiezaDeModulos](https://github.com/johanrepizo/LimpiezaDeModulos).
