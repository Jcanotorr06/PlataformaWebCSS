-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.21-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for view csss.administrar_clinicas
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `administrar_clinicas` (
	`id` INT(11) NOT NULL,
	`clinica` VARCHAR(255) NULL COLLATE 'utf8mb4_general_ci',
	`corregimiento` VARCHAR(255) NULL COLLATE 'utf8mb4_general_ci',
	`distrito` VARCHAR(255) NULL COLLATE 'utf8mb4_general_ci',
	`provincia` VARCHAR(255) NULL COLLATE 'utf8mb4_general_ci',
	`id_corregimiento` INT(11) NULL,
	`id_distrito` INT(11) NULL,
	`id_provincia` INT(11) NULL
) ENGINE=MyISAM;

-- Dumping structure for view csss.administrar_especialidades
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `administrar_especialidades` (
	`id` INT(11) NOT NULL,
	`especialidad` VARCHAR(255) NULL COLLATE 'utf8mb4_general_ci'
) ENGINE=MyISAM;

-- Dumping structure for view csss.administrar_medicos
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `administrar_medicos` (
	`id` INT(11) NOT NULL,
	`nombre` VARCHAR(255) NULL COLLATE 'utf8mb4_general_ci',
	`apellido` VARCHAR(255) NULL COLLATE 'utf8mb4_general_ci',
	`cedula` VARCHAR(255) NULL COLLATE 'utf8mb4_general_ci',
	`email` VARCHAR(255) NULL COLLATE 'utf8mb4_general_ci',
	`contraseña` VARCHAR(255) NULL COLLATE 'utf8mb4_general_ci',
	`especialidad` VARCHAR(255) NULL COLLATE 'utf8mb4_general_ci',
	`clinica` VARCHAR(255) NULL COLLATE 'utf8mb4_general_ci',
	`duracion_citas` INT(11) NOT NULL,
	`id_especialidad` INT(11) NOT NULL,
	`id_clinica` INT(11) NOT NULL
) ENGINE=MyISAM;

-- Dumping structure for view csss.administrar_pacientes
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `administrar_pacientes` (
	`id` INT(11) NOT NULL,
	`nombre` VARCHAR(255) NULL COLLATE 'utf8mb4_general_ci',
	`apellido` VARCHAR(255) NULL COLLATE 'utf8mb4_general_ci',
	`cedula` VARCHAR(255) NULL COLLATE 'utf8mb4_general_ci',
	`email` VARCHAR(255) NULL COLLATE 'utf8mb4_general_ci',
	`contraseña` VARCHAR(255) NULL COLLATE 'utf8mb4_general_ci'
) ENGINE=MyISAM;

-- Dumping structure for procedure csss.agendar_cita
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `agendar_cita`(
	IN `id_usuario_sesion` INT,
	IN `id_medico_sesion` INT,
	IN `fecha_sesion` DATE,
	IN `hora_sesion` TIME


)
BEGIN
	INSERT INTO citas(id_usuario, id_medico, fecha, hora, id_estado)
	VALUES(id_usuario_sesion, id_medico_sesion, fecha_sesion, hora_sesion, 1);
END//
DELIMITER ;

-- Dumping structure for procedure csss.añadir_medico
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `añadir_medico`(
	IN `nombre_in` VARCHAR(50),
	IN `apellido_in` VARCHAR(50),
	IN `cedula_in` VARCHAR(15),
	IN `email_in` VARCHAR(255),
	IN `contraseña_in` VARCHAR(255),
	IN `id_especialidad_in` INT,
	IN `id_clinica_in` INT
,
	IN `duracion_in` INT



)
BEGIN
	INSERT INTO usuarios(nombre, apellido, cedula, email, contraseña, id_rol)
	VALUES(nombre_in, apellido_in, cedula_in, email_in, contraseña_in, 3);
	
	INSERT INTO medicos(id_usuario, id_especialidad, id_clinica, duracion_citas)
	VALUES((SELECT usu.id FROM usuarios as usu WHERE usu.cedula = cedula_in), id_especialidad_in, id_clinica_in, duracion_in);
END//
DELIMITER ;

-- Dumping structure for procedure csss.check_usuario_existe
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `check_usuario_existe`(
	IN `cedula_in` VARCHAR(15),
	IN `email_in` VARCHAR(255)

)
BEGIN
	SELECT EXISTS(SELECT * FROM usuarios WHERE usuarios.cedula = cedula_in OR usuarios.email = email_in) as existe;
END//
DELIMITER ;

-- Dumping structure for table csss.citas
CREATE TABLE IF NOT EXISTS `citas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) NOT NULL,
  `id_medico` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `id_estado` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  UNIQUE KEY `fecha_hora` (`fecha`,`hora`),
  KEY `citas_ibfk_1` (`id_usuario`),
  KEY `citas_ibfk_2` (`id_medico`),
  KEY `citas_ibfk_3` (`id_estado`),
  CONSTRAINT `citas_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `citas_ibfk_2` FOREIGN KEY (`id_medico`) REFERENCES `medicos` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `citas_ibfk_3` FOREIGN KEY (`id_estado`) REFERENCES `estados` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table csss.citas: ~3 rows (approximately)
/*!40000 ALTER TABLE `citas` DISABLE KEYS */;
INSERT INTO `citas` (`id`, `id_usuario`, `id_medico`, `fecha`, `hora`, `id_estado`) VALUES
	(8, 10, 3, '2022-01-27', '17:00:00', 1),
	(10, 10, 5, '2022-02-10', '19:00:00', 1),
	(11, 10, 5, '2022-01-12', '07:00:00', 1);
/*!40000 ALTER TABLE `citas` ENABLE KEYS */;

-- Dumping structure for table csss.clinicas
CREATE TABLE IF NOT EXISTS `clinicas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `clinica` varchar(255) DEFAULT NULL,
  `id_corregimiento` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_corregimiento` (`id_corregimiento`),
  CONSTRAINT `clinicas_ibfk_1` FOREIGN KEY (`id_corregimiento`) REFERENCES `corregimientos` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table csss.clinicas: ~23 rows (approximately)
