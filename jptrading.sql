-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 10, 2018 at 08:49 PM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jptrading`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `type` int(11) NOT NULL,
  `description` text NOT NULL,
  `balance` decimal(10,2) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`id`, `branch_id`, `title`, `type`, `description`, `balance`, `status`, `ts`) VALUES
(1, 0, 'Cash in Hand', 0, '', '0.00', 1, '2018-05-30 12:44:59'),
(2, 0, 'Tariq', 0, '', '0.00', 1, '2018-08-10 14:27:45');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `admin_type_id` int(11) NOT NULL,
  `username` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `name` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `branch_id`, `admin_type_id`, `username`, `email`, `name`, `password`, `status`, `ts`) VALUES
(1, 0, 1, 'admin', 'vickyali2@hotmail.com', 'Admin', '21232f297a57a5a743894a0e4a801fc3', 1, '2018-09-03 18:24:24'),
(2, 2, 1, 'raheel', 'rahel@gmail.com', 'Raheel', '934f308503b20cea9cc39ffbfb50abe1', 1, '2018-09-03 16:30:39'),
(3, 1, 1, 'tariq', 'tariq@gmail.com', 'Tariq', '29336aba0bf285488b854e382d01add6', 1, '2018-09-03 18:26:25'),
(4, 1, 4, 'bilal', 'bilal@gmail.com', 'Bilal', '5ae1c881ad1d8d750f15c232a3232379', 1, '2018-09-05 17:44:12'),
(5, 0, 4, 'waqar', 'waqar@gmail.com', 'Waqar', 'ade740818d3bf4f31bb2de16dc413e37', 1, '2018-09-05 17:45:13');

-- --------------------------------------------------------

--
-- Table structure for table `admin_type`
--

CREATE TABLE `admin_type` (
  `id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `can_add` int(1) NOT NULL DEFAULT '0',
  `can_edit` int(1) NOT NULL DEFAULT '0',
  `can_delete` int(1) NOT NULL DEFAULT '0',
  `can_read` int(1) NOT NULL DEFAULT '0',
  `status` int(1) NOT NULL DEFAULT '1',
  `ts` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_type`
--

INSERT INTO `admin_type` (`id`, `title`, `can_add`, `can_edit`, `can_delete`, `can_read`, `status`, `ts`) VALUES
(1, 'Administrator', 1, 1, 1, 1, 1, '2017-02-27 12:10:38'),
(4, 'Manager', 1, 1, 1, 1, 1, '2018-02-25 12:32:50');

-- --------------------------------------------------------

--
-- Table structure for table `auction`
--

CREATE TABLE `auction` (
  `id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `auction`
--

INSERT INTO `auction` (`id`, `branch_id`, `title`, `status`, `ts`) VALUES
(3, 0, 'CAA Tokyo', 1, '2018-08-02 10:36:44'),
(4, 0, 'BCN', 1, '2018-08-02 10:36:49'),
(5, 0, 'Hero', 1, '2018-08-02 10:37:06');

-- --------------------------------------------------------

--
-- Table structure for table `body_type`
--

CREATE TABLE `body_type` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `sortorder` int(11) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `body_type`
--

INSERT INTO `body_type` (`id`, `title`, `sortorder`, `status`, `ts`) VALUES
(1, 'Bus', 1, 1, '2018-07-31 17:47:40'),
(2, 'Convertible', 2, 1, '2018-07-31 17:47:58'),
(3, 'Coupe', 3, 1, '2018-07-31 17:48:14');

-- --------------------------------------------------------

--
-- Table structure for table `branch`
--

CREATE TABLE `branch` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `branch`
--

INSERT INTO `branch` (`id`, `title`, `status`, `ts`) VALUES
(1, 'Inshatrading', 1, '2018-09-03 14:26:59'),
(2, 'Jp Trading', 1, '2018-09-03 16:15:48');

-- --------------------------------------------------------

--
-- Table structure for table `config_type`
--

