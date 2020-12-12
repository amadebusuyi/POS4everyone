-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 12, 2020 at 09:38 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `posdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(191) NOT NULL,
  `description` mediumtext DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `created_by`, `updated_at`, `created_at`, `deleted`) VALUES
(1, 'General', NULL, 2, '2020-10-03 22:33:30', '2020-10-03 11:52:22', 0),
(2, 'Another category', NULL, 2, '2020-10-03 22:35:42', '2020-10-03 16:29:18', 1),
(3, 'Edited category', 'Was first to be modified', 2, '2020-10-04 07:21:10', '2020-10-03 16:46:21', 0),
(4, 'Another one', NULL, 2, '2020-10-04 17:25:14', '2020-10-03 18:40:59', 1),
(5, 'Hello World', 'This is the first comment that gets to the database', 2, '2020-10-03 22:34:33', '2020-10-03 18:43:16', 0),
(6, '', NULL, 2, '2020-10-03 22:34:57', '2020-10-03 21:11:21', 1),
(7, 'Last for Day 1', 'This is the last category that I created to prove that this is working really fine. Thank you precious Holy Spirit, I couldn\'t have done this without you. I honor you greatly precious Holy Ghost, My help, My help', 2, '2020-10-03 22:34:57', '2020-10-03 22:05:18', 1),
(8, 'Yellow night', 'Okay, thank you Holy Spirit', 2, '2020-10-03 22:34:33', '2020-10-03 22:32:32', 0),
(9, 'Great products', 'This category contains great product', 2, '2020-12-09 17:51:43', '2020-10-04 07:03:41', 0),
(10, 'Essential Drugs', '', 2, '2020-11-17 15:59:30', '2020-11-17 15:59:30', 0);

-- --------------------------------------------------------

--
-- Table structure for table `commodities`
--

CREATE TABLE `commodities` (
  `id` int(11) NOT NULL,
  `generic_name` varchar(191) NOT NULL,
  `therapeutic` varchar(191) DEFAULT NULL,
  `brand_name` varchar(191) DEFAULT NULL,
  `category` int(11) NOT NULL,
  `supplier` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 0,
  `unit` varchar(50) DEFAULT NULL,
  `nearest_expiry` timestamp NULL DEFAULT NULL,
  `image` varchar(191) DEFAULT NULL,
  `description` mediumtext DEFAULT NULL,
  `note` mediumtext DEFAULT NULL,
  `unit_cost_price` varchar(30) DEFAULT NULL,
  `unit_selling_price` varchar(30) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `commodities`
--

INSERT INTO `commodities` (`id`, `generic_name`, `therapeutic`, `brand_name`, `category`, `supplier`, `quantity`, `unit`, `nearest_expiry`, `image`, `description`, `note`, `unit_cost_price`, `unit_selling_price`, `updated_at`, `created_at`, `deleted`) VALUES
(2, 'Paracetamol', '', '', 1, 1, 0, NULL, NULL, NULL, '', NULL, '5.00', '6.50', '2020-10-16 16:42:23', '2020-10-04 16:13:20', 0),
(3, 'Septrin', 'Cotrimaxazole', 'Pfizer', 9, 2, 0, NULL, NULL, NULL, '', NULL, '100.00', '200.00', '2020-10-16 16:42:23', '2020-10-04 16:15:02', 0),
(4, 'Aboniki Balm', '', '', 5, 1, 0, NULL, NULL, NULL, '', NULL, '800.00', '1,000.00', '2020-10-16 16:42:23', '2020-10-04 16:32:47', 0),
(5, 'Isoniazid', 'INH', '', 8, 3, 49, NULL, NULL, NULL, '', NULL, '1,750.00', '2,500.00', '2020-10-16 12:57:47', '2020-10-04 20:59:25', 0),
(6, 'Test product', '', '', 8, 2, 60, NULL, NULL, NULL, '', NULL, '0.50', '1.00', '2020-10-16 12:57:51', '2020-10-05 05:58:26', 0),
(7, 'Paracetamol', 'Cotrimaxazole', 'Pfizer', 1, 1, 12, NULL, NULL, NULL, '', NULL, '1,750.00', '2,500.00', '2020-11-16 17:19:56', '2020-10-12 01:32:35', 0),
(8, 'Test product', NULL, NULL, 9, 3, 10, NULL, NULL, NULL, NULL, NULL, '800.00', '1,000.00', '2020-11-07 11:51:10', '2020-10-13 12:24:54', 0),
(9, 'Pearl Body lotion', NULL, NULL, 3, 1, 17, NULL, NULL, NULL, NULL, NULL, '450.00', '500.00', '2020-12-09 17:32:05', '2020-10-13 12:24:54', 0),
(10, 'Cool Cream', NULL, NULL, 9, 3, 59, NULL, NULL, NULL, NULL, NULL, '120.00', '150.00', '2020-11-05 09:45:56', '2020-10-13 12:25:27', 0),
(11, 'Tramadol', NULL, NULL, 3, 1, 715, NULL, NULL, NULL, NULL, NULL, '540.00', '750.00', '2020-11-16 17:19:56', '2020-10-13 12:25:27', 0),
(12, 'Paracetamol (Satchet)', '', '', 10, 4, 40, NULL, NULL, NULL, '', NULL, '100.00', '150.00', '2020-12-09 17:32:05', '2020-11-17 16:01:24', 0);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `name` varchar(191) NOT NULL,
  `phone` varchar(30) DEFAULT NULL,
  `email` varchar(191) DEFAULT NULL,
  `address` mediumtext DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `points` int(11) DEFAULT 0,
  `wins` int(11) NOT NULL DEFAULT 0,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `phone`, `email`, `address`, `created_by`, `points`, `wins`, `updated_at`, `created_at`, `deleted`) VALUES
(1, 'Unregistered customer (Anonymous)', '', '', '', NULL, 0, 0, '2020-10-16 15:58:12', '2020-10-16 12:59:46', 0),
(2, 'Adebusuyi', '08065348422', 'adebowale@gmail.com', 'Idi-agba titun Akure, Ondo State', 2, 0, 0, '2020-10-16 16:00:59', '2020-10-15 18:21:23', 0),
(3, 'Timothy', '', '', '', 2, 0, 0, '2020-10-16 15:28:33', '2020-10-15 18:30:53', 1),
(4, 'Anonymous (For unregistered customers)', '', '', '', 2, 0, 0, '2020-10-16 15:28:33', '2020-10-15 18:32:17', 1),
(5, 'Bolarinwa Bokorinlo', '1234567890', '', '', 2, 0, 0, '2020-10-15 19:03:21', '2020-10-15 19:03:21', 0),
(6, 'Mr Oluwaseun Jimoh', '', '', '', 2, 0, 0, '2020-10-15 19:05:07', '2020-10-15 19:05:07', 0),
(7, 'Jean Harvey', '08065348422', '', '', 2, 0, 0, '2020-10-16 15:28:48', '2020-10-15 19:06:16', 1),
(8, 'Harry Potter Junior', '', '', '', 2, 0, 0, '2020-10-16 15:28:48', '2020-10-15 19:12:30', 1),
(9, 'Mr. Sola', '08125256517', '', '', 2, 0, 0, '2020-10-16 15:41:27', '2020-10-16 08:52:49', 1),
(10, 'Jane Parker', '', '', '', 2, 0, 0, '2020-10-16 15:41:27', '2020-10-16 15:34:33', 1),
(11, 'Veletta Donna', '', '', '', 2, 0, 0, '2020-10-16 15:41:27', '2020-10-16 15:39:35', 1),
(12, 'Kasperky Ruwanka', '', '', '', 2, 0, 0, '2020-10-16 15:41:27', '2020-10-16 15:40:28', 1);

-- --------------------------------------------------------

--
-- Table structure for table `payment_types`
--

CREATE TABLE `payment_types` (
  `id` int(11) NOT NULL,
  `name` varchar(191) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment_types`
