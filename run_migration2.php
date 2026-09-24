<?php
require __DIR__ . '/config/database.php';
$db = (new Database())->conectar();

$steps = [];

// Check and add dia_semana to asignaciones
$cols = $db->query("SHOW COLUMNS FROM `asignaciones` LIKE 'dia_semana'")->fetchAll();
if (empty($cols)) {
    try {
        $db->exec("ALTER TABLE `asignaciones` ADD COLUMN `dia_semana` TINYINT(1) NOT NULL DEFAULT 0 COMMENT '0=Dom,1=Lun,2=Mar,3=Mie,4=Jue,5=Vie,6=Sab' AFTER `fecha_fin`");
        $steps[] = "OK: Added dia_semana to asignaciones";
    } catch (Exception $e) {
        $steps[] = "ERR dia_semana: " . $e->getMessage();
    }
} else {
    $steps[] = "SKIP: dia_semana already exists in asignaciones";
}

// Update dia_semana values
try {
    $affected = $db->exec("UPDATE `asignaciones` SET `dia_semana` = DAYOFWEEK(`fecha_inicio`) - 1 WHERE `fecha_inicio` IS NOT NULL");
    $steps[] = "OK: Updated dia_semana for $affected rows";
} catch (Exception $e) {
    $steps[] = "ERR update dia_semana: " . $e->getMessage();
}

// Check and add id_turno to evidencias
$cols2 = $db->query("SHOW COLUMNS FROM `evidencias` LIKE 'id_turno'")->fetchAll();
if (empty($cols2)) {
    try {
        $db->exec("ALTER TABLE `evidencias` ADD COLUMN `id_turno` INT DEFAULT NULL AFTER `id_vocero`");
        $steps[] = "OK: Added id_turno to evidencias";
    } catch (Exception $e) {
        $steps[] = "ERR id_turno: " . $e->getMessage();
    }
} else {
    $steps[] = "SKIP: id_turno already exists in evidencias";
}

// Check and add observaciones to evidencias
$cols3 = $db->query("SHOW COLUMNS FROM `evidencias` LIKE 'observaciones'")->fetchAll();
if (empty($cols3)) {
    try {
        $db->exec("ALTER TABLE `evidencias` ADD COLUMN `observaciones` TEXT DEFAULT NULL AFTER `ruta_archivo`");
        $steps[] = "OK: Added observaciones to evidencias";
    } catch (Exception $e) {
        $steps[] = "ERR observaciones: " . $e->getMessage();
    }
} else {
    $steps[] = "SKIP: observaciones already exists in evidencias";
}

foreach ($steps as $s) echo $s . "\n";
