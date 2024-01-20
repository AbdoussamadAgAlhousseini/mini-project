-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le : mar. 09 jan. 2024 à 18:08
-- Version du serveur : 5.7.39
-- Version de PHP : 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `projet`
--

-- --------------------------------------------------------

--
-- Structure de la table `Admins`
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
-- Structure de la table `clients`
--

CREATE TABLE `clients` (
  `idclient` int(11) NOT NULL,
  `nom` text NOT NULL,
  `prenom` text NOT NULL,
  `email` text NOT NULL,
  `tel` varchar(13) NOT NULL,
  `mot_de_passe` text NOT NULL,
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `clients`
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
(11, 'Mohamed', 'oumar', 'mossa@gmail.COM', '213557753781', '$2y$10$G0IQPAfyjiaOZPpYMOVkVul.tsbqaTNL8ySmeVLFLfQ2S7EEKnRia'),
(12, 'mehenni', 'remy', 'jsdfijnsq@gmail.com', '0667682892', '$2y$10$3P1zuu8TiFRucFLAFn748uBEVMbJgLhu7g5dyzUxuobDmBXTji01i'),
(13, 'boss', 'benz', 'bz@gmail.com', '213665655436', '$2y$10$jxWJOCfO/c3KTaji1b3dZucd2wWcVdKjM1YSQSJWLxR5Zf91RnPgC'),
(14, 'Azi', 'Maha', 'azi@gmail.com', '213557753781', '$2y$10$IQYv3sys129pSpUa5F4nWOTDBOo2MSY2NgB6jRBUnYabpYI0xEhEO'),
(15, 'aicha', 'trembler', 'aicha@gmail.com', '213557753781', '$2y$10$KeuLK6a0rjkxVvnQMYtpXeGw20SVLuX3gx8wJQ9Wqasw3z57Fx8iy'),
(16, 'cr', 'king', 'cr7@gmail.com', '003557753781', '$2y$10$3aLzrpZ5fd7pfLCQm.iwS.WPVAoyMKAWjYuAMGq6cwm8sMHoQdT06'),
(17, 'MAIGA', 'hj', 'nvprofil@gmail.com', '076543223', '$2y$10$OqlryJAFEarsUC.if.djxeRBd8NPKYyExI3fGLhdqBR6MBQmPgGRe');

-- --------------------------------------------------------

--
-- Structure de la table `Commentaires`
--

CREATE TABLE `Commentaires` (
  `CommentaireID` int(11) NOT NULL,
  `idclient` int(11) DEFAULT NULL,
  `DestinationID` int(11) DEFAULT NULL,
  `DateCommentaire` date DEFAULT NULL,
  `Commentaire` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `Commentaires`
--

INSERT INTO `Commentaires` (`CommentaireID`, `idclient`, `DestinationID`, `DateCommentaire`, `Commentaire`) VALUES
(5, 1, 1, '2023-12-24', 'bingo'),
(13, 7, NULL, '2023-12-24', 'c\'est moyenne bien'),
(89, 16, NULL, '2024-01-02', 'qu\'est ce qui ne va pas avec les commentaires'),
(93, 15, NULL, '2024-01-04', 'Quel magnifique service'),
(94, 15, NULL, '2024-01-07', 'salut les commentaires'),
(95, 15, NULL, '2024-01-07', 'je suis disons satisait'),
(96, 15, NULL, '2024-01-07', 'c\'est certainement votre meilleure destination'),
(97, 15, NULL, '2024-01-07', 'ndk');

-- --------------------------------------------------------

--
-- Structure de la table `Destinations`
--

CREATE TABLE `Destinations` (
  `DestinationID` int(11) NOT NULL,
  `NomDestination` varchar(100) DEFAULT NULL,
  `Description` text,
  `Prix` decimal(10,2) DEFAULT NULL,
  `Image` blob
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `Destinations`
--

INSERT INTO `Destinations` (`DestinationID`, `NomDestination`, `Description`, `Prix`, `Image`) VALUES
(1, 'France', 'Pays situé en dont Paris est la capitale', '400.00', 0x696d672f70617269732e6a7067),
(2, 'Allemagne', 'Pays d\'Europe connu pour sa forte économie', '450.00', 0x696d672f616c6c656d61676e652e6a7067),
(3, 'Japon', 'Pays d\'Asie célèbre pour sa culture unique', '550.00', 0x696d672f6a61706f6e2e6a7067),
(4, 'Afrique du Sud', 'Nation africaine avec une diversité géographique et culturelle', '520.00', 0x696d672f6166726971756564757375642e6a7067),
(5, 'Australie', 'Pays d\'Océanie réputé pour sa faune unique', '480.00', 0x696d672f6175737472616c69652e6a7067),
(6, 'Canada', 'Pays d\'Amérique du Nord avec des paysages époustouflants', '600.00', 0x696d672f63616e6164612e6a7067),
(7, 'Inde', 'Grande nation d\'Asie avec une histoire ancienne', '520.00', 0x696d672f696e64652e6a7067),
(8, 'Mexique', 'Pays d\'Amérique latine connu pour sa cuisine savoureuse', '480.00', 0x696d672f6d61726f632e6a7067),
(9, 'Nigeria', 'Pays d\'Afrique de l\'Ouest avec une diversité culturelle', '500.00', 0x696d672f6166726971756564757375642e6a7067),
(10, 'Japon', 'Pays d\'Asie célèbre pour sa culture unique', '550.00', 0x696d672f6a61706f6e2e6a7067),
(11, 'Chine', 'Grande nation asiatique avec une histoire millénaire', '500.00', 0x696d672f6368696e652e6a7067),
(12, 'États-Unis', 'Pays d\'Amérique avec une diversité culturelle remarquable', '600.00', 0x696d672f6e657720796f726b2e6a7067),
(13, 'Brésil', 'Pays d\'Amérique du Sud réputé pour son carnaval animé', '480.00', 0x696d672f62726573696c2e6a7067),
(14, 'Maroc', 'Pays d\'Afrique du Nord connu pour son histoire et ses marchés colorés', '420.00', 0x696d672f6d61726f632e6a7067),
(15, 'Afrique du Sud', 'Nation africaine avec une diversité géographique et culturelle', '520.00', 0x696d672f6175737472616c69652e6a7067),
(16, 'Arabie Saoudite', 'reference en islam', '1000.00', 0x696d672f6d65632e6a7067);

-- --------------------------------------------------------

--
-- Structure de la table `Notations`
--

CREATE TABLE `Notations` (
  `NotationID` int(11) NOT NULL,
  `idclient` int(11) DEFAULT NULL,
  `DestinationID` int(11) DEFAULT NULL,
  `Note` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `Notations`
--

INSERT INTO `Notations` (`NotationID`, `idclient`, `DestinationID`, `Note`) VALUES
(1, 1, 12, 5),
(2, 1, 12, 4),
(3, 1, 12, 4),
(4, 1, 12, 4),
(5, 1, 12, 4),
(9, 15, 16, 5),
(10, 15, 16, 3),
(11, 15, 16, 4),
(12, 15, 16, 4),
(13, 15, 16, 4),
(14, 15, 16, 4),
(15, 15, 16, 4),
(16, 15, 16, 5),
(17, 15, 16, 5),
(18, 15, 16, 4),
(19, 15, 16, 4),
(20, 15, 16, 4),
(21, 15, 16, 3),
(22, 15, 16, 5),
(23, 15, 16, 4),
(24, 15, 16, 5),
(25, 15, NULL, 3),
(26, 15, 13, 1),
(27, 15, 13, 5),
(28, 15, 13, 5),
(29, 15, 13, 3),
(30, 15, 13, 5),
(31, 15, 13, 5),
(32, 15, 13, 5);

-- --------------------------------------------------------

--
-- Structure de la table `ReservationsHotels`
--

CREATE TABLE `ReservationsHotels` (
  `ReservationHotelID` int(11) NOT NULL,
  `idclient` int(11) DEFAULT NULL,
  `DestinationID` int(11) DEFAULT NULL,
  `DateDebut` date DEFAULT NULL,
  `DateFin` date DEFAULT NULL,
  `NombrePersonnes` int(11) DEFAULT NULL,
  `Statut` varchar(50) NOT NULL DEFAULT 'En Attente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `ReservationsHotels`
--

INSERT INTO `ReservationsHotels` (`ReservationHotelID`, `idclient`, `DestinationID`, `DateDebut`, `DateFin`, `NombrePersonnes`, `Statut`) VALUES
(6, 15, 16, '2023-12-22', '2023-12-29', 1, 'En Attente'),
(9, 7, 2, '2023-12-31', '2024-01-07', 1, 'En Attente'),
(10, 7, 2, '2023-12-31', '2024-01-07', 1, 'En Attente'),
(11, 7, 8, '2023-12-02', '2023-12-31', 2, 'En Attente'),
(12, 7, 11, '2023-12-01', '2023-12-31', 1, 'En Attente'),
(13, 16, 14, '2024-01-19', '2024-02-11', 4, 'En Attente'),
(14, 15, 3, '2024-01-27', '2024-02-11', 3, 'Confirmée'),
(15, 17, 1, '2024-01-08', '2024-02-11', 1, 'Confirmée');

-- --------------------------------------------------------

--
-- Structure de la table `ReservationsVols`
--

CREATE TABLE `ReservationsVols` (
  `ReservationVolID` int(11) NOT NULL,
  `idclient` int(11) DEFAULT NULL,
  `DestinationID` int(11) DEFAULT NULL,
  `DateDepart` date DEFAULT NULL,
  `DateRetour` date DEFAULT NULL,
  `NombrePassagers` int(11) DEFAULT NULL,
  `Statut` varchar(50) NOT NULL DEFAULT 'En Attente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `ReservationsVols`
--

INSERT INTO `ReservationsVols` (`ReservationVolID`, `idclient`, `DestinationID`, `DateDepart`, `DateRetour`, `NombrePassagers`, `Statut`) VALUES
(2, 7, 2, '2023-12-01', '2023-12-30', 1, 'Confirmée'),
(3, 13, 4, '2023-12-15', '2023-11-30', 1, 'En Attente'),
(4, 13, 2, '2023-12-02', '2023-12-08', 1, 'En Attente'),
(5, 13, 2, '2023-12-02', '2023-12-08', 1, 'En Attente'),
(6, 13, 2, '2023-12-02', '2023-12-08', 1, 'En Attente'),
(7, 13, 2, '2023-12-02', '2023-12-08', 1, 'En Attente'),
(8, 13, 2, '2023-12-02', '2023-12-08', 1, 'En Attente'),
(9, 10, 1, '2023-12-05', '2023-12-31', 2, 'En Attente'),
(10, 10, 12, '2023-12-09', '2023-12-30', 4, 'En Attente'),
(11, 10, 7, '2023-12-22', '2024-01-27', 12, 'En Attente'),
(12, 10, 6, '2023-12-31', '2024-01-07', 1, 'En Attente'),
(13, 10, 6, '2023-12-31', '2024-01-07', 1, 'En Attente'),
(14, 10, 6, '2023-12-31', '2024-01-07', 1, 'En Attente'),
(15, 10, 3, '2023-12-28', '2023-12-31', 5, 'En Attente'),
(16, 10, 3, '2023-12-28', '2023-12-31', 5, 'En Attente'),
(20, 14, 6, '2023-12-15', '2023-12-29', 4, 'En Attente'),
(21, 14, 6, '2023-12-15', '2023-12-29', 4, 'En Attente'),
(22, 14, 6, '2023-12-15', '2023-12-29', 4, 'En Attente'),
(23, 14, 6, '2023-12-15', '2023-12-29', 4, 'En Attente'),
(24, 14, 7, '2023-12-14', '2023-12-31', 9, 'En Attente'),
(25, 14, 1, '2023-12-14', '2023-12-16', 2, 'En Attente'),
(26, 14, 14, '2023-12-07', '2023-12-13', 1, 'En Attente'),
(27, 15, 2, '2023-12-07', '2023-12-22', 3, 'En Attente'),
(28, 15, 11, '2023-12-22', '2023-12-30', 1, 'En Attente'),
(30, 7, 7, '2023-12-24', '2024-01-07', 3, 'En Attente'),
(31, 15, 4, '2024-01-04', '2024-02-11', 1, 'En Attente'),
(32, 15, 13, '2024-01-12', '2024-01-19', 10, 'En Attente'),
(33, 7, 7, '2024-01-31', '2024-02-02', 1, 'En Attente');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `Admins`
--
ALTER TABLE `Admins`
  ADD PRIMARY KEY (`AdminID`);

--
-- Index pour la table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`idclient`);

--
-- Index pour la table `Commentaires`
--
ALTER TABLE `Commentaires`
  ADD PRIMARY KEY (`CommentaireID`),
  ADD KEY `idclient` (`idclient`),
  ADD KEY `DestinationID` (`DestinationID`);

--
-- Index pour la table `Destinations`
--
ALTER TABLE `Destinations`
  ADD PRIMARY KEY (`DestinationID`);

--
-- Index pour la table `Notations`
--
ALTER TABLE `Notations`
  ADD PRIMARY KEY (`NotationID`),
  ADD KEY `idclient` (`idclient`),
  ADD KEY `DestinationID` (`DestinationID`);

--
-- Index pour la table `ReservationsHotels`
--
ALTER TABLE `ReservationsHotels`
  ADD PRIMARY KEY (`ReservationHotelID`),
  ADD KEY `idclient` (`idclient`),
  ADD KEY `DestinationID` (`DestinationID`);

--
-- Index pour la table `ReservationsVols`
--
ALTER TABLE `ReservationsVols`
  ADD PRIMARY KEY (`ReservationVolID`),
  ADD KEY `idclient` (`idclient`),
  ADD KEY `DestinationID` (`DestinationID`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `Admins`
--
ALTER TABLE `Admins`
  MODIFY `AdminID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `clients`
--
ALTER TABLE `clients`
  MODIFY `idclient` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT pour la table `Commentaires`
--
ALTER TABLE `Commentaires`
  MODIFY `CommentaireID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT pour la table `Destinations`
--
ALTER TABLE `Destinations`
  MODIFY `DestinationID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `Notations`
--
ALTER TABLE `Notations`
  MODIFY `NotationID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT pour la table `ReservationsHotels`
--
ALTER TABLE `ReservationsHotels`
  MODIFY `ReservationHotelID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `ReservationsVols`
--
ALTER TABLE `ReservationsVols`
  MODIFY `ReservationVolID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `Commentaires`
--
ALTER TABLE `Commentaires`
  ADD CONSTRAINT `commentaires_ibfk_1` FOREIGN KEY (`idclient`) REFERENCES `Clients` (`idclient`),
  ADD CONSTRAINT `commentaires_ibfk_2` FOREIGN KEY (`DestinationID`) REFERENCES `Destinations` (`DestinationID`);

--
-- Contraintes pour la table `Notations`
--
ALTER TABLE `Notations`
  ADD CONSTRAINT `notations_ibfk_1` FOREIGN KEY (`idclient`) REFERENCES `Clients` (`idclient`),
  ADD CONSTRAINT `notations_ibfk_2` FOREIGN KEY (`DestinationID`) REFERENCES `Destinations` (`DestinationID`);

--
-- Contraintes pour la table `ReservationsHotels`
--
ALTER TABLE `ReservationsHotels`
  ADD CONSTRAINT `reservationshotels_ibfk_1` FOREIGN KEY (`idclient`) REFERENCES `Clients` (`idclient`),
  ADD CONSTRAINT `reservationshotels_ibfk_2` FOREIGN KEY (`DestinationID`) REFERENCES `Destinations` (`DestinationID`);

--
-- Contraintes pour la table `ReservationsVols`
--
ALTER TABLE `ReservationsVols`
  ADD CONSTRAINT `reservationsvols_ibfk_1` FOREIGN KEY (`idclient`) REFERENCES `Clients` (`idclient`),
  ADD CONSTRAINT `reservationsvols_ibfk_2` FOREIGN KEY (`DestinationID`) REFERENCES `Destinations` (`DestinationID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
