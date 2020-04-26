-- MySQL dump 10.13  Distrib 8.0.19, for macos10.15 (x86_64)
--
-- Host: 127.0.0.1    Database: group_pro
-- ------------------------------------------------------
-- Server version	8.0.19

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
-- Table structure for table `document`
--

DROP TABLE IF EXISTS `document`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `document` (
  `document_id` int NOT NULL AUTO_INCREMENT,
  `uuid` bigint DEFAULT NULL,
  `file_name` varchar(45) DEFAULT NULL,
  `status` int DEFAULT NULL,
  PRIMARY KEY (`document_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `document`
--

LOCK TABLES `document` WRITE;
/*!40000 ALTER TABLE `document` DISABLE KEYS */;
INSERT INTO `document` VALUES (11,20200426110436,'AD.png',1);
/*!40000 ALTER TABLE `document` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `document_comment`
--

DROP TABLE IF EXISTS `document_comment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `document_comment` (
  `id` int NOT NULL AUTO_INCREMENT,
  `comment` varchar(45) DEFAULT NULL,
  `document_id` int DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  `created_date` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `document_id_idx` (`document_id`),
  CONSTRAINT `document_id` FOREIGN KEY (`document_id`) REFERENCES `document` (`document_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `document_comment`
--

LOCK TABLES `document_comment` WRITE;
/*!40000 ALTER TABLE `document_comment` DISABLE KEYS */;
INSERT INTO `document_comment` VALUES (2,'kjskjf',11,2,'2020-04-26 16:46:44');
/*!40000 ALTER TABLE `document_comment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `main_access`
--

DROP TABLE IF EXISTS `main_access`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `main_access` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_type` int DEFAULT NULL,
  `user_name` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `satatus` int NOT NULL DEFAULT '0',
  `dateTime` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `main_access`
--

LOCK TABLES `main_access` WRITE;
/*!40000 ALTER TABLE `main_access` DISABLE KEYS */;
INSERT INTO `main_access` VALUES (1,1,'admin','admin',1,'2020-04-16 13:05:14'),(2,2,'student','student',1,'2020-04-16 13:06:07'),(3,3,'tutor','tutor',1,'2020-04-16 13:06:25');
/*!40000 ALTER TABLE `main_access` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sms_batch_registration`
--

DROP TABLE IF EXISTS `sms_batch_registration`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sms_batch_registration` (
  `id` int NOT NULL AUTO_INCREMENT,
  `batch_id` int DEFAULT NULL,
  `batch_name` varchar(255) DEFAULT NULL,
  `batch_start_date` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `batch_remarks` varchar(255) DEFAULT NULL,
  `batch_enter_by` int DEFAULT NULL,
  `batch_enter_date` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `batch_update_date` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `batch_status` int DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sms_batch_registration`
--

LOCK TABLES `sms_batch_registration` WRITE;
/*!40000 ALTER TABLE `sms_batch_registration` DISABLE KEYS */;
/*!40000 ALTER TABLE `sms_batch_registration` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sms_student_registration`
--

DROP TABLE IF EXISTS `sms_student_registration`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sms_student_registration` (
  `id` int NOT NULL AUTO_INCREMENT,
  `student_id` int NOT NULL,
  `s_name_with_initial` varchar(255) NOT NULL,
  `s_full_name` varchar(255) DEFAULT NULL,
  `s_call_name` varchar(255) DEFAULT NULL,
  `s_nic` varchar(15) DEFAULT NULL,
  `s_dob` date DEFAULT NULL,
  `s_nationality` int DEFAULT NULL,
  `s_profile_image` varchar(255) DEFAULT NULL,
  `s_marital_status` int DEFAULT NULL,
  `s_gender` int DEFAULT NULL,
  `s_addres_line_1` varchar(255) DEFAULT NULL,
  `s_addres_line_2` varchar(255) DEFAULT NULL,
  `s_addres_city` varchar(255) DEFAULT NULL,
  `s_addres_electorate` varchar(255) DEFAULT NULL,
  `s_addres_district` varchar(255) DEFAULT NULL,
  `s_addres_province` varchar(255) DEFAULT NULL,
  `s_addres_country` varchar(255) DEFAULT NULL,
  `s_land_pnone_number` int DEFAULT NULL,
  `s_personal_pnone_number` int DEFAULT NULL,
  `s_office_pnone_number` int DEFAULT NULL,
  `s_office_email` varchar(255) DEFAULT NULL,
  `s_personal_mail` varchar(255) DEFAULT NULL,
  `s_active_status` varchar(255) DEFAULT NULL,
  `s_suspend_status` varchar(255) DEFAULT NULL,
  `s_enter_by` int DEFAULT NULL,
  `s_enter_date` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `s_update_date` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sms_student_registration`
--

LOCK TABLES `sms_student_registration` WRITE;
/*!40000 ALTER TABLE `sms_student_registration` DISABLE KEYS */;
/*!40000 ALTER TABLE `sms_student_registration` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sms_tutor_registration`
--

DROP TABLE IF EXISTS `sms_tutor_registration`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sms_tutor_registration` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tutor_id` int NOT NULL,
  `t_name_with_initial` varchar(255) DEFAULT NULL,
  `t_full_name` varchar(255) DEFAULT NULL,
  `t_call_name` varchar(255) DEFAULT NULL,
  `t_nic` varchar(15) DEFAULT NULL,
  `t_dob` date DEFAULT NULL,
  `t_nationality` int DEFAULT NULL,
  `t_profile_image` varchar(255) DEFAULT NULL,
  `t_marital_status` int DEFAULT '0',
  `t_gender` int DEFAULT NULL,
  `t_active_status` int NOT NULL DEFAULT '0',
  `t_suspend_status` int DEFAULT '0',
  `enter_by` int DEFAULT NULL,
  `enter_date` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `update_date` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sms_tutor_registration`
--

LOCK TABLES `sms_tutor_registration` WRITE;
/*!40000 ALTER TABLE `sms_tutor_registration` DISABLE KEYS */;
/*!40000 ALTER TABLE `sms_tutor_registration` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `student_assign_to_batch`
--

DROP TABLE IF EXISTS `student_assign_to_batch`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `student_assign_to_batch` (
  `id` int NOT NULL AUTO_INCREMENT,
  `b_student_reg_id` int DEFAULT NULL,
  `b_batch_id` int DEFAULT NULL,
  `b_available_from_date` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `b_ends_to_date` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `b_remarks` varchar(255) DEFAULT NULL,
  `b_status` int DEFAULT '0',
  `b_assigned_by` int DEFAULT NULL,
  `b_enter_date` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `b_updated_date` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `student_assign_to_batch`
--

LOCK TABLES `student_assign_to_batch` WRITE;
/*!40000 ALTER TABLE `student_assign_to_batch` DISABLE KEYS */;
/*!40000 ALTER TABLE `student_assign_to_batch` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'thushara'),(2,'buddhika');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'group_pro'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-04-26 18:40:07
