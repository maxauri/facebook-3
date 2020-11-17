-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 17, 2020 at 05:26 PM
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
-- Database: `facebook`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(50) NOT NULL,
  `post_id` int(50) NOT NULL,
  `poster_id` int(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `comment` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `post_id`, `poster_id`, `name`, `comment`) VALUES
(1, 0, 69, 'p.k', 'sdfghjkl'),
(2, 0, 69, 'p.k', 'sdfghjkl'),
(3, 70, 69, 'p.k', 'xcvghjk'),
(4, 70, 69, 'p.k', 'hahahhaha'),
(5, 70, 69, 'p.k', 'hshshhshs'),
(6, 106, 71, 'k.p', 'asdfghjkl'),
(7, 106, 71, 'k.p', 'heyhey'),
(8, 132, 69, 'p.k', 'dsrsrfdytfyytd');

-- --------------------------------------------------------

--
-- Table structure for table `friends`
--

CREATE TABLE `friends` (
  `request_sender` int(50) NOT NULL,
  `request_receiver` int(50) NOT NULL,
  `accepted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `friends`
--

INSERT INTO `friends` (`request_sender`, `request_receiver`, `accepted`) VALUES
(68, 63, 0),
(68, 63, 0),
(68, 64, 0),
(68, 64, 0),
(68, 65, 1),
(68, 66, 1),
(69, 68, 0),
(71, 69, 1),
(69, 67, 0);

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` int(50) NOT NULL,
  `liker_id` int(50) NOT NULL,
  `post_id` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`id`, `liker_id`, `post_id`) VALUES
