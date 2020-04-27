-- MySQL dump 10.13  Distrib 8.0.19, for osx10.14 (x86_64)
--
-- Host: localhost    Database: pibt_sms
-- ------------------------------------------------------
-- Server version	8.0.19

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `Allocation`
--

DROP TABLE IF EXISTS `Allocation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Allocation` (
  `id` int NOT NULL AUTO_INCREMENT,
  `created_date` datetime DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  `student_id` int DEFAULT NULL,
  `tutor_id` int DEFAULT NULL,
  `batch_id` int DEFAULT NULL,
  `module_id` int DEFAULT NULL,
  `entered_by` int DEFAULT NULL,
  `status` int DEFAULT NULL,
  `code` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Allocation`
--

LOCK TABLES `Allocation` WRITE;
/*!40000 ALTER TABLE `Allocation` DISABLE KEYS */;
INSERT INTO `Allocation` VALUES (1,NULL,NULL,1,3,1,1,NULL,1,'A'),(4,NULL,NULL,1,16,1,NULL,2,1,'B');
/*!40000 ALTER TABLE `Allocation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Batch`
--

DROP TABLE IF EXISTS `Batch`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Batch` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `status` int DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  `code` varchar(45) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  `entered_by` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Batch`
--

LOCK TABLES `Batch` WRITE;
/*!40000 ALTER TABLE `Batch` DISABLE KEYS */;
INSERT INTO `Batch` VALUES (1,'A',1,NULL,NULL,'A','2020-04-28','A',2),(2,'AV',1,NULL,NULL,'AB','2020-04-28','AV',2),(3,'sdf',1,NULL,NULL,'Asfs','2020-04-07','sdf',2);
/*!40000 ALTER TABLE `Batch` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Blog`
--

DROP TABLE IF EXISTS `Blog`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Blog` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(45) DEFAULT NULL,
  `content` text,
  `created_date` datetime DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  `allocation_id` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Blog`
--

LOCK TABLES `Blog` WRITE;
/*!40000 ALTER TABLE `Blog` DISABLE KEYS */;
/*!40000 ALTER TABLE `Blog` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Blog_Comment`
--

DROP TABLE IF EXISTS `Blog_Comment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Blog_Comment` (
  `id` int NOT NULL AUTO_INCREMENT,
  `comment` text,
  `created_date` datetime DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  `blog_id` int DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Blog_Comment`
--

LOCK TABLES `Blog_Comment` WRITE;
/*!40000 ALTER TABLE `Blog_Comment` DISABLE KEYS */;
/*!40000 ALTER TABLE `Blog_Comment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Document`
--

DROP TABLE IF EXISTS `Document`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Document` (
  `id` int NOT NULL AUTO_INCREMENT,
  `file_name` varchar(255) DEFAULT NULL,
  `uuid` varchar(50) DEFAULT NULL,
  `status` int DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  `allocation_id` int DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Document`
--

LOCK TABLES `Document` WRITE;
/*!40000 ALTER TABLE `Document` DISABLE KEYS */;
INSERT INTO `Document` VALUES (1,'AD.png','20200427050436',1,NULL,NULL,NULL,NULL),(2,'Ridma.jpg','20200427050457',1,NULL,NULL,4,1),(3,'Thushara.jpg','20200427090458',1,NULL,NULL,1,1),(4,'AD.png','20200427100401',1,NULL,NULL,1,1),(5,'AD.png','20200427100401',1,NULL,NULL,4,1),(6,'Ridma.jpg','20200427100437',1,NULL,NULL,4,1),(7,'Ridma.jpg','20200427100420',1,NULL,NULL,1,1);
/*!40000 ALTER TABLE `Document` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Document_Comment`
--

DROP TABLE IF EXISTS `Document_Comment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Document_Comment` (
  `id` int NOT NULL AUTO_INCREMENT,
  `comment` text,
  `created_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_date` datetime DEFAULT NULL,
  `document_id` int DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Document_Comment`
--

LOCK TABLES `Document_Comment` WRITE;
/*!40000 ALTER TABLE `Document_Comment` DISABLE KEYS */;
INSERT INTO `Document_Comment` VALUES (1,'Comment',NULL,NULL,2,1),(2,'Comment 2','2020-04-27 11:24:20',NULL,2,1),(3,'fdgg','2020-04-27 15:22:05',NULL,3,1);
/*!40000 ALTER TABLE `Document_Comment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Login`
--

DROP TABLE IF EXISTS `Login`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Login` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_name` varchar(45) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Login`
--

LOCK TABLES `Login` WRITE;
/*!40000 ALTER TABLE `Login` DISABLE KEYS */;
INSERT INTO `Login` VALUES (1,'admin','admin',NULL,NULL,2),(2,'student','student',NULL,NULL,1),(3,'tutor','tutor',NULL,NULL,3),(7,'a','a',NULL,NULL,10),(8,'a','a',NULL,NULL,11),(9,'thushara','13',NULL,NULL,12),(10,'thushara','a',NULL,NULL,13),(11,'qwe','qwe',NULL,NULL,14),(12,'adfsdfd','a',NULL,NULL,15),(13,'qwesdfs','sfsff',NULL,NULL,16),(14,'dsfssfss','sdfsfss',NULL,NULL,17),(15,'dsfssfsssfsfs','sdfsfss',NULL,NULL,18),(16,'dsfssfsssfsfssdfs','sdfsfss',NULL,NULL,19),(17,'dsfssfsssfsfssdfs','sdfsfss',NULL,NULL,20),(18,'2344323','242234',NULL,NULL,21),(19,'123123','123',NULL,NULL,22);
/*!40000 ALTER TABLE `Login` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Meeting`
--

DROP TABLE IF EXISTS `Meeting`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Meeting` (
  `id` int NOT NULL AUTO_INCREMENT,
  `schedule_date` datetime DEFAULT NULL,
  `comment` varchar(255) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  `allocation_id` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Meeting`
--

LOCK TABLES `Meeting` WRITE;
/*!40000 ALTER TABLE `Meeting` DISABLE KEYS */;
/*!40000 ALTER TABLE `Meeting` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Meeting_Minute`
--

DROP TABLE IF EXISTS `Meeting_Minute`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Meeting_Minute` (
  `id` int NOT NULL AUTO_INCREMENT,
  `minute` text,
  `status` tinyint(1) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  `meeting_id` int DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Meeting_Minute`
--

LOCK TABLES `Meeting_Minute` WRITE;
/*!40000 ALTER TABLE `Meeting_Minute` DISABLE KEYS */;
/*!40000 ALTER TABLE `Meeting_Minute` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Message`
--

DROP TABLE IF EXISTS `Message`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Message` (
  `id` int NOT NULL AUTO_INCREMENT,
  `message` varchar(255) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  `allocation_id` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Message`
--

LOCK TABLES `Message` WRITE;
/*!40000 ALTER TABLE `Message` DISABLE KEYS */;
/*!40000 ALTER TABLE `Message` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Module`
--

DROP TABLE IF EXISTS `Module`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Module` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `status` int DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  `code` varchar(45) DEFAULT NULL,
  `remarks` varchar(45) DEFAULT NULL,
  `entered_by` int DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Module`
--

LOCK TABLES `Module` WRITE;
/*!40000 ALTER TABLE `Module` DISABLE KEYS */;
INSERT INTO `Module` VALUES (1,'EWSD',1,NULL,NULL,NULL,NULL,NULL,NULL),(2,'hg',1,NULL,NULL,'hg','hfg',2,NULL),(3,'fd',1,NULL,NULL,'hgfd','dfd',2,NULL),(4,'sdfs',1,NULL,NULL,'sdfsf','',2,NULL),(5,'sdfs',1,NULL,NULL,'sdfsf','',2,NULL),(6,'sdfs',1,NULL,NULL,'sdfsf','',2,NULL),(7,'sdfs',1,NULL,NULL,'sdfsf','',2,NULL),(8,'sdfs',1,NULL,NULL,'sdfsf','',2,NULL),(9,'sdfs',1,NULL,NULL,'sdfsf','',2,NULL);
/*!40000 ALTER TABLE `Module` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Permission`
--

DROP TABLE IF EXISTS `Permission`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Permission` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `page` int DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Permission`
--

LOCK TABLES `Permission` WRITE;
/*!40000 ALTER TABLE `Permission` DISABLE KEYS */;
INSERT INTO `Permission` VALUES (1,'admin',NULL,NULL,NULL),(2,'tutor',NULL,NULL,NULL),(3,'student',NULL,NULL,NULL);
/*!40000 ALTER TABLE `Permission` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Role`
--

DROP TABLE IF EXISTS `Role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Role` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `login_id` int DEFAULT NULL,
  `permission_id` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Role`
--

LOCK TABLES `Role` WRITE;
/*!40000 ALTER TABLE `Role` DISABLE KEYS */;
INSERT INTO `Role` VALUES (1,'admin',NULL,1,1),(2,'student',NULL,2,3),(3,'tutor',NULL,3,2),(7,NULL,NULL,7,2),(8,NULL,NULL,8,2),(9,NULL,NULL,9,2),(10,NULL,NULL,10,2),(11,NULL,NULL,11,2),(12,NULL,NULL,12,2),(13,NULL,NULL,13,2),(14,NULL,NULL,18,1),(15,NULL,NULL,19,3);
/*!40000 ALTER TABLE `Role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `User`
--

DROP TABLE IF EXISTS `User`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `User` (
  `id` int NOT NULL AUTO_INCREMENT,
  `code` varchar(45) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `gender` int DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `nic_no` varchar(12) DEFAULT NULL,
  `mobile_no` varchar(15) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `status` int DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  `nationality` int DEFAULT NULL,
  `marital_status` int DEFAULT NULL,
  `land_no` varchar(45) DEFAULT NULL,
  `office_no` varchar(45) DEFAULT NULL,
  `enter_by` int DEFAULT NULL,
  `calling_name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `User`
--

LOCK TABLES `User` WRITE;
/*!40000 ALTER TABLE `User` DISABLE KEYS */;
INSERT INTO `User` VALUES (1,NULL,'student',1,'1990-05-16','901901901V','0112345678','abc@abc.com','Colomobo',1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(2,NULL,'admin',NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(3,NULL,'Prasad',NULL,NULL,NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(10,'a','a',1,'2020-04-02','a','','a','a',1,NULL,NULL,2,1,'','',2,''),(11,'ab','a',1,'2020-04-02','a','','a','a',1,NULL,NULL,2,1,'','',2,''),(12,'aqwe','qw',1,'2020-04-01','901901901B','12','user@domain.com','a',1,NULL,NULL,2,1,'','',2,'A'),(13,'AA','Thushara',1,'2020-04-08','901901901B','','admin','Colombo',1,NULL,NULL,3,1,'','',2,''),(14,'qer','qw',1,'2020-04-01','qwe','','qwe','qwe',1,NULL,NULL,4,1,'','',2,''),(15,'asdfsdfs','a',1,'2020-04-07','a','','a','a',1,NULL,NULL,2,1,'','',2,''),(16,'wmtb19','Thushara',1,'2020-04-02','901901901B','','admin','Colombo',1,NULL,NULL,3,1,'','',2,''),(17,'zdfss','Thushara',1,'2020-04-21','901901901B','','user@domain.com','Colombo',1,NULL,NULL,3,1,'','',2,''),(18,'zdfsssfsfd','Thushara',1,'2020-04-21','901901901B','','user@domain.com','Colombo',1,NULL,NULL,3,1,'','',2,''),(19,'zdfsssfsfdsdfs','Thushara',1,'2020-04-21','901901901B','','user@domain.com','Colombo',1,NULL,NULL,3,1,'','',2,''),(20,'zdfsssfsfdsdfs','Thushara',1,'2020-04-21','901901901B','','user@domain.com','Colombo',1,NULL,NULL,3,1,'','',2,''),(21,'243234','Thushara',1,'2020-04-20','901901901B','','admin','Colombo',1,NULL,NULL,2,1,'','',2,''),(22,'student 2','a',1,'2020-04-20','901901901B','','admin','Colombo',1,NULL,NULL,3,1,'','',2,'');
/*!40000 ALTER TABLE `User` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-04-27 16:41:06
