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
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `areas`
--

LOCK TABLES `areas` WRITE;
/*!40000 ALTER TABLE `areas` DISABLE KEYS */;
INSERT INTO `areas` VALUES (1,'Consolacion','6001',0,'2020-06-06 12:44:12','2021-04-15 07:38:04'),(2,'Lilo-an','6002',0,'2020-06-06 12:44:12','2021-04-15 07:38:07'),(3,'Compostela','6003',0,'2020-06-06 12:44:12','2021-04-15 07:38:12'),(4,'Danao City','6004',0,'2020-06-06 12:44:12','2021-04-15 07:38:14'),(5,'Carmen','6005',0,'2020-06-06 12:44:12','2021-04-15 07:38:21'),(6,'Catmon','6006',0,'2020-06-06 12:44:12','2021-04-15 07:38:23'),(7,'Sogod','6007',0,'2020-06-06 12:44:12','2021-04-15 07:38:31'),(8,'Borbon','6008',0,'2020-06-06 12:44:12','2021-04-15 07:38:50'),(9,'Tabogon','6009',0,'2020-06-06 12:44:12','2021-04-15 07:39:01'),(10,'Mandaue','6014',0,'2020-06-06 12:44:12','2020-06-06 12:45:36'),(11,'Compostela','6003',0,'2020-06-06 12:44:12','2020-06-06 12:45:36'),(12,'Talisay City','6045',0,'2020-06-06 12:44:12','2020-06-06 12:45:36'),(13,'surigao','8908',0,'2021-02-24 04:56:58','2021-02-24 04:57:32'),(14,'Bogo','6010',0,'2021-04-15 07:34:41','2021-04-15 07:34:41'),(15,'San Remegio','6011',0,'2021-04-15 07:35:02','2021-04-15 07:35:02'),(16,'Medellin','6012',0,'2021-04-15 07:35:14','2021-04-15 07:35:14'),(17,'Daan-Bantayan','6013',0,'2021-04-15 07:36:12','2021-04-15 07:36:12'),(18,'Tabuelan','6044',0,'2021-04-15 07:36:30','2021-04-15 07:36:30'),(19,'Tuburan','6043',0,'2021-04-15 07:36:44','2021-04-15 07:36:44');
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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `assigned_areas`
--

LOCK TABLES `assigned_areas` WRITE;
/*!40000 ALTER TABLE `assigned_areas` DISABLE KEYS */;
INSERT INTO `assigned_areas` VALUES (4,23,1,'2021-04-15 03:01:22','2021-04-15 03:01:22'),(5,24,4,'2021-04-15 07:04:23','2021-04-15 07:04:23'),(6,24,4,'2021-04-15 07:04:26','2021-04-15 07:04:26'),(7,27,2,'2021-04-15 07:26:42','2021-04-15 07:26:42'),(8,29,3,'2021-04-15 07:51:50','2021-04-15 07:51:50');
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
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `carts`
--

