-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Aug 21, 2015 at 02:11 PM
-- Server version: 5.5.34
-- PHP Version: 5.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `casejoke_moscow`
--

-- --------------------------------------------------------

--
-- Table structure for table `oc_qitem`
--

CREATE TABLE `oc_qitem` (
  `qitem_id` int(11) NOT NULL AUTO_INCREMENT,
  `image` varchar(255) NOT NULL,
  `latitude_longitude` varchar(255) NOT NULL,
  `metro_id` int(11) NOT NULL,
  `visibility` tinyint(2) NOT NULL,
  `status` int(4) NOT NULL,
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`qitem_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `oc_qitem_description`
--

CREATE TABLE `oc_qitem_description` (
  `qitem_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `address` varchar(255) NOT NULL,
  `metro` varchar(255) NOT NULL,
  `meta_title` varchar(255) NOT NULL,
  `meta_description` varchar(255) NOT NULL,
  `meta_keyword` varchar(255) NOT NULL,
  PRIMARY KEY (`qitem_id`,`language_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


--
-- Table structure for table `oc_qitem_image`
--

CREATE TABLE `oc_qitem_image` (
  `qitem_image_id` int(11) NOT NULL AUTO_INCREMENT,
  `qitem_id` int(11) NOT NULL,
  `link` varchar(255) COLLATE utf8_bin NOT NULL,
  `image` varchar(255) COLLATE utf8_bin NOT NULL,
  `sort_order` int(11) NOT NULL,
  PRIMARY KEY (`qitem_image_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-----------------------------------------------------

--
-- Table structure for table `oc_qitem_image_description`
--

CREATE TABLE `oc_qitem_image_description` (
  `qitem_image_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `qitem_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`qitem_image_id`,`language_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;


