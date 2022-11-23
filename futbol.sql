-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-11-2022 a las 18:58:43
-- Versión del servidor: 10.4.22-MariaDB
-- Versión de PHP: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `futbol`
--
CREATE DATABASE IF NOT EXISTS `futbol` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `futbol`;

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `cambioPassword` (IN `NombreUsuario` VARCHAR(20), IN `NuevoPassword` VARCHAR(20))  BEGIN      
        UPDATE usuario
        SET Password = NuevoPassword
        WHERE Nombre_Usuario = NombreUsuario;
    END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cancha`
--

CREATE TABLE `cancha` (
  `Id_Cancha` int(11) NOT NULL,
  `Nombre_Cancha` char(14) NOT NULL,
  `Direccion` char(20) NOT NULL,
  `Telefono` char(15) DEFAULT NULL,
  `Comentario` char(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cancha`
--

INSERT INTO `cancha` (`Id_Cancha`, `Nombre_Cancha`, `Direccion`, `Telefono`, `Comentario`) VALUES
(1, 'Camp Nou', 'Barcelona, España', '457896', 'F. C. Barcelona'),
(2, 'Wembley', 'Londres, Inglaterra', '00521245112', 'Selección de fútbol de'),
(4, 'Olímpico Luzhn', 'Moscú, Rusia', '221457863', 'Selección de fútbol d'),
(5, 'Signal Iduna P', 'Dortmund, Alemania', '0012457863', 'Seleccion: Borussia Dortmund'),
(6, 'Stade France', 'Saint-Denis, Francia', '00124578923', 'Selección de fútbol de'),
(7, 'Santiago Berna', 'Madrid, España', 'N/A', 'Real Madrid C. F.'),
(8, 'Giuseppe Meazz', 'Milán, Italia', '00123659852', 'A. C. Milan, F. C. Internazionale'),
(9, 'Olímpico Atatü', 'Estambul, Turquía', 'N/A', 'Selección de fútbol de Turquía'),
(10, 'Old Trafford', 'Mánchester, Inglater', 'N/A', 'Manchester United F. C.'),
(11, 'Millennium', 'Cardiff, Gales', '0012396587', 'Selección de fútbol de Gales, Selección'),
(12, 'Olímpico de Be', 'Berlín, Alemania', 'N/A', 'Hertha BSC, Selección de fútbol de Alema'),
(13, 'Olímpico de Ro', 'Roma, Italia', 'N/A', 'AS Roma, SS Lazio, Selección de fútbol d');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipo`
--

CREATE TABLE `equipo` (
  `Id_Equipo` int(11) NOT NULL,
  `Nombre_Equipo` char(15) NOT NULL,
  `Comentario` char(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `equipo`
--

INSERT INTO `equipo` (`Id_Equipo`, `Nombre_Equipo`, `Comentario`) VALUES
(4, 'ASTON VILLA', 'N/A'),
(5, 'BRIGHTON AND HO', 'N/A'),
(6, 'CHELSEA', 'N/A'),
(7, 'LEEDS UNITED', 'N/A'),
(8, 'LIVERPOOL', 'N/A'),
(9, 'MANCHESTER CITY', 'N/A'),
(10, 'MANCHESTER UNIT', 'N/A'),
(11, 'REAL MADRID', 'N/A'),
(12, 'BARCELONA', 'N/A'),
(13, 'ATLÉTICO MADRID', 'N/A'),
(14, 'JUVENTUS', 'N/A'),
(15, 'ARSENAL', 'N/A');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipo_torneo`
--

