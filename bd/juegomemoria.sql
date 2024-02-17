-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 17-02-2024 a las 16:28:22
-- Versión del servidor: 8.2.0
-- Versión de PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `juegomemoria`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carta`
--

DROP TABLE IF EXISTS `carta`;
CREATE TABLE IF NOT EXISTS `carta` (
  `idCarta` int NOT NULL AUTO_INCREMENT,
  `tipoCarta` enum('animales','aviones','tanques') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `nombreCarta` varchar(100) NOT NULL,
  PRIMARY KEY (`idCarta`)
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `carta`
--

INSERT INTO `carta` (`idCarta`, `tipoCarta`, `nombreCarta`) VALUES
(1, 'tanques', 'public/images/tanques/tanque_01.jpg'),
(2, 'tanques', 'public/images/tanques/tanque_02.jpg'),
(3, 'tanques', 'public/images/tanques/tanque_03.jpg'),
(4, 'tanques', 'public/images/tanques/tanque_04.jpg'),
(5, 'tanques', 'public/images/tanques/tanque_05.jpg'),
(6, 'tanques', 'public/images/tanques/tanque_06.jpg'),
(7, 'tanques', 'public/images/tanques/tanque_07.jpg'),
(8, 'tanques', 'public/images/tanques/tanque_08.jpg'),
(9, 'tanques', 'public/images/tanques/tanque_09.jpg'),
(10, 'tanques', 'public/images/tanques/tanque_10.jpg'),
(11, 'tanques', 'public/images/tanques/tanque_11.jpg'),
(12, 'tanques', 'public/images/tanques/tanque_12.jpg'),
(13, 'tanques', 'public/images/tanques/tanque_13.jpg'),
(14, 'tanques', 'public/images/tanques/tanque_14.jpg'),
(15, 'tanques', 'public/images/tanques/tanque_15.jpg'),
(16, 'tanques', 'public/images/tanques/tanque_16.jpg'),
(17, 'tanques', 'public/images/tanques/tanque_17.jpg'),
(18, 'tanques', 'public/images/tanques/tanque_18.jpg'),
(19, 'tanques', 'public/images/tanques/tanque_19.jpg'),
(20, 'tanques', 'public/images/tanques/tanque_20.jpg'),
(21, 'tanques', 'public/images/tanques/tanque_21.jpg'),
(22, 'tanques', 'public/images/tanques/tanque_22.jpg'),
(23, 'tanques', 'public/images/tanques/tanque_23.jpg'),
(24, 'tanques', 'public/images/tanques/tanque_24.jpg'),
(25, 'tanques', 'public/images/tanques/tanque_25.jpg'),
(26, 'tanques', 'public/images/tanques/tanque_26.jpg'),
(27, 'tanques', 'public/images/tanques/tanque_27.jpg'),
(28, 'aviones', 'public/images/aviones/avion_01.jpg'),
(29, 'aviones', 'public/images/aviones/avion_02.jpg'),
(30, 'aviones', 'public/images/aviones/avion_03.jpg'),
(31, 'aviones', 'public/images/aviones/avion_04.jpg'),
(32, 'aviones', 'public/images/aviones/avion_05.jpg'),
(33, 'aviones', 'public/images/aviones/avion_06.jpg'),
(34, 'aviones', 'public/images/aviones/avion_07.jpg'),
(35, 'aviones', 'public/images/aviones/avion_08.jpg'),
(36, 'aviones', 'public/images/aviones/avion_09.jpg'),
(37, 'aviones', 'public/images/aviones/avion_10.jpg'),
(38, 'aviones', 'public/images/aviones/avion_11.jpg'),
(39, 'aviones', 'public/images/aviones/avion_12.jpg'),
(40, 'aviones', 'public/images/aviones/avion_13.jpg'),
(41, 'aviones', 'public/images/aviones/avion_14.jpg'),
(42, 'aviones', 'public/images/aviones/avion_15.jpg'),
(43, 'aviones', 'public/images/aviones/avion_16.jpg'),
(44, 'animales', 'public/images/animales/animal_01.jpg'),
(45, 'animales', 'public/images/animales/animal_02.jpg'),
(46, 'animales', 'public/images/animales/animal_03.jpg'),
(47, 'animales', 'public/images/animales/animal_04.jpg'),
(48, 'animales', 'public/images/animales/animal_05.jpg'),
(49, 'animales', 'public/images/animales/animal_06.jpg'),
(50, 'animales', 'public/images/animales/animal_07.jpg'),
(51, 'animales', 'public/images/animales/animal_08.jpg'),
(52, 'animales', 'public/images/animales/animal_09.jpg'),
(53, 'animales', 'public/images/animales/animal_10.jpg'),
(54, 'animales', 'public/images/animales/animal_11.jpg'),
(55, 'animales', 'public/images/animales/animal_12.jpg'),
(56, 'animales', 'public/images/animales/animal_13.jpg'),
(57, 'animales', 'public/images/animales/animal_14.jpg'),
(58, 'animales', 'public/images/animales/animal_15.jpg'),
(59, 'animales', 'public/images/animales/animal_16.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cartapartida`
--

