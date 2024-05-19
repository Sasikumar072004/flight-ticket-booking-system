-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 19, 2023 at 03:50 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `booking`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_name` char(40) DEFAULT NULL,
  `email` char(40) NOT NULL,
  `pass` char(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_name`, `email`, `pass`) VALUES
('a', 'a@a.com', 'a'),
('admin', 'admin@gmail.com', 'admin'),
('systemadmin', 'systemadmin@a.com', 'systemadmin');

-- --------------------------------------------------------

--
-- Table structure for table `airline`
--

CREATE TABLE `airline` (
  `email` char(40) NOT NULL,
  `pass` char(40) DEFAULT NULL,
  `airline_name` char(40) DEFAULT NULL,
  `logo` char(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `airline`
--

INSERT INTO `airline` (`email`, `pass`, `airline_name`, `logo`) VALUES
('airasia@gmail.com', 'a', 'Air Asia', 'uploads/Air Asia.png'),
('aircanada@gmail.com', 'a', 'Air Canada', 'uploads/Air Canada.png'),
('airchina@gmail.com', 'a', 'Air China', 'uploads/Air China.png'),
('airindia@gmail.com', 'a', 'Air India', 'uploads/Air India.png'),
('americanairlines@gmail.com', 'a', 'American Airlines', 'uploads/American Airlines.png'),
('bimanbangladesh@gmail.com', 'a', 'Biman Bangladesh', 'uploads/biman bangladesh.png'),
('britishairways@gmail.com', 'a', 'British Airways', 'uploads/British Airways.png'),
('cathaydragon@gmail.com', 'a', 'Cathay Dragon', 'uploads/Cathay Dragon.png'),
('egyptAir@gmail.com', 'a', 'EgyptAir', 'uploads/EgyptAir.png'),
('emirates@gmail.com', 'a', 'Emirates', 'uploads/Emirates.png'),
('ethiopian@gmail.com', 'a', 'Ethiopian', 'uploads/Ethiopian.png'),
('hawaiianairlines@gmail.com', 'a', 'Hawaiian Airlines', 'uploads/Hawaiian Airlines.png'),
('japanairlines@gmail.com', 'a', 'Japan Airlines', 'uploads/Japan Airlines.png'),
('koreanair@gmail.com', 'a', 'Korean Air', 'uploads/Korean Air.png'),
('lufthansa@gmail.com', 'a', 'Lufthansa', 'uploads/Lufthansa.png'),
('mexicana@gmail.com', 'a', 'Mexicana', 'uploads/Mexicana.png'),
('Qatarairways@gmail.com', 'a', 'Qatar Airways', 'uploads/airline-logos-qatar.png'),
('ryanair@gmail.com', 'a', 'Ryanair', 'uploads/Ryanair.png'),
('sriLankanairlines@gmail.com', 'a', 'SriLankan Airlines', 'uploads/SriLankan Airlines.png'),
('swiss@gmail.com', 'a', 'Swiss', 'uploads/Swiss.png'),
('thaiairways@gmail.com', 'a', 'Thai Airways', 'uploads/Thai Airways.png'),
('turkishairlines@gmail.com', 'a', 'Turkish Airlines', 'uploads/Turkish Airlines.png');

-- --------------------------------------------------------

--
-- Table structure for table `airport`
--

CREATE TABLE `airport` (
  `airport_id` int(11) NOT NULL,
  `airport_name` char(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `airport`
--

INSERT INTO `airport` (`airport_id`, `airport_name`) VALUES
(17, ' Dhaka Airport'),
(18, 'Cox’s Bazar Airport'),
(19, 'Barisal Airport'),
(22, 'Shah Amanat International Airport'),
(23, 'Jessore Airport'),
(24, 'Shah Makhdum Airport'),
(25, 'Saidpur Airport'),
(26, 'Osmani International Airport'),
(27, 'Hazrat Shahjalal International Airport'),
(28, 'Ishwardi Airport'),
(29, 'Singapore Changi Airport'),
(30, 'Hamad International Airport'),
(31, 'Tokyo Haneda International Airport'),
(32, 'Incheon International Airport'),
(33, 'Instanbul Airport'),
(34, 'Zurich Airport'),
(35, 'Madrid Barajas Airport'),
(36, 'King Fahd International Airport'),
(37, 'Indira Gandhi International Airport'),
(38, 'Paris Charles de Gaulle Airport'),
(39, 'Heathrow Airport'),
(40, 'Istanbul Airport'),
(41, 'Los Angeles International Airport');

-- --------------------------------------------------------

--
-- Table structure for table `booked`
--

CREATE TABLE `booked` (
  `id` int(11) NOT NULL,
  `flight_id` int(11) DEFAULT NULL,
  `customer_email` char(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booked`
--

INSERT INTO `booked` (`id`, `flight_id`, `customer_email`) VALUES
(219, 35, 'hellomiskat@gmail.com'),
(231, 36, 'hellomiskat@gmail.com'),
(232, 35, 'shakib@gmail.com'),
(233, 36, 'shakib@gmail.com'),
(235, 37, 'shakib@gmail.com'),
(236, 36, 'asir@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `first_name` char(40) DEFAULT NULL,
  `last_name` char(40) DEFAULT NULL,
  `customer_name` char(40) DEFAULT NULL,
  `email` char(40) NOT NULL,
  `phone` int(11) DEFAULT NULL,
  `gender` char(40) DEFAULT NULL,
  `pass` char(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`first_name`, `last_name`, `customer_name`, `email`, `phone`, `gender`, `pass`) VALUES
('Afifa', 'Hoque', 'afifa', 'afifa@gmail.com', 5841321, 'female', 'a'),
('Akib', 'Abdullah', 'Akib', 'akib@gmail.com', 21121, 'male', 'a'),
('Apurba', 'Kumar', 'apurba', 'apurba@gmail.com', 1465464, 'male', 'a'),
('Ashab', 'Asir', 'asir', 'asir@gmail.com', 22411255, 'male', 'a'),
('Mishkatul', 'Islam', 'mishkat', 'hellomiskat@gmail.com', 1610245263, 'male', 'a'),
('Penelope', 'Haley', 'jikun', 'hoduvy@mailinator.com', 82, 'female', 'Pa$$w0rd!'),
('Celeste', 'Mcclain', 'fyhil', 'latonat@mailinator.com', 72, 'male', 'Pa$$w0rd!'),
('Pankaj', 'Rudra', 'pankaj', 'pankaj@gmail.com', 1121, 'male', 'a'),
('Ruhul', 'Amin', 'ruhul', 'ruhul@gmail.com', 12345678, 'male', 'a'),
('Brent', 'Knapp', 's', 's@s.com', 52, 'male', 's'),
('Shakib', 'Hossain', 'sakib', 'sakib@gmai.com', 1234546, 'male', 'a'),
('Shakib', 'Hossain', 'shakib', 'shakib@gmail.com', 12345678, 'male', 'a'),
('Sobhan', 'S.', 'sobhan', 'sobhan@gmail.com', 541424, 'male', 'a'),
('Suvo', 'S.', 'suvo', 'suvo@gmail.com', 125444, 'male', 'a'),
('Tainur', 't.', 'tainur', 'tainur@gmail.com', 125444, 'male', 'a');

-- --------------------------------------------------------

--
-- Table structure for table `flight`
--

CREATE TABLE `flight` (
  `id` int(11) NOT NULL,
  `source_date` date DEFAULT NULL,
  `source_time` time DEFAULT NULL,
  `dest_date` date DEFAULT NULL,
  `dest_time` time DEFAULT NULL,
  `dep_airport` char(40) DEFAULT NULL,
  `arr_airport` char(40) DEFAULT NULL,
  `seats` int(11) DEFAULT NULL,
  `price` decimal(12,2) DEFAULT NULL,
  `flight_class` char(40) DEFAULT NULL,
  `airline_name` char(40) DEFAULT NULL,
  `dep_airport_id` int(11) DEFAULT NULL,
  `arr_airport_id` int(11) DEFAULT NULL,
  `airline_email` char(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `flight`
--

INSERT INTO `flight` (`id`, `source_date`, `source_time`, `dest_date`, `dest_time`, `dep_airport`, `arr_airport`, `seats`, `price`, `flight_class`, `airline_name`, `dep_airport_id`, `arr_airport_id`, `airline_email`) VALUES
(35, '2023-09-22', '04:00:00', '2023-10-07', '18:00:00', 'Shah Amanat International Airport', ' Dhaka Airport', 25, 750.00, 'Economy', 'Biman Bangladesh', 22, 17, 'bimanbangladesh@gmail.com'),
(36, '2023-10-12', '09:45:00', '2023-11-23', '00:00:00', 'Cox’s Bazar Airport', 'Singapore Changi Airport', 45, 3500.00, 'First Class', 'Biman Bangladesh', 18, 29, 'bimanbangladesh@gmail.com'),
(37, '2023-09-20', '06:52:00', '2023-11-30', '03:56:00', 'Jessore Airport', 'King Fahd International Airport', 60, 2900.00, 'Business', 'Qatar Airways', 23, 36, 'Qatarairways@gmail.com'),
(38, '2023-09-22', '13:03:00', '2023-11-25', '07:25:00', 'Shah Amanat International Airport', ' Dhaka Airport', 25, 1000.00, 'Economy', 'Air Asia', 22, 17, 'airasia@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `airline`
--
ALTER TABLE `airline`
  ADD PRIMARY KEY (`email`),
  ADD UNIQUE KEY `airline_name` (`airline_name`);

--
-- Indexes for table `airport`
--
ALTER TABLE `airport`
  ADD PRIMARY KEY (`airport_id`);

--
-- Indexes for table `booked`
--
ALTER TABLE `booked`
  ADD PRIMARY KEY (`id`),
  ADD KEY `flight_id` (`flight_id`),
  ADD KEY `customer_email` (`customer_email`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `flight`
--
ALTER TABLE `flight`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dep_airport_id` (`dep_airport_id`),
  ADD KEY `arr_airport_id` (`arr_airport_id`),
  ADD KEY `airline_email` (`airline_email`),
  ADD KEY `airline_name` (`airline_name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `airport`
--
ALTER TABLE `airport`
  MODIFY `airport_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `booked`
--
ALTER TABLE `booked`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=237;

--
-- AUTO_INCREMENT for table `flight`
--
ALTER TABLE `flight`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booked`
--
ALTER TABLE `booked`
  ADD CONSTRAINT `booked_ibfk_1` FOREIGN KEY (`flight_id`) REFERENCES `flight` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `booked_ibfk_2` FOREIGN KEY (`customer_email`) REFERENCES `customer` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `flight`
--
ALTER TABLE `flight`
  ADD CONSTRAINT `flight_ibfk_1` FOREIGN KEY (`dep_airport_id`) REFERENCES `airport` (`airport_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `flight_ibfk_2` FOREIGN KEY (`arr_airport_id`) REFERENCES `airport` (`airport_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `flight_ibfk_3` FOREIGN KEY (`airline_email`) REFERENCES `airline` (`email`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `flight_ibfk_4` FOREIGN KEY (`airline_name`) REFERENCES `airline` (`airline_name`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

CREATE TABLE `payment` (
  `card_no` varchar(16) NOT NULL,
  `user_id` int(11) NOT NULL,
  `flight_id` int(11) NOT NULL,
  `expire_date` varchar(5) DEFAULT NULL,
  `amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`card_no`, `user_id`, `flight_id`, `expire_date`, `amount`) VALUES
('1010555677851111', 4, 2, '10/26', 370),
('1020445869651011', 2, 20, '12/25', 370),
('1111888889897778', 2, 3, '12/25', 205),
('1400565800004478', 2, 8, '12/25', 1230),
('1458799990001450', 3, 2, '12/25', 185),
('4204558500014587', 1, 1, '02/25', 350);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
