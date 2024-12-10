<?php
session_start();
include_once '../models/Admin.php';

class AuthController {
    private $admin;

    public function __construct($pdo) {
        $this->admin = new Admin($pdo);
    }

    // Mostrar formulario de login
    public function loginForm() {
        // Verificar si ya está logueado
        if (isset($_SESSION['admin_id'])) {
            header('Location: /admin/dashboard');
            exit();
        }
        include '../views/admin/login.php';
    }

    // Procesar login
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Sanitizar y validar entradas
            $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
            $password = $_POST['contraseña'];
            
            // Validar usuario
            $admin = $this->admin->getByEmail($email);
            if ($admin && password_verify($password, $admin['contraseña'])) {
                // Regenerar ID de sesión para seguridad
                session_regenerate_id(true);
                
                // Establecer variables de sesión
                $_SESSION['admin_id'] = $admin['id'];
                $_SESSION['admin_rol'] = $admin['rol'];
                
                header('Location: /admin/dashboard');
                exit();
            } else {
                // Redirigir con error al login
                $_SESSION['error'] = "Credenciales incorrectas";
                header('Location: /admin/login');
                exit();
            }
        }
    }

    // Logout
    public function logout() {
        // Destruir las variables de sesión
        $_SESSION = [];
        
        // Eliminar cookies de sesión
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);
        }
        
        // Destruir la sesión
        session_destroy();
        
        header('Location: /admin/login');
        exit();
    }
}
?>
