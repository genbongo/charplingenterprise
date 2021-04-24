-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 24, 2021 at 09:39 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `creamline_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `ads`
--

CREATE TABLE `ads` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ads_image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ads`
--

INSERT INTO `ads` (`id`, `ads_image`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 'YmtNMNgMsBtF1W9vmpQjCBkfaob3EEI9UgdhYQLe.jpg', 0, '2020-10-21 07:22:57', '2021-04-23 22:43:17'),
(2, '2060903152.jpg', 0, '2020-10-21 07:23:02', '2021-02-27 02:36:25'),
(3, 'pM7GoxcEiPbE83jIQtmCqjQOqSSYuNUi4tWNWabW.jpg', 0, '2021-04-23 22:41:17', '2021-04-23 22:41:17'),
(4, '15up4Vu7R8WphNHDfECa489voFZTmlOTOdSJTI8S.jpg', 0, '2021-04-23 22:48:37', '2021-04-23 22:48:37');

-- --------------------------------------------------------

--
-- Table structure for table `areas`
--

CREATE TABLE `areas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `area_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `area_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `areas`
--

INSERT INTO `areas` (`id`, `area_name`, `area_code`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 'Consolacion', '6001', 1, '2020-06-06 12:44:12', '2021-04-20 04:06:39'),
(2, 'Lilo-an', '6002', 0, '2020-06-06 12:44:12', '2021-04-15 07:38:07'),
(3, 'Compostela', '6003', 0, '2020-06-06 12:44:12', '2021-04-15 07:38:12'),
(4, 'Danao City', '6004', 0, '2020-06-06 12:44:12', '2021-04-15 07:38:14'),
(5, 'Carmen', '6005', 0, '2020-06-06 12:44:12', '2021-04-15 07:38:21'),
(6, 'Catmon', '6006', 0, '2020-06-06 12:44:12', '2021-04-15 07:38:23'),
(7, 'Sogod', '6007', 0, '2020-06-06 12:44:12', '2021-04-15 07:38:31'),
(8, 'Borbon', '6008', 0, '2020-06-06 12:44:12', '2021-04-15 07:38:50'),
(9, 'Tabogon', '6009', 0, '2020-06-06 12:44:12', '2021-04-15 07:39:01'),
(10, 'Mandaue', '6014', 0, '2020-06-06 12:44:12', '2020-06-06 12:45:36'),
(11, 'Compostela', '6003', 0, '2020-06-06 12:44:12', '2020-06-06 12:45:36'),
(12, 'Talisay City', '6045', 0, '2020-06-06 12:44:12', '2020-06-06 12:45:36'),
(13, 'surigao', '8908', 0, '2021-02-24 04:56:58', '2021-02-24 04:57:32'),
(14, 'Bogo', '6010', 0, '2021-04-15 07:34:41', '2021-04-15 07:34:41'),
(15, 'San Remegio', '6011', 0, '2021-04-15 07:35:02', '2021-04-15 07:35:02'),
(16, 'Medellin', '6012', 0, '2021-04-15 07:35:14', '2021-04-15 07:35:14'),
(17, 'Daan-Bantayan', '6013', 0, '2021-04-15 07:36:12', '2021-04-15 07:36:12'),
(18, 'Tabuelan', '6044', 0, '2021-04-15 07:36:30', '2021-04-15 07:36:30'),
(19, 'Tuburan', '6043', 0, '2021-04-15 07:36:44', '2021-04-15 07:36:44'),
(20, 'Cebu City', '6000', 0, '2021-04-16 08:17:58', '2021-04-16 08:17:58'),
(22, 'Consolacion', '6004', 0, '2021-04-20 03:52:28', '2021-04-20 03:53:28');

-- --------------------------------------------------------

--
-- Table structure for table `assigned_areas`
--

CREATE TABLE `assigned_areas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `area_id` int(11) DEFAULT NULL,
  `status` enum('active','inactive') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `assigned_areas`
--

INSERT INTO `assigned_areas` (`id`, `user_id`, `area_id`, `status`, `created_at`, `updated_at`) VALUES
(19, 76, 1, 'inactive', '2021-04-23 04:32:02', '2021-04-23 20:26:05'),
(20, 76, 3, 'inactive', '2021-04-23 19:28:34', '2021-04-23 20:26:05'),
(21, 76, 10, 'inactive', '2021-04-23 19:38:59', '2021-04-23 20:26:05'),
(22, 76, 2, 'inactive', '2021-04-23 19:40:28', '2021-04-23 20:26:05'),
(23, 76, 1, 'active', '2021-04-23 20:26:05', '2021-04-23 20:26:05');

-- --------------------------------------------------------

--
-- Table structure for table `carousels`
--

CREATE TABLE `carousels` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` int(11) NOT NULL,
  `carousel_img` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `is_new_arrival` tinyint(1) NOT NULL,
  `is_best_sellers` tinyint(1) NOT NULL,
  `is_carousel` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
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
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `product_id`, `product_stock_id`, `user_id`, `product_image`, `product_name`, `product_description`, `size`, `flavor`, `quantity`, `price`, `subtotal`, `is_checkout`, `is_placed`, `created_at`, `updated_at`) VALUES
(1, 1, 3, 75, '1358607368.jpg', 'Ube Pandan', 'Ube Pandan Description', '1 L', NULL, 2, 90, 180.00, '1', '1', '2021-04-23 06:36:46', '2021-04-23 06:37:21'),
(2, 11, 41, 75, 'IAXmGlggikxlRGaUDL0SMjE44uN5SToHaT1MVbk0.jpg', 'Pineapple', 'Test Description', '750 ML', NULL, 1, 300, 300.00, '1', '1', '2021-04-23 06:36:54', '2021-04-23 06:37:21'),
(3, 21, 20, 75, 'M65f66wV0LdCgrAkPbvCXVQwa8pSdtFiTLemMgSK.jpg', 'Snickers Chocolate', 'Test Description', '750 ML', NULL, 4, 250, 1000.00, '1', '1', '2021-04-23 06:40:54', '2021-04-23 06:50:48'),
(4, 1, 4, 75, '1358607368.jpg', 'Ube Pandan', 'Ube Pandan Description', '1.5 L', '', 2, 0, 300.00, '1', '1', '2021-04-23 19:17:00', '2021-04-23 19:17:00'),
(5, 5, 8, 75, 'cC8cvJmErL0bfqkzsUU432GAlkCm1fTUUUThw2Ve.png', 'Buko Salad', 'Test Description', '350 ML', '', 5, 0, 750.00, '1', '1', '2021-04-23 19:17:00', '2021-04-23 19:17:00'),
(6, 2, 5, 75, '1225969935.jpg', 'Chocolate Ice Cream', 'Chocolate Ice Cream Description', '750 ML', '', 5, 0, 125.00, '1', '1', '2021-04-23 19:46:02', '2021-04-23 19:46:02'),
(7, 3, 2, 75, 'lV1vJdjJnByrr2Da4bo0TSNvF8MQB9Xjt4Dnj9zo.jpg', 'Mocha Ice Cream', 'Mocha Ice Cream Description', '50ml', '', 3, 0, 15.00, '1', '1', '2021-04-23 19:46:02', '2021-04-23 19:46:02'),
(8, 26, 24, 75, 'X3o3g5Gjk41SKTAsjRpaPmDv37PXOipSnqxz5cAL.jpg', 'Raspberry', 'Test Description', '750 ML', NULL, 2, 100, 200.00, '1', '1', '2021-04-23 20:22:51', '2021-04-23 20:23:10'),
(9, 26, 24, 75, 'X3o3g5Gjk41SKTAsjRpaPmDv37PXOipSnqxz5cAL.jpg', 'Raspberry', 'Test Description', '750 ML', NULL, 1, 100, 100.00, '1', '1', '2021-04-23 20:46:33', '2021-04-23 20:47:17'),
(10, 29, 50, 75, 'qwlx3RAdvHVzkjUo53HrCHXfWkcX01Kalggq31nY.jpg', 'testsssssssssssssssssssssssss', 'ddssds', '2 ML', NULL, 2, 11, 22.00, '1', '1', '2021-04-23 21:06:54', '2021-04-23 21:07:17'),
(11, 10, 15, 75, 'S8ireyFMB8latvxE2b7jNhu628r7ZaZzuBtG8pTv.png', 'Double Dutch', 'Test Description', '750 ML', NULL, 2, 500, 1000.00, '1', '1', '2021-04-23 22:00:05', '2021-04-23 22:01:27'),
(12, 1, 3, 75, '1358607368.jpg', 'Ube Pandan', 'Ube Pandan Description', '1 L', '', 3, 0, 270.00, '1', '1', '2021-04-23 22:21:07', '2021-04-23 22:21:07'),
(13, 29, 50, 75, 'qwlx3RAdvHVzkjUo53HrCHXfWkcX01Kalggq31nY.jpg', 'testsssssssssssssssssssssssss', 'ddssds', '2 ML', NULL, 2, 11, 22.00, '1', '1', '2021-04-23 22:20:52', '2021-04-23 22:21:09'),
(14, 29, 50, 1, 'qwlx3RAdvHVzkjUo53HrCHXfWkcX01Kalggq31nY.jpg', 'testsssssssssssssssssssssssss', 'ddssds', '2 ML', NULL, 2, 11, 22.00, '0', '0', '2021-04-23 22:52:15', '2021-04-23 22:52:15'),
(15, 25, 34, 75, 'CxS8lVhlFRaT798byIp3LsRQiBTBwqPw23wqUfRR.jpg', 'Pestacio', 'Test Description', '750 ML', NULL, 2, 50, 100.00, '1', '1', '2021-04-23 22:57:09', '2021-04-23 23:38:16');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8_unicode_ci NOT NULL,
  `queue` text COLLATE utf8_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fridges`
