-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 23, 2015 at 06:02 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `milenijumsoft`
--

-- --------------------------------------------------------

--
-- Table structure for table `novosti`
--

CREATE TABLE IF NOT EXISTS `novosti` (
  `idNovosti` int(11) NOT NULL AUTO_INCREMENT,
  `naslov` text COLLATE utf8_slovenian_ci NOT NULL,
  `tekst` text COLLATE utf8_slovenian_ci NOT NULL,
  `detaljnijiTekst` text COLLATE utf8_slovenian_ci,
  `autor` varchar(45) COLLATE utf8_slovenian_ci NOT NULL,
  `datumObjave` timestamp NOT NULL,
  PRIMARY KEY (`idNovosti`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `novosti`
--

INSERT INTO `novosti` (`idNovosti`, `naslov`, `tekst`, `detaljnijiTekst`, `autor`, `datumObjave`) VALUES
(1, 'Takmičenje iz matematike', 'Takmičenje iz matematike će se održati u petak', 'neki detaljniji tekst', 'Ljuca Faruk', '2015-05-21 20:06:18'),
(2, 'Takmičenje iz programiranja', 'Ovaj je bez detaljnije', NULL, 'Ljuca Faruk', '2015-05-21 20:06:54');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
