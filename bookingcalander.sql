-- phpMyAdmin SQL Dump
-- version 4.9.7deb1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 01, 2021 at 09:23 AM
-- Server version: 8.0.23-0ubuntu0.20.10.1
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bookingcalander`
--

-- --------------------------------------------------------

--
-- Table structure for table `admindata`
--

CREATE TABLE `admindata` (
  `AdminId` int NOT NULL,
  `AdminName` varchar(20) NOT NULL,
  `AdminPassword` varchar(20) NOT NULL,
  `primaryColor` varchar(7) NOT NULL DEFAULT '#3352ff'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admindata`
--

INSERT INTO `admindata` (`AdminId`, `AdminName`, `AdminPassword`, `primaryColor`) VALUES
(1, 'cumulative', 'mrugesh', '#0011ff');

-- --------------------------------------------------------

--
-- Table structure for table `employeedata`
--

CREATE TABLE `employeedata` (
  `EmployeeId` int NOT NULL,
  `EmployeeImage` varchar(50) NOT NULL,
  `EmployeeName` varchar(20) NOT NULL,
  `EmployeeServiceTitle` varchar(50) NOT NULL,
  `EmployeeNumber` varchar(10) NOT NULL,
  `EmployeeStartTime` time NOT NULL,
  `EmployeeEndTime` time NOT NULL,
  `is_question` tinyint NOT NULL DEFAULT '0',
  `EmployeeWorkingDay` json NOT NULL,
  `Duration` int NOT NULL,
  `Description` varchar(250) DEFAULT NULL
) ;

--
-- Dumping data for table `employeedata`
--

INSERT INTO `employeedata` (`EmployeeId`, `EmployeeImage`, `EmployeeName`, `EmployeeServiceTitle`, `EmployeeNumber`, `EmployeeStartTime`, `EmployeeEndTime`, `is_question`, `EmployeeWorkingDay`, `Duration`, `Description`) VALUES
(1, '../image/1619532897.png', 'Mrugesh Patel', 'Jr.Web Devloper', '7405374066', '09:30:00', '19:30:00', 1, '{\"Friday\": 1, \"Monday\": 1, \"Sunday\": 0, \"Tuesday\": 1, \"Saturday\": 0, \"Thursday\": 1, \"Wednesday\": 0}', 30, '&lt;p&gt;&lt;i&gt;&lt;strong&gt;test after change.&lt;/strong&gt;&lt;/i&gt;&lt;/p&gt;');

-- --------------------------------------------------------

--
-- Table structure for table `employequestion`
--

CREATE TABLE `employequestion` (
  `id` int NOT NULL,
  `EmployeeId` int NOT NULL,
  `question` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `employequestion`
--

INSERT INTO `employequestion` (`id`, `EmployeeId`, `question`) VALUES
(1, 1, 'Q1'),
(6, 1, 'q5'),
(7, 1, 'q6'),
(8, 1, 'q7');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admindata`
--
ALTER TABLE `admindata`
  ADD PRIMARY KEY (`AdminId`);

--
-- Indexes for table `employeedata`
--
ALTER TABLE `employeedata`
  ADD PRIMARY KEY (`EmployeeId`);

--
-- Indexes for table `employequestion`
--
ALTER TABLE `employequestion`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admindata`
--
ALTER TABLE `admindata`
  MODIFY `AdminId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `employeedata`
--
ALTER TABLE `employeedata`
  MODIFY `EmployeeId` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employequestion`
--
ALTER TABLE `employequestion`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
