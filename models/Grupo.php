<?php

class Grupo
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function obtenerPorVocero(int $idVocero): array
    {
        $stmt = $this->conn->prepare(
            "SELECT g.*,
                    a.fecha_limite_evidencia, a.estado AS estado_asignacion,
                    m.nombre AS nombre_modulo,
                    f.numero_ficha,
                    (SELECT COUNT(*) FROM evidencias e WHERE e.id_grupo = g.id_grupo) AS tiene_evidencia
             FROM grupos g
             JOIN asignaciones a ON a.id_asignacion = g.id_asignacion
             JOIN modulos  m ON m.id_modulo  = a.id_modulo
             JOIN fichas   f ON f.id_ficha   = a.id_ficha
             WHERE g.id_vocero = :id
             ORDER BY g.fecha_limpieza DESC"
        );
        $stmt->execute([':id' => $idVocero]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerPorId(int $id): array|false
    {
        $stmt = $this->conn->prepare(
            "SELECT g.*,
                    a.fecha_limite_evidencia, a.id_ficha,
                    m.nombre AS nombre_modulo,
                    f.numero_ficha
             FROM grupos g
             JOIN asignaciones a ON a.id_asignacion = g.id_asignacion
             JOIN modulos  m ON m.id_modulo  = a.id_modulo
             JOIN fichas   f ON f.id_ficha   = a.id_ficha
             WHERE g.id_grupo = :id LIMIT 1"
        );
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function obtenerIntegrantes(int $idGrupo): array
    {
        $stmt = $this->conn->prepare(
            "SELECT ap.id_aprendiz, ap.nombres, ap.apellidos, ap.documento,
                    ap.celular, ap.correo
             FROM grupo_integrantes gi
             JOIN aprendices ap ON ap.id_aprendiz = gi.id_aprendiz
             WHERE gi.id_grupo = :id
             ORDER BY ap.apellidos, ap.nombres"
        );
        $stmt->execute([':id' => $idGrupo]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function existeDuplicadoModuloFecha(int $idAsignacion, string $fecha, ?int $excluirId = null): bool
    {
        $sql = "SELECT id_grupo FROM grupos
                WHERE id_asignacion = :asig AND fecha_limpieza = :fecha";
        if ($excluirId) $sql .= " AND id_grupo != :excluir";
        $stmt = $this->conn->prepare($sql);
        $params = [':asig' => $idAsignacion, ':fecha' => $fecha];
        if ($excluirId) $params[':excluir'] = $excluirId;
        $stmt->execute($params);
        return $stmt->rowCount() > 0;
    }

    public function crear(array $datos, array $idAprendices): int|false
    {
        try {
            $this->conn->beginTransaction();

            $stmt = $this->conn->prepare(
                "INSERT INTO grupos (id_asignacion, id_vocero, nombre_grupo, fecha_limpieza)
                 VALUES (:id_asignacion, :id_vocero, :nombre_grupo, :fecha_limpieza)"
            );
            $stmt->execute([
                ':id_asignacion' => $datos['id_asignacion'],
                ':id_vocero'     => $datos['id_vocero'],
                ':nombre_grupo'  => $datos['nombre_grupo'],
                ':fecha_limpieza'=> $datos['fecha_limpieza'],
            ]);
            $idGrupo = (int) $this->conn->lastInsertId();

            $stmtInt = $this->conn->prepare(
                "INSERT INTO grupo_integrantes (id_grupo, id_aprendiz) VALUES (:g, :a)"
            );
            foreach ($idAprendices as $idAp) {
                $stmtInt->execute([':g' => $idGrupo, ':a' => (int)$idAp]);
            }

            $this->conn->commit();
            return $idGrupo;
        } catch (Exception $e) {
            $this->conn->rollBack();
            return false;
        }
    }

    public function actualizar(int $id, array $datos, array $idAprendices): bool
    {
        try {
            $this->conn->beginTransaction();

            $stmt = $this->conn->prepare(
                "UPDATE grupos
                 SET nombre_grupo = :nombre_grupo, fecha_limpieza = :fecha_limpieza,
                     fecha_modificacion = NOW()
                 WHERE id_grupo = :id"
            );
            $stmt->execute([
                ':nombre_grupo'  => $datos['nombre_grupo'],
                ':fecha_limpieza'=> $datos['fecha_limpieza'],
                ':id'            => $id,
            ]);

            // Reemplazar integrantes
            $this->conn->prepare("DELETE FROM grupo_integrantes WHERE id_grupo = :id")
                       ->execute([':id' => $id]);

            $stmtInt = $this->conn->prepare(
                "INSERT INTO grupo_integrantes (id_grupo, id_aprendiz) VALUES (:g, :a)"
            );
            foreach ($idAprendices as $idAp) {
                $stmtInt->execute([':g' => $id, ':a' => (int)$idAp]);
            }

            $this->conn->commit();
            return true;
        } catch (Exception $e) {
            $this->conn->rollBack();
            return false;
        }
    }

    public function eliminar(int $id): bool
    {
        // Solo se puede eliminar si no tiene evidencias
        $stmt = $this->conn->prepare(
            "SELECT id_evidencia FROM evidencias WHERE id_grupo = :id LIMIT 1"
        );
        $stmt->execute([':id' => $id]);
        if ($stmt->rowCount() > 0) return false;

        $stmt = $this->conn->prepare("DELETE FROM grupos WHERE id_grupo = :id");
        return $stmt->execute([':id' => $id]);
    }

    public function registrarHistorial(int $idGrupo, string $descripcion, int $idUsuario): void
    {
        $stmt = $this->conn->prepare(
            "INSERT INTO historial_grupos (id_grupo, descripcion, id_usuario)
             VALUES (:g, :d, :u)"
        );
        $stmt->execute([':g' => $idGrupo, ':d' => $descripcion, ':u' => $idUsuario]);
    }

    public function obtenerHistorial(int $idGrupo): array
    {
        $stmt = $this->conn->prepare(
            "SELECT hg.*, u.nombres AS usuario_nombre, u.apellidos AS usuario_apellido
             FROM historial_grupos hg
             LEFT JOIN usuarios u ON u.id_usuario = hg.id_usuario
             WHERE hg.id_grupo = :id
             ORDER BY hg.fecha DESC"
        );
        $stmt->execute([':id' => $idGrupo]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerTodos(array $filtros = []): array
    {
        $where  = ['1=1'];
        $params = [];

        if (!empty($filtros['id_ficha'])) {
            $where[] = 'a.id_ficha = :id_ficha';
            $params[':id_ficha'] = $filtros['id_ficha'];
        }
        if (!empty($filtros['estado'])) {
            $where[] = 'g.estado = :estado';
            $params[':estado'] = $filtros['estado'];
        }

        $whereStr = implode(' AND ', $where);

        $stmt = $this->conn->prepare(
            "SELECT g.*,
                    m.nombre AS nombre_modulo, f.numero_ficha,
                    v.nombres AS vocero_nombres, v.apellidos AS vocero_apellidos,
                    (SELECT COUNT(*) FROM evidencias e WHERE e.id_grupo = g.id_grupo) AS tiene_evidencia
             FROM grupos g
             JOIN asignaciones a ON a.id_asignacion = g.id_asignacion
             JOIN modulos  m ON m.id_modulo  = a.id_modulo
             JOIN fichas   f ON f.id_ficha   = a.id_ficha
             JOIN voceros  v ON v.id_vocero  = g.id_vocero
             WHERE {$whereStr}
             ORDER BY g.fecha_limpieza DESC"
        );
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
