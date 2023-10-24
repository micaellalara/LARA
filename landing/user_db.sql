-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 24, 2023 at 04:00 AM
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
  `activity_datetime` datetime DEFAULT current_timestamp(),
  `userID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `activity`
--

INSERT INTO `activity` (`id`, `name`, `date`, `time`, `address`, `ootd`, `status`, `activity_datetime`, `userID`) VALUES
(19, 'xfgv', '2023-10-10', '16:57:00', 'xzxz', 'xzx', 'Finished', '2023-10-13 16:53:23', 4),
(21, 'css', '2023-01-23', '22:48:00', 'dsds', 'zxxz', 'In progress', '2023-10-18 17:48:21', 0),
(24, 'michael', '2023-11-06', '18:15:00', 'sdad', 'as', 'In progress', '2023-10-18 18:13:19', 0),
(25, 'michael', '2023-11-06', '18:15:00', 'sdad', 'as', 'In progress', '2023-10-18 18:13:55', 0),
(26, 'michael', '2023-11-01', '18:19:00', 'sdad', 'dsds', 'In progress', '2023-10-18 18:14:08', 0),
(27, 'michael', '2023-11-06', '18:51:00', 'sdad', 'dddsds', 'In progress', '2023-10-18 18:47:23', 0),
(28, 'michael', '2023-11-01', '18:19:00', 'sdad', 'dsds', 'In progress', '2023-10-18 18:52:43', 0),
(29, 'basketball', '2023-11-06', '18:01:00', 'xxx', 'xxx', 'In progress', '2023-10-18 18:58:23', 0),
(30, 'basketball', '2023-11-06', '18:01:00', 'hello', 'xxx', 'In progress', '2023-10-18 19:00:21', 4),
(31, 'michael', '2023-11-06', '18:51:00', 'sdad', 'dddsds', 'In progress', '2023-10-18 19:37:44', 14),
(32, 'Laag', '2023-11-28', '10:59:00', 'Mabolo', 'Jeans, Shoes, Duckdive', 'In progress', '2023-10-18 19:59:58', 3),
(33, 'Read Books', '2023-09-22', '00:00:00', 'Venice, Italy', 'Twopiece', 'In progress', '2023-10-18 20:01:15', 10),
(34, 'Skydiving', '2023-06-01', '10:02:00', 'Ocean', 'Parachute', 'In progress', '2023-10-18 20:02:05', 10),
(35, 'Dance Clinic', '2023-05-03', '09:02:00', 'JustJerk Studio', 'Duckdive Sleeve', 'In progress', '2023-10-18 20:03:04', 12),
(36, 'Dance', '2023-10-19', '19:00:00', 'New Era', 'USC Uniform', 'In progress', '2023-10-19 16:58:27', 27);

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
(9, 'Admin', 'Early Bird Registration: Don\'t miss out on our special early bird registration offer for the activities. Register now and enjoy discounted booth prices. Grab your spot before they\'re gone!', '2023-10-18 00:20:44'),
(10, 'Admin', 'Entertainment Galore: Prepare for a night of entertainment like no other at The Hubbie. Live music, dance performances, and more will keep you entertained throughout the evening.', '2023-10-18 00:21:29'),
(11, 'Admin', 'Workshop Sessions:Get ready to enhance your skills with our exclusive workshop sessions at the Cyber Deluxe Hub. Learn from industry experts and take your knowledge to the next level.', '2023-10-18 00:21:49');

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
(3, 'Michael', 'michael@gmail.com', 'michael', 'user', 'Male', 'active', '2023-10-11 04:40:29'),
(4, 'Rovs', 'Rovs@gmail.com', 'rovrov', 'user', 'Female', 'inactive', '2023-10-11 04:40:29'),
(6, 'Michael Lara', 'michael@gmail.com', 'michaellara', 'user', 'Male', 'active', '2023-10-11 04:40:29'),
(10, 'Roselle', 'roselle@gmail.com', 'roselle', 'user', 'Female', 'inactive', '2023-10-11 04:40:29'),
(11, 'anna', 'anna@gmail.com', 'anna2024', 'user', 'Female', 'inactive', '2023-10-11 04:40:29'),
(12, 'Charity', 'cha@gmail.com', 'chacha', 'user', 'Female', 'inactive', '2023-10-11 08:23:25'),
(14, 'Micaella Angela Lara', 'micaella@gmail.com', 'micaella2004', 'admin', 'Female', 'active', '2023-10-12 08:55:03'),
(15, 'Rovelyn Paradero', 'rovelyn@hotmail.com', 'rovrov', 'user', 'Female', 'active', '2023-10-12 08:57:15'),
(16, 'Anne Castro', 'anne@gmail.com', 'annyeong', 'user', 'Female', 'inactive', '2023-10-12 08:57:42'),
(17, 'Jenelyn Pepito', 'jen@gmail.com', 'jenjen', 'user', 'Female', 'inactive', '2023-10-12 08:58:05'),
(18, 'Teresito Lara', 'bordet@gmail.com', 'bords', 'user', 'Male', 'inactive', '2023-10-12 08:59:12'),
(19, 'Ranilo Lara', 'ranel@gmail.com', 'ranel', 'user', 'Male', 'inactive', '2023-10-12 08:59:33'),
(20, 'Zijan Lara', 'jan@gmail.com', 'janjan', 'user', 'Male', 'inactive', '2023-10-12 08:59:59'),
(21, 'John Andrie Lara', 'jeje@gmail.com', 'jeje', 'user', 'Male', 'inactive', '2023-10-12 09:00:23'),
(22, 'Isabelita J. Lara', 'letty@gmail.com', 'letty24', 'user', 'Female', 'inactive', '2023-10-12 09:00:56'),
(23, 'Endrita J. Lara', 'endrit@gmail.com', 'endrit', 'user', 'Female', 'inactive', '2023-10-12 09:01:15'),
(24, 'Crischan Joe Lara', 'joe@gmail.com', 'jojo', 'user', 'Male', 'inactive', '2023-10-12 09:19:33'),
(25, 'Chielo Elguerra', 'chielo@hotmail.com', 'chielot16', 'user', 'Female', 'inactive', '2023-10-13 11:05:43'),
(27, 'Danica Shane', 'danica@gmail.com', 'danica123', 'user', 'Female', 'active', '2023-10-19 08:57:51');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `user_form`
--
ALTER TABLE `user_form`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
