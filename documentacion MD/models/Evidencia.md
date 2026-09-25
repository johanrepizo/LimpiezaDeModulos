# Documentación Línea por Línea: `models/Evidencia.php`

## 1. Ficha Técnica del Archivo

- **Archivo:** `Evidencia.php`
- **Ruta en el proyecto:** `models/Evidencia.php`
- **Cantidad total de líneas:** `211`
- **Tipo de archivo:** `PHP`
- **Propósito general:** Modelo de datos para registrar, consultar y validar evidencias fotográficas de limpieza (antes y después) subidas por los voceros de las fichas.

---

## 2. Explicación Detallada Línea por Línea

A continuación se presenta cada línea de código numerada de forma consecutiva, acompañada de su fragmento exacto y la explicación exhaustiva de su funcionamiento y responsabilidad en el sistema:

| Línea | Código Fuente | Explicación Detallada |
|---|---|---|
| `1` | ``<?php`` | Apertura obligatoria de la etiqueta PHP para ejecución del código del lado del servidor. |
| `2` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `3` | `class Evidencia` | Declaración de la clase del componente: `class Evidencia`. |
| `4` | ``{`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `5` | `private $conn;` | Definición de propiedad de clase para el estado interno del componente: `private $conn;`. |
| `6` | `private $tabla = "evidencias";` | Definición de propiedad de clase para el estado interno del componente: `private $tabla = "evidencias";`. |
| `7` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `8` | `public function __construct($db)` | Declaración de método o función con su firma y parámetros: `public function __construct($db)`. |
| `9` | ``{`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `10` | `$this->conn = $db;` | Instrucción de ejecución en el contexto del script: `$this->conn = $db;`. |
| `11` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `12` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `13` | `// ── Todas las evidencias de un vocero, ordenadas por fecha DESC ------...` | Comentario explicativo en el código: `── Todas las evidencias de un vocero, ordenadas por fecha DESC ----------`. |
| `14` | `public function obtenerPorVocero(int $idVocero, ?int $idAsignacion = nul...` | Declaración de método o función con su firma y parámetros: `public function obtenerPorVocero(int $idVocero, ?int $idAsignacion = nul...`. |
| `15` | ``{`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `16` | `$where  = 'e.id_vocero = :id';` | Instrucción de ejecución en el contexto del script: `$where  = 'e.id_vocero = :id';`. |
| `17` | `$params = [':id' => $idVocero];` | Instrucción de ejecución en el contexto del script: `$params = [':id' => $idVocero];`. |
| `18` | `if ($idAsignacion) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if ($idAsignacion) {`. |
| `19` | `$where .= ' AND a.id_asignacion = :asig';` | Instrucción de ejecución en el contexto del script: `$where .= ' AND a.id_asignacion = :asig';`. |
| `20` | `$params[':asig'] = $idAsignacion;` | Instrucción de ejecución en el contexto del script: `$params[':asig'] = $idAsignacion;`. |
| `21` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `22` | `$stmt = $this->conn->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmt = $this->conn->prepare(`. |
| `23` | `"SELECT e.*,` | Instrucción de ejecución en el contexto del script: `"SELECT e.*,`. |
| `24` | `g.nombre_grupo, g.fecha_limpieza,` | Instrucción de ejecución en el contexto del script: `g.nombre_grupo, g.fecha_limpieza,`. |
| `25` | `m.nombre AS nombre_modulo,` | Instrucción de ejecución en el contexto del script: `m.nombre AS nombre_modulo,`. |
| `26` | `f.numero_ficha` | Instrucción de ejecución en el contexto del script: `f.numero_ficha`. |
| `27` | `FROM {$this->tabla} e` | Instrucción de ejecución en el contexto del script: `FROM {$this->tabla} e`. |
| `28` | `JOIN grupos g ON g.id_grupo = e.id_grupo` | Instrucción de ejecución en el contexto del script: `JOIN grupos g ON g.id_grupo = e.id_grupo`. |
| `29` | `JOIN asignaciones a ON a.id_asignacion = g.id_asignacion` | Instrucción de ejecución en el contexto del script: `JOIN asignaciones a ON a.id_asignacion = g.id_asignacion`. |
| `30` | `JOIN modulos m ON m.id_modulo = a.id_modulo` | Instrucción de ejecución en el contexto del script: `JOIN modulos m ON m.id_modulo = a.id_modulo`. |
| `31` | `JOIN fichas  f ON f.id_ficha  = a.id_ficha` | Instrucción de ejecución en el contexto del script: `JOIN fichas  f ON f.id_ficha  = a.id_ficha`. |
| `32` | `WHERE {$where}` | Instrucción de ejecución en el contexto del script: `WHERE {$where}`. |
| `33` | `ORDER BY g.fecha_limpieza DESC, e.tipo ASC, e.fecha_subida ASC"` | Instrucción de ejecución en el contexto del script: `ORDER BY g.fecha_limpieza DESC, e.tipo ASC, e.fecha_subida ASC"`. |
| `34` | ``);`` | Cierre de estructura de arreglo o invocación de función. |
| `35` | `$stmt->execute($params);` | Ejecuta la sentencia SQL preparada vinculando los parámetros correspondientes: `$stmt->execute($params);`. |
| `36` | `return $stmt->fetchAll(PDO::FETCH_ASSOC);` | Obtiene todos los registros coincidentes de la consulta en un arreglo asociativo. |
| `37` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `38` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `39` | `// ── Par antes/después de un turno concreto ---------------------------...` | Comentario explicativo en el código: `── Par antes/después de un turno concreto --------------------------------`. |
| `40` | `public function obtenerParTurno(int $idTurno): array` | Declaración de método o función con su firma y parámetros: `public function obtenerParTurno(int $idTurno): array`. |
| `41` | ``{`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `42` | `$stmt = $this->conn->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmt = $this->conn->prepare(`. |
| `43` | `"SELECT * FROM {$this->tabla}` | Instrucción de ejecución en el contexto del script: `"SELECT * FROM {$this->tabla}`. |
| `44` | `WHERE id_turno = :id` | Instrucción de ejecución en el contexto del script: `WHERE id_turno = :id`. |
| `45` | `ORDER BY tipo ASC, fecha_subida ASC"` | Instrucción de ejecución en el contexto del script: `ORDER BY tipo ASC, fecha_subida ASC"`. |
| `46` | ``);`` | Cierre de estructura de arreglo o invocación de función. |
| `47` | `$stmt->execute([':id' => $idTurno]);` | Ejecuta la sentencia SQL preparada vinculando los parámetros correspondientes: `$stmt->execute([':id' => $idTurno]);`. |
| `48` | `$rows  = $stmt->fetchAll(PDO::FETCH_ASSOC);` | Obtiene todos los registros coincidentes de la consulta en un arreglo asociativo. |
| `49` | `$par   = ['antes' => null, 'despues' => null];` | Instrucción de ejecución en el contexto del script: `$par   = ['antes' => null, 'despues' => null];`. |
| `50` | `foreach ($rows as $r) {` | Estructura de control iterativa para recorrer colecciones o arreglos: `foreach ($rows as $r) {`. |
| `51` | `$par[$r['tipo']] = $r;` | Instrucción de ejecución en el contexto del script: `$par[$r['tipo']] = $r;`. |
| `52` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `53` | `return $par;` | Instrucción de retorno que finaliza la ejecución entregando el resultado: `return $par;`. |
| `54` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `55` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `56` | `// ── Cuántas fotos tiene un turno (0, 1 o 2) --------------------------...` | Comentario explicativo en el código: `── Cuántas fotos tiene un turno (0, 1 o 2) --------------------------------`. |
| `57` | `public function contarPorTurno(int $idTurno): int` | Declaración de método o función con su firma y parámetros: `public function contarPorTurno(int $idTurno): int`. |
| `58` | ``{`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `59` | `$stmt = $this->conn->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmt = $this->conn->prepare(`. |
| `60` | `"SELECT COUNT(*) FROM {$this->tabla} WHERE id_turno = :id"` | Instrucción de ejecución en el contexto del script: `"SELECT COUNT(*) FROM {$this->tabla} WHERE id_turno = :id"`. |
| `61` | ``);`` | Cierre de estructura de arreglo o invocación de función. |
| `62` | `$stmt->execute([':id' => $idTurno]);` | Ejecuta la sentencia SQL preparada vinculando los parámetros correspondientes: `$stmt->execute([':id' => $idTurno]);`. |
| `63` | `return (int) $stmt->fetchColumn();` | Recupera el valor escalar de la primera columna del resultado de la consulta. |
| `64` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `65` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `66` | `// ── Turno ya tiene el par completo (antes + después) -----------------...` | Comentario explicativo en el código: `── Turno ya tiene el par completo (antes + después) ----------------------`. |
| `67` | `public function turnoCompleto(int $idTurno): bool` | Declaración de método o función con su firma y parámetros: `public function turnoCompleto(int $idTurno): bool`. |
| `68` | ``{`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `69` | `$stmt = $this->conn->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmt = $this->conn->prepare(`. |
| `70` | `"SELECT COUNT(DISTINCT tipo) FROM {$this->tabla}` | Instrucción de ejecución en el contexto del script: `"SELECT COUNT(DISTINCT tipo) FROM {$this->tabla}`. |
| `71` | `WHERE id_turno = :id AND tipo IN ('antes','despues')"` | Instrucción de ejecución en el contexto del script: `WHERE id_turno = :id AND tipo IN ('antes','despues')"`. |
| `72` | ``);`` | Cierre de estructura de arreglo o invocación de función. |
| `73` | `$stmt->execute([':id' => $idTurno]);` | Ejecuta la sentencia SQL preparada vinculando los parámetros correspondientes: `$stmt->execute([':id' => $idTurno]);`. |
| `74` | `return (int) $stmt->fetchColumn() === 2;` | Recupera el valor escalar de la primera columna del resultado de la consulta. |
| `75` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `76` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `77` | `// ── Última evidencia de un grupo (compatibilidad flujo antiguo) ------...` | Comentario explicativo en el código: `── Última evidencia de un grupo (compatibilidad flujo antiguo) -----------`. |
| `78` | `public function obtenerPorGrupo(int $idGrupo): array\|false` | Declaración de método o función con su firma y parámetros: `public function obtenerPorGrupo(int $idGrupo): array\|false`. |
| `79` | ``{`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `80` | `$stmt = $this->conn->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmt = $this->conn->prepare(`. |
| `81` | `"SELECT * FROM {$this->tabla}` | Instrucción de ejecución en el contexto del script: `"SELECT * FROM {$this->tabla}`. |
| `82` | `WHERE id_grupo = :id` | Instrucción de ejecución en el contexto del script: `WHERE id_grupo = :id`. |
| `83` | `ORDER BY tipo ASC, fecha_subida ASC` | Instrucción de ejecución en el contexto del script: `ORDER BY tipo ASC, fecha_subida ASC`. |
| `84` | `LIMIT 1"` | Instrucción de ejecución en el contexto del script: `LIMIT 1"`. |
| `85` | ``);`` | Cierre de estructura de arreglo o invocación de función. |
| `86` | `$stmt->execute([':id' => $idGrupo]);` | Ejecuta la sentencia SQL preparada vinculando los parámetros correspondientes: `$stmt->execute([':id' => $idGrupo]);`. |
| `87` | `return $stmt->fetch(PDO::FETCH_ASSOC);` | Recupera una única fila o registro resultante de la consulta. |
| `88` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `89` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `90` | `// ── Todas las evidencias de un grupo ordenadas (antes primero) -------...` | Comentario explicativo en el código: `── Todas las evidencias de un grupo ordenadas (antes primero) ------------`. |
| `91` | `public function obtenerTodasPorGrupo(int $idGrupo): array` | Declaración de método o función con su firma y parámetros: `public function obtenerTodasPorGrupo(int $idGrupo): array`. |
| `92` | ``{`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `93` | `$stmt = $this->conn->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmt = $this->conn->prepare(`. |
| `94` | `"SELECT * FROM {$this->tabla}` | Instrucción de ejecución en el contexto del script: `"SELECT * FROM {$this->tabla}`. |
| `95` | `WHERE id_grupo = :id` | Instrucción de ejecución en el contexto del script: `WHERE id_grupo = :id`. |
| `96` | `ORDER BY tipo ASC, fecha_subida ASC"` | Instrucción de ejecución en el contexto del script: `ORDER BY tipo ASC, fecha_subida ASC"`. |
| `97` | ``);`` | Cierre de estructura de arreglo o invocación de función. |
| `98` | `$stmt->execute([':id' => $idGrupo]);` | Ejecuta la sentencia SQL preparada vinculando los parámetros correspondientes: `$stmt->execute([':id' => $idGrupo]);`. |
| `99` | `return $stmt->fetchAll(PDO::FETCH_ASSOC);` | Obtiene todos los registros coincidentes de la consulta en un arreglo asociativo. |
| `100` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `101` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `102` | `// ── ¿El grupo tiene al menos una evidencia? --------------------------...` | Comentario explicativo en el código: `── ¿El grupo tiene al menos una evidencia? --------------------------------`. |
| `103` | `public function grupoTieneEvidencia(int $idGrupo): bool` | Declaración de método o función con su firma y parámetros: `public function grupoTieneEvidencia(int $idGrupo): bool`. |
| `104` | ``{`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `105` | `$stmt = $this->conn->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmt = $this->conn->prepare(`. |
| `106` | `"SELECT id_evidencia FROM {$this->tabla} WHERE id_grupo = :id LIMIT 1"` | Instrucción de ejecución en el contexto del script: `"SELECT id_evidencia FROM {$this->tabla} WHERE id_grupo = :id LIMIT 1"`. |
| `107` | ``);`` | Cierre de estructura de arreglo o invocación de función. |
| `108` | `$stmt->execute([':id' => $idGrupo]);` | Ejecuta la sentencia SQL preparada vinculando los parámetros correspondientes: `$stmt->execute([':id' => $idGrupo]);`. |
| `109` | `return $stmt->rowCount() > 0;` | Instrucción de retorno que finaliza la ejecución entregando el resultado: `return $stmt->rowCount() > 0;`. |
| `110` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `111` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `112` | `// ── ¿El grupo tiene el par completo (antes + después)? ---------------...` | Comentario explicativo en el código: `── ¿El grupo tiene el par completo (antes + después)? --------------------`. |
| `113` | `public function grupoCompleto(int $idGrupo): bool` | Declaración de método o función con su firma y parámetros: `public function grupoCompleto(int $idGrupo): bool`. |
| `114` | ``{`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `115` | `$stmt = $this->conn->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmt = $this->conn->prepare(`. |
| `116` | `"SELECT COUNT(DISTINCT tipo) FROM {$this->tabla}` | Instrucción de ejecución en el contexto del script: `"SELECT COUNT(DISTINCT tipo) FROM {$this->tabla}`. |
| `117` | `WHERE id_grupo = :id AND tipo IN ('antes','despues')"` | Instrucción de ejecución en el contexto del script: `WHERE id_grupo = :id AND tipo IN ('antes','despues')"`. |
| `118` | ``);`` | Cierre de estructura de arreglo o invocación de función. |
| `119` | `$stmt->execute([':id' => $idGrupo]);` | Ejecuta la sentencia SQL preparada vinculando los parámetros correspondientes: `$stmt->execute([':id' => $idGrupo]);`. |
| `120` | `return (int) $stmt->fetchColumn() === 2;` | Recupera el valor escalar de la primera columna del resultado de la consulta. |
| `121` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `122` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `123` | `// ── Registrar una evidencia con tipo ---------------------------------...` | Comentario explicativo en el código: `── Registrar una evidencia con tipo --------------------------------------`. |
| `124` | `public function registrar(array $datos): int\|false` | Declaración de método o función con su firma y parámetros: `public function registrar(array $datos): int\|false`. |
| `125` | ``{`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `126` | `try {` | Instrucción de ejecución en el contexto del script: `try {`. |
| `127` | `$stmt = $this->conn->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmt = $this->conn->prepare(`. |
| `128` | `"INSERT INTO {$this->tabla}` | Instrucción de ejecución en el contexto del script: `"INSERT INTO {$this->tabla}`. |
| `129` | `(id_grupo, id_vocero, id_turno, tipo, nombre_archivo, ruta_archivo, obse...` | Instrucción de ejecución en el contexto del script: `(id_grupo, id_vocero, id_turno, tipo, nombre_archivo, ruta_archivo, obse...`. |
| `130` | `VALUES` | Instrucción de ejecución en el contexto del script: `VALUES`. |
| `131` | `(:id_grupo, :id_vocero, :id_turno, :tipo, :nombre_archivo, :ruta_archivo...` | Instrucción de ejecución en el contexto del script: `(:id_grupo, :id_vocero, :id_turno, :tipo, :nombre_archivo, :ruta_archivo...`. |
| `132` | ``);`` | Cierre de estructura de arreglo o invocación de función. |
| `133` | `$stmt->execute([` | Ejecuta la sentencia SQL preparada vinculando los parámetros correspondientes: `$stmt->execute([`. |
| `134` | `':id_grupo'       => $datos['id_grupo'],` | Instrucción de ejecución en el contexto del script: `':id_grupo'       => $datos['id_grupo'],`. |
| `135` | `':id_vocero'      => $datos['id_vocero'],` | Instrucción de ejecución en el contexto del script: `':id_vocero'      => $datos['id_vocero'],`. |
| `136` | `':id_turno'       => $datos['id_turno']       ?? null,` | Instrucción de ejecución en el contexto del script: `':id_turno'       => $datos['id_turno']       ?? null,`. |
| `137` | `':tipo'           => $datos['tipo']           ?? 'antes',` | Instrucción de ejecución en el contexto del script: `':tipo'           => $datos['tipo']           ?? 'antes',`. |
| `138` | `':nombre_archivo' => $datos['nombre_archivo'],` | Instrucción de ejecución en el contexto del script: `':nombre_archivo' => $datos['nombre_archivo'],`. |
| `139` | `':ruta_archivo'   => $datos['ruta_archivo'],` | Instrucción de ejecución en el contexto del script: `':ruta_archivo'   => $datos['ruta_archivo'],`. |
| `140` | `':observaciones'  => $datos['observaciones']  ?? null,` | Instrucción de ejecución en el contexto del script: `':observaciones'  => $datos['observaciones']  ?? null,`. |
| `141` | `]);` | Instrucción de ejecución en el contexto del script: `]);`. |
| `142` | `return (int) $this->conn->lastInsertId();` | Instrucción de retorno que finaliza la ejecución entregando el resultado: `return (int) $this->conn->lastInsertId();`. |
| `143` | `} catch (Exception $e) {` | Instrucción de ejecución en el contexto del script: `} catch (Exception $e) {`. |
| `144` | `return false;` | Instrucción de retorno que finaliza la ejecución entregando el resultado: `return false;`. |
| `145` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `146` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `147` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `148` | `// ── Todas las evidencias (admin), agrupadas por turno, ordenadas -----...` | Comentario explicativo en el código: `── Todas las evidencias (admin), agrupadas por turno, ordenadas ----------`. |
| `149` | `public function obtenerTodas(array $filtros = []): array` | Declaración de método o función con su firma y parámetros: `public function obtenerTodas(array $filtros = []): array`. |
| `150` | ``{`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `151` | `$where  = ['1=1'];` | Instrucción de ejecución en el contexto del script: `$where  = ['1=1'];`. |
| `152` | `$params = [];` | Instrucción de ejecución en el contexto del script: `$params = [];`. |
| `153` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `154` | `if (!empty($filtros['id_ficha'])) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (!empty($filtros['id_ficha'])) {`. |
| `155` | `$where[] = 'a.id_ficha = :id_ficha';` | Instrucción de ejecución en el contexto del script: `$where[] = 'a.id_ficha = :id_ficha';`. |
| `156` | `$params[':id_ficha'] = $filtros['id_ficha'];` | Instrucción de ejecución en el contexto del script: `$params[':id_ficha'] = $filtros['id_ficha'];`. |
| `157` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `158` | `if (!empty($filtros['id_vocero'])) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (!empty($filtros['id_vocero'])) {`. |
| `159` | `$where[] = 'e.id_vocero = :id_vocero';` | Instrucción de ejecución en el contexto del script: `$where[] = 'e.id_vocero = :id_vocero';`. |
| `160` | `$params[':id_vocero'] = $filtros['id_vocero'];` | Instrucción de ejecución en el contexto del script: `$params[':id_vocero'] = $filtros['id_vocero'];`. |
| `161` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `162` | `if (!empty($filtros['fecha_desde'])) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (!empty($filtros['fecha_desde'])) {`. |
| `163` | `$where[] = 'DATE(e.fecha_subida) >= :desde';` | Instrucción de ejecución en el contexto del script: `$where[] = 'DATE(e.fecha_subida) >= :desde';`. |
| `164` | `$params[':desde'] = $filtros['fecha_desde'];` | Instrucción de ejecución en el contexto del script: `$params[':desde'] = $filtros['fecha_desde'];`. |
| `165` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `166` | `if (!empty($filtros['fecha_hasta'])) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (!empty($filtros['fecha_hasta'])) {`. |
| `167` | `$where[] = 'DATE(e.fecha_subida) <= :hasta';` | Instrucción de ejecución en el contexto del script: `$where[] = 'DATE(e.fecha_subida) <= :hasta';`. |
| `168` | `$params[':hasta'] = $filtros['fecha_hasta'];` | Instrucción de ejecución en el contexto del script: `$params[':hasta'] = $filtros['fecha_hasta'];`. |
| `169` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `170` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `171` | `$whereStr = implode(' AND ', $where);` | Instrucción de ejecución en el contexto del script: `$whereStr = implode(' AND ', $where);`. |
| `172` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `173` | `$stmt = $this->conn->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmt = $this->conn->prepare(`. |
| `174` | `"SELECT e.*,` | Instrucción de ejecución en el contexto del script: `"SELECT e.*,`. |
| `175` | `g.nombre_grupo, g.fecha_limpieza,` | Instrucción de ejecución en el contexto del script: `g.nombre_grupo, g.fecha_limpieza,`. |
| `176` | `m.nombre AS nombre_modulo,` | Instrucción de ejecución en el contexto del script: `m.nombre AS nombre_modulo,`. |
| `177` | `f.numero_ficha,` | Instrucción de ejecución en el contexto del script: `f.numero_ficha,`. |
| `178` | `v.nombres AS vocero_nombres, v.apellidos AS vocero_apellidos` | Instrucción de ejecución en el contexto del script: `v.nombres AS vocero_nombres, v.apellidos AS vocero_apellidos`. |
| `179` | `FROM {$this->tabla} e` | Instrucción de ejecución en el contexto del script: `FROM {$this->tabla} e`. |
| `180` | `JOIN grupos g ON g.id_grupo = e.id_grupo` | Instrucción de ejecución en el contexto del script: `JOIN grupos g ON g.id_grupo = e.id_grupo`. |
| `181` | `JOIN asignaciones a ON a.id_asignacion = g.id_asignacion` | Instrucción de ejecución en el contexto del script: `JOIN asignaciones a ON a.id_asignacion = g.id_asignacion`. |
| `182` | `JOIN modulos  m ON m.id_modulo  = a.id_modulo` | Instrucción de ejecución en el contexto del script: `JOIN modulos  m ON m.id_modulo  = a.id_modulo`. |
| `183` | `JOIN fichas   f ON f.id_ficha   = a.id_ficha` | Instrucción de ejecución en el contexto del script: `JOIN fichas   f ON f.id_ficha   = a.id_ficha`. |
| `184` | `JOIN voceros  v ON v.id_vocero  = e.id_vocero` | Instrucción de ejecución en el contexto del script: `JOIN voceros  v ON v.id_vocero  = e.id_vocero`. |
| `185` | `WHERE {$whereStr}` | Instrucción de ejecución en el contexto del script: `WHERE {$whereStr}`. |
| `186` | `ORDER BY g.fecha_limpieza DESC, e.id_turno ASC, e.tipo ASC, e.fecha_subi...` | Instrucción de ejecución en el contexto del script: `ORDER BY g.fecha_limpieza DESC, e.id_turno ASC, e.tipo ASC, e.fecha_subi...`. |
| `187` | ``);`` | Cierre de estructura de arreglo o invocación de función. |
| `188` | `$stmt->execute($params);` | Ejecuta la sentencia SQL preparada vinculando los parámetros correspondientes: `$stmt->execute($params);`. |
| `189` | `return $stmt->fetchAll(PDO::FETCH_ASSOC);` | Obtiene todos los registros coincidentes de la consulta en un arreglo asociativo. |
| `190` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `191` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `192` | `// ── Resumen por asignación con conteo de evidencias ------------------...` | Comentario explicativo en el código: `── Resumen por asignación con conteo de evidencias -----------------------`. |
| `193` | `// Considera completo solo si tiene las 2 fotos (antes + después)` | Comentario explicativo en el código: `Considera completo solo si tiene las 2 fotos (antes + después)`. |
| `194` | `public function resumenPorAsignacion(int $idAsignacion): array` | Declaración de método o función con su firma y parámetros: `public function resumenPorAsignacion(int $idAsignacion): array`. |
| `195` | ``{`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `196` | `$stmt = $this->conn->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmt = $this->conn->prepare(`. |
| `197` | `"SELECT g.id_grupo, g.nombre_grupo, g.fecha_limpieza,` | Instrucción de ejecución en el contexto del script: `"SELECT g.id_grupo, g.nombre_grupo, g.fecha_limpieza,`. |
| `198` | `v.nombres AS vocero_nombres, v.apellidos AS vocero_apellidos,` | Instrucción de ejecución en el contexto del script: `v.nombres AS vocero_nombres, v.apellidos AS vocero_apellidos,`. |
| `199` | `(SELECT COUNT(DISTINCT tipo) FROM evidencias e2` | Instrucción de ejecución en el contexto del script: `(SELECT COUNT(DISTINCT tipo) FROM evidencias e2`. |
| `200` | `WHERE e2.id_grupo = g.id_grupo` | Instrucción de ejecución en el contexto del script: `WHERE e2.id_grupo = g.id_grupo`. |
| `201` | `AND e2.tipo IN ('antes','despues')) AS fotos_completas` | Instrucción de ejecución en el contexto del script: `AND e2.tipo IN ('antes','despues')) AS fotos_completas`. |
| `202` | `FROM grupos g` | Instrucción de ejecución en el contexto del script: `FROM grupos g`. |
| `203` | `JOIN voceros v ON v.id_vocero = g.id_vocero` | Instrucción de ejecución en el contexto del script: `JOIN voceros v ON v.id_vocero = g.id_vocero`. |
| `204` | `WHERE g.id_asignacion = :id` | Instrucción de ejecución en el contexto del script: `WHERE g.id_asignacion = :id`. |
| `205` | `ORDER BY g.fecha_limpieza DESC"` | Instrucción de ejecución en el contexto del script: `ORDER BY g.fecha_limpieza DESC"`. |
| `206` | ``);`` | Cierre de estructura de arreglo o invocación de función. |
| `207` | `$stmt->execute([':id' => $idAsignacion]);` | Ejecuta la sentencia SQL preparada vinculando los parámetros correspondientes: `$stmt->execute([':id' => $idAsignacion]);`. |
| `208` | `return $stmt->fetchAll(PDO::FETCH_ASSOC);` | Obtiene todos los registros coincidentes de la consulta en un arreglo asociativo. |
| `209` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `210` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `211` | ``?>`` | Cierre de la etiqueta PHP para alternar a salida HTML o fin del archivo. |

---

## 3. Resumen y Flujo de Interacción

El archivo `Evidencia.php` cumple un rol indispensable en `models/Evidencia.php`. 
Modelo de datos para registrar, consultar y validar evidencias fotográficas de limpieza (antes y después) subidas por los voceros de las fichas. Garantiza la robustez, el orden y la estabilidad de la arquitectura del proyecto `systemLimpieza`.

---

Generado automáticamente para el repositorio [johanrepizo/LimpiezaDeModulos](https://github.com/johanrepizo/LimpiezaDeModulos).
