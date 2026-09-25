# Documentación Línea por Línea: `sql/gestion_limpieza.sql`

## 1. Ficha Técnica del Archivo

- **Archivo:** `gestion_limpieza.sql`
- **Ruta en el proyecto:** `sql/gestion_limpieza.sql`
- **Cantidad total de líneas:** `256`
- **Tipo de archivo:** `SQL`
- **Propósito general:** Script maestro de creación de la base de datos completa gestion_limpieza (tablas, relaciones foráneas, vistas e inserciones semilla).

---

## 2. Explicación Detallada Línea por Línea

A continuación se presenta cada línea de código numerada de forma consecutiva, acompañada de su fragmento exacto y la explicación exhaustiva de su funcionamiento y responsabilidad en el sistema:

| Línea | Código Fuente | Explicación Detallada |
|---|---|---|
| `1` | `-- ============================================================` | Comentario explicativo SQL: `============================================================`. |
| `2` | `-- Base de datos: gestion_limpieza` | Comentario explicativo SQL: `Base de datos: gestion_limpieza`. |
| `3` | `-- Sistema de Gestión de Limpieza de Módulos – SENA/SICEFA` | Comentario explicativo SQL: `Sistema de Gestión de Limpieza de Módulos – SENA/SICEFA`. |
| `4` | `-- Charset: utf8mb4` | Comentario explicativo SQL: `Charset: utf8mb4`. |
| `5` | `-- ============================================================` | Comentario explicativo SQL: `============================================================`. |
| `6` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `7` | `SET NAMES utf8mb4;` | Instrucción de ejecución en el contexto del script: `SET NAMES utf8mb4;`. |
| `8` | `SET FOREIGN_KEY_CHECKS = 0;` | Instrucción de ejecución en el contexto del script: `SET FOREIGN_KEY_CHECKS = 0;`. |
| `9` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `10` | `-- -----------------------------------------------------------` | Comentario explicativo SQL: ``. |
| `11` | `-- 1. ROLES` | Comentario explicativo SQL: `1. ROLES`. |
| `12` | `-- -----------------------------------------------------------` | Comentario explicativo SQL: ``. |
| `13` | `CREATE TABLE IF NOT EXISTS `roles` (` | Instrucción de ejecución en el contexto del script: `CREATE TABLE IF NOT EXISTS `roles` (`. |
| `14` | ``id_rol`     INT         NOT NULL AUTO_INCREMENT,` | Instrucción de ejecución en el contexto del script: ``id_rol`     INT         NOT NULL AUTO_INCREMENT,`. |
| `15` | ``nombre_rol` VARCHAR(50) NOT NULL,` | Instrucción de ejecución en el contexto del script: ``nombre_rol` VARCHAR(50) NOT NULL,`. |
| `16` | `PRIMARY KEY (`id_rol`)` | Instrucción de ejecución en el contexto del script: `PRIMARY KEY (`id_rol`)`. |
| `17` | `) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;` | Instrucción de ejecución en el contexto del script: `) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;`. |
| `18` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `19` | `INSERT IGNORE INTO `roles` (`id_rol`, `nombre_rol`) VALUES` | Instrucción de ejecución en el contexto del script: `INSERT IGNORE INTO `roles` (`id_rol`, `nombre_rol`) VALUES`. |
| `20` | `(1, 'Administrador'),` | Instrucción de ejecución en el contexto del script: `(1, 'Administrador'),`. |
| `21` | `(2, 'Vocero');` | Instrucción de ejecución en el contexto del script: `(2, 'Vocero');`. |
| `22` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `23` | `-- -----------------------------------------------------------` | Comentario explicativo SQL: ``. |
| `24` | `-- 2. USUARIOS` | Comentario explicativo SQL: `2. USUARIOS`. |
| `25` | `-- -----------------------------------------------------------` | Comentario explicativo SQL: ``. |
| `26` | `CREATE TABLE IF NOT EXISTS `usuarios` (` | Instrucción de ejecución en el contexto del script: `CREATE TABLE IF NOT EXISTS `usuarios` (`. |
| `27` | ``id_usuario`        INT          NOT NULL AUTO_INCREMENT,` | Instrucción de ejecución en el contexto del script: ``id_usuario`        INT          NOT NULL AUTO_INCREMENT,`. |
| `28` | ``id_rol`            INT          NOT NULL DEFAULT 2,` | Instrucción de ejecución en el contexto del script: ``id_rol`            INT          NOT NULL DEFAULT 2,`. |
| `29` | ``nombres`           VARCHAR(100) NOT NULL,` | Instrucción de ejecución en el contexto del script: ``nombres`           VARCHAR(100) NOT NULL,`. |
| `30` | ``apellidos`         VARCHAR(100) NOT NULL,` | Instrucción de ejecución en el contexto del script: ``apellidos`         VARCHAR(100) NOT NULL,`. |
| `31` | ``documento`         VARCHAR(30)  DEFAULT NULL,` | Instrucción de ejecución en el contexto del script: ``documento`         VARCHAR(30)  DEFAULT NULL,`. |
| `32` | ``celular`           VARCHAR(20)  DEFAULT NULL,` | Instrucción de ejecución en el contexto del script: ``celular`           VARCHAR(20)  DEFAULT NULL,`. |
| `33` | ``correo`            VARCHAR(120) NOT NULL,` | Instrucción de ejecución en el contexto del script: ``correo`            VARCHAR(120) NOT NULL,`. |
| `34` | ``password`          VARCHAR(255) NOT NULL,` | Instrucción de ejecución en el contexto del script: ``password`          VARCHAR(255) NOT NULL,`. |
| `35` | ``activo`            TINYINT(1)   NOT NULL DEFAULT 1,` | Instrucción de ejecución en el contexto del script: ``activo`            TINYINT(1)   NOT NULL DEFAULT 1,`. |
| `36` | ``primer_acceso`     TINYINT(1)   NOT NULL DEFAULT 1 COMMENT '1 = debe ca...` | Instrucción de ejecución en el contexto del script: ``primer_acceso`     TINYINT(1)   NOT NULL DEFAULT 1 COMMENT '1 = debe ca...`. |
| `37` | ``intentos_fallidos` INT          NOT NULL DEFAULT 0,` | Instrucción de ejecución en el contexto del script: ``intentos_fallidos` INT          NOT NULL DEFAULT 0,`. |
| `38` | ``bloqueado_hasta`   DATETIME     DEFAULT NULL,` | Instrucción de ejecución en el contexto del script: ``bloqueado_hasta`   DATETIME     DEFAULT NULL,`. |
| `39` | ``fecha_creacion`    TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP,` | Instrucción de ejecución en el contexto del script: ``fecha_creacion`    TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP,`. |
| `40` | `PRIMARY KEY (`id_usuario`),` | Instrucción de ejecución en el contexto del script: `PRIMARY KEY (`id_usuario`),`. |
| `41` | `UNIQUE KEY `uk_correo`    (`correo`),` | Instrucción de ejecución en el contexto del script: `UNIQUE KEY `uk_correo`    (`correo`),`. |
| `42` | `KEY `fk_usuarios_rol` (`id_rol`),` | Instrucción de ejecución en el contexto del script: `KEY `fk_usuarios_rol` (`id_rol`),`. |
| `43` | `CONSTRAINT `fk_usuarios_rol` FOREIGN KEY (`id_rol`) REFERENCES `roles` (...` | Instrucción de ejecución en el contexto del script: `CONSTRAINT `fk_usuarios_rol` FOREIGN KEY (`id_rol`) REFERENCES `roles` (...`. |
| `44` | `) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;` | Instrucción de ejecución en el contexto del script: `) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;`. |
| `45` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `46` | `-- Admin por defecto (password: Admin2024!)` | Comentario explicativo SQL: `Admin por defecto (password: Admin2024!)`. |
| `47` | `INSERT IGNORE INTO `usuarios`` | Instrucción de ejecución en el contexto del script: `INSERT IGNORE INTO `usuarios``. |
| `48` | `(`id_usuario`, `id_rol`, `nombres`, `apellidos`, `correo`, `password`, `...` | Instrucción de ejecución en el contexto del script: `(`id_usuario`, `id_rol`, `nombres`, `apellidos`, `correo`, `password`, `...`. |
| `49` | `VALUES` | Instrucción de ejecución en el contexto del script: `VALUES`. |
| `50` | `(1, 1, 'Administrador', 'Sistema', 'admin@sena.edu.co',` | Instrucción de ejecución en el contexto del script: `(1, 1, 'Administrador', 'Sistema', 'admin@sena.edu.co',`. |
| `51` | `'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 0);` | Instrucción de ejecución en el contexto del script: `'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 0);`. |
| `52` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `53` | `-- -----------------------------------------------------------` | Comentario explicativo SQL: ``. |
| `54` | `-- 3. PROGRAMAS DE FORMACIÓN` | Comentario explicativo SQL: `3. PROGRAMAS DE FORMACIÓN`. |
| `55` | `-- -----------------------------------------------------------` | Comentario explicativo SQL: ``. |
| `56` | `CREATE TABLE IF NOT EXISTS `programas` (` | Instrucción de ejecución en el contexto del script: `CREATE TABLE IF NOT EXISTS `programas` (`. |
| `57` | ``id_programa`  INT          NOT NULL AUTO_INCREMENT,` | Instrucción de ejecución en el contexto del script: ``id_programa`  INT          NOT NULL AUTO_INCREMENT,`. |
| `58` | ``nombre`       VARCHAR(200) NOT NULL,` | Instrucción de ejecución en el contexto del script: ``nombre`       VARCHAR(200) NOT NULL,`. |
| `59` | ``descripcion`  TEXT         DEFAULT NULL,` | Instrucción de ejecución en el contexto del script: ``descripcion`  TEXT         DEFAULT NULL,`. |
| `60` | ``nivel`        VARCHAR(50)  DEFAULT NULL COMMENT 'Técnico, Tecnólogo, Es...` | Instrucción de ejecución en el contexto del script: ``nivel`        VARCHAR(50)  DEFAULT NULL COMMENT 'Técnico, Tecnólogo, Es...`. |
| `61` | ``activo`       TINYINT(1)   NOT NULL DEFAULT 1,` | Instrucción de ejecución en el contexto del script: ``activo`       TINYINT(1)   NOT NULL DEFAULT 1,`. |
| `62` | ``fecha_creacion` TIMESTAMP  NOT NULL DEFAULT CURRENT_TIMESTAMP,` | Instrucción de ejecución en el contexto del script: ``fecha_creacion` TIMESTAMP  NOT NULL DEFAULT CURRENT_TIMESTAMP,`. |
| `63` | `PRIMARY KEY (`id_programa`)` | Instrucción de ejecución en el contexto del script: `PRIMARY KEY (`id_programa`)`. |
| `64` | `) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;` | Instrucción de ejecución en el contexto del script: `) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;`. |
| `65` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `66` | `-- -----------------------------------------------------------` | Comentario explicativo SQL: ``. |
| `67` | `-- 4. FICHAS` | Comentario explicativo SQL: `4. FICHAS`. |
| `68` | `-- -----------------------------------------------------------` | Comentario explicativo SQL: ``. |
| `69` | `CREATE TABLE IF NOT EXISTS `fichas` (` | Instrucción de ejecución en el contexto del script: `CREATE TABLE IF NOT EXISTS `fichas` (`. |
| `70` | ``id_ficha`          INT          NOT NULL AUTO_INCREMENT,` | Instrucción de ejecución en el contexto del script: ``id_ficha`          INT          NOT NULL AUTO_INCREMENT,`. |
| `71` | ``id_programa`       INT          NOT NULL,` | Instrucción de ejecución en el contexto del script: ``id_programa`       INT          NOT NULL,`. |
| `72` | ``numero_ficha`      VARCHAR(20)  NOT NULL,` | Instrucción de ejecución en el contexto del script: ``numero_ficha`      VARCHAR(20)  NOT NULL,`. |
| `73` | ``jornada`           ENUM('Diurna','Nocturna','Mixta') NOT NULL DEFAULT '...` | Instrucción de ejecución en el contexto del script: ``jornada`           ENUM('Diurna','Nocturna','Mixta') NOT NULL DEFAULT '...`. |
| `74` | ``num_aprendices`    INT          DEFAULT NULL,` | Instrucción de ejecución en el contexto del script: ``num_aprendices`    INT          DEFAULT NULL,`. |
| `75` | ``activo`            TINYINT(1)   NOT NULL DEFAULT 1,` | Instrucción de ejecución en el contexto del script: ``activo`            TINYINT(1)   NOT NULL DEFAULT 1,`. |
| `76` | ``fecha_creacion`    TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP,` | Instrucción de ejecución en el contexto del script: ``fecha_creacion`    TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP,`. |
| `77` | `PRIMARY KEY (`id_ficha`),` | Instrucción de ejecución en el contexto del script: `PRIMARY KEY (`id_ficha`),`. |
| `78` | `UNIQUE KEY `uk_ficha_programa` (`numero_ficha`, `id_programa`),` | Instrucción de ejecución en el contexto del script: `UNIQUE KEY `uk_ficha_programa` (`numero_ficha`, `id_programa`),`. |
| `79` | `KEY `fk_ficha_programa` (`id_programa`),` | Instrucción de ejecución en el contexto del script: `KEY `fk_ficha_programa` (`id_programa`),`. |
| `80` | `CONSTRAINT `fk_ficha_programa` FOREIGN KEY (`id_programa`) REFERENCES `p...` | Instrucción de ejecución en el contexto del script: `CONSTRAINT `fk_ficha_programa` FOREIGN KEY (`id_programa`) REFERENCES `p...`. |
| `81` | `) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;` | Instrucción de ejecución en el contexto del script: `) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;`. |
| `82` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `83` | `-- -----------------------------------------------------------` | Comentario explicativo SQL: ``. |
| `84` | `-- 5. VOCEROS (aprendices con rol de vocero, sincronizados de SICEFA)` | Comentario explicativo SQL: `5. VOCEROS (aprendices con rol de vocero, sincronizados de SICEFA)`. |
| `85` | `-- -----------------------------------------------------------` | Comentario explicativo SQL: ``. |
| `86` | `CREATE TABLE IF NOT EXISTS `voceros` (` | Instrucción de ejecución en el contexto del script: `CREATE TABLE IF NOT EXISTS `voceros` (`. |
| `87` | ``id_vocero`   INT          NOT NULL AUTO_INCREMENT,` | Instrucción de ejecución en el contexto del script: ``id_vocero`   INT          NOT NULL AUTO_INCREMENT,`. |
| `88` | ``id_usuario`  INT          NOT NULL,` | Instrucción de ejecución en el contexto del script: ``id_usuario`  INT          NOT NULL,`. |
| `89` | ``id_ficha`    INT          NOT NULL,` | Instrucción de ejecución en el contexto del script: ``id_ficha`    INT          NOT NULL,`. |
| `90` | ``nombres`     VARCHAR(100) NOT NULL,` | Instrucción de ejecución en el contexto del script: ``nombres`     VARCHAR(100) NOT NULL,`. |
| `91` | ``apellidos`   VARCHAR(100) NOT NULL,` | Instrucción de ejecución en el contexto del script: ``apellidos`   VARCHAR(100) NOT NULL,`. |
| `92` | ``documento`   VARCHAR(30)  DEFAULT NULL,` | Instrucción de ejecución en el contexto del script: ``documento`   VARCHAR(30)  DEFAULT NULL,`. |
| `93` | ``celular`     VARCHAR(20)  DEFAULT NULL,` | Instrucción de ejecución en el contexto del script: ``celular`     VARCHAR(20)  DEFAULT NULL,`. |
| `94` | ``correo`      VARCHAR(120) NOT NULL,` | Instrucción de ejecución en el contexto del script: ``correo`      VARCHAR(120) NOT NULL,`. |
| `95` | ``activo`      TINYINT(1)   NOT NULL DEFAULT 1,` | Instrucción de ejecución en el contexto del script: ``activo`      TINYINT(1)   NOT NULL DEFAULT 1,`. |
| `96` | ``fecha_creacion` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,` | Instrucción de ejecución en el contexto del script: ``fecha_creacion` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,`. |
| `97` | `PRIMARY KEY (`id_vocero`),` | Instrucción de ejecución en el contexto del script: `PRIMARY KEY (`id_vocero`),`. |
| `98` | `KEY `fk_vocero_usuario` (`id_usuario`),` | Instrucción de ejecución en el contexto del script: `KEY `fk_vocero_usuario` (`id_usuario`),`. |
| `99` | `KEY `fk_vocero_ficha`   (`id_ficha`),` | Instrucción de ejecución en el contexto del script: `KEY `fk_vocero_ficha`   (`id_ficha`),`. |
| `100` | `CONSTRAINT `fk_vocero_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `us...` | Instrucción de ejecución en el contexto del script: `CONSTRAINT `fk_vocero_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `us...`. |
| `101` | `CONSTRAINT `fk_vocero_ficha`   FOREIGN KEY (`id_ficha`)   REFERENCES `fi...` | Instrucción de ejecución en el contexto del script: `CONSTRAINT `fk_vocero_ficha`   FOREIGN KEY (`id_ficha`)   REFERENCES `fi...`. |
| `102` | `) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;` | Instrucción de ejecución en el contexto del script: `) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;`. |
| `103` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `104` | `-- -----------------------------------------------------------` | Comentario explicativo SQL: ``. |
| `105` | `-- 6. APRENDICES (sincronizados de SICEFA, pertenecen a una ficha)` | Comentario explicativo SQL: `6. APRENDICES (sincronizados de SICEFA, pertenecen a una ficha)`. |
| `106` | `-- -----------------------------------------------------------` | Comentario explicativo SQL: ``. |
| `107` | `CREATE TABLE IF NOT EXISTS `aprendices` (` | Instrucción de ejecución en el contexto del script: `CREATE TABLE IF NOT EXISTS `aprendices` (`. |
| `108` | ``id_aprendiz`  INT          NOT NULL AUTO_INCREMENT,` | Instrucción de ejecución en el contexto del script: ``id_aprendiz`  INT          NOT NULL AUTO_INCREMENT,`. |
| `109` | ``id_ficha`     INT          NOT NULL,` | Instrucción de ejecución en el contexto del script: ``id_ficha`     INT          NOT NULL,`. |
| `110` | ``nombres`      VARCHAR(100) NOT NULL,` | Instrucción de ejecución en el contexto del script: ``nombres`      VARCHAR(100) NOT NULL,`. |
| `111` | ``apellidos`    VARCHAR(100) NOT NULL,` | Instrucción de ejecución en el contexto del script: ``apellidos`    VARCHAR(100) NOT NULL,`. |
| `112` | ``documento`    VARCHAR(30)  DEFAULT NULL,` | Instrucción de ejecución en el contexto del script: ``documento`    VARCHAR(30)  DEFAULT NULL,`. |
| `113` | ``celular`      VARCHAR(20)  DEFAULT NULL,` | Instrucción de ejecución en el contexto del script: ``celular`      VARCHAR(20)  DEFAULT NULL,`. |
| `114` | ``correo`       VARCHAR(120) DEFAULT NULL,` | Instrucción de ejecución en el contexto del script: ``correo`       VARCHAR(120) DEFAULT NULL,`. |
| `115` | ``activo`       TINYINT(1)   NOT NULL DEFAULT 1,` | Instrucción de ejecución en el contexto del script: ``activo`       TINYINT(1)   NOT NULL DEFAULT 1,`. |
| `116` | ``fecha_creacion` TIMESTAMP  NOT NULL DEFAULT CURRENT_TIMESTAMP,` | Instrucción de ejecución en el contexto del script: ``fecha_creacion` TIMESTAMP  NOT NULL DEFAULT CURRENT_TIMESTAMP,`. |
| `117` | `PRIMARY KEY (`id_aprendiz`),` | Instrucción de ejecución en el contexto del script: `PRIMARY KEY (`id_aprendiz`),`. |
| `118` | `KEY `fk_aprendiz_ficha` (`id_ficha`),` | Instrucción de ejecución en el contexto del script: `KEY `fk_aprendiz_ficha` (`id_ficha`),`. |
| `119` | `CONSTRAINT `fk_aprendiz_ficha` FOREIGN KEY (`id_ficha`) REFERENCES `fich...` | Instrucción de ejecución en el contexto del script: `CONSTRAINT `fk_aprendiz_ficha` FOREIGN KEY (`id_ficha`) REFERENCES `fich...`. |
| `120` | `) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;` | Instrucción de ejecución en el contexto del script: `) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;`. |
| `121` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `122` | `-- -----------------------------------------------------------` | Comentario explicativo SQL: ``. |
| `123` | `-- 7. MÓDULOS` | Comentario explicativo SQL: `7. MÓDULOS`. |
| `124` | `-- -----------------------------------------------------------` | Comentario explicativo SQL: ``. |
| `125` | `CREATE TABLE IF NOT EXISTS `modulos` (` | Instrucción de ejecución en el contexto del script: `CREATE TABLE IF NOT EXISTS `modulos` (`. |
| `126` | ``id_modulo`   INT          NOT NULL AUTO_INCREMENT,` | Instrucción de ejecución en el contexto del script: ``id_modulo`   INT          NOT NULL AUTO_INCREMENT,`. |
| `127` | ``nombre`      VARCHAR(100) NOT NULL,` | Instrucción de ejecución en el contexto del script: ``nombre`      VARCHAR(100) NOT NULL,`. |
| `128` | ``ubicacion`   VARCHAR(200) DEFAULT NULL,` | Instrucción de ejecución en el contexto del script: ``ubicacion`   VARCHAR(200) DEFAULT NULL,`. |
| `129` | ``capacidad`   INT          DEFAULT NULL,` | Instrucción de ejecución en el contexto del script: ``capacidad`   INT          DEFAULT NULL,`. |
| `130` | ``descripcion` TEXT         DEFAULT NULL,` | Instrucción de ejecución en el contexto del script: ``descripcion` TEXT         DEFAULT NULL,`. |
| `131` | ``activo`      TINYINT(1)   NOT NULL DEFAULT 1,` | Instrucción de ejecución en el contexto del script: ``activo`      TINYINT(1)   NOT NULL DEFAULT 1,`. |
| `132` | ``fecha_creacion` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,` | Instrucción de ejecución en el contexto del script: ``fecha_creacion` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,`. |
| `133` | `PRIMARY KEY (`id_modulo`)` | Instrucción de ejecución en el contexto del script: `PRIMARY KEY (`id_modulo`)`. |
| `134` | `) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;` | Instrucción de ejecución en el contexto del script: `) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;`. |
| `135` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `136` | `-- -----------------------------------------------------------` | Comentario explicativo SQL: ``. |
| `137` | `-- 8. ASIGNACIONES (módulo asignado a una ficha por período)` | Comentario explicativo SQL: `8. ASIGNACIONES (módulo asignado a una ficha por período)`. |
| `138` | `-- -----------------------------------------------------------` | Comentario explicativo SQL: ``. |
| `139` | `CREATE TABLE IF NOT EXISTS `asignaciones` (` | Instrucción de ejecución en el contexto del script: `CREATE TABLE IF NOT EXISTS `asignaciones` (`. |
| `140` | ``id_asignacion`   INT          NOT NULL AUTO_INCREMENT,` | Instrucción de ejecución en el contexto del script: ``id_asignacion`   INT          NOT NULL AUTO_INCREMENT,`. |
| `141` | ``id_modulo`       INT          NOT NULL,` | Instrucción de ejecución en el contexto del script: ``id_modulo`       INT          NOT NULL,`. |
| `142` | ``id_ficha`        INT          NOT NULL,` | Instrucción de ejecución en el contexto del script: ``id_ficha`        INT          NOT NULL,`. |
| `143` | ``fecha_inicio`    DATE         NOT NULL,` | Instrucción de ejecución en el contexto del script: ``fecha_inicio`    DATE         NOT NULL,`. |
| `144` | ``fecha_fin`       DATE         NOT NULL,` | Instrucción de ejecución en el contexto del script: ``fecha_fin`       DATE         NOT NULL,`. |
| `145` | ``fecha_limite_evidencia` DATETIME NOT NULL COMMENT 'Plazo máximo para su...` | Instrucción de ejecución en el contexto del script: ``fecha_limite_evidencia` DATETIME NOT NULL COMMENT 'Plazo máximo para su...`. |
| `146` | ``estado`          ENUM('Activa','Completada','Vencida','Cancelada') NOT ...` | Instrucción de ejecución en el contexto del script: ``estado`          ENUM('Activa','Completada','Vencida','Cancelada') NOT ...`. |
| `147` | ``fecha_creacion`  TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP,` | Instrucción de ejecución en el contexto del script: ``fecha_creacion`  TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP,`. |
| `148` | `PRIMARY KEY (`id_asignacion`),` | Instrucción de ejecución en el contexto del script: `PRIMARY KEY (`id_asignacion`),`. |
| `149` | `KEY `fk_asig_modulo` (`id_modulo`),` | Instrucción de ejecución en el contexto del script: `KEY `fk_asig_modulo` (`id_modulo`),`. |
| `150` | `KEY `fk_asig_ficha`  (`id_ficha`),` | Instrucción de ejecución en el contexto del script: `KEY `fk_asig_ficha`  (`id_ficha`),`. |
| `151` | `CONSTRAINT `fk_asig_modulo` FOREIGN KEY (`id_modulo`) REFERENCES `modulo...` | Instrucción de ejecución en el contexto del script: `CONSTRAINT `fk_asig_modulo` FOREIGN KEY (`id_modulo`) REFERENCES `modulo...`. |
| `152` | `CONSTRAINT `fk_asig_ficha`  FOREIGN KEY (`id_ficha`)  REFERENCES `fichas...` | Instrucción de ejecución en el contexto del script: `CONSTRAINT `fk_asig_ficha`  FOREIGN KEY (`id_ficha`)  REFERENCES `fichas...`. |
| `153` | `) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;` | Instrucción de ejecución en el contexto del script: `) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;`. |
| `154` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `155` | `-- -----------------------------------------------------------` | Comentario explicativo SQL: ``. |
| `156` | `-- 9. GRUPOS DE LIMPIEZA` | Comentario explicativo SQL: `9. GRUPOS DE LIMPIEZA`. |
| `157` | `-- -----------------------------------------------------------` | Comentario explicativo SQL: ``. |
| `158` | `CREATE TABLE IF NOT EXISTS `grupos` (` | Instrucción de ejecución en el contexto del script: `CREATE TABLE IF NOT EXISTS `grupos` (`. |
| `159` | ``id_grupo`       INT          NOT NULL AUTO_INCREMENT,` | Instrucción de ejecución en el contexto del script: ``id_grupo`       INT          NOT NULL AUTO_INCREMENT,`. |
| `160` | ``id_asignacion`  INT          NOT NULL,` | Instrucción de ejecución en el contexto del script: ``id_asignacion`  INT          NOT NULL,`. |
| `161` | ``id_vocero`      INT          NOT NULL,` | Instrucción de ejecución en el contexto del script: ``id_vocero`      INT          NOT NULL,`. |
| `162` | ``nombre_grupo`   VARCHAR(100) NOT NULL,` | Instrucción de ejecución en el contexto del script: ``nombre_grupo`   VARCHAR(100) NOT NULL,`. |
| `163` | ``fecha_limpieza` DATE         NOT NULL,` | Instrucción de ejecución en el contexto del script: ``fecha_limpieza` DATE         NOT NULL,`. |
| `164` | ``estado`         ENUM('Activo','Completado','Sancionado') NOT NULL DEFAU...` | Instrucción de ejecución en el contexto del script: ``estado`         ENUM('Activo','Completado','Sancionado') NOT NULL DEFAU...`. |
| `165` | ``fecha_creacion` TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP,` | Instrucción de ejecución en el contexto del script: ``fecha_creacion` TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP,`. |
| `166` | ``fecha_modificacion` DATETIME DEFAULT NULL,` | Instrucción de ejecución en el contexto del script: ``fecha_modificacion` DATETIME DEFAULT NULL,`. |
| `167` | `PRIMARY KEY (`id_grupo`),` | Instrucción de ejecución en el contexto del script: `PRIMARY KEY (`id_grupo`),`. |
| `168` | `KEY `fk_grupo_asignacion` (`id_asignacion`),` | Instrucción de ejecución en el contexto del script: `KEY `fk_grupo_asignacion` (`id_asignacion`),`. |
| `169` | `KEY `fk_grupo_vocero`     (`id_vocero`),` | Instrucción de ejecución en el contexto del script: `KEY `fk_grupo_vocero`     (`id_vocero`),`. |
| `170` | `CONSTRAINT `fk_grupo_asignacion` FOREIGN KEY (`id_asignacion`) REFERENCE...` | Instrucción de ejecución en el contexto del script: `CONSTRAINT `fk_grupo_asignacion` FOREIGN KEY (`id_asignacion`) REFERENCE...`. |
| `171` | `CONSTRAINT `fk_grupo_vocero`     FOREIGN KEY (`id_vocero`)     REFERENCE...` | Instrucción de ejecución en el contexto del script: `CONSTRAINT `fk_grupo_vocero`     FOREIGN KEY (`id_vocero`)     REFERENCE...`. |
| `172` | `) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;` | Instrucción de ejecución en el contexto del script: `) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;`. |
| `173` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `174` | `-- -----------------------------------------------------------` | Comentario explicativo SQL: ``. |
| `175` | `-- 10. INTEGRANTES DEL GRUPO` | Comentario explicativo SQL: `10. INTEGRANTES DEL GRUPO`. |
| `176` | `-- -----------------------------------------------------------` | Comentario explicativo SQL: ``. |
| `177` | `CREATE TABLE IF NOT EXISTS `grupo_integrantes` (` | Instrucción de ejecución en el contexto del script: `CREATE TABLE IF NOT EXISTS `grupo_integrantes` (`. |
| `178` | ``id_integrante` INT NOT NULL AUTO_INCREMENT,` | Instrucción de ejecución en el contexto del script: ``id_integrante` INT NOT NULL AUTO_INCREMENT,`. |
| `179` | ``id_grupo`      INT NOT NULL,` | Instrucción de ejecución en el contexto del script: ``id_grupo`      INT NOT NULL,`. |
| `180` | ``id_aprendiz`   INT NOT NULL,` | Instrucción de ejecución en el contexto del script: ``id_aprendiz`   INT NOT NULL,`. |
| `181` | `PRIMARY KEY (`id_integrante`),` | Instrucción de ejecución en el contexto del script: `PRIMARY KEY (`id_integrante`),`. |
| `182` | `UNIQUE KEY `uk_grupo_aprendiz` (`id_grupo`, `id_aprendiz`),` | Instrucción de ejecución en el contexto del script: `UNIQUE KEY `uk_grupo_aprendiz` (`id_grupo`, `id_aprendiz`),`. |
| `183` | `KEY `fk_gi_grupo`    (`id_grupo`),` | Instrucción de ejecución en el contexto del script: `KEY `fk_gi_grupo`    (`id_grupo`),`. |
| `184` | `KEY `fk_gi_aprendiz` (`id_aprendiz`),` | Instrucción de ejecución en el contexto del script: `KEY `fk_gi_aprendiz` (`id_aprendiz`),`. |
| `185` | `CONSTRAINT `fk_gi_grupo`    FOREIGN KEY (`id_grupo`)    REFERENCES `grup...` | Instrucción de ejecución en el contexto del script: `CONSTRAINT `fk_gi_grupo`    FOREIGN KEY (`id_grupo`)    REFERENCES `grup...`. |
| `186` | `CONSTRAINT `fk_gi_aprendiz` FOREIGN KEY (`id_aprendiz`) REFERENCES `apre...` | Instrucción de ejecución en el contexto del script: `CONSTRAINT `fk_gi_aprendiz` FOREIGN KEY (`id_aprendiz`) REFERENCES `apre...`. |
| `187` | `) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;` | Instrucción de ejecución en el contexto del script: `) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;`. |
| `188` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `189` | `-- -----------------------------------------------------------` | Comentario explicativo SQL: ``. |
| `190` | `-- 11. EVIDENCIAS` | Comentario explicativo SQL: `11. EVIDENCIAS`. |
| `191` | `-- -----------------------------------------------------------` | Comentario explicativo SQL: ``. |
| `192` | `CREATE TABLE IF NOT EXISTS `evidencias` (` | Instrucción de ejecución en el contexto del script: `CREATE TABLE IF NOT EXISTS `evidencias` (`. |
| `193` | ``id_evidencia`   INT          NOT NULL AUTO_INCREMENT,` | Instrucción de ejecución en el contexto del script: ``id_evidencia`   INT          NOT NULL AUTO_INCREMENT,`. |
| `194` | ``id_grupo`       INT          NOT NULL,` | Instrucción de ejecución en el contexto del script: ``id_grupo`       INT          NOT NULL,`. |
| `195` | ``id_vocero`      INT          NOT NULL,` | Instrucción de ejecución en el contexto del script: ``id_vocero`      INT          NOT NULL,`. |
| `196` | ``nombre_archivo` VARCHAR(255) NOT NULL,` | Instrucción de ejecución en el contexto del script: ``nombre_archivo` VARCHAR(255) NOT NULL,`. |
| `197` | ``ruta_archivo`   VARCHAR(500) NOT NULL,` | Instrucción de ejecución en el contexto del script: ``ruta_archivo`   VARCHAR(500) NOT NULL,`. |
| `198` | ``fecha_subida`   DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP,` | Instrucción de ejecución en el contexto del script: ``fecha_subida`   DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP,`. |
| `199` | ``cumplimiento`   TINYINT(1)   NOT NULL DEFAULT 1 COMMENT '1 = evidencia ...` | Instrucción de ejecución en el contexto del script: ``cumplimiento`   TINYINT(1)   NOT NULL DEFAULT 1 COMMENT '1 = evidencia ...`. |
| `200` | `PRIMARY KEY (`id_evidencia`),` | Instrucción de ejecución en el contexto del script: `PRIMARY KEY (`id_evidencia`),`. |
| `201` | `KEY `fk_ev_grupo`   (`id_grupo`),` | Instrucción de ejecución en el contexto del script: `KEY `fk_ev_grupo`   (`id_grupo`),`. |
| `202` | `KEY `fk_ev_vocero`  (`id_vocero`),` | Instrucción de ejecución en el contexto del script: `KEY `fk_ev_vocero`  (`id_vocero`),`. |
| `203` | `CONSTRAINT `fk_ev_grupo`   FOREIGN KEY (`id_grupo`)   REFERENCES `grupos...` | Instrucción de ejecución en el contexto del script: `CONSTRAINT `fk_ev_grupo`   FOREIGN KEY (`id_grupo`)   REFERENCES `grupos...`. |
| `204` | `CONSTRAINT `fk_ev_vocero`  FOREIGN KEY (`id_vocero`)  REFERENCES `vocero...` | Instrucción de ejecución en el contexto del script: `CONSTRAINT `fk_ev_vocero`  FOREIGN KEY (`id_vocero`)  REFERENCES `vocero...`. |
| `205` | `) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;` | Instrucción de ejecución en el contexto del script: `) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;`. |
| `206` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `207` | `-- -----------------------------------------------------------` | Comentario explicativo SQL: ``. |
| `208` | `-- 12. HISTORIAL DE MODIFICACIONES DE GRUPOS` | Comentario explicativo SQL: `12. HISTORIAL DE MODIFICACIONES DE GRUPOS`. |
| `209` | `-- -----------------------------------------------------------` | Comentario explicativo SQL: ``. |
| `210` | `CREATE TABLE IF NOT EXISTS `historial_grupos` (` | Instrucción de ejecución en el contexto del script: `CREATE TABLE IF NOT EXISTS `historial_grupos` (`. |
| `211` | ``id_historial`  INT          NOT NULL AUTO_INCREMENT,` | Instrucción de ejecución en el contexto del script: ``id_historial`  INT          NOT NULL AUTO_INCREMENT,`. |
| `212` | ``id_grupo`      INT          NOT NULL,` | Instrucción de ejecución en el contexto del script: ``id_grupo`      INT          NOT NULL,`. |
| `213` | ``descripcion`   TEXT         NOT NULL,` | Instrucción de ejecución en el contexto del script: ``descripcion`   TEXT         NOT NULL,`. |
| `214` | ``fecha`         DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP,` | Instrucción de ejecución en el contexto del script: ``fecha`         DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP,`. |
| `215` | ``id_usuario`    INT          DEFAULT NULL,` | Instrucción de ejecución en el contexto del script: ``id_usuario`    INT          DEFAULT NULL,`. |
| `216` | `PRIMARY KEY (`id_historial`),` | Instrucción de ejecución en el contexto del script: `PRIMARY KEY (`id_historial`),`. |
| `217` | `KEY `fk_hg_grupo`   (`id_grupo`),` | Instrucción de ejecución en el contexto del script: `KEY `fk_hg_grupo`   (`id_grupo`),`. |
| `218` | `KEY `fk_hg_usuario` (`id_usuario`),` | Instrucción de ejecución en el contexto del script: `KEY `fk_hg_usuario` (`id_usuario`),`. |
| `219` | `CONSTRAINT `fk_hg_grupo`   FOREIGN KEY (`id_grupo`)   REFERENCES `grupos...` | Instrucción de ejecución en el contexto del script: `CONSTRAINT `fk_hg_grupo`   FOREIGN KEY (`id_grupo`)   REFERENCES `grupos...`. |
| `220` | `CONSTRAINT `fk_hg_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuari...` | Instrucción de ejecución en el contexto del script: `CONSTRAINT `fk_hg_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuari...`. |
| `221` | `) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;` | Instrucción de ejecución en el contexto del script: `) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;`. |
| `222` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `223` | `-- -----------------------------------------------------------` | Comentario explicativo SQL: ``. |
| `224` | `-- 13. NOTIFICACIONES` | Comentario explicativo SQL: `13. NOTIFICACIONES`. |
| `225` | `-- -----------------------------------------------------------` | Comentario explicativo SQL: ``. |
| `226` | `CREATE TABLE IF NOT EXISTS `notificaciones` (` | Instrucción de ejecución en el contexto del script: `CREATE TABLE IF NOT EXISTS `notificaciones` (`. |
| `227` | ``id_notificacion` INT          NOT NULL AUTO_INCREMENT,` | Instrucción de ejecución en el contexto del script: ``id_notificacion` INT          NOT NULL AUTO_INCREMENT,`. |
| `228` | ``id_usuario`      INT          NOT NULL COMMENT 'Destinatario',` | Instrucción de ejecución en el contexto del script: ``id_usuario`      INT          NOT NULL COMMENT 'Destinatario',`. |
| `229` | ``id_asignacion`   INT          DEFAULT NULL,` | Instrucción de ejecución en el contexto del script: ``id_asignacion`   INT          DEFAULT NULL,`. |
| `230` | ``tipo`            ENUM('incumplimiento','credenciales','recordatorio','i...` | Instrucción de ejecución en el contexto del script: ``tipo`            ENUM('incumplimiento','credenciales','recordatorio','i...`. |
| `231` | ``titulo`          VARCHAR(200) NOT NULL,` | Instrucción de ejecución en el contexto del script: ``titulo`          VARCHAR(200) NOT NULL,`. |
| `232` | ``mensaje`         TEXT         NOT NULL,` | Instrucción de ejecución en el contexto del script: ``mensaje`         TEXT         NOT NULL,`. |
| `233` | ``leida`           TINYINT(1)   NOT NULL DEFAULT 0,` | Instrucción de ejecución en el contexto del script: ``leida`           TINYINT(1)   NOT NULL DEFAULT 0,`. |
| `234` | ``fecha`           DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP,` | Instrucción de ejecución en el contexto del script: ``fecha`           DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP,`. |
| `235` | `PRIMARY KEY (`id_notificacion`),` | Instrucción de ejecución en el contexto del script: `PRIMARY KEY (`id_notificacion`),`. |
| `236` | `KEY `fk_noti_usuario`    (`id_usuario`),` | Instrucción de ejecución en el contexto del script: `KEY `fk_noti_usuario`    (`id_usuario`),`. |
| `237` | `KEY `fk_noti_asignacion` (`id_asignacion`),` | Instrucción de ejecución en el contexto del script: `KEY `fk_noti_asignacion` (`id_asignacion`),`. |
| `238` | `CONSTRAINT `fk_noti_usuario`    FOREIGN KEY (`id_usuario`)    REFERENCES...` | Instrucción de ejecución en el contexto del script: `CONSTRAINT `fk_noti_usuario`    FOREIGN KEY (`id_usuario`)    REFERENCES...`. |
| `239` | `CONSTRAINT `fk_noti_asignacion` FOREIGN KEY (`id_asignacion`) REFERENCES...` | Instrucción de ejecución en el contexto del script: `CONSTRAINT `fk_noti_asignacion` FOREIGN KEY (`id_asignacion`) REFERENCES...`. |
| `240` | `) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;` | Instrucción de ejecución en el contexto del script: `) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;`. |
| `241` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `242` | `-- -----------------------------------------------------------` | Comentario explicativo SQL: ``. |
| `243` | `-- 14. LOG DE SINCRONIZACIÓN CON SICEFA` | Comentario explicativo SQL: `14. LOG DE SINCRONIZACIÓN CON SICEFA`. |
| `244` | `-- -----------------------------------------------------------` | Comentario explicativo SQL: ``. |
| `245` | `CREATE TABLE IF NOT EXISTS `log_sincronizacion` (` | Instrucción de ejecución en el contexto del script: `CREATE TABLE IF NOT EXISTS `log_sincronizacion` (`. |
| `246` | ``id_log`          INT       NOT NULL AUTO_INCREMENT,` | Instrucción de ejecución en el contexto del script: ``id_log`          INT       NOT NULL AUTO_INCREMENT,`. |
| `247` | ``fecha`           DATETIME  NOT NULL DEFAULT CURRENT_TIMESTAMP,` | Instrucción de ejecución en el contexto del script: ``fecha`           DATETIME  NOT NULL DEFAULT CURRENT_TIMESTAMP,`. |
| `248` | ``estado`          ENUM('exitoso','fallido','parcial') NOT NULL DEFAULT '...` | Instrucción de ejecución en el contexto del script: ``estado`          ENUM('exitoso','fallido','parcial') NOT NULL DEFAULT '...`. |
| `249` | ``aprendices_sync` INT       DEFAULT 0,` | Instrucción de ejecución en el contexto del script: ``aprendices_sync` INT       DEFAULT 0,`. |
| `250` | ``voceros_creados` INT       DEFAULT 0,` | Instrucción de ejecución en el contexto del script: ``voceros_creados` INT       DEFAULT 0,`. |
| `251` | ``correos_enviados` INT      DEFAULT 0,` | Instrucción de ejecución en el contexto del script: ``correos_enviados` INT      DEFAULT 0,`. |
| `252` | ``detalle_error`   TEXT      DEFAULT NULL,` | Instrucción de ejecución en el contexto del script: ``detalle_error`   TEXT      DEFAULT NULL,`. |
| `253` | `PRIMARY KEY (`id_log`)` | Instrucción de ejecución en el contexto del script: `PRIMARY KEY (`id_log`)`. |
| `254` | `) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;` | Instrucción de ejecución en el contexto del script: `) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;`. |
| `255` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `256` | `SET FOREIGN_KEY_CHECKS = 1;` | Instrucción de ejecución en el contexto del script: `SET FOREIGN_KEY_CHECKS = 1;`. |

---

## 3. Resumen y Flujo de Interacción

El archivo `gestion_limpieza.sql` cumple un rol indispensable en `sql/gestion_limpieza.sql`. 
Script maestro de creación de la base de datos completa gestion_limpieza (tablas, relaciones foráneas, vistas e inserciones semilla). Garantiza la robustez, el orden y la estabilidad de la arquitectura del proyecto `systemLimpieza`.

---

Generado automáticamente para el repositorio [johanrepizo/LimpiezaDeModulos](https://github.com/johanrepizo/LimpiezaDeModulos).
