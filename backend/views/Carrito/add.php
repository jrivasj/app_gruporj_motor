<?php
require_once __DIR__ . '/../../controllers/CarritoController.php';

$usuario_id = 1; // Cambiar por el ID del usuario actual
$vehiculo_id = $_GET['id'];

if (!$vehiculo_id) {
    echo "No se especificó un vehículo.";
    exit;
}

$carritoController = new CarritoController();
if ($carritoController->addToCart($usuario_id, $vehiculo_id)) {
    header('Location: index.php?message=Vehículo agregado al carrito con éxito.');
} else {
    echo "Error al agregar el vehículo al carrito.";
}
?>
