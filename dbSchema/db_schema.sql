-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 24, 2015 at 12:36 AM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `currency_fair`
--

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

DROP TABLE IF EXISTS `countries`;
CREATE TABLE IF NOT EXISTS `countries` (
  `code` varchar(5) NOT NULL DEFAULT '',
  `country` varchar(45) DEFAULT NULL,
  `capital` varchar(45) DEFAULT NULL,
  `lat` decimal(9,6) DEFAULT NULL,
  `lng` decimal(9,6) DEFAULT NULL,
  `continent` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`code`, `country`, `capital`, `lat`, `lng`, `continent`) VALUES
('AD', 'Andorra', 'Andorra la Vella', '42.500000', '1.516667', 'Europe'),
('AE', 'United Arab Emirates', 'Abu Dhabi', '24.466667', '54.366667', 'Asia'),
('AF', 'Afghanistan', 'Kabul', '34.516667', '69.183333', 'Asia'),
('AG', 'Antigua and Barbuda', 'Saint John?s', '17.116667', '-61.850000', 'North America'),
('AI', 'Anguilla', 'The Valley', '18.216667', '-63.050000', 'North America'),
('AL', 'Albania', 'Tirana', '41.316667', '19.816667', 'Europe'),
('AM', 'Armenia', 'Yerevan', '40.166667', '44.500000', 'Europe'),
('AO', 'Angola', 'Luanda', '-8.833333', '13.216667', 'Africa'),
('AQ', 'Antarctica', 'N/A', '0.000000', '0.000000', 'Antarctica'),
('AR', 'Argentina', 'Buenos Aires', '-34.583333', '-58.666667', 'South America'),
('AS', 'American Samoa', 'Pago Pago', '-14.266667', '-170.700000', 'Australia'),
('AT', 'Austria', 'Vienna', '48.200000', '16.366667', 'Europe'),
('AU', 'Australia', 'Canberra', '-35.266667', '149.133333', 'Australia'),
('AW', 'Aruba', 'Oranjestad', '12.516667', '-70.033333', 'North America'),
('AX', 'Aland Islands', 'Mariehamn', '60.116667', '19.900000', 'Europe'),
('AZ', 'Azerbaijan', 'Baku', '40.383333', '49.866667', 'Europe'),
('BA', 'Bosnia and Herzegovina', 'Sarajevo', '43.866667', '18.416667', 'Europe'),
('BB', 'Barbados', 'Bridgetown', '13.100000', '-59.616667', 'North America'),
('BD', 'Bangladesh', 'Dhaka', '23.716667', '90.400000', 'Asia'),
('BE', 'Belgium', 'Brussels', '50.833333', '4.333333', 'Europe'),
('BF', 'Burkina Faso', 'Ouagadougou', '12.366667', '-1.516667', 'Africa'),
('BG', 'Bulgaria', 'Sofia', '42.683333', '23.316667', 'Europe'),
('BH', 'Bahrain', 'Manama', '26.233333', '50.566667', 'Asia'),
('BI', 'Burundi', 'Bujumbura', '-3.366667', '29.350000', 'Africa'),
('BJ', 'Benin', 'Porto-Novo', '6.483333', '2.616667', 'Africa'),
('BL', 'Saint Barthelemy', 'Gustavia', '17.883333', '-62.850000', 'North America'),
('BM', 'Bermuda', 'Hamilton', '32.283333', '-64.783333', 'North America'),
('BN', 'Brunei Darussalam', 'Bandar Seri Begawan', '4.883333', '114.933333', 'Asia'),
('BO', 'Bolivia', 'La Paz', '-16.500000', '-68.150000', 'South America'),
('BR', 'Brazil', 'Brasilia', '-15.783333', '-47.916667', 'South America'),
('BS', 'Bahamas', 'Nassau', '25.083333', '-77.350000', 'North America'),
('BT', 'Bhutan', 'Thimphu', '27.466667', '89.633333', 'Asia'),
('BW', 'Botswana', 'Gaborone', '-24.633333', '25.900000', 'Africa'),
('BY', 'Belarus', 'Minsk', '53.900000', '27.566667', 'Europe'),
('BZ', 'Belize', 'Belmopan', '17.250000', '-88.766667', 'Central America'),
('CA', 'Canada', 'Ottawa', '45.416667', '-75.700000', 'Central America'),
('CC', 'Cocos Islands', 'West Island', '-12.166667', '96.833333', 'Australia'),
('CD', 'Democratic Republic of the Congo', 'Kinshasa', '-4.316667', '15.300000', 'Africa'),
('CF', 'Central African Republic', 'Bangui', '4.366667', '18.583333', 'Africa'),
('CG', 'Republic of Congo', 'Brazzaville', '-4.250000', '15.283333', 'Africa'),
('CH', 'Switzerland', 'Bern', '46.916667', '7.466667', 'Europe'),
('CI', 'Cote d?Ivoire', 'Yamoussoukro', '6.816667', '-5.266667', 'Africa'),
('CK', 'Cook Islands', 'Avarua', '-21.200000', '-159.766667', 'Australia'),
('CL', 'Chile', 'Santiago', '-33.450000', '-70.666667', 'South America'),
('CM', 'Cameroon', 'Yaounde', '3.866667', '11.516667', 'Africa'),
('CN', 'China', 'Beijing', '39.916667', '116.383333', 'Asia'),
('CO', 'Colombia', 'Bogota', '4.600000', '-74.083333', 'South America'),
('CR', 'Costa Rica', 'San Jose', '9.933333', '-84.083333', 'Central America'),
('CU', 'Cuba', 'Havana', '23.116667', '-82.350000', 'North America'),
('CV', 'Cape Verde', 'Praia', '14.916667', '-23.516667', 'Africa'),
('CW', 'Cura?ao', 'Willemstad', '12.100000', '-68.916667', 'North America'),
('CX', 'Christmas Island', 'The Settlement', '-10.416667', '105.716667', 'Australia'),
('CY', 'Cyprus', 'Nicosia', '35.166667', '33.366667', 'Europe'),
('CZ', 'Czech Republic', 'Prague', '50.083333', '14.466667', 'Europe'),
('DE', 'Germany', 'Berlin', '52.516667', '13.400000', 'Europe'),
('DJ', 'Djibouti', 'Djibouti', '11.583333', '43.150000', 'Africa'),
('DK', 'Denmark', 'Copenhagen', '55.666667', '12.583333', 'Europe'),
('DM', 'Dominica', 'Roseau', '15.300000', '-61.400000', 'North America'),
('DO', 'Dominican Republic', 'Santo Domingo', '18.466667', '-69.900000', 'North America'),
('DZ', 'Algeria', 'Algiers', '36.750000', '3.050000', 'Africa'),
('EC', 'Ecuador', 'Quito', '-0.216667', '-78.500000', 'South America'),
('EE', 'Estonia', 'Tallinn', '59.433333', '24.716667', 'Europe'),
('EG', 'Egypt', 'Cairo', '30.050000', '31.250000', 'Africa'),
('EH', 'Western Sahara', 'El-Aai?n', '27.153611', '-13.203333', 'Africa'),
('ER', 'Eritrea', 'Asmara', '15.333333', '38.933333', 'Africa'),
('ES', 'Spain', 'Madrid', '40.400000', '-3.683333', 'Europe'),
('ET', 'Ethiopia', 'Addis Ababa', '9.033333', '38.700000', 'Africa'),
('FI', 'Finland', 'Helsinki', '60.166667', '24.933333', 'Europe'),
('FJ', 'Fiji', 'Suva', '-18.133333', '178.416667', 'Australia'),
('FK', 'Falkland Islands', 'Stanley', '-51.700000', '-57.850000', 'South America'),
('FM', 'Federated States of Micronesia', 'Palikir', '6.916667', '158.150000', 'Australia'),
('FO', 'Faroe Islands', 'Torshavn', '62.000000', '-6.766667', 'Europe'),
('FR', 'France', 'Paris', '48.866667', '2.333333', 'Europe'),
('GA', 'Gabon', 'Libreville', '0.383333', '9.450000', 'Africa'),
('GB', 'United Kingdom', 'London', '51.500000', '-0.083333', 'Europe'),
('GD', 'Grenada', 'Saint George?s', '12.050000', '-61.750000', 'North America'),
('GE', 'Georgia', 'Tbilisi', '41.683333', '44.833333', 'Europe'),
('GG', 'Guernsey', 'Saint Peter Port', '49.450000', '-2.533333', 'Europe'),
('GH', 'Ghana', 'Accra', '5.550000', '-0.216667', 'Africa'),
('GI', 'Gibraltar', 'Gibraltar', '36.133333', '-5.350000', 'Europe'),
('GL', 'Greenland', 'Nuuk', '64.183333', '-51.750000', 'Central America'),
('GM', 'The Gambia', 'Banjul', '13.450000', '-16.566667', 'Africa'),
('GN', 'Guinea', 'Conakry', '9.500000', '-13.700000', 'Africa'),
('GQ', 'Equatorial Guinea', 'Malabo', '3.750000', '8.783333', 'Africa'),
('GR', 'Greece', 'Athens', '37.983333', '23.733333', 'Europe'),
('GS', 'South Georgia and South Sandwich Islands', 'King Edward Point', '-54.283333', '-36.500000', 'Antarctica'),
('GT', 'Guatemala', 'Guatemala City', '14.616667', '-90.516667', 'Central America'),
('GU', 'Guam', 'Hagatna', '13.466667', '144.733333', 'Australia'),
('GW', 'Guinea-Bissau', 'Bissau', '11.850000', '-15.583333', 'Africa'),
('GY', 'Guyana', 'Georgetown', '6.800000', '-58.150000', 'South America'),
('HK', 'Hong Kong', 'N/A', '0.000000', '0.000000', 'Asia'),
('HM', 'Heard Island and McDonald Islands', 'N/A', '0.000000', '0.000000', 'Antarctica'),
('HN', 'Honduras', 'Tegucigalpa', '14.100000', '-87.216667', 'Central America'),
('HR', 'Croatia', 'Zagreb', '45.800000', '16.000000', 'Europe'),
('HT', 'Haiti', 'Port-au-Prince', '18.533333', '-72.333333', 'North America'),
('HU', 'Hungary', 'Budapest', '47.500000', '19.083333', 'Europe'),
('ID', 'Indonesia', 'Jakarta', '-6.166667', '106.816667', 'Asia'),
('IE', 'Ireland', 'Dublin', '53.316667', '-6.233333', 'Europe'),
('IL', 'Israel', 'Jerusalem', '31.766667', '35.233333', 'Asia'),
('IM', 'Isle of Man', 'Douglas', '54.150000', '-4.483333', 'Europe'),
('IN', 'India', 'New Delhi', '28.600000', '77.200000', 'Asia'),
('IO', 'British Indian Ocean Territory', 'Diego Garcia', '-7.300000', '72.400000', 'Africa'),
('IQ', 'Iraq', 'Baghdad', '33.333333', '44.400000', 'Asia'),
('IR', 'Iran', 'Tehran', '35.700000', '51.416667', 'Asia'),
('IS', 'Iceland', 'Reykjavik', '64.150000', '-21.950000', 'Europe'),
('IT', 'Italy', 'Rome', '41.900000', '12.483333', 'Europe'),
('JE', 'Jersey', 'Saint Helier', '49.183333', '-2.100000', 'Europe'),
('JM', 'Jamaica', 'Kingston', '18.000000', '-76.800000', 'North America'),
('JO', 'Jordan', 'Amman', '31.950000', '35.933333', 'Asia'),
('JP', 'Japan', 'Tokyo', '35.683333', '139.750000', 'Asia'),
('KE', 'Kenya', 'Nairobi', '-1.283333', '36.816667', 'Africa'),
('KG', 'Kyrgyzstan', 'Bishkek', '42.866667', '74.600000', 'Asia'),
('KH', 'Cambodia', 'Phnom Penh', '11.550000', '104.916667', 'Asia'),
('KI', 'Kiribati', 'Tarawa', '-0.883333', '169.533333', 'Australia'),
('KM', 'Comoros', 'Moroni', '-11.700000', '43.233333', 'Africa'),
('KN', 'Saint Kitts and Nevis', 'Basseterre', '17.300000', '-62.716667', 'North America'),
('KO', 'Kosovo', 'Pristina', '42.666667', '21.166667', 'Europe'),
('KP', 'North Korea', 'Pyongyang', '39.016667', '125.750000', 'Asia'),
('KR', 'South Korea', 'Seoul', '37.550000', '126.983333', 'Asia'),
('KW', 'Kuwait', 'Kuwait City', '29.366667', '47.966667', 'Asia'),
('KY', 'Cayman Islands', 'George Town', '19.300000', '-81.383333', 'North America'),
('KZ', 'Kazakhstan', 'Astana', '51.166667', '71.416667', 'Asia'),
('LA', 'Laos', 'Vientiane', '17.966667', '102.600000', 'Asia'),
('LB', 'Lebanon', 'Beirut', '33.866667', '35.500000', 'Asia'),
('LC', 'Saint Lucia', 'Castries', '14.000000', '-61.000000', 'North America'),
('LI', 'Liechtenstein', 'Vaduz', '47.133333', '9.516667', 'Europe'),
('LK', 'Sri Lanka', 'Colombo', '6.916667', '79.833333', 'Asia'),
('LR', 'Liberia', 'Monrovia', '6.300000', '-10.800000', 'Africa'),
('LS', 'Lesotho', 'Maseru', '-29.316667', '27.483333', 'Africa'),
('LT', 'Lithuania', 'Vilnius', '54.683333', '25.316667', 'Europe'),
('LU', 'Luxembourg', 'Luxembourg', '49.600000', '6.116667', 'Europe'),
('LV', 'Latvia', 'Riga', '56.950000', '24.100000', 'Europe'),
('LY', 'Libya', 'Tripoli', '32.883333', '13.166667', 'Africa'),
('MA', 'Morocco', 'Rabat', '34.016667', '-6.816667', 'Africa'),
('MC', 'Monaco', 'Monaco', '43.733333', '7.416667', 'Europe'),
('MD', 'Moldova', 'Chisinau', '47.000000', '28.850000', 'Europe'),
('ME', 'Montenegro', 'Podgorica', '42.433333', '19.266667', 'Europe'),
('MF', 'Saint Martin', 'Marigot', '18.073100', '-63.082200', 'North America'),
('MG', 'Madagascar', 'Antananarivo', '-18.916667', '47.516667', 'Africa'),
('MH', 'Marshall Islands', 'Majuro', '7.100000', '171.383333', 'Australia'),
('MK', 'Macedonia', 'Skopje', '42.000000', '21.433333', 'Europe'),
('ML', 'Mali', 'Bamako', '12.650000', '-8.000000', 'Africa'),
('MM', 'Myanmar', 'Rangoon', '16.800000', '96.150000', 'Asia'),
('MN', 'Mongolia', 'Ulaanbaatar', '47.916667', '106.916667', 'Asia'),
('MO', 'Macau', 'N/A', '0.000000', '0.000000', 'Asia'),
('MP', 'Northern Mariana Islands', 'Saipan', '15.200000', '145.750000', 'Australia'),
('MR', 'Mauritania', 'Nouakchott', '18.066667', '-15.966667', 'Africa'),
('MS', 'Montserrat', 'Plymouth', '16.700000', '-62.216667', 'North America'),
('MT', 'Malta', 'Valletta', '35.883333', '14.500000', 'Europe'),
('MU', 'Mauritius', 'Port Louis', '-20.150000', '57.483333', 'Africa'),
('MV', 'Maldives', 'Male', '4.166667', '73.500000', 'Asia'),
('MW', 'Malawi', 'Lilongwe', '-13.966667', '33.783333', 'Africa'),
('MX', 'Mexico', 'Mexico City', '19.433333', '-99.133333', 'Central America'),
('MY', 'Malaysia', 'Kuala Lumpur', '3.166667', '101.700000', 'Asia'),
('MZ', 'Mozambique', 'Maputo', '-25.950000', '32.583333', 'Africa'),
('NA', 'Namibia', 'Windhoek', '-22.566667', '17.083333', 'Africa'),
('NC', 'New Caledonia', 'Noumea', '-22.266667', '166.450000', 'Australia'),
('NE', 'Niger', 'Niamey', '13.516667', '2.116667', 'Africa'),
('NF', 'Norfolk Island', 'Kingston', '-29.050000', '167.966667', 'Australia'),
('NG', 'Nigeria', 'Abuja', '9.083333', '7.533333', 'Africa'),
('NI', 'Nicaragua', 'Managua', '12.133333', '-86.250000', 'Central America'),
('NL', 'Netherlands', 'Amsterdam', '52.350000', '4.916667', 'Europe'),
('NO', 'Norway', 'Oslo', '59.916667', '10.750000', 'Europe'),
('NP', 'Nepal', 'Kathmandu', '27.716667', '85.316667', 'Asia'),
('NR', 'Nauru', 'Yaren', '-0.547700', '166.920867', 'Australia'),
('NU', 'Niue', 'Alofi', '-19.016667', '-169.916667', 'Australia'),
('NZ', 'New Zealand', 'Wellington', '-41.300000', '174.783333', 'Australia'),
('OM', 'Oman', 'Muscat', '23.616667', '58.583333', 'Asia'),
('PA', 'Panama', 'Panama City', '8.966667', '-79.533333', 'Central America'),
('PE', 'Peru', 'Lima', '-12.050000', '-77.050000', 'South America'),
('PF', 'French Polynesia', 'Papeete', '-17.533333', '-149.566667', 'Australia'),
('PG', 'Papua New Guinea', 'Port Moresby', '-9.450000', '147.183333', 'Australia'),
('PH', 'Philippines', 'Manila', '14.600000', '120.966667', 'Asia'),
('PK', 'Pakistan', 'Islamabad', '33.683333', '73.050000', 'Asia'),
('PL', 'Poland', 'Warsaw', '52.250000', '21.000000', 'Europe'),
('PM', 'Saint Pierre and Miquelon', 'Saint-Pierre', '46.766667', '-56.183333', 'Central America'),
('PN', 'Pitcairn Islands', 'Adamstown', '-25.066667', '-130.083333', 'Australia'),
('PR', 'Puerto Rico', 'San Juan', '18.466667', '-66.116667', 'North America'),
('PS', 'Palestine', 'Jerusalem', '31.766667', '35.233333', 'Asia'),
('PT', 'Portugal', 'Lisbon', '38.716667', '-9.133333', 'Europe'),
('PW', 'Palau', 'Melekeok', '7.483333', '134.633333', 'Australia'),
('PY', 'Paraguay', 'Asuncion', '-25.266667', '-57.666667', 'South America'),
('QA', 'Qatar', 'Doha', '25.283333', '51.533333', 'Asia'),
('RO', 'Romania', 'Bucharest', '44.433333', '26.100000', 'Europe'),
('RS', 'Serbia', 'Belgrade', '44.833333', '20.500000', 'Europe'),
('RU', 'Russia', 'Moscow', '55.750000', '37.600000', 'Europe'),
('RW', 'Rwanda', 'Kigali', '-1.950000', '30.050000', 'Africa'),
('SA', 'Saudi Arabia', 'Riyadh', '24.650000', '46.700000', 'Asia'),
('SB', 'Solomon Islands', 'Honiara', '-9.433333', '159.950000', 'Australia'),
('SC', 'Seychelles', 'Victoria', '-4.616667', '55.450000', 'Africa'),
('SD', 'Sudan', 'Khartoum', '15.600000', '32.533333', 'Africa'),
('SE', 'Sweden', 'Stockholm', '59.333333', '18.050000', 'Europe'),
('SG', 'Singapore', 'Singapore', '1.283333', '103.850000', 'Asia'),
('SH', 'Saint Helena', 'Jamestown', '-15.933333', '-5.716667', 'Africa'),
('SI', 'Slovenia', 'Ljubljana', '46.050000', '14.516667', 'Europe'),
('SJ', 'Svalbard', 'Longyearbyen', '78.216667', '15.633333', 'Europe'),
('SK', 'Slovakia', 'Bratislava', '48.150000', '17.116667', 'Europe'),
('SL', 'Sierra Leone', 'Freetown', '8.483333', '-13.233333', 'Africa'),
('SM', 'San Marino', 'San Marino', '43.933333', '12.416667', 'Europe'),
('SN', 'Senegal', 'Dakar', '14.733333', '-17.633333', 'Africa'),
('SO', 'Somalia', 'Mogadishu', '2.066667', '45.333333', 'Africa'),
('SR', 'Suriname', 'Paramaribo', '5.833333', '-55.166667', 'South America'),
('SS', 'South Sudan', 'Juba', '4.850000', '31.616667', 'Africa'),
('ST', 'Sao Tome and Principe', 'Sao Tome', '0.333333', '6.733333', 'Africa'),
('SV', 'El Salvador', 'San Salvador', '13.700000', '-89.200000', 'Central America'),
('SX', 'Sint Maarten', 'Philipsburg', '18.016667', '-63.033333', 'North America'),
('SY', 'Syria', 'Damascus', '33.500000', '36.300000', 'Asia'),
('SZ', 'Swaziland', 'Mbabane', '-26.316667', '31.133333', 'Africa'),
('TC', 'Turks and Caicos Islands', 'Grand Turk', '21.466667', '-71.133333', 'North America'),
('TD', 'Chad', 'N?Djamena', '12.100000', '15.033333', 'Africa'),
('TF', 'French Southern and Antarctic Lands', 'Port-aux-Fran?ais', '-49.350000', '70.216667', 'Antarctica'),
('TG', 'Togo', 'Lome', '6.116667', '1.216667', 'Africa'),
('TH', 'Thailand', 'Bangkok', '13.750000', '100.516667', 'Asia'),
('TJ', 'Tajikistan', 'Dushanbe', '38.550000', '68.766667', 'Asia'),
('TK', 'Tokelau', 'Atafu', '-9.166667', '-171.833333', 'Australia'),
('TL', 'Timor-Leste', 'Dili', '-8.583333', '125.600000', 'Asia'),
('TM', 'Turkmenistan', 'Ashgabat', '37.950000', '58.383333', 'Asia'),
('TN', 'Tunisia', 'Tunis', '36.800000', '10.183333', 'Africa'),
('TO', 'Tonga', 'Nuku?alofa', '-21.133333', '-175.200000', 'Australia'),
('TR', 'Turkey', 'Ankara', '39.933333', '32.866667', 'Europe'),
('TT', 'Trinidad and Tobago', 'Port of Spain', '10.650000', '-61.516667', 'North America'),
('TV', 'Tuvalu', 'Funafuti', '-8.516667', '179.216667', 'Australia'),
('TW', 'Taiwan', 'Taipei', '25.033333', '121.516667', 'Asia'),
('TZ', 'Tanzania', 'Dar es Salaam', '-6.800000', '39.283333', 'Africa'),
('UA', 'Ukraine', 'Kyiv', '50.433333', '30.516667', 'Europe'),
('UG', 'Uganda', 'Kampala', '0.316667', '32.550000', 'Africa'),
('UM', 'US Minor Outlying Islands', 'Washington, D.C.', '38.883333', '-77.000000', 'Australia'),
('US', 'United States', 'Washington, D.C.', '38.883333', '-77.000000', 'Central America'),
('UY', 'Uruguay', 'Montevideo', '-34.850000', '-56.166667', 'South America'),
('UZ', 'Uzbekistan', 'Tashkent', '41.316667', '69.250000', 'Asia'),
('VA', 'Vatican City', 'Vatican City', '41.900000', '12.450000', 'Europe'),
('VC', 'Saint Vincent and the Grenadines', 'Kingstown', '13.133333', '-61.216667', 'Central America'),
('VE', 'Venezuela', 'Caracas', '10.483333', '-66.866667', 'South America'),
('VG', 'British Virgin Islands', 'Road Town', '18.416667', '-64.616667', 'North America'),
('VI', 'US Virgin Islands', 'Charlotte Amalie', '18.350000', '-64.933333', 'North America'),
('VN', 'Vietnam', 'Hanoi', '21.033333', '105.850000', 'Asia'),
('VU', 'Vanuatu', 'Port-Vila', '-17.733333', '168.316667', 'Australia'),
('WF', 'Wallis and Futuna', 'Mata-Utu', '-13.950000', '-171.933333', 'Australia'),
('WS', 'Samoa', 'Apia', '-13.816667', '-171.766667', 'Australia'),
('YE', 'Yemen', 'Sanaa', '15.350000', '44.200000', 'Asia'),
('ZA', 'South Africa', 'Pretoria', '-25.700000', '28.216667', 'Africa'),
('ZM', 'Zambia', 'Lusaka', '-15.416667', '28.283333', 'Africa'),
('ZW', 'Zimbabwe', 'Harare', '-17.816667', '31.033333', 'Africa');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`) VALUES
(134256);

-- --------------------------------------------------------

--
-- Table structure for table `user_summary`
--

DROP TABLE IF EXISTS `user_summary`;
CREATE TABLE IF NOT EXISTS `user_summary` (
  `date` datetime DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `total` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
 ADD PRIMARY KEY (`code`), ADD UNIQUE KEY `code` (`code`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `id` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
