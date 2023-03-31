-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 31-03-2023 a las 16:04:40
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `dbvotaciones`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `candidatos`
--

CREATE TABLE `candidatos` (
  `IdCand` int(11) NOT NULL,
  `Candidato` varchar(25) NOT NULL,
  `Partido` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `candidatos`
--

INSERT INTO `candidatos` (`IdCand`, `Candidato`, `Partido`) VALUES
(1, 'Romina Astudillo', 'ABC'),
(2, 'Mónica Rivera', 'FGHJ'),
(3, 'Cristián Montes', 'ABC'),
(4, 'Josefa Barchiesi', 'ERT'),
(5, 'Manuel Becker', 'ERT'),
(6, 'Juan Luis Coloma', 'QWE'),
(7, 'Francisca Del Real', 'ABC'),
(8, 'Felipe Robles', 'FGHJ'),
(9, 'Luis Mellado', 'ERT');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `communities`
--

CREATE TABLE `communities` (
  `IdCommunity` int(11) NOT NULL,
  `IdProvince` int(11) NOT NULL,
  `Community` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `communities`
--

INSERT INTO `communities` (`IdCommunity`, `IdProvince`, `Community`) VALUES
(1, 1, 'Arica'),
(2, 1, 'Camarones'),
(3, 2, 'General Lagos'),
(4, 2, 'Putre'),
(5, 3, 'Alto Hospicio'),
(6, 3, 'Iquique'),
(7, 4, 'Camiña'),
(8, 4, 'Colchane'),
(9, 4, 'Huara'),
(10, 4, 'Pica'),
(11, 4, 'Pozo Almonte'),
(12, 5, 'Tocopilla'),
(13, 5, 'María Elena'),
(14, 6, 'Calama'),
(15, 6, 'Ollague'),
(16, 6, 'San Pedro de Atacama'),
(17, 7, 'Antofagasta'),
(18, 7, 'Mejillones'),
(19, 7, 'Sierra Gorda'),
(20, 7, 'Taltal'),
(21, 8, 'Chañaral'),
(22, 8, 'Diego de Almagro'),
(23, 9, 'Copiapó'),
(24, 9, 'Caldera'),
(25, 9, 'Tierra Amarilla'),
(26, 10, 'Vallenar'),
(27, 10, 'Alto del Carmen'),
(28, 10, 'Freirina'),
(29, 10, 'Huasco'),
(30, 11, 'La Serena'),
(31, 11, 'Coquimbo'),
(32, 11, 'Andacollo'),
(33, 11, 'La Higuera'),
(34, 11, 'Paihuano'),
(35, 11, 'Vicuña'),
(36, 12, 'Ovalle'),
(37, 12, 'Combarbalá'),
(38, 12, 'Monte Patria'),
(39, 12, 'Punitaqui'),
(40, 12, 'Río Hurtado'),
(41, 13, 'Illapel'),
(42, 13, 'Canela'),
(43, 13, 'Los Vilos'),
(44, 13, 'Salamanca'),
(45, 14, 'La Ligua'),
(46, 14, 'Cabildo'),
(47, 14, 'Zapallar'),
(48, 14, 'Papudo'),
(49, 14, 'Petorca'),
(50, 15, 'Los Andes'),
(51, 15, 'San Esteban'),
(52, 15, 'Calle Larga'),
(53, 15, 'Rinconada'),
(54, 16, 'San Felipe'),
(55, 16, 'Llaillay'),
(56, 16, 'Putaendo'),
(57, 16, 'Santa María'),
(58, 16, 'Catemu'),
(59, 16, 'Panquehue'),
(60, 17, 'Quillota'),
(61, 17, 'La Cruz'),
(62, 17, 'La Calera'),
(63, 17, 'Nogales'),
(64, 17, 'Hijuelas'),
(65, 18, 'Valparaíso'),
(66, 18, 'Viña del Mar'),
(67, 18, 'Concón'),
(68, 18, 'Quintero'),
(69, 18, 'Puchuncaví'),
(70, 18, 'Casablanca'),
(71, 18, 'Juan Fernández'),
(72, 19, 'San Antonio'),
(73, 19, 'Cartagena'),
(74, 19, 'El Tabo'),
(75, 19, 'El Quisco'),
(76, 19, 'Algarrobo'),
(77, 19, 'Santo Domingo'),
(78, 20, 'Isla de Pascua'),
(79, 21, 'Quilpué'),
(80, 21, 'Limache'),
(81, 21, 'Olmué'),
(82, 21, 'Villa Alemana'),
(83, 22, 'Colina'),
(84, 22, 'Lampa'),
(85, 22, 'Tiltil'),
(86, 23, 'Santiago'),
(87, 23, 'Vitacura'),
(88, 23, 'San Ramón'),
(89, 23, 'San Miguel'),
(90, 23, 'San Joaquín'),
(91, 23, 'Renca'),
(92, 23, 'Recoleta'),
(93, 23, 'Quinta Normal'),
(94, 23, 'Quilicura'),
(95, 23, 'Pudahuel'),
(96, 23, 'Providencia'),
(97, 23, 'Peñalolén'),
(98, 23, 'Pedro Aguirre Cerda'),
(99, 23, 'Ñuñoa'),
(100, 23, 'Maipú'),
(101, 23, 'Macul'),
(102, 23, 'Lo Prado'),
(103, 23, 'Lo Espejo'),
(104, 23, 'Lo Barnechea'),
(105, 23, 'Las Condes'),
(106, 23, 'La Reina'),
(107, 23, 'La Pintana'),
(108, 23, 'La Granja'),
(109, 23, 'La Florida'),
(110, 23, 'La Cisterna'),
(111, 23, 'Independencia'),
(112, 23, 'Huechuraba'),
(113, 23, 'Estación Central'),
(114, 23, 'El Bosque'),
(115, 23, 'Conchalí'),
(116, 23, 'Cerro Navia'),
(117, 23, 'Cerrillos'),
(118, 24, 'Puente Alto'),
(119, 24, 'San José de Maipo'),
(120, 24, 'Pirque'),
(121, 25, 'San Bernardo'),
(122, 25, 'Buin'),
(123, 25, 'Paine'),
(124, 25, 'Calera de Tango'),
(125, 26, 'Melipilla'),
(126, 26, 'Alhué'),
(127, 26, 'Curacaví'),
(128, 26, 'María Pinto'),
(129, 26, 'San Pedro'),
(130, 27, 'Isla de Maipo'),
(131, 27, 'El Monte'),
(132, 27, 'Padre Hurtado'),
(133, 27, 'Peñaflor'),
(134, 27, 'Talagante'),
(135, 28, 'Codegua'),
(136, 28, 'Coínco'),
(137, 28, 'Coltauco'),
(138, 28, 'Doñihue'),
(139, 28, 'Graneros'),
(140, 28, 'Las Cabras'),
(141, 28, 'Machalí'),
(142, 28, 'Malloa'),
(143, 28, 'Mostazal'),
(144, 28, 'Olivar'),
(145, 28, 'Peumo'),
(146, 28, 'Pichidegua'),
(147, 28, 'Quinta de Tilcoco'),
(148, 28, 'Rancagua'),
(149, 28, 'Rengo'),
(150, 28, 'Requínoa'),
(151, 28, 'San Vicente de Tagua Tagua'),
(152, 29, 'Chépica'),
(153, 29, 'Chimbarongo'),
(154, 29, 'Lolol'),
(155, 29, 'Nancagua'),
(156, 29, 'Palmilla'),
(157, 29, 'Peralillo'),
(158, 29, 'Placilla'),
(159, 29, 'Pumanque'),
(160, 29, 'San Fernando'),
(161, 29, 'Santa Cruz'),
(162, 30, 'La Estrella'),
(163, 30, 'Litueche'),
(164, 30, 'Marchigüe'),
(165, 30, 'Navidad'),
(166, 30, 'Paredones'),
(167, 30, 'Pichilemu'),
(168, 31, 'Curicó'),
(169, 31, 'Hualañé'),
(170, 31, 'Licantén'),
(171, 31, 'Molina'),
(172, 31, 'Rauco'),
(173, 31, 'Romeral'),
(174, 31, 'Sagrada Familia'),
(175, 31, 'Teno'),
(176, 31, 'Vichuquén'),
(177, 32, 'Talca'),
(178, 32, 'San Clemente'),
(179, 32, 'Pelarco'),
(180, 32, 'Pencahue'),
(181, 32, 'Maule'),
(182, 32, 'San Rafael'),
(183, 33, 'Curepto'),
(184, 32, 'Constitución'),
(185, 32, 'Empedrado'),
(186, 32, 'Río Claro'),
(187, 33, 'Linares'),
(188, 33, 'San Javier'),
(189, 33, 'Parral'),
(190, 33, 'Villa Alegre'),
(191, 33, 'Longaví'),
(192, 33, 'Colbún'),
(193, 33, 'Retiro'),
(194, 33, 'Yerbas Buenas'),
(195, 34, 'Cauquenes'),
(196, 34, 'Chanco'),
(197, 34, 'Pelluhue'),
(198, 35, 'Bulnes'),
(199, 35, 'Chillán'),
(200, 35, 'Chillán Viejo'),
(201, 35, 'El Carmen'),
(202, 35, 'Pemuco'),
(203, 35, 'Pinto'),
(204, 35, 'Quillón'),
(205, 35, 'San Ignacio'),
(206, 35, 'Yungay'),
(207, 36, 'Cobquecura'),
(208, 36, 'Coelemu'),
(209, 36, 'Ninhue'),
(210, 36, 'Portezuelo'),
(211, 36, 'Quirihue'),
(212, 36, 'Ránquil'),
(213, 36, 'Treguaco'),
(214, 37, 'San Carlos'),
(215, 37, 'Coihueco'),
(216, 37, 'San Nicolás'),
(217, 37, 'Ñiquén'),
(218, 37, 'San Fabián'),
(219, 38, 'Alto Biobío'),
(220, 38, 'Antuco'),
(221, 38, 'Cabrero'),
(222, 38, 'Laja'),
(223, 38, 'Los Ángeles'),
(224, 38, 'Mulchén'),
(225, 38, 'Nacimiento'),
(226, 38, 'Negrete'),
(227, 38, 'Quilaco'),
(228, 38, 'Quilleco'),
(229, 38, 'San Rosendo'),
(230, 38, 'Santa Bárbara'),
(231, 38, 'Tucapel'),
(232, 38, 'Yumbel'),
(233, 39, 'Concepción'),
(234, 39, 'Coronel'),
(235, 39, 'Chiguayante'),
(236, 39, 'Florida'),
(237, 39, 'Hualpén'),
(238, 39, 'Hualqui'),
(239, 39, 'Lota'),
(240, 39, 'Penco'),
(241, 39, 'San Pedro de La Paz'),
(242, 39, 'Santa Juana'),
(243, 39, 'Talcahuano'),
(244, 39, 'Tomé'),
(245, 40, 'Arauco'),
(246, 40, 'Cañete'),
(247, 40, 'Contulmo'),
(248, 40, 'Curanilahue'),
(249, 40, 'Lebu'),
(250, 40, 'Los Álamos'),
(251, 40, 'Tirúa'),
(252, 41, 'Angol'),
(253, 41, 'Collipulli'),
(254, 41, 'Curacautín'),
(255, 41, 'Ercilla'),
(256, 41, 'Lonquimay'),
(257, 41, 'Los Sauces'),
(258, 41, 'Lumaco'),
(259, 41, 'Purén'),
(260, 41, 'Renaico'),
(261, 41, 'Traiguén'),
(262, 41, 'Victoria'),
(263, 42, 'Temuco'),
(264, 42, 'Carahue'),
(265, 42, 'Cholchol'),
(266, 42, 'Cunco'),
(267, 42, 'Curarrehue'),
(268, 42, 'Freire'),
(269, 42, 'Galvarino'),
(270, 42, 'Gorbea'),
(271, 42, 'Lautaro'),
(272, 42, 'Loncoche'),
(273, 42, 'Melipeuco'),
(274, 42, 'Nueva Imperial'),
(275, 42, 'Padre Las Casas'),
(276, 42, 'Perquenco'),
(277, 42, 'Pitrufquén'),
(278, 42, 'Pucón'),
(279, 42, 'Saavedra'),
(280, 42, 'Teodoro Schmidt'),
(281, 42, 'Toltén'),
(282, 42, 'Vilcún'),
(283, 42, 'Villarrica'),
(284, 43, 'Valdivia'),
(285, 43, 'Corral'),
(286, 43, 'Lanco'),
(287, 43, 'Los Lagos'),
(288, 43, 'Máfil'),
(289, 43, 'Mariquina'),
(290, 43, 'Paillaco'),
(291, 43, 'Panguipulli'),
(292, 44, 'La Unión'),
(293, 44, 'Futrono'),
(294, 44, 'Lago Ranco'),
(295, 44, 'Río Bueno'),
(297, 45, 'Osorno'),
(298, 45, 'Puerto Octay'),
(299, 45, 'Purranque'),
(300, 45, 'Puyehue'),
(301, 45, 'Río Negro'),
(302, 45, 'San Juan de la Costa'),
(303, 45, 'San Pablo'),
(304, 46, 'Calbuco'),
(305, 46, 'Cochamó'),
(306, 46, 'Fresia'),
(307, 46, 'Frutillar'),
(308, 46, 'Llanquihue'),
(309, 46, 'Los Muermos'),
(310, 46, 'Maullín'),
(311, 46, 'Puerto Montt'),
(312, 46, 'Puerto Varas'),
(313, 47, 'Ancud'),
(314, 47, 'Castro'),
(315, 47, 'Chonchi'),
(316, 47, 'Curaco de Vélez'),
(317, 47, 'Dalcahue'),
(318, 47, 'Puqueldón'),
(319, 47, 'Queilén'),
(320, 47, 'Quellón'),
(321, 47, 'Quemchi'),
(322, 47, 'Quinchao'),
(323, 48, 'Chaitén'),
(324, 48, 'Futaleufú'),
(325, 48, 'Hualaihué'),
(326, 48, 'Palena'),
(327, 49, 'Lago Verde'),
(328, 49, 'Coihaique'),
(329, 50, 'Aysén'),
(330, 50, 'Cisnes'),
(331, 50, 'Guaitecas'),
(332, 51, 'Río Ibáñez'),
(333, 51, 'Chile Chico'),
(334, 52, 'Cochrane'),
(335, 52, 'O\'Higgins'),
(336, 52, 'Tortel'),
(337, 53, 'Natales'),
(338, 53, 'Torres del Paine'),
(339, 54, 'Laguna Blanca'),
(340, 54, 'Punta Arenas'),
(341, 54, 'Río Verde'),
(342, 54, 'San Gregorio'),
(343, 55, 'Porvenir'),
(344, 55, 'Primavera'),
(345, 55, 'Timaukel'),
(346, 56, 'Cabo de Hornos'),
(347, 56, 'Antártica');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `provinces`
--

CREATE TABLE `provinces` (
  `IdProvince` int(11) NOT NULL,
  `IdRegion` int(11) NOT NULL,
  `Province` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `provinces`
--

INSERT INTO `provinces` (`IdProvince`, `IdRegion`, `Province`) VALUES
(1, 1, 'Arica'),
(2, 1, 'Parinacota'),
(3, 2, 'Iquique'),
(4, 2, 'El Tamarugal'),
(5, 3, 'Tocopilla'),
(6, 3, 'El Loa'),
(7, 3, 'Antofagasta'),
(8, 4, 'Chañaral'),
(9, 4, 'Copiapó'),
(10, 4, 'Huasco'),
(11, 5, 'Elqui'),
(12, 5, 'Limarí'),
(13, 5, 'Choapa'),
(14, 6, 'Petorca'),
(15, 6, 'Los Andes'),
(16, 6, 'San Felipe de Ac'),
(17, 6, 'Quillota'),
(18, 6, 'Valparaiso'),
(19, 6, 'San Antonio'),
(20, 6, 'Isla de Pascua'),
(21, 6, 'Marga Marga'),
(22, 7, 'Chacabuco'),
(23, 7, 'Santiago'),
(24, 7, 'Cordillera'),
(25, 7, 'Maipo'),
(26, 7, 'Melipilla'),
(27, 7, 'Talagante'),
(28, 8, 'Cachapoal'),
(29, 8, 'Colchagua'),
(30, 8, 'Cardenal Caro'),
(31, 9, 'Curicó'),
(32, 9, 'Talca'),
(33, 9, 'Linares'),
(34, 9, 'Cauquenes'),
(35, 10, 'Diguillín'),
(36, 10, 'Itata'),
(37, 10, 'Punilla'),
(38, 11, 'Bio Bío'),
(39, 11, 'Concepción'),
(40, 11, 'Arauco'),
(41, 12, 'Malleco'),
(42, 12, 'Cautín'),
(43, 13, 'Valdivia'),
(44, 13, 'Ranco'),
(45, 14, 'Osorno'),
(46, 14, 'Llanquihue'),
(47, 14, 'Chiloé'),
(48, 14, 'Palena'),
(49, 15, 'Coyhaique'),
(50, 15, 'Aysén'),
(51, 15, 'General Carrera'),
(52, 15, 'Capitán Prat'),
(53, 16, 'Última Esperanza'),
(54, 16, 'Magallanes'),
(55, 16, 'Tierra del Fuego'),
(56, 16, 'Antártica Chilen');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `referencias`
--

CREATE TABLE `referencias` (
  `IdRef` int(11) NOT NULL,
  `IdVot` int(11) NOT NULL,
  `CodRef` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `referencias`
--

INSERT INTO `referencias` (`IdRef`, `IdVot`, `CodRef`) VALUES
(1, 1, 1),
(2, 1, 2),
(5, 3, 2),
(6, 3, 3),
(7, 4, 3),
(8, 4, 4),
(9, 2, 2),
(10, 2, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `regions`
--

CREATE TABLE `regions` (
  `IdRegion` int(11) NOT NULL,
  `Region` varchar(45) NOT NULL,
  `Abbreviation` varchar(2) NOT NULL,
  `Capital` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `regions`
--

INSERT INTO `regions` (`IdRegion`, `Region`, `Abbreviation`, `Capital`) VALUES
(1, 'Arica y Parinacota', 'AP', 'Arica'),
(2, 'Tarapacá', 'TA', 'Iquique'),
(3, 'Antofagasta', 'AN', 'Antofagasta'),
(4, 'Atacama', 'AT', 'Copiapó'),
(5, 'Coquimbo', 'CO', 'La Serena'),
(6, 'Valparaiso', 'VA', 'valparaíso'),
(7, 'Metropolitana de Santiago', 'RM', 'Santiago'),
(8, 'Libertador General Bernardo O\'Higgins', 'OH', 'Rancagua'),
(9, 'Maule', 'MA', 'Talca'),
(10, 'Ñuble', 'NB', 'Chillán'),
(11, 'Biobío', 'BI', 'Concepción'),
(12, 'La Araucanía', 'IA', 'Temuco'),
(13, 'Los Ríos', 'LR', 'Valdivia'),
(14, 'Los Lagos', 'LL', 'Puerto Montt'),
(15, 'Aysén del General Carlos Ibáñez del Campo', 'AI', 'Coyhaique'),
(16, 'Magallanes y de la Antártica Chilena', 'MG', 'Punta Arenas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `votaciones`
--

CREATE TABLE `votaciones` (
  `IdVot` int(11) NOT NULL,
  `VotDNI` varchar(12) NOT NULL,
  `VotNombre` varchar(30) NOT NULL,
  `VotAlias` varchar(12) NOT NULL,
  `VotMail` varchar(30) NOT NULL,
  `IdCommunity` int(11) NOT NULL,
  `IdCand` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `votaciones`
--

INSERT INTO `votaciones` (`IdVot`, `VotDNI`, `VotNombre`, `VotAlias`, `VotMail`, `IdCommunity`, `IdCand`) VALUES
(1, '11111111-1', 'Marcela Pereira', 'Marce20', 'marce20@mail.com', 225, 4),
(2, '22222222-2', 'Luis Ponce', 'luis100', 'lponce@mail.com', 36, 2),
(3, '33333333-3', 'Antonella Ríos', 'Anto28', 'antorios.20@mail.com', 86, 1),
(4, '44444444-4', 'Luis Monsalve', 'Monsalv21', 'monsalv@mail.cl', 50, 4);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `candidatos`
--
ALTER TABLE `candidatos`
  ADD PRIMARY KEY (`IdCand`);

--
-- Indices de la tabla `communities`
--
ALTER TABLE `communities`
  ADD PRIMARY KEY (`IdCommunity`);

--
-- Indices de la tabla `provinces`
--
ALTER TABLE `provinces`
  ADD PRIMARY KEY (`IdProvince`);

--
-- Indices de la tabla `referencias`
--
ALTER TABLE `referencias`
  ADD PRIMARY KEY (`IdRef`);

--
-- Indices de la tabla `regions`
--
ALTER TABLE `regions`
  ADD PRIMARY KEY (`IdRegion`);

--
-- Indices de la tabla `votaciones`
--
ALTER TABLE `votaciones`
  ADD PRIMARY KEY (`IdVot`),
  ADD UNIQUE KEY `RUT` (`VotDNI`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `candidatos`
--
ALTER TABLE `candidatos`
  MODIFY `IdCand` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `communities`
--
ALTER TABLE `communities`
  MODIFY `IdCommunity` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=348;

--
-- AUTO_INCREMENT de la tabla `provinces`
--
ALTER TABLE `provinces`
  MODIFY `IdProvince` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT de la tabla `referencias`
--
ALTER TABLE `referencias`
  MODIFY `IdRef` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `regions`
--
ALTER TABLE `regions`
  MODIFY `IdRegion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `votaciones`
--
ALTER TABLE `votaciones`
  MODIFY `IdVot` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
