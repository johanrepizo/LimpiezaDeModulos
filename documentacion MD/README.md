# Documentación Línea por Línea: `README.md`

## 1. Ficha Técnica del Archivo

- **Archivo:** `README.md`
- **Ruta en el proyecto:** `README.md`
- **Cantidad total de líneas:** `124`
- **Tipo de archivo:** `MD`
- **Propósito general:** Documentación general del repositorio con guía de instalación, historias de usuario, requerimientos y créditos.

---

## 2. Explicación Detallada Línea por Línea

A continuación se presenta cada línea de código numerada de forma consecutiva, acompañada de su fragmento exacto y la explicación exhaustiva de su funcionamiento y responsabilidad en el sistema:

| Línea | Código Fuente | Explicación Detallada |
|---|---|---|
| `1` | `# GestiLimpieza – Sistema de Gestión de Limpieza de Módulos SENA` | Encabezado de primer nivel: título principal del documento (`GestiLimpieza – Sistema de Gestión de Limpieza de Módulos SENA`). |
| `2` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `3` | `Sistema web en PHP MVC para la gestión del proceso de limpieza de módulos d...` | Párrafo descriptivo o línea de texto en formato Markdown: `Sistema web en PHP MVC para la gestión del proceso de limpieza de módulos del SENA, integrado con SICEFA.`. |
| `4` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `5` | `## Estructura del Proyecto` | Encabezado de segundo nivel: sección del documento (`Estructura del Proyecto`). |
| `6` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `7` | `'''` | Delimitador de bloque de código con sintaxis resaltada. |
| `8` | `systemLimpieza/` | Párrafo descriptivo o línea de texto en formato Markdown: `systemLimpieza/`. |
| `9` | `├── config/` | Párrafo descriptivo o línea de texto en formato Markdown: `├── config/`. |
| `10` | `│   └── database.php          # Conexión PDO a MySQL` | Párrafo descriptivo o línea de texto en formato Markdown: `│   └── database.php          # Conexión PDO a MySQL`. |
| `11` | `├── controllers/` | Párrafo descriptivo o línea de texto en formato Markdown: `├── controllers/`. |
| `12` | `│   ├── AuthController.php    # Login, logout, cambio de contraseña` | Párrafo descriptivo o línea de texto en formato Markdown: `│   ├── AuthController.php    # Login, logout, cambio de contraseña`. |
| `13` | `│   ├── VoceroController.php  # Gestión de grupos y evidencias (vocero)` | Párrafo descriptivo o línea de texto en formato Markdown: `│   ├── VoceroController.php  # Gestión de grupos y evidencias (vocero)`. |
| `14` | `│   └── AdminController.php   # Programas, fichas, módulos, asignaciones (a...` | Párrafo descriptivo o línea de texto en formato Markdown: `│   └── AdminController.php   # Programas, fichas, módulos, asignaciones (admin)`. |
| `15` | `├── models/` | Párrafo descriptivo o línea de texto en formato Markdown: `├── models/`. |
| `16` | `│   ├── Usuario.php           # Autenticación y gestión de usuarios` | Párrafo descriptivo o línea de texto en formato Markdown: `│   ├── Usuario.php           # Autenticación y gestión de usuarios`. |
| `17` | `│   ├── Programa.php          # Programas de formación` | Párrafo descriptivo o línea de texto en formato Markdown: `│   ├── Programa.php          # Programas de formación`. |
| `18` | `│   ├── Ficha.php             # Fichas y aprendices` | Párrafo descriptivo o línea de texto en formato Markdown: `│   ├── Ficha.php             # Fichas y aprendices`. |
| `19` | `│   ├── Modulo.php            # Módulos y asignaciones` | Párrafo descriptivo o línea de texto en formato Markdown: `│   ├── Modulo.php            # Módulos y asignaciones`. |
| `20` | `│   ├── Grupo.php             # Grupos de limpieza e integrantes` | Párrafo descriptivo o línea de texto en formato Markdown: `│   ├── Grupo.php             # Grupos de limpieza e integrantes`. |
| `21` | `│   ├── Evidencia.php         # Evidencias fotográficas` | Párrafo descriptivo o línea de texto en formato Markdown: `│   ├── Evidencia.php         # Evidencias fotográficas`. |
| `22` | `│   └── Notificacion.php      # Notificaciones del sistema` | Párrafo descriptivo o línea de texto en formato Markdown: `│   └── Notificacion.php      # Notificaciones del sistema`. |
| `23` | `├── views/` | Párrafo descriptivo o línea de texto en formato Markdown: `├── views/`. |
| `24` | `│   ├── layouts/` | Párrafo descriptivo o línea de texto en formato Markdown: `│   ├── layouts/`. |
| `25` | `│   │   ├── header.php        # Sidebar + topbar (verde SENA)` | Párrafo descriptivo o línea de texto en formato Markdown: `│   │   ├── header.php        # Sidebar + topbar (verde SENA)`. |
| `26` | `│   │   └── footer.php        # Footer + Bootstrap JS` | Párrafo descriptivo o línea de texto en formato Markdown: `│   │   └── footer.php        # Footer + Bootstrap JS`. |
| `27` | `│   ├── usuarios/` | Párrafo descriptivo o línea de texto en formato Markdown: `│   ├── usuarios/`. |
| `28` | `│   │   ├── login.php         # Formulario de login` | Párrafo descriptivo o línea de texto en formato Markdown: `│   │   ├── login.php         # Formulario de login`. |
| `29` | `│   │   └── cambiar_password.php  # Cambio obligatorio primer acceso` | Párrafo descriptivo o línea de texto en formato Markdown: `│   │   └── cambiar_password.php  # Cambio obligatorio primer acceso`. |
| `30` | `│   └── dashboard/` | Párrafo descriptivo o línea de texto en formato Markdown: `│   └── dashboard/`. |
| `31` | `│       ├── admin_dashboard.php` | Párrafo descriptivo o línea de texto en formato Markdown: `│       ├── admin_dashboard.php`. |
| `32` | `│       ├── admin_programas.php` | Párrafo descriptivo o línea de texto en formato Markdown: `│       ├── admin_programas.php`. |
| `33` | `│       ├── admin_fichas.php` | Párrafo descriptivo o línea de texto en formato Markdown: `│       ├── admin_fichas.php`. |
| `34` | `│       ├── admin_aprendices.php` | Párrafo descriptivo o línea de texto en formato Markdown: `│       ├── admin_aprendices.php`. |
| `35` | `│       ├── admin_voceros.php` | Párrafo descriptivo o línea de texto en formato Markdown: `│       ├── admin_voceros.php`. |
| `36` | `│       ├── admin_modulos.php` | Párrafo descriptivo o línea de texto en formato Markdown: `│       ├── admin_modulos.php`. |
| `37` | `│       ├── admin_evidencias.php` | Párrafo descriptivo o línea de texto en formato Markdown: `│       ├── admin_evidencias.php`. |
| `38` | `│       ├── admin_grupos.php` | Párrafo descriptivo o línea de texto en formato Markdown: `│       ├── admin_grupos.php`. |
| `39` | `│       ├── admin_notificaciones.php` | Párrafo descriptivo o línea de texto en formato Markdown: `│       ├── admin_notificaciones.php`. |
| `40` | `│       ├── admin_sincronizacion.php` | Párrafo descriptivo o línea de texto en formato Markdown: `│       ├── admin_sincronizacion.php`. |
| `41` | `│       ├── vocero_dashboard.php` | Párrafo descriptivo o línea de texto en formato Markdown: `│       ├── vocero_dashboard.php`. |
| `42` | `│       ├── vocero_aprendices.php` | Párrafo descriptivo o línea de texto en formato Markdown: `│       ├── vocero_aprendices.php`. |
| `43` | `│       ├── vocero_grupos.php` | Párrafo descriptivo o línea de texto en formato Markdown: `│       ├── vocero_grupos.php`. |
| `44` | `│       ├── vocero_evidencias.php` | Párrafo descriptivo o línea de texto en formato Markdown: `│       ├── vocero_evidencias.php`. |
| `45` | `│       └── vocero_notificaciones.php` | Párrafo descriptivo o línea de texto en formato Markdown: `│       └── vocero_notificaciones.php`. |
| `46` | `├── routes/` | Párrafo descriptivo o línea de texto en formato Markdown: `├── routes/`. |
| `47` | `│   └── login.php` | Párrafo descriptivo o línea de texto en formato Markdown: `│   └── login.php`. |
| `48` | `├── sql/` | Párrafo descriptivo o línea de texto en formato Markdown: `├── sql/`. |
| `49` | `│   └── gestion_limpieza.sql  # Script completo de la base de datos` | Párrafo descriptivo o línea de texto en formato Markdown: `│   └── gestion_limpieza.sql  # Script completo de la base de datos`. |
| `50` | `├── public/` | Párrafo descriptivo o línea de texto en formato Markdown: `├── public/`. |
| `51` | `│   ├── index.php             # Landing page` | Párrafo descriptivo o línea de texto en formato Markdown: `│   ├── index.php             # Landing page`. |
| `52` | `│   └── uploads/evidencias/   # Imágenes subidas por voceros` | Párrafo descriptivo o línea de texto en formato Markdown: `│   └── uploads/evidencias/   # Imágenes subidas por voceros`. |
| `53` | `└── README.md` | Párrafo descriptivo o línea de texto en formato Markdown: `└── README.md`. |
| `54` | `'''` | Delimitador de bloque de código con sintaxis resaltada. |
| `55` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `56` | `## Instalación` | Encabezado de segundo nivel: sección del documento (`Instalación`). |
| `57` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `58` | `### 1. Base de datos` | Encabezado de tercer nivel: subsección (`1. Base de datos`). |
| `59` | `'''sql` | Delimitador de bloque de código con sintaxis resaltada. |
| `60` | `CREATE DATABASE gestion_limpieza CHARACTER SET utf8mb4 COLLATE utf8mb4_gene...` | Párrafo descriptivo o línea de texto en formato Markdown: `CREATE DATABASE gestion_limpieza CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;`. |
| `61` | `USE gestion_limpieza;` | Párrafo descriptivo o línea de texto en formato Markdown: `USE gestion_limpieza;`. |
| `62` | `SOURCE sql/gestion_limpieza.sql;` | Párrafo descriptivo o línea de texto en formato Markdown: `SOURCE sql/gestion_limpieza.sql;`. |
| `63` | `'''` | Delimitador de bloque de código con sintaxis resaltada. |
| `64` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `65` | `### 2. Configuración` | Encabezado de tercer nivel: subsección (`2. Configuración`). |
| `66` | `Edita 'config/database.php' con tus credenciales de MySQL:` | Párrafo descriptivo o línea de texto en formato Markdown: `Edita `config/database.php` con tus credenciales de MySQL:`. |
| `67` | `'''php` | Delimitador de bloque de código con sintaxis resaltada. |
| `68` | `private $host     = "127.0.0.1";` | Párrafo descriptivo o línea de texto en formato Markdown: `private $host     = "127.0.0.1";`. |
| `69` | `private $db_name  = "gestion_limpieza";` | Párrafo descriptivo o línea de texto en formato Markdown: `private $db_name  = "gestion_limpieza";`. |
| `70` | `private $username = "root";` | Párrafo descriptivo o línea de texto en formato Markdown: `private $username = "root";`. |
| `71` | `private $password = "";` | Párrafo descriptivo o línea de texto en formato Markdown: `private $password = "";`. |
| `72` | `'''` | Delimitador de bloque de código con sintaxis resaltada. |
| `73` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `74` | `### 3. Servidor local (XAMPP / Laragon)` | Encabezado de tercer nivel: subsección (`3. Servidor local (XAMPP / Laragon)`). |
| `75` | `Copia la carpeta 'systemLimpieza/' en 'htdocs/' o 'www/' y accede a:` | Párrafo descriptivo o línea de texto en formato Markdown: `Copia la carpeta `systemLimpieza/` en `htdocs/` o `www/` y accede a:`. |
| `76` | `'''` | Delimitador de bloque de código con sintaxis resaltada. |
| `77` | `http://localhost/systemLimpieza/public/index.php` | Párrafo descriptivo o línea de texto en formato Markdown: `http://localhost/systemLimpieza/public/index.php`. |
| `78` | `'''` | Delimitador de bloque de código con sintaxis resaltada. |
| `79` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `80` | `### 4. Credenciales por defecto (administrador)` | Encabezado de tercer nivel: subsección (`4. Credenciales por defecto (administrador)`). |
| `81` | `\| Campo     \| Valor              \|` | Fila o encabezado de tabla Markdown para estructuración de datos: `\| Campo     \| Valor              \|`. |
| `82` | `\|-----------\|--------------------\|` | Fila o encabezado de tabla Markdown para estructuración de datos: `\|-----------\|--------------------\|`. |
| `83` | `\| Correo    \| admin@sena.edu.co  \|` | Fila o encabezado de tabla Markdown para estructuración de datos: `\| Correo    \| admin@sena.edu.co  \|`. |
| `84` | `\| Contraseña\| password           \|` | Fila o encabezado de tabla Markdown para estructuración de datos: `\| Contraseña\| password           \|`. |
| `85` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `86` | `> **Importante:** Cambia la contraseña del administrador inmediatamente des...` | Párrafo descriptivo o línea de texto en formato Markdown: `> **Importante:** Cambia la contraseña del administrador inmediatamente después de la primera instalación.`. |
| `87` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `88` | `## Roles y acceso` | Encabezado de segundo nivel: sección del documento (`Roles y acceso`). |
| `89` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `90` | `\| Rol             \| Redirige a              \|` | Fila o encabezado de tabla Markdown para estructuración de datos: `\| Rol             \| Redirige a              \|`. |
| `91` | `\|-----------------\|-------------------------\|` | Fila o encabezado de tabla Markdown para estructuración de datos: `\|-----------------\|-------------------------\|`. |
| `92` | `\| Administrador   \| admin_dashboard.php      \|` | Fila o encabezado de tabla Markdown para estructuración de datos: `\| Administrador   \| admin_dashboard.php      \|`. |
| `93` | `\| Vocero          \| vocero_dashboard.php     \|` | Fila o encabezado de tabla Markdown para estructuración de datos: `\| Vocero          \| vocero_dashboard.php     \|`. |
| `94` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `95` | `Los voceros son creados automáticamente al sincronizar con SICEFA. En el pr...` | Párrafo descriptivo o línea de texto en formato Markdown: `Los voceros son creados automáticamente al sincronizar con SICEFA. En el primer acceso deben cambiar su contraseña temporal.`. |
| `96` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `97` | `## Historias de Usuario implementadas` | Encabezado de segundo nivel: sección del documento (`Historias de Usuario implementadas`). |
| `98` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `99` | `\| ID           \| Descripción                                              \|` | Fila o encabezado de tabla Markdown para estructuración de datos: `\| ID           \| Descripción                                              \|`. |
| `100` | `\|--------------\|----------------------------------------------------------\|` | Fila o encabezado de tabla Markdown para estructuración de datos: `\|--------------\|----------------------------------------------------------\|`. |
| `101` | `\| HU-0001-VOC1 \| Login seguro con credenciales enviadas por correo        \|` | Fila o encabezado de tabla Markdown para estructuración de datos: `\| HU-0001-VOC1 \| Login seguro con credenciales enviadas por correo        \|`. |
| `102` | `\| HU-0002-VOC2 \| Consulta de aprendices de la ficha                       \|` | Fila o encabezado de tabla Markdown para estructuración de datos: `\| HU-0002-VOC2 \| Consulta de aprendices de la ficha                       \|`. |
| `103` | `\| HU-0003-VOC3 \| Subida de evidencias fotográficas                        \|` | Fila o encabezado de tabla Markdown para estructuración de datos: `\| HU-0003-VOC3 \| Subida de evidencias fotográficas                        \|`. |
| `104` | `\| HU-0004-VOC4 \| Registro de grupos de limpieza                           \|` | Fila o encabezado de tabla Markdown para estructuración de datos: `\| HU-0004-VOC4 \| Registro de grupos de limpieza                           \|`. |
| `105` | `\| HU-0005-VOC5 \| Gestión (edición/eliminación) de grupos                  \|` | Fila o encabezado de tabla Markdown para estructuración de datos: `\| HU-0005-VOC5 \| Gestión (edición/eliminación) de grupos                  \|`. |
| `106` | `\| HU-0006-VOC6 \| Notificaciones de incumplimiento al vocero               \|` | Fila o encabezado de tabla Markdown para estructuración de datos: `\| HU-0006-VOC6 \| Notificaciones de incumplimiento al vocero               \|`. |
| `107` | `\| HU-0007-VOC7 \| Cambio de contraseña obligatorio en primer acceso        \|` | Fila o encabezado de tabla Markdown para estructuración de datos: `\| HU-0007-VOC7 \| Cambio de contraseña obligatorio en primer acceso        \|`. |
| `108` | `\| HU-0008-VOC8 \| Cierre de sesión seguro                                  \|` | Fila o encabezado de tabla Markdown para estructuración de datos: `\| HU-0008-VOC8 \| Cierre de sesión seguro                                  \|`. |
| `109` | `\| HU-0009-ADM1 \| Login del administrador con bloqueo por intentos         \|` | Fila o encabezado de tabla Markdown para estructuración de datos: `\| HU-0009-ADM1 \| Login del administrador con bloqueo por intentos         \|`. |
| `110` | `\| HU-0010-ADM2 \| Visualización y gestión de programas                     \|` | Fila o encabezado de tabla Markdown para estructuración de datos: `\| HU-0010-ADM2 \| Visualización y gestión de programas                     \|`. |
| `111` | `\| HU-0011-ADM3 \| Visualización y gestión de fichas                        \|` | Fila o encabezado de tabla Markdown para estructuración de datos: `\| HU-0011-ADM3 \| Visualización y gestión de fichas                        \|`. |
| `112` | `\| HU-0012-ADM4 \| Registro de módulos y asignaciones a fichas              \|` | Fila o encabezado de tabla Markdown para estructuración de datos: `\| HU-0012-ADM4 \| Registro de módulos y asignaciones a fichas              \|`. |
| `113` | `\| HU-0013-ADM5 \| Restablecimiento de contraseña del administrador         \|` | Fila o encabezado de tabla Markdown para estructuración de datos: `\| HU-0013-ADM5 \| Restablecimiento de contraseña del administrador         \|`. |
| `114` | `\| HU-0014-ADM6 \| Consulta de evidencias subidas por voceros               \|` | Fila o encabezado de tabla Markdown para estructuración de datos: `\| HU-0014-ADM6 \| Consulta de evidencias subidas por voceros               \|`. |
| `115` | `\| HU-0015-ADM7 \| Listado de aprendices por ficha                          \|` | Fila o encabezado de tabla Markdown para estructuración de datos: `\| HU-0015-ADM7 \| Listado de aprendices por ficha                          \|`. |
| `116` | `\| HU-0016-ADM8 \| Sincronización SICEFA y envío de credenciales            \|` | Fila o encabezado de tabla Markdown para estructuración de datos: `\| HU-0016-ADM8 \| Sincronización SICEFA y envío de credenciales            \|`. |
| `117` | `\| HU-0017-ADM9 \| Notificaciones de incumplimiento al administrador        \|` | Fila o encabezado de tabla Markdown para estructuración de datos: `\| HU-0017-ADM9 \| Notificaciones de incumplimiento al administrador        \|`. |
| `118` | `\| HU-0018-ADM10\| Cierre de sesión seguro del administrador                \|` | Fila o encabezado de tabla Markdown para estructuración de datos: `\| HU-0018-ADM10\| Cierre de sesión seguro del administrador                \|`. |
| `119` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `120` | `## Stack tecnológico` | Encabezado de segundo nivel: sección del documento (`Stack tecnológico`). |
| `121` | `- **Backend:** PHP 8.x (PDO, sin framework)` | Elemento de lista con viñeta informativa: `**Backend:** PHP 8.x (PDO, sin framework)`. |
| `122` | `- **Base de datos:** MySQL 8.x` | Elemento de lista con viñeta informativa: `**Base de datos:** MySQL 8.x`. |
| `123` | `- **Frontend:** Bootstrap 5.3, Font Awesome 6.5, SweetAlert2` | Elemento de lista con viñeta informativa: `**Frontend:** Bootstrap 5.3, Font Awesome 6.5, SweetAlert2`. |
| `124` | `- **Patrón:** MVC sin router (dispatcher por archivo)` | Elemento de lista con viñeta informativa: `**Patrón:** MVC sin router (dispatcher por archivo)`. |

---

## 3. Resumen y Flujo de Interacción

El archivo `README.md` cumple un rol indispensable en `README.md`. 
Documentación general del repositorio con guía de instalación, historias de usuario, requerimientos y créditos. Garantiza la robustez, el orden y la estabilidad de la arquitectura del proyecto `systemLimpieza`.
