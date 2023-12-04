-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Dec 03, 2023 at 09:13 AM
-- Server version: 5.7.39
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projet`
--

-- --------------------------------------------------------

--
-- Table structure for table `Admins`
--

CREATE TABLE `Admins` (
  `AdminID` int(11) NOT NULL,
  `NomAdmin` varchar(50) DEFAULT NULL,
  `PrenomAdmin` varchar(50) DEFAULT NULL,
  `EmailAdmin` varchar(100) DEFAULT NULL,
  `MotDePasse` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `idclient` int(11) NOT NULL,
  `nom` text NOT NULL,
  `prenom` text NOT NULL,
  `email` text NOT NULL,
  `tel` varchar(13) NOT NULL,
  `mot_de_passe` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`idclient`, `nom`, `prenom`, `email`, `tel`, `mot_de_passe`) VALUES
(1, 'REMY', 'Mhenni', 'ali@gmail.com', '213557753781', 'ztgyrryurioio'),
(3, 'REMY', 'fzejflkdj', 'abdoussamad1952@gmail.com', '213557753781', '$2y$10$CwSg3X51jP.5bHVwGdVMTOyc5KGvX/QGeowqLmlBhZSyh7w7SbbhG'),
(4, 'REMY', 'hj', 'Benz.abdelbasset@gmail.com', '213557753781', '$2y$10$UF/9O5/kwFTRcuDACn/QbOztG7ct.w.1aFcQsQXEB4S8z1irpusOa'),
(5, 'REMY', 'Mhenni', 'alhousseiniabdoussamadag@gmail.com', '213557753781', '$2y$10$F1m2wHAJ46kjjYAMM9GU0uvVvRu.p3nFaLN6E4AS9Gz9So9eqDnp2'),
(6, 'REMY', 'Mhenni', 'jack@gmail.com', '213557753781', '$2y$10$rFwiH3/50KDDmU5SkgIFLOI4Ci/au1hDxXxjDHH4u/49y8K/rm736'),
(7, 'REMY', 'fzejflkdj', 'Bnz.abdelbasset@gmail.com', '213557753781', '$2y$10$ym6D2R6sykkTwxmRJ7IAFuLo8cUP./y/jBNR7d0lw.BipYRQ1HT0q'),
(8, 'lamia', 'marc', 'jck@gmail.com', '213557753781', '$2y$10$ctZl5uh8ECKoQQUNDu7r8uqX/CDFqSumEv9XXOop/.xjbBVpGqWCu'),
(9, 'moussa', 'Ali', 'alhoussiniabdoussamadag@gmail.com', '213557753781', '$2y$10$CpmL65AwxgnxSNMAQBhsVulhADZOsZwm8bpJRfu.RkqMveuqUX6iq'),
(10, 'Moussa', 'Ahmed', 'hali@gmail.com', '0022391427701', '$2y$10$UotapBD/25LWR3wtFicV6.HPSVbqP8wEhdkh6jvHI4FYDwyjQKApu'),
(11, 'Mohamed', 'oumar', 'mossa@gmail.COM', '213557753781', '$2y$10$G0IQPAfyjiaOZPpYMOVkVul.tsbqaTNL8ySmeVLFLfQ2S7EEKnRia');

-- --------------------------------------------------------

--
-- Table structure for table `Commentaires`
--

CREATE TABLE `Commentaires` (
  `CommentaireID` int(11) NOT NULL,
  `idclient` int(11) DEFAULT NULL,
  `DestinationID` int(11) DEFAULT NULL,
  `DateCommentaire` date DEFAULT NULL,
  `Commentaire` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `Destinations`
--

CREATE TABLE `Destinations` (
  `DestinationID` int(11) NOT NULL,
  `NomDestination` varchar(100) DEFAULT NULL,
  `Description` text,
  `Prix` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `Notations`
--

CREATE TABLE `Notations` (
  `NotationID` int(11) NOT NULL,
  `idclient` int(11) DEFAULT NULL,
  `DestinationID` int(11) DEFAULT NULL,
  `Note` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `ReservationsHotels`
--

CREATE TABLE `ReservationsHotels` (
  `ReservationHotelID` int(11) NOT NULL,
  `idclient` int(11) DEFAULT NULL,
  `DestinationID` int(11) DEFAULT NULL,
  `DateDebut` date DEFAULT NULL,
  `DateFin` date DEFAULT NULL,
  `NombrePersonnes` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `ReservationsVols`
--

CREATE TABLE `ReservationsVols` (
  `ReservationVolID` int(11) NOT NULL,
  `idclient` int(11) DEFAULT NULL,
  `DestinationID` int(11) DEFAULT NULL,
  `DateDepart` date DEFAULT NULL,
  `DateRetour` date DEFAULT NULL,
  `NombrePassagers` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Admins`
