-- phpMyAdmin SQL Dump
-- version 3.2.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 21, 2011 at 01:49 AM
-- Server version: 5.5.11
-- PHP Version: 5.3.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `lagerkoch`
--

-- --------------------------------------------------------

--
-- Table structure for table `lagerkoch_rezept`
--

CREATE TABLE IF NOT EXISTS `lagerkoch_rezept` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=29 ;

--
-- Dumping data for table `lagerkoch_rezept`
--

INSERT INTO `lagerkoch_rezept` (`id`, `name`) VALUES
(17, 'Test1'),
(19, 'Test2'),
(28, 'TestAuflauf');

-- --------------------------------------------------------

--
-- Table structure for table `lagerkoch_rezeptZutaten`
--

CREATE TABLE IF NOT EXISTS `lagerkoch_rezeptZutaten` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `rezept_id` int(11) NOT NULL,
  `zutaten_id` int(11) NOT NULL,
  `unity` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=44 ;

--
-- Dumping data for table `lagerkoch_rezeptZutaten`
--

INSERT INTO `lagerkoch_rezeptZutaten` (`id`, `rezept_id`, `zutaten_id`, `unity`) VALUES
(23, 17, 18, 0.2),
(24, 17, 3, 0.3),
(25, 17, 15, 1),
(26, 17, 4, 1),
(31, 19, 3, 2.5),
(32, 19, 15, 1),
(33, 19, 4, 1),
(34, 19, 18, 0.025),
(41, 28, 18, 1),
(42, 28, 4, 4),
(43, 28, 21, 0.02);

-- --------------------------------------------------------

--
-- Table structure for table `lagerkoch_zutaten`
--

CREATE TABLE IF NOT EXISTS `lagerkoch_zutaten` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `unit` text NOT NULL,
  `price` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `lagerkoch_zutaten`
--

INSERT INTO `lagerkoch_zutaten` (`id`, `name`, `unit`, `price`) VALUES
(1, 'Mehl', 'g', 0.052),
(2, 'Mais', 'g', 0.105),
(3, 'Paprika', 'Stück', 0.99),
(4, 'Pfeffer', 'g', 1.98),
(15, 'Salz', 'g', 0.1),
(17, 'Ei', 'Stück', 0.1),
(18, 'Hackfleisch', 'kg', 1),
(21, 'Zucchini', 'kg', 1);
