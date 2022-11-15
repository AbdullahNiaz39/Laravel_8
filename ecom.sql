-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 26, 2021 at 12:02 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecom`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 'ali@gmail.com', 'ali', '2021-09-06 11:25:54', '2021-09-09 11:25:54');

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL,
  `is_home` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`, `image`, `status`, `is_home`, `created_at`, `updated_at`) VALUES
(1, 'Ali garment', '61444524d182d.jpg', 1, 1, '2021-09-15 13:21:54', '2021-09-18 18:10:44'),
(5, 'Speedo', '6148618082148.png', 1, 1, '2021-09-20 17:25:04', '2021-09-20 17:25:04'),
(6, 'justuce', '6148619835c03.jpg', 1, 1, '2021-09-20 17:25:28', '2021-09-20 17:25:28'),
(7, 'TBS', '614861acef57f.png', 1, 1, '2021-09-20 17:25:48', '2021-09-20 17:25:48');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_type` enum('Reg','Not-Reg') NOT NULL,
  `qty` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_attr_id` int(11) NOT NULL,
  `added_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `user_type`, `qty`, `product_id`, `product_attr_id`, `added_on`) VALUES
(69, 1, 'Reg', 0, 16, 28, '2021-10-15 11:12:21'),
(71, 1, 'Reg', 0, 17, 30, '2021-10-15 11:12:48'),
(74, 643189556, 'Not-Reg', 1, 18, 31, '2021-10-15 12:04:46'),
(84, 31, 'Reg', 1, 18, 31, '2021-11-19 10:20:48'),
(91, 30, 'Reg', 1, 19, 32, '2021-11-22 06:46:54'),
(92, 30, 'Reg', 1, 16, 28, '2021-11-22 06:46:58'),
(93, 346639545, 'Not-Reg', 2, 17, 30, '2021-11-25 10:32:16');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_category_id` int(11) NOT NULL,
  `category_image` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_home` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_name`, `category_slug`, `parent_category_id`, `category_image`, `is_home`, `status`, `created_at`, `updated_at`) VALUES
(8, 'For Mens', 'Laraveldevelop', 0, '1631960509.jpg', 1, 1, '2021-09-10 13:01:20', '2021-10-05 00:59:15'),
(14, 'Women', 'women', 0, '1632471335.jpg', 1, 1, '2021-09-17 14:10:18', '2021-09-24 15:15:35'),
(15, 'Sports', '22s', 8, '1632719743.jpg', 1, 1, '2021-09-20 13:32:46', '2021-10-05 01:11:30'),
(16, 'fashion jeans', 'good', 14, '1632119602.jpg', 1, 1, '2021-09-20 13:33:22', '2021-09-27 12:14:50');

-- --------------------------------------------------------

--
-- Table structure for table `colors`
--

