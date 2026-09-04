<?php

class Ficha
{
    private $conn;
    private $tabla = "fichas";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function obtenerTodas(): array
    {
        $stmt = $this->conn->query(
            "SELECT f.*, p.nombre AS nombre_programa,
                    ANY_VALUE(v.nombres)   AS vocero_nombres,
                    ANY_VALUE(v.apellidos) AS vocero_apellidos,
                    COUNT(DISTINCT a.id_aprendiz) AS total_aprendices
             FROM {$this->tabla} f
             LEFT JOIN programas p ON p.id_programa = f.id_programa
             LEFT JOIN voceros   v ON v.id_ficha    = f.id_ficha AND v.activo = 1
             LEFT JOIN aprendices a ON a.id_ficha   = f.id_ficha AND a.activo = 1
             WHERE f.activo = 1
             GROUP BY f.id_ficha
             ORDER BY f.numero_ficha"
        );
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerPorId(int $id): array|false
    {
        $stmt = $this->conn->prepare(
            "SELECT f.*, p.nombre AS nombre_programa
             FROM {$this->tabla} f
             LEFT JOIN programas p ON p.id_programa = f.id_programa
             WHERE f.id_ficha = :id LIMIT 1"
        );
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function obtenerAprendicesDeFicha(int $idFicha): array
    {
        $stmt = $this->conn->prepare(
            "SELECT * FROM aprendices
             WHERE id_ficha = :id AND activo = 1
             ORDER BY apellidos, nombres"
        );
        $stmt->execute([':id' => $idFicha]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function existeDuplicado(string $numero, int $idPrograma, ?int $excluirId = null): bool
    {
        $sql = "SELECT id_ficha FROM {$this->tabla}
                WHERE numero_ficha = :numero AND id_programa = :prog AND activo = 1";
        if ($excluirId) $sql .= " AND id_ficha != :excluir";
        $stmt = $this->conn->prepare($sql);
        $params = [':numero' => $numero, ':prog' => $idPrograma];
        if ($excluirId) $params[':excluir'] = $excluirId;
        $stmt->execute($params);
        return $stmt->rowCount() > 0;
    }

    public function crear(array $datos): int|false
    {
        try {
            $stmt = $this->conn->prepare(
                "INSERT INTO {$this->tabla} (id_programa, numero_ficha, jornada, num_aprendices)
                 VALUES (:id_programa, :numero_ficha, :jornada, :num_aprendices)"
            );
            $stmt->execute([
                ':id_programa'    => $datos['id_programa'],
                ':numero_ficha'   => $datos['numero_ficha'],
                ':jornada'        => $datos['jornada']        ?? 'Diurna',
                ':num_aprendices' => $datos['num_aprendices'] ?? null,
            ]);
            return (int) $this->conn->lastInsertId();
        } catch (Exception $e) {
            return false;
        }
    }

    public function actualizar(int $id, array $datos): bool
    {
        $stmt = $this->conn->prepare(
            "UPDATE {$this->tabla}
             SET id_programa = :id_programa, numero_ficha = :numero_ficha,
                 jornada = :jornada, num_aprendices = :num_aprendices
             WHERE id_ficha = :id"
        );
        return $stmt->execute([
            ':id_programa'    => $datos['id_programa'],
            ':numero_ficha'   => $datos['numero_ficha'],
            ':jornada'        => $datos['jornada']        ?? 'Diurna',
            ':num_aprendices' => $datos['num_aprendices'] ?? null,
            ':id'             => $id,
        ]);
    }

    public function tieneAsignacionesActivas(int $id): bool
    {
        $stmt = $this->conn->prepare(
            "SELECT id_asignacion FROM asignaciones
             WHERE id_ficha = :id AND estado = 'Activa' LIMIT 1"
        );
        $stmt->execute([':id' => $id]);
        return $stmt->rowCount() > 0;
    }

    public function eliminar(int $id): bool
    {
        $stmt = $this->conn->prepare(
            "UPDATE {$this->tabla} SET activo = 0 WHERE id_ficha = :id"
        );
        return $stmt->execute([':id' => $id]);
    }
}
?>
