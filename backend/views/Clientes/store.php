<?php
require_once __DIR__ . '/../../controllers/ClienteController.php';

$controller = new ClienteController();
$data = [
    'nombre' => $_POST['nombre'],
    'email' => $_POST['email'],
    'telefono' => $_POST['telefono'],
    'direccion' => $_POST['direccion'],
    'contraseña' => $_POST['contraseña'],
];

if ($controller->store($data)) {
    header('Location: index.php');
} else {
    echo "Error al guardar el cliente.";
}
?>
