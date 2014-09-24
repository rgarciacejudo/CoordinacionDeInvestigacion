# ************************************************************
# Sequel Pro SQL dump
# Versión 4096
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: 127.0.0.1 (MySQL 5.6.19)
# Base de datos: research_observatory
# Tiempo de Generación: 2014-09-24 15:39:12 +0000
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
  CONSTRAINT `academic_groups_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `members` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

LOCK TABLES `academic_groups` WRITE;
/*!40000 ALTER TABLE `academic_groups` DISABLE KEYS */;

INSERT INTO `academic_groups` (`id`, `user_id`, `name`, `description`, `level`, `created`, `modified`)
VALUES
	(1,2,'Grupo académico 1','Primer grupo académico','En formación','2014-09-07 14:39:10','2014-09-24 13:40:51'),
	(2,2,'Grupo académico 2','Segundo grupo académico','En consolidación','2014-09-07 14:50:26','2014-09-07 14:50:26');

/*!40000 ALTER TABLE `academic_groups` ENABLE KEYS */;
UNLOCK TABLES;


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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

LOCK TABLES `experiences` WRITE;
/*!40000 ALTER TABLE `experiences` DISABLE KEYS */;

INSERT INTO `experiences` (`id`, `member_id`, `institution_id`, `activities`, `from_date`, `to_date`)
VALUES
	(1,1,1,'Actividad 1','2014-08-01','2014-08-31');

/*!40000 ALTER TABLE `experiences` ENABLE KEYS */;
UNLOCK TABLES;


# Volcado de tabla institutions
# ------------------------------------------------------------

DROP TABLE IF EXISTS `institutions`;

CREATE TABLE `institutions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

LOCK TABLES `institutions` WRITE;
/*!40000 ALTER TABLE `institutions` DISABLE KEYS */;

INSERT INTO `institutions` (`id`, `name`)
VALUES
	(1,'UAEM'),
	(2,'UAEMex');

/*!40000 ALTER TABLE `institutions` ENABLE KEYS */;
UNLOCK TABLES;


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
  CONSTRAINT `members_ibfk_1` FOREIGN KEY (`id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

LOCK TABLES `members` WRITE;
/*!40000 ALTER TABLE `members` DISABLE KEYS */;

INSERT INTO `members` (`id`, `user_id`, `name`, `last_name`, `address`, `telephone`, `additional_data`, `SNI`, `SNI_validity_date`, `PROMEP`, `PROMEP_validity_date`, `research_line`, `grade`, `university`, `img_profile_path`)
VALUES
	(1,1,'Ricardo','García Cejudo','Morelos Norte # 11, Calimaya, México','(044) 722 373 36 06','Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',NULL,NULL,0,NULL,'Tecnologías de la información','Sin definir','UAEM','/files/profile_images/img_profile_1.jpg'),
	(2,2,'','','','',NULL,NULL,NULL,0,NULL,'','Sin definir','',NULL),
	(3,3,'','','','',NULL,NULL,NULL,NULL,NULL,'','Sin definir','',NULL),
	(4,4,'','','','',NULL,NULL,NULL,NULL,NULL,'','Sin definir','',NULL),
	(5,5,'','','','',NULL,NULL,NULL,NULL,NULL,'','Sin definir','',NULL);

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
  UNIQUE KEY `member_id` (`member_id`,`academic_group_id`),
  KEY `academic_group_id` (`academic_group_id`),
  CONSTRAINT `members_academic_groups_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `members` (`id`),
  CONSTRAINT `members_academic_groups_ibfk_2` FOREIGN KEY (`academic_group_id`) REFERENCES `academic_groups` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

LOCK TABLES `members_academic_groups` WRITE;
/*!40000 ALTER TABLE `members_academic_groups` DISABLE KEYS */;

INSERT INTO `members_academic_groups` (`id`, `member_id`, `academic_group_id`)
VALUES
	(1,3,1);

/*!40000 ALTER TABLE `members_academic_groups` ENABLE KEYS */;
UNLOCK TABLES;


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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

LOCK TABLES `sections` WRITE;
/*!40000 ALTER TABLE `sections` DISABLE KEYS */;

INSERT INTO `sections` (`id`, `name`, `description`, `created`, `modified`)
VALUES
	(5,'Primer sección','Sección de prueba','2014-08-03 03:23:27','2014-08-03 03:23:27'),
	(10,'Segunda sección','Sección de prueba número 2','2014-09-07 16:17:32','2014-09-07 16:17:32');

/*!40000 ALTER TABLE `sections` ENABLE KEYS */;
UNLOCK TABLES;


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
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

LOCK TABLES `sections_fields` WRITE;
/*!40000 ALTER TABLE `sections_fields` DISABLE KEYS */;

INSERT INTO `sections_fields` (`id`, `section_id`, `name`, `type`)
VALUES
	(1,5,'campo1','Texto'),
	(2,5,'campo2','Texto'),
	(21,10,'campo1','Fecha'),
	(22,10,'campo2',NULL);

/*!40000 ALTER TABLE `sections_fields` ENABLE KEYS */;
UNLOCK TABLES;


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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`id`, `username`, `password`, `role`, `created`, `modified`)
VALUES
	(1,'rgarcia.cejudo@gmail.com','24844b5b2ee67dac745610c79ec49abb5ee95fe8','super_admin','2014-07-19 00:39:51','2014-08-03 00:32:48'),
	(2,'ricardo_soulost@hotmail.com','24844b5b2ee67dac745610c79ec49abb5ee95fe8','ca_admin','2014-07-19 00:55:50','2014-07-19 00:55:50'),
	(3,'elbueno@gmail.com','24844b5b2ee67dac745610c79ec49abb5ee95fe8','member','2014-07-19 01:29:38','2014-07-19 01:29:38'),
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
