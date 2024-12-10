CREATE DATABASE IF NOT EXISTS gruporj_motor;
USE gruporj_motor;

-- Tabla 'administradores'
CREATE TABLE IF NOT EXISTS `administradores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL UNIQUE,
  `contraseña` varchar(255) NOT NULL,
  `rol` enum('admin', 'editor') DEFAULT 'admin',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Tabla 'clientes'
CREATE TABLE IF NOT EXISTS `clientes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL UNIQUE,
  `telefono` varchar(15) DEFAULT NULL,
  `direccion` varchar(150) DEFAULT NULL,
  `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp(),
  `contraseña` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Tabla 'vehiculos'
CREATE TABLE IF NOT EXISTS `vehiculos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `marca` varchar(50) NOT NULL,
  `modelo` varchar(50) NOT NULL,
  `año` int(11) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `stock` int(11) DEFAULT 1 CHECK (stock >= 0), -- Asegurarse de que stock no sea negativo
  `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Tabla 'compras'
CREATE TABLE IF NOT EXISTS `compras` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cliente_id` int(11) DEFAULT NULL,
  `vehiculo_id` int(11) DEFAULT NULL,
  `fecha_compra` timestamp NOT NULL DEFAULT current_timestamp(),
  `precio_compra` decimal(10,2) DEFAULT NULL,
  `estado` enum('pendiente', 'pagado', 'enviado', 'cancelado') DEFAULT 'pendiente', -- Estado de la compra
  PRIMARY KEY (`id`),
  FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id`),
  FOREIGN KEY (`vehiculo_id`) REFERENCES `vehiculos` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Tabla 'carrito'
CREATE TABLE `carrito` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_id` int(11) NOT NULL,
  `vehiculo_id` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL DEFAULT 1,
  `fecha_agregado` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `usuario_id` (`usuario_id`),
  KEY `vehiculo_id` (`vehiculo_id`)
);
