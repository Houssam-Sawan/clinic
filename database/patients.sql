-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 19, 2020 at 09:22 AM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 5.6.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `clinic`
--

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `patientID` int(10) NOT NULL,
  `first_name` varchar(200) NOT NULL,
  `last_name` varchar(200) DEFAULT NULL,
  `age` int(10) NOT NULL,
  `gender` enum('male','female','other','') NOT NULL,
  `marital_status` enum('single','married','other','') NOT NULL,
  `blood_group` enum('A+','A-','B+','AB+','AB-','B-','O+','O-','other') NOT NULL,
  `address` varchar(250) DEFAULT NULL,
  `phone_number` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`patientID`, `first_name`, `last_name`, `age`, `gender`, `marital_status`, `blood_group`, `address`, `phone_number`, `created_at`, `updated_at`, `deleted_at`) VALUES
(3, 'test02', 'test', 44, 'male', 'single', 'A+', 'ebr', '07510282416', NULL, NULL, NULL),
(4, 'test01', 'test', 44, 'male', 'single', 'A+', '', '', NULL, '2020-01-18 23:25:52', NULL),
(5, 'test03', 'test', 44, 'male', 'single', 'A+', 'ebr', '07510282416', '0000-00-00 00:00:00', NULL, NULL),
(6, 'test04', 'test', 44, 'male', 'single', 'A+', 'ebr', '07510282416', '0000-00-00 00:00:00', NULL, NULL),
(7, 'test05', 'test', 44, 'male', 'single', 'A+', 'ebr', '07510282416', '2020-01-18 23:29:01', NULL, NULL),
(8, 'Houssam', 'Sawan', 46, '', 'married', '', 'Erbilscasdvcaddvsadvasdvdvsdvsdvsdvasdvsdvsdvs', '07510282416', '2020-01-19 01:45:24', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`patientID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `patientID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
