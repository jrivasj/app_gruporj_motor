<?php

class Carrito
{
    private $db;

    public function __construct($pdo)
    {
        $this->db = $pdo;
    }

    /**
     * Añadir un vehículo al carrito o actualizar su cantidad.
     *
     * @param int $usuario_id ID del usuario
     * @param int $vehiculo_id ID del vehículo
     * @param int $cantidad Cantidad a añadir
     * @return bool Resultado de la operación
     */
    public function addToCart($usuario_id, $vehiculo_id, $cantidad = 1)
    {
        try {
            // Verificar si el vehículo ya está en el carrito
            $query = $this->db->prepare("SELECT * FROM carrito WHERE usuario_id = ? AND vehiculo_id = ?");
            $query->execute([$usuario_id, $vehiculo_id]);
            $item = $query->fetch(PDO::FETCH_ASSOC);

            if ($item) {
                // Si ya existe, actualizar la cantidad
                $updateQuery = $this->db->prepare("UPDATE carrito SET cantidad = cantidad + ? WHERE usuario_id = ? AND vehiculo_id = ?");
                return $updateQuery->execute([$cantidad, $usuario_id, $vehiculo_id]);
            } else {
                // Si no existe, insertar el nuevo artículo al carrito
                $insertQuery = $this->db->prepare("INSERT INTO carrito (usuario_id, vehiculo_id, cantidad) VALUES (?, ?, ?)");
                return $insertQuery->execute([$usuario_id, $vehiculo_id, $cantidad]);
            }
        } catch (PDOException $e) {
            // Manejo de errores - se recomienda registrar el error en un log en lugar de mostrarlo
            error_log("Error al añadir al carrito: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Obtener los artículos del carrito de un usuario.
     *
     * @param int $usuario_id ID del usuario
     * @return array Lista de artículos del carrito
     */
    public function getCart($usuario_id)
    {
        try {
            $query = $this->db->prepare("SELECT c.*, v.marca, v.modelo, v.precio FROM carrito c
                                         JOIN vehiculos v ON c.vehiculo_id = v.id
                                         WHERE c.usuario_id = ?");
            $query->execute([$usuario_id]);
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Manejo de errores - se recomienda registrar el error en un log en lugar de mostrarlo
            error_log("Error al obtener el carrito: " . $e->getMessage());
            return [];
        }
    }

    /**
     * Eliminar un artículo del carrito.
     *
     * @param int $usuario_id ID del usuario
     * @param int $vehiculo_id ID del vehículo
     * @return bool Resultado de la operación
     */
    public function removeFromCart($usuario_id, $vehiculo_id)
    {
        try {
            $query = $this->db->prepare("DELETE FROM carrito WHERE usuario_id = ? AND vehiculo_id = ?");
            return $query->execute([$usuario_id, $vehiculo_id]);
        } catch (PDOException $e) {
            // Manejo de errores - se recomienda registrar el error en un log en lugar de mostrarlo
            error_log("Error al eliminar del carrito: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Limpiar el carrito de un usuario.
     *
     * @param int $usuario_id ID del usuario
     * @return bool Resultado de la operación
     */
    public function clearCart($usuario_id)
    {
        try {
            $query = $this->db->prepare("DELETE FROM carrito WHERE usuario_id = ?");
            return $query->execute([$usuario_id]);
        } catch (PDOException $e) {
            // Manejo de errores - se recomienda registrar el error en un log en lugar de mostrarlo
            error_log("Error al limpiar el carrito: " . $e->getMessage());
            return false;
        }
    }
}
