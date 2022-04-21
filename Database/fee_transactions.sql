-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 21, 2022 at 05:58 PM
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
-- Database: `srimarut_cca_interconnect`
--

-- --------------------------------------------------------

--
-- Table structure for table `fee_transactions`
--

CREATE TABLE `fee_transactions` (
  `id` int(20) NOT NULL,
  `student_id` varchar(250) DEFAULT NULL,
  `total_fee` varchar(250) DEFAULT NULL,
  `paid_amount` varchar(250) DEFAULT '0',
  `balance_amount` varchar(250) DEFAULT '0',
  `installment` varchar(250) DEFAULT NULL,
  `bill_no` varchar(250) DEFAULT NULL,
  `billing_date` varchar(250) DEFAULT NULL,
  `due_date` varchar(250) DEFAULT NULL,
  `created_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `login_id` varchar(250) DEFAULT NULL,
  `updated_on` varchar(250) DEFAULT NULL,
  `updated_by` varchar(250) DEFAULT NULL,
  `academic_year` varchar(250) DEFAULT NULL,
  `tid` varchar(250) DEFAULT NULL,
  `token_id` varchar(250) DEFAULT NULL,
  `disc_by` varchar(250) DEFAULT 'N/A',
  `disc_amt` varchar(250) DEFAULT NULL,
  `transaction_note` varchar(250) NOT NULL DEFAULT 'No Transction Remarks'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fee_transactions`
--

-- Indexes for dumped tables
--

--
-- Indexes for table `fee_transactions`
--
ALTER TABLE `fee_transactions`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `fee_transactions`
--
ALTER TABLE `fee_transactions`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
