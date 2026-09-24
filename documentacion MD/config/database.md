# Documentación Línea por Línea: `config/database.php`

## 1. Ficha Técnica del Archivo

- **Archivo:** `database.php`
- **Ruta en el proyecto:** `config/database.php`
- **Cantidad total de líneas:** `25`
- **Tipo de archivo:** `PHP`
- **Propósito general:** Configura y provee la conexión centralizada a la base de datos MySQL mediante PDO con manejo de excepciones y UTF-8 mb4.

---

## 2. Explicación Detallada Línea por Línea

A continuación se presenta cada línea de código numerada de forma consecutiva, acompañada de su fragmento exacto y la explicación exhaustiva de su funcionamiento y responsabilidad en el sistema:

| Línea | Código Fuente | Explicación Detallada |
|---|---|---|
| `1` | `<?php` | Apertura obligatoria de la etiqueta PHP para ejecución del código del lado del servidor. |
| `2` | `class Database` | Declaración de la clase del componente: `class Database`. |
| `3` | `{` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `4` | `    private $host     = "127.0.0.1";` | Propiedad `private` `$host` inicializado en `"127.0.0.1"` para el estado interno de la clase. |
| `5` | `    private $port     = "3306";` | Propiedad `private` `$port` inicializado en `"3306"` para el estado interno de la clase. |
| `6` | `    private $db_name  = "gestion_limpieza";` | Propiedad `private` `$db_name` inicializado en `"gestion_limpieza"` para el estado interno de la clase. |
| `7` | `    private $username = "root";` | Propiedad `private` `$username` inicializado en `"root"` para el estado interno de la clase. |
| `8` | `    private $password = "";` | Propiedad `private` `$password` inicializado en `""` para el estado interno de la clase. |
| `9` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `10` | `    public $conn;` | Propiedad `public` `$conn` para el estado interno de la clase. |
| `11` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `12` | `    public function conectar()` | Declaración de método o función con su firma y parámetros: `public function conectar()`. |
| `13` | `    {` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `14` | `        $this->conn = null;` | Instrucción de ejecución en el contexto del script: `$this->conn = null;`. |
| `15` | `        try {` | Inicia bloque de captura de excepciones `try` para ejecución segura de operaciones críticas. |
| `16` | `            $dsn = "mysql:host={$this->host};port={$this->port};dbname={$th...` | Construye la cadena DSN (Data Source Name) especificando host, puerto, base de datos y UTF-8 mb4. |
| `17` | `            $this->conn = new PDO($dsn, $this->username, $this->password);` | Instancia el objeto PDO para establecer la conexión con el motor MySQL mediante el DSN y credenciales. |
| `18` | `            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEP...` | Configura PDO para reportar cualquier error de base de datos como una excepción (`ERRMODE_EXCEPTION`). |
| `19` | `        } catch (PDOException $e) {` | Captura y manejo de excepciones en caso de fallo durante el bloque protegido: `} catch (PDOException $e) {`. |
| `20` | `            die("Error de conexión: " . $e->getMessage());` | Termina la ejecución del script mostrando el mensaje de error fatal: `die("Error de conexión: " . $e->getMessage());`. |
| `21` | `        }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `22` | `        return $this->conn;` | Retorna el valor resultante de la expresión y culmina la ejecución de la función actual: `return $this->conn;`. |
| `23` | `    }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `24` | `}` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `25` | `?>` | Cierre de la etiqueta PHP para alternar a salida HTML o fin del archivo. |

---

## 3. Resumen y Flujo de Interacción

El archivo `database.php` cumple un rol indispensable en `config/database.php`. 
Configura y provee la conexión centralizada a la base de datos MySQL mediante PDO con manejo de excepciones y UTF-8 mb4. Garantiza la robustez, el orden y la estabilidad de la arquitectura del proyecto `systemLimpieza`.
