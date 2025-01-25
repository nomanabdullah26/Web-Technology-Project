-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 20, 2025 at 08:32 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hms1`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `SL_no` int(11) NOT NULL,
  `D_ID` int(11) DEFAULT NULL,
  `P_ID` int(11) DEFAULT NULL,
  `D_name` text DEFAULT NULL,
  `P_name` text DEFAULT NULL,
  `appointment_date` date NOT NULL,
  `time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `doctor_signup`
--

CREATE TABLE `doctor_signup` (
  `D_ID` int(11) NOT NULL,
  `D_name` text NOT NULL,
  `D_uname` text NOT NULL,
  `D_email` text NOT NULL,
  `D_phone` int(11) NOT NULL,
  `D_address` text NOT NULL,
  `D_specialist` text NOT NULL,
  `D_pass` text NOT NULL,
  `D_cpass` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `medical_records`
--

CREATE TABLE `medical_records` (
  `record_id` int(11) NOT NULL,
  `P_ID` int(11) DEFAULT NULL,
  `P_name` text DEFAULT NULL,
  `blood_group` varchar(10) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `gender` enum('Male','Female','Other') DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `medical_history` text DEFAULT NULL,
  `prescriptions` text DEFAULT NULL,
  `test_results` text DEFAULT NULL,
  `ongoing_treatments` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `patient_signup`
--

CREATE TABLE `patient_signup` (
  `P_ID` int(11) NOT NULL,
  `P_name` text NOT NULL,
  `P_uname` text NOT NULL,
  `P_email` text NOT NULL,
  `P_phone` int(11) NOT NULL,
  `P_address` text NOT NULL,
  `P_pass` text NOT NULL,
  `P_cpass` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`SL_no`),
  ADD KEY `D_ID` (`D_ID`),
  ADD KEY `P_ID` (`P_ID`);

--
-- Indexes for table `doctor_signup`
--
ALTER TABLE `doctor_signup`
  ADD PRIMARY KEY (`D_ID`),
  ADD UNIQUE KEY `D_uname` (`D_uname`) USING HASH;

--
-- Indexes for table `medical_records`
--
ALTER TABLE `medical_records`
  ADD PRIMARY KEY (`record_id`),
  ADD KEY `P_ID` (`P_ID`);

--
-- Indexes for table `patient_signup`
--
ALTER TABLE `patient_signup`
  ADD PRIMARY KEY (`P_ID`),
  ADD UNIQUE KEY `P_uname` (`P_uname`) USING HASH;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `SL_no` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `doctor_signup`
--
ALTER TABLE `doctor_signup`
  MODIFY `D_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `medical_records`
--
ALTER TABLE `medical_records`
  MODIFY `record_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `patient_signup`
--
ALTER TABLE `patient_signup`
  MODIFY `P_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `appointments_ibfk_1` FOREIGN KEY (`D_ID`) REFERENCES `doctor_signup` (`D_ID`),
  ADD CONSTRAINT `appointments_ibfk_2` FOREIGN KEY (`P_ID`) REFERENCES `patient_signup` (`P_ID`);

--
-- Constraints for table `medical_records`
--
ALTER TABLE `medical_records`
  ADD CONSTRAINT `medical_records_ibfk_1` FOREIGN KEY (`P_ID`) REFERENCES `patient_signup` (`P_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