--

INSERT INTO `payment_types` (`id`, `name`, `created_at`) VALUES
(1, 'Cash', '2020-09-27 19:27:12'),
(2, 'Transfer', '2020-09-27 19:27:12'),
(3, 'POS', '2020-09-27 19:27:12'),
(4, 'Others', '2020-09-27 19:27:12');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` int(11) NOT NULL,
  `commodity` int(11) NOT NULL,
  `cost_price` varchar(191) NOT NULL,
  `selling_price` varchar(191) NOT NULL,
  `quantity` int(11) NOT NULL,
  `sale_id` int(11) NOT NULL,
  `comment` mediumtext DEFAULT NULL,
  `payment_type` int(11) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `commodity`, `cost_price`, `selling_price`, `quantity`, `sale_id`, `comment`, `payment_type`, `updated_at`, `created_at`, `deleted`) VALUES
(11, 11, '540.00', '750.00', 1, 4, NULL, NULL, '2020-10-16 13:03:03', '2020-10-16 13:03:03', 0),
(12, 11, '540.00', '750.00', 1, 5, NULL, NULL, '2020-10-16 13:08:36', '2020-10-16 13:08:36', 0),
(13, 11, '540.00', '750.00', 99, 6, NULL, NULL, '2020-10-16 13:08:58', '2020-10-16 13:08:58', 0),
(14, 11, '540.00', '750.00', 99, 7, NULL, NULL, '2020-10-16 13:10:30', '2020-10-16 13:10:30', 0),
(15, 9, '450.00', '500.00', 4, 7, NULL, NULL, '2020-10-16 13:10:30', '2020-10-16 13:10:30', 0),
(16, 11, '540.00', '750.00', 1, 8, NULL, NULL, '2020-10-16 13:12:28', '2020-10-16 13:12:28', 0),
(17, 10, '120.00', '150.00', 1, 9, NULL, NULL, '2020-10-16 13:50:21', '2020-10-16 13:50:21', 0),
(18, 10, '120.00', '150.00', 1, 10, NULL, NULL, '2020-10-16 14:44:21', '2020-10-16 14:44:21', 0),
(19, 9, '450.00', '500.00', 1, 10, NULL, NULL, '2020-10-16 14:44:21', '2020-10-16 14:44:21', 0),
(20, 8, '800.00', '1,000.00', 1, 10, NULL, NULL, '2020-10-16 14:44:21', '2020-10-16 14:44:21', 0),
(21, 7, '1,750.00', '2,500.00', 1, 10, NULL, NULL, '2020-10-16 14:44:21', '2020-10-16 14:44:21', 0),
(22, 9, '450.00', '500.00', 1, 11, NULL, NULL, '2020-10-16 14:47:49', '2020-10-16 14:47:49', 0),
(23, 7, '1,750.00', '2,500.00', 2, 12, NULL, NULL, '2020-10-16 14:48:14', '2020-10-16 14:48:14', 0),
(24, 10, '120.00', '150.00', 3, 13, NULL, NULL, '2020-10-16 14:49:05', '2020-10-16 14:49:05', 0),
(25, 2, '5.00', '6.50', 50, 14, NULL, NULL, '2020-10-16 16:42:22', '2020-10-16 16:42:22', 0),
(26, 3, '100.00', '200.00', 100, 14, NULL, NULL, '2020-10-16 16:42:22', '2020-10-16 16:42:22', 0),
(27, 4, '800.00', '1,000.00', 35, 14, NULL, NULL, '2020-10-16 16:42:22', '2020-10-16 16:42:22', 0),
(28, 11, '540.00', '750.00', 45, 14, NULL, NULL, '2020-10-16 16:42:22', '2020-10-16 16:42:22', 0),
(29, 11, '540.00', '750.00', 4, 15, NULL, NULL, '2020-11-05 08:07:45', '2020-11-05 08:07:45', 0),
(30, 10, '120.00', '150.00', 1, 16, NULL, NULL, '2020-11-05 09:45:56', '2020-11-05 09:45:56', 0),
(31, 11, '540.00', '750.00', 25, 17, NULL, NULL, '2020-11-07 11:51:09', '2020-11-07 11:51:09', 0),
(32, 7, '1,750.00', '2,500.00', 50, 17, NULL, NULL, '2020-11-07 11:51:09', '2020-11-07 11:51:09', 0),
(33, 9, '450.00', '500.00', 1, 17, NULL, NULL, '2020-11-07 11:51:09', '2020-11-07 11:51:09', 0),
(34, 8, '800.00', '1,000.00', 1, 17, NULL, NULL, '2020-11-07 11:51:10', '2020-11-07 11:51:10', 0),
(35, 7, '1,750.00', '2,500.00', 5, 18, NULL, NULL, '2020-11-16 17:19:56', '2020-11-16 17:19:56', 0),
(36, 11, '540.00', '750.00', 10, 18, NULL, NULL, '2020-11-16 17:19:56', '2020-11-16 17:19:56', 0),
(37, 12, '100.00', '150.00', 10, 19, NULL, NULL, '2020-12-09 17:32:04', '2020-12-09 17:32:04', 0),
(38, 9, '450.00', '500.00', 10, 19, NULL, NULL, '2020-12-09 17:32:05', '2020-12-09 17:32:05', 0);

-- --------------------------------------------------------

--
-- Table structure for table `sale_summary`
--

CREATE TABLE `sale_summary` (
  `id` int(11) NOT NULL,
  `customer` int(11) NOT NULL,
  `amount` varchar(199) NOT NULL,
  `profit` varchar(191) NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sale_summary`
