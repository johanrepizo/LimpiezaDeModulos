<?php
$titulo = 'Mis Aprendices';
if (session_status() === PHP_SESSION_NONE) session_start();
if (!isset($_SESSION['usuario']) || (int)$_SESSION['usuario']['rol'] !== 2) {
    header("Location: ../usuarios/login.php"); exit;
}
require_once __DIR__ . '/../../config/database.php';

$db        = (new Database())->conectar();
$idUsuario = (int)$_SESSION['usuario']['id_usuario'];

$stmtV = $db->prepare(
    "SELECT v.*, f.numero_ficha, p.nombre AS nombre_programa
     FROM voceros v
     JOIN fichas   f ON f.id_ficha     = v.id_ficha
     JOIN programas p ON p.id_programa = f.id_programa
     WHERE v.id_usuario = :id AND v.activo = 1 LIMIT 1"
);
$stmtV->execute([':id' => $idUsuario]);
$vocero = $stmtV->fetch(PDO::FETCH_ASSOC);

// Aprendices de la ficha del vocero con su grupo de limpieza asignado
$stmtAp = $db->prepare(
    "SELECT a.*, f.numero_ficha, p.nombre AS nombre_programa,
            GROUP_CONCAT(DISTINCT g.nombre_grupo ORDER BY g.nombre_grupo SEPARATOR ', ') AS nombre_grupo
     FROM aprendices a
     JOIN fichas   f ON f.id_ficha     = a.id_ficha
     JOIN programas p ON p.id_programa = f.id_programa
     LEFT JOIN grupo_integrantes gi   ON gi.id_aprendiz = a.id_aprendiz
     LEFT JOIN grupos g               ON g.id_grupo     = gi.id_grupo
     WHERE a.id_ficha = :fic AND a.activo = 1
     GROUP BY a.id_aprendiz
     ORDER BY a.apellidos, a.nombres"
);
$stmtAp->execute([':fic' => $vocero['id_ficha'] ?? 0]);
$aprendices = $stmtAp->fetchAll(PDO::FETCH_ASSOC);

require_once __DIR__ . '/../layouts/header.php';
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-0"><i class="fas fa-users text-success me-2"></i>Aprendices</h4>
        <p class="text-muted small mb-0">
            Ficha <strong><?= htmlspecialchars($vocero['numero_ficha'] ?? '—') ?></strong>
            &bull; <?= htmlspecialchars($vocero['nombre_programa'] ?? '') ?>
            &bull; <strong><?= count($aprendices) ?></strong> aprendice(s)
        </p>
    </div>
</div>

<!-- Buscador -->
<div class="card shadow-sm mb-3">
    <div class="card-body py-2">
        <div class="input-group input-group-sm" style="max-width:350px;">
            <span class="input-group-text bg-white"><i class="fas fa-search text-muted"></i></span>
            <input type="text" id="buscador" class="form-control border-start-0"
                   placeholder="Buscar por nombre, apellido o grupo…">
        </div>
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table tabla-limpia align-middle mb-0" id="tblAprendices">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Apellidos</th>
                        <th>Nombres</th>
                        <th>Documento</th>
                        <th>Ficha</th>
                        <th>Programa</th>
                        <th>Grupo de Limpieza</th>
                    </tr>
                </thead>
                <tbody>
                <?php if (empty($aprendices)): ?>
                <tr>
                    <td colspan="7" class="text-center text-muted py-5">
                        <i class="fas fa-users fa-2x mb-2 opacity-25 d-block"></i>
                        No hay aprendices sincronizados en tu ficha. Contacta al administrador.
                    </td>
                </tr>
                <?php else: ?>
                <?php foreach ($aprendices as $i => $ap): ?>
                <tr>
                    <td class="text-muted small"><?= $i + 1 ?></td>
                    <td class="fw-semibold small"><?= htmlspecialchars($ap['apellidos']) ?></td>
                    <td class="small"><?= htmlspecialchars($ap['nombres']) ?></td>
                    <td class="small text-muted"><?= htmlspecialchars($ap['documento'] ?? '—') ?></td>
                    <td><span class="badge bg-light text-dark border"><?= htmlspecialchars($ap['numero_ficha']) ?></span></td>
                    <td class="small text-muted"><?= htmlspecialchars(substr($ap['nombre_programa'], 0, 40)) ?></td>
                    <td>
                        <?php if (!empty($ap['nombre_grupo'])): ?>
                            <span class="badge bg-success-subtle text-success border border-success-subtle px-2 py-1 fw-semibold">
                                <i class="fas fa-people-group me-1"></i><?= htmlspecialchars($ap['nombre_grupo']) ?>
                            </span>
                        <?php else: ?>
                            <span class="badge bg-secondary-subtle text-muted border px-2 py-1 fw-normal">
                                <i class="fas fa-minus-circle me-1"></i>No asignado
                            </span>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
document.getElementById('buscador').addEventListener('input', function() {
    const q = this.value.toLowerCase();
    document.querySelectorAll('#tblAprendices tbody tr').forEach(tr => {
        tr.style.display = !q || tr.textContent.toLowerCase().includes(q) ? '' : 'none';
    });
});
</script>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>
