-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 15, 2023 at 09:28 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vintage`
--

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `E_id` int(4) NOT NULL,
  `name_` varchar(25) NOT NULL,
  `phone` int(10) NOT NULL,
  `designation` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`E_id`, `name_`, `phone`, `designation`) VALUES
(1000, 'Plato', 783759265, 'Engine works');

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `date_invoiced` date NOT NULL,
  `invoice` varchar(100) NOT NULL,
  `plate` varchar(7) NOT NULL,
  `car_owner` varchar(25) NOT NULL,
  `contact` int(10) NOT NULL,
  `servicing` varchar(100) NOT NULL,
  `amount` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`date_invoiced`, `invoice`, `plate`, `car_owner`, `contact`, `servicing`, `amount`) VALUES
('2023-01-14', '63c3034f21d5a', 'KLP283P', 'Lesley', 783647238, 'Seats', 9868),
('2023-01-14', '63c303eb50904', 'KSD876G', 'Ken', 735134862, 'Lights', 15000),
('2023-01-15', '63c3b22a8314d', 'KDE873J', 'Allan', 734558835, 'Loose steering', 6000);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `uuid` int(3) NOT NULL,
  `username` varchar(15) NOT NULL,
  `passcode` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uuid`, `username`, `passcode`) VALUES
(1, 'admin', 'ee10c315eba2c75b403ea99136f5b48d'),
(2, 'trial', '58723627fcebc230ab0d53ddf5f16e34'),
(3, 'trouble', 'e7956178e76c787c0a2407864ff39d67');

-- --------------------------------------------------------

--
-- Table structure for table `vehiclegone`
--

CREATE TABLE `vehiclegone` (
  `leave_id` int(11) NOT NULL,
  `date_left` date NOT NULL,
  `plate` varchar(7) NOT NULL,
  `car_owner` varchar(25) NOT NULL,
  `payment` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vehiclegone`
--

INSERT INTO `vehiclegone` (`leave_id`, `date_left`, `plate`, `car_owner`, `payment`) VALUES
(1, '2023-01-14', 'KDK234I', 'Dan', 'Received'),
(2, '2023-01-14', 'KHP239F', 'David', 'Pending'),
(3, '2023-01-14', 'KLK273G', 'Gary', 'Received'),
(5, '2023-01-13', 'KSD647L', 'Sam', 'Received'),
(6, '2023-01-14', 'KLP283P', 'Lesley', 'Received'),
(7, '2023-01-14', 'KSD876G', 'Ken', 'Pending'),
(8, '2023-01-15', 'KDE873J', 'Allan', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `vehicles`
--

CREATE TABLE `vehicles` (
  `plate` varchar(7) NOT NULL,
  `model` varchar(30) NOT NULL,
  `car_owner` varchar(25) NOT NULL,
  `phone` int(10) NOT NULL,
  `issue` varchar(100) NOT NULL,
  `fixed` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vehicles`
--

INSERT INTO `vehicles` (`plate`, `model`, `car_owner`, `phone`, `issue`, `fixed`) VALUES
('KJF293P', 'Toyota Belta', 'Kim', 783759265, 'Changing oil', 'No'),
('KUJ239H', 'Mitsubishi Lancer', 'Lionel', 782832949, 'Changing oil', 'No');

-- --------------------------------------------------------

--
-- Table structure for table `vehiclesfixed`
--

CREATE TABLE `vehiclesfixed` (
  `plate` varchar(7) NOT NULL,
  `model` varchar(30) NOT NULL,
  `car_owner` varchar(25) NOT NULL,
  `phone` int(10) NOT NULL,
  `issue` varchar(100) NOT NULL,
  `fixed` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`E_id`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`invoice`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`uuid`);

--
-- Indexes for table `vehiclegone`
--
ALTER TABLE `vehiclegone`
  ADD PRIMARY KEY (`leave_id`);

--
-- Indexes for table `vehicles`
--
ALTER TABLE `vehicles`
  ADD PRIMARY KEY (`plate`);

--
-- Indexes for table `vehiclesfixed`
--
ALTER TABLE `vehiclesfixed`
  ADD PRIMARY KEY (`plate`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `uuid` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `vehiclegone`
--
ALTER TABLE `vehiclegone`
  MODIFY `leave_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
