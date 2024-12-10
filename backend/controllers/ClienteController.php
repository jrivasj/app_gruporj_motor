<?php
include_once '../models/Cliente.php';

class ClienteController {
    private $cliente;

    public function __construct($pdo) {
        $this->cliente = new Cliente($pdo);
    }

    // Mostrar todos los clientes
    public function index() {
        $clientes = $this->cliente->getAll();
        include '../views/clients/index.php';
    }

    // Crear nuevo cliente
    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Validación básica de campos
            if (empty($_POST['nombre']) || empty($_POST['email']) || empty($_POST['contraseña'])) {
                $error = "Todos los campos son obligatorios.";
                include '../views/clients/create.php';
                return;
            }

            // Asegurarse de que la contraseña esté cifrada
            $hashed_password = password_hash($_POST['contraseña'], PASSWORD_DEFAULT);

            // Crear el cliente
            $this->cliente->create($_POST['nombre'], $_POST['email'], $_POST['telefono'], $_POST['direccion'], $hashed_password);
            header('Location: /clientes');
        } else {
            include '../views/clients/create.php';
        }
    }

    // Editar cliente
    public function edit($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Validación básica de campos
            if (empty($_POST['nombre']) || empty($_POST['email'])) {
                $error = "Nombre y correo son obligatorios.";
                include '../views/clients/edit.php';
                return;
            }

            // Si el campo de contraseña no está vacío, la ciframos y la actualizamos
            $password = !empty($_POST['contraseña']) ? password_hash($_POST['contraseña'], PASSWORD_DEFAULT) : null;

            // Actualizar el cliente
            $this->cliente->update($id, $_POST['nombre'], $_POST['email'], $_POST['telefono'], $_POST['direccion'], $password);
            header('Location: /clientes');
        } else {
            $cliente = $this->cliente->getById($id);
            include '../views/clients/edit.php';
        }
    }

    // Eliminar cliente
    public function delete($id) {
        $this->cliente->delete($id);
        header('Location: /clientes');
    }
}
?>
