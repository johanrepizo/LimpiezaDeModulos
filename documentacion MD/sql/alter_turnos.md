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
| `1` | `SET NAMES utf8mb4;` | Instrucción de ejecución en el contexto del script: `SET NAMES utf8mb4;`. |
| `2` | `SET FOREIGN_KEY_CHECKS = 0;` | Instrucción de ejecución en el contexto del script: `SET FOREIGN_KEY_CHECKS = 0;`. |
| `3` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `4` | `ALTER TABLE `asignaciones`` | Instrucción de ejecución en el contexto del script: `ALTER TABLE `asignaciones``. |
| `5` | `ADD COLUMN IF NOT EXISTS `dia_semana` TINYINT(1) NOT NULL DEFAULT 0` | Instrucción de ejecución en el contexto del script: `ADD COLUMN IF NOT EXISTS `dia_semana` TINYINT(1) NOT NULL DEFAULT 0`. |
| `6` | `COMMENT '0=Dom,1=Lun,2=Mar,3=Mie,4=Jue,5=Vie,6=Sab'` | Instrucción de ejecución en el contexto del script: `COMMENT '0=Dom,1=Lun,2=Mar,3=Mie,4=Jue,5=Vie,6=Sab'`. |
| `7` | `AFTER `fecha_fin`;` | Instrucción de ejecución en el contexto del script: `AFTER `fecha_fin`;`. |
| `8` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `9` | `UPDATE `asignaciones`` | Instrucción de ejecución en el contexto del script: `UPDATE `asignaciones``. |
| `10` | `SET `dia_semana` = DAYOFWEEK(`fecha_inicio`) - 1` | Instrucción de ejecución en el contexto del script: `SET `dia_semana` = DAYOFWEEK(`fecha_inicio`) - 1`. |
| `11` | `WHERE `fecha_inicio` IS NOT NULL;` | Instrucción de ejecución en el contexto del script: `WHERE `fecha_inicio` IS NOT NULL;`. |
| `12` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `13` | `CREATE TABLE IF NOT EXISTS `turnos` (` | Instrucción de ejecución en el contexto del script: `CREATE TABLE IF NOT EXISTS `turnos` (`. |
| `14` | ``id_turno`       INT      NOT NULL AUTO_INCREMENT,` | Instrucción de ejecución en el contexto del script: ``id_turno`       INT      NOT NULL AUTO_INCREMENT,`. |
| `15` | ``id_asignacion`  INT      NOT NULL,` | Instrucción de ejecución en el contexto del script: ``id_asignacion`  INT      NOT NULL,`. |
| `16` | ``id_grupo`       INT      DEFAULT NULL,` | Instrucción de ejecución en el contexto del script: ``id_grupo`       INT      DEFAULT NULL,`. |
| `17` | ``fecha_turno`    DATE     NOT NULL,` | Instrucción de ejecución en el contexto del script: ``fecha_turno`    DATE     NOT NULL,`. |
| `18` | ``fecha_apertura` DATETIME NOT NULL,` | Instrucción de ejecución en el contexto del script: ``fecha_apertura` DATETIME NOT NULL,`. |
| `19` | ``fecha_cierre`   DATETIME NOT NULL,` | Instrucción de ejecución en el contexto del script: ``fecha_cierre`   DATETIME NOT NULL,`. |
| `20` | ``estado`         ENUM('Pendiente','Abierto','Cerrado','Cumplido','Incump...` | Instrucción de ejecución en el contexto del script: ``estado`         ENUM('Pendiente','Abierto','Cerrado','Cumplido','Incump...`. |
| `21` | ``fecha_creacion` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,` | Instrucción de ejecución en el contexto del script: ``fecha_creacion` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,`. |
| `22` | `PRIMARY KEY (`id_turno`),` | Instrucción de ejecución en el contexto del script: `PRIMARY KEY (`id_turno`),`. |
| `23` | `UNIQUE KEY `uk_turno_asig_fecha` (`id_asignacion`, `fecha_turno`),` | Instrucción de ejecución en el contexto del script: `UNIQUE KEY `uk_turno_asig_fecha` (`id_asignacion`, `fecha_turno`),`. |
| `24` | `KEY `fk_turno_asig`  (`id_asignacion`),` | Instrucción de ejecución en el contexto del script: `KEY `fk_turno_asig`  (`id_asignacion`),`. |
| `25` | `KEY `fk_turno_grupo` (`id_grupo`),` | Instrucción de ejecución en el contexto del script: `KEY `fk_turno_grupo` (`id_grupo`),`. |
| `26` | `CONSTRAINT `fk_turno_asig`  FOREIGN KEY (`id_asignacion`) REFERENCES `as...` | Instrucción de ejecución en el contexto del script: `CONSTRAINT `fk_turno_asig`  FOREIGN KEY (`id_asignacion`) REFERENCES `as...`. |
| `27` | `CONSTRAINT `fk_turno_grupo` FOREIGN KEY (`id_grupo`)      REFERENCES `gr...` | Instrucción de ejecución en el contexto del script: `CONSTRAINT `fk_turno_grupo` FOREIGN KEY (`id_grupo`)      REFERENCES `gr...`. |
| `28` | `) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;` | Instrucción de ejecución en el contexto del script: `) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;`. |
| `29` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `30` | `ALTER TABLE `evidencias`` | Instrucción de ejecución en el contexto del script: `ALTER TABLE `evidencias``. |
| `31` | `ADD COLUMN IF NOT EXISTS `id_turno` INT DEFAULT NULL AFTER `id_vocero`,` | Instrucción de ejecución en el contexto del script: `ADD COLUMN IF NOT EXISTS `id_turno` INT DEFAULT NULL AFTER `id_vocero`,`. |
| `32` | `ADD COLUMN IF NOT EXISTS `observaciones` TEXT DEFAULT NULL AFTER `ruta_a...` | Instrucción de ejecución en el contexto del script: `ADD COLUMN IF NOT EXISTS `observaciones` TEXT DEFAULT NULL AFTER `ruta_a...`. |
| `33` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `34` | `SET FOREIGN_KEY_CHECKS = 1;` | Instrucción de ejecución en el contexto del script: `SET FOREIGN_KEY_CHECKS = 1;`. |

---

## 3. Resumen y Flujo de Interacción

El archivo `alter_turnos.sql` cumple un rol indispensable en `sql/alter_turnos.sql`. 
Script SQL de modificación DDL para añadir columnas y restricciones de turnos de limpieza. Garantiza la robustez, el orden y la estabilidad de la arquitectura del proyecto `systemLimpieza`.

---

Generado automáticamente para el repositorio [johanrepizo/LimpiezaDeModulos](https://github.com/johanrepizo/LimpiezaDeModulos).
