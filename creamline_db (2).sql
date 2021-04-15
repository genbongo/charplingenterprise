-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 15, 2021 at 03:12 PM
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
(1, '1691933544.jpg', 0, '2020-10-21 07:22:57', '2021-02-27 02:36:17'),
(2, '2060903152.jpg', 0, '2020-10-21 07:23:02', '2021-02-27 02:36:25');

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
(1, 'Consolacion', '6001', 0, '2020-06-06 12:44:12', '2021-04-15 07:38:04'),
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
(19, 'Tuburan', '6043', 0, '2021-04-15 07:36:44', '2021-04-15 07:36:44');

-- --------------------------------------------------------

--
-- Table structure for table `assigned_areas`
--

CREATE TABLE `assigned_areas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `area_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `assigned_areas`
--

INSERT INTO `assigned_areas` (`id`, `user_id`, `area_id`, `created_at`, `updated_at`) VALUES
(4, 23, 1, '2021-04-15 03:01:22', '2021-04-15 03:01:22'),
(5, 24, 4, '2021-04-15 07:04:23', '2021-04-15 07:04:23'),
(6, 24, 4, '2021-04-15 07:04:26', '2021-04-15 07:04:26'),
(7, 27, 2, '2021-04-15 07:26:42', '2021-04-15 07:26:42'),
(8, 29, 3, '2021-04-15 07:51:50', '2021-04-15 07:51:50');

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
(7, 10, 15, 1, 'S8ireyFMB8latvxE2b7jNhu628r7ZaZzuBtG8pTv.png', 'Double Dutch', 'Test Description', '750', NULL, 20, 500, 10000.00, '0', '0', '2021-04-15 09:09:10', '2021-04-15 09:09:10'),
(8, 13, 17, 1, '4l1U9v1zAtOHzTOWLqVuDdBYCfi8mqHMzagzB76u.jpg', 'Sakura', 'Test Description', '1.5l', NULL, 10, 700, 7000.00, '0', '0', '2021-04-15 09:09:31', '2021-04-15 09:09:31'),
(9, 9, 14, 28, '7qyxGOzoGWpD6iAMgAMiMYVbXdMdipNrjVZdJNPh.jpg', 'Peach', 'Test Description', '750', NULL, 20, 300, 6000.00, '0', '0', '2021-04-15 09:22:46', '2021-04-15 09:22:46'),
(10, 1, 3, 28, '1358607368.jpg', 'Ube Pandan', 'Ube Pandan Description', '10ml', NULL, 10, 10, 100.00, '0', '0', '2021-04-15 10:01:55', '2021-04-15 10:01:55'),
(11, 6, 11, 28, 'QZ5jJbVUuj6boJxSusQbUhlg4bF9k2PcGmjmPgAb.png', 'Cookies and Cream', 'Test Description', '350ml', NULL, 10, 150, 1500.00, '0', '0', '2021-04-15 10:02:18', '2021-04-15 10:02:18'),
(12, 10, 15, 28, 'S8ireyFMB8latvxE2b7jNhu628r7ZaZzuBtG8pTv.png', 'Double Dutch', 'Test Description', '750', NULL, 10, 500, 5050.00, '0', '0', '2021-04-15 10:02:37', '2021-04-15 10:02:37'),
(13, 15, 19, 35, '0KN9ie6G0HS1ghBZiKWarMjiFx5LJzfKXiqMfilO.jpg', 'Strawberry', 'Test Description', '350ml', NULL, 1, 200, 200.00, '0', '0', '2021-04-15 11:31:00', '2021-04-15 11:31:00'),
(14, 13, 17, 35, '4l1U9v1zAtOHzTOWLqVuDdBYCfi8mqHMzagzB76u.jpg', 'Sakura', 'Test Description', '1.5l', NULL, 2, 700, 1400.00, '0', '0', '2021-04-15 11:43:59', '2021-04-15 11:43:59');

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
(2, 3, 'Panasonic', 'test', '2', 3, 0, 0, '2021-02-26 17:23:51', '2021-04-15 09:11:38'),
(3, 3, 'Samsung', 'hehehehe', NULL, 3, 0, 0, '2021-03-07 04:25:01', '2021-04-15 09:27:18'),
(4, NULL, 'Sony-8000', 'Testing', NULL, 4, 0, 0, '2021-04-15 09:25:47', '2021-04-15 09:31:13');

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
(15, 'Strawberry', 'Test Description', '0KN9ie6G0HS1ghBZiKWarMjiFx5LJzfKXiqMfilO.jpg', 0, '2021-04-15 08:20:49', '2021-04-15 08:20:49');

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
(1, 1, 'vIcJk1avtXOO1omF14WphAnz3BnAWt2tVWuroQtJ.jpg', '2021-04-15 10:40:34', '2021-04-15 10:40:34');

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

