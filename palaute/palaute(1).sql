-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 03.11.2021 klo 12:08
-- Palvelimen versio: 5.7.11
-- PHP Version: 5.6.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `palaute`
--

-- --------------------------------------------------------

--
-- Rakenne taululle `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Vedos taulusta `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Rakenne taululle `tickets`
--

CREATE TABLE `tickets` (
  `id` int(11) NOT NULL,
  `message` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `date` date NOT NULL,
  `user` varchar(255) NOT NULL,
  `response` varchar(255) DEFAULT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Vedos taulusta `tickets`
--

INSERT INTO `tickets` (`id`, `message`, `status`, `date`, `user`, `response`, `image`) VALUES
(6, 'test', 0, '2021-10-04', 'testi@gmail.com', 'testivastaus', ''),
(8, 'test', 0, '2021-10-04', 'testi@gmail.com', 'ok', ''),
(9, 'test2', 0, '2021-10-04', 'testi@gmail.com', NULL, ''),
(10, 'fffffff', 0, '2021-11-03', 'testi@gmail.com', NULL, '2014_06_29_065_pieni.jpg'),
(11, 'test', 0, '2021-11-03', 'atesti@gmail.com', NULL, ''),
(12, 'dddddddddd', 0, '2021-11-03', 'btesti@gmail.com', NULL, ''),
(13, 'ggg', 0, '2021-11-03', 'atesti@gmail.com', NULL, ''),
(14, 'gggg', 0, '2021-11-03', 'atesti@gmail.com', NULL, ''),
(15, 'ggggg', 0, '2021-11-03', 'atesti@gmail.com', NULL, ''),
(16, 'fffff', 0, '2021-11-03', 'btesti@gmail.com', NULL, ''),
(17, 'fffff', 0, '2021-11-03', 'btesti@gmail.com', NULL, ''),
(18, 'fffff', 0, '2021-11-03', 'btesti@gmail.com', NULL, '');

-- --------------------------------------------------------

--
-- Rakenne taululle `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Vedos taulusta `user`
--

INSERT INTO `user` (`id`, `email`, `password`) VALUES
(1, 'testi@gmail.com', '$2y$10$4Be8HgiAI6FNBzhxUId0Q.5Y.vlraXJ6SfSZppwREesldAlGPAn7u'),
(2, 'atesti@gmail.com', '$2y$10$RWTOEvpOEocwEF6xOd36bO2m82r2/ostQP3drUHPaOnRuSWsLDLaO'),
(3, 'btesti@gmail.com', '$2y$10$EZ90PZyYRngC3g9eVkBjoOba2eXZ0mAS5KldZ56kkAzPZawHfTBnG');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
