-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 05, 2025 at 12:30 AM
-- Server version: 8.0.30
-- PHP Version: 8.3.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `siadmin_deeniyat`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000001_create_cache_table', 1),
(2, '0001_01_01_000002_create_jobs_table', 1),
(3, '2025_06_13_030250_create_sessions_table', 1),
(4, '2025_08_30_175159_create_tb_class_table', 1),
(5, '2025_08_30_175159_create_tb_installment_table', 1),
(6, '2025_08_30_175159_create_tb_payments_table', 1),
(7, '2025_08_30_175159_create_tb_role_table', 1),
(12, '2025_09_19_002638_add_due_date_to_tb_installment', 2),
(13, '2025_09_24_140104_add_installment_id_to_tb_payments', 10),
(15, '2025_09_24_163100_add_user_id_to_tb_installment_table', 11),
(18, '2025_09_27_230709_create_tb_installment_table', 12),
(19, '2025_09_27_230710_create_tb_payments_table', 13),
(20, '2025_08_30_175159_create_users_table', 13),
(21, '2025_09_27_234013_add_due_date_to_tb_payments_table', 14),
(22, '2025_09_29_025237_add_installment_to_and_description_to_tb_payments_table', 15),
(23, '2025_10_16_005233_add_email_sent_to_tb_payments_table', 16),
(24, '2025_10_16_071409_add_plain_password_to_users_table', 17);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_class`
--

CREATE TABLE `tb_class` (
  `id` int UNSIGNED NOT NULL,
  `class_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` int UNSIGNED DEFAULT '0',
  `teacher_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `academic_year_first` year NOT NULL,
  `academic_year_last` year NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_class`
--

INSERT INTO `tb_class` (`id`, `class_name`, `amount`, `teacher_name`, `academic_year_first`, `academic_year_last`, `created_at`, `updated_at`) VALUES
(9, 'Kelas 0A', 15, 'Umi Hisyam', '2025', '2026', '2025-09-07 23:23:34', '2025-09-08 00:15:39'),
(14, 'Kelas 1A', 15, 'Umi Fathin', '2025', '2026', '2025-09-09 21:43:50', '2025-09-09 22:02:19'),
(16, 'Kelas 2A', 15, 'Umi Dewi', '2025', '2026', '2025-09-16 21:03:59', '2025-10-16 10:15:07'),
(17, 'Kelas 3A', 15, 'Umi Hanun', '2025', '2026', '2025-09-16 23:22:21', '2025-09-25 23:24:26'),
(18, 'Kelas 4A', 15, 'Umi Zihni', '2025', '2026', '2025-09-17 07:17:13', '2025-10-06 08:05:49'),
(21, 'Kelas 5A', 15, 'Ibu Eliza', '2025', '2026', '2025-09-26 00:05:34', '2025-10-15 01:43:39'),
(23, 'Kelas 6A', 15, 'Umah Rif\'at', '2025', '2026', '2025-10-07 00:08:01', '2025-10-15 01:43:58');

-- --------------------------------------------------------

--
-- Table structure for table `tb_installment`
--

CREATE TABLE `tb_installment` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `nominal` int NOT NULL,
  `remaining_balance` int DEFAULT NULL,
  `due_date` date DEFAULT NULL,
  `status` enum('pending','partial','paid') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `paid_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_installment`
--

INSERT INTO `tb_installment` (`id`, `user_id`, `nominal`, `remaining_balance`, `due_date`, `status`, `paid_at`, `created_at`, `updated_at`) VALUES
(26, 133, 450000, 300000, '2025-11-07', 'partial', NULL, '2025-10-07 05:21:53', '2025-10-07 05:22:16'),
(30, 142, 450000, 450000, '2025-11-12', 'pending', NULL, '2025-10-12 08:41:13', '2025-10-12 08:41:13'),
(33, 146, 450000, 300000, '2025-12-13', 'partial', NULL, '2025-10-13 06:56:38', '2025-10-13 06:57:20'),
(45, 159, 450000, 300000, '2025-12-15', 'partial', NULL, '2025-10-15 16:43:33', '2025-10-15 16:53:52'),
(46, 161, 450000, 300000, '2025-12-15', 'partial', NULL, '2025-10-15 16:49:29', '2025-10-15 16:49:44'),
(47, 162, 450000, 0, '2025-12-15', 'paid', NULL, '2025-10-15 16:56:11', '2025-10-15 16:56:11'),
(48, 163, 450000, 300000, '2025-12-15', 'partial', NULL, '2025-10-15 16:58:50', '2025-10-15 16:59:51'),
(49, 165, 450000, 450000, '2025-12-16', 'pending', NULL, '2025-10-15 17:09:31', '2025-10-15 17:09:31'),
(50, 167, 450000, 300000, '2025-12-16', 'partial', NULL, '2025-10-15 17:16:01', '2025-10-15 17:16:17'),
(51, 168, 450000, 0, '2025-12-16', 'paid', NULL, '2025-10-15 17:24:02', '2025-10-15 17:24:02'),
(52, 169, 450000, 300000, '2025-12-16', 'partial', NULL, '2025-10-15 17:26:06', '2025-10-15 17:26:21'),
(58, 190, 450000, 150000, '2025-12-16', 'partial', NULL, '2025-10-16 07:44:33', '2025-10-16 07:53:22'),
(59, 191, 450000, 0, '2025-12-16', 'paid', NULL, '2025-10-16 08:17:14', '2025-10-16 08:17:14'),
(60, 192, 450000, 300000, '2025-12-16', 'partial', NULL, '2025-10-16 08:18:56', '2025-10-16 08:19:34'),
(61, 196, 450000, 0, '2025-12-16', 'paid', NULL, '2025-10-16 10:05:37', '2025-10-16 10:05:37'),
(62, 197, 450000, 300000, '2025-12-16', 'partial', NULL, '2025-10-16 10:07:25', '2025-10-16 10:15:21'),
(63, 199, 450000, 0, '2025-12-16', 'paid', '2025-10-16 10:29:35', '2025-10-16 10:24:23', '2025-10-16 10:29:35'),
(64, 200, 450000, 150000, '2025-12-17', 'partial', NULL, '2025-10-16 18:06:57', '2025-10-20 09:02:35'),
(65, 202, 450000, 150000, '2025-12-17', 'partial', NULL, '2025-10-16 19:08:59', '2025-10-16 19:13:13');

-- --------------------------------------------------------

--
-- Table structure for table `tb_payments`
--

CREATE TABLE `tb_payments` (
  `id` bigint UNSIGNED NOT NULL,
  `installment_id` bigint UNSIGNED DEFAULT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `class_id` int UNSIGNED DEFAULT NULL,
  `payment_for` enum('register','spp') COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_category` enum('lunas','cicilan') COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_type` enum('tunai','non-tunai') COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` decimal(12,2) DEFAULT NULL,
  `installment_to` int UNSIGNED DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `due_date` date DEFAULT NULL,
  `method` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `month` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `year` varchar(4) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('pending','paid','failed','overdue') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `email_sent` tinyint(1) NOT NULL DEFAULT '0',
  `paid_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_payments`
--