CREATE TABLE `colors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `color` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `colors`
--

INSERT INTO `colors` (`id`, `color`, `status`, `created_at`, `updated_at`) VALUES
(1, 'green', 1, '2021-09-10 18:43:03', '2021-09-27 12:38:47'),
(2, 'blue', 1, '2021-09-10 18:52:31', '2021-09-27 12:38:56'),
(3, 'black', 1, '2021-09-13 13:42:06', '2021-09-27 13:32:06');

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('value','per') COLLATE utf8mb4_unicode_ci NOT NULL,
  `min_order_amt` int(11) NOT NULL,
  `is_one_time` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `coupons`
--

INSERT INTO `coupons` (`id`, `title`, `code`, `value`, `type`, `min_order_amt`, `is_one_time`, `status`, `created_at`, `updated_at`) VALUES
(2, 'Jans Coupon', 'Jan2020', '45', 'per', 200, 0, 1, '2021-09-10 16:24:35', '2021-09-16 13:57:21'),
(4, 'new', 'Hp303', '15\n', 'value', 500, 0, 1, '2021-09-16 13:58:58', '2021-09-16 13:59:42');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zip` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gstin` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_verify` int(11) NOT NULL,
  `rand_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `is_forgot_password` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `email`, `mobile`, `password`, `address`, `city`, `state`, `zip`, `company`, `gstin`, `is_verify`, `rand_id`, `status`, `is_forgot_password`, `created_at`, `updated_at`) VALUES
(1, 'Alifarhan', 'alikhan@gmail.com', '03909883343', 'ali123', 'address1', 'islamabad', 'islam', '111222', 'It vision', 'asaa', 0, '', 1, 0, NULL, '2021-09-17 17:19:11'),
(20, 'shoaib', 'haider@gmail.com', '03123456789', 'eyJpdiI6Im9WV3gzNHlXbk42VFM3enlmNzhSY3c9PSIsInZhbHVlIjoicUpMQnptakVJbi9wdThIM3FlRU1Fdz09IiwibWFjIjoiNTIxM2M3NjRiYzdkZTVjODI4Y2JiNDM3OTliOWJiZWM0MjEzZmU4ODYxMmExMzM4MTk0MzExZjYzNTQ5ZDcyZSIsInRhZyI6IiJ9', NULL, NULL, NULL, NULL, NULL, NULL, 0, '', 1, 0, '2021-10-13 13:31:22', '2021-10-13 13:31:22'),
(21, 'mohsin', 'ali11@gmail.com', '03123456789', 'eyJpdiI6Imw0TlhsKzlGUGxFUVRQaUhyUmRZQ2c9PSIsInZhbHVlIjoiL1FycWNNeTQ4UFhlQkpzZklteWNDdz09IiwibWFjIjoiZGNlNDIwYjRiNzJiOWVlMWEyNzQ0MDRjNTc5Mzc1MDg2YjA4MmJkZmFkNDE3NGVmZjFhMjdiMDkxZTU0ZWUwYiIsInRhZyI6IiJ9', NULL, NULL, NULL, NULL, NULL, NULL, 0, '', 1, 0, '2021-10-14 13:49:21', '2021-10-14 13:49:21'),
(30, 'mohsin', 'khanreus89@gmail.com', '03408099099', 'eyJpdiI6IlJVZUx6V1NKR0UrL2FraFhOT2k3dFE9PSIsInZhbHVlIjoiSGs0S3VrekRzM25weWlnT042QWJvdz09IiwibWFjIjoiMTY5ZDQ2MzRkOTE0MjY0YThhMmRhODkzNDliZGYwNjE0Y2I4YmUyOWFiOTU4MWQ2NWIzYTdmMTMzYzI1MDQxZSIsInRhZyI6IiJ9', NULL, NULL, NULL, NULL, NULL, NULL, 1, '842091784', 1, 1, '2021-10-14 15:24:54', '2021-10-14 15:24:54'),
(31, 'Abdullah Niaz', 'aall@gmail.com', '03408088192', 'eyJpdiI6Ik1BcThEZlJicUpkd3VpRzhWbWE2Q3c9PSIsInZhbHVlIjoiQmVxbDZoaTJhWktSV0xjQXpMWkVmQT09IiwibWFjIjoiODAwMTBmMzI0MjUxMDkxZjdkMGM1ZDE5M2I0MGQxZTEyZDg1OWZhMjgzNzMzNDlmYWE3NDk3NzczMzY2MTExMSIsInRhZyI6IiJ9', NULL, NULL, NULL, NULL, NULL, NULL, 1, '226606500', 1, 0, '2021-11-19 07:04:24', '2021-11-19 07:04:24'),
(32, 'Abdullah Niaz', 'aavbvbll@gmail.com', '03408088192', 'eyJpdiI6IkFtU2p6VFR1NkZGc0xZbXU3ai9nS2c9PSIsInZhbHVlIjoiZnJxNTBURTU5SGxIMWNSSVNtNTZzUT09IiwibWFjIjoiMzY1ZmMyOWVlNDVkMmE0NTI0MWY1OGE1NzdlOTcyNGNmODQwYTc3Nzg2YjNiZDRlZTNhNmRjNzRlYmMwZjRjZSIsInRhZyI6IiJ9', NULL, NULL, NULL, NULL, NULL, NULL, 1, '764961397', 1, 0, '2021-11-19 07:04:57', '2021-11-19 07:04:57'),
(33, 'dsfsdf', 'khanreus8werwer9@gmail.com', '2344535553', 'eyJpdiI6Ik11QmtwdUhGdVVMSFIyNERBWVJ2ckE9PSIsInZhbHVlIjoiWUVoSW5aVnJweXYvRlZ1QktwQ1lNdz09IiwibWFjIjoiMmNiZThhNWNmNmM1YjAyN2E0MWU0ZjVmZTRlMDliNTM5NjYxZWYxYjVmN2M4Y2JlNGUxNWEzNjQ4YzU2NDg0NSIsInRhZyI6IiJ9', NULL, NULL, NULL, NULL, NULL, NULL, 1, '668066360', 1, 0, '2021-11-20 01:36:36', '2021-11-20 01:36:36'),
(34, 'dfdfgsg', 'khanreusasdasd89@gmail.com', '2344535553', 'eyJpdiI6Ik5BMWtHME84Z0JObjN4RG1GSThXZ2c9PSIsInZhbHVlIjoiNzJJQWhuUjh6cmxaTmF0Zm1uN0M0Zz09IiwibWFjIjoiMjYyNTEyZjRlMzdiMWYyNzI2YmY4MTUyYjJhZDc0YmYyM2ZmNzNiMTAyYzYxYzI3YWYwMmNhMzJmM2I4MjJmNSIsInRhZyI6IiJ9', 'dfgfdgdfg', 'Jauharabad', 'Punjab', '41200', NULL, NULL, 1, '669050689', 1, 0, '2021-11-20 01:59:46', '2021-11-20 01:59:46'),
(35, 'dfdfgsg', 'khanreusasdsdfsdfsdfasd89@gmail.com', '2344535553', 'eyJpdiI6IlA2UDdDMk1PUGJCcysvL3dCcHJnTkE9PSIsInZhbHVlIjoicUZyTWhxa0I2WEJlWEpISlhFREt2QT09IiwibWFjIjoiZmI3ODFiMDI2MDAwMGM1Mzk3NGZlYzE1NGQxOTBlNDBhMGMzYTA4MmQ0Mzk0Y2JiNzY0ODAzNmU4Y2VhZDAxOCIsInRhZyI6IiJ9', 'dfgfdgdfg', 'Jauharabad', 'Punjab', '41200', NULL, NULL, 1, '913572318', 1, 0, '2021-11-20 02:00:15', '2021-11-20 02:00:15'),
(36, 'dfdfgsg', 'saasd89@gmail.com', '2344535553', 'eyJpdiI6InF4T0hxTmpXamJFQVNlcklNNVU3REE9PSIsInZhbHVlIjoiOS9ZVm9hWDhoTzlBUnljUkk5UGNnQT09IiwibWFjIjoiNjFhNjRlOTg0Y2Y2NWM5YzMyYTExNTRlODcwODFhYmI5ZTY0ZjhhNGIyYmE3NWZiZjlhOTYyZjMzMjk0MjI1YiIsInRhZyI6IiJ9', 'dfgfdgdfg', 'Jauharabad', 'Punjab', '41200', NULL, NULL, 1, '830856685', 1, 0, '2021-11-20 02:01:26', '2021-11-20 02:01:26'),
(37, 'dfdfgsg', 'ssd89@gmail.com', '2344535553', 'eyJpdiI6IndjT2tRYUtpSzBPRVgvVG5CSkNqM0E9PSIsInZhbHVlIjoiNWRtWGYvRE9JaFNVTVdMRzBYdjNydz09IiwibWFjIjoiZjM3MzRiNTcwYWNmZDgxYjQyYzI5ODBiODM1YTIyZjgyNDlmZDk0NDRkNGQ4MzJjODgzYzRmNTQ5ZDk0OTFjZSIsInRhZyI6IiJ9', 'dfgfdgdfg', 'Jauharabad', 'Punjab', '41200', NULL, NULL, 1, '483984355', 1, 0, '2021-11-20 02:01:48', '2021-11-20 02:01:48'),
(38, 'dfdfgsg', 'sssdfd89@gmail.com', '2344535553', 'eyJpdiI6IkJqNzdWOEZXODM0dEEwZXl5ckw4SFE9PSIsInZhbHVlIjoiaGNKVDBnQ0JEdjloOHBkdW1qekRwUT09IiwibWFjIjoiZjBhOTcxMTRiNWZkZTg1MTNjNTgzMDI2NzNlMzIzMjZjMmQ2NjFiNGVjOGU0YWM3MTgxNzc4ODE4OTQyYWJmNiIsInRhZyI6IiJ9', 'dfgfdgdfg', 'Jauharabad', 'Punjab', '41200', NULL, NULL, 1, '539465616', 1, 0, '2021-11-20 02:07:43', '2021-11-20 02:07:43'),
(39, 'dfdfgsg', 'ssssddfd89@gmail.com', '2344535553', 'eyJpdiI6IkxIN0pWeFlJZlQ5bjZ0ZFBVTFp5WVE9PSIsInZhbHVlIjoia3RkZjFoYWhDOS9pY3h2UzM2aWRvZz09IiwibWFjIjoiZWRkMDU1N2FkMTc2NTdlOWU5OGI0MjVlODVhZDgzOWQ4MzQyZGE0YTc0M2ZmZWYyYWUwMjdjN2M0MWYzYjYwOSIsInRhZyI6IiJ9', 'dfgfdgdfg', 'Jauharabad', 'Punjab', '41200', NULL, NULL, 1, '696019711', 1, 0, '2021-11-20 02:10:40', '2021-11-20 02:10:40'),
(40, 'asd', 'khanrsdfdsfeus89@gmail.com', '2344535553', 'eyJpdiI6IkdZcG52K0ZFSGhWUlo5SURMaDdFd3c9PSIsInZhbHVlIjoiVWdLSWhnb3lOSTVWNGNLNkNPMkhRZz09IiwibWFjIjoiYThjZTczMmZhZWZlODFlZTFkYmJhODA5ZWJmYzE0NWE4OWEwYjYyYjUwZDViNWQyYTQ2ODEwZTViNWU0MzQ5YSIsInRhZyI6IiJ9', 'dfgfdgdfg', 'Jauharabad', 'Punjab', '41200', NULL, NULL, 1, '160736682', 1, 0, '2021-11-20 02:13:20', '2021-11-20 02:13:20'),
(41, 'asd', 'khanddffeus89@gmail.com', '2344535553', 'eyJpdiI6IkMrVlVaTVVzNlExaHc3amdGMDBUUXc9PSIsInZhbHVlIjoiNzZxb1R1THdkSE5OSE9penBhai84UT09IiwibWFjIjoiNmE1YjhjMTM5NmRiYmU2MmUxODRmMDkyOWFiNTRlZDA2M2EwNjVhOTRmZDllNTg3NTM1MTEwOTExODY1YjUwZSIsInRhZyI6IiJ9', 'dfgfdgdfg', 'Jauharabad', 'Punjab', '41200', NULL, NULL, 1, '225515823', 1, 0, '2021-11-20 02:22:06', '2021-11-20 02:22:06'),
(42, 'asd', 'kharrdus89@gmail.com', '2344535553', 'eyJpdiI6IkhzRSsyb1BWdWJ1MzdTUDJGZm5ReEE9PSIsInZhbHVlIjoiYkhpellzN1JNMTM3dkVma0ZSMkVtUT09IiwibWFjIjoiZDgwNGYwNzY1YTI3NTAyYTNiZTZiNzM4NzAxMmExMWU0Zjk4Yzg5MDJjNzY0ODI2NDEzMGQ5MDFkNGUxYTQ0OSIsInRhZyI6IiJ9', 'dfgfdgdfg', 'Jauharabad', 'Punjab', '41200', NULL, NULL, 1, '651252491', 1, 0, '2021-11-20 02:23:03', '2021-11-20 02:23:03');

-- --------------------------------------------------------

--
-- Table structure for table `home_banners`
--

CREATE TABLE `home_banners` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `btn_text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `btn_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `home_banners`
--

INSERT INTO `home_banners` (`id`, `image`, `btn_text`, `btn_link`, `status`, `created_at`, `updated_at`) VALUES
(1, '1632305300.jpg', 'Shop Now', 'https://www.google.com', 1, '2021-09-22 17:06:04', '2021-09-22 17:08:20'),
(2, '1632305786.jpg', NULL, NULL, 1, '2021-09-22 17:16:26', '2021-09-22 17:16:26'),
(3, '1632306472.jpg', NULL, NULL, 1, '2021-09-22 17:27:52', '2021-09-22 17:27:52'),
(4, '1632306823.jpg', NULL, NULL, 1, '2021-09-22 17:33:43', '2021-09-22 17:33:43'),
(5, '1632306978.jpg', NULL, NULL, 1, '2021-09-22 17:36:18', '2021-09-22 17:36:18');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(2, '2021_09_06_051415_create_admins_table', 1),
(4, '2021_09_06_162304_create_categories_table', 2),
(5, '2021_09_10_064845_create_coupons_table', 3),
(6, '2021_09_10_101715_create_sizes_table', 4),
(7, '2021_09_10_111319_create_colors_table', 5),
(8, '2021_09_11_052001_create_products_table', 6),
(9, '2021_09_11_105229_create_products_attrs_table', 7),
(10, '2021_09_15_051744_create_brands_table', 8),
(11, '2021_09_16_093302_create_taxes_table', 9),
(12, '2021_09_17_080050_create_customers_table', 10),
(13, '2021_09_22_075519_create_home_banners_table', 11);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `customers_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mobile` varchar(50) NOT NULL,
  `address` varchar(500) NOT NULL,
  `city` varchar(20) NOT NULL,
  `zip` varchar(20) NOT NULL,
  `coupon_code` varchar(20) DEFAULT NULL,
  `state` varchar(50) NOT NULL,
  `coupon_value` int(11) NOT NULL,
  `order_status` int(11) NOT NULL,
  `payment_type` enum('COD','Gateway') NOT NULL,
  `payment_status` varchar(250) NOT NULL,
  `payment_id` varchar(255) DEFAULT NULL,
  `txn_id` varchar(100) DEFAULT NULL,
  `total_amt` int(11) NOT NULL,
  `track_detail` varchar(200) DEFAULT NULL,
  `added_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `customers_id`, `name`, `email`, `mobile`, `address`, `city`, `zip`, `coupon_code`, `state`, `coupon_value`, `order_status`, `payment_type`, `payment_status`, `payment_id`, `txn_id`, `total_amt`, `track_detail`, `added_on`) VALUES
