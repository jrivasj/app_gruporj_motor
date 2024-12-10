<?php
session_start();  // Iniciar la sesión para manejar las variables de sesión

include_once '../models/Admin.php';

class AdminController {
    private $admin;

    public function __construct($pdo) {
        $this->admin = new Admin($pdo);
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Obtener los datos del formulario de manera segura
            $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
            $password = $_POST['contraseña'];

            // Intentar hacer login
            $admin = $this->admin->login($email, $password);
            if ($admin) {
                $_SESSION['admin_id'] = $admin['id'];
                $_SESSION['admin_role'] = $admin['rol'];  // Agregar rol si es necesario
                header('Location: /admin/dashboard');
                exit();
            } else {
                $error = "Credenciales incorrectas. Inténtalo de nuevo.";
                include '../views/admin/login.php';
            }
        } else {
            include '../views/admin/login.php';
        }
    }

    public function dashboard() {
        // Verificar que el usuario esté autenticado
        if (!isset($_SESSION['admin_id'])) {
            header('Location: /admin/login');
            exit();
        }

        // Aquí podrías pasar información relevante a la vista (por ejemplo, estadísticas)
        include '../views/admin/dashboard.php';
    }
}
?>
