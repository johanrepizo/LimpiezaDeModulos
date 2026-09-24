# Documentación Línea por Línea: `public/index.php`

## 1. Ficha Técnica del Archivo

- **Archivo:** `index.php`
- **Ruta en el proyecto:** `public/index.php`
- **Cantidad total de líneas:** `424`
- **Tipo de archivo:** `PHP`
- **Propósito general:** Punto de entrada principal (Landing page) de la aplicación web. Presenta información institucional, accesos y redirecciones según el estado de sesión.

---

## 2. Explicación Detallada Línea por Línea

A continuación se presenta cada línea de código numerada de forma consecutiva, acompañada de su fragmento exacto y la explicación exhaustiva de su funcionamiento y responsabilidad en el sistema:

| Línea | Código Fuente | Explicación Detallada |
|---|---|---|
| `1` | `<!DOCTYPE html>` | Declaración estándar del tipo de documento HTML5. |
| `2` | `<html lang="es">` | Etiqueta raíz que delimita el documento HTML. |
| `3` | `<head>` | Cabecera del documento web para inclusión de metadatos, fuentes y hojas de estilo. |
| `4` | `    <meta charset="UTF-8">` | Metadato de configuración de la página (charset, viewport, etc.): `<meta charset="UTF-8">`. |
| `5` | `    <meta name="viewport" content="width=device-width, initial-scale=1.0">` | Metadato de configuración de la página (charset, viewport, etc.): `<meta name="viewport" content="width=device-width, initial-scale=1.0">`. |
| `6` | `    <title>GestiLimpieza – SENA</title>` | Título de la pestaña de navegación de la página web: `<title>GestiLimpieza – SENA</title>`. |
| `7` | `    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/boots...` | Enlace externo a recursos de estilo CSS o fuentes web: `<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">`. |
| `8` | `    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fon...` | Enlace externo a recursos de estilo CSS o fuentes web: `<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">`. |
| `9` | `    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400...` | Enlace externo a recursos de estilo CSS o fuentes web: `<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">`. |
| `10` | `    <style>` | Instrucción de ejecución en el contexto del script: `<style>`. |
| `11` | `        :root {` | Instrucción de ejecución en el contexto del script: `:root {`. |
| `12` | `            --green:      #39a900;` | Instrucción de ejecución en el contexto del script: `--green:      #39a900;`. |
| `13` | `            --green-dark: #2d8400;` | Instrucción de ejecución en el contexto del script: `--green-dark: #2d8400;`. |
| `14` | `            --green-soft: #f0faf0;` | Instrucción de ejecución en el contexto del script: `--green-soft: #f0faf0;`. |
| `15` | `            --gray-100:   #f8fafc;` | Instrucción de ejecución en el contexto del script: `--gray-100:   #f8fafc;`. |
| `16` | `            --gray-200:   #f1f5f9;` | Instrucción de ejecución en el contexto del script: `--gray-200:   #f1f5f9;`. |
| `17` | `            --gray-600:   #64748b;` | Instrucción de ejecución en el contexto del script: `--gray-600:   #64748b;`. |
| `18` | `            --gray-800:   #1e293b;` | Instrucción de ejecución en el contexto del script: `--gray-800:   #1e293b;`. |
| `19` | `            --dark:       #0a1a00;` | Instrucción de ejecución en el contexto del script: `--dark:       #0a1a00;`. |
| `20` | `        }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `21` | `        * { box-sizing: border-box; }` | Comentario de bloque o anotación informativa dentro del código. |
| `22` | `        body {` | Instrucción de ejecución en el contexto del script: `body {`. |
| `23` | `            font-family: 'Inter', sans-serif;` | Instrucción de ejecución en el contexto del script: `font-family: 'Inter', sans-serif;`. |
| `24` | `            color: var(--gray-800);` | Instrucción de ejecución en el contexto del script: `color: var(--gray-800);`. |
| `25` | `            background: #fff;` | Instrucción de ejecución en el contexto del script: `background: #fff;`. |
| `26` | `            margin: 0;` | Instrucción de ejecución en el contexto del script: `margin: 0;`. |
| `27` | `        }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `28` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `29` | `        /* ── NAVBAR ── */` | Comentario de bloque o anotación informativa dentro del código. |
| `30` | `        .navbar {` | Instrucción de ejecución en el contexto del script: `.navbar {`. |
| `31` | `            background: #fff;` | Instrucción de ejecución en el contexto del script: `background: #fff;`. |
| `32` | `            border-bottom: 1px solid #e2e8f0;` | Instrucción de ejecución en el contexto del script: `border-bottom: 1px solid #e2e8f0;`. |
| `33` | `            padding: .9rem 0;` | Instrucción de ejecución en el contexto del script: `padding: .9rem 0;`. |
| `34` | `            position: sticky; top: 0; z-index: 999;` | Instrucción de ejecución en el contexto del script: `position: sticky; top: 0; z-index: 999;`. |
| `35` | `        }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `36` | `        .navbar-brand {` | Instrucción de ejecución en el contexto del script: `.navbar-brand {`. |
| `37` | `            display: flex; align-items: center; gap: .6rem;` | Instrucción de ejecución en el contexto del script: `display: flex; align-items: center; gap: .6rem;`. |
| `38` | `            font-weight: 700; font-size: 1.1rem; color: var(--gray-800);` | Instrucción de ejecución en el contexto del script: `font-weight: 700; font-size: 1.1rem; color: var(--gray-800);`. |
| `39` | `            text-decoration: none;` | Instrucción de ejecución en el contexto del script: `text-decoration: none;`. |
| `40` | `        }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `41` | `        .brand-dot {` | Instrucción de ejecución en el contexto del script: `.brand-dot {`. |
| `42` | `            width: 34px; height: 34px; border-radius: 8px;` | Instrucción de ejecución en el contexto del script: `width: 34px; height: 34px; border-radius: 8px;`. |
| `43` | `            background: var(--green);` | Instrucción de ejecución en el contexto del script: `background: var(--green);`. |
| `44` | `            display: flex; align-items: center; justify-content: center;` | Instrucción de ejecución en el contexto del script: `display: flex; align-items: center; justify-content: center;`. |
| `45` | `            color: #fff; font-size: .9rem;` | Instrucción de ejecución en el contexto del script: `color: #fff; font-size: .9rem;`. |
| `46` | `        }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `47` | `        .nav-link {` | Instrucción de ejecución en el contexto del script: `.nav-link {`. |
| `48` | `            color: var(--gray-600) !important;` | Instrucción de ejecución en el contexto del script: `color: var(--gray-600) !important;`. |
| `49` | `            font-weight: 500; font-size: .9rem;` | Instrucción de ejecución en el contexto del script: `font-weight: 500; font-size: .9rem;`. |
| `50` | `            padding: .4rem .8rem !important;` | Instrucción de ejecución en el contexto del script: `padding: .4rem .8rem !important;`. |
| `51` | `            border-radius: 6px;` | Instrucción de ejecución en el contexto del script: `border-radius: 6px;`. |
| `52` | `            transition: color .15s, background .15s;` | Instrucción de ejecución en el contexto del script: `transition: color .15s, background .15s;`. |
| `53` | `        }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `54` | `        .nav-link:hover { color: var(--green) !important; background: var(-...` | Instrucción de ejecución en el contexto del script: `.nav-link:hover { color: var(--green) !important; background: var(--green-soft); }`. |
| `55` | `        .btn-acceder {` | Instrucción de ejecución en el contexto del script: `.btn-acceder {`. |
| `56` | `            background: var(--green); color: #fff;` | Instrucción de ejecución en el contexto del script: `background: var(--green); color: #fff;`. |
| `57` | `            border: none; border-radius: 8px;` | Instrucción de ejecución en el contexto del script: `border: none; border-radius: 8px;`. |
| `58` | `            padding: .5rem 1.4rem;` | Instrucción de ejecución en el contexto del script: `padding: .5rem 1.4rem;`. |
| `59` | `            font-weight: 600; font-size: .9rem;` | Instrucción de ejecución en el contexto del script: `font-weight: 600; font-size: .9rem;`. |
| `60` | `            transition: background .2s, transform .15s;` | Instrucción de ejecución en el contexto del script: `transition: background .2s, transform .15s;`. |
| `61` | `            text-decoration: none;` | Instrucción de ejecución en el contexto del script: `text-decoration: none;`. |
| `62` | `        }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `63` | `        .btn-acceder:hover { background: var(--green-dark); color: #fff; tr...` | Instrucción de ejecución en el contexto del script: `.btn-acceder:hover { background: var(--green-dark); color: #fff; transform: translateY(-1px); }`. |
| `64` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `65` | `        /* ── HERO ── */` | Comentario de bloque o anotación informativa dentro del código. |
| `66` | `        .hero {` | Instrucción de ejecución en el contexto del script: `.hero {`. |
| `67` | `            background: linear-gradient(150deg, #f8fff4 0%, #ffffff 50%, #f...` | Instrucción de ejecución en el contexto del script: `background: linear-gradient(150deg, #f8fff4 0%, #ffffff 50%, #f0faf0 100%);`. |
| `68` | `            padding: 90px 0 80px;` | Instrucción de ejecución en el contexto del script: `padding: 90px 0 80px;`. |
| `69` | `            border-bottom: 1px solid #e2e8f0;` | Instrucción de ejecución en el contexto del script: `border-bottom: 1px solid #e2e8f0;`. |
| `70` | `        }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `71` | `        .hero-badge {` | Instrucción de ejecución en el contexto del script: `.hero-badge {`. |
| `72` | `            display: inline-flex; align-items: center; gap: .5rem;` | Instrucción de ejecución en el contexto del script: `display: inline-flex; align-items: center; gap: .5rem;`. |
| `73` | `            background: var(--green-soft); color: var(--green);` | Instrucción de ejecución en el contexto del script: `background: var(--green-soft); color: var(--green);`. |
| `74` | `            border: 1px solid #b7f0b7;` | Instrucción de ejecución en el contexto del script: `border: 1px solid #b7f0b7;`. |
| `75` | `            border-radius: 20px; padding: .35rem .9rem;` | Instrucción de ejecución en el contexto del script: `border-radius: 20px; padding: .35rem .9rem;`. |
| `76` | `            font-size: .8rem; font-weight: 600;` | Instrucción de ejecución en el contexto del script: `font-size: .8rem; font-weight: 600;`. |
| `77` | `            margin-bottom: 1.5rem;` | Instrucción de ejecución en el contexto del script: `margin-bottom: 1.5rem;`. |
| `78` | `        }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `79` | `        .hero h1 {` | Instrucción de ejecución en el contexto del script: `.hero h1 {`. |
| `80` | `            font-size: clamp(2rem, 5vw, 3.2rem);` | Instrucción de ejecución en el contexto del script: `font-size: clamp(2rem, 5vw, 3.2rem);`. |
| `81` | `            font-weight: 800; line-height: 1.15;` | Instrucción de ejecución en el contexto del script: `font-weight: 800; line-height: 1.15;`. |
| `82` | `            color: var(--gray-800);` | Instrucción de ejecución en el contexto del script: `color: var(--gray-800);`. |
| `83` | `            margin-bottom: 1.2rem;` | Instrucción de ejecución en el contexto del script: `margin-bottom: 1.2rem;`. |
| `84` | `        }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `85` | `        .hero h1 span { color: var(--green); }` | Instrucción de ejecución en el contexto del script: `.hero h1 span { color: var(--green); }`. |
| `86` | `        .hero p {` | Instrucción de ejecución en el contexto del script: `.hero p {`. |
| `87` | `            font-size: 1.05rem; color: var(--gray-600);` | Instrucción de ejecución en el contexto del script: `font-size: 1.05rem; color: var(--gray-600);`. |
| `88` | `            max-width: 520px; line-height: 1.7;` | Instrucción de ejecución en el contexto del script: `max-width: 520px; line-height: 1.7;`. |
| `89` | `            margin-bottom: 2rem;` | Instrucción de ejecución en el contexto del script: `margin-bottom: 2rem;`. |
| `90` | `        }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `91` | `        .btn-hero-primary {` | Instrucción de ejecución en el contexto del script: `.btn-hero-primary {`. |
| `92` | `            background: var(--green); color: #fff;` | Instrucción de ejecución en el contexto del script: `background: var(--green); color: #fff;`. |
| `93` | `            border: none; border-radius: 10px;` | Instrucción de ejecución en el contexto del script: `border: none; border-radius: 10px;`. |
| `94` | `            padding: .8rem 2rem; font-weight: 600;` | Instrucción de ejecución en el contexto del script: `padding: .8rem 2rem; font-weight: 600;`. |
| `95` | `            font-size: 1rem; text-decoration: none;` | Instrucción de ejecución en el contexto del script: `font-size: 1rem; text-decoration: none;`. |
| `96` | `            transition: background .2s, transform .15s, box-shadow .2s;` | Instrucción de ejecución en el contexto del script: `transition: background .2s, transform .15s, box-shadow .2s;`. |
| `97` | `            display: inline-flex; align-items: center; gap: .5rem;` | Instrucción de ejecución en el contexto del script: `display: inline-flex; align-items: center; gap: .5rem;`. |
| `98` | `            box-shadow: 0 4px 14px rgba(57,169,0,.3);` | Instrucción de ejecución en el contexto del script: `box-shadow: 0 4px 14px rgba(57,169,0,.3);`. |
| `99` | `        }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `100` | `        .btn-hero-primary:hover { background: var(--green-dark); color: #ff...` | Instrucción de ejecución en el contexto del script: `.btn-hero-primary:hover { background: var(--green-dark); color: #fff; transform: translateY(-2px); box-shadow: 0 6px 20px rgba(57,169,0,.35); }`. |
| `101` | `        .hero-visual {` | Instrucción de ejecución en el contexto del script: `.hero-visual {`. |
| `102` | `            background: #fff;` | Instrucción de ejecución en el contexto del script: `background: #fff;`. |
| `103` | `            border: 1px solid #e2e8f0;` | Instrucción de ejecución en el contexto del script: `border: 1px solid #e2e8f0;`. |
| `104` | `            border-radius: 20px;` | Instrucción de ejecución en el contexto del script: `border-radius: 20px;`. |
| `105` | `            padding: 2rem;` | Instrucción de ejecución en el contexto del script: `padding: 2rem;`. |
| `106` | `            box-shadow: 0 8px 32px rgba(0,0,0,.07);` | Instrucción de ejecución en el contexto del script: `box-shadow: 0 8px 32px rgba(0,0,0,.07);`. |
| `107` | `        }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `108` | `        .stat-pill {` | Instrucción de ejecución en el contexto del script: `.stat-pill {`. |
| `109` | `            background: var(--green-soft); border: 1px solid #b7f0b7;` | Instrucción de ejecución en el contexto del script: `background: var(--green-soft); border: 1px solid #b7f0b7;`. |
| `110` | `            border-radius: 10px; padding: .75rem 1.2rem;` | Instrucción de ejecución en el contexto del script: `border-radius: 10px; padding: .75rem 1.2rem;`. |
| `111` | `            display: flex; align-items: center; gap: .75rem;` | Instrucción de ejecución en el contexto del script: `display: flex; align-items: center; gap: .75rem;`. |
| `112` | `        }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `113` | `        .stat-pill-icon {` | Instrucción de ejecución en el contexto del script: `.stat-pill-icon {`. |
| `114` | `            width: 36px; height: 36px; border-radius: 8px;` | Instrucción de ejecución en el contexto del script: `width: 36px; height: 36px; border-radius: 8px;`. |
| `115` | `            background: var(--green); color: #fff;` | Instrucción de ejecución en el contexto del script: `background: var(--green); color: #fff;`. |
| `116` | `            display: flex; align-items: center; justify-content: center;` | Instrucción de ejecución en el contexto del script: `display: flex; align-items: center; justify-content: center;`. |
| `117` | `            font-size: .9rem; flex-shrink: 0;` | Instrucción de ejecución en el contexto del script: `font-size: .9rem; flex-shrink: 0;`. |
| `118` | `        }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `119` | `        .stat-pill-label { font-size: .75rem; color: var(--gray-600); }` | Instrucción de ejecución en el contexto del script: `.stat-pill-label { font-size: .75rem; color: var(--gray-600); }`. |
| `120` | `        .stat-pill-val { font-weight: 700; font-size: .95rem; color: var(--...` | Instrucción de ejecución en el contexto del script: `.stat-pill-val { font-weight: 700; font-size: .95rem; color: var(--gray-800); }`. |
| `121` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `122` | `        /* ── SECCIONES ── */` | Comentario de bloque o anotación informativa dentro del código. |
| `123` | `        .section-label {` | Instrucción de ejecución en el contexto del script: `.section-label {`. |
| `124` | `            display: inline-block;` | Instrucción de ejecución en el contexto del script: `display: inline-block;`. |
| `125` | `            background: var(--green-soft); color: var(--green);` | Instrucción de ejecución en el contexto del script: `background: var(--green-soft); color: var(--green);`. |
| `126` | `            border-radius: 20px; padding: .3rem .9rem;` | Instrucción de ejecución en el contexto del script: `border-radius: 20px; padding: .3rem .9rem;`. |
| `127` | `            font-size: .78rem; font-weight: 600;` | Instrucción de ejecución en el contexto del script: `font-size: .78rem; font-weight: 600;`. |
| `128` | `            margin-bottom: .75rem;` | Instrucción de ejecución en el contexto del script: `margin-bottom: .75rem;`. |
| `129` | `        }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `130` | `        .section-title { font-size: clamp(1.5rem, 3vw, 2rem); font-weight: ...` | Instrucción de ejecución en el contexto del script: `.section-title { font-size: clamp(1.5rem, 3vw, 2rem); font-weight: 800; margin-bottom: .5rem; }`. |
| `131` | `        .section-sub { color: var(--gray-600); max-width: 560px; }` | Instrucción de ejecución en el contexto del script: `.section-sub { color: var(--gray-600); max-width: 560px; }`. |
| `132` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `133` | `        /* ── FEATURES ── */` | Comentario de bloque o anotación informativa dentro del código. |
| `134` | `        .feature-card {` | Instrucción de ejecución en el contexto del script: `.feature-card {`. |
| `135` | `            background: #fff;` | Instrucción de ejecución en el contexto del script: `background: #fff;`. |
| `136` | `            border: 1px solid #e2e8f0;` | Instrucción de ejecución en el contexto del script: `border: 1px solid #e2e8f0;`. |
| `137` | `            border-radius: 14px;` | Instrucción de ejecución en el contexto del script: `border-radius: 14px;`. |
| `138` | `            padding: 1.75rem;` | Instrucción de ejecución en el contexto del script: `padding: 1.75rem;`. |
| `139` | `            height: 100%;` | Instrucción de ejecución en el contexto del script: `height: 100%;`. |
| `140` | `            transition: transform .2s, box-shadow .2s, border-color .2s;` | Instrucción de ejecución en el contexto del script: `transition: transform .2s, box-shadow .2s, border-color .2s;`. |
| `141` | `        }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `142` | `        .feature-card:hover { transform: translateY(-4px); box-shadow: 0 12...` | Instrucción de ejecución en el contexto del script: `.feature-card:hover { transform: translateY(-4px); box-shadow: 0 12px 32px rgba(0,0,0,.08); border-color: #b7f0b7; }`. |
| `143` | `        .feature-icon {` | Instrucción de ejecución en el contexto del script: `.feature-icon {`. |
| `144` | `            width: 48px; height: 48px; border-radius: 12px;` | Instrucción de ejecución en el contexto del script: `width: 48px; height: 48px; border-radius: 12px;`. |
| `145` | `            background: var(--green-soft); color: var(--green);` | Instrucción de ejecución en el contexto del script: `background: var(--green-soft); color: var(--green);`. |
| `146` | `            display: flex; align-items: center; justify-content: center;` | Instrucción de ejecución en el contexto del script: `display: flex; align-items: center; justify-content: center;`. |
| `147` | `            font-size: 1.2rem; margin-bottom: 1rem;` | Instrucción de ejecución en el contexto del script: `font-size: 1.2rem; margin-bottom: 1rem;`. |
| `148` | `        }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `149` | `        .feature-card h5 { font-weight: 700; font-size: .95rem; margin-bott...` | Instrucción de ejecución en el contexto del script: `.feature-card h5 { font-weight: 700; font-size: .95rem; margin-bottom: .4rem; }`. |
| `150` | `        .feature-card p { font-size: .85rem; color: var(--gray-600); margin...` | Instrucción de ejecución en el contexto del script: `.feature-card p { font-size: .85rem; color: var(--gray-600); margin: 0; line-height: 1.6; }`. |
| `151` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `152` | `        /* ── ROLES ── */` | Comentario de bloque o anotación informativa dentro del código. |
| `153` | `        .role-card {` | Instrucción de ejecución en el contexto del script: `.role-card {`. |
| `154` | `            border: 1px solid #e2e8f0;` | Instrucción de ejecución en el contexto del script: `border: 1px solid #e2e8f0;`. |
| `155` | `            border-radius: 16px;` | Instrucción de ejecución en el contexto del script: `border-radius: 16px;`. |
| `156` | `            padding: 2rem;` | Instrucción de ejecución en el contexto del script: `padding: 2rem;`. |
| `157` | `            background: #fff;` | Instrucción de ejecución en el contexto del script: `background: #fff;`. |
| `158` | `        }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `159` | `        .role-card.admin { border-top: 4px solid #2563eb; }` | Instrucción de ejecución en el contexto del script: `.role-card.admin { border-top: 4px solid #2563eb; }`. |
| `160` | `        .role-card.vocero { border-top: 4px solid var(--green); }` | Instrucción de ejecución en el contexto del script: `.role-card.vocero { border-top: 4px solid var(--green); }`. |
| `161` | `        .role-icon {` | Instrucción de ejecución en el contexto del script: `.role-icon {`. |
| `162` | `            width: 52px; height: 52px; border-radius: 12px;` | Instrucción de ejecución en el contexto del script: `width: 52px; height: 52px; border-radius: 12px;`. |
| `163` | `            display: flex; align-items: center; justify-content: center;` | Instrucción de ejecución en el contexto del script: `display: flex; align-items: center; justify-content: center;`. |
| `164` | `            font-size: 1.3rem; color: #fff; margin-bottom: 1rem;` | Instrucción de ejecución en el contexto del script: `font-size: 1.3rem; color: #fff; margin-bottom: 1rem;`. |
| `165` | `        }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `166` | `        .role-icon.green { background: var(--green); }` | Instrucción de ejecución en el contexto del script: `.role-icon.green { background: var(--green); }`. |
| `167` | `        .role-icon.blue  { background: #2563eb; }` | Instrucción de ejecución en el contexto del script: `.role-icon.blue  { background: #2563eb; }`. |
| `168` | `        .role-list li {` | Instrucción de ejecución en el contexto del script: `.role-list li {`. |
| `169` | `            font-size: .875rem; color: var(--gray-600);` | Instrucción de ejecución en el contexto del script: `font-size: .875rem; color: var(--gray-600);`. |
| `170` | `            padding: .3rem 0;` | Instrucción de ejecución en el contexto del script: `padding: .3rem 0;`. |
| `171` | `            display: flex; align-items: flex-start; gap: .5rem;` | Instrucción de ejecución en el contexto del script: `display: flex; align-items: flex-start; gap: .5rem;`. |
| `172` | `        }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `173` | `        .role-list li i { color: var(--green); margin-top: 3px; flex-shrink...` | Instrucción de ejecución en el contexto del script: `.role-list li i { color: var(--green); margin-top: 3px; flex-shrink: 0; }`. |
| `174` | `        .role-list.blue li i { color: #2563eb; }` | Instrucción de ejecución en el contexto del script: `.role-list.blue li i { color: #2563eb; }`. |
| `175` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `176` | `        /* ── CTA ── */` | Comentario de bloque o anotación informativa dentro del código. |
| `177` | `        .cta-section {` | Instrucción de ejecución en el contexto del script: `.cta-section {`. |
| `178` | `            background: linear-gradient(135deg, var(--dark) 0%, #1a3a00 100%);` | Instrucción de ejecución en el contexto del script: `background: linear-gradient(135deg, var(--dark) 0%, #1a3a00 100%);`. |
| `179` | `            padding: 80px 0;` | Instrucción de ejecución en el contexto del script: `padding: 80px 0;`. |
| `180` | `        }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `181` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `182` | `        /* ── FOOTER ── */` | Comentario de bloque o anotación informativa dentro del código. |
| `183` | `        footer {` | Instrucción de ejecución en el contexto del script: `footer {`. |
| `184` | `            background: var(--gray-800);` | Instrucción de ejecución en el contexto del script: `background: var(--gray-800);`. |
| `185` | `            color: #94a3b8;` | Instrucción de ejecución en el contexto del script: `color: #94a3b8;`. |
| `186` | `            padding: 3rem 0 2rem;` | Instrucción de ejecución en el contexto del script: `padding: 3rem 0 2rem;`. |
| `187` | `        }` | Delimitador de apertura/cierre de bloque de código (clase, función, condición o bucle). |
| `188` | `        footer a { color: #94a3b8; text-decoration: none; }` | Instrucción de ejecución en el contexto del script: `footer a { color: #94a3b8; text-decoration: none; }`. |
| `189` | `        footer a:hover { color: #fff; }` | Instrucción de ejecución en el contexto del script: `footer a:hover { color: #fff; }`. |
| `190` | `        .footer-brand { color: #fff; font-weight: 700; font-size: 1.05rem; }` | Instrucción de ejecución en el contexto del script: `.footer-brand { color: #fff; font-weight: 700; font-size: 1.05rem; }`. |
| `191` | `        .footer-divider { border-color: #334155; }` | Instrucción de ejecución en el contexto del script: `.footer-divider { border-color: #334155; }`. |
| `192` | `    </style>` | Instrucción de ejecución en el contexto del script: `</style>`. |
| `193` | `</head>` | Cabecera del documento web para inclusión de metadatos, fuentes y hojas de estilo. |
| `194` | `<body>` | Cuerpo principal donde se renderiza la interfaz visual del usuario. |
| `195` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `196` | `<!-- ══ NAVBAR ════════════════════════════════════════════════════════════...` | Instrucción de ejecución en el contexto del script: `<!-- ══ NAVBAR ═══════════════════════════════════════════════════════════════ -->`. |
| `197` | `<nav class="navbar navbar-expand-lg">` | Barra o elemento de navegación del sistema. |
| `198` | `    <div class="container">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="container">`. |
| `199` | `        <a class="navbar-brand" href="#">` | Enlace hipertexto de navegación o acción: `<a class="navbar-brand" href="#">`. |
| `200` | `            <div class="brand-dot"><i class="fas fa-broom"></i></div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="brand-dot"><i class="fas fa-broom"></i></div>`. |
| `201` | `            GestiLimpieza` | Instrucción de ejecución en el contexto del script: `GestiLimpieza`. |
| `202` | `        </a>` | Instrucción de ejecución en el contexto del script: `</a>`. |
| `203` | `        <button class="navbar-toggler border-0" type="button" data-bs-toggl...` | Botón de acción interactivo para el usuario: `<button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navMain">`. |
| `204` | `            <span class="navbar-toggler-icon"></span>` | Instrucción de ejecución en el contexto del script: `<span class="navbar-toggler-icon"></span>`. |
| `205` | `        </button>` | Botón de acción interactivo para el usuario: `</button>`. |
| `206` | `        <div class="collapse navbar-collapse" id="navMain">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="collapse navbar-collapse" id="navMain">`. |
| `207` | `            <ul class="navbar-nav mx-auto gap-1">` | Instrucción de ejecución en el contexto del script: `<ul class="navbar-nav mx-auto gap-1">`. |
| `208` | `                <li class="nav-item"><a class="nav-link" href="#inicio">Ini...` | Enlace hipertexto de navegación o acción: `<li class="nav-item"><a class="nav-link" href="#inicio">Inicio</a></li>`. |
| `209` | `                <li class="nav-item"><a class="nav-link" href="#funcionalid...` | Enlace hipertexto de navegación o acción: `<li class="nav-item"><a class="nav-link" href="#funcionalidades">Funcionalidades</a></li>`. |
| `210` | `                <li class="nav-item"><a class="nav-link" href="#roles">Role...` | Enlace hipertexto de navegación o acción: `<li class="nav-item"><a class="nav-link" href="#roles">Roles</a></li>`. |
| `211` | `            </ul>` | Instrucción de ejecución en el contexto del script: `</ul>`. |
| `212` | `            <a href="../views/usuarios/login.php" class="btn-acceder">` | Enlace hipertexto de navegación o acción: `<a href="../views/usuarios/login.php" class="btn-acceder">`. |
| `213` | `                <i class="fas fa-arrow-right-to-bracket me-1"></i> Acceder` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-arrow-right-to-bracket me-1"></i> Acceder`. |
| `214` | `            </a>` | Instrucción de ejecución en el contexto del script: `</a>`. |
| `215` | `        </div>` | Cierre de contenedor visual `<div>`. |
| `216` | `    </div>` | Cierre de contenedor visual `<div>`. |
| `217` | `</nav>` | Barra o elemento de navegación del sistema. |
| `218` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `219` | `<!-- ══ HERO ══════════════════════════════════════════════════════════════...` | Instrucción de ejecución en el contexto del script: `<!-- ══ HERO ═════════════════════════════════════════════════════════════════ -->`. |
| `220` | `<section id="inicio" class="hero">` | Instrucción de ejecución en el contexto del script: `<section id="inicio" class="hero">`. |
| `221` | `    <div class="container">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="container">`. |
| `222` | `        <div class="row align-items-center g-5">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="row align-items-center g-5">`. |
| `223` | `            <div class="col-lg-6">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="col-lg-6">`. |
| `224` | `                <div class="hero-badge">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="hero-badge">`. |
| `225` | `                    <i class="fas fa-rotate"></i> Integrado con SICEFA` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-rotate"></i> Integrado con SICEFA`. |
| `226` | `                </div>` | Cierre de contenedor visual `<div>`. |
| `227` | `                <h1>Gestión de Limpieza de <span>Módulos</span> SENA</h1>` | Instrucción de ejecución en el contexto del script: `<h1>Gestión de Limpieza de <span>Módulos</span> SENA</h1>`. |
| `228` | `                <p>Plataforma centralizada para el registro, seguimiento y ...` | Instrucción de ejecución en el contexto del script: `<p>Plataforma centralizada para el registro, seguimiento y verificación`. |
| `229` | `                   del proceso de limpieza de módulos académicos, con evide...` | Instrucción de ejecución en el contexto del script: `del proceso de limpieza de módulos académicos, con evidencias fotográficas`. |
| `230` | `                   y control de cumplimiento en tiempo real.</p>` | Instrucción de ejecución en el contexto del script: `y control de cumplimiento en tiempo real.</p>`. |
| `231` | `                <div class="d-flex gap-3 flex-wrap">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="d-flex gap-3 flex-wrap">`. |
| `232` | `                    <a href="../views/usuarios/login.php" class="btn-hero-p...` | Enlace hipertexto de navegación o acción: `<a href="../views/usuarios/login.php" class="btn-hero-primary">`. |
| `233` | `                        <i class="fas fa-arrow-right-to-bracket"></i> Acced...` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-arrow-right-to-bracket"></i> Acceder al sistema`. |
| `234` | `                    </a>` | Instrucción de ejecución en el contexto del script: `</a>`. |
| `235` | `                    <a href="#funcionalidades" class="btn btn-outline-secon...` | Enlace hipertexto de navegación o acción: `<a href="#funcionalidades" class="btn btn-outline-secondary border-2 rounded-3 px-4 fw-600">`. |
| `236` | `                        Ver funcionalidades` | Instrucción de ejecución en el contexto del script: `Ver funcionalidades`. |
| `237` | `                    </a>` | Instrucción de ejecución en el contexto del script: `</a>`. |
| `238` | `                </div>` | Cierre de contenedor visual `<div>`. |
| `239` | `            </div>` | Cierre de contenedor visual `<div>`. |
| `240` | `            <div class="col-lg-6">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="col-lg-6">`. |
| `241` | `                <div class="hero-visual">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="hero-visual">`. |
| `242` | `                    <div class="d-flex align-items-center gap-2 mb-4 pb-3" ...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="d-flex align-items-center gap-2 mb-4 pb-3" style="border-bottom:1px solid #e2e8f0;">`. |
| `243` | `                        <div class="brand-dot" style="width:28px;height:28p...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="brand-dot" style="width:28px;height:28px;font-size:.75rem;"></div>`. |
| `244` | `                        <span class="fw-600 small" style="font-weight:600;"...` | Instrucción de ejecución en el contexto del script: `<span class="fw-600 small" style="font-weight:600;">Panel de Control — GestiLimpieza</span>`. |
| `245` | `                        <span class="badge bg-success ms-auto" style="font-...` | Instrucción de ejecución en el contexto del script: `<span class="badge bg-success ms-auto" style="font-size:.7rem;">En línea</span>`. |
| `246` | `                    </div>` | Cierre de contenedor visual `<div>`. |
| `247` | `                    <div class="row g-3">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="row g-3">`. |
| `248` | `                        <div class="col-6">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="col-6">`. |
| `249` | `                            <div class="stat-pill">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="stat-pill">`. |
| `250` | `                                <div class="stat-pill-icon"><i class="fas f...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="stat-pill-icon"><i class="fas fa-people-group"></i></div>`. |
| `251` | `                                <div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div>`. |
| `252` | `                                    <div class="stat-pill-label">Grupos act...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="stat-pill-label">Grupos activos</div>`. |
| `253` | `                                    <div class="stat-pill-val">Rotación sem...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="stat-pill-val">Rotación semanal</div>`. |
| `254` | `                                </div>` | Cierre de contenedor visual `<div>`. |
| `255` | `                            </div>` | Cierre de contenedor visual `<div>`. |
| `256` | `                        </div>` | Cierre de contenedor visual `<div>`. |
| `257` | `                        <div class="col-6">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="col-6">`. |
| `258` | `                            <div class="stat-pill" style="background:#f0f9f...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="stat-pill" style="background:#f0f9ff;border-color:#bae6fd;">`. |
| `259` | `                                <div class="stat-pill-icon" style="backgrou...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="stat-pill-icon" style="background:#2563eb;"><i class="fas fa-images"></i></div>`. |
| `260` | `                                <div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div>`. |
| `261` | `                                    <div class="stat-pill-label">Evidencias...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="stat-pill-label">Evidencias</div>`. |
| `262` | `                                    <div class="stat-pill-val">Verificación...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="stat-pill-val">Verificación foto</div>`. |
| `263` | `                                </div>` | Cierre de contenedor visual `<div>`. |
| `264` | `                            </div>` | Cierre de contenedor visual `<div>`. |
| `265` | `                        </div>` | Cierre de contenedor visual `<div>`. |
| `266` | `                        <div class="col-6">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="col-6">`. |
| `267` | `                            <div class="stat-pill" style="background:#fffbe...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="stat-pill" style="background:#fffbeb;border-color:#fde68a;">`. |
| `268` | `                                <div class="stat-pill-icon" style="backgrou...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="stat-pill-icon" style="background:#d97706;"><i class="fas fa-bell"></i></div>`. |
| `269` | `                                <div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div>`. |
| `270` | `                                    <div class="stat-pill-label">Notificaci...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="stat-pill-label">Notificaciones</div>`. |
| `271` | `                                    <div class="stat-pill-val">Alertas en t...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="stat-pill-val">Alertas en tiempo real</div>`. |
| `272` | `                                </div>` | Cierre de contenedor visual `<div>`. |
| `273` | `                            </div>` | Cierre de contenedor visual `<div>`. |
| `274` | `                        </div>` | Cierre de contenedor visual `<div>`. |
| `275` | `                        <div class="col-6">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="col-6">`. |
| `276` | `                            <div class="stat-pill">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="stat-pill">`. |
| `277` | `                                <div class="stat-pill-icon"><i class="fas f...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="stat-pill-icon"><i class="fas fa-user-tie"></i></div>`. |
| `278` | `                                <div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div>`. |
| `279` | `                                    <div class="stat-pill-label">Voceros</div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="stat-pill-label">Voceros</div>`. |
| `280` | `                                    <div class="stat-pill-val">Acceso por f...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="stat-pill-val">Acceso por ficha</div>`. |
| `281` | `                                </div>` | Cierre de contenedor visual `<div>`. |
| `282` | `                            </div>` | Cierre de contenedor visual `<div>`. |
| `283` | `                        </div>` | Cierre de contenedor visual `<div>`. |
| `284` | `                    </div>` | Cierre de contenedor visual `<div>`. |
| `285` | `                    <div class="mt-3 p-3 rounded-3 d-flex align-items-cente...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="mt-3 p-3 rounded-3 d-flex align-items-center gap-2"`. |
| `286` | `                         style="background:var(--green-soft); border:1px so...` | Instrucción de ejecución en el contexto del script: `style="background:var(--green-soft); border:1px solid #b7f0b7;">`. |
| `287` | `                        <i class="fas fa-circle-check text-success"></i>` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-circle-check text-success"></i>`. |
| `288` | `                        <span class="small" style="color:var(--green); font...` | Instrucción de ejecución en el contexto del script: `<span class="small" style="color:var(--green); font-weight:500;">`. |
| `289` | `                            Sincronización SICEFA activa — datos actualizados` | Instrucción de ejecución en el contexto del script: `Sincronización SICEFA activa — datos actualizados`. |
| `290` | `                        </span>` | Instrucción de ejecución en el contexto del script: `</span>`. |
| `291` | `                    </div>` | Cierre de contenedor visual `<div>`. |
| `292` | `                </div>` | Cierre de contenedor visual `<div>`. |
| `293` | `            </div>` | Cierre de contenedor visual `<div>`. |
| `294` | `        </div>` | Cierre de contenedor visual `<div>`. |
| `295` | `    </div>` | Cierre de contenedor visual `<div>`. |
| `296` | `</section>` | Instrucción de ejecución en el contexto del script: `</section>`. |
| `297` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `298` | `<!-- ══ FUNCIONALIDADES ═══════════════════════════════════════════════════...` | Instrucción de ejecución en el contexto del script: `<!-- ══ FUNCIONALIDADES ═══════════════════════════════════════════════════════ -->`. |
| `299` | `<section id="funcionalidades" class="py-5" style="background:var(--gray-100...` | Instrucción de ejecución en el contexto del script: `<section id="funcionalidades" class="py-5" style="background:var(--gray-100);">`. |
| `300` | `    <div class="container py-4">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="container py-4">`. |
| `301` | `        <div class="text-center mb-5">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="text-center mb-5">`. |
| `302` | `            <span class="section-label">Funcionalidades</span>` | Instrucción de ejecución en el contexto del script: `<span class="section-label">Funcionalidades</span>`. |
| `303` | `            <h2 class="section-title">Todo lo que necesitas en un solo luga...` | Instrucción de ejecución en el contexto del script: `<h2 class="section-title">Todo lo que necesitas en un solo lugar</h2>`. |
| `304` | `            <p class="section-sub mx-auto text-muted">` | Instrucción de ejecución en el contexto del script: `<p class="section-sub mx-auto text-muted">`. |
| `305` | `                Diseñado para simplificar la administración del proceso de ...` | Instrucción de ejecución en el contexto del script: `Diseñado para simplificar la administración del proceso de limpieza de módulos del centro de formación.`. |
| `306` | `            </p>` | Instrucción de ejecución en el contexto del script: `</p>`. |
| `307` | `        </div>` | Cierre de contenedor visual `<div>`. |
| `308` | `        <div class="row g-3">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="row g-3">`. |
| `309` | `            <?php` | Apertura obligatoria de la etiqueta PHP para ejecución del código del lado del servidor. |
| `310` | `            $features = [` | Instrucción de ejecución en el contexto del script: `$features = [`. |
| `311` | `                ['fas fa-graduation-cap', 'Programas y Fichas',   'Gestiona...` | Instrucción de ejecución en el contexto del script: `['fas fa-graduation-cap', 'Programas y Fichas',   'Gestiona los programas de formación y fichas del centro con información sincronizada de SICEFA.'],`. |
| `312` | `                ['fas fa-door-open',      'Módulos y Asignaciones','Crea mó...` | Instrucción de ejecución en el contexto del script: `['fas fa-door-open',      'Módulos y Asignaciones','Crea módulos físicos y asígnalos a fichas con rotación semanal automática de grupos.'],`. |
| `313` | `                ['fas fa-people-group',   'Grupos de Limpieza',    'Los voc...` | Instrucción de ejecución en el contexto del script: `['fas fa-people-group',   'Grupos de Limpieza',    'Los voceros crean grupos de aprendices. El sistema asigna las fechas automáticamente por rotación.'],`. |
| `314` | `                ['fas fa-camera',         'Evidencias Fotográficas','El voc...` | Instrucción de ejecución en el contexto del script: `['fas fa-camera',         'Evidencias Fotográficas','El vocero sube una foto del módulo limpio. El sistema registra fecha, hora y grupo responsable.'],`. |
| `315` | `                ['fas fa-bell',           'Notificaciones',        'Alertas...` | Instrucción de ejecución en el contexto del script: `['fas fa-bell',           'Notificaciones',        'Alertas automáticas cuando una ficha incumple con la entrega de evidencias en el plazo establecido.'],`. |
| `316` | `                ['fas fa-users',          'Gestión de Aprendices', 'Lista c...` | Instrucción de ejecución en el contexto del script: `['fas fa-users',          'Gestión de Aprendices', 'Lista completa de aprendices por ficha con datos de contacto. Activa voceros con un solo clic.'],`. |
| `317` | `            ];` | Instrucción de ejecución en el contexto del script: `];`. |
| `318` | `            foreach ($features as [$icon, $title, $desc]): ?>` | Bucle de iteración `foreach` para recorrer arreglos o colecciones de registros: `foreach ($features as [$icon, $title, $desc]): ?>`. |
| `319` | `            <div class="col-md-6 col-lg-4">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="col-md-6 col-lg-4">`. |
| `320` | `                <div class="feature-card">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="feature-card">`. |
| `321` | `                    <div class="feature-icon"><i class="<?= $icon ?>"></i><...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="feature-icon"><i class="<?= $icon ?>"></i></div>`. |
| `322` | `                    <h5><?= $title ?></h5>` | Instrucción de ejecución en el contexto del script: `<h5><?= $title ?></h5>`. |
| `323` | `                    <p><?= $desc ?></p>` | Instrucción de ejecución en el contexto del script: `<p><?= $desc ?></p>`. |
| `324` | `                </div>` | Cierre de contenedor visual `<div>`. |
| `325` | `            </div>` | Cierre de contenedor visual `<div>`. |
| `326` | `            <?php endforeach; ?>` | Instrucción de ejecución en el contexto del script: `<?php endforeach; ?>`. |
| `327` | `        </div>` | Cierre de contenedor visual `<div>`. |
| `328` | `    </div>` | Cierre de contenedor visual `<div>`. |
| `329` | `</section>` | Instrucción de ejecución en el contexto del script: `</section>`. |
| `330` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `331` | `<!-- ══ ROLES ═════════════════════════════════════════════════════════════...` | Instrucción de ejecución en el contexto del script: `<!-- ══ ROLES ════════════════════════════════════════════════════════════════ -->`. |
| `332` | `<section id="roles" class="py-5 bg-white">` | Instrucción de ejecución en el contexto del script: `<section id="roles" class="py-5 bg-white">`. |
| `333` | `    <div class="container py-4">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="container py-4">`. |
| `334` | `        <div class="text-center mb-5">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="text-center mb-5">`. |
| `335` | `            <span class="section-label">Roles</span>` | Instrucción de ejecución en el contexto del script: `<span class="section-label">Roles</span>`. |
| `336` | `            <h2 class="section-title">Dos perfiles de acceso</h2>` | Instrucción de ejecución en el contexto del script: `<h2 class="section-title">Dos perfiles de acceso</h2>`. |
| `337` | `            <p class="section-sub mx-auto text-muted">` | Instrucción de ejecución en el contexto del script: `<p class="section-sub mx-auto text-muted">`. |
| `338` | `                El sistema cuenta con dos roles claramente diferenciados, c...` | Instrucción de ejecución en el contexto del script: `El sistema cuenta con dos roles claramente diferenciados, cada uno con permisos específicos.`. |
| `339` | `            </p>` | Instrucción de ejecución en el contexto del script: `</p>`. |
| `340` | `        </div>` | Cierre de contenedor visual `<div>`. |
| `341` | `        <div class="row g-4 justify-content-center">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="row g-4 justify-content-center">`. |
| `342` | `            <div class="col-md-5">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="col-md-5">`. |
| `343` | `                <div class="role-card vocero">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="role-card vocero">`. |
| `344` | `                    <div class="role-icon green"><i class="fas fa-user-tie"...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="role-icon green"><i class="fas fa-user-tie"></i></div>`. |
| `345` | `                    <h5 class="fw-700 mb-1" style="font-weight:700;">Vocero...` | Instrucción de ejecución en el contexto del script: `<h5 class="fw-700 mb-1" style="font-weight:700;">Vocero</h5>`. |
| `346` | `                    <p class="text-muted small mb-3">Aprendiz designado por...` | Instrucción de ejecución en el contexto del script: `<p class="text-muted small mb-3">Aprendiz designado por el administrador para gestionar la limpieza de su ficha.</p>`. |
| `347` | `                    <ul class="role-list list-unstyled">` | Instrucción de ejecución en el contexto del script: `<ul class="role-list list-unstyled">`. |
| `348` | `                        <li><i class="fas fa-check-circle fa-sm"></i> Ver a...` | Instrucción de ejecución en el contexto del script: `<li><i class="fas fa-check-circle fa-sm"></i> Ver aprendices de su ficha</li>`. |
| `349` | `                        <li><i class="fas fa-check-circle fa-sm"></i> Crear...` | Instrucción de ejecución en el contexto del script: `<li><i class="fas fa-check-circle fa-sm"></i> Crear grupos de limpieza</li>`. |
| `350` | `                        <li><i class="fas fa-check-circle fa-sm"></i> Subir...` | Instrucción de ejecución en el contexto del script: `<li><i class="fas fa-check-circle fa-sm"></i> Subir evidencias fotográficas</li>`. |
| `351` | `                        <li><i class="fas fa-check-circle fa-sm"></i> Ver h...` | Instrucción de ejecución en el contexto del script: `<li><i class="fas fa-check-circle fa-sm"></i> Ver historial de turnos</li>`. |
| `352` | `                        <li><i class="fas fa-check-circle fa-sm"></i> Recib...` | Instrucción de ejecución en el contexto del script: `<li><i class="fas fa-check-circle fa-sm"></i> Recibir notificaciones</li>`. |
| `353` | `                    </ul>` | Instrucción de ejecución en el contexto del script: `</ul>`. |
| `354` | `                </div>` | Cierre de contenedor visual `<div>`. |
| `355` | `            </div>` | Cierre de contenedor visual `<div>`. |
| `356` | `            <div class="col-md-5">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="col-md-5">`. |
| `357` | `                <div class="role-card admin">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="role-card admin">`. |
| `358` | `                    <div class="role-icon blue"><i class="fas fa-shield-hal...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="role-icon blue"><i class="fas fa-shield-halved"></i></div>`. |
| `359` | `                    <h5 class="fw-700 mb-1" style="font-weight:700;">Admini...` | Instrucción de ejecución en el contexto del script: `<h5 class="fw-700 mb-1" style="font-weight:700;">Administrador</h5>`. |
| `360` | `                    <p class="text-muted small mb-3">Gestiona todo el siste...` | Instrucción de ejecución en el contexto del script: `<p class="text-muted small mb-3">Gestiona todo el sistema de forma centralizada desde el panel de control.</p>`. |
| `361` | `                    <ul class="role-list blue list-unstyled">` | Instrucción de ejecución en el contexto del script: `<ul class="role-list blue list-unstyled">`. |
| `362` | `                        <li><i class="fas fa-check-circle fa-sm"></i> Gesti...` | Instrucción de ejecución en el contexto del script: `<li><i class="fas fa-check-circle fa-sm"></i> Gestionar programas, fichas y módulos</li>`. |
| `363` | `                        <li><i class="fas fa-check-circle fa-sm"></i> Asign...` | Instrucción de ejecución en el contexto del script: `<li><i class="fas fa-check-circle fa-sm"></i> Asignar módulos con rotación semanal</li>`. |
| `364` | `                        <li><i class="fas fa-check-circle fa-sm"></i> Activ...` | Instrucción de ejecución en el contexto del script: `<li><i class="fas fa-check-circle fa-sm"></i> Activar y gestionar voceros</li>`. |
| `365` | `                        <li><i class="fas fa-check-circle fa-sm"></i> Revis...` | Instrucción de ejecución en el contexto del script: `<li><i class="fas fa-check-circle fa-sm"></i> Revisar evidencias por ficha</li>`. |
| `366` | `                        <li><i class="fas fa-check-circle fa-sm"></i> Monit...` | Instrucción de ejecución en el contexto del script: `<li><i class="fas fa-check-circle fa-sm"></i> Monitorear incumplimientos</li>`. |
| `367` | `                    </ul>` | Instrucción de ejecución en el contexto del script: `</ul>`. |
| `368` | `                </div>` | Cierre de contenedor visual `<div>`. |
| `369` | `            </div>` | Cierre de contenedor visual `<div>`. |
| `370` | `        </div>` | Cierre de contenedor visual `<div>`. |
| `371` | `    </div>` | Cierre de contenedor visual `<div>`. |
| `372` | `</section>` | Instrucción de ejecución en el contexto del script: `</section>`. |
| `373` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `374` | `<!-- ══ CTA ═══════════════════════════════════════════════════════════════...` | Instrucción de ejecución en el contexto del script: `<!-- ══ CTA ══════════════════════════════════════════════════════════════════ -->`. |
| `375` | `<section class="cta-section text-white text-center">` | Instrucción de ejecución en el contexto del script: `<section class="cta-section text-white text-center">`. |
| `376` | `    <div class="container">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="container">`. |
| `377` | `        <h2 class="fw-800 mb-3" style="font-weight:800;">¿Listo para empeza...` | Instrucción de ejecución en el contexto del script: `<h2 class="fw-800 mb-3" style="font-weight:800;">¿Listo para empezar?</h2>`. |
| `378` | `        <p class="mb-4" style="color:rgba(255,255,255,.7); max-width:480px;...` | Instrucción de ejecución en el contexto del script: `<p class="mb-4" style="color:rgba(255,255,255,.7); max-width:480px; margin:0 auto 1.5rem;">`. |
| `379` | `            Accede con las credenciales que te envió el administrador y com...` | Instrucción de ejecución en el contexto del script: `Accede con las credenciales que te envió el administrador y comienza a gestionar la limpieza de tu módulo.`. |
| `380` | `        </p>` | Instrucción de ejecución en el contexto del script: `</p>`. |
| `381` | `        <a href="../views/usuarios/login.php" class="btn-hero-primary" styl...` | Enlace hipertexto de navegación o acción: `<a href="../views/usuarios/login.php" class="btn-hero-primary" style="box-shadow:0 4px 20px rgba(57,169,0,.4);">`. |
| `382` | `            <i class="fas fa-arrow-right-to-bracket"></i> Acceder al sistema` | Instrucción de ejecución en el contexto del script: `<i class="fas fa-arrow-right-to-bracket"></i> Acceder al sistema`. |
| `383` | `        </a>` | Instrucción de ejecución en el contexto del script: `</a>`. |
| `384` | `    </div>` | Cierre de contenedor visual `<div>`. |
| `385` | `</section>` | Instrucción de ejecución en el contexto del script: `</section>`. |
| `386` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `387` | `<!-- ══ FOOTER ════════════════════════════════════════════════════════════...` | Instrucción de ejecución en el contexto del script: `<!-- ══ FOOTER ═══════════════════════════════════════════════════════════════ -->`. |
| `388` | `<footer>` | Instrucción de ejecución en el contexto del script: `<footer>`. |
| `389` | `    <div class="container">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="container">`. |
| `390` | `        <div class="row g-4 pb-4">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="row g-4 pb-4">`. |
| `391` | `            <div class="col-md-4">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="col-md-4">`. |
| `392` | `                <div class="d-flex align-items-center gap-2 mb-3">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="d-flex align-items-center gap-2 mb-3">`. |
| `393` | `                    <div class="brand-dot"><i class="fas fa-broom"></i></div>` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="brand-dot"><i class="fas fa-broom"></i></div>`. |
| `394` | `                    <span class="footer-brand">GestiLimpieza</span>` | Instrucción de ejecución en el contexto del script: `<span class="footer-brand">GestiLimpieza</span>`. |
| `395` | `                </div>` | Cierre de contenedor visual `<div>`. |
| `396` | `                <p class="small mb-0" style="line-height:1.7;">` | Instrucción de ejecución en el contexto del script: `<p class="small mb-0" style="line-height:1.7;">`. |
| `397` | `                    Sistema para la gestión del proceso de limpieza de módu...` | Instrucción de ejecución en el contexto del script: `Sistema para la gestión del proceso de limpieza de módulos del SENA,`. |
| `398` | `                    integrado con SICEFA para sincronización automática de ...` | Instrucción de ejecución en el contexto del script: `integrado con SICEFA para sincronización automática de datos.`. |
| `399` | `                </p>` | Instrucción de ejecución en el contexto del script: `</p>`. |
| `400` | `            </div>` | Cierre de contenedor visual `<div>`. |
| `401` | `            <div class="col-md-4">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="col-md-4">`. |
| `402` | `                <h6 class="text-white fw-600 mb-3" style="font-weight:600;"...` | Instrucción de ejecución en el contexto del script: `<h6 class="text-white fw-600 mb-3" style="font-weight:600;">Acceso rápido</h6>`. |
| `403` | `                <ul class="list-unstyled small">` | Instrucción de ejecución en el contexto del script: `<ul class="list-unstyled small">`. |
| `404` | `                    <li class="mb-1"><a href="../views/usuarios/login.php">...` | Enlace hipertexto de navegación o acción: `<li class="mb-1"><a href="../views/usuarios/login.php">Iniciar sesión</a></li>`. |
| `405` | `                    <li class="mb-1"><a href="#funcionalidades">Funcionalid...` | Enlace hipertexto de navegación o acción: `<li class="mb-1"><a href="#funcionalidades">Funcionalidades</a></li>`. |
| `406` | `                    <li><a href="#roles">Roles del sistema</a></li>` | Enlace hipertexto de navegación o acción: `<li><a href="#roles">Roles del sistema</a></li>`. |
| `407` | `                </ul>` | Instrucción de ejecución en el contexto del script: `</ul>`. |
| `408` | `            </div>` | Cierre de contenedor visual `<div>`. |
| `409` | `            <div class="col-md-4">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="col-md-4">`. |
| `410` | `                <h6 class="text-white fw-600 mb-3" style="font-weight:600;"...` | Instrucción de ejecución en el contexto del script: `<h6 class="text-white fw-600 mb-3" style="font-weight:600;">Contacto</h6>`. |
| `411` | `                <p class="small mb-1"><i class="fas fa-envelope me-2"></i>s...` | Instrucción de ejecución en el contexto del script: `<p class="small mb-1"><i class="fas fa-envelope me-2"></i>soporte@sena.edu.co</p>`. |
| `412` | `                <p class="small mb-0"><i class="fas fa-globe me-2"></i>www....` | Instrucción de ejecución en el contexto del script: `<p class="small mb-0"><i class="fas fa-globe me-2"></i>www.sena.edu.co</p>`. |
| `413` | `            </div>` | Cierre de contenedor visual `<div>`. |
| `414` | `        </div>` | Cierre de contenedor visual `<div>`. |
| `415` | `        <hr class="footer-divider">` | Instrucción de ejecución en el contexto del script: `<hr class="footer-divider">`. |
| `416` | `        <p class="text-center small mb-0" style="color:#64748b;">` | Instrucción de ejecución en el contexto del script: `<p class="text-center small mb-0" style="color:#64748b;">`. |
| `417` | `            &copy; <?= date('Y') ?> GestiLimpieza SENA &mdash; Centro de Fo...` | Instrucción de ejecución en el contexto del script: `&copy; <?= date('Y') ?> GestiLimpieza SENA &mdash; Centro de Formación Agroindustrial · Regional Huila`. |
| `418` | `        </p>` | Instrucción de ejecución en el contexto del script: `</p>`. |
| `419` | `    </div>` | Cierre de contenedor visual `<div>`. |
| `420` | `</footer>` | Instrucción de ejecución en el contexto del script: `</footer>`. |
| `421` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `422` | `<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap...` | Bloque o etiqueta de vinculación para scripts JavaScript del lado del cliente. |
| `423` | `</body>` | Cuerpo principal donde se renderiza la interfaz visual del usuario. |
| `424` | `</html>` | Etiqueta raíz que delimita el documento HTML. |

---

## 3. Resumen y Flujo de Interacción

El archivo `index.php` cumple un rol indispensable en `public/index.php`. 
Punto de entrada principal (Landing page) de la aplicación web. Presenta información institucional, accesos y redirecciones según el estado de sesión. Garantiza la robustez, el orden y la estabilidad de la arquitectura del proyecto `systemLimpieza`.
