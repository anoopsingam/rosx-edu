-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 21, 2022 at 04:48 PM
-- Server version: 5.6.51
-- PHP Version: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `srimarut_sns`
--

-- --------------------------------------------------------

--
-- Table structure for table `account2`
--

CREATE TABLE `account` (
  `id` int(25) NOT NULL,
  `student_name` varchar(250) DEFAULT NULL,
  `student_id` varchar(250) DEFAULT NULL,
  `class` varchar(250) DEFAULT NULL,
  `section` varchar(250) DEFAULT NULL,
  `total_fee` varchar(250) DEFAULT '0',
  `fee_paid` varchar(250) DEFAULT '0',
  `fee_balance` varchar(250) DEFAULT '0',
  `fee_status` varchar(250) DEFAULT NULL,
  `last_installment` varchar(250) DEFAULT NULL,
  `last_paid_date` varchar(250) DEFAULT NULL,
  `last_collected_by` varchar(250) DEFAULT NULL,
  `academic_year` varchar(250) DEFAULT NULL,
  `token_id` varchar(250) DEFAULT NULL,
  `rcd` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `account2`
--

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account2`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account2`
--
ALTER TABLE `account`
  MODIFY `id` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
