<?php
if (session_status() === PHP_SESSION_NONE) session_start();

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/Programa.php';
require_once __DIR__ . '/../models/Ficha.php';
require_once __DIR__ . '/../models/Modulo.php';
require_once __DIR__ . '/../models/Usuario.php';
require_once __DIR__ . '/../models/Notificacion.php';
require_once __DIR__ . '/../models/Turno.php';

class AdminController
{
    private PDO $db;

    public function __construct()
    {
        $this->db = (new Database())->conectar();
    }

    // ════════════════════════════════════════════════════════════════════════
    // PROGRAMAS
    // ════════════════════════════════════════════════════════════════════════

    public function guardarPrograma(): void
    {
        $this->requireAdmin();
        $model  = new Programa($this->db);
        $id     = (int)($_POST['id_programa'] ?? 0);
        $datos  = [
            'nombre'      => trim($_POST['nombre']      ?? ''),
            'descripcion' => trim($_POST['descripcion'] ?? ''),
            'nivel'       => trim($_POST['nivel']       ?? ''),
        ];

        if (empty($datos['nombre'])) {
            $_SESSION['alert'] = ['icon'=>'warning','title'=>'Campo requerido','text'=>'El nombre del programa es obligatorio.'];
            header("Location: ../views/dashboard/admin_programas.php"); exit;
        }

        if ($id) {
            $model->actualizar($id, $datos);
            $_SESSION['alert'] = ['icon'=>'success','title'=>'Programa actualizado','text'=>'Los datos del programa fueron guardados.'];
        } else {
            $model->crear($datos);
            $_SESSION['alert'] = ['icon'=>'success','title'=>'Programa creado','text'=>'El programa de formación fue registrado exitosamente.'];
        }

        header("Location: ../views/dashboard/admin_programas.php"); exit;
    }

    public function eliminarPrograma(): void
    {
        $this->requireAdmin();
        $id    = (int)($_POST['id_programa'] ?? 0);
        $model = new Programa($this->db);

        if ($model->tieneFichasActivas($id)) {
            $_SESSION['alert'] = ['icon'=>'error','title'=>'No se puede eliminar','text'=>'Este programa tiene fichas activas asociadas. Inactívalas primero.'];
        } else {
            $model->eliminar($id);
            $_SESSION['alert'] = ['icon'=>'success','title'=>'Programa eliminado','text'=>'El programa fue marcado como inactivo.'];
        }

        header("Location: ../views/dashboard/admin_programas.php"); exit;
    }

    // ════════════════════════════════════════════════════════════════════════
    // FICHAS
    // ════════════════════════════════════════════════════════════════════════

    public function guardarFicha(): void
    {
        $this->requireAdmin();
        $model = new Ficha($this->db);
        $id    = (int)($_POST['id_ficha'] ?? 0);
        $datos = [
            'id_programa'    => (int)($_POST['id_programa']    ?? 0),
            'numero_ficha'   => trim($_POST['numero_ficha']    ?? ''),
            'jornada'        => trim($_POST['jornada']         ?? 'Diurna'),
            'num_aprendices' => (int)($_POST['num_aprendices'] ?? 0) ?: null,
        ];

        if (!$datos['id_programa'] || empty($datos['numero_ficha'])) {
            $_SESSION['alert'] = ['icon'=>'warning','title'=>'Datos incompletos','text'=>'Programa y número de ficha son obligatorios.'];
            header("Location: ../views/dashboard/admin_fichas.php"); exit;
        }

        if ($model->existeDuplicado($datos['numero_ficha'], $datos['id_programa'], $id ?: null)) {
            $_SESSION['alert'] = ['icon'=>'error','title'=>'Ficha duplicada','text'=>'Ya existe una ficha con ese número en el mismo programa.'];
            header("Location: ../views/dashboard/admin_fichas.php"); exit;
        }

        if ($id) {
            $model->actualizar($id, $datos);
            $_SESSION['alert'] = ['icon'=>'success','title'=>'Ficha actualizada','text'=>'Los datos de la ficha fueron actualizados.'];
        } else {
            $model->crear($datos);
            $_SESSION['alert'] = ['icon'=>'success','title'=>'Ficha creada','text'=>'La ficha fue registrada correctamente.'];
        }

        header("Location: ../views/dashboard/admin_fichas.php"); exit;
    }

