-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 06, 2026 at 11:39 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `iptv04`
--

-- --------------------------------------------------------

--
-- Table structure for table `affiliates`
--

CREATE TABLE `affiliates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `referral_code` varchar(255) NOT NULL,
  `total_earnings` decimal(10,2) NOT NULL DEFAULT 0.00,
  `pending_earnings` decimal(10,2) NOT NULL DEFAULT 0.00,
  `paid_earnings` decimal(10,2) NOT NULL DEFAULT 0.00,
  `total_referrals` int(11) NOT NULL DEFAULT 0,
  `total_sales` int(11) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `custom_commission_rate` decimal(5,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `affiliates`
--

INSERT INTO `affiliates` (`id`, `user_id`, `referral_code`, `total_earnings`, `pending_earnings`, `paid_earnings`, `total_referrals`, `total_sales`, `is_active`, `custom_commission_rate`, `created_at`, `updated_at`) VALUES
(3, 3, '6D3ABF8B', 0.00, 0.00, 0.00, 0, 0, 1, NULL, '2026-05-04 15:38:49', '2026-05-04 15:38:49'),
(4, 4, '11929323', 5.80, 0.00, 5.80, 1, 1, 1, NULL, '2026-05-05 01:20:12', '2026-05-06 01:41:54'),
(5, 5, 'DA693796', 0.00, 0.00, 0.00, 0, 0, 1, NULL, '2026-05-05 01:21:14', '2026-05-05 01:21:14');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('laravel-cache-setting_admin_notification_email', 's:22:\"admin@bestliveiptv.com\";', 1777928466),
('laravel-cache-setting_affiliate_commission_rate', 's:2:\"20\";', 1777991381),
('laravel-cache-setting_affiliate_cookie_duration', 's:2:\"30\";', 1777991381),
('laravel-cache-setting_affiliate_enabled', 's:1:\"1\";', 1777991381),
('laravel-cache-setting_affiliate_minimum_payout', 's:2:\"50\";', 1777991381),
('laravel-cache-setting_announcement_enabled', 's:1:\"0\";', 1778063888),
('laravel-cache-setting_announcement_link', 's:9:\"/packages\";', 1778063888),
('laravel-cache-setting_announcement_link_text', 's:8:\"Shop Now\";', 1778063888),
('laravel-cache-setting_announcement_text', 's:78:\"Get <strong>50% OFF</strong> on annual plans — Use code: <code>LIVE50</code>\";', 1778063888),
('laravel-cache-setting_crisp_website_id', 'N;', 1778063888),
('laravel-cache-setting_mail_encryption', 'N;', 1778063888),
('laravel-cache-setting_mail_from_address', 'N;', 1778063888),
('laravel-cache-setting_mail_from_name', 's:14:\"Best Live IPTV\";', 1778061628),
('laravel-cache-setting_mail_host', 'N;', 1778063888),
('laravel-cache-setting_mail_password', 'N;', 1778063888),
('laravel-cache-setting_mail_port', 'N;', 1778063888),
('laravel-cache-setting_mail_username', 'N;', 1778063888),
('laravel-cache-setting_nowpayments_api_key', 's:0:\"\";', 1778061628),
('laravel-cache-setting_nowpayments_enabled', 's:1:\"0\";', 1778061684),
('laravel-cache-setting_nowpayments_ipn_secret', 's:0:\"\";', 1778061629),
('laravel-cache-setting_nowpayments_sandbox', 's:1:\"1\";', 1778061629),
('laravel-cache-setting_stripe_enabled', 's:1:\"1\";', 1777964484),
('laravel-cache-setting_stripe_publishable_key', 's:0:\"\";', 1778061628),
('laravel-cache-setting_stripe_secret_key', 's:0:\"\";', 1778061628),
('laravel-cache-setting_stripe_webhook_secret', 's:0:\"\";', 1778061628),
('laravel-cache-setting_support_type', 's:4:\"24/7\";', 1778063888),
('laravel-cache-setting_total_channels', 's:7:\"20,000+\";', 1778063888),
('laravel-cache-setting_total_countries', 's:4:\"150+\";', 1778063888),
('laravel-cache-setting_uptime_percentage', 's:5:\"99.9%\";', 1778063888),
('laravel-cache-setting_whatsapp_number', 'N;', 1778063888);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `channels`
--

CREATE TABLE `channels` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `quality` varchar(255) NOT NULL DEFAULT 'HD',
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `channel_categories`
--

CREATE TABLE `channel_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `flag` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `channel_count` int(11) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `commissions`
--

