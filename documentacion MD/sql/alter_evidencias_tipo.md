# Documentación Línea por Línea: `sql/alter_evidencias_tipo.sql`

## 1. Ficha Técnica del Archivo

- **Archivo:** `alter_evidencias_tipo.sql`
- **Ruta en el proyecto:** `sql/alter_evidencias_tipo.sql`
- **Cantidad total de líneas:** `10`
- **Tipo de archivo:** `SQL`
- **Propósito general:** Script SQL DDL para actualizar las columnas y tipos de evidencia antes y después.

---

## 2. Explicación Detallada Línea por Línea

A continuación se presenta cada línea de código numerada de forma consecutiva, acompañada de su fragmento exacto y la explicación exhaustiva de su funcionamiento y responsabilidad en el sistema:

| Línea | Código Fuente | Explicación Detallada |
|---|---|---|
| `1` | `-- Migración: agregar campo 'tipo' a la tabla evidencias` | Comentario explicativo SQL: `Migración: agregar campo 'tipo' a la tabla evidencias`. |
| `2` | `-- para distinguir foto "antes" de la limpieza y foto "después".` | Comentario explicativo SQL: `para distinguir foto "antes" de la limpieza y foto "después".`. |
| `3` | `-- Las evidencias existentes (sin tipo) se marcan como 'antes' por defecto.` | Comentario explicativo SQL: `Las evidencias existentes (sin tipo) se marcan como 'antes' por defecto.`. |
| `4` | `-- NOTA: MySQL < 8.0 no soporta IF NOT EXISTS en ADD COLUMN.` | Comentario explicativo SQL: `NOTA: MySQL < 8.0 no soporta IF NOT EXISTS en ADD COLUMN.`. |
| `5` | `-- Ejecutar solo si la columna no existe todavía.` | Comentario explicativo SQL: `Ejecutar solo si la columna no existe todavía.`. |
| `6` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `7` | `ALTER TABLE `evidencias`` | Instrucción de ejecución en el contexto del script: `ALTER TABLE `evidencias``. |
| `8` | `ADD COLUMN `tipo` ENUM('antes','despues') NOT NULL DEFAULT 'antes'` | Instrucción de ejecución en el contexto del script: `ADD COLUMN `tipo` ENUM('antes','despues') NOT NULL DEFAULT 'antes'`. |
| `9` | `COMMENT 'antes = foto previa a la limpieza \| despues = foto posterior a...` | Instrucción de ejecución en el contexto del script: `COMMENT 'antes = foto previa a la limpieza \| despues = foto posterior a...`. |
| `10` | `AFTER `id_turno`;` | Instrucción de ejecución en el contexto del script: `AFTER `id_turno`;`. |

---

## 3. Resumen y Flujo de Interacción

El archivo `alter_evidencias_tipo.sql` cumple un rol indispensable en `sql/alter_evidencias_tipo.sql`. 
Script SQL DDL para actualizar las columnas y tipos de evidencia antes y después. Garantiza la robustez, el orden y la estabilidad de la arquitectura del proyecto `systemLimpieza`.

---

Generado automáticamente para el repositorio [johanrepizo/LimpiezaDeModulos](https://github.com/johanrepizo/LimpiezaDeModulos).
