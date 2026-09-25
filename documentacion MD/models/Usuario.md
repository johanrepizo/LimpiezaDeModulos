# Documentación Línea por Línea: `models/Usuario.php`

## 1. Ficha Técnica del Archivo

- **Archivo:** `Usuario.php`
- **Ruta en el proyecto:** `models/Usuario.php`
- **Cantidad total de líneas:** `142`
- **Tipo de archivo:** `PHP`
- **Propósito general:** Modelo de datos para autenticación, gestión de usuarios, roles (Administrador/Vocero), bloqueo por intentos fallidos y contraseñas cifradas.

---

## 2. Explicación Detallada Línea por Línea

A continuación se presenta cada línea de código numerada de forma consecutiva, acompañada de su fragmento exacto y la explicación exhaustiva de su funcionamiento y responsabilidad en el sistema:

| Línea | Código Fuente | Explicación Detallada |
|---|---|---|
| `1` | ``<?php`` | Apertura obligatoria de la etiqueta PHP para ejecución del código del lado del servidor. |
| `2` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `3` | `class Usuario` | Declaración de la clase del componente: `class Usuario`. |
| `4` | ``{`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `5` | `private $conn;` | Definición de propiedad de clase para el estado interno del componente: `private $conn;`. |
| `6` | `private $tabla = "usuarios";` | Definición de propiedad de clase para el estado interno del componente: `private $tabla = "usuarios";`. |
| `7` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `8` | `public function __construct($db)` | Declaración de método o función con su firma y parámetros: `public function __construct($db)`. |
| `9` | ``{`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `10` | `$this->conn = $db;` | Instrucción de ejecución en el contexto del script: `$this->conn = $db;`. |
| `11` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `12` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `13` | `public function obtenerPorEmail(string $correo): array\|false` | Declaración de método o función con su firma y parámetros: `public function obtenerPorEmail(string $correo): array\|false`. |
| `14` | ``{`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `15` | `$stmt = $this->conn->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmt = $this->conn->prepare(`. |
| `16` | `"SELECT * FROM {$this->tabla} WHERE correo = :correo LIMIT 1"` | Instrucción de ejecución en el contexto del script: `"SELECT * FROM {$this->tabla} WHERE correo = :correo LIMIT 1"`. |
| `17` | ``);`` | Cierre de estructura de arreglo o invocación de función. |
| `18` | `$stmt->execute([':correo' => $correo]);` | Ejecuta la sentencia SQL preparada vinculando los parámetros correspondientes: `$stmt->execute([':correo' => $correo]);`. |
| `19` | `return $stmt->fetch(PDO::FETCH_ASSOC);` | Recupera una única fila o registro resultante de la consulta. |
| `20` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `21` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `22` | `public function obtenerPorId(int $id): array\|false` | Declaración de método o función con su firma y parámetros: `public function obtenerPorId(int $id): array\|false`. |
| `23` | ``{`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `24` | `$stmt = $this->conn->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmt = $this->conn->prepare(`. |
| `25` | `"SELECT * FROM {$this->tabla} WHERE id_usuario = :id LIMIT 1"` | Instrucción de ejecución en el contexto del script: `"SELECT * FROM {$this->tabla} WHERE id_usuario = :id LIMIT 1"`. |
| `26` | ``);`` | Cierre de estructura de arreglo o invocación de función. |
| `27` | `$stmt->execute([':id' => $id]);` | Ejecuta la sentencia SQL preparada vinculando los parámetros correspondientes: `$stmt->execute([':id' => $id]);`. |
| `28` | `return $stmt->fetch(PDO::FETCH_ASSOC);` | Recupera una única fila o registro resultante de la consulta. |
| `29` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `30` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `31` | `public function registrarIntentoFallido(int $id): void` | Declaración de método o función con su firma y parámetros: `public function registrarIntentoFallido(int $id): void`. |
| `32` | ``{`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `33` | `$stmt = $this->conn->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmt = $this->conn->prepare(`. |
| `34` | `"UPDATE {$this->tabla}` | Instrucción de ejecución en el contexto del script: `"UPDATE {$this->tabla}`. |
| `35` | `SET intentos_fallidos = IFNULL(intentos_fallidos, 0) + 1,` | Instrucción de ejecución en el contexto del script: `SET intentos_fallidos = IFNULL(intentos_fallidos, 0) + 1,`. |
| `36` | `bloqueado_hasta = IF(` | Instrucción de ejecución en el contexto del script: `bloqueado_hasta = IF(`. |
| `37` | `IFNULL(intentos_fallidos, 0) + 1 >= 3,` | Instrucción de ejecución en el contexto del script: `IFNULL(intentos_fallidos, 0) + 1 >= 3,`. |
| `38` | `DATE_ADD(NOW(), INTERVAL 15 MINUTE),` | Instrucción de ejecución en el contexto del script: `DATE_ADD(NOW(), INTERVAL 15 MINUTE),`. |
| `39` | `bloqueado_hasta` | Instrucción de ejecución en el contexto del script: `bloqueado_hasta`. |
| `40` | `)` | Instrucción de ejecución en el contexto del script: `)`. |
| `41` | `WHERE id_usuario = :id"` | Instrucción de ejecución en el contexto del script: `WHERE id_usuario = :id"`. |
| `42` | ``);`` | Cierre de estructura de arreglo o invocación de función. |
| `43` | `$stmt->execute([':id' => $id]);` | Ejecuta la sentencia SQL preparada vinculando los parámetros correspondientes: `$stmt->execute([':id' => $id]);`. |
| `44` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `45` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `46` | `public function resetearIntentos(int $id): void` | Declaración de método o función con su firma y parámetros: `public function resetearIntentos(int $id): void`. |
| `47` | ``{`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `48` | `$stmt = $this->conn->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmt = $this->conn->prepare(`. |
| `49` | `"UPDATE {$this->tabla}` | Instrucción de ejecución en el contexto del script: `"UPDATE {$this->tabla}`. |
| `50` | `SET intentos_fallidos = 0, bloqueado_hasta = NULL` | Instrucción de ejecución en el contexto del script: `SET intentos_fallidos = 0, bloqueado_hasta = NULL`. |
| `51` | `WHERE id_usuario = :id"` | Instrucción de ejecución en el contexto del script: `WHERE id_usuario = :id"`. |
| `52` | ``);`` | Cierre de estructura de arreglo o invocación de función. |
| `53` | `$stmt->execute([':id' => $id]);` | Ejecuta la sentencia SQL preparada vinculando los parámetros correspondientes: `$stmt->execute([':id' => $id]);`. |
| `54` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `55` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `56` | `public function marcarPrimerAccesoCompletado(int $id): bool` | Declaración de método o función con su firma y parámetros: `public function marcarPrimerAccesoCompletado(int $id): bool`. |
| `57` | ``{`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `58` | `$stmt = $this->conn->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmt = $this->conn->prepare(`. |
| `59` | `"UPDATE {$this->tabla} SET primer_acceso = 0 WHERE id_usuario = :id"` | Instrucción de ejecución en el contexto del script: `"UPDATE {$this->tabla} SET primer_acceso = 0 WHERE id_usuario = :id"`. |
| `60` | ``);`` | Cierre de estructura de arreglo o invocación de función. |
| `61` | `return $stmt->execute([':id' => $id]);` | Ejecuta la sentencia SQL preparada vinculando los parámetros correspondientes: `return $stmt->execute([':id' => $id]);`. |
| `62` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `63` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `64` | `public function actualizarPassword(int $id, string $hashPassword): bool` | Declaración de método o función con su firma y parámetros: `public function actualizarPassword(int $id, string $hashPassword): bool`. |
| `65` | ``{`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `66` | `$stmt = $this->conn->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmt = $this->conn->prepare(`. |
| `67` | `"UPDATE {$this->tabla}` | Instrucción de ejecución en el contexto del script: `"UPDATE {$this->tabla}`. |
| `68` | `SET password = :password, primer_acceso = 0,` | Instrucción de ejecución en el contexto del script: `SET password = :password, primer_acceso = 0,`. |
| `69` | `intentos_fallidos = 0, bloqueado_hasta = NULL` | Instrucción de ejecución en el contexto del script: `intentos_fallidos = 0, bloqueado_hasta = NULL`. |
| `70` | `WHERE id_usuario = :id"` | Instrucción de ejecución en el contexto del script: `WHERE id_usuario = :id"`. |
| `71` | ``);`` | Cierre de estructura de arreglo o invocación de función. |
| `72` | `return $stmt->execute([':password' => $hashPassword, ':id' => $id]);` | Ejecuta la sentencia SQL preparada vinculando los parámetros correspondientes: `return $stmt->execute([':password' => $hashPassword, ':id' => $id]);`. |
| `73` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `74` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `75` | `public function existeCorreo(string $correo): bool` | Declaración de método o función con su firma y parámetros: `public function existeCorreo(string $correo): bool`. |
| `76` | ``{`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `77` | `$stmt = $this->conn->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmt = $this->conn->prepare(`. |
| `78` | `"SELECT id_usuario FROM {$this->tabla} WHERE correo = :correo LIMIT 1"` | Instrucción de ejecución en el contexto del script: `"SELECT id_usuario FROM {$this->tabla} WHERE correo = :correo LIMIT 1"`. |
| `79` | ``);`` | Cierre de estructura de arreglo o invocación de función. |
| `80` | `$stmt->execute([':correo' => $correo]);` | Ejecuta la sentencia SQL preparada vinculando los parámetros correspondientes: `$stmt->execute([':correo' => $correo]);`. |
| `81` | `return $stmt->rowCount() > 0;` | Instrucción de retorno que finaliza la ejecución entregando el resultado: `return $stmt->rowCount() > 0;`. |
| `82` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `83` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `84` | `// Crea un token de recuperación y lo almacena (se guarda en sesión para...` | Comentario explicativo en el código: `Crea un token de recuperación y lo almacena (se guarda en sesión para fl...`. |
| `85` | `public function solicitarRestablecimiento(string $correo): string\|false` | Declaración de método o función con su firma y parámetros: `public function solicitarRestablecimiento(string $correo): string\|false`. |
| `86` | ``{`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `87` | `$stmt = $this->conn->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmt = $this->conn->prepare(`. |
| `88` | `"SELECT id_usuario FROM {$this->tabla} WHERE correo = :correo AND activo...` | Instrucción de ejecución en el contexto del script: `"SELECT id_usuario FROM {$this->tabla} WHERE correo = :correo AND activo...`. |
| `89` | ``);`` | Cierre de estructura de arreglo o invocación de función. |
| `90` | `$stmt->execute([':correo' => $correo]);` | Ejecuta la sentencia SQL preparada vinculando los parámetros correspondientes: `$stmt->execute([':correo' => $correo]);`. |
| `91` | `if ($stmt->rowCount() === 0) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if ($stmt->rowCount() === 0) {`. |
| `92` | `return false; // No confirmamos existencia por seguridad` | Instrucción de retorno que finaliza la ejecución entregando el resultado: `return false; // No confirmamos existencia por seguridad`. |
| `93` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `94` | `return true;` | Instrucción de retorno que finaliza la ejecución entregando el resultado: `return true;`. |
| `95` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `96` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `97` | `public function actualizarPasswordPorCorreo(string $correo, string $hash...` | Declaración de método o función con su firma y parámetros: `public function actualizarPasswordPorCorreo(string $correo, string $hash...`. |
| `98` | ``{`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `99` | `$stmt = $this->conn->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmt = $this->conn->prepare(`. |
| `100` | `"UPDATE {$this->tabla}` | Instrucción de ejecución en el contexto del script: `"UPDATE {$this->tabla}`. |
| `101` | `SET password = :password,` | Instrucción de ejecución en el contexto del script: `SET password = :password,`. |
| `102` | `intentos_fallidos = 0,` | Instrucción de ejecución en el contexto del script: `intentos_fallidos = 0,`. |
| `103` | `bloqueado_hasta = NULL` | Instrucción de ejecución en el contexto del script: `bloqueado_hasta = NULL`. |
| `104` | `WHERE correo = :correo"` | Instrucción de ejecución en el contexto del script: `WHERE correo = :correo"`. |
| `105` | ``);`` | Cierre de estructura de arreglo o invocación de función. |
| `106` | `return $stmt->execute([':password' => $hashPassword, ':correo' => $corre...` | Ejecuta la sentencia SQL preparada vinculando los parámetros correspondientes: `return $stmt->execute([':password' => $hashPassword, ':correo' => $corre...`. |
| `107` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `108` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `109` | `public function crearVocero(array $datos): int\|false` | Declaración de método o función con su firma y parámetros: `public function crearVocero(array $datos): int\|false`. |
| `110` | ``{`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `111` | `try {` | Instrucción de ejecución en el contexto del script: `try {`. |
| `112` | `$stmt = $this->conn->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmt = $this->conn->prepare(`. |
| `113` | `"INSERT INTO {$this->tabla}` | Instrucción de ejecución en el contexto del script: `"INSERT INTO {$this->tabla}`. |
| `114` | `(id_rol, nombres, apellidos, documento, celular, correo, password, prime...` | Instrucción de ejecución en el contexto del script: `(id_rol, nombres, apellidos, documento, celular, correo, password, prime...`. |
| `115` | `VALUES (2, :nombres, :apellidos, :documento, :celular, :correo, :passwor...` | Instrucción de ejecución en el contexto del script: `VALUES (2, :nombres, :apellidos, :documento, :celular, :correo, :passwor...`. |
| `116` | ``);`` | Cierre de estructura de arreglo o invocación de función. |
| `117` | `$stmt->execute([` | Ejecuta la sentencia SQL preparada vinculando los parámetros correspondientes: `$stmt->execute([`. |
| `118` | `':nombres'   => $datos['nombres'],` | Instrucción de ejecución en el contexto del script: `':nombres'   => $datos['nombres'],`. |
| `119` | `':apellidos' => $datos['apellidos'],` | Instrucción de ejecución en el contexto del script: `':apellidos' => $datos['apellidos'],`. |
| `120` | `':documento' => $datos['documento'] ?? null,` | Instrucción de ejecución en el contexto del script: `':documento' => $datos['documento'] ?? null,`. |
| `121` | `':celular'   => $datos['celular']   ?? null,` | Instrucción de ejecución en el contexto del script: `':celular'   => $datos['celular']   ?? null,`. |
| `122` | `':correo'    => $datos['correo'],` | Instrucción de ejecución en el contexto del script: `':correo'    => $datos['correo'],`. |
| `123` | `':password'  => $datos['password'],` | Instrucción de ejecución en el contexto del script: `':password'  => $datos['password'],`. |
| `124` | `]);` | Instrucción de ejecución en el contexto del script: `]);`. |
| `125` | `return (int) $this->conn->lastInsertId();` | Instrucción de retorno que finaliza la ejecución entregando el resultado: `return (int) $this->conn->lastInsertId();`. |
| `126` | `} catch (Exception $e) {` | Instrucción de ejecución en el contexto del script: `} catch (Exception $e) {`. |
| `127` | `return false;` | Instrucción de retorno que finaliza la ejecución entregando el resultado: `return false;`. |
| `128` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `129` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `130` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `131` | `public function obtenerTodos(): array` | Declaración de método o función con su firma y parámetros: `public function obtenerTodos(): array`. |
| `132` | ``{`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `133` | `$stmt = $this->conn->query(` | Instrucción de ejecución en el contexto del script: `$stmt = $this->conn->query(`. |
| `134` | `"SELECT u.*, r.nombre_rol` | Instrucción de ejecución en el contexto del script: `"SELECT u.*, r.nombre_rol`. |
| `135` | `FROM {$this->tabla} u` | Instrucción de ejecución en el contexto del script: `FROM {$this->tabla} u`. |
| `136` | `JOIN roles r ON u.id_rol = r.id_rol` | Instrucción de ejecución en el contexto del script: `JOIN roles r ON u.id_rol = r.id_rol`. |
| `137` | `ORDER BY u.nombres"` | Instrucción de ejecución en el contexto del script: `ORDER BY u.nombres"`. |
| `138` | ``);`` | Cierre de estructura de arreglo o invocación de función. |
| `139` | `return $stmt->fetchAll(PDO::FETCH_ASSOC);` | Obtiene todos los registros coincidentes de la consulta en un arreglo asociativo. |
| `140` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `141` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `142` | ``?>`` | Cierre de la etiqueta PHP para alternar a salida HTML o fin del archivo. |

---

## 3. Resumen y Flujo de Interacción

El archivo `Usuario.php` cumple un rol indispensable en `models/Usuario.php`. 
Modelo de datos para autenticación, gestión de usuarios, roles (Administrador/Vocero), bloqueo por intentos fallidos y contraseñas cifradas. Garantiza la robustez, el orden y la estabilidad de la arquitectura del proyecto `systemLimpieza`.

---

Generado automáticamente para el repositorio [johanrepizo/LimpiezaDeModulos](https://github.com/johanrepizo/LimpiezaDeModulos).
