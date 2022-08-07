-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 25-07-2021 a las 22:40:44
-- Versión del servidor: 5.7.24
-- Versión de PHP: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `inventario`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inv_cargo_equipos`
--

CREATE TABLE `inv_cargo_equipos` (
  `id` int(11) NOT NULL,
  `id_usuario_fk` int(11) NOT NULL,
  `id_producto_fk` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `fecha_cargo` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `inv_cargo_equipos`
--

INSERT INTO `inv_cargo_equipos` (`id`, `id_usuario_fk`, `id_producto_fk`, `cantidad`, `fecha_cargo`) VALUES
(1, 1, 1, 15, '2021-04-02'),
(2, 1, 2, 100, '2021-04-06');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inv_clientes`
--

CREATE TABLE `inv_clientes` (
  `id` int(11) NOT NULL,
  `id_nacionalidad_fk` int(11) NOT NULL,
  `dni_nro` varchar(15) COLLATE utf8_spanish2_ci NOT NULL,
  `nombre` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `apellido` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `telefono` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `correo` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `direccion` varchar(80) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `inv_clientes`
--

INSERT INTO `inv_clientes` (`id`, `id_nacionalidad_fk`, `dni_nro`, `nombre`, `apellido`, `telefono`, `correo`, `direccion`) VALUES
(1, 1, '23445978', 'JUAN DIEGO', 'RINCON URDANETA', '(0414) - 6801859', 'jdrincon021@gmail.com', '                            AV LA LIMPIA'),
(2, 1, '24734747', 'LUIS ARTURO', 'RINCON URDANETA', '(0414) - 2222222', 'luis@gmail.com', '                            AV Las Delicias');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inv_equipos`
--

CREATE TABLE `inv_equipos` (
  `id` int(11) NOT NULL,
  `cod_equipo` varchar(8) COLLATE utf8_spanish2_ci NOT NULL,
  `denominacion` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `costo` float NOT NULL,
  `iva` float NOT NULL,
  `pvp` float NOT NULL,
  `existencia_minima` int(11) NOT NULL,
  `existencia_maxima` int(11) NOT NULL,
  `cantidad` float NOT NULL,
  `id_proveedor_fk` int(11) NOT NULL,
  `marcar` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `modelo` varchar(100) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `inv_equipos`
--

INSERT INTO `inv_equipos` (`id`, `cod_equipo`, `denominacion`, `costo`, `iva`, `pvp`, `existencia_minima`, `existencia_maxima`, `cantidad`, `id_proveedor_fk`, `marcar`, `modelo`) VALUES
(1, '00000001', 'MONITOR 17 PULGADAS', 12000, 0.5, 15000, 200, 400, 43, 1, 'SIRAGON', 'MECHANICAL 3'),
(2, '00000002', 'MONITOR 17 PULGADAS', 12000, 0.8, 25000, 200, 250, 43, 1, 'AORUS', 'GAMING 13');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inv_facturas`
--

CREATE TABLE `inv_facturas` (
  `id` int(11) NOT NULL,
  `cod_fact` varchar(8) COLLATE utf8_spanish2_ci NOT NULL,
  `id_cliente_fk` int(11) NOT NULL,
  `id_usuario_fk` int(11) NOT NULL,
  `fecha_emision` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `inv_facturas`
--

INSERT INTO `inv_facturas` (`id`, `cod_fact`, `id_cliente_fk`, `id_usuario_fk`, `fecha_emision`) VALUES
(1, '00000001', 1, 1, '2021-04-11'),
(2, '00000002', 1, 1, '2021-04-13');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inv_nacionalidades`
--

CREATE TABLE `inv_nacionalidades` (
  `id` int(11) NOT NULL,
  `cod_nac` varchar(5) COLLATE utf8_spanish2_ci NOT NULL,
  `tipo_doc` varchar(5) COLLATE utf8_spanish2_ci NOT NULL,
  `desc_nac` varchar(20) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `inv_nacionalidades`
--

INSERT INTO `inv_nacionalidades` (`id`, `cod_nac`, `tipo_doc`, `desc_nac`) VALUES
(1, '+058', 'V.-', 'VENEZUELA'),
(7, '+001', 'U.-', 'EE.UU');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inv_proveedores`
--

CREATE TABLE `inv_proveedores` (
  `id` int(11) NOT NULL,
  `id_nacionalidad_fk` int(11) NOT NULL,
  `rif` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `nombre` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `telefono` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `correo` varchar(80) COLLATE utf8_spanish2_ci NOT NULL,
  `direccion` varchar(80) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `inv_proveedores`
--

INSERT INTO `inv_proveedores` (`id`, `id_nacionalidad_fk`, `rif`, `nombre`, `telefono`, `correo`, `direccion`) VALUES
(1, 1, ' J - 000000000', 'HURTADO C.A', ' (0412) - 0000000', 'jdrincon021', 'Residenial Adriana PB-2'),
(2, 1, ' G - 000000000', 'CORPOZULIA C.A', ' (0414) - 0000000', 'corpozulia', 'AV BELLA VISTA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inv_rol`
--

CREATE TABLE `inv_rol` (
  `id` int(11) NOT NULL,
  `rol_desc` varchar(30) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `inv_rol`
--

INSERT INTO `inv_rol` (`id`, `rol_desc`) VALUES
(1, 'ADMINISTRADOR'),
(2, 'NIVEL_I');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inv_salida_equipos`
--

CREATE TABLE `inv_salida_equipos` (
  `id` int(11) NOT NULL,
  `cod_equipo` varchar(8) COLLATE utf8_spanish2_ci NOT NULL,
  `cantidad` float NOT NULL,
  `precio_total` float NOT NULL,
  `cod_factura` varchar(8) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `inv_salida_equipos`
--

INSERT INTO `inv_salida_equipos` (`id`, `cod_equipo`, `cantidad`, `precio_total`, `cod_factura`) VALUES
(1, '00000001', 2, 30000, '00000001'),
(2, '00000002', 2, 50000, '00000001');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inv_tickets`
--

CREATE TABLE `inv_tickets` (
  `id` int(11) NOT NULL,
  `cod_ticket` varchar(8) COLLATE utf8_spanish2_ci NOT NULL,
  `des_ticket` text COLLATE utf8_spanish2_ci NOT NULL,
  `id_cliente_FK` int(11) NOT NULL,
  `id_usuario_fk` int(11) NOT NULL,
  `fec_ini` date NOT NULL,
  `fec_fin` date DEFAULT NULL,
  `sts_ticket` int(11) NOT NULL,
  `costo_servicio` float NOT NULL,
  `observacion` text CHARACTER SET utf8 COLLATE utf8_spanish_ci,
  `id_tipo_servicio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `inv_tickets`
--

INSERT INTO `inv_tickets` (`id`, `cod_ticket`, `des_ticket`, `id_cliente_FK`, `id_usuario_fk`, `fec_ini`, `fec_fin`, `sts_ticket`, `costo_servicio`, `observacion`, `id_tipo_servicio`) VALUES
(1, '00000001', 'REVISION DE TELEFONO CELULAR.', 1, 1, '2021-04-25', '2021-04-26', 3, 5000, 'EL CLIENTE ESTA SATISFECHO.', 1),
(2, '00000002', 'REPARACION DE MONITOR 17 PULGADAS.', 2, 1, '2021-04-26', NULL, 1, 5000, NULL, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inv_ticket_equipos`
--

CREATE TABLE `inv_ticket_equipos` (
  `id` int(11) NOT NULL,
  `id_ticket_fk` int(11) NOT NULL,
  `des_equipo` text COLLATE utf8_spanish2_ci NOT NULL,
  `cantidad` int(11) NOT NULL,
  `est_equipo` int(11) NOT NULL,
  `fec_ing` date NOT NULL,
  `fec_egr` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `inv_ticket_equipos`
--

INSERT INTO `inv_ticket_equipos` (`id`, `id_ticket_fk`, `des_equipo`, `cantidad`, `est_equipo`, `fec_ing`, `fec_egr`) VALUES
(1, 1, 'SAMSUNG GALAXY S10 PLUS', 1, 1, '2021-04-25', NULL),
(2, 2, 'MONITOR LG FLATRON W1942S', 1, 2, '2021-04-26', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inv_ticket_equipos_estados`
--

CREATE TABLE `inv_ticket_equipos_estados` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(50) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `inv_ticket_equipos_estados`
--

INSERT INTO `inv_ticket_equipos_estados` (`id`, `descripcion`) VALUES
(1, 'BUENO'),
(2, 'DEFECTUOSO'),
(3, 'EN REPERACION');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inv_ticket_estatus`
--

CREATE TABLE `inv_ticket_estatus` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(60) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `inv_ticket_estatus`
--

INSERT INTO `inv_ticket_estatus` (`id`, `descripcion`) VALUES
(1, 'ABIERTO'),
(2, 'EN PROCESO'),
(3, 'RESUELTO'),
(4, 'CERRADO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inv_ticket_servicios`
--

CREATE TABLE `inv_ticket_servicios` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(60) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `inv_ticket_servicios`
--

INSERT INTO `inv_ticket_servicios` (`id`, `descripcion`) VALUES
(1, 'REVISION'),
(2, 'FORMATEO O REPARACION DE EQUIPO'),
(3, 'LIMPIEZA Y SERVICIO'),
(4, 'CAMBIO DE PIEZA A EQUIPO'),
(5, 'REVALING');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inv_usuarios`
--

CREATE TABLE `inv_usuarios` (
  `id` int(11) NOT NULL,
  `user_name` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `user_pass` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `id_rol_fk` int(11) NOT NULL,
  `user_mail` varchar(80) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `inv_usuarios`
--

INSERT INTO `inv_usuarios` (`id`, `user_name`, `user_pass`, `id_rol_fk`, `user_mail`) VALUES
(1, 'jdrincon', '1234567', 1, 'jd.rincon021@gmail.com'),
(3, 'soporte', '12345678', 2, 'luis@gmail.com');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `inv_cargo_equipos`
--
ALTER TABLE `inv_cargo_equipos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `equipo` (`id_producto_fk`),
  ADD KEY `id_usuario_fk` (`id_usuario_fk`);

--
-- Indices de la tabla `inv_clientes`
--
ALTER TABLE `inv_clientes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_nacionalidad_fk` (`id_nacionalidad_fk`);

--
-- Indices de la tabla `inv_equipos`
--
ALTER TABLE `inv_equipos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cod_equipo` (`cod_equipo`),
  ADD KEY `proveedor` (`id_proveedor_fk`);

--
-- Indices de la tabla `inv_facturas`
--
ALTER TABLE `inv_facturas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `inv_nacionalidades`
--
ALTER TABLE `inv_nacionalidades`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `inv_proveedores`
--
ALTER TABLE `inv_proveedores`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_nacionalidad_fk` (`id_nacionalidad_fk`);

--
-- Indices de la tabla `inv_rol`
--
ALTER TABLE `inv_rol`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `inv_salida_equipos`
--
ALTER TABLE `inv_salida_equipos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cod_equipo` (`cod_equipo`),
  ADD KEY `cod_factura` (`cod_factura`);

--
-- Indices de la tabla `inv_tickets`
--
ALTER TABLE `inv_tickets`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `inv_ticket_equipos`
--
ALTER TABLE `inv_ticket_equipos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `inv_ticket_equipos_estados`
--
ALTER TABLE `inv_ticket_equipos_estados`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `inv_ticket_estatus`
--
ALTER TABLE `inv_ticket_estatus`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `inv_ticket_servicios`
--
ALTER TABLE `inv_ticket_servicios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `inv_usuarios`
--
ALTER TABLE `inv_usuarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_rol_fk` (`id_rol_fk`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `inv_cargo_equipos`
--
ALTER TABLE `inv_cargo_equipos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `inv_clientes`
--
ALTER TABLE `inv_clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `inv_equipos`
--
ALTER TABLE `inv_equipos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `inv_facturas`
--
ALTER TABLE `inv_facturas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `inv_nacionalidades`
--
ALTER TABLE `inv_nacionalidades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `inv_proveedores`
--
ALTER TABLE `inv_proveedores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `inv_rol`
--
ALTER TABLE `inv_rol`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `inv_salida_equipos`
--
ALTER TABLE `inv_salida_equipos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `inv_tickets`
--
ALTER TABLE `inv_tickets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `inv_ticket_equipos`
--
ALTER TABLE `inv_ticket_equipos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `inv_ticket_equipos_estados`
--
ALTER TABLE `inv_ticket_equipos_estados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `inv_ticket_estatus`
--
ALTER TABLE `inv_ticket_estatus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `inv_ticket_servicios`
--
ALTER TABLE `inv_ticket_servicios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `inv_usuarios`
--
ALTER TABLE `inv_usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `inv_cargo_equipos`
--
ALTER TABLE `inv_cargo_equipos`
  ADD CONSTRAINT `equipo` FOREIGN KEY (`id_producto_fk`) REFERENCES `inv_equipos` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `inv_cargo_equipos_ibfk_1` FOREIGN KEY (`id_usuario_fk`) REFERENCES `inv_usuarios` (`id`);

--
-- Filtros para la tabla `inv_clientes`
--
ALTER TABLE `inv_clientes`
  ADD CONSTRAINT `inv_clientes_ibfk_1` FOREIGN KEY (`id_nacionalidad_fk`) REFERENCES `inv_nacionalidades` (`id`);

--
-- Filtros para la tabla `inv_equipos`
--
ALTER TABLE `inv_equipos`
  ADD CONSTRAINT `proveedor` FOREIGN KEY (`id_proveedor_fk`) REFERENCES `inv_proveedores` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `inv_usuarios`
--
ALTER TABLE `inv_usuarios`
  ADD CONSTRAINT `roles` FOREIGN KEY (`id_rol_fk`) REFERENCES `inv_rol` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
