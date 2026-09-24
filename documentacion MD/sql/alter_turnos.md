# Documentación Línea por Línea: `sql/alter_turnos.sql`

## 1. Ficha Técnica del Archivo

- **Archivo:** `alter_turnos.sql`
- **Ruta en el proyecto:** `sql/alter_turnos.sql`
- **Cantidad total de líneas:** `34`
- **Tipo de archivo:** `SQL`
- **Propósito general:** Script SQL de modificación DDL para añadir columnas y restricciones de turnos de limpieza.

---

## 2. Explicación Detallada Línea por Línea

A continuación se presenta cada línea de código numerada de forma consecutiva, acompañada de su fragmento exacto y la explicación exhaustiva de su funcionamiento y responsabilidad en el sistema:

| Línea | Código Fuente | Explicación Detallada |
|---|---|---|
| `1` | `SET NAMES utf8mb4;` | Definición de columna, tipo de dato o restricción SQL: `SET NAMES utf8mb4;`. |
| `2` | `SET FOREIGN_KEY_CHECKS = 0;` | Definición de columna, tipo de dato o restricción SQL: `SET FOREIGN_KEY_CHECKS = 0;`. |
| `3` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `4` | `ALTER TABLE 'asignaciones'` | Modifica la estructura de una tabla existente: `ALTER TABLE `asignaciones``. |
| `5` | `    ADD COLUMN IF NOT EXISTS 'dia_semana' TINYINT(1) NOT NULL DEFAULT 0` | Definición de columna, tipo de dato o restricción SQL: `ADD COLUMN IF NOT EXISTS `dia_semana` TINYINT(1) NOT NULL DEFAULT 0`. |
| `6` | `        COMMENT '0=Dom,1=Lun,2=Mar,3=Mie,4=Jue,5=Vie,6=Sab'` | Definición de columna, tipo de dato o restricción SQL: `COMMENT '0=Dom,1=Lun,2=Mar,3=Mie,4=Jue,5=Vie,6=Sab'`. |
| `7` | `        AFTER 'fecha_fin';` | Definición de columna, tipo de dato o restricción SQL: `AFTER `fecha_fin`;`. |
| `8` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `9` | `UPDATE 'asignaciones'` | Definición de columna, tipo de dato o restricción SQL: `UPDATE `asignaciones``. |
| `10` | `SET 'dia_semana' = DAYOFWEEK('fecha_inicio') - 1` | Definición de columna, tipo de dato o restricción SQL: `SET `dia_semana` = DAYOFWEEK(`fecha_inicio`) - 1`. |
| `11` | `WHERE 'fecha_inicio' IS NOT NULL;` | Definición de columna, tipo de dato o restricción SQL: `WHERE `fecha_inicio` IS NOT NULL;`. |
| `12` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `13` | `CREATE TABLE IF NOT EXISTS 'turnos' (` | Declaración de creación de la tabla: `CREATE TABLE IF NOT EXISTS `turnos` (`. |
| `14` | `  'id_turno'       INT      NOT NULL AUTO_INCREMENT,` | Definición de columna, tipo de dato o restricción SQL: ``id_turno`       INT      NOT NULL AUTO_INCREMENT,`. |
| `15` | `  'id_asignacion'  INT      NOT NULL,` | Definición de columna, tipo de dato o restricción SQL: ``id_asignacion`  INT      NOT NULL,`. |
| `16` | `  'id_grupo'       INT      DEFAULT NULL,` | Definición de columna, tipo de dato o restricción SQL: ``id_grupo`       INT      DEFAULT NULL,`. |
| `17` | `  'fecha_turno'    DATE     NOT NULL,` | Definición de columna, tipo de dato o restricción SQL: ``fecha_turno`    DATE     NOT NULL,`. |
| `18` | `  'fecha_apertura' DATETIME NOT NULL,` | Definición de columna, tipo de dato o restricción SQL: ``fecha_apertura` DATETIME NOT NULL,`. |
| `19` | `  'fecha_cierre'   DATETIME NOT NULL,` | Definición de columna, tipo de dato o restricción SQL: ``fecha_cierre`   DATETIME NOT NULL,`. |
| `20` | `  'estado'         ENUM('Pendiente','Abierto','Cerrado','Cumplido','Incumpl...` | Definición de columna, tipo de dato o restricción SQL: ``estado`         ENUM('Pendiente','Abierto','Cerrado','Cumplido','Incumplido') NOT NULL DEFAULT 'Pendiente',`. |
| `21` | `  'fecha_creacion' TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,` | Definición de columna, tipo de dato o restricción SQL: ``fecha_creacion` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,`. |
| `22` | `  PRIMARY KEY ('id_turno'),` | Define la clave primaria única para indexación e identificación de los registros. |
| `23` | `  UNIQUE KEY 'uk_turno_asig_fecha' ('id_asignacion', 'fecha_turno'),` | Definición de columna, tipo de dato o restricción SQL: `UNIQUE KEY `uk_turno_asig_fecha` (`id_asignacion`, `fecha_turno`),`. |
| `24` | `  KEY 'fk_turno_asig'  ('id_asignacion'),` | Definición de columna, tipo de dato o restricción SQL: `KEY `fk_turno_asig`  (`id_asignacion`),`. |
| `25` | `  KEY 'fk_turno_grupo' ('id_grupo'),` | Definición de columna, tipo de dato o restricción SQL: `KEY `fk_turno_grupo` (`id_grupo`),`. |
| `26` | `  CONSTRAINT 'fk_turno_asig'  FOREIGN KEY ('id_asignacion') REFERENCES 'asi...` | Define una relación de clave foránea con integridad referencial: `CONSTRAINT `fk_turno_asig`  FOREIGN KEY (`id_asignacion`) REFERENCES `asignaciones` (`id_asignacion`) ON DELETE CASCADE,`. |
| `27` | `  CONSTRAINT 'fk_turno_grupo' FOREIGN KEY ('id_grupo')      REFERENCES 'gru...` | Define una relación de clave foránea con integridad referencial: `CONSTRAINT `fk_turno_grupo` FOREIGN KEY (`id_grupo`)      REFERENCES `grupos`        (`id_grupo`)      ON DELETE SET NULL`. |
| `28` | `) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;` | Definición de columna, tipo de dato o restricción SQL: `) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;`. |
| `29` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `30` | `ALTER TABLE 'evidencias'` | Modifica la estructura de una tabla existente: `ALTER TABLE `evidencias``. |
| `31` | `    ADD COLUMN IF NOT EXISTS 'id_turno' INT DEFAULT NULL AFTER 'id_vocero',` | Definición de columna, tipo de dato o restricción SQL: `ADD COLUMN IF NOT EXISTS `id_turno` INT DEFAULT NULL AFTER `id_vocero`,`. |
| `32` | `    ADD COLUMN IF NOT EXISTS 'observaciones' TEXT DEFAULT NULL AFTER 'ruta_...` | Definición de columna, tipo de dato o restricción SQL: `ADD COLUMN IF NOT EXISTS `observaciones` TEXT DEFAULT NULL AFTER `ruta_archivo`;`. |
| `33` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `34` | `SET FOREIGN_KEY_CHECKS = 1;` | Definición de columna, tipo de dato o restricción SQL: `SET FOREIGN_KEY_CHECKS = 1;`. |

---

## 3. Resumen y Flujo de Interacción

El archivo `alter_turnos.sql` cumple un rol indispensable en `sql/alter_turnos.sql`. 
Script SQL de modificación DDL para añadir columnas y restricciones de turnos de limpieza. Garantiza la robustez, el orden y la estabilidad de la arquitectura del proyecto `systemLimpieza`.
