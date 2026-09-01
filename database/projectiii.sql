-- Adminer 5.4.2 MariaDB 11.8.8-MariaDB-1 from Debian dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `ads`;
CREATE TABLE `ads` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `price` float DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `redirect_url` varchar(255) DEFAULT NULL,
  `status` varchar(10) DEFAULT 'active',
  `category` varchar(20) DEFAULT 'ads',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

INSERT INTO `ads` (`id`, `title`, `description`, `price`, `image`, `redirect_url`, `status`, `category`) VALUES
(21,	'Dhorpatan Visit',	'The cheapest ever tour to dhorpatan for 3 nights and 5 days along with the short trip to dhawalagiri. Package includes 2 people,lodging and feeding.',	20000,	'ad_6a6c1047a425c.jpg',	'https://en.wikipedia.org/wiki/Dhorpatan',	'active',	'ads'),
(22,	'Pathivara Temple Couple Package (3 Days / 2 Nights)',	'Experience a peaceful and memorable journey to the sacred Pathivara Temple with your loved one. Enjoy comfortable lodging, delicious meals, and breathtaking Himalayan scenery throughout your trip. Perfect for couples seeking a blend of spiritual devotion, nature, and relaxation.',	5000,	'ad_6a6c11020bd1d.jpg',	'https://en.wikipedia.org/wiki/Pathibhara_Devi_Temple',	'active',	'festival'),
(23,	'Mustang Tour',	'Holiday package for couples',	1200,	'ad_6a6c463c99e2a.jpg',	'https://www.facebook.com',	'active',	'ads'),
(24,	'Manang Tour.',	'for couples this dasain',	3400,	'ad_6a6c4668205ad.webp',	'https://www.youtube.com',	'active',	'festival'),
(25,	'Gosain Kunda Visit',	'Visit Gosainkunda this dasain and get upto 13% discount on the trip. The trips is for 3 day and 2 night for couple. The deal is pay once and forget about the expenses.',	2400,	'ad_6a922eb98481b.webp',	'https://search.brave.com/images?q=gosain+kunda+pics',	'active',	'festival');

DROP TABLE IF EXISTS `ad_bookings`;
CREATE TABLE `ad_bookings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ad_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(60) DEFAULT NULL,
  `mobile` varchar(20) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `ad_title` varchar(100) DEFAULT NULL,
  `category` varchar(30) DEFAULT NULL,
  `price` varchar(50) DEFAULT NULL,
  `status` varchar(10) DEFAULT 'pending',
  `booked_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

INSERT INTO `ad_bookings` (`id`, `ad_id`, `user_id`, `name`, `mobile`, `address`, `ad_title`, `category`, `price`, `status`, `booked_at`) VALUES
(4,	24,	4,	'Rajendra',	'9856432345',	'Tandi bhokaha',	'Manang Tour.',	'festival',	'3400',	'pending',	'2026-07-31 07:01:29'),
(5,	22,	4,	'sundar',	'9846372736',	'parsa chitwan.',	'Pathivara Temple Couple Package (3 Days / 2 Nights)',	'festival',	'5000',	'pending',	'2026-07-31 07:02:45'),
(6,	23,	4,	'Ambir Gurung',	'9877667632',	'23 bangla banglore',	'Mustang Tour',	'ads',	'1200',	'pending',	'2026-07-31 07:04:33'),
(7,	24,	29,	'Hari Sharma',	'9834223454',	'Tandi Subbachowk, Chitwan',	'Manang Tour.',	'festival',	'3400',	'pending',	'2026-08-01 01:11:41');

DROP TABLE IF EXISTS `ad_ratings`;
CREATE TABLE `ad_ratings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ad_id` int(11) NOT NULL,
  `rating` tinyint(4) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

INSERT INTO `ad_ratings` (`id`, `ad_id`, `rating`, `user_id`) VALUES
(82,	22,	3,	4),
(83,	21,	5,	4),
(84,	24,	4,	4),
(85,	23,	5,	4),
(86,	21,	3,	4),
(87,	24,	4,	4),
(88,	22,	4,	4),
(89,	23,	4,	4),
(90,	21,	5,	4),
(91,	23,	3,	4),
(92,	21,	3,	4),
(93,	22,	5,	4),
(94,	24,	5,	4),
(95,	24,	4,	37),
(96,	22,	5,	37),
(97,	23,	3,	37),
(98,	21,	5,	37),
(99,	25,	5,	37),
(100,	21,	5,	37),
(101,	23,	3,	37),
(102,	25,	5,	4),
(103,	24,	5,	4),
(104,	22,	5,	4),
(105,	23,	5,	4),
(106,	21,	5,	4),
(107,	25,	5,	30),
(108,	24,	5,	30),
(109,	22,	3,	30),
(110,	23,	5,	30),
(111,	21,	5,	30),
(112,	24,	5,	4),
(113,	25,	5,	4),
(114,	21,	4,	4),
(115,	23,	5,	4),
(116,	22,	3,	4);