LOCK TABLES `carts` WRITE;
/*!40000 ALTER TABLE `carts` DISABLE KEYS */;
INSERT INTO `carts` VALUES (7,10,15,1,'S8ireyFMB8latvxE2b7jNhu628r7ZaZzuBtG8pTv.png','Double Dutch','Test Description','750',NULL,20,500,10000.00,'0','0','2021-04-15 09:09:10','2021-04-15 09:09:10'),(8,13,17,1,'4l1U9v1zAtOHzTOWLqVuDdBYCfi8mqHMzagzB76u.jpg','Sakura','Test Description','1.5l',NULL,10,700,7000.00,'0','0','2021-04-15 09:09:31','2021-04-15 09:09:31'),(9,9,14,28,'7qyxGOzoGWpD6iAMgAMiMYVbXdMdipNrjVZdJNPh.jpg','Peach','Test Description','750',NULL,20,300,6000.00,'0','0','2021-04-15 09:22:46','2021-04-15 09:22:46'),(10,1,3,28,'1358607368.jpg','Ube Pandan','Ube Pandan Description','10ml',NULL,10,10,100.00,'0','0','2021-04-15 10:01:55','2021-04-15 10:01:55'),(11,6,11,28,'QZ5jJbVUuj6boJxSusQbUhlg4bF9k2PcGmjmPgAb.png','Cookies and Cream','Test Description','350ml',NULL,10,150,1500.00,'0','0','2021-04-15 10:02:18','2021-04-15 10:02:18'),(12,10,15,28,'S8ireyFMB8latvxE2b7jNhu628r7ZaZzuBtG8pTv.png','Double Dutch','Test Description','750',NULL,10,500,5050.00,'0','0','2021-04-15 10:02:37','2021-04-15 10:02:37'),(13,15,19,35,'0KN9ie6G0HS1ghBZiKWarMjiFx5LJzfKXiqMfilO.jpg','Strawberry','Test Description','350ml',NULL,1,200,200.00,'0','0','2021-04-15 11:31:00','2021-04-15 11:31:00'),(14,13,17,35,'4l1U9v1zAtOHzTOWLqVuDdBYCfi8mqHMzagzB76u.jpg','Sakura','Test Description','1.5l',NULL,2,700,1400.00,'0','0','2021-04-15 11:43:59','2021-04-15 11:43:59');
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fridges`
--

LOCK TABLES `fridges` WRITE;
/*!40000 ALTER TABLE `fridges` DISABLE KEYS */;
INSERT INTO `fridges` VALUES (2,3,'Panasonic','test','2',3,0,0,'2021-02-26 17:23:51','2021-04-15 09:11:38'),(3,3,'Samsung','hehehehe',NULL,3,0,0,'2021-03-07 04:25:01','2021-04-15 09:27:18'),(4,NULL,'Sony-8000','Testing',NULL,4,0,0,'2021-04-15 09:25:47','2021-04-15 09:31:13');
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
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2019_08_19_000000_create_failed_jobs_table',1),(4,'2020_05_30_144612_create_ads_table',1),(5,'2020_05_30_144944_create_areas_table',1),(6,'2020_05_30_145123_create_stores_table',1),(7,'2020_05_30_145220_create_fridges_table',1),(8,'2020_05_30_145242_create_products_table',1),(9,'2020_05_30_145257_create_variations_table',1),(10,'2020_05_30_145319_create_stocks_table',1),(11,'2020_05_30_145331_create_promos_table',1),(12,'2020_05_30_145343_create_orders_table',1),(13,'2020_05_30_145432_create_product_file_reports_table',1),(14,'2020_06_28_082050_create_carts_table',1),(15,'2020_07_31_071139_create_sales_report_table',1),(16,'2020_08_02_060748_create_notifications_table',1),(17,'2020_08_02_060905_create_quotas_table',1),(18,'2020_08_24_124726_create_carousels_table',1),(19,'2020_08_24_125734_create_product_reports_table',1),(20,'2020_10_21_130102_create_product_damages_table',1),(21,'2020_10_21_130637_create_product_file_damages_table',1);
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notifications`
--