--

INSERT INTO `sale_summary` (`id`, `customer`, `amount`, `profit`, `created_by`, `updated_at`, `created_at`, `deleted`) VALUES
(4, 1, '₦750.00', '₦210.00', 2, '2020-10-16 13:03:03', '2020-10-16 13:03:03', 0),
(5, 2, '₦750.00', '₦210.00', 2, '2020-10-16 13:08:36', '2020-10-16 13:08:36', 0),
(6, 2, '₦74,250.00', '₦20,790.00', 2, '2020-10-16 13:08:58', '2020-10-16 13:08:58', 0),
(7, 1, '₦76,250.00', '₦20,990.00', 2, '2020-10-16 13:10:29', '2020-10-16 13:10:29', 0),
(8, 1, '₦750.00', '₦210.00', 4, '2020-11-05 09:27:39', '2020-10-16 13:12:28', 0),
(9, 9, '₦150.00', '₦30.00', 2, '2020-10-16 13:50:21', '2020-10-16 13:50:21', 0),
(10, 1, '₦4,150.00', '₦1,030.00', 4, '2020-11-05 09:27:44', '2020-10-16 14:44:21', 0),
(11, 1, '₦500.00', '₦50.00', 2, '2020-10-16 14:47:49', '2020-10-16 14:47:49', 0),
(12, 1, '₦5,000.00', '₦1,500.00', 4, '2020-11-05 09:27:49', '2020-10-16 14:48:14', 0),
(13, 1, '₦450.00', '₦90.00', 2, '2020-10-16 14:49:05', '2020-10-16 14:49:05', 0),
(14, 6, '₦89,075.00', '₦26,525.00', 2, '2020-10-16 16:42:22', '2020-10-16 16:42:22', 0),
(15, 2, '₦3,000.00', '₦840.00', 3, '2020-11-05 08:07:45', '2020-11-05 08:07:45', 0),
(16, 1, '₦150.00', '₦30.00', 4, '2020-11-05 09:45:56', '2020-11-05 09:45:56', 0),
(17, 2, '₦145,250.00', '₦43,000.00', 4, '2020-11-07 11:51:09', '2020-11-07 11:51:09', 0),
(18, 1, '₦20,000.00', '₦5,850.00', 2, '2020-11-16 17:19:56', '2020-11-16 17:19:56', 0),
(19, 2, '₦6,500.00', '₦1,000.00', 11, '2020-12-09 17:32:04', '2020-12-09 17:32:04', 0);

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` int(11) NOT NULL,
  `name` varchar(191) NOT NULL,
  `contact` varchar(191) DEFAULT NULL,
  `description` mediumtext DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `name`, `contact`, `description`, `created_by`, `updated_at`, `created_at`, `deleted`) VALUES
(1, 'Adebowale', 'Ojodu Berger', 'Hello World', 2, '2020-10-04 12:45:34', '2020-10-04 12:20:25', 0),
(2, 'Test supplier', '124, Obaniberu Street, 08065348422', 'It\'s okay', 2, '2020-10-04 12:45:34', '2020-10-04 12:21:58', 0),
(3, 'All that is left is deletion', 'Modification of power', 'Deletion is necessary', 2, '2020-10-16 13:52:42', '2020-10-04 12:42:25', 1),
(4, 'M and B', '', '', 2, '2020-11-17 15:59:52', '2020-11-17 15:59:52', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `role` int(1) NOT NULL DEFAULT 0,
  `first_name` varchar(191) DEFAULT NULL,
  `last_name` varchar(191) DEFAULT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(191) NOT NULL,
  `email` varchar(191) DEFAULT NULL,
  `phone` varchar(30) DEFAULT NULL,
  `image` varchar(191) DEFAULT NULL,
  `address` mediumtext DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role`, `first_name`, `last_name`, `username`, `password`, `email`, `phone`, `image`, `address`, `updated_at`, `created_at`, `deleted`) VALUES
