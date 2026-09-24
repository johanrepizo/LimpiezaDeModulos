# Documentación Línea por Línea: `run_migration2.php`

## 1. Ficha Técnica del Archivo

- **Archivo:** `run_migration2.php`
- **Ruta en el proyecto:** `run_migration2.php`
- **Cantidad total de líneas:** `54`
- **Tipo de archivo:** `PHP`
- **Propósito general:** Script de migración automatizada para actualizar la estructura de tablas de turnos y sincronización en la base de datos MySQL.

---

## 2. Explicación Detallada Línea por Línea

A continuación se presenta cada línea de código numerada de forma consecutiva, acompañada de su fragmento exacto y la explicación exhaustiva de su funcionamiento y responsabilidad en el sistema:

| Línea | Código Fuente | Explicación Detallada |
|---|---|---|
| `1` | `<?php` | Apertura obligatoria de la etiqueta PHP para ejecución del código del lado del servidor. |
| `2` | `require __DIR__ . '/config/database.php';` | Instrucción de ejecución en el contexto del script: `require __DIR__ . '/config/database.php';`. |
| `3` | `$db = (new Database())->conectar();` | Instrucción de ejecución en el contexto del script: `$db = (new Database())->conectar();`. |
| `4` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `5` | `$steps = [];` | Instrucción de ejecución en el contexto del script: `$steps = [];`. |
| `6` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `7` | `// Check and add dia_semana to asignaciones` | Comentario de línea explicativo: `Check and add dia_semana to asignaciones`. |
| `8` | `$cols = $db->query("SHOW COLUMNS FROM 'asignaciones' LIKE 'dia_semana'")->f...` | Obtiene todos los registros coincidentes de la consulta en un arreglo asociativo. |
| `9` | `if (empty($cols)) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (empty($cols)) {`. |
| `10` | `    try {` | Inicia bloque de captura de excepciones `try` para ejecución segura de operaciones críticas. |
| `11` | `        $db->exec("ALTER TABLE 'asignaciones' ADD COLUMN 'dia_semana' TINYI...` | Instrucción de ejecución en el contexto del script: `$db->exec("ALTER TABLE `asignaciones` ADD COLUMN `dia_semana` TINYINT(1) NOT NULL DEFAULT 0 COMMENT '0=Dom,1=Lun,2=Mar,3=Mie,4=Jue,5=Vie,6=Sab' AFTER `fecha_fin`");`. |
| `12` | `        $steps[] = "OK: Added dia_semana to asignaciones";` | Instrucción de ejecución en el contexto del script: `$steps[] = "OK: Added dia_semana to asignaciones";`. |
| `13` | `    } catch (Exception $e) {` | Captura y manejo de excepciones en caso de fallo durante el bloque protegido: `} catch (Exception $e) {`. |
| `14` | `        $steps[] = "ERR dia_semana: " . $e->getMessage();` | Instrucción de ejecución en el contexto del script: `$steps[] = "ERR dia_semana: " . $e->getMessage();`. |
| `15` | `    }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `16` | `} else {` | Bloque alternativo `else`: se ejecuta si ninguna condición previa resultó verdadera. |
| `17` | `    $steps[] = "SKIP: dia_semana already exists in asignaciones";` | Instrucción de ejecución en el contexto del script: `$steps[] = "SKIP: dia_semana already exists in asignaciones";`. |
| `18` | `}` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `19` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `20` | `// Update dia_semana values` | Comentario de línea explicativo: `Update dia_semana values`. |
| `21` | `try {` | Inicia bloque de captura de excepciones `try` para ejecución segura de operaciones críticas. |
| `22` | `    $affected = $db->exec("UPDATE 'asignaciones' SET 'dia_semana' = DAYOFWE...` | Instrucción de ejecución en el contexto del script: `$affected = $db->exec("UPDATE `asignaciones` SET `dia_semana` = DAYOFWEEK(`fecha_inicio`) - 1 WHERE `fecha_inicio` IS NOT NULL");`. |
| `23` | `    $steps[] = "OK: Updated dia_semana for $affected rows";` | Instrucción de ejecución en el contexto del script: `$steps[] = "OK: Updated dia_semana for $affected rows";`. |
| `24` | `} catch (Exception $e) {` | Captura y manejo de excepciones en caso de fallo durante el bloque protegido: `} catch (Exception $e) {`. |
| `25` | `    $steps[] = "ERR update dia_semana: " . $e->getMessage();` | Instrucción de ejecución en el contexto del script: `$steps[] = "ERR update dia_semana: " . $e->getMessage();`. |
| `26` | `}` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `27` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `28` | `// Check and add id_turno to evidencias` | Comentario de línea explicativo: `Check and add id_turno to evidencias`. |
| `29` | `$cols2 = $db->query("SHOW COLUMNS FROM 'evidencias' LIKE 'id_turno'")->fetc...` | Obtiene todos los registros coincidentes de la consulta en un arreglo asociativo. |
| `30` | `if (empty($cols2)) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (empty($cols2)) {`. |
| `31` | `    try {` | Inicia bloque de captura de excepciones `try` para ejecución segura de operaciones críticas. |
| `32` | `        $db->exec("ALTER TABLE 'evidencias' ADD COLUMN 'id_turno' INT DEFAU...` | Instrucción de ejecución en el contexto del script: `$db->exec("ALTER TABLE `evidencias` ADD COLUMN `id_turno` INT DEFAULT NULL AFTER `id_vocero`");`. |
| `33` | `        $steps[] = "OK: Added id_turno to evidencias";` | Instrucción de ejecución en el contexto del script: `$steps[] = "OK: Added id_turno to evidencias";`. |
| `34` | `    } catch (Exception $e) {` | Captura y manejo de excepciones en caso de fallo durante el bloque protegido: `} catch (Exception $e) {`. |
| `35` | `        $steps[] = "ERR id_turno: " . $e->getMessage();` | Instrucción de ejecución en el contexto del script: `$steps[] = "ERR id_turno: " . $e->getMessage();`. |
| `36` | `    }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `37` | `} else {` | Bloque alternativo `else`: se ejecuta si ninguna condición previa resultó verdadera. |
| `38` | `    $steps[] = "SKIP: id_turno already exists in evidencias";` | Instrucción de ejecución en el contexto del script: `$steps[] = "SKIP: id_turno already exists in evidencias";`. |
| `39` | `}` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `40` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `41` | `// Check and add observaciones to evidencias` | Comentario de línea explicativo: `Check and add observaciones to evidencias`. |
| `42` | `$cols3 = $db->query("SHOW COLUMNS FROM 'evidencias' LIKE 'observaciones'")-...` | Obtiene todos los registros coincidentes de la consulta en un arreglo asociativo. |
| `43` | `if (empty($cols3)) {` | Evaluación condicional `if`: ejecuta el bloque si la condición se cumple: `if (empty($cols3)) {`. |
| `44` | `    try {` | Inicia bloque de captura de excepciones `try` para ejecución segura de operaciones críticas. |
| `45` | `        $db->exec("ALTER TABLE 'evidencias' ADD COLUMN 'observaciones' TEXT...` | Instrucción de ejecución en el contexto del script: `$db->exec("ALTER TABLE `evidencias` ADD COLUMN `observaciones` TEXT DEFAULT NULL AFTER `ruta_archivo`");`. |
| `46` | `        $steps[] = "OK: Added observaciones to evidencias";` | Instrucción de ejecución en el contexto del script: `$steps[] = "OK: Added observaciones to evidencias";`. |
| `47` | `    } catch (Exception $e) {` | Captura y manejo de excepciones en caso de fallo durante el bloque protegido: `} catch (Exception $e) {`. |
| `48` | `        $steps[] = "ERR observaciones: " . $e->getMessage();` | Instrucción de ejecución en el contexto del script: `$steps[] = "ERR observaciones: " . $e->getMessage();`. |
| `49` | `    }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `50` | `} else {` | Bloque alternativo `else`: se ejecuta si ninguna condición previa resultó verdadera. |
| `51` | `    $steps[] = "SKIP: observaciones already exists in evidencias";` | Instrucción de ejecución en el contexto del script: `$steps[] = "SKIP: observaciones already exists in evidencias";`. |
| `52` | `}` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `53` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `54` | `foreach ($steps as $s) echo $s . "\n";` | Bucle de iteración `foreach` para recorrer arreglos o colecciones de registros: `foreach ($steps as $s) echo $s . "\n";`. |

---

## 3. Resumen y Flujo de Interacción

El archivo `run_migration2.php` cumple un rol indispensable en `run_migration2.php`. 
Script de migración automatizada para actualizar la estructura de tablas de turnos y sincronización en la base de datos MySQL. Garantiza la robustez, el orden y la estabilidad de la arquitectura del proyecto `systemLimpieza`.
