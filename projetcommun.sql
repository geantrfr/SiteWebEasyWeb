-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  Dim 15 avr. 2018 à 21:17
-- Version du serveur :  5.7.19
-- Version de PHP :  5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `projetcommun`
--

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

DROP TABLE IF EXISTS `client`;
CREATE TABLE IF NOT EXISTS `client` (
  `idClient` int(11) NOT NULL AUTO_INCREMENT,
  `nomClient` varchar(250) DEFAULT NULL,
  `prenomClient` varchar(250) DEFAULT NULL,
  `adresseClient` varchar(250) DEFAULT NULL,
  `villeClient` varchar(250) DEFAULT NULL,
  `codePostalClient` varchar(5) DEFAULT NULL,
  `telClient` varchar(16) DEFAULT NULL,
  `mailClient` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`idClient`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`idClient`, `nomClient`, `prenomClient`, `adresseClient`, `villeClient`, `codePostalClient`, `telClient`, `mailClient`) VALUES
(4, 'Piscine 64', NULL, '52 Bis Avenue Lasbordes', 'Soumoulou', '64420', '0559041642', 'contact@bearneo.fr'),
(6, 'Lasky', 'Thomas', 'testadresepau', 'mimizan', '40200', '0783008136', 'dqihfdqifg@gmail.com'),
(7, 'maria', 'DB', 'adressedb', 'paris', '75000', '054642523', 'sdqgfdfqgsdfg@gmail.com'),
(8, 'staphano', 'polo', 'avenue coucou bravo', 'Bordeaux', '50000', '0452365441', 'sdfqqsdfqsdf@gmail.com\r\n'),
(9, 'Brin', 'Alain', '14 rue des arbres clos', 'Accolay', '89460', '0123456789', 'alain.brin@sasociete.com'),
(10, 'Blanc', 'Etienne', '7 cours des dammes', 'Pau', '64000', '0123456789', 'etienne.blanc@ltrille.com');

-- --------------------------------------------------------

--
-- Structure de la table `depense`
--

