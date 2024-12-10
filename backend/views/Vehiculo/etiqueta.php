// views/vehiculos/etiqueta.php
<?php foreach ($vehiculos as $vehiculo): ?>
    <div class="vehiculo">
        <h3><?php echo $vehiculo['marca'] . ' ' . $vehiculo['modelo']; ?></h3>
        <p>Año: <?php echo $vehiculo['año']; ?></p>
        <p>Precio: $<?php echo number_format($vehiculo['precio'], 2); ?></p>
        <p>Etiqueta: <?php echo $vehiculo['etiqueta']; ?></p>
    </div>
<?php endforeach; ?>
