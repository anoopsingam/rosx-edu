-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 14, 2022 at 04:11 PM
-- Server version: 5.7.33
-- PHP Version: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cca`
--

-- --------------------------------------------------------

--
-- Table structure for table `general_invoice`
--

CREATE TABLE `general_invoice` (
  `billing_id` bigint(250) NOT NULL,
  `invoice_no` varchar(250) DEFAULT NULL,
  `invoice_date` date DEFAULT NULL,
  `payment_status` varchar(250) NOT NULL DEFAULT 'PENDING',
  `stu_id` varchar(250) DEFAULT NULL,
  `particulars` text,
  `total_amount` bigint(250) NOT NULL DEFAULT '0',
  `payment_mode` varchar(250) NOT NULL DEFAULT 'CASH',
  `account_type` varchar(250) NOT NULL DEFAULT 'ACC',
  `created_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `login_id` varchar(250) DEFAULT NULL,
  `updated_on` varchar(250) DEFAULT NULL,
  `token_id` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `general_invoice`
--

INSERT INTO `general_invoice` (`billing_id`, `invoice_no`, `invoice_date`, `payment_status`, `stu_id`, `particulars`, `total_amount`, `payment_mode`, `account_type`, `created_on`, `login_id`, `updated_on`, `token_id`) VALUES
(6, 'INV202200001', '2022-05-13', 'PAID', 'SMPU0046', '[{\"particulars_id\":\"CAMPUS BUS FEES LOCAL\",\"charges\":\"8000\"},{\"particulars_id\":\"EXAMINATION FEE 2ND PU\",\"charges\":\"2345\"}]', 10345, 'CASH', 'ACC', '2022-05-13 11:22:18', 'anoop', NULL, '627df205477b0'),
(7, 'INV202200002', '2022-04-29', 'PAID', 'SMPU0040', '[{\"particulars_id\":\"CAMPUS BUS FEES LOCAL\",\"charges\":\"8000\"},{\"particulars_id\":\"CET BOOKS CHARGES\",\"charges\":\"7854\"},{\"particulars_id\":\"EXAMINATION FEE 2ND PU\",\"charges\":\"2345\"}]', 18199, 'CASH', 'NACC', '2022-05-13 11:23:13', 'anoop', NULL, '627df233eab31');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `general_invoice`
--
ALTER TABLE `general_invoice`
  ADD PRIMARY KEY (`billing_id`),
  ADD KEY `invoice_no` (`invoice_no`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `general_invoice`
--
ALTER TABLE `general_invoice`
  MODIFY `billing_id` bigint(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
