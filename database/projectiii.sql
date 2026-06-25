-- Adminer 5.4.2 MariaDB 11.8.6-MariaDB-6 from Debian dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

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
('Everest Travels',	'Ram Sharma',	'EN12345',	'CH54321',	'BA-1-KHA-1234',	40,	'Deluxe',	'Kathmandu-Pokhara',	'1500',	'14:00',	'07:00'),
('Himalayan Bus',	'Sita Gurung',	'EN12346',	'CH54322',	'BA-2-KHA-2345',	35,	'Normal',	'Pokhara-Chitwan',	'800',	'12:30',	'08:00'),
('Green Valley',	'Hari Thapa',	'EN12347',	'CH54323',	'BA-3-KHA-3456',	45,	'AC',	'Kathmandu-Butwal',	'1800',	'16:00',	'06:00'),
('Mountain Rider',	'Gopal Karki',	'EN12348',	'CH54324',	'BA-4-KHA-4567',	50,	'Super Deluxe',	'Kathmandu-Dharan',	'2000',	'18:00',	'05:00'),
('City Express',	'Bishal Rai',	'EN12349',	'CH54325',	'BA-5-KHA-5678',	30,	'Mini Bus',	'Biratnagar-Itahari',	'300',	'10:00',	'07:30'),
('Sunrise Travels',	'Mina Magar',	'EN12350',	'CH54326',	'BA-6-KHA-6789',	42,	'Deluxe',	'Chitwan-Pokhara',	'900',	'13:00',	'08:00'),
('Speed Line',	'Kamal BK',	'EN12351',	'CH54327',	'BA-7-KHA-7890',	38,	'AC',	'Kathmandu-Nepalgunj',	'2200',	'20:00',	'04:00'),
('Royal Bus',	'Rita Tamang',	'EN12352',	'CH54328',	'BA-8-KHA-8901',	44,	'Super Deluxe',	'Kathmandu-Janakpur',	'1600',	'15:00',	'07:00'),
('Quick Ride',	'Dipak Shrestha',	'EN12353',	'CH54329',	'BA-9-KHA-9012',	28,	'Mini Bus',	'Butwal-Pokhara',	'600',	'11:30',	'07:00'),
('Skyline Travels',	'Anita Lama',	'EN12354',	'CH54330',	'BA-10-KHA-1122',	46,	'AC',	'Kathmandu-Birgunj',	'1400',	'14:30',	'08:30'),
('Metro Bus',	'Suresh Chaudhary',	'EN12355',	'CH54331',	'BA-11-KHA-2233',	32,	'Normal',	'Birgunj-Hetauda',	'400',	'12:00',	'09:00'),
('Fast Track',	'Nabin Oli',	'EN12356',	'CH54332',	'BA-12-KHA-3344',	48,	'Deluxe',	'Kathmandu-Dhangadhi',	'2500',	'21:00',	'05:00'),
('Happy Journey',	'Sunita KC',	'EN12357',	'CH54333',	'BA-13-KHA-4455',	36,	'AC',	'Pokhara-Baglung',	'700',	'13:30',	'09:00'),
('Travel King',	'Prakash Adhikari',	'EN12358',	'CH54334',	'BA-14-KHA-5566',	40,	'Super Deluxe',	'Kathmandu-Illam',	'2300',	'19:00',	'06:00'),
('Express Nepal',	'Kiran Poudel',	'EN12359',	'CH54335',	'BA-15-KHA-6677',	34,	'Normal',	'Chitwan-Butwal',	'500',	'12:45',	'08:15'),
('Safe Ride',	'Ramesh Bhandari',	'EN12360',	'CH54336',	'BA-16-KHA-7788',	45,	'AC',	'Kathmandu-Syangja',	'1700',	'16:30',	'07:30'),
('Global Travels',	'Deepa Shahi',	'EN12361',	'CH54337',	'BA-17-KHA-8899',	50,	'Super Deluxe',	'Kathmandu-Mahendranagar',	'2800',	'22:00',	'04:00'),
('Swift Bus',	'Manoj Khatri',	'EN12362',	'CH54338',	'BA-18-KHA-9900',	37,	'Deluxe',	'Pokhara-Tansen',	'650',	'11:00',	'08:00'),
('Dream Line',	'Sarita Panta',	'EN12363',	'CH54339',	'BA-19-KHA-1010',	29,	'Mini Bus',	'Dharan-Biratnagar',	'350',	'10:30',	'07:30'),
('Urban Express',	'Ashok Neupane',	'EN12364',	'CH54340',	'BA-20-KHA-2020',	41,	'AC',	'Kathmandu-Hetauda',	'900',	'13:15',	'08:45'),
('Sai Baba Transport',	'Kumar Sange',	'EN4678RA34WE',	'AC9022BACRO233',	'NA 24 PA 2323',	48,	'Super Express',	'Butwal-Pokhara',	'1300',	'06:00',	'05:45');

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
(4,	'prabin',	'bahadur',	'poudel',	'khairahani-1 chitwan,nepal',	'prabin@gmail.com',	'9867689443',	'm',	'pra123',	'123456789',	2,	'inactive'),
(23,	'Raja',	'Ram',	'Chaudal',	'rolpa-1 rukum,nepal',	'raja@gmail.com',	'9867543234',	'm',	'raja123',	'123456789',	2,	'inactive'),
(24,	'kumar',	'ramtel',	'harijan',	'rolpa-1 khairahani,nepal',	'kumar@gmail.com',	'9876767345',	'm',	'kumar123',	'123456789',	2,	'inactive'),
(25,	'Prabin',	'Kumar',	'Poudel',	'Bharatpur-10, Chitwan',	'prabin1@example.com',	'9800000001',	'Male',	'prabin123',	'pass123',	1001,	'active'),
(26,	'Sita',	'Devi',	'Sharma',	'Kathmandu-5',	'sita@example.com',	'9800000002',	'Female',	'sita01',	'pass456',	1002,	'active'),
(27,	'Ram',	'Bahadur',	'Thapa',	'Pokhara-8',	'ram@example.com',	'9800000003',	'Male',	'ramthapa',	'pass789',	1003,	'active'),
(28,	'Gita',	'Maya',	'Gurung',	'Lalitpur-3',	'gita@example.com',	'9800000004',	'Female',	'gitaG',	'pass321',	1004,	'active');

