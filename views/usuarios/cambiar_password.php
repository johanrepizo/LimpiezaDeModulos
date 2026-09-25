<?php
session_start();

// Evitar caché del navegador
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");

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
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        :root {
            --green:      #39a900;
            --green-dark: #2d8400;
            --green-soft: #f0faf0;
            --gray-50:    #f8fafc;
            --gray-100:   #f1f5f9;
            --gray-200:   #e2e8f0;
            --gray-500:   #64748b;
            --gray-700:   #334155;
            --gray-900:   #0f172a;
        }

        * { box-sizing: border-box; }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--gray-50);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1.5rem;
            margin: 0;
        }

        .change-card {
            max-width: 460px;
            width: 100%;
            background: #fff;
            border-radius: 16px;
            padding: 2.5rem 2.25rem;
            border: 1px solid var(--gray-200);
            box-shadow: 0 4px 24px rgba(0,0,0,.07);
        }

        .icon-box {
            width: 52px; height: 52px;
            border-radius: 12px;
            background: var(--green-soft);
            border: 1px solid #b7f0b7;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.4rem; color: var(--green);
            margin: 0 auto 1.25rem;
        }

        .card-title {
            font-size: 1.2rem;
            font-weight: 700;
            color: var(--gray-900);
            text-align: center;
            margin-bottom: .35rem;
        }

        .card-subtitle {
            font-size: .85rem;
            color: var(--gray-500);
            text-align: center;
            margin-bottom: 1.75rem;
        }

        .form-label {
            font-size: .82rem;
            font-weight: 600;
            color: var(--gray-700);
            margin-bottom: .4rem;
        }

        .input-group-text {
            background: var(--gray-100);
            border: 1px solid var(--gray-200);
            border-right: 0;
            color: var(--gray-500);
        }

        .form-control {
            background: #fff;
            border: 1px solid var(--gray-200);
            border-left: 0;
            color: var(--gray-900);
            padding: .68rem 1rem;
            font-size: .9rem;
        }

        .form-control:focus {
            background: #fff;
            box-shadow: none;
            border-color: var(--green);
            color: var(--gray-900);
        }

        .form-control::placeholder { color: #94a3b8; }

        .btn-eye {
            background: var(--gray-100);
            border: 1px solid var(--gray-200);
            border-left: 0;
            color: var(--gray-500);
        }
        .btn-eye:hover { color: var(--green); background: var(--gray-100); }

        /* cuando el input tiene foco, sincronizar borde del btn-eye */
        .input-group:focus-within .btn-eye,
        .input-group:focus-within .input-group-text {
            border-color: var(--green);
        }

        .req-box {
            background: var(--gray-50);
            border: 1px solid var(--gray-200);
            border-radius: 8px;
            padding: .75rem 1rem;
            margin-top: .5rem;
            margin-bottom: 1rem;
        }

        .req-item {
            font-size: .78rem;
            color: #94a3b8;
            margin-bottom: .2rem;
            display: flex;
            align-items: center;
            gap: .4rem;
            transition: color .2s;
        }
        .req-item i { font-size: .55rem; }
        .req-item.ok { color: var(--green); }

        .btn-guardar {
            background: var(--green);
            color: #fff;
            border: none;
            border-radius: 8px;
            font-size: .95rem;
            font-weight: 600;
            padding: .75rem;
            width: 100%;
            transition: background .2s, transform .15s, box-shadow .2s;
            box-shadow: 0 4px 14px rgba(57,169,0,.25);
        }
        .btn-guardar:hover {
            background: var(--green-dark);
            transform: translateY(-1px);
            box-shadow: 0 6px 18px rgba(57,169,0,.3);
        }

        .text-danger-soft {
            font-size: .8rem;
            color: #ef4444;
        }
    </style>
    <script>
        window.addEventListener('pageshow', function(e) {
            if (e.persisted) { window.location.reload(); }
        });
    </script>
</head>
<body>

<div class="change-card">

    <div class="icon-box"><i class="fas fa-key"></i></div>
    <div class="card-title">Cambio de contraseña</div>
    <div class="card-subtitle">
        Por seguridad debes establecer una nueva contraseña antes de continuar.
    </div>

    <form action="../../controllers/AuthController.php?accion=cambiar_password" method="POST" id="formCambio">

        <div class="mb-3">
            <label class="form-label">Contraseña actual (temporal)</label>
            <div class="input-group">
                <span class="input-group-text"><i class="fas fa-lock-open fa-sm"></i></span>
                <input type="password" name="password_actual" id="passActual"
                       class="form-control" placeholder="Tu contraseña temporal" required>
                <button type="button" class="btn btn-eye" onclick="togglePass('passActual','eyeActual')">
                    <i class="fas fa-eye fa-sm" id="eyeActual"></i>
                </button>
            </div>
        </div>

        <div class="mb-1">
            <label class="form-label">Nueva contraseña</label>
            <div class="input-group">
                <span class="input-group-text"><i class="fas fa-lock fa-sm"></i></span>
                <input type="password" name="password_nueva" id="passNueva"
                       class="form-control" placeholder="Mín. 8 caracteres"
                       required oninput="checkReqs(this.value)">
                <button type="button" class="btn btn-eye" onclick="togglePass('passNueva','eyeNueva')">
                    <i class="fas fa-eye fa-sm" id="eyeNueva"></i>
                </button>
            </div>
        </div>

        <!-- Requisitos -->
        <div class="req-box">
            <div id="req-len"   class="req-item"><i class="fas fa-circle"></i> Al menos 8 caracteres</div>
            <div id="req-upper" class="req-item"><i class="fas fa-circle"></i> Al menos una letra mayúscula</div>
            <div id="req-num"   class="req-item"><i class="fas fa-circle"></i> Al menos un número</div>
            <div id="req-spec"  class="req-item"><i class="fas fa-circle"></i> Al menos un carácter especial (!@#$...)</div>
        </div>

        <div class="mb-4">
            <label class="form-label">Confirmar nueva contraseña</label>
            <div class="input-group">
                <span class="input-group-text"><i class="fas fa-lock fa-sm"></i></span>
                <input type="password" name="password_confirm" id="passConfirm"
                       class="form-control" placeholder="Repite la contraseña" required>
                <button type="button" class="btn btn-eye" onclick="togglePass('passConfirm','eyeConfirm')">
                    <i class="fas fa-eye fa-sm" id="eyeConfirm"></i>
                </button>
            </div>
            <div id="passError" class="text-danger-soft d-none mt-2">
                <i class="fas fa-circle-exclamation me-1"></i> Las contraseñas no coinciden.
            </div>
        </div>

        <button type="submit" class="btn-guardar">
            <i class="fas fa-shield-halved me-2"></i> Guardar nueva contraseña
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
            confirmButtonColor: '#39a900'
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
