<?php
require 'config/db.php';

// Obtener el método HTTP de la solicitud (GET, POST, etc.)
$method = $_SERVER['REQUEST_METHOD'];

// Obtener la URL actual
$url = $_SERVER['REQUEST_URI'];

// Eliminar parámetros de la URL si existen (solo la ruta principal)
$url = strtok($url, '?');

// Manejo de rutas con diferentes métodos
switch ($url) {
    // Rutas para el login del administrador
    case '/admin/login':
        if ($method === 'GET') {
            $authController = new AuthController($pdo);
            $authController->loginForm();
        } elseif ($method === 'POST') {
            $authController = new AuthController($pdo);
            $authController->login();
        }
        break;
    
    // Ruta para el dashboard del administrador
    case '/admin/dashboard':
        if ($method === 'GET') {
            $adminController = new AdminController($pdo);
            $adminController->dashboard();
        }
        break;

    // Rutas para mostrar y gestionar vehículos
    case '/vehiculos':
        if ($method === 'GET') {
            $vehiculoController = new VehiculoController($pdo);
            $vehiculoController->mostrarVehiculos();
        }
        break;
    
    // Ruta para mostrar vehículos por etiqueta
    case '/vehiculos/etiqueta/{tag}':
        if ($method === 'GET') {
            // Extraer la etiqueta de la URL
            $tag = str_replace('/vehiculos/etiqueta/', '', $url); // Extrae el valor de la etiqueta
            $vehiculoController = new VehiculoController($pdo);
            $vehiculoController->mostrarPorEtiqueta($tag);
        }
        break;

    // Ruta para mostrar una compra específica
    case '/compras/show':
        if ($method === 'GET') {
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                $compraController = new CompraController($pdo);
                $compraController->show($id);
            } else {
                echo "ID de compra no proporcionado";
            }
        }
        break;

    // Ruta para mostrar todas las compras
    case '/compras':
        if ($method === 'GET') {
            $compraController = new CompraController($pdo);
            $compraController->index();
        }
        // Ruta para crear una nueva compra
        elseif ($method === 'POST') {
            $compraController = new CompraController($pdo);
            $compraController->create();
        }
        break;

    // Ruta para actualizar el stock de un vehículo
    case '/vehiculos/{id}/stock':
        if ($method === 'POST') {
            // Extraer el parámetro de ID y la cantidad desde el formulario
            $id = $_POST['id'];
            $quantity = $_POST['quantity'];  // Asegúrate de que la cantidad esté pasada por el formulario
            $vehiculoController = new VehiculoController($pdo);
            $vehiculoController->actualizarStock($id, $quantity);
        }
        break;

    // Ruta para agregar una etiqueta a un vehículo
    case '/vehiculos/{id}/etiqueta':
        if ($method === 'POST') {
            // Extraer el parámetro de ID y la etiqueta desde el formulario
            $id = $_POST['id'];
            $tag = $_POST['tag'];  // La etiqueta debe ser enviada por el formulario
            $vehiculoController = new VehiculoController($pdo);
            $vehiculoController->agregarEtiqueta($id, $tag);
        }
        break;

    default:
        echo "Página no encontrada";
        break;
}
?>
