<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GestiLimpieza – SENA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --green:      #39a900;
            --green-dark: #2d8400;
            --green-soft: #f0faf0;
            --gray-100:   #f8fafc;
            --gray-200:   #f1f5f9;
            --gray-600:   #64748b;
            --gray-800:   #1e293b;
            --dark:       #0a1a00;
        }
        * { box-sizing: border-box; }
        body {
            font-family: 'Inter', sans-serif;
            color: var(--gray-800);
            background: #fff;
            margin: 0;
        }

        /* ── NAVBAR ── */
        .navbar {
            background: #fff;
            border-bottom: 1px solid #e2e8f0;
            padding: .9rem 0;
            position: sticky; top: 0; z-index: 999;
        }
        .navbar-brand {
            display: flex; align-items: center; gap: .6rem;
            font-weight: 700; font-size: 1.1rem; color: var(--gray-800);
            text-decoration: none;
        }
        .brand-dot {
            width: 34px; height: 34px; border-radius: 8px;
            background: var(--green);
            display: flex; align-items: center; justify-content: center;
            color: #fff; font-size: .9rem;
        }
        .nav-link {
            color: var(--gray-600) !important;
            font-weight: 500; font-size: .9rem;
            padding: .4rem .8rem !important;
            border-radius: 6px;
            transition: color .15s, background .15s;
        }
        .nav-link:hover { color: var(--green) !important; background: var(--green-soft); }
        .btn-acceder {
            background: var(--green); color: #fff;
            border: none; border-radius: 8px;
            padding: .5rem 1.4rem;
            font-weight: 600; font-size: .9rem;
            transition: background .2s, transform .15s;
            text-decoration: none;
        }
        .btn-acceder:hover { background: var(--green-dark); color: #fff; transform: translateY(-1px); }

        /* ── HERO ── */
        .hero {
            background: linear-gradient(150deg, #f8fff4 0%, #ffffff 50%, #f0faf0 100%);
            padding: 90px 0 80px;
            border-bottom: 1px solid #e2e8f0;
        }
        .hero-badge {
            display: inline-flex; align-items: center; gap: .5rem;
            background: var(--green-soft); color: var(--green);
            border: 1px solid #b7f0b7;
            border-radius: 20px; padding: .35rem .9rem;
            font-size: .8rem; font-weight: 600;
            margin-bottom: 1.5rem;
        }
        .hero h1 {
            font-size: clamp(2rem, 5vw, 3.2rem);
            font-weight: 800; line-height: 1.15;
            color: var(--gray-800);
            margin-bottom: 1.2rem;
        }
        .hero h1 span { color: var(--green); }
        .hero p {
            font-size: 1.05rem; color: var(--gray-600);
            max-width: 520px; line-height: 1.7;
            margin-bottom: 2rem;
        }
        .btn-hero-primary {
            background: var(--green); color: #fff;
            border: none; border-radius: 10px;
            padding: .8rem 2rem; font-weight: 600;
            font-size: 1rem; text-decoration: none;
            transition: background .2s, transform .15s, box-shadow .2s;
            display: inline-flex; align-items: center; gap: .5rem;
            box-shadow: 0 4px 14px rgba(57,169,0,.3);
        }
        .btn-hero-primary:hover { background: var(--green-dark); color: #fff; transform: translateY(-2px); box-shadow: 0 6px 20px rgba(57,169,0,.35); }
        .hero-visual {
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 20px;
            padding: 2rem;
            box-shadow: 0 8px 32px rgba(0,0,0,.07);
        }
        .stat-pill {
            background: var(--green-soft); border: 1px solid #b7f0b7;
            border-radius: 10px; padding: .75rem 1.2rem;
            display: flex; align-items: center; gap: .75rem;
        }
        .stat-pill-icon {
            width: 36px; height: 36px; border-radius: 8px;
            background: var(--green); color: #fff;
            display: flex; align-items: center; justify-content: center;
            font-size: .9rem; flex-shrink: 0;
        }
        .stat-pill-label { font-size: .75rem; color: var(--gray-600); }
        .stat-pill-val { font-weight: 700; font-size: .95rem; color: var(--gray-800); }

        /* ── SECCIONES ── */
        .section-label {
            display: inline-block;
            background: var(--green-soft); color: var(--green);
            border-radius: 20px; padding: .3rem .9rem;
            font-size: .78rem; font-weight: 600;
            margin-bottom: .75rem;
        }
        .section-title { font-size: clamp(1.5rem, 3vw, 2rem); font-weight: 800; margin-bottom: .5rem; }
        .section-sub { color: var(--gray-600); max-width: 560px; }

        /* ── FEATURES ── */
        .feature-card {
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 14px;
            padding: 1.75rem;
            height: 100%;
            transition: transform .2s, box-shadow .2s, border-color .2s;
        }
        .feature-card:hover { transform: translateY(-4px); box-shadow: 0 12px 32px rgba(0,0,0,.08); border-color: #b7f0b7; }
        .feature-icon {
            width: 48px; height: 48px; border-radius: 12px;
            background: var(--green-soft); color: var(--green);
            display: flex; align-items: center; justify-content: center;
            font-size: 1.2rem; margin-bottom: 1rem;
        }
        .feature-card h5 { font-weight: 700; font-size: .95rem; margin-bottom: .4rem; }
        .feature-card p { font-size: .85rem; color: var(--gray-600); margin: 0; line-height: 1.6; }

        /* ── ROLES ── */
        .role-card {
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            padding: 2rem;
            background: #fff;
        }
        .role-card.admin { border-top: 4px solid #2563eb; }
        .role-card.vocero { border-top: 4px solid var(--green); }
        .role-icon {
            width: 52px; height: 52px; border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.3rem; color: #fff; margin-bottom: 1rem;
        }
        .role-icon.green { background: var(--green); }
        .role-icon.blue  { background: #2563eb; }
        .role-list li {
            font-size: .875rem; color: var(--gray-600);
            padding: .3rem 0;
            display: flex; align-items: flex-start; gap: .5rem;
        }
        .role-list li i { color: var(--green); margin-top: 3px; flex-shrink: 0; }
        .role-list.blue li i { color: #2563eb; }

        /* ── CTA ── */
        .cta-section {
            background: linear-gradient(135deg, var(--dark) 0%, #1a3a00 100%);
            padding: 80px 0;
        }

        /* ── FOOTER ── */
        footer {
            background: var(--gray-800);
            color: #94a3b8;
            padding: 3rem 0 2rem;
        }
        footer a { color: #94a3b8; text-decoration: none; }
        footer a:hover { color: #fff; }
        .footer-brand { color: #fff; font-weight: 700; font-size: 1.05rem; }
        .footer-divider { border-color: #334155; }
    </style>
</head>
<body>

<!-- ══ NAVBAR ═══════════════════════════════════════════════════════════════ -->
<nav class="navbar navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand" href="#">
            <div class="brand-dot"><i class="fas fa-broom"></i></div>
            GestiLimpieza
        </a>
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navMain">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navMain">
            <ul class="navbar-nav mx-auto gap-1">
                <li class="nav-item"><a class="nav-link" href="#inicio">Inicio</a></li>
                <li class="nav-item"><a class="nav-link" href="#funcionalidades">Funcionalidades</a></li>
                <li class="nav-item"><a class="nav-link" href="#roles">Roles</a></li>
            </ul>
            <a href="../views/usuarios/login.php" class="btn-acceder">
                <i class="fas fa-arrow-right-to-bracket me-1"></i> Acceder
            </a>
        </div>
    </div>
</nav>

<!-- ══ HERO ═════════════════════════════════════════════════════════════════ -->
<section id="inicio" class="hero">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6">
                <div class="hero-badge">
                    <i class="fas fa-rotate"></i> Integrado con SICEFA
                </div>
                <h1>Gestión de Limpieza de <span>Módulos</span> SENA</h1>
                <p>Plataforma centralizada para el registro, seguimiento y verificación
                   del proceso de limpieza de módulos académicos, con evidencias fotográficas
                   y control de cumplimiento en tiempo real.</p>
                <div class="d-flex gap-3 flex-wrap">
                    <a href="../views/usuarios/login.php" class="btn-hero-primary">
                        <i class="fas fa-arrow-right-to-bracket"></i> Acceder al sistema
                    </a>
                    <a href="#funcionalidades" class="btn btn-outline-secondary border-2 rounded-3 px-4 fw-600">
                        Ver funcionalidades
                    </a>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="hero-visual">
                    <div class="d-flex align-items-center gap-2 mb-4 pb-3" style="border-bottom:1px solid #e2e8f0;">
                        <div class="brand-dot" style="width:28px;height:28px;font-size:.75rem;"></div>
                        <span class="fw-600 small" style="font-weight:600;">Panel de Control — GestiLimpieza</span>
                        <span class="badge bg-success ms-auto" style="font-size:.7rem;">En línea</span>
                    </div>
                    <div class="row g-3">
                        <div class="col-6">
                            <div class="stat-pill">
                                <div class="stat-pill-icon"><i class="fas fa-people-group"></i></div>
                                <div>
                                    <div class="stat-pill-label">Grupos activos</div>
                                    <div class="stat-pill-val">Rotación semanal</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="stat-pill" style="background:#f0f9ff;border-color:#bae6fd;">
                                <div class="stat-pill-icon" style="background:#2563eb;"><i class="fas fa-images"></i></div>
                                <div>
                                    <div class="stat-pill-label">Evidencias</div>
                                    <div class="stat-pill-val">Verificación foto</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="stat-pill" style="background:#fffbeb;border-color:#fde68a;">
                                <div class="stat-pill-icon" style="background:#d97706;"><i class="fas fa-bell"></i></div>
                                <div>
                                    <div class="stat-pill-label">Notificaciones</div>
                                    <div class="stat-pill-val">Alertas en tiempo real</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="stat-pill">
                                <div class="stat-pill-icon"><i class="fas fa-user-tie"></i></div>
                                <div>
                                    <div class="stat-pill-label">Voceros</div>
                                    <div class="stat-pill-val">Acceso por ficha</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-3 p-3 rounded-3 d-flex align-items-center gap-2"
                         style="background:var(--green-soft); border:1px solid #b7f0b7;">
                        <i class="fas fa-circle-check text-success"></i>
                        <span class="small" style="color:var(--green); font-weight:500;">
                            Sincronización SICEFA activa — datos actualizados
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ══ FUNCIONALIDADES ═══════════════════════════════════════════════════════ -->
<section id="funcionalidades" class="py-5" style="background:var(--gray-100);">
    <div class="container py-4">
        <div class="text-center mb-5">
            <span class="section-label">Funcionalidades</span>
            <h2 class="section-title">Todo lo que necesitas en un solo lugar</h2>
            <p class="section-sub mx-auto text-muted">
                Diseñado para simplificar la administración del proceso de limpieza de módulos del centro de formación.
            </p>
        </div>
        <div class="row g-3">
            <?php
            $features = [
                ['fas fa-graduation-cap', 'Programas y Fichas',   'Gestiona los programas de formación y fichas del centro con información sincronizada de SICEFA.'],
                ['fas fa-door-open',      'Módulos y Asignaciones','Crea módulos físicos y asígnalos a fichas con rotación semanal automática de grupos.'],
                ['fas fa-people-group',   'Grupos de Limpieza',    'Los voceros crean grupos de aprendices. El sistema asigna las fechas automáticamente por rotación.'],
                ['fas fa-camera',         'Evidencias Fotográficas','El vocero sube una foto del módulo limpio. El sistema registra fecha, hora y grupo responsable.'],
                ['fas fa-bell',           'Notificaciones',        'Alertas automáticas cuando una ficha incumple con la entrega de evidencias en el plazo establecido.'],
                ['fas fa-users',          'Gestión de Aprendices', 'Lista completa de aprendices por ficha con datos de contacto. Activa voceros con un solo clic.'],
            ];
            foreach ($features as [$icon, $title, $desc]): ?>
            <div class="col-md-6 col-lg-4">
                <div class="feature-card">
                    <div class="feature-icon"><i class="<?= $icon ?>"></i></div>
                    <h5><?= $title ?></h5>
                    <p><?= $desc ?></p>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- ══ ROLES ════════════════════════════════════════════════════════════════ -->
<section id="roles" class="py-5 bg-white">
    <div class="container py-4">
        <div class="text-center mb-5">
            <span class="section-label">Roles</span>
            <h2 class="section-title">Dos perfiles de acceso</h2>
            <p class="section-sub mx-auto text-muted">
                El sistema cuenta con dos roles claramente diferenciados, cada uno con permisos específicos.
            </p>
        </div>
        <div class="row g-4 justify-content-center">
            <div class="col-md-5">
                <div class="role-card vocero">
                    <div class="role-icon green"><i class="fas fa-user-tie"></i></div>
                    <h5 class="fw-700 mb-1" style="font-weight:700;">Vocero</h5>
                    <p class="text-muted small mb-3">Aprendiz designado por el administrador para gestionar la limpieza de su ficha.</p>
                    <ul class="role-list list-unstyled">
                        <li><i class="fas fa-check-circle fa-sm"></i> Ver aprendices de su ficha</li>
                        <li><i class="fas fa-check-circle fa-sm"></i> Crear grupos de limpieza</li>
                        <li><i class="fas fa-check-circle fa-sm"></i> Subir evidencias fotográficas</li>
                        <li><i class="fas fa-check-circle fa-sm"></i> Ver historial de turnos</li>
                        <li><i class="fas fa-check-circle fa-sm"></i> Recibir notificaciones</li>
                    </ul>
                </div>
            </div>
            <div class="col-md-5">
                <div class="role-card admin">
                    <div class="role-icon blue"><i class="fas fa-shield-halved"></i></div>
                    <h5 class="fw-700 mb-1" style="font-weight:700;">Administrador</h5>
                    <p class="text-muted small mb-3">Gestiona todo el sistema de forma centralizada desde el panel de control.</p>
                    <ul class="role-list blue list-unstyled">
                        <li><i class="fas fa-check-circle fa-sm"></i> Gestionar programas, fichas y módulos</li>
                        <li><i class="fas fa-check-circle fa-sm"></i> Asignar módulos con rotación semanal</li>
                        <li><i class="fas fa-check-circle fa-sm"></i> Activar y gestionar voceros</li>
                        <li><i class="fas fa-check-circle fa-sm"></i> Revisar evidencias por ficha</li>
                        <li><i class="fas fa-check-circle fa-sm"></i> Monitorear incumplimientos</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ══ CTA ══════════════════════════════════════════════════════════════════ -->
<section class="cta-section text-white text-center">
    <div class="container">
        <h2 class="fw-800 mb-3" style="font-weight:800;">¿Listo para empezar?</h2>
        <p class="mb-4" style="color:rgba(255,255,255,.7); max-width:480px; margin:0 auto 1.5rem;">
            Accede con las credenciales que te envió el administrador y comienza a gestionar la limpieza de tu módulo.
        </p>
        <a href="../views/usuarios/login.php" class="btn-hero-primary" style="box-shadow:0 4px 20px rgba(57,169,0,.4);">
            <i class="fas fa-arrow-right-to-bracket"></i> Acceder al sistema
        </a>
    </div>
</section>

<!-- ══ FOOTER ═══════════════════════════════════════════════════════════════ -->
<footer>
    <div class="container">
        <div class="row g-4 pb-4">
            <div class="col-md-4">
                <div class="d-flex align-items-center gap-2 mb-3">
                    <div class="brand-dot"><i class="fas fa-broom"></i></div>
                    <span class="footer-brand">GestiLimpieza</span>
                </div>
                <p class="small mb-0" style="line-height:1.7;">
                    Sistema para la gestión del proceso de limpieza de módulos del SENA,
                    integrado con SICEFA para sincronización automática de datos.
                </p>
            </div>
            <div class="col-md-4">
                <h6 class="text-white fw-600 mb-3" style="font-weight:600;">Acceso rápido</h6>
                <ul class="list-unstyled small">
                    <li class="mb-1"><a href="../views/usuarios/login.php">Iniciar sesión</a></li>
                    <li class="mb-1"><a href="#funcionalidades">Funcionalidades</a></li>
                    <li><a href="#roles">Roles del sistema</a></li>
                </ul>
            </div>
            <div class="col-md-4">
                <h6 class="text-white fw-600 mb-3" style="font-weight:600;">Contacto</h6>
                <p class="small mb-1"><i class="fas fa-envelope me-2"></i>soporte@sena.edu.co</p>
                <p class="small mb-0"><i class="fas fa-globe me-2"></i>www.sena.edu.co</p>
            </div>
        </div>
        <hr class="footer-divider">
        <p class="text-center small mb-0" style="color:#64748b;">
            &copy; <?= date('Y') ?> GestiLimpieza SENA &mdash; Centro de Formación Agroindustrial · Regional Huila
        </p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
