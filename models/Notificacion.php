<?php

class Notificacion
{
    private $conn;
    private $tabla = "notificaciones";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function crear(array $datos): bool
    {
        $stmt = $this->conn->prepare(
            "INSERT INTO {$this->tabla} (id_usuario, id_asignacion, tipo, titulo, mensaje)
             VALUES (:id_usuario, :id_asignacion, :tipo, :titulo, :mensaje)"
        );
        return $stmt->execute([
            ':id_usuario'    => $datos['id_usuario'],
            ':id_asignacion' => $datos['id_asignacion'] ?? null,
            ':tipo'          => $datos['tipo']          ?? 'info',
            ':titulo'        => $datos['titulo'],
            ':mensaje'       => $datos['mensaje'],
        ]);
    }

    public function obtenerPorUsuario(int $idUsuario, bool $soloNoLeidas = false): array
    {
        $sql = "SELECT * FROM {$this->tabla}
                WHERE id_usuario = :id";
        if ($soloNoLeidas) $sql .= " AND leida = 0";
        $sql .= " ORDER BY fecha DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':id' => $idUsuario]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function contarNoLeidas(int $idUsuario): int
    {
        $stmt = $this->conn->prepare(
            "SELECT COUNT(*) FROM {$this->tabla}
             WHERE id_usuario = :id AND leida = 0"
        );
        $stmt->execute([':id' => $idUsuario]);
        return (int) $stmt->fetchColumn();
    }

    public function marcarLeida(int $idNotificacion): bool
    {
        $stmt = $this->conn->prepare(
            "UPDATE {$this->tabla} SET leida = 1 WHERE id_notificacion = :id"
        );
        return $stmt->execute([':id' => $idNotificacion]);
    }

    public function marcarTodasLeidas(int $idUsuario): bool
    {
        $stmt = $this->conn->prepare(
            "UPDATE {$this->tabla} SET leida = 1 WHERE id_usuario = :id"
        );
        return $stmt->execute([':id' => $idUsuario]);
    }

    public function obtenerHistorialIncumplimientos(int $idUsuario, array $filtros = []): array
    {
        $where  = ['n.id_usuario = :id', "n.tipo = 'incumplimiento'"];
        $params = [':id' => $idUsuario];

        if (!empty($filtros['fecha_desde'])) {
            $where[] = 'DATE(n.fecha) >= :desde';
            $params[':desde'] = $filtros['fecha_desde'];
        }
        if (!empty($filtros['fecha_hasta'])) {
            $where[] = 'DATE(n.fecha) <= :hasta';
            $params[':hasta'] = $filtros['fecha_hasta'];
        }

        $whereStr = implode(' AND ', $where);

        $stmt = $this->conn->prepare(
            "SELECT n.*,
                    a.id_ficha, f.numero_ficha, m.nombre AS nombre_modulo
             FROM {$this->tabla} n
             LEFT JOIN asignaciones a ON a.id_asignacion = n.id_asignacion
             LEFT JOIN fichas  f ON f.id_ficha  = a.id_ficha
             LEFT JOIN modulos m ON m.id_modulo = a.id_modulo
             WHERE {$whereStr}
             ORDER BY n.fecha DESC"
        );
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
