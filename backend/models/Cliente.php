<?php
class Cliente {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    /**
     * Obtener todos los clientes.
     *
     * @return array Lista de todos los clientes
     */
    public function getAll() {
        try {
            $stmt = $this->pdo->query("SELECT * FROM clientes");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error al obtener los clientes: " . $e->getMessage());
            return [];
        }
    }

    /**
     * Obtener un cliente por su ID.
     *
     * @param int $id ID del cliente
     * @return array Información del cliente
     */
    public function getById($id) {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM clientes WHERE id = ?");
            $stmt->execute([$id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error al obtener el cliente: " . $e->getMessage());
            return null;
        }
    }

    /**
     * Crear un nuevo cliente.
     *
     * @param string $nombre Nombre del cliente
     * @param string $email Email del cliente
     * @param string $telefono Teléfono del cliente
     * @param string $direccion Dirección del cliente
     * @param string $contraseña Contraseña del cliente
     */
    public function create($nombre, $email, $telefono, $direccion, $contraseña) {
        try {
            // Validación básica de datos (puedes extenderla según sea necesario)
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                throw new Exception("El email no es válido.");
            }

            $hashedPassword = password_hash($contraseña, PASSWORD_DEFAULT);

            $stmt = $this->pdo->prepare("INSERT INTO clientes (nombre, email, telefono, direccion, contraseña) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$nombre, $email, $telefono, $direccion, $hashedPassword]);
        } catch (PDOException $e) {
            error_log("Error al crear el cliente: " . $e->getMessage());
        } catch (Exception $e) {
            error_log("Error de validación: " . $e->getMessage());
        }
    }

    /**
     * Actualizar la información de un cliente.
     *
     * @param int $id ID del cliente
     * @param string $nombre Nombre del cliente
     * @param string $email Email del cliente
     * @param string $telefono Teléfono del cliente
     * @param string $direccion Dirección del cliente
     */
    public function update($id, $nombre, $email, $telefono, $direccion) {
        try {
            // Validación básica de datos
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                throw new Exception("El email no es válido.");
            }

            $stmt = $this->pdo->prepare("UPDATE clientes SET nombre = ?, email = ?, telefono = ?, direccion = ? WHERE id = ?");
            $stmt->execute([$nombre, $email, $telefono, $direccion, $id]);
        } catch (PDOException $e) {
            error_log("Error al actualizar el cliente: " . $e->getMessage());
        } catch (Exception $e) {
            error_log("Error de validación: " . $e->getMessage());
        }
    }

    /**
     * Eliminar un cliente por su ID.
     *
     * @param int $id ID del cliente
     */
    public function delete($id) {
        try {
            $stmt = $this->pdo->prepare("DELETE FROM clientes WHERE id = ?");
            $stmt->execute([$id]);
        } catch (PDOException $e) {
            error_log("Error al eliminar el cliente: " . $e->getMessage());
        }
    }
}
?>
