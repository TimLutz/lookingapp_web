-- phpMyAdmin SQL Dump
-- version 4.0.10.18
-- https://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Feb 21, 2017 at 08:10 AM
-- Server version: 5.6.35
-- PHP Version: 5.6.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `unifiedw_looking`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE IF NOT EXISTS `admins` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `is_active` int(11) NOT NULL COMMENT 'default=>0 active=>1',
  `admin_email` varchar(50) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `display_name` text NOT NULL,
  `creation_date` date NOT NULL,
  `modification_date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `is_active`, `admin_email`, `username`, `password`, `display_name`, `creation_date`, `modification_date`) VALUES
(1, 1, 'dhiraj@unifiedinfotech.net', 'admin', '2e2897b8c1b56d88bb3d59cdb11f2c1d65e4af98', 'Administrator', '0000-00-00', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `archives`
--

CREATE TABLE IF NOT EXISTS `archives` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `photo_name` varchar(200) NOT NULL,
  `caption` varchar(100) NOT NULL,
  `creation_date` datetime NOT NULL,
  `modification` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=133 ;

--
-- Dumping data for table `archives`
--

INSERT INTO `archives` (`id`, `user_id`, `photo_name`, `caption`, `creation_date`, `modification`) VALUES
(1, 12, '56b4d3fa0828105022016165522.jpg', '', '2016-02-05 16:55:22', '0000-00-00 00:00:00'),
(8, 15, '5719ba699bc2122042016054513.jpg', '', '2016-04-22 05:45:13', '0000-00-00 00:00:00'),
(108, 58, '57cd248ddf74e05092016075349.jpg', '', '2016-09-05 07:53:49', '0000-00-00 00:00:00'),
(107, 58, '57cd2439a242d05092016075225.jpg', '', '2016-09-05 07:52:25', '0000-00-00 00:00:00'),
(106, 58, '57cd23506df4f05092016074832.jpg', '', '2016-09-05 07:48:32', '0000-00-00 00:00:00'),
(105, 58, '57cd22e95f77a05092016074649.jpg', '', '2016-09-05 07:46:49', '0000-00-00 00:00:00'),
(104, 58, '57cd20b4b942c05092016073724.jpg', '', '2016-09-05 07:37:24', '0000-00-00 00:00:00'),
(103, 58, '57cd028353a8605092016052835.jpg', '', '2016-09-05 05:28:35', '0000-00-00 00:00:00'),
(102, 58, '57cd02333534005092016052715.jpg', '', '2016-09-05 05:27:15', '0000-00-00 00:00:00'),
(101, 58, '57cd01229597405092016052242.jpg', '', '2016-09-05 05:22:42', '0000-00-00 00:00:00'),
(100, 3, '57a4a52add18d05082016143938.jpg', '', '2016-08-05 14:39:38', '0000-00-00 00:00:00'),
(99, 3, '57a4a37021baf05082016143216.jpg', '', '2016-08-05 14:32:16', '0000-00-00 00:00:00'),
(98, 3, '57a4a36b217be05082016143211.jpg', '', '2016-08-05 14:32:11', '0000-00-00 00:00:00'),
(97, 3, '57a4a2d95903b05082016142945.jpg', '', '2016-08-05 14:29:45', '0000-00-00 00:00:00'),
(96, 3, '57a4a1fe950e605082016142606.jpg', '', '2016-08-05 14:26:06', '0000-00-00 00:00:00'),
(88, 55, '579b546ed406c29072016130446.jpg', '', '2016-07-29 13:10:42', '0000-00-00 00:00:00'),
(87, 2, '579b303f0a0f229072016103023.jpg', '', '2016-07-29 10:30:23', '0000-00-00 00:00:00'),
(86, 1, '579b2fc4906e829072016102820.jpg', '', '2016-07-29 10:28:20', '0000-00-00 00:00:00'),
(85, 1, '579b2fad8c2fc29072016102757.jpg', '', '2016-07-29 10:27:57', '0000-00-00 00:00:00'),
(84, 53, '5799d286b046628072016093814.jpg', '', '2016-07-28 09:38:14', '0000-00-00 00:00:00'),
(89, 55, '578ee63ab69c020072016024722.jpg', '', '2016-07-29 13:15:05', '0000-00-00 00:00:00'),
(82, 53, '5799d2403156628072016093704.jpg', '', '2016-07-28 09:37:04', '0000-00-00 00:00:00'),
(37, 1, '56b4d3897865205022016165329.jpg', '', '2016-05-02 09:50:28', '0000-00-00 00:00:00'),
(38, 2, '572732d1588fe02052016105825.jpg', '', '2016-05-02 10:58:25', '0000-00-00 00:00:00'),
(92, 3, '574fe669edef702062016075521.jpg', '', '2016-08-05 12:46:19', '0000-00-00 00:00:00'),
(40, 2, '572733a58057f02052016110157.jpg', '', '2016-05-02 11:01:57', '0000-00-00 00:00:00'),
(41, 2, '572733d2b3b7402052016110242.jpg', '', '2016-05-02 11:02:42', '0000-00-00 00:00:00'),
(42, 2, '5727340b3225c02052016110339.jpg', '', '2016-05-02 11:03:39', '0000-00-00 00:00:00'),
(43, 2, '572735351aded02052016110837.jpg', '', '2016-05-02 11:08:37', '0000-00-00 00:00:00'),
(44, 2, '572d8b5745a1407052016062943.jpg', '', '2016-05-07 07:28:36', '0000-00-00 00:00:00'),
(45, 2, '570f38c705ae214042016062927.jpg', '', '2016-05-07 07:29:02', '0000-00-00 00:00:00'),
(46, 2, '572d8c2659f3207052016063310.jpg', '', '2016-05-07 07:35:13', '0000-00-00 00:00:00'),
(47, 2, '572d8c69148d607052016063417.jpg', '', '2016-05-07 07:35:29', '0000-00-00 00:00:00'),
(80, 53, '578ee733ed84520072016025131.jpg', '', '2016-07-20 02:51:32', '0000-00-00 00:00:00'),
(95, 1, '57a491626cc8b05082016131514.jpg', '', '2016-08-05 13:15:14', '0000-00-00 00:00:00'),
(93, 3, '57a48bbf3366c05082016125111.jpg', '', '2016-08-05 12:51:11', '0000-00-00 00:00:00'),
(94, 3, '57a48c09b2f0a05082016125225.jpg', '', '2016-08-05 12:52:25', '0000-00-00 00:00:00'),
(75, 52, '57707cd220a8727062016010938.jpg', '', '2016-06-27 01:09:38', '0000-00-00 00:00:00'),
(74, 52, '577069618eb9326062016234641.jpg', '', '2016-06-26 23:46:41', '0000-00-00 00:00:00'),
(73, 52, '57705d5e5d49526062016225526.jpg', '', '2016-06-26 23:22:14', '0000-00-00 00:00:00'),
(71, 52, '57705d2326f8626062016225427.jpg', '', '2016-06-26 23:00:19', '0000-00-00 00:00:00'),
(72, 52, '57705d2d9229326062016225437.jpg', '', '2016-06-26 23:21:40', '0000-00-00 00:00:00'),
(68, 8, '5763c4358017817062016093445.jpg', '', '2016-06-17 09:34:45', '0000-00-00 00:00:00'),
(63, 1, '56cc0b02a200223022016073218.jpg', '', '2016-05-16 14:18:03', '0000-00-00 00:00:00'),
(64, 1, '570f3173b372014042016055811.jpg', '', '2016-05-17 11:16:31', '0000-00-00 00:00:00'),
(67, 46, '57537fbc8a2d405062016012620.jpg', '', '2016-06-05 01:26:32', '0000-00-00 00:00:00'),
(109, 1, '57e8cd32e7f7126092016072434.jpg', '', '2016-09-26 07:24:35', '0000-00-00 00:00:00'),
(110, 2, '57e8cf00665aa26092016073216.jpg', '', '2016-09-26 07:32:16', '0000-00-00 00:00:00'),
(111, 2, '57e8cf180acc726092016073240.jpg', '', '2016-09-26 07:32:40', '0000-00-00 00:00:00'),
(112, 61, '57e8d99c4b5ab26092016081732.jpg', '', '2016-09-26 08:17:32', '0000-00-00 00:00:00'),
(114, 62, '57e9e50e74b3b27092016031838.jpg', '', '2016-09-27 03:18:38', '0000-00-00 00:00:00'),
(115, 62, '57e9e53bbe63027092016031923.jpg', '', '2016-09-27 03:19:23', '0000-00-00 00:00:00'),
(116, 1, '57ea18f29582427092016070002.jpg', '', '2016-09-27 07:00:02', '0000-00-00 00:00:00'),
(117, 61, '57eb1b7c133aa28092016012308.jpg', '', '2016-09-28 01:23:08', '0000-00-00 00:00:00'),
(118, 61, '57eb1b8a5453e28092016012322.jpg', '', '2016-09-28 01:23:22', '0000-00-00 00:00:00'),
(119, 61, '57eb1bae3c26028092016012358.jpg', '', '2016-09-28 01:23:58', '0000-00-00 00:00:00'),
(120, 64, '581a9c569a51203112016020926.jpg', '', '2016-11-03 02:09:26', '0000-00-00 00:00:00'),
(121, 64, '581a9c6ceec4103112016020948.jpg', '', '2016-11-03 02:09:49', '0000-00-00 00:00:00'),
(122, 64, '581a9c934438103112016021027.jpg', '', '2016-11-03 02:10:27', '0000-00-00 00:00:00'),
(123, 64, '581a9db70a6c003112016021519.jpg', '', '2016-11-03 02:15:19', '0000-00-00 00:00:00'),
(124, 63, '581ab5f7de11103112016035847.jpg', '', '2016-11-03 03:58:47', '0000-00-00 00:00:00'),
(125, 65, '581ce9373258e04112016200159.jpg', '', '2016-11-04 20:01:59', '0000-00-00 00:00:00'),
(126, 65, '581ce94b3fa5004112016200219.jpg', '', '2016-11-04 20:02:19', '0000-00-00 00:00:00'),
(127, 65, '581ce95d16c8004112016200237.jpg', '', '2016-11-04 20:02:37', '0000-00-00 00:00:00'),
(128, 66, '581d04236c4a904112016215651.jpg', '', '2016-11-04 21:56:51', '0000-00-00 00:00:00'),
(129, 66, '581d0466bb58204112016215758.jpg', '', '2016-11-04 21:57:59', '0000-00-00 00:00:00'),
(130, 66, '581d04758060804112016215813.jpg', '', '2016-11-04 21:58:13', '0000-00-00 00:00:00'),
(131, 66, '581d04943374c04112016215844.jpg', '', '2016-11-04 21:58:44', '0000-00-00 00:00:00'),
(132, 67, '5847ab58827e507122016062528.jpg', '', '2016-12-07 06:25:28', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE IF NOT EXISTS `banners` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `banner_image` varchar(200) NOT NULL,
  `creation_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `banners`
--

