-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 04, 2020 at 01:04 PM
-- Server version: 10.3.23-MariaDB-0+deb10u1
-- PHP Version: 7.2.33-1+0~20200807.47+debian10~1.gbpcb3068

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bisuvsc5_0`
--

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` int(11) NOT NULL,
  `name` varchar(70) NOT NULL DEFAULT '',
  `nome` varchar(70) DEFAULT NULL,
  `iso2` char(2) NOT NULL DEFAULT '',
  `iso3` char(3) NOT NULL,
  `phone_code` int(7) NOT NULL,
  `is_eu` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `name`, `nome`, `iso2`, `iso3`, `phone_code`, `is_eu`) VALUES
(1, 'Andorra', 'Andorra', 'AD', 'AND', 376, 0),
(2, 'United Arab Emirates', 'Emirati Arabi Uniti', 'AE', 'ARE', 971, 0),
(3, 'Afghanistan', 'Afghanistan', 'AF', 'AFG', 93, 0),
(4, 'Antigua and Barbuda', 'Antigua e Barbuda', 'AG', 'ATG', 1268, 0),
(5, 'Anguilla', 'Anguilla', 'AI', 'AIA', 1264, 0),
(6, 'Albania', 'Albania', 'AL', 'ALB', 355, 0),
(7, 'Armenia', 'Armenia', 'AM', 'ARM', 374, 0),
(8, 'Angola', 'Angola', 'AO', 'AGO', 244, 0),
(9, 'Antarctica', NULL, 'AQ', 'ATA', 672, 0),
(10, 'Argentina', 'Argentina', 'AR', 'ARG', 54, 0),
(11, 'American Samoa', 'Samoa Americane', 'AS', 'ASM', 1684, 0),
(12, 'Austria', 'Austria', 'AT', 'AUT', 43, 1),
(13, 'Australia', 'Australia', 'AU', 'AUS', 61, 0),
(14, 'Aruba', 'Aruba', 'AW', 'ABW', 297, 0),
(15, 'Åland Islands', NULL, 'AX', 'ALA', 0, 0),
(16, 'Azerbaijan', 'Azerbaigian', 'AZ', 'AZE', 994, 0),
(17, 'Bosnia and Herzegovina', 'Bosnia ed Erzegovina', 'BA', 'BIH', 387, 0),
(18, 'Barbados', 'Barbados', 'BB', 'BRB', 1246, 0),
(19, 'Bangladesh', 'Bangladesh', 'BD', 'BGD', 880, 0),
(20, 'Belgium', 'Belgio', 'BE', 'BEL', 32, 1),
(21, 'Burkina Faso', 'Burkina Faso', 'BF', 'BFA', 226, 0),
(22, 'Bulgaria', 'Bulgaria', 'BG', 'BGR', 359, 1),
(23, 'Bahrain', 'Bahrain', 'BH', 'BHR', 973, 0),
(24, 'Burundi', 'Burundi', 'BI', 'BDI', 257, 0),
(25, 'Benin', 'Benin', 'BJ', 'BEN', 229, 0),
(26, 'Saint Barthélemy', 'Saint-Barth?lemy', 'BL', 'BLM', 0, 0),
(27, 'Bermuda', 'Bermuda', 'BM', 'BMU', 1441, 0),
(28, 'Brunei Darussalam', 'Brunei', 'BN', 'BRN', 673, 0),
(29, 'Bolivia', 'Bolivia', 'BO', 'BOL', 591, 0),
(30, 'Bonaire, Sint Eustatius and Saba', 'Sint Eustatius', 'BQ', 'BES', 0, 0),
(31, 'Brazil', 'Brasile', 'BR', 'BRA', 55, 0),
(32, 'Bahamas', 'Bahamas', 'BS', 'BHS', 1242, 0),
(33, 'Bhutan', 'Bhutan', 'BT', 'BTN', 975, 0),
(34, 'Bouvet Island', NULL, 'BV', 'BVT', 44, 0),
(35, 'Botswana', 'Botswana', 'BW', 'BWA', 267, 0),
(36, 'Belarus', 'Bielorussia', 'BY', 'BLR', 375, 0),
(37, 'Belize', 'Belize', 'BZ', 'BLZ', 501, 0),
(38, 'Canada', 'Canada', 'CA', 'CAN', 1, 0),
(39, 'Cocos (Keeling) Islands', 'Isole Cocos e Keeling', 'CC', 'CCK', 61, 0),
(40, 'Congo (Democratic Republic of the)', 'Repubblica Democratica del Congo', 'CD', 'COD', 243, 0),
(41, 'Central African Republic', 'Repubblica Centrafricana', 'CF', 'CAF', 236, 0),
(42, 'Congo', 'Repubblica del Congo', 'CG', 'COG', 242, 0),
(43, 'Switzerland', 'Svizzera', 'CH', 'CHE', 41, 0),
(44, 'Ivory Coast', 'Costa d\'Avorio', 'CI', 'CIV', 225, 0),
(45, 'Cook Islands', 'Isole Cook', 'CK', 'COK', 682, 0),
(46, 'Chile', 'Cile', 'CL', 'CHL', 56, 0),
(47, 'Cameroon', 'Camerun', 'CM', 'CMR', 237, 0),
(48, 'China', 'Cina', 'CN', 'CHN', 86, 0),
(49, 'Colombia', 'Colombia', 'CO', 'COL', 57, 0),
(50, 'Costa Rica', 'Costa Rica', 'CR', 'CRI', 506, 0),
(51, 'Cuba', 'Cuba', 'CU', 'CUB', 53, 0),
(52, 'Cape Verde', 'Capo Verde', 'CV', 'CPV', 238, 0),
(53, 'Curaçao', 'Cura?ao', 'CW', 'CUW', 0, 0),
(54, 'Christmas Island', 'Isola del Natale', 'CX', 'CXR', 61, 0),
(55, 'Cyprus', 'Cipro', 'CY', 'CYP', 357, 1),
(56, 'Czech Republic', 'Repubblica Ceca', 'CZ', 'CZE', 420, 1),
(57, 'Germany', 'Germania', 'DE', 'DEU', 49, 1),
(58, 'Djibouti', 'Gibuti', 'DJ', 'DJI', 253, 0),
(59, 'Denmark', 'Danimarca', 'DK', 'DNK', 45, 1),
(60, 'Dominica', 'Dominica', 'DM', 'DMA', 1767, 0),
(61, 'Dominican Republic', 'Repubblica Dominicana', 'DO', 'DOM', 1809, 0),
(62, 'Algeria', 'Algeria', 'DZ', 'DZA', 213, 0),
(63, 'Ecuador', 'Ecuador', 'EC', 'ECU', 593, 0),
(64, 'Estonia', 'Estonia', 'EE', 'EST', 372, 1),
(65, 'Egypt', 'Egitto', 'EG', 'EGY', 20, 0),
(66, 'Western Sahara', NULL, 'EH', 'ESH', 0, 0),
(67, 'Eritrea', 'Eritrea', 'ER', 'ERI', 291, 0),
(68, 'Spain', 'Spagna', 'ES', 'ESP', 34, 1),
(69, 'Ethiopia', 'Etiopia', 'ET', 'ETH', 251, 0),
(70, 'Finland', 'Finlandia', 'FI', 'FIN', 358, 1),
(71, 'Fiji', 'Figi', 'FJ', 'FJI', 679, 0),
(72, 'Falkland Islands (Malvinas)', 'Isole Falkland', 'FK', 'FLK', 500, 0),
(73, 'Micronesia (Federated States of)', 'Stati Federati di Micronesia', 'FM', 'FSM', 691, 0),
(74, 'Faroe Islands', NULL, 'FO', 'FRO', 298, 0),
(75, 'France', 'Francia', 'FR', 'FRA', 33, 1),
(76, 'Gabon', 'Gabon', 'GA', 'GAB', 241, 0),
(77, 'United Kingdom', 'Regno Unito', 'GB', 'GBR', 44, 1),
(78, 'Grenada', 'Grenada', 'GD', 'GRD', 1473, 0),
(79, 'Georgia', 'Georgia', 'GE', 'GEO', 995, 0),
(80, 'French Guiana', 'Guyana francese', 'GF', 'GUF', 594, 0),
(81, 'Guernsey', NULL, 'GG', 'GGY', 0, 0),
(82, 'Ghana', 'Ghana', 'GH', 'GHA', 233, 0),
(83, 'Gibraltar', 'Gibilterra', 'GI', 'GIB', 350, 0),
(84, 'Greenland', 'Groenlandia', 'GL', 'GRL', 299, 0),
(85, 'Gambia', 'Gambia', 'GM', 'GMB', 220, 0),
(86, 'Guinea', 'Guinea', 'GN', 'GIN', 224, 0),
(87, 'Guadeloupe', 'Guadalupa', 'GP', 'GLP', 590, 0),
(88, 'Equatorial Guinea', 'Guinea Equatoriale', 'GQ', 'GNQ', 240, 0),
(89, 'Greece', 'Grecia', 'GR', 'GRC', 30, 1),
(90, 'South Georgia and the South Sandwich Islands', 'Georgia del Sud e Isole Sandwich Meridionali', 'GS', 'SGS', 44, 0),
(91, 'Guatemala', 'Guatemala', 'GT', 'GTM', 502, 0),
(92, 'Guam', 'Guam', 'GU', 'GUM', 1671, 0),
(93, 'Guinea-Bissau', 'Guinea-Bissau', 'GW', 'GNB', 245, 0),
(94, 'Guyana', 'Guyana', 'GY', 'GUY', 592, 0),
(95, 'Hong Kong', 'Hong Kong', 'HK', 'HKG', 852, 0),
(96, 'Heard Island and McDonald Islands', NULL, 'HM', 'HMD', 44, 0),
(97, 'Honduras', 'Honduras', 'HN', 'HND', 504, 0),
(98, 'Croatia (Hrvatska)', 'Croazia', 'HR', 'HRV', 385, 1),
(99, 'Haiti', 'Haiti', 'HT', 'HTI', 509, 0),
(100, 'Hungary', 'Ungheria', 'HU', 'HUN', 36, 1),
(101, 'Indonesia', 'Indonesia', 'ID', 'IDN', 62, 0),
(102, 'Ireland', 'Irlanda', 'IE', 'IRL', 353, 1),
(103, 'Israel', 'Israele', 'IL', 'ISR', 972, 0),
(104, 'Isle of Man', NULL, 'IM', 'IMN', 0, 0),
(105, 'India', 'India', 'IN', 'IND', 91, 0),
(106, 'British Indian Ocean Territory', NULL, 'IO', 'IOT', 0, 0),
(107, 'Iraq', 'Iraq', 'IQ', 'IRQ', 964, 0),
(108, 'Iran (Islamic Republic of)', 'Iran', 'IR', 'IRN', 98, 0),
(109, 'Iceland', 'Islanda', 'IS', 'ISL', 354, 0),
(110, 'Italy', 'Italia', 'IT', 'ITA', 39, 1),
(111, 'Jersey', NULL, 'JE', 'JEY', 0, 1),
(112, 'Jamaica', 'Giamaica', 'JM', 'JAM', 1876, 0),
(113, 'Jordan', 'Giordania', 'JO', 'JOR', 962, 0),
(114, 'Japan', 'Giappone', 'JP', 'JPN', 81, 0),
(115, 'Kenya', 'Kenya', 'KE', 'KEN', 254, 0),
(116, 'Kyrgyzstan', 'Kirghizistan', 'KG', 'KGZ', 996, 0),
(117, 'Cambodia', 'Cambogia', 'KH', 'KHM', 855, 0),
(118, 'Kiribati', 'Kiribati', 'KI', 'KIR', 686, 0),
(119, 'Comoros', 'Comore', 'KM', 'COM', 269, 0),
(120, 'Saint Kitts and Nevis', 'Saint Kitts e Nevis', 'KN', 'KNA', 1869, 0),
(121, 'Korea (Democratic People\'s Republic of)', 'Corea del Nord', 'KP', 'PRK', 850, 0),
(122, 'Korea (Republic of)', 'Corea del Sud', 'KR', 'KOR', 82, 0),
(123, 'Kuwait', 'Kuwait', 'KW', 'KWT', 965, 0),
(124, 'Cayman Islands', 'Isole Cayman', 'KY', 'CYM', 1345, 0),
(125, 'Kazakhstan', 'Kazakistan', 'KZ', 'KAZ', 7, 0),
(126, 'Lao People\'s Democratic Republic', 'Laos', 'LA', 'LAO', 856, 0),
(127, 'Lebanon', 'Libano', 'LB', 'LBN', 961, 0),
(128, 'Saint Lucia', 'Santa Lucia', 'LC', 'LCA', 1758, 0),
(129, 'Liechtenstein', 'Liechtenstein', 'LI', 'LIE', 423, 0),
(130, 'Sri Lanka', 'Sri Lanka', 'LK', 'LKA', 94, 0),
(131, 'Liberia', 'Liberia', 'LR', 'LBR', 231, 0),
(132, 'Lesotho', 'Lesotho', 'LS', 'LSO', 266, 0),
(133, 'Lithuania', 'Lituania', 'LT', 'LTU', 370, 1),
(134, 'Luxembourg', 'Lussemburgo', 'LU', 'LUX', 352, 1),
(135, 'Latvia', 'Lettonia', 'LV', 'LVA', 371, 1),
(136, 'Libya', 'Libia', 'LY', 'LBY', 218, 0),
(137, 'Morocco', 'Marocco', 'MA', 'MAR', 212, 0),
(138, 'Monaco', 'Principato di Monaco', 'MC', 'MCO', 377, 0),
(139, 'Moldova (Republic of)', 'Moldavia', 'MD', 'MDA', 373, 0),
(140, 'Montenegro', 'Montenegro', 'ME', 'MNE', 382, 0),
(141, 'Saint Martin (French part)', 'Saint-Martin', 'MF', 'MAF', 0, 0),
(142, 'Madagascar', 'Madagascar', 'MG', 'MDG', 261, 0),
(143, 'Marshall Islands', 'Isole Marshall', 'MH', 'MHL', 692, 0),
(144, 'Macedonia', 'Macedonia', 'MK', 'MKD', 389, 0),
(145, 'Mali', 'Mali', 'ML', 'MLI', 223, 0),
(146, 'Myanmar', 'Birmania', 'MM', 'MMR', 95, 0),
(147, 'Mongolia', 'Mongolia', 'MN', 'MNG', 976, 0),
(148, 'Macau', 'Macao', 'MO', 'MAC', 853, 0),
(149, 'Northern Mariana Islands', 'Isole Marianne Settentrionali', 'MP', 'MNP', 1670, 0),
(150, 'Martinique', 'Martinica', 'MQ', 'MTQ', 596, 0),
(151, 'Mauritania', 'Mauritania', 'MR', 'MRT', 222, 0),
(152, 'Montserrat', 'Montserrat', 'MS', 'MSR', 1664, 0),
(153, 'Malta', 'Malta', 'MT', 'MLT', 356, 1),
(154, 'Mauritius', 'Mauritius', 'MU', 'MUS', 230, 0),
(155, 'Maldives', 'Maldive', 'MV', 'MDV', 960, 0),
(156, 'Malawi', 'Malawi', 'MW', 'MWI', 265, 0),
(157, 'Mexico', 'Messico', 'MX', 'MEX', 52, 0),
(158, 'Malaysia', 'Malesia', 'MY', 'MYS', 60, 0),
(159, 'Mozambique', 'Mozambico', 'MZ', 'MOZ', 258, 0),
(160, 'Namibia', 'Namibia', 'NA', 'NAM', 264, 0),
(161, 'New Caledonia', 'Nuova Caledonia', 'NC', 'NCL', 687, 0),
(162, 'Niger', 'Niger', 'NE', 'NER', 227, 0),
(163, 'Norfolk Island', 'Isola Norfolk', 'NF', 'NFK', 672, 0),
(164, 'Nigeria', 'Nigeria', 'NG', 'NGA', 234, 0),
(165, 'Nicaragua', 'Nicaragua', 'NI', 'NIC', 505, 0),
(166, 'Netherlands', 'Paesi Bassi', 'NL', 'NLD', 31, 1),
(167, 'Norway', 'Norvegia', 'NO', 'NOR', 47, 0),
(168, 'Nepal', 'Nepal', 'NP', 'NPL', 977, 0),
(169, 'Nauru', 'Nauru', 'NR', 'NRU', 674, 0),
(170, 'Niue', 'Niue', 'NU', 'NIU', 683, 0),
(171, 'New Zealand', 'Nuova Zelanda', 'NZ', 'NZL', 64, 0),
(172, 'Oman', 'Oman', 'OM', 'OMN', 968, 0),
(173, 'Panama', 'Panama', 'PA', 'PAN', 507, 0),
(174, 'Peru', 'Per?', 'PE', 'PER', 51, 0),
(175, 'French Polynesia', 'Polinesia Francese', 'PF', 'PYF', 689, 0),
(176, 'Papua New Guinea', 'Papua Nuova Guinea', 'PG', 'PNG', 675, 0),
(177, 'Philippines', 'Filippine', 'PH', 'PHL', 63, 0),
(178, 'Pakistan', 'Pakistan', 'PK', 'PAK', 92, 0),
(179, 'Poland', 'Polonia', 'PL', 'POL', 48, 1),
(180, 'Saint Pierre and Miquelon', 'Saint-Pierre e Miquelon', 'PM', 'SPM', 508, 0),
(181, 'Pitcairn', 'Isole Pitcairn', 'PN', 'PCN', 870, 0),
(182, 'Puerto Rico', 'Porto Rico', 'PR', 'PRI', 1, 0),
(183, 'Palestine, State of', 'Palestina', 'PS', 'PSE', 0, 0),
(184, 'Portugal', 'Portogallo', 'PT', 'PRT', 351, 1),
(185, 'Palau', 'Palau', 'PW', 'PLW', 680, 0),
(186, 'Paraguay', 'Paraguay', 'PY', 'PRY', 595, 0),
(187, 'Qatar', 'Qatar', 'QA', 'QAT', 974, 0),
(188, 'Reunion', 'Riunione', 'RE', 'REU', 262, 0),
(189, 'Romania', 'Romania', 'RO', 'ROU', 40, 1),
(190, 'Serbia', 'Serbia', 'RS', 'SRB', 381, 0),
(191, 'Russian Federation', 'Russia', 'RU', 'RUS', 7, 0),
(192, 'Rwanda', 'Ruanda', 'RW', 'RWA', 250, 0),
(193, 'Saudi Arabia', 'Arabia Saudita', 'SA', 'SAU', 966, 0),
(194, 'Solomon Islands', 'Isole Salomone', 'SB', 'SLB', 677, 0),
(195, 'Seychelles', 'Seychelles', 'SC', 'SYC', 248, 0),
(196, 'Sudan', 'Sudan', 'SD', 'SDN', 249, 0),
(197, 'Sweden', 'Svezia', 'SE', 'SWE', 46, 1),
(198, 'Singapore', 'Singapore', 'SG', 'SGP', 65, 0),
(199, 'Saint Helena, Ascension and Tristan da Cunha', 'Sant\'Elena, Ascensione e Tristan da Cunha', 'SH', 'SHN', 290, 0),
(200, 'Slovenia', 'Slovenia', 'SI', 'SVN', 386, 1),
(201, 'Svalbard and Jan Mayen', NULL, 'SJ', 'SJM', 0, 0),
(202, 'Slovakia', 'Slovacchia', 'SK', 'SVK', 421, 1),
(203, 'Sierra Leone', 'Sierra Leone', 'SL', 'SLE', 232, 0),
(204, 'San Marino', 'San Marino', 'SM', 'SMR', 378, 0),
(205, 'Senegal', 'Senegal', 'SN', 'SEN', 221, 0),
(206, 'Somalia', 'Somalia', 'SO', 'SOM', 252, 0),
(207, 'Suriname', 'Suriname', 'SR', 'SUR', 597, 0),
(208, 'South Sudan', 'Sudan del Sud', 'SS', 'SSD', 0, 0),
(209, 'Sao Tome and Principe', 'S?o Tom? e Pr?ncipe', 'ST', 'STP', 239, 0),
(210, 'El Salvador', 'El Salvador', 'SV', 'SLV', 503, 0),
(211, 'Sint Maarten (Dutch part)', 'Sint Maarten', 'SX', 'SXM', 0, 0),
(212, 'Syrian Arab Republic', 'Siria', 'SY', 'SYR', 963, 0),
(213, 'Swaziland', 'Swaziland', 'SZ', 'SWZ', 268, 0),
(214, 'Turks and Caicos Islands', 'Turks e Caicos', 'TC', 'TCA', 1649, 0),
(215, 'Chad', 'Ciad', 'TD', 'TCD', 235, 0),
(216, 'French Southern Territories', 'Isole sparse nell\'Oceano Indiano', 'TF', 'ATF', 44, 0),
(217, 'Togo', 'Togo', 'TG', 'TGO', 228, 0),
(218, 'Thailand', 'Thailandia', 'TH', 'THA', 66, 0),
(219, 'Tajikistan', 'Tagikistan', 'TJ', 'TJK', 992, 0),
(220, 'Tokelau', 'Tokelau', 'TK', 'TKL', 690, 0),
(221, 'Timor-Leste', 'Timor Est', 'TL', 'TLS', 670, 0),
(222, 'Turkmenistan', 'Turkmenistan', 'TM', 'TKM', 993, 0),
(223, 'Tunisia', 'Tunisia', 'TN', 'TUN', 216, 0),
(224, 'Tonga', 'Tonga', 'TO', 'TON', 676, 0),
(225, 'Turkey', 'Turchia', 'TR', 'TUR', 90, 0),
(226, 'Trinidad and Tobago', 'Trinidad e Tobago', 'TT', 'TTO', 1868, 0),
(227, 'Tuvalu', 'Tuvalu', 'TV', 'TUV', 688, 0),
(228, 'Taiwan', 'Taiwan', 'TW', 'TWN', 886, 0),
(229, 'Tanzania, United Republic of', 'Tanzania', 'TZ', 'TZA', 255, 0),
(230, 'Ukraine', 'Ucraina', 'UA', 'UKR', 380, 0),
(231, 'Uganda', 'Uganda', 'UG', 'UGA', 256, 0),
(232, 'United States Minor Outlying Islands', NULL, 'UM', 'UMI', 44, 0),
(233, 'United States of America', 'Stati Uniti', 'US', 'USA', 1, 0),
(234, 'Uruguay', 'Uruguay', 'UY', 'URY', 598, 0),
(235, 'Uzbekistan', 'Uzbekistan', 'UZ', 'UZB', 998, 0),
(236, 'Vatican City State', 'Citt? del Vaticano', 'VA', 'VAT', 39, 0),
(237, 'Saint Vincent and the Grenadines', 'Saint Vincent e Grenadine', 'VC', 'VCT', 1784, 0),
(238, 'Venezuela', 'Venezuela', 'VE', 'VEN', 58, 0),
(239, 'Virgin Islands (British)', 'Isole Vergini Britanniche', 'VG', 'VGB', 1284, 0),
(240, 'Virgin Islands (U.S.)', 'Isole Vergini Americane', 'VI', 'VIR', 1340, 0),
(241, 'Viet Nam', 'Vietnam', 'VN', 'VNM', 84, 0),
(242, 'Vanuatu', 'Vanuatu', 'VU', 'VUT', 678, 0),
(243, 'Wallis and Futuna', 'Wallis e Futuna', 'WF', 'WLF', 681, 0),
(244, 'Samoa', 'Samoa', 'WS', 'WSM', 685, 0),
(245, 'Yemen', 'Yemen', 'YE', 'YEM', 967, 0),
(246, 'Mayotte', 'Mayotte', 'YT', 'MYT', 262, 0),
(247, 'South Africa', 'Sudafrica', 'ZA', 'ZAF', 27, 0),
(248, 'Zambia', 'Zambia', 'ZM', 'ZMB', 260, 0),
(249, 'Zimbabwe', 'Zimbabwe', 'ZW', 'ZWE', 263, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `iso2` (`iso2`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=250;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
