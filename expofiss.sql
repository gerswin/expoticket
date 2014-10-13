-- phpMyAdmin SQL Dump
-- version 4.1.8
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 13-10-2014 a las 11:32:56
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=35 ;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`cli_id`, `cli_rif`, `cli_razon`, `cli_contacto`, `cli_telefono`, `cli_correo`) VALUES
(32, 'j129868273123', 'parawebos', 'miguel', '04123123123', 'juan@melo.com'),
(28, 'j12986827361823', 'parawebos', 'miguel', '04123123123', 'juan@melo.com'),
(29, 'j1298682736183', 'parawebos', 'miguel', '04123123123', 'juan@melo.com'),
(33, 'j1723123618273', 'CASA', '123123', '21312312312', 'TENGA@ASDAS.ASD'),
(23, 'J18237192312312', 'UUasda', 'asdasdasd', '04123182368', 'asdasd@asdajshdcon.com'),
(26, 'J18237192317876', 'UUasda', 'asdasdasd', '04123182368', 'asdasd@asdajshdcon.com'),
(21, 'J18237192371822', 'UUasda', 'asdasdasd', '04123182368', 'asdasd@asdajshdcon.com'),
(19, 'J18237192371823', 'UUasda', 'asdasdasd', '04123182368', 'asdasd@asdajshdcon.com'),
(15, 'j712837129371', 'pepe', 'veraz', '04121231231', 'amilcar@asdasd.com'),
(17, 'j712837129373', 'pepe', 'veraz', '04121231231', 'amilcar@asdasd.com'),
(34, 'J77623123123123', 'USUASUD', 'JAUSDHGASDASD', '92838236128', 'ASDASD@ASDAS.ASD'),
(10, 'j98273912731921', 'Juan mata', 'Jose Rodrigo', '04231231231', 'amicar@gma.com'),
(7, 'j98273912731923', 'Juan mata', 'Jose Rodrigo', '04231231231', 'amicar@gma.com'),
(14, 'j98273912731933', 'Juan mataaa', 'Jose Rodrigo', '04231231231', 'amicar@gma.com');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=32 ;

--
-- Volcado de datos para la tabla `preventaweb`
--