CREATE TABLE `commissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `affiliate_id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `referral_id` bigint(20) UNSIGNED NOT NULL,
  `order_amount` decimal(10,2) NOT NULL,
  `commission_rate` decimal(5,2) NOT NULL,
  `commission_amount` decimal(10,2) NOT NULL,
  `status` enum('pending','approved','paid','rejected') NOT NULL DEFAULT 'pending',
  `approved_at` timestamp NULL DEFAULT NULL,
  `paid_at` timestamp NULL DEFAULT NULL,
  `admin_notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `commissions`
--

INSERT INTO `commissions` (`id`, `affiliate_id`, `order_id`, `referral_id`, `order_amount`, `commission_rate`, `commission_amount`, `status`, `approved_at`, `paid_at`, `admin_notes`, `created_at`, `updated_at`) VALUES
(1, 4, 3, 2, 28.99, 20.00, 5.80, 'approved', '2026-05-06 01:41:54', NULL, NULL, '2026-05-06 01:41:53', '2026-05-06 01:41:54');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'new',
  `admin_notes` text DEFAULT NULL,
  `admin_seen_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(3) NOT NULL,
  `flag` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `name`, `code`, `flag`, `is_active`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 'United States', 'US', '🇺🇸', 1, 1, '2026-05-04 14:35:55', '2026-05-04 14:35:55'),
(2, 'United Kingdom', 'UK', '🇬🇧', 1, 2, '2026-05-04 14:35:55', '2026-05-04 14:35:55'),
(3, 'Canada', 'CA', '🇨🇦', 1, 3, '2026-05-04 14:35:55', '2026-05-04 14:35:55'),
(4, 'Germany', 'DE', '🇩🇪', 1, 4, '2026-05-04 14:35:55', '2026-05-04 14:35:55'),
(5, 'France', 'FR', '🇫🇷', 1, 5, '2026-05-04 14:35:55', '2026-05-04 14:35:55'),
(6, 'Spain', 'ES', '🇪🇸', 1, 6, '2026-05-04 14:35:55', '2026-05-04 14:35:55'),
(7, 'Italy', 'IT', '🇮🇹', 1, 7, '2026-05-04 14:35:55', '2026-05-04 14:35:55'),
(8, 'Netherlands', 'NL', '🇳🇱', 1, 8, '2026-05-04 14:35:55', '2026-05-04 14:35:55'),
(9, 'Belgium', 'BE', '🇧🇪', 1, 9, '2026-05-04 14:35:55', '2026-05-04 14:35:55'),
(10, 'Switzerland', 'CH', '🇨🇭', 1, 10, '2026-05-04 14:35:55', '2026-05-04 14:35:55'),
(11, 'Austria', 'AT', '🇦🇹', 1, 11, '2026-05-04 14:35:55', '2026-05-04 14:35:55'),
(12, 'Portugal', 'PT', '🇵🇹', 1, 12, '2026-05-04 14:35:55', '2026-05-04 14:35:55'),
(13, 'Poland', 'PL', '🇵🇱', 1, 13, '2026-05-04 14:35:55', '2026-05-04 14:35:55'),
(14, 'Sweden', 'SE', '🇸🇪', 1, 14, '2026-05-04 14:35:55', '2026-05-04 14:35:55'),
(15, 'Norway', 'NO', '🇳🇴', 1, 15, '2026-05-04 14:35:55', '2026-05-04 14:35:55'),
(16, 'Denmark', 'DK', '🇩🇰', 1, 16, '2026-05-04 14:35:55', '2026-05-04 14:35:55'),
(17, 'Finland', 'FI', '🇫🇮', 1, 17, '2026-05-04 14:35:55', '2026-05-04 14:35:55'),
(18, 'Ireland', 'IE', '🇮🇪', 1, 18, '2026-05-04 14:35:55', '2026-05-04 14:35:55'),
(19, 'Australia', 'AU', '🇦🇺', 1, 19, '2026-05-04 14:35:55', '2026-05-04 14:35:55'),
(20, 'New Zealand', 'NZ', '🇳🇿', 1, 20, '2026-05-04 14:35:55', '2026-05-04 14:35:55'),
(21, 'India', 'IN', '🇮🇳', 1, 21, '2026-05-04 14:35:55', '2026-05-04 14:35:55'),
(22, 'Pakistan', 'PK', '🇵🇰', 1, 22, '2026-05-04 14:35:55', '2026-05-04 14:35:55'),
(23, 'Brazil', 'BR', '🇧🇷', 1, 23, '2026-05-04 14:35:55', '2026-05-04 14:35:55'),
(24, 'Mexico', 'MX', '🇲🇽', 1, 24, '2026-05-04 14:35:55', '2026-05-04 14:35:55'),
(25, 'Argentina', 'AR', '🇦🇷', 1, 25, '2026-05-04 14:35:55', '2026-05-04 14:35:55'),
(26, 'Turkey', 'TR', '🇹🇷', 1, 26, '2026-05-04 14:35:55', '2026-05-04 14:35:55'),
(27, 'Saudi Arabia', 'SA', '🇸🇦', 1, 27, '2026-05-04 14:35:55', '2026-05-04 14:35:55'),
(28, 'UAE', 'AE', '🇦🇪', 1, 28, '2026-05-04 14:35:55', '2026-05-04 14:35:55'),
(29, 'Egypt', 'EG', '🇪🇬', 1, 29, '2026-05-04 14:35:55', '2026-05-04 14:35:55'),
(30, 'South Africa', 'ZA', '🇿🇦', 1, 30, '2026-05-04 14:35:55', '2026-05-04 14:35:55');

-- --------------------------------------------------------

--
-- Table structure for table `country_order`
--

