-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 19, 2024 at 11:02 PM
-- Server version: 5.7.24
-- PHP Version: 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `salon`
--

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `address_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `street` text NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `let` text NOT NULL,
  `long` text NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `adminsetting`
--

CREATE TABLE `adminsetting` (
  `id` int(10) NOT NULL,
  `user_verify` tinyint(1) NOT NULL DEFAULT '1',
  `user_verify_sms` tinyint(1) NOT NULL DEFAULT '1',
  `user_verify_email` tinyint(1) NOT NULL DEFAULT '1',
  `currency` varchar(255) NOT NULL,
  `currency_symbol` varchar(255) NOT NULL,
  `mapkey` varchar(255) DEFAULT NULL,
  `lat` varchar(255) DEFAULT NULL,
  `lang` varchar(255) DEFAULT NULL,
  `notification` tinyint(1) NOT NULL DEFAULT '1',
  `app_id` varchar(100) DEFAULT NULL,
  `api_key` varchar(100) DEFAULT NULL,
  `auth_key` varchar(100) DEFAULT NULL,
  `project_no` varchar(100) DEFAULT NULL,
  `mail` tinyint(1) NOT NULL DEFAULT '1',
  `mail_host` varchar(255) DEFAULT NULL,
  `mail_port` varchar(255) DEFAULT NULL,
  `mail_username` varchar(255) DEFAULT NULL,
  `mail_password` varchar(255) DEFAULT NULL,
  `sender_email` varchar(255) DEFAULT NULL,
  `sms` tinyint(1) NOT NULL DEFAULT '1',
  `twilio_acc_id` varchar(255) DEFAULT NULL,
  `twilio_auth_token` varchar(255) DEFAULT NULL,
  `twilio_phone_no` varchar(255) DEFAULT NULL,
  `terms_conditions` longtext,
  `privacy_policy` longtext,
  `radius` int(10) NOT NULL,
  `app_name` varchar(255) NOT NULL,
  `favicon` varchar(50) NOT NULL,
  `black_logo` varchar(50) NOT NULL,
  `white_logo` varchar(50) NOT NULL,
  `app_version` varchar(100) DEFAULT NULL,
  `footer1` text,
  `footer2` text,
  `bg_img` varchar(255) NOT NULL,
  `color` varchar(255) DEFAULT NULL,
  `license_code` varchar(50) DEFAULT NULL,
  `license_client_name` varchar(255) DEFAULT NULL,
  `license_status` tinyint(1) DEFAULT NULL,
  `shared_name` varchar(255) DEFAULT NULL,
  `shared_image` varchar(255) DEFAULT NULL,
  `shared_url` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `adminsetting`
--

INSERT INTO `adminsetting` (`id`, `user_verify`, `user_verify_sms`, `user_verify_email`, `currency`, `currency_symbol`, `mapkey`, `lat`, `lang`, `notification`, `app_id`, `api_key`, `auth_key`, `project_no`, `mail`, `mail_host`, `mail_port`, `mail_username`, `mail_password`, `sender_email`, `sms`, `twilio_acc_id`, `twilio_auth_token`, `twilio_phone_no`, `terms_conditions`, `privacy_policy`, `radius`, `app_name`, `favicon`, `black_logo`, `white_logo`, `app_version`, `footer1`, `footer2`, `bg_img`, `color`, `license_code`, `license_client_name`, `license_status`, `shared_name`, `shared_image`, `shared_url`, `created_at`, `updated_at`) VALUES
(1, 0, 0, 0, 'MAD', 'DH', NULL, '21.1702', '72.8311', 0, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 50, 'EpilWorld', 'favicon.png', 'black_logo.png', 'white_logo.png', 'Version 01.0.00', '©EpilWorld 2023', 'All rights reserved', 'bg_img.jpg', '#66e1c8', '0100', 'epilworld', 1, 'Epilworld', 'shared_image.jpg', 'https://epilworld.ma/', '2020-08-14 05:37:51', '2023-12-09 02:48:08');

-- --------------------------------------------------------

--
-- Table structure for table `banner`
--

CREATE TABLE `banner` (
  `id` int(10) NOT NULL,
  `image` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `banner`
--

INSERT INTO `banner` (`id`, `image`, `title`, `status`, `created_at`, `updated_at`) VALUES
(2, 'banner_65747821e2d65.png', 'test', 1, '2023-12-09 18:52:25', '2023-12-09 18:52:33');

-- --------------------------------------------------------

--
-- Table structure for table `bill`
--

CREATE TABLE `bill` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `date` timestamp NULL DEFAULT NULL,
  `mode_payment` varchar(255) DEFAULT NULL,
  `ref_pay` varchar(255) DEFAULT NULL,
  `tiers` varchar(255) DEFAULT NULL,
  `note` text,
  `created_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bill`
--

INSERT INTO `bill` (`id`, `name`, `price`, `date`, `mode_payment`, `ref_pay`, `tiers`, `note`, `created_by`, `created_at`, `updated_at`, `status`) VALUES
(1, 'ttt', 120, '2024-02-11 23:00:00', 'Chéque', 'dsadsa', 'cxy', 'dsadas', 'Support TAYSSIR', '2024-02-12 22:53:03', '2024-02-12 22:53:03', 1);

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `id` int(11) NOT NULL,
  `booking_id` varchar(255) NOT NULL,
  `is_repeat` varchar(255) DEFAULT NULL,
  `salon_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `emp_id` int(10) NOT NULL,
  `room_id` int(11) NOT NULL,
  `service_id` text NOT NULL,
  `coupon_id` int(10) DEFAULT NULL,
  `discount` float DEFAULT '0',
  `payment` float NOT NULL,
  `date` date NOT NULL,
  `start_time` varchar(20) NOT NULL,
  `end_time` varchar(20) NOT NULL,
  `payment_type` varchar(20) NOT NULL,
  `payment_token` text,
  `payment_status` tinyint(1) NOT NULL DEFAULT '0',
  `booking_status` varchar(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `NBS` varchar(255) DEFAULT NULL,
  `frequency` varchar(255) DEFAULT NULL,
  `frequency_nb` varchar(255) DEFAULT NULL,
  `whycancel` text,
  `who_cancel` varchar(255) DEFAULT NULL,
  `cancel_date` varchar(255) DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`id`, `booking_id`, `is_repeat`, `salon_id`, `user_id`, `emp_id`, `room_id`, `service_id`, `coupon_id`, `discount`, `payment`, `date`, `start_time`, `end_time`, `payment_type`, `payment_token`, `payment_status`, `booking_status`, `created_at`, `updated_at`, `NBS`, `frequency`, `frequency_nb`, `whycancel`, `who_cancel`, `cancel_date`, `created_by`) VALUES
(52, '#62731_177', '1', 1, 21, 3, 6, '[3]', NULL, 0, 1000, '2024-03-01', '09:00 AM', '11:00 AM', 'LOCAL', NULL, 2, 'Completed', '2024-03-01 19:12:41', '2024-03-01 19:16:57', '1', 'Day', '2', '', '', '', 'Support TAYSSIR'),
(53, '#29576_151', '1', 1, 21, 4, 5, '[2]', NULL, 0, 1000, '2024-03-01', '02:00 PM', '05:20 PM', 'LOCAL', NULL, 1, 'Completed', '2024-03-01 19:13:03', '2024-03-01 19:15:09', '2', 'Day', '2', '', '', '', 'Support TAYSSIR'),
(54, '#29576_151', '0', 1, 21, 4, 5, '[2]', NULL, 0, 1000, '2024-03-04', '02:00 PM', '05:20 PM', 'LOCAL', NULL, 1, 'Completed', '2024-03-01 19:13:03', '2024-03-01 19:15:09', '2', 'Day', '2', '', '', '', 'Support TAYSSIR'),
(55, '#12311_327', '1', 1, 21, 2, 4, '[15,42,43]', NULL, 0, 400, '2024-03-05', '08:30 AM', '09:30 AM', 'LOCAL', NULL, 0, 'Réservée', '2024-03-05 16:03:57', '2024-03-05 16:03:57', '1', 'Day', '1', NULL, NULL, NULL, 'Support TAYSSIR');

-- --------------------------------------------------------

--
-- Table structure for table `caisse`
--

