-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-01-2016 a las 18:05:38
-- Versión del servidor: 5.6.16
-- Versión de PHP: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `research_observatory`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `academic_groups`
--

CREATE TABLE IF NOT EXISTS `academic_groups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned DEFAULT NULL,
  `name` varchar(100) DEFAULT '',
  `description` text,
  `level` enum('En formación','En consolidación','Consolidado') NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `member_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `academic_groups`
--

INSERT INTO `academic_groups` (`id`, `user_id`, `name`, `description`, `level`, `created`, `modified`) VALUES
(3, 3, 'Cuerpo de Prueba', 'Test', 'En formación', '2015-10-29 22:32:31', '2015-12-22 23:01:21'),
(4, 2, 'Cuerpo 2', 'Cuerpo de prueba número 2', 'En formación', '2015-12-22 23:04:32', '2015-12-22 23:04:32');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `advertisements`
--

CREATE TABLE IF NOT EXISTS `advertisements` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` text,
  `url` varchar(1000) NOT NULL,
  `expiration_date` date NOT NULL,
  `file_path` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `advertisements`
--

INSERT INTO `advertisements` (`id`, `name`, `description`, `url`, `expiration_date`, `file_path`) VALUES
(1, 'Anunncio 1', 'Descripción de anuncio 1', 'http://foundation.zurb.com', '2016-01-08', '/files/advertisements/satelite-orbit.jpg'),
(2, 'Otro', 'inche descripción', 'http://google.com', '2016-01-08', '/files/advertisements/onstar-logo.png'),
(3, 'asd', 'asdasdasdasd', '', '2016-01-08', '/files/advertisements/onstar-icon.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `experiences`
--

CREATE TABLE IF NOT EXISTS `experiences` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `member_id` int(10) unsigned NOT NULL,
  `institution_id` int(10) unsigned NOT NULL,
  `activities` text,
  `from_date` date DEFAULT NULL,
  `to_date` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `member_id` (`member_id`),
  KEY `institution_id` (`institution_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `institutions`
--

CREATE TABLE IF NOT EXISTS `institutions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `links`
--

CREATE TABLE IF NOT EXISTS `links` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `display_name` varchar(100) NOT NULL,
  `url` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `links`
--

INSERT INTO `links` (`id`, `name`, `display_name`, `url`) VALUES
(1, 'UAEM', 'Aviso de Privacidad', 'http://www.uaemex.mx/avisos/Aviso_Privacidad.pdf'),
(2, 'DT', 'Directorio Telefónico', 'http://desarrollo.uaemex.mx/directorios'),
(3, 'GU', 'Gaceta Universitaria', 'http://www.uaemex.mx/gaceta/');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `members`
--

CREATE TABLE IF NOT EXISTS `members` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `name` varchar(50) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `address` varchar(150) DEFAULT '',
  `telephone` varchar(20) DEFAULT '',
  `additional_data` text,
  `SNI` enum('C','1','2','3') DEFAULT NULL,
  `SNI_start_date` date DEFAULT NULL,
  `SNI_end_date` date NOT NULL,
  `PROMEP` tinyint(1) DEFAULT NULL,
  `PROMEP_start_date` date DEFAULT NULL,
  `PROMEP_end_date` date NOT NULL,
  `research_line` varchar(100) DEFAULT '',
  `grade` enum('Sin definir','Doctor','Maestro') DEFAULT 'Sin definir',
  `university` varchar(100) DEFAULT '',
  `img_profile_path` text,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `members`
--

INSERT INTO `members` (`id`, `user_id`, `name`, `last_name`, `address`, `telephone`, `additional_data`, `SNI`, `SNI_start_date`, `SNI_end_date`, `PROMEP`, `PROMEP_start_date`, `PROMEP_end_date`, `research_line`, `grade`, `university`, `img_profile_path`) VALUES
(1, 1, 'Ricardo', 'García Cejudo', 'Morelos Norte # 11, Calimaya, México', '(044) 722 373 36 06', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', NULL, NULL, '0000-00-00', 0, NULL, '0000-00-00', 'Tecnologías de la información', 'Sin definir', 'UAEM', '/files/profile_images/img_profile_1.jpg'),
(2, 2, 'Name', 'Lastname', '', '', '', 'C', '2015-10-29', '2015-10-31', 1, '2015-10-29', '2015-10-31', '', 'Sin definir', '', '/files/profile_images/img_profile_1.jpg'),
(3, 3, 'Name', 'Lastname', '', '', NULL, NULL, NULL, '0000-00-00', NULL, NULL, '0000-00-00', '', 'Sin definir', '', '/files/profile_images/img_profile_1.jpg'),
(4, 4, 'Member', 'Segundo', '', '', NULL, NULL, NULL, '0000-00-00', NULL, NULL, '0000-00-00', '', 'Sin definir', '', NULL),
(5, 5, '', '', '', '', NULL, NULL, NULL, '0000-00-00', NULL, NULL, '0000-00-00', '', 'Sin definir', '', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `members_academic_groups`
--

CREATE TABLE IF NOT EXISTS `members_academic_groups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `member_id` int(10) unsigned NOT NULL,
  `academic_group_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `member_id` (`member_id`,`academic_group_id`),
  KEY `academic_group_id` (`academic_group_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `members_academic_groups`
--