/*!40000 ALTER TABLE `clinicas` DISABLE KEYS */;
INSERT INTO `clinicas` (`id`, `clinica`, `id_corregimiento`) VALUES
	(1, 'Policlínica Presidente Remón', 190),
	(2, 'Policlínica Dr. Manuel Ferrer Valdés', 193),
	(3, 'Policlínica Lic. Manuel María Valdés', 208),
	(4, 'Policlínica Don Alejandro De La Guardia Hijo', 191),
	(5, 'Policlínica Don Joaquín José Vallarino', 198),
	(6, 'Policlínica Don Generoso Guardia', 209),
	(7, 'Policlínica Dr. Santiago Barraza', 229),
	(8, 'Policlínica Dr. Blas Gómez Chetro', 213),
	(9, 'Policlínica Dr. Juan Vega Méndez ', 233),
	(10, 'Policlínica de Cañitas', 182),
	(11, 'Policlínica Dr. Miguel Cárdenas Barahona ', 157),
	(12, 'Policlínica San Juan de Dios ', 166),
	(13, 'Policlínica Dr. Roberto Ramírez De Diego', 133),
	(14, 'Policlínica Hospital de Sabanitas', 105),
	(15, 'Policlínica Dr. Hugo Spadafora', 106),
	(16, 'Policlínica Dr. Manuel De Jesús Rojas', 82),
	(17, 'Policlínica San Juan De Dios', 95),
	(18, 'Policlínica Dr. Manuel Paulino Ocaña', 101),
	(19, 'Policlínica Dr. Horacio Díaz Gómez', 268),
	(20, 'Policlínica Especializada Dr. Gustavo Adolfo Ross', 61),
	(21, 'Policlínica Especializada Dr. Pablo Espinosa', 50),
	(22, 'Policlínica Básica Dr. Ernesto Perez Balladares', 46),
	(23, 'Policlínica Básica de Divalá', 28);
/*!40000 ALTER TABLE `clinicas` ENABLE KEYS */;

-- Dumping structure for table csss.corregimientos
CREATE TABLE IF NOT EXISTS `corregimientos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `corregimiento` varchar(255) DEFAULT NULL,
  `id_distrito` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_distrito` (`id_distrito`),
  CONSTRAINT `corregimientos_ibfk_1` FOREIGN KEY (`id_distrito`) REFERENCES `distritos` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=276 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table csss.corregimientos: ~274 rows (approximately)