(7, 30, 'mohsin', 'khanreus89@gmail.com', '03408099099', 'kk', 'california', '23', 'jp', 'ss', 0, 1, 'Gateway', 'Pending', NULL, NULL, 1250, 'the way of order is good', '2021-10-18 08:07:40'),
(8, 30, 'mohsin', 'khanreus89@gmail.com', '03408099099', 'SDFSDF', 'SDF', '23', 'hp303', 'ss', 0, 3, 'Gateway', 'Success', NULL, NULL, 1250, '', '2021-10-20 09:43:10'),
(9, 30, 'mohsin', 'khanreus89@gmail.com', '03408099099', 'word', 'california', '23', 'hp303', 'ss', 0, 2, 'Gateway', 'Fail', NULL, NULL, 1250, 'yes', '2021-10-20 09:59:08'),
(10, 30, 'mohsin', 'khanreus89@gmail.com', '03408099099', 'SDFSDF', 'SDF', '23', 'hp303', 'ss', 0, 1, 'Gateway', 'Success', NULL, NULL, 1060, '', '2021-10-20 10:20:12'),
(11, 30, 'mohsin', 'khanreus89@gmail.com', '03408099099', 'SDFSDF', 'SDF', '23', 'hp303asdasd', 'ss', 0, 1, 'Gateway', 'Pending', NULL, NULL, 1060, '', '2021-10-20 10:21:40'),
(12, 30, 'mohsin', 'khanreus89@gmail.com', '03408099099', 'kk', 'california', '23', 'hp303', 'ss', 15, 1, 'Gateway', 'Success', NULL, NULL, 1060, '', '2021-10-24 06:56:46'),
(13, 30, 'mohsin', 'khanreus89@gmail.com', '03408099099', 'kkp', 'A', '1', 'hp303', 'ss', 15, 1, 'COD', 'Pending', NULL, NULL, 1060, '', '2021-10-24 06:58:39'),
(14, 30, 'mohsin', 'khanreus89@gmail.com', '03408099099', 'SDFSDF', 'SDF', '23', 'hp303', 'ss', 15, 1, 'Gateway', 'Pending', NULL, NULL, 1060, '', '2021-10-24 13:52:03'),
(15, 30, 'mohsin', 'khanreus89@gmail.com', '03408099099', 'SDFSDF', 'SDF', '23', 'hp303', 'ss', 15, 1, 'Gateway', 'Pending', NULL, NULL, 1060, '', '2021-10-24 13:54:06'),
(16, 30, 'mohsin', 'khanreus89@gmail.com', '03408099099', 'SDFSDF', 'SDF', '23', 'hp303', 'ss', 15, 1, 'Gateway', 'Pending', NULL, NULL, 1060, '', '2021-10-24 14:02:03'),
(17, 30, 'mohsin', 'khanreus89@gmail.com', '03408099099', 'ss', 'sss', '41200', 'hp303', 'Punjab', 15, 1, 'Gateway', 'Pending', NULL, NULL, 1060, '', '2021-10-24 14:02:43'),
(18, 30, 'mohsin', 'khanreus89@gmail.com', '03408099099', 'SDFSDF', 'SDF', '23', 'hp303', 'ss', 15, 1, 'Gateway', 'Pending', NULL, NULL, 1060, '', '2021-10-24 14:03:09'),
(19, 30, 'mohsin', 'khanreus89@gmail.com', '03408099099', 'SDFSDF', 'SDF', '23', 'hp303', 'ss', 15, 1, 'Gateway', 'Pending', NULL, NULL, 1060, '', '2021-10-24 15:18:55'),
(20, 30, 'mohsin', 'khanreus89@gmail.com', '03408099099', 'SDFSDF', 'SDF', '23', 'hp303', 'ss', 15, 1, 'Gateway', 'Pending', NULL, NULL, 1060, '', '2021-10-24 15:30:21'),
(21, 30, 'mohsin', 'khanreus89@gmail.com', '03408099099', 'SDFSDF', 'SDF', '23', 'hp303', 'ss', 15, 1, 'COD', 'Pending', NULL, NULL, 1060, '', '2021-10-24 15:33:51'),
(22, 30, 'mohsin', 'khanreus89@gmail.com', '03408099099', 'word', 'california', '23', 'hp303', 'ss', 15, 1, 'COD', 'Pending', NULL, NULL, 1060, '', '2021-10-24 15:39:24'),
(23, 30, 'mohsin', 'khanreus89@gmail.com', '03408099099', 'SDFSDF', 'SDF', '23', 'hp303', 'ss', 15, 1, 'Gateway', 'Pending', NULL, NULL, 650, '', '2021-10-24 15:42:12'),
(24, 30, 'mohsin', 'khanreus89@gmail.com', '03408099099', 'SDFSDF', 'SDF', '23', 'hp303', 'ss', 15, 1, 'COD', 'Pending', NULL, NULL, 650, '', '2021-10-24 15:43:13'),
(25, 30, 'Abdullah Niaz', 'abdullahniaz39@gmail.com', '03408088192', 'House no 2-b New satellite town 2\r\n2', 'Jauharabad', '41200', 'hp303', 'Punjab', 15, 1, 'COD', 'Pending', NULL, NULL, 650, '', '2021-10-24 15:44:10'),
(26, 30, 'mohsin', 'khanreus89@gmail.com', '03408099099', 'SDFSDF', 'SDF', '23', 'hp303', 'ss', 15, 1, 'Gateway', 'Pending', NULL, NULL, 650, '', '2021-10-24 15:47:39'),
(27, 30, 'mohsin', 'khanreus89@gmail.com', '03408099099', 'SDFSDF', 'SDF', '23', 'hp303', 'ss', 15, 1, 'COD', 'Pending', NULL, NULL, 650, '', '2021-10-24 15:48:32'),
(28, 30, 'mohsin', 'khanreus89@gmail.com', '03408099099', 'SDFSDF', 'SDF', '23', 'hp303', 'ss', 15, 1, 'COD', 'Pending', NULL, NULL, 7683, '', '2021-10-24 15:50:33'),
(29, 30, 'mohsin', 'khanreus89@gmail.com', '03408099099', 'word', 'california', '23', 'hp303', 'ss', 15, 1, 'COD', 'Pending', NULL, NULL, 7723, '', '2021-11-14 12:15:41'),
(30, 30, 'mohsin', 'khanreus89@gmail.com', '03408099099', 'SDFSDF', 'SDF', '23', 'hp303', 'ss', 15, 1, 'COD', 'Pending', NULL, NULL, 600, '', '2021-11-14 12:34:32'),
(31, 33, 'dsfsdf', 'khanreus8werwer9@gmail.com', '2344535553', 'dfgfdgdfg', 'Jauharabad', '41200', NULL, 'Punjab', 0, 1, 'COD', 'Pending', NULL, NULL, 600, '', '2021-11-20 06:38:55'),
(32, 33, 'Abdullah Niaz', 'abdullahniaz39@gmail.com', '03408088192', 'House no 2-b New satellite town 2\r\n2', 'Jauharabad', '41200', NULL, 'Punjab', 0, 1, 'COD', 'Pending', NULL, NULL, 7033, '', '2021-11-20 06:40:30'),
(33, 42, 'asd', 'kharrdus89@gmail.com', '2344535553', 'dfgfdgdfg', 'Jauharabad', '41200', NULL, 'Punjab', 0, 1, 'COD', 'Pending', NULL, NULL, 34, '', '2021-11-20 07:23:03'),
(34, 30, 'mohsin', 'khanreus89@gmail.com', '03408099099', 'asd', 'sdf', 'qeqwe', 'hp303', 'sdf', 15, 1, 'COD', 'Pending', NULL, NULL, 1480, '', '2021-11-20 09:55:31');

