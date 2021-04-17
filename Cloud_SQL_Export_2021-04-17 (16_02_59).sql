-- MySQL dump 10.13  Distrib 5.7.33, for Linux (x86_64)
--
-- Host: localhost    Database: creamline_db
-- ------------------------------------------------------
-- Server version	5.7.32-google-log

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
-- Current Database: `creamline_db`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `creamline_db` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `creamline_db`;

--
-- Table structure for table `ads`
--

DROP TABLE IF EXISTS `ads`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ads` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `ads_image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ads`
--

LOCK TABLES `ads` WRITE;
/*!40000 ALTER TABLE `ads` DISABLE KEYS */;
INSERT INTO `ads` VALUES (1,'1691933544.jpg',0,'2020-10-21 07:22:57','2021-02-27 02:36:17'),(2,'2060903152.jpg',0,'2020-10-21 07:23:02','2021-02-27 02:36:25');
/*!40000 ALTER TABLE `ads` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `areas`
--

DROP TABLE IF EXISTS `areas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `areas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `area_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `area_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `areas`
--

LOCK TABLES `areas` WRITE;
/*!40000 ALTER TABLE `areas` DISABLE KEYS */;
INSERT INTO `areas` VALUES (1,'Consolacion','6001',0,'2020-06-06 12:44:12','2021-04-15 07:38:04'),(2,'Lilo-an','6002',0,'2020-06-06 12:44:12','2021-04-15 07:38:07'),(3,'Compostela','6003',0,'2020-06-06 12:44:12','2021-04-15 07:38:12'),(4,'Danao City','6004',0,'2020-06-06 12:44:12','2021-04-15 07:38:14'),(5,'Carmen','6005',0,'2020-06-06 12:44:12','2021-04-15 07:38:21'),(6,'Catmon','6006',0,'2020-06-06 12:44:12','2021-04-15 07:38:23'),(7,'Sogod','6007',0,'2020-06-06 12:44:12','2021-04-15 07:38:31'),(8,'Borbon','6008',0,'2020-06-06 12:44:12','2021-04-15 07:38:50'),(9,'Tabogon','6009',0,'2020-06-06 12:44:12','2021-04-15 07:39:01'),(10,'Mandaue','6014',0,'2020-06-06 12:44:12','2020-06-06 12:45:36'),(11,'Compostela','6003',0,'2020-06-06 12:44:12','2020-06-06 12:45:36'),(12,'Talisay City','6045',0,'2020-06-06 12:44:12','2020-06-06 12:45:36'),(13,'surigao','8908',0,'2021-02-24 04:56:58','2021-02-24 04:57:32'),(14,'Bogo','6010',0,'2021-04-15 07:34:41','2021-04-15 07:34:41'),(15,'San Remegio','6011',0,'2021-04-15 07:35:02','2021-04-15 07:35:02'),(16,'Medellin','6012',0,'2021-04-15 07:35:14','2021-04-15 07:35:14'),(17,'Daan-Bantayan','6013',0,'2021-04-15 07:36:12','2021-04-15 07:36:12'),(18,'Tabuelan','6044',0,'2021-04-15 07:36:30','2021-04-15 07:36:30'),(19,'Tuburan','6043',0,'2021-04-15 07:36:44','2021-04-15 07:36:44'),(20,'Cebu City','6000',0,'2021-04-16 08:17:58','2021-04-16 08:17:58'),(21,'Cebu City','6000',0,'2021-04-16 08:18:13','2021-04-16 08:18:13');
/*!40000 ALTER TABLE `areas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `assigned_areas`
--

DROP TABLE IF EXISTS `assigned_areas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `assigned_areas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `area_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `assigned_areas`
--

LOCK TABLES `assigned_areas` WRITE;
/*!40000 ALTER TABLE `assigned_areas` DISABLE KEYS */;
INSERT INTO `assigned_areas` VALUES (4,23,1,'2021-04-15 03:01:22','2021-04-15 03:01:22'),(5,24,4,'2021-04-15 07:04:23','2021-04-15 07:04:23'),(6,24,4,'2021-04-15 07:04:26','2021-04-15 07:04:26'),(7,27,2,'2021-04-15 07:26:42','2021-04-15 07:26:42'),(8,29,3,'2021-04-15 07:51:50','2021-04-15 07:51:50'),(9,29,10,'2021-04-16 08:34:55','2021-04-16 08:34:55'),(10,30,5,'2021-04-16 09:07:50','2021-04-16 09:07:50'),(11,24,7,'2021-04-16 09:08:33','2021-04-16 09:08:33'),(12,31,9,'2021-04-16 09:18:45','2021-04-16 09:18:45'),(13,32,8,'2021-04-16 09:19:48','2021-04-16 09:19:48'),(14,33,12,'2021-04-17 03:47:56','2021-04-17 03:47:56'),(15,67,14,'2021-04-17 03:49:16','2021-04-17 03:49:16'),(16,27,3,'2021-04-17 06:02:37','2021-04-17 06:02:37'),(17,68,2,'2021-04-17 06:03:34','2021-04-17 06:03:34');
/*!40000 ALTER TABLE `assigned_areas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `carousels`
--

DROP TABLE IF EXISTS `carousels`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `carousels` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `carousel_img` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `is_new_arrival` tinyint(1) NOT NULL,
  `is_best_sellers` tinyint(1) NOT NULL,
  `is_carousel` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `carousels`
--

