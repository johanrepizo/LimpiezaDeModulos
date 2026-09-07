<?php
class Turno
{
    private PDO $conn;

    public function __construct(PDO $db) { $this->conn = $db; }

    /**
     * Genera turnos semanales para una asignación (INSERT IGNORE).
     * Retorna la cantidad de turnos creados.
     */
    public function generarTurnosAsignacion(int $idAsignacion): int
    {
        $stmt = $this->conn->prepare(
            "SELECT id_asignacion, fecha_inicio, fecha_fin, dia_semana
             FROM asignaciones WHERE id_asignacion = :id LIMIT 1"
        );
        $stmt->execute([':id' => $idAsignacion]);
        $asig = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$asig) return 0;

        $inicio  = new DateTime($asig['fecha_inicio']);
        $fin     = new DateTime($asig['fecha_fin']);
        $diaSem  = (int)$asig['dia_semana']; // 0=Dom … 6=Sáb

        // Mover $inicio al primer día de semana correcto >= fecha_inicio
        $diaCurrent = (int)$inicio->format('w');
        $diff = ($diaSem - $diaCurrent + 7) % 7;
        if ($diff > 0) $inicio->modify("+{$diff} days");

        $ins = $this->conn->prepare(
            "INSERT IGNORE INTO turnos
               (id_asignacion, fecha_turno, fecha_apertura, fecha_cierre, estado)
             VALUES (:asig, :fecha, :apertura, :cierre, 'Pendiente')"
        );

