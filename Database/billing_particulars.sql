-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 14, 2022 at 04:25 PM
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
-- Table structure for table `billing_particulars`
--

CREATE TABLE `billing_particulars` (
  `id` int(250) NOT NULL,
  `particular_name` varchar(250) NOT NULL DEFAULT 'GENERAL',
  `charges` int(250) NOT NULL DEFAULT '100',
  `created_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `billing_particulars`
--

INSERT INTO `billing_particulars` (`id`, `particular_name`, `charges`, `created_on`) VALUES
(2, 'EXAMINATION FEE 2ND PU', 2345, '2022-05-12 16:54:40'),
(3, 'CET BOOKS CHARGES', 7854, '2022-05-12 16:54:59'),
(4, 'CAMPUS BUS FEES LOCAL', 8000, '2022-05-12 18:08:59');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `billing_particulars`
--
ALTER TABLE `billing_particulars`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `billing_particulars`
--
ALTER TABLE `billing_particulars`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
