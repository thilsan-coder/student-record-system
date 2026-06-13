-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 28, 2025 at 05:39 PM
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
-- Database: `student_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `course` varchar(100) DEFAULT NULL,
  `year` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `name`, `email`, `course`, `year`) VALUES
(14, 'Haazeem', 'anverahnaf12@gmail.com', 'Bsc in Computer Science', '1st Year'),
(15, 'musraf kan', 'musaraf@gmail.com', 'HND AGRI', '2nd Year'),
(16, 'Hana', 'fathimahana@gmail.com', 'HND IT', '1st Year'),
(17, 'mahmootha', 'mahmootha@gmail.com', 'BICT.Hones', '2nd Year'),
(18, 'Ala Shifak', 'alashifak@gmail.com', 'HND IT', '1st year'),
(19, 'afkan', 'askan@gmail.com', 'HND AGRI', '4th Year');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` enum('admin','user') DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`) VALUES
(1, 'Thilsan', 'mohammedthilsan55@gmail.com', '$2y$10$HvU0QSnepky20PsGEJ1Pw.CTrhzaYzwVbwFb0Dq9hoCMGL7KtB97i', 'admin'),
(38, 'mahmootha', 'mahmootha@gmail.com', '$2y$10$eOnzUpKyyZ1uYXNLdk2CJutPBrmdhw1G8Yr8mJ3Qj3qBg5v0CX5Re', 'user'),
(40, 'mahmootha', 'mahmootha55@gmail.com', '$2y$10$tnRr5Twur.C/Q/h6FMAVhufiuDO6u3kMBb/JRrkw6sBdYexeur2ui', 'admin'),
(41, 'Ala Shifak', 'alashifak@gmail.com', '$2y$10$Y2xgxiDAOODkH0tw0ZWzt.aRkZ4ehj0.8SrlqWqKaJiv3fnOmyfEu', 'admin'),
(42, 'thilsan', 'til@gmail.com', '$2y$10$vJVUhFRuY/ovgc9v2ckYNuQkhrQjbBERgwMb1QqzZYD8jebJ4Ke6O', 'user'),
(43, 'sajith', 'sajith@gmail.com', '$2y$10$m5rgM/V1KhUa9OFPOZ.Y4uumcb6Rg9SJFgF9xjxtK.0fbHaiAuzOi', 'admin'),
(44, 'asloof', 'asloof@gmail.com', '$2y$10$CBGm5edp1sIHXhM5zgMi4eCxBU/JojUUhBfpkUlxPix2Af4QT2YiG', 'admin'),
(45, 'shifa', 'shifa@gmail.com', '$2y$10$/fhc.BkyU4OihzPFnWau9O7Z7rI0X6D6a6PwuQZM.HFEDnyfsnxLi', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
