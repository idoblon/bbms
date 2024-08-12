-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 12, 2024 at 11:30 AM
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
-- Database: `blood-bank`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `admin_id` int(11) NOT NULL,
  `fname` varchar(25) NOT NULL,
  `lname` varchar(25) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`admin_id`, `fname`, `lname`, `email`, `password`) VALUES
(1, 'admin', 'admin', 'admin@gmail.com', 'admin123');

-- --------------------------------------------------------

--
-- Table structure for table `blood_requests`
--

CREATE TABLE `blood_requests` (
  `brq_id` int(15) NOT NULL,
  `member_id` int(15) NOT NULL,
  `blood_type` varchar(20) NOT NULL,
  `amount_requested` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blood_requests`
--

INSERT INTO `blood_requests` (`brq_id`, `member_id`, `blood_type`, `amount_requested`) VALUES
(1, 1, 'A positive', 1),
(2, 2, 'O negative', 2),
(3, 3, 'AB positive', 3),
(4, 4, 'A positive', 4);

-- --------------------------------------------------------

--
-- Table structure for table `donors`
--

CREATE TABLE `donors` (
  `donor_id` int(11) NOT NULL,
  `donor_name` varchar(50) NOT NULL,
  `mobile_no` varchar(25) NOT NULL,
  `bloodgroup` varchar(20) NOT NULL,
  `dob` date NOT NULL,
  `gender` varchar(11) NOT NULL,
  `city` varchar(25) NOT NULL,
  `address` varchar(100) NOT NULL,
  `admin_id` int(11) DEFAULT NULL,
  `member_id` int(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `donors`
--

INSERT INTO `donors` (`donor_id`, `donor_name`, `mobile_no`, `bloodgroup`, `dob`, `gender`, `city`, `address`, `admin_id`, `member_id`) VALUES
(1, 'Akshay Patil', '1234567789', 'A positive', '1997-02-05', 'Male', 'Nashik', 'Panchavati', 1, NULL),
(2, 'Aniket Pathare', '2334423443', 'A negative', '1987-12-06', 'Male', 'Nashik', 'Sanjiv Nagar', 1, NULL),
(3, 'Smriti Tambe', '1234512345', 'O negative', '1998-05-15', 'Female', 'Pune', 'Anandwadi', 1, 5),
(4, 'Sushrut Sagar', '1231231235', 'O negative', '1989-08-25', 'Male', 'Pune', 'Agar', 1, NULL),
(5, 'Anvi Kshirsagar', '2345612345', 'AB negative', '2002-11-10', 'Female', 'Mumbai', 'Andheri', 1, NULL),
(6, 'Avinash Dhikale', '2342342345', 'AB negative', '1992-04-12', 'Male', 'Nashik', 'Panchavati', 1, NULL),
(7, 'Nitin Upadhey', '2345623465', 'O positive', '1999-07-22', 'Male', 'Nashik', 'Dwaraka', 1, NULL),
(8, 'Manish Rathe', '8888812345', 'A positive', '2001-03-05', 'Male', 'Mumbai', 'Andheri', 1, NULL),
(9, 'Anushka Sabnis', '2342341234', 'A negative', '1985-09-17', 'Female', 'Pune', 'Anandwadi', 1, NULL),
(10, 'Umesh Chahar', '1234512312', 'O negative', '2001-05-25', 'Male', 'Mumbai', 'Andheri East', 1, NULL),
(11, 'Abhishek Sharma', '1111111111', 'B positive', '2001-07-11', 'Male', 'Nashik', 'Satpur', 1, NULL),
(12, 'Samarth Gandhi', '2223334441', 'O negative', '1989-10-03', 'Male', 'Pune', 'Anandwadi', 1, NULL),
(13, 'Aniket Pawar', '1234457890', 'A negative', '1997-06-20', 'Male', 'Nashik', 'Chunchale Satpur', 1, 6);

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `mem_id` int(15) NOT NULL,
  `fname` varchar(25) NOT NULL,
  `lname` varchar(25) NOT NULL,
  `email` varchar(40) NOT NULL,
  `password` varchar(250) NOT NULL,
  `req_unit` tinyint(1) NOT NULL DEFAULT 0,
  `received` tinyint(1) NOT NULL DEFAULT 0,
  `requested` tinyint(1) NOT NULL DEFAULT 0,
  `admin_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`mem_id`, `fname`, `lname`, `email`, `password`, `req_unit`, `received`, `requested`, `admin_id`) VALUES
