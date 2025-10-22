-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 22, 2025 at 08:15 AM
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
-- Database: `bikeshop`
--
CREATE DATABASE IF NOT EXISTS `bikeshop` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `bikeshop`;

-- --------------------------------------------------------

--
-- Table structure for table `bikes`
--

CREATE TABLE `bikes` (
  `bike_id` int(11) NOT NULL,
  `model` varchar(100) NOT NULL,
  `type` varchar(50) DEFAULT NULL,
  `hourly_rate` decimal(5,2) DEFAULT NULL,
  `available` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bikes`
--

INSERT INTO `bikes` (`bike_id`, `model`, `type`, `hourly_rate`, `available`) VALUES
(1, 'Trek Marlin 6', 'MTB', 12.00, 1),
(2, 'Giant Escape 3', 'Hybrid', 10.00, 1),
(3, 'Specialized Sirrus X', 'Commuter', 11.50, 0),
(4, 'Co-op DRT 1.1', 'MTB', 13.00, 0),
(5, 'Electra Townie 7D', 'Cruiser', 9.50, 0);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customer_id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customer_id`, `first_name`, `last_name`, `phone`, `email`) VALUES
(1, 'Avery', 'Johnson', '417-555-0103', 'avery@example.com'),
(2, 'Alex', 'Smith', '417-555-0199', 'alex@example.com'),
(3, 'Jordan', 'Lee', '417-555-0102', 'jordan@example.com'),
(4, 'Riley', 'Martinez', '417-555-0104', 'riley@example.com'),
(5, 'Casey', 'Nguyen', '417-555-0105', 'casey@example.com'),
(6, 'Taylor', 'Smith', '417-555-0101', 'taylor@example.com');

-- --------------------------------------------------------

--
-- Table structure for table `rentals`
--

CREATE TABLE `rentals` (
  `rental_id` int(11) NOT NULL,
  `bike_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time DEFAULT NULL,
  `total_cost` decimal(6,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rentals`
--

INSERT INTO `rentals` (`rental_id`, `bike_id`, `customer_id`, `start_time`, `end_time`, `total_cost`) VALUES
(1, 1, 2, '10:15:00', '11:45:00', NULL),
(2, 2, 5, '13:00:00', '14:10:00', NULL),
(3, 3, 1, '09:30:00', '01:14:57', NULL),
(4, 4, 6, '15:05:00', '15:50:00', NULL),
(5, 5, 3, '08:45:00', '09:20:00', NULL),
(6, 1, 4, '12:10:00', '12:55:00', NULL),
(7, 2, 2, '16:00:00', NULL, NULL),
(8, 3, 5, '11:25:00', '12:40:00', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bikes`
--
ALTER TABLE `bikes`
  ADD PRIMARY KEY (`bike_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `rentals`
--
ALTER TABLE `rentals`
  ADD PRIMARY KEY (`rental_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bikes`
--
ALTER TABLE `bikes`
  MODIFY `bike_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `rentals`
--
ALTER TABLE `rentals`
  MODIFY `rental_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