INSERT INTO `product_reports` (`id`, `product_id`, `report_type`, `size`, `flavor`, `store_id`, `client_id`, `issued_by`, `is_replaced`, `delivery_date`, `reason`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Replacement', NULL, NULL, 25, 28, 23, 0, NULL, 'ghgddjgjj', '2021-04-15 10:40:32', '2021-04-15 10:40:32');

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
(1, 2, '11ml', 95, 15, 50, 0, 0, '2021-03-16 04:14:58', '2021-03-19 04:56:16'),
(2, 3, '50ml', 298, 5, 100, 2, 0, '2021-03-16 04:31:44', '2021-03-17 06:22:24'),
(3, 1, '10ml', 92, 10, 100, 0, 0, '2021-03-17 04:04:28', '2021-03-19 04:56:16'),
(4, 1, '15ml', 1000, 15, 10, 10, 0, '2021-03-17 04:05:21', '2021-04-15 10:54:26'),
(5, 2, '12ml', 1000, 25, 100, 10, 0, '2021-03-17 04:23:13', '2021-03-17 04:23:13'),
(6, 3, '60ml', 350, 10, 100, 0, 0, '2021-03-17 04:33:54', '2021-03-17 04:33:54'),
(7, 1, '200ml', 200, 100, 20, 0, 0, '2021-04-15 02:47:49', '2021-04-15 02:48:05'),
(8, 5, '350ml', 1000, 150, 50, 0, 0, '2021-04-15 07:56:01', '2021-04-15 07:56:01'),
(9, 5, '500ml', 1000, 200, 30, 0, 0, '2021-04-15 07:56:43', '2021-04-15 08:02:20'),
(10, 5, '100ml', 1000, 70, 100, 0, 0, '2021-04-15 07:57:24', '2021-04-15 08:02:02'),
(11, 6, '350ml', 1000, 150, 30, 0, 0, '2021-04-15 08:05:24', '2021-04-15 08:05:24'),
(12, 7, '500ml', 1000, 200, 50, 0, 0, '2021-04-15 08:05:59', '2021-04-15 08:05:59'),
(13, 8, '350ml', 1000, 350, 60, 0, 0, '2021-04-15 08:06:58', '2021-04-15 08:06:58'),
(14, 9, '750', 1000, 300, 50, 0, 0, '2021-04-15 08:10:41', '2021-04-15 08:10:41'),
(15, 10, '750', 1000, 500, 30, 0, 0, '2021-04-15 08:12:23', '2021-04-15 08:12:23'),
(16, 12, '500ml', 1000, 500, 30, 0, 0, '2021-04-15 08:21:42', '2021-04-15 08:21:42'),
(17, 13, '1.5l', 1000, 700, 50, 0, 0, '2021-04-15 08:22:11', '2021-04-15 08:22:11'),
(18, 14, '500ml', 1000, 450, 50, 0, 0, '2021-04-15 08:22:47', '2021-04-15 08:22:47'),
(19, 15, '350ml', 1000, 200, 50, 0, 0, '2021-04-15 08:23:25', '2021-04-15 08:23:25');

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
(1, 2021, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2021-02-27 03:39:31', '2021-04-04 18:42:23');

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
(1, 1, 5, 8, '350ml', 150, 10, '2021-04-15 10:40:33', '2021-04-15 10:40:33'),
(2, 1, 1, 3, '10ml', 10, 25, '2021-04-15 10:40:33', '2021-04-15 10:40:33');

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
('ROExKWAjxuagltLUUoXMqoIvUAViehjSvpnxl8a4', 35, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.114 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoid1lNZHZOTXpXM1FkU0FPc3ZHNEVYaHVlUGxXQ1QyQVJndUVZNEpJYSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjY6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9jYXJ0Ijt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MzU7czo5OiJjYXJ0X2RhdGEiO086Mzk6IklsbHVtaW5hdGVcRGF0YWJhc2VcRWxvcXVlbnRcQ29sbGVjdGlvbiI6MTp7czo4OiIAKgBpdGVtcyI7YToyOntpOjA7Tzo4OiJBcHBcQ2FydCI6Mjc6e3M6MTE6IgAqAGZpbGxhYmxlIjthOjEwOntpOjA7czoxMDoicHJvZHVjdF9pZCI7aToxO3M6NzoidXNlcl9pZCI7aToyO3M6MTM6InByb2R1Y3RfaW1hZ2UiO2k6MztzOjEyOiJwcm9kdWN0X25hbWUiO2k6NDtzOjE5OiJwcm9kdWN0X2Rlc2NyaXB0aW9uIjtpOjU7czo0OiJzaXplIjtpOjY7czo4OiJxdWFudGl0eSI7aTo3O3M6NToicHJpY2UiO2k6ODtzOjg6InN1YnRvdGFsIjtpOjk7czoxNjoicHJvZHVjdF9zdG9ja19pZCI7fXM6MTM6IgAqAGNvbm5lY3Rpb24iO3M6NToibXlzcWwiO3M6ODoiACoAdGFibGUiO3M6NToiY2FydHMiO3M6MTM6IgAqAHByaW1hcnlLZXkiO3M6MjoiaWQiO3M6MTA6IgAqAGtleVR5cGUiO3M6MzoiaW50IjtzOjEyOiJpbmNyZW1lbnRpbmciO2I6MTtzOjc6IgAqAHdpdGgiO2E6MDp7fXM6MTI6IgAqAHdpdGhDb3VudCI7YTowOnt9czoxMDoiACoAcGVyUGFnZSI7aToxNTtzOjY6ImV4aXN0cyI7YjoxO3M6MTg6Indhc1JlY2VudGx5Q3JlYXRlZCI7YjowO3M6MTM6IgAqAGF0dHJpYnV0ZXMiO2E6MTY6e3M6MjoiaWQiO2k6MTM7czoxMDoicHJvZHVjdF9pZCI7aToxNTtzOjE2OiJwcm9kdWN0X3N0b2NrX2lkIjtpOjE5O3M6NzoidXNlcl9pZCI7aTozNTtzOjEzOiJwcm9kdWN0X2ltYWdlIjtzOjQ0OiIwS045aWU2RzBIUzFnaEJaaUtXYXJNamlGeDVMSnpmS1hpcU1maWxPLmpwZyI7czoxMjoicHJvZHVjdF9uYW1lIjtzOjEwOiJTdHJhd2JlcnJ5IjtzOjE5OiJwcm9kdWN0X2Rlc2NyaXB0aW9uIjtzOjE2OiJUZXN0IERlc2NyaXB0aW9uIjtzOjQ6InNpemUiO3M6NToiMzUwbWwiO3M6NjoiZmxhdm9yIjtOO3M6ODoicXVhbnRpdHkiO2k6MTtzOjU6InByaWNlIjtkOjIwMDtzOjg6InN1YnRvdGFsIjtkOjIwMDtzOjExOiJpc19jaGVja291dCI7czoxOiIwIjtzOjk6ImlzX3BsYWNlZCI7czoxOiIwIjtzOjEwOiJjcmVhdGVkX2F0IjtzOjE5OiIyMDIxLTA0LTE1IDE5OjMxOjAwIjtzOjEwOiJ1cGRhdGVkX2F0IjtzOjE5OiIyMDIxLTA0LTE1IDE5OjMxOjAwIjt9czoxMToiACoAb3JpZ2luYWwiO2E6MTY6e3M6MjoiaWQiO2k6MTM7czoxMDoicHJvZHVjdF9pZCI7aToxNTtzOjE2OiJwcm9kdWN0X3N0b2NrX2lkIjtpOjE5O3M6NzoidXNlcl9pZCI7aTozNTtzOjEzOiJwcm9kdWN0X2ltYWdlIjtzOjQ0OiIwS045aWU2RzBIUzFnaEJaaUtXYXJNamlGeDVMSnpmS1hpcU1maWxPLmpwZyI7czoxMjoicHJvZHVjdF9uYW1lIjtzOjEwOiJTdHJhd2JlcnJ5IjtzOjE5OiJwcm9kdWN0X2Rlc2NyaXB0aW9uIjtzOjE2OiJUZXN0IERlc2NyaXB0aW9uIjtzOjQ6InNpemUiO3M6NToiMzUwbWwiO3M6NjoiZmxhdm9yIjtOO3M6ODoicXVhbnRpdHkiO2k6MTtzOjU6InByaWNlIjtkOjIwMDtzOjg6InN1YnRvdGFsIjtkOjIwMDtzOjExOiJpc19jaGVja291dCI7czoxOiIwIjtzOjk6ImlzX3BsYWNlZCI7czoxOiIwIjtzOjEwOiJjcmVhdGVkX2F0IjtzOjE5OiIyMDIxLTA0LTE1IDE5OjMxOjAwIjtzOjEwOiJ1cGRhdGVkX2F0IjtzOjE5OiIyMDIxLTA0LTE1IDE5OjMxOjAwIjt9czoxMDoiACoAY2hhbmdlcyI7YTowOnt9czo4OiIAKgBjYXN0cyI7YTowOnt9czoxNzoiACoAY2xhc3NDYXN0Q2FjaGUiO2E6MDp7fXM6ODoiACoAZGF0ZXMiO2E6MDp7fXM6MTM6IgAqAGRhdGVGb3JtYXQiO047czoxMDoiACoAYXBwZW5kcyI7YTowOnt9czoxOToiACoAZGlzcGF0Y2hlc0V2ZW50cyI7YTowOnt9czoxNDoiACoAb2JzZXJ2YWJsZXMiO2E6MDp7fXM6MTI6IgAqAHJlbGF0aW9ucyI7YTowOnt9czoxMDoiACoAdG91Y2hlcyI7YTowOnt9czoxMDoidGltZXN0YW1wcyI7YjoxO3M6OToiACoAaGlkZGVuIjthOjA6e31zOjEwOiIAKgB2aXNpYmxlIjthOjA6e31zOjEwOiIAKgBndWFyZGVkIjthOjE6e2k6MDtzOjE6IioiO319aToxO086ODoiQXBwXENhcnQiOjI3OntzOjExOiIAKgBmaWxsYWJsZSI7YToxMDp7aTowO3M6MTA6InByb2R1Y3RfaWQiO2k6MTtzOjc6InVzZXJfaWQiO2k6MjtzOjEzOiJwcm9kdWN0X2ltYWdlIjtpOjM7czoxMjoicHJvZHVjdF9uYW1lIjtpOjQ7czoxOToicHJvZHVjdF9kZXNjcmlwdGlvbiI7aTo1O3M6NDoic2l6ZSI7aTo2O3M6ODoicXVhbnRpdHkiO2k6NztzOjU6InByaWNlIjtpOjg7czo4OiJzdWJ0b3RhbCI7aTo5O3M6MTY6InByb2R1Y3Rfc3RvY2tfaWQiO31zOjEzOiIAKgBjb25uZWN0aW9uIjtzOjU6Im15c3FsIjtzOjg6IgAqAHRhYmxlIjtzOjU6ImNhcnRzIjtzOjEzOiIAKgBwcmltYXJ5S2V5IjtzOjI6ImlkIjtzOjEwOiIAKgBrZXlUeXBlIjtzOjM6ImludCI7czoxMjoiaW5jcmVtZW50aW5nIjtiOjE7czo3OiIAKgB3aXRoIjthOjA6e31zOjEyOiIAKgB3aXRoQ291bnQiO2E6MDp7fXM6MTA6IgAqAHBlclBhZ2UiO2k6MTU7czo2OiJleGlzdHMiO2I6MTtzOjE4OiJ3YXNSZWNlbnRseUNyZWF0ZWQiO2I6MDtzOjEzOiIAKgBhdHRyaWJ1dGVzIjthOjE2OntzOjI6ImlkIjtpOjE0O3M6MTA6InByb2R1Y3RfaWQiO2k6MTM7czoxNjoicHJvZHVjdF9zdG9ja19pZCI7aToxNztzOjc6InVzZXJfaWQiO2k6MzU7czoxMzoicHJvZHVjdF9pbWFnZSI7czo0NDoiNGwxVTl2MXpBdE9IelRPV0xxVnVEZEJZQ2ZpOG1xSE16YWd6Qjc2dS5qcGciO3M6MTI6InByb2R1Y3RfbmFtZSI7czo2OiJTYWt1cmEiO3M6MTk6InByb2R1Y3RfZGVzY3JpcHRpb24iO3M6MTY6IlRlc3QgRGVzY3JpcHRpb24iO3M6NDoic2l6ZSI7czo0OiIxLjVsIjtzOjY6ImZsYXZvciI7TjtzOjg6InF1YW50aXR5IjtpOjI7czo1OiJwcmljZSI7ZDo3MDA7czo4OiJzdWJ0b3RhbCI7ZDoxNDAwO3M6MTE6ImlzX2NoZWNrb3V0IjtzOjE6IjAiO3M6OToiaXNfcGxhY2VkIjtzOjE6IjAiO3M6MTA6ImNyZWF0ZWRfYXQiO3M6MTk6IjIwMjEtMDQtMTUgMTk6NDM6NTkiO3M6MTA6InVwZGF0ZWRfYXQiO3M6MTk6IjIwMjEtMDQtMTUgMTk6NDM6NTkiO31zOjExOiIAKgBvcmlnaW5hbCI7YToxNjp7czoyOiJpZCI7aToxNDtzOjEwOiJwcm9kdWN0X2lkIjtpOjEzO3M6MTY6InByb2R1Y3Rfc3RvY2tfaWQiO2k6MTc7czo3OiJ1c2VyX2lkIjtpOjM1O3M6MTM6InByb2R1Y3RfaW1hZ2UiO3M6NDQ6IjRsMVU5djF6QXRPSHpUT1dMcVZ1RGRCWUNmaThtcUhNemFnekI3NnUuanBnIjtzOjEyOiJwcm9kdWN0X25hbWUiO3M6NjoiU2FrdXJhIjtzOjE5OiJwcm9kdWN0X2Rlc2NyaXB0aW9uIjtzOjE2OiJUZXN0IERlc2NyaXB0aW9uIjtzOjQ6InNpemUiO3M6NDoiMS41bCI7czo2OiJmbGF2b3IiO047czo4OiJxdWFudGl0eSI7aToyO3M6NToicHJpY2UiO2Q6NzAwO3M6ODoic3VidG90YWwiO2Q6MTQwMDtzOjExOiJpc19jaGVja291dCI7czoxOiIwIjtzOjk6ImlzX3BsYWNlZCI7czoxOiIwIjtzOjEwOiJjcmVhdGVkX2F0IjtzOjE5OiIyMDIxLTA0LTE1IDE5OjQzOjU5IjtzOjEwOiJ1cGRhdGVkX2F0IjtzOjE5OiIyMDIxLTA0LTE1IDE5OjQzOjU5Ijt9czoxMDoiACoAY2hhbmdlcyI7YTowOnt9czo4OiIAKgBjYXN0cyI7YTowOnt9czoxNzoiACoAY2xhc3NDYXN0Q2FjaGUiO2E6MDp7fXM6ODoiACoAZGF0ZXMiO2E6MDp7fXM6MTM6IgAqAGRhdGVGb3JtYXQiO047czoxMDoiACoAYXBwZW5kcyI7YTowOnt9czoxOToiACoAZGlzcGF0Y2hlc0V2ZW50cyI7YTowOnt9czoxNDoiACoAb2JzZXJ2YWJsZXMiO2E6MDp7fXM6MTI6IgAqAHJlbGF0aW9ucyI7YTowOnt9czoxMDoiACoAdG91Y2hlcyI7YTowOnt9czoxMDoidGltZXN0YW1wcyI7YjoxO3M6OToiACoAaGlkZGVuIjthOjA6e31zOjEwOiIAKgB2aXNpYmxlIjthOjA6e31zOjEwOiIAKgBndWFyZGVkIjthOjE6e2k6MDtzOjE6IioiO319fX19', 1618492339);

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
(25, 'gb store', 'talamban', 28, 1, 1, '2021-04-15 08:55:11', '2021-04-15 08:56:30'),
(26, 'Ken\'s Merchandise', 'Hernan Cortes St. Mandaue City', 34, 1, 0, '2021-04-15 09:53:25', '2021-04-15 09:53:25'),
(27, '123 store', 'liloan', 28, 5, 0, '2021-04-15 10:15:43', '2021-04-15 10:16:07'),
(28, 'Zhavia', 'Mandaue', 35, 2, 0, '2021-04-15 11:24:28', '2021-04-15 11:24:28');

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
(10, 0, 'running_out_stock', 0, 1, 3, 'Ube Pandan 10ml has reached the stock threshold. Please re-stock as soon as possible.', 'admin', 'unread', '2021-04-13 05:29:30', '2021-04-13 05:29:30'),
(11, 0, 'out_of_stock', 0, 1, 4, 'Ube Pandan 15ml is out of stock. Please re-stock as soon as possible.', 'admin', 'unread', '2021-04-13 05:29:30', '2021-04-13 05:29:30'),
(12, 28, 'approved_client_store', 0, 0, 0, 'Your new store named gb store located in talamban has been approved.<br> Click <a href=\"/store\">here</a> to see assigned sales agent.', 'client', 'unread', '2021-04-15 08:56:28', '2021-04-15 08:56:28'),
(13, 35, 'approved_client', 2, 0, 0, '(35) Panfilo Remedio is now added to your client’s list.<br> Click <a href=\"/client_list\">here</a> for details.', 'staff', 'unread', '2021-04-15 11:25:19', '2021-04-15 11:25:19'),
(14, 35, 'approved_client', 2, 0, 0, 'Hi,Panfilo Remedio. Welcome to creamline. <br>You can now order <a href=\"/shop\">here</a>.', 'client', 'unread', '2021-04-15 11:25:19', '2021-04-15 11:25:19');

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
(1, 'Admin', 'NA', 'NA', 'Pardo Cebu', '0912312321', 'admin@creamline.com', '2020-06-07 23:57:47', '$2y$10$EN8DMgNgmRlqVPmSOAvmJO9vM/VJHWvgsXkBg9A2wgLnwidiOpWDO', 99, 1, 0, 'Upn1UTH65yw6SywgRwkDALTlrIY8H2VzmwlwvvTO.jpg', 'QCzK6LC2TbTuHzIUP0pKYwhKKGEcIPHshI6DBmTRrArT95efMVUTjwTkI8gm', 0, NULL, 0, '2020-06-06 18:42:21', '2021-04-14 12:24:13'),
(23, 'staff', 'staff', 'staff', 'NA', '09666147587', 'staff@creamline.com', '2020-06-08 07:57:47', '$2y$10$4VAVxP1QBmoubEVV9eT0meEcScWxTjs69g/DFAr3keyghES6ezMM6', 1, 1, 0, 'NA', '3CKWCogPP0zn1YyM3ExzEjfXOu7tWPHjCYgkZOq08Er13bmAwTsg8TNAX76n', 1, NULL, 0, '2021-04-15 03:01:00', '2021-04-15 03:03:36'),
(24, 'staffsecond', 'staff', 'staff', 'NA', '09123456789', 'staff2@creamline.com', '2020-06-08 07:57:47', '$2y$10$2QbPEx/ZmkW3xUVcj5267eIYs3hzRmrjMBYOTi0OylSPeF1hxV.sm', 1, 1, 0, 'NA', 'NA', 4, NULL, 0, '2021-04-15 06:59:19', '2021-04-15 07:04:24'),
(25, 'Candy Carol', 'Briguez', 'Ochea', 'NA', '09674371478', 'ocheacandy1998@gmail.com', '2020-06-08 07:57:47', '$2y$10$8aTtmM8.pEObZmnPAD4PROoxTtRmPltfClSs87PFXfjoyQUFlEviO', 2, 1, 0, 'NA', 'NA', 0, NULL, 0, '2021-04-15 07:06:56', '2021-04-15 07:06:56'),
(26, 'Masamune Alex', 'Arvi', 'Ishizuka', 'NA', '09666147587', 'ishizukaarvi@gmail.com', '2020-06-08 07:57:47', '$2y$10$cAx9mERt3NUqR1XuGuv0Tuo5pqoBd8U5ghLFzsqYiXwSBx8COstle', 2, 1, 0, 'NA', 'NA', 0, NULL, 0, '2021-04-15 07:11:15', '2021-04-15 07:11:15'),
(27, 'Alex', 'Michael', 'Karev', 'NA', '09086343228', 'alexkarev@gmail.com', '2020-06-08 07:57:47', '$2y$10$a6l9pH8f.c9wegoFBiOpPujzZf0NgdJ9Vy90gMQmhHdCwL95Zp43S', 1, 1, 0, 'NA', 'NA', 2, NULL, 0, '2021-04-15 07:15:51', '2021-04-15 07:26:42'),
(28, 'Genesis', 'Catacutan', 'Bongo', 'NA', '09086343228', 'genbongo@gmail.com', '2020-06-08 07:57:47', '$2y$10$SylygCAArkJ1GiC3j8d6y.OVLsY0dwlDtB8e8hKvP3Xeq.jTxZY.K', 2, 1, 0, 'NA', 'atWJ1F4UFv8NL4QvUWEyZQrltS1GPcQJ24dD9NPc5G8MaZNYfTA0xQZt2WXT', 0, NULL, 0, '2021-04-15 07:17:23', '2021-04-15 07:17:23'),
(29, 'Isobel', 'Alice', 'Stevens', 'NA', '09123456789', 'isobelstevens@gmail.com', '2020-06-08 07:57:47', '$2y$10$tqP93lsnK6I2QL0mQX9SpOi7pX9G5xDcqC0eRkWP.fKhFKNUHcBbi', 1, 1, 0, 'NA', 'NA', 3, NULL, 0, '2021-04-15 07:19:51', '2021-04-15 07:51:50'),
(30, 'Meredith', 'Ellis', 'Grey', 'NA', '09789456123', 'meredithgrey@gmail.com', '2020-06-08 07:57:47', '$2y$10$6OCxXFneqjvVmIuHgMm4A.35SyAV6j8B6N3/bxh3Djrp9dHHVBci6', 1, 1, 0, 'NA', 'NA', 0, NULL, 0, '2021-04-15 07:20:57', '2021-04-15 07:25:49'),
(31, 'Calliope', 'Iphegenia', 'Torres', 'NA', '09456123789', 'callietorres@gmail.com', '2020-06-08 07:57:47', '$2y$10$FncroWCdQX.4vO1HV5cuF.GvVmC1jq/Ad5T16s3XN86yAFA9UYEDe', 1, 1, 0, 'NA', 'NA', 0, NULL, 0, '2021-04-15 07:23:40', '2021-04-15 07:25:54'),
(32, 'Mark', 'Everett', 'Sloan', 'NA', '09123789456', 'marksloan@gmail.com', '2020-06-08 07:57:47', '$2y$10$WkvkNZk5xwK5dq6warIY.OGgFAi7xnPuStkNI042Um8C0K5KRbmp2', 1, 1, 0, 'NA', 'NA', 0, NULL, 0, '2021-04-15 07:24:15', '2021-04-15 07:25:57'),
(33, 'Alexandra', 'Caroline', 'Grey', 'NA', '09963741852', 'lexiegrey@gmail.com', '2020-06-08 07:57:47', '$2y$10$rZHGk7EEBcR1W/dh7AJOm.BSQrQAwNpIVtgZVfORbs4.z5l7RugNi', 1, 1, 0, 'NA', 'NA', 0, NULL, 0, '2021-04-15 07:25:30', '2021-04-15 07:26:08'),
(34, 'Candy', 'Briguez', 'Ochea', 'Mandaue', '9420986973', '13104206@usc.edu.ph', NULL, '$2y$10$2ov4oWkpZWmLFwf0T2pRb.Bfc.8HwkQ7Mk0qTzR31KavrBKgKn5P.', 2, 0, 1, '', NULL, 1, '2021-06-15 09:53:22', 0, '2021-04-15 09:53:22', '2021-04-15 09:53:22'),
(35, 'Panfilo', 'Ople', 'Remedio', 'Pilit Cabancalan Mandaue City Cebu', '09157339459', 'panfilo.glophics@gmail.com', NULL, '$2y$10$FEchqFwf14309e.qhB5IUeKNO3jDXCjBeuuTqjPj0XaCaMiF3uS0W', 2, 1, 0, '', NULL, 2, '2021-06-15 11:24:25', 0, '2021-04-15 11:24:25', '2021-04-15 11:25:18');

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

--
-- Dumping data for table `user_fridges`
--

INSERT INTO `user_fridges` (`id`, `user_id`, `store_id`, `fridge_id`, `sched_pullout`, `status`, `created_at`, `updated_at`) VALUES
(1, NULL, 25, 4, NULL, 'available', '2021-04-15 09:27:47', '2021-04-15 09:27:47');

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `areas`
--
ALTER TABLE `areas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `assigned_areas`
--
ALTER TABLE `assigned_areas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `carousels`
--
ALTER TABLE `carousels`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fridges`
--
ALTER TABLE `fridges`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `order_invoice`
--
ALTER TABLE `order_invoice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_reports`
--
ALTER TABLE `product_reports`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `product_stocks`
--
ALTER TABLE `product_stocks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `promos`
--
ALTER TABLE `promos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `quotas`
--
ALTER TABLE `quotas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `replacement_products`
--
ALTER TABLE `replacement_products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `system_notifications`
--
ALTER TABLE `system_notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `user_fridges`
--
ALTER TABLE `user_fridges`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `variations`
--
ALTER TABLE `variations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