INSERT INTO `preventaweb` (`pre_id`, `pre_emp`, `pre_con`, `pre_tel`, `pre_ema`, `pre_tip`, `pre_ruta`, `pre_rutaid`, `pre_est`, `pre_int`) VALUES
(29, 'parwebs', 'Amilcar Zambrano', '04160893820', 'amilcarpw@gmail.com', 2, 0, 0, 1, ''),
(30, 'parawebos', 'amilcarzambrano', '04160893820', 'amilcarzg@gmail.com', 2, 0, 0, 3, '0'),
(31, 'parawebs', 'miguel', '04122037487', 'inventr@gmail.com', 2, 0, 0, 1, '1');

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
(1, 1, 1, '1', 1, '5.7'),
(2, 1, 2, '1', 1, '6'),
(3, 1, 3, '1', 1, '6'),
(4, 1, 4, '1', 1, '5.7'),
(5, 1, 5, '1', 1, '9'),
(6, 1, 6, '1', 1, '9'),
(7, 1, 7, '1', 1, '25'),
(8, 1, 8, '1', 1, '9'),
(9, 1, 9, '1', 1, '9'),
(10, 1, 10, '1', 1, '27'),
(11, 1, 11, '1', 1, '9'),
(12, 1, 12, '1', 1, '9'),
(13, 1, 13, '1', 1, '9'),
(14, 1, 14, '1', 1, '8.5'),
(15, 1, 15, '1', 1, '5.7'),
(16, 1, 16, '1', 1, '6'),
(17, 1, 17, '1', 1, '6'),
(18, 1, 18, '1', 1, '5.7'),
(19, 1, 19, '1', 1, '5.7'),
(20, 1, 20, '1', 1, '6'),
(21, 1, 21, '1', 1, '6'),
(22, 1, 22, '1', 1, '6'),
(23, 1, 23, '1', 1, '6'),
(24, 1, 24, '1', 1, '5.7'),
(25, 1, 25, '1', 1, '11.5'),
(26, 1, 26, '1', 1, '9'),
(27, 1, 27, '1', 1, '9'),
(28, 1, 28, '1', 1, '9'),
(29, 1, 29, '1', 1, '9'),
(30, 1, 30, '1', 1, '25'),
(31, 1, 31, '1', 1, '9'),
(32, 1, 32, '1', 1, '9'),
(33, 1, 33, '1', 1, '27'),
(34, 1, 34, '1', 1, '9'),
(35, 1, 35, '1', 1, '9'),
(36, 1, 36, '1', 1, '9'),
(37, 1, 37, '1', 1, '9'),
(38, 1, 38, '1', 1, '9'),
(39, 1, 39, '1', 1, '8.5'),
(40, 1, 40, '1', 1, '5.7'),
(41, 1, 41, '1', 1, '6'),
(42, 1, 42, '1', 1, '6'),
(43, 1, 43, '1', 1, '6'),
(44, 1, 44, '1', 1, '6'),
(45, 1, 45, '1', 1, '5.7'),
(46, 1, 46, '1', 1, '5.7'),
(47, 1, 47, '1', 1, '6'),
(48, 1, 48, '1', 1, '6'),
(49, 1, 49, '1', 1, '5.7'),
(50, 1, 50, '1', 1, '8.5'),
(51, 1, 51, '1', 1, '9'),
(52, 1, 52, '1', 1, '9'),
(53, 1, 53, '1', 1, '9'),
(54, 1, 54, '1', 1, '27'),
(55, 1, 55, '1', 1, '9'),
(56, 1, 56, '1', 1, '9'),
(57, 1, 57, '1', 1, '27'),
(58, 1, 58, '1', 1, '9'),
(59, 1, 59, '1', 1, '9'),
(60, 1, 60, '1', 1, '9'),
(61, 1, 61, '1', 1, '9'),
(62, 1, 62, '1', 1, '9'),
(63, 1, 63, '1', 1, '8.5'),
(64, 1, 64, '1', 1, '5.7'),
(65, 1, 65, '1', 1, '6'),
(66, 1, 66, '1', 1, '6'),
(67, 1, 67, '1', 1, '5.7'),
(68, 1, 68, '1', 1, '5.7'),
(69, 1, 69, '1', 1, '6'),
(70, 1, 70, '1', 1, '6'),
(71, 1, 71, '1', 1, '5.7'),
(72, 1, 72, '1', 1, '8.5'),
(73, 1, 73, '1', 1, '9'),
(74, 1, 74, '1', 1, '9'),
(75, 1, 75, '1', 1, '9'),
(76, 1, 76, '1', 1, '9'),
(77, 1, 77, '1', 1, '9'),
(78, 1, 78, '1', 1, '27'),
(79, 1, 79, '1', 1, '9'),
(80, 1, 80, '1', 1, '9'),
(81, 1, 81, '1', 1, '27'),
(82, 1, 82, '1', 1, '9'),
(83, 1, 83, '1', 1, '9'),
(84, 1, 84, '1', 1, '9'),
(85, 1, 85, '1', 1, '8.5'),
(86, 1, 86, '1', 1, '5.7'),
(87, 1, 87, '1', 1, '6'),
(88, 1, 88, '1', 1, '6'),
(89, 1, 89, '1', 1, '5.7'),
(90, 1, 90, '1', 1, '5.7'),
(91, 1, 91, '1', 1, '6'),
(92, 1, 92, '1', 1, '6'),
(93, 1, 93, '1', 1, '6'),
(94, 1, 94, '1', 1, '6'),
(95, 1, 95, '1', 1, '5.7'),
(96, 1, 96, '1', 1, '8.5'),
(97, 1, 97, '1', 1, '9'),
(98, 1, 98, '1', 1, '9'),
(99, 1, 99, '1', 1, '9'),
(100, 1, 100, '1', 1, '9'),
(101, 1, 101, '1', 1, '9'),
(102, 1, 102, '1', 1, '27'),
(103, 1, 103, '1', 1, '9'),
(104, 1, 104, '1', 1, '9'),
(105, 1, 105, '1', 1, '27'),
(106, 1, 106, '1', 1, '9'),
(107, 1, 107, '1', 1, '9'),
(108, 1, 108, '1', 1, '35'),
(109, 1, 109, '1', 1, '5.7'),
(110, 1, 110, '1', 1, '6'),
(111, 1, 111, '1', 1, '6'),
(112, 1, 112, '1', 1, '6'),
(113, 1, 113, '1', 1, '6'),
(114, 1, 114, '1', 1, '5.7'),
(115, 1, 115, '1', 1, '5.7'),
(116, 1, 116, '1', 1, '6'),
(117, 1, 117, '1', 1, '6'),
(118, 1, 118, '1', 1, '5.7'),
(119, 1, 119, '1', 1, '8.5'),
(120, 1, 120, '1', 1, '9'),
(121, 1, 121, '1', 1, '9'),
(122, 1, 122, '1', 1, '9'),
(123, 1, 123, '1', 1, '27'),
(124, 1, 124, '1', 1, '9'),
(125, 1, 125, '1', 1, '9'),
(126, 1, 126, '1', 1, '27'),
(127, 1, 127, '1', 1, '9'),
(128, 1, 128, '1', 1, '9'),
(129, 1, 129, '1', 1, '5.7'),
(130, 1, 130, '1', 1, '6'),
(131, 1, 131, '1', 1, '6'),
(132, 1, 132, '1', 1, '5.7'),
(133, 2, 1, '1', 1, '5.7'),
(134, 2, 2, '1', 1, '6'),
(135, 2, 3, '1', 1, '6'),
(136, 2, 4, '1', 1, '5.7'),
(137, 2, 5, '1', 1, '9'),
(138, 2, 6, '1', 1, '9'),
(139, 2, 7, '1', 1, '27'),
(140, 2, 8, '1', 1, '9'),
(141, 2, 9, '1', 1, '9'),
(142, 2, 10, '1', 1, '27'),
(143, 2, 11, '1', 1, '9'),
(144, 2, 12, '1', 1, '9'),
(145, 2, 13, '1', 1, '9'),
(146, 2, 14, '1', 1, '8.5'),
(147, 2, 15, '1', 1, '5.7'),
(148, 2, 16, '1', 1, '6'),
(149, 2, 17, '1', 1, '6'),
(150, 2, 18, '1', 1, '5.7'),
(151, 2, 19, '1', 1, '8'),
(152, 2, 20, '1', 1, '9'),
(153, 2, 21, '1', 1, '9'),
(154, 2, 22, '1', 1, '9'),
(155, 2, 23, '1', 1, '9'),
(156, 2, 24, '1', 1, '27'),
(157, 2, 25, '1', 1, '9'),
(158, 2, 26, '1', 1, '5.7'),
(159, 2, 27, '1', 1, '6'),
(160, 2, 28, '1', 1, '6'),
(161, 2, 29, '1', 1, '6'),
(162, 2, 30, '1', 1, '6'),
(163, 2, 31, '1', 1, '5.7'),
(164, 2, 32, '1', 1, '5.7'),
(165, 2, 33, '1', 1, '6'),
(166, 2, 34, '1', 1, '6'),
(167, 2, 35, '1', 1, '6'),
(168, 2, 36, '1', 1, '6'),
(169, 2, 37, '1', 1, '5.7'),
(170, 2, 38, '1', 1, '9'),
(171, 2, 39, '1', 1, '9'),
(172, 2, 40, '1', 1, '9'),
(173, 2, 41, '1', 1, '9'),
(174, 2, 42, '1', 1, '8.5'),
(175, 2, 43, '1', 1, '5.7'),
(176, 2, 44, '1', 1, '6'),
(177, 2, 45, '1', 1, '6'),
(178, 2, 46, '1', 1, '5.7'),
(179, 2, 47, '1', 1, '8.5'),
(180, 2, 48, '1', 1, '9'),
(181, 2, 49, '1', 1, '9'),
(182, 2, 50, '1', 1, '9'),
(183, 2, 51, '1', 1, '27'),
(184, 2, 52, '1', 1, '9'),
(185, 2, 53, '1', 1, '9'),
(186, 2, 54, '1', 1, '27'),
(187, 2, 55, '1', 1, '9'),
(188, 2, 56, '1', 1, '9'),
(189, 2, 57, '1', 1, '9'),
(190, 2, 58, '1', 1, '9'),
(191, 2, 59, '1', 1, '9'),
(192, 2, 60, '1', 1, '8.5'),
(193, 2, 61, '1', 1, '5.7'),
(194, 2, 62, '1', 1, '6'),
(195, 2, 63, '1', 1, '6'),
(196, 2, 64, '1', 1, '5.7'),
(197, 2, 65, '1', 1, '8.5'),
(198, 2, 66, '1', 1, '9'),
(199, 2, 67, '1', 1, '9'),
(200, 2, 68, '1', 1, '9'),
(201, 2, 69, '1', 1, '9'),
(202, 2, 70, '1', 1, '5.7'),
(203, 2, 71, '1', 1, '5.7'),
(204, 2, 72, '1', 1, '5.7'),
(205, 2, 73, '1', 1, '5.7'),
(206, 2, 74, '1', 1, '9'),
(207, 2, 75, '1', 1, '9'),
(208, 2, 76, '1', 1, '8.5'),
(209, 2, 77, '1', 1, '5.7'),
(210, 2, 78, '1', 1, '6'),
(211, 2, 79, '1', 1, '6'),
(212, 2, 80, '1', 1, '6'),
(213, 2, 81, '1', 1, '6'),
(214, 2, 82, '1', 1, '5.7'),
(215, 2, 83, '1', 1, '8.5'),
(216, 2, 84, '1', 1, '9'),
(217, 2, 85, '1', 1, '9'),
(218, 2, 86, '1', 1, '9'),
(219, 2, 87, '1', 1, '9'),
(220, 2, 88, '1', 1, '9'),
(221, 2, 89, '1', 1, '27'),
(222, 2, 90, '1', 1, '9'),
(223, 2, 91, '1', 1, '9'),
(224, 2, 92, '1', 1, '27'),
(225, 2, 93, '1', 1, '9'),
(226, 2, 94, '1', 1, '9'),
(227, 2, 95, '1', 1, '8'),
(228, 2, 96, '1', 1, '9'),
(229, 2, 97, '1', 1, '9'),
(230, 2, 98, '1', 1, '5.7'),
(231, 2, 99, '1', 1, '6'),
(232, 2, 100, '1', 1, '6'),
(233, 2, 101, '1', 1, '6'),
(234, 2, 102, '1', 1, '6'),
(235, 2, 103, '1', 1, '5.7'),
(236, 2, 104, '1', 1, '8.5'),
(237, 2, 105, '1', 1, '9'),
(238, 2, 106, '1', 1, '8.5'),
(239, 2, 107, '1', 1, '5.7'),
(240, 2, 108, '1', 1, '6'),
(241, 2, 109, '1', 1, '6'),
(242, 2, 110, '1', 1, '5.7'),
(243, 2, 111, '1', 1, '9'),
(244, 2, 112, '1', 1, '27'),
(245, 2, 113, '1', 1, '9'),
(246, 2, 114, '1', 1, '9'),
(247, 2, 115, '1', 1, '5.7'),
(248, 2, 116, '1', 1, '6'),
(249, 2, 117, '1', 1, '6'),
(250, 2, 118, '1', 1, '5.7');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=36 ;

--
-- Volcado de datos para la tabla `tarea_pre`
--

INSERT INTO `tarea_pre` (`tar_id`, `pre_id`, `tar_fechcre`, `tar_fechrea`, `tar_tip`, `tar_des`, `tar_est`, `tar_not`) VALUES
(33, 30, '2014-10-11 09:31:13', '2014-10-11 09:40:50', 3, 'llamar en 5 minutos', 0, ''),
(34, 30, '2014-10-13 00:23:34', '2014-10-13 12:23:24', 1, 'hola bebe', 2, '123'),
(35, 30, '2014-10-13 00:25:08', '2014-10-13 06:24:35', 1, 'Guten morning!', 1, 'paso a proceso.');

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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
