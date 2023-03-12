-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 12, 2023 at 03:04 AM
-- Server version: 5.7.25
-- PHP Version: 7.1.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventory_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblproducts`
--

CREATE TABLE `tblproducts` (
  `id_autonun` int(11) NOT NULL,
  `pcode` varchar(15) NOT NULL,
  `pdesc` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tblproducts`
--

INSERT INTO `tblproducts` (`id_autonun`, `pcode`, `pdesc`) VALUES
(1, 'MON1T012', 'LCD 15 INCH MONITOR'),
(2, 'MO4578', 'MOUSE USB'),
(4, 'TESTS', 'FSAFASDFA'),
(5, 'CHA234', 'MONOBLOCK CHAIR'),
(7, 'TEST AGFAINB', 'AIRCON AGAIN');

-- --------------------------------------------------------

--
-- Table structure for table `tblprod_data`
--

CREATE TABLE `tblprod_data` (
  `data_id` int(11) NOT NULL,
  `id_autonun` int(11) NOT NULL,
  `qty` varchar(5) NOT NULL,
  `price` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tblprod_data`
--

INSERT INTO `tblprod_data` (`data_id`, `id_autonun`, `qty`, `price`) VALUES
(2, 5, '500', '1000'),
(3, 1, '30', '200');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tblproducts`
--
ALTER TABLE `tblproducts`
  ADD PRIMARY KEY (`id_autonun`);

--
-- Indexes for table `tblprod_data`
--
ALTER TABLE `tblprod_data`
  ADD PRIMARY KEY (`data_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tblproducts`
--
ALTER TABLE `tblproducts`
  MODIFY `id_autonun` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tblprod_data`
--
ALTER TABLE `tblprod_data`
  MODIFY `data_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
