-- phpMyAdmin SQL Dump --m.2a*Z!#mV!9vWH
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: mysql-neverlanes.alwaysdata.net
-- Generation Time: Nov 20, 2023 at 08:50 PM
-- Server version: 10.6.14-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `neverlanes_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `CLIENTS`
--

CREATE TABLE `CLIENTS` (
  `client_id` int(5) NOT NULL,
  `username` varchar(30) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(30) NOT NULL,
  `role` varchar(30) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `CLIENTS`
--

INSERT INTO `CLIENTS` (`client_id`, `username`, `first_name`, `last_name`, `email`, `password`, `role`) VALUES
(1, 'DoryDi', 'Dorel', 'Dimiu', 'dorel.dimiu@yahoo.com', 'parolaDorel', 'user'),
(3, 'cristiii', 'Cristiana', 'Cocheci', 'cristiana_c@gmail.com', 'HelloWordle', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `DRIVERS`
--

CREATE TABLE `DRIVERS` (
  `driver_id` int(5) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `salary` int(10) DEFAULT NULL,
  `client_id` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `DRIVERS`
--

INSERT INTO `DRIVERS` (`driver_id`, `first_name`, `last_name`, `salary`, `client_id`) VALUES
(1, 'Marius', 'Manole', 3000, NULL),
(2, 'Jesus', 'Christ', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `LOCATIONS`
--

CREATE TABLE `LOCATIONS` (
  `location_id` int(5) NOT NULL,
  `location_name` varchar(30) NOT NULL,
  `adress` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `LOCATIONS`
--

INSERT INTO `LOCATIONS` (`location_id`, `location_name`, `adress`) VALUES
(1, 'Garden Of Eden', 'Heaven no. 0'),
(2, 'Cloud 9', 'sky, no. 9'),
(3, 'Earth Gate', 'sky, no.1'),
(4, 'Mount Olympus Heights', 'Celestial Way, Olympus'),
(5, 'Athena\'s Wisdom Academy', '42 Owl Avenue, Athens'),
(6, 'Hades\' Stygian Sanctum', '666 Underworld Lane, Tartarus'),
(7, 'Apollo\'s Sunlit Studios', '7 Golden Ray Road, Delphi'),
(8, 'Artemis\' Silver Bow Retreat', '9 Moonlit Grove, Arcadia'),
(9, 'Poseidon\'s Oceanfront Palace', '20 Trident Lane, Atlantis'),
(10, 'Hera\'s Eternal Matrimony Manor', '5 Peacock Promenade, Thebes'),
(11, 'Dionysus\' Grapevine Grove', '18 Bacchus Boulevard, Naxos'),
(12, 'Hermes\' Winged Courier Service', 'Hermes Express, Olympian Way'),
(13, 'Zeus\' Thunderbolt Forge', '3 Lightning Lane, Elysium');

-- --------------------------------------------------------

--
-- Table structure for table `ROUTES`
--

CREATE TABLE `ROUTES` (
  `route_id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `length` int(5) NOT NULL DEFAULT 0,
  `no_stops` int(5) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ROUTES`
--

INSERT INTO `ROUTES` (`route_id`, `name`, `length`, `no_stops`) VALUES
(1, 'NEVERLANE', 10, 3),
(2, 'Go the distance', 1902, 10);

-- --------------------------------------------------------

--
-- Table structure for table `STOPS`
--

CREATE TABLE `STOPS` (
  `stop_id` int(5) NOT NULL,
  `location_id` int(5) NOT NULL,
  `name` varchar(30) NOT NULL,
  `route_id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `STOPS`
--

INSERT INTO `STOPS` (`stop_id`, `location_id`, `name`, `route_id`) VALUES
(1, 2, 'Cloud 9', 1),
(2, 3, 'Earth Gate', 1),
(3, 1, 'Garden of Eden', 1),
(4, 4, 'Mount Olympus Heights', 2),
(5, 5, 'Athena\'s Wisdom Academy', 2),
(6, 6, 'Hades\' Stygian Sanctum', 2),
(7, 7, 'Apollo\'s Sunlit Studios', 2),
(8, 8, 'Artemis\' Silver Bow Retreat', 2),
(9, 9, 'Poseidon\'s Oceanfront Palace', 2),
(10, 10, 'Hera\'s Eternal Matrimony Manor', 2),
(11, 11, 'Dionysus\' Grapevine Grove', 2),
(12, 12, 'Hermes\' Winged Courier Service', 2),
(13, 13, 'Zeus\' Thunderbolt Forge', 2);

-- --------------------------------------------------------

--
-- Table structure for table `TICKETS`
--