(1, 'Akshay', 'Andhare', 'ak@gmail.com', '$2y$12$hGzphuxggCEjjIVO7RJjFO73GNp5z3DvZ5GVExaNEu9.BA/us06TW', 0, 0, 0, 1),
(2, 'Aniket', 'Pathare', 'ani@gmail.com', '$2y$12$v6OEM7gsATeJnnfPNhNVjuwrLXdAB9LOrttjrrEhm90G.pv5bUYCa', 0, 0, 0, 1),
(3, 'Kiran', 'Bendkoli', 'kiranbendkoli24@gmail.com', '$2y$12$dhugXNDHe8dJ.nQsYTk8AOQe/Boze0vvVAo1ws6RZyO6u3P/rS3by', 0, 0, 0, 1),
(4, 'Vishal', 'Shrivastav', 'vishal123@gmail.com', '$2y$12$nvozpiqr0A1.cqKQSZpec.ETmJTg05G0E3i6AiBYT6VvYzBYXB7Dq', 0, 0, 0, 1),
(5, 'Smriti', 'Tambe', 'smriti41@gmail.com', '$2y$12$dPEfzS/VrOHs/Jt7xVqZeeydF2jnpiTIH2nZ36JZm05pWhkI.7mC.', 0, 0, 0, 1),
(6, 'Aniket', 'Paawar', 'aniket@gmail.com', '$2y$12$iE8GalKxw14esRQolbKtD.ihogXyQG7vb9QZJumQJ77JMQoGR9zd.', 0, 0, 0, 1),
(7, 'Bishwa', 'Shah', 's@gmail.com', '$2y$10$WvQYAMnd2q3mpj1CX2asuOTzPjGLU39Oa1ZtiXffXj3LfNDY8KubK', 0, 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `stock_id` int(11) NOT NULL,
  `bloodgroup` varchar(30) NOT NULL,
  `unit` int(11) NOT NULL,
  `admin_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`stock_id`, `bloodgroup`, `unit`, `admin_id`) VALUES
(1, 'A positive', 30, 1),
(2, 'A negative', 30, 1),
(3, 'B positive', 49, 1),
(4, 'B negative', 35, 1),
(5, 'AB positive', 23, 1),
(6, 'AB negative', 40, 1),
(7, 'O positive', 20, 1),
(8, 'O negative', 12, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `blood_requests`
--
ALTER TABLE `blood_requests`
  ADD PRIMARY KEY (`brq_id`),
  ADD KEY `fk_blood_requests_members` (`member_id`);

--
-- Indexes for table `donors`
--
ALTER TABLE `donors`
  ADD PRIMARY KEY (`donor_id`),
  ADD KEY `fk_donors_admins` (`admin_id`),
  ADD KEY `fk_donors_members` (`member_id`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`mem_id`),
  ADD KEY `fk_members_admins` (`admin_id`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`stock_id`),
  ADD KEY `fk_stock_admins` (`admin_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `blood_requests`
--
ALTER TABLE `blood_requests`
  MODIFY `brq_id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `donors`
--
ALTER TABLE `donors`
  MODIFY `donor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `mem_id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `stock_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `blood_requests`
--
ALTER TABLE `blood_requests`
  ADD CONSTRAINT `fk_blood_requests_members` FOREIGN KEY (`member_id`) REFERENCES `members` (`mem_id`) ON DELETE CASCADE;

--
-- Constraints for table `donors`
--
ALTER TABLE `donors`
  ADD CONSTRAINT `fk_donors_admins` FOREIGN KEY (`admin_id`) REFERENCES `admins` (`admin_id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk_donors_members` FOREIGN KEY (`member_id`) REFERENCES `members` (`mem_id`) ON DELETE SET NULL;

--
-- Constraints for table `members`
--
ALTER TABLE `members`
  ADD CONSTRAINT `fk_members_admins` FOREIGN KEY (`admin_id`) REFERENCES `admins` (`admin_id`) ON DELETE SET NULL;

--
-- Constraints for table `stock`
--
ALTER TABLE `stock`
  ADD CONSTRAINT `fk_stock_admins` FOREIGN KEY (`admin_id`) REFERENCES `admins` (`admin_id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