DROP TABLE IF EXISTS `depense`;
CREATE TABLE IF NOT EXISTS `depense` (
  `idDepense` int(11) NOT NULL AUTO_INCREMENT,
  `dateDepense` date DEFAULT NULL,
  `montantRemboursement` double DEFAULT NULL,
  `etatValidation` enum('En cours','Validé','Refusé') DEFAULT 'En cours',
  `dateValidation` date DEFAULT NULL,
  `montantDepense` double DEFAULT NULL,
  `codeFrais` int(11) NOT NULL,
  `idUtilisateur` int(11) DEFAULT NULL,
  PRIMARY KEY (`idDepense`,`codeFrais`),
  KEY `FK_Depense_codeFrais` (`codeFrais`),
  KEY `FK_Depense_idUtilisateur` (`idUtilisateur`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `depense`
--

INSERT INTO `depense` (`idDepense`, `dateDepense`, `montantRemboursement`, `etatValidation`, `dateValidation`, `montantDepense`, `codeFrais`, `idUtilisateur`) VALUES
(1, '2018-04-02', 0, 'Validé', NULL, 500, 1, 2),
(2, '2018-04-10', 45, 'Validé', NULL, 65, 1, 2),
(3, '2018-04-08', 0, 'Validé', NULL, 1200, 1, 2),
(4, '2018-04-11', NULL, 'En cours', NULL, 35, 12, 3),
(5, '2018-04-25', NULL, 'En cours', NULL, 25, 12, 3);

-- --------------------------------------------------------

--
-- Structure de la table `entreprise`
--

DROP TABLE IF EXISTS `entreprise`;
CREATE TABLE IF NOT EXISTS `entreprise` (
  `idEntreprise` int(11) NOT NULL AUTO_INCREMENT,
  `raisonSociale` varchar(100) DEFAULT NULL,
  `noSiret` int(11) DEFAULT NULL,
  `adresseEntreprise` varchar(200) DEFAULT NULL,
  `codePostalUtilisateur` varchar(5) DEFAULT NULL,
  `villeEnteprise` varchar(100) DEFAULT NULL,
  `telEntreprise` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`idEntreprise`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `entreprise`
--

INSERT INTO `entreprise` (`idEntreprise`, `raisonSociale`, `noSiret`, `adresseEntreprise`, `codePostalUtilisateur`, `villeEnteprise`, `telEntreprise`) VALUES
(1, 'GRETA SUD AQUITAINE', 7264, '3 bis avenue Nitot', '64015', 'Pau Cedex', '0559841507');

-- --------------------------------------------------------

--
-- Structure de la table `frais`
--

DROP TABLE IF EXISTS `frais`;
CREATE TABLE IF NOT EXISTS `frais` (
  `libelleFrais` varchar(250) DEFAULT NULL,
  `detailsFrais` varchar(250) DEFAULT NULL,
  `dateFrais` date DEFAULT NULL,
  `idDepense` int(11) NOT NULL,
  `codeFrais` int(11) NOT NULL,
  PRIMARY KEY (`idDepense`,`codeFrais`),
  KEY `FK_Frais_codeFrais` (`codeFrais`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `frais`
--

INSERT INTO `frais` (`libelleFrais`, `detailsFrais`, `dateFrais`, `idDepense`, `codeFrais`) VALUES
('resto', 'resto', '2018-04-28', 1, 1),
('Restaurant', 'repas au restaurant avec client', '2018-04-06', 2, 1),
('Repas', 'Repas DelArte', '2018-04-09', 4, 12);

-- --------------------------------------------------------

--
-- Structure de la table `justificatif`
--

DROP TABLE IF EXISTS `justificatif`;
CREATE TABLE IF NOT EXISTS `justificatif` (
  `idJustificatif` int(11) NOT NULL AUTO_INCREMENT,
  `titreJustificatif` varchar(500) DEFAULT NULL,
  `urlJustificatif` varchar(500) DEFAULT NULL,
  `idDepense` int(11) DEFAULT NULL,
  `codeFrais` int(11) DEFAULT NULL,
  PRIMARY KEY (`idJustificatif`),
  KEY `FK_Justificatif_idDepense` (`idDepense`),
  KEY `FK_Justificatif_codeFrais` (`codeFrais`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `justificatif`
--

INSERT INTO `justificatif` (`idJustificatif`, `titreJustificatif`, `urlJustificatif`, `idDepense`, `codeFrais`) VALUES
(1, 'test', 'phototest', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `notedefrais`
--

DROP TABLE IF EXISTS `notedefrais`;
CREATE TABLE IF NOT EXISTS `notedefrais` (
  `codeFrais` int(11) NOT NULL AUTO_INCREMENT,
  `libelleNote` varchar(200) DEFAULT NULL,
  `dateFrais` date DEFAULT NULL,
  `villeFrais` varchar(250) DEFAULT NULL,
  `dateSoumission` date DEFAULT NULL,
  `commentaireFrais` text,
  `etat` enum('En Cours','Validé','Refusé') NOT NULL DEFAULT 'En Cours',
  `idUtilisateur` int(11) DEFAULT NULL,
  `idClient` int(11) DEFAULT '0',
  PRIMARY KEY (`codeFrais`),
  KEY `FK_NoteDeFrais_idUtilisateur` (`idUtilisateur`),
  KEY `FK_NoteDeFrais_idClient` (`idClient`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `notedefrais`
--

INSERT INTO `notedefrais` (`codeFrais`, `libelleNote`, `dateFrais`, `villeFrais`, `dateSoumission`, `commentaireFrais`, `etat`, `idUtilisateur`, `idClient`) VALUES
(1, 'Ma première note de frais', '2018-04-03', 'Pau', '2018-04-03', 'Test de note de frais', 'Validé', 2, NULL),
(2, 'Ma seconde note de frais', '2018-03-01', 'Marseille', '2018-04-03', 'Test note de frais', 'Validé', 2, NULL),
(7, 'Jour 9', '2018-04-03', 'PAU', NULL, 'This is just a test.', 'Refusé', 2, NULL),
(12, 'Frais de repas', '2018-04-09', 'Pau', '2018-04-10', 'Repas a DelArte', 'Refusé', 3, 4),
(14, 'Frais repas', '2018-04-01', 'Paris', '2018-04-10', 'Repas dans le restaurant de l\'hotel', 'Validé', 3, 4);

-- --------------------------------------------------------

--
-- Structure de la table `trajet`
--

DROP TABLE IF EXISTS `trajet`;
CREATE TABLE IF NOT EXISTS `trajet` (
  `libelleTrajet` varchar(250) NOT NULL,
  `dureeTrajet` float DEFAULT NULL,
  `villeDepart` varchar(250) DEFAULT NULL,
  `villeArrivee` varchar(250) DEFAULT NULL,
  `dateAller` date DEFAULT NULL,
  `dateRetour` date DEFAULT NULL,
  `distanceKilometres` double DEFAULT NULL,
  `idDepense` int(11) NOT NULL,
  `codeFrais` int(11) NOT NULL,
  PRIMARY KEY (`idDepense`,`codeFrais`),
  KEY `FK_Trajet_codeFrais` (`codeFrais`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `trajet`
--

INSERT INTO `trajet` (`libelleTrajet`, `dureeTrajet`, `villeDepart`, `villeArrivee`, `dateAller`, `dateRetour`, `distanceKilometres`, `idDepense`, `codeFrais`) VALUES
('Trajet Marseille-Paris', 2.3, 'PAU', 'BORDEAUX', '2018-04-05', NULL, 220, 1, 1),
('Trajet Pau - Paris', 5, 'Pau', 'Paris', '2018-04-17', '2018-04-19', 520, 3, 1);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `idUtilisateur` int(11) NOT NULL AUTO_INCREMENT,
  `mailUtilisateur` varchar(200) NOT NULL,
  `mdpUtilisateur` text NOT NULL,
  `adresseUtilisateur` varchar(250) DEFAULT NULL,
  `codePostalUtilisateur` varchar(5) DEFAULT NULL,
  `villeUtilisateur` varchar(100) DEFAULT NULL,
  `telUtilisateur` varchar(16) DEFAULT NULL,
  `typeCompte` enum('Commercial','Comptable','Administrateur Entreprise') DEFAULT 'Commercial',
  `nomUtilisateur` varchar(100) DEFAULT NULL,
  `prenomUtilisateur` varchar(100) DEFAULT NULL,
  `idEntreprise` int(11) DEFAULT NULL,
  `AuthToken` varchar(255) NOT NULL,
  PRIMARY KEY (`idUtilisateur`),
  UNIQUE KEY `mail` (`mailUtilisateur`),
  KEY `FK_Utilisateur_idEntreprise` (`idEntreprise`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`idUtilisateur`, `mailUtilisateur`, `mdpUtilisateur`, `adresseUtilisateur`, `codePostalUtilisateur`, `villeUtilisateur`, `telUtilisateur`, `typeCompte`, `nomUtilisateur`, `prenomUtilisateur`, `idEntreprise`, `AuthToken`) VALUES
(2, 'ibragim.abubakarov@greta-sud-aquitaine.academy', '123', '25 avenue de wilsak', '00000', 'mimizon', '0', 'Commercial', 'Abubakarov', 'Ibragim', 1, 'aWJyYWdpbS5hYnViYWthcm92QGdyZXRhLXN1ZC1hcXVpdGFpbmUuYWNhZGVteToxMjM='),
(3, 'vincent.nicolau@greta-sud-aquitaine.academy', '123', '25 avenue de wilsak', '00000', 'mimizon', '0', 'Commercial', 'Nicolau', 'Vincent', 1, 'Basic dmluY2VudC5uaWNvbGF1QGdyZXRhLXN1ZC1hcXVpdGFpbmUuYWNhZGVteToxMjM='),
(4, 'pierre.gyejacquot@greta-sud-aquitaine.academy', '123', '25 avenue de wilsak', '00000', 'mimizon', '0', 'Comptable', 'Gyejacquot', 'Pierre', 1, 'Basic cGllcnJlLmd5ZWphY3F1b3RAZ3JldGEtc3VkLWFxdWl0YWluZS5hY2FkZW15OjEyMw=='),
(5, 'test@test.fr', 'test', '25 avenue de wilsak', '00000', 'mimizon', '0', 'Commercial', 'NomTest', 'PrenomTest', 1, 'dGVzdEB0ZXN0LmZyOnRlc3Q='),
(8, 'f.nunes@live.fr', '123', '25 avenue de wilsak', '00000', 'mimizon', '0', 'Comptable', 'Nunes', 'Florence', 1, ''),
(9, 'stephane.genvrin@greta-sud-aquitaine.academy', '0123456789', '25 avenue de wilsak', '00000', 'mimizon', '0', 'Comptable', 'genvrin', 'stephane', 1, ''),
(10, 'cabanel.maxime@greta-sud-aquitaine.academy', '0123456789', '25 avenue de wilsak', '00000', 'mimizon', '0', 'Commercial', 'cabanel', 'maxime', 1, ''),
(11, 'joshua.dealmeida@greta-sud-aqutaine.academy', '0123456789', '25 avenue de wilsak', '00000', 'mimizon', '0', 'Commercial', 'de almeida', 'joshua', 1, ''),
(12, 'matthieu.delporte', '0123456789', '25 avenue de wilsak', '00000', 'mimizon', '0', 'Commercial', 'delporte', 'joshua', 1, ''),
(13, 'cyril.descat@greta-sud-aquitaine.academy', '0123456789', '25 avenue de wilsak', '00000', 'mimizon', '0', 'Commercial', 'descat', 'cyril', 1, ''),
(14, 'pierre.gyejacquot', '0123456789', '25 avenue de wilsak', '00000', 'mimizon', '0', 'Commercial', 'gyejacquot', 'pierre', 1, ''),
(15, 'marie.morales@greta-sud-aquitaine.academy', '0123456789', '25 avenue de wilsak', '00000', 'mimizon', '0', 'Comptable', 'morales', 'marie', 1, ''),
(17, 'thomaslasky33@gmail.com', 'test', '25 avenue de wilsak', '00000', 'mimizon', '05565865', 'Comptable', 'lasky', 'thomas', 1, 'test');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `depense`
--
ALTER TABLE `depense`
  ADD CONSTRAINT `FK_Depense_codeFrais` FOREIGN KEY (`codeFrais`) REFERENCES `notedefrais` (`codeFrais`),
  ADD CONSTRAINT `FK_Depense_idUtilisateur` FOREIGN KEY (`idUtilisateur`) REFERENCES `utilisateur` (`idUtilisateur`);

--
-- Contraintes pour la table `frais`
--
ALTER TABLE `frais`
  ADD CONSTRAINT `FK_Frais_codeFrais` FOREIGN KEY (`codeFrais`) REFERENCES `notedefrais` (`codeFrais`),
  ADD CONSTRAINT `FK_Frais_idDepense` FOREIGN KEY (`idDepense`) REFERENCES `depense` (`idDepense`);

--
-- Contraintes pour la table `justificatif`
--
ALTER TABLE `justificatif`
  ADD CONSTRAINT `FK_Justificatif_codeFrais` FOREIGN KEY (`codeFrais`) REFERENCES `notedefrais` (`codeFrais`),
  ADD CONSTRAINT `FK_Justificatif_idDepense` FOREIGN KEY (`idDepense`) REFERENCES `depense` (`idDepense`);

--
-- Contraintes pour la table `notedefrais`
--
ALTER TABLE `notedefrais`
  ADD CONSTRAINT `FK_NoteDeFrais_idClient` FOREIGN KEY (`idClient`) REFERENCES `client` (`idClient`),
  ADD CONSTRAINT `FK_NoteDeFrais_idUtilisateur` FOREIGN KEY (`idUtilisateur`) REFERENCES `utilisateur` (`idUtilisateur`);

--
-- Contraintes pour la table `trajet`
--
ALTER TABLE `trajet`
  ADD CONSTRAINT `FK_Trajet_codeFrais` FOREIGN KEY (`codeFrais`) REFERENCES `notedefrais` (`codeFrais`),
  ADD CONSTRAINT `FK_Trajet_idDepense` FOREIGN KEY (`idDepense`) REFERENCES `depense` (`idDepense`);

--
-- Contraintes pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD CONSTRAINT `FK_Utilisateur_idEntreprise` FOREIGN KEY (`idEntreprise`) REFERENCES `entreprise` (`idEntreprise`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
