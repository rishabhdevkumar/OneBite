-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 19, 2014 at 09:08 AM
-- Server version: 5.1.36
-- PHP Version: 5.3.0

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `mcgees_mcgees`
--

-- --------------------------------------------------------

--
-- Table structure for table `mc_pincode`
--

CREATE TABLE IF NOT EXISTS `mc_pincode` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pincode` varchar(255) NOT NULL,
  `order_amount` float(10,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `mc_pincode`
--

INSERT INTO `mc_pincode` (`id`, `pincode`, `order_amount`) VALUES
(13, '678567', 10.00);
