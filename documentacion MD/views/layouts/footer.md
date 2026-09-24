# Documentación Línea por Línea: `views/layouts/footer.php`

## 1. Ficha Técnica del Archivo

- **Archivo:** `footer.php`
- **Ruta en el proyecto:** `views/layouts/footer.php`
- **Cantidad total de líneas:** `31`
- **Tipo de archivo:** `PHP`
- **Propósito general:** Plantilla reutilizable de cierre de página con scripts de Bootstrap 5, FontAwesome y SweetAlert2.

---

## 2. Explicación Detallada Línea por Línea

A continuación se presenta cada línea de código numerada de forma consecutiva, acompañada de su fragmento exacto y la explicación exhaustiva de su funcionamiento y responsabilidad en el sistema:

| Línea | Código Fuente | Explicación Detallada |
|---|---|---|
| `1` | `    </section><!-- /pageContent -->` | Instrucción de ejecución en el contexto del script: `</section><!-- /pageContent -->`. |
| `2` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `3` | `    <footer style="` | Instrucción de ejecución en el contexto del script: `<footer style="`. |
| `4` | `        background: #0a1a00;` | Instrucción de ejecución en el contexto del script: `background: #0a1a00;`. |
| `5` | `        border-top: 1px solid rgba(57,169,0,.12);` | Instrucción de ejecución en el contexto del script: `border-top: 1px solid rgba(57,169,0,.12);`. |
| `6` | `        padding: .85rem 0;` | Instrucción de ejecución en el contexto del script: `padding: .85rem 0;`. |
| `7` | `        margin-top: auto;` | Instrucción de ejecución en el contexto del script: `margin-top: auto;`. |
| `8` | `        flex-shrink: 0;` | Instrucción de ejecución en el contexto del script: `flex-shrink: 0;`. |
| `9` | `    ">` | Instrucción de ejecución en el contexto del script: `">`. |
| `10` | `        <div class="container-fluid px-4">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="container-fluid px-4">`. |
| `11` | `            <div class="d-flex align-items-center justify-content-between f...` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="d-flex align-items-center justify-content-between flex-column flex-sm-row gap-2">`. |
| `12` | `                <span style="font-size:.82rem; color:#5a8a50;">` | Instrucción de ejecución en el contexto del script: `<span style="font-size:.82rem; color:#5a8a50;">`. |
| `13` | `                    &copy; <?= date('Y') ?>` | Instrucción de ejecución en el contexto del script: `&copy; <?= date('Y') ?>`. |
| `14` | `                    <strong style="color:#a8f090;">GestiLimpieza SENA</stro...` | Instrucción de ejecución en el contexto del script: `<strong style="color:#a8f090;">GestiLimpieza SENA</strong>.`. |
| `15` | `                    Todos los derechos reservados.` | Instrucción de ejecución en el contexto del script: `Todos los derechos reservados.`. |
| `16` | `                </span>` | Instrucción de ejecución en el contexto del script: `</span>`. |
| `17` | `                <div class="d-flex align-items-center gap-3">` | Contenedor visual estructurado con Bootstrap/CSS: `<div class="d-flex align-items-center gap-3">`. |
| `18` | `                    <a href="#" style="font-size:.82rem; color:#5a8a50; tex...` | Enlace hipertexto de navegación o acción: `<a href="#" style="font-size:.82rem; color:#5a8a50; text-decoration:none;">Soporte</a>`. |
| `19` | `                    <a href="#" style="font-size:.82rem; color:#5a8a50; tex...` | Enlace hipertexto de navegación o acción: `<a href="#" style="font-size:.82rem; color:#5a8a50; text-decoration:none;">Manual</a>`. |
| `20` | `                    <span style="font-size:.82rem; color:#5a8a50;">v1.0.0</...` | Instrucción de ejecución en el contexto del script: `<span style="font-size:.82rem; color:#5a8a50;">v1.0.0</span>`. |
| `21` | `                </div>` | Cierre de contenedor visual `<div>`. |
| `22` | `            </div>` | Cierre de contenedor visual `<div>`. |
| `23` | `        </div>` | Cierre de contenedor visual `<div>`. |
| `24` | `    </footer>` | Instrucción de ejecución en el contexto del script: `</footer>`. |
| `25` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `26` | `</div><!-- /mainContent -->` | Cierre de contenedor visual `<div>`. |
| `27` | `</div><!-- /d-flex wrapper -->` | Cierre de contenedor visual `<div>`. |
| `28` | *(Línea en blanco)* | Línea en blanco para organización visual y legibilidad. |
| `29` | `<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap...` | Bloque o etiqueta de vinculación para scripts JavaScript del lado del cliente. |
| `30` | `</body>` | Cuerpo principal donde se renderiza la interfaz visual del usuario. |
| `31` | `</html>` | Etiqueta raíz que delimita el documento HTML. |

---

## 3. Resumen y Flujo de Interacción

El archivo `footer.php` cumple un rol indispensable en `views/layouts/footer.php`. 
Plantilla reutilizable de cierre de página con scripts de Bootstrap 5, FontAwesome y SweetAlert2. Garantiza la robustez, el orden y la estabilidad de la arquitectura del proyecto `systemLimpieza`.
