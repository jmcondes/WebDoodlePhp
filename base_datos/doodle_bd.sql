-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 29-11-2015 a las 19:38:39
-- Versión del servidor: 5.5.27
-- Versión de PHP: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `actividad_3_2`
--

CREATE SCHEMA `actividad_3_2`;

USE `actividad_3_2`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `eventos`
--

CREATE TABLE IF NOT EXISTS `eventos` (
  `id_evento` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(200) NOT NULL,
  `fecha` date NOT NULL,
  PRIMARY KEY (`id_evento`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Volcado de datos para la tabla `eventos`
--

INSERT INTO `eventos` (`id_evento`, `descripcion`, `fecha`) VALUES
(1, 'Concierto Dire Straits', '2015-12-20'),
(2, 'Open Tenis Caja Magica', '2015-12-17'),
(3, 'Obra Teatro La cena de los idiotas', '2015-12-08'),
(4, 'Partido Atletico Madrid-Real Madrid', '2015-12-15'),
(5, 'Excursión a la Sierra', '2015-12-03'),
(6, 'Misa del Gallo', '2015-12-25'),
(7, 'Black Friday en Primarkt', '2015-12-27');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `id_usuario` int(6) NOT NULL AUTO_INCREMENT,
  `nombre_usuario` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password_usuario` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_usuario`),
  UNIQUE KEY `nombre_usuario_UNIQUE` (`nombre_usuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre_usuario`, `password_usuario`) VALUES
(1, 'Jose Manuel Condes', 'psswd'),
(2, 'Sebastian Gonzalez', 'psswd'),
(3, 'Jessica Jones', 'psswd');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios_eventos`
--

CREATE TABLE IF NOT EXISTS `usuarios_eventos` (
  `id_evento` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `estado` enum('Apuntado','No apuntado','Duda') NOT NULL,
  PRIMARY KEY (`id_evento`,`id_usuario`),
  KEY `id_usuario_idx` (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios_eventos`
--

INSERT INTO `usuarios_eventos` (`id_evento`, `id_usuario`, `estado`) VALUES
(1, 1, 'No apuntado'),
(1, 2, 'Duda'),
(1, 3, 'Duda'),
(2, 1, 'Duda'),
(2, 2, 'No apuntado'),
(3, 1, 'Apuntado'),
(3, 2, 'Apuntado'),
(4, 1, 'Apuntado'),
(4, 2, 'Duda'),
(4, 3, 'Apuntado'),
(5, 1, 'No apuntado'),
(5, 2, 'No apuntado'),
(5, 3, 'Apuntado'),
(6, 1, 'Apuntado'),
(7, 1, 'Apuntado');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `usuarios_eventos`
--
ALTER TABLE `usuarios_eventos`
  ADD CONSTRAINT `id_evento` FOREIGN KEY (`id_evento`) REFERENCES `eventos` (`id_evento`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `id_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
