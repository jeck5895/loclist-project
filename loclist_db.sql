-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 03, 2018 at 09:51 AM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `loclist_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `action_plans`
--

CREATE TABLE `action_plans` (
  `id` int(10) UNSIGNED NOT NULL,
  `action_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_active` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `activity_logs`
--

CREATE TABLE `activity_logs` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `action` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `certificates`
--

CREATE TABLE `certificates` (
  `id` int(10) UNSIGNED NOT NULL,
  `iso_name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_active` tinyint(4) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `certificates`
--

INSERT INTO `certificates` (`id`, `iso_name`, `created_at`, `updated_at`, `is_active`) VALUES
(1, 'ISO 9001:2008', '2017-11-27 18:16:33', '2017-11-27 18:16:33', 1),
(2, 'ISO 14001:2004', '2017-11-27 18:26:59', '2017-11-27 18:32:33', 1),
(3, 'ISO 17025', '2017-11-27 19:01:15', '2017-11-27 19:01:15', 1),
(4, 'N/A', '2017-12-11 02:59:55', '2017-12-11 02:59:55', 1),
(5, 'ISO 9002', '2017-12-11 23:47:04', '2017-12-11 23:47:04', 1),
(6, 'ISO 9001:2000', '2017-12-12 21:30:03', '2017-12-12 21:30:03', 1),
(7, 'PISFA, DTI, CAB, AFPI, CTAP, PEZA', '2017-12-12 21:41:42', '2017-12-12 21:41:42', 1);

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` int(10) UNSIGNED NOT NULL,
  `entry_by` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `overall_status` int(11) DEFAULT NULL,
  `entry_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `client_name` varchar(90) COLLATE utf8mb4_unicode_ci NOT NULL,
  `industry` int(11) NOT NULL,
  `nationality` int(11) NOT NULL,
  `iso_certf` int(10) UNSIGNED NOT NULL,
  `complete_mailing_address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `techno_park` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `street_address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `province` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `administrative_area_level_1` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'alias for AREA',
  `postal_code` int(11) NOT NULL COMMENT 'aliias for ZIP CODE',
  `website` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `primary_landline` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `other_landline` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile_number` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_address` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_person` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `department` int(11) DEFAULT NULL,
  `position` int(11) DEFAULT NULL,
  `manpower` int(11) DEFAULT NULL,
  `sourcing_practice` int(11) DEFAULT NULL,
  `manpower_provider` int(11) DEFAULT NULL,
  `proposal` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `updated_by` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT '1',
  `first_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `entry_by`, `overall_status`, `entry_date`, `client_name`, `industry`, `nationality`, `iso_certf`, `complete_mailing_address`, `techno_park`, `street_address`, `province`, `administrative_area_level_1`, `postal_code`, `website`, `primary_landline`, `other_landline`, `mobile_number`, `email_address`, `contact_person`, `gender`, `department`, `position`, `manpower`, `sourcing_practice`, `manpower_provider`, `proposal`, `company`, `created_at`, `updated_at`, `updated_by`, `is_active`, `first_name`, `last_name`) VALUES
(1, '105811678312470064548', 1, '2017-12-18 05:38:10', 'AJINOMOTO PHILIPPINES FLAVOR FOOD INC', 3, 3, 1, 'KM. 35 MCARTHUR HISAY TABANG GUIGUINTO BULACAN', 'KM. 35 MCARTHUR HISAY TABANG GUIGUINTO BULACAN', 'KM. 35 MCARTHUR HISAY TABANG GUIGUINTO', 'Bulacan, Central Luzon, Philippines', 'Central Luzon', 1604, 'https://ajinomoto.com', '44-7941001', 'N/A', 'N/A', 'malou_landaya@ajinomoto.com', 'MALOU LANDAYA PACARDA', 'female', 3, 6, 2, NULL, NULL, 'OUTSOURCE', 5, '2017-12-11 02:45:41', '2017-12-17 21:38:10', '105811678312470064548', 1, '', ''),
(2, '105811678312470064548', NULL, '2017-12-12 11:38:35', 'FILINVEST LAND INC', 10, 2, 4, 'FILINVEST BUILDING 79 EDSA MANDALUYONG CITY', 'FILINVEST BUILDING', '79 EDSA', 'Mandaluyong, NCR, Philippines', 'NCR', 1554, 'http://filinvest.com', '02-588-1678', '02-918-8188 LOC. 3284', '0906-326-2335', 'person@noemail.com', 'EVA BERNARDO / MARILYN TEODORO', 'female', 2, 2, 2, NULL, NULL, 'OUTSOURCE', 5, '2017-12-11 03:06:38', '2017-12-11 03:06:38', '105811678312470064548', 1, '', ''),
(3, '105811678312470064548', NULL, '2017-12-12 11:38:37', '8M PLASTICS TECHNOLOGIES INC.', 12, 2, 4, 'FILINVEST TECHNOLOGY PARK RBF UNIT 1, CIUDAD DE CALAMBA\' BRGY. PUNTA CALAMBA, LAGUNA', 'FILINVEST TECHNOLOGY PARK', 'RBF UNIT 1, CIUDAD DE CALAMBA\' BRGY. PUNTA', 'Calamba, Laguna, Calabarzon, Philippines', 'Calabarzon', 0, 'http://WWW.8PLASTICS.COM', '049-545-6833 TO 84', 'N/A', '0917-526-2162', '8plastics@gmail.com', 'DIANNE CUBANGBANG', 'female', 6, 6, 2, NULL, NULL, 'OUTSOURCE', 5, '2017-12-11 03:32:24', '2017-12-11 03:32:24', '105811678312470064548', 1, '', ''),
(4, '105811678312470064548', NULL, '2017-12-12 11:38:39', 'A-5 ALLIANCE INDUSTRIAL MACHINES INCORPORATED', 14, 11, 4, 'FILINVEST TECHNOLOGY PARK LOT 4, CIUDAD DE CALAMBA\' BRGY. PUNTA CALAMBA, LAGUNA', 'FILINVEST TECHNOLOGY PARK', 'LOT 4, CIUDAD DE CALAMBA\' BRGY. PUNTA', 'Calamba, Laguna, Calabarzon, Philippines', 'Calabarzon', 0, 'N/A', '049-545-0757', 'N/A', 'N/A', 'kaye@a5alliance.ph', 'MS. ALIE / MS. KAYE', 'female', 8, 7, 2, NULL, NULL, 'OUTSOURCE', 5, '2017-12-11 03:54:29', '2017-12-11 03:54:29', '105811678312470064548', 1, '', ''),
(5, '105811678312470064548', NULL, '2017-12-12 11:38:41', 'ORIENTAL TOOLMASTER CORPORATION', 17, 2, 5, '747 SGT. BUMATAY ST., PLAIN VIEW  MANDALUYONG CITY', 'N/A', '747 SGT. BUMATAY ST., PLAIN VIEW', 'Mandaluyong, NCR, Philippines', 'NCR', 1500, 'N/A', '02-531-9860', '531-9355', 'N/A', 'claudepg@otc.com.ph', 'JUANITO PONTIVEROS', 'male', 4, 12, 2, NULL, NULL, 'OUTSOURCE', 5, '2017-12-12 00:08:01', '2017-12-12 00:08:01', '105811678312470064548', 1, '', ''),
(6, '113421066030730317656', NULL, '2017-12-12 11:38:44', 'NORTHEAST PRECISION, INCORPORATED', 18, 2, 4, 'FILINVEST TECHNOLOGY PARK RBF BLDG. 2, CIUDAD DE CALAMBA\' BRGY. PUNTA CALAMBA, LAGUNA', 'FILINVEST TECHNOLOGY PARK', 'RBF BLDG. 2, CIUDAD DE CALAMBA\' BRGY. PUNTA', 'Calamba, Laguna, Calabarzon, Philippines', 'Calabarzon', 0, 'N/A', '049-545-6254 or 2889', 'N/A', 'N/A', 'sales@northeastprecision.ph', 'SHIRLEY CAPUYAN', 'female', 7, 9, 2, NULL, NULL, 'OUTSOURCE', 5, '2017-12-12 01:18:44', '2017-12-12 01:18:44', '113421066030730317656', 1, '', ''),
(7, '105811678312470064548', NULL, '2017-12-12 11:38:50', 'SAMSUNG ELECTROMEHCANICS PHILIPPINES MFG. CORPORATION', 20, 4, 4, 'CALAMBA PREMIERE INTERNATIONAL PARK BLK. 5, \' BRGY. BATINO CALAMBA, LAGUNA', 'CALAMBA PREMIERE INTERNATIONAL PARK', 'BLK. 5, \' BRGY. BATINO', 'Calamba, Laguna, Calabarzon, Philippines', 'Calabarzon', 0, 'N/A', '508-8300', 'N/A', 'N/A', 'no@email.com', 'NINA ROSE MALLARI', 'female', 7, 7, 2, NULL, NULL, 'OUTSOURCE', 5, '2017-12-12 02:02:47', '2017-12-12 02:02:47', '105811678312470064548', 1, '', ''),
(8, '105811678312470064548', NULL, '2017-12-12 11:38:47', 'SANOH FULTON PHILS. INC.', 22, 2, 4, 'PEOPLE\'S TECHNOLOGY COMPLEX , \' BRGY. MADUYA & CABILANG BAYBAY CARMONA, CAVITE', 'PEOPLE\'S TECHNOLOGY COMPLEX', ', \' BRGY. MADUYA & CABILANG BAYBAY', 'Carmona, Cavite, Calabarzon, Philippines', 'Calabarzon', 0, 'N/A', '(046) 889-0419', '02-8863752', 'N/A', 'no@email.com', 'ERLINA J. EUSEBIO / MARY GRACE C. VILLANUEVA', 'female', 5, 4, 2, NULL, NULL, 'OUTSOURCE', 5, '2017-12-12 02:13:27', '2017-12-12 02:13:27', '105811678312470064548', 1, '', ''),
(9, '105811678312470064548', NULL, '2017-12-13 05:25:43', 'AVID SALES CORPORATION', 24, 11, 4, '1172 Epifanio de los Santos Ave, Balintawak QUEZON CITY', 'N/A', '1172 Epifanio de los Santos Ave, Balintawak', 'Quezon City, NCR, Philippines', 'NCR', 0, 'N/A', '02-9612254', 'N/A', 'N/A', 'lisette.ramos@avid.com.ph', 'LISETTE RAMOS', 'female', 7, 9, 7, NULL, NULL, 'OUTSOURCE', 5, '2017-12-12 21:25:43', '2017-12-12 21:25:43', '105811678312470064548', 1, '', ''),
(10, '105811678312470064548', NULL, '2017-12-13 05:38:39', 'ZILOG ELECTRONICS PHILIPPINES, INC.', 23, 1, 6, 'FOOD TERMINAL INC. 2/F ELECTRONICS AVE., SPECIAL ECONOMIC ZONE TAGUIG CITY', 'FOOD TERMINAL INC.', '2/F ELECTRONICS AVE., SPECIAL ECONOMIC ZONE', 'Taguig, NCR, Philippines', 'NCR', 1603, 'www.zilog.com', '02-837-3083', 'N/A', 'N/A', 'mlaxamana@zilog.com', 'MERCEDES LAXAMANA', 'female', 8, 7, 2, NULL, NULL, 'DIRECT', 5, '2017-12-12 21:38:39', '2017-12-12 21:38:39', '105811678312470064548', 1, '', ''),
(11, '105811678312470064548', NULL, '2017-12-13 05:47:46', 'ACESTAR INTERNATIONAL SERVICE CORPORATION', 25, 2, 7, '19th St. cor. Railroad St., Port Area METRO MANILA', 'N/A', '19th St. cor. Railroad St., Port Area', 'Metro Manila, Philippines', 'NCR', 0, 'http://www.acestar.com.ph', '02-526-2888', 'N/A', 'N/A', 'r-salutillo@acestar.com.ph', 'RICKY SALUTILLO', 'male', 11, 12, 7, NULL, NULL, 'OUTSOURCE', 5, '2017-12-12 21:47:46', '2017-12-12 21:47:46', '105811678312470064548', 1, '', ''),
(12, '105811678312470064548', NULL, '2017-12-13 06:16:17', 'ADVANCE FASTENERS, INC.', 26, 2, 4, 'GREENHILLS SUITE 1506 JAPER PLACE, 19 ELSENHOWER ST.,  SAN JUAN CITY', 'GREENHILLS', 'SUITE 1506 JAPER PLACE, 19 ELSENHOWER ST.,', 'San Juan, Metro Manila, Philippines', 'NCR', 0, 'http://www.advancefastener.inc', '02-727 - 7905', 'N/A', 'N/A', 'sales.admin@advancefastener.com', 'CARLA PALAMOS', 'female', 8, 7, 7, NULL, NULL, 'OUTSOURCE', 5, '2017-12-12 22:16:17', '2017-12-12 22:16:17', '105811678312470064548', 1, '', ''),
(13, '105811678312470064548', NULL, '2017-12-13 06:26:26', 'AGGREKO ENERGY RENTAL SOLUTIONS INC.', 27, 2, 4, 'Bonifacio Global City , \' nit 2001 One Global Place, 25th St., cor. 5th Ave.,  TAGUIG CITY', 'Bonifacio Global City', 'Unit 2001 One Global Place, 25th St., cor. 5th Ave.,', 'Bonifacio Global City, Taguig, NCR, Philippines', 'NCR', 0, 'http://www.aggreko.co.uk', '02-989-8425', '02-224-2042', 'N/A', 'Jonnifer.Aton@aggreko.com.sg', 'Jonnifer Aton', 'female', 11, 7, 7, NULL, NULL, 'OUTSOURCE', 5, '2017-12-12 22:26:26', '2017-12-12 22:26:26', '105811678312470064548', 1, '', ''),
(14, '105811678312470064548', NULL, '2017-12-13 06:31:41', 'RENTOKIL INITIAL PHILIPPINES INC', 28, 2, 4, '73 ELIZO ROAD PASIG CITY', 'N/A', '73 ELIZO ROAD', 'Pasig City, NCR, Philippines', 'NCR', 1600, 'http://www.rentokil.com.ph', '02-3335888', '02-3335801', '0917-5868294', 'dinofortunato.coronel@rentokil-initial.com', 'DINO FORTUNATO CORONEL', 'male', 7, 9, 1, NULL, NULL, 'OUTSOURCE', 5, '2017-12-12 22:31:41', '2017-12-12 22:31:41', '105811678312470064548', 1, '', ''),
(15, '105811678312470064548', NULL, '2017-12-13 06:41:45', 'GREEN LAKE TRAVEL & TOURS', 29, 2, 4, 'CROSSING SILANG EAST TAGAYTAY CITY', 'N/A', 'CROSSING SILANG EAST', 'Tagaytay City, Calabarzon, Philippines', 'Calabarzon', 0, 'N/A', 'N/A', 'N/A', '0905-7297221', 'greenlaketravellandtours@gmail.com', 'BERLYN GRACE CASIMPOY / SHEILA MALABANAN', 'female', 11, 19, 1, NULL, NULL, 'OUTSOURCE', 5, '2017-12-12 22:41:45', '2017-12-12 22:41:45', '105811678312470064548', 1, '', ''),
(16, '105811678312470064548', NULL, '2017-12-13 06:58:00', 'FINEX MARKETING', 30, 2, 4, 'UNIT 2006 HERRERA TOWER V.A. RUFINO COR. VALERO STS. SALCEDO VILLAGE MAKATI CITY', 'N/A', 'UNIT 2006 HERRERA TOWER V.A. RUFINO COR. VALERO STS. SALCEDO VILLAGE', 'Makati City, NCR, Philippines', 'NCR', 0, 'N/A', '02-8120664', '02-7531314', 'N/A', 'cbalmazar@yahoo.com', 'CRISTY ALMAZAR', 'female', 11, 19, 1, NULL, NULL, 'OUTSOURCE', 5, '2017-12-12 22:58:00', '2017-12-12 22:58:00', '105811678312470064548', 1, '', ''),
(17, '105811678312470064548', NULL, '2017-12-13 07:07:30', 'D.F. TINKER BELL SCHOOL INC.', 31, 2, 4, '72 GEN. ESPINO ST. ZONE 4, SIGNAL VILLAGE TAGUIG CITY', 'N/A', '72 GEN. ESPINO ST. ZONE 4, SIGNAL VILLAGE', '72 General Espino, Taguig, NCR, Philippines', 'NCR', 1630, 'N/A', '02-8370773', 'N/A', 'N/A', 'mariaclara_occena@yahoo.com', 'MARIA CLARA OCCENA', 'female', 11, 20, 1, NULL, NULL, 'OUTSOURCE', 5, '2017-12-12 23:07:30', '2017-12-12 23:07:30', '105811678312470064548', 1, '', ''),
(18, '105811678312470064548', NULL, '2017-12-13 08:03:37', 'MARGARRETTE ENTERPRISES INC.', 32, 11, 4, 'SITIO ILUGIN SANDOVAL ST. CAINTA RIZAL', 'N/A', 'SITIO ILUGIN SANDOVAL ST. CAINTA', 'Rizal, Cainta, Calabarzon, Philippines', 'Calabarzon', 0, 'N/A', '02-4252803', 'N/A', 'N/A', 'meihrda_bvj@yahoo.com', 'BERNADETTE JUAN', 'female', 7, 21, 2, NULL, NULL, 'OUTSOURCE', 5, '2017-12-13 00:03:37', '2017-12-13 00:03:37', '105811678312470064548', 1, '', ''),
(19, '105811678312470064548', NULL, '2017-12-13 08:09:00', 'UNIVERSITY OF BAGUIO', 33, 11, 4, 'GENERAL LUNA ROAD BAGUIO CITY', 'N/A', 'GENERAL LUNA ROAD', 'Baguio, Cordillera Administrative Region, Philippines', 'CAR', 0, 'N/A', '074-4424915', 'N/A', 'N/A', 'vpadmin@ubaguio.edu', 'DR. LLYOD ORDUNA', 'male', 11, 22, 3, NULL, NULL, 'OUTSOURCE', 5, '2017-12-13 00:09:00', '2017-12-13 00:09:00', '105811678312470064548', 1, '', ''),
(20, '105811678312470064548', NULL, '2017-12-13 09:46:06', 'NATIONAL TEACHERS COLLEGE', 33, 11, 4, 'J., 629 Nepomuceno St, Quiapo MANILA', 'N/A', 'J., 629 Nepomuceno St, Quiapo', 'Manila, NCR, Philippines', 'NCR', 0, 'N/A', '02-7345601', 'N/A', 'N/A', 'no@email.com', 'JEWETTE VALLENCERA', 'female', 7, 23, 3, NULL, NULL, 'OUTSOURCE', 5, '2017-12-13 01:46:06', '2017-12-13 01:46:06', '105811678312470064548', 1, '', ''),
(21, '113421066030730317656', NULL, '2017-12-13 10:26:20', 'ARELLANO UNIVERSITY', 33, 11, 4, '2600 LEGARDA ST. SAMPALOC MANILA', 'N/A', '2600 LEGARDA ST. SAMPALOC', '2600 Legarda Bridge, Sampaloc, Manila, NCR, Philippines', 'NCR', 0, 'N/A', '02-7347371', 'N/A', 'N/A', 'no@email.com', 'ATTY. FREDERIC DEDACE', 'male', 7, 22, 3, NULL, NULL, 'OUTSOURCE', 5, '2017-12-13 02:26:20', '2017-12-13 02:26:20', '113421066030730317656', 1, '', ''),
(22, '105811678312470064548', 1, '2017-12-18 07:21:31', 'SKY SUITES PHIL. HOLDINGS INC', 34, 11, 4, '27F AYALA LIFE-FGU CENTER 6811 AYALA AVENUE MAKATI CITY', 'N/A', '27F AYALA LIFE-FGU CENTER 6811 AYALA AVENUE', '6811 Ayala Avenue, Makati, NCR, Philippines', 'NCR', 0, 'http://www.eliteunion.com.ph', '02-7531901', '02-7531601', 'N/A', 'mvictoria@eliteunion.com.ph', 'MARIVIC S. VICTORIA', 'female', 12, 11, 1, NULL, NULL, 'OUTSOURCE', 5, '2017-12-15 04:22:25', '2017-12-17 23:21:31', '105811678312470064548', 1, '', ''),
(23, '105811678312470064548', NULL, '2017-12-18 08:38:16', 'GAMOT PUBLIKO', 35, 2, 4, '2ND FLOOR UNIT 202 STK BLDG. 681 AURORA BLVD.  QUEZON CITY', 'N/A', '2ND FLOOR UNIT 202 STK BLDG. 681 AURORA BLVD.', '681 Aurora Boulevard, Quezon City, NCR, Philippines', 'NCR', 1112, 'http://www.gamotpubliko.com', '02-7238142', 'N/A', 'N/A', 'franchise@gamotpubliko.com', 'SHIELA LLORIN', 'female', 13, 10, 1, NULL, NULL, 'OUTSOURCE', 5, '2017-12-18 00:36:01', '2017-12-18 00:38:16', '105811678312470064548', 1, '', ''),
(24, '105811678312470064548', 1, '2017-12-27 06:45:35', 'DOMINO\'S PIZZA (3030 DPP VENTURES INC)', 36, 11, 4, '811 LAUREAL ST. SHAW BLVD PASIG CITY', 'N/A', '811 LAUREAL ST. SHAW BLVD', 'Pasig City, NCR, Philippines', 'NCR', 1600, 'http://www.dominospizza.com', '02-2393800', 'N/A', 'N/A', 'recruitment@dominospizza.ph', 'RODELIO FRANCE', 'male', 7, 9, 2, NULL, NULL, 'OUTSOURCE', 5, '2017-12-18 00:44:22', '2017-12-26 22:45:35', '105811678312470064548', 1, 'RODELIO', 'FRANCE'),
(25, '105811678312470064548', 4, '2017-12-27 07:34:11', 'INLAND CORPORATION CABUYAO OFFICE', 25, 2, 4, 'Brgy. Pulo, Cabuyao, Laguna', 'N/A', 'Brgy. Pulo', 'Cabuyao, Calabarzon, Philippines', 'Calabarzon', 0, 'N/A', 'N/A', 'N/A', '0922-817-9387', 'pulohrd@inlandph.com', 'Ms. Hazel', 'female', 7, 15, 1, NULL, NULL, 'OUTSOURCE', 5, '2017-12-26 19:54:13', '2017-12-26 23:34:11', '105811678312470064548', 1, 'Hazel', 'UNKNOWN');

-- --------------------------------------------------------

--
-- Table structure for table `client_acquisition`
--

CREATE TABLE `client_acquisition` (
  `id` int(10) UNSIGNED NOT NULL,
  `client_id` int(11) NOT NULL,
  `status_as_of` timestamp NULL DEFAULT NULL,
  `status` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_acquired` timestamp NULL DEFAULT NULL,
  `acquired_by` int(11) DEFAULT NULL,
  `signed_contract` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `manner_of_acquisition` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_of_related_client` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `initial_hc_acquired` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remarks` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `updated_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `client_calls`
--

CREATE TABLE `client_calls` (
  `id` int(10) UNSIGNED NOT NULL,
  `caller` int(11) NOT NULL,
  `date_of_call` timestamp NULL DEFAULT NULL,
  `confirmation_preCall` tinyint(1) DEFAULT NULL,
  `productive_call` tinyint(1) DEFAULT NULL,
  `proposal_sent` tinyint(1) DEFAULT NULL,
  `client_response` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `updated_by` int(11) NOT NULL,
  `client_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `client_manpower_providers`