CREATE TABLE `caisse` (
  `id` int(11) NOT NULL,
  `salon_id` int(11) DEFAULT NULL,
  `date` date NOT NULL,
  `day_caisse` date DEFAULT NULL,
  `amount` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `caisse`
--

INSERT INTO `caisse` (`id`, `salon_id`, `date`, `day_caisse`, `amount`, `status`, `created_at`, `updated_at`) VALUES
(36, 1, '2024-01-09', '2024-01-09', '1000', '0', '2024-01-09 14:41:15', '2024-01-09 14:41:15'),
(37, 1, '2024-01-09', '2024-01-08', '0', '1', '2024-01-09 15:12:27', '2024-01-09 15:12:27');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `cat_id` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `color_name` varchar(255) DEFAULT NULL,
  `image` varchar(255) NOT NULL DEFAULT 'noimage.jpg',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`cat_id`, `name`, `color_name`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Soin de visage', '#FF5733', 'category_65730caa48d49.jpg', 1, '2023-12-07 21:05:47', '2023-12-08 17:01:38'),
(2, 'Épilation définitive', '#bda400', 'category_65c1211a75ca4.png', 1, '2024-02-05 17:55:38', '2024-02-07 00:13:45'),
(3, 'Amincissement', '#33AFFF', 'category_65730d0fa350a.jpg', 1, '2023-12-08 17:03:19', '2023-12-08 17:03:19'),
(4, 'Diagnostic', '#42FF33', 'category_65730ecbc4a6d.JPG', 1, '2023-12-08 17:10:43', '2023-12-08 17:10:43');

-- --------------------------------------------------------

--
-- Table structure for table `coupon`
--

CREATE TABLE `coupon` (
  `coupon_id` int(10) NOT NULL,
  `desc` text NOT NULL,
  `code` varchar(255) NOT NULL,
  `max_use` int(10) NOT NULL,
  `use_count` int(10) NOT NULL DEFAULT '0',
  `type` varchar(255) NOT NULL,
  `discount` float NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `coupon`
--

INSERT INTO `coupon` (`coupon_id`, `desc`, `code`, `max_use`, `use_count`, `type`, `discount`, `start_date`, `end_date`, `status`, `created_at`, `updated_at`) VALUES
(1, 'PAR1', 'EG4X1SOA', 10, 0, 'Percentage', 10, '2023-12-07', '2023-12-31', 1, '2023-12-07 21:08:56', '2023-12-07 21:08:56');

-- --------------------------------------------------------

--
-- Table structure for table `currency`
--

CREATE TABLE `currency` (
  `id` int(11) NOT NULL,
  `country` varchar(100) DEFAULT NULL,
  `currency` varchar(100) DEFAULT NULL,
  `code` varchar(100) DEFAULT NULL,
  `symbol` varchar(100) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `currency`
--

INSERT INTO `currency` (`id`, `country`, `currency`, `code`, `symbol`) VALUES
(1, 'Albania', 'Leke', 'ALL', 'Lek'),
(2, 'America', 'Dollars', 'USD', '$'),
(3, 'Afghanistan', 'Afghanis', 'AFN', '؋'),
(4, 'Argentina', 'Pesos', 'ARS', '$'),
(5, 'Aruba', 'Guilders', 'AWG', 'Afl'),
(6, 'Australia', 'Dollars', 'AUD', '$'),
(7, 'Azerbaijan', 'New Manats', 'AZN', '₼'),
(8, 'Bahamas', 'Dollars', 'BSD', '$'),
(9, 'Barbados', 'Dollars', 'BBD', '$'),
(10, 'Belarus', 'Rubles', 'BYR', 'p.'),
(11, 'Belgium', 'Euro', 'EUR', '€'),
(12, 'Beliz', 'Dollars', 'BZD', 'BZ$'),
(13, 'Bermuda', 'Dollars', 'BMD', '$'),
(14, 'Bolivia', 'Bolivianos', 'BOB', '$b'),
(15, 'Bosnia and Herzegovina', 'Convertible Marka', 'BAM', 'KM'),
(16, 'Botswana', 'Pula', 'BWP', 'P'),
(17, 'Bulgaria', 'Leva', 'BGN', 'Лв.'),
(18, 'Brazil', 'Reais', 'BRL', 'R$'),
(19, 'Britain (United Kingdom)', 'Pounds', 'GBP', '£\r\n'),
(20, 'Brunei Darussalam', 'Dollars', 'BND', '$'),
(21, 'Cambodia', 'Riels', 'KHR', '៛'),
(22, 'Canada', 'Dollars', 'CAD', '$'),
(23, 'Cayman Islands', 'Dollars', 'KYD', '$'),
(24, 'Chile', 'Pesos', 'CLP', '$'),
(25, 'China', 'Yuan Renminbi', 'CNY', '¥'),
(26, 'Colombia', 'Pesos', 'COP', '$'),
(27, 'Costa Rica', 'Colón', 'CRC', '₡'),
(28, 'Croatia', 'Kuna', 'HRK', 'kn'),
(29, 'Cuba', 'Pesos', 'CUP', '₱'),
(30, 'Cyprus', 'Euro', 'EUR', '€'),
(31, 'Czech Republic', 'Koruny', 'CZK', 'Kč'),
(32, 'Denmark', 'Kroner', 'DKK', 'kr'),
(33, 'Dominican Republic', 'Pesos', 'DOP', 'RD$'),
(34, 'East Caribbean', 'Dollars', 'XCD', '$'),
(35, 'Egypt', 'Pounds', 'EGP', '£'),
(36, 'El Salvador', 'Colones', 'SVC', '$'),
(37, 'England (United Kingdom)', 'Pounds', 'GBP', '£'),
(38, 'Euro', 'Euro', 'EUR', '€'),
(39, 'Falkland Islands', 'Pounds', 'FKP', '£'),
(40, 'Fiji', 'Dollars', 'FJD', '$'),
(41, 'France', 'Euro', 'EUR', '€'),
(42, 'Ghana', 'Cedis', 'GHC', 'GH₵'),
(43, 'Gibraltar', 'Pounds', 'GIP', '£'),
(44, 'Greece', 'Euro', 'EUR', '€'),
(45, 'Guatemala', 'Quetzales', 'GTQ', 'Q'),
(46, 'Guernsey', 'Pounds', 'GGP', '£'),
(47, 'Guyana', 'Dollars', 'GYD', '$'),
(48, 'Holland (Netherlands)', 'Euro', 'EUR', '€'),
(49, 'Honduras', 'Lempiras', 'HNL', 'L'),
(50, 'Hong Kong', 'Dollars', 'HKD', '$'),
(51, 'Hungary', 'Forint', 'HUF', 'Ft'),
(52, 'Iceland', 'Kronur', 'ISK', 'kr'),
(53, 'India', 'Rupees', 'INR', '₹'),
(54, 'Indonesia', 'Rupiahs', 'IDR', 'Rp'),
(55, 'Iran', 'Rials', 'IRR', '﷼'),
(56, 'Ireland', 'Euro', 'EUR', '€'),
(57, 'Isle of Man', 'Pounds', 'IMP', '£'),
(58, 'Israel', 'New Shekels', 'ILS', '₪'),
(59, 'Italy', 'Euro', 'EUR', '€'),
(60, 'Jamaica', 'Dollars', 'JMD', 'J$'),
(61, 'Japan', 'Yen', 'JPY', '¥'),
(62, 'Jersey', 'Pounds', 'JEP', '£'),
(63, 'Kazakhstan', 'Tenge', 'KZT', '₸'),
(64, 'Korea (North)', 'Won', 'KPW', '₩'),
(65, 'Korea (South)', 'Won', 'KRW', '₩'),
(66, 'Kyrgyzstan', 'Soms', 'KGS', 'Лв'),
(67, 'Laos', 'Kips', 'LAK', '	₭'),
(68, 'Latvia', 'Lati', 'LVL', 'Ls'),
(69, 'Lebanon', 'Pounds', 'LBP', '£'),
(70, 'Liberia', 'Dollars', 'LRD', '$'),
(71, 'Liechtenstein', 'Switzerland Francs', 'CHF', 'CHF'),
(72, 'Lithuania', 'Litai', 'LTL', 'Lt'),
(73, 'Luxembourg', 'Euro', 'EUR', '€'),
(74, 'Macedonia', 'Denars', 'MKD', 'Ден\r\n'),
(75, 'Malaysia', 'Ringgits', 'MYR', 'RM'),
(76, 'Malta', 'Euro', 'EUR', '€'),
(77, 'Mauritius', 'Rupees', 'MUR', '₹'),
(78, 'Mexico', 'Pesos', 'MXN', '$'),
(79, 'Mongolia', 'Tugriks', 'MNT', '₮'),
(80, 'Mozambique', 'Meticais', 'MZN', 'MT'),
(81, 'Namibia', 'Dollars', 'NAD', '$'),
(82, 'Nepal', 'Rupees', 'NPR', '₹'),
(83, 'Netherlands Antilles', 'Guilders', 'ANG', 'ƒ'),
(84, 'Netherlands', 'Euro', 'EUR', '€'),
(85, 'New Zealand', 'Dollars', 'NZD', '$'),
(86, 'Nicaragua', 'Cordobas', 'NIO', 'C$'),
(87, 'Nigeria', 'Nairas', 'NGN', '₦'),
(88, 'North Korea', 'Won', 'KPW', '₩'),
(89, 'Norway', 'Krone', 'NOK', 'kr'),
(90, 'Oman', 'Rials', 'OMR', '﷼'),
(91, 'Pakistan', 'Rupees', 'PKR', '₹'),
(92, 'Panama', 'Balboa', 'PAB', 'B/.'),
(93, 'Paraguay', 'Guarani', 'PYG', 'Gs'),
(94, 'Peru', 'Nuevos Soles', 'PEN', 'S/.'),
(95, 'Philippines', 'Pesos', 'PHP', 'Php'),
(96, 'Poland', 'Zlotych', 'PLN', 'zł'),
(97, 'Qatar', 'Rials', 'QAR', '﷼'),
(98, 'Romania', 'New Lei', 'RON', 'lei'),
(99, 'Russia', 'Rubles', 'RUB', '₽'),
(100, 'Saint Helena', 'Pounds', 'SHP', '£'),
(101, 'Saudi Arabia', 'Riyals', 'SAR', '﷼'),
(102, 'Serbia', 'Dinars', 'RSD', 'ع.د'),
(103, 'Seychelles', 'Rupees', 'SCR', '₹'),
(104, 'Singapore', 'Dollars', 'SGD', '$'),
(105, 'Slovenia', 'Euro', 'EUR', '€'),
(106, 'Solomon Islands', 'Dollars', 'SBD', '$'),
(107, 'Somalia', 'Shillings', 'SOS', 'S'),
(108, 'South Africa', 'Rand', 'ZAR', 'R'),
(109, 'South Korea', 'Won', 'KRW', '₩'),
(110, 'Spain', 'Euro', 'EUR', '€'),
(111, 'Sri Lanka', 'Rupees', 'LKR', '₹'),
(112, 'Sweden', 'Kronor', 'SEK', 'kr'),
(113, 'Switzerland', 'Francs', 'CHF', 'CHF'),
(114, 'Suriname', 'Dollars', 'SRD', '$'),
(115, 'Syria', 'Pounds', 'SYP', '£'),
(116, 'Taiwan', 'New Dollars', 'TWD', 'NT$'),
(117, 'Thailand', 'Baht', 'THB', '฿'),
(118, 'Trinidad and Tobago', 'Dollars', 'TTD', 'TT$'),
(119, 'Turkey', 'Lira', 'TRY', 'TL'),
(120, 'Turkey', 'Liras', 'TRL', '₺'),
(121, 'Tuvalu', 'Dollars', 'TVD', '$'),
(122, 'Ukraine', 'Hryvnia', 'UAH', '₴'),
(123, 'United Kingdom', 'Pounds', 'GBP', '£'),
(124, 'United States of America', 'Dollars', 'USD', '$'),
(125, 'Uruguay', 'Pesos', 'UYU', '$U'),
(126, 'Uzbekistan', 'Sums', 'UZS', 'so\'m'),
(127, 'Vatican City', 'Euro', 'EUR', '€'),
(128, 'Venezuela', 'Bolivares Fuertes', 'VEF', 'Bs'),
(129, 'Vietnam', 'Dong', 'VND', '₫\r\n'),
(130, 'Yemen', 'Rials', 'YER', '﷼'),
(131, 'Zimbabwe', 'Zimbabwe Dollars', 'ZWD', 'Z$'),
(132, 'Maroc', 'Dirham', 'MAD', 'DH');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `emp_id` int(10) NOT NULL,
  `salon_id` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL DEFAULT 'noimage.jpg',
  `email` varchar(255) NOT NULL,
  `phone` bigint(20) NOT NULL,
  `service_id` text NOT NULL,
  `sun` varchar(150) DEFAULT NULL,
  `mon` varchar(150) DEFAULT NULL,
  `tue` varchar(150) DEFAULT NULL,
  `wed` varchar(150) DEFAULT NULL,
  `thu` varchar(150) DEFAULT NULL,
  `fri` varchar(150) DEFAULT NULL,
  `sat` varchar(150) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `isdelete` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`emp_id`, `salon_id`, `name`, `image`, `email`, `phone`, `service_id`, `sun`, `mon`, `tue`, `wed`, `thu`, `fri`, `sat`, `status`, `isdelete`, `created_at`, `updated_at`) VALUES
(1, 1, 'sara', 'emp_6571f4b36b5dc.jpg', 'sara@gmail.com', 666187309, '[\"1\"]', '{\"open\":\"08:00\",\"close\":\"20:00\"}', '{\"open\":\"08:00\",\"close\":\"20:00\"}', '{\"open\":\"08:00\",\"close\":\"20:00\"}', '{\"open\":\"08:00\",\"close\":\"20:00\"}', '{\"open\":\"08:00\",\"close\":\"20:00\"}', '{\"open\":\"08:00\",\"close\":\"20:00\"}', '{\"open\":\"08:00\",\"close\":\"20:00\"}', 0, 1, '2023-12-07 20:07:07', '2023-12-11 22:43:47'),
(2, 1, 'Souad Boussouf', 'emp_65730bf84b2b8.PNG', 'souad@tayssir.cloud', 666666666, '[\"1\",\"2\",\"3\",\"15\",\"16\",\"17\",\"18\",\"19\",\"20\",\"21\",\"23\",\"24\",\"25\",\"26\",\"27\",\"28\",\"29\",\"30\",\"31\",\"32\",\"33\",\"34\",\"35\",\"36\",\"37\",\"38\",\"39\",\"40\",\"41\",\"42\",\"43\",\"44\",\"45\",\"46\",\"47\",\"48\",\"49\",\"50\",\"51\",\"52\",\"53\",\"54\",\"55\",\"56\",\"57\",\"58\",\"59\",\"60\",\"61\",\"62\",\"63\",\"64\",\"69\",\"6\",\"7\",\"8\",\"9\",\"10\",\"11\",\"12\",\"13\",\"14\"]', '{\"open\":\"08:00\",\"close\":\"00:00\"}', '{\"open\":\"08:00\",\"close\":\"20:00\"}', '{\"open\":\"08:00\",\"close\":\"20:00\"}', '{\"open\":\"08:00\",\"close\":\"20:00\"}', '{\"open\":\"08:00\",\"close\":\"20:00\"}', '{\"open\":\"08:00\",\"close\":\"20:00\"}', '{\"open\":\"08:00\",\"close\":\"20:00\"}', 1, 0, '2023-12-08 15:56:41', '2024-02-12 12:31:26'),
(3, 1, 'Latifa Mouatssim', 'emp_65730c0f87aaa.PNG', 'latifa@tayssir.cloud', 666666661, '[\"1\",\"2\",\"3\",\"15\",\"16\",\"17\",\"18\",\"19\",\"20\",\"21\",\"23\",\"24\",\"25\",\"26\",\"27\",\"28\",\"29\",\"30\",\"31\",\"32\",\"33\",\"34\",\"35\",\"36\",\"37\",\"38\",\"39\",\"40\",\"41\",\"42\",\"43\",\"44\",\"45\",\"46\",\"47\",\"48\",\"49\",\"50\",\"51\",\"52\",\"53\",\"54\",\"55\",\"56\",\"57\",\"58\",\"59\",\"60\",\"61\",\"62\",\"63\",\"64\",\"69\",\"6\",\"7\",\"8\",\"9\",\"10\",\"11\",\"12\",\"13\",\"14\"]', '{\"open\":\"08:00\",\"close\":\"00:00\"}', '{\"open\":\"08:00\",\"close\":\"20:00\"}', '{\"open\":\"08:00\",\"close\":\"20:00\"}', '{\"open\":\"08:00\",\"close\":\"20:00\"}', '{\"open\":\"08:00\",\"close\":\"20:00\"}', '{\"open\":\"08:00\",\"close\":\"20:00\"}', '{\"open\":\"08:00\",\"close\":\"20:00\"}', 1, 0, '2023-12-08 15:57:36', '2024-02-09 10:59:52'),
(4, 1, 'Khaoula Mechta', 'emp_65730c1eead8f.PNG', 'Khaoula@tayssir.cloud', 666666662, '[\"1\",\"2\",\"3\",\"15\",\"16\",\"17\",\"18\",\"19\",\"20\",\"21\",\"23\",\"24\",\"25\",\"26\",\"27\",\"28\",\"29\",\"30\",\"31\",\"32\",\"33\",\"34\",\"35\",\"36\",\"37\",\"38\",\"39\",\"40\",\"41\",\"42\",\"43\",\"44\",\"45\",\"46\",\"47\",\"48\",\"49\",\"50\",\"51\",\"52\",\"53\",\"54\",\"55\",\"56\",\"57\",\"58\",\"59\",\"60\",\"61\",\"62\",\"63\",\"64\",\"69\",\"6\",\"7\",\"8\",\"9\",\"10\",\"11\",\"12\",\"13\",\"14\"]', '{\"open\":\"08:00\",\"close\":\"00:00\"}', '{\"open\":\"08:00\",\"close\":\"20:00\"}', '{\"open\":\"08:00\",\"close\":\"20:00\"}', '{\"open\":\"08:00\",\"close\":\"20:00\"}', '{\"open\":\"08:00\",\"close\":\"20:00\"}', '{\"open\":\"08:00\",\"close\":\"20:00\"}', '{\"open\":\"08:00\",\"close\":\"20:00\"}', 1, 0, '2023-12-08 15:58:12', '2024-02-12 00:41:40');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `gallery_id` int(10) NOT NULL,
  `salon_id` int(10) NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`gallery_id`, `salon_id`, `image`, `status`, `created_at`, `updated_at`) VALUES
(3, 1, 'Gallery_6574784885857.png', 1, '2023-12-09 18:53:04', '2023-12-09 18:53:04');

-- --------------------------------------------------------

--
-- Table structure for table `global_invoice`
--

CREATE TABLE `global_invoice` (
  `id` int(11) NOT NULL,
  `salon_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `global_invoice`
--

INSERT INTO `global_invoice` (`id`, `salon_id`, `date`, `user_id`, `status`, `created_at`, `updated_at`) VALUES
(38, 1, '2024-03-10', '21', 1, '2024-03-10 20:21:49', '2024-03-10 20:21:49'),
(39, 1, '2024-03-14', '21', 1, '2024-03-14 15:34:10', '2024-03-14 15:34:10');

-- --------------------------------------------------------

--
-- Table structure for table `global_invoice_details`
--

CREATE TABLE `global_invoice_details` (
  `id` int(11) NOT NULL,
  `global_invoice_id` int(11) NOT NULL,
  `booking_id` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `global_invoice_details`
--

INSERT INTO `global_invoice_details` (`id`, `global_invoice_id`, `booking_id`, `status`) VALUES
(70, 38, '52', 1),
(71, 38, '53', 1),
(72, 38, '55', 1),
(73, 39, '53', 1),
(74, 39, '55', 1);

-- --------------------------------------------------------

--
-- Table structure for table `language`
--

CREATE TABLE `language` (
  `id` int(10) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `file` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `direction` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `language`
--

INSERT INTO `language` (`id`, `name`, `file`, `image`, `direction`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Français', 'Français.json', 'Français.jpg', 'ltr', 1, '2023-12-09 00:46:18', '2023-12-17 05:13:42'),
(2, 'Arabic', 'Arabic.json', 'Arabic.jpg', 'rtl', 0, '2020-10-02 06:04:41', '2023-12-28 17:56:29'),
(5, 'English', 'English.json', 'English.jpg', 'ltr', 0, '2020-10-02 05:56:49', '2023-12-28 17:56:34');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2016_06_01_000001_create_oauth_auth_codes_table', 1),
(4, '2016_06_01_000002_create_oauth_access_tokens_table', 1),
(5, '2016_06_01_000003_create_oauth_refresh_tokens_table', 1),
(6, '2016_06_01_000004_create_oauth_clients_table', 1),
(7, '2016_06_01_000005_create_oauth_personal_access_clients_table', 1),
(8, '2019_08_19_000000_create_failed_jobs_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `booking_id` int(10) NOT NULL,
  `title` varchar(255) NOT NULL,
  `msg` text NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`id`, `user_id`, `booking_id`, `title`, `msg`, `created_at`, `updated_at`) VALUES
(1, 4, 1, 'Appointment Created', 'Dear Support TAYSSIR, Your appointment is successfully created on 2023-12-11 at 08:00 AM in aaa. Your booking id is #34372. Thank you.', '2023-12-09 01:03:58', '2023-12-09 01:03:58'),
(2, 4, 1, 'Booking status', 'Dear Support TAYSSIR, Your appointment on 2023-12-11 at 08:00 AM in aaa is now Completed. Your booking id is #34372. Thank you.', '2023-12-09 02:38:32', '2023-12-09 02:38:32'),
(3, 5, 2, 'Appointment Created', 'Dear Sara Sara, Your appointment is successfully created on 2023-12-11 at 12:30 PM in Epilworld. Your booking id is #58236. Thank you.', '2023-12-09 10:34:36', '2023-12-09 10:34:36'),
(4, 5, 3, 'Appointment Created', 'Dear Sara Sara, Your appointment is successfully created on 2023-12-11 at 10:00 AM in Epilworld. Your booking id is #83661. Thank you.', '2023-12-09 10:37:32', '2023-12-09 10:37:32'),
(5, 5, 4, 'Appointment Created', 'Dear Sara Sara, Your appointment is successfully created on 2023-12-11 at 04:00 PM in Epilworld. Your booking id is #27809. Thank you.', '2023-12-09 10:39:03', '2023-12-09 10:39:03'),
(6, 5, 5, 'Appointment Created', 'Dear Sara Sara, Your appointment is successfully created on 2023-12-12 at 10:00 AM in Epilworld. Your booking id is #25892. Thank you.', '2023-12-09 19:03:36', '2023-12-09 19:03:36'),
(7, 5, 2, 'Booking status', 'Dear Sara Sara, Your appointment on 2023-12-11 at 12:30 PM in Epilworld is now Completed. Your booking id is #58236. Thank you.', '2023-12-09 19:05:18', '2023-12-09 19:05:18'),
(8, 5, 3, 'Booking status', 'Dear Sara Sara, Your appointment on 2023-12-11 at 10:00 AM in Epilworld is now Cancel. Your booking id is #83661. Thank you.', '2023-12-09 19:06:08', '2023-12-09 19:06:08'),
(9, 7, 6, 'Appointment Created', 'Dear mohamed barrah, Your appointment is successfully created on 2023-12-11 at 10:00 AM in Epilworld. Your booking id is #18530. Thank you.', '2023-12-10 05:18:13', '2023-12-10 05:18:13'),
(10, 6, 7, 'Appointment Created', 'Dear test, Your appointment is successfully created on 2023-12-11 at 10:00 AM in Epilworld. Your booking id is #75731. Thank you.', '2023-12-10 05:27:29', '2023-12-10 05:27:29'),
(11, 6, 9, 'Appointment Created', 'Dear test, Your appointment is successfully created on 2023-12-14 at 11:00 AM in Epilworld. Your booking id is #60452. Thank you.', '2023-12-10 17:59:47', '2023-12-10 17:59:47'),
(12, 10, 10, 'Appointment Created', 'Dear testte, Your appointment is successfully created on 2023-12-11 at 10:30 AM in Epilworld. Your booking id is #80059. Thank you.', '2023-12-10 23:36:49', '2023-12-10 23:36:49'),
(13, 12, 11, 'Appointment Created', 'Dear 8888888888, Your appointment is successfully created on 2023-12-11 at 10:30 AM in Epilworld. Your booking id is #78030. Thank you.', '2023-12-11 00:52:00', '2023-12-11 00:52:00'),
(14, 6, 12, 'Appointment Created', 'Dear test, Your appointment is successfully created on 2023-12-11 at 10:30 AM in Epilworld. Your booking id is #13171. Thank you.', '2023-12-11 00:52:25', '2023-12-11 00:52:25'),
(15, 6, 13, 'Appointment Created', 'Dear test, Your appointment is successfully created on 2023-12-12 at 10:30 AM in Epilworld. Your booking id is #52510. Thank you.', '2023-12-11 01:15:05', '2023-12-11 01:15:05'),
(16, 7, 14, 'Appointment Created', 'Dear mohamed barrah, Your appointment is successfully created on 2023-12-11 at 10:30 AM in Epilworld. Your booking id is #85842. Thank you.', '2023-12-11 01:51:48', '2023-12-11 01:51:48'),
(17, 7, 15, 'Appointment Created', 'Dear mohamed barrah, Your appointment is successfully created on 2023-12-12 at 10:30 AM in Epilworld. Your booking id is #50024. Thank you.', '2023-12-11 01:53:46', '2023-12-11 01:53:46'),
(18, 7, 16, 'Appointment Created', 'Dear mohamed barrah, Your appointment is successfully created on 2023-12-11 at 10:30 AM in Epilworld. Your booking id is #55255. Thank you.', '2023-12-11 02:00:49', '2023-12-11 02:00:49'),
(19, 7, 17, 'Appointment Created', 'Dear mohamed barrah, Your appointment is successfully created on 2023-12-12 at 10:30 AM in Epilworld. Your booking id is #29026. Thank you.', '2023-12-11 02:03:16', '2023-12-11 02:03:16'),
(20, 7, 17, 'Booking status', 'Dear mohamed barrah, Your appointment on 2023-12-12 at 10:30 AM in Epilworld is now Completed. Your booking id is #29026. Thank you.', '2023-12-11 02:11:14', '2023-12-11 02:11:14'),
(21, 7, 16, 'Booking status', 'Dear mohamed barrah, Your appointment on 2023-12-13 at 05:00 PM in Epilworld is now Cancel. Your booking id is #55255. Thank you.', '2023-12-11 02:14:29', '2023-12-11 02:14:29'),
(22, 6, 18, 'Appointment Created', 'Dear test, Your appointment is successfully created on 2023-12-12 at 10:30 AM in Epilworld. Your booking id is #26772. Thank you.', '2023-12-11 02:15:53', '2023-12-11 02:15:53'),
(23, 7, 19, 'Appointment Created', 'Dear mohamed barrah, Your appointment is successfully created on 2023-12-29 at 10:00 AM in Epilworld. Your booking id is #84416. Thank you.', '2023-12-11 02:33:06', '2023-12-11 02:33:06'),
(24, 11, 20, 'Appointment Created', 'Dear dsaa, Your appointment is successfully created on 2023-12-13 at 05:30 PM in Epilworld. Your booking id is #31189. Thank you.', '2023-12-11 02:36:34', '2023-12-11 02:36:34'),
(25, 5, 21, 'Appointment Created', 'Dear Sara Sara, Your appointment is successfully created on 2023-12-11 at 10:00 AM in Epilworld. Your booking id is #27974. Thank you.', '2023-12-11 02:37:32', '2023-12-11 02:37:32'),
(26, 12, 22, 'Appointment Created', 'Dear 8888888888, Your appointment is successfully created on 2023-12-11 at 04:00 PM in Epilworld. Your booking id is #84074. Thank you.', '2023-12-11 02:38:12', '2023-12-11 02:38:12'),
(27, 5, 23, 'Appointment Created', 'Dear Sara Sara, Your appointment is successfully created on 2023-12-11 at 10:00 AM in Epilworld. Your booking id is #98275. Thank you.', '2023-12-11 02:41:23', '2023-12-11 02:41:23'),
(28, 12, 24, 'Appointment Created', 'Dear 8888888888, Your appointment is successfully created on 2023-12-11 at 11:00 AM in Epilworld. Your booking id is #74750. Thank you.', '2023-12-11 02:44:14', '2023-12-11 02:44:14'),
(29, 10, 25, 'Appointment Created', 'Dear testte, Your appointment is successfully created on 2023-12-11 at 02:00 PM in Epilworld. Your booking id is #11252. Thank you.', '2023-12-11 02:45:08', '2023-12-11 02:45:08'),
(30, 8, 26, 'Appointment Created', 'Dear mohamed barrah, Your appointment is successfully created on 2023-12-11 at 05:00 PM in Epilworld. Your booking id is #25144. Thank you.', '2023-12-11 02:46:32', '2023-12-11 02:46:32'),
(31, 8, 26, 'Booking status', 'Dear mohamed barrah, Your appointment on 2023-12-11 at 05:00 PM in Epilworld is now Completed. Your booking id is #25144. Thank you.', '2023-12-11 04:01:09', '2023-12-11 04:01:09'),
(32, 8, 26, 'Booking status', 'Dear mohamed barrah, Your appointment on 2023-12-11 at 05:00 PM in Epilworld is now Cancel. Your booking id is #25144. Thank you.', '2023-12-11 04:01:09', '2023-12-11 04:01:09'),
(33, 6, 27, 'Appointment Created', 'Dear test, Your appointment is successfully created on 2023-12-13 at 10:00 AM in Epilworld. Your booking id is #51682. Thank you.', '2023-12-11 04:16:24', '2023-12-11 04:16:24'),
(34, 6, 27, 'Booking status', 'Dear test, Your appointment on 2023-12-13 at 10:00 AM in Epilworld is now Cancel. Your booking id is #51682. Thank you.', '2023-12-11 04:16:39', '2023-12-11 04:16:39'),
(35, 6, 27, 'Booking status', 'Dear test, Your appointment on 2023-12-13 at 10:00 AM in Epilworld is now Cancel. Your booking id is #51682. Thank you.', '2023-12-11 04:20:08', '2023-12-11 04:20:08'),
(36, 6, 27, 'Booking status', 'Dear test, Your appointment on 2023-12-13 at 10:00 AM in Epilworld is now Completed. Your booking id is #51682. Thank you.', '2023-12-11 04:20:11', '2023-12-11 04:20:11'),
(37, 6, 27, 'Booking status', 'Dear test, Your appointment on 2023-12-13 at 10:00 AM in Epilworld is now Cancel. Your booking id is #51682. Thank you.', '2023-12-11 04:25:03', '2023-12-11 04:25:03'),
(38, 6, 27, 'Booking status', 'Dear test, Your appointment on 2023-12-13 at 10:00 AM in Epilworld is now Completed. Your booking id is #51682. Thank you.', '2023-12-11 04:25:05', '2023-12-11 04:25:05'),
(39, 6, 27, 'Booking status', 'Dear test, Your appointment on 2023-12-13 at 10:00 AM in Epilworld is now Cancel. Your booking id is #51682. Thank you.', '2023-12-11 04:25:09', '2023-12-11 04:25:09'),
(40, 6, 27, 'Booking status', 'Dear test, Your appointment on 2023-12-13 at 10:00 AM in Epilworld is now Completed. Your booking id is #51682. Thank you.', '2023-12-11 04:25:12', '2023-12-11 04:25:12'),
(41, 6, 27, 'Booking status', 'Dear test, Your appointment on 2023-12-13 at 10:00 AM in Epilworld is now Approved. Your booking id is #51682. Thank you.', '2023-12-11 04:25:14', '2023-12-11 04:25:14'),
(42, 6, 27, 'Booking status', 'Dear test, Your appointment on 2023-12-13 at 10:00 AM in Epilworld is now Completed. Your booking id is #51682. Thank you.', '2023-12-11 04:25:25', '2023-12-11 04:25:25'),
(43, 6, 27, 'Booking status', 'Dear test, Your appointment on 2023-12-13 at 10:00 AM in Epilworld is now Approved. Your booking id is #51682. Thank you.', '2023-12-11 04:26:25', '2023-12-11 04:26:25'),
(44, 6, 27, 'Booking status', 'Dear test, Your appointment on 2023-12-13 at 10:00 AM in Epilworld is now Completed. Your booking id is #51682. Thank you.', '2023-12-11 04:28:48', '2023-12-11 04:28:48'),
(45, 6, 27, 'Booking status', 'Dear test, Your appointment on 2023-12-13 at 10:00 AM in Epilworld is now Approved. Your booking id is #51682. Thank you.', '2023-12-11 04:28:50', '2023-12-11 04:28:50'),
(46, 6, 27, 'Booking status', 'Dear test, Your appointment on 2023-12-13 at 10:00 AM in Epilworld is now Cancel. Your booking id is #51682. Thank you.', '2023-12-11 04:28:51', '2023-12-11 04:28:51'),
(47, 6, 27, 'Booking status', 'Dear test, Your appointment on 2023-12-13 at 10:00 AM in Epilworld is now Completed. Your booking id is #51682. Thank you.', '2023-12-11 04:28:52', '2023-12-11 04:28:52'),
(48, 6, 27, 'Booking status', 'Dear test, Your appointment on 2023-12-13 at 10:00 AM in Epilworld is now Approved. Your booking id is #51682. Thank you.', '2023-12-11 04:29:01', '2023-12-11 04:29:01'),
(49, 6, 27, 'Booking status', 'Dear test, Your appointment on 2023-12-13 at 10:00 AM in Epilworld is now Completed. Your booking id is #51682. Thank you.', '2023-12-11 04:29:05', '2023-12-11 04:29:05'),
(50, 6, 27, 'Booking status', 'Dear test, Your appointment on 2023-12-13 at 10:00 AM in Epilworld is now Approved. Your booking id is #51682. Thank you.', '2023-12-11 04:29:15', '2023-12-11 04:29:15'),
(51, 6, 27, 'Booking status', 'Dear test, Your appointment on 2023-12-13 at 10:00 AM in Epilworld is now Completed. Your booking id is #51682. Thank you.', '2023-12-11 04:29:23', '2023-12-11 04:29:23'),
(52, 6, 27, 'Booking status', 'Dear test, Your appointment on 2023-12-13 at 10:00 AM in Epilworld is now Approved. Your booking id is #51682. Thank you.', '2023-12-11 04:40:22', '2023-12-11 04:40:22'),
(53, 6, 27, 'Booking status', 'Dear test, Your appointment on 2023-12-13 at 10:00 AM in Epilworld is now Cancel. Your booking id is #51682. Thank you.', '2023-12-11 04:40:26', '2023-12-11 04:40:26'),
(54, 6, 27, 'Booking status', 'Dear test, Your appointment on 2023-12-13 at 10:00 AM in Epilworld is now Completed. Your booking id is #51682. Thank you.', '2023-12-11 04:40:27', '2023-12-11 04:40:27'),
(55, 7, 28, 'Appointment Created', 'Dear mohamed barrah, Your appointment is successfully created on 2023-12-14 at 10:00 AM in Epilworld. Your booking id is #44428. Thank you.', '2023-12-11 04:55:33', '2023-12-11 04:55:33'),
(56, 7, 28, 'Booking status', 'Dear mohamed barrah, Your appointment on 2023-12-18 at 10:00 AM in Epilworld is now Completed. Your booking id is #44428. Thank you.', '2023-12-11 04:59:11', '2023-12-11 04:59:11'),
(57, 7, 28, 'Booking status', 'Dear mohamed barrah, Your appointment on 2023-12-18 at 10:00 AM in Epilworld is now Approved. Your booking id is #44428. Thank you.', '2023-12-11 04:59:14', '2023-12-11 04:59:14'),
(58, 7, 28, 'Booking status', 'Dear mohamed barrah, Your appointment on 2023-12-18 at 10:00 AM in Epilworld is now Completed. Your booking id is #44428. Thank you.', '2023-12-11 04:59:17', '2023-12-11 04:59:17'),
(59, 7, 28, 'Booking status', 'Dear mohamed barrah, Your appointment on 2023-12-18 at 10:00 AM in Epilworld is now Cancel. Your booking id is #44428. Thank you.', '2023-12-11 12:13:33', '2023-12-11 12:13:33'),
(60, 7, 28, 'Booking status', 'Dear mohamed barrah, Your appointment on 2023-12-18 at 10:00 AM in Epilworld is now Approved. Your booking id is #44428. Thank you.', '2023-12-11 12:13:34', '2023-12-11 12:13:34'),
(61, 6, 27, 'Booking status', 'Dear test, Your appointment on 2023-12-13 at 10:00 AM in Epilworld is now Approved. Your booking id is #51682. Thank you.', '2023-12-11 12:13:39', '2023-12-11 12:13:39'),
(62, 7, 28, 'Booking status', 'Dear mohamed barrah, Your appointment on 2023-12-18 at 10:00 AM in Epilworld is now Cancel. Your booking id is #44428. Thank you.', '2023-12-11 12:13:42', '2023-12-11 12:13:42'),
(63, 7, 28, 'Booking status', 'Dear mohamed barrah, Your appointment on 2023-12-18 at 10:00 AM in Epilworld is now Completed. Your booking id is #44428. Thank you.', '2023-12-11 12:13:44', '2023-12-11 12:13:44'),
(64, 7, 28, 'Booking status', 'Dear mohamed barrah, Your appointment on 2023-12-18 at 10:00 AM in Epilworld is now Cancel. Your booking id is #44428. Thank you.', '2023-12-11 12:13:53', '2023-12-11 12:13:53'),
(65, 6, 27, 'Booking status', 'Dear test, Your appointment on 2023-12-13 at 10:00 AM in Epilworld is now Completed. Your booking id is #51682. Thank you.', '2023-12-11 12:13:55', '2023-12-11 12:13:55'),
(66, 7, 28, 'Booking status', 'Dear mohamed barrah, Your appointment on 2023-12-18 at 10:00 AM in Epilworld is now Completed. Your booking id is #44428. Thank you.', '2023-12-11 12:13:57', '2023-12-11 12:13:57'),
(67, 7, 28, 'Booking status', 'Dear mohamed barrah, Your appointment on 2023-12-18 at 10:00 AM in Epilworld is now Cancel. Your booking id is #44428. Thank you.', '2023-12-11 12:13:59', '2023-12-11 12:13:59'),
(68, 6, 27, 'Booking status', 'Dear test, Your appointment on 2023-12-13 at 10:00 AM in Epilworld is now Cancel. Your booking id is #51682. Thank you.', '2023-12-11 12:14:01', '2023-12-11 12:14:01'),
(69, 6, 27, 'Booking status', 'Dear test, Your appointment on 2023-12-13 at 10:00 AM in Epilworld is now Approved. Your booking id is #51682. Thank you.', '2023-12-11 12:14:02', '2023-12-11 12:14:02'),
(70, 6, 27, 'Booking status', 'Dear test, Your appointment on 2023-12-13 at 10:00 AM in Epilworld is now Cancel. Your booking id is #51682. Thank you.', '2023-12-11 12:14:04', '2023-12-11 12:14:04'),
(71, 6, 27, 'Booking status', 'Dear test, Your appointment on 2023-12-13 at 10:00 AM in Epilworld is now Approved. Your booking id is #51682. Thank you.', '2023-12-11 12:14:05', '2023-12-11 12:14:05'),
(72, 7, 28, 'Booking status', 'Dear mohamed barrah, Your appointment on 2023-12-18 at 10:00 AM in Epilworld is now Approved. Your booking id is #44428. Thank you.', '2023-12-11 12:14:07', '2023-12-11 12:14:07'),
(73, 7, 28, 'Booking status', 'Dear mohamed barrah, Your appointment on 2023-12-18 at 10:00 AM in Epilworld is now Completed. Your booking id is #44428. Thank you.', '2023-12-11 12:14:09', '2023-12-11 12:14:09'),
(74, 7, 28, 'Booking status', 'Dear mohamed barrah, Your appointment on 2023-12-18 at 10:00 AM in Epilworld is now Approved. Your booking id is #44428. Thank you.', '2023-12-11 12:14:11', '2023-12-11 12:14:11'),
(75, 7, 28, 'Booking status', 'Dear mohamed barrah, Your appointment on 2023-12-18 at 10:00 AM in Epilworld is now Completed. Your booking id is #44428. Thank you.', '2023-12-11 12:14:13', '2023-12-11 12:14:13'),
(76, 7, 28, 'Booking status', 'Dear mohamed barrah, Your appointment on 2023-12-18 at 10:00 AM in Epilworld is now Cancel. Your booking id is #44428. Thank you.', '2023-12-11 12:14:18', '2023-12-11 12:14:18'),
(77, 6, 27, 'Booking status', 'Dear test, Your appointment on 2023-12-13 at 10:00 AM in Epilworld is now Completed. Your booking id is #51682. Thank you.', '2023-12-11 12:14:22', '2023-12-11 12:14:22'),
(78, 7, 28, 'Booking status', 'Dear mohamed barrah, Your appointment on 2023-12-18 at 10:00 AM in Epilworld is now Approved. Your booking id is #44428. Thank you.', '2023-12-11 12:14:23', '2023-12-11 12:14:23'),
(79, 7, 28, 'Booking status', 'Dear mohamed barrah, Your appointment on 2023-12-18 at 10:00 AM in Epilworld is now Completed. Your booking id is #44428. Thank you.', '2023-12-11 12:19:38', '2023-12-11 12:19:38'),
(80, 7, 28, 'Booking status', 'Dear mohamed barrah, Your appointment on 2023-12-18 at 10:00 AM in Epilworld is now Cancel. Your booking id is #44428. Thank you.', '2023-12-11 12:19:39', '2023-12-11 12:19:39'),
(81, 7, 28, 'Booking status', 'Dear mohamed barrah, Your appointment on 2023-12-18 at 10:00 AM in Epilworld is now Approved. Your booking id is #44428. Thank you.', '2023-12-11 12:21:08', '2023-12-11 12:21:08'),
(82, 7, 28, 'Booking status', 'Dear mohamed barrah, Your appointment on 2023-12-18 at 10:00 AM in Epilworld is now Completed. Your booking id is #44428. Thank you.', '2023-12-11 12:21:09', '2023-12-11 12:21:09'),
(83, 7, 28, 'Booking status', 'Dear mohamed barrah, Your appointment on 2023-12-18 at 10:00 AM in Epilworld is now Cancel. Your booking id is #44428. Thank you.', '2023-12-11 12:21:10', '2023-12-11 12:21:10'),
(84, 6, 27, 'Booking status', 'Dear test, Your appointment on 2023-12-13 at 10:00 AM in Epilworld is now Cancel. Your booking id is #51682. Thank you.', '2023-12-11 12:21:33', '2023-12-11 12:21:33'),
(85, 6, 27, 'Booking status', 'Dear test, Your appointment on 2023-12-13 at 10:00 AM in Epilworld is now Completed. Your booking id is #51682. Thank you.', '2023-12-11 12:21:35', '2023-12-11 12:21:35'),
(86, 6, 27, 'Booking status', 'Dear test, Your appointment on 2023-12-13 at 10:00 AM in Epilworld is now Cancel. Your booking id is #51682. Thank you.', '2023-12-11 12:21:36', '2023-12-11 12:21:36'),
(87, 7, 28, 'Booking status', 'Dear mohamed barrah, Your appointment on 2023-12-18 at 10:00 AM in Epilworld is now Approved. Your booking id is #44428. Thank you.', '2023-12-11 12:21:38', '2023-12-11 12:21:38'),
(88, 7, 28, 'Booking status', 'Dear mohamed barrah, Your appointment on 2023-12-18 at 10:00 AM in Epilworld is now Completed. Your booking id is #44428. Thank you.', '2023-12-11 12:21:45', '2023-12-11 12:21:45'),
(89, 7, 28, 'Booking status', 'Dear mohamed barrah, Your appointment on 2023-12-18 at 10:00 AM in Epilworld is now Cancel. Your booking id is #44428. Thank you.', '2023-12-11 12:21:47', '2023-12-11 12:21:47'),
(90, 6, 27, 'Booking status', 'Dear test, Your appointment on 2023-12-13 at 10:00 AM in Epilworld is now Approved. Your booking id is #51682. Thank you.', '2023-12-11 12:21:50', '2023-12-11 12:21:50'),
(91, 7, 28, 'Booking status', 'Dear mohamed barrah, Your appointment on 2023-12-18 at 10:00 AM in Epilworld is now Completed. Your booking id is #44428. Thank you.', '2023-12-11 12:21:53', '2023-12-11 12:21:53'),
(92, 7, 28, 'Booking status', 'Dear mohamed barrah, Your appointment on 2023-12-18 at 10:00 AM in Epilworld is now Cancel. Your booking id is #44428. Thank you.', '2023-12-11 12:21:55', '2023-12-11 12:21:55'),
(93, 6, 27, 'Booking status', 'Dear test, Your appointment on 2023-12-13 at 10:00 AM in Epilworld is now Completed. Your booking id is #51682. Thank you.', '2023-12-11 12:21:57', '2023-12-11 12:21:57'),
(94, 7, 28, 'Booking status', 'Dear mohamed barrah, Your appointment on 2023-12-18 at 10:00 AM in Epilworld is now Approved. Your booking id is #44428. Thank you.', '2023-12-11 12:22:02', '2023-12-11 12:22:02'),
(95, 7, 28, 'Booking status', 'Dear mohamed barrah, Your appointment on 2023-12-18 at 10:00 AM in Epilworld is now Completed. Your booking id is #44428. Thank you.', '2023-12-11 12:22:06', '2023-12-11 12:22:06'),
(96, 7, 28, 'Booking status', 'Dear mohamed barrah, Your appointment on 2023-12-18 at 10:00 AM in Epilworld is now Cancel. Your booking id is #44428. Thank you.', '2023-12-11 12:22:08', '2023-12-11 12:22:08'),
(97, 7, 28, 'Booking status', 'Dear mohamed barrah, Your appointment on 2023-12-18 at 10:00 AM in Epilworld is now Completed. Your booking id is #44428. Thank you.', '2023-12-11 12:22:09', '2023-12-11 12:22:09'),
(98, 7, 28, 'Booking status', 'Dear mohamed barrah, Your appointment on 2023-12-18 at 10:00 AM in Epilworld is now Approved. Your booking id is #44428. Thank you.', '2023-12-11 12:22:11', '2023-12-11 12:22:11'),
(99, 7, 28, 'Booking status', 'Dear mohamed barrah, Your appointment on 2023-12-18 at 10:00 AM in Epilworld is now Cancel. Your booking id is #44428. Thank you.', '2023-12-11 12:22:12', '2023-12-11 12:22:12'),
(100, 7, 28, 'Booking status', 'Dear mohamed barrah, Your appointment on 2023-12-18 at 10:00 AM in Epilworld is now Completed. Your booking id is #44428. Thank you.', '2023-12-11 12:22:14', '2023-12-11 12:22:14'),
(101, 7, 28, 'Booking status', 'Dear mohamed barrah, Your appointment on 2023-12-18 at 10:00 AM in Epilworld is now Completed. Your booking id is #44428. Thank you.', '2023-12-11 14:14:00', '2023-12-11 14:14:00'),
(102, 12, 29, 'Appointment Created', 'Dear 8888888888, Your appointment is successfully created on 2023-12-12 at 10:00 AM in Epilworld. Your booking id is #47807. Thank you.', '2023-12-11 14:16:55', '2023-12-11 14:16:55'),
(103, 12, 29, 'Booking status', 'Dear 8888888888, Your appointment on 2023-12-12 at 10:00 AM in Epilworld is now Completed. Your booking id is #47807. Thank you.', '2023-12-11 14:17:08', '2023-12-11 14:17:08'),
(104, 12, 29, 'Booking status', 'Dear 8888888888, Your appointment on 2023-12-12 at 10:00 AM in Epilworld is now Approved. Your booking id is #47807. Thank you.', '2023-12-11 14:17:38', '2023-12-11 14:17:38'),
(105, 12, 29, 'Booking status', 'Dear 8888888888, Your appointment on 2023-12-12 at 10:00 AM in Epilworld is now Completed. Your booking id is #47807. Thank you.', '2023-12-11 14:17:51', '2023-12-11 14:17:51'),
(106, 12, 29, 'Booking status', 'Dear 8888888888, Your appointment on 2023-12-12 at 10:00 AM in Epilworld is now Completed. Your booking id is #47807. Thank you.', '2023-12-11 14:19:30', '2023-12-11 14:19:30'),
(107, 11, 30, 'Appointment Created', 'Dear dsaa, Your appointment is successfully created on 2023-12-14 at 10:30 AM in Epilworld. Your booking id is #64702. Thank you.', '2023-12-11 14:36:33', '2023-12-11 14:36:33'),
(108, 11, 30, 'Booking status', 'Dear dsaa, Your appointment on 2023-12-14 at 03:00 PM in Epilworld is now Completed. Your booking id is #64702. Thank you.', '2023-12-11 14:37:58', '2023-12-11 14:37:58'),
(109, 7, 31, 'Appointment Created', 'Dear mohamed barrah, Your appointment is successfully created on 2023-12-14 at 11:00 AM in Epilworld. Your booking id is #85957. Thank you.', '2023-12-11 14:39:32', '2023-12-11 14:39:32'),
(110, 7, 31, 'Booking status', 'Dear mohamed barrah, Your appointment on 2023-12-14 at 11:00 AM in Epilworld is now Completed. Your booking id is #85957. Thank you.', '2023-12-11 14:51:54', '2023-12-11 14:51:54'),
(111, 7, 31, 'Booking status', 'Dear mohamed barrah, Your appointment on 2023-12-14 at 11:00 AM in Epilworld is now Approved. Your booking id is #85957. Thank you.', '2023-12-11 14:51:56', '2023-12-11 14:51:56'),
(112, 6, 32, 'Appointment Created', 'Dear test, Your appointment is successfully created on 2023-12-12 at 10:30 AM in Epilworld. Your booking id is #10128. Thank you.', '2023-12-11 14:55:58', '2023-12-11 14:55:58'),
(113, 7, 28, 'Booking status', 'Dear mohamed barrah, Your appointment on 2023-12-18 at 10:00 AM in Epilworld is now Completed. Your booking id is #44428. Thank you.', '2023-12-11 14:57:04', '2023-12-11 14:57:04'),
(114, 6, 32, 'Booking status', 'Dear test, Your appointment on 2023-12-12 at 10:30 AM in Epilworld is now Completed. Your booking id is #10128. Thank you.', '2023-12-11 15:08:38', '2023-12-11 15:08:38'),
(115, 12, 33, 'Appointment Created', 'Dear 8888888888, Your appointment is successfully created on 2023-12-12 at 10:00 AM in Epilworld. Your booking id is #64289. Thank you.', '2023-12-11 15:52:56', '2023-12-11 15:52:56'),
(116, 12, 33, 'Booking status', 'Dear 8888888888, Your appointment on 2023-12-12 at 10:00 AM in Epilworld is now Completed. Your booking id is #64289. Thank you.', '2023-12-11 15:53:24', '2023-12-11 15:53:24'),
(117, 12, 33, 'Booking status', 'Dear 8888888888, Your appointment on 2023-12-12 at 10:00 AM in Epilworld is now Approved. Your booking id is #64289. Thank you.', '2023-12-11 16:02:04', '2023-12-11 16:02:04'),
(118, 12, 33, 'Booking status', 'Dear 8888888888, Your appointment on 2023-12-12 at 10:00 AM in Epilworld is now Cancel. Your booking id is #64289. Thank you.', '2023-12-11 16:02:10', '2023-12-11 16:02:10'),
(119, 12, 33, 'Booking status', 'Dear 8888888888, Your appointment on 2023-12-12 at 10:00 AM in Epilworld is now Completed. Your booking id is #64289. Thank you.', '2023-12-11 16:02:20', '2023-12-11 16:02:20'),
(120, 10, 34, 'Appointment Created', 'Dear testte, Your appointment is successfully created on 2023-12-13 at 10:00 AM in Epilworld. Your booking id is #13164. Thank you.', '2023-12-11 16:03:00', '2023-12-11 16:03:00'),
(121, 10, 34, 'Booking status', 'Dear testte, Your appointment on 2023-12-13 at 10:00 AM in Epilworld is now Completed. Your booking id is #13164. Thank you.', '2023-12-11 16:03:28', '2023-12-11 16:03:28'),
(122, 10, 34, 'Booking status', 'Dear testte, Your appointment on 2023-12-13 at 10:00 AM in Epilworld is now Approved. Your booking id is #13164. Thank you.', '2023-12-11 16:03:31', '2023-12-11 16:03:31'),
(123, 10, 34, 'Booking status', 'Dear testte, Your appointment on 2023-12-13 at 10:00 AM in Epilworld is now Cancel. Your booking id is #13164. Thank you.', '2023-12-11 16:03:32', '2023-12-11 16:03:32'),
(124, 10, 34, 'Booking status', 'Dear testte, Your appointment on 2023-12-13 at 10:00 AM in Epilworld is now Completed. Your booking id is #13164. Thank you.', '2023-12-11 16:03:34', '2023-12-11 16:03:34'),
(125, 10, 34, 'Booking status', 'Dear testte, Your appointment on 2023-12-13 at 10:00 AM in Epilworld is now Approved. Your booking id is #13164. Thank you.', '2023-12-11 16:03:43', '2023-12-11 16:03:43'),
(126, 10, 34, 'Booking status', 'Dear testte, Your appointment on 2023-12-13 at 10:00 AM in Epilworld is now Completed. Your booking id is #13164. Thank you.', '2023-12-11 16:03:46', '2023-12-11 16:03:46'),
(127, 6, 35, 'Appointment Created', 'Dear test, Your appointment is successfully created on 2023-12-12 at 10:30 AM in Epilworld. Your booking id is #90185. Thank you.', '2023-12-11 16:12:10', '2023-12-11 16:12:10'),
(128, 5, 36, 'Appointment Created', 'Dear Sara Sara, Your appointment is successfully created on 2023-12-16 at 10:00 AM in Epilworld. Your booking id is #45801. Thank you.', '2023-12-11 16:12:47', '2023-12-11 16:12:47'),
(129, 5, 36, 'Booking status', 'Dear Sara Sara, Your appointment on 2023-12-16 at 10:00 AM in Epilworld is now Completed. Your booking id is #45801. Thank you.', '2023-12-11 16:13:08', '2023-12-11 16:13:08'),
(130, 12, 33, 'Booking status', 'Dear 8888888888, Your appointment on 2023-12-15 at 10:00 AM in Epilworld is now Completed. Your booking id is #64289. Thank you.', '2023-12-11 16:13:11', '2023-12-11 16:13:11'),
(131, 8, 37, 'Appointment Created', 'Dear mohamed barrah, Your appointment is successfully created on 2023-12-20 at 10:30 AM in Epilworld. Your booking id is #81217. Thank you.', '2023-12-11 16:26:53', '2023-12-11 16:26:53'),
(132, 8, 37, 'Booking status', 'Dear mohamed barrah, Your appointment on 2023-12-20 at 10:30 AM in Epilworld is now Completed. Your booking id is #81217. Thank you.', '2023-12-11 16:27:07', '2023-12-11 16:27:07'),
(133, 8, 37, 'Booking status', 'Dear mohamed barrah, Your appointment on 2023-12-20 at 10:30 AM in Epilworld is now Approved. Your booking id is #81217. Thank you.', '2023-12-11 16:27:29', '2023-12-11 16:27:29'),
(134, 8, 37, 'Booking status', 'Dear mohamed barrah, Your appointment on 2023-12-20 at 10:30 AM in Epilworld is now Completed. Your booking id is #81217. Thank you.', '2023-12-11 16:27:35', '2023-12-11 16:27:35'),
(135, 8, 37, 'Booking status', 'Dear mohamed barrah, Your appointment on 2023-12-20 at 10:30 AM in Epilworld is now Approved. Your booking id is #81217. Thank you.', '2023-12-11 16:27:39', '2023-12-11 16:27:39'),
(136, 8, 37, 'Booking status', 'Dear mohamed barrah, Your appointment on 2023-12-20 at 10:30 AM in Epilworld is now Completed. Your booking id is #81217. Thank you.', '2023-12-11 16:27:52', '2023-12-11 16:27:52'),
(137, 8, 37, 'Booking status', 'Dear mohamed barrah, Your appointment on 2023-12-20 at 10:30 AM in Epilworld is now Approved. Your booking id is #81217. Thank you.', '2023-12-11 16:27:54', '2023-12-11 16:27:54'),
(138, 8, 37, 'Booking status', 'Dear mohamed barrah, Your appointment on 2023-12-20 at 10:30 AM in Epilworld is now Completed. Your booking id is #81217. Thank you.', '2023-12-11 16:27:56', '2023-12-11 16:27:56'),
(139, 6, 38, 'Appointment Created', 'Dear test, Your appointment is successfully created on 2023-12-28 at 10:30 AM in Epilworld. Your booking id is #39444. Thank you.', '2023-12-11 22:25:06', '2023-12-11 22:25:06'),
(140, 7, 39, 'Appointment Created', 'Dear mohamed barrah, Your appointment is successfully created on 2023-12-12 at 10:00 AM in Epilworld. Your booking id is #57454. Thank you.', '2023-12-11 22:30:40', '2023-12-11 22:30:40'),
(141, 11, 40, 'Appointment Created', 'Dear dsaa, Your appointment is successfully created on 2023-12-12 at 10:30 AM in Epilworld. Your booking id is #13194. Thank you.', '2023-12-11 22:31:05', '2023-12-11 22:31:05'),
(142, 7, 41, 'Appointment Created', 'Dear mohamed barrah, Your appointment is successfully created on 2023-12-12 at 10:00 AM in Epilworld. Your booking id is #37462. Thank you.', '2023-12-11 22:38:17', '2023-12-11 22:38:17'),
(143, 12, 33, 'Booking status', 'Dear 8888888888, Your appointment on 2023-12-15 at 10:00 AM in Epilworld is now Approved. Your booking id is #64289. Thank you.', '2023-12-11 22:56:47', '2023-12-11 22:56:47'),
(144, 12, 33, 'Booking status', 'Dear 8888888888, Your appointment on 2023-12-15 at 10:00 AM in Epilworld is now Completed. Your booking id is #64289. Thank you.', '2023-12-11 22:57:38', '2023-12-11 22:57:38'),
(145, 12, 33, 'Booking status', 'Dear 8888888888, Your appointment on 2023-12-15 at 10:00 AM in Epilworld is now Approved. Your booking id is #64289. Thank you.', '2023-12-11 22:58:17', '2023-12-11 22:58:17'),
(146, 11, 40, 'Booking status', 'Dear dsaa, Your appointment on 2023-12-12 at 10:30 AM in Epilworld is now Completed. Your booking id is #13194. Thank you.', '2023-12-11 23:53:58', '2023-12-11 23:53:58'),
(147, 7, 41, 'Booking status', 'Dear mohamed barrah, Your appointment on 2023-12-12 at 10:00 AM in Epilworld is now Completed. Your booking id is #37462. Thank you.', '2023-12-11 23:54:01', '2023-12-11 23:54:01'),
(148, 7, 39, 'Booking status', 'Dear mohamed barrah, Your appointment on 2023-12-12 at 10:00 AM in Epilworld is now Completed. Your booking id is #57454. Thank you.', '2023-12-11 23:54:30', '2023-12-11 23:54:30'),
(149, 7, 41, 'Booking status', 'Dear mohamed barrah, Your appointment on 2023-12-12 at 10:00 AM in Epilworld is now Approved. Your booking id is #37462. Thank you.', '2023-12-11 23:57:34', '2023-12-11 23:57:34'),
(150, 11, 40, 'Booking status', 'Dear dsaa, Your appointment on 2023-12-12 at 10:30 AM in Epilworld is now Approved. Your booking id is #13194. Thank you.', '2023-12-11 23:57:36', '2023-12-11 23:57:36'),
(151, 7, 39, 'Booking status', 'Dear mohamed barrah, Your appointment on 2023-12-12 at 10:00 AM in Epilworld is now Approved. Your booking id is #57454. Thank you.', '2023-12-11 23:57:37', '2023-12-11 23:57:37'),
(152, 5, 36, 'Booking status', 'Dear Sara Sara, Your appointment on 2023-12-12 at 10:00 AM in Epilworld is now Completed. Your booking id is #45801. Thank you.', '2023-12-12 00:24:01', '2023-12-12 00:24:01'),
(153, 11, 40, 'Booking status', 'Dear dsaa, Your appointment on 2023-12-12 at 10:30 AM in Epilworld is now Completed. Your booking id is #13194. Thank you.', '2023-12-12 00:24:04', '2023-12-12 00:24:04'),
(154, 6, 42, 'Appointment Created', 'Dear test, Your appointment is successfully created on 2023-12-12 at 10:00 AM in Epilworld. Your booking id is #96864. Thank you.', '2023-12-12 00:25:07', '2023-12-12 00:25:07'),
(155, 9, 43, 'Appointment Created', 'Dear mohamed barrah, Your appointment is successfully created on 2023-12-12 at 10:00 AM in Epilworld. Your booking id is #21950. Thank you.', '2023-12-12 01:38:22', '2023-12-12 01:38:22'),
(156, 6, 44, 'Appointment Created', 'Dear test, Your appointment is successfully created on 2023-12-12 at 10:30 AM in Epilworld. Your booking id is #31095. Thank you.', '2023-12-12 02:50:30', '2023-12-12 02:50:30'),
(157, 6, 45, 'Appointment Created', 'Dear test, Your appointment is successfully created on 2023-12-13 at 10:00 AM in Epilworld. Your booking id is #55504. Thank you.', '2023-12-12 02:59:18', '2023-12-12 02:59:18'),
(158, 6, 45, 'Booking status', 'Dear test, Your appointment on 2023-12-13 at 10:00 AM in Epilworld is now Completed. Your booking id is #55504. Thank you.', '2023-12-12 03:27:02', '2023-12-12 03:27:02'),
(159, 6, 45, 'Booking status', 'Dear test, Your appointment on 2023-12-13 at 10:00 AM in Epilworld is now Approved. Your booking id is #55504. Thank you.', '2023-12-12 04:11:40', '2023-12-12 04:11:40'),
(160, 5, 46, 'Appointment Created', 'Dear Sara Sara, Your appointment is successfully created on 2023-12-12 at 10:00 AM in Epilworld. Your booking id is #36350. Thank you.', '2023-12-12 04:45:37', '2023-12-12 04:45:37'),
(161, 12, 47, 'Appointment Created', 'Dear 8888888888, Your appointment is successfully created on 2023-12-12 at 10:00 AM in Epilworld. Your booking id is #63893. Thank you.', '2023-12-12 04:46:25', '2023-12-12 04:46:25'),
(162, 12, 47, 'Booking status', 'Dear 8888888888, Your appointment on 2023-12-12 at 10:00 AM in Epilworld is now Completed. Your booking id is #63893. Thank you.', '2023-12-12 04:46:38', '2023-12-12 04:46:38'),
(163, 5, 46, 'Booking status', 'Dear Sara Sara, Your appointment on 2023-12-12 at 10:00 AM in Epilworld is now Completed. Your booking id is #36350. Thank you.', '2023-12-12 15:48:06', '2023-12-12 15:48:06'),
(164, 7, 48, 'Appointment Created', 'Dear mohamed barrah, Your appointment is successfully created on 2023-12-13 at 10:00 AM in Epilworld. Your booking id is #35519. Thank you.', '2023-12-12 15:49:01', '2023-12-12 15:49:01'),
(165, 8, 49, 'Appointment Created', 'Dear my_test, Your appointment is successfully created on 2023-12-13 at 10:00 AM in Epilworld. Your booking id is #43432. Thank you.', '2023-12-12 15:49:33', '2023-12-12 15:49:33'),
(166, 9, 50, 'Appointment Created', 'Dear blalala, Your appointment is successfully created on 2023-12-13 at 02:00 PM in Epilworld. Your booking id is #46906. Thank you.', '2023-12-12 15:53:06', '2023-12-12 15:53:06'),
(167, 6, 51, 'Appointment Created', 'Dear test, Your appointment is successfully created on 2023-12-13 at 10:00 AM in Epilworld. Your booking id is #87616. Thank you.', '2023-12-12 16:04:15', '2023-12-12 16:04:15'),
(168, 10, 52, 'Appointment Created', 'Dear row, Your appointment is successfully created on 2023-12-13 at 10:00 AM in Epilworld. Your booking id is #84590. Thank you.', '2023-12-12 16:05:16', '2023-12-12 16:05:16'),
(169, 7, 53, 'Appointment Created', 'Dear mohamed barrah, Your appointment is successfully created on 2023-12-13 at 10:00 AM in Epilworld. Your booking id is #53185. Thank you.', '2023-12-12 16:07:24', '2023-12-12 16:07:24'),
(170, 6, 54, 'Appointment Created', 'Dear test, Your appointment is successfully created on 2023-12-13 at 10:00 AM in Epilworld. Your booking id is #11665. Thank you.', '2023-12-12 16:07:53', '2023-12-12 16:07:53'),
(171, 8, 55, 'Appointment Created', 'Dear my_test, Your appointment is successfully created on 2023-12-13 at 10:00 AM in Epilworld. Your booking id is #42333. Thank you.', '2023-12-12 16:09:20', '2023-12-12 16:09:20'),
(172, 8, 55, 'Booking status', 'Dear my_test, Your appointment on 2023-12-13 at 10:00 AM in Epilworld is now Completed. Your booking id is #42333. Thank you.', '2023-12-12 16:31:30', '2023-12-12 16:31:30'),
(173, 8, 55, 'Booking status', 'Dear my_test, Your appointment on 2023-12-13 at 10:00 AM in Epilworld is now Approved. Your booking id is #42333. Thank you.', '2023-12-12 16:32:20', '2023-12-12 16:32:20'),
(174, 6, 56, 'Appointment Created', 'Dear test, Your appointment is successfully created on 2023-12-14 at 10:00 AM in Epilworld. Your booking id is #35735. Thank you.', '2023-12-12 16:45:05', '2023-12-12 16:45:05'),
(175, 6, 56, 'Booking status', 'Dear test, Your appointment on 2023-12-14 at 10:00 AM in Epilworld is now Completed. Your booking id is #35735. Thank you.', '2023-12-12 16:58:27', '2023-12-12 16:58:27'),
(176, 16, 57, 'Appointment Created', 'Dear oooooo, Your appointment is successfully created on 2023-12-13 at 10:00 AM in Epilworld. Your booking id is #93209. Thank you.', '2023-12-13 02:09:17', '2023-12-13 02:09:17'),
(177, 12, 58, 'Appointment Created', 'Dear 8888888888, Your appointment is successfully created on 2023-12-13 at 10:30 AM in Epilworld. Your booking id is #76917. Thank you.', '2023-12-13 02:12:56', '2023-12-13 02:12:56'),
(178, 6, 59, 'Appointment Created', 'Dear test, Your appointment is successfully created on 2023-12-13 at 03:00 PM in Epilworld. Your booking id is #70863. Thank you.', '2023-12-13 02:13:54', '2023-12-13 02:13:54'),
(179, 6, 59, 'Booking status', 'Dear test, Your appointment on 2023-12-13 at 03:00 PM in Epilworld is now Completed. Your booking id is #70863. Thank you.', '2023-12-13 02:14:23', '2023-12-13 02:14:23'),
(180, 6, 59, 'Booking status', 'Dear test, Your appointment on 2023-12-13 at 03:00 PM in Epilworld is now in session. Your booking id is #70863. Thank you.', '2023-12-13 17:16:03', '2023-12-13 17:16:03'),
(181, 6, 59, 'Booking status', 'Dear test, Your appointment on 2023-12-22 at 10:00 AM in Epilworld is now in session. Your booking id is #70863. Thank you.', '2023-12-13 21:12:37', '2023-12-13 21:12:37'),
(182, 12, 58, 'Booking status', 'Dear 8888888888, Your appointment on 2023-12-13 at 10:30 AM in Epilworld is now Cancel. Your booking id is #76917. Thank you.', '2023-12-13 22:23:57', '2023-12-13 22:23:57'),
(183, 12, 58, 'Booking status', 'Dear 8888888888, Your appointment on 2023-12-13 at 10:30 AM in Epilworld is now in session. Your booking id is #76917. Thank you.', '2023-12-13 22:23:58', '2023-12-13 22:23:58'),
(184, 12, 58, 'Booking status', 'Dear 8888888888, Your appointment on 2023-12-13 at 10:30 AM in Epilworld is now Completed. Your booking id is #76917. Thank you.', '2023-12-13 22:23:59', '2023-12-13 22:23:59'),
(185, 12, 58, 'Booking status', 'Dear 8888888888, Your appointment on 2023-12-13 at 10:30 AM in Epilworld is now Approved. Your booking id is #76917. Thank you.', '2023-12-13 22:24:01', '2023-12-13 22:24:01'),
(186, 12, 58, 'Booking status', 'Dear 8888888888, Your appointment on 2023-12-13 at 10:30 AM in Epilworld is now in session. Your booking id is #76917. Thank you.', '2023-12-13 22:24:03', '2023-12-13 22:24:03'),
(187, 12, 58, 'Booking status', 'Dear 8888888888, Your appointment on 2023-12-13 at 10:30 AM in Epilworld is now Approved. Your booking id is #76917. Thank you.', '2023-12-13 22:24:05', '2023-12-13 22:24:05'),
(188, 6, 60, 'Appointment Created', 'Dear test, Your appointment is successfully created on 2023-12-15 at 10:30 AM in Epilworld. Your booking id is #88894. Thank you.', '2023-12-14 23:07:34', '2023-12-14 23:07:34'),
(189, 5, 61, 'Appointment Created', 'Dear Sara Sara, Your appointment is successfully created on 2023-12-15 at 12:30 PM in Epilworld. Your booking id is #39683. Thank you.', '2023-12-14 23:50:59', '2023-12-14 23:50:59'),
(190, 6, 60, 'Booking status', 'Dear test, Your appointment on 2023-12-15 at 10:30 AM in Epilworld is now in session. Your booking id is #88894. Thank you.', '2023-12-15 00:28:37', '2023-12-15 00:28:37'),
(191, 5, 61, 'Booking status', 'Dear Sara Sara, Your appointment on 2023-12-15 at 12:30 PM in Epilworld is now Cancel. Your booking id is #39683. Thank you.', '2023-12-15 00:31:49', '2023-12-15 00:31:49'),
(192, 5, 61, 'Booking status', 'Dear Sara Sara, Your appointment on 2023-12-15 at 12:30 PM in Epilworld is now Completed. Your booking id is #39683. Thank you.', '2023-12-15 00:32:10', '2023-12-15 00:32:10'),
(193, 5, 61, 'Booking status', 'Dear Sara Sara, Your appointment on 2023-12-15 at 12:30 PM in Epilworld is now Approved. Your booking id is #39683. Thank you.', '2023-12-15 00:32:23', '2023-12-15 00:32:23'),
(194, 12, 62, 'Appointment Created', 'Dear 8888888888, Your appointment is successfully created on 2023-12-15 at 10:00 AM in Epilworld. Your booking id is #49620. Thank you.', '2023-12-15 00:40:19', '2023-12-15 00:40:19'),
(195, 12, 62, 'Booking status', 'Dear 8888888888, Your appointment on 2023-12-15 at 01:30 PM in Epilworld is now Cancel. Your booking id is #49620. Thank you.', '2023-12-15 04:42:46', '2023-12-15 04:42:46'),
(196, 15, 63, 'Appointment Created', 'Dear testsss, Your appointment is successfully created on 2023-12-15 at 10:00 AM in Epilworld. Your booking id is #56772. Thank you.', '2023-12-15 04:44:00', '2023-12-15 04:44:00'),
(197, 15, 63, 'Booking status', 'Dear testsss, Your appointment on 2023-12-15 at 10:00 AM in Epilworld is now Completed. Your booking id is #56772. Thank you.', '2023-12-15 04:44:22', '2023-12-15 04:44:22'),
(198, 15, 63, 'Booking status', 'Dear testsss, Your appointment on 2023-12-15 at 11:00 AM in Epilworld is now in session. Your booking id is #56772. Thank you.', '2023-12-15 04:45:03', '2023-12-15 04:45:03'),
(199, 15, 63, 'Booking status', 'Dear testsss, Your appointment on 2023-12-15 at 11:00 AM in Epilworld is now Completed. Your booking id is #56772. Thank you.', '2023-12-15 04:51:48', '2023-12-15 04:51:48'),
(200, 12, 62, 'Booking status', 'Dear 8888888888, Your appointment on 2023-12-15 at 03:30 PM in Epilworld is now Cancel. Your booking id is #49620. Thank you.', '2023-12-15 16:30:47', '2023-12-15 16:30:47'),
(201, 16, 64, 'Appointment Created', 'Dear oooooo, Your appointment is successfully created on 2023-12-16 at 10:00 AM in Epilworld. Your booking id is #14635. Thank you.', '2023-12-15 16:33:18', '2023-12-15 16:33:18'),
(202, 6, 65, 'Appointment Created', 'Dear test, Your appointment is successfully created on 2023-12-16 at 10:00 AM in Epilworld. Your booking id is #46511. Thank you.', '2023-12-15 18:34:31', '2023-12-15 18:34:31'),
(203, 5, 66, 'Appointment Created', 'Dear Sara Sara, Your appointment is successfully created on 2023-12-19 at 10:30 AM in Epilworld. Your booking id is #16468. Thank you.', '2023-12-15 23:03:45', '2023-12-15 23:03:45'),
(204, 6, 67, 'Appointment Created', 'Dear test, Your appointment is successfully created on 2023-12-16 at 10:00 AM in Epilworld. Your booking id is #26469. Thank you.', '2023-12-15 23:16:56', '2023-12-15 23:16:56'),
(205, 6, 68, 'Appointment Created', 'Dear test, Your appointment is successfully created on 2023-12-16 at 10:00 AM in Epilworld. Your booking id is #59243. Thank you.', '2023-12-15 23:24:35', '2023-12-15 23:24:35'),
(206, 16, 69, 'Appointment Created', 'Dear oooooo, Your appointment is successfully created on 2023-12-20 at 10:00 AM in Epilworld. Your booking id is #46464. Thank you.', '2023-12-15 23:56:17', '2023-12-15 23:56:17'),
(207, 6, 70, 'Appointment Created', 'Dear test, Your appointment is successfully created on 2023-12-16 at 03:00 PM in Epilworld. Your booking id is #57672. Thank you.', '2023-12-16 00:07:07', '2023-12-16 00:07:07'),
(208, 6, 71, 'Appointment Created', 'Dear test, Your appointment is successfully created on 2023-12-16 at 12:00 PM in Epilworld. Your booking id is #35535. Thank you.', '2023-12-16 00:07:37', '2023-12-16 00:07:37'),
(209, 8, 72, 'Appointment Created', 'Dear my_test, Your appointment is successfully created on 2023-12-16 at 10:00 AM in Epilworld. Your booking id is #63544. Thank you.', '2023-12-16 00:50:54', '2023-12-16 00:50:54'),
(210, 16, 73, 'Appointment Created', 'Dear oooooo, Your appointment is successfully created on 2023-12-18 at 10:00 AM in Epilworld. Your booking id is #68371. Thank you.', '2023-12-16 00:52:05', '2023-12-16 00:52:05'),
(211, 16, 73, 'Booking status', 'Dear oooooo, Your appointment on 2023-12-18 at 10:00 AM in Epilworld is now Completed. Your booking id is #68371. Thank you.', '2023-12-16 21:40:35', '2023-12-16 21:40:35'),
(212, 6, 74, 'Appointment Created', 'Dear test, Your appointment is successfully created on 2023-12-22 at 01:00 PM in Epilworld. Your booking id is #15979. Thank you.', '2023-12-16 21:44:56', '2023-12-16 21:44:56'),
(213, 6, 75, 'Appointment Created', 'Dear test, Your appointment is successfully created on 2023-12-22 at 05:00 PM in Epilworld. Your booking id is #93146. Thank you.', '2023-12-16 21:45:33', '2023-12-16 21:45:33'),
(214, 5, 76, 'Appointment Created', 'Dear Sara Sara, Your appointment is successfully created on 2023-12-18 at 10:00 AM in Epilworld. Your booking id is #94458. Thank you.', '2023-12-17 03:33:30', '2023-12-17 03:33:30'),
(215, 17, 77, 'Appointment Created', 'Dear ttttttttttttttttttt, Your appointment is successfully created on 2023-12-18 at 01:30 PM in Epilworld. Your booking id is #80105. Thank you.', '2023-12-17 03:34:24', '2023-12-17 03:34:24'),
(216, 15, 78, 'Appointment Created', 'Dear testsss, Your appointment is successfully created on 2023-12-18 at 10:30 AM in Epilworld. Your booking id is #28847. Thank you.', '2023-12-17 04:46:20', '2023-12-17 04:46:20'),
(217, 6, 79, 'Appointment Created', 'Dear test, Your appointment is successfully created on 2023-12-18 at 04:00 PM in Epilworld. Your booking id is #57399. Thank you.', '2023-12-17 04:47:00', '2023-12-17 04:47:00'),
(218, 6, 79, 'Booking status', 'Dear test, Your appointment on 2023-12-18 at 04:00 PM in Epilworld is now in session. Your booking id is #57399. Thank you.', '2023-12-17 04:47:42', '2023-12-17 04:47:42'),
(219, 6, 79, 'Booking status', 'Dear test, Your appointment on 2023-12-18 at 04:00 PM in Epilworld is now Cancel. Your booking id is #57399. Thank you.', '2023-12-17 04:48:08', '2023-12-17 04:48:08'),
(220, 5, 80, 'Appointment Created', 'Dear Sara Sara, Your appointment is successfully created on 2023-12-18 at 10:00 AM in Epilworld. Your booking id is #76829. Thank you.', '2023-12-17 04:52:14', '2023-12-17 04:52:14'),
(221, 6, 81, 'Appointment Created', 'Dear test, Your appointment is successfully created on 2023-12-19 at 10:00 AM in Epilworld. Your booking id is #46518. Thank you.', '2023-12-17 04:53:53', '2023-12-17 04:53:53'),
(222, 6, 82, 'Appointment Created', 'Dear test, Your appointment is successfully created on 2023-12-19 at 10:30 AM in Epilworld. Your booking id is #45925. Thank you.', '2023-12-17 04:54:05', '2023-12-17 04:54:05'),
(223, 5, 83, 'Appointment Created', 'Dear Sara Sara, Your appointment is successfully created on 2023-12-18 at 10:00 AM in Epilworld. Your booking id is #82038. Thank you.', '2023-12-17 19:47:14', '2023-12-17 19:47:14'),
(224, 5, 83, 'Booking status', 'Dear Sara Sara, Your appointment on 2023-12-18 at 10:00 AM in Epilworld is now in session. Your booking id is #82038. Thank you.', '2023-12-17 19:47:43', '2023-12-17 19:47:43'),
(225, 5, 83, 'Booking status', 'Dear Sara Sara, Your appointment on 2023-12-18 at 10:00 AM in Epilworld is now Approved. Your booking id is #82038. Thank you.', '2023-12-17 19:49:08', '2023-12-17 19:49:08'),
(226, 5, 83, 'Booking status', 'Dear Sara Sara, Your appointment on 2023-12-18 at 10:00 AM in Epilworld is now in session. Your booking id is #82038. Thank you.', '2023-12-17 19:51:37', '2023-12-17 19:51:37'),
(227, 5, 83, 'Booking status', 'Dear Sara Sara, Your appointment on 2023-12-18 at 10:00 AM in Epilworld is now Cancel. Your booking id is #82038. Thank you.', '2023-12-17 19:51:44', '2023-12-17 19:51:44'),
(228, 5, 83, 'Booking status', 'Dear Sara Sara, Your appointment on 2023-12-18 at 10:00 AM in Epilworld is now Completed. Your booking id is #82038. Thank you.', '2023-12-17 19:51:50', '2023-12-17 19:51:50'),
(229, 15, 84, 'Appointment Created', 'Dear testsss, Your appointment is successfully created on 2023-12-18 at 10:30 AM in Epilworld. Your booking id is #35096. Thank you.', '2023-12-17 19:53:21', '2023-12-17 19:53:21'),
(230, 5, 83, 'Booking status', 'Dear Sara Sara, Your appointment on 2023-12-18 at 10:00 AM in Epilworld is now Approved. Your booking id is #82038. Thank you.', '2023-12-17 19:53:43', '2023-12-17 19:53:43'),
(231, 12, 85, 'Appointment Created', 'Dear 8888888888, Your appointment is successfully created on 2023-12-18 at 10:00 AM in Epilworld. Your booking id is #17161. Thank you.', '2023-12-17 19:54:25', '2023-12-17 19:54:25'),
(232, 6, 86, 'Appointment Created', 'Dear test, Your appointment is successfully created on 2023-12-18 at 10:00 AM in Epilworld. Your booking id is #32576. Thank you.', '2023-12-17 20:06:31', '2023-12-17 20:06:31'),
(233, 15, 87, 'Appointment Created', 'Dear testsss, Your appointment is successfully created on 2023-12-18 at 12:00 PM in Epilworld. Your booking id is #45708. Thank you.', '2023-12-17 20:10:06', '2023-12-17 20:10:06'),
(234, 7, 88, 'Appointment Created', 'Dear mohamed barrah, Your appointment is successfully created on 2023-12-18 at 01:30 PM in Epilworld. Your booking id is #25886. Thank you.', '2023-12-17 20:21:58', '2023-12-17 20:21:58'),
(235, 7, 88, 'Booking status', 'Dear mohamed barrah, Your appointment on 2023-12-18 at 01:00 PM in Epilworld is now Cancel. Your booking id is #25886. Thank you.', '2023-12-17 22:04:45', '2023-12-17 22:04:45'),
(236, 5, 88, 'Booking status', 'Dear Sara Sara, Your appointment on 2023-12-18 at 02:00 PM in Epilworld is now Cancel. Your booking id is #25886. Thank you.', '2023-12-17 22:05:43', '2023-12-17 22:05:43'),
(237, 5, 88, 'Booking status', 'Dear Sara Sara, Your appointment on 2023-12-18 at 02:00 PM in Epilworld is now Completed. Your booking id is #25886. Thank you.', '2023-12-18 17:53:03', '2023-12-18 17:53:03');
INSERT INTO `notification` (`id`, `user_id`, `booking_id`, `title`, `msg`, `created_at`, `updated_at`) VALUES
(238, 6, 89, 'Appointment Created', 'Dear test, Your appointment is successfully created on 2023-12-19 at 10:30 AM in Epilworld. Your booking id is #13160. Thank you.', '2023-12-18 17:56:00', '2023-12-18 17:56:00'),
(239, 6, 90, 'Appointment Created', 'Dear test, Your appointment is successfully created on 2023-12-19 at 10:00 AM in Epilworld. Your booking id is #15760. Thank you.', '2023-12-18 17:56:37', '2023-12-18 17:56:37'),
(240, 6, 90, 'Booking status', 'Dear test, Your appointment on 2023-12-19 at 10:00 AM in Epilworld is now in session. Your booking id is #15760. Thank you.', '2023-12-18 17:56:49', '2023-12-18 17:56:49'),
(241, 6, 90, 'Booking status', 'Dear test, Your appointment on 2023-12-19 at 10:00 AM in Epilworld is now Completed. Your booking id is #15760. Thank you.', '2023-12-18 17:57:05', '2023-12-18 17:57:05'),
(242, 7, 91, 'Appointment Created', 'Dear mohamed barrah, Your appointment is successfully created on 2023-12-19 at 10:00 AM in Epilworld. Your booking id is #66110. Thank you.', '2023-12-19 03:30:53', '2023-12-19 03:30:53'),
(243, 12, 92, 'Appointment Created', 'Dear 8888888888, Your appointment is successfully created on 2023-12-19 at 10:30 AM in Epilworld. Your booking id is #87102. Thank you.', '2023-12-19 03:31:06', '2023-12-19 03:31:06'),
(244, 8, 93, 'Appointment Created', 'Dear my_test, Your appointment is successfully created on 2023-12-19 at 11:00 AM in Epilworld. Your booking id is #14619. Thank you.', '2023-12-19 03:31:24', '2023-12-19 03:31:24'),
(245, 6, 94, 'Appointment Created', 'Dear test, Your appointment is successfully created on 2023-12-19 at 05:30 PM in Epilworld. Your booking id is #45074. Thank you.', '2023-12-19 16:03:35', '2023-12-19 16:03:35'),
(246, 6, 95, 'Appointment Created', 'Dear test, Your appointment is successfully created on 2023-12-19 at 05:30 PM in Epilworld. Your booking id is #94356. Thank you.', '2023-12-19 16:03:51', '2023-12-19 16:03:51'),
(247, 7, 96, 'Appointment Created', 'Dear mohamed barrah, Your appointment is successfully created on 2023-12-19 at 05:30 PM in Epilworld. Your booking id is #98709. Thank you.', '2023-12-19 16:04:33', '2023-12-19 16:04:33'),
(248, 6, 97, 'Appointment Created', 'Dear test, Your appointment is successfully created on 2023-12-20 at 10:00 AM in Epilworld. Your booking id is #88568. Thank you.', '2023-12-19 16:05:53', '2023-12-19 16:05:53'),
(249, 6, 98, 'Appointment Created', 'Dear test, Your appointment is successfully created on 2023-12-20 at 10:30 AM in Epilworld. Your booking id is #74288. Thank you.', '2023-12-19 16:06:13', '2023-12-19 16:06:13'),
(250, 7, 99, 'Appointment Created', 'Dear mohamed barrah, Your appointment is successfully created on 2023-12-20 at 10:00 AM in Epilworld. Your booking id is #93997. Thank you.', '2023-12-19 16:06:38', '2023-12-19 16:06:38'),
(251, 6, 100, 'Appointment Created', 'Dear test, Your appointment is successfully created on 2023-12-20 at 11:30 AM in Epilworld. Your booking id is #23005. Thank you.', '2023-12-19 16:07:03', '2023-12-19 16:07:03'),
(252, 5, 101, 'Appointment Created', 'Dear Sara Sara, Your appointment is successfully created on 2023-12-20 at 10:00 AM in Epilworld. Your booking id is #17676. Thank you.', '2023-12-19 16:16:46', '2023-12-19 16:16:46'),
(253, 16, 102, 'Appointment Created', 'Dear oooooo, Your appointment is successfully created on 2023-12-20 at 10:30 AM in Epilworld. Your booking id is #29035. Thank you.', '2023-12-19 16:17:06', '2023-12-19 16:17:06'),
(254, 17, 103, 'Appointment Created', 'Dear ttttttttttttttttttt, Your appointment is successfully created on 2023-12-20 at 01:00 PM in Epilworld. Your booking id is #43472. Thank you.', '2023-12-19 16:17:30', '2023-12-19 16:17:30'),
(255, 6, 104, 'Appointment Created', 'Dear test, Your appointment is successfully created on 2023-12-20 at 10:00 AM in Epilworld. Your booking id is #66678. Thank you.', '2023-12-19 16:17:59', '2023-12-19 16:17:59'),
(256, 17, 105, 'Appointment Created', 'Dear ttttttttttttttttttt, Your appointment is successfully created on 2023-12-20 at 11:30 AM in Epilworld. Your booking id is #67923. Thank you.', '2023-12-19 16:19:11', '2023-12-19 16:19:11'),
(257, 7, 106, 'Appointment Created', 'Dear mohamed barrah, Your appointment is successfully created on 2023-12-21 at 10:00 AM in Epilworld. Your booking id is #20792. Thank you.', '2023-12-19 17:24:20', '2023-12-19 17:24:20'),
(258, 5, 107, 'Appointment Created', 'Dear Sara Sara, Your appointment is successfully created on 2023-12-21 at 11:00 AM in Epilworld. Your booking id is #65133. Thank you.', '2023-12-19 17:36:19', '2023-12-19 17:36:19'),
(259, 6, 108, 'Appointment Created', 'Dear test, Your appointment is successfully created on 2023-12-22 at 10:30 AM in Epilworld. Your booking id is #44300. Thank you.', '2023-12-19 17:46:25', '2023-12-19 17:46:25'),
(260, 6, 109, 'Appointment Created', 'Dear test, Your appointment is successfully created on 2023-12-22 at 11:30 AM in Epilworld. Your booking id is #88550. Thank you.', '2023-12-19 19:27:16', '2023-12-19 19:27:16'),
(261, 6, 110, 'Appointment Created', 'Dear test, Your appointment is successfully created on 2023-12-22 at 10:00 AM in Epilworld. Your booking id is #25843. Thank you.', '2023-12-19 20:22:25', '2023-12-19 20:22:25'),
(262, 12, 111, 'Appointment Created', 'Dear 8888888888, Your appointment is successfully created on 2023-12-22 at 11:00 AM in Epilworld. Your booking id is #64888. Thank you.', '2023-12-19 20:33:58', '2023-12-19 20:33:58'),
(263, 6, 112, 'Appointment Created', 'Dear test, Your appointment is successfully created on 2023-12-22 at 10:00 AM in Epilworld. Your booking id is #99352. Thank you.', '2023-12-19 22:29:49', '2023-12-19 22:29:49'),
(264, 8, 113, 'Appointment Created', 'Dear my_test, Your appointment is successfully created on 2023-12-22 at 02:30 PM in Epilworld. Your booking id is #13345. Thank you.', '2023-12-19 22:38:37', '2023-12-19 22:38:37'),
(265, 8, 114, 'Appointment Created', 'Dear my_test, Your appointment is successfully created on 2023-12-22 at 10:30 AM in Epilworld. Your booking id is #75153. Thank you.', '2023-12-19 22:43:03', '2023-12-19 22:43:03'),
(266, 6, 115, 'Appointment Created', 'Dear test, Your appointment is successfully created on 2023-12-21 at 10:30 AM in Epilworld. Your booking id is #91246. Thank you.', '2023-12-19 23:17:50', '2023-12-19 23:17:50'),
(267, 7, 116, 'Appointment Created', 'Dear mohamed barrah, Your appointment is successfully created on 2023-12-22 at 11:00 AM in Epilworld. Your booking id is #80622. Thank you.', '2023-12-20 00:45:52', '2023-12-20 00:45:52'),
(268, 18, 117, 'Appointment Created', 'Dear test1, Your appointment is successfully created on 2023-12-22 at 11:00 AM in Epilworld. Your booking id is #14742. Thank you.', '2023-12-20 00:53:51', '2023-12-20 00:53:51'),
(269, 5, 118, 'Appointment Created', 'Dear Sara Sara, Your appointment is successfully created on 2023-12-22 at 12:30 PM in Epilworld. Your booking id is #24557. Thank you.', '2023-12-20 01:32:41', '2023-12-20 01:32:41'),
(270, 6, 119, 'Appointment Created', 'Dear test, Your appointment is successfully created on 2023-12-21 at 12:00 PM in Epilworld. Your booking id is #22979. Thank you.', '2023-12-20 01:34:04', '2023-12-20 01:34:04'),
(271, 6, 120, 'Appointment Created', 'Dear test, Your appointment is successfully created on 2023-12-22 at 10:30 AM in Epilworld. Your booking id is #53124. Thank you.', '2023-12-20 06:19:48', '2023-12-20 06:19:48'),
(272, 6, 121, 'Appointment Created', 'Dear test, Your appointment is successfully created on 2023-12-22 at 10:30 AM in Epilworld. Your booking id is #14835. Thank you.', '2023-12-20 06:23:13', '2023-12-20 06:23:13'),
(273, 6, 122, 'Appointment Created', 'Dear test, Your appointment is successfully created on 2023-12-25 at 10:00 AM in Epilworld. Your booking id is #90698. Thank you.', '2023-12-20 06:40:11', '2023-12-20 06:40:11'),
(274, 18, 123, 'Appointment Created', 'Dear test1, Your appointment is successfully created on 2023-12-25 at 04:30 PM in Epilworld. Your booking id is #52487. Thank you.', '2023-12-20 06:40:37', '2023-12-20 06:40:37'),
(275, 17, 124, 'Appointment Created', 'Dear ttttttttttttttttttt, Your appointment is successfully created on 2023-12-25 at 10:30 AM in Epilworld. Your booking id is #98650. Thank you.', '2023-12-20 06:41:07', '2023-12-20 06:41:07'),
(276, 8, 125, 'Appointment Created', 'Dear my_test, Your appointment is successfully created on 2023-12-25 at 04:00 PM in Epilworld. Your booking id is #47670. Thank you.', '2023-12-20 06:42:00', '2023-12-20 06:42:00'),
(277, 7, 126, 'Appointment Created', 'Dear mohamed barrah, Your appointment is successfully created on 2023-12-23 at 10:00 AM in Epilworld. Your booking id is #72687. Thank you.', '2023-12-22 18:27:22', '2023-12-22 18:27:22'),
(278, 15, 127, 'Appointment Created', 'Dear testsss, Your appointment is successfully created on 2023-12-23 at 11:00 AM in Epilworld. Your booking id is #18044. Thank you.', '2023-12-22 18:36:31', '2023-12-22 18:36:31'),
(279, 15, 127, 'Booking status', 'Dear testsss, Your appointment on 2023-12-23 at 11:00 AM in Epilworld is now in session. Your booking id is #18044. Thank you.', '2023-12-23 03:28:37', '2023-12-23 03:28:37'),
(280, 7, 126, 'Booking status', 'Dear mohamed barrah, Your appointment on 2023-12-23 at 10:00 AM in Epilworld is now Cancel. Your booking id is #72687. Thank you.', '2023-12-23 03:28:39', '2023-12-23 03:28:39'),
(281, 15, 127, 'Booking status', 'Dear testsss, Your appointment on 2023-12-23 at 11:00 AM in Epilworld is now Completed. Your booking id is #18044. Thank you.', '2023-12-23 03:28:47', '2023-12-23 03:28:47'),
(282, 6, 128, 'Appointment Created', 'Dear test, Your appointment is successfully created on 2023-12-23 at 10:30 AM in Epilworld. Your booking id is #13034. Thank you.', '2023-12-23 03:45:16', '2023-12-23 03:45:16'),
(283, 6, 129, 'Appointment Created', 'Dear test, Your appointment is successfully created on 2023-12-23 at 02:30 PM in Epilworld. Your booking id is #40763. Thank you.', '2023-12-23 03:45:43', '2023-12-23 03:45:43'),
(284, 7, 130, 'Appointment Created', 'Dear mohamed barrah, Your appointment is successfully created on 2023-12-23 at 10:00 AM in Epilworld. Your booking id is #50360. Thank you.', '2023-12-23 03:45:59', '2023-12-23 03:45:59'),
(285, 6, 131, 'Appointment Created', 'Dear test, Your appointment is successfully created on 2023-12-23 at 02:00 PM in Epilworld. Your booking id is #81718. Thank you.', '2023-12-23 03:46:11', '2023-12-23 03:46:11'),
(286, 6, 132, 'Appointment Created', 'Dear test, Your appointment is successfully created on 2023-12-23 at 01:00 PM in Epilworld. Your booking id is #99182. Thank you.', '2023-12-23 03:46:25', '2023-12-23 03:46:25'),
(287, 7, 133, 'Appointment Created', 'Dear mohamed barrah, Your appointment is successfully created on 2023-12-23 at 03:30 PM in Epilworld. Your booking id is #88629. Thank you.', '2023-12-23 03:46:38', '2023-12-23 03:46:38'),
(288, 6, 134, 'Appointment Created', 'Dear test, Your appointment is successfully created on 2023-12-23 at 10:00 AM in Epilworld. Your booking id is #39642. Thank you.', '2023-12-23 04:20:07', '2023-12-23 04:20:07'),
(289, 6, 135, 'Appointment Created', 'Dear test, Your appointment is successfully created on 2023-12-23 at 10:00 AM in Epilworld. Your booking id is #26101. Thank you.', '2023-12-23 04:20:30', '2023-12-23 04:20:30'),
(290, 6, 136, 'Appointment Created', 'Dear test, Your appointment is successfully created on 2023-12-25 at 10:30 AM in Epilworld. Your booking id is #95911. Thank you.', '2023-12-23 18:42:26', '2023-12-23 18:42:26'),
(291, 6, 137, 'Appointment Created', 'Dear test, Your appointment is successfully created on 2023-12-25 at 10:30 AM in Epilworld. Your booking id is #58139. Thank you.', '2023-12-23 18:45:09', '2023-12-23 18:45:09'),
(292, 7, 138, 'Appointment Created', 'Dear mohamed barrah, Your appointment is successfully created on 2023-12-25 at 10:00 AM in Epilworld. Your booking id is #38364. Thank you.', '2023-12-23 18:47:48', '2023-12-23 18:47:48'),
(293, 9, 139, 'Appointment Created', 'Dear blalala, Your appointment is successfully created on 2023-12-25 at 12:30 PM in Epilworld. Your booking id is #56365. Thank you.', '2023-12-23 18:48:31', '2023-12-23 18:48:31'),
(294, 6, 140, 'Appointment Created', 'Dear test, Your appointment is successfully created on 2023-12-25 at 10:00 AM in Epilworld. Your booking id is #32424. Thank you.', '2023-12-23 21:45:54', '2023-12-23 21:45:54'),
(295, 8, 141, 'Appointment Created', 'Dear my_test, Your appointment is successfully created on 2023-12-25 at 11:00 AM in Epilworld. Your booking id is #35195. Thank you.', '2023-12-23 21:46:22', '2023-12-23 21:46:22'),
(296, 6, 142, 'Appointment Created', 'Dear test, Your appointment is successfully created on 2023-12-25 at 05:00 PM in Epilworld. Your booking id is #55736. Thank you.', '2023-12-23 21:46:55', '2023-12-23 21:46:55'),
(297, 6, 142, 'Booking status', 'Dear test, Your appointment on 2023-12-25 at 05:00 PM in Epilworld is now Cancel. Your booking id is #55736. Thank you.', '2023-12-23 21:48:53', '2023-12-23 21:48:53'),
(298, 10, 143, 'Appointment Created', 'Dear row, Your appointment is successfully created on 2023-12-25 at 04:30 PM in Epilworld. Your booking id is #71263. Thank you.', '2023-12-23 21:49:54', '2023-12-23 21:49:54'),
(299, 6, 144, 'Appointment Created', 'Dear test, Your appointment is successfully created on 2024-01-15 at 10:00 AM in Epilworld. Your booking id is #33370. Thank you.', '2023-12-23 21:53:22', '2023-12-23 21:53:22'),
(300, 16, 145, 'Appointment Created', 'Dear oooooo, Your appointment is successfully created on 2023-12-25 at 03:00 PM in Epilworld. Your booking id is #21460. Thank you.', '2023-12-24 19:16:46', '2023-12-24 19:16:46'),
(301, 16, 146, 'Appointment Created', 'Dear oooooo, Your appointment is successfully created on 2023-12-25 at 04:30 PM in Epilworld. Your booking id is #32120. Thank you.', '2023-12-24 19:18:14', '2023-12-24 19:18:14'),
(302, 11, 147, 'Appointment Created', 'Dear text, Your appointment is successfully created on 2023-12-25 at 03:30 PM in Epilworld. Your booking id is #19258. Thank you.', '2023-12-24 19:18:42', '2023-12-24 19:18:42'),
(303, 6, 140, 'Booking status', 'Dear test, Your appointment on 2023-12-25 at 10:00 AM in Epilworld is now Cancel. Your booking id is #32424. Thank you.', '2023-12-25 18:29:23', '2023-12-25 18:29:23'),
(304, 8, 141, 'Booking status', 'Dear my_test, Your appointment on 2023-12-25 at 10:30 AM in Epilworld is now Completed. Your booking id is #35195. Thank you.', '2023-12-25 18:31:46', '2023-12-25 18:31:46'),
(305, 6, 144, 'Booking status', 'Dear test, Your appointment on 2024-01-15 at 10:00 AM in Epilworld is now Completed. Your booking id is #33370. Thank you.', '2023-12-25 18:35:01', '2023-12-25 18:35:01'),
(306, 16, 146, 'Booking status', 'Dear oooooo, Your appointment on 2023-12-25 at 04:30 PM in Epilworld is now in session. Your booking id is #32120. Thank you.', '2023-12-25 21:10:39', '2023-12-25 21:10:39'),
(307, 8, 148, 'Appointment Created', 'Dear my_test, Your appointment is successfully created on 2023-12-26 at 10:00 AM in Epilworld. Your booking id is #12565. Thank you.', '2023-12-25 21:22:05', '2023-12-25 21:22:05'),
(308, 6, 140, 'Booking status', 'Dear test, Your appointment on 2023-12-25 at 10:00 AM in Epilworld is now Cancel. Your booking id is #32424. Thank you.', '2023-12-25 21:35:52', '2023-12-25 21:35:52'),
(309, 6, 140, 'Booking status', 'Dear test, Your appointment on 2023-12-25 at 10:00 AM in Epilworld is now Cancel. Your booking id is #32424. Thank you.', '2023-12-25 21:39:34', '2023-12-25 21:39:34'),
(310, 6, 140, 'Booking status', 'Dear test, Your appointment on 2023-12-25 at 10:00 AM in Epilworld is now Cancel. Your booking id is #32424. Thank you.', '2023-12-25 21:40:34', '2023-12-25 21:40:34'),
(311, 8, 141, 'Booking status', 'Dear my_test, Your appointment on 2023-12-25 at 10:30 AM in Epilworld is now Completed. Your booking id is #35195. Thank you.', '2023-12-25 21:44:12', '2023-12-25 21:44:12'),
(312, 16, 146, 'Booking status', 'Dear oooooo, Your appointment on 2023-12-25 at 04:30 PM in Epilworld is now in session. Your booking id is #32120. Thank you.', '2023-12-25 21:44:53', '2023-12-25 21:44:53'),
(313, 11, 147, 'Booking status', 'Dear text, Your appointment on 2023-12-25 at 03:00 PM in Epilworld is now Approved. Your booking id is #19258. Thank you.', '2023-12-25 21:45:25', '2023-12-25 21:45:25'),
(314, 8, 141, 'Booking status', 'Dear my_test, Your appointment on 2023-12-25 at 10:30 AM in Epilworld is now Completed. Your booking id is #35195. Thank you.', '2023-12-25 21:45:58', '2023-12-25 21:45:58'),
(315, 11, 147, 'Booking status', 'Dear text, Your appointment on 2023-12-25 at 03:00 PM in Epilworld is now in session. Your booking id is #19258. Thank you.', '2023-12-25 21:48:43', '2023-12-25 21:48:43'),
(316, 11, 147, 'Booking status', 'Dear text, Your appointment on 2023-12-25 at 03:00 PM in Epilworld is now in session. Your booking id is #19258. Thank you.', '2023-12-25 21:48:51', '2023-12-25 21:48:51'),
(317, 11, 147, 'Booking status', 'Dear text, Your appointment on 2023-12-25 at 03:00 PM in Epilworld is now in session. Your booking id is #19258. Thank you.', '2023-12-25 21:49:36', '2023-12-25 21:49:36'),
(318, 8, 141, 'Booking status', 'Dear my_test, Your appointment on 2023-12-25 at 10:30 AM in Epilworld is now Completed. Your booking id is #35195. Thank you.', '2023-12-25 21:50:41', '2023-12-25 21:50:41'),
(319, 7, 149, 'Appointment Created', 'Dear mohamed barrah, Your appointment is successfully created on 2023-12-27 at 11:00 AM in Epilworld. Your booking id is #91236. Thank you.', '2023-12-25 21:56:38', '2023-12-25 21:56:38'),
(320, 7, 149, 'Booking status', 'Dear mohamed barrah, Your appointment on 2023-12-27 at 11:00 AM in Epilworld is now Approved. Your booking id is #91236. Thank you.', '2023-12-25 22:01:53', '2023-12-25 22:01:53'),
(321, 7, 149, 'Booking status', 'Dear mohamed barrah, Your appointment on 2023-12-27 at 11:00 AM in Epilworld is now in session. Your booking id is #91236. Thank you.', '2023-12-25 22:02:06', '2023-12-25 22:02:06'),
(322, 7, 149, 'Booking status', 'Dear mohamed barrah, Your appointment on 2023-12-27 at 11:00 AM in Epilworld is now Completed. Your booking id is #91236. Thank you.', '2023-12-25 22:04:04', '2023-12-25 22:04:04'),
(323, 7, 149, 'Booking status', 'Dear mohamed barrah, Your appointment on 2023-12-27 at 11:00 AM in Epilworld is now Approved. Your booking id is #91236. Thank you.', '2023-12-25 22:04:17', '2023-12-25 22:04:17'),
(324, 7, 149, 'Booking status', 'Dear mohamed barrah, Your appointment on 2023-12-27 at 11:00 AM in Epilworld is now Completed. Your booking id is #91236. Thank you.', '2023-12-25 22:04:23', '2023-12-25 22:04:23'),
(325, 7, 149, 'Booking status', 'Dear mohamed barrah, Your appointment on 2023-12-27 at 11:00 AM in Epilworld is now in session. Your booking id is #91236. Thank you.', '2023-12-25 22:06:05', '2023-12-25 22:06:05'),
(326, 7, 149, 'Booking status', 'Dear mohamed barrah, Your appointment on 2023-12-27 at 11:00 AM in Epilworld is now Approved. Your booking id is #91236. Thank you.', '2023-12-25 22:06:16', '2023-12-25 22:06:16'),
(327, 7, 149, 'Booking status', 'Dear mohamed barrah, Your appointment on 2023-12-27 at 11:00 AM in Epilworld is now Completed. Your booking id is #91236. Thank you.', '2023-12-25 22:06:26', '2023-12-25 22:06:26'),
(328, 7, 149, 'Booking status', 'Dear mohamed barrah, Your appointment on 2023-12-27 at 11:00 AM in Epilworld is now in session. Your booking id is #91236. Thank you.', '2023-12-25 22:06:33', '2023-12-25 22:06:33'),
(329, 7, 149, 'Booking status', 'Dear mohamed barrah, Your appointment on 2023-12-27 at 11:00 AM in Epilworld is now Approved. Your booking id is #91236. Thank you.', '2023-12-25 22:06:39', '2023-12-25 22:06:39'),
(330, 7, 149, 'Booking status', 'Dear mohamed barrah, Your appointment on 2023-12-27 at 11:00 AM in Epilworld is now Completed. Your booking id is #91236. Thank you.', '2023-12-25 22:06:46', '2023-12-25 22:06:46'),
(331, 7, 149, 'Booking status', 'Dear mohamed barrah, Your appointment on 2023-12-27 at 11:00 AM in Epilworld is now Approved. Your booking id is #91236. Thank you.', '2023-12-25 22:06:58', '2023-12-25 22:06:58'),
(332, 7, 149, 'Booking status', 'Dear mohamed barrah, Your appointment on 2023-12-27 at 11:00 AM in Epilworld is now in session. Your booking id is #91236. Thank you.', '2023-12-25 22:07:06', '2023-12-25 22:07:06'),
(333, 7, 149, 'Booking status', 'Dear mohamed barrah, Your appointment on 2023-12-27 at 11:00 AM in Epilworld is now Completed. Your booking id is #91236. Thank you.', '2023-12-25 22:07:12', '2023-12-25 22:07:12'),
(334, 7, 149, 'Booking status', 'Dear mohamed barrah, Your appointment on 2023-12-27 at 11:00 AM in Epilworld is now in session. Your booking id is #91236. Thank you.', '2023-12-25 22:07:19', '2023-12-25 22:07:19'),
(335, 7, 149, 'Booking status', 'Dear mohamed barrah, Your appointment on 2023-12-27 at 11:00 AM in Epilworld is now Completed. Your booking id is #91236. Thank you.', '2023-12-25 22:07:26', '2023-12-25 22:07:26'),
(336, 7, 149, 'Booking status', 'Dear mohamed barrah, Your appointment on 2023-12-27 at 11:00 AM in Epilworld is now Approved. Your booking id is #91236. Thank you.', '2023-12-25 22:07:33', '2023-12-25 22:07:33'),
(337, 11, 147, 'Booking status', 'Dear text, Your appointment on 2023-12-25 at 03:00 PM in Epilworld is now Completed. Your booking id is #19258. Thank you.', '2023-12-25 22:08:13', '2023-12-25 22:08:13'),
(338, 16, 146, 'Booking status', 'Dear oooooo, Your appointment on 2023-12-25 at 04:30 PM in Epilworld is now Approved. Your booking id is #32120. Thank you.', '2023-12-25 22:08:21', '2023-12-25 22:08:21'),
(339, 8, 141, 'Booking status', 'Dear my_test, Your appointment on 2023-12-25 at 10:30 AM in Epilworld is now in session. Your booking id is #35195. Thank you.', '2023-12-25 22:08:30', '2023-12-25 22:08:30'),
(340, 16, 145, 'Booking status', 'Dear oooooo, Your appointment on 2023-12-25 at 03:00 PM in Epilworld is now Completed. Your booking id is #21460. Thank you.', '2023-12-25 22:08:39', '2023-12-25 22:08:39'),
(341, 7, 149, 'Booking status', 'Dear mohamed barrah, Your appointment on 2023-12-27 at 11:00 AM in Epilworld is now in session. Your booking id is #91236. Thank you.', '2023-12-25 22:35:59', '2023-12-25 22:35:59'),
(342, 19, 150, 'Appointment Created', 'Dear kuuhaku, Your appointment is successfully created on 2023-12-27 at 10:00 AM in Epilworld. Your booking id is #64786. Thank you.', '2023-12-26 20:16:43', '2023-12-26 20:16:43'),
(343, 15, 151, 'Appointment Created', 'Dear testsss, Your appointment is successfully created on 2023-12-27 at 11:00 AM in Epilworld. Your booking id is #34409. Thank you.', '2023-12-26 20:18:06', '2023-12-26 20:18:06'),
(344, 6, 1, 'Appointment Created', 'Dear test, Your appointment is successfully created on 2023-12-27 at 10:00 AM in Epilworld. Your booking id is #85488. Thank you.', '2023-12-27 20:45:17', '2023-12-27 20:45:17'),
(345, 15, 2, 'Appointment Created', 'Dear testsss, Your appointment is successfully created on 2023-12-27 at 05:30 PM in Epilworld. Your booking id is #98627. Thank you.', '2023-12-27 20:46:22', '2023-12-27 20:46:22'),
(346, 15, 2, 'Booking status', 'Dear testsss, Your appointment on 2023-12-27 at 05:30 PM in Epilworld is now Completed. Your booking id is #98627. Thank you.', '2023-12-27 20:50:12', '2023-12-27 20:50:12'),
(347, 15, 2, 'Booking status', 'Dear testsss, Your appointment on 2023-12-27 at 05:30 PM in Epilworld is now in session. Your booking id is #98627. Thank you.', '2023-12-27 20:50:33', '2023-12-27 20:50:33'),
(348, 15, 2, 'Booking status', 'Dear testsss, Your appointment on 2023-12-27 at 05:30 PM in Epilworld is now Completed. Your booking id is #98627. Thank you.', '2023-12-27 22:31:47', '2023-12-27 22:31:47'),
(349, 6, 1, 'Booking status', 'Dear test, Your appointment on 2023-12-27 at 10:00 AM in Epilworld is now Completed. Your booking id is #85488. Thank you.', '2023-12-27 22:31:53', '2023-12-27 22:31:53'),
(350, 6, 3, 'Appointment Created', 'Dear test, Your appointment is successfully created on 2023-12-27 at 11:00 AM in Epilworld. Your booking id is #54376. Thank you.', '2023-12-28 00:13:58', '2023-12-28 00:13:58'),
(351, 7, 4, 'Appointment Created', 'Dear mohamed barrah, Your appointment is successfully created on 2023-12-27 at 01:00 PM in Epilworld. Your booking id is #88825. Thank you.', '2023-12-28 00:14:43', '2023-12-28 00:14:43'),
(352, 6, 3, 'Booking status', 'Dear test, Your appointment on 2023-12-27 at 11:00 AM in Epilworld is now Completed. Your booking id is #54376. Thank you.', '2023-12-28 00:15:43', '2023-12-28 00:15:43'),
(353, 7, 4, 'Booking status', 'Dear mohamed barrah, Your appointment on 2023-12-27 at 01:00 PM in Epilworld is now Completed. Your booking id is #88825. Thank you.', '2023-12-28 00:15:47', '2023-12-28 00:15:47'),
(354, 7, 4, 'Booking status', 'Dear mohamed barrah, Your appointment on 2023-12-27 at 01:00 PM in Epilworld is now Completed. Your booking id is #88825. Thank you.', '2023-12-28 00:15:54', '2023-12-28 00:15:54'),
(355, 6, 5, 'Appointment Created', 'Dear test, Your appointment is successfully created on 2023-12-27 at 04:30 PM in Epilworld. Your booking id is #88301. Thank you.', '2023-12-28 00:47:38', '2023-12-28 00:47:38'),
(356, 6, 5, 'Booking status', 'Dear test, Your appointment on 2023-12-27 at 04:30 PM in Epilworld is now Completed. Your booking id is #88301. Thank you.', '2023-12-28 00:47:58', '2023-12-28 00:47:58'),
(357, 6, 6, 'Appointment Created', 'Dear test, Your appointment is successfully created on 2023-12-27 at 12:30 PM in Epilworld. Your booking id is #93099. Thank you.', '2023-12-27 21:19:01', '2023-12-27 21:19:01'),
(358, 6, 7, 'Appointment Created', 'Dear test, Your appointment is successfully created on 2023-12-27 at 02:00 PM in Epilworld. Your booking id is #94794. Thank you.', '2023-12-27 21:19:25', '2023-12-27 21:19:25'),
(359, 6, 8, 'Appointment Created', 'Dear test, Your appointment is successfully created on 2023-12-28 at 10:00 AM in Epilworld. Your booking id is #13701. Thank you.', '2023-12-27 21:38:43', '2023-12-27 21:38:43'),
(360, 6, 9, 'Appointment Created', 'Dear test, Your appointment is successfully created on 2023-12-28 at 10:30 AM in Epilworld. Your booking id is #64822. Thank you.', '2023-12-27 21:39:21', '2023-12-27 21:39:21'),
(361, 7, 10, 'Appointment Created', 'Dear mohamed barrah, Your appointment is successfully created on 2023-12-28 at 01:30 PM in Epilworld. Your booking id is #83304. Thank you.', '2023-12-27 21:39:39', '2023-12-27 21:39:39'),
(362, 17, 11, 'Appointment Created', 'Dear ttttttttttttttttttt, Your appointment is successfully created on 2023-12-28 at 10:00 AM in Epilworld. Your booking id is #44251. Thank you.', '2023-12-27 21:40:09', '2023-12-27 21:40:09'),
(363, 17, 11, 'Booking status', 'Dear ttttttttttttttttttt, Your appointment on 2023-12-28 at 10:00 AM in Epilworld is now Completed. Your booking id is #44251. Thank you.', '2023-12-27 21:41:03', '2023-12-27 21:41:03'),
(364, 5, 12, 'Appointment Created', 'Dear Sara Sara, Your appointment is successfully created on 2023-12-29 at 10:00 AM in Epilworld. Your booking id is #57800. Thank you.', '2023-12-27 23:10:05', '2023-12-27 23:10:05'),
(365, 7, 13, 'Appointment Created', 'Dear mohamed barrah, Your appointment is successfully created on 2023-12-29 at 02:00 PM in Epilworld. Your booking id is #65395. Thank you.', '2023-12-27 23:10:48', '2023-12-27 23:10:48'),
(366, 6, 14, 'Appointment Created', 'Dear test, Your appointment is successfully created on 2023-12-29 at 11:30 AM in Epilworld. Your booking id is #60023. Thank you.', '2023-12-27 23:11:07', '2023-12-27 23:11:07'),
(367, 6, 15, 'Appointment Created', 'Dear test, Your appointment is successfully created on 2023-12-29 at 10:30 AM in Epilworld. Your booking id is #45337. Thank you.', '2023-12-27 23:11:34', '2023-12-27 23:11:34'),
(368, 6, 16, 'Appointment Created', 'Dear test, Your appointment is successfully created on 2023-12-30 at 10:30 AM in Epilworld. Your booking id is #39252. Thank you.', '2023-12-27 23:17:31', '2023-12-27 23:17:31'),
(369, 5, 17, 'Appointment Created', 'Dear Sara Sara, Your appointment is successfully created on 2023-12-30 at 10:00 AM in Epilworld. Your booking id is #85365. Thank you.', '2023-12-27 23:18:23', '2023-12-27 23:18:23'),
(370, 20, 18, 'Appointment Created', 'Dear test, Your appointment is successfully created on 2023-12-28 at 10:00 AM in Epilworld. Your booking id is #17000. Thank you.', '2023-12-28 14:32:20', '2023-12-28 14:32:20'),
(371, 20, 19, 'Appointment Created', 'Dear test, Your appointment is successfully created on 2023-12-28 at 12:00 PM in Epilworld. Your booking id is #25154. Thank you.', '2023-12-28 15:07:08', '2023-12-28 15:07:08'),
(372, 20, 19, 'Booking status', 'Dear test, Your appointment on 2023-12-28 at 12:00 PM in Epilworld is now Completed. Your booking id is #25154. Thank you.', '2023-12-28 15:14:42', '2023-12-28 15:14:42'),
(373, 20, 20, 'Appointment Created', 'Dear test, Your appointment is successfully created on 2023-12-29 at 10:00 AM in Epilworld. Your booking id is #23111. Thank you.', '2023-12-28 23:01:42', '2023-12-28 23:01:42'),
(374, 20, 20, 'Booking status', 'Dear test, Your appointment on 2023-12-29 at 10:00 AM in Epilworld is now Completed. Your booking id is #23111. Thank you.', '2023-12-28 23:01:49', '2023-12-28 23:01:49'),
(375, 21, 21, 'Appointment Created', 'Dear not the test, Your appointment is successfully created on 2023-12-29 at 10:00 AM in Epilworld. Your booking id is #99418. Thank you.', '2023-12-29 14:54:44', '2023-12-29 14:54:44'),
(376, 21, 21, 'Booking status', 'Dear not the test, Your appointment on 2023-12-29 at 10:00 AM in Epilworld is now Completed. Your booking id is #99418. Thank you.', '2023-12-29 14:54:51', '2023-12-29 14:54:51'),
(377, 21, 22, 'Appointment Created', 'Dear not the test, Your appointment is successfully created on 2023-12-30 at 10:00 AM in Epilworld. Your booking id is #66684. Thank you.', '2023-12-30 12:34:46', '2023-12-30 12:34:46'),
(378, 20, 23, 'Appointment Created', 'Dear test, Your appointment is successfully created on 2023-12-30 at 10:00 AM in Epilworld. Your booking id is #50058. Thank you.', '2023-12-30 12:35:06', '2023-12-30 12:35:06'),
(379, 20, 23, 'Booking status', 'Dear test, Your appointment on 2023-12-30 at 10:00 AM in Epilworld is now Completed. Your booking id is #50058. Thank you.', '2023-12-30 12:35:20', '2023-12-30 12:35:20'),
(380, 21, 22, 'Booking status', 'Dear not the test, Your appointment on 2023-12-30 at 10:00 AM in Epilworld is now Completed. Your booking id is #66684. Thank you.', '2023-12-30 12:35:27', '2023-12-30 12:35:27'),
(381, 20, 24, 'Appointment Created', 'Dear test, Your appointment is successfully created on 2023-12-30 at 10:30 AM in Epilworld. Your booking id is #34111. Thank you.', '2023-12-30 17:32:34', '2023-12-30 17:32:34'),
(382, 20, 24, 'Booking status', 'Dear test, Your appointment on 2023-12-30 at 10:30 AM in Epilworld is now Completed. Your booking id is #34111. Thank you.', '2023-12-30 17:32:39', '2023-12-30 17:32:39'),
(383, 20, 25, 'Appointment Created', 'Dear test, Your appointment is successfully created on 2024-01-01 at 10:00 AM in Epilworld. Your booking id is #38318. Thank you.', '2024-01-01 12:08:14', '2024-01-01 12:08:14'),
(384, 20, 25, 'Booking status', 'Dear test, Your appointment on 2024-01-01 at 10:00 AM in Epilworld is now Completed. Your booking id is #38318. Thank you.', '2024-01-01 12:08:22', '2024-01-01 12:08:22'),
(385, 21, 26, 'Appointment Created', 'Dear not the test, Your appointment is successfully created on 2024-01-01 at 11:00 AM in Epilworld. Your booking id is #48337. Thank you.', '2024-01-01 22:29:45', '2024-01-01 22:29:45'),
(386, 20, 27, 'Appointment Created', 'Dear test, Your appointment is successfully created on 2024-01-02 at 10:00 AM in Epilworld. Your booking id is #47885. Thank you.', '2024-01-02 13:38:06', '2024-01-02 13:38:06'),
(387, 21, 28, 'Appointment Created', 'Dear not the test, Your appointment is successfully created on 2024-01-02 at 11:00 AM in Epilworld. Your booking id is #19634. Thank you.', '2024-01-02 13:38:19', '2024-01-02 13:38:19'),
(388, 21, 28, 'Booking status', 'Dear not the test, Your appointment on 2024-01-02 at 11:00 AM in Epilworld is now Completed. Your booking id is #19634. Thank you.', '2024-01-02 13:38:27', '2024-01-02 13:38:27'),
(389, 20, 27, 'Booking status', 'Dear test, Your appointment on 2024-01-02 at 10:00 AM in Epilworld is now Completed. Your booking id is #47885. Thank you.', '2024-01-02 13:38:33', '2024-01-02 13:38:33'),
(390, 20, 29, 'Appointment Created', 'Dear test, Your appointment is successfully created on 2024-01-03 at 10:00 AM in Epilworld. Your booking id is #15501. Thank you.', '2024-01-03 01:16:12', '2024-01-03 01:16:12'),
(391, 21, 30, 'Appointment Created', 'Dear not the test, Your appointment is successfully created on 2024-01-03 at 10:30 AM in Epilworld. Your booking id is #50250. Thank you.', '2024-01-03 01:16:32', '2024-01-03 01:16:32'),
(392, 21, 30, 'Booking status', 'Dear not the test, Your appointment on 2024-01-03 at 10:30 AM in Epilworld is now Completed. Your booking id is #50250. Thank you.', '2024-01-03 01:16:48', '2024-01-03 01:16:48'),
(393, 21, 30, 'Booking status', 'Dear not the test, Your appointment on 2024-01-03 at 10:30 AM in Epilworld is now Completed. Your booking id is #50250. Thank you.', '2024-01-03 01:16:55', '2024-01-03 01:16:55'),
(394, 20, 29, 'Booking status', 'Dear test, Your appointment on 2024-01-03 at 10:00 AM in Epilworld is now Completed. Your booking id is #15501. Thank you.', '2024-01-03 01:17:02', '2024-01-03 01:17:02'),
(395, 20, 1, 'Appointment Created', 'Dear test, Your appointment is successfully created on 2024-01-03 at 10:30 AM in Epilworld. Your booking id is #95858. Thank you.', '2024-01-03 21:23:52', '2024-01-03 21:23:52'),
(396, 20, 1, 'Booking status', 'Dear test, Your appointment on 2024-01-03 at 10:30 AM in Epilworld is now Completed. Your booking id is #95858. Thank you.', '2024-01-03 21:24:02', '2024-01-03 21:24:02'),
(397, 20, 1, 'Booking status', 'Dear test, Your appointment on 2024-01-03 at 10:30 AM in Epilworld is now Cancel. Your booking id is #95858. Thank you.', '2024-01-03 21:51:20', '2024-01-03 21:51:20'),
(398, 20, 1, 'Booking status', 'Dear test, Your appointment on 2024-01-03 at 10:30 AM in Epilworld is now Approved. Your booking id is #95858. Thank you.', '2024-01-03 21:51:47', '2024-01-03 21:51:47'),
(399, 20, 1, 'Booking status', 'Dear test, Your appointment on 2024-01-03 at 10:30 AM in Epilworld is now Completed. Your booking id is #95858. Thank you.', '2024-01-03 21:51:51', '2024-01-03 21:51:51'),
(400, 20, 2, 'Appointment Created', 'Dear test, Your appointment is successfully created on 2024-01-04 at 10:30 AM in Epilworld. Your booking id is #76675. Thank you.', '2024-01-04 17:41:50', '2024-01-04 17:41:50'),
(401, 20, 2, 'Booking status', 'Dear test, Your appointment on 2024-01-04 at 10:30 AM in Epilworld is now Completed. Your booking id is #76675. Thank you.', '2024-01-04 17:42:00', '2024-01-04 17:42:00'),
(402, 20, 3, 'Appointment Created', 'Dear test, Your appointment is successfully created on 2024-01-01 at 10:00 AM in Epilworld. Your booking id is #64274. Thank you.', '2024-01-04 17:45:41', '2024-01-04 17:45:41'),
(403, 20, 3, 'Booking status', 'Dear test, Your appointment on 2024-01-01 at 10:00 AM in Epilworld is now Completed. Your booking id is #64274. Thank you.', '2024-01-04 17:46:14', '2024-01-04 17:46:14'),
(404, 20, 4, 'Appointment Created', 'Dear test, Your appointment is successfully created on 2024-01-04 at 10:00 AM in Epilworld. Your booking id is #35536. Thank you.', '2024-01-04 22:45:03', '2024-01-04 22:45:03'),
(405, 20, 4, 'Booking status', 'Dear test, Your appointment on 2024-01-04 at 10:00 AM in Epilworld is now Completed. Your booking id is #35536. Thank you.', '2024-01-04 22:45:22', '2024-01-04 22:45:22'),
(406, 21, 5, 'Appointment Created', 'Dear not the test, Your appointment is successfully created on 2024-01-06 at 10:00 AM in Epilworld. Your booking id is #32191. Thank you.', '2024-01-06 10:36:13', '2024-01-06 10:36:13'),
(407, 21, 5, 'Booking status', 'Dear not the test, Your appointment on 2024-01-06 at 10:00 AM in Epilworld is now Completed. Your booking id is #32191. Thank you.', '2024-01-06 10:36:21', '2024-01-06 10:36:21'),
(408, 21, 5, 'Booking status', 'Dear not the test, Your appointment on 2024-01-06 at 10:00 AM in Epilworld is now Completed. Your booking id is #32191. Thank you.', '2024-01-06 10:36:45', '2024-01-06 10:36:45'),
(409, 20, 4, 'Booking status', 'Dear test, Your appointment on 2024-01-04 at 10:00 AM in Epilworld is now Approved. Your booking id is #35536. Thank you.', '2024-01-06 12:03:03', '2024-01-06 12:03:03'),
(410, 20, 4, 'Booking status', 'Dear test, Your appointment on 2024-01-04 at 10:00 AM in Epilworld is now Approved. Your booking id is #35536. Thank you.', '2024-01-06 12:03:10', '2024-01-06 12:03:10'),
(411, 21, 5, 'Booking status', 'Dear not the test, Your appointment on 2024-01-06 at 10:00 AM in Epilworld is now Approved. Your booking id is #32191. Thank you.', '2024-01-06 12:04:23', '2024-01-06 12:04:23'),
(412, 21, 5, 'Booking status', 'Dear not the test, Your appointment on 2024-01-06 at 10:00 AM in Epilworld is now Completed. Your booking id is #32191. Thank you.', '2024-01-06 12:04:30', '2024-01-06 12:04:30'),
(413, 20, 4, 'Booking status', 'Dear test, Your appointment on 2024-01-04 at 10:00 AM in Epilworld is now Completed. Your booking id is #35536. Thank you.', '2024-01-06 12:04:35', '2024-01-06 12:04:35'),
(414, 20, 4, 'Booking status', 'Dear test, Your appointment on 2024-01-04 at 10:00 AM in Epilworld is now Approved. Your booking id is #35536. Thank you.', '2024-01-06 12:04:37', '2024-01-06 12:04:37'),
(415, 20, 4, 'Booking status', 'Dear test, Your appointment on 2024-01-04 at 10:00 AM in Epilworld is now Completed. Your booking id is #35536. Thank you.', '2024-01-06 12:04:51', '2024-01-06 12:04:51'),
(416, 21, 5, 'Booking status', 'Dear not the test, Your appointment on 2024-01-06 at 10:00 AM in Epilworld is now Approved. Your booking id is #32191. Thank you.', '2024-01-06 12:04:59', '2024-01-06 12:04:59'),
(417, 20, 4, 'Booking status', 'Dear test, Your appointment on 2024-01-04 at 10:00 AM in Epilworld is now Approved. Your booking id is #35536. Thank you.', '2024-01-06 12:07:13', '2024-01-06 12:07:13'),
(418, 21, 5, 'Booking status', 'Dear not the test, Your appointment on 2024-01-06 at 10:00 AM in Epilworld is now Completed. Your booking id is #32191. Thank you.', '2024-01-06 12:10:50', '2024-01-06 12:10:50'),
(419, 20, 4, 'Booking status', 'Dear test, Your appointment on 2024-01-04 at 10:00 AM in Epilworld is now Completed. Your booking id is #35536. Thank you.', '2024-01-06 12:11:04', '2024-01-06 12:11:04'),
(420, 21, 6, 'Appointment Created', 'Dear not the test, Your appointment is successfully created on 2024-01-06 at 10:00 AM in Epilworld. Your booking id is #36545. Thank you.', '2024-01-06 16:59:42', '2024-01-06 16:59:42'),
(421, 21, 7, 'Appointment Created', 'Dear not the test, Your appointment is successfully created on 2024-01-06 at 10:00 AM in Epilworld. Your booking id is #59151. Thank you.', '2024-01-06 17:00:12', '2024-01-06 17:00:12'),
(422, 20, 8, 'Appointment Created', 'Dear test, Your appointment is successfully created on 2024-01-06 at 01:30 PM in Epilworld. Your booking id is #65419. Thank you.', '2024-01-06 17:11:56', '2024-01-06 17:11:56'),
(423, 21, 9, 'Appointment Created', 'Dear not the test, Your appointment is successfully created on 2024-01-06 at 02:00 PM in Epilworld. Your booking id is #98138. Thank you.', '2024-01-06 17:12:23', '2024-01-06 17:12:23'),
(424, 20, 10, 'Appointment Created', 'Dear test, Your appointment is successfully created on 2024-01-06 at 03:30 PM in Epilworld. Your booking id is #64541. Thank you.', '2024-01-06 17:12:46', '2024-01-06 17:12:46'),
(425, 21, 11, 'Appointment Created', 'Dear not the test, Your appointment is successfully created on 2024-01-06 at 02:00 PM in Epilworld. Your booking id is #32473. Thank you.', '2024-01-06 17:13:15', '2024-01-06 17:13:15'),
(426, 21, 12, 'Appointment Created', 'Dear not the test, Your appointment is successfully created on 2024-01-06 at 11:30 AM in Epilworld. Your booking id is #23523. Thank you.', '2024-01-06 17:17:08', '2024-01-06 17:17:08'),
(427, 20, 13, 'Appointment Created', 'Dear test, Your appointment is successfully created on 2024-01-06 at 10:00 AM in Epilworld. Your booking id is #32931. Thank you.', '2024-01-06 18:21:01', '2024-01-06 18:21:01'),
(428, 21, 14, 'Appointment Created', 'Dear not the test, Your appointment is successfully created on 2024-01-06 at 10:30 AM in Epilworld. Your booking id is #51944. Thank you.', '2024-01-06 18:34:49', '2024-01-06 18:34:49'),
(429, 21, 15, 'Appointment Created', 'Dear not the test, Your appointment is successfully created on 2024-01-16 at 12:30 PM in Epilworld. Your booking id is #94201. Thank you.', '2024-01-06 18:35:03', '2024-01-06 18:35:03'),
(430, 20, 16, 'Appointment Created', 'Dear test, Your appointment is successfully created on 2024-01-06 at 01:30 PM in Epilworld. Your booking id is #72237. Thank you.', '2024-01-06 18:35:18', '2024-01-06 18:35:18'),
(431, 21, 17, 'Appointment Created', 'Dear not the test, Your appointment is successfully created on 2024-01-06 at 12:30 PM in Epilworld. Your booking id is #52594. Thank you.', '2024-01-06 19:14:03', '2024-01-06 19:14:03'),
(432, 21, 17, 'Booking status', 'Dear not the test, Your appointment on 2024-01-06 at 12:30 PM in Epilworld is now Completed. Your booking id is #52594. Thank you.', '2024-01-06 19:33:07', '2024-01-06 19:33:07'),
(433, 21, 15, 'Booking status', 'Dear not the test, Your appointment on 2024-01-16 at 12:30 PM in Epilworld is now Completed. Your booking id is #94201. Thank you.', '2024-01-06 19:33:09', '2024-01-06 19:33:09'),
(434, 20, 18, 'Appointment Created', 'Dear test, Your appointment is successfully created on 2024-01-06 at 10:00 AM in Epilworld. Your booking id is #72200. Thank you.', '2024-01-08 23:29:59', '2024-01-08 23:29:59'),
(435, 20, 18, 'Booking status', 'Dear test, Your appointment on 2024-01-06 at 10:00 AM in Epilworld is now Completed. Your booking id is #72200. Thank you.', '2024-01-08 23:30:37', '2024-01-08 23:30:37'),
(436, 20, 18, 'Booking status', 'Dear test, Your appointment on 2024-01-06 at 10:00 AM in Epilworld is now Completed. Your booking id is #72200. Thank you.', '2024-01-08 23:30:48', '2024-01-08 23:30:48'),
(437, 20, 19, 'Appointment Created', 'Dear test, Your appointment is successfully created on 2024-01-09 at 10:00 AM in Epilworld. Your booking id is #51792. Thank you.', '2024-01-08 23:35:39', '2024-01-08 23:35:39'),
(438, 20, 19, 'Booking status', 'Dear test, Your appointment on 2024-01-09 at 10:00 AM in Epilworld is now Completed. Your booking id is #51792. Thank you.', '2024-01-09 11:40:27', '2024-01-09 11:40:27'),
(439, 20, 20, 'Appointment Created', 'Dear test, Your appointment is successfully created on 2024-01-06 at 10:00 AM in Epilworld. Your booking id is #36269. Thank you.', '2024-01-09 14:32:25', '2024-01-09 14:32:25'),
(440, 20, 20, 'Booking status', 'Dear test, Your appointment on 2024-01-06 at 10:00 AM in Epilworld is now Completed. Your booking id is #36269. Thank you.', '2024-01-09 14:33:03', '2024-01-09 14:33:03'),
(441, 21, 21, 'Appointment Created', 'Dear not the test, Your appointment is successfully created on 2024-01-09 at 10:00 AM in Epilworld. Your booking id is #86392. Thank you.', '2024-01-09 15:44:03', '2024-01-09 15:44:03'),
(442, 21, 21, 'Booking status', 'Dear not the test, Your appointment on 2024-01-09 at 10:00 AM in Epilworld is now Completed. Your booking id is #86392. Thank you.', '2024-01-09 15:44:12', '2024-01-09 15:44:12'),
(443, 20, 22, 'Appointment Created', 'Dear test, Your appointment is successfully created on 2024-01-10 at 01:00 PM in Epilworld. Your booking id is #44667. Thank you.', '2024-01-10 17:13:51', '2024-01-10 17:13:51'),
(444, 20, 23, 'Appointment Created', 'Dear test, Your appointment is successfully created on 2024-01-10 at 02:00 PM in Epilworld. Your booking id is #72638. Thank you.', '2024-01-10 17:14:19', '2024-01-10 17:14:19'),
(445, 20, 22, 'Booking status', 'Dear test, Your appointment on 2024-01-10 at 01:00 PM in Epilworld is now Completed. Your booking id is #44667. Thank you.', '2024-01-10 17:19:30', '2024-01-10 17:19:30'),
(446, 20, 23, 'Booking status', 'Dear test, Your appointment on 2024-01-10 at 02:00 PM in Epilworld is now Completed. Your booking id is #72638. Thank you.', '2024-01-12 11:10:07', '2024-01-12 11:10:07'),
(447, 20, 23, 'Booking status', 'Dear test, Your appointment on 2024-01-10 at 02:00 PM in Epilworld is now Approved. Your booking id is #72638. Thank you.', '2024-01-12 11:10:16', '2024-01-12 11:10:16'),
(448, 20, 22, 'Booking status', 'Dear test, Your appointment on 2024-01-10 at 01:00 PM in Epilworld is now Approved. Your booking id is #44667. Thank you.', '2024-01-12 18:47:27', '2024-01-12 18:47:27'),
(449, 21, 21, 'Booking status', 'Dear not the test, Your appointment on 2024-01-09 at 10:00 AM in Epilworld is now in session. Your booking id is #86392. Thank you.', '2024-01-12 18:47:29', '2024-01-12 18:47:29'),
(450, 20, 20, 'Booking status', 'Dear test, Your appointment on 2024-01-06 at 10:00 AM in Epilworld is now Cancel. Your booking id is #36269. Thank you.', '2024-01-12 18:47:30', '2024-01-12 18:47:30'),
(451, 20, 23, 'Booking status', 'Dear test, Your appointment on 2024-01-10 at 02:00 PM in Epilworld is now Completed. Your booking id is #72638. Thank you.', '2024-01-12 18:47:34', '2024-01-12 18:47:34'),
(452, 20, 24, 'Appointment Created', 'Dear test, Your appointment is successfully created on 2024-01-13 at 11:30 AM in Epilworld. Your booking id is #26354. Thank you.', '2024-01-13 13:50:53', '2024-01-13 13:50:53'),
(453, 20, 25, 'Appointment Created', 'Dear test, Your appointment is successfully created on 2024-01-13 at 11:00 AM in Epilworld. Your booking id is #14603. Thank you.', '2024-01-13 18:49:32', '2024-01-13 18:49:32'),
(454, 20, 26, 'Appointment Created', 'Dear test, Your appointment is successfully created on 2024-01-13 at 11:30 AM in Epilworld. Your booking id is #79316. Thank you.', '2024-01-13 22:15:36', '2024-01-13 22:15:36'),
(455, 21, 28, 'Appointment Created', 'Dear not the test, Your appointment is successfully created on 2024-01-15 at 11:30 AM in Epilworld. Your booking id is #37690. Thank you.', '2024-01-13 22:48:32', '2024-01-13 22:48:32'),
(456, 24, 30, 'Appointment Created', 'Dear cxycxycxycxy, Your appointment is successfully created on 2024-01-19 at 10:00 AM in Epilworld. Your booking id is #47325. Thank you.', '2024-01-13 23:15:37', '2024-01-13 23:15:37'),
(457, 22, 34, 'Appointment Created', 'Dear ccccc, Your appointment is successfully created on 2024-01-17 at 10:00 AM in Epilworld. Your booking id is #50763. Thank you.', '2024-01-13 23:17:01', '2024-01-13 23:17:01'),
(458, 21, 38, 'Appointment Created', 'Dear not the test, Your appointment is successfully created on 2024-01-17 at 10:00 AM in Epilworld. Your booking id is #61911. Thank you.', '2024-01-13 23:20:14', '2024-01-13 23:20:14'),
(459, 25, 42, 'Appointment Created', 'Dear cccccccccccccccccccccccccccccccc, Your appointment is successfully created on 2024-01-17 at 12:00 PM in Epilworld. Your booking id is #88241. Thank you.', '2024-01-13 23:25:32', '2024-01-13 23:25:32'),
(460, 23, 46, 'Appointment Created', 'Dear cxycxycxycxy, Your appointment is successfully created on 2024-01-21 at 10:30 AM in Epilworld. Your booking id is #57180. Thank you.', '2024-01-13 23:26:45', '2024-01-13 23:26:45'),
(461, 21, 50, 'Appointment Created', 'Dear not the test, Your appointment is successfully created on 2020-01-01 at 03:00 PM in Epilworld. Your booking id is #65912. Thank you.', '2024-01-13 23:39:49', '2024-01-13 23:39:49'),
(462, 22, 64, 'Appointment Created', 'Dear ccccc, Your appointment is successfully created on 2024-01-21 at 12:00 PM in Epilworld. Your booking id is #39638. Thank you.', '2024-01-14 00:43:07', '2024-01-14 00:43:07'),
(463, 22, 68, 'Appointment Created', 'Dear ccccc, Your appointment is successfully created on 2020-02-02 at 10:00 AM in Epilworld. Your booking id is #54447. Thank you.', '2024-01-14 01:35:49', '2024-01-14 01:35:49'),
(464, 23, 72, 'Appointment Created', 'Dear cxycxycxycxy, Your appointment is successfully created on 2024-01-21 at 10:30 AM in Epilworld. Your booking id is #15906. Thank you.', '2024-01-14 01:36:58', '2024-01-14 01:36:58'),
(465, 24, 76, 'Appointment Created', 'Dear cxycxycxycxy, Your appointment is successfully created on 2024-01-21 at 10:30 AM in Epilworld. Your booking id is #84996. Thank you.', '2024-01-14 01:38:54', '2024-01-14 01:38:54'),
(466, 24, 80, 'Appointment Created', 'Dear cxycxycxycxy, Your appointment is successfully created on 2024-01-21 at 10:30 AM in Epilworld. Your booking id is #84996. Thank you.', '2024-01-14 01:40:18', '2024-01-14 01:40:18'),
(467, 24, 94, 'Appointment Created', 'Dear cxycxycxycxy, Your appointment is successfully created on 2020-01-01 at 10:30 AM in Epilworld. Your booking id is #84996. Thank you.', '2024-01-14 01:57:33', '2024-01-14 01:57:33'),
(468, 22, 98, 'Appointment Created', 'Dear ccccc, Your appointment is successfully created on 2020-01-01 at 11:00 AM in Epilworld. Your booking id is #97831. Thank you.', '2024-01-14 01:58:07', '2024-01-14 01:58:07'),
(469, 21, 295, 'Appointment Created', 'Dear not the test, Your appointment is successfully created on 2020-01-01 at 12:30 PM in Epilworld. Your booking id is #33813. Thank you.', '2024-01-14 02:56:08', '2024-01-14 02:56:08'),
(470, 21, 299, 'Appointment Created', 'Dear not the test, Your appointment is successfully created on 2020-01-01 at 10:30 AM in Epilworld. Your booking id is #87761. Thank you.', '2024-01-14 02:57:02', '2024-01-14 02:57:02');
INSERT INTO `notification` (`id`, `user_id`, `booking_id`, `title`, `msg`, `created_at`, `updated_at`) VALUES
(471, 21, 303, 'Appointment Created', 'Dear not the test, Your appointment is successfully created on 2024-01-22 at 12:00 PM in Epilworld. Your booking id is #73751. Thank you.', '2024-01-14 02:58:52', '2024-01-14 02:58:52'),
(472, 23, 307, 'Appointment Created', 'Dear cxycxycxycxy, Your appointment is successfully created on 2024-01-26 at 11:00 AM in Epilworld. Your booking id is #75700. Thank you.', '2024-01-14 03:01:17', '2024-01-14 03:01:17'),
(473, 23, 304, 'Booking status', 'Dear cxycxycxycxy, Your appointment on 2024-01-19 at 11:00 AM in Epilworld is now in session. Your booking id is #75700. Thank you.', '2024-01-14 03:01:37', '2024-01-14 03:01:37'),
(474, 22, 311, 'Appointment Created', 'Dear ccccc, Your appointment is successfully created on 2024-01-22 at 11:00 AM in Epilworld. Your booking id is #52598. Thank you.', '2024-01-14 03:03:47', '2024-01-14 03:03:47'),
(475, 22, 315, 'Appointment Created', 'Dear ccccc, Your appointment is successfully created on 2024-01-22 at 10:00 AM in Epilworld. Your booking id is #24670. Thank you.', '2024-01-14 12:16:03', '2024-01-14 12:16:03'),
(476, 25, 319, 'Appointment Created', 'Dear cccccccccccccccccccccccccccccccc, Your appointment is successfully created on 2024-01-29 at 10:30 AM in Epilworld. Your booking id is #94818. Thank you.', '2024-01-14 12:17:33', '2024-01-14 12:17:33'),
(477, 23, 323, 'Appointment Created', 'Dear cxycxycxycxy, Your appointment is successfully created on 2024-01-22 at 10:00 AM in Epilworld. Your booking id is #43756. Thank you.', '2024-01-14 12:18:59', '2024-01-14 12:18:59'),
(478, 20, 327, 'Appointment Created', 'Dear test, Your appointment is successfully created on 2024-01-22 at 10:00 AM in Epilworld. Your booking id is #55357. Thank you.', '2024-01-14 12:19:33', '2024-01-14 12:19:33'),
(479, 22, 331, 'Appointment Created', 'Dear ccccc, Your appointment is successfully created on 2024-01-29 at 10:00 AM in Epilworld. Your booking id is #13633. Thank you.', '2024-01-14 12:20:37', '2024-01-14 12:20:37'),
(480, 20, 335, 'Appointment Created', 'Dear test, Your appointment is successfully created on 2024-01-22 at 10:00 AM in Epilworld. Your booking id is #35031. Thank you.', '2024-01-14 12:21:25', '2024-01-14 12:21:25'),
(481, 20, 339, 'Appointment Created', 'Dear test, Your appointment is successfully created on 2024-01-26 at 10:00 AM in Epilworld. Your booking id is #87329. Thank you.', '2024-01-14 12:22:16', '2024-01-14 12:22:16'),
(482, 21, 343, 'Appointment Created', 'Dear not the test, Your appointment is successfully created on 2024-01-22 at 10:00 AM in Epilworld. Your booking id is #19740. Thank you.', '2024-01-14 12:22:36', '2024-01-14 12:22:36'),
(483, 20, 348, 'Appointment Created', 'Dear test, Your appointment is successfully created on 2024-01-26 at 10:00 AM in Epilworld. Your booking id is #81090. Thank you.', '2024-01-14 12:29:04', '2024-01-14 12:29:04'),
(484, 23, 354, 'Appointment Created', 'Dear cxycxycxycxy, Your appointment is successfully created on 2024-01-22 at 10:00 AM in Epilworld. Your booking id is #78714. Thank you.', '2024-01-14 12:33:15', '2024-01-14 12:33:15'),
(485, 20, 358, 'Appointment Created', 'Dear test, Your appointment is successfully created on 2024-01-26 at 10:00 AM in Epilworld. Your booking id is #75680. Thank you.', '2024-01-14 12:36:09', '2024-01-14 12:36:09'),
(486, 22, 362, 'Appointment Created', 'Dear ccccc, Your appointment is successfully created on 2024-01-22 at 10:00 AM in Epilworld. Your booking id is #65059. Thank you.', '2024-01-14 12:36:51', '2024-01-14 12:36:51'),
(487, 22, 366, 'Appointment Created', 'Dear ccccc, Your appointment is successfully created on 2024-01-22 at 10:00 AM in Epilworld. Your booking id is #54074. Thank you.', '2024-01-14 12:37:49', '2024-01-14 12:37:49'),
(488, 22, 370, 'Appointment Created', 'Dear ccccc, Your appointment is successfully created on 2024-01-22 at 10:00 AM in Epilworld. Your booking id is #22570. Thank you.', '2024-01-14 12:39:09', '2024-01-14 12:39:09'),
(489, 22, 376, 'Appointment Created', 'Dear ccccc, Your appointment is successfully created on 2024-01-22 at 10:00 AM in Epilworld. Your booking id is #34819. Thank you.', '2024-01-14 12:40:47', '2024-01-14 12:40:47'),
(490, 22, 380, 'Appointment Created', 'Dear ccccc, Your appointment is successfully created on 2024-01-22 at 10:00 AM in Epilworld. Your booking id is #34819. Thank you.', '2024-01-14 12:41:47', '2024-01-14 12:41:47'),
(491, 23, 408, 'Appointment Created', 'Dear cxycxycxycxy, Your appointment is successfully created on 2024-01-22 at 10:00 AM in Epilworld. Your booking id is #88343. Thank you.', '2024-01-14 13:17:01', '2024-01-14 13:17:01'),
(492, 22, 429, 'Appointment Created', 'Dear ccccc, Your appointment is successfully created on 2024-01-22 at 05:00 PM in Epilworld. Your booking id is #26642. Thank you.', '2024-01-14 13:44:48', '2024-01-14 13:44:48'),
(493, 22, 433, 'Appointment Created', 'Dear ccccc, Your appointment is successfully created on 2024-01-22 at 05:00 PM in Epilworld. Your booking id is #26642. Thank you.', '2024-01-14 13:45:24', '2024-01-14 13:45:24'),
(494, 22, 437, 'Appointment Created', 'Dear ccccc, Your appointment is successfully created on 2024-01-22 at 10:30 AM in Epilworld. Your booking id is #26642. Thank you.', '2024-01-14 13:47:41', '2024-01-14 13:47:41'),
(495, 22, 455, 'Appointment Created', 'Dear ccccc, Your appointment is successfully created on 2024-01-22 at 10:30 AM in Epilworld. Your booking id is #90709. Thank you.', '2024-01-14 14:03:33', '2024-01-14 14:03:33'),
(496, 22, 459, 'Appointment Created', 'Dear ccccc, Your appointment is successfully created on 2024-01-22 at 10:30 AM in Epilworld. Your booking id is #43983. Thank you.', '2024-01-14 14:04:17', '2024-01-14 14:04:17'),
(497, 22, 463, 'Appointment Created', 'Dear ccccc, Your appointment is successfully created on 2024-01-22 at 10:30 AM in Epilworld. Your booking id is #43983. Thank you.', '2024-01-14 14:05:24', '2024-01-14 14:05:24'),
(498, 22, 473, 'Appointment Created', 'Dear ccccc, Your appointment is successfully created on 2024-01-21 at 2024-01-15 12:00:00 in Epilworld. Your booking id is #43983. Thank you.', '2024-01-14 14:14:10', '2024-01-14 14:14:10'),
(499, 24, 482, 'Appointment Created', 'Dear cxycxycxycxy, Your appointment is successfully created on 2024-01-21 at 10:00 AM in Epilworld. Your booking id is #22997. Thank you.', '2024-01-14 14:34:26', '2024-01-14 14:34:26'),
(500, 24, 487, 'Appointment Created', 'Dear cxycxycxycxy, Your appointment is successfully created on 2024-01-22 at 10:30 AM in Epilworld. Your booking id is #22997. Thank you.', '2024-01-14 14:35:22', '2024-01-14 14:35:22'),
(501, 24, 491, 'Appointment Created', 'Dear cxycxycxycxy, Your appointment is successfully created on 2024-01-22 at 10:30 AM in Epilworld. Your booking id is #22997. Thank you.', '2024-01-14 14:35:47', '2024-01-14 14:35:47'),
(502, 24, 495, 'Appointment Created', 'Dear cxycxycxycxy, Your appointment is successfully created on 2024-01-22 at 10:30 AM in Epilworld. Your booking id is #22997. Thank you.', '2024-01-14 14:36:55', '2024-01-14 14:36:55'),
(503, 23, 499, 'Appointment Created', 'Dear cxycxycxycxy, Your appointment is successfully created on 2024-01-21 at 04:30 PM in Epilworld. Your booking id is #94026. Thank you.', '2024-01-14 14:39:25', '2024-01-14 14:39:25'),
(504, 23, 503, 'Appointment Created', 'Dear cxycxycxycxy, Your appointment is successfully created on 2024-01-22 at 05:00 PM in Epilworld. Your booking id is #94026. Thank you.', '2024-01-14 14:40:03', '2024-01-14 14:40:03'),
(505, 23, 513, 'Appointment Created', 'Dear cxycxycxycxy, Your appointment is successfully created on 2024-01-22 at 05:00 PM in Epilworld. Your booking id is #94026. Thank you.', '2024-01-14 16:04:40', '2024-01-14 16:04:40'),
(506, 23, 532, 'Appointment Created', 'Dear cxycxycxycxy, Your appointment is successfully created on 2024-01-21 at 12:00 AM in Epilworld. Your booking id is #94026. Thank you.', '2024-01-14 16:15:37', '2024-01-14 16:15:37'),
(507, 23, 536, 'Appointment Created', 'Dear cxycxycxycxy, Your appointment is successfully created on 2024-01-21 at 12:30 AM in Epilworld. Your booking id is #94026. Thank you.', '2024-01-14 16:16:36', '2024-01-14 16:16:36'),
(508, 23, 540, 'Appointment Created', 'Dear cxycxycxycxy, Your appointment is successfully created on 2024-01-21 at 01:00 AM in Epilworld. Your booking id is #94026. Thank you.', '2024-01-14 16:16:40', '2024-01-14 16:16:40'),
(509, 23, 544, 'Appointment Created', 'Dear cxycxycxycxy, Your appointment is successfully created on 2024-01-21 at 01:30 AM in Epilworld. Your booking id is #94026. Thank you.', '2024-01-14 16:16:52', '2024-01-14 16:16:52'),
(510, 23, 548, 'Appointment Created', 'Dear cxycxycxycxy, Your appointment is successfully created on 2024-01-21 at 02:00 AM in Epilworld. Your booking id is #94026. Thank you.', '2024-01-14 16:18:19', '2024-01-14 16:18:19'),
(511, 23, 552, 'Appointment Created', 'Dear cxycxycxycxy, Your appointment is successfully created on 2024-01-21 at 02:30 AM in Epilworld. Your booking id is #94026. Thank you.', '2024-01-14 16:18:34', '2024-01-14 16:18:34'),
(512, 23, 556, 'Appointment Created', 'Dear cxycxycxycxy, Your appointment is successfully created on 2024-01-21 at 03:00 AM in Epilworld. Your booking id is #94026. Thank you.', '2024-01-14 16:19:11', '2024-01-14 16:19:11'),
(513, 23, 560, 'Appointment Created', 'Dear cxycxycxycxy, Your appointment is successfully created on 2024-01-21 at 03:30 AM in Epilworld. Your booking id is #94026. Thank you.', '2024-01-14 16:19:33', '2024-01-14 16:19:33'),
(514, 23, 565, 'Appointment Created', 'Dear cxycxycxycxy, Your appointment is successfully created on 2024-01-21 at 04:00 AM in Epilworld. Your booking id is #94026. Thank you.', '2024-01-14 16:22:35', '2024-01-14 16:22:35'),
(515, 23, 569, 'Appointment Created', 'Dear cxycxycxycxy, Your appointment is successfully created on 2024-01-21 at 12:00 AM in Epilworld. Your booking id is #94026. Thank you.', '2024-01-14 16:23:27', '2024-01-14 16:23:27'),
(516, 23, 573, 'Appointment Created', 'Dear cxycxycxycxy, Your appointment is successfully created on 2024-01-21 at 12:00 AM in Epilworld. Your booking id is #94026. Thank you.', '2024-01-14 16:24:17', '2024-01-14 16:24:17'),
(517, 23, 577, 'Appointment Created', 'Dear cxycxycxycxy, Your appointment is successfully created on 2024-01-23 at 11:30 AM in Epilworld. Your booking id is #94026. Thank you.', '2024-01-14 16:25:17', '2024-01-14 16:25:17'),
(518, 23, 581, 'Appointment Created', 'Dear cxycxycxycxy, Your appointment is successfully created on 2024-01-22 at 04:30 PM in Epilworld. Your booking id is #83937. Thank you.', '2024-01-14 16:38:32', '2024-01-14 16:38:32'),
(519, 23, 585, 'Appointment Created', 'Dear cxycxycxycxy, Your appointment is successfully created on 2024-01-22 at 10:00 AM in Epilworld. Your booking id is #83937. Thank you.', '2024-01-14 16:40:57', '2024-01-14 16:40:57'),
(520, 23, 589, 'Appointment Created', 'Dear cxycxycxycxy, Your appointment is successfully created on 2024-01-22 at 10:00 AM in Epilworld. Your booking id is #83937. Thank you.', '2024-01-14 16:43:38', '2024-01-14 16:43:38'),
(521, 20, 594, 'Appointment Created', 'Dear test, Your appointment is successfully created on 2024-01-24 at 11:30 AM in Epilworld. Your booking id is #93899. Thank you.', '2024-01-14 16:51:26', '2024-01-14 16:51:26'),
(522, 20, 600, 'Appointment Created', 'Dear test, Your appointment is successfully created on 2024-01-24 at 11:30 AM in Epilworld. Your booking id is #93899. Thank you.', '2024-01-14 16:52:28', '2024-01-14 16:52:28'),
(523, 20, 604, 'Appointment Created', 'Dear test, Your appointment is successfully created on 2024-01-22 at 10:00 AM in Epilworld. Your booking id is #75974. Thank you.', '2024-01-14 16:58:46', '2024-01-14 16:58:46'),
(524, 20, 608, 'Appointment Created', 'Dear test, Your appointment is successfully created on 2024-01-22 at 10:00 AM in Epilworld. Your booking id is #51221. Thank you.', '2024-01-14 17:00:01', '2024-01-14 17:00:01'),
(525, 20, 612, 'Appointment Created', 'Dear test, Your appointment is successfully created on 2024-01-26 at 10:00 AM in Epilworld. Your booking id is #14071. Thank you.', '2024-01-14 17:01:33', '2024-01-14 17:01:33'),
(526, 22, 616, 'Appointment Created', 'Dear ccccc, Your appointment is successfully created on 2024-01-24 at 11:30 AM in Epilworld. Your booking id is #73825. Thank you.', '2024-01-14 17:03:31', '2024-01-14 17:03:31'),
(527, 21, 620, 'Appointment Created', 'Dear not the test, Your appointment is successfully created on 2024-01-22 at 10:00 AM in Epilworld. Your booking id is #48119. Thank you.', '2024-01-14 17:05:53', '2024-01-14 17:05:53'),
(528, 23, 624, 'Appointment Created', 'Dear cxycxycxycxy, Your appointment is successfully created on 2024-01-22 at 10:00 AM in Epilworld. Your booking id is #79324. Thank you.', '2024-01-14 17:08:46', '2024-01-14 17:08:46'),
(529, 23, 628, 'Appointment Created', 'Dear cxycxycxycxy, Your appointment is successfully created on 2024-01-22 at 10:00 AM in Epilworld. Your booking id is #70475. Thank you.', '2024-01-14 17:09:49', '2024-01-14 17:09:49'),
(530, 24, 635, 'Appointment Created', 'Dear cxycxycxycxy, Your appointment is successfully created on 2024-01-22 at 10:00 AM in Epilworld. Your booking id is #81480. Thank you.', '2024-01-14 17:13:14', '2024-01-14 17:13:14'),
(531, 24, 639, 'Appointment Created', 'Dear cxycxycxycxy, Your appointment is successfully created on 2024-01-22 at 10:00 AM in Epilworld. Your booking id is #81480. Thank you.', '2024-01-14 17:13:35', '2024-01-14 17:13:35'),
(532, 20, 643, 'Appointment Created', 'Dear test, Your appointment is successfully created on 2024-01-24 at 10:00 AM in Epilworld. Your booking id is #41692. Thank you.', '2024-01-14 17:18:19', '2024-01-14 17:18:19'),
(533, 21, 647, 'Appointment Created', 'Dear not the test, Your appointment is successfully created on 2024-01-22 at 10:00 AM in Epilworld. Your booking id is #24164. Thank you.', '2024-01-14 17:19:16', '2024-01-14 17:19:16'),
(534, 21, 651, 'Appointment Created', 'Dear not the test, Your appointment is successfully created on 2024-01-22 at 10:00 AM in Epilworld. Your booking id is #24164. Thank you.', '2024-01-14 17:20:22', '2024-01-14 17:20:22'),
(535, 22, 656, 'Appointment Created', 'Dear ccccc, Your appointment is successfully created on 2024-01-22 at 10:00 AM in Epilworld. Your booking id is #72816. Thank you.', '2024-01-14 17:26:55', '2024-01-14 17:26:55'),
(536, 20, 660, 'Appointment Created', 'Dear test, Your appointment is successfully created on 2024-01-22 at 10:00 AM in Epilworld. Your booking id is #30477. Thank you.', '2024-01-14 17:28:57', '2024-01-14 17:28:57'),
(537, 20, 664, 'Appointment Created', 'Dear test, Your appointment is successfully created on 2024-01-26 at 10:00 AM in Epilworld. Your booking id is #53680. Thank you.', '2024-01-14 17:30:42', '2024-01-14 17:30:42'),
(538, 23, 668, 'Appointment Created', 'Dear cxycxycxycxy, Your appointment is successfully created on 2024-01-24 at 11:00 AM in Epilworld. Your booking id is #81992. Thank you.', '2024-01-14 17:31:40', '2024-01-14 17:31:40'),
(539, 21, 672, 'Appointment Created', 'Dear not the test, Your appointment is successfully created on 2024-01-22 at 10:00 AM in Epilworld. Your booking id is #50891. Thank you.', '2024-01-14 17:33:25', '2024-01-14 17:33:25'),
(540, 21, 676, 'Appointment Created', 'Dear not the test, Your appointment is successfully created on 2024-01-22 at 10:00 AM in Epilworld. Your booking id is #50891. Thank you.', '2024-01-14 17:35:14', '2024-01-14 17:35:14'),
(541, 21, 680, 'Appointment Created', 'Dear not the test, Your appointment is successfully created on 2024-01-22 at 10:00 AM in Epilworld. Your booking id is #50891. Thank you.', '2024-01-14 17:38:58', '2024-01-14 17:38:58'),
(542, 21, 684, 'Appointment Created', 'Dear not the test, Your appointment is successfully created on 2024-01-22 at 10:00 AM in Epilworld. Your booking id is #50891. Thank you.', '2024-01-14 17:42:00', '2024-01-14 17:42:00'),
(543, 21, 688, 'Appointment Created', 'Dear not the test, Your appointment is successfully created on 2024-01-22 at 11:30 AM in Epilworld. Your booking id is #61497. Thank you.', '2024-01-14 17:42:58', '2024-01-14 17:42:58'),
(544, 20, 692, 'Appointment Created', 'Dear test, Your appointment is successfully created on 2024-01-22 at 10:00 AM in Epilworld. Your booking id is #32504. Thank you.', '2024-01-14 17:55:56', '2024-01-14 17:55:56'),
(545, 20, 697, 'Appointment Created', 'Dear test, Your appointment is successfully created on 2024-01-26 at 10:00 AM in Epilworld. Your booking id is #29722. Thank you.', '2024-01-14 17:57:26', '2024-01-14 17:57:26'),
(546, 22, 701, 'Appointment Created', 'Dear ccccc, Your appointment is successfully created on 2024-01-24 at 11:00 AM in Epilworld. Your booking id is #63780. Thank you.', '2024-01-14 17:58:04', '2024-01-14 17:58:04'),
(547, 21, 705, 'Appointment Created', 'Dear not the test, Your appointment is successfully created on 2024-01-22 at 10:00 AM in Epilworld. Your booking id is #27545. Thank you.', '2024-01-14 17:58:46', '2024-01-14 17:58:46'),
(548, 21, 709, 'Appointment Created', 'Dear not the test, Your appointment is successfully created on 2024-01-22 at 10:00 AM in Epilworld. Your booking id is #27545. Thank you.', '2024-01-14 18:01:33', '2024-01-14 18:01:33'),
(549, 21, 713, 'Appointment Created', 'Dear not the test, Your appointment is successfully created on 2024-01-22 at 10:00 AM in Epilworld. Your booking id is #27545. Thank you.', '2024-01-14 18:02:44', '2024-01-14 18:02:44'),
(550, 21, 717, 'Appointment Created', 'Dear not the test, Your appointment is successfully created on 2024-01-22 at 10:00 AM in Epilworld. Your booking id is #27545. Thank you.', '2024-01-14 18:04:46', '2024-01-14 18:04:46'),
(551, 21, 721, 'Appointment Created', 'Dear not the test, Your appointment is successfully created on 2024-01-22 at 10:00 AM in Epilworld. Your booking id is #27545. Thank you.', '2024-01-14 18:05:07', '2024-01-14 18:05:07'),
(552, 21, 725, 'Appointment Created', 'Dear not the test, Your appointment is successfully created on 2024-01-22 at 10:00 AM in Epilworld. Your booking id is #27545. Thank you.', '2024-01-14 18:05:11', '2024-01-14 18:05:11'),
(553, 21, 729, 'Appointment Created', 'Dear not the test, Your appointment is successfully created on 2024-01-22 at 10:00 AM in Epilworld. Your booking id is #27545. Thank you.', '2024-01-14 18:05:13', '2024-01-14 18:05:13'),
(554, 21, 733, 'Appointment Created', 'Dear not the test, Your appointment is successfully created on 2024-01-22 at 10:00 AM in Epilworld. Your booking id is #27545. Thank you.', '2024-01-14 18:10:11', '2024-01-14 18:10:11'),
(555, 21, 737, 'Appointment Created', 'Dear not the test, Your appointment is successfully created on 2024-01-22 at 10:00 AM in Epilworld. Your booking id is #27545. Thank you.', '2024-01-14 18:11:26', '2024-01-14 18:11:26'),
(556, 21, 741, 'Appointment Created', 'Dear not the test, Your appointment is successfully created on 2024-01-22 at 10:00 AM in Epilworld. Your booking id is #27545. Thank you.', '2024-01-14 18:11:37', '2024-01-14 18:11:37'),
(557, 21, 745, 'Appointment Created', 'Dear not the test, Your appointment is successfully created on 2024-01-22 at 10:00 AM in Epilworld. Your booking id is #27545. Thank you.', '2024-01-14 18:12:02', '2024-01-14 18:12:02'),
(558, 21, 749, 'Appointment Created', 'Dear not the test, Your appointment is successfully created on 2024-01-22 at 10:00 AM in Epilworld. Your booking id is #27545. Thank you.', '2024-01-14 18:13:20', '2024-01-14 18:13:20'),
(559, 21, 754, 'Appointment Created', 'Dear not the test, Your appointment is successfully created on 2024-01-22 at 10:00 AM in Epilworld. Your booking id is #27545. Thank you.', '2024-01-14 18:14:45', '2024-01-14 18:14:45'),
(560, 21, 758, 'Appointment Created', 'Dear not the test, Your appointment is successfully created on 2024-01-22 at 10:00 AM in Epilworld. Your booking id is #27545. Thank you.', '2024-01-14 18:16:55', '2024-01-14 18:16:55'),
(561, 20, 762, 'Appointment Created', 'Dear test, Your appointment is successfully created on 2024-01-24 at 10:00 AM in Epilworld. Your booking id is #47366. Thank you.', '2024-01-14 18:19:52', '2024-01-14 18:19:52'),
(562, 21, 767, 'Appointment Created', 'Dear not the test, Your appointment is successfully created on 2024-01-22 at 10:00 AM in Epilworld. Your booking id is #27545. Thank you.', '2024-01-14 18:22:00', '2024-01-14 18:22:00'),
(563, 22, 773, 'Appointment Created', 'Dear ccccc, Your appointment is successfully created on 2024-01-22 at 10:00 AM in Epilworld. Your booking id is #38019. Thank you.', '2024-01-14 18:51:10', '2024-01-14 18:51:10'),
(564, 22, 777, 'Appointment Created', 'Dear ccccc, Your appointment is successfully created on 2024-01-22 at 10:00 AM in Epilworld. Your booking id is #38019. Thank you.', '2024-01-14 18:51:23', '2024-01-14 18:51:23'),
(565, 22, 783, 'Appointment Created', 'Dear ccccc, Your appointment is successfully created on 2024-01-22 at 10:00 AM in Epilworld. Your booking id is #38019. Thank you.', '2024-01-14 18:54:25', '2024-01-14 18:54:25'),
(566, 22, 787, 'Appointment Created', 'Dear ccccc, Your appointment is successfully created on 2024-01-22 at 10:00 AM in Epilworld. Your booking id is #38019. Thank you.', '2024-01-14 18:54:36', '2024-01-14 18:54:36'),
(567, 20, 791, 'Appointment Created', 'Dear test, Your appointment is successfully created on 2024-01-24 at 10:00 AM in Epilworld. Your booking id is #57543. Thank you.', '2024-01-14 18:55:34', '2024-01-14 18:55:34'),
(568, 22, 795, 'Appointment Created', 'Dear ccccc, Your appointment is successfully created on 2024-01-22 at 10:00 AM in Epilworld. Your booking id is #85911. Thank you.', '2024-01-14 18:56:21', '2024-01-14 18:56:21'),
(569, 20, 799, 'Appointment Created', 'Dear test, Your appointment is successfully created on 2024-01-26 at 10:00 AM in Epilworld. Your booking id is #46854. Thank you.', '2024-01-14 18:57:10', '2024-01-14 18:57:10'),
(570, 21, 803, 'Appointment Created', 'Dear not the test, Your appointment is successfully created on 2024-01-24 at 11:00 AM in Epilworld. Your booking id is #14855. Thank you.', '2024-01-14 18:57:54', '2024-01-14 18:57:54'),
(571, 21, 807, 'Appointment Created', 'Dear not the test, Your appointment is successfully created on 2024-01-22 at 10:00 AM in Epilworld. Your booking id is #28055. Thank you.', '2024-01-14 18:58:29', '2024-01-14 18:58:29'),
(572, 25, 811, 'Appointment Created', 'Dear cccccccccccccccccccccccccccccccc, Your appointment is successfully created on 2024-01-22 at 10:00 AM in Epilworld. Your booking id is #97175. Thank you.', '2024-01-14 19:01:34', '2024-01-14 19:01:34'),
(573, 24, 815, 'Appointment Created', 'Dear cxycxycxycxy, Your appointment is successfully created on 2024-01-22 at 10:00 AM in Epilworld. Your booking id is #64877. Thank you.', '2024-01-14 19:05:33', '2024-01-14 19:05:33'),
(574, 24, 819, 'Appointment Created', 'Dear cxycxycxycxy, Your appointment is successfully created on 2024-01-22 at 10:00 AM in Epilworld. Your booking id is #45467. Thank you.', '2024-01-14 19:06:48', '2024-01-14 19:06:48'),
(575, 24, 823, 'Appointment Created', 'Dear cxycxycxycxy, Your appointment is successfully created on 2024-01-22 at 10:00 AM in Epilworld. Your booking id is #33525. Thank you.', '2024-01-14 19:08:04', '2024-01-14 19:08:04'),
(576, 21, 827, 'Appointment Created', 'Dear not the test, Your appointment is successfully created on 2024-01-26 at 10:00 AM in Epilworld. Your booking id is #70538. Thank you.', '2024-01-14 19:16:26', '2024-01-14 19:16:26'),
(577, 22, 831, 'Appointment Created', 'Dear ccccc, Your appointment is successfully created on 2024-01-24 at 11:30 AM in Epilworld. Your booking id is #83437. Thank you.', '2024-01-14 19:17:00', '2024-01-14 19:17:00'),
(578, 25, 835, 'Appointment Created', 'Dear cccccccccccccccccccccccccccccccc, Your appointment is successfully created on 2024-01-22 at 10:00 AM in Epilworld. Your booking id is #56227. Thank you.', '2024-01-14 19:18:28', '2024-01-14 19:18:28'),
(579, 20, 839, 'Appointment Created', 'Dear test, Your appointment is successfully created on 2024-01-26 at 01:30 PM in Epilworld. Your booking id is #19786. Thank you.', '2024-01-14 19:19:27', '2024-01-14 19:19:27'),
(580, 25, 843, 'Appointment Created', 'Dear cccccccccccccccccccccccccccccccc, Your appointment is successfully created on 2024-01-22 at 10:00 AM in Epilworld. Your booking id is #50183. Thank you.', '2024-01-14 19:20:31', '2024-01-14 19:20:31'),
(581, 21, 847, 'Appointment Created', 'Dear not the test, Your appointment is successfully created on 2024-01-22 at 10:00 AM in Epilworld. Your booking id is #53307. Thank you.', '2024-01-14 19:21:53', '2024-01-14 19:21:53'),
(582, 21, 852, 'Appointment Created', 'Dear not the test, Your appointment is successfully created on 2024-01-27 at 10:00 AM in Epilworld. Your booking id is #89836. Thank you.', '2024-01-14 19:26:37', '2024-01-14 19:26:37'),
(583, 21, 859, 'Appointment Created', 'Dear not the test, Your appointment is successfully created on 2024-01-27 at 10:00 AM in Epilworld. Your booking id is #48402. Thank you.', '2024-01-14 19:31:15', '2024-01-14 19:31:15'),
(584, 21, 864, 'Appointment Created', 'Dear not the test, Your appointment is successfully created on 2024-01-27 at 10:00 AM in Epilworld. Your booking id is #48402. Thank you.', '2024-01-14 19:32:36', '2024-01-14 19:32:36'),
(585, 21, 871, 'Appointment Created', 'Dear not the test, Your appointment is successfully created on 2024-01-26 at 10:00 AM in Epilworld. Your booking id is #48402. Thank you.', '2024-01-14 19:35:00', '2024-01-14 19:35:00'),
(586, 22, 875, 'Appointment Created', 'Dear ccccc, Your appointment is successfully created on 2024-01-24 at 11:30 AM in Epilworld. Your booking id is #10698. Thank you.', '2024-01-14 19:35:42', '2024-01-14 19:35:42'),
(587, 25, 879, 'Appointment Created', 'Dear cccccccccccccccccccccccccccccccc, Your appointment is successfully created on 2024-01-22 at 12:00 PM in Epilworld. Your booking id is #62166. Thank you.', '2024-01-14 19:37:00', '2024-01-14 19:37:00'),
(588, 25, 883, 'Appointment Created', 'Dear cccccccccccccccccccccccccccccccc, Your appointment is successfully created on 2024-01-29 at 12:30 PM in Epilworld. Your booking id is #19678_335. Thank you.', '2024-01-14 19:44:53', '2024-01-14 19:44:53'),
(589, 25, 887, 'Appointment Created', 'Dear cccccccccccccccccccccccccccccccc, Your appointment is successfully created on 2024-01-29 at 01:30 PM in Epilworld. Your booking id is #19678_723. Thank you.', '2024-01-14 19:45:46', '2024-01-14 19:45:46'),
(590, 25, 891, 'Appointment Created', 'Dear cccccccccccccccccccccccccccccccc, Your appointment is successfully created on 2024-01-29 at 02:30 PM in Epilworld. Your booking id is #19678_941. Thank you.', '2024-01-14 19:45:53', '2024-01-14 19:45:53'),
(591, 25, 895, 'Appointment Created', 'Dear cccccccccccccccccccccccccccccccc, Your appointment is successfully created on 2024-01-29 at 03:30 PM in Epilworld. Your booking id is #19678_377. Thank you.', '2024-01-14 19:46:12', '2024-01-14 19:46:12'),
(592, 25, 899, 'Appointment Created', 'Dear cccccccccccccccccccccccccccccccc, Your appointment is successfully created on 2024-01-30 at 12:30 PM in Epilworld. Your booking id is #19678_266. Thank you.', '2024-01-14 19:46:19', '2024-01-14 19:46:19'),
(593, 25, 903, 'Appointment Created', 'Dear cccccccccccccccccccccccccccccccc, Your appointment is successfully created on 2024-01-22 at 11:30 AM in Epilworld. Your booking id is #15232_579. Thank you.', '2024-01-14 19:49:06', '2024-01-14 19:49:06'),
(594, 25, 903, 'Booking status', 'Dear cccccccccccccccccccccccccccccccc, Your appointment on 2024-01-22 at 11:30 AM in Epilworld is now Completed. Your booking id is #15232_579. Thank you.', '2024-01-14 19:49:23', '2024-01-14 19:49:23'),
(595, 25, 902, 'Booking status', 'Dear cccccccccccccccccccccccccccccccc, Your appointment on 2024-01-19 at 11:30 AM in Epilworld is now Completed. Your booking id is #15232_579. Thank you.', '2024-01-14 19:49:25', '2024-01-14 19:49:25'),
(596, 25, 900, 'Booking status', 'Dear cccccccccccccccccccccccccccccccc, Your appointment on 2024-01-15 at 11:30 AM in Epilworld is now Réservée. Your booking id is #15232_579. Thank you.', '2024-01-14 19:51:28', '2024-01-14 19:51:28'),
(597, 23, 907, 'Appointment Created', 'Dear cxycxycxycxy, Your appointment is successfully created on 2024-01-22 at 12:00 PM in Epilworld. Your booking id is #64807_635. Thank you.', '2024-01-14 19:54:02', '2024-01-14 19:54:02'),
(598, 20, 909, 'Appointment Created', 'Dear test, Your appointment is successfully created on 2024-01-16 at 11:30 AM in Epilworld. Your booking id is #62568_588. Thank you.', '2024-01-14 19:59:55', '2024-01-14 19:59:55'),
(599, 21, 911, 'Appointment Created', 'Dear not the test, Your appointment is successfully created on 2024-01-22 at 10:00 AM in Epilworld. Your booking id is #46928_651. Thank you.', '2024-01-15 19:48:35', '2024-01-15 19:48:35'),
(600, 23, 915, 'Appointment Created', 'Dear cxycxycxycxy, Your appointment is successfully created on 2024-01-24 at 10:00 AM in Epilworld. Your booking id is #79631_265. Thank you.', '2024-01-15 19:50:16', '2024-01-15 19:50:16'),
(601, 21, 917, 'Appointment Created', 'Dear not the test, Your appointment is successfully created on 2024-01-18 at 11:00 AM in Epilworld. Your booking id is #69031_243. Thank you.', '2024-01-15 23:07:33', '2024-01-15 23:07:33'),
(602, 22, 922, 'Appointment Created', 'Dear ccccc, Your appointment is successfully created on 2024-01-24 at 11:30 AM in Epilworld. Your booking id is #70939_561. Thank you.', '2024-01-15 23:08:02', '2024-01-15 23:08:02'),
(603, 20, 924, 'Appointment Created', 'Dear test, Your appointment is successfully created on 2024-01-18 at 03:30 PM in Epilworld. Your booking id is #39543_725. Thank you.', '2024-01-16 11:50:50', '2024-01-16 11:50:50'),
(604, 22, 926, 'Appointment Created', 'Dear ccccc, Your appointment is successfully created on 2024-01-18 at 03:00 PM in Epilworld. Your booking id is #24132_633. Thank you.', '2024-01-16 11:51:12', '2024-01-16 11:51:12'),
(605, 22, 919, 'Booking status', 'Dear ccccc, Your appointment on 2024-01-18 at 11:30 AM in Epilworld is now in session. Your booking id is #70939_561. Thank you.', '2024-01-16 13:36:30', '2024-01-16 13:36:30'),
(606, 22, 918, 'Booking status', 'Dear ccccc, Your appointment on 2024-01-16 at 11:30 AM in Epilworld is now Approved. Your booking id is #70939_561. Thank you.', '2024-01-16 16:36:13', '2024-01-16 16:36:13'),
(607, 22, 918, 'Booking status', 'Dear ccccc, Your appointment on 2024-01-16 at 11:30 AM in Epilworld is now Completed. Your booking id is #70939_561. Thank you.', '2024-01-16 16:36:14', '2024-01-16 16:36:14'),
(608, 20, 924, 'Booking status', 'Dear test, Your appointment on 2024-01-18 at 03:30 PM in Epilworld is now Completed. Your booking id is #39543_725. Thank you.', '2024-01-16 16:54:03', '2024-01-16 16:54:03'),
(609, 21, 927, 'Appointment Created', 'Dear not the test, Your appointment is successfully created on 2024-01-16 at 10:00 AM in Epilworld. Your booking id is #15267_486. Thank you.', '2024-01-16 16:57:35', '2024-01-16 16:57:35'),
(610, 22, 929, 'Appointment Created', 'Dear ccccc, Your appointment is successfully created on 2024-01-17 at 10:00 AM in Epilworld. Your booking id is #18077_495. Thank you.', '2024-01-16 16:58:41', '2024-01-16 16:58:41'),
(611, 22, 928, 'Booking status', 'Dear ccccc, Your appointment on 2024-01-16 at 10:00 AM in Epilworld is now Completed. Your booking id is #18077_495. Thank you.', '2024-01-16 16:58:58', '2024-01-16 16:58:58'),
(612, 22, 929, 'Booking status', 'Dear ccccc, Your appointment on 2024-01-17 at 10:00 AM in Epilworld is now Completed. Your booking id is #18077_495. Thank you.', '2024-01-16 18:58:00', '2024-01-16 18:58:00'),
(613, 22, 929, 'Booking status', 'Dear ccccc, Your appointment on 2024-01-17 at 10:00 AM in Epilworld is now Réservée. Your booking id is #18077_495. Thank you.', '2024-01-16 19:19:39', '2024-01-16 19:19:39'),
(614, 22, 929, 'Booking status', 'Dear ccccc, Your appointment on 2024-01-17 at 10:00 AM in Epilworld is now Completed. Your booking id is #18077_495. Thank you.', '2024-01-16 22:38:26', '2024-01-16 22:38:26'),
(615, 22, 929, 'Booking status', 'Dear ccccc, Your appointment on 2024-01-17 at 10:00 AM in Epilworld is now Réservée. Your booking id is #18077_495. Thank you.', '2024-01-16 22:38:31', '2024-01-16 22:38:31'),
(616, 21, 931, 'Appointment Created', 'Dear not the test, Your appointment is successfully created on 2024-01-19 at 12:30 PM in Epilworld. Your booking id is #49591_819. Thank you.', '2024-01-17 12:31:19', '2024-01-17 12:31:19'),
(617, 20, 932, 'Appointment Created', 'Dear test, Your appointment is successfully created on 2024-01-17 at 04:00 PM in Epilworld. Your booking id is #27398_842. Thank you.', '2024-01-17 12:31:33', '2024-01-17 12:31:33'),
(618, 26, 934, 'Appointment Created', 'Dear 4654, Your appointment is successfully created on 2024-01-19 at 10:00 AM in Epilworld. Your booking id is #14019_113. Thank you.', '2024-01-17 12:31:49', '2024-01-17 12:31:49'),
(619, 23, 935, 'Appointment Created', 'Dear cxycxycxycxy, Your appointment is successfully created on 2024-01-17 at 02:00 PM in Epilworld. Your booking id is #60780_988. Thank you.', '2024-01-17 12:32:04', '2024-01-17 12:32:04'),
(620, 25, 936, 'Appointment Created', 'Dear cccccccccccccccccccccccccccccccc, Your appointment is successfully created on 2024-01-17 at 04:00 PM in Epilworld. Your booking id is #52304_430. Thank you.', '2024-01-17 12:32:23', '2024-01-17 12:32:23'),
(621, 21, 937, 'Appointment Created', 'Dear not the test, Your appointment is successfully created on 2024-01-17 at 10:30 AM in Epilworld. Your booking id is #40375_781. Thank you.', '2024-01-17 12:32:45', '2024-01-17 12:32:45'),
(622, 25, 938, 'Appointment Created', 'Dear cccccccccccccccccccccccccccccccc, Your appointment is successfully created on 2024-01-17 at 01:00 PM in Epilworld. Your booking id is #96594_225. Thank you.', '2024-01-17 12:33:09', '2024-01-17 12:33:09'),
(623, 24, 939, 'Appointment Created', 'Dear cxycxycxycxy, Your appointment is successfully created on 2024-01-17 at 04:00 PM in Epilworld. Your booking id is #47458_975. Thank you.', '2024-01-17 12:33:30', '2024-01-17 12:33:30'),
(624, 24, 939, 'Booking status', 'Dear cxycxycxycxy, Your appointment on 2024-01-17 at 04:00 PM in Epilworld is now Completed. Your booking id is #47458_975. Thank you.', '2024-01-17 12:44:55', '2024-01-17 12:44:55'),
(625, 21, 937, 'Booking status', 'Dear not the test, Your appointment on 2024-01-17 at 10:30 AM in Epilworld is now Completed. Your booking id is #40375_781. Thank you.', '2024-01-17 12:50:35', '2024-01-17 12:50:35'),
(626, 21, 940, 'Appointment Created', 'Dear not the test, Your appointment is successfully created on 2024-01-17 at 11:00 AM in Epilworld. Your booking id is #39077_819. Thank you.', '2024-01-17 13:03:41', '2024-01-17 13:03:41'),
(627, 21, 942, 'Appointment Created', 'Dear not the test, Your appointment is successfully created on 2024-01-19 at 10:30 AM in Epilworld. Your booking id is #29951_114. Thank you.', '2024-01-17 13:04:14', '2024-01-17 13:04:14'),
(628, 21, 941, 'Booking status', 'Dear not the test, Your appointment on 2024-01-17 at 10:30 AM in Epilworld is now Completed. Your booking id is #29951_114. Thank you.', '2024-01-17 13:04:42', '2024-01-17 13:04:42'),
(629, 22, 943, 'Appointment Created', 'Dear ccccc, Your appointment is successfully created on 2024-01-19 at 12:00 PM in Epilworld. Your booking id is #64529_296. Thank you.', '2024-01-17 14:11:46', '2024-01-17 14:11:46'),
(630, 23, 944, 'Appointment Created', 'Dear cxycxycxycxy, Your appointment is successfully created on 2024-01-17 at 01:00 PM in Epilworld. Your booking id is #86279_947. Thank you.', '2024-01-17 14:12:24', '2024-01-17 14:12:24'),
(631, 21, 945, 'Appointment Created', 'Dear not the test, Your appointment is successfully created on 2024-01-17 at 12:00 PM in Epilworld. Your booking id is #27650_506. Thank you.', '2024-01-17 14:34:14', '2024-01-17 14:34:14'),
(632, 22, 946, 'Appointment Created', 'Dear ccccc, Your appointment is successfully created on 2024-01-17 at 12:00 PM in Epilworld. Your booking id is #29448_949. Thank you.', '2024-01-17 15:52:01', '2024-01-17 15:52:01'),
(633, 21, 950, 'Appointment Created', 'Dear not the test, Your appointment is successfully created on 2024-01-23 at 03:00 PM in Epilworld. Your booking id is #27283_624. Thank you.', '2024-01-17 15:53:28', '2024-01-17 15:53:28'),
(634, 22, 951, 'Appointment Created', 'Dear ccccc, Your appointment is successfully created on 2024-01-17 at 11:00 AM in Epilworld. Your booking id is #93483_982. Thank you.', '2024-01-17 16:05:59', '2024-01-17 16:05:59'),
(635, 21, 954, 'Appointment Created', 'Dear not the test, Your appointment is successfully created on 2024-01-31 at 02:00 PM in Epilworld. Your booking id is #69109_519. Thank you.', '2024-01-17 16:08:51', '2024-01-17 16:08:51'),
(636, 21, 956, 'Appointment Created', 'Dear not the test, Your appointment is successfully created on 2024-01-27 at 10:30 AM in Epilworld. Your booking id is #94230_502. Thank you.', '2024-01-17 16:09:51', '2024-01-17 16:09:51'),
(637, 21, 959, 'Appointment Created', 'Dear not the test, Your appointment is successfully created on 2024-01-31 at 11:00 AM in Epilworld. Your booking id is #49581_151. Thank you.', '2024-01-17 16:24:12', '2024-01-17 16:24:12'),
(638, 21, 964, 'Appointment Created', 'Dear not the test, Your appointment is successfully created on 2024-01-31 at 12:00 PM in Epilworld. Your booking id is #34939_999. Thank you.', '2024-01-17 16:30:07', '2024-01-17 16:30:07'),
(639, 21, 962, 'Booking status', 'Dear not the test, Your appointment on 2024-01-17 at 12:00 PM in Epilworld is now Completed. Your booking id is #34939_378. Thank you.', '2024-01-17 16:43:11', '2024-01-17 16:43:11'),
(640, 21, 965, 'Appointment Created', 'Dear not the test, Your appointment is successfully created on 2024-01-17 at 11:00 AM in Epilworld. Your booking id is #21580_179. Thank you.', '2024-01-17 16:50:01', '2024-01-17 16:50:01'),
(641, 25, 966, 'Appointment Created', 'Dear cccccccccccccccccccccccccccccccc, Your appointment is successfully created on 2024-01-17 at 11:30 AM in Epilworld. Your booking id is #95332_409. Thank you.', '2024-01-17 16:51:31', '2024-01-17 16:51:31'),
(642, 20, 971, 'Appointment Created', 'Dear test, Your appointment is successfully created on 2024-01-19 at 01:00 PM in Epilworld. Your booking id is #77756_519. Thank you.', '2024-01-17 16:59:38', '2024-01-17 16:59:38'),
(643, 21, 980, 'Appointment Created', 'Dear not the test, Your appointment is successfully created on 2024-01-23 at 04:00 PM in Epilworld. Your booking id is #90110_973. Thank you.', '2024-01-17 17:00:35', '2024-01-17 17:00:35'),
(644, 21, 981, 'Appointment Created', 'Dear not the test, Your appointment is successfully created on 2024-01-17 at 11:00 AM in Epilworld. Your booking id is #46074_343. Thank you.', '2024-01-17 18:15:16', '2024-01-17 18:15:16'),
(645, 21, 981, 'Booking status', 'Dear not the test, Your appointment on 2024-01-17 at 11:00 AM in Epilworld is now Completed. Your booking id is #46074_343. Thank you.', '2024-01-17 18:15:43', '2024-01-17 18:15:43'),
(646, 22, 982, 'Appointment Created', 'Dear ccccc, Your appointment is successfully created on 2024-01-17 at 10:30 AM in Epilworld. Your booking id is #30761_661. Thank you.', '2024-01-17 20:02:59', '2024-01-17 20:02:59'),
(647, 22, 983, 'Appointment Created', 'Dear ccccc, Your appointment is successfully created on 2024-01-17 at 01:30 PM in Epilworld. Your booking id is #89318_530. Thank you.', '2024-01-17 20:25:27', '2024-01-17 20:25:27'),
(648, 21, 985, 'Appointment Created', 'Dear not the test, Your appointment is successfully created on 2024-01-19 at 10:30 AM in Epilworld. Your booking id is #90035_450. Thank you.', '2024-01-17 21:03:25', '2024-01-17 21:03:25'),
(649, 21, 985, 'Booking status', 'Dear not the test, Your appointment on 2024-01-19 at 10:30 AM in Epilworld is now Completed. Your booking id is #90035_450. Thank you.', '2024-01-18 12:34:34', '2024-01-18 12:34:34'),
(650, 22, 987, 'Appointment Created', 'Dear ccccc, Your appointment is successfully created on 2024-01-20 at 12:00 PM in Epilworld. Your booking id is #22373_635. Thank you.', '2024-01-18 12:36:28', '2024-01-18 12:36:28'),
(651, 23, 988, 'Appointment Created', 'Dear cxycxycxycxy, Your appointment is successfully created on 2024-01-18 at 12:30 PM in Epilworld. Your booking id is #69665_829. Thank you.', '2024-01-18 12:37:12', '2024-01-18 12:37:12'),
(652, 23, 988, 'Booking status', 'Dear cxycxycxycxy, Your appointment on 2024-01-18 at 12:30 PM in Epilworld is now Cancel. Your booking id is #69665_829. Thank you.', '2024-01-18 12:50:40', '2024-01-18 12:50:40'),
(653, 23, 988, 'Booking status', 'Dear cxycxycxycxy, Your appointment on 2024-01-18 at 12:30 PM in Epilworld is now Réservée. Your booking id is #69665_829. Thank you.', '2024-01-18 13:01:47', '2024-01-18 13:01:47'),
(654, 23, 988, 'Booking status', 'Dear cxycxycxycxy, Your appointment on 2024-01-18 at 12:30 PM in Epilworld is now Cancel. Your booking id is #69665_829. Thank you.', '2024-01-18 13:01:48', '2024-01-18 13:01:48'),
(655, 23, 988, 'Booking status', 'Dear cxycxycxycxy, Your appointment on 2024-01-18 at 12:30 PM in Epilworld is now Réservée. Your booking id is #69665_829. Thank you.', '2024-01-18 13:02:12', '2024-01-18 13:02:12'),
(656, 23, 988, 'Booking status', 'Dear cxycxycxycxy, Your appointment on 2024-01-18 at 12:30 PM in Epilworld is now Cancel. Your booking id is #69665_829. Thank you.', '2024-01-18 13:02:13', '2024-01-18 13:02:13'),
(657, 23, 988, 'Booking status', 'Dear cxycxycxycxy, Your appointment on 2024-01-18 at 12:30 PM in Epilworld is now Réservée. Your booking id is #69665_829. Thank you.', '2024-01-18 13:03:07', '2024-01-18 13:03:07'),
(658, 23, 988, 'Booking status', 'Dear cxycxycxycxy, Your appointment on 2024-01-18 at 12:30 PM in Epilworld is now Cancel. Your booking id is #69665_829. Thank you.', '2024-01-18 13:03:08', '2024-01-18 13:03:08'),
(659, 23, 988, 'Booking status', 'Dear cxycxycxycxy, Your appointment on 2024-01-18 at 12:30 PM in Epilworld is now Réservée. Your booking id is #69665_829. Thank you.', '2024-01-18 13:04:10', '2024-01-18 13:04:10'),
(660, 23, 988, 'Booking status', 'Dear cxycxycxycxy, Your appointment on 2024-01-18 at 12:30 PM in Epilworld is now Cancel. Your booking id is #69665_829. Thank you.', '2024-01-18 13:04:11', '2024-01-18 13:04:11'),
(661, 23, 988, 'Booking status', 'Dear cxycxycxycxy, Your appointment on 2024-01-18 at 12:30 PM in Epilworld is now Réservée. Your booking id is #69665_829. Thank you.', '2024-01-18 13:29:16', '2024-01-18 13:29:16'),
(662, 23, 988, 'Booking status', 'Dear cxycxycxycxy, Your appointment on 2024-01-18 at 12:30 PM in Epilworld is now Cancel. Your booking id is #69665_829. Thank you.', '2024-01-18 13:29:17', '2024-01-18 13:29:17'),
(663, 23, 988, 'Booking status', 'Dear cxycxycxycxy, Your appointment on 2024-01-18 at 12:30 PM in Epilworld is now Réservée. Your booking id is #69665_829. Thank you.', '2024-01-18 13:35:46', '2024-01-18 13:35:46'),
(664, 23, 988, 'Booking status', 'Dear cxycxycxycxy, Your appointment on 2024-01-18 at 12:30 PM in Epilworld is now Cancel. Your booking id is #69665_829. Thank you.', '2024-01-18 13:35:48', '2024-01-18 13:35:48'),
(665, 23, 988, 'Booking status', 'Dear cxycxycxycxy, Your appointment on 2024-01-18 at 12:30 PM in Epilworld is now Réservée. Your booking id is #69665_829. Thank you.', '2024-01-18 13:42:48', '2024-01-18 13:42:48'),
(666, 23, 988, 'Booking status', 'Dear cxycxycxycxy, Your appointment on 2024-01-18 at 12:30 PM in Epilworld is now Cancel. Your booking id is #69665_829. Thank you.', '2024-01-18 13:43:02', '2024-01-18 13:43:02'),
(667, 23, 988, 'Booking status', 'Dear cxycxycxycxy, Your appointment on 2024-01-18 at 12:30 PM in Epilworld is now in session. Your booking id is #69665_829. Thank you.', '2024-01-18 13:43:27', '2024-01-18 13:43:27'),
(668, 23, 988, 'Booking status', 'Dear cxycxycxycxy, Your appointment on 2024-01-18 at 12:30 PM in Epilworld is now Cancel. Your booking id is #69665_829. Thank you.', '2024-01-18 13:43:34', '2024-01-18 13:43:34'),
(669, 23, 988, 'Booking status', 'Dear cxycxycxycxy, Your appointment on 2024-01-18 at 12:30 PM in Epilworld is now Réservée. Your booking id is #69665_829. Thank you.', '2024-01-18 13:43:44', '2024-01-18 13:43:44'),
(670, 23, 988, 'Booking status', 'Dear cxycxycxycxy, Your appointment on 2024-01-18 at 12:30 PM in Epilworld is now in session. Your booking id is #69665_829. Thank you.', '2024-01-18 13:47:37', '2024-01-18 13:47:37'),
(671, 23, 988, 'Booking status', 'Dear cxycxycxycxy, Your appointment on 2024-01-18 at 12:30 PM in Epilworld is now Completed. Your booking id is #69665_829. Thank you.', '2024-01-18 13:47:54', '2024-01-18 13:47:54'),
(672, 23, 988, 'Booking status', 'Dear cxycxycxycxy, Your appointment on 2024-01-18 at 12:30 PM in Epilworld is now Cancel. Your booking id is #69665_829. Thank you.', '2024-01-18 13:48:04', '2024-01-18 13:48:04'),
(673, 23, 988, 'Booking status', 'Dear cxycxycxycxy, Your appointment on 2024-01-18 at 12:30 PM in Epilworld is now Réservée. Your booking id is #69665_829. Thank you.', '2024-01-18 13:48:12', '2024-01-18 13:48:12'),
(674, 23, 988, 'Booking status', 'Dear cxycxycxycxy, Your appointment on 2024-01-18 at 12:30 PM in Epilworld is now Cancel. Your booking id is #69665_829. Thank you.', '2024-01-18 13:48:13', '2024-01-18 13:48:13'),
(675, 23, 988, 'Booking status', 'Dear cxycxycxycxy, Your appointment on 2024-01-18 at 12:30 PM in Epilworld is now in session. Your booking id is #69665_829. Thank you.', '2024-01-18 13:48:14', '2024-01-18 13:48:14'),
(676, 23, 988, 'Booking status', 'Dear cxycxycxycxy, Your appointment on 2024-01-18 at 12:30 PM in Epilworld is now Cancel. Your booking id is #69665_829. Thank you.', '2024-01-18 13:48:15', '2024-01-18 13:48:15'),
(677, 23, 988, 'Booking status', 'Dear cxycxycxycxy, Your appointment on 2024-01-18 at 12:30 PM in Epilworld is now Réservée. Your booking id is #69665_829. Thank you.', '2024-01-18 13:48:23', '2024-01-18 13:48:23'),
(678, 23, 988, 'Booking status', 'Dear cxycxycxycxy, Your appointment on 2024-01-18 at 12:30 PM in Epilworld is now Cancel. Your booking id is #69665_829. Thank you.', '2024-01-18 13:48:24', '2024-01-18 13:48:24'),
(679, 23, 988, 'Booking status', 'Dear cxycxycxycxy, Your appointment on 2024-01-18 at 12:30 PM in Epilworld is now Approved. Your booking id is #69665_829. Thank you.', '2024-01-18 13:48:25', '2024-01-18 13:48:25'),
(680, 23, 988, 'Booking status', 'Dear cxycxycxycxy, Your appointment on 2024-01-18 at 12:30 PM in Epilworld is now Réservée. Your booking id is #69665_829. Thank you.', '2024-01-18 13:48:27', '2024-01-18 13:48:27'),
(681, 23, 988, 'Booking status', 'Dear cxycxycxycxy, Your appointment on 2024-01-18 at 12:30 PM in Epilworld is now Cancel. Your booking id is #69665_829. Thank you.', '2024-01-18 13:48:27', '2024-01-18 13:48:27'),
(682, 23, 988, 'Booking status', 'Dear cxycxycxycxy, Your appointment on 2024-01-18 at 12:30 PM in Epilworld is now Réservée. Your booking id is #69665_829. Thank you.', '2024-01-18 13:48:43', '2024-01-18 13:48:43'),
(683, 23, 988, 'Booking status', 'Dear cxycxycxycxy, Your appointment on 2024-01-18 at 12:30 PM in Epilworld is now Cancel. Your booking id is #69665_829. Thank you.', '2024-01-18 13:48:43', '2024-01-18 13:48:43'),
(684, 23, 988, 'Booking status', 'Dear cxycxycxycxy, Your appointment on 2024-01-18 at 12:30 PM in Epilworld is now Approved. Your booking id is #69665_829. Thank you.', '2024-01-18 13:50:22', '2024-01-18 13:50:22'),
(685, 23, 988, 'Booking status', 'Dear cxycxycxycxy, Your appointment on 2024-01-18 at 12:30 PM in Epilworld is now Réservée. Your booking id is #69665_829. Thank you.', '2024-01-18 13:50:27', '2024-01-18 13:50:27'),
(686, 23, 988, 'Booking status', 'Dear cxycxycxycxy, Your appointment on 2024-01-18 at 12:30 PM in Epilworld is now Completed. Your booking id is #69665_829. Thank you.', '2024-01-18 13:52:02', '2024-01-18 13:52:02'),
(687, 23, 988, 'Booking status', 'Dear cxycxycxycxy, Your appointment on 2024-01-18 at 12:30 PM in Epilworld is now Réservée. Your booking id is #69665_829. Thank you.', '2024-01-18 13:52:25', '2024-01-18 13:52:25'),
(688, 23, 988, 'Booking status', 'Dear cxycxycxycxy, Your appointment on 2024-01-18 at 12:30 PM in Epilworld is now Approved. Your booking id is #69665_829. Thank you.', '2024-01-18 13:52:39', '2024-01-18 13:52:39'),
(689, 23, 988, 'Booking status', 'Dear cxycxycxycxy, Your appointment on 2024-01-18 at 12:30 PM in Epilworld is now Completed. Your booking id is #69665_829. Thank you.', '2024-01-18 13:52:40', '2024-01-18 13:52:40'),
(690, 23, 988, 'Booking status', 'Dear cxycxycxycxy, Your appointment on 2024-01-18 at 12:30 PM in Epilworld is now Réservée. Your booking id is #69665_829. Thank you.', '2024-01-18 13:59:50', '2024-01-18 13:59:50'),
(691, 23, 988, 'Booking status', 'Dear cxycxycxycxy, Your appointment on 2024-01-18 at 12:30 PM in Epilworld is now Completed. Your booking id is #69665_829. Thank you.', '2024-01-18 13:59:52', '2024-01-18 13:59:52'),
(692, 23, 988, 'Booking status', 'Dear cxycxycxycxy, Your appointment on 2024-01-18 at 12:30 PM in Epilworld is now Completed. Your booking id is #69665_829. Thank you.', '2024-01-18 14:06:26', '2024-01-18 14:06:26'),
(693, 23, 988, 'Booking status', 'Dear cxycxycxycxy, Your appointment on 2024-01-18 at 12:30 PM in Epilworld is now Cancel. Your booking id is #69665_829. Thank you.', '2024-01-18 14:06:44', '2024-01-18 14:06:44'),
(694, 23, 988, 'Booking status', 'Dear cxycxycxycxy, Your appointment on 2024-01-18 at 12:30 PM in Epilworld is now Approved. Your booking id is #69665_829. Thank you.', '2024-01-18 14:07:28', '2024-01-18 14:07:28'),
(695, 23, 988, 'Booking status', 'Dear cxycxycxycxy, Your appointment on 2024-01-18 at 12:30 PM in Epilworld is now Cancel. Your booking id is #69665_829. Thank you.', '2024-01-18 14:07:31', '2024-01-18 14:07:31');
INSERT INTO `notification` (`id`, `user_id`, `booking_id`, `title`, `msg`, `created_at`, `updated_at`) VALUES
(696, 23, 988, 'Booking status', 'Dear cxycxycxycxy, Your appointment on 2024-01-18 at 12:30 PM in Epilworld is now in session. Your booking id is #69665_829. Thank you.', '2024-01-18 14:07:39', '2024-01-18 14:07:39'),
(697, 23, 988, 'Booking status', 'Dear cxycxycxycxy, Your appointment on 2024-01-18 at 12:30 PM in Epilworld is now Completed. Your booking id is #69665_829. Thank you.', '2024-01-18 14:07:44', '2024-01-18 14:07:44'),
(698, 23, 988, 'Booking status', 'Dear cxycxycxycxy, Your appointment on 2024-01-18 at 12:30 PM in Epilworld is now Cancel. Your booking id is #69665_829. Thank you.', '2024-01-18 14:10:04', '2024-01-18 14:10:04'),
(699, 23, 988, 'Booking status', 'Dear cxycxycxycxy, Your appointment on 2024-01-18 at 12:30 PM in Epilworld is now in session. Your booking id is #69665_829. Thank you.', '2024-01-18 14:10:09', '2024-01-18 14:10:09'),
(700, 20, 989, 'Appointment Created', 'Dear test, Your appointment is successfully created on 2024-01-18 at 01:30 PM in Epilworld. Your booking id is #13412_104. Thank you.', '2024-01-18 14:11:26', '2024-01-18 14:11:26'),
(701, 21, 991, 'Appointment Created', 'Dear not the test, Your appointment is successfully created on 2024-01-20 at 12:00 PM in Epilworld. Your booking id is #35962_659. Thank you.', '2024-01-18 14:12:37', '2024-01-18 14:12:37'),
(702, 21, 991, 'Booking status', 'Dear not the test, Your appointment on 2024-01-20 at 12:00 PM in Epilworld is now Cancel. Your booking id is #35962_659. Thank you.', '2024-01-18 14:13:03', '2024-01-18 14:13:03'),
(703, 21, 991, 'Booking status', 'Dear not the test, Your appointment on 2024-01-20 at 12:00 PM in Epilworld is now Réservée. Your booking id is #35962_659. Thank you.', '2024-01-18 14:13:18', '2024-01-18 14:13:18'),
(704, 21, 991, 'Booking status', 'Dear not the test, Your appointment on 2024-01-20 at 12:00 PM in Epilworld is now Cancel. Your booking id is #35962_659. Thank you.', '2024-01-18 14:13:22', '2024-01-18 14:13:22'),
(705, 21, 991, 'Booking status', 'Dear not the test, Your appointment on 2024-01-20 at 12:00 PM in Epilworld is now Réservée. Your booking id is #35962_659. Thank you.', '2024-01-18 14:13:39', '2024-01-18 14:13:39'),
(706, 21, 990, 'Booking status', 'Dear not the test, Your appointment on 2024-01-18 at 12:00 PM in Epilworld is now Cancel. Your booking id is #35962_659. Thank you.', '2024-01-18 14:29:13', '2024-01-18 14:29:13'),
(707, 21, 990, 'Booking status', 'Dear not the test, Your appointment on 2024-01-18 at 12:00 PM in Epilworld is now Cancel. Your booking id is #35962_659. Thank you.', '2024-01-18 14:30:36', '2024-01-18 14:30:36'),
(708, 21, 990, 'Booking status', 'Dear not the test, Your appointment on 2024-01-18 at 12:00 PM in Epilworld is now Cancel. Your booking id is #35962_659. Thank you.', '2024-01-18 14:31:38', '2024-01-18 14:31:38'),
(709, 21, 990, 'Booking status', 'Dear not the test, Your appointment on 2024-01-18 at 12:00 PM in Epilworld is now Cancel. Your booking id is #35962_659. Thank you.', '2024-01-18 14:36:13', '2024-01-18 14:36:13'),
(710, 21, 990, 'Booking status', 'Dear not the test, Your appointment on 2024-01-18 at 12:00 PM in Epilworld is now Cancel. Your booking id is #35962_659. Thank you.', '2024-01-18 14:36:50', '2024-01-18 14:36:50'),
(711, 21, 990, 'Booking status', 'Dear not the test, Your appointment on 2024-01-18 at 12:00 PM in Epilworld is now Cancel. Your booking id is #35962_659. Thank you.', '2024-01-18 14:38:15', '2024-01-18 14:38:15'),
(712, 21, 990, 'Booking status', 'Dear not the test, Your appointment on 2024-01-18 at 12:00 PM in Epilworld is now Cancel. Your booking id is #35962_659. Thank you.', '2024-01-18 14:39:54', '2024-01-18 14:39:54'),
(713, 21, 990, 'Booking status', 'Dear not the test, Your appointment on 2024-01-18 at 12:00 PM in Epilworld is now Cancel. Your booking id is #35962_659. Thank you.', '2024-01-18 14:40:37', '2024-01-18 14:40:37'),
(714, 21, 990, 'Booking status', 'Dear not the test, Your appointment on 2024-01-18 at 12:00 PM in Epilworld is now Cancel. Your booking id is #35962_659. Thank you.', '2024-01-18 14:41:10', '2024-01-18 14:41:10'),
(715, 21, 990, 'Booking status', 'Dear not the test, Your appointment on 2024-01-18 at 12:00 PM in Epilworld is now Cancel. Your booking id is #35962_659. Thank you.', '2024-01-18 15:03:46', '2024-01-18 15:03:46'),
(716, 21, 992, 'Appointment Created', 'Dear not the test, Your appointment is successfully created on 2024-01-18 at 02:00 PM in Epilworld. Your booking id is #55310_442. Thank you.', '2024-01-18 15:45:04', '2024-01-18 15:45:04'),
(717, 21, 991, 'Booking status', 'Dear not the test, Your appointment on 2024-01-20 at 12:00 PM in Epilworld is now Completed. Your booking id is #35962_659. Thank you.', '2024-01-18 15:47:39', '2024-01-18 15:47:39'),
(718, 21, 991, 'Booking status', 'Dear not the test, Your appointment on 2024-01-20 at 12:00 PM in Epilworld is now Approved. Your booking id is #35962_659. Thank you.', '2024-01-18 15:48:29', '2024-01-18 15:48:29'),
(719, 21, 991, 'Booking status', 'Dear not the test, Your appointment on 2024-01-20 at 12:00 PM in Epilworld is now in session. Your booking id is #35962_659. Thank you.', '2024-01-18 15:49:02', '2024-01-18 15:49:02'),
(720, 21, 1001, 'Appointment Created', 'Dear not the test, Your appointment is successfully created on 2024-01-28 at 12:30 AM in Epilworld. Your booking id is #43290_552. Thank you.', '2024-01-18 15:50:39', '2024-01-18 15:50:39'),
(721, 21, 1012, 'Appointment Created', 'Dear not the test, Your appointment is successfully created on 2024-01-24 at 11:30 AM in Epilworld. Your booking id is #16922_263. Thank you.', '2024-01-18 15:58:12', '2024-01-18 15:58:12'),
(722, 21, 1013, 'Appointment Created', 'Dear not the test, Your appointment is successfully created on 2024-01-18 at 04:30 PM in Epilworld. Your booking id is #96118_178. Thank you.', '2024-01-18 16:07:32', '2024-01-18 16:07:32'),
(723, 21, 1020, 'Appointment Created', 'Dear not the test, Your appointment is successfully created on 2024-01-24 at 01:00 PM in Epilworld. Your booking id is #37284_721. Thank you.', '2024-01-18 16:07:54', '2024-01-18 16:07:54'),
(724, 22, 1027, 'Appointment Created', 'Dear ccccc, Your appointment is successfully created on 2024-01-24 at 04:00 PM in Epilworld. Your booking id is #10183_353. Thank you.', '2024-01-18 16:23:26', '2024-01-18 16:23:26'),
(725, 22, 1028, 'Appointment Created', 'Dear ccccc, Your appointment is successfully created on 2024-01-18 at 10:30 AM in Epilworld. Your booking id is #90326_882. Thank you.', '2024-01-18 16:24:28', '2024-01-18 16:24:28'),
(726, 20, 1037, 'Appointment Created', 'Dear test, Your appointment is successfully created on 2024-01-26 at 11:00 AM in Epilworld. Your booking id is #53529_417. Thank you.', '2024-01-18 16:24:55', '2024-01-18 16:24:55'),
(727, 22, 1042, 'Appointment Created', 'Dear ccccc, Your appointment is successfully created on 2024-01-22 at 12:30 PM in Epilworld. Your booking id is #35428_464. Thank you.', '2024-01-18 16:26:39', '2024-01-18 16:26:39'),
(728, 22, 1047, 'Appointment Created', 'Dear ccccc, Your appointment is successfully created on 2024-01-22 at 03:00 PM in Epilworld. Your booking id is #35428_750. Thank you.', '2024-01-18 16:28:54', '2024-01-18 16:28:54'),
(729, 22, 1052, 'Appointment Created', 'Dear ccccc, Your appointment is successfully created on 2024-01-22 at 04:00 PM in Epilworld. Your booking id is #35428_722. Thank you.', '2024-01-18 16:30:13', '2024-01-18 16:30:13'),
(730, 22, 1057, 'Appointment Created', 'Dear ccccc, Your appointment is successfully created on 2024-01-22 at 12:30 PM in Epilworld. Your booking id is #35428_163. Thank you.', '2024-01-18 16:30:30', '2024-01-18 16:30:30'),
(731, 22, 1065, 'Appointment Created', 'Dear ccccc, Your appointment is successfully created on 2024-01-22 at 03:00 PM in Epilworld. Your booking id is #35428_581. Thank you.', '2024-01-18 16:32:26', '2024-01-18 16:32:26'),
(732, 22, 1078, 'Appointment Created', 'Dear ccccc, Your appointment is successfully created on 2024-01-22 at 12:30 PM in Epilworld. Your booking id is #35428_330. Thank you.', '2024-01-18 16:34:28', '2024-01-18 16:34:28'),
(733, 22, 1083, 'Appointment Created', 'Dear ccccc, Your appointment is successfully created on 2024-01-22 at 12:30 PM in Epilworld. Your booking id is #35428_736. Thank you.', '2024-01-18 16:35:01', '2024-01-18 16:35:01'),
(734, 22, 1088, 'Appointment Created', 'Dear ccccc, Your appointment is successfully created on 2024-01-22 at 12:30 PM in Epilworld. Your booking id is #35428_974. Thank you.', '2024-01-18 16:36:05', '2024-01-18 16:36:05'),
(735, 22, 1093, 'Appointment Created', 'Dear ccccc, Your appointment is successfully created on 2024-01-22 at 12:30 PM in Epilworld. Your booking id is #35428_130. Thank you.', '2024-01-18 16:36:39', '2024-01-18 16:36:39'),
(736, 22, 1098, 'Appointment Created', 'Dear ccccc, Your appointment is successfully created on 2024-01-22 at 12:30 PM in Epilworld. Your booking id is #35428_451. Thank you.', '2024-01-18 16:37:32', '2024-01-18 16:37:32'),
(737, 22, 1103, 'Appointment Created', 'Dear ccccc, Your appointment is successfully created on 2024-01-22 at 12:30 PM in Epilworld. Your booking id is #35428_858. Thank you.', '2024-01-18 16:37:58', '2024-01-18 16:37:58'),
(738, 22, 1108, 'Appointment Created', 'Dear ccccc, Your appointment is successfully created on 2024-01-22 at 12:30 PM in Epilworld. Your booking id is #35428_350. Thank you.', '2024-01-18 16:38:18', '2024-01-18 16:38:18'),
(739, 22, 1113, 'Appointment Created', 'Dear ccccc, Your appointment is successfully created on 2024-01-22 at 12:30 PM in Epilworld. Your booking id is #35428_148. Thank you.', '2024-01-18 16:38:55', '2024-01-18 16:38:55'),
(740, 22, 1118, 'Appointment Created', 'Dear ccccc, Your appointment is successfully created on 2024-01-22 at 03:00 PM in Epilworld. Your booking id is #35428_178. Thank you.', '2024-01-18 16:39:14', '2024-01-18 16:39:14'),
(741, 22, 1123, 'Appointment Created', 'Dear ccccc, Your appointment is successfully created on 2024-01-22 at 12:30 PM in Epilworld. Your booking id is #35428_682. Thank you.', '2024-01-18 16:39:51', '2024-01-18 16:39:51'),
(742, 22, 1128, 'Appointment Created', 'Dear ccccc, Your appointment is successfully created on 2024-01-22 at 12:30 PM in Epilworld. Your booking id is #35428_724. Thank you.', '2024-01-18 16:40:17', '2024-01-18 16:40:17'),
(743, 22, 1133, 'Appointment Created', 'Dear ccccc, Your appointment is successfully created on 2024-01-23 at 12:30 PM in Epilworld. Your booking id is #35428_391. Thank you.', '2024-01-18 16:40:58', '2024-01-18 16:40:58'),
(744, 20, 1135, 'Appointment Created', 'Dear test, Your appointment is successfully created on 2024-01-24 at 11:30 AM in Epilworld. Your booking id is #71594_936. Thank you.', '2024-01-18 17:38:38', '2024-01-18 17:38:38'),
(745, 21, 1141, 'Appointment Created', 'Dear not the test, Your appointment is successfully created on 2024-01-24 at 11:30 AM in Epilworld. Your booking id is #91023_250. Thank you.', '2024-01-18 17:39:09', '2024-01-18 17:39:09'),
(746, 21, 1141, 'Booking status', 'Dear not the test, Your appointment on 2024-01-24 at 11:30 AM in Epilworld is now Cancel. Your booking id is #91023_250. Thank you.', '2024-01-18 17:40:36', '2024-01-18 17:40:36'),
(747, 21, 1136, 'Booking status', 'Dear not the test, Your appointment on 2024-01-18 at 11:30 AM in Epilworld is now Réservée. Your booking id is #91023_250. Thank you.', '2024-01-18 17:41:45', '2024-01-18 17:41:45'),
(748, 21, 1139, 'Booking status', 'Dear not the test, Your appointment on 2024-01-22 at 11:30 AM in Epilworld is now Completed. Your booking id is #91023_250. Thank you.', '2024-01-18 17:42:06', '2024-01-18 17:42:06'),
(749, 21, 1136, 'Booking status', 'Dear not the test, Your appointment on 2024-01-18 at 11:30 AM in Epilworld is now Completed. Your booking id is #91023_250. Thank you.', '2024-01-18 17:53:35', '2024-01-18 17:53:35'),
(750, 21, 1137, 'Booking status', 'Dear not the test, Your appointment on 2024-01-19 at 11:30 AM in Epilworld is now Completed. Your booking id is #91023_250. Thank you.', '2024-01-18 17:53:41', '2024-01-18 17:53:41'),
(751, 21, 1138, 'Booking status', 'Dear not the test, Your appointment on 2024-01-20 at 02:00 PM in Epilworld is now Cancel. Your booking id is #91023_250. Thank you.', '2024-01-18 17:58:39', '2024-01-18 17:58:39'),
(752, 21, 1143, 'Appointment Created', 'Dear not the test, Your appointment is successfully created on 2024-01-25 at 11:00 AM in Epilworld. Your booking id is #95145_829. Thank you.', '2024-01-18 18:05:06', '2024-01-18 18:05:06'),
(753, 21, 1145, 'Appointment Created', 'Dear not the test, Your appointment is successfully created on 2024-01-25 at 11:00 AM in Epilworld. Your booking id is #95145_178. Thank you.', '2024-01-18 18:06:12', '2024-01-18 18:06:12'),
(754, 21, 1147, 'Appointment Created', 'Dear not the test, Your appointment is successfully created on 2024-01-25 at 12:00 PM in Epilworld. Your booking id is #95145_855. Thank you.', '2024-01-18 18:07:11', '2024-01-18 18:07:11'),
(755, 21, 1149, 'Appointment Created', 'Dear not the test, Your appointment is successfully created on 2024-01-27 at 08:00 AM in Epilworld. Your booking id is #31621_219. Thank you.', '2024-01-18 18:07:46', '2024-01-18 18:07:46'),
(756, 21, 1148, 'Booking status', 'Dear not the test, Your appointment on 2024-01-25 at 08:00 AM in Epilworld is now Completed. Your booking id is #31621_219. Thank you.', '2024-01-18 18:11:41', '2024-01-18 18:11:41'),
(757, 21, 1151, 'Appointment Created', 'Dear not the test, Your appointment is successfully created on 2024-01-20 at 09:30 AM in Epilworld. Your booking id is #85564_236. Thank you.', '2024-01-18 18:13:13', '2024-01-18 18:13:13'),
(758, 20, 1153, 'Appointment Created', 'Dear test, Your appointment is successfully created on 2024-01-20 at 10:00 AM in Epilworld. Your booking id is #87374_460. Thank you.', '2024-01-18 18:14:21', '2024-01-18 18:14:21'),
(759, 24, 1155, 'Appointment Created', 'Dear cxycxycxycxy, Your appointment is successfully created on 2024-01-19 at 09:30 AM in Epilworld. Your booking id is #17473_444. Thank you.', '2024-01-18 18:16:39', '2024-01-18 18:16:39'),
(760, 22, 1158, 'Appointment Created', 'Dear ccccc, Your appointment is successfully created on 2024-01-20 at 09:30 AM in Epilworld. Your booking id is #65597_279. Thank you.', '2024-01-18 18:19:34', '2024-01-18 18:19:34'),
(761, 20, 1160, 'Appointment Created', 'Dear test, Your appointment is successfully created on 2024-01-19 at 09:30 AM in Epilworld. Your booking id is #65597_670. Thank you.', '2024-01-18 18:20:24', '2024-01-18 18:20:24'),
(762, 20, 1163, 'Appointment Created', 'Dear test, Your appointment is successfully created on 2024-01-19 at 09:30 AM in Epilworld. Your booking id is #65597_599. Thank you.', '2024-01-18 18:22:06', '2024-01-18 18:22:06'),
(763, 20, 1166, 'Appointment Created', 'Dear test, Your appointment is successfully created on 2024-01-19 at 09:30 AM in Epilworld. Your booking id is #65597_423. Thank you.', '2024-01-18 19:08:13', '2024-01-18 19:08:13'),
(764, 20, 1168, 'Appointment Created', 'Dear test, Your appointment is successfully created on 2024-01-19 at 09:30 AM in Epilworld. Your booking id is #65597_156. Thank you.', '2024-01-18 19:08:40', '2024-01-18 19:08:40'),
(765, 21, 1169, 'Appointment Created', 'Dear not the test, Your appointment is successfully created on 2024-01-18 at 09:30 AM in Epilworld. Your booking id is #81578_256. Thank you.', '2024-01-18 19:11:01', '2024-01-18 19:11:01'),
(766, 21, 1174, 'Appointment Created', 'Dear not the test, Your appointment is successfully created on 2024-01-19 at 12:00 PM in Epilworld. Your booking id is #81578_962. Thank you.', '2024-01-18 19:12:28', '2024-01-18 19:12:28'),
(767, 23, 1179, 'Appointment Created', 'Dear cxycxycxycxy, Your appointment is successfully created on 2024-01-22 at 10:00 AM in Epilworld. Your booking id is #43341_985. Thank you.', '2024-01-18 19:14:04', '2024-01-18 19:14:04'),
(768, 21, 1184, 'Appointment Created', 'Dear not the test, Your appointment is successfully created on 2024-01-22 at 09:00 AM in Epilworld. Your booking id is #26481_438. Thank you.', '2024-01-18 19:15:05', '2024-01-18 19:15:05'),
(769, 21, 1186, 'Appointment Created', 'Dear not the test, Your appointment is successfully created on 2024-01-25 at 09:30 AM in Epilworld. Your booking id is #35624_493. Thank you.', '2024-01-18 19:19:27', '2024-01-18 19:19:27'),
(770, 22, 1189, 'Appointment Created', 'Dear ccccc, Your appointment is successfully created on 2024-01-24 at 09:00 AM in Epilworld. Your booking id is #15967_308. Thank you.', '2024-01-18 19:20:24', '2024-01-18 19:20:24'),
(771, 25, 1196, 'Appointment Created', 'Dear cccccccccccccccccccccccccccccccc, Your appointment is successfully created on 2024-01-25 at 12:00 PM in Epilworld. Your booking id is #60032_969. Thank you.', '2024-01-18 19:22:11', '2024-01-18 19:22:11'),
(772, 21, 1202, 'Appointment Created', 'Dear not the test, Your appointment is successfully created on 2024-01-24 at 09:30 AM in Epilworld. Your booking id is #86907_370. Thank you.', '2024-01-18 19:29:36', '2024-01-18 19:29:36'),
(773, 26, 1206, 'Appointment Created', 'Dear 4654, Your appointment is successfully created on 2024-01-26 at 09:30 AM in Epilworld. Your booking id is #19189_191. Thank you.', '2024-01-18 19:32:36', '2024-01-18 19:32:36'),
(774, 22, 1207, 'Appointment Created', 'Dear ccccc, Your appointment is successfully created on 2024-01-22 at 09:00 AM in Epilworld. Your booking id is #16599_460. Thank you.', '2024-01-18 19:35:40', '2024-01-18 19:35:40'),
(775, 22, 1211, 'Appointment Created', 'Dear ccccc, Your appointment is successfully created on 2024-01-23 at 09:00 AM in Epilworld. Your booking id is #42005_572. Thank you.', '2024-01-18 19:38:52', '2024-01-18 19:38:52'),
(776, 21, 1214, 'Appointment Created', 'Dear not the test, Your appointment is successfully created on 2024-01-23 at 09:00 AM in Epilworld. Your booking id is #82388_492. Thank you.', '2024-01-18 19:46:54', '2024-01-18 19:46:54'),
(777, 21, 1219, 'Appointment Created', 'Dear not the test, Your appointment is successfully created on 2024-01-23 at 09:00 AM in Epilworld. Your booking id is #82388_308. Thank you.', '2024-01-18 19:49:08', '2024-01-18 19:49:08'),
(778, 21, 1222, 'Appointment Created', 'Dear not the test, Your appointment is successfully created on 2024-01-23 at 09:00 AM in Epilworld. Your booking id is #82388_193. Thank you.', '2024-01-18 19:50:14', '2024-01-18 19:50:14'),
(779, 21, 1225, 'Appointment Created', 'Dear not the test, Your appointment is successfully created on 2024-01-23 at 09:00 AM in Epilworld. Your booking id is #82388_820. Thank you.', '2024-01-18 19:52:49', '2024-01-18 19:52:49'),
(780, 21, 1231, 'Appointment Created', 'Dear not the test, Your appointment is successfully created on 2024-01-23 at 09:00 AM in Epilworld. Your booking id is #82388_736. Thank you.', '2024-01-18 19:58:39', '2024-01-18 19:58:39'),
(781, 21, 1235, 'Appointment Created', 'Dear not the test, Your appointment is successfully created on 2024-01-23 at 09:00 AM in Epilworld. Your booking id is #82388_707. Thank you.', '2024-01-18 20:00:47', '2024-01-18 20:00:47'),
(782, 21, 1237, 'Appointment Created', 'Dear not the test, Your appointment is successfully created on 2024-01-23 at 09:00 AM in Epilworld. Your booking id is #82388_789. Thank you.', '2024-01-18 20:02:15', '2024-01-18 20:02:15'),
(783, 22, 1285, 'Appointment Created', 'Dear ccccc, Your appointment is successfully created on 2024-01-23 at 09:30 AM in Epilworld. Your booking id is #38713_768. Thank you.', '2024-01-18 20:30:55', '2024-01-18 20:30:55'),
(784, 21, 1287, 'Appointment Created', 'Dear not the test, Your appointment is successfully created on 2024-01-22 at 09:30 AM in Epilworld. Your booking id is #77375_242. Thank you.', '2024-01-18 20:31:49', '2024-01-18 20:31:49'),
(785, 21, 1290, 'Appointment Created', 'Dear not the test, Your appointment is successfully created on 2024-01-20 at 09:30 AM in Epilworld. Your booking id is #37700_384. Thank you.', '2024-01-18 20:32:17', '2024-01-18 20:32:17'),
(786, 23, 1292, 'Appointment Created', 'Dear cxycxycxycxy, Your appointment is successfully created on 2024-01-19 at 11:30 AM in Epilworld. Your booking id is #51785_188. Thank you.', '2024-01-18 20:33:59', '2024-01-18 20:33:59'),
(787, 21, 1293, 'Appointment Created', 'Dear not the test, Your appointment is successfully created on 2024-01-18 at 09:30 AM in Epilworld. Your booking id is #15422_726. Thank you.', '2024-01-18 20:37:36', '2024-01-18 20:37:36'),
(788, 20, 1297, 'Appointment Created', 'Dear test, Your appointment is successfully created on 2024-01-19 at 12:50 PM in Epilworld. Your booking id is #63970_918. Thank you.', '2024-01-18 20:38:39', '2024-01-18 20:38:39'),
(789, 21, 1298, 'Appointment Created', 'Dear not the test, Your appointment is successfully created on 2024-01-18 at 09:30 AM in Epilworld. Your booking id is #94430_175. Thank you.', '2024-01-18 20:39:29', '2024-01-18 20:39:29'),
(790, 21, 1300, 'Appointment Created', 'Dear not the test, Your appointment is successfully created on 2024-01-19 at 12:00 PM in Epilworld. Your booking id is #74189_573. Thank you.', '2024-01-18 20:40:21', '2024-01-18 20:40:21'),
(791, 21, 1299, 'Booking status', 'Dear not the test, Your appointment on 2024-01-18 at 09:30 AM in Epilworld is now Cancel. Your booking id is #74189_573. Thank you.', '2024-01-18 21:58:47', '2024-01-18 21:58:47'),
(792, 21, 1302, 'Appointment Created', 'Dear not the test, Your appointment is successfully created on 2024-01-20 at 11:30 AM in Epilworld. Your booking id is #73043_943. Thank you.', '2024-01-18 21:59:20', '2024-01-18 21:59:20'),
(793, 21, 1302, 'Booking status', 'Dear not the test, Your appointment on 2024-01-20 at 11:30 AM in Epilworld is now Cancel. Your booking id is #73043_943. Thank you.', '2024-01-18 22:00:07', '2024-01-18 22:00:07'),
(794, 21, 1301, 'Booking status', 'Dear not the test, Your appointment on 2024-01-18 at 11:30 AM in Epilworld is now Completed. Your booking id is #73043_943. Thank you.', '2024-01-18 22:03:57', '2024-01-18 22:03:57'),
(795, 21, 1302, 'Booking status', 'Dear not the test, Your appointment on 2024-01-20 at 11:30 AM in Epilworld is now Completed. Your booking id is #73043_943. Thank you.', '2024-01-18 22:07:02', '2024-01-18 22:07:02'),
(796, 21, 1301, 'Booking status', 'Dear not the test, Your appointment on 2024-01-18 at 11:30 AM in Epilworld is now Cancel. Your booking id is #73043_943. Thank you.', '2024-01-18 22:07:58', '2024-01-18 22:07:58'),
(797, 21, 1301, 'Booking status', 'Dear not the test, Your appointment on 2024-01-18 at 11:30 AM in Epilworld is now Completed. Your booking id is #73043_943. Thank you.', '2024-01-18 22:10:18', '2024-01-18 22:10:18'),
(798, 21, 1303, 'Appointment Created', 'Dear not the test, Your appointment is successfully created on 2024-01-19 at 10:30 AM in Epilworld. Your booking id is #70409_873. Thank you.', '2024-01-19 13:59:33', '2024-01-19 13:59:33'),
(799, 22, 1304, 'Appointment Created', 'Dear ccccc, Your appointment is successfully created on 2024-01-22 at 09:00 AM in Epilworld. Your booking id is #44819_823. Thank you.', '2024-01-19 14:15:15', '2024-01-19 14:15:15'),
(800, 21, 1312, 'Appointment Created', 'Dear not the test, Your appointment is successfully created on 2024-01-27 at 09:30 AM in Epilworld. Your booking id is #51534_673. Thank you.', '2024-01-19 14:16:03', '2024-01-19 14:16:03'),
(801, 21, 1320, 'Appointment Created', 'Dear not the test, Your appointment is successfully created on 2024-01-27 at 10:00 AM in Epilworld. Your booking id is #78202_307. Thank you.', '2024-01-19 14:20:16', '2024-01-19 14:20:16'),
(802, 21, 1321, 'Appointment Created', 'Dear not the test, Your appointment is successfully created on 2024-01-20 at 09:30 AM in Epilworld. Your booking id is #26381_488. Thank you.', '2024-01-19 14:22:53', '2024-01-19 14:22:53'),
(803, 22, 1323, 'Appointment Created', 'Dear ccccc, Your appointment is successfully created on 2024-01-20 at 10:00 AM in Epilworld. Your booking id is #53137_910. Thank you.', '2024-01-19 14:23:16', '2024-01-19 14:23:16'),
(804, 21, 1324, 'Appointment Created', 'Dear not the test, Your appointment is successfully created on 2024-01-20 at 09:30 AM in Epilworld. Your booking id is #33955_875. Thank you.', '2024-01-19 14:23:55', '2024-01-19 14:23:55'),
(805, 24, 1326, 'Appointment Created', 'Dear cxycxycxycxy, Your appointment is successfully created on 2024-01-20 at 10:00 AM in Epilworld. Your booking id is #99640_127. Thank you.', '2024-01-19 14:24:15', '2024-01-19 14:24:15'),
(806, 21, 1328, 'Appointment Created', 'Dear not the test, Your appointment is successfully created on 2024-01-20 at 12:00 PM in Epilworld. Your booking id is #61604_718. Thank you.', '2024-01-19 14:24:55', '2024-01-19 14:24:55'),
(807, 22, 1336, 'Appointment Created', 'Dear ccccc, Your appointment is successfully created on 2024-01-26 at 09:30 AM in Epilworld. Your booking id is #35092_796. Thank you.', '2024-01-19 15:07:52', '2024-01-19 15:07:52'),
(808, 21, 1338, 'Appointment Created', 'Dear not the test, Your appointment is successfully created on 2024-01-25 at 10:00 AM in Epilworld. Your booking id is #82631_179. Thank you.', '2024-01-19 15:09:28', '2024-01-19 15:09:28'),
(809, 22, 1341, 'Appointment Created', 'Dear ccccc, Your appointment is successfully created on 2024-01-25 at 12:30 PM in Epilworld. Your booking id is #74406_289. Thank you.', '2024-01-19 15:10:04', '2024-01-19 15:10:04'),
(810, 21, 1345, 'Appointment Created', 'Dear not the test, Your appointment is successfully created on 2024-01-26 at 10:00 AM in Epilworld. Your booking id is #61783_519. Thank you.', '2024-01-19 15:12:11', '2024-01-19 15:12:11'),
(811, 25, 1350, 'Appointment Created', 'Dear cccccccccccccccccccccccccccccccc, Your appointment is successfully created on 2024-01-26 at 10:30 AM in Epilworld. Your booking id is #92038_163. Thank you.', '2024-01-19 15:13:09', '2024-01-19 15:13:09'),
(812, 24, 1355, 'Appointment Created', 'Dear cxycxycxycxy, Your appointment is successfully created on 2024-01-26 at 10:30 AM in Epilworld. Your booking id is #69585_376. Thank you.', '2024-01-19 15:15:20', '2024-01-19 15:15:20'),
(813, 21, 1362, 'Appointment Created', 'Dear not the test, Your appointment is successfully created on 2024-01-25 at 10:30 AM in Epilworld. Your booking id is #94332_566. Thank you.', '2024-01-19 15:28:33', '2024-01-19 15:28:33'),
(814, 20, 1381, 'Appointment Created', 'Dear test, Your appointment is successfully created on 2024-01-25 at 10:00 AM in Epilworld. Your booking id is #51481_933. Thank you.', '2024-01-19 15:53:31', '2024-01-19 15:53:31'),
(815, 20, 1384, 'Appointment Created', 'Dear test, Your appointment is successfully created on 2024-01-25 at 01:20 PM in Epilworld. Your booking id is #51481_322. Thank you.', '2024-01-19 15:58:53', '2024-01-19 15:58:53'),
(816, 21, 1389, 'Appointment Created', 'Dear not the test, Your appointment is successfully created on 2024-01-26 at 09:30 AM in Epilworld. Your booking id is #73857_979. Thank you.', '2024-01-19 16:03:18', '2024-01-19 16:03:18'),
(817, 24, 1392, 'Appointment Created', 'Dear cxycxycxycxy, Your appointment is successfully created on 2024-01-25 at 12:00 PM in Epilworld. Your booking id is #26064_147. Thank you.', '2024-01-19 16:04:34', '2024-01-19 16:04:34'),
(818, 21, 1395, 'Appointment Created', 'Dear not the test, Your appointment is successfully created on 2024-01-24 at 02:00 PM in Epilworld. Your booking id is #10749_412. Thank you.', '2024-01-19 16:05:26', '2024-01-19 16:05:26'),
(819, 21, 1398, 'Appointment Created', 'Dear not the test, Your appointment is successfully created on 2024-01-25 at 01:20 PM in Epilworld. Your booking id is #73174_419. Thank you.', '2024-01-19 16:07:59', '2024-01-19 16:07:59'),
(820, 21, 1401, 'Appointment Created', 'Dear not the test, Your appointment is successfully created on 2024-01-25 at 01:20 PM in Epilworld. Your booking id is #73174_790. Thank you.', '2024-01-19 16:17:19', '2024-01-19 16:17:19'),
(821, 21, 1404, 'Appointment Created', 'Dear not the test, Your appointment is successfully created on 2024-01-25 at 10:00 AM in Epilworld. Your booking id is #73174_102. Thank you.', '2024-01-19 16:23:58', '2024-01-19 16:23:58'),
(822, 21, 1407, 'Appointment Created', 'Dear not the test, Your appointment is successfully created on 2024-01-25 at 10:00 AM in Epilworld. Your booking id is #73174_594. Thank you.', '2024-01-19 16:24:24', '2024-01-19 16:24:24'),
(823, 21, 1415, 'Appointment Created', 'Dear not the test, Your appointment is successfully created on 2024-01-25 at 01:20 PM in Epilworld. Your booking id is #73174_431. Thank you.', '2024-01-19 16:30:44', '2024-01-19 16:30:44'),
(824, 21, 1418, 'Appointment Created', 'Dear not the test, Your appointment is successfully created on 2024-01-25 at 01:20 PM in Epilworld. Your booking id is #73174_429. Thank you.', '2024-01-19 16:33:03', '2024-01-19 16:33:03'),
(825, 21, 1421, 'Appointment Created', 'Dear not the test, Your appointment is successfully created on 2024-01-25 at 01:20 PM in Epilworld. Your booking id is #73174_265. Thank you.', '2024-01-19 16:34:58', '2024-01-19 16:34:58'),
(826, 21, 1436, 'Appointment Created', 'Dear not the test, Your appointment is successfully created on 2024-01-25 at 01:50 PM in Epilworld. Your booking id is #73174_402. Thank you.', '2024-01-19 16:43:22', '2024-01-19 16:43:22'),
(827, 21, 1441, 'Appointment Created', 'Dear not the test, Your appointment is successfully created on 2024-01-25 at 01:50 PM in Epilworld. Your booking id is #73174_829. Thank you.', '2024-01-19 16:45:08', '2024-01-19 16:45:08'),
(828, 21, 1444, 'Appointment Created', 'Dear not the test, Your appointment is successfully created on 2024-01-25 at 01:50 PM in Epilworld. Your booking id is #73174_789. Thank you.', '2024-01-19 16:46:37', '2024-01-19 16:46:37'),
(829, 22, 23, 'Booking status', 'Dear ccccc, Your appointment on 2024-02-10 at 08:30 AM in Epilworld is now in session. Your booking id is #19882_563. Thank you.', '2024-02-10 13:53:55', '2024-02-10 13:53:55'),
(830, 20, 26, 'Booking status', 'Dear test, Your appointment on 2024-02-10 at 08:00 AM in Epilworld is now Completed. Your booking id is #59300_354. Thank you.', '2024-02-10 16:42:33', '2024-02-10 16:42:33'),
(831, 20, 26, 'Booking status', 'Dear test, Your appointment on 2024-02-10 at 08:00 AM in Epilworld is now in session. Your booking id is #59300_354. Thank you.', '2024-02-10 16:48:59', '2024-02-10 16:48:59'),
(832, 21, 29, 'Booking status', 'Dear not the test, Your appointment on 2024-02-10 at 08:00 AM in Epilworld is now Completed. Your booking id is #69938_595. Thank you.', '2024-02-10 17:06:17', '2024-02-10 17:06:17'),
(833, 21, 47, 'Booking status', 'Dear not the test, Your appointment on 2024-02-14 at 09:30 AM in Epilworld is now Completed. Your booking id is #20005_442. Thank you.', '2024-02-14 15:42:07', '2024-02-14 15:42:07'),
(834, 21, 47, 'Booking status', 'Dear not the test, Your appointment on 2024-02-14 at 09:30 AM in Epilworld is now Completed. Your booking id is #20005_442. Thank you.', '2024-02-14 15:42:15', '2024-02-14 15:42:15'),
(835, 21, 54, 'Booking status', 'Dear not the test, Your appointment on 2024-03-04 at 02:00 PM in Epilworld is now Completed. Your booking id is #29576_151. Thank you.', '2024-03-01 19:14:38', '2024-03-01 19:14:38'),
(836, 21, 53, 'Booking status', 'Dear not the test, Your appointment on 2024-03-01 at 02:00 PM in Epilworld is now Completed. Your booking id is #29576_151. Thank you.', '2024-03-01 19:14:51', '2024-03-01 19:14:51'),
(837, 21, 52, 'Booking status', 'Dear not the test, Your appointment on 2024-03-01 at 09:00 AM in Epilworld is now Completed. Your booking id is #62731_177. Thank you.', '2024-03-01 19:16:43', '2024-03-01 19:16:43');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_clients`
--

INSERT INTO `oauth_clients` (`id`, `user_id`, `name`, `secret`, `provider`, `redirect`, `personal_access_client`, `password_client`, `revoked`, `created_at`, `updated_at`) VALUES
(1, NULL, 'admin', 'IZfEmfK4CgYBTqR9HOxuBNwM0mKjWSwyB60nztDp', NULL, 'http://localhost', 1, 0, 0, '2020-10-02 13:16:30', '2020-10-02 13:16:30');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_personal_access_clients`
--

INSERT INTO `oauth_personal_access_clients` (`id`, `client_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2020-10-02 13:16:30', '2020-10-02 13:16:30');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `offer`
--

CREATE TABLE `offer` (
  `id` int(10) NOT NULL,
  `image` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `discount` int(10) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `parametage_services`
--

CREATE TABLE `parametage_services` (
  `id` int(11) NOT NULL,
  `salon_id` int(11) NOT NULL,
  `service_name` varchar(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `energie` varchar(255) DEFAULT NULL,
  `frequence` varchar(255) DEFAULT NULL,
  `refoidissement` varchar(11) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `is_deleted` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `parametage_services`
--

INSERT INTO `parametage_services` (`id`, `salon_id`, `service_name`, `name`, `energie`, `frequence`, `refoidissement`, `gender`, `status`, `is_deleted`, `created_at`, `updated_at`) VALUES
(7, 1, 'Laiser', 'Visage', '8-9', '3-4', '4', '1', 1, 0, '2024-03-03 17:42:08', '2024-03-03 17:42:08'),
(8, 1, 'Laiser', 'Aisselles', '9-10', '5', '4', '1', 1, 0, '2024-03-03 17:42:42', '2024-03-03 17:42:42'),
(9, 1, 'Laiser', 'Bras Complet', '12', '5-6', '4', '1', 1, 0, '2024-03-03 17:43:55', '2024-03-03 17:43:55'),
(10, 1, 'Laiser', 'Cuisse', '10-11', '5-6', '4', '1', 1, 0, '2024-03-03 17:45:10', '2024-03-03 17:45:10'),
(11, 1, 'Laiser', 'Demi-Jambe', '10', '5-6', '4', '1', 1, 0, '2024-03-03 17:45:41', '2024-03-03 17:45:41'),
(12, 1, 'Laiser', 'Maillat', '8-9', '5', '4', '1', 1, 0, '2024-03-03 17:46:09', '2024-03-03 17:46:09'),
(13, 1, 'Laiser', 'Dos', '10-12', '5', '4', '1', 1, 0, '2024-03-03 17:46:22', '2024-03-03 17:46:22'),
(14, 1, 'Laiser', 'Venter', '10-12', '5', '4', '1', 1, 0, '2024-03-03 17:46:37', '2024-03-03 17:46:37'),
(15, 1, 'Laiser', 'Visage', '8-9', '3-4', '4', '0', 1, 0, '2024-03-03 16:42:08', '2024-03-03 16:42:08'),
(16, 1, 'Laiser', 'Aisselles', '9-10', '5', '4', '0', 1, 0, '2024-03-03 16:42:42', '2024-03-03 16:42:42'),
(17, 1, 'Laiser', 'Bras Complet', '12', '5-6', '4', '0', 1, 0, '2024-03-03 16:43:55', '2024-03-03 16:43:55'),
(18, 1, 'Laiser', 'Cuisse', '10-12', '5-6', '4', '0', 1, 0, '2024-03-03 16:45:10', '2024-03-03 16:45:10'),
(19, 1, 'Laiser', 'Demi-Jambe', '10', '5-6', '4', '0', 1, 0, '2024-03-03 16:45:41', '2024-03-03 16:45:41'),
(20, 1, 'Laiser', 'Maillat', '8-9', '5', '4', '0', 1, 0, '2024-03-03 16:46:09', '2024-03-03 16:46:09'),
(21, 1, 'Laiser', 'Dos', '12', '5', '4', '0', 1, 0, '2024-03-03 16:46:22', '2024-03-03 16:46:22'),
(22, 1, 'Laiser', 'Venter', '12', '5', '4', '0', 1, 0, '2024-03-03 16:46:37', '2024-03-03 16:46:37'),
(23, 1, 'Epilation', 'Visage', '5-6', '-2', '2', '0', 1, 0, '2024-03-03 16:42:08', '2024-03-03 16:42:08'),
(24, 1, 'Epilation', 'Aisselles', '6-8', '-2', '2', '0', 1, 0, '2024-03-03 16:42:42', '2024-03-03 16:42:42'),
(25, 1, 'Epilation', 'Bras Complet', '9', '-2', '2', '0', 1, 0, '2024-03-03 16:43:55', '2024-03-03 16:43:55'),
(26, 1, 'Epilation', 'Cuisse', '9', '-2', '2', '0', 1, 0, '2024-03-03 16:45:10', '2024-03-03 16:45:10'),
(27, 1, 'Epilation', 'Demi-Jambe', '6-7', '-2', '2', '0', 1, 0, '2024-03-03 16:45:41', '2024-03-03 16:45:41'),
(28, 1, 'Epilation', 'Maillat', '5-7', '-2', '2', '0', 1, 0, '2024-03-03 16:46:09', '2024-03-03 16:46:09'),
(29, 1, 'Epilation', 'Dos', '8', '-2', '2', '0', 1, 0, '2024-03-03 16:46:22', '2024-03-03 16:46:22'),
(30, 1, 'Epilation', 'Venter', '7-8', '-2', '2', '0', 1, 0, '2024-03-03 16:46:37', '2024-03-03 16:46:37'),
(31, 1, 'Epilation', 'Visage', '5-6', '-2', '2', '1', 1, 0, '2024-03-03 16:42:08', '2024-03-03 16:42:08'),
(32, 1, 'Epilation', 'Aisselles', '6-8', '-2', '2', '1', 1, 0, '2024-03-03 16:42:42', '2024-03-03 16:42:42'),
(33, 1, 'Epilation', 'Bras Complet', '6-8', '-2', '2', '1', 1, 0, '2024-03-03 16:43:55', '2024-03-03 16:43:55'),
(34, 1, 'Epilation', 'Cuisse', '6-8', '-2', '2', '1', 1, 0, '2024-03-03 16:45:10', '2024-03-03 16:45:10'),
(35, 1, 'Epilation', 'Demi-Jambe', '6-7', '-2', '2', '1', 1, 0, '2024-03-03 16:45:41', '2024-03-03 16:45:41'),
(36, 1, 'Epilation', 'Maillat', '5-7', '-2', '2', '1', 1, 0, '2024-03-03 16:46:09', '2024-03-03 16:46:09'),
(37, 1, 'Epilation', 'Dos', '7-8', '-2', '2', '1', 1, 0, '2024-03-03 16:46:22', '2024-03-03 16:46:22'),
(38, 1, 'Epilation', 'Venter', '7-8', '-2', '2', '1', 1, 0, '2024-03-03 16:46:37', '2024-03-03 16:46:37');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `id` int(11) NOT NULL,
  `booking_id` int(11) NOT NULL,
  `payment_done` varchar(255) DEFAULT NULL,
  `amount` float NOT NULL,
  `collection_date` date DEFAULT NULL,
  `payment_date` date NOT NULL,
  `payment_type` varchar(255) DEFAULT NULL,
  `payment_reference` varchar(255) DEFAULT NULL,
  `whycancel` text,
  `who_cancel` varchar(255) DEFAULT NULL,
  `cancel_date` varchar(255) DEFAULT NULL,
  `created_by` varchar(255) NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`id`, `booking_id`, `payment_done`, `amount`, `collection_date`, `payment_date`, `payment_type`, `payment_reference`, `whycancel`, `who_cancel`, `cancel_date`, `created_by`, `status`, `created_at`, `updated_at`) VALUES
(2, 54, NULL, 1000, NULL, '2024-03-01', 'cash', NULL, NULL, NULL, NULL, 'Support TAYSSIR', '0', '2024-03-01 19:15:09', '2024-03-01 19:15:09'),
(3, 52, NULL, 500, NULL, '2024-03-01', 'cash', NULL, NULL, NULL, NULL, 'Support TAYSSIR', '0', '2024-03-01 19:16:57', '2024-03-01 19:16:57');

-- --------------------------------------------------------

--
-- Table structure for table `paymentsetting`
--

CREATE TABLE `paymentsetting` (
  `id` int(11) NOT NULL,
  `cod` tinyint(1) NOT NULL,
  `stripe` tinyint(1) NOT NULL,
  `stripe_public_key` varchar(255) DEFAULT NULL,
  `stripe_secret_key` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `paymentsetting`
--

INSERT INTO `paymentsetting` (`id`, `cod`, `stripe`, `stripe_public_key`, `stripe_secret_key`, `created_at`, `updated_at`) VALUES
(1, 1, 0, NULL, NULL, '2020-08-14 08:48:44', '2021-03-05 05:21:17');

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `review_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `salon_id` int(10) NOT NULL,
  `booking_id` int(10) NOT NULL,
  `rate` int(5) NOT NULL,
  `message` longtext NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `salon_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `note` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `salon_id`, `name`, `note`, `created_at`, `updated_at`) VALUES
(1, 1, 'support', 'support', '2023-12-17 15:50:25', '2023-12-17'),
(2, 1, 'admin', 'admin', '2023-12-28 01:25:01', '2023-12-17');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `room_id` int(10) NOT NULL,
  `salon_id` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `service_id` text NOT NULL,
  `sun` varchar(150) DEFAULT NULL,
  `mon` varchar(150) DEFAULT NULL,
  `tue` varchar(150) DEFAULT NULL,
  `wed` varchar(150) DEFAULT NULL,
  `thu` varchar(150) DEFAULT NULL,
  `fri` varchar(150) DEFAULT NULL,
  `sat` varchar(150) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `isdelete` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`room_id`, `salon_id`, `name`, `service_id`, `sun`, `mon`, `tue`, `wed`, `thu`, `fri`, `sat`, `status`, `isdelete`, `created_at`, `updated_at`) VALUES
(4, 1, 'Salle1', '[\"1\",\"2\",\"3\",\"15\",\"16\",\"17\",\"18\",\"19\",\"20\",\"21\",\"23\",\"24\",\"25\",\"26\",\"27\",\"28\",\"29\",\"30\",\"31\",\"32\",\"33\",\"34\",\"35\",\"36\",\"37\",\"38\",\"39\",\"40\",\"41\",\"42\",\"43\",\"44\",\"45\",\"46\",\"47\",\"48\",\"49\",\"50\",\"51\",\"52\",\"53\",\"54\",\"55\",\"56\",\"57\",\"58\",\"59\",\"60\",\"61\",\"62\",\"63\",\"64\",\"69\",\"6\",\"7\",\"8\",\"9\",\"10\",\"11\",\"12\",\"13\",\"14\"]', '{\"open\":\"00:00\",\"close\":\"00:00\"}', '{\"open\":\"08:00\",\"close\":\"20:00\"}', '{\"open\":\"08:00\",\"close\":\"20:00\"}', '{\"open\":\"08:00\",\"close\":\"20:00\"}', '{\"open\":\"08:00\",\"close\":\"20:00\"}', '{\"open\":\"08:00\",\"close\":\"20:00\"}', '{\"open\":\"08:00\",\"close\":\"20:00\"}', 1, 0, '2023-12-12 03:37:11', '2024-02-07 18:12:23'),
(5, 1, 'Salle2', '[\"1\",\"2\",\"3\",\"15\",\"16\",\"17\",\"18\",\"19\",\"20\",\"21\",\"23\",\"24\",\"25\",\"26\",\"27\",\"28\",\"29\",\"30\",\"31\",\"32\",\"33\",\"34\",\"35\",\"36\",\"37\",\"38\",\"39\",\"40\",\"41\",\"42\",\"43\",\"44\",\"45\",\"46\",\"47\",\"48\",\"49\",\"50\",\"51\",\"52\",\"53\",\"54\",\"55\",\"56\",\"57\",\"58\",\"59\",\"60\",\"61\",\"62\",\"63\",\"64\",\"69\",\"6\",\"7\",\"8\",\"9\",\"10\",\"11\",\"12\",\"13\",\"14\"]', '{\"open\":\"00:00\",\"close\":\"00:00\"}', '{\"open\":\"08:00\",\"close\":\"20:00\"}', '{\"open\":\"08:00\",\"close\":\"20:00\"}', '{\"open\":\"08:00\",\"close\":\"20:00\"}', '{\"open\":\"08:00\",\"close\":\"20:00\"}', '{\"open\":\"08:00\",\"close\":\"20:00\"}', '{\"open\":\"08:00\",\"close\":\"20:00\"}', 1, 0, '2023-12-12 03:38:22', '2024-02-07 18:12:11'),
(6, 1, 'Salle3', '[\"1\",\"2\",\"3\",\"15\",\"16\",\"17\",\"18\",\"19\",\"20\",\"21\",\"23\",\"24\",\"25\",\"26\",\"27\",\"28\",\"29\",\"30\",\"31\",\"32\",\"33\",\"34\",\"35\",\"36\",\"37\",\"38\",\"39\",\"40\",\"41\",\"42\",\"43\",\"44\",\"45\",\"46\",\"47\",\"48\",\"49\",\"50\",\"51\",\"52\",\"53\",\"54\",\"55\",\"56\",\"57\",\"58\",\"59\",\"60\",\"61\",\"62\",\"63\",\"64\",\"69\",\"6\",\"7\",\"8\",\"9\",\"10\",\"11\",\"12\",\"13\",\"14\"]', '{\"open\":\"00:00\",\"close\":\"00:00\"}', '{\"open\":\"08:00\",\"close\":\"20:00\"}', '{\"open\":\"08:00\",\"close\":\"20:00\"}', '{\"open\":\"08:00\",\"close\":\"20:00\"}', '{\"open\":\"08:00\",\"close\":\"20:00\"}', '{\"open\":\"08:00\",\"close\":\"20:00\"}', '{\"open\":\"08:00\",\"close\":\"20:00\"}', 1, 0, '2023-12-12 03:40:37', '2024-02-07 18:12:00'),
(7, 1, 'Salle4', '[\"1\",\"2\",\"3\",\"15\",\"16\",\"17\",\"18\",\"19\",\"20\",\"21\",\"23\",\"24\",\"25\",\"26\",\"27\",\"28\",\"29\",\"30\",\"31\",\"32\",\"33\",\"34\",\"35\",\"36\",\"37\",\"38\",\"39\",\"40\",\"41\",\"42\",\"43\",\"44\",\"45\",\"46\",\"47\",\"48\",\"49\",\"50\",\"51\",\"52\",\"53\",\"54\",\"55\",\"56\",\"57\",\"58\",\"59\",\"60\",\"61\",\"62\",\"63\",\"64\",\"69\",\"6\",\"7\",\"8\",\"9\",\"10\",\"11\",\"12\",\"13\",\"14\"]', '{\"open\":\"00:00\",\"close\":\"00:00\"}', '{\"open\":\"08:00\",\"close\":\"20:00\"}', '{\"open\":\"08:00\",\"close\":\"20:00\"}', '{\"open\":\"08:00\",\"close\":\"20:00\"}', '{\"open\":\"08:00\",\"close\":\"20:00\"}', '{\"open\":\"08:00\",\"close\":\"20:00\"}', '{\"open\":\"08:00\",\"close\":\"20:00\"}', 1, 0, '2023-12-19 14:59:03', '2024-02-12 00:41:54');

-- --------------------------------------------------------

--
-- Table structure for table `salon`
--

CREATE TABLE `salon` (
  `salon_id` int(10) NOT NULL,
  `owner_id` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `desc` longtext NOT NULL,
  `gender` varchar(10) NOT NULL,
  `address` text NOT NULL,
  `zipcode` mediumint(9) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `website` varchar(255) DEFAULT NULL,
  `phone` bigint(20) NOT NULL,
  `sun` varchar(150) DEFAULT NULL,
  `mon` varchar(150) DEFAULT NULL,
  `tue` varchar(150) DEFAULT NULL,
  `wed` varchar(150) DEFAULT NULL,
  `thu` varchar(150) DEFAULT NULL,
  `fri` varchar(150) DEFAULT NULL,
  `sat` varchar(150) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `latitude` varchar(255) NOT NULL,
  `longitude` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `salon`
--

INSERT INTO `salon` (`salon_id`, `owner_id`, `name`, `image`, `logo`, `desc`, `gender`, `address`, `zipcode`, `city`, `state`, `country`, `website`, `phone`, `sun`, `mon`, `tue`, `wed`, `thu`, `fri`, `sat`, `status`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES
(1, 1, 'Epilworld', 'salon_6571f3e671728.png', 'white_logo.png', 'Centre esthétique médical', 'Both', '1 rue oued oum errabia résidence argana 4eme étage appartement 17', 12000, 'Temara', 'Rabat', 'Maroc', 'https://epilworld.ma/', 667673871, '{\"open\":\"00:00\",\"close\":\"00:00\"}', '{\"open\":\"08:00\",\"close\":\"20:00\"}', '{\"open\":\"08:00\",\"close\":\"20:00\"}', '{\"open\":\"08:00\",\"close\":\"20:00\"}', '{\"open\":\"08:00\",\"close\":\"20:00\"}', '{\"open\":\"08:00\",\"close\":\"20:00\"}', '{\"open\":\"08:00\",\"close\":\"20:00\"}', 1, '33.5731', '7.5898', '2023-12-07 19:03:42', '2023-12-09 00:54:34'),
(1, 4, 'Epilworld', 'salon_6571f3e671728.png', 'white_logo.png', 'Centre esthétique médical', 'Both', '1 rue oued oum errabia résidence argana 4eme étage appartement 17', 120000, 'Temara', 'Rabat', 'Maroc', 'https://epilworld.ma/\n', 667673871, '{\"open\":\"00:00\",\"close\":\"00:00\"}', '{\"open\":\"08:00\",\"close\":\"20:00\"}', '{\"open\":\"08:00\",\"close\":\"20:00\"}', '{\"open\":\"08:00\",\"close\":\"20:00\"}', '{\"open\":\"08:00\",\"close\":\"20:00\"}', '{\"open\":\"08:00\",\"close\":\"20:00\"}', '{\"open\":\"08:00\",\"close\":\"20:00\"}', 1, '33.5731', '7.5898', '2023-12-16 22:37:00', '2023-12-16 22:37:00'),
(1, 5, 'Epilworld', 'salon_6571f3e671728.png', 'white_logo.png', 'Centre esthétique médical', 'Both', '1 rue oued oum errabia résidence argana 4eme étage appartement 17', 12000, 'Temara', 'Rabat', 'Maroc', 'https://epilworld.ma/', 667673871, '{\"open\":\"00:00\",\"close\":\"00:00\"}', '{\"open\":\"08:00\",\"close\":\"20:00\"}', '{\"open\":\"08:00\",\"close\":\"20:00\"}', '{\"open\":\"08:00\",\"close\":\"20:00\"}', '{\"open\":\"08:00\",\"close\":\"20:00\"}', '{\"open\":\"08:00\",\"close\":\"20:00\"}', '{\"open\":\"08:00\",\"close\":\"20:00\"}', 1, '33.5731', '7.5898', '2023-12-07 19:03:42', '2023-12-07 19:03:42'),
(1, 6, 'Epilworld', 'salon_6571f3e671728.png', 'white_logo.png', 'Centre esthétique médical', 'Both', '1 rue oued oum errabia résidence argana 4eme étage appartement 17', 120000, 'Temara', 'Rabat', 'Maroc', 'https://epilworld.ma/', 667673871, '{\"open\":\"00:00\",\"close\":\"00:00\"}', '{\"open\":\"08:00\",\"close\":\"20:00\"}', '{\"open\":\"08:00\",\"close\":\"20:00\"}', '{\"open\":\"08:00\",\"close\":\"20:00\"}', '{\"open\":\"08:00\",\"close\":\"20:00\"}', '{\"open\":\"08:00\",\"close\":\"20:00\"}', '{\"open\":\"08:00\",\"close\":\"20:00\"}', 1, '33.5731', '7.5898', '2023-12-07 19:03:42', '2023-12-07 19:03:42');

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

CREATE TABLE `service` (
  `service_id` int(10) NOT NULL,
  `service_details_id` int(10) DEFAULT NULL,
  `cat_id` int(10) NOT NULL,
  `is_mini_service` tinyint(1) DEFAULT NULL,
  `salon_id` int(10) NOT NULL,
  `image` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `time` int(10) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `price` float NOT NULL,
  `NBS` varchar(255) DEFAULT NULL,
  `frequency` varchar(255) DEFAULT NULL,
  `frequency_nb` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `isdelete` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `service`
--

INSERT INTO `service` (`service_id`, `service_details_id`, `cat_id`, `is_mini_service`, `salon_id`, `image`, `name`, `time`, `gender`, `price`, `NBS`, `frequency`, `frequency_nb`, `status`, `isdelete`, `created_at`, `updated_at`) VALUES
(1, NULL, 1, NULL, 1, 'Service_65730ffdd5609.jpg', 'Exilis visage', 120, 'Both', 200, '2', 'Day', '2', 1, 0, '2023-12-07 21:06:26', '2023-12-08 17:15:49'),
(2, NULL, 1, NULL, 1, 'Service_65730f9682937.jpeg', 'Hydrafacial', 200, 'Both', 1000, '2', 'Day', '2', 1, 0, '2023-12-07 21:11:38', '2023-12-08 17:14:06'),
(3, NULL, 1, NULL, 1, 'Service_6573114f61171.jpg', 'Radiofréquence Powershape', 120, 'Both', 1000, '1', 'Day', '2', 1, 0, '2023-12-08 17:21:27', '2023-12-08 17:21:27'),
(6, NULL, 3, NULL, 1, 'Service_657317049c5b8.jpg', 'Exilis corps', 120, 'Both', 1000, '1', 'Day', '2', 1, 0, '2023-12-08 17:45:48', '2023-12-08 17:45:48'),
(7, NULL, 3, NULL, 1, 'Service_65731760d7efb.jpeg', 'Cryolipolyse', 120, 'Both', 1000, '1', 'Day', '2', 1, 0, '2023-12-08 17:47:20', '2023-12-08 17:47:20'),
(8, NULL, 3, NULL, 1, 'Service_6573184b2d3a6.jpg', 'Powershape', 120, 'Both', 1000, '1', 'Day', '2', 1, 0, '2023-12-08 17:51:15', '2023-12-08 17:51:15'),
(9, NULL, 3, NULL, 1, 'Service_657318e67e60c.jpg', 'Ondes de choc', 120, 'Both', 1000, '1', 'Day', '2', 1, 0, '2023-12-08 17:53:50', '2023-12-08 17:53:50'),
(10, NULL, 3, NULL, 1, 'Service_65731961941df.jpg', 'Pressothérapie', 120, 'Both', 1000, '1', 'Day', '2', 1, 0, '2023-12-08 17:55:53', '2023-12-08 17:55:53'),
(11, NULL, 3, NULL, 1, 'Service_657319dca3bb1.jpeg', 'Lifting colombien', 120, 'Both', 1000, '1', 'Day', '2', 1, 0, '2023-12-08 17:57:56', '2023-12-08 17:57:56'),
(12, NULL, 4, NULL, 1, 'Service_65731a44881aa.jpeg', 'Diag visage', 120, 'Both', 1000, '1', 'Day', '2', 1, 0, '2023-12-08 17:59:40', '2023-12-08 17:59:40'),
(13, NULL, 4, NULL, 1, 'Service_65731b3abc293.jpeg', 'Diag epilation définitive', 120, 'Both', 1000, '2', 'Day', '2', 1, 0, '2023-12-08 18:03:46', '2023-12-10 05:06:53'),
(14, NULL, 4, NULL, 1, 'Service_65731d0fd72a8.jpeg', 'Diag minceur', 60, 'Both', 1000, '3', 'Day', '2', 1, 0, '2023-12-08 18:11:35', '2023-12-11 04:47:42'),
(15, NULL, 2, NULL, 1, 'noimage.jpg', 'Lumière pulsée', 0, 'Both', 0, '1', 'Day', '1', 1, 0, '2024-02-07 00:17:59', '2024-02-07 00:22:12'),
(16, NULL, 2, NULL, 1, 'noimage.jpg', 'Laiser', 0, 'Both', 0, '1', 'Day', '1', 1, 0, '2024-02-08 19:12:32', '2024-02-08 19:12:32'),
(17, 1, 2, 1, 1, 'noimage.jpg', 'Visage', 30, 'Both', 300, '1', 'Day', '1', 1, 0, '2021-06-30 23:00:00', '2021-06-30 23:00:00'),
(18, 2, 2, 1, 1, 'noimage.jpg', 'Cou', 30, 'Both', 300, '1', 'Day', '1', 1, 0, '2021-06-30 23:00:00', '2021-06-30 23:00:00'),
(19, 3, 2, 1, 1, 'noimage.jpg', 'Aisselles', 30, 'Both', 300, '1', 'Day', '1', 1, 0, '2021-06-30 23:00:00', '2021-06-30 23:00:00'),
(20, 4, 2, 1, 1, 'noimage.jpg', 'Jambes complétes', 30, 'Both', 1200, '1', 'Day', '1', 1, 0, '2021-06-30 23:00:00', '2024-02-11 22:07:15'),
(21, 5, 2, 1, 1, 'noimage.jpg', 'Bras complet', 30, 'Both', 1200, '1', 'Day', '1', 1, 0, '2021-06-30 23:00:00', '2021-06-30 23:00:00'),
(22, 6, 2, 1, 1, 'noimage.jpg', 'Maillot int�gral', 30, 'Both', 600, '1', 'Day', '1', 1, 1, '2021-06-30 23:00:00', '2024-02-11 22:09:22'),
(23, 7, 2, 1, 1, 'noimage.jpg', 'Maillot simple', 30, 'Both', 300, '1', 'Day', '1', 1, 0, '2021-06-30 23:00:00', '2021-06-30 23:00:00'),
(24, 8, 2, 1, 1, 'noimage.jpg', 'Bord', 30, 'Both', 300, '1', 'Day', '1', 1, 0, '2021-06-30 23:00:00', '2021-06-30 23:00:00'),
(25, 9, 2, 1, 1, 'noimage.jpg', 'Cuisses', 30, 'Both', 600, '1', 'Day', '1', 1, 0, '2021-06-30 23:00:00', '2021-06-30 23:00:00'),
(26, 10, 2, 1, 1, 'noimage.jpg', 'Demi jambes', 30, 'Both', 600, '1', 'Day', '1', 1, 0, '2021-06-30 23:00:00', '2021-06-30 23:00:00'),
(27, 11, 2, 1, 1, 'noimage.jpg', 'Dos', 30, 'Both', 900, '1', 'Day', '1', 1, 0, '2021-06-30 23:00:00', '2021-06-30 23:00:00'),
(28, 12, 2, 1, 1, 'noimage.jpg', 'Fesses', 30, 'Both', 600, '1', 'Day', '1', 1, 0, '2021-06-30 23:00:00', '2021-06-30 23:00:00'),
(29, 13, 2, 1, 1, 'noimage.jpg', 'Ventre', 30, 'Both', 600, '1', 'Day', '1', 1, 0, '2021-06-30 23:00:00', '2021-06-30 23:00:00'),
(30, 14, 2, 1, 1, 'noimage.jpg', 'Ligne Alba', 30, 'Both', 300, '1', 'Day', '1', 1, 0, '2021-06-30 23:00:00', '2021-06-30 23:00:00'),
(31, 15, 2, 1, 1, 'noimage.jpg', 'Avant bras', 30, 'Both', 600, '1', 'Day', '1', 1, 0, '2021-06-30 23:00:00', '2021-06-30 23:00:00'),
(32, 16, 2, 1, 1, 'noimage.jpg', 'Demi bras', 30, 'Both', 600, '1', 'Day', '1', 1, 0, '2021-06-30 23:00:00', '2021-06-30 23:00:00'),
(33, 17, 2, 1, 1, 'noimage.jpg', 'Dos homme', 30, 'Both', 1200, '1', 'Day', '1', 1, 0, '2021-06-30 23:00:00', '2021-06-30 23:00:00'),
(34, 18, 2, 1, 1, 'noimage.jpg', 'Bas du dos homme', 30, 'Both', 600, '1', 'Day', '1', 1, 0, '2021-06-30 23:00:00', '2021-06-30 23:00:00'),
(35, 19, 2, 1, 1, 'noimage.jpg', 'Bas du dos femme', 30, 'Both', 300, '1', 'Day', '1', 1, 0, '2021-06-30 23:00:00', '2021-06-30 23:00:00'),
(36, 20, 2, 1, 1, 'noimage.jpg', 'Épaules', 30, 'Both', 600, '1', 'Day', '1', 1, 0, '2021-06-30 23:00:00', '2024-02-11 22:09:42'),
(37, 21, 2, 1, 1, 'noimage.jpg', 'Nuque', 30, 'Both', 300, '1', 'Day', '1', 1, 0, '2021-06-30 23:00:00', '2021-06-30 23:00:00'),
(38, 22, 2, 1, 1, 'noimage.jpg', 'Sein', 30, 'Both', 300, '1', 'Day', '1', 1, 0, '2021-06-30 23:00:00', '2021-06-30 23:00:00'),
(39, 23, 2, 1, 1, 'noimage.jpg', 'Poitrine', 30, 'Both', 300, '1', 'Day', '1', 1, 0, '2021-06-30 23:00:00', '2021-06-30 23:00:00'),
(40, 24, 2, 1, 1, 'noimage.jpg', 'Barbe', 30, 'Both', 300, '1', 'Day', '1', 1, 0, '2021-06-30 23:00:00', '2021-06-30 23:00:00'),
(41, 25, 2, 1, 1, 'noimage.jpg', 'Visage', 30, 'Both', 200, '1', 'Day', '1', 1, 0, '2021-06-30 23:00:00', '2021-06-30 23:00:00'),
(42, 26, 2, 1, 1, 'noimage.jpg', 'Cou', 30, 'Both', 200, '1', 'Day', '1', 1, 0, '2021-06-30 23:00:00', '2021-06-30 23:00:00'),
(43, 27, 2, 1, 1, 'noimage.jpg', 'Aisselles', 30, 'Both', 200, '1', 'Day', '1', 1, 0, '2021-06-30 23:00:00', '2021-06-30 23:00:00'),
(44, 28, 2, 1, 1, 'noimage.jpg', 'Jambes complétes', 30, 'Both', 800, '1', 'Day', '1', 1, 0, '2021-06-30 23:00:00', '2021-06-30 23:00:00'),
(45, 29, 2, 1, 1, 'noimage.jpg', 'Bras complet', 30, 'Both', 800, '1', 'Day', '1', 1, 0, '2021-06-30 23:00:00', '2021-06-30 23:00:00'),
(46, 30, 2, 1, 1, 'noimage.jpg', 'Maillot intégral', 30, 'Both', 400, '1', 'Day', '1', 1, 0, '2021-06-30 23:00:00', '2024-02-11 22:08:52'),
(47, 31, 2, 1, 1, 'noimage.jpg', 'Maillot simple', 30, 'Both', 200, '1', 'Day', '1', 1, 0, '2021-06-30 23:00:00', '2021-06-30 23:00:00'),
(48, 32, 2, 1, 1, 'noimage.jpg', 'Bord', 30, 'Both', 200, '1', 'Day', '1', 1, 0, '2021-06-30 23:00:00', '2021-06-30 23:00:00'),
(49, 33, 2, 1, 1, 'noimage.jpg', 'Cuisses', 30, 'Both', 400, '1', 'Day', '1', 1, 0, '2021-06-30 23:00:00', '2021-06-30 23:00:00'),
(50, 34, 2, 1, 1, 'noimage.jpg', 'Demi jambes', 30, 'Both', 400, '1', 'Day', '1', 1, 0, '2021-06-30 23:00:00', '2021-06-30 23:00:00'),
(51, 35, 2, 1, 1, 'noimage.jpg', 'Dos femme', 30, 'Both', 600, '1', 'Day', '1', 1, 0, '2021-06-30 23:00:00', '2021-06-30 23:00:00'),
(52, 36, 2, 1, 1, 'noimage.jpg', 'Fesses', 30, 'Both', 400, '1', 'Day', '1', 1, 0, '2021-06-30 23:00:00', '2021-06-30 23:00:00'),
(53, 37, 2, 1, 1, 'noimage.jpg', 'Ventre', 30, 'Both', 400, '1', 'Day', '1', 1, 0, '2021-06-30 23:00:00', '2021-06-30 23:00:00'),
(54, 38, 2, 1, 1, 'noimage.jpg', 'Ligne alba', 30, 'Both', 200, '1', 'Day', '1', 1, 0, '2021-06-30 23:00:00', '2021-06-30 23:00:00'),
(55, 39, 2, 1, 1, 'noimage.jpg', 'Avant bras', 30, 'Both', 400, '1', 'Day', '1', 1, 0, '2021-06-30 23:00:00', '2021-06-30 23:00:00'),
(56, 40, 2, 1, 1, 'noimage.jpg', 'Demi bras', 30, 'Both', 400, '1', 'Day', '1', 1, 0, '2021-06-30 23:00:00', '2021-06-30 23:00:00'),
(57, 41, 2, 1, 1, 'noimage.jpg', 'Dos homme', 30, 'Both', 800, '1', 'Day', '1', 1, 0, '2021-06-30 23:00:00', '2021-06-30 23:00:00'),
(58, 42, 2, 1, 1, 'noimage.jpg', 'Bas du dos homme', 30, 'Both', 400, '1', 'Day', '1', 1, 0, '2021-06-30 23:00:00', '2021-06-30 23:00:00'),
(59, 43, 2, 1, 1, 'noimage.jpg', 'Bas du dos femme', 30, 'Both', 200, '1', 'Day', '1', 1, 0, '2021-06-30 23:00:00', '2021-06-30 23:00:00'),
(60, 44, 2, 1, 1, 'noimage.jpg', 'Épaules', 30, 'Both', 400, '1', 'Day', '1', 1, 0, '2021-06-30 23:00:00', '2024-02-11 22:09:15'),
(61, 45, 2, 1, 1, 'noimage.jpg', 'Nuque', 30, 'Both', 200, '1', 'Day', '1', 1, 0, '2021-06-30 23:00:00', '2021-06-30 23:00:00'),
(62, 46, 2, 1, 1, 'noimage.jpg', 'Sein', 30, 'Both', 200, '1', 'Day', '1', 1, 0, '2021-06-30 23:00:00', '2021-06-30 23:00:00'),
(63, 47, 2, 1, 1, 'noimage.jpg', 'Poitrine', 30, 'Both', 200, '1', 'Day', '1', 1, 0, '2021-06-30 23:00:00', '2021-06-30 23:00:00'),
(64, 48, 2, 1, 1, 'noimage.jpg', 'Barbe', 30, 'Both', 200, '1', 'Day', '1', 1, 0, '2021-06-30 23:00:00', '2021-06-30 23:00:00'),
(69, 51, 2, 1, 1, 'noimage.jpg', 'Maillot intégral', 30, 'Both', 400, '1', 'Day', '1', 1, 0, '2024-02-11 22:10:36', '2024-02-11 22:10:36');

-- --------------------------------------------------------

--
-- Table structure for table `service_details`
--

CREATE TABLE `service_details` (
  `id` int(10) NOT NULL,
  `service_id` int(10) NOT NULL,
  `salon_id` int(10) NOT NULL,
  `image` varchar(255) NOT NULL,
  `cat_id` int(10) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `time` int(10) NOT NULL,
  `price` varchar(10) NOT NULL,
  `NBS` varchar(255) DEFAULT NULL,
  `frequency` varchar(255) DEFAULT NULL,
  `frequency_nb` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `isdelete` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `service_details`
--

INSERT INTO `service_details` (`id`, `service_id`, `salon_id`, `image`, `cat_id`, `name`, `gender`, `time`, `price`, `NBS`, `frequency`, `frequency_nb`, `status`, `isdelete`, `created_at`, `updated_at`) VALUES
(1, 16, 1, 'noimage.jpg', NULL, 'Visage', 'Both', 30, '300', '1', 'Day', '1', 1, 0, '2021-07-01 00:00:00', '2024-02-11 22:08:32'),
(2, 16, 1, 'noimage.jpg', NULL, 'Cou', 'Both', 30, '300', '1', 'Day', '1', 1, 0, '2021-07-01 00:00:00', '2024-02-11 22:08:32'),
(3, 16, 1, 'noimage.jpg', NULL, 'Aisselles', 'Both', 30, '300', '1', 'Day', '1', 1, 0, '2021-07-01 00:00:00', '2024-02-11 22:08:32'),
(4, 16, 1, 'noimage.jpg', NULL, 'Jambes complétes', 'Both', 30, '1200', '1', 'Day', '1', 1, 0, '2021-07-01 00:00:00', '2024-02-11 22:07:15'),
(5, 16, 1, 'noimage.jpg', NULL, 'Bras complet', 'Both', 30, '1200', '1', 'Day', '1', 1, 0, '2021-07-01 00:00:00', '2024-02-11 22:08:32'),
(6, 16, 1, 'noimage.jpg', NULL, 'Maillot int�gral', 'Both', 30, '600', '1', 'Day', '1', 1, 1, '2021-07-01 00:00:00', '2024-02-11 22:09:22'),
(7, 16, 1, 'noimage.jpg', NULL, 'Maillot simple', 'Both', 30, '300', '1', 'Day', '1', 1, 0, '2021-07-01 00:00:00', '2024-02-11 22:08:32'),
(8, 16, 1, 'noimage.jpg', NULL, 'Bord', 'Both', 30, '300', '1', 'Day', '1', 1, 0, '2021-07-01 00:00:00', '2024-02-11 22:08:32'),
(9, 16, 1, 'noimage.jpg', NULL, 'Cuisses', 'Both', 30, '600', '1', 'Day', '1', 1, 0, '2021-07-01 00:00:00', '2024-02-11 22:08:32'),
(10, 16, 1, 'noimage.jpg', NULL, 'Demi jambes', 'Both', 30, '600', '1', 'Day', '1', 1, 0, '2021-07-01 00:00:00', '2024-02-11 22:08:32'),
(11, 16, 1, 'noimage.jpg', NULL, 'Dos', 'Both', 30, '900', '1', 'Day', '1', 1, 0, '2021-07-01 00:00:00', '2024-02-11 22:08:32'),
(12, 16, 1, 'noimage.jpg', NULL, 'Fesses', 'Both', 30, '600', '1', 'Day', '1', 1, 0, '2021-07-01 00:00:00', '2024-02-11 22:08:32'),
(13, 16, 1, 'noimage.jpg', NULL, 'Ventre', 'Both', 30, '600', '1', 'Day', '1', 1, 0, '2021-07-01 00:00:00', '2024-02-11 22:08:32'),
(14, 16, 1, 'noimage.jpg', NULL, 'Ligne Alba', 'Both', 30, '300', '1', 'Day', '1', 1, 0, '2021-07-01 00:00:00', '2024-02-11 22:08:32'),
(15, 16, 1, 'noimage.jpg', NULL, 'Avant bras', 'Both', 30, '600', '1', 'Day', '1', 1, 0, '2021-07-01 00:00:00', '2024-02-11 22:08:32'),
(16, 16, 1, 'noimage.jpg', NULL, 'Demi bras', 'Both', 30, '600', '1', 'Day', '1', 1, 0, '2021-07-01 00:00:00', '2024-02-11 22:08:32'),
(17, 16, 1, 'noimage.jpg', NULL, 'Dos homme', 'Both', 30, '1200', '1', 'Day', '1', 1, 0, '2021-07-01 00:00:00', '2024-02-11 22:08:32'),
(18, 16, 1, 'noimage.jpg', NULL, 'Bas du dos homme', 'Both', 30, '600', '1', 'Day', '1', 1, 0, '2021-07-01 00:00:00', '2024-02-11 22:08:32'),
(19, 16, 1, 'noimage.jpg', NULL, 'Bas du dos femme', 'Both', 30, '300', '1', 'Day', '1', 1, 0, '2021-07-01 00:00:00', '2024-02-11 22:08:32'),
(20, 16, 1, 'noimage.jpg', NULL, 'Épaules', 'Both', 30, '600', '1', 'Day', '1', 1, 0, '2021-07-01 00:00:00', '2024-02-11 22:09:42'),
(21, 16, 1, 'noimage.jpg', NULL, 'Nuque', 'Both', 30, '300', '1', 'Day', '1', 1, 0, '2021-07-01 00:00:00', '2024-02-11 22:08:32'),
(22, 16, 1, 'noimage.jpg', NULL, 'Sein', 'Both', 30, '300', '1', 'Day', '1', 1, 0, '2021-07-01 00:00:00', '2024-02-11 22:08:32'),
(23, 16, 1, 'noimage.jpg', NULL, 'Poitrine', 'Both', 30, '300', '1', 'Day', '1', 1, 0, '2021-07-01 00:00:00', '2024-02-11 22:08:32'),
(24, 16, 1, 'noimage.jpg', NULL, 'Barbe', 'Both', 30, '300', '1', 'Day', '1', 1, 0, '2021-07-01 00:00:00', '2024-02-11 22:08:32'),
(25, 15, 1, 'noimage.jpg', NULL, 'Visage', 'Both', 30, '200', '1', 'Day', '1', 1, 0, '2021-07-01 00:00:00', '2024-02-11 22:08:32'),
(26, 15, 1, 'noimage.jpg', NULL, 'Cou', 'Both', 30, '200', '1', 'Day', '1', 1, 0, '2021-07-01 00:00:00', '2024-02-11 22:08:32'),
(27, 15, 1, 'noimage.jpg', NULL, 'Aisselles', 'Both', 30, '200', '1', 'Day', '1', 1, 0, '2021-07-01 00:00:00', '2024-02-11 22:08:32'),
(28, 15, 1, 'noimage.jpg', NULL, 'Jambes complétes', 'Both', 30, '800', '1', 'Day', '1', 1, 0, '2021-07-01 00:00:00', '2024-02-11 22:08:32'),
(29, 15, 1, 'noimage.jpg', NULL, 'Bras complet', 'Both', 30, '800', '1', 'Day', '1', 1, 0, '2021-07-01 00:00:00', '2024-02-11 22:08:32'),
(30, 15, 1, 'noimage.jpg', NULL, 'Maillot intégral', 'Both', 30, '400', '1', 'Day', '1', 1, 0, '2021-07-01 00:00:00', '2024-02-11 22:08:52'),
(31, 15, 1, 'noimage.jpg', NULL, 'Maillot simple', 'Both', 30, '200', '1', 'Day', '1', 1, 0, '2021-07-01 00:00:00', '2024-02-11 22:08:32'),
(32, 15, 1, 'noimage.jpg', NULL, 'Bord', 'Both', 30, '200', '1', 'Day', '1', 1, 0, '2021-07-01 00:00:00', '2024-02-11 22:08:32'),
(33, 15, 1, 'noimage.jpg', NULL, 'Cuisses', 'Both', 30, '400', '1', 'Day', '1', 1, 0, '2021-07-01 00:00:00', '2024-02-11 22:08:32'),
(34, 15, 1, 'noimage.jpg', NULL, 'Demi jambes', 'Both', 30, '400', '1', 'Day', '1', 1, 0, '2021-07-01 00:00:00', '2024-02-11 22:08:32'),
(35, 15, 1, 'noimage.jpg', NULL, 'Dos femme', 'Both', 30, '600', '1', 'Day', '1', 1, 0, '2021-07-01 00:00:00', '2024-02-11 22:08:32'),
(36, 15, 1, 'noimage.jpg', NULL, 'Fesses', 'Both', 30, '400', '1', 'Day', '1', 1, 0, '2021-07-01 00:00:00', '2024-02-11 22:08:32'),
(37, 15, 1, 'noimage.jpg', NULL, 'Ventre', 'Both', 30, '400', '1', 'Day', '1', 1, 0, '2021-07-01 00:00:00', '2024-02-11 22:08:32'),
(38, 15, 1, 'noimage.jpg', NULL, 'Ligne alba', 'Both', 30, '200', '1', 'Day', '1', 1, 0, '2021-07-01 00:00:00', '2024-02-11 22:08:32'),
(39, 15, 1, 'noimage.jpg', NULL, 'Avant bras', 'Both', 30, '400', '1', 'Day', '1', 1, 0, '2021-07-01 00:00:00', '2024-02-11 22:08:32'),
(40, 15, 1, 'noimage.jpg', NULL, 'Demi bras', 'Both', 30, '400', '1', 'Day', '1', 1, 0, '2021-07-01 00:00:00', '2024-02-11 22:08:32'),
(41, 15, 1, 'noimage.jpg', NULL, 'Dos homme', 'Both', 30, '800', '1', 'Day', '1', 1, 0, '2021-07-01 00:00:00', '2024-02-11 22:08:32'),
(42, 15, 1, 'noimage.jpg', NULL, 'Bas du dos homme', 'Both', 30, '400', '1', 'Day', '1', 1, 0, '2021-07-01 00:00:00', '2024-02-11 22:08:32'),
(43, 15, 1, 'noimage.jpg', NULL, 'Bas du dos femme', 'Both', 30, '200', '1', 'Day', '1', 1, 0, '2021-07-01 00:00:00', '2024-02-11 22:08:32'),
(44, 15, 1, 'noimage.jpg', NULL, 'Épaules', 'Both', 30, '400', '1', 'Day', '1', 1, 0, '2021-07-01 00:00:00', '2024-02-11 22:09:15'),
(45, 15, 1, 'noimage.jpg', NULL, 'Nuque', 'Both', 30, '200', '1', 'Day', '1', 1, 0, '2021-07-01 00:00:00', '2024-02-11 22:08:32'),
(46, 15, 1, 'noimage.jpg', NULL, 'Sein', 'Both', 30, '200', '1', 'Day', '1', 1, 0, '2021-07-01 00:00:00', '2024-02-11 22:08:32'),
(47, 15, 1, 'noimage.jpg', NULL, 'Poitrine', 'Both', 30, '200', '1', 'Day', '1', 1, 0, '2021-07-01 00:00:00', '2024-02-11 22:08:32'),
(48, 15, 1, 'noimage.jpg', NULL, 'Barbe', 'Both', 30, '200', '1', 'Day', '1', 1, 0, '2021-07-01 00:00:00', '2024-02-11 22:08:32'),
(51, 16, 1, 'noimage.jpg', NULL, 'Maillot intégral', 'Both', 30, '400', '1', 'Day', '1', 1, 0, '2024-02-11 23:10:36', '2024-02-11 22:10:36');

-- --------------------------------------------------------

--
-- Table structure for table `template`
--

CREATE TABLE `template` (
  `id` int(10) NOT NULL,
  `title` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `mail_content` longtext CHARACTER SET utf8mb4,
  `msg_content` text CHARACTER SET utf8mb4,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `template`
--

INSERT INTO `template` (`id`, `title`, `subject`, `mail_content`, `msg_content`, `created_at`, `updated_at`) VALUES
(1, 'User Verification', 'User Verification', '<div>Dear&nbsp;{{UserName}},<br><br></div><div>&nbsp; &nbsp; Your registration is completed successfully.</div><div><br></div><div>&nbsp; &nbsp; Your Verification code is {{OTP}}.</div><div><br></div><div>From {{AdminName}}.</div>', 'Dear {{UserName}}, Your registration is completed successfully. Your Verification code is {{OTP}}. From {{AdminName}}.', '2020-08-20 17:32:46', '2020-09-28 18:32:58'),
(2, 'Forgot Password', 'Forgot Password', 'Dear {{UserName}},<br><blockquote>Your new password is {{NewPassword}}.</blockquote><blockquote>Thank you.<br></blockquote>From {{AdminName}}.', 'Dear {{UserName}}, Your new password is {{NewPassword}}. Thank you. From {{AdminName}}.', '2020-08-20 17:32:47', '2020-10-12 05:41:00'),
(3, 'Booking status', 'Booking status', 'Dear {{UserName}},<br><blockquote>Your appointment on {{Date}} at {{Time}} in {{SalonName}} is now {{BookingStatus}}.<br></blockquote><blockquote>Your booking id is {{BookingId}}.&nbsp;<br></blockquote><blockquote>Thank you.<br></blockquote>From&nbsp;{{SalonName}}.', 'Dear {{UserName}}, Your appointment on {{Date}} at {{Time}} in {{SalonName}} is now {{BookingStatus}}. Your booking id is {{BookingId}}. Thank you.', '2020-08-20 17:34:50', '2020-08-21 20:26:49'),
(4, 'Payment status', 'Payment Status', 'Dear {{UserName}},<br><blockquote>Your appointment is successfully created on {{Date}} at {{Time}} of {{SalonName}} payment of {{Amount}} is&nbsp;received.<br></blockquote><blockquote>Your booking id is {{BookingId}}.&nbsp;</blockquote><blockquote>Thank you.<br></blockquote>From&nbsp;{{SalonName}}.', 'Dear {{UserName}}, Your appointment is successfully created on {{Date}} at {{Time}} of {{SalonName}} payment of {{Amount}} is received. Your booking id is {{BookingId}}.  Thank you.', '2020-08-20 17:35:02', '2020-08-21 20:27:00'),
(5, 'Create Appointment', 'Appointment Created', 'Dear {{UserName}},<br><blockquote>Your appointment is successfully created on {{Date}} at {{Time}} in {{SalonName}}.<br></blockquote><blockquote>Your booking id is {{BookingId}}.&nbsp;</blockquote><blockquote>Thank you.<br></blockquote>From&nbsp;{{SalonName}}.', 'Dear {{UserName}}, Your appointment is successfully created on {{Date}} at {{Time}} in {{SalonName}}. Your booking id is {{BookingId}}. Thank you.', '2020-08-21 16:46:46', '2020-08-21 20:27:06');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'noimage.jpg',
  `review` text COLLATE utf8mb4_unicode_ci,
  `birthday` date DEFAULT NULL,
  `gender` tinyint(1) DEFAULT '0',
  `origine` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `practice` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `otp` mediumint(9) DEFAULT NULL,
  `added_by` int(10) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `role` tinyint(4) NOT NULL DEFAULT '3',
  `verify` tinyint(1) NOT NULL DEFAULT '0',
  `device_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notification` tinyint(1) DEFAULT '1',
  `mail` tinyint(1) DEFAULT '1',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `prenom`, `image`, `review`, `birthday`, `gender`, `origine`, `practice`, `email`, `otp`, `added_by`, `email_verified_at`, `password`, `code`, `phone`, `status`, `role`, `verify`, `device_token`, `notification`, `mail`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Souad boussouf \n', NULL, 'noimage.jpg', '', NULL, NULL, NULL, NULL, 'Souad@tayssir.cloud', 1111, NULL, NULL, '$2y$10$rL8dnKiVoIEt0ZAfbG5ef.f9nos0f5V3Cy7jME9N7/1yEqa0MMYz2', '+212', '0666187301', 1, 1, 1, NULL, 1, 1, NULL, '2021-03-19 04:49:30', '2023-12-28 01:27:57'),
(4, 'Support TAYSSIR', NULL, 'noimage.jpg', '', NULL, NULL, NULL, NULL, 'support@tayssir.cloud', NULL, 1, NULL, '$2y$10$0rS2clUmB1pA9IUlAKa.ju92gzwDdrp.FlikdpUh7CutZ8/nxqkRS', '+212', '0666187309', 1, 4, 1, NULL, 1, 1, NULL, '2023-12-08 18:14:30', '2023-12-08 18:14:30'),
(5, 'Zahra elkohli ', NULL, 'noimage.jpg', '', NULL, NULL, NULL, NULL, 'Zahra23@tayssir.cloud', NULL, 1, NULL, '$2y$10$XMG3C9jNeNmvrm0IhZnacOivJk9MreMv1afF1gGXHxOUbTS1CU8B2', '+212', '0666787878', 1, 1, 1, NULL, 1, 1, NULL, '2023-12-09 10:33:39', '2023-12-28 01:42:40'),
(6, 'Latifa Mouatssim', NULL, 'noimage.jpg', '', NULL, 0, NULL, NULL, 'Latifa@tayssir.cloud', NULL, 1, NULL, '$2y$10$nP6jDKmagDl2sRd0WgxkeeyVZAfEbtkG9mZiTPCDxvGX2fQ2wG.cy', '+2', '0000000000', 1, 5, 1, NULL, 1, 1, NULL, '2023-12-09 18:58:30', '2023-12-28 01:43:31'),
(20, 'test', NULL, 'noimage.jpg', NULL, NULL, 0, 'Social networks', NULL, NULL, NULL, 1, NULL, '$2y$10$4yjKEabmOtyJoD4Z3vViTuWbqk5mG1OxCY7eiTt8nsPLtvo3AaeIC', '+', NULL, 1, 3, 1, NULL, 1, 1, NULL, '2023-12-28 13:36:43', '2023-12-28 13:36:43'),
(21, 'not the test', NULL, 'noimage.jpg', NULL, NULL, 0, 'Social networks', NULL, NULL, NULL, 1, NULL, '$2y$10$J2T8E3veReYRWqQ6G2bxuu7QWWLnVaZMjTlWTdSuRxY1fybmoNDj.', '+', '0000000000', 1, 3, 1, NULL, 1, 1, NULL, '2023-12-28 21:23:24', '2024-01-10 19:25:52'),
(85, 'ttttttgggggggg', 'ttttttgggggggg', 'noimage.jpg', NULL, NULL, 1, 'Social networks', NULL, NULL, NULL, 1, NULL, '$2y$10$KjR.ENFkThq7mZnjB.D6nurB2A2/bkvi/S28uwaThsYHxAMNNPasK', '+', NULL, 1, 3, 1, NULL, 1, 1, NULL, '2024-03-01 16:04:26', '2024-03-01 16:28:30'),
(86, 'tetetet', 'teete', 'noimage.jpg', NULL, NULL, 1, 'Social networks', NULL, NULL, NULL, 1, NULL, '$2y$10$Wa7KWn85x6PTen5JgGK95uiP1b7eVC/2jwmF/Wi7WQpJFsU1Asbpu', '+', NULL, 1, 3, 1, NULL, 1, 1, NULL, '2024-03-01 16:28:59', '2024-03-01 17:44:04'),
(87, 'barrah', 'mohamed', 'noimage.jpg', NULL, NULL, 1, 'Social networks', NULL, NULL, NULL, 1, NULL, '$2y$10$fAygARcKJKZJ09JQUdVby.n8E0czOib1KkfBMly2eAyDaE14Lpftm', '+', '0604444569', 1, 3, 1, NULL, 1, 1, NULL, '2024-03-01 17:51:10', '2024-03-01 18:05:32'),
(88, 'xxxx', 'xxxxx', 'noimage.jpg', NULL, NULL, NULL, 'Sponsorship', NULL, NULL, NULL, 1, NULL, '$2y$10$7US8wFm6ndEgNHSJ0buUQeMbhET2qta.FQCqEhnzdl4KhEg7jCwgy', '+', NULL, 1, 3, 1, NULL, 1, 1, NULL, '2024-03-03 18:13:51', '2024-03-03 18:13:51'),
(89, '8888', '8888', 'noimage.jpg', NULL, NULL, 1, 'Sponsorship', NULL, NULL, NULL, 1, NULL, '$2y$10$xo3BCtW3xmTeWumyoUf4GuKoEpI/zSU/oFKySYKj.TpSMO5IdsEQe', '+', NULL, 1, 3, 1, NULL, 1, 1, NULL, '2024-03-03 18:33:45', '2024-03-03 18:33:45'),
(90, 'vv', 'vvvvv', 'noimage.jpg', NULL, NULL, NULL, 'Sponsorship', NULL, NULL, NULL, 1, NULL, '$2y$10$Oitt3WwXvE7fqYM2H3ffaeGxUoh3aHnduX1fC7VMrf3l30jxrLGCu', '+', NULL, 1, 3, 1, NULL, 1, 1, NULL, '2024-03-03 18:35:35', '2024-03-03 18:35:35'),
(91, 'jjjjj', 'j', 'noimage.jpg', NULL, NULL, 1, 'Sponsorship', 'Latifa Mouatssim', NULL, NULL, 1, NULL, '$2y$10$k.9aYHi7UBngEgNTNscYGetDDGKf4jCyQhtCJuBHSLViPBgV/8DPW', '+', NULL, 1, 3, 1, NULL, 1, 1, NULL, '2024-03-03 18:38:34', '2024-03-03 18:38:34'),
(92, 'zzzz', 'zzzzzz', 'noimage.jpg', NULL, NULL, 1, 'Social networks', NULL, NULL, NULL, 1, NULL, '$2y$10$VTZ0ozr6O6ndEBnyrHoNw.ge68/IW.EFqtTd5KEv/JIkxI85ba/DO', '+', NULL, 1, 3, 1, NULL, 1, 1, NULL, '2024-03-03 18:48:13', '2024-03-03 18:55:38'),
(93, 'uuuuu', 'uuuuu', 'noimage.jpg', NULL, NULL, 0, 'Social networks', NULL, NULL, NULL, 1, NULL, '$2y$10$ptpjCSsDuwHLVqAMMIcfoOyJOMFlfSalTBEU/Lw0lBhMmUA9SkX.G', '+', NULL, 1, 3, 1, NULL, 1, 1, NULL, '2024-03-03 18:57:25', '2024-03-03 18:57:41'),
(94, 'aaaa', 'aaa', 'noimage.jpg', NULL, NULL, 1, 'Social networks', NULL, NULL, NULL, 1, NULL, '$2y$10$L/ZPzkt1hYJLQyfWR/RzROTiosvFvezYtmf/WYnc9Fbyrsy79Te2e', '+', NULL, 1, 3, 1, NULL, 1, 1, NULL, '2024-03-03 19:01:58', '2024-03-03 19:02:21'),
(95, 'llllllll', 'lllll', 'noimage.jpg', NULL, NULL, 1, 'Social networks', NULL, NULL, NULL, 1, NULL, '$2y$10$3EidT5GMXjmiAFdra8H9ZeBdbXPtw3FKnBB4tOHeWmHTgRSCTiU22', '+', NULL, 1, 3, 1, NULL, 1, 1, NULL, '2024-03-03 19:04:45', '2024-03-03 19:05:09'),
(96, 'o', 'oo', 'noimage.jpg', NULL, NULL, 1, 'Social networks', NULL, NULL, NULL, 1, NULL, '$2y$10$J8so.2mfWJb9jpginQirq.etxFwBEjB4V33l.I6btB6.i.DHhjG36', '+', NULL, 1, 3, 1, NULL, 1, 1, NULL, '2024-03-03 19:05:58', '2024-03-03 19:10:45'),
(97, 'iii', 'iiiiiiiiiiii', 'noimage.jpg', NULL, NULL, 1, 'Social networks', NULL, NULL, NULL, 1, NULL, '$2y$10$ltuTBSfuqiVg0iCOAw9nY.cU3IJMwEM8fl9tett8lMoQeJonEqZKu', '+', NULL, 1, 3, 1, NULL, 1, 1, NULL, '2024-03-03 19:11:23', '2024-03-03 19:48:41'),
(98, 'vvvv', 'vvvvvvvv', 'noimage.jpg', NULL, NULL, 1, 'Social networks', NULL, NULL, NULL, 1, NULL, '$2y$10$G4nAnmgi12M5sddDfxjgduSl7ngOqncPsy9mGQHTN0Vp1bx0v7WN.', '+', NULL, 1, 3, 1, NULL, 1, 1, NULL, '2024-03-03 19:50:01', '2024-03-03 20:47:47'),
(99, 'ggggggggg', 'ggggggg', 'noimage.jpg', NULL, NULL, 1, 'Social networks', NULL, NULL, NULL, 1, NULL, '$2y$10$117TYsvgh6QCjF6Kobrz6OEDYELgy7vV2uYh6KEhH/gVNrPmLJzVS', '+', NULL, 1, 3, 1, NULL, 1, 1, NULL, '2024-03-04 22:49:08', '2024-03-04 22:49:38'),
(100, 'llllllllllll', 'lllllllll', 'noimage.jpg', NULL, NULL, 1, 'Social networks', NULL, NULL, NULL, 1, NULL, '$2y$10$LOQ4rL9ZDgmWYiQl/mmKfeuEIgYiNVwWnb0PmWWvcqFkBO8GwbaZW', '+', NULL, 1, 3, 1, NULL, 1, 1, NULL, '2024-03-05 12:12:50', '2024-03-05 12:13:05'),
(101, 'ycy', 'xyccx', 'noimage.jpg', NULL, NULL, 0, 'Social networks', NULL, NULL, NULL, 1, NULL, '$2y$10$1dO6qBPcPkMvkOQsG8FbsehgXPvIiz8bab.O4yypTmeyIMOS9ZjO.', '+', NULL, 1, 3, 1, NULL, 1, 1, NULL, '2024-03-10 21:18:28', '2024-03-10 21:18:28');

-- --------------------------------------------------------

--
-- Table structure for table `user_parametrage`
--

CREATE TABLE `user_parametrage` (
  `id` int(11) NOT NULL,
  `service_parametage_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `energie` varchar(255) DEFAULT NULL,
  `frequence` varchar(255) DEFAULT NULL,
  `refroidissement` varchar(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`address_id`);

--
-- Indexes for table `adminsetting`
--
ALTER TABLE `adminsetting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `banner`
--
ALTER TABLE `banner`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bill`
--
ALTER TABLE `bill`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `caisse`
--
ALTER TABLE `caisse`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `coupon`
--
ALTER TABLE `coupon`
  ADD PRIMARY KEY (`coupon_id`);

--
-- Indexes for table `currency`
--
ALTER TABLE `currency`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`emp_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`gallery_id`);

--
-- Indexes for table `global_invoice`
--
ALTER TABLE `global_invoice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `global_invoice_details`
--
ALTER TABLE `global_invoice_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `language`
--
ALTER TABLE `language`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_access_tokens_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_auth_codes`
--
ALTER TABLE `oauth_auth_codes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_auth_codes_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_clients_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`);

--
-- Indexes for table `offer`
--
ALTER TABLE `offer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `parametage_services`
--
ALTER TABLE `parametage_services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `booking_id` (`booking_id`);

--
-- Indexes for table `paymentsetting`
--
ALTER TABLE `paymentsetting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`review_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`room_id`);

--
-- Indexes for table `salon`
--
ALTER TABLE `salon`
  ADD PRIMARY KEY (`salon_id`,`owner_id`) USING BTREE;

--
-- Indexes for table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`service_id`);

--
-- Indexes for table `service_details`
--
ALTER TABLE `service_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `template`
--
ALTER TABLE `template`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_parametrage`
--
ALTER TABLE `user_parametrage`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `address_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `adminsetting`
--
ALTER TABLE `adminsetting`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `banner`
--
ALTER TABLE `banner`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `bill`
--
ALTER TABLE `bill`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `caisse`
--
ALTER TABLE `caisse`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `cat_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `coupon`
--
ALTER TABLE `coupon`
  MODIFY `coupon_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `currency`
--
ALTER TABLE `currency`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=133;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `emp_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `gallery_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `global_invoice`
--
ALTER TABLE `global_invoice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `global_invoice_details`
--
ALTER TABLE `global_invoice_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `language`
--
ALTER TABLE `language`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=838;

--
-- AUTO_INCREMENT for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `offer`
--
ALTER TABLE `offer`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `parametage_services`
--
ALTER TABLE `parametage_services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `paymentsetting`
--
ALTER TABLE `paymentsetting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `review_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `room_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `salon`
--
ALTER TABLE `salon`
  MODIFY `salon_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `service`
--
ALTER TABLE `service`
  MODIFY `service_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `service_details`
--
ALTER TABLE `service_details`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `template`
--
ALTER TABLE `template`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT for table `user_parametrage`
--
ALTER TABLE `user_parametrage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`booking_id`) REFERENCES `booking` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
