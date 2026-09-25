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
                    (SELECT COUNT(*) FROM evidencias e WHERE e.id_grupo = g.id_grupo) AS tiene_evidencia,
                    (SELECT COUNT(*) FROM grupo_integrantes gi WHERE gi.id_grupo = g.id_grupo) AS total_integrantes
             FROM grupos g
             JOIN asignaciones a ON a.id_asignacion = g.id_asignacion
             JOIN modulos  m ON m.id_modulo  = a.id_modulo
             JOIN fichas   f ON f.id_ficha   = a.id_ficha
             WHERE g.id_vocero = :id
             ORDER BY g.id_grupo ASC"
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
        // Elimina el grupo siempre. Las evidencias históricas quedan intactas
        // porque tienen su propio snapshot en evidencia_integrantes.
        // grupo_integrantes se elimina por CASCADE al borrar el grupo.
        $stmt = $this->conn->prepare("DELETE FROM grupos WHERE id_grupo = :id");
        return $stmt->execute([':id' => $id]);
    }

    // Devuelve los id_aprendiz que ya están en algún grupo de la ficha (excluyendo un grupo)
    public function aprendicesOcupadosEnFicha(int $idFicha, int $excluirGrupo = 0): array
    {
        $sql = "SELECT DISTINCT gi.id_aprendiz
                FROM grupo_integrantes gi
                JOIN grupos g ON g.id_grupo = gi.id_grupo
                JOIN asignaciones a ON a.id_asignacion = g.id_asignacion
                WHERE a.id_ficha = :fic";
        if ($excluirGrupo) $sql .= " AND g.id_grupo != :excluir";
        $stmt = $this->conn->prepare($sql);
        $params = [':fic' => $idFicha];
        if ($excluirGrupo) $params[':excluir'] = $excluirGrupo;
        $stmt->execute($params);
        return array_column($stmt->fetchAll(PDO::FETCH_ASSOC), 'id_aprendiz');
    }

    // Genera el nombre automático del próximo grupo (Grupo 1, Grupo 2…)
    // Usa el máximo número existente + 1 para evitar duplicados tras eliminar
    public function proximoNombreGrupo(int $idVocero): string
    {
        $stmt = $this->conn->prepare(
            "SELECT COALESCE(MAX(
                CAST(REGEXP_REPLACE(nombre_grupo, '[^0-9]', '') AS UNSIGNED)
             ), 0)
             FROM grupos WHERE id_vocero = :id"
        );
        $stmt->execute([':id' => $idVocero]);
        $max = (int)$stmt->fetchColumn();
        return "Grupo " . ($max + 1);
    }

    // Renumera todos los grupos del vocero en orden de id_grupo ASC
    // para que siempre queden Grupo 1, Grupo 2, Grupo 3…
    public function renumerarGrupos(int $idVocero): void
    {
        $stmt = $this->conn->prepare(
            "SELECT id_grupo FROM grupos WHERE id_vocero = :id ORDER BY id_grupo ASC"
        );
        $stmt->execute([':id' => $idVocero]);
        $ids = array_column($stmt->fetchAll(PDO::FETCH_ASSOC), 'id_grupo');

        $upd = $this->conn->prepare(
            "UPDATE grupos SET nombre_grupo = :n WHERE id_grupo = :id"
        );
        foreach ($ids as $i => $idGrupo) {
            $upd->execute([':n' => 'Grupo ' . ($i + 1), ':id' => $idGrupo]);
        }
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