--

CREATE TABLE `fridges` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `model` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `location` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `is_pullout` int(11) NOT NULL,
  `is_deleted` tinyint(1) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `fridges`
--

INSERT INTO `fridges` (`id`, `user_id`, `model`, `description`, `location`, `status`, `is_pullout`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Panasonic', 'Test Description', '2', 1, 0, 1, '2021-02-26 17:23:51', '2021-04-23 03:57:16'),
(2, NULL, 'Samsung', 'Test Descrption', NULL, 2, 0, 0, '2021-03-07 04:25:01', '2021-04-17 03:35:35'),
(3, NULL, 'HJHJHJ', 'MMKMKM', NULL, 1, 0, 0, '2021-04-23 23:21:42', '2021-04-23 23:21:42');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2020_05_30_144612_create_ads_table', 1),
(5, '2020_05_30_144944_create_areas_table', 1),
(6, '2020_05_30_145123_create_stores_table', 1),
(7, '2020_05_30_145220_create_fridges_table', 1),
(8, '2020_05_30_145242_create_products_table', 1),
(9, '2020_05_30_145257_create_variations_table', 1),
(10, '2020_05_30_145319_create_stocks_table', 1),
(11, '2020_05_30_145331_create_promos_table', 1),
(12, '2020_05_30_145343_create_orders_table', 1),
(13, '2020_05_30_145432_create_product_file_reports_table', 1),
(14, '2020_06_28_082050_create_carts_table', 1),
(15, '2020_07_31_071139_create_sales_report_table', 1),
(16, '2020_08_02_060748_create_notifications_table', 1),
(17, '2020_08_02_060905_create_quotas_table', 1),
(18, '2020_08_24_124726_create_carousels_table', 1),
(19, '2020_08_24_125734_create_product_reports_table', 1),
(20, '2020_10_21_130102_create_product_damages_table', 1),
(21, '2020_10_21_130637_create_product_file_damages_table', 1),
(22, '2021_04_15_130900_create_sessions_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `note_description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `order_id` int(11) NOT NULL,
  `stock_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `note_description`, `order_id`, `stock_id`, `user_id`, `customer_id`, `created_at`, `updated_at`) VALUES
(1, 'Your Damage request # 3 has been disapproved. Please be advised accordingly', 0, 0, 0, 75, '2021-04-23 19:08:11', '2021-04-23 19:08:11');

-- --------------------------------------------------------

--
-- Table structure for table `notification_counter`
--

CREATE TABLE `notification_counter` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `current_notif` int(11) NOT NULL,
  `updated_notif` int(11) NOT NULL,
  `modified` datetime DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notification_counter`
--

INSERT INTO `notification_counter` (`id`, `user_id`, `current_notif`, `updated_notif`, `modified`, `updated_at`, `created_at`) VALUES
(15, 1, 5, 5, '2021-04-24 00:00:00', '2021-04-23 13:30:05', '2021-04-23 13:30:05'),
(16, 75, 1, 1, '2021-04-24 00:00:00', '2021-04-23 13:30:07', '2021-04-23 13:30:07'),
(17, 1, 6, 5, '2021-04-24 00:00:00', '2021-04-23 13:30:09', '2021-04-23 13:30:09'),
(18, 75, 2, 1, '2021-04-24 00:00:00', '2021-04-23 14:40:18', '2021-04-23 14:40:18'),
(19, 75, 3, 1, '2021-04-24 00:00:00', '2021-04-23 14:57:43', '2021-04-23 14:57:43'),
(20, 75, 4, 1, '2021-04-24 00:00:00', '2021-04-24 03:00:18', '2021-04-24 03:00:18'),
(21, 1, 7, 1, '2021-04-24 00:00:00', '2021-04-24 03:22:04', '2021-04-24 03:22:04'),
(22, 1, 8, 1, '2021-04-24 00:00:00', '2021-04-24 03:23:29', '2021-04-24 03:23:29'),
(23, 76, 0, 1, '2021-04-24 00:00:00', '2021-04-24 03:28:36', '2021-04-24 03:28:36'),
(24, 1, 9, 1, '2021-04-24 00:00:00', '2021-04-24 04:39:43', '2021-04-24 04:39:43'),
(25, 1, 11, 1, '2021-04-24 00:00:00', '2021-04-24 04:47:50', '2021-04-24 04:47:50'),
(26, 1, 12, 1, '2021-04-24 00:00:00', '2021-04-24 04:57:50', '2021-04-24 04:57:50'),
(27, 76, 13, 1, '2021-04-24 00:00:00', '2021-04-24 05:16:17', '2021-04-24 05:16:17'),
(28, 1, 10, 0, NULL, '2021-04-24 05:38:36', '2021-04-24 05:38:36'),
(29, 76, 14, 1, '2021-04-24 00:00:00', '2021-04-24 05:39:50', '2021-04-24 05:39:50'),
(30, 76, 15, 0, NULL, '2021-04-24 05:42:24', '2021-04-24 05:42:24'),
(31, 76, 16, 0, NULL, '2021-04-24 05:55:16', '2021-04-24 05:55:16'),
(32, 75, 17, 0, NULL, '2021-04-24 05:55:39', '2021-04-24 05:55:39'),
(33, 75, 18, 0, NULL, '2021-04-24 06:01:49', '2021-04-24 06:01:49'),
(34, 75, 19, 0, NULL, '2021-04-24 06:07:24', '2021-04-24 06:07:24'),
(35, 75, 20, 0, NULL, '2021-04-24 06:08:27', '2021-04-24 06:08:27'),
(36, 75, 21, 0, NULL, '2021-04-24 06:14:21', '2021-04-24 06:14:21'),
(37, 75, 22, 0, NULL, '2021-04-24 06:14:52', '2021-04-24 06:14:52'),
(38, 75, 23, 0, NULL, '2021-04-24 06:23:38', '2021-04-24 06:23:38'),
(39, 75, 24, 0, NULL, '2021-04-24 06:23:50', '2021-04-24 06:23:50'),
(40, 75, 25, 0, NULL, '2021-04-24 06:27:35', '2021-04-24 06:27:35'),
(41, 75, 27, 0, NULL, '2021-04-24 07:38:47', '2021-04-24 07:38:47');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
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
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `client_id`, `invoice_id`, `delivery_date`, `store_id`, `product_id`, `product_stock_id`, `size`, `flavor`, `quantity_ordered`, `ordered_total_price`, `item_price`, `quantity_received`, `received_total_price`, `is_replacement`, `is_approved`, `is_cancelled`, `is_rescheduled`, `is_completed`, `is_damages`, `is_replacement_reference`, `order_cancel`, `cancelled_by`, `attempt`, `reason`, `created_at`, `updated_at`) VALUES
(1, 75, 1, '2021-04-30', 1, 1, 3, '1 L', NULL, 2, 180.00, 90.00, 0, 0.00, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, '', '2021-04-23 06:37:21', '2021-04-23 21:16:17'),
(2, 75, 1, '2021-04-30', 1, 11, 41, '750 ML', NULL, 1, 300.00, 300.00, 0, 0.00, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, '', '2021-04-23 06:37:21', '2021-04-23 21:16:17'),
(3, 75, 2, '2021-04-30', 1, 1, 4, '1.5 L', '', 2, 300.00, 0.00, 0, 0.00, 1, 1, 0, 0, 0, 0, 1, 0, 0, 0, '', '2021-04-23 19:18:00', '2021-04-23 19:18:00'),
(4, 75, 2, '2021-04-30', 1, 5, 8, '350 ML', '', 5, 750.00, 0.00, 0, 0.00, 1, 1, 0, 0, 0, 0, 1, 0, 0, 0, '', '2021-04-23 19:18:00', '2021-04-23 19:18:00'),
(5, 75, 3, '2021-05-01', 1, 2, 5, '750 ML', '', 5, 125.00, 0.00, 0, 0.00, 1, 1, 0, 0, 0, 0, 2, 0, 2, 1, 'testttt', '2021-04-23 19:46:02', '2021-04-23 22:27:34'),
(6, 75, 3, '2021-05-01', 1, 3, 2, '50ml', '', 3, 15.00, 0.00, 0, 0.00, 1, 1, 0, 0, 0, 0, 2, 0, 2, 1, 'testttt', '2021-04-23 19:46:02', '2021-04-23 22:27:34'),
(7, 75, 4, '2021-04-24', 1, 26, 24, '750 ML', NULL, 2, 200.00, 100.00, 0, 0.00, 0, 1, 1, 0, 0, 0, 0, 1, 1, 1, 'test cancel', '2021-04-23 20:23:10', '2021-04-23 20:23:50'),
(8, 75, 5, '2021-04-22', 1, 26, 24, '750 ML', NULL, 1, 100.00, 100.00, 0, 0.00, 0, 1, 1, 0, 0, 0, 0, 1, 0, 0, '', '2021-04-23 20:47:17', '2021-04-23 20:47:49'),
(10, 75, 7, '2021-04-24', 1, 10, 15, '750 ML', NULL, 2, 1000.00, 500.00, 0, 0.00, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, '', '2021-04-23 22:01:27', '2021-04-23 22:01:49'),
(11, 75, 8, '2021-04-24', 1, 1, 3, '1 L', '', 3, 270.00, 0.00, 0, 0.00, 1, 1, 0, 0, 0, 0, 7, 0, 0, 0, '', '2021-04-23 22:21:07', '2021-04-23 22:21:07'),
(12, 75, 9, '2021-04-23', 1, 29, 50, '2 ML', NULL, 2, 22.00, 11.00, 0, 0.00, 0, 1, 1, 0, 0, 0, 0, 0, 0, 0, '', '2021-04-23 22:21:09', '2021-04-23 23:38:46'),
(13, 75, 10, NULL, 1, 25, 34, '750 ML', NULL, 2, 100.00, 50.00, 0, 0.00, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '2021-04-23 23:38:16', '2021-04-23 23:38:16');

-- --------------------------------------------------------

--
-- Table structure for table `order_invoice`
--

CREATE TABLE `order_invoice` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `invoice_no` varchar(25) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_invoice`
--

INSERT INTO `order_invoice` (`id`, `user_id`, `invoice_no`, `created_at`, `updated_at`) VALUES
(1, 75, '2104230001', '2021-04-23 06:37:21', NULL),
(2, 75, '2104240001', '2021-04-23 19:00:17', NULL),
(3, 75, '2104240002', '2021-04-23 19:02:46', NULL),
(4, 75, '2104240003', '2021-04-23 20:23:10', NULL),
(5, 75, '2104240004', '2021-04-23 20:47:16', NULL),
(7, 75, '2104240006', '2021-04-23 22:01:27', NULL),
(8, 75, '2104240007', '2021-04-23 22:07:21', NULL),
(9, 75, '2104240008', '2021-04-23 22:21:09', NULL),
(10, 75, '2104240009', '2021-04-23 23:38:16', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('ishizukaarvi@gmail.com', '$2y$10$xE7INoZo7CmztvY.6t4fZOAL.9v3740FpjziPZX4U/1WwMjnJbWlO', '2021-04-16 08:39:50');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `product_image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `product_image`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 'Ube Pandan', 'Ube Pandan Description', '1358607368.jpg', 0, '2020-10-21 05:38:40', '2021-04-13 05:05:17'),
(2, 'Chocolate Ice Cream', 'Chocolate Ice Cream Description', '1225969935.jpg', 0, '2020-10-21 05:40:22', '2021-04-13 05:05:43'),
(3, 'Mocha Ice Cream', 'Mocha Ice Cream Description', 'lV1vJdjJnByrr2Da4bo0TSNvF8MQB9Xjt4Dnj9zo.jpg', 0, '2020-10-21 05:40:42', '2021-04-14 12:24:55'),
(5, 'Buko Salad', 'Test Description', 'cC8cvJmErL0bfqkzsUU432GAlkCm1fTUUUThw2Ve.png', 0, '2021-04-15 07:53:10', '2021-04-15 07:53:10'),
(6, 'Cookies and Cream', 'Test Description', 'QZ5jJbVUuj6boJxSusQbUhlg4bF9k2PcGmjmPgAb.png', 0, '2021-04-15 08:03:18', '2021-04-15 08:03:18'),
(7, 'Double Delight', 'Test Description', 'wMnl73VPPfAdP1KxZmA33tlkfCpgB1Uxk6EyXqPi.png', 0, '2021-04-15 08:04:29', '2021-04-15 08:04:29'),
(8, 'Choco', 'Test Description', 'D6VCKdA7KEDGoK93yQBpVFI12nKcxMWWYvGMiO0Z.png', 0, '2021-04-15 08:06:33', '2021-04-15 08:06:33'),
(9, 'Peach', 'Test Description', '7qyxGOzoGWpD6iAMgAMiMYVbXdMdipNrjVZdJNPh.jpg', 0, '2021-04-15 08:09:01', '2021-04-15 08:10:05'),
(10, 'Double Dutch', 'Test Description', 'S8ireyFMB8latvxE2b7jNhu628r7ZaZzuBtG8pTv.png', 0, '2021-04-15 08:11:50', '2021-04-15 08:11:50'),
(11, 'Pineapple', 'Test Description', 'IAXmGlggikxlRGaUDL0SMjE44uN5SToHaT1MVbk0.jpg', 0, '2021-04-15 08:12:57', '2021-04-15 08:12:57'),
(12, 'Almond', 'Test Description', '0GL2bsBHtmFL2WvYEyTZJdTy7u7PWNUaaWrYjMWD.jpg', 0, '2021-04-15 08:17:42', '2021-04-15 08:17:42'),
(13, 'Sakura', 'Test Description', '4l1U9v1zAtOHzTOWLqVuDdBYCfi8mqHMzagzB76u.jpg', 0, '2021-04-15 08:20:00', '2021-04-15 08:20:00'),
(14, 'Soy', 'Test Description', 'PezPOtAf3CESAM6eg2BDoYReLYJFZfQVZhrivdNo.jpg', 0, '2021-04-15 08:20:19', '2021-04-15 08:20:19'),
(15, 'Strawberry', 'Test Description', '0KN9ie6G0HS1ghBZiKWarMjiFx5LJzfKXiqMfilO.jpg', 0, '2021-04-15 08:20:49', '2021-04-15 08:20:49'),
(16, 'Blue Berry Sandwich', 'Test Description', '9vt36X00BtyFgeFFcFEAGy86TxoB0OeoUBqTIAtp.jpg', 0, '2021-04-16 06:07:41', '2021-04-16 06:07:41'),
(17, 'Dark Chocolate', 'Test Description', 's4yto7cBmwyxAZbfHDpoleHdoSh9Rp90qF5aUKRn.jpg', 0, '2021-04-16 06:10:55', '2021-04-16 06:10:55'),
(18, 'Vanilla Caramel', 'Test Description', '1dDQLhf5eebi6fUxRIDXELwwdrd8nckhb6OoyrSn.jpg', 0, '2021-04-16 06:21:43', '2021-04-16 06:21:43'),
(19, 'Mars Chololate', 'Test Description', 'l3bLlde4gUAFDfysHiKUZyg9dFFtbVAQOx8HCROl.jpg', 0, '2021-04-16 06:22:15', '2021-04-16 06:22:15'),
(20, 'Salted Caramel', 'Test Description', 'x8VfsS0lTS9ZMw2DHxFPUZiI9FW2JvWrHtVEoPfB.jpg', 0, '2021-04-16 06:22:35', '2021-04-16 06:22:35'),
(21, 'Snickers Chocolate', 'Test Description', 'M65f66wV0LdCgrAkPbvCXVQwa8pSdtFiTLemMgSK.jpg', 0, '2021-04-16 06:29:01', '2021-04-16 06:29:01'),
(22, 'Peanut Butter Icecream', 'Test Description', '08ULbY6v0Qa4vLwZq5uu0vK9Lr7bKCcghm2jbHgr.jpg', 0, '2021-04-16 07:00:38', '2021-04-16 07:00:38'),
(23, 'Vanilla Bean Icecream', 'Test Description', 'OBnC4sPVMxtU2wjEWfFZEgwNnPg1gF5cEMAmirDG.jpg', 0, '2021-04-16 07:11:19', '2021-04-16 07:11:19'),
(24, 'Oreo Overload', 'Test Description', 'Fsa8y7sGvhdKOIEw1Dcoq1fJKczHJNomKOaANlud.jpg', 0, '2021-04-16 07:12:31', '2021-04-16 07:12:31'),
(25, 'Pestacio', 'Test Description', 'CxS8lVhlFRaT798byIp3LsRQiBTBwqPw23wqUfRR.jpg', 0, '2021-04-16 07:13:15', '2021-04-16 07:13:15'),
(26, 'Raspberry', 'Test Description', 'X3o3g5Gjk41SKTAsjRpaPmDv37PXOipSnqxz5cAL.jpg', 0, '2021-04-16 07:13:51', '2021-04-16 07:13:51'),
(27, 'Ube Pandanrr', 'sdsd', 'nPMHweNABfUBSddmqHllrFGUKU68NRUbcf2J3aG6.jpg', 0, '2021-04-20 04:21:00', '2021-04-20 04:21:24'),
(28, 'wwew', 'dwdwd', 'dfzp6Tq5DFxCk4nowZpYBZ3DOlhISYxk2oHBtFe2.jpg', 0, '2021-04-23 20:50:55', '2021-04-23 20:50:55'),
(29, 'testsssssssssssssssssssssssss', 'ddssds', 'qwlx3RAdvHVzkjUo53HrCHXfWkcX01Kalggq31nY.jpg', 0, '2021-04-23 20:52:21', '2021-04-23 20:52:21');