DROP TABLE IF EXISTS `test`;
CREATE TABLE `test` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

INSERT INTO `test` (`id`, `name`) VALUES
(1,	'ram');

DROP TABLE IF EXISTS `tickets`;
CREATE TABLE `tickets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) DEFAULT NULL,
  `address` varchar(30) DEFAULT NULL,
  `mobile` bigint(20) DEFAULT NULL,
  `company_name` varchar(30) DEFAULT NULL,
  `route` varchar(30) DEFAULT NULL,
  `seat` varchar(100) DEFAULT NULL,
  `travel_date` varchar(40) DEFAULT NULL,
  `veh_no` varchar(20) DEFAULT NULL,
  `fare` decimal(10,2) DEFAULT NULL,
  `total_fare` decimal(10,2) DEFAULT NULL,
  `tax` decimal(10,2) DEFAULT NULL,
  `total` decimal(10,2) GENERATED ALWAYS AS (`total_fare` + `tax`) STORED,
  `status` varchar(10) DEFAULT NULL,
  `expire` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_booking` (`mobile`,`route`,`seat`,`total`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_uca1400_ai_ci;

INSERT INTO `tickets` (`id`, `name`, `address`, `mobile`, `company_name`, `route`, `seat`, `travel_date`, `veh_no`, `fare`, `total_fare`, `tax`, `status`, `expire`) VALUES
(3,	'prabin poudel',	'khairahani-1 chitwan,nepal',	9867689443,	'Everest Travels',	'Kathmandu-Pokhara',	'1, 2, 5, 6',	'2026-06-25',	'BA-1-KHA-1234',	1500.00,	6000.00,	780.00,	'pending',	1782378483),
(4,	'prabin poudel',	'khairahani-1 chitwan,nepal',	9867689443,	'Everest Travels',	'Kathmandu-Pokhara',	'9, 10, 13, 14',	'2026-06-25',	'BA-1-KHA-1234',	1500.00,	6000.00,	780.00,	'pending',	1782379169);

-- 2026-06-25 08:15:52 UTC