CREATE TABLE `equipo_torneo` (
  `Id_Equipo_Torneo` int(11) NOT NULL,
  `Id_Equipo` int(11) NOT NULL,
  `Id_Torneo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `equipo_torneo`
--

INSERT INTO `equipo_torneo` (`Id_Equipo_Torneo`, `Id_Equipo`, `Id_Torneo`) VALUES
(107, 4, 1),
(108, 8, 1),
(109, 10, 1),
(110, 11, 1),
(111, 12, 1),
(112, 14, 1),
(113, 15, 1),
(114, 4, 2),
(115, 5, 2),
(116, 6, 2),
(117, 7, 2),
(118, 8, 2),
(119, 9, 2),
(120, 10, 2),
(121, 11, 2),
(122, 6, 3),
(123, 7, 3),
(124, 8, 3),
(125, 9, 3),
(126, 5, 4),
(127, 7, 4),
(128, 9, 4),
(129, 11, 4),
(130, 13, 4),
(131, 15, 4),
(132, 6, 5),
(133, 7, 5),
(134, 10, 6),
(135, 11, 6),
(136, 12, 6),
(137, 13, 6),
(138, 14, 6),
(139, 15, 6),
(140, 5, 20),
(141, 6, 20),
(142, 7, 20),
(143, 8, 20),
(144, 9, 20),
(145, 10, 20),
(146, 5, 21),
(147, 6, 21),
(148, 7, 21),
(149, 8, 21);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial_password`
--

CREATE TABLE `historial_password` (
  `Id` int(11) NOT NULL,
  `Id_Usuario` int(11) DEFAULT NULL,
  `Fecha_Cambio` date DEFAULT NULL,
  `Password_Actual` varchar(20) DEFAULT NULL,
  `Password_Nuevo` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `historial_password`
--

INSERT INTO `historial_password` (`Id`, `Id_Usuario`, `Fecha_Cambio`, `Password_Actual`, `Password_Nuevo`) VALUES
(1, 1, '2022-11-14', '123456789', '12345'),
(2, 1, '2022-11-14', '12345', 'qwerty'),
(3, 1, '2022-11-14', 'qwerty', '123456789'),
(4, 7, '2022-11-15', '123456', '123456789'),
(5, 7, '2022-11-18', '123456789', '456789'),
(6, 7, '2022-11-18', '456789', '123456');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jugador`
--

CREATE TABLE `jugador` (
  `Id_Jugador` int(11) NOT NULL,
  `Nombre_Apellido` char(50) NOT NULL,
  `Id_Posicion_Jugador` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `jugador`
--

INSERT INTO `jugador` (`Id_Jugador`, `Nombre_Apellido`, `Id_Posicion_Jugador`) VALUES
(6, 'Kieran Tierney', 3),
(7, 'Oleksandr Zinchenko', 3),
(8, 'Takehiro Tomiyasu', 4),
(9, 'Lino Sousa', 2),
(10, 'Ben White', 5),
(11, 'Gabriel Magalhães', 6),
(12, 'William Saliba', 7),
(13, 'Rob Holding', 9),
(14, 'Reuell Walters', 10),
(15, 'Zach Awe', 11),
(16, 'Emiliano Martínez', 1),
(17, 'Lucas Digne', 2),
(18, 'Ashley Young', 3),
(19, 'Sebastian Revan', 4),
(20, 'Diego Carlos', 5),
(21, 'Boubacar Kamara', 6),
(22, 'Leander Dendoncker', 7),
(23, 'Ezri Konsa', 8),
(24, 'Calum Chambers', 9),
(25, 'Frédéric Guilbert', 10),
(26, 'Sil Swinkels', 11);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jugador_equipo`
--

CREATE TABLE `jugador_equipo` (
  `Id_Jugador_Equipo` int(11) NOT NULL,
  `Id_Jugador` int(11) NOT NULL,
  `Id_Equipo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `jugador_equipo`
--

INSERT INTO `jugador_equipo` (`Id_Jugador_Equipo`, `Id_Jugador`, `Id_Equipo`) VALUES
(5, 6, 4),
(6, 7, 7),
(7, 8, 8),
(8, 8, 11),
(9, 9, 11),
(10, 10, 12),
(11, 11, 8);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `partido`
--

CREATE TABLE `partido` (
  `Id_Partido` int(11) NOT NULL,
  `Fecha_Hora` datetime NOT NULL,
  `Id_Torneo_Cancha` int(11) NOT NULL,
  `Id_Equipo_Local` int(11) NOT NULL,
  `Id_Equipo_Visitante` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `partido`
--

INSERT INTO `partido` (`Id_Partido`, `Fecha_Hora`, `Id_Torneo_Cancha`, `Id_Equipo_Local`, `Id_Equipo_Visitante`) VALUES
(5, '2022-11-29 08:00:00', 85, 14, 10),
(6, '2022-11-29 16:00:00', 84, 15, 11),
(8, '2022-11-29 08:00:00', 85, 14, 10),
(9, '2022-11-29 16:00:00', 84, 15, 11),
(10, '2022-11-30 12:00:00', 84, 4, 12),
(12, '2022-11-29 08:00:00', 86, 14, 10),
(13, '2022-11-29 16:00:00', 86, 15, 11),
(15, '2022-11-29 08:00:00', 86, 14, 10),
(16, '2022-11-29 16:00:00', 84, 15, 11),
(19, '2022-11-29 08:00:00', 86, 14, 10),
(20, '2022-11-29 16:00:00', 86, 15, 11),
(22, '2022-11-29 08:00:00', 86, 14, 10),
(25, '2022-11-29 08:00:00', 84, 14, 10),
(27, '2022-11-29 08:00:00', 86, 14, 10),
(28, '2022-11-29 16:00:00', 86, 15, 11),
(29, '2022-11-30 12:00:00', 84, 4, 12),
(30, '2022-11-29 08:00:00', 85, 14, 10),
(31, '2022-11-29 16:00:00', 86, 15, 11),
(32, '2022-11-30 12:00:00', 86, 4, 12),
(33, '2022-11-29 08:00:00', 85, 14, 10),
(34, '2022-11-29 16:00:00', 85, 15, 11),
(35, '2022-11-30 12:00:00', 86, 4, 12),
(36, '2022-11-01 08:00:00', 90, 9, 6),
(37, '2022-11-01 16:00:00', 88, 10, 7),
(38, '2022-11-02 12:00:00', 90, 4, 11),
(39, '2022-11-03 08:00:00', 88, 8, 5),
(40, '0000-00-00 00:00:00', 92, 8, 9),
(41, '0000-00-00 00:00:00', 95, 6, 7),
(42, '2022-01-15 08:00:00', 94, 8, 9),
(43, '2022-01-15 16:00:00', 91, 6, 7),
(44, '2022-08-10 08:00:00', 97, 15, 9),
(45, '2022-08-10 16:00:00', 97, 11, 5),
(46, '2022-08-11 12:00:00', 96, 13, 7),
(47, '2022-06-01 08:00:00', 106, 6, 7),
(48, '2022-04-15 08:00:00', 109, 15, 12),
(49, '2022-04-15 16:00:00', 109, 13, 10),
(50, '2022-04-16 12:00:00', 108, 14, 11),
(51, '2022-11-20 08:00:00', 114, 10, 7),
(52, '2022-11-20 16:00:00', 113, 8, 5),
(53, '2022-11-21 12:00:00', 115, 9, 6),
(54, '2022-11-29 08:00:00', 85, 14, 10),
(55, '2022-11-29 16:00:00', 84, 15, 11),
(56, '2022-11-30 12:00:00', 85, 4, 12),
(57, '2022-11-20 08:00:00', 116, 7, 8),
(58, '2022-11-20 16:00:00', 117, 5, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `posicion_jugador`
--

CREATE TABLE `posicion_jugador` (
  `Id_Posicion_Jugador` int(11) NOT NULL,
  `Descripcion` char(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `posicion_jugador`
--

INSERT INTO `posicion_jugador` (`Id_Posicion_Jugador`, `Descripcion`) VALUES
(1, 'Portero'),
(2, 'Defensa Central'),
(3, 'Centro Campista'),
(4, 'Mediapunta'),
(5, 'Medio Centro Defensi'),
(6, 'Interior Derecho'),
(7, 'Interior Izquierdo'),
(8, 'Delantero Centro'),
(9, 'Segunda Punta'),
(10, 'Extremo'),
(11, 'Defensa Lateral');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `stats_equipo_torneo`
--

CREATE TABLE `stats_equipo_torneo` (
  `Id_Stats_Equipo_Torneo` int(11) NOT NULL,
  `Posicion_Torneo` int(11) NOT NULL,
  `Puntos` int(11) NOT NULL,
  `Partidos_Jugados` int(11) NOT NULL,
  `Partidos_Ganados` int(11) NOT NULL,
  `Partidos_Perdidos` int(11) NOT NULL,
  `Partidos_Empatados` int(11) NOT NULL,
  `Goles_Afavor` int(11) NOT NULL,
  `Goles_Encontra` int(11) NOT NULL,
  `Tarjetas_Amarillas` int(11) NOT NULL,
  `Tarjetas_Rojas` int(11) NOT NULL,
  `Id_Equipo_Torneo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `stats_equipo_torneo`
--

INSERT INTO `stats_equipo_torneo` (`Id_Stats_Equipo_Torneo`, `Posicion_Torneo`, `Puntos`, `Partidos_Jugados`, `Partidos_Ganados`, `Partidos_Perdidos`, `Partidos_Empatados`, `Goles_Afavor`, `Goles_Encontra`, `Tarjetas_Amarillas`, `Tarjetas_Rojas`, `Id_Equipo_Torneo`) VALUES
(4, 2, 5, 5, 2, 1, 2, 5, 2, 2, 0, 107),
(5, 3, 4, 6, 3, 2, 1, 4, 1, 1, 1, 108),
(6, 1, 8, 5, 5, 0, 0, 5, 2, 1, 0, 109),
(7, 4, 3, 5, 2, 2, 1, 4, 2, 3, 0, 110),
(8, 5, 3, 5, 1, 2, 2, 2, 3, 2, 1, 111),
(9, 6, 2, 5, 1, 3, 1, 2, 4, 1, 2, 113),
(10, 1, 12, 6, 3, 1, 2, 8, 3, 2, 0, 114),
(11, 2, 10, 5, 2, 2, 1, 6, 3, 2, 1, 115),
(12, 3, 8, 4, 2, 2, 0, 7, 5, 1, 0, 116),
(13, 4, 6, 4, 2, 1, 1, 7, 6, 0, 0, 117),
(14, 5, 4, 5, 1, 1, 3, 9, 7, 0, 1, 118),
(15, 6, 3, 6, 2, 2, 2, 8, 5, 2, 0, 119),
(16, 7, 3, 4, 1, 2, 1, 5, 4, 0, 1, 120),
(17, 8, 2, 4, 1, 1, 2, 4, 2, 0, 0, 121),
(18, 1, 6, 4, 3, 1, 0, 5, 2, 0, 0, 122),
(19, 2, 4, 3, 2, 0, 1, 3, 1, 1, 0, 123),
(20, 3, 3, 4, 2, 2, 0, 3, 2, 3, 1, 124),
(21, 4, 3, 3, 1, 1, 1, 3, 2, 1, 0, 125),
(22, 1, 6, 5, 3, 1, 1, 7, 3, 1, 1, 126),
(23, 2, 5, 4, 2, 1, 1, 5, 2, 1, 0, 127),
(24, 3, 4, 4, 2, 0, 2, 6, 3, 2, 0, 128),
(25, 4, 3, 3, 1, 0, 2, 4, 2, 2, 1, 129),
(26, 5, 3, 4, 1, 2, 1, 5, 3, 3, 0, 130),
(27, 6, 2, 3, 1, 2, 0, 4, 4, 0, 0, 131),
(28, 1, 4, 2, 2, 0, 0, 4, 1, 1, 0, 132),
(29, 2, 2, 1, 0, 1, 0, 1, 3, 0, 0, 133);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `stats_jugador_torneo`
--

CREATE TABLE `stats_jugador_torneo` (
  `Id_Stas_Jugador_Torneo` int(11) NOT NULL,
  `Cantidad_Goles` int(50) NOT NULL,
  `Comentario` char(40) DEFAULT NULL,
  `Id_Jugador` int(11) NOT NULL,
  `Id_Torneo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `stats_jugador_torneo`
--

INSERT INTO `stats_jugador_torneo` (`Id_Stas_Jugador_Torneo`, `Cantidad_Goles`, `Comentario`, `Id_Jugador`, `Id_Torneo`) VALUES
(2, 5, NULL, 6, 2),
(3, 15, NULL, 7, 3),
(4, 3, NULL, 8, 2),
(5, 5, NULL, 9, 5),
(6, 2, NULL, 10, 3),
(7, 12, NULL, 11, 4),
(8, 3, NULL, 12, 6),
(9, 4, NULL, 13, 1),
(10, 100, NULL, 23, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `torneo`
--

CREATE TABLE `torneo` (
  `Id_Torneo` int(11) NOT NULL,
  `Nombre_Torneo` char(15) NOT NULL,
  `Fecha_Inicio` date NOT NULL,
  `Fecha_Fin` date NOT NULL,
  `Comentario` char(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `torneo`
--

INSERT INTO `torneo` (`Id_Torneo`, `Nombre_Torneo`, `Fecha_Inicio`, `Fecha_Fin`, `Comentario`) VALUES
(1, 'UEFA EUROPA LEA', '2022-11-29', '2022-12-29', 'N/A'),
(2, 'UEFA CHAMPIONS', '2022-11-01', '2022-12-01', 'N/A'),
(3, 'COPA LIBERTADOR', '2022-01-15', '2022-02-15', 'N/A'),
(4, 'COPA SUDAMERICA', '2022-08-10', '2022-09-10', 'N/A'),
(5, 'FIFA WORLD CUP', '2022-06-01', '2022-07-01', 'N/A'),
(6, 'COPA DEL REY', '2022-04-15', '2022-05-15', 'N/A'),
(20, 'Liga Betplay', '2022-11-22', '2022-12-20', 'N/A'),
(21, 'Torneo', '2022-11-20', '2022-12-20', 'N/A');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `torneo_cancha`
--

CREATE TABLE `torneo_cancha` (
  `Id_Torneo_Cancha` int(11) NOT NULL,
  `Id_Cancha` int(11) NOT NULL,
  `Id_Torneo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `torneo_cancha`
--

INSERT INTO `torneo_cancha` (`Id_Torneo_Cancha`, `Id_Cancha`, `Id_Torneo`) VALUES
(84, 1, 1),
(85, 4, 1),
(86, 6, 1),
(87, 4, 2),
(88, 5, 2),
(89, 6, 2),
(90, 7, 2),
(91, 6, 3),
(92, 7, 3),
(93, 10, 3),
(94, 11, 3),
(95, 12, 3),
(96, 1, 4),
(97, 4, 4),
(98, 6, 4),
(99, 8, 4),
(100, 9, 4),
(101, 11, 4),
(102, 13, 4),
(103, 2, 5),
(104, 5, 5),
(105, 7, 5),
(106, 13, 5),
(107, 1, 6),
(108, 2, 6),
(109, 4, 6),
(110, 13, 6),
(111, 1, 20),
(112, 4, 20),
(113, 5, 20),
(114, 7, 20),
(115, 12, 20),
(116, 1, 21),
(117, 4, 21),
(118, 6, 21);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `Id_Usuario` int(11) NOT NULL,
  `Nombre_Usuario` varchar(20) NOT NULL,
  `Password` varchar(20) NOT NULL,
  `Cedula` int(15) NOT NULL,
  `Perfil` char(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`Id_Usuario`, `Nombre_Usuario`, `Password`, `Cedula`, `Perfil`) VALUES
(1, 'dayanakv', '123456789', 667569, 'admin'),
(4, 'rafad', '123456789', 417852, 'usuario'),
(5, 'angelr', '123456', 789541, 'usuario'),
(6, 'davida', '123456', 784178, 'usuario'),
(7, 'daniel', '123456', 120124, 'usuario');

--
-- Disparadores `usuario`
--
DELIMITER $$
CREATE TRIGGER `cambio_password` BEFORE UPDATE ON `usuario` FOR EACH ROW BEGIN
			IF OLD.Password <> NEW.Password THEN
				INSERT INTO historial_password (Id_Usuario, Fecha_Cambio, Password_Actual, Password_Nuevo)
				VALUES (OLD.Id_Usuario, NOW(), OLD.Password, NEW.Password);
			END IF;
		END
$$
DELIMITER ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cancha`
--
ALTER TABLE `cancha`
  ADD PRIMARY KEY (`Id_Cancha`);

--
-- Indices de la tabla `equipo`
--
ALTER TABLE `equipo`
  ADD PRIMARY KEY (`Id_Equipo`);

--
-- Indices de la tabla `equipo_torneo`
--
ALTER TABLE `equipo_torneo`
  ADD PRIMARY KEY (`Id_Equipo_Torneo`),
  ADD KEY `equipo_torneo_ibfk_1` (`Id_Equipo`),
  ADD KEY `equipo_torneo_ibfk_2` (`Id_Torneo`);

--
-- Indices de la tabla `historial_password`
--
ALTER TABLE `historial_password`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `jugador`
--
ALTER TABLE `jugador`
  ADD PRIMARY KEY (`Id_Jugador`),
  ADD KEY `Id_Posicion_Jugador` (`Id_Posicion_Jugador`);

--
-- Indices de la tabla `jugador_equipo`
--
ALTER TABLE `jugador_equipo`
  ADD PRIMARY KEY (`Id_Jugador_Equipo`),
  ADD KEY `jugador_equipo_ibfk_1` (`Id_Jugador`),
  ADD KEY `jugador_equipo_ibfk_2` (`Id_Equipo`);

--
-- Indices de la tabla `partido`
--
ALTER TABLE `partido`
  ADD PRIMARY KEY (`Id_Partido`),
  ADD KEY `partido_ibfk_1` (`Id_Torneo_Cancha`),
  ADD KEY `partido_ibfk_2` (`Id_Equipo_Local`),
  ADD KEY `partido_ibfk_3` (`Id_Equipo_Visitante`);

--
-- Indices de la tabla `posicion_jugador`
--
ALTER TABLE `posicion_jugador`
  ADD PRIMARY KEY (`Id_Posicion_Jugador`);

--
-- Indices de la tabla `stats_equipo_torneo`
--
ALTER TABLE `stats_equipo_torneo`
  ADD PRIMARY KEY (`Id_Stats_Equipo_Torneo`),
  ADD KEY `stats_equipo_torneo_ibfk_1` (`Id_Equipo_Torneo`);

--
-- Indices de la tabla `stats_jugador_torneo`
--
ALTER TABLE `stats_jugador_torneo`
  ADD PRIMARY KEY (`Id_Stas_Jugador_Torneo`),
  ADD KEY `stats_jugador_torneo_ibfk_1` (`Id_Jugador`),
  ADD KEY `stats_jugador_torneo_ibfk_2` (`Id_Torneo`);

--
-- Indices de la tabla `torneo`
--
ALTER TABLE `torneo`
  ADD PRIMARY KEY (`Id_Torneo`);

--
-- Indices de la tabla `torneo_cancha`
--
ALTER TABLE `torneo_cancha`
  ADD PRIMARY KEY (`Id_Torneo_Cancha`),
  ADD KEY `torneo_cancha_ibfk_1` (`Id_Cancha`),
  ADD KEY `torneo_cancha_ibfk_2` (`Id_Torneo`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`Id_Usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cancha`
--
ALTER TABLE `cancha`
  MODIFY `Id_Cancha` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `equipo`
--
ALTER TABLE `equipo`
  MODIFY `Id_Equipo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `equipo_torneo`
--
ALTER TABLE `equipo_torneo`
  MODIFY `Id_Equipo_Torneo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=150;

--
-- AUTO_INCREMENT de la tabla `historial_password`
--
ALTER TABLE `historial_password`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `jugador`
--
ALTER TABLE `jugador`
  MODIFY `Id_Jugador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de la tabla `jugador_equipo`
--
ALTER TABLE `jugador_equipo`
  MODIFY `Id_Jugador_Equipo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `partido`
--
ALTER TABLE `partido`
  MODIFY `Id_Partido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT de la tabla `posicion_jugador`
--
ALTER TABLE `posicion_jugador`
  MODIFY `Id_Posicion_Jugador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `stats_equipo_torneo`
--
ALTER TABLE `stats_equipo_torneo`
  MODIFY `Id_Stats_Equipo_Torneo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de la tabla `stats_jugador_torneo`
--
ALTER TABLE `stats_jugador_torneo`
  MODIFY `Id_Stas_Jugador_Torneo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `torneo`
--
ALTER TABLE `torneo`
  MODIFY `Id_Torneo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `torneo_cancha`
--
ALTER TABLE `torneo_cancha`
  MODIFY `Id_Torneo_Cancha` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=119;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `Id_Usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `equipo_torneo`
--
ALTER TABLE `equipo_torneo`
  ADD CONSTRAINT `equipo_torneo_ibfk_1` FOREIGN KEY (`Id_Equipo`) REFERENCES `equipo` (`Id_Equipo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `equipo_torneo_ibfk_2` FOREIGN KEY (`Id_Torneo`) REFERENCES `torneo` (`Id_Torneo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `jugador`
--
ALTER TABLE `jugador`
  ADD CONSTRAINT `jugador_ibfk_1` FOREIGN KEY (`Id_Posicion_Jugador`) REFERENCES `posicion_jugador` (`Id_Posicion_Jugador`);

--
-- Filtros para la tabla `jugador_equipo`
--
ALTER TABLE `jugador_equipo`
  ADD CONSTRAINT `jugador_equipo_ibfk_1` FOREIGN KEY (`Id_Jugador`) REFERENCES `jugador` (`Id_Jugador`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `jugador_equipo_ibfk_2` FOREIGN KEY (`Id_Equipo`) REFERENCES `equipo` (`Id_Equipo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `partido`
--
ALTER TABLE `partido`
  ADD CONSTRAINT `partido_ibfk_1` FOREIGN KEY (`Id_Torneo_Cancha`) REFERENCES `torneo_cancha` (`Id_Torneo_Cancha`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `partido_ibfk_2` FOREIGN KEY (`Id_Equipo_Local`) REFERENCES `equipo` (`Id_Equipo`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `partido_ibfk_3` FOREIGN KEY (`Id_Equipo_Visitante`) REFERENCES `equipo` (`Id_Equipo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `stats_equipo_torneo`
--
ALTER TABLE `stats_equipo_torneo`
  ADD CONSTRAINT `stats_equipo_torneo_ibfk_1` FOREIGN KEY (`Id_Equipo_Torneo`) REFERENCES `equipo_torneo` (`Id_Equipo_Torneo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `stats_jugador_torneo`
--
ALTER TABLE `stats_jugador_torneo`
  ADD CONSTRAINT `stats_jugador_torneo_ibfk_1` FOREIGN KEY (`Id_Jugador`) REFERENCES `jugador` (`Id_Jugador`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `stats_jugador_torneo_ibfk_2` FOREIGN KEY (`Id_Torneo`) REFERENCES `torneo` (`Id_Torneo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `torneo_cancha`
--
ALTER TABLE `torneo_cancha`
  ADD CONSTRAINT `torneo_cancha_ibfk_1` FOREIGN KEY (`Id_Cancha`) REFERENCES `cancha` (`Id_Cancha`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `torneo_cancha_ibfk_2` FOREIGN KEY (`Id_Torneo`) REFERENCES `torneo` (`Id_Torneo`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
