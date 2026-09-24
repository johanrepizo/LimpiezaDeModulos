# Documentación Línea por Línea: `models/Evidencia.php`

## 1. Ficha Técnica del Archivo

- **Archivo:** `Evidencia.php`
- **Ruta en el proyecto:** `models/Evidencia.php`
- **Cantidad total de líneas:** `133`
- **Tipo de archivo:** `PHP`
- **Propósito general:** Modelo de datos para registrar, consultar y validar evidencias fotográficas de limpieza subidas por los voceros de las fichas.

---

## 2. Explicación Detallada Línea por Línea

A continuación se presenta cada línea de código numerada de forma consecutiva, acompañada de su fragmento exacto y la explicación exhaustiva de su funcionamiento y responsabilidad en el sistema:

| Línea | Código Fuente | Explicación Detallada |
|---|---|---|
| `1` | `<?php` | Apertura obligatoria de la etiqueta PHP para ejecución del código del lado del servidor. |
| `2` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `3` | `class Evidencia` | Declaración de la clase del componente: `class Evidencia`. |
| `4` | `{` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `5` | `    private $conn;` | Propiedad `private` `$conn` para el estado interno de la clase. |
| `6` | `    private $tabla = "evidencias";` | Propiedad `private` `$tabla` inicializado en `"evidencias"` para el estado interno de la clase. |
| `7` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `8` | `    public function __construct($db)` | Declaración de método o función con su firma y parámetros: `public function __construct($db)`. |
| `9` | `    {` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `10` | `        $this->conn = $db;` | Instrucción de ejecución en el contexto del script: `$this->conn = $db;`. |
| `11` | `    }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `12` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `13` | `    public function obtenerPorVocero(int $idVocero, ?int $idAsignacion = nu...` | Declaración de método o función con su firma y parámetros: `public function obtenerPorVocero(int $idVocero, ?int $idAsignacion = null): array`. |
| `14` | `    {` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `15` | `        $where  = 'e.id_vocero = :id';` | Instrucción de ejecución en el contexto del script: `$where  = 'e.id_vocero = :id';`. |
| `16` | `        $params = [':id' => $idVocero];` | Instrucción de ejecución en el contexto del script: `$params = [':id' => $idVocero];`. |
| `17` | `        if ($idAsignacion) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if ($idAsignacion) {`. |
| `18` | `            $where .= ' AND a.id_asignacion = :asig';` | Instrucción de ejecución en el contexto del script: `$where .= ' AND a.id_asignacion = :asig';`. |
| `19` | `            $params[':asig'] = $idAsignacion;` | Instrucción de ejecución en el contexto del script: `$params[':asig'] = $idAsignacion;`. |
| `20` | `        }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `21` | `        $stmt = $this->conn->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmt = $this->conn->prepare(`. |
| `22` | `            "SELECT e.*,` | Instrucción de ejecución en el contexto del script: `"SELECT e.*,`. |
| `23` | `                    g.nombre_grupo, g.fecha_limpieza,` | Instrucción de ejecución en el contexto del script: `g.nombre_grupo, g.fecha_limpieza,`. |
| `24` | `                    m.nombre AS nombre_modulo,` | Instrucción de ejecución en el contexto del script: `m.nombre AS nombre_modulo,`. |
| `25` | `                    f.numero_ficha` | Instrucción de ejecución en el contexto del script: `f.numero_ficha`. |
| `26` | `             FROM {$this->tabla} e` | Instrucción de ejecución en el contexto del script: `FROM {$this->tabla} e`. |
| `27` | `             JOIN grupos g ON g.id_grupo = e.id_grupo` | Instrucción de ejecución en el contexto del script: `JOIN grupos g ON g.id_grupo = e.id_grupo`. |
| `28` | `             JOIN asignaciones a ON a.id_asignacion = g.id_asignacion` | Instrucción de ejecución en el contexto del script: `JOIN asignaciones a ON a.id_asignacion = g.id_asignacion`. |
| `29` | `             JOIN modulos m ON m.id_modulo = a.id_modulo` | Instrucción de ejecución en el contexto del script: `JOIN modulos m ON m.id_modulo = a.id_modulo`. |
| `30` | `             JOIN fichas  f ON f.id_ficha  = a.id_ficha` | Instrucción de ejecución en el contexto del script: `JOIN fichas  f ON f.id_ficha  = a.id_ficha`. |
| `31` | `             WHERE {$where}` | Instrucción de ejecución en el contexto del script: `WHERE {$where}`. |
| `32` | `             ORDER BY e.fecha_subida DESC"` | Instrucción de ejecución en el contexto del script: `ORDER BY e.fecha_subida DESC"`. |
| `33` | `        );` | Instrucción de ejecución en el contexto del script: `);`. |
| `34` | `        $stmt->execute($params);` | Ejecuta la sentencia SQL preparada vinculando los datos correspondientes: `$stmt->execute($params);`. |
| `35` | `        return $stmt->fetchAll(PDO::FETCH_ASSOC);` | Retorna el valor resultante de la expresión y culmina la ejecución de la función actual: `return $stmt->fetchAll(PDO::FETCH_ASSOC);`. |
| `36` | `    }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `37` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `38` | `    public function obtenerPorGrupo(int $idGrupo): array\|false` | Declaración de método o función con su firma y parámetros: `public function obtenerPorGrupo(int $idGrupo): array\|false`. |
| `39` | `    {` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `40` | `        $stmt = $this->conn->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmt = $this->conn->prepare(`. |
| `41` | `            "SELECT * FROM {$this->tabla} WHERE id_grupo = :id ORDER BY fec...` | Instrucción de ejecución en el contexto del script: `"SELECT * FROM {$this->tabla} WHERE id_grupo = :id ORDER BY fecha_subida DESC LIMIT 1"`. |
| `42` | `        );` | Instrucción de ejecución en el contexto del script: `);`. |
| `43` | `        $stmt->execute([':id' => $idGrupo]);` | Ejecuta la sentencia SQL preparada vinculando los datos correspondientes: `$stmt->execute([':id' => $idGrupo]);`. |
| `44` | `        return $stmt->fetch(PDO::FETCH_ASSOC);` | Retorna el valor resultante de la expresión y culmina la ejecución de la función actual: `return $stmt->fetch(PDO::FETCH_ASSOC);`. |
| `45` | `    }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `46` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `47` | `    public function grupoTieneEvidencia(int $idGrupo): bool` | Declaración de método o función con su firma y parámetros: `public function grupoTieneEvidencia(int $idGrupo): bool`. |
| `48` | `    {` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `49` | `        $stmt = $this->conn->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmt = $this->conn->prepare(`. |
| `50` | `            "SELECT id_evidencia FROM {$this->tabla} WHERE id_grupo = :id L...` | Instrucción de ejecución en el contexto del script: `"SELECT id_evidencia FROM {$this->tabla} WHERE id_grupo = :id LIMIT 1"`. |
| `51` | `        );` | Instrucción de ejecución en el contexto del script: `);`. |
| `52` | `        $stmt->execute([':id' => $idGrupo]);` | Ejecuta la sentencia SQL preparada vinculando los datos correspondientes: `$stmt->execute([':id' => $idGrupo]);`. |
| `53` | `        return $stmt->rowCount() > 0;` | Retorna el valor resultante de la expresión y culmina la ejecución de la función actual: `return $stmt->rowCount() > 0;`. |
| `54` | `    }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `55` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `56` | `    public function registrar(array $datos): int\|false` | Declaración de método o función con su firma y parámetros: `public function registrar(array $datos): int\|false`. |
| `57` | `    {` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `58` | `        try {` | Inicia bloque de captura de excepciones `try` para ejecución segura de operaciones críticas. |
| `59` | `            $stmt = $this->conn->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmt = $this->conn->prepare(`. |
| `60` | `                "INSERT INTO {$this->tabla} (id_grupo, id_vocero, nombre_ar...` | Instrucción de ejecución en el contexto del script: `"INSERT INTO {$this->tabla} (id_grupo, id_vocero, nombre_archivo, ruta_archivo)`. |
| `61` | `                 VALUES (:id_grupo, :id_vocero, :nombre_archivo, :ruta_arch...` | Instrucción de ejecución en el contexto del script: `VALUES (:id_grupo, :id_vocero, :nombre_archivo, :ruta_archivo)"`. |
| `62` | `            );` | Instrucción de ejecución en el contexto del script: `);`. |
| `63` | `            $stmt->execute([` | Ejecuta la sentencia SQL preparada vinculando los datos correspondientes: `$stmt->execute([`. |
| `64` | `                ':id_grupo'       => $datos['id_grupo'],` | Instrucción de ejecución en el contexto del script: `':id_grupo'       => $datos['id_grupo'],`. |
| `65` | `                ':id_vocero'      => $datos['id_vocero'],` | Instrucción de ejecución en el contexto del script: `':id_vocero'      => $datos['id_vocero'],`. |
| `66` | `                ':nombre_archivo' => $datos['nombre_archivo'],` | Instrucción de ejecución en el contexto del script: `':nombre_archivo' => $datos['nombre_archivo'],`. |
| `67` | `                ':ruta_archivo'   => $datos['ruta_archivo'],` | Instrucción de ejecución en el contexto del script: `':ruta_archivo'   => $datos['ruta_archivo'],`. |
| `68` | `            ]);` | Instrucción de ejecución en el contexto del script: `]);`. |
| `69` | `            return (int) $this->conn->lastInsertId();` | Retorna el valor resultante de la expresión y culmina la ejecución de la función actual: `return (int) $this->conn->lastInsertId();`. |
| `70` | `        } catch (Exception $e) {` | Captura y manejo de excepciones en caso de fallo durante el bloque protegido: `} catch (Exception $e) {`. |
| `71` | `            return false;` | Retorna el valor resultante de la expresión y culmina la ejecución de la función actual: `return false;`. |
| `72` | `        }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `73` | `    }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `74` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `75` | `    public function obtenerTodas(array $filtros = []): array` | Declaración de método o función con su firma y parámetros: `public function obtenerTodas(array $filtros = []): array`. |
| `76` | `    {` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `77` | `        $where  = ['1=1'];` | Instrucción de ejecución en el contexto del script: `$where  = ['1=1'];`. |
| `78` | `        $params = [];` | Instrucción de ejecución en el contexto del script: `$params = [];`. |
| `79` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `80` | `        if (!empty($filtros['id_ficha'])) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (!empty($filtros['id_ficha'])) {`. |
| `81` | `            $where[] = 'a.id_ficha = :id_ficha';` | Instrucción de ejecución en el contexto del script: `$where[] = 'a.id_ficha = :id_ficha';`. |
| `82` | `            $params[':id_ficha'] = $filtros['id_ficha'];` | Instrucción de ejecución en el contexto del script: `$params[':id_ficha'] = $filtros['id_ficha'];`. |
| `83` | `        }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `84` | `        if (!empty($filtros['id_vocero'])) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (!empty($filtros['id_vocero'])) {`. |
| `85` | `            $where[] = 'e.id_vocero = :id_vocero';` | Instrucción de ejecución en el contexto del script: `$where[] = 'e.id_vocero = :id_vocero';`. |
| `86` | `            $params[':id_vocero'] = $filtros['id_vocero'];` | Instrucción de ejecución en el contexto del script: `$params[':id_vocero'] = $filtros['id_vocero'];`. |
| `87` | `        }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `88` | `        if (!empty($filtros['fecha_desde'])) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (!empty($filtros['fecha_desde'])) {`. |
| `89` | `            $where[] = 'DATE(e.fecha_subida) >= :desde';` | Instrucción de ejecución en el contexto del script: `$where[] = 'DATE(e.fecha_subida) >= :desde';`. |
| `90` | `            $params[':desde'] = $filtros['fecha_desde'];` | Instrucción de ejecución en el contexto del script: `$params[':desde'] = $filtros['fecha_desde'];`. |
| `91` | `        }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `92` | `        if (!empty($filtros['fecha_hasta'])) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (!empty($filtros['fecha_hasta'])) {`. |
| `93` | `            $where[] = 'DATE(e.fecha_subida) <= :hasta';` | Instrucción de ejecución en el contexto del script: `$where[] = 'DATE(e.fecha_subida) <= :hasta';`. |
| `94` | `            $params[':hasta'] = $filtros['fecha_hasta'];` | Instrucción de ejecución en el contexto del script: `$params[':hasta'] = $filtros['fecha_hasta'];`. |
| `95` | `        }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `96` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `97` | `        $whereStr = implode(' AND ', $where);` | Instrucción de ejecución en el contexto del script: `$whereStr = implode(' AND ', $where);`. |
| `98` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `99` | `        $stmt = $this->conn->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmt = $this->conn->prepare(`. |
| `100` | `            "SELECT e.*,` | Instrucción de ejecución en el contexto del script: `"SELECT e.*,`. |
| `101` | `                    g.nombre_grupo, g.fecha_limpieza,` | Instrucción de ejecución en el contexto del script: `g.nombre_grupo, g.fecha_limpieza,`. |
| `102` | `                    m.nombre AS nombre_modulo,` | Instrucción de ejecución en el contexto del script: `m.nombre AS nombre_modulo,`. |
| `103` | `                    f.numero_ficha,` | Instrucción de ejecución en el contexto del script: `f.numero_ficha,`. |
| `104` | `                    v.nombres AS vocero_nombres, v.apellidos AS vocero_apel...` | Instrucción de ejecución en el contexto del script: `v.nombres AS vocero_nombres, v.apellidos AS vocero_apellidos`. |
| `105` | `             FROM {$this->tabla} e` | Instrucción de ejecución en el contexto del script: `FROM {$this->tabla} e`. |
| `106` | `             JOIN grupos g ON g.id_grupo = e.id_grupo` | Instrucción de ejecución en el contexto del script: `JOIN grupos g ON g.id_grupo = e.id_grupo`. |
| `107` | `             JOIN asignaciones a ON a.id_asignacion = g.id_asignacion` | Instrucción de ejecución en el contexto del script: `JOIN asignaciones a ON a.id_asignacion = g.id_asignacion`. |
| `108` | `             JOIN modulos  m ON m.id_modulo  = a.id_modulo` | Instrucción de ejecución en el contexto del script: `JOIN modulos  m ON m.id_modulo  = a.id_modulo`. |
| `109` | `             JOIN fichas   f ON f.id_ficha   = a.id_ficha` | Instrucción de ejecución en el contexto del script: `JOIN fichas   f ON f.id_ficha   = a.id_ficha`. |
| `110` | `             JOIN voceros  v ON v.id_vocero  = e.id_vocero` | Instrucción de ejecución en el contexto del script: `JOIN voceros  v ON v.id_vocero  = e.id_vocero`. |
| `111` | `             WHERE {$whereStr}` | Instrucción de ejecución en el contexto del script: `WHERE {$whereStr}`. |
| `112` | `             ORDER BY e.fecha_subida DESC"` | Instrucción de ejecución en el contexto del script: `ORDER BY e.fecha_subida DESC"`. |
| `113` | `        );` | Instrucción de ejecución en el contexto del script: `);`. |
| `114` | `        $stmt->execute($params);` | Ejecuta la sentencia SQL preparada vinculando los datos correspondientes: `$stmt->execute($params);`. |
| `115` | `        return $stmt->fetchAll(PDO::FETCH_ASSOC);` | Retorna el valor resultante de la expresión y culmina la ejecución de la función actual: `return $stmt->fetchAll(PDO::FETCH_ASSOC);`. |
| `116` | `    }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `117` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `118` | `    public function resumenPorAsignacion(int $idAsignacion): array` | Declaración de método o función con su firma y parámetros: `public function resumenPorAsignacion(int $idAsignacion): array`. |
| `119` | `    {` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `120` | `        $stmt = $this->conn->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmt = $this->conn->prepare(`. |
| `121` | `            "SELECT g.id_grupo, g.nombre_grupo, g.fecha_limpieza,` | Instrucción de ejecución en el contexto del script: `"SELECT g.id_grupo, g.nombre_grupo, g.fecha_limpieza,`. |
| `122` | `                    v.nombres AS vocero_nombres, v.apellidos AS vocero_apel...` | Instrucción de ejecución en el contexto del script: `v.nombres AS vocero_nombres, v.apellidos AS vocero_apellidos,`. |
| `123` | `                    (SELECT COUNT(*) FROM evidencias e2 WHERE e2.id_grupo =...` | Instrucción de ejecución en el contexto del script: `(SELECT COUNT(*) FROM evidencias e2 WHERE e2.id_grupo = g.id_grupo) AS tiene_evidencia`. |
| `124` | `             FROM grupos g` | Instrucción de ejecución en el contexto del script: `FROM grupos g`. |
| `125` | `             JOIN voceros v ON v.id_vocero = g.id_vocero` | Instrucción de ejecución en el contexto del script: `JOIN voceros v ON v.id_vocero = g.id_vocero`. |
| `126` | `             WHERE g.id_asignacion = :id` | Instrucción de ejecución en el contexto del script: `WHERE g.id_asignacion = :id`. |
| `127` | `             ORDER BY g.fecha_limpieza"` | Instrucción de ejecución en el contexto del script: `ORDER BY g.fecha_limpieza"`. |
| `128` | `        );` | Instrucción de ejecución en el contexto del script: `);`. |
| `129` | `        $stmt->execute([':id' => $idAsignacion]);` | Ejecuta la sentencia SQL preparada vinculando los datos correspondientes: `$stmt->execute([':id' => $idAsignacion]);`. |
| `130` | `        return $stmt->fetchAll(PDO::FETCH_ASSOC);` | Retorna el valor resultante de la expresión y culmina la ejecución de la función actual: `return $stmt->fetchAll(PDO::FETCH_ASSOC);`. |
| `131` | `    }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `132` | `}` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `133` | `?>` | Cierre de la etiqueta PHP para alternar a salida HTML o fin del archivo. |

---

## 3. Resumen y Flujo de Interacción

El archivo `Evidencia.php` cumple un rol indispensable en `models/Evidencia.php`. 
Modelo de datos para registrar, consultar y validar evidencias fotográficas de limpieza subidas por los voceros de las fichas. Garantiza la robustez, el orden y la estabilidad de la arquitectura del proyecto `systemLimpieza`.
