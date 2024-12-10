<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap.min.css">
    <script src="../../assets/bootstrap/js/bootstrap.bundle.min.js" defer></script>
    <title>Carrito de Compras</title>
</head>
<body>
    <div class="container my-5">
        <h2 class="mb-4">Tu Carrito de Compras</h2>
        <?php
        require_once __DIR__ . '/../../controllers/CarritoController.php';
        $controller = new CarritoController();
        $carrito = $controller->getCart(1); // Cambiar 1 por el ID del usuario actual

        if (isset($_GET['message'])) {
            echo "<div class='alert alert-success'>{$_GET['message']}</div>";
        }

        if (empty($carrito)) {
            echo "<div class='alert alert-warning'>Tu carrito está vacío.</div>";
        } else {
            echo "<table class='table table-bordered'>
                    <thead class='table-light'>
                        <tr>
                            <th>Marca</th>
                            <th>Modelo</th>
                            <th>Precio</th>
                            <th>Cantidad</th>
                            <th>Subtotal</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>";
            $total = 0;
            foreach ($carrito as $item) {
                $subtotal = $item['cantidad'] * $item['precio'];
                $total += $subtotal;
                echo "<tr>
                        <td>{$item['marca']}</td>
                        <td>{$item['modelo']}</td>
                        <td>{$item['precio']} €</td>
                        <td>{$item['cantidad']}</td>
                        <td>{$subtotal} €</td>
                        <td>
                            <a href='remove.php?id={$item['vehiculo_id']}' class='btn btn-danger btn-sm'>Eliminar</a>
                        </td>
                      </tr>";
            }
            echo "</tbody></table>";
            echo "<div class='mt-3'>
                    <p class='h5'>Total: <strong>$total €</strong></p>
                    <a href='checkout.php' class='btn btn-success'>Finalizar Compra</a>
                  </div>";
        }
        ?>
    </div>
</body>
</html>
