-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 10, 2017 at 11:54 AM
-- Server version: 5.5.45
-- PHP Version: 5.6.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `frontline`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_notifications`
--

CREATE TABLE IF NOT EXISTS `admin_notifications` (
  `id` int(11) NOT NULL,
  `from_id` int(11) NOT NULL,
  `to_id` int(11) NOT NULL,
  `type` varchar(100) NOT NULL,
  `content` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=181 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_notifications`
--

INSERT INTO `admin_notifications` (`id`, `from_id`, `to_id`, `type`, `content`, `status`, `created_at`, `updated_at`) VALUES
(1, 89, 0, 'task_requested', 'Dhiraj kumar requested task testing name qqqqq', 1, '2017-01-17 10:05:27', '2017-01-18 10:48:30'),
(2, 89, 0, 'task_completed', 'Dhiraj kumar completed task Fddsf', 1, '2017-01-17 10:08:48', '2017-01-18 10:48:34'),
(3, 89, 0, 'task_completed', 'Dhiraj kumar completed task My task', 1, '2017-01-17 10:08:59', '2017-01-18 10:48:22'),
(4, 89, 0, 'task_completed', 'Dhiraj kumar completed task My task', 1, '2017-01-17 10:11:08', '2017-01-18 10:48:17'),
(5, 89, 0, 'task_completed', 'Dhiraj kumar completed task Some gtask', 1, '2017-01-17 10:11:27', '2017-01-18 10:48:26'),
(6, 89, 0, 'task_completed', 'Dhiraj kumar completed task Hgh', 1, '2017-01-17 10:11:42', '2017-01-18 10:48:14'),
(7, 89, 0, 'task_completed', 'Dhiraj kumar completed task Fddsf', 1, '2017-01-17 10:12:13', '2017-01-18 09:11:42'),
(8, 89, 0, 'task_requested', 'Dhiraj kumar requested task New task', 1, '2017-01-17 10:12:45', '2017-01-18 09:11:40'),
(9, 99, 0, 'task_requested', 'dhiraj requested task Cleaning', 1, '2017-01-17 12:06:58', '2017-01-18 09:10:16'),
(10, 99, 0, 'task_completed', 'dhiraj completed task Cleaning', 1, '2017-01-17 12:07:24', '2017-01-18 09:07:21'),
(11, 99, 0, 'task_completed', 'dhiraj completed task Cleaning', 0, '2017-01-18 16:23:24', '2017-01-19 08:53:41'),
(12, 99, 0, 'task_completed', 'dhiraj completed task Cleaning', 0, '2017-01-19 02:00:00', '2017-01-19 08:53:36'),
(13, 95, 0, 'task_requested', 'debut houseowner requested task Fug', 1, '2017-01-20 13:00:21', '2017-01-20 13:00:21'),
(14, 95, 0, 'task_completed', 'debut houseowner completed task Fug', 1, '2017-01-20 13:00:37', '2017-01-20 13:00:37'),
(15, 89, 0, 'task_requested', 'Dhiraj kumar requested task My task', 1, '2017-01-23 09:41:32', '2017-01-23 09:41:32'),
(16, 89, 0, 'task_requested', 'Dhiraj kumar requested task Some task', 1, '2017-01-23 10:20:23', '2017-01-23 10:20:23'),
(17, 89, 0, 'task_deleted', 'Dhiraj kumar deleted task Some task', 1, '2017-01-23 11:39:09', '2017-01-23 11:39:09'),
(18, 89, 0, 'task_deleted', 'Dhiraj kumar deleted task Cleaning Store', 1, '2017-01-23 11:39:26', '2017-01-23 11:39:26'),
(19, 89, 0, 'task_deleted', 'Dhiraj kumar deleted task My task', 1, '2017-01-23 11:40:29', '2017-01-23 11:40:29'),
(20, 89, 0, 'task_requested', 'Dhiraj kumar requested task My task', 1, '2017-01-23 11:40:51', '2017-01-23 11:40:51'),
(21, 89, 0, 'task_deleted', 'Dhiraj kumar deleted task Cleaning and washing for office location', 1, '2017-01-23 12:27:50', '2017-01-23 12:27:50'),
(22, 89, 0, 'task_requested', 'Dhiraj kumar requested task My task', 1, '2017-01-23 12:28:37', '2017-01-23 12:28:37'),
(23, 89, 0, 'task_requested', 'Dhiraj kumar requested task Your task', 1, '2017-01-23 12:54:54', '2017-01-23 12:54:54'),
(24, 89, 0, 'task_rescheduled', 'Dhiraj kumar rescheduled task Your task', 1, '2017-01-23 13:09:20', '2017-01-23 13:09:20'),
(25, 89, 0, 'task_rescheduled', 'Dhiraj kumar rescheduled task Your task', 1, '2017-01-23 13:27:41', '2017-01-23 13:27:41'),
(26, 89, 0, 'task_rescheduled', 'Dhiraj kumar rescheduled task Your task', 1, '2017-01-23 13:31:46', '2017-01-23 13:31:46'),
(27, 89, 0, 'task_rescheduled', 'Dhiraj kumar rescheduled task Your task', 1, '2017-01-23 13:33:30', '2017-01-23 13:33:30'),
(28, 89, 0, 'task_rescheduled', 'Dhiraj kumar rescheduled task Your task', 1, '2017-01-23 13:34:48', '2017-01-23 13:34:48'),
(29, 89, 0, 'task_rescheduled', 'Dhiraj kumar rescheduled task Your task', 1, '2017-01-23 13:45:50', '2017-01-23 13:45:50'),
(30, 89, 0, 'task_rescheduled', 'Dhiraj kumar rescheduled task Your task', 1, '2017-01-23 13:45:57', '2017-01-23 13:45:57'),
(31, 99, 0, 'task_requested', 'dhiraj requested task Cleaning', 1, '2017-01-23 13:46:50', '2017-01-23 13:46:50'),
(32, 99, 0, 'task_requested', 'dhiraj requested task Washing', 1, '2017-01-23 13:48:24', '2017-01-23 13:48:24'),
(33, 99, 0, 'task_rescheduled', 'dhiraj rescheduled task Washing', 1, '2017-01-23 13:49:06', '2017-01-23 13:49:06'),
(34, 99, 0, 'task_rescheduled', 'dhiraj rescheduled task Washing', 1, '2017-01-23 13:51:09', '2017-01-23 13:51:09'),
(35, 99, 0, 'task_completed', 'dhiraj completed task Dry Cleaning', 1, '2017-01-23 13:56:40', '2017-01-23 13:56:40'),
(36, 99, 0, 'task_deleted', 'dhiraj deleted task Cleaning', 1, '2017-01-23 13:57:57', '2017-01-23 13:57:57'),
(37, 99, 0, 'task_requested', 'dhiraj requested task NEW TASK', 1, '2017-01-24 04:24:03', '2017-01-24 04:24:03'),
(38, 99, 0, 'task_deleted', 'dhiraj deleted task NEW TASK', 1, '2017-01-24 04:24:14', '2017-01-24 04:24:14'),
(39, 99, 0, 'task_requested', 'dhiraj requested task Some Data', 1, '2017-01-24 04:25:00', '2017-01-24 04:25:00'),
(40, 89, 0, 'task_rescheduled', 'Dhiraj kumar rescheduled task Not my task', 1, '2017-01-24 06:36:26', '2017-01-24 06:36:26'),
(41, 89, 0, 'task_rescheduled', 'Dhiraj kumar rescheduled task Your task', 1, '2017-01-24 07:10:19', '2017-01-24 07:10:19'),
(42, 89, 0, 'task_deleted', 'Dhiraj kumar deleted task Your task', 1, '2017-01-24 07:17:15', '2017-01-24 07:17:15'),
(43, 89, 0, 'task_deleted', 'Dhiraj kumar deleted task Not my task', 1, '2017-01-24 07:17:56', '2017-01-24 07:17:56'),
(44, 89, 0, 'task_requested', 'Dhiraj kumar requested task Cleaning', 1, '2017-01-24 07:18:44', '2017-01-24 07:18:44'),
(45, 89, 0, 'task_requested', 'Dhiraj kumar requested task Washind', 1, '2017-01-24 07:22:38', '2017-01-24 07:22:38'),
(46, 89, 0, 'task_requested', 'Dhiraj kumar requested task Empty task', 1, '2017-01-24 07:22:48', '2017-01-24 07:22:48'),
(47, 89, 0, 'task_deleted', 'Dhiraj kumar deleted task Erftt', 1, '2017-01-24 09:02:59', '2017-01-24 09:02:59'),
(48, 89, 0, 'task_requested', 'Dhiraj kumar requested task Jagraj task', 1, '2017-01-24 09:04:30', '2017-01-24 09:04:30'),
(49, 89, 0, 'task_deleted', 'Dhiraj kumar deleted task Washind', 1, '2017-01-24 09:16:43', '2017-01-24 09:16:43'),
(50, 89, 0, 'task_deleted', 'Dhiraj kumar deleted task Jagraj task', 1, '2017-01-24 09:17:33', '2017-01-24 09:17:33'),
(51, 89, 0, 'task_deleted', 'Dhiraj kumar deleted task Cleaning', 1, '2017-01-24 09:17:59', '2017-01-24 09:17:59'),
(52, 89, 0, 'task_requested', 'Dhiraj kumar requested task Some tal', 1, '2017-01-24 09:18:46', '2017-01-24 09:18:46'),
(53, 89, 0, 'task_deleted', 'Dhiraj kumar deleted task Some tal', 1, '2017-01-24 09:18:53', '2017-01-24 09:18:53'),
(54, 89, 0, 'task_requested', 'Dhiraj kumar requested task Hahah', 1, '2017-01-24 09:19:22', '2017-01-24 09:19:22'),
(55, 89, 0, 'task_requested', 'Dhiraj kumar requested task Hahsh', 1, '2017-01-24 09:20:10', '2017-01-24 09:20:10'),
(56, 89, 0, 'task_requested', 'Dhiraj kumar requested task Gagagah', 1, '2017-01-24 09:20:36', '2017-01-24 09:20:36'),
(57, 89, 0, 'task_deleted', 'Dhiraj kumar deleted task Hahah', 1, '2017-01-24 09:24:47', '2017-01-24 09:24:47'),
(58, 89, 0, 'task_requested', 'Dhiraj kumar requested task New task', 1, '2017-01-24 09:35:09', '2017-01-24 09:35:09'),
(59, 89, 0, 'task_deleted', 'Dhiraj kumar deleted task Gagagah', 1, '2017-01-24 09:35:27', '2017-01-24 09:35:27'),
(60, 89, 0, 'task_rescheduled', 'Dhiraj kumar rescheduled task Empty task', 1, '2017-01-24 09:37:22', '2017-01-24 09:37:22'),
(61, 89, 0, 'task_deleted', 'Dhiraj kumar deleted task Hahsh', 1, '2017-01-24 09:38:26', '2017-01-24 09:38:26'),
(62, 89, 0, 'task_deleted', 'Dhiraj kumar deleted task Empty task', 1, '2017-01-24 09:38:32', '2017-01-24 09:38:32'),
(63, 89, 0, 'task_requested', 'Dhiraj kumar requested task Latest task', 1, '2017-01-24 09:39:01', '2017-01-24 09:39:01'),
(64, 89, 0, 'task_rescheduled', 'Dhiraj kumar rescheduled task Latest task', 1, '2017-01-24 09:39:17', '2017-01-24 09:39:17'),
(65, 89, 0, 'task_completed', 'Dhiraj kumar completed task Latest task', 1, '2017-01-24 09:39:36', '2017-01-24 09:39:36'),
(66, 89, 0, 'task_requested', 'Dhiraj kumar requested task Teat task', 1, '2017-01-24 09:51:11', '2017-01-24 09:51:11'),
(67, 89, 0, 'task_rescheduled', 'Dhiraj kumar rescheduled task Teat task', 1, '2017-01-24 09:57:24', '2017-01-24 09:57:24'),
(68, 89, 0, 'task_requested', 'Dhiraj kumar requested task Emplty task', 1, '2017-01-24 09:58:11', '2017-01-24 09:58:11'),
(69, 89, 0, 'task_deleted', 'Dhiraj kumar deleted task Emplty task', 1, '2017-01-24 09:58:22', '2017-01-24 09:58:22'),
(70, 89, 0, 'task_requested', 'Dhiraj kumar requested task Empty task', 1, '2017-01-24 09:58:37', '2017-01-24 09:58:37'),
(71, 89, 0, 'task_rescheduled', 'Dhiraj kumar rescheduled task Empty task', 1, '2017-01-24 10:16:11', '2017-01-24 10:16:11'),
(72, 99, 0, 'task_requested', 'dhiraj requested task My property task', 1, '2017-01-24 10:19:23', '2017-01-24 10:19:23'),
(73, 99, 0, 'task_rescheduled', 'dhiraj rescheduled task My property task', 1, '2017-01-24 10:19:38', '2017-01-24 10:19:38'),
(74, 99, 0, 'task_deleted', 'dhiraj deleted task My property task', 1, '2017-01-24 10:20:20', '2017-01-24 10:20:20'),
(75, 89, 0, 'task_deleted', 'Dhiraj kumar deleted task Empty task', 1, '2017-01-24 10:35:03', '2017-01-24 10:35:03'),
(76, 89, 0, 'task_requested', 'Dhiraj kumar requested task Cleaning', 1, '2017-01-24 10:35:25', '2017-01-24 10:35:25'),
(77, 89, 0, 'task_rescheduled', 'Dhiraj kumar rescheduled task Cleaning', 1, '2017-01-24 10:35:55', '2017-01-24 10:35:55'),
(78, 89, 0, 'task_rescheduled', 'Dhiraj kumar rescheduled task Cleaning', 1, '2017-01-24 10:36:08', '2017-01-24 10:36:08'),
(79, 89, 0, 'task_rescheduled', 'Dhiraj kumar rescheduled task Cleaning', 1, '2017-01-24 10:36:41', '2017-01-24 10:36:41'),
(80, 99, 0, 'task_rescheduled', 'dhiraj rescheduled task Some Data', 1, '2017-01-24 10:39:34', '2017-01-24 10:39:34'),
(81, 99, 0, 'task_requested', 'dhiraj requested task Hshshs', 1, '2017-01-24 10:40:16', '2017-01-24 10:40:16'),
(82, 99, 0, 'task_requested', 'dhiraj requested task Ff', 1, '2017-01-24 10:54:58', '2017-01-24 10:54:58'),
(83, 99, 0, 'task_requested', 'dhiraj requested task Fuhhh', 1, '2017-01-24 11:16:44', '2017-01-24 11:16:44'),
(84, 99, 0, 'task_requested', 'dhiraj requested task Fuhhh', 1, '2017-01-24 11:18:01', '2017-01-24 11:18:01'),
(85, 99, 0, 'task_deleted', 'dhiraj deleted task Fuhhh', 1, '2017-01-24 11:29:19', '2017-01-24 11:29:19'),
(86, 89, 0, 'task_deleted', 'Dhiraj kumar deleted task Teat task', 0, '2017-01-24 11:37:33', '2017-01-24 11:43:05'),
(87, 95, 0, 'task_requested', 'debut houseowner requested task Testing 24', 1, '2017-01-24 12:07:34', '2017-01-24 12:07:34'),
(88, 95, 0, 'task_requested', 'debut houseowner requested task Tdghh', 1, '2017-01-24 12:13:15', '2017-01-24 12:13:15'),
(89, 95, 0, 'note_created', 'debut houseowner created a note', 1, '2017-01-24 12:14:33', '2017-01-24 12:14:33'),
(90, 95, 0, 'note_updated', 'debut houseowner edited note Tstin', 1, '2017-01-24 12:14:56', '2017-01-24 12:14:56'),
(91, 89, 0, 'task_completed', 'Dhiraj kumar completed task Cleaning', 1, '2017-01-24 13:20:55', '2017-01-24 13:20:55'),
(92, 89, 0, 'task_requested', 'Dhiraj kumar requested task Cleaning', 1, '2017-01-25 05:47:36', '2017-01-25 05:47:36'),
(93, 89, 0, 'task_requested', 'Dhiraj kumar requested task Washing', 1, '2017-01-25 05:48:04', '2017-01-25 05:48:04'),
(94, 89, 0, 'task_requested', 'Dhiraj kumar requested task Repairing', 1, '2017-01-25 05:48:43', '2017-01-25 05:48:43'),
(95, 89, 0, 'task_deleted', 'Dhiraj kumar deleted task Washing', 1, '2017-01-25 06:18:55', '2017-01-25 06:18:55'),
(96, 89, 0, 'task_requested', 'Dhiraj kumar requested task Clearing the floor', 1, '2017-01-25 06:57:37', '2017-01-25 06:57:37'),
(97, 89, 0, 'task_rescheduled', 'Dhiraj kumar rescheduled task Clearing the floor', 1, '2017-01-25 06:58:20', '2017-01-25 06:58:20'),
(98, 89, 0, 'task_requested', 'Dhiraj kumar requested task Empty task', 1, '2017-01-25 06:59:05', '2017-01-25 06:59:05'),
(99, 89, 0, 'task_rescheduled', 'Dhiraj kumar rescheduled task Empty task', 1, '2017-01-25 06:59:16', '2017-01-25 06:59:16'),
(100, 89, 0, 'task_deleted', 'Dhiraj kumar deleted task Empty task', 1, '2017-01-25 06:59:22', '2017-01-25 06:59:22'),
(101, 89, 0, 'task_rescheduled', 'Dhiraj kumar rescheduled task Clearing the floor', 0, '2017-01-25 07:12:51', '2017-01-25 09:09:58'),
(102, 89, 0, 'task_deleted', 'Dhiraj kumar deleted task Clearing the floor', 0, '2017-01-25 07:14:35', '2017-01-25 08:31:39'),
(103, 89, 0, 'note_updated', 'Dhiraj kumar edited note Need to urgent worker', 0, '2017-01-25 07:19:16', '2017-01-25 07:33:02'),
(104, 100, 0, 'task_requested', 'rehal amninder singh requested task Kitchen repare', 1, '2017-01-27 04:47:26', '2017-01-27 04:47:26'),
(105, 100, 0, 'task_deleted', 'rehal amninder singh deleted task Kitchen repare', 0, '2017-01-27 04:57:13', '2017-01-27 09:47:49'),
(106, 100, 0, 'task_requested', 'rehal amninder singh requested task Kitchen repare', 1, '2017-01-27 05:02:01', '2017-01-27 05:02:01'),
(107, 100, 0, 'task_requested', 'rehal amninder singh requested task Repare', 1, '2017-01-27 05:04:01', '2017-01-27 05:04:01'),
(108, 100, 0, 'note_created', 'rehal amninder singh created a note', 1, '2017-01-27 05:19:08', '2017-01-27 05:19:08'),
(109, 100, 0, 'task_completed', 'rehal amninder singh completed task Repare', 0, '2017-01-27 05:21:04', '2017-01-31 12:08:21'),
(110, 100, 0, 'task_requested', 'rehal amninder singh requested task Wires', 0, '2017-01-27 05:26:02', '2017-01-31 12:07:45'),
(111, 100, 0, 'note_updated', 'rehal amninder singh edited note Frffzdgg', 0, '2017-01-27 05:30:59', '2017-01-31 12:08:16'),
(112, 100, 0, 'task_completed', 'rehal amninder singh completed task Wires', 0, '2017-01-27 05:41:55', '2017-01-31 12:07:35'),
(113, 101, 0, 'task_requested', 'amnindersingh rehal requested task Bathroom', 0, '2017-01-27 05:54:54', '2017-01-27 09:47:56'),
(114, 101, 0, 'task_requested', 'amnindersingh rehal requested task Kitchen', 0, '2017-01-27 05:55:59', '2017-01-27 09:47:53'),
(115, 101, 0, 'task_requested', 'amnindersingh rehal requested task Kitchen 1', 0, '2017-01-27 05:56:25', '2017-01-27 09:47:46'),
(116, 101, 0, 'task_requested', 'amnindersingh rehal requested task Wed', 0, '2017-01-27 05:57:29', '2017-01-27 09:47:35'),
(117, 101, 0, 'note_created', 'amnindersingh rehal created a note', 0, '2017-01-27 05:58:46', '2017-01-27 09:47:44'),
(118, 99, 0, 'task_requested', 'dhiraj requested task New property', 0, '2017-01-27 06:18:23', '2017-01-27 09:47:39'),
(119, 99, 0, 'task_requested', 'dhiraj requested task Task Prop', 0, '2017-01-27 06:18:43', '2017-01-27 09:47:29'),
(120, 99, 0, 'task_requested', 'dhiraj requested task Task Store', 0, '2017-01-27 06:18:58', '2017-01-27 09:47:32'),
(121, 89, 0, 'task_deleted', 'Dhiraj kumar deleted task Repairing', 0, '2017-01-27 07:13:42', '2017-01-27 09:47:27'),
(122, 102, 0, 'task_requested', 'amninder requested task Jvjv', 0, '2017-01-27 09:32:18', '2017-01-27 09:47:29'),
(123, 102, 0, 'task_requested', 'amninder requested task Chchc', 0, '2017-01-27 09:33:45', '2017-01-27 09:47:24'),
(124, 102, 0, 'task_requested', 'amninder requested task Chchc', 0, '2017-01-27 09:33:51', '2017-01-27 09:47:21'),
(125, 102, 0, 'task_completed', 'amninder completed task Chchc', 0, '2017-01-27 09:34:04', '2017-01-27 09:47:08'),
(126, 102, 0, 'task_requested', 'amninder requested task Hchcc', 0, '2017-01-27 09:35:31', '2017-01-27 09:47:16'),
(127, 102, 0, 'note_created', 'amninder created a note', 0, '2017-01-27 09:36:50', '2017-01-27 09:47:12'),
(128, 89, 0, 'task_requested', 'Dhiraj kumar requested task Empty Task', 0, '2017-01-27 11:44:34', '2017-01-31 12:07:40'),
(129, 89, 0, 'task_requested', 'Dhiraj kumar requested task Empty Task One', 0, '2017-01-27 11:44:47', '2017-01-31 12:04:55'),
(130, 97, 0, 'task_requested', 'Jon Barlar requested task Faucet leaking', 0, '2017-01-30 11:28:45', '2017-01-31 12:07:04'),
(131, 95, 0, 'task_requested', 'debut houseowner requested task New sink', 0, '2017-01-30 16:19:11', '2017-01-31 12:05:20'),
(132, 95, 0, 'task_requested', 'debut houseowner requested task Misc task', 0, '2017-01-30 19:08:21', '2017-01-31 12:04:08'),
(133, 95, 0, 'note_created', 'debut houseowner created a note', 0, '2017-01-30 19:26:30', '2017-01-31 12:04:49'),
(134, 97, 0, 'note_created', 'Jon Barlar created a note', 0, '2017-01-30 19:26:48', '2017-01-31 12:03:56'),
(135, 97, 0, 'task_requested', 'Jon Barlar requested task Paint crown', 1, '2017-02-08 00:12:04', '2017-02-08 00:12:04'),
(136, 97, 0, 'task_requested', 'Jon Barlar requested task Repair door latch', 1, '2017-02-08 00:14:49', '2017-02-08 00:14:49'),
(137, 97, 0, 'task_requested', 'Jon Barlar requested task Replace bulbs', 1, '2017-02-08 00:18:14', '2017-02-08 00:18:14'),
(138, 97, 0, 'task_requested', 'Jon Barlar requested task Need trim over window', 1, '2017-02-08 00:19:19', '2017-02-08 00:19:19'),
(139, 97, 0, 'task_requested', 'Jon Barlar requested task Repair grout', 1, '2017-02-08 00:21:38', '2017-02-08 00:21:38'),
(140, 97, 0, 'task_requested', 'Jon Barlar requested task Touch up walls', 1, '2017-02-08 00:21:57', '2017-02-08 00:21:57'),
(141, 97, 0, 'task_requested', 'Jon Barlar requested task Repair soffit ceiling', 1, '2017-02-08 00:28:22', '2017-02-08 00:28:22'),
(142, 97, 0, 'task_requested', 'Jon Barlar requested task Paint window sill', 1, '2017-02-08 12:37:32', '2017-02-08 12:37:32'),
(143, 97, 0, 'task_rescheduled', 'Jon Barlar rescheduled task Faucet leaking', 1, '2017-02-11 19:46:28', '2017-02-11 19:46:28'),
(144, 97, 0, 'task_rescheduled', 'Jon Barlar rescheduled task Paint crown', 1, '2017-02-12 17:56:12', '2017-02-12 17:56:12'),
(145, 103, 0, 'task_requested', 'Jon Barlar requested task Paint siding', 1, '2017-02-16 22:54:12', '2017-02-16 22:54:12'),
(146, 103, 0, 'task_requested', 'Jon Barlar requested task Back door latch', 1, '2017-02-16 23:17:10', '2017-02-16 23:17:10'),
(147, 103, 0, 'task_rescheduled', 'Jon Barlar rescheduled task Back door latch', 1, '2017-02-16 23:17:43', '2017-02-16 23:17:43'),
(148, 103, 0, 'task_requested', 'Jon Barlar requested task Shower faucet', 1, '2017-02-16 23:19:15', '2017-02-16 23:19:15'),
(149, 103, 0, 'task_requested', 'Jon Barlar requested task Kitchen sink', 1, '2017-02-16 23:20:34', '2017-02-16 23:20:34'),
(150, 97, 0, 'task_requested', 'Jon Barlar requested task Broken window', 1, '2017-02-21 00:09:29', '2017-02-21 00:09:29'),
(151, 104, 0, 'task_requested', 'Magnus Hildur requested task Clean floor', 1, '2017-02-21 06:57:41', '2017-02-21 06:57:41'),
(152, 104, 0, 'task_requested', 'Magnus Hildur requested task Fix kitchen sink', 1, '2017-02-21 07:04:09', '2017-02-21 07:04:09'),
(153, 105, 0, 'note_created', 'j ginter created a note', 1, '2017-02-21 07:33:55', '2017-02-21 07:33:55'),
(154, 105, 0, 'task_requested', 'j ginter requested task Fix window', 1, '2017-02-21 07:36:45', '2017-02-21 07:36:45'),
(155, 105, 0, 'task_requested', 'j ginter requested task Clean carpet', 1, '2017-02-21 07:41:14', '2017-02-21 07:41:14'),
(156, 105, 0, 'task_requested', 'j ginter requested task Replace doorknobs', 1, '2017-02-21 08:15:00', '2017-02-21 08:15:00'),
(157, 105, 0, 'task_rescheduled', 'j ginter rescheduled task Replace doorknobs', 1, '2017-02-21 08:17:20', '2017-02-21 08:17:20'),
(158, 105, 0, 'task_rescheduled', 'j ginter rescheduled task Fix window', 1, '2017-02-21 08:18:25', '2017-02-21 08:18:25'),
(159, 105, 0, 'task_requested', 'j ginter requested task Fix stairway', 1, '2017-02-21 08:21:41', '2017-02-21 08:21:41'),
(160, 106, 0, 'task_requested', 'abhijeet singh requested task Abcd', 1, '2017-02-22 09:19:18', '2017-02-22 09:19:18'),
(161, 106, 0, 'note_created', 'abhijeet singh created a note', 1, '2017-02-22 09:24:14', '2017-02-22 09:24:14'),
(162, 106, 0, 'note_updated', 'abhijeet singh edited note FifficfuJxjduxu', 1, '2017-02-22 09:24:27', '2017-02-22 09:24:27'),
(163, 105, 0, 'task_requested', 'j ginter requested task Porch rail fix', 1, '2017-02-23 13:08:22', '2017-02-23 13:08:22'),
(164, 97, 0, 'task_requested', 'Jon Barlar requested task Broken door', 1, '2017-02-25 00:14:07', '2017-02-25 00:14:07'),
(165, 96, 0, 'note_created', 'debut Realtor created a note', 1, '2017-03-01 04:38:46', '2017-03-01 04:38:46'),
(166, 96, 0, 'note_updated', 'debut Realtor edited note Dygfggh', 1, '2017-03-01 04:39:00', '2017-03-01 04:39:00'),
(167, 96, 0, 'task_requested', 'debut Realtor requested task Abcd', 1, '2017-03-01 07:13:54', '2017-03-01 07:13:54'),
(168, 96, 0, 'task_deleted', 'debut Realtor deleted task Abcd', 1, '2017-03-01 07:14:20', '2017-03-01 07:14:20'),
(169, 96, 0, 'task_requested', 'debut Realtor requested task ,mf', 1, '2017-03-01 13:26:52', '2017-03-01 13:26:52'),
(170, 96, 0, 'note_updated', 'debut Realtor edited note Dygfggh', 1, '2017-03-01 13:39:34', '2017-03-01 13:39:34'),
(171, 96, 0, 'task_requested', 'debut Realtor requested task Kjgkjhjk', 1, '2017-03-01 13:49:35', '2017-03-01 13:49:35'),
(172, 96, 0, 'task_requested', 'debut Realtor requested task Jkhjkhjkh', 1, '2017-03-01 13:59:29', '2017-03-01 13:59:29'),
(173, 96, 0, 'note_created', 'debut Realtor created a note', 1, '2017-03-01 14:00:14', '2017-03-01 14:00:14'),
(174, 96, 0, 'task_rescheduled', 'debut Realtor rescheduled task Kjgkjhjk', 1, '2017-03-02 09:53:05', '2017-03-02 09:53:05'),
(175, 96, 0, 'task_rescheduled', 'debut Realtor rescheduled task Kjgkjhjk', 1, '2017-03-02 09:53:16', '2017-03-02 09:53:16'),
(176, 96, 0, 'task_requested', 'debut Realtor requested task New task', 1, '2017-03-02 11:05:17', '2017-03-02 11:05:17'),
(177, 95, 0, 'task_completed', 'debut houseowner completed task Fix shower', 1, '2017-03-05 18:58:24', '2017-03-05 18:58:24'),
(178, 95, 0, 'task_requested', 'debut houseowner requested task Hari', 1, '2017-03-07 07:14:52', '2017-03-07 07:14:52'),
(179, 95, 0, 'task_requested', 'debut houseowner hsjsjsjsks requested task Ghhj', 1, '2017-03-08 04:28:18', '2017-03-08 04:28:18'),
(180, 95, 0, 'task_completed', 'debut houseowner hsjsjsjsks completed task New sink', 0, '2017-03-08 04:31:57', '2017-03-08 04:39:00');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE IF NOT EXISTS `contacts` (
  `id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `interested_in` int(11) NOT NULL,
  `name` varchar(120) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `zip` int(11) DEFAULT NULL,
  `number` varchar(15) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subject` varchar(120) NOT NULL,
  `message` mediumtext NOT NULL,
  `comment` text NOT NULL,
  `status` int(11) NOT NULL COMMENT '0:Deactive, 1:Active,2:delete',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `product_id`, `interested_in`, `name`, `address`, `city`, `state`, `zip`, `number`, `email`, `subject`, `message`, `comment`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(20, 13, 11, 'Harpartap', 'Patiala, Punjab, India', 'Patiala', 'Punjab', 147001, '(+34) 54563-456', 'dhilon006@gmail.com', '', '', 'err_response.exception_message_fronterr_response.exception_message_fronterr_response.exception_message_fronterr_response.exception_message_front', 0, '2016-06-25 11:22:36', '2016-06-25 11:22:36', NULL),
(21, NULL, 11, 'Harpartap', 'Patiala, Punjab, India', 'Patiala', 'Punjab', 147001, '(+34) 52345-234', 'dhilon006@gmail.com', '', '', 'egsdfgsdfgsdfgdsf df gdf gsdf gsdf gsdfg sdf gsdf gsdf gsdfg sdfg', 0, '2016-06-25 11:35:33', '2016-06-25 11:35:33', NULL),
(22, 11, 11, 'Harpartap', 'Patiala, Punjab, India', 'Patiala', 'Punjab', 147001, '(+34) 56345-634', 'dhilon006@gmail.com', '', 'ffgsdfgsdf ffgsdfgsdfffgsdfgsdfffgsdfgsdfffgsdfgsdfffgsdfgsdfffgsdfgsdfffgsdfgsdfffgsdfgsdfffgsdfgsdfffgsdfgsdfffgsdfgsdfffgsdfgsdfffgsdfgsdfffgsdfgsdfffgsdfgsdfffgsdfgsdfffgsdfgsdfffgsdfgsdf', 'dsfgsdfgdsfg sdfg sd\r\nfg \r\nsdf\r\ng sd\r\nfg\r\nsdfgsdfg', 0, '2016-06-25 11:37:24', '2016-06-25 11:43:55', NULL),
(23, NULL, 11, 'Honey', 'Patiala, Punjab, India', 'Patiala', 'Punjab', 147001, '(+34) 65346-534', 'dhilon006@gmail.com', '', '', 'dsfgsdfgsdfg dsfgsdfgsdfgdsfgsdfgsdfgdsfgsdfgsdfgdsfgsdfgsdfgdsfgsdfgsdfgdsfgsdfgsdfgdsfgsdfgsdfgdsfgsdfgsdfgdsfgsdfgsdfgdsfgsdfgsdfgdsfgsdfgsdfg', 0, '2016-06-25 11:41:53', '2016-06-25 11:41:53', NULL),
(24, 2, 11, 'rtwertewr', 'Chandigarh, India', 'Chandigarh', 'Chandigarh', 160017, '(+89) 78456-421', 'dilpreet.kaur@debutinfotech.com', '', '', 'dghdfghfghhh', 0, '2016-06-25 11:48:39', '2016-06-25 11:48:39', NULL),
(25, 2, 11, 'rwerterwt', 'Chandigarh, India', 'Chandigarh', 'Chandigarh', 160017, '(+97) 98456-451', 'dilpreet.kaur@debutinfotech.com', '', '', 'bxcvbxcvb', 0, '2016-06-25 11:50:15', '2016-06-25 11:50:15', NULL),
(26, 2, 11, 'dilpreet', 'Chandigarh, India', 'Chandigarh', 'Chandigarh', 160017, '(+95) 45646-546', 'dilpreet.kaur@debutinfotech.com', '', '', 'hgjgjhgjkh', 0, '2016-06-25 11:53:46', '2016-06-25 11:53:46', NULL),
(27, 2, 11, 'gfdgfsdfg', 'Chandigarh, India', 'Chandigarh', 'Chandigarh', 160017, '(+98) 79746-545', 'dilpreet.kaur@debutinfotech.com', '', '', 'gsdfgcvbcxvbcxvb', 0, '2016-06-25 12:01:02', '2016-06-25 12:01:02', NULL),
(28, 2, 11, 'gsdfgds', 'Chandigarh, India', 'Chandigarh', 'Chandigarh', 160017, '(+98) 74654-213', 'dilpreet.kaur@debutinfotech.com', '', '', 'vxcvcvdsfgdfg', 0, '2016-06-25 12:05:01', '2016-06-25 12:05:01', NULL),
(29, 2, 11, 'dgsdfg', 'Chandigarh, India', 'Chandigarh', 'Chandigarh', 160017, '(+87) 98465-454', 'dilpreet.kaur@debutinfotech.com', '', '', 'rtwertertrttr', 0, '2016-06-25 12:08:04', '2016-06-25 12:08:04', NULL),
(30, NULL, 11, 'asdf', 'adfk', 'lajsdfkl', 'kljadf', 12321312, '(+23) 43432-432', 'guptamukul5@gmail.com', '', '', 'asfasfdas', 0, '2016-06-25 15:25:21', '2016-06-25 15:25:21', NULL),
(31, NULL, 12, 'Harpartap', 'Holland', 'Patiala', 'Punjab', 2341234, '(+21) 34123-412', 'dhilon006@gmail.com', '', '', 'dfsgsdfgsdfg', 0, '2016-06-26 10:48:04', '2016-06-26 10:48:04', NULL),
(32, NULL, 11, 'gfdgdfgdfgdfgfdgfdgdfdfgdgfdgd', '87698 East Creek Ridge Road, Government Camp, OR, United States', 'Government Camp', 'Oregon', 97028, '(+76) 78687-887', 'rajat.verma@debutinfotech.com', '', 'hello user... this is for testing.', 'lorem ipsum dolor amet lorem ipsum dolor amet lorem ipsum dolor amet', 0, '2016-06-27 09:12:34', '2016-06-28 09:34:36', NULL),
(33, 2, 11, 'dilpreet', 'Chandigarh, India', 'Chandigarh', 'Chandigarh', 160017, '(+98) 46551-321', 'dilpreet.kaur@debutinfotech.com', '', '', 'gdsfgsdfgsdfgdsf', 0, '2016-06-27 09:49:01', '2016-06-27 09:49:01', NULL),
(34, 13, 11, 'diljeetsingh', 'Chandigarh, India', 'Chandigarh', 'Chandigarh', 160017, '(+84) 65465-465', 'dilpreet.kaur@debutinfotech.com', '', '', 'xdfgfgdfgdg', 0, '2016-06-27 09:51:00', '2016-06-27 09:51:00', NULL),
(35, 13, 11, 'dfgsdfg', 'Chandigarh, India', 'Chandigarh', 'Chandigarh', 160017, '(+98) 46513-213', 'dilpreet.kaur@debutinfotech.com', '', '', 'fgsdfgsdfgg', 0, '2016-06-27 11:05:00', '2016-06-27 11:05:00', NULL),
(36, 39, 11, 'Aman', '33, Shivalik City, Kharar, Punjab, India', 'Kharar', 'Punjab', 140301, '(+91) 97977-979', 'rajat.verma@debutinfotech.com', '', '', 'lorem ipsum dolor amet lorem ipsum dolor amet lorem ipsum dolor amet lorem ipsum dolor amet lorem ipsum dolor amet lorem ipsum dolor amet', 0, '2016-06-28 07:20:54', '2016-06-28 07:20:54', NULL),
(37, NULL, 11, 'kjk', 'KHJ, Khajraha Railway Station Road, Khajuraha Bujurg, Uttar Pradesh, India', 'Khajuraha Bujurg', 'Uttar Pradesh', 284120, '(+75) 67224-254', 'rajat.debut6@gmail.com', '', '', 'gtgrgrfrf', 0, '2016-06-28 09:06:46', '2016-06-28 09:06:46', NULL),
(38, NULL, 12, 'Harpartap', 'Hollywood, Los Angeles, CA, United States', 'Los Angeles', 'California', 34534534, '(+34) 53453-453', 'dhilon006@gmail.com', '', '', 'ssdfsdfg', 0, '2016-06-28 09:22:26', '2016-06-28 09:22:26', NULL),
(39, NULL, 11, 'sfdsdf', 'fdsfdsa, Ozark, MO, United States', 'Ozark', 'Missouri', 65721, '(+43) 24234-234', 'sdfds@hfhfd.dfd', '', '', 'cbgvcbgd', 0, '2016-06-28 12:30:37', '2016-06-28 12:30:37', NULL),
(40, NULL, 11, 'gfdghfg', 'Chandigarh, India', 'Chandigarh', 'Chandigarh', 160017, '(+97) 87651-465', 'dilpreet.kaur@debutinfotech.com', '', '', 'bxcvbxcbc', 0, '2016-06-29 03:52:25', '2016-06-29 03:52:25', NULL),
(41, NULL, 12, 'hjkghj', 'Hanover, Germany', 'Hanover', 'Lower Saxony', 3456, '(+32) 45234-523', 'dhilon006@gmail.com', '', '', 'gfsdfgsdfgsdfgsdfg', 0, '2016-06-29 09:06:19', '2016-06-29 09:06:19', NULL),
(42, 21, 11, 'Aman', '33, Kharar-Kurali Highway, Guru Teg Bahadur Nagar, Kharar, Punjab, India', 'Kharar', 'Punjab', 140301, '(+91) 97979-797', 'rajat.debut6@gmail.com', '', '', 'lorem ipsum dolor amet lorem ipsum dolor amet lorem ipsum dolor amet lorem ipsum dolor amet lorem ipsum dolor amet lorem ipsum dolor amet ', 0, '2016-06-29 11:25:52', '2016-06-29 11:25:52', NULL),
(43, 40, 11, 'Mukul', '34, Madhya Marg, Sector 26, Chandigarh, India', 'Chandigarh', 'Chandigarh', 160019, '(+91) 94667-647', 'guptamukul5@gmail.com', '', '', 'I want this product.', 0, '2016-07-03 16:25:46', '2016-07-03 16:25:46', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `crone_jobs`
--

CREATE TABLE IF NOT EXISTS `crone_jobs` (
  `id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `action_status` int(11) NOT NULL DEFAULT '0',
  `description` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=372 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `crone_jobs`
--

INSERT INTO `crone_jobs` (`id`, `type`, `status`, `action_status`, `description`, `created_at`, `updated_at`) VALUES
(1, 'task', 'created', 0, '[{"id":"1","task_name":"Bathroom tiels","client_id":"87","note_detail":"Tiels are not proper fixed","priority":"1","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-02","start_datetime":"2017-01-02 05:10:00","end_datetime":"2017-01-02 11:10:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"2","attribute_id":"4","status":"1","created_at":"2017-01-02 05:06:29","updated_at":"2017-01-02 05:06:29","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-02 05:06:29', '2017-01-02 05:06:29'),
(2, 'task', 'created', 0, '[{"id":"2","task_name":"Bedroom walls","client_id":"87","note_detail":"Bedrooms walls color changed","priority":"2","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-03","start_datetime":"2017-01-03 05:11:00","end_datetime":"2017-01-03 08:11:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"2","attribute_id":"5","status":"1","created_at":"2017-01-02 05:07:31","updated_at":"2017-01-02 05:07:31","deleted_at":"0000-00-00 00:00:00","task_documents":[{"id":"1","type":"2","type_id":"2","filename":"http:\\/\\/frontline.debutinfotech.com\\/uploads\\/userfiles\\/thumb_1483333651.jpeg","created_at":"2017-01-02 05:07:32","updated_at":"2017-01-02 05:07:32","deleted_at":null}]}]', '2017-01-02 05:07:32', '2017-01-02 05:07:32'),
(3, 'task', 'created', 0, '[{"id":"3","task_name":"Kitchen","client_id":"87","note_detail":"Kithen dorrs","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-04","start_datetime":"2017-01-04 05:21:00","end_datetime":"2017-01-04 10:21:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"2","attribute_id":"6","status":"1","created_at":"2017-01-02 05:17:44","updated_at":"2017-01-02 05:17:44","deleted_at":"0000-00-00 00:00:00","task_documents":[{"id":"2","type":"2","type_id":"3","filename":"http:\\/\\/frontline.debutinfotech.com\\/uploads\\/userfiles\\/thumb_1483334263.jpeg","created_at":"2017-01-02 05:17:44","updated_at":"2017-01-02 05:17:44","deleted_at":null}]}]', '2017-01-02 05:17:44', '2017-01-02 05:17:44'),
(4, 'task', 'completed', 0, '[{"id":"1","task_name":"Bathroom tiels","client_id":"87","note_detail":"Tiels are not proper fixed","priority":"1","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-02","start_datetime":"2017-01-02 05:10:00","end_datetime":"2017-01-02 11:10:00","task_completed_date":"2017-01-02 05:29:23","rating":"4","comments":"","property_id":"2","attribute_id":"4","status":"4","created_at":"2017-01-02 05:06:29","updated_at":"2017-01-02 05:29:23","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-02 05:29:23', '2017-01-02 05:29:23'),
(5, 'task', 'completed', 0, '[{"id":"3","task_name":"Kitchen","client_id":"87","note_detail":"Kithen dorrs","priority":"3","document_id":"0","technician_id":"88","assigned_date":"2017-01-02","scheduled_date":"2017-01-06","start_datetime":"2017-01-06 05:21:00","end_datetime":"2017-01-06 10:21:00","task_completed_date":"2017-01-02 05:29:54","rating":"3","comments":"","property_id":"2","attribute_id":"6","status":"4","created_at":"2017-01-02 05:17:44","updated_at":"2017-01-02 05:29:54","deleted_at":"0000-00-00 00:00:00","task_documents":[{"id":"2","type":"2","type_id":"3","filename":"http:\\/\\/frontline.debutinfotech.com\\/uploads\\/userfiles\\/thumb_1483334263.jpeg","created_at":"2017-01-02 05:17:44","updated_at":"2017-01-02 05:17:44","deleted_at":null}]}]', '2017-01-02 05:29:54', '2017-01-02 05:29:54'),
(6, 'task', 'created', 0, '[{"id":"4","task_name":"Bathroom tiles","client_id":"87","note_detail":"Bathroom tiels are destryed","priority":"1","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-02","start_datetime":"2017-01-02 05:38:00","end_datetime":"2017-01-02 08:38:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"2","attribute_id":"5","status":"1","created_at":"2017-01-02 05:33:41","updated_at":"2017-01-02 05:33:41","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-02 05:33:41', '2017-01-02 05:33:41'),
(7, 'task', 'completed', 0, '[{"id":"4","task_name":"Bathroom tiles","client_id":"87","note_detail":"Bathroom tiels are destryed","priority":"1","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-02","start_datetime":"2017-01-02 05:38:00","end_datetime":"2017-01-02 08:38:00","task_completed_date":"2017-01-02 05:34:18","rating":"3","comments":"","property_id":"2","attribute_id":"5","status":"4","created_at":"2017-01-02 05:33:41","updated_at":"2017-01-02 05:34:18","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-02 05:34:18', '2017-01-02 05:34:18'),
(8, 'task', 'created', 0, '[{"id":"5","task_name":"Task","client_id":"87","note_detail":"Sine","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-02","start_datetime":"2017-01-02 05:39:00","end_datetime":"2017-01-02 05:41:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"1","attribute_id":"3","status":"1","created_at":"2017-01-02 05:35:03","updated_at":"2017-01-02 05:35:03","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-02 05:35:03', '2017-01-02 05:35:03'),
(9, 'task', 'completed', 0, '[{"id":"5","task_name":"Task","client_id":"87","note_detail":"Sine","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-02","start_datetime":"2017-01-02 05:39:00","end_datetime":"2017-01-02 05:41:00","task_completed_date":"2017-01-02 05:35:15","rating":"3","comments":"","property_id":"1","attribute_id":"3","status":"4","created_at":"2017-01-02 05:35:03","updated_at":"2017-01-02 05:35:15","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-02 05:35:15', '2017-01-02 05:35:15'),
(10, 'task', 'created', 0, '[{"id":"6","task_name":"Dhhdh","client_id":"87","note_detail":"Bxhdh","priority":"1","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-02","start_datetime":"2017-01-02 05:46:00","end_datetime":"2017-01-02 08:46:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"2","attribute_id":"4","status":"1","created_at":"2017-01-02 05:41:39","updated_at":"2017-01-02 05:41:39","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-02 05:41:39', '2017-01-02 05:41:39'),
(11, 'task', 'created', 0, '[{"id":"7","task_name":"Bedroom","client_id":"87","note_detail":"Wallpaper","priority":"1","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-02","start_datetime":"2017-01-02 05:48:00","end_datetime":"2017-01-02 07:48:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"1","attribute_id":"1","status":"1","created_at":"2017-01-02 05:43:54","updated_at":"2017-01-02 05:43:54","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-02 05:43:54', '2017-01-02 05:43:54'),
(12, 'task', 'created', 0, '[{"id":"8","task_name":"TASK","client_id":"89","note_detail":"SOLSDJF","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-02","start_datetime":"2017-01-02 05:51:00","end_datetime":"2017-01-02 05:53:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"3","attribute_id":"7","status":"1","created_at":"2017-01-02 05:46:55","updated_at":"2017-01-02 05:46:55","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-02 05:46:55', '2017-01-02 05:46:55'),
(13, 'task', 'completed', 0, '[{"id":"8","task_name":"TASK","client_id":"89","note_detail":"SOLSDJF","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-02","start_datetime":"2017-01-02 05:51:00","end_datetime":"2017-01-02 05:53:00","task_completed_date":"2017-01-02 05:47:00","rating":"3","comments":"","property_id":"3","attribute_id":"7","status":"4","created_at":"2017-01-02 05:46:55","updated_at":"2017-01-02 05:47:00","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-02 05:47:00', '2017-01-02 05:47:00'),
(14, 'note', 'created', 0, '[{"id":"1","user_id":"87","client_notes":"Chnchfhf hfjfhfh hfhfhfh hfhfhfh hfhfhhf hfhfhfh hfhfhfh hfhfhfhd hfhfhfhhfh hfhfhfhhfhfhfhfbbfbfhhf","title":"Ncncnxnfnc fnnfjfhf nfjfjjfjf hfhfhfhhf hfhhffhfh","created_at":"2017-01-02 05:47:13","updated_at":"2017-01-02 05:47:13","deleted_at":"0000-00-00 00:00:00"}]', '2017-01-02 05:47:13', '2017-01-02 05:47:13'),
(15, 'task', 'created', 0, '[{"id":"9","task_name":"Tasks","client_id":"89","note_detail":"Asd","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-04","start_datetime":"2017-01-04 05:53:00","end_datetime":"2017-01-04 05:58:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"3","attribute_id":"7","status":"1","created_at":"2017-01-02 05:49:22","updated_at":"2017-01-02 05:49:22","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-02 05:49:22', '2017-01-02 05:49:22'),
(16, 'task', 'completed', 0, '[{"id":"9","task_name":"Tasks","client_id":"89","note_detail":"Asd","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-04","start_datetime":"2017-01-04 05:53:00","end_datetime":"2017-01-04 05:58:00","task_completed_date":"2017-01-02 05:49:28","rating":"3","comments":"","property_id":"3","attribute_id":"7","status":"4","created_at":"2017-01-02 05:49:22","updated_at":"2017-01-02 05:49:28","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-02 05:49:28', '2017-01-02 05:49:28'),
(17, 'task', 'created', 0, '[{"id":"10","task_name":"New task","client_id":"89","note_detail":"Sadsadsad","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-03","start_datetime":"2017-01-03 05:55:00","end_datetime":"2017-01-03 05:56:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"3","attribute_id":"7","status":"1","created_at":"2017-01-02 05:51:22","updated_at":"2017-01-02 05:51:22","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-02 05:51:22', '2017-01-02 05:51:22'),
(18, 'task', 'completed', 0, '[{"id":"10","task_name":"New task","client_id":"89","note_detail":"Sadsadsad","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-03","start_datetime":"2017-01-03 05:55:00","end_datetime":"2017-01-03 05:56:00","task_completed_date":"2017-01-02 05:53:01","rating":"4","comments":"","property_id":"3","attribute_id":"7","status":"4","created_at":"2017-01-02 05:51:22","updated_at":"2017-01-02 05:53:01","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-02 05:53:01', '2017-01-02 05:53:01'),
(19, 'task', 'created', 0, '[{"id":"11","task_name":"Tap repair","client_id":"90","note_detail":"Tap is not working fine","priority":"2","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-02","start_datetime":"2017-01-02 08:30:00","end_datetime":"2017-01-02 09:30:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"4","attribute_id":"9","status":"1","created_at":"2017-01-02 06:12:17","updated_at":"2017-01-02 06:12:17","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-02 06:12:17', '2017-01-02 06:12:17'),
(20, 'task', 'created', 0, '[{"id":"12","task_name":"Painting","client_id":"90","note_detail":"Painting","priority":"2","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-02","start_datetime":"2017-01-02 08:40:00","end_datetime":"2017-01-02 11:45:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"4","attribute_id":"8","status":"1","created_at":"2017-01-02 06:20:35","updated_at":"2017-01-02 06:20:35","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-02 06:20:35', '2017-01-02 06:20:35'),
(21, 'task', 'created', 0, '[{"id":"13","task_name":"Dhdhd","client_id":"87","note_detail":"Hdhdhd","priority":"1","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-02","start_datetime":"2017-01-02 06:41:00","end_datetime":"2017-01-02 08:41:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"5","attribute_id":"11","status":"1","created_at":"2017-01-02 06:37:09","updated_at":"2017-01-02 06:37:09","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-02 06:37:09', '2017-01-02 06:37:09'),
(22, 'task', 'completed', 0, '[{"id":"13","task_name":"Dhdhd","client_id":"87","note_detail":"Hdhdhd","priority":"1","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-02","start_datetime":"2017-01-02 06:41:00","end_datetime":"2017-01-02 08:41:00","task_completed_date":"2017-01-02 06:37:14","rating":"4","comments":"Cbbcb","property_id":"5","attribute_id":"11","status":"4","created_at":"2017-01-02 06:37:09","updated_at":"2017-01-02 06:37:14","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-02 06:37:15', '2017-01-02 06:37:15'),
(23, 'task', 'created', 0, '[{"id":"14","task_name":"Sokme name","client_id":"89","note_detail":"Sdfsdfsdf","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-02","start_datetime":"2017-01-02 06:43:00","end_datetime":"2017-01-02 06:45:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"6","attribute_id":"14","status":"1","created_at":"2017-01-02 06:38:57","updated_at":"2017-01-02 06:38:57","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-02 06:38:57', '2017-01-02 06:38:57'),
(24, 'task', 'completed', 0, '[{"id":"14","task_name":"Sokme name","client_id":"89","note_detail":"Sdfsdfsdf","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-02","start_datetime":"2017-01-02 06:43:00","end_datetime":"2017-01-02 06:45:00","task_completed_date":"2017-01-02 06:39:11","rating":"3","comments":"Some commecnts","property_id":"6","attribute_id":"14","status":"4","created_at":"2017-01-02 06:38:57","updated_at":"2017-01-02 06:39:11","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-02 06:39:11', '2017-01-02 06:39:11'),
(25, 'task', 'created', 0, '[{"id":"15","task_name":"Soem more commecnts","client_id":"89","note_detail":"Sdfsdf","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-02","start_datetime":"2017-01-02 06:43:00","end_datetime":"2017-01-02 06:44:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"6","attribute_id":"14","status":"1","created_at":"2017-01-02 06:39:34","updated_at":"2017-01-02 06:39:34","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-02 06:39:34', '2017-01-02 06:39:34'),
(26, 'task', 'completed', 0, '[{"id":"15","task_name":"Soem more commecnts","client_id":"89","note_detail":"Sdfsdf","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-02","start_datetime":"2017-01-02 06:43:00","end_datetime":"2017-01-02 06:44:00","task_completed_date":"2017-01-02 06:39:52","rating":"3","comments":"","property_id":"6","attribute_id":"14","status":"4","created_at":"2017-01-02 06:39:34","updated_at":"2017-01-02 06:39:52","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-02 06:39:52', '2017-01-02 06:39:52'),
(27, 'task', 'created', 0, '[{"id":"16","task_name":"Erftt","client_id":"89","note_detail":"Etert","priority":"1","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-02","start_datetime":"2017-01-02 06:44:00","end_datetime":"2017-01-02 06:50:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"6","attribute_id":"14","status":"1","created_at":"2017-01-02 06:40:11","updated_at":"2017-01-02 06:40:11","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-02 06:40:11', '2017-01-02 06:40:11'),
(28, 'task', 'completed', 0, '[{"id":"16","task_name":"Erftt","client_id":"89","note_detail":"Etert","priority":"1","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-02","start_datetime":"2017-01-02 06:44:00","end_datetime":"2017-01-02 06:50:00","task_completed_date":"2017-01-02 06:44:43","rating":"3","comments":"","property_id":"6","attribute_id":"14","status":"4","created_at":"2017-01-02 06:40:11","updated_at":"2017-01-02 06:44:43","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-02 06:44:43', '2017-01-02 06:44:43'),
(29, 'task', 'created', 0, '[{"id":"17","task_name":"Skldfjlsdfk","client_id":"89","note_detail":"Sdfdfs","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-02","start_datetime":"2017-01-02 06:50:00","end_datetime":"2017-01-02 06:54:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"6","attribute_id":"14","status":"1","created_at":"2017-01-02 06:45:40","updated_at":"2017-01-02 06:45:40","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-02 06:45:40', '2017-01-02 06:45:40'),
(30, 'task', 'completed', 0, '[{"id":"17","task_name":"Skldfjlsdfk","client_id":"89","note_detail":"Sdfdfs","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-02","start_datetime":"2017-01-02 06:50:00","end_datetime":"2017-01-02 06:54:00","task_completed_date":"2017-01-02 06:45:51","rating":"3","comments":"Asd","property_id":"6","attribute_id":"14","status":"4","created_at":"2017-01-02 06:45:40","updated_at":"2017-01-02 06:45:51","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-02 06:45:51', '2017-01-02 06:45:51'),
(31, 'task', 'created', 0, '[{"id":"18","task_name":"Sadsad","client_id":"89","note_detail":"Sadsad","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-02","start_datetime":"2017-01-02 06:50:00","end_datetime":"2017-01-02 06:53:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"6","attribute_id":"14","status":"1","created_at":"2017-01-02 06:46:02","updated_at":"2017-01-02 06:46:02","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-02 06:46:02', '2017-01-02 06:46:02'),
(32, 'task', 'completed', 0, '[{"id":"18","task_name":"Sadsad","client_id":"89","note_detail":"Sadsad","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-02","start_datetime":"2017-01-02 06:50:00","end_datetime":"2017-01-02 06:53:00","task_completed_date":"2017-01-02 06:48:18","rating":"3","comments":"","property_id":"6","attribute_id":"14","status":"4","created_at":"2017-01-02 06:46:02","updated_at":"2017-01-02 06:48:18","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-02 06:48:18', '2017-01-02 06:48:18'),
(33, 'task', 'created', 0, '[{"id":"19","task_name":"Asdasd","client_id":"89","note_detail":"Asdasdds","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-02","start_datetime":"2017-01-02 06:52:00","end_datetime":"2017-01-02 06:54:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"6","attribute_id":"14","status":"1","created_at":"2017-01-02 06:48:30","updated_at":"2017-01-02 06:48:30","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-02 06:48:30', '2017-01-02 06:48:30'),
(34, 'task', 'completed', 0, '[{"id":"19","task_name":"Asdasd","client_id":"89","note_detail":"Asdasdds","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-02","start_datetime":"2017-01-02 06:52:00","end_datetime":"2017-01-02 06:54:00","task_completed_date":"2017-01-02 06:50:00","rating":"3","comments":"Tfyt","property_id":"6","attribute_id":"14","status":"4","created_at":"2017-01-02 06:48:30","updated_at":"2017-01-02 06:50:00","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-02 06:50:00', '2017-01-02 06:50:00'),
(35, 'task', 'created', 0, '[{"id":"20","task_name":"Asdsad","client_id":"89","note_detail":"Asdasd","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-02","start_datetime":"2017-01-02 06:55:00","end_datetime":"2017-01-02 07:02:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"6","attribute_id":"14","status":"1","created_at":"2017-01-02 06:50:39","updated_at":"2017-01-02 06:50:39","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-02 06:50:39', '2017-01-02 06:50:39'),
(36, 'task', 'deleted', 0, '{"id":"20","task_name":"Asdsad","client_id":"89","note_detail":"Asdasd","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-02","start_datetime":"2017-01-02 06:55:00","end_datetime":"2017-01-02 07:02:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"6","attribute_id":"14","status":"1","created_at":"2017-01-02 06:50:39","updated_at":"2017-01-02 06:50:39","deleted_at":"0000-00-00 00:00:00"}', '2017-01-02 06:50:48', '2017-01-02 06:50:48'),
(37, 'task', 'created', 0, '[{"id":"21","task_name":"Task","client_id":"89","note_detail":"Kasdjkdsaj","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-02","start_datetime":"2017-01-02 06:55:00","end_datetime":"2017-01-02 06:59:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"6","attribute_id":"14","status":"1","created_at":"2017-01-02 06:51:11","updated_at":"2017-01-02 06:51:11","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-02 06:51:11', '2017-01-02 06:51:11'),
(38, 'task', 'completed', 0, '[{"id":"21","task_name":"Task","client_id":"89","note_detail":"Kasdjkdsaj","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-02","start_datetime":"2017-01-02 06:55:00","end_datetime":"2017-01-02 06:59:00","task_completed_date":"2017-01-02 06:51:15","rating":"3","comments":"","property_id":"6","attribute_id":"14","status":"4","created_at":"2017-01-02 06:51:11","updated_at":"2017-01-02 06:51:15","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-02 06:51:15', '2017-01-02 06:51:15'),
(39, 'task', 'created', 0, '[{"id":"22","task_name":"Some task","client_id":"89","note_detail":"Sdfpofd","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-02","start_datetime":"2017-01-02 07:00:00","end_datetime":"2017-01-02 07:06:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"6","attribute_id":"14","status":"1","created_at":"2017-01-02 06:55:50","updated_at":"2017-01-02 06:55:50","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-02 06:55:51', '2017-01-02 06:55:51'),
(40, 'task', 'completed', 0, '[{"id":"22","task_name":"Some task","client_id":"89","note_detail":"Sdfpofd","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-02","start_datetime":"2017-01-02 07:00:00","end_datetime":"2017-01-02 07:06:00","task_completed_date":"2017-01-02 06:55:56","rating":"3","comments":"","property_id":"6","attribute_id":"14","status":"4","created_at":"2017-01-02 06:55:50","updated_at":"2017-01-02 06:55:56","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-02 06:55:56', '2017-01-02 06:55:56'),
(41, 'task', 'created', 0, '[{"id":"23","task_name":"Asda","client_id":"89","note_detail":"Asdasd","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-02","start_datetime":"2017-01-02 07:00:00","end_datetime":"2017-01-02 07:02:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"6","attribute_id":"14","status":"1","created_at":"2017-01-02 06:56:10","updated_at":"2017-01-02 06:56:10","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-02 06:56:10', '2017-01-02 06:56:10'),
(42, 'task', 'deleted', 0, '{"id":"23","task_name":"Asda","client_id":"89","note_detail":"Asdasd","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-02","start_datetime":"2017-01-02 07:00:00","end_datetime":"2017-01-02 07:02:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"6","attribute_id":"14","status":"1","created_at":"2017-01-02 06:56:10","updated_at":"2017-01-02 06:56:10","deleted_at":"0000-00-00 00:00:00"}', '2017-01-02 06:56:18', '2017-01-02 06:56:18'),
(43, 'task', 'created', 0, '[{"id":"24","task_name":"New task","client_id":"89","note_detail":"Asdasd","priority":"1","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-02","start_datetime":"2017-01-02 07:01:00","end_datetime":"2017-01-02 07:06:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"6","attribute_id":"14","status":"1","created_at":"2017-01-02 06:56:37","updated_at":"2017-01-02 06:56:37","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-02 06:56:37', '2017-01-02 06:56:37'),
(44, 'task', 'deleted', 0, '{"id":"24","task_name":"New task","client_id":"89","note_detail":"Asdasd","priority":"1","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-02","start_datetime":"2017-01-02 07:01:00","end_datetime":"2017-01-02 07:06:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"6","attribute_id":"14","status":"1","created_at":"2017-01-02 06:56:37","updated_at":"2017-01-02 06:56:37","deleted_at":"0000-00-00 00:00:00"}', '2017-01-02 06:56:48', '2017-01-02 06:56:48'),
(45, 'task', 'created', 0, '[{"id":"25","task_name":"Some more task","client_id":"89","note_detail":"Belop notes","priority":"1","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-02","start_datetime":"2017-01-02 07:01:00","end_datetime":"2017-01-02 07:03:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"6","attribute_id":"14","status":"1","created_at":"2017-01-02 06:57:14","updated_at":"2017-01-02 06:57:14","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-02 06:57:14', '2017-01-02 06:57:14'),
(46, 'task', 'deleted', 0, '{"id":"25","task_name":"Some more task","client_id":"89","note_detail":"Belop notes","priority":"1","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-02","start_datetime":"2017-01-02 07:01:00","end_datetime":"2017-01-02 07:03:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"6","attribute_id":"14","status":"1","created_at":"2017-01-02 06:57:14","updated_at":"2017-01-02 06:57:14","deleted_at":"0000-00-00 00:00:00"}', '2017-01-02 06:57:29', '2017-01-02 06:57:29'),
(47, 'task', 'created', 0, '[{"id":"26","task_name":"My task","client_id":"89","note_detail":"These are the notes","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-02","start_datetime":"2017-01-02 07:02:00","end_datetime":"2017-01-02 07:03:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"6","attribute_id":"14","status":"1","created_at":"2017-01-02 06:57:58","updated_at":"2017-01-02 06:57:58","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-02 06:57:58', '2017-01-02 06:57:58'),
(48, 'task', 'completed', 0, '[{"id":"26","task_name":"My task","client_id":"89","note_detail":"These are the notes","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-02","start_datetime":"2017-01-02 07:02:00","end_datetime":"2017-01-02 07:03:00","task_completed_date":"2017-01-02 06:58:08","rating":"3","comments":"","property_id":"6","attribute_id":"14","status":"4","created_at":"2017-01-02 06:57:58","updated_at":"2017-01-02 06:58:08","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-02 06:58:08', '2017-01-02 06:58:08'),
(49, 'task', 'created', 0, '[{"id":"27","task_name":"Asdkdfsj","client_id":"89","note_detail":"Sdfsdf","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-02","start_datetime":"2017-01-02 07:02:00","end_datetime":"2017-01-02 07:07:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"6","attribute_id":"14","status":"1","created_at":"2017-01-02 06:58:29","updated_at":"2017-01-02 06:58:29","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-02 06:58:30', '2017-01-02 06:58:30'),
(50, 'task', 'completed', 0, '[{"id":"27","task_name":"Asdkdfsj","client_id":"89","note_detail":"Sdfsdf","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-02","start_datetime":"2017-01-02 07:02:00","end_datetime":"2017-01-02 07:07:00","task_completed_date":"2017-01-02 07:00:48","rating":"2","comments":"Some rating","property_id":"6","attribute_id":"14","status":"4","created_at":"2017-01-02 06:58:29","updated_at":"2017-01-02 07:00:48","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-02 07:00:48', '2017-01-02 07:00:48'),
(51, 'task', 'created', 0, '[{"id":"28","task_name":"Base","client_id":"91","note_detail":"Basement tiels","priority":"1","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-02","start_datetime":"2017-01-02 07:05:00","end_datetime":"2017-01-02 09:05:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"7","attribute_id":"24","status":"1","created_at":"2017-01-02 07:01:44","updated_at":"2017-01-02 07:01:44","deleted_at":"0000-00-00 00:00:00","task_documents":[{"id":"3","type":"2","type_id":"28","filename":"http:\\/\\/frontline.debutinfotech.com\\/uploads\\/userfiles\\/thumb_1483340503.jpeg","created_at":"2017-01-02 07:01:44","updated_at":"2017-01-02 07:01:44","deleted_at":null}]}]', '2017-01-02 07:01:44', '2017-01-02 07:01:44'),
(52, 'task', 'created', 0, '[{"id":"29","task_name":"1st florre tiels","client_id":"91","note_detail":"Tiels","priority":"1","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-03","start_datetime":"2017-01-03 07:06:00","end_datetime":"2017-01-03 09:06:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"7","attribute_id":"21","status":"1","created_at":"2017-01-02 07:02:15","updated_at":"2017-01-02 07:02:15","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-02 07:02:15', '2017-01-02 07:02:15'),
(53, 'task', 'created', 0, '[{"id":"30","task_name":"2nd floor webdroom","client_id":"91","note_detail":"Wed","priority":"2","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-04","start_datetime":"2017-01-04 07:07:00","end_datetime":"2017-01-04 10:07:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"7","attribute_id":"27","status":"1","created_at":"2017-01-02 07:02:42","updated_at":"2017-01-02 07:02:42","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-02 07:02:42', '2017-01-02 07:02:42'),
(54, 'task', 'created', 0, '[{"id":"31","task_name":"My taSK","client_id":"89","note_detail":"ASDDS","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-02","start_datetime":"2017-01-02 07:07:00","end_datetime":"2017-01-02 07:10:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"6","attribute_id":"14","status":"1","created_at":"2017-01-02 07:03:16","updated_at":"2017-01-02 07:03:16","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-02 07:03:16', '2017-01-02 07:03:16'),
(55, 'task', 'created', 0, '[{"id":"32","task_name":"3rd floor chairs","client_id":"91","note_detail":"Chairs","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-05","start_datetime":"2017-01-05 07:07:00","end_datetime":"2017-01-05 09:07:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"7","attribute_id":"30","status":"1","created_at":"2017-01-02 07:03:26","updated_at":"2017-01-02 07:03:26","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-02 07:03:26', '2017-01-02 07:03:26'),
(56, 'task', 'completed', 0, '[{"id":"30","task_name":"2nd floor webdroomm","client_id":"91","note_detail":"Wed","priority":"2","document_id":"0","technician_id":"88","assigned_date":"2017-01-02","scheduled_date":"2017-01-04","start_datetime":"2017-01-04 07:07:00","end_datetime":"2017-01-04 10:07:00","task_completed_date":"2017-01-02 07:06:27","rating":"4","comments":"","property_id":"7","attribute_id":"27","status":"4","created_at":"2017-01-02 07:02:42","updated_at":"2017-01-02 07:06:27","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-02 07:06:27', '2017-01-02 07:06:27'),
(57, 'task', 'completed', 0, '[{"id":"32","task_name":"3rd floor chairs","client_id":"91","note_detail":"Chairs","priority":"3","document_id":"0","technician_id":"88","assigned_date":"2017-01-02","scheduled_date":"2017-01-05","start_datetime":"2017-01-05 07:07:00","end_datetime":"2017-01-05 09:07:00","task_completed_date":"2017-01-02 07:08:59","rating":"4","comments":"","property_id":"7","attribute_id":"30","status":"4","created_at":"2017-01-02 07:03:26","updated_at":"2017-01-02 07:08:59","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-02 07:08:59', '2017-01-02 07:08:59'),
(58, 'task', 'created', 0, '[{"id":"33","task_name":"Hdhdhd","client_id":"91","note_detail":"Bdbdhdh","priority":"1","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-02","start_datetime":"2017-01-02 07:16:00","end_datetime":"2017-01-02 12:16:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"7","attribute_id":"29","status":"1","created_at":"2017-01-02 07:12:03","updated_at":"2017-01-02 07:12:03","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-02 07:12:03', '2017-01-02 07:12:03'),
(59, 'task', 'completed', 0, '[{"id":"33","task_name":"Hdhdhd","client_id":"91","note_detail":"Bdbdhdh","priority":"1","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-02","start_datetime":"2017-01-02 07:16:00","end_datetime":"2017-01-02 12:16:00","task_completed_date":"2017-01-02 07:12:42","rating":"4","comments":"","property_id":"7","attribute_id":"29","status":"4","created_at":"2017-01-02 07:12:03","updated_at":"2017-01-02 07:12:42","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-02 07:12:42', '2017-01-02 07:12:42'),
(60, 'task', 'created', 0, '[{"id":"34","task_name":"Hshshs","client_id":"91","note_detail":"Hahsh","priority":"2","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-02","start_datetime":"2017-01-02 07:18:00","end_datetime":"2017-01-02 07:19:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"7","attribute_id":"30","status":"1","created_at":"2017-01-02 07:13:57","updated_at":"2017-01-02 07:13:57","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-02 07:13:57', '2017-01-02 07:13:57'),
(61, 'task', 'completed', 0, '[{"id":"34","task_name":"Hshshs","client_id":"91","note_detail":"Hahsh","priority":"2","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-02","start_datetime":"2017-01-02 07:18:00","end_datetime":"2017-01-02 07:19:00","task_completed_date":"2017-01-02 07:14:05","rating":"3","comments":"","property_id":"7","attribute_id":"30","status":"4","created_at":"2017-01-02 07:13:57","updated_at":"2017-01-02 07:14:05","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-02 07:14:05', '2017-01-02 07:14:05'),
(62, 'task', 'completed', 0, '[{"id":"31","task_name":"My taSK","client_id":"89","note_detail":"ASDDS","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-02","start_datetime":"2017-01-02 07:07:00","end_datetime":"2017-01-02 07:10:00","task_completed_date":"2017-01-02 07:23:09","rating":"3","comments":"","property_id":"6","attribute_id":"14","status":"4","created_at":"2017-01-02 07:03:16","updated_at":"2017-01-02 07:23:09","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-02 07:23:09', '2017-01-02 07:23:09'),
(63, 'task', 'created', 0, '[{"id":"35","task_name":"My task","client_id":"89","note_detail":"Some morw notes goes here","priority":"1","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-02","start_datetime":"2017-01-02 07:28:00","end_datetime":"2017-01-02 07:29:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"6","attribute_id":"14","status":"1","created_at":"2017-01-02 07:23:58","updated_at":"2017-01-02 07:23:58","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-02 07:23:58', '2017-01-02 07:23:58'),
(64, 'task', 'completed', 0, '[{"id":"35","task_name":"My task","client_id":"89","note_detail":"Some morw notes goes here","priority":"1","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-02","start_datetime":"2017-01-02 07:28:00","end_datetime":"2017-01-02 07:29:00","task_completed_date":"2017-01-02 07:24:04","rating":"3","comments":"","property_id":"6","attribute_id":"14","status":"4","created_at":"2017-01-02 07:23:58","updated_at":"2017-01-02 07:24:04","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-02 07:24:04', '2017-01-02 07:24:04'),
(65, 'task', 'created', 0, '[{"id":"36","task_name":"New task","client_id":"89","note_detail":"Some notea","priority":"1","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-02","start_datetime":"2017-01-02 07:29:00","end_datetime":"2017-01-02 08:29:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"6","attribute_id":"14","status":"1","created_at":"2017-01-02 07:24:37","updated_at":"2017-01-02 07:24:37","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-02 07:24:37', '2017-01-02 07:24:37'),
(66, 'task', 'deleted', 0, '{"id":"36","task_name":"New task","client_id":"89","note_detail":"Some notea","priority":"1","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-02","start_datetime":"2017-01-02 07:29:00","end_datetime":"2017-01-02 08:29:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"6","attribute_id":"14","status":"1","created_at":"2017-01-02 07:24:37","updated_at":"2017-01-02 07:24:37","deleted_at":"0000-00-00 00:00:00"}', '2017-01-02 07:24:43', '2017-01-02 07:24:43'),
(67, 'task', 'created', 0, '[{"id":"37","task_name":"My task","client_id":"89","note_detail":"Some notes","priority":"1","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-02","start_datetime":"2017-01-02 07:32:00","end_datetime":"2017-01-02 07:34:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"6","attribute_id":"14","status":"1","created_at":"2017-01-02 07:28:18","updated_at":"2017-01-02 07:28:18","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-02 07:28:18', '2017-01-02 07:28:18'),
(68, 'task', 'deleted', 0, '{"id":"37","task_name":"My task","client_id":"89","note_detail":"Some notes","priority":"1","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-02","start_datetime":"2017-01-02 07:32:00","end_datetime":"2017-01-02 07:34:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"6","attribute_id":"14","status":"1","created_at":"2017-01-02 07:28:18","updated_at":"2017-01-02 07:28:18","deleted_at":"0000-00-00 00:00:00"}', '2017-01-02 07:37:13', '2017-01-02 07:37:13'),
(69, 'task', 'created', 0, '[{"id":"38","task_name":"One task","client_id":"89","note_detail":"Some task notes goes here","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-02","start_datetime":"2017-01-02 08:53:00","end_datetime":"2017-01-02 08:54:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"6","attribute_id":"14","status":"1","created_at":"2017-01-02 08:48:56","updated_at":"2017-01-02 08:48:56","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-02 08:48:56', '2017-01-02 08:48:56'),
(70, 'task', 'completed', 0, '[{"id":"38","task_name":"One task","client_id":"89","note_detail":"Some task notes goes here","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-02","start_datetime":"2017-01-02 08:53:00","end_datetime":"2017-01-02 08:54:00","task_completed_date":"2017-01-02 08:49:34","rating":"3","comments":"This is my comment","property_id":"6","attribute_id":"14","status":"4","created_at":"2017-01-02 08:48:56","updated_at":"2017-01-02 08:49:34","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-02 08:49:34', '2017-01-02 08:49:34'),
(71, 'task', 'created', 0, '[{"id":"39","task_name":"New task","client_id":"89","note_detail":"This is one more task","priority":"1","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-02","start_datetime":"2017-01-02 08:54:00","end_datetime":"2017-01-02 08:58:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"6","attribute_id":"14","status":"1","created_at":"2017-01-02 08:50:06","updated_at":"2017-01-02 08:50:06","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-02 08:50:06', '2017-01-02 08:50:06'),
(72, 'task', 'completed', 0, '[{"id":"39","task_name":"New task","client_id":"89","note_detail":"This is one more task","priority":"1","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-02","start_datetime":"2017-01-02 08:54:00","end_datetime":"2017-01-02 08:58:00","task_completed_date":"2017-01-02 08:50:18","rating":"3","comments":"Task comments","property_id":"6","attribute_id":"14","status":"4","created_at":"2017-01-02 08:50:06","updated_at":"2017-01-02 08:50:18","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-02 08:50:18', '2017-01-02 08:50:18'),
(73, 'task', 'created', 0, '[{"id":"40","task_name":"Fds","client_id":"89","note_detail":"Sdfdsf","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-02","start_datetime":"2017-01-02 08:56:00","end_datetime":"2017-01-02 08:57:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"6","attribute_id":"14","status":"1","created_at":"2017-01-02 08:51:40","updated_at":"2017-01-02 08:51:40","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-02 08:51:40', '2017-01-02 08:51:40'),
(74, 'task', 'created', 0, '[{"id":"41","task_name":"Testing task","client_id":"91","note_detail":"Hello name","priority":"2","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-15","start_datetime":"2017-01-15 09:02:00","end_datetime":"2017-01-15 09:11:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"7","attribute_id":"21","status":"1","created_at":"2017-01-02 08:59:30","updated_at":"2017-01-02 08:59:30","deleted_at":"0000-00-00 00:00:00","task_documents":[{"id":"4","type":"2","type_id":"41","filename":"http:\\/\\/frontline.debutinfotech.com\\/uploads\\/userfiles\\/thumb_1483347569.jpeg","created_at":"2017-01-02 08:59:30","updated_at":"2017-01-02 08:59:30","deleted_at":null}]}]', '2017-01-02 08:59:30', '2017-01-02 08:59:30'),
(75, 'task', 'created', 0, '[{"id":"42","task_name":"Hchc","client_id":"91","note_detail":"Ughggi","priority":"2","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-03","start_datetime":"2017-01-03 09:04:00","end_datetime":"2017-01-03 09:29:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"7","attribute_id":"21","status":"1","created_at":"2017-01-02 08:59:57","updated_at":"2017-01-02 08:59:57","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-02 08:59:57', '2017-01-02 08:59:57'),
(76, 'task', 'completed', 0, '[{"id":"42","task_name":"Hchc","client_id":"91","note_detail":"Ughggi","priority":"2","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-03","start_datetime":"2017-01-03 09:04:00","end_datetime":"2017-01-03 09:29:00","task_completed_date":"2017-01-02 09:00:08","rating":"4","comments":"","property_id":"7","attribute_id":"21","status":"4","created_at":"2017-01-02 08:59:57","updated_at":"2017-01-02 09:00:08","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-02 09:00:08', '2017-01-02 09:00:08'),
(77, 'task', 'created', 0, '[{"id":"43","task_name":"Chjcfh","client_id":"91","note_detail":"Chjcjc","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-09","start_datetime":"2017-01-09 09:07:00","end_datetime":"2017-01-09 09:16:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"7","attribute_id":"21","status":"1","created_at":"2017-01-02 09:00:35","updated_at":"2017-01-02 09:00:35","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-02 09:00:35', '2017-01-02 09:00:35'),
(78, 'task', 'completed', 0, '[{"id":"43","task_name":"Chjcfh","client_id":"91","note_detail":"Chjcjc","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-09","start_datetime":"2017-01-09 09:07:00","end_datetime":"2017-01-09 09:16:00","task_completed_date":"2017-01-02 09:02:10","rating":"2","comments":"","property_id":"7","attribute_id":"21","status":"4","created_at":"2017-01-02 09:00:35","updated_at":"2017-01-02 09:02:10","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-02 09:02:10', '2017-01-02 09:02:10'),
(79, 'task', 'created', 0, '[{"id":"44","task_name":"Hdhdh","client_id":"91","note_detail":"Hdhdh","priority":"1","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-02","start_datetime":"2017-01-02 09:07:00","end_datetime":"2017-01-02 17:07:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"7","attribute_id":"21","status":"1","created_at":"2017-01-02 09:03:08","updated_at":"2017-01-02 09:03:08","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-02 09:03:08', '2017-01-02 09:03:08'),
(80, 'task', 'completed', 0, '[{"id":"44","task_name":"Hdhdh","client_id":"91","note_detail":"Hdhdh","priority":"1","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-02","start_datetime":"2017-01-02 09:07:00","end_datetime":"2017-01-02 17:07:00","task_completed_date":"2017-01-02 09:03:15","rating":"4","comments":"","property_id":"7","attribute_id":"21","status":"4","created_at":"2017-01-02 09:03:08","updated_at":"2017-01-02 09:03:15","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-02 09:03:15', '2017-01-02 09:03:15'),
(81, 'task', 'created', 0, '[{"id":"45","task_name":"Bdhdh","client_id":"91","note_detail":"Bdhdh","priority":"1","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-02","start_datetime":"2017-01-02 10:07:00","end_datetime":"2017-01-02 13:07:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"7","attribute_id":"21","status":"1","created_at":"2017-01-02 09:03:40","updated_at":"2017-01-02 09:03:40","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-02 09:03:40', '2017-01-02 09:03:40'),
(82, 'task', 'completed', 0, '[{"id":"40","task_name":"Fds","client_id":"89","note_detail":"Sdfdsf","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-02","start_datetime":"2017-01-02 08:56:00","end_datetime":"2017-01-02 08:57:00","task_completed_date":"2017-01-02 09:06:42","rating":"3","comments":"","property_id":"6","attribute_id":"14","status":"4","created_at":"2017-01-02 08:51:40","updated_at":"2017-01-02 09:06:42","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-02 09:06:42', '2017-01-02 09:06:42');
INSERT INTO `crone_jobs` (`id`, `type`, `status`, `action_status`, `description`, `created_at`, `updated_at`) VALUES
(83, 'task', 'created', 0, '[{"id":"46","task_name":"New data","client_id":"89","note_detail":"Asdds","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-02","start_datetime":"2017-01-02 09:11:00","end_datetime":"2017-01-02 09:13:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"6","attribute_id":"14","status":"1","created_at":"2017-01-02 09:07:19","updated_at":"2017-01-02 09:07:19","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-02 09:07:19', '2017-01-02 09:07:19'),
(84, 'task', 'completed', 0, '[{"id":"46","task_name":"New data","client_id":"89","note_detail":"Asdds","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-02","start_datetime":"2017-01-02 09:11:00","end_datetime":"2017-01-02 09:13:00","task_completed_date":"2017-01-02 09:16:41","rating":"4","comments":"","property_id":"6","attribute_id":"14","status":"4","created_at":"2017-01-02 09:07:19","updated_at":"2017-01-02 09:16:41","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-02 09:16:41', '2017-01-02 09:16:41'),
(85, 'task', 'created', 0, '[{"id":"47","task_name":"Task name","client_id":"89","note_detail":"Some notes","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-04","start_datetime":"2017-01-04 09:32:00","end_datetime":"2017-01-04 09:34:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"10","attribute_id":"38","status":"1","created_at":"2017-01-02 09:28:37","updated_at":"2017-01-02 09:28:37","deleted_at":"0000-00-00 00:00:00","task_documents":[{"id":"5","type":"2","type_id":"47","filename":"http:\\/\\/frontline.debutinfotech.com\\/uploads\\/userfiles\\/thumb_1483349307.jpeg","created_at":"2017-01-02 09:28:37","updated_at":"2017-01-02 09:28:37","deleted_at":null},{"id":"6","type":"2","type_id":"47","filename":"http:\\/\\/frontline.debutinfotech.com\\/uploads\\/userfiles\\/thumb_1483349309.jpeg","created_at":"2017-01-02 09:28:37","updated_at":"2017-01-02 09:28:37","deleted_at":null},{"id":"7","type":"2","type_id":"47","filename":"http:\\/\\/frontline.debutinfotech.com\\/uploads\\/userfiles\\/thumb_1483349312.jpeg","created_at":"2017-01-02 09:28:37","updated_at":"2017-01-02 09:28:37","deleted_at":null},{"id":"8","type":"2","type_id":"47","filename":"http:\\/\\/frontline.debutinfotech.com\\/uploads\\/userfiles\\/thumb_1483349316.jpeg","created_at":"2017-01-02 09:28:37","updated_at":"2017-01-02 09:28:37","deleted_at":null}]}]', '2017-01-02 09:28:37', '2017-01-02 09:28:37'),
(86, 'task', 'created', 0, '[{"id":"48","task_name":"Cleaning task at a college need to clean the colle","client_id":"89","note_detail":"Dfgdfgfdgfgfd;gdsfgpfgopdfgopdfgopfdgopdfogpofdpgofdpgopdfogpofpdgopfdogpfgopfgopfdgopfdgopgofpfgopdgopdfgopdflkgldfgkldfkgldfkglkbglfdjkldjboiogioeriyoiyotyirogfhklghklghklgkhlghklgknlgknlgflfgmbklfkbglhogfiohihofgihogfihofgihofgihofgihofgiho9fhoifgohifg","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-02","start_datetime":"2017-01-02 09:53:00","end_datetime":"2017-01-02 09:54:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"10","attribute_id":"38","status":"1","created_at":"2017-01-02 09:49:13","updated_at":"2017-01-02 09:49:13","deleted_at":"0000-00-00 00:00:00","task_documents":[{"id":"18","type":"2","type_id":"48","filename":"http:\\/\\/frontline.debutinfotech.com\\/uploads\\/userfiles\\/thumb_1483350552.jpeg","created_at":"2017-01-02 09:49:13","updated_at":"2017-01-02 09:49:13","deleted_at":null}]}]', '2017-01-02 09:49:13', '2017-01-02 09:49:13'),
(87, 'task', 'deleted', 0, '{"id":"48","task_name":"Cleaning task at a college need to clean the colle","client_id":"89","note_detail":"Dfgdfgfdgfgfd;gdsfgpfgopdfgopdfgopfdgopdfogpofdpgofdpgopdfogpofpdgopfdogpfgopfgopfdgopfdgopgofpfgopdgopdfgopdflkgldfgkldfkgldfkglkbglfdjkldjboiogioeriyoiyotyirogfhklghklghklgkhlghklgknlgknlgflfgmbklfkbglhogfiohihofgihogfihofgihofgihofgihofgiho9fhoifgohifg","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-02","start_datetime":"2017-01-02 09:53:00","end_datetime":"2017-01-02 09:54:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"10","attribute_id":"38","status":"1","created_at":"2017-01-02 09:49:13","updated_at":"2017-01-02 09:58:19","deleted_at":"0000-00-00 00:00:00"}', '2017-01-02 09:59:35', '2017-01-02 09:59:35'),
(88, 'task', 'deleted', 0, '{"id":"47","task_name":"Sdifsofisdofiosdfiosdfiosdfiosdfasfsafaosipasipfas","client_id":"89","note_detail":"Some notessdfsdfsdfiopdsifosdifopisdofidspofipsdfipdsfipdsfipsdfipsdfipsdfipdsfipdsifpsdifopsdifoisdofidsofisdofipdsfipdsfipdsifpidspfisdpifpdsifopdsifpdsifpdisfpidsfpidsfpifdsfipsdfipdsifpsdfpdsifpsdifpsdifpsdifpdsifpdsifpsdifpdsfipdsifpsdifpdsifpsdifpds","priority":"3","document_id":"0","technician_id":"88","assigned_date":"2017-01-02","scheduled_date":"2017-01-04","start_datetime":"2017-01-04 09:32:00","end_datetime":"2017-01-04 09:34:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"10","attribute_id":"38","status":"3","created_at":"2017-01-02 09:28:37","updated_at":"2017-01-02 09:47:43","deleted_at":"0000-00-00 00:00:00"}', '2017-01-02 09:59:40', '2017-01-02 09:59:40'),
(89, 'task', 'created', 0, '[{"id":"49","task_name":"A new task is going to be created here please veri","client_id":"89","note_detail":"Some sdklfjsdklfjs oiflsdfijldsfldskflsdkflskdflkldsfkldsfkldfkldslfdksfldksflkdsflkdslfksdlfksdlfklsfkdldsfklkfdslkflsdkfldskflkdsflkfdlkdslfkdslfkldsfosdfosdifoidsfoweoiweoriowerioweiroweiroreiowierlkfdlkglkflgdfkglkdflgfkdgldfgm,mb,cvbcvbcv,bcv,bmcv,bm","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-02","start_datetime":"2017-01-02 10:11:00","end_datetime":"2017-01-02 10:16:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"10","attribute_id":"38","status":"1","created_at":"2017-01-02 10:07:54","updated_at":"2017-01-02 10:07:54","deleted_at":"0000-00-00 00:00:00","task_documents":[{"id":"28","type":"2","type_id":"49","filename":"http:\\/\\/frontline.debutinfotech.com\\/uploads\\/userfiles\\/thumb_1483351670.jpeg","created_at":"2017-01-02 10:07:54","updated_at":"2017-01-02 10:07:54","deleted_at":null},{"id":"29","type":"2","type_id":"49","filename":"http:\\/\\/frontline.debutinfotech.com\\/uploads\\/userfiles\\/thumb_1483351671.jpeg","created_at":"2017-01-02 10:07:54","updated_at":"2017-01-02 10:07:54","deleted_at":null},{"id":"30","type":"2","type_id":"49","filename":"http:\\/\\/frontline.debutinfotech.com\\/uploads\\/userfiles\\/thumb_1483351673.jpeg","created_at":"2017-01-02 10:07:54","updated_at":"2017-01-02 10:07:54","deleted_at":null},{"id":"31","type":"2","type_id":"49","filename":"http:\\/\\/frontline.debutinfotech.com\\/uploads\\/userfiles\\/thumb_1483351673.jpeg","created_at":"2017-01-02 10:07:54","updated_at":"2017-01-02 10:07:54","deleted_at":null},{"id":"32","type":"2","type_id":"49","filename":"http:\\/\\/frontline.debutinfotech.com\\/uploads\\/userfiles\\/thumb_1483351674.jpeg","created_at":"2017-01-02 10:07:54","updated_at":"2017-01-02 10:07:54","deleted_at":null}]}]', '2017-01-02 10:07:54', '2017-01-02 10:07:54'),
(90, 'task', 'created', 0, '[{"id":"50","task_name":"Xbdhdh","client_id":"87","note_detail":"Bxhdhd","priority":"1","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-02","start_datetime":"2017-01-02 10:28:00","end_datetime":"2017-01-02 12:28:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"5","attribute_id":"11","status":"1","created_at":"2017-01-02 10:24:27","updated_at":"2017-01-02 10:24:27","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-02 10:24:27', '2017-01-02 10:24:27'),
(91, 'task', 'completed', 0, '[{"id":"50","task_name":"Xbdhdh","client_id":"87","note_detail":"Bxhdhd","priority":"1","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-02","start_datetime":"2017-01-02 10:28:00","end_datetime":"2017-01-02 12:28:00","task_completed_date":"2017-01-02 10:24:33","rating":"4","comments":"","property_id":"5","attribute_id":"11","status":"4","created_at":"2017-01-02 10:24:27","updated_at":"2017-01-02 10:24:33","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-02 10:24:33', '2017-01-02 10:24:33'),
(92, 'task', 'created', 0, '[{"id":"51","task_name":"Hdhdh","client_id":"87","note_detail":"Bdbdh","priority":"1","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-02","start_datetime":"2017-01-02 10:29:00","end_datetime":"2017-01-02 14:29:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"5","attribute_id":"11","status":"1","created_at":"2017-01-02 10:25:00","updated_at":"2017-01-02 10:25:00","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-02 10:25:00', '2017-01-02 10:25:00'),
(93, 'task', 'completed', 0, '[{"id":"51","task_name":"Hdhdh","client_id":"87","note_detail":"Bdbdh","priority":"1","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-02","start_datetime":"2017-01-02 10:29:00","end_datetime":"2017-01-02 14:29:00","task_completed_date":"2017-01-02 10:25:07","rating":"4","comments":"","property_id":"5","attribute_id":"11","status":"4","created_at":"2017-01-02 10:25:00","updated_at":"2017-01-02 10:25:07","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-02 10:25:07', '2017-01-02 10:25:07'),
(94, 'task', 'created', 0, '[{"id":"52","task_name":"Cbcbdb","client_id":"87","note_detail":"Bdhfdhhd","priority":"1","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-02","start_datetime":"2017-01-02 10:30:00","end_datetime":"2017-01-02 12:30:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"5","attribute_id":"11","status":"1","created_at":"2017-01-02 10:25:36","updated_at":"2017-01-02 10:25:36","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-02 10:25:36', '2017-01-02 10:25:36'),
(95, 'task', 'completed', 0, '[{"id":"52","task_name":"Cbcbdb","client_id":"87","note_detail":"Bdhfdhhd","priority":"1","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-02","start_datetime":"2017-01-02 10:30:00","end_datetime":"2017-01-02 12:30:00","task_completed_date":"2017-01-02 10:25:44","rating":"4","comments":"","property_id":"5","attribute_id":"11","status":"4","created_at":"2017-01-02 10:25:36","updated_at":"2017-01-02 10:25:44","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-02 10:25:44', '2017-01-02 10:25:44'),
(96, 'task', 'created', 0, '[{"id":"53","task_name":"Bathroom tiles","client_id":"93","note_detail":"Tiles","priority":"1","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-02","start_datetime":"2017-01-02 10:37:00","end_datetime":"2017-01-02 11:37:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"11","attribute_id":"39","status":"1","created_at":"2017-01-02 10:33:57","updated_at":"2017-01-02 10:33:57","deleted_at":"0000-00-00 00:00:00","task_documents":[{"id":"33","type":"2","type_id":"53","filename":"http:\\/\\/frontline.debutinfotech.com\\/uploads\\/userfiles\\/thumb_1483353237.jpeg","created_at":"2017-01-02 10:33:57","updated_at":"2017-01-02 10:33:57","deleted_at":null}]}]', '2017-01-02 10:33:57', '2017-01-02 10:33:57'),
(97, 'task', 'created', 0, '[{"id":"54","task_name":"Wed new","client_id":"93","note_detail":"New web","priority":"2","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-03","start_datetime":"2017-01-03 10:39:00","end_datetime":"2017-01-03 11:39:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"11","attribute_id":"40","status":"1","created_at":"2017-01-02 10:35:03","updated_at":"2017-01-02 10:35:03","deleted_at":"0000-00-00 00:00:00","task_documents":[{"id":"34","type":"2","type_id":"54","filename":"http:\\/\\/frontline.debutinfotech.com\\/uploads\\/userfiles\\/thumb_1483353302.jpeg","created_at":"2017-01-02 10:35:03","updated_at":"2017-01-02 10:35:03","deleted_at":null}]}]', '2017-01-02 10:35:03', '2017-01-02 10:35:03'),
(98, 'task', 'created', 0, '[{"id":"55","task_name":"Kitchen tiles","client_id":"93","note_detail":"Tiles kitchen","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-04","start_datetime":"2017-01-04 10:40:00","end_datetime":"2017-01-04 11:40:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"11","attribute_id":"41","status":"1","created_at":"2017-01-02 10:36:24","updated_at":"2017-01-02 10:36:24","deleted_at":"0000-00-00 00:00:00","task_documents":[{"id":"35","type":"2","type_id":"55","filename":"http:\\/\\/frontline.debutinfotech.com\\/uploads\\/userfiles\\/thumb_1483353384.jpeg","created_at":"2017-01-02 10:36:24","updated_at":"2017-01-02 10:36:24","deleted_at":null}]}]', '2017-01-02 10:36:24', '2017-01-02 10:36:24'),
(99, 'task', 'created', 0, '[{"id":"56","task_name":"Dining","client_id":"93","note_detail":"Romm dining","priority":"1","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-05","start_datetime":"2017-01-05 10:41:00","end_datetime":"2017-01-05 11:41:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"11","attribute_id":"42","status":"1","created_at":"2017-01-02 10:37:36","updated_at":"2017-01-02 10:37:36","deleted_at":"0000-00-00 00:00:00","task_documents":[{"id":"36","type":"2","type_id":"56","filename":"http:\\/\\/frontline.debutinfotech.com\\/uploads\\/userfiles\\/thumb_1483353456.jpeg","created_at":"2017-01-02 10:37:36","updated_at":"2017-01-02 10:37:36","deleted_at":null}]}]', '2017-01-02 10:37:36', '2017-01-02 10:37:36'),
(100, 'note', 'created', 0, '[{"id":"2","user_id":"93","client_notes":"Hhh","title":"Cgg","created_at":"2017-01-02 10:38:22","updated_at":"2017-01-02 10:38:22","deleted_at":"0000-00-00 00:00:00"}]', '2017-01-02 10:38:22', '2017-01-02 10:38:22'),
(101, 'task', 'completed', 0, '[{"id":"54","task_name":"Wed new","client_id":"93","note_detail":"New web","priority":"2","document_id":"0","technician_id":"88","assigned_date":"2017-01-02","scheduled_date":"2017-01-03","start_datetime":"2017-01-03 10:39:00","end_datetime":"2017-01-03 11:39:00","task_completed_date":"2017-01-02 10:48:26","rating":"4","comments":"","property_id":"11","attribute_id":"40","status":"4","created_at":"2017-01-02 10:35:03","updated_at":"2017-01-02 10:48:26","deleted_at":"0000-00-00 00:00:00","task_documents":[{"id":"34","type":"2","type_id":"54","filename":"http:\\/\\/frontline.debutinfotech.com\\/uploads\\/userfiles\\/thumb_1483353302.jpeg","created_at":"2017-01-02 10:35:03","updated_at":"2017-01-02 10:35:03","deleted_at":null}]}]', '2017-01-02 10:48:26', '2017-01-02 10:48:26'),
(102, 'task', 'completed', 0, '[{"id":"56","task_name":"Dining","client_id":"93","note_detail":"Romm dining","priority":"1","document_id":"0","technician_id":"88","assigned_date":"2017-01-02","scheduled_date":"2017-01-05","start_datetime":"2017-01-05 10:49:00","end_datetime":"2017-01-05 11:41:00","task_completed_date":"2017-01-02 10:49:48","rating":"4","comments":"","property_id":"11","attribute_id":"42","status":"4","created_at":"2017-01-02 10:37:36","updated_at":"2017-01-02 10:49:48","deleted_at":"0000-00-00 00:00:00","task_documents":[{"id":"36","type":"2","type_id":"56","filename":"http:\\/\\/frontline.debutinfotech.com\\/uploads\\/userfiles\\/thumb_1483353456.jpeg","created_at":"2017-01-02 10:37:36","updated_at":"2017-01-02 10:37:36","deleted_at":null}]}]', '2017-01-02 10:49:48', '2017-01-02 10:49:48'),
(103, 'task', 'created', 0, '[{"id":"57","task_name":"Sdefsdf","client_id":"89","note_detail":"Sdffdssdf","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-02","start_datetime":"2017-01-02 10:54:00","end_datetime":"2017-01-02 10:55:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"10","attribute_id":"38","status":"1","created_at":"2017-01-02 10:49:56","updated_at":"2017-01-02 10:49:56","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-02 10:49:56', '2017-01-02 10:49:56'),
(104, 'task', 'created', 0, '[{"id":"58","task_name":"Gfdgf","client_id":"89","note_detail":"Dfgdfg","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-02","start_datetime":"2017-01-02 10:55:00","end_datetime":"2017-01-02 10:56:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"10","attribute_id":"38","status":"1","created_at":"2017-01-02 10:51:19","updated_at":"2017-01-02 10:51:19","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-02 10:51:19', '2017-01-02 10:51:19'),
(105, 'task', 'created', 0, '[{"id":"59","task_name":"Bdhdh","client_id":"93","note_detail":"Dhndh","priority":"1","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-02","start_datetime":"2017-01-02 10:59:00","end_datetime":"2017-01-02 11:59:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"11","attribute_id":"42","status":"1","created_at":"2017-01-02 10:55:01","updated_at":"2017-01-02 10:55:01","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-02 10:55:01', '2017-01-02 10:55:01'),
(106, 'task', 'created', 0, '[{"id":"60","task_name":"Patiala","client_id":"94","note_detail":"Patiala","priority":"1","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-02","start_datetime":"2017-01-02 11:57:00","end_datetime":"2017-01-02 12:57:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"13","attribute_id":"49","status":"1","created_at":"2017-01-02 11:53:31","updated_at":"2017-01-02 11:53:31","deleted_at":"0000-00-00 00:00:00","task_documents":[{"id":"37","type":"2","type_id":"60","filename":"http:\\/\\/frontline.debutinfotech.com\\/uploads\\/userfiles\\/thumb_1483358011.jpeg","created_at":"2017-01-02 11:53:31","updated_at":"2017-01-02 11:53:31","deleted_at":null}]}]', '2017-01-02 11:53:31', '2017-01-02 11:53:31'),
(107, 'task', 'created', 0, '[{"id":"61","task_name":"Nabja","client_id":"94","note_detail":"Wed","priority":"1","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-03","start_datetime":"2017-01-03 11:58:00","end_datetime":"2017-01-03 12:58:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"13","attribute_id":"49","status":"1","created_at":"2017-01-02 11:53:49","updated_at":"2017-01-02 11:53:49","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-02 11:53:49', '2017-01-02 11:53:49'),
(108, 'task', 'created', 0, '[{"id":"62","task_name":"Mohali","client_id":"94","note_detail":"Moh","priority":"2","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-04","start_datetime":"2017-01-04 11:59:00","end_datetime":"2017-01-04 12:59:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"13","attribute_id":"49","status":"1","created_at":"2017-01-02 11:55:13","updated_at":"2017-01-02 11:55:13","deleted_at":"0000-00-00 00:00:00","task_documents":[{"id":"38","type":"2","type_id":"62","filename":"http:\\/\\/frontline.debutinfotech.com\\/uploads\\/userfiles\\/thumb_1483358113.jpeg","created_at":"2017-01-02 11:55:13","updated_at":"2017-01-02 11:55:13","deleted_at":null}]}]', '2017-01-02 11:55:13', '2017-01-02 11:55:13'),
(109, 'note', 'created', 0, '[{"id":"3","user_id":"94","client_notes":"Vvv","title":"Hhh","created_at":"2017-01-02 11:58:13","updated_at":"2017-01-02 11:58:13","deleted_at":"0000-00-00 00:00:00"}]', '2017-01-02 11:58:13', '2017-01-02 11:58:13'),
(110, 'task', 'completed', 0, '[{"id":"62","task_name":"Mohali","client_id":"94","note_detail":"Moh","priority":"2","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-04","start_datetime":"2017-01-04 11:59:00","end_datetime":"2017-01-04 12:59:00","task_completed_date":"2017-01-02 12:15:26","rating":"4","comments":"","property_id":"13","attribute_id":"49","status":"4","created_at":"2017-01-02 11:55:13","updated_at":"2017-01-02 12:15:26","deleted_at":"0000-00-00 00:00:00","task_documents":[{"id":"38","type":"2","type_id":"62","filename":"http:\\/\\/frontline.debutinfotech.com\\/uploads\\/userfiles\\/thumb_1483358113.jpeg","created_at":"2017-01-02 11:55:13","updated_at":"2017-01-02 11:55:13","deleted_at":null}]}]', '2017-01-02 12:15:26', '2017-01-02 12:15:26'),
(111, 'task', 'completed', 0, '[{"id":"60","task_name":"Patiala","client_id":"94","note_detail":"Patiala","priority":"1","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-02","start_datetime":"2017-01-02 11:57:00","end_datetime":"2017-01-02 12:57:00","task_completed_date":"2017-01-02 12:15:36","rating":"4","comments":"Vvv","property_id":"13","attribute_id":"49","status":"4","created_at":"2017-01-02 11:53:31","updated_at":"2017-01-02 12:15:36","deleted_at":"0000-00-00 00:00:00","task_documents":[{"id":"37","type":"2","type_id":"60","filename":"http:\\/\\/frontline.debutinfotech.com\\/uploads\\/userfiles\\/thumb_1483358011.jpeg","created_at":"2017-01-02 11:53:31","updated_at":"2017-01-02 11:53:31","deleted_at":null}]}]', '2017-01-02 12:15:36', '2017-01-02 12:15:36'),
(112, 'task', 'completed', 0, '[{"id":"61","task_name":"Nabja","client_id":"94","note_detail":"Wed","priority":"1","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-03","start_datetime":"2017-01-03 11:58:00","end_datetime":"2017-01-03 12:58:00","task_completed_date":"2017-01-02 12:16:06","rating":"4","comments":"Ggb","property_id":"13","attribute_id":"49","status":"4","created_at":"2017-01-02 11:53:49","updated_at":"2017-01-02 12:16:06","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-02 12:16:06', '2017-01-02 12:16:06'),
(113, 'task', 'created', 0, '[{"id":"63","task_name":"Vvv","client_id":"94","note_detail":"Fcvv","priority":"1","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-02","start_datetime":"2017-01-02 12:20:00","end_datetime":"2017-01-02 13:20:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"13","attribute_id":"49","status":"1","created_at":"2017-01-02 12:16:23","updated_at":"2017-01-02 12:16:23","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-02 12:16:23', '2017-01-02 12:16:23'),
(114, 'task', 'completed', 0, '[{"id":"63","task_name":"Vvv","client_id":"94","note_detail":"Fcvv","priority":"1","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-02","start_datetime":"2017-01-02 12:20:00","end_datetime":"2017-01-02 13:20:00","task_completed_date":"2017-01-02 12:16:30","rating":"4","comments":"Vvvb","property_id":"13","attribute_id":"49","status":"4","created_at":"2017-01-02 12:16:23","updated_at":"2017-01-02 12:16:30","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-02 12:16:30', '2017-01-02 12:16:30'),
(115, 'task', 'created', 0, '[{"id":"64","task_name":"Gggg","client_id":"94","note_detail":"Cvvvv","priority":"1","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-02","start_datetime":"2017-01-02 12:21:00","end_datetime":"2017-01-02 15:21:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"13","attribute_id":"49","status":"1","created_at":"2017-01-02 12:17:23","updated_at":"2017-01-02 12:17:23","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-02 12:17:23', '2017-01-02 12:17:23'),
(116, 'task', 'completed', 0, '[{"id":"64","task_name":"Gggg","client_id":"94","note_detail":"Cvvvv","priority":"1","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-02","start_datetime":"2017-01-02 12:21:00","end_datetime":"2017-01-02 15:21:00","task_completed_date":"2017-01-02 12:17:38","rating":"4","comments":"Vvv","property_id":"13","attribute_id":"49","status":"4","created_at":"2017-01-02 12:17:23","updated_at":"2017-01-02 12:17:38","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-02 12:17:38', '2017-01-02 12:17:38'),
(117, 'task', 'created', 0, '[{"id":"65","task_name":"Kdjd","client_id":"94","note_detail":"Ndnd","priority":"1","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-02","start_datetime":"2017-01-02 12:22:00","end_datetime":"2017-01-02 13:22:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"13","attribute_id":"49","status":"1","created_at":"2017-01-02 12:17:58","updated_at":"2017-01-02 12:17:58","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-02 12:17:58', '2017-01-02 12:17:58'),
(118, 'task', 'created', 0, '[{"id":"66","task_name":"Jxjxj","client_id":"94","note_detail":"Nsndn","priority":"1","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-02","start_datetime":"2017-01-02 13:22:00","end_datetime":"2017-01-02 17:22:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"13","attribute_id":"49","status":"1","created_at":"2017-01-02 12:18:17","updated_at":"2017-01-02 12:18:17","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-02 12:18:17', '2017-01-02 12:18:17'),
(119, 'task', 'created', 0, '[{"id":"67","task_name":"Hh","client_id":"94","note_detail":"Nznzbz","priority":"1","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-02","start_datetime":"2017-01-02 12:22:00","end_datetime":"2017-01-02 14:22:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"13","attribute_id":"49","status":"1","created_at":"2017-01-02 12:18:33","updated_at":"2017-01-02 12:18:33","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-02 12:18:33', '2017-01-02 12:18:33'),
(120, 'task', 'completed', 0, '[{"id":"67","task_name":"Hh","client_id":"94","note_detail":"Nznzbz","priority":"1","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-02","start_datetime":"2017-01-02 12:22:00","end_datetime":"2017-01-02 14:22:00","task_completed_date":"2017-01-02 12:19:24","rating":"4","comments":"Nxnxnd","property_id":"13","attribute_id":"49","status":"4","created_at":"2017-01-02 12:18:33","updated_at":"2017-01-02 12:19:24","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-02 12:19:24', '2017-01-02 12:19:24'),
(121, 'task', 'completed', 0, '[{"id":"66","task_name":"Jxjxj","client_id":"94","note_detail":"Nsndn","priority":"1","document_id":"0","technician_id":"88","assigned_date":"2017-01-02","scheduled_date":"2017-01-02","start_datetime":"2017-01-02 13:22:00","end_datetime":"2017-01-02 17:22:00","task_completed_date":"2017-01-02 12:19:32","rating":"3","comments":"Dbbdn","property_id":"13","attribute_id":"49","status":"4","created_at":"2017-01-02 12:18:17","updated_at":"2017-01-02 12:19:32","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-02 12:19:32', '2017-01-02 12:19:32'),
(122, 'task', 'completed', 0, '[{"id":"65","task_name":"Kdjd","client_id":"94","note_detail":"Ndnd","priority":"1","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-02","start_datetime":"2017-01-02 12:22:00","end_datetime":"2017-01-02 13:22:00","task_completed_date":"2017-01-02 12:19:40","rating":"4","comments":"Ndndnd","property_id":"13","attribute_id":"49","status":"4","created_at":"2017-01-02 12:17:58","updated_at":"2017-01-02 12:19:40","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-02 12:19:40', '2017-01-02 12:19:40'),
(123, 'task', 'created', 0, '[{"id":"68","task_name":"Hdjd","client_id":"94","note_detail":"Hzhzb","priority":"1","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-02","start_datetime":"2017-01-02 12:24:00","end_datetime":"2017-01-02 14:24:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"13","attribute_id":"49","status":"1","created_at":"2017-01-02 12:19:58","updated_at":"2017-01-02 12:19:58","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-02 12:19:58', '2017-01-02 12:19:58'),
(124, 'task', 'completed', 0, '[{"id":"68","task_name":"Hdjd","client_id":"94","note_detail":"Hzhzb","priority":"1","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-02","start_datetime":"2017-01-02 12:24:00","end_datetime":"2017-01-02 14:24:00","task_completed_date":"2017-01-02 12:20:24","rating":"4","comments":"Xbx","property_id":"13","attribute_id":"49","status":"4","created_at":"2017-01-02 12:19:58","updated_at":"2017-01-02 12:20:24","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-02 12:20:24', '2017-01-02 12:20:24'),
(125, 'task', 'created', 0, '[{"id":"69","task_name":"Dbbxbx","client_id":"94","note_detail":"Hahshs","priority":"1","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-02","start_datetime":"2017-01-02 12:25:00","end_datetime":"2017-01-02 15:25:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"13","attribute_id":"49","status":"1","created_at":"2017-01-02 12:20:45","updated_at":"2017-01-02 12:20:45","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-02 12:20:45', '2017-01-02 12:20:45'),
(126, 'task', 'completed', 0, '[{"id":"69","task_name":"Dbbxbx","client_id":"94","note_detail":"Hahshs","priority":"1","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-02","start_datetime":"2017-01-02 12:25:00","end_datetime":"2017-01-02 15:25:00","task_completed_date":"2017-01-02 12:20:53","rating":"4","comments":"Shshs","property_id":"13","attribute_id":"49","status":"4","created_at":"2017-01-02 12:20:45","updated_at":"2017-01-02 12:20:53","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-02 12:20:54', '2017-01-02 12:20:54'),
(127, 'task', 'created', 0, '[{"id":"70","task_name":"Jdjdjdj","client_id":"94","note_detail":"Hdhdh","priority":"1","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-02","start_datetime":"2017-01-02 12:25:00","end_datetime":"2017-01-02 14:25:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"13","attribute_id":"49","status":"1","created_at":"2017-01-02 12:21:12","updated_at":"2017-01-02 12:21:12","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-02 12:21:12', '2017-01-02 12:21:12'),
(128, 'task', 'completed', 0, '[{"id":"70","task_name":"Jdjdjdj","client_id":"94","note_detail":"Hdhdh","priority":"1","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-02","start_datetime":"2017-01-02 12:25:00","end_datetime":"2017-01-02 14:25:00","task_completed_date":"2017-01-02 12:21:43","rating":"4","comments":"Gvv","property_id":"13","attribute_id":"49","status":"4","created_at":"2017-01-02 12:21:12","updated_at":"2017-01-02 12:21:43","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-02 12:21:43', '2017-01-02 12:21:43'),
(129, 'task', 'created', 0, '[{"id":"71","task_name":"Ghh","client_id":"94","note_detail":"Ggg","priority":"1","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-02","start_datetime":"2017-01-02 12:26:00","end_datetime":"2017-01-02 13:26:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"13","attribute_id":"49","status":"1","created_at":"2017-01-02 12:21:59","updated_at":"2017-01-02 12:21:59","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-02 12:22:00', '2017-01-02 12:22:00'),
(130, 'task', 'completed', 0, '[{"id":"71","task_name":"Ghh","client_id":"94","note_detail":"Ggg","priority":"1","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-02","start_datetime":"2017-01-02 12:26:00","end_datetime":"2017-01-02 13:26:00","task_completed_date":"2017-01-02 12:22:09","rating":"4","comments":"Hh","property_id":"13","attribute_id":"49","status":"4","created_at":"2017-01-02 12:21:59","updated_at":"2017-01-02 12:22:09","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-02 12:22:09', '2017-01-02 12:22:09'),
(131, 'task', 'created', 0, '[{"id":"72","task_name":"Vvv","client_id":"94","note_detail":"Ggg","priority":"1","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-02","start_datetime":"2017-01-02 12:26:00","end_datetime":"2017-01-02 13:26:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"13","attribute_id":"49","status":"1","created_at":"2017-01-02 12:22:22","updated_at":"2017-01-02 12:22:22","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-02 12:22:22', '2017-01-02 12:22:22'),
(132, 'task', 'completed', 0, '[{"id":"72","task_name":"Vvv","client_id":"94","note_detail":"Ggg","priority":"1","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-02","start_datetime":"2017-01-02 12:26:00","end_datetime":"2017-01-02 13:26:00","task_completed_date":"2017-01-02 12:23:26","rating":"5","comments":"Vhh","property_id":"13","attribute_id":"49","status":"4","created_at":"2017-01-02 12:22:22","updated_at":"2017-01-02 12:23:26","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-02 12:23:26', '2017-01-02 12:23:26'),
(133, 'task', 'created', 0, '[{"id":"73","task_name":"Ggg","client_id":"94","note_detail":"Fggg","priority":"1","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-02","start_datetime":"2017-01-02 12:28:00","end_datetime":"2017-01-02 14:28:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"13","attribute_id":"49","status":"1","created_at":"2017-01-02 12:23:45","updated_at":"2017-01-02 12:23:45","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-02 12:23:45', '2017-01-02 12:23:45'),
(134, 'task', 'completed', 0, '[{"id":"73","task_name":"Ggg","client_id":"94","note_detail":"Fggg","priority":"1","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-02","start_datetime":"2017-01-02 12:28:00","end_datetime":"2017-01-02 14:28:00","task_completed_date":"2017-01-02 12:24:12","rating":"4","comments":"Bbb","property_id":"13","attribute_id":"49","status":"4","created_at":"2017-01-02 12:23:45","updated_at":"2017-01-02 12:24:12","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-02 12:24:12', '2017-01-02 12:24:12'),
(135, 'note', 'created', 0, '[{"id":"4","user_id":"95","client_notes":"Details for the note Details for the noteDetails for the note. Details for the note","title":"New note","created_at":"2017-01-05 14:17:20","updated_at":"2017-01-05 14:17:20","deleted_at":"0000-00-00 00:00:00"}]', '2017-01-05 14:17:20', '2017-01-05 14:17:20'),
(136, 'task', 'created', 0, '[{"id":"74","task_name":"Front door","client_id":"96","note_detail":"New door needs installation. It''s leaning in the hall.","priority":"1","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-08","start_datetime":"2017-01-08 03:22:00","end_datetime":"2017-01-08 05:22:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"14","attribute_id":"50","status":"1","created_at":"2017-01-06 03:18:28","updated_at":"2017-01-06 03:18:28","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-06 03:18:28', '2017-01-06 03:18:28'),
(137, 'task', 'created', 0, '[{"id":"75","task_name":"Chimney repair","client_id":"96","note_detail":"There are bricks falling out of the chimney","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-30","start_datetime":"2017-01-30 14:00:00","end_datetime":"2017-01-30 23:23:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"14","attribute_id":"50","status":"1","created_at":"2017-01-06 03:19:54","updated_at":"2017-01-06 03:19:54","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-06 03:19:54', '2017-01-06 03:19:54'),
(138, 'task', 'created', 0, '[{"id":"76","task_name":"Rebuild front porch","client_id":"95","note_detail":"I want a nicer porch","priority":"1","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-05","start_datetime":"2017-01-05 14:32:00","end_datetime":"2017-01-06 02:32:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"15","attribute_id":"51","status":"1","created_at":"2017-01-06 03:28:01","updated_at":"2017-01-06 03:28:01","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-06 03:28:01', '2017-01-06 03:28:01'),
(139, 'task', 'created', 0, '[{"id":"77","task_name":"Dfg","client_id":"89","note_detail":"Dfgdfg","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-07","start_datetime":"2017-01-07 06:58:00","end_datetime":"2017-01-07 07:04:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"10","attribute_id":"38","status":"1","created_at":"2017-01-06 06:54:24","updated_at":"2017-01-06 06:54:24","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-06 06:54:24', '2017-01-06 06:54:24'),
(140, 'task', 'created', 0, '[{"id":"78","task_name":"Patch hole by tub","client_id":"97","note_detail":"6\\"x6\\"","priority":"2","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-06","start_datetime":"2017-01-06 20:00:00","end_datetime":"2017-01-06 22:00:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"16","attribute_id":"52","status":"1","created_at":"2017-01-06 10:12:37","updated_at":"2017-01-06 10:12:37","deleted_at":"0000-00-00 00:00:00","task_documents":[{"id":"39","type":"2","type_id":"78","filename":"http:\\/\\/frontline.debutinfotech.com\\/uploads\\/userfiles\\/thumb_1483697550.jpeg","created_at":"2017-01-06 10:12:37","updated_at":"2017-01-06 10:12:37","deleted_at":null}]}]', '2017-01-06 10:12:37', '2017-01-06 10:12:37'),
(141, 'task', 'created', 0, '[{"id":"79","task_name":"Replace door knob","client_id":"95","note_detail":"Quickly","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-20","start_datetime":"2017-01-20 15:39:00","end_datetime":"2017-01-21 03:40:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"15","attribute_id":"51","status":"1","created_at":"2017-01-06 15:35:30","updated_at":"2017-01-06 15:35:30","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-06 15:35:30', '2017-01-06 15:35:30'),
(142, 'task', 'created', 0, '[{"id":"80","task_name":"Fix shower","client_id":"95","note_detail":"Shower head is clogged","priority":"2","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-08","start_datetime":"2017-01-08 18:38:00","end_datetime":"2017-01-09 02:38:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"15","attribute_id":"51","status":"1","created_at":"2017-01-06 18:23:02","updated_at":"2017-01-06 18:23:02","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-06 18:23:02', '2017-01-06 18:23:02'),
(143, 'task', 'rescheduled', 0, '[{"id":"49","task_name":"A new task is going to be created here please veri","client_id":"89","note_detail":"Some sdklfjsdklfjs oiflsdfijldsfldskflsdkflskdflkldsfkldsfkldfkldslfdksfldksflkdsflkdslfksdlfksdlfklsfkdldsfklkfdslkflsdkfldskflkdsflkfdlkdslfkdslfkldsfosdfosdifoidsfoweoiweoriowerioweiroweiroreiowierlkfdlkglkflgdfkglkdflgfkdgldfgm,mb,cvbcvbcv,bcv,bmcv,bm","priority":"3","document_id":"0","technician_id":"0","assigned_date":"2017-01-02","scheduled_date":"2017-01-01","start_datetime":"2017-01-01 18:30:00","end_datetime":"2017-01-02 16:40:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"10","attribute_id":"38","status":"1","created_at":"2017-01-02 10:07:54","updated_at":"2017-01-10 07:02:36","deleted_at":"0000-00-00 00:00:00","task_documents":[{"id":"28","type":"2","type_id":"49","filename":"http:\\/\\/frontline.debutinfotech.com\\/uploads\\/userfiles\\/thumb_1483351670.jpeg","created_at":"2017-01-02 10:07:54","updated_at":"2017-01-02 10:07:54","deleted_at":null},{"id":"29","type":"2","type_id":"49","filename":"http:\\/\\/frontline.debutinfotech.com\\/uploads\\/userfiles\\/thumb_1483351671.jpeg","created_at":"2017-01-02 10:07:54","updated_at":"2017-01-02 10:07:54","deleted_at":null},{"id":"30","type":"2","type_id":"49","filename":"http:\\/\\/frontline.debutinfotech.com\\/uploads\\/userfiles\\/thumb_1483351673.jpeg","created_at":"2017-01-02 10:07:54","updated_at":"2017-01-02 10:07:54","deleted_at":null},{"id":"31","type":"2","type_id":"49","filename":"http:\\/\\/frontline.debutinfotech.com\\/uploads\\/userfiles\\/thumb_1483351673.jpeg","created_at":"2017-01-02 10:07:54","updated_at":"2017-01-02 10:07:54","deleted_at":null}]}]', '2017-01-10 07:02:36', '2017-01-10 07:02:36'),
(144, 'task', 'rescheduled', 0, '[{"id":"49","task_name":"A new task is going to be created here please veri","client_id":"89","note_detail":"Some sdklfjsdklfjs oiflsdfijldsfldskflsdkflskdflkldsfkldsfkldfkldslfdksfldksflkdsflkdslfksdlfksdlfklsfkdldsfklkfdslkflsdkfldskflkdsflkfdlkdslfkdslfkldsfosdfosdifoidsfoweoiweoriowerioweiroweiroreiowierlkfdlkglkflgdfkglkdflgfkdgldfgm,mb,cvbcvbcv,bcv,bmcv,bm","priority":"3","document_id":"0","technician_id":"0","assigned_date":"2017-01-02","scheduled_date":"2017-01-01","start_datetime":"2017-01-01 18:30:00","end_datetime":"2017-01-02 05:30:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"10","attribute_id":"38","status":"1","created_at":"2017-01-02 10:07:54","updated_at":"2017-01-10 07:02:51","deleted_at":"0000-00-00 00:00:00","task_documents":[{"id":"28","type":"2","type_id":"49","filename":"http:\\/\\/frontline.debutinfotech.com\\/uploads\\/userfiles\\/thumb_1483351670.jpeg","created_at":"2017-01-02 10:07:54","updated_at":"2017-01-02 10:07:54","deleted_at":null},{"id":"29","type":"2","type_id":"49","filename":"http:\\/\\/frontline.debutinfotech.com\\/uploads\\/userfiles\\/thumb_1483351671.jpeg","created_at":"2017-01-02 10:07:54","updated_at":"2017-01-02 10:07:54","deleted_at":null},{"id":"30","type":"2","type_id":"49","filename":"http:\\/\\/frontline.debutinfotech.com\\/uploads\\/userfiles\\/thumb_1483351673.jpeg","created_at":"2017-01-02 10:07:54","updated_at":"2017-01-02 10:07:54","deleted_at":null},{"id":"31","type":"2","type_id":"49","filename":"http:\\/\\/frontline.debutinfotech.com\\/uploads\\/userfiles\\/thumb_1483351673.jpeg","created_at":"2017-01-02 10:07:54","updated_at":"2017-01-02 10:07:54","deleted_at":null}]}]', '2017-01-10 07:02:51', '2017-01-10 07:02:51'),
(145, 'task', 'deleted', 0, '{"id":"49","task_name":"A new task is going to be created here please veri","client_id":"89","note_detail":"Some sdklfjsdklfjs oiflsdfijldsfldskflsdkflskdflkldsfkldsfkldfkldslfdksfldksflkdsflkdslfksdlfksdlfklsfkdldsfklkfdslkflsdkfldskflkdsflkfdlkdslfkdslfkldsfosdfosdifoidsfoweoiweoriowerioweiroweiroreiowierlkfdlkglkflgdfkglkdflgfkdgldfgm,mb,cvbcvbcv,bcv,bmcv,bm","priority":"3","document_id":"0","technician_id":"0","assigned_date":"2017-01-02","scheduled_date":"2017-01-01","start_datetime":"2017-01-01 18:30:00","end_datetime":"2017-01-02 05:30:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"10","attribute_id":"38","status":"1","created_at":"2017-01-02 10:07:54","updated_at":"2017-01-10 07:02:51","deleted_at":"0000-00-00 00:00:00"}', '2017-01-10 07:03:05', '2017-01-10 07:03:05'),
(146, 'task', 'rescheduled', 0, '[{"id":"57","task_name":"Sdefsdf","client_id":"89","note_detail":"Sdffdssdf","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-01","start_datetime":"2017-01-01 18:30:00","end_datetime":"2017-01-01 18:50:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"10","attribute_id":"38","status":"1","created_at":"2017-01-02 10:49:56","updated_at":"2017-01-10 07:03:36","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-10 07:03:36', '2017-01-10 07:03:36'),
(147, 'task', 'rescheduled', 0, '[{"id":"57","task_name":"Sdefsdf","client_id":"89","note_detail":"Sdffdssdf","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-01","start_datetime":"2017-01-01 18:30:00","end_datetime":"2017-01-02 07:20:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"10","attribute_id":"38","status":"1","created_at":"2017-01-02 10:49:56","updated_at":"2017-01-10 07:04:04","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-10 07:04:04', '2017-01-10 07:04:04'),
(148, 'task', 'rescheduled', 0, '[{"id":"57","task_name":"Sdefsdf","client_id":"89","note_detail":"Sdffdssdf","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-01","start_datetime":"2017-01-01 18:30:00","end_datetime":"2017-01-02 06:20:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"10","attribute_id":"38","status":"1","created_at":"2017-01-02 10:49:56","updated_at":"2017-01-10 07:04:16","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-10 07:04:16', '2017-01-10 07:04:16'),
(149, 'task', 'created', 0, '[{"id":"81","task_name":".,.cv,","client_id":"89","note_detail":"Zxczxcxcz","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-10","start_datetime":"2017-01-10 18:30:00","end_datetime":"2017-01-10 19:10:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"10","attribute_id":"38","status":"1","created_at":"2017-01-10 07:21:49","updated_at":"2017-01-10 07:21:49","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-10 07:21:49', '2017-01-10 07:21:49'),
(150, 'task', 'created', 0, '[{"id":"82","task_name":"Blank task","client_id":"89","note_detail":"","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"0000-00-00","start_datetime":"0000-00-00 00:00:00","end_datetime":"0000-00-00 00:00:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"10","attribute_id":"38","status":"1","created_at":"2017-01-10 10:21:08","updated_at":"2017-01-10 10:21:08","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-10 10:21:08', '2017-01-10 10:21:08'),
(151, 'task', 'created', 0, '[{"id":"83","task_name":"Mu tak","client_id":"89","note_detail":"Hahshs","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-11","start_datetime":"2017-01-11 10:28:00","end_datetime":"2017-01-11 10:29:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"10","attribute_id":"38","status":"1","created_at":"2017-01-10 10:24:15","updated_at":"2017-01-10 10:24:15","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-10 10:24:15', '2017-01-10 10:24:15'),
(152, 'task', 'deleted', 0, '{"id":"83","task_name":"Mu tak","client_id":"89","note_detail":"Hahshs","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-11","start_datetime":"2017-01-11 10:28:00","end_datetime":"2017-01-11 10:29:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"10","attribute_id":"38","status":"1","created_at":"2017-01-10 10:24:15","updated_at":"2017-01-10 10:24:15","deleted_at":"0000-00-00 00:00:00"}', '2017-01-10 10:24:20', '2017-01-10 10:24:20'),
(153, 'task', 'deleted', 0, '{"id":"81","task_name":".,.cv,","client_id":"89","note_detail":"Zxczxcxcz","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-10","start_datetime":"2017-01-10 18:30:00","end_datetime":"2017-01-10 19:10:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"10","attribute_id":"38","status":"1","created_at":"2017-01-10 07:21:49","updated_at":"2017-01-10 07:21:49","deleted_at":"0000-00-00 00:00:00"}', '2017-01-10 10:24:35', '2017-01-10 10:24:35');
INSERT INTO `crone_jobs` (`id`, `type`, `status`, `action_status`, `description`, `created_at`, `updated_at`) VALUES
(154, 'task', 'created', 0, '[{"id":"84","task_name":"Some data","client_id":"89","note_detail":"","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"0000-00-00","start_datetime":"0000-00-00 00:00:00","end_datetime":"0000-00-00 00:00:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"10","attribute_id":"38","status":"1","created_at":"2017-01-10 10:26:21","updated_at":"2017-01-10 10:26:21","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-10 10:26:21', '2017-01-10 10:26:21'),
(155, 'task', 'created', 0, '[{"id":"85","task_name":"My task","client_id":"89","note_detail":"","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"0000-00-00","start_datetime":"0000-00-00 00:00:00","end_datetime":"0000-00-00 00:00:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"10","attribute_id":"38","status":"1","created_at":"2017-01-10 10:30:53","updated_at":"2017-01-10 10:30:53","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-10 10:30:54', '2017-01-10 10:30:54'),
(156, 'task', 'created', 0, '[{"id":"87","task_name":"Cleaning","client_id":"89","note_detail":"","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"0000-00-00","start_datetime":"0000-00-00 00:00:00","end_datetime":"0000-00-00 00:00:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"10","attribute_id":"38","status":"1","created_at":"2017-01-10 12:12:02","updated_at":"2017-01-10 12:12:02","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-10 12:12:02', '2017-01-10 12:12:02'),
(157, 'task', 'completed', 0, '[{"id":"77","task_name":"Dfg","client_id":"89","note_detail":"Dfgdfg","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-07","start_datetime":"2017-01-07 06:58:00","end_datetime":"2017-01-07 07:04:00","task_completed_date":"2017-01-10 12:27:56","rating":"2","comments":"","property_id":"10","attribute_id":"38","status":"4","created_at":"2017-01-06 06:54:24","updated_at":"2017-01-10 12:27:56","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-10 12:27:56', '2017-01-10 12:27:56'),
(158, 'task', 'created', 0, '[{"id":"88","task_name":"Blank tasjk","client_id":"89","note_detail":"","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"0000-00-00","start_datetime":"0000-00-00 00:00:00","end_datetime":"0000-00-00 00:00:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"10","attribute_id":"38","status":"1","created_at":"2017-01-11 06:15:42","updated_at":"2017-01-11 06:15:42","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-11 06:15:43', '2017-01-11 06:15:43'),
(159, 'task', 'deleted', 0, '{"id":"88","task_name":"Blank tasjk","client_id":"89","note_detail":"","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"0000-00-00","start_datetime":"0000-00-00 00:00:00","end_datetime":"0000-00-00 00:00:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"10","attribute_id":"38","status":"1","created_at":"2017-01-11 06:15:42","updated_at":"2017-01-11 06:15:42","deleted_at":"0000-00-00 00:00:00"}', '2017-01-11 09:59:48', '2017-01-11 09:59:48'),
(160, 'task', 'deleted', 0, '{"id":"87","task_name":"Cleaning","client_id":"89","note_detail":"Some notes","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"0000-00-00","start_datetime":"0000-00-00 00:00:00","end_datetime":"0000-00-00 00:00:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"10","attribute_id":"38","status":"1","created_at":"2017-01-10 12:12:02","updated_at":"2017-01-10 12:25:29","deleted_at":"0000-00-00 00:00:00"}', '2017-01-11 09:59:55', '2017-01-11 09:59:55'),
(161, 'task', 'created', 0, '[{"id":"89","task_name":"Hello","client_id":"95","note_detail":"Hahnajaha jajajaya gajajah gahabahahahshjsjsshjsjsjsjsjsjsjshsjsjshshsjssjhssh","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-12","start_datetime":"2017-01-12 23:29:00","end_datetime":"2017-01-13 13:48:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"15","attribute_id":"51","status":"1","created_at":"2017-01-11 11:25:09","updated_at":"2017-01-11 11:25:09","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-11 11:25:09', '2017-01-11 11:25:09'),
(162, 'task', 'completed', 0, '[{"id":"89","task_name":"Hello","client_id":"95","note_detail":"Hahnajaha jajajaya gajajah gahabahahahshjsjsshjsjsjsjsjsjsjshsjsjshshsjssjhssh","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-12","start_datetime":"2017-01-12 23:29:00","end_datetime":"2017-01-13 13:48:00","task_completed_date":"2017-01-11 11:25:21","rating":"2","comments":"","property_id":"15","attribute_id":"51","status":"4","created_at":"2017-01-11 11:25:09","updated_at":"2017-01-11 11:25:21","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-11 11:25:21', '2017-01-11 11:25:21'),
(163, 'note', 'created', 0, '[{"id":"5","user_id":"95","client_notes":"Testting","title":"Hello","created_at":"2017-01-11 11:26:24","updated_at":"2017-01-11 11:26:24","deleted_at":"0000-00-00 00:00:00"}]', '2017-01-11 11:26:24', '2017-01-11 11:26:24'),
(164, 'task', 'created', 0, '[{"id":"90","task_name":"Hole in wall","client_id":"98","note_detail":"6x6","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-20","start_datetime":"2017-01-20 13:46:00","end_datetime":"2017-01-20 16:46:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"17","attribute_id":"53","status":"1","created_at":"2017-01-11 12:42:12","updated_at":"2017-01-11 12:42:12","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-11 12:42:12', '2017-01-11 12:42:12'),
(165, 'task', 'rescheduled', 0, '[{"id":"90","task_name":"Hole in wall","client_id":"98","note_detail":"6x6","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-20","start_datetime":"2017-01-20 13:46:00","end_datetime":"2017-01-20 16:46:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"17","attribute_id":"53","status":"1","created_at":"2017-01-11 12:42:12","updated_at":"2017-01-11 12:46:11","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-11 12:46:11', '2017-01-11 12:46:11'),
(166, 'task', 'rescheduled', 0, '[{"id":"90","task_name":"Hole in wall","client_id":"98","note_detail":"6x6","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-20","start_datetime":"2017-01-20 13:46:00","end_datetime":"2017-01-20 16:46:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"17","attribute_id":"53","status":"1","created_at":"2017-01-11 12:42:12","updated_at":"2017-01-11 12:48:38","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-11 12:48:38', '2017-01-11 12:48:38'),
(167, 'task', 'rescheduled', 0, '[{"id":"90","task_name":"Hole in wall","client_id":"98","note_detail":"6x6","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-21","start_datetime":"2017-01-21 13:53:00","end_datetime":"2017-01-21 16:46:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"17","attribute_id":"53","status":"1","created_at":"2017-01-11 12:42:12","updated_at":"2017-01-11 12:48:53","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-11 12:48:53', '2017-01-11 12:48:53'),
(168, 'note', 'created', 0, '[{"id":"6","user_id":"98","client_notes":"Yehdj","title":"Teurj","created_at":"2017-01-11 12:58:54","updated_at":"2017-01-11 12:58:54","deleted_at":"0000-00-00 00:00:00"}]', '2017-01-11 12:58:54', '2017-01-11 12:58:54'),
(169, 'note', 'created', 0, '[{"id":"7","user_id":"98","client_notes":"Need at house tomorrow for closing","title":"322 Fulton closing ASAP","created_at":"2017-01-11 12:59:01","updated_at":"2017-01-11 12:59:01","deleted_at":"0000-00-00 00:00:00"}]', '2017-01-11 12:59:01', '2017-01-11 12:59:01'),
(170, 'task', 'created', 0, '[{"id":"91","task_name":"Cleaning","client_id":"95","note_detail":"Urgent","priority":"1","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-14","start_datetime":"2017-01-14 06:15:00","end_datetime":"2017-01-14 06:18:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"15","attribute_id":"51","status":"1","created_at":"2017-01-13 06:12:04","updated_at":"2017-01-13 06:12:04","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-13 06:12:05', '2017-01-13 06:12:05'),
(171, 'task', 'rescheduled', 0, '[{"id":"91","task_name":"Cleaning","client_id":"95","note_detail":"Urgent","priority":"1","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-14","start_datetime":"2017-01-14 06:15:00","end_datetime":"2017-01-14 06:18:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"15","attribute_id":"51","status":"1","created_at":"2017-01-13 06:12:04","updated_at":"2017-01-13 06:13:08","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-13 06:13:08', '2017-01-13 06:13:08'),
(172, 'note', 'created', 0, '[{"id":"8","user_id":"89","client_notes":"MY new notes appear here","title":"Some notes","created_at":"2017-01-17 05:35:24","updated_at":"2017-01-17 05:35:24","deleted_at":"0000-00-00 00:00:00"}]', '2017-01-17 05:35:24', '2017-01-17 05:35:24'),
(173, 'note', 'deleted', 0, '{"id":"8","user_id":"89","client_notes":"MY new notes appear here","title":"Some notes","created_at":"2017-01-17 05:35:24","updated_at":"2017-01-17 05:35:24","deleted_at":"0000-00-00 00:00:00"}', '2017-01-17 05:35:38', '2017-01-17 05:35:38'),
(174, 'note', 'created', 0, '[{"id":"9","user_id":"89","client_notes":"Need to clean the floor.kafhjksafjkasjfkfjkmnc kasjksajfk asf asdfkjkdskfdjf iyeuiueiwruiewr. Eiwuiewuriewru ieruiewruiewruieuriewurfdskfjdsfkjdkfjdskfjdksfjkfsjksdfjkdsfjkdsfjkdsfjkdsfjksdjfkdsfjkdsfjdsfkjsdfknkmsdfkjsdfkjdsfkjdsfkjdskfjsdkfsdkfjksdfjksd","title":"Need to urgent worker","created_at":"2017-01-17 06:31:20","updated_at":"2017-01-17 06:31:20","deleted_at":"0000-00-00 00:00:00"}]', '2017-01-17 06:31:21', '2017-01-17 06:31:21'),
(175, 'note', 'updated', 0, '[{"id":"9","user_id":"89","client_notes":"Need to clean the floor.kafhjksafjkasjfkfjkmnc kasjksajfk asf asdfkjkdskfdjf iyeuiueiwruiewr. Eiwuiewuriewru ieruiewruiewruieuriewurfdskfjdsfkjdkfjdskfjdksfjkfsjksdfjkdsfjkdsfjkdsfjkdsfjksdjfkdsfjkdsfjdsfkjsdfknkmsdfkjsdfkjdsfkjdsfkjdskfjsdkfsdkfjkend","title":"Need to urgent worker","created_at":"2017-01-17 06:31:20","updated_at":"2017-01-17 06:54:26","deleted_at":"0000-00-00 00:00:00"}]', '2017-01-17 06:54:26', '2017-01-17 06:54:26'),
(176, 'note', 'created', 0, '[{"id":"10","user_id":"99","client_notes":"This is my notes.I need to write some values here.","title":"My note","created_at":"2017-01-17 08:15:56","updated_at":"2017-01-17 08:15:56","deleted_at":"0000-00-00 00:00:00"}]', '2017-01-17 08:15:57', '2017-01-17 08:15:57'),
(177, 'task', 'completed', 0, '[{"id":"57","task_name":"Sdefsdf","client_id":"89","note_detail":"Sdffdssdf","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-01","start_datetime":"2017-01-01 18:30:00","end_datetime":"2017-01-02 06:20:00","task_completed_date":"2017-01-17 08:53:22","rating":"4","comments":"","property_id":"10","attribute_id":"38","status":"4","created_at":"2017-01-02 10:49:56","updated_at":"2017-01-17 08:53:22","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-17 08:53:23', '2017-01-17 08:53:23'),
(178, 'task', 'completed', 0, '[{"id":"85","task_name":"My task","client_id":"89","note_detail":"","priority":"1","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-10","start_datetime":"2017-01-10 18:30:00","end_datetime":"2017-01-10 19:00:00","task_completed_date":"2017-01-17 09:37:21","rating":"3","comments":"","property_id":"10","attribute_id":"38","status":"4","created_at":"2017-01-10 10:30:53","updated_at":"2017-01-17 09:37:21","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-17 09:37:21', '2017-01-17 09:37:21'),
(179, 'task', 'completed', 0, '[{"id":"58","task_name":"Gfdgf","client_id":"89","note_detail":"Dfgdfg","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-02","start_datetime":"2017-01-02 10:55:00","end_datetime":"2017-01-02 10:56:00","task_completed_date":"2017-01-17 09:40:07","rating":"3","comments":"","property_id":"10","attribute_id":"38","status":"4","created_at":"2017-01-02 10:51:19","updated_at":"2017-01-17 09:40:07","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-17 09:40:07', '2017-01-17 09:40:07'),
(180, 'task', 'created', 0, '[{"id":"92","task_name":"Dfdfsdf","client_id":"89","note_detail":"Sdffd","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-18","start_datetime":"2017-01-18 09:46:00","end_datetime":"2017-01-18 10:00:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"10","attribute_id":"38","status":"1","created_at":"2017-01-17 09:42:06","updated_at":"2017-01-17 09:42:06","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-17 09:42:06', '2017-01-17 09:42:06'),
(181, 'task', 'completed', 0, '[{"id":"92","task_name":"Dfdfsdf","client_id":"89","note_detail":"Sdffd","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-18","start_datetime":"2017-01-18 09:46:00","end_datetime":"2017-01-18 10:00:00","task_completed_date":"2017-01-17 09:42:14","rating":"3","comments":"","property_id":"10","attribute_id":"38","status":"4","created_at":"2017-01-17 09:42:06","updated_at":"2017-01-17 09:42:14","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-17 09:42:14', '2017-01-17 09:42:14'),
(182, 'task', 'created', 0, '[{"id":"93","task_name":"Mytasj","client_id":"89","note_detail":"Dsfdsffsdfdsf","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-17","start_datetime":"2017-01-17 09:49:00","end_datetime":"2017-01-17 10:10:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"10","attribute_id":"38","status":"1","created_at":"2017-01-17 09:44:57","updated_at":"2017-01-17 09:44:57","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-17 09:44:57', '2017-01-17 09:44:57'),
(183, 'task', 'completed', 0, '[{"id":"93","task_name":"Mytasj","client_id":"89","note_detail":"Dsfdsffsdfdsf","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-17","start_datetime":"2017-01-17 09:49:00","end_datetime":"2017-01-17 10:10:00","task_completed_date":"2017-01-17 09:45:06","rating":"2","comments":"","property_id":"10","attribute_id":"38","status":"4","created_at":"2017-01-17 09:44:57","updated_at":"2017-01-17 09:45:06","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-17 09:45:06', '2017-01-17 09:45:06'),
(184, 'task', 'created', 0, '[{"id":"94","task_name":"Sdfsdf","client_id":"89","note_detail":"Sdfsdfdsf","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-17","start_datetime":"2017-01-17 09:50:00","end_datetime":"2017-01-17 10:00:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"10","attribute_id":"38","status":"1","created_at":"2017-01-17 09:45:31","updated_at":"2017-01-17 09:45:31","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-17 09:45:31', '2017-01-17 09:45:31'),
(185, 'task', 'created', 0, '[{"id":"95","task_name":"Sdfdsf","client_id":"89","note_detail":"Sdfsdfsdfds","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-17","start_datetime":"2017-01-17 09:50:00","end_datetime":"2017-01-17 10:20:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"10","attribute_id":"38","status":"1","created_at":"2017-01-17 09:45:44","updated_at":"2017-01-17 09:45:44","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-17 09:45:44', '2017-01-17 09:45:44'),
(186, 'task', 'completed', 0, '[{"id":"94","task_name":"Sdfsdf","client_id":"89","note_detail":"Sdfsdfdsf","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-17","start_datetime":"2017-01-17 09:50:00","end_datetime":"2017-01-17 10:00:00","task_completed_date":"2017-01-17 09:45:50","rating":"3","comments":"","property_id":"10","attribute_id":"38","status":"4","created_at":"2017-01-17 09:45:31","updated_at":"2017-01-17 09:45:50","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-17 09:45:50', '2017-01-17 09:45:50'),
(187, 'task', 'completed', 0, '[{"id":"95","task_name":"Sdfdsf","client_id":"89","note_detail":"Sdfsdfsdfds","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-17","start_datetime":"2017-01-17 09:50:00","end_datetime":"2017-01-17 10:20:00","task_completed_date":"2017-01-17 09:45:59","rating":"4","comments":"","property_id":"10","attribute_id":"38","status":"4","created_at":"2017-01-17 09:45:44","updated_at":"2017-01-17 09:45:59","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-17 09:45:59', '2017-01-17 09:45:59'),
(188, 'task', 'created', 0, '[{"id":"96","task_name":"Sdfdsf","client_id":"89","note_detail":"Sdfsdfdf","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-17","start_datetime":"2017-01-17 09:52:00","end_datetime":"2017-01-17 10:00:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"10","attribute_id":"38","status":"1","created_at":"2017-01-17 09:47:30","updated_at":"2017-01-17 09:47:30","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-17 09:47:30', '2017-01-17 09:47:30'),
(189, 'task', 'completed', 0, '[{"id":"96","task_name":"Sdfdsf","client_id":"89","note_detail":"Sdfsdfdf","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-17","start_datetime":"2017-01-17 09:52:00","end_datetime":"2017-01-17 10:00:00","task_completed_date":"2017-01-17 09:47:35","rating":"3","comments":"","property_id":"10","attribute_id":"38","status":"4","created_at":"2017-01-17 09:47:30","updated_at":"2017-01-17 09:47:35","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-17 09:47:35', '2017-01-17 09:47:35'),
(190, 'task', 'created', 0, '[{"id":"97","task_name":"New task","client_id":"89","note_detail":"Some notes","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-17","start_datetime":"2017-01-17 09:55:00","end_datetime":"2017-01-17 10:20:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"10","attribute_id":"38","status":"1","created_at":"2017-01-17 09:50:43","updated_at":"2017-01-17 09:50:43","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-17 09:50:43', '2017-01-17 09:50:43'),
(191, 'task', 'completed', 0, '[{"id":"97","task_name":"New task","client_id":"89","note_detail":"Some notes","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-17","start_datetime":"2017-01-17 09:55:00","end_datetime":"2017-01-17 10:20:00","task_completed_date":"2017-01-17 09:50:53","rating":"5","comments":"","property_id":"10","attribute_id":"38","status":"4","created_at":"2017-01-17 09:50:43","updated_at":"2017-01-17 09:50:53","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-17 09:50:53', '2017-01-17 09:50:53'),
(192, 'task', 'created', 0, '[{"id":"105","task_name":"testing name sdfds","client_id":"89","note_detail":"","priority":"1","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2016-11-11","start_datetime":"2016-11-11 00:00:00","end_datetime":"2016-11-11 00:00:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"5","attribute_id":"72","status":"1","created_at":"2017-01-17 10:04:05","updated_at":"2017-01-17 10:04:05","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-17 10:04:05', '2017-01-17 10:04:05'),
(193, 'task', 'created', 0, '[{"id":"106","task_name":"testing name qqqqq","client_id":"89","note_detail":"","priority":"1","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2016-11-11","start_datetime":"2016-11-11 00:00:00","end_datetime":"2016-11-11 00:00:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"5","attribute_id":"72","status":"1","created_at":"2017-01-17 10:05:27","updated_at":"2017-01-17 10:05:27","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-17 10:05:27', '2017-01-17 10:05:27'),
(194, 'task', 'completed', 0, '[{"id":"103","task_name":"Fddsf","client_id":"89","note_detail":"Sdfsdf","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-17","start_datetime":"2017-01-17 10:00:00","end_datetime":"2017-01-17 10:10:00","task_completed_date":"2017-01-17 10:08:47","rating":"3","comments":"","property_id":"10","attribute_id":"38","status":"4","created_at":"2017-01-17 09:55:35","updated_at":"2017-01-17 10:08:47","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-17 10:08:48', '2017-01-17 10:08:48'),
(195, 'task', 'completed', 0, '[{"id":"98","task_name":"My task","client_id":"89","note_detail":"Soem notes goes here","priority":"1","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-17","start_datetime":"2017-01-17 09:58:00","end_datetime":"2017-01-17 10:10:00","task_completed_date":"2017-01-17 10:08:59","rating":"3","comments":"","property_id":"10","attribute_id":"38","status":"4","created_at":"2017-01-17 09:53:22","updated_at":"2017-01-17 10:08:59","deleted_at":"0000-00-00 00:00:00","task_documents":[{"id":"40","type":"2","type_id":"98","filename":"http:\\/\\/frontline.debutinfotech.com\\/uploads\\/userfiles\\/thumb_1484646801.jpeg","created_at":"2017-01-17 09:53:22","updated_at":"2017-01-17 09:53:22","deleted_at":null}]}]', '2017-01-17 10:08:59', '2017-01-17 10:08:59'),
(196, 'task', 'completed', 0, '[{"id":"99","task_name":"My task","client_id":"89","note_detail":"Soem notes goes here","priority":"1","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-17","start_datetime":"2017-01-17 09:58:00","end_datetime":"2017-01-17 10:10:00","task_completed_date":"2017-01-17 10:11:08","rating":"3","comments":"","property_id":"10","attribute_id":"38","status":"4","created_at":"2017-01-17 09:53:30","updated_at":"2017-01-17 10:11:08","deleted_at":"0000-00-00 00:00:00","task_documents":[{"id":"41","type":"2","type_id":"99","filename":"http:\\/\\/frontline.debutinfotech.com\\/uploads\\/userfiles\\/thumb_1484646801.jpeg","created_at":"2017-01-17 09:53:30","updated_at":"2017-01-17 09:53:30","deleted_at":null}]}]', '2017-01-17 10:11:08', '2017-01-17 10:11:08'),
(197, 'task', 'completed', 0, '[{"id":"100","task_name":"Some gtask","client_id":"89","note_detail":"Asfasf","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-17","start_datetime":"2017-01-17 09:58:00","end_datetime":"2017-01-17 10:20:00","task_completed_date":"2017-01-17 10:11:27","rating":"5","comments":"This isi some details about the completyed task","property_id":"10","attribute_id":"38","status":"4","created_at":"2017-01-17 09:53:47","updated_at":"2017-01-17 10:11:27","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-17 10:11:27', '2017-01-17 10:11:27'),
(198, 'task', 'completed', 0, '[{"id":"101","task_name":"Hgh","client_id":"89","note_detail":"Ghmhmgm","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-17","start_datetime":"2017-01-17 09:58:00","end_datetime":"2017-01-17 10:00:00","task_completed_date":"2017-01-17 10:11:42","rating":"5","comments":"Very good swervice","property_id":"10","attribute_id":"38","status":"4","created_at":"2017-01-17 09:54:01","updated_at":"2017-01-17 10:11:42","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-17 10:11:42', '2017-01-17 10:11:42'),
(199, 'task', 'completed', 0, '[{"id":"102","task_name":"Fddsf","client_id":"89","note_detail":"Sdfsdf","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-17","start_datetime":"2017-01-17 10:00:00","end_datetime":"2017-01-17 10:10:00","task_completed_date":"2017-01-17 10:12:13","rating":"1","comments":"Some rating i provided","property_id":"10","attribute_id":"38","status":"4","created_at":"2017-01-17 09:55:33","updated_at":"2017-01-17 10:12:13","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-17 10:12:13', '2017-01-17 10:12:13'),
(200, 'task', 'created', 0, '[{"id":"107","task_name":"New task","client_id":"89","note_detail":"Some notes","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-17","start_datetime":"2017-01-17 10:17:00","end_datetime":"2017-01-17 10:20:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"10","attribute_id":"38","status":"1","created_at":"2017-01-17 10:12:44","updated_at":"2017-01-17 10:12:44","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-17 10:12:45', '2017-01-17 10:12:45'),
(201, 'task', 'created', 0, '[{"id":"108","task_name":"Cleaning","client_id":"99","note_detail":"Some cleaning needs to done","priority":"1","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-17","start_datetime":"2017-01-17 12:11:00","end_datetime":"2017-01-17 12:20:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"19","attribute_id":"56","status":"1","created_at":"2017-01-17 12:06:58","updated_at":"2017-01-17 12:06:58","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-17 12:06:58', '2017-01-17 12:06:58'),
(202, 'task', 'completed', 0, '[{"id":"108","task_name":"Cleaning","client_id":"99","note_detail":"Some cleaning needs to done","priority":"1","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-17","start_datetime":"2017-01-17 12:11:00","end_datetime":"2017-01-17 12:20:00","task_completed_date":"2017-01-17 12:07:24","rating":"5","comments":"Best work","property_id":"19","attribute_id":"56","status":"4","created_at":"2017-01-17 12:06:58","updated_at":"2017-01-17 12:07:24","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-17 12:07:24', '2017-01-17 12:07:24'),
(203, 'task', 'created', 0, '[{"id":"109","task_name":"Fug","client_id":"95","note_detail":"Fgh","priority":"1","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-22","start_datetime":"2017-01-22 13:03:00","end_datetime":"2017-01-22 13:07:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"15","attribute_id":"51","status":"1","created_at":"2017-01-20 13:00:20","updated_at":"2017-01-20 13:00:20","deleted_at":"0000-00-00 00:00:00","task_documents":[{"id":"42","type":"2","type_id":"109","filename":"http:\\/\\/frontline.debutinfotech.com\\/uploads\\/userfiles\\/thumb_1484917160.jpeg","created_at":"2017-01-20 13:00:20","updated_at":"2017-01-20 13:00:20","deleted_at":null},{"id":"43","type":"2","type_id":"109","filename":"http:\\/\\/frontline.debutinfotech.com\\/uploads\\/userfiles\\/thumb_1484917217.jpeg","created_at":"2017-01-20 13:00:21","updated_at":"2017-01-20 13:00:21","deleted_at":null}]}]', '2017-01-20 13:00:21', '2017-01-20 13:00:21'),
(204, 'task', 'completed', 0, '[{"id":"109","task_name":"Fug","client_id":"95","note_detail":"Fgh","priority":"1","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-22","start_datetime":"2017-01-22 13:03:00","end_datetime":"2017-01-22 13:07:00","task_completed_date":"2017-01-20 13:00:37","rating":"4","comments":"Dff","property_id":"15","attribute_id":"51","status":"4","created_at":"2017-01-20 13:00:20","updated_at":"2017-01-20 13:00:37","deleted_at":"0000-00-00 00:00:00","task_documents":[{"id":"42","type":"2","type_id":"109","filename":"http:\\/\\/frontline.debutinfotech.com\\/uploads\\/userfiles\\/thumb_1484917160.jpeg","created_at":"2017-01-20 13:00:20","updated_at":"2017-01-20 13:00:20","deleted_at":null},{"id":"43","type":"2","type_id":"109","filename":"http:\\/\\/frontline.debutinfotech.com\\/uploads\\/userfiles\\/thumb_1484917217.jpeg","created_at":"2017-01-20 13:00:21","updated_at":"2017-01-20 13:00:21","deleted_at":null}]}]', '2017-01-20 13:00:37', '2017-01-20 13:00:37'),
(205, 'task', 'created', 0, '[{"id":"110","task_name":"My task","client_id":"89","note_detail":"","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-25","start_datetime":"2017-01-25 15:15:00","end_datetime":"2017-01-25 16:15:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"10","attribute_id":"38","status":"1","created_at":"2017-01-23 09:41:32","updated_at":"2017-01-23 09:41:32","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-23 09:41:32', '2017-01-23 09:41:32'),
(206, 'task', 'created', 0, '[{"id":"111","task_name":"Some task","client_id":"89","note_detail":"","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-20","start_datetime":"2017-01-20 15:15:00","end_datetime":"2017-01-20 16:15:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"10","attribute_id":"38","status":"1","created_at":"2017-01-23 10:20:23","updated_at":"2017-01-23 10:20:23","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-23 10:20:23', '2017-01-23 10:20:23'),
(207, 'task', 'deleted', 0, '{"id":"111","task_name":"Some task","client_id":"89","note_detail":"","priority":"1","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-20","start_datetime":"2017-01-20 00:15:00","end_datetime":"2017-01-20 01:15:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"10","attribute_id":"38","status":"1","created_at":"2017-01-23 10:20:23","updated_at":"2017-01-23 11:38:45","deleted_at":"0000-00-00 00:00:00"}', '2017-01-23 11:39:09', '2017-01-23 11:39:09'),
(208, 'task', 'deleted', 0, '{"id":"107","task_name":"Cleaning Store","client_id":"89","note_detail":"Some notes goes here as well nowdfvgdgfdgfdgfd","priority":"2","document_id":"0","technician_id":"88","assigned_date":"2017-01-19","scheduled_date":"2017-01-18","start_datetime":"2017-01-18 10:52:00","end_datetime":"2017-01-18 11:00:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"10","attribute_id":"38","status":"3","created_at":"2017-01-17 10:12:44","updated_at":"2017-01-19 07:11:17","deleted_at":"0000-00-00 00:00:00"}', '2017-01-23 11:39:26', '2017-01-23 11:39:26'),
(209, 'task', 'deleted', 0, '{"id":"110","task_name":"My task","client_id":"89","note_detail":"","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-25","start_datetime":"2017-01-25 15:15:00","end_datetime":"2017-01-25 16:15:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"10","attribute_id":"38","status":"1","created_at":"2017-01-23 09:41:32","updated_at":"2017-01-23 11:39:38","deleted_at":"0000-00-00 00:00:00"}', '2017-01-23 11:40:29', '2017-01-23 11:40:29'),
(210, 'task', 'created', 0, '[{"id":"112","task_name":"My task","client_id":"89","note_detail":"","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-27","start_datetime":"2017-01-27 00:15:00","end_datetime":"2017-01-27 01:15:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"10","attribute_id":"38","status":"1","created_at":"2017-01-23 11:40:51","updated_at":"2017-01-23 11:40:51","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-23 11:40:51', '2017-01-23 11:40:51'),
(211, 'task', 'deleted', 0, '{"id":"112","task_name":"Cleaning and washing for office location","client_id":"89","note_detail":"Some","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-26","start_datetime":"2017-01-26 00:15:00","end_datetime":"2017-01-26 01:15:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"10","attribute_id":"38","status":"1","created_at":"2017-01-23 11:40:51","updated_at":"2017-01-23 12:27:39","deleted_at":"0000-00-00 00:00:00"}', '2017-01-23 12:27:50', '2017-01-23 12:27:50'),
(212, 'task', 'created', 0, '[{"id":"113","task_name":"My task","client_id":"89","note_detail":"Some notes for this task goes here.I am creating some more notes for this here","priority":"2","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-24","start_datetime":"2017-01-24 00:15:00","end_datetime":"2017-01-24 01:15:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"10","attribute_id":"38","status":"1","created_at":"2017-01-23 12:28:37","updated_at":"2017-01-23 12:28:37","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-23 12:28:37', '2017-01-23 12:28:37'),
(213, 'task', 'created', 0, '[{"id":"114","task_name":"Your task","client_id":"89","note_detail":"","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-03-02","start_datetime":"2017-03-02 00:15:00","end_datetime":"2017-03-02 01:15:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"10","attribute_id":"38","status":"1","created_at":"2017-01-23 12:54:54","updated_at":"2017-01-23 12:54:54","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-23 12:54:54', '2017-01-23 12:54:54'),
(214, 'task', 'rescheduled', 0, '[{"id":"114","task_name":"Your task","client_id":"89","note_detail":"","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-06","start_datetime":"2017-01-06 00:15:00","end_datetime":"2017-01-06 01:15:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"10","attribute_id":"38","status":"1","created_at":"2017-01-23 12:54:54","updated_at":"2017-01-23 13:09:20","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-23 13:09:20', '2017-01-23 13:09:20'),
(215, 'task', 'rescheduled', 0, '[{"id":"114","task_name":"Your task","client_id":"89","note_detail":"","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-12","start_datetime":"2017-01-12 15:15:00","end_datetime":"2017-01-12 16:15:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"10","attribute_id":"38","status":"1","created_at":"2017-01-23 12:54:54","updated_at":"2017-01-23 13:27:41","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-23 13:27:41', '2017-01-23 13:27:41'),
(216, 'task', 'rescheduled', 0, '[{"id":"114","task_name":"Your task","client_id":"89","note_detail":"","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-13","start_datetime":"2017-01-13 00:15:00","end_datetime":"2017-01-13 01:15:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"10","attribute_id":"38","status":"1","created_at":"2017-01-23 12:54:54","updated_at":"2017-01-23 13:31:46","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-23 13:31:46', '2017-01-23 13:31:46'),
(217, 'task', 'rescheduled', 0, '[{"id":"114","task_name":"Your task","client_id":"89","note_detail":"","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-19","start_datetime":"2017-01-19 15:15:00","end_datetime":"2017-01-19 16:15:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"10","attribute_id":"38","status":"1","created_at":"2017-01-23 12:54:54","updated_at":"2017-01-23 13:33:29","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-23 13:33:30', '2017-01-23 13:33:30'),
(218, 'task', 'rescheduled', 0, '[{"id":"114","task_name":"Your task","client_id":"89","note_detail":"","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-11","start_datetime":"2017-01-11 00:15:00","end_datetime":"2017-01-11 01:15:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"10","attribute_id":"38","status":"1","created_at":"2017-01-23 12:54:54","updated_at":"2017-01-23 13:34:48","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-23 13:34:48', '2017-01-23 13:34:48'),
(219, 'task', 'rescheduled', 0, '[{"id":"114","task_name":"Your task","client_id":"89","note_detail":"","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-20","start_datetime":"2017-01-20 10:15:00","end_datetime":"2017-01-20 11:15:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"10","attribute_id":"38","status":"1","created_at":"2017-01-23 12:54:54","updated_at":"2017-01-23 13:45:50","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-23 13:45:50', '2017-01-23 13:45:50'),
(220, 'task', 'rescheduled', 0, '[{"id":"114","task_name":"Your task","client_id":"89","note_detail":"","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-02-12","start_datetime":"2017-02-12 10:15:00","end_datetime":"2017-02-12 11:15:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"10","attribute_id":"38","status":"1","created_at":"2017-01-23 12:54:54","updated_at":"2017-01-23 13:45:57","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-23 13:45:57', '2017-01-23 13:45:57'),
(221, 'task', 'created', 0, '[{"id":"115","task_name":"Cleaning","client_id":"99","note_detail":"","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-11","start_datetime":"2017-01-11 00:15:00","end_datetime":"2017-01-11 01:15:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"19","attribute_id":"56","status":"1","created_at":"2017-01-23 13:46:50","updated_at":"2017-01-23 13:46:50","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-23 13:46:50', '2017-01-23 13:46:50'),
(222, 'task', 'created', 0, '[{"id":"116","task_name":"Washing","client_id":"99","note_detail":"Need to wash some more offcie location near out current location.We will do it by today & try to finish this particular task as soon as possible because we have a strict dealine","priority":"2","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-27","start_datetime":"2017-01-27 00:15:00","end_datetime":"2017-01-27 01:15:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"19","attribute_id":"56","status":"1","created_at":"2017-01-23 13:48:23","updated_at":"2017-01-23 13:48:23","deleted_at":"0000-00-00 00:00:00","task_documents":[{"id":"49","type":"2","type_id":"116","filename":"http:\\/\\/frontline.debutinfotech.com\\/uploads\\/userfiles\\/thumb_1485179301.jpeg","created_at":"2017-01-23 13:48:24","updated_at":"2017-01-23 13:48:24","deleted_at":null},{"id":"50","type":"2","type_id":"116","filename":"http:\\/\\/frontline.debutinfotech.com\\/uploads\\/userfiles\\/thumb_1485179303.jpeg","created_at":"2017-01-23 13:48:24","updated_at":"2017-01-23 13:48:24","deleted_at":null}]}]', '2017-01-23 13:48:24', '2017-01-23 13:48:24'),
(223, 'task', 'rescheduled', 0, '[{"id":"116","task_name":"Washing","client_id":"99","note_detail":"Need to wash some more offcie location near out current location.We will do it by today & try to finish this particular task as soon as possible because we have a strict dealine","priority":"2","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-19","start_datetime":"2017-01-19 15:15:00","end_datetime":"2017-01-19 16:15:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"19","attribute_id":"56","status":"1","created_at":"2017-01-23 13:48:23","updated_at":"2017-01-23 13:49:06","deleted_at":"0000-00-00 00:00:00","task_documents":[{"id":"49","type":"2","type_id":"116","filename":"http:\\/\\/frontline.debutinfotech.com\\/uploads\\/userfiles\\/thumb_1485179301.jpeg","created_at":"2017-01-23 13:48:24","updated_at":"2017-01-23 13:48:24","deleted_at":null},{"id":"50","type":"2","type_id":"116","filename":"http:\\/\\/frontline.debutinfotech.com\\/uploads\\/userfiles\\/thumb_1485179303.jpeg","created_at":"2017-01-23 13:48:24","updated_at":"2017-01-23 13:48:24","deleted_at":null}]}]', '2017-01-23 13:49:06', '2017-01-23 13:49:06'),
(224, 'task', 'rescheduled', 0, '[{"id":"116","task_name":"Washing","client_id":"99","note_detail":"Need to wash some more offcie location near out current location.We will do it by today & try to finish this particular task as soon as possible because we have a strict dealine","priority":"2","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-21","start_datetime":"2017-01-21 11:15:00","end_datetime":"2017-01-21 12:15:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"19","attribute_id":"56","status":"1","created_at":"2017-01-23 13:48:23","updated_at":"2017-01-23 13:51:09","deleted_at":"0000-00-00 00:00:00","task_documents":[{"id":"49","type":"2","type_id":"116","filename":"http:\\/\\/frontline.debutinfotech.com\\/uploads\\/userfiles\\/thumb_1485179301.jpeg","created_at":"2017-01-23 13:48:24","updated_at":"2017-01-23 13:48:24","deleted_at":null},{"id":"50","type":"2","type_id":"116","filename":"http:\\/\\/frontline.debutinfotech.com\\/uploads\\/userfiles\\/thumb_1485179303.jpeg","created_at":"2017-01-23 13:48:24","updated_at":"2017-01-23 13:48:24","deleted_at":null}]}]', '2017-01-23 13:51:09', '2017-01-23 13:51:09'),
(225, 'task', 'completed', 0, '[{"id":"116","task_name":"Dry Cleaning","client_id":"99","note_detail":"It''s not urgent","priority":"2","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-19","start_datetime":"2017-01-19 15:15:00","end_datetime":"2017-01-19 16:15:00","task_completed_date":"2017-01-23 13:56:40","rating":"4","comments":"","property_id":"19","attribute_id":"56","status":"4","created_at":"2017-01-23 13:48:23","updated_at":"2017-01-23 13:56:40","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-23 13:56:40', '2017-01-23 13:56:40'),
(226, 'task', 'deleted', 0, '{"id":"115","task_name":"Cleaning","client_id":"99","note_detail":"Some notes","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-26","start_datetime":"2017-01-26 11:15:00","end_datetime":"2017-01-26 12:15:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"19","attribute_id":"56","status":"1","created_at":"2017-01-23 13:46:50","updated_at":"2017-01-23 13:57:29","deleted_at":"0000-00-00 00:00:00"}', '2017-01-23 13:57:57', '2017-01-23 13:57:57'),
(227, 'task', 'created', 0, '[{"id":"117","task_name":"NEW TASK","client_id":"99","note_detail":"SOME NOTES","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-25","start_datetime":"2017-01-25 00:15:00","end_datetime":"2017-01-25 01:15:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"19","attribute_id":"56","status":"1","created_at":"2017-01-24 04:24:03","updated_at":"2017-01-24 04:24:03","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-24 04:24:03', '2017-01-24 04:24:03'),
(228, 'task', 'deleted', 0, '{"id":"117","task_name":"NEW TASK","client_id":"99","note_detail":"SOME NOTES","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-25","start_datetime":"2017-01-25 00:15:00","end_datetime":"2017-01-25 01:15:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"19","attribute_id":"56","status":"1","created_at":"2017-01-24 04:24:03","updated_at":"2017-01-24 04:24:03","deleted_at":"0000-00-00 00:00:00"}', '2017-01-24 04:24:14', '2017-01-24 04:24:14'),
(229, 'task', 'created', 0, '[{"id":"118","task_name":"Some Data","client_id":"99","note_detail":"Few notes are being added here","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-03-11","start_datetime":"2017-03-11 00:15:00","end_datetime":"2017-03-11 01:15:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"19","attribute_id":"56","status":"1","created_at":"2017-01-24 04:25:00","updated_at":"2017-01-24 04:25:00","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-24 04:25:00', '2017-01-24 04:25:00'),
(230, 'task', 'rescheduled', 0, '[{"id":"113","task_name":"Not my task","client_id":"89","note_detail":"I have deleted some notes from here","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-02-16","start_datetime":"2017-02-16 00:15:00","end_datetime":"2017-02-16 01:15:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"10","attribute_id":"38","status":"1","created_at":"2017-01-23 12:28:37","updated_at":"2017-01-24 06:36:26","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-24 06:36:26', '2017-01-24 06:36:26'),
(231, 'task', 'rescheduled', 0, '[{"id":"114","task_name":"Your task","client_id":"89","note_detail":"","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-02-17","start_datetime":"2017-02-17 10:15:00","end_datetime":"2017-02-17 11:15:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"10","attribute_id":"38","status":"1","created_at":"2017-01-23 12:54:54","updated_at":"2017-01-24 07:10:19","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-24 07:10:19', '2017-01-24 07:10:19'),
(232, 'task', 'deleted', 0, '{"id":"114","task_name":"Your task","client_id":"89","note_detail":"","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-02-17","start_datetime":"2017-02-17 10:15:00","end_datetime":"2017-02-17 11:15:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"10","attribute_id":"38","status":"1","created_at":"2017-01-23 12:54:54","updated_at":"2017-01-24 07:10:19","deleted_at":"0000-00-00 00:00:00"}', '2017-01-24 07:17:15', '2017-01-24 07:17:15'),
(233, 'task', 'deleted', 0, '{"id":"113","task_name":"Not my task","client_id":"89","note_detail":"I have deleted some notes from here","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-02-16","start_datetime":"2017-02-16 00:15:00","end_datetime":"2017-02-16 01:15:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"10","attribute_id":"38","status":"1","created_at":"2017-01-23 12:28:37","updated_at":"2017-01-24 06:36:26","deleted_at":"0000-00-00 00:00:00"}', '2017-01-24 07:17:56', '2017-01-24 07:17:56'),
(234, 'task', 'created', 0, '[{"id":"119","task_name":"Cleaning","client_id":"89","note_detail":"My notes are being added here","priority":"2","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-26","start_datetime":"2017-01-26 15:15:00","end_datetime":"2017-01-26 16:15:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"10","attribute_id":"38","status":"1","created_at":"2017-01-24 07:18:44","updated_at":"2017-01-24 07:18:44","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-24 07:18:44', '2017-01-24 07:18:44'),
(235, 'task', 'created', 0, '[{"id":"120","task_name":"Washind","client_id":"89","note_detail":"Saasfa;fa;df","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-02-01","start_datetime":"2017-02-01 11:15:00","end_datetime":"2017-02-01 12:15:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"10","attribute_id":"38","status":"1","created_at":"2017-01-24 07:22:38","updated_at":"2017-01-24 07:22:38","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-24 07:22:38', '2017-01-24 07:22:38');
INSERT INTO `crone_jobs` (`id`, `type`, `status`, `action_status`, `description`, `created_at`, `updated_at`) VALUES
(236, 'task', 'created', 0, '[{"id":"121","task_name":"Empty task","client_id":"89","note_detail":"","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"0000-00-00","start_datetime":"0000-00-00 00:00:00","end_datetime":"0000-00-00 00:00:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"10","attribute_id":"38","status":"1","created_at":"2017-01-24 07:22:48","updated_at":"2017-01-24 07:22:48","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-24 07:22:48', '2017-01-24 07:22:48'),
(237, 'task', 'deleted', 0, '{"id":"16","task_name":"Erftt","client_id":"89","note_detail":"Etert","priority":"1","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-02","start_datetime":"2017-01-02 06:44:00","end_datetime":"2017-01-02 06:50:00","task_completed_date":"2017-01-02 06:44:43","rating":"3","comments":"","property_id":"6","attribute_id":"14","status":"4","created_at":"2017-01-02 06:40:11","updated_at":"2017-01-02 06:44:43","deleted_at":"0000-00-00 00:00:00"}', '2017-01-24 09:02:59', '2017-01-24 09:02:59'),
(238, 'task', 'created', 0, '[{"id":"122","task_name":"Jagraj task","client_id":"89","note_detail":"Some notes","priority":"2","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-24","start_datetime":"2017-01-24 10:15:00","end_datetime":"2017-01-24 11:15:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"10","attribute_id":"38","status":"1","created_at":"2017-01-24 09:04:30","updated_at":"2017-01-24 09:04:30","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-24 09:04:30', '2017-01-24 09:04:30'),
(239, 'task', 'deleted', 0, '{"id":"120","task_name":"Washind","client_id":"89","note_detail":"Saasfa;fa;df","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-02-01","start_datetime":"2017-02-01 11:15:00","end_datetime":"2017-02-01 12:15:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"10","attribute_id":"38","status":"1","created_at":"2017-01-24 07:22:38","updated_at":"2017-01-24 07:22:38","deleted_at":"0000-00-00 00:00:00"}', '2017-01-24 09:16:43', '2017-01-24 09:16:43'),
(240, 'task', 'deleted', 0, '{"id":"122","task_name":"Jagraj task","client_id":"89","note_detail":"Some notes","priority":"2","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-24","start_datetime":"2017-01-24 10:15:00","end_datetime":"2017-01-24 11:15:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"10","attribute_id":"38","status":"1","created_at":"2017-01-24 09:04:30","updated_at":"2017-01-24 09:04:30","deleted_at":"0000-00-00 00:00:00"}', '2017-01-24 09:17:33', '2017-01-24 09:17:33'),
(241, 'task', 'deleted', 0, '{"id":"119","task_name":"Cleaning","client_id":"89","note_detail":"My notes are being added here","priority":"1","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-26","start_datetime":"2017-01-26 15:15:00","end_datetime":"2017-01-26 16:15:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"10","attribute_id":"38","status":"1","created_at":"2017-01-24 07:18:44","updated_at":"2017-01-24 07:21:21","deleted_at":"0000-00-00 00:00:00"}', '2017-01-24 09:17:59', '2017-01-24 09:17:59'),
(242, 'task', 'created', 0, '[{"id":"123","task_name":"Some tal","client_id":"89","note_detail":"Some tasks are aded","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-24","start_datetime":"2017-01-24 10:15:00","end_datetime":"2017-01-24 11:15:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"10","attribute_id":"38","status":"1","created_at":"2017-01-24 09:18:46","updated_at":"2017-01-24 09:18:46","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-24 09:18:46', '2017-01-24 09:18:46'),
(243, 'task', 'deleted', 0, '{"id":"123","task_name":"Some tal","client_id":"89","note_detail":"Some tasks are aded","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-24","start_datetime":"2017-01-24 10:15:00","end_datetime":"2017-01-24 11:15:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"10","attribute_id":"38","status":"1","created_at":"2017-01-24 09:18:46","updated_at":"2017-01-24 09:18:46","deleted_at":"0000-00-00 00:00:00"}', '2017-01-24 09:18:53', '2017-01-24 09:18:53'),
(244, 'task', 'created', 0, '[{"id":"124","task_name":"Hahah","client_id":"89","note_detail":"Bahha","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-24","start_datetime":"2017-01-24 10:15:00","end_datetime":"2017-01-24 11:15:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"10","attribute_id":"38","status":"1","created_at":"2017-01-24 09:19:22","updated_at":"2017-01-24 09:19:22","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-24 09:19:22', '2017-01-24 09:19:22'),
(245, 'task', 'created', 0, '[{"id":"125","task_name":"Hahsh","client_id":"89","note_detail":"BhHzp","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-04","start_datetime":"2017-01-04 00:15:00","end_datetime":"2017-01-04 01:15:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"10","attribute_id":"38","status":"1","created_at":"2017-01-24 09:20:10","updated_at":"2017-01-24 09:20:10","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-24 09:20:10', '2017-01-24 09:20:10'),
(246, 'task', 'created', 0, '[{"id":"126","task_name":"Gagagah","client_id":"89","note_detail":"Agahah","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-27","start_datetime":"2017-01-27 15:15:00","end_datetime":"2017-01-27 16:15:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"10","attribute_id":"38","status":"1","created_at":"2017-01-24 09:20:36","updated_at":"2017-01-24 09:20:36","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-24 09:20:36', '2017-01-24 09:20:36'),
(247, 'task', 'deleted', 0, '{"id":"124","task_name":"Hahah","client_id":"89","note_detail":"Bahha","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-24","start_datetime":"2017-01-24 10:15:00","end_datetime":"2017-01-24 11:15:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"10","attribute_id":"38","status":"1","created_at":"2017-01-24 09:19:22","updated_at":"2017-01-24 09:19:22","deleted_at":"0000-00-00 00:00:00"}', '2017-01-24 09:24:47', '2017-01-24 09:24:47'),
(248, 'task', 'created', 0, '[{"id":"127","task_name":"New task","client_id":"89","note_detail":"","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-24","start_datetime":"2017-01-24 10:15:00","end_datetime":"2017-01-24 11:15:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"10","attribute_id":"38","status":"1","created_at":"2017-01-24 09:35:09","updated_at":"2017-01-24 09:35:09","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-24 09:35:09', '2017-01-24 09:35:09'),
(249, 'task', 'deleted', 0, '{"id":"126","task_name":"Gagagah","client_id":"89","note_detail":"Agahah","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-27","start_datetime":"2017-01-27 15:15:00","end_datetime":"2017-01-27 16:15:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"10","attribute_id":"38","status":"1","created_at":"2017-01-24 09:20:36","updated_at":"2017-01-24 09:20:36","deleted_at":"0000-00-00 00:00:00"}', '2017-01-24 09:35:27', '2017-01-24 09:35:27'),
(250, 'task', 'rescheduled', 0, '[{"id":"121","task_name":"Empty task","client_id":"89","note_detail":"","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2000-01-24","start_datetime":"2000-01-24 00:15:00","end_datetime":"2000-01-24 01:15:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"10","attribute_id":"38","status":"1","created_at":"2017-01-24 07:22:48","updated_at":"2017-01-24 09:37:22","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-24 09:37:22', '2017-01-24 09:37:22'),
(251, 'task', 'deleted', 0, '{"id":"125","task_name":"Hahsh","client_id":"89","note_detail":"BhHzp","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-04","start_datetime":"2017-01-04 00:15:00","end_datetime":"2017-01-04 01:15:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"10","attribute_id":"38","status":"1","created_at":"2017-01-24 09:20:10","updated_at":"2017-01-24 09:20:10","deleted_at":"0000-00-00 00:00:00"}', '2017-01-24 09:38:26', '2017-01-24 09:38:26'),
(252, 'task', 'deleted', 0, '{"id":"121","task_name":"Empty task","client_id":"89","note_detail":"","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2000-01-24","start_datetime":"2000-01-24 00:15:00","end_datetime":"2000-01-24 01:15:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"10","attribute_id":"38","status":"1","created_at":"2017-01-24 07:22:48","updated_at":"2017-01-24 09:37:22","deleted_at":"0000-00-00 00:00:00"}', '2017-01-24 09:38:32', '2017-01-24 09:38:32'),
(253, 'task', 'created', 0, '[{"id":"128","task_name":"Latest task","client_id":"89","note_detail":"Some notes for rhis app goes here","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-28","start_datetime":"2017-01-28 11:15:00","end_datetime":"2017-01-28 12:15:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"10","attribute_id":"38","status":"1","created_at":"2017-01-24 09:39:01","updated_at":"2017-01-24 09:39:01","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-24 09:39:01', '2017-01-24 09:39:01'),
(254, 'task', 'rescheduled', 0, '[{"id":"128","task_name":"Latest task","client_id":"89","note_detail":"Some notes for rhis app goes here","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-24","start_datetime":"2017-01-24 11:15:00","end_datetime":"2017-01-24 12:15:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"10","attribute_id":"38","status":"1","created_at":"2017-01-24 09:39:01","updated_at":"2017-01-24 09:39:17","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-24 09:39:17', '2017-01-24 09:39:17'),
(255, 'task', 'completed', 0, '[{"id":"128","task_name":"Latest task","client_id":"89","note_detail":"Some notes for rhis app goes here","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-24","start_datetime":"2017-01-24 11:15:00","end_datetime":"2017-01-24 12:15:00","task_completed_date":"2017-01-24 09:39:36","rating":"5","comments":"Very nice job done !!","property_id":"10","attribute_id":"38","status":"4","created_at":"2017-01-24 09:39:01","updated_at":"2017-01-24 09:39:36","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-24 09:39:36', '2017-01-24 09:39:36'),
(256, 'task', 'created', 0, '[{"id":"129","task_name":"Teat task","client_id":"89","note_detail":"Some notes i have afded hete and need to see what svckcshhsbsjzbdjvs djbdkdbkd sjdjbdjdbs jdbdodjkdbdjdbd ndbdndkdjd jdkdkdjjdjdjdbd d. Djdndjdnbdjdjdjdjsj d dkdkkfkdjdjdbdjjdbdbdjndjdjdjdjdjdjhdbd","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-26","start_datetime":"2017-01-26 10:15:00","end_datetime":"2017-01-26 11:15:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"10","attribute_id":"38","status":"1","created_at":"2017-01-24 09:51:11","updated_at":"2017-01-24 09:51:11","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-24 09:51:11', '2017-01-24 09:51:11'),
(257, 'task', 'rescheduled', 0, '[{"id":"129","task_name":"Teat task","client_id":"89","note_detail":"Some notes i have afded hete and need to see what svckcshhsbsjzbdjvs djbdkdbkd sjdjbdjdbs jdbdodjkdbdjdbd ndbdndkdjd jdkdkdjjdjdjdbd d. Djdndjdnbdjdjdjdjsj d dkdkkfkdjdjdbdjjdbdbdjndjdjdjdjdjdjhdbd","priority":"2","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-02-05","start_datetime":"2017-02-05 00:15:00","end_datetime":"2017-02-05 01:15:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"10","attribute_id":"38","status":"1","created_at":"2017-01-24 09:51:11","updated_at":"2017-01-24 09:57:24","deleted_at":"0000-00-00 00:00:00","task_documents":[{"id":"52","type":"2","type_id":"129","filename":"http:\\/\\/frontline.debutinfotech.com\\/uploads\\/userfiles\\/thumb_1485251747.jpg","created_at":"2017-01-24 09:56:39","updated_at":"2017-01-24 09:56:39","deleted_at":null}]}]', '2017-01-24 09:57:24', '2017-01-24 09:57:24'),
(258, 'task', 'created', 0, '[{"id":"130","task_name":"Emplty task","client_id":"89","note_detail":"Some notes goes here","priority":"1","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-02-12","start_datetime":"2017-02-12 11:15:00","end_datetime":"2017-02-12 12:15:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"10","attribute_id":"38","status":"1","created_at":"2017-01-24 09:58:11","updated_at":"2017-01-24 09:58:11","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-24 09:58:11', '2017-01-24 09:58:11'),
(259, 'task', 'deleted', 0, '{"id":"130","task_name":"Emplty task","client_id":"89","note_detail":"Some notes goes here","priority":"1","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-02-12","start_datetime":"2017-02-12 11:15:00","end_datetime":"2017-02-12 12:15:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"10","attribute_id":"38","status":"1","created_at":"2017-01-24 09:58:11","updated_at":"2017-01-24 09:58:11","deleted_at":"0000-00-00 00:00:00"}', '2017-01-24 09:58:23', '2017-01-24 09:58:23'),
(260, 'task', 'created', 0, '[{"id":"131","task_name":"Empty task","client_id":"89","note_detail":"","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"0000-00-00","start_datetime":"0000-00-00 00:00:00","end_datetime":"0000-00-00 00:00:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"10","attribute_id":"38","status":"1","created_at":"2017-01-24 09:58:37","updated_at":"2017-01-24 09:58:37","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-24 09:58:37', '2017-01-24 09:58:37'),
(261, 'task', 'rescheduled', 0, '[{"id":"131","task_name":"Empty task","client_id":"89","note_detail":"","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-02-19","start_datetime":"2017-02-19 15:15:00","end_datetime":"2017-02-19 16:15:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"10","attribute_id":"38","status":"1","created_at":"2017-01-24 09:58:37","updated_at":"2017-01-24 10:16:11","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-24 10:16:11', '2017-01-24 10:16:11'),
(262, 'task', 'created', 0, '[{"id":"132","task_name":"My property task","client_id":"99","note_detail":"Some task motes","priority":"2","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-02-01","start_datetime":"2017-02-01 10:15:00","end_datetime":"2017-02-01 11:15:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"19","attribute_id":"56","status":"1","created_at":"2017-01-24 10:19:23","updated_at":"2017-01-24 10:19:23","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-24 10:19:23', '2017-01-24 10:19:23'),
(263, 'task', 'rescheduled', 0, '[{"id":"132","task_name":"My property task","client_id":"99","note_detail":"Some task motes","priority":"2","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-02-18","start_datetime":"2017-02-18 11:15:00","end_datetime":"2017-02-18 12:15:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"19","attribute_id":"56","status":"1","created_at":"2017-01-24 10:19:23","updated_at":"2017-01-24 10:19:38","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-24 10:19:38', '2017-01-24 10:19:38'),
(264, 'task', 'deleted', 0, '{"id":"132","task_name":"My property task","client_id":"99","note_detail":"Some task motes","priority":"2","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-02-27","start_datetime":"2017-02-27 15:15:00","end_datetime":"2017-02-27 16:15:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"19","attribute_id":"56","status":"1","created_at":"2017-01-24 10:19:23","updated_at":"2017-01-24 10:19:58","deleted_at":"0000-00-00 00:00:00"}', '2017-01-24 10:20:20', '2017-01-24 10:20:20'),
(265, 'task', 'deleted', 0, '{"id":"131","task_name":"Empty task","client_id":"89","note_detail":"","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-02-19","start_datetime":"2017-02-19 15:15:00","end_datetime":"2017-02-19 16:15:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"10","attribute_id":"38","status":"1","created_at":"2017-01-24 09:58:37","updated_at":"2017-01-24 10:16:11","deleted_at":"0000-00-00 00:00:00"}', '2017-01-24 10:35:03', '2017-01-24 10:35:03'),
(266, 'task', 'created', 0, '[{"id":"133","task_name":"Cleaning","client_id":"89","note_detail":"Some notes","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-28","start_datetime":"2017-01-28 11:15:00","end_datetime":"2017-01-28 12:15:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"10","attribute_id":"38","status":"1","created_at":"2017-01-24 10:35:24","updated_at":"2017-01-24 10:35:24","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-24 10:35:25', '2017-01-24 10:35:25'),
(267, 'task', 'rescheduled', 0, '[{"id":"133","task_name":"Cleaning","client_id":"89","note_detail":"Some notes","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-31","start_datetime":"2017-01-31 11:15:00","end_datetime":"2017-01-31 12:15:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"10","attribute_id":"38","status":"1","created_at":"2017-01-24 10:35:24","updated_at":"2017-01-24 10:35:55","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-24 10:35:55', '2017-01-24 10:35:55'),
(268, 'task', 'rescheduled', 0, '[{"id":"133","task_name":"Cleaning","client_id":"89","note_detail":"Some notes","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-02-10","start_datetime":"2017-02-10 11:15:00","end_datetime":"2017-02-10 12:15:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"10","attribute_id":"38","status":"1","created_at":"2017-01-24 10:35:24","updated_at":"2017-01-24 10:36:08","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-24 10:36:08', '2017-01-24 10:36:08'),
(269, 'task', 'rescheduled', 0, '[{"id":"133","task_name":"Cleaning","client_id":"89","note_detail":"Some notes","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-02-26","start_datetime":"2017-02-26 10:15:00","end_datetime":"2017-02-26 11:15:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"10","attribute_id":"38","status":"1","created_at":"2017-01-24 10:35:24","updated_at":"2017-01-24 10:36:40","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-24 10:36:41', '2017-01-24 10:36:41'),
(270, 'task', 'rescheduled', 0, '[{"id":"118","task_name":"Some Data","client_id":"99","note_detail":"Few notes are being added here","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-04-21","start_datetime":"2017-04-21 15:15:00","end_datetime":"2017-04-21 16:15:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"19","attribute_id":"56","status":"1","created_at":"2017-01-24 04:25:00","updated_at":"2017-01-24 10:39:34","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-24 10:39:34', '2017-01-24 10:39:34'),
(271, 'task', 'created', 0, '[{"id":"134","task_name":"Hshshs","client_id":"99","note_detail":"","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"0000-00-00","start_datetime":"0000-00-00 00:00:00","end_datetime":"0000-00-00 00:00:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"19","attribute_id":"56","status":"1","created_at":"2017-01-24 10:40:16","updated_at":"2017-01-24 10:40:16","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-24 10:40:16', '2017-01-24 10:40:16'),
(272, 'task', 'created', 0, '[{"id":"135","task_name":"Ff","client_id":"99","note_detail":"","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"0000-00-00","start_datetime":"0000-00-00 00:00:00","end_datetime":"0000-00-00 00:00:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"19","attribute_id":"56","status":"1","created_at":"2017-01-24 10:54:58","updated_at":"2017-01-24 10:54:58","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-24 10:54:58', '2017-01-24 10:54:58'),
(273, 'task', 'created', 0, '[{"id":"136","task_name":"Fuhhh","client_id":"99","note_detail":"Fhhff","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-31","start_datetime":"2017-01-31 10:15:00","end_datetime":"2017-01-31 11:15:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"19","attribute_id":"56","status":"1","created_at":"2017-01-24 11:16:44","updated_at":"2017-01-24 11:16:44","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-24 11:16:44', '2017-01-24 11:16:44'),
(274, 'task', 'created', 0, '[{"id":"137","task_name":"Fuhhh","client_id":"99","note_detail":"Fhhff","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-31","start_datetime":"2017-01-31 10:15:00","end_datetime":"2017-01-31 11:15:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"19","attribute_id":"56","status":"1","created_at":"2017-01-24 11:18:01","updated_at":"2017-01-24 11:18:01","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-24 11:18:01', '2017-01-24 11:18:01'),
(275, 'task', 'deleted', 0, '{"id":"137","task_name":"Fuhhh","client_id":"99","note_detail":"Fhhff","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-31","start_datetime":"2017-01-31 10:15:00","end_datetime":"2017-01-31 11:15:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"19","attribute_id":"56","status":"1","created_at":"2017-01-24 11:18:01","updated_at":"2017-01-24 11:18:01","deleted_at":"0000-00-00 00:00:00"}', '2017-01-24 11:29:19', '2017-01-24 11:29:19'),
(276, 'task', 'deleted', 0, '{"id":"129","task_name":"Teat task","client_id":"89","note_detail":"Some notes i have afded hete and need to see what svckcshhsbsjzbdjvs djbdkdbkd sjdjbdjdbs jdbdodjkdbdjdbd ndbdndkdjd jdkdkdjjdjdjdbd d. Djdndjdnbdjdjdjdjsj d dkdkkfkdjdjdbdjjdbdbdjndjdjdjdjdjdjhdbd","priority":"2","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-02-05","start_datetime":"2017-02-05 00:15:00","end_datetime":"2017-02-05 01:15:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"10","attribute_id":"38","status":"1","created_at":"2017-01-24 09:51:11","updated_at":"2017-01-24 09:57:24","deleted_at":"0000-00-00 00:00:00"}', '2017-01-24 11:37:33', '2017-01-24 11:37:33'),
(277, 'task', 'created', 0, '[{"id":"138","task_name":"Testing 24","client_id":"95","note_detail":"","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"0000-00-00","start_datetime":"0000-00-00 00:00:00","end_datetime":"0000-00-00 00:00:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"15","attribute_id":"51","status":"1","created_at":"2017-01-24 12:07:34","updated_at":"2017-01-24 12:07:34","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-24 12:07:34', '2017-01-24 12:07:34'),
(278, 'task', 'created', 0, '[{"id":"139","task_name":"Tdghh","client_id":"95","note_detail":"Cjcjcjccjcjcjjccjcjjccjcjcj Cjcjcjccjcjcjjccjcjjccjcjcj cjvkcjjcjccjc vvkckkcfjgk fikvckcjvkcjjcjccjc vvkckkcfjgk fikvck","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-28","start_datetime":"2017-01-28 15:15:00","end_datetime":"2017-01-28 16:15:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"15","attribute_id":"51","status":"1","created_at":"2017-01-24 12:13:15","updated_at":"2017-01-24 12:13:15","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-24 12:13:16', '2017-01-24 12:13:16'),
(279, 'note', 'created', 0, '[{"id":"11","user_id":"95","client_notes":"Cjcjcjccjcjcjjccjcjjccjcjcj cjvkcjjcjccjc vvkckkcfjgk fikvck Cjcjcjccjcjcjjccjcjjccjcjcj cjvkcjjcjccjc vvkckkcfjgk fikvck","title":"Tstin","created_at":"2017-01-24 12:14:33","updated_at":"2017-01-24 12:14:33","deleted_at":"0000-00-00 00:00:00"}]', '2017-01-24 12:14:33', '2017-01-24 12:14:33'),
(280, 'note', 'updated', 0, '[{"id":"11","user_id":"95","client_notes":"Cjcjcjccjcjcjjccjcjjccjcjcj cjvkcjjcjccjc vvkckkcfjgk fikvck Cjcjcjccjcjcjjccjcjjccjcjcj cjvkcjjcjccjc vvkckkcfjgk filbert","title":"Tstin","created_at":"2017-01-24 12:14:33","updated_at":"2017-01-24 12:14:56","deleted_at":"0000-00-00 00:00:00"}]', '2017-01-24 12:14:56', '2017-01-24 12:14:56'),
(281, 'note', 'deleted', 0, '{"id":"11","user_id":"95","client_notes":"Cjcjcjccjcjcjjccjcjjccjcjcj cjvkcjjcjccjc vvkckkcfjgk fikvck Cjcjcjccjcjcjjccjcjjccjcjcj cjvkcjjcjccjc vvkckkcfjgk filbert","title":"Tstin","created_at":"2017-01-24 12:14:33","updated_at":"2017-01-24 12:14:56","deleted_at":"0000-00-00 00:00:00"}', '2017-01-24 12:15:25', '2017-01-24 12:15:25'),
(282, 'task', 'completed', 0, '[{"id":"133","task_name":"Cleaning","client_id":"89","note_detail":"Some notes","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-24","start_datetime":"2017-01-24 15:15:00","end_datetime":"2017-01-24 16:15:00","task_completed_date":"2017-01-24 13:20:55","rating":"5","comments":"","property_id":"10","attribute_id":"38","status":"4","created_at":"2017-01-24 10:35:24","updated_at":"2017-01-24 13:20:55","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-24 13:20:55', '2017-01-24 13:20:55'),
(283, 'task', 'created', 0, '[{"id":"140","task_name":"Cleaning","client_id":"89","note_detail":"I am adding some notes here","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-03-20","start_datetime":"2017-03-20 00:15:00","end_datetime":"2017-03-20 01:15:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"20","attribute_id":"60","status":"1","created_at":"2017-01-25 05:47:36","updated_at":"2017-01-25 05:47:36","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-25 05:47:36', '2017-01-25 05:47:36'),
(284, 'task', 'created', 0, '[{"id":"141","task_name":"Washing","client_id":"89","note_detail":"Some tasks for theis","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-03-15","start_datetime":"2017-03-15 11:15:00","end_datetime":"2017-03-15 12:15:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"20","attribute_id":"60","status":"1","created_at":"2017-01-25 05:48:04","updated_at":"2017-01-25 05:48:04","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-25 05:48:04', '2017-01-25 05:48:04'),
(285, 'task', 'created', 0, '[{"id":"142","task_name":"Repairing","client_id":"89","note_detail":"Needs to repair some stuif","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-03-15","start_datetime":"2017-03-15 10:15:00","end_datetime":"2017-03-15 11:15:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"20","attribute_id":"60","status":"1","created_at":"2017-01-25 05:48:43","updated_at":"2017-01-25 05:48:43","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-25 05:48:43', '2017-01-25 05:48:43'),
(286, 'task', 'deleted', 0, '{"id":"141","task_name":"Washing","client_id":"89","note_detail":"Some tasks for theis","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-03-16","start_datetime":"2017-03-16 00:15:00","end_datetime":"2017-03-16 01:15:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"20","attribute_id":"60","status":"1","created_at":"2017-01-25 05:48:04","updated_at":"2017-01-25 05:54:58","deleted_at":"0000-00-00 00:00:00"}', '2017-01-25 06:18:55', '2017-01-25 06:18:55'),
(287, 'task', 'created', 0, '[{"id":"143","task_name":"Clearing the floor","client_id":"89","note_detail":"It will be coducted tommorrow.\\nSkdljflsdfk\\nKsdjflksjf\\nLsdfklskflkdslfkdslfkdslfklsdfklsdfkldskflsdkflsdklfdsklfk\\nSdlfksldfklsdkldksfldksflkdsflkdslfdslfklsdkfldsfklsdkflsd\\nSdlfkdslfkldsfkldskfldkflsdkfldskflkdslfkdsflkdslfkdslfkdslfkldfklsdkfdkslf\\nDsfldsl","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-28","start_datetime":"2017-01-28 11:15:00","end_datetime":"2017-01-28 12:15:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"20","attribute_id":"60","status":"1","created_at":"2017-01-25 06:57:37","updated_at":"2017-01-25 06:57:37","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-25 06:57:37', '2017-01-25 06:57:37'),
(288, 'task', 'rescheduled', 0, '[{"id":"143","task_name":"Clearing the floor","client_id":"89","note_detail":"It will be coducted tommorrow.\\nSkdljflsdfk\\nKsdjflksjf\\nLsdfklskflkdslfkdslfkdslfklsdfklsdfkldskflsdkflsdklfdsklfk\\nSdlfksldfklsdkldksfldksflkdsflkdslfdslfklsdkfldsfklsdkflsd\\nSdlfkdslfkldsfkldskfldkflsdkfldskflkdslfkdsflkdslfkdslfkdslfkldfklsdkfdkslf\\nDsfldsl","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-29","start_datetime":"2017-01-29 00:15:00","end_datetime":"2017-01-29 01:15:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"20","attribute_id":"60","status":"1","created_at":"2017-01-25 06:57:37","updated_at":"2017-01-25 06:58:20","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-25 06:58:21', '2017-01-25 06:58:21'),
(289, 'task', 'created', 0, '[{"id":"144","task_name":"Empty task","client_id":"89","note_detail":"","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"0000-00-00","start_datetime":"0000-00-00 00:00:00","end_datetime":"0000-00-00 00:00:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"20","attribute_id":"60","status":"1","created_at":"2017-01-25 06:59:05","updated_at":"2017-01-25 06:59:05","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-25 06:59:05', '2017-01-25 06:59:05'),
(290, 'task', 'rescheduled', 0, '[{"id":"144","task_name":"Empty task","client_id":"89","note_detail":"","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-22","start_datetime":"2017-01-22 00:15:00","end_datetime":"2017-01-22 01:15:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"20","attribute_id":"60","status":"1","created_at":"2017-01-25 06:59:05","updated_at":"2017-01-25 06:59:16","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-25 06:59:16', '2017-01-25 06:59:16'),
(291, 'task', 'deleted', 0, '{"id":"144","task_name":"Empty task","client_id":"89","note_detail":"","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-22","start_datetime":"2017-01-22 00:15:00","end_datetime":"2017-01-22 01:15:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"20","attribute_id":"60","status":"1","created_at":"2017-01-25 06:59:05","updated_at":"2017-01-25 06:59:16","deleted_at":"0000-00-00 00:00:00"}', '2017-01-25 06:59:22', '2017-01-25 06:59:22'),
(292, 'task', 'rescheduled', 0, '[{"id":"143","task_name":"Clearing the floor","client_id":"89","note_detail":"It will be coducted tommorrow.\\nSkdljflsdfk\\nKsdjflksjf\\nLsdfklskflkdslfkdslfkdslfklsdfklsdfkldskflsdkflsdklfdsklfk\\nSdlfksldfklsdkldksfldksflkdsflkdslfdslfklsdkfldsfklsdkflsd\\nSdlfkdslfkldsfkldskfldkflsdkfldskflkdslfkdsflkdslfkdslfkdslfkldfklsdkfdkslf\\nDsfldsl","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-02-02","start_datetime":"2017-02-02 11:15:00","end_datetime":"2017-02-02 12:15:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"20","attribute_id":"60","status":"1","created_at":"2017-01-25 06:57:37","updated_at":"2017-01-25 07:12:51","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-25 07:12:51', '2017-01-25 07:12:51'),
(293, 'task', 'deleted', 0, '{"id":"143","task_name":"Clearing the floor","client_id":"89","note_detail":"It will be coducted tommorrow.\\nSkdljflsdfk\\nKsdjflksjf\\nLsdfklskflkdslfkdslfkdslfklsdfklsdfkldskflsdkflsdklfdsklfk\\nSdlfksldfklsdkldksfldksflkdsflkdslfdslfklsdkfldsfklsdkflsd\\nSdlfkdslfkldsfkldskfldkflsdkfldskflkdslfkdsflkdslfkdslfkdslfkldfklsdkfdkslf\\nDsfldsl","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-02-02","start_datetime":"2017-02-02 11:15:00","end_datetime":"2017-02-02 12:15:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"20","attribute_id":"60","status":"3","created_at":"2017-01-25 06:57:37","updated_at":"2017-01-25 07:14:22","deleted_at":"0000-00-00 00:00:00"}', '2017-01-25 07:14:35', '2017-01-25 07:14:35'),
(294, 'note', 'updated', 0, '[{"id":"9","user_id":"89","client_notes":"Need to clean the floor.kafhjksafjkasjfkfjkmnc kasjksajfk asf asdfkjkdskfdjf iyeuiueiwruiewr. Eiwuiewuriewru ieruiewruiewruieuriewurfdskfjdsfkjdkfjdskfjdksfjkfsjksdfjkdsfjkdsfjkdsfjkdsfjksdjfkdsfjkdsfjdsfkjsdfknkmsdfkjsdfkjdsfkjdsfkjdskfjsdkfsdkfjkend","title":"Need to urgent worker","created_at":"2017-01-17 06:31:20","updated_at":"2017-01-17 06:54:26","deleted_at":"0000-00-00 00:00:00"}]', '2017-01-25 07:19:16', '2017-01-25 07:19:16'),
(295, 'task', 'created', 0, '[{"id":"145","task_name":"Kitchen repare","client_id":"100","note_detail":"","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"0000-00-00","start_datetime":"0000-00-00 00:00:00","end_datetime":"0000-00-00 00:00:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"21","attribute_id":"61","status":"1","created_at":"2017-01-27 04:47:26","updated_at":"2017-01-27 04:47:26","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-27 04:47:26', '2017-01-27 04:47:26'),
(296, 'task', 'deleted', 0, '{"id":"145","task_name":"Kitchen repare","client_id":"100","note_detail":"","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"0000-00-00","start_datetime":"0000-00-00 00:00:00","end_datetime":"0000-00-00 00:00:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"21","attribute_id":"61","status":"3","created_at":"2017-01-27 04:47:26","updated_at":"2017-01-27 04:56:50","deleted_at":"0000-00-00 00:00:00"}', '2017-01-27 04:57:13', '2017-01-27 04:57:13'),
(297, 'task', 'created', 0, '[{"id":"146","task_name":"Kitchen repare","client_id":"100","note_detail":"Thx please repare","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-27","start_datetime":"2017-01-27 00:15:00","end_datetime":"2017-01-27 01:15:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"21","attribute_id":"61","status":"1","created_at":"2017-01-27 05:02:01","updated_at":"2017-01-27 05:02:01","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-27 05:02:01', '2017-01-27 05:02:01'),
(298, 'task', 'created', 0, '[{"id":"147","task_name":"Repare","client_id":"100","note_detail":"","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"0000-00-00","start_datetime":"0000-00-00 00:00:00","end_datetime":"0000-00-00 00:00:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"21","attribute_id":"61","status":"1","created_at":"2017-01-27 05:04:01","updated_at":"2017-01-27 05:04:01","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-27 05:04:01', '2017-01-27 05:04:01'),
(299, 'note', 'created', 0, '[{"id":"12","user_id":"100","client_notes":"Ffgh","title":"Frff","created_at":"2017-01-27 05:19:08","updated_at":"2017-01-27 05:19:08","deleted_at":"0000-00-00 00:00:00"}]', '2017-01-27 05:19:08', '2017-01-27 05:19:08'),
(300, 'task', 'completed', 0, '[{"id":"147","task_name":"Repare","client_id":"100","note_detail":"hello, this is for testing","priority":"3","document_id":"0","technician_id":"88","assigned_date":"2017-01-27","scheduled_date":"1900-12-27","start_datetime":"1900-12-27 13:30:00","end_datetime":"1900-12-27 05:25:00","task_completed_date":"2017-01-27 05:21:04","rating":"5","comments":"Fgthd gfoutfj uyf jh","property_id":"21","attribute_id":"61","status":"4","created_at":"2017-01-27 05:04:01","updated_at":"2017-01-27 05:21:04","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-27 05:21:04', '2017-01-27 05:21:04'),
(301, 'task', 'created', 0, '[{"id":"148","task_name":"Wires","client_id":"100","note_detail":"Wires crash","priority":"1","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-27","start_datetime":"2017-01-27 10:15:00","end_datetime":"2017-01-27 11:15:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"21","attribute_id":"61","status":"1","created_at":"2017-01-27 05:26:02","updated_at":"2017-01-27 05:26:02","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-27 05:26:02', '2017-01-27 05:26:02'),
(302, 'note', 'updated', 0, '[{"id":"12","user_id":"100","client_notes":"Czechs","title":"Frffzdgg","created_at":"2017-01-27 05:19:08","updated_at":"2017-01-27 05:30:59","deleted_at":"0000-00-00 00:00:00"}]', '2017-01-27 05:30:59', '2017-01-27 05:30:59'),
(303, 'task', 'completed', 0, '[{"id":"148","task_name":"Wires","client_id":"100","note_detail":"Wires crash","priority":"1","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-27","start_datetime":"2017-01-27 10:15:00","end_datetime":"2017-01-27 11:15:00","task_completed_date":"2017-01-27 05:41:55","rating":"3","comments":"Bbvj","property_id":"21","attribute_id":"61","status":"4","created_at":"2017-01-27 05:26:02","updated_at":"2017-01-27 05:41:55","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-27 05:41:55', '2017-01-27 05:41:55'),
(304, 'task', 'created', 0, '[{"id":"149","task_name":"Bathroom","client_id":"101","note_detail":"","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"0000-00-00","start_datetime":"0000-00-00 00:00:00","end_datetime":"0000-00-00 00:00:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"23","attribute_id":"69","status":"1","created_at":"2017-01-27 05:54:54","updated_at":"2017-01-27 05:54:54","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-27 05:54:54', '2017-01-27 05:54:54'),
(305, 'task', 'created', 0, '[{"id":"150","task_name":"Kitchen","client_id":"101","note_detail":"Kitchen","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-28","start_datetime":"2017-01-28 15:15:00","end_datetime":"2017-01-28 16:15:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"23","attribute_id":"70","status":"1","created_at":"2017-01-27 05:55:59","updated_at":"2017-01-27 05:55:59","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-27 05:55:59', '2017-01-27 05:55:59'),
(306, 'task', 'created', 0, '[{"id":"151","task_name":"Kitchen 1","client_id":"101","note_detail":"1","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-29","start_datetime":"2017-01-29 11:15:00","end_datetime":"2017-01-29 12:15:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"22","attribute_id":"65","status":"1","created_at":"2017-01-27 05:56:25","updated_at":"2017-01-27 05:56:25","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-27 05:56:25', '2017-01-27 05:56:25'),
(307, 'task', 'created', 0, '[{"id":"152","task_name":"Wed","client_id":"101","note_detail":"","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"0000-00-00","start_datetime":"0000-00-00 00:00:00","end_datetime":"0000-00-00 00:00:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"22","attribute_id":"66","status":"1","created_at":"2017-01-27 05:57:29","updated_at":"2017-01-27 05:57:29","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-27 05:57:29', '2017-01-27 05:57:29'),
(308, 'note', 'created', 0, '[{"id":"13","user_id":"101","client_notes":"Cvg","title":"Vfsvy","created_at":"2017-01-27 05:58:46","updated_at":"2017-01-27 05:58:46","deleted_at":"0000-00-00 00:00:00"}]', '2017-01-27 05:58:46', '2017-01-27 05:58:46'),
(309, 'task', 'created', 0, '[{"id":"153","task_name":"New property","client_id":"99","note_detail":"Some notes","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-18","start_datetime":"2017-01-18 10:15:00","end_datetime":"2017-01-18 11:15:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"19","attribute_id":"57","status":"1","created_at":"2017-01-27 06:18:23","updated_at":"2017-01-27 06:18:23","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-27 06:18:23', '2017-01-27 06:18:23'),
(310, 'task', 'created', 0, '[{"id":"154","task_name":"Task Prop","client_id":"99","note_detail":"","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"0000-00-00","start_datetime":"0000-00-00 00:00:00","end_datetime":"0000-00-00 00:00:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"19","attribute_id":"58","status":"1","created_at":"2017-01-27 06:18:43","updated_at":"2017-01-27 06:18:43","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-27 06:18:43', '2017-01-27 06:18:43'),
(311, 'task', 'created', 0, '[{"id":"155","task_name":"Task Store","client_id":"99","note_detail":"","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"0000-00-00","start_datetime":"0000-00-00 00:00:00","end_datetime":"0000-00-00 00:00:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"19","attribute_id":"59","status":"1","created_at":"2017-01-27 06:18:58","updated_at":"2017-01-27 06:18:58","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-27 06:18:58', '2017-01-27 06:18:58'),
(312, 'task', 'deleted', 0, '{"id":"142","task_name":"Repairing","client_id":"89","note_detail":"Needs to repair some stuif","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-25","start_datetime":"2017-01-25 00:15:00","end_datetime":"2017-01-25 01:15:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"20","attribute_id":"60","status":"1","created_at":"2017-01-25 05:48:43","updated_at":"2017-01-25 06:03:21","deleted_at":"0000-00-00 00:00:00"}', '2017-01-27 07:13:42', '2017-01-27 07:13:42'),
(313, 'task', 'created', 0, '[{"id":"156","task_name":"Jvjv","client_id":"102","note_detail":"","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"0000-00-00","start_datetime":"0000-00-00 00:00:00","end_datetime":"0000-00-00 00:00:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"24","attribute_id":"74","status":"1","created_at":"2017-01-27 09:32:18","updated_at":"2017-01-27 09:32:18","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-27 09:32:18', '2017-01-27 09:32:18'),
(314, 'task', 'created', 0, '[{"id":"157","task_name":"Chchc","client_id":"102","note_detail":"","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"0000-00-00","start_datetime":"0000-00-00 00:00:00","end_datetime":"0000-00-00 00:00:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"24","attribute_id":"71","status":"1","created_at":"2017-01-27 09:33:45","updated_at":"2017-01-27 09:33:45","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-27 09:33:45', '2017-01-27 09:33:45'),
(315, 'task', 'created', 0, '[{"id":"158","task_name":"Chchc","client_id":"102","note_detail":"","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"0000-00-00","start_datetime":"0000-00-00 00:00:00","end_datetime":"0000-00-00 00:00:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"24","attribute_id":"71","status":"1","created_at":"2017-01-27 09:33:51","updated_at":"2017-01-27 09:33:51","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-27 09:33:51', '2017-01-27 09:33:51'),
(316, 'task', 'completed', 0, '[{"id":"158","task_name":"Chchc","client_id":"102","note_detail":"","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"0000-00-00","start_datetime":"0000-00-00 00:00:00","end_datetime":"0000-00-00 00:00:00","task_completed_date":"2017-01-27 09:34:04","rating":"3","comments":"Ch c","property_id":"24","attribute_id":"71","status":"4","created_at":"2017-01-27 09:33:51","updated_at":"2017-01-27 09:34:04","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-27 09:34:04', '2017-01-27 09:34:04'),
(317, 'task', 'created', 0, '[{"id":"159","task_name":"Hchcc","client_id":"102","note_detail":"Hcch","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-01-27","start_datetime":"2017-01-27 00:15:00","end_datetime":"2017-01-27 01:15:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"24","attribute_id":"73","status":"1","created_at":"2017-01-27 09:35:31","updated_at":"2017-01-27 09:35:31","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-27 09:35:31', '2017-01-27 09:35:31'),
(318, 'note', 'created', 0, '[{"id":"14","user_id":"102","client_notes":"Jhch","title":"Chf","created_at":"2017-01-27 09:36:50","updated_at":"2017-01-27 09:36:50","deleted_at":"0000-00-00 00:00:00"}]', '2017-01-27 09:36:50', '2017-01-27 09:36:50'),
(319, 'task', 'created', 0, '[{"id":"160","task_name":"Empty Task","client_id":"89","note_detail":"","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"0000-00-00","start_datetime":"0000-00-00 00:00:00","end_datetime":"0000-00-00 00:00:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"20","attribute_id":"60","status":"1","created_at":"2017-01-27 11:44:34","updated_at":"2017-01-27 11:44:34","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-27 11:44:34', '2017-01-27 11:44:34');
INSERT INTO `crone_jobs` (`id`, `type`, `status`, `action_status`, `description`, `created_at`, `updated_at`) VALUES
(320, 'task', 'created', 0, '[{"id":"161","task_name":"Empty Task One","client_id":"89","note_detail":"","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"0000-00-00","start_datetime":"0000-00-00 00:00:00","end_datetime":"0000-00-00 00:00:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"20","attribute_id":"60","status":"1","created_at":"2017-01-27 11:44:47","updated_at":"2017-01-27 11:44:47","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-27 11:44:47', '2017-01-27 11:44:47'),
(321, 'task', 'created', 0, '[{"id":"162","task_name":"Faucet leaking","client_id":"97","note_detail":"","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"0000-00-00","start_datetime":"0000-00-00 00:00:00","end_datetime":"0000-00-00 00:00:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"16","attribute_id":"52","status":"1","created_at":"2017-01-30 11:28:45","updated_at":"2017-01-30 11:28:45","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-30 11:28:46', '2017-01-30 11:28:46'),
(322, 'task', 'created', 0, '[{"id":"163","task_name":"New sink","client_id":"95","note_detail":"","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"0000-00-00","start_datetime":"0000-00-00 00:00:00","end_datetime":"0000-00-00 00:00:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"15","attribute_id":"51","status":"1","created_at":"2017-01-30 16:19:11","updated_at":"2017-01-30 16:19:11","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-30 16:19:11', '2017-01-30 16:19:11'),
(323, 'task', 'created', 0, '[{"id":"164","task_name":"Misc task","client_id":"95","note_detail":"","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"0000-00-00","start_datetime":"0000-00-00 00:00:00","end_datetime":"0000-00-00 00:00:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"15","attribute_id":"51","status":"1","created_at":"2017-01-30 19:08:21","updated_at":"2017-01-30 19:08:21","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-01-30 19:08:21', '2017-01-30 19:08:21'),
(324, 'note', 'created', 0, '[{"id":"15","user_id":"95","client_notes":"Note details - jg","title":"New note","created_at":"2017-01-30 19:26:30","updated_at":"2017-01-30 19:26:30","deleted_at":"0000-00-00 00:00:00"}]', '2017-01-30 19:26:30', '2017-01-30 19:26:30'),
(325, 'note', 'created', 0, '[{"id":"16","user_id":"97","client_notes":"Jon","title":"Bath","created_at":"2017-01-30 19:26:48","updated_at":"2017-01-30 19:26:48","deleted_at":"0000-00-00 00:00:00"}]', '2017-01-30 19:26:48', '2017-01-30 19:26:48'),
(326, 'task', 'created', 0, '[{"id":"165","task_name":"Paint crown","client_id":"97","note_detail":"","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"0000-00-00","start_datetime":"0000-00-00 00:00:00","end_datetime":"0000-00-00 00:00:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"16","attribute_id":"75","status":"1","created_at":"2017-02-08 00:12:03","updated_at":"2017-02-08 00:12:03","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-02-08 00:12:04', '2017-02-08 00:12:04'),
(327, 'task', 'created', 0, '[{"id":"166","task_name":"Repair door latch","client_id":"97","note_detail":"","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-02-09","start_datetime":"2017-02-09 21:45:00","end_datetime":"2017-02-09 22:45:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"16","attribute_id":"76","status":"1","created_at":"2017-02-08 00:14:49","updated_at":"2017-02-08 00:14:49","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-02-08 00:14:49', '2017-02-08 00:14:49'),
(328, 'task', 'created', 0, '[{"id":"167","task_name":"Replace bulbs","client_id":"97","note_detail":"40w candles","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"0000-00-00","start_datetime":"0000-00-00 00:00:00","end_datetime":"0000-00-00 00:00:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"16","attribute_id":"77","status":"1","created_at":"2017-02-08 00:18:14","updated_at":"2017-02-08 00:18:14","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-02-08 00:18:14', '2017-02-08 00:18:14'),
(329, 'task', 'created', 0, '[{"id":"168","task_name":"Need trim over window","client_id":"97","note_detail":"","priority":"1","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"0000-00-00","start_datetime":"0000-00-00 00:00:00","end_datetime":"0000-00-00 00:00:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"16","attribute_id":"80","status":"1","created_at":"2017-02-08 00:19:19","updated_at":"2017-02-08 00:19:19","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-02-08 00:19:19', '2017-02-08 00:19:19'),
(330, 'task', 'created', 0, '[{"id":"169","task_name":"Repair grout","client_id":"97","note_detail":"","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"0000-00-00","start_datetime":"0000-00-00 00:00:00","end_datetime":"0000-00-00 00:00:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"16","attribute_id":"83","status":"1","created_at":"2017-02-08 00:21:38","updated_at":"2017-02-08 00:21:38","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-02-08 00:21:38', '2017-02-08 00:21:38'),
(331, 'task', 'created', 0, '[{"id":"170","task_name":"Touch up walls","client_id":"97","note_detail":"","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"0000-00-00","start_datetime":"0000-00-00 00:00:00","end_datetime":"0000-00-00 00:00:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"16","attribute_id":"82","status":"1","created_at":"2017-02-08 00:21:57","updated_at":"2017-02-08 00:21:57","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-02-08 00:21:57', '2017-02-08 00:21:57'),
(332, 'task', 'created', 0, '[{"id":"171","task_name":"Repair soffit ceiling","client_id":"97","note_detail":"Cracked & peeling paint","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"0000-00-00","start_datetime":"0000-00-00 00:00:00","end_datetime":"0000-00-00 00:00:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"16","attribute_id":"79","status":"1","created_at":"2017-02-08 00:28:22","updated_at":"2017-02-08 00:28:22","deleted_at":"0000-00-00 00:00:00","task_documents":[{"id":"57","type":"2","type_id":"171","filename":"http:\\/\\/frontline.debutinfotech.com\\/uploads\\/userfiles\\/thumb_1486513701.jpeg","created_at":"2017-02-08 00:28:22","updated_at":"2017-02-08 00:28:22","deleted_at":null}]}]', '2017-02-08 00:28:22', '2017-02-08 00:28:22'),
(333, 'task', 'created', 0, '[{"id":"172","task_name":"Paint window sill","client_id":"97","note_detail":"","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"0000-00-00","start_datetime":"0000-00-00 00:00:00","end_datetime":"0000-00-00 00:00:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"16","attribute_id":"76","status":"1","created_at":"2017-02-08 12:37:32","updated_at":"2017-02-08 12:37:32","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-02-08 12:37:32', '2017-02-08 12:37:32'),
(334, 'task', 'rescheduled', 0, '[{"id":"162","task_name":"Faucet leaking","client_id":"97","note_detail":"","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-02-15","start_datetime":"2017-02-15 21:45:00","end_datetime":"2017-02-15 22:45:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"16","attribute_id":"52","status":"1","created_at":"2017-01-30 11:28:45","updated_at":"2017-02-11 19:46:28","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-02-11 19:46:29', '2017-02-11 19:46:29'),
(335, 'task', 'rescheduled', 0, '[{"id":"165","task_name":"Paint crown","client_id":"97","note_detail":"","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-03-02","start_datetime":"2017-03-02 02:45:00","end_datetime":"2017-03-02 03:45:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"16","attribute_id":"75","status":"1","created_at":"2017-02-08 00:12:03","updated_at":"2017-02-12 17:56:12","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-02-12 17:56:12', '2017-02-12 17:56:12'),
(336, 'task', 'created', 0, '[{"id":"173","task_name":"Paint siding","client_id":"103","note_detail":"","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"0000-00-00","start_datetime":"0000-00-00 00:00:00","end_datetime":"0000-00-00 00:00:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"26","attribute_id":"90","status":"1","created_at":"2017-02-16 22:54:12","updated_at":"2017-02-16 22:54:12","deleted_at":"0000-00-00 00:00:00","task_documents":[{"id":"58","type":"2","type_id":"173","filename":"http:\\/\\/frontline.debutinfotech.com\\/uploads\\/userfiles\\/thumb_1487285651.jpeg","created_at":"2017-02-16 22:54:12","updated_at":"2017-02-16 22:54:12","deleted_at":null}]}]', '2017-02-16 22:54:13', '2017-02-16 22:54:13'),
(337, 'task', 'created', 0, '[{"id":"174","task_name":"Back door latch","client_id":"103","note_detail":"","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"0000-00-00","start_datetime":"0000-00-00 00:00:00","end_datetime":"0000-00-00 00:00:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"26","attribute_id":"90","status":"1","created_at":"2017-02-16 23:17:10","updated_at":"2017-02-16 23:17:10","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-02-16 23:17:10', '2017-02-16 23:17:10'),
(338, 'task', 'rescheduled', 0, '[{"id":"174","task_name":"Back door latch","client_id":"103","note_detail":"","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-02-23","start_datetime":"2017-02-23 23:00:00","end_datetime":"2017-02-24 01:00:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"26","attribute_id":"90","status":"1","created_at":"2017-02-16 23:17:10","updated_at":"2017-02-16 23:17:42","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-02-16 23:17:43', '2017-02-16 23:17:43'),
(339, 'task', 'created', 0, '[{"id":"175","task_name":"Shower faucet","client_id":"103","note_detail":"","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"0000-00-00","start_datetime":"0000-00-00 00:00:00","end_datetime":"0000-00-00 00:00:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"26","attribute_id":"90","status":"1","created_at":"2017-02-16 23:19:15","updated_at":"2017-02-16 23:19:15","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-02-16 23:19:15', '2017-02-16 23:19:15'),
(340, 'task', 'created', 0, '[{"id":"176","task_name":"Kitchen sink","client_id":"103","note_detail":"","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"0000-00-00","start_datetime":"0000-00-00 00:00:00","end_datetime":"0000-00-00 00:00:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"26","attribute_id":"90","status":"1","created_at":"2017-02-16 23:20:34","updated_at":"2017-02-16 23:20:34","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-02-16 23:20:34', '2017-02-16 23:20:34'),
(341, 'task', 'created', 0, '[{"id":"177","task_name":"Broken window","client_id":"97","note_detail":"","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-02-28","start_datetime":"2017-02-28 21:45:00","end_datetime":"2017-02-28 22:45:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"16","attribute_id":"75","status":"1","created_at":"2017-02-21 00:09:29","updated_at":"2017-02-21 00:09:29","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-02-21 00:09:29', '2017-02-21 00:09:29'),
(342, 'task', 'created', 0, '[{"id":"178","task_name":"Clean floor","client_id":"104","note_detail":"Its dirty","priority":"2","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-02-16","start_datetime":"2017-02-16 21:45:00","end_datetime":"2017-02-16 22:45:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"27","attribute_id":"91","status":"1","created_at":"2017-02-21 06:57:41","updated_at":"2017-02-21 06:57:41","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-02-21 06:57:42', '2017-02-21 06:57:42'),
(343, 'task', 'created', 0, '[{"id":"179","task_name":"Fix kitchen sink","client_id":"104","note_detail":"Not draining","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-03-11","start_datetime":"2017-03-11 22:45:00","end_datetime":"2017-03-11 23:45:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"27","attribute_id":"92","status":"1","created_at":"2017-02-21 07:04:09","updated_at":"2017-02-21 07:04:09","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-02-21 07:04:09', '2017-02-21 07:04:09'),
(344, 'note', 'created', 0, '[{"id":"17","user_id":"105","client_notes":"Be careful of shadow - trained to bite.","title":"Dog in yard","created_at":"2017-02-21 07:33:55","updated_at":"2017-02-21 07:33:55","deleted_at":"0000-00-00 00:00:00"}]', '2017-02-21 07:33:55', '2017-02-21 07:33:55'),
(345, 'task', 'created', 0, '[{"id":"180","task_name":"Fix window","client_id":"105","note_detail":"Broken pane","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-03-11","start_datetime":"2017-03-11 11:45:00","end_datetime":"2017-03-11 12:45:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"28","attribute_id":"99","status":"1","created_at":"2017-02-21 07:36:45","updated_at":"2017-02-21 07:36:45","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-02-21 07:36:45', '2017-02-21 07:36:45'),
(346, 'task', 'created', 0, '[{"id":"181","task_name":"Clean carpet","client_id":"105","note_detail":"Stains in the middle","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-03-09","start_datetime":"2017-03-09 22:45:00","end_datetime":"2017-03-09 23:45:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"28","attribute_id":"99","status":"1","created_at":"2017-02-21 07:41:14","updated_at":"2017-02-21 07:41:14","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-02-21 07:41:14', '2017-02-21 07:41:14'),
(347, 'task', 'created', 0, '[{"id":"182","task_name":"Replace doorknobs","client_id":"105","note_detail":"Make sure they match in style","priority":"2","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-03-01","start_datetime":"2017-03-01 21:45:00","end_datetime":"2017-03-01 22:45:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"28","attribute_id":"99","status":"1","created_at":"2017-02-21 08:15:00","updated_at":"2017-02-21 08:15:00","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-02-21 08:15:00', '2017-02-21 08:15:00'),
(348, 'task', 'rescheduled', 0, '[{"id":"182","task_name":"Replace doorknobs","client_id":"105","note_detail":"Make sure they match in style","priority":"2","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-03-09","start_datetime":"2017-03-09 21:45:00","end_datetime":"2017-03-09 22:45:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"28","attribute_id":"99","status":"1","created_at":"2017-02-21 08:15:00","updated_at":"2017-02-21 08:17:20","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-02-21 08:17:20', '2017-02-21 08:17:20'),
(349, 'task', 'rescheduled', 0, '[{"id":"180","task_name":"Fix window","client_id":"105","note_detail":"Broken pane","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-03-09","start_datetime":"2017-03-09 22:45:00","end_datetime":"2017-03-09 23:45:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"28","attribute_id":"99","status":"1","created_at":"2017-02-21 07:36:45","updated_at":"2017-02-21 08:18:25","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-02-21 08:18:25', '2017-02-21 08:18:25'),
(350, 'task', 'created', 0, '[{"id":"183","task_name":"Fix stairway","client_id":"105","note_detail":"3rd step","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-04-08","start_datetime":"2017-04-08 01:45:00","end_datetime":"2017-04-08 02:45:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"28","attribute_id":"97","status":"1","created_at":"2017-02-21 08:21:41","updated_at":"2017-02-21 08:21:41","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-02-21 08:21:41', '2017-02-21 08:21:41'),
(351, 'task', 'created', 0, '[{"id":"184","task_name":"Abcd","client_id":"106","note_detail":"Hshshjs","priority":"2","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-03-06","start_datetime":"2017-03-06 10:27:00","end_datetime":"2017-03-06 11:28:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"29","attribute_id":"100","status":"1","created_at":"2017-02-22 09:19:18","updated_at":"2017-02-22 09:19:18","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-02-22 09:19:19', '2017-02-22 09:19:19'),
(352, 'note', 'created', 0, '[{"id":"18","user_id":"106","client_notes":"Cuduxucu","title":"Jxjduxu","created_at":"2017-02-22 09:24:14","updated_at":"2017-02-22 09:24:14","deleted_at":"0000-00-00 00:00:00"}]', '2017-02-22 09:24:14', '2017-02-22 09:24:14'),
(353, 'note', 'updated', 0, '[{"id":"18","user_id":"106","client_notes":"Cuduxucu","title":"FifficfuJxjduxu","created_at":"2017-02-22 09:24:14","updated_at":"2017-02-22 09:24:27","deleted_at":"0000-00-00 00:00:00"}]', '2017-02-22 09:24:27', '2017-02-22 09:24:27'),
(354, 'task', 'created', 0, '[{"id":"185","task_name":"Porch rail fix","client_id":"105","note_detail":"Notes notes","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-03-12","start_datetime":"2017-03-12 02:45:00","end_datetime":"2017-03-12 03:45:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"28","attribute_id":"96","status":"1","created_at":"2017-02-23 13:08:22","updated_at":"2017-02-23 13:08:22","deleted_at":"0000-00-00 00:00:00","task_documents":[{"id":"59","type":"2","type_id":"185","filename":"http:\\/\\/frontline.debutinfotech.com\\/uploads\\/userfiles\\/thumb_1487855301.jpeg","created_at":"2017-02-23 13:08:22","updated_at":"2017-02-23 13:08:22","deleted_at":null}]}]', '2017-02-23 13:08:23', '2017-02-23 13:08:23'),
(355, 'task', 'created', 0, '[{"id":"186","task_name":"Broken door","client_id":"97","note_detail":"","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-02-28","start_datetime":"2017-02-28 23:00:00","end_datetime":"2017-03-01 01:00:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"16","attribute_id":"75","status":"1","created_at":"2017-02-25 00:14:07","updated_at":"2017-02-25 00:14:07","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-02-25 00:14:07', '2017-02-25 00:14:07'),
(356, 'note', 'created', 0, '[{"id":"19","user_id":"96","client_notes":"Dhu","title":"Dyg","created_at":"2017-03-01 04:38:46","updated_at":"2017-03-01 04:38:46","deleted_at":"0000-00-00 00:00:00"}]', '2017-03-01 04:38:46', '2017-03-01 04:38:46'),
(357, 'note', 'updated', 0, '[{"id":"19","user_id":"96","client_notes":"Dhu","title":"Dygfggh","created_at":"2017-03-01 04:38:46","updated_at":"2017-03-01 04:39:00","deleted_at":"0000-00-00 00:00:00"}]', '2017-03-01 04:39:00', '2017-03-01 04:39:00'),
(358, 'task', 'created', 0, '[{"id":"187","task_name":"Abcd","client_id":"96","note_detail":"Dsfgfdgdf","priority":"2","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-03-14","start_datetime":"2017-03-14 11:30:00","end_datetime":"2017-03-14 13:30:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"14","attribute_id":"50","status":"1","created_at":"2017-03-01 07:13:54","updated_at":"2017-03-01 07:13:54","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-03-01 07:13:54', '2017-03-01 07:13:54'),
(359, 'task', 'deleted', 0, '{"id":"187","task_name":"Abcd","client_id":"96","note_detail":"Dsfgfdgdf","priority":"2","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-03-14","start_datetime":"2017-03-14 11:30:00","end_datetime":"2017-03-14 13:30:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"14","attribute_id":"50","status":"1","created_at":"2017-03-01 07:13:54","updated_at":"2017-03-01 07:13:54","deleted_at":"0000-00-00 00:00:00"}', '2017-03-01 07:14:20', '2017-03-01 07:14:20'),
(360, 'task', 'created', 0, '[{"id":"188","task_name":",mf","client_id":"96","note_detail":"Dfdfg","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-03-01","start_datetime":"2017-03-01 11:30:00","end_datetime":"2017-03-01 13:30:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"40","attribute_id":"134","status":"1","created_at":"2017-03-01 13:26:52","updated_at":"2017-03-01 13:26:52","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-03-01 13:26:52', '2017-03-01 13:26:52'),
(361, 'note', 'updated', 0, '[{"id":"19","user_id":"96","client_notes":"Chu","title":"Dygfggh","created_at":"2017-03-01 04:38:46","updated_at":"2017-03-01 13:39:34","deleted_at":"0000-00-00 00:00:00"}]', '2017-03-01 13:39:34', '2017-03-01 13:39:34'),
(362, 'task', 'created', 0, '[{"id":"189","task_name":"Kjgkjhjk","client_id":"96","note_detail":"Kjhjkhjh","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-03-15","start_datetime":"2017-03-15 10:15:00","end_datetime":"2017-03-15 11:15:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"30","attribute_id":"140","status":"1","created_at":"2017-03-01 13:49:35","updated_at":"2017-03-01 13:49:35","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-03-01 13:49:35', '2017-03-01 13:49:35'),
(363, 'task', 'created', 0, '[{"id":"190","task_name":"Jkhjkhjkh","client_id":"96","note_detail":"Kljkljklj","priority":"2","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-03-08","start_datetime":"2017-03-08 11:30:00","end_datetime":"2017-03-08 13:30:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"30","attribute_id":"140","status":"1","created_at":"2017-03-01 13:59:29","updated_at":"2017-03-01 13:59:29","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-03-01 13:59:29', '2017-03-01 13:59:29'),
(364, 'note', 'created', 0, '[{"id":"20","user_id":"96","client_notes":"Kjh","title":"Kjh","created_at":"2017-03-01 14:00:14","updated_at":"2017-03-01 14:00:14","deleted_at":"0000-00-00 00:00:00"}]', '2017-03-01 14:00:14', '2017-03-01 14:00:14'),
(365, 'task', 'rescheduled', 0, '[{"id":"189","task_name":"Kjgkjhjk","client_id":"96","note_detail":"Kjhjkhjh","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-03-15","start_datetime":"2017-03-15 11:30:00","end_datetime":"2017-03-15 13:30:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"30","attribute_id":"140","status":"1","created_at":"2017-03-01 13:49:35","updated_at":"2017-03-02 09:53:05","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-03-02 09:53:05', '2017-03-02 09:53:05'),
(366, 'task', 'rescheduled', 0, '[{"id":"189","task_name":"Kjgkjhjk","client_id":"96","note_detail":"Kjhjkhjh","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-03-16","start_datetime":"2017-03-16 11:30:00","end_datetime":"2017-03-16 13:30:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"30","attribute_id":"140","status":"1","created_at":"2017-03-01 13:49:35","updated_at":"2017-03-02 09:53:16","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-03-02 09:53:16', '2017-03-02 09:53:16'),
(367, 'task', 'created', 0, '[{"id":"191","task_name":"New task","client_id":"96","note_detail":"Asdasdasdsa","priority":"2","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-03-22","start_datetime":"2017-03-22 15:15:00","end_datetime":"2017-03-22 16:15:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"30","attribute_id":"142","status":"1","created_at":"2017-03-02 11:05:16","updated_at":"2017-03-02 11:05:16","deleted_at":"0000-00-00 00:00:00","task_documents":[{"id":"63","type":"2","type_id":"191","filename":"http:\\/\\/frontline.debutinfotech.com\\/uploads\\/userfiles\\/thumb_1488452705.jpeg","created_at":"2017-03-02 11:05:16","updated_at":"2017-03-02 11:05:16","deleted_at":null},{"id":"64","type":"2","type_id":"191","filename":"http:\\/\\/frontline.debutinfotech.com\\/uploads\\/userfiles\\/thumb_1488452707.jpeg","created_at":"2017-03-02 11:05:16","updated_at":"2017-03-02 11:05:16","deleted_at":null},{"id":"65","type":"2","type_id":"191","filename":"http:\\/\\/frontline.debutinfotech.com\\/uploads\\/userfiles\\/thumb_1488452709.jpeg","created_at":"2017-03-02 11:05:16","updated_at":"2017-03-02 11:05:16","deleted_at":null},{"id":"66","type":"2","type_id":"191","filename":"http:\\/\\/frontline.debutinfotech.com\\/uploads\\/userfiles\\/thumb_1488452709.jpeg","created_at":"2017-03-02 11:05:16","updated_at":"2017-03-02 11:05:16","deleted_at":null},{"id":"67","type":"2","type_id":"191","filename":"http:\\/\\/frontline.debutinfotech.com\\/uploads\\/userfiles\\/thumb_1488452710.jpeg","created_at":"2017-03-02 11:05:16","updated_at":"2017-03-02 11:05:16","deleted_at":null},{"id":"68","type":"2","type_id":"191","filename":"http:\\/\\/frontline.debutinfotech.com\\/uploads\\/userfiles\\/thumb_1488452712.jpeg","created_at":"2017-03-02 11:05:16","updated_at":"2017-03-02 11:05:16","deleted_at":null},{"id":"69","type":"2","type_id":"191","filename":"http:\\/\\/frontline.debutinfotech.com\\/uploads\\/userfiles\\/thumb_1488452714.jpeg","created_at":"2017-03-02 11:05:17","updated_at":"2017-03-02 11:05:17","deleted_at":null},{"id":"70","type":"2","type_id":"191","filename":"http:\\/\\/frontline.debutinfotech.com\\/uploads\\/userfiles\\/thumb_1488452716.jpeg","created_at":"2017-03-02 11:05:17","updated_at":"2017-03-02 11:05:17","deleted_at":null}]}]', '2017-03-02 11:05:17', '2017-03-02 11:05:17'),
(368, 'task', 'completed', 0, '[{"id":"80","task_name":"Fix shower","client_id":"95","note_detail":"Shower head is clogged","priority":"2","document_id":"0","technician_id":"88","assigned_date":"2017-01-11","scheduled_date":"2017-01-08","start_datetime":"2017-01-08 18:38:00","end_datetime":"2017-01-09 02:38:00","task_completed_date":"2017-03-05 18:58:24","rating":"5","comments":"Geydhehe","property_id":"15","attribute_id":"51","status":"4","created_at":"2017-01-06 18:23:02","updated_at":"2017-03-05 18:58:24","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-03-05 18:58:24', '2017-03-05 18:58:24'),
(369, 'task', 'created', 0, '[{"id":"192","task_name":"Hari","client_id":"95","note_detail":"Bshshsj","priority":"2","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-03-23","start_datetime":"2017-03-23 11:30:00","end_datetime":"2017-03-23 13:30:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"15","attribute_id":"51","status":"1","created_at":"2017-03-07 07:14:52","updated_at":"2017-03-07 07:14:52","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-03-07 07:14:52', '2017-03-07 07:14:52'),
(370, 'task', 'created', 0, '[{"id":"193","task_name":"Ghhj","client_id":"95","note_detail":"","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"0000-00-00","start_datetime":"0000-00-00 00:00:00","end_datetime":"0000-00-00 00:00:00","task_completed_date":"0000-00-00 00:00:00","rating":"0","comments":"","property_id":"15","attribute_id":"117","status":"1","created_at":"2017-03-08 04:28:18","updated_at":"2017-03-08 04:28:18","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-03-08 04:28:18', '2017-03-08 04:28:18'),
(371, 'task', 'completed', 0, '[{"id":"163","task_name":"New sink","client_id":"95","note_detail":"Hehdhkd","priority":"3","document_id":"0","technician_id":"0","assigned_date":"0000-00-00","scheduled_date":"2017-03-18","start_datetime":"2017-03-18 00:15:00","end_datetime":"2017-03-18 01:15:00","task_completed_date":"2017-03-08 04:31:57","rating":"5","comments":"Bdjjdjdjd","property_id":"15","attribute_id":"51","status":"4","created_at":"2017-01-30 16:19:11","updated_at":"2017-03-08 04:31:57","deleted_at":"0000-00-00 00:00:00","task_documents":[]}]', '2017-03-08 04:31:57', '2017-03-08 04:31:57');

-- --------------------------------------------------------

--
-- Table structure for table `devices`
--

CREATE TABLE IF NOT EXISTS `devices` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `device_token` text NOT NULL,
  `device_type` varchar(100) NOT NULL,
  `badge_count` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=819 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `devices`
--

INSERT INTO `devices` (`id`, `user_id`, `device_token`, `device_type`, `badge_count`, `created_at`, `updated_at`, `deleted_at`) VALUES
(4, 90, 'b2e74e1c560a49f64f2d8f6a793b8ea96d0b2573143bb0b81e011b64dbc3bd16', 'ios', 1, '2017-01-02 06:43:03', '2017-01-02 12:17:30', '0000-00-00 00:00:00'),
(18, 91, 'c595c075c0a2e0bc04b6743b9605932abba2604d38a69753fe8d4bf2c0512f36', 'ios', 1, '2017-01-02 07:14:17', '2017-01-02 12:08:22', '0000-00-00 00:00:00'),
(31, 89, 'dbbc5f13c457850679cbce433a2265db8cafbfad42f8e4d19abd10682dedf1a1', 'ios', 17, '2017-01-02 08:31:33', '2017-01-25 07:14:23', '0000-00-00 00:00:00'),
(50, 89, '530f9d8cf79c53addc72c74f3d5459f4c902a28b6620ce4fad17746419285f51', 'ios', 14, '2017-01-02 10:16:23', '2017-01-25 07:14:24', '0000-00-00 00:00:00'),
(59, 89, 'dfc33b4994e6b8f675e1ce94d9953c54cdfcd9bd5b9a11d080db65e5e5546cb1', 'ios', 14, '2017-01-02 10:58:44', '2017-01-25 07:14:25', '0000-00-00 00:00:00'),
(64, 94, '55aa1e63a00a734350004c8b6b588f2f363da71a1b6895e2532322a014c02ffa', 'ios', 18, '2017-01-02 11:52:57', '2017-02-22 09:14:58', '0000-00-00 00:00:00'),
(67, 94, 'cc1d6f9e42f403398ce53d86520631077154108c63cfd0637683891776178c68', 'ios', 0, '2017-01-02 12:24:41', '2017-01-02 12:24:41', '0000-00-00 00:00:00'),
(68, 89, '4d4de0e507a4b00ef11b35e573041a9cf8f4b0150a0b2713fbe52c10c5c009ca', 'ios', 13, '2017-01-02 12:31:34', '2017-01-25 07:14:26', '0000-00-00 00:00:00'),
(358, 89, '1a93e7fc1fd0129615db63bfb5e571a37967c8e326fd917f654a1929c7a790bd', 'ios', 3, '2017-01-19 14:03:06', '2017-01-25 07:14:27', '0000-00-00 00:00:00'),
(359, 95, 'da6442c95cbe40289df2b75632a7fdf10b3ccdb57fb2e514b1bc87c003798321', 'ios', 1, '2017-01-20 12:58:34', '2017-02-22 09:14:55', '0000-00-00 00:00:00'),
(474, 89, '24eeae03e78089f83c756ab82649455899649794eed758d0c256449797132c22', 'ios', 3, '2017-01-24 09:25:31', '2017-01-25 07:14:28', '0000-00-00 00:00:00'),
(496, 99, '1aa62d33023f27db8b9c594f0822f2e95824c27bbaba0d75e2ed02a06b11720c', 'ios', 0, '2017-01-24 11:53:51', '2017-01-24 11:53:51', '0000-00-00 00:00:00'),
(504, 95, '1053f077c3cd71a1d6bda5fdd2b532103f1b6f6c054b08043f2bf969a42ac548', 'ios', 1, '2017-01-24 12:59:07', '2017-02-22 09:14:56', '0000-00-00 00:00:00'),
(511, 95, '5e5634b80f8711cc40d77e070961d628c99b14c2814f840c748d4c777b78b987', 'ios', 1, '2017-01-24 13:21:37', '2017-02-22 09:14:57', '0000-00-00 00:00:00'),
(545, 101, '396710eade25dec1ae00da06bf3e240580dc14072f5f02f2a601a1dba03348c5', 'ios', 0, '2017-01-27 05:45:46', '2017-01-27 06:27:05', '0000-00-00 00:00:00'),
(566, 89, 'ec8ab4f84ef26ace8cb9406afb0b08ddb033a325416e71e68b67ea90b3fb1063', 'ios', 0, '2017-01-27 08:44:18', '2017-01-27 08:44:18', '0000-00-00 00:00:00'),
(575, 89, '55aa1e63a00a734350004c8b6b588f2f363da71a1b6895e2532322a014c02ffa', 'ios', 0, '2017-02-01 08:51:02', '2017-02-01 08:51:02', '0000-00-00 00:00:00'),
(579, 97, '55aa1e63a00a734350004c8b6b588f2f363da71a1b6895e2532322a014c02ffa', 'ios', 0, '2017-02-08 00:19:54', '2017-02-08 00:19:54', '0000-00-00 00:00:00'),
(597, 102, '95c8b3cf98a4ea843ef0aa5e8b29f915a706f45208bac1ab032cad63a9d37fb0', 'ios', 0, '2017-02-17 10:18:06', '2017-02-17 10:18:06', '0000-00-00 00:00:00'),
(615, 95, '0ad11f11d1e10943b52db52b877fe6ab3e6fa12d1fb0678d158f3182072c96e6', 'ios', 0, '2017-02-24 04:55:00', '2017-02-24 04:55:00', '0000-00-00 00:00:00'),
(621, 106, 'b2eb58f5ef28a1ddac67549593cec452314badf3deaacb280570208e1e760906', 'ios', 0, '2017-02-25 06:45:55', '2017-02-25 06:45:55', '0000-00-00 00:00:00'),
(623, 97, '00c43578544dfd92f8410288875d2ad1dbb955c44f2ca4fd998fc4ebda2478e8', 'ios', 0, '2017-02-27 18:42:16', '2017-02-27 18:42:16', '0000-00-00 00:00:00'),
(737, 96, '2e4977ef26b16043a5159e422ad3e2fc9b50095caf98d182bf1847554cb231ea', 'ios', 0, '2017-03-02 13:23:12', '2017-03-02 13:23:12', '0000-00-00 00:00:00'),
(738, 96, '8f2b1ebce1328d3a7279d08ef8f3bb7aea2a39a773bdbf2b2c243bcd64007770', 'ios', 0, '2017-03-03 03:41:12', '2017-03-03 03:41:12', '0000-00-00 00:00:00'),
(764, 105, '8ab46d1e1d1aed1479520d33930a657ff886c1043f17af64c5261fa63853374b', 'ios', 0, '2017-03-03 19:04:32', '2017-03-03 19:04:32', '0000-00-00 00:00:00'),
(775, 96, '76456745674567', 'IOS', 0, '2017-03-06 06:30:29', '2017-03-06 06:30:29', '0000-00-00 00:00:00'),
(776, 96, '76456745674567', 'IOS', 0, '2017-03-06 06:31:56', '2017-03-06 06:31:56', '0000-00-00 00:00:00'),
(777, 96, '76456745674567', 'IOS', 0, '2017-03-06 06:32:30', '2017-03-06 06:32:30', '0000-00-00 00:00:00'),
(778, 96, '76456745674567', 'IOS', 0, '2017-03-06 06:35:23', '2017-03-06 06:35:23', '0000-00-00 00:00:00'),
(779, 96, '76456745674567', 'IOS', 0, '2017-03-06 06:37:10', '2017-03-06 06:37:10', '0000-00-00 00:00:00'),
(799, 95, '55aa1e63a00a734350004c8b6b588f2f363da71a1b6895e2532322a014c02ffa', 'ios', 0, '2017-03-06 09:34:11', '2017-03-06 09:34:11', '0000-00-00 00:00:00'),
(806, 95, 'ed41a67736bbabff201020ae91528a0931560e7ed30ea32d6cecbba8d354ba50', 'ios', 0, '2017-03-07 07:16:19', '2017-03-07 07:16:19', '0000-00-00 00:00:00'),
(812, 96, '859ee30528d8739e444dc88f1301a8e6e2d0cda7e315e68bad0a05723d95db93', 'ios', 0, '2017-03-07 11:52:30', '2017-03-07 11:52:30', '0000-00-00 00:00:00'),
(813, 95, 'fb4282a7a2e4c956939bd43e3402a72ed0effb5d88d242eaeac54c4d33d906ff', 'ios', 0, '2017-03-07 12:08:59', '2017-03-07 12:08:59', '0000-00-00 00:00:00'),
(814, 95, '1580450e6bd58a8b42078be3fcb0c463b8f093f01d8df728d6648fca346139de', 'ios', 0, '2017-03-08 04:27:12', '2017-03-08 04:27:12', '0000-00-00 00:00:00'),
(818, 96, '55aa1e63a00a734350004c8b6b588f2f363da71a1b6895e2532322a014c02ffa', 'ios', 0, '2017-03-08 08:43:13', '2017-03-08 08:43:13', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE IF NOT EXISTS `documents` (
  `id` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  `filename` varchar(500) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=72 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`id`, `type`, `type_id`, `filename`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 2, 2, 'http://frontline.debutinfotech.com/uploads/userfiles/thumb_1483333651.jpeg', '2017-01-02 05:07:32', '2017-01-02 05:07:32', NULL),
(2, 2, 3, 'http://frontline.debutinfotech.com/uploads/userfiles/thumb_1483334263.jpeg', '2017-01-02 05:17:44', '2017-01-02 05:17:44', NULL),
(3, 2, 28, 'http://frontline.debutinfotech.com/uploads/userfiles/thumb_1483340503.jpeg', '2017-01-02 07:01:44', '2017-01-02 07:01:44', NULL),
(4, 2, 41, 'http://frontline.debutinfotech.com/uploads/userfiles/thumb_1483347569.jpeg', '2017-01-02 08:59:30', '2017-01-02 08:59:30', NULL),
(33, 2, 53, 'http://frontline.debutinfotech.com/uploads/userfiles/thumb_1483353237.jpeg', '2017-01-02 10:33:57', '2017-01-02 10:33:57', NULL),
(34, 2, 54, 'http://frontline.debutinfotech.com/uploads/userfiles/thumb_1483353302.jpeg', '2017-01-02 10:35:03', '2017-01-02 10:35:03', NULL),
(35, 2, 55, 'http://frontline.debutinfotech.com/uploads/userfiles/thumb_1483353384.jpeg', '2017-01-02 10:36:24', '2017-01-02 10:36:24', NULL),
(36, 2, 56, 'http://frontline.debutinfotech.com/uploads/userfiles/thumb_1483353456.jpeg', '2017-01-02 10:37:36', '2017-01-02 10:37:36', NULL),
(37, 2, 60, 'http://frontline.debutinfotech.com/uploads/userfiles/thumb_1483358011.jpeg', '2017-01-02 11:53:31', '2017-01-02 11:53:31', NULL),
(38, 2, 62, 'http://frontline.debutinfotech.com/uploads/userfiles/thumb_1483358113.jpeg', '2017-01-02 11:55:13', '2017-01-02 11:55:13', NULL),
(39, 2, 78, 'http://frontline.debutinfotech.com/uploads/userfiles/thumb_1483697550.jpeg', '2017-01-06 10:12:37', '2017-01-06 10:12:37', NULL),
(40, 2, 98, 'http://frontline.debutinfotech.com/uploads/userfiles/thumb_1484646801.jpeg', '2017-01-17 09:53:22', '2017-01-17 09:53:22', NULL),
(41, 2, 99, 'http://frontline.debutinfotech.com/uploads/userfiles/thumb_1484646801.jpeg', '2017-01-17 09:53:30', '2017-01-17 09:53:30', NULL),
(42, 2, 109, 'http://frontline.debutinfotech.com/uploads/userfiles/thumb_1484917160.jpeg', '2017-01-20 13:00:20', '2017-01-20 13:00:20', NULL),
(43, 2, 109, 'http://frontline.debutinfotech.com/uploads/userfiles/thumb_1484917217.jpeg', '2017-01-20 13:00:21', '2017-01-20 13:00:21', NULL),
(53, 2, 79, 'http://frontline.debutinfotech.com/uploads/userfiles/thumb_1485264205.jpg', '2017-01-24 13:23:26', '2017-01-24 13:23:26', NULL),
(54, 2, 79, 'http://frontline.debutinfotech.com/uploads/userfiles/thumb_1485264229.jpg', '2017-01-24 13:24:03', '2017-01-24 13:24:03', NULL),
(55, 2, 79, 'http://frontline.debutinfotech.com/uploads/userfiles/thumb_1485264236.jpg', '2017-01-24 13:24:03', '2017-01-24 13:24:03', NULL),
(56, 2, 79, 'http://frontline.debutinfotech.com/uploads/userfiles/thumb_1485264242.jpg', '2017-01-24 13:24:03', '2017-01-24 13:24:03', NULL),
(57, 2, 171, 'http://frontline.debutinfotech.com/uploads/userfiles/thumb_1486513701.jpeg', '2017-02-08 00:28:22', '2017-02-08 00:28:22', NULL),
(58, 2, 173, 'http://frontline.debutinfotech.com/uploads/userfiles/thumb_1487285651.jpeg', '2017-02-16 22:54:12', '2017-02-16 22:54:12', NULL),
(59, 2, 185, 'http://frontline.debutinfotech.com/uploads/userfiles/thumb_1487855301.jpeg', '2017-02-23 13:08:22', '2017-02-23 13:08:22', NULL),
(60, 2, 183, 'http://frontline.debutinfotech.com/uploads/userfiles/thumb_1487855506.jpg', '2017-02-23 13:11:46', '2017-02-23 13:11:46', NULL),
(61, 2, 75, 'http://frontline.debutinfotech.com/uploads/userfiles/thumb_1487914794.jpg', '2017-02-24 05:39:58', '2017-02-24 05:39:58', NULL),
(62, 2, 75, 'http://frontline.debutinfotech.com/uploads/userfiles/thumb_1487914798.jpg', '2017-02-24 05:39:58', '2017-02-24 05:39:58', NULL),
(63, 2, 191, 'http://frontline.debutinfotech.com/uploads/userfiles/thumb_1488452705.jpeg', '2017-03-02 11:05:16', '2017-03-02 11:05:16', NULL),
(64, 2, 191, 'http://frontline.debutinfotech.com/uploads/userfiles/thumb_1488452707.jpeg', '2017-03-02 11:05:16', '2017-03-02 11:05:16', NULL),
(65, 2, 191, 'http://frontline.debutinfotech.com/uploads/userfiles/thumb_1488452709.jpeg', '2017-03-02 11:05:16', '2017-03-02 11:05:16', NULL),
(66, 2, 191, 'http://frontline.debutinfotech.com/uploads/userfiles/thumb_1488452709.jpeg', '2017-03-02 11:05:16', '2017-03-02 11:05:16', NULL),
(67, 2, 191, 'http://frontline.debutinfotech.com/uploads/userfiles/thumb_1488452710.jpeg', '2017-03-02 11:05:16', '2017-03-02 11:05:16', NULL),
(68, 2, 191, 'http://frontline.debutinfotech.com/uploads/userfiles/thumb_1488452712.jpeg', '2017-03-02 11:05:16', '2017-03-02 11:05:16', NULL),
(69, 2, 191, 'http://frontline.debutinfotech.com/uploads/userfiles/thumb_1488452714.jpeg', '2017-03-02 11:05:17', '2017-03-02 11:05:17', NULL),
(70, 2, 191, 'http://frontline.debutinfotech.com/uploads/userfiles/thumb_1488452716.jpeg', '2017-03-02 11:05:17', '2017-03-02 11:05:17', NULL),
(71, 2, 191, 'http://frontline.debutinfotech.com/uploads/userfiles/thumb_1488458120.jpg', '2017-03-02 12:35:21', '2017-03-02 12:35:21', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `email_templates`
--

CREATE TABLE IF NOT EXISTS `email_templates` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `subject` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `email_templates`
--

INSERT INTO `email_templates` (`id`, `name`, `subject`, `content`, `created_by`, `modified_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(24, 'Forgot password', 'Reset Password For FrontlineApp', '<span style="font-weight: bold;">Hello Admin,<br></span><span style="color: rgb(255, 0, 0);"><br></span>Congratulations!<div><br></div><div>Please check the below Link:&nbsp;<br><br><b>@click here@</b></div><div><br></div><div>Just click on the above link to reset your password.</div><div><br></div><div>Thanks &amp; Regards,<br>Team Frontline<br></div>', NULL, NULL, '2016-03-31 02:45:25', '2016-11-16 22:18:10', NULL),
(39, 'Activation Mail', 'New Account Created', '<font size="4"><span style="color: rgb(111, 168, 220);">Welcome to @sitename@</span><br><br></font><font size="3">You''re almost done, but not quite. Please confirm your email address to complete registering with @sitename@.<span style="color: rgb(56, 118, 29);">@Click here@</span><br><br>Your Login Credentials:</font><br><span style="font-weight: bold;">Email</span> : @email@<br><span style="font-weight: bold;">Password</span>: @password@<br><br><br>Kind Regards,<br>The @sitename@ team', NULL, NULL, '2016-07-14 01:28:59', '2016-07-14 01:28:59', NULL),
(41, 'client activation mail', 'client registration', 'Hello @name@<br>&nbsp;<br>You have been registered on frontline app as @type@.<br>Username: @username@<br>Password: @password@<br><br>Hit the following link: @link@<br><br>Regards<br>Team @company@', NULL, NULL, '2016-10-21 05:57:27', '2016-10-21 05:57:27', NULL),
(42, 'reset password app', 'Reset Password link', 'Hello @name@<br><br>email: @email@<br>Please click below to reset your password.<br>@link@ <br><br>Regard<br>@company@', NULL, NULL, '2016-11-03 01:36:05', '2016-11-03 01:36:05', NULL),
(43, 'Task Created', 'New task requested', 'Hello Admin,<br><br><span style="text-decoration: underline;">A new task named @taskname@ has been requested by following user:-</span><br>name: @name@<br>email: @email@<br>usertype: @type@<br><br><span style="text-decoration: underline;">Property details for task:-</span><br>Property name: @propertyname@<br>Property name: @attribute@<br>Start date-time: @startdatetime@<br>End date-time: @enddatetime@<br>Priority: @priority@<br><br>Regards<br>@company@<br><br>', NULL, NULL, '2016-12-08 03:36:33', '2016-12-08 03:44:48', NULL),
(45, 'Task Completed', 'Task Completed', 'Hello Admin<br><br>the following task has been completed.<br>Task name: @taskname@<br>Requested by: @client@<br>Email: @email@<br>Completed Date: @completeddate@<br>Property: @property@<br>Property attribute: @attribute@<br>Rating: @rating@<br><br>Regards<br>@company@', NULL, NULL, '2016-12-08 04:43:55', '2016-12-08 05:23:05', NULL),
(46, 'Task Deleted', 'Task Deleted', 'Hello Admin<br><br>Following Task has been deleted:-<br>Task Name: @taskname@<br>User: @username@<br>Email: @otheruseone@<br><br>Regards<br>@company@<br>', NULL, NULL, '2016-12-08 04:51:17', '2016-12-08 05:41:59', NULL),
(47, 'Note Added', 'Note Added', 'Hello Admin,<br><br>One note has been added:-<br>User:@otheruseone@<br>Note title: @title@<span style="text-decoration: underline;"><br>Note Description:<br></span>@description@<br><br><br>Regards<br>@company@<span style="text-decoration: underline;"><br></span>', NULL, NULL, '2016-12-08 04:55:52', '2016-12-08 05:00:59', NULL),
(48, 'Note Updated', 'Note Updated', 'Hello Admin<br><br>One note has been update:-<br>User:@otheruse@<br>Title:@title@<br><span style="text-decoration: underline;">Description:<br></span>&nbsp;@description@<br><br><br>Regards<br>@company@', NULL, NULL, '2016-12-08 04:58:45', '2016-12-08 05:00:41', NULL),
(49, 'Note Deleted', 'Note Deleted', 'Hello Admin,<br><br>Following Note has been deleted:<br>User: @username@<br>Title: @title@<br>Description: @description@<br><br>Regards<br>@company@<br>', NULL, NULL, '2016-12-08 05:03:54', '2016-12-08 05:03:54', NULL),
(50, 'Task Resheduled', 'Task Resheduled', 'Hello Admin,<br><br>Following task has been Resheduled:-<br>Task Name: @taskname@<br>Requested by: @username@<br>Property :@propertyname@<br>Attribute :@attribute@<br><br>Task New start datetime: @newstart@<br>Task New end datetime: @newend@<br><br><br>Regards<br>@company@<br>', NULL, NULL, '2016-12-08 05:10:22', '2016-12-13 01:40:03', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `email_template_attributes`
--

CREATE TABLE IF NOT EXISTS `email_template_attributes` (
  `id` int(10) unsigned NOT NULL,
  `email_template_id` int(11) NOT NULL,
  `variable` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=134 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `email_template_attributes`
--

INSERT INTO `email_template_attributes` (`id`, `email_template_id`, `variable`, `created_by`, `modified_by`, `created_at`, `updated_at`) VALUES
(26, 24, '@click here@', NULL, NULL, '2016-03-31 04:06:45', '0000-00-00 00:00:00'),
(35, 36, '@name@', NULL, NULL, '2016-05-23 06:27:59', '2016-05-23 06:27:59'),
(36, 36, '@reply@', NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(37, 36, '@sitename@', NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(51, 38, '@name@', NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(52, 38, '@address@', NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(53, 38, '@email@', NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(54, 38, '@product_id@', NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(55, 37, '@address@', NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(56, 37, '@name@', NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(57, 37, '@email@', NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(58, 37, '@product_id@', NULL, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(59, 39, '@sitename@', NULL, NULL, '2016-07-14 01:28:59', '2016-07-14 01:28:59'),
(60, 39, '@Click here@', NULL, NULL, '2016-07-14 01:29:00', '2016-07-14 01:29:00'),
(61, 39, '@email@', NULL, NULL, '2016-07-14 01:29:00', '2016-07-14 01:29:00'),
(62, 39, '@password@', NULL, NULL, '2016-07-14 01:29:00', '2016-07-14 01:29:00'),
(63, 40, '@sitename@', NULL, NULL, '2016-08-05 00:47:50', '2016-08-05 00:47:50'),
(64, 40, '@email@', NULL, NULL, '2016-08-05 00:47:51', '2016-08-05 00:47:51'),
(65, 40, '@password@', NULL, NULL, '2016-08-05 00:47:51', '2016-08-05 00:47:51'),
(66, 40, '@Click here@', NULL, NULL, '2016-08-05 00:47:51', '2016-08-05 00:47:51'),
(67, 40, '@name', NULL, NULL, '2016-10-21 05:55:03', '2016-10-21 05:55:03'),
(68, 40, '@type@', NULL, NULL, '2016-10-21 05:55:03', '2016-10-21 05:55:03'),
(69, 40, '@username@', NULL, NULL, '2016-10-21 05:55:03', '2016-10-21 05:55:03'),
(70, 40, '@password@', NULL, NULL, '2016-10-21 05:55:03', '2016-10-21 05:55:03'),
(71, 40, '@link@', NULL, NULL, '2016-10-21 05:55:03', '2016-10-21 05:55:03'),
(72, 40, '@company@', NULL, NULL, '2016-10-21 05:55:03', '2016-10-21 05:55:03'),
(73, 40, '@otheruseone@', NULL, NULL, '2016-10-21 05:55:03', '2016-10-21 05:55:03'),
(74, 40, '@otherusetwo@', NULL, NULL, '2016-10-21 05:55:03', '2016-10-21 05:55:03'),
(75, 41, '@name', NULL, NULL, '2016-10-21 05:57:27', '2016-10-21 05:57:27'),
(76, 41, '@type@', NULL, NULL, '2016-10-21 05:57:27', '2016-10-21 05:57:27'),
(77, 41, '@username@', NULL, NULL, '2016-10-21 05:57:27', '2016-10-21 05:57:27'),
(78, 41, '@password@', NULL, NULL, '2016-10-21 05:57:27', '2016-10-21 05:57:27'),
(79, 41, '@link@', NULL, NULL, '2016-10-21 05:57:27', '2016-10-21 05:57:27'),
(80, 41, '@company@', NULL, NULL, '2016-10-21 05:57:27', '2016-10-21 05:57:27'),
(81, 41, '@otheruseone@', NULL, NULL, '2016-10-21 05:57:27', '2016-10-21 05:57:27'),
(82, 41, '@otherusetwo@', NULL, NULL, '2016-10-21 05:57:27', '2016-10-21 05:57:27'),
(83, 42, '@name@', NULL, NULL, '2016-11-03 01:36:06', '2016-11-03 01:36:06'),
(84, 42, '@email@', NULL, NULL, '2016-11-03 01:36:06', '2016-11-03 01:36:06'),
(85, 42, '@link@', NULL, NULL, '2016-11-03 01:36:06', '2016-11-03 01:36:06'),
(86, 42, '@company@', NULL, NULL, '2016-11-03 01:36:06', '2016-11-03 01:36:06'),
(87, 42, '@extra@', NULL, NULL, '2016-11-03 01:36:06', '2016-11-03 01:36:06'),
(88, 43, '@taskname@', NULL, NULL, '2016-12-08 03:36:33', '2016-12-08 03:36:33'),
(89, 43, '@name@', NULL, NULL, '2016-12-08 03:36:33', '2016-12-08 03:36:33'),
(90, 43, '@email@', NULL, NULL, '2016-12-08 03:36:33', '2016-12-08 03:36:33'),
(91, 43, '@type@', NULL, NULL, '2016-12-08 03:36:33', '2016-12-08 03:36:33'),
(92, 43, '@propertyname@', NULL, NULL, '2016-12-08 03:36:33', '2016-12-08 03:36:33'),
(93, 43, '@attribute@', NULL, NULL, '2016-12-08 03:36:33', '2016-12-08 03:36:33'),
(94, 43, '@startdatetime@', NULL, NULL, '2016-12-08 03:36:33', '2016-12-08 03:36:33'),
(95, 43, '@enddatetime@', NULL, NULL, '2016-12-08 03:36:33', '2016-12-08 03:36:33'),
(96, 43, '@priority@', NULL, NULL, '2016-12-08 03:36:33', '2016-12-08 03:36:33'),
(97, 43, '@company@', NULL, NULL, '2016-12-08 03:36:33', '2016-12-08 03:36:33'),
(98, 45, '@taskname@', NULL, NULL, '2016-12-08 04:43:55', '2016-12-08 04:43:55'),
(99, 45, '@client@', NULL, NULL, '2016-12-08 04:43:55', '2016-12-08 04:43:55'),
(100, 45, '@email@', NULL, NULL, '2016-12-08 04:43:55', '2016-12-08 04:43:55'),
(101, 45, '@completeddate@', NULL, NULL, '2016-12-08 04:43:55', '2016-12-08 04:43:55'),
(102, 45, '@property@', NULL, NULL, '2016-12-08 04:43:55', '2016-12-08 04:43:55'),
(103, 45, '@attribute@', NULL, NULL, '2016-12-08 04:43:55', '2016-12-08 04:43:55'),
(104, 45, '@company@', NULL, NULL, '2016-12-08 04:43:55', '2016-12-08 04:43:55'),
(105, 46, '@taskname@', NULL, NULL, '2016-12-08 04:51:17', '2016-12-08 04:51:17'),
(106, 46, '@username@', NULL, NULL, '2016-12-08 04:51:17', '2016-12-08 04:51:17'),
(107, 46, '@company@', NULL, NULL, '2016-12-08 04:51:17', '2016-12-08 04:51:17'),
(108, 46, '@otheruseone@', NULL, NULL, '2016-12-08 04:51:17', '2016-12-08 04:51:17'),
(109, 46, '@otherusetwo@', NULL, NULL, '2016-12-08 04:51:17', '2016-12-08 04:51:17'),
(110, 46, '', NULL, NULL, '2016-12-08 04:51:17', '2016-12-08 04:51:17'),
(111, 47, '@title@', NULL, NULL, '2016-12-08 04:55:52', '2016-12-08 04:55:52'),
(112, 47, '@description@', NULL, NULL, '2016-12-08 04:55:52', '2016-12-08 04:55:52'),
(113, 47, '@company@', NULL, NULL, '2016-12-08 04:55:52', '2016-12-08 04:55:52'),
(114, 47, '@otheruseone@', NULL, NULL, '2016-12-08 04:55:52', '2016-12-08 04:55:52'),
(115, 48, '@title@', NULL, NULL, '2016-12-08 04:58:45', '2016-12-08 04:58:45'),
(116, 48, '@description@', NULL, NULL, '2016-12-08 04:58:45', '2016-12-08 04:58:45'),
(117, 48, '@company@', NULL, NULL, '2016-12-08 04:58:45', '2016-12-08 04:58:45'),
(118, 48, '@otheruse@', NULL, NULL, '2016-12-08 04:58:45', '2016-12-08 04:58:45'),
(119, 49, '@username@', NULL, NULL, '2016-12-08 05:03:54', '2016-12-08 05:03:54'),
(120, 49, '@title@', NULL, NULL, '2016-12-08 05:03:54', '2016-12-08 05:03:54'),
(121, 49, '@description@', NULL, NULL, '2016-12-08 05:03:54', '2016-12-08 05:03:54'),
(122, 49, '@company@', NULL, NULL, '2016-12-08 05:03:54', '2016-12-08 05:03:54'),
(123, 50, '@taskname@', NULL, NULL, '2016-12-08 05:10:22', '2016-12-08 05:10:22'),
(124, 50, '@username@', NULL, NULL, '2016-12-08 05:10:22', '2016-12-08 05:10:22'),
(125, 50, '@propertyname@', NULL, NULL, '2016-12-08 05:10:22', '2016-12-08 05:10:22'),
(126, 50, '@attribute@', NULL, NULL, '2016-12-08 05:10:22', '2016-12-08 05:10:22'),
(127, 50, '@oldstart@', NULL, NULL, '2016-12-08 05:10:22', '2016-12-08 05:10:22'),
(128, 50, '@oldend@', NULL, NULL, '2016-12-08 05:10:22', '2016-12-08 05:10:22'),
(129, 50, '@newstart@', NULL, NULL, '2016-12-08 05:10:22', '2016-12-08 05:10:22'),
(130, 50, '@newend@', NULL, NULL, '2016-12-08 05:10:22', '2016-12-08 05:10:22'),
(131, 50, '@company@', NULL, NULL, '2016-12-08 05:10:22', '2016-12-08 05:10:22'),
(132, 50, '@otheruse@', NULL, NULL, '2016-12-08 05:10:22', '2016-12-08 05:10:22'),
(133, 45, '@rating@', NULL, NULL, '2016-12-08 04:43:55', '2016-12-08 04:43:55');

-- --------------------------------------------------------

--
-- Table structure for table `general_notes`
--

CREATE TABLE IF NOT EXISTS `general_notes` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `client_notes` text NOT NULL,
  `title` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `general_notes`
--

INSERT INTO `general_notes` (`id`, `user_id`, `client_notes`, `title`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 87, 'Chnchfhf hfjfhfh hfhfhfh hfhfhfh hfhfhhf hfhfhfh hfhfhfh hfhfhfhd hfhfhfhhfh hfhfhfhhfhfhfhfbbfbfhhf', 'Ncncnxnfnc fnnfjfhf nfjfjjfjf hfhfhfhhf hfhhffhfh', '2017-01-02 05:47:13', '2017-01-02 05:47:13', '0000-00-00 00:00:00'),
(2, 93, 'Hhh', 'Cgg', '2017-01-02 10:38:22', '2017-01-02 10:38:22', '0000-00-00 00:00:00'),
(3, 94, 'Vvv', 'Hhh', '2017-01-02 11:58:13', '2017-01-02 11:58:13', '0000-00-00 00:00:00'),
(4, 95, 'Details for the note Details for the noteDetails for the note. Details for the note', 'New note', '2017-01-05 14:17:20', '2017-01-05 14:17:20', '0000-00-00 00:00:00'),
(5, 95, 'Testting', 'Hello', '2017-01-11 11:26:24', '2017-01-11 11:26:24', '0000-00-00 00:00:00'),
(6, 98, 'Yehdj', 'Teurj', '2017-01-11 12:58:54', '2017-01-11 12:58:54', '0000-00-00 00:00:00'),
(7, 98, 'Need at house tomorrow for closing', '322 Fulton closing ASAP', '2017-01-11 12:59:01', '2017-01-11 12:59:01', '0000-00-00 00:00:00'),
(9, 89, 'Need to clean the floor.kafhjksafjkasjfkfjkmnc kasjksajfk asf asdfkjkdskfdjf iyeuiueiwruiewr. Eiwuiewuriewru ieruiewruiewruieuriewurfdskfjdsfkjdkfjdskfjdksfjkfsjksdfjkdsfjkdsfjkdsfjkdsfjksdjfkdsfjkdsfjdsfkjsdfknkmsdfkjsdfkjdsfkjdsfkjdskfjsdkfsdkfjkend', 'Need to urgent worker', '2017-01-17 06:31:20', '2017-01-17 06:54:26', '0000-00-00 00:00:00'),
(10, 99, 'This is my notes.I need to write some values here.', 'My note', '2017-01-17 08:15:56', '2017-01-17 08:15:56', '0000-00-00 00:00:00'),
(12, 100, 'Czechs', 'Frffzdgg', '2017-01-27 05:19:08', '2017-01-27 05:30:59', '0000-00-00 00:00:00'),
(13, 101, 'Cvg', 'Vfsvy', '2017-01-27 05:58:46', '2017-01-27 05:58:46', '0000-00-00 00:00:00'),
(14, 102, 'Jhch', 'Chf', '2017-01-27 09:36:50', '2017-01-27 09:36:50', '0000-00-00 00:00:00'),
(15, 95, 'Note details - jg', 'New note', '2017-01-30 19:26:30', '2017-01-30 19:26:30', '0000-00-00 00:00:00'),
(16, 97, 'Jon', 'Bath', '2017-01-30 19:26:48', '2017-01-30 19:26:48', '0000-00-00 00:00:00'),
(17, 105, 'Be careful of shadow - trained to bite.', 'Dog in yard', '2017-02-21 07:33:55', '2017-02-21 07:33:55', '0000-00-00 00:00:00'),
(18, 106, 'Cuduxucu', 'FifficfuJxjduxu', '2017-02-22 09:24:14', '2017-02-22 09:24:27', '0000-00-00 00:00:00'),
(19, 96, 'Chu', 'Dygfggh', '2017-03-01 04:38:46', '2017-03-01 13:39:34', '0000-00-00 00:00:00'),
(20, 96, 'Kjh', 'Kjh', '2017-03-01 14:00:14', '2017-03-01 14:00:14', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE IF NOT EXISTS `images` (
  `id` int(10) unsigned NOT NULL,
  `type_id` int(11) NOT NULL,
  `image_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` enum('0','1') COLLATE utf8_unicode_ci NOT NULL COMMENT '(0=product, 1=graphics)',
  `sort_num` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_10_12_000000_create_users_table', 1),
('2014_10_12_100000_create_password_resets_table', 1),
('2016_05_25_040302_create_sub_category_table', 2),
('2016_05_25_084612_create_products_table', 3),
('2016_05_26_063103_Create_Categories_table', 4),
('2016_05_26_084507_create_graphics_table', 5),
('2016_05_30_111556_create_images_table', 6),
('2016_07_19_100223_createstafftable', 7),
('2016_08_08_045208_Create_Style_Table', 8),
('2016_08_08_114040_update_categories_table', 9);

-- --------------------------------------------------------

--
-- Table structure for table `note`
--

CREATE TABLE IF NOT EXISTS `note` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` mediumtext NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `status` int(11) NOT NULL COMMENT '1:active,2:deleted'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `notification_logs`
--

CREATE TABLE IF NOT EXISTS `notification_logs` (
  `id` int(11) NOT NULL,
  `task_id` int(11) NOT NULL,
  `task_type` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `sent_to_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=127 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notification_logs`
--

INSERT INTO `notification_logs` (`id`, `task_id`, `task_type`, `title`, `sent_to_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 3, 'Accepted', 'Kitchen', 87, '2017-01-02 05:22:41', '2017-01-02 05:22:41', '0000-00-00 00:00:00'),
(2, 3, 'Accepted', 'Kitchen', 87, '2017-01-02 05:26:31', '2017-01-02 05:26:31', '0000-00-00 00:00:00'),
(3, 3, 'Technician Assigned', 'Kitchen', 87, '2017-01-02 05:26:46', '2017-01-02 05:26:46', '0000-00-00 00:00:00'),
(4, 3, 'Technician Assigned', 'Kitchen', 87, '2017-01-02 05:28:03', '2017-01-02 05:28:03', '0000-00-00 00:00:00'),
(5, 2, 'Task Deleted', 'Bedroom walls', 87, '2017-01-02 05:31:02', '2017-01-02 05:31:02', '0000-00-00 00:00:00'),
(6, 5, 'Task Deleted', 'Task', 87, '2017-01-02 05:38:40', '2017-01-02 05:38:40', '0000-00-00 00:00:00'),
(7, 4, 'Task Deleted', 'Bathroom tiles', 87, '2017-01-02 05:38:59', '2017-01-02 05:38:59', '0000-00-00 00:00:00'),
(8, 6, 'Task Deleted', 'Dhhdh', 87, '2017-01-02 05:41:57', '2017-01-02 05:41:57', '0000-00-00 00:00:00'),
(9, 7, 'Technician Assigned', 'Bedroom', 87, '2017-01-02 05:44:34', '2017-01-02 05:44:34', '0000-00-00 00:00:00'),
(10, 11, 'Accepted', 'Tap repair', 90, '2017-01-02 06:12:34', '2017-01-02 06:12:34', '0000-00-00 00:00:00'),
(11, 11, 'Declined', 'Tap repair', 90, '2017-01-02 06:14:40', '2017-01-02 06:14:40', '0000-00-00 00:00:00'),
(12, 11, 'Accepted', 'Tap repair', 90, '2017-01-02 06:15:21', '2017-01-02 06:15:21', '0000-00-00 00:00:00'),
(13, 11, 'Declined', 'Tap repair', 90, '2017-01-02 06:16:08', '2017-01-02 06:16:08', '0000-00-00 00:00:00'),
(14, 11, 'Technician Assigned', 'Tap repair', 90, '2017-01-02 06:16:28', '2017-01-02 06:16:28', '0000-00-00 00:00:00'),
(15, 11, 'Technician Assigned', 'Tap repair', 90, '2017-01-02 06:17:26', '2017-01-02 06:17:26', '0000-00-00 00:00:00'),
(16, 11, 'Declined', 'Tap repair', 90, '2017-01-02 06:17:43', '2017-01-02 06:17:43', '0000-00-00 00:00:00'),
(17, 11, 'Declined', 'Tap repair', 90, '2017-01-02 06:20:06', '2017-01-02 06:20:06', '0000-00-00 00:00:00'),
(18, 12, 'Declined', 'Painting', 90, '2017-01-02 06:20:48', '2017-01-02 06:20:48', '0000-00-00 00:00:00'),
(19, 12, 'Accepted', 'Painting', 90, '2017-01-02 06:21:25', '2017-01-02 06:21:25', '0000-00-00 00:00:00'),
(20, 2, 'Property Deleted', 'debut2', 87, '2017-01-02 06:24:41', '2017-01-02 06:24:41', '0000-00-00 00:00:00'),
(21, 1, 'Property Deleted', 'debut', 87, '2017-01-02 06:25:04', '2017-01-02 06:25:04', '0000-00-00 00:00:00'),
(22, 12, 'Declined', 'Painting', 90, '2017-01-02 06:26:01', '2017-01-02 06:26:01', '0000-00-00 00:00:00'),
(23, 12, 'Task Deleted', 'Painting', 90, '2017-01-02 06:26:17', '2017-01-02 06:26:17', '0000-00-00 00:00:00'),
(24, 11, 'Technician Assigned', 'Tap repair', 90, '2017-01-02 06:27:19', '2017-01-02 06:27:19', '0000-00-00 00:00:00'),
(25, 11, 'Declined', 'Tap repair', 90, '2017-01-02 06:27:41', '2017-01-02 06:27:41', '0000-00-00 00:00:00'),
(26, 3, 'Property Deleted', 'Villa', 89, '2017-01-02 06:34:28', '2017-01-02 06:34:28', '0000-00-00 00:00:00'),
(27, 15, 'Task Deleted', 'Soem more commecnts', 89, '2017-01-02 06:44:16', '2017-01-02 06:44:16', '0000-00-00 00:00:00'),
(28, 7, 'Property Added', 'mohalit tower', 91, '2017-01-02 06:53:13', '2017-01-02 06:53:13', '0000-00-00 00:00:00'),
(29, 7, 'Property Updated', 'mohalit tower', 91, '2017-01-02 06:53:32', '2017-01-02 06:53:32', '0000-00-00 00:00:00'),
(30, 7, 'Property Updated', 'mohalit tower', 91, '2017-01-02 06:53:51', '2017-01-02 06:53:51', '0000-00-00 00:00:00'),
(31, 7, 'Property Updated', 'mohalit tower', 91, '2017-01-02 06:54:47', '2017-01-02 06:54:47', '0000-00-00 00:00:00'),
(32, 7, 'Property Updated', 'mohalit tower', 91, '2017-01-02 06:55:44', '2017-01-02 06:55:44', '0000-00-00 00:00:00'),
(33, 7, 'Property Updated', 'mohalit tower', 91, '2017-01-02 06:56:10', '2017-01-02 06:56:10', '0000-00-00 00:00:00'),
(34, 7, 'Property Updated', 'mohalit tower', 91, '2017-01-02 06:56:30', '2017-01-02 06:56:30', '0000-00-00 00:00:00'),
(35, 7, 'Property Updated', 'mohalit tower', 91, '2017-01-02 06:56:50', '2017-01-02 06:56:50', '0000-00-00 00:00:00'),
(36, 7, 'Property Updated', 'mohalit tower', 91, '2017-01-02 06:57:11', '2017-01-02 06:57:11', '0000-00-00 00:00:00'),
(37, 7, 'Property Updated', 'mohalit tower', 91, '2017-01-02 06:57:30', '2017-01-02 06:57:30', '0000-00-00 00:00:00'),
(38, 7, 'Property Updated', 'mohalit tower', 91, '2017-01-02 06:57:44', '2017-01-02 06:57:44', '0000-00-00 00:00:00'),
(39, 7, 'Property Updated', 'mohalit tower', 91, '2017-01-02 06:58:00', '2017-01-02 06:58:00', '0000-00-00 00:00:00'),
(40, 7, 'Property Updated', 'mohalit tower', 91, '2017-01-02 06:59:42', '2017-01-02 06:59:42', '0000-00-00 00:00:00'),
(41, 7, 'Property Updated', 'mohalit tower', 91, '2017-01-02 07:00:44', '2017-01-02 07:00:44', '0000-00-00 00:00:00'),
(42, 32, 'Accepted', '3rd floor chairs', 91, '2017-01-02 07:04:00', '2017-01-02 07:04:00', '0000-00-00 00:00:00'),
(43, 30, 'Technician Assigned', '2nd floor webdroom', 91, '2017-01-02 07:04:08', '2017-01-02 07:04:08', '0000-00-00 00:00:00'),
(44, 29, 'Declined', '1st florre tiels', 91, '2017-01-02 07:04:15', '2017-01-02 07:04:15', '0000-00-00 00:00:00'),
(45, 30, 'Technician Assigned', '2nd floor webdroomm', 91, '2017-01-02 07:06:00', '2017-01-02 07:06:00', '0000-00-00 00:00:00'),
(46, 30, 'Task Deleted', '2nd floor webdroomm', 91, '2017-01-02 07:07:07', '2017-01-02 07:07:07', '0000-00-00 00:00:00'),
(47, 29, 'Task Deleted', '1st florre tiels', 91, '2017-01-02 07:07:24', '2017-01-02 07:07:24', '0000-00-00 00:00:00'),
(48, 28, 'Task Deleted', 'Base', 91, '2017-01-02 07:07:40', '2017-01-02 07:07:40', '0000-00-00 00:00:00'),
(49, 32, 'Technician Assigned', '3rd floor chairs', 91, '2017-01-02 07:08:27', '2017-01-02 07:08:27', '0000-00-00 00:00:00'),
(50, 32, 'Task Deleted', '3rd floor chairs', 91, '2017-01-02 07:09:13', '2017-01-02 07:09:13', '0000-00-00 00:00:00'),
(51, 9, 'Property Added', 'my village', 92, '2017-01-02 07:32:43', '2017-01-02 07:32:43', '0000-00-00 00:00:00'),
(52, 9, 'Property Updated', 'my village', 92, '2017-01-02 07:38:24', '2017-01-02 07:38:24', '0000-00-00 00:00:00'),
(53, 9, 'Property Updated', 'my village', 92, '2017-01-02 07:38:43', '2017-01-02 07:38:43', '0000-00-00 00:00:00'),
(54, 9, 'Property Updated', 'my village', 92, '2017-01-02 07:38:56', '2017-01-02 07:38:56', '0000-00-00 00:00:00'),
(55, 9, 'Property Updated', 'my village', 92, '2017-01-02 07:39:18', '2017-01-02 07:39:18', '0000-00-00 00:00:00'),
(56, 47, 'Technician Assigned', 'Sdifsofisdofiosdfiosdfiosdfiosdfasfsafaosipasipfas', 89, '2017-01-02 09:46:52', '2017-01-02 09:46:52', '0000-00-00 00:00:00'),
(57, 47, 'Technician Assigned', 'Sdifsofisdofiosdfiosdfiosdfiosdfasfsafaosipasipfas', 89, '2017-01-02 09:47:46', '2017-01-02 09:47:46', '0000-00-00 00:00:00'),
(58, 49, 'Technician Assigned', 'A new task is going to be created here please veri', 89, '2017-01-02 10:08:17', '2017-01-02 10:08:17', '0000-00-00 00:00:00'),
(59, 56, 'Accepted', 'Dining', 93, '2017-01-02 10:44:23', '2017-01-02 10:44:23', '0000-00-00 00:00:00'),
(60, 55, 'Declined', 'Kitchen tiles', 93, '2017-01-02 10:44:35', '2017-01-02 10:44:35', '0000-00-00 00:00:00'),
(61, 54, 'Technician Assigned', 'Wed new', 93, '2017-01-02 10:44:40', '2017-01-02 10:44:40', '0000-00-00 00:00:00'),
(62, 56, 'Accepted', 'Dining', 93, '2017-01-02 10:47:11', '2017-01-02 10:47:11', '0000-00-00 00:00:00'),
(63, 55, 'Task Deleted', 'Kitchen tiles', 93, '2017-01-02 10:47:52', '2017-01-02 10:47:52', '0000-00-00 00:00:00'),
(64, 53, 'Task Deleted', 'Bathroom tiles', 93, '2017-01-02 10:48:04', '2017-01-02 10:48:04', '0000-00-00 00:00:00'),
(65, 54, 'Task Deleted', 'Wed new', 93, '2017-01-02 10:48:40', '2017-01-02 10:48:40', '0000-00-00 00:00:00'),
(66, 56, 'Technician Assigned', 'Dining', 93, '2017-01-02 10:49:19', '2017-01-02 10:49:19', '0000-00-00 00:00:00'),
(67, 12, 'Property Added', 'info', 94, '2017-01-02 11:33:52', '2017-01-02 11:33:52', '0000-00-00 00:00:00'),
(68, 12, 'Property Updated', 'info', 94, '2017-01-02 11:34:06', '2017-01-02 11:34:06', '0000-00-00 00:00:00'),
(69, 12, 'Property Deleted', 'info', 94, '2017-01-02 11:38:42', '2017-01-02 11:38:42', '0000-00-00 00:00:00'),
(70, 13, 'Task Deleted', 'Dhdhd', 87, '2017-01-02 11:39:26', '2017-01-02 11:39:26', '0000-00-00 00:00:00'),
(71, 13, 'Property Added', 'dfgfdgfd', 94, '2017-01-02 11:42:09', '2017-01-02 11:42:09', '0000-00-00 00:00:00'),
(72, 60, 'Accepted', 'Patiala', 94, '2017-01-02 12:07:58', '2017-01-02 12:07:58', '0000-00-00 00:00:00'),
(73, 38, 'Task Deleted', 'One task', 89, '2017-01-02 12:08:04', '2017-01-02 12:08:04', '0000-00-00 00:00:00'),
(74, 44, 'Task Deleted', 'Hdhdh', 91, '2017-01-02 12:08:22', '2017-01-02 12:08:22', '0000-00-00 00:00:00'),
(75, 50, 'Task Deleted', 'Xbdhdh', 87, '2017-01-02 12:08:53', '2017-01-02 12:08:53', '0000-00-00 00:00:00'),
(76, 51, 'Task Deleted', 'Hdhdh', 87, '2017-01-02 12:09:03', '2017-01-02 12:09:03', '0000-00-00 00:00:00'),
(77, 52, 'Task Deleted', 'Cbcbdb', 87, '2017-01-02 12:09:13', '2017-01-02 12:09:13', '0000-00-00 00:00:00'),
(78, 62, 'Accepted', 'Mohali', 94, '2017-01-02 12:09:32', '2017-01-02 12:09:32', '0000-00-00 00:00:00'),
(79, 11, 'Task Deleted', 'Tap repair', 90, '2017-01-02 12:17:30', '2017-01-02 12:17:30', '0000-00-00 00:00:00'),
(80, 67, 'Accepted', 'Hh', 94, '2017-01-02 12:18:54', '2017-01-02 12:18:54', '0000-00-00 00:00:00'),
(81, 66, 'Technician Assigned', 'Jxjxj', 94, '2017-01-02 12:19:15', '2017-01-02 12:19:15', '0000-00-00 00:00:00'),
(82, 15, 'Property Added', 'Wollowbrook rd', 95, '2017-01-06 03:26:46', '2017-01-06 03:26:46', '0000-00-00 00:00:00'),
(83, 16, 'Property Added', 'Home', 97, '2017-01-06 10:01:26', '2017-01-06 10:01:26', '0000-00-00 00:00:00'),
(84, 76, 'Accepted', 'Rebuild front porch', 95, '2017-01-06 14:55:17', '2017-01-06 14:55:17', '0000-00-00 00:00:00'),
(85, 76, 'Technician Assigned', 'Rebuild front porch', 95, '2017-01-06 14:55:31', '2017-01-06 14:55:31', '0000-00-00 00:00:00'),
(86, 79, 'Accepted', 'Replace door knob', 95, '2017-01-06 15:39:38', '2017-01-06 15:39:38', '0000-00-00 00:00:00'),
(87, 82, 'Task Deleted', 'Blank task', 89, '2017-01-10 10:23:21', '2017-01-10 10:23:21', '0000-00-00 00:00:00'),
(88, 84, 'Task Deleted', 'Some data', 89, '2017-01-10 10:27:18', '2017-01-10 10:27:18', '0000-00-00 00:00:00'),
(89, 80, 'Technician Assigned', 'Fix shower', 95, '2017-01-11 11:28:18', '2017-01-11 11:28:18', '0000-00-00 00:00:00'),
(90, 96, 'Task Deleted', 'Sdfdsf', 89, '2017-01-17 09:48:37', '2017-01-17 09:48:37', '0000-00-00 00:00:00'),
(91, 95, 'Task Deleted', 'Sdfdsf', 89, '2017-01-17 09:48:47', '2017-01-17 09:48:47', '0000-00-00 00:00:00'),
(92, 94, 'Task Deleted', 'Sdfsdf', 89, '2017-01-17 09:48:56', '2017-01-17 09:48:56', '0000-00-00 00:00:00'),
(93, 93, 'Task Deleted', 'Mytasj', 89, '2017-01-17 09:49:08', '2017-01-17 09:49:08', '0000-00-00 00:00:00'),
(94, 92, 'Task Deleted', 'Dfdfsdf', 89, '2017-01-17 09:49:18', '2017-01-17 09:49:18', '0000-00-00 00:00:00'),
(95, 97, 'Task Deleted', 'New task', 89, '2017-01-17 09:52:26', '2017-01-17 09:52:26', '0000-00-00 00:00:00'),
(96, 19, 'Property Added', 'Villa1', 99, '2017-01-17 11:31:55', '2017-01-17 11:31:55', '0000-00-00 00:00:00'),
(97, 106, 'Technician Assigned', 'testing name qqqqq', 89, '2017-01-19 07:10:59', '2017-01-19 07:10:59', '0000-00-00 00:00:00'),
(98, 107, 'Technician Assigned', 'Cleaning Store', 89, '2017-01-19 07:11:21', '2017-01-19 07:11:21', '0000-00-00 00:00:00'),
(99, 136, 'Task Deleted', 'Fuhhh', 99, '2017-01-24 11:43:12', '2017-01-24 11:43:12', '0000-00-00 00:00:00'),
(100, 134, 'Task Deleted', 'Hshshs', 99, '2017-01-24 11:43:48', '2017-01-24 11:43:48', '0000-00-00 00:00:00'),
(101, 127, 'Task Deleted', 'New task', 89, '2017-01-25 05:56:59', '2017-01-25 05:56:59', '0000-00-00 00:00:00'),
(102, 140, 'Accepted', 'Cleaning', 89, '2017-01-25 06:04:18', '2017-01-25 06:04:18', '0000-00-00 00:00:00'),
(103, 143, 'Accepted', 'Clearing the floor', 89, '2017-01-25 07:14:29', '2017-01-25 07:14:29', '0000-00-00 00:00:00'),
(104, 21, 'Property Added', 'debut infotech', 100, '2017-01-27 04:39:53', '2017-01-27 04:39:53', '0000-00-00 00:00:00'),
(105, 145, 'Accepted', 'Kitchen repare', 100, '2017-01-27 04:56:53', '2017-01-27 04:56:53', '0000-00-00 00:00:00'),
(106, 147, 'Technician Assigned', 'Repare', 100, '2017-01-27 05:16:37', '2017-01-27 05:16:37', '0000-00-00 00:00:00'),
(107, 147, 'Technician Assigned', 'Repare', 100, '2017-01-27 05:17:21', '2017-01-27 05:17:21', '0000-00-00 00:00:00'),
(108, 148, 'Accepted', 'Wires', 100, '2017-01-27 05:29:33', '2017-01-27 05:29:33', '0000-00-00 00:00:00'),
(109, 148, 'Accepted', 'Wires', 100, '2017-01-27 05:40:52', '2017-01-27 05:40:52', '0000-00-00 00:00:00'),
(110, 148, 'Declined', 'Wires', 100, '2017-01-27 05:41:37', '2017-01-27 05:41:37', '0000-00-00 00:00:00'),
(111, 149, 'Accepted', 'Bathroom', 101, '2017-01-27 05:57:01', '2017-01-27 05:57:01', '0000-00-00 00:00:00'),
(112, 152, 'Technician Assigned', 'Wed', 101, '2017-01-27 05:57:59', '2017-01-27 05:57:59', '0000-00-00 00:00:00'),
(113, 24, 'Property Added', 'mohali property', 102, '2017-01-27 09:31:38', '2017-01-27 09:31:38', '0000-00-00 00:00:00'),
(114, 157, 'Accepted', 'Chchc', 102, '2017-01-27 09:34:32', '2017-01-27 09:34:32', '0000-00-00 00:00:00'),
(115, 157, 'Accepted', 'Chchc', 102, '2017-01-27 09:35:52', '2017-01-27 09:35:52', '0000-00-00 00:00:00'),
(116, 159, 'Accepted', 'Hchcc', 102, '2017-01-27 09:36:22', '2017-01-27 09:36:22', '0000-00-00 00:00:00'),
(117, 159, 'Declined', 'Hchcc', 102, '2017-01-27 09:36:37', '2017-01-27 09:36:37', '0000-00-00 00:00:00'),
(118, 16, 'Property Updated', 'Home', 97, '2017-02-08 00:00:39', '2017-02-08 00:00:39', '0000-00-00 00:00:00'),
(119, 16, 'Property Updated', 'Home', 97, '2017-02-08 00:07:40', '2017-02-08 00:07:40', '0000-00-00 00:00:00'),
(120, 173, 'Accepted', 'Paint siding', 103, '2017-02-17 17:42:37', '2017-02-17 17:42:37', '0000-00-00 00:00:00'),
(121, 173, 'Accepted', 'Paint siding', 103, '2017-02-17 17:42:51', '2017-02-17 17:42:51', '0000-00-00 00:00:00'),
(122, 173, 'Technician Assigned', 'Paint siding', 103, '2017-02-17 17:43:13', '2017-02-17 17:43:13', '0000-00-00 00:00:00'),
(123, 27, 'Property Added', 'The Great Estate', 104, '2017-02-21 06:56:45', '2017-02-21 06:56:45', '0000-00-00 00:00:00'),
(124, 183, 'Technician Assigned', 'Fix stairway', 105, '2017-02-21 08:23:00', '2017-02-21 08:23:00', '0000-00-00 00:00:00'),
(125, 182, 'Technician Assigned', 'Replace doorknobs', 105, '2017-02-21 09:17:20', '2017-02-21 09:17:20', '0000-00-00 00:00:00'),
(126, 15, 'Property Updated', 'Wollowbrook rd', 95, '2017-02-22 09:14:58', '2017-02-22 09:14:58', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE IF NOT EXISTS `pages` (
  `id` int(11) NOT NULL,
  `title` varchar(150) NOT NULL,
  `name` varchar(255) NOT NULL,
  `content` mediumtext NOT NULL,
  `image` varchar(125) NOT NULL,
  `link` varchar(125) NOT NULL,
  `meta_title` varchar(125) NOT NULL,
  `meta_description` mediumtext NOT NULL,
  `meta_tags` varchar(255) NOT NULL,
  `alias` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `status` int(11) NOT NULL COMMENT '0:Publiched, 1:Unpulished,2:delete'
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `title`, `name`, `content`, `image`, `link`, `meta_title`, `meta_description`, `meta_tags`, `alias`, `created_at`, `updated_at`, `status`) VALUES
(2, 'Privacy Policy', 'privacy policy', '<div id="lipsum">\r\n<p>\r\n<span style="color: rgb(255, 0, 0);"><span style="font-weight: bold;">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam non \r\nfelis justo. In faucibus nunc vitae leo&nbsp;</span></span><span style="color: rgb(255, 0, 0); font-weight: bold; line-height: 18.5714282989502px;">tincidunt tincidunt. Integer lorem tellus, iaculis at suscipit quis, fermentum non libero. Mauris eget cursus nulla. Sed lacinia dolor vel urna consectetur, quis efficitur orci finibus. Sed neque odio, tincidunt nec maximus ac, consequat quis enim. Nunc felis odio, faucibus sed arcu at, tristique lobortis augue. Pellentesque ut tortor et metus blandit elementum. Proin ac ultrices lectus, non bibendum libero. Aliquam varius nunc sit amet sagittis maximus. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Sed et efficitur dui. Sed eget ipsum viverra, maximus quam non, finibus neque.</span></p>\r\n<p>\r\nPellentesque id suscipit arcu. Donec volutpat porttitor pellentesque. \r\nPraesent euismod odio turpis, fringilla dapibus sem ultricies vel. Nunc \r\nnon mi pulvinar, aliquam lorem nec, maximus purus. Pellentesque elit \r\nmauris, tempus eu volutpat sit amet, condimentum non neque. Vestibulum \r\nmattis leo quis egestas imperdiet. Cras a neque at turpis blandit \r\ntristique eu sed mauris.\r\n</p>\r\n<p>\r\nMorbi congue ipsum ac enim rhoncus, id aliquet massa auctor. Donec \r\nvulputate turpis in ipsum scelerisque, ac viverra dolor ultricies. \r\nSuspendisse porttitor libero molestie odio tempor, non facilisis felis \r\nvarius. Mauris fermentum volutpat ipsum, vel ultricies massa dignissim \r\nin. Suspendisse tortor tellus, vestibulum sed justo a, varius malesuada \r\neros. Praesent scelerisque elit justo, sed scelerisque ante volutpat \r\nnon. Sed sed elit ut dui tempus feugiat. Ut luctus tellus sed maximus \r\niaculis. Pellentesque sed odio quis nibh congue blandit. Pellentesque \r\nornare mattis condimentum.\r\n</p>\r\n<p>\r\nNullam eleifend nulla molestie, egestas ligula hendrerit, tempor purus. \r\nInteger efficitur lorem nec dolor aliquet, et facilisis libero \r\ntincidunt. Duis mi arcu, aliquam vel arcu vitae, mattis auctor nisi. \r\nMaecenas eu neque sem. Etiam luctus, sem non molestie finibus, ligula \r\nsapien congue ante, eget laoreet ipsum ex nec enim. Suspendisse \r\ndignissim risus convallis justo feugiat, non dictum elit suscipit. \r\nCurabitur eu molestie odio. Cum sociis natoque penatibus et magnis dis \r\nparturient montes, nascetur ridiculus mus. Etiam imperdiet finibus \r\naccumsan. Nam est risus, molestie quis arcu nec, posuere maximus diam. \r\nVestibulum aliquam congue ipsum, nec ornare est blandit a. Morbi nibh \r\nnisl, placerat vitae tempus eu, euismod sit amet felis.\r\n</p>\r\n<p>\r\nVestibulum ligula ipsum, scelerisque ac elit vitae, faucibus pulvinar \r\nnisi. Phasellus volutpat ante sit amet ex suscipit, eget volutpat nibh \r\ncondimentum. Donec euismod orci vitae leo porta auctor. Phasellus in \r\nenim molestie, ornare risus vel, ultrices ante. Donec egestas dolor \r\nturpis, tristique gravida mi pulvinar at. Sed elementum mattis magna in \r\nvulputate. Nulla lorem eros, consectetur viverra sapien at, sollicitudin\r\n varius elit.\r\n</p></div>', '', '', 'PrivacyPolicy', 'Privacy PolicyPrivacy PolicyPrivacy PolicyPrivacy PolicyPrivacy PolicyPrivacy PolicyPrivacy Policy', 'Privacy Policy', '', '2016-03-23 06:52:28', '2017-01-31 06:39:06', 1),
(4, 'About Us — Our Team', 'About Us', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim.<br><br>Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus.<br>', '', '', 'aboutus', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa.', 'aboutus', 'aboutus', '2016-07-19 06:18:02', '2016-07-19 06:24:18', 1),
(5, 'License', 'License', '&nbsp; Lorem ipsum text&nbsp; Lorem ipsum text&nbsp; Lorem ipsum text&nbsp; Lorem ipsum \r\ntext&nbsp; Lorem ipsum text&nbsp; Lorem ipsum text&nbsp; Lorem ipsum text&nbsp; Lorem ipsum \r\ntext&nbsp; Lorem ipsum text&nbsp; Lorem ipsum text&nbsp; Lorem ipsum text&nbsp; Lorem ipsum \r\ntext&nbsp; Lorem ipsum text&nbsp; Lorem ipsum text&nbsp; Lorem ipsum text&nbsp; Lorem ipsum \r\ntext&nbsp; Lorem ipsum text&nbsp; Lorem ipsum text&nbsp; Lorem ipsum text&nbsp; Lorem ipsum \r\ntext&nbsp; Lorem ipsum text&nbsp; Lorem ipsum text&nbsp; Lorem ipsum text&nbsp; Lorem ipsum \r\ntext&nbsp; Lorem ipsum text&nbsp; Lorem ipsum text&nbsp; Lorem ipsum text&nbsp; Lorem ipsum \r\ntext&nbsp; Lorem ipsum text&nbsp; Lorem ipsum text&nbsp; Lorem ipsum text&nbsp; Lorem ipsum \r\ntext&nbsp; Lorem ipsum text&nbsp; Lorem ipsum text&nbsp; Lorem ipsum text&nbsp; Lorem ipsum \r\ntext&nbsp; Lorem ipsum text&nbsp; Lorem ipsum text&nbsp; Lorem ipsum text&nbsp; Lorem ipsum \r\ntext&nbsp; Lorem ipsum text&nbsp; Lorem ipsum text&nbsp; Lorem ipsum text&nbsp; Lorem ipsum \r\ntext&nbsp; Lorem ipsum text&nbsp; Lorem ipsum text&nbsp; Lorem ipsum text&nbsp; Lorem ipsum \r\ntext&nbsp; Lorem ipsum text&nbsp; Lorem ipsum text&nbsp; Lorem ipsum text&nbsp; Lorem ipsum \r\ntext&nbsp; Lorem ipsum text&nbsp; Lorem ipsum text&nbsp; Lorem ipsum text&nbsp; Lorem ipsum \r\ntext&nbsp; Lorem ipsum text&nbsp; Lorem ipsum text&nbsp; Lorem ipsum text&nbsp; Lorem ipsum \r\ntext&nbsp; Lorem ipsum text&nbsp; Lorem ipsum text&nbsp; Lorem ipsum text&nbsp; Lorem ipsum \r\ntext&nbsp; Lorem ipsum text&nbsp; Lorem ipsum text&nbsp; Lorem ipsum text&nbsp; Lorem ipsum \r\ntext&nbsp; Lorem ipsum text&nbsp; Lorem ipsum text&nbsp; Lorem ipsum text&nbsp; Lorem ipsum \r\ntext&nbsp; Lorem ipsum text&nbsp; Lorem ipsum text&nbsp; Lorem ipsum text&nbsp; Lorem ipsum \r\ntext&nbsp; Lorem ipsum text&nbsp; Lorem ipsum text&nbsp; Lorem ipsum text&nbsp; Lorem ipsum \r\ntext&nbsp; Lorem ipsum text&nbsp; Lorem ipsum text&nbsp; Lorem ipsum text&nbsp; Lorem ipsum \r\ntext&nbsp; Lorem ipsum text&nbsp; Lorem ipsum text&nbsp; Lorem ipsum text&nbsp; Lorem ipsum \r\ntext&nbsp; Lorem ipsum text&nbsp; Lorem ipsum text&nbsp; Lorem ipsum text&nbsp; Lorem ipsum \r\ntext&nbsp; Lorem ipsum text&nbsp; Lorem ipsum text&nbsp; Lorem ipsum text&nbsp; Lorem ipsum \r\ntext&nbsp; Lorem ipsum text&nbsp; Lorem ipsum text&nbsp; Lorem ipsum text&nbsp; Lorem ipsum \r\ntext&nbsp; Lorem ipsum text&nbsp; Lorem ipsum text&nbsp; Lorem ipsum text&nbsp; Lorem ipsum \r\ntext&nbsp; Lorem ipsum text&nbsp; Lorem ipsum text&nbsp; Lorem ipsum text&nbsp; Lorem ipsum \r\ntext&nbsp; Lorem ipsum text&nbsp; Lorem ipsum text&nbsp; Lorem ipsum text&nbsp; Lorem ipsum \r\ntext&nbsp; Lorem ipsum text&nbsp; Lorem ipsum text&nbsp; Lorem ipsum text&nbsp; Lorem ipsum \r\ntext&nbsp; Lorem ipsum text&nbsp; Lorem ipsum text&nbsp; Lorem ipsum text&nbsp; Lorem ipsum \r\ntext&nbsp; Lorem ipsum text&nbsp; Lorem ipsum text&nbsp; Lorem ipsum text&nbsp; Lorem ipsum \r\ntext&nbsp; Lorem ipsum text&nbsp; Lorem ipsum text&nbsp; Lorem ipsum text&nbsp; Lorem ipsum \r\ntext&nbsp; Lorem ipsum text&nbsp; Lorem ipsum text&nbsp; Lorem ipsum text&nbsp; Lorem ipsum \r\ntext&nbsp; Lorem ipsum text&nbsp; Lorem ipsum text&nbsp; Lorem ipsum text&nbsp; Lorem ipsum \r\ntext&nbsp; Lorem ipsum text&nbsp; Lorem ipsum text ', '', '', 'Lorem ipsum text', 'Lorem ipsum text', 'Lorem ipsum text', '', '2016-12-07 04:11:45', '2016-12-07 04:13:21', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('gohusky@debutinfotech.com', 'bb1abc67c8639641d33eb8d8f99ccf15b69b0bd9f0af17c711ab7739c7958519', '2016-03-28 05:22:09'),
('aarti@debutinfotech.com', '34cec0e7236d09cd202710c2d1f09799eb8ab2d84ec4665f0f8b28b495bee818', '2016-03-31 02:14:13'),
('lovepreet.singh@debutinfotech.com', '124343d6047f6ba55f53c7185a3d779f8c7a1ef3121b5497169826c497c765c9', '2016-03-31 02:20:06'),
('aarti.debut@gmail.com', 'ca4feb2cad913400e4e4928814f81e67d2d843406ecd83e262dc544f7af6920d', '2016-04-12 05:09:07'),
('kairon.love87@gmail.com', '1569cd25aea726d64ea2ecfa96a365f3dbb9ceeedf4d9796f78f1326b067c517', '2016-04-22 07:02:16'),
('proactive@gmail.com', 'b5b46f6ccd84b5f53318e85274a3f15e1c46917b77836894296bec6defd98144', '2016-07-18 04:24:48'),
('mukul.gupta@debutinfotech.com', '4b3d13414f7616f6ec3d894cab18b5894695e9cfe17e55b181b9dc07d59cc0bd', '2016-08-24 00:39:58'),
('dhiraj.kumar@debutinfotech.com', '2f75eb74767fe0d47d3d71746fc490bcd0626d197f829bde26415c54f9f068bc', '2016-12-19 02:26:36');

-- --------------------------------------------------------

--
-- Table structure for table `properties`
--

CREATE TABLE IF NOT EXISTS `properties` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `property_name` varchar(255) NOT NULL,
  `property_address` varchar(255) NOT NULL,
  `latitude` varchar(255) NOT NULL,
  `longitude` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `zipcode` int(20) DEFAULT NULL,
  `status` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `properties`
--

INSERT INTO `properties` (`id`, `user_id`, `property_name`, `property_address`, `latitude`, `longitude`, `city`, `state`, `zipcode`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(4, 90, 'jagraj house', 'Rajpura, Punjab, India', '30.484', '76.5939', '', '', NULL, 1, '2017-01-02 06:10:50', '2017-01-02 06:10:50', '0000-00-00 00:00:00'),
(5, 87, 'debut', 'Mohali Bypass, Industrial Area, Sahibzada Ajit Singh Nagar, Punjab, India', '30.7136', '76.7104', '', '', NULL, 1, '2017-01-02 06:36:44', '2017-01-02 06:36:44', '0000-00-00 00:00:00'),
(7, 91, 'mohalit tower', '8b, Mohali Stadium Road, Sector 60, Sahibzada Ajit Singh Nagar, Punjab, India', '30.692632', '76.734287', 'Chandigarh', 'Punjab', 160062, 1, '2017-01-02 06:53:12', '2017-01-02 06:53:12', '0000-00-00 00:00:00'),
(9, 92, 'my village', 'Dallas, TX, United States', '32.7766642', '-96.79698789999998', 'Dallas County', 'Texas', 0, 1, '2017-01-02 07:32:43', '2017-01-02 07:32:43', '0000-00-00 00:00:00'),
(11, 93, 'mohali', '8b, Mohali Bypass, Industrial Area, Sahibzada Ajit Singh Nagar, Punjab, India', '30.7136', '76.7104', '', '', NULL, 1, '2017-01-02 10:32:26', '2017-01-02 10:32:26', '0000-00-00 00:00:00'),
(13, 94, 'dfgfdgfd', 'Gvarv, Norway', '59.38787550000001', '9.170028300000013', 'Sauherad', 'Telemark', 0, 1, '2017-01-02 11:42:09', '2017-01-02 11:42:09', '0000-00-00 00:00:00'),
(15, 95, 'Wollowbrook rd', '52 Willowbrook Road, South Beloit, IL, United States', '42.4802987', '-89.00010729999997', '', 'Illinois', 61080, 1, '2017-01-06 03:26:44', '2017-01-06 03:26:44', '0000-00-00 00:00:00'),
(16, 97, 'Home', '322 Fulton Street, West Chicago, IL, United States', '41.88340700000001', '-88.20059500000002', 'DuPage County', 'Illinois', 60185, 1, '2017-01-06 10:01:24', '2017-01-06 10:01:24', '0000-00-00 00:00:00'),
(17, 98, 'clayton', '38 Union Circle, Wheaton, IL, United States', '41.8668', '-88.1165', '', '', NULL, 1, '2017-01-11 12:16:42', '2017-01-11 12:16:42', '0000-00-00 00:00:00'),
(18, 98, 'house by sea', 'Avenida Corrientes 1111, Buenos Aires, Autonomous City of Buenos Aires, Argentina', '-34.6036', '-58.3825', '', '', NULL, 1, '2017-01-11 12:18:01', '2017-01-11 12:18:01', '0000-00-00 00:00:00'),
(19, 99, 'Villa1', 'Mohali, Punjab, India', '30.7046486', '76.71787259999996', 'Sahibzada Ajit Singh Nagar', 'Punjab', 0, 1, '2017-01-17 11:31:54', '2017-01-17 11:31:54', '0000-00-00 00:00:00'),
(20, 89, 'Villa', 'Indiana, United States', '40.2672', '-86.1349', '', '', NULL, 1, '2017-01-25 05:47:06', '2017-01-25 05:47:06', '0000-00-00 00:00:00'),
(21, 100, 'debut infotech', 'Mohali Bypass, Industrial Area, Sahibzada Ajit Singh Nagar, Punjab, India', '30.71359289999999', '76.71044180000001', 'Sahibzada Ajit Singh Nagar', 'Punjab', 140308, 1, '2017-01-27 04:39:49', '2017-01-27 04:39:49', '0000-00-00 00:00:00'),
(22, 101, 'ino 1', 'Patiala, Punjab, India', '30.3398', '76.3869', '', '', NULL, 1, '2017-01-27 05:48:16', '2017-01-27 05:48:16', '0000-00-00 00:00:00'),
(23, 101, 'info 2', 'Mohali, Punjab, India', '30.7046', '76.7179', '', '', NULL, 1, '2017-01-27 05:54:18', '2017-01-27 05:54:18', '0000-00-00 00:00:00'),
(24, 102, 'mohali property', 'Sector 70, Sahibzada Ajit Singh Nagar, Punjab, India', '30.6978446', '76.71777900000006', 'Sahibzada Ajit Singh Nagar', 'Punjab', 0, 1, '2017-01-27 09:31:38', '2017-01-27 09:31:38', '0000-00-00 00:00:00'),
(25, 103, 'barlar', '322 Fulton St, West Chicago, IL 60185, United States', '41.8834', '-88.2006', '', '', NULL, 1, '2017-02-16 22:34:21', '2017-02-16 22:34:21', '0000-00-00 00:00:00'),
(26, 103, 'clayton', '38 Union Circle, Wheaton, IL, United States', '41.8668', '-88.1165', '', '', NULL, 1, '2017-02-16 22:38:13', '2017-02-16 22:38:13', '0000-00-00 00:00:00'),
(27, 104, 'The Great Estate', '222 N Oak Park Ave, Oak Park, IL, United States', '41.89099700000001', '-87.79403400000001', 'Cook County', 'Illinois', 60302, 1, '2017-02-21 06:56:43', '2017-02-21 06:56:43', '0000-00-00 00:00:00'),
(28, 105, 'rockafeller summer home', '111 S Warren Ave, Columbus, OH, United States', '39.9527', '-83.0715', '', '', NULL, 1, '2017-02-21 07:26:04', '2017-02-21 07:26:04', '0000-00-00 00:00:00'),
(29, 106, 'abhijeet', 'XYZ Adviesburo, Picushof, Eindhoven, Netherlands', '51.4374', '5.49153', '', '', NULL, 1, '2017-02-22 09:07:54', '2017-02-22 09:07:54', '0000-00-00 00:00:00'),
(30, 96, 'debut', 'Mohali, Punjab, India', '0.0', '0.0', '', '', NULL, 1, '2017-03-01 04:29:32', '2017-03-01 12:01:12', '0000-00-00 00:00:00'),
(45, 95, 'dam', 'XYZ the Tavern, Detroit Avenue, Cleveland, OH, United States', '41.484', '-81.7298', '', '', NULL, 1, '2017-03-08 04:31:03', '2017-03-08 04:31:03', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `property_attributes`
--

CREATE TABLE IF NOT EXISTS `property_attributes` (
  `id` int(11) NOT NULL,
  `prop_id` int(11) NOT NULL,
  `attribute_name` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=147 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `property_attributes`
--

INSERT INTO `property_attributes` (`id`, `prop_id`, `attribute_name`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(8, 4, 'bedroom', 1, '2017-01-02 06:10:50', '2017-01-02 06:10:50', '0000-00-00 00:00:00'),
(9, 4, 'washroom', 1, '2017-01-02 06:10:50', '2017-01-02 06:10:50', '0000-00-00 00:00:00'),
(10, 4, 'kitchen', 1, '2017-01-02 06:10:50', '2017-01-02 06:10:50', '0000-00-00 00:00:00'),
(11, 5, 'bedroom', 1, '2017-01-02 06:36:44', '2017-01-02 06:36:44', '0000-00-00 00:00:00'),
(12, 5, 'bathroom', 1, '2017-01-02 06:36:45', '2017-01-02 06:36:45', '0000-00-00 00:00:00'),
(13, 5, 'kitchen', 1, '2017-01-02 06:36:45', '2017-01-02 06:36:45', '0000-00-00 00:00:00'),
(21, 7, '1st florr', 1, '2017-01-02 06:54:46', '2017-01-02 06:54:46', '0000-00-00 00:00:00'),
(24, 7, 'ground florr', 1, '2017-01-02 06:54:46', '2017-01-02 06:54:46', '0000-00-00 00:00:00'),
(27, 7, '2nd florr', 1, '2017-01-02 06:59:41', '2017-01-02 06:59:41', '0000-00-00 00:00:00'),
(28, 7, '4rd florr ', 1, '2017-01-02 06:59:41', '2017-01-02 06:59:41', '0000-00-00 00:00:00'),
(29, 7, '    5th florr', 1, '2017-01-02 06:59:41', '2017-01-02 06:59:41', '0000-00-00 00:00:00'),
(30, 7, '3rd florr', 1, '2017-01-02 06:59:41', '2017-01-02 06:59:41', '0000-00-00 00:00:00'),
(31, 9, 'attribute one', 1, '2017-01-02 07:32:43', '2017-01-02 07:32:43', '0000-00-00 00:00:00'),
(32, 9, 'attribute two', 1, '2017-01-02 07:32:43', '2017-01-02 07:32:43', '0000-00-00 00:00:00'),
(33, 9, 'attribute three', 1, '2017-01-02 07:32:43', '2017-01-02 07:32:43', '0000-00-00 00:00:00'),
(34, 9, 'attribute four', 1, '2017-01-02 07:32:43', '2017-01-02 07:32:43', '0000-00-00 00:00:00'),
(36, 9, 'attribute five', 1, '2017-01-02 07:39:18', '2017-01-02 07:39:18', '0000-00-00 00:00:00'),
(37, 9, 'attribute six', 1, '2017-01-02 07:39:18', '2017-01-02 07:39:18', '0000-00-00 00:00:00'),
(39, 11, 'bathroom', 1, '2017-01-02 10:32:26', '2017-01-02 10:32:26', '0000-00-00 00:00:00'),
(40, 11, 'bedroom', 1, '2017-01-02 10:32:26', '2017-01-02 10:32:26', '0000-00-00 00:00:00'),
(41, 11, 'kitchen', 1, '2017-01-02 10:32:26', '2017-01-02 10:32:26', '0000-00-00 00:00:00'),
(42, 11, 'dring room', 1, '2017-01-02 10:32:26', '2017-01-02 10:32:26', '0000-00-00 00:00:00'),
(49, 13, 'fghgfhgfhf', 1, '2017-01-02 11:42:09', '2017-01-02 11:42:09', '0000-00-00 00:00:00'),
(51, 15, 'Tall and gray', 1, '2017-01-06 03:26:44', '2017-01-06 03:26:44', '0000-00-00 00:00:00'),
(52, 16, 'Master bath', 1, '2017-01-06 10:01:24', '2017-01-06 10:03:43', '0000-00-00 00:00:00'),
(53, 17, 'bedroom', 1, '2017-01-11 12:16:42', '2017-01-11 12:16:42', '0000-00-00 00:00:00'),
(54, 18, 'bedroom', 1, '2017-01-11 12:18:02', '2017-01-11 12:18:02', '0000-00-00 00:00:00'),
(55, 18, 'kitchen', 1, '2017-01-11 12:18:02', '2017-01-11 12:18:02', '0000-00-00 00:00:00'),
(56, 19, 'kitchen', 1, '2017-01-17 11:31:54', '2017-01-17 11:31:54', '0000-00-00 00:00:00'),
(57, 19, 'hall', 1, '2017-01-17 11:31:54', '2017-01-17 11:31:54', '0000-00-00 00:00:00'),
(58, 19, 'washroom', 1, '2017-01-17 11:31:54', '2017-01-17 11:31:54', '0000-00-00 00:00:00'),
(59, 19, 'store', 1, '2017-01-17 11:31:54', '2017-01-17 11:31:54', '0000-00-00 00:00:00'),
(60, 20, 'Room', 1, '2017-01-25 05:47:06', '2017-01-25 05:47:06', '0000-00-00 00:00:00'),
(61, 21, 'kitchen', 1, '2017-01-27 04:39:49', '2017-01-27 04:39:49', '0000-00-00 00:00:00'),
(62, 21, 'bathroom', 1, '2017-01-27 04:39:49', '2017-01-27 04:39:49', '0000-00-00 00:00:00'),
(63, 21, 'wedroom', 1, '2017-01-27 04:39:49', '2017-01-27 04:39:49', '0000-00-00 00:00:00'),
(64, 21, 'dringroom', 1, '2017-01-27 04:39:49', '2017-01-27 04:39:49', '0000-00-00 00:00:00'),
(65, 22, 'kitchen', 1, '2017-01-27 05:48:17', '2017-01-27 05:48:17', '0000-00-00 00:00:00'),
(66, 22, 'wedroom', 1, '2017-01-27 05:48:17', '2017-01-27 05:48:17', '0000-00-00 00:00:00'),
(67, 22, 'bathroom', 1, '2017-01-27 05:48:17', '2017-01-27 05:48:17', '0000-00-00 00:00:00'),
(68, 22, 'dringroom', 1, '2017-01-27 05:48:17', '2017-01-27 05:48:17', '0000-00-00 00:00:00'),
(69, 23, 'bathroom', 1, '2017-01-27 05:54:18', '2017-01-27 05:54:18', '0000-00-00 00:00:00'),
(70, 23, 'kitchen', 1, '2017-01-27 05:54:18', '2017-01-27 05:54:18', '0000-00-00 00:00:00'),
(71, 24, 'bedroom', 1, '2017-01-27 09:31:38', '2017-01-27 09:31:38', '0000-00-00 00:00:00'),
(72, 24, 'kitchen', 1, '2017-01-27 09:31:38', '2017-01-27 09:31:38', '0000-00-00 00:00:00'),
(73, 24, 'bathroom', 1, '2017-01-27 09:31:38', '2017-01-27 09:31:38', '0000-00-00 00:00:00'),
(74, 24, 'dringroom', 1, '2017-01-27 09:31:38', '2017-01-27 09:31:38', '0000-00-00 00:00:00'),
(75, 16, 'Master bedroom', 1, '2017-02-08 00:00:36', '2017-02-08 00:00:36', '0000-00-00 00:00:00'),
(76, 16, 'Claire''s room', 1, '2017-02-08 00:07:37', '2017-02-08 00:07:37', '0000-00-00 00:00:00'),
(77, 16, 'Girls room', 1, '2017-02-08 00:07:37', '2017-02-08 00:07:37', '0000-00-00 00:00:00'),
(78, 16, 'Hall bath', 1, '2017-02-08 00:07:37', '2017-02-08 00:07:37', '0000-00-00 00:00:00'),
(79, 16, 'Guest bedroom ', 1, '2017-02-08 00:07:37', '2017-02-08 00:07:37', '0000-00-00 00:00:00'),
(80, 16, 'TV room', 1, '2017-02-08 00:07:37', '2017-02-08 00:07:37', '0000-00-00 00:00:00'),
(81, 16, '2nd floor hall', 1, '2017-02-08 00:07:37', '2017-02-08 00:07:37', '0000-00-00 00:00:00'),
(82, 16, 'Family room', 1, '2017-02-08 00:07:37', '2017-02-08 00:07:37', '0000-00-00 00:00:00'),
(83, 16, 'Kitchen', 1, '2017-02-08 00:07:37', '2017-02-08 00:07:37', '0000-00-00 00:00:00'),
(84, 25, 'front porch paint', 1, '2017-02-16 22:34:21', '2017-02-16 22:34:21', '0000-00-00 00:00:00'),
(85, 25, 'kitchen GFI outlet', 1, '2017-02-16 22:34:21', '2017-02-16 22:34:21', '0000-00-00 00:00:00'),
(86, 25, 'hand rail on back pirch', 1, '2017-02-16 22:34:21', '2017-02-16 22:34:21', '0000-00-00 00:00:00'),
(87, 25, 'front porch paint', 1, '2017-02-16 22:34:21', '2017-02-16 22:34:21', '0000-00-00 00:00:00'),
(88, 25, 'kitchen GFI outlet', 1, '2017-02-16 22:34:21', '2017-02-16 22:34:21', '0000-00-00 00:00:00'),
(89, 25, 'hand rail on back pirch', 1, '2017-02-16 22:34:21', '2017-02-16 22:34:21', '0000-00-00 00:00:00'),
(90, 26, 'bump out bay siding', 1, '2017-02-16 22:38:13', '2017-02-16 22:38:13', '0000-00-00 00:00:00'),
(91, 27, 'Great Room', 1, '2017-02-21 06:56:43', '2017-02-21 06:56:43', '0000-00-00 00:00:00'),
(92, 27, 'Kitchen', 1, '2017-02-21 06:56:43', '2017-02-21 06:56:43', '0000-00-00 00:00:00'),
(93, 27, 'Bathroom - 1st floor', 1, '2017-02-21 06:56:43', '2017-02-21 06:56:43', '0000-00-00 00:00:00'),
(94, 27, 'Bathroom - entry way', 1, '2017-02-21 06:56:43', '2017-02-21 06:56:43', '0000-00-00 00:00:00'),
(95, 27, 'Central Hall', 1, '2017-02-21 06:56:43', '2017-02-21 06:56:43', '0000-00-00 00:00:00'),
(96, 28, 'porch', 1, '2017-02-21 07:26:04', '2017-02-21 07:26:04', '0000-00-00 00:00:00'),
(97, 28, 'living room', 1, '2017-02-21 07:26:04', '2017-02-21 07:26:04', '0000-00-00 00:00:00'),
(98, 28, 'bathroom', 1, '2017-02-21 07:26:04', '2017-02-21 07:26:04', '0000-00-00 00:00:00'),
(99, 28, 'bedroom', 1, '2017-02-21 07:26:04', '2017-02-21 07:26:04', '0000-00-00 00:00:00'),
(100, 29, 'abcd', 1, '2017-02-22 09:07:54', '2017-02-22 09:07:54', '0000-00-00 00:00:00'),
(101, 29, 'abcd', 1, '2017-02-22 09:07:54', '2017-02-22 09:07:54', '0000-00-00 00:00:00'),
(102, 29, 'abcd', 1, '2017-02-22 09:07:54', '2017-02-22 09:07:54', '0000-00-00 00:00:00'),
(103, 29, 'aaa', 1, '2017-02-22 09:07:54', '2017-02-22 09:07:54', '0000-00-00 00:00:00'),
(104, 29, 'aghaha', 1, '2017-02-22 09:07:54', '2017-02-22 09:07:54', '0000-00-00 00:00:00'),
(105, 29, 'hJjsja', 1, '2017-02-22 09:07:54', '2017-02-22 09:07:54', '0000-00-00 00:00:00'),
(106, 29, 'hahaajjs', 1, '2017-02-22 09:07:54', '2017-02-22 09:07:54', '0000-00-00 00:00:00'),
(107, 29, 'hajsjsj', 1, '2017-02-22 09:07:54', '2017-02-22 09:07:54', '0000-00-00 00:00:00'),
(108, 29, 'hshsjdjsjsk', 1, '2017-02-22 09:07:54', '2017-02-22 09:07:54', '0000-00-00 00:00:00'),
(109, 29, 'hsbsjssj', 1, '2017-02-22 09:07:54', '2017-02-22 09:07:54', '0000-00-00 00:00:00'),
(110, 29, 'hsjsjdj', 1, '2017-02-22 09:07:54', '2017-02-22 09:07:54', '0000-00-00 00:00:00'),
(111, 29, 'hdjdjdjkd', 1, '2017-02-22 09:07:54', '2017-02-22 09:07:54', '0000-00-00 00:00:00'),
(112, 15, 'hsjsj', 1, '2017-02-22 09:14:53', '2017-02-22 09:14:53', '0000-00-00 00:00:00'),
(113, 15, 'slslslsl', 1, '2017-02-22 09:14:53', '2017-02-22 09:14:53', '0000-00-00 00:00:00'),
(114, 15, 'ksksksk', 1, '2017-02-22 09:14:53', '2017-02-22 09:14:53', '0000-00-00 00:00:00'),
(115, 15, 'kwkwkkw', 1, '2017-02-22 09:14:53', '2017-02-22 09:14:53', '0000-00-00 00:00:00'),
(116, 15, 'gsgsgs', 1, '2017-02-22 09:14:53', '2017-02-22 09:14:53', '0000-00-00 00:00:00'),
(117, 15, 'gsgsgs', 1, '2017-02-22 09:14:53', '2017-02-22 09:14:53', '0000-00-00 00:00:00'),
(118, 15, 'shshhs', 1, '2017-02-22 09:14:53', '2017-02-22 09:14:53', '0000-00-00 00:00:00'),
(119, 15, 'shshsh', 1, '2017-02-22 09:14:53', '2017-02-22 09:14:53', '0000-00-00 00:00:00'),
(120, 15, 'gshshs', 1, '2017-02-22 09:14:53', '2017-02-22 09:14:53', '0000-00-00 00:00:00'),
(121, 30, 'room', 1, '2017-03-01 04:29:32', '2017-03-01 04:29:32', '0000-00-00 00:00:00'),
(140, 30, 'Cabin', 1, '2017-03-01 13:31:35', '2017-03-01 13:31:35', '0000-00-00 00:00:00'),
(142, 30, 'hhhhhh', 1, '2017-03-01 13:58:55', '2017-03-01 13:58:55', '0000-00-00 00:00:00'),
(145, 45, 'gahshhshs', 1, '2017-03-08 04:31:04', '2017-03-08 04:31:04', '0000-00-00 00:00:00'),
(146, 45, 'gzbzhhshs', 1, '2017-03-08 04:31:04', '2017-03-08 04:31:04', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(11) NOT NULL,
  `sort_num` int(20) NOT NULL,
  `type` varchar(125) NOT NULL,
  `key` varchar(125) NOT NULL,
  `value` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `sort_num`, `type`, `key`, `value`, `created_at`, `updated_at`) VALUES
(1, 0, 'location', 'location', 'location one', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 0, 'location', 'location', 'location two', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 0, 'category', 'storage_sheds', 'Storage Sheds', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 0, 'category', 'playsets', 'Playsets', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 0, 'category', 'gazebos', 'Gazebos', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 0, 'category', 'other_products', 'Other Products', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 0, 'size', '', 'sizeone', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, 0, 'size', '', 'sizetwo', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(9, 0, 'address', 'Capitol Sheds Fredericksburg', '8813 Jefferson Davis Hwy, Fredericksburg, VA 22407, USA', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(10, 0, 'address', 'Capitol Sheds Ruckersville', '49 Lake Saponi Dr, Barboursville, Virginia 22923, United States', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(11, 0, 'interestedin', 'interestedin', 'sports', '0000-00-00 00:00:00', '2016-07-14 06:07:40'),
(12, 0, 'interestedin', 'interestedin', 'games', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(13, 0, 'address', 'Capitol Sheds Warrenton', '5280 Lee HighwayWarrenton, VA 20187', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(14, 0, 'address', 'Capitol Sheds Woodbridge', '15009 Jefferson Davis HighwayWoodbridge, VA 22192', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(15, 0, 'number', 'number', '888-828-9743', '0000-00-00 00:00:00', '2016-08-03 02:02:19'),
(16, 0, 'address_location', 'address_location', 'Lorem ipsum dolor amet, \r\nquis ante consectetuer.\r\nNullam quis ante.', '0000-00-00 00:00:00', '2016-08-04 00:27:52'),
(17, 0, 'total_visitor', 'total_visitor', '92312', '0000-00-00 00:00:00', '2016-10-17 06:10:22'),
(20, 0, 'interestedin', 'interestedin', 'gamess', '2016-07-14 06:20:33', '2016-07-14 06:20:33'),
(21, 0, 'text_quote', 'text_quote', 'Lorem ipsum dolor amet, \r\nquis ante consectetuer.\r\n Nullam quis ante. ', '0000-00-00 00:00:00', '2016-08-04 00:27:34'),
(22, 0, 'text_videos', 'text_videos', 'Vivamus elementum semper\r\nnisi. Aenean vulputate\r\neleifend tellus. ', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE IF NOT EXISTS `tasks` (
  `id` int(11) NOT NULL,
  `task_name` varchar(255) NOT NULL,
  `client_id` int(11) NOT NULL,
  `note_detail` text NOT NULL,
  `priority` int(11) NOT NULL,
  `document_id` int(11) NOT NULL,
  `technician_id` int(11) NOT NULL,
  `assigned_date` date NOT NULL,
  `scheduled_date` date NOT NULL,
  `start_datetime` datetime DEFAULT NULL,
  `end_datetime` datetime DEFAULT NULL,
  `task_completed_date` datetime NOT NULL,
  `rating` float NOT NULL,
  `comments` text NOT NULL,
  `property_id` int(11) NOT NULL,
  `attribute_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` datetime DEFAULT '0000-00-00 00:00:00',
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=194 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `task_name`, `client_id`, `note_detail`, `priority`, `document_id`, `technician_id`, `assigned_date`, `scheduled_date`, `start_datetime`, `end_datetime`, `task_completed_date`, `rating`, `comments`, `property_id`, `attribute_id`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(14, 'Sokme name', 89, 'Sdfsdfsdf', 3, 0, 0, '0000-00-00', '2017-01-02', '2017-01-02 06:43:00', '2017-01-02 06:45:00', '2017-01-02 06:39:11', 3, 'Some commecnts', 6, 14, 4, '2017-01-02 06:38:57', '2017-01-02 06:39:11', '0000-00-00 00:00:00'),
(17, 'Skldfjlsdfk', 89, 'Sdfdfs', 3, 0, 0, '0000-00-00', '2017-01-02', '2017-01-02 06:50:00', '2017-01-02 06:54:00', '2017-01-02 06:45:51', 3, 'Asd', 6, 14, 4, '2017-01-02 06:45:40', '2017-01-02 06:45:51', '0000-00-00 00:00:00'),
(18, 'Sadsad', 89, 'Sadsad', 3, 0, 0, '0000-00-00', '2017-01-02', '2017-01-02 06:50:00', '2017-01-02 06:53:00', '2017-01-02 06:48:18', 3, '', 6, 14, 4, '2017-01-02 06:46:02', '2017-01-02 06:48:18', '0000-00-00 00:00:00'),
(19, 'Asdasd', 89, 'Asdasdds', 3, 0, 0, '0000-00-00', '2017-01-02', '2017-01-02 06:52:00', '2017-01-02 06:54:00', '2017-01-02 06:50:00', 3, 'Tfyt', 6, 14, 4, '2017-01-02 06:48:30', '2017-01-02 06:50:00', '0000-00-00 00:00:00'),
(21, 'Task', 89, 'Kasdjkdsaj', 3, 0, 0, '0000-00-00', '2017-01-02', '2017-01-02 06:55:00', '2017-01-02 06:59:00', '2017-01-02 06:51:15', 3, '', 6, 14, 4, '2017-01-02 06:51:11', '2017-01-02 06:51:15', '0000-00-00 00:00:00'),
(26, 'My task', 89, 'These are the notes', 3, 0, 0, '0000-00-00', '2017-01-02', '2017-01-02 07:02:00', '2017-01-02 07:03:00', '2017-01-02 06:58:08', 3, '', 6, 14, 4, '2017-01-02 06:57:58', '2017-01-02 06:58:08', '0000-00-00 00:00:00'),
(27, 'Asdkdfsj', 89, 'Sdfsdf', 3, 0, 0, '0000-00-00', '2017-01-02', '2017-01-02 07:02:00', '2017-01-02 07:07:00', '2017-01-02 07:00:48', 2, 'Some rating', 6, 14, 4, '2017-01-02 06:58:29', '2017-01-02 07:00:48', '0000-00-00 00:00:00'),
(31, 'My taSK', 89, 'ASDDS', 3, 0, 0, '0000-00-00', '2017-01-02', '2017-01-02 07:07:00', '2017-01-02 07:10:00', '2017-01-02 07:23:09', 3, '', 6, 14, 4, '2017-01-02 07:03:16', '2017-01-02 07:23:09', '0000-00-00 00:00:00'),
(33, 'Hdhdhd', 91, 'Bdbdhdh', 1, 0, 0, '0000-00-00', '2017-01-02', '2017-01-02 07:16:00', '2017-01-02 12:16:00', '2017-01-02 07:12:42', 4, '', 7, 29, 4, '2017-01-02 07:12:03', '2017-01-02 07:12:42', '0000-00-00 00:00:00'),
(34, 'Hshshs', 91, 'Hahsh', 2, 0, 0, '0000-00-00', '2017-01-02', '2017-01-02 07:18:00', '2017-01-02 07:19:00', '2017-01-02 07:14:05', 3, '', 7, 30, 4, '2017-01-02 07:13:57', '2017-01-02 07:14:05', '0000-00-00 00:00:00'),
(35, 'My task', 89, 'Some morw notes goes here', 1, 0, 0, '0000-00-00', '2017-01-02', '2017-01-02 07:28:00', '2017-01-02 07:29:00', '2017-01-02 07:24:04', 3, '', 6, 14, 4, '2017-01-02 07:23:58', '2017-01-02 07:24:04', '0000-00-00 00:00:00'),
(39, 'New task', 89, 'This is one more task', 1, 0, 0, '0000-00-00', '2017-01-02', '2017-01-02 08:54:00', '2017-01-02 08:58:00', '2017-01-02 08:50:18', 3, 'Task comments', 6, 14, 4, '2017-01-02 08:50:06', '2017-01-02 08:50:18', '0000-00-00 00:00:00'),
(40, 'Fds', 89, 'Sdfdsf', 3, 0, 0, '0000-00-00', '2017-01-02', '2017-01-02 08:56:00', '2017-01-02 08:57:00', '2017-01-02 09:06:42', 3, '', 6, 14, 4, '2017-01-02 08:51:40', '2017-01-02 09:06:42', '0000-00-00 00:00:00'),
(41, 'Testing task', 91, 'Hello name', 2, 0, 0, '0000-00-00', '2017-01-15', '2017-01-15 09:02:00', '2017-01-15 09:11:00', '0000-00-00 00:00:00', 0, '', 7, 21, 1, '2017-01-02 08:59:30', '2017-01-02 09:03:52', '0000-00-00 00:00:00'),
(42, 'Hchc', 91, 'Ughggi', 2, 0, 0, '0000-00-00', '2017-01-03', '2017-01-03 09:04:00', '2017-01-03 09:29:00', '2017-01-02 09:00:08', 4, '', 7, 21, 4, '2017-01-02 08:59:57', '2017-01-02 09:00:08', '0000-00-00 00:00:00'),
(43, 'Chjcfh', 91, 'Chjcjc', 3, 0, 0, '0000-00-00', '2017-01-09', '2017-01-09 09:07:00', '2017-01-09 09:16:00', '2017-01-02 09:02:10', 2, '', 7, 21, 4, '2017-01-02 09:00:35', '2017-01-02 09:02:10', '0000-00-00 00:00:00'),
(45, 'Bdhdh', 91, 'Bdhdh', 1, 0, 0, '0000-00-00', '2017-01-02', '2017-01-02 10:07:00', '2017-01-02 13:07:00', '0000-00-00 00:00:00', 0, '', 7, 21, 1, '2017-01-02 09:03:40', '2017-01-02 09:03:40', '0000-00-00 00:00:00'),
(46, 'New data', 89, 'Asdds', 3, 0, 0, '0000-00-00', '2017-01-02', '2017-01-02 09:11:00', '2017-01-02 09:13:00', '2017-01-02 09:16:41', 4, '', 6, 14, 4, '2017-01-02 09:07:19', '2017-01-02 09:16:41', '0000-00-00 00:00:00'),
(57, 'Sdefsdf', 89, 'Sdffdssdf', 3, 0, 0, '0000-00-00', '2017-01-01', '2017-01-01 18:30:00', '2017-01-02 06:20:00', '2017-01-17 08:53:22', 4, '', 10, 38, 4, '2017-01-02 10:49:56', '2017-01-17 08:53:22', '0000-00-00 00:00:00'),
(58, 'Gfdgf', 89, 'Dfgdfg', 3, 0, 0, '0000-00-00', '2017-01-02', '2017-01-02 10:55:00', '2017-01-02 10:56:00', '2017-01-17 09:40:07', 3, '', 10, 38, 4, '2017-01-02 10:51:19', '2017-01-17 09:40:07', '0000-00-00 00:00:00'),
(59, 'Bdhdh', 93, 'Dhndh', 1, 0, 88, '2017-01-02', '2017-01-02', '2017-01-02 10:59:00', '2017-01-02 11:59:00', '0000-00-00 00:00:00', 0, '', 11, 42, 3, '2017-01-02 10:55:01', '2017-01-02 10:55:19', '0000-00-00 00:00:00'),
(60, 'Patiala', 94, 'Patiala', 1, 0, 0, '0000-00-00', '2017-01-02', '2017-01-02 11:57:00', '2017-01-02 12:57:00', '2017-01-02 12:15:36', 4, 'Vvv', 13, 49, 4, '2017-01-02 11:53:31', '2017-01-02 12:15:36', '0000-00-00 00:00:00'),
(61, 'Nabja', 94, 'Wed', 1, 0, 0, '0000-00-00', '2017-01-03', '2017-01-03 11:58:00', '2017-01-03 12:58:00', '2017-01-02 12:16:06', 4, 'Ggb', 13, 49, 4, '2017-01-02 11:53:49', '2017-01-02 12:16:06', '0000-00-00 00:00:00'),
(62, 'Mohali', 94, 'Moh', 2, 0, 0, '0000-00-00', '2017-01-04', '2017-01-04 11:59:00', '2017-01-04 12:59:00', '2017-01-02 12:15:26', 4, '', 13, 49, 4, '2017-01-02 11:55:13', '2017-01-02 12:15:26', '0000-00-00 00:00:00'),
(63, 'Vvv', 94, 'Fcvv', 1, 0, 0, '0000-00-00', '2017-01-02', '2017-01-02 12:20:00', '2017-01-02 13:20:00', '2017-01-02 12:16:30', 4, 'Vvvb', 13, 49, 4, '2017-01-02 12:16:23', '2017-01-02 12:16:30', '0000-00-00 00:00:00'),
(64, 'Gggg', 94, 'Cvvvv', 1, 0, 0, '0000-00-00', '2017-01-02', '2017-01-02 12:21:00', '2017-01-02 15:21:00', '2017-01-02 12:17:38', 4, 'Vvv', 13, 49, 4, '2017-01-02 12:17:23', '2017-01-02 12:17:38', '0000-00-00 00:00:00'),
(65, 'Kdjd', 94, 'Ndnd', 1, 0, 0, '0000-00-00', '2017-01-02', '2017-01-02 12:22:00', '2017-01-02 13:22:00', '2017-01-02 12:19:40', 4, 'Ndndnd', 13, 49, 4, '2017-01-02 12:17:58', '2017-01-02 12:19:40', '0000-00-00 00:00:00'),
(66, 'Jxjxj', 94, 'Nsndn', 1, 0, 88, '2017-01-02', '2017-01-02', '2017-01-02 13:22:00', '2017-01-02 17:22:00', '2017-01-02 12:19:32', 3, 'Dbbdn', 13, 49, 4, '2017-01-02 12:18:17', '2017-01-02 12:19:32', '0000-00-00 00:00:00'),
(67, 'Hh', 94, 'Nznzbz', 1, 0, 0, '0000-00-00', '2017-01-02', '2017-01-02 12:22:00', '2017-01-02 14:22:00', '2017-01-02 12:19:24', 4, 'Nxnxnd', 13, 49, 4, '2017-01-02 12:18:33', '2017-01-02 12:19:24', '0000-00-00 00:00:00'),
(68, 'Hdjd', 94, 'Hzhzb', 1, 0, 0, '0000-00-00', '2017-01-02', '2017-01-02 12:24:00', '2017-01-02 14:24:00', '2017-01-02 12:20:24', 4, 'Xbx', 13, 49, 4, '2017-01-02 12:19:58', '2017-01-02 12:20:24', '0000-00-00 00:00:00'),
(69, 'Dbbxbx', 94, 'Hahshs', 1, 0, 0, '0000-00-00', '2017-01-02', '2017-01-02 12:25:00', '2017-01-02 15:25:00', '2017-01-02 12:20:53', 4, 'Shshs', 13, 49, 4, '2017-01-02 12:20:45', '2017-01-02 12:20:53', '0000-00-00 00:00:00'),
(70, 'Jdjdjdj', 94, 'Hdhdh', 1, 0, 0, '0000-00-00', '2017-01-02', '2017-01-02 12:25:00', '2017-01-02 14:25:00', '2017-01-02 12:21:43', 4, 'Gvv', 13, 49, 4, '2017-01-02 12:21:12', '2017-01-02 12:21:43', '0000-00-00 00:00:00'),
(71, 'Ghh', 94, 'Ggg', 1, 0, 0, '0000-00-00', '2017-01-02', '2017-01-02 12:26:00', '2017-01-02 13:26:00', '2017-01-02 12:22:09', 4, 'Hh', 13, 49, 4, '2017-01-02 12:21:59', '2017-01-02 12:22:09', '0000-00-00 00:00:00'),
(72, 'Vvv', 94, 'Ggg', 1, 0, 0, '0000-00-00', '2017-01-02', '2017-01-02 12:26:00', '2017-01-02 13:26:00', '2017-01-02 12:23:26', 5, 'Vhh', 13, 49, 4, '2017-01-02 12:22:22', '2017-01-02 12:23:26', '0000-00-00 00:00:00'),
(73, 'Ggg', 94, 'Fggg', 1, 0, 0, '0000-00-00', '2017-01-02', '2017-01-02 12:28:00', '2017-01-02 14:28:00', '2017-01-02 12:24:12', 4, 'Bbb', 13, 49, 4, '2017-01-02 12:23:45', '2017-01-02 12:24:12', '0000-00-00 00:00:00'),
(74, 'Front door', 96, 'New door needs installation. It''s leaning in the hall.', 1, 0, 0, '0000-00-00', '2017-03-01', '2017-03-01 11:30:00', '2017-03-01 13:30:00', '0000-00-00 00:00:00', 0, '', 14, 50, 1, '2017-01-06 03:18:28', '2017-03-01 10:11:18', '0000-00-00 00:00:00'),
(75, 'Chimney repair', 96, 'There are bricks falling out of the chimney', 3, 0, 0, '0000-00-00', '2017-01-30', '2017-01-30 14:00:00', '2017-01-30 23:23:00', '0000-00-00 00:00:00', 0, '', 14, 50, 1, '2017-01-06 03:19:54', '2017-02-24 05:39:58', '0000-00-00 00:00:00'),
(76, 'Rebuild front porch', 95, 'I want a nicer porch. The current one I have is crumbling. The wood is rotten. There''s no good place to sit. It won''t support a swinging chair. It needs rebuilt.', 3, 0, 0, '2017-01-06', '2017-01-05', '2017-01-05 14:32:00', '2017-01-06 02:32:00', '0000-00-00 00:00:00', 0, '', 15, 51, 1, '2017-01-06 03:28:01', '2017-03-03 18:14:56', '0000-00-00 00:00:00'),
(77, 'Dfg', 89, 'Dfgdfg', 3, 0, 0, '0000-00-00', '2017-01-07', '2017-01-07 06:58:00', '2017-01-07 07:04:00', '2017-01-10 12:27:56', 2, '', 10, 38, 4, '2017-01-06 06:54:24', '2017-01-10 12:27:56', '0000-00-00 00:00:00'),
(78, 'Patch hole by tub', 97, '6"x6"', 2, 0, 0, '0000-00-00', '2017-01-06', '2017-01-06 20:00:00', '2017-01-06 22:00:00', '0000-00-00 00:00:00', 0, '', 16, 52, 1, '2017-01-06 10:12:37', '2017-01-06 10:12:37', '0000-00-00 00:00:00'),
(79, 'Replace door knob', 95, 'Quickly', 3, 0, 0, '0000-00-00', '2017-01-20', '2017-01-20 15:39:00', '2017-01-21 03:40:00', '0000-00-00 00:00:00', 0, '', 15, 51, 1, '2017-01-06 15:35:30', '2017-01-24 13:24:02', '0000-00-00 00:00:00'),
(80, 'Fix shower', 95, 'Shower head is clogged', 2, 0, 88, '2017-01-11', '2017-01-08', '2017-01-08 18:38:00', '2017-01-09 02:38:00', '2017-03-05 18:58:24', 5, 'Geydhehe', 15, 51, 4, '2017-01-06 18:23:02', '2017-03-05 18:58:24', '0000-00-00 00:00:00'),
(85, 'My task', 89, '', 1, 0, 0, '0000-00-00', '2017-01-10', '2017-01-10 18:30:00', '2017-01-10 19:00:00', '2017-01-17 09:37:21', 3, '', 10, 38, 4, '2017-01-10 10:30:53', '2017-01-17 09:37:21', '0000-00-00 00:00:00'),
(89, 'Hello', 95, 'Hahnajaha jajajaya gajajah gahabahahahshjsjsshjsjsjsjsjsjsjshsjsjshshsjssjhssh', 3, 0, 0, '0000-00-00', '2017-01-12', '2017-01-12 23:29:00', '2017-01-13 13:48:00', '2017-01-11 11:25:21', 2, '', 15, 51, 4, '2017-01-11 11:25:09', '2017-01-11 11:25:21', '0000-00-00 00:00:00'),
(90, 'Hole in wall', 98, '6x6+', 3, 0, 0, '0000-00-00', '2017-01-21', '2017-01-21 13:53:00', '2017-01-21 16:46:00', '0000-00-00 00:00:00', 0, '', 17, 53, 1, '2017-01-11 12:42:12', '2017-01-11 13:00:48', '0000-00-00 00:00:00'),
(91, 'Cleaning', 95, 'Urgent', 1, 0, 0, '0000-00-00', '2017-01-14', '2017-01-14 06:15:00', '2017-01-14 06:18:00', '0000-00-00 00:00:00', 0, '', 15, 51, 1, '2017-01-13 06:12:04', '2017-01-13 06:13:08', '0000-00-00 00:00:00'),
(98, 'My task', 89, 'Soem notes goes here', 1, 0, 0, '0000-00-00', '2017-01-17', '2017-01-17 09:58:00', '2017-01-17 10:10:00', '2017-01-17 10:08:59', 3, '', 10, 38, 4, '2017-01-17 09:53:22', '2017-01-17 10:08:59', '0000-00-00 00:00:00'),
(99, 'My task', 89, 'Soem notes goes here', 1, 0, 0, '0000-00-00', '2017-01-17', '2017-01-17 09:58:00', '2017-01-17 10:10:00', '2017-01-17 10:11:08', 3, '', 10, 38, 4, '2017-01-17 09:53:30', '2017-01-17 10:11:08', '0000-00-00 00:00:00'),
(100, 'Some gtask', 89, 'Asfasf', 3, 0, 0, '0000-00-00', '2017-01-17', '2017-01-17 09:58:00', '2017-01-17 10:20:00', '2017-01-17 10:11:27', 5, 'This isi some details about the completyed task', 10, 38, 4, '2017-01-17 09:53:47', '2017-01-17 10:11:27', '0000-00-00 00:00:00'),
(101, 'Hgh', 89, 'Ghmhmgm', 3, 0, 0, '0000-00-00', '2017-01-17', '2017-01-17 09:58:00', '2017-01-17 10:00:00', '2017-01-17 10:11:42', 5, 'Very good swervice', 10, 38, 4, '2017-01-17 09:54:01', '2017-01-17 10:11:42', '0000-00-00 00:00:00'),
(102, 'Fddsf', 89, 'Sdfsdf', 3, 0, 0, '0000-00-00', '2017-01-17', '2017-01-17 10:00:00', '2017-01-17 10:10:00', '2017-01-17 10:12:13', 1, 'Some rating i provided', 10, 38, 4, '2017-01-17 09:55:33', '2017-01-17 10:12:13', '0000-00-00 00:00:00'),
(103, 'Fddsf', 89, 'Sdfsdf', 3, 0, 0, '0000-00-00', '2017-01-17', '2017-01-17 10:00:00', '2017-01-17 10:10:00', '2017-01-17 10:08:47', 3, '', 10, 38, 4, '2017-01-17 09:55:35', '2017-01-17 10:08:47', '0000-00-00 00:00:00'),
(104, 'testing name sdfds', 89, '', 1, 0, 0, '0000-00-00', '2016-11-11', '2016-11-11 00:00:00', '2016-11-11 00:00:00', '0000-00-00 00:00:00', 0, '', 5, 72, 1, '2017-01-17 10:02:55', '2017-01-17 10:02:55', '0000-00-00 00:00:00'),
(105, 'testing name sdfds', 89, '', 1, 0, 0, '0000-00-00', '2016-11-11', '2016-11-11 00:00:00', '2016-11-11 00:00:00', '0000-00-00 00:00:00', 0, '', 5, 72, 1, '2017-01-17 10:04:05', '2017-01-17 10:04:05', '0000-00-00 00:00:00'),
(106, 'testing name qqqqq', 89, 'dsfsdfsd', 0, 0, 88, '2017-01-19', '2016-11-11', '2016-11-11 00:00:00', '2016-11-11 00:00:00', '0000-00-00 00:00:00', 0, '', 5, 72, 3, '2017-01-17 10:05:27', '2017-01-19 07:10:53', '0000-00-00 00:00:00'),
(108, 'Cleaning', 99, 'Some cleaning needs to done', 1, 0, 0, '0000-00-00', '2017-01-17', '2017-01-17 12:11:00', '2017-01-17 12:20:00', '2017-01-17 12:07:24', 5, 'Best work', 19, 56, 4, '2017-01-17 12:06:58', '2017-01-17 12:07:24', '0000-00-00 00:00:00'),
(109, 'Fug', 95, 'Fgh', 1, 0, 0, '0000-00-00', '2017-01-22', '2017-01-22 13:03:00', '2017-01-22 13:07:00', '2017-01-20 13:00:37', 4, 'Dff', 15, 51, 1, '2017-01-20 13:00:20', '2017-03-05 18:47:34', '0000-00-00 00:00:00'),
(116, 'Dry Cleaning', 99, 'It''s not urgent', 2, 0, 0, '0000-00-00', '2017-01-19', '2017-01-19 15:15:00', '2017-01-19 16:15:00', '2017-01-23 13:56:40', 4, '', 19, 56, 4, '2017-01-23 13:48:23', '2017-01-23 13:56:40', '0000-00-00 00:00:00'),
(118, 'Some Data', 99, 'Few notes are being added here', 3, 0, 0, '0000-00-00', '2017-04-21', '2017-04-21 15:15:00', '2017-04-21 16:15:00', '0000-00-00 00:00:00', 0, '', 19, 56, 1, '2017-01-24 04:25:00', '2017-01-24 10:39:34', '0000-00-00 00:00:00'),
(128, 'Latest task', 89, 'Some notes for rhis app goes here', 3, 0, 0, '0000-00-00', '2017-01-24', '2017-01-24 11:15:00', '2017-01-24 12:15:00', '2017-01-24 09:39:36', 5, 'Very nice job done !!', 10, 38, 4, '2017-01-24 09:39:01', '2017-01-24 09:39:36', '0000-00-00 00:00:00'),
(133, 'Cleaning', 89, 'Some notes', 3, 0, 0, '0000-00-00', '2017-01-24', '2017-01-24 15:15:00', '2017-01-24 16:15:00', '2017-01-24 13:20:55', 5, '', 10, 38, 4, '2017-01-24 10:35:24', '2017-01-24 13:20:55', '0000-00-00 00:00:00'),
(135, 'Ff', 99, '', 1, 0, 0, '0000-00-00', '2017-02-01', '2017-02-01 11:15:00', '2017-02-01 12:15:00', '0000-00-00 00:00:00', 0, '', 19, 56, 1, '2017-01-24 10:54:58', '2017-01-24 11:55:36', '0000-00-00 00:00:00'),
(138, 'Testing 24', 95, '', 3, 0, 0, '0000-00-00', '0000-00-00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 15, 51, 1, '2017-01-24 12:07:34', '2017-01-24 12:07:34', '0000-00-00 00:00:00'),
(139, 'Tdghh', 95, 'Cjcjcjccjcjcjjccjcjjccjcjcj Cjcjcjccjcjcjjccjcjjccjcjcj cjvkcjjcjccjc vvkckkcfjgk fikvckcjvkcjjcjccjc vvkckkcfjgk fikvck', 3, 0, 0, '0000-00-00', '2017-01-28', '2017-01-28 15:15:00', '2017-01-28 16:15:00', '0000-00-00 00:00:00', 0, '', 15, 51, 1, '2017-01-24 12:13:15', '2017-01-24 12:13:15', '0000-00-00 00:00:00'),
(140, 'Cleaning', 89, 'I am adding some notes here', 3, 0, 0, '0000-00-00', '2017-03-20', '2017-03-20 00:15:00', '2017-03-20 01:15:00', '0000-00-00 00:00:00', 0, '', 20, 60, 3, '2017-01-25 05:47:36', '2017-01-25 06:03:52', '0000-00-00 00:00:00'),
(146, 'Kitchen repare', 100, 'Thx please repare', 3, 0, 0, '0000-00-00', '2017-01-27', '2017-01-27 00:15:00', '2017-01-27 01:15:00', '0000-00-00 00:00:00', 0, '', 21, 61, 1, '2017-01-27 05:02:01', '2017-01-27 05:02:01', '0000-00-00 00:00:00'),
(147, 'Repare', 100, 'hello, this is for testing', 3, 0, 88, '2017-01-27', '1900-12-27', '1900-12-27 13:30:00', '1900-12-27 05:25:00', '2017-01-27 05:21:04', 5, 'Fgthd gfoutfj uyf jh', 21, 61, 4, '2017-01-27 05:04:01', '2017-01-27 05:21:04', '0000-00-00 00:00:00'),
(148, 'Wires', 100, 'Wires crash', 1, 0, 0, '0000-00-00', '2017-01-27', '2017-01-27 10:15:00', '2017-01-27 11:15:00', '2017-01-27 05:41:55', 3, 'Bbvj', 21, 61, 4, '2017-01-27 05:26:02', '2017-01-27 05:41:55', '0000-00-00 00:00:00'),
(149, 'Bathroom', 101, 'Hello', 3, 0, 0, '0000-00-00', '2017-01-27', '2017-01-27 00:15:00', '2017-01-27 01:15:00', '0000-00-00 00:00:00', 0, '', 23, 69, 3, '2017-01-27 05:54:54', '2017-01-27 05:56:59', '0000-00-00 00:00:00'),
(150, 'Kitchen', 101, 'Kitchen', 3, 0, 0, '0000-00-00', '2017-01-28', '2017-01-28 15:15:00', '2017-01-28 16:15:00', '0000-00-00 00:00:00', 0, '', 23, 70, 1, '2017-01-27 05:55:59', '2017-01-27 05:55:59', '0000-00-00 00:00:00'),
(151, 'Kitchen 1', 101, '1', 3, 0, 0, '0000-00-00', '2017-01-29', '2017-01-29 11:15:00', '2017-01-29 12:15:00', '0000-00-00 00:00:00', 0, '', 22, 65, 1, '2017-01-27 05:56:25', '2017-01-27 05:56:25', '0000-00-00 00:00:00'),
(152, 'Wed', 101, 'dft', 3, 0, 88, '2017-01-27', '1900-12-06', '1900-12-06 15:10:00', '1900-12-05 06:30:00', '0000-00-00 00:00:00', 0, '', 22, 66, 3, '2017-01-27 05:57:29', '2017-01-27 05:57:57', '0000-00-00 00:00:00'),
(153, 'New property', 99, 'Some notes', 3, 0, 0, '0000-00-00', '2017-01-18', '2017-01-18 10:15:00', '2017-01-18 11:15:00', '0000-00-00 00:00:00', 0, '', 19, 57, 1, '2017-01-27 06:18:23', '2017-01-27 06:18:23', '0000-00-00 00:00:00'),
(154, 'Task Prop', 99, '', 3, 0, 0, '0000-00-00', '0000-00-00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 19, 58, 1, '2017-01-27 06:18:43', '2017-01-27 06:18:43', '0000-00-00 00:00:00'),
(155, 'Task Store', 99, '', 3, 0, 0, '0000-00-00', '0000-00-00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 19, 59, 1, '2017-01-27 06:18:58', '2017-01-27 06:18:58', '0000-00-00 00:00:00'),
(156, 'Jvjv', 102, '', 3, 0, 0, '0000-00-00', '0000-00-00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 24, 74, 1, '2017-01-27 09:32:18', '2017-01-27 09:32:18', '0000-00-00 00:00:00'),
(157, 'Chchc', 102, '', 3, 0, 0, '0000-00-00', '2017-02-03', '2017-02-03 00:15:00', '2017-02-03 01:15:00', '0000-00-00 00:00:00', 0, '', 24, 71, 3, '2017-01-27 09:33:45', '2017-01-27 09:35:51', '0000-00-00 00:00:00'),
(158, 'Chchc', 102, '', 3, 0, 0, '0000-00-00', '0000-00-00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2017-01-27 09:34:04', 3, 'Ch c', 24, 71, 4, '2017-01-27 09:33:51', '2017-01-27 09:34:04', '0000-00-00 00:00:00'),
(159, 'Hchcc', 102, 'Hcch', 3, 0, 0, '0000-00-00', '2017-01-27', '2017-01-27 00:15:00', '2017-01-27 01:15:00', '0000-00-00 00:00:00', 0, '', 24, 73, 2, '2017-01-27 09:35:31', '2017-01-27 09:36:35', '0000-00-00 00:00:00'),
(160, 'Empty Task', 89, '', 3, 0, 0, '0000-00-00', '0000-00-00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 20, 60, 1, '2017-01-27 11:44:34', '2017-01-27 11:44:34', '0000-00-00 00:00:00'),
(161, 'Empty Task One', 89, '', 3, 0, 0, '0000-00-00', '0000-00-00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 20, 60, 1, '2017-01-27 11:44:47', '2017-01-27 11:44:47', '0000-00-00 00:00:00'),
(162, 'Faucet leaking', 97, '', 3, 0, 0, '0000-00-00', '2017-02-15', '2017-02-15 21:45:00', '2017-02-15 22:45:00', '0000-00-00 00:00:00', 0, '', 16, 52, 1, '2017-01-30 11:28:45', '2017-02-11 19:47:06', '0000-00-00 00:00:00'),
(163, 'New sink', 95, 'Hehdhkd', 3, 0, 0, '0000-00-00', '2017-03-18', '2017-03-18 00:15:00', '2017-03-18 01:15:00', '2017-03-08 04:31:57', 5, 'Bdjjdjdjd', 15, 51, 4, '2017-01-30 16:19:11', '2017-03-08 04:31:57', '0000-00-00 00:00:00'),
(164, 'Misc task', 95, '', 3, 0, 0, '0000-00-00', '0000-00-00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 15, 51, 1, '2017-01-30 19:08:21', '2017-03-06 09:34:59', '0000-00-00 00:00:00'),
(165, 'Paint crown', 97, '', 3, 0, 0, '0000-00-00', '2017-03-02', '2017-03-02 02:45:00', '2017-03-02 03:45:00', '0000-00-00 00:00:00', 0, '', 16, 75, 1, '2017-02-08 00:12:03', '2017-02-12 17:56:12', '0000-00-00 00:00:00'),
(166, 'Repair door latch', 97, '', 3, 0, 0, '0000-00-00', '2017-02-09', '2017-02-09 21:45:00', '2017-02-09 22:45:00', '0000-00-00 00:00:00', 0, '', 16, 76, 1, '2017-02-08 00:14:49', '2017-02-08 00:14:49', '0000-00-00 00:00:00'),
(167, 'Replace bulbs', 97, '40w candles', 3, 0, 0, '0000-00-00', '0000-00-00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 16, 77, 1, '2017-02-08 00:18:14', '2017-02-08 00:18:14', '0000-00-00 00:00:00'),
(168, 'Need trim over window', 97, '', 1, 0, 0, '0000-00-00', '0000-00-00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 16, 80, 1, '2017-02-08 00:19:19', '2017-02-08 00:19:19', '0000-00-00 00:00:00'),
(169, 'Repair grout', 97, '', 3, 0, 0, '0000-00-00', '0000-00-00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 16, 83, 1, '2017-02-08 00:21:38', '2017-02-08 00:21:38', '0000-00-00 00:00:00'),
(170, 'Touch up walls', 97, '', 3, 0, 0, '0000-00-00', '0000-00-00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 16, 82, 1, '2017-02-08 00:21:57', '2017-02-08 00:21:57', '0000-00-00 00:00:00'),
(171, 'Repair soffit ceiling', 97, 'Cracked & peeling paint', 3, 0, 0, '0000-00-00', '0000-00-00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 16, 79, 1, '2017-02-08 00:28:22', '2017-02-08 00:28:22', '0000-00-00 00:00:00'),
(172, 'Paint window sill', 97, '', 3, 0, 0, '0000-00-00', '0000-00-00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 16, 76, 1, '2017-02-08 12:37:32', '2017-02-08 12:37:32', '0000-00-00 00:00:00'),
(173, 'Paint siding', 103, 'Note examples', 1, 0, 88, '2017-02-17', '2017-03-18', '2017-03-18 22:00:00', '2017-03-19 00:00:00', '0000-00-00 00:00:00', 0, '', 26, 90, 3, '2017-02-16 22:54:12', '2017-02-17 17:43:13', '0000-00-00 00:00:00'),
(174, 'Back door latch', 103, '', 3, 0, 0, '0000-00-00', '2017-02-23', '2017-02-23 23:00:00', '2017-02-24 01:00:00', '0000-00-00 00:00:00', 0, '', 26, 90, 1, '2017-02-16 23:17:10', '2017-02-16 23:17:42', '0000-00-00 00:00:00'),
(175, 'Shower faucet', 103, '', 3, 0, 0, '0000-00-00', '0000-00-00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 26, 90, 1, '2017-02-16 23:19:15', '2017-02-16 23:19:15', '0000-00-00 00:00:00'),
(176, 'Kitchen sink', 103, '', 3, 0, 0, '0000-00-00', '0000-00-00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 26, 90, 1, '2017-02-16 23:20:34', '2017-02-16 23:20:34', '0000-00-00 00:00:00'),
(177, 'Broken window', 97, '', 3, 0, 0, '0000-00-00', '2017-02-28', '2017-02-28 21:45:00', '2017-02-28 22:45:00', '0000-00-00 00:00:00', 0, '', 16, 75, 1, '2017-02-21 00:09:29', '2017-02-21 00:09:29', '0000-00-00 00:00:00'),
(178, 'Clean floor', 104, 'Its dirty', 2, 0, 0, '0000-00-00', '2017-02-16', '2017-02-16 21:45:00', '2017-02-16 22:45:00', '0000-00-00 00:00:00', 0, '', 27, 91, 1, '2017-02-21 06:57:41', '2017-02-21 06:57:41', '0000-00-00 00:00:00'),
(179, 'Fix kitchen sink', 104, 'Not draining', 3, 0, 0, '0000-00-00', '2017-03-11', '2017-03-11 22:45:00', '2017-03-11 23:45:00', '0000-00-00 00:00:00', 0, '', 27, 92, 1, '2017-02-21 07:04:09', '2017-02-21 07:04:09', '0000-00-00 00:00:00'),
(180, 'Fix window', 105, 'Broken pane', 3, 0, 0, '0000-00-00', '2017-03-09', '2017-03-09 22:45:00', '2017-03-09 23:45:00', '0000-00-00 00:00:00', 0, '', 28, 99, 1, '2017-02-21 07:36:45', '2017-02-21 08:18:25', '0000-00-00 00:00:00'),
(181, 'Clean carpet', 105, 'Stains in the middle', 3, 0, 0, '0000-00-00', '2017-03-09', '2017-03-09 22:45:00', '2017-03-09 23:45:00', '0000-00-00 00:00:00', 0, '', 28, 99, 1, '2017-02-21 07:41:14', '2017-02-21 07:41:14', '0000-00-00 00:00:00'),
(182, 'Replace doorknobs', 105, 'Make sure they match in style', 3, 0, 88, '2017-02-21', '2017-03-09', '2017-03-09 21:45:00', '2017-03-09 22:45:00', '0000-00-00 00:00:00', 0, '', 28, 99, 3, '2017-02-21 08:15:00', '2017-02-21 09:17:19', '0000-00-00 00:00:00'),
(183, 'Fix stairway', 105, '3rd step', 3, 0, 0, '2017-02-21', '2017-04-08', '2017-04-08 01:45:00', '2017-04-08 02:45:00', '0000-00-00 00:00:00', 0, '', 28, 97, 1, '2017-02-21 08:21:41', '2017-02-23 13:12:56', '0000-00-00 00:00:00'),
(184, 'Abcd', 106, 'Hshshjs', 2, 0, 0, '0000-00-00', '2017-03-06', '2017-03-06 10:27:00', '2017-03-06 11:28:00', '0000-00-00 00:00:00', 0, '', 29, 100, 1, '2017-02-22 09:19:18', '2017-02-22 09:19:18', '0000-00-00 00:00:00'),
(185, 'Porch rail fix', 105, 'Notes notes', 3, 0, 0, '0000-00-00', '2017-03-12', '2017-03-12 02:45:00', '2017-03-12 03:45:00', '0000-00-00 00:00:00', 0, '', 28, 96, 1, '2017-02-23 13:08:22', '2017-02-23 13:08:22', '0000-00-00 00:00:00'),
(186, 'Broken door', 97, '', 3, 0, 0, '0000-00-00', '2017-03-10', '2017-03-10 23:00:00', '2017-03-11 01:00:00', '0000-00-00 00:00:00', 0, '', 16, 75, 1, '2017-02-25 00:14:07', '2017-02-25 01:27:13', '0000-00-00 00:00:00'),
(188, ',mf', 96, 'Dfdfg', 3, 0, 0, '0000-00-00', '2017-03-01', '2017-03-01 11:30:00', '2017-03-01 13:30:00', '0000-00-00 00:00:00', 0, '', 40, 134, 1, '2017-03-01 13:26:52', '2017-03-01 13:26:52', '0000-00-00 00:00:00'),
(189, 'Kjgkjhjk', 96, 'Kjhjkhjh', 3, 0, 0, '0000-00-00', '2017-03-16', '2017-03-16 11:30:00', '2017-03-16 13:30:00', '0000-00-00 00:00:00', 0, '', 30, 140, 1, '2017-03-01 13:49:35', '2017-03-02 09:53:16', '0000-00-00 00:00:00'),
(190, 'Jkhjkhjkh', 96, 'Kljkljklj', 2, 0, 0, '0000-00-00', '2017-03-08', '2017-03-08 11:30:00', '2017-03-08 13:30:00', '0000-00-00 00:00:00', 0, '', 30, 140, 1, '2017-03-01 13:59:29', '2017-03-01 13:59:29', '0000-00-00 00:00:00'),
(191, 'New task Update', 96, 'Asdasdasdsa this is on ;ldf ;lksdjf lksjgldf ldfkfjgld lkfjg l lkfjg lkjdfg ldkjfg ldkfjg ldkfjg ldkfjg ldkfg ldkfjgldf', 2, 0, 0, '0000-00-00', '2017-03-22', '2017-03-22 15:15:00', '2017-03-22 16:15:00', '0000-00-00 00:00:00', 0, '', 30, 142, 1, '2017-03-02 11:05:16', '2017-03-02 12:35:21', '0000-00-00 00:00:00'),
(192, 'Hari', 95, 'Bshshsj', 2, 0, 0, '0000-00-00', '2017-03-23', '2017-03-23 11:30:00', '2017-03-23 13:30:00', '0000-00-00 00:00:00', 0, '', 15, 51, 1, '2017-03-07 07:14:52', '2017-03-07 07:15:35', '0000-00-00 00:00:00'),
(193, 'Ghhj', 95, '', 3, 0, 0, '0000-00-00', '0000-00-00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, '', 15, 117, 1, '2017-03-08 04:28:18', '2017-03-08 04:28:18', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `timeslots`
--

CREATE TABLE IF NOT EXISTS `timeslots` (
  `id` int(11) NOT NULL,
  `from` time DEFAULT NULL,
  `to` time DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `timeslots`
--

INSERT INTO `timeslots` (`id`, `from`, `to`, `status`, `created_at`, `updated_at`) VALUES
(8, '16:45:00', '17:45:00', 1, '2017-01-18 12:02:15', '2017-01-18 12:02:15'),
(9, '15:45:00', '16:45:00', 1, '2017-01-18 12:02:32', '2017-01-18 12:02:32'),
(10, '20:45:00', '21:45:00', 1, '2017-01-18 12:02:49', '2017-01-18 12:02:49'),
(11, '05:45:00', '06:45:00', 1, '2017-01-18 12:03:21', '2017-01-30 08:55:08'),
(17, '17:00:00', '19:00:00', 1, '2017-01-30 11:10:52', '2017-01-30 11:10:52');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `first_name` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `company_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `email_verification_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `thumb_photo` varchar(225) COLLATE utf8_unicode_ci NOT NULL,
  `address` mediumtext COLLATE utf8_unicode_ci,
  `type` int(11) NOT NULL,
  `notify_type` int(11) NOT NULL,
  `domain` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `role` int(11) NOT NULL COMMENT '1:admin,2:user',
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `status` tinyint(1) NOT NULL COMMENT '0:Deactive, 1:Active,2:delete'
) ENGINE=InnoDB AUTO_INCREMENT=107 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `first_name`, `last_name`, `email`, `password`, `company_name`, `phone`, `email_verification_code`, `photo`, `thumb_photo`, `address`, `type`, `notify_type`, `domain`, `role`, `remember_token`, `created_at`, `updated_at`, `status`) VALUES
(1, 'frontline app testing', 'Frontline App', 'Admin ', 'jagraj.singh@debutinfotech.com', '$2y$10$qJho/LRMIwYzfDxH6GSjjO57P/0Esvc8J1wtt3q8147Mn6GN.ffQe', 'Debut Infotech Pvt Ltd.', '123456789034543', '', '322268-Sepik.jpg', '', '', 0, 0, '', 1, 'XfgrNeC818vWWBP2wo9F4pmR2im6mVMt1ngnXtNVvln4iaroOpuejVTUuZFL', '2016-03-18 11:41:20', '2017-03-10 00:29:58', 1),
(87, 'amninder singh rehal amninder singh rehal ', '', '', 'rehalamninder2@gmail.com', '$2y$10$N2X9uu/2De53m2yrVNt2oOn/wRcYTUvPUabxGmdVdmhUjnvPmODOq', '', '9592500522', '', 'uploads/clients/userfile_1483339843.jpeg', 'uploads/clients/thumb_1483339843.jpeg', 'patiala', 1, 0, '', 0, '93e40e9989b8e3b9a8b092fb24bdb2461dccc71d1cad362a34d42229e072bceb', '2017-01-01 23:28:33', '2017-01-27 09:26:54', 1),
(88, 'rajat', '', '', 'rejat.jain@debutinfotech.com', '', '', '54644546846464', '', 'uploads/technicians/1487353103_Screen Shot 2017-02-17 at 11.43.39 AM.png', '', 'mohali', 3, 0, 'rajat@debutinfotech.com', 0, NULL, '2017-01-01 23:50:54', '2017-02-17 12:08:24', 1),
(89, 'Dhiraj kumar', '', '', 'dhiraj.kumar@debutinfotech.com', '$2y$10$GP5ZGmboLdaFtz94xjurCeGkjsQz0Cq9mqrSU4YO5pkoNYfpHmljK', '', '1235458965', '', 'uploads/clients/userfile_1485364527.jpeg', 'uploads/clients/thumb_1485364527.jpeg', 'kdsfjkdf', 1, 0, '', 0, 'b336b841c4c7b3993865e7124029d181108af15271bf59e150478b8ef19311c2', '2017-01-02 00:15:54', '2017-02-24 04:49:06', 1),
(90, 'notificationtest', '', '', 'debutinfo4@gmail.com', '$2y$10$Dj2WlWES1x5AVy/Y0FtmDeBsG29tiu/KnTgjP3BQ2.MQeWa.ls3du', '', '78945412315', '', 'uploads/clients/userfile_1483337601.jpeg', 'uploads/clients/thumb_1483337601.jpeg', 'this is india', 1, 0, '', 0, 'a272a95672cb1fa92588b893770fcb227ac022389f71f316a55ef440c14acedf', '2017-01-02 00:38:50', '2017-01-02 06:54:51', 1),
(91, 'amninder singh', '', '', 'rehalamninder3@gmail.com', '$2y$10$6UobmirR2KW9Q8dZsUcUL.jtRQ8V6jJn1tEkjYsrhQp8.cjH7sowi', '', '3636534534654', '', 'uploads/clients/userfile_1483340999.jpeg', 'uploads/clients/thumb_1483340999.jpeg', 'mohali', 2, 0, '', 0, NULL, '2017-01-02 01:09:25', '2017-01-02 07:09:59', 1),
(92, 'propertyattributecheck', '', '', 'propattrcheck@gmaoil.com', '$2y$10$TaMFGTB/cP8k.nFOIXXvmehCO/769fOxwt4RGVXyUN4jvkNeEu8IC', '', '45234324324', '', '', '', 'property check address', 2, 0, '', 0, NULL, '2017-01-02 01:59:27', '2017-01-02 01:59:27', 1),
(93, 'rehal amninder rehal', '', '', 'rehalamninder4@gmail.com', '$2y$10$2r7z05NLqSJr3RmQalrLbeG14dBJp5XWQqpo8yYFXaD3pmgcIQqpm', '', '645465485', '', 'uploads/clients/userfile_1483353051.jpeg', 'uploads/clients/thumb_1483353051.jpeg', 'patiala', 1, 1, '', 0, NULL, '2017-01-02 04:59:56', '2017-01-02 10:59:05', 1),
(94, 'amninder singh', '', '', 'rehalamninder5@gmail.com', '$2y$10$d8Hskb/yAiRXO5FUQEgW1.wUSeC.Zyj7XRNoGsg9HzgUP6q5uBQza', '', '545454544', '', '', '', 'patiala', 2, 0, '', 0, NULL, '2017-01-02 06:02:56', '2017-01-02 12:10:08', 1),
(95, 'debut houseowner hsjsjsjsks', '', '', 'debutrajat@gmail.com', '$2y$10$a5QkjyDUikgSNPMSTY1uv.jFkl7Oill0ojz9zmcOPSTMwlCDcWu66', '', '9876543210', '', '', '', 'mohali', 3, 0, '', 0, NULL, '2017-01-04 22:22:30', '2017-03-07 07:18:30', 1),
(96, 'debut Realtor', '', '', 'debutrj91@gmail.com', '$2y$10$PQXdb19djOqWSbg0MKFUaO2HCNFE45m.xgMttAnbZe13mpjLsG.fq', '', '9876543201', '', '', '', 'mohali', 1, 0, '', 0, NULL, '2017-01-04 22:23:19', '2017-03-02 13:14:14', 1),
(97, 'Jon Barlar', '', '', 'Hammerman35@yahoo.com', '$2y$10$G2Hs3aj5umTAyEh4nb8BDeMSI7qRXM2AC7iGcYokcyNEr3tkq59rW', '', '6305202747', '', '', '', '322 Fulton\r\nWest CHICAGO,il', 2, 0, '', 0, NULL, '2017-01-05 02:32:19', '2017-01-05 02:32:19', 1),
(98, 'Realtor', '', '', 'singhthakurabhijeet@gmail.com', '$2y$10$StDGL/5LU80cWHbb8H/CgOewSGsoMG2Dyeebwf4yrT/ETKUmFLh.K', '', '1234567890', '', '', '', 'Testing realtor ', 1, 0, '', 0, NULL, '2017-01-11 06:37:17', '2017-01-11 13:02:41', 1),
(99, 'dhiraj', '', '', 'dhiraj.kumar@gmail.com', '$2y$10$LF1cV9su592ZjpMxHQBTmewWFeGaigjeMk18c4upQ26qvKZFv57N2', '', '1256325456', '', '', '', 'some address', 2, 0, '', 0, NULL, '2017-01-17 01:57:19', '2017-01-17 01:57:19', 1),
(100, 'rehal amninder singh', '', '', 'rehalamninder6@gmail.com', '$2y$10$b3BbV5VsiR5RZnLql75OsehTFW7GC/6PyqYQOvAKAggcCD6g1nZTC', '', '56565654654', '', 'uploads/clients/userfile_1485491843.jpeg', 'uploads/clients/thumb_1485491843.jpeg', 'patiala', 2, 0, '', 0, NULL, '2017-01-26 22:59:41', '2017-01-27 05:40:34', 1),
(101, 'amnindersingh rehal', '', '', 'rehalamninder7@gmail.com', '$2y$10$d9FsEgcJ/hO61Nt2oX70.Oj.suL44ZapXNQE59QRq7p9EJN6CMsJ2', '', '564664569468', '', 'uploads/clients/userfile_1485495974.jpeg', 'uploads/clients/thumb_1485495974.jpeg', 'mohali', 1, 0, '', 0, NULL, '2017-01-27 00:14:40', '2017-01-27 05:46:33', 1),
(102, 'amninder', '', '', 'rehalamninder8@gmail.com', '$2y$10$1hB2Wd/PNvtcPEwwbx1lBOM//MxTRnk.3cwcG8xLqFRyWwO1y/vZq', '', '5464647684', '', 'uploads/clients/userfile_1485509569.jpeg', 'uploads/clients/thumb_1485509569.jpeg', 'mohali', 2, 0, '', 0, NULL, '2017-01-27 04:00:48', '2017-01-27 09:32:49', 1),
(103, 'Jon Barlar', '', '', 'Sharnda1@yahoo.com', '$2y$10$cYhmKpuTvmUuF8lAVG6i2u41CMXbXMbkN2mprgGlc1h5NnPF.1w4.', '', '6305327820', '', '', '', '325 Fulton\r\nChicago, il', 1, 0, '', 0, NULL, '2017-02-16 16:57:58', '2017-02-16 16:57:58', 1),
(104, 'Magnus Hildur', '', '', 'mail@jginter.me', '$2y$10$LSHsms4oXGQlRpAGXNvnMuqIWXe9TR50wTbmblcm90as0opaK2kyq', '', '3122123355', '', '', '', '111 N. Hildur Ln.', 2, 0, '', 0, NULL, '2017-02-17 12:23:37', '2017-02-17 12:23:37', 1),
(105, 'j ginter', '', '', 'jginter@me.com', '$2y$10$KZrHQqaUVvwCbgXuiCNuEumGgqmJK3mb1LSkqclOUK3fG77ODnYHa', '', '7082970326', '', '', '', '111 N. Realtor Ln.', 1, 0, '', 0, NULL, '2017-02-21 01:53:10', '2017-02-21 01:53:10', 1),
(106, 'abhijeet singh', '', '', 'singhthakurabhijee@gmail.com', '$2y$10$5YG0cpj5gCODQiAGiOTo8.CkhtepwqLR31ScGkkaelUVErEJmS7/S', '', '9915180439', '', '', '', 'xyz lane ', 1, 0, '', 0, NULL, '2017-02-22 03:33:48', '2017-02-22 17:36:30', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_badges`
--

CREATE TABLE IF NOT EXISTS `user_badges` (
  `id` int(11) NOT NULL,
  `notification_count` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_notifications`
--
ALTER TABLE `admin_notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `crone_jobs`
--
ALTER TABLE `crone_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `devices`
--
ALTER TABLE `devices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email_templates`
--
ALTER TABLE `email_templates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email_template_attributes`
--
ALTER TABLE `email_template_attributes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `general_notes`
--
ALTER TABLE `general_notes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `note`
--
ALTER TABLE `note`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification_logs`
--
ALTER TABLE `notification_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `properties`
--
ALTER TABLE `properties`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `property_attributes`
--
ALTER TABLE `property_attributes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `timeslots`
--
ALTER TABLE `timeslots`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_badges`
--
ALTER TABLE `user_badges`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_notifications`
--
ALTER TABLE `admin_notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=181;
--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=44;
--
-- AUTO_INCREMENT for table `crone_jobs`
--
ALTER TABLE `crone_jobs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=372;
--
-- AUTO_INCREMENT for table `devices`
--
ALTER TABLE `devices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=819;
--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=72;
--
-- AUTO_INCREMENT for table `email_templates`
--
ALTER TABLE `email_templates`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=51;
--
-- AUTO_INCREMENT for table `email_template_attributes`
--
ALTER TABLE `email_template_attributes`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=134;
--
-- AUTO_INCREMENT for table `general_notes`
--
ALTER TABLE `general_notes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `note`
--
ALTER TABLE `note`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `notification_logs`
--
ALTER TABLE `notification_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=127;
--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `properties`
--
ALTER TABLE `properties`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=46;
--
-- AUTO_INCREMENT for table `property_attributes`
--
ALTER TABLE `property_attributes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=147;
--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=194;
--
-- AUTO_INCREMENT for table `timeslots`
--
ALTER TABLE `timeslots`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=107;
--
-- AUTO_INCREMENT for table `user_badges`
--
ALTER TABLE `user_badges`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
