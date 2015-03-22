-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 22, 2015 at 12:12 PM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `currency_fair`
--
CREATE DATABASE IF NOT EXISTS `currency_fair` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `currency_fair`;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`) VALUES
(0),
(111111),
(444444),
(555555),
(666666),
(777777),
(888888);

-- --------------------------------------------------------

--
-- Table structure for table `user_summary`
--

DROP TABLE IF EXISTS `user_summary`;
CREATE TABLE IF NOT EXISTS `user_summary` (
`id` int(11) unsigned NOT NULL,
  `date` datetime DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `total` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_summary`
--

INSERT INTO `user_summary` (`id`, `date`, `user_id`, `total`) VALUES
(1, '2015-03-22 00:00:00', 666666, 1),
(2, '2015-03-22 00:00:00', 111111, 1),
(3, '2015-03-22 00:00:00', 888888, 2),
(4, '2015-03-22 00:00:00', 777777, 1),
(5, '2015-03-22 00:00:00', 555555, 3),
(6, '2015-03-22 00:00:00', 444444, 1),
(7, '2015-03-22 00:00:00', 0, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `user_summary`
--
ALTER TABLE `user_summary`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user_summary`
--
ALTER TABLE `user_summary`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
