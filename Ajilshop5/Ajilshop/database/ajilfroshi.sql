-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 23, 2025 at 12:28 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ajilfroshi`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `name` varchar(20) NOT NULL,
  `pass` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`name`, `pass`) VALUES
('admin', 'd033e22ae348aeb5660fc2140aec35850c4da997');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `C_name` varchar(255) NOT NULL,
  `C_Email` varchar(255) NOT NULL,
  `C_text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `address` text NOT NULL,
  `city` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `zip_code` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `email`, `phone`, `address`, `city`, `country`, `zip_code`) VALUES
(1, 'علی رضایی', 'ali@example.com', '09121234567', 'خیابان آزادی، پلاک 123', '', '', ''),
(2, 'فاطمه احمدی', 'fatemeh@example.com', '09351234567', 'خیابان انقلاب، پلاک 456', '', '', ''),
(3, 'محمد امیری', 'mohammad@example.com', '09131234567', 'خیابان ولیعصر، پلاک 12', '', '', ''),
(4, 'سمیرا نادری', 'samira@example.com', '09361234567', 'خیابان شریعتی، پلاک 45', '', '', ''),
(5, 'حسین حسینی', 'hossein@example.com', '09221234567', 'خیابان مطهری، پلاک 78', '', '', ''),
(6, 'زهرا مرادی', 'zahra@example.com', '09191234567', 'خیابان کارگر، پلاک 89', '', '', ''),
(7, 'نرگس احمدی', 'narges@example.com', '09381234567', 'خیابان پاسداران، پلاک 34', '', '', ''),
(8, 'فائزه محسن زاده', '', '', 'تبریز- اسکو', 'اسکو', 'ایران', '231635461');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `order_date` datetime NOT NULL,
  `total_amount` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `customer_id`, `order_date`, `total_amount`) VALUES
(1, 1, '2025-01-20 10:00:00', 45.50),
(2, 2, '2025-01-21 15:30:00', 25.00),
(3, 3, '2025-01-22 12:00:00', 50.00),
(4, 4, '2025-01-22 14:00:00', 25.00),
(5, 5, '2025-01-23 10:30:00', 60.00),
(6, 1, '2025-01-23 16:45:00', 40.00),
(7, 2, '2025-01-24 09:15:00', 35.00),
(8, 8, '2025-01-23 10:04:04', 85.00);

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `price`) VALUES
(1, 1, 1, 2, 31.00),
(2, 1, 3, 1, 25.00),
(3, 2, 2, 1, 20.00),
(4, 3, 4, 2, 30.00),
(5, 3, 5, 1, 12.00),
(6, 4, 3, 2, 20.00),
(7, 4, 2, 1, 35.00),
(8, 5, 1, 2, 30.00),
(9, 5, 2, 1, 35.00),
(10, 6, 5, 3, 36.00),
(11, 6, 4, 1, 15.00),
(12, 7, 3, 2, 20.00),
(13, 7, 1, 1, 30.00);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `category` varchar(50) NOT NULL,
  `price` float(10,2) NOT NULL,
  `weight` decimal(10,2) NOT NULL,
  `stock` int(11) NOT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `category`, `price`, `weight`, `stock`, `description`, `image`) VALUES
(1, 'بادام', 'آجیل', 15.50, 1.00, 100, 'بادام تازه و باکیفیت.', 'bootstrap\\images/badam.jpg'),
(2, 'بادام هندی', 'آجیل', 20.00, 1.00, 150, 'بادام هندی خوشمزه و ترد.', 'bootstrap\\images/hindi.jpg'),
(3, 'پسته', 'آجیل', 25.00, 1.00, 120, 'پسته درجه یک با طعم عالی.', 'bootstrap\\images/peste.jpg'),
(4, 'گردو', 'آجیل', 30.00, 1.00, 80, 'گردوی تازه و خوشمزه.', 'bootstrap\\images/gerdoo.jpg'),
(5, 'فندق', 'آجیل', 35.00, 1.00, 90, 'فندق با پوسته نازک و کیفیت بالا.', 'bootstrap\\images/back.jpg'),
(6, 'تخمه آفتابگردان', 'تخمه', 10.00, 1.00, 200, 'تخمه آفتابگردان پرمغز و ترد.', 'bootstrap\\images/tokhme.jpg'),
(7, 'تخمه کدو', 'تخمه', 15.00, 1.00, 180, 'تخمه کدو بو داده خوشمزه.', 'bootstrap\\images/pumpkin-seeds-1.jpg'),
(8, 'بادام زمینی', 'آجیل', 12.00, 1.00, 150, 'بادام زمینی با کیفیت عالی.', 'bootstrap\\images/badamzamini2.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