DROP TABLE IF EXISTS `bus`;
CREATE TABLE `bus` (
  `company_name` varchar(30) DEFAULT NULL,
  `owner_name` varchar(30) DEFAULT NULL,
  `engine_no` varchar(30) DEFAULT NULL,
  `chassis_no` varchar(30) DEFAULT NULL,
  `vehicle_no` varchar(20) DEFAULT NULL,
  `noofseat` int(11) DEFAULT NULL,
  `bus_type` varchar(30) DEFAULT NULL,
  `route` varchar(50) DEFAULT NULL,
  `fare` varchar(50) DEFAULT NULL,
  `arr_time` varchar(30) DEFAULT NULL,
  `dep_time` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

INSERT INTO `bus` (`company_name`, `owner_name`, `engine_no`, `chassis_no`, `vehicle_no`, `noofseat`, `bus_type`, `route`, `fare`, `arr_time`, `dep_time`) VALUES
('Agni Yatayat',	'Murali Dhar Shrestha',	'ME2390AA67ZD',	'AC89MA1223TTY',	'NA 12 TA 2423',	46,	'Super Express',	'Kathmandu-Bharatpur',	'2300',	'06:30 AM',	'06:00 AM'),
('Makalu Yatayat',	'Ravi Dhakal',	'EANA53UIO23',	'NAM78AMC22',	'NA 5 TA 2424',	44,	'Super Express',	'Biratnagar-Kathmandu',	'1400',	'05:30 PM',	'05:00 PM'),
('Everest Deluxe',	'Binod Khanna',	'EVM12ESA8J9',	'BA84NY90RW',	'NA 2 KHA 8965',	40,	'Deluxe',	'Bharatpur-Pokhara',	'2300',	'07:30 AM',	'08:00 AM'),
('Sai Ram Express',	'Shiva Kumar Yadav',	'EK123C7AA89BV9',	'MA98EV3AL234SB',	'NA 12 TA 4587',	48,	'Express',	'Butwal-Bharatpur',	'780',	'10:45 AM',	'11:00 AM'),
('Muktinath Travels and Tours',	'Sundar Thakali',	'EA98SAS4GE23AAN',	'WA45SZT87POH87D',	'NA 10 KHA 4556',	43,	'Deluxe',	'Kathmandu-Pokhara',	'2000',	'11:45 AM',	'12:00 AM'),
('Sholay Transport Service',	'Purna Bahadur Rai',	'EAS98AST23WEV!!',	'KLI976XE65B23ETS',	'NA 7 KHA 3234',	48,	'Super Express',	'Kathmandu-Bharatpur',	'1300',	'05:45 AM',	'06:00 AM'),
('Royal Travles',	'Balaram Chaudhary',	'SA23TESAT98EAX',	'LIE98XTT798ASXE5',	'NA 3 KHA 9078',	48,	'Express',	'Kathmandu-Bharatpur',	'1900',	'06:15 AM',	'06:30 AM');

DROP TABLE IF EXISTS `login`;
CREATE TABLE `login` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fname` varchar(30) DEFAULT NULL,
  `mname` varchar(30) DEFAULT NULL,
  `lname` varchar(30) DEFAULT NULL,
  `address` varchar(60) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `mobile` varchar(12) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `uname` varchar(30) DEFAULT NULL,
  `pwd` varchar(15) DEFAULT NULL,
  `acc` int(11) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_email` (`email`),
  UNIQUE KEY `unique_mobile` (`mobile`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

INSERT INTO `login` (`id`, `fname`, `mname`, `lname`, `address`, `email`, `mobile`, `gender`, `uname`, `pwd`, `acc`, `status`) VALUES
(4,	'prabin',	'bahadur',	'poudel',	'khairahani-1 chitwan,nepal',	'prabin@gmail.com',	'9867689443',	'Male',	'normal123',	'123456789',	2,	'active'),
(23,	'Raja',	'Ram',	'Chaudal',	'rolpa-1 rukum,nepal',	'raja@gmail.com',	'9867543234',	'Male',	'admin123',	'123456789',	3,	'active'),
(29,	'Harish',	'',	'Rauf',	'Kamaltar-1 nuwakot,nepal',	'harish122@gmail.com',	'9856432567',	'Male',	'harish123',	'123456789',	2,	'active'),
(30,	'Balendra',	'Pratap',	'Shah',	'Kathmandu-1 kathmandu,nepal',	'balenshah@gmail.com',	'9866554433',	'Male',	'balen123',	'123456789',	2,	'active'),
(33,	'Subarna',	'',	'Shakya',	'lalitpur-05 kathmandu,nepal',	'subarna@gmail.com',	'9832415263',	'Male',	'subarna123',	'123456789',	1,	'inactive'),
(34,	'Aniket',	'',	'Bushal',	'Jaymangla-01 chitwan,nepal',	'aniket@gmail.com',	'9833446523',	'Male',	'aniket123',	'123456789',	1,	'inactive'),
(35,	'Sudesh',	'',	'Sharma',	'Jyamire-01 chitwan,nepal',	'sudesh@gmail.com',	'9812233445',	'Male',	'sudesh123',	'123456789',	1,	'inactive'),
(36,	'Sundar',	'Kumar',	'Pandey',	'Baghmara-01 chitwan,nepal',	'sundar@123gmail.com',	'9867554372',	'Male',	'sundar123',	'123456789',	1,	'inactive'),
(37,	'Bibek',	'',	'Adhikari',	'Bharatpur-01 chitwan,nepal',	'bibek@gmail.com',	'9867342343',	'Male',	'bibek123',	'123456789',	2,	'active');

DROP TABLE IF EXISTS `staff`;
CREATE TABLE `staff` (
  `name` varchar(50) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(20) DEFAULT NULL,
  `contact` varchar(30) DEFAULT NULL,
  `assigned_veh` varchar(20) DEFAULT NULL,
  `acc` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

INSERT INTO `staff` (`name`, `username`, `password`, `contact`, `assigned_veh`, `acc`) VALUES
('Kamal Bushal',	'kamal123',	'123456789',	'9865453423',	'NA 12 TA 2423',	4),
('Kumar Shah',	'kumar123',	'123456789',	'9844352213',	'NA 5 TA 2424',	4),
('Kushal Bhurtel',	'kushal123',	'123456789',	'9866543243',	'NA 2 KHA 8965',	4),
('Sukh Dev Shah',	'sukhi123',	'123456789',	'9855432343',	'NA 12 TA 4587',	4),
('Latif Ahmed',	'latif123',	'123456789',	'9857434567',	'NA 10 KHA 4556',	4);

DROP TABLE IF EXISTS `tickets`;
CREATE TABLE `tickets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) DEFAULT NULL,
  `address` varchar(30) DEFAULT NULL,
  `mobile` bigint(20) DEFAULT NULL,
  `company_name` varchar(30) DEFAULT NULL,
  `route` varchar(150) DEFAULT NULL,
  `seat` varchar(100) DEFAULT NULL,
  `travel_date` varchar(40) DEFAULT NULL,
  `travel_time` varchar(30) DEFAULT NULL,
  `veh_no` varchar(20) DEFAULT NULL,
  `fare` decimal(10,2) DEFAULT NULL,
  `total_fare` decimal(10,2) DEFAULT NULL,
  `tax` decimal(10,2) DEFAULT NULL,
  `total` decimal(10,2) GENERATED ALWAYS AS (`total_fare` + `tax`) STORED,
  `status` varchar(10) DEFAULT NULL,
  `payment_method` varchar(30) DEFAULT NULL,
  `expire` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_booking` (`mobile`,`route`,`seat`,`travel_date`,`total`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

INSERT INTO `tickets` (`id`, `name`, `address`, `mobile`, `company_name`, `route`, `seat`, `travel_date`, `travel_time`, `veh_no`, `fare`, `total_fare`, `tax`, `status`, `payment_method`, `expire`) VALUES
(101,	'prabin poudel',	'khairahani-1 chitwan,nepal',	9867689443,	'Agni Yatayat',	'Kathmandu-Bharatpur',	'1, 2, 5, 6',	'2026-07-31',	'06:00 AM',	'NA 12 TA 2423',	2300.00,	9200.00,	1196.00,	'confirm',	'online',	1785471285),
(102,	'prabin poudel',	'khairahani-1 chitwan,nepal',	9867689443,	'Makalu Yatayat',	'Biratnagar-Kathmandu',	'1, 2, 5, 6',	'2026-08-01',	'05:00 PM',	'NA 5 TA 2424',	1400.00,	5600.00,	728.00,	'confirm',	'online',	1785471727),
(103,	'Sabin Darai',	'Bahera Chowk',	9834567765,	'Makalu Yatayat',	'Bahera Chowk-Kathmandu',	'1,2,5,6',	'2026-07-31',	'10:13 AM',	'NA 5 TA 2424',	850.00,	3400.00,	442.00,	'confirm',	'cash',	0),
(104,	'prabin poudel',	'khairahani-1 chitwan,nepal',	9867689443,	'Makalu Yatayat',	'Biratnagar-Kathmandu',	'9, 10, 13, 14',	'2026-07-31',	'05:00 PM',	'NA 5 TA 2424',	1400.00,	5600.00,	728.00,	'confirm',	'online',	1785472814),
(109,	'prabin poudel',	'khairahani-1 chitwan,nepal',	9867689443,	'Agni Yatayat',	'Kathmandu-Bharatpur',	'17, 18, 21, 22',	'2026-07-31',	'06:00 AM',	'NA 12 TA 2423',	2300.00,	7360.00,	956.80,	'confirm',	'online',	1785488115),
(110,	'Harish Rauf',	'Kamaltar-1 nuwakot,nepal',	9856432567,	'Everest Deluxe',	'Bharatpur-Pokhara',	'1, 2, 5, 6, 9, 10',	'2026-08-01',	'08:00 AM',	'NA 2 KHA 8965',	2300.00,	13800.00,	1794.00,	'confirm',	'online',	1785546977),
(112,	'Akhilesh',	'Tandi subbachowk,chitwan',	9872361253,	'Everest Deluxe',	'Bakulahar-Abu Khairahani',	'13,14,17,18,21',	'2026-08-01',	'06:54 AM',	'NA 2 KHA 8965',	1500.00,	7500.00,	975.00,	'confirm',	'cash',	0),
(113,	'Harish Rauf',	'Kamaltar-1 nuwakot,nepal',	9856432567,	'Agni Yatayat',	'Kathmandu-Bharatpur',	'1, 2, 5, 6',	'2026-08-01',	'06:00 AM',	'NA 12 TA 2423',	2300.00,	7360.00,	956.80,	'confirm',	'online',	1785547306),
(114,	'prabin poudel',	'khairahani-1 chitwan,nepal',	9867689443,	'Agni Yatayat',	'Kathmandu-Bharatpur',	'1, 2, 5, 6',	'2026-08-28',	'06:00 AM',	'NA 12 TA 2423',	2300.00,	9200.00,	1196.00,	'confirm',	'online',	1787881147),
(115,	'Roshan Gurung',	'Bharatpur-11',	9876545323,	'Agni Yatayat',	'Dhading-Mugling',	NULL,	'2026-08-28',	'07:29 AM',	'NA 12 TA 2423',	520.00,	2080.00,	270.40,	'confirm',	'cash',	0),
(116,	'Rupa Sharma',	'Hetauda-10,Makwanpur',	9845362787,	'Makalu Yatayat',	'Muglin-Dule Gauda',	'1,2,5,6,43,44',	'2026-08-28',	'09:37 AM',	'NA 5 TA 2424',	350.00,	2100.00,	273.00,	'confirm',	'cash',	0),
(117,	'prabin poudel',	'khairahani-1 chitwan,nepal',	9867689443,	'Makalu Yatayat',	'Biratnagar-Kathmandu',	'1, 2, 5, 6, 9, 10',	'2026-08-30',	'05:00 PM',	'NA 5 TA 2424',	1400.00,	8400.00,	1092.00,	'confirm',	'none',	1787892834),
(118,	'prabin poudel',	'khairahani-1 chitwan,nepal',	9867689443,	'Agni Yatayat',	'Kathmandu-Bharatpur',	'1, 2, 5, 6, 9, 10, 13',	'2026-08-30',	'06:00 AM',	'NA 12 TA 2423',	2300.00,	16100.00,	2093.00,	'confirm',	'none',	1787892858),
(119,	'prabin poudel',	'khairahani-1 chitwan,nepal',	9867689443,	'Everest Deluxe',	'Bharatpur-Pokhara',	'1, 2, 5, 6, 9, 10',	'2026-08-30',	'08:00 AM',	'NA 2 KHA 8965',	2300.00,	13800.00,	1794.00,	'confirm',	'none',	1787892882),
(120,	'Bibek Adhikari',	'Bharatpur-01 chitwan,nepal',	9867342343,	'Agni Yatayat',	'Kathmandu-Bharatpur',	'1, 2, 5, 6',	'2026-08-29',	'06:00 AM',	'NA 12 TA 2423',	2300.00,	9200.00,	1196.00,	'confirm',	'online',	1787965264),
(122,	'Krishna`Mahato',	'Khairahani-09 chitwan, nepal',	9865323421,	'Agni Yatayat',	'Malekhu-Muglin',	'17,18,21,22',	'2026-08-29',	'06:38 AM',	'NA 12 TA 2423',	350.00,	1400.00,	182.00,	'confirm',	'cash',	0),
(123,	'Balendra Shah',	'Kathmandu-1 kathmandu,nepal',	9866554433,	'Everest Deluxe',	'Bharatpur-Pokhara',	'1, 2, 5, 6',	'2026-08-29',	'08:00 AM',	'NA 2 KHA 8965',	2300.00,	7360.00,	956.80,	'confirm',	'online',	1787966184),
(124,	'Balendra Shah',	'Kathmandu-1 kathmandu,nepal',	9866554433,	'Sai Ram Express',	'Butwal-Bharatpur',	'1, 2, 5, 6',	'2026-08-29',	'11:00 AM',	'NA 12 TA 4587',	780.00,	3120.00,	405.60,	'confirm',	'online',	1787966573),
(126,	'prabin poudel',	'khairahani-1 chitwan,nepal',	9867689443,	'Agni Yatayat',	'Kathmandu-Bharatpur',	'9, 10, 7, 20, 31, 40',	'2026-08-29',	'06:00 AM',	'NA 12 TA 2423',	2300.00,	13800.00,	1794.00,	'confirm',	'none',	1787981162),
(127,	'prabin poudel',	'khairahani-1 chitwan,nepal',	9867689443,	'Agni Yatayat',	'Kathmandu-Bharatpur',	'3, 4',	'2026-08-29',	'06:00 AM',	'NA 12 TA 2423',	2300.00,	4600.00,	598.00,	'confirm',	'none',	1787981263),
(131,	'Balendra Shah',	'Kathmandu-1 kathmandu,nepal',	9866554433,	'Makalu Yatayat',	'Biratnagar-Kathmandu',	'1, 2, 5, 10',	'2026-09-03',	'05:00 PM',	'NA 5 TA 2424',	1400.00,	5600.00,	728.00,	'pending',	'none',	1787981931),
(132,	'Ravi Shankar',	'Dhalkebar, Mahottari',	9867323456,	'Makalu Yatayat',	'Dhalkebar-Kathmandu',	'1,2,5,6',	'2026-08-29',	'11:16 AM',	'NA 5 TA 2424',	1250.00,	5000.00,	650.00,	'confirm',	'cash',	0),
(133,	'prabin poudel',	'khairahani-1 chitwan,nepal',	9867689443,	'Makalu Yatayat',	'Biratnagar-Kathmandu',	'9, 13, 17, 22',	'2026-09-03',	'05:00 PM',	'NA 5 TA 2424',	1400.00,	5600.00,	728.00,	'pending',	'none',	1787982166),
(134,	'prabin poudel',	'khairahani-1 chitwan,nepal',	9867689443,	'Makalu Yatayat',	'Biratnagar-Kathmandu',	'1, 2, 5, 6, 9, 10',	'2026-09-05',	'05:00 PM',	'NA 5 TA 2424',	1400.00,	8400.00,	1092.00,	'pending',	'none',	1787982200),
(135,	'Subash Sedai',	'Thankot',	9867463728,	'Muktinath Travels and Tours',	'Thankot-Dumre',	'1,2,9',	'2026-08-29',	'11:27 AM',	'NA 10 KHA 4556',	1350.00,	4050.00,	526.50,	'confirm',	'cash',	0),
(136,	'Shream Yadav',	'Muglin',	9847362734,	'Muktinath Travels and Tours',	'Muglin-Pokhara',	'5,18,26',	'2026-08-29',	'11:28 AM',	'NA 10 KHA 4556',	1000.00,	3000.00,	390.00,	'confirm',	'cash',	0),
(137,	'Balendra Shah',	'Kathmandu-1 kathmandu,nepal',	9866554433,	'Muktinath Travels and Tours',	'Kathmandu-Pokhara',	'1, 2, 5',	'2026-09-06',	'12:00 AM',	'NA 10 KHA 4556',	2000.00,	6000.00,	780.00,	'confirm',	'online',	1787983490);

-- 2026-09-01 05:24:38 UTC
