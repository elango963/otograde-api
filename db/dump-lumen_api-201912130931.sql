-- MySQL dump 10.13  Distrib 5.7.27, for Linux (x86_64)
--
-- Host: localhost    Database: lumen_api
-- ------------------------------------------------------
-- Server version	5.7.27-0ubuntu0.19.04.1

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
-- Table structure for table `executive_detail_models`
--

DROP TABLE IF EXISTS `executive_detail_models`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `executive_detail_models` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) DEFAULT NULL,
  `mobile` varchar(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `executive_detail_models`
--

LOCK TABLES `executive_detail_models` WRITE;
/*!40000 ALTER TABLE `executive_detail_models` DISABLE KEYS */;
INSERT INTO `executive_detail_models` VALUES (1,'j','k','2019-12-12 17:18:29','2019-12-12 17:18:29');
/*!40000 ALTER TABLE `executive_detail_models` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lead_client_models`
--

DROP TABLE IF EXISTS `lead_client_models`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lead_client_models` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `lead_id` varchar(30) DEFAULT NULL,
  `short_name` varchar(30) DEFAULT NULL,
  `name` varchar(30) DEFAULT NULL,
  `city` varchar(30) DEFAULT NULL,
  `state` varchar(30) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lead_client_models`
--

LOCK TABLES `lead_client_models` WRITE;
/*!40000 ALTER TABLE `lead_client_models` DISABLE KEYS */;
INSERT INTO `lead_client_models` VALUES (1,NULL,'CHOLA','CHOLAMANDALA','12345','a','2019-12-12 17:11:26','2019-12-12 17:11:26'),(2,NULL,'CHOLA','CHOLAMANDALA','12345','a','2019-12-12 17:14:24','2019-12-12 17:14:24'),(3,NULL,'CHOLA','CHOLAMANDALA','12345','a','2019-12-12 17:18:29','2019-12-12 17:18:29'),(4,NULL,'CHOLA','CHOLAMANDALA','12345','a','2019-12-12 17:19:14','2019-12-12 17:19:14'),(5,NULL,'CHOLA','CHOLAMANDALA','12345','a','2019-12-12 17:20:05','2019-12-12 17:20:05'),(6,NULL,'CHOLA','CHOLAMANDALA','12345','a','2019-12-12 17:23:55','2019-12-12 17:23:55'),(7,'CHOLA2WHLR4','CHOLA','CHOLAMANDALA','12345','a','2019-12-12 17:24:28','2019-12-12 17:24:28'),(8,'CHOLA2WHLR5','CHOLA','CHOLAMANDALA','12345','a','2019-12-12 17:24:41','2019-12-12 17:24:41');
/*!40000 ALTER TABLE `lead_client_models` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lead_customer_detail_models`
--

DROP TABLE IF EXISTS `lead_customer_detail_models`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lead_customer_detail_models` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `lead_id` varchar(30) DEFAULT NULL,
  `name` varchar(30) DEFAULT NULL,
  `mobile` varchar(30) DEFAULT NULL,
  `address1` varchar(50) DEFAULT NULL,
  `address2` varchar(50) DEFAULT NULL,
  `city` varchar(30) DEFAULT NULL,
  `state` varchar(30) DEFAULT NULL,
  `pincode` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lead_customer_detail_models`
--

LOCK TABLES `lead_customer_detail_models` WRITE;
/*!40000 ALTER TABLE `lead_customer_detail_models` DISABLE KEYS */;
INSERT INTO `lead_customer_detail_models` VALUES (1,NULL,'b','c','d','f','g','h','636303','2019-12-12 17:14:24','2019-12-12 17:14:24'),(2,NULL,'b','c','d','f','g','h','636303','2019-12-12 17:18:29','2019-12-12 17:18:29'),(3,NULL,'b','c','d','f','g','h','636303','2019-12-12 17:19:14','2019-12-12 17:19:14'),(4,NULL,'b','c','d','f','g','h','636303','2019-12-12 17:20:05','2019-12-12 17:20:05'),(5,NULL,'b','c','d','f','g','h','636303','2019-12-12 17:23:55','2019-12-12 17:23:55'),(6,'CHOLA2WHLR4','b','c','d','f','g','h','636303','2019-12-12 17:24:28','2019-12-12 17:24:28'),(7,'CHOLA2WHLR5','b','c','d','f','g','h','636303','2019-12-12 17:24:41','2019-12-12 17:24:41');
/*!40000 ALTER TABLE `lead_customer_detail_models` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lead_models`
--

DROP TABLE IF EXISTS `lead_models`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lead_models` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `lead_id` varchar(30) DEFAULT NULL,
  `client_id` varchar(30) DEFAULT NULL,
  `inspection_type` varchar(30) DEFAULT NULL,
  `vehicle_id` varchar(30) DEFAULT NULL,
  `registration_type` varchar(30) DEFAULT NULL,
  `registration_number` varchar(30) DEFAULT NULL,
  `loan_agreement_number` varchar(30) DEFAULT NULL,
  `model_number` varchar(30) DEFAULT NULL,
  `engine_number` varchar(30) DEFAULT NULL,
  `chassis_number` varchar(30) DEFAULT NULL,
  `number_of_owners` varchar(30) DEFAULT NULL,
  `registration_status` varchar(30) DEFAULT NULL,
  `mfg_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `reg_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `status_id` varchar(30) DEFAULT NULL,
  `customer_id` varchar(30) DEFAULT NULL,
  `executive_id` varchar(30) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lead_models`
--

LOCK TABLES `lead_models` WRITE;
/*!40000 ALTER TABLE `lead_models` DISABLE KEYS */;
INSERT INTO `lead_models` VALUES (1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2019-12-12 17:18:29','0000-00-00 00:00:00',NULL,NULL,NULL,'2019-12-12 17:18:29','2019-12-12 17:18:29'),(2,NULL,'5','retail','w','f','f','f','1','1','1','1','registered','2019-12-12 22:48:29','2019-12-12 22:48:29',NULL,NULL,'1','2019-12-12 17:20:05','2019-12-12 17:20:05'),(3,NULL,'6','retail','w','f','f','f','1','1','1','1','registered','2019-12-12 22:48:29','2019-12-12 22:48:29',NULL,NULL,'1','2019-12-12 17:23:55','2019-12-12 17:23:55'),(4,'CHOLA2WHLR4','7','retail','w','f','f','f','1','1','1','1','registered','2019-12-12 17:24:28','2019-12-12 22:48:29',NULL,NULL,'1','2019-12-12 17:24:28','2019-12-12 17:24:28'),(5,'CHOLA2WHLR5','8','retail','w','f','f','f','1','1','1','1','registered','2019-12-12 17:24:41','2019-12-12 22:48:29',NULL,NULL,'1','2019-12-12 17:24:41','2019-12-12 17:24:41');
/*!40000 ALTER TABLE `lead_models` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `firstname` varchar(30) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'admin','','admin@gmail.com','12345','2019-12-03 16:13:51','2019-12-03 16:13:51');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'lumen_api'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-12-13  9:31:44
