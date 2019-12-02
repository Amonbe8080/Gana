-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 02-12-2019 a las 03:06:28
-- Versión del servidor: 5.7.26
-- Versión de PHP: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `gana`
--
CREATE DATABASE IF NOT EXISTS `gana` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `gana`;

DELIMITER $$
--
-- Procedimientos
--
DROP PROCEDURE IF EXISTS `loginTaquilla`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `loginTaquilla` (IN `correol` VARCHAR(100), IN `clavel` TEXT)  NO SQL
SELECT * FROM taquillas WHERE correo = correol AND clave = md5(clavel)$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `buscarenvio`
-- (Véase abajo para la vista actual)
--
DROP VIEW IF EXISTS `buscarenvio`;
CREATE TABLE IF NOT EXISTS `buscarenvio` (
`estado` varchar(11)
,`fechaEnvio` datetime
,`idEnvio` int(11)
,`idEmpleado` int(11)
,`nombreEmpleado` varchar(250)
,`dniEmisor` int(11)
,`nombreEmisor` varchar(250)
,`dniReceptor` int(11)
,`nombreReceptor` varchar(250)
,`municipioInicial` varchar(100)
,`departamentoInicial` varchar(100)
,`paisInicial` varchar(100)
,`id` int(11)
,`municipioFinal` varchar(100)
,`departamentoFinal` varchar(100)
,`paisFinal` varchar(100)
,`Valor` double
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamento`
--

DROP TABLE IF EXISTS `departamento`;
CREATE TABLE IF NOT EXISTS `departamento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `id_pais` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nombre` (`nombre`,`id_pais`),
  KEY `id_pais` (`id_pais`),
  KEY `id_pais_2` (`id_pais`),
  KEY `id_pais_3` (`id_pais`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `departamento`
--

INSERT INTO `departamento` (`id`, `nombre`, `id_pais`) VALUES
(1, 'Antioquia', 1),
(2, 'Huila', 1),
(3, 'Quebec', 3),
(4, 'Ontario', 3),
(5, 'Terranova ', 3),
(6, 'Atacama', 4),
(7, 'Coquimbo', 4),
(8, 'Valparaíso', 4),
(9, 'Ancash', 2),
(10, 'Lima', 2),
(11, 'Cuzco', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `encargado`
--

DROP TABLE IF EXISTS `encargado`;
CREATE TABLE IF NOT EXISTS `encargado` (
  `id` int(11) NOT NULL,
  `nombreEnc` varchar(250) NOT NULL,
  `id_taquilla` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_taquilla` (`id_taquilla`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `encargado`
--

INSERT INTO `encargado` (`id`, `nombreEnc`, `id_taquilla`) VALUES
(37535354, 'brayan gimenez alzate', 3),
(400498536, 'Kelly Johana Chavarria ', 1),
(1007222463, 'Sebastian Alvarez Perez', 1),
(1478569238, 'Maria Jose Gaviria Plata', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `envios`
--

DROP TABLE IF EXISTS `envios`;
CREATE TABLE IF NOT EXISTS `envios` (
  `idEnvio` int(11) NOT NULL AUTO_INCREMENT,
  `idMunInicial` int(11) NOT NULL,
  `dniEmisor` int(11) NOT NULL,
  `dniReceptor` int(11) NOT NULL,
  `Valor` double NOT NULL,
  `idMunFinal` int(11) NOT NULL,
  `fechaEnvio` datetime NOT NULL,
  `estado` varchar(11) COLLATE utf8_bin NOT NULL DEFAULT 'Pendiente',
  `id_encargado` int(11) NOT NULL,
  PRIMARY KEY (`idEnvio`),
  KEY `idMunInicial` (`idMunInicial`),
  KEY `idMunFinal` (`idMunFinal`),
  KEY `dniEmisor` (`dniEmisor`),
  KEY `dniReceptor` (`dniReceptor`),
  KEY `id_encargado` (`id_encargado`)
) ENGINE=MyISAM AUTO_INCREMENT=187 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `envios`
--

INSERT INTO `envios` (`idEnvio`, `idMunInicial`, `dniEmisor`, `dniReceptor`, `Valor`, `idMunFinal`, `fechaEnvio`, `estado`, `id_encargado`) VALUES
(170, 1, 122978654, 90875638, 38800, 3, '2019-12-01 17:22:04', 'Pendiente', 1007222463),
(169, 1, 90875638, 122978654, 44135, 1, '2019-12-01 17:19:25', 'Entregado', 1007222463),
(180, 1, 43800561, 122978654, 44151514, 8, '2019-12-01 21:46:58', 'Pendiente', 400498536),
(181, 1, 122978654, 90875638, 149011, 8, '2019-12-01 21:50:53', 'Pendiente', 400498536),
(179, 1, 90875638, 100034365, 929999, 8, '2019-12-01 21:27:44', 'Pendiente', 1007222463),
(177, 1, 483581177, 100978546, 15083, 3, '2019-12-01 21:04:15', 'Pendiente', 400498536),
(178, 1, 483581177, 90875638, 96999, 2, '2019-12-01 21:05:45', 'Pendiente', 400498536),
(173, 1, 90875638, 122978654, 725400, 1, '2019-12-01 17:29:33', 'Pendiente', 1007222463),
(126, 1, 100034365, 122978654, 76424, 4, '2019-12-01 16:14:53', 'Pendiente', 1007222463),
(171, 1, 122978654, 90875638, 67900, 3, '2019-12-01 17:22:47', 'Pendiente', 1007222463),
(172, 1, 90875638, 122978654, 725400, 1, '2019-12-01 17:26:06', 'Pendiente', 1007222463),
(130, 1, 122978654, 100034365, 702666, 4, '2019-12-01 16:22:49', 'Pendiente', 1007222463),
(174, 1, 90875638, 122978654, 418508, 1, '2019-12-01 17:31:04', 'Pendiente', 1007222463),
(175, 1, 43800561, 122978654, 7477587, 1, '2019-12-01 17:53:39', 'Entregado', 1007222463),
(176, 1, 90875638, 100978546, 9700, 4, '2019-12-01 18:47:51', 'Pendiente', 400498536),
(182, 1, 122978654, 90875638, 149011, 8, '2019-12-01 21:51:02', 'Pendiente', 400498536),
(183, 1, 122978654, 483581177, 418395, 8, '2019-12-01 21:52:17', 'Pendiente', 400498536),
(184, 1, 122978654, 483581177, 418395, 8, '2019-12-01 21:54:00', 'Pendiente', 400498536),
(185, 1, 198765463, 90875638, 131236151, 8, '2019-12-01 21:55:39', 'Pendiente', 400498536),
(186, 1, 100034365, 198765463, 1148147, 8, '2019-12-01 22:00:00', 'Pendiente', 400498536);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `listarubicacion`
-- (Véase abajo para la vista actual)
--
DROP VIEW IF EXISTS `listarubicacion`;
CREATE TABLE IF NOT EXISTS `listarubicacion` (
`idMuni` int(11)
,`nameMuni` varchar(100)
,`idDep` int(11)
,`nameDept` varchar(100)
,`idPais` int(11)
,`namePais` varchar(100)
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `municipio`
--

DROP TABLE IF EXISTS `municipio`;
CREATE TABLE IF NOT EXISTS `municipio` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `id_departamento` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_departamento` (`id_departamento`),
  KEY `id_departamento_2` (`id_departamento`),
  KEY `id_departamento_3` (`id_departamento`),
  KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `municipio`
--

INSERT INTO `municipio` (`id`, `nombre`, `id_departamento`) VALUES
(1, 'Abejorral', 1),
(2, 'Abriaquí', 1),
(3, 'Abriaquí', 1),
(4, 'Aipe', 2),
(5, 'Algeciras', 2),
(6, 'Acevedo', 2),
(7, 'Neiva', 2),
(8, 'Charlesbourg', 3),
(9, 'Elgin. Essex.', 4),
(10, 'F. Frontenac.', 4),
(11, 'Nunavut', 5),
(12, 'Nunavut', 5),
(13, 'Chañaral', 6),
(14, 'Huasco', 6),
(15, 'Choapa', 7),
(16, 'Elqui', 7),
(17, 'Isla de Pascua', 8),
(18, 'Los Andes', 8),
(19, 'Huaraz', 9),
(20, 'Carhuaz', 9),
(21, 'Barranca', 10),
(22, 'Huaura', 10),
(23, 'Acomayo', 11),
(24, 'Canchis', 11);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pais`
--

DROP TABLE IF EXISTS `pais`;
CREATE TABLE IF NOT EXISTS `pais` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `Nombre` (`Nombre`),
  KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `pais`
--

INSERT INTO `pais` (`id`, `Nombre`) VALUES
(1, 'Colombia'),
(2, 'Perú'),
(3, 'Canada'),
(4, 'Chile');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `taquillas`
--

DROP TABLE IF EXISTS `taquillas`;
CREATE TABLE IF NOT EXISTS `taquillas` (
  `idTaquilla` int(11) NOT NULL AUTO_INCREMENT,
  `correo` varchar(100) COLLATE utf8_bin NOT NULL,
  `clave` text COLLATE utf8_bin NOT NULL,
  `idMunicipio` int(11) NOT NULL,
  PRIMARY KEY (`idTaquilla`),
  UNIQUE KEY `correo` (`correo`),
  KEY `idMunicipio` (`idMunicipio`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `taquillas`
--

INSERT INTO `taquillas` (`idTaquilla`, `correo`, `clave`, `idMunicipio`) VALUES
(1, 'ganaAbejorral1@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 1),
(2, 'ganaNeiva1@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 7),
(3, 'ganachoapa1@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 15);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipodocumento`
--

DROP TABLE IF EXISTS `tipodocumento`;
CREATE TABLE IF NOT EXISTS `tipodocumento` (
  `idDocumento` int(11) NOT NULL AUTO_INCREMENT,
  `nombreDocumento` varchar(30) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`idDocumento`),
  KEY `idDocumento` (`idDocumento`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `tipodocumento`
--

INSERT INTO `tipodocumento` (`idDocumento`, `nombreDocumento`) VALUES
(1, 'Cedula ciudadana'),
(2, 'Tarjeta identidad'),
(3, 'Cedula extranjera'),
(4, 'Contraseña');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `dni` int(11) NOT NULL,
  `idDocumento` int(11) NOT NULL,
  `nombre` varchar(250) NOT NULL,
  PRIMARY KEY (`dni`),
  KEY `idDocumento` (`idDocumento`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`dni`, `idDocumento`, `nombre`) VALUES
(43800561, 3, 'Kelly Alzate Lopera'),
(90875638, 1, 'mario salazar'),
(100034365, 1, 'camila diaz hernandez'),
(100978546, 2, 'estefania pino gimenez'),
(122978654, 1, 'maria fernanda ospina zapata'),
(198765463, 2, 'juan david lopez lopez'),
(483581177, 3, 'Kelly Alzzate Lopera');

-- --------------------------------------------------------

--
-- Estructura para la vista `buscarenvio`
--
DROP TABLE IF EXISTS `buscarenvio`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `buscarenvio`  AS  select `e`.`estado` AS `estado`,`e`.`fechaEnvio` AS `fechaEnvio`,`e`.`idEnvio` AS `idEnvio`,`en`.`id` AS `idEmpleado`,`en`.`nombreEnc` AS `nombreEmpleado`,`u`.`dni` AS `dniEmisor`,`u`.`nombre` AS `nombreEmisor`,`r`.`dni` AS `dniReceptor`,`r`.`nombre` AS `nombreReceptor`,`mi`.`nombre` AS `municipioInicial`,`di`.`nombre` AS `departamentoInicial`,`pi`.`Nombre` AS `paisInicial`,`mf`.`id` AS `id`,`mf`.`nombre` AS `municipioFinal`,`df`.`nombre` AS `departamentoFinal`,`pf`.`Nombre` AS `paisFinal`,`e`.`Valor` AS `Valor` from (((((((((`envios` `e` join `encargado` `en` on((`e`.`id_encargado` = `en`.`id`))) join `usuario` `u` on((`u`.`dni` = `e`.`dniEmisor`))) join `usuario` `r` on((`r`.`dni` = `e`.`dniReceptor`))) join `municipio` `mi` on((`mi`.`id` = `e`.`idMunInicial`))) join `departamento` `di` on((`di`.`id` = `mi`.`id_departamento`))) join `pais` `pi` on((`pi`.`id` = `di`.`id_pais`))) join `municipio` `mf` on((`mf`.`id` = `e`.`idMunFinal`))) join `departamento` `df` on((`df`.`id` = `mf`.`id_departamento`))) join `pais` `pf` on((`pf`.`id` = `df`.`id_pais`))) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `listarubicacion`
--
DROP TABLE IF EXISTS `listarubicacion`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `listarubicacion`  AS  select `m`.`id` AS `idMuni`,`m`.`nombre` AS `nameMuni`,`d`.`id` AS `idDep`,`d`.`nombre` AS `nameDept`,`p`.`id` AS `idPais`,`p`.`Nombre` AS `namePais` from ((`municipio` `m` join `departamento` `d` on((`d`.`id` = `m`.`id_departamento`))) join `pais` `p` on((`d`.`id_pais` = `p`.`id`))) ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
