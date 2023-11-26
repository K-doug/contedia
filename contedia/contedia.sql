-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 26, 2023 at 02:10 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `contedia`
--

-- --------------------------------------------------------

--
-- Table structure for table `form_options`
--

CREATE TABLE `form_options` (
  `UserID` bigint(100) NOT NULL,
  `Name` varchar(20) NOT NULL,
  `Email` varchar(30) NOT NULL,
  `photo` longtext NOT NULL,
  `retailer` enum('Amazon','eBay','Notonthehighstreet','Etsy') NOT NULL,
  `contactable` enum('Yes','No') NOT NULL,
  `preferred` enum('Phone','Email','Post','N/A') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `form_options`
--

INSERT INTO `form_options` (`UserID`, `Name`, `Email`, `photo`, `retailer`, `contactable`, `preferred`) VALUES
(1, 'Katy', 'katydouglas1987@gmail.com', 'Garrett2.jpg', 'Amazon', 'Yes', 'Phone'),
(2, 'Bruno Mars', 'Bruno@mars.org', 'SavageTraction1.jpg', 'Amazon', 'No', 'N/A'),
(3, 'William', 'prince.wills@palace.org', 'BRClass41.jpg', 'eBay', 'Yes', 'Post');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `form_options`
--
ALTER TABLE `form_options`
  ADD PRIMARY KEY (`UserID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `form_options`
--
ALTER TABLE `form_options`
  MODIFY `UserID` bigint(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
