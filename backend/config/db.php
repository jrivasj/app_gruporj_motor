<?php
$host = 'localhost'; // Cambia según tu servidor
$dbname = 'gruporj_motor';
$username = 'root'; // Usuario de la base de datos
$password = ''; // Contraseña de la base de datos

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}
?>
