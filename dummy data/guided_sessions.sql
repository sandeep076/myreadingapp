-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Mar 27, 2019 at 10:22 AM
-- Server version: 5.7.23
-- PHP Version: 7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `ks1reading`
--

-- --------------------------------------------------------

--
-- Table structure for table `guided_sessions`
--

CREATE TABLE `guided_sessions` (
  `sessionID` int(10) NOT NULL,
  `pupilID` int(10) NOT NULL,
  `teacherID` int(10) NOT NULL,
  `bookID` int(11) NOT NULL,
  `notes` varchar(5000) NOT NULL,
  `session_date` date NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `guided_sessions`
--

INSERT INTO `guided_sessions` (`sessionID`, `pupilID`, `teacherID`, `bookID`, `notes`, `session_date`, `updated_at`, `created_at`) VALUES
(1, 1, 2, 3, 'Read with good expression.', '2019-02-12', NULL, NULL),
(2, 1, 2, 4, 'Reading sounded quite stilted today.', '2019-02-13', NULL, NULL),
(3, 1, 2, 5, 'Could sound out new words independently.', '2019-02-12', NULL, NULL),
(4, 2, 2, 1, 'Could not tell me anything about the characters or the story in this book.', '2019-02-13', NULL, NULL),
(5, 3, 2, 6, 'Made numerous mistakes but kept going after I helped with new, unfamiliar words.', '2019-03-14', NULL, NULL),
(6, 4, 2, 5, 'Discussed the characters and story very well.', '2019-02-14', NULL, NULL),
(7, 1, 2, 9, 'Read with greater difficulty than the last session, despite doing well reading at home this past week. Keep this in mind in the next session.', '2019-02-19', NULL, NULL),
(8, 2, 2, 10, 'Read fluently and independently. Could confidently tell me what the story was about. Consider progressing reading level if this continues.', '2019-02-19', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `guided_sessions`
--
ALTER TABLE `guided_sessions`
  ADD PRIMARY KEY (`sessionID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `guided_sessions`
--
ALTER TABLE `guided_sessions`
  MODIFY `sessionID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