--
ALTER TABLE `Admins`
  ADD PRIMARY KEY (`AdminID`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`idclient`);

--
-- Indexes for table `Commentaires`
--
ALTER TABLE `Commentaires`
  ADD PRIMARY KEY (`CommentaireID`),
  ADD KEY `idclient` (`idclient`),
  ADD KEY `DestinationID` (`DestinationID`);

--
-- Indexes for table `Destinations`
--
ALTER TABLE `Destinations`
  ADD PRIMARY KEY (`DestinationID`);

--
-- Indexes for table `Notations`
--
ALTER TABLE `Notations`
  ADD PRIMARY KEY (`NotationID`),
  ADD KEY `idclient` (`idclient`),
  ADD KEY `DestinationID` (`DestinationID`);

--
-- Indexes for table `ReservationsHotels`
--
ALTER TABLE `ReservationsHotels`
  ADD PRIMARY KEY (`ReservationHotelID`),
  ADD KEY `idclient` (`idclient`),
  ADD KEY `DestinationID` (`DestinationID`);

--
-- Indexes for table `ReservationsVols`
--
ALTER TABLE `ReservationsVols`
  ADD PRIMARY KEY (`ReservationVolID`),
  ADD KEY `idclient` (`idclient`),
  ADD KEY `DestinationID` (`DestinationID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Admins`
--
ALTER TABLE `Admins`
  MODIFY `AdminID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `idclient` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `Commentaires`
--
ALTER TABLE `Commentaires`
  MODIFY `CommentaireID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Destinations`
--
ALTER TABLE `Destinations`
  MODIFY `DestinationID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Notations`
--
ALTER TABLE `Notations`
  MODIFY `NotationID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ReservationsHotels`
--
ALTER TABLE `ReservationsHotels`
  MODIFY `ReservationHotelID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ReservationsVols`
--
ALTER TABLE `ReservationsVols`
  MODIFY `ReservationVolID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Commentaires`
--
ALTER TABLE `Commentaires`
  ADD CONSTRAINT `commentaires_ibfk_1` FOREIGN KEY (`idclient`) REFERENCES `Clients` (`idclient`),
  ADD CONSTRAINT `commentaires_ibfk_2` FOREIGN KEY (`DestinationID`) REFERENCES `Destinations` (`DestinationID`);

--
-- Constraints for table `Notations`
--
ALTER TABLE `Notations`
  ADD CONSTRAINT `notations_ibfk_1` FOREIGN KEY (`idclient`) REFERENCES `Clients` (`idclient`),
  ADD CONSTRAINT `notations_ibfk_2` FOREIGN KEY (`DestinationID`) REFERENCES `Destinations` (`DestinationID`);

--
-- Constraints for table `ReservationsHotels`
--
ALTER TABLE `ReservationsHotels`
  ADD CONSTRAINT `reservationshotels_ibfk_1` FOREIGN KEY (`idclient`) REFERENCES `Clients` (`idclient`),
  ADD CONSTRAINT `reservationshotels_ibfk_2` FOREIGN KEY (`DestinationID`) REFERENCES `Destinations` (`DestinationID`);

--
-- Constraints for table `ReservationsVols`
--
ALTER TABLE `ReservationsVols`
  ADD CONSTRAINT `reservationsvols_ibfk_1` FOREIGN KEY (`idclient`) REFERENCES `Clients` (`idclient`),
  ADD CONSTRAINT `reservationsvols_ibfk_2` FOREIGN KEY (`DestinationID`) REFERENCES `Destinations` (`DestinationID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
