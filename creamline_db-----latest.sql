-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 24, 2021 at 05:27 PM
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
(20, 'Cebu City', '6000', 0, '2021-04-16 08:17:58', '2021-04-16 08:17:58');

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
(2, NULL, 'Samsung', 'Test Descrption', NULL, 2, 0, 0, '2021-03-07 04:25:01', '2021-04-17 03:35:35');

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
(1, 1, 14, 14, NULL, '2021-04-24 15:24:24', '2021-04-24 15:24:24'),
(2, 76, 0, 0, NULL, '2021-04-24 15:24:25', '2021-04-24 15:24:25'),
(3, 75, 41, 41, NULL, '2021-04-24 15:24:26', '2021-04-24 15:24:26'),
(4, 1, 2, 0, NULL, '2021-04-24 15:26:30', '2021-04-24 15:26:30'),
(5, 1, 1, 0, NULL, '2021-04-24 15:26:44', '2021-04-24 15:26:44');

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
(26, 'Raspberry', 'Test Description', 'X3o3g5Gjk41SKTAsjRpaPmDv37PXOipSnqxz5cAL.jpg', 0, '2021-04-16 07:13:51', '2021-04-16 07:13:51');

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
(3, 1, '1 L', 864, 90, 100, 0, 0, '2021-03-17 04:04:28', '2021-04-24 03:00:40'),
(4, 1, '1.5 L', 1000, 150, 10, 10, 0, '2021-03-17 04:05:21', '2021-04-17 04:56:40'),
(5, 2, '750 ML', 1000, 25, 100, 10, 0, '2021-03-17 04:23:13', '2021-04-24 03:00:40'),
(6, 3, '60ml', 350, 10, 100, 0, 0, '2021-03-17 04:33:54', '2021-03-17 04:33:54'),
(7, 1, '500 L', 200, 100, 180, 1, 0, '2021-04-15 02:47:49', '2021-04-24 03:31:45'),
(8, 5, '350 ML', 1000, 150, 50, 0, 0, '2021-04-15 07:56:01', '2021-04-17 05:28:55'),
(9, 5, '500 ML', 1000, 200, 30, 0, 0, '2021-04-15 07:56:43', '2021-04-17 05:28:17'),
(10, 5, '750 ML', 1000, 70, 100, 0, 0, '2021-04-15 07:57:24', '2021-04-17 05:27:31'),
(11, 6, '750 ML', 1000, 150, 30, 0, 0, '2021-04-15 08:05:24', '2021-04-17 05:29:20'),
(12, 7, '500 ML', 1000, 200, 50, 0, 0, '2021-04-15 08:05:59', '2021-04-17 05:24:33'),
(13, 8, '750 ML', 1000, 350, 60, 0, 0, '2021-04-15 08:06:58', '2021-04-17 05:25:21'),
(14, 9, '750 ML', 1000, 300, 50, 0, 0, '2021-04-15 08:10:41', '2021-04-17 05:32:08'),
(15, 10, '750 ML', 998, 500, 30, 0, 0, '2021-04-15 08:12:23', '2021-04-24 01:24:49'),
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
('i7idOwMjidhgKwClypDzWAfM81DG7tF27HrkOo9M', 75, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.128 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiWEhlSzF4UlR5RVNJS1BPeURBNWRWTkVZNUd5M1hJSFY3M3ZERXBkSSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjY6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9ob21lIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6NzU7fQ==', 1619278001),
('JjfX5UA4ja0qXiKfkZvsKGtaHXZwGqgMrbtFLXw4', 76, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:88.0) Gecko/20100101 Firefox/88.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoickJkMmZsQ3I1YW5yanc5dVBTYUxpeXhCeHpsUVg5NlBBbmZSMnBEYyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjY6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9tYWluIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6NzY7fQ==', 1619278002),
('mpGQnn9hcnsWRc4HKGzjm8k0vhlH1qQy30oLdQtI', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.128 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoid0lJd2NuTlBZZmJDZTJOVjVPMjV5V3NTNjZ0YTlJd3RqTnNRQnB0dCI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czoyNzoiaHR0cDovL2xvY2FsaG9zdDo4MDAwL29yZGVyIjt9czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjg6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9mcmlkZ2UiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO3M6OToiY2FydF9kYXRhIjthOjE6e2k6MDtpOjE0O319', 1619278037);

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
(1, 0, 'out_of_stock', 0, 1, 48, 'Ube Pandan 750 ML is out of stock. Please re-stock as soon as possible.', 'admin', 'unread', '2021-04-24 07:26:30', '2021-04-24 07:26:30');

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
(1, 'Admin', 'NA', 'NA', 'Pardo Cebu', '09123456783', 'admin@creamline.com', '2020-06-07 23:57:47', '$2y$10$EN8DMgNgmRlqVPmSOAvmJO9vM/VJHWvgsXkBg9A2wgLnwidiOpWDO', 99, 1, 0, 'Upn1UTH65yw6SywgRwkDALTlrIY8H2VzmwlwvvTO.jpg', '4CMpJxKHbh35W6Ps1sdhhJf1NI605J0NGZ6PdczwAfLIXgIAJPXgeDUEl3xS', 0, NULL, 0, '2020-06-06 18:42:21', '2021-04-17 21:16:09');

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `assigned_areas`
--
ALTER TABLE `assigned_areas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `carousels`
--
ALTER TABLE `carousels`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fridges`
--
ALTER TABLE `fridges`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notification_counter`
--
ALTER TABLE `notification_counter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_invoice`
--
ALTER TABLE `order_invoice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_reports`
--
ALTER TABLE `product_reports`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `replacement_products`
--
ALTER TABLE `replacement_products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `system_notifications`
--
ALTER TABLE `system_notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
