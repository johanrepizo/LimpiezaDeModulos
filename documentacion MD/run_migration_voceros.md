# Documentación Línea por Línea: `run_migration_voceros.php`

## 1. Ficha Técnica del Archivo

- **Archivo:** `run_migration_voceros.php`
- **Ruta en el proyecto:** `run_migration_voceros.php`
- **Cantidad total de líneas:** `34`
- **Tipo de archivo:** `PHP`
- **Propósito general:** Script de migración para vincular directamente la tabla voceros con los aprendices y corregir duplicados.

---

## 2. Explicación Detallada Línea por Línea

A continuación se presenta cada línea de código numerada de forma consecutiva, acompañada de su fragmento exacto y la explicación exhaustiva de su funcionamiento y responsabilidad en el sistema:

| Línea | Código Fuente | Explicación Detallada |
|---|---|---|
| `1` | ``<?php`` | Apertura obligatoria de la etiqueta PHP para ejecución del código del lado del servidor. |
| `2` | `require __DIR__ . '/config/database.php';` | Importación e inclusión obligatoria del archivo de dependencia requerido: `require __DIR__ . '/config/database.php';`. |
| `3` | `$db = (new Database())->conectar();` | Instrucción de ejecución en el contexto del script: `$db = (new Database())->conectar();`. |
| `4` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `5` | `// 1. Agregar columna id_aprendiz si no existe` | Comentario explicativo en el código: `1. Agregar columna id_aprendiz si no existe`. |
| `6` | `$chk = $db->query("SHOW COLUMNS FROM voceros LIKE 'id_aprendiz'");` | Instrucción de ejecución en el contexto del script: `$chk = $db->query("SHOW COLUMNS FROM voceros LIKE 'id_aprendiz'");`. |
| `7` | `if ($chk->rowCount() === 0) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if ($chk->rowCount() === 0) {`. |
| `8` | `$db->exec("ALTER TABLE voceros ADD COLUMN id_aprendiz INT DEFAULT NULL A...` | Instrucción de ejecución en el contexto del script: `$db->exec("ALTER TABLE voceros ADD COLUMN id_aprendiz INT DEFAULT NULL A...`. |
| `9` | `echo "Columna id_aprendiz agregada.\n";` | Instrucción de ejecución en el contexto del script: `echo "Columna id_aprendiz agregada.\n";`. |
| `10` | `} else {` | Instrucción de ejecución en el contexto del script: `} else {`. |
| `11` | `echo "Columna id_aprendiz ya existe.\n";` | Instrucción de ejecución en el contexto del script: `echo "Columna id_aprendiz ya existe.\n";`. |
| `12` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `13` | `*(Línea en blanco)*` | Línea en blanco para organización visual y legibilidad. |
| `14` | `// 2. Poblar id_aprendiz en los voceros existentes usando documento+ficha` | Comentario explicativo en el código: `2. Poblar id_aprendiz en los voceros existentes usando documento+ficha`. |
| `15` | `// Si hay varios aprendices con el mismo doc en la misma ficha, vincula ...` | Comentario explicativo en el código: `Si hay varios aprendices con el mismo doc en la misma ficha, vincula al ...`. |
| `16` | `$stmt = $db->query("SELECT id_vocero, id_ficha, documento FROM voceros W...` | Instrucción de ejecución en el contexto del script: `$stmt = $db->query("SELECT id_vocero, id_ficha, documento FROM voceros W...`. |
| `17` | `$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);` | Obtiene todos los registros coincidentes de la consulta en un arreglo asociativo. |
| `18` | `foreach ($rows as $v) {` | Estructura de control iterativa para recorrer colecciones o arreglos: `foreach ($rows as $v) {`. |
| `19` | `$stmtA = $db->prepare(` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$stmtA = $db->prepare(`. |
| `20` | `"SELECT id_aprendiz FROM aprendices` | Instrucción de ejecución en el contexto del script: `"SELECT id_aprendiz FROM aprendices`. |
| `21` | `WHERE id_ficha = :fic AND documento = :doc AND activo = 1` | Instrucción de ejecución en el contexto del script: `WHERE id_ficha = :fic AND documento = :doc AND activo = 1`. |
| `22` | `ORDER BY id_aprendiz ASC LIMIT 1"` | Instrucción de ejecución en el contexto del script: `ORDER BY id_aprendiz ASC LIMIT 1"`. |
| `23` | ``);`` | Cierre de estructura de arreglo o invocación de función. |
| `24` | `$stmtA->execute([':fic' => $v['id_ficha'], ':doc' => $v['documento']]);` | Ejecuta la sentencia SQL preparada vinculando los parámetros correspondientes: `$stmtA->execute([':fic' => $v['id_ficha'], ':doc' => $v['documento']]);`. |
| `25` | `$ap = $stmtA->fetch(PDO::FETCH_ASSOC);` | Recupera una única fila o registro resultante de la consulta. |
| `26` | `if ($ap) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if ($ap) {`. |
| `27` | `$db->prepare("UPDATE voceros SET id_aprendiz = :ap WHERE id_vocero = :voc")` | Prepara de forma segura una sentencia SQL parametrizada contra inyección SQL: `$db->prepare("UPDATE voceros SET id_aprendiz = :ap WHERE id_vocero = :voc")`. |
| `28` | `->execute([':ap' => $ap['id_aprendiz'], ':voc' => $v['id_vocero']]);` | Ejecuta la sentencia SQL preparada vinculando los parámetros correspondientes: `->execute([':ap' => $ap['id_aprendiz'], ':voc' => $v['id_vocero']]);`. |
| `29` | `echo "Vocero {$v['id_vocero']} vinculado a aprendiz {$ap['id_aprendiz']}...` | Instrucción de ejecución en el contexto del script: `echo "Vocero {$v['id_vocero']} vinculado a aprendiz {$ap['id_aprendiz']}...`. |
| `30` | `} else {` | Instrucción de ejecución en el contexto del script: `} else {`. |
| `31` | `echo "Vocero {$v['id_vocero']}: no se encontró aprendiz para doc={$v['do...` | Instrucción de ejecución en el contexto del script: `echo "Vocero {$v['id_vocero']}: no se encontró aprendiz para doc={$v['do...`. |
| `32` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `33` | ``}`` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `34` | `echo "Listo.\n";` | Instrucción de ejecución en el contexto del script: `echo "Listo.\n";`. |

---

## 3. Resumen y Flujo de Interacción

El archivo `run_migration_voceros.php` cumple un rol indispensable en `run_migration_voceros.php`. 
Script de migración para vincular directamente la tabla voceros con los aprendices y corregir duplicados. Garantiza la robustez, el orden y la estabilidad de la arquitectura del proyecto `systemLimpieza`.

---

Generado automáticamente para el repositorio [johanrepizo/LimpiezaDeModulos](https://github.com/johanrepizo/LimpiezaDeModulos).
