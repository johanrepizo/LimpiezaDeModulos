# Documentación Línea por Línea: `models/Modulo.php`

## 1. Ficha Técnica del Archivo

- **Archivo:** `Modulo.php`
- **Ruta en el proyecto:** `models/Modulo.php`
- **Cantidad total de líneas:** `167`
- **Tipo de archivo:** `PHP`
- **Propósito general:** Modelo de datos para la administración de módulos/ambientes físicos de formación y asignación de fichas encargadas de su limpieza.

---

## 2. Explicación Detallada Línea por Línea

A continuación se presenta cada línea de código numerada de forma consecutiva, acompañada de su fragmento exacto y la explicación exhaustiva de su funcionamiento y responsabilidad en el sistema:

| Línea | Código Fuente | Explicación Detallada |
|---|---|---|
| `1` | `<?php` | Apertura obligatoria de la etiqueta PHP para ejecución del código del lado del servidor. |
| `2` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `3` | `class Modulo` | Declaración de la clase del componente: `class Modulo`. |
| `4` | `{` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `5` | `    private $conn;` | Propiedad `private` `$conn` para el estado interno de la clase. |
| `6` | `    private $tabla = "modulos";` | Propiedad `private` `$tabla` inicializado en `"modulos"` para el estado interno de la clase. |
| `7` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `8` | `    public function __construct($db)` | Declaración de método o función con su firma y parámetros: `public function __construct($db)`. |
| `9` | `    {` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `10` | `        $this->conn = $db;` | Instrucción de ejecución en el contexto del script: `$this->conn = $db;`. |
| `11` | `    }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `12` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `13` | `    public function obtenerTodos(): array` | Declaración de método o función con su firma y parámetros: `public function obtenerTodos(): array`. |
| `14` | `    {` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `15` | `        $stmt = $this->conn->query(` | Instrucción de ejecución en el contexto del script: `$stmt = $this->conn->query(`. |
| `16` | `            "SELECT m.*,` | Instrucción de ejecución en el contexto del script: `"SELECT m.*,`. |
| `17` | `                    a.id_asignacion, a.estado AS estado_asignacion,` | Instrucción de ejecución en el contexto del script: `a.id_asignacion, a.estado AS estado_asignacion,`. |
| `18` | `                    a.fecha_limite_evidencia,` | Instrucción de ejecución en el contexto del script: `a.fecha_limite_evidencia,`. |
| `19` | `                    f.numero_ficha,` | Instrucción de ejecución en el contexto del script: `f.numero_ficha,`. |
| `20` | `                    v.nombres AS vocero_nombres, v.apellidos AS vocero_apel...` | Instrucción de ejecución en el contexto del script: `v.nombres AS vocero_nombres, v.apellidos AS vocero_apellidos`. |
| `21` | `             FROM {$this->tabla} m` | Instrucción de ejecución en el contexto del script: `FROM {$this->tabla} m`. |
| `22` | `             LEFT JOIN asignaciones a ON a.id_modulo = m.id_modulo AND a.es...` | Instrucción de ejecución en el contexto del script: `LEFT JOIN asignaciones a ON a.id_modulo = m.id_modulo AND a.estado = 'Activa'`. |
| `23` | `             LEFT JOIN fichas   f ON f.id_ficha    = a.id_ficha` | Instrucción de ejecución en el contexto del script: `LEFT JOIN fichas   f ON f.id_ficha    = a.id_ficha`. |
| `24` | `             LEFT JOIN voceros  v ON v.id_ficha    = a.id_ficha AND v.activ...` | Instrucción de ejecución en el contexto del script: `LEFT JOIN voceros  v ON v.id_ficha    = a.id_ficha AND v.activo = 1`. |
| `25` | `             WHERE m.activo = 1` | Instrucción de ejecución en el contexto del script: `WHERE m.activo = 1`. |
| `26` | `             ORDER BY m.nombre"` | Instrucción de ejecución en el contexto del script: `ORDER BY m.nombre"`. |
| `27` | `        );` | Instrucción de ejecución en el contexto del script: `);`. |
| `28` | `        return $stmt->fetchAll(PDO::FETCH_ASSOC);` | Retorna el valor resultante de la expresión y culmina la ejecución de la función actual: `return $stmt->fetchAll(PDO::FETCH_ASSOC);`. |
| `29` | `    }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `30` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `31` | `    public function obtenerPorId(int $id): array\|false` | Declaración de método o función con su firma y parámetros: `public function obtenerPorId(int $id): array\|false`. |
| `32` | `    {` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `33` | `        $stmt = $this->conn->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmt = $this->conn->prepare(`. |
| `34` | `            "SELECT * FROM {$this->tabla} WHERE id_modulo = :id LIMIT 1"` | Instrucción de ejecución en el contexto del script: `"SELECT * FROM {$this->tabla} WHERE id_modulo = :id LIMIT 1"`. |
| `35` | `        );` | Instrucción de ejecución en el contexto del script: `);`. |
| `36` | `        $stmt->execute([':id' => $id]);` | Ejecuta la sentencia SQL preparada vinculando los datos correspondientes: `$stmt->execute([':id' => $id]);`. |
| `37` | `        return $stmt->fetch(PDO::FETCH_ASSOC);` | Retorna el valor resultante de la expresión y culmina la ejecución de la función actual: `return $stmt->fetch(PDO::FETCH_ASSOC);`. |
| `38` | `    }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `39` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `40` | `    public function crear(array $datos): int\|false` | Declaración de método o función con su firma y parámetros: `public function crear(array $datos): int\|false`. |
| `41` | `    {` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `42` | `        try {` | Inicia bloque de captura de excepciones `try` para ejecución segura de operaciones críticas. |
| `43` | `            $stmt = $this->conn->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmt = $this->conn->prepare(`. |
| `44` | `                "INSERT INTO {$this->tabla} (nombre, ubicacion, capacidad, ...` | Instrucción de ejecución en el contexto del script: `"INSERT INTO {$this->tabla} (nombre, ubicacion, capacidad, descripcion)`. |
| `45` | `                 VALUES (:nombre, :ubicacion, :capacidad, :descripcion)"` | Instrucción de ejecución en el contexto del script: `VALUES (:nombre, :ubicacion, :capacidad, :descripcion)"`. |
| `46` | `            );` | Instrucción de ejecución en el contexto del script: `);`. |
| `47` | `            $stmt->execute([` | Ejecuta la sentencia SQL preparada vinculando los datos correspondientes: `$stmt->execute([`. |
| `48` | `                ':nombre'      => $datos['nombre'],` | Instrucción de ejecución en el contexto del script: `':nombre'      => $datos['nombre'],`. |
| `49` | `                ':ubicacion'   => $datos['ubicacion']   ?? null,` | Instrucción de ejecución en el contexto del script: `':ubicacion'   => $datos['ubicacion']   ?? null,`. |
| `50` | `                ':capacidad'   => $datos['capacidad']   ?? null,` | Instrucción de ejecución en el contexto del script: `':capacidad'   => $datos['capacidad']   ?? null,`. |
| `51` | `                ':descripcion' => $datos['descripcion'] ?? null,` | Instrucción de ejecución en el contexto del script: `':descripcion' => $datos['descripcion'] ?? null,`. |
| `52` | `            ]);` | Instrucción de ejecución en el contexto del script: `]);`. |
| `53` | `            return (int) $this->conn->lastInsertId();` | Retorna el valor resultante de la expresión y culmina la ejecución de la función actual: `return (int) $this->conn->lastInsertId();`. |
| `54` | `        } catch (Exception $e) {` | Captura y manejo de excepciones en caso de fallo durante el bloque protegido: `} catch (Exception $e) {`. |
| `55` | `            return false;` | Retorna el valor resultante de la expresión y culmina la ejecución de la función actual: `return false;`. |
| `56` | `        }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `57` | `    }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `58` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `59` | `    public function actualizar(int $id, array $datos): bool` | Declaración de método o función con su firma y parámetros: `public function actualizar(int $id, array $datos): bool`. |
| `60` | `    {` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `61` | `        $stmt = $this->conn->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmt = $this->conn->prepare(`. |
| `62` | `            "UPDATE {$this->tabla}` | Instrucción de ejecución en el contexto del script: `"UPDATE {$this->tabla}`. |
| `63` | `             SET nombre = :nombre, ubicacion = :ubicacion,` | Instrucción de ejecución en el contexto del script: `SET nombre = :nombre, ubicacion = :ubicacion,`. |
| `64` | `                 capacidad = :capacidad, descripcion = :descripcion` | Instrucción de ejecución en el contexto del script: `capacidad = :capacidad, descripcion = :descripcion`. |
| `65` | `             WHERE id_modulo = :id"` | Instrucción de ejecución en el contexto del script: `WHERE id_modulo = :id"`. |
| `66` | `        );` | Instrucción de ejecución en el contexto del script: `);`. |
| `67` | `        return $stmt->execute([` | Retorna el valor resultante de la expresión y culmina la ejecución de la función actual: `return $stmt->execute([`. |
| `68` | `            ':nombre'      => $datos['nombre'],` | Instrucción de ejecución en el contexto del script: `':nombre'      => $datos['nombre'],`. |
| `69` | `            ':ubicacion'   => $datos['ubicacion']   ?? null,` | Instrucción de ejecución en el contexto del script: `':ubicacion'   => $datos['ubicacion']   ?? null,`. |
| `70` | `            ':capacidad'   => $datos['capacidad']   ?? null,` | Instrucción de ejecución en el contexto del script: `':capacidad'   => $datos['capacidad']   ?? null,`. |
| `71` | `            ':descripcion' => $datos['descripcion'] ?? null,` | Instrucción de ejecución en el contexto del script: `':descripcion' => $datos['descripcion'] ?? null,`. |
| `72` | `            ':id'          => $id,` | Instrucción de ejecución en el contexto del script: `':id'          => $id,`. |
| `73` | `        ]);` | Instrucción de ejecución en el contexto del script: `]);`. |
| `74` | `    }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `75` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `76` | `    public function estaAsignadoEnPeriodo(int $idModulo, string $fechaInici...` | Declaración de método o función con su firma y parámetros: `public function estaAsignadoEnPeriodo(int $idModulo, string $fechaInicio, string $fechaFin, ?int $excluirAsig = null): bool`. |
| `77` | `    {` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `78` | `        $sql = "SELECT id_asignacion FROM asignaciones` | Instrucción de ejecución en el contexto del script: `$sql = "SELECT id_asignacion FROM asignaciones`. |
| `79` | `                WHERE id_modulo = :id AND estado = 'Activa'` | Instrucción de ejecución en el contexto del script: `WHERE id_modulo = :id AND estado = 'Activa'`. |
| `80` | `                AND NOT (fecha_fin < :inicio OR fecha_inicio > :fin)";` | Instrucción de ejecución en el contexto del script: `AND NOT (fecha_fin < :inicio OR fecha_inicio > :fin)";`. |
| `81` | `        if ($excluirAsig) $sql .= " AND id_asignacion != :excluir";` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if ($excluirAsig) $sql .= " AND id_asignacion != :excluir";`. |
| `82` | `        $stmt = $this->conn->prepare($sql);` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmt = $this->conn->prepare($sql);`. |
| `83` | `        $params = [':id' => $idModulo, ':inicio' => $fechaInicio, ':fin' =>...` | Instrucción de ejecución en el contexto del script: `$params = [':id' => $idModulo, ':inicio' => $fechaInicio, ':fin' => $fechaFin];`. |
| `84` | `        if ($excluirAsig) $params[':excluir'] = $excluirAsig;` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if ($excluirAsig) $params[':excluir'] = $excluirAsig;`. |
| `85` | `        $stmt->execute($params);` | Ejecuta la sentencia SQL preparada vinculando los datos correspondientes: `$stmt->execute($params);`. |
| `86` | `        return $stmt->rowCount() > 0;` | Retorna el valor resultante de la expresión y culmina la ejecución de la función actual: `return $stmt->rowCount() > 0;`. |
| `87` | `    }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `88` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `89` | `    /**` | Comentario de bloque o anotación informativa dentro del código. |
| `90` | `     * Verifica que la ficha ya no tenga una asignación activa.` | Comentario de bloque o anotación informativa dentro del código. |
| `91` | `     * Cada ficha solo puede tener UN módulo asignado a la vez.` | Comentario de bloque o anotación informativa dentro del código. |
| `92` | `     */` | Comentario de bloque o anotación informativa dentro del código. |
| `93` | `    public function fichaYaTieneAsignacion(int $idFicha, ?int $excluirAsig ...` | Declaración de método o función con su firma y parámetros: `public function fichaYaTieneAsignacion(int $idFicha, ?int $excluirAsig = null): bool`. |
| `94` | `    {` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `95` | `        $sql = "SELECT id_asignacion FROM asignaciones` | Instrucción de ejecución en el contexto del script: `$sql = "SELECT id_asignacion FROM asignaciones`. |
| `96` | `                WHERE id_ficha = :fic AND estado = 'Activa'";` | Instrucción de ejecución en el contexto del script: `WHERE id_ficha = :fic AND estado = 'Activa'";`. |
| `97` | `        if ($excluirAsig) $sql .= " AND id_asignacion != :excluir";` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if ($excluirAsig) $sql .= " AND id_asignacion != :excluir";`. |
| `98` | `        $stmt = $this->conn->prepare($sql);` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmt = $this->conn->prepare($sql);`. |
| `99` | `        $params = [':fic' => $idFicha];` | Instrucción de ejecución en el contexto del script: `$params = [':fic' => $idFicha];`. |
| `100` | `        if ($excluirAsig) $params[':excluir'] = $excluirAsig;` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if ($excluirAsig) $params[':excluir'] = $excluirAsig;`. |
| `101` | `        $stmt->execute($params);` | Ejecuta la sentencia SQL preparada vinculando los datos correspondientes: `$stmt->execute($params);`. |
| `102` | `        return $stmt->rowCount() > 0;` | Retorna el valor resultante de la expresión y culmina la ejecución de la función actual: `return $stmt->rowCount() > 0;`. |
| `103` | `    }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `104` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `105` | `    public function crearAsignacion(array $datos): int\|false` | Declaración de método o función con su firma y parámetros: `public function crearAsignacion(array $datos): int\|false`. |
| `106` | `    {` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `107` | `        try {` | Inicia bloque de captura de excepciones `try` para ejecución segura de operaciones críticas. |
| `108` | `            $stmt = $this->conn->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmt = $this->conn->prepare(`. |
| `109` | `                "INSERT INTO asignaciones` | Instrucción de ejecución en el contexto del script: `"INSERT INTO asignaciones`. |
| `110` | `                    (id_modulo, id_ficha, fecha_inicio, fecha_fin, fecha_li...` | Instrucción de ejecución en el contexto del script: `(id_modulo, id_ficha, fecha_inicio, fecha_fin, fecha_limite_evidencia)`. |
| `111` | `                 VALUES (:id_modulo, :id_ficha, :inicio, :fin, :limite)"` | Instrucción de ejecución en el contexto del script: `VALUES (:id_modulo, :id_ficha, :inicio, :fin, :limite)"`. |
| `112` | `            );` | Instrucción de ejecución en el contexto del script: `);`. |
| `113` | `            $stmt->execute([` | Ejecuta la sentencia SQL preparada vinculando los datos correspondientes: `$stmt->execute([`. |
| `114` | `                ':id_modulo' => $datos['id_modulo'],` | Instrucción de ejecución en el contexto del script: `':id_modulo' => $datos['id_modulo'],`. |
| `115` | `                ':id_ficha'  => $datos['id_ficha'],` | Instrucción de ejecución en el contexto del script: `':id_ficha'  => $datos['id_ficha'],`. |
| `116` | `                ':inicio'    => $datos['fecha_inicio'],` | Instrucción de ejecución en el contexto del script: `':inicio'    => $datos['fecha_inicio'],`. |
| `117` | `                ':fin'       => $datos['fecha_fin'],` | Instrucción de ejecución en el contexto del script: `':fin'       => $datos['fecha_fin'],`. |
| `118` | `                ':limite'    => $datos['fecha_limite_evidencia'],` | Instrucción de ejecución en el contexto del script: `':limite'    => $datos['fecha_limite_evidencia'],`. |
| `119` | `            ]);` | Instrucción de ejecución en el contexto del script: `]);`. |
| `120` | `            return (int) $this->conn->lastInsertId();` | Retorna el valor resultante de la expresión y culmina la ejecución de la función actual: `return (int) $this->conn->lastInsertId();`. |
| `121` | `        } catch (Exception $e) {` | Captura y manejo de excepciones en caso de fallo durante el bloque protegido: `} catch (Exception $e) {`. |
| `122` | `            return false;` | Retorna el valor resultante de la expresión y culmina la ejecución de la función actual: `return false;`. |
| `123` | `        }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `124` | `    }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `125` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `126` | `    public function obtenerAsignaciones(array $filtros = []): array` | Declaración de método o función con su firma y parámetros: `public function obtenerAsignaciones(array $filtros = []): array`. |
| `127` | `    {` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `128` | `        $where = ['1=1'];` | Instrucción de ejecución en el contexto del script: `$where = ['1=1'];`. |
| `129` | `        $params = [];` | Instrucción de ejecución en el contexto del script: `$params = [];`. |
| `130` | `        if (!empty($filtros['estado'])) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (!empty($filtros['estado'])) {`. |
| `131` | `            $where[] = 'a.estado = :estado';` | Instrucción de ejecución en el contexto del script: `$where[] = 'a.estado = :estado';`. |
| `132` | `            $params[':estado'] = $filtros['estado'];` | Instrucción de ejecución en el contexto del script: `$params[':estado'] = $filtros['estado'];`. |
| `133` | `        }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `134` | `        if (!empty($filtros['id_ficha'])) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (!empty($filtros['id_ficha'])) {`. |
| `135` | `            $where[] = 'a.id_ficha = :id_ficha';` | Instrucción de ejecución en el contexto del script: `$where[] = 'a.id_ficha = :id_ficha';`. |
| `136` | `            $params[':id_ficha'] = $filtros['id_ficha'];` | Instrucción de ejecución en el contexto del script: `$params[':id_ficha'] = $filtros['id_ficha'];`. |
| `137` | `        }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `138` | `        $whereStr = implode(' AND ', $where);` | Instrucción de ejecución en el contexto del script: `$whereStr = implode(' AND ', $where);`. |
| `139` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `140` | `        $stmt = $this->conn->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmt = $this->conn->prepare(`. |
| `141` | `            "SELECT a.*, m.nombre AS nombre_modulo,` | Instrucción de ejecución en el contexto del script: `"SELECT a.*, m.nombre AS nombre_modulo,`. |
| `142` | `                    f.numero_ficha, p.nombre AS nombre_programa,` | Instrucción de ejecución en el contexto del script: `f.numero_ficha, p.nombre AS nombre_programa,`. |
| `143` | `                    v.nombres AS vocero_nombres, v.apellidos AS vocero_apel...` | Instrucción de ejecución en el contexto del script: `v.nombres AS vocero_nombres, v.apellidos AS vocero_apellidos,`. |
| `144` | `                    (SELECT COUNT(*) FROM evidencias e` | Instrucción de ejecución en el contexto del script: `(SELECT COUNT(*) FROM evidencias e`. |
| `145` | `                     JOIN grupos g ON g.id_grupo = e.id_grupo` | Instrucción de ejecución en el contexto del script: `JOIN grupos g ON g.id_grupo = e.id_grupo`. |
| `146` | `                     WHERE g.id_asignacion = a.id_asignacion) AS total_evid...` | Instrucción de ejecución en el contexto del script: `WHERE g.id_asignacion = a.id_asignacion) AS total_evidencias`. |
| `147` | `             FROM asignaciones a` | Instrucción de ejecución en el contexto del script: `FROM asignaciones a`. |
| `148` | `             JOIN modulos  m ON m.id_modulo   = a.id_modulo` | Instrucción de ejecución en el contexto del script: `JOIN modulos  m ON m.id_modulo   = a.id_modulo`. |
| `149` | `             JOIN fichas   f ON f.id_ficha    = a.id_ficha` | Instrucción de ejecución en el contexto del script: `JOIN fichas   f ON f.id_ficha    = a.id_ficha`. |
| `150` | `             JOIN programas p ON p.id_programa = f.id_programa` | Instrucción de ejecución en el contexto del script: `JOIN programas p ON p.id_programa = f.id_programa`. |
| `151` | `             LEFT JOIN voceros v ON v.id_ficha = a.id_ficha AND v.activo = 1` | Instrucción de ejecución en el contexto del script: `LEFT JOIN voceros v ON v.id_ficha = a.id_ficha AND v.activo = 1`. |
| `152` | `             WHERE {$whereStr}` | Instrucción de ejecución en el contexto del script: `WHERE {$whereStr}`. |
| `153` | `             ORDER BY a.fecha_limite_evidencia DESC"` | Instrucción de ejecución en el contexto del script: `ORDER BY a.fecha_limite_evidencia DESC"`. |
| `154` | `        );` | Instrucción de ejecución en el contexto del script: `);`. |
| `155` | `        $stmt->execute($params);` | Ejecuta la sentencia SQL preparada vinculando los datos correspondientes: `$stmt->execute($params);`. |
| `156` | `        return $stmt->fetchAll(PDO::FETCH_ASSOC);` | Retorna el valor resultante de la expresión y culmina la ejecución de la función actual: `return $stmt->fetchAll(PDO::FETCH_ASSOC);`. |
| `157` | `    }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `158` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `159` | `    public function eliminar(int $id): bool` | Declaración de método o función con su firma y parámetros: `public function eliminar(int $id): bool`. |
| `160` | `    {` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `161` | `        $stmt = $this->conn->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmt = $this->conn->prepare(`. |
| `162` | `            "UPDATE {$this->tabla} SET activo = 0 WHERE id_modulo = :id"` | Instrucción de ejecución en el contexto del script: `"UPDATE {$this->tabla} SET activo = 0 WHERE id_modulo = :id"`. |
| `163` | `        );` | Instrucción de ejecución en el contexto del script: `);`. |
| `164` | `        return $stmt->execute([':id' => $id]);` | Retorna el valor resultante de la expresión y culmina la ejecución de la función actual: `return $stmt->execute([':id' => $id]);`. |
| `165` | `    }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `166` | `}` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `167` | `?>` | Cierre de la etiqueta PHP para alternar a salida HTML o fin del archivo. |

---

## 3. Resumen y Flujo de Interacción

El archivo `Modulo.php` cumple un rol indispensable en `models/Modulo.php`. 
Modelo de datos para la administración de módulos/ambientes físicos de formación y asignación de fichas encargadas de su limpieza. Garantiza la robustez, el orden y la estabilidad de la arquitectura del proyecto `systemLimpieza`.