INSERT INTO `banners` (`id`, `name`, `banner_image`, `creation_date`) VALUES
(1, 'Ads', '58061d1615b0718102016130110.jpg', '2016-10-18 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `blocked_users`
--

CREATE TABLE IF NOT EXISTS `blocked_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL COMMENT 'user_id',
  `blocked_id` int(11) NOT NULL COMMENT 'user who blocked',
  `block_dt` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `blocked_users`
--

INSERT INTO `blocked_users` (`id`, `user_id`, `blocked_id`, `block_dt`) VALUES
(1, 65, 53, '2016-11-20 06:11:05');

-- --------------------------------------------------------

--
-- Table structure for table `block_chat_users`
--

CREATE TABLE IF NOT EXISTS `block_chat_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `block_user_id` int(11) NOT NULL,
  `is_blocked` int(11) NOT NULL COMMENT '1=>block,2=>unblock',
  `creation_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `chat_users`
--

CREATE TABLE IF NOT EXISTS `chat_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `chat_user_id` int(11) NOT NULL,
  `count` int(11) NOT NULL COMMENT 'unread message count',
  `invite` int(11) NOT NULL COMMENT '1=>sent invitation 2=>accept invitation  0=>default for declain',
  `check_invitaion_sent` int(11) NOT NULL COMMENT '0=>default 1=>already sent invitation',
  `creation_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=235 ;

--
-- Dumping data for table `chat_users`
--

INSERT INTO `chat_users` (`id`, `user_id`, `chat_user_id`, `count`, `invite`, `check_invitaion_sent`, `creation_date`) VALUES
(73, 2, 1, 0, 0, 0, '2016-09-27 12:46:21'),
(75, 2, 3, 0, 0, 0, '2016-04-14 09:33:53'),
(3, 4, 3, 0, 0, 0, '2016-06-02 07:56:49'),
(4, 3, 4, 1, 0, 0, '2016-06-02 07:56:49'),
(5, 3, 12, 0, 0, 0, '2016-02-05 16:55:20'),
(6, 12, 3, 0, 0, 0, '2016-02-05 16:55:20'),
(7, 16, 12, 0, 0, 0, '2016-02-08 06:29:40'),
(8, 12, 16, 0, 0, 0, '2016-04-15 11:54:10'),
(85, 16, 1, 0, 0, 0, '2016-04-15 06:42:25'),
(87, 16, 2, 0, 0, 0, '2016-06-07 12:22:28'),
(88, 2, 16, 1, 0, 0, '2016-06-07 12:22:28'),
(86, 1, 16, 0, 0, 0, '2016-04-15 06:42:25'),
(13, 6, 16, 0, 0, 0, '2016-05-27 18:44:03'),
(14, 16, 6, 3, 0, 0, '2016-05-27 13:06:03'),
(81, 2, 6, 0, 0, 0, '2016-04-14 09:38:18'),
(79, 2, 5, 0, 0, 0, '2016-05-27 18:16:55'),
(193, 51, 53, 0, 0, 0, '2016-07-19 20:00:25'),
(192, 53, 2, 0, 0, 0, '2016-07-20 02:57:53'),
(191, 2, 53, 0, 0, 0, '2016-07-19 20:00:00'),
(190, 55, 1, 0, 0, 1, '2016-07-29 20:29:15'),
(78, 4, 2, 0, 0, 0, '2016-04-14 15:18:17'),
(74, 1, 2, 3, 0, 0, '2016-09-27 07:14:28'),
(189, 1, 55, 0, 0, 0, '2016-07-29 06:25:20'),
(188, 53, 54, 2, 0, 0, '2016-07-20 02:56:47'),
(187, 54, 53, 0, 0, 0, '2016-07-19 19:58:48'),
(186, 55, 51, 2, 0, 0, '2016-07-20 02:47:24'),
(39, 1, 3, 0, 0, 0, '2017-01-06 13:20:21'),
(40, 3, 1, 0, 0, 0, '2017-01-06 12:13:30'),
(41, 1, 4, 0, 0, 0, '2016-04-14 05:47:32'),
(42, 4, 1, 0, 0, 0, '2016-04-14 05:47:32'),
(43, 1, 5, 0, 0, 0, '2016-04-14 05:48:40'),
(44, 5, 1, 0, 0, 0, '2016-04-14 05:48:40'),
(45, 1, 6, 0, 0, 0, '2016-04-14 05:49:46'),
(46, 6, 1, 0, 0, 0, '2016-04-14 05:49:46'),
(47, 1, 7, 2, 0, 1, '2016-05-17 12:28:41'),
(48, 7, 1, 0, 0, 0, '2016-05-17 12:28:41'),
(49, 11, 1, 0, 0, 0, '2016-04-14 06:10:21'),
(50, 1, 11, 0, 0, 0, '2016-04-14 06:10:21'),
(80, 5, 2, 0, 0, 0, '2016-05-17 19:13:58'),
(84, 7, 2, 0, 0, 0, '2016-06-07 19:23:59'),
(82, 6, 2, 0, 0, 0, '2016-04-14 15:17:54'),
(76, 3, 2, 0, 0, 0, '2016-04-14 15:22:16'),
(83, 2, 7, 1, 0, 0, '2016-06-07 13:49:57'),
(77, 2, 4, 0, 0, 0, '2016-04-14 09:35:12'),
(89, 16, 3, 0, 0, 0, '2017-01-06 13:20:02'),
(90, 3, 16, 0, 0, 0, '2016-05-27 13:42:02'),
(91, 16, 4, 0, 0, 0, '2016-04-15 06:46:52'),
(92, 4, 16, 0, 0, 0, '2016-04-15 06:46:52'),
(93, 16, 5, 0, 0, 0, '2016-04-15 06:48:20'),
(94, 5, 16, 0, 0, 0, '2016-04-15 06:48:20'),
(95, 16, 7, 0, 0, 0, '2016-04-15 06:50:44'),
(96, 7, 16, 0, 0, 0, '2016-04-15 06:50:44'),
(185, 51, 55, 0, 0, 0, '2016-07-22 00:41:28'),
(184, 53, 55, 0, 0, 1, '2016-08-07 22:15:28'),
(183, 55, 53, 2, 0, 1, '2016-08-08 05:15:25'),
(182, 3, 52, 0, 0, 0, '2016-06-27 05:50:01'),
(181, 52, 3, 0, 0, 0, '2017-01-06 13:19:52'),
(180, 2, 52, 0, 0, 0, '2016-06-27 18:22:53'),
(179, 52, 2, 0, 0, 0, '2016-06-27 11:21:24'),
(113, 2, 15, 0, 0, 0, '2016-04-22 05:45:58'),
(114, 15, 2, 0, 0, 0, '2016-04-22 05:45:58'),
(115, 1, 15, 0, 0, 0, '2016-04-22 06:32:19'),
(116, 15, 1, 0, 0, 0, '2016-04-22 06:32:19'),
(178, 1, 52, 0, 0, 0, '2016-06-27 18:26:13'),
(177, 52, 1, 0, 0, 0, '2016-06-27 05:47:56'),
(176, 51, 52, 0, 0, 0, '2016-06-26 22:20:32'),
(175, 52, 51, 2, 0, 1, '2016-06-27 01:09:39'),
(174, 51, 50, 1, 0, 0, '2016-06-22 03:43:03'),
(210, 55, 6, 0, 0, 1, '2016-09-05 09:27:10'),
(173, 50, 51, 0, 0, 0, '2016-06-21 20:43:06'),
(209, 6, 55, 0, 0, 0, '2016-09-05 09:27:10'),
(172, 8, 7, 4, 0, 0, '2016-06-17 09:35:04'),
(208, 58, 59, 0, 0, 0, '2016-09-05 13:31:55'),
(171, 7, 8, 0, 0, 0, '2016-06-17 15:05:13'),
(207, 59, 58, 0, 0, 0, '2016-09-05 13:30:19'),
(206, 55, 46, 0, 0, 1, '2016-08-08 05:11:05'),
(170, 49, 48, 0, 0, 0, '2016-06-13 21:28:23'),
(205, 46, 55, 0, 0, 0, '2016-08-08 05:11:05'),
(204, 55, 45, 0, 0, 1, '2016-07-31 23:44:37'),
(203, 45, 55, 0, 0, 0, '2016-07-31 23:44:37'),
(202, 3, 55, 0, 0, 0, '2016-08-05 12:52:23'),
(169, 48, 49, 0, 0, 0, '2016-06-13 23:36:20'),
(201, 55, 3, 0, 0, 0, '2016-08-05 18:42:36'),
(168, 46, 45, 0, 0, 0, '2016-06-05 09:55:17'),
(200, 2, 55, 0, 0, 0, '2016-07-29 13:28:41'),
(167, 45, 46, 0, 0, 0, '2016-06-05 09:55:13'),
(199, 55, 2, 0, 0, 0, '2016-09-27 12:28:14'),
(166, 16, 14, 3, 0, 0, '2016-06-02 09:15:59'),
(198, 54, 55, 0, 0, 0, '2016-07-22 00:57:14'),
(165, 14, 16, 0, 0, 0, '2016-06-02 09:15:59'),
(164, 6, 5, 1, 0, 0, '2016-06-02 08:03:28'),
(197, 55, 54, 0, 0, 0, '2016-07-22 13:33:45'),
(163, 5, 6, 0, 0, 0, '2016-06-02 08:03:28'),
(196, 53, 1, 0, 0, 0, '2016-07-20 02:58:41'),
(195, 1, 53, 0, 0, 0, '2016-07-19 20:00:15'),
(194, 53, 51, 1, 0, 0, '2016-07-20 02:58:03'),
(211, 62, 61, 0, 0, 0, '2016-10-10 02:53:43'),
(212, 61, 62, 0, 0, 0, '2016-10-10 02:54:58'),
(213, 62, 1, 0, 0, 0, '2016-09-27 12:28:32'),
(214, 1, 62, 0, 0, 0, '2016-09-29 09:50:19'),
(215, 62, 2, 0, 0, 0, '2016-09-27 12:28:02'),
(216, 2, 62, 0, 0, 0, '2016-09-29 09:54:29'),
(217, 63, 64, 1, 0, 0, '2016-11-03 03:58:48'),
(218, 64, 63, 0, 0, 0, '2016-11-02 21:03:56'),
(219, 1, 65, 0, 0, 0, '2016-11-06 16:49:37'),
(220, 65, 1, 0, 0, 0, '2016-11-06 18:35:09'),
(221, 65, 66, 0, 0, 0, '2016-11-04 15:21:14'),
(222, 66, 65, 0, 0, 0, '2016-11-04 15:50:27'),
(223, 16, 67, 0, 0, 0, '2016-12-05 20:40:36'),
(224, 67, 16, 3, 0, 0, '2016-12-06 04:38:12'),
(225, 12, 67, 0, 0, 0, '2016-12-06 22:33:21'),
(226, 67, 12, 3, 0, 0, '2016-12-07 06:32:28'),
(227, 67, 68, 2, 0, 0, '2016-12-07 06:25:29'),
(228, 68, 67, 0, 0, 0, '2016-12-06 22:28:39'),
(229, 64, 67, 0, 0, 0, '2016-12-21 20:49:15'),
(230, 67, 64, 0, 0, 1, '2016-12-21 20:49:15'),
(231, 7, 71, 0, 0, 0, '2017-01-31 18:26:02'),
(232, 71, 7, 1, 0, 0, '2017-02-01 02:26:00'),
(233, 64, 71, 0, 0, 0, '2017-02-19 04:55:51'),
(234, 71, 64, 0, 1, 1, '2017-02-19 04:55:51');

-- --------------------------------------------------------

--
-- Table structure for table `favourites`
--

CREATE TABLE IF NOT EXISTS `favourites` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `favourite_user_id` int(11) NOT NULL,
  `is_favourite` int(11) NOT NULL COMMENT '0=>default 1=>favourite 2=>unfavourite',
  `browse` varchar(100) NOT NULL COMMENT 'browse,date,looking',
  `creation_date` datetime NOT NULL,
  `modification_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=134 ;

--
-- Dumping data for table `favourites`
--

INSERT INTO `favourites` (`id`, `user_id`, `favourite_user_id`, `is_favourite`, `browse`, `creation_date`, `modification_date`) VALUES
(18, 16, 6, 1, 'browse', '2016-02-22 08:05:36', '0000-00-00 00:00:00'),
(16, 1, 12, 1, 'browse', '2016-02-15 12:52:10', '0000-00-00 00:00:00'),
(10, 12, 1, 1, 'browse', '2016-02-08 06:26:25', '0000-00-00 00:00:00'),
(11, 12, 10, 1, 'browse', '2016-02-08 06:27:03', '0000-00-00 00:00:00'),
(128, 55, 2, 2, 'looking', '2016-07-29 09:35:18', '2016-07-29 09:35:18'),
(43, 1, 6, 1, 'browse', '2016-05-06 13:03:52', '0000-00-00 00:00:00'),
(44, 1, 9, 1, 'browse', '2016-05-06 13:04:56', '0000-00-00 00:00:00'),
(45, 1, 10, 1, 'browse', '2016-05-06 13:05:59', '0000-00-00 00:00:00'),
(46, 1, 11, 2, 'browse', '2016-05-07 08:56:08', '2016-05-07 08:56:08'),
(127, 2, 55, 1, 'looking', '2016-07-29 09:31:05', '0000-00-00 00:00:00'),
(126, 1, 55, 1, 'looking', '2016-07-29 09:28:49', '0000-00-00 00:00:00'),
(102, 1, 46, 1, 'browse', '2016-06-03 07:11:27', '0000-00-00 00:00:00'),
(101, 47, 2, 1, 'browse', '2016-06-03 06:52:00', '0000-00-00 00:00:00'),
(100, 47, 1, 1, 'browse', '2016-06-03 06:51:52', '2016-06-03 06:51:52'),
(125, 55, 1, 1, 'looking', '2016-07-29 09:05:02', '0000-00-00 00:00:00'),
(124, 55, 53, 1, 'browse', '2016-07-25 02:20:20', '0000-00-00 00:00:00'),
(123, 53, 55, 1, 'date', '2016-07-20 01:01:19', '0000-00-00 00:00:00'),
(122, 3, 52, 1, 'date', '2016-06-27 05:49:13', '0000-00-00 00:00:00'),
(121, 2, 52, 1, 'browse', '2016-06-27 05:45:52', '0000-00-00 00:00:00'),
(58, 7, 1, 1, 'browse', '2016-05-09 09:48:55', '0000-00-00 00:00:00'),
(59, 7, 3, 1, 'browse', '2016-05-09 09:49:01', '0000-00-00 00:00:00'),
(60, 7, 6, 1, 'browse', '2016-05-09 09:49:09', '0000-00-00 00:00:00'),
(61, 7, 8, 1, 'browse', '2016-05-09 09:49:15', '0000-00-00 00:00:00'),
(62, 7, 4, 1, 'browse', '2016-05-09 09:49:21', '0000-00-00 00:00:00'),
(63, 7, 2, 1, 'browse', '2016-05-09 10:39:57', '0000-00-00 00:00:00'),
(64, 2, 7, 1, 'browse', '2016-05-09 10:42:55', '0000-00-00 00:00:00'),
(65, 1, 7, 1, 'browse', '2016-05-09 10:43:59', '0000-00-00 00:00:00'),
(66, 3, 7, 1, 'browse', '2016-05-09 10:47:38', '0000-00-00 00:00:00'),
(120, 1, 52, 1, 'date', '2016-06-27 05:40:48', '0000-00-00 00:00:00'),
(119, 51, 52, 1, 'date', '2016-06-26 23:12:07', '0000-00-00 00:00:00'),
(118, 52, 7, 1, 'date', '2016-06-26 21:55:32', '0000-00-00 00:00:00'),
(117, 52, 2, 1, 'date', '2016-06-26 21:55:29', '0000-00-00 00:00:00'),
(116, 52, 1, 1, 'date', '2016-06-26 21:55:25', '0000-00-00 00:00:00'),
(115, 52, 51, 1, 'date', '2016-06-26 21:54:54', '0000-00-00 00:00:00'),
(99, 46, 3, 1, 'browse', '2016-06-03 06:24:38', '0000-00-00 00:00:00'),
(98, 46, 2, 1, 'browse', '2016-06-03 06:23:40', '0000-00-00 00:00:00'),
(97, 46, 1, 1, 'browse', '2016-06-03 06:23:34', '0000-00-00 00:00:00'),
(114, 49, 16, 1, 'browse', '2016-06-14 06:39:25', '0000-00-00 00:00:00'),
(113, 49, 15, 1, 'browse', '2016-06-14 06:39:21', '0000-00-00 00:00:00'),
(112, 49, 2, 1, 'browse', '2016-06-14 06:39:16', '0000-00-00 00:00:00'),
(96, 46, 45, 1, 'browse', '2016-06-03 06:23:28', '0000-00-00 00:00:00'),
(111, 49, 1, 1, 'browse', '2016-06-14 06:39:11', '0000-00-00 00:00:00'),
(110, 49, 48, 1, 'browse', '2016-06-14 04:08:45', '0000-00-00 00:00:00'),
(109, 2, 4, 1, 'browse', '2016-06-07 10:20:16', '0000-00-00 00:00:00'),
(108, 2, 8, 1, 'browse', '2016-06-07 10:20:02', '0000-00-00 00:00:00'),
(107, 2, 1, 1, 'browse', '2016-06-07 10:19:55', '0000-00-00 00:00:00'),
(106, 1, 8, 1, 'browse', '2016-06-07 10:14:23', '0000-00-00 00:00:00'),
(105, 1, 4, 1, 'browse', '2016-06-07 10:14:12', '0000-00-00 00:00:00'),
(89, 1, 3, 2, 'browse', '2016-05-24 14:31:44', '0000-00-00 00:00:00'),
(90, 1, 2, 1, 'browse', '2016-05-24 14:31:49', '0000-00-00 00:00:00'),
(91, 16, 1, 1, 'browse', '2016-05-27 12:00:57', '0000-00-00 00:00:00'),
(92, 16, 2, 1, 'browse', '2016-05-27 12:01:03', '0000-00-00 00:00:00'),
(93, 16, 3, 1, 'looking', '2016-05-27 12:52:50', '0000-00-00 00:00:00'),
(104, 46, 47, 1, 'browse', '2016-06-05 01:10:28', '0000-00-00 00:00:00'),
(103, 2, 46, 1, 'browse', '2016-06-03 07:12:37', '0000-00-00 00:00:00'),
(129, 62, 61, 1, 'browse', '2016-09-25 20:01:56', '0000-00-00 00:00:00'),
(130, 61, 62, 1, 'browse', '2016-09-25 20:03:11', '0000-00-00 00:00:00'),
(131, 65, 64, 2, 'browse', '2016-11-17 01:56:34', '2016-11-17 01:56:34'),
(132, 67, 51, 1, 'date', '2016-12-07 06:21:10', '0000-00-00 00:00:00'),
(133, 3, 1, 2, 'browse', '2017-01-02 09:21:58', '2017-01-02 09:21:58');

-- --------------------------------------------------------

--
-- Table structure for table `flags`
--

CREATE TABLE IF NOT EXISTS `flags` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `flag` text NOT NULL,
  `archive` int(11) NOT NULL COMMENT 'o=>default 1=>archive',
  `creation_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

--
-- Dumping data for table `flags`
--

INSERT INTO `flags` (`id`, `sender_id`, `receiver_id`, `flag`, `archive`, `creation_date`) VALUES
(2, 65, 48, 'Solicitations/Spam', 1, '2016-11-05 01:18:36'),
(3, 65, 66, 'Other', 1, '2016-11-06 02:36:00'),
(4, 65, 1, 'Harassment', 1, '2016-11-06 02:38:51'),
(5, 65, 45, 'Image Violation', 0, '2016-11-20 18:18:37'),
(6, 67, 16, 'Impersonation', 1, '2016-12-05 00:41:21'),
(7, 62, 67, 'Under Age', 1, '2016-12-21 14:44:55'),
(8, 67, 66, 'Image Violation', 1, '2016-12-24 01:11:21'),
(9, 67, 51, 'Text Violation', 1, '2016-12-24 01:11:34'),
(10, 67, 55, 'Under Age', 1, '2016-12-24 01:11:53'),
(11, 67, 49, 'Impersonation', 0, '2016-12-24 01:12:51'),
(12, 67, 45, 'Harassment', 0, '2016-12-24 01:13:13'),
(13, 67, 69, 'Solicitations/Spam', 0, '2016-12-24 01:13:33'),
(14, 67, 54, 'Other', 0, '2016-12-24 01:16:38'),
(15, 67, 46, 'Image Violation', 0, '2016-12-24 01:19:11'),
(16, 67, 48, 'Under Age', 0, '2016-12-24 01:19:38'),
(17, 67, 70, 'Impersonation', 0, '2016-12-24 01:19:49'),
(18, 67, 50, 'Harassment', 0, '2016-12-24 01:20:03'),
(19, 67, 63, 'Solicitations/Spam', 0, '2016-12-24 01:20:45'),
(20, 67, 53, 'Other', 0, '2016-12-26 16:11:22'),
(21, 67, 61, 'Image Violation', 0, '2016-12-26 16:14:37'),
(22, 70, 50, 'Other', 0, '2016-12-27 07:07:57'),
(23, 70, 1, 'Impersonation', 0, '2016-12-27 07:09:35'),
(24, 3, 1, 'Under Age', 0, '2016-12-28 06:56:39'),
(25, 1, 3, 'Solicitations/Spam', 1, '2016-12-28 06:59:36');

-- --------------------------------------------------------

--
-- Table structure for table `matches_filter_values`
--

CREATE TABLE IF NOT EXISTS `matches_filter_values` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `enable_filters` varchar(100) NOT NULL,
  `online` varchar(100) NOT NULL,
  `match` varchar(100) NOT NULL,
  `user_photos` varchar(100) NOT NULL,
  `his_identities` text NOT NULL,
  `his_seeking` text NOT NULL,
  `ethnicity` text NOT NULL,
  `relationship_status` text NOT NULL,
  `age` varchar(100) NOT NULL,
  `height` varchar(100) NOT NULL,
  `weight` varchar(100) NOT NULL,
  `type` varchar(50) NOT NULL COMMENT 'browse,dating,looking',
  `list_array` varchar(200) NOT NULL,
  `creation_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=139 ;

--
-- Dumping data for table `matches_filter_values`
--

INSERT INTO `matches_filter_values` (`id`, `user_id`, `enable_filters`, `online`, `match`, `user_photos`, `his_identities`, `his_seeking`, `ethnicity`, `relationship_status`, `age`, `height`, `weight`, `type`, `list_array`, `creation_date`) VALUES
(2, 12, '1', 'All Guys', '', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'browse', '1,1,0,0,0,0,0,0,0,0', '2016-02-08 11:02:56'),
(88, 9, '1', 'Recently', '', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', '27 - 36', 'Not Set', 'Not Set', 'browse', '1,0,0,0,0,1,0,0,0,0', '2016-07-04 07:20:59'),
(100, 13, '0', 'Recently', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'dating', '0,0,0,0,0,0,0,0,0,0,0,0', '2016-07-29 05:20:13'),
(87, 51, '1', 'Right Now', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'dating', '0,1,1,0,0,0,0,0,0,0,0,0', '2016-06-27 01:05:55'),
(86, 52, '1', '', 'Lowest', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set - Not Set', 'Not Set - Not Set', 'Not Set - Not Set', 'looking', '0,0,1,1,0,0,0,0,0,0,0,0', '2016-07-15 09:33:19'),
(65, 16, '1', '', '', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set - Not Set', 'Not Set', 'Not Set', 'looking', '0,0,1,0,0,0,0,0,0,0,0,0', '2016-05-27 12:54:46'),
(85, 52, '1', 'All Guys', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set - Not Set', 'Not Set - Not Set', 'Not Set - Not Set', 'dating', '0,1,1,0,0,0,0,0,0,0,0,0', '2016-06-27 01:07:05'),
(84, 51, '0', 'Recently', '', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'browse', '0,0,0,0,0,0,0,0,0,0', '2016-06-27 01:03:38'),
(83, 52, '0', 'Recently', '', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set - Not Set', 'Not Set - Not Set', 'Not Set - Not Set', 'browse', '0,0,0,0,0,0,0,0,0,0', '2016-07-15 09:30:14'),
(37, 1, '0', 'All Guys', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set - Not Set', 'Not Set - Not Set', 'Not Set - Not Set', 'dating', '0,0,0,0,0,0,0,0,0,0,0,0', '2016-09-01 11:37:05'),
(82, 50, '0', 'Recently', '', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'browse', '0,0,0,0,0,0,0,0,0,0', '2016-06-24 15:08:56'),
(80, 49, '1', 'All Guys', '', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'browse', '1,1,0,0,0,0,0,0,0,0', '2016-06-19 21:23:54'),
(44, 2, '0', 'Recently', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'dating', '0,0,0,0,0,0,0,0,0,0,0,0', '2016-09-26 07:29:00'),
(78, 48, '0', 'Recently', '', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'browse', '0,0,0,0,0,0,0,0,0,0', '2016-06-14 01:44:23'),
(133, 1, '0', 'Recently', '', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'browse', '0,0,0,0,0,0,0,0,0,0', '2017-01-10 10:02:06'),
(98, 13, '0', 'Recently', '', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'browse', '0,0,0,0,0,0,0,0,0,0', '2016-07-28 10:00:12'),
(49, 5, '0', 'Recently', '', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'browse', '0,0,0,0,0,0,0,0,0,0', '2016-05-02 05:17:26'),
(73, 47, '0', 'Recently', '', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'browse', '0,0,0,0,0,0,0,0,0,0', '2016-06-03 06:51:40'),
(51, 8, '0', 'Recently', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'dating', '0,0,0,0,0,0,0,0,0,0,0,0', '2016-05-02 05:34:54'),
(57, 7, '0', 'Recently', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'dating', '0,0,0,0,0,0,0,0,0,0,0,0', '2016-05-10 10:31:40'),
(77, 46, '0', 'Recently', '', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'browse', '0,0,0,0,0,0,0,0,0,0', '2016-06-12 06:35:19'),
(71, 14, '0', 'Recently', '', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'browse', '0,0,0,0,0,0,0,0,0,0', '2016-06-02 09:07:47'),
(62, 1, '0', '', '', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'looking', '0,0,0,0,0,0,0,0,0,0,0,0', '2016-09-01 11:30:17'),
(64, 3, '0', 'All Guys', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set - Not Set', 'Not Set - Not Set', 'Not Set - Not Set', 'dating', '0,0,0,0,0,0,0,0,0,0,0,0', '2017-01-27 09:21:00'),
(89, 54, '1', 'Recently', '', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'browse', '1,0,0,0,0,0,0,0,0,0', '2016-07-22 06:02:56'),
(135, 71, '1', 'All Guys', '', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'browse', '1,1,0,0,0,0,0,0,0,0', '2017-02-16 12:57:55'),
(91, 55, '1', 'All Guys', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set - Not Set', 'Not Set', 'Not Set', 'dating', '0,1,1,0,0,0,0,0,0,0,0,0', '2016-09-10 07:22:36'),
(96, 55, '0', '', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set - Not Set', 'Not Set - Not Set', 'Not Set - Not Set', 'looking', '0,0,0,0,0,0,0,0,0,0,0,0', '2016-09-10 07:22:24'),
(105, 53, '1', 'All Guys', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'dating', '0,1,1,0,0,0,0,0,0,0,0,0', '2016-08-01 03:03:26'),
(113, 55, '0', 'Recently', '', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'browse', '0,0,0,0,0,0,0,0,0,0', '2016-09-10 07:18:46'),
(110, 58, '0', '', '', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'looking', '0,0,0,0,0,0,0,0,0,0,0,0', '2016-09-05 07:33:23'),
(112, 58, '0', 'Recently', '', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'browse', '0,0,0,0,0,0,0,0,0,0', '2016-09-05 09:22:15'),
(115, 62, '0', 'Recently', '', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'browse', '0,0,0,0,0,0,0,0,0,0', '2016-10-23 18:57:44'),
(130, 2, '0', 'Recently', '', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'browse', '0,0,0,0,0,0,0,0,0,0', '2016-12-07 06:37:00'),
(116, 63, '1', 'All Guys', '', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'browse', '1,1,0,0,0,0,0,0,0,0', '2016-11-03 00:58:33'),
(117, 63, '1', 'All Guys', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', '100 lbs - 130 lbs', 'dating', '0,1,1,0,0,0,0,0,0,1,0,0', '2016-11-03 04:19:50'),
(118, 63, '1', '', '', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', '100 lbs - 138 lbs', 'looking', '0,0,1,0,0,0,0,0,0,1,0,0', '2016-11-03 08:10:56'),
(119, 13, '0', '', '', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set - Not Set', 'looking', '0,0,0,0,0,0,0,0,0,0,0,0', '2016-11-07 05:24:55'),
(120, 65, '1', 'All Guys', 'Highest', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set - Not Set', 'Not Set - Not Set', 'Not Set - Not Set', 'dating', '0,1,1,1,0,0,0,0,0,0,0,0', '2016-11-20 22:12:21'),
(121, 66, '0', 'Recently', '', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'browse', '0,0,0,0,0,0,0,0,0,0', '2016-11-04 21:58:51'),
(122, 66, '0', '', '', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'looking', '0,0,0,0,0,0,0,0,0,0,0,0', '2016-11-04 22:11:46'),
(124, 65, '1', 'All Guys', '', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'browse', '1,1,0,0,0,0,0,0,0,0', '2016-11-20 19:26:06'),
(125, 65, '0', '', '', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set - Not Set', 'Not Set - Not Set', 'looking', '0,0,0,0,0,0,0,0,0,0,0,0', '2016-11-07 05:48:51'),
(134, 67, '0', 'Recently', '', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'browse', '0,0,0,0,0,0,0,0,0,0', '2017-01-11 22:03:01'),
(127, 67, '1', 'All Guys', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'dating', '0,1,1,0,0,0,0,0,0,0,0,0', '2016-12-27 06:09:53'),
(128, 68, '0', 'Recently', '', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'browse', '0,0,0,0,0,0,0,0,0,0', '2016-12-07 05:12:33'),
(129, 67, '0', '', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'looking', '0,0,0,0,0,0,0,0,0,0,0,0', '2016-12-27 06:09:50'),
(131, 70, '1', 'All Guys', '', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'browse', '1,1,0,0,0,0,0,0,0,0', '2016-12-27 07:07:32'),
(132, 3, '0', 'Recently', '', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set - Not Set', 'Not Set - Not Set', 'Not Set - Not Set', 'browse', '0,0,0,0,0,0,0,0,0,0', '2017-01-27 09:07:32'),
(136, 71, '1', 'Recently', 'Lowest', 'Verified Photo', ' Daddy ,Daddy Chaser', 'Bear Chaser', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'dating', '0,1,0,1,1,1,1,0,0,0,0,0', '2017-02-19 04:58:29'),
(137, 74, '1', 'All Guys', '', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'browse', '1,1,0,0,0,0,0,0,0,0', '2017-02-12 23:30:06'),
(138, 71, '0', '', '', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'Not Set', 'looking', '0,0,0,0,0,0,0,0,0,0,0,0', '2017-02-17 04:43:56');

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE IF NOT EXISTS `notes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `note_user_id` int(11) NOT NULL COMMENT 'whom user give note',
  `note` text NOT NULL,
  `creation_date` datetime NOT NULL,
  `modification_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `notes`
--

INSERT INTO `notes` (`id`, `user_id`, `note_user_id`, `note`, `creation_date`, `modification_date`) VALUES
(7, 52, 1, 'My note about this user', '2016-06-26 22:08:07', '2016-06-26 22:08:17'),
(8, 55, 53, 'Carlos', '2016-07-25 02:32:13', '0000-00-00 00:00:00'),
(3, 16, 6, 'Hello', '2016-02-22 08:05:03', '0000-00-00 00:00:00'),
(9, 55, 1, 'Basu', '2016-07-29 09:30:29', '0000-00-00 00:00:00'),
(10, 65, 64, 'Carlos.  More about Carlos. ', '2016-11-14 02:22:06', '2016-11-14 02:22:18');

-- --------------------------------------------------------

--
-- Table structure for table `phrases`
--

CREATE TABLE IF NOT EXISTS `phrases` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `phrases` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `creation_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `phrases`
--

INSERT INTO `phrases` (`id`, `user_id`, `phrases`, `creation_date`) VALUES
(13, 55, 'Hello', '2016-07-29 13:18:25'),
(12, 49, 'You ', '2016-06-14 04:41:06'),
(4, 2, 'The ', '2016-05-17 13:36:38'),
(5, 2, 'The ', '2016-05-17 13:42:20'),
(10, 3, 'sdf', '2016-05-27 08:01:34'),
(11, 46, 'Helli', '2016-06-05 01:31:48'),
(14, 65, 'Message 2', '2016-11-04 21:17:53'),
(15, 65, 'Message ', '2016-11-04 21:17:53'),
(16, 67, 'Test message. ', '2016-12-06 04:37:23'),
(17, 67, 'Test message. Looking ', '2016-12-06 06:11:57');

-- --------------------------------------------------------

--
-- Table structure for table `profiles`
--

CREATE TABLE IF NOT EXISTS `profiles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `start_time` datetime NOT NULL,
  `end_time` datetime NOT NULL,
  `profile_name` varchar(120) NOT NULL,
  `location` varchar(60) NOT NULL,
  `identity` text NOT NULL,
  `ethnicity` text NOT NULL,
  `position` varchar(120) NOT NULL,
  `behaviour` varchar(120) NOT NULL,
  `latitude` varchar(20) NOT NULL,
  `longitude` varchar(20) NOT NULL,
  `travel_plans` varchar(60) NOT NULL,
  `orientation` varchar(60) NOT NULL,
  `safe_sex` varchar(60) NOT NULL,
  `HIV_status` varchar(60) NOT NULL,
  `cock_size` varchar(60) NOT NULL,
  `cock_type` varchar(60) NOT NULL,
  `kinks_and_fetishes` varchar(60) NOT NULL,
  `birthday` datetime NOT NULL,
  `race` varchar(120) NOT NULL,
  `height` varchar(60) NOT NULL,
  `height_cm` int(11) NOT NULL COMMENT 'for filtering',
  `weight` varchar(60) NOT NULL,
  `Weight_kg` int(11) NOT NULL COMMENT 'for filtering now change kg value to lbs value',
  `hair_color` varchar(60) NOT NULL,
  `body_hair` varchar(60) NOT NULL,
  `facial_hair` varchar(60) NOT NULL,
  `eye_color` varchar(60) NOT NULL,
  `body_type` varchar(60) NOT NULL,
  `drugs` varchar(60) NOT NULL,
  `drinking` varchar(60) NOT NULL,
  `smoking` varchar(60) NOT NULL,
  `about_me` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `his_identitie` text NOT NULL,
  `relationship_status` varchar(100) NOT NULL,
  `where_I_leave` text NOT NULL,
  `facebook_link` varchar(100) NOT NULL,
  `twitter_link` varchar(100) NOT NULL,
  `linkedin_link` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=75 ;

--
-- Dumping data for table `profiles`
--

INSERT INTO `profiles` (`id`, `user_id`, `start_time`, `end_time`, `profile_name`, `location`, `identity`, `ethnicity`, `position`, `behaviour`, `latitude`, `longitude`, `travel_plans`, `orientation`, `safe_sex`, `HIV_status`, `cock_size`, `cock_type`, `kinks_and_fetishes`, `birthday`, `race`, `height`, `height_cm`, `weight`, `Weight_kg`, `hair_color`, `body_hair`, `facial_hair`, `eye_color`, `body_type`, `drugs`, `drinking`, `smoking`, `about_me`, `his_identitie`, `relationship_status`, `where_I_leave`, `facebook_link`, `twitter_link`, `linkedin_link`) VALUES
(1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 'Circuit,Poz,Transgender,College,Twink', 'Asian', '', '', '', '', '', '', '', '', '', '', '', '1998-02-05 00:00:00', '', '4 ft   (122cm)', 122, '200 lbs  (91 kgs)', 200, '', '', '', '', '', '', '', '', 'Basu sggsgs', 'Poz,Circuit,Transgender,Twink,College', 'Single', 'Klondike', 'www.facebook.com/', 'www.twitter.com/', 'www.'),
(2, 2, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 'Transgender,College,Leather,Geek,Jock', 'Asian', '', '', '', '', '', '', '', '', '', '', '', '1998-02-05 00:00:00', '', '4 ft   (122cm)', 122, '100 lbs  (45 kgs)', 100, '', '', '', '', '', '', '', '', 'One the best ever since it came from my ', 'College,Transgender,Twink,Leather,Geek', 'Single', 'Jkl', 'www.facebook.com/', 'www.twitter.com/', 'www.'),
(3, 3, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 'Transgender,College,Leather,Military,Jock', 'White/Caucasian', '', '', '', '', '', '', '', '', '', '', '', '1998-02-05 00:00:00', '', '4 ft   (122cm)', 122, '100 lbs  (45 kgs)', 100, '', '', '', '', '', '', '', '', 'Qeerrrr ', 'Clean Cut,Rugged,Bisexual,Discreet,Nudist', 'In a Relationship', 'kolj', 'www.facebook.com/', 'www.twitter.com/', 'www.'),
(4, 4, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 'Leather,Jock,Daddy Chaser,Bear Chaser,Circuit', 'Other', '', '', '', '', '', '', '', '', '', '', '', '1998-02-05 00:00:00', '', '4 ft   (122cm)', 122, '155 lbs  (70 kgs)', 155, '', '', '', '', '', '', '', '', 'Three the best ever since it came from my', 'Military,Jock, Daddy ,Leather,Discreet', 'Married', 'Klo', 'www.facebook.com/', 'www.twitter.com/', 'www.'),
(5, 5, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 'Circuit,Poz,Transgender,College,Leather', 'Black/African', '', '', '', '', '', '', '', '', '', '', '', '1998-02-05 00:00:00', '', '4 ft   (122cm)', 122, '100 lbs  (45 kgs)', 100, '', '', '', '', '', '', '', '', 'Four the best ever since it came from my', 'Discreet,Bisexual,Poz,Circuit,Twink', 'Engaged', 'Klo', 'www.facebook.com/', 'www.twitter.com/', 'www.'),
(6, 6, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 'Poz,College,Leather,Jock,Daddy Chaser', 'Pacific Islander', '', '', '', '', '', '', '', '', '', '', '', '1988-11-03 00:00:00', '', '5 ft 3 inch  (160cm)', 160, '140 lbs  (64 kgs)', 140, '', '', '', '', '', '', '', '', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. ', 'Otter,Nudist,Circuit,Twink,Geek', 'Engaged', 'Klo', 'www.facebook.com/', 'www.twitter.com/', 'www.'),
(7, 7, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 'Military, Daddy , Bear ,Daddy Chaser,Bear Chaser', 'Black/African', '', '', '', '', '', '', '', '', '', '', '', '1987-02-05 00:00:00', '', '5 ft 8 inch  (173cm)', 173, '135 lbs  (61 kgs)', 135, '', '', '', '', '', '', '', '', 'six the best ever since it came from my', 'Clean Cut,Discreet,Circuit,Poz,College', 'Dating', 'Hfr', 'www.facebook.com/', 'www.twitter.com/', 'www.'),
(8, 8, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 'College,Transgender,Leather,Geek,Jock', 'Native American', '', '', '', '', '', '', '', '', '', '', '', '1979-07-05 00:00:00', '', '5 ft 9 inch  (175cm)', 175, '208 lbs  (94 kgs)', 208, '', '', '', '', '', '', '', '', 'Seven the best ever since it came from my', 'Clean Cut,Discreet,Circuit,Poz,Twink', 'Open Relationship', 'Dei', 'www.facebook.com/', 'www.twitter.com/', 'www.'),
(9, 9, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 'Bisexual,Poz,Circuit,Twink,Geek', 'Latin/Hispanic', '', '', '', '', '', '', '', '', '', '', '', '1971-05-05 00:00:00', '', '8 ft   (244cm)', 244, '163 lbs  (74 kgs)', 163, '', '', '', '', '', '', '', '', 'Eight the best ever since it came from my', 'Nudist,Circuit,Poz,Geek,Leather', 'Married', 'Klo', 'www.facebook.com/', 'www.twitter.com/', 'www.'),
(10, 10, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 'Transgender,Leather,Geek,Jock,Military', 'Middle Eastern', '', '', '', '', '', '', '', '', '', '', '', '1990-11-05 00:00:00', '', '7 ft   (213cm)', 213, '169 lbs  (77 kgs)', 169, '', '', '', '', '', '', '', '', 'nine the best ever since it came from my', 'Poz,Circuit,Geek,Leather,Jock', 'Partnered', 'Kol', 'www.facebook.com/', 'www.twitter.com/', 'www.'),
(11, 11, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 'Transgender,Leather,Geek,Jock,Daddy Chaser', 'Mixed/Multi', '', '', '', '', '', '', '', '', '', '', '', '1990-02-05 00:00:00', '', '4 ft 5 inch  (135cm)', 135, '109 lbs  (49 kgs)', 109, '', '', '', '', '', '', '', '', 'ten the best ever since it came from my', 'College,Transgender,Leather,Geek,Jock', 'Partnered', 'Kol', 'www.facebook.com/', 'www.twitter.com/', 'www.'),
(12, 12, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 'Military,Jock,Daddy Chaser,Geek,Muscle', 'Middle Eastern', '', '', '', '', '', '', '', '', '', '', '', '1990-02-05 00:00:00', '', '5 ft 8 inch  (173cm)', 173, '130 lbs  (59 kgs)', 130, '', '', '', '', '', '', '', '', '', 'Bisexual,Discreet,Circuit,Poz,Transgender', 'Partnered', 'Ghu', 'www.facebook.com/', 'www.twitter.com/', 'www.'),
(13, 13, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 'Bisexual,Poz,College, Bear , Daddy ', 'Other', '', '', '', '', '', '', '', '', '', '', '', '1987-12-05 00:00:00', '', '6 ft   (183cm)', 183, '139 lbs  (63 kgs)', 139, '', '', '', '', '', '', '', '', '', 'Otter,Nudist,Twink,Muscle,Leather', 'In a Relationship', 'Dgt', 'www.facebook.com/', 'www.twitter.com/', 'www.'),
(14, 14, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 'Circuit,Transgender,Geek,Muscle,Jock', 'Black/African', '', '', '', '', '', '', '', '', '', '', '', '1990-02-05 00:00:00', '', '4 ft 2 inch  (127cm)', 127, '111 lbs  (50 kgs)', 111, '', '', '', '', '', '', '', '', '', 'College,Leather,Jock, Daddy ,Military', 'In a Relationship', 'Ghjk', 'www.facebook.com/', 'www.twitter.com/', 'www.'),
(15, 15, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 'Muscle,Jock,Military,Leather,Geek', 'Asian', '', '', '', '', '', '', '', '', '', '', '', '1998-02-05 00:00:00', '', '4 ft   (122cm)', 122, '100 lbs  (45 kgs)', 100, '', '', '', '', '', '', '', '', '', 'Military,Jock, Daddy , Bear ,Leather', 'Single', 'Hhhh', 'www.facebook.com/', 'www.twitter.com/', 'www.'),
(16, 16, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 'Bear Chaser,Daddy Chaser,Muscle,Jock,Leather', 'Latin/Hispanic', '', '', '', '', '', '', '', '', '', '', '', '1998-02-05 00:00:00', '', '5 ft 1 inch  (155cm)', 155, '123 lbs  (56 kgs)', 123, '', '', '', '', '', '', '', '', 'Demo ', 'Jock,Muscle,Geek,Transgender,Twink', 'Dating', 'Kolkata', 'www.facebook.com/', 'www.twitter.com/', 'www.'),
(60, 60, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 'Muscle', 'Asian', '', '', '', '', '', '', '', '', '', '', '', '1998-09-07 00:00:00', '', '4 ft   (122cm)', 122, '100 lbs  (45 kgs)', 100, '', '', '', '', '', '', '', '', 'I am Niranjan.hghfddjkgdfu', 'Muscle', 'Single', 'Kolkata', 'www.facebook.com/', 'www.twitter.com/', 'www.'),
(55, 55, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ' Daddy ,  Muscle,  Poz,  Nudist,  Discreet', 'Latin/Hispanic', '', '', '', '', '', '', '', '', '', '', '', '1963-01-10 00:00:00', '', '6 ft 1 inch  (185cm)', 185, '180 lbs  (82 kgs)', 180, '', '', '', '', '', '', '', '', '', 'Daddy Chaser,Muscle,Jock,Poz', 'In a Relationship', '', 'www.facebook.com/', 'www.twitter.com/', 'www.'),
(56, 56, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0000-00-00 00:00:00', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(57, 57, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0000-00-00 00:00:00', '', '', 0, '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(53, 53, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ' Bear ,Bear Chaser, Daddy ,Daddy Chaser,Military', 'Asian', '', '', '', '', '', '', '', '', '', '', '', '1998-07-15 00:00:00', '', '4 ft   (122cm)', 122, '100 lbs  (45 kgs)', 100, '', '', '', '', '', '', '', '', '', 'Otter,Clean Cut,Rugged,Nudist,Discreet', 'Single', '', 'www.facebook.com/', 'www.twitter.com/', 'www.'),
(54, 54, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ' Daddy ,Muscle,Poz', 'White/Caucasian', '', '', '', '', '', '', '', '', '', '', '', '1963-01-10 00:00:00', '', '6 ft 1 inch  (185cm)', 185, '175 lbs  (79 kgs)', 175, '', '', '', '', '', '', '', '', 'Hello there and the first place I have no clue who they are the same thing as the only thing is I don''t think I''m going to get the chance of winning a game in my room. ', 'Daddy Chaser,Muscle,Jock,Poz', 'Single', 'Los Amgeles', 'www.facebook.com/timlutz1', 'www.twitter.com/timlutztweets', 'www.google.com'),
(52, 52, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ' Daddy ,Muscle,Poz', 'White/Caucasian', '', '', '', '', '', '', '', '', '', '', '', '1963-01-10 00:00:00', '', '6 ft 1 inch  (185cm)', 185, '180 lbs  (82 kgs)', 180, '', '', '', '', '', '', '', '', '', 'Daddy Chaser,Muscle,Jock,Poz', 'Single', 'Los angeles, CA', 'www.facebook.com/', 'www.twitter.com/', 'www.'),
(51, 51, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ' Bear ,Bear Chaser, Daddy ,Daddy Chaser,Military', 'Asian', '', '', '', '', '', '', '', '', '', '', '', '1998-06-21 00:00:00', '', '4 ft   (122cm)', 122, '100 lbs  (45 kgs)', 100, '', '', '', '', '', '', '', '', '', 'Otter,Clean Cut,Rugged,Nudist,Discreet', 'Single', '', 'www.facebook.com/', 'www.twitter.com/', 'www.'),
(50, 50, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ' Daddy ,Muscle,Poz', 'White/Caucasian', '', '', '', '', '', '', '', '', '', '', '', '1963-01-10 00:00:00', '', '6 ft 1 inch  (185cm)', 185, '180 lbs  (82 kgs)', 180, '', '', '', '', '', '', '', '', 'He''s the only thing that I have to go back to. The best way of saying it would be nice and funny to see you soon enough for the rest is history is not an easy to get my nails are the same thing to me I was in my room for a long way in which a man with my family and friends are so many things that are the only way I do am a total waste of my friends are so many things that make it. ', 'Daddy Chaser,Muscle,Poz,Jock', 'In a Relationship', 'Los Angeles', 'www.facebook.com/timlutz1', 'www.twitter.com/timlutztweets', 'www.google.com'),
(49, 49, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ' Daddy ,Muscle,Poz', 'White/Caucasian', '', '', '', '', '', '', '', '', '', '', '', '1963-01-10 00:00:00', '', '6 ft 1 inch  (185cm)', 185, '180 lbs  (82 kgs)', 180, '', '', '', '', '', '', '', '', '', 'Daddy Chaser,Jock,Muscle,Poz', 'In a Relationship', 'Los Angeles', 'www.facebook.com/', 'www.twitter.com/', 'www.'),
(48, 48, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ' Bear ,Bear Chaser, Daddy ,Daddy Chaser,Military', 'Asian', '', '', '', '', '', '', '', '', '', '', '', '1998-06-13 00:00:00', '', '4 ft   (122cm)', 122, '100 lbs  (45 kgs)', 100, '', '', '', '', '', '', '', '', '', 'Otter,Clean Cut,Rugged,Nudist,Discreet', 'Single', '', 'www.facebook.com/', 'www.twitter.com/', 'www.'),
(47, 47, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ' Bear , Daddy ,Jock,Muscle,Geek', 'Middle Eastern', '', '', '', '', '', '', '', '', '', '', '', '1998-06-03 00:00:00', '', '4 ft 2 inch  (127cm)', 127, '103 lbs  (47 kgs)', 103, '', '', '', '', '', '', '', '', '', 'Poz,Transgender,Twink,Geek,Leather', 'Partnered', '', 'www.facebook.com/', 'www.twitter.com/', 'www.'),
(45, 45, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ' Bear ,Bear Chaser, Daddy ,Daddy Chaser,Military', 'Asian', '', '', '', '', '', '', '', '', '', '', '', '1998-06-02 00:00:00', '', '4 ft   (122cm)', 122, '100 lbs  (45 kgs)', 100, '', '', '', '', '', '', '', '', '', 'Otter,Clean Cut,Rugged,Nudist,Discreet', 'Single', '', 'www.facebook.com/', 'www.twitter.com/', 'www.'),
(46, 46, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ' Daddy ,Muscle,Poz', 'White/Caucasian', '', '', '', '', '', '', '', '', '', '', '', '1963-01-10 00:00:00', '', '6 ft   (183cm)', 183, '180 lbs  (82 kgs)', 180, '', '', '', '', '', '', '', '', 'The only thing is I have a nice person but it was just a few weeks of a sudden it was just about every day for a few weeks of a sudden it is not an issue of whether it was just about every day for a few weeks of school tomorrow and I''m still not sure what I was a great way of saying. ', 'Daddy Chaser,Muscle,Jock,Poz', 'In a Relationship', 'Los Angeles', 'www.facebook.com/timlutz1', 'www.twitter.com/timlutztweets', 'www.google.com'),
(61, 61, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ' Bear ,Bear Chaser, Daddy ,Daddy Chaser,Military', 'Asian', '', '', '', '', '', '', '', '', '', '', '', '1998-09-24 00:00:00', '', '4 ft   (122cm)', 122, '100 lbs  (45 kgs)', 100, '', '', '', '', '', '', '', '', '', 'Otter,Clean Cut,Rugged,Nudist,Discreet', 'Single', '', 'www.facebook.com/', 'www.twitter.com/', 'www.'),
(62, 62, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ' Daddy ,Muscle,Poz,Nudist', 'White/Caucasian', '', '', '', '', '', '', '', '', '', '', '', '1963-01-10 00:00:00', '', '6 ft 1 inch  (185cm)', 185, '175 lbs  (79 kgs)', 175, '', '', '', '', '', '', '', '', 'You are free to get the past to your address but please do not let me know what the problem was. Hello I love my friend with my name on the last name  I have been to the gym today for. ', 'Daddy Chaser,Muscle,Jock,College,Poz', 'Single', 'Los Angeles', 'www.facebook.com/timlutz1', 'www.twitter.com/timlutztweets', 'www.google.com'),
(63, 63, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ' Daddy ,Muscle,Poz', 'White/Caucasian', '', '', '', '', '', '', '', '', '', '', '', '1963-01-10 00:00:00', '', '6 ft 1 inch  (185cm)', 185, '175 lbs  (79 kgs)', 175, '', '', '', '', '', '', '', '', 'You have the best friend to be here at work today for a good morning. I''m well chuffed but I''m sure he''ll have a nice profile picture for him and I would like that you would like it if he can be here soon I can tell him I can have him. ', 'Daddy Chaser,Muscle,Jock,Poz', 'Open Relationship', 'Los Angeles', 'www.facebook.com/timlutz1', 'www.twitter.com/timlutztweets', 'www.google.com'),
(64, 64, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ' Bear ,Bear Chaser, Daddy ,Daddy Chaser,Military', 'Asian', '', '', '', '', '', '', '', '', '', '', '', '1998-11-02 00:00:00', '', '4 ft   (122cm)', 122, '100 lbs  (45 kgs)', 100, '', '', '', '', '', '', '', '', '', 'Otter,Clean Cut,Rugged,Nudist,Discreet', 'Single', '', 'www.facebook.com/', 'www.twitter.com/', 'www.'),
(65, 65, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ' Daddy ,Muscle,Poz,Clean Cut', 'White/Caucasian', '', '', '', '', '', '', '', '', '', '', '', '1963-01-10 00:00:00', '', '6 ft 1 inch  (185cm)', 185, '175 lbs  (79 kgs)', 175, '', '', '', '', '', '', '', '', 'You have the same thing and then I''m not going on the app anymore I have a few things that need work for the rest of the weekend so I''m sure he''ll get it done at work now but I''ll have a lot to come pick out and get back into work for a good night and I''m not working out at the night and I just don''t have to go out there until I can see it if I''m going back home at the night before bed time for a yes or a day. ', 'Daddy Chaser,Muscle,Jock,Poz', 'Open Relationship', 'Los Angeles', 'www.facebook.com/timlutz1', 'www.twitter.com/timlutztweets', 'www.google.com'),
(66, 66, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ' Bear ,Bear Chaser, Daddy ,Daddy Chaser,Military', 'Asian', '', '', '', '', '', '', '', '', '', '', '', '1998-11-04 00:00:00', '', '4 ft   (122cm)', 122, '100 lbs  (45 kgs)', 100, '', '', '', '', '', '', '', '', '', 'Otter,Clean Cut,Rugged,Nudist,Discreet', 'Single', '', 'www.facebook.com/', 'www.twitter.com/', 'www.'),
(67, 67, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 'Transgender,Leather,Military', 'Pacific Islander', '', '', '', '', '', '', '', '', '', '', '', '1998-12-04 00:00:00', '', '5 ft   (152cm)', 152, '125 lbs  (57 kgs)', 125, '', '', '', '', '', '', '', '', '', 'Leather,Geek,Jock', 'Open Relationship', '', 'www.facebook.com/', 'www.twitter.com/', 'www.'),
(68, 68, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ' Bear ,Bear Chaser, Daddy ,Daddy Chaser,Military', 'Asian', '', '', '', '', '', '', '', '', '', '', '', '1998-12-06 00:00:00', '', '4 ft   (122cm)', 122, '100 lbs  (45 kgs)', 100, '', '', '', '', '', '', '', '', '', 'Otter,Clean Cut,Rugged,Nudist,Discreet', 'Single', '', 'www.facebook.com/', 'www.twitter.com/', 'www.'),
(69, 69, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ' Bear ,Bear Chaser, Daddy ,Daddy Chaser,Military', 'Asian', '', '', '', '', '', '', '', '', '', '', '', '1998-12-21 00:00:00', '', '4 ft   (122cm)', 122, '100 lbs  (45 kgs)', 100, '', '', '', '', '', '', '', '', '', ' Bear ,Bear Chaser, Daddy ,Daddy Chaser,Military', 'Single', '', 'www.facebook.com/', 'www.twitter.com/', 'www.'),
(70, 70, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', 'Twink,Transgender,College,Leather,Geek', 'Asian', '', '', '', '', '', '', '', '', '', '', '', '1998-12-21 00:00:00', '', '4 ft   (122cm)', 122, '100 lbs  (45 kgs)', 100, '', '', '', '', '', '', '', '', 'Carlos!!! Pnp!!! Fisting! You are the gorgeous girl you can have on your mind for you and your family you can tell me what I did and then I fell for it and I was just a living room and you staying up to date and you can tell you what are your thoughts and you can have it on the!', 'Twink,Transgender,College,Leather,Geek', 'Single', 'Los angejes ', 'www.facebook.com/', 'www.twitter.com/', 'www.'),
(71, 71, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ' Daddy ,Muscle,Poz', 'White/Caucasian', '', '', '', '', '', '', '', '', '', '', '', '1963-01-10 00:00:00', '', '6 ft 1 inch  (185cm)', 185, '175 lbs  (79 kgs)', 175, '', '', '', '', '', '', '', '', 'I''m not looking to be a perfect app for me a lot of work done on the show I just had the same time as the last time it is not working today at work at home now it''s just going on the next weekend so I''ll come home and take the rest of the week to see the rest of the week before Christmas morning. ', 'Daddy Chaser,Muscle,Jock,Poz,College', 'Open Relationship', 'Los Angeles, CA', 'www.facebook.com/timlutz1', 'www.twitter.com/timlutztweets', 'www.google.com'),
(72, 72, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ' Bear ,Bear Chaser, Daddy ,Daddy Chaser,Military', 'Asian', '', '', '', '', '', '', '', '', '', '', '', '1999-01-30 00:00:00', '', '4 ft   (122cm)', 122, '100 lbs  (45 kgs)', 100, '', '', '', '', '', '', '', '', '', 'Otter,Clean Cut,Rugged,Nudist,Discreet', 'Single', '', 'www.facebook.com/', 'www.twitter.com/', 'www.'),
(73, 73, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ' Bear ,Bear Chaser, Daddy ,Daddy Chaser,Military', 'Asian', '', '', '', '', '', '', '', '', '', '', '', '1999-01-31 00:00:00', '', '4 ft   (122cm)', 122, '100 lbs  (45 kgs)', 100, '', '', '', '', '', '', '', '', '', 'Otter,Clean Cut,Rugged,Nudist,Discreet', 'Single', '', 'www.facebook.com/', 'www.twitter.com/', 'www.'),
(74, 74, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', '', ' Bear ,Bear Chaser, Daddy ,Daddy Chaser,Military', 'Asian', '', '', '', '', '', '', '', '', '', '', '', '1999-02-01 00:00:00', '', '4 ft   (122cm)', 122, '100 lbs  (45 kgs)', 100, '', '', '', '', '', '', '', '', '', 'Otter,Clean Cut,Rugged,Nudist,Discreet', 'Single', '', 'www.facebook.com/', 'www.twitter.com/', 'www.');

-- --------------------------------------------------------

--
-- Table structure for table `profile_locks`
--

CREATE TABLE IF NOT EXISTS `profile_locks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `lock_user_id` int(11) NOT NULL,
  `is_locked` int(11) NOT NULL COMMENT '0=>default 1=> lock 2=> unlock',
  `count` int(11) NOT NULL COMMENT '0=>default 1=>lock(unread message count))',
  `browse` varchar(100) NOT NULL,
  `creation_date` datetime NOT NULL,
  `modification_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `profile_locks`
--

INSERT INTO `profile_locks` (`id`, `user_id`, `lock_user_id`, `is_locked`, `count`, `browse`, `creation_date`, `modification_date`) VALUES
(3, 1, 2, 1, 1, 'dating', '2016-05-07 07:07:14', '0000-00-00 00:00:00'),
(4, 51, 52, 1, 1, 'dating', '2016-06-27 00:24:04', '2016-06-27 00:59:03'),
(5, 52, 51, 2, 0, 'dating', '2016-06-27 00:44:29', '2016-06-27 00:54:37'),
(6, 1, 52, 1, 1, 'dating', '2016-06-27 05:41:42', '2016-06-27 05:47:32'),
(7, 3, 52, 2, 0, 'dating', '2016-06-27 05:49:17', '2016-06-27 05:49:20'),
(8, 53, 55, 1, 1, 'dating', '2016-07-20 01:01:22', '0000-00-00 00:00:00'),
(15, 55, 53, 1, 1, 'dating', '2016-08-05 09:18:24', '0000-00-00 00:00:00'),
(11, 2, 55, 1, 1, 'dating', '2016-07-29 10:40:32', '0000-00-00 00:00:00'),
(12, 3, 55, 1, 1, 'dating', '2016-07-29 10:42:48', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `recent_images`
--

CREATE TABLE IF NOT EXISTS `recent_images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `image` varchar(200) NOT NULL,
  `creation_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `remove_ads`
--

CREATE TABLE IF NOT EXISTS `remove_ads` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `month` int(11) DEFAULT '0',
  `price` decimal(10,2) DEFAULT '0.00',
  `creation_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `remove_ads`
--

INSERT INTO `remove_ads` (`id`, `month`, `price`, `creation_date`) VALUES
(3, 1, '15.00', '2015-11-19 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `share_albums`
--

CREATE TABLE IF NOT EXISTS `share_albums` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sender_id` int(11) NOT NULL COMMENT 'who send album',
  `receiver_id` int(11) NOT NULL COMMENT 'who receive album',
  `is_received` int(11) NOT NULL COMMENT '0=>default 1=>share 2=>unshare',
  `is_view` int(11) NOT NULL COMMENT '0=>yes 1=>no',
  `creation_date` datetime NOT NULL,
  `modification_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=61 ;

--
-- Dumping data for table `share_albums`
--

INSERT INTO `share_albums` (`id`, `sender_id`, `receiver_id`, `is_received`, `is_view`, `creation_date`, `modification_date`) VALUES
(1, 16, 6, 1, 0, '2016-02-05 16:15:50', '0000-00-00 00:00:00'),
(2, 16, 2, 1, 0, '2016-02-05 16:16:03', '0000-00-00 00:00:00'),
(3, 16, 3, 1, 0, '2016-02-05 16:16:13', '0000-00-00 00:00:00'),
(4, 16, 15, 1, 0, '2016-02-05 16:16:21', '0000-00-00 00:00:00'),
(5, 6, 16, 1, 0, '2016-02-05 16:16:55', '0000-00-00 00:00:00'),
(12, 1, 16, 1, 0, '2016-02-05 16:56:25', '0000-00-00 00:00:00'),
(11, 2, 16, 1, 0, '2016-02-05 16:51:49', '0000-00-00 00:00:00'),
(10, 12, 16, 1, 0, '2016-02-05 16:49:43', '0000-00-00 00:00:00'),
(54, 55, 53, 1, 0, '2016-07-31 19:10:29', '0000-00-00 00:00:00'),
(53, 3, 55, 2, 0, '2016-07-29 10:42:27', '0000-00-00 00:00:00'),
(52, 2, 55, 1, 0, '2016-07-29 10:09:12', '0000-00-00 00:00:00'),
(51, 1, 55, 1, 0, '2016-07-29 10:03:40', '0000-00-00 00:00:00'),
(50, 53, 55, 1, 0, '2016-07-20 01:01:27', '0000-00-00 00:00:00'),
(27, 7, 1, 1, 0, '2016-04-14 05:37:32', '0000-00-00 00:00:00'),
(28, 7, 2, 1, 0, '2016-04-14 07:03:43', '0000-00-00 00:00:00'),
(49, 3, 52, 2, 0, '2016-06-27 05:49:45', '0000-00-00 00:00:00'),
(48, 2, 52, 1, 0, '2016-06-27 05:45:28', '0000-00-00 00:00:00'),
(47, 1, 52, 1, 0, '2016-06-27 05:41:20', '0000-00-00 00:00:00'),
(36, 2, 3, 1, 0, '2016-05-07 06:11:40', '0000-00-00 00:00:00'),
(37, 2, 8, 1, 0, '2016-05-07 06:11:54', '0000-00-00 00:00:00'),
(38, 1, 2, 1, 0, '2016-05-07 07:06:45', '0000-00-00 00:00:00'),
(46, 51, 52, 1, 0, '2016-06-26 23:13:49', '0000-00-00 00:00:00'),
(45, 52, 2, 1, 0, '2016-06-26 23:01:40', '0000-00-00 00:00:00'),
(44, 52, 51, 1, 0, '2016-06-26 23:01:20', '0000-00-00 00:00:00'),
(55, 61, 62, 1, 0, '2016-09-25 20:03:39', '0000-00-00 00:00:00'),
(56, 65, 61, 2, 0, '2016-11-17 02:03:13', '0000-00-00 00:00:00'),
(57, 65, 63, 2, 0, '2016-11-20 18:12:02', '0000-00-00 00:00:00'),
(58, 3, 1, 2, 1, '2017-01-27 09:11:03', '0000-00-00 00:00:00'),
(59, 1, 3, 1, 0, '2017-01-06 06:20:47', '0000-00-00 00:00:00'),
(60, 3, 4, 2, 1, '2017-01-27 09:02:42', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `subscriptions`
--

CREATE TABLE IF NOT EXISTS `subscriptions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `month` int(11) DEFAULT '0',
  `price` decimal(10,2) DEFAULT '0.00',
  `creation_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `subscriptions`
--

INSERT INTO `subscriptions` (`id`, `month`, `price`, `creation_date`) VALUES
(1, 1, '10.99', '2015-11-19 00:00:00'),
(4, 3, '15.00', '2015-11-19 00:00:00'),
(3, 6, '45.00', '2015-11-19 00:00:00'),
(5, 12, '60.00', '2015-11-23 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tests`
--

CREATE TABLE IF NOT EXISTS `tests` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `message` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE IF NOT EXISTS `transactions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `nonce` varchar(255) NOT NULL,
  `transaction_id` varchar(255) NOT NULL,
  `payment_status` varchar(255) NOT NULL,
  `payment_type` varchar(255) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `currency` varchar(20) NOT NULL,
  `merchant_acc_id` varchar(255) NOT NULL,
  `customer_email` varchar(255) NOT NULL,
  `card_type` varchar(255) NOT NULL,
  `last4_digit` varchar(100) NOT NULL,
  `exp_month` varchar(100) NOT NULL,
  `exp_year` varchar(100) NOT NULL,
  `payment_for` int(11) NOT NULL COMMENT '0=>default 1=>subscription 2=>removeads',
  `created_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `trials`
--

CREATE TABLE IF NOT EXISTS `trials` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `month` int(11) NOT NULL,
  `creation_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `trials`
--

INSERT INTO `trials` (`id`, `month`, `creation_date`) VALUES
(1, 31, '2016-01-01 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `screen_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(120) DEFAULT '',
  `email` varchar(120) NOT NULL,
  `password` varchar(120) NOT NULL,
  `original_password` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `country` varchar(60) DEFAULT '',
  `city` varchar(60) DEFAULT '',
  `status` int(1) NOT NULL DEFAULT '0' COMMENT '0=>inactive 1=>active',
  `profile_status` int(11) NOT NULL COMMENT '0=>default 1=>public 2=>private',
  `online_status` int(11) NOT NULL COMMENT '0=>default 1=>online 2=>offline',
  `lat` varchar(100) NOT NULL COMMENT 'for search nearest members',
  `long` varchar(100) NOT NULL COMMENT 'for search nearest members',
  `profile_pic` varchar(60) DEFAULT '',
  `profile_pic_type` int(11) NOT NULL DEFAULT '0' COMMENT '0=>default 1=> face pic 2=> verified photo',
  `profile_pic_date` datetime NOT NULL COMMENT 'for verified pic calculation',
  `is_completed` int(1) NOT NULL DEFAULT '0' COMMENT '0-Not completed,1-Completed',
  `device_token` varchar(200) NOT NULL,
  `device_type` varchar(10) NOT NULL,
  `registration_status` int(11) NOT NULL COMMENT '0=> default 1=>register 2=>basic profile 3=>photo upload ',
  `accuracy` int(11) NOT NULL DEFAULT '0' COMMENT 'geo location accuricy send from ios and android',
  `member_type` int(11) NOT NULL COMMENT '0=>free 1=>paid',
  `valid_upto` datetime NOT NULL,
  `is_trial` int(11) NOT NULL COMMENT '0=>default(No) 1=>yes',
  `removead` int(11) NOT NULL COMMENT '0=>no 1=>yes',
  `removead_valid_upto` datetime NOT NULL,
  `creation_date` datetime NOT NULL,
  `modification_date` datetime NOT NULL,
  `profiletext_change` int(1) NOT NULL DEFAULT '0' COMMENT '0=approve/1=change',
  `profile_text_change_date` datetime NOT NULL,
  `photo_change` int(1) NOT NULL DEFAULT '0' COMMENT '0=approve/1=change',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=75 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `screen_name`, `token`, `email`, `password`, `original_password`, `country`, `city`, `status`, `profile_status`, `online_status`, `lat`, `long`, `profile_pic`, `profile_pic_type`, `profile_pic_date`, `is_completed`, `device_token`, `device_type`, `registration_status`, `accuracy`, `member_type`, `valid_upto`, `is_trial`, `removead`, `removead_valid_upto`, `creation_date`, `modification_date`, `profiletext_change`, `profile_text_change_date`, `photo_change`) VALUES
(1, 'Basu', 'ERL49', 'basu@gmail.com', '16a50adafb7a8ec789eaf3bdfaa060f76205a5ba', 'MTIzNDU2Nzg=', 'Ind', '', 0, 1, 1, '22.577362', '88.431844', '5864c5164341329122016081102.jpg', 0, '2016-12-29 08:08:21', 0, 'a3ccf1872ee1a5b32a8eb56f8e62de12a010d100425ca77d98b52e10cccae0ed', 'ios', 3, 65, 0, '2016-12-29 05:16:33', 0, 0, '0000-00-00 00:00:00', '2016-02-05 13:17:29', '2017-01-11 11:18:05', 1, '2016-12-29 09:20:07', 1),
(2, 'Joyth', 'CKUU1', 'joy@gmail.com', '16a50adafb7a8ec789eaf3bdfaa060f76205a5ba', 'MTIzNDU2Nzg=', 'Ind', '', 1, 1, 1, '22.577231', '88.431894', '574ff5cc35b5902062016090100.jpg', 0, '2016-06-02 09:01:00', 0, 'c85dead4301013427f13263a4688fb58879048e10a513444914fb69b1497a577', 'ios', 3, 78, 1, '2017-04-27 07:11:33', 0, 0, '0000-00-00 00:00:00', '2016-02-05 13:18:12', '2016-12-07 06:33:52', 1, '2016-12-28 11:54:00', 1),
(3, 'dhiraj', 'P6K2X', 'dhiraj@gmail.com', '16a50adafb7a8ec789eaf3bdfaa060f76205a5ba', 'MTIzNDU2Nzg=', 'Ind', '', 1, 1, 1, '22.577360', '88.431859', '586f77cb8a66606012017105611.jpg', 2, '2017-01-06 10:56:11', 0, '4fe7b1084847631e4794a9bb231d2b88d079c65de4cc1177ffcb6dffd2dc6854', 'ios', 3, 65, 1, '2017-06-15 13:20:34', 0, 0, '0000-00-00 00:00:00', '2016-02-05 13:35:17', '2017-01-27 09:14:44', 1, '2016-12-29 09:20:56', 1),
(4, 'Amlan', '3GNF5', 'amlam@gmail.com', '16a50adafb7a8ec789eaf3bdfaa060f76205a5ba', 'MTIzNDU2Nzg=', 'Ind', '', 1, 1, 1, '22.577231', '88.431894', '574fe6135818f02062016075355.jpg', 1, '2016-06-02 07:53:55', 0, 'c85dead4301013427f13263a4688fb58879048e10a513444914fb69b1497a577', 'ios', 3, 78, 0, '2016-07-14 00:00:00', 0, 0, '0000-00-00 00:00:00', '2016-02-05 13:37:01', '2016-07-20 15:53:07', 1, '2016-12-28 11:54:00', 0),
(5, 'Arijit', 'KXL6Q', 'arijit@g.com', '16a50adafb7a8ec789eaf3bdfaa060f76205a5ba', 'MTIzNDU2Nzg=', 'Ind', '', 1, 1, 1, '22.577231', '88.431894', '574fe7ea9f64302062016080146.jpg', 1, '2016-06-02 08:01:02', 0, 'c85dead4301013427f13263a4688fb58879048e10a513444914fb69b1497a577', 'ios', 3, 78, 1, '2016-08-17 05:19:52', 0, 0, '0000-00-00 00:00:00', '2016-02-05 14:00:58', '2016-07-20 15:51:42', 1, '2016-12-28 11:54:00', 0),
(6, 'Robin', 'OO3YD', 'robin@gmail.com', '16a50adafb7a8ec789eaf3bdfaa060f76205a5ba', 'MTIzNDU2Nzg=', 'Ind', '', 1, 1, 1, '22.577231', '88.431894', '574fe81232a1a02062016080226.jpg', 2, '2016-06-02 08:02:23', 0, 'c85dead4301013427f13263a4688fb58879048e10a513444914fb69b1497a577', 'ios', 3, 78, 0, '2016-07-11 08:20:25', 0, 0, '0000-00-00 00:00:00', '2016-02-05 14:04:40', '2016-07-20 15:50:31', 1, '2016-12-28 11:54:00', 1),
(7, 'Coco', 'NMO1C', 'coco@gmail.com', '16a50adafb7a8ec789eaf3bdfaa060f76205a5ba', 'MTIzNDU2Nzg=', 'Ind', '', 1, 1, 1, '22.577231', '88.431894', '574ff11576ac202062016084053.jpg', 1, '2016-06-02 08:40:53', 0, 'c85dead4301013427f13263a4688fb58879048e10a513444914fb69b1497a577', 'ios', 3, 78, 0, '2016-07-14 00:00:00', 0, 0, '0000-00-00 00:00:00', '2016-02-05 14:07:34', '2016-07-20 15:48:19', 0, '2016-12-28 11:54:00', 1),
(8, 'Bapan', '2GW5N', 'bapan@g.com', '16a50adafb7a8ec789eaf3bdfaa060f76205a5ba', 'MTIzNDU2Nzg=', 'Ind', '', 1, 1, 1, '22.577231', '88.431894', '574ff1c396c2002062016084347.jpg', 1, '2016-06-02 08:43:47', 0, 'c85dead4301013427f13263a4688fb58879048e10a513444914fb69b1497a577', 'ios', 3, 78, 1, '2016-07-21 00:00:00', 0, 0, '0000-00-00 00:00:00', '2016-02-05 14:10:20', '2016-07-20 15:47:12', 1, '2016-12-28 11:54:00', 1),
(9, 'Hiytg', '0QOLZ', 'hiy@g.com', '16a50adafb7a8ec789eaf3bdfaa060f76205a5ba', 'MTIzNDU2Nzg=', 'Ind', '', 1, 1, 1, '22.577231', '88.431894', '574ff1c0124b102062016084344.jpg', 0, '2016-06-02 08:43:44', 0, 'c85dead4301013427f13263a4688fb58879048e10a513444914fb69b1497a577', 'ios', 3, 78, 0, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', '2016-02-05 14:13:00', '2016-07-20 15:46:03', 1, '2016-12-28 11:54:00', 1),
(10, 'Vibotg', 'Z5AUG', 'vibo@g.com', '16a50adafb7a8ec789eaf3bdfaa060f76205a5ba', 'MTIzNDU2Nzg=', 'Ind', '', 1, 1, 1, '22.577231', '88.431894', '574ff28b594d702062016084707.jpg', 0, '2016-06-02 08:47:05', 0, 'c85dead4301013427f13263a4688fb58879048e10a513444914fb69b1497a577', 'ios', 3, 78, 0, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', '2016-02-05 14:15:32', '2016-07-20 15:44:56', 1, '2016-12-28 11:54:00', 1),
(11, 'Anirban', 'Z6X74', 'anirban@g.com', '16a50adafb7a8ec789eaf3bdfaa060f76205a5ba', 'MTIzNDU2Nzg=', 'Ind', '', 1, 1, 1, '22.577231', '88.431894', '574ff36237c0a02062016085042.jpg', 0, '2016-06-02 08:50:41', 0, 'c85dead4301013427f13263a4688fb58879048e10a513444914fb69b1497a577', 'ios', 3, 78, 0, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', '2016-02-05 14:18:07', '2016-07-20 15:43:22', 1, '2016-12-28 11:54:00', 0),
(12, 'Xoxots', 'IH6E7', 'xoxo@g.com', '16a50adafb7a8ec789eaf3bdfaa060f76205a5ba', 'MTIzNDU2Nzg=', 'Ind', '', 1, 1, 1, '22.577231', '88.431894', '574ff3d497d6002062016085236.jpg', 0, '2016-06-02 08:52:36', 0, 'c85dead4301013427f13263a4688fb58879048e10a513444914fb69b1497a577', 'ios', 3, 78, 1, '2016-12-29 11:27:28', 0, 0, '0000-00-00 00:00:00', '2016-02-05 14:23:29', '2016-12-21 12:10:49', 0, '2016-12-28 11:54:00', 0),
(13, 'Flicvg', 'S3M5N', 'flic@g.com', '16a50adafb7a8ec789eaf3bdfaa060f76205a5ba', 'MTIzNDU2Nzg=', 'Ind', '', 1, 1, 1, '22.577231', '88.431894', '574ff4461f30d02062016085430.jpg', 0, '2016-06-02 08:54:30', 0, 'c85dead4301013427f13263a4688fb58879048e10a513444914fb69b1497a577', 'ios', 3, 78, 1, '2017-01-25 10:24:40', 0, 0, '0000-00-00 00:00:00', '2016-02-05 14:25:46', '2016-12-07 06:29:47', 0, '2016-12-28 11:54:00', 0),
(14, 'Rtyiio', 'LQAXG', 'ert@g.com', '16a50adafb7a8ec789eaf3bdfaa060f76205a5ba', 'MTIzNDU2Nzg=', 'Ind', '', 1, 1, 1, '22.577231', '88.431894', '574ff4f80509b02062016085728.jpg', 0, '2016-06-02 08:57:27', 0, 'c85dead4301013427f13263a4688fb58879048e10a513444914fb69b1497a577', 'ios', 3, 78, 0, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', '2016-02-05 14:28:24', '2016-07-20 15:39:42', 0, '2016-12-28 11:54:00', 0),
(15, 'gutuiop', 'DLG4J', 'gutu@g.com', '16a50adafb7a8ec789eaf3bdfaa060f76205a5ba', 'MTIzNDU2Nzg=', 'Ind', '', 1, 1, 1, '22.577231', '88.431894', '574ff4f7018a302062016085727.jpg', 0, '2016-06-02 08:57:24', 0, 'c85dead4301013427f13263a4688fb58879048e10a513444914fb69b1497a577', 'ios', 3, 78, 0, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', '2016-02-05 14:29:05', '2016-07-20 15:38:42', 0, '2016-12-28 11:54:00', 0),
(16, 'Dhiraj', 'SKA0R', 'dhiraj.unified@gmail.com', '16a50adafb7a8ec789eaf3bdfaa060f76205a5ba', 'MTIzNDU2Nzg=', 'Ind', '', 1, 1, 1, '22.577214', '88.431846', '574ff349e194902062016085017.jpg', 2, '2016-06-02 08:49:36', 0, 'c85dead4301013427f13263a4688fb58879048e10a513444914fb69b1497a577', 'ios', 3, 65, 0, '2016-08-05 03:08:30', 0, 0, '0000-00-00 00:00:00', '2016-02-05 15:11:10', '2016-07-20 15:37:21', 0, '2016-12-28 11:54:00', 0),
(57, 'Carlos76a', 'OUDE3', 'carlos76a@yahoo.com', '9fc194f3b4728e135a90b708bd1e4956f9f90a89', 'b3B3aWprMTI=', 'Ind', '', 1, 1, 1, '34.089463', '-118.377441', '', 0, '0000-00-00 00:00:00', 0, 'fdbbb44f692e19d836d85b573e156df1686329f1ff4f61159a599deea317cd60', 'ios', 1, 10, 0, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', '2016-07-17 18:12:02', '2016-07-17 18:12:39', 0, '2016-12-28 11:54:00', 0),
(60, 'Niranjan', 'ZL4TL', 'niranjan@unifiedinfotech.net', '1e7ade410777a1c8ceddabca3b1a835d029b15d5', 'bmlyYW5qYW4wNQ==', 'Ind', '', 1, 1, 1, '37.785834', '-122.406417', '57cfdb1a6882607092016091714.jpg', 0, '2016-09-07 09:17:14', 0, 'c85dead4301013427f13263a4688fb58879048e10a513444914fb69b1497a577', 'ios', 3, 5, 0, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', '2016-09-07 09:15:27', '2016-09-07 11:39:16', 0, '2016-12-28 11:54:00', 0),
(56, 'Tim78', '1QOGT', '78@me.com', '16a50adafb7a8ec789eaf3bdfaa060f76205a5ba', 'MTIzNDU2Nzg=', 'Ind', '', 1, 1, 0, '34.089427', '-118.377494', '', 0, '0000-00-00 00:00:00', 0, 'fd6dfa3d88d19326e65f38ebedd7cb63742371e3b6afbaa092aea206e8f85bd2', 'ios', 1, 10, 0, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', '2016-07-17 18:10:45', '0000-00-00 00:00:00', 0, '2016-12-28 11:54:00', 0),
(55, 'Tim77', 'FA7TV', '77@me.com', '16a50adafb7a8ec789eaf3bdfaa060f76205a5ba', 'MTIzNDU2Nzg=', 'Ind', '', 1, 1, 1, '34.101839', '-118.352732', '578dc763e6dd319072016062331.jpg', 1, '2016-07-19 06:23:32', 0, 'fd6dfa3d88d19326e65f38ebedd7cb63742371e3b6afbaa092aea206e8f85bd2', 'ios', 3, 10, 1, '2016-09-10 00:00:00', 0, 0, '0000-00-00 00:00:00', '2016-07-17 18:10:20', '2016-09-10 07:18:04', 0, '2016-12-28 11:54:00', 0),
(54, 'Tim76', 'SG3I4', '76@me.com', '16a50adafb7a8ec789eaf3bdfaa060f76205a5ba', 'MTIzNDU2Nzg=', 'Ind', '', 1, 1, 1, '22.577257', '88.431872', '5789a5347f9bf16072016030836.jpg', 2, '2016-07-16 03:08:37', 0, '870c89ab8684541c30fd5f4556577ab4078f7c534b405eed0163b8562cc40ab8', 'ios', 3, 10, 0, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', '2016-07-16 03:00:49', '2016-07-22 08:02:35', 0, '2016-12-28 11:54:00', 0),
(53, 'Carlos76', '0PV6R', 'carlos76@yahoo.com', '9fc194f3b4728e135a90b708bd1e4956f9f90a89', 'b3B3aWprMTI=', 'Ind', '', 1, 1, 1, '34.089710', '-118.377455', '5789343ca976915072016190636.jpg', 1, '2016-07-15 19:06:37', 0, 'b9d765fdf3d8d235936b8185b8f1ec32f5ec78a1d4d8a301be7127466435b5ea', 'ios', 3, 10, 0, '2016-08-06 00:00:00', 0, 0, '0000-00-00 00:00:00', '2016-07-15 19:06:00', '2016-08-06 07:23:33', 0, '2016-12-28 11:54:00', 0),
(45, 'Carlos69C', 'OGZZ2', 'carlos69c@yahoo.com', '9fc194f3b4728e135a90b708bd1e4956f9f90a89', 'b3B3aWprMTI=', 'Ind', '', 1, 1, 1, '34.089611', '-118.377430', '57511e2a8c24b03062016060530.jpg', 1, '2016-06-03 06:05:30', 0, '31e63a03bff4a1810e5fa62666985dd66b59252bb6aa069372b6900cb1de06ca', 'ios', 3, 5, 1, '2016-06-05 00:00:00', 0, 0, '0000-00-00 00:00:00', '2016-06-03 06:04:54', '2016-06-05 16:54:57', 0, '2016-12-28 11:54:00', 0),
(46, 'Tim72', 'SCGM9', '72@me.com', '16a50adafb7a8ec789eaf3bdfaa060f76205a5ba', 'MTIzNDU2Nzg=', 'Ind', '', 1, 1, 1, '34.089449', '-118.377201', '5751217ce1af903062016061940.jpg', 1, '2016-06-03 06:19:40', 0, '887023985559ba5b6e3125f260208193d3ae596fb6a5c86ef4ec77ecc0870494', 'ios', 3, 10, 0, '2016-06-05 00:00:00', 0, 0, '0000-00-00 00:00:00', '2016-06-03 06:16:58', '2016-06-14 01:39:24', 0, '2016-12-28 11:54:00', 0),
(47, 'Carlos', 'AJ7ZK', 'carlos@gmail.com', '16a50adafb7a8ec789eaf3bdfaa060f76205a5ba', 'MTIzNDU2Nzg=', 'Ind', '', 1, 1, 1, '22.577231', '88.431894', '5751287c74bde03062016064932.jpg', 0, '2016-06-03 06:49:31', 0, 'c85dead4301013427f13263a4688fb58879048e10a513444914fb69b1497a577', 'ios', 3, 78, 0, '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', '2016-06-03 06:48:01', '2016-06-14 07:08:52', 0, '2016-12-28 11:54:00', 0),
(48, 'Carlos72', 'MG4ZS', 'carlos72@yahoo.com', '9fc194f3b4728e135a90b708bd1e4956f9f90a89', 'b3B3aWprMTI=', 'Ind', '', 1, 1, 1, '34.089486', '-118.377087', '575f6134f22f214062016014316.jpg', 1, '2016-06-14 01:43:17', 0, 'e3d7b3fdfd778283305f3334e213b371310a90f956d0be67dc891d2cab18ff0b', 'ios', 3, 30, 1, '2016-06-14 00:00:00', 0, 0, '0000-00-00 00:00:00', '2016-06-14 01:42:21', '2016-06-14 04:42:50', 0, '2016-12-28 11:54:00', 0),
(49, 'Tim73', 'IM575', '73@me.com', '16a50adafb7a8ec789eaf3bdfaa060f76205a5ba', 'MTIzNDU2Nzg=', 'Ind', '', 1, 1, 1, '33.538342', '-117.774537', '575f8336a32ce14062016040822.jpg', 1, '2016-06-14 04:08:23', 0, 'edc00c4065585d0e5fb676515d1055d94ef4393fa298b6926250197912c2a16b', 'ios', 3, 10, 1, '2016-06-19 00:00:00', 0, 0, '0000-00-00 00:00:00', '2016-06-14 04:05:54', '2016-06-19 22:24:41', 0, '2016-12-28 11:54:00', 0),
(50, 'Tim74', 'UT8Y1', '74@me.com', '16a50adafb7a8ec789eaf3bdfaa060f76205a5ba', 'MTIzNDU2Nzg=', 'Ind', '', 1, 1, 1, '34.089531', '-118.377331', '576a07b314d7b22062016033619.jpg', 1, '2016-06-22 03:36:20', 0, '52be7a81b8fa6bc06d568e8fb71a554315cabd41b2ac62a18aff02c596d61063', 'ios', 3, 10, 0, '2016-06-22 00:00:00', 0, 0, '0000-00-00 00:00:00', '2016-06-22 03:32:36', '2016-06-24 15:08:23', 0, '2016-12-28 11:54:00', 0),
(51, 'Carlos73', 'CUI37', 'carlos73@yahoo.com', '9fc194f3b4728e135a90b708bd1e4956f9f90a89', 'b3B3aWprMTI=', 'Ind', '', 1, 1, 1, '34.089697', '-118.377418', '576a07f17990522062016033721.jpg', 1, '2016-06-22 03:37:22', 0, 'acf7e819ff2861ac2ddecbe74e710013870a378306e2629e78b46fe86fc55a64', 'ios', 3, 10, 1, '2016-08-04 13:21:25', 0, 0, '0000-00-00 00:00:00', '2016-06-22 03:36:19', '2016-06-27 00:55:03', 0, '2016-12-28 11:54:00', 0),
(52, 'Tim75', 'FDL4V', '75@me.com', '16a50adafb7a8ec789eaf3bdfaa060f76205a5ba', 'MTIzNDU2Nzg=', 'Ind', '', 1, 1, 1, '22.577231', '88.431894', '576d4e9c7cc7a24062016151540.jpg', 1, '2016-06-24 15:15:41', 0, '7c5da79119aae2cea4289a6b64157a55ad6b040386ea5b5a61d1a748a8313fb3', 'ios', 3, 78, 1, '2016-09-01 07:18:25', 0, 0, '0000-00-00 00:00:00', '2016-06-24 15:13:33', '2016-07-15 09:30:01', 0, '2016-12-28 11:54:00', 0),
(61, 'Carlos77', 'NRH0C', 'carlos77@yahoo.com', '9fc194f3b4728e135a90b708bd1e4956f9f90a89', 'b3B3aWprMTI=', 'Ind', '', 1, 1, 1, '34.089500', '-118.377273', '57e7058f3b0ff24092016230031.jpg', 2, '2016-09-24 23:00:31', 0, '419ab90fdc2b644e9c97cf8e37494cd9b5c9e5c154382ea2c0cc59938ad9d9f6', 'ios', 3, 65, 1, '2016-10-12 14:32:27', 0, 0, '0000-00-00 00:00:00', '2016-09-24 22:59:54', '2016-10-10 09:53:16', 0, '2016-12-28 11:54:00', 0),
(62, 'Tim79', '7JAYR', '79@me.com', '16a50adafb7a8ec789eaf3bdfaa060f76205a5ba', 'MTIzNDU2Nzg=', 'Ind', '', 1, 1, 1, '22.576944', '88.431676', '57e82ad502c6925092016195149.jpg', 2, '2016-09-25 19:51:49', 0, '737f4a160be40069dabfee41a0f7788e31e474cdac151785c37b7b635d3531dc', 'ios', 3, 320, 0, '2016-10-13 16:23:34', 0, 0, '0000-00-00 00:00:00', '2016-09-25 19:42:12', '2016-12-21 14:42:57', 0, '2016-12-28 11:54:00', 0),
(63, 'Tim80', 'WAPX8', '80@me.com', '16a50adafb7a8ec789eaf3bdfaa060f76205a5ba', 'MTIzNDU2Nzg=', 'Ind', '', 1, 1, 1, '34.089513', '-118.377355', '581a8ba64363003112016005814.jpg', 1, '2016-11-03 00:58:14', 0, 'dc7a45188346fc43db6415a9513e0d72f9a03843fa2714ca42bac289b0d09f13', 'ios', 3, 10, 1, '2016-11-04 00:00:00', 1, 0, '0000-00-00 00:00:00', '2016-11-03 00:55:24', '2016-11-03 07:37:40', 0, '2016-12-28 11:54:00', 0),
(64, 'Carlos81', 'TGESC', 'carlos81@carlos.com', '9fc194f3b4728e135a90b708bd1e4956f9f90a89', 'b3B3aWprMTI=', 'Ind', '', 1, 1, 1, '34.089362', '-118.377177', '581a9c2e4936e03112016020846.jpg', 0, '2016-11-03 02:08:46', 0, '5e69a7fd1da5e2523e02ba9436b7a64b4e92ca2397614e3fb7ae81b05546b74a', 'ios', 3, 30, 1, '2016-11-04 00:00:00', 1, 0, '0000-00-00 00:00:00', '2016-11-03 02:08:05', '2016-11-03 06:27:09', 0, '2016-12-28 11:54:00', 0),
(65, 'Tim82', 'V1OGY', '81@me.com', '16a50adafb7a8ec789eaf3bdfaa060f76205a5ba', 'MTIzNDU2Nzg=', 'Ind', '', 1, 1, 1, '34.089367', '-118.377060', '581cde549453b04112016191532.jpg', 1, '2016-11-04 19:15:32', 0, '35b3e815904fd520a4c4d63401d89f6ec0c40e317de23c17e7595a0302b062af', 'ios', 3, 30, 1, '2016-11-23 11:20:23', 0, 0, '0000-00-00 00:00:00', '2016-11-04 19:11:47', '2016-11-21 08:36:17', 0, '2016-12-28 11:54:00', 0),
(66, 'Carlos82', '0ZMGV', 'carlos82@carlos.com', '9fc194f3b4728e135a90b708bd1e4956f9f90a89', 'b3B3aWprMTI=', 'Ind', '', 1, 1, 1, '34.089411', '-118.377399', '581d0376284b304112016215358.jpg', 0, '2016-11-04 21:53:58', 0, '', '', 3, 10, 1, '2016-11-05 00:00:00', 1, 0, '0000-00-00 00:00:00', '2016-11-04 21:52:38', '2016-11-04 21:52:38', 0, '2016-12-28 11:54:00', 0),
(67, 'Tim83', 'LLLO1', '82@me.com', '16a50adafb7a8ec789eaf3bdfaa060f76205a5ba', 'MTIzNDU2Nzg=', 'Ind', '', 1, 1, 1, '34.089419', '-118.377075', '585a98b07d13921122016145856.jpg', 1, '2016-12-21 14:58:52', 0, '6d45b181bd0cb038822f3d82c394956bc4d2e4c4990d6f8b352cf3be4a0ee8be', 'ios', 3, 65, 0, '2017-01-03 00:00:00', 0, 0, '0000-00-00 00:00:00', '2016-12-04 14:11:26', '2017-01-31 01:59:41', 0, '2016-12-28 11:54:00', 1),
(68, 'Carlos80', 'JE23V', 'ceb@ceb.com', '9fc194f3b4728e135a90b708bd1e4956f9f90a89', 'b3B3aWprMTI=', 'Ind', '', 1, 1, 1, '34.089337', '-118.377210', '58479a37b966507122016051223.jpg', 1, '2016-12-07 05:12:23', 0, '7a2e6c39dd73fcf928abcabebbc3cef243334f87a2cf57a058706950e61da389', 'ios', 3, 65, 1, '2017-01-07 00:00:00', 1, 0, '0000-00-00 00:00:00', '2016-12-07 05:11:44', '2016-12-07 06:47:19', 0, '2016-12-28 11:54:00', 0),
(69, 'Carlos2017', '8C2RN', 'me@varros.com', '138b9e1a39a67b4cfb25855ae25ef37b739630f2', 'Q2FybG9zMTI0', 'Ind', '', 1, 1, 1, '34.089565', '-118.377353', '585b7393b5bf222122016063251.jpg', 1, '2016-12-22 06:32:52', 0, '', '', 3, 10, 1, '2017-01-22 00:00:00', 1, 0, '0000-00-00 00:00:00', '2016-12-22 06:32:18', '2016-12-22 06:32:19', 1, '2016-12-28 11:54:00', 1),
(70, 'Carlos!!!', 'WZ30G', '1@2.com', '4876ece9e920c7deeaaff2e2ea974942d5a3e744', 'cXdlcnR5dWk=', 'Ind', '', 1, 1, 1, '34.089336', '-118.377081', '5861eaeb48dbc27122016041539.jpg', 1, '2016-12-27 04:15:38', 0, '74bec80f2b1cf2eb9311c424dd26ef5263ea950b36b8813cb44d21048540922b', 'ios', 3, 65, 1, '2017-01-22 00:00:00', 1, 0, '0000-00-00 00:00:00', '2016-12-22 06:44:18', '2016-12-27 11:23:29', 0, '2016-12-28 11:54:00', 1),
(71, 'Tim90', 'WF6ZW', 'tim90@me.com', '16a50adafb7a8ec789eaf3bdfaa060f76205a5ba', 'MTIzNDU2Nzg=', 'Ind', '', 1, 1, 1, '34.089600', '-118.377286', '588ff3143564331012017021444.jpg', 0, '2017-01-31 02:14:43', 0, 'ae016c1a8169a148b2d14f05d2fc70abebdd93b9af1941b271b120ec685dcc14', 'ios', 3, 10, 1, '2017-03-03 00:00:00', 1, 0, '0000-00-00 00:00:00', '2017-01-31 02:11:03', '2017-02-19 04:53:16', 1, '0000-00-00 00:00:00', 1),
(72, 'Carlos100', 'MAI51', 'carlos100@be.com', '9fc194f3b4728e135a90b708bd1e4956f9f90a89', 'b3B3aWprMTI=', 'Ind', '', 1, 1, 1, '34.089604', '-118.377330', '588ffa0f1a45a31012017024431.jpg', 1, '2017-01-31 02:44:30', 0, '', '', 3, 10, 1, '2017-03-03 00:00:00', 1, 0, '0000-00-00 00:00:00', '2017-01-31 02:43:50', '2017-01-31 02:43:50', 0, '0000-00-00 00:00:00', 0),
(73, 'Carlos99', 'TAHQH', 'ceb@ceb.be', '4876ece9e920c7deeaaff2e2ea974942d5a3e744', 'cXdlcnR5dWk=', 'Ind', '', 1, 1, 1, '34.089437', '-118.377216', '589149cde19dd01022017023701.jpg', 1, '2017-02-01 02:37:02', 0, '66e3b548fe3e670e58a90415cbe71942547afa54f26746d7c97b53bbd0e3a444', 'ios', 3, 65, 1, '2017-03-04 00:00:00', 1, 0, '0000-00-00 00:00:00', '2017-02-01 02:36:25', '2017-02-01 23:44:37', 0, '0000-00-00 00:00:00', 1),
(74, 'Carlos\\u270a\\ud83c\\udffc\\ud83d\\udca6\\ud83d\\udc37', '8H0DV', 'me@me.be', '4876ece9e920c7deeaaff2e2ea974942d5a3e744', 'cXdlcnR5dWk=', 'Ind', '', 1, 1, 1, '34.078891', '-118.313691', '5892754d9355a01022017235453.jpg', 1, '2017-02-01 23:54:53', 0, '8418751a9372a3044ebc4b68901aef70e0e8a9dad65cab3e3daa6c2ed2279979', 'ios', 3, 10, 1, '2017-03-04 00:00:00', 1, 0, '0000-00-00 00:00:00', '2017-02-01 23:54:12', '2017-02-12 23:32:41', 1, '0000-00-00 00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_albums`
--

CREATE TABLE IF NOT EXISTS `user_albums` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `photo_name` varchar(60) DEFAULT '',
  `file_type` int(1) NOT NULL DEFAULT '0' COMMENT '0=>image,1=>video',
  `caption` varchar(100) NOT NULL,
  `album_type` int(11) NOT NULL DEFAULT '4' COMMENT '4=>default 3=>verified',
  `creation_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=153 ;

--
-- Dumping data for table `user_albums`
--

INSERT INTO `user_albums` (`id`, `user_id`, `photo_name`, `file_type`, `caption`, `album_type`, `creation_date`) VALUES
(109, 16, '574ff3a40b58602062016085148.jpg', 0, '', 4, '2016-06-02 08:50:53'),
(108, 16, '574ff3840cc4002062016085116.jpg', 0, '', 4, '2016-06-02 08:50:21'),
(104, 5, '574fe8228c4b302062016080242.jpg', 0, '', 4, '2016-06-02 08:01:51'),
(113, 46, '57537fd50209a05062016012645.jpg', 0, '', 4, '2016-06-05 01:26:46'),
(110, 12, '574ff3f172b1202062016085305.jpg', 0, '', 4, '2016-06-02 08:53:03'),
(111, 12, '574ff3fb1dc7302062016085315.jpg', 0, '', 4, '2016-06-02 08:53:13'),
(114, 49, '575fa78e04bc914062016064326.jpg', 0, '', 4, '2016-06-14 06:43:25'),
(10, 1, '574fe2f6d615702062016074038.jpg', 0, '', 3, '2016-06-02 07:40:39'),
(139, 55, '579b5644c5fef29072016131236.jpg', 0, '', 4, '2016-07-29 13:12:37'),
(138, 55, '5799d27252c4828072016093754.jpg', 0, '', 4, '0000-00-00 00:00:00'),
(137, 55, '5799d2005572f28072016093600.jpg', 0, '', 4, '0000-00-00 00:00:00'),
(106, 7, '574ff1276ac8b02062016084111.jpg', 0, '', 4, '2016-06-02 08:41:11'),
(101, 4, '574fe65eb3e1402062016075510.jpg', 0, '', 4, '2016-06-02 07:55:11'),
(136, 55, '578edae8b83d020072016015904.jpg', 0, '', 4, '0000-00-00 00:00:00'),
(135, 55, '578edb3817be120072016020024.jpg', 0, '', 4, '0000-00-00 00:00:00'),
(134, 55, '578edaa29c2e420072016015754.jpg', 0, '', 4, '0000-00-00 00:00:00'),
(103, 4, '574fe66b61d4602062016075523.jpg', 0, '', 4, '2016-06-02 07:55:21'),
(107, 8, '574ff1dedd44702062016084414.jpg', 0, '', 4, '2016-06-02 08:44:14'),
(115, 52, '57705cd53d54226062016225309.jpg', 0, '', 3, '2016-06-26 22:53:10'),
(116, 52, '57705ce66d4aa26062016225326.jpg', 0, '', 4, '2016-06-26 22:53:27'),
(117, 52, '57705cedce66a26062016225333.jpg', 0, '', 4, '2016-06-26 22:53:34'),
(118, 52, '57705d0ec005026062016225406.jpg', 0, '', 4, '2016-06-26 22:54:06'),
(128, 53, '578ecd5929ba820072016010113.jpg', 0, '', 4, '2016-07-20 01:01:14'),
(129, 55, '57a81742336dc08082016052314.jpg', 0, '', 3, '2016-08-08 05:23:14'),
(121, 52, '57705d39caf6126062016225449.jpg', 0, '', 4, '2016-06-26 22:54:49'),
(105, 6, '574fe82b77d9f02062016080251.jpg', 0, '', 4, '2016-06-02 08:02:51'),
(122, 52, '57705d439b7f526062016225459.jpg', 0, '', 4, '2016-06-26 22:54:59'),
(126, 51, '5770618171c1b26062016231305.jpg', 0, '', 4, '2016-06-26 23:13:05'),
(127, 51, '577061978229626062016231327.jpg', 0, '', 4, '2016-06-26 23:13:27'),
(98, 2, '574fe30978dc502062016074057.jpg', 0, '', 4, '2016-06-02 07:40:04'),
(99, 2, '574fe31c68f7e02062016074116.jpg', 0, '', 4, '2016-06-02 07:40:26'),
(100, 1, '574fe31d3bb3302062016074117.jpg', 0, '', 4, '2016-06-02 07:41:14'),
(96, 2, '574fe2f70524902062016074039.jpg', 0, '', 4, '2016-06-02 07:39:50'),
(95, 1, '574fe2d9acfec02062016074009.jpg', 0, '', 4, '2016-06-02 07:40:10'),
(97, 1, '574fe304c739402062016074052.jpg', 0, '', 4, '2016-06-02 07:40:53'),
(140, 55, '579b564ea468c29072016131246.jpg', 0, '', 4, '2016-07-29 13:12:47'),
(141, 55, '579b5685c109829072016131341.jpg', 0, '', 4, '2016-07-29 13:13:42'),
(142, 55, '579b5697c12a829072016131359.jpg', 0, '', 4, '2016-07-29 13:13:56'),
(145, 61, '57e82d94218fb25092016200332.jpg', 0, '', 4, '2016-09-25 20:03:32'),
(146, 62, '57e9e39606e8f27092016031222.jpg', 0, '', 3, '2016-09-27 03:12:18'),
(149, 62, '57e9e3a7f368927092016031239.jpg', 0, '', 4, '0000-00-00 00:00:00'),
(148, 62, '57e9e3b82b82727092016031256.jpg', 0, '', 4, '2016-09-27 03:12:51'),
(150, 65, '582d0fabcdc3917112016020219.jpg', 0, '', 3, '2016-11-17 02:02:20'),
(151, 65, '582d0fb96b75417112016020233.jpg', 0, '', 4, '2016-11-17 02:02:33'),
(152, 3, '586f781f994c206012017105735.jpg', 0, '', 3, '2017-01-06 10:57:33');

-- --------------------------------------------------------

--
-- Table structure for table `user_lookdates`
--

CREATE TABLE IF NOT EXISTS `user_lookdates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `profile_name` varchar(100) NOT NULL,
  `my_traits` text NOT NULL,
  `his_traits` text NOT NULL,
  `my_interest` text NOT NULL,
  `my_physical_appearance` text NOT NULL,
  `his_physical_appearance` text NOT NULL,
  `my_sextual_preferences` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `his_sextual_preferences` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `my_social_habits` text NOT NULL,
  `his_social_habits` text NOT NULL,
  `is_active` int(11) NOT NULL COMMENT '0=>inactive 1=>active',
  `creation_date` datetime NOT NULL,
  `modification_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

--
-- Dumping data for table `user_lookdates`
--

INSERT INTO `user_lookdates` (`id`, `user_id`, `profile_name`, `my_traits`, `his_traits`, `my_interest`, `my_physical_appearance`, `his_physical_appearance`, `my_sextual_preferences`, `his_sextual_preferences`, `my_social_habits`, `his_social_habits`, `is_active`, `creation_date`, `modification_date`) VALUES
(5, 2, '', 'Career Driven,Family Oriented,Educated,Romantic,Passionate,Religious,Spiritual,Agnostic,Political,Independent,Energetic,Home Body,Serious,Organized,Perfectionist,Kind', 'Affectionate,Perfectionist,Analytical,Witty,Kind,Patient,Easy Going,Reliable,Compassionate,Creative,Charming,Funny,Goal Oriented,Ambitious', 'House Parties,Concerts,Gaming,Reading,Working Out,Traveling', 'Beard,Goatee,Mustache,Bald,Military/Crew,Blond Hair,Ginger Hair,Tattoos,Masculine,Assimilated,Black Eyes,Green Eyes,Gray Eyes,Toned,Large', 'Muscular,Slim,Stocky,Large,Average,Masculine,Assimilated,Softer/Fem,Buzzed,Long,Wavy,Military/Crew,Trimmed,Some Body Hair', 'Top,Versatile,Bottom,Average,Small,Cut,Uncut,On PrEP,Let\\''s Discuss,One on One,Anonymous,Sinner,Role Play,Toys,Fist⬆︎,Fist⬇︎,Bondage,Raunchy,WS⬇︎,Rimming⬇︎,Master,Kissing', 'Fist⬇︎,Bondage,Raunchy,Spanking⬇︎,Spanking⬆︎,Gear,Sinner,Oral⬇︎,Exhibitionist,On PrEP,Safe,Raw,Let\\''s Discuss,Top,Versatile,Bottom', 'Smoker ,Non Smoker,Social Smoker,Alcohol', 'Drug Tolerant,PNP,Social Smoker,Non Smoker', 1, '2016-05-02 05:02:18', '2016-09-26 07:28:51'),
(2, 1, '', 'Educated,Romantic,Passionate,Agnostic,Spiritual,Religious', 'Religious,Educated,Romantic,Passionate,Spiritual,Agnostic', 'Fashion,TV,Social Media,Art/Design,Sports,Bars,Clubs', 'Smooth,Trimmed,Hairy,Some Body Hair,Goatee,Clean Shaven', 'Smooth,Trimmed,Some Body Hair,Hairy,Goatee,Clean Shaven', 'Well Endowed,Average,Small,Cut,Uncut,On PrEP', 'Versatile,Well Endowed,Average,Small,Cut,Uncut', 'Smoker ,Non Smoker,Social Smoker,Alcohol,Weed', 'Smoker ,Non Smoker,Social Smoker,Alcohol,Weed', 1, '2016-02-15 09:36:36', '2016-09-27 06:03:11'),
(18, 12, '', 'Romantic,Confident,Independent,Ambitious,Affectionate,Funny,Creative,Charming,Compassionate,Easy Going,Reliable,Organized,Educated', 'Career Driven,Romantic,Confident,Independent,Ambitious,Energetic,Practical,Funny,Creative,Charming,Outgoing,Sincere,Compassionate,Easy Going,Reliable,Kind,Affectionate,Perfectionist,Organized', 'Music,Bars,Clubs,House Parties,Self Help,Volunteering,Fine Dining', 'Trimmed,Clean Shaven,Tattoos,Piercings,Masculine,Blue Eyes,Toned', 'Trimmed,Smooth,Clean Shaven,Piercings,Tattoos,Assimilated,Masculine,Blue Eyes,Green Eyes,Slim,Toned', 'Versatile,Well Endowed,Safe,One on One,Saint,Sinner,Role Play,Raunchy', 'Versatile,Well Endowed,Safe,One on One,Saint,Sinner,Role Play,Raunchy,Kinky', 'Smoker ,Alcohol', 'Smoker ,Alcohol', 1, '2016-07-28 10:31:24', '2016-07-29 15:01:28'),
(6, 3, '', 'Home Body,Toughtful,Perfectionist,Affectionate,Compassionate,Creative,Outgoing,Funny,Sincere,Charming', 'Career Driven,Family Oriented,Confident,Ambitious,Practical,Funny,Creative,Compassionate,Reliable,Witty,Perfectionist,Organized,Analytical,Serious', 'Reading,Working Out,Traveling,Cooking,Gardening,Self Help,Vegan,Dining Out,Children', 'Some Body Hair,Smooth,Trimmed,Goatee,Clean Shaven,Piercings,Tattoos,Masculine,Assimilated,Blue Eyes,Green Eyes,Gray Eyes,Muscular,Large,Toned', 'Bald,Military/Crew,Long,Wavy,Piercings,Tattoos,Ginger Hair,Blond Hair,Softer/Fem,Green Eyes,Black Eyes,Muscular,Blue Eyes,Large,Average', 'Exhibitionist,Verbal,Role Play,Toys,Fist⬆︎,Fist⬇︎,Bondage,Rough,Raunchy,Kinky,Spanking⬆︎,Spanking⬇︎,Gear', 'On PrEP,Safe,One on One,Couples,Anonymous,Groups,Underwear,Kissing,Master,Slave,Rimming⬆︎,Rimming⬇︎', 'Drug Tolerant,PNP,Weed,Alcohol', 'Drug Tolerant,PNP,Weed,Alcohol', 1, '2016-05-02 05:06:31', '2017-01-27 09:19:55'),
(7, 4, '', 'Confident,Independent,Ambitious,Energetic,Goal Oriented,Practical', 'Compassionate,Easy Going,Reliable,Witty,Kind,Patient,Affectionate', 'Music,Movies,Theater,Art/Design,TV,Clubs,Bars,House Parties,Working Out', 'Goatee,Clean Shaven,Bald,Military/Crew,Buzzed,Long', 'Blue Eyes,Softer/Fem,Assimilated,Piercings,Military/Crew,Clean Shaven,Scruffy,Black Hair,Blond Hair', 'Well Endowed,Average,Small,Cut,Uncut,Oral⬆︎,Exhibitionist,Verbal,Spanking⬆︎,Gear,WS⬆︎', 'On PrEP,Safe,Let\\''s Discuss,Raw,Saint,Sinner,Oral⬆︎,Oral⬇︎,Voyeur,Spanking⬆︎,Rough,Raunchy,Kinky,Spanking⬇︎,Kissing', 'Social Smoker,Alcohol,Weed', 'Smoker ,Non Smoker,Weed,Alcohol', 1, '2016-05-02 05:14:31', '2016-06-22 10:33:52'),
(16, 53, '', 'Career Driven,Family Oriented,Educated,Romantic,Passionate,Religious,Spiritual,Agnostic,Political,Confident', 'Serious,Home Body,Organized,Toughtful,Analytical,Perfectionist,Affectionate,Patient,Kind,Witty', 'Music,Movies,Theater,Sports,Art/Design,Fashion', 'Some Body Hair,Gray Hair,Beard,Bald,Piercings,Masculine,Blue Eyes,Muscular', 'Hairy,Clean Shaven,Wavy,Ginger Hair,Tattoos,Softer/Fem,Hazel Eyes,Toned', 'Top,Well Endowed,On PrEP,One on One,Saint', 'Bottom,Uncut,Let\\''s Discuss,Groups,Slave', 'Smoker ,Non Smoker,Social Smoker', 'Sober,Drug Tolerant,PNP', 1, '2016-07-15 19:09:09', '2016-08-05 14:57:37'),
(17, 55, '', 'Witty,Kind,Patient,Affectionate,Perfectionist,Funny,Political', 'Career Driven,Family Oriented,Educated,Serious,Home Body', 'Pets,Vegan,Music,Movies', 'Ginger Hair,Hazel Eyes,Softer/Fem', 'Some Body Hair,Masculine,Blue Eyes,Muscular,Toned', 'Bottom,Slave,Master,Groups', 'Top,Well Endowed,On PrEP,Couples', 'PNP,Drug Tolerant,Sober', 'Smoker ,Alcohol,Weed,PNP,Drug Tolerant,Sober', 1, '2016-07-19 16:37:24', '2016-09-10 07:22:27'),
(9, 5, '', 'Confident,Independent,Ambitious,Energetic,Goal Oriented,Practical,Easy Going,Reliable,Witty,Kind,Patient', 'Confident,Independent,Ambitious,Energetic,Goal Oriented,Perfectionist,Analytical,Toughtful,Organized,Home Body', 'House Parties,Concerts,Gaming,Traveling,Working Out,Reading,Cooking,Gardening', 'Beard,Goatee,Mustache,Scruffy,Clean Shaven,Piercings,Tattoos,Masculine,Assimilated,Blue Eyes,Green Eyes,Brown Eyes,Black Eyes', 'Blue Eyes,Green Eyes,Brown Eyes,Muscular,Large,Toned,Gray Hair,Blond Hair,Piercings,Masculine', 'Well Endowed,Average,Small,Cut,Uncut,On PrEP,Let\\''s Discuss', 'One on One,Couples,Anonymous,Groups,Sinner,Voyeur,Exhibitionist,Verbal', 'Alcohol,Weed,PNP', 'Drug Tolerant,PNP,Social Smoker,Smoker ', 1, '2016-05-02 05:19:13', '2016-07-04 07:15:42'),
(10, 6, '', 'Religious,Educated,Career Driven,Family Oriented,Romantic,Passionate,Spiritual,Agnostic,Political', 'Educated,Romantic,Spiritual,Political,Confident,Ambitious,Goal Oriented', 'Sports,Fashion,TV,Art/Design,Movies,Theater,Music,Social Media,Clubs,Dancing,Bars,House Parties,Concerts,Gaming', 'Some Body Hair,Smooth,Trimmed,Hairy,Beard,Goatee,Mustache,Scruffy,Clean Shaven,Bald,Military/Crew,Buzzed,Long,Wavy', 'Some Body Hair,Smooth,Trimmed,Hairy,Beard,Goatee,Mustache,Scruffy,Clean Shaven,Bald,Military/Crew,Buzzed,Long,Wavy', 'Top,Versatile,Bottom,Well Endowed,Average,Small,Cut,Uncut,On PrEP,Safe,Let\\''s Discuss,Raw', 'Top,Versatile,Bottom,Well Endowed,Average,Small,Cut,Uncut,On PrEP,Safe,Let\\''s Discuss,Raw', 'Smoker ,Non Smoker,Social Smoker,Alcohol', 'Smoker ,Non Smoker,Social Smoker,Alcohol', 1, '2016-05-02 05:23:30', '2016-06-22 10:36:40'),
(11, 7, '', 'Witty,Kind,Patient,Affectionate,Perfectionist,Analytical,Toughtful,Organized,Home Body,Serious', 'Career Driven,Family Oriented,Educated,Romantic,Passionate,Religious,Spiritual,Agnostic,Political,Confident,Independent', 'Indoor Activities,Outdoor Activities,Self Help,Volunteering,Dinner Parties,Comfort Food,Fashion,TV,Social Media,Bars,Clubs,Dancing', 'Beard,Goatee,Mustache,Scruffy,Clean Shaven,Piercings,Tattoos,Masculine,Assimilated,Softer/Fem,Blue Eyes,Green Eyes,Gray Eyes', 'Blue Eyes,Green Eyes,Gray Eyes,Brown Eyes,Black Eyes,Hazel Eyes,Muscular,Slim,Stocky,Large,Average,Toned', 'Top,Versatile,Bottom,Well Endowed,Average,Small,Cut,Uncut,On PrEP,Safe,Let\\''s Discuss,Raw', 'Average,Well Endowed,Top,Versatile,Bottom,Small,Cut,Uncut,On PrEP,Safe,Let\\''s Discuss,Raw,Saint,Sinner,Oral⬆︎,Oral⬇︎,Voyeur,Exhibitionist,Verbal,Toys,Fist⬆︎,Role Play', 'Smoker ,Non Smoker,Social Smoker,Alcohol,Weed', 'Non Smoker,Social Smoker,Alcohol,Weed', 1, '2016-05-02 05:30:20', '2016-06-22 10:38:10'),
(12, 8, '', 'Career Driven,Romantic,Spiritual,Political,Confident,Energetic,Practical,Funny,Creative,Compassionate,Reliable,Kind,Affectionate,Perfectionist,Toughtful,Serious', 'Career Driven,Romantic,Spiritual,Political,Confident,Energetic,Goal Oriented,Funny,Creative,Compassionate,Easy Going,Kind,Affectionate,Perfectionist,Toughtful,Serious', 'Movies,Sports,TV,Clubs,House Parties,Working Out,Cooking,Indoor Activities,Volunteering,Comfort Food,Dining Out,Children', 'Some Body Hair,Trimmed,Goatee,Clean Shaven,Military/Crew,Long,Black Hair,Ginger Hair,Piercings,Assimilated,Softer/Fem,Green Eyes,Black Eyes,Muscular,Large,Toned', 'Some Body Hair,Trimmed,Goatee,Clean Shaven,Military/Crew,Long,Black Hair,Ginger Hair,Piercings,Assimilated,Softer/Fem,Green Eyes,Black Eyes,Muscular,Large,Toned', 'Versatile,Well Endowed,Average,Uncut,On PrEP,Let\\''s Discuss,One on One,Anonymous', 'Versatile,Well Endowed,Average,Uncut,On PrEP,Let\\''s Discuss,One on One,Anonymous,Sinner,Raunchy,Spanking⬇︎,Spanking⬆︎,Gear,Underwear,Kissing', 'Smoker ,Non Smoker,Social Smoker,Alcohol,Weed', 'Social Smoker,Alcohol,Weed,PNP,Drug Tolerant', 1, '2016-05-02 05:34:21', '2016-06-22 10:39:24'),
(14, 51, '', 'Career Driven,Family Oriented,Educated,Romantic,Passionate,Religious,Spiritual,Agnostic,Political,Confident', 'Serious,Home Body,Organized,Toughtful,Analytical,Perfectionist,Affectionate,Patient,Kind,Witty', 'Music,Movies,Theater,Sports,Art/Design,Fashion', 'Some Body Hair,Beard,Bald,Piercings,Masculine,Blue Eyes,Muscular', 'Clean Shaven,Hairy,Ginger Hair,Tattoos,Softer/Fem,Hazel Eyes,Toned', 'Well Endowed,On PrEP,One on One,Saint,Bottom', 'Bottom,Uncut,Let\\''s Discuss,Groups,Slave', 'Smoker ,Alcohol,PNP', 'Sober,Weed,Non Smoker', 1, '2016-06-25 05:20:22', '2016-06-27 00:58:23'),
(15, 52, '', 'Career Driven,Passionate,Confident,Independent,Ambitious,Goal Oriented,Practical,Sincere,Compassionate,Easy Going,Reliable,Kind,Perfectionist,Analytical,Organized,Home Body,Serious', 'Family Oriented,Educated,Romantic,Confident,Independent,Funny,Outgoing,Compassionate,Reliable,Kind,Affectionate,Spiritual,Sincere', 'Movies,Art/Design,TV,Working Out,Traveling,Self Help,Comfort Food,Pets', 'Some Body Hair,Goatee,Military/Crew,Masculine,Blue Eyes,Muscular', 'Muscular,Average,Toned,Masculine,Brown Hair,Black Hair,Some Body Hair', 'Versatile,Well Endowed,Average,On PrEP,One on One,Raw,Couples,Sinner,Oral⬇︎,Exhibitionist,Verbal,Role Play,Kinky,Underwear,Gear,WS⬆︎,WS⬇︎,Kissing,Rimming⬇︎,Rimming⬆︎', 'Top,Versatile,Bottom,Well Endowed,Average,On PrEP,Raw,One on One,Couples,Oral⬆︎', 'Smoker ,Drug Tolerant,Social Smoker', 'Drug Tolerant,Alcohol,Smoker ', 1, '2016-06-25 05:23:29', '2016-07-15 09:33:35'),
(19, 13, '', 'Career Driven,Romantic,Confident,Independent,Ambitious,Energetic', 'Career Driven,Educated,Romantic,Spiritual,Confident,Independent,Ambitious', 'Music,Social Media,Bars,Clubs,Working Out', 'Trimmed,Clean Shaven,Long', 'Trimmed,Clean Shaven,Long', 'Well Endowed,Versatile,Safe', 'Versatile,Well Endowed,Let\\''s Discuss', 'Smoker ,Alcohol', 'Smoker ,Alcohol', 1, '2016-07-28 10:37:14', '2016-09-02 06:18:42'),
(20, 62, '', 'Family Oriented,Career Driven,Romantic,Political,Confident', 'Political,Spiritual,Educated,Religious', 'TV,Social Media,Art/Design,Fashion,Clubs', 'Goatee,Mustache,Trimmed,Clean Shaven', 'Military/Crew,Clean Shaven,Goatee', 'Uncut,Small,Versatile,Let\\''s Discuss,On PrEP', 'Uncut,Versatile,Safe,On PrEP', 'PNP,Weed,Alcohol', 'Alcohol,Social Smoker,Non Smoker', 1, '2016-09-26 07:04:31', '2016-09-28 00:33:46'),
(21, 61, '', 'Career Driven,Family Oriented,Educated,Romantic,Passionate,Religious,Spiritual,Agnostic,Political,Confident', 'Serious,Home Body,Organized,Toughtful,Analytical,Perfectionist,Affectionate,Patient,Kind,Witty', 'Music,Movies,Theater,Art/Design,Sports,Fashion', 'Some Body Hair,Beard,Bald,Gray Hair,Piercings,Masculine,Blue Eyes,Muscular', 'Hairy,Clean Shaven,Wavy,Ginger Hair,Tattoos,Softer/Fem,Hazel Eyes,Toned', 'Top,Well Endowed,On PrEP,One on One,Saint', 'Bottom,Uncut,Let\\''s Discuss,Groups,Slave', 'Smoker ,Alcohol,PNP', 'Sober,PNP,Alcohol', 1, '2016-09-26 07:37:12', '2016-09-26 08:16:27'),
(22, 63, '', 'Career Driven,Family Oriented,Educated,Romantic,Passionate,Spiritual,Agnostic,Political,Religious', 'Career Driven,Family Oriented,Educated,Romantic,Passionate,Spiritual,Religious,Agnostic,Political', 'Music,Movies,Art/Design,Theater,Sports,TV,Fashion,Social Media', 'Some Body Hair,Goatee,Military/Crew,Masculine,Blue Eyes,Muscular', 'Masculine,Muscular,Average,Toned', 'Top,Well Endowed,Uncut,On PrEP,Safe,Let\\''s Discuss,Anonymous,One on One', 'Uncut,Small,Well Endowed,Versatile,On PrEP', 'Weed,Social Smoker,PNP', 'Weed,Alcohol,Social Smoker,Non Smoker', 1, '2016-11-03 01:08:23', '2016-11-03 04:19:38'),
(23, 64, '', 'Career Driven,Family Oriented,Educated,Romantic,Passionate,Religious,Spiritual,Agnostic,Political,Confident', 'Serious,Home Body,Toughtful,Organized,Analytical,Perfectionist,Affectionate,Patient,Kind,Witty', 'Music,Movies,Theater,Sports,Art/Design,Fashion', 'Some Body Hair,Beard,Bald,Gray Hair,Piercings,Masculine,Blue Eyes,Muscular', 'Hairy,Clean Shaven,Ginger Hair,Wavy,Tattoos,Softer/Fem,Hazel Eyes,Toned', 'Top,Well Endowed,On PrEP,One on One,Saint', 'Bottom,Uncut,Let\\''s Discuss,Groups,Slave', 'Smoker ,Alcohol,PNP', 'Non Smoker,Alcohol,Sober', 1, '2016-11-03 02:12:22', '0000-00-00 00:00:00'),
(24, 65, '', 'Witty,Kind,Patient,Affectionate,Perfectionist,Funny,Political', 'Career Driven,Family Oriented,Educated,Home Body,Serious', 'Music,Movies,Pets,Vegan', 'Ginger Hair,Hazel Eyes,Softer/Fem', 'Some Body Hair,Masculine,Blue Eyes,Muscular,Toned', 'Bottom,Well Endowed,On PrEP,Couples', 'Top,Well Endowed,On PrEP,Couples', 'PNP,Drug Tolerant,Sober', 'Smoker ,Alcohol,Weed,PNP,Drug Tolerant,Sober', 1, '2016-11-04 19:34:27', '2016-11-20 22:11:04'),
(25, 66, '', 'Career Driven,Family Oriented,Educated,Romantic,Passionate,Religious,Spiritual,Agnostic,Political', 'Serious,Home Body,Toughtful,Organized,Analytical,Perfectionist,Affectionate,Kind,Patient,Witty', 'Music,Movies,Theater,Sports,Art/Design,Fashion', 'Blue Eyes,Muscular', 'Hairy,Clean Shaven,Wavy,Tattoos,Ginger Hair,Softer/Fem,Hazel Eyes,Toned', 'Top,Well Endowed,On PrEP,One on One,Saint', 'Bottom,Uncut,Let\\''s Discuss,Groups,Slave', 'Smoker ,Non Smoker,Social Smoker', 'PNP,Drug Tolerant,Sober', 1, '2016-11-04 21:56:12', '0000-00-00 00:00:00'),
(26, 67, '', 'Family Oriented', 'Independent', 'Concerts,Clubs', 'Clean Shaven,Goatee,Trimmed', 'Clean Shaven,Goatee,Beard', 'Uncut,Versatile', 'Cut,Well Endowed', 'Alcohol,Social Smoker', 'Social Smoker,Alcohol', 1, '2016-12-06 06:13:30', '2016-12-27 06:09:01'),
(27, 68, '', 'Religious,Political,Energetic,Ambitious,Agnostic', 'Political', 'Clubs,TV,Social Media,Art/Design,Sports', 'Military/Crew', 'Clean Shaven', 'Uncut', 'Let\\''s Discuss', 'PNP', 'PNP', 1, '2016-12-07 06:47:52', '0000-00-00 00:00:00'),
(28, 71, '', 'Career Driven,Family Oriented,Romantic,Educated,Passionate,Religious,Agnostic,Spiritual,Political', 'Educated,Romantic,Agnostic,Religious,Passionate,Spiritual,Political,Confident,Independent,Ambitious', 'Music,Movies,Sports,TV,Art/Design,Theater,Fashion,Social Media', 'Some Body Hair,Goatee,Military/Crew,Masculine,Blue Eyes,Muscular', 'Masculine,Muscular,Toned,Average', 'Versatile,Well Endowed,Raw,One on One,Oral⬆︎,Exhibitionist,Role Play,Kissing', 'Versatile,Well Endowed,Average,Small,On PrEP,Safe,Let\\''s Discuss', 'Social Smoker,Alcohol,Drug Tolerant', 'Weed,Drug Tolerant,Sober', 1, '2017-01-31 02:24:12', '2017-02-19 04:58:13');

-- --------------------------------------------------------

--
-- Table structure for table `user_looksexes`
--

CREATE TABLE IF NOT EXISTS `user_looksexes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `profile_name` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `my_physical_appearance` text NOT NULL,
  `his_physical_appearance` text NOT NULL,
  `my_sextual_preferences` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `his_sextual_preferences` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `my_social_habits` text NOT NULL,
  `his_social_habits` text NOT NULL,
  `start_time` datetime NOT NULL,
  `end_time` datetime NOT NULL,
  `duration` varchar(250) NOT NULL,
  `notification_time` datetime NOT NULL,
  `is_active` int(11) NOT NULL COMMENT '0=>inactive 1=>active',
  `is_notify` int(1) NOT NULL DEFAULT '0' COMMENT '0=>default,1=>sent notification',
  `creation_date` datetime NOT NULL,
  `modification_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=38 ;

--
-- Dumping data for table `user_looksexes`
--

INSERT INTO `user_looksexes` (`id`, `user_id`, `profile_name`, `description`, `my_physical_appearance`, `his_physical_appearance`, `my_sextual_preferences`, `his_sextual_preferences`, `my_social_habits`, `his_social_habits`, `start_time`, `end_time`, `duration`, `notification_time`, `is_active`, `is_notify`, `creation_date`, `modification_date`) VALUES
(5, 16, 'Test 1', '', 'Some Body Hair,Smooth,Trimmed,Hairy,Mustache,Goatee', 'Goatee,Mustache,Clean Shaven,Trimmed,Hairy,Some Body Hair', 'Well Endowed,Versatile,Bottom,Small,Cut,Uncut,Average', 'Well Endowed,Versatile,Bottom,Small,Cut,Uncut,Average', 'Smoker ,Non Smoker,Social Smoker,Alcohol', 'Alcohol,Social Smoker,Non Smoker,Smoker ', '2016-05-27 13:13:47', '2017-01-02 09:59:56', '30 minutes', '2016-05-27 13:33:47', 1, 0, '2016-05-27 12:08:00', '2016-05-27 13:13:48'),
(2, 1, 'dfy', '', 'Some Body Hair,Trimmed,Goatee,Clean Shaven,Mustache,Scruffy,Military/Crew', 'Goatee,Clean Shaven,Scruffy,Mustache,Trimmed,Some Body Hair,Military/Crew', 'Versatile,Well Endowed,Average,Small,Uncut,Safe,Let\\''s Discuss', 'Versatile,Average,Well Endowed,Uncut,Small,Safe,On PrEP,Let\\''s Discuss', 'Smoker ,Non Smoker,Social Smoker,Alcohol,Weed,PNP', 'Smoker ,Non Smoker,Social Smoker,Alcohol,Weed,PNP', '2016-12-07 06:32:51', '2017-01-02 07:10:39', '1 hour', '2016-12-07 07:22:51', 1, 0, '2016-02-15 12:18:50', '2016-12-07 06:32:51'),
(3, 1, 'tyu', '', 'Beard,Goatee,Mustache,Clean Shaven,Scruffy,Trimmed', 'Beard,Mustache,Clean Shaven,Goatee,Scruffy,Military/Crew', 'Average,Well Endowed,Small,Uncut,Cut,Safe,On PrEP', 'Average,Well Endowed,Small,Cut,Uncut,On PrEP,Let\\''s Discuss', 'Smoker ,Non Smoker,Social Smoker', 'Smoker ,Non Smoker,Social Smoker', '2016-05-17 11:01:36', '2017-01-02 07:10:39', '30 minutes', '2016-05-17 11:21:36', 0, 0, '2016-02-15 12:20:54', '2016-05-17 11:01:49'),
(4, 1, 'sumarsi', '', 'Goatee,Green Eyes,Toned,Slim', 'Scruffy,Piercings,Assimilated,Softer/Fem,Hazel Eyes,Blue Eyes,Slim,Toned', 'Well Endowed', 'Uncut', 'Social Smoker', 'PNP', '2016-09-01 15:54:46', '2017-01-02 07:10:39', '4 hours', '2016-09-01 19:44:46', 0, 0, '2016-05-16 14:06:19', '2016-09-01 15:54:44'),
(6, 2, 'zxc', 'estetw', 'Some Body Hair,Smooth,Trimmed,Hairy,Mustache', 'Some Body Hair,Smooth,Trimmed,Hairy,Mustache', 'Versatile,Well Endowed,On PrEP', 'Versatile,Well Endowed,On PrEP', 'Weed,Alcohol', 'Smoker ,Non Smoker', '2016-12-07 06:38:14', '2016-12-07 07:38:14', '1 hour', '2016-12-07 07:28:14', 1, 0, '2016-05-27 12:42:47', '2016-12-07 06:38:14'),
(7, 3, 'abc', 'dhrydr', 'Some Body Hair,Trimmed,Goatee,Clean Shaven,Military/Crew', 'Some Body Hair,Trimmed,Goatee,Clean Shaven,Military/Crew', 'Versatile,Well Endowed,On PrEP', 'Versatile,Well Endowed,Safe,On PrEP', 'Non Smoker,Social Smoker,Alcohol', 'Social Smoker,Alcohol,Weed', '2017-01-02 09:37:35', '2017-01-02 09:40:22', '30 minutes', '2017-01-02 09:57:35', 1, 0, '2016-05-27 12:44:48', '2017-01-02 09:37:35'),
(8, 5, 'qwe', 'errert', 'Trimmed,Some Body Hair,Hairy,Mustache,Goatee', 'Some Body Hair,Trimmed,Smooth,Goatee', 'Versatile,Well Endowed,On PrEP,Let\\''s Discuss', 'Versatile,Well Endowed,Small,Safe,Let\\''s Discuss', 'Non Smoker,Social Smoker,Alcohol', 'Drug Tolerant,PNP,Weed', '2016-05-27 12:46:21', '2016-05-27 15:46:21', '3 hours', '2016-05-27 15:36:21', 1, 0, '2016-05-27 12:46:35', '0000-00-00 00:00:00'),
(9, 6, 'asd', 'waewq', 'Some Body Hair,Trimmed,Goatee,Clean Shaven,Military/Crew', 'Some Body Hair,Trimmed,Goatee,Clean Shaven,Military/Crew', 'Versatile,Well Endowed,Small,On PrEP,Let\\''s Discuss', 'Versatile,Well Endowed,On PrEP', 'Smoker ,Non Smoker,Alcohol', 'PNP,Weed,Alcohol', '2016-05-27 12:58:30', '2016-07-20 11:06:50', '3 hours', '2016-05-27 15:48:30', 1, 0, '2016-05-27 12:58:42', '0000-00-00 00:00:00'),
(10, 52, 'test 1', 'The fact I can see it in your face and I don\\''t have any idea what I do is go home now and I\\''m still waiting on a Saturday afternoon to get my nails and I love my life I live on your face in your eyes on my way home and watch it with my family and friends. ', 'Goatee', 'Clean Shaven', 'Uncut', 'Uncut', 'Weed', 'Drug Tolerant', '2016-06-25 22:03:24', '2016-06-25 22:07:01', '30 minutes', '2016-06-25 22:23:24', 0, 0, '2016-06-25 22:03:39', '0000-00-00 00:00:00'),
(11, 52, 'tom ', 'Hot', 'Hairy,Goatee,Blue Eyes,Masculine', 'Goatee,Military/Crew', 'Well Endowed,Versatile,Let\\''s Discuss', 'Uncut,Small', 'PNP', 'PNP', '2016-07-13 11:53:20', '2016-07-13 12:53:20', '1 hour', '2016-07-13 12:43:20', 0, 0, '2016-07-13 11:53:28', '0000-00-00 00:00:00'),
(12, 52, 't', '', 'Military/Crew,Long', 'Long,Slim', 'Well Endowed,Let\\''s Discuss,Groups,Spanking⬇︎', 'Well Endowed', 'Alcohol,Weed,PNP,Social Smoker,Drug Tolerant,Sober', 'Alcohol,Weed,Drug Tolerant', '2016-07-15 09:32:34', '2016-07-15 11:02:34', '1 hour and 30 minutes', '2016-07-15 10:52:34', 1, 0, '2016-07-15 09:32:43', '0000-00-00 00:00:00'),
(13, 53, 'Test', '', 'Some Body Hair,Beard,Bald,Black Hair,Piercings,Masculine,Blue Eyes,Muscular', 'Clean Shaven,Hairy,Wavy,Ginger Hair,Tattoos,Softer/Fem,Hazel Eyes,Toned', 'Top,Well Endowed,On PrEP,One on One,Saint', 'Bottom,Uncut,Let\\''s Discuss,Groups,Slave', 'Smoker ,Non Smoker,Social Smoker', 'Sober,Drug Tolerant,PNP', '2016-08-06 05:40:12', '2016-08-08 05:07:22', '4 hours', '2016-08-06 09:30:12', 1, 0, '2016-07-23 04:10:14', '2016-08-06 05:40:12'),
(14, 55, 'test 1', 'This\\''ll make a new song and it was not immediately available from the beginning of the year. The best way of saying it is the most recent version and the rest of the year before that the government of national intelligence officials have not yet but the only way you want a boyfriend is so good I don\\''t have the right way too many of these people. ', 'Goatee,Military/Crew,Masculine,Blue Eyes,Muscular,Trimmed,Mustache', 'Some Body Hair,Scruffy,Goatee,Military/Crew,Tattoos,Masculine,Muscular', 'Versatile,Well Endowed,Raw,One on One,Couples,Anonymous,Kissing,Exhibitionist,Verbal,Sinner,Role Play,Toys,Rough,Kinky,Underwear,Gear,Spanking⬇︎,Spanking⬆︎,WS⬆︎,WS⬇︎,Rimming⬆︎,Rimming⬇︎,Slave', 'Top,Versatile,Well Endowed,Average,Raw,On PrEP,Let\\''s Discuss,One on One,Couples,Anonymous,Sinner,Oral⬆︎,Oral⬇︎,Voyeur,Exhibitionist,Verbal,Role Play,Toys,Rough,Kinky,Spanking⬆︎,Spanking⬇︎,Underwear,Gear,WS⬆︎,WS⬇︎,Kissing,Rimming⬆︎,Rimming⬇︎,Master', 'Smoker ,Alcohol,PNP,Drug Tolerant,Sober', 'Alcohol,PNP,Drug Tolerant', '2016-08-05 04:21:33', '2016-09-10 07:17:46', '2 hours', '2016-08-05 06:11:33', 0, 0, '2016-07-25 02:09:33', '2016-08-05 04:21:32'),
(15, 13, 'My Preference', 'Dev Test', 'Smooth,Bald,Brown Eyes,Muscular,Piercings,Mustache', 'Smooth,Beard,Bald,Piercings,Masculine,Blue Eyes,Muscular', 'Versatile,Well Endowed,Safe,One on One,Saint,Role Play', 'Versatile,Well Endowed,Safe,One on One,Saint', 'Smoker ,Alcohol', 'Smoker ,Alcohol', '2016-12-07 06:31:19', '2016-12-07 07:31:19', '1 hour', '2016-12-07 07:21:19', 1, 0, '2016-07-28 10:10:26', '2016-12-07 06:31:19'),
(16, 12, 'My Preference', '', 'Trimmed,Smooth,Clean Shaven,Piercings,Tattoos,Assimilated,Softer/Fem,Blue Eyes,Green Eyes,Slim,Toned', 'Trimmed,Smooth,Clean Shaven,Goatee,Long,Piercings,Tattoos,Assimilated,Softer/Fem,Blue Eyes,Green Eyes,Slim,Toned', 'Versatile,Well Endowed,Safe,One on One,Saint,Role Play,Raunchy', 'Versatile,Well Endowed,Safe,One on One,Saint,Sinner,Role Play,Raunchy', 'Smoker ,Alcohol', 'Smoker ,Alcohol', '2016-12-07 06:43:45', '2016-12-07 07:43:45', '1 hour', '2016-12-07 07:33:45', 1, 0, '2016-07-28 10:23:46', '2016-12-07 06:43:45'),
(17, 55, 'test 2', '2', 'Scruffy', 'Clean Shaven', 'Uncut', 'Uncut', 'PNP', 'Social Smoker', '2016-07-31 02:51:53', '2016-09-10 07:17:46', '30 minutes', '2016-07-31 03:11:53', 0, 0, '2016-07-29 21:44:23', '2016-07-31 02:51:52'),
(18, 55, 'another', 'Another\\" profile. Testing. ', 'Military/Crew,Some Body Hair,Goatee,Masculine', 'Military/Crew,Smooth,Scruffy,Brown Hair,Tattoos,Toned', 'Uncut,Versatile,Well Endowed,Raw,Sinner,Kinky,Gear', 'Safe,Top,Average,Groups,Toys,Slave', 'PNP,Smoker ,Drug Tolerant', 'Alcohol,Social Smoker,Weed', '2016-08-06 05:34:23', '2016-09-10 07:17:46', '4 hours', '2016-08-06 09:24:23', 0, 0, '2016-07-29 22:15:28', '2016-08-06 05:34:23'),
(19, 55, 'top ', '', 'Some Body Hair,Goatee,Military/Crew,Masculine,Blue Eyes,Muscular', 'Smooth,Clean Shaven,Masculine', 'Versatile,Well Endowed,Small,Master', 'Uncut,On PrEP,Well Endowed', 'Weed', 'Alcohol,Sober', '2016-08-08 05:10:05', '2016-09-10 07:17:46', '4 hours', '2016-08-08 09:00:05', 0, 0, '2016-08-08 05:10:14', '0000-00-00 00:00:00'),
(25, 55, 'vers2', '', 'Some Body Hair,Goatee,Military/Crew,Masculine,Blue Eyes,Muscular', 'Some Body Hair,Beard,Military/Crew,Masculine', 'Versatile,Well Endowed,Average,On PrEP,Raw,One on One,Voyeur,Role Play', 'Uncut,Well Endowed,Safe,On PrEP,Let\\''s Discuss', 'Drug Tolerant', 'Drug Tolerant', '2016-09-10 07:21:43', '2016-09-10 11:21:43', '4 hours', '2016-09-10 11:11:43', 1, 0, '2016-09-10 07:21:54', '0000-00-00 00:00:00'),
(24, 55, 'vers', '', 'Trimmed,Goatee,Military/Crew,Masculine,Blue Eyes,Muscular', 'Some Body Hair,Masculine,Muscular,Average,Toned', 'Versatile,Average,Raw,Anonymous,Rough,Kissing', 'Uncut,Versatile,Safe,Voyeur', 'Smoker ,PNP', 'PNP,Alcohol,Weed', '2016-09-05 09:24:36', '2016-09-10 07:17:46', '2 hours', '2016-09-05 11:14:36', 0, 0, '2016-09-05 09:24:47', '0000-00-00 00:00:00'),
(26, 62, 'test 1', 'You have the same thing and I\\''m still here at night with the gym today for me your friend said hello hello from your friend to my husband I know he was a great husband ', 'Clean Shaven,Goatee,Trimmed,Some Body Hair', 'Goatee,Trimmed,Some Body Hair,Clean Shaven,Military/Crew,Bald,Scruffy', 'Bottom,Well Endowed,Versatile,Average,Small,Uncut,On PrEP,Let\\''s Discuss', 'Versatile,Small,Uncut,On PrEP,Safe,Let\\''s Discuss', 'Weed,Alcohol,Drug Tolerant', 'Alcohol,Social Smoker,Weed,PNP', '2016-09-28 01:16:46', '2016-10-23 18:56:36', '1 hour', '2016-09-28 02:06:46', 1, 0, '2016-09-27 21:39:53', '2016-09-28 01:16:46'),
(27, 61, 'test', '', 'Some Body Hair,Beard,Bald,Gray Hair,Piercings,Masculine,Blue Eyes,Muscular', 'Hairy,Clean Shaven,Wavy,Ginger Hair,Tattoos,Softer/Fem,Hazel Eyes,Toned', 'Top,Well Endowed,On PrEP,One on One,Saint', 'Bottom,Uncut,Let\\''s Discuss,Groups,Slave', 'Smoker ,Alcohol,PNP', 'Sober,PNP,Alcohol', '2016-09-28 00:30:18', '2016-09-28 04:30:18', '4 hours', '2016-09-28 04:20:18', 1, 0, '2016-09-28 00:30:21', '0000-00-00 00:00:00'),
(28, 64, 'test', '', 'Some Body Hair,Bald,Beard,Gray Hair,Piercings,Masculine,Blue Eyes,Muscular', 'Hairy,Clean Shaven,Wavy,Ginger Hair,Tattoos,Softer/Fem,Hazel Eyes,Toned', 'Top,Well Endowed,On PrEP,One on One,Saint', 'Bottom,Uncut,Let\\''s Discuss,Groups,Slave', 'Smoker ,Alcohol,PNP', 'Non Smoker,Alcohol,Sober', '2016-11-03 02:27:01', '2016-11-03 06:27:01', '4 hours', '2016-11-03 06:17:01', 1, 0, '2016-11-03 02:27:03', '0000-00-00 00:00:00'),
(29, 63, 'test 1', '', 'Hairy,Clean Shaven,Piercings,Softer/Fem,Hazel Eyes,Toned', 'Some Body Hair,Beard,Bald,Gray Hair,Piercings', 'Bottom,Uncut,Let\\''s Discuss', 'Top,Well Endowed,On PrEP,One on One,Sinner', 'Non Smoker,Sober', 'Smoker ,Alcohol,PNP', '2016-11-03 07:44:22', '2016-11-03 08:14:22', '30 minutes', '2016-11-03 08:04:22', 1, 0, '2016-11-03 03:57:57', '2016-11-03 07:44:22'),
(30, 66, 'trst', '', 'Blue Eyes,Muscular', 'Hairy,Clean Shaven,Wavy,Ginger Hair,Tattoos,Softer/Fem,Hazel Eyes,Toned', 'Top,Well Endowed,On PrEP,One on One,Saint', 'Bottom,Uncut,Let\\''s Discuss,Groups,Slave', 'Smoker ,Non Smoker,Social Smoker', 'Sober,Drug Tolerant,PNP', '2016-11-04 22:00:02', '2016-11-04 22:51:12', '4 hours', '2016-11-05 01:50:02', 1, 0, '2016-11-04 22:00:05', '0000-00-00 00:00:00'),
(31, 65, 'test 1', 'Thanks so handsome you sir I love your son your friend and I have another friend and he will me a few guest pics of your family today too many things I just got on you thinking you are going back into my house guest bedroom door open for the bedroom and a repair closet to your garage and you are close. ', 'Some Body Hair,Goatee,Military/Crew,Masculine', 'Smooth,Scruffy,Military/Crew,Tattoos,Brown Hair,Toned', 'Versatile,Well Endowed,Uncut,Raw,Sinner,Kinky,Gear', 'Top,Average,Safe,Groups,Toys,Slave', 'Smoker ,PNP,Drug Tolerant', 'Alcohol,Social Smoker,Weed', '2016-11-20 18:24:51', '2016-11-20 18:25:07', '30 minutes', '2016-11-20 18:44:51', 0, 0, '2016-11-04 22:08:04', '2016-11-20 18:24:52'),
(32, 65, 'test 2', '', 'Goatee', 'Some Body Hair', 'Safe', 'Let\\''s Discuss', 'Weed', 'Weed', '2016-11-20 20:39:16', '2016-11-20 21:09:16', '30 minutes', '2016-11-20 20:59:16', 1, 0, '2016-11-20 19:17:32', '2016-11-20 20:39:16'),
(33, 67, 'trst 1', '', 'Goatee', 'Goatee,Wavy', 'Uncut,Small', 'Well Endowed,Let\\''s Discuss', 'Alcohol,Weed', 'Smoker ,Non Smoker', '2016-12-07 06:42:39', '2017-01-11 21:55:48', '4 hours', '2016-12-07 10:32:39', 0, 0, '2016-12-06 06:10:28', '2016-12-07 06:42:38'),
(34, 68, 'rest', '', 'Some Body Hair,Beard,Bald,Gray Hair,Piercings,Masculine,Blue Eyes,Muscular', 'Hairy,Clean Shaven,Wavy,Ginger Hair,Tattoos,Softer/Fem,Hazel Eyes,Toned', 'Top,Well Endowed,On PrEP,One on One,Saint', 'Bottom,Uncut,Let\\''s Discuss,Groups,Slave', 'Smoker ,Social Smoker,Weed', 'Sober,PNP,Alcohol', '2016-12-07 05:13:53', '2016-12-07 09:13:53', '4 hours', '2016-12-07 09:03:53', 1, 0, '2016-12-07 05:13:56', '0000-00-00 00:00:00'),
(35, 67, 'thu', '', 'Trimmed,Military/Crew,Ginger Hair,Masculine', 'Clean Shaven,Goatee,Hairy', 'Versatile,Well Endowed,On PrEP,Exhibitionist,Fist⬇︎', 'Uncut,Small,Well Endowed,Safe,Exhibitionist', 'Social Smoker,Non Smoker', 'Weed,Alcohol,Social Smoker', '2016-12-11 06:25:00', '2017-01-11 21:55:48', '1 hour and 30 minutes', '2016-12-11 07:45:00', 0, 0, '2016-12-11 06:25:09', '0000-00-00 00:00:00'),
(36, 67, 'test', '', 'Trimmed,Scruffy,Buzzed', 'Some Body Hair,Trimmed', 'Top', 'Bottom', 'Smoker ', 'Non Smoker', '2016-12-27 06:09:16', '2017-01-11 21:55:48', '30 minutes', '2016-12-27 06:29:16', 1, 0, '2016-12-21 20:48:11', '2016-12-27 06:09:16'),
(37, 71, 'top', '', 'Some Body Hair,Clean Shaven,Gray Hair,Tattoos,Masculine,Blue Eyes,Muscular', 'Some Body Hair,Scruffy,Brown Hair,Tattoos', 'Versatile,Well Endowed,On PrEP,One on One,Sinner,Verbal,Toys,Bondage,Master,Underwear', 'Well Endowed', 'Smoker ,PNP,Drug Tolerant', 'Drug Tolerant,PNP', '2017-02-19 04:55:24', '2017-02-19 08:25:24', '3 hours and 30 minutes', '2017-02-19 08:15:24', 1, 0, '2017-02-17 04:43:40', '2017-02-19 04:55:24');

-- --------------------------------------------------------

--
-- Table structure for table `user_partners`
--

CREATE TABLE IF NOT EXISTS `user_partners` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `sexual_role` varchar(60) NOT NULL,
  `orientation` varchar(60) NOT NULL,
  `safe_sex` varchar(60) NOT NULL,
  `HIV_status` varchar(60) NOT NULL,
  `cock_size` varchar(60) NOT NULL,
  `cock_type` varchar(60) NOT NULL,
  `kinks_and_fetishes` varchar(60) NOT NULL,
  `age_range` varchar(60) NOT NULL,
  `race` varchar(60) NOT NULL,
  `height` varchar(60) NOT NULL,
  `weight` varchar(60) NOT NULL,
  `hair_color` varchar(60) NOT NULL,
  `body_hair` varchar(60) NOT NULL,
  `facial_hair` varchar(60) NOT NULL,
  `eye_color` varchar(60) NOT NULL,
  `body_type` varchar(60) NOT NULL,
  `drugs` varchar(60) NOT NULL,
  `drinking` varchar(60) NOT NULL,
  `smoking` varchar(60) NOT NULL,
  `ethinicity` varchar(100) NOT NULL,
  `identities` varchar(100) NOT NULL,
  `position` varchar(100) NOT NULL,
  `behaviour` varchar(100) NOT NULL,
  `location` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=75 ;

--
-- Dumping data for table `user_partners`
--

INSERT INTO `user_partners` (`id`, `user_id`, `sexual_role`, `orientation`, `safe_sex`, `HIV_status`, `cock_size`, `cock_type`, `kinks_and_fetishes`, `age_range`, `race`, `height`, `weight`, `hair_color`, `body_hair`, `facial_hair`, `eye_color`, `body_type`, `drugs`, `drinking`, `smoking`, `ethinicity`, `identities`, `position`, `behaviour`, `location`) VALUES
(1, 1, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(2, 2, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(3, 3, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(4, 4, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(5, 5, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(6, 6, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(7, 7, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(8, 8, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(9, 9, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(10, 10, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(11, 11, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(12, 12, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(13, 13, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(14, 14, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(15, 15, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(16, 16, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(60, 60, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(57, 57, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(56, 56, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(55, 55, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(54, 54, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(53, 53, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(52, 52, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(51, 51, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(50, 50, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(49, 49, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(48, 48, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(47, 47, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(46, 46, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(45, 45, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(61, 61, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(62, 62, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(63, 63, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(64, 64, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(65, 65, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(66, 66, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(67, 67, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(68, 68, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(69, 69, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(70, 70, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(71, 71, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(72, 72, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(73, 73, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(74, 74, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `user_restrictions`
--

CREATE TABLE IF NOT EXISTS `user_restrictions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `member_type` int(11) NOT NULL COMMENT '0=>free 1=>paid',
  `limit_type` varchar(100) NOT NULL COMMENT 'limit which portion matches,favaorite,message',
  `limit` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `creation_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=35 ;

--
-- Dumping data for table `user_restrictions`
--

INSERT INTO `user_restrictions` (`id`, `member_type`, `limit_type`, `limit`, `name`, `creation_date`) VALUES
(1, 0, 'Match', 50, 'Match Results', '2015-11-23 00:00:00'),
(2, 0, 'Favorite', 10, 'Favorites', '2015-11-23 00:00:00'),
(3, 0, 'you_viewed', 5, 'You Viewed', '2015-11-23 00:00:00'),
(4, 0, 'Search', 3, 'Search Results', '2015-11-23 00:00:00'),
(5, 0, 'BlockPerDay', 3, 'Blocks', '2015-11-23 00:00:00'),
(6, 0, 'AlbumReceived', 3, 'Albums Received', '2015-11-23 00:00:00'),
(7, 0, 'PrivateAlbum', 3, 'Private Album', '2015-11-23 00:00:00'),
(8, 0, 'PrivateAlbumSharePerDay', 2, 'Album Shares', '2015-11-23 00:00:00'),
(12, 1, 'Match', 60, 'Match Results', '2015-11-23 00:00:00'),
(13, 1, 'Favorite', 10, 'Favorites', '2015-11-23 00:00:00'),
(14, 1, 'you_viewed', 15, 'You Viewed', '2015-11-23 00:00:00'),
(15, 1, 'Search', 1, 'Search Results', '2015-11-23 00:00:00'),
(17, 1, 'AlbumReceived', 5, 'Albums Received', '2015-11-23 00:00:00'),
(18, 1, 'PrivateAlbum', 10, 'Private Album', '2015-11-23 00:00:00'),
(9, 0, 'RecentMassage', 3, 'Recent Message History', '2015-12-02 00:00:00'),
(10, 0, 'viewed_you', 5, 'Viewed You', '2016-03-04 08:20:00'),
(21, 1, 'viewed_you', 15, 'Viewed You', '2016-03-04 00:00:00'),
(11, 0, 'chat_history', 20, 'Chat History', '2016-04-20 00:00:00'),
(16, 1, 'BlockPerDay', 0, 'Blocks', '2016-05-07 00:00:00'),
(19, 1, 'PrivateAlbumSharePerDay', 0, 'Album Shares', '2016-05-07 00:00:00'),
(20, 1, 'RecentMassage', 0, 'Recent Message History', '2016-05-07 00:00:00'),
(22, 1, 'chat_history', 0, 'Chat History', '2016-05-07 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `verify_logs`
--

CREATE TABLE IF NOT EXISTS `verify_logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `json_data` longtext NOT NULL,
  `creation_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2768 ;

-- --------------------------------------------------------

--
-- Table structure for table `viewers`
--

CREATE TABLE IF NOT EXISTS `viewers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `viewer_user_id` int(11) NOT NULL,
  `is_view` int(11) NOT NULL COMMENT '0=>yes 1=>no',
  `creation_date` datetime NOT NULL,
  `modification_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=478 ;

--
-- Dumping data for table `viewers`
--

INSERT INTO `viewers` (`id`, `user_id`, `viewer_user_id`, `is_view`, `creation_date`, `modification_date`) VALUES
(137, 1, 7, 1, '2016-06-07 10:14:15', '2016-06-07 10:14:15'),
(2, 3, 4, 0, '2017-01-27 09:02:00', '2017-01-27 09:02:00'),
(3, 16, 5, 1, '2016-06-02 09:09:13', '2016-06-02 09:09:13'),
(4, 16, 14, 1, '2016-06-02 09:16:07', '2016-06-02 09:16:07'),
(5, 16, 9, 1, '2016-06-02 09:17:20', '2016-06-02 09:17:20'),
(6, 16, 13, 0, '2016-06-02 09:14:57', '2016-06-02 09:14:57'),
(7, 16, 10, 1, '2016-06-02 09:13:17', '2016-06-02 09:13:17'),
(8, 16, 6, 1, '2016-06-02 09:10:02', '2016-06-02 09:10:02'),
(9, 16, 4, 1, '2016-06-02 09:08:40', '2016-06-02 09:08:40'),
(10, 16, 8, 1, '2016-06-02 09:11:54', '2016-06-02 09:11:54'),
(11, 16, 7, 1, '2016-06-02 09:10:45', '2016-06-02 09:10:45'),
(12, 16, 11, 1, '2016-06-02 09:13:45', '2016-06-02 09:13:45'),
(132, 2, 5, 1, '2016-05-17 13:44:25', '2016-05-17 13:44:25'),
(14, 16, 15, 1, '2016-06-02 09:16:17', '2016-06-02 09:16:17'),
(15, 16, 12, 1, '2016-06-02 09:14:08', '2016-06-02 09:14:08'),
(16, 16, 1, 0, '2016-06-02 09:01:38', '2016-06-02 09:01:38'),
(17, 10, 16, 0, '2016-02-05 15:47:56', '2016-02-05 15:47:56'),
(131, 2, 4, 1, '2016-06-07 10:20:14', '2016-06-07 10:20:14'),
(19, 16, 3, 0, '2016-06-02 09:08:09', '2016-06-02 09:08:09'),
(20, 6, 16, 1, '2016-05-27 12:59:33', '2016-05-27 12:59:33'),
(21, 12, 5, 1, '2016-02-05 16:29:10', '2016-02-05 16:29:10'),
(22, 12, 8, 1, '2016-02-05 16:29:20', '2016-02-05 16:29:20'),
(23, 12, 1, 0, '2016-02-08 06:28:02', '2016-02-08 06:28:02'),
(130, 7, 2, 0, '2016-06-07 13:48:31', '2016-06-07 13:48:31'),
(25, 12, 10, 1, '2016-02-08 06:27:42', '2016-02-08 06:27:42'),
(26, 12, 4, 0, '2016-02-05 16:31:25', '2016-02-05 16:31:25'),
(27, 12, 7, 0, '2016-02-05 16:38:25', '2016-02-05 16:38:25'),
(28, 12, 16, 0, '2016-02-08 06:29:24', '2016-02-08 06:29:24'),
(136, 2, 3, 0, '2016-05-07 06:11:49', '2016-05-07 06:11:49'),
(30, 1, 16, 1, '2016-09-22 09:52:00', '2016-09-22 09:52:00'),
(31, 12, 3, 0, '2016-02-08 10:53:56', '2016-02-08 10:53:56'),
(32, 12, 15, 1, '2016-02-08 06:27:09', '2016-02-08 06:27:09'),
(33, 18, 1, 0, '2016-02-16 13:19:34', '2016-02-16 13:19:34'),
(34, 18, 16, 0, '2016-02-08 13:15:40', '2016-02-08 13:15:40'),
(35, 16, 18, 1, '2016-02-09 13:35:00', '2016-02-09 13:35:00'),
(36, 18, 12, 1, '2016-02-08 12:38:50', '2016-02-08 12:38:50'),
(37, 16, 17, 1, '2016-02-09 13:40:19', '2016-02-09 13:40:19'),
(38, 1, 18, 1, '2016-02-15 12:48:14', '2016-02-15 12:48:14'),
(39, 18, 17, 1, '2016-02-15 12:37:55', '2016-02-15 12:37:55'),
(40, 18, 18, 0, '2016-02-16 13:41:54', '2016-02-16 13:41:54'),
(41, 1, 12, 1, '2016-02-15 12:52:07', '2016-02-15 12:52:07'),
(42, 17, 4, 0, '2016-02-17 16:09:55', '2016-02-17 16:09:55'),
(43, 17, 3, 0, '2016-02-16 18:46:24', '2016-02-16 18:46:24'),
(44, 17, 17, 0, '2016-02-16 17:54:55', '2016-02-16 17:54:55'),
(45, 17, 6, 0, '2016-02-22 14:39:14', '2016-02-22 14:39:14'),
(46, 17, 11, 1, '2016-02-17 11:49:48', '2016-02-17 11:49:48'),
(47, 1, 11, 1, '2016-05-07 08:56:06', '2016-05-07 08:56:06'),
(48, 17, 15, 1, '2016-02-17 11:30:55', '2016-02-17 11:30:55'),
(49, 1, 6, 1, '2016-05-06 13:03:48', '2016-05-06 13:03:48'),
(50, 17, 14, 1, '2016-02-17 11:53:01', '2016-02-17 11:53:01'),
(51, 17, 10, 1, '2016-02-22 12:54:25', '2016-02-22 12:54:25'),
(52, 17, 5, 1, '2016-02-17 15:53:27', '2016-02-17 15:53:27'),
(53, 17, 1, 0, '2016-02-17 15:54:39', '2016-02-17 15:54:39'),
(54, 17, 7, 0, '2016-02-17 17:40:48', '2016-02-17 17:40:48'),
(55, 22, 5, 1, '2016-03-01 02:36:52', '2016-03-01 02:36:52'),
(56, 22, 10, 1, '2016-02-26 00:17:37', '2016-02-26 00:17:37'),
(57, 22, 8, 1, '2016-03-01 02:36:18', '2016-03-01 02:36:18'),
(58, 22, 9, 1, '2016-03-01 02:36:06', '2016-03-01 02:36:06'),
(59, 22, 4, 0, '2016-03-01 02:28:36', '2016-03-01 02:28:36'),
(60, 22, 15, 1, '2016-02-26 00:19:05', '2016-02-26 00:19:05'),
(61, 22, 16, 0, '2016-02-26 00:19:19', '2016-02-26 00:19:19'),
(62, 22, 1, 0, '2016-02-26 04:18:09', '2016-02-26 04:18:09'),
(63, 22, 18, 1, '2016-02-26 00:19:53', '2016-02-26 00:19:53'),
(64, 22, 12, 1, '2016-02-26 00:24:23', '2016-02-26 00:24:23'),
(65, 22, 13, 0, '2016-03-01 02:22:02', '2016-03-01 02:22:02'),
(66, 17, 12, 1, '2016-02-22 11:55:36', '2016-02-22 11:55:36'),
(67, 16, 16, 0, '2016-06-02 09:16:52', '2016-06-02 09:16:52'),
(68, 16, 22, 0, '2016-02-22 07:57:52', '2016-02-22 07:57:52'),
(69, 1, 1, 0, '2017-01-10 09:02:05', '2017-01-10 09:02:05'),
(70, 22, 7, 0, '2016-03-01 02:36:29', '2016-03-01 02:36:29'),
(129, 6, 2, 0, '2016-04-14 09:38:28', '2016-04-14 09:38:28'),
(72, 22, 3, 0, '2016-02-26 04:10:21', '2016-02-26 04:10:21'),
(73, 22, 6, 0, '2016-03-01 02:36:41', '2016-03-01 02:36:41'),
(74, 22, 11, 1, '2016-02-26 00:17:55', '2016-02-26 00:17:55'),
(75, 22, 14, 1, '2016-02-26 00:18:52', '2016-02-26 00:18:52'),
(76, 22, 17, 1, '2016-03-18 05:10:48', '2016-03-18 05:10:48'),
(77, 22, 22, 0, '2016-03-23 00:11:44', '2016-03-23 00:11:44'),
(78, 1, 17, 1, '2016-02-23 11:10:48', '2016-02-23 11:10:48'),
(135, 2, 6, 1, '2016-05-07 06:02:52', '2016-05-07 06:02:52'),
(80, 1, 22, 0, '2016-02-26 05:51:30', '2016-02-26 05:51:30'),
(81, 7, 22, 0, '2016-02-26 05:53:15', '2016-02-26 05:53:15'),
(82, 3, 22, 0, '2016-02-26 05:56:32', '2016-02-26 05:56:32'),
(83, 23, 22, 0, '2016-02-26 06:30:03', '2016-02-26 06:30:03'),
(84, 23, 7, 0, '2016-02-26 06:27:13', '2016-02-26 06:27:13'),
(85, 23, 3, 0, '2016-02-26 06:27:37', '2016-02-26 06:27:37'),
(86, 22, 23, 1, '2016-03-15 00:42:13', '2016-03-15 00:42:13'),
(87, 23, 1, 0, '2016-02-26 06:27:41', '2016-02-26 06:27:41'),
(128, 5, 2, 0, '2016-05-27 12:46:59', '2016-05-27 12:46:59'),
(89, 23, 4, 0, '2016-02-26 06:27:49', '2016-02-26 06:27:49'),
(90, 23, 18, 1, '2016-02-26 06:27:54', '2016-02-26 06:27:54'),
(91, 23, 13, 0, '2016-02-26 06:36:06', '2016-02-26 06:36:06'),
(92, 23, 17, 1, '2016-02-26 06:36:12', '2016-02-26 06:36:12'),
(93, 23, 12, 1, '2016-02-26 06:38:33', '2016-02-26 06:38:33'),
(94, 25, 26, 1, '2016-04-11 20:04:25', '2016-04-11 20:04:25'),
(95, 25, 25, 0, '2016-04-09 01:17:46', '2016-04-09 01:17:46'),
(127, 4, 2, 0, '2016-04-14 09:35:16', '2016-04-14 09:35:16'),
(97, 25, 1, 0, '2016-04-11 08:11:50', '2016-04-11 08:11:50'),
(98, 25, 3, 0, '2016-04-11 07:47:08', '2016-04-11 07:47:08'),
(99, 26, 25, 0, '2016-04-11 19:41:43', '2016-04-11 19:41:43'),
(100, 26, 26, 0, '2016-04-11 19:41:39', '2016-04-11 19:41:39'),
(101, 1, 25, 1, '2016-04-22 06:56:07', '2016-04-22 06:56:07'),
(134, 2, 1, 0, '2016-09-27 07:03:15', '2016-09-27 07:03:15'),
(103, 3, 25, 0, '2016-04-11 08:01:43', '2016-04-11 08:01:43'),
(104, 4, 25, 0, '2016-04-11 08:18:04', '2016-04-11 08:18:04'),
(105, 5, 25, 0, '2016-04-11 06:54:15', '2016-04-11 06:54:15'),
(106, 6, 25, 0, '2016-04-11 07:59:41', '2016-04-11 07:59:41'),
(107, 25, 6, 0, '2016-04-11 07:11:21', '2016-04-11 07:11:21'),
(108, 25, 7, 0, '2016-04-11 07:12:11', '2016-04-11 07:12:11'),
(109, 25, 16, 0, '2016-04-11 07:29:58', '2016-04-11 07:29:58'),
(110, 25, 5, 1, '2016-04-11 07:47:20', '2016-04-11 07:47:20'),
(111, 25, 4, 0, '2016-04-11 07:50:11', '2016-04-11 07:50:11'),
(112, 3, 1, 0, '2017-01-27 09:11:32', '2017-01-27 09:11:32'),
(113, 4, 1, 0, '2016-04-14 05:47:34', '2016-04-14 05:47:34'),
(114, 5, 1, 0, '2016-04-26 10:27:43', '2016-04-26 10:27:43'),
(115, 6, 1, 0, '2016-04-14 05:49:47', '2016-04-14 05:49:47'),
(116, 7, 1, 0, '2016-05-09 09:48:50', '2016-05-09 09:48:50'),
(117, 1, 5, 1, '2016-04-26 05:47:44', '2016-04-26 05:47:44'),
(126, 3, 2, 0, '2016-04-14 09:33:54', '2016-04-14 09:33:54'),
(119, 1, 3, 0, '2017-01-10 10:17:00', '2017-01-10 10:17:00'),
(120, 1, 4, 1, '2016-06-07 10:14:08', '2016-06-07 10:14:08'),
(121, 8, 1, 0, '2016-04-14 05:52:12', '2016-04-14 05:52:12'),
(122, 11, 1, 0, '2016-04-14 06:15:19', '2016-04-14 06:15:19'),
(125, 1, 2, 1, '2016-09-27 07:16:21', '2016-09-27 07:16:21'),
(133, 2, 7, 1, '2016-07-05 05:34:05', '2016-07-05 05:34:05'),
(138, 1, 10, 1, '2016-05-06 13:05:56', '2016-05-06 13:05:56'),
(139, 1, 13, 0, '2016-04-14 12:42:56', '2016-04-14 12:42:56'),
(140, 1, 14, 1, '2016-04-14 12:43:11', '2016-04-14 12:43:11'),
(141, 1, 15, 1, '2016-05-17 11:22:41', '2016-05-17 11:22:41'),
(142, 1, 26, 1, '2016-04-26 06:27:48', '2016-04-26 06:27:48'),
(143, 2, 16, 1, '2016-06-07 12:24:08', '2016-06-07 12:24:08'),
(144, 3, 16, 0, '2017-01-06 10:52:18', '2017-01-06 10:52:18'),
(145, 4, 16, 0, '2016-04-15 06:46:39', '2016-04-15 06:46:39'),
(146, 5, 16, 0, '2016-04-15 06:48:06', '2016-04-15 06:48:06'),
(147, 7, 16, 0, '2016-04-15 06:50:48', '2016-04-15 06:50:48'),
(148, 27, 27, 0, '2016-04-21 17:17:13', '2016-04-21 17:17:13'),
(149, 27, 1, 0, '2016-04-22 06:38:15', '2016-04-22 06:38:15'),
(150, 27, 2, 0, '2016-04-22 06:38:07', '2016-04-22 06:38:07'),
(151, 28, 27, 0, '2016-04-22 06:04:50', '2016-04-22 06:04:50'),
(152, 27, 28, 1, '2016-04-22 06:32:24', '2016-04-22 06:32:24'),
(153, 16, 27, 0, '2016-04-19 06:47:31', '2016-04-19 06:47:31'),
(154, 1, 27, 0, '2016-04-22 06:56:12', '2016-04-22 06:56:12'),
(155, 2, 27, 1, '2016-04-26 09:48:51', '2016-04-26 09:48:51'),
(156, 4, 27, 0, '2016-04-19 06:45:10', '2016-04-19 06:45:10'),
(157, 5, 27, 0, '2016-04-19 06:40:49', '2016-04-19 06:40:49'),
(158, 6, 27, 0, '2016-04-19 06:35:16', '2016-04-19 06:35:16'),
(159, 16, 28, 0, '2016-04-19 06:36:35', '2016-04-19 06:36:35'),
(160, 1, 28, 1, '2016-05-17 11:09:43', '2016-05-17 11:09:43'),
(161, 27, 5, 1, '2016-04-19 06:55:50', '2016-04-19 06:55:50'),
(162, 27, 9, 1, '2016-04-22 05:27:22', '2016-04-22 05:27:22'),
(163, 27, 16, 0, '2016-04-19 06:52:59', '2016-04-19 06:52:59'),
(164, 27, 4, 1, '2016-04-22 06:38:20', '2016-04-22 06:38:20'),
(165, 27, 6, 1, '2016-04-19 20:22:24', '2016-04-19 20:22:24'),
(166, 2, 28, 0, '2016-04-20 11:49:29', '2016-04-20 11:49:29'),
(167, 27, 7, 0, '2016-04-22 05:26:56', '2016-04-22 05:26:56'),
(168, 27, 8, 1, '2016-04-22 05:27:04', '2016-04-22 05:27:04'),
(169, 15, 2, 0, '2016-04-22 05:44:44', '2016-04-22 05:44:44'),
(170, 15, 1, 0, '2016-04-22 06:32:31', '2016-04-22 06:32:31'),
(171, 27, 3, 0, '2016-04-22 06:38:16', '2016-04-22 06:38:16'),
(172, 29, 29, 0, '2016-04-26 05:37:27', '2016-04-26 05:37:27'),
(173, 29, 6, 1, '2016-04-26 05:25:49', '2016-04-26 05:25:49'),
(174, 30, 29, 1, '2016-04-26 05:50:01', '2016-04-26 05:50:01'),
(175, 29, 30, 1, '2016-04-26 05:49:44', '2016-04-26 05:49:44'),
(176, 30, 30, 0, '2016-04-26 05:50:10', '2016-04-26 05:50:10'),
(177, 1, 9, 1, '2016-05-06 13:04:52', '2016-05-06 13:04:52'),
(178, 2, 14, 1, '2016-04-27 07:00:57', '2016-04-27 07:00:57'),
(179, 2, 15, 1, '2016-04-27 07:05:20', '2016-04-27 07:05:20'),
(180, 2, 29, 1, '2016-04-27 05:45:42', '2016-04-27 05:45:42'),
(181, 2, 30, 1, '2016-04-26 13:26:09', '2016-04-26 13:26:09'),
(182, 2, 22, 1, '2016-04-26 09:48:57', '2016-04-26 09:48:57'),
(183, 2, 25, 1, '2016-04-26 13:24:55', '2016-04-26 13:24:55'),
(184, 31, 1, 0, '2016-04-27 05:39:30', '2016-04-27 05:39:30'),
(185, 31, 6, 1, '2016-04-27 05:18:18', '2016-04-27 05:18:18'),
(186, 31, 13, 0, '2016-04-27 05:17:40', '2016-04-27 05:17:40'),
(187, 7, 7, 0, '2016-06-07 12:31:21', '2016-06-07 12:31:21'),
(188, 7, 31, 0, '2016-04-27 05:22:42', '2016-04-27 05:22:42'),
(189, 31, 7, 0, '2016-04-27 05:37:19', '2016-04-27 05:37:19'),
(190, 31, 31, 0, '2016-04-27 05:32:41', '2016-04-27 05:32:41'),
(191, 31, 30, 1, '2016-04-27 05:55:15', '2016-04-27 05:55:15'),
(192, 31, 4, 1, '2016-04-27 05:55:29', '2016-04-27 05:55:29'),
(193, 32, 31, 1, '2016-04-27 16:32:26', '2016-04-27 16:32:26'),
(194, 31, 32, 1, '2016-04-28 20:12:34', '2016-04-28 20:12:34'),
(195, 31, 2, 0, '2016-04-27 07:37:39', '2016-04-27 07:37:39'),
(196, 1, 30, 1, '2016-04-28 11:17:44', '2016-04-28 11:17:44'),
(197, 33, 7, 0, '2016-04-30 04:52:54', '2016-04-30 04:52:54'),
(198, 33, 13, 0, '2016-04-29 21:17:32', '2016-04-29 21:17:32'),
(199, 33, 33, 0, '2016-04-30 04:58:10', '2016-04-30 04:58:10'),
(200, 33, 11, 1, '2016-04-30 02:19:06', '2016-04-30 02:19:06'),
(201, 33, 15, 1, '2016-04-30 02:23:47', '2016-04-30 02:23:47'),
(202, 33, 2, 0, '2016-05-02 05:50:45', '2016-05-02 05:50:45'),
(203, 33, 10, 1, '2016-04-30 02:25:43', '2016-04-30 02:25:43'),
(204, 33, 1, 0, '2016-05-02 05:50:42', '2016-05-02 05:50:42'),
(205, 33, 3, 0, '2016-05-02 05:19:34', '2016-05-02 05:19:34'),
(206, 33, 4, 1, '2016-05-02 05:19:28', '2016-05-02 05:19:28'),
(207, 33, 5, 1, '2016-05-02 05:19:26', '2016-05-02 05:19:26'),
(208, 33, 6, 1, '2016-04-30 04:58:41', '2016-04-30 04:58:41'),
(209, 34, 33, 0, '2016-05-01 03:34:11', '2016-05-01 03:34:11'),
(210, 33, 34, 1, '2016-05-02 05:50:35', '2016-05-02 05:50:35'),
(211, 33, 23, 1, '2016-04-30 19:40:26', '2016-04-30 19:40:26'),
(212, 33, 30, 1, '2016-05-01 02:16:53', '2016-05-01 02:16:53'),
(213, 33, 32, 1, '2016-05-01 02:12:22', '2016-05-01 02:12:22'),
(214, 33, 8, 1, '2016-05-02 05:49:34', '2016-05-02 05:49:34'),
(215, 2, 9, 1, '2016-05-07 06:12:13', '2016-05-07 06:12:13'),
(216, 2, 8, 1, '2016-07-05 05:33:52', '2016-07-05 05:33:52'),
(217, 35, 35, 0, '2016-05-07 10:01:06', '2016-05-07 10:01:06'),
(218, 35, 2, 0, '2016-05-08 03:19:24', '2016-05-08 03:19:24'),
(219, 35, 5, 1, '2016-05-07 09:38:00', '2016-05-07 09:38:00'),
(220, 35, 1, 0, '2016-05-08 03:19:26', '2016-05-08 03:19:26'),
(221, 35, 3, 0, '2016-05-08 03:19:43', '2016-05-08 03:19:43'),
(222, 35, 4, 1, '2016-05-07 09:38:05', '2016-05-07 09:38:05'),
(223, 35, 6, 1, '2016-05-08 02:42:18', '2016-05-08 02:42:18'),
(224, 35, 7, 0, '2016-05-08 03:19:39', '2016-05-08 03:19:39'),
(225, 35, 8, 1, '2016-05-07 08:30:37', '2016-05-07 08:30:37'),
(226, 35, 9, 1, '2016-05-07 08:30:46', '2016-05-07 08:30:46'),
(227, 35, 10, 1, '2016-05-07 08:30:49', '2016-05-07 08:30:49'),
(228, 35, 11, 1, '2016-05-07 08:30:57', '2016-05-07 08:30:57'),
(229, 35, 12, 1, '2016-05-07 08:31:00', '2016-05-07 08:31:00'),
(230, 35, 13, 0, '2016-05-07 08:31:02', '2016-05-07 08:31:02'),
(231, 35, 14, 1, '2016-05-07 08:31:06', '2016-05-07 08:31:06'),
(232, 35, 15, 1, '2016-05-07 08:31:08', '2016-05-07 08:31:08'),
(233, 35, 16, 0, '2016-05-07 08:31:10', '2016-05-07 08:31:10'),
(234, 2, 35, 0, '2016-05-07 10:54:01', '2016-05-07 10:54:01'),
(235, 16, 35, 0, '2016-05-07 08:54:29', '2016-05-07 08:54:29'),
(236, 1, 35, 1, '2016-05-17 11:24:59', '2016-05-17 11:24:59'),
(237, 3, 35, 0, '2016-05-07 10:08:19', '2016-05-07 10:08:19'),
(238, 7, 35, 1, '2016-05-10 10:32:37', '2016-05-10 10:32:37'),
(239, 36, 35, 1, '2016-05-08 04:28:59', '2016-05-08 04:28:59'),
(240, 35, 36, 1, '2016-05-08 04:26:55', '2016-05-08 04:26:55'),
(241, 7, 3, 0, '2016-05-09 09:48:58', '2016-05-09 09:48:58'),
(242, 7, 6, 1, '2016-05-09 09:49:04', '2016-05-09 09:49:04'),
(243, 7, 8, 1, '2016-05-09 09:49:11', '2016-05-09 09:49:11'),
(244, 7, 4, 1, '2016-05-10 10:32:18', '2016-05-10 10:32:18'),
(245, 3, 7, 0, '2016-05-09 10:47:34', '2016-05-09 10:47:34'),
(246, 7, 5, 1, '2016-05-10 10:31:48', '2016-05-10 10:31:48'),
(247, 37, 37, 0, '2016-05-12 06:25:37', '2016-05-12 06:25:37'),
(248, 37, 1, 0, '2016-05-12 07:58:05', '2016-05-12 07:58:05'),
(249, 37, 2, 0, '2016-05-12 06:40:09', '2016-05-12 06:40:09'),
(250, 37, 3, 0, '2016-05-12 06:40:16', '2016-05-12 06:40:16'),
(251, 37, 4, 1, '2016-05-12 06:40:22', '2016-05-12 06:40:22'),
(252, 37, 5, 1, '2016-05-31 07:39:54', '2016-05-31 07:39:54'),
(253, 37, 6, 1, '2016-05-12 06:40:30', '2016-05-12 06:40:30'),
(254, 2, 37, 0, '2016-05-12 07:43:01', '2016-05-12 07:43:01'),
(255, 1, 37, 0, '2016-05-12 07:41:33', '2016-05-12 07:41:33'),
(256, 3, 37, 0, '2016-05-12 07:44:08', '2016-05-12 07:44:08'),
(257, 38, 37, 0, '2016-05-14 01:23:57', '2016-05-14 01:23:57'),
(258, 37, 30, 1, '2016-05-14 00:54:45', '2016-05-14 00:54:45'),
(259, 37, 26, 1, '2016-05-14 00:54:36', '2016-05-14 00:54:36'),
(260, 37, 36, 1, '2016-05-14 00:57:24', '2016-05-14 00:57:24'),
(261, 37, 38, 1, '2016-05-14 02:13:14', '2016-05-14 02:13:14'),
(262, 1, 32, 1, '2016-05-17 11:25:44', '2016-05-17 11:25:44'),
(263, 39, 39, 0, '2016-05-24 13:45:06', '2016-05-24 13:45:06'),
(264, 39, 1, 0, '2016-05-24 13:28:22', '2016-05-24 13:28:22'),
(265, 40, 40, 0, '2016-05-24 13:17:15', '2016-05-24 13:17:15'),
(266, 40, 39, 1, '2016-05-24 13:17:36', '2016-05-24 13:17:36'),
(267, 3, 39, 1, '2016-05-27 08:04:52', '2016-05-27 08:04:52'),
(268, 39, 40, 1, '2016-05-24 13:28:39', '2016-05-24 13:28:39'),
(269, 1, 40, 1, '2016-05-24 13:19:31', '2016-05-24 13:19:31'),
(270, 1, 39, 1, '2016-05-24 13:19:39', '2016-05-24 13:19:39'),
(271, 39, 2, 0, '2016-05-24 13:40:10', '2016-05-24 13:40:10'),
(272, 39, 3, 0, '2016-05-26 13:15:44', '2016-05-26 13:15:44'),
(273, 39, 4, 1, '2016-05-24 13:39:28', '2016-05-24 13:39:28'),
(274, 39, 5, 1, '2016-05-24 13:39:32', '2016-05-24 13:39:32'),
(275, 39, 6, 1, '2016-05-24 13:33:10', '2016-05-24 13:33:10'),
(276, 39, 7, 1, '2016-05-24 13:28:09', '2016-05-24 13:28:09'),
(277, 7, 39, 1, '2016-05-24 13:20:55', '2016-05-24 13:20:55'),
(278, 2, 39, 1, '2016-05-24 13:22:08', '2016-05-24 13:22:08'),
(279, 5, 39, 1, '2016-05-24 13:23:24', '2016-05-24 13:23:24'),
(280, 6, 39, 1, '2016-05-24 13:31:54', '2016-05-24 13:31:54'),
(281, 16, 39, 1, '2016-05-24 14:22:35', '2016-05-24 14:22:35'),
(282, 42, 42, 0, '2016-05-25 07:39:22', '2016-05-25 07:39:22'),
(283, 42, 3, 0, '2016-05-25 10:29:32', '2016-05-25 10:29:32'),
(284, 3, 42, 1, '2016-05-25 10:29:26', '2016-05-25 10:29:26'),
(285, 42, 40, 1, '2016-05-25 10:17:38', '2016-05-25 10:17:38'),
(286, 42, 16, 0, '2016-05-25 10:28:09', '2016-05-25 10:28:09'),
(287, 16, 2, 0, '2016-06-02 09:06:47', '2016-06-02 09:06:47'),
(288, 43, 37, 1, '2016-05-31 01:10:04', '2016-05-31 01:10:04'),
(289, 37, 43, 1, '2016-05-31 07:38:08', '2016-05-31 07:38:08'),
(290, 37, 16, 1, '2016-05-31 07:39:39', '2016-05-31 07:39:39'),
(291, 4, 3, 0, '2016-06-02 07:56:18', '2016-06-02 07:56:18'),
(292, 6, 5, 1, '2016-06-02 08:03:18', '2016-06-02 08:03:18'),
(293, 46, 1, 0, '2016-06-03 06:59:10', '2016-06-03 06:59:10'),
(294, 46, 45, 1, '2016-06-05 16:54:56', '2016-06-05 16:54:56'),
(295, 46, 2, 0, '2016-06-03 06:23:38', '2016-06-03 06:23:38'),
(296, 46, 3, 0, '2016-06-03 06:24:41', '2016-06-03 06:24:41'),
(297, 47, 1, 0, '2016-06-03 06:51:48', '2016-06-03 06:51:48'),
(298, 47, 2, 0, '2016-06-03 06:51:56', '2016-06-03 06:51:56'),
(299, 1, 46, 1, '2016-06-03 07:11:21', '2016-06-03 07:11:21'),
(300, 2, 46, 1, '2016-06-03 07:13:57', '2016-06-03 07:13:57'),
(301, 2, 45, 1, '2016-06-03 07:12:56', '2016-06-03 07:12:56'),
(302, 46, 47, 1, '2016-06-05 01:10:28', '2016-06-05 01:10:28'),
(303, 45, 46, 1, '2016-06-05 16:55:20', '2016-06-05 16:55:20'),
(304, 1, 8, 1, '2016-06-07 10:14:20', '2016-06-07 10:14:20'),
(305, 2, 2, 0, '2016-06-07 12:21:36', '2016-06-07 12:21:36'),
(306, 49, 48, 1, '2016-06-19 21:23:40', '2016-06-19 21:23:40'),
(307, 48, 49, 1, '2016-06-14 04:28:23', '2016-06-14 04:28:23'),
(308, 48, 48, 0, '2016-06-14 04:28:31', '2016-06-14 04:28:31'),
(309, 49, 5, 1, '2016-06-14 06:38:39', '2016-06-14 06:38:39'),
(310, 49, 1, 0, '2016-06-19 21:24:03', '2016-06-19 21:24:03'),
(311, 49, 2, 0, '2016-06-14 06:39:14', '2016-06-14 06:39:14'),
(312, 49, 15, 1, '2016-06-14 06:39:20', '2016-06-14 06:39:20'),
(313, 49, 16, 1, '2016-06-14 06:39:24', '2016-06-14 06:39:24'),
(314, 49, 49, 0, '2016-06-14 06:42:27', '2016-06-14 06:42:27'),
(315, 8, 7, 1, '2016-06-17 09:35:06', '2016-06-17 09:35:06'),
(316, 51, 50, 1, '2016-06-22 03:43:06', '2016-06-22 03:43:06'),
(317, 50, 51, 0, '2016-06-22 03:43:01', '2016-06-22 03:43:01'),
(318, 52, 2, 0, '2016-06-28 01:22:58', '2016-06-28 01:22:58'),
(319, 51, 52, 0, '2016-06-27 00:59:02', '2016-06-27 00:59:02'),
(320, 51, 51, 0, '2016-06-27 00:48:56', '2016-06-27 00:48:56'),
(321, 52, 3, 0, '2016-06-25 22:18:22', '2016-06-25 22:18:22'),
(322, 52, 8, 1, '2016-06-26 21:55:35', '2016-06-26 21:55:35'),
(323, 52, 1, 0, '2016-07-13 11:55:27', '2016-07-13 11:55:27'),
(324, 52, 5, 1, '2016-06-25 23:00:50', '2016-06-25 23:00:50'),
(325, 52, 51, 1, '2016-06-28 01:22:59', '2016-06-28 01:22:59'),
(326, 52, 4, 1, '2016-06-27 01:04:01', '2016-06-27 01:04:01'),
(327, 52, 7, 1, '2016-06-26 22:01:00', '2016-06-26 22:01:00'),
(328, 52, 6, 1, '2016-06-25 23:15:19', '2016-06-25 23:15:19'),
(329, 52, 52, 0, '2016-07-13 11:58:39', '2016-07-13 11:58:39'),
(330, 1, 52, 1, '2016-12-29 07:54:45', '2016-12-29 07:54:45'),
(331, 1, 51, 1, '2016-06-27 05:43:21', '2016-06-27 05:43:21'),
(332, 2, 52, 0, '2016-06-27 05:51:17', '2016-06-27 05:51:17'),
(333, 3, 52, 0, '2017-01-06 10:51:55', '2017-01-06 10:51:55'),
(334, 2, 13, 0, '2016-07-05 05:34:10', '2016-07-05 05:34:10'),
(335, 54, 54, 0, '2016-07-22 06:13:40', '2016-07-22 06:13:40'),
(336, 53, 55, 0, '2016-08-06 07:42:12', '2016-08-06 07:42:12'),
(337, 55, 54, 1, '2016-07-22 07:57:14', '2016-07-22 07:57:14'),
(338, 55, 8, 1, '2016-07-29 09:27:48', '2016-07-29 09:27:48'),
(339, 55, 2, 0, '2016-07-31 23:42:40', '2016-07-31 23:42:40'),
(340, 55, 1, 0, '2016-09-10 07:25:25', '2016-09-10 07:25:25'),
(341, 55, 3, 0, '2016-07-29 13:11:30', '2016-07-29 13:11:30'),
(342, 55, 4, 1, '2016-07-29 09:36:29', '2016-07-29 09:36:29'),
(343, 55, 5, 1, '2016-07-20 01:51:36', '2016-07-20 01:51:36'),
(344, 55, 6, 1, '2016-09-05 09:27:03', '2016-09-05 09:27:03'),
(345, 55, 7, 1, '2016-07-29 09:27:15', '2016-07-29 09:27:15'),
(346, 55, 53, 1, '2016-09-10 07:25:00', '2016-09-10 07:25:00'),
(347, 55, 51, 1, '2016-09-10 07:26:05', '2016-09-10 07:26:05'),
(348, 53, 54, 1, '2016-07-20 02:58:48', '2016-07-20 02:58:48'),
(349, 53, 53, 0, '2016-08-06 07:23:43', '2016-08-06 07:23:43'),
(350, 55, 48, 1, '2016-08-05 04:22:50', '2016-08-05 04:22:50'),
(351, 53, 7, 1, '2016-07-20 02:57:40', '2016-07-20 02:57:40'),
(352, 53, 2, 0, '2016-07-20 03:00:00', '2016-07-20 03:00:00'),
(353, 53, 51, 1, '2016-07-20 03:02:28', '2016-07-20 03:02:28'),
(354, 53, 1, 0, '2016-07-20 03:00:15', '2016-07-20 03:00:15'),
(355, 55, 45, 1, '2016-08-05 04:24:16', '2016-08-05 04:24:16'),
(356, 54, 55, 0, '2016-07-22 08:03:36', '2016-07-22 08:03:36'),
(357, 55, 13, 0, '2016-07-29 09:53:36', '2016-07-29 09:53:36'),
(358, 55, 55, 0, '2016-09-05 09:25:37', '2016-09-05 09:25:37'),
(359, 13, 13, 0, '2016-07-29 05:20:01', '2016-07-29 05:20:01'),
(360, 13, 2, 0, '2016-07-28 05:32:10', '2016-07-28 05:32:10'),
(361, 13, 12, 1, '2016-07-28 05:31:57', '2016-07-28 05:31:57'),
(362, 53, 12, 1, '2016-07-28 09:32:25', '2016-07-28 09:32:25'),
(363, 53, 3, 0, '2016-07-28 09:32:35', '2016-07-28 09:32:35'),
(364, 13, 1, 0, '2016-07-28 09:52:15', '2016-07-28 09:52:15'),
(365, 55, 12, 1, '2016-07-29 09:53:58', '2016-07-29 09:53:58'),
(366, 55, 52, 1, '2016-07-29 09:07:36', '2016-07-29 09:07:36'),
(367, 1, 55, 0, '2016-07-29 14:59:15', '2016-07-29 14:59:15'),
(368, 2, 55, 1, '2016-09-27 06:58:14', '2016-09-27 06:58:14'),
(369, 3, 55, 0, '2017-01-06 10:51:31', '2017-01-06 10:51:31'),
(370, 3, 3, 0, '2017-01-27 09:17:06', '2017-01-27 09:17:06'),
(371, 3, 5, 1, '2016-08-05 12:47:27', '2016-08-05 12:47:27'),
(372, 55, 46, 1, '2016-08-08 05:10:58', '2016-08-08 05:10:58'),
(373, 3, 13, 1, '2016-09-02 11:20:31', '2016-09-02 11:20:31'),
(374, 58, 59, 1, '2016-09-05 08:00:02', '2016-09-05 08:00:02'),
(375, 59, 58, 0, '2016-09-05 08:01:55', '2016-09-05 08:01:55'),
(376, 1, 59, 1, '2016-09-05 08:21:52', '2016-09-05 08:21:52'),
(377, 1, 58, 0, '2016-09-05 08:21:11', '2016-09-05 08:21:11'),
(378, 60, 60, 0, '2016-09-07 09:17:37', '2016-09-07 09:17:37'),
(379, 62, 62, 0, '2016-09-27 03:10:42', '2016-09-27 03:10:42'),
(380, 62, 61, 0, '2016-10-10 09:54:58', '2016-10-10 09:54:58'),
(381, 61, 62, 0, '2016-10-10 09:53:43', '2016-10-10 09:53:43'),
(382, 1, 62, 0, '2016-09-27 06:58:32', '2016-09-27 06:58:32'),
(383, 2, 62, 0, '2016-09-27 06:58:02', '2016-09-27 06:58:02'),
(384, 62, 2, 1, '2016-09-29 16:54:29', '2016-09-29 16:54:29'),
(385, 62, 1, 0, '2016-09-29 16:50:19', '2016-09-29 16:50:19'),
(386, 62, 6, 1, '2016-09-28 01:18:15', '2016-09-28 01:18:15'),
(387, 62, 46, 1, '2016-10-10 03:49:57', '2016-10-10 03:49:57'),
(388, 64, 63, 0, '2016-11-03 02:15:21', '2016-11-03 02:15:21'),
(389, 63, 64, 1, '2016-11-03 04:30:28', '2016-11-03 04:30:28'),
(390, 63, 1, 0, '2016-11-03 07:39:07', '2016-11-03 07:39:07'),
(391, 63, 13, 1, '2016-11-03 07:46:52', '2016-11-03 07:46:52'),
(392, 63, 12, 1, '2016-11-03 07:44:26', '2016-11-03 07:44:26'),
(393, 1, 54, 1, '2016-11-04 14:54:34', '2016-11-04 14:54:34'),
(394, 65, 53, 1, '2016-11-20 06:10:58', '2016-11-20 06:10:58'),
(395, 65, 64, 1, '2016-11-20 22:12:29', '2016-11-20 22:12:29'),
(396, 65, 1, 0, '2016-11-20 22:12:53', '2016-11-20 22:12:53'),
(397, 65, 51, 1, '2016-11-20 22:12:31', '2016-11-20 22:12:31'),
(398, 65, 61, 1, '2016-11-20 22:12:27', '2016-11-20 22:12:27'),
(399, 65, 2, 1, '2016-11-20 22:12:41', '2016-11-20 22:12:41'),
(400, 65, 3, 0, '2016-11-20 22:12:44', '2016-11-20 22:12:44'),
(401, 65, 5, 1, '2016-11-20 22:12:55', '2016-11-20 22:12:55'),
(402, 65, 7, 1, '2016-11-20 22:12:47', '2016-11-20 22:12:47'),
(403, 65, 12, 1, '2016-11-20 22:12:46', '2016-11-20 22:12:46'),
(404, 65, 13, 1, '2016-11-07 05:48:45', '2016-11-07 05:48:45'),
(405, 65, 8, 1, '2016-11-20 22:12:39', '2016-11-20 22:12:39'),
(406, 66, 65, 0, '2016-11-04 22:21:14', '2016-11-04 22:21:14'),
(407, 65, 66, 1, '2016-11-20 22:12:37', '2016-11-20 22:12:37'),
(408, 65, 65, 0, '2016-11-20 22:11:16', '2016-11-20 22:11:16'),
(409, 66, 66, 0, '2016-11-04 22:11:35', '2016-11-04 22:11:35'),
(410, 65, 48, 1, '2016-11-14 02:24:20', '2016-11-14 02:24:20'),
(411, 65, 60, 1, '2016-11-17 01:50:55', '2016-11-17 01:50:55'),
(412, 65, 62, 1, '2016-11-20 22:12:50', '2016-11-20 22:12:50'),
(413, 65, 63, 1, '2016-11-20 22:12:23', '2016-11-20 22:12:23'),
(414, 65, 45, 1, '2016-11-20 18:18:32', '2016-11-20 18:18:32'),
(415, 65, 55, 1, '2016-11-20 22:13:00', '2016-11-20 22:13:00'),
(416, 65, 52, 1, '2016-11-20 22:12:25', '2016-11-20 22:12:25'),
(417, 65, 6, 1, '2016-11-20 22:12:33', '2016-11-20 22:12:33'),
(418, 65, 4, 1, '2016-11-20 22:12:58', '2016-11-20 22:12:58'),
(419, 67, 16, 1, '2016-12-06 04:40:36', '2016-12-06 04:40:36'),
(420, 67, 12, 1, '2016-12-07 06:44:09', '2016-12-07 06:44:09'),
(421, 67, 1, 0, '2017-01-11 22:07:18', '2017-01-11 22:07:18'),
(422, 67, 67, 0, '2016-12-24 01:18:53', '2016-12-24 01:18:53'),
(423, 67, 55, 1, '2016-12-24 01:11:49', '2016-12-24 01:11:49'),
(424, 67, 65, 1, '2016-12-21 14:57:55', '2016-12-21 14:57:55'),
(425, 67, 66, 1, '2016-12-24 01:11:11', '2016-12-24 01:11:11'),
(426, 67, 51, 1, '2016-12-24 01:11:29', '2016-12-24 01:11:29'),
(427, 67, 53, 1, '2016-12-26 16:11:14', '2016-12-26 16:11:14'),
(428, 67, 63, 1, '2016-12-26 16:14:01', '2016-12-26 16:14:01'),
(429, 67, 61, 1, '2016-12-26 16:14:31', '2016-12-26 16:14:31'),
(430, 67, 64, 1, '2016-12-21 20:49:05', '2016-12-21 20:49:05'),
(431, 67, 62, 1, '2016-12-09 01:16:41', '2016-12-09 01:16:41'),
(432, 67, 3, 0, '2017-01-11 22:07:07', '2017-01-11 22:07:07'),
(433, 67, 52, 1, '2016-12-07 01:52:48', '2016-12-07 01:52:48'),
(434, 67, 13, 1, '2016-12-07 06:44:05', '2016-12-07 06:44:05'),
(435, 67, 7, 1, '2016-12-07 01:53:25', '2016-12-07 01:53:25'),
(436, 67, 8, 1, '2016-12-07 01:53:27', '2016-12-07 01:53:27'),
(437, 67, 5, 1, '2016-12-07 01:53:29', '2016-12-07 01:53:29'),
(438, 67, 2, 1, '2016-12-07 06:45:29', '2016-12-07 06:45:29'),
(439, 67, 6, 1, '2016-12-07 06:45:31', '2016-12-07 06:45:31'),
(440, 68, 67, 0, '2016-12-07 05:14:06', '2016-12-07 05:14:06'),
(441, 67, 68, 1, '2016-12-09 01:16:53', '2016-12-09 01:16:53'),
(442, 67, 4, 1, '2016-12-07 06:45:28', '2016-12-07 06:45:28'),
(443, 67, 45, 1, '2016-12-24 01:13:08', '2016-12-24 01:13:08'),
(444, 62, 67, 0, '2016-12-21 14:43:47', '2016-12-21 14:43:47'),
(445, 67, 50, 1, '2016-12-26 16:14:11', '2016-12-26 16:14:11'),
(446, 67, 49, 1, '2016-12-24 01:12:46', '2016-12-24 01:12:46'),
(447, 67, 69, 1, '2016-12-26 16:13:52', '2016-12-26 16:13:52'),
(448, 67, 54, 1, '2016-12-24 01:16:05', '2016-12-24 01:16:05'),
(449, 67, 46, 1, '2016-12-24 01:19:17', '2016-12-24 01:19:17'),
(450, 67, 48, 1, '2016-12-24 01:19:35', '2016-12-24 01:19:35'),
(451, 67, 70, 1, '2016-12-26 16:14:24', '2016-12-26 16:14:24'),
(452, 70, 70, 0, '2016-12-27 05:41:40', '2016-12-27 05:41:40'),
(453, 70, 50, 1, '2016-12-27 07:07:40', '2016-12-27 07:07:40'),
(454, 70, 1, 0, '2016-12-27 07:09:30', '2016-12-27 07:09:30'),
(455, 3, 12, 0, '2017-01-02 08:04:01', '2017-01-02 08:04:01'),
(456, 3, 8, 0, '2017-01-02 08:17:34', '2017-01-02 08:17:34'),
(457, 71, 71, 0, '2017-02-19 04:56:14', '2017-02-19 04:56:14'),
(458, 71, 67, 0, '2017-01-31 02:15:02', '2017-01-31 02:15:02'),
(459, 72, 71, 0, '2017-01-31 02:44:38', '2017-01-31 02:44:38'),
(460, 72, 67, 0, '2017-01-31 02:44:42', '2017-01-31 02:44:42'),
(461, 71, 7, 0, '2017-02-19 04:58:38', '2017-02-19 04:58:38'),
(462, 73, 71, 0, '2017-02-01 23:45:12', '2017-02-01 23:45:12'),
(463, 71, 73, 0, '2017-02-01 23:44:16', '2017-02-01 23:44:16'),
(464, 71, 74, 0, '2017-02-16 12:55:12', '2017-02-16 12:55:12'),
(465, 74, 74, 0, '2017-02-12 23:29:50', '2017-02-12 23:29:50'),
(466, 74, 55, 0, '2017-02-12 23:26:41', '2017-02-12 23:26:41'),
(467, 74, 63, 0, '2017-02-12 23:27:00', '2017-02-12 23:27:00'),
(468, 74, 70, 0, '2017-02-12 23:33:10', '2017-02-12 23:33:10'),
(469, 74, 71, 0, '2017-02-12 23:30:21', '2017-02-12 23:30:21'),
(470, 74, 2, 0, '2017-02-12 23:37:10', '2017-02-12 23:37:10'),
(471, 74, 64, 0, '2017-02-12 23:38:16', '2017-02-12 23:38:16'),
(472, 71, 48, 0, '2017-02-17 04:44:22', '2017-02-17 04:44:22'),
(473, 71, 68, 0, '2017-02-17 04:46:11', '2017-02-17 04:46:11'),
(474, 71, 55, 0, '2017-02-17 04:46:43', '2017-02-17 04:46:43'),
(475, 71, 61, 0, '2017-02-17 04:47:38', '2017-02-17 04:47:38'),
(476, 71, 16, 0, '2017-02-19 04:53:32', '2017-02-19 04:53:32'),
(477, 71, 64, 0, '2017-02-19 04:55:45', '2017-02-19 04:55:45');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
