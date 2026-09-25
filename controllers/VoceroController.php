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
        $aprendices   = $_POST['aprendices'] ?? [];

        if (!$idAsignacion) {
            $_SESSION['alert'] = ['icon'=>'warning','title'=>'Sin módulo asignado','text'=>'Tu ficha no tiene un módulo activo. Contacta al administrador.'];
            header("Location: ../views/dashboard/vocero_grupos.php"); exit;
        }

        if (empty($aprendices)) {
            $_SESSION['alert'] = ['icon'=>'warning','title'=>'Sin integrantes','text'=>'El grupo debe tener al menos un integrante.'];
            header("Location: ../views/dashboard/vocero_grupos.php"); exit;
        }

        // Obtener id_ficha de la asignación
        $stmtA = $this->db->prepare("SELECT id_ficha FROM asignaciones WHERE id_asignacion = :id LIMIT 1");
        $stmtA->execute([':id' => $idAsignacion]);
        $idFicha = (int)($stmtA->fetchColumn() ?: 0);

        $modelGrupo = new Grupo($this->db);

        // Validar que ningún aprendiz ya esté en otro grupo de esta ficha
        $ocupados = $modelGrupo->aprendicesOcupadosEnFicha($idFicha);
        $repetidos = array_intersect(array_map('intval', $aprendices), $ocupados);
        if (!empty($repetidos)) {
            $_SESSION['alert'] = ['icon'=>'error','title'=>'Aprendiz ya asignado','text'=>'Uno o más aprendices ya pertenecen a otro grupo de esta ficha. Cada aprendiz solo puede estar en un grupo.'];
            header("Location: ../views/dashboard/vocero_grupos.php"); exit;
        }

        // Nombre automático
        $nombreGrupo = $modelGrupo->proximoNombreGrupo($idVocero);

        // Próximo turno libre
        $modelTurno    = new Turno($this->db);
        $fechaLimpieza = $modelTurno->proximaFechaLibre($idAsignacion);

        if (!$fechaLimpieza) {
            $_SESSION['alert'] = ['icon'=>'error','title'=>'Sin turnos disponibles','text'=>'Ya no hay fechas de limpieza pendientes para asignar. Todos los turnos ya tienen grupo.'];
            header("Location: ../views/dashboard/vocero_grupos.php"); exit;
        }

        $resultado = $modelGrupo->crear([
            'id_asignacion'  => $idAsignacion,
            'id_vocero'      => $idVocero,
            'nombre_grupo'   => $nombreGrupo,
            'fecha_limpieza' => $fechaLimpieza,
        ], $aprendices);

        if ($resultado) {
            $modelTurno->asignarGrupoAlTurno($idAsignacion, $fechaLimpieza, $resultado);
            $modelGrupo->registrarHistorial(
                $resultado,
                "Grupo '{$nombreGrupo}' creado con " . count($aprendices) . " integrante(s). Fecha: {$fechaLimpieza}.",
                $_SESSION['usuario']['id_usuario']
            );
            $_SESSION['alert'] = [
                'icon'  => 'success',
                'title' => '¡Grupo registrado!',
                'text'  => "{$nombreGrupo} · Fecha de limpieza: " . date('d/m/Y', strtotime($fechaLimpieza)) . '.',
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

        $idGrupo    = (int)($_POST['id_grupo']  ?? 0);
        $aprendices = $_POST['aprendices']      ?? [];

        if (!$idGrupo || empty($aprendices)) {
            $_SESSION['alert'] = ['icon'=>'warning','title'=>'Datos incompletos','text'=>'Selecciona al menos un integrante.'];
            header("Location: ../views/dashboard/vocero_grupos.php"); exit;
        }

        $modelGrupo = new Grupo($this->db);
        $grupo      = $modelGrupo->obtenerPorId($idGrupo);

        if (!$grupo) {
            $_SESSION['alert'] = ['icon'=>'error','title'=>'No encontrado','text'=>'Grupo no encontrado.'];
            header("Location: ../views/dashboard/vocero_grupos.php"); exit;
        }

        // Validar que ningún aprendiz nuevo ya esté en otro grupo de la ficha
        $idFicha = (int)($grupo['id_ficha'] ?? 0);
        if ($idFicha) {
            $ocupados  = $modelGrupo->aprendicesOcupadosEnFicha($idFicha, $idGrupo);
            $repetidos = array_intersect(array_map('intval', $aprendices), $ocupados);
            if (!empty($repetidos)) {
                $_SESSION['alert'] = ['icon'=>'error','title'=>'Aprendiz ya asignado','text'=>'Uno o más aprendices ya pertenecen a otro grupo de esta ficha.'];
                header("Location: ../views/dashboard/vocero_grupos.php"); exit;
            }
        }

        // Si la fecha ya pasó, reasignar automáticamente al próximo turno libre
        $fechaLimpieza = $grupo['fecha_limpieza'];
        if (strtotime($fechaLimpieza) < strtotime('today')) {
            $modelTurno    = new Turno($this->db);
            $idAsignacion  = (int)$grupo['id_asignacion'];
            $nuevaFecha    = $modelTurno->proximaFechaLibre($idAsignacion);
            if ($nuevaFecha) {
                $fechaLimpieza = $nuevaFecha;
                // Vincular turno al grupo
                $modelTurno->asignarGrupoAlTurno($idAsignacion, $nuevaFecha, $idGrupo);
            }
        }

        $resultado = $modelGrupo->actualizar($idGrupo, [
            'nombre_grupo'   => $grupo['nombre_grupo'],
            'fecha_limpieza' => $fechaLimpieza,
        ], $aprendices);

        if ($resultado) {
            $modelGrupo->registrarHistorial(
                $idGrupo,
                "Grupo editado: integrantes actualizados. Fecha: {$fechaLimpieza}.",
                $_SESSION['usuario']['id_usuario']
            );
            $_SESSION['alert'] = [
                'icon'  => 'success',
                'title' => 'Grupo actualizado',
                'text'  => 'Integrantes actualizados. Próxima limpieza: ' . date('d/m/Y', strtotime($fechaLimpieza)) . '.',
            ];
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
        $idVocero   = $this->getIdVocero();
        $modelGrupo = new Grupo($this->db);
        $resultado  = $modelGrupo->eliminar($idGrupo);

        if ($resultado) {
            // Renumerar los grupos restantes para que queden consecutivos
            $modelGrupo->renumerarGrupos($idVocero);
            $_SESSION['alert'] = ['icon'=>'success','title'=>'Grupo eliminado','text'=>'El grupo fue eliminado y los demás grupos fueron renumerados.'];
        } else {
            $_SESSION['alert'] = ['icon'=>'error','title'=>'Error','text'=>'No se pudo eliminar el grupo.'];
        }

        header("Location: ../views/dashboard/vocero_grupos.php"); exit;
    }

    // ── SUBIR EVIDENCIA (flujo antiguo por grupo — mantiene compatibilidad) ──
    public function subirEvidencia(): void
    {
        $this->requireVocero();

        $idGrupo  = (int)($_POST['id_grupo'] ?? 0);
        $idVocero = $this->getIdVocero();
        $modelEv  = new Evidencia($this->db);

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

        // Verificar que ya no tenga el par completo
        if ($modelEv->grupoCompleto($idGrupo)) {
            $_SESSION['alert'] = ['icon'=>'warning','title'=>'Ya completado','text'=>'Este grupo ya tiene las dos evidencias (antes y después) registradas.'];
            header("Location: ../views/dashboard/vocero_evidencias.php"); exit;
        }

        $carpeta = __DIR__ . '/../public/uploads/evidencias/';
        if (!is_dir($carpeta)) mkdir($carpeta, 0755, true);
        $maxSize = 10 * 1024 * 1024;

        // ── Helper para validar y mover un archivo ──────────────────────────
        $procesarArchivo = function(array $file, string $prefijo) use ($carpeta, $maxSize): array|false {
            if (empty($file['name']) || $file['error'] !== UPLOAD_ERR_OK) return false;
            $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
            if (!in_array($ext, ['jpg','jpeg','png'])) return false;
            if ($file['size'] > $maxSize) return false;
            $nombre   = $prefijo . '_' . uniqid() . '.' . $ext;
            $fisica   = $carpeta . $nombre;
            $relativa = 'uploads/evidencias/' . $nombre;
            return move_uploaded_file($file['tmp_name'], $fisica)
                ? ['nombre' => $nombre, 'ruta' => $relativa]
                : false;
        };

        $fAntes   = $_FILES['foto_antes']   ?? [];
        $fDespues = $_FILES['foto_despues'] ?? [];

        if (empty($fAntes['name']) || empty($fDespues['name'])) {
            $_SESSION['alert'] = ['icon'=>'warning','title'=>'Fotos incompletas','text'=>'Debes subir las dos fotos: antes y después de la limpieza.'];
            header("Location: ../views/dashboard/vocero_evidencias.php"); exit;
        }

        $antes   = $procesarArchivo($fAntes,   'ev_g' . $idGrupo . '_antes');
        $despues = $procesarArchivo($fDespues, 'ev_g' . $idGrupo . '_despues');

        if (!$antes || !$despues) {
            $_SESSION['alert'] = ['icon'=>'error','title'=>'Error al subir','text'=>'Verifica que ambas fotos sean JPG/PNG y no superen 10 MB.'];
            header("Location: ../views/dashboard/vocero_evidencias.php"); exit;
        }

        try {
            $modelEv->registrar(['id_grupo' => $idGrupo, 'id_vocero' => $idVocero,
                'tipo' => 'antes',   'nombre_archivo' => $antes['nombre'],   'ruta_archivo' => $antes['ruta']]);
            $modelEv->registrar(['id_grupo' => $idGrupo, 'id_vocero' => $idVocero,
                'tipo' => 'despues', 'nombre_archivo' => $despues['nombre'], 'ruta_archivo' => $despues['ruta']]);
            $_SESSION['alert'] = ['icon'=>'success','title'=>'¡Evidencias enviadas!','text'=>'Las fotos antes y después fueron registradas el ' . date('d/m/Y H:i') . '.'];
        } catch (Exception $e) {
            $_SESSION['alert'] = ['icon'=>'error','title'=>'Error','text'=>'No se pudieron registrar las evidencias.'];
        }

        header("Location: ../views/dashboard/vocero_evidencias.php"); exit;
    }

    // ── SUBIR EVIDENCIA CON TURNO (2 fotos obligatorias: antes + después) ───
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

        // Verificar que el turno no tenga ya el par completo
        $modelEv = new Evidencia($this->db);
        if ($modelEv->turnoCompleto($idTurno)) {
            $_SESSION['alert'] = ['icon'=>'warning','title'=>'Ya completado','text'=>'Ya existen las dos evidencias (antes y después) para este turno.'];
            header("Location: ../views/dashboard/vocero_subir_evidencia.php"); exit;
        }

        // ── Validar que ambas fotos estén presentes ─────────────────────────
        $fAntes   = $_FILES['foto_antes']   ?? [];
        $fDespues = $_FILES['foto_despues'] ?? [];

        if (empty($fAntes['name'])   || ($fAntes['error']   ?? UPLOAD_ERR_NO_FILE) !== UPLOAD_ERR_OK ||
            empty($fDespues['name']) || ($fDespues['error'] ?? UPLOAD_ERR_NO_FILE) !== UPLOAD_ERR_OK) {
            $_SESSION['alert'] = ['icon'=>'warning','title'=>'Fotos incompletas','text'=>'Debes subir las dos fotos obligatorias: la del ANTES y la del DESPUÉS de la limpieza.'];
            header("Location: ../views/dashboard/vocero_subir_evidencia.php"); exit;
        }

        $maxSize = 10 * 1024 * 1024;
        $extsOk  = ['jpg','jpeg','png'];
        $carpeta = __DIR__ . '/../public/uploads/evidencias/';
        if (!is_dir($carpeta)) mkdir($carpeta, 0755, true);

        // ── Helper para validar y mover un archivo ──────────────────────────
        $procesarArchivo = function(array $file, string $prefijo) use ($carpeta, $maxSize, $extsOk, $idTurno): array|false {
            $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
            if (!in_array($ext, $extsOk)) return false;
            if ($file['size'] > $maxSize)  return false;
            $nombre   = 'ev_t' . $idTurno . '_' . $prefijo . '_' . uniqid() . '.' . $ext;
            $fisica   = $carpeta . $nombre;
            $relativa = 'uploads/evidencias/' . $nombre;
            return move_uploaded_file($file['tmp_name'], $fisica)
                ? ['nombre' => $nombre, 'ruta' => $relativa]
                : false;
        };

        $antes   = $procesarArchivo($fAntes,   'antes');
        $despues = $procesarArchivo($fDespues, 'despues');

        if (!$antes) {
            $_SESSION['alert'] = ['icon'=>'error','title'=>'Error en foto "Antes"','text'=>'Verifica que sea JPG/PNG y no supere 10 MB.'];
            header("Location: ../views/dashboard/vocero_subir_evidencia.php"); exit;
        }
        if (!$despues) {
            // Limpiar la foto antes ya movida
            @unlink(__DIR__ . '/../public/uploads/evidencias/' . $antes['nombre']);
            $_SESSION['alert'] = ['icon'=>'error','title'=>'Error en foto "Después"','text'=>'Verifica que sea JPG/PNG y no supere 10 MB.'];
            header("Location: ../views/dashboard/vocero_subir_evidencia.php"); exit;
        }

        // ── Resolver id_grupo ───────────────────────────────────────────────
        if (!$idGrupo && $turno['id_grupo']) {
            $idGrupo = (int)$turno['id_grupo'];
        }
        if (!$idGrupo) {
            $stmtG = $this->db->prepare(
                "SELECT g.id_grupo FROM grupos g
                 JOIN asignaciones a ON a.id_asignacion = g.id_asignacion
                 WHERE g.id_vocero = :idv AND a.estado = 'Activa'
                 ORDER BY g.fecha_creacion DESC LIMIT 1"
            );
            $stmtG->execute([':idv' => $idVocero]);
            $rowG    = $stmtG->fetch(PDO::FETCH_ASSOC);
            $idGrupo = $rowG ? (int)$rowG['id_grupo'] : 0;
        }

        if (!$idGrupo) {
            $_SESSION['alert'] = ['icon'=>'error','title'=>'Sin grupo','text'=>'No hay grupo asignado para este turno. Contacta al administrador.'];
            header("Location: ../views/dashboard/vocero_subir_evidencia.php"); exit;
        }

        // ── Registrar ambas fotos ───────────────────────────────────────────
        try {
            $idEvAntes   = $modelEv->registrar([
                'id_grupo'       => $idGrupo,
                'id_vocero'      => $idVocero,
                'id_turno'       => $idTurno,
                'tipo'           => 'antes',
                'nombre_archivo' => $antes['nombre'],
                'ruta_archivo'   => $antes['ruta'],
                'observaciones'  => $obs ?: null,
            ]);
            $idEvDespues = $modelEv->registrar([
                'id_grupo'       => $idGrupo,
                'id_vocero'      => $idVocero,
                'id_turno'       => $idTurno,
                'tipo'           => 'despues',
                'nombre_archivo' => $despues['nombre'],
                'ruta_archivo'   => $despues['ruta'],
                'observaciones'  => $obs ?: null,
            ]);

            // ── Snapshot de integrantes del grupo en este momento ───────────
            if ($idEvAntes || $idEvDespues) {
                $stmtInts = $this->db->prepare(
                    "SELECT ap.id_aprendiz, ap.nombres, ap.apellidos, ap.documento
                     FROM grupo_integrantes gi
                     JOIN aprendices ap ON ap.id_aprendiz = gi.id_aprendiz
                     WHERE gi.id_grupo = :g"
                );
                $stmtInts->execute([':g' => $idGrupo]);
                $ints = $stmtInts->fetchAll(PDO::FETCH_ASSOC);

                $insSnap = $this->db->prepare(
                    "INSERT INTO evidencia_integrantes
                        (id_evidencia, id_aprendiz, nombres, apellidos, documento)
                     VALUES (:ev, :ap, :nom, :ape, :doc)"
                );
                foreach ($ints as $ap) {
                    foreach (array_filter([$idEvAntes, $idEvDespues]) as $idEv) {
                        $insSnap->execute([
                            ':ev'  => $idEv,
                            ':ap'  => $ap['id_aprendiz'],
                            ':nom' => $ap['nombres'],
                            ':ape' => $ap['apellidos'],
                            ':doc' => $ap['documento'],
                        ]);
                    }
                }
            }

            // Marcar turno como cumplido y avanzar al siguiente turno en el ciclo
            $modelTurnoInst = new Turno($this->db);
            $modelTurnoInst->marcarCumplido($idTurno);
            $modelTurnoInst->avanzarTurnoGrupo($idTurno, $idGrupo);

            $_SESSION['alert'] = ['icon'=>'success','title'=>'¡Evidencias enviadas!','text'=>'Las fotos antes y después de la limpieza fueron registradas el ' . date('d/m/Y H:i') . '.'];
        } catch (Exception $e) {
            $_SESSION['alert'] = ['icon'=>'error','title'=>'Error','text'=>'No se pudieron registrar las evidencias. Intenta de nuevo.'];
        }

        header("Location: ../views/dashboard/vocero_subir_evidencia.php"); exit;
    }

    // ── GET EVIDENCIA POR TURNO (JSON para el calendario) ───────────────────
    public function getEvidenciaTurno(): void
    {
        header('Content-Type: application/json');
        $this->requireVocero();

        $idTurno = (int)($_GET['id_turno'] ?? 0);
        if (!$idTurno) { echo json_encode(['par' => null]); exit; }

        $stmt = $this->db->prepare(
            "SELECT tipo, ruta_archivo AS ruta, observaciones
             FROM evidencias
             WHERE id_turno = :id
               AND tipo IN ('antes','despues')
             ORDER BY tipo ASC"
        );
        $stmt->execute([':id' => $idTurno]);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $par = ['antes' => null, 'despues' => null];
        $obs = '';
        foreach ($rows as $r) {
            $par[$r['tipo']] = ['ruta' => $r['ruta']];
            if ($r['observaciones']) $obs = $r['observaciones'];
        }

        echo json_encode(['par' => $par, 'observaciones' => $obs]);
        exit;
    }

    // ── GET EVIDENCIA (JSON) — devuelve el par antes/después de un grupo ────
    public function getEvidencia(): void
    {
        header('Content-Type: application/json');
        $this->requireVocero();

        $idGrupo = (int)($_GET['id_grupo'] ?? 0);
        $modelEv = new Evidencia($this->db);
        $rows    = $modelEv->obtenerTodasPorGrupo($idGrupo);

        if (empty($rows)) {
            echo json_encode(['par' => null]); exit;
        }

        // Buscar datos del módulo/grupo en la primera fila
        $stmt = $this->db->prepare(
            "SELECT m.nombre AS modulo, g.nombre_grupo AS grupo, g.fecha_limpieza
             FROM grupos g
             JOIN asignaciones a ON a.id_asignacion = g.id_asignacion
             JOIN modulos m ON m.id_modulo = a.id_modulo
             WHERE g.id_grupo = :id LIMIT 1"
        );
        $stmt->execute([':id' => $idGrupo]);
        $meta = $stmt->fetch(PDO::FETCH_ASSOC);

        $par = ['antes' => null, 'despues' => null];
        foreach ($rows as $r) {
            $tipo = $r['tipo'] ?? 'antes';
            $par[$tipo] = [
                'ruta'  => $r['ruta_archivo'],
                'fecha' => date('d/m/Y H:i', strtotime($r['fecha_subida'])),
            ];
        }

        echo json_encode([
            'par'    => $par,
            'grupo'  => $meta['grupo']          ?? '',
            'modulo' => $meta['modulo']          ?? '',
            'fecha'  => $meta['fecha_limpieza']
                        ? date('d/m/Y', strtotime($meta['fecha_limpieza']))
                        : '',
        ]);
        exit;
    }

    // ── GET INTEGRANTES IDS (JSON para edición) ─────────────────────────────
    public function getIntegrantesIds(): void
    {
        header('Content-Type: application/json');
        $this->requireVocero();
        $idGrupo = (int)($_GET['id_grupo'] ?? 0);
        $stmt    = $this->db->prepare(
            "SELECT id_aprendiz FROM grupo_integrantes WHERE id_grupo = :id"
        );
        $stmt->execute([':id' => $idGrupo]);
        echo json_encode(array_column($stmt->fetchAll(PDO::FETCH_ASSOC), 'id_aprendiz'));
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
        'get_evidencia'         => $controller->getEvidencia(),
        'get_evidencia_turno'   => $controller->getEvidenciaTurno(),
        'get_integrantes_ids'   => $controller->getIntegrantesIds(),
        default           => header("Location: ../views/dashboard/vocero_dashboard.php"),
    };
}
?>
