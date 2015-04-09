-- phpMyAdmin SQL Dump
-- version 4.4.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 09, 2015 at 05:58 PM
-- Server version: 5.5.41-0ubuntu0.12.04.1-log
-- PHP Version: 5.3.10-1ubuntu3.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `forms`
--

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE IF NOT EXISTS `contacts` (
  `id` int(11) NOT NULL,
  `contact_name` varchar(100) NOT NULL,
  `contact_email` varchar(200) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `contact_name`, `contact_email`, `created_at`, `updated_at`) VALUES
(1, 'Admins', 'admin@admixn.com', '0000-00-00 00:00:00', '2015-04-08 20:56:06'),
(4, 'New contact', 'new@email.com', '2015-04-09 10:27:59', '2015-04-09 10:27:59'),
(5, 'New contact', 'new@email.com', '2015-04-09 11:30:05', '2015-04-09 11:30:05'),
(6, 'Webmaster', 'webmaster@example.com', '2015-04-09 12:05:15', '2015-04-09 12:05:27'),
(7, 'Alfonso', 'alfon@ratslap.com', '2015-04-09 14:57:32', '2015-04-09 14:57:41'),
(8, 'New contact', 'new@email.com', '2015-04-09 16:45:31', '2015-04-09 16:45:31');

-- --------------------------------------------------------

--
-- Table structure for table `contact_form`
--

CREATE TABLE IF NOT EXISTS `contact_form` (
  `id` int(11) NOT NULL,
  `form_id` int(11) NOT NULL,
  `contact_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contact_form`
--

INSERT INTO `contact_form` (`id`, `form_id`, `contact_id`) VALUES
(7, 50, 7);

-- --------------------------------------------------------

--
-- Table structure for table `fields`
--

CREATE TABLE IF NOT EXISTS `fields` (
  `id` int(11) NOT NULL,
  `field_name` varchar(100) NOT NULL,
  `form_id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  `placeholder` varchar(150) NOT NULL,
  `length` int(11) NOT NULL DEFAULT '100',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fields`
--

INSERT INTO `fields` (`id`, `field_name`, `form_id`, `type_id`, `placeholder`, `length`, `created_at`, `updated_at`) VALUES
(31, 'Your name', 50, 1, 'Please give me your name', 150, '2015-04-09 13:05:17', '2015-04-09 14:57:58');

-- --------------------------------------------------------

--
-- Table structure for table `forms`
--

CREATE TABLE IF NOT EXISTS `forms` (
  `id` int(11) NOT NULL,
  `form_name` varchar(100) NOT NULL,
  `redirect` varchar(300) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `forms`
--

INSERT INTO `forms` (`id`, `form_name`, `redirect`, `created_at`, `updated_at`) VALUES
(50, 'My shiny form', 'http://localhost:9079', '2015-04-09 13:05:17', '2015-04-09 14:57:28');

-- --------------------------------------------------------

--
-- Table structure for table `responses_50`
--

CREATE TABLE IF NOT EXISTS `responses_50` (
  `id` int(11) NOT NULL,
  `field_31` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `form_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `responses_50`
--

INSERT INTO `responses_50` (`id`, `field_31`, `created_at`, `updated_at`, `form_id`) VALUES
(5, 'My name is pepe', '2015-04-09 14:58:10', '2015-04-09 14:58:10', 50),
(6, 'my name is joe', '2015-04-09 16:44:00', '2015-04-09 16:44:00', 50),
(7, 'sasasa', '2015-04-09 17:23:33', '2015-04-09 17:23:33', 50),
(8, 'sasasa', '2015-04-09 17:31:58', '2015-04-09 17:31:58', 50),
(9, 'sasasa', '2015-04-09 17:32:12', '2015-04-09 17:32:12', 50),
(10, 'pepe', '2015-04-09 17:52:19', '2015-04-09 17:52:19', 50),
(11, 'pepe', '2015-04-09 17:52:49', '2015-04-09 17:52:49', 50),
(12, 'pepe', '2015-04-09 17:53:08', '2015-04-09 17:53:08', 50),
(13, 'pepe', '2015-04-09 17:53:33', '2015-04-09 17:53:33', 50);

-- --------------------------------------------------------

--
-- Table structure for table `types`
--

CREATE TABLE IF NOT EXISTS `types` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `sql_format` varchar(300) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `types`
--

INSERT INTO `types` (`id`, `name`, `sql_format`) VALUES
(1, 'text', 'varchar(**length**)'),
(2, 'textarea', 'text'),
(3, 'checkbox', 'tinyint(1)');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'root', 'dc76e9f0c0006e8f919e0c515c66dbba3982f785');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_form`
--
ALTER TABLE `contact_form`
  ADD PRIMARY KEY (`id`),
  ADD KEY `form_id` (`form_id`),
  ADD KEY `contact_id` (`contact_id`);

--
-- Indexes for table `fields`
--
ALTER TABLE `fields`
  ADD PRIMARY KEY (`id`),
  ADD KEY `form_id` (`form_id`),
  ADD KEY `field_type` (`type_id`),
  ADD KEY `field_type_id` (`type_id`);

--
-- Indexes for table `forms`
--
ALTER TABLE `forms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `responses_50`
--
ALTER TABLE `responses_50`
  ADD PRIMARY KEY (`id`),
  ADD KEY `form_id` (`form_id`);

--
-- Indexes for table `types`
--
ALTER TABLE `types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `contact_form`
--
ALTER TABLE `contact_form`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `fields`
--
ALTER TABLE `fields`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=41;
--
-- AUTO_INCREMENT for table `forms`
--
ALTER TABLE `forms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=55;
--
-- AUTO_INCREMENT for table `responses_50`
--
ALTER TABLE `responses_50`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `types`
--
ALTER TABLE `types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `contact_form`
--
ALTER TABLE `contact_form`
  ADD CONSTRAINT `contact_form_ibfk_1` FOREIGN KEY (`form_id`) REFERENCES `forms` (`id`),
  ADD CONSTRAINT `contact_form_ibfk_2` FOREIGN KEY (`contact_id`) REFERENCES `contacts` (`id`);

--
-- Constraints for table `fields`
--
ALTER TABLE `fields`
  ADD CONSTRAINT `fields_ibfk_3` FOREIGN KEY (`form_id`) REFERENCES `forms` (`id`),
  ADD CONSTRAINT `fields_ibfk_4` FOREIGN KEY (`type_id`) REFERENCES `types` (`id`);

--
-- Constraints for table `responses_50`
--
ALTER TABLE `responses_50`
  ADD CONSTRAINT `responses_50_ibfk_1` FOREIGN KEY (`form_id`) REFERENCES `forms` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
