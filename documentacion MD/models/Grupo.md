# Documentación Línea por Línea: `models/Grupo.php`

## 1. Ficha Técnica del Archivo

- **Archivo:** `Grupo.php`
- **Ruta en el proyecto:** `models/Grupo.php`
- **Cantidad total de líneas:** `210`
- **Tipo de archivo:** `PHP`
- **Propósito general:** Modelo de datos para la administración de grupos de trabajo de limpieza conformados por aprendices de una ficha específica.

---

## 2. Explicación Detallada Línea por Línea

A continuación se presenta cada línea de código numerada de forma consecutiva, acompañada de su fragmento exacto y la explicación exhaustiva de su funcionamiento y responsabilidad en el sistema:

| Línea | Código Fuente | Explicación Detallada |
|---|---|---|
| `1` | `<?php` | Apertura obligatoria de la etiqueta PHP para ejecución del código del lado del servidor. |
| `2` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `3` | `class Grupo` | Declaración de la clase del componente: `class Grupo`. |
| `4` | `{` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `5` | `    private $conn;` | Propiedad `private` `$conn` para el estado interno de la clase. |
| `6` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `7` | `    public function __construct($db)` | Declaración de método o función con su firma y parámetros: `public function __construct($db)`. |
| `8` | `    {` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `9` | `        $this->conn = $db;` | Instrucción de ejecución en el contexto del script: `$this->conn = $db;`. |
| `10` | `    }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `11` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `12` | `    public function obtenerPorVocero(int $idVocero): array` | Declaración de método o función con su firma y parámetros: `public function obtenerPorVocero(int $idVocero): array`. |
| `13` | `    {` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `14` | `        $stmt = $this->conn->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmt = $this->conn->prepare(`. |
| `15` | `            "SELECT g.*,` | Instrucción de ejecución en el contexto del script: `"SELECT g.*,`. |
| `16` | `                    a.fecha_limite_evidencia, a.estado AS estado_asignacion,` | Instrucción de ejecución en el contexto del script: `a.fecha_limite_evidencia, a.estado AS estado_asignacion,`. |
| `17` | `                    m.nombre AS nombre_modulo,` | Instrucción de ejecución en el contexto del script: `m.nombre AS nombre_modulo,`. |
| `18` | `                    f.numero_ficha,` | Instrucción de ejecución en el contexto del script: `f.numero_ficha,`. |
| `19` | `                    (SELECT COUNT(*) FROM evidencias e WHERE e.id_grupo = g...` | Instrucción de ejecución en el contexto del script: `(SELECT COUNT(*) FROM evidencias e WHERE e.id_grupo = g.id_grupo) AS tiene_evidencia`. |
| `20` | `             FROM grupos g` | Instrucción de ejecución en el contexto del script: `FROM grupos g`. |
| `21` | `             JOIN asignaciones a ON a.id_asignacion = g.id_asignacion` | Instrucción de ejecución en el contexto del script: `JOIN asignaciones a ON a.id_asignacion = g.id_asignacion`. |
| `22` | `             JOIN modulos  m ON m.id_modulo  = a.id_modulo` | Instrucción de ejecución en el contexto del script: `JOIN modulos  m ON m.id_modulo  = a.id_modulo`. |
| `23` | `             JOIN fichas   f ON f.id_ficha   = a.id_ficha` | Instrucción de ejecución en el contexto del script: `JOIN fichas   f ON f.id_ficha   = a.id_ficha`. |
| `24` | `             WHERE g.id_vocero = :id` | Instrucción de ejecución en el contexto del script: `WHERE g.id_vocero = :id`. |
| `25` | `             ORDER BY g.fecha_limpieza DESC"` | Instrucción de ejecución en el contexto del script: `ORDER BY g.fecha_limpieza DESC"`. |
| `26` | `        );` | Instrucción de ejecución en el contexto del script: `);`. |
| `27` | `        $stmt->execute([':id' => $idVocero]);` | Ejecuta la sentencia SQL preparada vinculando los datos correspondientes: `$stmt->execute([':id' => $idVocero]);`. |
| `28` | `        return $stmt->fetchAll(PDO::FETCH_ASSOC);` | Retorna el valor resultante de la expresión y culmina la ejecución de la función actual: `return $stmt->fetchAll(PDO::FETCH_ASSOC);`. |
| `29` | `    }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `30` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `31` | `    public function obtenerPorId(int $id): array\|false` | Declaración de método o función con su firma y parámetros: `public function obtenerPorId(int $id): array\|false`. |
| `32` | `    {` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `33` | `        $stmt = $this->conn->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmt = $this->conn->prepare(`. |
| `34` | `            "SELECT g.*,` | Instrucción de ejecución en el contexto del script: `"SELECT g.*,`. |
| `35` | `                    a.fecha_limite_evidencia, a.id_ficha,` | Instrucción de ejecución en el contexto del script: `a.fecha_limite_evidencia, a.id_ficha,`. |
| `36` | `                    m.nombre AS nombre_modulo,` | Instrucción de ejecución en el contexto del script: `m.nombre AS nombre_modulo,`. |
| `37` | `                    f.numero_ficha` | Instrucción de ejecución en el contexto del script: `f.numero_ficha`. |
| `38` | `             FROM grupos g` | Instrucción de ejecución en el contexto del script: `FROM grupos g`. |
| `39` | `             JOIN asignaciones a ON a.id_asignacion = g.id_asignacion` | Instrucción de ejecución en el contexto del script: `JOIN asignaciones a ON a.id_asignacion = g.id_asignacion`. |
| `40` | `             JOIN modulos  m ON m.id_modulo  = a.id_modulo` | Instrucción de ejecución en el contexto del script: `JOIN modulos  m ON m.id_modulo  = a.id_modulo`. |
| `41` | `             JOIN fichas   f ON f.id_ficha   = a.id_ficha` | Instrucción de ejecución en el contexto del script: `JOIN fichas   f ON f.id_ficha   = a.id_ficha`. |
| `42` | `             WHERE g.id_grupo = :id LIMIT 1"` | Instrucción de ejecución en el contexto del script: `WHERE g.id_grupo = :id LIMIT 1"`. |
| `43` | `        );` | Instrucción de ejecución en el contexto del script: `);`. |
| `44` | `        $stmt->execute([':id' => $id]);` | Ejecuta la sentencia SQL preparada vinculando los datos correspondientes: `$stmt->execute([':id' => $id]);`. |
| `45` | `        return $stmt->fetch(PDO::FETCH_ASSOC);` | Retorna el valor resultante de la expresión y culmina la ejecución de la función actual: `return $stmt->fetch(PDO::FETCH_ASSOC);`. |
| `46` | `    }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `47` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `48` | `    public function obtenerIntegrantes(int $idGrupo): array` | Declaración de método o función con su firma y parámetros: `public function obtenerIntegrantes(int $idGrupo): array`. |
| `49` | `    {` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `50` | `        $stmt = $this->conn->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmt = $this->conn->prepare(`. |
| `51` | `            "SELECT ap.id_aprendiz, ap.nombres, ap.apellidos, ap.documento,` | Instrucción de ejecución en el contexto del script: `"SELECT ap.id_aprendiz, ap.nombres, ap.apellidos, ap.documento,`. |
| `52` | `                    ap.celular, ap.correo` | Instrucción de ejecución en el contexto del script: `ap.celular, ap.correo`. |
| `53` | `             FROM grupo_integrantes gi` | Instrucción de ejecución en el contexto del script: `FROM grupo_integrantes gi`. |
| `54` | `             JOIN aprendices ap ON ap.id_aprendiz = gi.id_aprendiz` | Instrucción de ejecución en el contexto del script: `JOIN aprendices ap ON ap.id_aprendiz = gi.id_aprendiz`. |
| `55` | `             WHERE gi.id_grupo = :id` | Instrucción de ejecución en el contexto del script: `WHERE gi.id_grupo = :id`. |
| `56` | `             ORDER BY ap.apellidos, ap.nombres"` | Instrucción de ejecución en el contexto del script: `ORDER BY ap.apellidos, ap.nombres"`. |
| `57` | `        );` | Instrucción de ejecución en el contexto del script: `);`. |
| `58` | `        $stmt->execute([':id' => $idGrupo]);` | Ejecuta la sentencia SQL preparada vinculando los datos correspondientes: `$stmt->execute([':id' => $idGrupo]);`. |
| `59` | `        return $stmt->fetchAll(PDO::FETCH_ASSOC);` | Retorna el valor resultante de la expresión y culmina la ejecución de la función actual: `return $stmt->fetchAll(PDO::FETCH_ASSOC);`. |
| `60` | `    }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `61` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `62` | `    public function existeDuplicadoModuloFecha(int $idAsignacion, string $f...` | Declaración de método o función con su firma y parámetros: `public function existeDuplicadoModuloFecha(int $idAsignacion, string $fecha, ?int $excluirId = null): bool`. |
| `63` | `    {` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `64` | `        $sql = "SELECT id_grupo FROM grupos` | Instrucción de ejecución en el contexto del script: `$sql = "SELECT id_grupo FROM grupos`. |
| `65` | `                WHERE id_asignacion = :asig AND fecha_limpieza = :fecha";` | Instrucción de ejecución en el contexto del script: `WHERE id_asignacion = :asig AND fecha_limpieza = :fecha";`. |
| `66` | `        if ($excluirId) $sql .= " AND id_grupo != :excluir";` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if ($excluirId) $sql .= " AND id_grupo != :excluir";`. |
| `67` | `        $stmt = $this->conn->prepare($sql);` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmt = $this->conn->prepare($sql);`. |
| `68` | `        $params = [':asig' => $idAsignacion, ':fecha' => $fecha];` | Instrucción de ejecución en el contexto del script: `$params = [':asig' => $idAsignacion, ':fecha' => $fecha];`. |
| `69` | `        if ($excluirId) $params[':excluir'] = $excluirId;` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if ($excluirId) $params[':excluir'] = $excluirId;`. |
| `70` | `        $stmt->execute($params);` | Ejecuta la sentencia SQL preparada vinculando los datos correspondientes: `$stmt->execute($params);`. |
| `71` | `        return $stmt->rowCount() > 0;` | Retorna el valor resultante de la expresión y culmina la ejecución de la función actual: `return $stmt->rowCount() > 0;`. |
| `72` | `    }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `73` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `74` | `    public function crear(array $datos, array $idAprendices): int\|false` | Declaración de método o función con su firma y parámetros: `public function crear(array $datos, array $idAprendices): int\|false`. |
| `75` | `    {` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `76` | `        try {` | Inicia bloque de captura de excepciones `try` para ejecución segura de operaciones críticas. |
| `77` | `            $this->conn->beginTransaction();` | Inicia una transacción atómica para asegurar la integridad de datos en múltiples operaciones. |
| `78` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `79` | `            $stmt = $this->conn->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmt = $this->conn->prepare(`. |
| `80` | `                "INSERT INTO grupos (id_asignacion, id_vocero, nombre_grupo...` | Instrucción de ejecución en el contexto del script: `"INSERT INTO grupos (id_asignacion, id_vocero, nombre_grupo, fecha_limpieza)`. |
| `81` | `                 VALUES (:id_asignacion, :id_vocero, :nombre_grupo, :fecha_...` | Instrucción de ejecución en el contexto del script: `VALUES (:id_asignacion, :id_vocero, :nombre_grupo, :fecha_limpieza)"`. |
| `82` | `            );` | Instrucción de ejecución en el contexto del script: `);`. |
| `83` | `            $stmt->execute([` | Ejecuta la sentencia SQL preparada vinculando los datos correspondientes: `$stmt->execute([`. |
| `84` | `                ':id_asignacion' => $datos['id_asignacion'],` | Instrucción de ejecución en el contexto del script: `':id_asignacion' => $datos['id_asignacion'],`. |
| `85` | `                ':id_vocero'     => $datos['id_vocero'],` | Instrucción de ejecución en el contexto del script: `':id_vocero'     => $datos['id_vocero'],`. |
| `86` | `                ':nombre_grupo'  => $datos['nombre_grupo'],` | Instrucción de ejecución en el contexto del script: `':nombre_grupo'  => $datos['nombre_grupo'],`. |
| `87` | `                ':fecha_limpieza'=> $datos['fecha_limpieza'],` | Instrucción de ejecución en el contexto del script: `':fecha_limpieza'=> $datos['fecha_limpieza'],`. |
| `88` | `            ]);` | Instrucción de ejecución en el contexto del script: `]);`. |
| `89` | `            $idGrupo = (int) $this->conn->lastInsertId();` | Obtiene el identificador autoincremental generado tras la inserción en la base de datos. |
| `90` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `91` | `            $stmtInt = $this->conn->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmtInt = $this->conn->prepare(`. |
| `92` | `                "INSERT INTO grupo_integrantes (id_grupo, id_aprendiz) VALU...` | Instrucción de ejecución en el contexto del script: `"INSERT INTO grupo_integrantes (id_grupo, id_aprendiz) VALUES (:g, :a)"`. |
| `93` | `            );` | Instrucción de ejecución en el contexto del script: `);`. |
| `94` | `            foreach ($idAprendices as $idAp) {` | Bucle de iteración `foreach` para recorrer arreglos o colecciones de registros: `foreach ($idAprendices as $idAp) {`. |
| `95` | `                $stmtInt->execute([':g' => $idGrupo, ':a' => (int)$idAp]);` | Ejecuta la sentencia SQL preparada vinculando los datos correspondientes: `$stmtInt->execute([':g' => $idGrupo, ':a' => (int)$idAp]);`. |
| `96` | `            }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `97` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `98` | `            $this->conn->commit();` | Confirma y asienta permanentemente los cambios de la transacción en la base de datos. |
| `99` | `            return $idGrupo;` | Retorna el valor resultante de la expresión y culmina la ejecución de la función actual: `return $idGrupo;`. |
| `100` | `        } catch (Exception $e) {` | Captura y manejo de excepciones en caso de fallo durante el bloque protegido: `} catch (Exception $e) {`. |
| `101` | `            $this->conn->rollBack();` | Revierte cualquier cambio efectuado en la transacción si ocurre un error inesperado. |
| `102` | `            return false;` | Retorna el valor resultante de la expresión y culmina la ejecución de la función actual: `return false;`. |
| `103` | `        }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `104` | `    }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `105` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `106` | `    public function actualizar(int $id, array $datos, array $idAprendices):...` | Declaración de método o función con su firma y parámetros: `public function actualizar(int $id, array $datos, array $idAprendices): bool`. |
| `107` | `    {` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `108` | `        try {` | Inicia bloque de captura de excepciones `try` para ejecución segura de operaciones críticas. |
| `109` | `            $this->conn->beginTransaction();` | Inicia una transacción atómica para asegurar la integridad de datos en múltiples operaciones. |
| `110` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `111` | `            $stmt = $this->conn->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmt = $this->conn->prepare(`. |
| `112` | `                "UPDATE grupos` | Instrucción de ejecución en el contexto del script: `"UPDATE grupos`. |
| `113` | `                 SET nombre_grupo = :nombre_grupo, fecha_limpieza = :fecha_...` | Instrucción de ejecución en el contexto del script: `SET nombre_grupo = :nombre_grupo, fecha_limpieza = :fecha_limpieza,`. |
| `114` | `                     fecha_modificacion = NOW()` | Instrucción de ejecución en el contexto del script: `fecha_modificacion = NOW()`. |
| `115` | `                 WHERE id_grupo = :id"` | Instrucción de ejecución en el contexto del script: `WHERE id_grupo = :id"`. |
| `116` | `            );` | Instrucción de ejecución en el contexto del script: `);`. |
| `117` | `            $stmt->execute([` | Ejecuta la sentencia SQL preparada vinculando los datos correspondientes: `$stmt->execute([`. |
| `118` | `                ':nombre_grupo'  => $datos['nombre_grupo'],` | Instrucción de ejecución en el contexto del script: `':nombre_grupo'  => $datos['nombre_grupo'],`. |
| `119` | `                ':fecha_limpieza'=> $datos['fecha_limpieza'],` | Instrucción de ejecución en el contexto del script: `':fecha_limpieza'=> $datos['fecha_limpieza'],`. |
| `120` | `                ':id'            => $id,` | Instrucción de ejecución en el contexto del script: `':id'            => $id,`. |
| `121` | `            ]);` | Instrucción de ejecución en el contexto del script: `]);`. |
| `122` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `123` | `            // Reemplazar integrantes` | Comentario de línea explicativo: `Reemplazar integrantes`. |
| `124` | `            $this->conn->prepare("DELETE FROM grupo_integrantes WHERE id_gr...` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$this->conn->prepare("DELETE FROM grupo_integrantes WHERE id_grupo = :id")`. |
| `125` | `                       ->execute([':id' => $id]);` | Ejecuta la sentencia SQL preparada vinculando los datos correspondientes: `->execute([':id' => $id]);`. |
| `126` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `127` | `            $stmtInt = $this->conn->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmtInt = $this->conn->prepare(`. |
| `128` | `                "INSERT INTO grupo_integrantes (id_grupo, id_aprendiz) VALU...` | Instrucción de ejecución en el contexto del script: `"INSERT INTO grupo_integrantes (id_grupo, id_aprendiz) VALUES (:g, :a)"`. |
| `129` | `            );` | Instrucción de ejecución en el contexto del script: `);`. |
| `130` | `            foreach ($idAprendices as $idAp) {` | Bucle de iteración `foreach` para recorrer arreglos o colecciones de registros: `foreach ($idAprendices as $idAp) {`. |
| `131` | `                $stmtInt->execute([':g' => $id, ':a' => (int)$idAp]);` | Ejecuta la sentencia SQL preparada vinculando los datos correspondientes: `$stmtInt->execute([':g' => $id, ':a' => (int)$idAp]);`. |
| `132` | `            }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `133` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `134` | `            $this->conn->commit();` | Confirma y asienta permanentemente los cambios de la transacción en la base de datos. |
| `135` | `            return true;` | Retorna el valor resultante de la expresión y culmina la ejecución de la función actual: `return true;`. |
| `136` | `        } catch (Exception $e) {` | Captura y manejo de excepciones en caso de fallo durante el bloque protegido: `} catch (Exception $e) {`. |
| `137` | `            $this->conn->rollBack();` | Revierte cualquier cambio efectuado en la transacción si ocurre un error inesperado. |
| `138` | `            return false;` | Retorna el valor resultante de la expresión y culmina la ejecución de la función actual: `return false;`. |
| `139` | `        }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `140` | `    }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `141` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `142` | `    public function eliminar(int $id): bool` | Declaración de método o función con su firma y parámetros: `public function eliminar(int $id): bool`. |
| `143` | `    {` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `144` | `        // Solo se puede eliminar si no tiene evidencias` | Comentario de línea explicativo: `Solo se puede eliminar si no tiene evidencias`. |
| `145` | `        $stmt = $this->conn->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmt = $this->conn->prepare(`. |
| `146` | `            "SELECT id_evidencia FROM evidencias WHERE id_grupo = :id LIMIT 1"` | Instrucción de ejecución en el contexto del script: `"SELECT id_evidencia FROM evidencias WHERE id_grupo = :id LIMIT 1"`. |
| `147` | `        );` | Instrucción de ejecución en el contexto del script: `);`. |
| `148` | `        $stmt->execute([':id' => $id]);` | Ejecuta la sentencia SQL preparada vinculando los datos correspondientes: `$stmt->execute([':id' => $id]);`. |
| `149` | `        if ($stmt->rowCount() > 0) return false;` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if ($stmt->rowCount() > 0) return false;`. |
| `150` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `151` | `        $stmt = $this->conn->prepare("DELETE FROM grupos WHERE id_grupo = :...` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmt = $this->conn->prepare("DELETE FROM grupos WHERE id_grupo = :id");`. |
| `152` | `        return $stmt->execute([':id' => $id]);` | Retorna el valor resultante de la expresión y culmina la ejecución de la función actual: `return $stmt->execute([':id' => $id]);`. |
| `153` | `    }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `154` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `155` | `    public function registrarHistorial(int $idGrupo, string $descripcion, i...` | Declaración de método o función con su firma y parámetros: `public function registrarHistorial(int $idGrupo, string $descripcion, int $idUsuario): void`. |
| `156` | `    {` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `157` | `        $stmt = $this->conn->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmt = $this->conn->prepare(`. |
| `158` | `            "INSERT INTO historial_grupos (id_grupo, descripcion, id_usuario)` | Instrucción de ejecución en el contexto del script: `"INSERT INTO historial_grupos (id_grupo, descripcion, id_usuario)`. |
| `159` | `             VALUES (:g, :d, :u)"` | Instrucción de ejecución en el contexto del script: `VALUES (:g, :d, :u)"`. |
| `160` | `        );` | Instrucción de ejecución en el contexto del script: `);`. |
| `161` | `        $stmt->execute([':g' => $idGrupo, ':d' => $descripcion, ':u' => $id...` | Ejecuta la sentencia SQL preparada vinculando los datos correspondientes: `$stmt->execute([':g' => $idGrupo, ':d' => $descripcion, ':u' => $idUsuario]);`. |
| `162` | `    }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `163` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `164` | `    public function obtenerHistorial(int $idGrupo): array` | Declaración de método o función con su firma y parámetros: `public function obtenerHistorial(int $idGrupo): array`. |
| `165` | `    {` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `166` | `        $stmt = $this->conn->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmt = $this->conn->prepare(`. |
| `167` | `            "SELECT hg.*, u.nombres AS usuario_nombre, u.apellidos AS usuar...` | Instrucción de ejecución en el contexto del script: `"SELECT hg.*, u.nombres AS usuario_nombre, u.apellidos AS usuario_apellido`. |
| `168` | `             FROM historial_grupos hg` | Instrucción de ejecución en el contexto del script: `FROM historial_grupos hg`. |
| `169` | `             LEFT JOIN usuarios u ON u.id_usuario = hg.id_usuario` | Instrucción de ejecución en el contexto del script: `LEFT JOIN usuarios u ON u.id_usuario = hg.id_usuario`. |
| `170` | `             WHERE hg.id_grupo = :id` | Instrucción de ejecución en el contexto del script: `WHERE hg.id_grupo = :id`. |
| `171` | `             ORDER BY hg.fecha DESC"` | Instrucción de ejecución en el contexto del script: `ORDER BY hg.fecha DESC"`. |
| `172` | `        );` | Instrucción de ejecución en el contexto del script: `);`. |
| `173` | `        $stmt->execute([':id' => $idGrupo]);` | Ejecuta la sentencia SQL preparada vinculando los datos correspondientes: `$stmt->execute([':id' => $idGrupo]);`. |
| `174` | `        return $stmt->fetchAll(PDO::FETCH_ASSOC);` | Retorna el valor resultante de la expresión y culmina la ejecución de la función actual: `return $stmt->fetchAll(PDO::FETCH_ASSOC);`. |
| `175` | `    }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `176` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `177` | `    public function obtenerTodos(array $filtros = []): array` | Declaración de método o función con su firma y parámetros: `public function obtenerTodos(array $filtros = []): array`. |
| `178` | `    {` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `179` | `        $where  = ['1=1'];` | Instrucción de ejecución en el contexto del script: `$where  = ['1=1'];`. |
| `180` | `        $params = [];` | Instrucción de ejecución en el contexto del script: `$params = [];`. |
| `181` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `182` | `        if (!empty($filtros['id_ficha'])) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (!empty($filtros['id_ficha'])) {`. |
| `183` | `            $where[] = 'a.id_ficha = :id_ficha';` | Instrucción de ejecución en el contexto del script: `$where[] = 'a.id_ficha = :id_ficha';`. |
| `184` | `            $params[':id_ficha'] = $filtros['id_ficha'];` | Instrucción de ejecución en el contexto del script: `$params[':id_ficha'] = $filtros['id_ficha'];`. |
| `185` | `        }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `186` | `        if (!empty($filtros['estado'])) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (!empty($filtros['estado'])) {`. |
| `187` | `            $where[] = 'g.estado = :estado';` | Instrucción de ejecución en el contexto del script: `$where[] = 'g.estado = :estado';`. |
| `188` | `            $params[':estado'] = $filtros['estado'];` | Instrucción de ejecución en el contexto del script: `$params[':estado'] = $filtros['estado'];`. |
| `189` | `        }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `190` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `191` | `        $whereStr = implode(' AND ', $where);` | Instrucción de ejecución en el contexto del script: `$whereStr = implode(' AND ', $where);`. |
| `192` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `193` | `        $stmt = $this->conn->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmt = $this->conn->prepare(`. |
| `194` | `            "SELECT g.*,` | Instrucción de ejecución en el contexto del script: `"SELECT g.*,`. |
| `195` | `                    m.nombre AS nombre_modulo, f.numero_ficha,` | Instrucción de ejecución en el contexto del script: `m.nombre AS nombre_modulo, f.numero_ficha,`. |
| `196` | `                    v.nombres AS vocero_nombres, v.apellidos AS vocero_apel...` | Instrucción de ejecución en el contexto del script: `v.nombres AS vocero_nombres, v.apellidos AS vocero_apellidos,`. |
| `197` | `                    (SELECT COUNT(*) FROM evidencias e WHERE e.id_grupo = g...` | Instrucción de ejecución en el contexto del script: `(SELECT COUNT(*) FROM evidencias e WHERE e.id_grupo = g.id_grupo) AS tiene_evidencia`. |
| `198` | `             FROM grupos g` | Instrucción de ejecución en el contexto del script: `FROM grupos g`. |
| `199` | `             JOIN asignaciones a ON a.id_asignacion = g.id_asignacion` | Instrucción de ejecución en el contexto del script: `JOIN asignaciones a ON a.id_asignacion = g.id_asignacion`. |
| `200` | `             JOIN modulos  m ON m.id_modulo  = a.id_modulo` | Instrucción de ejecución en el contexto del script: `JOIN modulos  m ON m.id_modulo  = a.id_modulo`. |
| `201` | `             JOIN fichas   f ON f.id_ficha   = a.id_ficha` | Instrucción de ejecución en el contexto del script: `JOIN fichas   f ON f.id_ficha   = a.id_ficha`. |
| `202` | `             JOIN voceros  v ON v.id_vocero  = g.id_vocero` | Instrucción de ejecución en el contexto del script: `JOIN voceros  v ON v.id_vocero  = g.id_vocero`. |
| `203` | `             WHERE {$whereStr}` | Instrucción de ejecución en el contexto del script: `WHERE {$whereStr}`. |
| `204` | `             ORDER BY g.fecha_limpieza DESC"` | Instrucción de ejecución en el contexto del script: `ORDER BY g.fecha_limpieza DESC"`. |
| `205` | `        );` | Instrucción de ejecución en el contexto del script: `);`. |
| `206` | `        $stmt->execute($params);` | Ejecuta la sentencia SQL preparada vinculando los datos correspondientes: `$stmt->execute($params);`. |
| `207` | `        return $stmt->fetchAll(PDO::FETCH_ASSOC);` | Retorna el valor resultante de la expresión y culmina la ejecución de la función actual: `return $stmt->fetchAll(PDO::FETCH_ASSOC);`. |
| `208` | `    }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `209` | `}` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `210` | `?>` | Cierre de la etiqueta PHP para alternar a salida HTML o fin del archivo. |

---

## 3. Resumen y Flujo de Interacción

El archivo `Grupo.php` cumple un rol indispensable en `models/Grupo.php`. 
Modelo de datos para la administración de grupos de trabajo de limpieza conformados por aprendices de una ficha específica. Garantiza la robustez, el orden y la estabilidad de la arquitectura del proyecto `systemLimpieza`.
