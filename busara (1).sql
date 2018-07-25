-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 25, 2018 at 07:06 AM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `busara`
--

-- --------------------------------------------------------

--
-- Table structure for table `keys`
--

CREATE TABLE `keys` (
  `id` int(11) NOT NULL,
  `key` varchar(40) NOT NULL,
  `level` int(2) NOT NULL,
  `ignore_limits` tinyint(1) NOT NULL DEFAULT '0',
  `is_private_key` tinyint(1) NOT NULL DEFAULT '0',
  `ip_addresses` text,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `id` int(11) NOT NULL,
  `uri` varchar(255) NOT NULL,
  `method` varchar(6) NOT NULL,
  `params` text,
  `api_key` varchar(40) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `time` int(11) NOT NULL,
  `rtime` float DEFAULT NULL,
  `authorized` varchar(1) NOT NULL,
  `response_code` smallint(3) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `pictures`
--

CREATE TABLE `pictures` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL DEFAULT '0',
  `title` varchar(255) DEFAULT NULL,
  `filename` varchar(255) DEFAULT NULL,
  `file_path` varchar(255) DEFAULT NULL,
  `file_link` varchar(255) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `album` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pictures`
--

INSERT INTO `pictures` (`id`, `user`, `title`, `filename`, `file_path`, `file_link`, `created`, `modified`, `album`) VALUES
(1, 13, 'glasses_splashes_backgrounds_white_blue_green_76126_1920x1080.jpg', '2018-07-08/857a7c92756684f29f286a8462f9ad00.jpg', 'assets/uploads/2018-07-08/857a7c92756684f29f286a8462f9ad00.jpg', 'http://[::1]/busara/assets/uploads/2018-07-08/857a7c92756684f29f286a8462f9ad00.jpg', '2018-07-08 19:57:24', '0000-00-00 00:00:00', NULL),
(3, 13, 'landy.jpg', '2018-07-08/cd74ebfe5379e503f8cf9ea578329a9c.jpg', 'assets/uploads/2018-07-08/cd74ebfe5379e503f8cf9ea578329a9c.jpg', 'http://[::1]/busara/assets/uploads/2018-07-08/cd74ebfe5379e503f8cf9ea578329a9c.jpg', '2018-07-08 19:57:26', '0000-00-00 00:00:00', NULL),
(4, 13, 'landy2.jpg', '2018-07-08/c13fec49fcaa117f394030d57c1850b8.jpg', 'assets/uploads/2018-07-08/c13fec49fcaa117f394030d57c1850b8.jpg', 'http://[::1]/busara/assets/uploads/2018-07-08/c13fec49fcaa117f394030d57c1850b8.jpg', '2018-07-08 19:57:26', '0000-00-00 00:00:00', NULL),
(5, 13, 'man_freedom_art_sun_birds_118262_1920x1080.jpg', '2018-07-08/bf41f1a2ffdcc28b7c1b8791a7b77724.jpg', 'assets/uploads/2018-07-08/bf41f1a2ffdcc28b7c1b8791a7b77724.jpg', 'http://[::1]/busara/assets/uploads/2018-07-08/bf41f1a2ffdcc28b7c1b8791a7b77724.jpg', '2018-07-08 19:57:27', '0000-00-00 00:00:00', NULL),
(6, 13, 'nike_traffic_sports_style_66144_1920x1080.jpg', '2018-07-08/25ea8a66c7e77a850a1d23a60f3d6aa3.jpg', 'assets/uploads/2018-07-08/25ea8a66c7e77a850a1d23a60f3d6aa3.jpg', 'http://[::1]/busara/assets/uploads/2018-07-08/25ea8a66c7e77a850a1d23a60f3d6aa3.jpg', '2018-07-08 19:57:28', '0000-00-00 00:00:00', NULL),
(7, 13, 'razer_logo_text_4699_1920x1080.jpg', '2018-07-08/c968de8d42e94aea72044d64a2da7fe8.jpg', 'assets/uploads/2018-07-08/c968de8d42e94aea72044d64a2da7fe8.jpg', 'http://[::1]/busara/assets/uploads/2018-07-08/c968de8d42e94aea72044d64a2da7fe8.jpg', '2018-07-08 19:57:28', '0000-00-00 00:00:00', NULL),
(8, 7, 'wallhaven-47313.jpg', '2018-07-09/c690f584829e8baf1c03d1dbed2c984e.jpg', 'assets/uploads/2018-07-09/c690f584829e8baf1c03d1dbed2c984e.jpg', 'http://[::1]/busara/assets/uploads/2018-07-09/c690f584829e8baf1c03d1dbed2c984e.jpg', '2018-07-09 08:22:50', '0000-00-00 00:00:00', NULL),
(9, 7, 'wallhaven-259047.jpg', '2018-07-09/fa1c769b2e4a138f08fa3f66d6c302ba.jpg', 'assets/uploads/2018-07-09/fa1c769b2e4a138f08fa3f66d6c302ba.jpg', 'http://[::1]/busara/assets/uploads/2018-07-09/fa1c769b2e4a138f08fa3f66d6c302ba.jpg', '2018-07-09 08:22:50', '0000-00-00 00:00:00', NULL),
(10, 7, 'wallhaven-294145.jpg', '2018-07-09/1fc30c2e74382fbe04aabbd78e36b616.jpg', 'assets/uploads/2018-07-09/1fc30c2e74382fbe04aabbd78e36b616.jpg', 'http://[::1]/busara/assets/uploads/2018-07-09/1fc30c2e74382fbe04aabbd78e36b616.jpg', '2018-07-09 08:22:50', '0000-00-00 00:00:00', NULL),
(11, 7, 'wallhaven-303951.jpg', '2018-07-09/38d98bee2c9d7477cb40d33fa08d874f.jpg', 'assets/uploads/2018-07-09/38d98bee2c9d7477cb40d33fa08d874f.jpg', 'http://[::1]/busara/assets/uploads/2018-07-09/38d98bee2c9d7477cb40d33fa08d874f.jpg', '2018-07-09 08:22:51', '0000-00-00 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `smss`
--

CREATE TABLE `smss` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `message` varchar(255) NOT NULL,
  `status` enum('sent','pending','cancelled') NOT NULL DEFAULT 'pending',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `smss`
--

INSERT INTO `smss` (`id`, `user`, `phone`, `message`, `status`, `created`, `modified`) VALUES
(4, 13, '+254721435718', 'test', 'sent', '2018-07-09 08:00:01', '0000-00-00 00:00:00'),
(5, 7, '0721435718', 'Good to see this working', 'sent', '2018-07-09 14:41:18', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `names` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `age` int(11) NOT NULL DEFAULT '0',
  `profile_pic` int(11) NOT NULL DEFAULT '0',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `last_login` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `names`, `phone`, `age`, `profile_pic`, `created`, `modified`, `last_login`) VALUES
(7, 'harry@gmail.com', '8341b392fc5d89617dca052f90c60965', 'Harrison Musembi', '254713123456', 20, 11, '2018-07-06 20:56:20', '2018-07-24 17:38:13', '2018-07-24 16:38:13'),
(9, 'paul@gmail.com', '8341b392fc5d89617dca052f90c60965', NULL, '254712345678', 33, 0, '2018-07-07 08:00:55', '2018-07-09 08:08:30', '2018-07-24 17:27:57'),
(11, 'harrisonmule@gmail.com', '8341b392fc5d89617dca052f90c60965', 'Harrison Mule', '254737435718', 25, 0, '2018-07-07 08:46:58', '2018-07-09 08:08:36', '2018-07-24 17:27:57'),
(12, 'admin@busara.com', '63095273d989daf1a7032d90b34cd8ce', 'admin', '254721435718', 28, 0, '2018-07-07 23:29:20', '2018-07-09 08:08:48', '2018-07-24 17:27:57'),
(13, 'fiona@gmail.com', '63095273d989daf1a7032d90b34cd8ce', 'Fiona Mule', '0717223558', 22, 1, '2018-07-08 19:41:08', '2018-07-09 08:12:00', '2018-07-24 17:27:57'),
(14, 'simon@gmail.com', '8341b392fc5d89617dca052f90c60965', NULL, NULL, 0, 0, '2018-07-12 01:47:47', '0000-00-00 00:00:00', '2018-07-24 17:27:57'),
(15, 'brian elwel@gmail.com', '5d756741c908ca3c07d10ca57a2f2790', 'brayo elwel', '0722444555', 0, 0, '2018-07-24 17:45:54', '2018-07-24 17:51:10', '2018-07-24 17:45:54');

-- --------------------------------------------------------

--
-- Table structure for table `users_authentication`
--

CREATE TABLE `users_authentication` (
  `id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `token` varchar(255) NOT NULL,
  `expired_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_authentication`
--

INSERT INTO `users_authentication` (`id`, `users_id`, `token`, `expired_at`, `created_at`, `updated_at`) VALUES
(1, 7, 'JZaEe1pmGwylFRYmEmeBVQPZT0x9EUcj7Iny', '2018-07-25 07:51:26', '2018-07-24 20:38:13', '2018-07-24 19:51:26');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `keys`
--
ALTER TABLE `keys`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pictures`
--
ALTER TABLE `pictures`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `smss`
--
ALTER TABLE `smss`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_authentication`
--
ALTER TABLE `users_authentication`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `keys`
--
ALTER TABLE `keys`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pictures`
--
ALTER TABLE `pictures`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `smss`
--
ALTER TABLE `smss`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `users_authentication`
--
ALTER TABLE `users_authentication`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