LOCK TABLES `carousels` WRITE;
/*!40000 ALTER TABLE `carousels` DISABLE KEYS */;
/*!40000 ALTER TABLE `carousels` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `carts`
--

DROP TABLE IF EXISTS `carts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `carts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int(11) DEFAULT NULL,
  `product_stock_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `product_image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `product_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `product_description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `size` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `flavor` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `price` double NOT NULL,
  `subtotal` double(8,2) DEFAULT NULL,
  `is_checkout` enum('0','1') COLLATE utf8_unicode_ci DEFAULT '0',
  `is_placed` enum('0','1') COLLATE utf8_unicode_ci DEFAULT '0' COMMENT '0 - no, 1 - yes',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `carts`
--

LOCK TABLES `carts` WRITE;
/*!40000 ALTER TABLE `carts` DISABLE KEYS */;
INSERT INTO `carts` VALUES (7,10,15,1,'S8ireyFMB8latvxE2b7jNhu628r7ZaZzuBtG8pTv.png','Double Dutch','Test Description','750',NULL,20,500,10000.00,'1','1','2021-04-15 09:09:10','2021-04-16 09:29:51'),(8,13,17,1,'4l1U9v1zAtOHzTOWLqVuDdBYCfi8mqHMzagzB76u.jpg','Sakura','Test Description','1.5l',NULL,12,700,8400.00,'1','1','2021-04-15 09:09:31','2021-04-16 09:29:52'),(9,9,14,28,'7qyxGOzoGWpD6iAMgAMiMYVbXdMdipNrjVZdJNPh.jpg','Peach','Test Description','750',NULL,20,300,6000.00,'1','1','2021-04-15 09:22:46','2021-04-16 09:35:25'),(10,1,3,28,'1358607368.jpg','Ube Pandan','Ube Pandan Description','10ml',NULL,10,10,100.00,'1','1','2021-04-15 10:01:55','2021-04-16 09:35:26'),(11,6,11,28,'QZ5jJbVUuj6boJxSusQbUhlg4bF9k2PcGmjmPgAb.png','Cookies and Cream','Test Description','350ml',NULL,10,150,1500.00,'1','1','2021-04-15 10:02:18','2021-04-16 09:35:26'),(12,10,15,28,'S8ireyFMB8latvxE2b7jNhu628r7ZaZzuBtG8pTv.png','Double Dutch','Test Description','750',NULL,10,500,5050.00,'1','1','2021-04-15 10:02:37','2021-04-16 09:35:27'),(13,15,19,35,'0KN9ie6G0HS1ghBZiKWarMjiFx5LJzfKXiqMfilO.jpg','Strawberry','Test Description','350ml',NULL,1,200,200.00,'1','1','2021-04-15 11:31:00','2021-04-15 13:44:06'),(14,13,17,35,'4l1U9v1zAtOHzTOWLqVuDdBYCfi8mqHMzagzB76u.jpg','Sakura','Test Description','1.5l',NULL,2,700,1400.00,'1','1','2021-04-15 11:43:59','2021-04-15 13:44:07'),(15,21,20,28,'M65f66wV0LdCgrAkPbvCXVQwa8pSdtFiTLemMgSK.jpg','Snickers Chocolate','Test Description','350ml',NULL,500,25,12500.00,'1','1','2021-04-16 09:43:29','2021-04-16 09:44:15'),(16,8,13,39,'D6VCKdA7KEDGoK93yQBpVFI12nKcxMWWYvGMiO0Z.png','Choco','Test Description','350ml',NULL,500,350,175000.00,'1','1','2021-04-16 09:49:18','2021-04-16 09:53:17'),(17,9,14,39,'7qyxGOzoGWpD6iAMgAMiMYVbXdMdipNrjVZdJNPh.jpg','Peach','Test Description','750',NULL,50,300,15000.00,'1','1','2021-04-16 09:49:32','2021-04-16 09:53:18'),(18,17,21,39,'s4yto7cBmwyxAZbfHDpoleHdoSh9Rp90qF5aUKRn.jpg','Dark Chocolate','Test Description','350ml',NULL,20,20,400.00,'1','1','2021-04-16 09:49:50','2021-04-16 09:53:18'),(19,15,19,39,'0KN9ie6G0HS1ghBZiKWarMjiFx5LJzfKXiqMfilO.jpg','Strawberry','Test Description','350ml',NULL,22,200,4400.00,'1','1','2021-04-16 09:50:04','2021-04-16 09:53:19'),(20,7,12,40,'wMnl73VPPfAdP1KxZmA33tlkfCpgB1Uxk6EyXqPi.png','Double Delight','Test Description','500ml',NULL,22,200,4400.00,'1','1','2021-04-16 09:57:11','2021-04-16 09:59:11'),(21,5,8,40,'cC8cvJmErL0bfqkzsUU432GAlkCm1fTUUUThw2Ve.png','Buko Salad','Test Description','350ml',NULL,55,150,8250.00,'1','1','2021-04-16 09:57:34','2021-04-16 09:59:12'),(22,3,2,40,'lV1vJdjJnByrr2Da4bo0TSNvF8MQB9Xjt4Dnj9zo.jpg','Mocha Ice Cream','Mocha Ice Cream Description','50ml',NULL,20,2,40.00,'1','1','2021-04-16 09:57:49','2021-04-16 09:59:12'),(23,2,1,40,'1225969935.jpg','Chocolate Ice Cream','Chocolate Ice Cream Description','11ml',NULL,20,15,300.00,'1','1','2021-04-16 09:58:08','2021-04-16 09:59:13'),(24,8,13,40,'D6VCKdA7KEDGoK93yQBpVFI12nKcxMWWYvGMiO0Z.png','Choco','Test Description','350ml',NULL,30,350,10500.00,'1','1','2021-04-16 09:58:25','2021-04-16 09:59:14'),(25,2,22,28,'1225969935.jpg','Chocolate Ice Cream','Chocolate Ice Cream Description','1 L',NULL,10,20,200.00,'0','0','2021-04-17 03:25:21','2021-04-17 03:25:21'),(26,3,6,43,'lV1vJdjJnByrr2Da4bo0TSNvF8MQB9Xjt4Dnj9zo.jpg','Mocha Ice Cream','Mocha Ice Cream Description','60ml',NULL,55,10,550.00,'1','1','2021-04-17 03:57:43','2021-04-17 04:02:37'),(27,9,14,43,'7qyxGOzoGWpD6iAMgAMiMYVbXdMdipNrjVZdJNPh.jpg','Peach','Test Description','750',NULL,30,300,9000.00,'1','1','2021-04-17 03:58:22','2021-04-17 04:02:38'),(28,14,18,43,'PezPOtAf3CESAM6eg2BDoYReLYJFZfQVZhrivdNo.jpg','Soy','Test Description','500ml',NULL,10,450,4500.00,'1','1','2021-04-17 03:58:45','2021-04-17 04:02:39'),(29,1,3,26,'1358607368.jpg','Ube Pandan','Ube Pandan Description','1 L',NULL,30,90,2700.00,'1','1','2021-04-17 05:55:25','2021-04-17 05:56:59'),(30,13,37,1,'4l1U9v1zAtOHzTOWLqVuDdBYCfi8mqHMzagzB76u.jpg','Sakura','Test Description','1 L',NULL,100,600,60000.00,'0','0','2021-04-17 06:09:52','2021-04-17 06:09:52'),(31,11,41,1,'IAXmGlggikxlRGaUDL0SMjE44uN5SToHaT1MVbk0.jpg','Pineapple','Test Description','750 ML',NULL,50,300,15000.00,'1','1','2021-04-17 06:20:01','2021-04-17 06:21:46');
/*!40000 ALTER TABLE `carts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `connection` text COLLATE utf8_unicode_ci NOT NULL,
  `queue` text COLLATE utf8_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fridges`
--

DROP TABLE IF EXISTS `fridges`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fridges` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `model` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `location` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `is_pullout` int(11) NOT NULL,
  `is_deleted` tinyint(1) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fridges`
--

LOCK TABLES `fridges` WRITE;
/*!40000 ALTER TABLE `fridges` DISABLE KEYS */;
INSERT INTO `fridges` VALUES (2,NULL,'Panasonic','Test Description','2',2,0,0,'2021-02-26 17:23:51','2021-04-17 03:37:53'),(3,NULL,'Samsung','Test Descrption',NULL,2,0,0,'2021-03-07 04:25:01','2021-04-17 03:35:35'),(4,NULL,'Sony-8000','Test Descrption',NULL,2,0,0,'2021-04-15 09:25:47','2021-04-17 03:35:01'),(5,NULL,'Tefcold ICSC Ice Cream Display Freezer','Test Description',NULL,2,0,0,'2021-04-17 03:30:32','2021-04-17 03:38:12'),(6,NULL,'Framec J Range Soft Scoop Ice Cream Display','Test Description',NULL,2,0,0,'2021-04-17 03:30:34','2021-04-17 03:38:38'),(7,NULL,'Framec Mini Cream 3V Countertop Ice Cream Display','Test Description',NULL,2,0,0,'2021-04-17 03:31:48','2021-04-17 03:46:15'),(8,NULL,'ISA Kaleido Ice Cream Display','Test Description',NULL,2,0,0,'2021-04-17 03:32:53','2021-04-17 03:53:34'),(9,NULL,'Condura CCF-200L','Test Description',NULL,1,0,0,'2021-04-17 03:34:24','2021-04-17 03:34:24'),(10,25,'GP-39','Test Decription',NULL,2,0,0,'2021-04-17 05:14:40','2021-04-17 05:15:00');
/*!40000 ALTER TABLE `fridges` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2019_08_19_000000_create_failed_jobs_table',1),(4,'2020_05_30_144612_create_ads_table',1),(5,'2020_05_30_144944_create_areas_table',1),(6,'2020_05_30_145123_create_stores_table',1),(7,'2020_05_30_145220_create_fridges_table',1),(8,'2020_05_30_145242_create_products_table',1),(9,'2020_05_30_145257_create_variations_table',1),(10,'2020_05_30_145319_create_stocks_table',1),(11,'2020_05_30_145331_create_promos_table',1),(12,'2020_05_30_145343_create_orders_table',1),(13,'2020_05_30_145432_create_product_file_reports_table',1),(14,'2020_06_28_082050_create_carts_table',1),(15,'2020_07_31_071139_create_sales_report_table',1),(16,'2020_08_02_060748_create_notifications_table',1),(17,'2020_08_02_060905_create_quotas_table',1),(18,'2020_08_24_124726_create_carousels_table',1),(19,'2020_08_24_125734_create_product_reports_table',1),(20,'2020_10_21_130102_create_product_damages_table',1),(21,'2020_10_21_130637_create_product_file_damages_table',1),(22,'2021_04_15_130900_create_sessions_table',2);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notifications` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `note_description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `order_id` int(11) NOT NULL,
  `stock_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notifications`
--

LOCK TABLES `notifications` WRITE;
/*!40000 ALTER TABLE `notifications` DISABLE KEYS */;
INSERT INTO `notifications` VALUES (4,'Thank you for ordering Creamline Products. Your Invoice # 2104160002 has been accepted. Total amount purchased of PHP 12650.00. Please expect it to be delivered on April 16 2021.',0,0,0,28,'2021-04-16 09:38:28','2021-04-16 09:38:28'),(5,'Thank you for ordering Creamline Products. Your Invoice # 2104160003 has been accepted. Total amount purchased of PHP 12500.00. Please expect it to be delivered on April 16 2021.',0,0,0,28,'2021-04-16 09:45:03','2021-04-16 09:45:03'),(6,'Thank you for ordering Creamline Products. Your Invoice # 2104160004 has been accepted. Total amount purchased of PHP 194800.00. Please expect it to be delivered on April 17 2021.',0,0,0,39,'2021-04-16 09:54:47','2021-04-16 09:54:47'),(7,'Thank you for ordering Creamline Products. Your Invoice # 2104150001 has been accepted. Total amount purchased of PHP 1600.00. Please expect it to be delivered on April 17 2021.',0,0,0,35,'2021-04-17 04:07:35','2021-04-17 04:07:35'),(8,'Thank you for ordering Creamline Products. Your Invoice # 2104170002 has been accepted. Total amount purchased of PHP 2700.00. Please expect it to be delivered on April 17 2021.',0,0,0,26,'2021-04-17 05:58:17','2021-04-17 05:58:17');
/*!40000 ALTER TABLE `notifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_invoice`
--

DROP TABLE IF EXISTS `order_invoice`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order_invoice` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `invoice_no` varchar(25) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_invoice`
--

LOCK TABLES `order_invoice` WRITE;
/*!40000 ALTER TABLE `order_invoice` DISABLE KEYS */;
INSERT INTO `order_invoice` VALUES (3,35,'2104150001','2021-04-15 13:44:04',NULL),(4,25,'2104160001','2021-04-16 09:29:49',NULL),(5,28,'2104160002','2021-04-16 09:35:23',NULL),(6,28,'2104160003','2021-04-16 09:44:13',NULL),(7,39,'2104160004','2021-04-16 09:53:15',NULL),(8,40,'2104160005','2021-04-16 09:59:09',NULL),(9,43,'2104170001','2021-04-17 04:02:36',NULL),(10,26,'2104170002','2021-04-17 05:56:57',NULL),(11,26,'2104170003','2021-04-17 06:21:44',NULL);
/*!40000 ALTER TABLE `order_invoice` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orders` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `client_id` int(11) DEFAULT NULL,
  `invoice_id` int(11) DEFAULT NULL,
  `delivery_date` date DEFAULT NULL,
  `store_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `product_stock_id` int(11) NOT NULL,
  `size` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `flavor` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `quantity_ordered` int(11) DEFAULT NULL,
  `ordered_total_price` double(8,2) DEFAULT NULL,
  `item_price` double(8,2) NOT NULL,
  `quantity_received` int(11) DEFAULT NULL,
  `received_total_price` double(8,2) DEFAULT NULL,
  `is_replacement` tinyint(1) DEFAULT NULL,
  `is_approved` tinyint(1) DEFAULT NULL,
  `is_cancelled` tinyint(1) DEFAULT NULL,
  `is_rescheduled` tinyint(1) DEFAULT NULL,
  `is_completed` tinyint(1) DEFAULT NULL,
  `is_damages` int(11) NOT NULL,
  `is_replacement_reference` int(11) NOT NULL,
  `order_cancel` int(11) NOT NULL,
  `cancelled_by` int(11) NOT NULL,
  `attempt` int(11) DEFAULT NULL,
  `reason` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (4,35,3,'2021-04-17',28,15,19,'350ml',NULL,1,200.00,200.00,0,0.00,0,1,0,0,0,0,0,0,0,0,'','2021-04-15 13:44:07','2021-04-17 04:07:34'),(5,35,3,'2021-04-17',28,13,17,'1.5l',NULL,2,1400.00,700.00,0,0.00,0,1,0,0,0,0,0,0,0,0,'','2021-04-15 13:44:07','2021-04-17 04:07:35'),(6,25,4,'2021-04-17',29,10,15,'750',NULL,20,10000.00,500.00,0,0.00,0,1,0,0,0,0,0,0,0,0,'','2021-04-16 09:29:52','2021-04-16 09:29:52'),(7,25,4,'2021-04-17',29,13,17,'1.5l',NULL,12,8400.00,700.00,0,0.00,0,1,0,0,0,0,0,0,0,0,'','2021-04-16 09:29:52','2021-04-16 09:29:52'),(8,28,5,'2021-04-16',27,9,14,'750',NULL,20,6000.00,300.00,0,0.00,0,1,0,0,0,0,0,0,0,0,'','2021-04-16 09:35:27','2021-04-16 09:38:25'),(9,28,5,'2021-04-16',27,1,3,'10ml',NULL,10,100.00,10.00,0,0.00,0,1,0,0,0,0,0,0,0,0,'','2021-04-16 09:35:27','2021-04-16 09:38:25'),(10,28,5,'2021-04-16',27,6,11,'350ml',NULL,10,1500.00,150.00,0,0.00,0,1,0,0,0,0,0,0,0,0,'','2021-04-16 09:35:27','2021-04-16 09:38:26'),(11,28,5,'2021-04-16',27,10,15,'750',NULL,10,5050.00,500.00,0,0.00,0,1,0,0,0,0,0,0,0,0,'','2021-04-16 09:35:27','2021-04-16 09:38:27'),(12,28,6,'2021-04-16',27,21,20,'350ml',NULL,500,12500.00,25.00,0,0.00,0,1,0,0,0,0,0,0,0,0,'','2021-04-16 09:44:15','2021-04-16 09:45:02'),(13,39,7,'2021-04-17',31,8,13,'350ml',NULL,500,175000.00,350.00,0,0.00,0,1,0,0,0,0,0,0,0,0,'','2021-04-16 09:53:19','2021-04-16 09:54:44'),(14,39,7,'2021-04-17',31,9,14,'750',NULL,50,15000.00,300.00,0,0.00,0,1,0,0,0,0,0,0,0,0,'','2021-04-16 09:53:19','2021-04-16 09:54:45'),(15,39,7,'2021-04-17',31,17,21,'350ml',NULL,20,400.00,20.00,0,0.00,0,1,0,0,0,0,0,0,0,0,'','2021-04-16 09:53:19','2021-04-16 09:54:46'),(16,39,7,'2021-04-17',31,15,19,'350ml',NULL,22,4400.00,200.00,0,0.00,0,1,0,0,0,0,0,0,0,0,'','2021-04-16 09:53:19','2021-04-16 09:54:46'),(17,40,8,NULL,32,7,12,'500ml',NULL,22,4400.00,200.00,0,0.00,0,0,0,0,0,0,0,0,0,0,'','2021-04-16 09:59:14','2021-04-16 09:59:14'),(18,40,8,NULL,32,5,8,'350ml',NULL,55,8250.00,150.00,0,0.00,0,0,0,0,0,0,0,0,0,0,'','2021-04-16 09:59:14','2021-04-16 09:59:14'),(19,40,8,NULL,32,3,2,'50ml',NULL,20,40.00,2.00,0,0.00,0,0,0,0,0,0,0,0,0,0,'','2021-04-16 09:59:14','2021-04-16 09:59:14'),(20,40,8,NULL,32,2,1,'11ml',NULL,20,300.00,15.00,0,0.00,0,0,0,0,0,0,0,0,0,0,'','2021-04-16 09:59:14','2021-04-16 09:59:14'),(21,40,8,NULL,32,8,13,'350ml',NULL,30,10500.00,350.00,0,0.00,0,0,0,0,0,0,0,0,0,0,'','2021-04-16 09:59:14','2021-04-16 09:59:14'),(22,43,9,NULL,35,3,6,'60ml',NULL,55,550.00,10.00,0,0.00,0,0,0,0,0,0,0,0,0,0,'','2021-04-17 04:02:39','2021-04-17 04:02:39'),(23,43,9,NULL,35,9,14,'750',NULL,30,9000.00,300.00,0,0.00,0,0,0,0,0,0,0,0,0,0,'','2021-04-17 04:02:39','2021-04-17 04:02:39'),(24,43,9,NULL,35,14,18,'500ml',NULL,10,4500.00,450.00,0,0.00,0,0,0,0,0,0,0,0,0,0,'','2021-04-17 04:02:39','2021-04-17 04:02:39'),(25,26,10,'2021-04-17',30,1,3,'1 L',NULL,30,2700.00,90.00,0,0.00,0,1,0,0,1,0,0,0,0,1,'','2021-04-17 05:56:59','2021-04-17 05:58:17'),(26,26,11,'2021-05-19',30,11,41,'750 ML',NULL,50,15000.00,300.00,0,0.00,0,1,0,0,0,0,0,0,0,0,'','2021-04-17 06:21:46','2021-04-17 06:21:46');
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
INSERT INTO `password_resets` VALUES ('ishizukaarvi@gmail.com','$2y$10$xE7INoZo7CmztvY.6t4fZOAL.9v3740FpjziPZX4U/1WwMjnJbWlO','2021-04-16 08:39:50');
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_damages`
--

DROP TABLE IF EXISTS `product_damages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_damages` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `size` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `flavor` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `client_id` int(11) NOT NULL,
  `is_replaced` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_damages`
--

LOCK TABLES `product_damages` WRITE;
/*!40000 ALTER TABLE `product_damages` DISABLE KEYS */;
/*!40000 ALTER TABLE `product_damages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_file_damages`
--

DROP TABLE IF EXISTS `product_file_damages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_file_damages` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `product_damage_id` int(11) NOT NULL,
  `file_damage_image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_file_damages`
--

LOCK TABLES `product_file_damages` WRITE;
/*!40000 ALTER TABLE `product_file_damages` DISABLE KEYS */;
/*!40000 ALTER TABLE `product_file_damages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_file_reports`
--

DROP TABLE IF EXISTS `product_file_reports`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_file_reports` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `product_report_id` int(11) NOT NULL,
  `file_report_image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_file_reports`
--

LOCK TABLES `product_file_reports` WRITE;
/*!40000 ALTER TABLE `product_file_reports` DISABLE KEYS */;
INSERT INTO `product_file_reports` VALUES (1,1,'vIcJk1avtXOO1omF14WphAnz3BnAWt2tVWuroQtJ.jpg','2021-04-15 10:40:34','2021-04-15 10:40:34');
/*!40000 ALTER TABLE `product_file_reports` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_images`
--

DROP TABLE IF EXISTS `product_images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) DEFAULT NULL,
  `file` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_images`
--

LOCK TABLES `product_images` WRITE;
/*!40000 ALTER TABLE `product_images` DISABLE KEYS */;
/*!40000 ALTER TABLE `product_images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_reports`
--

DROP TABLE IF EXISTS `product_reports`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_reports` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int(11) DEFAULT NULL,
  `report_type` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `size` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `flavor` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `store_id` int(11) DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL,
  `issued_by` int(11) DEFAULT NULL,
  `is_replaced` int(11) DEFAULT NULL,
  `delivery_date` varchar(55) COLLATE utf8_unicode_ci DEFAULT NULL,
  `reason` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_reports`
--

LOCK TABLES `product_reports` WRITE;
/*!40000 ALTER TABLE `product_reports` DISABLE KEYS */;
INSERT INTO `product_reports` VALUES (1,NULL,'Replacement',NULL,NULL,25,28,23,0,NULL,'ghgddjgjj','2021-04-15 10:40:32','2021-04-15 10:40:32');
/*!40000 ALTER TABLE `product_reports` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_stocks`
--

DROP TABLE IF EXISTS `product_stocks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_stocks` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `size` varchar(100) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `price` double NOT NULL,
  `threshold` int(11) NOT NULL,
  `promo` double NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_stocks`
--

LOCK TABLES `product_stocks` WRITE;
/*!40000 ALTER TABLE `product_stocks` DISABLE KEYS */;
INSERT INTO `product_stocks` VALUES (1,2,'500 ML',95,15,50,0,0,'2021-03-16 04:14:58','2021-04-17 04:03:22'),(2,3,'50ml',298,5,100,2,0,'2021-03-16 04:31:44','2021-03-17 06:22:24'),(3,1,'1 L',870,90,100,0,0,'2021-03-17 04:04:28','2021-04-17 06:06:29'),(4,1,'1.5 L',1000,150,10,10,0,'2021-03-17 04:05:21','2021-04-17 04:56:40'),(5,2,'750 ML',1000,25,100,10,0,'2021-03-17 04:23:13','2021-04-17 04:03:04'),(6,3,'60ml',350,10,100,0,0,'2021-03-17 04:33:54','2021-03-17 04:33:54'),(7,1,'750 ML',200,100,180,0,0,'2021-04-15 02:47:49','2021-04-17 05:00:28'),(8,5,'350 ML',1000,150,50,0,0,'2021-04-15 07:56:01','2021-04-17 05:28:55'),(9,5,'500 ML',1000,200,30,0,0,'2021-04-15 07:56:43','2021-04-17 05:28:17'),(10,5,'750 ML',1000,70,100,0,0,'2021-04-15 07:57:24','2021-04-17 05:27:31'),(11,6,'750 ML',1000,150,30,0,0,'2021-04-15 08:05:24','2021-04-17 05:29:20'),(12,7,'500 ML',1000,200,50,0,0,'2021-04-15 08:05:59','2021-04-17 05:24:33'),(13,8,'750 ML',1000,350,60,0,0,'2021-04-15 08:06:58','2021-04-17 05:25:21'),(14,9,'750 ML',1000,300,50,0,0,'2021-04-15 08:10:41','2021-04-17 05:32:08'),(15,10,'750 ML',1000,500,30,0,0,'2021-04-15 08:12:23','2021-04-17 05:40:00'),(16,12,'750 ML',1000,500,30,0,0,'2021-04-15 08:21:42','2021-04-17 05:30:21'),(17,13,'1.5 L',1000,700,50,0,0,'2021-04-15 08:22:11','2021-04-17 05:47:10'),(18,14,'750 ML',1000,450,50,0,0,'2021-04-15 08:22:47','2021-04-17 05:47:52'),(19,15,'750 ML',1000,200,50,0,0,'2021-04-15 08:23:25','2021-04-17 05:49:21'),(20,21,'750 ML',2500,250,500,0,0,'2021-04-16 09:40:16','2021-04-17 05:52:31'),(21,17,'1 L',1500,300,300,0,0,'2021-04-16 09:42:22','2021-04-17 05:50:58'),(22,2,'1 L',50000,50,100,20,0,'2021-04-17 03:16:34','2021-04-17 03:16:34'),(23,7,'100 ML',1000,200,50,0,0,'2021-04-17 05:23:43','2021-04-17 05:23:43'),(24,26,'750 ML',1000,100,500,0,0,'2021-04-17 05:29:45','2021-04-17 05:29:45'),(25,6,'1 L',1000,200,30,0,0,'2021-04-17 05:30:16','2021-04-17 05:30:16'),(26,26,'1 L',2000,100,55,0,0,'2021-04-17 05:30:24','2021-04-17 05:30:24'),(27,6,'1.5 L',1000,250,30,0,0,'2021-04-17 05:30:45','2021-04-17 05:30:45'),(28,8,'1 L',1000,400,60,0,0,'2021-04-17 05:31:16','2021-04-17 05:31:16'),(29,12,'1 L',1000,700,30,0,0,'2021-04-17 05:31:37','2021-04-17 05:31:37'),(30,12,'1.5 L',1000,800,30,0,0,'2021-04-17 05:32:09','2021-04-17 05:32:09'),(31,26,'1.5 L',5000,250,100,0,0,'2021-04-17 05:32:14','2021-04-17 05:32:14'),(32,9,'1 L',1000,350,50,0,0,'2021-04-17 05:33:43','2021-04-17 05:33:43'),(33,9,'1.5 L',1000,200,10,0,0,'2021-04-17 05:34:20','2021-04-17 05:38:32'),(34,25,'750 ML',2000,50,200,0,0,'2021-04-17 05:34:23','2021-04-17 05:34:23'),(35,25,'1 L',3000,50,22,0,0,'2021-04-17 05:35:12','2021-04-17 05:35:12'),(36,25,'1.5 L',3500,80,500,0,0,'2021-04-17 05:36:13','2021-04-17 05:36:13'),(37,13,'1 L',1000,600,50,0,0,'2021-04-17 05:36:43','2021-04-17 05:36:43'),(38,13,'750 ML',1000,500,50,0,0,'2021-04-17 05:37:16','2021-04-17 05:37:16'),(39,10,'1 L',1000,600,30,0,0,'2021-04-17 05:41:17','2021-04-17 05:41:17'),(40,10,'1.5 L',1000,700,60,0,0,'2021-04-17 05:41:55','2021-04-17 05:41:55'),(41,11,'750 ML',500,300,20,0,0,'2021-04-17 05:43:21','2021-04-17 05:43:21'),(42,11,'1 L',1000,400,30,0,0,'2021-04-17 05:43:43','2021-04-17 05:43:43'),(43,14,'1 L',1000,500,50,0,0,'2021-04-17 05:43:58','2021-04-17 05:43:58'),(44,11,'1.5 L',1000,500,30,0,0,'2021-04-17 05:44:10','2021-04-17 05:44:10'),(45,14,'1.5 L',1000,600,50,0,0,'2021-04-17 05:44:31','2021-04-17 05:44:31'),(46,15,'1 L',1000,300,50,0,0,'2021-04-17 05:46:22','2021-04-17 05:46:22'),(47,15,'1.5 L',1000,400,100,0,0,'2021-04-17 05:48:29','2021-04-17 05:50:04');
/*!40000 ALTER TABLE `product_stocks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `product_image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (1,'Ube Pandan','Ube Pandan Description','1358607368.jpg',0,'2020-10-21 05:38:40','2021-04-13 05:05:17'),(2,'Chocolate Ice Cream','Chocolate Ice Cream Description','1225969935.jpg',0,'2020-10-21 05:40:22','2021-04-13 05:05:43'),(3,'Mocha Ice Cream','Mocha Ice Cream Description','lV1vJdjJnByrr2Da4bo0TSNvF8MQB9Xjt4Dnj9zo.jpg',0,'2020-10-21 05:40:42','2021-04-14 12:24:55'),(5,'Buko Salad','Test Description','cC8cvJmErL0bfqkzsUU432GAlkCm1fTUUUThw2Ve.png',0,'2021-04-15 07:53:10','2021-04-15 07:53:10'),(6,'Cookies and Cream','Test Description','QZ5jJbVUuj6boJxSusQbUhlg4bF9k2PcGmjmPgAb.png',0,'2021-04-15 08:03:18','2021-04-15 08:03:18'),(7,'Double Delight','Test Description','wMnl73VPPfAdP1KxZmA33tlkfCpgB1Uxk6EyXqPi.png',0,'2021-04-15 08:04:29','2021-04-15 08:04:29'),(8,'Choco','Test Description','D6VCKdA7KEDGoK93yQBpVFI12nKcxMWWYvGMiO0Z.png',0,'2021-04-15 08:06:33','2021-04-15 08:06:33'),(9,'Peach','Test Description','7qyxGOzoGWpD6iAMgAMiMYVbXdMdipNrjVZdJNPh.jpg',0,'2021-04-15 08:09:01','2021-04-15 08:10:05'),(10,'Double Dutch','Test Description','S8ireyFMB8latvxE2b7jNhu628r7ZaZzuBtG8pTv.png',0,'2021-04-15 08:11:50','2021-04-15 08:11:50'),(11,'Pineapple','Test Description','IAXmGlggikxlRGaUDL0SMjE44uN5SToHaT1MVbk0.jpg',0,'2021-04-15 08:12:57','2021-04-15 08:12:57'),(12,'Almond','Test Description','0GL2bsBHtmFL2WvYEyTZJdTy7u7PWNUaaWrYjMWD.jpg',0,'2021-04-15 08:17:42','2021-04-15 08:17:42'),(13,'Sakura','Test Description','4l1U9v1zAtOHzTOWLqVuDdBYCfi8mqHMzagzB76u.jpg',0,'2021-04-15 08:20:00','2021-04-15 08:20:00'),(14,'Soy','Test Description','PezPOtAf3CESAM6eg2BDoYReLYJFZfQVZhrivdNo.jpg',0,'2021-04-15 08:20:19','2021-04-15 08:20:19'),(15,'Strawberry','Test Description','0KN9ie6G0HS1ghBZiKWarMjiFx5LJzfKXiqMfilO.jpg',0,'2021-04-15 08:20:49','2021-04-15 08:20:49'),(16,'Blue Berry Sandwich','Test Description','9vt36X00BtyFgeFFcFEAGy86TxoB0OeoUBqTIAtp.jpg',0,'2021-04-16 06:07:41','2021-04-16 06:07:41'),(17,'Dark Chocolate','Test Description','s4yto7cBmwyxAZbfHDpoleHdoSh9Rp90qF5aUKRn.jpg',0,'2021-04-16 06:10:55','2021-04-16 06:10:55'),(18,'Vanilla Caramel','Test Description','1dDQLhf5eebi6fUxRIDXELwwdrd8nckhb6OoyrSn.jpg',0,'2021-04-16 06:21:43','2021-04-16 06:21:43'),(19,'Mars Chololate','Test Description','l3bLlde4gUAFDfysHiKUZyg9dFFtbVAQOx8HCROl.jpg',0,'2021-04-16 06:22:15','2021-04-16 06:22:15'),(20,'Salted Caramel','Test Description','x8VfsS0lTS9ZMw2DHxFPUZiI9FW2JvWrHtVEoPfB.jpg',0,'2021-04-16 06:22:35','2021-04-16 06:22:35'),(21,'Snickers Chocolate','Test Description','M65f66wV0LdCgrAkPbvCXVQwa8pSdtFiTLemMgSK.jpg',0,'2021-04-16 06:29:01','2021-04-16 06:29:01'),(22,'Peanut Butter Icecream','Test Description','08ULbY6v0Qa4vLwZq5uu0vK9Lr7bKCcghm2jbHgr.jpg',0,'2021-04-16 07:00:38','2021-04-16 07:00:38'),(23,'Vanilla Bean Icecream','Test Description','OBnC4sPVMxtU2wjEWfFZEgwNnPg1gF5cEMAmirDG.jpg',0,'2021-04-16 07:11:19','2021-04-16 07:11:19'),(24,'Oreo Overload','Test Description','Fsa8y7sGvhdKOIEw1Dcoq1fJKczHJNomKOaANlud.jpg',0,'2021-04-16 07:12:31','2021-04-16 07:12:31'),(25,'Pestacio','Test Description','CxS8lVhlFRaT798byIp3LsRQiBTBwqPw23wqUfRR.jpg',0,'2021-04-16 07:13:15','2021-04-16 07:13:15'),(26,'Raspberry','Test Description','X3o3g5Gjk41SKTAsjRpaPmDv37PXOipSnqxz5cAL.jpg',0,'2021-04-16 07:13:51','2021-04-16 07:13:51');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `promos`
--

DROP TABLE IF EXISTS `promos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `promos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `promo_start_date` date NOT NULL,
  `promo_end_date` date NOT NULL,
  `promo_image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `discount` double(8,2) NOT NULL,
  `product_id` int(11) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `promos`
--

LOCK TABLES `promos` WRITE;
/*!40000 ALTER TABLE `promos` DISABLE KEYS */;
/*!40000 ALTER TABLE `promos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `quotas`
--

DROP TABLE IF EXISTS `quotas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `quotas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `year` int(11) NOT NULL,
  `jan` int(11) NOT NULL,
  `feb` int(11) NOT NULL,
  `mar` int(11) NOT NULL,
  `apr` int(11) NOT NULL,
  `may` int(11) NOT NULL,
  `jun` int(11) NOT NULL,
  `jul` int(11) NOT NULL,
  `aug` int(11) NOT NULL,
  `sep` int(11) NOT NULL,
  `oct` int(11) NOT NULL,
  `nov` int(11) NOT NULL,
  `dev` int(11) NOT NULL,
  `is_deleted` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `quotas`
--

LOCK TABLES `quotas` WRITE;
/*!40000 ALTER TABLE `quotas` DISABLE KEYS */;
INSERT INTO `quotas` VALUES (1,2021,0,0,0,0,0,0,0,0,0,0,0,0,0,'2021-02-27 03:39:31','2021-04-04 18:42:23');
/*!40000 ALTER TABLE `quotas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `replacement_products`
--

DROP TABLE IF EXISTS `replacement_products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `replacement_products` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `product_report_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `product_stock_id` int(11) DEFAULT NULL,
  `size` varchar(255) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `replacement_products`
--

LOCK TABLES `replacement_products` WRITE;
/*!40000 ALTER TABLE `replacement_products` DISABLE KEYS */;
INSERT INTO `replacement_products` VALUES (1,1,5,8,'350ml',150,10,'2021-04-15 10:40:33','2021-04-15 10:40:33'),(2,1,1,3,'10ml',10,25,'2021-04-15 10:40:33','2021-04-15 10:40:33');
/*!40000 ALTER TABLE `replacement_products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sales_report`
--

DROP TABLE IF EXISTS `sales_report`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sales_report` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sales_report`
--

LOCK TABLES `sales_report` WRITE;
/*!40000 ALTER TABLE `sales_report` DISABLE KEYS */;
/*!40000 ALTER TABLE `sales_report` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8_unicode_ci,
  `payload` text COLLATE utf8_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL,
  UNIQUE KEY `sessions_id_unique` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES ('ROExKWAjxuagltLUUoXMqoIvUAViehjSvpnxl8a4',35,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.114 Safari/537.36','YTo1OntzOjY6Il90b2tlbiI7czo0MDoid1lNZHZOTXpXM1FkU0FPc3ZHNEVYaHVlUGxXQ1QyQVJndUVZNEpJYSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjY6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9jYXJ0Ijt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MzU7czo5OiJjYXJ0X2RhdGEiO086Mzk6IklsbHVtaW5hdGVcRGF0YWJhc2VcRWxvcXVlbnRcQ29sbGVjdGlvbiI6MTp7czo4OiIAKgBpdGVtcyI7YToyOntpOjA7Tzo4OiJBcHBcQ2FydCI6Mjc6e3M6MTE6IgAqAGZpbGxhYmxlIjthOjEwOntpOjA7czoxMDoicHJvZHVjdF9pZCI7aToxO3M6NzoidXNlcl9pZCI7aToyO3M6MTM6InByb2R1Y3RfaW1hZ2UiO2k6MztzOjEyOiJwcm9kdWN0X25hbWUiO2k6NDtzOjE5OiJwcm9kdWN0X2Rlc2NyaXB0aW9uIjtpOjU7czo0OiJzaXplIjtpOjY7czo4OiJxdWFudGl0eSI7aTo3O3M6NToicHJpY2UiO2k6ODtzOjg6InN1YnRvdGFsIjtpOjk7czoxNjoicHJvZHVjdF9zdG9ja19pZCI7fXM6MTM6IgAqAGNvbm5lY3Rpb24iO3M6NToibXlzcWwiO3M6ODoiACoAdGFibGUiO3M6NToiY2FydHMiO3M6MTM6IgAqAHByaW1hcnlLZXkiO3M6MjoiaWQiO3M6MTA6IgAqAGtleVR5cGUiO3M6MzoiaW50IjtzOjEyOiJpbmNyZW1lbnRpbmciO2I6MTtzOjc6IgAqAHdpdGgiO2E6MDp7fXM6MTI6IgAqAHdpdGhDb3VudCI7YTowOnt9czoxMDoiACoAcGVyUGFnZSI7aToxNTtzOjY6ImV4aXN0cyI7YjoxO3M6MTg6Indhc1JlY2VudGx5Q3JlYXRlZCI7YjowO3M6MTM6IgAqAGF0dHJpYnV0ZXMiO2E6MTY6e3M6MjoiaWQiO2k6MTM7czoxMDoicHJvZHVjdF9pZCI7aToxNTtzOjE2OiJwcm9kdWN0X3N0b2NrX2lkIjtpOjE5O3M6NzoidXNlcl9pZCI7aTozNTtzOjEzOiJwcm9kdWN0X2ltYWdlIjtzOjQ0OiIwS045aWU2RzBIUzFnaEJaaUtXYXJNamlGeDVMSnpmS1hpcU1maWxPLmpwZyI7czoxMjoicHJvZHVjdF9uYW1lIjtzOjEwOiJTdHJhd2JlcnJ5IjtzOjE5OiJwcm9kdWN0X2Rlc2NyaXB0aW9uIjtzOjE2OiJUZXN0IERlc2NyaXB0aW9uIjtzOjQ6InNpemUiO3M6NToiMzUwbWwiO3M6NjoiZmxhdm9yIjtOO3M6ODoicXVhbnRpdHkiO2k6MTtzOjU6InByaWNlIjtkOjIwMDtzOjg6InN1YnRvdGFsIjtkOjIwMDtzOjExOiJpc19jaGVja291dCI7czoxOiIwIjtzOjk6ImlzX3BsYWNlZCI7czoxOiIwIjtzOjEwOiJjcmVhdGVkX2F0IjtzOjE5OiIyMDIxLTA0LTE1IDE5OjMxOjAwIjtzOjEwOiJ1cGRhdGVkX2F0IjtzOjE5OiIyMDIxLTA0LTE1IDE5OjMxOjAwIjt9czoxMToiACoAb3JpZ2luYWwiO2E6MTY6e3M6MjoiaWQiO2k6MTM7czoxMDoicHJvZHVjdF9pZCI7aToxNTtzOjE2OiJwcm9kdWN0X3N0b2NrX2lkIjtpOjE5O3M6NzoidXNlcl9pZCI7aTozNTtzOjEzOiJwcm9kdWN0X2ltYWdlIjtzOjQ0OiIwS045aWU2RzBIUzFnaEJaaUtXYXJNamlGeDVMSnpmS1hpcU1maWxPLmpwZyI7czoxMjoicHJvZHVjdF9uYW1lIjtzOjEwOiJTdHJhd2JlcnJ5IjtzOjE5OiJwcm9kdWN0X2Rlc2NyaXB0aW9uIjtzOjE2OiJUZXN0IERlc2NyaXB0aW9uIjtzOjQ6InNpemUiO3M6NToiMzUwbWwiO3M6NjoiZmxhdm9yIjtOO3M6ODoicXVhbnRpdHkiO2k6MTtzOjU6InByaWNlIjtkOjIwMDtzOjg6InN1YnRvdGFsIjtkOjIwMDtzOjExOiJpc19jaGVja291dCI7czoxOiIwIjtzOjk6ImlzX3BsYWNlZCI7czoxOiIwIjtzOjEwOiJjcmVhdGVkX2F0IjtzOjE5OiIyMDIxLTA0LTE1IDE5OjMxOjAwIjtzOjEwOiJ1cGRhdGVkX2F0IjtzOjE5OiIyMDIxLTA0LTE1IDE5OjMxOjAwIjt9czoxMDoiACoAY2hhbmdlcyI7YTowOnt9czo4OiIAKgBjYXN0cyI7YTowOnt9czoxNzoiACoAY2xhc3NDYXN0Q2FjaGUiO2E6MDp7fXM6ODoiACoAZGF0ZXMiO2E6MDp7fXM6MTM6IgAqAGRhdGVGb3JtYXQiO047czoxMDoiACoAYXBwZW5kcyI7YTowOnt9czoxOToiACoAZGlzcGF0Y2hlc0V2ZW50cyI7YTowOnt9czoxNDoiACoAb2JzZXJ2YWJsZXMiO2E6MDp7fXM6MTI6IgAqAHJlbGF0aW9ucyI7YTowOnt9czoxMDoiACoAdG91Y2hlcyI7YTowOnt9czoxMDoidGltZXN0YW1wcyI7YjoxO3M6OToiACoAaGlkZGVuIjthOjA6e31zOjEwOiIAKgB2aXNpYmxlIjthOjA6e31zOjEwOiIAKgBndWFyZGVkIjthOjE6e2k6MDtzOjE6IioiO319aToxO086ODoiQXBwXENhcnQiOjI3OntzOjExOiIAKgBmaWxsYWJsZSI7YToxMDp7aTowO3M6MTA6InByb2R1Y3RfaWQiO2k6MTtzOjc6InVzZXJfaWQiO2k6MjtzOjEzOiJwcm9kdWN0X2ltYWdlIjtpOjM7czoxMjoicHJvZHVjdF9uYW1lIjtpOjQ7czoxOToicHJvZHVjdF9kZXNjcmlwdGlvbiI7aTo1O3M6NDoic2l6ZSI7aTo2O3M6ODoicXVhbnRpdHkiO2k6NztzOjU6InByaWNlIjtpOjg7czo4OiJzdWJ0b3RhbCI7aTo5O3M6MTY6InByb2R1Y3Rfc3RvY2tfaWQiO31zOjEzOiIAKgBjb25uZWN0aW9uIjtzOjU6Im15c3FsIjtzOjg6IgAqAHRhYmxlIjtzOjU6ImNhcnRzIjtzOjEzOiIAKgBwcmltYXJ5S2V5IjtzOjI6ImlkIjtzOjEwOiIAKgBrZXlUeXBlIjtzOjM6ImludCI7czoxMjoiaW5jcmVtZW50aW5nIjtiOjE7czo3OiIAKgB3aXRoIjthOjA6e31zOjEyOiIAKgB3aXRoQ291bnQiO2E6MDp7fXM6MTA6IgAqAHBlclBhZ2UiO2k6MTU7czo2OiJleGlzdHMiO2I6MTtzOjE4OiJ3YXNSZWNlbnRseUNyZWF0ZWQiO2I6MDtzOjEzOiIAKgBhdHRyaWJ1dGVzIjthOjE2OntzOjI6ImlkIjtpOjE0O3M6MTA6InByb2R1Y3RfaWQiO2k6MTM7czoxNjoicHJvZHVjdF9zdG9ja19pZCI7aToxNztzOjc6InVzZXJfaWQiO2k6MzU7czoxMzoicHJvZHVjdF9pbWFnZSI7czo0NDoiNGwxVTl2MXpBdE9IelRPV0xxVnVEZEJZQ2ZpOG1xSE16YWd6Qjc2dS5qcGciO3M6MTI6InByb2R1Y3RfbmFtZSI7czo2OiJTYWt1cmEiO3M6MTk6InByb2R1Y3RfZGVzY3JpcHRpb24iO3M6MTY6IlRlc3QgRGVzY3JpcHRpb24iO3M6NDoic2l6ZSI7czo0OiIxLjVsIjtzOjY6ImZsYXZvciI7TjtzOjg6InF1YW50aXR5IjtpOjI7czo1OiJwcmljZSI7ZDo3MDA7czo4OiJzdWJ0b3RhbCI7ZDoxNDAwO3M6MTE6ImlzX2NoZWNrb3V0IjtzOjE6IjAiO3M6OToiaXNfcGxhY2VkIjtzOjE6IjAiO3M6MTA6ImNyZWF0ZWRfYXQiO3M6MTk6IjIwMjEtMDQtMTUgMTk6NDM6NTkiO3M6MTA6InVwZGF0ZWRfYXQiO3M6MTk6IjIwMjEtMDQtMTUgMTk6NDM6NTkiO31zOjExOiIAKgBvcmlnaW5hbCI7YToxNjp7czoyOiJpZCI7aToxNDtzOjEwOiJwcm9kdWN0X2lkIjtpOjEzO3M6MTY6InByb2R1Y3Rfc3RvY2tfaWQiO2k6MTc7czo3OiJ1c2VyX2lkIjtpOjM1O3M6MTM6InByb2R1Y3RfaW1hZ2UiO3M6NDQ6IjRsMVU5djF6QXRPSHpUT1dMcVZ1RGRCWUNmaThtcUhNemFnekI3NnUuanBnIjtzOjEyOiJwcm9kdWN0X25hbWUiO3M6NjoiU2FrdXJhIjtzOjE5OiJwcm9kdWN0X2Rlc2NyaXB0aW9uIjtzOjE2OiJUZXN0IERlc2NyaXB0aW9uIjtzOjQ6InNpemUiO3M6NDoiMS41bCI7czo2OiJmbGF2b3IiO047czo4OiJxdWFudGl0eSI7aToyO3M6NToicHJpY2UiO2Q6NzAwO3M6ODoic3VidG90YWwiO2Q6MTQwMDtzOjExOiJpc19jaGVja291dCI7czoxOiIwIjtzOjk6ImlzX3BsYWNlZCI7czoxOiIwIjtzOjEwOiJjcmVhdGVkX2F0IjtzOjE5OiIyMDIxLTA0LTE1IDE5OjQzOjU5IjtzOjEwOiJ1cGRhdGVkX2F0IjtzOjE5OiIyMDIxLTA0LTE1IDE5OjQzOjU5Ijt9czoxMDoiACoAY2hhbmdlcyI7YTowOnt9czo4OiIAKgBjYXN0cyI7YTowOnt9czoxNzoiACoAY2xhc3NDYXN0Q2FjaGUiO2E6MDp7fXM6ODoiACoAZGF0ZXMiO2E6MDp7fXM6MTM6IgAqAGRhdGVGb3JtYXQiO047czoxMDoiACoAYXBwZW5kcyI7YTowOnt9czoxOToiACoAZGlzcGF0Y2hlc0V2ZW50cyI7YTowOnt9czoxNDoiACoAb2JzZXJ2YWJsZXMiO2E6MDp7fXM6MTI6IgAqAHJlbGF0aW9ucyI7YTowOnt9czoxMDoiACoAdG91Y2hlcyI7YTowOnt9czoxMDoidGltZXN0YW1wcyI7YjoxO3M6OToiACoAaGlkZGVuIjthOjA6e31zOjEwOiIAKgB2aXNpYmxlIjthOjA6e31zOjEwOiIAKgBndWFyZGVkIjthOjE6e2k6MDtzOjE6IioiO319fX19',1618492339);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stocks`
--

DROP TABLE IF EXISTS `stocks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stocks` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `threshold` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stocks`
--

LOCK TABLES `stocks` WRITE;
/*!40000 ALTER TABLE `stocks` DISABLE KEYS */;
/*!40000 ALTER TABLE `stocks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stores`
--

DROP TABLE IF EXISTS `stores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stores` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `store_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `store_address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `area_id` int(11) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stores`
--

LOCK TABLES `stores` WRITE;
/*!40000 ALTER TABLE `stores` DISABLE KEYS */;
INSERT INTO `stores` VALUES (25,'gb store','talamban',28,1,1,'2021-04-15 08:55:11','2021-04-15 08:56:30'),(26,'Ken\'s Merchandise','Hernan Cortes St. Mandaue City',34,1,0,'2021-04-15 09:53:25','2021-04-15 09:53:25'),(27,'GB store','Poblacion',28,5,1,'2021-04-15 10:15:43','2021-04-16 09:06:02'),(28,'Zhavia','Mandaue',35,2,0,'2021-04-15 11:24:28','2021-04-15 11:24:28'),(29,'Candys Store','Mandaue',25,10,1,'2021-04-16 08:23:09','2021-04-16 08:23:24'),(30,'Otoke Convinience Store','tayud',26,2,1,'2021-04-16 08:55:33','2021-04-17 05:10:19'),(31,'Arsenl FC','Calvary Hill',39,7,1,'2021-04-16 09:11:17','2021-04-16 09:11:32'),(32,'Lab Convenience Store','Libjo',40,9,1,'2021-04-16 09:13:16','2021-04-16 09:13:38'),(33,'Number One','Cadaruhan',42,8,1,'2021-04-16 09:15:24','2021-04-16 09:15:39'),(34,'Tsushima Store','Belmont',49,12,1,'2021-04-17 03:43:53','2021-04-17 03:44:20'),(35,'One Stop','Centro',43,14,1,'2021-04-17 03:52:10','2021-04-17 03:52:52'),(36,'GOAT','Sudlon Sugod',73,1,0,'2021-04-17 05:49:21','2021-04-17 05:49:21');
/*!40000 ALTER TABLE `stores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `system_notifications`
--

DROP TABLE IF EXISTS `system_notifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `system_notifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `type` varchar(100) DEFAULT NULL,
  `area_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_stock_id` int(11) NOT NULL,
  `message` text,
  `email_to` enum('admin','staff','client') DEFAULT NULL,
  `status` enum('unread','read') NOT NULL DEFAULT 'unread',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `system_notifications`
--

LOCK TABLES `system_notifications` WRITE;
/*!40000 ALTER TABLE `system_notifications` DISABLE KEYS */;
INSERT INTO `system_notifications` VALUES (10,0,'running_out_stock',0,1,3,'Ube Pandan 10ml has reached the stock threshold. Please re-stock as soon as possible.','admin','unread','2021-04-13 05:29:30','2021-04-13 05:29:30'),(11,0,'out_of_stock',0,1,4,'Ube Pandan 15ml is out of stock. Please re-stock as soon as possible.','admin','unread','2021-04-13 05:29:30','2021-04-13 05:29:30'),(12,28,'approved_client_store',0,0,0,'Your new store named gb store located in talamban has been approved.<br> Click <a href=\"/store\">here</a> to see assigned sales agent.','client','unread','2021-04-15 08:56:28','2021-04-15 08:56:28'),(13,35,'approved_client',2,0,0,'(35) Panfilo Remedio is now added to your client’s list.<br> Click <a href=\"/client_list\">here</a> for details.','staff','unread','2021-04-15 11:25:19','2021-04-15 11:25:19'),(14,35,'approved_client',2,0,0,'Hi,Panfilo Remedio. Welcome to creamline. <br>You can now order <a href=\"/shop\">here</a>.','client','unread','2021-04-15 11:25:19','2021-04-15 11:25:19'),(15,38,'client_deactivation',0,0,0,'(38) John Arpon  is deactivated from the client’s list. ','staff','unread','2021-04-16 08:00:11','2021-04-16 08:00:11'),(16,38,'reminder_admin_client_deactivate',0,0,0,'(38) John Arpon  did not order within the 7-day allowance. He is now added to inactive list.                ','admin','unread','2021-04-16 08:00:11','2021-04-16 08:00:11'),(17,37,'client_deactivation',0,0,0,'(37) Seth Laroga  is deactivated from the client’s list. ','staff','unread','2021-04-16 08:00:14','2021-04-16 08:00:14'),(18,37,'reminder_admin_client_deactivate',0,0,0,'(37) Seth Laroga  did not order within the 7-day allowance. He is now added to inactive list.                ','admin','unread','2021-04-16 08:00:14','2021-04-16 08:00:14'),(19,41,'client_deactivation',0,0,0,'(41) Emma Tan  is deactivated from the client’s list. ','staff','unread','2021-04-16 08:00:36','2021-04-16 08:00:36'),(20,41,'reminder_admin_client_deactivate',0,0,0,'(41) Emma Tan  did not order within the 7-day allowance. He is now added to inactive list.                ','admin','unread','2021-04-16 08:00:37','2021-04-16 08:00:37'),(21,62,'client_deactivation',0,0,0,'(62) Stephen King  is deactivated from the client’s list. ','staff','unread','2021-04-16 08:10:40','2021-04-16 08:10:40'),(22,62,'reminder_admin_client_deactivate',0,0,0,'(62) Stephen King  did not order within the 7-day allowance. He is now added to inactive list.                ','admin','unread','2021-04-16 08:10:40','2021-04-16 08:10:40'),(23,61,'client_deactivation',0,0,0,'(61) Jack Item  is deactivated from the client’s list. ','staff','unread','2021-04-16 08:10:58','2021-04-16 08:10:58'),(24,61,'reminder_admin_client_deactivate',0,0,0,'(61) Jack Item  did not order within the 7-day allowance. He is now added to inactive list.                ','admin','unread','2021-04-16 08:10:58','2021-04-16 08:10:58'),(25,35,'client_deactivation',2,0,0,'(35) Panfilo Remedio  is deactivated from the client’s list. ','staff','unread','2021-04-16 08:14:11','2021-04-16 08:14:11'),(26,35,'reminder_admin_client_deactivate',2,0,0,'(35) Panfilo Remedio  did not order within the 7-day allowance. He is now added to inactive list.                ','admin','unread','2021-04-16 08:14:11','2021-04-16 08:14:11'),(27,45,'client_deactivation',0,0,0,'(45) Chester Bennington  is deactivated from the client’s list. ','staff','unread','2021-04-16 08:14:24','2021-04-16 08:14:24'),(28,45,'reminder_admin_client_deactivate',0,0,0,'(45) Chester Bennington  did not order within the 7-day allowance. He is now added to inactive list.                ','admin','unread','2021-04-16 08:14:25','2021-04-16 08:14:25'),(29,51,'client_deactivation',0,0,0,'(51) Rommel Reston  is deactivated from the client’s list. ','staff','unread','2021-04-16 08:14:53','2021-04-16 08:14:53'),(30,51,'reminder_admin_client_deactivate',0,0,0,'(51) Rommel Reston  did not order within the 7-day allowance. He is now added to inactive list.                ','admin','unread','2021-04-16 08:14:53','2021-04-16 08:14:53'),(31,25,'approved_client_store',0,0,0,'Your new store named Candys Store located in Mandaue has been approved.<br> Click <a href=\"/store\">here</a> to see assigned sales agent.','client','unread','2021-04-16 08:23:23','2021-04-16 08:23:23'),(32,28,'approved_client_store',0,0,0,'Your new store named GB store located in Poblacion has been approved.<br> Click <a href=\"/store\">here</a> to see assigned sales agent.','client','unread','2021-04-16 09:05:59','2021-04-16 09:05:59'),(33,39,'approved_client_store',0,0,0,'Your new store named Arsenl FC located in Calvary Hill has been approved.<br> Click <a href=\"/store\">here</a> to see assigned sales agent.','client','unread','2021-04-16 09:11:31','2021-04-16 09:11:31'),(34,40,'approved_client_store',0,0,0,'Your new store named Lab Convenience Store located in Libjo has been approved.<br> Click <a href=\"/store\">here</a> to see assigned sales agent.','client','unread','2021-04-16 09:13:37','2021-04-16 09:13:37'),(35,42,'approved_client_store',0,0,0,'Your new store named Number One located in Cadaruhan has been approved.<br> Click <a href=\"/store\">here</a> to see assigned sales agent.','client','unread','2021-04-16 09:15:38','2021-04-16 09:15:38'),(36,49,'approved_client_store',0,0,0,'Your new store named Tsushima Store located in Belmont has been approved.<br> Click <a href=\"/store\">here</a> to see assigned sales agent.','client','unread','2021-04-17 03:44:19','2021-04-17 03:44:19'),(37,43,'approved_client_store',0,0,0,'Your new store named One Stop located in Centro has been approved.<br> Click <a href=\"/store\">here</a> to see assigned sales agent.','client','unread','2021-04-17 03:52:52','2021-04-17 03:52:52'),(38,26,'approved_client_store',0,0,0,'Your new store named Otoke Convinience Store located in Tayud has been approved.<br> Click <a href=\"/store\">here</a> to see assigned sales agent.','client','unread','2021-04-17 05:09:13','2021-04-17 05:09:13'),(39,26,'client_deactivation',0,0,0,'(26) Masamune Alex Ishizuka  is deactivated from the client’s list. ','staff','unread','2021-04-17 05:10:39','2021-04-17 05:10:39'),(40,26,'reminder_admin_client_deactivate',0,0,0,'(26) Masamune Alex Ishizuka  did not order within the 7-day allowance. He is now added to inactive list.                ','admin','unread','2021-04-17 05:10:40','2021-04-17 05:10:40'),(41,0,'running_out_stock',0,9,33,'Peach 1 L has reached the stock threshold. Please re-stock as soon as possible.','admin','unread','2021-04-17 05:34:26','2021-04-17 05:34:26');
/*!40000 ALTER TABLE `system_notifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_fridges`
--

DROP TABLE IF EXISTS `user_fridges`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_fridges` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `store_id` int(11) DEFAULT NULL,
  `fridge_id` int(11) DEFAULT NULL,
  `sched_pullout` datetime DEFAULT NULL,
  `status` enum('available','unavailable') COLLATE utf8_unicode_ci DEFAULT 'available',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_fridges`
--

LOCK TABLES `user_fridges` WRITE;
/*!40000 ALTER TABLE `user_fridges` DISABLE KEYS */;
INSERT INTO `user_fridges` VALUES (1,NULL,25,4,NULL,'available','2021-04-15 09:27:47','2021-04-15 09:27:47'),(2,NULL,30,4,NULL,'available','2021-04-17 03:35:02','2021-04-17 03:35:02'),(3,NULL,25,3,NULL,'available','2021-04-17 03:35:36','2021-04-17 03:35:36'),(4,NULL,29,2,NULL,'available','2021-04-17 03:37:54','2021-04-17 03:37:54'),(5,NULL,31,5,NULL,'available','2021-04-17 03:38:13','2021-04-17 03:38:13'),(6,NULL,32,6,NULL,'available','2021-04-17 03:38:39','2021-04-17 03:38:39'),(7,NULL,34,7,NULL,'available','2021-04-17 03:46:16','2021-04-17 03:46:16'),(8,NULL,35,8,NULL,'available','2021-04-17 03:53:35','2021-04-17 03:53:35'),(9,25,30,10,NULL,'available','2021-04-17 05:15:01','2021-04-17 05:16:38');
/*!40000 ALTER TABLE `user_fridges` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `fname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contact_num` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_role` int(11) DEFAULT NULL COMMENT '99 - admin, 1 - staff, 2 client',
  `is_active` tinyint(1) DEFAULT '0',
  `is_pending` tinyint(1) DEFAULT NULL,
  `img` varchar(255) COLLATE utf8_unicode_ci DEFAULT '',
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `area_id` int(11) NOT NULL,
  `expiry` datetime DEFAULT NULL,
  `sent` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=74 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Admin','NA','NA','Pardo Cebu','0912312321','admin@creamline.com','2020-06-07 23:57:47','$2y$10$EN8DMgNgmRlqVPmSOAvmJO9vM/VJHWvgsXkBg9A2wgLnwidiOpWDO',99,1,0,'Upn1UTH65yw6SywgRwkDALTlrIY8H2VzmwlwvvTO.jpg','8icWxhGmkYeMkHr6kU2NWdNfCKYuw5xvVm8dd5S1ed9qo3lKYBDcsFRXIESS',0,NULL,0,'2020-06-06 18:42:21','2021-04-14 12:24:13'),(23,'staff','staff','staff','NA','09666147587','staff@creamline.com','2020-06-08 07:57:47','$2y$10$C0WCbJomDmW5upNE03y4lerETHkFrPy5lsLV6z91hSOPuVcYGlwa6',1,0,0,'NA','NA',1,NULL,0,'2021-04-15 03:01:00','2021-04-15 14:06:50'),(24,'staffsecond','staff','staff','NA','09123456789','staff2@creamline.com','2020-06-08 07:57:47','$2y$10$2QbPEx/ZmkW3xUVcj5267eIYs3hzRmrjMBYOTi0OylSPeF1hxV.sm',1,1,0,'NA','NA',7,NULL,0,'2021-04-15 06:59:19','2021-04-16 09:08:34'),(25,'Candy Carol','Briguez','Ochea','NA','09674371478','ocheacandy1998@gmail.com','2020-06-08 07:57:47','$2y$10$8aTtmM8.pEObZmnPAD4PROoxTtRmPltfClSs87PFXfjoyQUFlEviO',2,1,0,'NA','NA',0,NULL,0,'2021-04-15 07:06:56','2021-04-15 07:06:56'),(26,'Masamune Alex','Arvi','Ishizuka','NA','09666147587','ishizukaarvi@gmail.com','2020-06-08 07:57:47','$2y$10$cAx9mERt3NUqR1XuGuv0Tuo5pqoBd8U5ghLFzsqYiXwSBx8COstle',2,1,0,'NA','bvWx6B04wBrEc58mvvwASU8Vgb4hoSN9fFOwV8FtDMdKYUHD3YrGuMH4nJ58',0,NULL,0,'2021-04-15 07:11:15','2021-04-17 05:11:11'),(27,'Alex','Michael','Karev','NA','09086343228','alexkarev@gmail.com','2020-06-08 07:57:47','$2y$10$a6l9pH8f.c9wegoFBiOpPujzZf0NgdJ9Vy90gMQmhHdCwL95Zp43S',1,1,0,'NA','NA',3,NULL,0,'2021-04-15 07:15:51','2021-04-17 06:02:38'),(28,'Genesis','Catacutan','Bongo','NA','09086343228','genbongo@gmail.com','2020-06-08 07:57:47','$2y$10$SylygCAArkJ1GiC3j8d6y.OVLsY0dwlDtB8e8hKvP3Xeq.jTxZY.K',2,1,0,'NA','jevi9XHRwfu48ZJFj2PGiZzkWQahm6f0SyQrSebOS0vrkMhsMOddhRLbBvOc',0,NULL,0,'2021-04-15 07:17:23','2021-04-15 07:17:23'),(29,'Isobel','Alice','Stevens','NA','09123456789','isobelstevens@gmail.com','2020-06-08 07:57:47','$2y$10$tqP93lsnK6I2QL0mQX9SpOi7pX9G5xDcqC0eRkWP.fKhFKNUHcBbi',1,1,0,'NA','NA',10,NULL,0,'2021-04-15 07:19:51','2021-04-16 08:34:56'),(30,'Meredith','Ellis','Grey','NA','09789456123','meredithgrey@gmail.com','2020-06-08 07:57:47','$2y$10$6OCxXFneqjvVmIuHgMm4A.35SyAV6j8B6N3/bxh3Djrp9dHHVBci6',1,1,0,'NA','STaexMShBh0qAmAPe2vvTtdsrRXIJWkCb8ymU6kuxpgjY1dgbtt7z0EdHSya',5,NULL,0,'2021-04-15 07:20:57','2021-04-16 09:07:50'),(31,'Calliope','Iphegenia','Torres','NA','09456123789','callietorres@gmail.com','2020-06-08 07:57:47','$2y$10$FncroWCdQX.4vO1HV5cuF.GvVmC1jq/Ad5T16s3XN86yAFA9UYEDe',1,1,0,'NA','NA',9,NULL,0,'2021-04-15 07:23:40','2021-04-16 09:18:45'),(32,'Mark','Everett','Sloan','NA','09123789456','marksloan@gmail.com','2020-06-08 07:57:47','$2y$10$WkvkNZk5xwK5dq6warIY.OGgFAi7xnPuStkNI042Um8C0K5KRbmp2',1,1,0,'NA','NA',8,NULL,0,'2021-04-15 07:24:15','2021-04-16 09:19:49'),(33,'Alexandra','Caroline','Grey','NA','09963741852','lexiegrey@gmail.com','2020-06-08 07:57:47','$2y$10$rZHGk7EEBcR1W/dh7AJOm.BSQrQAwNpIVtgZVfORbs4.z5l7RugNi',1,1,0,'NA','4hspwtKcmPBFkrikFKT7KiRF1Hrd2tomZtwoCxsK7WXXsMPbzIukAAImIeWO',12,NULL,0,'2021-04-15 07:25:30','2021-04-17 03:47:57'),(34,'Candy','Briguez','Ochea','Mandaue','9420986973','13104206@usc.edu.ph',NULL,'$2y$10$2ov4oWkpZWmLFwf0T2pRb.Bfc.8HwkQ7Mk0qTzR31KavrBKgKn5P.',2,0,1,'',NULL,1,'2021-06-15 09:53:22',0,'2021-04-15 09:53:22','2021-04-15 09:53:22'),(35,'Panfilo','Ople','Remedio','Pilit Cabancalan Mandaue City Cebu','09157339459','panfilo.glophics@gmail.com',NULL,'$2y$10$FEchqFwf14309e.qhB5IUeKNO3jDXCjBeuuTqjPj0XaCaMiF3uS0W',2,1,0,'',NULL,2,'2021-06-15 11:24:25',0,'2021-04-15 11:24:25','2021-04-17 04:31:39'),(36,'Gen','Gen','Bongo','NA','09666147587','bongo@gmail.com','2020-06-08 07:57:47','$2y$10$mddjiFBDGzsKp6KgZn5Mz.Fz2KgFGQtH2Nm4MLi.ZnCBteDnK.uYW',1,0,0,'NA','NA',0,NULL,0,'2021-04-16 03:59:16','2021-04-17 03:48:48'),(37,'Seth','Garcia','Laroga','NA','09547621681','sethlaroga@gmail.com','2020-06-08 07:57:47','$2y$10$Xz1oyWtrAnlQIrSpBHJj2.9iRLWgseaf7pPexqpDGStnhftRMQJmu',2,0,0,'NA','NA',0,NULL,0,'2021-04-16 07:22:47','2021-04-16 08:00:18'),(38,'John','Dela Cruz','Arpon','NA','09758465214','jjarpon@gmail.com','2020-06-08 07:57:47','$2y$10$00IirBG4ofz2lnCxCmgtp.CvRCgd7ItYa.u22wyhbGkURb9Jn/RmO',2,0,0,'NA','NA',0,NULL,0,'2021-04-16 07:24:44','2021-04-16 08:00:15'),(39,'Spencer','Jon','Arsenal','NA','0987458216','spencer@gmail.com','2020-06-08 07:57:47','$2y$10$SbFDbgIfcSGS.crdIGGd8.vODczo5EtUdYxf6k0UsBkjf76A8Rp0S',2,1,0,'NA','nYC3SMhoxHEjCUy7vzgrex5bnkwtDAEaa4oHDveKq1vDIrM2HcB2DpHGRQO8',0,NULL,0,'2021-04-16 07:26:14','2021-04-16 07:26:14'),(40,'Fritzie','Garcia','Paraiso','NA','0987541654','zieparaiso@gmail.com','2020-06-08 07:57:47','$2y$10$mws8TiI1E1xuS08N.6wKLetQzMipFxJV6Jo4WPNh3kU1.whElk8EC',2,1,0,'NA','NA',0,NULL,0,'2021-04-16 07:28:59','2021-04-16 07:28:59'),(41,'Emma','Tiu','Tan','NA','0987458765','ett@gmail.com','2020-06-08 07:57:47','$2y$10$Ltdk6LvRGLcnsbTzS1VQc.ihIxMO109gzdhwoOW0ziDK1EfMDvw9e',2,0,0,'NA','NA',0,NULL,0,'2021-04-16 07:31:34','2021-04-16 08:00:39'),(42,'Nico','Uy','Bautista','NA','09878544250','Nico_Bautista@gmail.com','2020-06-08 07:57:47','$2y$10$AJOJbHsCtYh4IjB5jzxC3utEHZU6UwxaloWzJjJgKr0uIta/5IjZW',2,1,0,'NA','NA',0,NULL,0,'2021-04-16 07:32:37','2021-04-16 07:32:37'),(43,'Genevieve','Uy','Canete','NA','0915874561','Gencan@gmail.com','2020-06-08 07:57:47','$2y$10$EuGo6OU2LEAQ3A.eRUQjHe2na2ea972YRKwnvhqlzOgr6RuYfgpQ2',2,1,0,'NA','rC5qPtLpy4jo77O1XTCN4eyFkq9gPe8Pez4EvMy48WOC1W4lnawXGg4yEXkR',0,NULL,0,'2021-04-16 07:36:03','2021-04-16 07:36:03'),(44,'Rex','Alfredo','Layos','NA','0926547591','rexlayos22@gmail,com','2020-06-08 07:57:47','$2y$10$AVnfWJ8yv7WVOYxOJyLXVOuYAqT9ISYHja7I5o41WbYatAtU3kB76',2,1,0,'NA','NA',0,NULL,0,'2021-04-16 07:36:46','2021-04-16 07:36:46'),(45,'Chester','Bradey','Bennington','NA','09145242184','linkinpark@gmail.com','2020-06-08 07:57:47','$2y$10$RQhNOQaqWPW0PaiChC0KDu9RG5QaL5uDd8vAz7NHPzuC9FMwp26oG',2,0,0,'NA','NA',0,NULL,0,'2021-04-16 07:41:52','2021-04-16 08:14:27'),(46,'Thomas','Leoric','Solis','NA','09165478541','Thomas2212@gmail.com','2020-06-08 07:57:47','$2y$10$b86y5fZ2q0FnF/seiqeaceknLhTu/MIXXcIDX8Ylgwi2v9hMOX7z.',2,1,0,'NA','NA',0,NULL,0,'2021-04-16 07:42:46','2021-04-16 07:42:46'),(47,'Andrea','Sarah','Julia','NA','09056478596','Ag23@yahoo.com','2020-06-08 07:57:47','$2y$10$Rjh9OZOCnexcNLN6bWMeXOCQrZPrKqsXLj8I0/NgRzvcFuVBwkuVm',2,1,0,'NA','NA',0,NULL,0,'2021-04-16 07:43:31','2021-04-16 07:43:31'),(48,'Natasha','Garcia','Jordan','NA','09065412363','jordan23_nat@aol.com','2020-06-08 07:57:47','$2y$10$0TdrUNZ5BH3JMf/TunkBGevAX1p/hGATQrYkVmY2Zp29eiLiIDACy',2,1,0,'NA','NA',0,NULL,0,'2021-04-16 07:44:23','2021-04-16 07:44:23'),(49,'Lorenzo','Russelo','Bacaltos','NA','09156479666','lorenzobacaltos@gmail.com','2020-06-08 07:57:47','$2y$10$tZggVJBkNYnxGWTFkAQaAuCVKoKxTIl1L4utVs1iGQGeY2fyL1KUq',2,1,0,'NA','NA',0,NULL,0,'2021-04-16 07:51:17','2021-04-16 07:51:17'),(50,'Maris','Cabaraban','Catacutan','NA','09165444521','MarizCC@gmail.com','2020-06-08 07:57:47','$2y$10$c1IQiAraY0KaRoIfzJOmsOp2josTOAKKlwKzBKT7BExPFubzlIMiW',2,1,0,'NA','NA',0,NULL,0,'2021-04-16 07:51:57','2021-04-16 07:51:57'),(51,'Rommel','Garcia','Reston','NA','09256486663','nightowl@gmail.com','2020-06-08 07:57:47','$2y$10$gIylsukGnT5XIipTXFZGh.zOsLl/h0IK8SN1djSgqprZuM/SNPQIu',2,1,0,'NA','5c9acFXj3uEsCkGXKZpFSCC1YjPJZaodec7FPdeuutaBlBuYDD7BsZuTe3BK',0,NULL,0,'2021-04-16 07:52:49','2021-04-17 04:34:18'),(52,'Charmiane','Sarah','Whetherhall','NA','09236545516','girlpower@aol.com','2020-06-08 07:57:47','$2y$10$cwR.mhCD3e9xq4Lkxns58.nzSjEXEJ5UJ1gkMRhiPQEBgjg73lm4C',2,1,0,'NA','NA',0,NULL,0,'2021-04-16 07:53:38','2021-04-16 07:53:38'),(53,'Jameson','Ty','Suison','NA','09654285611','jamesgrinder22@gmail.com','2020-06-08 07:57:47','$2y$10$yZy3NlTC6RRGB2HhsdljFuET/rs9tgmT7ql.pRq5CBnyGeLK0Fwla',2,1,0,'NA','NA',0,NULL,0,'2021-04-16 07:55:23','2021-04-16 07:55:23'),(54,'Jose','Mari','Lapa','NA','09162323232','jm23@aol.com','2020-06-08 07:57:47','$2y$10$zd09pYGs2I1HioujQ3TyPu2w2dRf7kjcszKZ5Tb4zk59sKJ7/4WRu',2,1,0,'NA','NA',0,NULL,0,'2021-04-16 07:56:06','2021-04-16 07:56:06'),(55,'Christina','Tudtud','Durano','NA','09316526456','cebuana_ctd@yahoo.com','2020-06-08 07:57:47','$2y$10$zAWDP2b1jlM6lvZWhwm30uVcqK4Di3HDGQuTLlUS0rcBVb1JVESBS',2,1,0,'NA','NA',0,NULL,0,'2021-04-16 07:56:54','2021-04-16 07:56:54'),(56,'Patricia','Santiago','Abad','NA','09156666667','patabad@gmail.com','2020-06-08 07:57:47','$2y$10$OyRAUis0TFPUyqWVfkgdCOU8jold9spBjg5vs4NnEs5/LzYVqxfFu',2,1,0,'NA','NA',0,NULL,0,'2021-04-16 07:57:56','2021-04-16 07:57:56'),(57,'Patricio','Patigayon','Borbajo','NA','09157777777','legends_ND@gmail.com','2020-06-08 07:57:47','$2y$10$S6qKgtTxk44gaY0uUS/4Be58nRbU5TAZMaAlL9ds4LXiOnJYud72u',2,1,0,'NA','NA',0,NULL,0,'2021-04-16 07:59:57','2021-04-16 07:59:57'),(58,'Jean','Delapaz','Villamor','NA','09236525132','meanjeanmachine@yahoo.com','2020-06-08 07:57:47','$2y$10$m58prrJ6IyKd8v/ylg9HqulwOEd1GiW1x68pXOUziRw4tSSk.7YSK',2,1,0,'NA','NA',0,NULL,0,'2021-04-16 08:01:35','2021-04-16 08:01:35'),(59,'Jake','Capuyan','Moriones','NA','09168466213','dudejake@yahoo.com','2020-06-08 07:57:47','$2y$10$kRinLZTuZwn51Y.SQ7eW..3I0aOhcL7CLbWrgmZd6bL3wvvCy0gSS',2,1,0,'NA','NA',0,NULL,0,'2021-04-16 08:02:24','2021-04-16 08:02:24'),(60,'Patt','Ouano','Duran','NA','0964526141','patt1234@yahoo.com','2020-06-08 07:57:47','$2y$10$NScceSDZiY1BWL2WFyLXru4hestOox9Y9VY3GeeoW/U/cjNn3O.bq',2,1,0,'NA','NA',0,NULL,0,'2021-04-16 08:04:10','2021-04-16 08:04:10'),(61,'Jack','Rizalito','Item','NA','09065456541','jackskelington@gmail.com','2020-06-08 07:57:47','$2y$10$bRubbpyjYzrYotbYN18Ww.YYr3KKFFpfmXZL.h9PyU30b1gMxb1f6',2,0,0,'NA','NA',0,NULL,0,'2021-04-16 08:05:07','2021-04-16 08:11:01'),(62,'Stephen','Garcia','King','NA','0954521651','honestmac@gmail.com','2020-06-08 07:57:47','$2y$10$AkLRXL0G2YtY9BEVWpuDHuYHCQ13MK3832a4KcGuWuSrFZ71nNZpe',2,0,0,'NA','NA',0,NULL,0,'2021-04-16 08:06:19','2021-04-16 08:10:42'),(63,'Ronald','Bersamin','Garcia','NA','0934652161','ronbird@yahoo.com','2020-06-08 07:57:47','$2y$10$jYjafYQtNow6EfhmfcNzgu3hj/9suxg4xCBRd7TCcmeJAB8Ju0.QO',2,1,0,'NA','NA',0,NULL,0,'2021-04-16 08:16:23','2021-04-16 08:16:23'),(64,'Chris','Jordan','Caulfield','NA','09156545621','chris_caulf@gmail.com','2020-06-08 07:57:47','$2y$10$jkkb8QiX.laQr4Yw2jnPT.U06zwO47ch6izUXgiX6LZy9mprVCb0y',1,0,0,'NA','NA',0,NULL,0,'2021-04-16 08:37:23','2021-04-16 08:37:23'),(65,'Carrissa','Jones','James','NA','091546325','jamesjones@yahoo.com','2020-06-08 07:57:47','$2y$10$RucEcW84NEsAoAiEsf7k3.BN2V2SBHYW/6tLqMpudkJicoATtk2pm',1,0,0,'NA','NA',0,NULL,0,'2021-04-16 08:38:20','2021-04-16 08:38:20'),(66,'Christian','Jimenes','Mantalaba','NA','0987652145','baichan@gmail.com','2020-06-08 07:57:47','$2y$10$2LHn0YnvZQI9d/9.CwNaROePVk.jlIRqCInI05aKi.8hhreXdKw7.',1,0,0,'NA','NA',0,NULL,0,'2021-04-16 08:39:42','2021-04-16 08:39:42'),(67,'David','Chance','Groll','NA','0906452133','foofighter@yahoo.com','2020-06-08 07:57:47','$2y$10$E/Lz50bFe6GqGAcmFHuzpupDh60S/F5FMlm63x7bMSs520Pc4RusS',1,1,0,'NA','LA1cLxgHkOi8O0mQIr26jzXzxc9MiHFGjfUxVmQaHAytW4fkNFVAlsTPwJGn',14,NULL,0,'2021-04-16 08:40:47','2021-04-17 03:49:17'),(68,'Nico','Uy','Valenzona','NA','09345621451','bki_ph@gmail.com','2020-06-08 07:57:47','$2y$10$ImcdXEnVnFG6BTDlz9mJR.OHkzhOjd.LszX8DEMM/nxv3NGELoKWO',1,1,0,'NA','NA',2,NULL,0,'2021-04-16 08:41:46','2021-04-17 06:03:34'),(69,'Cyry','Delapaz','Mosote','NA','09065857455','cyryisme@gmail.com','2020-06-08 07:57:47','$2y$10$7uHdzEAagwtlTTpKfcpYgOUjze1Q3EN8GtlRNuNP0t4O4ZpWDmWeG',1,1,0,'NA','NA',0,NULL,0,'2021-04-16 08:42:42','2021-04-16 08:42:56'),(70,'Kurt','Donald','Cobain','NA','0923654125','nirvana@aol.com','2020-06-08 07:57:47','$2y$10$jrrUx0Ad3QYixGsd4qsmiOP7ItsVmALuyzMZGvfMtqsnsIQ9lPtEa',1,1,0,'NA','NA',0,NULL,0,'2021-04-16 08:44:27','2021-04-16 08:45:59'),(71,'mystaff','Sample','Test','NA','09157339459','mystaff@gmail.com','2020-06-08 07:57:47','$2y$10$Z4IuUKrSEc8gQ8Au4t8aUO0iGcOmpNjYuvL8wLn8xrKUU.rYona..',1,0,0,'NA','NA',0,NULL,0,'2021-04-16 12:15:38','2021-04-16 12:15:38'),(72,'Justin','A','Ishizuka','NA','09274473045','jstn@gmail.com','2020-06-08 07:57:47','$2y$10$R1lLP4Olcur3hg2hJl3KcOKRJXuKT8HVNII4lKEBsDiE/sYEMn.Oi',1,1,0,'NA','NA',0,NULL,0,'2021-04-17 04:52:15','2021-04-17 05:03:11'),(73,'Tom','Patrick','Brady','Sudlon Sugod','09175412541','tombrady@gmail.com',NULL,'$2y$10$EhnZocc4Q2sUIivp34PfJ.JPaKmaltySjvmyndjpMLOmZbvp7J4l6',2,0,1,'',NULL,1,'2021-06-17 05:49:18',0,'2021-04-17 05:49:18','2021-04-17 05:49:18');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `variations`
--

DROP TABLE IF EXISTS `variations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `variations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `size` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `flavor` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `price` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `promo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `variations`
--

LOCK TABLES `variations` WRITE;
/*!40000 ALTER TABLE `variations` DISABLE KEYS */;
/*!40000 ALTER TABLE `variations` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-04-17  8:04:19
