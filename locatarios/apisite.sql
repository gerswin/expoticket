-- phpMyAdmin SQL Dump
-- version 4.1.8
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 12-01-2015 a las 10:45:55
-- Versión del servidor: 5.5.40-0ubuntu0.14.04.1
-- Versión de PHP: 5.5.9-1ubuntu4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `apisite`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `activaciones`
--

CREATE TABLE IF NOT EXISTS `activaciones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` int(11) NOT NULL COMMENT 'codigo cliente',
  `tipo` int(11) NOT NULL COMMENT 'omercio, persona etc.',
  `fecha` datetime NOT NULL,
  `status` int(11) NOT NULL COMMENT '1=Por Guardar, 2=Por Validar, 3=Validado',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `activaciones`
--

INSERT INTO `activaciones` (`id`, `codigo`, `tipo`, `fecha`, `status`) VALUES
(1, 1, 1, '2015-01-09 10:00:00', 1),
(2, 2, 1, '2015-01-09 10:31:20', 1),
(3, 3, 1, '2015-01-09 13:30:22', 1),
(4, 4, 1, '2015-01-09 10:31:20', 1),
(5, 5, 1, '2015-01-09 13:30:22', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comercio`
--

CREATE TABLE IF NOT EXISTS `comercio` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) NOT NULL,
  `contacto` varchar(100) NOT NULL,
  `nrotelf` varchar(20) NOT NULL,
  `mail` varchar(60) NOT NULL,
  `pabellon` varchar(100) NOT NULL,
  `stand` text NOT NULL,
  `segmento` varchar(20) NOT NULL,
  `keyset` text NOT NULL,
  `urllocal` varchar(255) NOT NULL,
  `urllogo` varchar(255) NOT NULL,
  `detalle` varchar(300) NOT NULL,
  `credencial` int(11) NOT NULL,
  `nombrecomercial` varchar(60) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Volcado de datos para la tabla `comercio`
--

INSERT INTO `comercio` (`id`, `nombre`, `contacto`, `nrotelf`, `mail`, `pabellon`, `stand`, `segmento`, `keyset`, `urllocal`, `urllogo`, `detalle`, `credencial`, `nombrecomercial`) VALUES
(1, 'Carreer', 'Chiabe', '123123', 'a@a.a', 'Venezuela', '1,2', 'calzado', 'botas, cordones, suelas, qizza', '', '', 'todo barato', 3, ''),
(2, 'Caftalman', 'Gerswin lee', '02779487231', 'a@a.com', ' Venezuela', '1,3,4,5', 'comida', 'pizza, margarita, napolitana, conos qizza,cordones', '', '', 'Pizzas cónicas.', 2, ''),
(3, 'Inversiones Gaby car lamejor delmercado vallalomamaguebo marico el que lolea', 'Gabriel', '02771232123', 'amilcar@gmail.com', ' Colombia', '100,102', 'construccion', 'cemento, bloques,  cabilla, qizza', '', '', 'ladrillo e intrumentos para la construcción.', 4, ''),
(4, 'Ducati', 'posho', '0120301230', 'asdsd@asd.com', 'Venezuela', '54', 'motos', 'ducatti, monster, motor', 'https://encrypted-tbn2.gstatic.com/images?q=tbn:ANd9GcREF7iTCGXzzmjOTx6EWarbGjv7W4bhswdztgPfMtAXZ2jAQ_7-', '', 'ejores ofertas en ducatti', 5, ''),
(5, 'Yamaha', 'poshhho', '12323', '', 'Colombia', '44,45', 'motos', 'motos, fazer, fz, yamaha', 'http://www.motorcyclespecs.co.za/Gallery%20%20A/Yamaha%20FZ6%20Naked%2004.%20%201.jpg', '', '', 2, ''),
(6, 'Suzuki', 'poshh', '123123', '', 'Venezuela', '33', 'motos', 'motos, suzuki', 'http://www.motorcycledaily.com/wp-content/uploads/2010/10/GSR750.jpg', '', 'GSR 750', 1, ''),
(7, 'Empire Keeway', 'poshe', '23123', '', 'Colombia', '24,22', 'motos', 'motos, empire, keeway', 'http://bimg2.mlstatic.com/keeway-rk6-benelli-600cm3-inyeccion-82hp-16v-2-anos-gar_MLA-F-4462889961_062013.jpg', '', 'RK6', 3, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `credenciales`
--

CREATE TABLE IF NOT EXISTS `credenciales` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fk_activaciones` int(11) NOT NULL,
  `nombre` varchar(120) NOT NULL,
  `urlimage` varchar(255) NOT NULL,
  `movil` varchar(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_activaciones` (`fk_activaciones`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `credenciales`
--

INSERT INTO `credenciales` (`id`, `fk_activaciones`, `nombre`, `urlimage`, `movil`) VALUES
(1, 1, 'Juan', '21312', '123123');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `eventos`
--

CREATE TABLE IF NOT EXISTS `eventos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fechainicio` datetime NOT NULL,
  `fechafin` datetime NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `tipo` varchar(100) NOT NULL,
  `urlflayer` varchar(255) NOT NULL,
  `descripcion` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `credenciales`
--
ALTER TABLE `credenciales`
  ADD CONSTRAINT `fk_activaciones` FOREIGN KEY (`fk_activaciones`) REFERENCES `activaciones` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
