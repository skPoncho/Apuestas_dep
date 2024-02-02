-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         5.7.29 - MySQL Community Server (GPL)
-- SO del servidor:              Linux
-- HeidiSQL Versión:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Volcando estructura de base de datos para lamp
CREATE DATABASE IF NOT EXISTS `lamp` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `lamp`;

-- Volcando estructura para tabla lamp.apuestas
CREATE TABLE IF NOT EXISTS `apuestas` (
  `IdApuesta` int(11) NOT NULL AUTO_INCREMENT,
  `Fecha` date DEFAULT NULL,
  `Tipo_Apuesta` int(11) DEFAULT NULL,
  `Momio` varchar(50) DEFAULT NULL,
  `Stake` varchar(50) DEFAULT NULL,
  `Monto` varchar(50) DEFAULT NULL,
  `Cobro` varchar(50) DEFAULT NULL,
  `Ganancia` varchar(50) DEFAULT NULL,
  `Liga` varchar(50) DEFAULT NULL,
  `Comentario` varchar(50) DEFAULT NULL,
  `FechaCreacion` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`IdApuesta`),
  KEY `FK_apuestas_tipoapuesta` (`Tipo_Apuesta`),
  CONSTRAINT `FK_apuestas_tipoapuesta` FOREIGN KEY (`Tipo_Apuesta`) REFERENCES `tipoapuesta` (`IdTipoApuesta`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla lamp.apuestas: ~0 rows (aproximadamente)

-- Volcando estructura para tabla lamp.parametros
CREATE TABLE IF NOT EXISTS `parametros` (
  `IdParametro` int(11) NOT NULL AUTO_INCREMENT,
  `Valor` varchar(200) DEFAULT NULL,
  `Descripcion` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`IdParametro`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Volcando datos para la tabla lamp.parametros: ~0 rows (aproximadamente)

-- Volcando estructura para tabla lamp.tipoapuesta
CREATE TABLE IF NOT EXISTS `tipoapuesta` (
  `IdTipoApuesta` int(11) NOT NULL AUTO_INCREMENT,
  `Descripcion` varchar(100) NOT NULL DEFAULT '0',
  PRIMARY KEY (`IdTipoApuesta`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='tipos de apuesta';

-- Volcando datos para la tabla lamp.tipoapuesta: ~0 rows (aproximadamente)

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
