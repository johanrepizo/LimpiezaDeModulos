# Documentación Línea por Línea: `controllers/AdminController.php`

## 1. Ficha Técnica del Archivo

- **Archivo:** `AdminController.php`
- **Ruta en el proyecto:** `controllers/AdminController.php`
- **Cantidad total de líneas:** `588`
- **Tipo de archivo:** `PHP`
- **Propósito general:** Controlador principal del módulo de administración. Gestiona programas de formación, fichas, módulos, asignaciones de grupos, voceros y supervisión.

---

## 2. Explicación Detallada Línea por Línea

A continuación se presenta cada línea de código numerada de forma consecutiva, acompañada de su fragmento exacto y la explicación exhaustiva de su funcionamiento y responsabilidad en el sistema:

| Línea | Código Fuente | Explicación Detallada |
|---|---|---|
| `1` | `<?php` | Apertura obligatoria de la etiqueta PHP para ejecución del código del lado del servidor. |
| `2` | `if (session_status() === PHP_SESSION_NONE) session_start();` | Inicia o reanuda la sesión PHP del usuario si no se encontraba activa previamente. |
| `3` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `4` | `require_once __DIR__ . '/../config/database.php';` | Importación e inclusión obligatoria del archivo de dependencia requerido: `require_once __DIR__ . '/../config/database.php';`. |
| `5` | `require_once __DIR__ . '/../models/Programa.php';` | Importación e inclusión obligatoria del archivo de dependencia requerido: `require_once __DIR__ . '/../models/Programa.php';`. |
| `6` | `require_once __DIR__ . '/../models/Ficha.php';` | Importación e inclusión obligatoria del archivo de dependencia requerido: `require_once __DIR__ . '/../models/Ficha.php';`. |
| `7` | `require_once __DIR__ . '/../models/Modulo.php';` | Importación e inclusión obligatoria del archivo de dependencia requerido: `require_once __DIR__ . '/../models/Modulo.php';`. |
| `8` | `require_once __DIR__ . '/../models/Usuario.php';` | Importación e inclusión obligatoria del archivo de dependencia requerido: `require_once __DIR__ . '/../models/Usuario.php';`. |
| `9` | `require_once __DIR__ . '/../models/Notificacion.php';` | Importación e inclusión obligatoria del archivo de dependencia requerido: `require_once __DIR__ . '/../models/Notificacion.php';`. |
| `10` | `require_once __DIR__ . '/../models/Turno.php';` | Importación e inclusión obligatoria del archivo de dependencia requerido: `require_once __DIR__ . '/../models/Turno.php';`. |
| `11` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `12` | `class AdminController` | Declaración de la clase del componente: `class AdminController`. |
| `13` | `{` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `14` | `    private PDO $db;` | Propiedad `private` de tipo `PDO` `$db` para el estado interno de la clase. |
| `15` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `16` | `    public function __construct()` | Declaración de método o función con su firma y parámetros: `public function __construct()`. |
| `17` | `    {` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `18` | `        $this->db = (new Database())->conectar();` | Instrucción de ejecución en el contexto del script: `$this->db = (new Database())->conectar();`. |
| `19` | `    }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `20` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `21` | `    // ════════════════════════════════════════════════════════════════════...` | Comentario de línea explicativo: `════════════════════════════════════════════════════════════════════════`. |
| `22` | `    // PROGRAMAS` | Comentario de línea explicativo: `PROGRAMAS`. |
| `23` | `    // ════════════════════════════════════════════════════════════════════...` | Comentario de línea explicativo: `════════════════════════════════════════════════════════════════════════`. |
| `24` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `25` | `    public function guardarPrograma(): void` | Declaración de método o función con su firma y parámetros: `public function guardarPrograma(): void`. |
| `26` | `    {` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `27` | `        $this->requireAdmin();` | Instrucción de ejecución en el contexto del script: `$this->requireAdmin();`. |
| `28` | `        $model  = new Programa($this->db);` | Instrucción de ejecución en el contexto del script: `$model  = new Programa($this->db);`. |
| `29` | `        $id     = (int)($_POST['id_programa'] ?? 0);` | Captura y sanitiza parámetros enviados por el cliente mediante petición HTTP: `$id     = (int)($_POST['id_programa'] ?? 0);`. |
| `30` | `        $datos  = [` | Instrucción de ejecución en el contexto del script: `$datos  = [`. |
| `31` | `            'nombre'      => trim($_POST['nombre']      ?? ''),` | Captura y sanitiza parámetros enviados por el cliente mediante petición HTTP: `'nombre'      => trim($_POST['nombre']      ?? ''),`. |
| `32` | `            'descripcion' => trim($_POST['descripcion'] ?? ''),` | Captura y sanitiza parámetros enviados por el cliente mediante petición HTTP: `'descripcion' => trim($_POST['descripcion'] ?? ''),`. |
| `33` | `            'nivel'       => trim($_POST['nivel']       ?? ''),` | Captura y sanitiza parámetros enviados por el cliente mediante petición HTTP: `'nivel'       => trim($_POST['nivel']       ?? ''),`. |
| `34` | `        ];` | Instrucción de ejecución en el contexto del script: `];`. |
| `35` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `36` | `        if (empty($datos['nombre'])) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (empty($datos['nombre'])) {`. |
| `37` | `            $_SESSION['alert'] = ['icon'=>'warning','title'=>'Campo requeri...` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección: `$_SESSION['alert'] = ['icon'=>'warning','title'=>'Campo requerido','text'=>'El nombre del programa es obligatorio.'];`. |
| `38` | `            header("Location: ../views/dashboard/admin_programas.php"); exit;` | Emite cabecera HTTP de redirección en el navegador: `header("Location: ../views/dashboard/admin_programas.php"); exit;`. |
| `39` | `        }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `40` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `41` | `        if ($id) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if ($id) {`. |
| `42` | `            $model->actualizar($id, $datos);` | Instrucción de ejecución en el contexto del script: `$model->actualizar($id, $datos);`. |
| `43` | `            $_SESSION['alert'] = ['icon'=>'success','title'=>'Programa actu...` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección: `$_SESSION['alert'] = ['icon'=>'success','title'=>'Programa actualizado','text'=>'Los datos del programa fueron guardados.'];`. |
| `44` | `        } else {` | Bloque alternativo `else`: se ejecuta si ninguna condición previa resultó verdadera. |
| `45` | `            $model->crear($datos);` | Instrucción de ejecución en el contexto del script: `$model->crear($datos);`. |
| `46` | `            $_SESSION['alert'] = ['icon'=>'success','title'=>'Programa crea...` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección: `$_SESSION['alert'] = ['icon'=>'success','title'=>'Programa creado','text'=>'El programa de formación fue registrado exitosamente.'];`. |
| `47` | `        }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `48` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `49` | `        header("Location: ../views/dashboard/admin_programas.php"); exit;` | Emite cabecera HTTP de redirección en el navegador: `header("Location: ../views/dashboard/admin_programas.php"); exit;`. |
| `50` | `    }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `51` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `52` | `    public function eliminarPrograma(): void` | Declaración de método o función con su firma y parámetros: `public function eliminarPrograma(): void`. |
| `53` | `    {` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `54` | `        $this->requireAdmin();` | Instrucción de ejecución en el contexto del script: `$this->requireAdmin();`. |
| `55` | `        $id    = (int)($_POST['id_programa'] ?? 0);` | Captura y sanitiza parámetros enviados por el cliente mediante petición HTTP: `$id    = (int)($_POST['id_programa'] ?? 0);`. |
| `56` | `        $model = new Programa($this->db);` | Instrucción de ejecución en el contexto del script: `$model = new Programa($this->db);`. |
| `57` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `58` | `        if ($model->tieneFichasActivas($id)) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if ($model->tieneFichasActivas($id)) {`. |
| `59` | `            $_SESSION['alert'] = ['icon'=>'error','title'=>'No se puede eli...` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección: `$_SESSION['alert'] = ['icon'=>'error','title'=>'No se puede eliminar','text'=>'Este programa tiene fichas activas asociadas. Inactívalas primero.'];`. |
| `60` | `        } else {` | Bloque alternativo `else`: se ejecuta si ninguna condición previa resultó verdadera. |
| `61` | `            $model->eliminar($id);` | Instrucción de ejecución en el contexto del script: `$model->eliminar($id);`. |
| `62` | `            $_SESSION['alert'] = ['icon'=>'success','title'=>'Programa elim...` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección: `$_SESSION['alert'] = ['icon'=>'success','title'=>'Programa eliminado','text'=>'El programa fue marcado como inactivo.'];`. |
| `63` | `        }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `64` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `65` | `        header("Location: ../views/dashboard/admin_programas.php"); exit;` | Emite cabecera HTTP de redirección en el navegador: `header("Location: ../views/dashboard/admin_programas.php"); exit;`. |
| `66` | `    }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `67` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `68` | `    // ════════════════════════════════════════════════════════════════════...` | Comentario de línea explicativo: `════════════════════════════════════════════════════════════════════════`. |
| `69` | `    // FICHAS` | Comentario de línea explicativo: `FICHAS`. |
| `70` | `    // ════════════════════════════════════════════════════════════════════...` | Comentario de línea explicativo: `════════════════════════════════════════════════════════════════════════`. |
| `71` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `72` | `    public function guardarFicha(): void` | Declaración de método o función con su firma y parámetros: `public function guardarFicha(): void`. |
| `73` | `    {` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `74` | `        $this->requireAdmin();` | Instrucción de ejecución en el contexto del script: `$this->requireAdmin();`. |
| `75` | `        $model = new Ficha($this->db);` | Instrucción de ejecución en el contexto del script: `$model = new Ficha($this->db);`. |
| `76` | `        $id    = (int)($_POST['id_ficha'] ?? 0);` | Captura y sanitiza parámetros enviados por el cliente mediante petición HTTP: `$id    = (int)($_POST['id_ficha'] ?? 0);`. |
| `77` | `        $datos = [` | Instrucción de ejecución en el contexto del script: `$datos = [`. |
| `78` | `            'id_programa'    => (int)($_POST['id_programa']    ?? 0),` | Captura y sanitiza parámetros enviados por el cliente mediante petición HTTP: `'id_programa'    => (int)($_POST['id_programa']    ?? 0),`. |
| `79` | `            'numero_ficha'   => trim($_POST['numero_ficha']    ?? ''),` | Captura y sanitiza parámetros enviados por el cliente mediante petición HTTP: `'numero_ficha'   => trim($_POST['numero_ficha']    ?? ''),`. |
| `80` | `            'jornada'        => trim($_POST['jornada']         ?? 'Diurna'),` | Captura y sanitiza parámetros enviados por el cliente mediante petición HTTP: `'jornada'        => trim($_POST['jornada']         ?? 'Diurna'),`. |
| `81` | `            'num_aprendices' => (int)($_POST['num_aprendices'] ?? 0) ?: null,` | Captura y sanitiza parámetros enviados por el cliente mediante petición HTTP: `'num_aprendices' => (int)($_POST['num_aprendices'] ?? 0) ?: null,`. |
| `82` | `        ];` | Instrucción de ejecución en el contexto del script: `];`. |
| `83` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `84` | `        if (!$datos['id_programa'] \|\| empty($datos['numero_ficha'])) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (!$datos['id_programa'] \|\| empty($datos['numero_ficha'])) {`. |
| `85` | `            $_SESSION['alert'] = ['icon'=>'warning','title'=>'Datos incompl...` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección: `$_SESSION['alert'] = ['icon'=>'warning','title'=>'Datos incompletos','text'=>'Programa y número de ficha son obligatorios.'];`. |
| `86` | `            header("Location: ../views/dashboard/admin_fichas.php"); exit;` | Emite cabecera HTTP de redirección en el navegador: `header("Location: ../views/dashboard/admin_fichas.php"); exit;`. |
| `87` | `        }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `88` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `89` | `        if ($model->existeDuplicado($datos['numero_ficha'], $datos['id_prog...` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if ($model->existeDuplicado($datos['numero_ficha'], $datos['id_programa'], $id ?: null)) {`. |
| `90` | `            $_SESSION['alert'] = ['icon'=>'error','title'=>'Ficha duplicada...` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección: `$_SESSION['alert'] = ['icon'=>'error','title'=>'Ficha duplicada','text'=>'Ya existe una ficha con ese número en el mismo programa.'];`. |
| `91` | `            header("Location: ../views/dashboard/admin_fichas.php"); exit;` | Emite cabecera HTTP de redirección en el navegador: `header("Location: ../views/dashboard/admin_fichas.php"); exit;`. |
| `92` | `        }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `93` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `94` | `        if ($id) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if ($id) {`. |
| `95` | `            $model->actualizar($id, $datos);` | Instrucción de ejecución en el contexto del script: `$model->actualizar($id, $datos);`. |
| `96` | `            $_SESSION['alert'] = ['icon'=>'success','title'=>'Ficha actuali...` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección: `$_SESSION['alert'] = ['icon'=>'success','title'=>'Ficha actualizada','text'=>'Los datos de la ficha fueron actualizados.'];`. |
| `97` | `        } else {` | Bloque alternativo `else`: se ejecuta si ninguna condición previa resultó verdadera. |
| `98` | `            $model->crear($datos);` | Instrucción de ejecución en el contexto del script: `$model->crear($datos);`. |
| `99` | `            $_SESSION['alert'] = ['icon'=>'success','title'=>'Ficha creada'...` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección: `$_SESSION['alert'] = ['icon'=>'success','title'=>'Ficha creada','text'=>'La ficha fue registrada correctamente.'];`. |
| `100` | `        }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `101` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `102` | `        header("Location: ../views/dashboard/admin_fichas.php"); exit;` | Emite cabecera HTTP de redirección en el navegador: `header("Location: ../views/dashboard/admin_fichas.php"); exit;`. |
| `103` | `    }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `104` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `105` | `    public function eliminarFicha(): void` | Declaración de método o función con su firma y parámetros: `public function eliminarFicha(): void`. |
| `106` | `    {` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `107` | `        $this->requireAdmin();` | Instrucción de ejecución en el contexto del script: `$this->requireAdmin();`. |
| `108` | `        $id    = (int)($_POST['id_ficha'] ?? 0);` | Captura y sanitiza parámetros enviados por el cliente mediante petición HTTP: `$id    = (int)($_POST['id_ficha'] ?? 0);`. |
| `109` | `        $model = new Ficha($this->db);` | Instrucción de ejecución en el contexto del script: `$model = new Ficha($this->db);`. |
| `110` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `111` | `        if ($model->tieneAsignacionesActivas($id)) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if ($model->tieneAsignacionesActivas($id)) {`. |
| `112` | `            $_SESSION['alert'] = ['icon'=>'error','title'=>'No se puede eli...` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección: `$_SESSION['alert'] = ['icon'=>'error','title'=>'No se puede eliminar','text'=>'Esta ficha tiene asignaciones activas. Completa o cancela las asignaciones primero.'];`. |
| `113` | `        } else {` | Bloque alternativo `else`: se ejecuta si ninguna condición previa resultó verdadera. |
| `114` | `            $model->eliminar($id);` | Instrucción de ejecución en el contexto del script: `$model->eliminar($id);`. |
| `115` | `            $_SESSION['alert'] = ['icon'=>'success','title'=>'Ficha elimina...` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección: `$_SESSION['alert'] = ['icon'=>'success','title'=>'Ficha eliminada','text'=>'La ficha fue marcada como inactiva.'];`. |
| `116` | `        }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `117` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `118` | `        header("Location: ../views/dashboard/admin_fichas.php"); exit;` | Emite cabecera HTTP de redirección en el navegador: `header("Location: ../views/dashboard/admin_fichas.php"); exit;`. |
| `119` | `    }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `120` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `121` | `    // ════════════════════════════════════════════════════════════════════...` | Comentario de línea explicativo: `════════════════════════════════════════════════════════════════════════`. |
| `122` | `    // MÓDULOS` | Comentario de línea explicativo: `MÓDULOS`. |
| `123` | `    // ════════════════════════════════════════════════════════════════════...` | Comentario de línea explicativo: `════════════════════════════════════════════════════════════════════════`. |
| `124` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `125` | `    public function guardarModulo(): void` | Declaración de método o función con su firma y parámetros: `public function guardarModulo(): void`. |
| `126` | `    {` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `127` | `        $this->requireAdmin();` | Instrucción de ejecución en el contexto del script: `$this->requireAdmin();`. |
| `128` | `        $model = new Modulo($this->db);` | Instrucción de ejecución en el contexto del script: `$model = new Modulo($this->db);`. |
| `129` | `        $id    = (int)($_POST['id_modulo'] ?? 0);` | Captura y sanitiza parámetros enviados por el cliente mediante petición HTTP: `$id    = (int)($_POST['id_modulo'] ?? 0);`. |
| `130` | `        $datos = [` | Instrucción de ejecución en el contexto del script: `$datos = [`. |
| `131` | `            'nombre'      => trim($_POST['nombre']      ?? ''),` | Captura y sanitiza parámetros enviados por el cliente mediante petición HTTP: `'nombre'      => trim($_POST['nombre']      ?? ''),`. |
| `132` | `            'ubicacion'   => trim($_POST['ubicacion']   ?? ''),` | Captura y sanitiza parámetros enviados por el cliente mediante petición HTTP: `'ubicacion'   => trim($_POST['ubicacion']   ?? ''),`. |
| `133` | `            'capacidad'   => (int)($_POST['capacidad']  ?? 0) ?: null,` | Captura y sanitiza parámetros enviados por el cliente mediante petición HTTP: `'capacidad'   => (int)($_POST['capacidad']  ?? 0) ?: null,`. |
| `134` | `            'descripcion' => trim($_POST['descripcion'] ?? ''),` | Captura y sanitiza parámetros enviados por el cliente mediante petición HTTP: `'descripcion' => trim($_POST['descripcion'] ?? ''),`. |
| `135` | `        ];` | Instrucción de ejecución en el contexto del script: `];`. |
| `136` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `137` | `        if (empty($datos['nombre'])) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (empty($datos['nombre'])) {`. |
| `138` | `            $_SESSION['alert'] = ['icon'=>'warning','title'=>'Campo requeri...` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección: `$_SESSION['alert'] = ['icon'=>'warning','title'=>'Campo requerido','text'=>'El nombre del módulo es obligatorio.'];`. |
| `139` | `            header("Location: ../views/dashboard/admin_modulos.php"); exit;` | Emite cabecera HTTP de redirección en el navegador: `header("Location: ../views/dashboard/admin_modulos.php"); exit;`. |
| `140` | `        }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `141` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `142` | `        if ($id) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if ($id) {`. |
| `143` | `            $model->actualizar($id, $datos);` | Instrucción de ejecución en el contexto del script: `$model->actualizar($id, $datos);`. |
| `144` | `            $_SESSION['alert'] = ['icon'=>'success','title'=>'Módulo actual...` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección: `$_SESSION['alert'] = ['icon'=>'success','title'=>'Módulo actualizado','text'=>'Los datos del módulo fueron guardados.'];`. |
| `145` | `        } else {` | Bloque alternativo `else`: se ejecuta si ninguna condición previa resultó verdadera. |
| `146` | `            $model->crear($datos);` | Instrucción de ejecución en el contexto del script: `$model->crear($datos);`. |
| `147` | `            $_SESSION['alert'] = ['icon'=>'success','title'=>'Módulo creado...` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección: `$_SESSION['alert'] = ['icon'=>'success','title'=>'Módulo creado','text'=>'El módulo fue registrado en el inventario.'];`. |
| `148` | `        }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `149` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `150` | `        header("Location: ../views/dashboard/admin_modulos.php"); exit;` | Emite cabecera HTTP de redirección en el navegador: `header("Location: ../views/dashboard/admin_modulos.php"); exit;`. |
| `151` | `    }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `152` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `153` | `    public function asignarModulo(): void` | Declaración de método o función con su firma y parámetros: `public function asignarModulo(): void`. |
| `154` | `    {` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `155` | `        $this->requireAdmin();` | Instrucción de ejecución en el contexto del script: `$this->requireAdmin();`. |
| `156` | `        $model       = new Modulo($this->db);` | Instrucción de ejecución en el contexto del script: `$model       = new Modulo($this->db);`. |
| `157` | `        $idModulo    = (int)($_POST['id_modulo']   ?? 0);` | Captura y sanitiza parámetros enviados por el cliente mediante petición HTTP: `$idModulo    = (int)($_POST['id_modulo']   ?? 0);`. |
| `158` | `        $idFicha     = (int)($_POST['id_ficha']    ?? 0);` | Captura y sanitiza parámetros enviados por el cliente mediante petición HTTP: `$idFicha     = (int)($_POST['id_ficha']    ?? 0);`. |
| `159` | `        $fechaInicio = trim($_POST['fecha_inicio'] ?? '');` | Captura y sanitiza parámetros enviados por el cliente mediante petición HTTP: `$fechaInicio = trim($_POST['fecha_inicio'] ?? '');`. |
| `160` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `161` | `        if (!$idModulo \|\| !$idFicha \|\| empty($fechaInicio)) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (!$idModulo \|\| !$idFicha \|\| empty($fechaInicio)) {`. |
| `162` | `            $_SESSION['alert'] = ['icon'=>'warning','title'=>'Datos incompl...` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección: `$_SESSION['alert'] = ['icon'=>'warning','title'=>'Datos incompletos','text'=>'Selecciona el módulo, la ficha y la fecha de inicio.'];`. |
| `163` | `            header("Location: ../views/dashboard/admin_modulos.php"); exit;` | Emite cabecera HTTP de redirección en el navegador: `header("Location: ../views/dashboard/admin_modulos.php"); exit;`. |
| `164` | `        }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `165` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `166` | `        // Fecha fin = 2 años desde inicio (recurrente indefinido en la prá...` | Comentario de línea explicativo: `Fecha fin = 2 años desde inicio (recurrente indefinido en la práctica)`. |
| `167` | `        $fechaFin    = (new DateTime($fechaInicio))->modify('+2 years')->fo...` | Instrucción de ejecución en el contexto del script: `$fechaFin    = (new DateTime($fechaInicio))->modify('+2 years')->format('Y-m-d');`. |
| `168` | `        // Fecha límite evidencia = 23:59 del mismo día del turno (se usa a...` | Comentario de línea explicativo: `Fecha límite evidencia = 23:59 del mismo día del turno (se usa a nivel de turno, pero el campo requiere un valor)`. |
| `169` | `        $fechaLimite = $fechaInicio . ' 23:59:00';` | Instrucción de ejecución en el contexto del script: `$fechaLimite = $fechaInicio . ' 23:59:00';`. |
| `170` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `171` | `        if ($model->estaAsignadoEnPeriodo($idModulo, $fechaInicio, $fechaFi...` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if ($model->estaAsignadoEnPeriodo($idModulo, $fechaInicio, $fechaFin)) {`. |
| `172` | `            $_SESSION['alert'] = ['icon'=>'error','title'=>'Módulo ya asign...` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección: `$_SESSION['alert'] = ['icon'=>'error','title'=>'Módulo ya asignado','text'=>'Este módulo ya tiene una asignación activa. Cancélala antes de crear una nueva.'];`. |
| `173` | `            header("Location: ../views/dashboard/admin_modulos.php"); exit;` | Emite cabecera HTTP de redirección en el navegador: `header("Location: ../views/dashboard/admin_modulos.php"); exit;`. |
| `174` | `        }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `175` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `176` | `        if ($model->fichaYaTieneAsignacion($idFicha)) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if ($model->fichaYaTieneAsignacion($idFicha)) {`. |
| `177` | `            $_SESSION['alert'] = ['icon'=>'error','title'=>'Ficha ya tiene ...` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección: `$_SESSION['alert'] = ['icon'=>'error','title'=>'Ficha ya tiene módulo','text'=>'Esta ficha ya tiene un módulo asignado activo. Cada ficha solo puede limpiar un módulo a la vez. Cancela la asignación actual antes de crear una nueva.'];`. |
| `178` | `            header("Location: ../views/dashboard/admin_modulos.php"); exit;` | Emite cabecera HTTP de redirección en el navegador: `header("Location: ../views/dashboard/admin_modulos.php"); exit;`. |
| `179` | `        }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `180` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `181` | `        $idAsignacion = $model->crearAsignacion([` | Instrucción de ejecución en el contexto del script: `$idAsignacion = $model->crearAsignacion([`. |
| `182` | `            'id_modulo'               => $idModulo,` | Instrucción de ejecución en el contexto del script: `'id_modulo'               => $idModulo,`. |
| `183` | `            'id_ficha'                => $idFicha,` | Instrucción de ejecución en el contexto del script: `'id_ficha'                => $idFicha,`. |
| `184` | `            'fecha_inicio'            => $fechaInicio,` | Instrucción de ejecución en el contexto del script: `'fecha_inicio'            => $fechaInicio,`. |
| `185` | `            'fecha_fin'               => $fechaFin,` | Instrucción de ejecución en el contexto del script: `'fecha_fin'               => $fechaFin,`. |
| `186` | `            'fecha_limite_evidencia'  => $fechaLimite,` | Instrucción de ejecución en el contexto del script: `'fecha_limite_evidencia'  => $fechaLimite,`. |
| `187` | `        ]);` | Instrucción de ejecución en el contexto del script: `]);`. |
| `188` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `189` | `        if ($idAsignacion) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if ($idAsignacion) {`. |
| `190` | `            $diaSemana = (int)(new DateTime($fechaInicio))->format('w');` | Instrucción de ejecución en el contexto del script: `$diaSemana = (int)(new DateTime($fechaInicio))->format('w');`. |
| `191` | `            $this->db->prepare("UPDATE asignaciones SET dia_semana = :d WHE...` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$this->db->prepare("UPDATE asignaciones SET dia_semana = :d WHERE id_asignacion = :id")`. |
| `192` | `                     ->execute([':d' => $diaSemana, ':id' => $idAsignacion]);` | Ejecuta la sentencia SQL preparada vinculando los datos correspondientes: `->execute([':d' => $diaSemana, ':id' => $idAsignacion]);`. |
| `193` | `            (new Turno($this->db))->generarTurnosAsignacion($idAsignacion);` | Instrucción de ejecución en el contexto del script: `(new Turno($this->db))->generarTurnosAsignacion($idAsignacion);`. |
| `194` | `            $this->notificarVoceroAsignacion($idFicha, $idAsignacion);` | Instrucción de ejecución en el contexto del script: `$this->notificarVoceroAsignacion($idFicha, $idAsignacion);`. |
| `195` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `196` | `            $diasES = ['Domingo','Lunes','Martes','Miércoles','Jueves','Vie...` | Instrucción de ejecución en el contexto del script: `$diasES = ['Domingo','Lunes','Martes','Miércoles','Jueves','Viernes','Sábado'];`. |
| `197` | `            $diaNom = $diasES[$diaSemana];` | Instrucción de ejecución en el contexto del script: `$diaNom = $diasES[$diaSemana];`. |
| `198` | `            $_SESSION['alert'] = [` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección: `$_SESSION['alert'] = [`. |
| `199` | `                'icon'  => 'success',` | Instrucción de ejecución en el contexto del script: `'icon'  => 'success',`. |
| `200` | `                'title' => 'Módulo asignado',` | Instrucción de ejecución en el contexto del script: `'title' => 'Módulo asignado',`. |
| `201` | `                'text'  => "La limpieza se programó todos los {$diaNom}s a ...` | Instrucción de ejecución en el contexto del script: `'text'  => "La limpieza se programó todos los {$diaNom}s a partir del " . date('d/m/Y', strtotime($fechaInicio)) . '. Se notificó al vocero.',`. |
| `202` | `            ];` | Instrucción de ejecución en el contexto del script: `];`. |
| `203` | `        } else {` | Bloque alternativo `else`: se ejecuta si ninguna condición previa resultó verdadera. |
| `204` | `            $_SESSION['alert'] = ['icon'=>'error','title'=>'Error','text'=>...` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección: `$_SESSION['alert'] = ['icon'=>'error','title'=>'Error','text'=>'No se pudo registrar la asignación.'];`. |
| `205` | `        }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `206` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `207` | `        header("Location: ../views/dashboard/admin_modulos.php"); exit;` | Emite cabecera HTTP de redirección en el navegador: `header("Location: ../views/dashboard/admin_modulos.php"); exit;`. |
| `208` | `    }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `209` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `210` | `    public function editarAsignacion(): void` | Declaración de método o función con su firma y parámetros: `public function editarAsignacion(): void`. |
| `211` | `    {` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `212` | `        $this->requireAdmin();` | Instrucción de ejecución en el contexto del script: `$this->requireAdmin();`. |
| `213` | `        $model        = new Modulo($this->db);` | Instrucción de ejecución en el contexto del script: `$model        = new Modulo($this->db);`. |
| `214` | `        $idAsignacion = (int)($_POST['id_asignacion'] ?? 0);` | Captura y sanitiza parámetros enviados por el cliente mediante petición HTTP: `$idAsignacion = (int)($_POST['id_asignacion'] ?? 0);`. |
| `215` | `        $idFicha      = (int)($_POST['id_ficha']      ?? 0);` | Captura y sanitiza parámetros enviados por el cliente mediante petición HTTP: `$idFicha      = (int)($_POST['id_ficha']      ?? 0);`. |
| `216` | `        $fechaInicio  = trim($_POST['fecha_inicio']   ?? '');` | Captura y sanitiza parámetros enviados por el cliente mediante petición HTTP: `$fechaInicio  = trim($_POST['fecha_inicio']   ?? '');`. |
| `217` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `218` | `        if (!$idAsignacion \|\| !$idFicha \|\| empty($fechaInicio)) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (!$idAsignacion \|\| !$idFicha \|\| empty($fechaInicio)) {`. |
| `219` | `            $_SESSION['alert'] = ['icon'=>'warning','title'=>'Datos incompl...` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección: `$_SESSION['alert'] = ['icon'=>'warning','title'=>'Datos incompletos','text'=>'La ficha y la fecha de inicio son obligatorias.'];`. |
| `220` | `            header("Location: ../views/dashboard/admin_modulos.php"); exit;` | Emite cabecera HTTP de redirección en el navegador: `header("Location: ../views/dashboard/admin_modulos.php"); exit;`. |
| `221` | `        }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `222` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `223` | `        $stmtA = $this->db->prepare("SELECT id_modulo FROM asignaciones WHE...` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmtA = $this->db->prepare("SELECT id_modulo FROM asignaciones WHERE id_asignacion = :id LIMIT 1");`. |
| `224` | `        $stmtA->execute([':id' => $idAsignacion]);` | Ejecuta la sentencia SQL preparada vinculando los datos correspondientes: `$stmtA->execute([':id' => $idAsignacion]);`. |
| `225` | `        $asigActual = $stmtA->fetch(PDO::FETCH_ASSOC);` | Recupera una única fila o registro resultante de la consulta. |
| `226` | `        if (!$asigActual) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (!$asigActual) {`. |
| `227` | `            $_SESSION['alert'] = ['icon'=>'error','title'=>'No encontrada',...` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección: `$_SESSION['alert'] = ['icon'=>'error','title'=>'No encontrada','text'=>'Asignación no encontrada.'];`. |
| `228` | `            header("Location: ../views/dashboard/admin_modulos.php"); exit;` | Emite cabecera HTTP de redirección en el navegador: `header("Location: ../views/dashboard/admin_modulos.php"); exit;`. |
| `229` | `        }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `230` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `231` | `        $fechaFin    = (new DateTime($fechaInicio))->modify('+2 years')->fo...` | Instrucción de ejecución en el contexto del script: `$fechaFin    = (new DateTime($fechaInicio))->modify('+2 years')->format('Y-m-d');`. |
| `232` | `        $fechaLimite = $fechaInicio . ' 23:59:00';` | Instrucción de ejecución en el contexto del script: `$fechaLimite = $fechaInicio . ' 23:59:00';`. |
| `233` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `234` | `        if ($model->estaAsignadoEnPeriodo((int)$asigActual['id_modulo'], $f...` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if ($model->estaAsignadoEnPeriodo((int)$asigActual['id_modulo'], $fechaInicio, $fechaFin, $idAsignacion)) {`. |
| `235` | `            $_SESSION['alert'] = ['icon'=>'error','title'=>'Conflicto','tex...` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección: `$_SESSION['alert'] = ['icon'=>'error','title'=>'Conflicto','text'=>'Ese módulo ya tiene otra asignación activa que se solapa con esa fecha.'];`. |
| `236` | `            header("Location: ../views/dashboard/admin_modulos.php"); exit;` | Emite cabecera HTTP de redirección en el navegador: `header("Location: ../views/dashboard/admin_modulos.php"); exit;`. |
| `237` | `        }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `238` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `239` | `        if ($model->fichaYaTieneAsignacion($idFicha, $idAsignacion)) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if ($model->fichaYaTieneAsignacion($idFicha, $idAsignacion)) {`. |
| `240` | `            $_SESSION['alert'] = ['icon'=>'error','title'=>'Ficha ya tiene ...` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección: `$_SESSION['alert'] = ['icon'=>'error','title'=>'Ficha ya tiene módulo','text'=>'La ficha seleccionada ya tiene un módulo asignado activo.'];`. |
| `241` | `            header("Location: ../views/dashboard/admin_modulos.php"); exit;` | Emite cabecera HTTP de redirección en el navegador: `header("Location: ../views/dashboard/admin_modulos.php"); exit;`. |
| `242` | `        }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `243` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `244` | `        $diaSemana = (int)(new DateTime($fechaInicio))->format('w');` | Instrucción de ejecución en el contexto del script: `$diaSemana = (int)(new DateTime($fechaInicio))->format('w');`. |
| `245` | `        $stmt = $this->db->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmt = $this->db->prepare(`. |
| `246` | `            "UPDATE asignaciones` | Instrucción de ejecución en el contexto del script: `"UPDATE asignaciones`. |
| `247` | `             SET id_ficha = :ficha, fecha_inicio = :inicio, fecha_fin = :fin,` | Instrucción de ejecución en el contexto del script: `SET id_ficha = :ficha, fecha_inicio = :inicio, fecha_fin = :fin,`. |
| `248` | `                 fecha_limite_evidencia = :limite, dia_semana = :dia` | Instrucción de ejecución en el contexto del script: `fecha_limite_evidencia = :limite, dia_semana = :dia`. |
| `249` | `             WHERE id_asignacion = :id"` | Instrucción de ejecución en el contexto del script: `WHERE id_asignacion = :id"`. |
| `250` | `        );` | Instrucción de ejecución en el contexto del script: `);`. |
| `251` | `        $ok = $stmt->execute([` | Ejecuta la sentencia SQL preparada vinculando los datos correspondientes: `$ok = $stmt->execute([`. |
| `252` | `            ':ficha'  => $idFicha,` | Instrucción de ejecución en el contexto del script: `':ficha'  => $idFicha,`. |
| `253` | `            ':inicio' => $fechaInicio,` | Instrucción de ejecución en el contexto del script: `':inicio' => $fechaInicio,`. |
| `254` | `            ':fin'    => $fechaFin,` | Instrucción de ejecución en el contexto del script: `':fin'    => $fechaFin,`. |
| `255` | `            ':limite' => $fechaLimite,` | Instrucción de ejecución en el contexto del script: `':limite' => $fechaLimite,`. |
| `256` | `            ':dia'    => $diaSemana,` | Instrucción de ejecución en el contexto del script: `':dia'    => $diaSemana,`. |
| `257` | `            ':id'     => $idAsignacion,` | Instrucción de ejecución en el contexto del script: `':id'     => $idAsignacion,`. |
| `258` | `        ]);` | Instrucción de ejecución en el contexto del script: `]);`. |
| `259` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `260` | `        if ($ok) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if ($ok) {`. |
| `261` | `            $this->db->prepare("DELETE FROM turnos WHERE id_asignacion = :id")` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$this->db->prepare("DELETE FROM turnos WHERE id_asignacion = :id")`. |
| `262` | `                     ->execute([':id' => $idAsignacion]);` | Ejecuta la sentencia SQL preparada vinculando los datos correspondientes: `->execute([':id' => $idAsignacion]);`. |
| `263` | `            (new Turno($this->db))->generarTurnosAsignacion($idAsignacion);` | Instrucción de ejecución en el contexto del script: `(new Turno($this->db))->generarTurnosAsignacion($idAsignacion);`. |
| `264` | `            (new Turno($this->db))->asignarGruposRotacion($idAsignacion);` | Instrucción de ejecución en el contexto del script: `(new Turno($this->db))->asignarGruposRotacion($idAsignacion);`. |
| `265` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `266` | `            $diasES = ['Domingo','Lunes','Martes','Miércoles','Jueves','Vie...` | Instrucción de ejecución en el contexto del script: `$diasES = ['Domingo','Lunes','Martes','Miércoles','Jueves','Viernes','Sábado'];`. |
| `267` | `            $_SESSION['alert'] = [` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección: `$_SESSION['alert'] = [`. |
| `268` | `                'icon'  => 'success',` | Instrucción de ejecución en el contexto del script: `'icon'  => 'success',`. |
| `269` | `                'title' => 'Asignación actualizada',` | Instrucción de ejecución en el contexto del script: `'title' => 'Asignación actualizada',`. |
| `270` | `                'text'  => 'Los turnos se regeneraron. La limpieza será cad...` | Instrucción de ejecución en el contexto del script: `'text'  => 'Los turnos se regeneraron. La limpieza será cada ' . $diasES[$diaSemana] . ' desde el ' . date('d/m/Y', strtotime($fechaInicio)) . '.',`. |
| `271` | `            ];` | Instrucción de ejecución en el contexto del script: `];`. |
| `272` | `        } else {` | Bloque alternativo `else`: se ejecuta si ninguna condición previa resultó verdadera. |
| `273` | `            $_SESSION['alert'] = ['icon'=>'error','title'=>'Error','text'=>...` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección: `$_SESSION['alert'] = ['icon'=>'error','title'=>'Error','text'=>'No se pudo actualizar la asignación.'];`. |
| `274` | `        }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `275` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `276` | `        header("Location: ../views/dashboard/admin_modulos.php"); exit;` | Emite cabecera HTTP de redirección en el navegador: `header("Location: ../views/dashboard/admin_modulos.php"); exit;`. |
| `277` | `    }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `278` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `279` | `    public function cancelarAsignacion(): void` | Declaración de método o función con su firma y parámetros: `public function cancelarAsignacion(): void`. |
| `280` | `    {` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `281` | `        $this->requireAdmin();` | Instrucción de ejecución en el contexto del script: `$this->requireAdmin();`. |
| `282` | `        $idAsignacion = (int)($_POST['id_asignacion'] ?? 0);` | Captura y sanitiza parámetros enviados por el cliente mediante petición HTTP: `$idAsignacion = (int)($_POST['id_asignacion'] ?? 0);`. |
| `283` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `284` | `        // Verificar que no tenga evidencias` | Comentario de línea explicativo: `Verificar que no tenga evidencias`. |
| `285` | `        $stmtE = $this->db->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmtE = $this->db->prepare(`. |
| `286` | `            "SELECT COUNT(*) FROM evidencias e` | Instrucción de ejecución en el contexto del script: `"SELECT COUNT(*) FROM evidencias e`. |
| `287` | `             JOIN grupos g ON g.id_grupo = e.id_grupo` | Instrucción de ejecución en el contexto del script: `JOIN grupos g ON g.id_grupo = e.id_grupo`. |
| `288` | `             WHERE g.id_asignacion = :id"` | Instrucción de ejecución en el contexto del script: `WHERE g.id_asignacion = :id"`. |
| `289` | `        );` | Instrucción de ejecución en el contexto del script: `);`. |
| `290` | `        $stmtE->execute([':id' => $idAsignacion]);` | Ejecuta la sentencia SQL preparada vinculando los datos correspondientes: `$stmtE->execute([':id' => $idAsignacion]);`. |
| `291` | `        if ((int)$stmtE->fetchColumn() > 0) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if ((int)$stmtE->fetchColumn() > 0) {`. |
| `292` | `            $_SESSION['alert'] = ['icon'=>'error','title'=>'No se puede can...` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección: `$_SESSION['alert'] = ['icon'=>'error','title'=>'No se puede cancelar','text'=>'Esta asignación ya tiene evidencias registradas.'];`. |
| `293` | `            header("Location: ../views/dashboard/admin_modulos.php"); exit;` | Emite cabecera HTTP de redirección en el navegador: `header("Location: ../views/dashboard/admin_modulos.php"); exit;`. |
| `294` | `        }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `295` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `296` | `        $this->db->prepare("UPDATE asignaciones SET estado = 'Cancelada' WH...` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$this->db->prepare("UPDATE asignaciones SET estado = 'Cancelada' WHERE id_asignacion = :id")`. |
| `297` | `                 ->execute([':id' => $idAsignacion]);` | Ejecuta la sentencia SQL preparada vinculando los datos correspondientes: `->execute([':id' => $idAsignacion]);`. |
| `298` | `        $this->db->prepare("DELETE FROM turnos WHERE id_asignacion = :id")` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$this->db->prepare("DELETE FROM turnos WHERE id_asignacion = :id")`. |
| `299` | `                 ->execute([':id' => $idAsignacion]);` | Ejecuta la sentencia SQL preparada vinculando los datos correspondientes: `->execute([':id' => $idAsignacion]);`. |
| `300` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `301` | `        $_SESSION['alert'] = ['icon'=>'success','title'=>'Asignación cancel...` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección: `$_SESSION['alert'] = ['icon'=>'success','title'=>'Asignación cancelada','text'=>'La asignación fue cancelada y sus turnos eliminados.'];`. |
| `302` | `        header("Location: ../views/dashboard/admin_modulos.php"); exit;` | Emite cabecera HTTP de redirección en el navegador: `header("Location: ../views/dashboard/admin_modulos.php"); exit;`. |
| `303` | `    }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `304` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `305` | `    // ════════════════════════════════════════════════════════════════════...` | Comentario de línea explicativo: `════════════════════════════════════════════════════════════════════════`. |
| `306` | `    // VOCEROS / USUARIOS` | Comentario de línea explicativo: `VOCEROS / USUARIOS`. |
| `307` | `    // ════════════════════════════════════════════════════════════════════...` | Comentario de línea explicativo: `════════════════════════════════════════════════════════════════════════`. |
| `308` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `309` | `    public function reenviarCredenciales(): void` | Declaración de método o función con su firma y parámetros: `public function reenviarCredenciales(): void`. |
| `310` | `    {` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `311` | `        $this->requireAdmin();` | Instrucción de ejecución en el contexto del script: `$this->requireAdmin();`. |
| `312` | `        $idVocero = (int)($_POST['id_vocero'] ?? 0);` | Captura y sanitiza parámetros enviados por el cliente mediante petición HTTP: `$idVocero = (int)($_POST['id_vocero'] ?? 0);`. |
| `313` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `314` | `        $stmt = $this->db->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmt = $this->db->prepare(`. |
| `315` | `            "SELECT v.*, u.id_usuario FROM voceros v` | Instrucción de ejecución en el contexto del script: `"SELECT v.*, u.id_usuario FROM voceros v`. |
| `316` | `             JOIN usuarios u ON u.id_usuario = v.id_usuario` | Instrucción de ejecución en el contexto del script: `JOIN usuarios u ON u.id_usuario = v.id_usuario`. |
| `317` | `             WHERE v.id_vocero = :id LIMIT 1"` | Instrucción de ejecución en el contexto del script: `WHERE v.id_vocero = :id LIMIT 1"`. |
| `318` | `        );` | Instrucción de ejecución en el contexto del script: `);`. |
| `319` | `        $stmt->execute([':id' => $idVocero]);` | Ejecuta la sentencia SQL preparada vinculando los datos correspondientes: `$stmt->execute([':id' => $idVocero]);`. |
| `320` | `        $vocero = $stmt->fetch(PDO::FETCH_ASSOC);` | Recupera una única fila o registro resultante de la consulta. |
| `321` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `322` | `        if (!$vocero) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (!$vocero) {`. |
| `323` | `            $_SESSION['alert'] = ['icon'=>'error','title'=>'No encontrado',...` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección: `$_SESSION['alert'] = ['icon'=>'error','title'=>'No encontrado','text'=>'Vocero no encontrado.'];`. |
| `324` | `            header("Location: ../views/dashboard/admin_voceros.php"); exit;` | Emite cabecera HTTP de redirección en el navegador: `header("Location: ../views/dashboard/admin_voceros.php"); exit;`. |
| `325` | `        }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `326` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `327` | `        // Generar nueva contraseña temporal` | Comentario de línea explicativo: `Generar nueva contraseña temporal`. |
| `328` | `        $nuevaPassword = $this->generarPasswordTemporal();` | Instrucción de ejecución en el contexto del script: `$nuevaPassword = $this->generarPasswordTemporal();`. |
| `329` | `        $modelUser     = new Usuario($this->db);` | Instrucción de ejecución en el contexto del script: `$modelUser     = new Usuario($this->db);`. |
| `330` | `        $modelUser->actualizarPassword($vocero['id_usuario'], password_hash...` | Instrucción de ejecución en el contexto del script: `$modelUser->actualizarPassword($vocero['id_usuario'], password_hash($nuevaPassword, PASSWORD_DEFAULT));`. |
| `331` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `332` | `        // Marcar como primer acceso nuevamente` | Comentario de línea explicativo: `Marcar como primer acceso nuevamente`. |
| `333` | `        $this->db->prepare("UPDATE usuarios SET primer_acceso = 1 WHERE id_...` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$this->db->prepare("UPDATE usuarios SET primer_acceso = 1 WHERE id_usuario = :id")`. |
| `334` | `                 ->execute([':id' => $vocero['id_usuario']]);` | Ejecuta la sentencia SQL preparada vinculando los datos correspondientes: `->execute([':id' => $vocero['id_usuario']]);`. |
| `335` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `336` | `        // En producción aquí se enviaría el correo con PHPMailer/SMTP` | Comentario de línea explicativo: `En producción aquí se enviaría el correo con PHPMailer/SMTP`. |
| `337` | `        // Por ahora almacenamos en sesión para mostrar en pantalla` | Comentario de línea explicativo: `Por ahora almacenamos en sesión para mostrar en pantalla`. |
| `338` | `        $_SESSION['alert'] = [` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección: `$_SESSION['alert'] = [`. |
| `339` | `            'icon'  => 'success',` | Instrucción de ejecución en el contexto del script: `'icon'  => 'success',`. |
| `340` | `            'title' => 'Credenciales reenviadas',` | Instrucción de ejecución en el contexto del script: `'title' => 'Credenciales reenviadas',`. |
| `341` | `            'text'  => "Se generó nueva contraseña temporal para {$vocero['...` | Instrucción de ejecución en el contexto del script: `'text'  => "Se generó nueva contraseña temporal para {$vocero['nombres']} {$vocero['apellidos']}. En producción se enviaría al correo {$vocero['correo']}."`. |
| `342` | `        ];` | Instrucción de ejecución en el contexto del script: `];`. |
| `343` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `344` | `        header("Location: ../views/dashboard/admin_voceros.php"); exit;` | Emite cabecera HTTP de redirección en el navegador: `header("Location: ../views/dashboard/admin_voceros.php"); exit;`. |
| `345` | `    }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `346` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `347` | `    // ── ACTIVAR APRENDIZ COMO VOCERO ───────────────────────────────────────` | Comentario de línea explicativo: `── ACTIVAR APRENDIZ COMO VOCERO ───────────────────────────────────────`. |
| `348` | `    public function activarVocero(): void` | Declaración de método o función con su firma y parámetros: `public function activarVocero(): void`. |
| `349` | `    {` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `350` | `        $this->requireAdmin();` | Instrucción de ejecución en el contexto del script: `$this->requireAdmin();`. |
| `351` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `352` | `        $idAprendiz = (int)($_POST['id_aprendiz'] ?? 0);` | Captura y sanitiza parámetros enviados por el cliente mediante petición HTTP: `$idAprendiz = (int)($_POST['id_aprendiz'] ?? 0);`. |
| `353` | `        $idFicha    = (int)($_POST['id_ficha']    ?? 0);` | Captura y sanitiza parámetros enviados por el cliente mediante petición HTTP: `$idFicha    = (int)($_POST['id_ficha']    ?? 0);`. |
| `354` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `355` | `        if (!$idAprendiz \|\| !$idFicha) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (!$idAprendiz \|\| !$idFicha) {`. |
| `356` | `            $_SESSION['alert'] = ['icon'=>'warning','title'=>'Datos incompl...` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección: `$_SESSION['alert'] = ['icon'=>'warning','title'=>'Datos incompletos','text'=>'Faltan datos.'];`. |
| `357` | `            header("Location: ../views/dashboard/admin_aprendices.php?ficha...` | Emite cabecera HTTP de redirección en el navegador: `header("Location: ../views/dashboard/admin_aprendices.php?ficha={$idFicha}"); exit;`. |
| `358` | `        }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `359` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `360` | `        // Verificar que no haya ya 2 voceros activos` | Comentario de línea explicativo: `Verificar que no haya ya 2 voceros activos`. |
| `361` | `        $stmtChk = $this->db->prepare("SELECT COUNT(*) FROM voceros WHERE i...` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmtChk = $this->db->prepare("SELECT COUNT(*) FROM voceros WHERE id_ficha = :fic AND activo = 1");`. |
| `362` | `        $stmtChk->execute([':fic' => $idFicha]);` | Ejecuta la sentencia SQL preparada vinculando los datos correspondientes: `$stmtChk->execute([':fic' => $idFicha]);`. |
| `363` | `        if ((int)$stmtChk->fetchColumn() >= 2) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if ((int)$stmtChk->fetchColumn() >= 2) {`. |
| `364` | `            $_SESSION['alert'] = ['icon'=>'error','title'=>'Límite alcanzad...` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección: `$_SESSION['alert'] = ['icon'=>'error','title'=>'Límite alcanzado','text'=>'Esta ficha ya tiene 2 voceros activos. Desactiva uno antes de asignar otro.'];`. |
| `365` | `            header("Location: ../views/dashboard/admin_aprendices.php?ficha...` | Emite cabecera HTTP de redirección en el navegador: `header("Location: ../views/dashboard/admin_aprendices.php?ficha={$idFicha}"); exit;`. |
| `366` | `        }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `367` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `368` | `        // Datos del aprendiz` | Comentario de línea explicativo: `Datos del aprendiz`. |
| `369` | `        $stmtAp = $this->db->prepare("SELECT * FROM aprendices WHERE id_apr...` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmtAp = $this->db->prepare("SELECT * FROM aprendices WHERE id_aprendiz = :id AND activo = 1 LIMIT 1");`. |
| `370` | `        $stmtAp->execute([':id' => $idAprendiz]);` | Ejecuta la sentencia SQL preparada vinculando los datos correspondientes: `$stmtAp->execute([':id' => $idAprendiz]);`. |
| `371` | `        $aprendiz = $stmtAp->fetch(PDO::FETCH_ASSOC);` | Recupera una única fila o registro resultante de la consulta. |
| `372` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `373` | `        if (!$aprendiz) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (!$aprendiz) {`. |
| `374` | `            $_SESSION['alert'] = ['icon'=>'error','title'=>'No encontrado',...` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección: `$_SESSION['alert'] = ['icon'=>'error','title'=>'No encontrado','text'=>'Aprendiz no encontrado.'];`. |
| `375` | `            header("Location: ../views/dashboard/admin_aprendices.php?ficha...` | Emite cabecera HTTP de redirección en el navegador: `header("Location: ../views/dashboard/admin_aprendices.php?ficha={$idFicha}"); exit;`. |
| `376` | `        }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `377` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `378` | `        // Correo: documento@sena.edu.co (convención SENA)` | Comentario de línea explicativo: `Correo: documento@sena.edu.co (convención SENA)`. |
| `379` | `        $correo           = ($aprendiz['documento'] ?? uniqid()) . '@sena.e...` | Instrucción de ejecución en el contexto del script: `$correo           = ($aprendiz['documento'] ?? uniqid()) . '@sena.edu.co';`. |
| `380` | `        $passwordTemporal = $this->generarPasswordTemporal();` | Instrucción de ejecución en el contexto del script: `$passwordTemporal = $this->generarPasswordTemporal();`. |
| `381` | `        $modelUser        = new Usuario($this->db);` | Instrucción de ejecución en el contexto del script: `$modelUser        = new Usuario($this->db);`. |
| `382` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `383` | `        // Crear o reutilizar usuario` | Comentario de línea explicativo: `Crear o reutilizar usuario`. |
| `384` | `        if ($modelUser->existeCorreo($correo)) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if ($modelUser->existeCorreo($correo)) {`. |
| `385` | `            $stmtU = $this->db->prepare("SELECT id_usuario FROM usuarios WH...` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmtU = $this->db->prepare("SELECT id_usuario FROM usuarios WHERE correo = :c LIMIT 1");`. |
| `386` | `            $stmtU->execute([':c' => $correo]);` | Ejecuta la sentencia SQL preparada vinculando los datos correspondientes: `$stmtU->execute([':c' => $correo]);`. |
| `387` | `            $idUsuario = (int)$stmtU->fetchColumn();` | Obtiene el valor de una columna única de la primera fila resultante. |
| `388` | `            // Reactivar usuario y actualizar contraseña temporal` | Comentario de línea explicativo: `Reactivar usuario y actualizar contraseña temporal`. |
| `389` | `            $this->db->prepare("UPDATE usuarios SET activo = 1, id_rol = 2,...` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$this->db->prepare("UPDATE usuarios SET activo = 1, id_rol = 2, primer_acceso = 1 WHERE id_usuario = :id")`. |
| `390` | `                     ->execute([':id' => $idUsuario]);` | Ejecuta la sentencia SQL preparada vinculando los datos correspondientes: `->execute([':id' => $idUsuario]);`. |
| `391` | `            $modelUser->actualizarPassword($idUsuario, password_hash($passw...` | Instrucción de ejecución en el contexto del script: `$modelUser->actualizarPassword($idUsuario, password_hash($passwordTemporal, PASSWORD_DEFAULT));`. |
| `392` | `            // Resetear primer_acceso a 1 para forzar cambio` | Comentario de línea explicativo: `Resetear primer_acceso a 1 para forzar cambio`. |
| `393` | `            $this->db->prepare("UPDATE usuarios SET primer_acceso = 1 WHERE...` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$this->db->prepare("UPDATE usuarios SET primer_acceso = 1 WHERE id_usuario = :id")`. |
| `394` | `                     ->execute([':id' => $idUsuario]);` | Ejecuta la sentencia SQL preparada vinculando los datos correspondientes: `->execute([':id' => $idUsuario]);`. |
| `395` | `        } else {` | Bloque alternativo `else`: se ejecuta si ninguna condición previa resultó verdadera. |
| `396` | `            $idUsuario = $modelUser->crearVocero([` | Instrucción de ejecución en el contexto del script: `$idUsuario = $modelUser->crearVocero([`. |
| `397` | `                'nombres'   => $aprendiz['nombres'],` | Instrucción de ejecución en el contexto del script: `'nombres'   => $aprendiz['nombres'],`. |
| `398` | `                'apellidos' => $aprendiz['apellidos'],` | Instrucción de ejecución en el contexto del script: `'apellidos' => $aprendiz['apellidos'],`. |
| `399` | `                'documento' => $aprendiz['documento'],` | Instrucción de ejecución en el contexto del script: `'documento' => $aprendiz['documento'],`. |
| `400` | `                'celular'   => null,` | Instrucción de ejecución en el contexto del script: `'celular'   => null,`. |
| `401` | `                'correo'    => $correo,` | Instrucción de ejecución en el contexto del script: `'correo'    => $correo,`. |
| `402` | `                'password'  => password_hash($passwordTemporal, PASSWORD_DE...` | Instrucción de ejecución en el contexto del script: `'password'  => password_hash($passwordTemporal, PASSWORD_DEFAULT),`. |
| `403` | `            ]);` | Instrucción de ejecución en el contexto del script: `]);`. |
| `404` | `        }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `405` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `406` | `        if (!$idUsuario) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (!$idUsuario) {`. |
| `407` | `            $_SESSION['alert'] = ['icon'=>'error','title'=>'Error','text'=>...` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección: `$_SESSION['alert'] = ['icon'=>'error','title'=>'Error','text'=>'No se pudo crear el usuario.'];`. |
| `408` | `            header("Location: ../views/dashboard/admin_aprendices.php?ficha...` | Emite cabecera HTTP de redirección en el navegador: `header("Location: ../views/dashboard/admin_aprendices.php?ficha={$idFicha}"); exit;`. |
| `409` | `        }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `410` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `411` | `        // Verificar si ya existe registro en voceros (inactivo) para este ...` | Comentario de línea explicativo: `Verificar si ya existe registro en voceros (inactivo) para este aprendiz/ficha`. |
| `412` | `        $stmtVEx = $this->db->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmtVEx = $this->db->prepare(`. |
| `413` | `            "SELECT id_vocero FROM voceros WHERE id_usuario = :idu AND id_f...` | Instrucción de ejecución en el contexto del script: `"SELECT id_vocero FROM voceros WHERE id_usuario = :idu AND id_ficha = :fic LIMIT 1"`. |
| `414` | `        );` | Instrucción de ejecución en el contexto del script: `);`. |
| `415` | `        $stmtVEx->execute([':idu' => $idUsuario, ':fic' => $idFicha]);` | Ejecuta la sentencia SQL preparada vinculando los datos correspondientes: `$stmtVEx->execute([':idu' => $idUsuario, ':fic' => $idFicha]);`. |
| `416` | `        $voceroExistente = $stmtVEx->fetch(PDO::FETCH_ASSOC);` | Recupera una única fila o registro resultante de la consulta. |
| `417` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `418` | `        if ($voceroExistente) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if ($voceroExistente) {`. |
| `419` | `            // Reactivar` | Comentario de línea explicativo: `Reactivar`. |
| `420` | `            $this->db->prepare("UPDATE voceros SET activo = 1 WHERE id_voce...` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$this->db->prepare("UPDATE voceros SET activo = 1 WHERE id_vocero = :id")`. |
| `421` | `                     ->execute([':id' => $voceroExistente['id_vocero']]);` | Ejecuta la sentencia SQL preparada vinculando los datos correspondientes: `->execute([':id' => $voceroExistente['id_vocero']]);`. |
| `422` | `        } else {` | Bloque alternativo `else`: se ejecuta si ninguna condición previa resultó verdadera. |
| `423` | `            // Crear nuevo` | Comentario de línea explicativo: `Crear nuevo`. |
| `424` | `            $this->db->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$this->db->prepare(`. |
| `425` | `                "INSERT INTO voceros (id_usuario, id_ficha, nombres, apelli...` | Instrucción de ejecución en el contexto del script: `"INSERT INTO voceros (id_usuario, id_ficha, nombres, apellidos, documento, correo, activo)`. |
| `426` | `                 VALUES (:idu, :fic, :nom, :ape, :doc, :cor, 1)"` | Instrucción de ejecución en el contexto del script: `VALUES (:idu, :fic, :nom, :ape, :doc, :cor, 1)"`. |
| `427` | `            )->execute([` | Ejecuta la sentencia SQL preparada vinculando los datos correspondientes: `)->execute([`. |
| `428` | `                ':idu' => $idUsuario, ':fic' => $idFicha,` | Instrucción de ejecución en el contexto del script: `':idu' => $idUsuario, ':fic' => $idFicha,`. |
| `429` | `                ':nom' => $aprendiz['nombres'],  ':ape' => $aprendiz['apell...` | Instrucción de ejecución en el contexto del script: `':nom' => $aprendiz['nombres'],  ':ape' => $aprendiz['apellidos'],`. |
| `430` | `                ':doc' => $aprendiz['documento'], ':cor' => $correo,` | Instrucción de ejecución en el contexto del script: `':doc' => $aprendiz['documento'], ':cor' => $correo,`. |
| `431` | `            ]);` | Instrucción de ejecución en el contexto del script: `]);`. |
| `432` | `        }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `433` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `434` | `        // Notificación interna con credenciales` | Comentario de línea explicativo: `Notificación interna con credenciales`. |
| `435` | `        (new Notificacion($this->db))->crear([` | Instrucción de ejecución en el contexto del script: `(new Notificacion($this->db))->crear([`. |
| `436` | `            'id_usuario'    => $idUsuario,` | Instrucción de ejecución en el contexto del script: `'id_usuario'    => $idUsuario,`. |
| `437` | `            'id_asignacion' => null,` | Instrucción de ejecución en el contexto del script: `'id_asignacion' => null,`. |
| `438` | `            'tipo'          => 'credenciales',` | Instrucción de ejecución en el contexto del script: `'tipo'          => 'credenciales',`. |
| `439` | `            'titulo'        => 'Cuenta de Vocero activada',` | Instrucción de ejecución en el contexto del script: `'titulo'        => 'Cuenta de Vocero activada',`. |
| `440` | `            'mensaje'       => "Tu cuenta fue activada. Correo: {$correo} \...` | Instrucción de ejecución en el contexto del script: `'mensaje'       => "Tu cuenta fue activada. Correo: {$correo} \| Contraseña temporal: {$passwordTemporal} — Debes cambiarla en tu primer inicio de sesión.",`. |
| `441` | `        ]);` | Instrucción de ejecución en el contexto del script: `]);`. |
| `442` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `443` | `        $_SESSION['alert'] = [` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección: `$_SESSION['alert'] = [`. |
| `444` | `            'icon'  => 'success',` | Instrucción de ejecución en el contexto del script: `'icon'  => 'success',`. |
| `445` | `            'title' => '¡Vocero activado!',` | Instrucción de ejecución en el contexto del script: `'title' => '¡Vocero activado!',`. |
| `446` | `            'text'  => "{$aprendiz['nombres']} {$aprendiz['apellidos']} aho...` | Instrucción de ejecución en el contexto del script: `'text'  => "{$aprendiz['nombres']} {$aprendiz['apellidos']} ahora es vocero.\n"`. |
| `447` | `                     . "Correo: {$correo} \| Contraseña temporal: {$passwor...` | Instrucción de ejecución en el contexto del script: `. "Correo: {$correo} \| Contraseña temporal: {$passwordTemporal}",`. |
| `448` | `        ];` | Instrucción de ejecución en el contexto del script: `];`. |
| `449` | `        header("Location: ../views/dashboard/admin_aprendices.php?ficha={$i...` | Emite cabecera HTTP de redirección en el navegador: `header("Location: ../views/dashboard/admin_aprendices.php?ficha={$idFicha}"); exit;`. |
| `450` | `    }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `451` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `452` | `    // ── DESACTIVAR VOCERO ──────────────────────────────────────────────────` | Comentario de línea explicativo: `── DESACTIVAR VOCERO ──────────────────────────────────────────────────`. |
| `453` | `    public function desactivarVocero(): void` | Declaración de método o función con su firma y parámetros: `public function desactivarVocero(): void`. |
| `454` | `    {` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `455` | `        $this->requireAdmin();` | Instrucción de ejecución en el contexto del script: `$this->requireAdmin();`. |
| `456` | `        $idVocero = (int)($_POST['id_vocero'] ?? 0);` | Captura y sanitiza parámetros enviados por el cliente mediante petición HTTP: `$idVocero = (int)($_POST['id_vocero'] ?? 0);`. |
| `457` | `        $idFicha  = (int)($_POST['id_ficha']  ?? 0);` | Captura y sanitiza parámetros enviados por el cliente mediante petición HTTP: `$idFicha  = (int)($_POST['id_ficha']  ?? 0);`. |
| `458` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `459` | `        if (!$idVocero) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (!$idVocero) {`. |
| `460` | `            header("Location: ../views/dashboard/admin_aprendices.php?ficha...` | Emite cabecera HTTP de redirección en el navegador: `header("Location: ../views/dashboard/admin_aprendices.php?ficha={$idFicha}"); exit;`. |
| `461` | `        }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `462` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `463` | `        // Desactivar vocero` | Comentario de línea explicativo: `Desactivar vocero`. |
| `464` | `        $this->db->prepare("UPDATE voceros SET activo = 0 WHERE id_vocero =...` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$this->db->prepare("UPDATE voceros SET activo = 0 WHERE id_vocero = :id")`. |
| `465` | `                 ->execute([':id' => $idVocero]);` | Ejecuta la sentencia SQL preparada vinculando los datos correspondientes: `->execute([':id' => $idVocero]);`. |
| `466` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `467` | `        // Desactivar usuario asociado` | Comentario de línea explicativo: `Desactivar usuario asociado`. |
| `468` | `        $stmtU = $this->db->prepare("SELECT id_usuario FROM voceros WHERE i...` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmtU = $this->db->prepare("SELECT id_usuario FROM voceros WHERE id_vocero = :id LIMIT 1");`. |
| `469` | `        $stmtU->execute([':id' => $idVocero]);` | Ejecuta la sentencia SQL preparada vinculando los datos correspondientes: `$stmtU->execute([':id' => $idVocero]);`. |
| `470` | `        $row = $stmtU->fetch(PDO::FETCH_ASSOC);` | Recupera una única fila o registro resultante de la consulta. |
| `471` | `        if ($row) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if ($row) {`. |
| `472` | `            $this->db->prepare("UPDATE usuarios SET activo = 0 WHERE id_usu...` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$this->db->prepare("UPDATE usuarios SET activo = 0 WHERE id_usuario = :id")`. |
| `473` | `                     ->execute([':id' => $row['id_usuario']]);` | Ejecuta la sentencia SQL preparada vinculando los datos correspondientes: `->execute([':id' => $row['id_usuario']]);`. |
| `474` | `        }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `475` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `476` | `        $_SESSION['alert'] = ['icon'=>'success','title'=>'Vocero desactivad...` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección: `$_SESSION['alert'] = ['icon'=>'success','title'=>'Vocero desactivado','text'=>'El aprendiz volvió al rol de aprendiz y su acceso fue revocado.'];`. |
| `477` | `        header("Location: ../views/dashboard/admin_aprendices.php?ficha={$i...` | Emite cabecera HTTP de redirección en el navegador: `header("Location: ../views/dashboard/admin_aprendices.php?ficha={$idFicha}"); exit;`. |
| `478` | `    }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `479` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `480` | `    // ── REACTIVAR VOCERO INACTIVO ──────────────────────────────────────────` | Comentario de línea explicativo: `── REACTIVAR VOCERO INACTIVO ──────────────────────────────────────────`. |
| `481` | `    public function reactivarVocero(): void` | Declaración de método o función con su firma y parámetros: `public function reactivarVocero(): void`. |
| `482` | `    {` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `483` | `        $this->requireAdmin();` | Instrucción de ejecución en el contexto del script: `$this->requireAdmin();`. |
| `484` | `        $idVocero = (int)($_POST['id_vocero'] ?? 0);` | Captura y sanitiza parámetros enviados por el cliente mediante petición HTTP: `$idVocero = (int)($_POST['id_vocero'] ?? 0);`. |
| `485` | `        $idFicha  = (int)($_POST['id_ficha']  ?? 0);` | Captura y sanitiza parámetros enviados por el cliente mediante petición HTTP: `$idFicha  = (int)($_POST['id_ficha']  ?? 0);`. |
| `486` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `487` | `        // Verificar límite de 2` | Comentario de línea explicativo: `Verificar límite de 2`. |
| `488` | `        $stmtChk = $this->db->prepare("SELECT COUNT(*) FROM voceros WHERE i...` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmtChk = $this->db->prepare("SELECT COUNT(*) FROM voceros WHERE id_ficha = :fic AND activo = 1");`. |
| `489` | `        $stmtChk->execute([':fic' => $idFicha]);` | Ejecuta la sentencia SQL preparada vinculando los datos correspondientes: `$stmtChk->execute([':fic' => $idFicha]);`. |
| `490` | `        if ((int)$stmtChk->fetchColumn() >= 2) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if ((int)$stmtChk->fetchColumn() >= 2) {`. |
| `491` | `            $_SESSION['alert'] = ['icon'=>'error','title'=>'Límite alcanzad...` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección: `$_SESSION['alert'] = ['icon'=>'error','title'=>'Límite alcanzado','text'=>'Esta ficha ya tiene 2 voceros activos. Desactiva uno antes.'];`. |
| `492` | `            header("Location: ../views/dashboard/admin_aprendices.php?ficha...` | Emite cabecera HTTP de redirección en el navegador: `header("Location: ../views/dashboard/admin_aprendices.php?ficha={$idFicha}"); exit;`. |
| `493` | `        }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `494` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `495` | `        // Reactivar vocero y su usuario` | Comentario de línea explicativo: `Reactivar vocero y su usuario`. |
| `496` | `        $stmtV = $this->db->prepare("SELECT id_usuario FROM voceros WHERE i...` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmtV = $this->db->prepare("SELECT id_usuario FROM voceros WHERE id_vocero = :id LIMIT 1");`. |
| `497` | `        $stmtV->execute([':id' => $idVocero]);` | Ejecuta la sentencia SQL preparada vinculando los datos correspondientes: `$stmtV->execute([':id' => $idVocero]);`. |
| `498` | `        $row = $stmtV->fetch(PDO::FETCH_ASSOC);` | Recupera una única fila o registro resultante de la consulta. |
| `499` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `500` | `        $this->db->prepare("UPDATE voceros SET activo = 1 WHERE id_vocero =...` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$this->db->prepare("UPDATE voceros SET activo = 1 WHERE id_vocero = :id")`. |
| `501` | `                 ->execute([':id' => $idVocero]);` | Ejecuta la sentencia SQL preparada vinculando los datos correspondientes: `->execute([':id' => $idVocero]);`. |
| `502` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `503` | `        if ($row) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if ($row) {`. |
| `504` | `            $this->db->prepare("UPDATE usuarios SET activo = 1, primer_acce...` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$this->db->prepare("UPDATE usuarios SET activo = 1, primer_acceso = 1 WHERE id_usuario = :id")`. |
| `505` | `                     ->execute([':id' => $row['id_usuario']]);` | Ejecuta la sentencia SQL preparada vinculando los datos correspondientes: `->execute([':id' => $row['id_usuario']]);`. |
| `506` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `507` | `            $nuevaPassword = $this->generarPasswordTemporal();` | Instrucción de ejecución en el contexto del script: `$nuevaPassword = $this->generarPasswordTemporal();`. |
| `508` | `            (new Usuario($this->db))->actualizarPassword(` | Instrucción de ejecución en el contexto del script: `(new Usuario($this->db))->actualizarPassword(`. |
| `509` | `                (int)$row['id_usuario'],` | Instrucción de ejecución en el contexto del script: `(int)$row['id_usuario'],`. |
| `510` | `                password_hash($nuevaPassword, PASSWORD_DEFAULT)` | Instrucción de ejecución en el contexto del script: `password_hash($nuevaPassword, PASSWORD_DEFAULT)`. |
| `511` | `            );` | Instrucción de ejecución en el contexto del script: `);`. |
| `512` | `            // Resetear primer_acceso` | Comentario de línea explicativo: `Resetear primer_acceso`. |
| `513` | `            $this->db->prepare("UPDATE usuarios SET primer_acceso = 1 WHERE...` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$this->db->prepare("UPDATE usuarios SET primer_acceso = 1 WHERE id_usuario = :id")`. |
| `514` | `                     ->execute([':id' => $row['id_usuario']]);` | Ejecuta la sentencia SQL preparada vinculando los datos correspondientes: `->execute([':id' => $row['id_usuario']]);`. |
| `515` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `516` | `            $_SESSION['alert'] = [` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección: `$_SESSION['alert'] = [`. |
| `517` | `                'icon'  => 'success',` | Instrucción de ejecución en el contexto del script: `'icon'  => 'success',`. |
| `518` | `                'title' => 'Vocero reactivado',` | Instrucción de ejecución en el contexto del script: `'title' => 'Vocero reactivado',`. |
| `519` | `                'text'  => "La cuenta fue reactivada. Nueva contraseña temp...` | Instrucción de ejecución en el contexto del script: `'text'  => "La cuenta fue reactivada. Nueva contraseña temporal: {$nuevaPassword}",`. |
| `520` | `            ];` | Instrucción de ejecución en el contexto del script: `];`. |
| `521` | `        } else {` | Bloque alternativo `else`: se ejecuta si ninguna condición previa resultó verdadera. |
| `522` | `            $_SESSION['alert'] = ['icon'=>'success','title'=>'Vocero reacti...` | Almacena mensaje flash SweetAlert2 en sesión para notificar al usuario tras la redirección: `$_SESSION['alert'] = ['icon'=>'success','title'=>'Vocero reactivado','text'=>'El vocero fue reactivado correctamente.'];`. |
| `523` | `        }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `524` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `525` | `        header("Location: ../views/dashboard/admin_aprendices.php?ficha={$i...` | Emite cabecera HTTP de redirección en el navegador: `header("Location: ../views/dashboard/admin_aprendices.php?ficha={$idFicha}"); exit;`. |
| `526` | `    }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `527` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `528` | `    // ── HELPERS ────────────────────────────────────────────────────────────` | Comentario de línea explicativo: `── HELPERS ────────────────────────────────────────────────────────────`. |
| `529` | `    private function requireAdmin(): void` | Declaración de método o función con su firma y parámetros: `private function requireAdmin(): void`. |
| `530` | `    {` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `531` | `        if (!isset($_SESSION['usuario']) \|\| (int)$_SESSION['usuario']['ro...` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (!isset($_SESSION['usuario']) \|\| (int)$_SESSION['usuario']['rol'] !== 1) {`. |
| `532` | `            header("Location: ../views/usuarios/login.php"); exit;` | Emite cabecera HTTP de redirección en el navegador: `header("Location: ../views/usuarios/login.php"); exit;`. |
| `533` | `        }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `534` | `    }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `535` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `536` | `    private function notificarVoceroAsignacion(int $idFicha, int $idAsignac...` | Declaración de método o función con su firma y parámetros: `private function notificarVoceroAsignacion(int $idFicha, int $idAsignacion): void`. |
| `537` | `    {` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `538` | `        $stmt = $this->db->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmt = $this->db->prepare(`. |
| `539` | `            "SELECT v.id_usuario, m.nombre AS nombre_modulo, a.fecha_limite...` | Instrucción de ejecución en el contexto del script: `"SELECT v.id_usuario, m.nombre AS nombre_modulo, a.fecha_limite_evidencia`. |
| `540` | `             FROM voceros v` | Instrucción de ejecución en el contexto del script: `FROM voceros v`. |
| `541` | `             JOIN asignaciones a ON a.id_asignacion = :asig` | Instrucción de ejecución en el contexto del script: `JOIN asignaciones a ON a.id_asignacion = :asig`. |
| `542` | `             JOIN modulos m ON m.id_modulo = a.id_modulo` | Instrucción de ejecución en el contexto del script: `JOIN modulos m ON m.id_modulo = a.id_modulo`. |
| `543` | `             WHERE v.id_ficha = :ficha AND v.activo = 1 LIMIT 1"` | Instrucción de ejecución en el contexto del script: `WHERE v.id_ficha = :ficha AND v.activo = 1 LIMIT 1"`. |
| `544` | `        );` | Instrucción de ejecución en el contexto del script: `);`. |
| `545` | `        $stmt->execute([':asig' => $idAsignacion, ':ficha' => $idFicha]);` | Ejecuta la sentencia SQL preparada vinculando los datos correspondientes: `$stmt->execute([':asig' => $idAsignacion, ':ficha' => $idFicha]);`. |
| `546` | `        $data = $stmt->fetch(PDO::FETCH_ASSOC);` | Recupera una única fila o registro resultante de la consulta. |
| `547` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `548` | `        if (!$data) return;` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (!$data) return;`. |
| `549` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `550` | `        $noti = new Notificacion($this->db);` | Instrucción de ejecución en el contexto del script: `$noti = new Notificacion($this->db);`. |
| `551` | `        $noti->crear([` | Instrucción de ejecución en el contexto del script: `$noti->crear([`. |
| `552` | `            'id_usuario'    => $data['id_usuario'],` | Instrucción de ejecución en el contexto del script: `'id_usuario'    => $data['id_usuario'],`. |
| `553` | `            'id_asignacion' => $idAsignacion,` | Instrucción de ejecución en el contexto del script: `'id_asignacion' => $idAsignacion,`. |
| `554` | `            'tipo'          => 'info',` | Instrucción de ejecución en el contexto del script: `'tipo'          => 'info',`. |
| `555` | `            'titulo'        => 'Nuevo módulo asignado',` | Instrucción de ejecución en el contexto del script: `'titulo'        => 'Nuevo módulo asignado',`. |
| `556` | `            'mensaje'       => "Se te ha asignado el módulo «{$data['nombre...` | Instrucción de ejecución en el contexto del script: `'mensaje'       => "Se te ha asignado el módulo «{$data['nombre_modulo']}». Fecha límite de evidencia: " . date('d/m/Y H:i', strtotime($data['fecha_limite_evidencia'])) . ".",`. |
| `557` | `        ]);` | Instrucción de ejecución en el contexto del script: `]);`. |
| `558` | `    }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `559` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `560` | `    private function generarPasswordTemporal(): string` | Declaración de método o función con su firma y parámetros: `private function generarPasswordTemporal(): string`. |
| `561` | `    {` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `562` | `        $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz01234...` | Instrucción de ejecución en el contexto del script: `$chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789!@#$';`. |
| `563` | `        return substr(str_shuffle($chars), 0, 10);` | Retorna el valor resultante de la expresión y culmina la ejecución de la función actual: `return substr(str_shuffle($chars), 0, 10);`. |
| `564` | `    }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `565` | `}` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `566` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `567` | `// ── Dispatcher ────────────────────────────────────────────────────────────` | Comentario de línea explicativo: `── Dispatcher ────────────────────────────────────────────────────────────`. |
| `568` | `if (basename(__FILE__) === basename($_SERVER['SCRIPT_FILENAME'])) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (basename(__FILE__) === basename($_SERVER['SCRIPT_FILENAME'])) {`. |
| `569` | `    $controller = new AdminController();` | Instrucción de ejecución en el contexto del script: `$controller = new AdminController();`. |
| `570` | `    $accion     = $_POST['accion'] ?? $_GET['accion'] ?? '';` | Captura y sanitiza parámetros enviados por el cliente mediante petición HTTP: `$accion     = $_POST['accion'] ?? $_GET['accion'] ?? '';`. |
| `571` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `572` | `    match ($accion) {` | Instrucción de ejecución en el contexto del script: `match ($accion) {`. |
| `573` | `        'guardar_programa'   => $controller->guardarPrograma(),` | Instrucción de ejecución en el contexto del script: `'guardar_programa'   => $controller->guardarPrograma(),`. |
| `574` | `        'eliminar_programa'  => $controller->eliminarPrograma(),` | Instrucción de ejecución en el contexto del script: `'eliminar_programa'  => $controller->eliminarPrograma(),`. |
| `575` | `        'guardar_ficha'      => $controller->guardarFicha(),` | Instrucción de ejecución en el contexto del script: `'guardar_ficha'      => $controller->guardarFicha(),`. |
| `576` | `        'eliminar_ficha'     => $controller->eliminarFicha(),` | Instrucción de ejecución en el contexto del script: `'eliminar_ficha'     => $controller->eliminarFicha(),`. |
| `577` | `        'guardar_modulo'     => $controller->guardarModulo(),` | Instrucción de ejecución en el contexto del script: `'guardar_modulo'     => $controller->guardarModulo(),`. |
| `578` | `        'asignar_modulo'     => $controller->asignarModulo(),` | Instrucción de ejecución en el contexto del script: `'asignar_modulo'     => $controller->asignarModulo(),`. |
| `579` | `        'editar_asignacion'  => $controller->editarAsignacion(),` | Instrucción de ejecución en el contexto del script: `'editar_asignacion'  => $controller->editarAsignacion(),`. |
| `580` | `        'cancelar_asignacion'=> $controller->cancelarAsignacion(),` | Instrucción de ejecución en el contexto del script: `'cancelar_asignacion'=> $controller->cancelarAsignacion(),`. |
| `581` | `        'reenviar_credenciales' => $controller->reenviarCredenciales(),` | Instrucción de ejecución en el contexto del script: `'reenviar_credenciales' => $controller->reenviarCredenciales(),`. |
| `582` | `        'activar_vocero'        => $controller->activarVocero(),` | Instrucción de ejecución en el contexto del script: `'activar_vocero'        => $controller->activarVocero(),`. |
| `583` | `        'desactivar_vocero'     => $controller->desactivarVocero(),` | Instrucción de ejecución en el contexto del script: `'desactivar_vocero'     => $controller->desactivarVocero(),`. |
| `584` | `        'reactivar_vocero'      => $controller->reactivarVocero(),` | Instrucción de ejecución en el contexto del script: `'reactivar_vocero'      => $controller->reactivarVocero(),`. |
| `585` | `        default              => header("Location: ../views/dashboard/admin_...` | Emite cabecera HTTP de redirección en el navegador: `default              => header("Location: ../views/dashboard/admin_dashboard.php"),`. |
| `586` | `    };` | Instrucción de ejecución en el contexto del script: `};`. |
| `587` | `}` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `588` | `?>` | Cierre de la etiqueta PHP para alternar a salida HTML o fin del archivo. |

---

## 3. Resumen y Flujo de Interacción

El archivo `AdminController.php` cumple un rol indispensable en `controllers/AdminController.php`. 
Controlador principal del módulo de administración. Gestiona programas de formación, fichas, módulos, asignaciones de grupos, voceros y supervisión. Garantiza la robustez, el orden y la estabilidad de la arquitectura del proyecto `systemLimpieza`.
