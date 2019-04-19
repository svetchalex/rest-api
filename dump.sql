-- MySQL dump 10.13  Distrib 5.7.25, for Linux (x86_64)
--
-- Host: localhost    Database: card
-- ------------------------------------------------------
-- Server version	5.7.25-0ubuntu0.18.04.2

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
-- Table structure for table `bonuses`
--

DROP TABLE IF EXISTS `bonuses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bonuses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `balance` decimal(65,2) DEFAULT NULL,
  `status` enum('active','deleted') DEFAULT NULL,
  `date_bonus` datetime DEFAULT NULL,
  `id_client` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_client` (`id_client`),
  CONSTRAINT `bonuses_ibfk_1` FOREIGN KEY (`id_client`) REFERENCES `clients` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bonuses`
--

LOCK TABLES `bonuses` WRITE;
/*!40000 ALTER TABLE `bonuses` DISABLE KEYS */;
INSERT INTO `bonuses` VALUES (1,57.00,'deleted','2019-04-16 12:33:38',1),(2,57.00,'deleted','2019-04-16 12:33:41',1),(3,47.00,'deleted','2019-04-16 12:33:42',1),(4,43.00,'deleted','2019-03-02 11:16:12',1),(5,86.00,'deleted','2019-04-21 11:16:12',1),(6,43.00,'deleted','2019-04-12 11:16:12',1),(7,86.00,'deleted','2019-04-12 11:16:12',1),(8,86.00,'deleted','2019-04-12 11:16:12',1),(9,542.00,'deleted','2019-04-17 13:51:47',1),(10,1084.00,'deleted','2019-04-17 13:52:46',1),(11,2168.00,'deleted','2019-04-17 13:54:10',1),(12,3336.00,'deleted','2019-04-17 13:55:43',1),(13,5672.00,'deleted','2019-04-17 14:02:40',1),(14,4672.00,'deleted','2019-04-17 14:03:09',1),(15,43.00,'active','2019-04-17 14:14:39',1),(16,43.00,'active','2019-04-18 14:50:03',1),(17,43.00,'active','2019-04-18 14:51:36',1),(18,43.00,'active','2019-04-18 14:53:26',1),(19,43.00,'active','2019-04-18 14:53:32',2),(20,43.00,'active','2019-04-18 14:53:38',4),(21,43.00,'active','2019-04-18 14:53:47',3);
/*!40000 ALTER TABLE `bonuses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `clients`
--

DROP TABLE IF EXISTS `clients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lastname` varchar(255) DEFAULT NULL,
  `firstname` varchar(255) DEFAULT NULL,
  `telephone` varchar(11) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `code` varchar(16) DEFAULT NULL,
  `bonus` decimal(65,2) DEFAULT NULL,
  `discount` decimal(5,2) DEFAULT NULL,
  `mode` enum('discount','bonus') DEFAULT NULL,
  `status` enum('active','blocked','deleted') DEFAULT NULL,
  `edition` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `telephone` (`telephone`),
  UNIQUE KEY `code` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clients`
--

LOCK TABLES `clients` WRITE;
/*!40000 ALTER TABLE `clients` DISABLE KEYS */;
INSERT INTO `clients` VALUES (1,'Бревно','Иван','79784658647','1988-04-21','0000000000000001',172.00,0.00,'bonus','active','2019-04-03'),(2,'Воронов','Дмитрий','79785432354','1978-12-03','0000000000000002',478.00,0.00,'bonus','active','2019-07-05'),(3,'Польский','Артем','79783643435','1957-05-08','0000000000000003',610.00,0.00,'bonus','deleted','2019-04-17'),(4,'Суровая','Анастасия','79783641435','1957-05-08','0000000000000004',610.00,0.00,'bonus','active','2019-04-18'),(5,'Мирный','Сергей','79784352343','2006-04-11','0000000000000005',0.00,5.00,'discount','active','2019-04-18');
/*!40000 ALTER TABLE `clients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `discounts`
--

DROP TABLE IF EXISTS `discounts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `discounts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `current` decimal(5,2) DEFAULT NULL,
  `new` decimal(5,2) DEFAULT NULL,
  `date_discount` datetime DEFAULT NULL,
  `id_client` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_client` (`id_client`),
  CONSTRAINT `discounts_ibfk_1` FOREIGN KEY (`id_client`) REFERENCES `clients` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `discounts`
--

LOCK TABLES `discounts` WRITE;
/*!40000 ALTER TABLE `discounts` DISABLE KEYS */;
INSERT INTO `discounts` VALUES (1,5.00,10.00,'2019-04-16 10:46:58',5),(2,5.00,10.00,'2019-04-17 14:09:30',5);
/*!40000 ALTER TABLE `discounts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `holidays`
--

DROP TABLE IF EXISTS `holidays`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `holidays` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `day` varchar(5) DEFAULT NULL,
  `name_holiday` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `holidays`
--

LOCK TABLES `holidays` WRITE;
/*!40000 ALTER TABLE `holidays` DISABLE KEYS */;
INSERT INTO `holidays` VALUES (1,'01-01','Новогодние каникулы'),(2,'01-02','Новогодние каникулы'),(3,'01-03','Новогодние каникулы'),(4,'01-04','Новогодние каникулы'),(5,'01-05','Новогодние каникулы'),(6,'01-06','Новогодние каникулы'),(7,'01-08','Новогодние каникулы'),(8,'01-07','Рождество Христово'),(9,'02-23','День защитника Отечества'),(10,'03-08','Международный женский день'),(11,'05-01','Праздник Весны и Труда'),(12,'05-09','День победы'),(13,'06-12','День России'),(14,'11-04','День народного единства');
/*!40000 ALTER TABLE `holidays` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mode_cards`
--

DROP TABLE IF EXISTS `mode_cards`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mode_cards` (
  `id` int(11) NOT NULL,
  `mode_card` enum('bonus','discount') DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mode_cards`
--

LOCK TABLES `mode_cards` WRITE;
/*!40000 ALTER TABLE `mode_cards` DISABLE KEYS */;
INSERT INTO `mode_cards` VALUES (1,'bonus');
/*!40000 ALTER TABLE `mode_cards` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `turnover_card`
--

DROP TABLE IF EXISTS `turnover_card`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `turnover_card` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_receipt` datetime DEFAULT NULL,
  `amount` decimal(65,2) DEFAULT NULL,
  `id_client` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `turnover_card`
--

LOCK TABLES `turnover_card` WRITE;
/*!40000 ALTER TABLE `turnover_card` DISABLE KEYS */;
INSERT INTO `turnover_card` VALUES (1,'2019-04-17 07:18:20',3453.00,1),(2,'2019-04-17 07:18:23',2345.00,1),(3,'2019-05-17 07:18:24',3425.00,0),(4,'2019-04-17 14:07:52',6540.00,1);
/*!40000 ALTER TABLE `turnover_card` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `api_key` varchar(50) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `function` enum('manager','operator') DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'64359b7192746a14740ad4bb7afe4e097327d0790190fd1631','Зотова Елена','manager'),(2,'146a7492719b3564094efe7abbd40a7416fd900179d0277354','Шишкин Владимир','operator'),(4,'430e103a666b8580d966b52a6ee1ee4d0d150739db72289e','Ветров Иван','operator');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-04-19 11:29:55
