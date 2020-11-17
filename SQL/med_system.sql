-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 26, 2020 at 09:31 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `med_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `doctori`
--

CREATE TABLE `doctori` (
  `id` int(11) NOT NULL,
  `user` varchar(255) NOT NULL,
  `parola` varchar(255) NOT NULL,
  `nume_prenume` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `doctori`
--

INSERT INTO `doctori` (`id`, `user`, `parola`, `nume_prenume`, `email`) VALUES
(2, 'urdea', 'f9f16d97c90d8c6f2cab37bb6d1f1992', 'Mihaela Urdea', 'urdea@gmail.com'),
(3, 'bodea', '098f6bcd4621d373cade4e832627b4f6', 'Bodea Alexandra', 'bodea_alexandra@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `pacienti`
--

CREATE TABLE `pacienti` (
  `id` int(11) NOT NULL,
  `nume_prenume` varchar(255) NOT NULL,
  `adresa` varchar(255) NOT NULL,
  `telefon` varchar(15) NOT NULL,
  `email` varchar(255) NOT NULL,
  `alergii` varchar(255) DEFAULT NULL,
  `formular` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pacienti`
--

INSERT INTO `pacienti` (`id`, `nume_prenume`, `adresa`, `telefon`, `email`, `alergii`, `formular`) VALUES
(34, 'Douda Andreea-Denisa', 'B-dul 1 Decembrie 1918 nr. 124 ', '0737817881', 'fatacuciocolata@gmail.com', 'nu', NULL),
(35, 'Neacșu Daniel', 'Strada Eroilor 378c', '0741307106', 'rfksna@gmail.com', 'da, la gluten', NULL),
(36, 'Horvath Angela', 'B-dul 1 Dec. 1019', '0732241842', 'horvath@yahoo.com', 'nu', NULL),
(37, 'Popescu Dana', 'Strada Trandafirilor nr. 87', '0744221378', 'popescu@yahoo.com', 'da, la anestezie', NULL),
(38, 'Oprea Daniela', 'B-dul 21 Dec. nr 178', '0738218222', 'oprea@gmail.com', 'nu', NULL),
(39, 'Pop Darius', 'Strada Bucuresti nr 108', '0722112233', 'popd@gmail.com', 'nu', NULL),
(40, 'Silviu Dragota', 'Strada Miraslau nr 178', '0732271893', 'silviu@gmail.com', 'nu', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pacienti_tratamente`
--

CREATE TABLE `pacienti_tratamente` (
  `id` int(11) NOT NULL,
  `id_pacient` int(11) NOT NULL,
  `id_doctor` int(11) NOT NULL,
  `nume` varchar(255) NOT NULL,
  `data` int(11) NOT NULL,
  `descriere_interventie` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pacienti_tratamente`
--

INSERT INTO `pacienti_tratamente` (`id`, `id_pacient`, `id_doctor`, `nume`, `data`, `descriere_interventie`) VALUES
(49, 34, 2, 'Extractie masea de minte', 1581462000, 'S-a descurcat bine.'),
(51, 35, 2, 'Detartraj', 1593122400, '+airflow'),
(53, 34, 2, 'Alergie la anestezie', 1592949600, 'Pacientul a dezvoltat alergie la anestezie, a se verifica cu atentie peste 2 saptamani.');

-- --------------------------------------------------------

--
-- Table structure for table `programari`
--

CREATE TABLE `programari` (
  `id` int(11) NOT NULL,
  `data` int(11) NOT NULL,
  `ora` varchar(255) NOT NULL,
  `id_pacient` int(11) NOT NULL,
  `id_doctor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `programari`
--

INSERT INTO `programari` (`id`, `data`, `ora`, `id_pacient`, `id_doctor`) VALUES
(26, 1592949600, '16:16', 34, 2),
(27, 1593208800, '10:45', 34, 2),
(28, 1593122400, '10:45', 35, 2),
(29, 1595541600, '10:30', 38, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `doctori`
--
ALTER TABLE `doctori`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pacienti`
--
ALTER TABLE `pacienti`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pacienti_tratamente`
--
ALTER TABLE `pacienti_tratamente`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pacient` (`id_pacient`),
  ADD KEY `id_doctor` (`id_doctor`);

--
-- Indexes for table `programari`
--
ALTER TABLE `programari`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_doctor` (`id_doctor`),
  ADD KEY `id_pacient` (`id_pacient`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `doctori`
--
ALTER TABLE `doctori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pacienti`
--
ALTER TABLE `pacienti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `pacienti_tratamente`
--
ALTER TABLE `pacienti_tratamente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `programari`
--
ALTER TABLE `programari`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pacienti_tratamente`
--
ALTER TABLE `pacienti_tratamente`
  ADD CONSTRAINT `pacienti_tratamente_ibfk_1` FOREIGN KEY (`id_pacient`) REFERENCES `pacienti` (`id`),
  ADD CONSTRAINT `pacienti_tratamente_ibfk_2` FOREIGN KEY (`id_doctor`) REFERENCES `doctori` (`id`);

--
-- Constraints for table `programari`
--
ALTER TABLE `programari`
  ADD CONSTRAINT `programari_ibfk_1` FOREIGN KEY (`id_doctor`) REFERENCES `doctori` (`id`),
  ADD CONSTRAINT `programari_ibfk_2` FOREIGN KEY (`id_pacient`) REFERENCES `pacienti` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
