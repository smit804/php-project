-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 19, 2024 at 09:38 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `braceletstore`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_users`
--

CREATE TABLE `admin_users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`id`, `username`, `password`) VALUES
(1, 'helee', 'helee'),
(2, 'smit', '123456'),
(3, 'hanne', '123456'),
(4, 'varun', '123456');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `stock_quantity` int(11) NOT NULL,
  `category` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `image_url`, `stock_quantity`, `category`) VALUES
(4, 'Gold Bracelet', 'Beautiful gold bracelet', '49.99', 'gold_bracelet.jpg', 10, 'gold'),
(5, 'Pandora Pavé Cuban Bracelet', 'Elegant Timeless Cuban Bracelet', '39.99', 'silver_bracelet.jpg', 15, 'silver'),
(6, 'Rose Gold Bracelet', 'Stylish rose gold bracelet', '59.99', 'rosegold_bracelet.jpg', 8, 'rosegold'),
(7, 'Barbed Wire Heart Bracelet Set', 'Beautiful barbed wire heart bracelet set', '105.00', 'silver6.jpg', 10, 'silver'),
(8, 'Snake Chain Slider Bracelet', 'Elegant snake chain slider bracelet', '70.00', 'silver5.jpg', 20, 'silver'),
(9, 'Gold Charm Bracelet', 'Adorable gold charm bracelet', '59.99', 'gold5.jpg', 20, 'gold'),
(10, 'Heart Clasp Snake Chain Bracelet', 'Classic heart clasp snake chain bracelet', '41.99', 'silver3.jpg', 10, 'silver'),
(11, 'Rose Gold Bangle', 'Classic rose gold bangle', '59.99', 'rosegold4.jpg', 8, 'rosegold'),
(12, 'Heart Clasp Snake Chain Bracelet', 'Elegant Heart Clasp Snake Chain Bracelet', '200.00', 'rosegold2.jpg', 10, 'rosegold'),
(13, 'Gold Link Bracelet', 'Classic gold link bracelet', '79.99', 'gold2.jpg', 10, 'gold'),
(14, 'Gold Chain Bracelet', 'Chic gold chain bracelet', '89.99', 'gold3.jpg', 15, 'gold'),
(15, 'Gold Bangle', 'Stylish gold bangle', '69.99', 'gold4.jpg', 8, 'gold'),
(17, 'Gold Twist Bracelet', 'Elegant gold twist bracelet', '74.99', 'gold6.jpg', 12, 'gold'),
(18, 'Rose Gold Link Bracelet', 'Chic rose gold link bracelet', '69.99', 'rosegold7.jpg', 10, 'rosegold'),
(19, 'Rose Gold Chain Bracelet', 'Stunning rose gold chain bracelet', '79.99', 'rosegold3.jpg', 15, 'rosegold'),
(21, 'Rose Gold Charm Bracelet', 'Adorable rose gold charm bracelet', '49.99', 'rosegold5.jpg', 20, 'rosegold'),
(22, 'Rose Gold Twist Bracelet', 'Elegant rose gold twist bracelet', '64.99', 'rosegold6.jpg', 12, 'rosegold'),
(23, 'T-Bar Snake Chain Bracelet', 'Pandora T-Bar Snake Chain Bracelet', '49.99', 'gold7.jpg', 10, 'gold'),
(24, 'Moments Heart & Butterfly', 'heart & butterfly bangle - Final sale!', '41.99', 'silver2.jpg', 5, 'silver'),
(25, 'Sparkling Tennis Bracelet', 'Stunning sparkling tennis bracelet', '120.00', 'silver4.jpg', 12, 'silver'),
(27, 'Silver Charm Bracelet', 'Beautiful silver charm bracelet', '59.99', 'silver7.jpg', 20, 'silver'),
(28, 'Gold Charm Bracelet', 'Elegant gold charm bracelet', '250.99', 'gold8.jpg', 15, 'gold'),
(29, 'Rose Gold Charm Bracelet', 'Stylish rose gold charm bracelet', '69.99', 'rosegold8.jpg', 18, 'rosegold'),
(30, 'Silver Heart Charm Bracelet', 'Lovely silver heart charm bracelet', '64.99', 'silver8.jpg', 25, 'silver');

-- --------------------------------------------------------

--
-- Table structure for table `user_registration`
--

CREATE TABLE `user_registration` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_registration`
--

INSERT INTO `user_registration` (`user_id`, `username`, `email`, `password`, `phone_number`, `address`) VALUES
(3, 'helee', 'h@gmail.com', '$2y$10$IgXH72mqCOugUaIJSeTyi.QvXd0.1OwQUy1v7YAA5p6X6lUht5Fqy', '1234567890', 'kitchener');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_users`
--
ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_registration`
--
ALTER TABLE `user_registration`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_users`
--
ALTER TABLE `admin_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `user_registration`
--
ALTER TABLE `user_registration`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
