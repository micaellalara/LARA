-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 13, 2023 at 01:20 PM
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
-- Database: `user_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity`
--

CREATE TABLE `activity` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `address` varchar(255) NOT NULL,
  `ootd` varchar(255) NOT NULL,
  `status` varchar(255) DEFAULT NULL,
  `activity_datetime` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `activity`
--

INSERT INTO `activity` (`id`, `name`, `date`, `time`, `address`, `ootd`, `status`, `activity_datetime`) VALUES
(17, 'xzxzxz', '2023-10-24', '16:56:00', 'xzxzxz', 'jeans', 'Canceled', '2023-10-13 16:53:09'),
(19, 'xzxzz', '2023-10-10', '16:57:00', 'xzxz', 'xzx', 'Finished', '2023-10-13 16:53:23');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `sender` varchar(255) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `sender`, `message`, `timestamp`) VALUES
(1, 'Admin', 'hellloooo', '2023-10-13 04:42:30'),
(4, 'Admin', 'Hello, I might not gonna be going to the mall with you gus. Sorry.', '2023-10-13 04:44:52'),
(5, 'Admin', 'Hello, I might not gonna be going to the mall with you gus. Sorry.', '2023-10-13 04:51:49'),
(6, 'Admin', 'hallo pepss', '2023-10-13 04:55:25');

-- --------------------------------------------------------

--
-- Table structure for table `user_form`
--

CREATE TABLE `user_form` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` varchar(255) NOT NULL DEFAULT 'user',
  `gender` enum('Male','Female') NOT NULL,
  `status` varchar(8) NOT NULL DEFAULT 'inactive',
  `registration_datetime` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_form`
--

INSERT INTO `user_form` (`id`, `name`, `email`, `password`, `user_type`, `gender`, `status`, `registration_datetime`) VALUES
(3, 'Michael', 'michael@gmail.com', 'michael', 'user', 'Male', 'inactive', '2023-10-11 04:40:29'),
(4, 'Rovs', 'Rovs@gmail.com', 'rovrov', 'user', 'Female', 'inactive', '2023-10-11 04:40:29'),
(6, 'Michael Lara', 'michael@gmail.com', 'michaellara', 'user', 'Male', 'active', '2023-10-11 04:40:29'),
(10, 'Roselle', 'roselle@gmail.com', 'roselle', 'user', 'Female', 'inactive', '2023-10-11 04:40:29'),
(11, 'anna', 'anna@gmail.com', 'anna2024', 'user', 'Female', 'inactive', '2023-10-11 04:40:29'),
(12, 'Charity', 'cha@gmail.com', 'chacha', 'user', 'Female', 'inactive', '2023-10-11 08:23:25'),
(14, 'Micaella Angela Lara', 'micaella@gmail.com', 'micaella2004', 'admin', 'Female', 'inactive', '2023-10-12 08:55:03'),
(15, 'Rovelyn Paradero', 'rovelyn@hotmail.com', 'rovrov', 'user', 'Female', 'inactive', '2023-10-12 08:57:15'),
(16, 'Anne Castro', 'anne@gmail.com', 'annyeong', 'user', 'Female', 'inactive', '2023-10-12 08:57:42'),
(17, 'Jenelyn Pepito', 'jen@gmail.com', 'jenjen', 'user', 'Female', 'inactive', '2023-10-12 08:58:05'),
(18, 'Teresito Lara', 'bordet@gmail.com', 'bords', 'user', 'Male', 'inactive', '2023-10-12 08:59:12'),
(19, 'Ranilo Lara', 'ranel@gmail.com', 'ranel', 'user', 'Male', 'inactive', '2023-10-12 08:59:33'),
(20, 'Zijan Lara', 'jan@gmail.com', 'janjan', 'user', 'Male', 'inactive', '2023-10-12 08:59:59'),
(21, 'John Andrie Lara', 'jeje@gmail.com', 'jeje', 'user', 'Male', 'inactive', '2023-10-12 09:00:23'),
(22, 'Isabelita J. Lara', 'letty@gmail.com', 'letty24', 'user', 'Female', 'inactive', '2023-10-12 09:00:56'),
(23, 'Endrita J. Lara', 'endrit@gmail.com', 'endrit', 'user', 'Female', 'inactive', '2023-10-12 09:01:15'),
(24, 'Crischan Joe Lara', 'joe@gmail.com', 'jojo', 'user', 'Male', 'inactive', '2023-10-12 09:19:33'),
(25, 'Chielo Elguerra', 'chielo@hotmail.com', 'chielot16', 'user', 'Female', 'inactive', '2023-10-13 11:05:43');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity`
--
ALTER TABLE `activity`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_form`
--
ALTER TABLE `user_form`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity`
--
ALTER TABLE `activity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user_form`
--
ALTER TABLE `user_form`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