INSERT INTO `tb_payments` (`id`, `installment_id`, `user_id`, `class_id`, `payment_for`, `payment_category`, `payment_type`, `code`, `amount`, `installment_to`, `description`, `due_date`, `method`, `month`, `year`, `status`, `email_sent`, `paid_at`, `created_at`, `updated_at`) VALUES
(132, 26, 133, NULL, 'register', 'cicilan', 'non-tunai', 'REG-INST1-68E505E1C17C9', 150000.00, 1, 'Pembayaran registrasi cicilan ke-1', '2025-10-07', 'midtrans', NULL, NULL, 'paid', 0, '2025-10-07 05:22:16', '2025-10-07 05:21:53', '2025-10-07 05:22:16'),
(133, 26, 133, NULL, 'register', 'cicilan', 'non-tunai', 'REG-INST2-68E505E1C2983', 150000.00, 2, 'Pembayaran registrasi cicilan ke-2', '2025-11-07', 'midtrans', NULL, NULL, 'pending', 0, NULL, '2025-10-07 05:21:53', '2025-10-07 05:21:53'),
(134, 26, 133, NULL, 'register', 'cicilan', 'non-tunai', 'REG-INST3-68E505E1C3DAE', 150000.00, 3, 'Pembayaran registrasi cicilan ke-3', '2025-12-07', 'midtrans', NULL, NULL, 'pending', 0, NULL, '2025-10-07 05:21:53', '2025-10-07 05:21:53'),
(135, NULL, 134, NULL, 'register', 'lunas', 'tunai', 'REG-68EBB6DAA0CAE', 450000.00, NULL, 'Pembayaran registrasi (lunas)', '2025-10-15', 'tunai', NULL, NULL, 'pending', 0, NULL, '2025-10-12 07:10:34', '2025-10-12 07:10:34'),
(136, NULL, 135, NULL, 'register', 'lunas', 'tunai', 'REG-68EBB9B596CCD', 450000.00, NULL, 'Pembayaran registrasi (lunas)', '2025-10-15', 'tunai', NULL, NULL, 'pending', 0, NULL, '2025-10-12 07:22:45', '2025-10-12 07:22:45'),
(137, NULL, 136, NULL, 'register', 'lunas', 'tunai', 'REG-68EBBC28090FD', 450000.00, NULL, 'Pembayaran registrasi (lunas)', '2025-10-15', 'tunai', NULL, NULL, 'pending', 0, NULL, '2025-10-12 07:33:12', '2025-10-12 07:33:12'),
(138, NULL, 137, NULL, 'register', 'lunas', 'tunai', 'REG-68EBBDF3B2742', 450000.00, NULL, 'Pembayaran registrasi (lunas)', '2025-10-15', 'tunai', NULL, NULL, 'pending', 0, NULL, '2025-10-12 07:40:51', '2025-10-12 07:40:51'),
(148, NULL, 141, NULL, 'register', 'lunas', 'non-tunai', 'REG-68EBCB5DE580E', 450000.00, NULL, 'Pembayaran pendaftaran (lunas)', '2025-10-15', 'midtrans', NULL, NULL, 'pending', 0, NULL, '2025-10-12 08:38:05', '2025-10-12 08:38:05'),
(149, 30, 142, NULL, 'register', 'cicilan', 'non-tunai', 'REG-INST1-68EBCC19E472D', 150000.00, 1, 'Pembayaran pendaftaran cicilan ke-1', '2025-10-12', 'midtrans', NULL, NULL, 'pending', 0, NULL, '2025-10-12 08:41:13', '2025-10-12 08:41:13'),
(150, 30, 142, NULL, 'register', 'cicilan', 'non-tunai', 'REG-INST2-68EBCC19E5F7E', 150000.00, 2, 'Pembayaran pendaftaran cicilan ke-2', '2025-11-12', 'midtrans', NULL, NULL, 'pending', 0, NULL, '2025-10-12 08:41:13', '2025-10-12 08:41:13'),
(151, 30, 142, NULL, 'register', 'cicilan', 'non-tunai', 'REG-INST3-68EBCC19E7331', 150000.00, 3, 'Pembayaran pendaftaran cicilan ke-3', '2025-12-12', 'midtrans', NULL, NULL, 'pending', 0, NULL, '2025-10-12 08:41:13', '2025-10-12 08:41:13'),
(159, 33, 146, NULL, 'register', 'cicilan', 'non-tunai', 'REG-INST1-68ED05165AD21', 150000.00, 1, 'Pembayaran pendaftaran cicilan ke-1', '2025-10-13', 'midtrans', NULL, NULL, 'paid', 0, '2025-10-13 06:57:20', '2025-10-13 06:56:38', '2025-10-13 06:57:20'),
(160, 33, 146, NULL, 'register', 'cicilan', 'non-tunai', 'REG-INST2-68ED05165CA87', 150000.00, 2, 'Pembayaran pendaftaran cicilan ke-2', '2025-11-13', 'midtrans', NULL, NULL, 'pending', 0, NULL, '2025-10-13 06:56:38', '2025-10-13 06:56:38'),
(161, 33, 146, NULL, 'register', 'cicilan', 'non-tunai', 'REG-INST3-68ED05165D8A0', 150000.00, 3, 'Pembayaran pendaftaran cicilan ke-3', '2025-12-13', 'midtrans', NULL, NULL, 'pending', 0, NULL, '2025-10-13 06:56:38', '2025-10-13 06:56:38'),
(174, NULL, 134, NULL, 'spp', 'lunas', 'non-tunai', 'SPP-July-134-1760514093', 50000.00, NULL, NULL, NULL, NULL, 'July', '2025', 'paid', 0, '2025-10-15 00:41:55', '2025-10-15 00:41:33', '2025-10-15 00:41:55'),
(181, NULL, 158, NULL, 'register', 'lunas', 'tunai', 'REG-68F031139BDD9', 450000.00, NULL, 'Pembayaran pendaftaran (lunas)', '2025-10-18', 'tunai', NULL, NULL, 'paid', 0, '2025-10-15 16:54:02', '2025-10-15 16:41:07', '2025-10-15 16:54:02'),
(182, 45, 159, NULL, 'register', 'cicilan', 'tunai', 'REG-INST1-68F031A5E64B1', 150000.00, 1, 'Pembayaran pendaftaran cicilan ke-1', '2025-10-15', 'tunai', NULL, NULL, 'paid', 0, '2025-10-15 16:53:52', '2025-10-15 16:43:33', '2025-10-15 16:53:52'),
(183, 45, 159, NULL, 'register', 'cicilan', 'tunai', 'REG-INST2-68F031A5E7096', 150000.00, 2, 'Pembayaran pendaftaran cicilan ke-2', '2025-11-15', 'tunai', NULL, NULL, 'pending', 0, NULL, '2025-10-15 16:43:33', '2025-10-15 16:43:33'),
(184, 45, 159, NULL, 'register', 'cicilan', 'tunai', 'REG-INST3-68F031A5E7B42', 150000.00, 3, 'Pembayaran pendaftaran cicilan ke-3', '2025-12-15', 'tunai', NULL, NULL, 'pending', 0, NULL, '2025-10-15 16:43:33', '2025-10-15 16:43:33'),
(185, NULL, 160, NULL, 'register', 'lunas', 'non-tunai', 'REG-68F0326D72AE0', 450000.00, NULL, 'Pembayaran pendaftaran (lunas)', '2025-10-18', 'midtrans', NULL, NULL, 'paid', 0, '2025-10-15 16:47:46', '2025-10-15 16:46:53', '2025-10-15 16:47:46'),
(186, 46, 161, NULL, 'register', 'cicilan', 'non-tunai', 'REG-INST1-68F033099655F', 150000.00, 1, 'Pembayaran pendaftaran cicilan ke-1', '2025-10-15', 'midtrans', NULL, NULL, 'paid', 0, '2025-10-15 16:49:44', '2025-10-15 16:49:29', '2025-10-15 16:49:44'),
(187, 46, 161, NULL, 'register', 'cicilan', 'non-tunai', 'REG-INST2-68F0330997BCF', 150000.00, 2, 'Pembayaran pendaftaran cicilan ke-2', '2025-11-15', 'midtrans', NULL, NULL, 'pending', 0, NULL, '2025-10-15 16:49:29', '2025-10-15 16:49:29'),
(188, 46, 161, NULL, 'register', 'cicilan', 'non-tunai', 'REG-INST3-68F0330998D5D', 150000.00, 3, 'Pembayaran pendaftaran cicilan ke-3', '2025-12-15', 'midtrans', NULL, NULL, 'pending', 0, NULL, '2025-10-15 16:49:29', '2025-10-15 16:49:29'),
(189, 47, 162, 14, 'register', 'lunas', 'tunai', 'REG-ZMCL1R5WGK', 450000.00, NULL, NULL, NULL, NULL, NULL, NULL, 'paid', 0, '2025-10-15 16:56:11', '2025-10-15 16:56:11', '2025-10-15 16:56:11'),
(190, 48, 163, 23, 'register', 'cicilan', 'tunai', 'REG-INST1-68F0353A912A7', 150000.00, 1, 'Pembayaran registrasi cicilan ke-1', '2025-10-15', NULL, NULL, NULL, 'paid', 0, '2025-10-15 16:59:51', '2025-10-15 16:58:50', '2025-10-15 16:59:51'),
(191, 48, 163, 23, 'register', 'cicilan', 'tunai', 'REG-INST2-68F0353A92D3E', 150000.00, 2, 'Pembayaran registrasi cicilan ke-2', '2025-11-15', NULL, NULL, NULL, 'pending', 0, NULL, '2025-10-15 16:58:50', '2025-10-15 16:58:50'),
(192, 48, 163, 23, 'register', 'cicilan', 'tunai', 'REG-INST3-68F0353A93F31', 150000.00, 3, 'Pembayaran registrasi cicilan ke-3', '2025-12-15', NULL, NULL, NULL, 'pending', 0, NULL, '2025-10-15 16:58:50', '2025-10-15 16:58:50'),
(193, NULL, 160, NULL, 'spp', 'lunas', 'non-tunai', 'SPP-July-160-1760573001', 50000.00, NULL, NULL, NULL, NULL, 'July', '2025', 'paid', 0, '2025-10-15 17:03:38', '2025-10-15 17:03:21', '2025-10-15 17:03:38'),
(194, NULL, 164, NULL, 'register', 'lunas', 'tunai', 'REG-68F037437B86D', 450000.00, NULL, 'Pembayaran pendaftaran (lunas)', '2025-10-19', 'tunai', NULL, NULL, 'pending', 0, NULL, '2025-10-15 17:07:31', '2025-10-15 17:07:31'),
(195, 49, 165, NULL, 'register', 'cicilan', 'tunai', 'REG-INST1-68F037BB0A413', 150000.00, 1, 'Pembayaran pendaftaran cicilan ke-1', '2025-10-16', 'tunai', NULL, NULL, 'pending', 0, NULL, '2025-10-15 17:09:31', '2025-10-15 17:09:31'),
(196, 49, 165, NULL, 'register', 'cicilan', 'tunai', 'REG-INST2-68F037BB0B8AD', 150000.00, 2, 'Pembayaran pendaftaran cicilan ke-2', '2025-11-16', 'tunai', NULL, NULL, 'pending', 0, NULL, '2025-10-15 17:09:31', '2025-10-15 17:09:31'),
(197, 49, 165, NULL, 'register', 'cicilan', 'tunai', 'REG-INST3-68F037BB0C72C', 150000.00, 3, 'Pembayaran pendaftaran cicilan ke-3', '2025-12-16', 'tunai', NULL, NULL, 'pending', 0, NULL, '2025-10-15 17:09:31', '2025-10-15 17:09:31'),
(198, NULL, 166, NULL, 'register', 'lunas', 'non-tunai', 'REG-68F038A5A2422', 450000.00, NULL, 'Pembayaran pendaftaran (lunas)', '2025-10-19', 'midtrans', NULL, NULL, 'paid', 0, '2025-10-15 17:13:46', '2025-10-15 17:13:25', '2025-10-15 17:13:46'),
(199, 50, 167, NULL, 'register', 'cicilan', 'non-tunai', 'REG-INST1-68F039411CFF5', 150000.00, 1, 'Pembayaran pendaftaran cicilan ke-1', '2025-10-16', 'midtrans', NULL, NULL, 'paid', 0, '2025-10-15 17:16:17', '2025-10-15 17:16:01', '2025-10-15 17:16:17'),
(200, 50, 167, NULL, 'register', 'cicilan', 'non-tunai', 'REG-INST2-68F039411E2E8', 150000.00, 2, 'Pembayaran pendaftaran cicilan ke-2', '2025-11-16', 'midtrans', NULL, NULL, 'pending', 0, NULL, '2025-10-15 17:16:01', '2025-10-15 17:16:01'),
(201, 50, 167, NULL, 'register', 'cicilan', 'non-tunai', 'REG-INST3-68F039411F2E8', 150000.00, 3, 'Pembayaran pendaftaran cicilan ke-3', '2025-12-16', 'midtrans', NULL, NULL, 'pending', 0, NULL, '2025-10-15 17:16:01', '2025-10-15 17:16:01'),
(202, 51, 168, 9, 'register', 'lunas', 'tunai', 'REG-FUXQGNZRAO', 450000.00, NULL, NULL, NULL, NULL, NULL, NULL, 'paid', 0, '2025-10-15 17:24:02', '2025-10-15 17:24:02', '2025-10-15 17:24:02'),
(203, 52, 169, 9, 'register', 'cicilan', 'tunai', 'REG-INST1-68F03B9E1B8A1', 150000.00, 1, 'Pembayaran registrasi cicilan ke-1', '2025-10-16', NULL, NULL, NULL, 'paid', 0, '2025-10-15 17:26:21', '2025-10-15 17:26:06', '2025-10-15 17:26:21'),
(204, 52, 169, 9, 'register', 'cicilan', 'tunai', 'REG-INST2-68F03B9E1CD06', 150000.00, 2, 'Pembayaran registrasi cicilan ke-2', '2025-11-16', NULL, NULL, NULL, 'pending', 0, NULL, '2025-10-15 17:26:06', '2025-10-15 17:26:06'),
(205, 52, 169, 9, 'register', 'cicilan', 'tunai', 'REG-INST3-68F03B9E1DEBC', 150000.00, 3, 'Pembayaran registrasi cicilan ke-3', '2025-12-16', NULL, NULL, NULL, 'pending', 0, NULL, '2025-10-15 17:26:06', '2025-10-15 17:26:06'),
(230, NULL, 187, NULL, 'register', 'lunas', 'tunai', 'REG-68F0B89443E7A', 450000.00, NULL, 'Pembayaran pendaftaran (lunas)', '2025-10-19', 'tunai', NULL, NULL, 'paid', 0, '2025-10-16 02:19:31', '2025-10-16 02:19:16', '2025-10-16 02:19:31'),
(231, NULL, 187, NULL, 'spp', 'lunas', 'non-tunai', 'SPP-July-187-1760606502', 50000.00, NULL, NULL, NULL, NULL, 'July', '2025', 'paid', 0, '2025-10-16 02:22:06', '2025-10-16 02:21:42', '2025-10-16 02:22:06'),
(236, 58, 190, NULL, 'register', 'cicilan', 'non-tunai', 'REG-INST1-68F104D17B9D8', 150000.00, 1, 'Pembayaran pendaftaran cicilan ke-1', '2025-10-16', 'midtrans', NULL, NULL, 'paid', 0, '2025-10-16 07:45:34', '2025-10-16 07:44:33', '2025-10-16 07:45:34'),
(237, 58, 190, NULL, 'register', 'cicilan', 'non-tunai', 'REG-INST2-68F104D17CBEC', 150000.00, 2, 'Pembayaran pendaftaran cicilan ke-2', '2025-11-16', 'midtrans', NULL, NULL, 'paid', 0, '2025-10-16 07:53:22', '2025-10-16 07:44:33', '2025-10-16 07:53:22'),
(238, 58, 190, NULL, 'register', 'cicilan', 'non-tunai', 'REG-INST3-68F104D17D89F', 150000.00, 3, 'Pembayaran pendaftaran cicilan ke-3', '2025-12-16', 'midtrans', NULL, NULL, 'pending', 0, NULL, '2025-10-16 07:44:33', '2025-10-16 07:44:33'),
(239, NULL, 190, NULL, 'spp', 'lunas', 'non-tunai', 'SPP-October-190-1760626324', 50000.00, NULL, NULL, NULL, NULL, 'October', '2025', 'paid', 0, '2025-10-16 07:52:21', '2025-10-16 07:52:04', '2025-10-16 07:52:21'),
(240, NULL, 146, 17, 'spp', 'lunas', 'non-tunai', 'SPP-68F10758A1686', 50000.00, NULL, NULL, NULL, 'qris', 'Oktober', '2024', 'paid', 0, '2025-10-16 10:30:05', '2025-10-16 07:55:20', '2025-10-16 10:30:05'),
(243, NULL, 190, 17, 'spp', 'lunas', 'non-tunai', 'SPP-68F1077445CE9', 50000.00, NULL, NULL, NULL, 'qris', 'Oktober', '2024', 'paid', 0, '2025-10-16 10:29:56', '2025-10-16 07:55:48', '2025-10-16 10:29:56'),
(244, 59, 191, 17, 'register', 'lunas', 'tunai', 'REG-GSDNFZ5KUL', 450000.00, NULL, NULL, NULL, NULL, NULL, NULL, 'paid', 0, '2025-10-16 08:17:14', '2025-10-16 08:17:14', '2025-10-16 08:17:14'),
(245, 60, 192, 16, 'register', 'cicilan', 'tunai', 'REG-INST1-68F10CE08029B', 150000.00, 1, 'Pembayaran registrasi cicilan ke-1', '2025-10-16', NULL, NULL, NULL, 'paid', 0, '2025-10-16 08:19:34', '2025-10-16 08:18:56', '2025-10-16 08:19:34'),
(246, 60, 192, 16, 'register', 'cicilan', 'tunai', 'REG-INST2-68F10CE081AAF', 150000.00, 2, 'Pembayaran registrasi cicilan ke-2', '2025-11-16', NULL, NULL, NULL, 'pending', 0, NULL, '2025-10-16 08:18:56', '2025-10-16 08:18:56'),
(247, 60, 192, 16, 'register', 'cicilan', 'tunai', 'REG-INST3-68F10CE082A66', 150000.00, 3, 'Pembayaran registrasi cicilan ke-3', '2025-12-16', NULL, NULL, NULL, 'pending', 0, NULL, '2025-10-16 08:18:56', '2025-10-16 08:18:56'),
(249, NULL, 194, NULL, 'register', 'lunas', 'tunai', 'REG-68F1112D595E4', 450000.00, NULL, 'Pembayaran pendaftaran (lunas)', '2025-10-19', 'tunai', NULL, NULL, 'paid', 0, '2025-10-16 08:38:09', '2025-10-16 08:37:17', '2025-10-16 08:38:09'),
(250, NULL, 195, NULL, 'register', 'lunas', 'tunai', 'REG-68F1128C6581A', 450000.00, NULL, 'Pembayaran pendaftaran (lunas)', '2025-10-19', 'tunai', NULL, NULL, 'paid', 0, '2025-10-16 08:43:25', '2025-10-16 08:43:08', '2025-10-16 08:43:25'),
(251, 61, 196, 23, 'register', 'lunas', 'tunai', 'REG-6LPXBOMD83', 450000.00, NULL, NULL, NULL, NULL, NULL, NULL, 'paid', 0, '2025-10-16 10:05:37', '2025-10-16 10:05:37', '2025-10-16 10:05:37'),
(252, 62, 197, 16, 'register', 'cicilan', 'tunai', 'REG-INST1-68F1264DAAC8B', 150000.00, 1, 'Pembayaran registrasi cicilan ke-1', '2025-10-16', NULL, NULL, NULL, 'paid', 0, '2025-10-16 10:15:21', '2025-10-16 10:07:25', '2025-10-16 10:15:21'),
(253, 62, 197, 16, 'register', 'cicilan', 'tunai', 'REG-INST2-68F1264DACB7F', 150000.00, 2, 'Pembayaran registrasi cicilan ke-2', '2025-11-16', NULL, NULL, NULL, 'pending', 0, NULL, '2025-10-16 10:07:25', '2025-10-16 10:07:25'),
(254, 62, 197, 16, 'register', 'cicilan', 'tunai', 'REG-INST3-68F1264DADB3D', 150000.00, 3, 'Pembayaran registrasi cicilan ke-3', '2025-12-16', NULL, NULL, NULL, 'pending', 0, NULL, '2025-10-16 10:07:25', '2025-10-16 10:07:25'),
(257, 63, 199, NULL, 'register', 'cicilan', 'non-tunai', 'REG-INST1-68F12A477D6CE', 150000.00, 1, 'Pembayaran pendaftaran cicilan ke-1', '2025-10-16', 'midtrans', NULL, NULL, 'paid', 0, '2025-10-16 10:24:38', '2025-10-16 10:24:23', '2025-10-16 10:24:38'),
(258, 63, 199, NULL, 'register', 'cicilan', 'non-tunai', 'REG-INST2-68F12A477E59C', 150000.00, 2, 'Pembayaran pendaftaran cicilan ke-2', '2025-11-16', 'midtrans', NULL, NULL, 'paid', 0, '2025-10-16 10:27:46', '2025-10-16 10:24:23', '2025-10-16 10:27:46'),
(259, 63, 199, NULL, 'register', 'cicilan', 'non-tunai', 'REG-INST3-68F12A477EF93', 150000.00, 3, 'Pembayaran pendaftaran cicilan ke-3', '2025-12-16', 'midtrans', NULL, NULL, 'paid', 0, '2025-10-16 10:29:35', '2025-10-16 10:24:23', '2025-10-16 10:29:35'),
(260, NULL, 199, NULL, 'spp', 'lunas', 'non-tunai', 'SPP-July-199-1760635554', 50000.00, NULL, NULL, NULL, NULL, 'July', '2025', 'paid', 0, '2025-10-16 10:26:24', '2025-10-16 10:25:54', '2025-10-16 10:26:24'),
(261, NULL, 195, 21, 'spp', 'lunas', 'non-tunai', 'SPP-68F12BFD0A2DE', 50000.00, NULL, NULL, NULL, 'qris', 'Agustus', '2025', 'failed', 0, NULL, '2025-10-16 10:31:41', '2025-10-16 18:12:51'),
(262, NULL, 199, 21, 'spp', 'lunas', 'non-tunai', 'SPP-68F12C01346EF', 50000.00, NULL, NULL, NULL, 'qris', 'Agustus', '2025', 'paid', 0, '2025-10-16 18:12:37', '2025-10-16 10:31:45', '2025-10-16 18:12:37'),
(263, 64, 200, NULL, 'register', 'cicilan', 'non-tunai', 'REG-INST1-68F196B166DC4', 150000.00, 1, 'Pembayaran pendaftaran cicilan ke-1', '2025-10-17', 'midtrans', NULL, NULL, 'paid', 0, '2025-10-16 18:07:16', '2025-10-16 18:06:57', '2025-10-16 18:07:16'),
(264, 64, 200, NULL, 'register', 'cicilan', 'non-tunai', 'REG-INST2-68F196B16777E', 150000.00, 2, 'Pembayaran pendaftaran cicilan ke-2', '2025-11-17', 'midtrans', NULL, NULL, 'paid', 0, '2025-10-20 09:02:35', '2025-10-16 18:06:57', '2025-10-20 09:02:35'),
(265, 64, 200, NULL, 'register', 'cicilan', 'non-tunai', 'REG-INST3-68F196B167D1C', 150000.00, 3, 'Pembayaran pendaftaran cicilan ke-3', '2025-12-17', 'midtrans', NULL, NULL, 'pending', 0, NULL, '2025-10-16 18:06:57', '2025-10-16 18:06:57'),
(266, NULL, 200, NULL, 'spp', 'lunas', 'non-tunai', 'SPP-July-200-1760663400', 50000.00, NULL, NULL, NULL, NULL, 'July', '2025', 'paid', 0, '2025-10-16 18:10:15', '2025-10-16 18:10:00', '2025-10-16 18:10:15'),
(267, NULL, 201, NULL, 'register', 'lunas', 'tunai', 'REG-68F1A3BCEC19C', 450000.00, NULL, 'Pembayaran pendaftaran (lunas)', '2025-10-20', 'tunai', NULL, NULL, 'paid', 0, '2025-10-16 19:03:15', '2025-10-16 19:02:36', '2025-10-16 19:03:15'),
(268, 65, 202, NULL, 'register', 'cicilan', 'non-tunai', 'REG-INST1-68F1A53BC5703', 150000.00, 1, 'Pembayaran pendaftaran cicilan ke-1', '2025-10-17', 'midtrans', NULL, NULL, 'paid', 0, '2025-10-16 19:09:53', '2025-10-16 19:08:59', '2025-10-16 19:09:53'),
(269, 65, 202, NULL, 'register', 'cicilan', 'non-tunai', 'REG-INST2-68F1A53BC6949', 150000.00, 2, 'Pembayaran pendaftaran cicilan ke-2', '2025-11-17', 'midtrans', NULL, NULL, 'pending', 0, NULL, '2025-10-16 19:08:59', '2025-10-16 19:08:59'),
(270, 65, 202, NULL, 'register', 'cicilan', 'non-tunai', 'REG-INST3-68F1A53BC7088', 150000.00, 3, 'Pembayaran pendaftaran cicilan ke-3', '2025-12-17', 'midtrans', NULL, NULL, 'paid', 0, '2025-10-16 19:13:13', '2025-10-16 19:08:59', '2025-10-16 19:13:13'),
(271, NULL, 134, 9, 'spp', 'lunas', 'non-tunai', 'SPP-68F1A66DBF0DA', 50000.00, NULL, NULL, NULL, 'qris', 'Oktober', '2025', 'pending', 0, NULL, '2025-10-16 19:14:05', '2025-10-16 19:14:05'),
(272, NULL, 135, 9, 'spp', 'lunas', 'non-tunai', 'SPP-68F1A67B60C6C', 50000.00, NULL, NULL, NULL, 'qris', 'Oktober', '2025', 'pending', 0, NULL, '2025-10-16 19:14:19', '2025-10-16 19:14:19'),
(273, NULL, 136, 9, 'spp', 'lunas', 'non-tunai', 'SPP-68F1A67D5426C', 50000.00, NULL, NULL, NULL, 'qris', 'Oktober', '2025', 'pending', 0, NULL, '2025-10-16 19:14:21', '2025-10-16 19:14:21'),
(274, NULL, 137, 9, 'spp', 'lunas', 'non-tunai', 'SPP-68F1A67F15010', 50000.00, NULL, NULL, NULL, 'qris', 'Oktober', '2025', 'pending', 0, NULL, '2025-10-16 19:14:23', '2025-10-16 19:14:23'),
(275, NULL, 141, 9, 'spp', 'lunas', 'non-tunai', 'SPP-68F1A680C592F', 50000.00, NULL, NULL, NULL, 'qris', 'Oktober', '2025', 'pending', 0, NULL, '2025-10-16 19:14:24', '2025-10-16 19:14:24'),
(276, NULL, 142, 9, 'spp', 'lunas', 'non-tunai', 'SPP-68F1A6827D891', 50000.00, NULL, NULL, NULL, 'qris', 'Oktober', '2025', 'pending', 0, NULL, '2025-10-16 19:14:26', '2025-10-16 19:14:26'),
(277, NULL, 164, 9, 'spp', 'lunas', 'non-tunai', 'SPP-68F1A684CC4E9', 50000.00, NULL, NULL, NULL, 'qris', 'Oktober', '2025', 'pending', 0, NULL, '2025-10-16 19:14:28', '2025-10-16 19:14:28'),
(278, NULL, 165, 9, 'spp', 'lunas', 'non-tunai', 'SPP-68F1A686A2720', 50000.00, NULL, NULL, NULL, 'qris', 'Oktober', '2025', 'pending', 0, NULL, '2025-10-16 19:14:30', '2025-10-16 19:14:30'),
(279, NULL, 167, 9, 'spp', 'lunas', 'non-tunai', 'SPP-68F1A6885AFCD', 50000.00, NULL, NULL, NULL, 'qris', 'Oktober', '2025', 'pending', 0, NULL, '2025-10-16 19:14:32', '2025-10-16 19:14:32'),
(280, NULL, 168, 9, 'spp', 'lunas', 'non-tunai', 'SPP-68F1A68A2B1A0', 50000.00, NULL, NULL, NULL, 'qris', 'Oktober', '2025', 'pending', 0, NULL, '2025-10-16 19:14:34', '2025-10-16 19:14:34'),
(281, NULL, 169, 9, 'spp', 'lunas', 'non-tunai', 'SPP-68F1A68BECD59', 50000.00, NULL, NULL, NULL, 'qris', 'Oktober', '2025', 'pending', 0, NULL, '2025-10-16 19:14:35', '2025-10-16 19:14:35'),
(282, NULL, 200, 9, 'spp', 'lunas', 'non-tunai', 'SPP-68F1A68DB9F37', 50000.00, NULL, NULL, NULL, 'qris', 'Oktober', '2025', 'failed', 0, NULL, '2025-10-16 19:14:37', '2025-10-26 17:25:45'),
(287, NULL, 202, NULL, 'spp', 'lunas', 'tunai', 'SPP-B7QFZ6F2', 50000.00, NULL, NULL, NULL, NULL, '2025-07-01 00:00:00', NULL, 'paid', 0, '2025-10-26 17:34:59', '2025-10-26 17:25:54', '2025-10-26 17:34:59'),
(288, NULL, 202, NULL, 'spp', 'lunas', 'tunai', 'SPP-202-20251027003540-265', 50000.00, NULL, NULL, NULL, NULL, '2025-09-01 00:00:00', NULL, 'paid', 0, '2025-10-26 17:35:57', '2025-10-26 17:35:40', '2025-10-26 17:35:57'),
(289, NULL, 202, NULL, 'spp', 'lunas', 'tunai', 'SPP-XRUYDX06UC', 50000.00, NULL, NULL, NULL, NULL, '2025-11-01 00:00:00', NULL, 'paid', 0, '2025-10-26 17:43:30', '2025-10-26 17:43:14', '2025-10-26 17:43:30'),
(290, NULL, 159, NULL, 'spp', 'lunas', 'tunai', 'SPP-159-20251027005453-987', 50000.00, NULL, NULL, NULL, NULL, '2025-07-01 00:00:00', NULL, 'paid', 0, '2025-10-26 17:55:09', '2025-10-26 17:54:53', '2025-10-26 17:55:09'),
(291, NULL, 159, NULL, 'spp', 'lunas', 'tunai', 'SPP-159-20251027005740-554', 50000.00, NULL, NULL, NULL, NULL, '2025-08-01 00:00:00', NULL, 'paid', 0, '2025-10-26 17:58:02', '2025-10-26 17:57:40', '2025-10-26 17:58:02'),
(292, NULL, 159, NULL, 'spp', 'lunas', 'tunai', 'SPP-159-20251027010636-193', 50000.00, NULL, NULL, NULL, NULL, '2025-10-01 00:00:00', NULL, 'paid', 0, '2025-10-26 18:06:57', '2025-10-26 18:00:48', '2025-10-26 18:06:57'),
(293, NULL, 199, NULL, 'spp', 'lunas', 'tunai', 'SPP-199-20251027160416-123', 50000.00, NULL, NULL, NULL, NULL, '2025-07-01 00:00:00', NULL, 'paid', 0, '2025-10-27 09:04:40', '2025-10-27 09:04:16', '2025-10-27 09:04:40'),
(294, NULL, 199, NULL, 'spp', 'lunas', 'non-tunai', 'SPP-August-199-1761581796', 50000.00, NULL, NULL, NULL, NULL, 'August', '2025', 'paid', 0, '2025-10-27 09:16:52', '2025-10-27 09:16:36', '2025-10-27 09:16:52'),
(295, NULL, 199, NULL, 'spp', 'lunas', 'non-tunai', 'SPP-November-199-1761584008', 50000.00, NULL, NULL, NULL, NULL, 'November', '2025', 'paid', 0, '2025-10-27 09:53:47', '2025-10-27 09:53:28', '2025-10-27 09:53:47'),
(296, NULL, 199, NULL, 'spp', 'lunas', 'non-tunai', 'SPP-October-199-1761584446', 50000.00, NULL, NULL, NULL, NULL, 'October', '2025', 'paid', 0, '2025-10-27 10:01:03', '2025-10-27 10:00:46', '2025-10-27 10:01:03'),
(297, NULL, 199, NULL, 'spp', 'lunas', 'non-tunai', 'SPP-September-199-1761584876', 50000.00, NULL, NULL, NULL, NULL, 'September', '2025', 'paid', 0, '2025-10-27 10:08:12', '2025-10-27 10:07:56', '2025-10-27 10:08:12'),
(298, NULL, 199, NULL, 'spp', 'lunas', 'non-tunai', 'SPP-Januari-199-1761585570', 50000.00, NULL, NULL, NULL, NULL, 'Desember', '2025', 'paid', 0, '2025-10-27 10:19:44', '2025-10-27 10:19:30', '2025-10-27 10:19:44'),
(299, NULL, 199, NULL, 'spp', 'lunas', 'non-tunai', 'SPP-Januari-199-1761585570', 50000.00, NULL, NULL, NULL, NULL, 'Januari', '2026', 'pending', 0, NULL, '2025-10-27 10:19:30', '2025-10-27 10:19:30'),
(300, NULL, 199, NULL, 'spp', 'lunas', 'non-tunai', 'SPP-December-199-1761585871', 50000.00, NULL, NULL, NULL, NULL, 'December', '2025', 'paid', 0, '2025-10-27 10:24:46', '2025-10-27 10:24:31', '2025-10-27 10:24:46'),
(301, NULL, 199, NULL, 'spp', 'lunas', 'non-tunai', 'SPP-JAN-FEB-199-1761585896', 50000.00, NULL, NULL, NULL, NULL, 'Januari', '2026', 'paid', 0, '2025-10-27 10:25:10', '2025-10-27 10:24:56', '2025-10-27 10:25:10'),
(302, NULL, 199, NULL, 'spp', 'lunas', 'non-tunai', 'SPP-JAN-FEB-199-1761585896', 50000.00, NULL, NULL, NULL, NULL, 'Februari', '2026', 'pending', 0, NULL, '2025-10-27 10:24:56', '2025-10-27 10:24:56'),
(303, NULL, 199, NULL, 'spp', 'lunas', 'non-tunai', 'SPP-FEB-MAR-199-1761586188', 50000.00, NULL, NULL, NULL, NULL, 'Februari', '2026', 'paid', 0, '2025-10-27 10:30:03', '2025-10-27 10:29:48', '2025-10-27 10:30:03'),
(304, NULL, 199, NULL, 'spp', 'lunas', 'non-tunai', 'SPP-FEB-MAR-199-1761586188', 50000.00, NULL, NULL, NULL, NULL, 'Maret', '2026', 'paid', 0, '2025-10-27 10:30:03', '2025-10-27 10:29:48', '2025-10-27 10:30:03'),
(305, NULL, 199, NULL, 'spp', 'lunas', 'non-tunai', 'SPP-APR-MEI-JUN-199-1761586214', 50000.00, NULL, NULL, NULL, NULL, 'April', '2026', 'paid', 0, '2025-10-27 10:30:28', '2025-10-27 10:30:14', '2025-10-27 10:30:28'),
(306, NULL, 199, NULL, 'spp', 'lunas', 'non-tunai', 'SPP-APR-MEI-JUN-199-1761586214', 50000.00, NULL, NULL, NULL, NULL, 'Mei', '2026', 'paid', 0, '2025-10-27 10:30:28', '2025-10-27 10:30:14', '2025-10-27 10:30:28'),
(307, NULL, 199, NULL, 'spp', 'lunas', 'non-tunai', 'SPP-APR-MEI-JUN-199-1761586214', 50000.00, NULL, NULL, NULL, NULL, 'Juni', '2026', 'paid', 0, '2025-10-27 10:30:28', '2025-10-27 10:30:14', '2025-10-27 10:30:28'),
(355, NULL, 204, NULL, 'register', 'lunas', 'tunai', 'REG-690A94DCEB4A8', 450000.00, NULL, 'Pembayaran pendaftaran (lunas)', '2025-11-08', 'tunai', NULL, NULL, 'paid', 0, '2025-11-04 17:06:44', '2025-11-04 17:05:48', '2025-11-04 17:06:44'),
(356, NULL, 204, NULL, 'spp', 'lunas', 'non-tunai', 'SPP-JUL-AGU-SEP-OKT-NOV-204-1762301242', 50000.00, NULL, NULL, NULL, NULL, 'Juli', '2025', 'paid', 0, '2025-11-04 17:07:41', '2025-11-04 17:07:22', '2025-11-04 17:07:41'),
(357, NULL, 204, NULL, 'spp', 'lunas', 'non-tunai', 'SPP-JUL-AGU-SEP-OKT-NOV-204-1762301242', 50000.00, NULL, NULL, NULL, NULL, 'Agustus', '2025', 'paid', 0, '2025-11-04 17:07:41', '2025-11-04 17:07:22', '2025-11-04 17:07:41'),
(358, NULL, 204, NULL, 'spp', 'lunas', 'non-tunai', 'SPP-JUL-AGU-SEP-OKT-NOV-204-1762301242', 50000.00, NULL, NULL, NULL, NULL, 'September', '2025', 'paid', 0, '2025-11-04 17:07:41', '2025-11-04 17:07:22', '2025-11-04 17:07:41'),
(359, NULL, 204, NULL, 'spp', 'lunas', 'non-tunai', 'SPP-JUL-AGU-SEP-OKT-NOV-204-1762301242', 50000.00, NULL, NULL, NULL, NULL, 'Oktober', '2025', 'paid', 0, '2025-11-04 17:07:41', '2025-11-04 17:07:22', '2025-11-04 17:07:41'),
(360, NULL, 204, NULL, 'spp', 'lunas', 'non-tunai', 'SPP-JUL-AGU-SEP-OKT-NOV-204-1762301242', 50000.00, NULL, NULL, NULL, NULL, 'November', '2025', 'paid', 0, '2025-11-04 17:07:41', '2025-11-04 17:07:22', '2025-11-04 17:07:41');