    public function eliminarFicha(): void
    {
        $this->requireAdmin();
        $id    = (int)($_POST['id_ficha'] ?? 0);
        $model = new Ficha($this->db);

        if ($model->tieneAsignacionesActivas($id)) {
            $_SESSION['alert'] = ['icon'=>'error','title'=>'No se puede eliminar','text'=>'Esta ficha tiene asignaciones activas. Completa o cancela las asignaciones primero.'];
        } else {
            $model->eliminar($id);
            $_SESSION['alert'] = ['icon'=>'success','title'=>'Ficha eliminada','text'=>'La ficha fue marcada como inactiva.'];
        }

        header("Location: ../views/dashboard/admin_fichas.php"); exit;
    }

    // ════════════════════════════════════════════════════════════════════════
    // MÓDULOS
    // ════════════════════════════════════════════════════════════════════════

    public function guardarModulo(): void
    {
        $this->requireAdmin();
        $model = new Modulo($this->db);
        $id    = (int)($_POST['id_modulo'] ?? 0);
        $datos = [
            'nombre'      => trim($_POST['nombre']      ?? ''),
            'ubicacion'   => trim($_POST['ubicacion']   ?? ''),
            'capacidad'   => (int)($_POST['capacidad']  ?? 0) ?: null,
            'descripcion' => trim($_POST['descripcion'] ?? ''),
        ];

        if (empty($datos['nombre'])) {
            $_SESSION['alert'] = ['icon'=>'warning','title'=>'Campo requerido','text'=>'El nombre del módulo es obligatorio.'];
            header("Location: ../views/dashboard/admin_modulos.php"); exit;
        }

        if ($id) {
            $model->actualizar($id, $datos);
            $_SESSION['alert'] = ['icon'=>'success','title'=>'Módulo actualizado','text'=>'Los datos del módulo fueron guardados.'];
        } else {
            $model->crear($datos);
            $_SESSION['alert'] = ['icon'=>'success','title'=>'Módulo creado','text'=>'El módulo fue registrado en el inventario.'];
        }

        header("Location: ../views/dashboard/admin_modulos.php"); exit;
    }

    public function asignarModulo(): void
    {
        $this->requireAdmin();
        $model       = new Modulo($this->db);
        $idModulo    = (int)($_POST['id_modulo']   ?? 0);
        $idFicha     = (int)($_POST['id_ficha']    ?? 0);
        $fechaInicio = trim($_POST['fecha_inicio'] ?? '');

        if (!$idModulo || !$idFicha || empty($fechaInicio)) {
            $_SESSION['alert'] = ['icon'=>'warning','title'=>'Datos incompletos','text'=>'Selecciona el módulo, la ficha y la fecha de inicio.'];
            header("Location: ../views/dashboard/admin_modulos.php"); exit;
        }

        // Fecha fin = 2 años desde inicio (recurrente indefinido en la práctica)
        $fechaFin    = (new DateTime($fechaInicio))->modify('+2 years')->format('Y-m-d');
        // Fecha límite evidencia = 23:59 del mismo día del turno (se usa a nivel de turno, pero el campo requiere un valor)
        $fechaLimite = $fechaInicio . ' 23:59:00';

        if ($model->estaAsignadoEnPeriodo($idModulo, $fechaInicio, $fechaFin)) {
            $_SESSION['alert'] = ['icon'=>'error','title'=>'Módulo ya asignado','text'=>'Este módulo ya tiene una asignación activa. Cancélala antes de crear una nueva.'];
            header("Location: ../views/dashboard/admin_modulos.php"); exit;
        }

        if ($model->fichaYaTieneAsignacion($idFicha)) {
            $_SESSION['alert'] = ['icon'=>'error','title'=>'Ficha ya tiene módulo','text'=>'Esta ficha ya tiene un módulo asignado activo. Cada ficha solo puede limpiar un módulo a la vez. Cancela la asignación actual antes de crear una nueva.'];
            header("Location: ../views/dashboard/admin_modulos.php"); exit;
        }

        $idAsignacion = $model->crearAsignacion([
            'id_modulo'               => $idModulo,
            'id_ficha'                => $idFicha,
            'fecha_inicio'            => $fechaInicio,
            'fecha_fin'               => $fechaFin,
            'fecha_limite_evidencia'  => $fechaLimite,
        ]);

        if ($idAsignacion) {
            $diaSemana = (int)(new DateTime($fechaInicio))->format('w');
            $this->db->prepare("UPDATE asignaciones SET dia_semana = :d WHERE id_asignacion = :id")
                     ->execute([':d' => $diaSemana, ':id' => $idAsignacion]);
            (new Turno($this->db))->generarTurnosAsignacion($idAsignacion);
            $this->notificarVoceroAsignacion($idFicha, $idAsignacion);

            $diasES = ['Domingo','Lunes','Martes','Miércoles','Jueves','Viernes','Sábado'];
            $diaNom = $diasES[$diaSemana];
            $_SESSION['alert'] = [
                'icon'  => 'success',
                'title' => 'Módulo asignado',
                'text'  => "La limpieza se programó todos los {$diaNom}s a partir del " . date('d/m/Y', strtotime($fechaInicio)) . '. Se notificó al vocero.',
            ];
        } else {
            $_SESSION['alert'] = ['icon'=>'error','title'=>'Error','text'=>'No se pudo registrar la asignación.'];
        }

        header("Location: ../views/dashboard/admin_modulos.php"); exit;
    }