LOCK TABLES `notifications` WRITE;
/*!40000 ALTER TABLE `notifications` DISABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_invoice`
--

LOCK TABLES `order_invoice` WRITE;
/*!40000 ALTER TABLE `order_invoice` DISABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_stocks`
--

LOCK TABLES `product_stocks` WRITE;
/*!40000 ALTER TABLE `product_stocks` DISABLE KEYS */;
INSERT INTO `product_stocks` VALUES (1,2,'11ml',95,15,50,0,0,'2021-03-16 04:14:58','2021-03-19 04:56:16'),(2,3,'50ml',298,5,100,2,0,'2021-03-16 04:31:44','2021-03-17 06:22:24'),(3,1,'10ml',92,10,100,0,0,'2021-03-17 04:04:28','2021-03-19 04:56:16'),(4,1,'15ml',1000,15,10,10,0,'2021-03-17 04:05:21','2021-04-15 10:54:26'),(5,2,'12ml',1000,25,100,10,0,'2021-03-17 04:23:13','2021-03-17 04:23:13'),(6,3,'60ml',350,10,100,0,0,'2021-03-17 04:33:54','2021-03-17 04:33:54'),(7,1,'200ml',200,100,20,0,0,'2021-04-15 02:47:49','2021-04-15 02:48:05'),(8,5,'350ml',1000,150,50,0,0,'2021-04-15 07:56:01','2021-04-15 07:56:01'),(9,5,'500ml',1000,200,30,0,0,'2021-04-15 07:56:43','2021-04-15 08:02:20'),(10,5,'100ml',1000,70,100,0,0,'2021-04-15 07:57:24','2021-04-15 08:02:02'),(11,6,'350ml',1000,150,30,0,0,'2021-04-15 08:05:24','2021-04-15 08:05:24'),(12,7,'500ml',1000,200,50,0,0,'2021-04-15 08:05:59','2021-04-15 08:05:59'),(13,8,'350ml',1000,350,60,0,0,'2021-04-15 08:06:58','2021-04-15 08:06:58'),(14,9,'750',1000,300,50,0,0,'2021-04-15 08:10:41','2021-04-15 08:10:41'),(15,10,'750',1000,500,30,0,0,'2021-04-15 08:12:23','2021-04-15 08:12:23'),(16,12,'500ml',1000,500,30,0,0,'2021-04-15 08:21:42','2021-04-15 08:21:42'),(17,13,'1.5l',1000,700,50,0,0,'2021-04-15 08:22:11','2021-04-15 08:22:11'),(18,14,'500ml',1000,450,50,0,0,'2021-04-15 08:22:47','2021-04-15 08:22:47'),(19,15,'350ml',1000,200,50,0,0,'2021-04-15 08:23:25','2021-04-15 08:23:25');
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
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (1,'Ube Pandan','Ube Pandan Description','1358607368.jpg',0,'2020-10-21 05:38:40','2021-04-13 05:05:17'),(2,'Chocolate Ice Cream','Chocolate Ice Cream Description','1225969935.jpg',0,'2020-10-21 05:40:22','2021-04-13 05:05:43'),(3,'Mocha Ice Cream','Mocha Ice Cream Description','lV1vJdjJnByrr2Da4bo0TSNvF8MQB9Xjt4Dnj9zo.jpg',0,'2020-10-21 05:40:42','2021-04-14 12:24:55'),(5,'Buko Salad','Test Description','cC8cvJmErL0bfqkzsUU432GAlkCm1fTUUUThw2Ve.png',0,'2021-04-15 07:53:10','2021-04-15 07:53:10'),(6,'Cookies and Cream','Test Description','QZ5jJbVUuj6boJxSusQbUhlg4bF9k2PcGmjmPgAb.png',0,'2021-04-15 08:03:18','2021-04-15 08:03:18'),(7,'Double Delight','Test Description','wMnl73VPPfAdP1KxZmA33tlkfCpgB1Uxk6EyXqPi.png',0,'2021-04-15 08:04:29','2021-04-15 08:04:29'),(8,'Choco','Test Description','D6VCKdA7KEDGoK93yQBpVFI12nKcxMWWYvGMiO0Z.png',0,'2021-04-15 08:06:33','2021-04-15 08:06:33'),(9,'Peach','Test Description','7qyxGOzoGWpD6iAMgAMiMYVbXdMdipNrjVZdJNPh.jpg',0,'2021-04-15 08:09:01','2021-04-15 08:10:05'),(10,'Double Dutch','Test Description','S8ireyFMB8latvxE2b7jNhu628r7ZaZzuBtG8pTv.png',0,'2021-04-15 08:11:50','2021-04-15 08:11:50'),(11,'Pineapple','Test Description','IAXmGlggikxlRGaUDL0SMjE44uN5SToHaT1MVbk0.jpg',0,'2021-04-15 08:12:57','2021-04-15 08:12:57'),(12,'Almond','Test Description','0GL2bsBHtmFL2WvYEyTZJdTy7u7PWNUaaWrYjMWD.jpg',0,'2021-04-15 08:17:42','2021-04-15 08:17:42'),(13,'Sakura','Test Description','4l1U9v1zAtOHzTOWLqVuDdBYCfi8mqHMzagzB76u.jpg',0,'2021-04-15 08:20:00','2021-04-15 08:20:00'),(14,'Soy','Test Description','PezPOtAf3CESAM6eg2BDoYReLYJFZfQVZhrivdNo.jpg',0,'2021-04-15 08:20:19','2021-04-15 08:20:19'),(15,'Strawberry','Test Description','0KN9ie6G0HS1ghBZiKWarMjiFx5LJzfKXiqMfilO.jpg',0,'2021-04-15 08:20:49','2021-04-15 08:20:49');
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
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stores`
--

LOCK TABLES `stores` WRITE;
/*!40000 ALTER TABLE `stores` DISABLE KEYS */;
INSERT INTO `stores` VALUES (25,'gb store','talamban',28,1,1,'2021-04-15 08:55:11','2021-04-15 08:56:30'),(26,'Ken\'s Merchandise','Hernan Cortes St. Mandaue City',34,1,0,'2021-04-15 09:53:25','2021-04-15 09:53:25'),(27,'123 store','liloan',28,5,0,'2021-04-15 10:15:43','2021-04-15 10:16:07'),(28,'Zhavia','Mandaue',35,2,0,'2021-04-15 11:24:28','2021-04-15 11:24:28');
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
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `system_notifications`
--

LOCK TABLES `system_notifications` WRITE;
/*!40000 ALTER TABLE `system_notifications` DISABLE KEYS */;
INSERT INTO `system_notifications` VALUES (10,0,'running_out_stock',0,1,3,'Ube Pandan 10ml has reached the stock threshold. Please re-stock as soon as possible.','admin','unread','2021-04-13 05:29:30','2021-04-13 05:29:30'),(11,0,'out_of_stock',0,1,4,'Ube Pandan 15ml is out of stock. Please re-stock as soon as possible.','admin','unread','2021-04-13 05:29:30','2021-04-13 05:29:30'),(12,28,'approved_client_store',0,0,0,'Your new store named gb store located in talamban has been approved.<br> Click <a href=\"/store\">here</a> to see assigned sales agent.','client','unread','2021-04-15 08:56:28','2021-04-15 08:56:28'),(13,35,'approved_client',2,0,0,'(35) Panfilo Remedio is now added to your client’s list.<br> Click <a href=\"/client_list\">here</a> for details.','staff','unread','2021-04-15 11:25:19','2021-04-15 11:25:19'),(14,35,'approved_client',2,0,0,'Hi,Panfilo Remedio. Welcome to creamline. <br>You can now order <a href=\"/shop\">here</a>.','client','unread','2021-04-15 11:25:19','2021-04-15 11:25:19');
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_fridges`
--

