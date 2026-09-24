# Índice General de Documentación Línea por Línea
## Proyecto: Sistema de Gestión de Limpieza de Módulos (SENA)

Esta carpeta contiene un documento Markdown (`.md`) individual para cada uno de los archivos del sistema, desglosando y explicando cada línea de código para facilitar su comprensión, auditoría y sustentación.

### Listado Completo de Archivos Documentados

| Archivo en el Proyecto | Documentación MD | Líneas | Resumen del Componente |
|---|---|---|---|
| `README.md` | [Ver Documentación](./README.md) | 124 | Documentación general del repositorio con guía de instalación, historias de usuario, requerimientos y créditos. |
| `config/database.php` | [Ver Documentación](./config/database.md) | 25 | Configura y provee la conexión centralizada a la base de datos MySQL mediante PDO con manejo de excepciones y UTF-8 mb4. |
| `controllers/AdminController.php` | [Ver Documentación](./controllers/AdminController.md) | 588 | Controlador principal del módulo de administración. Gestiona programas de formación, fichas, módulos, asignaciones de grupos, voceros y supervisión. |
| `controllers/AuthController.php` | [Ver Documentación](./controllers/AuthController.md) | 206 | Controlador de autenticación y seguridad. Gestiona inicio de sesión, verificación de roles, cambio obligatorio de contraseña y cierre de sesión seguro. |
| `controllers/VoceroController.php` | [Ver Documentación](./controllers/VoceroController.md) | 417 | Controlador para el rol Vocero. Permite registrar y editar grupos de limpieza de la ficha, asignar aprendices y subir evidencias fotográficas de los turnos. |
| `models/Evidencia.php` | [Ver Documentación](./models/Evidencia.md) | 133 | Modelo de datos para registrar, consultar y validar evidencias fotográficas de limpieza subidas por los voceros de las fichas. |
| `models/Ficha.php` | [Ver Documentación](./models/Ficha.md) | 120 | Modelo de datos para la gestión académica de fichas de formación del SENA, aprendices asignados y vinculación con programas. |
| `models/Grupo.php` | [Ver Documentación](./models/Grupo.md) | 210 | Modelo de datos para la administración de grupos de trabajo de limpieza conformados por aprendices de una ficha específica. |
| `models/Modulo.php` | [Ver Documentación](./models/Modulo.md) | 167 | Modelo de datos para la administración de módulos/ambientes físicos de formación y asignación de fichas encargadas de su limpieza. |
| `models/Notificacion.php` | [Ver Documentación](./models/Notificacion.md) | 95 | Modelo de datos para la emisión, consulta y actualización de estado (leído/no leído) de alertas y notificaciones del sistema. |
| `models/Programa.php` | [Ver Documentación](./models/Programa.md) | 96 | Modelo de datos para la administración de programas formativos del centro (nombre, nivel y descripción técnica). |
| `models/Turno.php` | [Ver Documentación](./models/Turno.md) | 257 | Modelo de datos para la programación, cálculo de fechas y estado de turnos de limpieza asignados a los grupos de cada módulo. |
| `models/Usuario.php` | [Ver Documentación](./models/Usuario.md) | 142 | Modelo de datos para autenticación, gestión de usuarios, roles (Administrador/Vocero), bloqueo por intentos fallidos y contraseñas cifradas. |
| `public/index.php` | [Ver Documentación](./public/index.md) | 424 | Punto de entrada principal (Landing page) de la aplicación web. Presenta información institucional, accesos y redirecciones según el estado de sesión. |
| `routes/login.php` | [Ver Documentación](./routes/login.md) | 6 | Ruta de despacho rápido y puente para dirigir peticiones de autenticación hacia AuthController. |
| `run_migration2.php` | [Ver Documentación](./run_migration2.md) | 54 | Script de migración automatizada para actualizar la estructura de tablas de turnos y sincronización en la base de datos MySQL. |
| `sql/alter_turnos.sql` | [Ver Documentación](./sql/alter_turnos.md) | 34 | Script SQL de modificación DDL para añadir columnas y restricciones de turnos de limpieza. |
| `sql/gestion_limpieza.sql` | [Ver Documentación](./sql/gestion_limpieza.md) | 256 | Script maestro de creación de la base de datos completa `gestion_limpieza` (tablas, relaciones foráneas, vistas e inserciones semilla). |
| `views/dashboard/admin_aprendices.php` | [Ver Documentación](./views/dashboard/admin_aprendices.md) | 626 | Interfaz del administrador para consultar, buscar y gestionar la información de aprendices vinculados a las fichas. |
| `views/dashboard/admin_dashboard.php` | [Ver Documentación](./views/dashboard/admin_dashboard.md) | 280 | Panel principal del administrador con tarjetas de estadísticas, resúmenes de turnos, gráficas de cumplimiento y accesos directos. |
| `views/dashboard/admin_evidencias.php` | [Ver Documentación](./views/dashboard/admin_evidencias.md) | 522 | Módulo administrativo para revisar, filtrar y auditar las evidencias fotográficas subidas por los voceros de cada módulo. |
| `views/dashboard/admin_fichas.php` | [Ver Documentación](./views/dashboard/admin_fichas.md) | 251 | Interfaz de administración para listar, registrar, editar y asignar voceros a las fichas de formación. |
| `views/dashboard/admin_grupos.php` | [Ver Documentación](./views/dashboard/admin_grupos.md) | 514 | Vista administrativa para supervisar la conformación de grupos de limpieza y aprendices asignados. |
| `views/dashboard/admin_modulos.php` | [Ver Documentación](./views/dashboard/admin_modulos.md) | 389 | Interfaz para crear y administrar los ambientes o módulos físicos del centro y vincularlos con las fichas. |
| `views/dashboard/admin_notificaciones.php` | [Ver Documentación](./views/dashboard/admin_notificaciones.md) | 133 | Bandeja de notificaciones y alertas de incumplimiento recibidas por los administradores. |
| `views/dashboard/admin_programas.php` | [Ver Documentación](./views/dashboard/admin_programas.md) | 563 | Módulo administrativo para el mantenimiento CRUD de los programas académicos del SENA. |
| `views/dashboard/admin_sincronizacion.php` | [Ver Documentación](./views/dashboard/admin_sincronizacion.md) | 164 | Interfaz para ejecutar la sincronización de datos con el sistema SICEFA y emitir credenciales a voceros. |
| `views/dashboard/admin_voceros.php` | [Ver Documentación](./views/dashboard/admin_voceros.md) | 529 | Panel de control y auditoría de los aprendices designados como voceros principales de las fichas. |
| `views/dashboard/vocero_aprendices.php` | [Ver Documentación](./views/dashboard/vocero_aprendices.md) | 108 | Vista del vocero para consultar la lista de aprendices de su ficha para integrarlos a los grupos de aseo. |
| `views/dashboard/vocero_dashboard.php` | [Ver Documentación](./views/dashboard/vocero_dashboard.md) | 266 | Panel principal del vocero con información del módulo asignado, próximo turno y accesos rápidos. |
| `views/dashboard/vocero_evidencias.php` | [Ver Documentación](./views/dashboard/vocero_evidencias.md) | 485 | Listado histórico de evidencias de limpieza subidas por el vocero con su respectivo estado. |
| `views/dashboard/vocero_grupos.php` | [Ver Documentación](./views/dashboard/vocero_grupos.md) | 376 | Módulo donde el vocero organiza, crea y edita los grupos de aprendices para la rotación de limpieza. |
| `views/dashboard/vocero_notificaciones.php` | [Ver Documentación](./views/dashboard/vocero_notificaciones.md) | 131 | Bandeja de notificaciones dirigida al vocero sobre advertencias, turnos pendientes o felicitaciones. |
| `views/dashboard/vocero_subir_evidencia.php` | [Ver Documentación](./views/dashboard/vocero_subir_evidencia.md) | 559 | Formulario con carga de archivos fotográficos y observaciones para registrar el cumplimiento de la limpieza. |
| `views/layouts/footer.php` | [Ver Documentación](./views/layouts/footer.md) | 31 | Plantilla reutilizable de cierre de página con scripts de Bootstrap 5, FontAwesome y SweetAlert2. |
| `views/layouts/header.php` | [Ver Documentación](./views/layouts/header.md) | 268 | Plantilla reutilizable con barra superior institucional SENA, menú lateral (sidebar), metadatos HTML, estilos CSS y control visual de sesión. |
| `views/usuarios/cambiar_password.php` | [Ver Documentación](./views/usuarios/cambiar_password.md) | 211 | Vista para el cambio obligatorio de contraseña en el primer acceso del usuario o recuperación de credenciales. |
| `views/usuarios/login.php` | [Ver Documentación](./views/usuarios/login.md) | 514 | Vista interactiva del formulario de inicio de sesión con validaciones visuales, mensajes flash de error y recuperación. |

---

Generado automáticamente para el repositorio [johanrepizo/LimpiezaDeModulos](https://github.com/johanrepizo/LimpiezaDeModulos).