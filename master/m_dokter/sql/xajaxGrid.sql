-- MySQL dump 10.9
--
-- Host: localhost    Database: xajaxGrig
-- ------------------------------------------------------
-- Server version	4.1.14

--
-- Table structure for table `person`
--

DROP TABLE IF EXISTS `person`;
CREATE TABLE `person` (
  `id` int(4) NOT NULL auto_increment,
  `lastname` varchar(25) NOT NULL default '',
  `firstname` varchar(25) NOT NULL default '',
  `email` varchar(35) NOT NULL default '',
  `origin` varchar(35) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM;

--
-- Dumping data examples for table `persona`
--


LOCK TABLES `person` WRITE;
INSERT INTO `person` VALUES (1,'Velazquez','Jesus','jjvema@yahoo.com','Guadalaja, Jalisco, Mexico');
INSERT INTO `person` VALUES (2,'Vazquez','Vianney','vianney.vazquez@gmail.com','Talpa de Allende, Jalisco, Mexico');
INSERT INTO `person` VALUES (3,'Velazquez','Paulina','paulina.velazquez@gmail.com','Zapopan, Jalisco, Mexico');
INSERT INTO `person` VALUES (4,'Velazquez','Mariana','mariana.velazquez@gmail.com','Zapopan, Jalisco, Mexico');
INSERT INTO `person` VALUES (5,'Contreras','Carlos','ccontrer@cybercable.net.mx','Monterrey, Nuevo Leon, Mexico');
INSERT INTO `person` VALUES (6,'Cruz','Jose Luis','cruzcruz@hotmail.com','Oaxaca, Oaxaca, Mexico');
UNLOCK TABLES;

