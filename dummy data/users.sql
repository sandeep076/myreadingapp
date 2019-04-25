-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Mar 13, 2019 at 04:37 PM
-- Server version: 5.7.23
-- PHP Version: 7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `ks1reading`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Rose Huffman', 'rosehuffman@gmail.com', '$2y$10$Cc.3ZBBSWEyt.0QZsH0jjOqYIMWhBUSh0Z6dIOyouUw8LqDBiGYpS', 'Lzg9b3GY1Oc0PkawgN1Ri6v0kbj4fziFuOhK6qZocF83LjG7163Q19HPTgxm', '2018-12-05 16:53:59', '2018-12-05 16:53:59'),
(2, 'Lexi Erickson', 'lexierickson@hotmail.com', '$2y$10$sdLaDOJ9fK54peh.z0Fb2eRu9S/KAmF3K9UjCwls949pNCpO.QkUm', 'fVmGEVxHiQWQgUOMkMq1jyccVVYicRcPg40yjFPVtzQwG30xwgIhsb8HMWZO', '2019-03-13 16:24:35', '2019-03-13 16:24:35'),
(3, 'Sylvia Cooper', 'cooper33@gmail.com', '$2y$10$w6rtqTgwT26GO4gaIhA/COidq1JW9Ly4CTVPgsOMWIoQYoUpETFiO', 'fdyWFHML0QppeUIXiKr2fXQ3WhvyuaXOcegpYhq2JJy9xn0TcWVZLYk8QhJO', '2019-03-13 16:33:29', '2019-03-13 16:33:29'),
(4, 'Amelia Sharp', 'sharp@hotmail.co.uk', '$2y$10$wL9XKPI2wByfen9Vl2ISFeBRAViDzr5pgyvxOr1zBLiv8PqLGEh46', 'NwdJ16pYlf0DbeDyhulixp21PFIAtBzxOMsj1RYWzKIgDPBaB3YvjjSo3qCr', '2019-03-13 16:34:02', '2019-03-13 16:34:02'),
(5, 'Felix Flowers', 'flower3@gmail.com', '$2y$10$K4O4IpLjNI.ttBxevjelruRiTlQUG3dkrGLy9joFoZc4Setyp6Kjq', 'irBdG6k6v5Z1sAtUCUPLRlhMEk723xVVuHiwAIZOVknfpsFNAUVwe5YvOKRg', '2019-03-13 16:34:25', '2019-03-13 16:34:25'),
(6, 'Siena Waters', 'waterss@hotmail.com', '$2y$10$0DhZjeyoIkWcs9KD3MrWgOcttm3Lpix6kAwtOXaV5avl0k/tA83yG', 'u4STLT0V6zNprhmWxwKd8nRU4gO93kxdUznGWX39Wxj0D19JYrmqy7x2JOiY', '2019-03-13 16:34:50', '2019-03-13 16:34:50'),
(7, 'Jude Duarte', 'duartejude@gmail.com', '$2y$10$r3WSV0RZcZ2a/soz9V4t/u06yehIwkusxKMv8SObh1dGhmIKguldq', 'sUqvbpBOQhrrozQ3vy26NFkqwaPTnS8vx6uwNkoapaCyWoUozp3jieyNl6UW', '2019-03-13 16:35:55', '2019-03-13 16:35:55'),
(8, 'Roger Schmidt', 'schmidtroger4@hotmail.com', '$2y$10$RMQ8k3Zm11PH1g7PvgyXNuUTCLE2WfpXMz7TsS1h3w3sMisQq3APW', 'MtEQrt8Z8HCmQjMLTvcswppH5gyvF6ePc18uIEg1Tz9BesNoIR9MIo3cgN77', '2019-03-13 16:36:14', '2019-03-13 16:36:14'),
(9, 'Hugo Hendricks', 'hugoev19@hotmail.com', '$2y$10$FwqZjffmkII1NbAsUWxpR.5X1BKr/MgP.nQbTc8h/gEJcwc2DyQLW', 'EzJHEpVtddBzhEJPWZJgXxrWgDmYNNSGJXKzKXOUoYPOGxZHaneDquB1i2lo', '2019-03-13 16:36:31', '2019-03-13 16:36:31');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
