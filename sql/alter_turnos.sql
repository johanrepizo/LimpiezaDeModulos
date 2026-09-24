SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

ALTER TABLE `asignaciones`
    ADD COLUMN IF NOT EXISTS `dia_semana` TINYINT(1) NOT NULL DEFAULT 0
        COMMENT '0=Dom,1=Lun,2=Mar,3=Mie,4=Jue,5=Vie,6=Sab'
        AFTER `fecha_fin`;

UPDATE `asignaciones`
SET `dia_semana` = DAYOFWEEK(`fecha_inicio`) - 1
WHERE `fecha_inicio` IS NOT NULL;

CREATE TABLE IF NOT EXISTS `turnos` (
  `id_turno`       INT      NOT NULL AUTO_INCREMENT,
  `id_asignacion`  INT      NOT NULL,
  `id_grupo`       INT      DEFAULT NULL,
  `fecha_turno`    DATE     NOT NULL,
  `fecha_apertura` DATETIME NOT NULL,
  `fecha_cierre`   DATETIME NOT NULL,
  `estado`         ENUM('Pendiente','Abierto','Cerrado','Cumplido','Incumplido') NOT NULL DEFAULT 'Pendiente',
  `fecha_creacion` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_turno`),
  UNIQUE KEY `uk_turno_asig_fecha` (`id_asignacion`, `fecha_turno`),
  KEY `fk_turno_asig`  (`id_asignacion`),
  KEY `fk_turno_grupo` (`id_grupo`),
  CONSTRAINT `fk_turno_asig`  FOREIGN KEY (`id_asignacion`) REFERENCES `asignaciones` (`id_asignacion`) ON DELETE CASCADE,
  CONSTRAINT `fk_turno_grupo` FOREIGN KEY (`id_grupo`)      REFERENCES `grupos`        (`id_grupo`)      ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

ALTER TABLE `evidencias`
    ADD COLUMN IF NOT EXISTS `id_turno` INT DEFAULT NULL AFTER `id_vocero`,
    ADD COLUMN IF NOT EXISTS `observaciones` TEXT DEFAULT NULL AFTER `ruta_archivo`;

SET FOREIGN_KEY_CHECKS = 1;
