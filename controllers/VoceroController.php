<?php
if (session_status() === PHP_SESSION_NONE) session_start();

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/Grupo.php';
require_once __DIR__ . '/../models/Evidencia.php';
require_once __DIR__ . '/../models/Ficha.php';
require_once __DIR__ . '/../models/Notificacion.php';
require_once __DIR__ . '/../models/Turno.php';

class VoceroController
{
    private PDO $db;

    public function __construct()
    {
        $this->db = (new Database())->conectar();
    }

    // ── GUARDAR GRUPO ──────────────────────────────────────────────────────
    public function guardarGrupo(): void
    {
        $this->requireVocero();

        $idVocero     = $this->getIdVocero();
        $idAsignacion = (int)($_POST['id_asignacion'] ?? 0);
        $nombreGrupo  = trim($_POST['nombre_grupo']   ?? '');
        $aprendices   = $_POST['aprendices']          ?? [];

        if (!$idAsignacion || empty($nombreGrupo)) {
            $_SESSION['alert'] = ['icon'=>'warning','title'=>'Datos incompletos','text'=>'Escribe el nombre del grupo y selecciona al menos un integrante.'];
            header("Location: ../views/dashboard/vocero_grupos.php"); exit;
        }

        if (empty($aprendices)) {
            $_SESSION['alert'] = ['icon'=>'warning','title'=>'Sin integrantes','text'=>'El grupo debe tener al menos un integrante.'];
            header("Location: ../views/dashboard/vocero_grupos.php"); exit;
        }

        // ── Buscar el próximo turno libre de esta asignación ────────────
        $modelTurno = new Turno($this->db);
        $fechaLimpieza = $modelTurno->proximaFechaLibre($idAsignacion);

        if (!$fechaLimpieza) {
            $_SESSION['alert'] = ['icon'=>'error','title'=>'Sin turnos disponibles','text'=>'Ya no hay fechas de limpieza pendientes para asignar en este período. Todos los turnos ya tienen grupo.'];
            header("Location: ../views/dashboard/vocero_grupos.php"); exit;
        }

        $modelGrupo = new Grupo($this->db);

        $resultado = $modelGrupo->crear([
            'id_asignacion'  => $idAsignacion,
            'id_vocero'      => $idVocero,
            'nombre_grupo'   => $nombreGrupo,
            'fecha_limpieza' => $fechaLimpieza,
        ], $aprendices);

        if ($resultado) {
            // Vincular este grupo al turno que le corresponde
            $modelTurno->asignarGrupoAlTurno($idAsignacion, $fechaLimpieza, $resultado);

            $modelGrupo->registrarHistorial(
                $resultado,
                "Grupo creado con " . count($aprendices) . " integrante(s). Fecha asignada automáticamente: {$fechaLimpieza}.",
                $_SESSION['usuario']['id_usuario']
            );
            $_SESSION['alert'] = [
                'icon'  => 'success',
                'title' => '¡Grupo registrado!',
                'text'  => 'Fecha de limpieza asignada automáticamente: ' . date('d/m/Y', strtotime($fechaLimpieza)) . '.',
            ];
        } else {
            $_SESSION['alert'] = ['icon'=>'error','title'=>'Error','text'=>'No se pudo registrar el grupo. Intenta de nuevo.'];
        }

        header("Location: ../views/dashboard/vocero_grupos.php"); exit;
    }