    public function editarAsignacion(): void
    {
        $this->requireAdmin();
        $model        = new Modulo($this->db);
        $idAsignacion = (int)($_POST['id_asignacion'] ?? 0);
        $idFicha      = (int)($_POST['id_ficha']      ?? 0);
        $fechaInicio  = trim($_POST['fecha_inicio']   ?? '');

        if (!$idAsignacion || !$idFicha || empty($fechaInicio)) {
            $_SESSION['alert'] = ['icon'=>'warning','title'=>'Datos incompletos','text'=>'La ficha y la fecha de inicio son obligatorias.'];
            header("Location: ../views/dashboard/admin_modulos.php"); exit;
        }

        $stmtA = $this->db->prepare("SELECT id_modulo FROM asignaciones WHERE id_asignacion = :id LIMIT 1");
        $stmtA->execute([':id' => $idAsignacion]);
        $asigActual = $stmtA->fetch(PDO::FETCH_ASSOC);
        if (!$asigActual) {
            $_SESSION['alert'] = ['icon'=>'error','title'=>'No encontrada','text'=>'Asignación no encontrada.'];
            header("Location: ../views/dashboard/admin_modulos.php"); exit;
        }

        $fechaFin    = (new DateTime($fechaInicio))->modify('+2 years')->format('Y-m-d');
        $fechaLimite = $fechaInicio . ' 23:59:00';

        if ($model->estaAsignadoEnPeriodo((int)$asigActual['id_modulo'], $fechaInicio, $fechaFin, $idAsignacion)) {
            $_SESSION['alert'] = ['icon'=>'error','title'=>'Conflicto','text'=>'Ese módulo ya tiene otra asignación activa que se solapa con esa fecha.'];
            header("Location: ../views/dashboard/admin_modulos.php"); exit;
        }

        if ($model->fichaYaTieneAsignacion($idFicha, $idAsignacion)) {
            $_SESSION['alert'] = ['icon'=>'error','title'=>'Ficha ya tiene módulo','text'=>'La ficha seleccionada ya tiene un módulo asignado activo.'];
            header("Location: ../views/dashboard/admin_modulos.php"); exit;
        }

        $diaSemana = (int)(new DateTime($fechaInicio))->format('w');
        $stmt = $this->db->prepare(
            "UPDATE asignaciones
             SET id_ficha = :ficha, fecha_inicio = :inicio, fecha_fin = :fin,
                 fecha_limite_evidencia = :limite, dia_semana = :dia
             WHERE id_asignacion = :id"
        );
        $ok = $stmt->execute([
            ':ficha'  => $idFicha,
            ':inicio' => $fechaInicio,
            ':fin'    => $fechaFin,
            ':limite' => $fechaLimite,
            ':dia'    => $diaSemana,
            ':id'     => $idAsignacion,
        ]);

        if ($ok) {
            $this->db->prepare("DELETE FROM turnos WHERE id_asignacion = :id")
                     ->execute([':id' => $idAsignacion]);
            (new Turno($this->db))->generarTurnosAsignacion($idAsignacion);
            (new Turno($this->db))->asignarGruposRotacion($idAsignacion);

            $diasES = ['Domingo','Lunes','Martes','Miércoles','Jueves','Viernes','Sábado'];
            $_SESSION['alert'] = [
                'icon'  => 'success',
                'title' => 'Asignación actualizada',
                'text'  => 'Los turnos se regeneraron. La limpieza será cada ' . $diasES[$diaSemana] . ' desde el ' . date('d/m/Y', strtotime($fechaInicio)) . '.',
            ];
        } else {
            $_SESSION['alert'] = ['icon'=>'error','title'=>'Error','text'=>'No se pudo actualizar la asignación.'];
        }

        header("Location: ../views/dashboard/admin_modulos.php"); exit;
    }

