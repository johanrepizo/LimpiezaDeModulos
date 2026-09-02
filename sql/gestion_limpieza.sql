-- ============================================================
-- Base de datos: gestion_limpieza
-- Sistema de Gestión de Limpieza de Módulos – SENA/SICEFA
-- Charset: utf8mb4
-- ============================================================

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- -----------------------------------------------------------
-- 1. ROLES
-- -----------------------------------------------------------
CREATE TABLE IF NOT EXISTS `roles` (
  `id_rol`     INT         NOT NULL AUTO_INCREMENT,
  `nombre_rol` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`id_rol`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT IGNORE INTO `roles` (`id_rol`, `nombre_rol`) VALUES
  (1, 'Administrador'),
  (2, 'Vocero');

-- -----------------------------------------------------------
-- 2. USUARIOS
-- -----------------------------------------------------------
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id_usuario`        INT          NOT NULL AUTO_INCREMENT,
  `id_rol`            INT          NOT NULL DEFAULT 2,
  `nombres`           VARCHAR(100) NOT NULL,
  `apellidos`         VARCHAR(100) NOT NULL,
  `documento`         VARCHAR(30)  DEFAULT NULL,
  `celular`           VARCHAR(20)  DEFAULT NULL,
  `correo`            VARCHAR(120) NOT NULL,
  `password`          VARCHAR(255) NOT NULL,
  `activo`            TINYINT(1)   NOT NULL DEFAULT 1,
  `primer_acceso`     TINYINT(1)   NOT NULL DEFAULT 1 COMMENT '1 = debe cambiar contraseña al primer login',
  `intentos_fallidos` INT          NOT NULL DEFAULT 0,
  `bloqueado_hasta`   DATETIME     DEFAULT NULL,
  `fecha_creacion`    TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_usuario`),
  UNIQUE KEY `uk_correo`    (`correo`),
  KEY `fk_usuarios_rol` (`id_rol`),
  CONSTRAINT `fk_usuarios_rol` FOREIGN KEY (`id_rol`) REFERENCES `roles` (`id_rol`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Admin por defecto (password: Admin2024!)
INSERT IGNORE INTO `usuarios`
  (`id_usuario`, `id_rol`, `nombres`, `apellidos`, `correo`, `password`, `primer_acceso`)
VALUES
  (1, 1, 'Administrador', 'Sistema', 'admin@sena.edu.co',
   '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 0);

-- -----------------------------------------------------------
-- 3. PROGRAMAS DE FORMACIÓN
-- -----------------------------------------------------------
CREATE TABLE IF NOT EXISTS `programas` (
  `id_programa`  INT          NOT NULL AUTO_INCREMENT,
  `nombre`       VARCHAR(200) NOT NULL,
  `descripcion`  TEXT         DEFAULT NULL,
  `nivel`        VARCHAR(50)  DEFAULT NULL COMMENT 'Técnico, Tecnólogo, Especialización, etc.',
  `activo`       TINYINT(1)   NOT NULL DEFAULT 1,
  `fecha_creacion` TIMESTAMP  NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_programa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- -----------------------------------------------------------
-- 4. FICHAS
-- -----------------------------------------------------------
CREATE TABLE IF NOT EXISTS `fichas` (
  `id_ficha`          INT          NOT NULL AUTO_INCREMENT,
  `id_programa`       INT          NOT NULL,
  `numero_ficha`      VARCHAR(20)  NOT NULL,
  `jornada`           ENUM('Diurna','Nocturna','Mixta') NOT NULL DEFAULT 'Diurna',
  `num_aprendices`    INT          DEFAULT NULL,
  `activo`            TINYINT(1)   NOT NULL DEFAULT 1,
  `fecha_creacion`    TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_ficha`),
  UNIQUE KEY `uk_ficha_programa` (`numero_ficha`, `id_programa`),
  KEY `fk_ficha_programa` (`id_programa`),
  CONSTRAINT `fk_ficha_programa` FOREIGN KEY (`id_programa`) REFERENCES `programas` (`id_programa`) ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- -----------------------------------------------------------
-- 5. VOCEROS (aprendices con rol de vocero, sincronizados de SICEFA)
-- -----------------------------------------------------------
CREATE TABLE IF NOT EXISTS `voceros` (
  `id_vocero`   INT          NOT NULL AUTO_INCREMENT,
  `id_usuario`  INT          NOT NULL,
  `id_ficha`    INT          NOT NULL,
  `nombres`     VARCHAR(100) NOT NULL,
  `apellidos`   VARCHAR(100) NOT NULL,
  `documento`   VARCHAR(30)  DEFAULT NULL,
  `celular`     VARCHAR(20)  DEFAULT NULL,
  `correo`      VARCHAR(120) NOT NULL,
  `activo`      TINYINT(1)   NOT NULL DEFAULT 1,
  `fecha_creacion` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_vocero`),
  KEY `fk_vocero_usuario` (`id_usuario`),
  KEY `fk_vocero_ficha`   (`id_ficha`),
  CONSTRAINT `fk_vocero_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE,
  CONSTRAINT `fk_vocero_ficha`   FOREIGN KEY (`id_ficha`)   REFERENCES `fichas`   (`id_ficha`)   ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- -----------------------------------------------------------
-- 6. APRENDICES (sincronizados de SICEFA, pertenecen a una ficha)
-- -----------------------------------------------------------
CREATE TABLE IF NOT EXISTS `aprendices` (
  `id_aprendiz`  INT          NOT NULL AUTO_INCREMENT,
  `id_ficha`     INT          NOT NULL,
  `nombres`      VARCHAR(100) NOT NULL,
  `apellidos`    VARCHAR(100) NOT NULL,
  `documento`    VARCHAR(30)  DEFAULT NULL,
  `celular`      VARCHAR(20)  DEFAULT NULL,
  `correo`       VARCHAR(120) DEFAULT NULL,
  `activo`       TINYINT(1)   NOT NULL DEFAULT 1,
  `fecha_creacion` TIMESTAMP  NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_aprendiz`),
  KEY `fk_aprendiz_ficha` (`id_ficha`),
  CONSTRAINT `fk_aprendiz_ficha` FOREIGN KEY (`id_ficha`) REFERENCES `fichas` (`id_ficha`) ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- -----------------------------------------------------------
-- 7. MÓDULOS
-- -----------------------------------------------------------
CREATE TABLE IF NOT EXISTS `modulos` (
  `id_modulo`   INT          NOT NULL AUTO_INCREMENT,
  `nombre`      VARCHAR(100) NOT NULL,
  `ubicacion`   VARCHAR(200) DEFAULT NULL,
  `capacidad`   INT          DEFAULT NULL,
  `descripcion` TEXT         DEFAULT NULL,
  `activo`      TINYINT(1)   NOT NULL DEFAULT 1,
  `fecha_creacion` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_modulo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- -----------------------------------------------------------
-- 8. ASIGNACIONES (módulo asignado a una ficha por período)
-- -----------------------------------------------------------
CREATE TABLE IF NOT EXISTS `asignaciones` (
  `id_asignacion`   INT          NOT NULL AUTO_INCREMENT,
  `id_modulo`       INT          NOT NULL,
  `id_ficha`        INT          NOT NULL,
  `fecha_inicio`    DATE         NOT NULL,
  `fecha_fin`       DATE         NOT NULL,
  `fecha_limite_evidencia` DATETIME NOT NULL COMMENT 'Plazo máximo para subir evidencia',
  `estado`          ENUM('Activa','Completada','Vencida','Cancelada') NOT NULL DEFAULT 'Activa',
  `fecha_creacion`  TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_asignacion`),
  KEY `fk_asig_modulo` (`id_modulo`),
  KEY `fk_asig_ficha`  (`id_ficha`),
  CONSTRAINT `fk_asig_modulo` FOREIGN KEY (`id_modulo`) REFERENCES `modulos` (`id_modulo`) ON DELETE RESTRICT,
  CONSTRAINT `fk_asig_ficha`  FOREIGN KEY (`id_ficha`)  REFERENCES `fichas`  (`id_ficha`)  ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- -----------------------------------------------------------
-- 9. GRUPOS DE LIMPIEZA
-- -----------------------------------------------------------
CREATE TABLE IF NOT EXISTS `grupos` (
  `id_grupo`       INT          NOT NULL AUTO_INCREMENT,
  `id_asignacion`  INT          NOT NULL,
  `id_vocero`      INT          NOT NULL,
  `nombre_grupo`   VARCHAR(100) NOT NULL,
  `fecha_limpieza` DATE         NOT NULL,
  `estado`         ENUM('Activo','Completado','Sancionado') NOT NULL DEFAULT 'Activo',
  `fecha_creacion` TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fecha_modificacion` DATETIME DEFAULT NULL,
  PRIMARY KEY (`id_grupo`),
  KEY `fk_grupo_asignacion` (`id_asignacion`),
  KEY `fk_grupo_vocero`     (`id_vocero`),
  CONSTRAINT `fk_grupo_asignacion` FOREIGN KEY (`id_asignacion`) REFERENCES `asignaciones` (`id_asignacion`) ON DELETE RESTRICT,
  CONSTRAINT `fk_grupo_vocero`     FOREIGN KEY (`id_vocero`)     REFERENCES `voceros`       (`id_vocero`)     ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- -----------------------------------------------------------
-- 10. INTEGRANTES DEL GRUPO
-- -----------------------------------------------------------
CREATE TABLE IF NOT EXISTS `grupo_integrantes` (
  `id_integrante` INT NOT NULL AUTO_INCREMENT,
  `id_grupo`      INT NOT NULL,
  `id_aprendiz`   INT NOT NULL,
  PRIMARY KEY (`id_integrante`),
  UNIQUE KEY `uk_grupo_aprendiz` (`id_grupo`, `id_aprendiz`),
  KEY `fk_gi_grupo`    (`id_grupo`),
  KEY `fk_gi_aprendiz` (`id_aprendiz`),
  CONSTRAINT `fk_gi_grupo`    FOREIGN KEY (`id_grupo`)    REFERENCES `grupos`    (`id_grupo`)    ON DELETE CASCADE,
  CONSTRAINT `fk_gi_aprendiz` FOREIGN KEY (`id_aprendiz`) REFERENCES `aprendices`(`id_aprendiz`) ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- -----------------------------------------------------------
-- 11. EVIDENCIAS
-- -----------------------------------------------------------
CREATE TABLE IF NOT EXISTS `evidencias` (
  `id_evidencia`   INT          NOT NULL AUTO_INCREMENT,
  `id_grupo`       INT          NOT NULL,
  `id_vocero`      INT          NOT NULL,
  `nombre_archivo` VARCHAR(255) NOT NULL,
  `ruta_archivo`   VARCHAR(500) NOT NULL,
  `fecha_subida`   DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `cumplimiento`   TINYINT(1)   NOT NULL DEFAULT 1 COMMENT '1 = evidencia entregada ✓',
  PRIMARY KEY (`id_evidencia`),
  KEY `fk_ev_grupo`   (`id_grupo`),
  KEY `fk_ev_vocero`  (`id_vocero`),
  CONSTRAINT `fk_ev_grupo`   FOREIGN KEY (`id_grupo`)   REFERENCES `grupos`   (`id_grupo`)   ON DELETE RESTRICT,
  CONSTRAINT `fk_ev_vocero`  FOREIGN KEY (`id_vocero`)  REFERENCES `voceros`  (`id_vocero`)  ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- -----------------------------------------------------------
-- 12. HISTORIAL DE MODIFICACIONES DE GRUPOS
-- -----------------------------------------------------------
CREATE TABLE IF NOT EXISTS `historial_grupos` (
  `id_historial`  INT          NOT NULL AUTO_INCREMENT,
  `id_grupo`      INT          NOT NULL,
  `descripcion`   TEXT         NOT NULL,
  `fecha`         DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_usuario`    INT          DEFAULT NULL,
  PRIMARY KEY (`id_historial`),
  KEY `fk_hg_grupo`   (`id_grupo`),
  KEY `fk_hg_usuario` (`id_usuario`),
  CONSTRAINT `fk_hg_grupo`   FOREIGN KEY (`id_grupo`)   REFERENCES `grupos`   (`id_grupo`)   ON DELETE CASCADE,
  CONSTRAINT `fk_hg_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- -----------------------------------------------------------
-- 13. NOTIFICACIONES
-- -----------------------------------------------------------
CREATE TABLE IF NOT EXISTS `notificaciones` (
  `id_notificacion` INT          NOT NULL AUTO_INCREMENT,
  `id_usuario`      INT          NOT NULL COMMENT 'Destinatario',
  `id_asignacion`   INT          DEFAULT NULL,
  `tipo`            ENUM('incumplimiento','credenciales','recordatorio','info') NOT NULL DEFAULT 'info',
  `titulo`          VARCHAR(200) NOT NULL,
  `mensaje`         TEXT         NOT NULL,
  `leida`           TINYINT(1)   NOT NULL DEFAULT 0,
  `fecha`           DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_notificacion`),
  KEY `fk_noti_usuario`    (`id_usuario`),
  KEY `fk_noti_asignacion` (`id_asignacion`),
  CONSTRAINT `fk_noti_usuario`    FOREIGN KEY (`id_usuario`)    REFERENCES `usuarios`     (`id_usuario`)    ON DELETE CASCADE,
  CONSTRAINT `fk_noti_asignacion` FOREIGN KEY (`id_asignacion`) REFERENCES `asignaciones` (`id_asignacion`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- -----------------------------------------------------------
-- 14. LOG DE SINCRONIZACIÓN CON SICEFA
-- -----------------------------------------------------------
CREATE TABLE IF NOT EXISTS `log_sincronizacion` (
  `id_log`          INT       NOT NULL AUTO_INCREMENT,
  `fecha`           DATETIME  NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `estado`          ENUM('exitoso','fallido','parcial') NOT NULL DEFAULT 'exitoso',
  `aprendices_sync` INT       DEFAULT 0,
  `voceros_creados` INT       DEFAULT 0,
  `correos_enviados` INT      DEFAULT 0,
  `detalle_error`   TEXT      DEFAULT NULL,
  PRIMARY KEY (`id_log`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

SET FOREIGN_KEY_CHECKS = 1;
