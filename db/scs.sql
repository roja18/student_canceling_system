-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 18, 2024 at 12:53 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `scs`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `apid` int(11) NOT NULL,
  `aid` int(11) NOT NULL,
  `username` varchar(150) NOT NULL,
  `statuz` varchar(20) NOT NULL DEFAULT 'Coming....'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`apid`, `aid`, `username`, `statuz`) VALUES
(1, 1, 'student@gmil.com', 'Coming....');

-- --------------------------------------------------------

--
-- Table structure for table `availability`
--

CREATE TABLE `availability` (
  `aid` int(11) NOT NULL,
  `consultant_username` varchar(150) NOT NULL,
  `available_date` date NOT NULL,
  `statuz` varchar(30) NOT NULL DEFAULT 'available'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `availability`
--

INSERT INTO `availability` (`aid`, `consultant_username`, `available_date`, `statuz`) VALUES
(1, 'jigue@gmail.com', '2024-06-21', 'Taken'),
(2, 'jigue@gmail.com', '2024-06-21', 'Taken'),
(4, 'jigue@gmail.com', '2024-06-03', 'Taken');

-- --------------------------------------------------------

--
-- Table structure for table `chart`
--

CREATE TABLE `chart` (
  `cid` int(11) NOT NULL,
  `sender` varchar(150) NOT NULL,
  `receiver` varchar(150) NOT NULL,
  `message` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `chart`
--

INSERT INTO `chart` (`cid`, `sender`, `receiver`, `message`, `timestamp`) VALUES
(1, 'student@gmil.com', 'Consultant', 'hi', '2024-06-18 10:02:15'),
(2, 'student@gmil.com', 'jigue@gmail.com', 'my roja', '2024-06-18 10:13:12'),
(3, 'student@gmil.com', 'jigue@gmail.com', 'hellow too', '2024-06-18 10:13:34'),
(4, 'jigue@gmail.com', 'student@gmil.com', 'yes how a you', '2024-06-18 10:45:11'),
(5, 'student@gmil.com', 'jigue@gmail.com', 'am fine how a you too', '2024-06-18 10:46:42'),
(6, 'jigue@gmail.com', 'student@gmil.com', 'good', '2024-06-18 10:47:02');

-- --------------------------------------------------------

--
-- Table structure for table `consultant_sessions`
--

CREATE TABLE `consultant_sessions` (
  `csid` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `sid` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `consultant_sessions`
--

INSERT INTO `consultant_sessions` (`csid`, `username`, `sid`) VALUES
(3, 'jigue@gmail.com', 4);

-- --------------------------------------------------------

--
-- Table structure for table `session`
--

CREATE TABLE `session` (
  `sid` int(11) NOT NULL,
  `sname` varchar(100) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `session`
--

INSERT INTO `session` (`sid`, `sname`, `description`) VALUES
(3, 'LIFE STYLE', 'life is carry a lot of goods'),
(2, 'FOOTBALL', 'sport is like life'),
(4, 'EDUCATION', 'get guide in your education life');

-- --------------------------------------------------------

--
-- Table structure for table `students_sessions`
--

CREATE TABLE `students_sessions` (
  `ssid` int(11) NOT NULL,
  `username` varchar(150) NOT NULL,
  `session` varchar(100) NOT NULL,
  `consultant` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `students_sessions`
--

INSERT INTO `students_sessions` (`ssid`, `username`, `session`, `consultant`) VALUES
(1, 'student@gmil.com', '4', 'jigue@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `uid` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `passwords` varchar(255) NOT NULL,
  `userType` varchar(50) NOT NULL,
  `fullname` varchar(150) NOT NULL,
  `phone` int(11) NOT NULL,
  `gender` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uid`, `username`, `passwords`, `userType`, `fullname`, `phone`, `gender`) VALUES
(1, 'noniyaza@gmail.com', '$2y$10$epkWEM/648AAMIK6fDq/BOWWmCjXEBIsK98q8kd4HWphK7/Xe6ZR.', 'Students', 'KASIMU MGANGA', 786009901, ''),
(2, 'kasimumganga@gmail.com', '$2y$10$IdJIdPSeYQGzyorby2NWwOxEulG9wb01mUpDiByORNVHjcPzdjIzq', 'Students', 'KASIMU MGANGA', 786009901, ''),
(3, 'administrator@gmail.com', '$2y$10$y9xO2upPgeaXvkjSpLKxeut9KtFxN/8RHONp/fJNJGJKSmlv3W7Z2', 'Admin', 'ADMIN ADMIN', 1111111111, ''),
(4, 'student@gmil.com', '$2y$10$BR6cPn2nHM.EpXNl8JAE2ODOy/LY65WNjoYC325cGvebTCV/m93w6', 'Students', 'KASIMU MGANGA', 1234567890, ''),
(5, 'koka@gmail.com', '$2y$10$PW/y3ynfhQoCLdOb.fNY8OErK3pAqN4..7WGGQY63/l69AIQmIHFe', 'Students', 'KOKA JUMA', 9876432, ''),
(7, 'kasimumganga0@gmail.com', '$2y$10$2OT0AeJX65bleviZhE/JDed9z5VM2joCTU5M03RSOQX/en.PxHqLG', 'Consultant', 'KASIMU MGANGA', 123456789, 'Male'),
(8, 'jigue@gmail.com', '$2y$10$xq8UtsHVI7Tt782Fk2YhRuYwP.t7YmoSHllXcULRaXzVDSFwvMG5.', 'Consultant', 'JIGUE SIONI', 1234567890, 'Male');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`apid`);

--
-- Indexes for table `availability`
--
ALTER TABLE `availability`
  ADD PRIMARY KEY (`aid`);

--
-- Indexes for table `chart`
--
ALTER TABLE `chart`
  ADD PRIMARY KEY (`cid`);

--
-- Indexes for table `consultant_sessions`
--
ALTER TABLE `consultant_sessions`
  ADD PRIMARY KEY (`csid`);

--
-- Indexes for table `session`
--
ALTER TABLE `session`
  ADD PRIMARY KEY (`sid`);

--
-- Indexes for table `students_sessions`
--
ALTER TABLE `students_sessions`
  ADD PRIMARY KEY (`ssid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`uid`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `apid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `availability`
--
ALTER TABLE `availability`
  MODIFY `aid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `chart`
--
ALTER TABLE `chart`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `consultant_sessions`
--
ALTER TABLE `consultant_sessions`
  MODIFY `csid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `session`
--
ALTER TABLE `session`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `students_sessions`
--
ALTER TABLE `students_sessions`
  MODIFY `ssid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
