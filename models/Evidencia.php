<?php

class Evidencia
{
    private $conn;
    private $tabla = "evidencias";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function obtenerPorVocero(int $idVocero, ?int $idAsignacion = null): array
    {
        $where  = 'e.id_vocero = :id';
        $params = [':id' => $idVocero];
        if ($idAsignacion) {
            $where .= ' AND a.id_asignacion = :asig';
            $params[':asig'] = $idAsignacion;
        }
        $stmt = $this->conn->prepare(
            "SELECT e.*,
                    g.nombre_grupo, g.fecha_limpieza,
                    m.nombre AS nombre_modulo,
                    f.numero_ficha
             FROM {$this->tabla} e
             JOIN grupos g ON g.id_grupo = e.id_grupo
             JOIN asignaciones a ON a.id_asignacion = g.id_asignacion
             JOIN modulos m ON m.id_modulo = a.id_modulo
             JOIN fichas  f ON f.id_ficha  = a.id_ficha
             WHERE {$where}
             ORDER BY e.fecha_subida DESC"
        );
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerPorGrupo(int $idGrupo): array|false
    {
        $stmt = $this->conn->prepare(
            "SELECT * FROM {$this->tabla} WHERE id_grupo = :id ORDER BY fecha_subida DESC LIMIT 1"
        );
        $stmt->execute([':id' => $idGrupo]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function grupoTieneEvidencia(int $idGrupo): bool
    {
        $stmt = $this->conn->prepare(
            "SELECT id_evidencia FROM {$this->tabla} WHERE id_grupo = :id LIMIT 1"
        );
        $stmt->execute([':id' => $idGrupo]);
        return $stmt->rowCount() > 0;
    }

    public function registrar(array $datos): int|false
    {
        try {
            $stmt = $this->conn->prepare(
                "INSERT INTO {$this->tabla} (id_grupo, id_vocero, nombre_archivo, ruta_archivo)
                 VALUES (:id_grupo, :id_vocero, :nombre_archivo, :ruta_archivo)"
            );
            $stmt->execute([
                ':id_grupo'       => $datos['id_grupo'],
                ':id_vocero'      => $datos['id_vocero'],
                ':nombre_archivo' => $datos['nombre_archivo'],
                ':ruta_archivo'   => $datos['ruta_archivo'],
            ]);
            return (int) $this->conn->lastInsertId();
        } catch (Exception $e) {
            return false;
        }
    }

    public function obtenerTodas(array $filtros = []): array
    {
        $where  = ['1=1'];
        $params = [];

        if (!empty($filtros['id_ficha'])) {
            $where[] = 'a.id_ficha = :id_ficha';
            $params[':id_ficha'] = $filtros['id_ficha'];
        }
        if (!empty($filtros['id_vocero'])) {
            $where[] = 'e.id_vocero = :id_vocero';
            $params[':id_vocero'] = $filtros['id_vocero'];
        }
        if (!empty($filtros['fecha_desde'])) {
            $where[] = 'DATE(e.fecha_subida) >= :desde';
            $params[':desde'] = $filtros['fecha_desde'];
        }
        if (!empty($filtros['fecha_hasta'])) {
            $where[] = 'DATE(e.fecha_subida) <= :hasta';
            $params[':hasta'] = $filtros['fecha_hasta'];
        }

        $whereStr = implode(' AND ', $where);

        $stmt = $this->conn->prepare(
            "SELECT e.*,
                    g.nombre_grupo, g.fecha_limpieza,
                    m.nombre AS nombre_modulo,
                    f.numero_ficha,
                    v.nombres AS vocero_nombres, v.apellidos AS vocero_apellidos
             FROM {$this->tabla} e
             JOIN grupos g ON g.id_grupo = e.id_grupo
             JOIN asignaciones a ON a.id_asignacion = g.id_asignacion
             JOIN modulos  m ON m.id_modulo  = a.id_modulo
             JOIN fichas   f ON f.id_ficha   = a.id_ficha
             JOIN voceros  v ON v.id_vocero  = e.id_vocero
             WHERE {$whereStr}
             ORDER BY e.fecha_subida DESC"
        );
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function resumenPorAsignacion(int $idAsignacion): array
    {
        $stmt = $this->conn->prepare(
            "SELECT g.id_grupo, g.nombre_grupo, g.fecha_limpieza,
                    v.nombres AS vocero_nombres, v.apellidos AS vocero_apellidos,
                    (SELECT COUNT(*) FROM evidencias e2 WHERE e2.id_grupo = g.id_grupo) AS tiene_evidencia
             FROM grupos g
             JOIN voceros v ON v.id_vocero = g.id_vocero
             WHERE g.id_asignacion = :id
             ORDER BY g.fecha_limpieza"
        );
        $stmt->execute([':id' => $idAsignacion]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
