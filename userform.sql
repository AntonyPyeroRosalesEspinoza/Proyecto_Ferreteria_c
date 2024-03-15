-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 31-03-2022 a las 17:39:23
-- Versión del servidor: 10.1.26-MariaDB
-- Versión de PHP: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `userform`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `opciones`
--

CREATE TABLE `opciones` (
  `Idopciones` int(11) NOT NULL,
  `descripcion` varchar(100) DEFAULT NULL,
  `status` varchar(30) DEFAULT NULL,
  `idrol` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `opciones`
--

INSERT INTO `opciones` (`Idopciones`, `descripcion`, `status`, `idrol`) VALUES
(1, 'Opcion 1', '1', 1),
(2, 'Opcion 2', '1', 2),
(3, 'opcion 3', '1', 3),
(4, 'opcion 4', '1', 2),
(5, 'opcion 5', '1', 3),
(6, 'opcion 6', '1', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `idrol` int(11) NOT NULL,
  `descripcion` varchar(50) DEFAULT NULL,
  `estado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`idrol`, `descripcion`, `estado`) VALUES
(1, 'Recepcionista', 1),
(2, 'Cajero', 1),
(3, 'Recepcion de Reclamos', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tablatrabajador`
--

CREATE TABLE `tablatrabajador` (
  `Id` int(11) NOT NULL,
  `usuario` varchar(100) CHARACTER SET armscii8 DEFAULT NULL,
  `email` varchar(100) CHARACTER SET armscii8 DEFAULT NULL,
  `password` varchar(100) CHARACTER SET armscii8 DEFAULT NULL,
  `code` varchar(100) CHARACTER SET armscii8 DEFAULT NULL,
  `status` varchar(100) CHARACTER SET armscii8 DEFAULT NULL,
  `idrol` int(11) NOT NULL,
  `DNI` int(11) NOT NULL,
  `mascota` varchar(50) NOT NULL,
  `favorito` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tablatrabajador`
--

INSERT INTO `tablatrabajador` (`Id`, `usuario`, `email`, `password`, `code`, `status`, `idrol`, `DNI`, `mascota`, `favorito`) VALUES
(1, 'kabanyasu', 'jhacson0cabanillas@gmail.com', '2bb0d3ebcfc49676fceefb158b0cf500', '0', 'verified', 2, 73989712, 'muchi', 'genshin');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `trabajador`
--

CREATE TABLE `trabajador` (
  `DNI` int(11) NOT NULL,
  `nombres` varchar(50) DEFAULT NULL,
  `apellidopaterno` varchar(50) DEFAULT NULL,
  `apellidomaterno` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `trabajador`
--

INSERT INTO `trabajador` (`DNI`, `nombres`, `apellidopaterno`, `apellidomaterno`) VALUES
(73452312, 'Christian', 'Rojas', 'Rojas'),
(73989712, 'Bremilda', 'Leon', 'Millan'),
(74530862, 'Jhackson', 'Cabanillas', 'Choquehuanca'),
(74563746, 'Jhon', 'Santos', 'Mondragon'),
(74568976, 'Juan', 'Delgado', 'Mondragon'),
(74658796, 'Alexander', 'Perez', 'Vaca'),
(74659879, 'Mark', 'Lopez', 'Chuquizuta'),
(76748939, 'Luis', 'Mondragon', 'Choquehuanca');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usertable`
--

CREATE TABLE `usertable` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `code` mediumint(50) NOT NULL,
  `status` text NOT NULL,
  `idrol` int(11) NOT NULL,
  `DNI` int(11) NOT NULL,
  `mascota` varchar(100) NOT NULL,
  `favorito` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usertable`
--

INSERT INTO `usertable` (`id`, `name`, `email`, `password`, `code`, `status`, `idrol`, `DNI`, `mascota`, `favorito`) VALUES
(1, 'kabanyasu', 'jhacson0cabanillas@gmail.com', '$2y$10$er6sC7gOxFrnJ/bsYUE1ou7v/LEegXJmEq8B8/XlS/5DXZUWlb9pm', 0, 'verified', 1, 74530862, 'muchi', 'genshin'),
(2, 'antony', 'sakata0gintoki2017@gmail.com', '$2y$10$cj0oXaCCo6C3GqZIjFMnLecsNiqv/Xy1nxDAbkdzr8QvF617Zg5Vq', 0, 'NotVerified', 0, 0, '', '');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `opciones`
--
ALTER TABLE `opciones`
  ADD PRIMARY KEY (`Idopciones`),
  ADD KEY `idrol` (`idrol`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`idrol`);

--
-- Indices de la tabla `tablatrabajador`
--
ALTER TABLE `tablatrabajador`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `idrol` (`idrol`),
  ADD KEY `DNI` (`DNI`);

--
-- Indices de la tabla `trabajador`
--
ALTER TABLE `trabajador`
  ADD PRIMARY KEY (`DNI`);

--
-- Indices de la tabla `usertable`
--
ALTER TABLE `usertable`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `opciones`
--
ALTER TABLE `opciones`
  MODIFY `Idopciones` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `idrol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usertable`
--
ALTER TABLE `usertable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `opciones`
--
ALTER TABLE `opciones`
  ADD CONSTRAINT `opciones_ibfk_1` FOREIGN KEY (`idrol`) REFERENCES `rol` (`idrol`);

--
-- Filtros para la tabla `tablatrabajador`
--
ALTER TABLE `tablatrabajador`
  ADD CONSTRAINT `tablatrabajador_ibfk_1` FOREIGN KEY (`idrol`) REFERENCES `rol` (`idrol`),
  ADD CONSTRAINT `tablatrabajador_ibfk_2` FOREIGN KEY (`DNI`) REFERENCES `trabajador` (`DNI`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