(2, 2, 'Adebowale', 'Adebusuyi', 'kato', '$006167903439f90827e775ac34830019.$d559ad23ea4304cd1da6f6fcdd472ba6', 'heclassy@gmail.com', '08065348422', NULL, 'Idi Agba Titun Akure', '2020-10-02 22:32:51', '2020-09-28 11:28:46', 0),
(3, 1, 'Moyinoluwa', 'King Walex', 'walex', '$b0b6605a8686ef830c048e0cb9365209.$62c8ad0a15d9d1ca38d5dee762a16e01', 'wale@gmail.com', '', NULL, '', '2020-10-03 16:23:38', '2020-09-29 09:21:04', 0),
(4, 0, 'Janetilia', 'Akpore', 'janet', '$b0b6605a8686ef830c048e0cb9365209.$62c8ad0a15d9d1ca38d5dee762a16e01', 'janet247890@gmail.com', '08125256517', NULL, '', '2020-11-07 12:02:55', '2020-09-29 09:22:45', 0),
(6, 0, 'Bolarinwa', 'Bokorinlo', 'student1', '$b0b6605a8686ef830c048e0cb9365209.$62c8ad0a15d9d1ca38d5dee762a16e01', 'amadebusuyi@gmail.com', '1234567890', NULL, '', '2020-11-05 07:47:22', '2020-10-02 05:06:18', 0),
(8, 0, 'Adebowale', 'Adebusuyi', 'amb_kato', '$d6d56cab46e0f3af2c756289f2b447e0.$e10adc3949ba59abbe56e057f20f883e', '', '', NULL, NULL, '2020-10-03 22:13:51', '2020-10-03 08:48:42', 1),
(9, 0, 'Kelvin', 'Bowman', 'bonke', '$b0b6605a8686ef830c048e0cb9365209.$62c8ad0a15d9d1ca38d5dee762a16e01', 'kbowman@gmail.com', '', NULL, NULL, '2020-10-03 22:10:36', '2020-10-03 08:51:39', 1),
(10, 0, 'Akinwale', '', 'akin', '$6a20234ae8734e683c790f7cd81cfbed.$e80b5017098950fc58aad83c8c14978e', '', '', NULL, NULL, '2020-10-03 22:12:19', '2020-10-03 08:54:37', 1),
(11, 0, 'Adebowale', 'Adebusuyi', 'wale', '$b0b6605a8686ef830c048e0cb9365209.$62c8ad0a15d9d1ca38d5dee762a16e01', 'wale@pelseygold.com', '08065348422', NULL, NULL, '2020-12-09 17:26:40', '2020-12-09 17:26:40', 0),
(12, 1, 'Adebo', 'Wale', 'wale2', '$b0b6605a8686ef830c048e0cb9365209.$62c8ad0a15d9d1ca38d5dee762a16e01', 'WALEX@GMAIL.COM', '12364783737', NULL, NULL, '2020-12-09 17:38:18', '2020-12-09 17:35:22', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_by` (`created_by`);

--
-- Indexes for table `commodities`
--
ALTER TABLE `commodities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category` (`category`),
  ADD KEY `supplier` (`supplier`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_by` (`created_by`);

--
-- Indexes for table `payment_types`
--
ALTER TABLE `payment_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `commodity` (`commodity`),
  ADD KEY `sold_by` (`sale_id`),
  ADD KEY `payment_type` (`payment_type`),
  ADD KEY `payment_type_2` (`payment_type`);

--
-- Indexes for table `sale_summary`
--
ALTER TABLE `sale_summary`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `customer` (`customer`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_by` (`created_by`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `commodities`
--
ALTER TABLE `commodities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `payment_types`
--
ALTER TABLE `payment_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `sale_summary`
--
ALTER TABLE `sale_summary`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `commodities`
--
ALTER TABLE `commodities`
  ADD CONSTRAINT `commodities_ibfk_1` FOREIGN KEY (`category`) REFERENCES `categories` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `commodities_ibfk_2` FOREIGN KEY (`supplier`) REFERENCES `suppliers` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `customers`
--
ALTER TABLE `customers`
  ADD CONSTRAINT `customers_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `sales_ibfk_4` FOREIGN KEY (`commodity`) REFERENCES `commodities` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `sales_ibfk_5` FOREIGN KEY (`sale_id`) REFERENCES `sale_summary` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sale_summary`
--
ALTER TABLE `sale_summary`
  ADD CONSTRAINT `sale_summary_ibfk_1` FOREIGN KEY (`customer`) REFERENCES `customers` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `sale_summary_ibfk_2` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD CONSTRAINT `suppliers_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
