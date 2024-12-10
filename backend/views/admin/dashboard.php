<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    // Si no está logueado, redirigir al login
    header('Location: /admin/login');
    exit;
}
?>

<h2>Bienvenido al Panel de Administración</h2>
<p>¡Hola, <?php echo $_SESSION['admin_rol']; ?>!</p>
<nav>
    <ul>
        <li><a href="/productos">Gestionar Productos</a></li>
        <li><a href="/clientes">Gestionar Clientes</a></li>
        <li><a href="/compras">Gestionar Compras</a></li>
        <li><a href="/admin/logout">Cerrar Sesión</a></li>
    </ul>
</nav>
