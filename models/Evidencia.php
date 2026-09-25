<?php

class Evidencia
{
    private $conn;
    private $tabla = "evidencias";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // ── Todas las evidencias de un vocero, ordenadas por fecha DESC ----------
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
             ORDER BY g.fecha_limpieza DESC, e.tipo ASC, e.fecha_subida ASC"
        );
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // ── Par antes/después de un turno concreto --------------------------------
    public function obtenerParTurno(int $idTurno): array
    {
        $stmt = $this->conn->prepare(
            "SELECT * FROM {$this->tabla}
             WHERE id_turno = :id
             ORDER BY tipo ASC, fecha_subida ASC"
        );
        $stmt->execute([':id' => $idTurno]);
        $rows  = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $par   = ['antes' => null, 'despues' => null];
        foreach ($rows as $r) {
            $par[$r['tipo']] = $r;
        }
        return $par;
    }

    // ── Cuántas fotos tiene un turno (0, 1 o 2) --------------------------------
    public function contarPorTurno(int $idTurno): int
    {
        $stmt = $this->conn->prepare(
            "SELECT COUNT(*) FROM {$this->tabla} WHERE id_turno = :id"
        );
        $stmt->execute([':id' => $idTurno]);
        return (int) $stmt->fetchColumn();
    }

    // ── Turno ya tiene el par completo (antes + después) ----------------------
    public function turnoCompleto(int $idTurno): bool
    {
        $stmt = $this->conn->prepare(
            "SELECT COUNT(DISTINCT tipo) FROM {$this->tabla}
             WHERE id_turno = :id AND tipo IN ('antes','despues')"
        );
        $stmt->execute([':id' => $idTurno]);
        return (int) $stmt->fetchColumn() === 2;
    }

    // ── Última evidencia de un grupo (compatibilidad flujo antiguo) -----------
    public function obtenerPorGrupo(int $idGrupo): array|false
    {
        $stmt = $this->conn->prepare(
            "SELECT * FROM {$this->tabla}
             WHERE id_grupo = :id
             ORDER BY tipo ASC, fecha_subida ASC
             LIMIT 1"
        );
        $stmt->execute([':id' => $idGrupo]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // ── Todas las evidencias de un grupo ordenadas (antes primero) ------------
    public function obtenerTodasPorGrupo(int $idGrupo): array
    {
        $stmt = $this->conn->prepare(
            "SELECT * FROM {$this->tabla}
             WHERE id_grupo = :id
             ORDER BY tipo ASC, fecha_subida ASC"
        );
        $stmt->execute([':id' => $idGrupo]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // ── ¿El grupo tiene al menos una evidencia? --------------------------------
    public function grupoTieneEvidencia(int $idGrupo): bool
    {
        $stmt = $this->conn->prepare(
            "SELECT id_evidencia FROM {$this->tabla} WHERE id_grupo = :id LIMIT 1"
        );
        $stmt->execute([':id' => $idGrupo]);
        return $stmt->rowCount() > 0;
    }

    // ── ¿El grupo tiene el par completo (antes + después)? --------------------
    public function grupoCompleto(int $idGrupo): bool
    {
        $stmt = $this->conn->prepare(
            "SELECT COUNT(DISTINCT tipo) FROM {$this->tabla}
             WHERE id_grupo = :id AND tipo IN ('antes','despues')"
        );
        $stmt->execute([':id' => $idGrupo]);
        return (int) $stmt->fetchColumn() === 2;
    }

    // ── Registrar una evidencia con tipo --------------------------------------
    public function registrar(array $datos): int|false
    {
        try {
            $stmt = $this->conn->prepare(
                "INSERT INTO {$this->tabla}
                    (id_grupo, id_vocero, id_turno, tipo, nombre_archivo, ruta_archivo, observaciones)
                 VALUES
                    (:id_grupo, :id_vocero, :id_turno, :tipo, :nombre_archivo, :ruta_archivo, :observaciones)"
            );
            $stmt->execute([
                ':id_grupo'       => $datos['id_grupo'],
                ':id_vocero'      => $datos['id_vocero'],
                ':id_turno'       => $datos['id_turno']       ?? null,
                ':tipo'           => $datos['tipo']           ?? 'antes',
                ':nombre_archivo' => $datos['nombre_archivo'],
                ':ruta_archivo'   => $datos['ruta_archivo'],
                ':observaciones'  => $datos['observaciones']  ?? null,
            ]);
            return (int) $this->conn->lastInsertId();
        } catch (Exception $e) {
            return false;
        }
    }

    // ── Todas las evidencias (admin), agrupadas por turno, ordenadas ----------
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
             ORDER BY g.fecha_limpieza DESC, e.id_turno ASC, e.tipo ASC, e.fecha_subida ASC"
        );
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // ── Resumen por asignación con conteo de evidencias -----------------------
    // Considera completo solo si tiene las 2 fotos (antes + después)
    public function resumenPorAsignacion(int $idAsignacion): array
    {
        $stmt = $this->conn->prepare(
            "SELECT g.id_grupo, g.nombre_grupo, g.fecha_limpieza,
                    v.nombres AS vocero_nombres, v.apellidos AS vocero_apellidos,
                    (SELECT COUNT(DISTINCT tipo) FROM evidencias e2
                     WHERE e2.id_grupo = g.id_grupo
                       AND e2.tipo IN ('antes','despues')) AS fotos_completas
             FROM grupos g
             JOIN voceros v ON v.id_vocero = g.id_vocero
             WHERE g.id_asignacion = :id
             ORDER BY g.fecha_limpieza DESC"
        );
        $stmt->execute([':id' => $idAsignacion]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
