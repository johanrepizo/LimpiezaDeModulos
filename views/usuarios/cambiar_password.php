<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php"); exit;
}
// Solo voceros en primer acceso
if ((int)$_SESSION['usuario']['rol'] !== 2) {
    header("Location: ../dashboard/admin_dashboard.php"); exit;
}
$alert = $_SESSION['alert'] ?? null;
unset($_SESSION['alert']);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cambio de Contraseña – GestiLimpieza SENA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        :root { --sena-green:#39a900; --bg-dark:#071200; --panel-dark:#0f2200; }
        body {
            background: var(--bg-dark);
            min-height: 100vh;
            font-family: 'Inter', sans-serif; color: #f0fff0;
            display: flex; align-items: center; justify-content: center; padding: 1rem;
        }
        .change-card {
            max-width: 480px; width: 100%;
            background: var(--panel-dark);
            border-radius: 20px; padding: 2.5rem;
            border: 1px solid rgba(57,169,0,.12);
            box-shadow: 0 20px 40px rgba(0,0,0,.5);
        }
        .icon-box {
            width: 56px; height: 56px; border-radius: 14px;
            background: rgba(57,169,0,.15);
            border: 1px solid rgba(57,169,0,.2);
            display: flex; align-items: center; justify-content: center;
            font-size: 1.5rem; color: var(--sena-green);
            margin: 0 auto 1.5rem;
        }
        .form-label { font-size:.83rem; font-weight:600; color:#c0dcc0; margin-bottom:.4rem; }
        .input-group-text {
            background:rgba(7,18,0,.6); border:1px solid rgba(57,169,0,.15);
            border-right:0; color:var(--sena-green);
        }
        .form-control {
            background:rgba(7,18,0,.6); border:1px solid rgba(57,169,0,.15);
            border-left:0; color:#fff; padding:.72rem 1rem;
        }
        .form-control:focus { background:rgba(7,18,0,.8); box-shadow:none; border-color:var(--sena-green); color:#fff; }
        .form-control::placeholder { color:#3a6030; }
        .btn-eye {
            background:rgba(7,18,0,.6); border:1px solid rgba(57,169,0,.15);
            border-left:0; color:#5a8a50;
        }
        .btn-eye:hover { color:var(--sena-green); }
        .btn-guardar {
            background:var(--sena-green); color:#fff; border:none;
            border-radius:8px; font-size:1rem; font-weight:600;
            padding:.75rem; width:100%; transition:all .3s;
            box-shadow: 0 4px 15px rgba(57,169,0,.35);
        }
        .btn-guardar:hover { background:#2d8700; transform:translateY(-2px); }
        .req-item { font-size:.78rem; color:#3a6030; margin-bottom:.2rem; transition:color .2s; }
        .req-item.ok { color:#39a900; }
        .req-box {
            background:rgba(7,18,0,.4); border-radius:8px; padding:.8rem 1rem;
            border:1px solid rgba(57,169,0,.1); margin-bottom:1rem;
        }
        .alert-warning-custom {
            background:rgba(234,179,8,.1); border:1px solid rgba(234,179,8,.3);
            border-radius:10px; padding:1rem; color:#fbbf24; font-size:.85rem;
            margin-bottom:1.5rem;
        }
    </style>
</head>
<body>

<div class="change-card">
    <div class="icon-box"><i class="fas fa-key"></i></div>
    <h5 class="text-center fw-bold mb-1" style="color:#fff;">Cambio de Contraseña Obligatorio</h5>
    <p class="text-center mb-4" style="color:#5a8a50; font-size:.88rem;">
        Por seguridad debes cambiar tu contraseña temporal antes de continuar.
    </p>

    <div class="alert-warning-custom">
        <i class="fas fa-triangle-exclamation me-2"></i>
        No podrás acceder al sistema hasta completar este paso.
    </div>

    <form action="../../controllers/AuthController.php?accion=cambiar_password" method="POST" id="formCambio">

        <div class="mb-4">
            <label class="form-label">Contraseña Actual (temporal)</label>
            <div class="input-group">
                <span class="input-group-text"><i class="fas fa-lock-open"></i></span>
                <input type="password" name="password_actual" id="passActual"
                       class="form-control" placeholder="Tu contraseña temporal" required>
                <button type="button" class="btn btn-eye"
                        onclick="togglePass('passActual','eyeActual')">
                    <i class="fas fa-eye" id="eyeActual"></i>
                </button>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Nueva Contraseña</label>
            <div class="input-group mb-2">
                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                <input type="password" name="password_nueva" id="passNueva"
                       class="form-control" placeholder="Mín. 8 caracteres"
                       required oninput="checkReqs(this.value)">
                <button type="button" class="btn btn-eye"
                        onclick="togglePass('passNueva','eyeNueva')">
                    <i class="fas fa-eye" id="eyeNueva"></i>
                </button>
            </div>
            <!-- Requisitos -->
            <div class="req-box">
                <div id="req-len"   class="req-item"><i class="fas fa-circle me-1" style="font-size:.45rem;"></i> Al menos 8 caracteres</div>
                <div id="req-upper" class="req-item"><i class="fas fa-circle me-1" style="font-size:.45rem;"></i> Al menos una letra mayúscula</div>
                <div id="req-num"   class="req-item"><i class="fas fa-circle me-1" style="font-size:.45rem;"></i> Al menos un número</div>
                <div id="req-spec"  class="req-item"><i class="fas fa-circle me-1" style="font-size:.45rem;"></i> Al menos un carácter especial (!@#$...)</div>
            </div>
        </div>

        <div class="mb-4">
            <label class="form-label">Confirmar Nueva Contraseña</label>
            <div class="input-group">
                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                <input type="password" name="password_confirm" id="passConfirm"
                       class="form-control" placeholder="Repite la contraseña" required>
                <button type="button" class="btn btn-eye"
                        onclick="togglePass('passConfirm','eyeConfirm')">
                    <i class="fas fa-eye" id="eyeConfirm"></i>
                </button>
            </div>
            <div id="passError" class="text-danger d-none mt-2" style="font-size:.8rem;">
                <i class="fas fa-circle-exclamation me-1"></i> Las contraseñas no coinciden.
            </div>
        </div>

        <button type="submit" class="btn-guardar">
            <i class="fas fa-shield-halved me-2"></i> Guardar Nueva Contraseña
        </button>
    </form>
</div>

<?php if ($alert): ?>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        Swal.fire({
            icon:  '<?= htmlspecialchars($alert['icon'])  ?>',
            title: '<?= htmlspecialchars($alert['title']) ?>',
            text:  '<?= htmlspecialchars($alert['text'])  ?>',
            confirmButtonColor: '#39a900',
            background: '#0f2200',
            color: '#f0fff0'
        });
    });
</script>
<?php endif; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
function togglePass(inputId, iconId) {
    const inp = document.getElementById(inputId);
    const ico = document.getElementById(iconId);
    inp.type = inp.type === 'password' ? 'text' : 'password';
    ico.classList.toggle('fa-eye');
    ico.classList.toggle('fa-eye-slash');
}

function checkReqs(val) {
    const checks = {
        len:   val.length >= 8,
        upper: /[A-Z]/.test(val),
        num:   /[0-9]/.test(val),
        spec:  /[\W_]/.test(val),
    };
    for (const [k, v] of Object.entries(checks)) {
        const el = document.getElementById('req-' + k);
        if (el) el.classList.toggle('ok', v);
    }
}

document.getElementById('formCambio').addEventListener('submit', function(e) {
    const p1  = document.getElementById('passNueva').value;
    const p2  = document.getElementById('passConfirm').value;
    const err = document.getElementById('passError');
    if (p1 !== p2) {
        e.preventDefault();
        err.classList.remove('d-none');
        document.getElementById('passConfirm').focus();
    } else {
        err.classList.add('d-none');
    }
});

document.getElementById('passConfirm').addEventListener('input', function () {
    const p1 = document.getElementById('passNueva').value;
    document.getElementById('passError').classList.toggle('d-none', this.value === p1 || this.value === '');
});
</script>
</body>
</html>
