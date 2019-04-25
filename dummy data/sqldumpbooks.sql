-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Mar 13, 2019 at 04:09 PM
-- Server version: 5.7.23
-- PHP Version: 7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `ks1reading`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `bookID` int(10) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `author` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `bookBand` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`bookID`, `title`, `author`, `bookBand`, `updated_at`, `created_at`) VALUES
(1, 'Ron Rabbit\'s Big Day', 'Julia Donaldson', 'Yellow', NULL, '2019-03-13 09:00:00'),
(2, 'Big Bad Bug', 'Santiago Cortez', 'Blue', NULL, '2019-03-13 09:00:00'),
(3, 'The Lost Teddy', 'Jane Ramos', 'Orange', NULL, '2019-03-13 09:00:00'),
(4, 'The Little Red Hen', 'Kristin Wall', 'Orange', NULL, '2019-03-13 09:00:00'),
(5, 'Big Feet', 'Adrien Scott', 'Green', NULL, '2019-03-13 09:00:00'),
(6, 'Can You See Me?', 'Can You See Me?', 'Yellow', NULL, '2019-03-13 09:00:00'),
(7, 'Run, run run!', 'Hanna Lyons', 'Turquoise', NULL, '2019-03-13 09:00:00'),
(8, 'A Monster Mistake', 'Julia Donaldson', 'Blue', NULL, '2019-03-13 09:00:00'),
(9, 'Animal Magic', 'Kristin Wall', 'Blue', NULL, '2019-03-13 09:00:00'),
(10, 'Fetch!', 'Dexter Baldwin', 'Yellow', NULL, '2019-03-13 09:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`bookID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `bookID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
