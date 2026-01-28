-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 24, 2025 at 10:55 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `4007db`
--

-- --------------------------------------------------------

--
-- Table structure for table `application`
--

CREATE TABLE `application` (
  `a_id` int(8) NOT NULL,
  `a_title` varchar(255) NOT NULL,
  `a_fullname` varchar(255) NOT NULL,
  `a_birthday` date DEFAULT NULL,
  `a_education` varchar(255) NOT NULL,
  `a_position` varchar(255) NOT NULL,
  `a_skill` varchar(255) NOT NULL,
  `a_experience` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `application`
--

INSERT INTO `application` (`a_id`, `a_title`, `a_fullname`, `a_birthday`, `a_education`, `a_position`, `a_skill`, `a_experience`) VALUES
(1, 'นางสาว', 'ดวงรักษา อรเพ็ชร', '2000-12-08', 'ปวช.', 'โปรแกรมเมอร์', 'no', 'no'),
(2, 'นางสาว', 'ดวงรักษา อรเพ็ชร', '2000-12-30', 'มัธยมศึกษา', 'โปรแกรมเมอร์', 'no', 'no'),
(3, 'นางสาว', 'ดวงรักษา อรเพ็ชร', '2000-12-31', 'ปวช.', 'ธุรการ', 'no', 'no'),
(4, 'นางสาว', 'ดวงรักษา อรเพ็ชร', '2000-12-31', 'มัธยมศึกษา', 'เจ้าหน้าที่การตลาด', 'no', 'no'),
(5, 'นางสาว', 'ดวง มนี', '2000-12-17', 'ปริญญาตรี', 'โปรแกรมเมอร์', 'php pythone', 'DevWeb'),
(6, 'นาย', 'David', '1999-02-03', 'ปริญญาโท', 'โปรแกรมเมอร์', 'anything', 'anything'),
(7, 'นาย', 'David', '2000-12-24', 'ปริญญาโท', 'โปรแกรมเมอร์', 'Anything', 'Anything');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `application`
--
ALTER TABLE `application`
  ADD PRIMARY KEY (`a_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `application`
--
ALTER TABLE `application`
  MODIFY `a_id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
