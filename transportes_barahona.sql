-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 08-12-2024 a las 01:02:33
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `transportes_barahona`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Detalle_de_Pedido`
--

CREATE TABLE `Detalle_de_Pedido` (
  `detalle_id` int(11) NOT NULL,
  `pedido_id` int(11) NOT NULL,
  `servicio_id` int(11) NOT NULL,
  `cantidad` int(11) DEFAULT 1,
  `descripcion` text DEFAULT NULL,
  `telefono_contacto` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `Detalle_de_Pedido`
--

INSERT INTO `Detalle_de_Pedido` (`detalle_id`, `pedido_id`, `servicio_id`, `cantidad`, `descripcion`, `telefono_contacto`) VALUES
(1, 1, 4, 1, 'Cosmética', '666999555'),
(2, 2, 1, 1, 'pedido de prueba', '666999555'),
(3, 3, 1, 1, '000000', '666999555'),
(4, 4, 3, 1, 'Congelador', '666999555'),
(6, 6, 3, 1, 'Muebles grandes', '666999556'),
(8, 8, 1, 1, 'Mudanza de trastero', '666999555'),
(9, 9, 2, 1, 'Ventanas muchas grandes de cristal', '645859574');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Pedido`
--

CREATE TABLE `Pedido` (
  `pedido_id` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `estado_pedido` varchar(50) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `Pedido`
--

INSERT INTO `Pedido` (`pedido_id`, `usuario_id`, `estado_pedido`, `fecha`) VALUES
(1, NULL, 'entrega_completada', '2024-12-14'),
(2, NULL, 'pendiente', '2024-12-08'),
(3, 2, 'pendiente', '2024-12-14'),
(4, NULL, 'pendiente', '2024-12-21'),
(6, NULL, 'en_transito', '2024-12-22'),
(8, 6, 'pendiente', '2024-12-15'),
(9, NULL, 'pendiente', '2024-12-29');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Servicio`
--

CREATE TABLE `Servicio` (
  `servicio_id` int(11) NOT NULL,
  `nombre_servicio` varchar(100) NOT NULL,
  `descripcion` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `Servicio`
--

INSERT INTO `Servicio` (`servicio_id`, `nombre_servicio`, `descripcion`) VALUES
(1, 'mudanzas', 'Servicio especializado en mudanzas locales y nacionales, con cuidado profesional de tus pertenencias.'),
(2, 'embalaje', 'Servicio de embalaje profesional para garantizar la seguridad de tus objetos durante el transporte.'),
(3, 'guardamuebles', 'Servicio de guardamuebles con almacenamiento seguro y protegido para tus bienes personales o comerciales.'),
(4, 'paqueteria en frio', 'Servicio de paquetería en frío para transporte de mercancías que requieren refrigeración constante.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Usuario`
--

CREATE TABLE `Usuario` (
  `usuario_id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `numero_telefono` varchar(15) DEFAULT NULL,
  `contrasenia` varchar(255) NOT NULL,
  `nombre_rol` enum('cliente','administrador') DEFAULT 'cliente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `Usuario`
--

INSERT INTO `Usuario` (`usuario_id`, `nombre`, `email`, `direccion`, `numero_telefono`, `contrasenia`, `nombre_rol`) VALUES
(1, 'Andre', 'andre@hotmail.com', 'calle andorra 27 bj post 1', '666888777', '$2y$10$zPLZwbXNOwg4l0SaKgJoeOcr5FLlQc5qftSP/iJrI5NzCu7nG22ZG', 'administrador'),
(2, 'Andrea', 'andreacruz@hotmail.com', 'calle del administrador', '000000000', '$2y$10$wN8BO.5iyEIBmYjhSNIi3OVWT0JE4elUeFbJ5MpHZ7S7rnvs5vC8S', 'administrador'),
(5, 'Andrea', 'andrea2@hotmail.com', 'calle felicidad 7', '666555888', '$2y$10$RMR6r81HYhX16/3aZWiPW./YAzLo9ZNRWv6j1nrIPzXwuDdaXQRC.', 'cliente'),
(6, 'Laura', 'laura@hotmail.com', 'calle laura 7', '666999888', '$2y$10$xBGCWkbmYipl/SUhLzJBTuBW5kHwhtrvo4F.kiMY1wl96zGsYwKOi', 'cliente');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `Detalle_de_Pedido`
--
ALTER TABLE `Detalle_de_Pedido`
  ADD PRIMARY KEY (`detalle_id`),
  ADD KEY `pedido_id` (`pedido_id`),
  ADD KEY `servicio_id` (`servicio_id`);

--
-- Indices de la tabla `Pedido`
--
ALTER TABLE `Pedido`
  ADD PRIMARY KEY (`pedido_id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Indices de la tabla `Servicio`
--
ALTER TABLE `Servicio`
  ADD PRIMARY KEY (`servicio_id`);

--
-- Indices de la tabla `Usuario`
--
ALTER TABLE `Usuario`
  ADD PRIMARY KEY (`usuario_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `Detalle_de_Pedido`
--
ALTER TABLE `Detalle_de_Pedido`
  MODIFY `detalle_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `Pedido`
--
ALTER TABLE `Pedido`
  MODIFY `pedido_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `Servicio`
--
ALTER TABLE `Servicio`
  MODIFY `servicio_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `Usuario`
--
ALTER TABLE `Usuario`
  MODIFY `usuario_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `Detalle_de_Pedido`
--
ALTER TABLE `Detalle_de_Pedido`
  ADD CONSTRAINT `detalle_de_pedido_ibfk_1` FOREIGN KEY (`pedido_id`) REFERENCES `Pedido` (`pedido_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `detalle_de_pedido_ibfk_2` FOREIGN KEY (`servicio_id`) REFERENCES `Servicio` (`servicio_id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `Pedido`
--
ALTER TABLE `Pedido`
  ADD CONSTRAINT `pedido_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `Usuario` (`usuario_id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
