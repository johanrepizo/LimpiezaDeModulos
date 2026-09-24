# Documentación Línea por Línea: `controllers/VoceroController.php`

## 1. Ficha Técnica del Archivo

- **Archivo:** `VoceroController.php`
- **Ruta en el proyecto:** `controllers/VoceroController.php`
- **Cantidad total de líneas:** `417`
- **Tipo de archivo:** `PHP`
- **Propósito general:** Controlador para el rol Vocero. Permite registrar y editar grupos de limpieza de la ficha, asignar aprendices y subir evidencias fotográficas de los turnos.

---

## 2. Explicación Detallada Línea por Línea

A continuación se presenta cada línea de código numerada de forma consecutiva, acompañada de su fragmento exacto y la explicación exhaustiva de su funcionamiento y responsabilidad en el sistema:

| Línea | Código Fuente | Explicación Detallada |
|---|---|---|
| `1` | `<?php` | Apertura obligatoria de la etiqueta PHP para ejecución del código del lado del servidor. |
| `2` | `if (session_status() === PHP_SESSION_NONE) session_start();` | Inicia o reanuda la sesión PHP del usuario si no se encontraba activa previamente. |
| `3` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `4` | `require_once __DIR__ . '/../config/database.php';` | Importación e inclusión obligatoria del archivo de dependencia requerido: `require_once __DIR__ . '/../config/database.php';`. |
| `5` | `require_once __DIR__ . '/../models/Grupo.php';` | Importación e inclusión obligatoria del archivo de dependencia requerido: `require_once __DIR__ . '/../models/Grupo.php';`. |
| `6` | `require_once __DIR__ . '/../models/Evidencia.php';` | Importación e inclusión obligatoria del archivo de dependencia requerido: `require_once __DIR__ . '/../models/Evidencia.php';`. |
| `7` | `require_once __DIR__ . '/../models/Ficha.php';` | Importación e inclusión obligatoria del archivo de dependencia requerido: `require_once __DIR__ . '/../models/Ficha.php';`. |
| `8` | `require_once __DIR__ . '/../models/Notificacion.php';` | Importación e inclusión obligatoria del archivo de dependencia requerido: `require_once __DIR__ . '/../models/Notificacion.php';`. |
| `9` | `require_once __DIR__ . '/../models/Turno.php';` | Importación e inclusión obligatoria del archivo de dependencia requerido: `require_once __DIR__ . '/../models/Turno.php';`. |
| `10` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `11` | `class VoceroController` | Declaración de la clase del componente: `class VoceroController`. |
| `12` | `{` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `13` | `    private PDO $db;` | Propiedad `private` de tipo `PDO` `$db` para el estado interno de la clase. |
| `14` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `15` | `    public function __construct()` | Declaración de método o función con su firma y parámetros: `public function __construct()`. |
| `16` | `    {` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `17` | `        $this->db = (new Database())->conectar();` | Instrucción de ejecución en el contexto del script: `$this->db = (new Database())->conectar();`. |
| `18` | `    }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `19` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `20` | `    // ── GUARDAR GRUPO ──────────────────────────────────────────────────────` | Comentario de línea explicativo: `── GUARDAR GRUPO ──────────────────────────────────────────────────────`. |
| `21` | `    public function guardarGrupo(): void` | Declaración de método o función con su firma y parámetros: `public function guardarGrupo(): void`. |
| `22` | `    {` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `23` | `        $this->requireVocero();` | Instrucción de ejecución en el contexto del script: `$this->requireVocero();`. |
| `24` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `25` | `        $idVocero     = $this->getIdVocero();` | Instrucción de ejecución en el contexto del script: `$idVocero     = $this->getIdVocero();`. |
| `26` | `        $idAsignacion = (int)($_POST['id_asignacion'] ?? 0);` | Captura y sanitiza parámetros enviados por el cliente mediante petición HTTP: `$idAsignacion = (int)($_POST['id_asignacion'] ?? 0);`. |
| `27` | `        $nombreGrupo  = trim($_POST['nombre_grupo']   ?? '');` | Captura y sanitiza parámetros enviados por el cliente mediante petición HTTP: `$nombreGrupo  = trim($_POST['nombre_grupo']   ?? '');`. |
| `28` | `        $aprendices   = $_POST['aprendices']          ?? [];` | Captura y sanitiza parámetros enviados por el cliente mediante petición HTTP: `$aprendices   = $_POST['aprendices']          ?? [];`. |
| `29` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `30` | `        if (!$idAsignacion \|\| empty($nombreGrupo)) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (!$idAsignacion \|\| empty($nombreGrupo)) {`. |
| `31` | `            $_SESSION['alert'] = ['icon'=>'warning','title'=>'Datos incompl...` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección: `$_SESSION['alert'] = ['icon'=>'warning','title'=>'Datos incompletos','text'=>'Escribe el nombre del grupo y selecciona al menos un integrante.'];`. |
| `32` | `            header("Location: ../views/dashboard/vocero_grupos.php"); exit;` | Emite cabecera HTTP de redirección en el navegador: `header("Location: ../views/dashboard/vocero_grupos.php"); exit;`. |
| `33` | `        }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `34` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `35` | `        if (empty($aprendices)) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (empty($aprendices)) {`. |
| `36` | `            $_SESSION['alert'] = ['icon'=>'warning','title'=>'Sin integrant...` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección: `$_SESSION['alert'] = ['icon'=>'warning','title'=>'Sin integrantes','text'=>'El grupo debe tener al menos un integrante.'];`. |
| `37` | `            header("Location: ../views/dashboard/vocero_grupos.php"); exit;` | Emite cabecera HTTP de redirección en el navegador: `header("Location: ../views/dashboard/vocero_grupos.php"); exit;`. |
| `38` | `        }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `39` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `40` | `        // ── Buscar el próximo turno libre de esta asignación ────────────` | Comentario de línea explicativo: `── Buscar el próximo turno libre de esta asignación ────────────`. |
| `41` | `        $modelTurno = new Turno($this->db);` | Instrucción de ejecución en el contexto del script: `$modelTurno = new Turno($this->db);`. |
| `42` | `        $fechaLimpieza = $modelTurno->proximaFechaLibre($idAsignacion);` | Instrucción de ejecución en el contexto del script: `$fechaLimpieza = $modelTurno->proximaFechaLibre($idAsignacion);`. |
| `43` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `44` | `        if (!$fechaLimpieza) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (!$fechaLimpieza) {`. |
| `45` | `            $_SESSION['alert'] = ['icon'=>'error','title'=>'Sin turnos disp...` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección: `$_SESSION['alert'] = ['icon'=>'error','title'=>'Sin turnos disponibles','text'=>'Ya no hay fechas de limpieza pendientes para asignar en este período. Todos los turnos ya tienen grupo.'];`. |
| `46` | `            header("Location: ../views/dashboard/vocero_grupos.php"); exit;` | Emite cabecera HTTP de redirección en el navegador: `header("Location: ../views/dashboard/vocero_grupos.php"); exit;`. |
| `47` | `        }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `48` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `49` | `        $modelGrupo = new Grupo($this->db);` | Instrucción de ejecución en el contexto del script: `$modelGrupo = new Grupo($this->db);`. |
| `50` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `51` | `        $resultado = $modelGrupo->crear([` | Instrucción de ejecución en el contexto del script: `$resultado = $modelGrupo->crear([`. |
| `52` | `            'id_asignacion'  => $idAsignacion,` | Instrucción de ejecución en el contexto del script: `'id_asignacion'  => $idAsignacion,`. |
| `53` | `            'id_vocero'      => $idVocero,` | Instrucción de ejecución en el contexto del script: `'id_vocero'      => $idVocero,`. |
| `54` | `            'nombre_grupo'   => $nombreGrupo,` | Instrucción de ejecución en el contexto del script: `'nombre_grupo'   => $nombreGrupo,`. |
| `55` | `            'fecha_limpieza' => $fechaLimpieza,` | Instrucción de ejecución en el contexto del script: `'fecha_limpieza' => $fechaLimpieza,`. |
| `56` | `        ], $aprendices);` | Instrucción de ejecución en el contexto del script: `], $aprendices);`. |
| `57` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `58` | `        if ($resultado) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if ($resultado) {`. |
| `59` | `            // Vincular este grupo al turno que le corresponde` | Comentario de línea explicativo: `Vincular este grupo al turno que le corresponde`. |
| `60` | `            $modelTurno->asignarGrupoAlTurno($idAsignacion, $fechaLimpieza,...` | Instrucción de ejecución en el contexto del script: `$modelTurno->asignarGrupoAlTurno($idAsignacion, $fechaLimpieza, $resultado);`. |
| `61` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `62` | `            $modelGrupo->registrarHistorial(` | Instrucción de ejecución en el contexto del script: `$modelGrupo->registrarHistorial(`. |
| `63` | `                $resultado,` | Instrucción de ejecución en el contexto del script: `$resultado,`. |
| `64` | `                "Grupo creado con " . count($aprendices) . " integrante(s)....` | Instrucción de ejecución en el contexto del script: `"Grupo creado con " . count($aprendices) . " integrante(s). Fecha asignada automáticamente: {$fechaLimpieza}.",`. |
| `65` | `                $_SESSION['usuario']['id_usuario']` | Accede o almacena información de identidad del usuario en la sesión activa: `$_SESSION['usuario']['id_usuario']`. |
| `66` | `            );` | Instrucción de ejecución en el contexto del script: `);`. |
| `67` | `            $_SESSION['alert'] = [` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección: `$_SESSION['alert'] = [`. |
| `68` | `                'icon'  => 'success',` | Instrucción de ejecución en el contexto del script: `'icon'  => 'success',`. |
| `69` | `                'title' => '¡Grupo registrado!',` | Instrucción de ejecución en el contexto del script: `'title' => '¡Grupo registrado!',`. |
| `70` | `                'text'  => 'Fecha de limpieza asignada automáticamente: ' ....` | Instrucción de ejecución en el contexto del script: `'text'  => 'Fecha de limpieza asignada automáticamente: ' . date('d/m/Y', strtotime($fechaLimpieza)) . '.',`. |
| `71` | `            ];` | Instrucción de ejecución en el contexto del script: `];`. |
| `72` | `        } else {` | Bloque alternativo `else`: se ejecuta si ninguna condición previa resultó verdadera. |
| `73` | `            $_SESSION['alert'] = ['icon'=>'error','title'=>'Error','text'=>...` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección: `$_SESSION['alert'] = ['icon'=>'error','title'=>'Error','text'=>'No se pudo registrar el grupo. Intenta de nuevo.'];`. |
| `74` | `        }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `75` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `76` | `        header("Location: ../views/dashboard/vocero_grupos.php"); exit;` | Emite cabecera HTTP de redirección en el navegador: `header("Location: ../views/dashboard/vocero_grupos.php"); exit;`. |
| `77` | `    }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `78` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `79` | `    // ── EDITAR GRUPO ───────────────────────────────────────────────────────` | Comentario de línea explicativo: `── EDITAR GRUPO ───────────────────────────────────────────────────────`. |
| `80` | `    public function editarGrupo(): void` | Declaración de método o función con su firma y parámetros: `public function editarGrupo(): void`. |
| `81` | `    {` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `82` | `        $this->requireVocero();` | Instrucción de ejecución en el contexto del script: `$this->requireVocero();`. |
| `83` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `84` | `        $idGrupo       = (int)($_POST['id_grupo']       ?? 0);` | Captura y sanitiza parámetros enviados por el cliente mediante petición HTTP: `$idGrupo       = (int)($_POST['id_grupo']       ?? 0);`. |
| `85` | `        $nombreGrupo   = trim($_POST['nombre_grupo']    ?? '');` | Captura y sanitiza parámetros enviados por el cliente mediante petición HTTP: `$nombreGrupo   = trim($_POST['nombre_grupo']    ?? '');`. |
| `86` | `        $fechaLimpieza = trim($_POST['fecha_limpieza']  ?? '');` | Captura y sanitiza parámetros enviados por el cliente mediante petición HTTP: `$fechaLimpieza = trim($_POST['fecha_limpieza']  ?? '');`. |
| `87` | `        $aprendices    = $_POST['aprendices']           ?? [];` | Captura y sanitiza parámetros enviados por el cliente mediante petición HTTP: `$aprendices    = $_POST['aprendices']           ?? [];`. |
| `88` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `89` | `        if (!$idGrupo \|\| empty($nombreGrupo) \|\| empty($fechaLimpieza) \...` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (!$idGrupo \|\| empty($nombreGrupo) \|\| empty($fechaLimpieza) \|\| empty($aprendices)) {`. |
| `90` | `            $_SESSION['alert'] = ['icon'=>'warning','title'=>'Datos incompl...` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección: `$_SESSION['alert'] = ['icon'=>'warning','title'=>'Datos incompletos','text'=>'Completa todos los campos y agrega al menos un integrante.'];`. |
| `91` | `            header("Location: ../views/dashboard/vocero_grupos.php"); exit;` | Emite cabecera HTTP de redirección en el navegador: `header("Location: ../views/dashboard/vocero_grupos.php"); exit;`. |
| `92` | `        }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `93` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `94` | `        $modelGrupo = new Grupo($this->db);` | Instrucción de ejecución en el contexto del script: `$modelGrupo = new Grupo($this->db);`. |
| `95` | `        $grupo      = $modelGrupo->obtenerPorId($idGrupo);` | Instrucción de ejecución en el contexto del script: `$grupo      = $modelGrupo->obtenerPorId($idGrupo);`. |
| `96` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `97` | `        // Verificar que el plazo no haya vencido` | Comentario de línea explicativo: `Verificar que el plazo no haya vencido`. |
| `98` | `        if ($grupo && strtotime($grupo['fecha_limite_evidencia']) < time()) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if ($grupo && strtotime($grupo['fecha_limite_evidencia']) < time()) {`. |
| `99` | `            $_SESSION['alert'] = ['icon'=>'error','title'=>'Plazo vencido',...` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección: `$_SESSION['alert'] = ['icon'=>'error','title'=>'Plazo vencido','text'=>'El plazo de modificación para este grupo ha expirado. Contacta al administrador.'];`. |
| `100` | `            header("Location: ../views/dashboard/vocero_grupos.php"); exit;` | Emite cabecera HTTP de redirección en el navegador: `header("Location: ../views/dashboard/vocero_grupos.php"); exit;`. |
| `101` | `        }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `102` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `103` | `        $resultado = $modelGrupo->actualizar($idGrupo, [` | Instrucción de ejecución en el contexto del script: `$resultado = $modelGrupo->actualizar($idGrupo, [`. |
| `104` | `            'nombre_grupo'   => $nombreGrupo,` | Instrucción de ejecución en el contexto del script: `'nombre_grupo'   => $nombreGrupo,`. |
| `105` | `            'fecha_limpieza' => $fechaLimpieza,` | Instrucción de ejecución en el contexto del script: `'fecha_limpieza' => $fechaLimpieza,`. |
| `106` | `        ], $aprendices);` | Instrucción de ejecución en el contexto del script: `], $aprendices);`. |
| `107` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `108` | `        if ($resultado) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if ($resultado) {`. |
| `109` | `            $modelGrupo->registrarHistorial(` | Instrucción de ejecución en el contexto del script: `$modelGrupo->registrarHistorial(`. |
| `110` | `                $idGrupo,` | Instrucción de ejecución en el contexto del script: `$idGrupo,`. |
| `111` | `                "Grupo editado: nombre='{$nombreGrupo}', integrantes actual...` | Instrucción de ejecución en el contexto del script: `"Grupo editado: nombre='{$nombreGrupo}', integrantes actualizados.",`. |
| `112` | `                $_SESSION['usuario']['id_usuario']` | Accede o almacena información de identidad del usuario en la sesión activa: `$_SESSION['usuario']['id_usuario']`. |
| `113` | `            );` | Instrucción de ejecución en el contexto del script: `);`. |
| `114` | `            $_SESSION['alert'] = ['icon'=>'success','title'=>'Grupo actuali...` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección: `$_SESSION['alert'] = ['icon'=>'success','title'=>'Grupo actualizado','text'=>'Los cambios se guardaron correctamente.'];`. |
| `115` | `        } else {` | Bloque alternativo `else`: se ejecuta si ninguna condición previa resultó verdadera. |
| `116` | `            $_SESSION['alert'] = ['icon'=>'error','title'=>'Error','text'=>...` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección: `$_SESSION['alert'] = ['icon'=>'error','title'=>'Error','text'=>'No se pudo actualizar el grupo.'];`. |
| `117` | `        }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `118` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `119` | `        header("Location: ../views/dashboard/vocero_grupos.php"); exit;` | Emite cabecera HTTP de redirección en el navegador: `header("Location: ../views/dashboard/vocero_grupos.php"); exit;`. |
| `120` | `    }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `121` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `122` | `    // ── ELIMINAR GRUPO ─────────────────────────────────────────────────────` | Comentario de línea explicativo: `── ELIMINAR GRUPO ─────────────────────────────────────────────────────`. |
| `123` | `    public function eliminarGrupo(): void` | Declaración de método o función con su firma y parámetros: `public function eliminarGrupo(): void`. |
| `124` | `    {` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `125` | `        $this->requireVocero();` | Instrucción de ejecución en el contexto del script: `$this->requireVocero();`. |
| `126` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `127` | `        $idGrupo    = (int)($_POST['id_grupo'] ?? 0);` | Captura y sanitiza parámetros enviados por el cliente mediante petición HTTP: `$idGrupo    = (int)($_POST['id_grupo'] ?? 0);`. |
| `128` | `        $modelGrupo = new Grupo($this->db);` | Instrucción de ejecución en el contexto del script: `$modelGrupo = new Grupo($this->db);`. |
| `129` | `        $resultado  = $modelGrupo->eliminar($idGrupo);` | Instrucción de ejecución en el contexto del script: `$resultado  = $modelGrupo->eliminar($idGrupo);`. |
| `130` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `131` | `        if ($resultado) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if ($resultado) {`. |
| `132` | `            $_SESSION['alert'] = ['icon'=>'success','title'=>'Grupo elimina...` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección: `$_SESSION['alert'] = ['icon'=>'success','title'=>'Grupo eliminado','text'=>'El grupo fue eliminado correctamente.'];`. |
| `133` | `        } else {` | Bloque alternativo `else`: se ejecuta si ninguna condición previa resultó verdadera. |
| `134` | `            $_SESSION['alert'] = ['icon'=>'error','title'=>'No se puede eli...` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección: `$_SESSION['alert'] = ['icon'=>'error','title'=>'No se puede eliminar','text'=>'Este grupo tiene evidencias registradas y no puede ser eliminado.'];`. |
| `135` | `        }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `136` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `137` | `        header("Location: ../views/dashboard/vocero_grupos.php"); exit;` | Emite cabecera HTTP de redirección en el navegador: `header("Location: ../views/dashboard/vocero_grupos.php"); exit;`. |
| `138` | `    }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `139` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `140` | `    // ── SUBIR EVIDENCIA ────────────────────────────────────────────────────` | Comentario de línea explicativo: `── SUBIR EVIDENCIA ────────────────────────────────────────────────────`. |
| `141` | `    public function subirEvidencia(): void` | Declaración de método o función con su firma y parámetros: `public function subirEvidencia(): void`. |
| `142` | `    {` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `143` | `        $this->requireVocero();` | Instrucción de ejecución en el contexto del script: `$this->requireVocero();`. |
| `144` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `145` | `        $idGrupo   = (int)($_POST['id_grupo'] ?? 0);` | Captura y sanitiza parámetros enviados por el cliente mediante petición HTTP: `$idGrupo   = (int)($_POST['id_grupo'] ?? 0);`. |
| `146` | `        $idVocero  = $this->getIdVocero();` | Instrucción de ejecución en el contexto del script: `$idVocero  = $this->getIdVocero();`. |
| `147` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `148` | `        $modelGrupo = new Grupo($this->db);` | Instrucción de ejecución en el contexto del script: `$modelGrupo = new Grupo($this->db);`. |
| `149` | `        $grupo      = $modelGrupo->obtenerPorId($idGrupo);` | Instrucción de ejecución en el contexto del script: `$grupo      = $modelGrupo->obtenerPorId($idGrupo);`. |
| `150` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `151` | `        if (!$grupo) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (!$grupo) {`. |
| `152` | `            $_SESSION['alert'] = ['icon'=>'error','title'=>'Error','text'=>...` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección: `$_SESSION['alert'] = ['icon'=>'error','title'=>'Error','text'=>'Grupo no encontrado.'];`. |
| `153` | `            header("Location: ../views/dashboard/vocero_evidencias.php"); e...` | Emite cabecera HTTP de redirección en el navegador: `header("Location: ../views/dashboard/vocero_evidencias.php"); exit;`. |
| `154` | `        }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `155` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `156` | `        // Verificar plazo` | Comentario de línea explicativo: `Verificar plazo`. |
| `157` | `        if (strtotime($grupo['fecha_limite_evidencia']) < time()) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (strtotime($grupo['fecha_limite_evidencia']) < time()) {`. |
| `158` | `            $_SESSION['alert'] = ['icon'=>'error','title'=>'Plazo vencido',...` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección: `$_SESSION['alert'] = ['icon'=>'error','title'=>'Plazo vencido','text'=>'El plazo de entrega venció el ' . date('d/m/Y H:i', strtotime($grupo['fecha_limite_evidencia'])) . '. Contacta al administrador.'];`. |
| `159` | `            header("Location: ../views/dashboard/vocero_evidencias.php"); e...` | Emite cabecera HTTP de redirección en el navegador: `header("Location: ../views/dashboard/vocero_evidencias.php"); exit;`. |
| `160` | `        }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `161` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `162` | `        // Verificar archivo` | Comentario de línea explicativo: `Verificar archivo`. |
| `163` | `        if (empty($_FILES['evidencia']['name'])) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (empty($_FILES['evidencia']['name'])) {`. |
| `164` | `            $_SESSION['alert'] = ['icon'=>'warning','title'=>'Sin archivo',...` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección: `$_SESSION['alert'] = ['icon'=>'warning','title'=>'Sin archivo','text'=>'Selecciona una imagen para subir.'];`. |
| `165` | `            header("Location: ../views/dashboard/vocero_evidencias.php"); e...` | Emite cabecera HTTP de redirección en el navegador: `header("Location: ../views/dashboard/vocero_evidencias.php"); exit;`. |
| `166` | `        }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `167` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `168` | `        $archivo     = $_FILES['evidencia'];` | Instrucción de ejecución en el contexto del script: `$archivo     = $_FILES['evidencia'];`. |
| `169` | `        $extensiones = ['jpg', 'jpeg', 'png'];` | Instrucción de ejecución en el contexto del script: `$extensiones = ['jpg', 'jpeg', 'png'];`. |
| `170` | `        $ext         = strtolower(pathinfo($archivo['name'], PATHINFO_EXTEN...` | Instrucción de ejecución en el contexto del script: `$ext         = strtolower(pathinfo($archivo['name'], PATHINFO_EXTENSION));`. |
| `171` | `        $maxSize     = 10 * 1024 * 1024; // 10 MB` | Instrucción de ejecución en el contexto del script: `$maxSize     = 10 * 1024 * 1024; // 10 MB`. |
| `172` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `173` | `        if (!in_array($ext, $extensiones)) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (!in_array($ext, $extensiones)) {`. |
| `174` | `            $_SESSION['alert'] = ['icon'=>'error','title'=>'Formato no perm...` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección: `$_SESSION['alert'] = ['icon'=>'error','title'=>'Formato no permitido','text'=>'Solo se aceptan archivos JPG, JPEG o PNG.'];`. |
| `175` | `            header("Location: ../views/dashboard/vocero_evidencias.php"); e...` | Emite cabecera HTTP de redirección en el navegador: `header("Location: ../views/dashboard/vocero_evidencias.php"); exit;`. |
| `176` | `        }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `177` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `178` | `        if ($archivo['size'] > $maxSize) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if ($archivo['size'] > $maxSize) {`. |
| `179` | `            $_SESSION['alert'] = ['icon'=>'error','title'=>'Archivo muy gra...` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección: `$_SESSION['alert'] = ['icon'=>'error','title'=>'Archivo muy grande','text'=>'El archivo supera el límite de 10 MB.'];`. |
| `180` | `            header("Location: ../views/dashboard/vocero_evidencias.php"); e...` | Emite cabecera HTTP de redirección en el navegador: `header("Location: ../views/dashboard/vocero_evidencias.php"); exit;`. |
| `181` | `        }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `182` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `183` | `        $carpeta    = __DIR__ . '/../public/uploads/evidencias/';` | Instrucción de ejecución en el contexto del script: `$carpeta    = __DIR__ . '/../public/uploads/evidencias/';`. |
| `184` | `        if (!is_dir($carpeta)) mkdir($carpeta, 0755, true);` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (!is_dir($carpeta)) mkdir($carpeta, 0755, true);`. |
| `185` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `186` | `        $nombreArchivo = 'ev_' . $idGrupo . '_' . uniqid() . '.' . $ext;` | Instrucción de ejecución en el contexto del script: `$nombreArchivo = 'ev_' . $idGrupo . '_' . uniqid() . '.' . $ext;`. |
| `187` | `        $rutaFisica    = $carpeta . $nombreArchivo;` | Instrucción de ejecución en el contexto del script: `$rutaFisica    = $carpeta . $nombreArchivo;`. |
| `188` | `        $rutaRelativa  = 'uploads/evidencias/' . $nombreArchivo;` | Instrucción de ejecución en el contexto del script: `$rutaRelativa  = 'uploads/evidencias/' . $nombreArchivo;`. |
| `189` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `190` | `        if (!move_uploaded_file($archivo['tmp_name'], $rutaFisica)) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (!move_uploaded_file($archivo['tmp_name'], $rutaFisica)) {`. |
| `191` | `            $_SESSION['alert'] = ['icon'=>'error','title'=>'Error al subir'...` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección: `$_SESSION['alert'] = ['icon'=>'error','title'=>'Error al subir','text'=>'No se pudo guardar el archivo. Intenta de nuevo.'];`. |
| `192` | `            header("Location: ../views/dashboard/vocero_evidencias.php"); e...` | Emite cabecera HTTP de redirección en el navegador: `header("Location: ../views/dashboard/vocero_evidencias.php"); exit;`. |
| `193` | `        }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `194` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `195` | `        $modelEv = new Evidencia($this->db);` | Instrucción de ejecución en el contexto del script: `$modelEv = new Evidencia($this->db);`. |
| `196` | `        $resultado = $modelEv->registrar([` | Instrucción de ejecución en el contexto del script: `$resultado = $modelEv->registrar([`. |
| `197` | `            'id_grupo'       => $idGrupo,` | Instrucción de ejecución en el contexto del script: `'id_grupo'       => $idGrupo,`. |
| `198` | `            'id_vocero'      => $idVocero,` | Instrucción de ejecución en el contexto del script: `'id_vocero'      => $idVocero,`. |
| `199` | `            'nombre_archivo' => $nombreArchivo,` | Instrucción de ejecución en el contexto del script: `'nombre_archivo' => $nombreArchivo,`. |
| `200` | `            'ruta_archivo'   => $rutaRelativa,` | Instrucción de ejecución en el contexto del script: `'ruta_archivo'   => $rutaRelativa,`. |
| `201` | `        ]);` | Instrucción de ejecución en el contexto del script: `]);`. |
| `202` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `203` | `        if ($resultado) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if ($resultado) {`. |
| `204` | `            $_SESSION['alert'] = ['icon'=>'success','title'=>'¡Evidencia en...` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección: `$_SESSION['alert'] = ['icon'=>'success','title'=>'¡Evidencia enviada!','text'=>'La evidencia fue registrada correctamente el ' . date('d/m/Y H:i') . '.'];`. |
| `205` | `        } else {` | Bloque alternativo `else`: se ejecuta si ninguna condición previa resultó verdadera. |
| `206` | `            $_SESSION['alert'] = ['icon'=>'error','title'=>'Error','text'=>...` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección: `$_SESSION['alert'] = ['icon'=>'error','title'=>'Error','text'=>'No se pudo registrar la evidencia en el sistema.'];`. |
| `207` | `        }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `208` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `209` | `        header("Location: ../views/dashboard/vocero_evidencias.php"); exit;` | Emite cabecera HTTP de redirección en el navegador: `header("Location: ../views/dashboard/vocero_evidencias.php"); exit;`. |
| `210` | `    }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `211` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `212` | `    // ── SUBIR EVIDENCIA CON TURNO ──────────────────────────────────────────` | Comentario de línea explicativo: `── SUBIR EVIDENCIA CON TURNO ──────────────────────────────────────────`. |
| `213` | `    public function subirEvidenciaTurno(): void` | Declaración de método o función con su firma y parámetros: `public function subirEvidenciaTurno(): void`. |
| `214` | `    {` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `215` | `        $this->requireVocero();` | Instrucción de ejecución en el contexto del script: `$this->requireVocero();`. |
| `216` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `217` | `        $idTurno  = (int)($_POST['id_turno'] ?? 0);` | Captura y sanitiza parámetros enviados por el cliente mediante petición HTTP: `$idTurno  = (int)($_POST['id_turno'] ?? 0);`. |
| `218` | `        $idGrupo  = (int)($_POST['id_grupo'] ?? 0);` | Captura y sanitiza parámetros enviados por el cliente mediante petición HTTP: `$idGrupo  = (int)($_POST['id_grupo'] ?? 0);`. |
| `219` | `        $obs      = trim($_POST['observaciones'] ?? '');` | Captura y sanitiza parámetros enviados por el cliente mediante petición HTTP: `$obs      = trim($_POST['observaciones'] ?? '');`. |
| `220` | `        $idVocero = $this->getIdVocero();` | Instrucción de ejecución en el contexto del script: `$idVocero = $this->getIdVocero();`. |
| `221` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `222` | `        if (!$idTurno) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (!$idTurno) {`. |
| `223` | `            $_SESSION['alert'] = ['icon'=>'error','title'=>'Error','text'=>...` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección: `$_SESSION['alert'] = ['icon'=>'error','title'=>'Error','text'=>'Turno no válido.'];`. |
| `224` | `            header("Location: ../views/dashboard/vocero_subir_evidencia.php...` | Emite cabecera HTTP de redirección en el navegador: `header("Location: ../views/dashboard/vocero_subir_evidencia.php"); exit;`. |
| `225` | `        }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `226` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `227` | `        // Verificar que el turno esté abierto hoy` | Comentario de línea explicativo: `Verificar que el turno esté abierto hoy`. |
| `228` | `        $stmtT = $this->db->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmtT = $this->db->prepare(`. |
| `229` | `            "SELECT * FROM turnos WHERE id_turno = :id AND estado IN ('Abie...` | Instrucción de ejecución en el contexto del script: `"SELECT * FROM turnos WHERE id_turno = :id AND estado IN ('Abierto','Pendiente')`. |
| `230` | `             AND NOW() BETWEEN fecha_apertura AND fecha_cierre LIMIT 1"` | Instrucción de ejecución en el contexto del script: `AND NOW() BETWEEN fecha_apertura AND fecha_cierre LIMIT 1"`. |
| `231` | `        );` | Instrucción de ejecución en el contexto del script: `);`. |
| `232` | `        $stmtT->execute([':id' => $idTurno]);` | Ejecuta la sentencia SQL preparada vinculando los datos correspondientes: `$stmtT->execute([':id' => $idTurno]);`. |
| `233` | `        $turno = $stmtT->fetch(PDO::FETCH_ASSOC);` | Recupera una única fila o registro resultante de la consulta. |
| `234` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `235` | `        if (!$turno) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (!$turno) {`. |
| `236` | `            $_SESSION['alert'] = ['icon'=>'error','title'=>'Turno cerrado',...` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección: `$_SESSION['alert'] = ['icon'=>'error','title'=>'Turno cerrado','text'=>'El plazo para subir evidencia de hoy ha vencido o el turno no es válido.'];`. |
| `237` | `            header("Location: ../views/dashboard/vocero_subir_evidencia.php...` | Emite cabecera HTTP de redirección en el navegador: `header("Location: ../views/dashboard/vocero_subir_evidencia.php"); exit;`. |
| `238` | `        }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `239` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `240` | `        // Verificar que no tenga ya evidencia` | Comentario de línea explicativo: `Verificar que no tenga ya evidencia`. |
| `241` | `        $stmtE = $this->db->prepare("SELECT id_evidencia FROM evidencias WH...` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmtE = $this->db->prepare("SELECT id_evidencia FROM evidencias WHERE id_turno = :id LIMIT 1");`. |
| `242` | `        $stmtE->execute([':id' => $idTurno]);` | Ejecuta la sentencia SQL preparada vinculando los datos correspondientes: `$stmtE->execute([':id' => $idTurno]);`. |
| `243` | `        if ($stmtE->fetch()) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if ($stmtE->fetch()) {`. |
| `244` | `            $_SESSION['alert'] = ['icon'=>'warning','title'=>'Ya registrada...` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección: `$_SESSION['alert'] = ['icon'=>'warning','title'=>'Ya registrada','text'=>'Ya existe una evidencia para este turno.'];`. |
| `245` | `            header("Location: ../views/dashboard/vocero_subir_evidencia.php...` | Emite cabecera HTTP de redirección en el navegador: `header("Location: ../views/dashboard/vocero_subir_evidencia.php"); exit;`. |
| `246` | `        }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `247` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `248` | `        // Validar archivo` | Comentario de línea explicativo: `Validar archivo`. |
| `249` | `        if (empty($_FILES['evidencia']['name'])) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (empty($_FILES['evidencia']['name'])) {`. |
| `250` | `            $_SESSION['alert'] = ['icon'=>'warning','title'=>'Sin archivo',...` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección: `$_SESSION['alert'] = ['icon'=>'warning','title'=>'Sin archivo','text'=>'Selecciona una imagen.'];`. |
| `251` | `            header("Location: ../views/dashboard/vocero_subir_evidencia.php...` | Emite cabecera HTTP de redirección en el navegador: `header("Location: ../views/dashboard/vocero_subir_evidencia.php"); exit;`. |
| `252` | `        }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `253` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `254` | `        $archivo  = $_FILES['evidencia'];` | Instrucción de ejecución en el contexto del script: `$archivo  = $_FILES['evidencia'];`. |
| `255` | `        $ext      = strtolower(pathinfo($archivo['name'], PATHINFO_EXTENSIO...` | Instrucción de ejecución en el contexto del script: `$ext      = strtolower(pathinfo($archivo['name'], PATHINFO_EXTENSION));`. |
| `256` | `        $maxSize  = 10 * 1024 * 1024;` | Instrucción de ejecución en el contexto del script: `$maxSize  = 10 * 1024 * 1024;`. |
| `257` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `258` | `        if (!in_array($ext, ['jpg','jpeg','png'])) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (!in_array($ext, ['jpg','jpeg','png'])) {`. |
| `259` | `            $_SESSION['alert'] = ['icon'=>'error','title'=>'Formato no váli...` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección: `$_SESSION['alert'] = ['icon'=>'error','title'=>'Formato no válido','text'=>'Solo JPG, JPEG o PNG.'];`. |
| `260` | `            header("Location: ../views/dashboard/vocero_subir_evidencia.php...` | Emite cabecera HTTP de redirección en el navegador: `header("Location: ../views/dashboard/vocero_subir_evidencia.php"); exit;`. |
| `261` | `        }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `262` | `        if ($archivo['size'] > $maxSize) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if ($archivo['size'] > $maxSize) {`. |
| `263` | `            $_SESSION['alert'] = ['icon'=>'error','title'=>'Archivo muy gra...` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección: `$_SESSION['alert'] = ['icon'=>'error','title'=>'Archivo muy grande','text'=>'Máximo 10 MB.'];`. |
| `264` | `            header("Location: ../views/dashboard/vocero_subir_evidencia.php...` | Emite cabecera HTTP de redirección en el navegador: `header("Location: ../views/dashboard/vocero_subir_evidencia.php"); exit;`. |
| `265` | `        }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `266` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `267` | `        $carpeta = __DIR__ . '/../public/uploads/evidencias/';` | Instrucción de ejecución en el contexto del script: `$carpeta = __DIR__ . '/../public/uploads/evidencias/';`. |
| `268` | `        if (!is_dir($carpeta)) mkdir($carpeta, 0755, true);` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (!is_dir($carpeta)) mkdir($carpeta, 0755, true);`. |
| `269` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `270` | `        $nombreArchivo = 'ev_t' . $idTurno . '_' . uniqid() . '.' . $ext;` | Instrucción de ejecución en el contexto del script: `$nombreArchivo = 'ev_t' . $idTurno . '_' . uniqid() . '.' . $ext;`. |
| `271` | `        $rutaFisica    = $carpeta . $nombreArchivo;` | Instrucción de ejecución en el contexto del script: `$rutaFisica    = $carpeta . $nombreArchivo;`. |
| `272` | `        $rutaRelativa  = 'uploads/evidencias/' . $nombreArchivo;` | Instrucción de ejecución en el contexto del script: `$rutaRelativa  = 'uploads/evidencias/' . $nombreArchivo;`. |
| `273` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `274` | `        if (!move_uploaded_file($archivo['tmp_name'], $rutaFisica)) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (!move_uploaded_file($archivo['tmp_name'], $rutaFisica)) {`. |
| `275` | `            $_SESSION['alert'] = ['icon'=>'error','title'=>'Error al subir'...` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección: `$_SESSION['alert'] = ['icon'=>'error','title'=>'Error al subir','text'=>'No se pudo guardar el archivo.'];`. |
| `276` | `            header("Location: ../views/dashboard/vocero_subir_evidencia.php...` | Emite cabecera HTTP de redirección en el navegador: `header("Location: ../views/dashboard/vocero_subir_evidencia.php"); exit;`. |
| `277` | `        }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `278` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `279` | `        // Si no hay grupo, usar el grupo del turno` | Comentario de línea explicativo: `Si no hay grupo, usar el grupo del turno`. |
| `280` | `        if (!$idGrupo && $turno['id_grupo']) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (!$idGrupo && $turno['id_grupo']) {`. |
| `281` | `            $idGrupo = (int)$turno['id_grupo'];` | Instrucción de ejecución en el contexto del script: `$idGrupo = (int)$turno['id_grupo'];`. |
| `282` | `        }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `283` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `284` | `        // Si aún no hay grupo, buscar cualquier grupo del vocero activo` | Comentario de línea explicativo: `Si aún no hay grupo, buscar cualquier grupo del vocero activo`. |
| `285` | `        if (!$idGrupo) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (!$idGrupo) {`. |
| `286` | `            $stmtG = $this->db->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmtG = $this->db->prepare(`. |
| `287` | `                "SELECT g.id_grupo FROM grupos g` | Instrucción de ejecución en el contexto del script: `"SELECT g.id_grupo FROM grupos g`. |
| `288` | `                 JOIN asignaciones a ON a.id_asignacion = g.id_asignacion` | Instrucción de ejecución en el contexto del script: `JOIN asignaciones a ON a.id_asignacion = g.id_asignacion`. |
| `289` | `                 WHERE g.id_vocero = :idv AND a.estado = 'Activa'` | Instrucción de ejecución en el contexto del script: `WHERE g.id_vocero = :idv AND a.estado = 'Activa'`. |
| `290` | `                 ORDER BY g.fecha_creacion DESC LIMIT 1"` | Instrucción de ejecución en el contexto del script: `ORDER BY g.fecha_creacion DESC LIMIT 1"`. |
| `291` | `            );` | Instrucción de ejecución en el contexto del script: `);`. |
| `292` | `            $stmtG->execute([':idv' => $idVocero]);` | Ejecuta la sentencia SQL preparada vinculando los datos correspondientes: `$stmtG->execute([':idv' => $idVocero]);`. |
| `293` | `            $rowG = $stmtG->fetch(PDO::FETCH_ASSOC);` | Recupera una única fila o registro resultante de la consulta. |
| `294` | `            $idGrupo = $rowG ? (int)$rowG['id_grupo'] : 0;` | Instrucción de ejecución en el contexto del script: `$idGrupo = $rowG ? (int)$rowG['id_grupo'] : 0;`. |
| `295` | `        }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `296` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `297` | `        if (!$idGrupo) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (!$idGrupo) {`. |
| `298` | `            $_SESSION['alert'] = ['icon'=>'error','title'=>'Sin grupo','tex...` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección: `$_SESSION['alert'] = ['icon'=>'error','title'=>'Sin grupo','text'=>'No hay grupo asignado para este turno. Contacta al administrador.'];`. |
| `299` | `            header("Location: ../views/dashboard/vocero_subir_evidencia.php...` | Emite cabecera HTTP de redirección en el navegador: `header("Location: ../views/dashboard/vocero_subir_evidencia.php"); exit;`. |
| `300` | `        }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `301` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `302` | `        // Registrar evidencia con id_turno` | Comentario de línea explicativo: `Registrar evidencia con id_turno`. |
| `303` | `        try {` | Inicia bloque de captura de excepciones `try` para ejecución segura de operaciones críticas. |
| `304` | `            $stmt = $this->db->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmt = $this->db->prepare(`. |
| `305` | `                "INSERT INTO evidencias (id_grupo, id_vocero, id_turno, nom...` | Instrucción de ejecución en el contexto del script: `"INSERT INTO evidencias (id_grupo, id_vocero, id_turno, nombre_archivo, ruta_archivo, observaciones)`. |
| `306` | `                 VALUES (:grupo, :vocero, :turno, :nombre, :ruta, :obs)"` | Instrucción de ejecución en el contexto del script: `VALUES (:grupo, :vocero, :turno, :nombre, :ruta, :obs)"`. |
| `307` | `            );` | Instrucción de ejecución en el contexto del script: `);`. |
| `308` | `            $stmt->execute([` | Ejecuta la sentencia SQL preparada vinculando los datos correspondientes: `$stmt->execute([`. |
| `309` | `                ':grupo'  => $idGrupo,` | Instrucción de ejecución en el contexto del script: `':grupo'  => $idGrupo,`. |
| `310` | `                ':vocero' => $idVocero,` | Instrucción de ejecución en el contexto del script: `':vocero' => $idVocero,`. |
| `311` | `                ':turno'  => $idTurno,` | Instrucción de ejecución en el contexto del script: `':turno'  => $idTurno,`. |
| `312` | `                ':nombre' => $nombreArchivo,` | Instrucción de ejecución en el contexto del script: `':nombre' => $nombreArchivo,`. |
| `313` | `                ':ruta'   => $rutaRelativa,` | Instrucción de ejecución en el contexto del script: `':ruta'   => $rutaRelativa,`. |
| `314` | `                ':obs'    => $obs ?: null,` | Instrucción de ejecución en el contexto del script: `':obs'    => $obs ?: null,`. |
| `315` | `            ]);` | Instrucción de ejecución en el contexto del script: `]);`. |
| `316` | `            // Marcar turno como cumplido` | Comentario de línea explicativo: `Marcar turno como cumplido`. |
| `317` | `            (new Turno($this->db))->marcarCumplido($idTurno);` | Instrucción de ejecución en el contexto del script: `(new Turno($this->db))->marcarCumplido($idTurno);`. |
| `318` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `319` | `            // Segunda foto (opcional)` | Comentario de línea explicativo: `Segunda foto (opcional)`. |
| `320` | `            if (!empty($_FILES['evidencia2']['name']) && $_FILES['evidencia...` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (!empty($_FILES['evidencia2']['name']) && $_FILES['evidencia2']['error'] === UPLOAD_ERR_OK) {`. |
| `321` | `                $archivo2  = $_FILES['evidencia2'];` | Instrucción de ejecución en el contexto del script: `$archivo2  = $_FILES['evidencia2'];`. |
| `322` | `                $ext2      = strtolower(pathinfo($archivo2['name'], PATHINF...` | Instrucción de ejecución en el contexto del script: `$ext2      = strtolower(pathinfo($archivo2['name'], PATHINFO_EXTENSION));`. |
| `323` | `                if (in_array($ext2, ['jpg','jpeg','png']) && $archivo2['siz...` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (in_array($ext2, ['jpg','jpeg','png']) && $archivo2['size'] <= $maxSize) {`. |
| `324` | `                    $nombreArchivo2 = 'ev_t' . $idTurno . '_2_' . uniqid() ...` | Instrucción de ejecución en el contexto del script: `$nombreArchivo2 = 'ev_t' . $idTurno . '_2_' . uniqid() . '.' . $ext2;`. |
| `325` | `                    $rutaFisica2    = $carpeta . $nombreArchivo2;` | Instrucción de ejecución en el contexto del script: `$rutaFisica2    = $carpeta . $nombreArchivo2;`. |
| `326` | `                    $rutaRelativa2  = 'uploads/evidencias/' . $nombreArchivo2;` | Instrucción de ejecución en el contexto del script: `$rutaRelativa2  = 'uploads/evidencias/' . $nombreArchivo2;`. |
| `327` | `                    if (move_uploaded_file($archivo2['tmp_name'], $rutaFisi...` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (move_uploaded_file($archivo2['tmp_name'], $rutaFisica2)) {`. |
| `328` | `                        $this->db->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$this->db->prepare(`. |
| `329` | `                            "INSERT INTO evidencias (id_grupo, id_vocero, i...` | Instrucción de ejecución en el contexto del script: `"INSERT INTO evidencias (id_grupo, id_vocero, id_turno, nombre_archivo, ruta_archivo, observaciones)`. |
| `330` | `                             VALUES (:grupo, :vocero, :turno, :nombre, :rut...` | Instrucción de ejecución en el contexto del script: `VALUES (:grupo, :vocero, :turno, :nombre, :ruta, :obs)"`. |
| `331` | `                        )->execute([` | Ejecuta la sentencia SQL preparada vinculando los datos correspondientes: `)->execute([`. |
| `332` | `                            ':grupo'  => $idGrupo,` | Instrucción de ejecución en el contexto del script: `':grupo'  => $idGrupo,`. |
| `333` | `                            ':vocero' => $idVocero,` | Instrucción de ejecución en el contexto del script: `':vocero' => $idVocero,`. |
| `334` | `                            ':turno'  => $idTurno,` | Instrucción de ejecución en el contexto del script: `':turno'  => $idTurno,`. |
| `335` | `                            ':nombre' => $nombreArchivo2,` | Instrucción de ejecución en el contexto del script: `':nombre' => $nombreArchivo2,`. |
| `336` | `                            ':ruta'   => $rutaRelativa2,` | Instrucción de ejecución en el contexto del script: `':ruta'   => $rutaRelativa2,`. |
| `337` | `                            ':obs'    => ($obs ? $obs . ' (foto 2)' : 'foto...` | Instrucción de ejecución en el contexto del script: `':obs'    => ($obs ? $obs . ' (foto 2)' : 'foto 2'),`. |
| `338` | `                        ]);` | Instrucción de ejecución en el contexto del script: `]);`. |
| `339` | `                    }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `340` | `                }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `341` | `            }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `342` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `343` | `            $_SESSION['alert'] = ['icon'=>'success','title'=>'¡Evidencia en...` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección: `$_SESSION['alert'] = ['icon'=>'success','title'=>'¡Evidencia enviada!','text'=>'La evidencia fue registrada correctamente el ' . date('d/m/Y H:i') . '.'];`. |
| `344` | `        } catch (Exception $e) {` | Captura y manejo de excepciones en caso de fallo durante el bloque protegido: `} catch (Exception $e) {`. |
| `345` | `            $_SESSION['alert'] = ['icon'=>'error','title'=>'Error','text'=>...` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección: `$_SESSION['alert'] = ['icon'=>'error','title'=>'Error','text'=>'No se pudo registrar la evidencia.'];`. |
| `346` | `        }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `347` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `348` | `        header("Location: ../views/dashboard/vocero_subir_evidencia.php"); ...` | Emite cabecera HTTP de redirección en el navegador: `header("Location: ../views/dashboard/vocero_subir_evidencia.php"); exit;`. |
| `349` | `    }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `350` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `351` | `    // ── GET EVIDENCIA (JSON) ────────────────────────────────────────────...` | Comentario de línea explicativo: `── GET EVIDENCIA (JSON) ────────────────────────────────────────────────`. |
| `352` | `    public function getEvidencia(): void` | Declaración de método o función con su firma y parámetros: `public function getEvidencia(): void`. |
| `353` | `    {` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `354` | `        header('Content-Type: application/json');` | Instrucción de ejecución en el contexto del script: `header('Content-Type: application/json');`. |
| `355` | `        $this->requireVocero();` | Instrucción de ejecución en el contexto del script: `$this->requireVocero();`. |
| `356` | `        $idGrupo = (int)($_GET['id_grupo'] ?? 0);` | Captura y sanitiza parámetros enviados por el cliente mediante petición HTTP: `$idGrupo = (int)($_GET['id_grupo'] ?? 0);`. |
| `357` | `        $modelEv = new Evidencia($this->db);` | Instrucción de ejecución en el contexto del script: `$modelEv = new Evidencia($this->db);`. |
| `358` | `        $ev = $modelEv->obtenerPorGrupo($idGrupo);` | Instrucción de ejecución en el contexto del script: `$ev = $modelEv->obtenerPorGrupo($idGrupo);`. |
| `359` | `        if ($ev) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if ($ev) {`. |
| `360` | `            $stmt = $this->db->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmt = $this->db->prepare(`. |
| `361` | `                "SELECT m.nombre AS modulo, g.nombre_grupo AS grupo, e.fech...` | Instrucción de ejecución en el contexto del script: `"SELECT m.nombre AS modulo, g.nombre_grupo AS grupo, e.fecha_subida, e.ruta_archivo`. |
| `362` | `                 FROM evidencias e` | Instrucción de ejecución en el contexto del script: `FROM evidencias e`. |
| `363` | `                 JOIN grupos g ON g.id_grupo = e.id_grupo` | Instrucción de ejecución en el contexto del script: `JOIN grupos g ON g.id_grupo = e.id_grupo`. |
| `364` | `                 JOIN asignaciones a ON a.id_asignacion = g.id_asignacion` | Instrucción de ejecución en el contexto del script: `JOIN asignaciones a ON a.id_asignacion = g.id_asignacion`. |
| `365` | `                 JOIN modulos m ON m.id_modulo = a.id_modulo` | Instrucción de ejecución en el contexto del script: `JOIN modulos m ON m.id_modulo = a.id_modulo`. |
| `366` | `                 WHERE e.id_evidencia = :id LIMIT 1"` | Instrucción de ejecución en el contexto del script: `WHERE e.id_evidencia = :id LIMIT 1"`. |
| `367` | `            );` | Instrucción de ejecución en el contexto del script: `);`. |
| `368` | `            $stmt->execute([':id' => $ev['id_evidencia']]);` | Ejecuta la sentencia SQL preparada vinculando los datos correspondientes: `$stmt->execute([':id' => $ev['id_evidencia']]);`. |
| `369` | `            $row = $stmt->fetch(PDO::FETCH_ASSOC);` | Recupera una única fila o registro resultante de la consulta. |
| `370` | `            echo json_encode([` | Instrucción de ejecución en el contexto del script: `echo json_encode([`. |
| `371` | `                'ruta'   => $row['ruta_archivo'],` | Instrucción de ejecución en el contexto del script: `'ruta'   => $row['ruta_archivo'],`. |
| `372` | `                'grupo'  => $row['grupo'],` | Instrucción de ejecución en el contexto del script: `'grupo'  => $row['grupo'],`. |
| `373` | `                'modulo' => $row['modulo'],` | Instrucción de ejecución en el contexto del script: `'modulo' => $row['modulo'],`. |
| `374` | `                'fecha'  => date('d/m/Y H:i', strtotime($row['fecha_subida']))` | Instrucción de ejecución en el contexto del script: `'fecha'  => date('d/m/Y H:i', strtotime($row['fecha_subida']))`. |
| `375` | `            ]);` | Instrucción de ejecución en el contexto del script: `]);`. |
| `376` | `        } else {` | Bloque alternativo `else`: se ejecuta si ninguna condición previa resultó verdadera. |
| `377` | `            echo json_encode(['ruta' => null]);` | Instrucción de ejecución en el contexto del script: `echo json_encode(['ruta' => null]);`. |
| `378` | `        }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `379` | `        exit;` | Detiene inmediatamente la ejecución del script PHP en el servidor. |
| `380` | `    }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `381` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `382` | `    // ── HELPERS ────────────────────────────────────────────────────────────` | Comentario de línea explicativo: `── HELPERS ────────────────────────────────────────────────────────────`. |
| `383` | `    private function requireVocero(): void` | Declaración de método o función con su firma y parámetros: `private function requireVocero(): void`. |
| `384` | `    {` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `385` | `        if (!isset($_SESSION['usuario']) \|\| (int)$_SESSION['usuario']['ro...` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (!isset($_SESSION['usuario']) \|\| (int)$_SESSION['usuario']['rol'] !== 2) {`. |
| `386` | `            header("Location: ../views/usuarios/login.php"); exit;` | Emite cabecera HTTP de redirección en el navegador: `header("Location: ../views/usuarios/login.php"); exit;`. |
| `387` | `        }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `388` | `    }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `389` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `390` | `    private function getIdVocero(): int` | Declaración de método o función con su firma y parámetros: `private function getIdVocero(): int`. |
| `391` | `    {` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `392` | `        // Buscar el id_vocero del usuario en sesión` | Comentario de línea explicativo: `Buscar el id_vocero del usuario en sesión`. |
| `393` | `        $stmt = $this->db->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmt = $this->db->prepare(`. |
| `394` | `            "SELECT id_vocero FROM voceros WHERE id_usuario = :id AND activ...` | Instrucción de ejecución en el contexto del script: `"SELECT id_vocero FROM voceros WHERE id_usuario = :id AND activo = 1 LIMIT 1"`. |
| `395` | `        );` | Instrucción de ejecución en el contexto del script: `);`. |
| `396` | `        $stmt->execute([':id' => $_SESSION['usuario']['id_usuario']]);` | Ejecuta la sentencia SQL preparada vinculando los datos correspondientes: `$stmt->execute([':id' => $_SESSION['usuario']['id_usuario']]);`. |
| `397` | `        $row = $stmt->fetch(PDO::FETCH_ASSOC);` | Recupera una única fila o registro resultante de la consulta. |
| `398` | `        return $row ? (int)$row['id_vocero'] : 0;` | Retorna el valor resultante de la expresión y culmina la ejecución de la función actual: `return $row ? (int)$row['id_vocero'] : 0;`. |
| `399` | `    }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `400` | `}` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `401` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `402` | `// ── Dispatcher ────────────────────────────────────────────────────────────` | Comentario de línea explicativo: `── Dispatcher ────────────────────────────────────────────────────────────`. |
| `403` | `if (basename(__FILE__) === basename($_SERVER['SCRIPT_FILENAME'])) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (basename(__FILE__) === basename($_SERVER['SCRIPT_FILENAME'])) {`. |
| `404` | `    $controller = new VoceroController();` | Instrucción de ejecución en el contexto del script: `$controller = new VoceroController();`. |
| `405` | `    $accion     = $_POST['accion'] ?? $_GET['accion'] ?? '';` | Captura y sanitiza parámetros enviados por el cliente mediante petición HTTP: `$accion     = $_POST['accion'] ?? $_GET['accion'] ?? '';`. |
| `406` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `407` | `    match ($accion) {` | Instrucción de ejecución en el contexto del script: `match ($accion) {`. |
| `408` | `        'guardar_grupo'   => $controller->guardarGrupo(),` | Instrucción de ejecución en el contexto del script: `'guardar_grupo'   => $controller->guardarGrupo(),`. |
| `409` | `        'editar_grupo'    => $controller->editarGrupo(),` | Instrucción de ejecución en el contexto del script: `'editar_grupo'    => $controller->editarGrupo(),`. |
| `410` | `        'eliminar_grupo'  => $controller->eliminarGrupo(),` | Instrucción de ejecución en el contexto del script: `'eliminar_grupo'  => $controller->eliminarGrupo(),`. |
| `411` | `        'subir_evidencia' => $controller->subirEvidencia(),` | Instrucción de ejecución en el contexto del script: `'subir_evidencia' => $controller->subirEvidencia(),`. |
| `412` | `        'subir_evidencia_turno' => $controller->subirEvidenciaTurno(),` | Instrucción de ejecución en el contexto del script: `'subir_evidencia_turno' => $controller->subirEvidenciaTurno(),`. |
| `413` | `        'get_evidencia'   => $controller->getEvidencia(),` | Instrucción de ejecución en el contexto del script: `'get_evidencia'   => $controller->getEvidencia(),`. |
| `414` | `        default           => header("Location: ../views/dashboard/vocero_da...` | Emite cabecera HTTP de redirección en el navegador: `default           => header("Location: ../views/dashboard/vocero_dashboard.php"),`. |
| `415` | `    };` | Instrucción de ejecución en el contexto del script: `};`. |
| `416` | `}` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `417` | `?>` | Cierre de la etiqueta PHP para alternar a salida HTML o fin del archivo. |

---

## 3. Resumen y Flujo de Interacción

El archivo `VoceroController.php` cumple un rol indispensable en `controllers/VoceroController.php`. 
Controlador para el rol Vocero. Permite registrar y editar grupos de limpieza de la ficha, asignar aprendices y subir evidencias fotográficas de los turnos. Garantiza la robustez, el orden y la estabilidad de la arquitectura del proyecto `systemLimpieza`.
