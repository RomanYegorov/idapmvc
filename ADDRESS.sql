-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 29, 2015 at 06:59 PM
-- Server version: 5.5.46-0ubuntu0.14.04.2
-- PHP Version: 5.5.9-1ubuntu4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `levitest`
--

-- --------------------------------------------------------

--
-- Table structure for table `ADDRESS`
--

CREATE TABLE IF NOT EXISTS `ADDRESS` (
  `ADDRESSID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'The unique address ID.',
  `LABEL` varchar(100) NOT NULL COMMENT 'The name of the person or organisation to which the address belongs.',
  `STREET` varchar(100) NOT NULL COMMENT 'The name of the street.',
  `HOUSENUMBER` varchar(10) NOT NULL COMMENT 'The house number (and any optional additions).',
  `POSTALCODE` varchar(6) NOT NULL COMMENT 'The postal code for the address.',
  `CITY` varchar(100) NOT NULL COMMENT 'The city in which the address is located.',
  `COUNTRY` varchar(100) NOT NULL COMMENT 'The country in which the address is located.',
  PRIMARY KEY (`ADDRESSID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='A physical address belonging to a person or organisation.' AUTO_INCREMENT=15 ;

--
-- Dumping data for table `ADDRESS`
--

INSERT INTO `ADDRESS` (`ADDRESSID`, `LABEL`, `STREET`, `HOUSENUMBER`, `POSTALCODE`, `CITY`, `COUNTRY`) VALUES
(1, 'Audi', 'TestAudiStreet', '11', '01001', 'Berlin', 'Germany'),
(2, 'Suzuki', 'TestSuzukiStreet', '22', '02002', 'Fuji', 'Japan'),
(3, 'Honda', 'HondaStreet', '33', '03003', 'Hamamatsu', 'Japan');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