CREATE TABLE `TICKETS` (
  `ticket_id` int(10) NOT NULL,
  `type_id` int(5) NOT NULL,
  `client_id` int(5) NOT NULL,
  `purchase_date` date NOT NULL DEFAULT current_timestamp(),
  `activation_date` date DEFAULT NULL,
  `expiry_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `TICKETS_TYPES`
--

CREATE TABLE `TICKETS_TYPES` (
  `type_id` int(10) NOT NULL,
  `type_name` varchar(30) NOT NULL,
  `valability` int(5) NOT NULL,
  `price` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `VEHICLES`
--

CREATE TABLE `VEHICLES` (
  `vehicle_id` int(5) NOT NULL,
  `vehicle_type` int(5) NOT NULL,
  `driver_id` int(5) DEFAULT NULL,
  `route_id` int(5) DEFAULT NULL,
  `position_id` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `VEHICLES`
--

INSERT INTO `VEHICLES` (`vehicle_id`, `vehicle_type`, `driver_id`, `route_id`, `position_id`) VALUES
(1, 2, 2, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `VEHICLE_TYPE`
--

CREATE TABLE `VEHICLE_TYPE` (
  `type_id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL DEFAULT 'Bus',
  `date` date NOT NULL DEFAULT current_timestamp(),
  `gas_capacity` int(30) NOT NULL DEFAULT 200
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `VEHICLE_TYPE`
--

INSERT INTO `VEHICLE_TYPE` (`type_id`, `name`, `date`, `gas_capacity`) VALUES
(1, 'Bus', '2023-11-20', 200),
(2, 'Tram', '2023-11-20', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `CLIENTS`
--
ALTER TABLE `CLIENTS`
  ADD PRIMARY KEY (`client_id`,`username`);

--
-- Indexes for table `DRIVERS`
--
ALTER TABLE `DRIVERS`
  ADD PRIMARY KEY (`driver_id`),
  ADD KEY `FK_drivers_clients` (`client_id`);

--
-- Indexes for table `LOCATIONS`
--
ALTER TABLE `LOCATIONS`
  ADD PRIMARY KEY (`location_id`);

--
-- Indexes for table `ROUTES`
--
ALTER TABLE `ROUTES`
  ADD PRIMARY KEY (`route_id`);

--
-- Indexes for table `STOPS`
--
ALTER TABLE `STOPS`
  ADD PRIMARY KEY (`stop_id`),
  ADD KEY `FK_LOCATII_STATII` (`location_id`),
  ADD KEY `FK_ROUTE_STOP` (`route_id`);

--
-- Indexes for table `TICKETS`
--
ALTER TABLE `TICKETS`
  ADD PRIMARY KEY (`ticket_id`),
  ADD KEY `FK_TICKETS` (`client_id`),
  ADD KEY `FK_TYPE` (`type_id`);

--
-- Indexes for table `TICKETS_TYPES`
--
ALTER TABLE `TICKETS_TYPES`
  ADD PRIMARY KEY (`type_id`);

--
-- Indexes for table `VEHICLES`
--
ALTER TABLE `VEHICLES`
  ADD PRIMARY KEY (`vehicle_id`),
  ADD KEY `FK_vehicles_drivers` (`driver_id`),
  ADD KEY `FK_position_locations` (`position_id`),
  ADD KEY `FK_route_vehicle` (`route_id`),
  ADD KEY `FK_vehicle_type` (`vehicle_type`);

--
-- Indexes for table `VEHICLE_TYPE`
--
ALTER TABLE `VEHICLE_TYPE`
  ADD PRIMARY KEY (`type_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `CLIENTS`
--
ALTER TABLE `CLIENTS`
  MODIFY `client_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `DRIVERS`
--
ALTER TABLE `DRIVERS`
  MODIFY `driver_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `LOCATIONS`
--
ALTER TABLE `LOCATIONS`
  MODIFY `location_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `ROUTES`
--
ALTER TABLE `ROUTES`
  MODIFY `route_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `STOPS`
--
ALTER TABLE `STOPS`
  MODIFY `stop_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `TICKETS`
--
ALTER TABLE `TICKETS`
  MODIFY `ticket_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `TICKETS_TYPES`
--
ALTER TABLE `TICKETS_TYPES`
  MODIFY `type_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `VEHICLES`
--
ALTER TABLE `VEHICLES`
  MODIFY `vehicle_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `VEHICLE_TYPE`
--
ALTER TABLE `VEHICLE_TYPE`
  MODIFY `type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `DRIVERS`
--
ALTER TABLE `DRIVERS`
  ADD CONSTRAINT `FK_drivers_clients` FOREIGN KEY (`client_id`) REFERENCES `CLIENTS` (`client_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `STOPS`
--
ALTER TABLE `STOPS`
  ADD CONSTRAINT `FK_LOCATII_STATII` FOREIGN KEY (`location_id`) REFERENCES `LOCATIONS` (`location_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_ROUTE_STOP` FOREIGN KEY (`route_id`) REFERENCES `ROUTES` (`route_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `TICKETS`
--
ALTER TABLE `TICKETS`
  ADD CONSTRAINT `FK_TICKETS` FOREIGN KEY (`client_id`) REFERENCES `CLIENTS` (`client_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_TYPE` FOREIGN KEY (`type_id`) REFERENCES `TICKETS_TYPES` (`type_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `VEHICLES`
--
ALTER TABLE `VEHICLES`
  ADD CONSTRAINT `FK_position_locations` FOREIGN KEY (`position_id`) REFERENCES `LOCATIONS` (`location_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_route_vehicle` FOREIGN KEY (`route_id`) REFERENCES `ROUTES` (`route_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_vehicle_type` FOREIGN KEY (`vehicle_type`) REFERENCES `VEHICLE_TYPE` (`type_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_vehicles_drivers` FOREIGN KEY (`driver_id`) REFERENCES `DRIVERS` (`driver_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
