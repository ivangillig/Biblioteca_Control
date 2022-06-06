-- MySQL dump 10.13  Distrib 8.0.29, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: biblioteca
-- ------------------------------------------------------
-- Server version	5.7.33

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `detalleprestamo`
--

DROP TABLE IF EXISTS `detalleprestamo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `detalleprestamo` (
  `cod_detalle` int(11) NOT NULL AUTO_INCREMENT,
  `cod_prestamo` int(11) NOT NULL,
  `cod_libro` int(11) NOT NULL,
  `observaciones` tinytext COLLATE utf8_bin,
  PRIMARY KEY (`cod_detalle`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detalleprestamo`
--

LOCK TABLES `detalleprestamo` WRITE;
/*!40000 ALTER TABLE `detalleprestamo` DISABLE KEYS */;
INSERT INTO `detalleprestamo` VALUES (1,1,10,' Cambio por el arte de la guerra'),(2,2,4,' La biblia'),(3,2,2,'Juegos del hambre'),(4,2,3,'12 años de esclavitud');
/*!40000 ALTER TABLE `detalleprestamo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `libro`
--

DROP TABLE IF EXISTS `libro`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `libro` (
  `cod_libro` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` tinytext COLLATE utf8_bin,
  `editorial` tinytext COLLATE utf8_bin,
  `fedicion` date DEFAULT NULL,
  `idioma` tinytext COLLATE utf8_bin,
  `estado` tinytext CHARACTER SET latin1 COLLATE latin1_spanish_ci,
  `cantpaginas` int(11) DEFAULT NULL,
  PRIMARY KEY (`cod_libro`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `libro`
--

LOCK TABLES `libro` WRITE;
/*!40000 ALTER TABLE `libro` DISABLE KEYS */;
INSERT INTO `libro` VALUES (1,'Harry Potter 7','Tolkeyen','2022-06-01','Ingles','En biblioteca',750),(2,'Los juegos del hambre','AndaSabe','2010-06-02','español','Prestado',1200),(3,'12 años de esclavitud','Editorial 1','2018-01-02','español','Prestado',690),(4,'La Sagrada Biblia','Reina Valera','1980-01-01','Hebreo','Prestado',1740),(5,'Marmota','Planeta','2019-02-04','Español','En biblioteca',450),(6,'Padre rico padre pobre','Aguilar','2020-06-09','Español','En biblioteca',620),(7,'Ser la mejor versión','Autónomo','2018-01-01','Español','En biblioteca',354),(8,'Secretos de divan','Autónomo','2016-01-03','Español','En biblioteca',500),(9,'El señor de los anillos','Tolkeyen','2018-02-09','Español','En reparación',950),(10,'El arte de la guerra','Campana','1995-12-01','Español','Prestado',315);
/*!40000 ALTER TABLE `libro` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `prestamo`
--

DROP TABLE IF EXISTS `prestamo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `prestamo` (
  `cod_prestamo` int(11) NOT NULL AUTO_INCREMENT,
  `cod_socio` int(11) NOT NULL,
  `fecha_prestamo` date NOT NULL,
  `fecha_devolucion` date DEFAULT NULL,
  PRIMARY KEY (`cod_prestamo`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `prestamo`
--

LOCK TABLES `prestamo` WRITE;
/*!40000 ALTER TABLE `prestamo` DISABLE KEYS */;
INSERT INTO `prestamo` VALUES (1,4,'2022-06-04',NULL),(2,3,'2022-06-05',NULL);
/*!40000 ALTER TABLE `prestamo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reparacion`
--

DROP TABLE IF EXISTS `reparacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `reparacion` (
  `cod_reparacion` int(11) NOT NULL AUTO_INCREMENT,
  `fingreso` date NOT NULL,
  `motivo` tinytext COLLATE utf8_bin,
  `fegreso` date DEFAULT NULL,
  `cod_libro` int(11) NOT NULL,
  PRIMARY KEY (`cod_reparacion`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reparacion`
--

LOCK TABLES `reparacion` WRITE;
/*!40000 ALTER TABLE `reparacion` DISABLE KEYS */;
INSERT INTO `reparacion` VALUES (5,'2022-06-04','Tapa marcada',NULL,9);
/*!40000 ALTER TABLE `reparacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `socio`
--

DROP TABLE IF EXISTS `socio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `socio` (
  `cod_socio` int(11) NOT NULL AUTO_INCREMENT,
  `nomyape` tinytext COLLATE utf8_bin,
  `fnacimiento` date DEFAULT NULL,
  `direccion` tinytext COLLATE utf8_bin,
  `telefono` tinytext COLLATE utf8_bin,
  `email` tinytext COLLATE utf8_bin,
  PRIMARY KEY (`cod_socio`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `socio`
--

LOCK TABLES `socio` WRITE;
/*!40000 ALTER TABLE `socio` DISABLE KEYS */;
INSERT INTO `socio` VALUES (1,'Juan Hernandez','2004-06-24','3 de abril, 238','2964568715','jhernandez@gmail.com'),(2,'Facuando Duarte','1990-11-03','Mria Auxiliadora 4345','2964586457','nahuel@gmail.com'),(3,'Claudia Contreras','1985-05-01','Libertad 123','2901568415','cc.utn@gmail.com'),(4,'Santiago Bermudez','2004-06-05','Alberdi 245','425156','santiagobarreto@gmail.com'),(7,'Juan Perez','2015-01-01','San Martin 324','2901565484','juan.perez@gmail.com');
/*!40000 ALTER TABLE `socio` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuario` (
  `cod_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `user` tinytext COLLATE utf8_bin NOT NULL,
  `password` tinytext COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`cod_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (1,'admin@correo.com','123456');
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-06-04 21:10:28
