<?php
class Compra {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    /**
     * Obtener todas las compras.
     *
     * @return array Lista de todas las compras
     */
    public function getAll() {
        try {
            $stmt = $this->pdo->query("SELECT * FROM compras");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error al obtener las compras: " . $e->getMessage());
            return [];
        }
    }

    /**
     * Obtener una compra por su ID.
     *
     * @param int $id ID de la compra
     * @return array Información de la compra
     */
    public function getById($id) {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM compras WHERE id = ?");
            $stmt->execute([$id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error al obtener la compra: " . $e->getMessage());
            return null;
        }
    }

    /**
     * Crear una nueva compra.
     *
     * @param int $cliente_id ID del cliente
     * @param int $vehiculo_id ID del vehículo
     * @param string $fecha_compra Fecha de la compra
     * @param float $precio_compra Precio de la compra
     */
    public function create($cliente_id, $vehiculo_id, $fecha_compra, $precio_compra) {
        try {
            // Validación básica de los datos (puedes extenderla si es necesario)
            if (!is_numeric($precio_compra) || $precio_compra <= 0) {
                throw new Exception("El precio de la compra debe ser un valor positivo.");
            }

            $stmt = $this->pdo->prepare("INSERT INTO compras (cliente_id, vehiculo_id, fecha_compra, precio_compra) VALUES (?, ?, ?, ?)");
            $stmt->execute([$cliente_id, $vehiculo_id, $fecha_compra, $precio_compra]);
        } catch (PDOException $e) {
            error_log("Error al crear la compra: " . $e->getMessage());
        } catch (Exception $e) {
            error_log("Error de validación: " . $e->getMessage());
        }
    }

    /**
     * Eliminar una compra por su ID.
     *
     * @param int $id ID de la compra
     */
    public function delete($id) {
        try {
            $stmt = $this->pdo->prepare("DELETE FROM compras WHERE id = ?");
            $stmt->execute([$id]);
        } catch (PDOException $e) {
            error_log("Error al eliminar la compra: " . $e->getMessage());
        }
    }
}
?>
