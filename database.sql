-- MySQL dump 10.13  Distrib 5.5.43, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: flex
-- ------------------------------------------------------
-- Server version	5.5.43-0ubuntu0.14.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `files`
--

DROP TABLE IF EXISTS `files`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `files` (
  `idfiles` int(11) NOT NULL AUTO_INCREMENT,
  `iduser` int(11) DEFAULT NULL,
  `path` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `size` varchar(500) DEFAULT NULL,
  `folderpath` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idfiles`),
  UNIQUE KEY `path_UNIQUE` (`path`),
  KEY `iduser_idx` (`iduser`),
  KEY `folderpath_idx` (`folderpath`),
  CONSTRAINT `iduser` FOREIGN KEY (`iduser`) REFERENCES `user` (`iduser`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `files`
--

LOCK TABLES `files` WRITE;
/*!40000 ALTER TABLE `files` DISABLE KEYS */;
INSERT INTO `files` VALUES (27,15,'users/Fanarito/Untitled.png','yesman','42065',NULL),(28,15,'users/Fanarito/Alan_Turing_photo.jpg','Alan_Turing_photo.jpg','30675',NULL),(31,16,'users/test123/Capture1.PNG','Capture1.PNG','8643',NULL),(33,16,'users/test123/Bombe-rebuild.jpg','Bombe-rebuild.jpg','379985',NULL),(35,15,'users/Fanarito/fdsa.PNG','now dis had to work','12092',NULL),(36,15,'users/Fanarito/asdf.PNG','asdf.PNG','68593',NULL),(37,15,'users/Fanarito/Hlutaprof2.7z','Hlutaprof2.7z','25152',NULL),(38,17,'users/siggibk/Hlutaprof2_2015.zip','Hlutaprof2_2015.zip','74044',NULL),(39,15,'users/Fanarito/Verkefni.7z','Verkefni.7z','54666',NULL),(40,15,'users/Fanarito/chrome_watcher.dll','chrome_watcher.dll','344392',NULL),(41,18,'users/hÃ¦viktor/hopverkefni.rar','hopverkefni.rar','43182',NULL),(42,15,'users/Fanarito/hopverkefni.rar','hopverkefni.rar','44630',NULL),(43,15,'users/Fanarito/hopverkefni.7z','hopverkefni.7z','29953',NULL),(44,15,'users/Fanarito/hopverkefni - 1.7z','hopverkefni - 1.7z','29953',NULL),(45,15,'users/Fanarito/hopverkefni.zip','hopverkefni.zip','50462',NULL);
/*!40000 ALTER TABLE `files` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `folders`
--

DROP TABLE IF EXISTS `folders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `folders` (
  `idfolders` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(90) DEFAULT NULL,
  `path` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idfolders`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `folders`
--

LOCK TABLES `folders` WRITE;
/*!40000 ALTER TABLE `folders` DISABLE KEYS */;
/*!40000 ALTER TABLE `folders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `iduser` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(45) NOT NULL,
  `email` varchar(120) NOT NULL,
  `password` varchar(128) NOT NULL,
  `active` tinyint(4) DEFAULT '1',
  `path` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`iduser`,`username`,`email`),
  UNIQUE KEY `path_UNIQUE` (`path`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (15,'Fanarito','viktor.saevars@gmail.com','9cab2845fe3910ac0c260627a0d8d22c7e46fc8c2f5ec31e5b6501753f41ec9660070545f841dd10eea70d6792d8667c3764782ff91c8e428b4c90a047deb7c6',1,'users/Fanarito'),(16,'test123','test@test.com','daef4953b9783365cad6615223720506cc46c5167cd16ab500fa597aa08ff964eb24fb19687f34d7665f778fcb6c5358fc0a5b81e1662cf90f73a2671c53f991',1,'users/test123'),(17,'siggibk','sigurdur97@gmail.com','7f7284ac92b0151c6ab58adc9e6673f63d420cf7bc5f829cb03e17b73daef49dccfdc2b29142f2bfd609ebdcc9abf7f3a63c2fe02f8b5e62b9a664c9f6152848',1,'users/siggibk'),(18,'hÃ¦viktor','amnestyinternational@werapechildren.cum','c5798e114e82c46a27576946561000b144d4514d1583c637d1b35a6a1139f3e396d73b0d3612812137c63c977902406c631770aa8a87af50c33e6a38719c5108',1,'users/hÃ¦viktor');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-05-08 20:32:08
