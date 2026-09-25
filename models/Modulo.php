<?php

class Modulo
{
    private $conn;
    private $tabla = "modulos";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function obtenerTodos(): array
    {
        $stmt = $this->conn->query(
            "SELECT m.*,
                    ANY_VALUE(a.id_asignacion)           AS id_asignacion,
                    ANY_VALUE(a.estado)                  AS estado_asignacion,
                    ANY_VALUE(a.fecha_limite_evidencia)  AS fecha_limite_evidencia,
                    ANY_VALUE(f.numero_ficha)            AS numero_ficha,
                    ANY_VALUE(v.nombres)                 AS vocero_nombres,
                    ANY_VALUE(v.apellidos)               AS vocero_apellidos
             FROM {$this->tabla} m
             LEFT JOIN asignaciones a ON a.id_modulo = m.id_modulo AND a.estado = 'Activa'
             LEFT JOIN fichas   f ON f.id_ficha    = a.id_ficha
             LEFT JOIN voceros  v ON v.id_ficha    = a.id_ficha AND v.activo = 1
             WHERE m.activo = 1
             GROUP BY m.id_modulo
             ORDER BY m.nombre"
        );
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerPorId(int $id): array|false
    {
        $stmt = $this->conn->prepare(
            "SELECT * FROM {$this->tabla} WHERE id_modulo = :id LIMIT 1"
        );
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function crear(array $datos): int|false
    {
        try {
            $stmt = $this->conn->prepare(
                "INSERT INTO {$this->tabla} (nombre, ubicacion, capacidad, descripcion)
                 VALUES (:nombre, :ubicacion, :capacidad, :descripcion)"
            );
            $stmt->execute([
                ':nombre'      => $datos['nombre'],
                ':ubicacion'   => $datos['ubicacion']   ?? null,
                ':capacidad'   => $datos['capacidad']   ?? null,
                ':descripcion' => $datos['descripcion'] ?? null,
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
             SET nombre = :nombre, ubicacion = :ubicacion,
                 capacidad = :capacidad, descripcion = :descripcion
             WHERE id_modulo = :id"
        );
        return $stmt->execute([
            ':nombre'      => $datos['nombre'],
            ':ubicacion'   => $datos['ubicacion']   ?? null,
            ':capacidad'   => $datos['capacidad']   ?? null,
            ':descripcion' => $datos['descripcion'] ?? null,
            ':id'          => $id,
        ]);
    }

    public function estaAsignadoEnPeriodo(int $idModulo, string $fechaInicio, string $fechaFin, ?int $excluirAsig = null): bool
    {
        $sql = "SELECT id_asignacion FROM asignaciones
                WHERE id_modulo = :id AND estado = 'Activa'
                AND NOT (fecha_fin < :inicio OR fecha_inicio > :fin)";
        if ($excluirAsig) $sql .= " AND id_asignacion != :excluir";
        $stmt = $this->conn->prepare($sql);
        $params = [':id' => $idModulo, ':inicio' => $fechaInicio, ':fin' => $fechaFin];
        if ($excluirAsig) $params[':excluir'] = $excluirAsig;
        $stmt->execute($params);
        return $stmt->rowCount() > 0;
    }

    /**
     * Verifica que la ficha ya no tenga una asignación activa.
     * Cada ficha solo puede tener UN módulo asignado a la vez.
     */
    public function fichaYaTieneAsignacion(int $idFicha, ?int $excluirAsig = null): bool
    {
        $sql = "SELECT id_asignacion FROM asignaciones
                WHERE id_ficha = :fic AND estado = 'Activa'";
        if ($excluirAsig) $sql .= " AND id_asignacion != :excluir";
        $stmt = $this->conn->prepare($sql);
        $params = [':fic' => $idFicha];
        if ($excluirAsig) $params[':excluir'] = $excluirAsig;
        $stmt->execute($params);
        return $stmt->rowCount() > 0;
    }

    public function crearAsignacion(array $datos): int|false
    {
        try {
            $stmt = $this->conn->prepare(
                "INSERT INTO asignaciones
                    (id_modulo, id_ficha, fecha_inicio, fecha_fin, fecha_limite_evidencia)
                 VALUES (:id_modulo, :id_ficha, :inicio, :fin, :limite)"
            );
            $stmt->execute([
                ':id_modulo' => $datos['id_modulo'],
                ':id_ficha'  => $datos['id_ficha'],
                ':inicio'    => $datos['fecha_inicio'],
                ':fin'       => $datos['fecha_fin'],
                ':limite'    => $datos['fecha_limite_evidencia'],
            ]);
            return (int) $this->conn->lastInsertId();
        } catch (Exception $e) {
            return false;
        }
    }

    public function obtenerAsignaciones(array $filtros = []): array
    {
        $where = ['1=1'];
        $params = [];
        if (!empty($filtros['estado'])) {
            $where[] = 'a.estado = :estado';
            $params[':estado'] = $filtros['estado'];
        }
        if (!empty($filtros['id_ficha'])) {
            $where[] = 'a.id_ficha = :id_ficha';
            $params[':id_ficha'] = $filtros['id_ficha'];
        }
        $whereStr = implode(' AND ', $where);

        $stmt = $this->conn->prepare(
            "SELECT a.*,
                    m.nombre AS nombre_modulo,
                    f.numero_ficha, p.nombre AS nombre_programa,
                    ANY_VALUE(v.nombres)   AS vocero_nombres,
                    ANY_VALUE(v.apellidos) AS vocero_apellidos,
                    (SELECT COUNT(*) FROM evidencias e
                     JOIN grupos g ON g.id_grupo = e.id_grupo
                     WHERE g.id_asignacion = a.id_asignacion) AS total_evidencias
             FROM asignaciones a
             JOIN modulos   m ON m.id_modulo   = a.id_modulo
             JOIN fichas    f ON f.id_ficha    = a.id_ficha
             JOIN programas p ON p.id_programa = f.id_programa
             LEFT JOIN voceros v ON v.id_ficha = a.id_ficha AND v.activo = 1
             WHERE {$whereStr}
             GROUP BY a.id_asignacion
             ORDER BY a.fecha_limite_evidencia DESC"
        );
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function eliminar(int $id): bool
    {
        $stmt = $this->conn->prepare(
            "UPDATE {$this->tabla} SET activo = 0 WHERE id_modulo = :id"
        );
        return $stmt->execute([':id' => $id]);
    }
}
?>