    // ── EDITAR GRUPO ───────────────────────────────────────────────────────
    public function editarGrupo(): void
    {
        $this->requireVocero();

        $idGrupo       = (int)($_POST['id_grupo']       ?? 0);
        $nombreGrupo   = trim($_POST['nombre_grupo']    ?? '');
        $fechaLimpieza = trim($_POST['fecha_limpieza']  ?? '');
        $aprendices    = $_POST['aprendices']           ?? [];

        if (!$idGrupo || empty($nombreGrupo) || empty($fechaLimpieza) || empty($aprendices)) {
            $_SESSION['alert'] = ['icon'=>'warning','title'=>'Datos incompletos','text'=>'Completa todos los campos y agrega al menos un integrante.'];
            header("Location: ../views/dashboard/vocero_grupos.php"); exit;
        }

        $modelGrupo = new Grupo($this->db);
        $grupo      = $modelGrupo->obtenerPorId($idGrupo);

        // Verificar que el plazo no haya vencido
        if ($grupo && strtotime($grupo['fecha_limite_evidencia']) < time()) {
            $_SESSION['alert'] = ['icon'=>'error','title'=>'Plazo vencido','text'=>'El plazo de modificación para este grupo ha expirado. Contacta al administrador.'];
            header("Location: ../views/dashboard/vocero_grupos.php"); exit;
        }

        $resultado = $modelGrupo->actualizar($idGrupo, [
            'nombre_grupo'   => $nombreGrupo,
            'fecha_limpieza' => $fechaLimpieza,
        ], $aprendices);

        if ($resultado) {
            $modelGrupo->registrarHistorial(
                $idGrupo,
                "Grupo editado: nombre='{$nombreGrupo}', integrantes actualizados.",
                $_SESSION['usuario']['id_usuario']
            );
            $_SESSION['alert'] = ['icon'=>'success','title'=>'Grupo actualizado','text'=>'Los cambios se guardaron correctamente.'];
        } else {
            $_SESSION['alert'] = ['icon'=>'error','title'=>'Error','text'=>'No se pudo actualizar el grupo.'];
        }

        header("Location: ../views/dashboard/vocero_grupos.php"); exit;
    }

    // ── ELIMINAR GRUPO ─────────────────────────────────────────────────────
    public function eliminarGrupo(): void
    {
        $this->requireVocero();

        $idGrupo    = (int)($_POST['id_grupo'] ?? 0);
        $modelGrupo = new Grupo($this->db);
        $resultado  = $modelGrupo->eliminar($idGrupo);

        if ($resultado) {
            $_SESSION['alert'] = ['icon'=>'success','title'=>'Grupo eliminado','text'=>'El grupo fue eliminado correctamente.'];
        } else {
            $_SESSION['alert'] = ['icon'=>'error','title'=>'No se puede eliminar','text'=>'Este grupo tiene evidencias registradas y no puede ser eliminado.'];
        }

        header("Location: ../views/dashboard/vocero_grupos.php"); exit;
    }

