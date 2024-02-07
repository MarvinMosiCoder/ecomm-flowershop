-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 02, 2024 at 08:42 AM
-- Server version: 8.0.30
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `armani_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `add_to_cart_tbl`
--

CREATE TABLE `add_to_cart_tbl` (
  `id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `prod_id` int DEFAULT NULL,
  `quantity` int DEFAULT NULL,
  `price` decimal(18,2) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `add_to_cart_tbl`
--

INSERT INTO `add_to_cart_tbl` (`id`, `user_id`, `prod_id`, `quantity`, `price`, `created_at`, `updated_at`) VALUES
(14, 3, 1, 4, '400.00', '2024-02-02 06:38:25', '2024-02-01 22:38:25'),
(15, 3, 2, 1, '200.00', '2024-02-01 23:59:45', '2024-02-01 23:59:45');

-- --------------------------------------------------------

--
-- Table structure for table `cms_apicustom`
--

CREATE TABLE `cms_apicustom` (
  `id` int UNSIGNED NOT NULL,
  `permalink` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tabel` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `aksi` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kolom` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `orderby` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sub_query_1` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sql_where` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `keterangan` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parameter` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `method_type` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parameters` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `responses` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cms_apikey`
--

CREATE TABLE `cms_apikey` (
  `id` int UNSIGNED NOT NULL,
  `screetkey` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hit` int DEFAULT NULL,
  `status` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cms_dashboard`
--

CREATE TABLE `cms_dashboard` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_cms_privileges` int DEFAULT NULL,
  `content` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cms_email_queues`
--

CREATE TABLE `cms_email_queues` (
  `id` int UNSIGNED NOT NULL,
  `send_at` datetime DEFAULT NULL,
  `email_recipient` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_from_email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_from_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_cc_email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_subject` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `email_attachments` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `is_sent` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cms_email_templates`
--

CREATE TABLE `cms_email_templates` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `description` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `from_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `from_email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cc_email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cms_email_templates`
--

INSERT INTO `cms_email_templates` (`id`, `name`, `slug`, `subject`, `content`, `description`, `from_name`, `from_email`, `cc_email`, `created_at`, `updated_at`) VALUES
(1, 'Email Template Forgot Password Backend', 'forgot_password_backend', NULL, '<p>Hi,</p><p>Someone requested forgot password, here is your new password : </p><p>[password]</p><p><br></p><p>--</p><p>Regards,</p><p>Admin</p>', '[password]', 'System', 'system@crudbooster.com', NULL, '2023-05-06 01:42:14', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cms_logs`
--

CREATE TABLE `cms_logs` (
  `id` int UNSIGNED NOT NULL,
  `ipaddress` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `useragent` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `details` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `id_cms_users` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cms_logs`
--

INSERT INTO `cms_logs` (`id`, `ipaddress`, `useragent`, `url`, `description`, `details`, `id_cms_users`, `created_at`, `updated_at`) VALUES
(1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/admin/login', 'admin@crudbooster.com login with IP Address 127.0.0.1', '', 1, '2023-06-06 22:21:39', NULL),
(2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/admin/inventory_tbl/add-save', 'Add New Data  at Inventory', '', 1, '2023-06-06 23:28:12', NULL),
(3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/admin/inventory_tbl/add-save', 'Add New Data  at Inventory', '', 1, '2023-06-06 23:32:45', NULL),
(4, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/admin/inventory_tbl/add-save', 'Add New Data  at Inventory', '', 1, '2023-06-06 23:39:24', NULL),
(5, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/admin/inventory_tbl/add-save', 'Add New Data  at Inventory', '', 1, '2023-06-07 00:05:05', NULL),
(6, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/admin/inventory_tbl/add-save', 'Add New Data  at Inventory', '', 1, '2023-06-07 00:15:10', NULL),
(7, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/admin/inventory_tbl/add-save', 'Add New Data  at Inventory', '', 1, '2023-06-07 01:12:32', NULL),
(8, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/admin/inventory_tbl/add-save', 'Add New Data  at Inventory', '', 1, '2023-06-07 01:13:29', NULL),
(9, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/admin/inventory_tbl/add-save', 'Add New Data  at Inventory', '', 1, '2023-06-07 01:13:53', NULL),
(10, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/admin/inventory_tbl/add-save', 'Add New Data  at Inventory', '', 1, '2023-06-07 01:14:19', NULL),
(11, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/admin/inventory_tbl/add-save', 'Add New Data  at Inventory', '', 1, '2023-06-07 01:20:21', NULL),
(12, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/admin/inventory_tbl/add-save', 'Add New Data  at Inventory', '', 1, '2023-06-07 01:20:44', NULL),
(13, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/admin/inventory_tbl/add-save', 'Add New Data  at Inventory', '', 1, '2023-06-07 01:21:29', NULL),
(14, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/admin/inventory_tbl/add-save', 'Add New Data  at Inventory', '', 1, '2023-06-07 01:22:40', NULL),
(15, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/admin/inventory_tbl/add-save', 'Add New Data  at Inventory', '', 1, '2023-06-07 01:23:18', NULL),
(16, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/admin/login', 'admin@crudbooster.com login with IP Address 127.0.0.1', '', 1, '2023-06-08 23:42:54', NULL),
(17, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/admin/inventory_tbl/add-save', 'Add New Data  at Inventory', '', 1, '2023-06-08 23:47:13', NULL),
(18, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/admin/login', 'admin@crudbooster.com login with IP Address 127.0.0.1', '', 1, '2023-06-11 00:44:59', NULL),
(19, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/admin/login', 'admin@crudbooster.com login with IP Address 127.0.0.1', '', 1, '2023-06-11 19:21:49', NULL),
(20, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/admin/logout', 'armani@superadmin.ph logout', '', 1, '2023-06-11 19:22:16', NULL),
(21, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/admin/login', 'armani@superadmin.ph login with IP Address 127.0.0.1', '', 1, '2023-06-11 19:22:26', NULL),
(22, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/admin/logout', 'armani@superadmin.ph logout', '', 1, '2023-06-11 19:23:31', NULL),
(23, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/admin/login', 'armani@superadmin.ph login with IP Address 127.0.0.1', '', 1, '2023-06-11 19:24:01', NULL),
(24, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/admin/users/add-save', 'Add New Data Store Personnel at Users Management', '', 1, '2023-06-11 19:26:56', NULL),
(25, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/admin/users/edit-save/2', 'Update data Store Personnel at Users Management', '<table class=\"table table-striped\"><thead><tr><th>Key</th><th>Old Value</th><th>New Value</th></thead><tbody><tr><td>password</td><td>$2y$10$96iarnWIT.8AMu6GUiVB7uHOv0v.ils8OL9Wk0BEN2GiQNZ1NOTDm</td><td></td></tr><tr><td>store_id</td><td></td><td>1</td></tr><tr><td>status</td><td></td><td></td></tr></tbody></table>', 1, '2023-06-11 20:22:40', NULL),
(26, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/admin/login', 'store1@armani.ph login with IP Address 127.0.0.1', '', 2, '2023-06-11 20:24:27', NULL),
(27, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/admin/menu_management/edit-save/1', 'Update data Inventory at Menu Management', '<table class=\"table table-striped\"><thead><tr><th>Key</th><th>Old Value</th><th>New Value</th></thead><tbody><tr><td>color</td><td></td><td>normal</td></tr></tbody></table>', 1, '2023-06-11 20:24:41', NULL),
(28, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/admin/inventory_tbl/add-save', 'Add New Data  at Inventory', '', 2, '2023-06-11 20:35:12', NULL),
(29, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/admin/users/add-save', 'Add New Data Store Personnel at Users Management', '', 1, '2023-06-11 21:52:00', NULL),
(30, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/admin/logout', 'store1@armani.ph logout', '', 2, '2023-06-11 21:52:07', NULL),
(31, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/admin/login', 'store2@armani.ph login with IP Address 127.0.0.1', '', 3, '2023-06-11 21:52:11', NULL),
(32, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/admin/logout', 'store2@armani.ph logout', '', 3, '2023-06-11 21:52:25', NULL),
(33, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/admin/login', 'store1@armani.ph login with IP Address 127.0.0.1', '', 2, '2023-06-11 21:52:29', NULL),
(34, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/admin/menu_management/edit-save/1', 'Update data Inventory at Menu Management', '<table class=\"table table-striped\"><thead><tr><th>Key</th><th>Old Value</th><th>New Value</th></thead><tbody><tr><td>icon</td><td>fa fa-file-o</td><td>fa fa-plus-circle</td></tr></tbody></table>', 1, '2023-06-11 22:11:01', NULL),
(35, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/admin/menu_management/edit-save/2', 'Update data Add Sales at Menu Management', '<table class=\"table table-striped\"><thead><tr><th>Key</th><th>Old Value</th><th>New Value</th></thead><tbody><tr><td>color</td><td></td><td>normal</td></tr><tr><td>sorting</td><td>2</td><td></td></tr></tbody></table>', 1, '2023-06-11 22:20:57', NULL),
(36, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/admin/logout', 'store1@armani.ph logout', '', 2, '2023-06-11 22:21:20', NULL),
(37, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/admin/login', 'store1@armani.ph login with IP Address 127.0.0.1', '', 2, '2023-06-11 22:21:32', NULL),
(38, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/admin/logout', 'store1@armani.ph logout', '', 2, '2023-06-11 22:44:17', NULL),
(39, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/admin/login', 'store2@armani.ph login with IP Address 127.0.0.1', '', 3, '2023-06-11 22:44:23', NULL),
(40, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/admin/logout', 'store2@armani.ph logout', '', 3, '2023-06-11 22:53:20', NULL),
(41, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/admin/login', 'store1@armani.ph login with IP Address 127.0.0.1', '', 2, '2023-06-11 22:53:29', NULL),
(42, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/admin/sales_tbl/add-save', 'Add New Data  at Add Sales', '', 2, '2023-06-12 00:19:13', NULL),
(43, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/admin/sales_tbl/add-save', 'Add New Data Customer 1 at Add Sales', '', 2, '2023-06-12 00:26:12', NULL),
(44, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/admin/sales_tbl/add-save', 'Add New Data Customer 1 at Add Sales', '', 2, '2023-06-12 00:27:48', NULL),
(45, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/admin/logout', 'store1@armani.ph logout', '', 2, '2023-06-12 00:28:17', NULL),
(46, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/admin/login', 'store2@armani.ph login with IP Address 127.0.0.1', '', 3, '2023-06-12 00:28:21', NULL),
(47, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/admin/sales_tbl/add-save', 'Add New Data Customer 2 at Add Sales', '', 3, '2023-06-12 00:29:50', NULL),
(48, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/admin/menu_management/edit-save/3', 'Update data Sales Report at Menu Management', '<table class=\"table table-striped\"><thead><tr><th>Key</th><th>Old Value</th><th>New Value</th></thead><tbody><tr><td>color</td><td></td><td>normal</td></tr><tr><td>sorting</td><td>3</td><td></td></tr></tbody></table>', 1, '2023-06-12 00:36:14', NULL),
(49, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/admin/logout', 'store2@armani.ph logout', '', 3, '2023-06-12 00:36:32', NULL),
(50, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/admin/login', 'store1@armani.ph login with IP Address 127.0.0.1', '', 2, '2023-06-12 00:36:45', NULL),
(51, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/admin/sales_tbl/add-save', 'Add New Data Cus 3 at Add Sales', '', 2, '2023-06-12 00:59:18', NULL),
(52, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/admin/logout', 'store1@armani.ph logout', '', 2, '2023-06-12 01:30:55', NULL),
(53, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/admin/login', 'armani@superadmin.ph login with IP Address 127.0.0.1', '', 1, '2023-06-13 01:11:18', NULL),
(54, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/admin/login', 'store1@armani.ph login with IP Address 127.0.0.1', '', 2, '2023-06-13 01:11:41', NULL),
(55, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/admin/sales_tbl/add-save', 'Add New Data Customer 5 at Add Sales', '', 2, '2023-06-13 01:26:23', NULL),
(56, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/admin/menu_management/edit-save/3', 'Update data Daily Sales Report at Menu Management', '<table class=\"table table-striped\"><thead><tr><th>Key</th><th>Old Value</th><th>New Value</th></thead><tbody><tr><td>name</td><td>Sales Report</td><td>Daily Sales Report</td></tr><tr><td>sorting</td><td>3</td><td></td></tr></tbody></table>', 1, '2023-06-13 01:27:44', NULL),
(57, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/admin/menu_management/edit-save/4', 'Update data Overall Sales Report at Menu Management', '<table class=\"table table-striped\"><thead><tr><th>Key</th><th>Old Value</th><th>New Value</th></thead><tbody><tr><td>color</td><td></td><td>normal</td></tr><tr><td>sorting</td><td>4</td><td></td></tr></tbody></table>', 1, '2023-06-13 01:35:09', NULL),
(58, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/admin/logout', 'store1@armani.ph logout', '', 2, '2023-06-13 01:35:49', NULL),
(59, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/admin/login', 'store1@armani.ph login with IP Address 127.0.0.1', '', 2, '2023-06-13 01:35:53', NULL),
(60, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/admin/sales_tbl/add-save', 'Add New Data Customer 7 at Add Sales', '', 2, '2023-06-13 01:56:32', NULL),
(61, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/admin/logout', 'store1@armani.ph logout', '', 2, '2023-06-13 02:03:04', NULL),
(62, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/admin/login', 'store2@armani.ph login with IP Address 127.0.0.1', '', 3, '2023-06-13 02:03:08', NULL),
(63, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/admin/users/add-save', 'Add New Data Admin Personnel at Users Management', '', 1, '2023-06-13 02:29:46', NULL),
(64, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/admin/logout', 'store2@armani.ph logout', '', 3, '2023-06-13 02:29:57', NULL),
(65, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/admin/login', 'armani@admin.ph login with IP Address 127.0.0.1', '', 4, '2023-06-13 02:30:01', NULL),
(66, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/admin/menu_management/edit-save/1', 'Update data Inventory at Menu Management', '<table class=\"table table-striped\"><thead><tr><th>Key</th><th>Old Value</th><th>New Value</th></thead><tbody></tbody></table>', 1, '2023-06-13 02:30:18', NULL),
(67, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/admin/menu_management/edit-save/3', 'Update data Daily Sales Report at Menu Management', '<table class=\"table table-striped\"><thead><tr><th>Key</th><th>Old Value</th><th>New Value</th></thead><tbody><tr><td>sorting</td><td>3</td><td></td></tr></tbody></table>', 1, '2023-06-13 02:30:26', NULL),
(68, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/admin/menu_management/edit-save/4', 'Update data Overall Sales Report at Menu Management', '<table class=\"table table-striped\"><thead><tr><th>Key</th><th>Old Value</th><th>New Value</th></thead><tbody><tr><td>sorting</td><td>4</td><td></td></tr></tbody></table>', 1, '2023-06-13 02:30:34', NULL),
(69, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/admin/logout', 'armani@admin.ph logout', '', 4, '2023-06-13 02:33:50', NULL),
(70, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/admin/login', 'store1@armani.ph login with IP Address 127.0.0.1', '', 2, '2023-06-13 02:33:54', NULL),
(71, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/admin/logout', 'store1@armani.ph logout', '', 2, '2023-06-13 02:36:44', NULL),
(72, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/admin/login', 'armani@admin.ph login with IP Address 127.0.0.1', '', 4, '2023-06-13 02:36:48', NULL),
(73, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/admin/logout', 'armani@superadmin.ph logout', '', 1, '2023-06-13 02:45:31', NULL),
(74, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/admin/login', 'armani@superadmin.ph login with IP Address 127.0.0.1', '', 1, '2023-06-14 00:30:40', NULL),
(75, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/admin/login', 'store1@armani.ph login with IP Address 127.0.0.1', '', 2, '2023-06-14 00:31:08', NULL),
(76, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/admin/sales_tbl/add-save', 'Add New Data Jack Doe at Add Sales', '', 2, '2023-06-14 01:40:45', NULL),
(77, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/admin/logout', 'store1@armani.ph logout', '', 2, '2023-06-14 01:52:28', NULL),
(78, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/admin/login', 'store2@armani.ph login with IP Address 127.0.0.1', '', 3, '2023-06-14 01:52:49', NULL),
(79, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/admin/login', 'armani@superadmin.ph login with IP Address 127.0.0.1', '', 1, '2023-06-14 23:54:43', NULL),
(80, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/admin/logout', 'armani@superadmin.ph logout', '', 1, '2023-06-14 23:55:19', NULL),
(81, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/admin/login', 'armani@superadmin.ph login with IP Address 127.0.0.1', '', 1, '2023-06-15 00:37:17', NULL),
(82, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/admin/logout', 'armani@superadmin.ph logout', '', 1, '2023-06-15 00:37:47', NULL),
(83, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/admin/login', 'armani@superadmin.ph login with IP Address 127.0.0.1', '', 1, '2023-06-15 00:38:22', NULL),
(84, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/admin/logout', 'armani@superadmin.ph logout', '', 1, '2023-06-15 00:38:35', NULL),
(85, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/admin/login', 'armani@superadmin.ph login with IP Address 127.0.0.1', '', 1, '2023-06-16 02:02:03', NULL),
(86, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/admin/stores/add-save', 'Add New Data add at Stores', '', 1, '2023-06-16 02:07:28', NULL),
(87, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/admin/stores/edit-save/2', 'Update data Store 2 edit at Stores', '<table class=\"table table-striped\"><thead><tr><th>Key</th><th>Old Value</th><th>New Value</th></thead><tbody><tr><td>store_name</td><td>Store 2</td><td>Store 2 edit</td></tr><tr><td>created_by</td><td></td><td></td></tr><tr><td>updated_by</td><td></td><td></td></tr></tbody></table>', 1, '2023-06-16 02:08:04', NULL),
(88, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/admin/stores/edit-save/2', 'Update data Store 2 at Stores', '<table class=\"table table-striped\"><thead><tr><th>Key</th><th>Old Value</th><th>New Value</th></thead><tbody><tr><td>store_name</td><td>Store 2 edit</td><td>Store 2</td></tr><tr><td>created_by</td><td></td><td></td></tr><tr><td>updated_by</td><td></td><td></td></tr></tbody></table>', 1, '2023-06-16 02:08:10', NULL),
(89, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/admin/menu_management/add-save', 'Add New Data Masterfile at Menu Management', '', 1, '2023-06-16 02:09:31', NULL),
(90, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/admin/sub_masterfile_payment_type/add-save', 'Add New Data test at Payment Type', '', 1, '2023-06-16 02:26:33', NULL),
(91, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/admin/sub_masterfile_payment_type/delete/4', 'Delete data test at Payment Type', '', 1, '2023-06-16 02:26:37', NULL),
(92, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/admin/logout', 'armani@superadmin.ph logout', '', 1, '2023-06-16 02:50:33', NULL),
(93, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/admin/login', 'armani@superadmin.ph login with IP Address 127.0.0.1', '', 1, '2023-06-16 02:51:33', NULL),
(94, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/admin/logout', 'armani@superadmin.ph logout', '', 1, '2023-06-16 03:01:12', NULL),
(95, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/admin/login', 'armani@superadmin.ph login with IP Address 127.0.0.1', '', 1, '2023-06-17 21:39:55', NULL),
(96, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/admin/login', 'store1@armani.ph login with IP Address 127.0.0.1', '', 2, '2023-06-17 21:40:33', NULL),
(97, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/admin/sub_masterfile_payment_type/add-save', 'Add New Data CASH at Payment Type', '', 1, '2023-06-17 21:43:47', NULL),
(98, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/admin/sales_tbl/add-save', 'Add New Data Jack DOE at Add Sales', '', 2, '2023-06-17 21:44:23', NULL),
(99, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/admin/logout', 'store1@armani.ph logout', '', 2, '2023-06-17 21:45:22', NULL),
(100, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/admin/login', 'store2@armani.ph login with IP Address 127.0.0.1', '', 3, '2023-06-17 21:45:29', NULL),
(101, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/admin/sales_tbl/add-save', 'Add New Data Jenny Doe at Add Sales', '', 3, '2023-06-17 21:53:00', NULL),
(102, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/admin/sales_tbl/add-save', 'Add New Data Customer 2 at Add Sales', '', 3, '2023-06-17 21:59:01', NULL),
(103, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/admin/logout', 'armani@superadmin.ph logout', '', 1, '2023-06-17 22:03:49', NULL),
(104, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/admin/login', 'armani@admin.ph login with IP Address 127.0.0.1', '', 4, '2023-06-17 22:03:59', NULL),
(105, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/admin/logout', 'armani@admin.ph logout', '', 4, '2023-06-17 22:06:05', NULL),
(106, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/admin/logout', 'store2@armani.ph logout', '', 3, '2023-06-17 22:06:23', NULL),
(107, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/admin/login', 'armani@superadmin.ph login with IP Address 127.0.0.1', '', 1, '2023-06-17 22:08:28', NULL),
(108, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/admin/logout', 'armani@superadmin.ph logout', '', 1, '2023-06-17 22:13:13', NULL),
(109, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/admin/login', 'armani@superadmin.ph login with IP Address 127.0.0.1', '', 1, '2023-06-17 22:14:56', NULL),
(110, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/admin/logout', 'armani@superadmin.ph logout', '', 1, '2023-06-17 22:16:08', NULL),
(111, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/admin/login', 'armani@superadmin.ph login with IP Address 127.0.0.1', '', 1, '2023-06-19 18:04:49', NULL),
(112, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/admin/login', 'store1@armani.ph login with IP Address 127.0.0.1', '', 2, '2023-06-19 18:47:20', NULL),
(113, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/admin/logout', 'store1@armani.ph logout', '', 2, '2023-06-19 18:48:04', NULL),
(114, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/admin/login', 'store2@armani.ph login with IP Address 127.0.0.1', '', 3, '2023-06-19 18:48:09', NULL),
(115, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/admin/menu_management/edit-save/2', 'Update data Add Sales at Menu Management', '<table class=\"table table-striped\"><thead><tr><th>Key</th><th>Old Value</th><th>New Value</th></thead><tbody><tr><td>sorting</td><td>2</td><td></td></tr></tbody></table>', 1, '2023-06-19 18:57:28', NULL),
(116, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/admin/menu_management/edit-save/6', 'Update data Masterfile at Menu Management', '<table class=\"table table-striped\"><thead><tr><th>Key</th><th>Old Value</th><th>New Value</th></thead><tbody><tr><td>sorting</td><td>5</td><td></td></tr></tbody></table>', 1, '2023-06-19 18:57:41', NULL),
(117, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/admin/menu_management/edit-save/5', 'Update data Stores at Menu Management', '<table class=\"table table-striped\"><thead><tr><th>Key</th><th>Old Value</th><th>New Value</th></thead><tbody><tr><td>color</td><td></td><td>normal</td></tr><tr><td>parent_id</td><td>6</td><td></td></tr></tbody></table>', 1, '2023-06-19 18:57:51', NULL),
(118, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/admin/menu_management/edit-save/7', 'Update data Flower Type at Menu Management', '<table class=\"table table-striped\"><thead><tr><th>Key</th><th>Old Value</th><th>New Value</th></thead><tbody><tr><td>color</td><td></td><td>normal</td></tr><tr><td>parent_id</td><td>6</td><td></td></tr><tr><td>sorting</td><td>2</td><td></td></tr></tbody></table>', 1, '2023-06-19 18:58:04', NULL),
(119, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/admin/menu_management/edit-save/8', 'Update data Payment Type at Menu Management', '<table class=\"table table-striped\"><thead><tr><th>Key</th><th>Old Value</th><th>New Value</th></thead><tbody><tr><td>color</td><td></td><td>normal</td></tr><tr><td>parent_id</td><td>6</td><td></td></tr><tr><td>sorting</td><td>3</td><td></td></tr></tbody></table>', 1, '2023-06-19 18:58:10', NULL),
(120, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/admin/logout', 'store2@armani.ph logout', '', 3, '2023-06-19 18:58:44', NULL),
(121, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/admin/login', 'armani@admin.ph login with IP Address 127.0.0.1', '', 4, '2023-06-19 18:58:48', NULL),
(122, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/admin/statistic_builder/add-save', 'Add New Data Daily Sales at Statistic Builder', '', 1, '2023-06-19 21:03:42', NULL),
(123, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/admin/statistic_builder/edit-save/1', 'Update data Daily Sales Admin Side at Statistic Builder', '<table class=\"table table-striped\"><thead><tr><th>Key</th><th>Old Value</th><th>New Value</th></thead><tbody><tr><td>name</td><td>Daily Sales</td><td>Daily Sales Admin Side</td></tr><tr><td>slug</td><td>daily-sales</td><td></td></tr></tbody></table>', 1, '2023-06-19 21:10:10', NULL),
(124, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/admin/menu_management/add-save', 'Add New Data Daily Sales Admin Side at Menu Management', '', 1, '2023-06-19 21:11:42', NULL),
(125, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/admin/statistic_builder/add-save', 'Add New Data Daily Sales Store Side at Statistic Builder', '', 1, '2023-06-19 21:12:42', NULL),
(126, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/admin/menu_management/add-save', 'Add New Data Daily Sales at Menu Management', '', 1, '2023-06-19 21:19:13', NULL),
(127, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/admin/logout', 'armani@admin.ph logout', '', 4, '2023-06-19 21:19:55', NULL),
(128, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/admin/login', 'store1@armani.ph login with IP Address 127.0.0.1', '', 2, '2023-06-19 21:20:14', NULL),
(129, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/admin/sales_tbl/add-save', 'Add New Data A1 Doe at Add Sales', '', 2, '2023-06-19 21:20:40', NULL),
(130, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/admin/sales_tbl/add-save', 'Add New Data A2 Doe at Add Sales', '', 2, '2023-06-19 21:27:04', NULL),
(131, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/admin/sales_tbl/add-save', 'Add New Data A3 Doe at Add Sales', '', 2, '2023-06-19 21:46:51', NULL),
(132, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/admin/login', 'armani@superadmin.ph login with IP Address 127.0.0.1', '', 1, '2023-06-20 23:10:50', NULL),
(133, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/admin/logout', 'armani@superadmin.ph logout', '', 1, '2023-06-20 23:19:11', NULL),
(134, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/admin/login', 'armani@admin.ph login with IP Address 127.0.0.1', '', 4, '2023-06-20 23:19:34', NULL),
(135, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/admin/login', 'store1@armani.ph login with IP Address 127.0.0.1', '', 2, '2023-06-20 23:19:46', NULL),
(136, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 Edg/114.0.1823.51', 'http://127.0.0.1:8000/admin/logout', ' logout', '', NULL, '2023-06-21 02:20:19', NULL),
(137, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 'http://127.0.0.1:8002/admin/login', 'armani@superadmin.ph login with IP Address 127.0.0.1', '', 1, '2023-06-21 22:33:12', NULL),
(138, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 'http://127.0.0.1:8002/admin/inventory_tbl/edit-save/12', 'Update data  at Inventory', '<table class=\"table table-striped\"><thead><tr><th>Key</th><th>Old Value</th><th>New Value</th></thead><tbody><tr><td>code</td><td></td><td></td></tr><tr><td>arrival</td><td>6</td><td></td></tr><tr><td>stock</td><td>6</td><td></td></tr><tr><td>house_stock</td><td>0</td><td></td></tr><tr><td>price</td><td>600.00</td><td>700.00</td></tr><tr><td>flower_type</td><td>2</td><td></td></tr><tr><td>status</td><td>ACTIVE</td><td></td></tr><tr><td>store_id</td><td>2</td><td></td></tr><tr><td>created_by</td><td>3</td><td></td></tr><tr><td>updated_by</td><td>3</td><td></td></tr></tbody></table>', 1, '2023-06-21 22:48:51', NULL),
(139, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 Edg/114.0.1823.51', 'http://127.0.0.1:8002/admin/login', 'store1@armani.ph login with IP Address 127.0.0.1', '', 2, '2023-06-21 22:50:41', NULL),
(140, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 'http://127.0.0.1:8002/admin/menu_management/edit-save/10', 'Update data Daily Sales at Menu Management', '<table class=\"table table-striped\"><thead><tr><th>Key</th><th>Old Value</th><th>New Value</th></thead><tbody><tr><td>parent_id</td><td>0</td><td></td></tr><tr><td>sorting</td><td></td><td></td></tr></tbody></table>', 1, '2023-06-21 22:59:21', NULL),
(141, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 'http://127.0.0.1:8002/admin/menu_management/edit-save/9', 'Update data Daily Sales Admin Side at Menu Management', '<table class=\"table table-striped\"><thead><tr><th>Key</th><th>Old Value</th><th>New Value</th></thead><tbody><tr><td>parent_id</td><td>0</td><td></td></tr><tr><td>sorting</td><td></td><td></td></tr></tbody></table>', 1, '2023-06-21 22:59:28', NULL),
(142, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 Edg/114.0.1823.51', 'http://127.0.0.1:8002/admin/sales_tbl/add-save', 'Add New Data Iron Doe at Add Sales', '', 2, '2023-06-21 23:00:11', NULL),
(143, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 Edg/114.0.1823.51', 'http://127.0.0.1:8002/admin/sales_tbl/add-save', 'Add New Data Jack Doe at Add Sales', '', 2, '2023-06-21 23:28:23', NULL),
(144, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 Edg/114.0.1823.51', 'http://127.0.0.1:8002/admin/sales_tbl/add-save', 'Add New Data Jack Doe at Add Sales', '', 2, '2023-06-21 23:29:31', NULL),
(145, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36 Edg/114.0.1823.51', 'http://127.0.0.1:8002/admin/logout', 'store1@armani.ph logout', '', 2, '2023-06-22 01:05:15', NULL),
(146, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/admin/login', 'armani@superadmin.ph login with IP Address 127.0.0.1', '', 1, '2023-06-24 05:49:58', NULL),
(147, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/admin/login', 'store1@armani.ph login with IP Address 127.0.0.1', '', 2, '2023-06-24 05:51:39', NULL),
(148, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/admin/login', 'armani@admin.ph login with IP Address 127.0.0.1', '', 4, '2023-06-24 06:17:18', NULL),
(149, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 'http://127.0.0.1:8005/admin/login', 'armani@superadmin.ph login with IP Address 127.0.0.1', '', 1, '2023-07-17 01:33:09', NULL),
(150, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 'http://127.0.0.1:8005/admin/inventory_tbl/add-save', 'Add New Data  at Inventory', '', 1, '2023-07-17 01:50:56', NULL),
(151, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/admin/login', 'armani@superadmin.ph login with IP Address 127.0.0.1', '', 1, '2023-07-19 02:22:26', NULL),
(152, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36', 'http://127.0.0.1:8000/admin/inventory_tbl/add-save', 'Add New Data  at Inventory', '', 1, '2023-07-19 02:24:59', NULL),
(153, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/121.0.0.0 Safari/537.36 Edg/121.0.0.0', 'http://localhost/armani_flowershop/public/admin/login', 'armani@superadmin.ph login with IP Address ::1', '', 1, '2024-01-29 19:14:39', NULL),
(154, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/121.0.0.0 Safari/537.36 Edg/121.0.0.0', 'http://localhost/armani_flowershop/public/admin/inventory_tbl/add-save', 'Add New Data  at Inventory', '', 1, '2024-01-29 19:16:40', NULL),
(155, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/121.0.0.0 Safari/537.36', 'http://localhost/armani_flowershop/public/admin/login', 'armani@superadmin.ph login with IP Address ::1', '', 1, '2024-02-01 00:05:33', NULL),
(156, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/121.0.0.0 Safari/537.36', 'http://localhost/armani_flowershop/public/admin/inventory_tbl/add-save', 'Add New Data  at Inventory', '', 1, '2024-02-01 00:06:49', NULL),
(157, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/121.0.0.0 Safari/537.36 Edg/121.0.0.0', 'http://localhost/armani_flowershop/public/admin/login', 'armani@superadmin.ph login with IP Address ::1', '', 1, '2024-02-01 23:14:36', NULL),
(158, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/121.0.0.0 Safari/537.36 Edg/121.0.0.0', 'http://localhost/armani_flowershop/public/admin/statuses/add-save', 'Add New Data  at Statuses', '', 1, '2024-02-01 23:16:23', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cms_menus`
--

CREATE TABLE `cms_menus` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'url',
  `path` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` int DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_dashboard` tinyint(1) NOT NULL DEFAULT '0',
  `id_cms_privileges` int DEFAULT NULL,
  `sorting` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cms_menus`
--

INSERT INTO `cms_menus` (`id`, `name`, `type`, `path`, `color`, `icon`, `parent_id`, `is_active`, `is_dashboard`, `id_cms_privileges`, `sorting`, `created_at`, `updated_at`) VALUES
(1, 'Inventory', 'Route', 'AdminInventoryTblControllerGetIndex', 'normal', 'fa fa-plus-circle', 0, 1, 0, 1, 3, '2023-06-06 22:30:45', '2023-06-13 02:30:18'),
(2, 'Add Sales', 'Route', 'AdminSalesTblControllerGetIndex', 'normal', 'fa fa-calendar-plus-o', 0, 1, 0, 1, 5, '2023-06-11 22:19:38', '2023-06-19 18:57:28'),
(3, 'Daily Sales Report', 'Route', 'AdminSalesReportControllerGetIndex', 'normal', 'fa fa-bar-chart', 0, 1, 0, 1, 6, '2023-06-12 00:35:39', '2023-06-13 02:30:26'),
(4, 'Overall Sales Report', 'Route', 'AdminOverallSalesReportControllerGetIndex', 'normal', 'fa fa-bar-chart', 0, 1, 0, 1, 7, '2023-06-13 01:33:20', '2023-06-13 02:30:34'),
(5, 'Stores', 'Route', 'AdminStoresControllerGetIndex', 'normal', 'fa fa-files-o', 6, 1, 0, 1, 1, '2023-06-16 02:04:19', '2023-06-19 18:57:51'),
(6, 'Masterfile', 'URL', 'masterfile', 'normal', 'fa fa-list', 0, 1, 0, 1, 8, '2023-06-16 02:09:31', '2023-06-19 18:57:41'),
(7, 'Flower Type', 'Route', 'AdminSubMasterfileFlowerTypeControllerGetIndex', 'normal', 'fa fa-file-o', 6, 1, 0, 1, 2, '2023-06-16 02:11:33', '2023-06-19 18:58:04'),
(8, 'Payment Type', 'Route', 'AdminSubMasterfilePaymentTypeControllerGetIndex', 'normal', 'fa fa-files-o', 6, 1, 0, 1, 3, '2023-06-16 02:14:34', '2023-06-19 18:58:10'),
(9, 'Daily Sales Admin Side', 'Statistic', 'statistic_builder/show/daily-sales', 'normal', 'fa fa-tachometer', 0, 1, 1, 1, 1, '2023-06-19 21:11:42', '2023-06-21 22:59:28'),
(10, 'Daily Sales', 'Statistic', 'statistic_builder/show/daily-sales-store-side', 'normal', 'fa fa-tachometer', 0, 1, 1, 1, 2, '2023-06-19 21:19:13', '2023-06-21 22:59:21'),
(11, 'Statuses', 'Route', 'AdminStatusesControllerGetIndex', NULL, 'fa fa-circle-o', 6, 1, 0, 1, 4, '2024-02-01 23:15:13', NULL),
(12, 'Orders', 'Route', 'AdminOrdersControllerGetIndex', NULL, 'fa fa-reorder', 0, 1, 0, 1, 4, '2024-02-01 23:17:09', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cms_menus_privileges`
--

CREATE TABLE `cms_menus_privileges` (
  `id` int UNSIGNED NOT NULL,
  `id_cms_menus` int DEFAULT NULL,
  `id_cms_privileges` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cms_menus_privileges`
--

INSERT INTO `cms_menus_privileges` (`id`, `id_cms_menus`, `id_cms_privileges`) VALUES
(17, 1, 3),
(18, 1, 2),
(19, 1, 1),
(20, 3, 3),
(21, 3, 2),
(22, 3, 1),
(23, 4, 3),
(24, 4, 2),
(25, 4, 1),
(30, 2, 3),
(31, 2, 2),
(32, 2, 1),
(33, 6, 3),
(34, 6, 1),
(35, 5, 3),
(36, 5, 1),
(37, 7, 3),
(38, 7, 1),
(39, 8, 3),
(40, 8, 1),
(44, 10, 1),
(45, 9, 1),
(46, 11, 1),
(47, 12, 1);

-- --------------------------------------------------------

--
-- Table structure for table `cms_moduls`
--

CREATE TABLE `cms_moduls` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `path` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `table_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `controller` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_protected` tinyint(1) NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cms_moduls`
--

INSERT INTO `cms_moduls` (`id`, `name`, `icon`, `path`, `table_name`, `controller`, `is_protected`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Notifications', 'fa fa-cog', 'notifications', 'cms_notifications', 'NotificationsController', 1, 1, '2023-05-06 01:42:14', NULL, NULL),
(2, 'Privileges', 'fa fa-cog', 'privileges', 'cms_privileges', 'PrivilegesController', 1, 1, '2023-05-06 01:42:14', NULL, NULL),
(3, 'Privileges Roles', 'fa fa-cog', 'privileges_roles', 'cms_privileges_roles', 'PrivilegesRolesController', 1, 1, '2023-05-06 01:42:14', NULL, NULL),
(4, 'Users Management', 'fa fa-users', 'users', 'cms_users', 'AdminCmsUsersController', 0, 1, '2023-05-06 01:42:14', NULL, NULL),
(5, 'Settings', 'fa fa-cog', 'settings', 'cms_settings', 'SettingsController', 1, 1, '2023-05-06 01:42:14', NULL, NULL),
(6, 'Module Generator', 'fa fa-database', 'module_generator', 'cms_moduls', 'ModulsController', 1, 1, '2023-05-06 01:42:14', NULL, NULL),
(7, 'Menu Management', 'fa fa-bars', 'menu_management', 'cms_menus', 'MenusController', 1, 1, '2023-05-06 01:42:14', NULL, NULL),
(8, 'Email Templates', 'fa fa-envelope-o', 'email_templates', 'cms_email_templates', 'EmailTemplatesController', 1, 1, '2023-05-06 01:42:14', NULL, NULL),
(9, 'Statistic Builder', 'fa fa-dashboard', 'statistic_builder', 'cms_statistics', 'StatisticBuilderController', 1, 1, '2023-05-06 01:42:14', NULL, NULL),
(10, 'API Generator', 'fa fa-cloud-download', 'api_generator', '', 'ApiCustomController', 1, 1, '2023-05-06 01:42:14', NULL, NULL),
(11, 'Log User Access', 'fa fa-flag-o', 'logs', 'cms_logs', 'LogsController', 1, 1, '2023-05-06 01:42:14', NULL, NULL),
(12, 'Inventory', 'fa fa-file-o', 'inventory_tbl', 'inventory_tbl', 'AdminInventoryTblController', 0, 0, '2023-06-06 22:30:45', NULL, NULL),
(13, 'Add Sales', 'fa fa-calendar-plus-o', 'sales_tbl', 'sales_tbl', 'AdminSalesTblController', 0, 0, '2023-06-11 22:19:37', NULL, NULL),
(14, 'Daily Sales Report', 'fa fa-bar-chart', 'sales_report', 'inventory_tbl', 'AdminSalesReportController', 0, 0, '2023-06-12 00:35:39', NULL, NULL),
(15, 'Overall Sales Report', 'fa fa-bar-chart', 'overall_sales_report', 'inventory_tbl', 'AdminOverallSalesReportController', 0, 0, '2023-06-13 01:33:20', NULL, NULL),
(16, 'Stores', 'fa fa-files-o', 'stores', 'stores', 'AdminStoresController', 0, 0, '2023-06-16 02:04:19', NULL, NULL),
(17, 'Flower Type', 'fa fa-file-o', 'sub_masterfile_flower_type', 'sub_masterfile_flower_type', 'AdminSubMasterfileFlowerTypeController', 0, 0, '2023-06-16 02:11:33', NULL, NULL),
(18, 'Payment Type', 'fa fa-files-o', 'sub_masterfile_payment_type', 'sub_masterfile_payment_type', 'AdminSubMasterfilePaymentTypeController', 0, 0, '2023-06-16 02:14:34', NULL, NULL),
(19, 'Statuses', 'fa fa-circle-o', 'statuses', 'statuses', 'AdminStatusesController', 0, 0, '2024-02-01 23:15:13', NULL, NULL),
(20, 'Orders', 'fa fa-reorder', 'orders', 'orders', 'AdminOrdersController', 0, 0, '2024-02-01 23:17:09', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cms_notifications`
--

CREATE TABLE `cms_notifications` (
  `id` int UNSIGNED NOT NULL,
  `id_cms_users` int DEFAULT NULL,
  `content` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_read` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cms_privileges`
--

CREATE TABLE `cms_privileges` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_superadmin` tinyint(1) DEFAULT NULL,
  `theme_color` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cms_privileges`
--

INSERT INTO `cms_privileges` (`id`, `name`, `is_superadmin`, `theme_color`, `created_at`, `updated_at`) VALUES
(1, 'Super Administrator', 1, 'skin-green', '2023-05-06 01:42:14', NULL),
(2, 'Store', 0, 'skin-green', NULL, NULL),
(3, 'Admin', 0, 'skin-green', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cms_privileges_roles`
--

CREATE TABLE `cms_privileges_roles` (
  `id` int UNSIGNED NOT NULL,
  `is_visible` tinyint(1) DEFAULT NULL,
  `is_create` tinyint(1) DEFAULT NULL,
  `is_read` tinyint(1) DEFAULT NULL,
  `is_edit` tinyint(1) DEFAULT NULL,
  `is_delete` tinyint(1) DEFAULT NULL,
  `id_cms_privileges` int DEFAULT NULL,
  `id_cms_moduls` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cms_privileges_roles`
--

INSERT INTO `cms_privileges_roles` (`id`, `is_visible`, `is_create`, `is_read`, `is_edit`, `is_delete`, `id_cms_privileges`, `id_cms_moduls`, `created_at`, `updated_at`) VALUES
(30, 1, 1, 1, 1, 1, 1, 13, NULL, NULL),
(31, 1, 1, 1, 1, 1, 1, 12, NULL, NULL),
(32, 1, 1, 1, 1, 1, 1, 14, NULL, NULL),
(33, 1, 1, 1, 1, 1, 1, 4, NULL, NULL),
(34, 1, 1, 1, 1, 1, 1, 15, NULL, NULL),
(35, 1, 1, 1, 1, 0, 2, 13, NULL, NULL),
(36, 1, 0, 1, 0, 0, 2, 14, NULL, NULL),
(37, 1, 1, 1, 1, 0, 2, 12, NULL, NULL),
(38, 1, 0, 1, 0, 0, 2, 15, NULL, NULL),
(39, 1, 0, 1, 1, 0, 2, 4, NULL, NULL),
(44, 1, 1, 1, 1, 1, 1, 16, NULL, NULL),
(45, 1, 1, 1, 1, 1, 1, 17, NULL, NULL),
(46, 1, 1, 1, 1, 1, 1, 18, NULL, NULL),
(52, 1, 0, 1, 0, 0, 3, 13, NULL, NULL),
(53, 1, 0, 1, 0, 0, 3, 14, NULL, NULL),
(54, 1, 1, 1, 1, 0, 3, 17, NULL, NULL),
(55, 1, 0, 1, 0, 0, 3, 12, NULL, NULL),
(56, 1, 0, 1, 0, 0, 3, 15, NULL, NULL),
(57, 1, 1, 1, 1, 0, 3, 18, NULL, NULL),
(58, 1, 1, 1, 1, 0, 3, 16, NULL, NULL),
(59, 0, 1, 1, 1, 0, 3, 4, NULL, NULL),
(60, 1, 1, 1, 1, 1, 1, 19, NULL, NULL),
(61, 1, 1, 1, 1, 1, 1, 20, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cms_settings`
--

CREATE TABLE `cms_settings` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `content_input_type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dataenum` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `helper` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `group_setting` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `label` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cms_settings`
--

INSERT INTO `cms_settings` (`id`, `name`, `content`, `content_input_type`, `dataenum`, `helper`, `created_at`, `updated_at`, `group_setting`, `label`) VALUES
(1, 'login_background_color', NULL, 'text', NULL, 'Input hexacode', '2023-05-06 01:42:14', NULL, 'Login Register Style', 'Login Background Color'),
(2, 'login_font_color', NULL, 'text', NULL, 'Input hexacode', '2023-05-06 01:42:14', NULL, 'Login Register Style', 'Login Font Color'),
(3, 'login_background_image', 'uploads/2023-06/1b3db517b4ada4e6f6061c80221629a7.jpg', 'upload_image', NULL, NULL, '2023-05-06 01:42:14', NULL, 'Login Register Style', 'Login Background Image'),
(4, 'email_sender', 'support@crudbooster.com', 'text', NULL, NULL, '2023-05-06 01:42:14', NULL, 'Email Setting', 'Email Sender'),
(5, 'smtp_driver', 'mail', 'select', 'smtp,mail,sendmail', NULL, '2023-05-06 01:42:14', NULL, 'Email Setting', 'Mail Driver'),
(6, 'smtp_host', '', 'text', NULL, NULL, '2023-05-06 01:42:14', NULL, 'Email Setting', 'SMTP Host'),
(7, 'smtp_port', '25', 'text', NULL, 'default 25', '2023-05-06 01:42:14', NULL, 'Email Setting', 'SMTP Port'),
(8, 'smtp_username', '', 'text', NULL, NULL, '2023-05-06 01:42:14', NULL, 'Email Setting', 'SMTP Username'),
(9, 'smtp_password', '', 'text', NULL, NULL, '2023-05-06 01:42:14', NULL, 'Email Setting', 'SMTP Password'),
(10, 'appname', 'Armani Sales Report', 'text', NULL, NULL, '2023-05-06 01:42:14', NULL, 'Application Setting', 'Application Name'),
(11, 'default_paper_size', 'Legal', 'text', NULL, 'Paper size, ex : A4, Legal, etc', '2023-05-06 01:42:14', NULL, 'Application Setting', 'Default Paper Print Size'),
(12, 'logo', 'uploads/2023-06/b2691761a02a4ee7c1af8981994a9807.png', 'upload_image', NULL, NULL, '2023-05-06 01:42:14', NULL, 'Application Setting', 'Logo'),
(13, 'favicon', NULL, 'upload_image', NULL, NULL, '2023-05-06 01:42:14', NULL, 'Application Setting', 'Favicon'),
(14, 'api_debug_mode', 'true', 'select', 'true,false', NULL, '2023-05-06 01:42:14', NULL, 'Application Setting', 'API Debug Mode'),
(15, 'google_api_key', NULL, 'text', NULL, NULL, '2023-05-06 01:42:14', NULL, 'Application Setting', 'Google API Key'),
(16, 'google_fcm_key', NULL, 'text', NULL, NULL, '2023-05-06 01:42:14', NULL, 'Application Setting', 'Google FCM Key');

-- --------------------------------------------------------

--
-- Table structure for table `cms_statistics`
--

CREATE TABLE `cms_statistics` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cms_statistics`
--

INSERT INTO `cms_statistics` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'Daily Sales Admin Side', 'daily-sales', '2023-06-19 21:03:42', '2023-06-19 21:10:10'),
(2, 'Daily Sales Store Side', 'daily-sales-store-side', '2023-06-19 21:12:42', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cms_statistic_components`
--

CREATE TABLE `cms_statistic_components` (
  `id` int UNSIGNED NOT NULL,
  `id_cms_statistics` int DEFAULT NULL,
  `componentID` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `component_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `area_name` varchar(55) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sorting` int DEFAULT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `config` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cms_statistic_components`
--

INSERT INTO `cms_statistic_components` (`id`, `id_cms_statistics`, `componentID`, `component_name`, `area_name`, `sorting`, `name`, `config`, `created_at`, `updated_at`) VALUES
(1, 1, 'dd837ae8b0a144887e1ae501ab4c64f9', 'smallbox', 'area1', 0, NULL, '{\"name\":\"Daily Sales\",\"icon\":\"ion-sales\",\"color\":\"bg-green\",\"link\":\"#\",\"sql\":\"SELECT COUNT(*) FROM`sales_tbl` WHERE sales_tbl.date_of_purchase =  CURRENT_TIMESTAMP()\"}', '2023-06-19 21:04:21', NULL),
(2, 2, '01b24cd571c3579ffe71446b31ad5809', 'smallbox', 'area1', 0, NULL, '{\"name\":\"Daily Sales\",\"icon\":\"ion-card\",\"color\":\"bg-green\",\"link\":\"#\",\"sql\":\"SELECT COUNT(*) FROM`sales_tbl` WHERE  sales_tbl.store_id = [store_id] and sales_tbl.date_of_purchase  =  CURRENT_TIMESTAMP()\"}', '2023-06-19 21:12:55', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cms_users`
--

CREATE TABLE `cms_users` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_cms_privileges` int DEFAULT NULL,
  `store_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cms_users`
--

INSERT INTO `cms_users` (`id`, `name`, `photo`, `email`, `password`, `id_cms_privileges`, `store_id`, `created_at`, `updated_at`, `status`) VALUES
(1, 'Super Admin', NULL, 'armani@superadmin.ph', '$2y$10$7zq48jCyE2olXmvkEvVUcePBfz92wg38e3ERVdhijNObdiTe.SMsq', 1, NULL, '2023-05-06 01:42:14', NULL, 'Active'),
(2, 'Store Personnel', 'uploads/1/2023-06/1567755485.png', 'store1@armani.ph', '$2y$10$96iarnWIT.8AMu6GUiVB7uHOv0v.ils8OL9Wk0BEN2GiQNZ1NOTDm', 2, 1, '2023-06-11 19:26:56', '2023-06-11 20:22:40', NULL),
(3, 'Store Personnel', 'uploads/1/2023-06/1567971055.png', 'store2@armani.ph', '$2y$10$Axo5wG09RJRKXcT6RysmUetXNFLy.bjOWyyB7TUeYuRu7sIWx96x2', 2, 2, '2023-06-11 21:52:00', NULL, NULL),
(4, 'Admin Personnel', 'uploads/1/2023-06/1567755485.png', 'armani@admin.ph', '$2y$10$Tq2MicYd.BIEvoOkZ7dr5uJYdHHB.o0JUMpplHz/VHHzvfWIC/aDm', 3, NULL, '2023-06-13 02:29:46', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `inventory_image`
--

CREATE TABLE `inventory_image` (
  `id` int UNSIGNED NOT NULL,
  `inv_id` int DEFAULT NULL,
  `file_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ext` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `archived` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `inventory_image`
--

INSERT INTO `inventory_image` (`id`, `inv_id`, `file_name`, `ext`, `created_by`, `archived`, `created_at`, `updated_at`) VALUES
(1, 1, '17065846007.jpg', 'jpg', 1, NULL, '2024-01-29 19:16:40', '2024-01-29 19:16:40'),
(2, 2, '17067748092.jpg', 'jpg', 1, NULL, '2024-02-01 00:06:49', '2024-02-01 00:06:49');

-- --------------------------------------------------------

--
-- Table structure for table `inventory_tbl`
--

CREATE TABLE `inventory_tbl` (
  `id` int NOT NULL,
  `code` varchar(191) DEFAULT NULL,
  `flower_name` varchar(191) DEFAULT NULL,
  `item_description` varchar(191) DEFAULT NULL,
  `arrival` int DEFAULT NULL,
  `stock` int DEFAULT NULL,
  `house_stock` int DEFAULT NULL,
  `price` decimal(15,2) DEFAULT NULL,
  `percent_sale` int DEFAULT NULL,
  `flower_type` varchar(191) DEFAULT NULL,
  `status` varchar(191) DEFAULT NULL,
  `store_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `updated_by` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inventory_tbl`
--

INSERT INTO `inventory_tbl` (`id`, `code`, `flower_name`, `item_description`, `arrival`, `stock`, `house_stock`, `price`, `percent_sale`, `flower_type`, `status`, `store_id`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, NULL, 'Flower 1', 'flower description', NULL, 50, NULL, '100.00', 10, '1', 'ACTIVE', NULL, '2024-01-29 19:16:40', 1, NULL, NULL),
(2, NULL, 'Dried flower', 'Dried flower description', NULL, 500, NULL, '200.00', 20, '2', 'ACTIVE', NULL, '2024-02-01 00:06:49', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2016_08_07_145904_add_table_cms_apicustom', 1),
(4, '2016_08_07_150834_add_table_cms_dashboard', 1),
(5, '2016_08_07_151210_add_table_cms_logs', 1),
(6, '2016_08_07_151211_add_details_cms_logs', 1),
(7, '2016_08_07_152014_add_table_cms_privileges', 1),
(8, '2016_08_07_152214_add_table_cms_privileges_roles', 1),
(9, '2016_08_07_152320_add_table_cms_settings', 1),
(10, '2016_08_07_152421_add_table_cms_users', 1),
(11, '2016_08_07_154624_add_table_cms_menus_privileges', 1),
(12, '2016_08_07_154624_add_table_cms_moduls', 1),
(13, '2016_08_17_225409_add_status_cms_users', 1),
(14, '2016_08_20_125418_add_table_cms_notifications', 1),
(15, '2016_09_04_033706_add_table_cms_email_queues', 1),
(16, '2016_09_16_035347_add_group_setting', 1),
(17, '2016_09_16_045425_add_label_setting', 1),
(18, '2016_09_17_104728_create_nullable_cms_apicustom', 1),
(19, '2016_10_01_141740_add_method_type_apicustom', 1),
(20, '2016_10_01_141846_add_parameters_apicustom', 1),
(21, '2016_10_01_141934_add_responses_apicustom', 1),
(22, '2016_10_01_144826_add_table_apikey', 1),
(23, '2016_11_14_141657_create_cms_menus', 1),
(24, '2016_11_15_132350_create_cms_email_templates', 1),
(25, '2016_11_15_190410_create_cms_statistics', 1),
(26, '2016_11_17_102740_create_cms_statistic_components', 1),
(27, '2017_06_06_164501_add_deleted_at_cms_moduls', 1),
(28, '2019_08_19_000000_create_failed_jobs_table', 1),
(29, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(30, '2024_02_02_063951_create_orders_table', 2),
(31, '2024_02_02_071126_create_statuses_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int UNSIGNED NOT NULL,
  `status` int DEFAULT NULL,
  `prod_id` int DEFAULT NULL,
  `user_id` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `drop_address` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quantity` int DEFAULT NULL,
  `price` decimal(18,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sales_tbl`
--

CREATE TABLE `sales_tbl` (
  `id` int NOT NULL,
  `inv_id` int DEFAULT NULL,
  `payment_type` varchar(191) DEFAULT NULL,
  `name_of_customer` varchar(191) DEFAULT NULL,
  `quantity` int DEFAULT NULL,
  `price` decimal(15,2) DEFAULT NULL,
  `date_of_purchase` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `store_id` int DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sales_tbl`
--

INSERT INTO `sales_tbl` (`id`, `inv_id`, `payment_type`, `name_of_customer`, `quantity`, `price`, `date_of_purchase`, `store_id`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(1, 5, 'GCASH', 'Customer 1', 2, '1000.00', '2023-06-11 16:00:00', 1, 2, '2023-06-12 00:27:48', NULL, NULL),
(2, 6, 'GCASH', 'Customer 2', 5, '500.00', '2023-06-11 16:00:00', 2, 3, '2023-06-12 00:29:50', NULL, NULL),
(3, 1, 'GCASH', 'Cus 3', 1, '100.00', '2023-06-11 16:00:00', 1, 2, '2023-06-12 00:59:18', NULL, NULL),
(4, 1, 'GCASH', 'Customer 5', 2, '20400.00', '2023-06-12 16:00:00', 1, 2, '2023-06-13 01:26:23', NULL, NULL),
(5, 2, 'GCASH', 'Customer 7', 5, '1000.00', '2023-06-12 16:00:00', 1, 2, '2023-06-13 01:56:32', NULL, NULL),
(13, 1, 'GCASH', 'John Doe', 2, '200.00', '2023-06-13 16:00:00', 1, 2, '2023-06-14 01:20:44', NULL, '2023-06-14 01:20:44'),
(14, 4, 'BANK', 'Jenny Doe', 5, '500.00', '2023-06-13 16:00:00', 1, 2, '2023-06-14 01:20:44', NULL, '2023-06-14 01:20:44'),
(15, 1, 'GCASH', 'John Doe', 5, '500.00', '2023-06-13 16:00:00', 1, 2, '2023-06-14 01:27:34', NULL, '2023-06-14 01:27:34'),
(16, 4, 'BANK', 'Jenny Doe', 5, '500.00', '2023-06-13 16:00:00', 1, 2, '2023-06-14 01:27:34', NULL, '2023-06-14 01:27:34'),
(17, 1, 'GCASH', 'Jack Doe', 2, '200.00', '2023-06-13 16:00:00', 1, 2, '2023-06-14 01:40:45', NULL, NULL),
(18, 6, 'GCASH', 'John Doe', 5, '500.00', '2023-06-13 16:00:00', 2, 3, '2023-06-14 02:01:26', NULL, '2023-06-14 02:01:26'),
(19, 9, 'BANK', 'Jenny Doe', 5, '500.00', '2023-06-13 16:00:00', 2, 3, '2023-06-14 02:01:26', NULL, '2023-06-14 02:01:26'),
(20, 7, 'GCASH', 'John Doe', 1, '100.00', '2023-06-13 16:00:00', 2, 3, '2023-06-14 02:03:41', NULL, '2023-06-14 02:03:41'),
(21, 9, 'BANK', 'Jenny Doe', 1, '100.00', '2023-06-13 16:00:00', 2, 3, '2023-06-14 02:03:41', NULL, '2023-06-14 02:03:41'),
(22, 1, 'CASH', 'Jack DOE', 3, '300.00', '2023-06-17 16:00:00', 1, 2, '2023-06-17 21:44:23', NULL, NULL),
(23, 7, 'CASH', 'Jenny Doe', 5, '1000.00', '2023-06-17 16:00:00', 2, 3, '2023-06-17 21:53:00', NULL, NULL),
(24, 10, 'CASH', 'Customer 2', 1, '500.00', '2023-06-17 16:00:00', 2, 3, '2023-06-17 21:59:01', NULL, NULL),
(25, 10, 'GCASH', 'John Doe', 1, '500.00', '2023-06-17 16:00:00', 2, 3, '2023-06-17 22:01:22', NULL, '2023-06-17 22:01:22'),
(26, 8, 'CASH', 'John Doe 2', 1, '300.00', '2023-06-17 16:00:00', 2, 3, '2023-06-17 22:01:22', NULL, '2023-06-17 22:01:22'),
(27, 4, 'CASH', 'A1 Doe', 1, '400.00', '2023-06-19 16:00:00', 1, 2, '2023-06-19 21:20:40', NULL, NULL),
(28, 5, 'CASH', 'A2 Doe', 2, '1000.00', '2023-06-20 05:28:01', 1, 2, '2023-06-19 21:27:04', NULL, NULL),
(29, 5, 'CASH', 'A3 Doe', 2, '1000.00', '2023-06-20 05:46:51', 1, 2, '2023-06-19 21:46:51', NULL, NULL),
(30, 4, 'CASH', 'Iron Doe', 2, '800.00', NULL, 1, 2, '2023-06-21 23:00:11', NULL, NULL),
(31, 1, 'CASH', 'Jack Doe', 2, '200.00', NULL, 1, 2, '2023-06-21 23:28:23', NULL, NULL),
(32, 2, 'CASH', 'Jack Doe', 5, '1000.00', '2023-06-22 07:29:31', 1, 2, '2023-06-21 23:29:31', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `statuses`
--

CREATE TABLE `statuses` (
  `id` bigint UNSIGNED NOT NULL,
  `status_description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `statuses`
--

INSERT INTO `statuses` (`id`, `status_description`, `type`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'Pending', 'Order', NULL, NULL, '2024-02-01 23:16:23', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `stores`
--

CREATE TABLE `stores` (
  `id` int NOT NULL,
  `store_name` varchar(191) DEFAULT NULL,
  `status` varchar(191) DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stores`
--

INSERT INTO `stores` (`id`, `store_name`, `status`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(1, 'Store 1', 'ACTIVE', NULL, '2023-06-12 04:05:34', NULL, NULL),
(2, 'Store 2', 'ACTIVE', NULL, '2023-06-12 04:05:34', NULL, '2023-06-16 02:08:10');

-- --------------------------------------------------------

--
-- Table structure for table `sub_masterfile_flower_type`
--

CREATE TABLE `sub_masterfile_flower_type` (
  `id` int NOT NULL,
  `description` varchar(191) DEFAULT NULL,
  `status` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `created_by` int NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `updated_by` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sub_masterfile_flower_type`
--

INSERT INTO `sub_masterfile_flower_type` (`id`, `description`, `status`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 'Fresh Flowers', 'ACTIVE', '2023-06-12 03:42:32', 0, '0000-00-00 00:00:00', 0),
(2, 'Dried Flowers', 'ACTIVE', '2023-06-12 03:42:32', 0, '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `sub_masterfile_payment_type`
--

CREATE TABLE `sub_masterfile_payment_type` (
  `id` int NOT NULL,
  `payment_name` varchar(191) DEFAULT NULL,
  `status` varchar(191) DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_by` int DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sub_masterfile_payment_type`
--

INSERT INTO `sub_masterfile_payment_type` (`id`, `payment_name`, `status`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(1, 'GCASH', 'ACTIVE', 1, '2023-06-12 06:58:27', NULL, NULL),
(2, 'BANK', 'ACTIVE', 1, '2023-06-12 06:58:27', NULL, NULL),
(3, 'CREDITS', 'ACTIVE', 1, '2023-06-12 06:59:06', NULL, NULL),
(4, 'CASH', 'ACTIVE', 1, '2023-06-17 21:43:47', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `username` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Mozze', 'mozze@gmail.com', NULL, '$2y$10$4TaDSSrNbsNEh8sAATVo/eBea62B9HnvjPeVXBMKwtLbHOz2yzZz.', NULL, '2023-06-06 19:35:34', '2023-06-06 19:35:34'),
(2, 'Marvs', 'marvs@digits.ph', NULL, '$2y$10$/l7OX1.rTSdr9sJbKJFAw.VNcho4RY6y62pKZb40ITlliYTsiggqK', NULL, '2023-06-07 20:45:13', '2023-06-07 20:45:13'),
(3, 'mozze mm', 'marvinmosico@digits.ph', NULL, '$2y$10$1VgNPLPp8Q86DDEOHEkfCOGl5735KXZQJgy6gUeXUwIQdXWOioGZO', NULL, '2023-07-02 00:25:40', '2023-07-02 00:25:40');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `add_to_cart_tbl`
--
ALTER TABLE `add_to_cart_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cms_apicustom`
--
ALTER TABLE `cms_apicustom`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cms_apikey`
--
ALTER TABLE `cms_apikey`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cms_dashboard`
--
ALTER TABLE `cms_dashboard`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cms_email_queues`
--
ALTER TABLE `cms_email_queues`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cms_email_templates`
--
ALTER TABLE `cms_email_templates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cms_logs`
--
ALTER TABLE `cms_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cms_menus`
--
ALTER TABLE `cms_menus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cms_menus_privileges`
--
ALTER TABLE `cms_menus_privileges`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cms_moduls`
--
ALTER TABLE `cms_moduls`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cms_notifications`
--
ALTER TABLE `cms_notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cms_privileges`
--
ALTER TABLE `cms_privileges`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cms_privileges_roles`
--
ALTER TABLE `cms_privileges_roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cms_settings`
--
ALTER TABLE `cms_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cms_statistics`
--
ALTER TABLE `cms_statistics`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cms_statistic_components`
--
ALTER TABLE `cms_statistic_components`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cms_users`
--
ALTER TABLE `cms_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `inventory_image`
--
ALTER TABLE `inventory_image`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inventory_tbl`
--
ALTER TABLE `inventory_tbl`
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
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `sales_tbl`
--
ALTER TABLE `sales_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `statuses`
--
ALTER TABLE `statuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stores`
--
ALTER TABLE `stores`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_masterfile_flower_type`
--
ALTER TABLE `sub_masterfile_flower_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_masterfile_payment_type`
--
ALTER TABLE `sub_masterfile_payment_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `add_to_cart_tbl`
--
ALTER TABLE `add_to_cart_tbl`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `cms_apicustom`
--
ALTER TABLE `cms_apicustom`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cms_apikey`
--
ALTER TABLE `cms_apikey`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cms_dashboard`
--
ALTER TABLE `cms_dashboard`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cms_email_queues`
--
ALTER TABLE `cms_email_queues`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cms_email_templates`
--
ALTER TABLE `cms_email_templates`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cms_logs`
--
ALTER TABLE `cms_logs`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=159;

--
-- AUTO_INCREMENT for table `cms_menus`
--
ALTER TABLE `cms_menus`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `cms_menus_privileges`
--
ALTER TABLE `cms_menus_privileges`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `cms_moduls`
--
ALTER TABLE `cms_moduls`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `cms_notifications`
--
ALTER TABLE `cms_notifications`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cms_privileges`
--
ALTER TABLE `cms_privileges`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cms_privileges_roles`
--
ALTER TABLE `cms_privileges_roles`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `cms_settings`
--
ALTER TABLE `cms_settings`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `cms_statistics`
--
ALTER TABLE `cms_statistics`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cms_statistic_components`
--
ALTER TABLE `cms_statistic_components`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cms_users`
--
ALTER TABLE `cms_users`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inventory_image`
--
ALTER TABLE `inventory_image`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `inventory_tbl`
--
ALTER TABLE `inventory_tbl`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sales_tbl`
--
ALTER TABLE `sales_tbl`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `statuses`
--
ALTER TABLE `statuses`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `stores`
--
ALTER TABLE `stores`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sub_masterfile_flower_type`
--
ALTER TABLE `sub_masterfile_flower_type`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sub_masterfile_payment_type`
--
ALTER TABLE `sub_masterfile_payment_type`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
