-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 23, 2017 at 08:00 PM
-- Server version: 5.5.32
-- PHP Version: 5.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `social_media`
--
CREATE DATABASE IF NOT EXISTS `social_media` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `social_media`;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `comment_id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `comment_author` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`comment_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `post_id`, `user_id`, `comment`, `comment_author`, `date`) VALUES
(3, 11, 13, 'this is nice project', 'Aman', '2017-03-15 09:04:51'),
(4, 11, 13, 'Hello, can you explain me this project??', 'Aman', '2017-03-15 09:44:04'),
(5, 11, 13, 'Hi,you have errors in your projects.', 'Ayushi Bijoura', '2017-03-15 10:05:19'),
(15, 11, 13, 'what you have written?', 'Ayush Bijoura', '2017-03-16 03:11:11'),
(16, 0, 0, '', 'Aman', '2017-03-18 05:19:13'),
(17, 12, 11, 'ya you can learn', 'Ayush Verma', '2017-03-23 13:29:29');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `msg_id` int(11) NOT NULL AUTO_INCREMENT,
  `sender` int(11) NOT NULL,
  `receiver` int(11) NOT NULL,
  `msg_sub` text NOT NULL,
  `msg_topic` text NOT NULL,
  `reply` text NOT NULL,
  `status` text NOT NULL,
  `msg_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`msg_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`msg_id`, `sender`, `receiver`, `msg_sub`, `msg_topic`, `reply`, `status`, `msg_date`) VALUES
(1, 11, 10, 'hi', 'hi', 'no_reply', 'unread', '2017-03-19 08:34:14'),
(2, 11, 10, 'hi', 'hi you didnt reply to my message which i sent you yesterday??', 'no_reply', 'unread', '2017-03-19 08:37:17'),
(3, 11, 13, 'html and css learning in 30daya', 'Wnat to learn html and css in 30 days?Please reply', 'hi you can learn', 'read', '2017-03-20 11:00:17');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `post_id` int(255) NOT NULL AUTO_INCREMENT,
  `user_id` int(255) NOT NULL,
  `topic_id` int(255) NOT NULL,
  `post_title` text NOT NULL,
  `post_content` text NOT NULL,
  `post_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`post_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `user_id`, `topic_id`, `post_title`, `post_content`, `post_date`) VALUES
(12, 11, 1, 'html css and php along with javascript', 'I want to learn php also html and css along with ajax and java script.', '2017-03-23 11:27:07');

-- --------------------------------------------------------

--
-- Table structure for table `topics`
--

CREATE TABLE IF NOT EXISTS `topics` (
  `topic_id` int(100) NOT NULL AUTO_INCREMENT,
  `topic_title` varchar(255) NOT NULL,
  PRIMARY KEY (`topic_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `topics`
--

INSERT INTO `topics` (`topic_id`, `topic_title`) VALUES
(5, 'HTML CSS '),
(7, 'PHP & MYSQL'),
(8, 'C++');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(255) NOT NULL,
  `user_pass` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_country` text NOT NULL,
  `user_gender` text NOT NULL,
  `user_birthday` text NOT NULL,
  `status` text NOT NULL,
  `ver_code` int(100) NOT NULL,
  `posts` text NOT NULL,
  `user_image` text NOT NULL,
  `register_date` date NOT NULL,
  `last_login` date NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_pass`, `user_email`, `user_country`, `user_gender`, `user_birthday`, `status`, `ver_code`, `posts`, `user_image`, `register_date`, `last_login`) VALUES
(11, 'Ayush Verma', '12345678', 'ayush200994@gmail.com', 'Japan', 'Male', '1994-08-29', 'unverified', 2051448089, 'yes', '12983431_1168421696532007_106990404564362178_o.jpg', '2017-03-21', '2017-03-21');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