CREATE TABLE `country_order` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `country_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `country_order`
--

INSERT INTO `country_order` (`id`, `order_id`, `country_id`, `created_at`, `updated_at`) VALUES
(8, 3, 4, NULL, NULL),
(9, 3, 5, NULL, NULL),
(10, 3, 10, NULL, NULL),
(11, 3, 11, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) NOT NULL,
  `type` enum('percentage','fixed') NOT NULL DEFAULT 'percentage',
  `value` decimal(10,2) NOT NULL,
  `usage_limit` int(11) DEFAULT NULL,
  `usage_count` int(11) NOT NULL DEFAULT 0,
  `expires_at` timestamp NULL DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `faqs`
--

CREATE TABLE `faqs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `question` varchar(255) NOT NULL,
  `answer` text NOT NULL,
  `category` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `features`
--

CREATE TABLE `features` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `feature_package`
--

CREATE TABLE `feature_package` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `package_id` bigint(20) UNSIGNED NOT NULL,
  `feature_id` bigint(20) UNSIGNED NOT NULL,
  `is_included` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `queue`, `payload`, `attempts`, `reserved_at`, `available_at`, `created_at`) VALUES
(1, 'default', '{\"uuid\":\"ddf509c5-57ba-481c-a2d3-9de8a97f2bfc\",\"displayName\":\"App\\\\Mail\\\\OrderConfirmationMail\",\"job\":\"Illuminate\\\\Queue\\\\CallQueuedHandler@call\",\"maxTries\":null,\"maxExceptions\":null,\"failOnTimeout\":false,\"backoff\":null,\"timeout\":null,\"retryUntil\":null,\"data\":{\"commandName\":\"Illuminate\\\\Mail\\\\SendQueuedMailable\",\"command\":\"O:34:\\\"Illuminate\\\\Mail\\\\SendQueuedMailable\\\":17:{s:8:\\\"mailable\\\";O:30:\\\"App\\\\Mail\\\\OrderConfirmationMail\\\":4:{s:5:\\\"order\\\";O:45:\\\"Illuminate\\\\Contracts\\\\Database\\\\ModelIdentifier\\\":5:{s:5:\\\"class\\\";s:16:\\\"App\\\\Models\\\\Order\\\";s:2:\\\"id\\\";i:1;s:9:\\\"relations\\\";a:1:{i:0;s:7:\\\"package\\\";}s:10:\\\"connection\\\";s:5:\\\"mysql\\\";s:15:\\\"collectionClass\\\";N;}s:11:\\\"credentials\\\";a:3:{s:8:\\\"username\\\";s:13:\\\"user_B0214057\\\";s:8:\\\"password\\\";s:15:\\\"pass_E1436255E3\\\";s:7:\\\"m3u_url\\\";s:98:\\\"http:\\/\\/bestliveiptv.com:8080\\/get.php?username=user_B0214057&password=pass_E1436255E3&type=m3u_plus\\\";}s:2:\\\"to\\\";a:1:{i:0;a:2:{s:4:\\\"name\\\";N;s:7:\\\"address\\\";s:26:\\\"hassanarifallah9@gmail.com\\\";}}s:6:\\\"mailer\\\";s:3:\\\"log\\\";}s:5:\\\"tries\\\";N;s:7:\\\"timeout\\\";N;s:13:\\\"maxExceptions\\\";N;s:17:\\\"shouldBeEncrypted\\\";b:0;s:10:\\\"connection\\\";N;s:5:\\\"queue\\\";N;s:12:\\\"messageGroup\\\";N;s:12:\\\"deduplicator\\\";N;s:5:\\\"delay\\\";N;s:11:\\\"afterCommit\\\";N;s:10:\\\"middleware\\\";a:0:{}s:7:\\\"chained\\\";a:0:{}s:15:\\\"chainConnection\\\";N;s:10:\\\"chainQueue\\\";N;s:19:\\\"chainCatchCallbacks\\\";N;s:3:\\\"job\\\";N;}\"},\"createdAt\":1777924866,\"delay\":null}', 0, NULL, 1777924866, 1777924866);

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_01_15_000001_create_packages_table', 1),
(5, '2026_01_15_000002_create_features_table', 1),
(6, '2026_01_15_000003_create_orders_table', 1),
(7, '2026_01_15_000004_create_contacts_table', 1),
(8, '2026_01_15_000005_create_testimonials_table', 1),
(9, '2026_01_15_000006_create_faqs_table', 1),
(10, '2026_01_15_000007_create_settings_table', 1),
(11, '2026_01_15_000008_create_channels_table', 1),
(12, '2026_01_15_162044_create_feature_package_pivot_table', 1),
(13, '2026_01_15_200001_add_admin_fields_to_users_table', 1),
(14, '2026_01_15_200002_create_countries_table', 1),
(15, '2026_01_15_200003_add_stripe_fields_to_orders_table', 1),
(16, '2026_01_17_000001_add_nowpayments_to_settings', 1),
(17, '2026_01_17_142821_create_affiliates_table', 1),
(18, '2026_01_18_055813_add_adjustment_columns_to_orders_table', 1),
(19, '2026_01_18_061032_add_two_factor_columns_to_users_table', 1),
(20, '2026_01_18_062728_add_custom_commission_rate_to_affiliates_table', 1),
(21, '2026_01_18_071339_add_is_reseller_to_packages_table', 1),
(22, '2026_01_18_072359_create_coupons_table', 1),
(23, '2026_01_18_072447_add_announcement_settings_to_settings_table', 1),
(24, '2026_03_26_120000_add_seen_columns_to_orders_table', 1),
(25, '2026_03_26_130000_add_admin_seen_columns_to_users_and_contacts_tables', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_number` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `package_id` bigint(20) UNSIGNED NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `customer_email` varchar(255) NOT NULL,
  `customer_phone` varchar(255) DEFAULT NULL,
  `amount` decimal(10,2) NOT NULL,
  `adjustment_amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `coupon_code` varchar(255) DEFAULT NULL,
  `discount_amount` decimal(10,2) NOT NULL DEFAULT 0.00,
  `payment_method` varchar(255) DEFAULT NULL,
  `stripe_payment_id` varchar(255) DEFAULT NULL,
  `stripe_session_id` varchar(255) DEFAULT NULL,
  `payment_status` varchar(255) NOT NULL DEFAULT 'pending',
  `order_status` varchar(255) NOT NULL DEFAULT 'pending',
  `notes` text DEFAULT NULL,
  `admin_notes` text DEFAULT NULL,
  `subscription_details` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`subscription_details`)),
  `selected_countries` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`selected_countries`)),
  `activated_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `email_sent_at` timestamp NULL DEFAULT NULL,
  `admin_seen_at` timestamp NULL DEFAULT NULL,
  `user_seen_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `order_number`, `user_id`, `package_id`, `customer_name`, `customer_email`, `customer_phone`, `amount`, `adjustment_amount`, `coupon_code`, `discount_amount`, `payment_method`, `stripe_payment_id`, `stripe_session_id`, `payment_status`, `order_status`, `notes`, `admin_notes`, `subscription_details`, `selected_countries`, `activated_at`, `expires_at`, `email_sent_at`, `admin_seen_at`, `user_seen_at`, `created_at`, `updated_at`) VALUES
