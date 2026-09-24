# Documentación Línea por Línea: `models/Turno.php`

## 1. Ficha Técnica del Archivo

- **Archivo:** `Turno.php`
- **Ruta en el proyecto:** `models/Turno.php`
- **Cantidad total de líneas:** `257`
- **Tipo de archivo:** `PHP`
- **Propósito general:** Modelo de datos para la programación, cálculo de fechas y estado de turnos de limpieza asignados a los grupos de cada módulo.

---

## 2. Explicación Detallada Línea por Línea

A continuación se presenta cada línea de código numerada de forma consecutiva, acompañada de su fragmento exacto y la explicación exhaustiva de su funcionamiento y responsabilidad en el sistema:

| Línea | Código Fuente | Explicación Detallada |
|---|---|---|
| `1` | `<?php` | Apertura obligatoria de la etiqueta PHP para ejecución del código del lado del servidor. |
| `2` | `class Turno` | Declaración de la clase del componente: `class Turno`. |
| `3` | `{` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `4` | `    private PDO $conn;` | Propiedad `private` de tipo `PDO` `$conn` para el estado interno de la clase. |
| `5` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `6` | `    public function __construct(PDO $db) { $this->conn = $db; }` | Declaración de método o función con su firma y parámetros: `public function __construct(PDO $db) { $this->conn = $db; }`. |
| `7` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `8` | `    /**` | Comentario de bloque o anotación informativa dentro del código. |
| `9` | `     * Genera turnos semanales para una asignación (INSERT IGNORE).` | Comentario de bloque o anotación informativa dentro del código. |
| `10` | `     * Retorna la cantidad de turnos creados.` | Comentario de bloque o anotación informativa dentro del código. |
| `11` | `     */` | Comentario de bloque o anotación informativa dentro del código. |
| `12` | `    public function generarTurnosAsignacion(int $idAsignacion): int` | Declaración de método o función con su firma y parámetros: `public function generarTurnosAsignacion(int $idAsignacion): int`. |
| `13` | `    {` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `14` | `        $stmt = $this->conn->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmt = $this->conn->prepare(`. |
| `15` | `            "SELECT id_asignacion, fecha_inicio, fecha_fin, dia_semana` | Instrucción de ejecución en el contexto del script: `"SELECT id_asignacion, fecha_inicio, fecha_fin, dia_semana`. |
| `16` | `             FROM asignaciones WHERE id_asignacion = :id LIMIT 1"` | Instrucción de ejecución en el contexto del script: `FROM asignaciones WHERE id_asignacion = :id LIMIT 1"`. |
| `17` | `        );` | Instrucción de ejecución en el contexto del script: `);`. |
| `18` | `        $stmt->execute([':id' => $idAsignacion]);` | Ejecuta la sentencia SQL preparada vinculando los datos correspondientes: `$stmt->execute([':id' => $idAsignacion]);`. |
| `19` | `        $asig = $stmt->fetch(PDO::FETCH_ASSOC);` | Recupera una única fila o registro resultante de la consulta. |
| `20` | `        if (!$asig) return 0;` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (!$asig) return 0;`. |
| `21` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `22` | `        $inicio  = new DateTime($asig['fecha_inicio']);` | Instrucción de ejecución en el contexto del script: `$inicio  = new DateTime($asig['fecha_inicio']);`. |
| `23` | `        $fin     = new DateTime($asig['fecha_fin']);` | Instrucción de ejecución en el contexto del script: `$fin     = new DateTime($asig['fecha_fin']);`. |
| `24` | `        $diaSem  = (int)$asig['dia_semana']; // 0=Dom … 6=Sáb` | Instrucción de ejecución en el contexto del script: `$diaSem  = (int)$asig['dia_semana']; // 0=Dom … 6=Sáb`. |
| `25` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `26` | `        // Mover $inicio al primer día de semana correcto >= fecha_inicio` | Comentario de línea explicativo: `Mover $inicio al primer día de semana correcto >= fecha_inicio`. |
| `27` | `        $diaCurrent = (int)$inicio->format('w');` | Instrucción de ejecución en el contexto del script: `$diaCurrent = (int)$inicio->format('w');`. |
| `28` | `        $diff = ($diaSem - $diaCurrent + 7) % 7;` | Instrucción de ejecución en el contexto del script: `$diff = ($diaSem - $diaCurrent + 7) % 7;`. |
| `29` | `        if ($diff > 0) $inicio->modify("+{$diff} days");` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if ($diff > 0) $inicio->modify("+{$diff} days");`. |
| `30` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `31` | `        $ins = $this->conn->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$ins = $this->conn->prepare(`. |
| `32` | `            "INSERT IGNORE INTO turnos` | Instrucción de ejecución en el contexto del script: `"INSERT IGNORE INTO turnos`. |
| `33` | `               (id_asignacion, fecha_turno, fecha_apertura, fecha_cierre, e...` | Instrucción de ejecución en el contexto del script: `(id_asignacion, fecha_turno, fecha_apertura, fecha_cierre, estado)`. |
| `34` | `             VALUES (:asig, :fecha, :apertura, :cierre, 'Pendiente')"` | Instrucción de ejecución en el contexto del script: `VALUES (:asig, :fecha, :apertura, :cierre, 'Pendiente')"`. |
| `35` | `        );` | Instrucción de ejecución en el contexto del script: `);`. |
| `36` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `37` | `        $count  = 0;` | Instrucción de ejecución en el contexto del script: `$count  = 0;`. |
| `38` | `        $cursor = clone $inicio;` | Instrucción de ejecución en el contexto del script: `$cursor = clone $inicio;`. |
| `39` | `        while ($cursor <= $fin) {` | Bucle `while` que itera mientras se cumpla la condición especificada: `while ($cursor <= $fin) {`. |
| `40` | `            $fechaStr = $cursor->format('Y-m-d');` | Instrucción de ejecución en el contexto del script: `$fechaStr = $cursor->format('Y-m-d');`. |
| `41` | `            $ins->execute([` | Ejecuta la sentencia SQL preparada vinculando los datos correspondientes: `$ins->execute([`. |
| `42` | `                ':asig'     => $idAsignacion,` | Instrucción de ejecución en el contexto del script: `':asig'     => $idAsignacion,`. |
| `43` | `                ':fecha'    => $fechaStr,` | Instrucción de ejecución en el contexto del script: `':fecha'    => $fechaStr,`. |
| `44` | `                ':apertura' => $fechaStr . ' 00:00:00',` | Instrucción de ejecución en el contexto del script: `':apertura' => $fechaStr . ' 00:00:00',`. |
| `45` | `                ':cierre'   => $fechaStr . ' 23:59:59',` | Instrucción de ejecución en el contexto del script: `':cierre'   => $fechaStr . ' 23:59:59',`. |
| `46` | `            ]);` | Instrucción de ejecución en el contexto del script: `]);`. |
| `47` | `            $count++;` | Instrucción de ejecución en el contexto del script: `$count++;`. |
| `48` | `            $cursor->modify('+7 days');` | Instrucción de ejecución en el contexto del script: `$cursor->modify('+7 days');`. |
| `49` | `        }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `50` | `        return $count;` | Retorna el valor resultante de la expresión y culmina la ejecución de la función actual: `return $count;`. |
| `51` | `    }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `52` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `53` | `    /**` | Comentario de bloque o anotación informativa dentro del código. |
| `54` | `     * Devuelve la fecha del próximo turno SIN grupo asignado (>= hoy) para...` | Comentario de bloque o anotación informativa dentro del código. |
| `55` | `     * Esta es la fecha que se asignará automáticamente al siguiente grupo ...` | Comentario de bloque o anotación informativa dentro del código. |
| `56` | `     */` | Comentario de bloque o anotación informativa dentro del código. |
| `57` | `    public function proximaFechaLibre(int $idAsignacion): string\|false` | Declaración de método o función con su firma y parámetros: `public function proximaFechaLibre(int $idAsignacion): string\|false`. |
| `58` | `    {` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `59` | `        $stmt = $this->conn->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmt = $this->conn->prepare(`. |
| `60` | `            "SELECT fecha_turno FROM turnos` | Instrucción de ejecución en el contexto del script: `"SELECT fecha_turno FROM turnos`. |
| `61` | `             WHERE id_asignacion = :asig` | Instrucción de ejecución en el contexto del script: `WHERE id_asignacion = :asig`. |
| `62` | `               AND id_grupo IS NULL` | Instrucción de ejecución en el contexto del script: `AND id_grupo IS NULL`. |
| `63` | `               AND fecha_turno >= CURDATE()` | Instrucción de ejecución en el contexto del script: `AND fecha_turno >= CURDATE()`. |
| `64` | `             ORDER BY fecha_turno ASC` | Instrucción de ejecución en el contexto del script: `ORDER BY fecha_turno ASC`. |
| `65` | `             LIMIT 1"` | Instrucción de ejecución en el contexto del script: `LIMIT 1"`. |
| `66` | `        );` | Instrucción de ejecución en el contexto del script: `);`. |
| `67` | `        $stmt->execute([':asig' => $idAsignacion]);` | Ejecuta la sentencia SQL preparada vinculando los datos correspondientes: `$stmt->execute([':asig' => $idAsignacion]);`. |
| `68` | `        $row = $stmt->fetch(PDO::FETCH_ASSOC);` | Recupera una única fila o registro resultante de la consulta. |
| `69` | `        return $row ? $row['fecha_turno'] : false;` | Retorna el valor resultante de la expresión y culmina la ejecución de la función actual: `return $row ? $row['fecha_turno'] : false;`. |
| `70` | `    }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `71` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `72` | `    /**` | Comentario de bloque o anotación informativa dentro del código. |
| `73` | `     * Vincula un grupo recién creado al turno que coincide con la fecha as...` | Comentario de bloque o anotación informativa dentro del código. |
| `74` | `     */` | Comentario de bloque o anotación informativa dentro del código. |
| `75` | `    public function asignarGrupoAlTurno(int $idAsignacion, string $fechaTur...` | Declaración de método o función con su firma y parámetros: `public function asignarGrupoAlTurno(int $idAsignacion, string $fechaTurno, int $idGrupo): void`. |
| `76` | `    {` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `77` | `        $this->conn->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$this->conn->prepare(`. |
| `78` | `            "UPDATE turnos` | Instrucción de ejecución en el contexto del script: `"UPDATE turnos`. |
| `79` | `             SET id_grupo = :grupo` | Instrucción de ejecución en el contexto del script: `SET id_grupo = :grupo`. |
| `80` | `             WHERE id_asignacion = :asig AND fecha_turno = :fecha AND id_gr...` | Instrucción de ejecución en el contexto del script: `WHERE id_asignacion = :asig AND fecha_turno = :fecha AND id_grupo IS NULL`. |
| `81` | `             LIMIT 1"` | Instrucción de ejecución en el contexto del script: `LIMIT 1"`. |
| `82` | `        )->execute([` | Ejecuta la sentencia SQL preparada vinculando los datos correspondientes: `)->execute([`. |
| `83` | `            ':grupo' => $idGrupo,` | Instrucción de ejecución en el contexto del script: `':grupo' => $idGrupo,`. |
| `84` | `            ':asig'  => $idAsignacion,` | Instrucción de ejecución en el contexto del script: `':asig'  => $idAsignacion,`. |
| `85` | `            ':fecha' => $fechaTurno,` | Instrucción de ejecución en el contexto del script: `':fecha' => $fechaTurno,`. |
| `86` | `        ]);` | Instrucción de ejecución en el contexto del script: `]);`. |
| `87` | `    }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `88` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `89` | `    /**` | Comentario de bloque o anotación informativa dentro del código. |
| `90` | `     * Cuenta cuántos turnos sin grupo quedan en la asignación.` | Comentario de bloque o anotación informativa dentro del código. |
| `91` | `     */` | Comentario de bloque o anotación informativa dentro del código. |
| `92` | `    public function turnosLibresRestantes(int $idAsignacion): int` | Declaración de método o función con su firma y parámetros: `public function turnosLibresRestantes(int $idAsignacion): int`. |
| `93` | `    {` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `94` | `        $stmt = $this->conn->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmt = $this->conn->prepare(`. |
| `95` | `            "SELECT COUNT(*) FROM turnos` | Instrucción de ejecución en el contexto del script: `"SELECT COUNT(*) FROM turnos`. |
| `96` | `             WHERE id_asignacion = :asig` | Instrucción de ejecución en el contexto del script: `WHERE id_asignacion = :asig`. |
| `97` | `               AND id_grupo IS NULL` | Instrucción de ejecución en el contexto del script: `AND id_grupo IS NULL`. |
| `98` | `               AND fecha_turno >= CURDATE()"` | Instrucción de ejecución en el contexto del script: `AND fecha_turno >= CURDATE()"`. |
| `99` | `        );` | Instrucción de ejecución en el contexto del script: `);`. |
| `100` | `        $stmt->execute([':asig' => $idAsignacion]);` | Ejecuta la sentencia SQL preparada vinculando los datos correspondientes: `$stmt->execute([':asig' => $idAsignacion]);`. |
| `101` | `        return (int)$stmt->fetchColumn();` | Retorna el valor resultante de la expresión y culmina la ejecución de la función actual: `return (int)$stmt->fetchColumn();`. |
| `102` | `    }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `103` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `104` | `    /**` | Comentario de bloque o anotación informativa dentro del código. |
| `105` | `     * Cada turno le corresponde a un grupo diferente en orden de creación ...` | Comentario de bloque o anotación informativa dentro del código. |
| `106` | `     * El turno del miércoles N → Grupo A, el del miércoles N+1 → Grupo B, ...` | Comentario de bloque o anotación informativa dentro del código. |
| `107` | `     */` | Comentario de bloque o anotación informativa dentro del código. |
| `108` | `    public function asignarGruposRotacion(int $idAsignacion): void` | Declaración de método o función con su firma y parámetros: `public function asignarGruposRotacion(int $idAsignacion): void`. |
| `109` | `    {` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `110` | `        // Grupos de la asignación ordenados por id_grupo ASC (orden de cre...` | Comentario de línea explicativo: `Grupos de la asignación ordenados por id_grupo ASC (orden de creación)`. |
| `111` | `        $stmtG = $this->conn->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmtG = $this->conn->prepare(`. |
| `112` | `            "SELECT id_grupo FROM grupos` | Instrucción de ejecución en el contexto del script: `"SELECT id_grupo FROM grupos`. |
| `113` | `             WHERE id_asignacion = :asig` | Instrucción de ejecución en el contexto del script: `WHERE id_asignacion = :asig`. |
| `114` | `             ORDER BY id_grupo ASC"` | Instrucción de ejecución en el contexto del script: `ORDER BY id_grupo ASC"`. |
| `115` | `        );` | Instrucción de ejecución en el contexto del script: `);`. |
| `116` | `        $stmtG->execute([':asig' => $idAsignacion]);` | Ejecuta la sentencia SQL preparada vinculando los datos correspondientes: `$stmtG->execute([':asig' => $idAsignacion]);`. |
| `117` | `        $grupos = $stmtG->fetchAll(PDO::FETCH_COLUMN);` | Obtiene todos los registros coincidentes de la consulta en un arreglo asociativo. |
| `118` | `        if (empty($grupos)) return;` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (empty($grupos)) return;`. |
| `119` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `120` | `        // Todos los turnos de la asignación ordenados por fecha ASC` | Comentario de línea explicativo: `Todos los turnos de la asignación ordenados por fecha ASC`. |
| `121` | `        $stmtT = $this->conn->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmtT = $this->conn->prepare(`. |
| `122` | `            "SELECT id_turno, fecha_turno FROM turnos` | Instrucción de ejecución en el contexto del script: `"SELECT id_turno, fecha_turno FROM turnos`. |
| `123` | `             WHERE id_asignacion = :asig` | Instrucción de ejecución en el contexto del script: `WHERE id_asignacion = :asig`. |
| `124` | `             ORDER BY fecha_turno ASC"` | Instrucción de ejecución en el contexto del script: `ORDER BY fecha_turno ASC"`. |
| `125` | `        );` | Instrucción de ejecución en el contexto del script: `);`. |
| `126` | `        $stmtT->execute([':asig' => $idAsignacion]);` | Ejecuta la sentencia SQL preparada vinculando los datos correspondientes: `$stmtT->execute([':asig' => $idAsignacion]);`. |
| `127` | `        $turnos = $stmtT->fetchAll(PDO::FETCH_ASSOC);` | Obtiene todos los registros coincidentes de la consulta en un arreglo asociativo. |
| `128` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `129` | `        $updTurno = $this->conn->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$updTurno = $this->conn->prepare(`. |
| `130` | `            "UPDATE turnos SET id_grupo = :grupo WHERE id_turno = :turno"` | Instrucción de ejecución en el contexto del script: `"UPDATE turnos SET id_grupo = :grupo WHERE id_turno = :turno"`. |
| `131` | `        );` | Instrucción de ejecución en el contexto del script: `);`. |
| `132` | `        $updGrupo = $this->conn->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$updGrupo = $this->conn->prepare(`. |
| `133` | `            "UPDATE grupos SET fecha_limpieza = :fecha WHERE id_grupo = :id"` | Instrucción de ejecución en el contexto del script: `"UPDATE grupos SET fecha_limpieza = :fecha WHERE id_grupo = :id"`. |
| `134` | `        );` | Instrucción de ejecución en el contexto del script: `);`. |
| `135` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `136` | `        $n = count($grupos);` | Instrucción de ejecución en el contexto del script: `$n = count($grupos);`. |
| `137` | `        foreach ($turnos as $i => $t) {` | Bucle de iteración `foreach` para recorrer arreglos o colecciones de registros: `foreach ($turnos as $i => $t) {`. |
| `138` | `            $idGrupo = $grupos[$i % $n];` | Instrucción de ejecución en el contexto del script: `$idGrupo = $grupos[$i % $n];`. |
| `139` | `            $updTurno->execute([':grupo' => $idGrupo, ':turno' => $t['id_tu...` | Ejecuta la sentencia SQL preparada vinculando los datos correspondientes: `$updTurno->execute([':grupo' => $idGrupo, ':turno' => $t['id_turno']]);`. |
| `140` | `            // Actualizar la fecha_limpieza del grupo con el turno que le c...` | Comentario de línea explicativo: `Actualizar la fecha_limpieza del grupo con el turno que le corresponde`. |
| `141` | `            // (la más próxima futura o la del primer turno asignado)` | Comentario de línea explicativo: `(la más próxima futura o la del primer turno asignado)`. |
| `142` | `            $updGrupo->execute([':fecha' => $t['fecha_turno'], ':id' => $id...` | Ejecuta la sentencia SQL preparada vinculando los datos correspondientes: `$updGrupo->execute([':fecha' => $t['fecha_turno'], ':id' => $idGrupo]);`. |
| `143` | `        }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `144` | `    }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `145` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `146` | `    /**` | Comentario de bloque o anotación informativa dentro del código. |
| `147` | `     * Devuelve el turno activo HOY para la ficha del vocero.` | Comentario de bloque o anotación informativa dentro del código. |
| `148` | `     */` | Comentario de bloque o anotación informativa dentro del código. |
| `149` | `    public function turnoActivoHoy(int $idFicha): array\|false` | Declaración de método o función con su firma y parámetros: `public function turnoActivoHoy(int $idFicha): array\|false`. |
| `150` | `    {` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `151` | `        $stmt = $this->conn->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmt = $this->conn->prepare(`. |
| `152` | `            "SELECT t.*,` | Instrucción de ejecución en el contexto del script: `"SELECT t.*,`. |
| `153` | `                    a.id_modulo,` | Instrucción de ejecución en el contexto del script: `a.id_modulo,`. |
| `154` | `                    m.nombre   AS nombre_modulo,` | Instrucción de ejecución en el contexto del script: `m.nombre   AS nombre_modulo,`. |
| `155` | `                    m.ubicacion,` | Instrucción de ejecución en el contexto del script: `m.ubicacion,`. |
| `156` | `                    g.nombre_grupo,` | Instrucción de ejecución en el contexto del script: `g.nombre_grupo,`. |
| `157` | `                    g.id_grupo AS id_grupo_turno,` | Instrucción de ejecución en el contexto del script: `g.id_grupo AS id_grupo_turno,`. |
| `158` | `                    (SELECT COUNT(*) FROM evidencias e` | Instrucción de ejecución en el contexto del script: `(SELECT COUNT(*) FROM evidencias e`. |
| `159` | `                     WHERE e.id_turno = t.id_turno) AS tiene_evidencia` | Instrucción de ejecución en el contexto del script: `WHERE e.id_turno = t.id_turno) AS tiene_evidencia`. |
| `160` | `             FROM turnos t` | Instrucción de ejecución en el contexto del script: `FROM turnos t`. |
| `161` | `             JOIN asignaciones a ON a.id_asignacion = t.id_asignacion` | Instrucción de ejecución en el contexto del script: `JOIN asignaciones a ON a.id_asignacion = t.id_asignacion`. |
| `162` | `             JOIN modulos      m ON m.id_modulo     = a.id_modulo` | Instrucción de ejecución en el contexto del script: `JOIN modulos      m ON m.id_modulo     = a.id_modulo`. |
| `163` | `             LEFT JOIN grupos  g ON g.id_grupo      = t.id_grupo` | Instrucción de ejecución en el contexto del script: `LEFT JOIN grupos  g ON g.id_grupo      = t.id_grupo`. |
| `164` | `             WHERE a.id_ficha    = :ficha` | Instrucción de ejecución en el contexto del script: `WHERE a.id_ficha    = :ficha`. |
| `165` | `               AND t.fecha_turno = CURDATE()` | Instrucción de ejecución en el contexto del script: `AND t.fecha_turno = CURDATE()`. |
| `166` | `               AND NOW() BETWEEN t.fecha_apertura AND t.fecha_cierre` | Instrucción de ejecución en el contexto del script: `AND NOW() BETWEEN t.fecha_apertura AND t.fecha_cierre`. |
| `167` | `             LIMIT 1"` | Instrucción de ejecución en el contexto del script: `LIMIT 1"`. |
| `168` | `        );` | Instrucción de ejecución en el contexto del script: `);`. |
| `169` | `        $stmt->execute([':ficha' => $idFicha]);` | Ejecuta la sentencia SQL preparada vinculando los datos correspondientes: `$stmt->execute([':ficha' => $idFicha]);`. |
| `170` | `        return $stmt->fetch(PDO::FETCH_ASSOC);` | Retorna el valor resultante de la expresión y culmina la ejecución de la función actual: `return $stmt->fetch(PDO::FETCH_ASSOC);`. |
| `171` | `    }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `172` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `173` | `    /**` | Comentario de bloque o anotación informativa dentro del código. |
| `174` | `     * Historial de turnos de la ficha ordenados desc.` | Comentario de bloque o anotación informativa dentro del código. |
| `175` | `     */` | Comentario de bloque o anotación informativa dentro del código. |
| `176` | `    public function historialFicha(int $idFicha, int $limit = 15): array` | Declaración de método o función con su firma y parámetros: `public function historialFicha(int $idFicha, int $limit = 15): array`. |
| `177` | `    {` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `178` | `        $stmt = $this->conn->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmt = $this->conn->prepare(`. |
| `179` | `            "SELECT t.*,` | Instrucción de ejecución en el contexto del script: `"SELECT t.*,`. |
| `180` | `                    m.nombre AS nombre_modulo,` | Instrucción de ejecución en el contexto del script: `m.nombre AS nombre_modulo,`. |
| `181` | `                    g.nombre_grupo,` | Instrucción de ejecución en el contexto del script: `g.nombre_grupo,`. |
| `182` | `                    (SELECT COUNT(*) FROM evidencias e` | Instrucción de ejecución en el contexto del script: `(SELECT COUNT(*) FROM evidencias e`. |
| `183` | `                     WHERE e.id_turno = t.id_turno) AS tiene_evidencia` | Instrucción de ejecución en el contexto del script: `WHERE e.id_turno = t.id_turno) AS tiene_evidencia`. |
| `184` | `             FROM turnos t` | Instrucción de ejecución en el contexto del script: `FROM turnos t`. |
| `185` | `             JOIN asignaciones a ON a.id_asignacion = t.id_asignacion` | Instrucción de ejecución en el contexto del script: `JOIN asignaciones a ON a.id_asignacion = t.id_asignacion`. |
| `186` | `             JOIN modulos      m ON m.id_modulo     = a.id_modulo` | Instrucción de ejecución en el contexto del script: `JOIN modulos      m ON m.id_modulo     = a.id_modulo`. |
| `187` | `             LEFT JOIN grupos  g ON g.id_grupo      = t.id_grupo` | Instrucción de ejecución en el contexto del script: `LEFT JOIN grupos  g ON g.id_grupo      = t.id_grupo`. |
| `188` | `             WHERE a.id_ficha = :ficha` | Instrucción de ejecución en el contexto del script: `WHERE a.id_ficha = :ficha`. |
| `189` | `             ORDER BY t.fecha_turno DESC` | Instrucción de ejecución en el contexto del script: `ORDER BY t.fecha_turno DESC`. |
| `190` | `             LIMIT :lim"` | Instrucción de ejecución en el contexto del script: `LIMIT :lim"`. |
| `191` | `        );` | Instrucción de ejecución en el contexto del script: `);`. |
| `192` | `        $stmt->bindValue(':ficha', $idFicha, PDO::PARAM_INT);` | Instrucción de ejecución en el contexto del script: `$stmt->bindValue(':ficha', $idFicha, PDO::PARAM_INT);`. |
| `193` | `        $stmt->bindValue(':lim',   $limit,   PDO::PARAM_INT);` | Instrucción de ejecución en el contexto del script: `$stmt->bindValue(':lim',   $limit,   PDO::PARAM_INT);`. |
| `194` | `        $stmt->execute();` | Ejecuta la sentencia SQL preparada vinculando los datos correspondientes: `$stmt->execute();`. |
| `195` | `        return $stmt->fetchAll(PDO::FETCH_ASSOC);` | Retorna el valor resultante de la expresión y culmina la ejecución de la función actual: `return $stmt->fetchAll(PDO::FETCH_ASSOC);`. |
| `196` | `    }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `197` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `198` | `    /**` | Comentario de bloque o anotación informativa dentro del código. |
| `199` | `     * Marca turnos pasados sin evidencia como Incumplido.` | Comentario de bloque o anotación informativa dentro del código. |
| `200` | `     */` | Comentario de bloque o anotación informativa dentro del código. |
| `201` | `    public function cerrarTurnosVencidos(): void` | Declaración de método o función con su firma y parámetros: `public function cerrarTurnosVencidos(): void`. |
| `202` | `    {` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `203` | `        $this->conn->exec(` | Instrucción de ejecución en el contexto del script: `$this->conn->exec(`. |
| `204` | `            "UPDATE turnos t` | Instrucción de ejecución en el contexto del script: `"UPDATE turnos t`. |
| `205` | `             SET t.estado = 'Incumplido'` | Instrucción de ejecución en el contexto del script: `SET t.estado = 'Incumplido'`. |
| `206` | `             WHERE t.fecha_cierre < NOW()` | Instrucción de ejecución en el contexto del script: `WHERE t.fecha_cierre < NOW()`. |
| `207` | `               AND t.estado IN ('Pendiente','Abierto')` | Instrucción de ejecución en el contexto del script: `AND t.estado IN ('Pendiente','Abierto')`. |
| `208` | `               AND NOT EXISTS (` | Instrucción de ejecución en el contexto del script: `AND NOT EXISTS (`. |
| `209` | `                   SELECT 1 FROM evidencias e WHERE e.id_turno = t.id_turno` | Instrucción de ejecución en el contexto del script: `SELECT 1 FROM evidencias e WHERE e.id_turno = t.id_turno`. |
| `210` | `               )"` | Instrucción de ejecución en el contexto del script: `)"`. |
| `211` | `        );` | Instrucción de ejecución en el contexto del script: `);`. |
| `212` | `    }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `213` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `214` | `    /**` | Comentario de bloque o anotación informativa dentro del código. |
| `215` | `     * Abre los turnos de hoy (Pendiente → Abierto).` | Comentario de bloque o anotación informativa dentro del código. |
| `216` | `     */` | Comentario de bloque o anotación informativa dentro del código. |
| `217` | `    public function abrirTurnosHoy(): void` | Declaración de método o función con su firma y parámetros: `public function abrirTurnosHoy(): void`. |
| `218` | `    {` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `219` | `        $this->conn->exec(` | Instrucción de ejecución en el contexto del script: `$this->conn->exec(`. |
| `220` | `            "UPDATE turnos SET estado = 'Abierto'` | Instrucción de ejecución en el contexto del script: `"UPDATE turnos SET estado = 'Abierto'`. |
| `221` | `             WHERE fecha_turno = CURDATE() AND estado = 'Pendiente'"` | Instrucción de ejecución en el contexto del script: `WHERE fecha_turno = CURDATE() AND estado = 'Pendiente'"`. |
| `222` | `        );` | Instrucción de ejecución en el contexto del script: `);`. |
| `223` | `    }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `224` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `225` | `    /**` | Comentario de bloque o anotación informativa dentro del código. |
| `226` | `     * Marca turno como Cumplido al registrar evidencia.` | Comentario de bloque o anotación informativa dentro del código. |
| `227` | `     */` | Comentario de bloque o anotación informativa dentro del código. |
| `228` | `    public function marcarCumplido(int $idTurno): void` | Declaración de método o función con su firma y parámetros: `public function marcarCumplido(int $idTurno): void`. |
| `229` | `    {` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `230` | `        $this->conn->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$this->conn->prepare(`. |
| `231` | `            "UPDATE turnos SET estado = 'Cumplido' WHERE id_turno = :id"` | Instrucción de ejecución en el contexto del script: `"UPDATE turnos SET estado = 'Cumplido' WHERE id_turno = :id"`. |
| `232` | `        )->execute([':id' => $idTurno]);` | Ejecuta la sentencia SQL preparada vinculando los datos correspondientes: `)->execute([':id' => $idTurno]);`. |
| `233` | `    }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `234` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `235` | `    /**` | Comentario de bloque o anotación informativa dentro del código. |
| `236` | `     * Turnos próximos de la ficha (hoy en adelante).` | Comentario de bloque o anotación informativa dentro del código. |
| `237` | `     */` | Comentario de bloque o anotación informativa dentro del código. |
| `238` | `    public function proximosFicha(int $idFicha, int $limit = 5): array` | Declaración de método o función con su firma y parámetros: `public function proximosFicha(int $idFicha, int $limit = 5): array`. |
| `239` | `    {` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `240` | `        $stmt = $this->conn->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmt = $this->conn->prepare(`. |
| `241` | `            "SELECT t.*, m.nombre AS nombre_modulo, g.nombre_grupo` | Instrucción de ejecución en el contexto del script: `"SELECT t.*, m.nombre AS nombre_modulo, g.nombre_grupo`. |
| `242` | `             FROM turnos t` | Instrucción de ejecución en el contexto del script: `FROM turnos t`. |
| `243` | `             JOIN asignaciones a ON a.id_asignacion = t.id_asignacion` | Instrucción de ejecución en el contexto del script: `JOIN asignaciones a ON a.id_asignacion = t.id_asignacion`. |
| `244` | `             JOIN modulos      m ON m.id_modulo     = a.id_modulo` | Instrucción de ejecución en el contexto del script: `JOIN modulos      m ON m.id_modulo     = a.id_modulo`. |
| `245` | `             LEFT JOIN grupos  g ON g.id_grupo      = t.id_grupo` | Instrucción de ejecución en el contexto del script: `LEFT JOIN grupos  g ON g.id_grupo      = t.id_grupo`. |
| `246` | `             WHERE a.id_ficha   = :ficha` | Instrucción de ejecución en el contexto del script: `WHERE a.id_ficha   = :ficha`. |
| `247` | `               AND t.fecha_turno >= CURDATE()` | Instrucción de ejecución en el contexto del script: `AND t.fecha_turno >= CURDATE()`. |
| `248` | `             ORDER BY t.fecha_turno ASC` | Instrucción de ejecución en el contexto del script: `ORDER BY t.fecha_turno ASC`. |
| `249` | `             LIMIT :lim"` | Instrucción de ejecución en el contexto del script: `LIMIT :lim"`. |
| `250` | `        );` | Instrucción de ejecución en el contexto del script: `);`. |
| `251` | `        $stmt->bindValue(':ficha', $idFicha, PDO::PARAM_INT);` | Instrucción de ejecución en el contexto del script: `$stmt->bindValue(':ficha', $idFicha, PDO::PARAM_INT);`. |
| `252` | `        $stmt->bindValue(':lim',   $limit,   PDO::PARAM_INT);` | Instrucción de ejecución en el contexto del script: `$stmt->bindValue(':lim',   $limit,   PDO::PARAM_INT);`. |
| `253` | `        $stmt->execute();` | Ejecuta la sentencia SQL preparada vinculando los datos correspondientes: `$stmt->execute();`. |
| `254` | `        return $stmt->fetchAll(PDO::FETCH_ASSOC);` | Retorna el valor resultante de la expresión y culmina la ejecución de la función actual: `return $stmt->fetchAll(PDO::FETCH_ASSOC);`. |
| `255` | `    }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `256` | `}` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `257` | `?>` | Cierre de la etiqueta PHP para alternar a salida HTML o fin del archivo. |

---

## 3. Resumen y Flujo de Interacción

El archivo `Turno.php` cumple un rol indispensable en `models/Turno.php`. 
Modelo de datos para la programación, cálculo de fechas y estado de turnos de limpieza asignados a los grupos de cada módulo. Garantiza la robustez, el orden y la estabilidad de la arquitectura del proyecto `systemLimpieza`.
