-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 12, 2020 at 09:31 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lms`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` int(5) NOT NULL,
  `book_name` varchar(70) DEFAULT NULL,
  `book_image` varchar(100) DEFAULT NULL,
  `book_author_name` varchar(50) DEFAULT NULL,
  `book_publication_name` varchar(50) DEFAULT NULL,
  `book_purchase_date` varchar(50) DEFAULT NULL,
  `book_price` varchar(10) DEFAULT NULL,
  `book_qty` int(5) DEFAULT NULL,
  `available_qty` int(5) DEFAULT NULL,
  `librarian_username` varchar(50) DEFAULT NULL,
  `datetime` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `book_name`, `book_image`, `book_author_name`, `book_publication_name`, `book_purchase_date`, `book_price`, `book_qty`, `available_qty`, `librarian_username`, `datetime`) VALUES
(10, 'গনিত বিচিত্রা', '20200403122931.png', 'অজয় সরকার', 'জয়কলি পাবলিকেশন', '2020-04-03', '500', 150, 68, 'sujoy123', '2020-04-03 14:55:03'),
(11, 'STATISTICS FOR BUSINESS AND ECONOMICS', '20200403010454.jpg', 'J S CHANDAN', 'J S CHANDAN', '2020-04-03', '350', 200, 148, 'sujoy123', '2020-04-03 14:55:03');

-- --------------------------------------------------------

--
-- Table structure for table `issue_books`
--

CREATE TABLE `issue_books` (
  `id` int(5) NOT NULL,
  `student_id` int(5) NOT NULL,
  `book_id` int(5) NOT NULL,
  `book_issue_date` varchar(20) NOT NULL,
  `book_return_date` varchar(20) NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `issue_books`
--

INSERT INTO `issue_books` (`id`, `student_id`, `book_id`, `book_issue_date`, `book_return_date`, `datetime`) VALUES
(1, 1, 10, '03-Apr-2020', '03-Apr-2020', '2020-04-03 08:34:24'),
(2, 1, 10, '03-Apr-2020', '03-Apr-2020', '2020-04-03 08:39:20'),
(3, 11, 11, '03-Apr-2020', '03-Apr-2020', '2020-04-03 09:25:26'),
(4, 1, 10, '03-Apr-2020', '03-Apr-2020', '2020-04-03 14:57:12'),
(5, 16, 10, '06-Apr-2020', '', '2020-04-06 15:14:01'),
(6, 16, 11, '06-Apr-2020', '', '2020-04-06 15:15:11'),
(7, 17, 10, '12-Apr-2020', '', '2020-04-12 15:52:49'),
(8, 17, 11, '12-Apr-2020', '', '2020-04-12 15:53:00');

-- --------------------------------------------------------

--
-- Table structure for table `librarian`
--

CREATE TABLE `librarian` (
  `id` int(10) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `mobile` varchar(50) NOT NULL,
  `image` varchar(50) DEFAULT NULL,
  `datetime` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `librarian`
--

INSERT INTO `librarian` (`id`, `fname`, `email`, `username`, `password`, `mobile`, `image`, `datetime`) VALUES
(5, 'sujoy das', 'sujoy15-5750@diu.edu.bd', 'sujoy123', 'sujoy1234', '01521110903', '20200412054216.jpg', '2020-04-12 15:42:16');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `id` int(6) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `roll` int(6) NOT NULL,
  `email` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `phone` varchar(11) NOT NULL,
  `image` varchar(50) DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `fname`, `roll`, `email`, `username`, `password`, `phone`, `image`, `status`, `datetime`) VALUES
(17, 'proloy deb', 155750, 'sujoydas692@gmail.com', 'proloy456', '$2y$10$GNdojCz9kjJ05wb2S36JMevGGOUHQbTSQLoYdty4inl3Yq3nwm8EW', '01521110902', '20200412055118.jpg', 1, '2020-04-12 15:51:18');

-- --------------------------------------------------------

--
-- Table structure for table `token`
--

CREATE TABLE `token` (
  `id` int(5) NOT NULL,
  `email` varchar(50) NOT NULL,
  `token` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `issue_books`
--
ALTER TABLE `issue_books`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `librarian`
--
ALTER TABLE `librarian`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `roll` (`roll`,`phone`);

--
-- Indexes for table `token`
--
ALTER TABLE `token`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `issue_books`
--
ALTER TABLE `issue_books`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `librarian`
--
ALTER TABLE `librarian`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `token`
--
ALTER TABLE `token`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
