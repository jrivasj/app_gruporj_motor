<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Vehículo</title>
</head>
<body>
    <h2>Agregar Nuevo Vehículo</h2>
    <form action="../Vehiculos/store.php" method="POST">
        <label for="marca">Marca:</label>
        <input type="text" id="marca" name="marca" required>
        <br>
        
        <label for="modelo">Modelo:</label>
        <input type="text" id="modelo" name="modelo" required>
        <br>
        
        <label for="año">Año:</label>
        <input type="number" id="año" name="año" required>
        <br>
        
        <label for="precio">Precio:</label>
        <input type="number" step="0.01" id="precio" name="precio" required>
        <br>
        
        <label for="descripcion">Descripción:</label>
        <textarea id="descripcion" name="descripcion"></textarea>
        <br>
        
        <label for="stock">Stock:</label>
        <input type="number" id="stock" name="stock" required value="1">
        <br>
        
        <button type="submit">Guardar</button>
    </form>
    <a href="index.php">Volver a la lista de vehículos</a>
</body>
</html>
