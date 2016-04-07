# ************************************************************
# Sequel Pro SQL dump
# Versión 4096
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: 127.0.0.1 (MySQL 5.6.19)
# Base de datos: research_observatory
# Tiempo de Generación: 2016-04-07 01:01:21 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Volcado de tabla academic_groups
# ------------------------------------------------------------

DROP TABLE IF EXISTS `academic_groups`;

CREATE TABLE `academic_groups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned DEFAULT NULL,
  `name` varchar(100) DEFAULT '',
  `description` text,
  `level` enum('En formación','En consolidación','Consolidado') NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `member_id` (`user_id`),
  CONSTRAINT `academic_groups_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Volcado de tabla advertisements
# ------------------------------------------------------------

DROP TABLE IF EXISTS `advertisements`;

CREATE TABLE `advertisements` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` text,
  `url` varchar(1000) NOT NULL,
  `expiration_date` date NOT NULL,
  `file_path` text NOT NULL,
  `is_permanent` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Volcado de tabla experiences
# ------------------------------------------------------------

DROP TABLE IF EXISTS `experiences`;

CREATE TABLE `experiences` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `member_id` int(10) unsigned NOT NULL,
  `institution_id` int(10) unsigned NOT NULL,
  `activities` text,
  `from_date` date DEFAULT NULL,
  `to_date` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `member_id` (`member_id`),
  KEY `institution_id` (`institution_id`),
  CONSTRAINT `experiences_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `members` (`id`),
  CONSTRAINT `experiences_ibfk_2` FOREIGN KEY (`institution_id`) REFERENCES `institutions` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Volcado de tabla institutions
# ------------------------------------------------------------

DROP TABLE IF EXISTS `institutions`;

CREATE TABLE `institutions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Volcado de tabla links
# ------------------------------------------------------------

DROP TABLE IF EXISTS `links`;

CREATE TABLE `links` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `display_name` varchar(100) NOT NULL,
  `url` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Volcado de tabla members
# ------------------------------------------------------------

DROP TABLE IF EXISTS `members`;

CREATE TABLE `members` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `name` varchar(50) DEFAULT '',
  `last_name` varchar(100) DEFAULT NULL,
  `address` varchar(150) DEFAULT NULL,
  `telephone` varchar(20) DEFAULT NULL,
  `additional_data` text,
  `SNI` enum('C','1','2','3') DEFAULT NULL,
  `SNI_start_date` date DEFAULT NULL,
  `SNI_end_date` date DEFAULT NULL,
  `PROMEP` tinyint(1) DEFAULT NULL,
  `PROMEP_start_date` date DEFAULT NULL,
  `PROMEP_end_date` date DEFAULT NULL,
  `research_line` varchar(100) DEFAULT NULL,
  `grade` enum('Sin definir','Doctor','Maestro') DEFAULT 'Sin definir',
  `university` varchar(100) DEFAULT NULL,
  `img_profile_path` text,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `members_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Volcado de tabla members_academic_groups
# ------------------------------------------------------------

DROP TABLE IF EXISTS `members_academic_groups`;

CREATE TABLE `members_academic_groups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `member_id` int(10) unsigned NOT NULL,
  `academic_group_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `member_id` (`member_id`,`academic_group_id`),
  KEY `academic_group_id` (`academic_group_id`),
  CONSTRAINT `members_academic_groups_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `members` (`id`),
  CONSTRAINT `members_academic_groups_ibfk_2` FOREIGN KEY (`academic_group_id`) REFERENCES `academic_groups` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Volcado de tabla publications
# ------------------------------------------------------------

DROP TABLE IF EXISTS `publications`;

CREATE TABLE `publications` (
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
  KEY `section_id` (`section_id`),
  CONSTRAINT `publications_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `members` (`id`),
  CONSTRAINT `publications_ibfk_2` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Volcado de tabla publications_section_fields
# ------------------------------------------------------------

DROP TABLE IF EXISTS `publications_section_fields`;

CREATE TABLE `publications_section_fields` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `publication_id` int(11) unsigned NOT NULL,
  `section_field_id` int(11) unsigned NOT NULL,
  `value` text,
  PRIMARY KEY (`id`),
  KEY `publication_id` (`publication_id`),
  KEY `section_field_id` (`section_field_id`),
  CONSTRAINT `publications_section_fields_ibfk_1` FOREIGN KEY (`publication_id`) REFERENCES `publications` (`id`),
  CONSTRAINT `publications_section_fields_ibfk_2` FOREIGN KEY (`section_field_id`) REFERENCES `sections_fields` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Volcado de tabla sections
# ------------------------------------------------------------

DROP TABLE IF EXISTS `sections`;

CREATE TABLE `sections` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT '',
  `description` text,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Volcado de tabla sections_fields
# ------------------------------------------------------------

DROP TABLE IF EXISTS `sections_fields`;

CREATE TABLE `sections_fields` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `section_id` int(11) unsigned NOT NULL,
  `name` varchar(30) DEFAULT NULL,
  `type` enum('Texto','Casilla de verificación','Fecha') DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`,`section_id`),
  KEY `section_id` (`section_id`),
  CONSTRAINT `sections_fields_ibfk_1` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Volcado de tabla users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(75) NOT NULL,
  `password` varchar(50) NOT NULL DEFAULT '',
  `role` varchar(20) DEFAULT '',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
