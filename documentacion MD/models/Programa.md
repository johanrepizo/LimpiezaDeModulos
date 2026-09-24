# Documentación Línea por Línea: `models/Programa.php`

## 1. Ficha Técnica del Archivo

- **Archivo:** `Programa.php`
- **Ruta en el proyecto:** `models/Programa.php`
- **Cantidad total de líneas:** `96`
- **Tipo de archivo:** `PHP`
- **Propósito general:** Modelo de datos para la administración de programas formativos del centro (nombre, nivel y descripción técnica).

---

## 2. Explicación Detallada Línea por Línea

A continuación se presenta cada línea de código numerada de forma consecutiva, acompañada de su fragmento exacto y la explicación exhaustiva de su funcionamiento y responsabilidad en el sistema:

| Línea | Código Fuente | Explicación Detallada |
|---|---|---|
| `1` | `<?php` | Apertura obligatoria de la etiqueta PHP para ejecución del código del lado del servidor. |
| `2` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `3` | `class Programa` | Declaración de la clase del componente: `class Programa`. |
| `4` | `{` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `5` | `    private $conn;` | Propiedad `private` `$conn` para el estado interno de la clase. |
| `6` | `    private $tabla = "programas";` | Propiedad `private` `$tabla` inicializado en `"programas"` para el estado interno de la clase. |
| `7` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `8` | `    public function __construct($db)` | Declaración de método o función con su firma y parámetros: `public function __construct($db)`. |
| `9` | `    {` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `10` | `        $this->conn = $db;` | Instrucción de ejecución en el contexto del script: `$this->conn = $db;`. |
| `11` | `    }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `12` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `13` | `    public function obtenerTodos(): array` | Declaración de método o función con su firma y parámetros: `public function obtenerTodos(): array`. |
| `14` | `    {` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `15` | `        $stmt = $this->conn->query(` | Instrucción de ejecución en el contexto del script: `$stmt = $this->conn->query(`. |
| `16` | `            "SELECT p.*, COUNT(f.id_ficha) AS total_fichas` | Instrucción de ejecución en el contexto del script: `"SELECT p.*, COUNT(f.id_ficha) AS total_fichas`. |
| `17` | `             FROM {$this->tabla} p` | Instrucción de ejecución en el contexto del script: `FROM {$this->tabla} p`. |
| `18` | `             LEFT JOIN fichas f ON f.id_programa = p.id_programa AND f.acti...` | Instrucción de ejecución en el contexto del script: `LEFT JOIN fichas f ON f.id_programa = p.id_programa AND f.activo = 1`. |
| `19` | `             GROUP BY p.id_programa` | Instrucción de ejecución en el contexto del script: `GROUP BY p.id_programa`. |
| `20` | `             ORDER BY p.nombre"` | Instrucción de ejecución en el contexto del script: `ORDER BY p.nombre"`. |
| `21` | `        );` | Instrucción de ejecución en el contexto del script: `);`. |
| `22` | `        return $stmt->fetchAll(PDO::FETCH_ASSOC);` | Retorna el valor resultante de la expresión y culmina la ejecución de la función actual: `return $stmt->fetchAll(PDO::FETCH_ASSOC);`. |
| `23` | `    }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `24` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `25` | `    public function obtenerPorId(int $id): array\|false` | Declaración de método o función con su firma y parámetros: `public function obtenerPorId(int $id): array\|false`. |
| `26` | `    {` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `27` | `        $stmt = $this->conn->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmt = $this->conn->prepare(`. |
| `28` | `            "SELECT * FROM {$this->tabla} WHERE id_programa = :id LIMIT 1"` | Instrucción de ejecución en el contexto del script: `"SELECT * FROM {$this->tabla} WHERE id_programa = :id LIMIT 1"`. |
| `29` | `        );` | Instrucción de ejecución en el contexto del script: `);`. |
| `30` | `        $stmt->execute([':id' => $id]);` | Ejecuta la sentencia SQL preparada vinculando los datos correspondientes: `$stmt->execute([':id' => $id]);`. |
| `31` | `        return $stmt->fetch(PDO::FETCH_ASSOC);` | Retorna el valor resultante de la expresión y culmina la ejecución de la función actual: `return $stmt->fetch(PDO::FETCH_ASSOC);`. |
| `32` | `    }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `33` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `34` | `    public function crear(array $datos): int\|false` | Declaración de método o función con su firma y parámetros: `public function crear(array $datos): int\|false`. |
| `35` | `    {` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `36` | `        try {` | Inicia bloque de captura de excepciones `try` para ejecución segura de operaciones críticas. |
| `37` | `            $stmt = $this->conn->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmt = $this->conn->prepare(`. |
| `38` | `                "INSERT INTO {$this->tabla} (nombre, descripcion, nivel)` | Instrucción de ejecución en el contexto del script: `"INSERT INTO {$this->tabla} (nombre, descripcion, nivel)`. |
| `39` | `                 VALUES (:nombre, :descripcion, :nivel)"` | Instrucción de ejecución en el contexto del script: `VALUES (:nombre, :descripcion, :nivel)"`. |
| `40` | `            );` | Instrucción de ejecución en el contexto del script: `);`. |
| `41` | `            $stmt->execute([` | Ejecuta la sentencia SQL preparada vinculando los datos correspondientes: `$stmt->execute([`. |
| `42` | `                ':nombre'      => $datos['nombre'],` | Instrucción de ejecución en el contexto del script: `':nombre'      => $datos['nombre'],`. |
| `43` | `                ':descripcion' => $datos['descripcion'] ?? null,` | Instrucción de ejecución en el contexto del script: `':descripcion' => $datos['descripcion'] ?? null,`. |
| `44` | `                ':nivel'       => $datos['nivel']       ?? null,` | Instrucción de ejecución en el contexto del script: `':nivel'       => $datos['nivel']       ?? null,`. |
| `45` | `            ]);` | Instrucción de ejecución en el contexto del script: `]);`. |
| `46` | `            return (int) $this->conn->lastInsertId();` | Retorna el valor resultante de la expresión y culmina la ejecución de la función actual: `return (int) $this->conn->lastInsertId();`. |
| `47` | `        } catch (Exception $e) {` | Captura y manejo de excepciones en caso de fallo durante el bloque protegido: `} catch (Exception $e) {`. |
| `48` | `            return false;` | Retorna el valor resultante de la expresión y culmina la ejecución de la función actual: `return false;`. |
| `49` | `        }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `50` | `    }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `51` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `52` | `    public function actualizar(int $id, array $datos): bool` | Declaración de método o función con su firma y parámetros: `public function actualizar(int $id, array $datos): bool`. |
| `53` | `    {` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `54` | `        $stmt = $this->conn->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmt = $this->conn->prepare(`. |
| `55` | `            "UPDATE {$this->tabla}` | Instrucción de ejecución en el contexto del script: `"UPDATE {$this->tabla}`. |
| `56` | `             SET nombre = :nombre, descripcion = :descripcion, nivel = :nivel` | Instrucción de ejecución en el contexto del script: `SET nombre = :nombre, descripcion = :descripcion, nivel = :nivel`. |
| `57` | `             WHERE id_programa = :id"` | Instrucción de ejecución en el contexto del script: `WHERE id_programa = :id"`. |
| `58` | `        );` | Instrucción de ejecución en el contexto del script: `);`. |
| `59` | `        return $stmt->execute([` | Retorna el valor resultante de la expresión y culmina la ejecución de la función actual: `return $stmt->execute([`. |
| `60` | `            ':nombre'      => $datos['nombre'],` | Instrucción de ejecución en el contexto del script: `':nombre'      => $datos['nombre'],`. |
| `61` | `            ':descripcion' => $datos['descripcion'] ?? null,` | Instrucción de ejecución en el contexto del script: `':descripcion' => $datos['descripcion'] ?? null,`. |
| `62` | `            ':nivel'       => $datos['nivel']       ?? null,` | Instrucción de ejecución en el contexto del script: `':nivel'       => $datos['nivel']       ?? null,`. |
| `63` | `            ':id'          => $id,` | Instrucción de ejecución en el contexto del script: `':id'          => $id,`. |
| `64` | `        ]);` | Instrucción de ejecución en el contexto del script: `]);`. |
| `65` | `    }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `66` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `67` | `    public function tieneFichasActivas(int $id): bool` | Declaración de método o función con su firma y parámetros: `public function tieneFichasActivas(int $id): bool`. |
| `68` | `    {` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `69` | `        $stmt = $this->conn->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmt = $this->conn->prepare(`. |
| `70` | `            "SELECT id_ficha FROM fichas WHERE id_programa = :id AND activo...` | Instrucción de ejecución en el contexto del script: `"SELECT id_ficha FROM fichas WHERE id_programa = :id AND activo = 1 LIMIT 1"`. |
| `71` | `        );` | Instrucción de ejecución en el contexto del script: `);`. |
| `72` | `        $stmt->execute([':id' => $id]);` | Ejecuta la sentencia SQL preparada vinculando los datos correspondientes: `$stmt->execute([':id' => $id]);`. |
| `73` | `        return $stmt->rowCount() > 0;` | Retorna el valor resultante de la expresión y culmina la ejecución de la función actual: `return $stmt->rowCount() > 0;`. |
| `74` | `    }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `75` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `76` | `    public function eliminar(int $id): bool` | Declaración de método o función con su firma y parámetros: `public function eliminar(int $id): bool`. |
| `77` | `    {` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `78` | `        $stmt = $this->conn->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmt = $this->conn->prepare(`. |
| `79` | `            "UPDATE {$this->tabla} SET activo = 0 WHERE id_programa = :id"` | Instrucción de ejecución en el contexto del script: `"UPDATE {$this->tabla} SET activo = 0 WHERE id_programa = :id"`. |
| `80` | `        );` | Instrucción de ejecución en el contexto del script: `);`. |
| `81` | `        return $stmt->execute([':id' => $id]);` | Retorna el valor resultante de la expresión y culmina la ejecución de la función actual: `return $stmt->execute([':id' => $id]);`. |
| `82` | `    }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `83` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `84` | `    public function buscar(string $termino): array` | Declaración de método o función con su firma y parámetros: `public function buscar(string $termino): array`. |
| `85` | `    {` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `86` | `        $like = '%' . $termino . '%';` | Instrucción de ejecución en el contexto del script: `$like = '%' . $termino . '%';`. |
| `87` | `        $stmt = $this->conn->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmt = $this->conn->prepare(`. |
| `88` | `            "SELECT * FROM {$this->tabla}` | Instrucción de ejecución en el contexto del script: `"SELECT * FROM {$this->tabla}`. |
| `89` | `             WHERE (nombre LIKE :t OR nivel LIKE :t2) AND activo = 1` | Instrucción de ejecución en el contexto del script: `WHERE (nombre LIKE :t OR nivel LIKE :t2) AND activo = 1`. |
| `90` | `             ORDER BY nombre"` | Instrucción de ejecución en el contexto del script: `ORDER BY nombre"`. |
| `91` | `        );` | Instrucción de ejecución en el contexto del script: `);`. |
| `92` | `        $stmt->execute([':t' => $like, ':t2' => $like]);` | Ejecuta la sentencia SQL preparada vinculando los datos correspondientes: `$stmt->execute([':t' => $like, ':t2' => $like]);`. |
| `93` | `        return $stmt->fetchAll(PDO::FETCH_ASSOC);` | Retorna el valor resultante de la expresión y culmina la ejecución de la función actual: `return $stmt->fetchAll(PDO::FETCH_ASSOC);`. |
| `94` | `    }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `95` | `}` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `96` | `?>` | Cierre de la etiqueta PHP para alternar a salida HTML o fin del archivo. |

---

## 3. Resumen y Flujo de Interacción

El archivo `Programa.php` cumple un rol indispensable en `models/Programa.php`. 
Modelo de datos para la administración de programas formativos del centro (nombre, nivel y descripción técnica). Garantiza la robustez, el orden y la estabilidad de la arquitectura del proyecto `systemLimpieza`.
