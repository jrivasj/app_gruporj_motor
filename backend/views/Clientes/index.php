<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clientes</title>
</head>

<body>
    <h2>Lista de Clientes</h2>
    <a href="create.php">Agregar Nuevo Cliente</a>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Correo Electrónico</th>
                <th>Teléfono</th>
                <th>Dirección</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
            require_once __DIR__ . '/../../controllers/ClienteController.php';
            $controller = new ClienteController();
            $clientes = $controller->index();

            foreach ($clientes as $cliente) {
                echo "<tr>
                        <td>{$cliente['id']}</td>
                        <td>{$cliente['nombre']}</td>
                        <td>{$cliente['email']}</td>
                        <td>{$cliente['telefono']}</td>
                        <td>{$cliente['direccion']}</td>
                        <td>
                            <a href='edit.php?id={$cliente['id']}'>Editar</a> |
                            <a href='delete.php?id={$cliente['id']}'
                               onclick='return confirm(\"¿Estás seguro de que deseas eliminar este cliente?\")'>Eliminar</a>
                        </td>
                      </tr>";
            }
            ?>
        </tbody>
    </table>
</body>

</html>