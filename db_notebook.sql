-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 26, 2021 at 06:02 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_notebook`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendence`
--

CREATE TABLE `attendence` (
  `id` int(100) NOT NULL,
  `stud_id` int(100) NOT NULL,
  `att_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `attendence`
--

INSERT INTO `attendence` (`id`, `stud_id`, `att_date`) VALUES
(1, 1, '0000-00-00'),
(2, 3, '0000-00-00'),
(3, 4, '0000-00-00'),
(4, 6, '0000-00-00'),
(5, 7, '0000-00-00'),
(6, 8, '0000-00-00'),
(7, 1, '2021-11-25'),
(8, 3, '2021-11-25'),
(9, 4, '2021-11-25'),
(10, 5, '2021-11-25'),
(11, 6, '2021-11-25'),
(12, 7, '2021-11-25'),
(13, 8, '2021-11-25');

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE `notes` (
  `id` int(100) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `title` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `img` varchar(100) NOT NULL DEFAULT 'https://5.imimg.com/data5/IG/FC/GLADMIN-51382316/veg-berger-500x500.png',
  `created_on` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notes`
--

INSERT INTO `notes` (`id`, `user_email`, `title`, `content`, `img`, `created_on`) VALUES
(4, 'rajesh@gmail.com', 'Php day 1', 'hsdjhsjhdhsj\r\nsdsdsbsh', 'https://5.imimg.com/data5/IG/FC/GLADMIN-51382316/veg-berger-500x500.png', '2021-11-24 12:12:11'),
(6, 'aisha22@gmail.com', 'PHP V8', 'Hello World', 'images/1637815362_Mechanical-2D.png', '2021-11-25 10:12:42'),
(7, 'aisha22@gmail.com', 'test', 'test', 'https://5.imimg.com/data5/IG/FC/GLADMIN-51382316/veg-berger-500x500.png', '2021-11-25 09:24:03'),
(8, 'aisha22@gmail.com', 'car', 'Auddi', 'images/1637814975_hx3gb6BMnlj1mW5YG1jzyHXQOdLJY8WNI0npVCn1.png', '2021-11-25 10:06:15');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(100) NOT NULL,
  `student_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `student_name`) VALUES
(1, 'Deepti Ranjan Sahoo'),
(2, 'Subrat Patra'),
(3, 'Prakash Hembram'),
(4, 'Amit Singh'),
(5, 'Jyotiranjan Mallik'),
(6, 'G Pavitra'),
(7, 'Aisha Patra'),
(8, 'Rajesh Biswas');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `pass` varchar(100) NOT NULL,
  `profile_img` varchar(100) NOT NULL DEFAULT 'https://cdn-icons-png.flaticon.com/512/147/147144.png',
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullname`, `email`, `pass`, `profile_img`, `created_at`) VALUES
(1, 'Rajesh Biswas', 'rajesh@gmail.com', '8dd43ae0638e1ce2690e2e3cfa653923', 'https://cdn-icons-png.flaticon.com/512/147/147144.png', '2021-11-24 10:17:47'),
(2, 'aisha', 'aisha22@gmail.com', '832dbb9272d5154ae768870db688b208', 'images/1637813785_Announcements.png', '2021-11-24 12:13:44');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendence`
--
ALTER TABLE `attendence`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendence`
--
ALTER TABLE `attendence`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
