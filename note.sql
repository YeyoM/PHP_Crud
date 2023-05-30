-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 30, 2023 at 06:27 PM
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
-- Database: `note`
--

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE `notes` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `description` text DEFAULT NULL,
  `color` text NOT NULL,
  `pinned` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notes`
--

INSERT INTO `notes` (`id`, `title`, `description`, `color`, `pinned`, `created_at`, `updated_at`) VALUES
(14, 'What', 'Hola 2', 'primary', 0, '2023-01-24 00:33:30', '2023-05-30 10:22:13'),
(17, 'What is Hola', 'HOlaaaaaaaaa', 'primary', 0, '2023-01-24 00:33:30', '2023-05-30 10:11:25'),
(20, 'What is Lorem Ipsum ?', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 'primary', 0, '2023-01-24 00:33:30', '2023-01-24 18:08:17'),
(21, 'What is Lorem Ipsum ?', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 'primary', 0, '2023-01-24 00:33:30', '2023-01-24 18:08:17'),
(23, 'What is Lorem Ipsum ?', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 'primary', 0, '2023-01-24 00:33:30', '2023-01-24 18:08:17'),
(24, 'What is Lorem Ipsum ?', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 'primary', 0, '2023-01-24 00:33:30', '2023-01-24 18:08:17'),
(25, 'What is Lorem Ipsum ?', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 'primary', 0, '2023-01-24 00:33:30', '2023-01-24 18:08:17'),
(37, 'Hola', 'hola', '', 0, '2023-05-30 09:34:00', NULL),
(38, 'What is Lorem Ipsum ?', 'hola', '', 0, '2023-05-30 09:42:34', NULL),
(39, 'What is Lorem Ipsum ?', 'Hola 2', '', 0, '2023-05-30 10:10:08', NULL),
(40, 'Hola', 'Nueva Nota', '', 0, '2023-05-30 10:25:31', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
