-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 27, 2022 at 03:16 PM
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
-- Database: `srimarut_sssvn`
--

-- --------------------------------------------------------

--
-- Table structure for table `expense_cat`
--

CREATE TABLE `expense_cat` (
  `id` int(20) NOT NULL,
  `expense_ho` varchar(250) DEFAULT NULL,
  `expense_desc` varchar(250) DEFAULT NULL,
  `added_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `added_by` varchar(250) DEFAULT NULL,
  `updated_by` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `expense_cat`
--

INSERT INTO `expense_cat` (`id`, `expense_ho`, `expense_desc`, `added_on`, `added_by`, `updated_by`) VALUES
(1, 'Bus Management ', 'School Bus Management Account ', '2021-12-08 01:17:09', 'administrator', 'administrator'),
(2, 'Main Account Office', 'Fee Collection & Trust Account', '2021-12-08 01:20:03', 'administrator', NULL),
(3, 'Other staff salaries', 'Office Admin, Drivers, Ayahs, Cook, Priest, Gardener,', '2021-12-10 15:01:22', 'administrator', NULL),
(4, 'Garden Maintenance', 'Labour, Seeds, Fertilizers, Pesticides, ploughing, weeding.', '2021-12-10 15:03:24', 'administrator', NULL),
(5, 'PF', 'Provident Fund', '2021-12-10 15:04:32', 'administrator', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `expense_cat`
--
ALTER TABLE `expense_cat`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `expense_cat`
--
ALTER TABLE `expense_cat`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