    // ── SUBIR EVIDENCIA ────────────────────────────────────────────────────
    public function subirEvidencia(): void
    {
        $this->requireVocero();

        $idGrupo   = (int)($_POST['id_grupo'] ?? 0);
        $idVocero  = $this->getIdVocero();

        $modelGrupo = new Grupo($this->db);
        $grupo      = $modelGrupo->obtenerPorId($idGrupo);

        if (!$grupo) {
            $_SESSION['alert'] = ['icon'=>'error','title'=>'Error','text'=>'Grupo no encontrado.'];
            header("Location: ../views/dashboard/vocero_evidencias.php"); exit;
        }

        // Verificar plazo
        if (strtotime($grupo['fecha_limite_evidencia']) < time()) {
            $_SESSION['alert'] = ['icon'=>'error','title'=>'Plazo vencido','text'=>'El plazo de entrega venció el ' . date('d/m/Y H:i', strtotime($grupo['fecha_limite_evidencia'])) . '. Contacta al administrador.'];
            header("Location: ../views/dashboard/vocero_evidencias.php"); exit;
        }

        // Verificar archivo
        if (empty($_FILES['evidencia']['name'])) {
            $_SESSION['alert'] = ['icon'=>'warning','title'=>'Sin archivo','text'=>'Selecciona una imagen para subir.'];
            header("Location: ../views/dashboard/vocero_evidencias.php"); exit;
        }

        $archivo     = $_FILES['evidencia'];
        $extensiones = ['jpg', 'jpeg', 'png'];
        $ext         = strtolower(pathinfo($archivo['name'], PATHINFO_EXTENSION));
        $maxSize     = 10 * 1024 * 1024; // 10 MB

        if (!in_array($ext, $extensiones)) {
            $_SESSION['alert'] = ['icon'=>'error','title'=>'Formato no permitido','text'=>'Solo se aceptan archivos JPG, JPEG o PNG.'];
            header("Location: ../views/dashboard/vocero_evidencias.php"); exit;
        }

        if ($archivo['size'] > $maxSize) {
            $_SESSION['alert'] = ['icon'=>'error','title'=>'Archivo muy grande','text'=>'El archivo supera el límite de 10 MB.'];
            header("Location: ../views/dashboard/vocero_evidencias.php"); exit;
        }

        $carpeta    = __DIR__ . '/../public/uploads/evidencias/';
        if (!is_dir($carpeta)) mkdir($carpeta, 0755, true);

        $nombreArchivo = 'ev_' . $idGrupo . '_' . uniqid() . '.' . $ext;
        $rutaFisica    = $carpeta . $nombreArchivo;
        $rutaRelativa  = 'uploads/evidencias/' . $nombreArchivo;

        if (!move_uploaded_file($archivo['tmp_name'], $rutaFisica)) {
            $_SESSION['alert'] = ['icon'=>'error','title'=>'Error al subir','text'=>'No se pudo guardar el archivo. Intenta de nuevo.'];
            header("Location: ../views/dashboard/vocero_evidencias.php"); exit;
        }

        $modelEv = new Evidencia($this->db);
        $resultado = $modelEv->registrar([
            'id_grupo'       => $idGrupo,
            'id_vocero'      => $idVocero,
            'nombre_archivo' => $nombreArchivo,
            'ruta_archivo'   => $rutaRelativa,
        ]);

        if ($resultado) {
            $_SESSION['alert'] = ['icon'=>'success','title'=>'¡Evidencia enviada!','text'=>'La evidencia fue registrada correctamente el ' . date('d/m/Y H:i') . '.'];
        } else {
            $_SESSION['alert'] = ['icon'=>'error','title'=>'Error','text'=>'No se pudo registrar la evidencia en el sistema.'];
        }

        header("Location: ../views/dashboard/vocero_evidencias.php"); exit;
    }