        $count  = 0;
        $cursor = clone $inicio;
        while ($cursor <= $fin) {
            $fechaStr = $cursor->format('Y-m-d');
            $ins->execute([
                ':asig'     => $idAsignacion,
                ':fecha'    => $fechaStr,
                ':apertura' => $fechaStr . ' 00:00:00',
                ':cierre'   => $fechaStr . ' 23:59:59',
            ]);
            $count++;
            $cursor->modify('+7 days');
        }
        return $count;
    }

    /**
     * Devuelve la fecha del próximo turno SIN grupo asignado (>= hoy) para una asignación.
     * Esta es la fecha que se asignará automáticamente al siguiente grupo creado.
     */
    public function proximaFechaLibre(int $idAsignacion): string|false
    {
        $stmt = $this->conn->prepare(
            "SELECT fecha_turno FROM turnos
             WHERE id_asignacion = :asig
               AND id_grupo IS NULL
               AND fecha_turno >= CURDATE()
             ORDER BY fecha_turno ASC
             LIMIT 1"
        );
        $stmt->execute([':asig' => $idAsignacion]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ? $row['fecha_turno'] : false;
    }

    /**
     * Vincula un grupo recién creado al turno que coincide con la fecha asignada.
     */
    public function asignarGrupoAlTurno(int $idAsignacion, string $fechaTurno, int $idGrupo): void
    {
        $this->conn->prepare(
            "UPDATE turnos
             SET id_grupo = :grupo
             WHERE id_asignacion = :asig AND fecha_turno = :fecha AND id_grupo IS NULL
             LIMIT 1"
        )->execute([
            ':grupo' => $idGrupo,
            ':asig'  => $idAsignacion,
            ':fecha' => $fechaTurno,
        ]);
    }

    /**
     * Cuenta cuántos turnos sin grupo quedan en la asignación.
     */
    public function turnosLibresRestantes(int $idAsignacion): int
    {
        $stmt = $this->conn->prepare(
            "SELECT COUNT(*) FROM turnos
             WHERE id_asignacion = :asig
               AND id_grupo IS NULL
               AND fecha_turno >= CURDATE()"
        );
        $stmt->execute([':asig' => $idAsignacion]);
        return (int)$stmt->fetchColumn();
    }

    /**
     * Cada turno le corresponde a un grupo diferente en orden de creación (id_grupo ASC).
     * El turno del miércoles N → Grupo A, el del miércoles N+1 → Grupo B, etc.
     */
    public function asignarGruposRotacion(int $idAsignacion): void
    {
        // Grupos de la asignación ordenados por id_grupo ASC (orden de creación)
        $stmtG = $this->conn->prepare(
            "SELECT id_grupo FROM grupos
             WHERE id_asignacion = :asig
             ORDER BY id_grupo ASC"
        );
        $stmtG->execute([':asig' => $idAsignacion]);
        $grupos = $stmtG->fetchAll(PDO::FETCH_COLUMN);
        if (empty($grupos)) return;

        // Todos los turnos de la asignación ordenados por fecha ASC
        $stmtT = $this->conn->prepare(
            "SELECT id_turno, fecha_turno FROM turnos
             WHERE id_asignacion = :asig
             ORDER BY fecha_turno ASC"
        );
        $stmtT->execute([':asig' => $idAsignacion]);
        $turnos = $stmtT->fetchAll(PDO::FETCH_ASSOC);

        $updTurno = $this->conn->prepare(
            "UPDATE turnos SET id_grupo = :grupo WHERE id_turno = :turno"
        );
        $updGrupo = $this->conn->prepare(
            "UPDATE grupos SET fecha_limpieza = :fecha WHERE id_grupo = :id"
        );

        $n = count($grupos);
        foreach ($turnos as $i => $t) {
            $idGrupo = $grupos[$i % $n];
            $updTurno->execute([':grupo' => $idGrupo, ':turno' => $t['id_turno']]);
            // Actualizar la fecha_limpieza del grupo con el turno que le corresponde
            // (la más próxima futura o la del primer turno asignado)
            $updGrupo->execute([':fecha' => $t['fecha_turno'], ':id' => $idGrupo]);
        }
    }

    /**
     * Devuelve el turno activo HOY para la ficha del vocero.
     */
    public function turnoActivoHoy(int $idFicha): array|false
    {
        $stmt = $this->conn->prepare(
            "SELECT t.*,
                    a.id_modulo,
                    m.nombre   AS nombre_modulo,
                    m.ubicacion,
                    g.nombre_grupo,
                    g.id_grupo AS id_grupo_turno,
                    (SELECT COUNT(*) FROM evidencias e
                     WHERE e.id_turno = t.id_turno) AS tiene_evidencia
             FROM turnos t
             JOIN asignaciones a ON a.id_asignacion = t.id_asignacion
             JOIN modulos      m ON m.id_modulo     = a.id_modulo
             LEFT JOIN grupos  g ON g.id_grupo      = t.id_grupo
             WHERE a.id_ficha    = :ficha
               AND t.fecha_turno = CURDATE()
               AND NOW() BETWEEN t.fecha_apertura AND t.fecha_cierre
             LIMIT 1"
        );
        $stmt->execute([':ficha' => $idFicha]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Historial de turnos de la ficha ordenados desc.
     */
    public function historialFicha(int $idFicha, int $limit = 15): array
    {
        $stmt = $this->conn->prepare(
            "SELECT t.*,
                    m.nombre AS nombre_modulo,
                    g.nombre_grupo,
                    (SELECT COUNT(*) FROM evidencias e
                     WHERE e.id_turno = t.id_turno) AS tiene_evidencia
             FROM turnos t
             JOIN asignaciones a ON a.id_asignacion = t.id_asignacion
             JOIN modulos      m ON m.id_modulo     = a.id_modulo
             LEFT JOIN grupos  g ON g.id_grupo      = t.id_grupo
             WHERE a.id_ficha = :ficha
             ORDER BY t.fecha_turno DESC
             LIMIT :lim"
        );
        $stmt->bindValue(':ficha', $idFicha, PDO::PARAM_INT);
        $stmt->bindValue(':lim',   $limit,   PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Marca turnos pasados sin evidencia como Incumplido.
     */
    public function cerrarTurnosVencidos(): void
    {
        $this->conn->exec(
            "UPDATE turnos t
             SET t.estado = 'Incumplido'
             WHERE t.fecha_cierre < NOW()
               AND t.estado IN ('Pendiente','Abierto')
               AND NOT EXISTS (
                   SELECT 1 FROM evidencias e WHERE e.id_turno = t.id_turno
               )"
        );
    }

    /**
     * Abre los turnos de hoy (Pendiente → Abierto).
     */
    public function abrirTurnosHoy(): void
    {
        $this->conn->exec(
            "UPDATE turnos SET estado = 'Abierto'
             WHERE fecha_turno = CURDATE() AND estado = 'Pendiente'"
        );
    }

    /**
     * Marca turno como Cumplido al registrar evidencia.
     */
    public function marcarCumplido(int $idTurno): void
    {
        $this->conn->prepare(
            "UPDATE turnos SET estado = 'Cumplido' WHERE id_turno = :id"
        )->execute([':id' => $idTurno]);
    }

    /**
     * Turnos próximos de la ficha (hoy en adelante).
     */
    public function proximosFicha(int $idFicha, int $limit = 5): array
    {
        $stmt = $this->conn->prepare(
            "SELECT t.*, m.nombre AS nombre_modulo, g.nombre_grupo
             FROM turnos t
             JOIN asignaciones a ON a.id_asignacion = t.id_asignacion
             JOIN modulos      m ON m.id_modulo     = a.id_modulo
             LEFT JOIN grupos  g ON g.id_grupo      = t.id_grupo
             WHERE a.id_ficha   = :ficha
               AND t.fecha_turno >= CURDATE()
             ORDER BY t.fecha_turno ASC
             LIMIT :lim"
        );
        $stmt->bindValue(':ficha', $idFicha, PDO::PARAM_INT);
        $stmt->bindValue(':lim',   $limit,   PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
