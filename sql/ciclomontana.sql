-- phpMyAdmin SQL Dump
-- version 3.5.2
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 27-03-2018 a las 21:46:52
-- Versión del servidor: 10.1.9-MariaDB
-- Versión de PHP: 5.5.30

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `ciclomontana`
--
DROP DATABASE `ciclomontana`;
CREATE DATABASE `ciclomontana` DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish2_ci;
USE `ciclomontana`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ciudad`
--

DROP TABLE IF EXISTS `ciudad`;
CREATE TABLE IF NOT EXISTS `ciudad` (
  `cod_ciudad` int(5) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Codigo ciudad',
  `nom_ciudad` varchar(250) COLLATE utf8_spanish2_ci NOT NULL COMMENT 'Nombre ciudad',
  `cod_departamento` int(3) unsigned NOT NULL COMMENT 'Codigo departamento',
  PRIMARY KEY (`cod_ciudad`),
  KEY `fk_departamento` (`cod_departamento`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci COMMENT='Tabla de ciudades' AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `ciudad`
--

INSERT INTO `ciudad` (`cod_ciudad`, `nom_ciudad`, `cod_departamento`) VALUES
(1, 'Medellin', 1),
(2, 'Bucaramanga', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

DROP TABLE IF EXISTS `cliente`;
CREATE TABLE IF NOT EXISTS `cliente` (
  `id_cliente` int(18) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID del cliente',
  `nit` varchar(25) COLLATE utf8_spanish2_ci NOT NULL COMMENT 'Nit del cliente',
  `nombre` varchar(250) COLLATE utf8_spanish2_ci NOT NULL COMMENT 'Nombre completo',
  `direccion` varchar(250) COLLATE utf8_spanish2_ci NOT NULL COMMENT 'Direccion',
  `telefono` varchar(20) COLLATE utf8_spanish2_ci NOT NULL COMMENT 'Telefono',
  `cod_ciudad` int(5) unsigned NOT NULL COMMENT 'Codigo ciudad',
  `cupo` int(8) NOT NULL COMMENT 'Cupo para visitas',
  `saldo_cupo` int(8) NOT NULL COMMENT 'Saldo del cupo',
  `porcentaje_visitas` int(3) NOT NULL COMMENT 'Porcentaje visitas',
  PRIMARY KEY (`id_cliente`),
  KEY `fk_ciudad` (`cod_ciudad`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci COMMENT='Tabla de clientes' AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamento`
--

DROP TABLE IF EXISTS `departamento`;
CREATE TABLE IF NOT EXISTS `departamento` (
  `cod_departamento` int(3) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Codigo departamento',
  `nom_departamento` varchar(250) COLLATE utf8_spanish2_ci NOT NULL COMMENT 'Nombre departamento',
  `cod_pais` int(3) unsigned NOT NULL COMMENT 'Codigo pais',
  PRIMARY KEY (`cod_departamento`),
  KEY `fk_pais` (`cod_pais`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci COMMENT='Tabla de departamentos' AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `departamento`
--

INSERT INTO `departamento` (`cod_departamento`, `nom_departamento`, `cod_pais`) VALUES
(1, 'Antioquia', 1),
(2, 'Santander', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pais`
--

DROP TABLE IF EXISTS `pais`;
CREATE TABLE IF NOT EXISTS `pais` (
  `cod_pais` int(3) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Codigo Pais',
  `nom_pais` varchar(250) COLLATE utf8_spanish2_ci NOT NULL,
  PRIMARY KEY (`cod_pais`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci COMMENT='Tabla de paises' AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `pais`
--

INSERT INTO `pais` (`cod_pais`, `nom_pais`) VALUES
(1, 'Colombia');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vendedor`
--

DROP TABLE IF EXISTS `vendedor`;
CREATE TABLE IF NOT EXISTS `vendedor` (
  `cod_vendedor` int(3) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Codigo vendedor',
  `nom_vendedor` varchar(250) COLLATE utf8_spanish2_ci NOT NULL COMMENT 'Nombre vendedor',
  PRIMARY KEY (`cod_vendedor`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci COMMENT='Tabla de vendedores' AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `vendedor`
--

INSERT INTO `vendedor` (`cod_vendedor`, `nom_vendedor`) VALUES
(1, 'Vendedor A'),
(2, 'Vendedor B');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `visita`
--

DROP TABLE IF EXISTS `visita`;
CREATE TABLE IF NOT EXISTS `visita` (
  `id_visita` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Identificador de la visita',
  `fecha` date NOT NULL COMMENT 'Fecha visita',
  `valor_neto` double(10,2) NOT NULL COMMENT 'Valor neto',
  `valor_visita` double(10,2) NOT NULL COMMENT 'Valor de visita',
  `observaciones` varchar(1000) COLLATE utf8_spanish2_ci NOT NULL COMMENT 'Observaciones de visita',
  `cod_vendedor` int(3) unsigned NOT NULL COMMENT 'Codigo del vendedor',
  `id_cliente` int(18) unsigned NOT NULL COMMENT 'ID del cliente',
  PRIMARY KEY (`id_visita`),
  KEY `fk_vendedor` (`cod_vendedor`),
  KEY `fk_cliente` (`id_cliente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci COMMENT='Tabla de visitas' AUTO_INCREMENT=1 ;

--
-- Disparadores `visita`
--
DROP TRIGGER IF EXISTS `tr_bi_visitas`;
DELIMITER //
CREATE TRIGGER `tr_bi_visitas` BEFORE INSERT ON `visita`
 FOR EACH ROW BEGIN
  DECLARE p_porcentaje INT;
  IF new.id_cliente IS NOT NULL THEN
    SELECT porcentaje_visitas INTO p_porcentaje FROM cliente WHERE id_cliente = new.id_cliente;
    SET new.valor_visita = new.valor_neto * porcentaje;
  END IF;
END
//
DELIMITER ;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `ciudad`
--
ALTER TABLE `ciudad`
  ADD CONSTRAINT `ciudad_ibfk_1` FOREIGN KEY (`cod_departamento`) REFERENCES `departamento` (`cod_departamento`);

--
-- Filtros para la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD CONSTRAINT `cliente_ibfk_1` FOREIGN KEY (`cod_ciudad`) REFERENCES `ciudad` (`cod_ciudad`);

--
-- Filtros para la tabla `departamento`
--
ALTER TABLE `departamento`
  ADD CONSTRAINT `departamento_ibfk_1` FOREIGN KEY (`cod_pais`) REFERENCES `pais` (`cod_pais`);

--
-- Filtros para la tabla `visita`
--
ALTER TABLE `visita`
  ADD CONSTRAINT `visita_ibfk_1` FOREIGN KEY (`cod_vendedor`) REFERENCES `vendedor` (`cod_vendedor`),
  ADD CONSTRAINT `visita_ibfk_2` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id_cliente`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
