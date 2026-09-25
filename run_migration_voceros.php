<?php
require __DIR__ . '/config/database.php';
$db = (new Database())->conectar();

// 1. Agregar columna id_aprendiz si no existe
$chk = $db->query("SHOW COLUMNS FROM voceros LIKE 'id_aprendiz'");
if ($chk->rowCount() === 0) {
    $db->exec("ALTER TABLE voceros ADD COLUMN id_aprendiz INT DEFAULT NULL AFTER id_ficha");
    echo "Columna id_aprendiz agregada.\n";
} else {
    echo "Columna id_aprendiz ya existe.\n";
}

// 2. Poblar id_aprendiz en los voceros existentes usando documento+ficha
// Si hay varios aprendices con el mismo doc en la misma ficha, vincula al de menor id_aprendiz
$stmt = $db->query("SELECT id_vocero, id_ficha, documento FROM voceros WHERE id_aprendiz IS NULL");
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
foreach ($rows as $v) {
    $stmtA = $db->prepare(
        "SELECT id_aprendiz FROM aprendices
         WHERE id_ficha = :fic AND documento = :doc AND activo = 1
         ORDER BY id_aprendiz ASC LIMIT 1"
    );
    $stmtA->execute([':fic' => $v['id_ficha'], ':doc' => $v['documento']]);
    $ap = $stmtA->fetch(PDO::FETCH_ASSOC);
    if ($ap) {
        $db->prepare("UPDATE voceros SET id_aprendiz = :ap WHERE id_vocero = :voc")
           ->execute([':ap' => $ap['id_aprendiz'], ':voc' => $v['id_vocero']]);
        echo "Vocero {$v['id_vocero']} vinculado a aprendiz {$ap['id_aprendiz']}.\n";
    } else {
        echo "Vocero {$v['id_vocero']}: no se encontró aprendiz para doc={$v['documento']} ficha={$v['id_ficha']}.\n";
    }
}
echo "Listo.\n";
