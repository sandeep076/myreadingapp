--
-- Host: localhost:8889
-- Generation Time: Mar 23, 2019 at 02:30 PM
-- Server version: 5.7.23
-- PHP Version: 7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `ks1reading`
--

-- --------------------------------------------------------

--
-- Table structure for table `teacher_pupils`
--

CREATE TABLE `teacher_pupils` (
  `teacherID` int(10) UNSIGNED NOT NULL,
  `pupilID` int(10) UNSIGNED NOT NULL,
  `academicYear` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `teacher_pupils`
--

INSERT INTO `teacher_pupils` (`teacherID`, `pupilID`, `academicYear`) VALUES
(2, 1, '2018/19'),
(2, 2, '2018/19'),
(2, 3, '2018/19'),
(2, 4, '2018/19'),
(2, 5, '2018/19'),
(2, 6, '2018/19'),
(2, 7, '2018/19'),
(2, 8, '2018/19'),
(2, 9, '2018/19'),
(2, 10, '2018/19');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `teacher_pupils`
--
ALTER TABLE `teacher_pupils`
  ADD KEY `teacher_pupils_teacherid_foreign` (`teacherID`),
  ADD KEY `teacher_pupils_pupilid_foreign` (`pupilID`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `teacher_pupils`
--
ALTER TABLE `teacher_pupils`
  ADD CONSTRAINT `teacher_pupils_pupilid_foreign` FOREIGN KEY (`pupilID`) REFERENCES `pupils` (`pupilID`),
  ADD CONSTRAINT `teacher_pupils_teacherid_foreign` FOREIGN KEY (`teacherID`) REFERENCES `teachers` (`teacherID`);