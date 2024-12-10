<?php

include_once '../models/Carrito.php';

class CarritoController {
    private $carrito;

    public function __construct($pdo) {
        $this->carrito = new Carrito($pdo);
    }

    // Método para agregar un artículo al carrito
    public function addToCart() {
        // Verificar que se haya enviado el ID del usuario y el ID del vehículo
        if (isset($_POST['usuario_id'], $_POST['vehiculo_id'], $_POST['cantidad'])) {
            $usuario_id = $_POST['usuario_id'];
            $vehiculo_id = $_POST['vehiculo_id'];
            $cantidad = $_POST['cantidad'];

            // Llamar al modelo para agregar el artículo al carrito
            $result = $this->carrito->addToCart($usuario_id, $vehiculo_id, $cantidad);
            
            if ($result) {
                header('Location: /carrito'); // Redirigir al carrito si se añade correctamente
            } else {
                echo "Error al añadir al carrito.";
            }
        } else {
            echo "Datos incompletos.";
        }
    }

    // Obtener todos los artículos en el carrito del usuario
    public function getCart($usuario_id) {
        $cartItems = $this->carrito->getCart($usuario_id);
        include '../views/Carrito/index.php'; // Mostrar los artículos del carrito
    }

    // Eliminar un artículo del carrito
    public function removeFromCart() {
        if (isset($_POST['usuario_id'], $_POST['vehiculo_id'])) {
            $usuario_id = $_POST['usuario_id'];
            $vehiculo_id = $_POST['vehiculo_id'];

            $result = $this->carrito->removeFromCart($usuario_id, $vehiculo_id);

            if ($result) {
                header('Location: /carrito'); // Redirigir al carrito después de eliminar el artículo
            } else {
                echo "Error al eliminar del carrito.";
            }
        }
    }

    // Limpiar el carrito del usuario
    public function clearCart($usuario_id) {
        $result = $this->carrito->clearCart($usuario_id);

        if ($result) {
            header('Location: /carrito'); // Redirigir al carrito después de limpiar
        } else {
            echo "Error al limpiar el carrito.";
        }
    }
}
?>