-- --------------------------------------------------------

--
-- Table structure for table `product_damages`
--

CREATE TABLE `product_damages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `size` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `flavor` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `client_id` int(11) NOT NULL,
  `is_replaced` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_file_damages`
--

CREATE TABLE `product_file_damages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_damage_id` int(11) NOT NULL,
  `file_damage_image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_file_reports`
--

CREATE TABLE `product_file_reports` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_report_id` int(11) NOT NULL,
  `file_report_image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `product_file_reports`
--

INSERT INTO `product_file_reports` (`id`, `product_report_id`, `file_report_image`, `created_at`, `updated_at`) VALUES
(1, 1, 'Mi9fbtmKFrziCny165zScy5rHSQD0cXAENk4wkci.jpg', '2021-04-23 18:52:53', '2021-04-23 18:52:53'),
(2, 2, 'kpnER3Ip2IzsdwZbMIP2k1sM4ZOWN5H1v93BpAoR.jpg', '2021-04-23 19:01:34', '2021-04-23 19:01:34'),
(3, 3, 'UrFyo3uipyhr6PjxIG7JVVTbVyxfCoIuXgoYcbjB.jpg', '2021-04-23 19:04:09', '2021-04-23 19:04:09'),
(4, 4, '5lkHdcvi1hvJpOtqYBVgJFoMgHYPazhzVa4ktjYn.jpg', '2021-04-23 19:13:13', '2021-04-23 19:13:13'),
(5, 5, 'd0kWvXHKFX7BUTa4qUJ8qc0gq9eyIlhOxIHZ8j6g.jpg', '2021-04-23 19:19:04', '2021-04-23 19:19:04'),
(6, 6, 'AZ0zNgfghIYZbZaPxXwXsBQHSNqOm6SfyipVuJw3.jpg', '2021-04-23 19:20:34', '2021-04-23 19:20:34'),
(7, 7, 'UX0DuzZ2xqumGt9xQtAvNSxuwn1BIA8TWocHWEsF.jpg', '2021-04-23 22:02:40', '2021-04-23 22:02:40'),
(8, 8, 'xNf9QB0iN2ogGm6YbdnafKBNnM2Fay6jtk0d93pD.jpg', '2021-04-23 22:08:12', '2021-04-23 22:08:12');

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `file` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `product_reports`
--

