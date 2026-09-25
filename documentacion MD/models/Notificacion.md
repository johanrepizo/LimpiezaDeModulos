# Documentación Línea por Línea: `models/Notificacion.php`

## 1. Ficha Técnica del Archivo

- **Archivo:** `Notificacion.php`
- **Ruta en el proyecto:** `models/Notificacion.php`
- **Cantidad total de líneas:** `95`
- **Tipo de archivo:** `PHP`
- **Propósito general:** Modelo de datos para la emisión, consulta y actualización de estado (leído/no leído) de alertas y notificaciones del sistema.

---

## 2. Explicación Detallada Línea por Línea

A continuación se presenta cada línea de código numerada de forma consecutiva, acompañada de su fragmento exacto y la explicación exhaustiva de su funcionamiento y responsabilidad en el sistema:

| Línea | Código Fuente | Explicación Detallada |
|---|---|---|
| `1` | ``<?php`` | Apertura obligatoria de la etiqueta PHP para ejecución del código del lado del servidor. |
| `2` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `3` | `class Notificacion` | Declaración de la clase del componente: `class Notificacion`. |
| `4` | ``{`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `5` | `private $conn;` | Definición de propiedad de clase para el estado interno del componente: `private $conn;`. |
| `6` | `private $tabla = "notificaciones";` | Definición de propiedad de clase para el estado interno del componente: `private $tabla = "notificaciones";`. |
| `7` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `8` | `public function __construct($db)` | Declaración de método o función con su firma y parámetros: `public function __construct($db)`. |
| `9` | ``{`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `10` | `$this->conn = $db;` | Instrucción de ejecución en el contexto del script: `$this->conn = $db;`. |
| `11` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `12` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `13` | `public function crear(array $datos): bool` | Declaración de método o función con su firma y parámetros: `public function crear(array $datos): bool`. |
| `14` | ``{`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `15` | `$stmt = $this->conn->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmt = $this->conn->prepare(`. |
| `16` | `"INSERT INTO {$this->tabla} (id_usuario, id_asignacion, tipo, titulo, me...` | Instrucción de ejecución en el contexto del script: `"INSERT INTO {$this->tabla} (id_usuario, id_asignacion, tipo, titulo, me...`. |
| `17` | `VALUES (:id_usuario, :id_asignacion, :tipo, :titulo, :mensaje)"` | Instrucción de ejecución en el contexto del script: `VALUES (:id_usuario, :id_asignacion, :tipo, :titulo, :mensaje)"`. |
| `18` | ``);`` | Cierre de estructura de arreglo o invocación de función. |
| `19` | `return $stmt->execute([` | Ejecuta la sentencia SQL preparada vinculando los parámetros correspondientes: `return $stmt->execute([`. |
| `20` | `':id_usuario'    => $datos['id_usuario'],` | Instrucción de ejecución en el contexto del script: `':id_usuario'    => $datos['id_usuario'],`. |
| `21` | `':id_asignacion' => $datos['id_asignacion'] ?? null,` | Instrucción de ejecución en el contexto del script: `':id_asignacion' => $datos['id_asignacion'] ?? null,`. |
| `22` | `':tipo'          => $datos['tipo']          ?? 'info',` | Instrucción de ejecución en el contexto del script: `':tipo'          => $datos['tipo']          ?? 'info',`. |
| `23` | `':titulo'        => $datos['titulo'],` | Instrucción de ejecución en el contexto del script: `':titulo'        => $datos['titulo'],`. |
| `24` | `':mensaje'       => $datos['mensaje'],` | Instrucción de ejecución en el contexto del script: `':mensaje'       => $datos['mensaje'],`. |
| `25` | `]);` | Instrucción de ejecución en el contexto del script: `]);`. |
| `26` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `27` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `28` | `public function obtenerPorUsuario(int $idUsuario, bool $soloNoLeidas = f...` | Declaración de método o función con su firma y parámetros: `public function obtenerPorUsuario(int $idUsuario, bool $soloNoLeidas = f...`. |
| `29` | ``{`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `30` | `$sql = "SELECT * FROM {$this->tabla}` | Instrucción de ejecución en el contexto del script: `$sql = "SELECT * FROM {$this->tabla}`. |
| `31` | `WHERE id_usuario = :id";` | Instrucción de ejecución en el contexto del script: `WHERE id_usuario = :id";`. |
| `32` | `if ($soloNoLeidas) $sql .= " AND leida = 0";` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if ($soloNoLeidas) $sql .= " AND leida = 0";`. |
| `33` | `$sql .= " ORDER BY fecha DESC";` | Instrucción de ejecución en el contexto del script: `$sql .= " ORDER BY fecha DESC";`. |
| `34` | `$stmt = $this->conn->prepare($sql);` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmt = $this->conn->prepare($sql);`. |
| `35` | `$stmt->execute([':id' => $idUsuario]);` | Ejecuta la sentencia SQL preparada vinculando los parámetros correspondientes: `$stmt->execute([':id' => $idUsuario]);`. |
| `36` | `return $stmt->fetchAll(PDO::FETCH_ASSOC);` | Obtiene todos los registros coincidentes de la consulta en un arreglo asociativo. |
| `37` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `38` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `39` | `public function contarNoLeidas(int $idUsuario): int` | Declaración de método o función con su firma y parámetros: `public function contarNoLeidas(int $idUsuario): int`. |
| `40` | ``{`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `41` | `$stmt = $this->conn->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmt = $this->conn->prepare(`. |
| `42` | `"SELECT COUNT(*) FROM {$this->tabla}` | Instrucción de ejecución en el contexto del script: `"SELECT COUNT(*) FROM {$this->tabla}`. |
| `43` | `WHERE id_usuario = :id AND leida = 0"` | Instrucción de ejecución en el contexto del script: `WHERE id_usuario = :id AND leida = 0"`. |
| `44` | ``);`` | Cierre de estructura de arreglo o invocación de función. |
| `45` | `$stmt->execute([':id' => $idUsuario]);` | Ejecuta la sentencia SQL preparada vinculando los parámetros correspondientes: `$stmt->execute([':id' => $idUsuario]);`. |
| `46` | `return (int) $stmt->fetchColumn();` | Recupera el valor escalar de la primera columna del resultado de la consulta. |
| `47` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `48` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `49` | `public function marcarLeida(int $idNotificacion): bool` | Declaración de método o función con su firma y parámetros: `public function marcarLeida(int $idNotificacion): bool`. |
| `50` | ``{`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `51` | `$stmt = $this->conn->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmt = $this->conn->prepare(`. |
| `52` | `"UPDATE {$this->tabla} SET leida = 1 WHERE id_notificacion = :id"` | Instrucción de ejecución en el contexto del script: `"UPDATE {$this->tabla} SET leida = 1 WHERE id_notificacion = :id"`. |
| `53` | ``);`` | Cierre de estructura de arreglo o invocación de función. |
| `54` | `return $stmt->execute([':id' => $idNotificacion]);` | Ejecuta la sentencia SQL preparada vinculando los parámetros correspondientes: `return $stmt->execute([':id' => $idNotificacion]);`. |
| `55` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `56` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `57` | `public function marcarTodasLeidas(int $idUsuario): bool` | Declaración de método o función con su firma y parámetros: `public function marcarTodasLeidas(int $idUsuario): bool`. |
| `58` | ``{`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `59` | `$stmt = $this->conn->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmt = $this->conn->prepare(`. |
| `60` | `"UPDATE {$this->tabla} SET leida = 1 WHERE id_usuario = :id"` | Instrucción de ejecución en el contexto del script: `"UPDATE {$this->tabla} SET leida = 1 WHERE id_usuario = :id"`. |
| `61` | ``);`` | Cierre de estructura de arreglo o invocación de función. |
| `62` | `return $stmt->execute([':id' => $idUsuario]);` | Ejecuta la sentencia SQL preparada vinculando los parámetros correspondientes: `return $stmt->execute([':id' => $idUsuario]);`. |
| `63` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `64` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `65` | `public function obtenerHistorialIncumplimientos(int $idUsuario, array $f...` | Declaración de método o función con su firma y parámetros: `public function obtenerHistorialIncumplimientos(int $idUsuario, array $f...`. |
| `66` | ``{`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `67` | `$where  = ['n.id_usuario = :id', "n.tipo = 'incumplimiento'"];` | Instrucción de ejecución en el contexto del script: `$where  = ['n.id_usuario = :id', "n.tipo = 'incumplimiento'"];`. |
| `68` | `$params = [':id' => $idUsuario];` | Instrucción de ejecución en el contexto del script: `$params = [':id' => $idUsuario];`. |
| `69` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `70` | `if (!empty($filtros['fecha_desde'])) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (!empty($filtros['fecha_desde'])) {`. |
| `71` | `$where[] = 'DATE(n.fecha) >= :desde';` | Instrucción de ejecución en el contexto del script: `$where[] = 'DATE(n.fecha) >= :desde';`. |
| `72` | `$params[':desde'] = $filtros['fecha_desde'];` | Instrucción de ejecución en el contexto del script: `$params[':desde'] = $filtros['fecha_desde'];`. |
| `73` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `74` | `if (!empty($filtros['fecha_hasta'])) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (!empty($filtros['fecha_hasta'])) {`. |
| `75` | `$where[] = 'DATE(n.fecha) <= :hasta';` | Instrucción de ejecución en el contexto del script: `$where[] = 'DATE(n.fecha) <= :hasta';`. |
| `76` | `$params[':hasta'] = $filtros['fecha_hasta'];` | Instrucción de ejecución en el contexto del script: `$params[':hasta'] = $filtros['fecha_hasta'];`. |
| `77` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `78` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `79` | `$whereStr = implode(' AND ', $where);` | Instrucción de ejecución en el contexto del script: `$whereStr = implode(' AND ', $where);`. |
| `80` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `81` | `$stmt = $this->conn->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmt = $this->conn->prepare(`. |
| `82` | `"SELECT n.*,` | Instrucción de ejecución en el contexto del script: `"SELECT n.*,`. |
| `83` | `a.id_ficha, f.numero_ficha, m.nombre AS nombre_modulo` | Instrucción de ejecución en el contexto del script: `a.id_ficha, f.numero_ficha, m.nombre AS nombre_modulo`. |
| `84` | `FROM {$this->tabla} n` | Instrucción de ejecución en el contexto del script: `FROM {$this->tabla} n`. |
| `85` | `LEFT JOIN asignaciones a ON a.id_asignacion = n.id_asignacion` | Instrucción de ejecución en el contexto del script: `LEFT JOIN asignaciones a ON a.id_asignacion = n.id_asignacion`. |
| `86` | `LEFT JOIN fichas  f ON f.id_ficha  = a.id_ficha` | Instrucción de ejecución en el contexto del script: `LEFT JOIN fichas  f ON f.id_ficha  = a.id_ficha`. |
| `87` | `LEFT JOIN modulos m ON m.id_modulo = a.id_modulo` | Instrucción de ejecución en el contexto del script: `LEFT JOIN modulos m ON m.id_modulo = a.id_modulo`. |
| `88` | `WHERE {$whereStr}` | Instrucción de ejecución en el contexto del script: `WHERE {$whereStr}`. |
| `89` | `ORDER BY n.fecha DESC"` | Instrucción de ejecución en el contexto del script: `ORDER BY n.fecha DESC"`. |
| `90` | ``);`` | Cierre de estructura de arreglo o invocación de función. |
| `91` | `$stmt->execute($params);` | Ejecuta la sentencia SQL preparada vinculando los parámetros correspondientes: `$stmt->execute($params);`. |
| `92` | `return $stmt->fetchAll(PDO::FETCH_ASSOC);` | Obtiene todos los registros coincidentes de la consulta en un arreglo asociativo. |
| `93` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `94` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `95` | ``?>`` | Cierre de la etiqueta PHP para alternar a salida HTML o fin del archivo. |

---

## 3. Resumen y Flujo de Interacción

El archivo `Notificacion.php` cumple un rol indispensable en `models/Notificacion.php`. 
Modelo de datos para la emisión, consulta y actualización de estado (leído/no leído) de alertas y notificaciones del sistema. Garantiza la robustez, el orden y la estabilidad de la arquitectura del proyecto `systemLimpieza`.

---

Generado automáticamente para el repositorio [johanrepizo/LimpiezaDeModulos](https://github.com/johanrepizo/LimpiezaDeModulos).
