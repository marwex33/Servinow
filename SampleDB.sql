-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-11-2024 a las 02:04:42
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `proyecto_final`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `CODIGO_CLIENTE` int(4) NOT NULL,
  `NOMBRES` varchar(30) NOT NULL,
  `APELLIDOS` varchar(30) NOT NULL,
  `CORREO_ELECTRONICO` varchar(40) NOT NULL,
  `USUARIO` varchar(30) NOT NULL,
  `CONTRASEÑA` varchar(255) NOT NULL,
  `TELEFONO` int(10) NOT NULL,
  `TIPO_CLIENTE` varchar(20) NOT NULL,
  `BORRADO` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`CODIGO_CLIENTE`, `NOMBRES`, `APELLIDOS`, `CORREO_ELECTRONICO`, `USUARIO`, `CONTRASEÑA`, `TELEFONO`, `TIPO_CLIENTE`, `BORRADO`) VALUES
(1, 'Alejandro', 'Labastie', 'ale@gmail.com', 'aleprueba', '81dc9bdb52d04dc20036dbd8313ed055', 1164026532, 'USUARIO', 0),
(2, 'Matias', 'labastie', 'labastie@gmail.com', 'matiprueba', '81dc9bdb52d04dc20036dbd8313ed055', 1164026530, 'USUARIO', 0),
(3, 'ADMIN', 'ADMIN', 'admin@servinow.com', 'ADMIN', '81dc9bdb52d04dc20036dbd8313ed055', 0, 'ADMIN', 0),
(5, 'Agustin', 'Gonzalez', 'agc@gmail.com', 'agc', '81dc9bdb52d04dc20036dbd8313ed055', 1, 'USUARIO', 0),
(6, 'Matias', 'Alviso', 'amatiasalviso@gmail.com', 'Mati', '81dc9bdb52d04dc20036dbd8313ed055', 12, 'USUARIO', 0),
(7, 'Luca', 'Saavedra', 'ls@gmail.com', 'LSaavedra', '81dc9bdb52d04dc20036dbd8313ed055', 123, 'CONCESIONARIO', 0),
(8, 'Franco', 'Fraga', 'ffraga@gmail.com', 'FFraga', '81dc9bdb52d04dc20036dbd8313ed055', 123, 'CONCESIONARIO', 0),
(9, 'Man', 'Super', 'Sm@gmail.com', 'SMan', '81dc9bdb52d04dc20036dbd8313ed055', 123, 'USUARIO', 0),
(10, 'Man', 'Super', 'Sm@gmail.com', 'SMan', '81dc9bdb52d04dc20036dbd8313ed055', 123, 'USUARIO', 1),
(11, 'Aq', 's', 'as@gmail.com', 'as', '81dc9bdb52d04dc20036dbd8313ed055', 123, 'USUARIO', 0),
(12, 'd', 'f', 'df@gmail.com', 'df', '81dc9bdb52d04dc20036dbd8313ed055', 123, 'USUARIO', 0),
(13, 'l', 'k', 'lk@gmail.com', 'LK', '81dc9bdb52d04dc20036dbd8313ed055', 123, 'USUARIO', 0),
(14, 'j', 'h', 'jh@gmail.com', 'JH', '81dc9bdb52d04dc20036dbd8313ed055', 12345, 'USUARIO', 0),
(15, '', '', '', '', '81dc9bdb52d04dc20036dbd8313ed055', 0, 'USUARIO', 1),
(16, 'a', 'a', 'aa@gmail.com', 'AA', '81dc9bdb52d04dc20036dbd8313ed055', 123, 'USUARIO', 0),
(17, 'a', 'a', 'aa@gmail.com', 'AA2', '81dc9bdb52d04dc20036dbd8313ed055', 1234, 'USUARIO', 1),
(18, 'a', 'a', 'aa@gmail.com', 'AA3', '81dc9bdb52d04dc20036dbd8313ed055', 1234, 'CONCESIONARIO', 1),
(19, 'p', 'o', 'po@gmail.com', 'PO', '81dc9bdb52d04dc20036dbd8313ed055', 54234, 'CONCESIONARIO', 0),
(20, 'w', 'q', 'wq@gmail.com', 'WQ', '81dc9bdb52d04dc20036dbd8313ed055', 124512434, 'USUARIO', 0),
(21, 'r', 't', 'rt@gmail.com', 'RT', '81dc9bdb52d04dc20036dbd8313ed055', 44562576, 'CONCESIONARIO', 0),
(22, 'martin', 'mitre', 'mm@gmail.com', 'martin44', '81dc9bdb52d04dc20036dbd8313ed055', 11223345, 'USUARIO', 0),
(23, 'Juan', 'Mitre', 'jm@gmail.com', 'Juan33', '81dc9bdb52d04dc20036dbd8313ed055', 21123434, 'CONCESIONARIO', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `concesionario`
--

CREATE TABLE `concesionario` (
  `CODIGO_CONCESIONARIO` int(8) NOT NULL,
  `NOMBRE` varchar(30) NOT NULL,
  `DIRECCION` varchar(255) NOT NULL,
  `TELEFONO` int(10) NOT NULL,
  `CORREO_ELECTRONICO` varchar(40) NOT NULL,
  `CODIGO_USUARIO` int(4) DEFAULT NULL,
  `BORRADO` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `concesionario`
--

INSERT INTO `concesionario` (`CODIGO_CONCESIONARIO`, `NOMBRE`, `DIRECCION`, `TELEFONO`, `CORREO_ELECTRONICO`, `CODIGO_USUARIO`, `BORRADO`) VALUES
(1, 'COLCAR', 'Galileo Galilei S/N, B1744 Gran Buenos A', 237444655, 'colcar@mercedes-benz.com', 23, 0),
(15, 'Luxcar', 'Au Acceso Oeste 800 Km.36, B1744 Gran Bu', 21474836, 'luxcar@volskwagen.com', 8, 0),
(17, 'Auletta Automotores', 'Villa Luzuriaga, Provincia de Buenos Aires', 35235428, 'aa@gmail.com', 19, 0),
(19, 'Chevrolet Forest Car', 'Av. Hipólito Yrigoyen 136', 455472, 'cfc@gmail.com', NULL, 1),
(21, 'Rubén Méndez Automotores', 'Avenida Don Bosco 8480 Avenida Don Bosco y, Av. Cristianía Gran, B1755 Buenos Aires, Provincia de Buenos Aires', 452326, 'rma@gmail.com', NULL, 0),
(22, 'Serviclub2', 'charcas 1571', 12344321, 's2@gmail.com', 21, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mantenimiento`
--

CREATE TABLE `mantenimiento` (
  `CODIGO_SERVICIO` int(4) NOT NULL,
  `DESCRIPCION` varchar(255) NOT NULL,
  `PRECIO_MANO_OBRA` int(8) NOT NULL,
  `DURACION` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `mantenimiento`
--

INSERT INTO `mantenimiento` (`CODIGO_SERVICIO`, `DESCRIPCION`, `PRECIO_MANO_OBRA`, `DURACION`) VALUES
(1, 'Mantenimiento proactivo', 20000, 4),
(2, 'Mantenimiento preventivo', 30000, 8),
(3, 'Mantenimiento correctivo', 40000, 9),
(4, 'Mantenimiento predictivo', 50000, 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensaje`
--

CREATE TABLE `mensaje` (
  `CODIGO_MENSAJE` int(4) NOT NULL,
  `TITULO` varchar(30) NOT NULL,
  `MENSAJE` text NOT NULL,
  `CORREO_ELECTRONICO` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `mensaje`
--

INSERT INTO `mensaje` (`CODIGO_MENSAJE`, `TITULO`, `MENSAJE`, `CORREO_ELECTRONICO`) VALUES
(1, 'Turno', 'quiero cambiar mi turno\r\n', 'ale@gmail.com'),
(2, 'Turno', 'quiero cancelar mi turno', 'ale@gmail.com'),
(7, 'Mantenimientos', 'que mantenimientos ofrecen', 'yo@gmail.com'),
(8, 'Vehiculos', 'que marcas puedo ingresar', 'ale@gmail.com'),
(9, 'Vehiculos', 'que marcas puedo ingresar', 'ale@gmail.com'),
(10, 'Turnos', 'Quiero modificar un turno', 'mm@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `turno`
--

CREATE TABLE `turno` (
  `CODIGO_TURNO` int(4) NOT NULL,
  `FECHA_TURNO` date NOT NULL,
  `HORA_TURNO` varchar(5) NOT NULL,
  `ESTADO_TURNO` varchar(20) NOT NULL,
  `MANT_CODIGO_SERVICIO` int(4) NOT NULL,
  `CONCESIONARIO_CODIGO` int(4) NOT NULL,
  `VEHICULO_PATENTE` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `turno`
--

INSERT INTO `turno` (`CODIGO_TURNO`, `FECHA_TURNO`, `HORA_TURNO`, `ESTADO_TURNO`, `MANT_CODIGO_SERVICIO`, `CONCESIONARIO_CODIGO`, `VEHICULO_PATENTE`) VALUES
(2, '2024-11-06', '9:30', 'CANCELADO', 1, 1, 'ab122sa'),
(3, '2024-11-22', '12:30', 'MODIFICADO', 1, 15, 'ab122sd'),
(4, '2024-11-20', '12:00', 'PENDIENTE', 1, 1, 'ab122se'),
(5, '2024-11-05', '16:30', 'CANCELADO', 1, 1, 'AC800BD'),
(6, '2024-11-06', '13:30', 'PENDIENTE', 1, 1, 'ab122sa'),
(7, '2024-11-21', '14:00', 'PENDIENTE', 1, 15, 'MHH412'),
(8, '2024-11-14', '16:30', 'CANCELADO', 1, 15, 'AC800BD'),
(9, '2024-11-06', '17:00', 'PENDIENTE', 1, 15, 'ab122se'),
(10, '2024-11-06', '17:00', 'PENDIENTE', 1, 15, 'ab122se'),
(11, '2024-11-07', '17:30', 'CANCELADO', 1, 15, 'AC800BD'),
(12, '2024-11-19', '14:00', 'PENDIENTE', 1, 1, 'AD808CD'),
(13, '2024-11-22', '16:30', 'PENDIENTE', 1, 15, 'ab122sd'),
(14, '2024-11-22', '16:00', 'PENDIENTE', 1, 15, 'ab122sa'),
(15, '2024-11-22', '16:30', 'PENDIENTE', 1, 15, 'ab122sa'),
(16, '2024-11-22', '16:30', 'PENDIENTE', 1, 15, 'ab122sa'),
(17, '2024-11-22', '16:30', 'CANCELADO', 1, 15, 'MAA417'),
(18, '2024-12-07', '9:00', 'CANCELADO', 1, 15, 'MHH412'),
(19, '2024-11-30', '10:00', 'CANCELADO', 1, 15, 'sa125sa'),
(20, '2024-11-30', '10:00', 'CANCELADO', 1, 15, 'sa125sa'),
(21, '2024-11-28', '8:30', 'PENDIENTE', 1, 1, 'sa125sa'),
(22, '2024-11-15', '15:30', 'CANCELADO', 1, 1, 'kl303lk'),
(23, '2024-11-23', '16:30', 'CANCELADO', 1, 15, 'jk876kj'),
(24, '2024-11-21', '16:00', 'MODIFICADO', 1, 17, 'op101po'),
(25, '2024-11-12', '15:30', 'CANCELADO', 1, 17, 'as322as'),
(26, '2024-11-12', '14:30', 'CANCELADO', 1, 1, 'op101po'),
(27, '2024-11-13', '08:00', 'CANCELADO', 2, 1, 'er323re');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vehiculo`
--

CREATE TABLE `vehiculo` (
  `PATENTE` varchar(7) NOT NULL,
  `MARCA` varchar(20) NOT NULL,
  `MODELO` varchar(20) NOT NULL,
  `ANIO` int(4) NOT NULL,
  `CODIGO_PROPIETARIO` int(4) DEFAULT NULL,
  `BORRADO` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `vehiculo`
--

INSERT INTO `vehiculo` (`PATENTE`, `MARCA`, `MODELO`, `ANIO`, `CODIGO_PROPIETARIO`, `BORRADO`) VALUES
('ab122sa', 'Ford', 'KA', 2014, 6, 0),
('ab122sd', 'Ford', 'K3245', 2014, 6, 0),
('ab122se', 'Ford', 'KA', 2014, 6, 0),
('AC057MO', 'VOLKSWAGEN', 'GOL TREND', 2017, 5, 0),
('AC800BD', 'BMW', 'M3', 2018, 1, 1),
('AD808CD', 'AUDI', 'A3', 2020, 2, 0),
('as322as', 'Ford', 'Hilux', 3424, 10, 1),
('er323re', 'Ford', 'Focus', 2024, 22, 0),
('jk876kj', 'Chevrolet', 'Camaro', 1999, 14, 0),
('kl303lk', 'Audi', 'A6', 2005, 14, 0),
('MAA417', 'VOLKSWAGEN', 'VENTO', 2013, 2, 0),
('MHH412', 'MERCEDES BENZ', 'A45 AMG', 2013, 2, 0),
('op101po', 'Citroen', 'C4', 2005, 1, 0),
('qw323wq', 'Toyota', 'Hilux', 2021, 1, 1),
('qw345wq', 'Audi', 'Ka', 1998, 1, 0),
('rt343rt', 'Ford', 'Focus', 2024, 22, 1),
('sa125sa', 'Ford', 'Focus', 2123, 11, 0),
('sd321ds', 'Honda', 'Hilux', 1980, 11, 0),
('we213we', 'Toyota', 'Hilux', 2921, 1, 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`CODIGO_CLIENTE`);

--
-- Indices de la tabla `concesionario`
--
ALTER TABLE `concesionario`
  ADD PRIMARY KEY (`CODIGO_CONCESIONARIO`),
  ADD UNIQUE KEY `CODIGO_USUARIO` (`CODIGO_USUARIO`) USING BTREE;

--
-- Indices de la tabla `mantenimiento`
--
ALTER TABLE `mantenimiento`
  ADD PRIMARY KEY (`CODIGO_SERVICIO`);

--
-- Indices de la tabla `mensaje`
--
ALTER TABLE `mensaje`
  ADD PRIMARY KEY (`CODIGO_MENSAJE`);

--
-- Indices de la tabla `turno`
--
ALTER TABLE `turno`
  ADD PRIMARY KEY (`CODIGO_TURNO`),
  ADD KEY `TURNO_CONCESIONARIO_FK` (`CONCESIONARIO_CODIGO`),
  ADD KEY `TURNO_MANTENIMIENTO_FK` (`MANT_CODIGO_SERVICIO`),
  ADD KEY `PATENTE` (`VEHICULO_PATENTE`);

--
-- Indices de la tabla `vehiculo`
--
ALTER TABLE `vehiculo`
  ADD PRIMARY KEY (`PATENTE`),
  ADD KEY `VEHICULO_CLIENTE_FK` (`CODIGO_PROPIETARIO`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `CODIGO_CLIENTE` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `concesionario`
--
ALTER TABLE `concesionario`
  MODIFY `CODIGO_CONCESIONARIO` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `mantenimiento`
--
ALTER TABLE `mantenimiento`
  MODIFY `CODIGO_SERVICIO` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `mensaje`
--
ALTER TABLE `mensaje`
  MODIFY `CODIGO_MENSAJE` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `turno`
--
ALTER TABLE `turno`
  MODIFY `CODIGO_TURNO` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `concesionario`
--
ALTER TABLE `concesionario`
  ADD CONSTRAINT `cliente` FOREIGN KEY (`CODIGO_USUARIO`) REFERENCES `cliente` (`CODIGO_CLIENTE`);

--
-- Filtros para la tabla `turno`
--
ALTER TABLE `turno`
  ADD CONSTRAINT `TURNO_CONCESIONARIO_FK` FOREIGN KEY (`CONCESIONARIO_CODIGO`) REFERENCES `concesionario` (`CODIGO_CONCESIONARIO`),
  ADD CONSTRAINT `TURNO_MANTENIMIENTO_FK` FOREIGN KEY (`MANT_CODIGO_SERVICIO`) REFERENCES `mantenimiento` (`CODIGO_SERVICIO`),
  ADD CONSTRAINT `VEHICULO` FOREIGN KEY (`VEHICULO_PATENTE`) REFERENCES `vehiculo` (`PATENTE`);

--
-- Filtros para la tabla `vehiculo`
--
ALTER TABLE `vehiculo`
  ADD CONSTRAINT `VEHICULO_CLIENTE_FK` FOREIGN KEY (`CODIGO_PROPIETARIO`) REFERENCES `cliente` (`CODIGO_CLIENTE`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
