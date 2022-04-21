-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 21, 2022 at 03:28 PM
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
-- Table structure for table `academic_tution_fee`
--

CREATE TABLE `academic_tution_fee` (
  `id` int(20) NOT NULL,
  `class` varchar(250) DEFAULT NULL,
  `academic_year` varchar(250) DEFAULT NULL,
  `tution_fee` varchar(250) DEFAULT NULL,
  `added_by` varchar(250) DEFAULT NULL,
  `added_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_on` varchar(250) DEFAULT NULL,
  `updated_by` varchar(250) DEFAULT NULL,
  `token_id` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `academic_tution_fee`
--

INSERT INTO `academic_tution_fee` (`id`, `class`, `academic_year`, `tution_fee`, `added_by`, `added_on`, `updated_on`, `updated_by`, `token_id`) VALUES
(1, '10', '2021-22', '22000', 'principal', '2021-12-16 17:03:39', NULL, NULL, '61bb24026b44a');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `academic_tution_fee`
--
ALTER TABLE `academic_tution_fee`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `academic_tution_fee`
--
ALTER TABLE `academic_tution_fee`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
