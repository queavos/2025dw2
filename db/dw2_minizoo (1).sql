-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 05-06-2025 a las 21:19:35
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
-- Base de datos: `dw2_minizoo`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `especies`
--

CREATE TABLE `especies` (
  `id` int(11) NOT NULL,
  `nombre` varchar(191) NOT NULL,
  `nombre_alternativo` varchar(191) DEFAULT NULL,
  `nombre_cientifico` varchar(191) DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `orden` varchar(191) DEFAULT NULL,
  `familia` varchar(191) DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `ecologia` text DEFAULT NULL,
  `distribucion` text DEFAULT NULL,
  `link_url` varchar(191) DEFAULT NULL,
  `link_qr` varchar(191) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `especies`
--

INSERT INTO `especies` (`id`, `nombre`, `nombre_alternativo`, `nombre_cientifico`, `cantidad`, `orden`, `familia`, `descripcion`, `ecologia`, `distribucion`, `link_url`, `link_qr`) VALUES
(1, 'tigre ', 'el de zucaritas', 'tigris dormidos', 1, 'felino', 'tigre', 'Tigre dormilon ', 'bosque de india', 'bosques', 'qweqeq', 'qweqwe'),
(2, 'Puma', 'León de Montaña, León Americano', 'Puma con color', 1, 'Carnivoro', 'Felidae', 'Felino grande carnivoro', 'Bosques, montañas', 'Toda america', '', ''),
(3, 'Tortuga terrestre', 'karumbe, tortuga caminadora', 'testunidae ', 3, 'testudine', 'testudine', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recintos`
--

CREATE TABLE `recintos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(191) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `numero` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `recintos`
--

INSERT INTO `recintos` (`id`, `nombre`, `descripcion`, `numero`) VALUES
(1, 'Jaula', 'Jaula de Pumas', 1),
(2, 'Jaula del Tigre', 'Jaula del Tigre  dormido', 13),
(3, 'Jaula de Blue', 'la jaula del pajarito azul', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `nombre` varchar(191) NOT NULL,
  `descripcion` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `nombre`, `descripcion`) VALUES
(2, 'Administrador', 'el que administra'),
(3, 'Usuario', 'el que usa'),
(4, 'miron', ' mira'),
(10, 'Pepe', 'dfgdfgdfg'),
(11, 'fdgdfgfdg', 'fdgdhdfghdfgh');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `email` varchar(191) NOT NULL,
  `password` varchar(191) NOT NULL,
  `nombre` varchar(191) NOT NULL,
  `apellido` varchar(191) NOT NULL,
  `activo` tinyint(1) NOT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `email`, `password`, `nombre`, `apellido`, `activo`, `role_id`) VALUES
(1, 'osvaldo.micniuk@unae.edu.py', '$2y$10$YJwQTcDVxTJ4DFq7M2Re4ueiGMa/eD4FaScwOn2gUPlc4DsfQcHdC', 'Osvaldo', 'Micniuk', 1, 2),
(2, 'ossva01@hotmail.com', '$2y$10$fqRw0XdFh4FCdblc7T.BYeLVAHr8Iu3qrqD5qNTwL00l7PeicAwRW', 'Otro', 'otro', 1, 4);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `especies`
--
ALTER TABLE `especies`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `recintos`
--
ALTER TABLE `recintos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email_idx` (`email`),
  ADD KEY `cf_roles` (`role_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `especies`
--
ALTER TABLE `especies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `recintos`
--
ALTER TABLE `recintos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `cf_roles` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