DROP TABLE IF EXISTS `cartapartida`;
CREATE TABLE IF NOT EXISTS `cartapartida` (
  `idCartaPartida` int NOT NULL AUTO_INCREMENT,
  `idPartida` int NOT NULL,
  `idCarta` int NOT NULL,
  `encontrado` tinyint(1) NOT NULL DEFAULT '0',
  `indexArray` int NOT NULL,
  PRIMARY KEY (`idCartaPartida`),
  KEY `idPartida` (`idPartida`),
  KEY `idCarta` (`idCarta`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `cartapartida`
--

INSERT INTO `cartapartida` (`idCartaPartida`, `idPartida`, `idCarta`, `encontrado`, `indexArray`) VALUES
(1, 2, 42, 1, 0),
(2, 2, 40, 0, 1),
(3, 2, 28, 1, 2),
(4, 2, 41, 1, 3),
(5, 2, 31, 0, 4),
(6, 2, 37, 0, 5),
(7, 2, 35, 1, 6),
(8, 2, 42, 1, 7),
(9, 2, 43, 0, 8),
(10, 2, 40, 0, 9),
(11, 2, 31, 0, 10),
(12, 2, 37, 0, 11),
(13, 2, 41, 1, 12),
(14, 2, 35, 1, 13),
(15, 2, 43, 0, 14),
(16, 2, 28, 1, 15),
(17, 3, 5, 0, 0),
(18, 3, 4, 0, 1),
(19, 3, 15, 0, 2),
(20, 3, 24, 0, 3),
(21, 3, 5, 0, 4),
(22, 3, 15, 0, 5),
(23, 3, 24, 0, 6),
(24, 3, 4, 0, 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dificultad`
--

DROP TABLE IF EXISTS `dificultad`;
CREATE TABLE IF NOT EXISTS `dificultad` (
  `idDificultad` int NOT NULL AUTO_INCREMENT,
  `nivelDificultad` enum('baja','media','alta') NOT NULL,
  `cantIntentos` int NOT NULL,
  `cantCartas` int NOT NULL,
  PRIMARY KEY (`idDificultad`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `dificultad`
--

INSERT INTO `dificultad` (`idDificultad`, `nivelDificultad`, `cantIntentos`, `cantCartas`) VALUES
(1, 'baja', 24, 8),
(2, 'media', 40, 16),
(3, 'alta', 64, 32);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estadopartida`
--

DROP TABLE IF EXISTS `estadopartida`;
CREATE TABLE IF NOT EXISTS `estadopartida` (
  `idEstado` int NOT NULL AUTO_INCREMENT,
  `descripcion` enum('ganó','perdió','abandonó','pausado','en ejecucion') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`idEstado`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `estadopartida`
--

INSERT INTO `estadopartida` (`idEstado`, `descripcion`) VALUES
(1, 'pausado'),
(2, 'abandonó'),
(3, 'perdió'),
(4, 'ganó');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `partida`
--

DROP TABLE IF EXISTS `partida`;
CREATE TABLE IF NOT EXISTS `partida` (
  `idPartida` int NOT NULL AUTO_INCREMENT,
  `fecha_Inicio` timestamp NOT NULL,
  `fecha_Finalizado` timestamp NULL DEFAULT NULL,
  `tiempoLimite` time DEFAULT NULL,
  `tiempoEnCurso` time DEFAULT NULL,
  `intentos` int NOT NULL DEFAULT '0',
  `aciertos` int NOT NULL DEFAULT '0',
  `tipoCarta` enum('animales','aviones','tanques') NOT NULL,
  `idUsuario` int NOT NULL,
  `idEstadoPartida` int NOT NULL,
  `idDificultad` int NOT NULL,
  PRIMARY KEY (`idPartida`),
  KEY `idUsuario` (`idUsuario`),
  KEY `idDificultad` (`idDificultad`),
  KEY `idEstadoPartida` (`idEstadoPartida`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `partida`
--

INSERT INTO `partida` (`idPartida`, `fecha_Inicio`, `fecha_Finalizado`, `tiempoLimite`, `tiempoEnCurso`, `intentos`, `aciertos`, `tipoCarta`, `idUsuario`, `idEstadoPartida`, `idDificultad`) VALUES
(1, '2024-02-09 02:39:50', '2024-02-09 02:40:34', '00:05:00', '00:00:37', 1, 4, 'tanques', 1, 4, 1),
(2, '2024-02-09 03:09:52', '2024-02-17 11:32:41', '00:10:00', '00:01:20', 10, 4, 'aviones', 1, 2, 2),
(3, '2024-02-17 12:30:30', '2024-02-17 12:30:39', '00:05:00', '00:00:07', 0, 0, 'tanques', 1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `idUsuario` int NOT NULL AUTO_INCREMENT,
  `usu_nametag` varchar(100) NOT NULL,
  `usu_password` text NOT NULL,
  `usu_fecha_nacimiento` timestamp NOT NULL,
  `usu_correo` varchar(255) NOT NULL,
  `usu_code_activacion` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `usu_fecha_registro` timestamp NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `usu_estado` char(1) NOT NULL,
  `usu_cantidad_partidas` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`idUsuario`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idUsuario`, `usu_nametag`, `usu_password`, `usu_fecha_nacimiento`, `usu_correo`, `usu_code_activacion`, `usu_fecha_registro`, `deleted_at`, `usu_estado`, `usu_cantidad_partidas`) VALUES
(1, 'HunterDreams', 'Y21jMTIzNDU2Q01D', '1998-01-29 03:00:00', 'caupancristian13@gmail.com', 'QAwnEOdIeoBGE9j49rXOKrZAbSLP48lVy50BBptmLqUrlZh0MVtydYnRMEdCFDXk3X3BbD', '2024-02-09 02:37:03', NULL, 'P', 3);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cartapartida`
--
ALTER TABLE `cartapartida`
  ADD CONSTRAINT `cartapartida_ibfk_1` FOREIGN KEY (`idPartida`) REFERENCES `partida` (`idPartida`),
  ADD CONSTRAINT `cartapartida_ibfk_2` FOREIGN KEY (`idCarta`) REFERENCES `carta` (`idCarta`);

--
-- Filtros para la tabla `partida`
--
ALTER TABLE `partida`
  ADD CONSTRAINT `partida_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `partida_ibfk_2` FOREIGN KEY (`idEstadoPartida`) REFERENCES `estadopartida` (`idEstado`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `partida_ibfk_3` FOREIGN KEY (`idDificultad`) REFERENCES `dificultad` (`idDificultad`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
