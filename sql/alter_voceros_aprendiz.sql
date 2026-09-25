-- Migración: agregar id_aprendiz a la tabla voceros
-- para vincular directamente cada vocero con su aprendiz de origen.
-- Esto resuelve el bug de documentos duplicados entre aprendices de la misma ficha.

ALTER TABLE `voceros`
    ADD COLUMN `id_aprendiz` INT DEFAULT NULL
        COMMENT 'FK al aprendiz de origen (nullable para voceros externos/admin)'
        AFTER `id_ficha`;
