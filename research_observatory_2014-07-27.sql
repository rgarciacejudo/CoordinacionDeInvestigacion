# ************************************************************
# Sequel Pro SQL dump
# Versión 4096
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: 127.0.0.1 (MySQL 5.6.19)
# Base de datos: research_observatory
# Tiempo de Generación: 2014-07-28 03:57:05 +0000
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
  `member_id` int(10) unsigned DEFAULT NULL,
  `name` varchar(100) DEFAULT '',
  `description` text,
  `level` enum('En formación','En consolidación','Consolidado') NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `member_id` (`member_id`),
  CONSTRAINT `academic_groups_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `members` (`id`)
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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Volcado de tabla members
# ------------------------------------------------------------

DROP TABLE IF EXISTS `members`;

CREATE TABLE `members` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `name` varchar(50) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `address` varchar(150) DEFAULT '',
  `telephone` varchar(20) DEFAULT '',
  `additional_data` text,
  `SNI` enum('C','1','2','3') DEFAULT NULL,
  `SNI_validity_date` date DEFAULT NULL,
  `PROMEP` tinyint(1) DEFAULT NULL,
  `PROMEP_validity_date` date DEFAULT NULL,
  `research_line` varchar(100) DEFAULT '',
  `grade` enum('Sin definir','Doctor','Maestro') DEFAULT 'Sin definir',
  `university` varchar(100) DEFAULT '',
  `img_profile_path` text,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `members_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `members` WRITE;
/*!40000 ALTER TABLE `members` DISABLE KEYS */;

INSERT INTO `members` (`id`, `user_id`, `name`, `last_name`, `address`, `telephone`, `additional_data`, `SNI`, `SNI_validity_date`, `PROMEP`, `PROMEP_validity_date`, `research_line`, `grade`, `university`, `img_profile_path`)
VALUES
	(1,1,'Ricardo','','','',NULL,NULL,'2014-07-21',0,'2014-07-21','',NULL,'','/files/profile_images/img_profile_1.jpg');

/*!40000 ALTER TABLE `members` ENABLE KEYS */;
UNLOCK TABLES;


# Volcado de tabla members_academic_groups
# ------------------------------------------------------------

DROP TABLE IF EXISTS `members_academic_groups`;

CREATE TABLE `members_academic_groups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `member_id` int(10) unsigned NOT NULL,
  `academic_group_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `member_id` (`member_id`),
  KEY `academic_group_id` (`academic_group_id`),
  CONSTRAINT `members_academic_groups_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `members` (`id`),
  CONSTRAINT `members_academic_groups_ibfk_2` FOREIGN KEY (`academic_group_id`) REFERENCES `academic_groups` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Volcado de tabla members_projects
# ------------------------------------------------------------

DROP TABLE IF EXISTS `members_projects`;

CREATE TABLE `members_projects` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `member_id` int(10) unsigned NOT NULL,
  `project_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `member_id` (`member_id`),
  KEY `project_id` (`project_id`),
  CONSTRAINT `members_projects_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `members` (`id`),
  CONSTRAINT `members_projects_ibfk_2` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Volcado de tabla members_sections
# ------------------------------------------------------------

DROP TABLE IF EXISTS `members_sections`;

CREATE TABLE `members_sections` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `member_id` int(10) unsigned NOT NULL,
  `section_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `member_id` (`member_id`),
  KEY `section_id` (`section_id`),
  CONSTRAINT `members_sections_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `members` (`id`),
  CONSTRAINT `members_sections_ibfk_2` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Volcado de tabla projects
# ------------------------------------------------------------

DROP TABLE IF EXISTS `projects`;

CREATE TABLE `projects` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `institution_id` int(10) unsigned NOT NULL,
  `key` varchar(50) DEFAULT '',
  `name` varchar(100) DEFAULT '',
  `from_date` date DEFAULT NULL,
  `to_date` date DEFAULT NULL,
  `resume` text,
  `mount` decimal(10,0) DEFAULT NULL,
  `file_path` text,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `key` (`key`),
  KEY `institution_id` (`institution_id`),
  CONSTRAINT `projects_ibfk_1` FOREIGN KEY (`institution_id`) REFERENCES `institutions` (`id`)
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
  `section_id` int(11) unsigned DEFAULT NULL,
  `name` varchar(30) DEFAULT NULL,
  `type` enum('Texto','Casilla de verificación','Fecha') DEFAULT NULL,
  PRIMARY KEY (`id`),
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

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`id`, `username`, `password`, `role`, `created`, `modified`)
VALUES
	(1,'rgarcia.cejudo@gmail.com','24844b5b2ee67dac745610c79ec49abb5ee95fe8','super_admin','2014-07-19 00:39:51','2014-07-21 02:12:29'),
	(2,'ricardo_soulost@hotmail.com','cbd2d12dff3c3d1e2407a8ef0663407cd43511ba','ca_admin','2014-07-19 00:55:50','2014-07-19 00:55:50'),
	(3,'elbueno@gmail.com','cbd2d12dff3c3d1e2407a8ef0663407cd43511ba','member','2014-07-19 01:29:38','2014-07-19 01:29:38'),
	(4,'otro@gmail.com','cbd2d12dff3c3d1e2407a8ef0663407cd43511ba','member','2014-07-19 01:30:39','2014-07-19 01:30:39'),
	(5,'asd@asd.com','cbd2d12dff3c3d1e2407a8ef0663407cd43511ba','member','2014-07-19 01:31:33','2014-07-19 01:31:33');

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
