-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Mar 27, 2019 at 10:03 AM
-- Server version: 5.7.23
-- PHP Version: 7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `ks1reading`
--

-- --------------------------------------------------------

--
-- Table structure for table `reading_records`
--

CREATE TABLE `reading_records` (
  `recordID` int(10) UNSIGNED NOT NULL,
  `pupilID` int(10) UNSIGNED NOT NULL,
  `bookID` int(10) NOT NULL,
  `dateAssigned` date NOT NULL,
  `dueDate` date NOT NULL,
  `commentDate` date DEFAULT NULL,
  `comment` varchar(5000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `teacherID` int(10) UNSIGNED NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `reading_records`
--

INSERT INTO `reading_records` (`recordID`, `pupilID`, `bookID`, `dateAssigned`, `dueDate`, `commentDate`, `comment`, `teacherID`, `updated_at`, `created_at`, `id`) VALUES
(1, 1, 1, '2019-01-07', '2019-01-14', '2019-01-08', 'Read pages 1-20. Worded out new words by sounding them out and was able to read familiar words well. Struggled to concentrate towards last few pages.', 2, NULL, '2019-01-06 00:00:00', 11),
(2, 1, 1, '2019-01-07', '2019-01-14', '2019-01-10', 'Read pages 21-50. Worked out some new words independently, though did not understand what she read.', 2, NULL, '2019-01-06 00:00:00', 11),
(3, 1, 2, '2019-01-14', '2019-01-21', '2019-01-17', 'Read up to page 40. Used the picture cues and the first sound of a word to work out words.', 2, NULL, '2019-01-13 00:00:00', 11),
(4, 2, 4, '2019-01-07', '2019-01-14', '2019-01-09', 'Read page 1-50. Able to read this book with lots of help. Ended up using good expression when reading towards the end of the session.', 2, NULL, '2019-01-06 00:00:00', 2),
(5, 3, 8, '2019-01-14', '2019-01-21', '2019-01-14', 'Read up to page 40. Enjoyed reading this book a lot. Could talk about the characters and story very well. With some help, was able to read a few unfamiliar words.', 2, NULL, '2019-01-13 00:00:00', 3),
(6, 4, 7, '2019-01-07', '2019-01-14', '2019-01-08', 'Read up to page 35. He made lots of mistakes when reading because he was not looking carefully enough. Occasionally used the pictures to work out some of the words.', 2, NULL, '2019-01-06 00:00:00', 4),
(7, 1, 2, '2019-02-04', '2019-02-11', '2019-02-04', 'Read up to page 50. Found this quite easy and enjoyable to read, as she read independently most of the time. Only struggled with words on a couple of the pages but she sounded out those new words to work them out.', 2, NULL, '2019-02-03 00:00:00', 11),
(8, 2, 3, '2019-02-04', '2019-02-11', '2019-02-05', 'Read up to page 10. She is finding this book hard to read, so struggled to concentrate past a few pages of reading. Trying to sound out the words was not helping.', 2, NULL, '2019-02-03 00:00:00', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `reading_records`
--
ALTER TABLE `reading_records`
  ADD PRIMARY KEY (`recordID`),
  ADD KEY `reading_records_pupilid_foreign` (`pupilID`),
  ADD KEY `reading_records_teacherid_foreign` (`teacherID`),
  ADD KEY `reading_records_parentid_foreign` (`id`),
  ADD KEY `reading_records_bookID_foreign` (`bookID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `reading_records`
--
ALTER TABLE `reading_records`
  MODIFY `recordID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `reading_records`
--
ALTER TABLE `reading_records`
  ADD CONSTRAINT `reading_records_bookID_foreign` FOREIGN KEY (`bookID`) REFERENCES `books` (`bookID`),
  ADD CONSTRAINT `reading_records_parentid_foreign` FOREIGN KEY (`id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `reading_records_pupilid_foreign` FOREIGN KEY (`pupilID`) REFERENCES `pupils` (`pupilID`),
  ADD CONSTRAINT `reading_records_teacherid_foreign` FOREIGN KEY (`teacherID`) REFERENCES `teachers` (`teacherID`);