CREATE TABLE `product_reports` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `report_no` varchar(55) COLLATE utf8_unicode_ci DEFAULT NULL,
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
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `product_reports`
--

INSERT INTO `product_reports` (`id`, `report_no`, `product_id`, `report_type`, `size`, `flavor`, `store_id`, `client_id`, `issued_by`, `is_replaced`, `delivery_date`, `reason`, `created_at`, `updated_at`) VALUES
(1, '012104240001', NULL, 'Replacement', NULL, NULL, 1, 75, NULL, 1, NULL, 'test', '2021-04-23 18:52:48', '2021-04-23 19:00:18'),
(2, '012104240002', NULL, 'Replacement', NULL, NULL, 1, 75, NULL, 1, NULL, 'test', '2021-04-23 19:01:32', '2021-04-23 19:02:46'),
(3, '012104240003', NULL, 'Replacement', NULL, NULL, 1, 75, NULL, 2, NULL, 'test', '2021-04-23 19:04:08', '2021-04-23 19:08:11'),
(4, '012104240004', NULL, 'Replacement', NULL, NULL, 1, 75, NULL, 2, NULL, 'test', '2021-04-23 19:13:12', '2021-04-23 19:18:34'),
(5, '012104240005', NULL, 'Replacement', NULL, NULL, 1, 75, NULL, 2, NULL, 'ddd', '2021-04-23 19:19:03', '2021-04-23 19:19:46'),
(6, '012104240006', NULL, 'Replacement', NULL, NULL, 1, 75, NULL, 2, NULL, 'sdsdsd', '2021-04-23 19:20:33', '2021-04-23 19:22:03'),
(7, '012104240007', NULL, 'Replacement', NULL, NULL, 1, 75, NULL, 1, NULL, 'test', '2021-04-23 22:02:36', '2021-04-23 22:07:23'),
(8, '012104240008', NULL, 'Replacement', NULL, NULL, 1, 75, NULL, 2, NULL, 'ytttt', '2021-04-23 22:08:10', '2021-04-23 22:08:23');

-- --------------------------------------------------------

--
-- Table structure for table `product_stocks`
--