(82, 69, 98),
(91, 69, 73),
(110, 69, 101),
(124, 69, 111),
(125, 71, 121),
(127, 69, 132);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `text` text NOT NULL,
  `name` varchar(50) NOT NULL,
  `poster_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `text`, `name`, `poster_id`, `created_at`) VALUES
(69, 'heyy', 'heihei tiina', 68, '2020-11-09 06:49:04'),
(70, 'ayyyyyyyyyyyyyyyyyyyy', 'heihei tiina', 68, '2020-11-11 09:04:56'),
(71, '', 'heihei tiina', 68, '2020-11-11 14:39:09'),
(72, '', 'heihei tiina', 68, '2020-11-12 07:51:33'),
(73, '', 'heihei tiina', 68, '2020-11-12 07:53:23'),
(74, '', 'heihei tiina', 68, '2020-11-12 07:53:30'),
(75, '', 'heihei tiina', 68, '2020-11-12 07:53:33'),
(76, '', 'heihei tiina', 68, '2020-11-12 07:53:35'),
(77, '', 'heihei tiina', 68, '2020-11-12 07:57:02'),
(78, '', 'heihei tiina', 68, '2020-11-12 07:57:07'),
(79, '', 'heihei tiina', 68, '2020-11-12 07:57:11'),
(80, '', 'heihei tiina', 68, '2020-11-12 07:57:13'),
(81, '', 'heihei tiina', 68, '2020-11-12 08:01:35'),
(82, '', 'heihei tiina', 68, '2020-11-12 08:01:38'),
(83, '', 'heihei tiina', 68, '2020-11-12 08:01:40'),
(84, '', 'heihei tiina', 68, '2020-11-12 08:02:34'),
(85, '', 'heihei tiina', 68, '2020-11-12 08:02:36'),
(86, '', 'heihei tiina', 68, '2020-11-12 08:08:53'),
(87, '', 'heihei tiina', 68, '2020-11-12 08:08:59'),
(88, '', 'heihei tiina', 68, '2020-11-12 08:14:33'),
(89, '', 'heihei tiina', 68, '2020-11-12 08:25:31'),
(90, '', 'heihei tiina', 68, '2020-11-12 08:25:34'),
(91, 'tyhcdhgtdy', 'heihei tiina', 68, '2020-11-12 08:35:57'),
(92, 'ajhbdetych', 'heihei tiina', 68, '2020-11-12 08:36:05'),
(93, '', 'heihei tiina', 68, '2020-11-12 08:36:08'),
(94, '', 'heihei tiina', 68, '2020-11-12 08:40:14'),
(95, '', 'heihei tiina', 68, '2020-11-12 08:41:05'),
(96, '', 'heihei tiina', 68, '2020-11-12 08:41:06'),
(97, '', 'heihei tiina', 68, '2020-11-12 08:41:10'),
(98, '', 'heihei tiina', 68, '2020-11-12 08:42:08'),
(99, 'asdfghjkl;', 'heihei tiina', 68, '2020-11-12 08:42:14'),
(100, '', 'heihei tiina', 68, '2020-11-12 08:42:17'),
(101, 'asdfghjkl', 'heihei tiina', 68, '2020-11-12 09:24:07'),
(102, '', 'p k', 69, '2020-11-13 09:44:56'),
(103, '', 'p k', 69, '2020-11-13 09:45:11'),
(104, '', 'p k', 69, '2020-11-13 09:46:04'),
(105, '', 'p k', 69, '2020-11-13 09:48:19'),
(106, 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', 'p k', 69, '2020-11-14 16:25:45'),
(107, 'aaaaaaaaaaaaaaaaaaaaaa  aaaaaaaaaaaaa  aaaaaaa', 'p k', 69, '2020-11-14 16:26:07'),
(108, 'aaaaaaaaaaaaaaaaaaaaaa  aaaaaaaaaaaaa  aaaaaaa', 'p k', 69, '2020-11-14 16:26:37'),
(109, 'aaaaaaaaaaaaaaaaaaaaaa  aaaaaaaaaaaaa  aaaaaaa', 'p k', 69, '2020-11-14 16:27:12'),
(110, 'aaaaaaaaaaaaaaaaaaaaaa  aaaaaaaaaaaaa  aaaaaaa', 'p k', 69, '2020-11-14 16:35:11'),
(111, 'aaaaaaaaaaaaaaaaaaaaaa  aaaaaaaaaaaaa  aaaaaaa', 'p k', 69, '2020-11-14 16:37:47'),
(112, 'aaaaaaaaaaaaaaaaaaaaaa  aaaaaaaaaaaaa  aaaaaaa', 'k p', 71, '2020-11-14 16:38:50'),
(113, 'aaaaaaaaaaaaaaaaaaaaaa  aaaaaaaaaaaaa  aaaaaaa', 'k p', 71, '0000-00-00 00:00:00'),
(114, 'aaaaaaaaaaaaaaaaaaaaaa  aaaaaaaaaaaaa  aaaaaaa', 'k p', 71, '0000-00-00 00:00:00'),
(115, 'aaaaaaaaaaaaaaaaaaaaaa  aaaaaaaaaaaaa  aaaaaaa', 'k p', 71, '0000-00-00 00:00:00'),
(116, 'asdfghjkl;', 'p k', 69, '2020-11-16 08:05:43'),
(117, 'asdfghjkl;', 'p k', 69, '2020-11-16 08:08:54'),
(118, 'asdfghjkl;', 'p k', 69, '2020-11-16 08:09:27'),
(119, 'asdfghjkl;', 'p k', 69, '2020-11-16 08:09:31'),
(120, 'sdfghj', 'p k', 69, '2020-11-16 08:09:34'),
(121, 'sdfghj', 'p k', 69, '2020-11-16 08:09:38'),
(122, 'xcghj,', 'k p', 71, '2020-11-16 16:50:05'),
(123, 'xcghj,', 'k p', 71, '2020-11-16 16:50:25'),
(124, 'xcghj,', 'k p', 71, '2020-11-16 16:50:57'),
(125, 'xcghj,', 'k p', 71, '2020-11-16 16:51:54'),
(126, 'asdfghjklkjnbvcdxsertyhjmnbvfdrtyjmnbvcdertyhbvcdrtg', '', 0, '0000-00-00 00:00:00'),
(127, 'asdfghjkl', '', 0, '2020-11-16 16:55:09'),
(128, 'xcvbn', 'k p', 71, '2020-11-16 16:57:31'),
(129, 'a', 'k p', 71, '2020-11-16 16:57:35'),
(130, 'asdfghjkl', 'k p', 71, '2020-11-16 16:57:45'),
(131, 'asdfghjkl', 'k p', 71, '2020-11-16 16:58:33'),
(132, 'asdfghj', 'k p', 71, '2020-11-16 16:58:36'),
(133, 'hahahahha', 'p k', 69, '2020-11-17 15:42:47'),
(134, 'hahahahha', 'p k', 69, '2020-11-17 15:42:53'),
(135, 'hahahahha', 'p k', 69, '2020-11-17 15:49:26');

-- --------------------------------------------------------

--
-- Table structure for table `reposts`
--

CREATE TABLE `reposts` (
  `id` int(50) NOT NULL,
  `post_id` int(50) NOT NULL,
  `poster_id` int(50) NOT NULL,
  `reposter_id` int(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `text` varchar(250) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reposts`
