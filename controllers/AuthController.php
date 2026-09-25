<?php
if (session_status() === PHP_SESSION_NONE) session_start();

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/Usuario.php';

class AuthController
{
    // ── LOGIN ──────────────────────────────────────────────────────────────
    public function login(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: ../views/usuarios/login.php");
            exit;
        }

        $correo   = trim($_POST['correo']   ?? '');
        $password = trim($_POST['password'] ?? '');

        if (empty($correo) || empty($password)) {
            $_SESSION['alert'] = ['icon'=>'warning','title'=>'Campos incompletos','text'=>'Completa todos los campos.'];
            header("Location: ../views/usuarios/login.php"); exit;
        }

        $db      = (new Database())->conectar();
        $model   = new Usuario($db);
        $usuario = $model->obtenerPorEmail($correo);

        if (!$usuario) {
            $_SESSION['alert'] = ['icon'=>'error','title'=>'Acceso denegado','text'=>'Usuario o contraseña incorrectos.'];
            header("Location: ../views/usuarios/login.php"); exit;
        }

        if ((int)$usuario['activo'] === 0) {
            $_SESSION['alert'] = ['icon'=>'error','title'=>'Cuenta inactiva','text'=>'Tu cuenta está inactiva. Contacta al administrador.'];
            header("Location: ../views/usuarios/login.php"); exit;
        }

        if (!empty($usuario['bloqueado_hasta']) && strtotime($usuario['bloqueado_hasta']) > time()) {
            $minutos = ceil((strtotime($usuario['bloqueado_hasta']) - time()) / 60);
            $_SESSION['alert'] = [
                'icon'  => 'error',
                'title' => 'Cuenta bloqueada',
                'text'  => "Demasiados intentos fallidos. Intenta de nuevo en {$minutos} minuto(s)."
            ];
            header("Location: ../views/usuarios/login.php"); exit;
        }

        if (!password_verify($password, $usuario['password'])) {
            $model->registrarIntentoFallido($usuario['id_usuario']);
            // Re-leer para saber cuántos intentos quedan
            $actualizado = $model->obtenerPorId($usuario['id_usuario']);
            $intentos    = (int)($actualizado['intentos_fallidos'] ?? 0);
            $restantes   = max(0, 3 - $intentos);
            $texto = $restantes > 0
                ? "Usuario o contraseña incorrectos. Te quedan {$restantes} intento(s)."
                : "Demasiados intentos fallidos. Tu cuenta ha sido bloqueada temporalmente.";
            $_SESSION['alert'] = ['icon'=>'error','title'=>'Acceso denegado','text'=>$texto];
            header("Location: ../views/usuarios/login.php"); exit;
        }

        $model->resetearIntentos($usuario['id_usuario']);
        session_regenerate_id(true);

        $_SESSION['usuario'] = [
            'id_usuario' => $usuario['id_usuario'],
            'nombres'    => $usuario['nombres'],
            'apellidos'  => $usuario['apellidos'],
            'correo'     => $usuario['correo'],
            'rol'        => (int)$usuario['id_rol'],
        ];

        // Si es primer acceso, forzar cambio de contraseña (solo voceros)
        if ((int)$usuario['primer_acceso'] === 1 && (int)$usuario['id_rol'] === 2) {
            header("Location: ../views/usuarios/cambiar_password.php"); exit;
        }

