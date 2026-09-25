# Documentación Línea por Línea: `models/Modulo.php`

## 1. Ficha Técnica del Archivo

- **Archivo:** `Modulo.php`
- **Ruta en el proyecto:** `models/Modulo.php`
- **Cantidad total de líneas:** `173`
- **Tipo de archivo:** `PHP`
- **Propósito general:** Modelo de datos para la administración de módulos/ambientes físicos de formación y asignación de fichas encargadas de su limpieza.

---

## 2. Explicación Detallada Línea por Línea

A continuación se presenta cada línea de código numerada de forma consecutiva, acompañada de su fragmento exacto y la explicación exhaustiva de su funcionamiento y responsabilidad en el sistema:

| Línea | Código Fuente | Explicación Detallada |
|---|---|---|
| `1` | ``<?php`` | Apertura obligatoria de la etiqueta PHP para ejecución del código del lado del servidor. |
| `2` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `3` | `class Modulo` | Declaración de la clase del componente: `class Modulo`. |
| `4` | ``{`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `5` | `private $conn;` | Definición de propiedad de clase para el estado interno del componente: `private $conn;`. |
| `6` | `private $tabla = "modulos";` | Definición de propiedad de clase para el estado interno del componente: `private $tabla = "modulos";`. |
| `7` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `8` | `public function __construct($db)` | Declaración de método o función con su firma y parámetros: `public function __construct($db)`. |
| `9` | ``{`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `10` | `$this->conn = $db;` | Instrucción de ejecución en el contexto del script: `$this->conn = $db;`. |
| `11` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `12` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `13` | `public function obtenerTodos(): array` | Declaración de método o función con su firma y parámetros: `public function obtenerTodos(): array`. |
| `14` | ``{`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `15` | `$stmt = $this->conn->query(` | Instrucción de ejecución en el contexto del script: `$stmt = $this->conn->query(`. |
| `16` | `"SELECT m.*,` | Instrucción de ejecución en el contexto del script: `"SELECT m.*,`. |
| `17` | `ANY_VALUE(a.id_asignacion)           AS id_asignacion,` | Instrucción de ejecución en el contexto del script: `ANY_VALUE(a.id_asignacion)           AS id_asignacion,`. |
| `18` | `ANY_VALUE(a.estado)                  AS estado_asignacion,` | Instrucción de ejecución en el contexto del script: `ANY_VALUE(a.estado)                  AS estado_asignacion,`. |
| `19` | `ANY_VALUE(a.fecha_limite_evidencia)  AS fecha_limite_evidencia,` | Instrucción de ejecución en el contexto del script: `ANY_VALUE(a.fecha_limite_evidencia)  AS fecha_limite_evidencia,`. |
| `20` | `ANY_VALUE(f.numero_ficha)            AS numero_ficha,` | Instrucción de ejecución en el contexto del script: `ANY_VALUE(f.numero_ficha)            AS numero_ficha,`. |
| `21` | `ANY_VALUE(v.nombres)                 AS vocero_nombres,` | Instrucción de ejecución en el contexto del script: `ANY_VALUE(v.nombres)                 AS vocero_nombres,`. |
| `22` | `ANY_VALUE(v.apellidos)               AS vocero_apellidos` | Instrucción de ejecución en el contexto del script: `ANY_VALUE(v.apellidos)               AS vocero_apellidos`. |
| `23` | `FROM {$this->tabla} m` | Instrucción de ejecución en el contexto del script: `FROM {$this->tabla} m`. |
| `24` | `LEFT JOIN asignaciones a ON a.id_modulo = m.id_modulo AND a.estado = 'Ac...` | Instrucción de ejecución en el contexto del script: `LEFT JOIN asignaciones a ON a.id_modulo = m.id_modulo AND a.estado = 'Ac...`. |
| `25` | `LEFT JOIN fichas   f ON f.id_ficha    = a.id_ficha` | Instrucción de ejecución en el contexto del script: `LEFT JOIN fichas   f ON f.id_ficha    = a.id_ficha`. |
| `26` | `LEFT JOIN voceros  v ON v.id_ficha    = a.id_ficha AND v.activo = 1` | Instrucción de ejecución en el contexto del script: `LEFT JOIN voceros  v ON v.id_ficha    = a.id_ficha AND v.activo = 1`. |
| `27` | `WHERE m.activo = 1` | Instrucción de ejecución en el contexto del script: `WHERE m.activo = 1`. |
| `28` | `GROUP BY m.id_modulo` | Instrucción de ejecución en el contexto del script: `GROUP BY m.id_modulo`. |
| `29` | `ORDER BY m.nombre"` | Instrucción de ejecución en el contexto del script: `ORDER BY m.nombre"`. |
| `30` | ``);`` | Cierre de estructura de arreglo o invocación de función. |
| `31` | `return $stmt->fetchAll(PDO::FETCH_ASSOC);` | Obtiene todos los registros coincidentes de la consulta en un arreglo asociativo. |
| `32` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `33` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `34` | `public function obtenerPorId(int $id): array\|false` | Declaración de método o función con su firma y parámetros: `public function obtenerPorId(int $id): array\|false`. |
| `35` | ``{`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `36` | `$stmt = $this->conn->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmt = $this->conn->prepare(`. |
| `37` | `"SELECT * FROM {$this->tabla} WHERE id_modulo = :id LIMIT 1"` | Instrucción de ejecución en el contexto del script: `"SELECT * FROM {$this->tabla} WHERE id_modulo = :id LIMIT 1"`. |
| `38` | ``);`` | Cierre de estructura de arreglo o invocación de función. |
| `39` | `$stmt->execute([':id' => $id]);` | Ejecuta la sentencia SQL preparada vinculando los parámetros correspondientes: `$stmt->execute([':id' => $id]);`. |
| `40` | `return $stmt->fetch(PDO::FETCH_ASSOC);` | Recupera una única fila o registro resultante de la consulta. |
| `41` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `42` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `43` | `public function crear(array $datos): int\|false` | Declaración de método o función con su firma y parámetros: `public function crear(array $datos): int\|false`. |
| `44` | ``{`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `45` | `try {` | Instrucción de ejecución en el contexto del script: `try {`. |
| `46` | `$stmt = $this->conn->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmt = $this->conn->prepare(`. |
| `47` | `"INSERT INTO {$this->tabla} (nombre, ubicacion, capacidad, descripcion)` | Instrucción de ejecución en el contexto del script: `"INSERT INTO {$this->tabla} (nombre, ubicacion, capacidad, descripcion)`. |
| `48` | `VALUES (:nombre, :ubicacion, :capacidad, :descripcion)"` | Instrucción de ejecución en el contexto del script: `VALUES (:nombre, :ubicacion, :capacidad, :descripcion)"`. |
| `49` | ``);`` | Cierre de estructura de arreglo o invocación de función. |
| `50` | `$stmt->execute([` | Ejecuta la sentencia SQL preparada vinculando los parámetros correspondientes: `$stmt->execute([`. |
| `51` | `':nombre'      => $datos['nombre'],` | Instrucción de ejecución en el contexto del script: `':nombre'      => $datos['nombre'],`. |
| `52` | `':ubicacion'   => $datos['ubicacion']   ?? null,` | Instrucción de ejecución en el contexto del script: `':ubicacion'   => $datos['ubicacion']   ?? null,`. |
| `53` | `':capacidad'   => $datos['capacidad']   ?? null,` | Instrucción de ejecución en el contexto del script: `':capacidad'   => $datos['capacidad']   ?? null,`. |
| `54` | `':descripcion' => $datos['descripcion'] ?? null,` | Instrucción de ejecución en el contexto del script: `':descripcion' => $datos['descripcion'] ?? null,`. |
| `55` | `]);` | Instrucción de ejecución en el contexto del script: `]);`. |
| `56` | `return (int) $this->conn->lastInsertId();` | Instrucción de retorno que finaliza la ejecución entregando el resultado: `return (int) $this->conn->lastInsertId();`. |
| `57` | `} catch (Exception $e) {` | Instrucción de ejecución en el contexto del script: `} catch (Exception $e) {`. |
| `58` | `return false;` | Instrucción de retorno que finaliza la ejecución entregando el resultado: `return false;`. |
| `59` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `60` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `61` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `62` | `public function actualizar(int $id, array $datos): bool` | Declaración de método o función con su firma y parámetros: `public function actualizar(int $id, array $datos): bool`. |
| `63` | ``{`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `64` | `$stmt = $this->conn->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmt = $this->conn->prepare(`. |
| `65` | `"UPDATE {$this->tabla}` | Instrucción de ejecución en el contexto del script: `"UPDATE {$this->tabla}`. |
| `66` | `SET nombre = :nombre, ubicacion = :ubicacion,` | Instrucción de ejecución en el contexto del script: `SET nombre = :nombre, ubicacion = :ubicacion,`. |
| `67` | `capacidad = :capacidad, descripcion = :descripcion` | Instrucción de ejecución en el contexto del script: `capacidad = :capacidad, descripcion = :descripcion`. |
| `68` | `WHERE id_modulo = :id"` | Instrucción de ejecución en el contexto del script: `WHERE id_modulo = :id"`. |
| `69` | ``);`` | Cierre de estructura de arreglo o invocación de función. |
| `70` | `return $stmt->execute([` | Ejecuta la sentencia SQL preparada vinculando los parámetros correspondientes: `return $stmt->execute([`. |
| `71` | `':nombre'      => $datos['nombre'],` | Instrucción de ejecución en el contexto del script: `':nombre'      => $datos['nombre'],`. |
| `72` | `':ubicacion'   => $datos['ubicacion']   ?? null,` | Instrucción de ejecución en el contexto del script: `':ubicacion'   => $datos['ubicacion']   ?? null,`. |
| `73` | `':capacidad'   => $datos['capacidad']   ?? null,` | Instrucción de ejecución en el contexto del script: `':capacidad'   => $datos['capacidad']   ?? null,`. |
| `74` | `':descripcion' => $datos['descripcion'] ?? null,` | Instrucción de ejecución en el contexto del script: `':descripcion' => $datos['descripcion'] ?? null,`. |
| `75` | `':id'          => $id,` | Instrucción de ejecución en el contexto del script: `':id'          => $id,`. |
| `76` | `]);` | Instrucción de ejecución en el contexto del script: `]);`. |
| `77` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `78` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `79` | `public function estaAsignadoEnPeriodo(int $idModulo, string $fechaInicio...` | Declaración de método o función con su firma y parámetros: `public function estaAsignadoEnPeriodo(int $idModulo, string $fechaInicio...`. |
| `80` | ``{`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `81` | `$sql = "SELECT id_asignacion FROM asignaciones` | Instrucción de ejecución en el contexto del script: `$sql = "SELECT id_asignacion FROM asignaciones`. |
| `82` | `WHERE id_modulo = :id AND estado = 'Activa'` | Instrucción de ejecución en el contexto del script: `WHERE id_modulo = :id AND estado = 'Activa'`. |
| `83` | `AND NOT (fecha_fin < :inicio OR fecha_inicio > :fin)";` | Instrucción de ejecución en el contexto del script: `AND NOT (fecha_fin < :inicio OR fecha_inicio > :fin)";`. |
| `84` | `if ($excluirAsig) $sql .= " AND id_asignacion != :excluir";` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if ($excluirAsig) $sql .= " AND id_asignacion != :excluir";`. |
| `85` | `$stmt = $this->conn->prepare($sql);` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmt = $this->conn->prepare($sql);`. |
| `86` | `$params = [':id' => $idModulo, ':inicio' => $fechaInicio, ':fin' => $fec...` | Instrucción de ejecución en el contexto del script: `$params = [':id' => $idModulo, ':inicio' => $fechaInicio, ':fin' => $fec...`. |
| `87` | `if ($excluirAsig) $params[':excluir'] = $excluirAsig;` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if ($excluirAsig) $params[':excluir'] = $excluirAsig;`. |
| `88` | `$stmt->execute($params);` | Ejecuta la sentencia SQL preparada vinculando los parámetros correspondientes: `$stmt->execute($params);`. |
| `89` | `return $stmt->rowCount() > 0;` | Instrucción de retorno que finaliza la ejecución entregando el resultado: `return $stmt->rowCount() > 0;`. |
| `90` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `91` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `92` | `/**` | Comentario multilínea de documentación o aclaración técnica. |
| `93` | `* Verifica que la ficha ya no tenga una asignación activa.` | Comentario multilínea de documentación o aclaración técnica. |
| `94` | `* Cada ficha solo puede tener UN módulo asignado a la vez.` | Comentario multilínea de documentación o aclaración técnica. |
| `95` | `*/` | Comentario multilínea de documentación o aclaración técnica. |
| `96` | `public function fichaYaTieneAsignacion(int $idFicha, ?int $excluirAsig =...` | Declaración de método o función con su firma y parámetros: `public function fichaYaTieneAsignacion(int $idFicha, ?int $excluirAsig =...`. |
| `97` | ``{`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `98` | `$sql = "SELECT id_asignacion FROM asignaciones` | Instrucción de ejecución en el contexto del script: `$sql = "SELECT id_asignacion FROM asignaciones`. |
| `99` | `WHERE id_ficha = :fic AND estado = 'Activa'";` | Instrucción de ejecución en el contexto del script: `WHERE id_ficha = :fic AND estado = 'Activa'";`. |
| `100` | `if ($excluirAsig) $sql .= " AND id_asignacion != :excluir";` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if ($excluirAsig) $sql .= " AND id_asignacion != :excluir";`. |
| `101` | `$stmt = $this->conn->prepare($sql);` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmt = $this->conn->prepare($sql);`. |
| `102` | `$params = [':fic' => $idFicha];` | Instrucción de ejecución en el contexto del script: `$params = [':fic' => $idFicha];`. |
| `103` | `if ($excluirAsig) $params[':excluir'] = $excluirAsig;` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if ($excluirAsig) $params[':excluir'] = $excluirAsig;`. |
| `104` | `$stmt->execute($params);` | Ejecuta la sentencia SQL preparada vinculando los parámetros correspondientes: `$stmt->execute($params);`. |
| `105` | `return $stmt->rowCount() > 0;` | Instrucción de retorno que finaliza la ejecución entregando el resultado: `return $stmt->rowCount() > 0;`. |
| `106` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `107` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `108` | `public function crearAsignacion(array $datos): int\|false` | Declaración de método o función con su firma y parámetros: `public function crearAsignacion(array $datos): int\|false`. |
| `109` | ``{`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `110` | `try {` | Instrucción de ejecución en el contexto del script: `try {`. |
| `111` | `$stmt = $this->conn->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmt = $this->conn->prepare(`. |
| `112` | `"INSERT INTO asignaciones` | Instrucción de ejecución en el contexto del script: `"INSERT INTO asignaciones`. |
| `113` | `(id_modulo, id_ficha, fecha_inicio, fecha_fin, fecha_limite_evidencia)` | Instrucción de ejecución en el contexto del script: `(id_modulo, id_ficha, fecha_inicio, fecha_fin, fecha_limite_evidencia)`. |
| `114` | `VALUES (:id_modulo, :id_ficha, :inicio, :fin, :limite)"` | Instrucción de ejecución en el contexto del script: `VALUES (:id_modulo, :id_ficha, :inicio, :fin, :limite)"`. |
| `115` | ``);`` | Cierre de estructura de arreglo o invocación de función. |
| `116` | `$stmt->execute([` | Ejecuta la sentencia SQL preparada vinculando los parámetros correspondientes: `$stmt->execute([`. |
| `117` | `':id_modulo' => $datos['id_modulo'],` | Instrucción de ejecución en el contexto del script: `':id_modulo' => $datos['id_modulo'],`. |
| `118` | `':id_ficha'  => $datos['id_ficha'],` | Instrucción de ejecución en el contexto del script: `':id_ficha'  => $datos['id_ficha'],`. |
| `119` | `':inicio'    => $datos['fecha_inicio'],` | Instrucción de ejecución en el contexto del script: `':inicio'    => $datos['fecha_inicio'],`. |
| `120` | `':fin'       => $datos['fecha_fin'],` | Instrucción de ejecución en el contexto del script: `':fin'       => $datos['fecha_fin'],`. |
| `121` | `':limite'    => $datos['fecha_limite_evidencia'],` | Instrucción de ejecución en el contexto del script: `':limite'    => $datos['fecha_limite_evidencia'],`. |
| `122` | `]);` | Instrucción de ejecución en el contexto del script: `]);`. |
| `123` | `return (int) $this->conn->lastInsertId();` | Instrucción de retorno que finaliza la ejecución entregando el resultado: `return (int) $this->conn->lastInsertId();`. |
| `124` | `} catch (Exception $e) {` | Instrucción de ejecución en el contexto del script: `} catch (Exception $e) {`. |
| `125` | `return false;` | Instrucción de retorno que finaliza la ejecución entregando el resultado: `return false;`. |
| `126` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `127` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `128` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `129` | `public function obtenerAsignaciones(array $filtros = []): array` | Declaración de método o función con su firma y parámetros: `public function obtenerAsignaciones(array $filtros = []): array`. |
| `130` | ``{`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `131` | `$where = ['1=1'];` | Instrucción de ejecución en el contexto del script: `$where = ['1=1'];`. |
| `132` | `$params = [];` | Instrucción de ejecución en el contexto del script: `$params = [];`. |
| `133` | `if (!empty($filtros['estado'])) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (!empty($filtros['estado'])) {`. |
| `134` | `$where[] = 'a.estado = :estado';` | Instrucción de ejecución en el contexto del script: `$where[] = 'a.estado = :estado';`. |
| `135` | `$params[':estado'] = $filtros['estado'];` | Instrucción de ejecución en el contexto del script: `$params[':estado'] = $filtros['estado'];`. |
| `136` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `137` | `if (!empty($filtros['id_ficha'])) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (!empty($filtros['id_ficha'])) {`. |
| `138` | `$where[] = 'a.id_ficha = :id_ficha';` | Instrucción de ejecución en el contexto del script: `$where[] = 'a.id_ficha = :id_ficha';`. |
| `139` | `$params[':id_ficha'] = $filtros['id_ficha'];` | Instrucción de ejecución en el contexto del script: `$params[':id_ficha'] = $filtros['id_ficha'];`. |
| `140` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `141` | `$whereStr = implode(' AND ', $where);` | Instrucción de ejecución en el contexto del script: `$whereStr = implode(' AND ', $where);`. |
| `142` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `143` | `$stmt = $this->conn->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmt = $this->conn->prepare(`. |
| `144` | `"SELECT a.*,` | Instrucción de ejecución en el contexto del script: `"SELECT a.*,`. |
| `145` | `m.nombre AS nombre_modulo,` | Instrucción de ejecución en el contexto del script: `m.nombre AS nombre_modulo,`. |
| `146` | `f.numero_ficha, p.nombre AS nombre_programa,` | Instrucción de ejecución en el contexto del script: `f.numero_ficha, p.nombre AS nombre_programa,`. |
| `147` | `ANY_VALUE(v.nombres)   AS vocero_nombres,` | Instrucción de ejecución en el contexto del script: `ANY_VALUE(v.nombres)   AS vocero_nombres,`. |
| `148` | `ANY_VALUE(v.apellidos) AS vocero_apellidos,` | Instrucción de ejecución en el contexto del script: `ANY_VALUE(v.apellidos) AS vocero_apellidos,`. |
| `149` | `(SELECT COUNT(*) FROM evidencias e` | Instrucción de ejecución en el contexto del script: `(SELECT COUNT(*) FROM evidencias e`. |
| `150` | `JOIN grupos g ON g.id_grupo = e.id_grupo` | Instrucción de ejecución en el contexto del script: `JOIN grupos g ON g.id_grupo = e.id_grupo`. |
| `151` | `WHERE g.id_asignacion = a.id_asignacion) AS total_evidencias` | Instrucción de ejecución en el contexto del script: `WHERE g.id_asignacion = a.id_asignacion) AS total_evidencias`. |
| `152` | `FROM asignaciones a` | Instrucción de ejecución en el contexto del script: `FROM asignaciones a`. |
| `153` | `JOIN modulos   m ON m.id_modulo   = a.id_modulo` | Instrucción de ejecución en el contexto del script: `JOIN modulos   m ON m.id_modulo   = a.id_modulo`. |
| `154` | `JOIN fichas    f ON f.id_ficha    = a.id_ficha` | Instrucción de ejecución en el contexto del script: `JOIN fichas    f ON f.id_ficha    = a.id_ficha`. |
| `155` | `JOIN programas p ON p.id_programa = f.id_programa` | Instrucción de ejecución en el contexto del script: `JOIN programas p ON p.id_programa = f.id_programa`. |
| `156` | `LEFT JOIN voceros v ON v.id_ficha = a.id_ficha AND v.activo = 1` | Instrucción de ejecución en el contexto del script: `LEFT JOIN voceros v ON v.id_ficha = a.id_ficha AND v.activo = 1`. |
| `157` | `WHERE {$whereStr}` | Instrucción de ejecución en el contexto del script: `WHERE {$whereStr}`. |
| `158` | `GROUP BY a.id_asignacion` | Instrucción de ejecución en el contexto del script: `GROUP BY a.id_asignacion`. |
| `159` | `ORDER BY a.fecha_limite_evidencia DESC"` | Instrucción de ejecución en el contexto del script: `ORDER BY a.fecha_limite_evidencia DESC"`. |
| `160` | ``);`` | Cierre de estructura de arreglo o invocación de función. |
| `161` | `$stmt->execute($params);` | Ejecuta la sentencia SQL preparada vinculando los parámetros correspondientes: `$stmt->execute($params);`. |
| `162` | `return $stmt->fetchAll(PDO::FETCH_ASSOC);` | Obtiene todos los registros coincidentes de la consulta en un arreglo asociativo. |
| `163` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `164` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `165` | `public function eliminar(int $id): bool` | Declaración de método o función con su firma y parámetros: `public function eliminar(int $id): bool`. |
| `166` | ``{`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `167` | `$stmt = $this->conn->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmt = $this->conn->prepare(`. |
| `168` | `"UPDATE {$this->tabla} SET activo = 0 WHERE id_modulo = :id"` | Instrucción de ejecución en el contexto del script: `"UPDATE {$this->tabla} SET activo = 0 WHERE id_modulo = :id"`. |
| `169` | ``);`` | Cierre de estructura de arreglo o invocación de función. |
| `170` | `return $stmt->execute([':id' => $id]);` | Ejecuta la sentencia SQL preparada vinculando los parámetros correspondientes: `return $stmt->execute([':id' => $id]);`. |
| `171` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `172` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `173` | ``?>`` | Cierre de la etiqueta PHP para alternar a salida HTML o fin del archivo. |

---

## 3. Resumen y Flujo de Interacción

El archivo `Modulo.php` cumple un rol indispensable en `models/Modulo.php`. 
Modelo de datos para la administración de módulos/ambientes físicos de formación y asignación de fichas encargadas de su limpieza. Garantiza la robustez, el orden y la estabilidad de la arquitectura del proyecto `systemLimpieza`.

---

Generado automáticamente para el repositorio [johanrepizo/LimpiezaDeModulos](https://github.com/johanrepizo/LimpiezaDeModulos).
