# Documentación Línea por Línea: `sql/gestion_limpieza.sql`

## 1. Ficha Técnica del Archivo

- **Archivo:** `gestion_limpieza.sql`
- **Ruta en el proyecto:** `sql/gestion_limpieza.sql`
- **Cantidad total de líneas:** `256`
- **Tipo de archivo:** `SQL`
- **Propósito general:** Script maestro de creación de la base de datos completa `gestion_limpieza` (tablas, relaciones foráneas, vistas e inserciones semilla).

---

## 2. Explicación Detallada Línea por Línea

A continuación se presenta cada línea de código numerada de forma consecutiva, acompañada de su fragmento exacto y la explicación exhaustiva de su funcionamiento y responsabilidad en el sistema:

| Línea | Código Fuente | Explicación Detallada |
|---|---|---|
| `1` | `-- ============================================================` | Comentario descriptivo en el script SQL: `============================================================`. |
| `2` | `-- Base de datos: gestion_limpieza` | Comentario descriptivo en el script SQL: `Base de datos: gestion_limpieza`. |
| `3` | `-- Sistema de Gestión de Limpieza de Módulos – SENA/SICEFA` | Comentario descriptivo en el script SQL: `Sistema de Gestión de Limpieza de Módulos – SENA/SICEFA`. |
| `4` | `-- Charset: utf8mb4` | Comentario descriptivo en el script SQL: `Charset: utf8mb4`. |
| `5` | `-- ============================================================` | Comentario descriptivo en el script SQL: `============================================================`. |
| `6` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `7` | `SET NAMES utf8mb4;` | Definición de columna, tipo de dato o restricción SQL: `SET NAMES utf8mb4;`. |
| `8` | `SET FOREIGN_KEY_CHECKS = 0;` | Definición de columna, tipo de dato o restricción SQL: `SET FOREIGN_KEY_CHECKS = 0;`. |
| `9` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `10` | `-- -----------------------------------------------------------` | Comentario descriptivo en el script SQL: `-----------------------------------------------------------`. |
| `11` | `-- 1. ROLES` | Comentario descriptivo en el script SQL: `1. ROLES`. |
| `12` | `-- -----------------------------------------------------------` | Comentario descriptivo en el script SQL: `-----------------------------------------------------------`. |
| `13` | `CREATE TABLE IF NOT EXISTS 'roles' (` | Declaración de creación de la tabla: `CREATE TABLE IF NOT EXISTS `roles` (`. |
| `14` | `  'id_rol'     INT         NOT NULL AUTO_INCREMENT,` | Definición de columna, tipo de dato o restricción SQL: ``id_rol`     INT         NOT NULL AUTO_INCREMENT,`. |
| `15` | `  'nombre_rol' VARCHAR(50) NOT NULL,` | Definición de columna, tipo de dato o restricción SQL: ``nombre_rol` VARCHAR(50) NOT NULL,`. |
| `16` | `  PRIMARY KEY ('id_rol')` | Define la clave primaria única para indexación e identificación de los registros. |
| `17` | `) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;` | Definición de columna, tipo de dato o restricción SQL: `) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;`. |
| `18` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `19` | `INSERT IGNORE INTO 'roles' ('id_rol', 'nombre_rol') VALUES` | Definición de columna, tipo de dato o restricción SQL: `INSERT IGNORE INTO `roles` (`id_rol`, `nombre_rol`) VALUES`. |
| `20` | `  (1, 'Administrador'),` | Definición de columna, tipo de dato o restricción SQL: `(1, 'Administrador'),`. |
| `21` | `  (2, 'Vocero');` | Definición de columna, tipo de dato o restricción SQL: `(2, 'Vocero');`. |
| `22` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `23` | `-- -----------------------------------------------------------` | Comentario descriptivo en el script SQL: `-----------------------------------------------------------`. |
| `24` | `-- 2. USUARIOS` | Comentario descriptivo en el script SQL: `2. USUARIOS`. |
| `25` | `-- -----------------------------------------------------------` | Comentario descriptivo en el script SQL: `-----------------------------------------------------------`. |
| `26` | `CREATE TABLE IF NOT EXISTS 'usuarios' (` | Declaración de creación de la tabla: `CREATE TABLE IF NOT EXISTS `usuarios` (`. |
| `27` | `  'id_usuario'        INT          NOT NULL AUTO_INCREMENT,` | Definición de columna, tipo de dato o restricción SQL: ``id_usuario`        INT          NOT NULL AUTO_INCREMENT,`. |
| `28` | `  'id_rol'            INT          NOT NULL DEFAULT 2,` | Definición de columna, tipo de dato o restricción SQL: ``id_rol`            INT          NOT NULL DEFAULT 2,`. |
| `29` | `  'nombres'           VARCHAR(100) NOT NULL,` | Definición de columna, tipo de dato o restricción SQL: ``nombres`           VARCHAR(100) NOT NULL,`. |
| `30` | `  'apellidos'         VARCHAR(100) NOT NULL,` | Definición de columna, tipo de dato o restricción SQL: ``apellidos`         VARCHAR(100) NOT NULL,`. |
| `31` | `  'documento'         VARCHAR(30)  DEFAULT NULL,` | Definición de columna, tipo de dato o restricción SQL: ``documento`         VARCHAR(30)  DEFAULT NULL,`. |
| `32` | `  'celular'           VARCHAR(20)  DEFAULT NULL,` | Definición de columna, tipo de dato o restricción SQL: ``celular`           VARCHAR(20)  DEFAULT NULL,`. |
| `33` | `  'correo'            VARCHAR(120) NOT NULL,` | Definición de columna, tipo de dato o restricción SQL: ``correo`            VARCHAR(120) NOT NULL,`. |
| `34` | `  'password'          VARCHAR(255) NOT NULL,` | Definición de columna, tipo de dato o restricción SQL: ``password`          VARCHAR(255) NOT NULL,`. |
| `35` | `  'activo'            TINYINT(1)   NOT NULL DEFAULT 1,` | Definición de columna, tipo de dato o restricción SQL: ``activo`            TINYINT(1)   NOT NULL DEFAULT 1,`. |
| `36` | `  'primer_acceso'     TINYINT(1)   NOT NULL DEFAULT 1 COMMENT '1 = debe cam...` | Definición de columna, tipo de dato o restricción SQL: ``primer_acceso`     TINYINT(1)   NOT NULL DEFAULT 1 COMMENT '1 = debe cambiar contraseña al primer login',`. |
| `37` | `  'intentos_fallidos' INT          NOT NULL DEFAULT 0,` | Definición de columna, tipo de dato o restricción SQL: ``intentos_fallidos` INT          NOT NULL DEFAULT 0,`. |
| `38` | `  'bloqueado_hasta'   DATETIME     DEFAULT NULL,` | Definición de columna, tipo de dato o restricción SQL: ``bloqueado_hasta`   DATETIME     DEFAULT NULL,`. |
| `39` | `  'fecha_creacion'    TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP,` | Definición de columna, tipo de dato o restricción SQL: ``fecha_creacion`    TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP,`. |
| `40` | `  PRIMARY KEY ('id_usuario'),` | Define la clave primaria única para indexación e identificación de los registros. |
| `41` | `  UNIQUE KEY 'uk_correo'    ('correo'),` | Definición de columna, tipo de dato o restricción SQL: `UNIQUE KEY `uk_correo`    (`correo`),`. |
| `42` | `  KEY 'fk_usuarios_rol' ('id_rol'),` | Definición de columna, tipo de dato o restricción SQL: `KEY `fk_usuarios_rol` (`id_rol`),`. |
| `43` | `  CONSTRAINT 'fk_usuarios_rol' FOREIGN KEY ('id_rol') REFERENCES 'roles' ('...` | Define una relación de clave foránea con integridad referencial: `CONSTRAINT `fk_usuarios_rol` FOREIGN KEY (`id_rol`) REFERENCES `roles` (`id_rol`)`. |
| `44` | `) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;` | Definición de columna, tipo de dato o restricción SQL: `) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;`. |
| `45` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `46` | `-- Admin por defecto (password: Admin2024!)` | Comentario descriptivo en el script SQL: `Admin por defecto (password: Admin2024!)`. |
| `47` | `INSERT IGNORE INTO 'usuarios'` | Definición de columna, tipo de dato o restricción SQL: `INSERT IGNORE INTO `usuarios``. |
| `48` | `  ('id_usuario', 'id_rol', 'nombres', 'apellidos', 'correo', 'password', 'p...` | Definición de columna, tipo de dato o restricción SQL: `(`id_usuario`, `id_rol`, `nombres`, `apellidos`, `correo`, `password`, `primer_acceso`)`. |
| `49` | `VALUES` | Definición de columna, tipo de dato o restricción SQL: `VALUES`. |
| `50` | `  (1, 1, 'Administrador', 'Sistema', 'admin@sena.edu.co',` | Definición de columna, tipo de dato o restricción SQL: `(1, 1, 'Administrador', 'Sistema', 'admin@sena.edu.co',`. |
| `51` | `   '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 0);` | Definición de columna, tipo de dato o restricción SQL: `'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 0);`. |
| `52` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `53` | `-- -----------------------------------------------------------` | Comentario descriptivo en el script SQL: `-----------------------------------------------------------`. |
| `54` | `-- 3. PROGRAMAS DE FORMACIÓN` | Comentario descriptivo en el script SQL: `3. PROGRAMAS DE FORMACIÓN`. |
| `55` | `-- -----------------------------------------------------------` | Comentario descriptivo en el script SQL: `-----------------------------------------------------------`. |
| `56` | `CREATE TABLE IF NOT EXISTS 'programas' (` | Declaración de creación de la tabla: `CREATE TABLE IF NOT EXISTS `programas` (`. |
| `57` | `  'id_programa'  INT          NOT NULL AUTO_INCREMENT,` | Definición de columna, tipo de dato o restricción SQL: ``id_programa`  INT          NOT NULL AUTO_INCREMENT,`. |
| `58` | `  'nombre'       VARCHAR(200) NOT NULL,` | Definición de columna, tipo de dato o restricción SQL: ``nombre`       VARCHAR(200) NOT NULL,`. |
| `59` | `  'descripcion'  TEXT         DEFAULT NULL,` | Definición de columna, tipo de dato o restricción SQL: ``descripcion`  TEXT         DEFAULT NULL,`. |
| `60` | `  'nivel'        VARCHAR(50)  DEFAULT NULL COMMENT 'Técnico, Tecnólogo, Esp...` | Definición de columna, tipo de dato o restricción SQL: ``nivel`        VARCHAR(50)  DEFAULT NULL COMMENT 'Técnico, Tecnólogo, Especialización, etc.',`. |
| `61` | `  'activo'       TINYINT(1)   NOT NULL DEFAULT 1,` | Definición de columna, tipo de dato o restricción SQL: ``activo`       TINYINT(1)   NOT NULL DEFAULT 1,`. |
| `62` | `  'fecha_creacion' TIMESTAMP  NOT NULL DEFAULT CURRENT_TIMESTAMP,` | Definición de columna, tipo de dato o restricción SQL: ``fecha_creacion` TIMESTAMP  NOT NULL DEFAULT CURRENT_TIMESTAMP,`. |
| `63` | `  PRIMARY KEY ('id_programa')` | Define la clave primaria única para indexación e identificación de los registros. |
| `64` | `) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;` | Definición de columna, tipo de dato o restricción SQL: `) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;`. |
| `65` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `66` | `-- -----------------------------------------------------------` | Comentario descriptivo en el script SQL: `-----------------------------------------------------------`. |
| `67` | `-- 4. FICHAS` | Comentario descriptivo en el script SQL: `4. FICHAS`. |
| `68` | `-- -----------------------------------------------------------` | Comentario descriptivo en el script SQL: `-----------------------------------------------------------`. |
| `69` | `CREATE TABLE IF NOT EXISTS 'fichas' (` | Declaración de creación de la tabla: `CREATE TABLE IF NOT EXISTS `fichas` (`. |
| `70` | `  'id_ficha'          INT          NOT NULL AUTO_INCREMENT,` | Definición de columna, tipo de dato o restricción SQL: ``id_ficha`          INT          NOT NULL AUTO_INCREMENT,`. |
| `71` | `  'id_programa'       INT          NOT NULL,` | Definición de columna, tipo de dato o restricción SQL: ``id_programa`       INT          NOT NULL,`. |
| `72` | `  'numero_ficha'      VARCHAR(20)  NOT NULL,` | Definición de columna, tipo de dato o restricción SQL: ``numero_ficha`      VARCHAR(20)  NOT NULL,`. |
| `73` | `  'jornada'           ENUM('Diurna','Nocturna','Mixta') NOT NULL DEFAULT 'D...` | Definición de columna, tipo de dato o restricción SQL: ``jornada`           ENUM('Diurna','Nocturna','Mixta') NOT NULL DEFAULT 'Diurna',`. |
| `74` | `  'num_aprendices'    INT          DEFAULT NULL,` | Definición de columna, tipo de dato o restricción SQL: ``num_aprendices`    INT          DEFAULT NULL,`. |
| `75` | `  'activo'            TINYINT(1)   NOT NULL DEFAULT 1,` | Definición de columna, tipo de dato o restricción SQL: ``activo`            TINYINT(1)   NOT NULL DEFAULT 1,`. |
| `76` | `  'fecha_creacion'    TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP,` | Definición de columna, tipo de dato o restricción SQL: ``fecha_creacion`    TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP,`. |
| `77` | `  PRIMARY KEY ('id_ficha'),` | Define la clave primaria única para indexación e identificación de los registros. |
| `78` | `  UNIQUE KEY 'uk_ficha_programa' ('numero_ficha', 'id_programa'),` | Definición de columna, tipo de dato o restricción SQL: `UNIQUE KEY `uk_ficha_programa` (`numero_ficha`, `id_programa`),`. |
| `79` | `  KEY 'fk_ficha_programa' ('id_programa'),` | Definición de columna, tipo de dato o restricción SQL: `KEY `fk_ficha_programa` (`id_programa`),`. |
| `80` | `  CONSTRAINT 'fk_ficha_programa' FOREIGN KEY ('id_programa') REFERENCES 'pr...` | Define una relación de clave foránea con integridad referencial: `CONSTRAINT `fk_ficha_programa` FOREIGN KEY (`id_programa`) REFERENCES `programas` (`id_programa`) ON DELETE RESTRICT`. |
| `81` | `) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;` | Definición de columna, tipo de dato o restricción SQL: `) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;`. |
| `82` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `83` | `-- -----------------------------------------------------------` | Comentario descriptivo en el script SQL: `-----------------------------------------------------------`. |
| `84` | `-- 5. VOCEROS (aprendices con rol de vocero, sincronizados de SICEFA)` | Comentario descriptivo en el script SQL: `5. VOCEROS (aprendices con rol de vocero, sincronizados de SICEFA)`. |
| `85` | `-- -----------------------------------------------------------` | Comentario descriptivo en el script SQL: `-----------------------------------------------------------`. |
| `86` | `CREATE TABLE IF NOT EXISTS 'voceros' (` | Declaración de creación de la tabla: `CREATE TABLE IF NOT EXISTS `voceros` (`. |
| `87` | `  'id_vocero'   INT          NOT NULL AUTO_INCREMENT,` | Definición de columna, tipo de dato o restricción SQL: ``id_vocero`   INT          NOT NULL AUTO_INCREMENT,`. |
| `88` | `  'id_usuario'  INT          NOT NULL,` | Definición de columna, tipo de dato o restricción SQL: ``id_usuario`  INT          NOT NULL,`. |
| `89` | `  'id_ficha'    INT          NOT NULL,` | Definición de columna, tipo de dato o restricción SQL: ``id_ficha`    INT          NOT NULL,`. |
| `90` | `  'nombres'     VARCHAR(100) NOT NULL,` | Definición de columna, tipo de dato o restricción SQL: ``nombres`     VARCHAR(100) NOT NULL,`. |
| `91` | `  'apellidos'   VARCHAR(100) NOT NULL,` | Definición de columna, tipo de dato o restricción SQL: ``apellidos`   VARCHAR(100) NOT NULL,`. |
| `92` | `  'documento'   VARCHAR(30)  DEFAULT NULL,` | Definición de columna, tipo de dato o restricción SQL: ``documento`   VARCHAR(30)  DEFAULT NULL,`. |
| `93` | `  'celular'     VARCHAR(20)  DEFAULT NULL,` | Definición de columna, tipo de dato o restricción SQL: ``celular`     VARCHAR(20)  DEFAULT NULL,`. |
| `94` | `  'correo'      VARCHAR(120) NOT NULL,` | Definición de columna, tipo de dato o restricción SQL: ``correo`      VARCHAR(120) NOT NULL,`. |
| `95` | `  'activo'      TINYINT(1)   NOT NULL DEFAULT 1,` | Definición de columna, tipo de dato o restricción SQL: ``activo`      TINYINT(1)   NOT NULL DEFAULT 1,`. |
| `96` | `  'fecha_creacion' TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,` | Definición de columna, tipo de dato o restricción SQL: ``fecha_creacion` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,`. |
| `97` | `  PRIMARY KEY ('id_vocero'),` | Define la clave primaria única para indexación e identificación de los registros. |
| `98` | `  KEY 'fk_vocero_usuario' ('id_usuario'),` | Definición de columna, tipo de dato o restricción SQL: `KEY `fk_vocero_usuario` (`id_usuario`),`. |
| `99` | `  KEY 'fk_vocero_ficha'   ('id_ficha'),` | Definición de columna, tipo de dato o restricción SQL: `KEY `fk_vocero_ficha`   (`id_ficha`),`. |
| `100` | `  CONSTRAINT 'fk_vocero_usuario' FOREIGN KEY ('id_usuario') REFERENCES 'usu...` | Define una relación de clave foránea con integridad referencial: `CONSTRAINT `fk_vocero_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE,`. |
| `101` | `  CONSTRAINT 'fk_vocero_ficha'   FOREIGN KEY ('id_ficha')   REFERENCES 'fic...` | Define una relación de clave foránea con integridad referencial: `CONSTRAINT `fk_vocero_ficha`   FOREIGN KEY (`id_ficha`)   REFERENCES `fichas`   (`id_ficha`)   ON DELETE RESTRICT`. |
| `102` | `) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;` | Definición de columna, tipo de dato o restricción SQL: `) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;`. |
| `103` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `104` | `-- -----------------------------------------------------------` | Comentario descriptivo en el script SQL: `-----------------------------------------------------------`. |
| `105` | `-- 6. APRENDICES (sincronizados de SICEFA, pertenecen a una ficha)` | Comentario descriptivo en el script SQL: `6. APRENDICES (sincronizados de SICEFA, pertenecen a una ficha)`. |
| `106` | `-- -----------------------------------------------------------` | Comentario descriptivo en el script SQL: `-----------------------------------------------------------`. |
| `107` | `CREATE TABLE IF NOT EXISTS 'aprendices' (` | Declaración de creación de la tabla: `CREATE TABLE IF NOT EXISTS `aprendices` (`. |
| `108` | `  'id_aprendiz'  INT          NOT NULL AUTO_INCREMENT,` | Definición de columna, tipo de dato o restricción SQL: ``id_aprendiz`  INT          NOT NULL AUTO_INCREMENT,`. |
| `109` | `  'id_ficha'     INT          NOT NULL,` | Definición de columna, tipo de dato o restricción SQL: ``id_ficha`     INT          NOT NULL,`. |
| `110` | `  'nombres'      VARCHAR(100) NOT NULL,` | Definición de columna, tipo de dato o restricción SQL: ``nombres`      VARCHAR(100) NOT NULL,`. |
| `111` | `  'apellidos'    VARCHAR(100) NOT NULL,` | Definición de columna, tipo de dato o restricción SQL: ``apellidos`    VARCHAR(100) NOT NULL,`. |
| `112` | `  'documento'    VARCHAR(30)  DEFAULT NULL,` | Definición de columna, tipo de dato o restricción SQL: ``documento`    VARCHAR(30)  DEFAULT NULL,`. |
| `113` | `  'celular'      VARCHAR(20)  DEFAULT NULL,` | Definición de columna, tipo de dato o restricción SQL: ``celular`      VARCHAR(20)  DEFAULT NULL,`. |
| `114` | `  'correo'       VARCHAR(120) DEFAULT NULL,` | Definición de columna, tipo de dato o restricción SQL: ``correo`       VARCHAR(120) DEFAULT NULL,`. |
| `115` | `  'activo'       TINYINT(1)   NOT NULL DEFAULT 1,` | Definición de columna, tipo de dato o restricción SQL: ``activo`       TINYINT(1)   NOT NULL DEFAULT 1,`. |
| `116` | `  'fecha_creacion' TIMESTAMP  NOT NULL DEFAULT CURRENT_TIMESTAMP,` | Definición de columna, tipo de dato o restricción SQL: ``fecha_creacion` TIMESTAMP  NOT NULL DEFAULT CURRENT_TIMESTAMP,`. |
| `117` | `  PRIMARY KEY ('id_aprendiz'),` | Define la clave primaria única para indexación e identificación de los registros. |
| `118` | `  KEY 'fk_aprendiz_ficha' ('id_ficha'),` | Definición de columna, tipo de dato o restricción SQL: `KEY `fk_aprendiz_ficha` (`id_ficha`),`. |
| `119` | `  CONSTRAINT 'fk_aprendiz_ficha' FOREIGN KEY ('id_ficha') REFERENCES 'ficha...` | Define una relación de clave foránea con integridad referencial: `CONSTRAINT `fk_aprendiz_ficha` FOREIGN KEY (`id_ficha`) REFERENCES `fichas` (`id_ficha`) ON DELETE RESTRICT`. |
| `120` | `) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;` | Definición de columna, tipo de dato o restricción SQL: `) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;`. |
| `121` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `122` | `-- -----------------------------------------------------------` | Comentario descriptivo en el script SQL: `-----------------------------------------------------------`. |
| `123` | `-- 7. MÓDULOS` | Comentario descriptivo en el script SQL: `7. MÓDULOS`. |
| `124` | `-- -----------------------------------------------------------` | Comentario descriptivo en el script SQL: `-----------------------------------------------------------`. |
| `125` | `CREATE TABLE IF NOT EXISTS 'modulos' (` | Declaración de creación de la tabla: `CREATE TABLE IF NOT EXISTS `modulos` (`. |
| `126` | `  'id_modulo'   INT          NOT NULL AUTO_INCREMENT,` | Definición de columna, tipo de dato o restricción SQL: ``id_modulo`   INT          NOT NULL AUTO_INCREMENT,`. |
| `127` | `  'nombre'      VARCHAR(100) NOT NULL,` | Definición de columna, tipo de dato o restricción SQL: ``nombre`      VARCHAR(100) NOT NULL,`. |
| `128` | `  'ubicacion'   VARCHAR(200) DEFAULT NULL,` | Definición de columna, tipo de dato o restricción SQL: ``ubicacion`   VARCHAR(200) DEFAULT NULL,`. |
| `129` | `  'capacidad'   INT          DEFAULT NULL,` | Definición de columna, tipo de dato o restricción SQL: ``capacidad`   INT          DEFAULT NULL,`. |
| `130` | `  'descripcion' TEXT         DEFAULT NULL,` | Definición de columna, tipo de dato o restricción SQL: ``descripcion` TEXT         DEFAULT NULL,`. |
| `131` | `  'activo'      TINYINT(1)   NOT NULL DEFAULT 1,` | Definición de columna, tipo de dato o restricción SQL: ``activo`      TINYINT(1)   NOT NULL DEFAULT 1,`. |
| `132` | `  'fecha_creacion' TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,` | Definición de columna, tipo de dato o restricción SQL: ``fecha_creacion` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,`. |
| `133` | `  PRIMARY KEY ('id_modulo')` | Define la clave primaria única para indexación e identificación de los registros. |
| `134` | `) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;` | Definición de columna, tipo de dato o restricción SQL: `) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;`. |
| `135` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `136` | `-- -----------------------------------------------------------` | Comentario descriptivo en el script SQL: `-----------------------------------------------------------`. |
| `137` | `-- 8. ASIGNACIONES (módulo asignado a una ficha por período)` | Comentario descriptivo en el script SQL: `8. ASIGNACIONES (módulo asignado a una ficha por período)`. |
| `138` | `-- -----------------------------------------------------------` | Comentario descriptivo en el script SQL: `-----------------------------------------------------------`. |
| `139` | `CREATE TABLE IF NOT EXISTS 'asignaciones' (` | Declaración de creación de la tabla: `CREATE TABLE IF NOT EXISTS `asignaciones` (`. |
| `140` | `  'id_asignacion'   INT          NOT NULL AUTO_INCREMENT,` | Definición de columna, tipo de dato o restricción SQL: ``id_asignacion`   INT          NOT NULL AUTO_INCREMENT,`. |
| `141` | `  'id_modulo'       INT          NOT NULL,` | Definición de columna, tipo de dato o restricción SQL: ``id_modulo`       INT          NOT NULL,`. |
| `142` | `  'id_ficha'        INT          NOT NULL,` | Definición de columna, tipo de dato o restricción SQL: ``id_ficha`        INT          NOT NULL,`. |
| `143` | `  'fecha_inicio'    DATE         NOT NULL,` | Definición de columna, tipo de dato o restricción SQL: ``fecha_inicio`    DATE         NOT NULL,`. |
| `144` | `  'fecha_fin'       DATE         NOT NULL,` | Definición de columna, tipo de dato o restricción SQL: ``fecha_fin`       DATE         NOT NULL,`. |
| `145` | `  'fecha_limite_evidencia' DATETIME NOT NULL COMMENT 'Plazo máximo para sub...` | Definición de columna, tipo de dato o restricción SQL: ``fecha_limite_evidencia` DATETIME NOT NULL COMMENT 'Plazo máximo para subir evidencia',`. |
| `146` | `  'estado'          ENUM('Activa','Completada','Vencida','Cancelada') NOT N...` | Definición de columna, tipo de dato o restricción SQL: ``estado`          ENUM('Activa','Completada','Vencida','Cancelada') NOT NULL DEFAULT 'Activa',`. |
| `147` | `  'fecha_creacion'  TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP,` | Definición de columna, tipo de dato o restricción SQL: ``fecha_creacion`  TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP,`. |
| `148` | `  PRIMARY KEY ('id_asignacion'),` | Define la clave primaria única para indexación e identificación de los registros. |
| `149` | `  KEY 'fk_asig_modulo' ('id_modulo'),` | Definición de columna, tipo de dato o restricción SQL: `KEY `fk_asig_modulo` (`id_modulo`),`. |
| `150` | `  KEY 'fk_asig_ficha'  ('id_ficha'),` | Definición de columna, tipo de dato o restricción SQL: `KEY `fk_asig_ficha`  (`id_ficha`),`. |
| `151` | `  CONSTRAINT 'fk_asig_modulo' FOREIGN KEY ('id_modulo') REFERENCES 'modulos...` | Define una relación de clave foránea con integridad referencial: `CONSTRAINT `fk_asig_modulo` FOREIGN KEY (`id_modulo`) REFERENCES `modulos` (`id_modulo`) ON DELETE RESTRICT,`. |
| `152` | `  CONSTRAINT 'fk_asig_ficha'  FOREIGN KEY ('id_ficha')  REFERENCES 'fichas'...` | Define una relación de clave foránea con integridad referencial: `CONSTRAINT `fk_asig_ficha`  FOREIGN KEY (`id_ficha`)  REFERENCES `fichas`  (`id_ficha`)  ON DELETE RESTRICT`. |
| `153` | `) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;` | Definición de columna, tipo de dato o restricción SQL: `) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;`. |
| `154` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `155` | `-- -----------------------------------------------------------` | Comentario descriptivo en el script SQL: `-----------------------------------------------------------`. |
| `156` | `-- 9. GRUPOS DE LIMPIEZA` | Comentario descriptivo en el script SQL: `9. GRUPOS DE LIMPIEZA`. |
| `157` | `-- -----------------------------------------------------------` | Comentario descriptivo en el script SQL: `-----------------------------------------------------------`. |
| `158` | `CREATE TABLE IF NOT EXISTS 'grupos' (` | Declaración de creación de la tabla: `CREATE TABLE IF NOT EXISTS `grupos` (`. |
| `159` | `  'id_grupo'       INT          NOT NULL AUTO_INCREMENT,` | Definición de columna, tipo de dato o restricción SQL: ``id_grupo`       INT          NOT NULL AUTO_INCREMENT,`. |
| `160` | `  'id_asignacion'  INT          NOT NULL,` | Definición de columna, tipo de dato o restricción SQL: ``id_asignacion`  INT          NOT NULL,`. |
| `161` | `  'id_vocero'      INT          NOT NULL,` | Definición de columna, tipo de dato o restricción SQL: ``id_vocero`      INT          NOT NULL,`. |
| `162` | `  'nombre_grupo'   VARCHAR(100) NOT NULL,` | Definición de columna, tipo de dato o restricción SQL: ``nombre_grupo`   VARCHAR(100) NOT NULL,`. |
| `163` | `  'fecha_limpieza' DATE         NOT NULL,` | Definición de columna, tipo de dato o restricción SQL: ``fecha_limpieza` DATE         NOT NULL,`. |
| `164` | `  'estado'         ENUM('Activo','Completado','Sancionado') NOT NULL DEFAUL...` | Definición de columna, tipo de dato o restricción SQL: ``estado`         ENUM('Activo','Completado','Sancionado') NOT NULL DEFAULT 'Activo',`. |
| `165` | `  'fecha_creacion' TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP,` | Definición de columna, tipo de dato o restricción SQL: ``fecha_creacion` TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP,`. |
| `166` | `  'fecha_modificacion' DATETIME DEFAULT NULL,` | Definición de columna, tipo de dato o restricción SQL: ``fecha_modificacion` DATETIME DEFAULT NULL,`. |
| `167` | `  PRIMARY KEY ('id_grupo'),` | Define la clave primaria única para indexación e identificación de los registros. |
| `168` | `  KEY 'fk_grupo_asignacion' ('id_asignacion'),` | Definición de columna, tipo de dato o restricción SQL: `KEY `fk_grupo_asignacion` (`id_asignacion`),`. |
| `169` | `  KEY 'fk_grupo_vocero'     ('id_vocero'),` | Definición de columna, tipo de dato o restricción SQL: `KEY `fk_grupo_vocero`     (`id_vocero`),`. |
| `170` | `  CONSTRAINT 'fk_grupo_asignacion' FOREIGN KEY ('id_asignacion') REFERENCES...` | Define una relación de clave foránea con integridad referencial: `CONSTRAINT `fk_grupo_asignacion` FOREIGN KEY (`id_asignacion`) REFERENCES `asignaciones` (`id_asignacion`) ON DELETE RESTRICT,`. |
| `171` | `  CONSTRAINT 'fk_grupo_vocero'     FOREIGN KEY ('id_vocero')     REFERENCES...` | Define una relación de clave foránea con integridad referencial: `CONSTRAINT `fk_grupo_vocero`     FOREIGN KEY (`id_vocero`)     REFERENCES `voceros`       (`id_vocero`)     ON DELETE RESTRICT`. |
| `172` | `) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;` | Definición de columna, tipo de dato o restricción SQL: `) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;`. |
| `173` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `174` | `-- -----------------------------------------------------------` | Comentario descriptivo en el script SQL: `-----------------------------------------------------------`. |
| `175` | `-- 10. INTEGRANTES DEL GRUPO` | Comentario descriptivo en el script SQL: `10. INTEGRANTES DEL GRUPO`. |
| `176` | `-- -----------------------------------------------------------` | Comentario descriptivo en el script SQL: `-----------------------------------------------------------`. |
| `177` | `CREATE TABLE IF NOT EXISTS 'grupo_integrantes' (` | Declaración de creación de la tabla: `CREATE TABLE IF NOT EXISTS `grupo_integrantes` (`. |
| `178` | `  'id_integrante' INT NOT NULL AUTO_INCREMENT,` | Definición de columna, tipo de dato o restricción SQL: ``id_integrante` INT NOT NULL AUTO_INCREMENT,`. |
| `179` | `  'id_grupo'      INT NOT NULL,` | Definición de columna, tipo de dato o restricción SQL: ``id_grupo`      INT NOT NULL,`. |
| `180` | `  'id_aprendiz'   INT NOT NULL,` | Definición de columna, tipo de dato o restricción SQL: ``id_aprendiz`   INT NOT NULL,`. |
| `181` | `  PRIMARY KEY ('id_integrante'),` | Define la clave primaria única para indexación e identificación de los registros. |
| `182` | `  UNIQUE KEY 'uk_grupo_aprendiz' ('id_grupo', 'id_aprendiz'),` | Definición de columna, tipo de dato o restricción SQL: `UNIQUE KEY `uk_grupo_aprendiz` (`id_grupo`, `id_aprendiz`),`. |
| `183` | `  KEY 'fk_gi_grupo'    ('id_grupo'),` | Definición de columna, tipo de dato o restricción SQL: `KEY `fk_gi_grupo`    (`id_grupo`),`. |
| `184` | `  KEY 'fk_gi_aprendiz' ('id_aprendiz'),` | Definición de columna, tipo de dato o restricción SQL: `KEY `fk_gi_aprendiz` (`id_aprendiz`),`. |
| `185` | `  CONSTRAINT 'fk_gi_grupo'    FOREIGN KEY ('id_grupo')    REFERENCES 'grupo...` | Define una relación de clave foránea con integridad referencial: `CONSTRAINT `fk_gi_grupo`    FOREIGN KEY (`id_grupo`)    REFERENCES `grupos`    (`id_grupo`)    ON DELETE CASCADE,`. |
| `186` | `  CONSTRAINT 'fk_gi_aprendiz' FOREIGN KEY ('id_aprendiz') REFERENCES 'apren...` | Define una relación de clave foránea con integridad referencial: `CONSTRAINT `fk_gi_aprendiz` FOREIGN KEY (`id_aprendiz`) REFERENCES `aprendices`(`id_aprendiz`) ON DELETE RESTRICT`. |
| `187` | `) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;` | Definición de columna, tipo de dato o restricción SQL: `) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;`. |
| `188` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `189` | `-- -----------------------------------------------------------` | Comentario descriptivo en el script SQL: `-----------------------------------------------------------`. |
| `190` | `-- 11. EVIDENCIAS` | Comentario descriptivo en el script SQL: `11. EVIDENCIAS`. |
| `191` | `-- -----------------------------------------------------------` | Comentario descriptivo en el script SQL: `-----------------------------------------------------------`. |
| `192` | `CREATE TABLE IF NOT EXISTS 'evidencias' (` | Declaración de creación de la tabla: `CREATE TABLE IF NOT EXISTS `evidencias` (`. |
| `193` | `  'id_evidencia'   INT          NOT NULL AUTO_INCREMENT,` | Definición de columna, tipo de dato o restricción SQL: ``id_evidencia`   INT          NOT NULL AUTO_INCREMENT,`. |
| `194` | `  'id_grupo'       INT          NOT NULL,` | Definición de columna, tipo de dato o restricción SQL: ``id_grupo`       INT          NOT NULL,`. |
| `195` | `  'id_vocero'      INT          NOT NULL,` | Definición de columna, tipo de dato o restricción SQL: ``id_vocero`      INT          NOT NULL,`. |
| `196` | `  'nombre_archivo' VARCHAR(255) NOT NULL,` | Definición de columna, tipo de dato o restricción SQL: ``nombre_archivo` VARCHAR(255) NOT NULL,`. |
| `197` | `  'ruta_archivo'   VARCHAR(500) NOT NULL,` | Definición de columna, tipo de dato o restricción SQL: ``ruta_archivo`   VARCHAR(500) NOT NULL,`. |
| `198` | `  'fecha_subida'   DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP,` | Definición de columna, tipo de dato o restricción SQL: ``fecha_subida`   DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP,`. |
| `199` | `  'cumplimiento'   TINYINT(1)   NOT NULL DEFAULT 1 COMMENT '1 = evidencia e...` | Definición de columna, tipo de dato o restricción SQL: ``cumplimiento`   TINYINT(1)   NOT NULL DEFAULT 1 COMMENT '1 = evidencia entregada ✓',`. |
| `200` | `  PRIMARY KEY ('id_evidencia'),` | Define la clave primaria única para indexación e identificación de los registros. |
| `201` | `  KEY 'fk_ev_grupo'   ('id_grupo'),` | Definición de columna, tipo de dato o restricción SQL: `KEY `fk_ev_grupo`   (`id_grupo`),`. |
| `202` | `  KEY 'fk_ev_vocero'  ('id_vocero'),` | Definición de columna, tipo de dato o restricción SQL: `KEY `fk_ev_vocero`  (`id_vocero`),`. |
| `203` | `  CONSTRAINT 'fk_ev_grupo'   FOREIGN KEY ('id_grupo')   REFERENCES 'grupos'...` | Define una relación de clave foránea con integridad referencial: `CONSTRAINT `fk_ev_grupo`   FOREIGN KEY (`id_grupo`)   REFERENCES `grupos`   (`id_grupo`)   ON DELETE RESTRICT,`. |
| `204` | `  CONSTRAINT 'fk_ev_vocero'  FOREIGN KEY ('id_vocero')  REFERENCES 'voceros...` | Define una relación de clave foránea con integridad referencial: `CONSTRAINT `fk_ev_vocero`  FOREIGN KEY (`id_vocero`)  REFERENCES `voceros`  (`id_vocero`)  ON DELETE RESTRICT`. |
| `205` | `) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;` | Definición de columna, tipo de dato o restricción SQL: `) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;`. |
| `206` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `207` | `-- -----------------------------------------------------------` | Comentario descriptivo en el script SQL: `-----------------------------------------------------------`. |
| `208` | `-- 12. HISTORIAL DE MODIFICACIONES DE GRUPOS` | Comentario descriptivo en el script SQL: `12. HISTORIAL DE MODIFICACIONES DE GRUPOS`. |
| `209` | `-- -----------------------------------------------------------` | Comentario descriptivo en el script SQL: `-----------------------------------------------------------`. |
| `210` | `CREATE TABLE IF NOT EXISTS 'historial_grupos' (` | Declaración de creación de la tabla: `CREATE TABLE IF NOT EXISTS `historial_grupos` (`. |
| `211` | `  'id_historial'  INT          NOT NULL AUTO_INCREMENT,` | Definición de columna, tipo de dato o restricción SQL: ``id_historial`  INT          NOT NULL AUTO_INCREMENT,`. |
| `212` | `  'id_grupo'      INT          NOT NULL,` | Definición de columna, tipo de dato o restricción SQL: ``id_grupo`      INT          NOT NULL,`. |
| `213` | `  'descripcion'   TEXT         NOT NULL,` | Definición de columna, tipo de dato o restricción SQL: ``descripcion`   TEXT         NOT NULL,`. |
| `214` | `  'fecha'         DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP,` | Definición de columna, tipo de dato o restricción SQL: ``fecha`         DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP,`. |
| `215` | `  'id_usuario'    INT          DEFAULT NULL,` | Definición de columna, tipo de dato o restricción SQL: ``id_usuario`    INT          DEFAULT NULL,`. |
| `216` | `  PRIMARY KEY ('id_historial'),` | Define la clave primaria única para indexación e identificación de los registros. |
| `217` | `  KEY 'fk_hg_grupo'   ('id_grupo'),` | Definición de columna, tipo de dato o restricción SQL: `KEY `fk_hg_grupo`   (`id_grupo`),`. |
| `218` | `  KEY 'fk_hg_usuario' ('id_usuario'),` | Definición de columna, tipo de dato o restricción SQL: `KEY `fk_hg_usuario` (`id_usuario`),`. |
| `219` | `  CONSTRAINT 'fk_hg_grupo'   FOREIGN KEY ('id_grupo')   REFERENCES 'grupos'...` | Define una relación de clave foránea con integridad referencial: `CONSTRAINT `fk_hg_grupo`   FOREIGN KEY (`id_grupo`)   REFERENCES `grupos`   (`id_grupo`)   ON DELETE CASCADE,`. |
| `220` | `  CONSTRAINT 'fk_hg_usuario' FOREIGN KEY ('id_usuario') REFERENCES 'usuario...` | Define una relación de clave foránea con integridad referencial: `CONSTRAINT `fk_hg_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE SET NULL`. |
| `221` | `) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;` | Definición de columna, tipo de dato o restricción SQL: `) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;`. |
| `222` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `223` | `-- -----------------------------------------------------------` | Comentario descriptivo en el script SQL: `-----------------------------------------------------------`. |
| `224` | `-- 13. NOTIFICACIONES` | Comentario descriptivo en el script SQL: `13. NOTIFICACIONES`. |
| `225` | `-- -----------------------------------------------------------` | Comentario descriptivo en el script SQL: `-----------------------------------------------------------`. |
| `226` | `CREATE TABLE IF NOT EXISTS 'notificaciones' (` | Declaración de creación de la tabla: `CREATE TABLE IF NOT EXISTS `notificaciones` (`. |
| `227` | `  'id_notificacion' INT          NOT NULL AUTO_INCREMENT,` | Definición de columna, tipo de dato o restricción SQL: ``id_notificacion` INT          NOT NULL AUTO_INCREMENT,`. |
| `228` | `  'id_usuario'      INT          NOT NULL COMMENT 'Destinatario',` | Definición de columna, tipo de dato o restricción SQL: ``id_usuario`      INT          NOT NULL COMMENT 'Destinatario',`. |
| `229` | `  'id_asignacion'   INT          DEFAULT NULL,` | Definición de columna, tipo de dato o restricción SQL: ``id_asignacion`   INT          DEFAULT NULL,`. |
| `230` | `  'tipo'            ENUM('incumplimiento','credenciales','recordatorio','in...` | Definición de columna, tipo de dato o restricción SQL: ``tipo`            ENUM('incumplimiento','credenciales','recordatorio','info') NOT NULL DEFAULT 'info',`. |
| `231` | `  'titulo'          VARCHAR(200) NOT NULL,` | Definición de columna, tipo de dato o restricción SQL: ``titulo`          VARCHAR(200) NOT NULL,`. |
| `232` | `  'mensaje'         TEXT         NOT NULL,` | Definición de columna, tipo de dato o restricción SQL: ``mensaje`         TEXT         NOT NULL,`. |
| `233` | `  'leida'           TINYINT(1)   NOT NULL DEFAULT 0,` | Definición de columna, tipo de dato o restricción SQL: ``leida`           TINYINT(1)   NOT NULL DEFAULT 0,`. |
| `234` | `  'fecha'           DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP,` | Definición de columna, tipo de dato o restricción SQL: ``fecha`           DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP,`. |
| `235` | `  PRIMARY KEY ('id_notificacion'),` | Define la clave primaria única para indexación e identificación de los registros. |
| `236` | `  KEY 'fk_noti_usuario'    ('id_usuario'),` | Definición de columna, tipo de dato o restricción SQL: `KEY `fk_noti_usuario`    (`id_usuario`),`. |
| `237` | `  KEY 'fk_noti_asignacion' ('id_asignacion'),` | Definición de columna, tipo de dato o restricción SQL: `KEY `fk_noti_asignacion` (`id_asignacion`),`. |
| `238` | `  CONSTRAINT 'fk_noti_usuario'    FOREIGN KEY ('id_usuario')    REFERENCES ...` | Define una relación de clave foránea con integridad referencial: `CONSTRAINT `fk_noti_usuario`    FOREIGN KEY (`id_usuario`)    REFERENCES `usuarios`     (`id_usuario`)    ON DELETE CASCADE,`. |
| `239` | `  CONSTRAINT 'fk_noti_asignacion' FOREIGN KEY ('id_asignacion') REFERENCES ...` | Define una relación de clave foránea con integridad referencial: `CONSTRAINT `fk_noti_asignacion` FOREIGN KEY (`id_asignacion`) REFERENCES `asignaciones` (`id_asignacion`) ON DELETE SET NULL`. |
| `240` | `) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;` | Definición de columna, tipo de dato o restricción SQL: `) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;`. |
| `241` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `242` | `-- -----------------------------------------------------------` | Comentario descriptivo en el script SQL: `-----------------------------------------------------------`. |
| `243` | `-- 14. LOG DE SINCRONIZACIÓN CON SICEFA` | Comentario descriptivo en el script SQL: `14. LOG DE SINCRONIZACIÓN CON SICEFA`. |
| `244` | `-- -----------------------------------------------------------` | Comentario descriptivo en el script SQL: `-----------------------------------------------------------`. |
| `245` | `CREATE TABLE IF NOT EXISTS 'log_sincronizacion' (` | Declaración de creación de la tabla: `CREATE TABLE IF NOT EXISTS `log_sincronizacion` (`. |
| `246` | `  'id_log'          INT       NOT NULL AUTO_INCREMENT,` | Definición de columna, tipo de dato o restricción SQL: ``id_log`          INT       NOT NULL AUTO_INCREMENT,`. |
| `247` | `  'fecha'           DATETIME  NOT NULL DEFAULT CURRENT_TIMESTAMP,` | Definición de columna, tipo de dato o restricción SQL: ``fecha`           DATETIME  NOT NULL DEFAULT CURRENT_TIMESTAMP,`. |
| `248` | `  'estado'          ENUM('exitoso','fallido','parcial') NOT NULL DEFAULT 'e...` | Definición de columna, tipo de dato o restricción SQL: ``estado`          ENUM('exitoso','fallido','parcial') NOT NULL DEFAULT 'exitoso',`. |
| `249` | `  'aprendices_sync' INT       DEFAULT 0,` | Definición de columna, tipo de dato o restricción SQL: ``aprendices_sync` INT       DEFAULT 0,`. |
| `250` | `  'voceros_creados' INT       DEFAULT 0,` | Definición de columna, tipo de dato o restricción SQL: ``voceros_creados` INT       DEFAULT 0,`. |
| `251` | `  'correos_enviados' INT      DEFAULT 0,` | Definición de columna, tipo de dato o restricción SQL: ``correos_enviados` INT      DEFAULT 0,`. |
| `252` | `  'detalle_error'   TEXT      DEFAULT NULL,` | Definición de columna, tipo de dato o restricción SQL: ``detalle_error`   TEXT      DEFAULT NULL,`. |
| `253` | `  PRIMARY KEY ('id_log')` | Define la clave primaria única para indexación e identificación de los registros. |
| `254` | `) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;` | Definición de columna, tipo de dato o restricción SQL: `) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;`. |
| `255` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `256` | `SET FOREIGN_KEY_CHECKS = 1;` | Definición de columna, tipo de dato o restricción SQL: `SET FOREIGN_KEY_CHECKS = 1;`. |

---

## 3. Resumen y Flujo de Interacción

El archivo `gestion_limpieza.sql` cumple un rol indispensable en `sql/gestion_limpieza.sql`. 
Script maestro de creación de la base de datos completa `gestion_limpieza` (tablas, relaciones foráneas, vistas e inserciones semilla). Garantiza la robustez, el orden y la estabilidad de la arquitectura del proyecto `systemLimpieza`.
