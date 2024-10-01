-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 01, 2024 at 06:50 AM
-- Server version: 8.0.39
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `onlinedukon`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `tr` int NOT NULL,
  `active` varchar(25) NOT NULL DEFAULT 'inactive'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `tr`, `active`) VALUES
(5, 'Televizorlar', 6, 'active'),
(6, 'Avtomobil qo&#039;shimchalari', 5, 'inactive'),
(8, 'Uy ro&#039;zg&#039;or texnikalari', 2, 'inactive'),
(9, 'Xo&#039;jalik mollari', 1, 'active'),
(10, 'Poyabzallar', 3, 'inactive'),
(11, 'Aksessuarlar', 4, 'active'),
(16, 'Oziq ovqatlar', 8, 'Inactive'),
(17, 'Qurulish mollari', 7, 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int NOT NULL,
  `client_id` int NOT NULL,
  `owner_id` int NOT NULL,
  `product_id` int NOT NULL,
  `count` int NOT NULL,
  `status` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `client_id`, `owner_id`, `product_id`, `count`, `status`) VALUES
(1, 1, 4, 9, 1, 1),
(2, 1, 1, 8, 1, 2),
(3, 1, 4, 7, 1, 1),
(4, 1, 4, 9, 1, 1),
(5, 1, 1, 8, 1, 0),
(6, 1, 4, 7, 1, 1),
(7, 1, 4, 9, 1, 1),
(8, 1, 1, 8, 1, 2),
(9, 4, 4, 9, 1, 1),
(10, 4, 1, 8, 1, 1),
(11, 4, 4, 7, 1, 1),
(12, 5, 1, 8, 1, 0),
(13, 5, 4, 7, 1, 1),
(14, 5, 1, 8, 1, 0),
(15, 5, 4, 7, 1, 1),
(16, 5, 1, 8, 1, 0),
(17, 5, 4, 10, 1, 1),
(18, 5, 4, 9, 1, 1),
(19, 5, 1, 8, 1, 2),
(20, 5, 4, 7, 1, 1),
(21, 5, 4, 9, 1, 2),
(22, 5, 4, 10, 1, 1),
(23, 5, 1, 8, 1, 2),
(24, 5, 4, 7, 1, 1),
(25, 5, 1, 8, 10, 0),
(26, 5, 4, 7, 10, 1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `category_id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` int NOT NULL,
  `img` varchar(255) NOT NULL,
  `count` int NOT NULL,
  `premium` tinyint(1) NOT NULL DEFAULT '0',
  `start_date` date NOT NULL,
  `end_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `user_id`, `category_id`, `name`, `price`, `img`, `count`, `premium`, `start_date`, `end_date`) VALUES
(3, 1, 9, 'Balzam', 35000, 'images/2024-09-27_05-15-20_.jpg', 5, 1, '2024-09-27', '2024-09-27'),
(5, 2, 5, 'Krem', 10000, 'images/2024-09-27_05-13-06_.jpg', 10, 0, '2024-09-01', '2024-10-31'),
(7, 4, 8, 'Milliy Cola', 8000, 'images/2024-09-27_12-08-50_.jpg', 30, 1, '2024-09-27', '2024-09-27'),
(8, 1, 16, 'Limoo', 10000, 'images/2024-09-27_12-11-34_.jpg', 997, 1, '2024-09-27', '2024-09-27'),
(9, 4, 16, 'Balza', 35000, 'images/2024-09-27_13-47-11_.jpg', 4, 1, '2024-09-27', '2024-09-27'),
(10, 4, 16, 'Oranj', 12000, 'images/2024-09-27_13-48-54_.jpg', 150, 1, '2024-09-27', '2024-09-27'),
(11, 5, 8, 'Samsung S24 Ultra', 12500000, 'images/2024-10-01_06-44-58_.jpg', 5, 1, '2024-10-01', '2024-10-01');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(10) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`) VALUES
(1, 'Elbek', 'elbek@gmail.com', '202cb962ac59075b964b07152d234b70', 'admin'),
(3, 'Boltavoy', 'boltavoy@gmail.com', '202cb962ac59075b964b07152d234b70', 'user'),
(4, 'Janob Hechkim', 'janob@gmail.com', '202cb962ac59075b964b07152d234b70', 'admin'),
(5, 'Toshmat', 'toshmat@mail.ru', '202cb962ac59075b964b07152d234b70', 'user');

--
-- Indexes for dumped tables
--

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
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
