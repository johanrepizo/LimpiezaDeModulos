# Documentación Línea por Línea: `models/Grupo.php`

## 1. Ficha Técnica del Archivo

- **Archivo:** `Grupo.php`
- **Ruta en el proyecto:** `models/Grupo.php`
- **Cantidad total de líneas:** `256`
- **Tipo de archivo:** `PHP`
- **Propósito general:** Modelo de datos para la administración de grupos de trabajo de limpieza conformados por aprendices de una ficha específica.

---

## 2. Explicación Detallada Línea por Línea

A continuación se presenta cada línea de código numerada de forma consecutiva, acompañada de su fragmento exacto y la explicación exhaustiva de su funcionamiento y responsabilidad en el sistema:

| Línea | Código Fuente | Explicación Detallada |
|---|---|---|
| `1` | ``<?php`` | Apertura obligatoria de la etiqueta PHP para ejecución del código del lado del servidor. |
| `2` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `3` | `class Grupo` | Declaración de la clase del componente: `class Grupo`. |
| `4` | ``{`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `5` | `private $conn;` | Definición de propiedad de clase para el estado interno del componente: `private $conn;`. |
| `6` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `7` | `public function __construct($db)` | Declaración de método o función con su firma y parámetros: `public function __construct($db)`. |
| `8` | ``{`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `9` | `$this->conn = $db;` | Instrucción de ejecución en el contexto del script: `$this->conn = $db;`. |
| `10` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `11` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `12` | `public function obtenerPorVocero(int $idVocero): array` | Declaración de método o función con su firma y parámetros: `public function obtenerPorVocero(int $idVocero): array`. |
| `13` | ``{`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `14` | `$stmt = $this->conn->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmt = $this->conn->prepare(`. |
| `15` | `"SELECT g.*,` | Instrucción de ejecución en el contexto del script: `"SELECT g.*,`. |
| `16` | `a.fecha_limite_evidencia, a.estado AS estado_asignacion,` | Instrucción de ejecución en el contexto del script: `a.fecha_limite_evidencia, a.estado AS estado_asignacion,`. |
| `17` | `m.nombre AS nombre_modulo,` | Instrucción de ejecución en el contexto del script: `m.nombre AS nombre_modulo,`. |
| `18` | `f.numero_ficha,` | Instrucción de ejecución en el contexto del script: `f.numero_ficha,`. |
| `19` | `(SELECT COUNT(*) FROM evidencias e WHERE e.id_grupo = g.id_grupo) AS tie...` | Instrucción de ejecución en el contexto del script: `(SELECT COUNT(*) FROM evidencias e WHERE e.id_grupo = g.id_grupo) AS tie...`. |
| `20` | `(SELECT COUNT(*) FROM grupo_integrantes gi WHERE gi.id_grupo = g.id_grup...` | Instrucción de ejecución en el contexto del script: `(SELECT COUNT(*) FROM grupo_integrantes gi WHERE gi.id_grupo = g.id_grup...`. |
| `21` | `FROM grupos g` | Instrucción de ejecución en el contexto del script: `FROM grupos g`. |
| `22` | `JOIN asignaciones a ON a.id_asignacion = g.id_asignacion` | Instrucción de ejecución en el contexto del script: `JOIN asignaciones a ON a.id_asignacion = g.id_asignacion`. |
| `23` | `JOIN modulos  m ON m.id_modulo  = a.id_modulo` | Instrucción de ejecución en el contexto del script: `JOIN modulos  m ON m.id_modulo  = a.id_modulo`. |
| `24` | `JOIN fichas   f ON f.id_ficha   = a.id_ficha` | Instrucción de ejecución en el contexto del script: `JOIN fichas   f ON f.id_ficha   = a.id_ficha`. |
| `25` | `WHERE g.id_vocero = :id` | Instrucción de ejecución en el contexto del script: `WHERE g.id_vocero = :id`. |
| `26` | `ORDER BY g.id_grupo ASC"` | Instrucción de ejecución en el contexto del script: `ORDER BY g.id_grupo ASC"`. |
| `27` | ``);`` | Cierre de estructura de arreglo o invocación de función. |
| `28` | `$stmt->execute([':id' => $idVocero]);` | Ejecuta la sentencia SQL preparada vinculando los parámetros correspondientes: `$stmt->execute([':id' => $idVocero]);`. |
| `29` | `return $stmt->fetchAll(PDO::FETCH_ASSOC);` | Obtiene todos los registros coincidentes de la consulta en un arreglo asociativo. |
| `30` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `31` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `32` | `public function obtenerPorId(int $id): array\|false` | Declaración de método o función con su firma y parámetros: `public function obtenerPorId(int $id): array\|false`. |
| `33` | ``{`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `34` | `$stmt = $this->conn->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmt = $this->conn->prepare(`. |
| `35` | `"SELECT g.*,` | Instrucción de ejecución en el contexto del script: `"SELECT g.*,`. |
| `36` | `a.fecha_limite_evidencia, a.id_ficha,` | Instrucción de ejecución en el contexto del script: `a.fecha_limite_evidencia, a.id_ficha,`. |
| `37` | `m.nombre AS nombre_modulo,` | Instrucción de ejecución en el contexto del script: `m.nombre AS nombre_modulo,`. |
| `38` | `f.numero_ficha` | Instrucción de ejecución en el contexto del script: `f.numero_ficha`. |
| `39` | `FROM grupos g` | Instrucción de ejecución en el contexto del script: `FROM grupos g`. |
| `40` | `JOIN asignaciones a ON a.id_asignacion = g.id_asignacion` | Instrucción de ejecución en el contexto del script: `JOIN asignaciones a ON a.id_asignacion = g.id_asignacion`. |
| `41` | `JOIN modulos  m ON m.id_modulo  = a.id_modulo` | Instrucción de ejecución en el contexto del script: `JOIN modulos  m ON m.id_modulo  = a.id_modulo`. |
| `42` | `JOIN fichas   f ON f.id_ficha   = a.id_ficha` | Instrucción de ejecución en el contexto del script: `JOIN fichas   f ON f.id_ficha   = a.id_ficha`. |
| `43` | `WHERE g.id_grupo = :id LIMIT 1"` | Instrucción de ejecución en el contexto del script: `WHERE g.id_grupo = :id LIMIT 1"`. |
| `44` | ``);`` | Cierre de estructura de arreglo o invocación de función. |
| `45` | `$stmt->execute([':id' => $id]);` | Ejecuta la sentencia SQL preparada vinculando los parámetros correspondientes: `$stmt->execute([':id' => $id]);`. |
| `46` | `return $stmt->fetch(PDO::FETCH_ASSOC);` | Recupera una única fila o registro resultante de la consulta. |
| `47` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `48` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `49` | `public function obtenerIntegrantes(int $idGrupo): array` | Declaración de método o función con su firma y parámetros: `public function obtenerIntegrantes(int $idGrupo): array`. |
| `50` | ``{`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `51` | `$stmt = $this->conn->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmt = $this->conn->prepare(`. |
| `52` | `"SELECT ap.id_aprendiz, ap.nombres, ap.apellidos, ap.documento,` | Instrucción de ejecución en el contexto del script: `"SELECT ap.id_aprendiz, ap.nombres, ap.apellidos, ap.documento,`. |
| `53` | `ap.celular, ap.correo` | Instrucción de ejecución en el contexto del script: `ap.celular, ap.correo`. |
| `54` | `FROM grupo_integrantes gi` | Instrucción de ejecución en el contexto del script: `FROM grupo_integrantes gi`. |
| `55` | `JOIN aprendices ap ON ap.id_aprendiz = gi.id_aprendiz` | Instrucción de ejecución en el contexto del script: `JOIN aprendices ap ON ap.id_aprendiz = gi.id_aprendiz`. |
| `56` | `WHERE gi.id_grupo = :id` | Instrucción de ejecución en el contexto del script: `WHERE gi.id_grupo = :id`. |
| `57` | `ORDER BY ap.apellidos, ap.nombres"` | Instrucción de ejecución en el contexto del script: `ORDER BY ap.apellidos, ap.nombres"`. |
| `58` | ``);`` | Cierre de estructura de arreglo o invocación de función. |
| `59` | `$stmt->execute([':id' => $idGrupo]);` | Ejecuta la sentencia SQL preparada vinculando los parámetros correspondientes: `$stmt->execute([':id' => $idGrupo]);`. |
| `60` | `return $stmt->fetchAll(PDO::FETCH_ASSOC);` | Obtiene todos los registros coincidentes de la consulta en un arreglo asociativo. |
| `61` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `62` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `63` | `public function existeDuplicadoModuloFecha(int $idAsignacion, string $fe...` | Declaración de método o función con su firma y parámetros: `public function existeDuplicadoModuloFecha(int $idAsignacion, string $fe...`. |
| `64` | ``{`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `65` | `$sql = "SELECT id_grupo FROM grupos` | Instrucción de ejecución en el contexto del script: `$sql = "SELECT id_grupo FROM grupos`. |
| `66` | `WHERE id_asignacion = :asig AND fecha_limpieza = :fecha";` | Instrucción de ejecución en el contexto del script: `WHERE id_asignacion = :asig AND fecha_limpieza = :fecha";`. |
| `67` | `if ($excluirId) $sql .= " AND id_grupo != :excluir";` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if ($excluirId) $sql .= " AND id_grupo != :excluir";`. |
| `68` | `$stmt = $this->conn->prepare($sql);` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmt = $this->conn->prepare($sql);`. |
| `69` | `$params = [':asig' => $idAsignacion, ':fecha' => $fecha];` | Instrucción de ejecución en el contexto del script: `$params = [':asig' => $idAsignacion, ':fecha' => $fecha];`. |
| `70` | `if ($excluirId) $params[':excluir'] = $excluirId;` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if ($excluirId) $params[':excluir'] = $excluirId;`. |
| `71` | `$stmt->execute($params);` | Ejecuta la sentencia SQL preparada vinculando los parámetros correspondientes: `$stmt->execute($params);`. |
| `72` | `return $stmt->rowCount() > 0;` | Instrucción de retorno que finaliza la ejecución entregando el resultado: `return $stmt->rowCount() > 0;`. |
| `73` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `74` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `75` | `public function crear(array $datos, array $idAprendices): int\|false` | Declaración de método o función con su firma y parámetros: `public function crear(array $datos, array $idAprendices): int\|false`. |
| `76` | ``{`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `77` | `try {` | Instrucción de ejecución en el contexto del script: `try {`. |
| `78` | `$this->conn->beginTransaction();` | Instrucción de ejecución en el contexto del script: `$this->conn->beginTransaction();`. |
| `79` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `80` | `$stmt = $this->conn->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmt = $this->conn->prepare(`. |
| `81` | `"INSERT INTO grupos (id_asignacion, id_vocero, nombre_grupo, fecha_limpi...` | Instrucción de ejecución en el contexto del script: `"INSERT INTO grupos (id_asignacion, id_vocero, nombre_grupo, fecha_limpi...`. |
| `82` | `VALUES (:id_asignacion, :id_vocero, :nombre_grupo, :fecha_limpieza)"` | Instrucción de ejecución en el contexto del script: `VALUES (:id_asignacion, :id_vocero, :nombre_grupo, :fecha_limpieza)"`. |
| `83` | ``);`` | Cierre de estructura de arreglo o invocación de función. |
| `84` | `$stmt->execute([` | Ejecuta la sentencia SQL preparada vinculando los parámetros correspondientes: `$stmt->execute([`. |
| `85` | `':id_asignacion' => $datos['id_asignacion'],` | Instrucción de ejecución en el contexto del script: `':id_asignacion' => $datos['id_asignacion'],`. |
| `86` | `':id_vocero'     => $datos['id_vocero'],` | Instrucción de ejecución en el contexto del script: `':id_vocero'     => $datos['id_vocero'],`. |
| `87` | `':nombre_grupo'  => $datos['nombre_grupo'],` | Instrucción de ejecución en el contexto del script: `':nombre_grupo'  => $datos['nombre_grupo'],`. |
| `88` | `':fecha_limpieza'=> $datos['fecha_limpieza'],` | Instrucción de ejecución en el contexto del script: `':fecha_limpieza'=> $datos['fecha_limpieza'],`. |
| `89` | `]);` | Instrucción de ejecución en el contexto del script: `]);`. |
| `90` | `$idGrupo = (int) $this->conn->lastInsertId();` | Instrucción de ejecución en el contexto del script: `$idGrupo = (int) $this->conn->lastInsertId();`. |
| `91` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `92` | `$stmtInt = $this->conn->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmtInt = $this->conn->prepare(`. |
| `93` | `"INSERT INTO grupo_integrantes (id_grupo, id_aprendiz) VALUES (:g, :a)"` | Instrucción de ejecución en el contexto del script: `"INSERT INTO grupo_integrantes (id_grupo, id_aprendiz) VALUES (:g, :a)"`. |
| `94` | ``);`` | Cierre de estructura de arreglo o invocación de función. |
| `95` | `foreach ($idAprendices as $idAp) {` | Estructura de control iterativa para recorrer colecciones o arreglos: `foreach ($idAprendices as $idAp) {`. |
| `96` | `$stmtInt->execute([':g' => $idGrupo, ':a' => (int)$idAp]);` | Ejecuta la sentencia SQL preparada vinculando los parámetros correspondientes: `$stmtInt->execute([':g' => $idGrupo, ':a' => (int)$idAp]);`. |
| `97` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `98` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `99` | `$this->conn->commit();` | Instrucción de ejecución en el contexto del script: `$this->conn->commit();`. |
| `100` | `return $idGrupo;` | Instrucción de retorno que finaliza la ejecución entregando el resultado: `return $idGrupo;`. |
| `101` | `} catch (Exception $e) {` | Instrucción de ejecución en el contexto del script: `} catch (Exception $e) {`. |
| `102` | `$this->conn->rollBack();` | Instrucción de ejecución en el contexto del script: `$this->conn->rollBack();`. |
| `103` | `return false;` | Instrucción de retorno que finaliza la ejecución entregando el resultado: `return false;`. |
| `104` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `105` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `106` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `107` | `public function actualizar(int $id, array $datos, array $idAprendices): ...` | Declaración de método o función con su firma y parámetros: `public function actualizar(int $id, array $datos, array $idAprendices): ...`. |
| `108` | ``{`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `109` | `try {` | Instrucción de ejecución en el contexto del script: `try {`. |
| `110` | `$this->conn->beginTransaction();` | Instrucción de ejecución en el contexto del script: `$this->conn->beginTransaction();`. |
| `111` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `112` | `$stmt = $this->conn->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmt = $this->conn->prepare(`. |
| `113` | `"UPDATE grupos` | Instrucción de ejecución en el contexto del script: `"UPDATE grupos`. |
| `114` | `SET nombre_grupo = :nombre_grupo, fecha_limpieza = :fecha_limpieza,` | Instrucción de ejecución en el contexto del script: `SET nombre_grupo = :nombre_grupo, fecha_limpieza = :fecha_limpieza,`. |
| `115` | `fecha_modificacion = NOW()` | Instrucción de ejecución en el contexto del script: `fecha_modificacion = NOW()`. |
| `116` | `WHERE id_grupo = :id"` | Instrucción de ejecución en el contexto del script: `WHERE id_grupo = :id"`. |
| `117` | ``);`` | Cierre de estructura de arreglo o invocación de función. |
| `118` | `$stmt->execute([` | Ejecuta la sentencia SQL preparada vinculando los parámetros correspondientes: `$stmt->execute([`. |
| `119` | `':nombre_grupo'  => $datos['nombre_grupo'],` | Instrucción de ejecución en el contexto del script: `':nombre_grupo'  => $datos['nombre_grupo'],`. |
| `120` | `':fecha_limpieza'=> $datos['fecha_limpieza'],` | Instrucción de ejecución en el contexto del script: `':fecha_limpieza'=> $datos['fecha_limpieza'],`. |
| `121` | `':id'            => $id,` | Instrucción de ejecución en el contexto del script: `':id'            => $id,`. |
| `122` | `]);` | Instrucción de ejecución en el contexto del script: `]);`. |
| `123` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `124` | `// Reemplazar integrantes` | Comentario explicativo en el código: `Reemplazar integrantes`. |
| `125` | `$this->conn->prepare("DELETE FROM grupo_integrantes WHERE id_grupo = :id")` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$this->conn->prepare("DELETE FROM grupo_integrantes WHERE id_grupo = :id")`. |
| `126` | `->execute([':id' => $id]);` | Ejecuta la sentencia SQL preparada vinculando los parámetros correspondientes: `->execute([':id' => $id]);`. |
| `127` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `128` | `$stmtInt = $this->conn->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmtInt = $this->conn->prepare(`. |
| `129` | `"INSERT INTO grupo_integrantes (id_grupo, id_aprendiz) VALUES (:g, :a)"` | Instrucción de ejecución en el contexto del script: `"INSERT INTO grupo_integrantes (id_grupo, id_aprendiz) VALUES (:g, :a)"`. |
| `130` | ``);`` | Cierre de estructura de arreglo o invocación de función. |
| `131` | `foreach ($idAprendices as $idAp) {` | Estructura de control iterativa para recorrer colecciones o arreglos: `foreach ($idAprendices as $idAp) {`. |
| `132` | `$stmtInt->execute([':g' => $id, ':a' => (int)$idAp]);` | Ejecuta la sentencia SQL preparada vinculando los parámetros correspondientes: `$stmtInt->execute([':g' => $id, ':a' => (int)$idAp]);`. |
| `133` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `134` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `135` | `$this->conn->commit();` | Instrucción de ejecución en el contexto del script: `$this->conn->commit();`. |
| `136` | `return true;` | Instrucción de retorno que finaliza la ejecución entregando el resultado: `return true;`. |
| `137` | `} catch (Exception $e) {` | Instrucción de ejecución en el contexto del script: `} catch (Exception $e) {`. |
| `138` | `$this->conn->rollBack();` | Instrucción de ejecución en el contexto del script: `$this->conn->rollBack();`. |
| `139` | `return false;` | Instrucción de retorno que finaliza la ejecución entregando el resultado: `return false;`. |
| `140` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `141` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `142` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `143` | `public function eliminar(int $id): bool` | Declaración de método o función con su firma y parámetros: `public function eliminar(int $id): bool`. |
| `144` | ``{`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `145` | `// Elimina el grupo siempre. Las evidencias históricas quedan intactas` | Comentario explicativo en el código: `Elimina el grupo siempre. Las evidencias históricas quedan intactas`. |
| `146` | `// porque tienen su propio snapshot en evidencia_integrantes.` | Comentario explicativo en el código: `porque tienen su propio snapshot en evidencia_integrantes.`. |
| `147` | `// grupo_integrantes se elimina por CASCADE al borrar el grupo.` | Comentario explicativo en el código: `grupo_integrantes se elimina por CASCADE al borrar el grupo.`. |
| `148` | `$stmt = $this->conn->prepare("DELETE FROM grupos WHERE id_grupo = :id");` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmt = $this->conn->prepare("DELETE FROM grupos WHERE id_grupo = :id");`. |
| `149` | `return $stmt->execute([':id' => $id]);` | Ejecuta la sentencia SQL preparada vinculando los parámetros correspondientes: `return $stmt->execute([':id' => $id]);`. |
| `150` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `151` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `152` | `// Devuelve los id_aprendiz que ya están en algún grupo de la ficha (exc...` | Comentario explicativo en el código: `Devuelve los id_aprendiz que ya están en algún grupo de la ficha (excluy...`. |
| `153` | `public function aprendicesOcupadosEnFicha(int $idFicha, int $excluirGrup...` | Declaración de método o función con su firma y parámetros: `public function aprendicesOcupadosEnFicha(int $idFicha, int $excluirGrup...`. |
| `154` | ``{`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `155` | `$sql = "SELECT DISTINCT gi.id_aprendiz` | Instrucción de ejecución en el contexto del script: `$sql = "SELECT DISTINCT gi.id_aprendiz`. |
| `156` | `FROM grupo_integrantes gi` | Instrucción de ejecución en el contexto del script: `FROM grupo_integrantes gi`. |
| `157` | `JOIN grupos g ON g.id_grupo = gi.id_grupo` | Instrucción de ejecución en el contexto del script: `JOIN grupos g ON g.id_grupo = gi.id_grupo`. |
| `158` | `JOIN asignaciones a ON a.id_asignacion = g.id_asignacion` | Instrucción de ejecución en el contexto del script: `JOIN asignaciones a ON a.id_asignacion = g.id_asignacion`. |
| `159` | `WHERE a.id_ficha = :fic";` | Instrucción de ejecución en el contexto del script: `WHERE a.id_ficha = :fic";`. |
| `160` | `if ($excluirGrupo) $sql .= " AND g.id_grupo != :excluir";` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if ($excluirGrupo) $sql .= " AND g.id_grupo != :excluir";`. |
| `161` | `$stmt = $this->conn->prepare($sql);` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmt = $this->conn->prepare($sql);`. |
| `162` | `$params = [':fic' => $idFicha];` | Instrucción de ejecución en el contexto del script: `$params = [':fic' => $idFicha];`. |
| `163` | `if ($excluirGrupo) $params[':excluir'] = $excluirGrupo;` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if ($excluirGrupo) $params[':excluir'] = $excluirGrupo;`. |
| `164` | `$stmt->execute($params);` | Ejecuta la sentencia SQL preparada vinculando los parámetros correspondientes: `$stmt->execute($params);`. |
| `165` | `return array_column($stmt->fetchAll(PDO::FETCH_ASSOC), 'id_aprendiz');` | Obtiene todos los registros coincidentes de la consulta en un arreglo asociativo. |
| `166` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `167` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `168` | `// Genera el nombre automático del próximo grupo (Grupo 1, Grupo 2…)` | Comentario explicativo en el código: `Genera el nombre automático del próximo grupo (Grupo 1, Grupo 2…)`. |
| `169` | `// Usa el máximo número existente + 1 para evitar duplicados tras eliminar` | Comentario explicativo en el código: `Usa el máximo número existente + 1 para evitar duplicados tras eliminar`. |
| `170` | `public function proximoNombreGrupo(int $idVocero): string` | Declaración de método o función con su firma y parámetros: `public function proximoNombreGrupo(int $idVocero): string`. |
| `171` | ``{`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `172` | `$stmt = $this->conn->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmt = $this->conn->prepare(`. |
| `173` | `"SELECT COALESCE(MAX(` | Instrucción de ejecución en el contexto del script: `"SELECT COALESCE(MAX(`. |
| `174` | `CAST(REGEXP_REPLACE(nombre_grupo, '[^0-9]', '') AS UNSIGNED)` | Instrucción de ejecución en el contexto del script: `CAST(REGEXP_REPLACE(nombre_grupo, '[^0-9]', '') AS UNSIGNED)`. |
| `175` | `), 0)` | Instrucción de ejecución en el contexto del script: `), 0)`. |
| `176` | `FROM grupos WHERE id_vocero = :id"` | Instrucción de ejecución en el contexto del script: `FROM grupos WHERE id_vocero = :id"`. |
| `177` | ``);`` | Cierre de estructura de arreglo o invocación de función. |
| `178` | `$stmt->execute([':id' => $idVocero]);` | Ejecuta la sentencia SQL preparada vinculando los parámetros correspondientes: `$stmt->execute([':id' => $idVocero]);`. |
| `179` | `$max = (int)$stmt->fetchColumn();` | Recupera el valor escalar de la primera columna del resultado de la consulta. |
| `180` | `return "Grupo " . ($max + 1);` | Instrucción de retorno que finaliza la ejecución entregando el resultado: `return "Grupo " . ($max + 1);`. |
| `181` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `182` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `183` | `// Renumera todos los grupos del vocero en orden de id_grupo ASC` | Comentario explicativo en el código: `Renumera todos los grupos del vocero en orden de id_grupo ASC`. |
| `184` | `// para que siempre queden Grupo 1, Grupo 2, Grupo 3…` | Comentario explicativo en el código: `para que siempre queden Grupo 1, Grupo 2, Grupo 3…`. |
| `185` | `public function renumerarGrupos(int $idVocero): void` | Declaración de método o función con su firma y parámetros: `public function renumerarGrupos(int $idVocero): void`. |
| `186` | ``{`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `187` | `$stmt = $this->conn->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmt = $this->conn->prepare(`. |
| `188` | `"SELECT id_grupo FROM grupos WHERE id_vocero = :id ORDER BY id_grupo ASC"` | Instrucción de ejecución en el contexto del script: `"SELECT id_grupo FROM grupos WHERE id_vocero = :id ORDER BY id_grupo ASC"`. |
| `189` | ``);`` | Cierre de estructura de arreglo o invocación de función. |
| `190` | `$stmt->execute([':id' => $idVocero]);` | Ejecuta la sentencia SQL preparada vinculando los parámetros correspondientes: `$stmt->execute([':id' => $idVocero]);`. |
| `191` | `$ids = array_column($stmt->fetchAll(PDO::FETCH_ASSOC), 'id_grupo');` | Obtiene todos los registros coincidentes de la consulta en un arreglo asociativo. |
| `192` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `193` | `$upd = $this->conn->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$upd = $this->conn->prepare(`. |
| `194` | `"UPDATE grupos SET nombre_grupo = :n WHERE id_grupo = :id"` | Instrucción de ejecución en el contexto del script: `"UPDATE grupos SET nombre_grupo = :n WHERE id_grupo = :id"`. |
| `195` | ``);`` | Cierre de estructura de arreglo o invocación de función. |
| `196` | `foreach ($ids as $i => $idGrupo) {` | Estructura de control iterativa para recorrer colecciones o arreglos: `foreach ($ids as $i => $idGrupo) {`. |
| `197` | `$upd->execute([':n' => 'Grupo ' . ($i + 1), ':id' => $idGrupo]);` | Ejecuta la sentencia SQL preparada vinculando los parámetros correspondientes: `$upd->execute([':n' => 'Grupo ' . ($i + 1), ':id' => $idGrupo]);`. |
| `198` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `199` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `200` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `201` | `public function registrarHistorial(int $idGrupo, string $descripcion, in...` | Declaración de método o función con su firma y parámetros: `public function registrarHistorial(int $idGrupo, string $descripcion, in...`. |
| `202` | ``{`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `203` | `$stmt = $this->conn->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmt = $this->conn->prepare(`. |
| `204` | `"INSERT INTO historial_grupos (id_grupo, descripcion, id_usuario)` | Instrucción de ejecución en el contexto del script: `"INSERT INTO historial_grupos (id_grupo, descripcion, id_usuario)`. |
| `205` | `VALUES (:g, :d, :u)"` | Instrucción de ejecución en el contexto del script: `VALUES (:g, :d, :u)"`. |
| `206` | ``);`` | Cierre de estructura de arreglo o invocación de función. |
| `207` | `$stmt->execute([':g' => $idGrupo, ':d' => $descripcion, ':u' => $idUsuar...` | Ejecuta la sentencia SQL preparada vinculando los parámetros correspondientes: `$stmt->execute([':g' => $idGrupo, ':d' => $descripcion, ':u' => $idUsuar...`. |
| `208` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `209` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `210` | `public function obtenerHistorial(int $idGrupo): array` | Declaración de método o función con su firma y parámetros: `public function obtenerHistorial(int $idGrupo): array`. |
| `211` | ``{`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `212` | `$stmt = $this->conn->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmt = $this->conn->prepare(`. |
| `213` | `"SELECT hg.*, u.nombres AS usuario_nombre, u.apellidos AS usuario_apellido` | Instrucción de ejecución en el contexto del script: `"SELECT hg.*, u.nombres AS usuario_nombre, u.apellidos AS usuario_apellido`. |
| `214` | `FROM historial_grupos hg` | Instrucción de ejecución en el contexto del script: `FROM historial_grupos hg`. |
| `215` | `LEFT JOIN usuarios u ON u.id_usuario = hg.id_usuario` | Instrucción de ejecución en el contexto del script: `LEFT JOIN usuarios u ON u.id_usuario = hg.id_usuario`. |
| `216` | `WHERE hg.id_grupo = :id` | Instrucción de ejecución en el contexto del script: `WHERE hg.id_grupo = :id`. |
| `217` | `ORDER BY hg.fecha DESC"` | Instrucción de ejecución en el contexto del script: `ORDER BY hg.fecha DESC"`. |
| `218` | ``);`` | Cierre de estructura de arreglo o invocación de función. |
| `219` | `$stmt->execute([':id' => $idGrupo]);` | Ejecuta la sentencia SQL preparada vinculando los parámetros correspondientes: `$stmt->execute([':id' => $idGrupo]);`. |
| `220` | `return $stmt->fetchAll(PDO::FETCH_ASSOC);` | Obtiene todos los registros coincidentes de la consulta en un arreglo asociativo. |
| `221` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `222` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `223` | `public function obtenerTodos(array $filtros = []): array` | Declaración de método o función con su firma y parámetros: `public function obtenerTodos(array $filtros = []): array`. |
| `224` | ``{`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `225` | `$where  = ['1=1'];` | Instrucción de ejecución en el contexto del script: `$where  = ['1=1'];`. |
| `226` | `$params = [];` | Instrucción de ejecución en el contexto del script: `$params = [];`. |
| `227` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `228` | `if (!empty($filtros['id_ficha'])) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (!empty($filtros['id_ficha'])) {`. |
| `229` | `$where[] = 'a.id_ficha = :id_ficha';` | Instrucción de ejecución en el contexto del script: `$where[] = 'a.id_ficha = :id_ficha';`. |
| `230` | `$params[':id_ficha'] = $filtros['id_ficha'];` | Instrucción de ejecución en el contexto del script: `$params[':id_ficha'] = $filtros['id_ficha'];`. |
| `231` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `232` | `if (!empty($filtros['estado'])) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (!empty($filtros['estado'])) {`. |
| `233` | `$where[] = 'g.estado = :estado';` | Instrucción de ejecución en el contexto del script: `$where[] = 'g.estado = :estado';`. |
| `234` | `$params[':estado'] = $filtros['estado'];` | Instrucción de ejecución en el contexto del script: `$params[':estado'] = $filtros['estado'];`. |
| `235` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `236` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `237` | `$whereStr = implode(' AND ', $where);` | Instrucción de ejecución en el contexto del script: `$whereStr = implode(' AND ', $where);`. |
| `238` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `239` | `$stmt = $this->conn->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmt = $this->conn->prepare(`. |
| `240` | `"SELECT g.*,` | Instrucción de ejecución en el contexto del script: `"SELECT g.*,`. |
| `241` | `m.nombre AS nombre_modulo, f.numero_ficha,` | Instrucción de ejecución en el contexto del script: `m.nombre AS nombre_modulo, f.numero_ficha,`. |
| `242` | `v.nombres AS vocero_nombres, v.apellidos AS vocero_apellidos,` | Instrucción de ejecución en el contexto del script: `v.nombres AS vocero_nombres, v.apellidos AS vocero_apellidos,`. |
| `243` | `(SELECT COUNT(*) FROM evidencias e WHERE e.id_grupo = g.id_grupo) AS tie...` | Instrucción de ejecución en el contexto del script: `(SELECT COUNT(*) FROM evidencias e WHERE e.id_grupo = g.id_grupo) AS tie...`. |
| `244` | `FROM grupos g` | Instrucción de ejecución en el contexto del script: `FROM grupos g`. |
| `245` | `JOIN asignaciones a ON a.id_asignacion = g.id_asignacion` | Instrucción de ejecución en el contexto del script: `JOIN asignaciones a ON a.id_asignacion = g.id_asignacion`. |
| `246` | `JOIN modulos  m ON m.id_modulo  = a.id_modulo` | Instrucción de ejecución en el contexto del script: `JOIN modulos  m ON m.id_modulo  = a.id_modulo`. |
| `247` | `JOIN fichas   f ON f.id_ficha   = a.id_ficha` | Instrucción de ejecución en el contexto del script: `JOIN fichas   f ON f.id_ficha   = a.id_ficha`. |
| `248` | `JOIN voceros  v ON v.id_vocero  = g.id_vocero` | Instrucción de ejecución en el contexto del script: `JOIN voceros  v ON v.id_vocero  = g.id_vocero`. |
| `249` | `WHERE {$whereStr}` | Instrucción de ejecución en el contexto del script: `WHERE {$whereStr}`. |
| `250` | `ORDER BY g.fecha_limpieza DESC"` | Instrucción de ejecución en el contexto del script: `ORDER BY g.fecha_limpieza DESC"`. |
| `251` | ``);`` | Cierre de estructura de arreglo o invocación de función. |
| `252` | `$stmt->execute($params);` | Ejecuta la sentencia SQL preparada vinculando los parámetros correspondientes: `$stmt->execute($params);`. |
| `253` | `return $stmt->fetchAll(PDO::FETCH_ASSOC);` | Obtiene todos los registros coincidentes de la consulta en un arreglo asociativo. |
| `254` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `255` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `256` | ``?>`` | Cierre de la etiqueta PHP para alternar a salida HTML o fin del archivo. |

---

## 3. Resumen y Flujo de Interacción

El archivo `Grupo.php` cumple un rol indispensable en `models/Grupo.php`. 
Modelo de datos para la administración de grupos de trabajo de limpieza conformados por aprendices de una ficha específica. Garantiza la robustez, el orden y la estabilidad de la arquitectura del proyecto `systemLimpieza`.

---

Generado automáticamente para el repositorio [johanrepizo/LimpiezaDeModulos](https://github.com/johanrepizo/LimpiezaDeModulos).
