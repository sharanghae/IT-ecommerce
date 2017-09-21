-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 07, 2017 at 11:17 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `artists`
--

CREATE TABLE `artists` (
  `artist_id` int(11) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `middle_name` varchar(20) NOT NULL,
  `last_name` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `artists`
--

INSERT INTO `artists` (`artist_id`, `first_name`, `middle_name`, `last_name`) VALUES
(1, 'Shara Mae', 'Ang', 'Ureta'),
(4, 'Hazel', 'Nervar', 'Bermas'),
(5, 'bill', 'will', 'kill');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `comment_body` varchar(255) NOT NULL,
  `comment_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int(11) NOT NULL,
  `print_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `comment_body`, `comment_date`, `user_id`, `print_id`) VALUES
(2, 'haruuuuuuuu', '2017-09-05 21:27:50', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `pass` varchar(50) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `registration_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`user_id`, `user_name`, `pass`, `first_name`, `last_name`, `email`, `registration_date`) VALUES
(5, 'jasper', '8cb2237d0679ca88db6464eac60da96345513964', 'jasper', 'jasper', 'jasper@yahoo.com', '2017-08-22 11:50:21'),
(6, 'jeck', '8cb2237d0679ca88db6464eac60da96345513964', 'jeck', 'jeck', 'jeck@yahoo.com', '2017-08-22 11:51:13'),
(7, 'hazel', '8cb2237d0679ca88db6464eac60da96345513964', 'hazel', 'hazel', 'hazel@yahoo.com', '2017-08-22 11:52:55'),
(9, 'flow', '8cb2237d0679ca88db6464eac60da96345513964', 'flow', 'flow', 'flowyahoocom', '2017-08-24 04:00:55'),
(11, 'flow1', '8cb2237d0679ca88db6464eac60da96345513964', 'dab', 'dab', 'dab@yahoocom', '2017-08-24 04:07:11'),
(12, 'meow', '8cb2237d0679ca88db6464eac60da96345513964', 'meow', 'meow', 'meow@yahoocom', '2017-08-25 01:11:19'),
(13, 'aaa', '356a192b7913b04c54574d18c28d46e6395428ab', 'sssssss', 'sss', 'sa@yc', '2017-09-05 14:20:48');

-- --------------------------------------------------------

--
-- Table structure for table `forums`
--

CREATE TABLE `forums` (
  `forum_id` tinyint(3) UNSIGNED NOT NULL,
  `name` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `message_id` int(10) UNSIGNED NOT NULL,
  `parent_id` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `forum_id` tinyint(3) UNSIGNED NOT NULL,
  `user_id` mediumint(8) UNSIGNED NOT NULL,
  `subject` varchar(100) NOT NULL,
  `body` longtext NOT NULL,
  `date_entered` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(10) UNSIGNED NOT NULL,
  `customer_id` int(10) UNSIGNED NOT NULL,
  `total` decimal(10,2) UNSIGNED NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `customer_id`, `total`, `order_date`) VALUES
(1, 1, '178.93', '2017-08-16 13:52:45'),
(2, 1, '178.93', '2017-08-16 13:55:37'),
(3, 1, '178.93', '2017-08-16 13:55:37'),
(4, 1, '178.93', '2017-08-16 13:55:37'),
(5, 1, '178.93', '2017-08-16 13:55:37'),
(6, 1, '178.93', '2017-08-16 13:59:21'),
(7, 1, '178.93', '2017-08-25 16:52:58'),
(8, 1, '178.93', '2017-08-25 17:25:01'),
(9, 1, '178.93', '2017-08-25 17:29:33'),
(10, 1, '178.93', '2017-08-25 17:31:40'),
(11, 1, '178.93', '2017-08-28 12:20:27'),
(12, 1, '178.93', '2017-08-28 12:23:51'),
(13, 1, '178.93', '2017-08-28 13:32:56'),
(14, 1, '178.93', '2017-08-28 13:33:15'),
(15, 1, '178.93', '2017-08-28 13:38:34'),
(16, 1, '178.93', '2017-08-28 13:39:42'),
(17, 1, '178.93', '2017-08-28 13:41:09'),
(18, 1, '178.93', '2017-08-28 13:56:33'),
(19, 1, '178.93', '2017-08-28 13:58:41'),
(20, 1, '178.93', '2017-08-28 14:35:25'),
(21, 1, '178.93', '2017-08-28 14:35:36'),
(22, 1, '178.93', '2017-08-28 14:45:31'),
(23, 1, '178.93', '2017-08-30 14:05:07'),
(24, 1, '178.93', '2017-08-30 14:20:46'),
(25, 1, '178.93', '2017-08-30 14:21:03'),
(26, 1, '178.93', '2017-09-05 06:11:39'),
(27, 1, '178.93', '2017-09-05 13:06:39');

-- --------------------------------------------------------

--
-- Table structure for table `order_contents`
--

CREATE TABLE `order_contents` (
  `oc_id` int(10) UNSIGNED NOT NULL,
  `order_id` int(10) UNSIGNED NOT NULL,
  `print_id` int(10) UNSIGNED NOT NULL,
  `quantity` tinyint(3) UNSIGNED NOT NULL DEFAULT '1',
  `price` decimal(6,2) UNSIGNED NOT NULL,
  `ship_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_contents`
--

INSERT INTO `order_contents` (`oc_id`, `order_id`, `print_id`, `quantity`, `price`, `ship_date`) VALUES
(1, 8, 7, 1, '232.00', NULL),
(2, 9, 9, 1, '2300.00', NULL),
(3, 9, 7, 1, '232.00', NULL),
(4, 10, 10, 1, '1200.00', NULL),
(5, 10, 9, 2, '2300.00', NULL),
(6, 14, 9, 4, '2300.00', NULL),
(7, 14, 7, 3, '232.00', NULL),
(8, 15, 7, 1, '232.00', NULL),
(9, 15, 8, 2, '1200.00', NULL),
(10, 16, 9, 1, '2300.00', NULL),
(11, 17, 9, 1, '2300.00', NULL),
(12, 18, 7, 1, '232.00', NULL),
(13, 19, 7, 3, '232.00', NULL),
(14, 19, 9, 2, '2300.00', NULL),
(15, 22, 7, 1, '232.00', NULL),
(16, 23, 7, 3, '232.00', NULL),
(17, 23, 9, 1, '2300.00', NULL),
(18, 23, 14, 1, '355.00', NULL),
(19, 24, 14, 1, '355.00', NULL),
(20, 25, 14, 1, '355.00', NULL),
(21, 26, 14, 1, '355.00', NULL),
(22, 27, 14, 2, '355.00', NULL),
(23, 27, 13, 1, '22.00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `prints`
--

CREATE TABLE `prints` (
  `print_id` int(10) UNSIGNED NOT NULL,
  `artist_id` int(10) UNSIGNED NOT NULL,
  `comment_id` int(11) NOT NULL,
  `print_name` varchar(60) NOT NULL,
  `price` decimal(6,2) UNSIGNED NOT NULL,
  `size` varchar(60) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `image_name` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `prints`
--

INSERT INTO `prints` (`print_id`, `artist_id`, `comment_id`, `print_name`, `price`, `size`, `description`, `image_name`) VALUES
(13, 1, 0, 'cat', '22.00', '22x22', 'cute', '8b536cc1412582961c05de2db89b2613--guinness-book-world-record'),
(14, 4, 0, 'coffeesss', '355.00', '355.00', 'cutiee', '955d4284905d149ea4967ff586e89b41.jpg'),
(15, 5, 0, 'cat2', '89.00', '8x8', 'cutiieeees', 'Bahaya-Bulu-Kucing-bagi-Kesehatan-yang-Harus-Anda-Waspadai.j'),
(16, 1, 0, 'cat3', '76.00', '7x7', 'meoooowww', 'cat-care_cat-nutrition-tips_overweight_body4_left.jpg'),
(19, 4, 0, 'cat8', '123.00', '5x5', 'cat', 'Bahaya-Bulu-Kucing-bagi-Kesehatan-yang-Harus-Anda-Waspadai.j');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `artists`
--
ALTER TABLE `artists`
  ADD PRIMARY KEY (`artist_id`),
  ADD UNIQUE KEY `first_name` (`first_name`),
  ADD UNIQUE KEY `middle_name` (`middle_name`),
  ADD UNIQUE KEY `last_name` (`last_name`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `print_id` (`print_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `order_date` (`order_date`),
  ADD KEY `customer_id_2` (`customer_id`),
  ADD KEY `order_date_2` (`order_date`);

--
-- Indexes for table `order_contents`
--
ALTER TABLE `order_contents`
  ADD PRIMARY KEY (`oc_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `print_id` (`print_id`),
  ADD KEY `ship_date` (`ship_date`);

--
-- Indexes for table `prints`
--
ALTER TABLE `prints`
  ADD PRIMARY KEY (`print_id`),
  ADD KEY `artist_id` (`artist_id`),
  ADD KEY `print_name` (`print_name`),
  ADD KEY `price` (`price`),
  ADD KEY `comment_id` (`comment_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `artists`
--
ALTER TABLE `artists`
  MODIFY `artist_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `order_contents`
--
ALTER TABLE `order_contents`
  MODIFY `oc_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `prints`
--
ALTER TABLE `prints`
  MODIFY `print_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