    // ── SUBIR EVIDENCIA CON TURNO ──────────────────────────────────────────
    public function subirEvidenciaTurno(): void
    {
        $this->requireVocero();

        $idTurno  = (int)($_POST['id_turno'] ?? 0);
        $idGrupo  = (int)($_POST['id_grupo'] ?? 0);
        $obs      = trim($_POST['observaciones'] ?? '');
        $idVocero = $this->getIdVocero();

        if (!$idTurno) {
            $_SESSION['alert'] = ['icon'=>'error','title'=>'Error','text'=>'Turno no válido.'];
            header("Location: ../views/dashboard/vocero_subir_evidencia.php"); exit;
        }

        // Verificar que el turno esté abierto hoy
        $stmtT = $this->db->prepare(
            "SELECT * FROM turnos WHERE id_turno = :id AND estado IN ('Abierto','Pendiente')
             AND NOW() BETWEEN fecha_apertura AND fecha_cierre LIMIT 1"
        );
        $stmtT->execute([':id' => $idTurno]);
        $turno = $stmtT->fetch(PDO::FETCH_ASSOC);

        if (!$turno) {
            $_SESSION['alert'] = ['icon'=>'error','title'=>'Turno cerrado','text'=>'El plazo para subir evidencia de hoy ha vencido o el turno no es válido.'];
            header("Location: ../views/dashboard/vocero_subir_evidencia.php"); exit;
        }

        // Verificar que no tenga ya evidencia
        $stmtE = $this->db->prepare("SELECT id_evidencia FROM evidencias WHERE id_turno = :id LIMIT 1");
        $stmtE->execute([':id' => $idTurno]);
        if ($stmtE->fetch()) {
            $_SESSION['alert'] = ['icon'=>'warning','title'=>'Ya registrada','text'=>'Ya existe una evidencia para este turno.'];
            header("Location: ../views/dashboard/vocero_subir_evidencia.php"); exit;
        }

        // Validar archivo
        if (empty($_FILES['evidencia']['name'])) {
            $_SESSION['alert'] = ['icon'=>'warning','title'=>'Sin archivo','text'=>'Selecciona una imagen.'];
            header("Location: ../views/dashboard/vocero_subir_evidencia.php"); exit;
        }

        $archivo  = $_FILES['evidencia'];
        $ext      = strtolower(pathinfo($archivo['name'], PATHINFO_EXTENSION));
        $maxSize  = 10 * 1024 * 1024;

        if (!in_array($ext, ['jpg','jpeg','png'])) {
            $_SESSION['alert'] = ['icon'=>'error','title'=>'Formato no válido','text'=>'Solo JPG, JPEG o PNG.'];
            header("Location: ../views/dashboard/vocero_subir_evidencia.php"); exit;
        }
        if ($archivo['size'] > $maxSize) {
            $_SESSION['alert'] = ['icon'=>'error','title'=>'Archivo muy grande','text'=>'Máximo 10 MB.'];
            header("Location: ../views/dashboard/vocero_subir_evidencia.php"); exit;
        }

        $carpeta = __DIR__ . '/../public/uploads/evidencias/';
        if (!is_dir($carpeta)) mkdir($carpeta, 0755, true);

        $nombreArchivo = 'ev_t' . $idTurno . '_' . uniqid() . '.' . $ext;
        $rutaFisica    = $carpeta . $nombreArchivo;
        $rutaRelativa  = 'uploads/evidencias/' . $nombreArchivo;

        if (!move_uploaded_file($archivo['tmp_name'], $rutaFisica)) {
            $_SESSION['alert'] = ['icon'=>'error','title'=>'Error al subir','text'=>'No se pudo guardar el archivo.'];
            header("Location: ../views/dashboard/vocero_subir_evidencia.php"); exit;
        }

        // Si no hay grupo, usar el grupo del turno
        if (!$idGrupo && $turno['id_grupo']) {
            $idGrupo = (int)$turno['id_grupo'];
        }

        // Si aún no hay grupo, buscar cualquier grupo del vocero activo
        if (!$idGrupo) {
            $stmtG = $this->db->prepare(
                "SELECT g.id_grupo FROM grupos g
                 JOIN asignaciones a ON a.id_asignacion = g.id_asignacion
                 WHERE g.id_vocero = :idv AND a.estado = 'Activa'
                 ORDER BY g.fecha_creacion DESC LIMIT 1"
            );
            $stmtG->execute([':idv' => $idVocero]);
            $rowG = $stmtG->fetch(PDO::FETCH_ASSOC);
            $idGrupo = $rowG ? (int)$rowG['id_grupo'] : 0;
        }

        if (!$idGrupo) {
            $_SESSION['alert'] = ['icon'=>'error','title'=>'Sin grupo','text'=>'No hay grupo asignado para este turno. Contacta al administrador.'];
            header("Location: ../views/dashboard/vocero_subir_evidencia.php"); exit;
        }

        // Registrar evidencia con id_turno
        try {
            $stmt = $this->db->prepare(
                "INSERT INTO evidencias (id_grupo, id_vocero, id_turno, nombre_archivo, ruta_archivo, observaciones)
                 VALUES (:grupo, :vocero, :turno, :nombre, :ruta, :obs)"
            );
            $stmt->execute([
                ':grupo'  => $idGrupo,
                ':vocero' => $idVocero,
                ':turno'  => $idTurno,
                ':nombre' => $nombreArchivo,
                ':ruta'   => $rutaRelativa,
                ':obs'    => $obs ?: null,
            ]);
            // Marcar turno como cumplido
            (new Turno($this->db))->marcarCumplido($idTurno);

            // Segunda foto (opcional)
            if (!empty($_FILES['evidencia2']['name']) && $_FILES['evidencia2']['error'] === UPLOAD_ERR_OK) {
                $archivo2  = $_FILES['evidencia2'];
                $ext2      = strtolower(pathinfo($archivo2['name'], PATHINFO_EXTENSION));
                if (in_array($ext2, ['jpg','jpeg','png']) && $archivo2['size'] <= $maxSize) {
                    $nombreArchivo2 = 'ev_t' . $idTurno . '_2_' . uniqid() . '.' . $ext2;
                    $rutaFisica2    = $carpeta . $nombreArchivo2;
                    $rutaRelativa2  = 'uploads/evidencias/' . $nombreArchivo2;
                    if (move_uploaded_file($archivo2['tmp_name'], $rutaFisica2)) {
                        $this->db->prepare(
                            "INSERT INTO evidencias (id_grupo, id_vocero, id_turno, nombre_archivo, ruta_archivo, observaciones)
                             VALUES (:grupo, :vocero, :turno, :nombre, :ruta, :obs)"
                        )->execute([
                            ':grupo'  => $idGrupo,
                            ':vocero' => $idVocero,
                            ':turno'  => $idTurno,
                            ':nombre' => $nombreArchivo2,
                            ':ruta'   => $rutaRelativa2,
                            ':obs'    => ($obs ? $obs . ' (foto 2)' : 'foto 2'),
                        ]);
                    }
                }
            }

            $_SESSION['alert'] = ['icon'=>'success','title'=>'¡Evidencia enviada!','text'=>'La evidencia fue registrada correctamente el ' . date('d/m/Y H:i') . '.'];
        } catch (Exception $e) {
            $_SESSION['alert'] = ['icon'=>'error','title'=>'Error','text'=>'No se pudo registrar la evidencia.'];
        }

        header("Location: ../views/dashboard/vocero_subir_evidencia.php"); exit;
    }

