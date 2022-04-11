-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 13, 2021 at 06:29 PM
-- Server version: 5.7.21-1ubuntu1
-- PHP Version: 7.4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ping`
--

-- --------------------------------------------------------

--
-- Table structure for table `adminlogin`
--

CREATE TABLE `adminlogin` (
  `id` int(10) NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(250) NOT NULL,
  `emailId` varchar(100) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `userImage` varchar(255) NOT NULL,
  `about` text NOT NULL,
  `hash` varchar(250) NOT NULL,
  `adminLevelId` int(5) NOT NULL DEFAULT '0',
  `lastLogin` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `addDate` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `addedBy` tinyint(2) NOT NULL DEFAULT '0',
  `modDate` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modBy` tinyint(2) NOT NULL DEFAULT '0',
  `status` enum('0','1') NOT NULL DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `used` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `adminlogin`
--

INSERT INTO `adminlogin` (`id`, `role_id`, `first_name`, `last_name`, `username`, `password`, `emailId`, `mobile`, `userImage`, `about`, `hash`, `adminLevelId`, `lastLogin`, `addDate`, `addedBy`, `modDate`, `modBy`, `status`, `deleted_at`, `used`) VALUES
(1, 1, 'Sparx', 'Sparx', 'admin@gmail.com', 'ec5031fbc5e21233634c926cece1c0f6:d4', 'ramprakashsingh.singh@gmail.com', '1245689', 'avatar_e8206a78f1b23667bda8cf87f3c90590.png', 'The quick brown fox jumps right over the lazy dog.', '34256d5a47c2d8149cfe9e4f6851145b7cad158f', -1, '2021-08-13 10:24:17', '2013-08-06 13:41:09', 1, '2017-05-15 05:04:03', 1, '1', NULL, 1),
(36, 27, 'Manjeet', 'Singh', 'admin@gmail.com', '4832735d833b71a73c62b1e29abc434a:d4', 'manjeet.singh@sparxitsolutions.com', '', '', '', 'c8076e486cdc86c0cd35f583138d39aa', 0, '2017-03-28 08:31:32', '2017-03-23 09:33:02', 1, '0000-00-00 00:00:00', 0, '1', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `cash`
--

CREATE TABLE `cash` (
  `id` int(11) NOT NULL,
  `cash_fundtype_id` int(2) NOT NULL,
  `amount` int(11) NOT NULL,
  `bankdeposite_upload` varchar(200) NOT NULL,
  `check_front_upload` varchar(200) NOT NULL,
  `check_front_back` varchar(200) NOT NULL,
  `agent_special_code` varchar(10) NOT NULL,
  `status` int(2) NOT NULL DEFAULT '1',
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deletedAt` int(2) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cash`
--

INSERT INTO `cash` (`id`, `cash_fundtype_id`, `amount`, `bankdeposite_upload`, `check_front_upload`, `check_front_back`, `agent_special_code`, `status`, `createdAt`, `updatedAt`, `deletedAt`) VALUES
(1, 1, 2500, '', '', '', '', 1, '2021-08-07 08:38:14', '2021-08-07 08:38:14', 0),
(2, 1, 5825, '', '', '', '', 1, '2021-08-07 11:05:47', '2021-08-07 11:05:47', 0),
(3, 2, 5000, '', '', '', '', 1, '2021-08-07 11:11:05', '2021-08-07 11:11:05', 0),
(4, 3, 5800, '', '', '', 'xyz', 1, '2021-08-07 13:31:09', '2021-08-07 13:31:09', 0);

-- --------------------------------------------------------

--
-- Table structure for table `cash_fundtype`
--

CREATE TABLE `cash_fundtype` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` int(2) NOT NULL DEFAULT '1',
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deletedAt` int(2) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cash_fundtype`
--

INSERT INTO `cash_fundtype` (`id`, `name`, `status`, `createdAt`, `updatedAt`, `deletedAt`) VALUES
(1, 'Bank Deposit', 1, '2021-08-07 07:23:21', '2021-08-07 07:23:21', 0),
(2, 'Check Deposit', 1, '2021-08-07 07:23:21', '2021-08-07 07:23:21', 0),
(3, 'From Agent', 1, '2021-08-07 07:23:21', '2021-08-07 07:23:21', 0);

-- --------------------------------------------------------

--
-- Table structure for table `loan_apply`
--

CREATE TABLE `loan_apply` (
  `id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL DEFAULT '0',
  `loan_duration` int(11) NOT NULL DEFAULT '0',
  `amount` int(5) NOT NULL,
  `payment_type` int(5) NOT NULL,
  `status` int(2) NOT NULL DEFAULT '1',
  `createdAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `loan_apply`
--

INSERT INTO `loan_apply` (`id`, `type_id`, `loan_duration`, `amount`, `payment_type`, `status`, `createdAt`, `updatedAt`) VALUES
(1, 5, 4, 2500, 3, 1, '2021-08-13 09:28:06', '2021-08-13 09:28:06');

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `id` int(11) NOT NULL,
  `type_of_user` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `mode` varchar(255) NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `paymentduration`
--

CREATE TABLE `paymentduration` (
  `id` int(11) NOT NULL,
  `label` varchar(255) NOT NULL,
  `month` int(11) NOT NULL DEFAULT '0',
  `description` text,
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deletedAt` int(11) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `paymentduration`
--

INSERT INTO `paymentduration` (`id`, `label`, `month`, `description`, `createdAt`, `updatedAt`, `deletedAt`, `status`) VALUES
(1, '3 Month', 3, '3 Month', '2021-08-10 11:22:24', '2021-08-10 11:22:24', 0, 1),
(2, '6 Month', 6, '', '2021-08-10 11:22:38', '2021-08-10 11:22:38', 0, 1),
(3, '12 Month', 12, '', '2021-08-10 11:23:01', '2021-08-10 11:23:01', 0, 1),
(4, '18 Month', 18, '18 Month', '2021-08-10 11:23:25', '2021-08-10 11:23:25', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `paymenttype`
--

CREATE TABLE `paymenttype` (
  `id` int(11) NOT NULL,
  `label` varchar(255) NOT NULL,
  `days` int(11) NOT NULL DEFAULT '0',
  `description` text,
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deletedAt` int(11) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `paymenttype`
--

INSERT INTO `paymenttype` (`id`, `label`, `days`, `description`, `createdAt`, `updatedAt`, `deletedAt`, `status`) VALUES
(2, 'Daily', 1, '', '2021-08-10 11:08:57', '2021-08-10 11:08:57', 0, 1),
(3, 'Weekly', 7, 'Weekly', '2021-08-10 11:09:19', '2021-08-10 11:09:19', 0, 1),
(4, 'Monthly', 30, '', '2021-08-10 11:09:35', '2021-08-10 11:09:35', 0, 1),
(5, 'Yearly', 365, 'Yearly', '2021-08-10 11:09:51', '2021-08-10 11:09:51', 0, 1),
(6, 'One Type Payment(Fixed)', 0, 'One Type Payment(Fixed)', '2021-08-10 11:44:39', '2021-08-10 11:44:39', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `plan`
--

CREATE TABLE `plan` (
  `id` int(11) NOT NULL,
  `plan_cat` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text,
  `status` int(2) NOT NULL DEFAULT '0',
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deletedAt` int(2) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `plan`
--

INSERT INTO `plan` (`id`, `plan_cat`, `name`, `description`, `status`, `createdAt`, `updatedAt`, `deletedAt`) VALUES
(1, 'CASH', 'Smart Saver', '', 1, '2021-08-09 04:00:25', '2021-08-09 04:00:25', 0),
(2, 'INVESTMENT', 'BRH', '', 1, '2021-08-09 04:12:51', '2021-08-09 04:12:51', 0),
(3, 'INVESTMENT', 'SOL', '', 1, '2021-08-09 04:13:01', '2021-08-09 04:13:01', 0),
(4, 'INVESTMENT', 'VIP', '', 1, '2021-08-09 04:13:10', '2021-08-09 04:13:10', 0),
(5, 'LOAN', 'Personal', '', 1, '2021-08-09 04:14:01', '2021-08-09 04:14:01', 0),
(6, 'LOAN', 'Small Business', 'Small Business', 1, '2021-08-09 04:14:40', '2021-08-09 04:14:40', 0),
(9, 'CASH', 'smooth', 'asa', 1, '2021-08-10 12:16:02', '2021-08-10 12:16:02', 0);

-- --------------------------------------------------------

--
-- Table structure for table `plan_payment_duration`
--

CREATE TABLE `plan_payment_duration` (
  `id` int(11) NOT NULL,
  `plan_id` int(11) NOT NULL DEFAULT '0',
  `paymentduration_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `plan_payment_duration`
--

INSERT INTO `plan_payment_duration` (`id`, `plan_id`, `paymentduration_id`) VALUES
(3, 9, 3),
(4, 9, 4),
(5, 5, 2),
(6, 5, 1),
(7, 5, 3),
(8, 5, 4);

-- --------------------------------------------------------

--
-- Table structure for table `plan_payment_type`
--

CREATE TABLE `plan_payment_type` (
  `id` int(11) NOT NULL,
  `plan_id` int(11) NOT NULL DEFAULT '0',
  `paymenttype_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `plan_payment_type`
--

INSERT INTO `plan_payment_type` (`id`, `plan_id`, `paymenttype_id`) VALUES
(4, 9, 4),
(5, 9, 5),
(6, 9, 6),
(7, 5, 4),
(8, 5, 3),
(9, 5, 2);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(25) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(25) NOT NULL,
  `refer_friend` varchar(255) NOT NULL,
  `hear_about_us` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deletedAt` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `password`, `phone`, `refer_friend`, `hear_about_us`, `status`, `createdAt`, `updatedAt`, `deletedAt`) VALUES
(1, 'sam', 'admin@paylanes.com', 'd41d8cd98f00b204e9800998ecf8427e', '0987654321', 'ggh', 'jj', 1, '2021-07-27 03:01:16', '2021-07-27 03:01:16', 0),
(2, 'Addy addy', 'admin@paylanes1.com', 'fcea920f7412b5da7be0cf42b8c93759', '0987654321', '', '', 1, '2021-07-27 03:08:30', '2021-07-27 03:08:30', 0),
(3, 'rajesh', 'rajesh12245@yopmail.com', '7d07c172bb0ee75696755dfd21513bcf', '8956234758', 'test friend', 'test hear about use', 1, '2021-07-27 14:13:00', '2021-07-27 14:13:00', 0),
(4, 'Addy', 'addy@yopmail.com', 'd41d8cd98f00b204e9800998ecf8427e', '98765432101', 'bob', 'Peter', 1, '2021-07-28 00:26:26', '2021-07-28 00:26:26', 0),
(5, 'pankag', 'pankaj@paylanes.com', 'e10adc3949ba59abbe56e057f20f883e', '07565080090', 'aassd', 'KK internamtional', 1, '2021-07-28 01:29:36', '2021-07-28 01:29:36', 0),
(6, 'Addy addy', 'admin@paylanes.com', 'f8c0af2560b070c5aac6a8d7eb484991', '0987654321', '', '', 1, '2021-07-28 01:35:59', '2021-07-28 01:35:59', 0),
(7, 'sd', 'sd@gmail.com', 'd41d8cd98f00b204e9800998ecf8427e', '0987654321', '', '', 1, '2021-08-03 06:24:53', '2021-08-03 06:24:53', 1),
(8, ' peter', 'peter12@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '6789654321', '', '', 1, '2021-08-03 11:29:16', '2021-08-03 11:29:16', 0);

-- --------------------------------------------------------

--
-- Table structure for table `userpin`
--

CREATE TABLE `userpin` (
  `id` int(11) NOT NULL,
  `code` varchar(50) NOT NULL,
  `used` int(11) NOT NULL DEFAULT '1',
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cash`
--
ALTER TABLE `cash`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_cash` (`cash_fundtype_id`);

--
-- Indexes for table `cash_fundtype`
--
ALTER TABLE `cash_fundtype`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loan_apply`
--
ALTER TABLE `loan_apply`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `paymentduration`
--
ALTER TABLE `paymentduration`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `paymenttype`
--
ALTER TABLE `paymenttype`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `plan`
--
ALTER TABLE `plan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `plan_payment_duration`
--
ALTER TABLE `plan_payment_duration`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `plan_payment_type`
--
ALTER TABLE `plan_payment_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userpin`
--
ALTER TABLE `userpin`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cash`
--
ALTER TABLE `cash`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `cash_fundtype`
--
ALTER TABLE `cash_fundtype`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `loan_apply`
--
ALTER TABLE `loan_apply`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `paymentduration`
--
ALTER TABLE `paymentduration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `paymenttype`
--
ALTER TABLE `paymenttype`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `plan`
--
ALTER TABLE `plan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `plan_payment_duration`
--
ALTER TABLE `plan_payment_duration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `plan_payment_type`
--
ALTER TABLE `plan_payment_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `userpin`
--
ALTER TABLE `userpin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `cash`
--
ALTER TABLE `cash`
  ADD CONSTRAINT `cash_ibfk_1` FOREIGN KEY (`cash_fundtype_id`) REFERENCES `cash_fundtype` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
