# GestiLimpieza – Sistema de Gestión de Limpieza de Módulos SENA

Sistema web en PHP MVC para la gestión del proceso de limpieza de módulos del SENA, integrado con SICEFA.

## Estructura del Proyecto

```
systemLimpieza/
├── config/
│   └── database.php          # Conexión PDO a MySQL
├── controllers/
│   ├── AuthController.php    # Login, logout, cambio de contraseña
│   ├── VoceroController.php  # Gestión de grupos y evidencias (vocero)
│   └── AdminController.php   # Programas, fichas, módulos, asignaciones (admin)
├── models/
│   ├── Usuario.php           # Autenticación y gestión de usuarios
│   ├── Programa.php          # Programas de formación
│   ├── Ficha.php             # Fichas y aprendices
│   ├── Modulo.php            # Módulos y asignaciones
│   ├── Grupo.php             # Grupos de limpieza e integrantes
│   ├── Evidencia.php         # Evidencias fotográficas
│   └── Notificacion.php      # Notificaciones del sistema
├── views/
│   ├── layouts/
│   │   ├── header.php        # Sidebar + topbar (verde SENA)
│   │   └── footer.php        # Footer + Bootstrap JS
│   ├── usuarios/
│   │   ├── login.php         # Formulario de login
│   │   └── cambiar_password.php  # Cambio obligatorio primer acceso
│   └── dashboard/
│       ├── admin_dashboard.php
│       ├── admin_programas.php
│       ├── admin_fichas.php
│       ├── admin_aprendices.php
│       ├── admin_voceros.php
│       ├── admin_modulos.php
│       ├── admin_evidencias.php
│       ├── admin_grupos.php
│       ├── admin_notificaciones.php
│       ├── admin_sincronizacion.php
│       ├── vocero_dashboard.php
│       ├── vocero_aprendices.php
│       ├── vocero_grupos.php
│       ├── vocero_evidencias.php
│       └── vocero_notificaciones.php
├── routes/
│   └── login.php
├── sql/
│   └── gestion_limpieza.sql  # Script completo de la base de datos
├── public/
│   ├── index.php             # Landing page
│   └── uploads/evidencias/   # Imágenes subidas por voceros
└── README.md
```

## Instalación

### 1. Base de datos
```sql
CREATE DATABASE gestion_limpieza CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE gestion_limpieza;
SOURCE sql/gestion_limpieza.sql;
```

### 2. Configuración
Edita `config/database.php` con tus credenciales de MySQL:
```php
private $host     = "127.0.0.1";
private $db_name  = "gestion_limpieza";
private $username = "root";
private $password = "";
```

### 3. Servidor local (XAMPP / Laragon)
Copia la carpeta `systemLimpieza/` en `htdocs/` o `www/` y accede a:
```
http://localhost/systemLimpieza/public/index.php
```

### 4. Credenciales por defecto (administrador)
| Campo     | Valor              |
|-----------|--------------------|
| Correo    | admin@sena.edu.co  |
| Contraseña| password           |

> **Importante:** Cambia la contraseña del administrador inmediatamente después de la primera instalación.

## Roles y acceso

| Rol             | Redirige a              |
|-----------------|-------------------------|
| Administrador   | admin_dashboard.php      |
| Vocero          | vocero_dashboard.php     |

Los voceros son creados automáticamente al sincronizar con SICEFA. En el primer acceso deben cambiar su contraseña temporal.

## Historias de Usuario implementadas

| ID           | Descripción                                              |
|--------------|----------------------------------------------------------|
| HU-0001-VOC1 | Login seguro con credenciales enviadas por correo        |
| HU-0002-VOC2 | Consulta de aprendices de la ficha                       |
| HU-0003-VOC3 | Subida de evidencias fotográficas                        |
| HU-0004-VOC4 | Registro de grupos de limpieza                           |
| HU-0005-VOC5 | Gestión (edición/eliminación) de grupos                  |
| HU-0006-VOC6 | Notificaciones de incumplimiento al vocero               |
| HU-0007-VOC7 | Cambio de contraseña obligatorio en primer acceso        |
| HU-0008-VOC8 | Cierre de sesión seguro                                  |
| HU-0009-ADM1 | Login del administrador con bloqueo por intentos         |
| HU-0010-ADM2 | Visualización y gestión de programas                     |
| HU-0011-ADM3 | Visualización y gestión de fichas                        |
| HU-0012-ADM4 | Registro de módulos y asignaciones a fichas              |
| HU-0013-ADM5 | Restablecimiento de contraseña del administrador         |
| HU-0014-ADM6 | Consulta de evidencias subidas por voceros               |
| HU-0015-ADM7 | Listado de aprendices por ficha                          |
| HU-0016-ADM8 | Sincronización SICEFA y envío de credenciales            |
| HU-0017-ADM9 | Notificaciones de incumplimiento al administrador        |
| HU-0018-ADM10| Cierre de sesión seguro del administrador                |

## Stack tecnológico
- **Backend:** PHP 8.x (PDO, sin framework)
- **Base de datos:** MySQL 8.x
- **Frontend:** Bootstrap 5.3, Font Awesome 6.5, SweetAlert2
- **Patrón:** MVC sin router (dispatcher por archivo)