CREATE TABLE `config_type` (
  `id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `sortorder` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `config_type`
--

INSERT INTO `config_type` (`id`, `branch_id`, `title`, `sortorder`) VALUES
(1, 0, 'General Settings', 1);

-- --------------------------------------------------------

--
-- Table structure for table `config_variable`
--

CREATE TABLE `config_variable` (
  `id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `config_type_id` int(11) NOT NULL,
  `title` varchar(512) NOT NULL,
  `notes` varchar(512) NOT NULL,
  `type` varchar(200) NOT NULL,
  `default_values` text NOT NULL,
  `key` varchar(200) NOT NULL,
  `value` text NOT NULL,
  `sortorder` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `config_variable`
--

INSERT INTO `config_variable` (`id`, `branch_id`, `config_type_id`, `title`, `notes`, `type`, `default_values`, `key`, `value`, `sortorder`) VALUES
(1, 1, 1, 'Site URL', '', 'text', '', 'site_url', 'http://127.0.0.1/jptrading', 2),
(2, 1, 1, 'Site Title', '', 'text', '', 'site_title', 'Insha Trading', 1),
(3, 1, 1, 'Admin Logo', '', 'file', '', 'admin_logo', '', 4),
(11, 1, 1, 'Thermal Printer Title', 'Enter the thermal printer installed on your pc. You can find it in your control panel settings', 'text', '', 'thermal_printer_title', '', 5),
(7, 1, 1, 'Admin Email', 'Main Email Address where all the notifications will be sent.', 'text', '', 'admin_email', '', 3),
(12, 1, 1, 'Thermal Printer Width', 'enter width in mm (e.g. 80)', 'text', '', 'thermal_printer_width', '', 5),
(22, 1, 1, 'Address Phone', '', 'textarea', '', 'address_phone', '', 6),
(23, 1, 1, 'Business Opening Hour', 'When shop/office is opened daily 1-24?', 'text', '', 'opening_hour', '', 6),
(32, 2, 1, 'Site URL', '', 'text', '', 'site_url', 'http://127.0.0.1/jptrading', 2),
(33, 2, 1, 'Site Title', '', 'text', '', 'site_title', 'JP Trading', 1),
(34, 2, 1, 'Admin Logo', '', 'file', '', 'admin_logo', '', 4),
(35, 2, 1, 'Thermal Printer Title', 'Enter the thermal printer installed on your pc. You can find it in your control panel settings', 'text', '', 'thermal_printer_title', '', 5),
(37, 2, 1, 'Admin Email', 'Main Email Address where all the notifications will be sent.', 'text', '', 'admin_email', '', 3),
(38, 2, 1, 'Thermal Printer Width', 'enter width in mm (e.g. 80)', 'text', '', 'thermal_printer_width', '', 5),
(41, 2, 1, 'Address Phone', '', 'textarea', '', 'address_phone', '', 6),
(42, 2, 1, 'Business Opening Hour', 'When shop/office is opened daily 1-24?', 'text', '', 'opening_hour', '', 6);

-- --------------------------------------------------------

--
-- Table structure for table `currency`
--

CREATE TABLE `currency` (
  `id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `symbol` varchar(50) NOT NULL,
  `default` int(1) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `currency`
--

INSERT INTO `currency` (`id`, `branch_id`, `title`, `symbol`, `default`, `status`, `ts`) VALUES
(1, 1, 'US Dollar', '$', 1, 1, '2018-09-03 18:19:23'),
(2, 2, 'Yen', '(Ã‚Â¥)', 1, 1, '2018-09-03 18:19:21');

-- --------------------------------------------------------

--
-- Table structure for table `equipment`
--

CREATE TABLE `equipment` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `sortorder` int(11) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `equipment`
--

INSERT INTO `equipment` (`id`, `title`, `sortorder`, `status`, `ts`) VALUES
(1, 'A/C', 1, 1, '2018-08-02 11:29:26'),
(2, 'ABS', 2, 1, '2018-08-02 11:29:46'),
(3, 'Power Steering', 3, 1, '2018-08-02 11:29:57'),
(4, 'Power Windows', 4, 1, '2018-08-02 11:30:08'),
(5, 'Power Mirrors', 5, 1, '2018-08-02 11:30:19'),
(6, 'Driver Airbag', 6, 1, '2018-08-02 11:30:29');

-- --------------------------------------------------------

--
-- Table structure for table `expense`
--

CREATE TABLE `expense` (
  `id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `datetime_added` datetime NOT NULL,
  `expense_category_id` varchar(100) NOT NULL,
  `account_id` int(11) NOT NULL,
  `details` varchar(1000) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `currency_id` int(11) NOT NULL,
  `added_by` int(11) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `expense`
--

INSERT INTO `expense` (`id`, `branch_id`, `datetime_added`, `expense_category_id`, `account_id`, `details`, `amount`, `currency_id`, `added_by`, `status`, `ts`) VALUES
(5, 2, '2018-09-05 23:28:00', '1', 1, 'gjgh', '200.00', 1, 1, 1, '2018-09-05 18:28:47'),
(6, 1, '2018-09-06 19:06:00', '1', 1, '', '2000.00', 2, 1, 1, '2018-09-06 14:07:55'),
(7, 2, '2018-09-06 19:26:00', '1', 1, 'Ty', '1200.00', 1, 2, 1, '2018-09-06 14:27:55'),
(8, 1, '2018-09-06 21:43:12', '1', 1, 'DGH', '142.00', 1, 1, 1, '2018-09-06 16:43:12');

-- --------------------------------------------------------

--
-- Table structure for table `expense_category`
--

CREATE TABLE `expense_category` (
  `id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `expense_category`
--

INSERT INTO `expense_category` (`id`, `branch_id`, `title`, `status`, `ts`) VALUES
(1, 0, 'Fuel Expense', 1, '2018-06-04 18:18:07');

-- --------------------------------------------------------

--
-- Table structure for table `make`
--

CREATE TABLE `make` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `sortorder` int(11) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `make`
--

INSERT INTO `make` (`id`, `title`, `sortorder`, `status`, `ts`) VALUES
(1, 'Toyota', 1, 1, '2018-07-31 17:31:06'),
(2, 'Lexus', 2, 1, '2018-07-31 17:31:16'),
(3, 'Nissan', 3, 1, '2018-07-31 17:31:28');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `url` varchar(100) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `depth` int(1) NOT NULL,
  `sortorder` int(11) NOT NULL,
  `icon` varchar(200) NOT NULL,
  `small_icon` varchar(200) CHARACTER SET latin1 NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `title`, `url`, `parent_id`, `depth`, `sortorder`, `icon`, `small_icon`) VALUES
(1, 'Dashboard', '#', 0, 0, 1, 'dashboard.png', 'home'),
(8, 'Administrator', 'admin_manage.php', 1, 1, 3, 'administrator.png', 'user'),
(7, 'General Settings', 'config_manage.php?config_id=1', 1, 1, 2, 'general-settings.png', 'adjust'),
(22, 'Reports', '#', 0, 0, 170, 'reports.png', 'list-alt'),
(74, 'Manage Equipments', 'equipment_manage.php', 70, 1, 19, 'manage-equipments.jpg', 'align-right'),
(73, 'Manage Auction', 'auction_manage.php', 70, 1, 18, 'manage-auction.png', 'font'),
(25, 'Manage Expense', 'expense_manage.php', 56, 1, 251, 'manage-expense.png', 'money'),
(26, 'Admin Type', 'admin_type_manage.php', 1, 1, 4, 'admin-type.jpg', 'unlock'),
(29, 'Accounts', '#', 0, 0, 200, 'accounts.jpg', 'industry'),
(30, 'Manage Account', 'account_manage.php', 29, 1, 201, 'manage-account.png', 'glass'),
(31, 'Transaction', 'transaction_manage.php', 29, 1, 202, 'transaction.png', 'cart-plus'),
(32, 'Expense Category', 'expense_category_manage.php', 56, 1, 252, 'expense-category.png', 'cog'),
(37, 'General Journal', 'report_manage.php?tab=general_journal', 22, 1, 158, 'general.jpg', 'picture-o'),
(39, 'Balance Sheet', 'report_manage.php?tab=balance_sheet', 22, 1, 29, 'total-report.jpg', 'film'),
(56, 'Expense', '#', 0, 0, 250, 'expense.png', 'th-list'),
(58, 'Home', 'index.php', 1, 1, 45, 'home.png', 'film'),
(72, 'Manage Models', 'model_manage.php', 70, 1, 17, 'manage-models.png', 'taxi'),
(70, 'Vehicle', '#', 0, 0, 15, 'vehicle.png', 'map-signs'),
(71, 'Manage Vehicle', 'vehicle_manage.php', 70, 1, 16, 'manage-vehicle.png', 'bus'),
(75, 'Manage Rixo', 'rixo_manage.php', 70, 1, 20, 'manage-rixo.png', 'share'),
(76, 'Branch', 'branch_manage.php', 1, 1, 21, 'branch.png', 'home');

-- --------------------------------------------------------

--
-- Table structure for table `menu_2_admin_type`
--

CREATE TABLE `menu_2_admin_type` (
  `menu_id` int(11) NOT NULL,
  `admin_type_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `menu_2_admin_type`
--

INSERT INTO `menu_2_admin_type` (`menu_id`, `admin_type_id`) VALUES
(1, 1),
(1, 3),
(1, 4),
(1, 5),
(1, 6),
(1, 7),
(2, 1),
(3, 1),
(4, 1),
(4, 3),
(4, 4),
(5, 1),
(5, 3),
(6, 1),
(7, 1),
(8, 1),
(8, 4),
(9, 1),
(12, 1),
(14, 1),
(14, 4),
(15, 1),
(15, 4),
(15, 6),
(16, 1),
(17, 1),
(17, 4),
(17, 6),
(18, 1),
(18, 3),
(19, 1),
(19, 3),
(19, 4),
(19, 7),
(20, 1),
(20, 4),
(20, 7),
(21, 1),
(21, 4),
(21, 6),
(22, 1),
(22, 4),
(23, 1),
(23, 4),
(24, 1),
(24, 4),
(25, 1),
(25, 4),
(26, 1),
(27, 1),
(27, 4),
(28, 1),
(28, 4),
(29, 1),
(29, 4),
(30, 1),
(30, 4),
(31, 1),
(31, 4),
(32, 1),
(32, 4),
(33, 1),
(33, 3),
(34, 1),
(34, 3),
(35, 1),
(35, 4),
(35, 6),
(36, 1),
(36, 3),
(37, 1),
(37, 4),
(38, 1),
(38, 4),
(38, 6),
(39, 1),
(39, 4),
(40, 1),
(40, 4),
(41, 1),
(41, 4),
(41, 6),
(42, 1),
(42, 4),
(42, 6),
(43, 1),
(43, 4),
(44, 1),
(44, 4),
(44, 6),
(45, 1),
(45, 4),
(46, 1),
(46, 4),
(46, 5),
(47, 1),
(47, 4),
(48, 1),
(48, 4),
(49, 1),
(50, 1),
(50, 5),
(51, 1),
(51, 4),
(51, 6),
(52, 1),
(52, 4),
(52, 6),
(53, 1),
(53, 4),
(53, 6),
(54, 1),
(54, 4),
(54, 6),
(55, 1),
(55, 7),
(56, 1),
(56, 4),
(57, 1),
(57, 4),
(58, 1),
(58, 4),
(59, 1),
(59, 4),
(60, 1),
(60, 4),
(60, 6),
(61, 1),
(61, 4),
(62, 1),
(63, 1),
(63, 10),
(64, 1),
(64, 10),
(65, 1),
(65, 10),
(66, 1),
(66, 10),
(67, 1),
(67, 10),
(68, 1),
(68, 4),
(69, 1),
(69, 4),
(70, 1),
(71, 1),
(72, 1),
(73, 1),
(74, 1),
(75, 1),
(76, 1);

-- --------------------------------------------------------

--
-- Table structure for table `menu_2_branch`
--

CREATE TABLE `menu_2_branch` (
  `menu_id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `model`
--

CREATE TABLE `model` (
  `id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `make_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `sortorder` int(11) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `model`
--

INSERT INTO `model` (`id`, `branch_id`, `make_id`, `title`, `sortorder`, `status`, `ts`) VALUES
(1, 1, 1, 'Advan', 1, 1, '2018-09-10 15:40:05'),
(2, 1, 2, 'Probox Van', 2, 1, '2018-09-10 15:40:09'),
(3, 2, 2, 'Lexus LX', 3, 1, '2018-09-10 15:40:13');

-- --------------------------------------------------------

--
-- Table structure for table `rixo`
--

CREATE TABLE `rixo` (
  `id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `sortorder` int(11) NOT NULL,
  `comments` text NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rixo`
--

INSERT INTO `rixo` (`id`, `branch_id`, `title`, `phone`, `date`, `price`, `sortorder`, `comments`, `status`, `ts`) VALUES
(1, 0, 'Test', '56456456', '2018-08-11', '900.00', 1, 'gdfgfg', 1, '2018-08-11 18:59:53');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `account_id` varchar(50) NOT NULL,
  `reference_id` int(11) NOT NULL DEFAULT '0' COMMENT '0:Debit;1:Credit',
  `datetime_added` datetime NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `details` text NOT NULL,
  `currency_id` int(11) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`id`, `branch_id`, `account_id`, `reference_id`, `datetime_added`, `amount`, `details`, `currency_id`, `status`, `ts`) VALUES
(2, 2, '1', 2, '2018-09-06 19:28:00', '2000.00', 'Hut', 1, 1, '2018-09-06 14:29:15'),
(3, 1, '1', 2, '2018-09-06 19:29:00', '4000.00', 'OP', 1, 1, '2018-09-06 14:30:16');

-- --------------------------------------------------------

--
-- Table structure for table `uploads`
--

CREATE TABLE `uploads` (
  `id` int(11) NOT NULL,
  `filename` varchar(200) NOT NULL,
  `filelocation` varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `vehicle`
--

CREATE TABLE `vehicle` (
  `id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `make_id` int(11) NOT NULL,
  `model_id` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `stock_no` varchar(50) NOT NULL,
  `chassis_no` varchar(50) NOT NULL,
  `month` int(20) NOT NULL,
  `mileage` varchar(50) NOT NULL,
  `grade` varchar(50) NOT NULL,
  `condition_type` int(11) NOT NULL,
  `body_type_id` int(11) NOT NULL,
  `fuel_tank` int(11) NOT NULL,
  `transmission` int(11) NOT NULL,
  `engine_no` varchar(50) NOT NULL,
  `engine_cc` varchar(50) NOT NULL,
  `doors` varchar(50) NOT NULL,
  `seating` varchar(50) NOT NULL,
  `drive` int(11) NOT NULL,
  `drive_type` int(11) NOT NULL,
  `color_interior` varchar(50) NOT NULL,
  `color_exterior` varchar(50) NOT NULL,
  `options` varchar(50) NOT NULL,
  `fob_price` decimal(10,2) NOT NULL,
  `discount_price` decimal(10,2) NOT NULL,
  `cnf_price` decimal(10,2) NOT NULL,
  `doc_paper` int(11) NOT NULL,
  `container_no` varchar(50) NOT NULL,
  `bl_no` varchar(50) NOT NULL,
  `bl_date` date NOT NULL,
  `export` varchar(50) NOT NULL,
  `consignee_name` varchar(50) NOT NULL,
  `s_charge` int(11) NOT NULL,
  `gov_tax` decimal(10,2) NOT NULL,
  `expanses` decimal(10,2) NOT NULL,
  `freight` decimal(10,2) NOT NULL,
  `yard_charge` decimal(10,2) NOT NULL,
  `insha_charge` decimal(10,2) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `total_price_np` decimal(10,2) NOT NULL,
  `added_by` int(11) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vehicle`
--

INSERT INTO `vehicle` (`id`, `branch_id`, `title`, `make_id`, `model_id`, `year`, `stock_no`, `chassis_no`, `month`, `mileage`, `grade`, `condition_type`, `body_type_id`, `fuel_tank`, `transmission`, `engine_no`, `engine_cc`, `doors`, `seating`, `drive`, `drive_type`, `color_interior`, `color_exterior`, `options`, `fob_price`, `discount_price`, `cnf_price`, `doc_paper`, `container_no`, `bl_no`, `bl_date`, `export`, `consignee_name`, `s_charge`, `gov_tax`, `expanses`, `freight`, `yard_charge`, `insha_charge`, `total_price`, `total_price_np`, `added_by`, `status`, `ts`) VALUES
(1, 0, 'Daihatsu Hijet Van 2013', 1, 1, 2013, 'JP265246', 'S331', 2, '153,000 KM', 'Special 4WD', 0, 2, 0, 0, '354tr4rt', '660', '5', '4', 1, 1, 'Grey', 'White', '', '1200.00', '0.00', '0.00', 0, '', '', '0000-00-00', '', '', 0, '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', '0.00', 0, 1, '2018-08-01 15:51:35'),
(2, 0, 'fghfhfgh', 0, 2, 556, '65', '56', 3, '', '', 2, 1, 2, 2, '', '', '6', '', 0, 1, '', '', '', '5656.00', '676.00', '567.00', 0, '', '', '1970-01-01', '', '', 56, '45.00', '0.57', '5656.00', '565.00', '0.45', '43.00', '565.00', 1, 1, '2018-08-17 13:18:59'),
(3, 1, 'Test Veh', 1, 1, 2012, '5678778', '77878', 2, '200', '', 2, 2, 3, 1, '545454', '1500', '4', '6', 0, 0, 'Light', 'Black', 'opl', '20000.00', '0.00', '0.00', 0, '566', '56/45', '1970-01-01', 'Yes', 'GHP', 1000, '300.00', '200.00', '54.00', '230.00', '120.00', '1221.00', '65.00', 1, 1, '2018-09-06 15:09:13');

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_2_equipment`
--

CREATE TABLE `vehicle_2_equipment` (
  `vehicle_id` int(11) NOT NULL,
  `equipment_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vehicle_2_equipment`
--

INSERT INTO `vehicle_2_equipment` (`vehicle_id`, `equipment_id`) VALUES
(1, 1),
(1, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_type`
--
ALTER TABLE `admin_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `auction`
--
ALTER TABLE `auction`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `body_type`
--
ALTER TABLE `body_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `branch`
--
ALTER TABLE `branch`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `config_type`
--
ALTER TABLE `config_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `config_variable`
--
ALTER TABLE `config_variable`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `currency`
--
ALTER TABLE `currency`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `equipment`
--
ALTER TABLE `equipment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expense`
--
ALTER TABLE `expense`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expense_category`
--
ALTER TABLE `expense_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `make`
--
ALTER TABLE `make`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu_2_admin_type`
--
ALTER TABLE `menu_2_admin_type`
  ADD PRIMARY KEY (`menu_id`,`admin_type_id`);

--
-- Indexes for table `menu_2_branch`
--
ALTER TABLE `menu_2_branch`
  ADD PRIMARY KEY (`menu_id`,`branch_id`);

--
-- Indexes for table `model`
--
ALTER TABLE `model`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rixo`
--
ALTER TABLE `rixo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `uploads`
--
ALTER TABLE `uploads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vehicle`
--
ALTER TABLE `vehicle`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vehicle_2_equipment`
--
ALTER TABLE `vehicle_2_equipment`
  ADD PRIMARY KEY (`vehicle_id`,`equipment_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `admin_type`
--
ALTER TABLE `admin_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `auction`
--
ALTER TABLE `auction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `body_type`
--
ALTER TABLE `body_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `branch`
--
ALTER TABLE `branch`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `config_type`
--
ALTER TABLE `config_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `config_variable`
--
ALTER TABLE `config_variable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
--
-- AUTO_INCREMENT for table `currency`
--
ALTER TABLE `currency`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `equipment`
--
ALTER TABLE `equipment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `expense`
--
ALTER TABLE `expense`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `expense_category`
--
ALTER TABLE `expense_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `make`
--
ALTER TABLE `make`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;
--
-- AUTO_INCREMENT for table `model`
--
ALTER TABLE `model`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `rixo`
--
ALTER TABLE `rixo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `uploads`
--
ALTER TABLE `uploads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `vehicle`
--
ALTER TABLE `vehicle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
