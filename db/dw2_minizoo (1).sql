SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `especies` (`id`, `nombre`, `nombre_alternativo`, `nombre_cientifico`, `cantidad`, `orden`, `familia`, `descripcion`, `ecologia`, `distribucion`, `link_url`, `link_qr`) VALUES
(1, 'tigre ', 'el de zucaritas', 'tigris dormidos', 1, 'felino', 'tigre', 'Tigre dormilon ', 'bosque de india', 'bosques', 'qweqeq', '../especies/qr/1.png'),
(2, 'Puma', 'León de Montaña, León Americano', 'Puma con color', 1, 'Carnivoro', 'Felidae', 'Felino grande carnivoro', 'Bosques, montañas', 'Toda america', '', '../especies/qr/2.png'),
(3, 'Tortuga terrestre', 'karumbe, tortuga caminadora', 'testunidae ', 3, 'testudine', 'testudine', '', '', '', '', '../especies/qr/3.png');

CREATE TABLE `espe_imagenes` (
  `id` int(11) NOT NULL,
  `espe_id` int(11) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `archivo` varchar(191) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `espe_imagenes` (`id`, `espe_id`, `descripcion`, `archivo`) VALUES
(10, 2, '', '2_1749930654.1611.jpg'),
(12, 1, '', '1_1749930949.4348.jpg'),
(13, 1, '', '1_1749930984.0201.jpg'),
(14, 2, '', '2_1749930999.428.jpg'),
(15, 3, '', '3_1749931014.999.jpg'),
(17, 3, '', '3_1749931055.5124.jpg');

CREATE TABLE `recintos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(191) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `numero` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `recintos` (`id`, `nombre`, `descripcion`, `numero`) VALUES
(1, 'Jaula', 'Jaula de Pumas', 1),
(2, 'Jaula del Tigre', 'Jaula del Tigre  dormido', 13),
(3, 'Jaula de Blue', 'la jaula del pajarito azul', 2);

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `nombre` varchar(191) NOT NULL,
  `descripcion` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `roles` (`id`, `nombre`, `descripcion`) VALUES
(2, 'Administrador', 'el que administra'),
(3, 'Usuario', 'el que usa'),
(4, 'miron', ' mira'),
(10, 'Pepe', 'dfgdfgdfg'),
(11, 'fdgdfgfdg', 'fdgdhdfghdfgh');

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `email` varchar(191) NOT NULL,
  `password` varchar(191) NOT NULL,
  `nombre` varchar(191) NOT NULL,
  `apellido` varchar(191) NOT NULL,
  `activo` tinyint(1) NOT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `usuarios` (`id`, `email`, `password`, `nombre`, `apellido`, `activo`, `role_id`) VALUES
(4, 'carlos.rios@as.as', 'd32fc1f3b5a8b32e713f93f28f3c135d19be4000', 'carlos', 'rops sadsad', 1, 4),
(5, 'osvaldo.micniuk@unae.edu.py', '238fd768a283283cefbb458bb688fdf7b884ed0b', 'Osvaldo', 'Micniuk', 1, 2),
(7, 'osvaldo.micniukassa@unae.edu.py', 'd609fa742c631654f8b960206a4a582d72e52fb5', 'Osvaldo', 'Micniuk', 1, 3);


ALTER TABLE `espe_imagenes`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email_idx` (`email`),
  ADD KEY `cf_roles` (`role_id`);


ALTER TABLE `espe_imagenes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;


ALTER TABLE `usuarios`
  ADD CONSTRAINT `cf_roles` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);
SET FOREIGN_KEY_CHECKS=1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
