# Documentación Línea por Línea: `views/dashboard/vocero_subir_evidencia.php`

## 1. Ficha Técnica del Archivo

- **Archivo:** `vocero_subir_evidencia.php`
- **Ruta en el proyecto:** `views/dashboard/vocero_subir_evidencia.php`
- **Cantidad total de líneas:** `559`
- **Tipo de archivo:** `PHP`
- **Propósito general:** Formulario con carga de archivos fotográficos y observaciones para registrar el cumplimiento de la limpieza.

---

## 2. Explicación Detallada Línea por Línea

A continuación se presenta cada línea de código numerada de forma consecutiva, acompañada de su fragmento exacto y la explicación exhaustiva de su funcionamiento y responsabilidad en el sistema:

| Línea | Código Fuente | Explicación Detallada |
|---|---|---|
| `1` | `<?php` | Apertura obligatoria de la etiqueta PHP para ejecución del código del lado del servidor. |
| `2` | `$titulo = 'Subir Evidencia';` | Instrucción de ejecución en el contexto del script: `$titulo = 'Subir Evidencia';`. |
| `3` | `if (session_status() === PHP_SESSION_NONE) session_start();` | Inicia o reanuda la sesión PHP del usuario si no se encontraba activa previamente. |
| `4` | `if (!isset($_SESSION['usuario']) \|\| (int)$_SESSION['usuario']['rol'] !== ...` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (!isset($_SESSION['usuario']) \|\| (int)$_SESSION['usuario']['rol'] !== 2) {`. |
| `5` | `    header("Location: ../usuarios/login.php"); exit;` | Emite cabecera HTTP de redirección en el navegador: `header("Location: ../usuarios/login.php"); exit;`. |
| `6` | `}` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `7` | `require_once __DIR__ . '/../../config/database.php';` | Importación e inclusión obligatoria del archivo de dependencia requerido: `require_once __DIR__ . '/../../config/database.php';`. |
| `8` | `require_once __DIR__ . '/../../models/Turno.php';` | Importación e inclusión obligatoria del archivo de dependencia requerido: `require_once __DIR__ . '/../../models/Turno.php';`. |
| `9` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `10` | `$db    = (new Database())->conectar();` | Instrucción de ejecución en el contexto del script: `$db    = (new Database())->conectar();`. |
| `11` | `$alert = $_SESSION['alert'] ?? null;` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección: `$alert = $_SESSION['alert'] ?? null;`. |
| `12` | `unset($_SESSION['alert']);` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección: `unset($_SESSION['alert']);`. |
| `13` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `14` | `$idUsuario = (int)$_SESSION['usuario']['id_usuario'];` | Accede o almacena información de identidad del usuario en la sesión activa: `$idUsuario = (int)$_SESSION['usuario']['id_usuario'];`. |
| `15` | `$stmtV = $db->prepare("SELECT * FROM voceros WHERE id_usuario = :id AND act...` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmtV = $db->prepare("SELECT * FROM voceros WHERE id_usuario = :id AND activo = 1 LIMIT 1");`. |
| `16` | `$stmtV->execute([':id' => $idUsuario]);` | Ejecuta la sentencia SQL preparada vinculando los datos correspondientes: `$stmtV->execute([':id' => $idUsuario]);`. |
| `17` | `$vocero   = $stmtV->fetch(PDO::FETCH_ASSOC);` | Recupera una única fila o registro resultante de la consulta. |
| `18` | `$idVocero = $vocero ? (int)$vocero['id_vocero'] : 0;` | Instrucción de ejecución en el contexto del script: `$idVocero = $vocero ? (int)$vocero['id_vocero'] : 0;`. |
| `19` | `$idFicha  = $vocero ? (int)$vocero['id_ficha']  : 0;` | Instrucción de ejecución en el contexto del script: `$idFicha  = $vocero ? (int)$vocero['id_ficha']  : 0;`. |
| `20` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `21` | `// Obtener info de la ficha` | Comentario de línea explicativo: `Obtener info de la ficha`. |
| `22` | `$fichaInfo = null;` | Instrucción de ejecución en el contexto del script: `$fichaInfo = null;`. |
| `23` | `if ($idFicha) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if ($idFicha) {`. |
| `24` | `    $stmtF = $db->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmtF = $db->prepare(`. |
| `25` | `        "SELECT f.numero_ficha, p.nombre AS nombre_programa` | Instrucción de ejecución en el contexto del script: `"SELECT f.numero_ficha, p.nombre AS nombre_programa`. |
| `26` | `         FROM fichas f JOIN programas p ON p.id_programa = f.id_programa` | Instrucción de ejecución en el contexto del script: `FROM fichas f JOIN programas p ON p.id_programa = f.id_programa`. |
| `27` | `         WHERE f.id_ficha = :id LIMIT 1"` | Instrucción de ejecución en el contexto del script: `WHERE f.id_ficha = :id LIMIT 1"`. |
| `28` | `    );` | Instrucción de ejecución en el contexto del script: `);`. |
| `29` | `    $stmtF->execute([':id' => $idFicha]);` | Ejecuta la sentencia SQL preparada vinculando los datos correspondientes: `$stmtF->execute([':id' => $idFicha]);`. |
| `30` | `    $fichaInfo = $stmtF->fetch(PDO::FETCH_ASSOC);` | Recupera una única fila o registro resultante de la consulta. |
| `31` | `}` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `32` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `33` | `$modelTurno = new Turno($db);` | Instrucción de ejecución en el contexto del script: `$modelTurno = new Turno($db);`. |
| `34` | `if ($idFicha) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if ($idFicha) {`. |
| `35` | `    $modelTurno->abrirTurnosHoy();` | Instrucción de ejecución en el contexto del script: `$modelTurno->abrirTurnosHoy();`. |
| `36` | `    $modelTurno->cerrarTurnosVencidos();` | Instrucción de ejecución en el contexto del script: `$modelTurno->cerrarTurnosVencidos();`. |
| `37` | `}` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `38` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `39` | `$turnoHoy  = $idFicha ? $modelTurno->turnoActivoHoy($idFicha)    : false;` | Instrucción de ejecución en el contexto del script: `$turnoHoy  = $idFicha ? $modelTurno->turnoActivoHoy($idFicha)    : false;`. |
| `40` | `$historial = $idFicha ? $modelTurno->historialFicha($idFicha, 10) : [];` | Instrucción de ejecución en el contexto del script: `$historial = $idFicha ? $modelTurno->historialFicha($idFicha, 10) : [];`. |
| `41` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `42` | `$diasES = ['Domingo','Lunes','Martes','Miércoles','Jueves','Viernes','Sábad...` | Instrucción de ejecución en el contexto del script: `$diasES = ['Domingo','Lunes','Martes','Miércoles','Jueves','Viernes','Sábado'];`. |
| `43` | `$hoy    = new DateTime();` | Instrucción de ejecución en el contexto del script: `$hoy    = new DateTime();`. |
| `44` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `45` | `require_once __DIR__ . '/../layouts/header.php';` | Importación e inclusión obligatoria del archivo de dependencia requerido: `require_once __DIR__ . '/../layouts/header.php';`. |
| `46` | `?>` | Cierre de la etiqueta PHP para alternar a salida HTML o fin del archivo. |
| `47` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `48` | `<style>` | Instrucción de ejecución en el contexto del script: `<style>`. |
| `49` | `/* ── Estilos específicos de esta página ── */` | Comentario de bloque o anotación informativa dentro del código. |
| `50` | `.ev-page {` | Instrucción de ejecución en el contexto del script: `.ev-page {`. |
| `51` | `    max-width: 680px;` | Instrucción de ejecución en el contexto del script: `max-width: 680px;`. |
| `52` | `    margin: 0 auto;` | Instrucción de ejecución en el contexto del script: `margin: 0 auto;`. |
| `53` | `}` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `54` | `.ev-card {` | Instrucción de ejecución en el contexto del script: `.ev-card {`. |
| `55` | `    background: #fff;` | Instrucción de ejecución en el contexto del script: `background: #fff;`. |
| `56` | `    border: 1px solid #e5e7eb;` | Instrucción de ejecución en el contexto del script: `border: 1px solid #e5e7eb;`. |
| `57` | `    border-radius: 12px;` | Instrucción de ejecución en el contexto del script: `border-radius: 12px;`. |
| `58` | `    padding: 1.5rem 1.75rem;` | Instrucción de ejecución en el contexto del script: `padding: 1.5rem 1.75rem;`. |
| `59` | `    margin-bottom: 1.25rem;` | Instrucción de ejecución en el contexto del script: `margin-bottom: 1.25rem;`. |
| `60` | `}` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `61` | `.ev-card-title {` | Instrucción de ejecución en el contexto del script: `.ev-card-title {`. |
| `62` | `    font-size: .95rem;` | Instrucción de ejecución en el contexto del script: `font-size: .95rem;`. |
| `63` | `    font-weight: 700;` | Instrucción de ejecución en el contexto del script: `font-weight: 700;`. |
| `64` | `    color: #111827;` | Instrucción de ejecución en el contexto del script: `color: #111827;`. |
| `65` | `    margin-bottom: .2rem;` | Instrucción de ejecución en el contexto del script: `margin-bottom: .2rem;`. |
| `66` | `}` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `67` | `.ev-card-sub {` | Instrucción de ejecución en el contexto del script: `.ev-card-sub {`. |
| `68` | `    font-size: .8rem;` | Instrucción de ejecución en el contexto del script: `font-size: .8rem;`. |
| `69` | `    color: #6b7280;` | Instrucción de ejecución en el contexto del script: `color: #6b7280;`. |
| `70` | `    margin-bottom: 1.1rem;` | Instrucción de ejecución en el contexto del script: `margin-bottom: 1.1rem;`. |
| `71` | `}` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `72` | `.ev-info-banner {` | Instrucción de ejecución en el contexto del script: `.ev-info-banner {`. |
| `73` | `    background: #f0f4ff;` | Instrucción de ejecución en el contexto del script: `background: #f0f4ff;`. |
| `74` | `    border: 1px solid #dbe4ff;` | Instrucción de ejecución en el contexto del script: `border: 1px solid #dbe4ff;`. |
| `75` | `    border-radius: 10px;` | Instrucción de ejecución en el contexto del script: `border-radius: 10px;`. |
| `76` | `    padding: 1rem 1.25rem;` | Instrucción de ejecución en el contexto del script: `padding: 1rem 1.25rem;`. |
| `77` | `    margin-bottom: 1.25rem;` | Instrucción de ejecución en el contexto del script: `margin-bottom: 1.25rem;`. |
| `78` | `}` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `79` | `.ev-info-banner .banner-title {` | Instrucción de ejecución en el contexto del script: `.ev-info-banner .banner-title {`. |
| `80` | `    font-size: .88rem;` | Instrucción de ejecución en el contexto del script: `font-size: .88rem;`. |
| `81` | `    font-weight: 700;` | Instrucción de ejecución en el contexto del script: `font-weight: 700;`. |
| `82` | `    color: #3730a3;` | Instrucción de ejecución en el contexto del script: `color: #3730a3;`. |
| `83` | `    margin-bottom: .15rem;` | Instrucción de ejecución en el contexto del script: `margin-bottom: .15rem;`. |
| `84` | `}` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `85` | `.ev-info-banner .banner-sub {` | Instrucción de ejecución en el contexto del script: `.ev-info-banner .banner-sub {`. |
| `86` | `    font-size: .78rem;` | Instrucción de ejecución en el contexto del script: `font-size: .78rem;`. |
| `87` | `    color: #4f46e5;` | Instrucción de ejecución en el contexto del script: `color: #4f46e5;`. |
| `88` | `}` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `89` | `.ev-chip {` | Instrucción de ejecución en el contexto del script: `.ev-chip {`. |
| `90` | `    background: #fff;` | Instrucción de ejecución en el contexto del script: `background: #fff;`. |
| `91` | `    border: 1px solid #e5e7eb;` | Instrucción de ejecución en el contexto del script: `border: 1px solid #e5e7eb;`. |
| `92` | `    border-radius: 10px;` | Instrucción de ejecución en el contexto del script: `border-radius: 10px;`. |
| `93` | `    padding: .75rem 1rem;` | Instrucción de ejecución en el contexto del script: `padding: .75rem 1rem;`. |
| `94` | `    display: flex;` | Instrucción de ejecución en el contexto del script: `display: flex;`. |
| `95` | `    align-items: center;` | Instrucción de ejecución en el contexto del script: `align-items: center;`. |
| `96` | `    gap: .85rem;` | Instrucción de ejecución en el contexto del script: `gap: .85rem;`. |
| `97` | `    flex: 1;` | Instrucción de ejecución en el contexto del script: `flex: 1;`. |
| `98` | `}` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `99` | `.ev-chip-icon {` | Instrucción de ejecución en el contexto del script: `.ev-chip-icon {`. |
| `100` | `    width: 42px; height: 42px;` | Instrucción de ejecución en el contexto del script: `width: 42px; height: 42px;`. |
| `101` | `    border-radius: 10px;` | Instrucción de ejecución en el contexto del script: `border-radius: 10px;`. |
| `102` | `    display: flex; align-items: center; justify-content: center;` | Instrucción de ejecución en el contexto del script: `display: flex; align-items: center; justify-content: center;`. |
| `103` | `    font-size: 1.1rem;` | Instrucción de ejecución en el contexto del script: `font-size: 1.1rem;`. |
| `104` | `    flex-shrink: 0;` | Instrucción de ejecución en el contexto del script: `flex-shrink: 0;`. |
| `105` | `}` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `106` | `.ev-chip-label {` | Instrucción de ejecución en el contexto del script: `.ev-chip-label {`. |
| `107` | `    font-size: .72rem;` | Instrucción de ejecución en el contexto del script: `font-size: .72rem;`. |
| `108` | `    color: #6b7280;` | Instrucción de ejecución en el contexto del script: `color: #6b7280;`. |
| `109` | `    margin-bottom: .1rem;` | Instrucción de ejecución en el contexto del script: `margin-bottom: .1rem;`. |
| `110` | `}` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `111` | `.ev-chip-value {` | Instrucción de ejecución en el contexto del script: `.ev-chip-value {`. |
| `112` | `    font-size: .95rem;` | Instrucción de ejecución en el contexto del script: `font-size: .95rem;`. |
| `113` | `    font-weight: 700;` | Instrucción de ejecución en el contexto del script: `font-weight: 700;`. |
| `114` | `    color: #111827;` | Instrucción de ejecución en el contexto del script: `color: #111827;`. |
| `115` | `}` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `116` | `.ev-field label {` | Instrucción de ejecución en el contexto del script: `.ev-field label {`. |
| `117` | `    font-size: .875rem;` | Instrucción de ejecución en el contexto del script: `font-size: .875rem;`. |
| `118` | `    font-weight: 600;` | Instrucción de ejecución en el contexto del script: `font-weight: 600;`. |
| `119` | `    color: #374151;` | Instrucción de ejecución en el contexto del script: `color: #374151;`. |
| `120` | `    display: block;` | Instrucción de ejecución en el contexto del script: `display: block;`. |
| `121` | `    margin-bottom: .4rem;` | Instrucción de ejecución en el contexto del script: `margin-bottom: .4rem;`. |
| `122` | `}` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `123` | `.ev-field .form-control,` | Instrucción de ejecución en el contexto del script: `.ev-field .form-control,`. |
| `124` | `.ev-field .form-control:disabled,` | Instrucción de ejecución en el contexto del script: `.ev-field .form-control:disabled,`. |
| `125` | `.ev-field .form-control[readonly] {` | Instrucción de ejecución en el contexto del script: `.ev-field .form-control[readonly] {`. |
| `126` | `    font-size: .875rem;` | Instrucción de ejecución en el contexto del script: `font-size: .875rem;`. |
| `127` | `    border: 1px solid #e5e7eb;` | Instrucción de ejecución en el contexto del script: `border: 1px solid #e5e7eb;`. |
| `128` | `    border-radius: 8px;` | Instrucción de ejecución en el contexto del script: `border-radius: 8px;`. |
| `129` | `    padding: .6rem .85rem;` | Instrucción de ejecución en el contexto del script: `padding: .6rem .85rem;`. |
| `130` | `    color: #374151;` | Instrucción de ejecución en el contexto del script: `color: #374151;`. |
| `131` | `    background: #f9fafb;` | Instrucción de ejecución en el contexto del script: `background: #f9fafb;`. |
| `132` | `}` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `133` | `.ev-field .form-control:not(:disabled):not([readonly]) {` | Instrucción de ejecución en el contexto del script: `.ev-field .form-control:not(:disabled):not([readonly]) {`. |
| `134` | `    background: #fff;` | Instrucción de ejecución en el contexto del script: `background: #fff;`. |
| `135` | `}` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `136` | `.ev-field .field-hint {` | Instrucción de ejecución en el contexto del script: `.ev-field .field-hint {`. |
| `137` | `    font-size: .75rem;` | Instrucción de ejecución en el contexto del script: `font-size: .75rem;`. |
| `138` | `    color: #9ca3af;` | Instrucción de ejecución en el contexto del script: `color: #9ca3af;`. |
| `139` | `    margin-top: .25rem;` | Instrucción de ejecución en el contexto del script: `margin-top: .25rem;`. |
| `140` | `}` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `141` | `.ev-drop-zone {` | Instrucción de ejecución en el contexto del script: `.ev-drop-zone {`. |
| `142` | `    border: 2px dashed #d1d5db;` | Instrucción de ejecución en el contexto del script: `border: 2px dashed #d1d5db;`. |
| `143` | `    border-radius: 10px;` | Instrucción de ejecución en el contexto del script: `border-radius: 10px;`. |
| `144` | `    background: #f9fafb;` | Instrucción de ejecución en el contexto del script: `background: #f9fafb;`. |
| `145` | `    min-height: 160px;` | Instrucción de ejecución en el contexto del script: `min-height: 160px;`. |
| `146` | `    display: flex;` | Instrucción de ejecución en el contexto del script: `display: flex;`. |
| `147` | `    flex-direction: column;` | Instrucción de ejecución en el contexto del script: `flex-direction: column;`. |
| `148` | `    align-items: center;` | Instrucción de ejecución en el contexto del script: `align-items: center;`. |
| `149` | `    justify-content: center;` | Instrucción de ejecución en el contexto del script: `justify-content: center;`. |
| `150` | `    cursor: pointer;` | Instrucción de ejecución en el contexto del script: `cursor: pointer;`. |
| `151` | `    transition: border-color .2s, background .2s;` | Instrucción de ejecución en el contexto del script: `transition: border-color .2s, background .2s;`. |
| `152` | `    position: relative;` | Instrucción de ejecución en el contexto del script: `position: relative;`. |
| `153` | `    overflow: hidden;` | Instrucción de ejecución en el contexto del script: `overflow: hidden;`. |
| `154` | `    padding: 1.5rem;` | Instrucción de ejecución en el contexto del script: `padding: 1.5rem;`. |
| `155` | `    text-align: center;` | Instrucción de ejecución en el contexto del script: `text-align: center;`. |
| `156` | `}` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `157` | `.ev-drop-zone:hover,` | Instrucción de ejecución en el contexto del script: `.ev-drop-zone:hover,`. |
| `158` | `.ev-drop-zone.drag-over {` | Instrucción de ejecución en el contexto del script: `.ev-drop-zone.drag-over {`. |
| `159` | `    border-color: #4f46e5;` | Instrucción de ejecución en el contexto del script: `border-color: #4f46e5;`. |
| `160` | `    background: #f0f4ff;` | Instrucción de ejecución en el contexto del script: `background: #f0f4ff;`. |
| `161` | `}` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `162` | `.ev-drop-zone .drop-icon {` | Instrucción de ejecución en el contexto del script: `.ev-drop-zone .drop-icon {`. |
| `163` | `    font-size: 2rem;` | Instrucción de ejecución en el contexto del script: `font-size: 2rem;`. |
| `164` | `    color: #9ca3af;` | Instrucción de ejecución en el contexto del script: `color: #9ca3af;`. |
| `165` | `    margin-bottom: .6rem;` | Instrucción de ejecución en el contexto del script: `margin-bottom: .6rem;`. |
| `166` | `}` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `167` | `.ev-drop-zone .drop-text {` | Instrucción de ejecución en el contexto del script: `.ev-drop-zone .drop-text {`. |
| `168` | `    font-size: .82rem;` | Instrucción de ejecución en el contexto del script: `font-size: .82rem;`. |
| `169` | `    color: #6b7280;` | Instrucción de ejecución en el contexto del script: `color: #6b7280;`. |
| `170` | `    margin-bottom: .2rem;` | Instrucción de ejecución en el contexto del script: `margin-bottom: .2rem;`. |
| `171` | `}` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `172` | `.ev-drop-zone .drop-hint {` | Instrucción de ejecución en el contexto del script: `.ev-drop-zone .drop-hint {`. |
| `173` | `    font-size: .74rem;` | Instrucción de ejecución en el contexto del script: `font-size: .74rem;`. |
| `174` | `    color: #9ca3af;` | Instrucción de ejecución en el contexto del script: `color: #9ca3af;`. |
| `175` | `}` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `176` | `.ev-drop-zone img {` | Instrucción de ejecución en el contexto del script: `.ev-drop-zone img {`. |
| `177` | `    width: 100%; height: 200px;` | Instrucción de ejecución en el contexto del script: `width: 100%; height: 200px;`. |
| `178` | `    object-fit: cover;` | Instrucción de ejecución en el contexto del script: `object-fit: cover;`. |
| `179` | `    border-radius: 8px;` | Instrucción de ejecución en el contexto del script: `border-radius: 8px;`. |
| `180` | `}` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `181` | `.ev-file-input {` | Instrucción de ejecución en el contexto del script: `.ev-file-input {`. |
| `182` | `    margin-top: .6rem;` | Instrucción de ejecución en el contexto del script: `margin-top: .6rem;`. |
| `183` | `    font-size: .82rem;` | Instrucción de ejecución en el contexto del script: `font-size: .82rem;`. |
| `184` | `}` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `185` | `.btn-enviar {` | Instrucción de ejecución en el contexto del script: `.btn-enviar {`. |
| `186` | `    background: #4f46e5;` | Instrucción de ejecución en el contexto del script: `background: #4f46e5;`. |
| `187` | `    color: #fff;` | Instrucción de ejecución en el contexto del script: `color: #fff;`. |
| `188` | `    border: none;` | Instrucción de ejecución en el contexto del script: `border: none;`. |
| `189` | `    border-radius: 10px;` | Instrucción de ejecución en el contexto del script: `border-radius: 10px;`. |
| `190` | `    width: 100%;` | Instrucción de ejecución en el contexto del script: `width: 100%;`. |
| `191` | `    padding: .85rem;` | Instrucción de ejecución en el contexto del script: `padding: .85rem;`. |
| `192` | `    font-size: .95rem;` | Instrucción de ejecución en el contexto del script: `font-size: .95rem;`. |
| `193` | `    font-weight: 600;` | Instrucción de ejecución en el contexto del script: `font-weight: 600;`. |
| `194` | `    cursor: pointer;` | Instrucción de ejecución en el contexto del script: `cursor: pointer;`. |
| `195` | `    display: flex;` | Instrucción de ejecución en el contexto del script: `display: flex;`. |
| `196` | `    align-items: center;` | Instrucción de ejecución en el contexto del script: `align-items: center;`. |
| `197` | `    justify-content: center;` | Instrucción de ejecución en el contexto del script: `justify-content: center;`. |
| `198` | `    gap: .5rem;` | Instrucción de ejecución en el contexto del script: `gap: .5rem;`. |
| `199` | `    transition: background .2s, transform .15s;` | Instrucción de ejecución en el contexto del script: `transition: background .2s, transform .15s;`. |
| `200` | `}` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `201` | `.btn-enviar:hover { background: #4338ca; transform: translateY(-1px); }` | Instrucción de ejecución en el contexto del script: `.btn-enviar:hover { background: #4338ca; transform: translateY(-1px); }`. |
| `202` | `.btn-enviar:active { transform: translateY(0); }` | Instrucción de ejecución en el contexto del script: `.btn-enviar:active { transform: translateY(0); }`. |
| `203` | `.ev-success-banner {` | Instrucción de ejecución en el contexto del script: `.ev-success-banner {`. |
| `204` | `    background: #f0fdf4;` | Instrucción de ejecución en el contexto del script: `background: #f0fdf4;`. |
| `205` | `    border: 1px solid #86efac;` | Instrucción de ejecución en el contexto del script: `border: 1px solid #86efac;`. |
| `206` | `    border-radius: 10px;` | Instrucción de ejecución en el contexto del script: `border-radius: 10px;`. |
| `207` | `    padding: 1.25rem 1.5rem;` | Instrucción de ejecución en el contexto del script: `padding: 1.25rem 1.5rem;`. |
| `208` | `    display: flex;` | Instrucción de ejecución en el contexto del script: `display: flex;`. |
| `209` | `    align-items: center;` | Instrucción de ejecución en el contexto del script: `align-items: center;`. |
| `210` | `    gap: 1rem;` | Instrucción de ejecución en el contexto del script: `gap: 1rem;`. |
| `211` | `    margin-bottom: 1.25rem;` | Instrucción de ejecución en el contexto del script: `margin-bottom: 1.25rem;`. |
| `212` | `}` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `213` | `.ev-no-turno {` | Instrucción de ejecución en el contexto del script: `.ev-no-turno {`. |
| `214` | `    background: #f9fafb;` | Instrucción de ejecución en el contexto del script: `background: #f9fafb;`. |
| `215` | `    border: 1px dashed #d1d5db;` | Instrucción de ejecución en el contexto del script: `border: 1px dashed #d1d5db;`. |
| `216` | `    border-radius: 12px;` | Instrucción de ejecución en el contexto del script: `border-radius: 12px;`. |
| `217` | `    padding: 2.5rem 1.5rem;` | Instrucción de ejecución en el contexto del script: `padding: 2.5rem 1.5rem;`. |
| `218` | `    text-align: center;` | Instrucción de ejecución en el contexto del script: `text-align: center;`. |
| `219` | `    margin-bottom: 1.25rem;` | Instrucción de ejecución en el contexto del script: `margin-bottom: 1.25rem;`. |
| `220` | `}` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `221` | `/* Historial */` | Comentario de bloque o anotación informativa dentro del código. |
| `222` | `.hist-table th {` | Instrucción de ejecución en el contexto del script: `.hist-table th {`. |
| `223` | `    font-size: .72rem;` | Instrucción de ejecución en el contexto del script: `font-size: .72rem;`. |
| `224` | `    font-weight: 700;` | Instrucción de ejecución en el contexto del script: `font-weight: 700;`. |
| `225` | `    text-transform: uppercase;` | Instrucción de ejecución en el contexto del script: `text-transform: uppercase;`. |
| `226` | `    letter-spacing: .4px;` | Instrucción de ejecución en el contexto del script: `letter-spacing: .4px;`. |
| `227` | `    color: #6b7280;` | Instrucción de ejecución en el contexto del script: `color: #6b7280;`. |
| `228` | `    border-bottom: 2px solid #e5e7eb;` | Instrucción de ejecución en el contexto del script: `border-bottom: 2px solid #e5e7eb;`. |
| `229` | `    padding: .6rem .75rem;` | Instrucción de ejecución en el contexto del script: `padding: .6rem .75rem;`. |
| `230` | `    background: #f9fafb;` | Instrucción de ejecución en el contexto del script: `background: #f9fafb;`. |
| `231` | `}` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `232` | `.hist-table td {` | Instrucción de ejecución en el contexto del script: `.hist-table td {`. |
| `233` | `    font-size: .82rem;` | Instrucción de ejecución en el contexto del script: `font-size: .82rem;`. |
| `234` | `    padding: .65rem .75rem;` | Instrucción de ejecución en el contexto del script: `padding: .65rem .75rem;`. |
| `235` | `    border-bottom: 1px solid #f3f4f6;` | Instrucción de ejecución en el contexto del script: `border-bottom: 1px solid #f3f4f6;`. |
| `236` | `    color: #374151;` | Instrucción de ejecución en el contexto del script: `color: #374151;`. |
| `237` | `    vertical-align: middle;` | Instrucción de ejecución en el contexto del script: `vertical-align: middle;`. |
| `238` | `}` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `239` | `</style>` | Instrucción de ejecución en el contexto del script: `</style>`. |
| `240` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `241` | `<div class="ev-page">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="ev-page">`. |
| `242` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `243` | `    <!-- ══ TÍTULO ════════════════════════════════════════════════════════...` | Instrucción de ejecución en el contexto del script: `<!-- ══ TÍTULO ══════════════════════════════════════════════════════════ -->`. |
| `244` | `    <div class="text-center mb-4">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="text-center mb-4">`. |
| `245` | `        <h3 class="fw-bold mb-1" style="color:#111827;">Subir Evidencia de ...` | Instrucción de ejecución en el contexto del script: `<h3 class="fw-bold mb-1" style="color:#111827;">Subir Evidencia de Limpieza</h3>`. |
| `246` | `        <p class="text-muted small mb-0">` | Instrucción de ejecución en el contexto del script: `<p class="text-muted small mb-0">`. |
| `247` | `            Carga fotografías que demuestren el cumplimiento de la limpieza...` | Instrucción de ejecución en el contexto del script: `Carga fotografías que demuestren el cumplimiento de la limpieza del módulo asignado`. |
| `248` | `        </p>` | Instrucción de ejecución en el contexto del script: `</p>`. |
| `249` | `    </div>` | Cierre de contenedor visual `<div>`. |
| `250` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `251` | `    <!-- ══ BANNER TURNO HOY ══════════════════════════════════════════════...` | Instrucción de ejecución en el contexto del script: `<!-- ══ BANNER TURNO HOY ════════════════════════════════════════════════ -->`. |
| `252` | `    <?php if ($turnoHoy): ?>` | Instrucción de ejecución en el contexto del script: `<?php if ($turnoHoy): ?>`. |
| `253` | `    <div class="ev-info-banner">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="ev-info-banner">`. |
| `254` | `        <div class="banner-title">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="banner-title">`. |
| `255` | `            <i class="fas fa-circle-check me-1"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-circle-check me-1"></i>`. |
| `256` | `            Información de Limpieza — <?= $diasES[(int)(new DateTime($turno...` | Instrucción de ejecución en el contexto del script: `Información de Limpieza — <?= $diasES[(int)(new DateTime($turnoHoy['fecha_turno']))->format('w')] ?>`. |
| `257` | `        </div>` | Cierre de contenedor visual `<div>`. |
| `258` | `        <div class="banner-sub mb-3">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="banner-sub mb-3">`. |
| `259` | `            Datos asignados automáticamente según tu ficha y calendario de ...` | Instrucción de ejecución en el contexto del script: `Datos asignados automáticamente según tu ficha y calendario de rotación`. |
| `260` | `        </div>` | Cierre de contenedor visual `<div>`. |
| `261` | `        <div class="d-flex gap-3 flex-wrap">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="d-flex gap-3 flex-wrap">`. |
| `262` | `            <!-- Módulo -->` | Instrucción de ejecución en el contexto del script: `<!-- Módulo -->`. |
| `263` | `            <div class="ev-chip">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="ev-chip">`. |
| `264` | `                <div class="ev-chip-icon" style="background:#eef2ff; color:...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="ev-chip-icon" style="background:#eef2ff; color:#4f46e5;">`. |
| `265` | `                    <i class="fas fa-building-columns"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-building-columns"></i>`. |
| `266` | `                </div>` | Cierre de contenedor visual `<div>`. |
| `267` | `                <div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div>`. |
| `268` | `                    <div class="ev-chip-label">Módulo Asignado</div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="ev-chip-label">Módulo Asignado</div>`. |
| `269` | `                    <div class="ev-chip-value"><?= htmlspecialchars($turnoH...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="ev-chip-value"><?= htmlspecialchars($turnoHoy['nombre_modulo']) ?></div>`. |
| `270` | `                </div>` | Cierre de contenedor visual `<div>`. |
| `271` | `            </div>` | Cierre de contenedor visual `<div>`. |
| `272` | `            <!-- Grupo -->` | Instrucción de ejecución en el contexto del script: `<!-- Grupo -->`. |
| `273` | `            <div class="ev-chip">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="ev-chip">`. |
| `274` | `                <div class="ev-chip-icon" style="background:#f5f3ff; color:...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="ev-chip-icon" style="background:#f5f3ff; color:#7c3aed;">`. |
| `275` | `                    <i class="fas fa-people-group"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-people-group"></i>`. |
| `276` | `                </div>` | Cierre de contenedor visual `<div>`. |
| `277` | `                <div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div>`. |
| `278` | `                    <div class="ev-chip-label">Grupo de Hoy</div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="ev-chip-label">Grupo de Hoy</div>`. |
| `279` | `                    <div class="ev-chip-value">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="ev-chip-value">`. |
| `280` | `                        <?= $turnoHoy['nombre_grupo']` | Instrucción de ejecución en el contexto del script: `<?= $turnoHoy['nombre_grupo']`. |
| `281` | `                            ? htmlspecialchars($turnoHoy['nombre_grupo'])` | Instrucción de ejecución en el contexto del script: `? htmlspecialchars($turnoHoy['nombre_grupo'])`. |
| `282` | `                            : '<span style="color:#f59e0b;font-size:.85rem;...` | Instrucción de ejecución en el contexto del script: `: '<span style="color:#f59e0b;font-size:.85rem;">Sin grupo</span>' ?>`. |
| `283` | `                    </div>` | Cierre de contenedor visual `<div>`. |
| `284` | `                </div>` | Cierre de contenedor visual `<div>`. |
| `285` | `            </div>` | Cierre de contenedor visual `<div>`. |
| `286` | `        </div>` | Cierre de contenedor visual `<div>`. |
| `287` | `    </div>` | Cierre de contenedor visual `<div>`. |
| `288` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `289` | `    <?php elseif ($idFicha): ?>` | Instrucción de ejecución en el contexto del script: `<?php elseif ($idFicha): ?>`. |
| `290` | `    <div class="ev-no-turno">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="ev-no-turno">`. |
| `291` | `        <i class="fas fa-calendar-xmark fa-2x text-muted opacity-40 d-block...` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-calendar-xmark fa-2x text-muted opacity-40 d-block mb-3"></i>`. |
| `292` | `        <div class="fw-semibold text-muted mb-1">No hay turno de limpieza p...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="fw-semibold text-muted mb-1">No hay turno de limpieza programado para hoy</div>`. |
| `293` | `        <div class="text-muted small">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="text-muted small">`. |
| `294` | `            Revisa el historial para ver tu próxima fecha de limpieza.` | Instrucción de ejecución en el contexto del script: `Revisa el historial para ver tu próxima fecha de limpieza.`. |
| `295` | `        </div>` | Cierre de contenedor visual `<div>`. |
| `296` | `    </div>` | Cierre de contenedor visual `<div>`. |
| `297` | `    <?php endif; ?>` | Instrucción de ejecución en el contexto del script: `<?php endif; ?>`. |
| `298` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `299` | `    <!-- ══ EVIDENCIA YA ENTREGADA ════════════════════════════════════════...` | Instrucción de ejecución en el contexto del script: `<!-- ══ EVIDENCIA YA ENTREGADA ══════════════════════════════════════════ -->`. |
| `300` | `    <?php if ($turnoHoy && (int)$turnoHoy['tiene_evidencia'] > 0): ?>` | Instrucción de ejecución en el contexto del script: `<?php if ($turnoHoy && (int)$turnoHoy['tiene_evidencia'] > 0): ?>`. |
| `301` | `    <div class="ev-success-banner">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="ev-success-banner">`. |
| `302` | `        <i class="fas fa-circle-check text-success fa-2x flex-shrink-0"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-circle-check text-success fa-2x flex-shrink-0"></i>`. |
| `303` | `        <div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div>`. |
| `304` | `            <div class="fw-bold text-success mb-0">¡Evidencia del día ya en...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="fw-bold text-success mb-0">¡Evidencia del día ya entregada!</div>`. |
| `305` | `            <div class="text-muted small">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="text-muted small">`. |
| `306` | `                Ya registraste la evidencia de limpieza de hoy correctamente.` | Instrucción de ejecución en el contexto del script: `Ya registraste la evidencia de limpieza de hoy correctamente.`. |
| `307` | `                Puedes ver el historial más abajo.` | Instrucción de ejecución en el contexto del script: `Puedes ver el historial más abajo.`. |
| `308` | `            </div>` | Cierre de contenedor visual `<div>`. |
| `309` | `        </div>` | Cierre de contenedor visual `<div>`. |
| `310` | `    </div>` | Cierre de contenedor visual `<div>`. |
| `311` | `    <?php endif; ?>` | Instrucción de ejecución en el contexto del script: `<?php endif; ?>`. |
| `312` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `313` | `    <!-- ══ FORMULARIO NUEVA EVIDENCIA ════════════════════════════════════...` | Instrucción de ejecución en el contexto del script: `<!-- ══ FORMULARIO NUEVA EVIDENCIA ══════════════════════════════════════ -->`. |
| `314` | `    <?php if ($turnoHoy && (int)$turnoHoy['tiene_evidencia'] === 0): ?>` | Instrucción de ejecución en el contexto del script: `<?php if ($turnoHoy && (int)$turnoHoy['tiene_evidencia'] === 0): ?>`. |
| `315` | `    <div class="ev-card">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="ev-card">`. |
| `316` | `        <div class="ev-card-title">Nueva Evidencia</div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="ev-card-title">Nueva Evidencia</div>`. |
| `317` | `        <div class="ev-card-sub">La información del módulo y grupo se compl...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="ev-card-sub">La información del módulo y grupo se completó automáticamente</div>`. |
| `318` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `319` | `        <form action="../../controllers/VoceroController.php"` | Formulario para recolección y envío de datos del usuario: `<form action="../../controllers/VoceroController.php"`. |
| `320` | `              method="POST" enctype="multipart/form-data" id="formEvidencia">` | Instrucción de ejecución en el contexto del script: `method="POST" enctype="multipart/form-data" id="formEvidencia">`. |
| `321` | `            <input type="hidden" name="accion"   value="subir_evidencia_tur...` | Campo de entrada interactivo para datos del usuario: `<input type="hidden" name="accion"   value="subir_evidencia_turno">`. |
| `322` | `            <input type="hidden" name="id_turno" value="<?= $turnoHoy['id_t...` | Campo de entrada interactivo para datos del usuario: `<input type="hidden" name="id_turno" value="<?= $turnoHoy['id_turno'] ?>">`. |
| `323` | `            <input type="hidden" name="id_grupo" value="<?= $turnoHoy['id_g...` | Campo de entrada interactivo para datos del usuario: `<input type="hidden" name="id_grupo" value="<?= $turnoHoy['id_grupo_turno'] ?? '' ?>">`. |
| `324` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `325` | `            <!-- Módulo -->` | Instrucción de ejecución en el contexto del script: `<!-- Módulo -->`. |
| `326` | `            <div class="ev-field mb-3">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="ev-field mb-3">`. |
| `327` | `                <label>Módulo</label>` | Instrucción de ejecución en el contexto del script: `<label>Módulo</label>`. |
| `328` | `                <input type="text" class="form-control"` | Campo de entrada interactivo para datos del usuario: `<input type="text" class="form-control"`. |
| `329` | `                       value="<?= htmlspecialchars($turnoHoy['nombre_modulo...` | Instrucción de ejecución en el contexto del script: `value="<?= htmlspecialchars($turnoHoy['nombre_modulo']) ?>" disabled>`. |
| `330` | `                <div class="field-hint">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="field-hint">`. |
| `331` | `                    Este es el módulo asignado a tu ficha` | Instrucción de ejecución en el contexto del script: `Este es el módulo asignado a tu ficha`. |
| `332` | `                    <?= $fichaInfo ? htmlspecialchars($fichaInfo['numero_fi...` | Instrucción de ejecución en el contexto del script: `<?= $fichaInfo ? htmlspecialchars($fichaInfo['numero_ficha']) : '' ?>`. |
| `333` | `                </div>` | Cierre de contenedor visual `<div>`. |
| `334` | `            </div>` | Cierre de contenedor visual `<div>`. |
| `335` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `336` | `            <!-- Fecha -->` | Instrucción de ejecución en el contexto del script: `<!-- Fecha -->`. |
| `337` | `            <div class="ev-field mb-3">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="ev-field mb-3">`. |
| `338` | `                <label>Fecha de Limpieza</label>` | Instrucción de ejecución en el contexto del script: `<label>Fecha de Limpieza</label>`. |
| `339` | `                <input type="text" class="form-control"` | Campo de entrada interactivo para datos del usuario: `<input type="text" class="form-control"`. |
| `340` | `                       value="<?= date('d/m/Y', strtotime($turnoHoy['fecha_...` | Instrucción de ejecución en el contexto del script: `value="<?= date('d/m/Y', strtotime($turnoHoy['fecha_turno'])) ?>" disabled>`. |
| `341` | `            </div>` | Cierre de contenedor visual `<div>`. |
| `342` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `343` | `            <!-- Grupo -->` | Instrucción de ejecución en el contexto del script: `<!-- Grupo -->`. |
| `344` | `            <div class="ev-field mb-3">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="ev-field mb-3">`. |
| `345` | `                <label>Grupo Responsable</label>` | Instrucción de ejecución en el contexto del script: `<label>Grupo Responsable</label>`. |
| `346` | `                <input type="text" class="form-control"` | Campo de entrada interactivo para datos del usuario: `<input type="text" class="form-control"`. |
| `347` | `                       value="<?= $turnoHoy['nombre_grupo']` | Instrucción de ejecución en el contexto del script: `value="<?= $turnoHoy['nombre_grupo']`. |
| `348` | `                                   ? htmlspecialchars($turnoHoy['nombre_gru...` | Instrucción de ejecución en el contexto del script: `? htmlspecialchars($turnoHoy['nombre_grupo'])`. |
| `349` | `                                   : 'Sin grupo asignado' ?>" disabled>` | Instrucción de ejecución en el contexto del script: `: 'Sin grupo asignado' ?>" disabled>`. |
| `350` | `                <div class="field-hint">Grupo asignado automáticamente segú...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="field-hint">Grupo asignado automáticamente según calendario de rotación</div>`. |
| `351` | `            </div>` | Cierre de contenedor visual `<div>`. |
| `352` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `353` | `            <!-- Observaciones -->` | Instrucción de ejecución en el contexto del script: `<!-- Observaciones -->`. |
| `354` | `            <div class="ev-field mb-4">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="ev-field mb-4">`. |
| `355` | `                <label>Observaciones <span style="color:#9ca3af;font-weight...` | Instrucción de ejecución en el contexto del script: `<label>Observaciones <span style="color:#9ca3af;font-weight:400;">(opcional)</span></label>`. |
| `356` | `                <textarea name="observaciones" class="form-control" rows="3"` | Instrucción de ejecución en el contexto del script: `<textarea name="observaciones" class="form-control" rows="3"`. |
| `357` | `                          placeholder="Agrega cualquier comentario relevante…"` | Instrucción de ejecución en el contexto del script: `placeholder="Agrega cualquier comentario relevante…"`. |
| `358` | `                          style="resize:none; background:#fff;"></textarea>` | Instrucción de ejecución en el contexto del script: `style="resize:none; background:#fff;"></textarea>`. |
| `359` | `            </div>` | Cierre de contenedor visual `<div>`. |
| `360` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `361` | `            <!-- Foto -->` | Instrucción de ejecución en el contexto del script: `<!-- Foto -->`. |
| `362` | `            <div class="ev-field mb-4">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="ev-field mb-4">`. |
| `363` | `                <label>Fotografía de Evidencia</label>` | Instrucción de ejecución en el contexto del script: `<label>Fotografía de Evidencia</label>`. |
| `364` | `                <div class="ev-drop-zone" id="dropZone"` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="ev-drop-zone" id="dropZone"`. |
| `365` | `                     onclick="document.getElementById('inputFoto').click()"` | Instrucción de ejecución en el contexto del script: `onclick="document.getElementById('inputFoto').click()"`. |
| `366` | `                     ondragover="event.preventDefault(); this.classList.add...` | Instrucción de ejecución en el contexto del script: `ondragover="event.preventDefault(); this.classList.add('drag-over')"`. |
| `367` | `                     ondragleave="this.classList.remove('drag-over')"` | Instrucción de ejecución en el contexto del script: `ondragleave="this.classList.remove('drag-over')"`. |
| `368` | `                     ondrop="handleDrop(event)">` | Instrucción de ejecución en el contexto del script: `ondrop="handleDrop(event)">`. |
| `369` | `                    <div id="dropContent">` | Contenedor visual estructurado con Bootstrap/CSS: `<div id="dropContent">`. |
| `370` | `                        <div class="drop-icon"><i class="fas fa-camera"></i...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="drop-icon"><i class="fas fa-camera"></i></div>`. |
| `371` | `                        <div class="drop-text">Haz clic para seleccionar un...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="drop-text">Haz clic para seleccionar una imagen</div>`. |
| `372` | `                        <div class="drop-hint">JPG, JPEG o PNG (máx. 10 MB)...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="drop-hint">JPG, JPEG o PNG (máx. 10 MB)</div>`. |
| `373` | `                    </div>` | Cierre de contenedor visual `<div>`. |
| `374` | `                    <img id="previewImg" src="#" alt="Vista previa" class="...` | Instrucción de ejecución en el contexto del script: `<img id="previewImg" src="#" alt="Vista previa" class="d-none">`. |
| `375` | `                </div>` | Cierre de contenedor visual `<div>`. |
| `376` | `                <input type="file" id="inputFoto" name="evidencia"` | Campo de entrada interactivo para datos del usuario: `<input type="file" id="inputFoto" name="evidencia"`. |
| `377` | `                       accept=".jpg,.jpeg,.png" required` | Instrucción de ejecución en el contexto del script: `accept=".jpg,.jpeg,.png" required`. |
| `378` | `                       class="form-control ev-file-input"` | Instrucción de ejecución en el contexto del script: `class="form-control ev-file-input"`. |
| `379` | `                       onchange="previsualizarFoto(this)">` | Instrucción de ejecución en el contexto del script: `onchange="previsualizarFoto(this)">`. |
| `380` | `            </div>` | Cierre de contenedor visual `<div>`. |
| `381` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `382` | `            <!-- Botón agregar segunda foto -->` | Instrucción de ejecución en el contexto del script: `<!-- Botón agregar segunda foto -->`. |
| `383` | `            <div class="mt-2 mb-1">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="mt-2 mb-1">`. |
| `384` | `                <button type="button" class="btn btn-sm btn-outline-seconda...` | Botón de acción interactivo para el usuario: `<button type="button" class="btn btn-sm btn-outline-secondary" onclick="toggleFoto2()">`. |
| `385` | `                    <i class="fas fa-plus me-1"></i>Agregar segunda foto` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-plus me-1"></i>Agregar segunda foto`. |
| `386` | `                </button>` | Botón de acción interactivo para el usuario: `</button>`. |
| `387` | `            </div>` | Cierre de contenedor visual `<div>`. |
| `388` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `389` | `            <!-- Segunda foto (oculta por defecto) -->` | Instrucción de ejecución en el contexto del script: `<!-- Segunda foto (oculta por defecto) -->`. |
| `390` | `            <div class="ev-field mb-4" id="foto2Section" style="display:non...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="ev-field mb-4" id="foto2Section" style="display:none;">`. |
| `391` | `                <label class="form-label fw-semibold small">` | Instrucción de ejecución en el contexto del script: `<label class="form-label fw-semibold small">`. |
| `392` | `                    Segunda Fotografía <span class="text-muted fw-normal">(...` | Instrucción de ejecución en el contexto del script: `Segunda Fotografía <span class="text-muted fw-normal">(opcional)</span>`. |
| `393` | `                </label>` | Instrucción de ejecución en el contexto del script: `</label>`. |
| `394` | `                <div id="dropZone2"` | Contenedor visual estructurado con Bootstrap/CSS: `<div id="dropZone2"`. |
| `395` | `                     onclick="document.getElementById('inputFoto2').click()"` | Instrucción de ejecución en el contexto del script: `onclick="document.getElementById('inputFoto2').click()"`. |
| `396` | `                     ondragover="event.preventDefault(); activarDrop2()"` | Instrucción de ejecución en el contexto del script: `ondragover="event.preventDefault(); activarDrop2()"`. |
| `397` | `                     ondragleave="desactivarDrop2()"` | Instrucción de ejecución en el contexto del script: `ondragleave="desactivarDrop2()"`. |
| `398` | `                     ondrop="handleDrop2(event)"` | Instrucción de ejecución en el contexto del script: `ondrop="handleDrop2(event)"`. |
| `399` | `                     style="border:2px dashed #d1d5db; border-radius:14px; ...` | Instrucción de ejecución en el contexto del script: `style="border:2px dashed #d1d5db; border-radius:14px; min-height:160px;`. |
| `400` | `                            display:flex; flex-direction:column; align-item...` | Instrucción de ejecución en el contexto del script: `display:flex; flex-direction:column; align-items:center;`. |
| `401` | `                            justify-content:center; cursor:pointer; transit...` | Instrucción de ejecución en el contexto del script: `justify-content:center; cursor:pointer; transition:all .25s;`. |
| `402` | `                            background:#fafafa; padding:1.5rem; text-align:...` | Instrucción de ejecución en el contexto del script: `background:#fafafa; padding:1.5rem; text-align:center;">`. |
| `403` | `                    <div id="dropContent2">` | Contenedor visual estructurado con Bootstrap/CSS: `<div id="dropContent2">`. |
| `404` | `                        <i class="fas fa-camera fa-2x mb-2 text-muted opaci...` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-camera fa-2x mb-2 text-muted opacity-40"></i>`. |
| `405` | `                        <div class="text-muted small fw-semibold">Segunda f...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="text-muted small fw-semibold">Segunda foto (opcional)</div>`. |
| `406` | `                        <div class="text-muted" style="font-size:.75rem;">J...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="text-muted" style="font-size:.75rem;">JPG, JPEG o PNG (máx. 10 MB)</div>`. |
| `407` | `                    </div>` | Cierre de contenedor visual `<div>`. |
| `408` | `                    <img id="previewImg2" src="#" alt="Vista previa 2" clas...` | Instrucción de ejecución en el contexto del script: `<img id="previewImg2" src="#" alt="Vista previa 2" class="d-none"`. |
| `409` | `                         style="width:100%; height:180px; object-fit:cover;...` | Instrucción de ejecución en el contexto del script: `style="width:100%; height:180px; object-fit:cover; border-radius:10px;">`. |
| `410` | `                </div>` | Cierre de contenedor visual `<div>`. |
| `411` | `                <input type="file" id="inputFoto2" name="evidencia2"` | Campo de entrada interactivo para datos del usuario: `<input type="file" id="inputFoto2" name="evidencia2"`. |
| `412` | `                       accept=".jpg,.jpeg,.png"` | Instrucción de ejecución en el contexto del script: `accept=".jpg,.jpeg,.png"`. |
| `413` | `                       class="form-control form-control-sm mt-2"` | Instrucción de ejecución en el contexto del script: `class="form-control form-control-sm mt-2"`. |
| `414` | `                       onchange="previsualizarFoto2(this)">` | Instrucción de ejecución en el contexto del script: `onchange="previsualizarFoto2(this)">`. |
| `415` | `            </div>` | Cierre de contenedor visual `<div>`. |
| `416` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `417` | `            <!-- Botón enviar -->` | Instrucción de ejecución en el contexto del script: `<!-- Botón enviar -->`. |
| `418` | `            <button type="submit" class="btn-enviar">` | Botón de acción interactivo para el usuario: `<button type="submit" class="btn-enviar">`. |
| `419` | `                <i class="fas fa-upload"></i> Enviar Evidencia` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-upload"></i> Enviar Evidencia`. |
| `420` | `            </button>` | Botón de acción interactivo para el usuario: `</button>`. |
| `421` | `        </form>` | Cierre de formulario HTML. |
| `422` | `    </div>` | Cierre de contenedor visual `<div>`. |
| `423` | `    <?php endif; ?>` | Instrucción de ejecución en el contexto del script: `<?php endif; ?>`. |
| `424` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `425` | `    <!-- ══ HISTORIAL DE TURNOS ═══════════════════════════════════════════...` | Instrucción de ejecución en el contexto del script: `<!-- ══ HISTORIAL DE TURNOS ═════════════════════════════════════════════ -->`. |
| `426` | `    <?php if (!empty($historial)): ?>` | Instrucción de ejecución en el contexto del script: `<?php if (!empty($historial)): ?>`. |
| `427` | `    <div class="ev-card" style="padding:0; overflow:hidden;">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="ev-card" style="padding:0; overflow:hidden;">`. |
| `428` | `        <div style="padding:1rem 1.5rem; border-bottom:1px solid #f3f4f6;">` | Contenedor visual estructurado con Bootstrap/CSS: `<div style="padding:1rem 1.5rem; border-bottom:1px solid #f3f4f6;">`. |
| `429` | `            <span class="fw-bold" style="font-size:.9rem;">Historial de Tur...` | Instrucción de ejecución en el contexto del script: `<span class="fw-bold" style="font-size:.9rem;">Historial de Turnos</span>`. |
| `430` | `            <span class="badge bg-secondary ms-2" style="font-size:.7rem;">...` | Instrucción de ejecución en el contexto del script: `<span class="badge bg-secondary ms-2" style="font-size:.7rem;"><?= count($historial) ?></span>`. |
| `431` | `        </div>` | Cierre de contenedor visual `<div>`. |
| `432` | `        <div class="table-responsive">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="table-responsive">`. |
| `433` | `            <table class="table mb-0 hist-table">` | Tabla de datos para despliegue estructurado de información: `<table class="table mb-0 hist-table">`. |
| `434` | `                <thead>` | Celda de tabla con contenido de datos o encabezado de columna: `<thead>`. |
| `435` | `                    <tr>` | Fila contenedora de datos dentro de la tabla. |
| `436` | `                        <th>Fecha</th>` | Celda de tabla con contenido de datos o encabezado de columna: `<th>Fecha</th>`. |
| `437` | `                        <th>Módulo</th>` | Celda de tabla con contenido de datos o encabezado de columna: `<th>Módulo</th>`. |
| `438` | `                        <th>Grupo</th>` | Celda de tabla con contenido de datos o encabezado de columna: `<th>Grupo</th>`. |
| `439` | `                        <th>Estado</th>` | Celda de tabla con contenido de datos o encabezado de columna: `<th>Estado</th>`. |
| `440` | `                        <th class="text-center">✓</th>` | Celda de tabla con contenido de datos o encabezado de columna: `<th class="text-center">✓</th>`. |
| `441` | `                    </tr>` | Fila contenedora de datos dentro de la tabla. |
| `442` | `                </thead>` | Instrucción de ejecución en el contexto del script: `</thead>`. |
| `443` | `                <tbody>` | Instrucción de ejecución en el contexto del script: `<tbody>`. |
| `444` | `                <?php foreach ($historial as $t):` | Instrucción de ejecución en el contexto del script: `<?php foreach ($historial as $t):`. |
| `445` | `                    $badgeMap = [` | Instrucción de ejecución en el contexto del script: `$badgeMap = [`. |
| `446` | `                        'Cumplido'   => ['bg'=>'#dcfce7','color'=>'#166534'],` | Instrucción de ejecución en el contexto del script: `'Cumplido'   => ['bg'=>'#dcfce7','color'=>'#166534'],`. |
| `447` | `                        'Incumplido' => ['bg'=>'#fee2e2','color'=>'#991b1b'],` | Instrucción de ejecución en el contexto del script: `'Incumplido' => ['bg'=>'#fee2e2','color'=>'#991b1b'],`. |
| `448` | `                        'Abierto'    => ['bg'=>'#fef9c3','color'=>'#854d0e'],` | Instrucción de ejecución en el contexto del script: `'Abierto'    => ['bg'=>'#fef9c3','color'=>'#854d0e'],`. |
| `449` | `                        'Cerrado'    => ['bg'=>'#f3f4f6','color'=>'#374151'],` | Instrucción de ejecución en el contexto del script: `'Cerrado'    => ['bg'=>'#f3f4f6','color'=>'#374151'],`. |
| `450` | `                        'Pendiente'  => ['bg'=>'#f3f4f6','color'=>'#6b7280'],` | Instrucción de ejecución en el contexto del script: `'Pendiente'  => ['bg'=>'#f3f4f6','color'=>'#6b7280'],`. |
| `451` | `                    ];` | Instrucción de ejecución en el contexto del script: `];`. |
| `452` | `                    $b = $badgeMap[$t['estado']] ?? ['bg'=>'#f3f4f6','color...` | Instrucción de ejecución en el contexto del script: `$b = $badgeMap[$t['estado']] ?? ['bg'=>'#f3f4f6','color'=>'#374151'];`. |
| `453` | `                    $esFuturo = strtotime($t['fecha_turno']) > strtotime('t...` | Instrucción de ejecución en el contexto del script: `$esFuturo = strtotime($t['fecha_turno']) > strtotime('today');`. |
| `454` | `                ?>` | Cierre de la etiqueta PHP para alternar a salida HTML o fin del archivo. |
| `455` | `                <tr style="<?= $esFuturo ? 'opacity:.45' : '' ?>">` | Fila contenedora de datos dentro de la tabla. |
| `456` | `                    <td class="fw-semibold">` | Celda de tabla con contenido de datos o encabezado de columna: `<td class="fw-semibold">`. |
| `457` | `                        <?= date('d/m/Y', strtotime($t['fecha_turno'])) ?>` | Instrucción de ejecución en el contexto del script: `<?= date('d/m/Y', strtotime($t['fecha_turno'])) ?>`. |
| `458` | `                        <div style="font-size:.72rem; color:#9ca3af;">` | Contenedor visual estructurado con Bootstrap/CSS: `<div style="font-size:.72rem; color:#9ca3af;">`. |
| `459` | `                            <?= $diasES[(int)(new DateTime($t['fecha_turno'...` | Instrucción de ejecución en el contexto del script: `<?= $diasES[(int)(new DateTime($t['fecha_turno']))->format('w')] ?>`. |
| `460` | `                        </div>` | Cierre de contenedor visual `<div>`. |
| `461` | `                    </td>` | Celda de tabla con contenido de datos o encabezado de columna: `</td>`. |
| `462` | `                    <td><?= htmlspecialchars($t['nombre_modulo']) ?></td>` | Celda de tabla con contenido de datos o encabezado de columna: `<td><?= htmlspecialchars($t['nombre_modulo']) ?></td>`. |
| `463` | `                    <td style="color:#6b7280;">` | Celda de tabla con contenido de datos o encabezado de columna: `<td style="color:#6b7280;">`. |
| `464` | `                        <?= $t['nombre_grupo'] ? htmlspecialchars($t['nombr...` | Instrucción de ejecución en el contexto del script: `<?= $t['nombre_grupo'] ? htmlspecialchars($t['nombre_grupo']) : '—' ?>`. |
| `465` | `                    </td>` | Celda de tabla con contenido de datos o encabezado de columna: `</td>`. |
| `466` | `                    <td>` | Celda de tabla con contenido de datos o encabezado de columna: `<td>`. |
| `467` | `                        <span style="background:<?= $b['bg'] ?>; color:<?= ...` | Instrucción de ejecución en el contexto del script: `<span style="background:<?= $b['bg'] ?>; color:<?= $b['color'] ?>;`. |
| `468` | `                                     border-radius:20px; padding:.2rem .7rem;` | Instrucción de ejecución en el contexto del script: `border-radius:20px; padding:.2rem .7rem;`. |
| `469` | `                                     font-size:.75rem; font-weight:600;">` | Instrucción de ejecución en el contexto del script: `font-size:.75rem; font-weight:600;">`. |
| `470` | `                            <?= htmlspecialchars($t['estado']) ?>` | Instrucción de ejecución en el contexto del script: `<?= htmlspecialchars($t['estado']) ?>`. |
| `471` | `                        </span>` | Instrucción de ejecución en el contexto del script: `</span>`. |
| `472` | `                    </td>` | Celda de tabla con contenido de datos o encabezado de columna: `</td>`. |
| `473` | `                    <td class="text-center">` | Celda de tabla con contenido de datos o encabezado de columna: `<td class="text-center">`. |
| `474` | `                        <?php if ((int)$t['tiene_evidencia'] > 0): ?>` | Instrucción de ejecución en el contexto del script: `<?php if ((int)$t['tiene_evidencia'] > 0): ?>`. |
| `475` | `                            <span style="color:#16a34a; font-weight:700; fo...` | Instrucción de ejecución en el contexto del script: `<span style="color:#16a34a; font-weight:700; font-size:1.1rem;">✓</span>`. |
| `476` | `                        <?php else: ?>` | Instrucción de ejecución en el contexto del script: `<?php else: ?>`. |
| `477` | `                            <span style="color:#d1d5db;">—</span>` | Instrucción de ejecución en el contexto del script: `<span style="color:#d1d5db;">—</span>`. |
| `478` | `                        <?php endif; ?>` | Instrucción de ejecución en el contexto del script: `<?php endif; ?>`. |
| `479` | `                    </td>` | Celda de tabla con contenido de datos o encabezado de columna: `</td>`. |
| `480` | `                </tr>` | Fila contenedora de datos dentro de la tabla. |
| `481` | `                <?php endforeach; ?>` | Instrucción de ejecución en el contexto del script: `<?php endforeach; ?>`. |
| `482` | `                </tbody>` | Instrucción de ejecución en el contexto del script: `</tbody>`. |
| `483` | `            </table>` | Tabla de datos para despliegue estructurado de información: `</table>`. |
| `484` | `        </div>` | Cierre de contenedor visual `<div>`. |
| `485` | `    </div>` | Cierre de contenedor visual `<div>`. |
| `486` | `    <?php endif; ?>` | Instrucción de ejecución en el contexto del script: `<?php endif; ?>`. |
| `487` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `488` | `</div><!-- /ev-page -->` | Cierre de contenedor visual `<div>`. |
| `489` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `490` | `<?php if ($alert): ?>` | Instrucción de ejecución en el contexto del script: `<?php if ($alert): ?>`. |
| `491` | `<script>` | Bloque o etiqueta de vinculación para scripts JavaScript del lado del cliente. |
| `492` | `document.addEventListener('DOMContentLoaded', function () {` | Declaración de método o función con su firma y parámetros: `document.addEventListener('DOMContentLoaded', function () {`. |
| `493` | `    Swal.fire({` | Instrucción de ejecución en el contexto del script: `Swal.fire({`. |
| `494` | `        icon:  '<?= addslashes($alert['icon']) ?>',` | Instrucción de ejecución en el contexto del script: `icon:  '<?= addslashes($alert['icon']) ?>',`. |
| `495` | `        title: '<?= addslashes($alert['title']) ?>',` | Instrucción de ejecución en el contexto del script: `title: '<?= addslashes($alert['title']) ?>',`. |
| `496` | `        text:  '<?= addslashes($alert['text']) ?>',` | Instrucción de ejecución en el contexto del script: `text:  '<?= addslashes($alert['text']) ?>',`. |
| `497` | `        confirmButtonColor: '#4f46e5'` | Instrucción de ejecución en el contexto del script: `confirmButtonColor: '#4f46e5'`. |
| `498` | `    });` | Instrucción de ejecución en el contexto del script: `});`. |
| `499` | `});` | Instrucción de ejecución en el contexto del script: `});`. |
| `500` | `</script>` | Bloque o etiqueta de vinculación para scripts JavaScript del lado del cliente. |
| `501` | `<?php endif; ?>` | Instrucción de ejecución en el contexto del script: `<?php endif; ?>`. |
| `502` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `503` | `<script>` | Bloque o etiqueta de vinculación para scripts JavaScript del lado del cliente. |
| `504` | `function previsualizarFoto(input) {` | Declaración de método o función con su firma y parámetros: `function previsualizarFoto(input) {`. |
| `505` | `    const content = document.getElementById('dropContent');` | Instrucción de ejecución en el contexto del script: `const content = document.getElementById('dropContent');`. |
| `506` | `    const img     = document.getElementById('previewImg');` | Instrucción de ejecución en el contexto del script: `const img     = document.getElementById('previewImg');`. |
| `507` | `    const zone    = document.getElementById('dropZone');` | Instrucción de ejecución en el contexto del script: `const zone    = document.getElementById('dropZone');`. |
| `508` | `    if (input.files && input.files[0]) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (input.files && input.files[0]) {`. |
| `509` | `        const reader = new FileReader();` | Instrucción de ejecución en el contexto del script: `const reader = new FileReader();`. |
| `510` | `        reader.onload = e => {` | Instrucción de ejecución en el contexto del script: `reader.onload = e => {`. |
| `511` | `            img.src = e.target.result;` | Instrucción de ejecución en el contexto del script: `img.src = e.target.result;`. |
| `512` | `            img.classList.remove('d-none');` | Instrucción de ejecución en el contexto del script: `img.classList.remove('d-none');`. |
| `513` | `            content.classList.add('d-none');` | Instrucción de ejecución en el contexto del script: `content.classList.add('d-none');`. |
| `514` | `            zone.style.borderColor = '#4f46e5';` | Instrucción de ejecución en el contexto del script: `zone.style.borderColor = '#4f46e5';`. |
| `515` | `            zone.style.background  = '#f0f4ff';` | Instrucción de ejecución en el contexto del script: `zone.style.background  = '#f0f4ff';`. |
| `516` | `        };` | Instrucción de ejecución en el contexto del script: `};`. |
| `517` | `        reader.readAsDataURL(input.files[0]);` | Instrucción de ejecución en el contexto del script: `reader.readAsDataURL(input.files[0]);`. |
| `518` | `    }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `519` | `}` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `520` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `521` | `function handleDrop(e) {` | Declaración de método o función con su firma y parámetros: `function handleDrop(e) {`. |
| `522` | `    e.preventDefault();` | Instrucción de ejecución en el contexto del script: `e.preventDefault();`. |
| `523` | `    const zone = document.getElementById('dropZone');` | Instrucción de ejecución en el contexto del script: `const zone = document.getElementById('dropZone');`. |
| `524` | `    zone.classList.remove('drag-over');` | Instrucción de ejecución en el contexto del script: `zone.classList.remove('drag-over');`. |
| `525` | `    const files = e.dataTransfer.files;` | Instrucción de ejecución en el contexto del script: `const files = e.dataTransfer.files;`. |
| `526` | `    if (files.length) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (files.length) {`. |
| `527` | `        const input = document.getElementById('inputFoto');` | Instrucción de ejecución en el contexto del script: `const input = document.getElementById('inputFoto');`. |
| `528` | `        try {` | Inicia bloque de captura de excepciones `try` para ejecución segura de operaciones críticas. |
| `529` | `            const dt = new DataTransfer();` | Instrucción de ejecución en el contexto del script: `const dt = new DataTransfer();`. |
| `530` | `            dt.items.add(files[0]);` | Instrucción de ejecución en el contexto del script: `dt.items.add(files[0]);`. |
| `531` | `            input.files = dt.files;` | Instrucción de ejecución en el contexto del script: `input.files = dt.files;`. |
| `532` | `        } catch(err) { /* fallback silencioso */ }` | Instrucción de ejecución en el contexto del script: `} catch(err) { /* fallback silencioso */ }`. |
| `533` | `        previsualizarFoto(input);` | Instrucción de ejecución en el contexto del script: `previsualizarFoto(input);`. |
| `534` | `    }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `535` | `}` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `536` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `537` | `function toggleFoto2() {` | Declaración de método o función con su firma y parámetros: `function toggleFoto2() {`. |
| `538` | `    const s = document.getElementById('foto2Section');` | Instrucción de ejecución en el contexto del script: `const s = document.getElementById('foto2Section');`. |
| `539` | `    s.style.display = s.style.display === 'none' ? 'block' : 'none';` | Instrucción de ejecución en el contexto del script: `s.style.display = s.style.display === 'none' ? 'block' : 'none';`. |
| `540` | `}` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `541` | `function previsualizarFoto2(input) {` | Declaración de método o función con su firma y parámetros: `function previsualizarFoto2(input) {`. |
| `542` | `    const c2 = document.getElementById('dropContent2');` | Instrucción de ejecución en el contexto del script: `const c2 = document.getElementById('dropContent2');`. |
| `543` | `    const i2 = document.getElementById('previewImg2');` | Instrucción de ejecución en el contexto del script: `const i2 = document.getElementById('previewImg2');`. |
| `544` | `    if (input.files && input.files[0]) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (input.files && input.files[0]) {`. |
| `545` | `        const r = new FileReader();` | Instrucción de ejecución en el contexto del script: `const r = new FileReader();`. |
| `546` | `        r.onload = e => { i2.src = e.target.result; i2.classList.remove('d-...` | Instrucción de ejecución en el contexto del script: `r.onload = e => { i2.src = e.target.result; i2.classList.remove('d-none'); c2.classList.add('d-none'); document.getElementById('dropZone2').style.borderColor='#39a900'; };`. |
| `547` | `        r.readAsDataURL(input.files[0]);` | Instrucción de ejecución en el contexto del script: `r.readAsDataURL(input.files[0]);`. |
| `548` | `    }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `549` | `}` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `550` | `function activarDrop2() { document.getElementById('dropZone2').style.border...` | Declaración de método o función con su firma y parámetros: `function activarDrop2() { document.getElementById('dropZone2').style.borderColor='#39a900'; }`. |
| `551` | `function desactivarDrop2() { document.getElementById('dropZone2').style.bor...` | Declaración de método o función con su firma y parámetros: `function desactivarDrop2() { document.getElementById('dropZone2').style.borderColor='#d1d5db'; }`. |
| `552` | `function handleDrop2(e) {` | Declaración de método o función con su firma y parámetros: `function handleDrop2(e) {`. |
| `553` | `    e.preventDefault(); desactivarDrop2();` | Instrucción de ejecución en el contexto del script: `e.preventDefault(); desactivarDrop2();`. |
| `554` | `    const files = e.dataTransfer.files;` | Instrucción de ejecución en el contexto del script: `const files = e.dataTransfer.files;`. |
| `555` | `    if (files.length) { try { const dt=new DataTransfer(); dt.items.add(fil...` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (files.length) { try { const dt=new DataTransfer(); dt.items.add(files[0]); document.getElementById('inputFoto2').files=dt.files; } catch(err){} previsualizarFoto2(document.getElementById('inputFoto2')); }`. |
| `556` | `}` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `557` | `</script>` | Bloque o etiqueta de vinculación para scripts JavaScript del lado del cliente. |
| `558` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `559` | `<?php require_once __DIR__ . '/../layouts/footer.php'; ?>` | Instrucción de ejecución en el contexto del script: `<?php require_once __DIR__ . '/../layouts/footer.php'; ?>`. |

---

## 3. Resumen y Flujo de Interacción

El archivo `vocero_subir_evidencia.php` cumple un rol indispensable en `views/dashboard/vocero_subir_evidencia.php`. 
Formulario con carga de archivos fotográficos y observaciones para registrar el cumplimiento de la limpieza. Garantiza la robustez, el orden y la estabilidad de la arquitectura del proyecto `systemLimpieza`.
