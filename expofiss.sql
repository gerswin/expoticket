-- phpMyAdmin SQL Dump
-- version 4.1.8
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 17-10-2014 a las 12:58:10
-- Versión del servidor: 5.5.38-0ubuntu0.14.04.1
-- Versión de PHP: 5.5.9-1ubuntu4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `expofiss`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE IF NOT EXISTS `clientes` (
  `cli_id` int(11) NOT NULL AUTO_INCREMENT,
  `cli_rif` varchar(15) NOT NULL,
  `cli_razon` varchar(60) NOT NULL,
  `cli_contacto` varchar(60) NOT NULL,
  `cli_telefono` varchar(20) NOT NULL,
  `cli_correo` varchar(40) NOT NULL,
  PRIMARY KEY (`cli_rif`),
  UNIQUE KEY `cli_id` (`cli_id`),
  UNIQUE KEY `cli_id_2` (`cli_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `histo_pre`
--

CREATE TABLE IF NOT EXISTS `histo_pre` (
  `his_id` int(11) NOT NULL,
  `pre_id` int(11) NOT NULL,
  `histo_fec` datetime NOT NULL,
  `histo_est` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `preventaweb`
--

CREATE TABLE IF NOT EXISTS `preventaweb` (
  `pre_id` int(11) NOT NULL AUTO_INCREMENT,
  `pre_emp` text NOT NULL,
  `pre_con` text NOT NULL,
  `pre_tel` varchar(12) NOT NULL,
  `pre_ema` text NOT NULL,
  `pre_tip` int(11) NOT NULL,
  `pre_ruta` int(11) NOT NULL COMMENT '1 - Google . 2 - Facebook , 3 Directo , 4 Sistema',
  `pre_rutaid` int(11) NOT NULL,
  `pre_est` int(11) NOT NULL,
  `pre_int` text NOT NULL,
  PRIMARY KEY (`pre_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `stands`
--

CREATE TABLE IF NOT EXISTS `stands` (
  `std_id` int(11) NOT NULL AUTO_INCREMENT,
  `std_tipo` tinyint(4) NOT NULL COMMENT '1-Venezuela, 2-Colombia,3-Feria Comida, 4-Patio3, 5-Patio4, 6-Patio5',
  `std_nro` int(4) NOT NULL,
  `idCliente` varchar(40) CHARACTER SET latin1 NOT NULL DEFAULT '333',
  `std_estatus` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1-Disponible, 2-Reservado, 3-Comprado',
  `std_mts` varchar(5) COLLATE latin1_spanish_ci NOT NULL COMMENT '1- 5.7mts, 2- 6mts, 3-8mts, 4- 8.5mts, 5- 9mts, 6- 27mts.',
  PRIMARY KEY (`std_tipo`,`std_nro`),
  UNIQUE KEY `std_id` (`std_id`),
  UNIQUE KEY `std_id_2` (`std_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci AUTO_INCREMENT=251 ;

--
-- Volcado de datos para la tabla `stands`
--

INSERT INTO `stands` (`std_id`, `std_tipo`, `std_nro`, `idCliente`, `std_estatus`, `std_mts`) VALUES
(1, 1, 1, '0', 1, '5.7'),
(2, 1, 2, '0', 1, '6'),
(3, 1, 3, '0', 1, '6'),
(4, 1, 4, '0', 1, '5.7'),
(5, 1, 5, '0', 1, '9'),
(6, 1, 6, '0', 1, '9'),
(7, 1, 7, '0', 1, '25'),
(8, 1, 8, '0', 1, '9'),
(9, 1, 9, '0', 1, '9'),
(10, 1, 10, '0', 1, '27'),
(11, 1, 11, '0', 1, '9'),
(12, 1, 12, '0', 1, '9'),
(13, 1, 13, '0', 1, '9'),
(14, 1, 14, '0', 1, '8.5'),
(15, 1, 15, '0', 1, '5.7'),
(16, 1, 16, '0', 1, '6'),
(17, 1, 17, '0', 1, '6'),
(18, 1, 18, '0', 1, '5.7'),
(19, 1, 19, '0', 1, '5.7'),
(20, 1, 20, '0', 1, '6'),
(21, 1, 21, '0', 1, '6'),
(22, 1, 22, '0', 1, '6'),
(23, 1, 23, '0', 1, '6'),
(24, 1, 24, '0', 1, '5.7'),
(25, 1, 25, '0', 1, '11.5'),
(26, 1, 26, '0', 1, '9'),
(27, 1, 27, '0', 1, '9'),
(28, 1, 28, '0', 1, '9'),
(29, 1, 29, '0', 1, '9'),
(30, 1, 30, '0', 1, '25'),
(31, 1, 31, '0', 1, '9'),
(32, 1, 32, '0', 1, '9'),
(33, 1, 33, '0', 1, '27'),
(34, 1, 34, '0', 1, '9'),
(35, 1, 35, '0', 1, '9'),
(36, 1, 36, '0', 1, '9'),
(37, 1, 37, '0', 1, '9'),
(38, 1, 38, '0', 1, '9'),
(39, 1, 39, '0', 1, '8.5'),
(40, 1, 40, '0', 1, '5.7'),
(41, 1, 41, '0', 1, '6'),
(42, 1, 42, '0', 1, '6'),
(43, 1, 43, '0', 1, '6'),
(44, 1, 44, '0', 1, '6'),
(45, 1, 45, '0', 1, '5.7'),
(46, 1, 46, '0', 1, '5.7'),
(47, 1, 47, '0', 1, '6'),
(48, 1, 48, '0', 1, '6'),
(49, 1, 49, '0', 1, '5.7'),
(50, 1, 50, '0', 1, '8.5'),
(51, 1, 51, '0', 1, '9'),
(52, 1, 52, '0', 1, '9'),
(53, 1, 53, '0', 1, '9'),
(54, 1, 54, '0', 1, '27'),
(55, 1, 55, '0', 1, '9'),
(56, 1, 56, '0', 1, '9'),
(57, 1, 57, '0', 1, '27'),
(58, 1, 58, '0', 1, '9'),
(59, 1, 59, '0', 1, '9'),
(60, 1, 60, '0', 1, '9'),
(61, 1, 61, '0', 1, '9'),
(62, 1, 62, '0', 1, '9'),
(63, 1, 63, '0', 1, '8.5'),
(64, 1, 64, '0', 1, '5.7'),
(65, 1, 65, '0', 1, '6'),
(66, 1, 66, '0', 1, '6'),
(67, 1, 67, '0', 1, '5.7'),
(68, 1, 68, '0', 1, '5.7'),
(69, 1, 69, '0', 1, '6'),
(70, 1, 70, '0', 1, '6'),
(71, 1, 71, '0', 1, '5.7'),
(72, 1, 72, '0', 1, '8.5'),
(73, 1, 73, '0', 1, '9'),
(74, 1, 74, '0', 1, '9'),
(75, 1, 75, '0', 1, '9'),
(76, 1, 76, '0', 1, '9'),
(77, 1, 77, '0', 1, '9'),
(78, 1, 78, '0', 1, '27'),
(79, 1, 79, '0', 1, '9'),
(80, 1, 80, '0', 1, '9'),
(81, 1, 81, '0', 1, '27'),
(82, 1, 82, '0', 1, '9'),
(83, 1, 83, '0', 1, '9'),
(84, 1, 84, '0', 1, '9'),
(85, 1, 85, '0', 1, '8.5'),
(86, 1, 86, '0', 1, '5.7'),
(87, 1, 87, '0', 1, '6'),
(88, 1, 88, '0', 1, '6'),
(89, 1, 89, '0', 1, '5.7'),
(90, 1, 90, '0', 1, '5.7'),
(91, 1, 91, '0', 1, '6'),
(92, 1, 92, '0', 1, '6'),
(93, 1, 93, '0', 1, '6'),
(94, 1, 94, '0', 1, '6'),
(95, 1, 95, '0', 1, '5.7'),
(96, 1, 96, '0', 1, '8.5'),
(97, 1, 97, '0', 1, '9'),
(98, 1, 98, '0', 1, '9'),
(99, 1, 99, '0', 1, '9'),
(100, 1, 100, '0', 1, '9'),
(101, 1, 101, '0', 1, '9'),
(102, 1, 102, '0', 1, '27'),
(103, 1, 103, '0', 1, '9'),
(104, 1, 104, '0', 1, '9'),
(105, 1, 105, '0', 1, '27'),
(106, 1, 106, '0', 1, '9'),
(107, 1, 107, '0', 1, '9'),
(108, 1, 108, '0', 1, '35'),
(109, 1, 109, '0', 1, '5.7'),
(110, 1, 110, '0', 1, '6'),
(111, 1, 111, '0', 1, '6'),
(112, 1, 112, '0', 1, '6'),
(113, 1, 113, '0', 1, '6'),
(114, 1, 114, '0', 1, '5.7'),
(115, 1, 115, '0', 1, '5.7'),
(116, 1, 116, '0', 1, '6'),
(117, 1, 117, '0', 1, '6'),
(118, 1, 118, '0', 1, '5.7'),
(119, 1, 119, '0', 1, '8.5'),
(120, 1, 120, '0', 1, '9'),
(121, 1, 121, '0', 1, '9'),
(122, 1, 122, '0', 1, '9'),
(123, 1, 123, '0', 1, '27'),
(124, 1, 124, '0', 1, '9'),
(125, 1, 125, '0', 1, '9'),
(126, 1, 126, '0', 1, '27'),
(127, 1, 127, '0', 1, '9'),
(128, 1, 128, '0', 1, '9'),
(129, 1, 129, '0', 1, '5.7'),
(130, 1, 130, '0', 1, '6'),
(131, 1, 131, '0', 1, '6'),
(132, 1, 132, '0', 1, '5.7'),
(133, 2, 1, '0', 1, '5.7'),
(134, 2, 2, '0', 1, '6'),
(135, 2, 3, '0', 1, '6'),
(136, 2, 4, '0', 1, '5.7'),
(137, 2, 5, '0', 1, '9'),
(138, 2, 6, '0', 1, '9'),
(139, 2, 7, '0', 1, '27'),
(140, 2, 8, '0', 1, '9'),
(141, 2, 9, '0', 1, '9'),
(142, 2, 10, '0', 1, '27'),
(143, 2, 11, '0', 1, '9'),
(144, 2, 12, '0', 1, '9'),
(145, 2, 13, '0', 1, '9'),
(146, 2, 14, '0', 1, '8.5'),
(147, 2, 15, '0', 1, '5.7'),
(148, 2, 16, '0', 1, '6'),
(149, 2, 17, '0', 1, '6'),
(150, 2, 18, '0', 1, '5.7'),
(151, 2, 19, '0', 1, '8'),
(152, 2, 20, '0', 1, '9'),
(153, 2, 21, '0', 1, '9'),
(154, 2, 22, '0', 1, '9'),
(155, 2, 23, '0', 1, '9'),
(156, 2, 24, '0', 1, '27'),
(157, 2, 25, '0', 1, '9'),
(158, 2, 26, '0', 1, '5.7'),
(159, 2, 27, '0', 1, '6'),
(160, 2, 28, '0', 1, '6'),
(161, 2, 29, '0', 1, '6'),
(162, 2, 30, '0', 1, '6'),
(163, 2, 31, '0', 1, '5.7'),
(164, 2, 32, '0', 1, '5.7'),
(165, 2, 33, '0', 1, '6'),
(166, 2, 34, '0', 1, '6'),
(167, 2, 35, '0', 1, '6'),
(168, 2, 36, '0', 1, '6'),
(169, 2, 37, '0', 1, '5.7'),
(170, 2, 38, '0', 1, '9'),
(171, 2, 39, '0', 1, '9'),
(172, 2, 40, '0', 1, '9'),
(173, 2, 41, '0', 1, '9'),
(174, 2, 42, '0', 1, '8.5'),
(175, 2, 43, '0', 1, '5.7'),
(176, 2, 44, '0', 1, '6'),
(177, 2, 45, '0', 1, '6'),
(178, 2, 46, '0', 1, '5.7'),
(179, 2, 47, '0', 1, '8.5'),
(180, 2, 48, '0', 1, '9'),
(181, 2, 49, '0', 1, '9'),
(182, 2, 50, '0', 1, '9'),
(183, 2, 51, '0', 1, '27'),
(184, 2, 52, '0', 1, '9'),
(185, 2, 53, '0', 1, '9'),
(186, 2, 54, '0', 1, '27'),
(187, 2, 55, '0', 1, '9'),
(188, 2, 56, '0', 1, '9'),
(189, 2, 57, '0', 1, '9'),
(190, 2, 58, '0', 1, '9'),
(191, 2, 59, '0', 1, '9'),
(192, 2, 60, '0', 1, '8.5'),
(193, 2, 61, '0', 1, '5.7'),
(194, 2, 62, '0', 1, '6'),
(195, 2, 63, '0', 1, '6'),
(196, 2, 64, '0', 1, '5.7'),
(197, 2, 65, '0', 1, '8.5'),
(198, 2, 66, '0', 1, '9'),
(199, 2, 67, '0', 1, '9'),
(200, 2, 68, '0', 1, '9'),
(201, 2, 69, '0', 1, '9'),
(202, 2, 70, '0', 1, '5.7'),
(203, 2, 71, '0', 1, '5.7'),
(204, 2, 72, '0', 1, '5.7'),
(205, 2, 73, '0', 1, '5.7'),
(206, 2, 74, '0', 1, '9'),
(207, 2, 75, '0', 1, '9'),
(208, 2, 76, '0', 1, '8.5'),
(209, 2, 77, '0', 1, '5.7'),
(210, 2, 78, '0', 1, '6'),
(211, 2, 79, '0', 1, '6'),
(212, 2, 80, '0', 1, '6'),
(213, 2, 81, '0', 1, '6'),
(214, 2, 82, '0', 1, '5.7'),
(215, 2, 83, '0', 1, '8.5'),
(216, 2, 84, '0', 1, '9'),
(217, 2, 85, '0', 1, '9'),
(218, 2, 86, '0', 1, '9'),
(219, 2, 87, '0', 1, '9'),
(220, 2, 88, '0', 1, '9'),
(221, 2, 89, '0', 1, '27'),
(222, 2, 90, '0', 1, '9'),
(223, 2, 91, '0', 1, '9'),
(224, 2, 92, '0', 1, '27'),
(225, 2, 93, '0', 1, '9'),
(226, 2, 94, '0', 1, '9'),
(227, 2, 95, '0', 1, '8'),
(228, 2, 96, '0', 1, '9'),
(229, 2, 97, '0', 1, '9'),
(230, 2, 98, '0', 1, '5.7'),
(231, 2, 99, '0', 1, '6'),
(232, 2, 100, '0', 1, '6'),
(233, 2, 101, '0', 1, '6'),
(234, 2, 102, '0', 1, '6'),
(235, 2, 103, '0', 1, '5.7'),
(236, 2, 104, '0', 1, '8.5'),
(237, 2, 105, '0', 1, '9'),
(238, 2, 106, '0', 1, '8.5'),
(239, 2, 107, '0', 1, '5.7'),
(240, 2, 108, '0', 1, '6'),
(241, 2, 109, '0', 1, '6'),
(242, 2, 110, '0', 1, '5.7'),
(243, 2, 111, '0', 1, '9'),
(244, 2, 112, '0', 1, '27'),
(245, 2, 113, '0', 1, '9'),
(246, 2, 114, '0', 1, '9'),
(247, 2, 115, '0', 1, '5.7'),
(248, 2, 116, '0', 1, '6'),
(249, 2, 117, '0', 1, '6'),
(250, 2, 118, '0', 1, '5.7');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tarea_pre`
--

CREATE TABLE IF NOT EXISTS `tarea_pre` (
  `tar_id` int(11) NOT NULL AUTO_INCREMENT,
  `pre_id` int(11) NOT NULL,
  `tar_fechcre` datetime NOT NULL COMMENT 'creacon',
  `tar_fechrea` datetime NOT NULL COMMENT 'realizar',
  `tar_tip` int(11) NOT NULL COMMENT 'Tipo tarea',
  `tar_des` text NOT NULL COMMENT 'descripcion',
  `tar_est` int(11) NOT NULL COMMENT 'Estado',
  `tar_not` text NOT NULL COMMENT 'nota',
  PRIMARY KEY (`tar_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_empresa`
--

CREATE TABLE IF NOT EXISTS `tipo_empresa` (
  `tipo_id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo_des` varchar(50) NOT NULL,
  `tipo_cla` int(11) NOT NULL,
  PRIMARY KEY (`tipo_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `tipo_empresa`
--

INSERT INTO `tipo_empresa` (`tipo_id`, `tipo_des`, `tipo_cla`) VALUES
(1, 'Calzado', 1),
(2, 'Licores', 1),
(3, 'Ropa Infantil', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(20) NOT NULL,
  `clave` varchar(20) NOT NULL,
  `tipo` int(11) NOT NULL COMMENT '1-Admin, 2-Normal',
  `estado` int(11) NOT NULL COMMENT '1-Activo, 0-Inactivo',
  `usuario` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id`, `nombre`, `clave`, `tipo`, `estado`, `usuario`) VALUES
(1, 'Administrador', 'expofer123', 1, 1, 'admin');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