    public function cancelarAsignacion(): void
    {
        $this->requireAdmin();
        $idAsignacion = (int)($_POST['id_asignacion'] ?? 0);

        $this->db->prepare("UPDATE asignaciones SET estado = 'Cancelada' WHERE id_asignacion = :id")
                 ->execute([':id' => $idAsignacion]);
        $this->db->prepare("DELETE FROM turnos WHERE id_asignacion = :id")
                 ->execute([':id' => $idAsignacion]);

        $_SESSION['alert'] = ['icon'=>'success','title'=>'Asignación cancelada','text'=>'La asignación fue cancelada y sus turnos eliminados.'];
        header("Location: ../views/dashboard/admin_modulos.php"); exit;
    }

    // ════════════════════════════════════════════════════════════════════════
    // VOCEROS / USUARIOS
    // ════════════════════════════════════════════════════════════════════════

    public function reenviarCredenciales(): void
    {
        $this->requireAdmin();
        $idVocero = (int)($_POST['id_vocero'] ?? 0);

        $stmt = $this->db->prepare(
            "SELECT v.*, u.id_usuario FROM voceros v
             JOIN usuarios u ON u.id_usuario = v.id_usuario
             WHERE v.id_vocero = :id LIMIT 1"
        );
        $stmt->execute([':id' => $idVocero]);
        $vocero = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$vocero) {
            $_SESSION['alert'] = ['icon'=>'error','title'=>'No encontrado','text'=>'Vocero no encontrado.'];
            header("Location: ../views/dashboard/admin_voceros.php"); exit;
        }

        // Generar nueva contraseña temporal
        $nuevaPassword = $this->generarPasswordTemporal();
        $modelUser     = new Usuario($this->db);
        $modelUser->actualizarPassword($vocero['id_usuario'], password_hash($nuevaPassword, PASSWORD_DEFAULT));

        // NO se resetea primer_acceso: el vocero ya completó su primer acceso,
        // solo se le entrega una nueva contraseña para que inicie sesión normalmente.

        // En producción aquí se enviaría el correo con PHPMailer/SMTP
        // Por ahora almacenamos en sesión para mostrar en pantalla
        $_SESSION['alert'] = [
            'icon'  => 'success',
            'title' => 'Credenciales reenviadas',
            'text'  => "Se generó nueva contraseña temporal para {$vocero['nombres']} {$vocero['apellidos']}. En producción se enviaría al correo {$vocero['correo']}."
        ];