--

CREATE TABLE `client_manpower_providers` (
  `id` int(10) UNSIGNED NOT NULL,
  `client_id` int(10) UNSIGNED NOT NULL,
  `manpower_provider` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `client_manpower_providers`
--

INSERT INTO `client_manpower_providers` (`id`, `client_id`, `manpower_provider`, `created_at`, `updated_at`) VALUES
(2, 2, 'N/A', '2017-12-11 03:06:38', '2017-12-11 03:06:38'),
(3, 3, 'N/A', '2017-12-11 03:32:24', '2017-12-11 03:32:24'),
(4, 4, 'N/A', '2017-12-11 03:54:29', '2017-12-11 03:54:29'),
(5, 6, 'CONFIDENTIAL', '2017-12-12 01:18:44', '2017-12-12 01:18:44'),
(6, 7, 'NOZOMI', '2017-12-12 02:02:48', '2017-12-12 02:02:48'),
(7, 8, 'DENT CHEM ENTERPRISE', '2017-12-12 02:13:27', '2017-12-12 02:13:27'),
(8, 10, 'DID NOT DISCLOSED', '2017-12-12 21:38:39', '2017-12-12 21:38:39'),
(10, 22, 'Asia pro', '2017-12-18 00:28:43', '2017-12-18 00:28:43'),
(11, 22, 'JTCI', '2017-12-18 00:28:43', '2017-12-18 00:28:43'),
(18, 24, 'Asia pro', '2017-12-26 22:45:35', '2017-12-26 22:45:35'),
(19, 24, 'SAMPLE PROVIDER', '2017-12-26 22:45:35', '2017-12-26 22:45:35');

-- --------------------------------------------------------

--
-- Table structure for table `client_manpower_types`
--

CREATE TABLE `client_manpower_types` (
  `id` int(10) UNSIGNED NOT NULL,
  `type` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `client_manpower_types`
--

INSERT INTO `client_manpower_types` (`id`, `type`, `created_at`, `updated_at`, `is_active`) VALUES
(1, 'DIRECT', '2017-11-30 23:50:05', '2017-11-30 23:59:14', 1),
(2, 'OUTSOURCED', '2017-11-30 23:59:27', '2017-12-12 02:11:59', 1),
(3, 'DIRECT/OUTSOURCED', '2017-11-30 23:59:36', '2017-12-13 00:08:26', 1),
(5, 'ADMIN OFFICER/HR OFFICER', '2017-12-01 00:04:06', '2017-12-11 23:54:54', 1),
(6, 'OTHER SERVICES', '2017-12-01 00:04:41', '2017-12-01 00:04:41', 1),
(7, 'NONE', '2017-12-01 00:05:04', '2017-12-01 00:05:04', 1);

-- --------------------------------------------------------

--
-- Table structure for table `client_presentations`
--

CREATE TABLE `client_presentations` (
  `id` int(10) UNSIGNED NOT NULL,
  `presentation_mode` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `presentor` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_presented` timestamp NULL DEFAULT NULL,
  `call_slip2` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `client_response2` int(11) NOT NULL,
  `presentation_status` int(11) NOT NULL,
  `follow_up_meeting_date` timestamp NULL DEFAULT NULL,
  `action_plan` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `updated_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `client_responses`
--

CREATE TABLE `client_responses` (
  `id` int(10) UNSIGNED NOT NULL,
  `response_name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `response_type` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_active` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `client_saturations`
--

CREATE TABLE `client_saturations` (
  `id` int(10) UNSIGNED NOT NULL,
  `client_id` int(11) NOT NULL,
  `saturation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `saturation_mode` int(10) UNSIGNED NOT NULL,
  `proposal_by` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `call_slip` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_received` timestamp NULL DEFAULT NULL,
  `proposal_accepted` tinyint(1) NOT NULL,
  `manner_of_confirmation` int(10) UNSIGNED NOT NULL,
  `client_response1` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `ff_calls_made` tinyint(1) NOT NULL,
  `last_ffup_date` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `updated_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `client_sourcing_practices`
--

CREATE TABLE `client_sourcing_practices` (
  `id` int(10) UNSIGNED NOT NULL,
  `client_id` int(10) UNSIGNED NOT NULL,
  `sourcing_practice_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `client_sourcing_practices`
--

INSERT INTO `client_sourcing_practices` (`id`, `client_id`, `sourcing_practice_id`, `created_at`, `updated_at`) VALUES
(3, 2, 4, '2017-12-11 03:06:38', '2017-12-11 03:06:38'),
(4, 3, 5, '2017-12-11 03:32:24', '2017-12-11 03:32:24'),
(5, 4, 5, '2017-12-11 03:54:30', '2017-12-11 03:54:30'),
(6, 6, 1, '2017-12-12 01:18:44', '2017-12-12 01:18:44'),
(7, 7, 1, '2017-12-12 02:02:48', '2017-12-12 02:02:48'),
(8, 8, 1, '2017-12-12 02:13:27', '2017-12-12 02:13:27'),
(9, 10, 1, '2017-12-12 21:38:39', '2017-12-12 21:38:39'),
(16, 1, 2, '2017-12-17 23:18:08', '2017-12-17 23:18:08'),
(23, 24, 4, '2017-12-26 22:45:35', '2017-12-26 22:45:35'),
(24, 25, 6, '2017-12-26 23:34:11', '2017-12-26 23:34:11');

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `id` int(10) UNSIGNED NOT NULL,
  `company_name` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_active` tinyint(4) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `company_name`, `code`, `created_at`, `updated_at`, `is_active`) VALUES
(3, 'Jobskills Training Center Inc', 'JTCI', '2017-10-24 20:08:22', '2017-10-24 20:08:22', 1),
(4, 'Serbisyo Outsourcing Facilities Inc', 'SOFI', '2017-10-24 20:08:22', '2017-10-24 20:08:22', 1),
(5, 'Service Resources Inc', 'SRI', '2017-10-24 20:08:22', '2017-10-24 20:08:22', 1),
(10, 'People Link Staffing Solutions Inc', 'PSSI', '2017-12-15 19:11:55', '2017-12-15 19:11:55', 1);

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int(10) UNSIGNED NOT NULL,
  `department_name` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `department_name`, `created_at`, `updated_at`, `is_active`) VALUES
(1, 'ACCOUNTING / SALES', '2017-11-30 21:31:48', '2017-11-30 21:31:48', 1),
(2, 'ACCOUNTING EXECUTIVE', '2017-11-30 21:32:08', '2017-11-30 21:32:08', 1),
(3, 'ACCOUNTING', '2017-11-30 21:32:22', '2017-11-30 21:32:22', 1),
(4, 'ADMIN & FINANCE', '2017-11-30 22:44:17', '2017-11-30 22:44:17', 1),
(5, 'ADMIN & ACCTG. DEPT.', '2017-11-30 22:45:16', '2017-11-30 22:45:16', 1),
(6, 'APG DIVISION', '2017-11-30 22:45:51', '2017-11-30 22:45:51', 1),
(7, 'HUMAN RESOURCES DEPARTMENT', '2017-12-11 03:29:42', '2017-12-11 03:29:42', 1),
(8, 'N/A', '2017-12-11 03:31:02', '2017-12-11 03:31:02', 1),
(9, 'ASSISTANT DIRECTOR OF SALES', '2017-12-11 23:48:28', '2017-12-11 23:48:28', 1),
(10, 'BUSINESS DEVELOPMENT', '2017-12-11 23:49:18', '2017-12-11 23:49:18', 1),
(11, 'ADMINISTRATION', '2017-12-12 00:06:35', '2017-12-12 00:06:35', 1),
(12, 'FINANCE & ACCOUNTING', '2017-12-15 02:18:18', '2017-12-15 02:18:18', 1),
(13, 'MARKETING DEPARTMENT', '2017-12-18 00:37:57', '2017-12-18 00:37:57', 1);

-- --------------------------------------------------------

--
-- Table structure for table `industries`
--

CREATE TABLE `industries` (
  `id` int(10) UNSIGNED NOT NULL,
  `industry_name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `industries`
--

INSERT INTO `industries` (`id`, `industry_name`, `created_at`, `updated_at`, `is_active`) VALUES
(1, '2ND HAND CAR DEALERSHIP', '2017-11-24 01:35:51', '2017-11-24 01:35:51', 1),
(2, 'ACCOUNTING', '2017-11-24 02:30:28', '2017-11-26 19:29:45', 1),
(3, 'A PRECISION MACHINING COMPANY', '2017-11-26 17:01:52', '2017-11-26 17:01:52', 1),
(5, 'ACCOUNTING SERVICES', '2017-11-26 19:29:38', '2017-11-26 19:29:38', 1),
(6, 'ACCOUNT/AUDIT/TAX SERVICE', '2017-11-26 19:38:32', '2017-11-26 19:38:32', 1),
(7, 'ACRYLIC RESIN SOLUTIONS', '2017-11-26 22:04:07', '2017-11-26 22:04:07', 1),
(8, 'ACRYLIC SHEETS', '2017-11-26 22:08:32', '2017-12-03 23:18:46', 1),
(9, 'INFORMATION TECHNOLOGY', '2017-12-06 19:37:40', '2017-12-06 19:37:40', 1),
(10, 'REAL STATE', '2017-12-11 02:57:51', '2017-12-11 02:57:51', 1),
(11, 'AUTOMOTIVE', '2017-12-11 02:58:14', '2017-12-11 02:58:14', 1),
(12, 'ENGINEERED AND CONSUMER PLASTIC PRODUCTS AND SOLUTIONS', '2017-12-11 02:58:26', '2017-12-11 02:58:26', 1),
(13, 'PACKAGING MATERIALS', '2017-12-11 02:58:44', '2017-12-11 02:58:44', 1),
(14, 'N/A', '2017-12-11 03:30:32', '2017-12-11 03:30:32', 1),
(15, 'COFFEE STORE', '2017-12-11 23:04:15', '2017-12-11 23:04:15', 1),
(16, 'CLOTHING APPAREL', '2017-12-11 23:46:01', '2017-12-11 23:46:01', 1),
(17, 'PRECISION MOLD AND DIE COMPONENTS', '2017-12-12 00:03:41', '2017-12-12 00:03:41', 1),
(18, 'ENGINEERING SERVICES PROVIDER', '2017-12-12 01:14:07', '2017-12-12 01:14:07', 1),
(19, 'PRECISION MECHANICAL DESIGNING AND MANUFACTURING METAL JIGS', '2017-12-12 01:24:35', '2017-12-12 01:24:35', 1),
(20, 'ELECTRONICS', '2017-12-12 01:26:52', '2017-12-12 01:26:52', 1),
(22, 'WIRE CONDENSER', '2017-12-12 02:06:55', '2017-12-12 02:06:55', 1),
(23, 'MANUFACTURING ELECTRONICS', '2017-12-12 21:17:43', '2017-12-12 21:17:53', 1),
(24, 'RETAILING & MARKETING OF AUDIO PRODUCTS', '2017-12-12 21:22:13', '2017-12-12 21:22:13', 1),
(25, 'LOGISTIC', '2017-12-12 21:40:48', '2017-12-12 21:40:48', 1),
(26, 'METAL FABRICATION', '2017-12-12 22:12:03', '2017-12-12 22:12:03', 1),
(27, 'GENERATOR RENTAL', '2017-12-12 22:19:23', '2017-12-12 22:19:23', 1),
(28, 'FACILITIES MANAGEMENT', '2017-12-12 22:28:26', '2017-12-12 22:28:26', 1),
(29, 'TRAVEL AGENCY', '2017-12-12 22:38:30', '2017-12-12 22:38:30', 1),
(30, 'CREDIT AGENCY', '2017-12-12 22:54:37', '2017-12-12 22:54:37', 1),
(31, 'SCHOOL', '2017-12-12 23:03:28', '2017-12-12 23:03:28', 1),
(32, 'MANUFACTURING', '2017-12-12 23:58:16', '2017-12-12 23:58:16', 1),
(33, 'UNIVERSITY', '2017-12-13 00:04:33', '2017-12-13 00:04:33', 1),
(34, 'HOTEL', '2017-12-15 02:17:33', '2017-12-15 02:17:33', 1),
(35, 'DRUG STORE', '2017-12-18 00:32:31', '2017-12-18 00:32:31', 1),
(36, 'PIZZA RESTAURANT', '2017-12-18 00:40:02', '2017-12-18 00:40:02', 1);

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `id` int(10) UNSIGNED NOT NULL,
  `province` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `area` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_active` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `location_areas`
--

CREATE TABLE `location_areas` (
  `id` int(10) UNSIGNED NOT NULL,
  `area_name` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `area_code` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_active` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `manner_of_confirmations`
--

CREATE TABLE `manner_of_confirmations` (
  `id` int(10) UNSIGNED NOT NULL,
  `confirmation_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `manner_of_confirmations`
--

INSERT INTO `manner_of_confirmations` (`id`, `confirmation_name`, `created_at`, `updated_at`) VALUES
(1, 'EMAIL', '2017-12-27 19:04:32', '2017-12-27 19:17:37'),
(2, 'PHONE CALL', '2017-12-27 19:04:49', '2017-12-27 19:04:49'),
(3, 'PERSONAL', '2017-12-27 19:05:08', '2017-12-27 19:05:08');

-- --------------------------------------------------------

--
-- Table structure for table `manpower_providers`
--

CREATE TABLE `manpower_providers` (
  `id` int(10) UNSIGNED NOT NULL,
  `provider_name` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_active` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(8, '2017_09_26_035112_create_social_providers_table', 1),
(9, '2017_10_11_071736_create_user_types_table', 1),
(10, '2017_10_13_061506_add_initial_to_users', 2),
(11, '2017_10_13_063734_create_overall_status_table', 3),
(12, '2017_10_13_064028_create_industry_table', 3),
(13, '2017_10_13_064855_create_location_areas_table', 3),
(14, '2017_10_13_065119_create_locations_table', 4),
(15, '2017_10_13_070517_create_departments_table', 5),
(16, '2017_10_13_070914_create_positions_table', 5),
(17, '2017_10_13_071409_create_companies_table', 5),
(18, '2017_10_13_080142_create_client_reponses_table', 6),
(19, '2017_10_13_080818_create_presentation_statuses_table', 6),
(20, '2017_10_13_084408_create_nationalities_table', 7),
(21, '2017_10_13_090733_create_client_manpower_types_table', 7),
(22, '2017_10_13_091028_create_client_sourcing_practices_table', 7),
(23, '2017_10_13_091407_create_manpower_providers_table', 7),
(24, '2017_10_13_100616_create_action_plans_table', 7),
(25, '2017_10_13_103727_change_reponse_name_type_to_text_', 8),
(26, '2017_10_13_104218_rename_table_client_reponse_to_client_response', 9),
(27, '2017_10_13_104448_rename_client_reponse_name_to_client_response_name', 10),
(28, '2017_10_13_104725_create_clients_table', 11),
(29, '2017_10_13_105440_create_client_saturations_table', 12),
(30, '2017_10_13_110148_create_client_status_table', 13),
(31, '2017_10_13_110327_create_activity_logs_table', 14),
(32, '2017_10_17_093251_add_user_img_field', 15),
(33, '2017_10_20_025337_drop_api_token_column', 16),
(34, '2017_10_25_011949_drop_fax_biding_contract_expiration_columns', 17),
(35, '2017_10_25_012519_remove_calls_part_from_details', 18),
(36, '2017_10_25_013423_create_client_calls_table', 19),
(37, '2017_10_25_014109_rename_client_status_to_client_acquisition', 20),
(38, '2017_11_23_014835_drop_presentation_columns_on_saturation', 21),
(39, '2017_11_23_021602_create_client_presentations_table', 22),
(40, '2017_11_23_024055_add_column_updated_by_to_client_presentations', 23),
(41, '2017_11_23_024454_add_column_updated_by_to_clients', 24),
(42, '2017_11_23_024616_add_column_updated_by_to_client_acquisition', 25),
(43, '2017_11_23_024721_add_column_updated_by_to_client_calls', 26),
(44, '2017_11_23_025035_add_column_updated_by_to_client_saturations', 27),
(45, '2017_11_24_093421_rename_industry_to_industries', 28),
(46, '2017_11_28_005655_create_iso_table', 29),
(47, '2017_11_28_011829_rename_iso_to_certificates', 30),
(48, '2017_11_28_074442_rename_column_area_to_administrative_area_level_1', 31),
(49, '2017_11_28_075021_change_types_of_modified_columns', 32),
(50, '2017_12_02_055813_add_col_is_active_to_users_table', 33),
(51, '2017_12_02_063030_add_col_is_active_to_clients_table', 34),
(52, '2017_12_02_063533_rename_client_sourcing_practices_to_sourcing_practices', 35),
(53, '2017_12_02_064313_create_client_sourcing_practices_table', 36),
(54, '2017_12_04_015628_create_client_manpower_providers_table', 37),
(55, '2017_12_04_022322_change_type_of_iso_certf_to_int', 38),
(56, '2017_12_04_022842_change_province_type_to_text', 39),
(57, '2017_12_11_090443_change_type_of_updated_by_to_text', 40),
(58, '2017_12_15_080546_create_user_views', 41),
(59, '2017_12_15_081719_create_view_user_roles', 42),
(60, '2017_12_15_105856_rename_table_overall_status', 43),
(61, '2017_12_26_053728_rename_client_reponse_to_client_response', 44),
(62, '2017_12_26_074443_add_client_id_column_to_client_calls_table', 45),
(63, '2017_12_27_060911_add_fields_for_first_last_name', 46),
(64, '2017_12_27_103527_create_mode_of_saturations_table', 47),
(65, '2017_12_27_103702_create_manner_of_confirmation_table', 47),
(66, '2017_12_27_104913_rename_manner_of_cofirmation_to_manner_of_confirmations', 48),
(67, '2017_12_27_105242_change_data_types_of_saturation_mode_and_manner_of_confirmation', 49),
(68, '2017_12_28_070517_change_datatype_client_response1', 50);

-- --------------------------------------------------------

--
-- Table structure for table `mode_of_saturations`
--

CREATE TABLE `mode_of_saturations` (
  `id` int(10) UNSIGNED NOT NULL,
  `saturation_mode` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mode_of_saturations`
--

INSERT INTO `mode_of_saturations` (`id`, `saturation_mode`, `created_at`, `updated_at`) VALUES
(1, 'FAX', '2017-12-27 18:58:40', '2017-12-27 19:16:37'),
(2, 'PERSONAL', '2017-12-27 19:05:45', '2017-12-27 19:05:45'),
(3, 'VIA-EMAIL', '2017-12-27 19:05:54', '2017-12-27 19:05:54');

-- --------------------------------------------------------

--
-- Table structure for table `nationalities`
--

CREATE TABLE `nationalities` (
  `id` int(10) UNSIGNED NOT NULL,
  `nationality` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `nationalities`
--

INSERT INTO `nationalities` (`id`, `nationality`, `created_at`, `updated_at`, `is_active`) VALUES
(1, 'American', '2017-11-26 23:04:09', '2017-11-27 01:06:03', 1),
(2, 'Filipino', '2017-11-26 23:46:29', '2017-11-27 01:06:09', 1),
(3, 'Japanese', '2017-11-26 23:46:56', '2017-11-27 01:06:16', 1),
(4, 'Korean', '2017-11-27 01:06:28', '2017-11-27 01:06:28', 1),
(5, 'Singaporean', '2017-11-27 01:06:49', '2017-11-27 01:06:49', 1),
(6, 'American/Canadian/Filipino', '2017-11-27 01:07:38', '2017-11-27 01:07:38', 1),
(7, 'American/Filipino', '2017-11-27 01:14:23', '2017-11-27 01:14:23', 1),
(8, 'Asian', '2017-11-27 01:14:42', '2017-11-27 01:14:51', 1),
(9, 'Australian', '2017-11-27 01:15:01', '2017-11-27 01:15:01', 1),
(10, 'British', '2017-11-27 01:15:17', '2017-11-27 01:15:17', 1),
(11, 'N/A', '2017-12-11 03:30:50', '2017-12-11 03:30:50', 1),
(12, 'FRENCH/ITALIAN', '2017-12-11 23:46:33', '2017-12-11 23:46:33', 1),
(13, 'CHINESE', '2017-12-12 01:55:06', '2017-12-12 01:55:06', 1);

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `client_id` int(11) NOT NULL,
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
  `user_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
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

INSERT INTO `oauth_clients` (`id`, `user_id`, `name`, `secret`, `redirect`, `personal_access_client`, `password_client`, `revoked`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Laravel Personal Access Client', 'lpk6884aZtd4oxEbQgOicDTqL9nN8X5PPTEBmVRu', 'http://localhost', 1, 0, 0, '2017-10-11 00:29:09', '2017-10-11 00:29:09'),
(2, NULL, 'Laravel Password Grant Client', '1LYbKj1Ar1NQi7fdXRq70RJDfeisojklsL1qKVQ0', 'http://localhost', 0, 1, 0, '2017-10-11 00:29:09', '2017-10-11 00:29:09'),
(3, 1, 'sri-loclist', 'GrGVsMex8JXpOrLUlhCr0TQCQrXON3ck9yFUyguK', 'http://127.0.0.1:8000/auth/sri-loclist/callback', 0, 0, 0, '2017-10-11 00:39:11', '2017-10-11 00:39:11');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` int(10) UNSIGNED NOT NULL,
  `client_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_personal_access_clients`
--

INSERT INTO `oauth_personal_access_clients` (`id`, `client_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2017-10-11 00:29:09', '2017-10-11 00:29:09');

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
-- Table structure for table `overall_statuses`
--

CREATE TABLE `overall_statuses` (
  `id` int(10) UNSIGNED NOT NULL,
  `status` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `overall_statuses`
--

INSERT INTO `overall_statuses` (`id`, `status`, `created_at`, `updated_at`, `is_active`) VALUES
(1, 'FOR CONFIRMATION CALL', '2017-12-15 03:46:25', '2017-12-15 03:46:25', 1),
(2, 'FOR SATURATION', '2017-12-15 03:52:02', '2017-12-15 03:52:02', 1),
(3, 'FOR RE-SATURATION', '2017-12-15 04:09:58', '2017-12-15 04:09:58', 1),
(4, 'FOR FOLLOW-UP CALL', '2017-12-15 04:10:26', '2017-12-15 04:10:26', 1),
(5, 'FOR PRESENTATION', '2017-12-15 04:13:18', '2017-12-15 04:13:18', 1);

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
-- Table structure for table `positions`
--

CREATE TABLE `positions` (
  `id` int(10) UNSIGNED NOT NULL,
  `position_name` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_active` tinyint(4) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `positions`
--

INSERT INTO `positions` (`id`, `position_name`, `created_at`, `updated_at`, `is_active`) VALUES
(1, 'ACCOUNT ASSISTANT/ EXECUTIVE DIRECTOR', '2017-11-30 21:33:06', '2017-11-30 21:34:03', 1),
(2, 'ACCOUNT EXECUTIVE', '2017-11-30 21:33:29', '2017-11-30 21:35:42', 1),
(3, 'ACCOUNT MANAGEMENT', '2017-11-30 21:36:09', '2017-11-30 21:36:09', 1),
(4, 'ACCOUNT MANAGER', '2017-11-30 21:36:23', '2017-11-30 21:36:23', 1),
(5, 'ACCOUNT OFFICER', '2017-11-30 22:48:52', '2017-11-30 22:48:52', 1),
(6, 'ACCOUNTANT', '2017-11-30 22:49:08', '2017-11-30 22:49:08', 1),
(7, 'N/A', '2017-12-11 03:31:09', '2017-12-11 03:31:09', 1),
(8, 'HR GENERALIST', '2017-12-11 23:09:05', '2017-12-11 23:09:05', 1),
(9, 'HR MANAGER', '2017-12-11 23:13:50', '2017-12-11 23:13:50', 1),
(10, 'MARKETING MANAGER', '2017-12-11 23:30:43', '2017-12-11 23:30:43', 1),
(11, 'FINANCE DIRECTOR', '2017-12-11 23:33:55', '2017-12-11 23:33:55', 1),
(12, 'PRESIDENT', '2017-12-11 23:49:41', '2017-12-11 23:49:41', 1),
(13, 'GENERAL MANAGER', '2017-12-11 23:50:11', '2017-12-11 23:50:11', 1),
(14, 'ACCOUNTING HEAD', '2017-12-12 02:11:14', '2017-12-12 02:11:14', 1),
(15, 'HR OFFICER', '2017-12-12 21:25:06', '2017-12-12 21:25:06', 1),
(16, 'SENIOR PLANNING MANAGER', '2017-12-12 21:37:15', '2017-12-12 21:37:15', 1),
(17, 'EXECUTIVE ASSISTANT', '2017-12-12 22:25:30', '2017-12-12 22:25:30', 1),
(18, 'HR & DEVELOPMENT MANAGER', '2017-12-12 22:29:06', '2017-12-12 22:29:06', 1),
(19, 'OWNER', '2017-12-12 22:38:56', '2017-12-12 22:38:56', 1),
(20, 'ADMINISTRATOR', '2017-12-12 23:03:53', '2017-12-12 23:03:53', 1),
(21, 'HR SUPERVISOR', '2017-12-12 23:59:03', '2017-12-12 23:59:03', 1),
(22, 'VICE PRESIDENT', '2017-12-13 00:05:05', '2017-12-13 00:05:05', 1),
(23, 'HR HEAD', '2017-12-13 01:43:12', '2017-12-13 01:43:12', 1);

-- --------------------------------------------------------

--
-- Table structure for table `presentation_statuses`
--

CREATE TABLE `presentation_statuses` (
  `id` int(10) UNSIGNED NOT NULL,
  `status` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_active` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `social_providers`
--

CREATE TABLE `social_providers` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `provider_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `provider` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sourcing_practices`
--

CREATE TABLE `sourcing_practices` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sourcing_practices`
--

INSERT INTO `sourcing_practices` (`id`, `name`, `created_at`, `updated_at`, `is_active`) VALUES
(1, 'AGENCY', '2017-11-28 22:06:33', '2017-11-28 22:24:07', 1),
(2, 'AGENCY (COOPERATIVE)', '2017-11-28 22:07:09', '2017-11-28 22:07:09', 1),
(3, 'AGENCY AND COOPERATIVE', '2017-11-28 22:07:20', '2017-11-28 22:07:20', 1),
(4, 'CONFIDENTIAL', '2017-11-28 22:46:42', '2017-11-28 22:46:42', 1),
(5, 'N/A', '2017-12-11 03:04:49', '2017-12-11 03:04:49', 1),
(6, 'DIRECT', '2017-12-11 23:47:34', '2017-12-11 23:47:34', 1),
(7, 'DIRECT / REFERRAL', '2017-12-11 23:47:45', '2017-12-11 23:47:45', 1),
(8, 'AGENCY AND HEADHUNTER', '2017-12-12 02:01:25', '2017-12-12 02:01:25', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `uid` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'This field will come from google id',
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `initial` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `userType` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_img` text COLLATE utf8mb4_unicode_ci,
  `is_active` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `uid`, `name`, `initial`, `email`, `password`, `remember_token`, `userType`, `created_at`, `updated_at`, `user_img`, `is_active`) VALUES
(1, '105811678312470064548', 'Jerick Labasan', 'JPL', 'jerick.labasan@csic.ph', '$2y$10$80HMkWiXNOXWlNTtRX3Eg.mzfqmdFlf8cSWWoON5jjc0RqO/VYgE6', 'zWp1arTFuKaxdFtuRe9LMCUujTD0gnsdm5MWlNUXGwid8vkyZWblE29wgPhh', 1, '2017-10-11 00:30:53', '2017-10-19 19:45:48', 'https://lh4.googleusercontent.com/-YuXQ7UedM6k/AAAAAAAAAAI/AAAAAAAAADs/XGhHkjAv2TE/photo.jpg', 1),
(6, '113421066030730317656', 'Tracy DR. Del Rosario', 'TDR', 'jeck.labasan@gmail.com', '$2y$10$Q2evtaC/IvEqTAr/AT6rX.eLVZHa2DhARVbp6iDoOMpsszWuGxfbe', 'F3Qq8ZyD3xcUlNurfDxOdGNPpaDOo8hLNxTPpU3V4CnOb8iSJ61agKGZFMVf', 3, '2017-10-19 18:56:51', '2017-12-01 23:29:21', 'https://lh6.googleusercontent.com/-AT_PMeylRh4/AAAAAAAAAAI/AAAAAAAAAlc/B4zLW-uHNnY/photo.jpg', 1),
(7, '108785250093796341856', 'Ruth Anne M.  Canicosa', 'RMC', 'ruthanne.canicosa@serviceresourcesinc.com', '$2y$10$4g4XJTvNMUBXnbk5MtI74O8PWHBMIqZU21HsLUpO2SKn5RHeNKS5W', 'Go6Pi8tMJkTdXpSt07itAKq2MGrRjjdAHAXbPQOBVN9iAiQiIUtoRZ5517yB', 3, '2017-10-19 19:04:43', '2017-12-26 22:46:20', 'https://lh4.googleusercontent.com/-L_bSsEF21qg/AAAAAAAAAAI/AAAAAAAABXA/e0xQk4o9XKw/photo.jpg', 1),
(8, NULL, 'Lawrence D. Dumo', 'LDD', 'lawrence.dumo@serviceresourcesinc.com', '$2y$10$YOsRnLorlZhOZeLhPkwgZej7otgS4yVlPN.dPiOmuUyoRxx4eshyC', NULL, 2, '2017-10-19 19:47:25', '2017-10-19 19:47:25', NULL, 1),
(9, '108517074737548034291', 'Gem A. Javier', 'GAJ', 'gem.javier@serviceresourcesinc.com', '$2y$10$f0sid7T//o4tg/rx02wmpuco8Ox8fM8yVhqvN.sEPQE2Vll2PkoAC', 'SBZUb0m6XOjfNrPcoG3SBT9sbM182k4tmIykFismHSJYIA2OQDtjrM8t6G89', 3, '2017-10-19 19:57:51', '2017-12-26 18:22:18', 'https://lh3.googleusercontent.com/-vzPncqr81rY/AAAAAAAAAAI/AAAAAAAAGHA/2ZXUEMxu5jI/photo.jpg', 1),
(11, NULL, 'Sandra Dequilla', 'SD', 'sandra.dequilla@serviceresourcesinc.com', '$2y$10$aWgljcUATUWkkgga7n9KveKOvT49qos1v3LE6hcw19i6wn9XF63BC', NULL, 2, '2017-10-19 22:58:45', '2017-10-19 22:58:45', NULL, 1),
(12, NULL, 'Revin Carl Regio', 'RCR', 'revin.regio@serviceresourcesinc.com', '$2y$10$VyD9IheyUa09CFWFjHCDsuST3T7Hp2PL5J1w8EIvkEbG/PgatoyzK', NULL, 1, '2017-10-22 19:00:48', '2017-10-22 19:00:48', NULL, 1),
(13, NULL, 'Christopher Garcia', 'CG', 'kris.garcia@csic.ph', '$2y$10$SLX3xE4xGhsoaKa36UgncOhk7Gdqpj3hMRm4wUjg85bDZknT3rbGK', NULL, 1, '2017-10-22 19:02:10', '2017-10-22 19:02:10', NULL, 1),
(14, NULL, 'Annette C. Alberto', 'ACA', 'annettte.alberto@serviceresourcesinc.com', '$2y$10$qmJl3fbjnRAr/ESMm4LkTuD0eT8kC/26FsA1NUeGa4crd1DlaHeMm', NULL, 1, '2017-10-23 01:57:12', '2017-10-23 01:57:12', NULL, 1),
(15, NULL, 'Jojie T. Arbolario', 'JTA', 'jojie.arbolario@serviceresourcesinc.com', '$2y$10$GJsMzzkYMHnbMdwr1n.omewIGxOJbWVTy7DjiKBZYMvzblxImod92', NULL, 3, '2017-10-23 18:13:43', '2017-10-23 18:13:43', NULL, 1),
(17, NULL, 'Grecita C. Tulio', 'GCT', 'grecita.tulio@serviceresourcesinc.com', '$2y$10$28aNWbB5MIVYP2f2.z0Gp.hBRng/0Cu0ZR2YdbaElqIOmQbhJt6qu', NULL, 2, '2017-11-26 21:28:38', '2017-12-26 22:55:09', NULL, 1),
(18, NULL, 'Ma. Kristina N. Barza', 'MKNB', 'tina.barza@serviceresourcesinc.com', '$2y$10$bXh6uvdDtpCyDvZYdWClXeeP3RZT9uj3X.1/IrqcISWmQwk.ymyOq', NULL, 5, '2017-12-26 22:52:27', '2017-12-26 22:52:27', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_types`
--

CREATE TABLE `user_types` (
  `id` int(10) UNSIGNED NOT NULL,
  `userType` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_types`
--

INSERT INTO `user_types` (`id`, `userType`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', '2017-10-18 07:25:29', '2017-10-18 07:25:29'),
(2, 'Manager', '2017-10-18 07:25:29', '2017-10-18 07:25:29'),
(3, 'Staff', '2017-10-18 07:25:29', '2017-10-18 07:25:29'),
(5, 'Supervisor', '2017-12-01 19:41:53', '2017-12-01 19:41:53');

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_user_roles`
-- (See below for the actual view)
--
CREATE TABLE `vw_user_roles` (
`id` int(10) unsigned
,`uid` varchar(50)
,`name` varchar(191)
,`initial` varchar(10)
,`email` varchar(191)
,`userType` varchar(30)
,`created_at` timestamp
,`updated_at` timestamp
,`user_img` text
,`is_active` tinyint(4)
);

-- --------------------------------------------------------

--
-- Structure for view `vw_user_roles`
--
DROP TABLE IF EXISTS `vw_user_roles`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_user_roles`  AS  select `u`.`id` AS `id`,`u`.`uid` AS `uid`,`u`.`name` AS `name`,`u`.`initial` AS `initial`,`u`.`email` AS `email`,`t`.`userType` AS `userType`,`u`.`created_at` AS `created_at`,`u`.`updated_at` AS `updated_at`,`u`.`user_img` AS `user_img`,`u`.`is_active` AS `is_active` from (`users` `u` join `user_types` `t` on((`u`.`userType` = `t`.`id`))) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `action_plans`
--
ALTER TABLE `action_plans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `certificates`
--
ALTER TABLE `certificates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `client_acquisition`
--
ALTER TABLE `client_acquisition`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `client_calls`
--
ALTER TABLE `client_calls`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `client_manpower_providers`
--
ALTER TABLE `client_manpower_providers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `client_manpower_types`
--
ALTER TABLE `client_manpower_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `client_presentations`
--
ALTER TABLE `client_presentations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `client_responses`
--
ALTER TABLE `client_responses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `client_saturations`
--
ALTER TABLE `client_saturations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `client_sourcing_practices`
--
ALTER TABLE `client_sourcing_practices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `industries`
--
ALTER TABLE `industries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `location_areas`
--
ALTER TABLE `location_areas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `manner_of_confirmations`
--
ALTER TABLE `manner_of_confirmations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `manpower_providers`
--
ALTER TABLE `manpower_providers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mode_of_saturations`
--
ALTER TABLE `mode_of_saturations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nationalities`
--
ALTER TABLE `nationalities`
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
  ADD PRIMARY KEY (`id`);

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_personal_access_clients_client_id_index` (`client_id`);

--
-- Indexes for table `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`);

--
-- Indexes for table `overall_statuses`
--
ALTER TABLE `overall_statuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `positions`
--
ALTER TABLE `positions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `presentation_statuses`
--
ALTER TABLE `presentation_statuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `social_providers`
--
ALTER TABLE `social_providers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sourcing_practices`
--
ALTER TABLE `sourcing_practices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_uid_unique` (`uid`);

--
-- Indexes for table `user_types`
--
ALTER TABLE `user_types`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `action_plans`
--
ALTER TABLE `action_plans`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `activity_logs`
--
ALTER TABLE `activity_logs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `certificates`
--
ALTER TABLE `certificates`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `client_acquisition`
--
ALTER TABLE `client_acquisition`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `client_calls`
--
ALTER TABLE `client_calls`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `client_manpower_providers`
--
ALTER TABLE `client_manpower_providers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `client_manpower_types`
--
ALTER TABLE `client_manpower_types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `client_presentations`
--
ALTER TABLE `client_presentations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `client_responses`
--
ALTER TABLE `client_responses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `client_saturations`
--
ALTER TABLE `client_saturations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `client_sourcing_practices`
--
ALTER TABLE `client_sourcing_practices`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `industries`
--
ALTER TABLE `industries`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `location_areas`
--
ALTER TABLE `location_areas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `manner_of_confirmations`
--
ALTER TABLE `manner_of_confirmations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `manpower_providers`
--
ALTER TABLE `manpower_providers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;
--
-- AUTO_INCREMENT for table `mode_of_saturations`
--
ALTER TABLE `mode_of_saturations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `nationalities`
--
ALTER TABLE `nationalities`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `overall_statuses`
--
ALTER TABLE `overall_statuses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `positions`
--
ALTER TABLE `positions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `presentation_statuses`
--
ALTER TABLE `presentation_statuses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `social_providers`
--
ALTER TABLE `social_providers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sourcing_practices`
--
ALTER TABLE `sourcing_practices`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `user_types`
--
ALTER TABLE `user_types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
