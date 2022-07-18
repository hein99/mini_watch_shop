-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Host: weech.iad1-mysql-e2-17b.dreamhost.com
-- Generation Time: Jul 18, 2022 at 08:23 AM
-- Server version: 8.0.28-0ubuntu0.20.04.3
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mini_watch_shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(45) COLLATE utf8mb4_general_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `phone` varchar(15) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `email`, `password`, `name`, `phone`, `created_at`, `modified_at`) VALUES
(1, 'hkk@example.com', '*2470C0C06DEE42FD1618BB99005ADCA2EC9D1E19', 'Hein Kaung Khant', '09798467816', '2022-07-18 07:45:55', '2022-07-18 07:45:55');

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `id` bigint UNSIGNED NOT NULL,
  `photo_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `banners`
--

INSERT INTO `banners` (`id`, `photo_name`) VALUES
(1, 'resources/images/banners/1658149529.jpg'),
(2, 'resources/images/banners/1658149544.jpg'),
(3, 'resources/images/banners/1658149561.jpg'),
(4, 'resources/images/banners/1658149574.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `photo_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `photo_name`) VALUES
(1, 'Casio Edifice', 'resources/images/categories/casioedifice.png'),
(2, 'Mini Focus', 'resources/images/categories/minifocus.png');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint UNSIGNED NOT NULL,
  `customer_name` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `customer_phone` varchar(15) COLLATE utf8mb4_general_ci NOT NULL,
  `customer_address` text COLLATE utf8mb4_general_ci NOT NULL,
  `product_id` bigint NOT NULL,
  `tracking_code` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `status` enum('ordered','processing','shipped','completed','cancelled') COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `customer_name`, `customer_phone`, `customer_address`, `product_id`, `tracking_code`, `status`, `created_at`, `modified_at`) VALUES
(1, 'Hein Kaung Khant', '6594450092', 'Blk 156 Bedok South Ave 3', 3, '12380af31f256d82753a809e9ea1800c', 'ordered', '2022-07-18 08:22:12', '2022-07-18 08:22:12');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `description` text COLLATE utf8mb4_general_ci NOT NULL,
  `category_id` bigint UNSIGNED NOT NULL,
  `price` int UNSIGNED NOT NULL,
  `discount_percentage` tinyint UNSIGNED NOT NULL,
  `is_out_of_stock` tinyint(1) NOT NULL,
  `photo_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `photo_qty` tinyint UNSIGNED DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `modified_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `category_id`, `price`, `discount_percentage`, `is_out_of_stock`, `photo_name`, `photo_qty`, `created_at`, `modified_at`) VALUES
(1, 'EF 550 SP', 'Stainless steel\r\nMineral glass', 1, 300000, 10, 0, 'resources/images/products/ef 550 sp_', 3, '2022-07-18 07:59:15', '2022-07-18 07:59:15'),
(2, 'MF 01', 'Stainless Steel\r\nWater resistance 3bar', 2, 95000, 20, 0, 'resources/images/products/mf 01_', 1, '2022-07-18 07:59:15', '2022-07-18 07:59:15'),
(3, 'EF 556 dy', 'Stainless steel\r\nMineral glass', 1, 250000, 10, 0, 'resources/images/products/ef 556 dy_', 1, '2022-07-18 07:59:15', '2022-07-18 07:59:15'),
(4, 'EF 550 RBB', 'Stainless Steel\r\nWater resistance 10bar', 1, 125000, 10, 0, 'resources/images/products/ef 550 rbb_', 1, '2022-07-18 07:59:15', '2022-07-18 07:59:15'),
(5, 'EFB680D-2BV', 'Stainless steel\r\nMineral glass', 1, 200000, 0, 0, 'resources/images/products/efb680d2bv_', 1, '2022-07-18 07:59:15', '2022-07-18 07:59:15'),
(6, 'EFB680D-1AV', 'Stainless Steel\r\nWater resistance 10bar', 1, 160000, 15, 0, 'resources/images/products/efb680d1av_', 1, '2022-07-18 07:59:15', '2022-07-18 07:59:15'),
(7, 'EF 558 BG', 'Stainless Steel\r\nWater resistance 10bar', 1, 150000, 0, 0, 'resources/images/products/ef 558 bg_', 1, '2022-07-18 07:59:15', '2022-07-18 07:59:15');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email` (`email`);

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
