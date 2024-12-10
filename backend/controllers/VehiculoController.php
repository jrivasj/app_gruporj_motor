<?php
include_once '../models/Vehiculo.php';

class VehiculoController {
    private $vehiculo;

    public function __construct($pdo) {
        $this->vehiculo = new Vehiculo($pdo);
    }

    // Mostrar vehículos disponibles con stock
    public function mostrarVehiculos() {
        $vehiculos = $this->vehiculo->getVehiculosWithStock();
        include '../views/vehiculos/index.php';
    }

    // Actualizar stock de un vehículo
    public function actualizarStock($id, $quantity) {
        // Validar que el id y la cantidad sean válidos
        if (is_numeric($id) && is_numeric($quantity) && $quantity >= 0) {
            $vehiculo = $this->vehiculo->getById($id);
            if ($vehiculo) {
                $this->vehiculo->updateStock($id, $quantity);
                header('Location: /vehiculos');
            } else {
                echo "Vehículo no encontrado";
            }
        } else {
            echo "Datos inválidos";
        }
    }

    // Agregar etiqueta a un vehículo
    public function agregarEtiqueta($id, $tag) {
        // Validar que el id y la etiqueta sean válidos
        if (is_numeric($id) && !empty($tag)) {
            $vehiculo = $this->vehiculo->getById($id);
            if ($vehiculo) {
                $this->vehiculo->addTag($id, $tag);
                header('Location: /vehiculos');
            } else {
                echo "Vehículo no encontrado";
            }
        } else {
            echo "Datos inválidos";
        }
    }

    // Mostrar vehículos por etiqueta
    public function mostrarPorEtiqueta($tag) {
        // Validar que la etiqueta no esté vacía
        if (!empty($tag)) {
            $vehiculos = $this->vehiculo->getVehiculosByTag($tag);
            if ($vehiculos) {
                include '../views/vehiculos/etiqueta.php';
            } else {
                echo "No se encontraron vehículos con esa etiqueta";
            }
        } else {
            echo "Etiqueta no válida";
        }
    }
}
?>
