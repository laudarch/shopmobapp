-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 11, 2020 at 06:08 PM
-- Server version: 10.3.23-MariaDB-cll-lve
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shopmoba_tvnotes`
--

-- --------------------------------------------------------

--
-- Table structure for table `blobs`
--

CREATE TABLE `blobs` (
  `id` int(11) NOT NULL,
  `blob_path` varchar(200) NOT NULL,
  `status` varchar(2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blobs`
--

INSERT INTO `blobs` (`id`, `blob_path`, `status`) VALUES
(1, 'images/509ceb60103a04.41779048tv3.jpg', 'A'),
(2, 'images/509cebf2027960.04582428508950f51c3108.64988478GTV_logo.png', 'A'),
(4, 'images/509cedcac43516.57539081metrotv.png', 'A'),
(5, 'images/509cee091b5917.563940065089789c9bd425.92499397NET2_logo.png', 'A'),
(6, 'images/509cee8206c9a0.63257019508978028f6975.72318493Viasat1_logo.png', 'A'),
(7, 'images/509ceee0326189.1013362450894b4d2d2b96.11563777bussines_icon.png', 'A'),
(8, 'images/509cef13453475.6588881350894ce3d16cf3.10210357entertainment_icon.png', 'A'),
(9, 'images/509cef33a87394.4696130850894d5f26bc32.65321858sports_icon.png', 'A'),
(10, 'images/509cef5b7a42e5.2573552250894d9caaf348.18638409fashion_icon.png', 'A'),
(11, 'images/509cef95001a83.1811273850894e82ddb7a2.66442485technology_icon.png', 'A'),
(12, 'images/509cf27907da59.52452820tv3.png', 'A'),
(13, 'images/50ae07e4943008.81407322theOneShow.jpg', 'A'),
(14, 'images/50ae0db680e9d4.78191214nigerian_idol.jpg', 'A'),
(15, 'images/50ae4c4458f8b3.04920205joselyn.jpg', 'A'),
(16, 'images/50ae5193658876.00164310py.jpg', 'A'),
(17, 'images/50ae6582186965.12084420goodevening.jpg', 'A'),
(18, 'images/50ae6698a77298.64021189paul.jpg', 'A'),
(19, 'images/50ae68ce95a0c5.71138240musicmusic.jpg', 'A'),
(20, 'images/50ae693fbfab32.79049912mentor_tv3.jpg', 'A'),
(21, 'images/50ae6a8d1809c1.39504095jaminspot.jpg', 'A'),
(22, 'images/50ae6aa2c76f90.78489399benny.jpg', 'A'),
(23, 'images/50ae6acd3aa664.02329307boysboys.jpg', 'A'),
(24, 'images/50ae6cdba5d025.78236782standpoint.jpg', 'A'),
(25, 'images/50ae6cf7d78109.57145634gifty.jpg', 'A'),
(26, 'images/50ae6f61d098d9.83833737sports_highlight.jpg', 'A'),
(27, 'images/50ae6f85bab845.68194645kwabena.jpg', 'A'),
(28, 'images/50ae7099c06d04.36545225talking.jpg', 'A'),
(29, 'images/50ae719760d606.86815779allo.jpg', 'A'),
(30, 'images/50ae71d8185217.88645525jongermain.jpg', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `content` int(11) NOT NULL,
  `episode_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE `country` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `code` varchar(5) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `episodes`
--

CREATE TABLE `episodes` (
  `id` int(11) NOT NULL,
  `program_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `code` varchar(20) NOT NULL,
  `description` varchar(400) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `episodes`
--

INSERT INTO `episodes` (`id`, `program_id`, `title`, `code`, `description`, `timestamp`) VALUES
(2, 1, 'Season 2 ep1', '', '', '2012-11-22 16:37:04');

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `id` int(11) NOT NULL,
  `episode_id` int(11) NOT NULL,
  `photo` blob NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `podcast`
--

CREATE TABLE `podcast` (
  `id` int(11) NOT NULL,
  `episode_id` int(11) NOT NULL,
  `podcast_path` varchar(400) NOT NULL,
  `description` varchar(400) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `podcast`
--

INSERT INTO `podcast` (`id`, `episode_id`, `podcast_path`, `description`) VALUES
(1, 2, 'videos/50ae54b0f3eb60.72320897yahoo.mp4', '');

-- --------------------------------------------------------

--
-- Table structure for table `prefferred_programs`
--

CREATE TABLE `prefferred_programs` (
  `user_id` int(11) NOT NULL,
  `program_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `prefferred_programs`
--

INSERT INTO `prefferred_programs` (`user_id`, `program_id`) VALUES
(1, 1),
(2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `presenters`
--

CREATE TABLE `presenters` (
  `id` int(11) NOT NULL,
  `program_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(400) NOT NULL,
  `blob_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `presenters`
--

INSERT INTO `presenters` (`id`, `program_id`, `name`, `description`, `blob_id`) VALUES
(1, 1, 'Joycelyn Dumas', '', 15),
(2, 1, 'PY', '', 16),
(3, 3, 'Paul Adom Otchere', '', 18),
(4, 6, 'Benny Blanko', '', 22),
(5, 8, 'Gifty Anti', '', 25),
(6, 9, 'Kwabena Yeboah', '', 27),
(7, 11, 'Jon Germain', '', 30);

-- --------------------------------------------------------

--
-- Table structure for table `programs`
--

CREATE TABLE `programs` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `tv_station_id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `description` varchar(400) NOT NULL,
  `blob_id` int(11) DEFAULT NULL,
  `showtime` varchar(50) NOT NULL,
  `showday` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `programs`
--

INSERT INTO `programs` (`id`, `category_id`, `tv_station_id`, `name`, `description`, `blob_id`, `showtime`, `showday`) VALUES
(1, 2, 5, 'The One Show', 'A contemporary talk show', 13, '6:00pm - 7:00pm', 'Monday, Wednesday'),
(2, 2, 5, 'Nigerian Idol', 'A nigerian version of the American Idol show', 14, '4:30pm - 5:30pm', 'Saturday'),
(3, 1, 3, 'Good Evening Ghana', '', 17, '9:00pm - 10:00pm', 'Monday, Wednesday, Friday'),
(4, 2, 1, 'Music Music', '', 19, '7:00pm - 8:30pm', 'Saturday'),
(5, 2, 1, 'Mentor', 'A musical talent hunt show', 20, '7:00pm - 8:30pm', 'Sunday'),
(6, 2, 5, 'Jammin Spot', '', 21, '4:30pm - 5:30pm', 'Monday, Wednesday, Friday'),
(7, 2, 5, 'Boys Boys', '', 23, '4:30pm - 5:30pm', 'Saturday'),
(8, 1, 2, 'Stand Point', '', 24, '4:30pm - 5:30pm', 'Saturday'),
(9, 3, 2, 'Sports Highlight', 'Sports show', 26, '8:00pm - 9:00pm', 'Monday'),
(10, 1, 2, 'Talking Point', '', 28, '8:00pm - 9:00pm', 'Sunday'),
(11, 2, 3, 'Allo Tigo', '', 29, '7:00pm - 8:30pm', 'Saturday');

-- --------------------------------------------------------

--
-- Table structure for table `programs_category`
--

CREATE TABLE `programs_category` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(400) NOT NULL,
  `blob_id` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `programs_category`
--

INSERT INTO `programs_category` (`id`, `name`, `description`, `blob_id`) VALUES
(1, 'Business', 'All tv programs that discuss organisation management trends.', 7),
(2, 'Entertainment', 'All tv programs that discuss the lastest trends in clothes, music, social event ...', 8),
(3, 'Sports', 'All sporting activities', 9),
(4, 'Fashion', 'Everything and anything fashion', 10),
(5, 'Technology', 'All technological issues', 11);

-- --------------------------------------------------------

--
-- Table structure for table `tv_stations`
--

CREATE TABLE `tv_stations` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(400) DEFAULT NULL,
  `motto` varchar(100) DEFAULT NULL,
  `blob_id` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tv_stations`
--

INSERT INTO `tv_stations` (`id`, `name`, `description`, `motto`, `blob_id`) VALUES
(1, 'TV3', NULL, NULL, 1),
(2, 'GTV', NULL, NULL, 2),
(3, 'Metro TV', NULL, NULL, 4),
(4, 'Net 2 ', NULL, NULL, 5),
(5, 'Viasat 1', NULL, NULL, 6);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(15) NOT NULL,
  `msisdn` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `blob_id` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `msisdn`, `email`, `blob_id`) VALUES
(1, 'bernard Adjei Oppong', 'bernard', '123456', '233244740439', 'bennyadjei@yahoo.com', 1),
(2, 'Mabel Banning', 'mabel', '123456', '', 'mabel@live.com', 2),
(3, 'Samuel Quaye', 'samuel', '123456', '', 'samuel@yahoo.com', 4),
(4, 'Mercy Idol', 'idol', '123456', '', 'idol@gmail.com', 0),
(5, 'zenock', 'zenks', 'amponsah', '+233206776542', 'gzenock@yahoo.com', 0),
(6, 'zenock', 'zenks', 'amponsah', '+233206776542', 'gzenock@yahoo.com', 0),
(7, 'zenock', 'zenks', 'amponsah', '+233206776542', 'gzenock@yahoo.com', 0),
(8, 'zenock', 'zenks', 'amponsah', '+233206776542', 'gzenock@yahoo.com', 0),
(9, 'origgin world', 'origgin1', 'origgin1', '233244728641', 'kofi@origginworld.com', 0),
(10, 'Kane Mani', 'KaneMani1', 'qwerty', '00233244549366', 'kane@origginworld.com', 0),
(11, 'Esi Fatu', 'Esi_Fatu', '123456', '', 'esi@fatu.com', 0),
(12, 'Jason Nkrumah', '', '123456', '233244748438', 'jason@live.com', 0),
(13, 'Mary Ghansah', '', '123456', '233244740438', '', 0),
(14, 'KaneMani', '', 'qwerty', '233244549366', 'kane@origginworld.coml', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blobs`
--
ALTER TABLE `blobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`,`user_id`,`timestamp`,`content`,`episode_id`);

--
-- Indexes for table `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `episodes`
--
ALTER TABLE `episodes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `podcast`
--
ALTER TABLE `podcast`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `presenters`
--
ALTER TABLE `presenters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `programs`
--
ALTER TABLE `programs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `programs_category`
--
ALTER TABLE `programs_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tv_stations`
--
ALTER TABLE `tv_stations`
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
-- AUTO_INCREMENT for table `blobs`
--
ALTER TABLE `blobs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `country`
--
ALTER TABLE `country`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `episodes`
--
ALTER TABLE `episodes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `podcast`
--
ALTER TABLE `podcast`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `presenters`
--
ALTER TABLE `presenters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `programs`
--
ALTER TABLE `programs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `programs_category`
--
ALTER TABLE `programs_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tv_stations`
--
ALTER TABLE `tv_stations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
