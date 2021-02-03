-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 07 jan. 2021 à 13:17
-- Version du serveur :  8.0.21
-- Version de PHP : 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `gestionlibrairie`
--

-- --------------------------------------------------------

--
-- Structure de la table `commander`
--

DROP TABLE IF EXISTS `commander`;
CREATE TABLE IF NOT EXISTS `commander` (
  `Num_Commande` int NOT NULL AUTO_INCREMENT,
  `Date_Achat` int UNSIGNED NOT NULL,
  `Prix_Achat` decimal(10,2) NOT NULL,
  `ISBN` int UNSIGNED NOT NULL,
  `Code_Fournisseur` varchar(5) NOT NULL,
  PRIMARY KEY (`Num_Commande`),
  KEY `Index_Date_Achat` (`Date_Achat`),
  KEY `Index_Isbn` (`ISBN`),
  KEY `Index_Code_Fournisseur` (`Code_Fournisseur`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `commander`
--

INSERT INTO `commander` (`Num_Commande`, `Date_Achat`, `Prix_Achat`, `ISBN`, `Code_Fournisseur`) VALUES
(1, 2019, '200.50', 2746014513, 'F7'),
(2, 2020, '2222.00', 2742921079, 'F8'),
(3, 2020, '7424.00', 2012563541, 'F10'),
(4, 2019, '132.00', 2744014095, 'F2');

-- --------------------------------------------------------

--
-- Structure de la table `fournisseur`
--

DROP TABLE IF EXISTS `fournisseur`;
CREATE TABLE IF NOT EXISTS `fournisseur` (
  `Code_Fournisseur` varchar(5) NOT NULL,
  `Raison_Sociale` varchar(50) NOT NULL,
  `Rue_Fournisseur` varchar(50) NOT NULL,
  `Code_Postal` varchar(5) NOT NULL,
  `Localite` varchar(50) NOT NULL,
  `Pays` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`Code_Fournisseur`),
  UNIQUE KEY `Index_Raison` (`Raison_Sociale`(10)),
  KEY `Index_Code` (`Code_Postal`),
  KEY `Index_Pays` (`Pays`(10)),
  KEY `Index_localite` (`Localite`(10))
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `fournisseur`
--

INSERT INTO `fournisseur` (`Code_Fournisseur`, `Raison_Sociale`, `Rue_Fournisseur`, `Code_Postal`, `Localite`, `Pays`) VALUES
('F1', 'Eyrolles', '61 rue St Germain', '52000', 'Paris', 'France'),
('F10', 'Microsoft Press', '3 square richtistrasse', '83000', 'Zurich', 'Suisse'),
('F2', 'First_interactive', '27 boulevard Bargue', '75015', 'Paris', 'France'),
('F3', 'Eni eds', '5 cours du Temple', '1201', 'Geneve', 'Suisse'),
('F4', 'Dunod', '25 rue de Rivoli', '75002', 'Paris', 'France'),
('F5', 'Campuspress', '47 impasse des Vinaigriers', '75010', 'Paris', 'France'),
('F6', 'O\'reilly', '1005 square Gravenstein', '9542', 'Sebastopol, CA', 'USA'),
('F7', 'Peachpit Press', '1249 Eighth', '94710', 'Berkeley , CA', 'USA'),
('F8', 'Micro applications', '19 rue du Marais', '1228', 'plan les ouates', 'Suisse'),
('F9', 'Economica', '1201 Bd de Lausanne', '1201', 'Geneve', 'Suisse');

-- --------------------------------------------------------

--
-- Structure de la table `historique_modification`
--

DROP TABLE IF EXISTS `historique_modification`;
CREATE TABLE IF NOT EXISTS `historique_modification` (
  `Id_Modif` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `Type_Modif` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Nom_Table` varchar(40) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `ID_Table` varchar(80) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Date_Modif` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`Id_Modif`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `livre`
--

DROP TABLE IF EXISTS `livre`;
CREATE TABLE IF NOT EXISTS `livre` (
  `ISBN` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `Titre_Livre` varchar(50) NOT NULL,
  `Theme_Livre` varchar(60) DEFAULT NULL,
  `Nom_Auteur` varchar(50) NOT NULL,
  `Prenom_Auteur` varchar(50) DEFAULT NULL,
  `Editeur` varchar(50) NOT NULL,
  `Prix_Livre` decimal(10,0) DEFAULT NULL,
  PRIMARY KEY (`ISBN`),
  KEY `Index_Titre` (`Titre_Livre`(10)),
  KEY `Index_theme` (`Theme_Livre`(10)),
  KEY `Index_nom` (`Nom_Auteur`(10)),
  KEY `Index_prenom` (`Prenom_Auteur`(10)),
  KEY `Index_editeur` (`Editeur`(10))
) ENGINE=InnoDB AUTO_INCREMENT=2844278907 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `livre`
--

INSERT INTO `livre` (`ISBN`, `Titre_Livre`, `Theme_Livre`, `Nom_Auteur`, `Prenom_Auteur`, `Editeur`, `Prix_Livre`) VALUES
(2012563541, 'PowerPoint 2000', 'Bureautique', 'Clarck', 'Mickael', 'Elsevier', '14'),
(2212111436, 'delphi 7', 'Langages de programmation', 'Belleavoine', 'Pierre', 'Addison wesley', '45'),
(2212575690, 'SQL en 20 étapes faciles', 'LAngages de programmation', 'Rigaux', 'Michel', 'Prentice Hall', '20'),
(2546897512, 'Office 2000 premium', 'Bureautique', 'Carthy', 'Thomas', 'Addison wesley', '25'),
(2569781245, 'Paint Shop Pro7', 'Graphisme et PAO', 'Haynes', 'Barry', 'Spring Verlag', '20'),
(2656897514, 'VBA ACCESS 2002', 'Base de donnees', 'Young', 'Mickael', 'Elsevier', '25'),
(2717845267, 'Application financieres sous Excel', 'Langages de programmation', 'Riva', 'Favrice', 'Spring Verlag', '21'),
(2742921079, 'ASP', 'programmation internet', 'Janicot', 'J.C', 'Elsevier', '23'),
(2744014087, 'Débuter en programmation', 'Langages de programmation', 'Perry', 'Gary', 'Addison wesley', '43'),
(2744014095, 'Création de macros VBA', 'Langages de programmation', 'Bidaut', 'Mickael', 'Spring Verlag', '16'),
(2746011832, 'Dreamweaver 4 pour PC/Mac', 'Graphisme et PAO', 'Kyle', 'Lynn', 'John Wiley', '20'),
(2746014513, 'PHP 4', 'programmation internet', 'Carthy', 'Thomas', 'Prentice Hall', '26'),
(2841772241, 'Mac OS X', 'systemes d\'exploitation', 'Fleux', 'Loic', 'John Wiley', '33'),
(2841772373, 'Pratique de MySql et PHP', 'Langages de programmation', 'Rigaux', 'Fred', 'Spring Verlag', '31'),
(2844278760, 'Flash 5', 'Graphisme et PAO', 'Houlette', 'Françoise', 'Prentice Hall', '7'),
(2844278906, 'HTML pour les nuls', 'programmation internet', 'Tittel', 'Eddy', 'Prentice Hall', '20');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `commander`
--
ALTER TABLE `commander`
  ADD CONSTRAINT `commander_ibfk_1` FOREIGN KEY (`ISBN`) REFERENCES `livre` (`ISBN`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `commander_ibfk_2` FOREIGN KEY (`Code_Fournisseur`) REFERENCES `fournisseur` (`Code_Fournisseur`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
