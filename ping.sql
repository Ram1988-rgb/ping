-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 26, 2021 at 06:21 AM
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
  `adminLevelId` int(5) NOT NULL DEFAULT 0,
  `lastLogin` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `addDate` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `addedBy` tinyint(2) NOT NULL DEFAULT 0,
  `modDate` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modBy` tinyint(2) NOT NULL DEFAULT 0,
  `status` enum('0','1') NOT NULL DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  `used` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `adminlogin`
--

INSERT INTO `adminlogin` (`id`, `role_id`, `first_name`, `last_name`, `username`, `password`, `emailId`, `mobile`, `userImage`, `about`, `hash`, `adminLevelId`, `lastLogin`, `addDate`, `addedBy`, `modDate`, `modBy`, `status`, `deleted_at`, `used`) VALUES
(1, 1, 'Sparx', 'Sparx', 'admin', '5cd2a5b4f6241df89e637b11248fb6e7:d4', 'ramprakashsingh.singh@gmail.com', '1245689', 'avatar_e8206a78f1b23667bda8cf87f3c90590.png', 'The quick brown fox jumps right over the lazy dog.', '34256d5a47c2d8149cfe9e4f6851145b7cad158f', -1, '2021-07-26 05:41:01', '2013-08-06 13:41:09', 1, '2017-05-15 05:04:03', 1, '1', NULL, 1),
(36, 27, 'Manjeet', 'Singh', 'manjeet', '4832735d833b71a73c62b1e29abc434a:d4', 'manjeet.singh@sparxitsolutions.com', '', '', '', 'c8076e486cdc86c0cd35f583138d39aa', 0, '2017-03-28 08:31:32', '2017-03-23 09:33:02', 1, '0000-00-00 00:00:00', 0, '1', NULL, 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
