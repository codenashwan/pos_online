-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 13, 2020 at 11:56 AM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.3.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `market`
--

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2020_07_08_042043_sidebar', 2),
(3, '2020_07_08_085705_stocks', 3),
(4, '2020_07_08_090613_barcode', 4),
(5, '2020_07_08_125956_supplier', 5),
(6, '2020_07_08_200122_barcode', 6),
(7, '2020_07_10_183949_sold', 7);

-- --------------------------------------------------------

--
-- Table structure for table `sidebar`
--

CREATE TABLE `sidebar` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_ku` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dir` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sidebar`
--

INSERT INTO `sidebar` (`id`, `name`, `name_ku`, `dir`, `icon`, `created_at`, `updated_at`) VALUES
(1, 'Sale', 'فرۆشتن', 'sale', 'ion-bag', NULL, NULL),
(2, 'Sellers', 'فرۆشراوەکان', 'sellers', 'ion-clipboard', NULL, NULL),
(4, 'Buy', 'کڕین', 'buy', 'ion-ios-cart-outline', NULL, NULL),
(5, 'Expire', 'بەسەرچووەکان', 'expire', 'ion-ios-time-outline', NULL, NULL),
(6, 'Debt List', 'قەرزەکان', 'debt', 'ion-document-text', NULL, NULL),
(8, 'Not Left', 'کاڵا نەماوەکان', 'notleft', 'ion-battery-empty', NULL, NULL),
(9, 'Supplier', 'دابینکار', 'supplier', 'ion-android-bus', NULL, NULL),
(10, 'Cashier', 'زیادکردنی کاشێر', 'cashier', 'ion-ios-personadd-outline', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sold`
--

CREATE TABLE `sold` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `stock_id` int(11) NOT NULL,
  `clean` int(11) NOT NULL COMMENT '0 no / 1 yes',
  `price_at` varchar(255) NOT NULL,
  `piece` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sold`
--

INSERT INTO `sold` (`id`, `user_id`, `stock_id`, `clean`, `price_at`, `piece`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, '1000', 1, '2020-07-11 23:21:13', '2020-07-12 23:21:17'),
(3, 1, 1, 1, '1000', 5, '2020-07-12 23:12:04', '2020-07-12 23:21:04'),
(4, 1, 1, 1, '1000', 3, '2020-07-12 23:21:06', '2020-07-12 23:21:10'),
(14, 1, 1930339356, 1, '2000', 1, '2020-07-14 04:32:30', '2020-07-15 02:34:18'),
(15, 1, 1930339356, 0, '2000', 5, '2020-07-15 02:35:04', '2020-07-20 02:50:07');

-- --------------------------------------------------------

--
-- Table structure for table `stocks`
--

CREATE TABLE `stocks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `count` int(11) NOT NULL,
  `price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expire_date` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_debt` int(11) NOT NULL COMMENT '0 no / 1 yes',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stocks`
--

INSERT INTO `stocks` (`id`, `name`, `supplier_id`, `count`, `price`, `expire_date`, `is_debt`, `created_at`, `updated_at`) VALUES
(1, 'ملوانکە', 1, 86, '1000', '2021-07-30', 0, '2020-07-12 14:19:58', '2020-07-12 23:21:13'),
(2, 'بازنەی ئاڵتوونی', 1, 35, '5000', '2021-07-22', 0, '2020-07-12 14:34:04', '2020-07-13 16:39:40'),
(3, 'مستیلەی زیو', 1, 32, '15000', '2021-07-15', 1, '2020-07-12 17:56:48', '2020-07-20 02:51:13'),
(4, 'سەعاتی زیوی پیاوان', 1, 50, '25000', '2021-06-09', 0, '2020-07-12 19:48:28', '2020-07-14 04:03:46'),
(1930339356, 'سەعاتی زیو', 1, 93, '2000', '2020-07-21', 0, '2020-07-14 04:31:35', '2020-07-20 02:50:07');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `phonenumber` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id`, `name`, `email`, `address`, `phonenumber`, `created_at`, `updated_at`) VALUES
(1, 'nashwan', 'nashwanabdullah@gmail.com', 'slamni', '077046955555', NULL, NULL),
(3, 'karwan', 'mhmad@mfil.co', 'nashwan', '0770469517', '2020-07-08 10:17:47', '2020-07-08 10:17:47');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rule` int(11) NOT NULL COMMENT '1 cashir / 2 admin',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `rule`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Nashwan', 'nashwan@gmail.com', NULL, '$2y$10$lLi0ab4gLlcjyhMEOrRYeOI0cewcwTzkPR2jdQ063kF3U.zWJje/G', 1, NULL, NULL, NULL),
(2, 'ahmad', 'ahmad@gmail.com', NULL, '$2y$10$pmH2HbXh.GynXOboBVifa.KeG84Oh2GFlY1FBZ49mmE/TzD8cBqe2', 0, NULL, '2020-07-12 19:49:24', '2020-07-12 19:49:24');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sidebar`
--
ALTER TABLE `sidebar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sold`
--
ALTER TABLE `sold`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stocks`
--
ALTER TABLE `stocks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
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
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `sidebar`
--
ALTER TABLE `sidebar`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `sold`
--
ALTER TABLE `sold`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `stocks`
--
ALTER TABLE `stocks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1930339357;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
