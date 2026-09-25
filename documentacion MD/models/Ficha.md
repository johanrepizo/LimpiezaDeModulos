# Documentación Línea por Línea: `models/Ficha.php`

## 1. Ficha Técnica del Archivo

- **Archivo:** `Ficha.php`
- **Ruta en el proyecto:** `models/Ficha.php`
- **Cantidad total de líneas:** `120`
- **Tipo de archivo:** `PHP`
- **Propósito general:** Modelo de datos para la gestión académica de fichas de formación del SENA, aprendices asignados y vinculación con programas.

---

## 2. Explicación Detallada Línea por Línea

A continuación se presenta cada línea de código numerada de forma consecutiva, acompañada de su fragmento exacto y la explicación exhaustiva de su funcionamiento y responsabilidad en el sistema:

| Línea | Código Fuente | Explicación Detallada |
|---|---|---|
| `1` | ``<?php`` | Apertura obligatoria de la etiqueta PHP para ejecución del código del lado del servidor. |
| `2` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `3` | `class Ficha` | Declaración de la clase del componente: `class Ficha`. |
| `4` | ``{`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `5` | `private $conn;` | Definición de propiedad de clase para el estado interno del componente: `private $conn;`. |
| `6` | `private $tabla = "fichas";` | Definición de propiedad de clase para el estado interno del componente: `private $tabla = "fichas";`. |
| `7` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `8` | `public function __construct($db)` | Declaración de método o función con su firma y parámetros: `public function __construct($db)`. |
| `9` | ``{`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `10` | `$this->conn = $db;` | Instrucción de ejecución en el contexto del script: `$this->conn = $db;`. |
| `11` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `12` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `13` | `public function obtenerTodas(): array` | Declaración de método o función con su firma y parámetros: `public function obtenerTodas(): array`. |
| `14` | ``{`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `15` | `$stmt = $this->conn->query(` | Instrucción de ejecución en el contexto del script: `$stmt = $this->conn->query(`. |
| `16` | `"SELECT f.*, p.nombre AS nombre_programa,` | Instrucción de ejecución en el contexto del script: `"SELECT f.*, p.nombre AS nombre_programa,`. |
| `17` | `ANY_VALUE(v.nombres)   AS vocero_nombres,` | Instrucción de ejecución en el contexto del script: `ANY_VALUE(v.nombres)   AS vocero_nombres,`. |
| `18` | `ANY_VALUE(v.apellidos) AS vocero_apellidos,` | Instrucción de ejecución en el contexto del script: `ANY_VALUE(v.apellidos) AS vocero_apellidos,`. |
| `19` | `COUNT(DISTINCT a.id_aprendiz) AS total_aprendices` | Instrucción de ejecución en el contexto del script: `COUNT(DISTINCT a.id_aprendiz) AS total_aprendices`. |
| `20` | `FROM {$this->tabla} f` | Instrucción de ejecución en el contexto del script: `FROM {$this->tabla} f`. |
| `21` | `LEFT JOIN programas p ON p.id_programa = f.id_programa` | Instrucción de ejecución en el contexto del script: `LEFT JOIN programas p ON p.id_programa = f.id_programa`. |
| `22` | `LEFT JOIN voceros   v ON v.id_ficha    = f.id_ficha AND v.activo = 1` | Instrucción de ejecución en el contexto del script: `LEFT JOIN voceros   v ON v.id_ficha    = f.id_ficha AND v.activo = 1`. |
| `23` | `LEFT JOIN aprendices a ON a.id_ficha   = f.id_ficha AND a.activo = 1` | Instrucción de ejecución en el contexto del script: `LEFT JOIN aprendices a ON a.id_ficha   = f.id_ficha AND a.activo = 1`. |
| `24` | `WHERE f.activo = 1` | Instrucción de ejecución en el contexto del script: `WHERE f.activo = 1`. |
| `25` | `GROUP BY f.id_ficha` | Instrucción de ejecución en el contexto del script: `GROUP BY f.id_ficha`. |
| `26` | `ORDER BY f.numero_ficha"` | Instrucción de ejecución en el contexto del script: `ORDER BY f.numero_ficha"`. |
| `27` | ``);`` | Cierre de estructura de arreglo o invocación de función. |
| `28` | `return $stmt->fetchAll(PDO::FETCH_ASSOC);` | Obtiene todos los registros coincidentes de la consulta en un arreglo asociativo. |
| `29` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `30` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `31` | `public function obtenerPorId(int $id): array\|false` | Declaración de método o función con su firma y parámetros: `public function obtenerPorId(int $id): array\|false`. |
| `32` | ``{`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `33` | `$stmt = $this->conn->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmt = $this->conn->prepare(`. |
| `34` | `"SELECT f.*, p.nombre AS nombre_programa` | Instrucción de ejecución en el contexto del script: `"SELECT f.*, p.nombre AS nombre_programa`. |
| `35` | `FROM {$this->tabla} f` | Instrucción de ejecución en el contexto del script: `FROM {$this->tabla} f`. |
| `36` | `LEFT JOIN programas p ON p.id_programa = f.id_programa` | Instrucción de ejecución en el contexto del script: `LEFT JOIN programas p ON p.id_programa = f.id_programa`. |
| `37` | `WHERE f.id_ficha = :id LIMIT 1"` | Instrucción de ejecución en el contexto del script: `WHERE f.id_ficha = :id LIMIT 1"`. |
| `38` | ``);`` | Cierre de estructura de arreglo o invocación de función. |
| `39` | `$stmt->execute([':id' => $id]);` | Ejecuta la sentencia SQL preparada vinculando los parámetros correspondientes: `$stmt->execute([':id' => $id]);`. |
| `40` | `return $stmt->fetch(PDO::FETCH_ASSOC);` | Recupera una única fila o registro resultante de la consulta. |
| `41` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `42` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `43` | `public function obtenerAprendicesDeFicha(int $idFicha): array` | Declaración de método o función con su firma y parámetros: `public function obtenerAprendicesDeFicha(int $idFicha): array`. |
| `44` | ``{`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `45` | `$stmt = $this->conn->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmt = $this->conn->prepare(`. |
| `46` | `"SELECT * FROM aprendices` | Instrucción de ejecución en el contexto del script: `"SELECT * FROM aprendices`. |
| `47` | `WHERE id_ficha = :id AND activo = 1` | Instrucción de ejecución en el contexto del script: `WHERE id_ficha = :id AND activo = 1`. |
| `48` | `ORDER BY apellidos, nombres"` | Instrucción de ejecución en el contexto del script: `ORDER BY apellidos, nombres"`. |
| `49` | ``);`` | Cierre de estructura de arreglo o invocación de función. |
| `50` | `$stmt->execute([':id' => $idFicha]);` | Ejecuta la sentencia SQL preparada vinculando los parámetros correspondientes: `$stmt->execute([':id' => $idFicha]);`. |
| `51` | `return $stmt->fetchAll(PDO::FETCH_ASSOC);` | Obtiene todos los registros coincidentes de la consulta en un arreglo asociativo. |
| `52` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `53` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `54` | `public function existeDuplicado(string $numero, int $idPrograma, ?int $e...` | Declaración de método o función con su firma y parámetros: `public function existeDuplicado(string $numero, int $idPrograma, ?int $e...`. |
| `55` | ``{`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `56` | `$sql = "SELECT id_ficha FROM {$this->tabla}` | Instrucción de ejecución en el contexto del script: `$sql = "SELECT id_ficha FROM {$this->tabla}`. |
| `57` | `WHERE numero_ficha = :numero AND id_programa = :prog AND activo = 1";` | Instrucción de ejecución en el contexto del script: `WHERE numero_ficha = :numero AND id_programa = :prog AND activo = 1";`. |
| `58` | `if ($excluirId) $sql .= " AND id_ficha != :excluir";` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if ($excluirId) $sql .= " AND id_ficha != :excluir";`. |
| `59` | `$stmt = $this->conn->prepare($sql);` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmt = $this->conn->prepare($sql);`. |
| `60` | `$params = [':numero' => $numero, ':prog' => $idPrograma];` | Instrucción de ejecución en el contexto del script: `$params = [':numero' => $numero, ':prog' => $idPrograma];`. |
| `61` | `if ($excluirId) $params[':excluir'] = $excluirId;` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if ($excluirId) $params[':excluir'] = $excluirId;`. |
| `62` | `$stmt->execute($params);` | Ejecuta la sentencia SQL preparada vinculando los parámetros correspondientes: `$stmt->execute($params);`. |
| `63` | `return $stmt->rowCount() > 0;` | Instrucción de retorno que finaliza la ejecución entregando el resultado: `return $stmt->rowCount() > 0;`. |
| `64` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `65` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `66` | `public function crear(array $datos): int\|false` | Declaración de método o función con su firma y parámetros: `public function crear(array $datos): int\|false`. |
| `67` | ``{`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `68` | `try {` | Instrucción de ejecución en el contexto del script: `try {`. |
| `69` | `$stmt = $this->conn->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmt = $this->conn->prepare(`. |
| `70` | `"INSERT INTO {$this->tabla} (id_programa, numero_ficha, jornada, num_apr...` | Instrucción de ejecución en el contexto del script: `"INSERT INTO {$this->tabla} (id_programa, numero_ficha, jornada, num_apr...`. |
| `71` | `VALUES (:id_programa, :numero_ficha, :jornada, :num_aprendices)"` | Instrucción de ejecución en el contexto del script: `VALUES (:id_programa, :numero_ficha, :jornada, :num_aprendices)"`. |
| `72` | ``);`` | Cierre de estructura de arreglo o invocación de función. |
| `73` | `$stmt->execute([` | Ejecuta la sentencia SQL preparada vinculando los parámetros correspondientes: `$stmt->execute([`. |
| `74` | `':id_programa'    => $datos['id_programa'],` | Instrucción de ejecución en el contexto del script: `':id_programa'    => $datos['id_programa'],`. |
| `75` | `':numero_ficha'   => $datos['numero_ficha'],` | Instrucción de ejecución en el contexto del script: `':numero_ficha'   => $datos['numero_ficha'],`. |
| `76` | `':jornada'        => $datos['jornada']        ?? 'Diurna',` | Instrucción de ejecución en el contexto del script: `':jornada'        => $datos['jornada']        ?? 'Diurna',`. |
| `77` | `':num_aprendices' => $datos['num_aprendices'] ?? null,` | Instrucción de ejecución en el contexto del script: `':num_aprendices' => $datos['num_aprendices'] ?? null,`. |
| `78` | `]);` | Instrucción de ejecución en el contexto del script: `]);`. |
| `79` | `return (int) $this->conn->lastInsertId();` | Instrucción de retorno que finaliza la ejecución entregando el resultado: `return (int) $this->conn->lastInsertId();`. |
| `80` | `} catch (Exception $e) {` | Instrucción de ejecución en el contexto del script: `} catch (Exception $e) {`. |
| `81` | `return false;` | Instrucción de retorno que finaliza la ejecución entregando el resultado: `return false;`. |
| `82` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `83` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `84` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `85` | `public function actualizar(int $id, array $datos): bool` | Declaración de método o función con su firma y parámetros: `public function actualizar(int $id, array $datos): bool`. |
| `86` | ``{`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `87` | `$stmt = $this->conn->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmt = $this->conn->prepare(`. |
| `88` | `"UPDATE {$this->tabla}` | Instrucción de ejecución en el contexto del script: `"UPDATE {$this->tabla}`. |
| `89` | `SET id_programa = :id_programa, numero_ficha = :numero_ficha,` | Instrucción de ejecución en el contexto del script: `SET id_programa = :id_programa, numero_ficha = :numero_ficha,`. |
| `90` | `jornada = :jornada, num_aprendices = :num_aprendices` | Instrucción de ejecución en el contexto del script: `jornada = :jornada, num_aprendices = :num_aprendices`. |
| `91` | `WHERE id_ficha = :id"` | Instrucción de ejecución en el contexto del script: `WHERE id_ficha = :id"`. |
| `92` | ``);`` | Cierre de estructura de arreglo o invocación de función. |
| `93` | `return $stmt->execute([` | Ejecuta la sentencia SQL preparada vinculando los parámetros correspondientes: `return $stmt->execute([`. |
| `94` | `':id_programa'    => $datos['id_programa'],` | Instrucción de ejecución en el contexto del script: `':id_programa'    => $datos['id_programa'],`. |
| `95` | `':numero_ficha'   => $datos['numero_ficha'],` | Instrucción de ejecución en el contexto del script: `':numero_ficha'   => $datos['numero_ficha'],`. |
| `96` | `':jornada'        => $datos['jornada']        ?? 'Diurna',` | Instrucción de ejecución en el contexto del script: `':jornada'        => $datos['jornada']        ?? 'Diurna',`. |
| `97` | `':num_aprendices' => $datos['num_aprendices'] ?? null,` | Instrucción de ejecución en el contexto del script: `':num_aprendices' => $datos['num_aprendices'] ?? null,`. |
| `98` | `':id'             => $id,` | Instrucción de ejecución en el contexto del script: `':id'             => $id,`. |
| `99` | `]);` | Instrucción de ejecución en el contexto del script: `]);`. |
| `100` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `101` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `102` | `public function tieneAsignacionesActivas(int $id): bool` | Declaración de método o función con su firma y parámetros: `public function tieneAsignacionesActivas(int $id): bool`. |
| `103` | ``{`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `104` | `$stmt = $this->conn->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmt = $this->conn->prepare(`. |
| `105` | `"SELECT id_asignacion FROM asignaciones` | Instrucción de ejecución en el contexto del script: `"SELECT id_asignacion FROM asignaciones`. |
| `106` | `WHERE id_ficha = :id AND estado = 'Activa' LIMIT 1"` | Instrucción de ejecución en el contexto del script: `WHERE id_ficha = :id AND estado = 'Activa' LIMIT 1"`. |
| `107` | ``);`` | Cierre de estructura de arreglo o invocación de función. |
| `108` | `$stmt->execute([':id' => $id]);` | Ejecuta la sentencia SQL preparada vinculando los parámetros correspondientes: `$stmt->execute([':id' => $id]);`. |
| `109` | `return $stmt->rowCount() > 0;` | Instrucción de retorno que finaliza la ejecución entregando el resultado: `return $stmt->rowCount() > 0;`. |
| `110` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `111` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `112` | `public function eliminar(int $id): bool` | Declaración de método o función con su firma y parámetros: `public function eliminar(int $id): bool`. |
| `113` | ``{`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `114` | `$stmt = $this->conn->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmt = $this->conn->prepare(`. |
| `115` | `"UPDATE {$this->tabla} SET activo = 0 WHERE id_ficha = :id"` | Instrucción de ejecución en el contexto del script: `"UPDATE {$this->tabla} SET activo = 0 WHERE id_ficha = :id"`. |
| `116` | ``);`` | Cierre de estructura de arreglo o invocación de función. |
| `117` | `return $stmt->execute([':id' => $id]);` | Ejecuta la sentencia SQL preparada vinculando los parámetros correspondientes: `return $stmt->execute([':id' => $id]);`. |
| `118` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `119` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `120` | ``?>`` | Cierre de la etiqueta PHP para alternar a salida HTML o fin del archivo. |

---

## 3. Resumen y Flujo de Interacción

El archivo `Ficha.php` cumple un rol indispensable en `models/Ficha.php`. 
Modelo de datos para la gestión académica de fichas de formación del SENA, aprendices asignados y vinculación con programas. Garantiza la robustez, el orden y la estabilidad de la arquitectura del proyecto `systemLimpieza`.

---

Generado automáticamente para el repositorio [johanrepizo/LimpiezaDeModulos](https://github.com/johanrepizo/LimpiezaDeModulos).
