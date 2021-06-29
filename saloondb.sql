-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 29, 2021 at 12:17 PM
-- Server version: 10.4.16-MariaDB
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `saloondb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `regNo` varchar(25) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `regNo`, `password`) VALUES
(1, 'admin', 'admin@gmail.com', '7701015522222', '1234@Abc');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `categoryName` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `categoryName`) VALUES
(4, 'Barber');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` varchar(14) NOT NULL,
  `password` varchar(120) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `name`, `email`, `mobile`, `password`) VALUES
(4, 'admins', 'admin2@gmail.com', '', '1234@Abc'),
(6, 'student', 'test@gmail.com', '', '1234@Abc'),
(7, 'test', 'customer@gmail.com', '0833333333', '1234@Abc');

-- --------------------------------------------------------

--
-- Table structure for table `desk`
--

CREATE TABLE `desk` (
  `slot` int(11) NOT NULL,
  `time` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `desk`
--

INSERT INTO `desk` (`slot`, `time`, `status`) VALUES
(1, '', 'busy'),
(2, '', 'available');

-- --------------------------------------------------------

--
-- Table structure for table `saloon`
--

CREATE TABLE `saloon` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `regNo` varchar(25) NOT NULL,
  `about` varchar(255) DEFAULT NULL,
  `address` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `mobile` varchar(14) NOT NULL,
  `status` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `saloon`
--

INSERT INTO `saloon` (`id`, `name`, `email`, `regNo`, `about`, `address`, `location`, `mobile`, `status`, `password`) VALUES
(1, 'Sammy-Marks hair care', 'sammy@gmail.com', '2547855555555', 'WE are all about beauty and we have the best stuff to handle all you request at the fastest speed and you can make booking and all other customed', 'cnr,visagie & lillian ngoyi street', '-25.744688197336384,28.19484939541335', '0812548888', '', '1234@Abc'),
(2, 'SunnySide Beauty Care', 'sunny@gmail.com', '2547855555522', 'WE are all about beauty and we have the best stuff to handle all you request at the fastest speed and you can make booking and all other customed', 'Madiba & steve biko, flat 41, room 207', '-25.754585545001277,28.207632838514733', '0812548822', '', '1234@Abc'),
(3, 'Acadia Saloon', 'acadia@gmail.com', '2547855555511', 'WE are all about beauty and we have the best stuff to handle all you request at the fastest speed and you can make booking and all other customed', 'suncadia flat 307 ', '-25.73996046806139,28.21176600127299', '0812548811', '', '1234@Abc');

-- --------------------------------------------------------

--
-- Table structure for table `search`
--

CREATE TABLE `search` (
  `searchID` int(11) NOT NULL,
  `customerID` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

CREATE TABLE `service` (
  `id` int(11) NOT NULL,
  `serviceName` varchar(30) NOT NULL,
  `price` float NOT NULL,
  `duration` int(30) NOT NULL,
  `categoryID` int(11) NOT NULL,
  `saloonID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `service`
--

INSERT INTO `service` (`id`, `serviceName`, `price`, `duration`, `categoryID`, `saloonID`) VALUES
(1, 'haircut', 200, 1, 4, 1),
(5, 'chiskop', 50, 1, 4, 2),
(6, 'cutt', 50, 2, 4, 3),
(7, 'trim', 5, 1, 4, 3);

-- --------------------------------------------------------

--
-- Table structure for table `session`
--

CREATE TABLE `session` (
  `id` int(11) NOT NULL,
  `startTime` varchar(255) NOT NULL,
  `endTime` varchar(255) NOT NULL,
  `service` int(11) NOT NULL,
  `price` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `bookDate` varchar(255) NOT NULL,
  `duration` varchar(11) NOT NULL,
  `saloonID` int(11) NOT NULL,
  `customerID` int(11) NOT NULL,
  `stuffID` int(11) NOT NULL,
  `status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `session`
--

INSERT INTO `session` (`id`, `startTime`, `endTime`, `service`, `price`, `date`, `bookDate`, `duration`, `saloonID`, `customerID`, `stuffID`, `status`) VALUES
(1, '15:00', '17:00', 6, '50', 'Tue Jun 29 2021', '2021 Jun Mon 22:40', '2', 3, 6, 2, 'active'),
(2, '15:00', '16:00', 5, '50', 'Wed Jun 30 2021', '2021 Jun Mon 23:41', '1', 2, 6, 4, 'cancelled');

-- --------------------------------------------------------

--
-- Table structure for table `stuff`
--

CREATE TABLE `stuff` (
  `stuffID` int(11) NOT NULL,
  `stuffName` varchar(255) NOT NULL,
  `stuff-email` varchar(255) NOT NULL,
  `stuff-image` varchar(255) DEFAULT NULL,
  `saloonID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stuff`
--

INSERT INTO `stuff` (`stuffID`, `stuffName`, `stuff-email`, `stuff-image`, `saloonID`) VALUES
(1, 'brilliant Mask', 'mask@gmail.com', NULL, 1),
(2, 'Dizzy Mk', 'mk@gmail.com', NULL, 3),
(3, 'Molly Losser', 'losser@gmail.com', NULL, 2),
(4, 'Less Chiz', 'stf@gmail.com', NULL, 2),
(5, 'Boss Kine', 'kine@gmail.com', NULL, 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `desk`
--
ALTER TABLE `desk`
  ADD PRIMARY KEY (`slot`);

--
-- Indexes for table `saloon`
--
ALTER TABLE `saloon`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `search`
--
ALTER TABLE `search`
  ADD PRIMARY KEY (`searchID`);

--
-- Indexes for table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `session`
--
ALTER TABLE `session`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stuff`
--
ALTER TABLE `stuff`
  ADD PRIMARY KEY (`stuffID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `desk`
--
ALTER TABLE `desk`
  MODIFY `slot` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `saloon`
--
ALTER TABLE `saloon`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `search`
--
ALTER TABLE `search`
  MODIFY `searchID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `service`
--
ALTER TABLE `service`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `session`
--
ALTER TABLE `session`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `stuff`
--
ALTER TABLE `stuff`
  MODIFY `stuffID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
