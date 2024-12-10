<?php
session_start(); // Iniciar la sesión

require 'config/db.php'; // Incluir la conexión a la base de datos

// Comprobar si el formulario de login ha sido enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener los datos del formulario
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validar que los campos no estén vacíos
    if (empty($email) || empty($password)) {
        echo "Por favor, complete todos los campos.";
        exit;
    }

    // Consultar la base de datos para obtener el usuario con ese correo
    $stmt = $pdo->prepare("SELECT * FROM administradores WHERE email = :email");
    $stmt->execute(['email' => $email]);
    $user = $stmt->fetch();

    // Si no se encuentra el usuario
    if (!$user) {
        echo "Correo electrónico o contraseña incorrectos.";
        exit;
    }

    // Verificar la contraseña
    if (password_verify($password, $user['contraseña'])) {
        // Si las credenciales son correctas, iniciar sesión
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['nombre'];
        $_SESSION['user_role'] = $user['rol'];

        // Redirigir al dashboard
        header('Location: /admin/dashboard');
        exit;
    } else {
        echo "Correo electrónico o contraseña incorrectos.";
    }
}
?>