/*!40000 ALTER TABLE `corregimientos` DISABLE KEYS */;
INSERT INTO `corregimientos` (`id`, `corregimiento`, `id_distrito`) VALUES
	(1, 'Almirante', 1),
	(2, 'Bajo Culubre', 1),
	(3, 'Barriada Guatmi', 1),
	(4, 'Barrio Francés', 1),
	(5, 'Cauchero', 1),
	(6, 'Ceiba', 1),
	(7, 'Miraflores', 1),
	(8, 'Nance de Riscó', 1),
	(9, 'Valle de Aguas Arriba', 1),
	(10, 'Valle de Riscó', 1),
	(11, 'Bastimentos', 2),
	(12, 'Bocas del Toro', 2),
	(13, 'Boca del Drago', 2),
	(14, 'Punta Laurel', 2),
	(15, 'Tierra Oscura', 2),
	(16, 'San Cristobal', 2),
	(17, 'Changuinola', 4),
	(18, 'Cochigro', 4),
	(19, 'El Empalme', 4),
	(20, 'El Silencio', 4),
	(21, 'Las Tablas', 4),
	(22, 'La Mesa', 4),
	(23, 'La Gloria', 4),
	(24, 'Bajo Cedro', 5),
	(25, 'Chiriquí Grande', 5),
	(26, 'Miramar', 5),
	(27, 'Alanje', 6),
	(28, 'Divalá', 6),
	(29, 'Canta Gallo', 6),
	(30, 'El Tejar', 6),
	(31, 'Nuevo México', 6),
	(32, 'Palo Grnde', 6),
	(33, 'Santo Tomás', 6),
	(34, 'Baco', 7),
	(35, 'Limones', 7),
	(36, 'Progreso', 7),
	(37, 'Puerto Armuelles', 7),
	(38, 'El Palmar', 7),
	(39, 'Bálaga', 8),
	(40, 'Boquerón', 8),
	(41, 'Cordillera', 8),
	(42, 'Guayabal', 8),
	(43, 'Paraiso', 8),
	(44, 'Pedregal', 8),
	(45, 'Alto Boquete', 9),
	(46, 'Bajo Boquete', 9),
	(47, 'Caldera', 9),
	(48, 'Jaramillo', 9),
	(49, 'Palmira', 9),
	(50, 'Bugaba', 10),
	(51, 'El Bongo', 10),
	(52, 'La Concepción', 10),
	(53, 'San Andrés', 10),
	(54, 'Santa Marta', 10),
	(55, 'San Isidro', 10),
	(56, 'Cochea', 11),
	(57, 'Chiriquí', 11),
	(58, 'Guacá', 11),
	(59, 'Pedregal', 11),
	(60, 'San Carlos', 11),
	(61, 'David', 11),
	(62, 'Dolega', 12),
	(63, 'Potrerillos', 12),
	(64, 'Gualaca', 14),
	(65, 'Hornito', 14),
	(66, 'Remedios', 15),
	(67, 'El Porvenir', 15),
	(68, 'Santa Lucia', 15),
	(69, 'Dominical', 16),
	(70, 'Santa Clara', 16),
	(71, 'Las Lajas', 17),
	(72, 'San Félix', 17),
	(73, 'San Lorenzo', 18),
	(74, 'Boca del Monte', 18),
	(75, 'Volcán', 19),
	(76, 'Cerro Punta', 19),
	(77, 'Nueva California', 19),
	(78, 'Bella Vista', 20),
	(79, 'El Cristo', 20),
	(80, 'Lajas de Tolé', 20),
	(81, 'Tolé', 20),
	(82, 'Aguadulce', 21),
	(83, 'El Cristo', 21),
	(84, 'El Roble', 21),
	(85, 'Pocrí', 21),
	(86, 'Virgen del Carmen', 21),
	(87, 'Antón', 22),
	(88, 'Caballero', 22),
	(89, 'El Valle', 22),
	(90, 'Juan Díaz', 22),
	(91, 'Rio Hato', 22),
	(92, 'El Harino', 23),
	(93, 'La Pintada', 23),
	(94, 'Las Lomas', 23),
	(95, 'Natá', 24),
	(96, 'Toza', 24),
	(97, 'El Palmar', 25),
	(98, 'Olá', 25),
	(99, 'Coclé', 26),
	(100, 'Chiriquí Arriba', 26),
	(101, 'Penonomé', 26),
	(102, 'Rio Grande', 26),
	(103, 'Buena Vista', 28),
	(104, 'Cristóbal', 28),
	(105, 'Sabanitas', 28),
	(106, 'Colón', 28),
	(107, 'Barrio Norte', 28),
	(108, 'Barrio Sur', 28),
	(109, 'Nueva Providencia', 28),
	(110, 'Puerto Pilón', 28),
	(111, 'Salamanca', 28),
	(112, 'Achiote', 27),
	(113, 'Nuevo Chagres', 27),
	(114, 'El Guabo', 27),
	(115, 'Coclé del Norte', 29),
	(116, 'Miguel de la Borda', 29),
	(117, 'Gobea', 29),
	(118, 'Rio Indio', 29),
	(119, 'Cacique', 30),
	(120, 'Garrote', 30),
	(121, 'Isla Grande', 30),
	(122, 'Portobelo', 30),
	(123, 'Miramar', 31),
	(124, 'Nombre de Dios', 31),
	(125, 'Santa Isabel', 31),
	(126, 'Palenque', 31),
	(127, 'Chepigana', 32),
	(128, 'La Palma', 32),
	(129, 'El Real de Santa María', 33),
	(130, 'Pinogana', 33),
	(131, 'Santa Fe', 34),
	(132, 'Agua Fría', 34),
	(133, 'Chitré', 35),
	(134, 'La Arena', 35),
	(135, 'Llano Bonito', 35),
	(136, 'Monagrillo', 35),
	(137, 'San Juan Bautista', 35),
	(138, 'Chepo', 36),
	(139, 'Las Minas', 36),
	(140, 'Chumical', 36),
	(141, 'El Capurí', 37),
	(142, 'El Cedro', 37),
	(143, 'Los Pozos', 37),
	(144, 'La Arena', 37),
	(145, 'Cerro Largo', 38),
	(146, 'Llano Grande', 38),
	(147, 'Ocú', 38),
	(148, 'Cabuya', 39),
	(149, 'Parita', 39),
	(150, 'Portobelillo', 39),
	(151, 'El Barrero', 40),
	(152, 'Pesé', 40),
	(153, 'Santa María', 41),
	(154, 'Guararé', 42),
	(155, 'El Espinal', 42),
	(156, 'El Hato', 42),
	(157, 'Las Tablas', 44),
	(158, 'Bayano', 44),
	(159, 'La Laja', 44),
	(160, 'La Miel', 44),
	(161, 'La Palma', 44),
	(162, 'San Miguel', 44),
	(163, 'Santo Domingo', 44),
	(164, 'Las Cruces', 43),
	(165, 'Los Olivos', 43),
	(166, 'La Villa de los Santos', 43),
	(167, 'Agua Buena', 43),
	(168, 'El Cedro', 45),
	(169, 'Macaracas', 45),
	(170, 'La Mesa', 45),
	(171, 'Mariabé', 46),
	(172, 'Pedasí', 46),
	(173, 'Paraiso', 47),
	(174, 'Lajamina', 47),
	(175, 'Pocrí', 47),
	(176, 'Cañas', 48),
	(177, 'Flores', 48),
	(178, 'Tonosí', 48),
	(179, 'Saboga', 49),
	(180, 'San Miguel', 49),
	(181, 'La Esmeralda', 49),
	(182, 'Cañita', 50),
	(183, 'Chepillo', 50),
	(184, 'Chepo', 50),
	(185, 'El Llano', 50),
	(186, 'Brujas', 51),
	(187, 'Chimán', 51),
	(188, '24 de Diciembre', 52),
	(189, 'Alcalde Diaz', 52),
	(190, 'Ancón', 52),
	(191, 'Betania', 52),
	(192, 'Bella Vista', 52),
	(193, 'Calidonia', 52),
	(194, 'Chilibre', 52),
	(195, 'Curundú', 52),
	(196, 'Don Bosco', 52),
	(197, 'El Chorrillo', 52),
	(198, 'Juan Diaz', 52),
	(199, 'Las Cumbres', 52),
	(200, 'Pacora', 52),
	(201, 'Pedregal', 52),
	(202, 'Pueblo Nuevo', 52),
	(203, 'Rio Abajo', 52),
	(204, 'San Francisco', 52),
	(205, 'Tocumen', 52),
	(206, 'Panamá', 52),
	(207, 'Arnulfo Arias', 53),
	(208, 'San Miguelito', 53),
	(209, 'Omar Torrijos', 53),
	(210, 'Belisario Porras', 53),
	(211, 'Victoriano Lorenzo', 53),
	(212, 'Taboga', 54),
	(213, 'Arraiján', 55),
	(214, 'Burunga', 55),
	(215, 'Juan Demóstenes Arosemena', 55),
	(216, 'Veracruz', 55),
	(217, 'Caimito', 56),
	(218, 'Campana', 56),
	(219, 'Capira', 56),
	(220, 'Bejuco', 57),
	(221, 'Cabuya', 57),
	(222, 'Chame', 57),
	(223, 'Las Lajas', 57),
	(224, 'Nueva Gorgona', 57),
	(225, 'Punta Chame', 57),
	(226, 'Amador', 58),
	(227, 'Arosemena', 58),
	(228, 'Guadalupe', 58),
	(229, 'La Chorrera', 58),
	(230, 'Puerto Caimito', 58),
	(231, 'Santa Rita', 58),
	(232, 'Guayabito', 59),
	(233, 'San Carlos', 59),
	(234, 'La Laguna', 59),
	(235, 'Atalaya', 60),
	(236, 'San Antonio', 60),
	(237, 'Calobre', 61),
	(238, 'La Yeguada', 61),
	(239, 'La Raya de Calobre', 61),
	(240, 'Cañazas', 62),
	(241, 'Cerro de Plata', 62),
	(242, 'Los Valles', 62),
	(243, 'La Mesa', 63),
	(244, 'Los Milagros', 63),
	(245, 'Corozal', 64),
	(246, 'Las Palmas', 64),
	(247, 'Pixvae', 64),
	(248, 'Arenas', 65),
	(249, 'Mariato', 65),
	(250, 'El Cacao', 65),
	(251, 'Cébaco', 66),
	(252, 'Montijo', 66),
	(253, 'Pilón', 66),
	(254, 'Rio de Jesus', 67),
	(255, 'Los Castillo', 67),
	(256, 'Los Hatillos', 68),
	(257, 'San Francisco', 68),
	(258, 'San José', 68),
	(259, 'San Juan', 68),
	(260, 'Calovébora', 69),
	(261, 'El Alto', 69),
	(262, 'El Pantano', 69),
	(263, 'Gatuncito', 69),
	(265, 'Santa Fe', 69),
	(266, 'La Peña', 70),
	(267, 'Ponuga', 70),
	(268, 'Santiago', 70),
	(269, 'Urracá', 70),
	(270, 'Calidonia', 71),
	(271, 'Cativé', 71),
	(272, 'El Marañón', 71),
	(273, 'Rio Grande', 71),
	(274, 'Rodeo Viejo', 71),
	(275, 'Soná', 71);
