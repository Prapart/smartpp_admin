-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 28, 2022 at 09:52 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_smartpp_admin`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(191) NOT NULL,
  `slug` varchar(191) NOT NULL,
  `description` text DEFAULT NULL,
  `meta_title` varchar(191) NOT NULL,
  `meta_description` mediumtext DEFAULT NULL,
  `meta_keyword` mediumtext DEFAULT NULL,
  `navbar_status` tinyint(1) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `create_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `description`, `meta_title`, `meta_description`, `meta_keyword`, `navbar_status`, `status`, `create_at`) VALUES
(1, 'HP Computer', 'www.HPComputer.com', 'www.HPComputer', 'HP  Computer', 'HP  Computer', 'HP  Computer', 0, 0, '2022-08-26 13:36:41'),
(2, 'MAC Book Pro', 'MACBookPro.com', ' MAC Book ProMAC Book Pro', 'MAC Book Pro', 'MAC Book Pro', 'MAC Book Pro', 0, 0, '2022-08-26 13:39:05');

-- --------------------------------------------------------

--
-- Table structure for table `equipment_hw`
--

CREATE TABLE `equipment_hw` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `equipment_hw`
--

INSERT INTO `equipment_hw` (`id`, `name`) VALUES
(1, 'DTH11'),
(2, 'DTH22'),
(3, 'Relay');

-- --------------------------------------------------------

--
-- Table structure for table `equipment_model`
--

CREATE TABLE `equipment_model` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `model_id` varchar(200) NOT NULL,
  `node_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `equipment_model`
--

INSERT INTO `equipment_model` (`id`, `name`, `model_id`, `node_id`) VALUES
(1, 'WROOM', '1', '1'),
(2, 'DEVKIT DOIT', '2', '1'),
(3, '8266', '3', '2'),
(4, 'ARDUINO', '4', '3');

-- --------------------------------------------------------

--
-- Table structure for table `equipment_name`
--

CREATE TABLE `equipment_name` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `equipment_name`
--

INSERT INTO `equipment_name` (`id`, `name`) VALUES
(1, 'ESP32'),
(2, 'ESP8266'),
(3, 'ARDUINO');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` varchar(191) NOT NULL,
  `slug` varchar(191) NOT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(191) DEFAULT NULL,
  `meta_title` varchar(191) NOT NULL,
  `meta_description` mediumtext NOT NULL,
  `meta_keyword` mediumtext NOT NULL,
  `status` tinyint(1) DEFAULT 0,
  `create_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `category_id`, `name`, `slug`, `description`, `image`, `meta_title`, `meta_description`, `meta_keyword`, `status`, `create_at`) VALUES
(8, 1, 'HP  Computer', 'HP  Computer', 'HP  Computer', '1661521039.png', 'HP  Computer', 'HP  Computer', 'HP  Computer', 0, '2022-08-26 13:37:19'),
(9, 2, 'MAC Book Pro2', 'MAC Book Pro', 'MAC Book Pro', '1661521190.png', 'MAC Book Pro', ' MAC Book Pro', ' MAC Book Pro  ', 0, '2022-08-26 13:39:50');

-- --------------------------------------------------------

--
-- Table structure for table `tc_device`
--

CREATE TABLE `tc_device` (
  `id` int(11) NOT NULL,
  `device_name` varchar(200) NOT NULL,
  `device_type` varchar(200) NOT NULL,
  `device_io` varchar(2) NOT NULL COMMENT '1=input,2=output',
  `device_status` int(1) NOT NULL COMMENT 'default = 0',
  `device_location` varchar(200) NOT NULL,
  `node_id` int(11) NOT NULL,
  `node_pin` tinyint(2) NOT NULL,
  `table_name` varchar(200) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tc_device`
--

INSERT INTO `tc_device` (`id`, `device_name`, `device_type`, `device_io`, `device_status`, `device_location`, `node_id`, `node_pin`, `table_name`, `create_at`) VALUES
(1, 'Elect_FAN', 'Relay', '2', 1, 'Office location', 4, 2, 'data_Elect_FAN_output', '2022-08-27 17:43:59');

-- --------------------------------------------------------

--
-- Table structure for table `tc_node`
--

CREATE TABLE `tc_node` (
  `id` int(11) NOT NULL,
  `node_name` varchar(200) NOT NULL,
  `node_id` varchar(50) NOT NULL,
  `node_type` varchar(200) NOT NULL,
  `node_location` varchar(200) NOT NULL,
  `node_ip` varchar(200) DEFAULT '0.0.0.0',
  `node_mac` varchar(200) DEFAULT '0.0.0.0',
  `node_status` tinyint(2) NOT NULL DEFAULT 0,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tc_node`
--

INSERT INTO `tc_node` (`id`, `node_name`, `node_id`, `node_type`, `node_location`, `node_ip`, `node_mac`, `node_status`, `create_at`) VALUES
(1, 'Farm1', '2', '3', 'test', '0.0.0.0', '0.0.0.0', 0, '2022-08-26 13:51:43'),
(2, 'Home12', '3', '4', 'test', '0.0.0.0', '0.0.0.0', 1, '2022-08-26 16:31:23'),
(3, 'Office_01', '1', '1', 'Office_01', '0.0.0.0', '0.0.0.0', 0, '2022-08-26 18:09:37');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fname` varchar(191) NOT NULL,
  `lname` varchar(191) NOT NULL,
  `email` varchar(191) NOT NULL,
  `password` varchar(191) NOT NULL,
  `role_as` tinyint(4) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fname`, `lname`, `email`, `password`, `role_as`, `status`, `create_at`) VALUES
(1, 'Admin', 'Lapet', 'prapart.zs@gmail.com', '123456', 1, 1, '2022-08-20 10:02:47'),
(2, 'Prapart', 'Lapet', 'prapart@gmail.com', '123456', 0, 1, '2022-08-28 05:26:17');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `equipment_hw`
--
ALTER TABLE `equipment_hw`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `equipment_model`
--
ALTER TABLE `equipment_model`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `equipment_name`
--
ALTER TABLE `equipment_name`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tc_device`
--
ALTER TABLE `tc_device`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tc_node`
--
ALTER TABLE `tc_node`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `equipment_hw`
--
ALTER TABLE `equipment_hw`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `equipment_model`
--
ALTER TABLE `equipment_model`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `equipment_name`
--
ALTER TABLE `equipment_name`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tc_device`
--
ALTER TABLE `tc_device`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `tc_node`
--
ALTER TABLE `tc_node`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