-- --------------------------------------------------------

--
-- Table structure for table `tb_role`
--

CREATE TABLE `tb_role` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_role`
--

INSERT INTO `tb_role` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Admin', NULL, NULL),
(2, 'Student', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED DEFAULT NULL,
  `class_id` bigint UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nis` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `plain_password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birthplace` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `gender` enum('Laki-laki','Perempuan') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `father_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mother_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `father_job` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mother_job` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `academic_year` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `batch` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_paid` tinyint(1) NOT NULL DEFAULT '0',
  `paid_at` datetime DEFAULT NULL,
  `photo` varchar(225) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role_id`, `class_id`, `name`, `nis`, `email`, `email_verified_at`, `password`, `plain_password`, `remember_token`, `birthplace`, `birthdate`, `gender`, `father_name`, `mother_name`, `father_job`, `mother_job`, `address`, `phone`, `academic_year`, `batch`, `is_active`, `is_paid`, `paid_at`, `photo`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, 'Admin Deeniyat', '25261400001', 'admin@gmail.com', NULL, '$2y$12$RqLOjsuvIYkucqJUb0rL4OyDXUOJ013vs0DTIYhJvt93iLY/kr2sO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2526', '14', 1, 0, NULL, NULL, '2025-09-10 23:30:46', '2025-09-10 23:30:46'),