        header("Location: ../views/dashboard/admin_voceros.php"); exit;
    }

    // ── ACTIVAR APRENDIZ COMO VOCERO ───────────────────────────────────────
    public function activarVocero(): void
    {
        $this->requireAdmin();

        $idAprendiz = (int)($_POST['id_aprendiz'] ?? 0);
        $idFicha    = (int)($_POST['id_ficha']    ?? 0);

        if (!$idAprendiz || !$idFicha) {
            $_SESSION['alert'] = ['icon'=>'warning','title'=>'Datos incompletos','text'=>'Faltan datos.'];
            header("Location: ../views/dashboard/admin_aprendices.php?ficha={$idFicha}"); exit;
        }

        // Verificar que no haya ya 2 voceros activos
        $stmtChk = $this->db->prepare("SELECT COUNT(*) FROM voceros WHERE id_ficha = :fic AND activo = 1");
        $stmtChk->execute([':fic' => $idFicha]);
        if ((int)$stmtChk->fetchColumn() >= 2) {
            $_SESSION['alert'] = ['icon'=>'error','title'=>'Límite alcanzado','text'=>'Esta ficha ya tiene 2 voceros activos. Desactiva uno antes de asignar otro.'];
            header("Location: ../views/dashboard/admin_aprendices.php?ficha={$idFicha}"); exit;
        }

        // Datos del aprendiz
        $stmtAp = $this->db->prepare("SELECT * FROM aprendices WHERE id_aprendiz = :id AND activo = 1 LIMIT 1");
        $stmtAp->execute([':id' => $idAprendiz]);
        $aprendiz = $stmtAp->fetch(PDO::FETCH_ASSOC);

        if (!$aprendiz) {
            $_SESSION['alert'] = ['icon'=>'error','title'=>'No encontrado','text'=>'Aprendiz no encontrado.'];
            header("Location: ../views/dashboard/admin_aprendices.php?ficha={$idFicha}"); exit;
        }

        // Correo único usando id_aprendiz para evitar colisiones por documentos duplicados
        $correo           = 'ap' . $idAprendiz . '@sena.edu.co';
        $passwordTemporal = $this->generarPasswordTemporal();
        $modelUser        = new Usuario($this->db);

        // Buscar si ya existe un vocero para ESTE aprendiz específico (por id_aprendiz)
        $stmtVEx = $this->db->prepare(
            "SELECT v.id_vocero, v.id_usuario, v.activo
             FROM voceros v
             WHERE v.id_aprendiz = :idap AND v.id_ficha = :fic
             LIMIT 1"
        );
        $stmtVEx->execute([':idap' => $idAprendiz, ':fic' => $idFicha]);
        $voceroExistente = $stmtVEx->fetch(PDO::FETCH_ASSOC);

        if ($voceroExistente) {
            // Ya existe: reactivar usuario y vocero
            $idUsuario = (int)$voceroExistente['id_usuario'];
            $this->db->prepare("UPDATE voceros SET activo = 1 WHERE id_vocero = :id")
                     ->execute([':id' => $voceroExistente['id_vocero']]);
            $this->db->prepare("UPDATE usuarios SET activo = 1, id_rol = 2, primer_acceso = 1 WHERE id_usuario = :id")
                     ->execute([':id' => $idUsuario]);
            $modelUser->actualizarPassword($idUsuario, password_hash($passwordTemporal, PASSWORD_DEFAULT));
        } else {
            // Crear nuevo usuario para este aprendiz (correo único por id_aprendiz)
            $idUsuario = $modelUser->crearVocero([
                'nombres'   => $aprendiz['nombres'],
                'apellidos' => $aprendiz['apellidos'],
                'documento' => $aprendiz['documento'],
                'celular'   => $aprendiz['celular'] ?? null,
                'correo'    => $correo,
                'password'  => password_hash($passwordTemporal, PASSWORD_DEFAULT),
            ]);

            if (!$idUsuario) {
                $_SESSION['alert'] = ['icon'=>'error','title'=>'Error','text'=>'No se pudo crear el usuario.'];
                header("Location: ../views/dashboard/admin_aprendices.php?ficha={$idFicha}"); exit;
            }

            // Crear registro en voceros vinculado al id_aprendiz
            $this->db->prepare(
                "INSERT INTO voceros (id_usuario, id_ficha, id_aprendiz, nombres, apellidos, documento, correo, activo)
                 VALUES (:idu, :fic, :idap, :nom, :ape, :doc, :cor, 1)"
            )->execute([
                ':idu'  => $idUsuario,
                ':fic'  => $idFicha,
                ':idap' => $idAprendiz,
                ':nom'  => $aprendiz['nombres'],
                ':ape'  => $aprendiz['apellidos'],
                ':doc'  => $aprendiz['documento'],
                ':cor'  => $correo,
            ]);
        }

        // Notificación interna con credenciales
        (new Notificacion($this->db))->crear([
            'id_usuario'    => $idUsuario,
            'id_asignacion' => null,
            'tipo'          => 'credenciales',
            'titulo'        => 'Cuenta de Vocero activada',
            'mensaje'       => "Tu cuenta fue activada. Correo: {$correo} | Contraseña temporal: {$passwordTemporal} — Debes cambiarla en tu primer inicio de sesión.",
        ]);

        $_SESSION['alert'] = [
            'icon'  => 'success',
            'title' => 'Cuenta de vocero activada',
            'text'  => 'Credenciales enviadas al vocero.',
        ];
        header("Location: ../views/dashboard/admin_aprendices.php?ficha={$idFicha}"); exit;
    }

    // ── DESACTIVAR VOCERO ──────────────────────────────────────────────────
    public function desactivarVocero(): void
    {
        $this->requireAdmin();
        $idVocero = (int)($_POST['id_vocero'] ?? 0);
        $idFicha  = (int)($_POST['id_ficha']  ?? 0);

        if (!$idVocero) {
            header("Location: ../views/dashboard/admin_aprendices.php?ficha={$idFicha}"); exit;
        }

        // Leer el id_usuario ANTES de modificar el registro
        $stmtU = $this->db->prepare("SELECT id_usuario FROM voceros WHERE id_vocero = :id LIMIT 1");
        $stmtU->execute([':id' => $idVocero]);
        $row = $stmtU->fetch(PDO::FETCH_ASSOC);

        // Desactivar vocero
        $this->db->prepare("UPDATE voceros SET activo = 0 WHERE id_vocero = :id")
                 ->execute([':id' => $idVocero]);

        // Desactivar usuario asociado solo si no tiene otro vocero activo en otra ficha
        if ($row) {
            $stmtOtros = $this->db->prepare(
                "SELECT COUNT(*) FROM voceros
                 WHERE id_usuario = :uid AND activo = 1 AND id_vocero != :vid"
            );
            $stmtOtros->execute([':uid' => $row['id_usuario'], ':vid' => $idVocero]);
            if ((int)$stmtOtros->fetchColumn() === 0) {
                // No tiene otros registros de vocero activos → desactivar la cuenta
                $this->db->prepare("UPDATE usuarios SET activo = 0 WHERE id_usuario = :id")
                         ->execute([':id' => $row['id_usuario']]);
            }
        }

        $_SESSION['alert'] = ['icon'=>'success','title'=>'Vocero desactivado','text'=>'El aprendiz volvió al rol de aprendiz y su acceso fue revocado.'];
        header("Location: ../views/dashboard/admin_aprendices.php?ficha={$idFicha}"); exit;
    }

    // ── REACTIVAR VOCERO INACTIVO ──────────────────────────────────────────
    public function reactivarVocero(): void
    {
        $this->requireAdmin();
        $idVocero = (int)($_POST['id_vocero'] ?? 0);
        $idFicha  = (int)($_POST['id_ficha']  ?? 0);

        // Verificar límite de 2
        $stmtChk = $this->db->prepare("SELECT COUNT(*) FROM voceros WHERE id_ficha = :fic AND activo = 1");
        $stmtChk->execute([':fic' => $idFicha]);
        if ((int)$stmtChk->fetchColumn() >= 2) {
            $_SESSION['alert'] = ['icon'=>'error','title'=>'Límite alcanzado','text'=>'Esta ficha ya tiene 2 voceros activos. Desactiva uno antes.'];
            header("Location: ../views/dashboard/admin_aprendices.php?ficha={$idFicha}"); exit;
        }

        // Reactivar vocero y su usuario
        $stmtV = $this->db->prepare("SELECT id_usuario FROM voceros WHERE id_vocero = :id LIMIT 1");
        $stmtV->execute([':id' => $idVocero]);
        $row = $stmtV->fetch(PDO::FETCH_ASSOC);

        $this->db->prepare("UPDATE voceros SET activo = 1 WHERE id_vocero = :id")
                 ->execute([':id' => $idVocero]);

        if ($row) {
            $this->db->prepare("UPDATE usuarios SET activo = 1, primer_acceso = 1 WHERE id_usuario = :id")
                     ->execute([':id' => $row['id_usuario']]);

            $nuevaPassword = $this->generarPasswordTemporal();
            (new Usuario($this->db))->actualizarPassword(
                (int)$row['id_usuario'],
                password_hash($nuevaPassword, PASSWORD_DEFAULT)
            );
            // Resetear primer_acceso
            $this->db->prepare("UPDATE usuarios SET primer_acceso = 1 WHERE id_usuario = :id")
                     ->execute([':id' => $row['id_usuario']]);

            $_SESSION['alert'] = [
                'icon'  => 'success',
                'title' => 'Cuenta de vocero activada',
                'text'  => 'Credenciales enviadas al vocero.',
            ];
        } else {
            $_SESSION['alert'] = ['icon'=>'success','title'=>'Cuenta de vocero activada','text'=>'Credenciales enviadas al vocero.'];
        }

        header("Location: ../views/dashboard/admin_aprendices.php?ficha={$idFicha}"); exit;
    }

    // ── HELPERS ────────────────────────────────────────────────────────────
    private function requireAdmin(): void
    {
        if (!isset($_SESSION['usuario']) || (int)$_SESSION['usuario']['rol'] !== 1) {
            header("Location: ../views/usuarios/login.php"); exit;
        }
    }

    private function notificarVoceroAsignacion(int $idFicha, int $idAsignacion): void
    {
        $stmt = $this->db->prepare(
            "SELECT v.id_usuario, m.nombre AS nombre_modulo, a.fecha_limite_evidencia
             FROM voceros v
             JOIN asignaciones a ON a.id_asignacion = :asig
             JOIN modulos m ON m.id_modulo = a.id_modulo
             WHERE v.id_ficha = :ficha AND v.activo = 1 LIMIT 1"
        );
        $stmt->execute([':asig' => $idAsignacion, ':ficha' => $idFicha]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$data) return;

        $noti = new Notificacion($this->db);
        $noti->crear([
            'id_usuario'    => $data['id_usuario'],
            'id_asignacion' => $idAsignacion,
            'tipo'          => 'info',
            'titulo'        => 'Nuevo módulo asignado',
            'mensaje'       => "Se te ha asignado el módulo «{$data['nombre_modulo']}». Fecha límite de evidencia: " . date('d/m/Y H:i', strtotime($data['fecha_limite_evidencia'])) . ".",
        ]);
    }

    private function generarPasswordTemporal(): string
    {
        $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789!@#$';
        return substr(str_shuffle($chars), 0, 10);
    }

    // ── GET EVIDENCIA POR TURNO (JSON para el calendario) ───────────────────
    public function getEvidenciaTurno(): void
    {
        header('Content-Type: application/json');
        if (!isset($_SESSION['usuario']) || (int)$_SESSION['usuario']['rol'] !== 1) {
            http_response_code(403);
            echo json_encode(['error' => 'No autorizado']);
            exit;
        }

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
            if (!empty($r['observaciones'])) $obs = $r['observaciones'];
        }

        echo json_encode(['par' => $par, 'observaciones' => $obs]);
        exit;
    }
}

// ── Dispatcher ────────────────────────────────────────────────────────────
if (basename(__FILE__) === basename($_SERVER['SCRIPT_FILENAME'])) {
    $controller = new AdminController();
    $accion     = $_POST['accion'] ?? $_GET['accion'] ?? '';

    match ($accion) {
        'guardar_programa'   => $controller->guardarPrograma(),
        'eliminar_programa'  => $controller->eliminarPrograma(),
        'guardar_ficha'      => $controller->guardarFicha(),
        'eliminar_ficha'     => $controller->eliminarFicha(),
        'guardar_modulo'     => $controller->guardarModulo(),
        'asignar_modulo'     => $controller->asignarModulo(),
        'editar_asignacion'  => $controller->editarAsignacion(),
        'cancelar_asignacion'=> $controller->cancelarAsignacion(),
        'reenviar_credenciales' => $controller->reenviarCredenciales(),
        'activar_vocero'        => $controller->activarVocero(),
        'desactivar_vocero'     => $controller->desactivarVocero(),
        'reactivar_vocero'      => $controller->reactivarVocero(),
        'get_evidencia_turno'   => $controller->getEvidenciaTurno(),
        default              => header("Location: ../views/dashboard/admin_dashboard.php"),
    };
}
?>
