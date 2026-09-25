-- Migración: agregar campo 'tipo' a la tabla evidencias
-- para distinguir foto "antes" de la limpieza y foto "después".
-- Las evidencias existentes (sin tipo) se marcan como 'antes' por defecto.
-- NOTA: MySQL < 8.0 no soporta IF NOT EXISTS en ADD COLUMN.
-- Ejecutar solo si la columna no existe todavía.

ALTER TABLE `evidencias`
    ADD COLUMN `tipo` ENUM('antes','despues') NOT NULL DEFAULT 'antes'
        COMMENT 'antes = foto previa a la limpieza | despues = foto posterior a la limpieza'
        AFTER `id_turno`;
