# Documentación Línea por Línea: `views/dashboard/vocero_aprendices.php`

## 1. Ficha Técnica del Archivo

- **Archivo:** `vocero_aprendices.php`
- **Ruta en el proyecto:** `views/dashboard/vocero_aprendices.php`
- **Cantidad total de líneas:** `108`
- **Tipo de archivo:** `PHP`
- **Propósito general:** Vista del vocero para consultar la lista de aprendices de su ficha para integrarlos a los grupos de aseo.

---

## 2. Explicación Detallada Línea por Línea

A continuación se presenta cada línea de código numerada de forma consecutiva, acompañada de su fragmento exacto y la explicación exhaustiva de su funcionamiento y responsabilidad en el sistema:

| Línea | Código Fuente | Explicación Detallada |
|---|---|---|
| `1` | `<?php` | Apertura obligatoria de la etiqueta PHP para ejecución del código del lado del servidor. |
| `2` | `$titulo = 'Mis Aprendices';` | Instrucción de ejecución en el contexto del script: `$titulo = 'Mis Aprendices';`. |
| `3` | `if (session_status() === PHP_SESSION_NONE) session_start();` | Inicia o reanuda la sesión PHP del usuario si no se encontraba activa previamente. |
| `4` | `if (!isset($_SESSION['usuario']) \|\| (int)$_SESSION['usuario']['rol'] !== ...` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (!isset($_SESSION['usuario']) \|\| (int)$_SESSION['usuario']['rol'] !== 2) {`. |
| `5` | `    header("Location: ../usuarios/login.php"); exit;` | Emite cabecera HTTP de redirección en el navegador: `header("Location: ../usuarios/login.php"); exit;`. |
| `6` | `}` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `7` | `require_once __DIR__ . '/../../config/database.php';` | Importación e inclusión obligatoria del archivo de dependencia requerido: `require_once __DIR__ . '/../../config/database.php';`. |
| `8` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `9` | `$db        = (new Database())->conectar();` | Instrucción de ejecución en el contexto del script: `$db        = (new Database())->conectar();`. |
| `10` | `$idUsuario = (int)$_SESSION['usuario']['id_usuario'];` | Accede o almacena información de identidad del usuario en la sesión activa: `$idUsuario = (int)$_SESSION['usuario']['id_usuario'];`. |
| `11` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `12` | `$stmtV = $db->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmtV = $db->prepare(`. |
| `13` | `    "SELECT v.*, f.numero_ficha, p.nombre AS nombre_programa` | Instrucción de ejecución en el contexto del script: `"SELECT v.*, f.numero_ficha, p.nombre AS nombre_programa`. |
| `14` | `     FROM voceros v` | Instrucción de ejecución en el contexto del script: `FROM voceros v`. |
| `15` | `     JOIN fichas   f ON f.id_ficha     = v.id_ficha` | Instrucción de ejecución en el contexto del script: `JOIN fichas   f ON f.id_ficha     = v.id_ficha`. |
| `16` | `     JOIN programas p ON p.id_programa = f.id_programa` | Instrucción de ejecución en el contexto del script: `JOIN programas p ON p.id_programa = f.id_programa`. |
| `17` | `     WHERE v.id_usuario = :id AND v.activo = 1 LIMIT 1"` | Instrucción de ejecución en el contexto del script: `WHERE v.id_usuario = :id AND v.activo = 1 LIMIT 1"`. |
| `18` | `);` | Instrucción de ejecución en el contexto del script: `);`. |
| `19` | `$stmtV->execute([':id' => $idUsuario]);` | Ejecuta la sentencia SQL preparada vinculando los datos correspondientes: `$stmtV->execute([':id' => $idUsuario]);`. |
| `20` | `$vocero = $stmtV->fetch(PDO::FETCH_ASSOC);` | Recupera una única fila o registro resultante de la consulta. |
| `21` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `22` | `// Aprendices de la ficha del vocero` | Comentario de línea explicativo: `Aprendices de la ficha del vocero`. |
| `23` | `$stmtAp = $db->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmtAp = $db->prepare(`. |
| `24` | `    "SELECT a.*, f.numero_ficha, p.nombre AS nombre_programa` | Instrucción de ejecución en el contexto del script: `"SELECT a.*, f.numero_ficha, p.nombre AS nombre_programa`. |
| `25` | `     FROM aprendices a` | Instrucción de ejecución en el contexto del script: `FROM aprendices a`. |
| `26` | `     JOIN fichas   f ON f.id_ficha     = a.id_ficha` | Instrucción de ejecución en el contexto del script: `JOIN fichas   f ON f.id_ficha     = a.id_ficha`. |
| `27` | `     JOIN programas p ON p.id_programa = f.id_programa` | Instrucción de ejecución en el contexto del script: `JOIN programas p ON p.id_programa = f.id_programa`. |
| `28` | `     WHERE a.id_ficha = :fic AND a.activo = 1` | Instrucción de ejecución en el contexto del script: `WHERE a.id_ficha = :fic AND a.activo = 1`. |
| `29` | `     ORDER BY a.apellidos, a.nombres"` | Instrucción de ejecución en el contexto del script: `ORDER BY a.apellidos, a.nombres"`. |
| `30` | `);` | Instrucción de ejecución en el contexto del script: `);`. |
| `31` | `$stmtAp->execute([':fic' => $vocero['id_ficha'] ?? 0]);` | Ejecuta la sentencia SQL preparada vinculando los datos correspondientes: `$stmtAp->execute([':fic' => $vocero['id_ficha'] ?? 0]);`. |
| `32` | `$aprendices = $stmtAp->fetchAll(PDO::FETCH_ASSOC);` | Obtiene todos los registros coincidentes de la consulta en un arreglo asociativo. |
| `33` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `34` | `require_once __DIR__ . '/../layouts/header.php';` | Importación e inclusión obligatoria del archivo de dependencia requerido: `require_once __DIR__ . '/../layouts/header.php';`. |
| `35` | `?>` | Cierre de la etiqueta PHP para alternar a salida HTML o fin del archivo. |
| `36` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `37` | `<div class="d-flex justify-content-between align-items-center mb-4">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="d-flex justify-content-between align-items-center mb-4">`. |
| `38` | `    <div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div>`. |
| `39` | `        <h4 class="fw-bold mb-0"><i class="fas fa-users text-success me-2">...` | Instrucción de ejecución en el contexto del script: `<h4 class="fw-bold mb-0"><i class="fas fa-users text-success me-2"></i>Aprendices</h4>`. |
| `40` | `        <p class="text-muted small mb-0">` | Instrucción de ejecución en el contexto del script: `<p class="text-muted small mb-0">`. |
| `41` | `            Ficha <strong><?= htmlspecialchars($vocero['numero_ficha'] ?? '...` | Instrucción de ejecución en el contexto del script: `Ficha <strong><?= htmlspecialchars($vocero['numero_ficha'] ?? '—') ?></strong>`. |
| `42` | `            &bull; <?= htmlspecialchars($vocero['nombre_programa'] ?? '') ?>` | Instrucción de ejecución en el contexto del script: `&bull; <?= htmlspecialchars($vocero['nombre_programa'] ?? '') ?>`. |
| `43` | `            &bull; <strong><?= count($aprendices) ?></strong> aprendice(s)` | Instrucción de ejecución en el contexto del script: `&bull; <strong><?= count($aprendices) ?></strong> aprendice(s)`. |
| `44` | `        </p>` | Instrucción de ejecución en el contexto del script: `</p>`. |
| `45` | `    </div>` | Cierre de contenedor visual `<div>`. |
| `46` | `</div>` | Cierre de contenedor visual `<div>`. |
| `47` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `48` | `<!-- Buscador -->` | Instrucción de ejecución en el contexto del script: `<!-- Buscador -->`. |
| `49` | `<div class="card shadow-sm mb-3">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="card shadow-sm mb-3">`. |
| `50` | `    <div class="card-body py-2">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="card-body py-2">`. |
| `51` | `        <div class="input-group input-group-sm" style="max-width:350px;">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="input-group input-group-sm" style="max-width:350px;">`. |
| `52` | `            <span class="input-group-text bg-white"><i class="fas fa-search...` | Instrucción de ejecución en el contexto del script: `<span class="input-group-text bg-white"><i class="fas fa-search text-muted"></i></span>`. |
| `53` | `            <input type="text" id="buscador" class="form-control border-sta...` | Campo de entrada interactivo para datos del usuario: `<input type="text" id="buscador" class="form-control border-start-0"`. |
| `54` | `                   placeholder="Buscar por nombre o apellido…">` | Instrucción de ejecución en el contexto del script: `placeholder="Buscar por nombre o apellido…">`. |
| `55` | `        </div>` | Cierre de contenedor visual `<div>`. |
| `56` | `    </div>` | Cierre de contenedor visual `<div>`. |
| `57` | `</div>` | Cierre de contenedor visual `<div>`. |
| `58` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `59` | `<div class="card shadow-sm">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="card shadow-sm">`. |
| `60` | `    <div class="card-body p-0">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="card-body p-0">`. |
| `61` | `        <div class="table-responsive">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="table-responsive">`. |
| `62` | `            <table class="table tabla-limpia align-middle mb-0" id="tblApre...` | Tabla de datos para despliegue estructurado de información: `<table class="table tabla-limpia align-middle mb-0" id="tblAprendices">`. |
| `63` | `                <thead class="table-light">` | Celda de tabla con contenido de datos o encabezado de columna: `<thead class="table-light">`. |
| `64` | `                    <tr>` | Fila contenedora de datos dentro de la tabla. |
| `65` | `                        <th>#</th>` | Celda de tabla con contenido de datos o encabezado de columna: `<th>#</th>`. |
| `66` | `                        <th>Apellidos</th>` | Celda de tabla con contenido de datos o encabezado de columna: `<th>Apellidos</th>`. |
| `67` | `                        <th>Nombres</th>` | Celda de tabla con contenido de datos o encabezado de columna: `<th>Nombres</th>`. |
| `68` | `                        <th>Documento</th>` | Celda de tabla con contenido de datos o encabezado de columna: `<th>Documento</th>`. |
| `69` | `                        <th>Ficha</th>` | Celda de tabla con contenido de datos o encabezado de columna: `<th>Ficha</th>`. |
| `70` | `                        <th>Programa</th>` | Celda de tabla con contenido de datos o encabezado de columna: `<th>Programa</th>`. |
| `71` | `                    </tr>` | Fila contenedora de datos dentro de la tabla. |
| `72` | `                </thead>` | Instrucción de ejecución en el contexto del script: `</thead>`. |
| `73` | `                <tbody>` | Instrucción de ejecución en el contexto del script: `<tbody>`. |
| `74` | `                <?php if (empty($aprendices)): ?>` | Instrucción de ejecución en el contexto del script: `<?php if (empty($aprendices)): ?>`. |
| `75` | `                <tr>` | Fila contenedora de datos dentro de la tabla. |
| `76` | `                    <td colspan="6" class="text-center text-muted py-5">` | Celda de tabla con contenido de datos o encabezado de columna: `<td colspan="6" class="text-center text-muted py-5">`. |
| `77` | `                        <i class="fas fa-users fa-2x mb-2 opacity-25 d-bloc...` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-users fa-2x mb-2 opacity-25 d-block"></i>`. |
| `78` | `                        No hay aprendices sincronizados en tu ficha. Contac...` | Instrucción de ejecución en el contexto del script: `No hay aprendices sincronizados en tu ficha. Contacta al administrador.`. |
| `79` | `                    </td>` | Celda de tabla con contenido de datos o encabezado de columna: `</td>`. |
| `80` | `                </tr>` | Fila contenedora de datos dentro de la tabla. |
| `81` | `                <?php else: ?>` | Instrucción de ejecución en el contexto del script: `<?php else: ?>`. |
| `82` | `                <?php foreach ($aprendices as $i => $ap): ?>` | Instrucción de ejecución en el contexto del script: `<?php foreach ($aprendices as $i => $ap): ?>`. |
| `83` | `                <tr>` | Fila contenedora de datos dentro de la tabla. |
| `84` | `                    <td class="text-muted small"><?= $i + 1 ?></td>` | Celda de tabla con contenido de datos o encabezado de columna: `<td class="text-muted small"><?= $i + 1 ?></td>`. |
| `85` | `                    <td class="fw-semibold small"><?= htmlspecialchars($ap[...` | Celda de tabla con contenido de datos o encabezado de columna: `<td class="fw-semibold small"><?= htmlspecialchars($ap['apellidos']) ?></td>`. |
| `86` | `                    <td class="small"><?= htmlspecialchars($ap['nombres']) ...` | Celda de tabla con contenido de datos o encabezado de columna: `<td class="small"><?= htmlspecialchars($ap['nombres']) ?></td>`. |
| `87` | `                    <td class="small text-muted"><?= htmlspecialchars($ap['...` | Celda de tabla con contenido de datos o encabezado de columna: `<td class="small text-muted"><?= htmlspecialchars($ap['documento'] ?? '—') ?></td>`. |
| `88` | `                    <td><span class="badge bg-light text-dark border"><?= h...` | Celda de tabla con contenido de datos o encabezado de columna: `<td><span class="badge bg-light text-dark border"><?= htmlspecialchars($ap['numero_ficha']) ?></span></td>`. |
| `89` | `                    <td class="small text-muted"><?= htmlspecialchars(subst...` | Celda de tabla con contenido de datos o encabezado de columna: `<td class="small text-muted"><?= htmlspecialchars(substr($ap['nombre_programa'], 0, 40)) ?></td>`. |
| `90` | `                </tr>` | Fila contenedora de datos dentro de la tabla. |
| `91` | `                <?php endforeach; ?>` | Instrucción de ejecución en el contexto del script: `<?php endforeach; ?>`. |
| `92` | `                <?php endif; ?>` | Instrucción de ejecución en el contexto del script: `<?php endif; ?>`. |
| `93` | `                </tbody>` | Instrucción de ejecución en el contexto del script: `</tbody>`. |
| `94` | `            </table>` | Tabla de datos para despliegue estructurado de información: `</table>`. |
| `95` | `        </div>` | Cierre de contenedor visual `<div>`. |
| `96` | `    </div>` | Cierre de contenedor visual `<div>`. |
| `97` | `</div>` | Cierre de contenedor visual `<div>`. |
| `98` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `99` | `<script>` | Bloque o etiqueta de vinculación para scripts JavaScript del lado del cliente. |
| `100` | `document.getElementById('buscador').addEventListener('input', function() {` | Instrucción de ejecución en el contexto del script: `document.getElementById('buscador').addEventListener('input', function() {`. |
| `101` | `    const q = this.value.toLowerCase();` | Instrucción de ejecución en el contexto del script: `const q = this.value.toLowerCase();`. |
| `102` | `    document.querySelectorAll('#tblAprendices tbody tr').forEach(tr => {` | Instrucción de ejecución en el contexto del script: `document.querySelectorAll('#tblAprendices tbody tr').forEach(tr => {`. |
| `103` | `        tr.style.display = !q \|\| tr.textContent.toLowerCase().includes(q)...` | Instrucción de ejecución en el contexto del script: `tr.style.display = !q \|\| tr.textContent.toLowerCase().includes(q) ? '' : 'none';`. |
| `104` | `    });` | Instrucción de ejecución en el contexto del script: `});`. |
| `105` | `});` | Instrucción de ejecución en el contexto del script: `});`. |
| `106` | `</script>` | Bloque o etiqueta de vinculación para scripts JavaScript del lado del cliente. |
| `107` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `108` | `<?php require_once __DIR__ . '/../layouts/footer.php'; ?>` | Instrucción de ejecución en el contexto del script: `<?php require_once __DIR__ . '/../layouts/footer.php'; ?>`. |

---

## 3. Resumen y Flujo de Interacción

El archivo `vocero_aprendices.php` cumple un rol indispensable en `views/dashboard/vocero_aprendices.php`. 
Vista del vocero para consultar la lista de aprendices de su ficha para integrarlos a los grupos de aseo. Garantiza la robustez, el orden y la estabilidad de la arquitectura del proyecto `systemLimpieza`.
