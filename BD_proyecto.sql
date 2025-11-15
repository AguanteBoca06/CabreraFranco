-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         8.4.3 - MySQL Community Server - GPL
-- SO del servidor:              Win64
-- HeidiSQL Versión:             12.8.0.6908
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Volcando estructura de base de datos para petcontrol
CREATE DATABASE IF NOT EXISTS `petcontrol` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `petcontrol`;

-- Volcando estructura para tabla petcontrol.animal
CREATE TABLE IF NOT EXISTS `animal` (
  `id_animal` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `especie` varchar(50) NOT NULL,
  `raza` varchar(50) DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `id_usuario` int DEFAULT NULL,
  PRIMARY KEY (`id_animal`),
  KEY `id_usuario` (`id_usuario`),
  CONSTRAINT `animal_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla petcontrol.animal: ~3 rows (aproximadamente)
INSERT INTO `animal` (`id_animal`, `nombre`, `especie`, `raza`, `fecha_nacimiento`, `id_usuario`) VALUES
	(1, 'Balu', 'Perro', 'Pastor Alemán', '2020-11-05', 2),
	(2, 'Monica', 'Gato', 'Persa', '2017-04-15', 2),
	(3, 'Catalina', 'Gato', 'Bimano', '2024-09-17', 7);

-- Volcando estructura para tabla petcontrol.controlvacuna
CREATE TABLE IF NOT EXISTS `controlvacuna` (
  `id_control` int NOT NULL AUTO_INCREMENT,
  `id_animal` int DEFAULT NULL,
  `id_vacuna` int DEFAULT NULL,
  `fecha` date NOT NULL,
  `dosis` varchar(50) DEFAULT NULL,
  `veterinario` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_control`),
  KEY `id_animal` (`id_animal`),
  KEY `id_vacuna` (`id_vacuna`),
  CONSTRAINT `controlvacuna_ibfk_1` FOREIGN KEY (`id_animal`) REFERENCES `animal` (`id_animal`),
  CONSTRAINT `controlvacuna_ibfk_2` FOREIGN KEY (`id_vacuna`) REFERENCES `vacuna` (`id_vacuna`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla petcontrol.controlvacuna: ~2 rows (aproximadamente)

-- Volcando estructura para tabla petcontrol.historiaclinica
CREATE TABLE IF NOT EXISTS `historiaclinica` (
  `id_historia` int NOT NULL AUTO_INCREMENT,
  `id_animal` int DEFAULT NULL,
  `fecha` date NOT NULL,
  `diagnostico` text,
  `observaciones` text,
  PRIMARY KEY (`id_historia`),
  KEY `id_animal` (`id_animal`),
  CONSTRAINT `historiaclinica_ibfk_1` FOREIGN KEY (`id_animal`) REFERENCES `animal` (`id_animal`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla petcontrol.historiaclinica: ~0 rows (aproximadamente)

-- Volcando estructura para tabla petcontrol.medicamento
CREATE TABLE IF NOT EXISTS `medicamento` (
  `id_medicamento` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `presentacion` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  PRIMARY KEY (`id_medicamento`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla petcontrol.medicamento: ~0 rows (aproximadamente)

-- Volcando estructura para tabla petcontrol.recordatorio
CREATE TABLE IF NOT EXISTS `recordatorio` (
  `id_recordatorio` int NOT NULL AUTO_INCREMENT,
  `id_usuario` int DEFAULT NULL,
  `titulo` varchar(100) NOT NULL,
  `descripcion` text,
  `fecha` date NOT NULL,
  `tipo` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_recordatorio`),
  KEY `id_usuario` (`id_usuario`),
  CONSTRAINT `recordatorio_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla petcontrol.recordatorio: ~4 rows (aproximadamente)

-- Volcando estructura para tabla petcontrol.usuarios
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id_usuario` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `contrasenia` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `rol` varchar(20) NOT NULL DEFAULT 'cliente',
  PRIMARY KEY (`id_usuario`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla petcontrol.usuarios: ~2 rows (aproximadamente)
INSERT INTO `usuarios` (`id_usuario`, `nombre`, `email`, `contrasenia`, `rol`) VALUES
	(2, 'Franco Cabrera', 'francocabrera989@gmail.com', '$2y$10$OFtKQUNIskiUwbcXIH/ifuH5uWZ608Yg19mc7JQK2lpVzLDSHSEmS', 'admin'),
	(6, 'Julio Cortez', 'julio91218@hotmail.com.ar', '$2y$10$Svq857tXCiS/6ldJRB82K.rKFyVzM05o23DPzXB62e33ca1sljali', 'cliente'),
	(7, 'Alfonsín Pérez ', 'alfoperez07@gmail.com', '$2y$10$STSfpuNZ/cnA2O8sSyXiA.imQyBEv0Gc7GzE8ioEQS7s.60RD8yn6', 'cliente');

-- Volcando estructura para tabla petcontrol.vacuna
CREATE TABLE IF NOT EXISTS `vacuna` (
  `id_vacuna` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text,
  PRIMARY KEY (`id_vacuna`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Volcando datos para la tabla petcontrol.vacuna: ~2 rows (aproximadamente)

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
