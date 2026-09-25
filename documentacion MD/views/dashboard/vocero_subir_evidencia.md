# Documentación Línea por Línea: `views/dashboard/vocero_subir_evidencia.php`

## 1. Ficha Técnica del Archivo

- **Archivo:** `vocero_subir_evidencia.php`
- **Ruta en el proyecto:** `views/dashboard/vocero_subir_evidencia.php`
- **Cantidad total de líneas:** `502`
- **Tipo de archivo:** `PHP`
- **Propósito general:** Formulario con carga de archivos fotográficos (antes y después) y observaciones para registrar el turno.

---

## 2. Explicación Detallada Línea por Línea

A continuación se presenta cada línea de código numerada de forma consecutiva, acompañada de su fragmento exacto y la explicación exhaustiva de su funcionamiento y responsabilidad en el sistema:

| Línea | Código Fuente | Explicación Detallada |
|---|---|---|
| `1` | ``<?php`` | Apertura obligatoria de la etiqueta PHP para ejecución del código del lado del servidor. |
| `2` | `$titulo = 'Subir Evidencia';` | Instrucción de ejecución en el contexto del script: `$titulo = 'Subir Evidencia';`. |
| `3` | `if (session_status() === PHP_SESSION_NONE) session_start();` | Inicia o reanuda la sesión PHP del usuario si no se encontraba activa previamente. |
| `4` | `if (!isset($_SESSION['usuario']) \|\| (int)$_SESSION['usuario']['rol'] !...` | Verifica autenticación y rol del usuario; redirige al login si no tiene permisos. |
| `5` | `header("Location: ../usuarios/login.php"); exit;` | Emite cabecera HTTP de redirección en el navegador y detiene la ejecución: `header("Location: ../usuarios/login.php"); exit;`. |
| `6` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `7` | `require_once __DIR__ . '/../../config/database.php';` | Importación e inclusión obligatoria del archivo de dependencia requerido: `require_once __DIR__ . '/../../config/database.php';`. |
| `8` | `require_once __DIR__ . '/../../models/Turno.php';` | Importación e inclusión obligatoria del archivo de dependencia requerido: `require_once __DIR__ . '/../../models/Turno.php';`. |
| `9` | `require_once __DIR__ . '/../../models/Evidencia.php';` | Importación e inclusión obligatoria del archivo de dependencia requerido: `require_once __DIR__ . '/../../models/Evidencia.php';`. |
| `10` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `11` | `$db    = (new Database())->conectar();` | Instrucción de ejecución en el contexto del script: `$db    = (new Database())->conectar();`. |
| `12` | `$alert = $_SESSION['alert'] ?? null;` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección. |
| `13` | `unset($_SESSION['alert']);` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección. |
| `14` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `15` | `$idUsuario = (int)$_SESSION['usuario']['id_usuario'];` | Instrucción de ejecución en el contexto del script: `$idUsuario = (int)$_SESSION['usuario']['id_usuario'];`. |
| `16` | `$stmtV = $db->prepare("SELECT * FROM voceros WHERE id_usuario = :id AND ...` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmtV = $db->prepare("SELECT * FROM voceros WHERE id_usuario = :id AND ...`. |
| `17` | `$stmtV->execute([':id' => $idUsuario]);` | Ejecuta la sentencia SQL preparada vinculando los parámetros correspondientes: `$stmtV->execute([':id' => $idUsuario]);`. |
| `18` | `$vocero   = $stmtV->fetch(PDO::FETCH_ASSOC);` | Recupera una única fila o registro resultante de la consulta. |
| `19` | `$idVocero = $vocero ? (int)$vocero['id_vocero'] : 0;` | Instrucción de ejecución en el contexto del script: `$idVocero = $vocero ? (int)$vocero['id_vocero'] : 0;`. |
| `20` | `$idFicha  = $vocero ? (int)$vocero['id_ficha']  : 0;` | Instrucción de ejecución en el contexto del script: `$idFicha  = $vocero ? (int)$vocero['id_ficha']  : 0;`. |
| `21` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `22` | `$fichaInfo = null;` | Instrucción de ejecución en el contexto del script: `$fichaInfo = null;`. |
| `23` | `if ($idFicha) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if ($idFicha) {`. |
| `24` | `$stmtF = $db->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmtF = $db->prepare(`. |
| `25` | `"SELECT f.numero_ficha, p.nombre AS nombre_programa` | Instrucción de ejecución en el contexto del script: `"SELECT f.numero_ficha, p.nombre AS nombre_programa`. |
| `26` | `FROM fichas f JOIN programas p ON p.id_programa = f.id_programa` | Instrucción de ejecución en el contexto del script: `FROM fichas f JOIN programas p ON p.id_programa = f.id_programa`. |
| `27` | `WHERE f.id_ficha = :id LIMIT 1"` | Instrucción de ejecución en el contexto del script: `WHERE f.id_ficha = :id LIMIT 1"`. |
| `28` | ``);`` | Cierre de estructura de arreglo o invocación de función. |
| `29` | `$stmtF->execute([':id' => $idFicha]);` | Ejecuta la sentencia SQL preparada vinculando los parámetros correspondientes: `$stmtF->execute([':id' => $idFicha]);`. |
| `30` | `$fichaInfo = $stmtF->fetch(PDO::FETCH_ASSOC);` | Recupera una única fila o registro resultante de la consulta. |
| `31` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `32` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `33` | `$modelTurno = new Turno($db);` | Instrucción de ejecución en el contexto del script: `$modelTurno = new Turno($db);`. |
| `34` | `if ($idFicha) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if ($idFicha) {`. |
| `35` | `$modelTurno->abrirTurnosHoy();` | Instrucción de ejecución en el contexto del script: `$modelTurno->abrirTurnosHoy();`. |
| `36` | `$modelTurno->cerrarTurnosVencidos();` | Instrucción de ejecución en el contexto del script: `$modelTurno->cerrarTurnosVencidos();`. |
| `37` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `38` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `39` | `$turnoHoy  = $idFicha ? $modelTurno->turnoActivoHoy($idFicha)    : false;` | Instrucción de ejecución en el contexto del script: `$turnoHoy  = $idFicha ? $modelTurno->turnoActivoHoy($idFicha)    : false;`. |
| `40` | `$historial = $idFicha ? $modelTurno->historialFicha($idFicha, 10) : [];` | Instrucción de ejecución en el contexto del script: `$historial = $idFicha ? $modelTurno->historialFicha($idFicha, 10) : [];`. |
| `41` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `42` | `// ¿El turno ya tiene el par completo antes+después?` | Comentario explicativo en el código: `¿El turno ya tiene el par completo antes+después?`. |
| `43` | `$modelEv      = new Evidencia($db);` | Instrucción de ejecución en el contexto del script: `$modelEv      = new Evidencia($db);`. |
| `44` | `$turnoCompleto = $turnoHoy && $modelEv->turnoCompleto((int)$turnoHoy['id...` | Instrucción de ejecución en el contexto del script: `$turnoCompleto = $turnoHoy && $modelEv->turnoCompleto((int)$turnoHoy['id...`. |
| `45` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `46` | `$diasES = ['Domingo','Lunes','Martes','Miércoles','Jueves','Viernes','Sá...` | Instrucción de ejecución en el contexto del script: `$diasES = ['Domingo','Lunes','Martes','Miércoles','Jueves','Viernes','Sá...`. |
| `47` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `48` | `require_once __DIR__ . '/../layouts/header.php';` | Importación e inclusión obligatoria del archivo de dependencia requerido: `require_once __DIR__ . '/../layouts/header.php';`. |
| `49` | ``?>`` | Cierre de la etiqueta PHP para alternar a salida HTML o fin del archivo. |
| `50` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `51` | ``<style>`` | Bloque de estilos CSS personalizados para la interfaz. |
| `52` | `.ev-page { max-width: 720px; margin: 0 auto; }` | Instrucción de ejecución en el contexto del script: `.ev-page { max-width: 720px; margin: 0 auto; }`. |
| `53` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `54` | `.ev-card {` | Instrucción de ejecución en el contexto del script: `.ev-card {`. |
| `55` | `background: #fff;` | Instrucción de ejecución en el contexto del script: `background: #fff;`. |
| `56` | `border: 1px solid #e5e7eb;` | Instrucción de ejecución en el contexto del script: `border: 1px solid #e5e7eb;`. |
| `57` | `border-radius: 12px;` | Instrucción de ejecución en el contexto del script: `border-radius: 12px;`. |
| `58` | `padding: 1.5rem 1.75rem;` | Instrucción de ejecución en el contexto del script: `padding: 1.5rem 1.75rem;`. |
| `59` | `margin-bottom: 1.25rem;` | Instrucción de ejecución en el contexto del script: `margin-bottom: 1.25rem;`. |
| `60` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `61` | `.ev-card-title { font-size: .95rem; font-weight: 700; color: #111827; ma...` | Instrucción de ejecución en el contexto del script: `.ev-card-title { font-size: .95rem; font-weight: 700; color: #111827; ma...`. |
| `62` | `.ev-card-sub   { font-size: .8rem; color: #6b7280; margin-bottom: 1.1rem; }` | Instrucción de ejecución en el contexto del script: `.ev-card-sub   { font-size: .8rem; color: #6b7280; margin-bottom: 1.1rem; }`. |
| `63` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `64` | `.ev-info-banner {` | Instrucción de ejecución en el contexto del script: `.ev-info-banner {`. |
| `65` | `background: #f0f4ff; border: 1px solid #dbe4ff;` | Instrucción de ejecución en el contexto del script: `background: #f0f4ff; border: 1px solid #dbe4ff;`. |
| `66` | `border-radius: 10px; padding: 1rem 1.25rem; margin-bottom: 1.25rem;` | Instrucción de ejecución en el contexto del script: `border-radius: 10px; padding: 1rem 1.25rem; margin-bottom: 1.25rem;`. |
| `67` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `68` | `.ev-info-banner .banner-title { font-size: .88rem; font-weight: 700; col...` | Instrucción de ejecución en el contexto del script: `.ev-info-banner .banner-title { font-size: .88rem; font-weight: 700; col...`. |
| `69` | `.ev-info-banner .banner-sub   { font-size: .78rem; color: #4f46e5; }` | Instrucción de ejecución en el contexto del script: `.ev-info-banner .banner-sub   { font-size: .78rem; color: #4f46e5; }`. |
| `70` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `71` | `.ev-chip {` | Instrucción de ejecución en el contexto del script: `.ev-chip {`. |
| `72` | `background: #fff; border: 1px solid #e5e7eb; border-radius: 10px;` | Instrucción de ejecución en el contexto del script: `background: #fff; border: 1px solid #e5e7eb; border-radius: 10px;`. |
| `73` | `padding: .75rem 1rem; display: flex; align-items: center; gap: .85rem; f...` | Instrucción de ejecución en el contexto del script: `padding: .75rem 1rem; display: flex; align-items: center; gap: .85rem; f...`. |
| `74` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `75` | `.ev-chip-icon  { width:42px;height:42px;border-radius:10px;display:flex;...` | Instrucción de ejecución en el contexto del script: `.ev-chip-icon  { width:42px;height:42px;border-radius:10px;display:flex;...`. |
| `76` | `.ev-chip-label { font-size:.72rem;color:#6b7280;margin-bottom:.1rem; }` | Instrucción de ejecución en el contexto del script: `.ev-chip-label { font-size:.72rem;color:#6b7280;margin-bottom:.1rem; }`. |
| `77` | `.ev-chip-value { font-size:.95rem;font-weight:700;color:#111827; }` | Instrucción de ejecución en el contexto del script: `.ev-chip-value { font-size:.95rem;font-weight:700;color:#111827; }`. |
| `78` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `79` | `.ev-field label { font-size:.875rem;font-weight:600;color:#374151;displa...` | Instrucción de ejecución en el contexto del script: `.ev-field label { font-size:.875rem;font-weight:600;color:#374151;displa...`. |
| `80` | `.ev-field .form-control,` | Instrucción de ejecución en el contexto del script: `.ev-field .form-control,`. |
| `81` | `.ev-field .form-control:disabled,` | Instrucción de ejecución en el contexto del script: `.ev-field .form-control:disabled,`. |
| `82` | `.ev-field .form-control[readonly] {` | Instrucción de ejecución en el contexto del script: `.ev-field .form-control[readonly] {`. |
| `83` | `font-size:.875rem;border:1px solid #e5e7eb;border-radius:8px;` | Instrucción de ejecución en el contexto del script: `font-size:.875rem;border:1px solid #e5e7eb;border-radius:8px;`. |
| `84` | `padding:.6rem .85rem;color:#374151;background:#f9fafb;` | Instrucción de ejecución en el contexto del script: `padding:.6rem .85rem;color:#374151;background:#f9fafb;`. |
| `85` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `86` | `.ev-field .form-control:not(:disabled):not([readonly]) { background:#fff; }` | Instrucción de ejecución en el contexto del script: `.ev-field .form-control:not(:disabled):not([readonly]) { background:#fff; }`. |
| `87` | `.ev-field .field-hint { font-size:.75rem;color:#9ca3af;margin-top:.25rem; }` | Instrucción de ejecución en el contexto del script: `.ev-field .field-hint { font-size:.75rem;color:#9ca3af;margin-top:.25rem; }`. |
| `88` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `89` | `/* ── Zonas de foto ── */` | Comentario multilínea de documentación o aclaración técnica. |
| `90` | `.foto-par {` | Instrucción de ejecución en el contexto del script: `.foto-par {`. |
| `91` | `display: grid;` | Instrucción de ejecución en el contexto del script: `display: grid;`. |
| `92` | `grid-template-columns: 1fr 1fr;` | Instrucción de ejecución en el contexto del script: `grid-template-columns: 1fr 1fr;`. |
| `93` | `gap: 1rem;` | Instrucción de ejecución en el contexto del script: `gap: 1rem;`. |
| `94` | `margin-bottom: 1.25rem;` | Instrucción de ejecución en el contexto del script: `margin-bottom: 1.25rem;`. |
| `95` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `96` | `@media (max-width: 560px) { .foto-par { grid-template-columns: 1fr; } }` | Instrucción de ejecución en el contexto del script: `@media (max-width: 560px) { .foto-par { grid-template-columns: 1fr; } }`. |
| `97` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `98` | `.foto-slot { display: flex; flex-direction: column; }` | Instrucción de ejecución en el contexto del script: `.foto-slot { display: flex; flex-direction: column; }`. |
| `99` | `.foto-slot-label {` | Instrucción de ejecución en el contexto del script: `.foto-slot-label {`. |
| `100` | `font-size: .82rem; font-weight: 700;` | Instrucción de ejecución en el contexto del script: `font-size: .82rem; font-weight: 700;`. |
| `101` | `margin-bottom: .5rem;` | Instrucción de ejecución en el contexto del script: `margin-bottom: .5rem;`. |
| `102` | `display: flex; align-items: center; gap: .4rem;` | Instrucción de ejecución en el contexto del script: `display: flex; align-items: center; gap: .4rem;`. |
| `103` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `104` | `.foto-slot-label .badge-tipo {` | Instrucción de ejecución en el contexto del script: `.foto-slot-label .badge-tipo {`. |
| `105` | `display: inline-flex; align-items: center; gap: .3rem;` | Instrucción de ejecución en el contexto del script: `display: inline-flex; align-items: center; gap: .3rem;`. |
| `106` | `padding: .25rem .65rem; border-radius: 20px;` | Instrucción de ejecución en el contexto del script: `padding: .25rem .65rem; border-radius: 20px;`. |
| `107` | `font-size: .75rem; font-weight: 700;` | Instrucción de ejecución en el contexto del script: `font-size: .75rem; font-weight: 700;`. |
| `108` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `109` | `.badge-antes   { background: #fef3c7; color: #92400e; }` | Instrucción de ejecución en el contexto del script: `.badge-antes   { background: #fef3c7; color: #92400e; }`. |
| `110` | `.badge-despues { background: #dcfce7; color: #14532d; }` | Instrucción de ejecución en el contexto del script: `.badge-despues { background: #dcfce7; color: #14532d; }`. |
| `111` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `112` | `.drop-zone {` | Instrucción de ejecución en el contexto del script: `.drop-zone {`. |
| `113` | `border: 2px dashed #d1d5db;` | Instrucción de ejecución en el contexto del script: `border: 2px dashed #d1d5db;`. |
| `114` | `border-radius: 10px;` | Instrucción de ejecución en el contexto del script: `border-radius: 10px;`. |
| `115` | `background: #f9fafb;` | Instrucción de ejecución en el contexto del script: `background: #f9fafb;`. |
| `116` | `min-height: 170px;` | Instrucción de ejecución en el contexto del script: `min-height: 170px;`. |
| `117` | `display: flex; flex-direction: column;` | Instrucción de ejecución en el contexto del script: `display: flex; flex-direction: column;`. |
| `118` | `align-items: center; justify-content: center;` | Instrucción de ejecución en el contexto del script: `align-items: center; justify-content: center;`. |
| `119` | `cursor: pointer;` | Instrucción de ejecución en el contexto del script: `cursor: pointer;`. |
| `120` | `transition: border-color .2s, background .2s;` | Instrucción de ejecución en el contexto del script: `transition: border-color .2s, background .2s;`. |
| `121` | `overflow: hidden; padding: 1.25rem;` | Instrucción de ejecución en el contexto del script: `overflow: hidden; padding: 1.25rem;`. |
| `122` | `text-align: center; position: relative;` | Instrucción de ejecución en el contexto del script: `text-align: center; position: relative;`. |
| `123` | `flex: 1;` | Instrucción de ejecución en el contexto del script: `flex: 1;`. |
| `124` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `125` | `.drop-zone:hover, .drop-zone.drag-over { border-color: #4f46e5; backgrou...` | Instrucción de ejecución en el contexto del script: `.drop-zone:hover, .drop-zone.drag-over { border-color: #4f46e5; backgrou...`. |
| `126` | `.drop-zone.has-file-antes             { border-color: #d97706; backgroun...` | Instrucción de ejecución en el contexto del script: `.drop-zone.has-file-antes             { border-color: #d97706; backgroun...`. |
| `127` | `.drop-zone.has-file-despues           { border-color: #16a34a; backgroun...` | Instrucción de ejecución en el contexto del script: `.drop-zone.has-file-despues           { border-color: #16a34a; backgroun...`. |
| `128` | `.drop-zone .drop-icon   { font-size: 1.8rem; color: #9ca3af; margin-bott...` | Instrucción de ejecución en el contexto del script: `.drop-zone .drop-icon   { font-size: 1.8rem; color: #9ca3af; margin-bott...`. |
| `129` | `.drop-zone .drop-text   { font-size: .8rem; color: #6b7280; margin-botto...` | Instrucción de ejecución en el contexto del script: `.drop-zone .drop-text   { font-size: .8rem; color: #6b7280; margin-botto...`. |
| `130` | `.drop-zone .drop-hint   { font-size: .72rem; color: #9ca3af; }` | Instrucción de ejecución en el contexto del script: `.drop-zone .drop-hint   { font-size: .72rem; color: #9ca3af; }`. |
| `131` | `.drop-zone .required-dot {` | Instrucción de ejecución en el contexto del script: `.drop-zone .required-dot {`. |
| `132` | `position:absolute; top:.5rem; right:.6rem;` | Instrucción de ejecución en el contexto del script: `position:absolute; top:.5rem; right:.6rem;`. |
| `133` | `color:#ef4444; font-size:.9rem; font-weight:700;` | Instrucción de ejecución en el contexto del script: `color:#ef4444; font-size:.9rem; font-weight:700;`. |
| `134` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `135` | `.drop-zone img {` | Instrucción de ejecución en el contexto del script: `.drop-zone img {`. |
| `136` | `width:100%; height:160px; object-fit:cover; border-radius:8px;` | Instrucción de ejecución en el contexto del script: `width:100%; height:160px; object-fit:cover; border-radius:8px;`. |
| `137` | `display: none;` | Instrucción de ejecución en el contexto del script: `display: none;`. |
| `138` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `139` | `.drop-zone.previewing img          { display: block; }` | Instrucción de ejecución en el contexto del script: `.drop-zone.previewing img          { display: block; }`. |
| `140` | `.drop-zone.previewing .drop-inner  { display: none; }` | Instrucción de ejecución en el contexto del script: `.drop-zone.previewing .drop-inner  { display: none; }`. |
| `141` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `142` | `/* ── Botón enviar ── */` | Comentario multilínea de documentación o aclaración técnica. |
| `143` | `.btn-enviar {` | Instrucción de ejecución en el contexto del script: `.btn-enviar {`. |
| `144` | `background: #39a900; color: #fff; border: none;` | Instrucción de ejecución en el contexto del script: `background: #39a900; color: #fff; border: none;`. |
| `145` | `border-radius: 10px; width: 100%; padding: .85rem;` | Instrucción de ejecución en el contexto del script: `border-radius: 10px; width: 100%; padding: .85rem;`. |
| `146` | `font-size: .95rem; font-weight: 600; cursor: pointer;` | Instrucción de ejecución en el contexto del script: `font-size: .95rem; font-weight: 600; cursor: pointer;`. |
| `147` | `display: flex; align-items: center; justify-content: center; gap: .5rem;` | Instrucción de ejecución en el contexto del script: `display: flex; align-items: center; justify-content: center; gap: .5rem;`. |
| `148` | `transition: background .2s, transform .15s;` | Instrucción de ejecución en el contexto del script: `transition: background .2s, transform .15s;`. |
| `149` | `box-shadow: 0 4px 14px rgba(57,169,0,.25);` | Instrucción de ejecución en el contexto del script: `box-shadow: 0 4px 14px rgba(57,169,0,.25);`. |
| `150` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `151` | `.btn-enviar:hover    { background: #2d8400; transform: translateY(-1px); }` | Instrucción de ejecución en el contexto del script: `.btn-enviar:hover    { background: #2d8400; transform: translateY(-1px); }`. |
| `152` | `.btn-enviar:disabled { background: #9ca3af; box-shadow: none; cursor: no...` | Instrucción de ejecución en el contexto del script: `.btn-enviar:disabled { background: #9ca3af; box-shadow: none; cursor: no...`. |
| `153` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `154` | `/* ── Banner éxito / sin turno ── */` | Comentario multilínea de documentación o aclaración técnica. |
| `155` | `.ev-success-banner {` | Instrucción de ejecución en el contexto del script: `.ev-success-banner {`. |
| `156` | `background: #f0fdf4; border: 1px solid #86efac; border-radius: 10px;` | Instrucción de ejecución en el contexto del script: `background: #f0fdf4; border: 1px solid #86efac; border-radius: 10px;`. |
| `157` | `padding: 1.25rem 1.5rem; display: flex; align-items: center; gap: 1rem; ...` | Instrucción de ejecución en el contexto del script: `padding: 1.25rem 1.5rem; display: flex; align-items: center; gap: 1rem; ...`. |
| `158` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `159` | `.ev-no-turno {` | Instrucción de ejecución en el contexto del script: `.ev-no-turno {`. |
| `160` | `background: #f9fafb; border: 1px dashed #d1d5db; border-radius: 12px;` | Instrucción de ejecución en el contexto del script: `background: #f9fafb; border: 1px dashed #d1d5db; border-radius: 12px;`. |
| `161` | `padding: 2.5rem 1.5rem; text-align: center; margin-bottom: 1.25rem;` | Instrucción de ejecución en el contexto del script: `padding: 2.5rem 1.5rem; text-align: center; margin-bottom: 1.25rem;`. |
| `162` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `163` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `164` | `/* ── Historial ── */` | Comentario multilínea de documentación o aclaración técnica. |
| `165` | `.hist-table th {` | Instrucción de ejecución en el contexto del script: `.hist-table th {`. |
| `166` | `font-size:.72rem;font-weight:700;text-transform:uppercase;letter-spacing...` | Instrucción de ejecución en el contexto del script: `font-size:.72rem;font-weight:700;text-transform:uppercase;letter-spacing...`. |
| `167` | `color:#6b7280;border-bottom:2px solid #e5e7eb;padding:.6rem .75rem;backg...` | Instrucción de ejecución en el contexto del script: `color:#6b7280;border-bottom:2px solid #e5e7eb;padding:.6rem .75rem;backg...`. |
| `168` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `169` | `.hist-table td {` | Instrucción de ejecución en el contexto del script: `.hist-table td {`. |
| `170` | `font-size:.82rem;padding:.65rem .75rem;` | Instrucción de ejecución en el contexto del script: `font-size:.82rem;padding:.65rem .75rem;`. |
| `171` | `border-bottom:1px solid #f3f4f6;color:#374151;vertical-align:middle;` | Instrucción de ejecución en el contexto del script: `border-bottom:1px solid #f3f4f6;color:#374151;vertical-align:middle;`. |
| `172` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `173` | ``</style>`` | Cierre de bloque de estilos CSS. |
| `174` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `175` | `<div class="ev-page">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="ev-page">`. |
| `176` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `177` | `<!-- ══ TÍTULO ═════════════════════════════════════════════════════════...` | Instrucción de ejecución en el contexto del script: `<!-- ══ TÍTULO ═════════════════════════════════════════════════════════...`. |
| `178` | `<div class="text-center mb-4">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="text-center mb-4">`. |
| `179` | `<h3 class="fw-bold mb-1" style="color:#111827;">Subir Evidencia de Limpi...` | Instrucción de ejecución en el contexto del script: `<h3 class="fw-bold mb-1" style="color:#111827;">Subir Evidencia de Limpi...`. |
| `180` | `<p class="text-muted small mb-0">` | Instrucción de ejecución en el contexto del script: `<p class="text-muted small mb-0">`. |
| `181` | `Sube las dos fotos obligatorias: <strong>antes</strong> y <strong>despué...` | Instrucción de ejecución en el contexto del script: `Sube las dos fotos obligatorias: <strong>antes</strong> y <strong>despué...`. |
| `182` | `</p>` | Instrucción de ejecución en el contexto del script: `</p>`. |
| `183` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `184` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `185` | `<!-- ══ BANNER INFO TURNO ══════════════════════════════════════════════...` | Instrucción de ejecución en el contexto del script: `<!-- ══ BANNER INFO TURNO ══════════════════════════════════════════════...`. |
| `186` | `<?php if ($turnoHoy): ?>` | Instrucción de ejecución en el contexto del script: `<?php if ($turnoHoy): ?>`. |
| `187` | `<div class="ev-info-banner">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="ev-info-banner">`. |
| `188` | `<div class="banner-title">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="banner-title">`. |
| `189` | `<i class="fas fa-circle-check me-1"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-circle-check me-1"></i>`. |
| `190` | `Limpieza del <?= $diasES[(int)(new DateTime($turnoHoy['fecha_turno']))->...` | Instrucción de ejecución en el contexto del script: `Limpieza del <?= $diasES[(int)(new DateTime($turnoHoy['fecha_turno']))->...`. |
| `191` | `<?= date('d/m/Y', strtotime($turnoHoy['fecha_turno'])) ?>` | Instrucción de ejecución en el contexto del script: `<?= date('d/m/Y', strtotime($turnoHoy['fecha_turno'])) ?>`. |
| `192` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `193` | `<div class="banner-sub mb-3">Datos asignados automáticamente según tu fi...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="banner-sub mb-3">Datos asignados automáticamente según tu fi...`. |
| `194` | `<div class="d-flex gap-3 flex-wrap">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="d-flex gap-3 flex-wrap">`. |
| `195` | `<div class="ev-chip">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="ev-chip">`. |
| `196` | `<div class="ev-chip-icon" style="background:#eef2ff;color:#4f46e5;">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="ev-chip-icon" style="background:#eef2ff;color:#4f46e5;">`. |
| `197` | `<i class="fas fa-building-columns"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-building-columns"></i>`. |
| `198` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `199` | `<div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div>`. |
| `200` | `<div class="ev-chip-label">Módulo Asignado</div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="ev-chip-label">Módulo Asignado</div>`. |
| `201` | `<div class="ev-chip-value"><?= htmlspecialchars($turnoHoy['nombre_modulo...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="ev-chip-value"><?= htmlspecialchars($turnoHoy['nombre_modulo...`. |
| `202` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `203` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `204` | `<div class="ev-chip">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="ev-chip">`. |
| `205` | `<div class="ev-chip-icon" style="background:#f5f3ff;color:#7c3aed;">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="ev-chip-icon" style="background:#f5f3ff;color:#7c3aed;">`. |
| `206` | `<i class="fas fa-people-group"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-people-group"></i>`. |
| `207` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `208` | `<div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div>`. |
| `209` | `<div class="ev-chip-label">Grupo Responsable</div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="ev-chip-label">Grupo Responsable</div>`. |
| `210` | `<div class="ev-chip-value">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="ev-chip-value">`. |
| `211` | `<?= $turnoHoy['nombre_grupo']` | Instrucción de ejecución en el contexto del script: `<?= $turnoHoy['nombre_grupo']`. |
| `212` | `? htmlspecialchars($turnoHoy['nombre_grupo'])` | Instrucción de ejecución en el contexto del script: `? htmlspecialchars($turnoHoy['nombre_grupo'])`. |
| `213` | `: '<span style="color:#f59e0b;font-size:.85rem;">Sin grupo</span>' ?>` | Instrucción de ejecución en el contexto del script: `: '<span style="color:#f59e0b;font-size:.85rem;">Sin grupo</span>' ?>`. |
| `214` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `215` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `216` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `217` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `218` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `219` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `220` | `<?php elseif ($idFicha): ?>` | Instrucción de ejecución en el contexto del script: `<?php elseif ($idFicha): ?>`. |
| `221` | `<div class="ev-no-turno">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="ev-no-turno">`. |
| `222` | `<i class="fas fa-calendar-xmark fa-2x text-muted opacity-40 d-block mb-3...` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-calendar-xmark fa-2x text-muted opacity-40 d-block mb-3...`. |
| `223` | `<div class="fw-semibold text-muted mb-1">No hay turno de limpieza progra...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="fw-semibold text-muted mb-1">No hay turno de limpieza progra...`. |
| `224` | `<div class="text-muted small">Revisa el historial para ver tu próxima fe...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="text-muted small">Revisa el historial para ver tu próxima fe...`. |
| `225` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `226` | `<?php endif; ?>` | Cierre de estructura condicional embebida en la plantilla HTML. |
| `227` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `228` | `<!-- ══ PAR YA ENTREGADO ═══════════════════════════════════════════════...` | Instrucción de ejecución en el contexto del script: `<!-- ══ PAR YA ENTREGADO ═══════════════════════════════════════════════...`. |
| `229` | `<?php if ($turnoHoy && $turnoCompleto): ?>` | Instrucción de ejecución en el contexto del script: `<?php if ($turnoHoy && $turnoCompleto): ?>`. |
| `230` | `<div class="ev-success-banner">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="ev-success-banner">`. |
| `231` | `<i class="fas fa-circle-check text-success fa-2x flex-shrink-0"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-circle-check text-success fa-2x flex-shrink-0"></i>`. |
| `232` | `<div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div>`. |
| `233` | `<div class="fw-bold text-success mb-1">¡Evidencias del día entregadas!</...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="fw-bold text-success mb-1">¡Evidencias del día entregadas!</...`. |
| `234` | `<div class="text-muted small">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="text-muted small">`. |
| `235` | `Ya registraste las fotos <strong>antes</strong> y <strong>después</stron...` | Instrucción de ejecución en el contexto del script: `Ya registraste las fotos <strong>antes</strong> y <strong>después</stron...`. |
| `236` | `Puedes revisar el historial más abajo.` | Instrucción de ejecución en el contexto del script: `Puedes revisar el historial más abajo.`. |
| `237` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `238` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `239` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `240` | `<?php endif; ?>` | Cierre de estructura condicional embebida en la plantilla HTML. |
| `241` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `242` | `<!-- ══ FORMULARIO ═════════════════════════════════════════════════════...` | Instrucción de ejecución en el contexto del script: `<!-- ══ FORMULARIO ═════════════════════════════════════════════════════...`. |
| `243` | `<?php if ($turnoHoy && !$turnoCompleto): ?>` | Instrucción de ejecución en el contexto del script: `<?php if ($turnoHoy && !$turnoCompleto): ?>`. |
| `244` | `<div class="ev-card">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="ev-card">`. |
| `245` | `<div class="ev-card-title">Nueva Evidencia</div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="ev-card-title">Nueva Evidencia</div>`. |
| `246` | `<div class="ev-card-sub">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="ev-card-sub">`. |
| `247` | `Ambas fotos son <strong>obligatorias</strong> — sube la del estado del m...` | Instrucción de ejecución en el contexto del script: `Ambas fotos son <strong>obligatorias</strong> — sube la del estado del m...`. |
| `248` | `antes de limpiar y la del resultado final.` | Instrucción de ejecución en el contexto del script: `antes de limpiar y la del resultado final.`. |
| `249` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `250` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `251` | `<form action="../../controllers/VoceroController.php"` | Formulario interactivo para captura y envío de datos: `<form action="../../controllers/VoceroController.php"`. |
| `252` | `method="POST" enctype="multipart/form-data" id="formEvidencia">` | Instrucción de ejecución en el contexto del script: `method="POST" enctype="multipart/form-data" id="formEvidencia">`. |
| `253` | `<input type="hidden" name="accion"   value="subir_evidencia_turno">` | Campo de entrada interactivo para datos del usuario: `<input type="hidden" name="accion"   value="subir_evidencia_turno">`. |
| `254` | `<input type="hidden" name="id_turno" value="<?= (int)$turnoHoy['id_turno...` | Campo de entrada interactivo para datos del usuario: `<input type="hidden" name="id_turno" value="<?= (int)$turnoHoy['id_turno...`. |
| `255` | `<input type="hidden" name="id_grupo" value="<?= (int)($turnoHoy['id_grup...` | Campo de entrada interactivo para datos del usuario: `<input type="hidden" name="id_grupo" value="<?= (int)($turnoHoy['id_grup...`. |
| `256` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `257` | `<!-- Info readonly -->` | Instrucción de ejecución en el contexto del script: `<!-- Info readonly -->`. |
| `258` | `<div class="row g-3 mb-4">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="row g-3 mb-4">`. |
| `259` | `<div class="col-sm-6 ev-field">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="col-sm-6 ev-field">`. |
| `260` | `<label>Módulo</label>` | Instrucción de ejecución en el contexto del script: `<label>Módulo</label>`. |
| `261` | `<input type="text" class="form-control"` | Campo de entrada interactivo para datos del usuario: `<input type="text" class="form-control"`. |
| `262` | `value="<?= htmlspecialchars($turnoHoy['nombre_modulo']) ?>" disabled>` | Instrucción de ejecución en el contexto del script: `value="<?= htmlspecialchars($turnoHoy['nombre_modulo']) ?>" disabled>`. |
| `263` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `264` | `<div class="col-sm-6 ev-field">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="col-sm-6 ev-field">`. |
| `265` | `<label>Grupo</label>` | Instrucción de ejecución en el contexto del script: `<label>Grupo</label>`. |
| `266` | `<input type="text" class="form-control"` | Campo de entrada interactivo para datos del usuario: `<input type="text" class="form-control"`. |
| `267` | `value="<?= $turnoHoy['nombre_grupo']` | Instrucción de ejecución en el contexto del script: `value="<?= $turnoHoy['nombre_grupo']`. |
| `268` | `? htmlspecialchars($turnoHoy['nombre_grupo'])` | Instrucción de ejecución en el contexto del script: `? htmlspecialchars($turnoHoy['nombre_grupo'])`. |
| `269` | `: 'Sin grupo asignado' ?>" disabled>` | Instrucción de ejecución en el contexto del script: `: 'Sin grupo asignado' ?>" disabled>`. |
| `270` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `271` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `272` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `273` | `<!-- ── Par de fotos ─────────────────────────────────────────── -->` | Instrucción de ejecución en el contexto del script: `<!-- ── Par de fotos ─────────────────────────────────────────── -->`. |
| `274` | `<div class="foto-par">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="foto-par">`. |
| `275` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `276` | `<!-- ANTES -->` | Instrucción de ejecución en el contexto del script: `<!-- ANTES -->`. |
| `277` | `<div class="foto-slot">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="foto-slot">`. |
| `278` | `<div class="foto-slot-label">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="foto-slot-label">`. |
| `279` | `<span class="badge-tipo badge-antes">` | Instrucción de ejecución en el contexto del script: `<span class="badge-tipo badge-antes">`. |
| `280` | `<i class="fas fa-clock"></i> Antes` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-clock"></i> Antes`. |
| `281` | `</span>` | Instrucción de ejecución en el contexto del script: `</span>`. |
| `282` | `<span style="color:#ef4444; font-size:.85rem;">*</span>` | Instrucción de ejecución en el contexto del script: `<span style="color:#ef4444; font-size:.85rem;">*</span>`. |
| `283` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `284` | `<div class="drop-zone" id="dz-antes"` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="drop-zone" id="dz-antes"`. |
| `285` | `onclick="document.getElementById('inp-antes').click()"` | Instrucción de ejecución en el contexto del script: `onclick="document.getElementById('inp-antes').click()"`. |
| `286` | `ondragover="event.preventDefault(); dzDragOver('dz-antes','antes')"` | Instrucción de ejecución en el contexto del script: `ondragover="event.preventDefault(); dzDragOver('dz-antes','antes')"`. |
| `287` | `ondragleave="dzDragLeave('dz-antes')"` | Instrucción de ejecución en el contexto del script: `ondragleave="dzDragLeave('dz-antes')"`. |
| `288` | `ondrop="dzDrop(event,'dz-antes','inp-antes','prev-antes','antes')">` | Instrucción de ejecución en el contexto del script: `ondrop="dzDrop(event,'dz-antes','inp-antes','prev-antes','antes')">`. |
| `289` | `<span class="required-dot" title="Obligatorio">●</span>` | Instrucción de ejecución en el contexto del script: `<span class="required-dot" title="Obligatorio">●</span>`. |
| `290` | `<div class="drop-inner">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="drop-inner">`. |
| `291` | `<div class="drop-icon"><i class="fas fa-camera"></i></div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="drop-icon"><i class="fas fa-camera"></i></div>`. |
| `292` | `<div class="drop-text">Estado antes de limpiar</div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="drop-text">Estado antes de limpiar</div>`. |
| `293` | `<div class="drop-hint">JPG / PNG · máx. 10 MB</div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="drop-hint">JPG / PNG · máx. 10 MB</div>`. |
| `294` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `295` | `<img id="prev-antes" src="#" alt="Vista previa antes">` | Instrucción de ejecución en el contexto del script: `<img id="prev-antes" src="#" alt="Vista previa antes">`. |
| `296` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `297` | `<input type="file" id="inp-antes" name="foto_antes"` | Campo de entrada interactivo para datos del usuario: `<input type="file" id="inp-antes" name="foto_antes"`. |
| `298` | `accept=".jpg,.jpeg,.png" required class="form-control form-control-sm mt-2"` | Instrucción de ejecución en el contexto del script: `accept=".jpg,.jpeg,.png" required class="form-control form-control-sm mt-2"`. |
| `299` | `onchange="dzPreview(this,'dz-antes','prev-antes','antes')">` | Instrucción de ejecución en el contexto del script: `onchange="dzPreview(this,'dz-antes','prev-antes','antes')">`. |
| `300` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `301` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `302` | `<!-- DESPUÉS -->` | Instrucción de ejecución en el contexto del script: `<!-- DESPUÉS -->`. |
| `303` | `<div class="foto-slot">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="foto-slot">`. |
| `304` | `<div class="foto-slot-label">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="foto-slot-label">`. |
| `305` | `<span class="badge-tipo badge-despues">` | Instrucción de ejecución en el contexto del script: `<span class="badge-tipo badge-despues">`. |
| `306` | `<i class="fas fa-circle-check"></i> Después` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-circle-check"></i> Después`. |
| `307` | `</span>` | Instrucción de ejecución en el contexto del script: `</span>`. |
| `308` | `<span style="color:#ef4444; font-size:.85rem;">*</span>` | Instrucción de ejecución en el contexto del script: `<span style="color:#ef4444; font-size:.85rem;">*</span>`. |
| `309` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `310` | `<div class="drop-zone" id="dz-despues"` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="drop-zone" id="dz-despues"`. |
| `311` | `onclick="document.getElementById('inp-despues').click()"` | Instrucción de ejecución en el contexto del script: `onclick="document.getElementById('inp-despues').click()"`. |
| `312` | `ondragover="event.preventDefault(); dzDragOver('dz-despues','despues')"` | Instrucción de ejecución en el contexto del script: `ondragover="event.preventDefault(); dzDragOver('dz-despues','despues')"`. |
| `313` | `ondragleave="dzDragLeave('dz-despues')"` | Instrucción de ejecución en el contexto del script: `ondragleave="dzDragLeave('dz-despues')"`. |
| `314` | `ondrop="dzDrop(event,'dz-despues','inp-despues','prev-despues','despues')">` | Instrucción de ejecución en el contexto del script: `ondrop="dzDrop(event,'dz-despues','inp-despues','prev-despues','despues')">`. |
| `315` | `<span class="required-dot" title="Obligatorio">●</span>` | Instrucción de ejecución en el contexto del script: `<span class="required-dot" title="Obligatorio">●</span>`. |
| `316` | `<div class="drop-inner">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="drop-inner">`. |
| `317` | `<div class="drop-icon"><i class="fas fa-circle-check"></i></div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="drop-icon"><i class="fas fa-circle-check"></i></div>`. |
| `318` | `<div class="drop-text">Resultado después de limpiar</div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="drop-text">Resultado después de limpiar</div>`. |
| `319` | `<div class="drop-hint">JPG / PNG · máx. 10 MB</div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="drop-hint">JPG / PNG · máx. 10 MB</div>`. |
| `320` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `321` | `<img id="prev-despues" src="#" alt="Vista previa después">` | Instrucción de ejecución en el contexto del script: `<img id="prev-despues" src="#" alt="Vista previa después">`. |
| `322` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `323` | `<input type="file" id="inp-despues" name="foto_despues"` | Campo de entrada interactivo para datos del usuario: `<input type="file" id="inp-despues" name="foto_despues"`. |
| `324` | `accept=".jpg,.jpeg,.png" required class="form-control form-control-sm mt-2"` | Instrucción de ejecución en el contexto del script: `accept=".jpg,.jpeg,.png" required class="form-control form-control-sm mt-2"`. |
| `325` | `onchange="dzPreview(this,'dz-despues','prev-despues','despues')">` | Instrucción de ejecución en el contexto del script: `onchange="dzPreview(this,'dz-despues','prev-despues','despues')">`. |
| `326` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `327` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `328` | `</div><!-- /foto-par -->` | Instrucción de ejecución en el contexto del script: `</div><!-- /foto-par -->`. |
| `329` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `330` | `<!-- Observaciones -->` | Instrucción de ejecución en el contexto del script: `<!-- Observaciones -->`. |
| `331` | `<div class="ev-field mb-4">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="ev-field mb-4">`. |
| `332` | `<label>Observaciones <span style="color:#9ca3af;font-weight:400;">(opcio...` | Instrucción de ejecución en el contexto del script: `<label>Observaciones <span style="color:#9ca3af;font-weight:400;">(opcio...`. |
| `333` | `<textarea name="observaciones" class="form-control" rows="2"` | Instrucción de ejecución en el contexto del script: `<textarea name="observaciones" class="form-control" rows="2"`. |
| `334` | `placeholder="Agrega cualquier comentario relevante…"` | Instrucción de ejecución en el contexto del script: `placeholder="Agrega cualquier comentario relevante…"`. |
| `335` | `style="resize:none;background:#fff;"></textarea>` | Instrucción de ejecución en el contexto del script: `style="resize:none;background:#fff;"></textarea>`. |
| `336` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `337` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `338` | `<!-- Indicador de progreso -->` | Instrucción de ejecución en el contexto del script: `<!-- Indicador de progreso -->`. |
| `339` | `<div id="progreso" class="mb-3 d-flex align-items-center gap-2"` | Contenedor visual estructurado con Bootstrap/CSS: `<div id="progreso" class="mb-3 d-flex align-items-center gap-2"`. |
| `340` | `style="font-size:.82rem;color:#6b7280;">` | Instrucción de ejecución en el contexto del script: `style="font-size:.82rem;color:#6b7280;">`. |
| `341` | `<span id="prog-antes"   style="color:#d1d5db;"><i class="fas fa-circle">...` | Instrucción de ejecución en el contexto del script: `<span id="prog-antes"   style="color:#d1d5db;"><i class="fas fa-circle">...`. |
| `342` | `<span style="color:#d1d5db;">·</span>` | Instrucción de ejecución en el contexto del script: `<span style="color:#d1d5db;">·</span>`. |
| `343` | `<span id="prog-despues" style="color:#d1d5db;"><i class="fas fa-circle">...` | Instrucción de ejecución en el contexto del script: `<span id="prog-despues" style="color:#d1d5db;"><i class="fas fa-circle">...`. |
| `344` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `345` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `346` | `<button type="submit" class="btn-enviar" id="btnEnviar" disabled>` | Botón de acción interactivo para el usuario: `<button type="submit" class="btn-enviar" id="btnEnviar" disabled>`. |
| `347` | `<i class="fas fa-upload"></i> Enviar Evidencias` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-upload"></i> Enviar Evidencias`. |
| `348` | `</button>` | Instrucción de ejecución en el contexto del script: `</button>`. |
| `349` | ``</form>`` | Cierre de formulario interactivo. |
| `350` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `351` | `<?php endif; ?>` | Cierre de estructura condicional embebida en la plantilla HTML. |
| `352` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `353` | `<!-- ══ HISTORIAL DE TURNOS ════════════════════════════════════════════...` | Instrucción de ejecución en el contexto del script: `<!-- ══ HISTORIAL DE TURNOS ════════════════════════════════════════════...`. |
| `354` | `<?php if (!empty($historial)): ?>` | Instrucción de ejecución en el contexto del script: `<?php if (!empty($historial)): ?>`. |
| `355` | `<div class="ev-card" style="padding:0; overflow:hidden;">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="ev-card" style="padding:0; overflow:hidden;">`. |
| `356` | `<div style="padding:1rem 1.5rem; border-bottom:1px solid #f3f4f6;">` | Contenedor visual estructurado con Bootstrap/CSS: `<div style="padding:1rem 1.5rem; border-bottom:1px solid #f3f4f6;">`. |
| `357` | `<span class="fw-bold" style="font-size:.9rem;">Historial de Turnos</span>` | Instrucción de ejecución en el contexto del script: `<span class="fw-bold" style="font-size:.9rem;">Historial de Turnos</span>`. |
| `358` | `<span class="badge bg-secondary ms-2" style="font-size:.7rem;"><?= count...` | Instrucción de ejecución en el contexto del script: `<span class="badge bg-secondary ms-2" style="font-size:.7rem;"><?= count...`. |
| `359` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `360` | `<div class="table-responsive">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="table-responsive">`. |
| `361` | `<table class="table mb-0 hist-table">` | Tabla de datos para despliegue estructurado de información. |
| `362` | `<thead>` | Definición de estructura semántica de cabecera o cuerpo de tabla. |
| `363` | ``<tr>`` | Fila contenedora de datos dentro de la tabla. |
| `364` | `<th>Fecha</th>` | Celda de encabezado de columna: `<th>Fecha</th>`. |
| `365` | `<th>Módulo</th>` | Celda de encabezado de columna: `<th>Módulo</th>`. |
| `366` | `<th>Grupo</th>` | Celda de encabezado de columna: `<th>Grupo</th>`. |
| `367` | `<th>Estado</th>` | Celda de encabezado de columna: `<th>Estado</th>`. |
| `368` | `<th class="text-center">Fotos</th>` | Celda de encabezado de columna: `<th class="text-center">Fotos</th>`. |
| `369` | ``</tr>`` | Cierre de fila contenedora de tabla. |
| `370` | `</thead>` | Definición de estructura semántica de cabecera o cuerpo de tabla. |
| `371` | `<tbody>` | Definición de estructura semántica de cabecera o cuerpo de tabla. |
| `372` | `<?php foreach ($historial as $t):` | Instrucción de ejecución en el contexto del script: `<?php foreach ($historial as $t):`. |
| `373` | `$badgeMap = [` | Instrucción de ejecución en el contexto del script: `$badgeMap = [`. |
| `374` | `'Cumplido'   => ['bg'=>'#dcfce7','color'=>'#166534'],` | Instrucción de ejecución en el contexto del script: `'Cumplido'   => ['bg'=>'#dcfce7','color'=>'#166534'],`. |
| `375` | `'Incumplido' => ['bg'=>'#fee2e2','color'=>'#991b1b'],` | Instrucción de ejecución en el contexto del script: `'Incumplido' => ['bg'=>'#fee2e2','color'=>'#991b1b'],`. |
| `376` | `'Abierto'    => ['bg'=>'#fef9c3','color'=>'#854d0e'],` | Instrucción de ejecución en el contexto del script: `'Abierto'    => ['bg'=>'#fef9c3','color'=>'#854d0e'],`. |
| `377` | `'Cerrado'    => ['bg'=>'#f3f4f6','color'=>'#374151'],` | Instrucción de ejecución en el contexto del script: `'Cerrado'    => ['bg'=>'#f3f4f6','color'=>'#374151'],`. |
| `378` | `'Pendiente'  => ['bg'=>'#f3f4f6','color'=>'#6b7280'],` | Instrucción de ejecución en el contexto del script: `'Pendiente'  => ['bg'=>'#f3f4f6','color'=>'#6b7280'],`. |
| `379` | ``];`` | Cierre de estructura de arreglo o invocación de función. |
| `380` | `$b        = $badgeMap[$t['estado']] ?? ['bg'=>'#f3f4f6','color'=>'#37415...` | Instrucción de ejecución en el contexto del script: `$b        = $badgeMap[$t['estado']] ?? ['bg'=>'#f3f4f6','color'=>'#37415...`. |
| `381` | `$esFuturo = strtotime($t['fecha_turno']) > strtotime('today');` | Instrucción de ejecución en el contexto del script: `$esFuturo = strtotime($t['fecha_turno']) > strtotime('today');`. |
| `382` | `$nFotos   = (int)($t['tiene_evidencia'] ?? 0);` | Instrucción de ejecución en el contexto del script: `$nFotos   = (int)($t['tiene_evidencia'] ?? 0);`. |
| `383` | ``?>`` | Cierre de la etiqueta PHP para alternar a salida HTML o fin del archivo. |
| `384` | ``<tr>`` | Fila contenedora de datos dentro de la tabla. |
| `385` | `<td class="fw-semibold">` | Celda de contenido de tabla: `<td class="fw-semibold">`. |
| `386` | `<?= date('d/m/Y', strtotime($t['fecha_turno'])) ?>` | Instrucción de ejecución en el contexto del script: `<?= date('d/m/Y', strtotime($t['fecha_turno'])) ?>`. |
| `387` | `<div style="font-size:.72rem;color:#9ca3af;">` | Contenedor visual estructurado con Bootstrap/CSS: `<div style="font-size:.72rem;color:#9ca3af;">`. |
| `388` | `<?= $diasES[(int)(new DateTime($t['fecha_turno']))->format('w')] ?>` | Instrucción de ejecución en el contexto del script: `<?= $diasES[(int)(new DateTime($t['fecha_turno']))->format('w')] ?>`. |
| `389` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `390` | `</td>` | Instrucción de ejecución en el contexto del script: `</td>`. |
| `391` | `<td><?= htmlspecialchars($t['nombre_modulo']) ?></td>` | Celda de contenido de tabla: `<td><?= htmlspecialchars($t['nombre_modulo']) ?></td>`. |
| `392` | `<td style="color:#6b7280;">` | Celda de contenido de tabla: `<td style="color:#6b7280;">`. |
| `393` | `<?= $t['nombre_grupo'] ? htmlspecialchars($t['nombre_grupo']) : '—' ?>` | Instrucción de ejecución en el contexto del script: `<?= $t['nombre_grupo'] ? htmlspecialchars($t['nombre_grupo']) : '—' ?>`. |
| `394` | `</td>` | Instrucción de ejecución en el contexto del script: `</td>`. |
| `395` | `<td>` | Celda de contenido de tabla: `<td>`. |
| `396` | `<span style="background:<?= $b['bg'] ?>;color:<?= $b['color'] ?>;` | Instrucción de ejecución en el contexto del script: `<span style="background:<?= $b['bg'] ?>;color:<?= $b['color'] ?>;`. |
| `397` | `border-radius:20px;padding:.2rem .7rem;` | Instrucción de ejecución en el contexto del script: `border-radius:20px;padding:.2rem .7rem;`. |
| `398` | `font-size:.75rem;font-weight:600;">` | Instrucción de ejecución en el contexto del script: `font-size:.75rem;font-weight:600;">`. |
| `399` | `<?= htmlspecialchars($t['estado']) ?>` | Instrucción de ejecución en el contexto del script: `<?= htmlspecialchars($t['estado']) ?>`. |
| `400` | `</span>` | Instrucción de ejecución en el contexto del script: `</span>`. |
| `401` | `</td>` | Instrucción de ejecución en el contexto del script: `</td>`. |
| `402` | `<td class="text-center">` | Celda de contenido de tabla: `<td class="text-center">`. |
| `403` | `<?php if ($nFotos >= 2): ?>` | Instrucción de ejecución en el contexto del script: `<?php if ($nFotos >= 2): ?>`. |
| `404` | `<span class="badge" style="background:#dcfce7;color:#166534;font-size:.7...` | Instrucción de ejecución en el contexto del script: `<span class="badge" style="background:#dcfce7;color:#166534;font-size:.7...`. |
| `405` | `<i class="fas fa-check me-1"></i>2/2` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-check me-1"></i>2/2`. |
| `406` | `</span>` | Instrucción de ejecución en el contexto del script: `</span>`. |
| `407` | `<?php elseif ($nFotos === 1): ?>` | Instrucción de ejecución en el contexto del script: `<?php elseif ($nFotos === 1): ?>`. |
| `408` | `<span class="badge" style="background:#fef3c7;color:#92400e;font-size:.7...` | Instrucción de ejecución en el contexto del script: `<span class="badge" style="background:#fef3c7;color:#92400e;font-size:.7...`. |
| `409` | `1/2` | Instrucción de ejecución en el contexto del script: `1/2`. |
| `410` | `</span>` | Instrucción de ejecución en el contexto del script: `</span>`. |
| `411` | `<?php else: ?>` | Instrucción de ejecución en el contexto del script: `<?php else: ?>`. |
| `412` | `<span style="color:#d1d5db;">—</span>` | Instrucción de ejecución en el contexto del script: `<span style="color:#d1d5db;">—</span>`. |
| `413` | `<?php endif; ?>` | Cierre de estructura condicional embebida en la plantilla HTML. |
| `414` | `</td>` | Instrucción de ejecución en el contexto del script: `</td>`. |
| `415` | ``</tr>`` | Cierre de fila contenedora de tabla. |
| `416` | `<?php endforeach; ?>` | Cierre de ciclo iterativo foreach embebido en la plantilla HTML. |
| `417` | `</tbody>` | Definición de estructura semántica de cabecera o cuerpo de tabla. |
| `418` | ``</table>`` | Cierre de tabla de datos. |
| `419` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `420` | ``</div>`` | Cierre de contenedor visual `<div>`. |
| `421` | `<?php endif; ?>` | Cierre de estructura condicional embebida en la plantilla HTML. |
| `422` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `423` | `</div><!-- /ev-page -->` | Instrucción de ejecución en el contexto del script: `</div><!-- /ev-page -->`. |
| `424` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `425` | `<?php if ($alert): ?>` | Instrucción de ejecución en el contexto del script: `<?php if ($alert): ?>`. |
| `426` | ``<script>`` | Bloque o etiqueta de vinculación para scripts JavaScript del lado del cliente. |
| `427` | `document.addEventListener('DOMContentLoaded', function () {` | Registra un escucha de eventos del DOM para interactividad en tiempo real: `document.addEventListener('DOMContentLoaded', function () {`. |
| `428` | `Swal.fire({` | Despliega una alerta modal estética e interactiva con SweetAlert2. |
| `429` | `icon:  '<?= addslashes($alert['icon'])  ?>',` | Instrucción de ejecución en el contexto del script: `icon:  '<?= addslashes($alert['icon'])  ?>',`. |
| `430` | `title: '<?= addslashes($alert['title']) ?>',` | Instrucción de ejecución en el contexto del script: `title: '<?= addslashes($alert['title']) ?>',`. |
| `431` | `text:  '<?= addslashes($alert['text'])  ?>',` | Instrucción de ejecución en el contexto del script: `text:  '<?= addslashes($alert['text'])  ?>',`. |
| `432` | `confirmButtonColor: '#39a900'` | Instrucción de ejecución en el contexto del script: `confirmButtonColor: '#39a900'`. |
| `433` | `});` | Instrucción de ejecución en el contexto del script: `});`. |
| `434` | `});` | Instrucción de ejecución en el contexto del script: `});`. |
| `435` | ``</script>`` | Cierre de bloque de script JavaScript. |
| `436` | `<?php endif; ?>` | Cierre de estructura condicional embebida en la plantilla HTML. |
| `437` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `438` | ``<script>`` | Bloque o etiqueta de vinculación para scripts JavaScript del lado del cliente. |
| `439` | `// Estado de selección` | Comentario explicativo en el código: `Estado de selección`. |
| `440` | `const seleccionado = { antes: false, despues: false };` | Instrucción de ejecución en el contexto del script: `const seleccionado = { antes: false, despues: false };`. |
| `441` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `442` | `function actualizarBtn() {` | Instrucción de ejecución en el contexto del script: `function actualizarBtn() {`. |
| `443` | `const btn      = document.getElementById('btnEnviar');` | Instrucción de ejecución en el contexto del script: `const btn      = document.getElementById('btnEnviar');`. |
| `444` | `const pAntes   = document.getElementById('prog-antes');` | Instrucción de ejecución en el contexto del script: `const pAntes   = document.getElementById('prog-antes');`. |
| `445` | `const pDespues = document.getElementById('prog-despues');` | Instrucción de ejecución en el contexto del script: `const pDespues = document.getElementById('prog-despues');`. |
| `446` | `if (!btn) return;` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (!btn) return;`. |
| `447` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `448` | `if (seleccionado.antes) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (seleccionado.antes) {`. |
| `449` | `pAntes.style.color = '#d97706';` | Instrucción de ejecución en el contexto del script: `pAntes.style.color = '#d97706';`. |
| `450` | `pAntes.innerHTML   = '<i class="fas fa-check-circle"></i> Foto antes';` | Instrucción de ejecución en el contexto del script: `pAntes.innerHTML   = '<i class="fas fa-check-circle"></i> Foto antes';`. |
| `451` | `} else {` | Instrucción de ejecución en el contexto del script: `} else {`. |
| `452` | `pAntes.style.color = '#d1d5db';` | Instrucción de ejecución en el contexto del script: `pAntes.style.color = '#d1d5db';`. |
| `453` | `pAntes.innerHTML   = '<i class="fas fa-circle"></i> Foto antes';` | Instrucción de ejecución en el contexto del script: `pAntes.innerHTML   = '<i class="fas fa-circle"></i> Foto antes';`. |
| `454` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `455` | `if (seleccionado.despues) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (seleccionado.despues) {`. |
| `456` | `pDespues.style.color = '#16a34a';` | Instrucción de ejecución en el contexto del script: `pDespues.style.color = '#16a34a';`. |
| `457` | `pDespues.innerHTML   = '<i class="fas fa-check-circle"></i> Foto después';` | Instrucción de ejecución en el contexto del script: `pDespues.innerHTML   = '<i class="fas fa-check-circle"></i> Foto después';`. |
| `458` | `} else {` | Instrucción de ejecución en el contexto del script: `} else {`. |
| `459` | `pDespues.style.color = '#d1d5db';` | Instrucción de ejecución en el contexto del script: `pDespues.style.color = '#d1d5db';`. |
| `460` | `pDespues.innerHTML   = '<i class="fas fa-circle"></i> Foto después';` | Instrucción de ejecución en el contexto del script: `pDespues.innerHTML   = '<i class="fas fa-circle"></i> Foto después';`. |
| `461` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `462` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `463` | `btn.disabled = !(seleccionado.antes && seleccionado.despues);` | Instrucción de ejecución en el contexto del script: `btn.disabled = !(seleccionado.antes && seleccionado.despues);`. |
| `464` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `465` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `466` | `function dzPreview(input, dzId, imgId, tipo) {` | Instrucción de ejecución en el contexto del script: `function dzPreview(input, dzId, imgId, tipo) {`. |
| `467` | `const dz  = document.getElementById(dzId);` | Instrucción de ejecución en el contexto del script: `const dz  = document.getElementById(dzId);`. |
| `468` | `const img = document.getElementById(imgId);` | Instrucción de ejecución en el contexto del script: `const img = document.getElementById(imgId);`. |
| `469` | `if (!input.files \|\| !input.files[0]) return;` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (!input.files \|\| !input.files[0]) return;`. |
| `470` | `const reader = new FileReader();` | Instrucción de ejecución en el contexto del script: `const reader = new FileReader();`. |
| `471` | `reader.onload = e => {` | Instrucción de ejecución en el contexto del script: `reader.onload = e => {`. |
| `472` | `img.src = e.target.result;` | Instrucción de ejecución en el contexto del script: `img.src = e.target.result;`. |
| `473` | `dz.classList.add('previewing');` | Instrucción de ejecución en el contexto del script: `dz.classList.add('previewing');`. |
| `474` | `dz.classList.remove('drag-over');` | Instrucción de ejecución en el contexto del script: `dz.classList.remove('drag-over');`. |
| `475` | `dz.classList.add('has-file-' + tipo);` | Instrucción de ejecución en el contexto del script: `dz.classList.add('has-file-' + tipo);`. |
| `476` | `};` | Instrucción de ejecución en el contexto del script: `};`. |
| `477` | `reader.readAsDataURL(input.files[0]);` | Instrucción de ejecución en el contexto del script: `reader.readAsDataURL(input.files[0]);`. |
| `478` | `seleccionado[tipo] = true;` | Instrucción de ejecución en el contexto del script: `seleccionado[tipo] = true;`. |
| `479` | `actualizarBtn();` | Instrucción de ejecución en el contexto del script: `actualizarBtn();`. |
| `480` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `481` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `482` | `function dzDragOver(dzId, tipo) {` | Instrucción de ejecución en el contexto del script: `function dzDragOver(dzId, tipo) {`. |
| `483` | `document.getElementById(dzId).classList.add('drag-over');` | Instrucción de ejecución en el contexto del script: `document.getElementById(dzId).classList.add('drag-over');`. |
| `484` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `485` | `function dzDragLeave(dzId) {` | Instrucción de ejecución en el contexto del script: `function dzDragLeave(dzId) {`. |
| `486` | `document.getElementById(dzId).classList.remove('drag-over');` | Instrucción de ejecución en el contexto del script: `document.getElementById(dzId).classList.remove('drag-over');`. |
| `487` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `488` | `function dzDrop(e, dzId, inputId, imgId, tipo) {` | Instrucción de ejecución en el contexto del script: `function dzDrop(e, dzId, inputId, imgId, tipo) {`. |
| `489` | `e.preventDefault();` | Instrucción de ejecución en el contexto del script: `e.preventDefault();`. |
| `490` | `dzDragLeave(dzId);` | Instrucción de ejecución en el contexto del script: `dzDragLeave(dzId);`. |
| `491` | `const files = e.dataTransfer.files;` | Instrucción de ejecución en el contexto del script: `const files = e.dataTransfer.files;`. |
| `492` | `if (!files.length) return;` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (!files.length) return;`. |
| `493` | `const input = document.getElementById(inputId);` | Instrucción de ejecución en el contexto del script: `const input = document.getElementById(inputId);`. |
| `494` | `try { const dt = new DataTransfer(); dt.items.add(files[0]); input.files...` | Instrucción de ejecución en el contexto del script: `try { const dt = new DataTransfer(); dt.items.add(files[0]); input.files...`. |
| `495` | `catch(err) {}` | Instrucción de ejecución en el contexto del script: `catch(err) {}`. |
| `496` | `dzPreview(input, dzId, imgId, tipo);` | Instrucción de ejecución en el contexto del script: `dzPreview(input, dzId, imgId, tipo);`. |
| `497` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `498` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `499` | `document.addEventListener('DOMContentLoaded', actualizarBtn);` | Registra un escucha de eventos del DOM para interactividad en tiempo real: `document.addEventListener('DOMContentLoaded', actualizarBtn);`. |
| `500` | ``</script>`` | Cierre de bloque de script JavaScript. |
| `501` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `502` | `<?php require_once __DIR__ . '/../layouts/footer.php'; ?>` | Importación e inclusión obligatoria del archivo de dependencia requerido: `<?php require_once __DIR__ . '/../layouts/footer.php'; ?>`. |

---

## 3. Resumen y Flujo de Interacción

El archivo `vocero_subir_evidencia.php` cumple un rol indispensable en `views/dashboard/vocero_subir_evidencia.php`. 
Formulario con carga de archivos fotográficos (antes y después) y observaciones para registrar el turno. Garantiza la robustez, el orden y la estabilidad de la arquitectura del proyecto `systemLimpieza`.

---

Generado automáticamente para el repositorio [johanrepizo/LimpiezaDeModulos](https://github.com/johanrepizo/LimpiezaDeModulos).