/*!40000 ALTER TABLE `corregimientos` ENABLE KEYS */;

-- Dumping structure for procedure csss.crear_usuario
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `crear_usuario`(
	IN `nombre_in` VARCHAR(50),
	IN `apellido_in` VARCHAR(50),
	IN `cedula_in` VARCHAR(15),
	IN `email_in` VARCHAR(255),
	IN `contraseña_in` VARCHAR(255)
)
BEGIN
	INSERT INTO usuarios(nombre, apellido, cedula, email, contraseña, id_rol)
	VALUES(nombre_in, apellido_in, cedula_in, email_in, contraseña_in, 2);
END//
DELIMITER ;

-- Dumping structure for view csss.datos_generales
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `datos_generales` (
	`cant_pacientes` BIGINT(21) NULL,
	`cant_medicos` BIGINT(21) NULL,
	`cant_clinicas` BIGINT(21) NULL,
	`cant_especialidades` BIGINT(21) NULL
) ENGINE=MyISAM;

-- Dumping structure for table csss.dias
CREATE TABLE IF NOT EXISTS `dias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dia` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table csss.dias: ~7 rows (approximately)
/*!40000 ALTER TABLE `dias` DISABLE KEYS */;
INSERT INTO `dias` (`id`, `dia`) VALUES
	(1, 'Domingo'),
	(2, 'Lunes'),
	(3, 'Martes'),
	(4, 'Miercoles'),
	(5, 'Jueves'),
	(6, 'Viernes'),
	(7, 'Sabado');
/*!40000 ALTER TABLE `dias` ENABLE KEYS */;

