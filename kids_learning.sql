-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 30, 2025 at 12:19 PM
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
-- Database: `kids_learning`
--

-- --------------------------------------------------------

--
-- Table structure for table `scores`
--

CREATE TABLE `scores` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `module` varchar(20) NOT NULL,
  `score` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `scores`
--

INSERT INTO `scores` (`id`, `username`, `module`, `score`, `created_at`) VALUES
(2, 'zakaria', 'math', 1, '2025-04-26 08:07:02'),
(3, 'zakaria', 'spelling', 1, '2025-04-26 08:09:59'),
(4, 'zakaria', 'spelling', 2, '2025-04-26 08:10:05'),
(5, 'zakaria', 'spelling', 3, '2025-04-26 08:10:11'),
(6, 'zakaria', 'spelling', 3, '2025-04-26 08:20:39'),
(7, 'zakaria', 'clock', 1, '2025-04-26 08:24:14'),
(8, 'zakaria', 'spelling', 1, '2025-04-26 10:52:24'),
(9, 'zakaria', 'spelling', 2, '2025-04-26 10:52:33'),
(10, 'zakaria', 'spelling', 3, '2025-04-26 10:52:42'),
(11, 'zakaria', 'spelling', 4, '2025-04-26 10:53:50'),
(12, 'zakaria', 'spelling', 5, '2025-04-26 10:53:55'),
(13, 'zakaria', 'clock', 1, '2025-04-26 11:36:42'),
(14, 'zakaria', 'math', 1, '2025-04-27 10:23:41'),
(15, 'zakaria', 'math', 1, '2025-04-27 10:24:02'),
(16, 'zakaria', 'math', 1, '2025-04-28 10:07:01'),
(17, 'zakaria', 'spelling', 1, '2025-04-28 10:07:26'),
(18, 'zakaria', 'math', 1, '2025-04-29 16:32:54'),
(19, 'zakaria', 'math', 1, '2025-04-29 16:33:11'),
(20, 'zakaria', 'math', 1, '2025-04-29 16:33:27'),
(21, 'zakaria', 'spelling', 1, '2025-04-29 16:34:11');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `created_at`) VALUES
(1, 'zakaria', '$2y$10$B1mJfVTlN5No2TzCwV9vce8FcUZRZJ4zLd/EJBbQeFcajrZvONkzK', '2025-04-26 08:06:38'),
(2, 'xZ4ckB', '$2y$10$h9tY4gPvnclfnAoc6cfdCuSS/E3ZN/2Bbmfy10h8yPwFppVS2gk8m', '2025-04-27 10:39:26'),
(3, 'oussama', '$2y$10$qXXQTS0mBi9IiHI7orE4fups7Vnvr5LXuENcN0nJeD9CJkVQzeaO.', '2025-04-29 17:57:14'),
(4, 'taha', '$2y$10$NxnEMQAmbPQb02f5/DEA5Oa9Rq/8muafz/cTdQOs0u3HddMXMeLoS', '2025-04-29 18:02:37');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `scores`
--
ALTER TABLE `scores`
  ADD PRIMARY KEY (`id`),
  ADD KEY `scores_ibfk_1` (`username`);

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
-- AUTO_INCREMENT for table `scores`
--
ALTER TABLE `scores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `scores`
--
ALTER TABLE `scores`
  ADD CONSTRAINT `scores_ibfk_1` FOREIGN KEY (`username`) REFERENCES `users` (`username`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
