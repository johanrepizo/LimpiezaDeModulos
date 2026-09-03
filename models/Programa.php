<?php

class Programa
{
    private $conn;
    private $tabla = "programas";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function obtenerTodos(): array
    {
        $stmt = $this->conn->query(
            "SELECT p.*, COUNT(f.id_ficha) AS total_fichas
             FROM {$this->tabla} p
             LEFT JOIN fichas f ON f.id_programa = p.id_programa AND f.activo = 1
             GROUP BY p.id_programa
             ORDER BY p.nombre"
        );
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerPorId(int $id): array|false
    {
        $stmt = $this->conn->prepare(
            "SELECT * FROM {$this->tabla} WHERE id_programa = :id LIMIT 1"
        );
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function crear(array $datos): int|false
    {
        try {
            $stmt = $this->conn->prepare(
                "INSERT INTO {$this->tabla} (nombre, descripcion, nivel)
                 VALUES (:nombre, :descripcion, :nivel)"
            );
            $stmt->execute([
                ':nombre'      => $datos['nombre'],
                ':descripcion' => $datos['descripcion'] ?? null,
                ':nivel'       => $datos['nivel']       ?? null,
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
             SET nombre = :nombre, descripcion = :descripcion, nivel = :nivel
             WHERE id_programa = :id"
        );
        return $stmt->execute([
            ':nombre'      => $datos['nombre'],
            ':descripcion' => $datos['descripcion'] ?? null,
            ':nivel'       => $datos['nivel']       ?? null,
            ':id'          => $id,
        ]);
    }

    public function tieneFichasActivas(int $id): bool
    {
        $stmt = $this->conn->prepare(
            "SELECT id_ficha FROM fichas WHERE id_programa = :id AND activo = 1 LIMIT 1"
        );
        $stmt->execute([':id' => $id]);
        return $stmt->rowCount() > 0;
    }

    public function eliminar(int $id): bool
    {
        $stmt = $this->conn->prepare(
            "UPDATE {$this->tabla} SET activo = 0 WHERE id_programa = :id"
        );
        return $stmt->execute([':id' => $id]);
    }

    public function buscar(string $termino): array
    {
        $like = '%' . $termino . '%';
        $stmt = $this->conn->prepare(
            "SELECT * FROM {$this->tabla}
             WHERE (nombre LIKE :t OR nivel LIKE :t2) AND activo = 1
             ORDER BY nombre"
        );
        $stmt->execute([':t' => $like, ':t2' => $like]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
