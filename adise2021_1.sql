-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Εξυπηρετητής: 127.0.0.1
-- Χρόνος δημιουργίας: 10 Ιαν 2022 στις 20:15:34
-- Έκδοση διακομιστή: 10.4.22-MariaDB
-- Έκδοση PHP: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Βάση δεδομένων: `adise2021`
--

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `activerooms`
--

CREATE TABLE `activerooms` (
  `roomid` int(11) NOT NULL,
  `playerturn` int(11) NOT NULL,
  `gamestatus` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Άδειασμα δεδομένων του πίνακα `activerooms`
--

INSERT INTO `activerooms` (`roomid`, `playerturn`, `gamestatus`) VALUES
(2, 0, 0),
(2, 0, 0),
(2, 0, 0),
(2, 0, 0),
(2, 0, 0),
(2, 0, 0),
(2, 0, 0),
(2, 0, 0),
(2, 0, 0),
(2, 0, 0),
(2, 0, 0),
(2, 0, 0),
(2, 0, 0),
(2, 0, 0),
(1, 1, 1),
(1, 1, 0);

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `cards`
--

CREATE TABLE `cards` (
  `id` int(11) NOT NULL,
  `v` varchar(4) NOT NULL,
  `c` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Άδειασμα δεδομένων του πίνακα `cards`
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
-- Δομή πίνακα για τον πίνακα `friends`
--

CREATE TABLE `friends` (
  `id` int(11) NOT NULL,
  `id_senter` int(11) NOT NULL,
  `id_receiver` int(11) NOT NULL,
  `accepted` bit(1) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Άδειασμα δεδομένων του πίνακα `friends`
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
-- Δομή πίνακα για τον πίνακα `playercards`
--

CREATE TABLE `playercards` (
  `user_id` int(11) NOT NULL,
  `card_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `room`
--

CREATE TABLE `room` (
  `id` int(11) NOT NULL,
  `user1` int(11) NOT NULL,
  `user2` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Άδειασμα δεδομένων του πίνακα `room`
--

INSERT INTO `room` (`id`, `user1`, `user2`) VALUES
(1, 1, 2),
(2, 0, 0),
(3, 5, 0),
(4, 7, 0),
(5, 8, 0),
(6, 6, 0),
(7, 44, 0),
(8, 45, 0),
(9, 41, 0),
(10, 46, 0),
(11, 433, 0),
(12, 4343, 0),
(13, 0, 4344),
(14, 43244, 432444),
(15, 221, 0);

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `users`
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
-- Άδειασμα δεδομένων του πίνακα `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `title`, `onoff`, `created_at`) VALUES
(78, 'sdddadsaaaa111111111ad@freeemail.com', '$2y$10$Xk0kqwd6Axolk7cxYbGXW.Woa2nNmvqsTzD1B.sbO51mzkwb2QERe', 'sdddadsaaaa111111111ad@freeemail.com', NULL, NULL, '2021-12-27 02:51:10'),
(79, 'sadsad@freeemail.com', '$2y$10$XZdJ7LJ7J5gSR4tP.6VNgehwl2bgehS.ujDclsFqqGtf6cj1RblEC', 'sadsad@freeemail.com', NULL, NULL, '2021-12-29 00:04:00'),
(80, 'sdddadsaaaaad@freeemail.com', '$2y$10$fVYBJt0TG.zsgqenIGWV1ekb19WkTQN/nvuSxZkLN8/FYyUkZQYCS', 'sdddadsaaaaad@freeemail.com', NULL, NULL, '2021-12-29 04:05:45'),
(81, 'plero', '$2y$10$HDZ9Ol2B2/gMX7cY2diCfeIjCRELf4KYi115DVm2KNY5nvfyFb2TW', '123@gmail.com', NULL, NULL, '2021-12-29 04:16:59'),
(82, '', '$2y$10$/IAFtP/63nnT8lI5N5mXpOrc4vgH377b5GmpczgEzM16f8nE.chdS', '', NULL, NULL, '2021-12-30 06:10:28');

--
-- Ευρετήρια για άχρηστους πίνακες
--

--
-- Ευρετήρια για πίνακα `cards`
--
ALTER TABLE `cards`
  ADD PRIMARY KEY (`id`);

--
-- Ευρετήρια για πίνακα `friends`
--
ALTER TABLE `friends`
  ADD PRIMARY KEY (`id`);

--
-- Ευρετήρια για πίνακα `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`id`);

--
-- Ευρετήρια για πίνακα `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT για άχρηστους πίνακες
--

--
-- AUTO_INCREMENT για πίνακα `cards`
--
ALTER TABLE `cards`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT για πίνακα `friends`
--
ALTER TABLE `friends`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT για πίνακα `room`
--
ALTER TABLE `room`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT για πίνακα `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
