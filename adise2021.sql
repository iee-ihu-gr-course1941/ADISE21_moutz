-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 14, 2022 at 09:52 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `adise2021`
--

-- --------------------------------------------------------

--
-- Table structure for table `activerooms`
--

CREATE TABLE `activerooms` (
  `roomid` int(11) NOT NULL,
  `playerturn` int(11) NOT NULL,
  `gamestatus` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `activerooms`
--

INSERT INTO `activerooms` (`roomid`, `playerturn`, `gamestatus`) VALUES
(3, 84, 1);

-- --------------------------------------------------------

--
-- Table structure for table `cards`
--

CREATE TABLE `cards` (
  `id` int(11) NOT NULL,
  `v` varchar(4) NOT NULL,
  `c` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cards`
--

INSERT INTO `cards` (`id`, `v`, `c`) VALUES
(1, '1', 'C'),
(2, '1', 'D'),
(3, '1', 'H'),
(4, '1', 'S'),
(5, '2', 'C'),
(6, '2', 'D'),
(7, '2', 'H'),
(8, '2', 'S'),
(9, '3', 'C'),
(10, '3', 'D'),
(11, '3', 'H'),
(12, '3', 'S'),
(13, '4', 'C'),
(14, '4', 'D'),
(15, '4', 'H'),
(16, '4', 'S'),
(17, '5', 'C'),
(18, '5', 'D'),
(19, '5', 'H'),
(20, '5', 'S'),
(21, '6', 'C'),
(22, '6', 'D'),
(23, '6', 'H'),
(24, '6', 'S'),
(25, '7', 'C'),
(26, '7', 'D'),
(27, '7', 'H'),
(28, '7', 'S'),
(29, '8', 'C'),
(30, '8', 'D'),
(31, '8', 'H'),
(32, '8', 'S'),
(33, '9', 'C'),
(34, '9', 'D'),
(35, '9', 'H'),
(36, '9', 'S'),
(37, '10', 'C'),
(38, '10', 'D'),
(39, '10', 'H'),
(40, '10', 'S'),
(41, 'K', 'D');

-- --------------------------------------------------------

--
-- Table structure for table `friends`
--

CREATE TABLE `friends` (
  `id` int(11) NOT NULL,
  `id_senter` int(11) NOT NULL,
  `id_receiver` int(11) NOT NULL,
  `accepted` bit(1) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `friends`
--

INSERT INTO `friends` (`id`, `id_senter`, `id_receiver`, `accepted`, `created_at`) VALUES
(12, 0, 0, NULL, '2021-12-15 06:05:42'),
(13, 0, 0, NULL, '2021-12-15 06:06:12'),
(14, 0, 0, NULL, '2021-12-15 06:06:25'),
(15, 0, 0, NULL, '2021-12-15 06:06:46'),
(16, 0, 0, NULL, '2021-12-15 06:06:50'),
(17, 0, 0, NULL, '2021-12-15 06:06:51');

-- --------------------------------------------------------

--
-- Table structure for table `playercards`
--

CREATE TABLE `playercards` (
  `user_id` int(11) NOT NULL,
  `card_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `playercards`
--

INSERT INTO `playercards` (`user_id`, `card_id`) VALUES
(84, 16),
(84, 33),
(84, 12),
(84, 39),
(84, 24),
(84, 19),
(84, 5),
(84, 17),
(84, 31),
(84, 27),
(84, 34),
(84, 2),
(84, 7),
(84, 11),
(84, 3),
(84, 37),
(84, 23),
(84, 10),
(84, 30),
(84, 35),
(84, 1),
(85, 36),
(85, 21),
(85, 25),
(85, 41),
(85, 38),
(85, 40),
(85, 14),
(85, 6),
(85, 28),
(85, 18),
(85, 22),
(85, 9),
(85, 15),
(85, 29),
(85, 13),
(85, 8),
(85, 4),
(85, 32),
(85, 26),
(85, 20);

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `id` int(11) NOT NULL,
  `user1` int(11) NOT NULL,
  `user2` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`id`, `user1`, `user2`) VALUES
(1, 0, 0),
(2, 0, 0),
(3, 84, 85),
(4, 0, 0),
(5, 0, 0),
(6, 0, 0),
(7, 0, 0),
(8, 0, 0),
(9, 0, 0),
(10, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `title` bit(1) DEFAULT NULL,
  `onoff` bit(1) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `title`, `onoff`, `created_at`) VALUES
(81, 'plero', '$2y$10$HDZ9Ol2B2/gMX7cY2diCfeIjCRELf4KYi115DVm2KNY5nvfyFb2TW', '123@gmail.com', NULL, NULL, '2021-12-29 04:16:59'),
(83, 'gogo', '$2y$10$Ll4xmKpiMFzJa.obDHw1wezFeukjdt.pqabvhxsIGb3tcze0aUNFW', 'gogo123@email.com', NULL, NULL, '2022-01-11 16:21:24'),
(84, 'Chrome', '$2y$10$Azt0nM0d8IXPv.0g287/x.aPSzixjFJ0AET92JWsJxFx4PuEW0mfK', '', NULL, NULL, '2022-01-14 16:25:13'),
(85, 'Edge', '$2y$10$C4OXJcrauLJmaKXVpIV1v.Nx1smzQMl84E8NDCCImLkxnRo7HT4xa', 'edge@email.com', NULL, NULL, '2022-01-14 16:34:16'),
(86, 'user1', '$2y$10$0DUfk/Tbm8Mch.SPL2f7ZOcLUZIXCQ7kUW2C07/zuR8DvPAPOZWfG', 'email@email.com', NULL, NULL, '2022-01-14 21:31:32');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cards`
--
ALTER TABLE `cards`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `friends`
--
ALTER TABLE `friends`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cards`
--
ALTER TABLE `cards`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `friends`
--
ALTER TABLE `friends`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
