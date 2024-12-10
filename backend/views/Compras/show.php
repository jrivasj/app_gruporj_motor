<h2>Detalles de la Compra</h2>
<div>
    <h3>Cliente: <?php echo $cliente['nombre']; ?></h3>
    <p><strong>Vehículo:</strong> <?php echo $vehiculo['marca'] . ' ' . $vehiculo['modelo']; ?></p>
    <p><strong>Fecha de Compra:</strong> <?php echo $compra['fecha_compra']; ?></p>
    <p><strong>Precio de Compra:</strong> <?php echo $compra['precio_compra']; ?> €</p>
    <a href="/compras">Volver a la lista</a>
</div>