(133, 2, 16, 'rosa roslinda', '25261400028', 'rosaroslinda@gmail.com', NULL, '$2y$12$56aQe9tqEsfn.d.rZFFpyOi4pnDWUf/6XliyO5IGfQdCnsuPpzcga', NULL, NULL, 'Bandung', '2019-02-22', 'Perempuan', 'testtt', 'test', NULL, NULL, 'cibiru', '087654321911', '2526', '14', 1, 0, NULL, NULL, '2025-10-07 05:21:38', '2025-10-07 05:21:38'),
(134, 2, 9, 'Keanu Arifin', '25261400029', 'keanu.arifin@email.com', NULL, '$2y$12$X8ph5Xx4zCTgbDWxfGX0g./3HxUyFYkledMfcifj5LBFeEkpVWnrW', NULL, NULL, 'Bandung', '2021-12-03', 'Laki-laki', 'Budi Arifin', 'Nita Sari', 'Karyawan Swasta', 'IRT', 'Cikuda rt 04 rw 11', '081234567890', '2526', '14', 1, 0, NULL, 'photos/AuUguPtJqJoCLOpQHeqJFpqaUWUmHCyey0bCmasm.png', '2025-10-12 07:09:54', '2025-10-12 07:09:54'),
(135, 2, 9, 'Sabrina Khairunnisa', '25261400030', 'sabrina.k@email.com', NULL, '$2y$12$MMdJducrqgmss8uUoVlQfe8a80Z.5g3c05hmoBkOmgM1iIStpB3M.', NULL, NULL, 'Sumedang', '2020-01-20', 'Perempuan', 'Andi Gunawan', 'Yustin yustini', '-', '-', 'Cikuda rt 04 rw 11', '085711223344', '2526', '14', 1, 0, NULL, 'photos/4DRAMkPJp2N7VBbnMplAliyJlFpsO8GBNh8WhiJj.png', '2025-10-12 07:22:33', '2025-10-12 07:22:33'),
(136, 2, 9, 'Ammar Fathoni', '25261400031', 'ammar.f@email.com', NULL, '$2y$12$Fmzk8.Ua1JSxqG/96y6rNO1BZJbmZ39PU0UfPtEqQMEmlI/V5rK/e', NULL, NULL, 'Bandung', '2021-06-18', 'Laki-laki', 'Taufik Hidayat', 'Husna Kamilah', 'Pedagang', 'irt', 'Cibangkonol', '087899001122', '2526', '14', 1, 0, NULL, 'photos/0oNubn7RcoO9IcjWL3fksJbMwndpCMKCJQuuWSpd.png', '2025-10-12 07:33:06', '2025-10-12 07:33:06'),
(137, 2, 9, 'Roy Julian', '25261400032', 'roy.julian@email.com', NULL, '$2y$12$I8NePa.tpwtDB/jvs9C0NuuhXoVd3AzONEQbIm9vwvtyBC71eHRKC', NULL, NULL, 'Bandung', '2020-09-25', 'Laki-laki', 'Budi Saputra', 'Risa Maharani', 'Pns', '-', 'Jadaria', '082155667788', '2526', '14', 1, 0, NULL, 'photos/MDDB0fgEWbYkaxx6HNYSAEQK2b3JsszIF5jrYwZl.png', '2025-10-12 07:38:40', '2025-10-12 07:38:40'),
(141, 2, 9, 'Muhammad Rais', '25261400036', 'wenty12345@gmail.com', NULL, '$2y$12$v8FyW13OaMLR6mn3tcYkk.HDhTyYoy/RCGCBrtGVg2NkJIvcLe4C2', NULL, NULL, 'Garut', '2021-04-15', 'Laki-laki', 'Muhammad Hamdan', 'Wenty', 'Swasta', '-', 'Cikuda', '089655443322', '2526', '14', 1, 0, NULL, 'photos/ffFAXuoER03W1oqx6OsnBcilEW6z4ZRoELL2FmN0.png', '2025-10-12 08:37:57', '2025-10-12 08:37:57'),
(142, 2, 9, 'Muhamad Gavi Arkana Putra', '25261400037', 'Saputra@gmail.com', NULL, '$2y$12$GpWj9ZPetrMMz9pF387xF.xkWTlXbK1Ms2EkpTjOS8RPEaNqlvU4y', NULL, NULL, 'Bandung', '2020-08-07', 'Laki-laki', 'Ibrahim Aziz', 'Nurlaela', 'Buruh', 'Irt', 'Sukaluyu', '085699887766', '2526', '14', 1, 0, NULL, 'photos/sUlwjngW4tlYBxiqjlPKdnQFGjzSFYRx9jQXR6jR.png', '2025-10-12 08:41:03', '2025-10-12 08:41:03'),
(146, 2, 17, 'Elhasid adyan ghaisan', '25261400041', 'elhasidadyanghaisan@gmail.com', NULL, '$2y$12$ujvkCVpojFVJcGJAnRJg5uZHmzYJpTmWxDNR0wueRX0wTVPnoBPmi', NULL, NULL, 'Bandung', '2017-08-29', 'Laki-laki', 'Asep Sholihin', 'Erna Himawati', 'Konsultan IT', 'Dosen', 'Greenville', '087654321911', '2526', '14', 1, 0, NULL, NULL, '2025-10-13 06:56:04', '2025-10-13 06:56:04'),
(158, 2, 16, 'Almahyra Nur Fadilah', '25261400052', 'almahyra.n.f@gmail.com', NULL, '$2y$12$jHQyl8DxjPWsvtf2dZU5MuOi4MUfiPGcsZ1WaW.H7o/5RWFbyk51G', NULL, NULL, 'Bandung', '2013-10-23', 'Perempuan', 'M Azis F Fauzi', 'Intan Nur Fadilah', 'Guru', 'Guru', 'Jadaria', '087654321911', '2526', '14', 1, 0, NULL, 'photos/UvnUF9m1LwGlFSeJlVzvdqasFNiNBzf5Ktp6zWiu.png', '2025-10-15 16:40:42', '2025-10-15 16:40:42'),
(159, 2, 23, 'Zalfa Nur Arafah', '25261400053', 'zalfa.n.a@gmail.com', NULL, '$2y$12$sQAdScUfsSJZbxT2FPi0M.UEWnTGen56Z6AxhnzCm8rw9KHAAtVG2', NULL, NULL, 'Bandung', '2013-10-14', 'Perempuan', 'Adi Ginanjar Maulana', 'Pipit Nurhotimah', NULL, NULL, 'Komp. Arundaya', '087987987987', '2526', '14', 1, 0, NULL, 'photos/WLi9X8VnDWAXU70T4D78UurGpkRy5aDoBsIUFcnw.png', '2025-10-15 16:43:27', '2025-10-15 16:43:27'),
(160, 2, 14, 'Muhammad Assyauqi Al-Ghazi', '25261400054', 'm.assyauqi.a@gmail.com', NULL, '$2y$12$BUUKZoR1J0FTkRyOe784LehyIcgYgqUcKDv2igX4hS.8ph2cgJgmq', NULL, NULL, 'Bandung', '2018-11-08', 'Laki-laki', 'Deni Romansyah', 'Wiwi Nurwiyah', 'Guru', 'Guru Tk', 'Sukaluyu', '081432267422', '2526', '14', 1, 0, NULL, 'photos/1760634803.png', '2025-10-15 16:46:18', '2025-10-16 10:13:23'),
(161, 2, 14, 'Falisha Azkiya Putri', '25261400055', 'falisha.a.p@gmail.com', NULL, '$2y$12$pw5NrAsUojDyOcstOP66ru9D2rVNCol3HYaX59q1bYbZYUfILGjQi', NULL, NULL, 'Jakarta', '2018-12-26', 'Perempuan', 'Rizal Firmansyah', 'Siti Sofiah', 'Wiraswasta', 'IRT', 'Sukaluyu', '087654321911', '2526', '14', 1, 0, NULL, NULL, '2025-10-15 16:49:23', '2025-10-15 16:49:23'),
(162, 2, 14, 'Muhammad Bilal Alfadani', '25261400056', 'm.bilal.a@gmail.com', NULL, '$2y$12$3.mTEWKaVVG4rqK5O5RCUOWDvZ5KpVGaUM3BXx3n0z8pfwqwQmSYu', NULL, NULL, 'Sukabumi', '2018-08-30', 'Laki-laki', 'Edra putra', 'Yenni Mita septiani', 'Pedagang', 'IRT', 'Cikuda', '089765456321', '2526', '14', 1, 0, NULL, NULL, '2025-10-15 16:56:11', '2025-10-15 16:57:06'),
(163, 2, 23, 'Naura Hasna anida wijaya', '25261400057', 'naura.hasna.a@gmail.com', NULL, '$2y$12$zZJpQ96NuFJ9axpC.y9zRO5qgSmPA3Zzhx.W24zWcx4KwIkbgO5PO', NULL, NULL, 'Bandung', '2013-12-04', 'Perempuan', 'Tata wijaya', 'Ida widianengsih', 'Karyawan Swasta', 'IRT', 'Cikuda', '087654321911', '2526', '14', 1, 0, NULL, 'photos/1760572729.png', '2025-10-15 16:58:50', '2025-10-15 16:58:50'),
(164, 2, 9, 'Barra Shaka Al Zigar', '25261400058', 'barra.shaka@gmail.com', NULL, '$2y$12$pQUK1Y1Vaj6M9JVRLk3zT.VO.NHjG2/QPzcj048nTslyqLhzF4hP.', NULL, NULL, 'Bandung', '2017-12-22', 'Laki-laki', 'Ajat', 'Oom Suryani', NULL, NULL, 'Jadaria', '081213821777', '2526', '14', 1, 0, NULL, NULL, '2025-10-15 17:07:24', '2025-10-15 17:07:24'),
(165, 2, 9, 'Mutiara Kaysa Putri', '25261400059', 'Kaysaputri123@gmail.com', NULL, '$2y$12$hHuyV6pG2e6bPhjkL38uk.NXmOVSbcZ/pO7Xk9oCQp3TBf.i4hBeK', NULL, NULL, 'Bandung', '2013-05-21', 'Perempuan', 'Satim Mohamad Yusuf', 'Evi Krisdiana Aprilia', 'PNS', 'IRT', 'Cibangkonol', '081312550202', '2526', '14', 1, 0, NULL, 'photos/I3UNNjtyPHSLGM91UHea3fUhsufkY5wRovHmDtuU.png', '2025-10-15 17:09:24', '2025-10-15 17:09:24'),
(166, 2, 18, 'Akhtar Naufal Faizi', '25261400060', 'akhtar.n.fauzi@gmail.com', NULL, '$2y$12$KEQtJInJwRPfusen2u2k.uiRKBcLLcnszw.X8sv7iM76SHrQifHu6', NULL, NULL, 'Bandung', '2013-10-08', 'Laki-laki', 'Cece Suhaendar', 'Rizka Agustin', 'Wiraswasta', 'IRT', 'Komp. Manglayang Sari', '081320388815', '2526', '14', 1, 0, NULL, NULL, '2025-10-15 17:13:19', '2025-10-15 17:13:19'),
(167, 2, 9, 'Annisa Shakila Nur Azizah', '25261400061', 'annisashakila.n.azizah@gmail.com', NULL, '$2y$12$Ek/QORRNxGjLTAXbeIzWFeRKVTQLVz68s1JywUcfMDI46x7dBGyES', NULL, NULL, 'Bandung', '2016-07-11', 'Perempuan', 'Agus Nur\'adha', 'Fitria Nur Hidayati', 'Pekerja Swasta', NULL, 'Cikuda', '087654321911', '2526', '14', 1, 0, NULL, NULL, '2025-10-15 17:15:55', '2025-10-15 17:15:55'),
(168, 2, 9, 'Paderis nur Aprilia', '25261400062', 'paderisnur@gmail.com', NULL, '$2y$12$C3S0MtjcuGnj8j0Y0UB50u.SRhtMZa0lNxqJKe4hapcUEtHixWS56', NULL, NULL, 'Bandung', '2018-04-20', 'Laki-laki', 'Sumarna', 'Rini', NULL, NULL, 'Cibiru', '089765456321', '2526', '14', 1, 0, NULL, NULL, '2025-10-15 17:24:02', '2025-10-15 17:24:02'),
(169, 2, 9, 'Adskhan Virendra Hamizan Ahmad', '25261400063', 'adshakan@gmail.com', NULL, '$2y$12$iOPrgKXZBszjBZ/KJoNM2exa/3bVLG/m9SuMbOryJIUo1fXi3jRy6', NULL, NULL, 'Bandung', '2017-11-02', 'Laki-laki', 'Ahmad Saepudin', 'Tri Depita Rizki', NULL, NULL, 'Sukaluyu', '089765456321', '2526', '14', 1, 0, NULL, NULL, '2025-10-15 17:26:06', '2025-10-15 17:26:06'),
(187, 2, 14, 'Alby Azzam Nurwahid', '25261400075', 'albyazzam.nurwahid@gmail.com', NULL, '$2y$12$aAY/5FnvSVAuxYM2mwZJi.gIkTPsVAPbbGcJ1F35c/nBstnTc48Zy', 'student123', NULL, 'Bandung', '2017-01-28', 'Laki-laki', 'Komarudin', 'Restira Herawati Rahayu', NULL, NULL, 'Sukaluyu', '089521499977', '2526', '14', 1, 0, NULL, NULL, '2025-10-16 02:18:35', '2025-10-16 02:18:39'),
(190, 2, 17, 'Muhammad Abdul Fatih Al-Guntara', '25261400078', 'jerrysetiadi7@gmail.com', NULL, '$2y$12$Ght1MFux/YFSMWg4SzZ3Ne15JhVFkCqvOYGc6dUWiQPWmvY/UYCKu', 'abdul123', NULL, 'Bandung', '2018-12-17', 'Laki-laki', 'Yudi', 'Afifah', 'Karyawan Swasta', NULL, 'Sukaluyu', '089765456321', '2526', '14', 1, 0, NULL, NULL, '2025-10-16 07:44:01', '2025-10-16 07:54:02'),
(191, 2, 17, 'Muhammad Arif Saiful Millah', '25261400079', 'm.arifin.saiful@gmail.com', NULL, '$2y$12$yFvAhk37k0H7ZatZ2SzZJ./HhOBqF/PxsYVfVs8A5.1kJC3WxrAxK', NULL, NULL, 'Sukabumi', '2014-04-04', 'Laki-laki', 'Eman Suhada', 'Anisrah', NULL, NULL, 'Jadaria', '089765456321', '2526', '14', 1, 0, NULL, NULL, '2025-10-16 08:17:14', '2025-10-16 08:17:14'),
(192, 2, 16, 'Nadia Putri Rukmana', '25261400080', 'nadiaputri.r@gmail.com', NULL, '$2y$12$BYuCkVR5zuJ74IhCH3lvg.CuaDorMLXquYJmRS1hY/eL/uNr7l5b.', NULL, NULL, 'Jakarta', '2018-05-15', 'Laki-laki', 'Rukman', 'Aisyah', NULL, NULL, 'Sukaluyu', '087987987987', '2526', '14', 1, 0, NULL, NULL, '2025-10-16 08:18:56', '2025-10-16 08:18:56'),
(194, 2, 14, 'jerry erlangga setiadi', '25261400081', 'jerrysetiadi7@gmail.com', NULL, '$2y$12$G0QftNI6Z2oteXbpuTytH.gYn8XCKXrTre.y5FUFWLPbiIpvTwWuS', 'sokatuapa', NULL, 'amsterdam', '2025-10-15', 'Laki-laki', 'sensor', 'sensor', NULL, NULL, 'Jl MELUR XII No 7 RT 10 RW 15', '0895412965948', '2526', '14', 1, 0, NULL, NULL, '2025-10-16 08:36:57', '2025-10-16 08:37:01'),
(195, 2, 21, 'Fatih al farizi', '25261400082', 'datajerry01@gmail.com', NULL, '$2y$12$fTKQErQvQEam2v4iT1nD/Oo/w9kg6ucVQVay3MQEeZvc0fU9hX9XK', 'datajerry01', NULL, 'Bandung', '2012-12-12', 'Laki-laki', 'Dede Rahman', 'Mutiara', NULL, NULL, 'Sukaluyu', '089521499977', '2526', '14', 1, 0, NULL, NULL, '2025-10-16 08:42:54', '2025-10-16 08:42:59'),
(196, 2, 23, 'Diandra Akeila Sumahar', '25261400083', 'sitianzhany23@gmail.com', NULL, '$2y$12$JaOciIQZgyRZd8twbZqzl.j4mSfhuDnFMWXoj0uTFUMoGtaPS2yX2', NULL, NULL, 'Bandung', '2011-08-26', 'Perempuan', 'Yevi Arviana Sumahar', 'Tantan Sugiharti', 'Karyawan Swasta', 'IRT', 'Komp. Vijaya Kusuma', '081573694723', '2526', '14', 1, 0, NULL, 'photos/1760634336.png', '2025-10-16 10:05:37', '2025-10-16 10:05:37'),
(197, 2, 16, 'Shaka Al-Daffa', '25261400084', 'sanzhannym23@gmail.com', NULL, '$2y$12$AFaSZeVhs/CxlpBfn24s/eZK/MpBZnYjth85PLhiAxKTPlde46KzK', NULL, NULL, 'Bandung', '2018-03-07', 'Perempuan', 'Dadi Taryadi', 'Iis Solihat', NULL, NULL, 'Sukaluyu', '089765456321', '2526', '14', 1, 0, NULL, NULL, '2025-10-16 10:07:25', '2025-10-16 10:08:01'),
(199, 2, 21, 'Syakir Muhammad rizkullah', '25261400086', 'memberupline@gmail.com', NULL, '$2y$12$KdIozBH0DrauzsxjI2nHreXKCeCxvhCdwBOc55F4GwaHyi.dnMo6m', 'Syakir Muhammad rizkullah', NULL, 'Bandung', '2016-04-11', 'Laki-laki', 'Dani kusnadi', 'Aah wasiah', 'Karyawan Swasta', NULL, 'Cikuda', '089765456321', '2526', '14', 1, 0, NULL, NULL, '2025-10-16 10:24:05', '2025-10-16 10:24:09'),
(200, 2, 9, 'zeinnadya putri', '25261400087', 'zeinnn56@gmail.com', NULL, '$2y$12$v7v14dPfLR03cz.23Ct8B.uT2gy3pK9/x2ru.TearCzInBjeU/RDG', 'zeinnadya', NULL, 'Tasikmalaya', '2016-03-03', 'Perempuan', 'Hamdan Basuki', 'Ipah Syarifah', NULL, NULL, 'Cibiru', '089765456321', '2526', '14', 1, 0, NULL, NULL, '2025-10-16 18:06:34', '2025-10-16 18:06:40'),
(201, 2, 16, 'adam zulfadi', '25261400088', 'admntestnic@gmail.com', NULL, '$2y$12$fpgyh93aMgot6s1tp9Z8YOiT3.SIAOeK7nirote6v.pGD41uS7GnC', 'adamzulfadi', NULL, 'Bandung', '2016-12-13', 'Laki-laki', 'ahmad Fazar', 'Tini Yulianti', 'Wiraswasta', 'Pedagang', 'Sukaluyu', '0823687690993', '2526', '14', 1, 0, NULL, 'photos/XtXjsc5VNWvgr0WGXyqJFMbOC2az4WXjo1ZdEfqI.png', '2025-10-16 19:01:51', '2025-10-16 19:01:55'),
(202, 2, 9, 'Zahira Putri', '25261400089', 'anzhanny.m@gmail.com', NULL, '$2y$12$2blBJMFsEUjiWAbPSZrdB.HpBYj6582xFQUMpt8XyWkP2rFPWp7HG', 'student123', NULL, 'Bandung', '2018-04-26', 'Perempuan', 'Toni', 'Sheny', 'Pengusaha', 'IRT', 'Cikuda', '087654783291', '2526', '14', 1, 0, NULL, 'photos/5501GGP5VFklXmkH0uFIJtF611xZo976sgEBaQvE.png', '2025-10-16 19:08:44', '2025-10-16 19:08:48'),
(204, 2, 9, 'tetbeforepush', '25261400090', 'smzyn23@gmail.com', NULL, '$2y$12$7NgIgbhY/wc8HthstSS9dOXdrTCGHvjefkkv22aQ2a6CSFUppITA6', 'tetbeforepush', NULL, 'Bandung', '2012-02-22', 'Laki-laki', 'test', 'test', NULL, NULL, 'Cikuda', '0876543281902', '2526', '14', 1, 0, NULL, NULL, '2025-11-04 17:05:34', '2025-11-04 17:05:38');

