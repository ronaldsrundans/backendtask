-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 21, 2020 at 05:18 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `api_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `cards`
--

CREATE TABLE `cards` (
  `id` int(11) NOT NULL,
  `number` varchar(8) NOT NULL,
  `series` varchar(2) NOT NULL,
  `period` int(1) NOT NULL,
  `issue` date DEFAULT NULL,
  `expiry` date DEFAULT NULL,
  `sum` int(11) NOT NULL DEFAULT 0,
  `status` varchar(10) NOT NULL DEFAULT 'active',
  `name` varchar(14) NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cards`
--

INSERT INTO `cards` (`id`, `number`, `series`, `period`, `issue`, `expiry`, `sum`, `status`, `name`, `deleted`) VALUES
(1, '00000000', 'CC', 12, '2020-07-07', '2020-07-08', 0, 'active', 'PC00000000CC12', 1),
(2, '00000001', 'CC', 12, '2020-07-07', '2020-07-07', 0, 'not active', 'PC00000001CC12', 1),
(3, '00000000', 'LC', 6, '2020-07-07', '2020-07-07', 0, 'active', 'PC00000000LC06', 0),
(4, '00000001', 'LC', 6, '2020-07-07', '2020-07-08', 0, 'not active', 'PC00000001LC06', 1),
(5, '00000002', 'LC', 6, '2020-07-07', '2020-07-08', 0, 'active', 'PC00000002LC06', 0),
(6, '00000003', 'LC', 6, '2020-07-07', '2020-07-08', 0, 'active', 'PC00000003LC06', 0),
(7, '00000000', 'CC', 1, '1970-01-01', '1970-01-01', 0, 'expired', 'PC00000000CC01', 0),
(8, '00000001', 'CC', 1, '1970-01-01', '1970-01-01', 0, 'expired', 'PC00000001CC01', 0),
(9, '00000002', 'CC', 1, '1970-01-01', '1970-01-01', 110, 'not active', 'PC00000002CC01', 1),
(10, '00000002', 'CC', 12, '1970-01-01', '1970-01-01', 666, 'expired', 'PC00000002CC12', 0),
(11, '00000000', 'LC', 12, '1970-01-01', '1970-01-01', 666, 'expired', 'PC00000000LC12', 0),
(12, '00000001', 'LC', 12, '1970-01-01', '1970-01-01', 666, 'active', 'PC00000001LC12', 0),
(13, '00000003', 'CC', 12, '2020-07-19', '1970-01-01', 666, 'expired', 'PC00000003CC12', 0),
(14, '00000004', 'CC', 12, '2020-07-19', '2021-07-19', 666, 'active', 'PC00000004CC12', 0),
(15, '00000005', 'CC', 12, '2020-07-19', '2021-07-19', 666, 'active', 'PC00000005CC12', 0),
(16, '00000003', 'CC', 1, '2020-07-19', '2020-08-19', 666, 'active', 'PC00000003CC01', 0),
(17, '00000004', 'CC', 1, '2020-07-19', '2020-08-19', 999, 'active', 'PC00000004CC01', 0),
(18, '00000005', 'CC', 1, '2020-07-19', '2020-08-19', 999, 'active', 'PC00000005CC01', 0),
(19, '00000006', 'CC', 1, '2020-07-19', '2020-08-19', 999, 'active', 'PC00000006CC01', 0),
(20, '00000006', 'CC', 12, '2020-07-19', '2021-07-19', 123, 'not active', 'PC00000006CC12', 0),
(21, '00000007', 'CC', 1, '2020-07-20', '2020-08-20', 0, 'active', 'PC00000007CC01', 0),
(22, '00000008', 'CC', 1, '2020-07-20', '2020-08-20', 10101, 'active', 'PC00000008CC01', 0),
(23, '00000009', 'CC', 1, '2020-07-20', '2020-08-20', 6969, 'active', 'PC00000009CC01', 0),
(24, '00000000', 'BC', 1, '2020-07-20', '2020-08-20', 69, 'active', 'PC00000000BC01', 0),
(25, '00000007', 'CC', 12, '2020-07-21', '2021-07-21', 12, 'active', 'PC00000007CC12', 0),
(26, '00000008', 'CC', 12, '2020-07-21', '2021-07-21', 12, 'active', 'PC00000008CC12', 0),
(27, '00000009', 'CC', 12, '2020-07-21', '2021-07-21', 12, 'active', 'PC00000009CC12', 0),
(28, '00000010', 'CC', 12, '2020-07-21', '2021-07-21', 12, 'active', 'PC00000010CC12', 0),
(29, '00000011', 'CC', 12, '2020-07-21', '2021-07-21', 12, 'active', 'PC00000011CC12', 0),
(30, '00000012', 'CC', 12, '2020-07-21', '2021-07-21', 12, 'active', 'PC00000012CC12', 0),
(31, '00000013', 'CC', 12, '2020-07-21', '2021-07-21', 0, 'active', 'PC00000013CC12', 0),
(32, '00000014', 'CC', 12, '2020-07-21', '2021-07-21', 0, 'active', 'PC00000014CC12', 0),
(33, '00000015', 'CC', 12, '2020-07-21', '2021-07-21', 0, 'active', 'PC00000015CC12', 0),
(34, '00000016', 'CC', 12, '2020-07-21', '2021-07-21', 0, 'active', 'PC00000016CC12', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cards`
--
ALTER TABLE `cards`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cards`
--
ALTER TABLE `cards`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
