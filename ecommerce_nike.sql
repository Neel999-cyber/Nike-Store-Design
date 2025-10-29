-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 11, 2025 at 04:24 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommerce_nike`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `color` varchar(50) NOT NULL,
  `size` varchar(10) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `user_id` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `product_id`, `color`, `size`, `price`, `user_id`, `created_at`) VALUES
(1, 1, 'White', 'UK 8', 10999.00, 'user_682044e759b808.95800794', '2025-05-11 06:34:37'),
(2, 1, 'White', 'UK 8', 10999.00, 'user_68209c3e372655.13222748', '2025-05-11 12:47:05'),
(12, 1, 'Black', 'UK 6', 10999.00, '2', '2025-05-11 14:18:58'),
(13, 2, 'Red', 'UK 7', 4395.00, '2', '2025-05-11 14:19:02'),
(14, 2, 'Beige', 'UK 5', 9795.00, '2', '2025-05-11 14:19:21'),
(15, 3, 'Grey', 'UK 6', 4795.00, '2', '2025-05-11 14:19:41'),
(16, 5, 'Black', 'UK 7', 5795.00, '3', '2025-05-11 14:20:54'),
(17, 2, 'Red', 'UK 7', 4395.00, '3', '2025-05-11 14:20:58'),
(18, 3, 'Infrared', 'UK 6', 9995.00, '3', '2025-05-11 14:21:03'),
(19, 3, 'Grey', 'UK 5', 4795.00, '3', '2025-05-11 14:21:29');

-- --------------------------------------------------------

--
-- Table structure for table `delivery_info`
--

CREATE TABLE `delivery_info` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` text NOT NULL,
  `city` varchar(50) NOT NULL,
  `postal_code` varchar(20) NOT NULL,
  `state` varchar(50) NOT NULL,
  `json_data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`json_data`)),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `delivery_info`
--

INSERT INTO `delivery_info` (`id`, `user_id`, `name`, `phone`, `address`, `city`, `postal_code`, `state`, `json_data`, `created_at`) VALUES
(1, 1, 'Neel Patel', '07621 876697', '2, siddhakshetra co,op,society, Nr. New Railway Colony, Jawaharchowk, Sabarmati\r\nSigma', 'AHMEDABAD', '380005', 'GUJARAT', '{\"name\":\"Neel Patel\",\"phone\":\"07621 876697\",\"address\":\"2, siddhakshetra co,op,society, Nr. New Railway Colony, Jawaharchowk, Sabarmati\\r\\nSigma\",\"city\":\"AHMEDABAD\",\"postal_code\":\"380005\",\"state\":\"GUJARAT\"}', '2025-05-08 10:20:43'),
(2, 1, 'Neel Patel', '07621 876697', '2, siddhakshetra co,op,society, Nr. New Railway Colony, Jawaharchowk, Sabarmati\r\nSigma', 'AHMEDABAD', '380005', 'GUJARAT', '{\"name\":\"Neel Patel\",\"phone\":\"07621 876697\",\"address\":\"2, siddhakshetra co,op,society, Nr. New Railway Colony, Jawaharchowk, Sabarmati\\r\\nSigma\",\"city\":\"AHMEDABAD\",\"postal_code\":\"380005\",\"state\":\"GUJARAT\"}', '2025-05-08 10:28:21');

-- --------------------------------------------------------

--
-- Table structure for table `kids_products`
--

CREATE TABLE `kids_products` (
  `id` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `colors` text DEFAULT NULL,
  `sizes` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kids_products`
--

INSERT INTO `kids_products` (`id`, `image`, `name`, `price`, `colors`, `sizes`) VALUES
(1, 'image_source\\shoes20.png', 'Nike Kids Air Max Excee', 4495.00, 'Red,Black,White', 'Uk1,Uk2,Uk3,Uk4,Uk5'),
(2, 'image_source\\shoes21.png', 'Nike Kids Downshifter 11', 3995.00, 'Blue,White,Yellow', 'Uk1,Uk2,Uk3,Uk4,Uk5'),
(3, 'image_source\\shoes22.png', 'Nike Kids Revolution 6', 4295.00, 'Grey,Pink,White', 'Uk1,Uk2,Uk3,Uk4,Uk5'),
(4, 'image_source\\shoes23.png', 'Nike Kids Star Runner 3', 3595.00, 'Green,Navy,White', 'Uk1,Uk2,Uk3,Uk4,Uk5'),
(5, 'image_source\\shoes24.png', 'Nike Kids Team Hustle D10', 4795.00, 'Orange,Black,White', 'Uk1,Uk2,Uk3,Uk4,Uk5'),
(6, 'image_source\\shoes25.png', 'Nike Kids Air Max Bolt', 4895.00, 'Purple,White,Blue', 'Uk1,Uk2,Uk3,Uk4,Uk5'),
(7, 'image_source\\shoes12.png', 'Nike Kids Flex Runner 2', 3795.00, 'Black,Red,White', 'Uk1,Uk2,Uk3,Uk4,Uk5'),
(8, 'image_source\\shoes3.png', 'Nike Kids Air Zoom Arcadia', 4995.00, 'Blue,White,Lime', 'Uk1,Uk2,Uk3,Uk4,Uk5');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `postal_code` varchar(20) DEFAULT NULL,
  `state` varchar(50) DEFAULT NULL,
  `payment_method` varchar(50) DEFAULT NULL,
  `json_data` longtext DEFAULT NULL CHECK (json_valid(`json_data`)),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `colors` text DEFAULT NULL,
  `sizes` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `image`, `name`, `price`, `colors`, `sizes`) VALUES