CREATE TABLE `product_stocks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` int(11) NOT NULL,
  `size` varchar(100) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `price` double NOT NULL,
  `threshold` int(11) NOT NULL,
  `promo` double NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_stocks`
--

INSERT INTO `product_stocks` (`id`, `product_id`, `size`, `quantity`, `price`, `threshold`, `promo`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, '500 ML', 95, 15, 50, 0, 0, '2021-03-16 04:14:58', '2021-04-17 04:03:22'),
(2, 3, '50ml', 298, 5, 100, 2, 0, '2021-03-16 04:31:44', '2021-03-17 06:22:24'),
(3, 1, '1 L', 870, 90, 100, 0, 0, '2021-03-17 04:04:28', '2021-04-17 06:06:29'),
(4, 1, '1.5 L', 1000, 150, 10, 10, 0, '2021-03-17 04:05:21', '2021-04-17 04:56:40'),
(5, 2, '750 ML', 1000, 25, 100, 10, 0, '2021-03-17 04:23:13', '2021-04-17 04:03:04'),
(6, 3, '60ml', 350, 10, 100, 0, 0, '2021-03-17 04:33:54', '2021-03-17 04:33:54'),
(7, 1, '500 L', 200, 100, 180, 0, 0, '2021-04-15 02:47:49', '2021-04-18 00:54:40'),
(8, 5, '350 ML', 1000, 150, 50, 0, 0, '2021-04-15 07:56:01', '2021-04-17 05:28:55'),
(9, 5, '500 ML', 1000, 200, 30, 0, 0, '2021-04-15 07:56:43', '2021-04-17 05:28:17'),
(10, 5, '750 ML', 1000, 70, 100, 0, 0, '2021-04-15 07:57:24', '2021-04-17 05:27:31'),
(11, 6, '750 ML', 1000, 150, 30, 0, 0, '2021-04-15 08:05:24', '2021-04-17 05:29:20'),
(12, 7, '500 ML', 1000, 200, 50, 0, 0, '2021-04-15 08:05:59', '2021-04-17 05:24:33'),
(13, 8, '750 ML', 1000, 350, 60, 0, 0, '2021-04-15 08:06:58', '2021-04-17 05:25:21'),
(14, 9, '750 ML', 1000, 300, 50, 0, 0, '2021-04-15 08:10:41', '2021-04-17 05:32:08'),
(15, 10, '750 ML', 1000, 500, 30, 0, 0, '2021-04-15 08:12:23', '2021-04-17 05:40:00'),
(16, 12, '750 ML', 1000, 500, 30, 0, 0, '2021-04-15 08:21:42', '2021-04-17 05:30:21'),
(17, 13, '1.5 L', 1000, 700, 50, 0, 0, '2021-04-15 08:22:11', '2021-04-17 05:47:10'),
(18, 14, '750 ML', 1000, 450, 50, 0, 0, '2021-04-15 08:22:47', '2021-04-17 05:47:52'),
(19, 15, '750 ML', 1000, 200, 50, 0, 0, '2021-04-15 08:23:25', '2021-04-17 05:49:21'),
(20, 21, '750 ML', 2500, 250, 500, 0, 0, '2021-04-16 09:40:16', '2021-04-17 05:52:31'),
(21, 17, '1 L', 1500, 300, 300, 0, 0, '2021-04-16 09:42:22', '2021-04-17 05:50:58'),
(22, 2, '1 L', 50000, 50, 100, 20, 0, '2021-04-17 03:16:34', '2021-04-17 03:16:34'),
(23, 7, '100 ML', 1000, 200, 50, 0, 0, '2021-04-17 05:23:43', '2021-04-17 05:23:43'),
(24, 26, '750 ML', 1000, 100, 500, 0, 0, '2021-04-17 05:29:45', '2021-04-17 05:29:45'),
(25, 6, '1 L', 1000, 200, 30, 0, 0, '2021-04-17 05:30:16', '2021-04-17 05:30:16'),
(26, 26, '1 L', 2000, 100, 55, 0, 0, '2021-04-17 05:30:24', '2021-04-17 05:30:24'),
(27, 6, '1.5 L', 1000, 250, 30, 0, 0, '2021-04-17 05:30:45', '2021-04-17 05:30:45'),
(28, 8, '1 L', 1000, 400, 60, 0, 0, '2021-04-17 05:31:16', '2021-04-17 05:31:16'),
(29, 12, '1 L', 1000, 700, 30, 0, 0, '2021-04-17 05:31:37', '2021-04-17 05:31:37'),
(30, 12, '1.5 L', 1000, 800, 30, 0, 0, '2021-04-17 05:32:09', '2021-04-17 05:32:09'),
(31, 26, '1.5 L', 5000, 250, 100, 0, 0, '2021-04-17 05:32:14', '2021-04-17 05:32:14'),
(32, 9, '1 L', 1000, 350, 50, 0, 0, '2021-04-17 05:33:43', '2021-04-17 05:33:43'),
(33, 9, '1.5 L', 1000, 200, 10, 0, 0, '2021-04-17 05:34:20', '2021-04-17 05:38:32'),
(34, 25, '750 ML', 2000, 50, 200, 0, 0, '2021-04-17 05:34:23', '2021-04-17 05:34:23'),
(35, 25, '1 L', 3000, 50, 22, 0, 0, '2021-04-17 05:35:12', '2021-04-17 05:35:12'),
(36, 25, '1.5 L', 3500, 80, 500, 0, 0, '2021-04-17 05:36:13', '2021-04-17 05:36:13'),
(37, 13, '1 L', 1000, 600, 50, 0, 0, '2021-04-17 05:36:43', '2021-04-17 05:36:43'),
(38, 13, '750 ML', 1000, 500, 50, 0, 0, '2021-04-17 05:37:16', '2021-04-17 05:37:16'),
(39, 10, '1 L', 1000, 600, 30, 0, 0, '2021-04-17 05:41:17', '2021-04-17 05:41:17'),
(40, 10, '1.5 L', 1000, 700, 60, 0, 0, '2021-04-17 05:41:55', '2021-04-17 05:41:55'),
(41, 11, '750 ML', 500, 300, 20, 0, 0, '2021-04-17 05:43:21', '2021-04-17 05:43:21'),
(42, 11, '1 L', 1000, 400, 30, 0, 0, '2021-04-17 05:43:43', '2021-04-17 05:43:43'),
(43, 14, '1 L', 1000, 500, 50, 0, 0, '2021-04-17 05:43:58', '2021-04-17 05:43:58'),
(44, 11, '1.5 L', 1000, 500, 30, 0, 0, '2021-04-17 05:44:10', '2021-04-17 05:44:10'),
(45, 14, '1.5 L', 1000, 600, 50, 0, 0, '2021-04-17 05:44:31', '2021-04-17 05:44:31'),
(46, 15, '1 L', 1000, 300, 50, 0, 0, '2021-04-17 05:46:22', '2021-04-17 05:46:22'),
(47, 15, '1.5 L', 1000, 400, 100, 0, 0, '2021-04-17 05:48:29', '2021-04-17 05:50:04'),
(48, 1, '750 ML', 0, 100, 100, 2, 0, '2021-04-18 00:41:10', '2021-04-23 23:24:27'),
(49, 1, '750 L', 100, 12, 12, 12, 1, '2021-04-18 00:54:29', '2021-04-20 04:54:32'),
(50, 29, '2 ML', 1211, 11, 1, 0, 0, '2021-04-23 20:52:52', '2021-04-23 20:52:52'),
(51, 1, '1 ML', 2, 2, 2, 0, 1, '2021-04-23 23:19:48', '2021-04-23 23:19:48');

-- --------------------------------------------------------

--
-- Table structure for table `promos`
--

CREATE TABLE `promos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `promo_start_date` date NOT NULL,
  `promo_end_date` date NOT NULL,
  `promo_image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `discount` double(8,2) NOT NULL,
  `product_id` int(11) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `quotas`
--

CREATE TABLE `quotas` (
  `id` bigint(20) UNSIGNED NOT NULL,
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
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `quotas`
--

INSERT INTO `quotas` (`id`, `year`, `jan`, `feb`, `mar`, `apr`, `may`, `jun`, `jul`, `aug`, `sep`, `oct`, `nov`, `dev`, `is_deleted`, `created_at`, `updated_at`) VALUES
(3, 2020, 1, 1, 1, 1, 11, 1, 1, 1, 1, 1, 1, 1, 0, '2021-04-20 03:45:10', '2021-04-20 03:45:10');

-- --------------------------------------------------------

--
-- Table structure for table `replacement_products`
--

CREATE TABLE `replacement_products` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_report_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `product_stock_id` int(11) DEFAULT NULL,
  `size` varchar(255) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `replacement_products`
--

INSERT INTO `replacement_products` (`id`, `product_report_id`, `product_id`, `product_stock_id`, `size`, `price`, `quantity`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 4, '1.5 L', 150, 2, '2021-04-23 18:52:48', '2021-04-23 18:52:48'),
(2, 1, 5, 8, '350 ML', 150, 5, '2021-04-23 18:52:48', '2021-04-23 18:52:48'),
(3, 2, 2, 5, '750 ML', 25, 5, '2021-04-23 19:01:32', '2021-04-23 19:01:32'),
(4, 2, 3, 2, '50ml', 5, 3, '2021-04-23 19:01:32', '2021-04-23 19:01:32'),
(5, 3, 2, 1, '500 ML', 15, 2, '2021-04-23 19:04:08', '2021-04-23 19:04:08'),
(6, 4, 6, 25, '1 L', 200, 4, '2021-04-23 19:13:12', '2021-04-23 19:13:12'),
(7, 5, 2, 1, '500 ML', 15, 2, '2021-04-23 19:19:03', '2021-04-23 19:19:03'),
(8, 6, 2, 1, '500 ML', 15, 3, '2021-04-23 19:20:33', '2021-04-23 19:20:33'),
(9, 7, 1, 3, '1 L', 90, 3, '2021-04-23 22:02:36', '2021-04-23 22:02:36'),
(10, 8, 1, 3, '1 L', 90, 9, '2021-04-23 22:08:11', '2021-04-23 22:08:11');

-- --------------------------------------------------------

--
-- Table structure for table `sales_report`
--

CREATE TABLE `sales_report` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8_unicode_ci,
  `payload` text COLLATE utf8_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('9kjjtaOALeGukPn2aSHlMP25WK7s8CinRtg6uXzj', 75, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.128 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiYVRKTWt1ampjVlFLdlhMNnhvbno3ZWVMRVUwSkVDN09zcUNUcWVwUCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9vcmRlci1zdWNjZXNzIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6NzU7fQ==', 1619249951),
('JjfX5UA4ja0qXiKfkZvsKGtaHXZwGqgMrbtFLXw4', 76, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:88.0) Gecko/20100101 Firefox/88.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoickJkMmZsQ3I1YW5yanc5dVBTYUxpeXhCeHpsUVg5NlBBbmZSMnBEYyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjY6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9tYWluIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6NzY7fQ==', 1619249951),
('mpGQnn9hcnsWRc4HKGzjm8k0vhlH1qQy30oLdQtI', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.128 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoid0lJd2NuTlBZZmJDZTJOVjVPMjV5V3NTNjZ0YTlJd3RqTnNRQnB0dCI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czoyNzoiaHR0cDovL2xvY2FsaG9zdDo4MDAwL29yZGVyIjt9czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9vcmRlciI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7czo5OiJjYXJ0X2RhdGEiO2E6MTp7aTowO2k6MTQ7fX0=', 1619249953);

-- --------------------------------------------------------

--
-- Table structure for table `stocks`
--

CREATE TABLE `stocks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `threshold` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stores`
--

CREATE TABLE `stores` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `store_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `store_address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `area_id` int(11) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `stores`
--

INSERT INTO `stores` (`id`, `store_name`, `store_address`, `user_id`, `area_id`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 'Zhavia Store', 'Consolacion Area', 75, 1, 1, '2021-04-23 04:34:01', '2021-04-23 20:32:16'),
(2, 'tst', 'test', 77, 1, 0, '2021-04-23 21:47:12', '2021-04-23 21:47:12');

-- --------------------------------------------------------

--
-- Table structure for table `system_notifications`
--

CREATE TABLE `system_notifications` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `type` varchar(100) DEFAULT NULL,
  `area_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_stock_id` int(11) NOT NULL,
  `message` text,
  `email_to` enum('admin','staff','client') DEFAULT NULL,
  `status` enum('unread','read') NOT NULL DEFAULT 'unread',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `system_notifications`
--

INSERT INTO `system_notifications` (`id`, `user_id`, `type`, `area_id`, `product_id`, `product_stock_id`, `message`, `email_to`, `status`, `created_at`, `updated_at`) VALUES
(1, 0, 'out_of_stock', 0, 1, 48, 'Ube Pandan 750 ML is out of stock. Please re-stock as soon as possible.', 'admin', 'unread', '2021-04-23 04:31:14', '2021-04-23 23:24:29'),
(2, 75, 'client_deactivation', 1, 0, 0, '(75) Ping Remedio  is deactivated from the client’s list. ', 'staff', 'unread', '2021-04-23 05:07:53', '2021-04-23 05:07:53'),
(3, 75, 'reminder_admin_client_deactivate', 1, 0, 0, '(75) Ping Remedio  did not order within the 7-day allowance. He is now added to inactive list.                ', 'admin', 'unread', '2021-04-23 05:07:53', '2021-04-23 05:07:53'),
(4, 75, 'client_deactivation', 1, 0, 0, '(75) Ping Remedio  is deactivated from the client’s list. ', 'staff', 'unread', '2021-04-23 05:10:52', '2021-04-23 05:10:52'),
(5, 75, 'reminder_admin_client_deactivate', 1, 0, 0, '(75) Ping Remedio  did not order within the 7-day allowance. He is now added to inactive list.                ', 'admin', 'unread', '2021-04-23 05:10:52', '2021-04-23 05:10:52'),
(6, 75, 'client_deactivation', 1, 0, 0, '(75) Ping Remedio  is now added to the deactivated list. He is removed as one of your clients. ', 'staff', 'unread', '2021-04-23 05:15:34', '2021-04-23 05:15:34'),
(7, 75, 'reminder_admin_client_deactivate', 1, 0, 0, '(75) Ping Remedio  did not order within the 7-day allowance. He is now added to inactive list.                ', 'admin', 'unread', '2021-04-23 05:15:34', '2021-04-23 05:15:34'),
(8, 75, 'client_activation', 1, 0, 0, '(75) Ping Remedio  is now activated as one of your clients. ', 'staff', 'unread', '2021-04-23 05:15:48', '2021-04-23 05:15:48'),
(9, 75, 'client_deactivation', 1, 0, 0, '(75) Ping Remedio  is now added to the deactivated list. He is removed as one of your clients. ', 'staff', 'unread', '2021-04-23 05:27:34', '2021-04-23 05:27:34'),
(10, 75, 'reminder_admin_client_deactivate', 1, 0, 0, '(75) Ping Remedio  did not order within the 7-day allowance. He is now added to inactive list.                ', 'admin', 'unread', '2021-04-23 05:27:34', '2021-04-23 05:27:34'),
(11, 75, 'client_activation', 1, 0, 0, '(75) Ping Remedio  is now activated as one of your clients. ', 'staff', 'unread', '2021-04-23 05:29:04', '2021-04-23 05:29:04'),
(12, 75, 'client_activation', 1, 0, 0, 'Welcome to Creamline Ping Remedio! Your client ID is 75. You can now start ordering.', 'client', 'unread', '2021-04-23 05:29:05', '2021-04-23 05:29:05'),
(13, 75, 'order_approval', 1, 0, 0, 'Your order 2104230001 was approved. Delivery is scheduled on April 23 2021.', 'client', 'unread', '2021-04-23 06:40:10', '2021-04-23 06:40:10'),
(14, 75, 'order_approval', 1, 0, 0, 'Your order 2104230002 was declined. Please contact the staff assigned in your store area.', 'client', 'unread', '2021-04-23 06:57:39', '2021-04-23 06:57:39'),
(15, 75, 'order_auto_cancel', 1, 0, 0, 'There are 2 orders that were automatically cancelled and added to the undelivered list. It has\r\n                    passed the delivery date and no actions were done. Please contact your administration for\r\n                    clarification.', 'staff', 'unread', '2021-04-23 18:49:54', '2021-04-23 18:49:54'),
(16, 75, 'order_auto_cancel', 1, 0, 0, 'There are 2 orders that were automatically cancelled and added to the undelivered list. It has\r\n                    passed the delivery date and no actions were done. Please contact your administration for\r\n                    clarification.', 'staff', 'unread', '2021-04-23 18:49:54', '2021-04-23 18:49:54'),
(18, 75, 'file_replacement_approved', 1, 0, 0, 'Your replacement 2104240002 was approved. Delivery is scheduled on Apr 24, 2021.', 'client', 'unread', '2021-04-23 19:02:46', '2021-04-23 19:02:46'),
(19, 75, 'file_replacement_disapproved', 1, 0, 0, 'Your replacement  was declined. Please contact the staff assigned in your store area.', 'client', 'unread', '2021-04-23 19:18:34', '2021-04-23 19:18:34'),
(20, 75, 'file_replacement_disapproved', 1, 0, 0, 'Your replacement undefined was declined. Please contact the staff assigned in your store area.', 'client', 'unread', '2021-04-23 19:19:46', '2021-04-23 19:19:46'),
(21, 75, 'file_replacement_disapproved', 1, 0, 0, 'Your replacement 012104240006 was declined. Please contact the staff assigned in your store area.', 'client', 'unread', '2021-04-23 19:22:03', '2021-04-23 19:22:03'),
(22, 75, 'order_approval', 1, 0, 0, 'Your order 2104240003 was approved. Delivery is scheduled on April 24 2021.', 'client', 'unread', '2021-04-23 20:23:44', '2021-04-23 20:23:44'),
(23, 76, 'staff_cancel_order', 1, 0, 0, 'Staff Name Last cancelled order 2104240003 of Ping Remedio due to Client Cancel (test cancel).', 'admin', 'unread', '2021-04-23 20:38:01', '2021-04-23 20:38:01'),
(24, 75, 'staff_cancel_order', 1, 0, 0, 'Your order 2104240003 was cancelled by staff Staff Name Last. Please contact the staff\r\n                assigned in your store area.', 'client', 'unread', '2021-04-23 20:38:01', '2021-04-23 20:38:01'),
(25, 75, 'order_approval', 1, 0, 0, 'Your order 2104240004 was approved. Delivery is scheduled on April 22 2021.', 'client', 'unread', '2021-04-23 20:47:45', '2021-04-23 20:47:45'),
(26, 75, 'order_auto_cancel', 1, 0, 0, 'There are 1 orders that were automatically cancelled and added to the undelivered list. It has\r\n                    passed the delivery date and no actions were done. Please contact your administration for\r\n                    clarification.', 'staff', 'unread', '2021-04-23 20:47:49', '2021-04-23 20:47:49'),
(27, 75, 'order_auto_cancel', 1, 0, 0, 'Your order 2104240004 is added to the undelivered list. It has passed the delivery date.\r\n                    Please contact the staff assigned in your store area', 'client', 'unread', '2021-04-23 20:47:49', '2021-04-23 20:47:49'),
(28, 75, 'admin_cancel_order', 1, 0, 0, 'Your order 2104230001 was cancelled by the admin in the undelivered list. Please contact\r\n                    the staff assigned in your store area.', 'client', 'unread', '2021-04-23 20:57:46', '2021-04-23 20:57:46'),
(29, 75, 'order_approval', 1, 0, 0, 'Your order 2104230001 was rescheduled. The new delivery date is on April 30 2021.', 'client', 'unread', '2021-04-23 21:16:11', '2021-04-23 21:16:11'),
(30, 75, 'client_deactivation', 1, 0, 0, '(75) Ping Remedio  is now added to the deactivated list. He is removed as one of your clients. ', 'staff', 'unread', '2021-04-23 21:38:26', '2021-04-23 21:38:26'),
(31, 75, 'reminder_admin_client_deactivate', 1, 0, 0, '(75) Ping Remedio  did not order within the 7-day allowance. He is now added to inactive list.                ', 'admin', 'unread', '2021-04-23 21:38:26', '2021-04-23 21:38:26'),
(32, 75, 'client_activation', 1, 0, 0, '(75) Ping Remedio  is now activated as one of your clients. ', 'staff', 'unread', '2021-04-23 21:38:58', '2021-04-23 21:38:58'),
(33, 75, 'client_activation', 1, 0, 0, 'Welcome to Creamline Ping Remedio! Your client ID is 75. You can now start ordering.', 'client', 'unread', '2021-04-23 21:38:58', '2021-04-23 21:38:58'),
(34, 75, 'client_deactivation', 1, 0, 0, '(75) Ping Remedio  is now added to the deactivated list. He is removed as one of your clients. ', 'staff', 'unread', '2021-04-23 21:41:53', '2021-04-23 21:41:53'),
(35, 75, 'reminder_admin_client_deactivate', 1, 0, 0, '(75) Ping Remedio  did not order within the 7-day allowance. He is now added to inactive list.                ', 'admin', 'unread', '2021-04-23 21:41:53', '2021-04-23 21:41:53'),
(36, 75, 'client_activation', 1, 0, 0, '(75) Ping Remedio  is now activated as one of your clients. ', 'staff', 'unread', '2021-04-23 21:42:20', '2021-04-23 21:42:20'),
(37, 75, 'client_activation', 1, 0, 0, 'Welcome to Creamline Ping Remedio! Your client ID is 75. You can now start ordering.', 'client', 'unread', '2021-04-23 21:42:20', '2021-04-23 21:42:20'),
(38, 75, 'client_deactivation', 1, 0, 0, '(75) Ping Remedio  is now added to the deactivated list. He is removed as one of your clients. ', 'staff', 'unread', '2021-04-23 21:49:40', '2021-04-23 21:49:40'),
(39, 75, 'reminder_admin_client_deactivate', 1, 0, 0, '(75) Ping Remedio  did not order within the 7-day allowance. He is now added to inactive list.                ', 'admin', 'unread', '2021-04-23 21:49:40', '2021-04-23 21:49:40'),
(40, 75, 'client_activation', 1, 0, 0, '(75) Ping Remedio  is now activated as one of your clients. ', 'staff', 'unread', '2021-04-23 21:55:04', '2021-04-23 21:55:04'),
(41, 75, 'client_activation', 1, 0, 0, 'Welcome to Creamline Ping Remedio! Your client ID is 75. You can now start ordering.', 'client', 'unread', '2021-04-23 21:55:04', '2021-04-23 21:55:04'),
(42, 75, 'order_approval', 1, 0, 0, 'Your order 2104240005 was declined. Please contact the staff assigned in your store area.', 'client', 'unread', '2021-04-23 21:55:34', '2021-04-23 21:55:34'),
(43, 75, 'order_approval', 1, 0, 0, 'Your order 2104240006 was approved. Delivery is scheduled on April 24 2021.', 'client', 'unread', '2021-04-23 22:01:45', '2021-04-23 22:01:45'),
(44, 75, 'file_replacement_approved', 1, 0, 0, 'Your replacement 2104240007 was approved. Delivery is scheduled on Apr 24, 2021.', 'client', 'unread', '2021-04-23 22:07:21', '2021-04-23 22:07:21'),
(45, 75, 'file_replacement_disapproved', 1, 0, 0, 'Your replacement 012104240008 was declined. Please contact the staff assigned in your store area.', 'client', 'unread', '2021-04-23 22:08:23', '2021-04-23 22:08:23'),
(46, 76, 'staff_cancel_order', 1, 0, 0, 'Staff Name Last cancelled order 2104240002 of Ping Remedio due to Delivery Cancel (testttt).', 'admin', 'unread', '2021-04-23 22:14:15', '2021-04-23 22:14:15'),
(47, 75, 'staff_cancel_order', 1, 0, 0, 'Your order 2104240002 was cancelled by staff Staff Name Last. Please contact the staff\r\n                assigned in your store area.', 'client', 'unread', '2021-04-23 22:14:15', '2021-04-23 22:14:15'),
(48, 76, 'staff_cancel_order', 1, 0, 0, 'Staff Name Last cancelled order 2104240002 of Ping Remedio due to Delivery Cancel (testttt).', 'admin', 'unread', '2021-04-23 22:14:50', '2021-04-23 22:14:50'),
(49, 75, 'staff_cancel_order', 1, 0, 0, 'Your order 2104240002 was cancelled by staff Staff Name Last. Please contact the staff\r\n                assigned in your store area.', 'client', 'unread', '2021-04-23 22:14:50', '2021-04-23 22:14:50'),
(50, 75, 'admin_cancel_order', 1, 0, 0, 'Your order 2104230001 was cancelled by the admin in the undelivered list. Please contact\r\n                    the staff assigned in your store area.', 'client', 'unread', '2021-04-23 22:23:34', '2021-04-23 22:23:34'),
(51, 75, 'admin_cancel_order', 1, 0, 0, 'Your order 2104230001 was cancelled by the admin in the undelivered list. Please contact\r\n                    the staff assigned in your store area.', 'client', 'unread', '2021-04-23 22:23:48', '2021-04-23 22:23:48'),
(52, 75, 'order_approval', 1, 0, 0, 'Your order 2104240002 was rescheduled. The new delivery date is on May 1 2021.', 'client', 'unread', '2021-04-23 22:27:30', '2021-04-23 22:27:30'),
(53, 75, 'order_approval', 1, 0, 0, 'Your order 2104240008 was approved. Delivery is scheduled on April 23 2021.', 'client', 'unread', '2021-04-23 23:38:42', '2021-04-23 23:38:42'),
(54, 75, 'order_auto_cancel', 1, 0, 0, 'There are 1 orders that were automatically cancelled and added to the undelivered list. It has\r\n                    passed the delivery date and no actions were done. Please contact your administration for\r\n                    clarification.', 'staff', 'unread', '2021-04-23 23:38:46', '2021-04-23 23:38:46'),
(55, 75, 'order_auto_cancel', 1, 0, 0, 'Your order 2104240008 is added to the undelivered list. It has passed the delivery date.\r\n                    Please contact the staff assigned in your store area', 'client', 'unread', '2021-04-23 23:38:46', '2021-04-23 23:38:46');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
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
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fname`, `mname`, `lname`, `address`, `contact_num`, `email`, `email_verified_at`, `password`, `user_role`, `is_active`, `is_pending`, `img`, `remember_token`, `area_id`, `expiry`, `sent`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'NA', 'NA', 'Pardo Cebu', '09123456783', 'admin@creamline.com', '2020-06-07 23:57:47', '$2y$10$EN8DMgNgmRlqVPmSOAvmJO9vM/VJHWvgsXkBg9A2wgLnwidiOpWDO', 99, 1, 0, 'Upn1UTH65yw6SywgRwkDALTlrIY8H2VzmwlwvvTO.jpg', '4CMpJxKHbh35W6Ps1sdhhJf1NI605J0NGZ6PdczwAfLIXgIAJPXgeDUEl3xS', 0, NULL, 0, '2020-06-06 18:42:21', '2021-04-17 21:16:09'),
(75, 'Ping', 'Ople', 'Remedio', 'NAdd', '09157339459', 'panfilo.glophics@gmail.com', '2020-06-07 23:57:47', '$2y$10$DIZYfhBEC2T4G2JAXdr/TOb/sezev4h/Mx44jeGVTHHhigqzJ4Y8C', 2, 1, 0, 'NA', 'NA', 1, '2021-06-18 05:51:47', 0, '2021-04-17 21:51:47', '2021-04-23 23:16:56'),
(76, 'Staff Name', 'O', 'Last', 'NA', '09322090821', 'panfilo.utech@gmail.com', '2020-06-07 23:57:47', '$2y$10$DIZYfhBEC2T4G2JAXdr/TOb/sezev4h/Mx44jeGVTHHhigqzJ4Y8C', 1, 1, 0, 'NA', 'JrPB6DaRBhsRF8tQLK1nPYoxTOX9BlXsRrG0RpxhrI9wXcKnWuoXPFhM3xty', 1, NULL, 0, '2021-04-18 00:33:09', '2021-04-23 20:26:05'),
(77, 'test', 'test', 'test', 'Pilit Cabancalan Mandaue City Cebu', '09157339455', 'client@gmail.com', NULL, '$2y$10$UbNQ20lWxJHeiQbZbr7MZOzAbbaGI6XP69UeENKj7ieUjNyN9Gq0S', 2, 0, 1, '', NULL, 1, '2021-06-24 05:46:49', 0, '2021-04-23 21:46:49', '2021-04-23 21:46:49'),
(78, 'wdww', 'ewewe', 'wewew', 'NA', '09157339453', 'wewewe@yahoo.com', '2020-06-07 23:57:47', '$2y$10$ZlE2Iqxs5z.N7GxXdxGbcON6JrVBSyd948K4sVOToskzynMjD1pY2', 2, 1, 0, 'NA', 'NA', 0, NULL, 0, '2021-04-23 23:15:57', '2021-04-23 23:15:57');

