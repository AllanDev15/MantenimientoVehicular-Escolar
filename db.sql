-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-09-2021 a las 20:20:10
-- Versión del servidor: 10.4.21-MariaDB
-- Versión de PHP: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `mantenimiento`
--
-- CREATE DATABASE IF NOT EXISTS `mantenimiento` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
-- USE `mantenimiento`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `operarios`
--

CREATE TABLE `operarios` (
  `idEmpleado` int(11) NOT NULL,
  `nombre` varchar(60) NOT NULL,
  `estatus` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `operarios`
--

INSERT INTO `operarios` (`idEmpleado`, `nombre`, `estatus`) VALUES
(1010, 'Antonio Ramírez', 'disponible'),
(2594, 'Alejandro Acevedo', 'disponible'),
(3345, 'Jorge Casares', 'en servicio'),
(3789, 'Luis López', 'en servicio'),
(6412, 'Marcos Perea', 'disponible'),
(6785, 'Iván  Lozano', 'disponible'),
(8951, 'Andrés García', 'disponible');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `operarios_servicios`
--

CREATE TABLE `operarios_servicios` (
  `idServicio` int(11) NOT NULL,
  `idEmpleado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `operarios_servicios`
--

INSERT INTO `operarios_servicios` (`idServicio`, `idEmpleado`) VALUES
(27, 1010),
(28, 2594),
(29, 3345),
(30, 3789),
(31, 2594);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `refacciones`
--

CREATE TABLE `refacciones` (
  `numeroSerie` varchar(30) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `proveedor` varchar(50) DEFAULT NULL,
  `precio` decimal(6,2) DEFAULT NULL,
  `existencias` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `refacciones`
--

INSERT INTO `refacciones` (`numeroSerie`, `nombre`, `proveedor`, `precio`, `existencias`) VALUES
('11479', 'Convertidor Catalitico CARB Universal', 'MagnaFlow', '9999.00', 5),
('23486', 'Bujia de Iridio AI5702', 'Autolite XP', '209.00', 6),
('33936', 'Amortiguador Excel G', 'KYB', '2589.78', 7),
('4198', 'Llanta', 'Bridgestone', '2500.00', 4),
('66359', 'Interruptor de Presion del Aceite PS151', 'Duralast', '729.00', 6),
('68523', 'Balero de rueda Corsa', 'National', '466.00', 6),
('85423', 'Cilindro de embrague Dorman', 'Wagner', '1003.78', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicios`
--

CREATE TABLE `servicios` (
  `idServicio` int(11) NOT NULL,
  `servicio` varchar(50) NOT NULL,
  `duracionEstimada` smallint(6) DEFAULT NULL,
  `duracionReal` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `servicios`
--

INSERT INTO `servicios` (`idServicio`, `servicio`, `duracionEstimada`, `duracionReal`) VALUES
(27, 'Cambio de embrague', 3, NULL),
(28, 'Cambio de embrague', 3, NULL),
(29, 'Cambio de embrague', 3, NULL),
(30, 'Reparación del modulo de aceite', 3, NULL),
(31, 'Cambio de llanta', 1, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicios_refacciones`
--

CREATE TABLE `servicios_refacciones` (
  `idServicio` int(11) NOT NULL,
  `idRefaccion` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `servicios_refacciones`
--

INSERT INTO `servicios_refacciones` (`idServicio`, `idRefaccion`) VALUES
(27, '11479'),
(27, '85423'),
(28, '33936'),
(28, '85423'),
(29, '33936'),
(30, '66359'),
(31, '4198');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vehiculos`
--

CREATE TABLE `vehiculos` (
  `idVehiculo` int(11) NOT NULL,
  `idRecibido` int(11) DEFAULT NULL,
  `tipoVehiculo` varchar(15) NOT NULL,
  `fechaEntrada` date NOT NULL,
  `empleado` varchar(60) NOT NULL,
  `fallas` varchar(100) NOT NULL,
  `fechaSalida` date DEFAULT NULL,
  `idEntrego` int(11) DEFAULT NULL,
  `idServicio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `vehiculos`
--

INSERT INTO `vehiculos` (`idVehiculo`, `idRecibido`, `tipoVehiculo`, `fechaEntrada`, `empleado`, `fallas`, `fechaSalida`, `idEntrego`, `idServicio`) VALUES
(1, 6412, 'Chrysler voyage', '2021-09-17', 'Álvaro González', 'el vehículo presenta fallas en el embregue y en el motor', '2021-09-17', 1010, 27),
(2, 3345, 'Torton Sitrak H', '2021-09-17', 'Erick Sandoval', 'el vehículo presenta problemas en el amortiguador y en los frenos', '2021-09-17', 2594, 28),
(3, 3345, 'Kenworth T800', '2021-09-17', 'Carlos Rodríguez', 'El vehículo presenta fallas en el freno derecho', '2021-09-20', NULL, 29),
(4, 3345, 'Sterling A9500', '2021-09-17', 'Adolfo Vázquez', 'el vehículo presenta fallas en el modulo de aceite por lo que se deberá revisar si se necesita una r', '2021-09-20', NULL, 30),
(5, 6412, 'Vento Conmfortl', '2021-09-17', 'Gabriel Castañeda', 'El vehiculo tiene problemas en la llanta trasera', '2021-09-17', 2594, 31);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `operarios`
--
ALTER TABLE `operarios`
  ADD PRIMARY KEY (`idEmpleado`);

--
-- Indices de la tabla `operarios_servicios`
--
ALTER TABLE `operarios_servicios`
  ADD KEY `idServicio` (`idServicio`),
  ADD KEY `idEmpleado` (`idEmpleado`);

--
-- Indices de la tabla `refacciones`
--
ALTER TABLE `refacciones`
  ADD PRIMARY KEY (`numeroSerie`);

--
-- Indices de la tabla `servicios`
--
ALTER TABLE `servicios`
  ADD PRIMARY KEY (`idServicio`);

--
-- Indices de la tabla `servicios_refacciones`
--
ALTER TABLE `servicios_refacciones`
  ADD KEY `idServicio` (`idServicio`),
  ADD KEY `idRefaccion` (`idRefaccion`);

--
-- Indices de la tabla `vehiculos`
--
ALTER TABLE `vehiculos`
  ADD PRIMARY KEY (`idVehiculo`),
  ADD KEY `idRecibido` (`idRecibido`),
  ADD KEY `idEntrego` (`idEntrego`),
  ADD KEY `idServicio` (`idServicio`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `operarios`
--
ALTER TABLE `operarios`
  MODIFY `idEmpleado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8952;

--
-- AUTO_INCREMENT de la tabla `servicios`
--
ALTER TABLE `servicios`
  MODIFY `idServicio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de la tabla `vehiculos`
--
ALTER TABLE `vehiculos`
  MODIFY `idVehiculo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `operarios_servicios`
--
ALTER TABLE `operarios_servicios`
  ADD CONSTRAINT `operarios_servicios_ibfk_1` FOREIGN KEY (`idServicio`) REFERENCES `servicios` (`idServicio`) ON DELETE CASCADE,
  ADD CONSTRAINT `operarios_servicios_ibfk_2` FOREIGN KEY (`idEmpleado`) REFERENCES `operarios` (`idEmpleado`) ON DELETE CASCADE;

--
-- Filtros para la tabla `servicios_refacciones`
--
ALTER TABLE `servicios_refacciones`
  ADD CONSTRAINT `servicios_refacciones_ibfk_1` FOREIGN KEY (`idServicio`) REFERENCES `servicios` (`idServicio`) ON DELETE CASCADE,
  ADD CONSTRAINT `servicios_refacciones_ibfk_2` FOREIGN KEY (`idRefaccion`) REFERENCES `refacciones` (`numeroSerie`) ON DELETE CASCADE;

--
-- Filtros para la tabla `vehiculos`
--
ALTER TABLE `vehiculos`
  ADD CONSTRAINT `vehiculos_ibfk_1` FOREIGN KEY (`idRecibido`) REFERENCES `operarios` (`idEmpleado`) ON DELETE SET NULL,
  ADD CONSTRAINT `vehiculos_ibfk_2` FOREIGN KEY (`idEntrego`) REFERENCES `operarios` (`idEmpleado`) ON DELETE SET NULL,
  ADD CONSTRAINT `vehiculos_ibfk_3` FOREIGN KEY (`idServicio`) REFERENCES `servicios` (`idServicio`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