--

INSERT INTO `reposts` (`id`, `post_id`, `poster_id`, `reposter_id`, `name`, `text`, `created_at`) VALUES
(1, 111, 69, 71, 'p k', 'aaaaaaaaaaaaaaaaaaaaaa  aaaaaaaaaaaaa  aaaaaaa', '2020-11-14 16:37:47'),
(2, 111, 69, 71, 'p k', 'aaaaaaaaaaaaaaaaaaaaaa  aaaaaaaaaaaaa  aaaaaaa', '2020-11-14 16:37:47'),
(3, 106, 69, 71, 'p k', 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', '2020-11-14 16:25:45'),
(4, 132, 71, 69, 'k p', 'asdfghj', '2020-11-16 16:58:36');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(25) NOT NULL,
  `lastname` varchar(25) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `location` varchar(50) NOT NULL,
  `created_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `username`, `email`, `password`, `description`, `location`, `created_at`) VALUES
(63, 'pilleriin', 'koiva', 'pilleriin.koiva', 'pill@gmail.com', '$2y$10$HBrrNpneyiFM/Sog2b5Gtu/l2q3kj7Sb5/tIF4YFGF8eYQkT.FON2', NULL, '', '2020-11-05'),
(64, 'pilleriin', 'koiva', 'pilleriin.koiva.1', 'pilleeeee@gmail.com', '$2y$10$/3D24Dmdv/hH/ZYpmkCtA.CHth6LlpazylrBQJBtiYbVdn7IUfkY6', NULL, '', '2020-11-05'),
(65, 'pilleriin', 'koiva', 'pilleriin.koiva.2', 'pilleeee@gmail.com', '$2y$10$csFhlHoLINqQbGW0BxGGXONY2dam1g6zKkmWR7dbc8F5WO.vE3qVy', NULL, '', '2020-11-05'),
(66, 'Heiko', 'Piirme', 'Heiko.Piirme', 'heiko@bitweb.ee', '$2y$10$Rt9SZ9fjxvgDt2wLU6URhO62bwxpxeyFkFQbppF506eoRUTOzvsfC', NULL, '', '2020-11-05'),
(67, 'liina', 'tiina', 'liina.tiina', 'pilwl@gmail.com', '$2y$10$.mTHUkpCNkNxX8YZqUeNBudpgTxoLXBOhwvXZIuuL18Gbgd1nW7HC', NULL, '', '2020-11-05'),
(68, 'heihei', 'tiina', 'heihei.tiina', 'pilwiil@gmail.com', '$2y$10$KqkDjPT.ZVTufYbaSjASheNNfHb6kzkDdi22lWoqNqYarl06VpHR.', NULL, '', '2020-11-05'),
(69, 'p', 'k', 'p.k', 'pk@gmail.com', '$2y$10$l0g7jm.47MGCa73bkFtkleq0DkKMlATafKZVaOsVXA7YxErz.ShfS', 'hihihihih', 'heheheh', '2020-11-13'),
(70, 'Heiko', 'Piirme', 'Heiko.Piirme.1', 'heiko@bitweeb.ee', '$2y$10$4/ULwmc7WfD2kKjaNGH7/OrCbksv2PMetJzkT86Q7WAIIcw6Le4cO', NULL, '', '2020-11-13'),
(71, 'k', 'p', 'k.p', 'kp@gmail.com', '$2y$10$8j8JKpf3uFOEJMdgQoncLukWvzVKH7trufkSpkKuWZLXFKkeMItcO', NULL, '', '2020-11-14'),
(72, 'pkp', 'kpk', 'pkp.kpk', 'pkp', '$2y$10$aDovmUXxM3cF28scV9ll7.3fnxtE3du.4rbRS21B.XLfLpLGqOlNq', NULL, '', '2020-11-15'),
(73, 'wd', 'trewsa', 'wd.trewsa', 'pilqwwl@gmail.com', '$2y$10$rB7l/RJAZ02wsTiWd86r0OrNFNd12MyP4SqzNDjCBZchrfHMJ1sey', NULL, '', '2020-11-16');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reposts`
--
ALTER TABLE `reposts`
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
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=128;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=136;

--
-- AUTO_INCREMENT for table `reposts`
--
ALTER TABLE `reposts`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
