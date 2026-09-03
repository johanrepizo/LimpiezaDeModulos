<?php

class Usuario
{
    private $conn;
    private $tabla = "usuarios";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function obtenerPorEmail(string $correo): array|false
    {
        $stmt = $this->conn->prepare(
            "SELECT * FROM {$this->tabla} WHERE correo = :correo LIMIT 1"
        );
        $stmt->execute([':correo' => $correo]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function obtenerPorId(int $id): array|false
    {
        $stmt = $this->conn->prepare(
            "SELECT * FROM {$this->tabla} WHERE id_usuario = :id LIMIT 1"
        );
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function registrarIntentoFallido(int $id): void
    {
        $stmt = $this->conn->prepare(
            "UPDATE {$this->tabla}
             SET intentos_fallidos = IFNULL(intentos_fallidos, 0) + 1,
                 bloqueado_hasta = IF(
                     IFNULL(intentos_fallidos, 0) + 1 >= 3,
                     DATE_ADD(NOW(), INTERVAL 15 MINUTE),
                     bloqueado_hasta
                 )
             WHERE id_usuario = :id"
        );
        $stmt->execute([':id' => $id]);
    }

    public function resetearIntentos(int $id): void
    {
        $stmt = $this->conn->prepare(
            "UPDATE {$this->tabla}
             SET intentos_fallidos = 0, bloqueado_hasta = NULL
             WHERE id_usuario = :id"
        );
        $stmt->execute([':id' => $id]);
    }

    public function marcarPrimerAccesoCompletado(int $id): bool
    {
        $stmt = $this->conn->prepare(
            "UPDATE {$this->tabla} SET primer_acceso = 0 WHERE id_usuario = :id"
        );
        return $stmt->execute([':id' => $id]);
    }

    public function actualizarPassword(int $id, string $hashPassword): bool
    {
        $stmt = $this->conn->prepare(
            "UPDATE {$this->tabla}
             SET password = :password, primer_acceso = 0,
                 intentos_fallidos = 0, bloqueado_hasta = NULL
             WHERE id_usuario = :id"
        );
        return $stmt->execute([':password' => $hashPassword, ':id' => $id]);
    }

    public function existeCorreo(string $correo): bool
    {
        $stmt = $this->conn->prepare(
            "SELECT id_usuario FROM {$this->tabla} WHERE correo = :correo LIMIT 1"
        );
        $stmt->execute([':correo' => $correo]);
        return $stmt->rowCount() > 0;
    }

    // Crea un token de recuperación y lo almacena (se guarda en sesión para flujo simple)
    public function solicitarRestablecimiento(string $correo): string|false
    {
        $stmt = $this->conn->prepare(
            "SELECT id_usuario FROM {$this->tabla} WHERE correo = :correo AND activo = 1 LIMIT 1"
        );
        $stmt->execute([':correo' => $correo]);
        if ($stmt->rowCount() === 0) {
            return false; // No confirmamos existencia por seguridad
        }
        return true;
    }

    public function actualizarPasswordPorCorreo(string $correo, string $hashPassword): bool
    {
        $stmt = $this->conn->prepare(
            "UPDATE {$this->tabla}
             SET password = :password,
                 intentos_fallidos = 0,
                 bloqueado_hasta = NULL
             WHERE correo = :correo"
        );
        return $stmt->execute([':password' => $hashPassword, ':correo' => $correo]);
    }

    public function crearVocero(array $datos): int|false
    {
        try {
            $stmt = $this->conn->prepare(
                "INSERT INTO {$this->tabla}
                    (id_rol, nombres, apellidos, documento, celular, correo, password, primer_acceso)
                 VALUES (2, :nombres, :apellidos, :documento, :celular, :correo, :password, 1)"
            );
            $stmt->execute([
                ':nombres'   => $datos['nombres'],
                ':apellidos' => $datos['apellidos'],
                ':documento' => $datos['documento'] ?? null,
                ':celular'   => $datos['celular']   ?? null,
                ':correo'    => $datos['correo'],
                ':password'  => $datos['password'],
            ]);
            return (int) $this->conn->lastInsertId();
        } catch (Exception $e) {
            return false;
        }
    }

    public function obtenerTodos(): array
    {
        $stmt = $this->conn->query(
            "SELECT u.*, r.nombre_rol
             FROM {$this->tabla} u
             JOIN roles r ON u.id_rol = r.id_rol
             ORDER BY u.nombres"
        );
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
