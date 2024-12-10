<h2>Lista de Compras</h2>
<table>
    <thead>
        <tr>
            <th>Cliente</th>
            <th>Vehículo</th>
            <th>Fecha de Compra</th>
            <th>Precio</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($compras as $compra): ?>
        <tr>
            <td>
                <?php 
                $cliente = (new Cliente($pdo))->getById($compra['cliente_id']);
                echo $cliente['nombre'];
                ?>
            </td>
            <td>
                <?php 
                $vehiculo = (new Vehiculo($pdo))->getById($compra['vehiculo_id']);
                echo $vehiculo['marca'] . ' ' . $vehiculo['modelo'];
                ?>
            </td>
            <td><?php echo $compra['fecha_compra']; ?></td>
            <td><?php echo $compra['precio_compra']; ?> €</td>
            <td>
                <a href="/compras/show/<?php echo $compra['id']; ?>">Ver</a> |
                <a href="/compras/delete/<?php echo $compra['id']; ?>">Eliminar</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