        match ((int)$usuario['id_rol']) {
            1       => header("Location: ../views/dashboard/admin_dashboard.php"),
            default => header("Location: ../views/dashboard/vocero_dashboard.php"),
        };
        exit;
    }

    // ── CAMBIO OBLIGATORIO DE CONTRASEÑA (PRIMER ACCESO) ──────────────────
    public function cambiarPassword(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: ../views/usuarios/cambiar_password.php"); exit;
        }

        if (!isset($_SESSION['usuario'])) {
            header("Location: ../views/usuarios/login.php"); exit;
        }

        $passwordActual  = trim($_POST['password_actual']  ?? '');
        $passwordNueva   = trim($_POST['password_nueva']   ?? '');
        $passwordConfirm = trim($_POST['password_confirm'] ?? '');

        $db      = (new Database())->conectar();
        $model   = new Usuario($db);
        $usuario = $model->obtenerPorId($_SESSION['usuario']['id_usuario']);

        // Verificar contraseña actual
        if (!password_verify($passwordActual, $usuario['password'])) {
            $_SESSION['alert'] = ['icon'=>'error','title'=>'Contraseña incorrecta','text'=>'La contraseña actual no es correcta.'];
            header("Location: ../views/usuarios/cambiar_password.php"); exit;
        }

        // Validar que la nueva no sea igual a la temporal
        if (password_verify($passwordNueva, $usuario['password'])) {
            $_SESSION['alert'] = ['icon'=>'error','title'=>'Contraseña inválida','text'=>'La nueva contraseña no puede ser igual a la contraseña temporal.'];
            header("Location: ../views/usuarios/cambiar_password.php"); exit;
        }

        // Validar requisitos
        $errores = $this->validarRequisitosPassword($passwordNueva);
        if (!empty($errores)) {
            $_SESSION['alert'] = ['icon'=>'error','title'=>'Contraseña no válida','text'=>implode(' | ', $errores)];
            header("Location: ../views/usuarios/cambiar_password.php"); exit;
        }

        if ($passwordNueva !== $passwordConfirm) {
            $_SESSION['alert'] = ['icon'=>'error','title'=>'Las contraseñas no coinciden','text'=>'La nueva contraseña y su confirmación deben ser iguales.'];
            header("Location: ../views/usuarios/cambiar_password.php"); exit;
        }

        $model->actualizarPassword($_SESSION['usuario']['id_usuario'], password_hash($passwordNueva, PASSWORD_DEFAULT));
        // Actualizar sesión para que no vuelva a pedir cambio de contraseña
        $_SESSION['usuario']['primer_acceso'] = 0;
        $_SESSION['alert'] = ['icon'=>'success','title'=>'¡Contraseña actualizada!','text'=>'Ya puedes acceder al sistema con tu nueva contraseña.'];
        header("Location: ../views/dashboard/vocero_dashboard.php"); exit;
    }

    // ── RECUPERAR CONTRASEÑA ───────────────────────────────────────────────
    public function recuperar(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: ../views/usuarios/login.php"); exit;
        }

        $correo          = trim($_POST['correo']           ?? '');
        $passwordNueva   = trim($_POST['password_nueva']   ?? '');
        $passwordConfirm = trim($_POST['password_confirm'] ?? '');

        if (empty($correo) || empty($passwordNueva)) {
            $_SESSION['alert'] = ['icon'=>'warning','title'=>'Campos incompletos','text'=>'Completa todos los campos.'];
            header("Location: ../views/usuarios/login.php?panel=recuperar"); exit;
        }

        $errores = $this->validarRequisitosPassword($passwordNueva);
        if (!empty($errores)) {
            $_SESSION['alert'] = ['icon'=>'error','title'=>'Contraseña no válida','text'=>implode(' | ', $errores)];
            header("Location: ../views/usuarios/login.php?panel=recuperar"); exit;
        }

        if ($passwordNueva !== $passwordConfirm) {
            $_SESSION['alert'] = ['icon'=>'error','title'=>'Las contraseñas no coinciden','text'=>'La nueva contraseña y su confirmación deben ser iguales.'];
            header("Location: ../views/usuarios/login.php?panel=recuperar"); exit;
        }

        $db    = (new Database())->conectar();
        $model = new Usuario($db);

        // Por seguridad mostramos el mismo mensaje exista o no el correo
        if ($model->existeCorreo($correo)) {
            $model->actualizarPasswordPorCorreo($correo, password_hash($passwordNueva, PASSWORD_DEFAULT));
        }

        $_SESSION['alert'] = ['icon'=>'success','title'=>'Solicitud procesada','text'=>'Si el correo está registrado, la contraseña fue actualizada. Inicia sesión.'];
        header("Location: ../views/usuarios/login.php"); exit;
    }

    // ── LOGOUT ─────────────────────────────────────────────────────────────
    public function logout(): void
    {
        // Evitar que el navegador sirva la página del dashboard desde caché
        header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");
        header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");

        session_unset();
        session_destroy();
        header("Location: ../views/usuarios/login.php"); exit;
    }

    // ── HELPER: VALIDACIÓN DE CONTRASEÑA ──────────────────────────────────
    private function validarRequisitosPassword(string $password): array
    {
        $errores = [];
        if (strlen($password) < 8)             $errores[] = 'Debe tener al menos 8 caracteres.';
        if (!preg_match('/[A-Z]/', $password))  $errores[] = 'Debe incluir al menos una letra mayúscula.';
        if (!preg_match('/[0-9]/', $password))  $errores[] = 'Debe incluir al menos un número.';
        if (!preg_match('/[\W_]/', $password))  $errores[] = 'Debe incluir al menos un carácter especial.';
        return $errores;
    }
}

// ── Dispatcher ────────────────────────────────────────────────────────────
if (basename(__FILE__) === basename($_SERVER['SCRIPT_FILENAME'])) {
    $controller = new AuthController();
    $accion     = $_GET['accion'] ?? 'login';

    match ($accion) {
        'logout'           => $controller->logout(),
        'recuperar'        => $controller->recuperar(),
        'cambiar_password' => $controller->cambiarPassword(),
        default            => $controller->login(),
    };
}
?>
