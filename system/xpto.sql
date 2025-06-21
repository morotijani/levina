-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 28, 2025 at 03:18 AM
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
-- Database: `xpto`
--

-- --------------------------------------------------------

--
-- Table structure for table `xpto_admins`
--

CREATE TABLE `xpto_admins` (
  `id` int(11) NOT NULL,
  `admin_id` varchar(100) DEFAULT NULL,
  `admin_email` varchar(200) DEFAULT NULL,
  `admin_password` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `xpto_admins`
--

INSERT INTO `xpto_admins` (`id`, `admin_id`, `admin_email`, `admin_password`) VALUES
(1, '901a72fc-er32-4770-a78d-6f33c6d6a55c', 'admin@admin.com', '$2y$10$WKV/v9cSvwKwGmJU/P48ouPcCXuOm5eAZ7JEOzXWKzcjidWUj57eu');

-- --------------------------------------------------------

--
-- Table structure for table `xpto_transactions`
--

CREATE TABLE `xpto_transactions` (
  `id` bigint(20) NOT NULL,
  `transaction_id` varchar(100) DEFAULT NULL,
  `transaction_by` varchar(100) DEFAULT NULL,
  `transaction_amount` double(10,2) DEFAULT NULL,
  `transaction_crypto_id` varchar(100) DEFAULT NULL,
  `transaction_crypto_symbol` varchar(50) DEFAULT NULL,
  `transaction_crypto_name` varchar(100) DEFAULT NULL,
  `transaction_crypto_price` varchar(50) DEFAULT NULL,
  `transaction_to_address` varchar(300) DEFAULT NULL,
  `transaction_message` varchar(500) DEFAULT NULL,
  `createdAt` datetime DEFAULT current_timestamp(),
  `updatedAt` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `transaction_status` tinyint(4) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `xpto_transactions`
--

INSERT INTO `xpto_transactions` (`id`, `transaction_id`, `transaction_by`, `transaction_amount`, `transaction_crypto_id`, `transaction_crypto_symbol`, `transaction_crypto_name`, `transaction_crypto_price`, `transaction_to_address`, `transaction_message`, `createdAt`, `updatedAt`, `transaction_status`) VALUES
(1, '66871ae3-ef2c-4ef4-ac26-62fd60d6b8ff', '801a72fc-d04d-4770-a78d-fa33c6d6a55c', 233.00, '1', 'BTC', 'Bitcoin', '86.00', '1Lbcfr7sAHTD9CgdQo3HTMTkV8LK4ZnX71', 'good rate', '2025-02-26 14:21:29', '2025-02-27 11:40:40', 2),
(2, 'f12055af-c324-4341-8e04-55c6c8098fa5', '801a72fc-d04d-4770-a78d-fa33c6d6a55c', 12.00, '1', 'BTC', 'Bitcoin', '86.00', '1Lbcfr7sAHTD9CgdQo3HTMTkV8LK4ZnX71', '', '2025-02-26 14:56:39', NULL, 0),
(3, 'e81b2d89-9082-4407-a132-2d151ca09a00', '801a72fc-d04d-4770-a78d-fa33c6d6a55c', 3000.00, '52', 'XRP', 'XRP', '2.25', 'rf1BiGeXwwQoi8Z2ueFYTEXSwuJYfV2Jpn', '', '2025-02-26 15:05:51', '2025-02-27 11:55:08', 2),
(4, '4927f22a-95b7-464c-8cd2-865ca03bd7db', '801a72fc-d04d-4770-a78d-fa33c6d6a55c', 9.45, '1027', 'ETH', 'Ethereum', '2,434.31', '0x1D1479C185d32EB90533a08b36B3CFa5F84A0E6B', '', '2025-02-26 15:08:28', '2025-02-27 11:40:07', 1),
(5, 'fa120e53-e8df-4270-9aba-80e0a8b6975b', '801a72fc-d04d-4770-a78d-fa33c6d6a55c', 1.00, '825', 'USDT', 'Tether USDt', '1.00', '0x9702230a8ea53601f5cd2dc00fdbc13d4df4a8c7', 'we good.', '2025-02-26 15:39:09', NULL, 0),
(6, '6130174e-66af-45da-b9c6-473975caaad1', '801a72fc-d04d-4770-a78d-fa33c6d6a55c', 34.00, '1839', 'BNB', 'BNB', '610.41', '0x10d543e2e0355e36c5cab769df8d2d60abb77a73', '', '2025-02-26 18:13:55', NULL, 0),
(7, 'e4927bb8-4440-4340-a9c4-707dc62f3858', '801a72fc-d04d-4770-a78d-fa33c6d6a55c', 45.00, '1', 'BTC', 'Bitcoin', '86,203.96', '1Lbcfr7sAHTD9CgdQo3HTMTkV8LK4ZnX71', '', '2025-02-27 12:22:07', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `xpto_users`
--

CREATE TABLE `xpto_users` (
  `id` bigint(20) NOT NULL,
  `user_id` varchar(100) DEFAULT NULL,
  `user_firstname` varchar(100) DEFAULT NULL,
  `user_lastname` varchar(100) DEFAULT NULL,
  `user_email` varchar(300) DEFAULT NULL,
  `user_phone` varchar(20) DEFAULT NULL,
  `user_password` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `user_pin` varchar(100) DEFAULT NULL,
  `pin` varchar(5) DEFAULT NULL,
  `user_invitationcode` varchar(50) DEFAULT NULL,
  `user_balance` double(10,2) DEFAULT NULL,
  `createdAt` datetime DEFAULT current_timestamp(),
  `updatedAt` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `user_status` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `xpto_users`
--

INSERT INTO `xpto_users` (`id`, `user_id`, `user_firstname`, `user_lastname`, `user_email`, `user_phone`, `user_password`, `password`, `user_pin`, `pin`, `user_invitationcode`, `user_balance`, `createdAt`, `updatedAt`, `user_status`) VALUES
(4, '801a72fc-d04d-4770-a78d-fa33c6d6a55c', 'Henry', 'Asamoah', 'henry@email.com', '', '$2y$10$EncVOp99bFMEbbSA/LE7Ketpfcz2.ExIlAAYHX.1IoWDfz3EsY8sS', 'password', '$2y$10$CGr8c4VePZy/LRPcTbyC0uft0pekVNUE0646VrWo1qJtmg84737Me', '1111', '', 1422.23, '2025-02-22 23:58:41', '2025-02-27 12:45:42', 0),
(5, '41c1741e-3322-4146-af52-dacdffd7db3e', NULL, NULL, 'inuwa@email.com', NULL, '$2y$10$aJu0r6xL6PpullKfzaDQl.DLht.kZ16Uy1Gnsk7YVC0dAGnAO8NAO', 'password', '$2y$10$N8YuBnvFLtZmbIeN9lEI9.DqzxGVT2A4BcLKSmp.KWPbrOES/8MaS', '1234', '', 400.00, '2025-02-27 22:27:40', '2025-02-27 22:35:46', 0);

-- --------------------------------------------------------

--
-- Table structure for table `xpto_wallet_addresses`
--

CREATE TABLE `xpto_wallet_addresses` (
  `id` bigint(20) NOT NULL,
  `wallet_addresse_id` varchar(100) DEFAULT NULL,
  `wallet_addresse_user` varchar(100) DEFAULT NULL,
  `wallet_addresse_crypto` varchar(100) DEFAULT NULL,
  `wallet_address` varchar(300) DEFAULT NULL,
  `wallet_address_balance` double(10,2) DEFAULT NULL,
  `createdAt` datetime DEFAULT current_timestamp(),
  `updatedAt` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `wallet_addresse_status` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `xpto_admins`
--
ALTER TABLE `xpto_admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `xpto_transactions`
--
ALTER TABLE `xpto_transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `xpto_users`
--
ALTER TABLE `xpto_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `xpto_wallet_addresses`
--
ALTER TABLE `xpto_wallet_addresses`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `xpto_admins`
--
ALTER TABLE `xpto_admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `xpto_transactions`
--
ALTER TABLE `xpto_transactions`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `xpto_users`
--
ALTER TABLE `xpto_users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `xpto_wallet_addresses`
--
ALTER TABLE `xpto_wallet_addresses`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
