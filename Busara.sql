-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 09, 2018 at 12:35 AM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 7.2.5

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
(145, 6, '3splx63nx8c01.png', '2018-07-08/be2cc4bc3690665239e6997f08e17d20.jpg', 'assets/uploads/2018-07-08/be2cc4bc3690665239e6997f08e17d20.jpg', 'http://[::1]/roba/assets/uploads/2018-07-08/be2cc4bc3690665239e6997f08e17d20.jpg', '2018-07-08 21:06:14', '0000-00-00 00:00:00', NULL),
(146, 6, '35129_computer_theres_no_place_like_127001.jpg', '2018-07-08/da50b6473be77fa66c745440c7de39d2.jpg', 'assets/uploads/2018-07-08/da50b6473be77fa66c745440c7de39d2.jpg', 'http://[::1]/roba/assets/uploads/2018-07-08/da50b6473be77fa66c745440c7de39d2.jpg', '2018-07-08 21:06:15', '0000-00-00 00:00:00', NULL),
(147, 6, '269734.jpg', '2018-07-08/38be2625887cc34f5d46b8786e8cd752.jpg', 'assets/uploads/2018-07-08/38be2625887cc34f5d46b8786e8cd752.jpg', 'http://[::1]/roba/assets/uploads/2018-07-08/38be2625887cc34f5d46b8786e8cd752.jpg', '2018-07-08 21:06:15', '0000-00-00 00:00:00', NULL),
(148, 6, 'maxresdefault.jpg', '2018-07-08/70d507d1283d32702b747d4b5215e09f.jpg', 'assets/uploads/2018-07-08/70d507d1283d32702b747d4b5215e09f.jpg', 'http://[::1]/roba/assets/uploads/2018-07-08/70d507d1283d32702b747d4b5215e09f.jpg', '2018-07-08 21:06:15', '0000-00-00 00:00:00', NULL),
(149, 6, 'React-Native-Titre.png', '2018-07-08/1bee3fd7231a56c2ebcc9cd24f922033.jpg', 'assets/uploads/2018-07-08/1bee3fd7231a56c2ebcc9cd24f922033.jpg', 'http://[::1]/roba/assets/uploads/2018-07-08/1bee3fd7231a56c2ebcc9cd24f922033.jpg', '2018-07-08 21:06:16', '0000-00-00 00:00:00', NULL),
(150, 6, 'Screenshot (1).png', '2018-07-08/8e04ff2175fe6a223318c18de8ec07bf.jpg', 'assets/uploads/2018-07-08/8e04ff2175fe6a223318c18de8ec07bf.jpg', 'http://[::1]/roba/assets/uploads/2018-07-08/8e04ff2175fe6a223318c18de8ec07bf.jpg', '2018-07-08 21:06:16', '0000-00-00 00:00:00', NULL);

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
(8, 6, '+254714891869', 'Mensa-fied best friends and roommates Leonard and Sheldon, physicists who work at the California Institute of Technology, may be able to tell everybody more than they want to know ', 'sent', '2018-07-07 06:33:43', '0000-00-00 00:00:00'),
(17, 11, '+254714891869', 'If one server broken, don\'t worry, it will automatic switch to next server. \r\n', 'pending', '2018-07-07 09:05:14', '0000-00-00 00:00:00'),
(18, 11, '+254714891869', 'Don\'t worry, it will automatic switch to next server. \r\n', 'pending', '2018-07-07 09:05:30', '0000-00-00 00:00:00'),
(19, 11, '0737435718', 'If one server broken, don\'t worry, it will automatic switch to next server. \r\n', 'pending', '2018-07-07 09:05:46', '0000-00-00 00:00:00'),
(20, 6, '+254714891869', 'Welcome to Clickatell and thanks for registering an account with us. \r\n', 'pending', '2018-07-07 17:56:31', '0000-00-00 00:00:00'),
(21, 12, '+254714891869', 'qwertyui', 'sent', '2018-07-07 23:29:50', '0000-00-00 00:00:00');

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
  `profile_pic` int(11) NOT NULL DEFAULT '0',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `names`, `phone`, `profile_pic`, `created`, `modified`) VALUES
(6, 'fcs.grc.contract@gmail.com', '48e315a84799bd3da423419255568349', 'Kelvin Kinja', '+254714891869', 150, '2018-07-06 20:44:50', '2018-07-08 21:08:42'),
(7, 'robert@gmail.com', '8341b392fc5d89617dca052f90c60965', NULL, NULL, 0, '2018-07-06 20:56:20', '2018-07-08 07:05:42'),
(8, 'fcs.grc.contract@gmail.com', '48e315a84799bd3da423419255568349', NULL, NULL, 0, '2018-07-07 08:00:09', '0000-00-00 00:00:00'),
(9, 'paul@gmail.com', 'a82cdedfa2f4bf2d6fc385c325b35852', NULL, NULL, 0, '2018-07-07 08:00:55', '2018-07-08 07:05:42'),
(10, 'fcs.grc.contract@gmail.com', '48e315a84799bd3da423419255568349', NULL, NULL, 0, '2018-07-07 08:30:56', '0000-00-00 00:00:00'),
(11, 'harriotharry@gmail.com', '8341b392fc5d89617dca052f90c60965', 'Harrison Mule', '+254737435718', 0, '2018-07-07 08:46:58', '2018-07-08 07:05:42'),
(12, 'admin@emomentum-interactive.com', '8341b392fc5d89617dca052f90c60965', 'Full Names', '254681264548645', 0, '2018-07-07 23:29:20', '2018-07-08 07:05:42');

--
-- Indexes for dumped tables
--

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pictures`
--
ALTER TABLE `pictures`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=151;

--
-- AUTO_INCREMENT for table `smss`
--
ALTER TABLE `smss`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