(3, 'BLI-69F98D4ACFEBF-20260505', 5, 4, 'hassan', 'hassanarifallah9@gmail.com', '+33656565756', 28.99, 0.00, NULL, 0.00, 'stripe', NULL, NULL, 'completed', 'completed', NULL, NULL, NULL, '[\"4\",\"5\",\"10\",\"11\"]', '2026-05-05 01:26:01', '2026-11-03 01:26:01', NULL, '2026-05-05 01:25:49', '2026-05-05 01:26:43', '2026-05-05 01:25:14', '2026-05-05 01:26:43');

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE `packages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `original_price` decimal(10,2) DEFAULT NULL,
  `duration_months` int(11) NOT NULL DEFAULT 1,
  `duration_days` int(11) NOT NULL DEFAULT 30,
  `duration_label` varchar(255) NOT NULL DEFAULT '1 Month',
  `connections` int(11) NOT NULL DEFAULT 1,
  `features_list` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`features_list`)),
  `is_featured` tinyint(1) NOT NULL DEFAULT 0,
  `is_trial` tinyint(1) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_reseller` tinyint(1) NOT NULL DEFAULT 0,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `packages`
--

INSERT INTO `packages` (`id`, `name`, `slug`, `description`, `price`, `original_price`, `duration_months`, `duration_days`, `duration_label`, `connections`, `features_list`, `is_featured`, `is_trial`, `is_active`, `is_reseller`, `sort_order`, `created_at`, `updated_at`) VALUES
(1, 'Dummy Package 1', 'dummy-package-1-20260504-1', 'Dummy package seeded for local testing.', 10.99, 20.99, 1, 30, '1 Month', 1, '[\"20,000+ Live Channels\",\"50,000+ VOD\",\"HD Streaming\",\"24\\/7 Support\"]', 0, 0, 1, 0, 2, '2026-05-04 08:10:38', '2026-05-04 08:10:38'),
(2, 'Dummy Package 2', 'dummy-package-2-20260504-2', 'Dummy package seeded for local testing.', 11.99, 21.99, 1, 30, '1 Month', 1, '[\"20,000+ Live Channels\",\"50,000+ VOD\",\"HD Streaming\",\"24\\/7 Support\"]', 1, 0, 1, 0, 3, '2026-05-04 08:10:38', '2026-05-04 08:10:38'),
(3, 'Dummy Package 3', 'dummy-package-3-20260504-3', 'Dummy package seeded for local testing.', 12.99, 22.99, 1, 30, '1 Month', 2, '[\"20,000+ Live Channels\",\"50,000+ VOD\",\"HD Streaming\",\"24\\/7 Support\"]', 0, 0, 1, 0, 4, '2026-05-04 08:10:38', '2026-05-04 08:10:38'),
(4, 'Dummy Package 4', 'dummy-package-4-20260504-4', 'Dummy package seeded for local testing.', 28.99, 38.99, 3, 90, '3 Months', 4, '[\"20,000+ Live Channels\",\"50,000+ VOD\",\"HD Streaming\",\"24\\/7 Support\"]', 0, 0, 1, 0, 5, '2026-05-04 08:10:38', '2026-05-04 08:10:38'),
(5, 'Dummy Package 5', 'dummy-package-5-20260504-5', 'Dummy package seeded for local testing.', 29.99, 39.99, 3, 90, '3 Months', 1, '[\"20,000+ Live Channels\",\"50,000+ VOD\",\"HD Streaming\",\"24\\/7 Support\"]', 0, 0, 1, 0, 6, '2026-05-04 08:10:38', '2026-05-04 08:10:38'),
(6, 'Dummy Package 6', 'dummy-package-6-20260504-6', 'Dummy package seeded for local testing.', 30.99, 40.99, 3, 90, '3 Months', 2, '[\"20,000+ Live Channels\",\"50,000+ VOD\",\"HD Streaming\",\"24\\/7 Support\"]', 0, 0, 1, 0, 7, '2026-05-04 08:10:38', '2026-05-04 08:10:38'),
(7, 'Dummy Package 7', 'dummy-package-7-20260504-7', 'Dummy package seeded for local testing.', 51.99, 61.99, 6, 180, '6 Months', 1, '[\"20,000+ Live Channels\",\"50,000+ VOD\",\"HD Streaming\",\"24\\/7 Support\"]', 0, 0, 1, 0, 8, '2026-05-04 08:10:38', '2026-05-04 08:10:38'),
(8, 'Dummy Package 8', 'dummy-package-8-20260504-8', 'Dummy package seeded for local testing.', 52.99, 62.99, 6, 180, '6 Months', 4, '[\"20,000+ Live Channels\",\"50,000+ VOD\",\"HD Streaming\",\"24\\/7 Support\"]', 0, 0, 1, 0, 9, '2026-05-04 08:10:38', '2026-05-04 08:10:38'),
(9, 'Dummy Package 9', 'dummy-package-9-20260504-9', 'Dummy package seeded for local testing.', 88.99, 98.99, 12, 365, '12 Months', 2, '[\"20,000+ Live Channels\",\"50,000+ VOD\",\"HD Streaming\",\"24\\/7 Support\"]', 0, 0, 1, 0, 10, '2026-05-04 08:10:38', '2026-05-04 08:10:38'),
(10, 'Dummy Package 10', 'dummy-package-10-20260504-10', 'Dummy package seeded for local testing.', 89.99, 99.99, 12, 365, '12 Months', 1, '[\"20,000+ Live Channels\",\"50,000+ VOD\",\"HD Streaming\",\"24\\/7 Support\"]', 0, 0, 1, 0, 11, '2026-05-04 08:10:38', '2026-05-04 08:10:38'),
(11, 'Test Free Checkout', 'test-free-checkout', 'Free test package for local checkout flow.', 0.00, NULL, 0, 1, 'Test (1 Day)', 1, NULL, 0, 0, 1, 0, 1, '2026-05-04 09:01:55', '2026-05-04 09:01:55');

