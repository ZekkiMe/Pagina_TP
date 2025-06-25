-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 24-06-2025 a las 18:46:40
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `pagina_tp`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `correos_enviados`
--

CREATE TABLE `correos_enviados` (
  `ID` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `correo_destinatario` varchar(255) NOT NULL,
  `fecha_envio` date NOT NULL DEFAULT curdate(),
  `tipo_correo` enum('cumpleaños','notificacion') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datos_usuarios`
--

CREATE TABLE `datos_usuarios` (
  `ID` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `pass_hash` varchar(255) NOT NULL,
  `email` varchar(30) NOT NULL,
  `estado` int(2) NOT NULL DEFAULT 1,
  `tipo` char(1) NOT NULL DEFAULT 'C',
  `fecha_nacimiento` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `datos_usuarios`
--

INSERT INTO `datos_usuarios` (`ID`, `nombre`, `pass`, `pass_hash`, `email`, `estado`, `tipo`, `fecha_nacimiento`) VALUES
(1, 'Pepito', '1234', '$2y$08$Kl1YwtcsdfbG6P7BOVVz/OFrgXqaR1y6WQomf.A1CuMEzkM4s.5i.', 'b@mail.com', 1, 'A', '2003-08-27');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_orden`
--

CREATE TABLE `detalle_orden` (
  `ID` int(11) NOT NULL,
  `id_reserva` int(11) NOT NULL,
  `id_plato` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `detalle_orden`
--

INSERT INTO `detalle_orden` (`ID`, `id_reserva`, `id_plato`, `cantidad`) VALUES
(1, 1, 14, 2),
(3, 1, 1, 1),
(4, 1, 13, 1),
(5, 1, 21, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facturas`
--

CREATE TABLE `facturas` (
  `id_factura` int(11) NOT NULL,
  `id_reserva` int(11) NOT NULL,
  `fecha_emision` date NOT NULL DEFAULT curdate(),
  `total` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `platos`
--

CREATE TABLE `platos` (
  `ID` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `tipo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `platos`
--

INSERT INTO `platos` (`ID`, `nombre`, `descripcion`, `precio`, `tipo`) VALUES
(1, 'Bruschetta', 'Tostadas de pan con tomate, albahaca, ajo y aceite de oliva', 6.50, 'entradas'),
(2, 'Croquetas de Jamón', 'Croquetas cremosas de jamón ibérico, empanadas y fritas', 7.00, 'entradas'),
(3, 'Sopa de Ajo', 'Sopa tradicional con ajo, huevo y pan frito', 5.50, 'entradas'),
(4, 'Tartar de Salmón', 'Tartar fresco de salmón con aguacate, cebolla morada y limón', 9.00, 'entradas'),
(5, 'Ensalada César', 'Ensalada con lechuga, pollo a la parrilla, croutons y salsa César', 8.50, 'ensaladas'),
(6, 'Ensalada Caprese', 'Tomates, mozzarella, albahaca y aceite de oliva', 7.00, 'ensaladas'),
(7, 'Ensalada Griega', 'Pepino, tomate, aceitunas, queso feta, cebolla roja y orégano', 7.50, 'ensaladas'),
(8, 'Ensalada de Atún', 'Lechuga, atún, tomate, huevo duro, cebolla y aceitunas', 8.00, 'ensaladas'),
(9, 'Espaguetis Bolognesa', 'Espaguetis con salsa de carne, tomate, cebolla y hierbas', 12.00, 'pasta'),
(10, 'Lasagna', 'Lasagna de carne con salsa bechamel, tomate y queso fundido', 14.00, 'pasta'),
(11, 'Raviolis de Ricotta', 'Raviolis rellenos de ricotta con salsa de tomate y albahaca', 11.50, 'pasta'),
(12, 'Fettuccine Alfredo', 'Fettuccine con salsa cremosa de queso parmesano y mantequilla', 13.00, 'pasta'),
(13, 'Parrillada de Carne', 'Variedad de carnes a la parrilla como costillas, chorizo y vacío', 20.00, 'parrilla'),
(14, 'Bife de Chorizo', 'Corte de carne jugoso acompañado de papas fritas', 18.50, 'parrilla'),
(15, 'Provoleta', 'Queso provolone derretido a la parrilla, servido con orégano', 9.00, 'parrilla'),
(16, 'Milanesa a la Napolitana', 'Filete empanado cubierto con salsa de tomate, jamón y queso', 15.00, 'parrilla'),
(17, 'Filete de Salmón a la Parrilla', 'Salmón fresco a la parrilla con hierbas aromáticas', 18.00, 'pescados'),
(18, 'Lubina al Horno', 'Lubina con limón, ajo, y un toque de aceite de oliva', 20.00, 'pescados'),
(19, 'Tartar de Atún', 'Atún fresco en cubos con aguacate, cebollas moradas y sésamo', 22.00, 'pescados'),
(20, 'Paella de Mariscos', 'Arroz con mariscos frescos como calamares, gambas y mejillones', 24.00, 'pescados'),
(21, 'Tiramisú', 'Postre clásico italiano con café, cacao y mascarpone', 6.00, 'postres'),
(22, 'Helado Artesanal', 'Variedad de helados caseros en sabores como vainilla, chocolate y fresa', 4.50, 'postres'),
(23, 'Crêpes de Nutella', 'Crêpes rellenas de Nutella, acompañadas de frutas y crema chantilly', 7.50, 'postres'),
(24, 'Flan Casero', 'Flan de huevo con caramelo, preparado de forma casera', 5.00, 'postres');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservas`
--

CREATE TABLE `reservas` (
  `ID` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `dia` date NOT NULL,
  `horario` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `observaciones` varchar(255) DEFAULT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `reservas`
--

INSERT INTO `reservas` (`ID`, `dia`, `horario`, `cantidad`, `nombre`, `mail`, `observaciones`, `estado`) VALUES
(1, '2023-10-26', 1, 4, 'Reservación 1', 'res1@email.com', NULL, 1),
(2, '2023-10-26', 3, 2, 'Reservación 2', 'res2@email.com', NULL, 1),
(3, '2023-10-26', 5, 6, 'Reservación 3', 'res3@email.com', NULL, 1),
(4, '2023-10-27', 1, 5, 'Reservación 4', 'res4@email.com', NULL, 1),
(5, '2023-10-27', 2, 8, 'Reservación 5', 'res5@email.com', NULL, 1),
(6, '2023-10-27', 4, 3, 'Reservación 6', 'res6@email.com', NULL, 1),
(7, '2023-10-28', 2, 9, 'Reservación 7', 'res7@email.com', NULL, 1),
(8, '2023-10-28', 3, 7, 'Reservación 8', 'res8@email.com', NULL, 1),
(9, '2023-10-28', 5, 1, 'Reservación 9', 'res9@email.com', NULL, 1),
(10, '2023-10-29', 1, 6, 'Reservación 10', 'res10@email.com', NULL, 1),
(11, '2023-10-29', 4, 2, 'Reservación 11', 'res11@email.com', NULL, 1),
(12, '2024-01-02', 3, 5, 'Reservación 12', 'res12@email.com', NULL, 1),
(13, '2024-01-05', 1, 2, 'Reservación 13', 'res13@email.com', NULL, 1),
(14, '2024-01-08', 5, 1, 'Reservación 14', 'res14@email.com', NULL, 0),
(15, '2025-06-26', 3, 7, 'Pepe', 'b@mail.com', 'Sin observaciones', 0),
(16, '2025-06-26', 3, 5, 'Pepito', 'b@mail.com', 'Hay 1 niño', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `correos_enviados`
--
ALTER TABLE `correos_enviados`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `datos_usuarios`
--
ALTER TABLE `datos_usuarios`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `detalle_orden`
--
ALTER TABLE `detalle_orden`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `id_reserva` (`id_reserva`),
  ADD KEY `id_plato` (`id_plato`);

--
-- Indices de la tabla `facturas`
--
ALTER TABLE `facturas`
  ADD PRIMARY KEY (`id_factura`),
  ADD KEY `id_reserva` (`id_reserva`);

--
-- Indices de la tabla `platos`
--
ALTER TABLE `platos`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `correos_enviados`
--
ALTER TABLE `correos_enviados`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `datos_usuarios`
--
ALTER TABLE `datos_usuarios`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `detalle_orden`
--
ALTER TABLE `detalle_orden`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `facturas`
--
ALTER TABLE `facturas`
  MODIFY `id_factura` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `platos`
--
ALTER TABLE `platos`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `reservas`
--
ALTER TABLE `reservas`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `correos_enviados`
--
ALTER TABLE `correos_enviados`
  ADD CONSTRAINT `correos_enviados_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `datos_usuarios` (`ID`) ON DELETE CASCADE;

--
-- Filtros para la tabla `detalle_orden`
--
ALTER TABLE `detalle_orden`
  ADD CONSTRAINT `detalle_orden_ibfk_1` FOREIGN KEY (`id_reserva`) REFERENCES `reservas` (`ID`),
  ADD CONSTRAINT `detalle_orden_ibfk_2` FOREIGN KEY (`id_plato`) REFERENCES `platos` (`ID`);

--
-- Filtros para la tabla `facturas`
--
ALTER TABLE `facturas`
  ADD CONSTRAINT `facturas_ibfk_1` FOREIGN KEY (`id_reserva`) REFERENCES `reservas` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