    // ── GET EVIDENCIA (JSON) ────────────────────────────────────────────────
    public function getEvidencia(): void
    {
        header('Content-Type: application/json');
        $this->requireVocero();
        $idGrupo = (int)($_GET['id_grupo'] ?? 0);
        $modelEv = new Evidencia($this->db);
        $ev = $modelEv->obtenerPorGrupo($idGrupo);
        if ($ev) {
            $stmt = $this->db->prepare(
                "SELECT m.nombre AS modulo, g.nombre_grupo AS grupo, e.fecha_subida, e.ruta_archivo
                 FROM evidencias e
                 JOIN grupos g ON g.id_grupo = e.id_grupo
                 JOIN asignaciones a ON a.id_asignacion = g.id_asignacion
                 JOIN modulos m ON m.id_modulo = a.id_modulo
                 WHERE e.id_evidencia = :id LIMIT 1"
            );
            $stmt->execute([':id' => $ev['id_evidencia']]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            echo json_encode([
                'ruta'   => $row['ruta_archivo'],
                'grupo'  => $row['grupo'],
                'modulo' => $row['modulo'],
                'fecha'  => date('d/m/Y H:i', strtotime($row['fecha_subida']))
            ]);
        } else {
            echo json_encode(['ruta' => null]);
        }
        exit;
    }

    // ── HELPERS ────────────────────────────────────────────────────────────
    private function requireVocero(): void
    {
        if (!isset($_SESSION['usuario']) || (int)$_SESSION['usuario']['rol'] !== 2) {
            header("Location: ../views/usuarios/login.php"); exit;
        }
    }

    private function getIdVocero(): int
    {
        // Buscar el id_vocero del usuario en sesión
        $stmt = $this->db->prepare(
            "SELECT id_vocero FROM voceros WHERE id_usuario = :id AND activo = 1 LIMIT 1"
        );
        $stmt->execute([':id' => $_SESSION['usuario']['id_usuario']]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ? (int)$row['id_vocero'] : 0;
    }
}

// ── Dispatcher ────────────────────────────────────────────────────────────
if (basename(__FILE__) === basename($_SERVER['SCRIPT_FILENAME'])) {
    $controller = new VoceroController();
    $accion     = $_POST['accion'] ?? $_GET['accion'] ?? '';

    match ($accion) {
        'guardar_grupo'   => $controller->guardarGrupo(),
        'editar_grupo'    => $controller->editarGrupo(),
        'eliminar_grupo'  => $controller->eliminarGrupo(),
        'subir_evidencia' => $controller->subirEvidencia(),
        'subir_evidencia_turno' => $controller->subirEvidenciaTurno(),
        'get_evidencia'   => $controller->getEvidencia(),
        default           => header("Location: ../views/dashboard/vocero_dashboard.php"),
    };
}
?>
