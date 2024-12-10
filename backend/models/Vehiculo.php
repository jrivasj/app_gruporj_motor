<?php
// models/Vehiculo.php
class Vehiculo {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Obtener vehículos disponibles (con stock > 0)
    public function getAvailableVehicles() {
        $stmt = $this->pdo->prepare("SELECT * FROM vehiculos WHERE stock > 0");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Actualizar el stock de un vehículo
    public function updateStock($id) {
        $stmt = $this->pdo->prepare("UPDATE vehiculos SET stock = stock - 1 WHERE id = :id AND stock > 0");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

    // Agregar etiqueta a un vehículo (Ej: "Nuevo", "Usado", "En Oferta")
    public function addTag($id, $tag) {
        $stmt = $this->pdo->prepare("UPDATE vehiculos SET etiqueta = :tag WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':tag', $tag);
        $stmt->execute();
    }

    // Obtener vehículos con stock disponible
    public function getVehiculosWithStock() {
        $stmt = $this->pdo->prepare("SELECT * FROM vehiculos WHERE stock > 0 ORDER BY marca ASC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener vehículos por etiqueta
    public function getVehiculosByTag($tag) {
        $stmt = $this->pdo->prepare("SELECT * FROM vehiculos WHERE etiqueta = :tag");
        $stmt->bindParam(':tag', $tag);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener un vehículo por su ID
    public function getById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM vehiculos WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