-- Dumping structure for table csss.dias_libres
CREATE TABLE IF NOT EXISTS `dias_libres` (
  `id_medico` int(11) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  KEY `id_medico` (`id_medico`),
  CONSTRAINT `dias_libres_ibfk_1` FOREIGN KEY (`id_medico`) REFERENCES `medicos` (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table csss.dias_libres: ~2 rows (approximately)
/*!40000 ALTER TABLE `dias_libres` DISABLE KEYS */;
INSERT INTO `dias_libres` (`id_medico`, `fecha`) VALUES
	(3, '2021-11-29'),
	(5, '2021-12-08');
/*!40000 ALTER TABLE `dias_libres` ENABLE KEYS */;

-- Dumping structure for table csss.distritos
CREATE TABLE IF NOT EXISTS `distritos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `distrito` varchar(255) DEFAULT NULL,
  `id_provincia` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_provincia` (`id_provincia`),
  CONSTRAINT `distritos_ibfk_1` FOREIGN KEY (`id_provincia`) REFERENCES `provincias` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=72 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table csss.distritos: ~69 rows (approximately)
/*!40000 ALTER TABLE `distritos` DISABLE KEYS */;
INSERT INTO `distritos` (`id`, `distrito`, `id_provincia`) VALUES
	(1, 'Almirante', 1),
	(2, 'Bocas del Toro', 1),
	(4, 'Changuinola', 1),
	(5, 'Chiriquí Grande', 1),
	(6, 'Alanje', 4),
	(7, 'Barú', 4),
	(8, 'Boquerón', 4),
	(9, 'Boquete', 4),
	(10, 'Bugaba', 4),
	(11, 'David', 4),
	(12, 'Dolega', 4),
	(14, 'Gualaca', 4),
	(15, 'Remedios', 4),
	(16, 'Renacimiento', 4),
	(17, 'San Félix', 4),
	(18, 'San Lorenzo', 4),
	(19, 'Tierras Altas', 4),
	(20, 'Tolé', 4),
	(21, 'Aguadulce', 2),
	(22, 'Antón', 2),
	(23, 'La Pintada', 2),
	(24, 'Natá', 2),
	(25, 'Olá', 2),
	(26, 'Penonomé', 2),
	(27, 'Chagres', 3),
	(28, 'Colón', 3),
	(29, 'Donoso', 3),
	(30, 'Portobelo', 3),
	(31, 'Santa Isabel', 3),
	(32, 'Chepigana', 5),
	(33, 'Pinogana', 5),
	(34, 'Santa Fe', 5),
	(35, 'Chitré', 6),
	(36, 'Las Minas', 6),
	(37, 'Los Pozos', 6),
	(38, 'Ocú', 6),
	(39, 'Parita', 6),
	(40, 'Pesé', 6),
	(41, 'Santa María', 6),
	(42, 'Guararé', 7),
	(43, 'Los Santos', 7),
	(44, 'Las Tablas', 7),
	(45, 'Macaracas', 7),
	(46, 'Pedasí', 7),
	(47, 'Pocrí', 7),
	(48, 'Tonosí', 7),
	(49, 'Balboa', 8),
	(50, 'Chepo', 8),
	(51, 'Chimán', 8),
	(52, 'Panamá', 8),
	(53, 'San Miguelito', 8),
	(54, 'Taboga', 8),
	(55, 'Arraiján', 10),
	(56, 'Capira', 10),
	(57, 'Chame', 10),
	(58, 'La Chorrera', 10),
	(59, 'San Carlos', 10),
	(60, 'Atalaya', 9),
	(61, 'Calobré', 9),
	(62, 'Cañazas', 9),
	(63, 'La Mesa', 9),
	(64, 'Las Palmas', 9),
	(65, 'Mariato', 9),
	(66, 'Montijo', 9),
	(67, 'Río de Jesús', 9),
	(68, 'San Francisco', 9),
	(69, 'Santa Fe', 9),
	(70, 'Santiago', 9),
	(71, 'Soná', 9);
/*!40000 ALTER TABLE `distritos` ENABLE KEYS */;

-- Dumping structure for table csss.especialidades
CREATE TABLE IF NOT EXISTS `especialidades` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `especialidad` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table csss.especialidades: ~20 rows (approximately)
/*!40000 ALTER TABLE `especialidades` DISABLE KEYS */;
INSERT INTO `especialidades` (`id`, `especialidad`) VALUES
	(1, 'Psiquiatría'),
	(2, 'Geriatría'),
	(3, 'Pediatría'),
	(4, 'Patología'),
	(5, 'Dermatología'),
	(6, 'Urología'),
	(7, 'Oftalmología'),
	(8, 'Neurología'),
	(9, 'Reumatología'),
	(10, 'Otropedia'),
	(11, 'Hematología'),
	(12, 'Cardiología'),
	(13, 'Radiología'),
	(14, 'Oncología'),
	(15, 'Alergología'),
	(16, 'Gastroenterología'),
	(17, 'Reumatología'),
	(18, 'Neumología'),
	(19, 'Ginecología'),
	(20, 'Medicina General');
/*!40000 ALTER TABLE `especialidades` ENABLE KEYS */;

-- Dumping structure for table csss.estados
CREATE TABLE IF NOT EXISTS `estados` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `estado` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table csss.estados: ~2 rows (approximately)
/*!40000 ALTER TABLE `estados` DISABLE KEYS */;
INSERT INTO `estados` (`id`, `estado`) VALUES
	(1, 'activa'),
	(2, 'cancelada'),
	(3, 'cumplida');
/*!40000 ALTER TABLE `estados` ENABLE KEYS */;

-- Dumping structure for table csss.horario_medicos
CREATE TABLE IF NOT EXISTS `horario_medicos` (
  `id_medico` int(11) DEFAULT NULL,
  `id_dia` int(11) DEFAULT NULL,
  `hora_entrada` time DEFAULT NULL,
  `hora_salida` time DEFAULT NULL,
  KEY `horario_medicos_ibfk_1` (`id_medico`),
  KEY `horario_medicos_ibfk_2` (`id_dia`),
  CONSTRAINT `horario_medicos_ibfk_1` FOREIGN KEY (`id_medico`) REFERENCES `medicos` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `horario_medicos_ibfk_2` FOREIGN KEY (`id_dia`) REFERENCES `dias` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table csss.horario_medicos: ~10 rows (approximately)
/*!40000 ALTER TABLE `horario_medicos` DISABLE KEYS */;
INSERT INTO `horario_medicos` (`id_medico`, `id_dia`, `hora_entrada`, `hora_salida`) VALUES
	(3, 1, '05:00:00', '17:00:00'),
	(3, 4, '05:00:00', '17:00:00'),
	(3, 5, '07:00:00', '19:00:00'),
	(3, 6, '07:00:00', '19:00:00'),
	(3, 7, '07:00:00', '19:00:00'),
	(5, 2, '04:00:00', '16:00:00'),
	(5, 3, '04:00:00', '16:00:00'),
	(5, 4, '04:00:00', '16:00:00'),
	(5, 5, '10:00:00', '22:00:00'),
	(5, 6, '10:00:00', '22:00:00');
/*!40000 ALTER TABLE `horario_medicos` ENABLE KEYS */;

-- Dumping structure for procedure csss.iniciar_sesion
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `iniciar_sesion`(
	IN `cedula_in` VARCHAR(15)
)
BEGIN
	SELECT us.id as id, us.nombre as nombre, us.apellido as apellido, contraseña, roles.rol as rol 
	FROM usuarios as us 
	JOIN roles ON us.id_rol = roles.id 
	WHERE cedula=cedula_in 
	LIMIT 1;
END//
DELIMITER ;

-- Dumping structure for procedure csss.listar_citas_medico
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `listar_citas_medico`(
	IN `id_usuario_sesion` INT











)
BEGIN
	SELECT cit.id, CONCAT(us.nombre, " ",us.apellido) as nombre_paciente, us.cedula as cedula_paciente, lm.id as id_medico, lm.nombre as nombre_medico, lm.cedula as cedula_medico, esp.especialidad, cit.fecha, TIME_FORMAT(cit.hora, "%r") as hora, med.duracion_citas as duracion, pro.provincia, dis.distrito, cor.corregimiento, cli.clinica
	FROM citas AS cit
	JOIN usuarios AS us ON us.id = cit.id_usuario
	JOIN medicos AS med ON med.id_usuario = cit.id_medico
	JOIN especialidades AS esp ON esp.id = med.id_especialidad
	JOIN clinicas AS cli ON cli.id = med.id_clinica
	JOIN listar_medicos AS lm ON lm.id = med.id_usuario
	JOIN corregimientos AS cor ON cor.id = cli.id_corregimiento
	JOIN distritos AS dis ON dis.id = cor.id_distrito
	JOIN provincias AS pro ON pro.id = dis.id_provincia
	WHERE cit.id_medico = id_usuario_sesion
	OR cit.id_usuario = id_usuario_sesion;
END//
DELIMITER ;

-- Dumping structure for procedure csss.listar_citas_paciente
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `listar_citas_paciente`(
	IN `id_usuario_sesion` INT








)
BEGIN
	SELECT cit.id, CONCAT(us.nombre, " ",us.apellido) as nombre_paciente, us.cedula as cedula_paciente, lm.id as id_medico, lm.nombre as nombre_medico, lm.cedula as cedula_medico, esp.especialidad, cit.fecha, TIME_FORMAT(cit.hora, "%r") as hora, pro.provincia, dis.distrito, cor.corregimiento, cli.clinica
	FROM citas AS cit
	JOIN usuarios AS us ON us.id = cit.id_usuario
	JOIN medicos AS med ON med.id_usuario = cit.id_medico
	JOIN especialidades AS esp ON esp.id = med.id_especialidad
	JOIN clinicas AS cli ON cli.id = med.id_clinica
	JOIN listar_medicos AS lm ON lm.id = med.id_usuario
	JOIN corregimientos AS cor ON cor.id = cli.id_corregimiento
	JOIN distritos AS dis ON dis.id = cor.id_distrito
	JOIN provincias AS pro ON pro.id = dis.id_provincia
	WHERE us.id = id_usuario_sesion;
END//
DELIMITER ;

-- Dumping structure for view csss.listar_clinicas_validas
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `listar_clinicas_validas` (
	`id` INT(11) NOT NULL,
	`clinica` VARCHAR(255) NULL COLLATE 'utf8mb4_general_ci',
	`id_corregimiento` INT(11) NULL
) ENGINE=MyISAM;

-- Dumping structure for view csss.listar_corregimientos_validos
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `listar_corregimientos_validos` (
	`id` INT(11) NOT NULL,
	`corregimiento` VARCHAR(255) NULL COLLATE 'utf8mb4_general_ci',
	`id_distrito` INT(11) NULL
) ENGINE=MyISAM;

-- Dumping structure for procedure csss.listar_datos_usuario
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `listar_datos_usuario`(
	IN `cedula_in` VARCHAR(13)

)
BEGIN
	SELECT usu.id, usu.nombre, usu.email, usu.cedula  FROM usuarios as usu
	WHERE usu.cedula = cedula_in;
END//
DELIMITER ;

-- Dumping structure for view csss.listar_distritos_validos
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `listar_distritos_validos` (
	`id` INT(11) NOT NULL,
	`distrito` VARCHAR(255) NULL COLLATE 'utf8mb4_general_ci',
	`id_provincia` INT(11) NULL
) ENGINE=MyISAM;

-- Dumping structure for view csss.listar_especialidades_clinica
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `listar_especialidades_clinica` (
	`id` INT(11) NOT NULL,
	`especialidad` VARCHAR(255) NULL COLLATE 'utf8mb4_general_ci',
	`id_clinica` INT(11) NOT NULL
) ENGINE=MyISAM;

-- Dumping structure for procedure csss.listar_horas_habiles
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `listar_horas_habiles`(
	IN `id_medico_selec` INT


)
BEGIN
	select med.id, dia.id as id_dia, dia, hora_entrada, hora_salida, med.duracion_citas 
	FROM horario_medicos as hor
	JOIN dias as dia on hor.id_dia = dia.id
	JOIN listar_medicos as med on med.id = hor.id_medico
	WHERE med.id = id_medico_selec
	ORDER BY dia.id;
END//
DELIMITER ;

-- Dumping structure for view csss.listar_medicos
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `listar_medicos` (
	`id` INT(11) NOT NULL,
	`nombre` VARCHAR(511) NULL COLLATE 'utf8mb4_general_ci',
	`email` VARCHAR(255) NULL COLLATE 'utf8mb4_general_ci',
	`cedula` VARCHAR(255) NULL COLLATE 'utf8mb4_general_ci',
	`id_especialidad` INT(11) NOT NULL,
	`id_clinica` INT(11) NULL,
	`duracion_citas` INT(11) NOT NULL
) ENGINE=MyISAM;

-- Dumping structure for view csss.listar_provincias_validas
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `listar_provincias_validas` (
	`id` INT(11) NOT NULL,
	`provincia` VARCHAR(255) NULL COLLATE 'utf8mb4_general_ci'
) ENGINE=MyISAM;

-- Dumping structure for table csss.medicos
CREATE TABLE IF NOT EXISTS `medicos` (
  `id_usuario` int(11) NOT NULL,
  `id_especialidad` int(11) NOT NULL,
  `id_clinica` int(11) DEFAULT NULL,
  `duracion_citas` int(11) NOT NULL DEFAULT 60,
  PRIMARY KEY (`id_usuario`,`id_especialidad`),
  KEY `id_especialidad` (`id_especialidad`),
  KEY `medicos_ibfk_3` (`id_clinica`),
  CONSTRAINT `medicos_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `medicos_ibfk_2` FOREIGN KEY (`id_especialidad`) REFERENCES `especialidades` (`id`),
  CONSTRAINT `medicos_ibfk_3` FOREIGN KEY (`id_clinica`) REFERENCES `clinicas` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table csss.medicos: ~2 rows (approximately)
/*!40000 ALTER TABLE `medicos` DISABLE KEYS */;
INSERT INTO `medicos` (`id_usuario`, `id_especialidad`, `id_clinica`, `duracion_citas`) VALUES
	(3, 8, 5, 60),
	(5, 20, 3, 60);
/*!40000 ALTER TABLE `medicos` ENABLE KEYS */;

-- Dumping structure for procedure csss.modificar_clinica
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `modificar_clinica`(
	IN `id_in` INT,
	IN `clinica_in` VARCHAR(255),
	IN `id_corregimiento_in` INT

)
BEGIN
		UPDATE clinicas
	SET
		clinica = clinica_in,
		id_corregimiento = id_corregimiento_in
	WHERE id = id_in;
END//
DELIMITER ;

-- Dumping structure for procedure csss.modificar_especialidad
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `modificar_especialidad`(
	IN `id_in` INT,
	IN `especialidad_in` VARCHAR(255)

)
BEGIN
	UPDATE especialidades
	SET
		especialidad = especialidad_in
	WHERE id = id_in;
END//
DELIMITER ;

-- Dumping structure for procedure csss.modificar_medico
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `modificar_medico`(
	IN `id_in` INT,
	IN `nombre_in` VARCHAR(50),
	IN `apellido_in` VARCHAR(50),
	IN `cedula_in` VARCHAR(15),
	IN `email_in` VARCHAR(255),
	IN `contraseña_in` VARCHAR(255),
	IN `id_especialidad_in` INT,
	IN `id_clinica_in` INT,
	IN `duracion_in` INT

)
BEGIN
	UPDATE usuarios
	SET
		nombre = nombre_in,
		apellido = apellido_in,
		cedula = cedula_in,
		email = email_in,
		contraseña = contraseña_in
	WHERE id = id_in;
	
	UPDATE medicos
	SET
		id_especialidad = id_especialidad_in,
		id_clinica = id_clinica_in,
		duracion_citas = duracion_in
	WHERE id_usuario = id_in;
END//
DELIMITER ;

-- Dumping structure for procedure csss.modificar_paciente
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `modificar_paciente`(
	IN `id_in` INT,
	IN `nombre_in` VARCHAR(50),
	IN `apellido_in` VARCHAR(50),
	IN `cedula_in` VARCHAR(15),
	IN `email_in` VARCHAR(255),
	IN `contraseña_in` VARCHAR(255)
)
BEGIN
		UPDATE usuarios
	SET
		nombre = nombre_in,
		apellido = apellido_in,
		cedula = cedula_in,
		email = email_in,
		contraseña = contraseña_in
	WHERE id = id_in;
END//
DELIMITER ;

-- Dumping structure for table csss.provincias
CREATE TABLE IF NOT EXISTS `provincias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `provincia` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table csss.provincias: ~10 rows (approximately)
/*!40000 ALTER TABLE `provincias` DISABLE KEYS */;
INSERT INTO `provincias` (`id`, `provincia`) VALUES
	(1, 'Bocas del Toro'),
	(2, 'Coclé'),
	(3, 'Colón'),
	(4, 'Chiriquí'),
	(5, 'Darién'),
	(6, 'Herrera'),
	(7, 'Los Santos'),
	(8, 'Panamá'),
	(9, 'Veraguas'),
	(10, 'Panamá Oeste');
/*!40000 ALTER TABLE `provincias` ENABLE KEYS */;

-- Dumping structure for table csss.recuperar_contraseña
CREATE TABLE IF NOT EXISTS `recuperar_contraseña` (
  `id_usuario` int(11) NOT NULL,
  `llave` varchar(255) NOT NULL,
  `expira` datetime DEFAULT NULL,
  PRIMARY KEY (`id_usuario`,`llave`),
  CONSTRAINT `recuperar_contraseña_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table csss.recuperar_contraseña: ~2 rows (approximately)
/*!40000 ALTER TABLE `recuperar_contraseña` DISABLE KEYS */;
INSERT INTO `recuperar_contraseña` (`id_usuario`, `llave`, `expira`) VALUES
	(10, 'e30f2af599d706a29a5d620d11c582bad333a1c68918f37ef9b6f7404f3876b2', '2021-12-02 15:32:01'),
	(17, '1389821668fdfea624a22efbdcace2012fce815fc92946d16571fb07966e1982', '2021-12-02 06:35:18');
/*!40000 ALTER TABLE `recuperar_contraseña` ENABLE KEYS */;

-- Dumping structure for procedure csss.reprogramar_cita
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `reprogramar_cita`(
	IN `id_in` INT,
	IN `fecha_in` DATE,
	IN `hora_in` TIME
)
BEGIN
	UPDATE citas
	SET
		fecha = fecha_in,
		hora = hora_in
	WHERE id = id_in;
END//
DELIMITER ;

-- Dumping structure for table csss.roles
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rol` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table csss.roles: ~2 rows (approximately)
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` (`id`, `rol`) VALUES
	(1, 'admin'),
	(2, 'paciente'),
	(3, 'medico');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;

-- Dumping structure for table csss.usuarios
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) DEFAULT NULL,
  `apellido` varchar(255) DEFAULT NULL,
  `cedula` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `contraseña` varchar(255) DEFAULT NULL,
  `id_rol` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `cedula` (`cedula`),
  UNIQUE KEY `email` (`email`),
  KEY `id_rol` (`id_rol`),
  CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`id_rol`) REFERENCES `roles` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table csss.usuarios: ~12 rows (approximately)
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` (`id`, `nombre`, `apellido`, `cedula`, `email`, `contraseña`, `id_rol`) VALUES
	(1, 'Joseph', 'Cano', 'admin', 'admin@email.com', '$2y$10$24GsbyosJcY146/dh6nKPOujwHNgsYUiyh.jF5tADhP9R/9.RnbJK', 1),
	(3, 'Yaneth', 'Caceres', '4-222-193', 'yaneth.caceres@css.pa', '$2y$10$24GsbyosJcY146/dh6nKPOujwHNgsYUiyh.jF5tADhP9R/9.RnbJK', 3),
	(4, 'John', 'Stavros', '7-441-22', 'dobeh22641@d3ff.com', '$2y$10$bgMbTi0zKoXrK.semDYuMedY9y2LHDTnwhhFEgdCI4lrdOiBm6Y7y', 2),
	(5, 'Peter', 'Park', '1-234-5678', 'peter.park@css.pa', '$2y$10$UViVtx.KJDgf2vgkkJsIjOrXIj.eDOjcTRmc150FDM2JMkSBiuC0.', 3),
	(8, 'Bruce', 'Geene', '4-5121--798', 'hijibo1571@terasd.com', '$2y$10$zAoKNnDbD9q.sA7kx2glieKF90ViwA3Abpvqlcx58XgQBIfKry0Q6', 2),
	(10, 'Joseph', 'Cano', '8-971-2154', 'joseph.cano@utp.ac.pa', '$2y$10$hkZQLV/ARI6pH5mAE9JYhOQqMHrI4kWdcq58vG401BZTf8wZPpwKS', 2),
	(11, 'Elisse', 'Williams', '10-1112-1314', 'xajenop924@simdpi.com', '$2y$10$q.TG.pf62xHgfDn9duMLJegckDB0U3xi9m8NgiYHSvwrE8YeslGZC', 2),
	(13, 'Lawrence', 'Santa', '9-899-9889', 'yijerew969@slvlog.com', '$2y$10$ydW78iJ6pXgvkczSJGRATOxTmRr4eIcGuu7GEEdwZmsO0svvgzXyC', 2),
	(14, 'Matt', 'Peak', '2-0010-911', 'halkccbqyatp@xojxe.com', '$2y$10$gHuTfq2e08QTj7HoQu.8De.kU4NH6BTCVvyZux0SWvNhJp9M1cxkS', 2),
	(15, 'Amy', 'Adams', '7-1244-6592', 'soroji1058@terasd.com', '$2y$10$f0sQqlX9hmjuLAWCRqXI/.eD4bw1eVuVV.3O/siYNc/TiOcf108ha', 2),
	(16, 'Dude', 'Soup', '9-712-1548', 'jatojen779@simdpi.com', '$2y$10$jenbHq.SKuioNVfQIRHsHupbeIrd0Oj2A5swi3Zb4/V/WxmnaI48G', 2),
	(17, 'Nick', 'Evers', '2-154-8971', 'yiyodow257@suggerin.com', '$2y$10$VvH/ChRH9D88gN3Zs57cLOKgS5W.HSh5U8JLf5L4UBoV3AKMLokny', 2);
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;

-- Dumping structure for procedure csss.validar_recuperar_contraseña
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `validar_recuperar_contraseña`(
	IN `llave_in` VARCHAR(255)

)
BEGIN
	SELECT usu.id, usu.cedula 
	FROM recuperar_contraseña as rec
	JOIN usuarios as usu on usu.id = rec.id_usuario
	WHERE expira > NOW()
	AND rec.llave = llave_in
	LIMIT 1;
END//
DELIMITER ;

-- Dumping structure for view csss.administrar_clinicas
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `administrar_clinicas`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` VIEW `administrar_clinicas` AS SELECT cli.id, cli.clinica, cor.corregimiento, dis.distrito, pro.provincia, cli.id_corregimiento, cor.id_distrito, dis.id_provincia
FROM clinicas as cli
JOIN corregimientos as cor on cor.id = cli.id_corregimiento
JOIN distritos as dis on dis.id = cor.id_distrito
JOIN provincias as pro on pro.id = dis.id_provincia ;

-- Dumping structure for view csss.administrar_especialidades
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `administrar_especialidades`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` VIEW `administrar_especialidades` AS SELECT * FROM especialidades ;

-- Dumping structure for view csss.administrar_medicos
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `administrar_medicos`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` VIEW `administrar_medicos` AS SELECT 
	usu.id, usu.nombre, usu.apellido, usu.cedula, usu.email, usu.contraseña, esp.especialidad, cli.clinica, med.duracion_citas, esp.id as id_especialidad, cli.id as id_clinica
FROM usuarios AS usu 
	JOIN medicos AS med ON usu.id = med.id_usuario
	JOIN especialidades AS esp ON esp.id = med.id_especialidad
	JOIN clinicas AS cli ON cli.id = med.id_clinica
	WHERE usu.id_rol = 3 ;

-- Dumping structure for view csss.administrar_pacientes
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `administrar_pacientes`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` VIEW `administrar_pacientes` AS SELECT id, nombre, apellido, cedula, email, contraseña FROM usuarios
WHERE usuarios.id_rol = 2 ;

-- Dumping structure for view csss.datos_generales
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `datos_generales`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` VIEW `datos_generales` AS SELECT 
	(SELECT COUNT(*) FROM usuarios WHERE usuarios.id_rol = 2) as cant_pacientes,
	(SELECT COUNT(*) FROM usuarios WHERE usuarios.id_rol = 3) as cant_medicos,
	(SELECT COUNT(*) FROM clinicas) as cant_clinicas,
	(SELECT COUNT(*) FROM especialidades) as cant_especialidades ;

-- Dumping structure for view csss.listar_clinicas_validas
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `listar_clinicas_validas`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` VIEW `listar_clinicas_validas` AS SELECT DISTINCT cli.id, cli.clinica, cli.id_corregimiento from clinicas as cli
JOIN listar_medicos as med on cli.id = med.id_clinica ;

-- Dumping structure for view csss.listar_corregimientos_validos
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `listar_corregimientos_validos`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` VIEW `listar_corregimientos_validos` AS SELECT DISTINCT cor.id, cor.corregimiento, cor.id_distrito from corregimientos as cor
JOIN listar_clinicas_validas as cli on cli.id_corregimiento = cor.id ;

-- Dumping structure for view csss.listar_distritos_validos
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `listar_distritos_validos`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` VIEW `listar_distritos_validos` AS SELECT DISTINCT dis.id, dis.distrito, dis.id_provincia from distritos as dis
JOIN listar_corregimientos_validos as cor on dis.id = cor.id_distrito ;

-- Dumping structure for view csss.listar_especialidades_clinica
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `listar_especialidades_clinica`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` VIEW `listar_especialidades_clinica` AS SELECT DISTINCT esp.id, esp.especialidad, cli.id as id_clinica from especialidades as esp
JOIN medicos as med on esp.id = med.id_especialidad
JOIN clinicas as cli on cli.id = med.id_clinica ;

-- Dumping structure for view csss.listar_medicos
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `listar_medicos`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` VIEW `listar_medicos` AS SELECT usu.id, CONCAT(usu.nombre, " ", usu.apellido) as nombre, usu.email, usu.cedula, med.id_especialidad, med.id_clinica, med.duracion_citas
FROM usuarios as usu
JOIN medicos as med on med.id_usuario = usu.id ;

-- Dumping structure for view csss.listar_provincias_validas
-- Removing temporary table and create final VIEW structure
DROP TABLE IF EXISTS `listar_provincias_validas`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` VIEW `listar_provincias_validas` AS SELECT DISTINCT pro.id, pro.provincia from provincias as pro
JOIN listar_distritos_validos as dis on pro.id = dis.id_provincia ;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
