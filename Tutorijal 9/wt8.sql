-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 17, 2015 at 12:00 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `wt8`
--

-- --------------------------------------------------------

--
-- Table structure for table `komentar`
--

CREATE TABLE IF NOT EXISTS `komentar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vijest` int(11) NOT NULL,
  `tekst` text COLLATE utf8_slovenian_ci NOT NULL,
  `autor` varchar(20) COLLATE utf8_slovenian_ci NOT NULL,
  `vrijeme` timestamp NOT NULL,
  PRIMARY KEY (`id`),
  KEY `vijest` (`vijest`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci AUTO_INCREMENT=14 ;

--
-- Dumping data for table `komentar`
--

INSERT INTO `komentar` (`id`, `vijest`, `tekst`, `autor`, `vrijeme`) VALUES
(1, 2, 'Toooo kralju, tako je :D', 'Ljuca Faruk', '2015-05-15 15:08:53'),
(2, 1, 'Bila je dobra tekma :D', 'Ljuca Faruk', '2015-05-15 15:25:24'),
(3, 2, 'Predobro :D', 'Ljuca Faruk', '2015-05-15 17:35:58'),
(4, 2, 'Tako je!', 'Amila', '0000-00-00 00:00:00'),
(5, 1, 'Bilo je i vrijeme!', 'Amila', '0000-00-00 00:00:00'),
(6, 2, '&lt;!--', '&lt;!--', '0000-00-00 00:00:00'),
(7, 2, 'Na oglavku smo!', 'Nena', '0000-00-00 00:00:00'),
(8, 2, 'lele', 'lala', '2015-05-16 18:19:44'),
(9, 1, 'Pozdrav svima!', 'Lejla', '2015-05-16 20:59:29'),
(10, 2, 'Nije lose', 'Faruk', '2015-05-16 21:24:35'),
(11, 2, 'AAAAA', 'Anonimac', '2015-05-16 21:53:02'),
(12, 2, 'BBBBB', 'Anonimac', '2015-05-16 21:53:45'),
(13, 2, 'CCCCC', 'Faruk', '2015-05-16 21:54:16');

-- --------------------------------------------------------

--
-- Table structure for table `korisnici`
--

CREATE TABLE IF NOT EXISTS `korisnici` (
  `username` varchar(40) COLLATE utf8_slovenian_ci NOT NULL,
  `password` varchar(40) COLLATE utf8_slovenian_ci NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;

--
-- Dumping data for table `korisnici`
--

INSERT INTO `korisnici` (`username`, `password`) VALUES
('admin', '98b347ae0606d2d1bc2c4e19fe3f3db3'),
('Faruk', '38cc20041eaa6e03c92c0a7d17b21b9a');

-- --------------------------------------------------------

--
-- Table structure for table `vijest`
--

CREATE TABLE IF NOT EXISTS `vijest` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `naslov` varchar(100) COLLATE utf8_slovenian_ci NOT NULL,
  `tekst` text COLLATE utf8_slovenian_ci NOT NULL,
  `autor` varchar(20) COLLATE utf8_slovenian_ci NOT NULL,
  `vrijeme` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `vijest`
--

INSERT INTO `vijest` (`id`, `naslov`, `tekst`, `autor`, `vrijeme`) VALUES
(1, 'Sarajevo je pobjedilo Želju', 'Danas se odigrala utakmica gdje je Sarajevo pobjedilo Želju.', 'Ljuca Faruk', '2015-05-15 15:05:54'),
(2, 'Kako ljudi u bosni žive', 'Prosjek plate u Bosni je previše velik s obzirom na to koliko se radi.', 'Ljuca Faruk', '2015-05-15 15:07:18');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `komentar`
--
ALTER TABLE `komentar`
  ADD CONSTRAINT `komentar_ibfk_1` FOREIGN KEY (`vijest`) REFERENCES `vijest` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