-- --------------------------------------------------------

--
-- Table structure for table `package_feature`
--

CREATE TABLE `package_feature` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `package_id` bigint(20) UNSIGNED NOT NULL,
  `feature_id` bigint(20) UNSIGNED NOT NULL,
  `is_included` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payouts`
--

CREATE TABLE `payouts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `affiliate_id` bigint(20) UNSIGNED NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payment_method` enum('paypal','bank_transfer','crypto','other') NOT NULL,
  `payment_details` text NOT NULL,
  `status` enum('pending','processing','completed','rejected') NOT NULL DEFAULT 'pending',
  `processed_at` timestamp NULL DEFAULT NULL,
  `admin_notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `referrals`
--

CREATE TABLE `referrals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `affiliate_id` bigint(20) UNSIGNED NOT NULL,
  `referred_user_id` bigint(20) UNSIGNED NOT NULL,
  `referral_code` varchar(255) NOT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `converted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `referrals`
--

INSERT INTO `referrals` (`id`, `affiliate_id`, `referred_user_id`, `referral_code`, `ip_address`, `converted_at`, `created_at`, `updated_at`) VALUES
(2, 4, 5, '11929323', '127.0.0.1', '2026-05-06 01:41:53', '2026-05-05 01:21:14', '2026-05-06 01:41:53');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('1OVXL4u9l55oKZBglOtfhSFykW2g4UKc2DnheSay', NULL, '127.0.0.1', 'curl/8.13.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoieE5LVTVxOWE1UjRLSkFXU3FCcTdxZHBnYjVoYWhORm1NQ2o4bGp6TCI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czo0OToiaHR0cDovLzEyNy4wLjAuMTo4MDAxL2NoZWNrb3V0L3Rlc3QtZnJlZS1jaGVja291dCI7fXM6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjQ5OiJodHRwOi8vMTI3LjAuMC4xOjgwMDEvY2hlY2tvdXQvdGVzdC1mcmVlLWNoZWNrb3V0IjtzOjU6InJvdXRlIjtzOjEzOiJjaGVja291dC5zaG93Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1778058187),
('4oWMxPBjx2Lax1kYPzMJoTxz0CQ4nbrPwZ7oJDWj', 4, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiU2ZWdlRJR3c2ck5sRVgwY3gzUWtTTWJDRXBkNUFpUlFUZkxoSWs2TyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMSI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6NDt9', 1778060288),
('5XLNhZpxOPdE82maxnvPG5ceTNFCh0Fe7FJVqRCx', 3, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiTU5QbHdtUWZOeXhwY1JwZVVIMWhMbm8yY0Rpd1pUYmw4czRlN2dnZyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMS9hZG1pbi9hZmZpbGlhdGUvcmVmZXJyYWxzIjtzOjU6InJvdXRlIjtzOjI1OiJhZG1pbi5hZmZpbGlhdGUucmVmZXJyYWxzIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6Mzt9', 1777988941),
('GYVaZCEgJYFwhnY9WyJgHIuDPHURcljifvaYtQcU', NULL, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.118.1 Chrome/142.0.7444.265 Electron/39.8.8 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSDRWRkZ4R0FXMlZRbWI5QUE3UU5BcEZYQUFMenRha0NFa0JnY0MwSSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMSI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1778053359),
('L99gSYocbSasjlwJGH75nryh9Sp6gNSmB20KEDwL', 5, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiY2ZQM01BMlFERU1ZNVdrdmVxcHhsc0l5TWRxYUZQTVd0ZmNSdklrVCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMSI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6NTt9', 1778049604),
('oS2OtQfMSEbytarAI6wFfY8AT0HpC7TmmFT4ipgL', NULL, '127.0.0.1', 'curl/8.13.0', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoiblZqeDVPRWI3UDVxSDA0eFdOZ3RudDY4Ym9nRTg1T2x5dURNbTBvNSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1778058209),
('PDtkrMhJlYPBDLMrJN3UyMdtAvx4RSQvonh6kCzn', 3, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiMFhnWmNZcFN2VW0yNzBodjF1MWdlN0ZCTDhNdXBmQlRjUFBPU0t5YyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMS9hZG1pbi9hZmZpbGlhdGUvcmVmZXJyYWxzIjtzOjU6InJvdXRlIjtzOjI1OiJhZG1pbi5hZmZpbGlhdGUucmVmZXJyYWxzIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6Mzt9', 1778051842),
('Q9dAEtVUgDvQZZJwjp4r1mRItTb1laCyNgEZnSqo', NULL, '127.0.0.1', 'curl/8.13.0', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoiekhkQlNPNFV2VDIyZmtOdXJKbjVES1BDeXBVaE5ya2NEOEIwMjdJWSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1778049083),
('Sg2VugWf0Yk0JfOsAzYHA7OnbtErUdJanSo7Fk43', NULL, '127.0.0.1', 'curl/8.13.0', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoiWHlpb3g3VEVDQ3RPUG1IMVFKd25PTkl4Q2Q4aVV2VG9ZSGNaYUhSeCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1778058245),
('wVIIRhkhcGFjirDaaZOiTqQ7FsVmLrAoAI83olE1', 4, '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiNHZBdlF4bEtQNnBHVGpWR2t3d2wyM3hZRGhyVnhOT0hMY0hmcnNoVCI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjI6e3M6MzoidXJsIjtzOjI5OiJodHRwOi8vMTI3LjAuMC4xOjgwMDEvcHJvZmlsZSI7czo1OiJyb3V0ZSI7czo3OiJwcm9maWxlIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6NDtzOjY6ImxvY2FsZSI7czoyOiJlcyI7fQ==', 1777988921),
('ZsGOJnZhaGIRaQSrhLObmvT96SY8bDRHhGE6neD1', NULL, '127.0.0.1', 'curl/8.13.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSUphVmhoYnlpQVBQME1EZTB2ZmxxRjJQSExxT0licGxRUDFUU09FViI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMSI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1778052897);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(255) NOT NULL,
  `value` text DEFAULT NULL,
  `type` varchar(255) NOT NULL DEFAULT 'text',
  `group` varchar(255) NOT NULL DEFAULT 'general',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `key`, `value`, `type`, `group`, `created_at`, `updated_at`) VALUES
(1, 'nowpayments_api_key', '', 'text', 'general', '2026-05-03 13:29:58', '2026-05-04 14:34:49'),
(2, 'nowpayments_ipn_secret', '', 'text', 'general', '2026-05-03 13:29:58', '2026-05-04 14:34:49'),
(3, 'nowpayments_enabled', '0', 'text', 'general', '2026-05-03 13:29:58', '2026-05-04 14:51:19'),
(4, 'nowpayments_sandbox', '1', 'text', 'general', '2026-05-03 13:29:58', '2026-05-04 14:50:44'),
(5, 'nowpayments_default_currency', 'usdttrc20', 'text', 'nowpayments', '2026-05-03 13:29:58', '2026-05-03 13:29:58'),
(6, 'affiliate_enabled', '1', 'boolean', 'affiliate', '2026-05-03 13:29:58', '2026-05-03 13:29:58'),
(7, 'affiliate_commission_rate', '20', 'number', 'affiliate', '2026-05-03 13:29:58', '2026-05-03 13:29:58'),
(8, 'affiliate_minimum_payout', '50', 'number', 'affiliate', '2026-05-03 13:29:58', '2026-05-03 13:29:58'),
(9, 'affiliate_cookie_duration', '30', 'number', 'affiliate', '2026-05-03 13:29:58', '2026-05-03 13:29:58'),
(10, 'announcement_enabled', '0', 'text', 'general', '2026-05-03 13:29:58', '2026-05-05 08:33:04'),
(11, 'announcement_text', 'Get <strong>50% OFF</strong> on annual plans — Use code: <code>LIVE50</code>', 'text', 'general', '2026-05-03 13:29:58', '2026-05-03 13:29:58'),
(12, 'announcement_link', '/packages', 'text', 'general', '2026-05-03 13:29:58', '2026-05-03 13:29:58'),
(13, 'announcement_link_text', 'Shop Now', 'text', 'general', '2026-05-03 13:29:58', '2026-05-03 13:29:58'),
(14, 'site_name', 'Best Live IPTV', 'text', 'site', '2026-05-04 08:52:36', '2026-05-04 08:52:36'),
(15, 'site_tagline', 'Premium IPTV Service', 'text', 'site', '2026-05-04 08:52:36', '2026-05-04 08:52:36'),
(16, 'stripe_mode', 'test', 'text', 'stripe', '2026-05-04 08:52:36', '2026-05-04 08:52:36'),
(17, 'stripe_publishable_key', '', 'text', 'stripe', '2026-05-04 08:52:36', '2026-05-04 15:38:49'),
(18, 'stripe_secret_key', '', 'text', 'stripe', '2026-05-04 08:52:36', '2026-05-04 15:38:49'),
(19, 'stripe_webhook_secret', '', 'text', 'stripe', '2026-05-04 08:52:36', '2026-05-04 15:38:49'),
(20, 'admin_notification_email', 'admin@bestliveiptv.com', 'text', 'email', '2026-05-04 08:52:36', '2026-05-04 08:52:36'),
(21, 'mail_from_name', 'Best Live IPTV', 'text', 'email', '2026-05-04 08:52:36', '2026-05-04 08:52:36'),
(22, 'stripe_enabled', '1', 'text', 'general', '2026-05-04 14:04:40', '2026-05-04 14:11:58'),
(23, 'nowpayments_email', '', 'text', 'general', '2026-05-04 14:34:49', '2026-05-04 14:34:49'),
(24, 'nowpayments_password', '', 'text', 'general', '2026-05-04 14:34:49', '2026-05-04 14:34:49');

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

CREATE TABLE `testimonials` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `location` varchar(255) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `content` text NOT NULL,
  `rating` int(11) NOT NULL DEFAULT 5,
  `is_featured` tinyint(1) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `google2fa_secret` text DEFAULT NULL,
  `google2fa_enabled` tinyint(1) NOT NULL DEFAULT 0,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0,
  `remember_token` varchar(100) DEFAULT NULL,
  `last_login_at` timestamp NULL DEFAULT NULL,
  `admin_seen_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `referred_by` bigint(20) UNSIGNED DEFAULT NULL,
  `referral_code` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `country`, `email_verified_at`, `password`, `google2fa_secret`, `google2fa_enabled`, `is_admin`, `remember_token`, `last_login_at`, `admin_seen_at`, `created_at`, `updated_at`, `referred_by`, `referral_code`) VALUES
(3, 'Admin', 'admin@bestliveiptv.com', NULL, NULL, NULL, '$2y$12$4gbBlad4ZcSfbZJhn5vQAOr8w2ikqHpd4uH2aLNfrjq5D0gSANO/K', 'eyJpdiI6ImJ1MkpTYUY3akxHeHI5OWZQRGFTRGc9PSIsInZhbHVlIjoiVnFXd3g0aWVMa1JqSktsL2pWWWV6a2dHY3BzSU01WVFSM2d6c08zUWs5cz0iLCJtYWMiOiI2NDIwOTIxMDg2YjVhOTdlN2IzNDZkMTJkYWU3M2NmODE4NGQzODg3NWUyOGVhM2JjMzdiYjQ3ZWYyOTEyYTYwIiwidGFnIjoiIn0=', 0, 1, NULL, '2026-05-06 01:41:25', NULL, '2026-05-04 08:52:36', '2026-05-06 01:41:25', NULL, NULL),
(4, '221400086@gift.edu.pk', '221400086@gift.edu.pk', NULL, NULL, NULL, '$2y$12$aUEXG9wrxOCuBJVllAdaHOvriovls1bARAjvMwgDZbqjcfy/oNNoG', NULL, 0, 0, NULL, '2026-05-06 01:40:26', '2026-05-05 01:29:52', '2026-05-05 01:20:12', '2026-05-06 01:40:26', NULL, NULL),
(5, 'hassan', 'hassanarifallah9@gmail.com', NULL, NULL, NULL, '$2y$12$slAV5rpGI/Naa0x4cn8EB.sA3fEmwuuVqaO/4zg0VVm0WonvZrpe.', NULL, 0, 0, NULL, '2026-05-06 01:40:04', '2026-05-05 01:29:52', '2026-05-05 01:21:14', '2026-05-06 01:40:04', 4, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `affiliates`
--
ALTER TABLE `affiliates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `affiliates_referral_code_unique` (`referral_code`),
  ADD KEY `affiliates_user_id_foreign` (`user_id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `channels`
--
ALTER TABLE `channels`
  ADD PRIMARY KEY (`id`),
  ADD KEY `channels_category_id_foreign` (`category_id`);

--
-- Indexes for table `channel_categories`
--
ALTER TABLE `channel_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `channel_categories_slug_unique` (`slug`);

--
-- Indexes for table `commissions`
--
ALTER TABLE `commissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `commissions_affiliate_id_foreign` (`affiliate_id`),
  ADD KEY `commissions_order_id_foreign` (`order_id`),
  ADD KEY `commissions_referral_id_foreign` (`referral_id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `countries_code_unique` (`code`);

--
-- Indexes for table `country_order`
--
ALTER TABLE `country_order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `country_order_order_id_foreign` (`order_id`),
  ADD KEY `country_order_country_id_foreign` (`country_id`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `coupons_code_unique` (`code`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `features`
--
ALTER TABLE `features`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feature_package`
--
ALTER TABLE `feature_package`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `feature_package_package_id_feature_id_unique` (`package_id`,`feature_id`),
  ADD KEY `feature_package_feature_id_foreign` (`feature_id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `orders_order_number_unique` (`order_number`),
  ADD KEY `orders_user_id_foreign` (`user_id`),
  ADD KEY `orders_package_id_foreign` (`package_id`);

--
-- Indexes for table `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `packages_slug_unique` (`slug`);

--
-- Indexes for table `package_feature`
--
ALTER TABLE `package_feature`
  ADD PRIMARY KEY (`id`),
  ADD KEY `package_feature_package_id_foreign` (`package_id`),
  ADD KEY `package_feature_feature_id_foreign` (`feature_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `payouts`
--
ALTER TABLE `payouts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payouts_affiliate_id_foreign` (`affiliate_id`);

--
-- Indexes for table `referrals`
--
ALTER TABLE `referrals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `referrals_affiliate_id_foreign` (`affiliate_id`),
  ADD KEY `referrals_referred_user_id_foreign` (`referred_user_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `settings_key_unique` (`key`);

--
-- Indexes for table `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_referral_code_unique` (`referral_code`),
  ADD KEY `users_referred_by_foreign` (`referred_by`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `affiliates`
--
ALTER TABLE `affiliates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `channels`
--
ALTER TABLE `channels`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `channel_categories`
--
ALTER TABLE `channel_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `commissions`
--
ALTER TABLE `commissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `country_order`
--
ALTER TABLE `country_order`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `faqs`
--
ALTER TABLE `faqs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `features`
--
ALTER TABLE `features`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `feature_package`
--
ALTER TABLE `feature_package`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `packages`
--
ALTER TABLE `packages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `package_feature`
--
ALTER TABLE `package_feature`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payouts`
--
ALTER TABLE `payouts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `referrals`
--
ALTER TABLE `referrals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `affiliates`
--
ALTER TABLE `affiliates`
  ADD CONSTRAINT `affiliates_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `channels`
--
ALTER TABLE `channels`
  ADD CONSTRAINT `channels_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `channel_categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `commissions`
--
ALTER TABLE `commissions`
  ADD CONSTRAINT `commissions_affiliate_id_foreign` FOREIGN KEY (`affiliate_id`) REFERENCES `affiliates` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `commissions_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `commissions_referral_id_foreign` FOREIGN KEY (`referral_id`) REFERENCES `referrals` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `country_order`
--
ALTER TABLE `country_order`
  ADD CONSTRAINT `country_order_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `country_order_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `feature_package`
--
ALTER TABLE `feature_package`
  ADD CONSTRAINT `feature_package_feature_id_foreign` FOREIGN KEY (`feature_id`) REFERENCES `features` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `feature_package_package_id_foreign` FOREIGN KEY (`package_id`) REFERENCES `packages` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_package_id_foreign` FOREIGN KEY (`package_id`) REFERENCES `packages` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `package_feature`
--
ALTER TABLE `package_feature`
  ADD CONSTRAINT `package_feature_feature_id_foreign` FOREIGN KEY (`feature_id`) REFERENCES `features` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `package_feature_package_id_foreign` FOREIGN KEY (`package_id`) REFERENCES `packages` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `payouts`
--
ALTER TABLE `payouts`
  ADD CONSTRAINT `payouts_affiliate_id_foreign` FOREIGN KEY (`affiliate_id`) REFERENCES `affiliates` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `referrals`
--
ALTER TABLE `referrals`
  ADD CONSTRAINT `referrals_affiliate_id_foreign` FOREIGN KEY (`affiliate_id`) REFERENCES `affiliates` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `referrals_referred_user_id_foreign` FOREIGN KEY (`referred_user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_referred_by_foreign` FOREIGN KEY (`referred_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