-- --------------------------------------------------------

--
-- Table structure for table `user_fridges`
--

CREATE TABLE `user_fridges` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `store_id` int(11) DEFAULT NULL,
  `fridge_id` int(11) DEFAULT NULL,
  `sched_pullout` datetime DEFAULT NULL,
  `status` enum('available','unavailable') COLLATE utf8_unicode_ci DEFAULT 'available',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `variations`
--

CREATE TABLE `variations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` int(11) NOT NULL,
  `size` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `flavor` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `price` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `promo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ads`
--
ALTER TABLE `ads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `areas`
--
ALTER TABLE `areas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `assigned_areas`
--
ALTER TABLE `assigned_areas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `carousels`
--
ALTER TABLE `carousels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fridges`
--
ALTER TABLE `fridges`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification_counter`
--
ALTER TABLE `notification_counter`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_invoice`
--
ALTER TABLE `order_invoice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_damages`
--
ALTER TABLE `product_damages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_file_damages`
--
ALTER TABLE `product_file_damages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_file_reports`
--
ALTER TABLE `product_file_reports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_reports`
--
ALTER TABLE `product_reports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_stocks`
--
ALTER TABLE `product_stocks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `promos`
--
ALTER TABLE `promos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quotas`
--
ALTER TABLE `quotas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `replacement_products`
--
ALTER TABLE `replacement_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales_report`
--
ALTER TABLE `sales_report`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD UNIQUE KEY `sessions_id_unique` (`id`);

--
-- Indexes for table `stocks`
--
ALTER TABLE `stocks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stores`
--
ALTER TABLE `stores`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `system_notifications`
--
ALTER TABLE `system_notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_fridges`
--
ALTER TABLE `user_fridges`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `variations`
--
ALTER TABLE `variations`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ads`
--
ALTER TABLE `ads`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `areas`
--
ALTER TABLE `areas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `assigned_areas`
--
ALTER TABLE `assigned_areas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `carousels`
--
ALTER TABLE `carousels`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fridges`
--
ALTER TABLE `fridges`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `notification_counter`
--
ALTER TABLE `notification_counter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `order_invoice`
--
ALTER TABLE `order_invoice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `product_damages`
--
ALTER TABLE `product_damages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_file_damages`
--
ALTER TABLE `product_file_damages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_file_reports`
--
ALTER TABLE `product_file_reports`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_reports`
--
ALTER TABLE `product_reports`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `product_stocks`
--
ALTER TABLE `product_stocks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `promos`
--
ALTER TABLE `promos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `quotas`
--
ALTER TABLE `quotas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `replacement_products`
--
ALTER TABLE `replacement_products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `sales_report`
--
ALTER TABLE `sales_report`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stocks`
--
ALTER TABLE `stocks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stores`
--
ALTER TABLE `stores`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `system_notifications`
--
ALTER TABLE `system_notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `user_fridges`
--
ALTER TABLE `user_fridges`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `variations`
--
ALTER TABLE `variations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
