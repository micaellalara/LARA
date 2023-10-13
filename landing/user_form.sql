-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 11, 2023 at 10:25 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_form`
--

INSERT INTO `user_form` (`id`, `name`, `email`, `password`, `user_type`, `gender`, `status`, `registration_datetime`) VALUES
(3, 'Michael', 'michael@gmail.com', 'michael', 'user', 'Male', 'inactive', '2023-10-11 04:40:29'),
(4, 'Rovs', 'Rovs@gmail.com', 'rovrov', 'user', 'Female', 'inactive', '2023-10-11 04:40:29'),
(6, 'Michael Lara', 'michael@gmail.com', 'michaellara', 'user', 'Male', 'inactive', '2023-10-11 04:40:29'),
(7, 'Carmel Mae', 'mae@gmail.com', 'mae2004', 'admin', 'Female', 'inactive', '2023-10-11 04:40:29'),
(10, 'Roselle', 'roselle@gmail.com', 'roselle', 'user', 'Female', 'inactive', '2023-10-11 04:40:29'),
(11, 'anna', 'anna@gmail.com', 'anna2024', 'user', 'Female', 'inactive', '2023-10-11 04:40:29'),
(12, 'Charity', 'cha@gmail.com', 'chacha', 'user', 'Female', 'active', '2023-10-11 08:23:25'),
(13, 'Laiza Hinoo', 'lai@gmail.com', 'lailai', 'admin', 'Female', 'active', '2023-10-11 08:24:50');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user_form`
--
ALTER TABLE `user_form`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user_form`
--
ALTER TABLE `user_form`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
