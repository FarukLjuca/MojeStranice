-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 25, 2015 at 12:37 PM
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
  `slika` text COLLATE utf8_slovenian_ci,
  PRIMARY KEY (`idNovosti`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci AUTO_INCREMENT=7 ;

--
-- Dumping data for table `novosti`
--

INSERT INTO `novosti` (`idNovosti`, `naslov`, `tekst`, `detaljnijiTekst`, `autor`, `datumObjave`, `slika`) VALUES
(3, 'Pluralsight je najbolji', 'Pluralsight, stranica na kojoj se može naći najbolji trening za buduće programemre je ubjedljivo najvolja...', 'Pluralsight, stranica na kojoj se može naći najbolji trening za buduće programemre je ubjedljivo najvolja. Duge dobra stranica je Microsoft Virtual Academy, međutim na ovoj stanici nema treninga za tehnologije koje su konkurentne Microsoftu (Android, Java...)', 'Ljuca Faruk', '2015-05-25 10:21:35', 'http://golfstinks.com/blog/wp-content/uploads/2013/02/white-tail-deer.jpg'),
(4, 'Pluralsight je najbolji', 'Pluralsight, stranica na kojoj se može naći najbolji trening za buduće programemre je ubjedljivo najvolja...', 'Pluralsight, stranica na kojoj se može naći najbolji trening za buduće programemre je ubjedljivo najvolja. Duge dobra stranica je Microsoft Virtual Academy, međutim na ovoj stanici nema treninga za tehnologije koje su konkurentne Microsoftu (Android, Java...)', 'Ljuca Faruk', '2015-05-25 10:22:11', NULL),
(5, 'Pluralsight je najbolji', 'Pluralsight, stranica na kojoj se može naći najbolji trening za buduće programemre je ubjedljivo najvolja...', NULL, 'Ljuca Faruk', '2015-05-25 10:22:41', 'http://golfstinks.com/blog/wp-content/uploads/2013/02/white-tail-deer.jpg'),
(6, 'Pluralsight je najbolji', 'Pluralsight, stranica na kojoj se može naći najbolji trening za buduće programemre je ubjedljivo najvolja...', NULL, 'Ljuca Faruk', '2015-05-25 10:23:09', NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
