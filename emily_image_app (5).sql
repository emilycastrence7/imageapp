-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 26, 2018 at 08:44 PM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `emily_image_app`
--
CREATE DATABASE IF NOT EXISTS `emily_image_app` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `emily_image_app`;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `category_id` smallint(6) NOT NULL,
  `name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `name`) VALUES
(1, 'Black and White'),
(2, 'HD'),
(3, 'Portraits'),
(4, 'Portraits');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE `comments` (
  `comment_id` smallint(6) NOT NULL,
  `user_id` smallint(6) NOT NULL,
  `body` varchar(500) NOT NULL,
  `date` datetime NOT NULL,
  `post_id` smallint(6) NOT NULL,
  `is_approved` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `user_id`, `body`, `date`, `post_id`, `is_approved`) VALUES
(1, 1, 'Look at that little man trying his best.', '2018-01-18 09:36:37', 1, 1),
(2, 2, 'Woweeowwowow', '2018-01-18 09:36:37', 1, 1),
(3, 1, 'wrewrwerwerwerewr', '2018-01-23 09:21:18', 4, 1),
(4, 1, 'boopbeeppoop', '2018-01-23 09:21:40', 2, 1),
(5, 1, '8========D', '2018-01-23 09:21:55', 2, 1),
(6, 1, 'wrwerwerwe', '2018-01-23 10:05:10', 1, 1),
(7, 1, '23rr423242', '2018-01-23 10:10:14', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
CREATE TABLE `posts` (
  `post_id` smallint(6) NOT NULL,
  `image` varchar(40) NOT NULL,
  `title` varchar(75) NOT NULL,
  `user_id` smallint(6) NOT NULL,
  `body` varchar(600) NOT NULL,
  `date` datetime NOT NULL,
  `category_id` smallint(6) NOT NULL,
  `is_published` tinyint(1) NOT NULL,
  `allow_comments` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `image`, `title`, `user_id`, `body`, `date`, `category_id`, `is_published`, `allow_comments`) VALUES
(1, 'picsum.photos/300/300?image=1062', 'Puggo in a blanketo', 1, 'Look at this flat faced friend being a flat faced friend', '2018-01-18 09:35:49', 2, 1, 1),
(2, 'picsum.photos/458/354?image=1044', 'Dude in Nature', 1, 'He is probably peeing in nature.', '2018-01-18 09:35:49', 1, 1, 0),
(4, 'picsum.photos/400/300?image=1025', 'Puggo Trying his Best', 2, 'Look at this little national geographic man', '2018-01-19 09:35:09', 2, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

DROP TABLE IF EXISTS `tags`;
CREATE TABLE `tags` (
  `tag_id` smallint(6) NOT NULL,
  `name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`tag_id`, `name`) VALUES
(1, 'cool'),
(2, 'nature');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `user_id` smallint(6) NOT NULL,
  `username` varchar(30) NOT NULL,
  `bio` varchar(500) NOT NULL,
  `avatar` varchar(40) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(40) NOT NULL,
  `join_date` datetime NOT NULL,
  `is_admin` tinyint(1) NOT NULL,
  `secret_key` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `bio`, `avatar`, `email`, `password`, `join_date`, `is_admin`, `secret_key`) VALUES
(1, 'Emily', 'I am a person. ', 'https://tinyurl.com/ybgjqqlw', 'emily.castrence@gmail.com', 'c9dca2768c1b0372d989c6f267a476c0e0be72c1', '2018-01-18 09:26:18', 1, ''),
(2, 'randouser', 'I am a fake basic bitch user', 'https://tinyurl.com/ybtonwt3', 'newemail@mail.com', 'ab87d24bdc7452e55738deb5f868e1f16dea5ace', '2018-01-18 09:28:06', 0, ''),
(3, 'poopiebutts', '', '', 'poopiebutts@email.com', '79fbc1e56b538b0ac058616070bfa7ddb8a7d8db', '2018-01-26 09:22:40', 0, ''),
(4, 'TacoBell', '', '', 'tacobell@email.com', '43a2668340e2717077aab4704dbdf588060df886', '2018-01-26 09:32:18', 0, ''),
(5, 'Judytran', '', '', 'judytran@email.com', '0605a160905da401b42c8a60d7dd22d2bc1bafc7', '2018-01-26 09:56:27', 0, ''),
(6, 'PenelopeLove', '', '', 'penelope@gmail.com', 'a7ebd6514d3fffdda8c04cfaf198cec2744ff740', '2018-01-26 09:58:03', 0, ''),
(7, 'cutiepie', '', '', 'cutiepie@mail.com', '3bcefb7c8b92fbd784ece9a3bc59e064eb5b1fdc', '2018-01-26 10:39:11', 0, ''),
(8, 'alejandra', '', '', 'email@email.com', 'ef5ffc5d5b6e7981abb3c84553dcd82004236ed4', '2018-01-26 10:50:50', 0, 'b08e60ac663911d9fb3179a2eb0e04911aa2ffe4');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`tag_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `tag_id` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