INSERT INTO `members_academic_groups` (`id`, `member_id`, `academic_group_id`) VALUES
(1, 4, 3),
(2, 5, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `publications`
--

CREATE TABLE IF NOT EXISTS `publications` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `member_id` int(11) unsigned NOT NULL,
  `section_id` int(11) unsigned NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `description` text,
  `publish_date` date DEFAULT NULL,
  `file_path` text,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `member_id` (`member_id`),
  KEY `section_id` (`section_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `publications`
--

INSERT INTO `publications` (`id`, `member_id`, `section_id`, `title`, `description`, `publish_date`, `file_path`, `created`, `modified`) VALUES
(1, 4, 1, 'Producción 1', 'Descripción de producción 1', '2015-12-22', 'C:\\xampp\\htdocs\\CoordinacionDeInvestigacion\\InvestigationProject\\app\\webroot\\\\files\\publications\\member_4\\memium.png', '2015-12-22 23:55:48', '2015-12-22 23:55:48'),
(2, 4, 1, 'Publicación 2', 'Descripción publicación 2', '2015-12-22', '', '2015-12-23 00:22:54', '2015-12-23 00:22:54'),
(3, 4, 1, 'Publicación 3', 'Descripción publicación 3', '2015-12-22', '', '2015-12-23 00:27:27', '2015-12-23 00:27:27'),
(4, 4, 1, 'Publicación 4', 'Descripción publicación 4', '2015-12-22', '', '2015-12-23 00:28:30', '2015-12-23 00:28:30');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `publications_section_fields`
--

CREATE TABLE IF NOT EXISTS `publications_section_fields` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `publication_id` int(11) unsigned NOT NULL,
  `section_field_id` int(11) unsigned NOT NULL,
  `value` text,
  PRIMARY KEY (`id`),
  KEY `publication_id` (`publication_id`),
  KEY `section_field_id` (`section_field_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `publications_section_fields`
--

INSERT INTO `publications_section_fields` (`id`, `publication_id`, `section_field_id`, `value`) VALUES
(1, 2, 1, 'Valor campo 2'),
(2, 2, 2, 'on'),
(3, 2, 3, '2015-12-23'),
(4, 4, 1, 'Valor campo 1'),
(5, 4, 2, 'on'),
(6, 4, 3, '2015-12-31');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sections`
--

CREATE TABLE IF NOT EXISTS `sections` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT '',
  `description` text,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `sections`
--

INSERT INTO `sections` (`id`, `name`, `description`, `created`, `modified`) VALUES
(1, 'Sección de prueba', 'Esta es una sección de prueba', '2015-10-30 15:47:47', '2015-12-24 01:47:14');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sections_fields`
--

CREATE TABLE IF NOT EXISTS `sections_fields` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `section_id` int(11) unsigned NOT NULL,
  `name` varchar(30) DEFAULT NULL,
  `type` enum('Texto','Casilla de verificación','Fecha') DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`,`section_id`),
  KEY `section_id` (`section_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `sections_fields`
--

INSERT INTO `sections_fields` (`id`, `section_id`, `name`, `type`) VALUES
(1, 1, 'Campo1', 'Texto'),
(2, 1, 'Campo2', 'Casilla de verificación'),
(3, 1, 'Campo4', 'Fecha');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(75) NOT NULL,
  `password` varchar(50) NOT NULL DEFAULT '',
  `role` varchar(20) DEFAULT '',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `created`, `modified`) VALUES
(1, 'rgarcia.cejudo@gmail.com', '24844b5b2ee67dac745610c79ec49abb5ee95fe8', 'super_admin', '2014-07-19 00:39:51', '2014-08-03 00:32:48'),
(2, 'ricardo_soulost@hotmail.com', '24844b5b2ee67dac745610c79ec49abb5ee95fe8', 'ca_admin', '2014-07-19 00:55:50', '2015-10-29 23:38:24'),
(3, 'elbueno@gmail.com', '24844b5b2ee67dac745610c79ec49abb5ee95fe8', 'ca_admin', '2014-07-19 01:29:38', '2014-07-19 01:29:38'),
(4, 'otro@gmail.com', '24844b5b2ee67dac745610c79ec49abb5ee95fe8', 'member', '2014-07-19 01:30:39', '2014-07-19 01:30:39'),
(5, 'asd@asd.com', '24844b5b2ee67dac745610c79ec49abb5ee95fe8', 'member', '2014-07-19 01:31:33', '2014-09-28 02:24:36');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `academic_groups`
--
ALTER TABLE `academic_groups`
  ADD CONSTRAINT `academic_groups_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `members` (`id`);

--
-- Filtros para la tabla `experiences`
--
ALTER TABLE `experiences`
  ADD CONSTRAINT `experiences_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `members` (`id`),
  ADD CONSTRAINT `experiences_ibfk_2` FOREIGN KEY (`institution_id`) REFERENCES `institutions` (`id`);

--
-- Filtros para la tabla `members`
--
ALTER TABLE `members`
  ADD CONSTRAINT `members_ibfk_1` FOREIGN KEY (`id`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `members_academic_groups`
--
ALTER TABLE `members_academic_groups`
  ADD CONSTRAINT `members_academic_groups_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `members` (`id`),
  ADD CONSTRAINT `members_academic_groups_ibfk_2` FOREIGN KEY (`academic_group_id`) REFERENCES `academic_groups` (`id`);

--
-- Filtros para la tabla `publications`
--
ALTER TABLE `publications`
  ADD CONSTRAINT `publications_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `members` (`id`),
  ADD CONSTRAINT `publications_ibfk_2` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`);

--
-- Filtros para la tabla `publications_section_fields`
--
ALTER TABLE `publications_section_fields`
  ADD CONSTRAINT `publications_section_fields_ibfk_1` FOREIGN KEY (`publication_id`) REFERENCES `publications` (`id`),
  ADD CONSTRAINT `publications_section_fields_ibfk_2` FOREIGN KEY (`section_field_id`) REFERENCES `sections_fields` (`id`);

--
-- Filtros para la tabla `sections_fields`
--
ALTER TABLE `sections_fields`
  ADD CONSTRAINT `sections_fields_ibfk_1` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
