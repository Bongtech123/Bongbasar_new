-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 02, 2020 at 01:57 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bag`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_payment_policy`
--

CREATE TABLE `tbl_payment_policy` (
  `id` int(11) NOT NULL,
  `uniqcode` varchar(30) NOT NULL,
  `description` longtext NOT NULL,
  `status` enum('Inactive','Active','Delete') NOT NULL DEFAULT 'Active',
  `datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_payment_policy`
--

INSERT INTO `tbl_payment_policy` (`id`, `uniqcode`, `description`, `status`, `datetime`) VALUES
(1, 'cbHg6GaYpPFBRLlq8Q9w', '<p>gdfgfdgfd</p>\r\n', 'Active', '2020-09-19 01:27:47');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_payment_policy`
--
ALTER TABLE `tbl_payment_policy`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_payment_policy`
--
ALTER TABLE `tbl_payment_policy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
