-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 18, 2020 at 12:42 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.3.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `uiux`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_student_details`
--

CREATE TABLE `tb_student_details` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_student_details`
--

INSERT INTO `tb_student_details` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'karthick', '2020-09-18 15:59:56', '2020-09-18 10:29:56'),
(2, 'karthicks', '2020-09-18 16:09:20', '2020-09-18 10:39:20'),
(3, 'Test User', '2020-09-18 16:11:41', '2020-09-18 10:42:06');

-- --------------------------------------------------------

--
-- Table structure for table `tb_student_marks`
--

CREATE TABLE `tb_student_marks` (
  `mark_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `mark_1` int(3) NOT NULL DEFAULT 0,
  `mark_2` int(3) NOT NULL DEFAULT 0,
  `mark_3` int(3) NOT NULL DEFAULT 0,
  `total` int(3) NOT NULL DEFAULT 0,
  `rank` varchar(5) NOT NULL DEFAULT '',
  `result` enum('Pass','Fail') NOT NULL,
  `created_on` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_student_marks`
--

INSERT INTO `tb_student_marks` (`mark_id`, `student_id`, `mark_1`, `mark_2`, `mark_3`, `total`, `rank`, `result`, `created_on`, `updated_on`) VALUES
(1, 1, 55, 55, 55, 165, '1', 'Pass', '2020-09-18 15:59:56', '2020-09-18 10:29:56'),
(2, 2, 44, 44, 44, 132, '2', 'Pass', '2020-09-18 16:09:20', '2020-09-18 10:39:20'),
(3, 3, 22, 55, 22, 99, '', 'Fail', '2020-09-18 16:11:41', '2020-09-18 10:41:51');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_student_details`
--
ALTER TABLE `tb_student_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_student_marks`
--
ALTER TABLE `tb_student_marks`
  ADD PRIMARY KEY (`mark_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_student_details`
--
ALTER TABLE `tb_student_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_student_marks`
--
ALTER TABLE `tb_student_marks`
  MODIFY `mark_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
