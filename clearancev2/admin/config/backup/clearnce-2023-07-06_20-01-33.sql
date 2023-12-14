-- MariaDB dump 10.19  Distrib 10.4.28-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: clearnce
-- ------------------------------------------------------
-- Server version	10.4.28-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_name` varchar(150) NOT NULL,
  `admin_email` varchar(150) NOT NULL,
  `admin_pass` varchar(150) NOT NULL,
  `user_phone` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin`
--

LOCK TABLES `admin` WRITE;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` VALUES (1,'anas','zaezao90@gmail.com','$2y$12$Zv4X265g8PdAkWjPVTQEbua1LPO0maT183V.QTM6baJpYjCOWhDiW',0),(2,'malik','maliks@gmail.com','$2y$12$Cn8ydGVdal41jKbFuYjwKuIJPzxnWUlKieExUjCKeWG/K014z7JIe',1122);
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mcg`
--

DROP TABLE IF EXISTS `mcg`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mcg` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mcg_name` varchar(100) NOT NULL,
  `mcg_email` varchar(100) NOT NULL,
  `mcg_phone` varchar(100) NOT NULL,
  `mcg_pass` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mcg`
--

LOCK TABLES `mcg` WRITE;
/*!40000 ALTER TABLE `mcg` DISABLE KEYS */;
INSERT INTO `mcg` VALUES (1,'mcg','mcg@gmail.com','011111111','$2y$12$yFRp5Q0isux35uzu8CkdZu2aX/Jf96ZFTok9Ofci9E9J86XOxep9a');
/*!40000 ALTER TABLE `mcg` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orderes`
--

DROP TABLE IF EXISTS `orderes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orderes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `DRAFT_NO` varchar(150) NOT NULL,
  `BAYAN_NO` int(150) NOT NULL,
  `JOB_NO` int(150) NOT NULL,
  `TRANSPORTER` varchar(150) NOT NULL,
  `FROMP` varchar(150) NOT NULL,
  `TOPL` varchar(150) NOT NULL,
  `CONTRACT_NO` varchar(150) NOT NULL,
  `TYPE_OF_TRUCK` varchar(150) NOT NULL,
  `TRUCK_NO` varchar(150) NOT NULL,
  `DRIVER_NAME` varchar(150) NOT NULL,
  `DRIVER_MOBILE` varchar(150) NOT NULL,
  `Date` varchar(100) NOT NULL,
  `auth` varchar(150) NOT NULL,
  `D_O` varchar(300) NOT NULL,
  `requester_name` varchar(100) NOT NULL,
  `File_no` varchar(50) NOT NULL,
  `B_L` varchar(50) NOT NULL,
  `Consignee_no` varchar(50) NOT NULL,
  `Contact_name` varchar(50) NOT NULL,
  `Contact_no` varchar(50) NOT NULL,
  `Iqama_no` varchar(50) NOT NULL,
  `Item_qu` varchar(50) NOT NULL,
  `Port_ty` varchar(50) NOT NULL,
  `Cargo_des` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orderes`
--

LOCK TABLES `orderes` WRITE;
/*!40000 ALTER TABLE `orderes` DISABLE KEYS */;
INSERT INTO `orderes` VALUES (1,'220891',4654,4553,'OBS TRANSPORTER TRUCK','MGC','RYD','88M7896','Truck T','KSA546/ASA','comar','45688','2023-07-06','In Progress','','MGC','4896','OOLU','OTIS','NEZAM','9498156','46464','18 Packages','Sea','Elevator'),(2,'122248',8846,7788,'OBS TRANSPORTER TRUCK','MGC','RYD','88P564','8898','8989','DR','888','2023-07-06','waiting D/O SUBMIT','','MGC','5468','137899','OTIS','JEU','0554688','864','156 Packages','SEA','General'),(3,'248881',1354,4654,'OBS TRANSPORTER TRUCK','PORT','MGC','88P3546','','','','','2023-07-06 18:13:44','New','','Malik','','','','','','','','','');
/*!40000 ALTER TABLE `orderes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(150) NOT NULL,
  `user_email` varchar(150) NOT NULL,
  `user_pass` text NOT NULL,
  `user_no` varchar(111) NOT NULL,
  `user_auth` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (5,'anas','zaezao90@gmail.com','$2y$12$/gtGGY0VgffhXIY62yQznewPlRZcaLvYLhMsLcu.OX5g4r9ZLfoBm','0000',1),(6,'aahah','zaezao9000@gmail.com','$2y$12$XnhdEqhvvktIL4gS//FZPOgZ.8fCuJ2Ak8Se4F83.bQWFnSXEEUlK','000',1),(7,'Mohamed','zaezao90ss@gmail.com','$2y$12$ZbFnaqRSNapAzXqQFc7q5eK4ovZEM1TWMVfuQzUqmNzCM3GkzSVX2','4455566',1),(8,'MohamedAh','zaezao90ss@gmail.com','$2y$12$ClO4A4LzPYADOpImIr6XR.n2KGwfegJhij2Bk2nqZGHQd4Dq70Y.W','4455566',1),(9,'Mohameded','zaezao90ww@gmail.com','$2y$12$t9w7bZ/tJvCh0X.wXXcemeeLa6BKhb/Q1VZXrt61yD12kLEaKFLJW','4455566',1);
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

-- Dump completed on 2023-07-06 21:01:33