(1, 'image_source\\shoes5.png', 'Nike Air Zoom Pegasus 40', 10999.00, 'Black,White,Gray', 'UK 6,UK 7,UK 8,UK 9,UK 10'),
(2, 'image_source\\NIKE+REVOLUTION+6+NN.avif', 'Nike Revolution 6 Next Nature', 4395.00, 'Navy Blue,Black,Red', 'UK 7,UK 8,UK 9,UK 10'),
(3, 'image_source\\shoes7.png', 'Nike Air Max 90 Essential', 9995.00, 'White,Infrared,Black', 'UK 6,UK 7,UK 8,UK 9,UK 11'),
(4, 'image_source\\shoes8.png', 'Nike Downshifter 12', 4995.00, 'Blue,Black,Grey', 'UK 6,UK 7,UK 8,UK 9'),
(5, 'image_source\\shoes16.png', 'Nike Court Vision Low Next Nature', 5795.00, 'White,Black,Gum', 'UK 7,UK 8,UK 9,UK 10'),
(6, 'image_source\\shoes9.png', 'Nike Blazer Mid 77 Vintage', 8495.00, 'White,Sail,Black', 'UK 7,UK 8,UK 9'),
(7, 'image_source\\shoes4.png', 'Nike Air Force 1 \'07', 7995.00, 'White,Black,Red', 'UK 6,UK 7,UK 8,UK 9,UK 10'),
(8, 'image_source\\img5.png', 'Nike Zoom Freak 5', 11295.00, 'White,Multicolor,Black', 'UK 8,UK 9,UK 10,UK 11');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `created_at`) VALUES
(1, 'Neel', 'pneel7621@gmail.com', '$2y$10$fMgEpmBws0xFMXa4DwJ/PedoAuNnETiT3zkB/gjioY/RPNvCMORXu', '2025-05-08 09:41:10'),
(2, 'neel', 'neel@gmail.com', '$2y$10$aRhC6BUI4gatyJek6lofdudDgz6aRUAdxc1BkOL4lg02Jlf7jy4SW', '2025-05-11 13:19:16'),
(3, 'manushi', 'manushi@gmail.com', '$2y$10$3R3/y.cMvVHOxIQidSJ.aOILjOGNkIUtceORatn.XWIgOUtHf.dH2', '2025-05-11 14:20:22');

-- --------------------------------------------------------

--
-- Table structure for table `women_products`
--

CREATE TABLE `women_products` (
  `id` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `colors` text DEFAULT NULL,
  `sizes` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `women_products`
--

INSERT INTO `women_products` (`id`, `image`, `name`, `price`, `colors`, `sizes`) VALUES
(1, 'image_source\\shoes13.png', 'Nike W Air Max Excee', 8495.00, 'White,Pink,Black', 'UK 4,UK 5,UK 6,UK 7'),
(2, 'image_source\\shoes14.png', 'Nike W Air Force 1 Shadow', 9795.00, 'White,Pink,Beige', 'UK 4,UK 5,UK 6,UK 7'),
(3, 'image_source\\shoes15.png', 'Nike W Downshifter 12', 4795.00, 'Black,White,Grey', 'UK 5,UK 6,UK 7'),
(4, 'image_source\\shoes17.png', 'Nike W ZoomX Invincible Run', 11295.00, 'Purple,White,Black', 'UK 4,UK 5,UK 6'),
(5, 'image_source\\shoes18.png', 'Nike W Air Max Bolt', 7495.00, 'White,Purple,Grey', 'UK 4,UK 5,UK 6,UK 7'),
(6, 'image_source\\shoes19.png', 'Nike W Revolution 6', 4295.00, 'Pink,Grey,Black', 'UK 4,UK 5,UK 6,UK 7'),
(7, 'image_source\\shoes22.png', 'Nike W Air Max Dia', 8995.00, 'Coral,White,Grey', 'UK 4,UK 5,UK 6'),
(8, 'image_source\\shoes27.png', 'Nike W React Escape RN 2', 8495.00, 'Light Blue,Black,White', 'UK 5,UK 6,UK 7,UK 8');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `delivery_info`
--
ALTER TABLE `delivery_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kids_products`
--
ALTER TABLE `kids_products`
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
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `women_products`
--
ALTER TABLE `women_products`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `delivery_info`
--
ALTER TABLE `delivery_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `kids_products`
--
ALTER TABLE `kids_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `women_products`
--
ALTER TABLE `women_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
