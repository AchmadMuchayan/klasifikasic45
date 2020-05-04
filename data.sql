-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: 04 Mei 2020 pada 15.00
-- Versi Server: 5.7.15-log
-- PHP Version: 5.6.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `p_c45`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `data`
--

CREATE TABLE `data` (
  `no` int(11) NOT NULL,
  `outlook` varchar(6) NOT NULL,
  `temperature` varchar(6) NOT NULL,
  `humidity` varchar(6) NOT NULL,
  `windy` tinyint(1) NOT NULL,
  `play` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `data`
--

INSERT INTO `data` (`no`, `outlook`, `temperature`, `humidity`, `windy`, `play`) VALUES
(1, 'sunny', 'hot', 'high', 0, 0),
(2, 'sunny', 'hot', 'high', 1, 0),
(3, 'cloudy', 'hot', 'high', 0, 1),
(4, 'rainy', 'mild', 'high', 0, 1),
(5, 'rainy', 'cool', 'normal', 0, 1),
(6, 'rainy', 'cool', 'normal', 1, 1),
(7, 'cloudy', 'cool', 'normal', 1, 1),
(8, 'sunny', 'mild', 'high', 0, 0),
(9, 'sunny', 'cool', 'normal', 0, 1),
(10, 'rainy', 'mild', 'normal', 0, 1),
(11, 'sunny', 'mild', 'normal', 1, 1),
(12, 'cloudy', 'mild', 'high', 1, 1),
(13, 'cloudy', 'hot', 'normal', 0, 1),
(14, 'rainy', 'mild', 'high', 1, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `data`
--
ALTER TABLE `data`
  ADD PRIMARY KEY (`no`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `data`
--
ALTER TABLE `data`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