--
-- Indexes for dumped tables
--

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
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

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
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `tb_class`
--
ALTER TABLE `tb_class`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_installment`
--
ALTER TABLE `tb_installment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tb_installment_user_id_foreign` (`user_id`);

--
-- Indexes for table `tb_payments`
--
ALTER TABLE `tb_payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tb_payments_installment_id_foreign` (`installment_id`),
  ADD KEY `tb_payments_user_id_foreign` (`user_id`),
  ADD KEY `tb_payments_class_id_foreign` (`class_id`);

--
-- Indexes for table `tb_role`
--
ALTER TABLE `tb_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `tb_class`
--
ALTER TABLE `tb_class`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `tb_installment`
--
ALTER TABLE `tb_installment`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `tb_payments`
--
ALTER TABLE `tb_payments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=361;

--
-- AUTO_INCREMENT for table `tb_role`
--
ALTER TABLE `tb_role`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=205;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_installment`
--
ALTER TABLE `tb_installment`
  ADD CONSTRAINT `tb_installment_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tb_payments`
--
ALTER TABLE `tb_payments`
  ADD CONSTRAINT `tb_payments_class_id_foreign` FOREIGN KEY (`class_id`) REFERENCES `tb_class` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `tb_payments_installment_id_foreign` FOREIGN KEY (`installment_id`) REFERENCES `tb_installment` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tb_payments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
