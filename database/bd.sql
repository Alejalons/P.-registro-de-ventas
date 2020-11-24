-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 24-11-2020 a las 14:05:48
-- Versión del servidor: 5.7.31
-- Versión de PHP: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bdbed`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2020_11_16_000000_create_types_table', 1),
(2, '2020_11_16_000001_create_users_table', 1),
(3, '2020_11_16_000002_create_roles_table', 1),
(4, '2020_11_16_000003_create_sets_table', 1),
(5, '2020_11_16_000004_create_models_table', 1),
(6, '2020_11_16_000005_create_sales_table', 1),
(7, '2020_11_16_000006_create_role_user_table', 1),
(8, '2020_11_16_000007_create_products_table', 1),
(9, '2020_11_16_000008_create_sales_Products_table', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `models`
--

DROP TABLE IF EXISTS `models`;
CREATE TABLE IF NOT EXISTS `models` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `types_id` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_models_types1_idx` (`types_id`)
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `models`
--

INSERT INTO `models` (`id`, `name`, `types_id`) VALUES
(1, 'CIC Ortopedic 2pl', 1),
(2, 'CIC Ortopedic advance 2pl', 1),
(3, 'CIC Balance 2pl', 1),
(4, 'CIC Premium 2pl', 1),
(5, 'CIC Super Premium 2pl', 1),
(6, 'Flex Therapedic 2pl', 1),
(7, 'Flex dual sensity 2pl ', 1),
(8, 'Flex innova 2pl', 1),
(9, 'Flex moddula 2pl', 1),
(10, 'Flex terracobre 2 pl', 1),
(11, 'Flex Maximo cobre 2pl', 1),
(12, 'Flex maximo carbono 2pl', 1),
(13, 'Rosen Ergo t 2pl', 1),
(14, 'Rosen New Style 2 2pl', 1),
(15, 'Rosen New style 4 2pl', 1),
(16, 'Rosen New style 6 2pl', 1),
(17, 'Rosen Neo 2pl', 1),
(18, 'Rosen Nabis 2pl', 1),
(19, 'Rosen Art 2 2pl', 1),
(20, 'Rosen Art 4 2pl', 1),
(21, 'Rosen Tempo 2 pl', 1),
(22, 'Rosen Driven 2pl', 1),
(23, 'Rosen Nest 2 pl', 1),
(24, 'CIC Ortopedic Advance King', 2),
(25, 'CIC Super Premium King', 2),
(26, 'Flex Therapedic King ', 2),
(27, 'Flex Moddula king ', 2),
(28, 'Flex Dual Sensity King ', 2),
(29, 'Flex Terracobre King ', 2),
(30, 'Flex Maximo Cobre king', 2),
(31, 'Flex Maximo Carbono King ', 2),
(32, 'Rosen Style 2 king', 2),
(33, 'Rosen Style 4 king', 2),
(34, 'Rosen Style 6 king', 2),
(35, 'Rosen Nabis king', 2),
(36, 'Rosen Neo king', 2),
(37, 'Rosen Art 2 King ', 2),
(38, 'Rosen Art 4 King', 2),
(39, 'Rosen Tempo king', 2),
(40, 'Rosen Driven King', 2),
(41, 'Rosen Nest King ', 2),
(42, 'Lorraine Black 2 plazas', 3),
(43, 'Lorraine Café 2 plazas', 3),
(44, 'Colonia 2 plazas', 3),
(45, 'Capitoné 2 plazas', 3),
(46, 'Lorraine Black king', 3),
(47, 'Lorraine Café king', 3),
(48, 'Colonia King', 3),
(49, 'Capitoné King', 3),
(50, 'Bases 2 mt', 4),
(51, 'Bases 1,90 mt', 4),
(52, 'Bases King', 4),
(53, 'Bases 1,90 mt', 5),
(54, 'Bases 2 mt', 5),
(55, 'Bases King', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `price` int(11) DEFAULT NULL,
  `models_id` int(10) UNSIGNED NOT NULL,
  `set_id` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_products_sets1_idx` (`set_id`) USING BTREE,
  KEY `fk_products_models1_idx` (`models_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=242 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `products`
--

INSERT INTO `products` (`id`, `price`, `models_id`, `set_id`) VALUES
(1, 270000, 1, 1),
(2, 330000, 1, 2),
(3, 340000, 1, 3),
(4, 370000, 1, 4),
(5, 385000, 1, 5),
(6, 300000, 2, 1),
(7, 360000, 2, 2),
(8, 370000, 2, 3),
(9, 400000, 2, 4),
(10, 415000, 2, 5),
(11, 340000, 3, 1),
(12, 400000, 3, 2),
(13, 410000, 3, 3),
(14, 440000, 3, 4),
(15, 455000, 3, 5),
(16, 380000, 4, 1),
(17, 440000, 4, 2),
(18, 450000, 4, 3),
(19, 480000, 4, 4),
(20, 495000, 4, 5),
(21, 420000, 5, 1),
(22, 480000, 5, 2),
(23, 490000, 5, 3),
(24, 520000, 5, 4),
(25, 535000, 5, 5),
(26, NULL, 6, 1),
(27, NULL, 6, 2),
(28, NULL, 6, 3),
(29, NULL, 6, 4),
(30, NULL, 6, 5),
(31, NULL, 7, 1),
(32, NULL, 7, 2),
(33, NULL, 7, 3),
(34, NULL, 7, 4),
(35, NULL, 7, 5),
(36, NULL, 8, 1),
(37, NULL, 8, 2),
(38, NULL, 8, 3),
(39, NULL, 8, 4),
(40, NULL, 8, 5),
(41, NULL, 9, 1),
(42, NULL, 9, 2),
(43, NULL, 9, 3),
(44, NULL, 9, 4),
(45, NULL, 9, 5),
(46, NULL, 10, 1),
(47, NULL, 10, 2),
(48, NULL, 10, 3),
(49, NULL, 10, 4),
(50, NULL, 10, 5),
(51, 380000, 11, 1),
(52, 340000, 11, 2),
(53, 350000, 11, 3),
(54, 480000, 11, 4),
(55, 495000, 11, 5),
(56, NULL, 12, 1),
(57, NULL, 12, 2),
(58, NULL, 12, 3),
(59, NULL, 12, 4),
(60, NULL, 12, 5),
(61, 240000, 13, 1),
(62, 300000, 13, 2),
(63, 310000, 13, 3),
(64, 340000, 13, 4),
(65, 355000, 13, 5),
(66, 260000, 14, 1),
(67, 320000, 14, 2),
(68, 330000, 14, 3),
(69, 360000, 14, 4),
(70, 375000, 14, 5),
(71, 290000, 15, 1),
(72, 350000, 15, 2),
(73, 360000, 15, 3),
(74, 390000, 15, 4),
(75, 405000, 15, 5),
(76, 330000, 16, 1),
(77, 400000, 16, 2),
(78, 410000, 16, 3),
(79, 440000, 16, 4),
(80, 455000, 16, 5),
(81, 420000, 17, 1),
(82, 480000, 17, 2),
(83, 490000, 17, 3),
(84, 520000, 17, 4),
(85, 535000, 17, 5),
(86, 350000, 18, 1),
(87, 410000, 18, 2),
(88, 420000, 18, 3),
(89, 450000, 18, 4),
(90, 465000, 18, 5),
(91, 350000, 19, 1),
(92, 410000, 19, 2),
(93, 420000, 19, 3),
(94, 450000, 19, 4),
(95, 465000, 19, 5),
(96, 400000, 20, 1),
(97, 460000, 20, 2),
(98, 470000, 20, 3),
(99, 500000, 20, 4),
(100, 515000, 20, 5),
(101, 380000, 21, 1),
(102, 450000, 21, 2),
(103, 460000, 21, 3),
(104, 490000, 21, 4),
(105, 505000, 21, 5),
(106, 430000, 22, 1),
(107, 390000, 22, 2),
(108, 400000, 22, 3),
(109, 530000, 22, 4),
(110, 545000, 22, 5),
(111, 500000, 23, 1),
(112, 560000, 23, 2),
(113, 570000, 23, 3),
(114, 600000, 23, 4),
(115, 615000, 23, 5),
(116, 350000, 24, 1),
(117, 410000, 24, 2),
(118, 420000, 24, 3),
(119, 450000, 24, 4),
(120, 465000, 24, 5),
(121, NULL, 25, 1),
(122, NULL, 25, 2),
(123, NULL, 25, 3),
(124, NULL, 25, 4),
(125, NULL, 25, 5),
(126, NULL, 26, 1),
(127, NULL, 26, 2),
(128, NULL, 26, 3),
(129, NULL, 26, 4),
(130, NULL, 26, 5),
(131, NULL, 27, 1),
(132, NULL, 27, 2),
(133, NULL, 27, 3),
(134, NULL, 27, 4),
(135, NULL, 27, 5),
(136, NULL, 28, 1),
(137, NULL, 28, 2),
(138, NULL, 28, 3),
(139, NULL, 28, 4),
(140, NULL, 28, 5),
(141, NULL, 29, 1),
(142, NULL, 29, 2),
(143, NULL, 29, 3),
(144, NULL, 29, 4),
(145, NULL, 29, 5),
(146, 420000, 30, 1),
(147, 480000, 30, 2),
(148, 490000, 30, 3),
(149, 520000, 30, 4),
(150, 535000, 30, 5),
(151, NULL, 31, 1),
(152, NULL, 31, 2),
(153, NULL, 31, 3),
(154, NULL, 31, 4),
(155, NULL, 31, 5),
(156, 320000, 32, 1),
(157, 380000, 32, 2),
(158, 390000, 32, 3),
(159, 420000, 32, 4),
(160, 435000, 32, 5),
(161, 340000, 33, 1),
(162, 400000, 33, 2),
(163, 410000, 33, 3),
(164, 440000, 33, 4),
(165, 455000, 33, 5),
(166, 410000, 34, 1),
(167, 480000, 34, 2),
(168, 490000, 34, 3),
(169, 520000, 34, 4),
(170, 535000, 34, 5),
(171, 410000, 35, 1),
(172, 470000, 35, 2),
(173, 480000, 35, 3),
(174, 510000, 35, 4),
(175, 525000, 35, 5),
(176, 450000, 36, 1),
(177, 510000, 36, 2),
(178, 520000, 36, 3),
(179, 550000, 36, 4),
(180, 565000, 36, 5),
(181, 410000, 37, 1),
(182, 470000, 37, 2),
(183, 480000, 37, 3),
(184, 510000, 37, 4),
(185, 525000, 37, 5),
(186, 450000, 38, 1),
(187, 510000, 38, 2),
(188, 520000, 38, 3),
(189, 550000, 38, 4),
(190, 565000, 38, 5),
(191, 430000, 39, 1),
(192, 500000, 39, 2),
(193, 510000, 39, 3),
(194, 540000, 39, 4),
(195, 555000, 39, 5),
(196, 480000, 40, 1),
(197, 540000, 40, 2),
(198, 550000, 40, 3),
(199, 580000, 40, 4),
(200, 595000, 40, 5),
(201, 520000, 41, 1),
(202, 580000, 41, 2),
(203, 590000, 41, 3),
(204, 620000, 41, 4),
(205, 635000, 41, 5),
(206, 45000, 42, 6),
(207, 75000, 42, 7),
(208, 140000, 42, 8),
(209, 45000, 43, 6),
(210, 75000, 43, 7),
(211, 140000, 43, 8),
(212, 50000, 44, 6),
(213, 85000, 44, 7),
(214, 150000, 44, 8),
(215, 50000, 45, 6),
(216, 170000, 45, 7),
(217, 250000, 45, 8),
(218, 45000, 46, 6),
(219, 85000, 46, 7),
(220, 150000, 46, 8),
(221, 45000, 47, 6),
(222, 85000, 47, 7),
(223, 150000, 47, 8),
(224, 50000, 48, 6),
(225, 95000, 48, 7),
(226, 160000, 48, 8),
(227, 50000, 49, 6),
(228, 190000, 49, 7),
(229, 280000, 49, 8),
(230, 110000, 50, 9),
(231, 100000, 51, 9),
(232, 140000, 52, 9),
(233, 230000, 53, 10),
(234, 230000, 53, 11),
(235, 240000, 53, 12),
(236, 240000, 54, 6),
(237, 240000, 54, 7),
(238, 250000, 54, 8),
(239, 280000, 55, 6),
(240, 280000, 55, 7),
(241, 290000, 55, 8);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `product_sale`
--

DROP TABLE IF EXISTS `product_sale`;
CREATE TABLE IF NOT EXISTS `product_sale` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sale_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`,`sale_id`,`product_id`),
  KEY `sale_id` (`sale_id`),
  KEY `product_id` (`product_id`)
) ENGINE=MyISAM AUTO_INCREMENT=62 DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Administrador'),
(2, 'ventas', 'Ventas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `role_user`
--

DROP TABLE IF EXISTS `role_user`;
CREATE TABLE IF NOT EXISTS `role_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_role_user_user1_idx` (`user_id`),
  KEY `fk_role_user_roles1_idx` (`role_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sales`
--

DROP TABLE IF EXISTS `sales`;
CREATE TABLE IF NOT EXISTS `sales` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nameClient` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contactSecond` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rut` varchar(14) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mail` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `paymentMethod` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `dispatchPrice` int(11) NOT NULL,
  `users_id` int(10) UNSIGNED NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_sales_users1_idx` (`users_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sets`
--

DROP TABLE IF EXISTS `sets`;
CREATE TABLE IF NOT EXISTS `sets` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `sets`
--

INSERT INTO `sets` (`id`, `name`) VALUES
(1, 'Cama (Colchón Mas bases)'),
(2, 'Cama más Respaldo'),
(3, 'Cama mas veladores'),
(4, 'Conjunto Completo (lorraine/lorraine black)'),
(5, 'Conjunto Colonia'),
(6, 'Veladores (C/U)'),
(7, 'Respaldo'),
(8, 'Conjunto muebles'),
(9, 'Precio'),
(10, 'Lorraine Café'),
(11, 'Lorraine Black'),
(12, 'Colonia');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `types`
--

DROP TABLE IF EXISTS `types`;
CREATE TABLE IF NOT EXISTS `types` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nameType` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `types`
--

INSERT INTO `types` (`id`, `nameType`) VALUES
(1, 'DOS PLAZAS'),
(2, 'KING'),
(3, 'MUEBLES'),
(4, 'BASES'),
(5, 'CONJUNTO MUEBLES MÁS BASES');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email_UNIQUE` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `models`
--
ALTER TABLE `models`
  ADD CONSTRAINT `fk_models_types1_idx` FOREIGN KEY (`types_id`) REFERENCES `types` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `fk_products_models1_idx` FOREIGN KEY (`models_id`) REFERENCES `models` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_products_sets1_idx` FOREIGN KEY (`set_id`) REFERENCES `sets` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `role_user`
--
ALTER TABLE `role_user`
  ADD CONSTRAINT `fk_role_user_roles1_idx` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_role_user_user1_idx` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `fk_sales_users1_idx` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
