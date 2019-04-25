--
-- Host: localhost:8889
-- Generation Time: Mar 23, 2019 at 02:06 PM
-- Server version: 5.7.23
-- PHP Version: 7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `ks1reading`
--

-- --------------------------------------------------------

--
-- Table structure for table `pupils`
--

CREATE TABLE `pupils` (
  `pupilID` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `readingLevel` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `className` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `pupils`
--

INSERT INTO `pupils` (`pupilID`, `name`, `readingLevel`, `className`, `id`) VALUES
(1, 'Lilly Smith', 'Lilac', 'Tulip', 2),
(2, 'Carey Huffman', 'Yellow', 'Rose', 2),
(3, 'Candace Erickson', 'Blue', 'Rose', 3),
(4, 'James Cooper', 'Green', 'Tulip', 4),
(5, 'Mariana Sharp', 'Yellow', 'Tulip', 5),
(6, 'Chris Flowers', 'Blue', 'Tulip', 6),
(7, 'Nicole Waters', 'Green', 'Rose', 7),
(8, 'Robert Duarte', 'Yellow', 'Rose', 8),
(9, 'Eva Schmidt', 'Blue', 'Rose', 9),
(10, 'Calliope Hendricks', 'Green', 'Tulip', 10);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pupils`
--
ALTER TABLE `pupils`
  ADD PRIMARY KEY (`pupilID`),
  ADD KEY `pupils_id_foreign` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pupils`
--
ALTER TABLE `pupils`
  MODIFY `pupilID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pupils`
--
ALTER TABLE `pupils`
  ADD CONSTRAINT `pupils_ibfk_1` FOREIGN KEY (`id`) REFERENCES `users` (`id`);