<?php
session_start();

// Si ya hay sesión activa, redirigir directamente al dashboard correspondiente
if (isset($_SESSION['usuario'])) {
    $rol = (int)($_SESSION['usuario']['rol'] ?? 0);
    if ($rol === 1) {
        header("Location: ../dashboard/admin_dashboard.php"); exit;
    } else {
        header("Location: ../dashboard/vocero_dashboard.php"); exit;
    }
}

$alert      = $_SESSION['alert'] ?? null;
unset($_SESSION['alert']);
$abrirPanel = ($_GET['panel'] ?? '') === 'recuperar';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión – GestiLimpieza SENA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        :root {
            --green:       #39a900;
            --green-dark:  #2d8400;
            --green-soft:  #f0faf0;
            --gray-50:     #f8fafc;
            --gray-100:    #f1f5f9;
            --gray-200:    #e2e8f0;
            --gray-500:    #64748b;
            --gray-700:    #334155;
            --gray-900:    #0f172a;
        }

        * { box-sizing: border-box; }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--gray-50);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            margin: 0;
        }

        /* ── TOPBAR ── */
        .topbar {
            background: #fff;
            border-bottom: 1px solid var(--gray-200);
            padding: .75rem 0;
        }
        .topbar-brand {
            display: flex; align-items: center; gap: .55rem;
            font-weight: 700; font-size: 1rem; color: var(--gray-900);
            text-decoration: none;
        }
        .brand-icon {
            width: 32px; height: 32px; border-radius: 8px;
            background: var(--green); color: #fff;
            display: flex; align-items: center; justify-content: center;
            font-size: .82rem;
        }
        .btn-back {
            font-size: .85rem; color: var(--gray-500);
            text-decoration: none; font-weight: 500;
            display: flex; align-items: center; gap: .35rem;
            transition: color .15s;
        }
        .btn-back:hover { color: var(--green); }

        /* ── LAYOUT ── */
        .login-wrapper {
            flex: 1;
            display: flex;
            align-items: stretch;
        }

        /* ── PANEL IZQUIERDO ── */
        .panel-left {
            background: linear-gradient(160deg, #0a1a00 0%, #1b4200 60%, #0d2800 100%);
            display: flex; flex-direction: column; justify-content: center;
            padding: 3.5rem;
            position: relative; overflow: hidden;
        }
        .panel-left::before {
            content: '';
            position: absolute; inset: 0; opacity: .4;
            background-image: radial-gradient(circle at 30% 70%, rgba(57,169,0,.25) 0%, transparent 60%),
                              radial-gradient(circle at 80% 20%, rgba(57,169,0,.15) 0%, transparent 50%);
        }
        .panel-left-inner { position: relative; z-index: 1; }
        .pl-badge {
            display: inline-flex; align-items: center; gap: .5rem;
            background: rgba(57,169,0,.15); color: #7ddd5a;
            border: 1px solid rgba(57,169,0,.25); border-radius: 20px;
            padding: .3rem .85rem; font-size: .78rem; font-weight: 600;
            margin-bottom: 2rem;
        }
        .panel-left h2 {
            color: #fff; font-size: 2rem; font-weight: 800;
            line-height: 1.2; margin-bottom: 1rem;
        }
        .panel-left p {
            color: rgba(255,255,255,.6); font-size: .9rem; line-height: 1.7;
            margin-bottom: 2rem; max-width: 320px;
        }
        .pl-feature {
            display: flex; align-items: center; gap: .65rem;
            color: rgba(255,255,255,.65); font-size: .83rem;
            margin-bottom: .7rem;
        }
        .pl-feature-dot {
            width: 28px; height: 28px; border-radius: 7px;
            background: rgba(57,169,0,.2); color: #7ddd5a;
            display: flex; align-items: center; justify-content: center;
            font-size: .75rem; flex-shrink: 0;
        }

        /* ── PANEL DERECHO ── */
        .panel-right {
            background: #fff;
            display: flex; flex-direction: column; justify-content: center;
            padding: 3rem 3.5rem;
        }
        .login-title {
            font-size: 1.65rem; font-weight: 800;
            color: var(--gray-900); margin-bottom: .35rem;
        }
        .login-sub {
            font-size: .875rem; color: var(--gray-500);
            margin-bottom: 2rem;
        }

        /* ── FORM ── */
        .form-label {
            font-size: .82rem; font-weight: 600;
            color: var(--gray-700); margin-bottom: .4rem;
        }
        .input-wrap {
            position: relative;
        }
        .input-icon {
            position: absolute; left: .9rem; top: 50%; transform: translateY(-50%);
            color: var(--gray-500); font-size: .85rem; pointer-events: none;
            z-index: 2;
        }
        .form-field {
            width: 100%; border: 1.5px solid var(--gray-200);
            border-radius: 10px; padding: .72rem .9rem .72rem 2.5rem;
            font-size: .9rem; color: var(--gray-900);
            font-family: 'Inter', sans-serif;
            background: var(--gray-50);
            transition: border-color .2s, box-shadow .2s, background .2s;
            outline: none;
        }
        .form-field:focus {
            border-color: var(--green);
            background: #fff;
            box-shadow: 0 0 0 3px rgba(57,169,0,.1);
        }
        .form-field::placeholder { color: #adb5bd; }
        .btn-toggle-pass {
            position: absolute; right: .75rem; top: 50%; transform: translateY(-50%);
            background: none; border: none; color: var(--gray-500);
            cursor: pointer; padding: .2rem; font-size: .9rem;
            transition: color .15s;
        }
        .btn-toggle-pass:hover { color: var(--green); }
        .field-with-toggle .form-field { padding-right: 2.5rem; }

        .link-forgot {
            font-size: .8rem; color: var(--green);
            background: none; border: none; padding: 0;
            cursor: pointer; text-decoration: none; font-weight: 500;
        }
        .link-forgot:hover { text-decoration: underline; }

        .btn-login {
            width: 100%; padding: .8rem;
            background: var(--green); color: #fff;
            border: none; border-radius: 10px;
            font-size: .95rem; font-weight: 700;
            cursor: pointer;
            transition: background .2s, transform .15s, box-shadow .2s;
            box-shadow: 0 4px 14px rgba(57,169,0,.3);
            display: flex; align-items: center; justify-content: center; gap: .5rem;
        }
        .btn-login:hover { background: var(--green-dark); transform: translateY(-1px); box-shadow: 0 6px 20px rgba(57,169,0,.35); }

        .divider {
            display: flex; align-items: center; gap: .75rem;
            color: var(--gray-500); font-size: .78rem; margin: 1.5rem 0;
        }
        .divider::before, .divider::after {
            content: ''; flex: 1; height: 1px; background: var(--gray-200);
        }

        .login-footer-text {
            font-size: .8rem; color: var(--gray-500);
            text-align: center; margin-top: 1.5rem;
        }

        /* ── MODAL ── */
        .modal-content {
            border: 1px solid var(--gray-200);
            border-radius: 16px;
            box-shadow: 0 20px 60px rgba(0,0,0,.12);
        }
        .modal-hdr {
            border-bottom: 1px solid var(--gray-200);
            padding: 1.25rem 1.5rem;
        }
        .modal-hdr h6 { font-weight: 700; color: var(--gray-900); margin: 0; }
        .modal-footer { border-top: 1px solid var(--gray-200); }

        /* Inputs del modal */
        .modal .form-control {
            border: 1.5px solid var(--gray-200); border-radius: 9px;
            font-size: .875rem; padding: .65rem .9rem;
            transition: border-color .2s, box-shadow .2s;
        }
        .modal .form-control:focus {
            border-color: var(--green); box-shadow: 0 0 0 3px rgba(57,169,0,.1);
        }
        .modal .input-group-text {
            background: var(--gray-50); border: 1.5px solid var(--gray-200);
            border-right: 0; color: var(--gray-500); border-radius: 9px 0 0 9px;
        }
        .modal .form-control { border-left: 0; border-radius: 0 9px 9px 0; }
        .modal .btn-eye {
            background: var(--gray-50); border: 1.5px solid var(--gray-200);
            border-left: 0; color: var(--gray-500); border-radius: 0 9px 9px 0;
        }
        .modal .btn-eye:hover { color: var(--green); }
        .req-item { font-size: .78rem; color: #adb5bd; margin-bottom: .2rem; transition: color .2s; }
        .req-item.ok { color: var(--green); }

        @media (max-width: 767px) {
            .panel-left { display: none !important; }
            .panel-right { padding: 2rem 1.5rem; }
            .login-wrapper { align-items: flex-start; }
        }
    </style>
</head>
<body>

<!-- ── TOPBAR ── -->
<nav class="topbar">
    <div class="container d-flex align-items-center justify-content-between">
        <a href="../../public/index.php" class="topbar-brand">
            <div class="brand-icon"><i class="fas fa-broom"></i></div>
            GestiLimpieza
        </a>
        <a href="../../public/index.php" class="btn-back">
            <i class="fas fa-arrow-left"></i> Volver al inicio
        </a>
    </div>
</nav>

<!-- ── LAYOUT ── -->
<div class="login-wrapper">
    <div class="container-fluid p-0 d-flex" style="flex:1;">

        <!-- Panel izquierdo -->
        <div class="col-md-5 col-lg-5 panel-left d-none d-md-flex flex-column">
            <div class="panel-left-inner">
                <div class="pl-badge">
                    <i class="fas fa-rotate fa-sm"></i> Integrado con SICEFA
                </div>
                <h2>Gestión de<br>Limpieza de<br>Módulos</h2>
                <p>Plataforma oficial del SENA para el registro, seguimiento y verificación del proceso de limpieza de módulos académicos.</p>

                <div class="pl-feature">
                    <div class="pl-feature-dot"><i class="fas fa-shield-halved"></i></div>
                    Acceso seguro con credenciales institucionales
                </div>
                <div class="pl-feature">
                    <div class="pl-feature-dot"><i class="fas fa-camera"></i></div>
                    Evidencias fotográficas por módulo y turno
                </div>
                <div class="pl-feature">
                    <div class="pl-feature-dot"><i class="fas fa-bell"></i></div>
                    Notificaciones de incumplimiento
                </div>
                <div class="pl-feature">
                    <div class="pl-feature-dot"><i class="fas fa-people-group"></i></div>
                    Rotación automática de grupos semanal
                </div>
            </div>
        </div>

        <!-- Panel derecho -->
        <div class="col-md-7 col-lg-7 panel-right">
            <div style="max-width: 420px; width: 100%; margin: 0 auto;">

                <!-- Mobile brand -->
                <div class="d-md-none text-center mb-4">
                    <div class="brand-icon mx-auto mb-2" style="width:44px;height:44px;font-size:1.1rem;border-radius:10px;">
                        <i class="fas fa-broom"></i>
                    </div>
                    <span style="font-weight:700;font-size:1rem;">GestiLimpieza</span>
                </div>

                <h4 class="login-title">Iniciar sesión</h4>
                <p class="login-sub">Ingresa las credenciales enviadas a tu correo institucional</p>

                <form action="../../controllers/AuthController.php" method="POST">

                    <div class="mb-3">
                        <label class="form-label">Correo institucional</label>
                        <div class="input-wrap">
                            <i class="fas fa-envelope input-icon"></i>
                            <input type="email" name="correo" class="form-field"
                                   placeholder="usuario@sena.edu.co" required autocomplete="username">
                        </div>
                    </div>

                    <div class="mb-2">
                        <label class="form-label">Contraseña</label>
                        <div class="input-wrap field-with-toggle">
                            <i class="fas fa-lock input-icon"></i>
                            <input type="password" name="password" id="passLogin"
                                   class="form-field" placeholder="••••••••" required autocomplete="current-password">
                            <button type="button" class="btn-toggle-pass"
                                    onclick="togglePass('passLogin','eyeLogin')">
                                <i class="fas fa-eye" id="eyeLogin"></i>
                            </button>
                        </div>
                    </div>

                    <div class="text-end mb-4">
                        <button type="button" class="link-forgot"
                                data-bs-toggle="modal" data-bs-target="#modalRecuperar">
                            ¿Olvidaste tu contraseña?
                        </button>
                    </div>

                    <button type="submit" class="btn-login">
                        <i class="fas fa-arrow-right-to-bracket"></i>
                        Ingresar al sistema
                    </button>

                </form>

                <div class="login-footer-text">
                    ¿No recibiste tus credenciales?
                    <button type="button" class="link-forgot fw-semibold"
                            data-bs-toggle="modal" data-bs-target="#modalRecuperar">
                        Contacta al administrador
                    </button>
                </div>

            </div>
        </div>

    </div>
</div>


<!-- ══ Modal Recuperar ══════════════════════════════════════════════════════ -->
<div class="modal fade" id="modalRecuperar" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-hdr d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center gap-2">
                    <div style="width:32px;height:32px;background:var(--green-soft);color:var(--green);border-radius:8px;display:flex;align-items:center;justify-content:center;">
                        <i class="fas fa-key fa-sm"></i>
                    </div>
                    <h6>Restablecer Contraseña</h6>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form action="../../controllers/AuthController.php?accion=recuperar" method="POST" id="formRecuperar">
                <div class="modal-body px-4 py-4">
                    <p class="text-muted small mb-4">
                        Ingresa tu correo institucional y crea una nueva contraseña segura.
                    </p>

                    <div class="mb-4">
                        <label class="form-label fw-semibold small">Correo Institucional</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                            <input type="email" name="correo" class="form-control"
                                   placeholder="usuario@sena.edu.co" required>
                        </div>
                    </div>

                    <hr class="my-3">

                    <div class="mb-3">
                        <label class="form-label fw-semibold small">Nueva Contraseña</label>
                        <div class="input-group mb-2">
                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                            <input type="password" name="password_nueva" id="passNueva"
                                   class="form-control" placeholder="Mín. 8 caracteres"
                                   required oninput="checkStrength(this.value)">
                            <button type="button" class="btn btn-eye"
                                    onclick="togglePass('passNueva','eyeNueva')">
                                <i class="fas fa-eye" id="eyeNueva"></i>
                            </button>
                        </div>
                        <div class="progress mb-1" style="height:4px;">
                            <div id="strengthBar" class="progress-bar" style="width:0%;transition:all .3s;"></div>
                        </div>
                        <div id="strengthText" style="font-size:.74rem;min-height:1rem;color:var(--gray-500);"></div>
                    </div>

                    <div class="mb-4 p-3 rounded-3" id="reqBox"
                         style="display:none;background:var(--gray-50);border:1px solid var(--gray-200);">
                        <div id="req-len"   class="req-item"><i class="fas fa-circle me-1" style="font-size:.45rem;"></i> Al menos 8 caracteres</div>
                        <div id="req-upper" class="req-item"><i class="fas fa-circle me-1" style="font-size:.45rem;"></i> Al menos una mayúscula</div>
                        <div id="req-num"   class="req-item"><i class="fas fa-circle me-1" style="font-size:.45rem;"></i> Al menos un número</div>
                        <div id="req-spec"  class="req-item"><i class="fas fa-circle me-1" style="font-size:.45rem;"></i> Al menos un carácter especial</div>
                    </div>

                    <div class="mb-1">
                        <label class="form-label fw-semibold small">Confirmar Contraseña</label>
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
                </div>

                <div class="modal-footer px-4 py-3">
                    <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-sm fw-semibold px-4"
                            style="background:var(--green);border:none;color:#fff;border-radius:8px;">
                        <i class="fas fa-rotate-right me-1"></i> Restablecer
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php if ($alert): ?>
<script>
document.addEventListener('DOMContentLoaded', function () {
    Swal.fire({
        icon:  '<?= htmlspecialchars($alert['icon'])  ?>',
        title: '<?= htmlspecialchars($alert['title']) ?>',
        text:  '<?= htmlspecialchars($alert['text'])  ?>',
        confirmButtonText:  'Aceptar',
        confirmButtonColor: '#39a900'
    });
});
</script>
<?php endif; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
<?php if ($abrirPanel): ?>
document.addEventListener('DOMContentLoaded', function () {
    new bootstrap.Modal(document.getElementById('modalRecuperar')).show();
});
<?php endif; ?>

function togglePass(inputId, iconId) {
    const inp = document.getElementById(inputId);
    const ico = document.getElementById(iconId);
    if (!inp || !ico) return;
    inp.type = inp.type === 'password' ? 'text' : 'password';
    ico.classList.toggle('fa-eye');
    ico.classList.toggle('fa-eye-slash');
}

function checkStrength(val) {
    const bar    = document.getElementById('strengthBar');
    const text   = document.getElementById('strengthText');
    const box    = document.getElementById('reqBox');
    const checks = {
        len:   val.length >= 8,
        upper: /[A-Z]/.test(val),
        num:   /[0-9]/.test(val),
        spec:  /[\W_]/.test(val),
    };
    box.style.display = val.length ? 'block' : 'none';
    for (const [k, v] of Object.entries(checks)) {
        const el = document.getElementById('req-' + k);
        if (el) el.classList.toggle('ok', v);
    }
    const score  = Object.values(checks).filter(Boolean).length;
    const levels = [
        { pct:'20%', color:'#ef4444', label:'Muy débil'  },
        { pct:'40%', color:'#f97316', label:'Débil'      },
        { pct:'60%', color:'#eab308', label:'Regular'    },
        { pct:'80%', color:'#22c55e', label:'Fuerte'     },
        { pct:'100%',color:'#16a34a', label:'Muy fuerte' },
    ];
    const lvl = levels[Math.max(0, score - 1)];
    bar.style.width           = val.length ? lvl.pct   : '0%';
    bar.style.backgroundColor = val.length ? lvl.color : '';
    text.textContent          = val.length ? lvl.label : '';
}

document.getElementById('formRecuperar').addEventListener('submit', function(e) {
    const p1  = document.getElementById('passNueva').value;
    const p2  = document.getElementById('passConfirm').value;
    const err = document.getElementById('passError');
    if (p1 !== p2) { e.preventDefault(); err.classList.remove('d-none'); }
    else err.classList.add('d-none');
});

document.getElementById('passConfirm').addEventListener('input', function () {
    const p1 = document.getElementById('passNueva').value;
    document.getElementById('passError').classList.toggle('d-none', this.value === p1 || !this.value);
});
</script>
</body>
</html>
