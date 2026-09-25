# Documentación Línea por Línea: `models/Turno.php`

## 1. Ficha Técnica del Archivo

- **Archivo:** `Turno.php`
- **Ruta en el proyecto:** `models/Turno.php`
- **Cantidad total de líneas:** `349`
- **Tipo de archivo:** `PHP`
- **Propósito general:** Modelo de datos para la programación, cálculo de fechas y estado de turnos de limpieza asignados a los grupos de cada módulo.

---

## 2. Explicación Detallada Línea por Línea

A continuación se presenta cada línea de código numerada de forma consecutiva, acompañada de su fragmento exacto y la explicación exhaustiva de su funcionamiento y responsabilidad en el sistema:

| Línea | Código Fuente | Explicación Detallada |
|---|---|---|
| `1` | ``<?php`` | Apertura obligatoria de la etiqueta PHP para ejecución del código del lado del servidor. |
| `2` | `class Turno` | Declaración de la clase del componente: `class Turno`. |
| `3` | ``{`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `4` | `private PDO $conn;` | Definición de propiedad de clase para el estado interno del componente: `private PDO $conn;`. |
| `5` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `6` | `public function __construct(PDO $db) { $this->conn = $db; }` | Declaración de método o función con su firma y parámetros: `public function __construct(PDO $db) { $this->conn = $db; }`. |
| `7` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `8` | `/**` | Comentario multilínea de documentación o aclaración técnica. |
| `9` | `* Genera turnos semanales para una asignación (INSERT IGNORE).` | Comentario multilínea de documentación o aclaración técnica. |
| `10` | `* Retorna la cantidad de turnos creados.` | Comentario multilínea de documentación o aclaración técnica. |
| `11` | `*/` | Comentario multilínea de documentación o aclaración técnica. |
| `12` | `public function generarTurnosAsignacion(int $idAsignacion): int` | Declaración de método o función con su firma y parámetros: `public function generarTurnosAsignacion(int $idAsignacion): int`. |
| `13` | ``{`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `14` | `$stmt = $this->conn->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmt = $this->conn->prepare(`. |
| `15` | `"SELECT id_asignacion, fecha_inicio, fecha_fin, dia_semana` | Instrucción de ejecución en el contexto del script: `"SELECT id_asignacion, fecha_inicio, fecha_fin, dia_semana`. |
| `16` | `FROM asignaciones WHERE id_asignacion = :id LIMIT 1"` | Instrucción de ejecución en el contexto del script: `FROM asignaciones WHERE id_asignacion = :id LIMIT 1"`. |
| `17` | ``);`` | Cierre de estructura de arreglo o invocación de función. |
| `18` | `$stmt->execute([':id' => $idAsignacion]);` | Ejecuta la sentencia SQL preparada vinculando los parámetros correspondientes: `$stmt->execute([':id' => $idAsignacion]);`. |
| `19` | `$asig = $stmt->fetch(PDO::FETCH_ASSOC);` | Recupera una única fila o registro resultante de la consulta. |
| `20` | `if (!$asig) return 0;` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (!$asig) return 0;`. |
| `21` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `22` | `$inicio  = new DateTime($asig['fecha_inicio']);` | Instrucción de ejecución en el contexto del script: `$inicio  = new DateTime($asig['fecha_inicio']);`. |
| `23` | `$fin     = new DateTime($asig['fecha_fin']);` | Instrucción de ejecución en el contexto del script: `$fin     = new DateTime($asig['fecha_fin']);`. |
| `24` | `$diaSem  = (int)$asig['dia_semana']; // 0=Dom … 6=Sáb` | Instrucción de ejecución en el contexto del script: `$diaSem  = (int)$asig['dia_semana']; // 0=Dom … 6=Sáb`. |
| `25` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `26` | `// Mover $inicio al primer día de semana correcto >= fecha_inicio` | Comentario explicativo en el código: `Mover $inicio al primer día de semana correcto >= fecha_inicio`. |
| `27` | `$diaCurrent = (int)$inicio->format('w');` | Instrucción de ejecución en el contexto del script: `$diaCurrent = (int)$inicio->format('w');`. |
| `28` | `$diff = ($diaSem - $diaCurrent + 7) % 7;` | Instrucción de ejecución en el contexto del script: `$diff = ($diaSem - $diaCurrent + 7) % 7;`. |
| `29` | `if ($diff > 0) $inicio->modify("+{$diff} days");` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if ($diff > 0) $inicio->modify("+{$diff} days");`. |
| `30` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `31` | `$ins = $this->conn->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$ins = $this->conn->prepare(`. |
| `32` | `"INSERT IGNORE INTO turnos` | Instrucción de ejecución en el contexto del script: `"INSERT IGNORE INTO turnos`. |
| `33` | `(id_asignacion, fecha_turno, fecha_apertura, fecha_cierre, estado)` | Instrucción de ejecución en el contexto del script: `(id_asignacion, fecha_turno, fecha_apertura, fecha_cierre, estado)`. |
| `34` | `VALUES (:asig, :fecha, :apertura, :cierre, 'Pendiente')"` | Instrucción de ejecución en el contexto del script: `VALUES (:asig, :fecha, :apertura, :cierre, 'Pendiente')"`. |
| `35` | ``);`` | Cierre de estructura de arreglo o invocación de función. |
| `36` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `37` | `$count  = 0;` | Instrucción de ejecución en el contexto del script: `$count  = 0;`. |
| `38` | `$cursor = clone $inicio;` | Instrucción de ejecución en el contexto del script: `$cursor = clone $inicio;`. |
| `39` | `while ($cursor <= $fin) {` | Instrucción de ejecución en el contexto del script: `while ($cursor <= $fin) {`. |
| `40` | `$fechaStr = $cursor->format('Y-m-d');` | Instrucción de ejecución en el contexto del script: `$fechaStr = $cursor->format('Y-m-d');`. |
| `41` | `$ins->execute([` | Ejecuta la sentencia SQL preparada vinculando los parámetros correspondientes: `$ins->execute([`. |
| `42` | `':asig'     => $idAsignacion,` | Instrucción de ejecución en el contexto del script: `':asig'     => $idAsignacion,`. |
| `43` | `':fecha'    => $fechaStr,` | Instrucción de ejecución en el contexto del script: `':fecha'    => $fechaStr,`. |
| `44` | `':apertura' => $fechaStr . ' 00:00:00',` | Instrucción de ejecución en el contexto del script: `':apertura' => $fechaStr . ' 00:00:00',`. |
| `45` | `':cierre'   => $fechaStr . ' 23:59:59',` | Instrucción de ejecución en el contexto del script: `':cierre'   => $fechaStr . ' 23:59:59',`. |
| `46` | `]);` | Instrucción de ejecución en el contexto del script: `]);`. |
| `47` | `$count++;` | Instrucción de ejecución en el contexto del script: `$count++;`. |
| `48` | `$cursor->modify('+7 days');` | Instrucción de ejecución en el contexto del script: `$cursor->modify('+7 days');`. |
| `49` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `50` | `return $count;` | Instrucción de retorno que finaliza la ejecución entregando el resultado: `return $count;`. |
| `51` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `52` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `53` | `/**` | Comentario multilínea de documentación o aclaración técnica. |
| `54` | `* Devuelve la fecha del próximo turno SIN grupo asignado (>= hoy) para u...` | Comentario multilínea de documentación o aclaración técnica. |
| `55` | `* Esta es la fecha que se asignará automáticamente al siguiente grupo cr...` | Comentario multilínea de documentación o aclaración técnica. |
| `56` | `*/` | Comentario multilínea de documentación o aclaración técnica. |
| `57` | `public function proximaFechaLibre(int $idAsignacion): string\|false` | Declaración de método o función con su firma y parámetros: `public function proximaFechaLibre(int $idAsignacion): string\|false`. |
| `58` | ``{`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `59` | `$stmt = $this->conn->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmt = $this->conn->prepare(`. |
| `60` | `"SELECT fecha_turno FROM turnos` | Instrucción de ejecución en el contexto del script: `"SELECT fecha_turno FROM turnos`. |
| `61` | `WHERE id_asignacion = :asig` | Instrucción de ejecución en el contexto del script: `WHERE id_asignacion = :asig`. |
| `62` | `AND id_grupo IS NULL` | Instrucción de ejecución en el contexto del script: `AND id_grupo IS NULL`. |
| `63` | `AND fecha_turno >= CURDATE()` | Instrucción de ejecución en el contexto del script: `AND fecha_turno >= CURDATE()`. |
| `64` | `ORDER BY fecha_turno ASC` | Instrucción de ejecución en el contexto del script: `ORDER BY fecha_turno ASC`. |
| `65` | `LIMIT 1"` | Instrucción de ejecución en el contexto del script: `LIMIT 1"`. |
| `66` | ``);`` | Cierre de estructura de arreglo o invocación de función. |
| `67` | `$stmt->execute([':asig' => $idAsignacion]);` | Ejecuta la sentencia SQL preparada vinculando los parámetros correspondientes: `$stmt->execute([':asig' => $idAsignacion]);`. |
| `68` | `$row = $stmt->fetch(PDO::FETCH_ASSOC);` | Recupera una única fila o registro resultante de la consulta. |
| `69` | `return $row ? $row['fecha_turno'] : false;` | Instrucción de retorno que finaliza la ejecución entregando el resultado: `return $row ? $row['fecha_turno'] : false;`. |
| `70` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `71` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `72` | `/**` | Comentario multilínea de documentación o aclaración técnica. |
| `73` | `* Vincula un grupo recién creado al turno que coincide con la fecha asig...` | Comentario multilínea de documentación o aclaración técnica. |
| `74` | `*/` | Comentario multilínea de documentación o aclaración técnica. |
| `75` | `public function asignarGrupoAlTurno(int $idAsignacion, string $fechaTurn...` | Declaración de método o función con su firma y parámetros: `public function asignarGrupoAlTurno(int $idAsignacion, string $fechaTurn...`. |
| `76` | ``{`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `77` | `$this->conn->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$this->conn->prepare(`. |
| `78` | `"UPDATE turnos` | Instrucción de ejecución en el contexto del script: `"UPDATE turnos`. |
| `79` | `SET id_grupo = :grupo` | Instrucción de ejecución en el contexto del script: `SET id_grupo = :grupo`. |
| `80` | `WHERE id_asignacion = :asig AND fecha_turno = :fecha AND id_grupo IS NULL` | Instrucción de ejecución en el contexto del script: `WHERE id_asignacion = :asig AND fecha_turno = :fecha AND id_grupo IS NULL`. |
| `81` | `LIMIT 1"` | Instrucción de ejecución en el contexto del script: `LIMIT 1"`. |
| `82` | `)->execute([` | Ejecuta la sentencia SQL preparada vinculando los parámetros correspondientes: `)->execute([`. |
| `83` | `':grupo' => $idGrupo,` | Instrucción de ejecución en el contexto del script: `':grupo' => $idGrupo,`. |
| `84` | `':asig'  => $idAsignacion,` | Instrucción de ejecución en el contexto del script: `':asig'  => $idAsignacion,`. |
| `85` | `':fecha' => $fechaTurno,` | Instrucción de ejecución en el contexto del script: `':fecha' => $fechaTurno,`. |
| `86` | `]);` | Instrucción de ejecución en el contexto del script: `]);`. |
| `87` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `88` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `89` | `/**` | Comentario multilínea de documentación o aclaración técnica. |
| `90` | `* Cuenta cuántos turnos sin grupo quedan en la asignación.` | Comentario multilínea de documentación o aclaración técnica. |
| `91` | `*/` | Comentario multilínea de documentación o aclaración técnica. |
| `92` | `public function turnosLibresRestantes(int $idAsignacion): int` | Declaración de método o función con su firma y parámetros: `public function turnosLibresRestantes(int $idAsignacion): int`. |
| `93` | ``{`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `94` | `$stmt = $this->conn->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmt = $this->conn->prepare(`. |
| `95` | `"SELECT COUNT(*) FROM turnos` | Instrucción de ejecución en el contexto del script: `"SELECT COUNT(*) FROM turnos`. |
| `96` | `WHERE id_asignacion = :asig` | Instrucción de ejecución en el contexto del script: `WHERE id_asignacion = :asig`. |
| `97` | `AND id_grupo IS NULL` | Instrucción de ejecución en el contexto del script: `AND id_grupo IS NULL`. |
| `98` | `AND fecha_turno >= CURDATE()"` | Instrucción de ejecución en el contexto del script: `AND fecha_turno >= CURDATE()"`. |
| `99` | ``);`` | Cierre de estructura de arreglo o invocación de función. |
| `100` | `$stmt->execute([':asig' => $idAsignacion]);` | Ejecuta la sentencia SQL preparada vinculando los parámetros correspondientes: `$stmt->execute([':asig' => $idAsignacion]);`. |
| `101` | `return (int)$stmt->fetchColumn();` | Recupera el valor escalar de la primera columna del resultado de la consulta. |
| `102` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `103` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `104` | `/**` | Comentario multilínea de documentación o aclaración técnica. |
| `105` | `* Cada turno le corresponde a un grupo diferente en orden de creación (i...` | Comentario multilínea de documentación o aclaración técnica. |
| `106` | `* El turno del miércoles N → Grupo A, el del miércoles N+1 → Grupo B, etc.` | Comentario multilínea de documentación o aclaración técnica. |
| `107` | `*/` | Comentario multilínea de documentación o aclaración técnica. |
| `108` | `public function asignarGruposRotacion(int $idAsignacion): void` | Declaración de método o función con su firma y parámetros: `public function asignarGruposRotacion(int $idAsignacion): void`. |
| `109` | ``{`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `110` | `// Grupos de la asignación ordenados por id_grupo ASC (orden de creación)` | Comentario explicativo en el código: `Grupos de la asignación ordenados por id_grupo ASC (orden de creación)`. |
| `111` | `$stmtG = $this->conn->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmtG = $this->conn->prepare(`. |
| `112` | `"SELECT id_grupo FROM grupos` | Instrucción de ejecución en el contexto del script: `"SELECT id_grupo FROM grupos`. |
| `113` | `WHERE id_asignacion = :asig` | Instrucción de ejecución en el contexto del script: `WHERE id_asignacion = :asig`. |
| `114` | `ORDER BY id_grupo ASC"` | Instrucción de ejecución en el contexto del script: `ORDER BY id_grupo ASC"`. |
| `115` | ``);`` | Cierre de estructura de arreglo o invocación de función. |
| `116` | `$stmtG->execute([':asig' => $idAsignacion]);` | Ejecuta la sentencia SQL preparada vinculando los parámetros correspondientes: `$stmtG->execute([':asig' => $idAsignacion]);`. |
| `117` | `$grupos = $stmtG->fetchAll(PDO::FETCH_COLUMN);` | Obtiene todos los registros coincidentes de la consulta en un arreglo asociativo. |
| `118` | `if (empty($grupos)) return;` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (empty($grupos)) return;`. |
| `119` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `120` | `// Todos los turnos de la asignación ordenados por fecha ASC` | Comentario explicativo en el código: `Todos los turnos de la asignación ordenados por fecha ASC`. |
| `121` | `$stmtT = $this->conn->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmtT = $this->conn->prepare(`. |
| `122` | `"SELECT id_turno, fecha_turno FROM turnos` | Instrucción de ejecución en el contexto del script: `"SELECT id_turno, fecha_turno FROM turnos`. |
| `123` | `WHERE id_asignacion = :asig` | Instrucción de ejecución en el contexto del script: `WHERE id_asignacion = :asig`. |
| `124` | `ORDER BY fecha_turno ASC"` | Instrucción de ejecución en el contexto del script: `ORDER BY fecha_turno ASC"`. |
| `125` | ``);`` | Cierre de estructura de arreglo o invocación de función. |
| `126` | `$stmtT->execute([':asig' => $idAsignacion]);` | Ejecuta la sentencia SQL preparada vinculando los parámetros correspondientes: `$stmtT->execute([':asig' => $idAsignacion]);`. |
| `127` | `$turnos = $stmtT->fetchAll(PDO::FETCH_ASSOC);` | Obtiene todos los registros coincidentes de la consulta en un arreglo asociativo. |
| `128` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `129` | `$updTurno = $this->conn->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$updTurno = $this->conn->prepare(`. |
| `130` | `"UPDATE turnos SET id_grupo = :grupo WHERE id_turno = :turno"` | Instrucción de ejecución en el contexto del script: `"UPDATE turnos SET id_grupo = :grupo WHERE id_turno = :turno"`. |
| `131` | ``);`` | Cierre de estructura de arreglo o invocación de función. |
| `132` | `$updGrupo = $this->conn->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$updGrupo = $this->conn->prepare(`. |
| `133` | `"UPDATE grupos SET fecha_limpieza = :fecha WHERE id_grupo = :id"` | Instrucción de ejecución en el contexto del script: `"UPDATE grupos SET fecha_limpieza = :fecha WHERE id_grupo = :id"`. |
| `134` | ``);`` | Cierre de estructura de arreglo o invocación de función. |
| `135` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `136` | `$n = count($grupos);` | Instrucción de ejecución en el contexto del script: `$n = count($grupos);`. |
| `137` | `foreach ($turnos as $i => $t) {` | Estructura de control iterativa para recorrer colecciones o arreglos: `foreach ($turnos as $i => $t) {`. |
| `138` | `$idGrupo = $grupos[$i % $n];` | Instrucción de ejecución en el contexto del script: `$idGrupo = $grupos[$i % $n];`. |
| `139` | `$updTurno->execute([':grupo' => $idGrupo, ':turno' => $t['id_turno']]);` | Ejecuta la sentencia SQL preparada vinculando los parámetros correspondientes: `$updTurno->execute([':grupo' => $idGrupo, ':turno' => $t['id_turno']]);`. |
| `140` | `// Actualizar la fecha_limpieza del grupo con el turno que le corresponde` | Comentario explicativo en el código: `Actualizar la fecha_limpieza del grupo con el turno que le corresponde`. |
| `141` | `// (la más próxima futura o la del primer turno asignado)` | Comentario explicativo en el código: `(la más próxima futura o la del primer turno asignado)`. |
| `142` | `$updGrupo->execute([':fecha' => $t['fecha_turno'], ':id' => $idGrupo]);` | Ejecuta la sentencia SQL preparada vinculando los parámetros correspondientes: `$updGrupo->execute([':fecha' => $t['fecha_turno'], ':id' => $idGrupo]);`. |
| `143` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `144` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `145` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `146` | `/**` | Comentario multilínea de documentación o aclaración técnica. |
| `147` | `* Devuelve el turno activo HOY para la ficha del vocero.` | Comentario multilínea de documentación o aclaración técnica. |
| `148` | `*/` | Comentario multilínea de documentación o aclaración técnica. |
| `149` | `public function turnoActivoHoy(int $idFicha): array\|false` | Declaración de método o función con su firma y parámetros: `public function turnoActivoHoy(int $idFicha): array\|false`. |
| `150` | ``{`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `151` | `$stmt = $this->conn->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmt = $this->conn->prepare(`. |
| `152` | `"SELECT t.*,` | Instrucción de ejecución en el contexto del script: `"SELECT t.*,`. |
| `153` | `a.id_modulo,` | Instrucción de ejecución en el contexto del script: `a.id_modulo,`. |
| `154` | `m.nombre   AS nombre_modulo,` | Instrucción de ejecución en el contexto del script: `m.nombre   AS nombre_modulo,`. |
| `155` | `m.ubicacion,` | Instrucción de ejecución en el contexto del script: `m.ubicacion,`. |
| `156` | `g.nombre_grupo,` | Instrucción de ejecución en el contexto del script: `g.nombre_grupo,`. |
| `157` | `g.id_grupo AS id_grupo_turno,` | Instrucción de ejecución en el contexto del script: `g.id_grupo AS id_grupo_turno,`. |
| `158` | `(SELECT COUNT(*) FROM evidencias e` | Instrucción de ejecución en el contexto del script: `(SELECT COUNT(*) FROM evidencias e`. |
| `159` | `WHERE e.id_turno = t.id_turno) AS tiene_evidencia` | Instrucción de ejecución en el contexto del script: `WHERE e.id_turno = t.id_turno) AS tiene_evidencia`. |
| `160` | `FROM turnos t` | Instrucción de ejecución en el contexto del script: `FROM turnos t`. |
| `161` | `JOIN asignaciones a ON a.id_asignacion = t.id_asignacion` | Instrucción de ejecución en el contexto del script: `JOIN asignaciones a ON a.id_asignacion = t.id_asignacion`. |
| `162` | `JOIN modulos      m ON m.id_modulo     = a.id_modulo` | Instrucción de ejecución en el contexto del script: `JOIN modulos      m ON m.id_modulo     = a.id_modulo`. |
| `163` | `LEFT JOIN grupos  g ON g.id_grupo      = t.id_grupo` | Instrucción de ejecución en el contexto del script: `LEFT JOIN grupos  g ON g.id_grupo      = t.id_grupo`. |
| `164` | `WHERE a.id_ficha    = :ficha` | Instrucción de ejecución en el contexto del script: `WHERE a.id_ficha    = :ficha`. |
| `165` | `AND t.fecha_turno = CURDATE()` | Instrucción de ejecución en el contexto del script: `AND t.fecha_turno = CURDATE()`. |
| `166` | `AND NOW() BETWEEN t.fecha_apertura AND t.fecha_cierre` | Instrucción de ejecución en el contexto del script: `AND NOW() BETWEEN t.fecha_apertura AND t.fecha_cierre`. |
| `167` | `LIMIT 1"` | Instrucción de ejecución en el contexto del script: `LIMIT 1"`. |
| `168` | ``);`` | Cierre de estructura de arreglo o invocación de función. |
| `169` | `$stmt->execute([':ficha' => $idFicha]);` | Ejecuta la sentencia SQL preparada vinculando los parámetros correspondientes: `$stmt->execute([':ficha' => $idFicha]);`. |
| `170` | `$turno = $stmt->fetch(PDO::FETCH_ASSOC);` | Recupera una única fila o registro resultante de la consulta. |
| `171` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `172` | `if (!$turno) return false;` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (!$turno) return false;`. |
| `173` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `174` | `// Si el turno no tiene grupo vinculado, buscar el grupo de la ficha` | Comentario explicativo en el código: `Si el turno no tiene grupo vinculado, buscar el grupo de la ficha`. |
| `175` | `// cuya fecha_limpieza coincida con hoy` | Comentario explicativo en el código: `cuya fecha_limpieza coincida con hoy`. |
| `176` | `if (empty($turno['id_grupo_turno'])) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (empty($turno['id_grupo_turno'])) {`. |
| `177` | `$stmtG = $this->conn->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmtG = $this->conn->prepare(`. |
| `178` | `"SELECT g.id_grupo, g.nombre_grupo` | Instrucción de ejecución en el contexto del script: `"SELECT g.id_grupo, g.nombre_grupo`. |
| `179` | `FROM grupos g` | Instrucción de ejecución en el contexto del script: `FROM grupos g`. |
| `180` | `JOIN asignaciones a ON a.id_asignacion = g.id_asignacion` | Instrucción de ejecución en el contexto del script: `JOIN asignaciones a ON a.id_asignacion = g.id_asignacion`. |
| `181` | `WHERE a.id_ficha = :ficha` | Instrucción de ejecución en el contexto del script: `WHERE a.id_ficha = :ficha`. |
| `182` | `AND g.fecha_limpieza = CURDATE()` | Instrucción de ejecución en el contexto del script: `AND g.fecha_limpieza = CURDATE()`. |
| `183` | `LIMIT 1"` | Instrucción de ejecución en el contexto del script: `LIMIT 1"`. |
| `184` | ``);`` | Cierre de estructura de arreglo o invocación de función. |
| `185` | `$stmtG->execute([':ficha' => $idFicha]);` | Ejecuta la sentencia SQL preparada vinculando los parámetros correspondientes: `$stmtG->execute([':ficha' => $idFicha]);`. |
| `186` | `$grupo = $stmtG->fetch(PDO::FETCH_ASSOC);` | Recupera una única fila o registro resultante de la consulta. |
| `187` | `if ($grupo) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if ($grupo) {`. |
| `188` | `$turno['id_grupo_turno'] = $grupo['id_grupo'];` | Instrucción de ejecución en el contexto del script: `$turno['id_grupo_turno'] = $grupo['id_grupo'];`. |
| `189` | `$turno['nombre_grupo']   = $grupo['nombre_grupo'];` | Instrucción de ejecución en el contexto del script: `$turno['nombre_grupo']   = $grupo['nombre_grupo'];`. |
| `190` | `// Vincular el turno al grupo en la BD para que quede registrado` | Comentario explicativo en el código: `Vincular el turno al grupo en la BD para que quede registrado`. |
| `191` | `$this->conn->prepare("UPDATE turnos SET id_grupo = :g WHERE id_turno = :t")` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$this->conn->prepare("UPDATE turnos SET id_grupo = :g WHERE id_turno = :t")`. |
| `192` | `->execute([':g' => $grupo['id_grupo'], ':t' => $turno['id_turno']]);` | Ejecuta la sentencia SQL preparada vinculando los parámetros correspondientes: `->execute([':g' => $grupo['id_grupo'], ':t' => $turno['id_turno']]);`. |
| `193` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `194` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `195` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `196` | `return $turno;` | Instrucción de retorno que finaliza la ejecución entregando el resultado: `return $turno;`. |
| `197` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `198` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `199` | `/**` | Comentario multilínea de documentación o aclaración técnica. |
| `200` | `* Historial de turnos de la ficha ordenados desc.` | Comentario multilínea de documentación o aclaración técnica. |
| `201` | `*/` | Comentario multilínea de documentación o aclaración técnica. |
| `202` | `public function historialFicha(int $idFicha, int $limit = 15): array` | Declaración de método o función con su firma y parámetros: `public function historialFicha(int $idFicha, int $limit = 15): array`. |
| `203` | ``{`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `204` | `$stmt = $this->conn->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmt = $this->conn->prepare(`. |
| `205` | `"SELECT t.*,` | Instrucción de ejecución en el contexto del script: `"SELECT t.*,`. |
| `206` | `m.nombre AS nombre_modulo,` | Instrucción de ejecución en el contexto del script: `m.nombre AS nombre_modulo,`. |
| `207` | `g.nombre_grupo,` | Instrucción de ejecución en el contexto del script: `g.nombre_grupo,`. |
| `208` | `(SELECT COUNT(*) FROM evidencias e` | Instrucción de ejecución en el contexto del script: `(SELECT COUNT(*) FROM evidencias e`. |
| `209` | `WHERE e.id_turno = t.id_turno) AS tiene_evidencia` | Instrucción de ejecución en el contexto del script: `WHERE e.id_turno = t.id_turno) AS tiene_evidencia`. |
| `210` | `FROM turnos t` | Instrucción de ejecución en el contexto del script: `FROM turnos t`. |
| `211` | `JOIN asignaciones a ON a.id_asignacion = t.id_asignacion` | Instrucción de ejecución en el contexto del script: `JOIN asignaciones a ON a.id_asignacion = t.id_asignacion`. |
| `212` | `JOIN modulos      m ON m.id_modulo     = a.id_modulo` | Instrucción de ejecución en el contexto del script: `JOIN modulos      m ON m.id_modulo     = a.id_modulo`. |
| `213` | `LEFT JOIN grupos  g ON g.id_grupo      = t.id_grupo` | Instrucción de ejecución en el contexto del script: `LEFT JOIN grupos  g ON g.id_grupo      = t.id_grupo`. |
| `214` | `WHERE a.id_ficha = :ficha` | Instrucción de ejecución en el contexto del script: `WHERE a.id_ficha = :ficha`. |
| `215` | `ORDER BY t.fecha_turno DESC` | Instrucción de ejecución en el contexto del script: `ORDER BY t.fecha_turno DESC`. |
| `216` | `LIMIT :lim"` | Instrucción de ejecución en el contexto del script: `LIMIT :lim"`. |
| `217` | ``);`` | Cierre de estructura de arreglo o invocación de función. |
| `218` | `$stmt->bindValue(':ficha', $idFicha, PDO::PARAM_INT);` | Instrucción de ejecución en el contexto del script: `$stmt->bindValue(':ficha', $idFicha, PDO::PARAM_INT);`. |
| `219` | `$stmt->bindValue(':lim',   $limit,   PDO::PARAM_INT);` | Instrucción de ejecución en el contexto del script: `$stmt->bindValue(':lim',   $limit,   PDO::PARAM_INT);`. |
| `220` | `$stmt->execute();` | Ejecuta la sentencia SQL preparada vinculando los parámetros correspondientes: `$stmt->execute();`. |
| `221` | `return $stmt->fetchAll(PDO::FETCH_ASSOC);` | Obtiene todos los registros coincidentes de la consulta en un arreglo asociativo. |
| `222` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `223` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `224` | `/**` | Comentario multilínea de documentación o aclaración técnica. |
| `225` | `* Marca turnos pasados sin evidencia como Incumplido.` | Comentario multilínea de documentación o aclaración técnica. |
| `226` | `*/` | Comentario multilínea de documentación o aclaración técnica. |
| `227` | `public function cerrarTurnosVencidos(): void` | Declaración de método o función con su firma y parámetros: `public function cerrarTurnosVencidos(): void`. |
| `228` | ``{`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `229` | `$this->conn->exec(` | Instrucción de ejecución en el contexto del script: `$this->conn->exec(`. |
| `230` | `"UPDATE turnos t` | Instrucción de ejecución en el contexto del script: `"UPDATE turnos t`. |
| `231` | `SET t.estado = 'Incumplido'` | Instrucción de ejecución en el contexto del script: `SET t.estado = 'Incumplido'`. |
| `232` | `WHERE t.fecha_cierre < NOW()` | Instrucción de ejecución en el contexto del script: `WHERE t.fecha_cierre < NOW()`. |
| `233` | `AND t.estado IN ('Pendiente','Abierto')` | Instrucción de ejecución en el contexto del script: `AND t.estado IN ('Pendiente','Abierto')`. |
| `234` | `AND NOT EXISTS (` | Instrucción de ejecución en el contexto del script: `AND NOT EXISTS (`. |
| `235` | `SELECT 1 FROM evidencias e WHERE e.id_turno = t.id_turno` | Instrucción de ejecución en el contexto del script: `SELECT 1 FROM evidencias e WHERE e.id_turno = t.id_turno`. |
| `236` | `)"` | Instrucción de ejecución en el contexto del script: `)"`. |
| `237` | ``);`` | Cierre de estructura de arreglo o invocación de función. |
| `238` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `239` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `240` | `/**` | Comentario multilínea de documentación o aclaración técnica. |
| `241` | `* Abre los turnos de hoy (Pendiente → Abierto).` | Comentario multilínea de documentación o aclaración técnica. |
| `242` | `*/` | Comentario multilínea de documentación o aclaración técnica. |
| `243` | `public function abrirTurnosHoy(): void` | Declaración de método o función con su firma y parámetros: `public function abrirTurnosHoy(): void`. |
| `244` | ``{`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `245` | `$this->conn->exec(` | Instrucción de ejecución en el contexto del script: `$this->conn->exec(`. |
| `246` | `"UPDATE turnos SET estado = 'Abierto'` | Instrucción de ejecución en el contexto del script: `"UPDATE turnos SET estado = 'Abierto'`. |
| `247` | `WHERE fecha_turno = CURDATE() AND estado = 'Pendiente'"` | Instrucción de ejecución en el contexto del script: `WHERE fecha_turno = CURDATE() AND estado = 'Pendiente'"`. |
| `248` | ``);`` | Cierre de estructura de arreglo o invocación de función. |
| `249` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `250` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `251` | `/**` | Comentario multilínea de documentación o aclaración técnica. |
| `252` | `* Marca turno como Cumplido al registrar evidencia.` | Comentario multilínea de documentación o aclaración técnica. |
| `253` | `*/` | Comentario multilínea de documentación o aclaración técnica. |
| `254` | `public function marcarCumplido(int $idTurno): void` | Declaración de método o función con su firma y parámetros: `public function marcarCumplido(int $idTurno): void`. |
| `255` | ``{`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `256` | `$this->conn->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$this->conn->prepare(`. |
| `257` | `"UPDATE turnos SET estado = 'Cumplido' WHERE id_turno = :id"` | Instrucción de ejecución en el contexto del script: `"UPDATE turnos SET estado = 'Cumplido' WHERE id_turno = :id"`. |
| `258` | `)->execute([':id' => $idTurno]);` | Ejecuta la sentencia SQL preparada vinculando los parámetros correspondientes: `)->execute([':id' => $idTurno]);`. |
| `259` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `260` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `261` | `/**` | Comentario multilínea de documentación o aclaración técnica. |
| `262` | `* Después de que un grupo completa su turno, asignarle el siguiente turn...` | Comentario multilínea de documentación o aclaración técnica. |
| `263` | `* de la rotación (el más lejano entre todos los grupos activos), manteni...` | Comentario multilínea de documentación o aclaración técnica. |
| `264` | `* Devuelve la nueva fecha asignada o false si no hay turnos disponibles.` | Comentario multilínea de documentación o aclaración técnica. |
| `265` | `*/` | Comentario multilínea de documentación o aclaración técnica. |
| `266` | `public function avanzarTurnoGrupo(int $idTurno, int $idGrupo): string\|f...` | Declaración de método o función con su firma y parámetros: `public function avanzarTurnoGrupo(int $idTurno, int $idGrupo): string\|f...`. |
| `267` | ``{`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `268` | `// Obtener la asignación del turno completado` | Comentario explicativo en el código: `Obtener la asignación del turno completado`. |
| `269` | `$stmtA = $this->conn->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmtA = $this->conn->prepare(`. |
| `270` | `"SELECT id_asignacion FROM turnos WHERE id_turno = :id LIMIT 1"` | Instrucción de ejecución en el contexto del script: `"SELECT id_asignacion FROM turnos WHERE id_turno = :id LIMIT 1"`. |
| `271` | ``);`` | Cierre de estructura de arreglo o invocación de función. |
| `272` | `$stmtA->execute([':id' => $idTurno]);` | Ejecuta la sentencia SQL preparada vinculando los parámetros correspondientes: `$stmtA->execute([':id' => $idTurno]);`. |
| `273` | `$row = $stmtA->fetch(\PDO::FETCH_ASSOC);` | Recupera una única fila o registro resultante de la consulta. |
| `274` | `if (!$row) return false;` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (!$row) return false;`. |
| `275` | `$idAsignacion = (int)$row['id_asignacion'];` | Instrucción de ejecución en el contexto del script: `$idAsignacion = (int)$row['id_asignacion'];`. |
| `276` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `277` | `// Buscar el último turno ocupado (por cualquier grupo de esta asignación)` | Comentario explicativo en el código: `Buscar el último turno ocupado (por cualquier grupo de esta asignación)`. |
| `278` | `// para que el grupo recién completado quede al final de la cola` | Comentario explicativo en el código: `para que el grupo recién completado quede al final de la cola`. |
| `279` | `$stmtLast = $this->conn->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmtLast = $this->conn->prepare(`. |
| `280` | `"SELECT MAX(fecha_turno) FROM turnos` | Instrucción de ejecución en el contexto del script: `"SELECT MAX(fecha_turno) FROM turnos`. |
| `281` | `WHERE id_asignacion = :asig AND id_grupo IS NOT NULL"` | Instrucción de ejecución en el contexto del script: `WHERE id_asignacion = :asig AND id_grupo IS NOT NULL"`. |
| `282` | ``);`` | Cierre de estructura de arreglo o invocación de función. |
| `283` | `$stmtLast->execute([':asig' => $idAsignacion]);` | Ejecuta la sentencia SQL preparada vinculando los parámetros correspondientes: `$stmtLast->execute([':asig' => $idAsignacion]);`. |
| `284` | `$ultimaFecha = $stmtLast->fetchColumn();` | Recupera el valor escalar de la primera columna del resultado de la consulta. |
| `285` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `286` | `// Buscar el primer turno libre DESPUÉS de la última fecha ocupada` | Comentario explicativo en el código: `Buscar el primer turno libre DESPUÉS de la última fecha ocupada`. |
| `287` | `$stmtNext = $this->conn->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmtNext = $this->conn->prepare(`. |
| `288` | `"SELECT id_turno, fecha_turno FROM turnos` | Instrucción de ejecución en el contexto del script: `"SELECT id_turno, fecha_turno FROM turnos`. |
| `289` | `WHERE id_asignacion = :asig` | Instrucción de ejecución en el contexto del script: `WHERE id_asignacion = :asig`. |
| `290` | `AND id_grupo IS NULL` | Instrucción de ejecución en el contexto del script: `AND id_grupo IS NULL`. |
| `291` | `AND fecha_turno > :ultima` | Instrucción de ejecución en el contexto del script: `AND fecha_turno > :ultima`. |
| `292` | `ORDER BY fecha_turno ASC` | Instrucción de ejecución en el contexto del script: `ORDER BY fecha_turno ASC`. |
| `293` | `LIMIT 1"` | Instrucción de ejecución en el contexto del script: `LIMIT 1"`. |
| `294` | ``);`` | Cierre de estructura de arreglo o invocación de función. |
| `295` | `$stmtNext->execute([':asig' => $idAsignacion, ':ultima' => $ultimaFecha ...` | Ejecuta la sentencia SQL preparada vinculando los parámetros correspondientes: `$stmtNext->execute([':asig' => $idAsignacion, ':ultima' => $ultimaFecha ...`. |
| `296` | `$nextTurno = $stmtNext->fetch(\PDO::FETCH_ASSOC);` | Recupera una única fila o registro resultante de la consulta. |
| `297` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `298` | `if (!$nextTurno) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (!$nextTurno) {`. |
| `299` | `// Si no hay turno después del último, tomar el primer turno libre que haya` | Comentario explicativo en el código: `Si no hay turno después del último, tomar el primer turno libre que haya`. |
| `300` | `$stmtFallback = $this->conn->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmtFallback = $this->conn->prepare(`. |
| `301` | `"SELECT id_turno, fecha_turno FROM turnos` | Instrucción de ejecución en el contexto del script: `"SELECT id_turno, fecha_turno FROM turnos`. |
| `302` | `WHERE id_asignacion = :asig` | Instrucción de ejecución en el contexto del script: `WHERE id_asignacion = :asig`. |
| `303` | `AND id_grupo IS NULL` | Instrucción de ejecución en el contexto del script: `AND id_grupo IS NULL`. |
| `304` | `AND fecha_turno >= CURDATE()` | Instrucción de ejecución en el contexto del script: `AND fecha_turno >= CURDATE()`. |
| `305` | `ORDER BY fecha_turno ASC` | Instrucción de ejecución en el contexto del script: `ORDER BY fecha_turno ASC`. |
| `306` | `LIMIT 1"` | Instrucción de ejecución en el contexto del script: `LIMIT 1"`. |
| `307` | ``);`` | Cierre de estructura de arreglo o invocación de función. |
| `308` | `$stmtFallback->execute([':asig' => $idAsignacion]);` | Ejecuta la sentencia SQL preparada vinculando los parámetros correspondientes: `$stmtFallback->execute([':asig' => $idAsignacion]);`. |
| `309` | `$nextTurno = $stmtFallback->fetch(\PDO::FETCH_ASSOC);` | Recupera una única fila o registro resultante de la consulta. |
| `310` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `311` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `312` | `if (!$nextTurno) return false;` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (!$nextTurno) return false;`. |
| `313` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `314` | `// Asignar el grupo al nuevo turno` | Comentario explicativo en el código: `Asignar el grupo al nuevo turno`. |
| `315` | `$this->conn->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$this->conn->prepare(`. |
| `316` | `"UPDATE turnos SET id_grupo = :grupo WHERE id_turno = :turno"` | Instrucción de ejecución en el contexto del script: `"UPDATE turnos SET id_grupo = :grupo WHERE id_turno = :turno"`. |
| `317` | `)->execute([':grupo' => $idGrupo, ':turno' => $nextTurno['id_turno']]);` | Ejecuta la sentencia SQL preparada vinculando los parámetros correspondientes: `)->execute([':grupo' => $idGrupo, ':turno' => $nextTurno['id_turno']]);`. |
| `318` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `319` | `// Actualizar la fecha_limpieza del grupo` | Comentario explicativo en el código: `Actualizar la fecha_limpieza del grupo`. |
| `320` | `$this->conn->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$this->conn->prepare(`. |
| `321` | `"UPDATE grupos SET fecha_limpieza = :fecha, fecha_modificacion = NOW() W...` | Instrucción de ejecución en el contexto del script: `"UPDATE grupos SET fecha_limpieza = :fecha, fecha_modificacion = NOW() W...`. |
| `322` | `)->execute([':fecha' => $nextTurno['fecha_turno'], ':id' => $idGrupo]);` | Ejecuta la sentencia SQL preparada vinculando los parámetros correspondientes: `)->execute([':fecha' => $nextTurno['fecha_turno'], ':id' => $idGrupo]);`. |
| `323` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `324` | `return $nextTurno['fecha_turno'];` | Instrucción de retorno que finaliza la ejecución entregando el resultado: `return $nextTurno['fecha_turno'];`. |
| `325` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `326` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `327` | `/**` | Comentario multilínea de documentación o aclaración técnica. |
| `328` | `* Turnos próximos de la ficha (hoy en adelante).` | Comentario multilínea de documentación o aclaración técnica. |
| `329` | `*/` | Comentario multilínea de documentación o aclaración técnica. |
| `330` | `public function proximosFicha(int $idFicha, int $limit = 5): array` | Declaración de método o función con su firma y parámetros: `public function proximosFicha(int $idFicha, int $limit = 5): array`. |
| `331` | ``{`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `332` | `$stmt = $this->conn->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmt = $this->conn->prepare(`. |
| `333` | `"SELECT t.*, m.nombre AS nombre_modulo, g.nombre_grupo` | Instrucción de ejecución en el contexto del script: `"SELECT t.*, m.nombre AS nombre_modulo, g.nombre_grupo`. |
| `334` | `FROM turnos t` | Instrucción de ejecución en el contexto del script: `FROM turnos t`. |
| `335` | `JOIN asignaciones a ON a.id_asignacion = t.id_asignacion` | Instrucción de ejecución en el contexto del script: `JOIN asignaciones a ON a.id_asignacion = t.id_asignacion`. |
| `336` | `JOIN modulos      m ON m.id_modulo     = a.id_modulo` | Instrucción de ejecución en el contexto del script: `JOIN modulos      m ON m.id_modulo     = a.id_modulo`. |
| `337` | `LEFT JOIN grupos  g ON g.id_grupo      = t.id_grupo` | Instrucción de ejecución en el contexto del script: `LEFT JOIN grupos  g ON g.id_grupo      = t.id_grupo`. |
| `338` | `WHERE a.id_ficha   = :ficha` | Instrucción de ejecución en el contexto del script: `WHERE a.id_ficha   = :ficha`. |
| `339` | `AND t.fecha_turno >= CURDATE()` | Instrucción de ejecución en el contexto del script: `AND t.fecha_turno >= CURDATE()`. |
| `340` | `ORDER BY t.fecha_turno ASC` | Instrucción de ejecución en el contexto del script: `ORDER BY t.fecha_turno ASC`. |
| `341` | `LIMIT :lim"` | Instrucción de ejecución en el contexto del script: `LIMIT :lim"`. |
| `342` | ``);`` | Cierre de estructura de arreglo o invocación de función. |
| `343` | `$stmt->bindValue(':ficha', $idFicha, PDO::PARAM_INT);` | Instrucción de ejecución en el contexto del script: `$stmt->bindValue(':ficha', $idFicha, PDO::PARAM_INT);`. |
| `344` | `$stmt->bindValue(':lim',   $limit,   PDO::PARAM_INT);` | Instrucción de ejecución en el contexto del script: `$stmt->bindValue(':lim',   $limit,   PDO::PARAM_INT);`. |
| `345` | `$stmt->execute();` | Ejecuta la sentencia SQL preparada vinculando los parámetros correspondientes: `$stmt->execute();`. |
| `346` | `return $stmt->fetchAll(PDO::FETCH_ASSOC);` | Obtiene todos los registros coincidentes de la consulta en un arreglo asociativo. |
| `347` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `348` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `349` | ``?>`` | Cierre de la etiqueta PHP para alternar a salida HTML o fin del archivo. |

---

## 3. Resumen y Flujo de Interacción

El archivo `Turno.php` cumple un rol indispensable en `models/Turno.php`. 
Modelo de datos para la programación, cálculo de fechas y estado de turnos de limpieza asignados a los grupos de cada módulo. Garantiza la robustez, el orden y la estabilidad de la arquitectura del proyecto `systemLimpieza`.

---

Generado automáticamente para el repositorio [johanrepizo/LimpiezaDeModulos](https://github.com/johanrepizo/LimpiezaDeModulos).