-- --------------------------------------------------------

--
-- Table structure for table `orders_detail`
--

CREATE TABLE `orders_detail` (
  `id` int(11) NOT NULL,
  `orders_id` int(11) NOT NULL,
  `products_id` int(11) NOT NULL,
  `products_attrs_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders_detail`
--

INSERT INTO `orders_detail` (`id`, `orders_id`, `products_id`, `products_attrs_id`, `qty`, `price`) VALUES
(3, 7, 18, 31, 1, 650),
(4, 7, 19, 32, 1, 600),
(5, 8, 18, 31, 1, 650),
(6, 8, 19, 32, 1, 600),
(7, 9, 18, 31, 1, 650),
(8, 9, 19, 32, 1, 600),
(9, 10, 17, 30, 2, 230),
(10, 10, 19, 33, 1, 600),
(11, 11, 17, 30, 2, 230),
(12, 11, 19, 33, 1, 600),
(13, 12, 17, 30, 2, 230),
(14, 12, 19, 33, 1, 600),
(15, 13, 17, 30, 2, 230),
(16, 13, 19, 33, 1, 600),
(17, 14, 17, 30, 2, 230),
(18, 14, 19, 33, 1, 600),
(19, 15, 17, 30, 2, 230),
(20, 15, 19, 33, 1, 600),
(21, 16, 17, 30, 2, 230),
(22, 16, 19, 33, 1, 600),
(23, 17, 17, 30, 2, 230),
(24, 17, 19, 33, 1, 600),
(25, 18, 17, 30, 2, 230),
(26, 18, 19, 33, 1, 600),
(27, 19, 17, 30, 2, 230),
(28, 19, 19, 33, 1, 600),
(29, 20, 17, 30, 2, 230),
(30, 20, 19, 33, 1, 600),
(31, 21, 17, 30, 2, 230),
(32, 21, 19, 33, 1, 600),
(33, 22, 17, 30, 2, 230),
(34, 22, 19, 33, 1, 600),
(35, 23, 18, 31, 1, 650),
(36, 24, 18, 31, 1, 650),
(37, 25, 18, 31, 1, 650),
(38, 26, 18, 31, 1, 650),
(39, 27, 18, 31, 1, 650),
(40, 28, 18, 31, 1, 650),
(41, 28, 16, 28, 1, 7033),
(42, 29, 17, 30, 3, 230),
(43, 29, 16, 28, 1, 7033),
(44, 30, 19, 32, 1, 600),
(45, 31, 19, 32, 1, 600),
(46, 32, 16, 28, 1, 7033),
(47, 33, 16, 29, 1, 34),
(48, 34, 19, 32, 1, 600),
(49, 34, 18, 31, 1, 650),
(50, 34, 17, 30, 1, 230);

-- --------------------------------------------------------

--
-- Table structure for table `orders_status`
--

CREATE TABLE `orders_status` (
  `id` int(11) NOT NULL,
  `order_status` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders_status`
--

INSERT INTO `orders_status` (`id`, `order_status`) VALUES
(1, 'Placed'),
(2, 'On the Way'),
(3, 'Delivered');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` int(11) NOT NULL,
  `slug` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `brand` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_desc` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `desc` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `keywords` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `technical_specs` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `uses` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `warranty` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `lead_time` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tax_id` int(11) NOT NULL,
  `is_promo` int(11) NOT NULL,
  `is_featured` int(11) NOT NULL,
  `is_discounted` int(11) NOT NULL,
  `is_trending` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `slug`, `name`, `image`, `brand`, `model`, `short_desc`, `desc`, `keywords`, `technical_specs`, `uses`, `warranty`, `status`, `lead_time`, `tax_id`, `is_promo`, `is_featured`, `is_discounted`, `is_trending`, `created_at`, `updated_at`) VALUES
(16, 14, 'newss', 'dress Women', '1632125062.jpg', '1', '2099s', 'sdf', '<p>asdasd</p>', 'asd', 'wliaa', 'sss', 'dsf', 1, '343', 1, 1, 1, 1, 1, '2021-09-17 14:43:52', '2021-09-20 15:04:22'),
(17, 14, 'shirt1122', 'shirt', '1632719913.jpg', '1', 'lewis', 'sss', '<p>asddafaf</p>', 'asf', 'ssasd', 'asdfa', 'sssaaa', 1, '223', 1, 1, 0, 1, 1, '2021-09-20 12:51:29', '2021-09-27 12:18:33'),
(18, 15, 'ssr3r', 'TeaShirt', '1632124150.png', '1', '24', 'cotton wool', '<p>sddf</p>', 'fdf', 'cotton', 'well', '2', 1, '23', 1, 1, 1, 1, 1, '2021-09-20 14:49:10', '2021-10-05 01:15:02'),
(19, 14, 'wku', 'T-shirt', '1632724236.jpg', '7', 'T-shirt with half Sleeps', 'Well designed circle calf', '<p>Well designed</p>', 'T-shirt,', 'Cotton,mutliple color,best prices shirt', 'normal walk, you can dress behind of blue causal coat', '1- month', 1, 'Available in stock', 1, 1, 1, 1, 1, '2021-09-27 13:30:36', '2021-09-27 13:30:36');

-- --------------------------------------------------------

--
-- Table structure for table `products_attrs`
--

CREATE TABLE `products_attrs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` int(11) NOT NULL,
  `sku` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `attr_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mrp` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `size_id` int(11) NOT NULL,
  `color_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products_attrs`
--

INSERT INTO `products_attrs` (`id`, `product_id`, `sku`, `attr_image`, `mrp`, `price`, `qty`, `size_id`, `color_id`, `created_at`, `updated_at`) VALUES
(28, 16, 'ss22', '614448b14a3f6.jpg', 100, 7033, 34, 3, 1, NULL, NULL),
(29, 16, 'w2', '614448cc48abd.jpg', 45, 34, 45, 1, 3, NULL, NULL),
(30, 17, 'sf22', '61482161e8a5b.jpg', 50, 230, 10, 1, 2, NULL, NULL),
(31, 18, '23fd', '61483cf62a2c8.jpg', 560, 650, 1, 3, 2, NULL, NULL),
(32, 19, '2e', '6151650c43d35.jpg', 700, 600, 2, 3, 2, NULL, NULL),
(33, 19, '4e', '6151650c4f4cf.jpg', 700, 600, 2, 6, 3, NULL, NULL),
(34, 19, 's23', '6153ffc1ba3ba.jpg', 700, 600, 1, 3, 1, NULL, NULL),
(35, 18, '445kkk', '615b40937cdc0.jpg', 500, 600, 1, 4, 3, NULL, NULL),
(36, 14, 'ss22', '614448b14a3f6.jpg', 100, 7033, 34, 3, 1, NULL, NULL),
(37, 15, '23fd', '61483cf62a2c8.jpg', 560, 650, 1, 3, 2, NULL, NULL),
(38, 19, 'we2332', NULL, 33, 564, 2, 4, 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `images` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `images`) VALUES
(1, 1, '61443e0141181.jpg'),
(2, 4, '6140969219ce8.jpg'),
(14, 16, '61444738a00d6.jpg'),
(15, 17, '61482161eff8c.jpg'),
(16, 17, '6148216201ef6.jpg'),
(17, 17, '6148216209fe0.jpg'),
(18, 18, '61483cf637d8b.png'),
(19, 18, '61483cf647f5f.png'),
(20, 19, '6151650c598e2.jpg'),
(21, 19, '6151650c66fbd.jpg'),
(22, 19, '6151650c6d166.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `product_review`
--

CREATE TABLE `product_review` (
  `id` int(11) NOT NULL,
  `customers_id` int(11) NOT NULL,
  `products_id` int(11) NOT NULL,
  `rating` varchar(20) NOT NULL,
  `review` text NOT NULL,
  `status` int(11) NOT NULL,
  `added_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_review`
--

INSERT INTO `product_review` (`id`, `customers_id`, `products_id`, `rating`, `review`, `status`, `added_on`) VALUES
(1, 30, 19, 'Good', 'asdasdsda', 0, '2021-11-25 08:03:43'),
(2, 30, 19, 'Very Good', 'sssss', 1, '2021-11-25 08:01:27'),
(3, 30, 19, 'Very Good', 'wwwwww', 0, '2021-11-25 07:57:15'),
(4, 30, 19, 'Worst', 'wlll', 1, '2021-11-25 08:01:09');

-- --------------------------------------------------------

--
-- Table structure for table `sizes`
--

CREATE TABLE `sizes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `size` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sizes`
--

INSERT INTO `sizes` (`id`, `size`, `status`, `created_at`, `updated_at`) VALUES
(1, 'XS', 1, '2021-09-10 17:52:31', '2021-09-27 13:31:42'),
(3, 'S', 1, '2021-09-14 12:22:44', '2021-09-27 13:31:26'),
(4, 'M', 1, '2021-09-27 13:30:54', '2021-09-27 13:30:54'),
(5, 'L', 1, '2021-09-27 13:31:03', '2021-09-27 13:31:03'),
(6, 'XL', 1, '2021-09-27 13:31:17', '2021-09-27 13:31:17');

-- --------------------------------------------------------

--
-- Table structure for table `taxes`
--

CREATE TABLE `taxes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tax_desc` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tax_value` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `taxes`
--

INSERT INTO `taxes` (`id`, `tax_desc`, `tax_value`, `status`, `created_at`, `updated_at`) VALUES
(1, 'GST 20%', '345', 1, '2021-09-16 17:36:06', '2021-09-16 18:05:04');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `colors`
--
ALTER TABLE `colors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `home_banners`
--
ALTER TABLE `home_banners`
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
-- Indexes for table `orders_detail`
--
ALTER TABLE `orders_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders_status`
--
ALTER TABLE `orders_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products_attrs`
--
ALTER TABLE `products_attrs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_review`
--
ALTER TABLE `product_review`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sizes`
--
ALTER TABLE `sizes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `taxes`
--
ALTER TABLE `taxes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `colors`
--
ALTER TABLE `colors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `home_banners`
--
ALTER TABLE `home_banners`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `orders_detail`
--
ALTER TABLE `orders_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `orders_status`
--
ALTER TABLE `orders_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `products_attrs`
--
ALTER TABLE `products_attrs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `product_review`
--
ALTER TABLE `product_review`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sizes`
--
ALTER TABLE `sizes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `taxes`
--
ALTER TABLE `taxes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
