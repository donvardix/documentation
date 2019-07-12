-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июн 20 2019 г., 16:53
-- Версия сервера: 8.0.15
-- Версия PHP: 7.1.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `registration_php`
--

-- --------------------------------------------------------

--
-- Структура таблицы `countries`
--

CREATE TABLE `countries` (
  `id` int(11) NOT NULL,
  `country` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `countries`
--

INSERT INTO `countries` (`id`, `country`) VALUES
(1, 'Afghanistan'),
(2, 'Åland Islands'),
(3, 'Albania'),
(4, 'Algeria'),
(5, 'American Samoa'),
(6, 'Andorra'),
(7, 'Angola'),
(8, 'Anguilla'),
(9, 'Antarctica'),
(10, 'Antigua & Barbuda'),
(11, 'Argentina'),
(12, 'Armenia'),
(13, 'Aruba'),
(14, 'Ascension Island'),
(15, 'Australia'),
(16, 'Austria'),
(17, 'Azerbaijan'),
(18, 'Bahamas'),
(19, 'Bahrain'),
(20, 'Bangladesh'),
(21, 'Barbados'),
(22, 'Belarus'),
(23, 'Belgium'),
(24, 'Belize'),
(25, 'Benin'),
(26, 'Bermuda'),
(27, 'Bhutan'),
(28, 'Bolivia'),
(29, 'Bosnia & Herzegovina'),
(30, 'Botswana'),
(31, 'Brazil'),
(32, 'British Indian Ocean Territory'),
(33, 'British Virgin Islands'),
(34, 'Brunei'),
(35, 'Bulgaria'),
(36, 'Burkina Faso'),
(37, 'Burundi'),
(38, 'Cambodia'),
(39, 'Cameroon'),
(40, 'Canada'),
(41, 'Canary Islands'),
(42, 'Cape Verde'),
(43, 'Caribbean Netherlands'),
(44, 'Cayman Islands'),
(45, 'Central African Republic'),
(46, 'Ceuta & Melilla'),
(47, 'Chad'),
(48, 'Chile'),
(49, 'China'),
(50, 'Christmas Island'),
(51, 'Cocos (Keeling) Islands'),
(52, 'Colombia'),
(53, 'Comoros'),
(54, 'Congo - Brazzaville'),
(55, 'Congo - Kinshasa'),
(56, 'Cook Islands'),
(57, 'Costa Rica'),
(58, 'Côte d’Ivoire'),
(59, 'Croatia'),
(60, 'Cuba'),
(61, 'Curaçao'),
(62, 'Cyprus'),
(63, 'Czechia'),
(64, 'Denmark'),
(65, 'Diego Garcia'),
(66, 'Djibouti'),
(67, 'Dominica'),
(68, 'Dominican Republic'),
(69, 'Ecuador'),
(70, 'Egypt'),
(71, 'El Salvador'),
(72, 'Equatorial Guinea'),
(73, 'Eritrea'),
(74, 'Estonia'),
(75, 'Eswatini'),
(76, 'Ethiopia'),
(77, 'Falkland Islands'),
(78, 'Faroe Islands'),
(79, 'Fiji'),
(80, 'Finland'),
(81, 'France'),
(82, 'French Guiana'),
(83, 'French Polynesia'),
(84, 'French Southern Territories'),
(85, 'Gabon'),
(86, 'Gambia'),
(87, 'Georgia'),
(88, 'Germany'),
(89, 'Ghana'),
(90, 'Gibraltar'),
(91, 'Greece'),
(92, 'Greenland'),
(93, 'Grenada'),
(94, 'Guadeloupe'),
(95, 'Guam'),
(96, 'Guatemala'),
(97, 'Guernsey'),
(98, 'Guinea'),
(99, 'Guinea-Bissau'),
(100, 'Guyana'),
(101, 'Haiti'),
(102, 'Honduras'),
(103, 'Hong Kong SAR China'),
(104, 'Hungary'),
(105, 'Iceland'),
(106, 'India'),
(107, 'Indonesia'),
(108, 'Iran'),
(109, 'Iraq'),
(110, 'Ireland'),
(111, 'Isle of Man'),
(112, 'Israel'),
(113, 'Italy'),
(114, 'Jamaica'),
(115, 'Japan'),
(116, 'Jersey'),
(117, 'Jordan'),
(118, 'Kazakhstan'),
(119, 'Kenya'),
(120, 'Kiribati'),
(121, 'Kosovo'),
(122, 'Kuwait'),
(123, 'Kyrgyzstan'),
(124, 'Laos'),
(125, 'Latvia'),
(126, 'Lebanon'),
(127, 'Lesotho'),
(128, 'Liberia'),
(129, 'Libya'),
(130, 'Liechtenstein'),
(131, 'Lithuania'),
(132, 'Luxembourg'),
(133, 'Macao SAR China'),
(134, 'Madagascar'),
(135, 'Malawi'),
(136, 'Malaysia'),
(137, 'Maldives'),
(138, 'Mali'),
(139, 'Malta'),
(140, 'Marshall Islands'),
(141, 'Martinique'),
(142, 'Mauritania'),
(143, 'Mauritius'),
(144, 'Mayotte'),
(145, 'Mexico'),
(146, 'Micronesia'),
(147, 'Moldova'),
(148, 'Monaco'),
(149, 'Mongolia'),
(150, 'Montenegro'),
(151, 'Montserrat'),
(152, 'Morocco'),
(153, 'Mozambique'),
(154, 'Myanmar (Burma)'),
(155, 'Namibia'),
(156, 'Nauru'),
(157, 'Nepal'),
(158, 'Netherlands'),
(159, 'New Caledonia'),
(160, 'New Zealand'),
(161, 'Nicaragua'),
(162, 'Niger'),
(163, 'Nigeria'),
(164, 'Niue'),
(165, 'Norfolk Island'),
(166, 'North Korea'),
(167, 'North Macedonia'),
(168, 'Northern Mariana Islands'),
(169, 'Norway'),
(170, 'Oman'),
(171, 'Pakistan'),
(172, 'Palau'),
(173, 'Palestinian Territories'),
(174, 'Panama'),
(175, 'Papua New Guinea'),
(176, 'Paraguay'),
(177, 'Peru'),
(178, 'Philippines'),
(179, 'Pitcairn Islands'),
(180, 'Poland'),
(181, 'Portugal'),
(182, 'Pseudo-Accents'),
(183, 'Pseudo-Bidi'),
(184, 'Puerto Rico'),
(185, 'Qatar'),
(186, 'Réunion'),
(187, 'Romania'),
(188, 'Russia'),
(189, 'Rwanda'),
(190, 'Samoa'),
(191, 'San Marino'),
(192, 'São Tomé & Príncipe'),
(193, 'Saudi Arabia'),
(194, 'Senegal'),
(195, 'Serbia'),
(196, 'Seychelles'),
(197, 'Sierra Leone'),
(198, 'Singapore'),
(199, 'Sint Maarten'),
(200, 'Slovakia'),
(201, 'Slovenia'),
(202, 'Solomon Islands'),
(203, 'Somalia'),
(204, 'South Africa'),
(205, 'South Georgia & South Sandwich Islands'),
(206, 'South Korea'),
(207, 'South Sudan'),
(208, 'Spain'),
(209, 'Sri Lanka'),
(210, 'St. Barthélemy'),
(211, 'St. Helena'),
(212, 'St. Kitts & Nevis'),
(213, 'St. Lucia'),
(214, 'St. Martin'),
(215, 'St. Pierre & Miquelon'),
(216, 'St. Vincent & Grenadines'),
(217, 'Sudan'),
(218, 'Suriname'),
(219, 'Svalbard & Jan Mayen'),
(220, 'Sweden'),
(221, 'Switzerland'),
(222, 'Syria'),
(223, 'Taiwan'),
(224, 'Tajikistan'),
(225, 'Tanzania'),
(226, 'Thailand'),
(227, 'Timor-Leste'),
(228, 'Togo'),
(229, 'Tokelau'),
(230, 'Tonga'),
(231, 'Trinidad & Tobago'),
(232, 'Tristan da Cunha'),
(233, 'Tunisia'),
(234, 'Turkey'),
(235, 'Turkmenistan'),
(236, 'Turks & Caicos Islands'),
(237, 'Tuvalu'),
(238, 'U.S. Outlying Islands'),
(239, 'U.S. Virgin Islands'),
(240, 'Uganda'),
(241, 'Ukraine'),
(242, 'United Arab Emirates'),
(243, 'United Kingdom'),
(244, 'United States'),
(245, 'Uruguay'),
(246, 'Uzbekistan'),
(247, 'Vanuatu'),
(248, 'Vatican City'),
(249, 'Venezuela'),
(250, 'Vietnam'),
(251, 'Wallis & Futuna'),
(252, 'Western Sahara'),
(253, 'Yemen'),
(254, 'Zambia'),
(255, 'Zimbabwe');

-- --------------------------------------------------------

--
-- Структура таблицы `members`
--

CREATE TABLE `members` (
  `id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `birthdate` date NOT NULL,
  `reportsubject` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `company` varchar(255) DEFAULT NULL,
  `position` varchar(255) DEFAULT NULL,
  `aboutme` text CHARACTER SET utf8 COLLATE utf8_general_ci,
  `photo` varchar(255) DEFAULT '/resources/images/default.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email_unic` (`email`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=256;

--
-- AUTO_INCREMENT для таблицы `members`
--
ALTER TABLE `members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
