# ************************************************************
# Sequel Pro SQL dump
# Versión 4096
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: 127.0.0.1 (MySQL 5.6.19)
# Base de datos: research_observatory
# Tiempo de Generación: 2014-11-21 18:41:43 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Volcado de tabla members
# ------------------------------------------------------------

LOCK TABLES `members` WRITE;
/*!40000 ALTER TABLE `members` DISABLE KEYS */;

INSERT INTO `members` (`id`, `user_id`, `name`, `last_name`, `address`, `telephone`, `additional_data`, `SNI`, `SNI_validity_date`, `PROMEP`, `PROMEP_validity_date`, `research_line`, `grade`, `university`, `img_profile_path`)
VALUES
	(1,1,'Ricardo','García Cejudo','Morelos Norte # 11, Calimaya, México','(044) 722 373 36 06','Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',NULL,NULL,0,NULL,'Tecnologías de la información','Sin definir','UAEM','/files/profile_images/img_profile_1.jpg'),
	(2,2,'Name','Lastname','','',NULL,NULL,NULL,0,NULL,'','Sin definir','','/files/profile_images/img_profile_1.jpg'),
	(3,3,'Name','Lastname','','',NULL,NULL,NULL,NULL,NULL,'','Sin definir','','/files/profile_images/img_profile_1.jpg'),
	(4,4,'Member','Segundo','','',NULL,NULL,NULL,NULL,NULL,'','Sin definir','',NULL),
	(5,5,'','','','',NULL,NULL,NULL,NULL,NULL,'','Sin definir','',NULL);

/*!40000 ALTER TABLE `members` ENABLE KEYS */;
UNLOCK TABLES;


# Volcado de tabla users
# ------------------------------------------------------------

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`id`, `username`, `password`, `role`, `created`, `modified`)
VALUES
	(1,'rgarcia.cejudo@gmail.com','24844b5b2ee67dac745610c79ec49abb5ee95fe8','super_admin','2014-07-19 00:39:51','2014-08-03 00:32:48'),
	(2,'ricardo_soulost@hotmail.com','24844b5b2ee67dac745610c79ec49abb5ee95fe8','ca_admin','2014-07-19 00:55:50','2014-09-28 02:33:00'),
	(3,'elbueno@gmail.com','24844b5b2ee67dac745610c79ec49abb5ee95fe8','member','2014-07-19 01:29:38','2014-07-19 01:29:38'),
	(4,'otro@gmail.com','cbd2d12dff3c3d1e2407a8ef0663407cd43511ba','member','2014-07-19 01:30:39','2014-07-19 01:30:39'),
	(5,'asd@asd.com','23e9274784cb63a03eb54e3cf3eabb2d70efff60','member','2014-07-19 01:31:33','2014-09-28 02:24:36');

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