LOCK TABLES `user_fridges` WRITE;
/*!40000 ALTER TABLE `user_fridges` DISABLE KEYS */;
INSERT INTO `user_fridges` VALUES (1,NULL,25,4,NULL,'available','2021-04-15 09:27:47','2021-04-15 09:27:47');
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
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Admin','NA','NA','Pardo Cebu','0912312321','admin@creamline.com','2020-06-07 23:57:47','$2y$10$EN8DMgNgmRlqVPmSOAvmJO9vM/VJHWvgsXkBg9A2wgLnwidiOpWDO',99,1,0,'Upn1UTH65yw6SywgRwkDALTlrIY8H2VzmwlwvvTO.jpg','JS1xLJdPdQxgYmfUP6THA1469QkiDsda0bq7sx8g8TjQXKG65ptfh8WowBE8',0,NULL,0,'2020-06-06 18:42:21','2021-04-14 12:24:13'),(23,'staff','staff','staff','NA','09666147587','staff@creamline.com','2020-06-08 07:57:47','$2y$10$4VAVxP1QBmoubEVV9eT0meEcScWxTjs69g/DFAr3keyghES6ezMM6',1,1,0,'NA','zLvExTciRtnvFtYSB0MAXthzKaK8Yv0tMpw29G5ZVs2ukjvrqw680yvLHtAy',1,NULL,0,'2021-04-15 03:01:00','2021-04-15 03:03:36'),(24,'staffsecond','staff','staff','NA','09123456789','staff2@creamline.com','2020-06-08 07:57:47','$2y$10$2QbPEx/ZmkW3xUVcj5267eIYs3hzRmrjMBYOTi0OylSPeF1hxV.sm',1,1,0,'NA','NA',4,NULL,0,'2021-04-15 06:59:19','2021-04-15 07:04:24'),(25,'Candy Carol','Briguez','Ochea','NA','09674371478','ocheacandy1998@gmail.com','2020-06-08 07:57:47','$2y$10$8aTtmM8.pEObZmnPAD4PROoxTtRmPltfClSs87PFXfjoyQUFlEviO',2,1,0,'NA','NA',0,NULL,0,'2021-04-15 07:06:56','2021-04-15 07:06:56'),(26,'Masamune Alex','Arvi','Ishizuka','NA','09666147587','ishizukaarvi@gmail.com','2020-06-08 07:57:47','$2y$10$cAx9mERt3NUqR1XuGuv0Tuo5pqoBd8U5ghLFzsqYiXwSBx8COstle',2,1,0,'NA','NA',0,NULL,0,'2021-04-15 07:11:15','2021-04-15 07:11:15'),(27,'Alex','Michael','Karev','NA','09086343228','alexkarev@gmail.com','2020-06-08 07:57:47','$2y$10$a6l9pH8f.c9wegoFBiOpPujzZf0NgdJ9Vy90gMQmhHdCwL95Zp43S',1,1,0,'NA','NA',2,NULL,0,'2021-04-15 07:15:51','2021-04-15 07:26:42'),(28,'Genesis','Catacutan','Bongo','NA','09086343228','genbongo@gmail.com','2020-06-08 07:57:47','$2y$10$SylygCAArkJ1GiC3j8d6y.OVLsY0dwlDtB8e8hKvP3Xeq.jTxZY.K',2,1,0,'NA','atWJ1F4UFv8NL4QvUWEyZQrltS1GPcQJ24dD9NPc5G8MaZNYfTA0xQZt2WXT',0,NULL,0,'2021-04-15 07:17:23','2021-04-15 07:17:23'),(29,'Isobel','Alice','Stevens','NA','09123456789','isobelstevens@gmail.com','2020-06-08 07:57:47','$2y$10$tqP93lsnK6I2QL0mQX9SpOi7pX9G5xDcqC0eRkWP.fKhFKNUHcBbi',1,1,0,'NA','NA',3,NULL,0,'2021-04-15 07:19:51','2021-04-15 07:51:50'),(30,'Meredith','Ellis','Grey','NA','09789456123','meredithgrey@gmail.com','2020-06-08 07:57:47','$2y$10$6OCxXFneqjvVmIuHgMm4A.35SyAV6j8B6N3/bxh3Djrp9dHHVBci6',1,1,0,'NA','NA',0,NULL,0,'2021-04-15 07:20:57','2021-04-15 07:25:49'),(31,'Calliope','Iphegenia','Torres','NA','09456123789','callietorres@gmail.com','2020-06-08 07:57:47','$2y$10$FncroWCdQX.4vO1HV5cuF.GvVmC1jq/Ad5T16s3XN86yAFA9UYEDe',1,1,0,'NA','NA',0,NULL,0,'2021-04-15 07:23:40','2021-04-15 07:25:54'),(32,'Mark','Everett','Sloan','NA','09123789456','marksloan@gmail.com','2020-06-08 07:57:47','$2y$10$WkvkNZk5xwK5dq6warIY.OGgFAi7xnPuStkNI042Um8C0K5KRbmp2',1,1,0,'NA','NA',0,NULL,0,'2021-04-15 07:24:15','2021-04-15 07:25:57'),(33,'Alexandra','Caroline','Grey','NA','09963741852','lexiegrey@gmail.com','2020-06-08 07:57:47','$2y$10$rZHGk7EEBcR1W/dh7AJOm.BSQrQAwNpIVtgZVfORbs4.z5l7RugNi',1,1,0,'NA','NA',0,NULL,0,'2021-04-15 07:25:30','2021-04-15 07:26:08'),(34,'Candy','Briguez','Ochea','Mandaue','9420986973','13104206@usc.edu.ph',NULL,'$2y$10$2ov4oWkpZWmLFwf0T2pRb.Bfc.8HwkQ7Mk0qTzR31KavrBKgKn5P.',2,0,1,'',NULL,1,'2021-06-15 09:53:22',0,'2021-04-15 09:53:22','2021-04-15 09:53:22'),(35,'Panfilo','Ople','Remedio','Pilit Cabancalan Mandaue City Cebu','09157339459','panfilo.glophics@gmail.com',NULL,'$2y$10$FEchqFwf14309e.qhB5IUeKNO3jDXCjBeuuTqjPj0XaCaMiF3uS0W',2,1,0,'',NULL,2,'2021-06-15 11:24:25',0,'2021-04-15 11:24:25','2021-04-15 11:25:18');
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

-- Dump completed on 2021-04-15 12:40:03
