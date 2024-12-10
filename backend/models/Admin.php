<?php

class Admin
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    // Método para login, autentica al administrador
    public function login($email, $password)
    {
        // Preparar la consulta SQL
        $stmt = $this->pdo->prepare("SELECT * FROM administradores WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        // Obtener el resultado
        $admin = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verificar si el administrador existe y si la contraseña es correcta
        if ($admin && password_verify($password, $admin['contraseña'])) {
            return $admin; // Devolver los datos del administrador si la autenticación es exitosa
        }

        return false; // Si la autenticación falla
    }

    // Método para obtener un administrador por su email
    public function getByEmail($email)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM administradores WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Método para registrar un nuevo administrador (si es necesario)
    public function register($email, $password, $nombre)
    {
        // Usar password_hash para almacenar la contraseña de forma segura
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        
        $stmt = $this->pdo->prepare("INSERT INTO administradores (email, contraseña, nombre) VALUES (?, ?, ?)");
        return $stmt->execute([$email, $hashedPassword, $nombre]);
    }
}

?>
