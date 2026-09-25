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
| `1` | `# GestiLimpieza – Sistema de Gestión de Limpieza de Módulos SENA` | Comentario explicativo en el código: `GestiLimpieza – Sistema de Gestión de Limpieza de Módulos SENA`. |
| `2` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `3` | `Sistema web en PHP MVC para la gestión del proceso de limpieza de módulo...` | Instrucción de ejecución en el contexto del script: `Sistema web en PHP MVC para la gestión del proceso de limpieza de módulo...`. |
| `4` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `5` | `## Estructura del Proyecto` | Comentario explicativo en el código: `Estructura del Proyecto`. |
| `6` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `7` | ````` | Instrucción de ejecución en el contexto del script: `````. |
| `8` | `systemLimpieza/` | Instrucción de ejecución en el contexto del script: `systemLimpieza/`. |
| `9` | `├── config/` | Instrucción de ejecución en el contexto del script: `├── config/`. |
| `10` | `│   └── database.php          # Conexión PDO a MySQL` | Instrucción de ejecución en el contexto del script: `│   └── database.php          # Conexión PDO a MySQL`. |
| `11` | `├── controllers/` | Instrucción de ejecución en el contexto del script: `├── controllers/`. |
| `12` | `│   ├── AuthController.php    # Login, logout, cambio de contraseña` | Instrucción de ejecución en el contexto del script: `│   ├── AuthController.php    # Login, logout, cambio de contraseña`. |
| `13` | `│   ├── VoceroController.php  # Gestión de grupos y evidencias (vocero)` | Instrucción de ejecución en el contexto del script: `│   ├── VoceroController.php  # Gestión de grupos y evidencias (vocero)`. |
| `14` | `│   └── AdminController.php   # Programas, fichas, módulos, asignaciones...` | Instrucción de ejecución en el contexto del script: `│   └── AdminController.php   # Programas, fichas, módulos, asignaciones...`. |
| `15` | `├── models/` | Instrucción de ejecución en el contexto del script: `├── models/`. |
| `16` | `│   ├── Usuario.php           # Autenticación y gestión de usuarios` | Instrucción de ejecución en el contexto del script: `│   ├── Usuario.php           # Autenticación y gestión de usuarios`. |
| `17` | `│   ├── Programa.php          # Programas de formación` | Instrucción de ejecución en el contexto del script: `│   ├── Programa.php          # Programas de formación`. |
| `18` | `│   ├── Ficha.php             # Fichas y aprendices` | Instrucción de ejecución en el contexto del script: `│   ├── Ficha.php             # Fichas y aprendices`. |
| `19` | `│   ├── Modulo.php            # Módulos y asignaciones` | Instrucción de ejecución en el contexto del script: `│   ├── Modulo.php            # Módulos y asignaciones`. |
| `20` | `│   ├── Grupo.php             # Grupos de limpieza e integrantes` | Instrucción de ejecución en el contexto del script: `│   ├── Grupo.php             # Grupos de limpieza e integrantes`. |
| `21` | `│   ├── Evidencia.php         # Evidencias fotográficas` | Instrucción de ejecución en el contexto del script: `│   ├── Evidencia.php         # Evidencias fotográficas`. |
| `22` | `│   └── Notificacion.php      # Notificaciones del sistema` | Instrucción de ejecución en el contexto del script: `│   └── Notificacion.php      # Notificaciones del sistema`. |
| `23` | `├── views/` | Instrucción de ejecución en el contexto del script: `├── views/`. |
| `24` | `│   ├── layouts/` | Instrucción de ejecución en el contexto del script: `│   ├── layouts/`. |
| `25` | `│   │   ├── header.php        # Sidebar + topbar (verde SENA)` | Instrucción de ejecución en el contexto del script: `│   │   ├── header.php        # Sidebar + topbar (verde SENA)`. |
| `26` | `│   │   └── footer.php        # Footer + Bootstrap JS` | Instrucción de ejecución en el contexto del script: `│   │   └── footer.php        # Footer + Bootstrap JS`. |
| `27` | `│   ├── usuarios/` | Instrucción de ejecución en el contexto del script: `│   ├── usuarios/`. |
| `28` | `│   │   ├── login.php         # Formulario de login` | Instrucción de ejecución en el contexto del script: `│   │   ├── login.php         # Formulario de login`. |
| `29` | `│   │   └── cambiar_password.php  # Cambio obligatorio primer acceso` | Instrucción de ejecución en el contexto del script: `│   │   └── cambiar_password.php  # Cambio obligatorio primer acceso`. |
| `30` | `│   └── dashboard/` | Instrucción de ejecución en el contexto del script: `│   └── dashboard/`. |
| `31` | `│       ├── admin_dashboard.php` | Instrucción de ejecución en el contexto del script: `│       ├── admin_dashboard.php`. |
| `32` | `│       ├── admin_programas.php` | Instrucción de ejecución en el contexto del script: `│       ├── admin_programas.php`. |
| `33` | `│       ├── admin_fichas.php` | Instrucción de ejecución en el contexto del script: `│       ├── admin_fichas.php`. |
| `34` | `│       ├── admin_aprendices.php` | Instrucción de ejecución en el contexto del script: `│       ├── admin_aprendices.php`. |
| `35` | `│       ├── admin_voceros.php` | Instrucción de ejecución en el contexto del script: `│       ├── admin_voceros.php`. |
| `36` | `│       ├── admin_modulos.php` | Instrucción de ejecución en el contexto del script: `│       ├── admin_modulos.php`. |
| `37` | `│       ├── admin_evidencias.php` | Instrucción de ejecución en el contexto del script: `│       ├── admin_evidencias.php`. |
| `38` | `│       ├── admin_grupos.php` | Instrucción de ejecución en el contexto del script: `│       ├── admin_grupos.php`. |
| `39` | `│       ├── admin_notificaciones.php` | Instrucción de ejecución en el contexto del script: `│       ├── admin_notificaciones.php`. |
| `40` | `│       ├── admin_sincronizacion.php` | Instrucción de ejecución en el contexto del script: `│       ├── admin_sincronizacion.php`. |
| `41` | `│       ├── vocero_dashboard.php` | Instrucción de ejecución en el contexto del script: `│       ├── vocero_dashboard.php`. |
| `42` | `│       ├── vocero_aprendices.php` | Instrucción de ejecución en el contexto del script: `│       ├── vocero_aprendices.php`. |
| `43` | `│       ├── vocero_grupos.php` | Instrucción de ejecución en el contexto del script: `│       ├── vocero_grupos.php`. |
| `44` | `│       ├── vocero_evidencias.php` | Instrucción de ejecución en el contexto del script: `│       ├── vocero_evidencias.php`. |
| `45` | `│       └── vocero_notificaciones.php` | Instrucción de ejecución en el contexto del script: `│       └── vocero_notificaciones.php`. |
| `46` | `├── routes/` | Instrucción de ejecución en el contexto del script: `├── routes/`. |
| `47` | `│   └── login.php` | Instrucción de ejecución en el contexto del script: `│   └── login.php`. |
| `48` | `├── sql/` | Instrucción de ejecución en el contexto del script: `├── sql/`. |
| `49` | `│   └── gestion_limpieza.sql  # Script completo de la base de datos` | Instrucción de ejecución en el contexto del script: `│   └── gestion_limpieza.sql  # Script completo de la base de datos`. |
| `50` | `├── public/` | Instrucción de ejecución en el contexto del script: `├── public/`. |
| `51` | `│   ├── index.php             # Landing page` | Instrucción de ejecución en el contexto del script: `│   ├── index.php             # Landing page`. |
| `52` | `│   └── uploads/evidencias/   # Imágenes subidas por voceros` | Instrucción de ejecución en el contexto del script: `│   └── uploads/evidencias/   # Imágenes subidas por voceros`. |
| `53` | `└── README.md` | Instrucción de ejecución en el contexto del script: `└── README.md`. |
| `54` | ````` | Instrucción de ejecución en el contexto del script: `````. |
| `55` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `56` | `## Instalación` | Comentario explicativo en el código: `Instalación`. |
| `57` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `58` | `### 1. Base de datos` | Comentario explicativo en el código: `1. Base de datos`. |
| `59` | ````sql` | Instrucción de ejecución en el contexto del script: ````sql`. |
| `60` | `CREATE DATABASE gestion_limpieza CHARACTER SET utf8mb4 COLLATE utf8mb4_g...` | Instrucción de ejecución en el contexto del script: `CREATE DATABASE gestion_limpieza CHARACTER SET utf8mb4 COLLATE utf8mb4_g...`. |
| `61` | `USE gestion_limpieza;` | Instrucción de ejecución en el contexto del script: `USE gestion_limpieza;`. |
| `62` | `SOURCE sql/gestion_limpieza.sql;` | Instrucción de ejecución en el contexto del script: `SOURCE sql/gestion_limpieza.sql;`. |
| `63` | ````` | Instrucción de ejecución en el contexto del script: `````. |
| `64` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `65` | `### 2. Configuración` | Comentario explicativo en el código: `2. Configuración`. |
| `66` | `Edita `config/database.php` con tus credenciales de MySQL:` | Instrucción de ejecución en el contexto del script: `Edita `config/database.php` con tus credenciales de MySQL:`. |
| `67` | ````php` | Instrucción de ejecución en el contexto del script: ````php`. |
| `68` | `private $host     = "127.0.0.1";` | Definición de propiedad de clase para el estado interno del componente: `private $host     = "127.0.0.1";`. |
| `69` | `private $db_name  = "gestion_limpieza";` | Definición de propiedad de clase para el estado interno del componente: `private $db_name  = "gestion_limpieza";`. |
| `70` | `private $username = "root";` | Definición de propiedad de clase para el estado interno del componente: `private $username = "root";`. |
| `71` | `private $password = "";` | Definición de propiedad de clase para el estado interno del componente: `private $password = "";`. |
| `72` | ````` | Instrucción de ejecución en el contexto del script: `````. |
| `73` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `74` | `### 3. Servidor local (XAMPP / Laragon)` | Comentario explicativo en el código: `3. Servidor local (XAMPP / Laragon)`. |
| `75` | `Copia la carpeta `systemLimpieza/` en `htdocs/` o `www/` y accede a:` | Instrucción de ejecución en el contexto del script: `Copia la carpeta `systemLimpieza/` en `htdocs/` o `www/` y accede a:`. |
| `76` | ````` | Instrucción de ejecución en el contexto del script: `````. |
| `77` | `http://localhost/systemLimpieza/public/index.php` | Instrucción de ejecución en el contexto del script: `http://localhost/systemLimpieza/public/index.php`. |
| `78` | ````` | Instrucción de ejecución en el contexto del script: `````. |
| `79` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `80` | `### 4. Credenciales por defecto (administrador)` | Comentario explicativo en el código: `4. Credenciales por defecto (administrador)`. |
| `81` | `\| Campo     \| Valor              \|` | Instrucción de ejecución en el contexto del script: `\| Campo     \| Valor              \|`. |
| `82` | `\|-----------\|--------------------\|` | Instrucción de ejecución en el contexto del script: `\|-----------\|--------------------\|`. |
| `83` | `\| Correo    \| admin@sena.edu.co  \|` | Instrucción de ejecución en el contexto del script: `\| Correo    \| admin@sena.edu.co  \|`. |
| `84` | `\| Contraseña\| password           \|` | Instrucción de ejecución en el contexto del script: `\| Contraseña\| password           \|`. |
| `85` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `86` | `> **Importante:** Cambia la contraseña del administrador inmediatamente ...` | Instrucción de ejecución en el contexto del script: `> **Importante:** Cambia la contraseña del administrador inmediatamente ...`. |
| `87` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `88` | `## Roles y acceso` | Comentario explicativo en el código: `Roles y acceso`. |
| `89` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `90` | `\| Rol             \| Redirige a              \|` | Instrucción de ejecución en el contexto del script: `\| Rol             \| Redirige a              \|`. |
| `91` | `\|-----------------\|-------------------------\|` | Instrucción de ejecución en el contexto del script: `\|-----------------\|-------------------------\|`. |
| `92` | `\| Administrador   \| admin_dashboard.php      \|` | Instrucción de ejecución en el contexto del script: `\| Administrador   \| admin_dashboard.php      \|`. |
| `93` | `\| Vocero          \| vocero_dashboard.php     \|` | Instrucción de ejecución en el contexto del script: `\| Vocero          \| vocero_dashboard.php     \|`. |
| `94` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `95` | `Los voceros son creados automáticamente al sincronizar con SICEFA. En el...` | Instrucción de ejecución en el contexto del script: `Los voceros son creados automáticamente al sincronizar con SICEFA. En el...`. |
| `96` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `97` | `## Historias de Usuario implementadas` | Comentario explicativo en el código: `Historias de Usuario implementadas`. |
| `98` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `99` | `\| ID           \| Descripción                                          ...` | Instrucción de ejecución en el contexto del script: `\| ID           \| Descripción                                          ...`. |
| `100` | `\|--------------\|------------------------------------------------------...` | Instrucción de ejecución en el contexto del script: `\|--------------\|------------------------------------------------------...`. |
| `101` | `\| HU-0001-VOC1 \| Login seguro con credenciales enviadas por correo    ...` | Instrucción de ejecución en el contexto del script: `\| HU-0001-VOC1 \| Login seguro con credenciales enviadas por correo    ...`. |
| `102` | `\| HU-0002-VOC2 \| Consulta de aprendices de la ficha                   ...` | Instrucción de ejecución en el contexto del script: `\| HU-0002-VOC2 \| Consulta de aprendices de la ficha                   ...`. |
| `103` | `\| HU-0003-VOC3 \| Subida de evidencias fotográficas                    ...` | Instrucción de ejecución en el contexto del script: `\| HU-0003-VOC3 \| Subida de evidencias fotográficas                    ...`. |
| `104` | `\| HU-0004-VOC4 \| Registro de grupos de limpieza                       ...` | Instrucción de ejecución en el contexto del script: `\| HU-0004-VOC4 \| Registro de grupos de limpieza                       ...`. |
| `105` | `\| HU-0005-VOC5 \| Gestión (edición/eliminación) de grupos              ...` | Instrucción de ejecución en el contexto del script: `\| HU-0005-VOC5 \| Gestión (edición/eliminación) de grupos              ...`. |
| `106` | `\| HU-0006-VOC6 \| Notificaciones de incumplimiento al vocero           ...` | Instrucción de ejecución en el contexto del script: `\| HU-0006-VOC6 \| Notificaciones de incumplimiento al vocero           ...`. |
| `107` | `\| HU-0007-VOC7 \| Cambio de contraseña obligatorio en primer acceso    ...` | Instrucción de ejecución en el contexto del script: `\| HU-0007-VOC7 \| Cambio de contraseña obligatorio en primer acceso    ...`. |
| `108` | `\| HU-0008-VOC8 \| Cierre de sesión seguro                              ...` | Instrucción de ejecución en el contexto del script: `\| HU-0008-VOC8 \| Cierre de sesión seguro                              ...`. |
| `109` | `\| HU-0009-ADM1 \| Login del administrador con bloqueo por intentos     ...` | Instrucción de ejecución en el contexto del script: `\| HU-0009-ADM1 \| Login del administrador con bloqueo por intentos     ...`. |
| `110` | `\| HU-0010-ADM2 \| Visualización y gestión de programas                 ...` | Instrucción de ejecución en el contexto del script: `\| HU-0010-ADM2 \| Visualización y gestión de programas                 ...`. |
| `111` | `\| HU-0011-ADM3 \| Visualización y gestión de fichas                    ...` | Instrucción de ejecución en el contexto del script: `\| HU-0011-ADM3 \| Visualización y gestión de fichas                    ...`. |
| `112` | `\| HU-0012-ADM4 \| Registro de módulos y asignaciones a fichas          ...` | Instrucción de ejecución en el contexto del script: `\| HU-0012-ADM4 \| Registro de módulos y asignaciones a fichas          ...`. |
| `113` | `\| HU-0013-ADM5 \| Restablecimiento de contraseña del administrador     ...` | Instrucción de ejecución en el contexto del script: `\| HU-0013-ADM5 \| Restablecimiento de contraseña del administrador     ...`. |
| `114` | `\| HU-0014-ADM6 \| Consulta de evidencias subidas por voceros           ...` | Instrucción de ejecución en el contexto del script: `\| HU-0014-ADM6 \| Consulta de evidencias subidas por voceros           ...`. |
| `115` | `\| HU-0015-ADM7 \| Listado de aprendices por ficha                      ...` | Instrucción de ejecución en el contexto del script: `\| HU-0015-ADM7 \| Listado de aprendices por ficha                      ...`. |
| `116` | `\| HU-0016-ADM8 \| Sincronización SICEFA y envío de credenciales        ...` | Instrucción de ejecución en el contexto del script: `\| HU-0016-ADM8 \| Sincronización SICEFA y envío de credenciales        ...`. |
| `117` | `\| HU-0017-ADM9 \| Notificaciones de incumplimiento al administrador    ...` | Instrucción de ejecución en el contexto del script: `\| HU-0017-ADM9 \| Notificaciones de incumplimiento al administrador    ...`. |
| `118` | `\| HU-0018-ADM10\| Cierre de sesión seguro del administrador            ...` | Instrucción de ejecución en el contexto del script: `\| HU-0018-ADM10\| Cierre de sesión seguro del administrador            ...`. |
| `119` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `120` | `## Stack tecnológico` | Comentario explicativo en el código: `Stack tecnológico`. |
| `121` | `- **Backend:** PHP 8.x (PDO, sin framework)` | Instrucción de ejecución en el contexto del script: `- **Backend:** PHP 8.x (PDO, sin framework)`. |
| `122` | `- **Base de datos:** MySQL 8.x` | Instrucción de ejecución en el contexto del script: `- **Base de datos:** MySQL 8.x`. |
| `123` | `- **Frontend:** Bootstrap 5.3, Font Awesome 6.5, SweetAlert2` | Instrucción de ejecución en el contexto del script: `- **Frontend:** Bootstrap 5.3, Font Awesome 6.5, SweetAlert2`. |
| `124` | `- **Patrón:** MVC sin router (dispatcher por archivo)` | Instrucción de ejecución en el contexto del script: `- **Patrón:** MVC sin router (dispatcher por archivo)`. |

---

## 3. Resumen y Flujo de Interacción

El archivo `README.md` cumple un rol indispensable en `README.md`. 
Documentación general del repositorio con guía de instalación, historias de usuario, requerimientos y créditos. Garantiza la robustez, el orden y la estabilidad de la arquitectura del proyecto `systemLimpieza`.

---

Generado automáticamente para el repositorio [johanrepizo/LimpiezaDeModulos](https://github.com/johanrepizo/LimpiezaDeModulos).
