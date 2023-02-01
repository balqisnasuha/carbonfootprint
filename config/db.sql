-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 01, 2023 at 06:04 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db`
--

-- --------------------------------------------------------

--
-- Table structure for table `electric_device`
--

CREATE TABLE `electric_device` (
  `device_id` int(11) NOT NULL,
  `device_name` varchar(255) NOT NULL,
  `device_watt` int(11) NOT NULL,
  `device_status` enum('0','1','2','3') NOT NULL DEFAULT '1' COMMENT '0:pending, 1:active, 2:inactive, 3:deleted',
  `device_created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `device_updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `device_deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `electric_device`
--

INSERT INTO `electric_device` (`device_id`, `device_name`, `device_watt`, `device_status`, `device_created_at`, `device_updated_at`, `device_deleted_at`) VALUES
(1, 'LED TV', 150, '1', '2023-01-29 14:04:37', '2023-01-29 14:04:37', NULL),
(2, 'Fridge', 220, '1', '2023-01-29 14:04:37', '2023-01-29 14:04:37', NULL),
(3, 'Washer', 500, '1', '2023-01-29 14:04:37', '2023-01-29 14:04:37', NULL),
(4, 'Dryer', 4000, '1', '2023-01-29 14:04:37', '2023-01-29 14:04:37', NULL),
(5, 'Aircond', 2500, '1', '2023-01-29 14:04:37', '2023-01-29 14:04:37', NULL),
(6, 'Fan', 70, '1', '2023-01-29 14:04:37', '2023-01-29 14:04:37', NULL),
(7, 'Light', 100, '1', '2023-01-29 14:04:37', '2023-01-29 14:04:37', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `electric_usage`
--

CREATE TABLE `electric_usage` (
  `usage_id` int(11) NOT NULL,
  `usage_device_id` int(11) NOT NULL,
  `usage_user_id` int(11) NOT NULL,
  `usage_duration` int(11) NOT NULL,
  `usage_power` float(10,2) NOT NULL,
  `usage_watt` float(10,2) NOT NULL,
  `usage_date` date NOT NULL,
  `usage_status` enum('0','1','2','3') NOT NULL DEFAULT '1' COMMENT '0:pending, 1:active, 2:inactive, 3:deleted',
  `usage_created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `usage_updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `usage_deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `electric_usage`
--

INSERT INTO `electric_usage` (`usage_id`, `usage_device_id`, `usage_user_id`, `usage_duration`, `usage_power`, `usage_watt`, `usage_date`, `usage_status`, `usage_created_at`, `usage_updated_at`, `usage_deleted_at`) VALUES
(1, 1, 2, 2, 150.00, 0.00, '2023-01-29', '1', '2023-01-29 14:14:03', '2023-01-29 15:00:40', NULL),
(2, 3, 2, 5, 500.00, 1.55, '2023-01-29', '1', '2023-01-29 14:14:03', '2023-01-29 14:14:03', NULL),
(3, 6, 2, 2, 70.00, 0.09, '2023-01-29', '1', '2023-01-29 14:14:03', '2023-01-29 14:14:03', NULL),
(4, 2, 2, 1, 220.00, 0.00, '2023-01-29', '1', '2023-01-29 14:42:59', '2023-01-29 15:00:40', NULL),
(5, 2, 2, 12, 220.00, 0.02, '2023-01-30', '1', '2023-01-29 18:18:39', '2023-01-29 20:25:00', NULL),
(6, 1, 3, 2, 150.00, 0.00, '2023-01-30', '1', '2023-01-29 20:05:09', '2023-01-29 20:05:09', NULL),
(7, 2, 3, 12, 220.00, 0.02, '2023-01-30', '1', '2023-01-29 20:05:09', '2023-01-29 20:05:09', NULL),
(8, 3, 3, 1, 500.00, 0.00, '2023-01-30', '1', '2023-01-29 20:05:09', '2023-01-29 20:05:09', NULL),
(9, 4, 3, 1, 4000.00, 0.00, '2023-01-30', '1', '2023-01-29 20:05:09', '2023-01-29 20:05:09', NULL),
(10, 5, 3, 5, 2500.00, 0.06, '2023-01-30', '1', '2023-01-29 20:05:09', '2023-01-29 20:05:09', NULL),
(11, 7, 3, 3, 100.00, 0.04, '2023-01-30', '1', '2023-01-29 20:05:09', '2023-01-29 20:05:09', NULL),
(12, 1, 2, 2, 150.00, 0.00, '2023-01-30', '1', '2023-01-29 20:25:00', '2023-01-29 20:25:00', NULL),
(13, 1, 4, 2, 150.00, 0.00, '2023-01-30', '1', '2023-01-30 00:45:53', '2023-01-30 00:45:53', NULL),
(14, 2, 4, 1, 220.00, 0.00, '2023-01-30', '1', '2023-01-30 00:45:53', '2023-01-30 00:45:53', NULL),
(15, 1, 5, 3, 150.00, 0.00, '2023-01-30', '1', '2023-01-30 01:34:11', '2023-01-30 01:34:11', NULL),
(16, 2, 5, 24, 220.00, 0.09, '2023-01-30', '1', '2023-01-30 01:34:11', '2023-01-30 01:34:11', NULL),
(17, 3, 5, 1, 500.00, 0.00, '2023-01-30', '1', '2023-01-30 01:34:11', '2023-01-30 01:34:11', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `reward`
--

CREATE TABLE `reward` (
  `reward_id` int(11) NOT NULL,
  `reward_name` varchar(255) NOT NULL,
  `reward_point` int(11) NOT NULL,
  `reward_start_date` datetime NOT NULL,
  `reward_end_date` datetime NOT NULL,
  `reward_status` enum('0','1','2','3') NOT NULL DEFAULT '1' COMMENT '0:pending, 1:active, 2:inactive, 3:deleted',
  `reward_created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `reward_updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `reward_deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reward`
--

INSERT INTO `reward` (`reward_id`, `reward_name`, `reward_point`, `reward_start_date`, `reward_end_date`, `reward_status`, `reward_created_at`, `reward_updated_at`, `reward_deleted_at`) VALUES
(1, 'STARBUCK VOUCHERS', 7, '2023-01-29 22:15:00', '2023-01-30 04:15:00', '2', '2023-01-29 14:16:12', '2023-01-29 20:15:15', NULL),
(2, 'MekDi 25% OFF', 3, '2023-01-30 04:06:00', '2023-02-01 04:06:00', '1', '2023-01-29 20:06:52', '2023-01-29 20:06:52', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `reward_redeem`
--

CREATE TABLE `reward_redeem` (
  `redeem_id` int(11) NOT NULL,
  `redeem_reward_id` int(11) NOT NULL,
  `redeem_user_id` int(11) NOT NULL,
  `redeem_point` int(11) NOT NULL,
  `redeem_status` enum('0','1','2','3') NOT NULL DEFAULT '1' COMMENT '0:pending, 1:active, 2:inactive, 3:deleted',
  `redeem_comment` text DEFAULT NULL,
  `redeem_created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `redeem_updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `redeem_deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reward_redeem`
--

INSERT INTO `reward_redeem` (`redeem_id`, `redeem_reward_id`, `redeem_user_id`, `redeem_point`, `redeem_status`, `redeem_comment`, `redeem_created_at`, `redeem_updated_at`, `redeem_deleted_at`) VALUES
(1, 1, 2, 7, '1', 'USE THIS VOUCHER CODE \"SB290123145617#\"', '2023-01-29 14:16:42', '2023-01-29 14:17:47', NULL),
(2, 2, 3, 3, '1', 'USE THIS CODE TO REDEEM YOUR VOUCHER \"MD300123040925#\"', '2023-01-29 20:08:07', '2023-01-29 20:09:47', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(80) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_ic_no` varchar(12) NOT NULL,
  `user_phone` varchar(20) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_role` enum('admin','user') NOT NULL DEFAULT 'user',
  `user_status` enum('0','1','2','3') NOT NULL DEFAULT '1' COMMENT '0:pending, 1:active, 2:inactive, 3:deleted',
  `user_created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `user_deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_email`, `user_ic_no`, `user_phone`, `user_password`, `user_role`, `user_status`, `user_created_at`, `user_updated_at`, `user_deleted_at`) VALUES
(1, 'balqisadmin', 'adminbal@example.com', '001011070472', '0124050729', '$2y$10$RF2uJF.3WwH26wXRbfZ.KOCgTObQM3nKE0BKoNKf/EpVL.eN5R5Fq', 'admin', '1', '2023-01-29 14:10:48', '2023-01-29 14:12:29', NULL),
(2, 'wawashuhaimi', 'wawa@gmail.com', '001231070132', '0124028879', '$2y$10$Sxo3jQeqG6cbf1IyzjEf7ePQHZ7842s4jBlfRUo1RW5ozPxgIXpQe', 'user', '1', '2023-01-29 14:13:16', '2023-01-29 14:13:16', NULL),
(3, 'syazlin afikha', 'syazlinafikha@gmail.com', '001009080652', '0124050728', '$2y$10$ddmOEPs4Z0wpY.4YFa3ZeOvThM1W3TJnYoBPe9ejzFeIsuE.YdwzG', 'user', '1', '2023-01-29 18:39:14', '2023-01-29 18:39:14', NULL),
(4, 'naim', 'naim@gmail.com', '001107095257', '0164592341', '$2y$10$ocW5azHf6XSgjU3ViTgoiekS1aduD8sbPLQkmq68b/Co7AINSa6XK', 'user', '1', '2023-01-30 00:43:40', '2023-01-30 00:43:40', NULL),
(5, 'balqis nasuha', 'balqis@gmail.com', '011011087212', '0188564321', '$2y$10$pWXEhlGNKY3JB2XfD.Z/6eD13veIGCW.TKuSoRVxSzV9szY4i/y6W', 'user', '1', '2023-01-30 00:51:20', '2023-01-30 00:51:20', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_reward`
--

CREATE TABLE `user_reward` (
  `reward_id` int(11) NOT NULL,
  `reward_user_id` int(11) NOT NULL,
  `reward_point` int(11) NOT NULL,
  `reward_status` enum('0','1','2','3') NOT NULL DEFAULT '1' COMMENT '0:pending, 1:active, 2:inactive, 3:deleted',
  `reward_created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `reward_updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `reward_deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_reward`
--

INSERT INTO `user_reward` (`reward_id`, `reward_user_id`, `reward_point`, `reward_status`, `reward_created_at`, `reward_updated_at`, `reward_deleted_at`) VALUES
(1, 2, 10, '1', '2023-01-29 14:14:03', '2023-01-29 14:14:03', NULL),
(2, 2, 6, '1', '2023-01-29 18:18:39', '2023-01-29 18:18:39', NULL),
(3, 3, 6, '1', '2023-01-29 20:05:09', '2023-01-29 20:05:09', NULL),
(4, 4, 3, '1', '2023-01-30 00:45:53', '2023-01-30 00:45:53', NULL),
(5, 5, 5, '1', '2023-01-30 01:34:11', '2023-01-30 01:34:11', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `electric_device`
--
ALTER TABLE `electric_device`
  ADD PRIMARY KEY (`device_id`);

--
-- Indexes for table `electric_usage`
--
ALTER TABLE `electric_usage`
  ADD PRIMARY KEY (`usage_id`),
  ADD KEY `usage_device_id` (`usage_device_id`),
  ADD KEY `usage_user_id` (`usage_user_id`);

--
-- Indexes for table `reward`
--
ALTER TABLE `reward`
  ADD PRIMARY KEY (`reward_id`);

--
-- Indexes for table `reward_redeem`
--
ALTER TABLE `reward_redeem`
  ADD PRIMARY KEY (`redeem_id`),
  ADD KEY `redeem_reward_id` (`redeem_reward_id`),
  ADD KEY `redeem_user_id` (`redeem_user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_email` (`user_email`),
  ADD UNIQUE KEY `user_ic_no` (`user_ic_no`);

--
-- Indexes for table `user_reward`
--
ALTER TABLE `user_reward`
  ADD PRIMARY KEY (`reward_id`),
  ADD KEY `reward_user_id` (`reward_user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `electric_device`
--
ALTER TABLE `electric_device`
  MODIFY `device_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `electric_usage`
--
ALTER TABLE `electric_usage`
  MODIFY `usage_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `reward`
--
ALTER TABLE `reward`
  MODIFY `reward_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `reward_redeem`
--
ALTER TABLE `reward_redeem`
  MODIFY `redeem_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_reward`
--
ALTER TABLE `user_reward`
  MODIFY `reward_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `electric_usage`
--
ALTER TABLE `electric_usage`
  ADD CONSTRAINT `electric_usage_ibfk_1` FOREIGN KEY (`usage_device_id`) REFERENCES `electric_device` (`device_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `electric_usage_ibfk_2` FOREIGN KEY (`usage_user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reward_redeem`
--
ALTER TABLE `reward_redeem`
  ADD CONSTRAINT `reward_redeem_ibfk_1` FOREIGN KEY (`redeem_reward_id`) REFERENCES `reward` (`reward_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reward_redeem_ibfk_2` FOREIGN KEY (`redeem_user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_reward`
--
ALTER TABLE `user_reward`
  ADD CONSTRAINT `user_reward_ibfk_1` FOREIGN KEY (`reward_user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
