-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mer. 31 jan. 2024 à 14:36
-- Version du serveur : 8.0.35
-- Version de PHP : 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `gogifty`
--

-- --------------------------------------------------------

--
-- Structure de la table `cadeaux_gagnes`
--

DROP TABLE IF EXISTS `cadeaux_gagnes`;
CREATE TABLE IF NOT EXISTS `cadeaux_gagnes` (
  `id_cadeau_gagne` int NOT NULL AUTO_INCREMENT,
  `code_client` int UNSIGNED NOT NULL,
  `gift_id` int NOT NULL,
  `date_gagne` date NOT NULL,
  PRIMARY KEY (`id_cadeau_gagne`),
  KEY `code_client` (`code_client`),
  KEY `gift_id` (`gift_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `cadeaux_gagnes`
--

INSERT INTO `cadeaux_gagnes` (`id_cadeau_gagne`, `code_client`, `gift_id`, `date_gagne`) VALUES
(1, 1, 3, '2024-01-31'),
(2, 1, 3, '2024-01-31'),
(3, 1, 2, '2024-01-31'),
(4, 1, 1, '2024-01-31'),
(5, 1, 2, '2024-01-31'),
(6, 1, 2, '2024-01-31'),
(7, 1, 3, '2024-01-31'),
(8, 2, 3, '2024-01-31');

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

DROP TABLE IF EXISTS `client`;
CREATE TABLE IF NOT EXISTS `client` (
  `code_client` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `nom_client` varchar(255) NOT NULL,
  `adresse_client` varchar(255) NOT NULL,
  `facebook_client` varchar(255) NOT NULL,
  `instagram_client` varchar(255) NOT NULL,
  `email_client` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(50) NOT NULL DEFAULT 'user',
  PRIMARY KEY (`code_client`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`code_client`, `nom_client`, `adresse_client`, `facebook_client`, `instagram_client`, `email_client`, `password`, `role`) VALUES
(1, 'kassoum', '17 bis rue du 19 mars 1962', 'kassoum', 'kassoum', 'kass@gmail.com', '$2y$10$IB4GC7xtU5S6bkUu.UY7juVrCGgoU6vyZqaScZxrwN8dZyk2gJTvW', 'user'),
(2, 'madeth mayhbhuvfv', '14 rue bachelard le mans', 'madeth', 'madeth', 'madeth@gmail.com', '$2y$10$WUcPw27fErX.eKL6RE6fWOn1RC5LTGGLZer5oiCfT6oIsOxIJYdaG', 'admin');

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

DROP TABLE IF EXISTS `commande`;
CREATE TABLE IF NOT EXISTS `commande` (
  `code_commande` int NOT NULL,
  `date_commande` date NOT NULL,
  `status_commande` varchar(255) NOT NULL,
  `date_dispatched` date NOT NULL,
  `parcel` varchar(255) NOT NULL,
  `note` varchar(255) NOT NULL,
  `date_arrival` date NOT NULL,
  `code_client` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `concierge`
--

DROP TABLE IF EXISTS `concierge`;
CREATE TABLE IF NOT EXISTS `concierge` (
  `id_concierge` int NOT NULL AUTO_INCREMENT,
  `nom_concierge` varchar(255) NOT NULL,
  PRIMARY KEY (`id_concierge`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `concierge`
--

INSERT INTO `concierge` (`id_concierge`, `nom_concierge`) VALUES
(1, 'Madeth May'),
(2, 'Jean Luck Dupont');

-- --------------------------------------------------------

--
-- Structure de la table `entreprise`
--

DROP TABLE IF EXISTS `entreprise`;
CREATE TABLE IF NOT EXISTS `entreprise` (
  `id_entreprise` int NOT NULL AUTO_INCREMENT,
  `facebook_entreprise` varchar(255) NOT NULL,
  `email_entreprise` varchar(255) NOT NULL,
  `line_id` varchar(255) NOT NULL,
  `web_site` varchar(255) NOT NULL,
  `nom_entreprise` varchar(255) NOT NULL,
  PRIMARY KEY (`id_entreprise`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `facture`
--

DROP TABLE IF EXISTS `facture`;
CREATE TABLE IF NOT EXISTS `facture` (
  `id_facture` int NOT NULL AUTO_INCREMENT,
  `date_facture` date NOT NULL,
  `code_client` varchar(255) NOT NULL,
  `id_entreprise` int NOT NULL,
  PRIMARY KEY (`id_facture`),
  KEY `code_client` (`code_client`),
  KEY `id_entreprise` (`id_entreprise`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `gift`
--

DROP TABLE IF EXISTS `gift`;
CREATE TABLE IF NOT EXISTS `gift` (
  `gift_id` int NOT NULL AUTO_INCREMENT,
  `nom_gift` varchar(255) NOT NULL,
  `gift_points` int NOT NULL,
  PRIMARY KEY (`gift_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `gift`
--

INSERT INTO `gift` (`gift_id`, `nom_gift`, `gift_points`) VALUES
(1, 'Givenchy', 5),
(2, 'Lancome Idole', 10),
(3, 'Yves Saint Laurent', 20),
(6, 'Rocher', 45),
(7, 'luxe gout', 150),
(8, 'deluxe', 255);

-- --------------------------------------------------------

--
-- Structure de la table `item`
--

DROP TABLE IF EXISTS `item`;
CREATE TABLE IF NOT EXISTS `item` (
  `id_item` int NOT NULL AUTO_INCREMENT,
  `nom_item` varchar(255) NOT NULL,
  `status_item` varchar(255) NOT NULL,
  `prix_unitaire` decimal(10,0) NOT NULL,
  `stock` int NOT NULL,
  PRIMARY KEY (`id_item`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `membership`
--

DROP TABLE IF EXISTS `membership`;
CREATE TABLE IF NOT EXISTS `membership` (
  `id_membership` int NOT NULL AUTO_INCREMENT,
  `type_membership` varchar(255) NOT NULL,
  PRIMARY KEY (`id_membership`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `membership`
--

INSERT INTO `membership` (`id_membership`, `type_membership`) VALUES
(1, 'Silver'),
(2, 'Gold'),
(3, 'Platinum'),
(4, 'Ultimate');

-- --------------------------------------------------------

--
-- Structure de la table `payement`
--

DROP TABLE IF EXISTS `payement`;
CREATE TABLE IF NOT EXISTS `payement` (
  `id_payement` int NOT NULL AUTO_INCREMENT,
  `type_payement` varchar(255) NOT NULL,
  `date_payement` date NOT NULL,
  `versement` decimal(10,0) NOT NULL,
  PRIMARY KEY (`id_payement`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `payement_avec_points`
--

DROP TABLE IF EXISTS `payement_avec_points`;
CREATE TABLE IF NOT EXISTS `payement_avec_points` (
  `id_avec_points` int NOT NULL AUTO_INCREMENT,
  `id_payement` int NOT NULL,
  PRIMARY KEY (`id_avec_points`),
  KEY `fk_pay_points` (`id_payement`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `payement_sans_points`
--

DROP TABLE IF EXISTS `payement_sans_points`;
CREATE TABLE IF NOT EXISTS `payement_sans_points` (
  `id_sans_points` int NOT NULL AUTO_INCREMENT,
  `id_payement` int NOT NULL,
  PRIMARY KEY (`id_sans_points`),
  KEY `fk_pay_sans_points` (`id_payement`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `phone`
--

DROP TABLE IF EXISTS `phone`;
CREATE TABLE IF NOT EXISTS `phone` (
  `id_phone` varchar(255) NOT NULL,
  `code_client` varchar(255) NOT NULL,
  PRIMARY KEY (`id_phone`),
  KEY `fk_phone_client` (`code_client`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `points`
--

DROP TABLE IF EXISTS `points`;
CREATE TABLE IF NOT EXISTS `points` (
  `id_points` int NOT NULL AUTO_INCREMENT,
  `nombre_points` int NOT NULL,
  `date_expiration` date NOT NULL,
  `id_avec_points` int NOT NULL,
  `code_client` varchar(255) NOT NULL,
  `id_membership` int NOT NULL,
  `id_concierge` int NOT NULL,
  `gift_id` int NOT NULL,
  PRIMARY KEY (`id_points`),
  KEY `id_avec_points` (`id_avec_points`),
  KEY `fk_points_client` (`code_client`),
  KEY `fk_points_membership` (`id_membership`),
  KEY `id_concierge` (`id_concierge`),
  KEY `points_ibfk_1` (`gift_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `points`
--

INSERT INTO `points` (`id_points`, `nombre_points`, `date_expiration`, `id_avec_points`, `code_client`, `id_membership`, `id_concierge`, `gift_id`) VALUES
(1, 505, '2024-01-11', 1, '1', 2, 1, 2),
(2, 125, '2024-01-25', 2, '2', 4, 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `relation_commande_item`
--

DROP TABLE IF EXISTS `relation_commande_item`;
CREATE TABLE IF NOT EXISTS `relation_commande_item` (
  `code_commande` varchar(255) NOT NULL,
  `id_item` int NOT NULL,
  `quantite` int NOT NULL,
  PRIMARY KEY (`code_commande`,`id_item`),
  KEY `code_commande` (`code_commande`),
  KEY `id_item` (`id_item`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `relation_remise_item`
--

DROP TABLE IF EXISTS `relation_remise_item`;
CREATE TABLE IF NOT EXISTS `relation_remise_item` (
  `id_remise` int NOT NULL,
  `id_item` int NOT NULL,
  PRIMARY KEY (`id_remise`,`id_item`),
  KEY `id_item` (`id_item`),
  KEY `id_remise` (`id_remise`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `relation_remise_points`
--

DROP TABLE IF EXISTS `relation_remise_points`;
CREATE TABLE IF NOT EXISTS `relation_remise_points` (
  `id_remise` int NOT NULL,
  `id_points` int NOT NULL,
  `visibilite` varchar(255) NOT NULL,
  PRIMARY KEY (`id_remise`,`id_points`),
  KEY `id_remise` (`id_remise`),
  KEY `id_points` (`id_points`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `remise`
--

DROP TABLE IF EXISTS `remise`;
CREATE TABLE IF NOT EXISTS `remise` (
  `id_remise` int NOT NULL AUTO_INCREMENT,
  `date_debut` date NOT NULL,
  `date_fin` date NOT NULL,
  `id_concierge` int NOT NULL,
  PRIMARY KEY (`id_remise`),
  KEY `fk_remise_concierge` (`id_concierge`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `cadeaux_gagnes`
--
ALTER TABLE `cadeaux_gagnes`
  ADD CONSTRAINT `cadeaux_gagnes_ibfk_1` FOREIGN KEY (`code_client`) REFERENCES `client` (`code_client`),
  ADD CONSTRAINT `cadeaux_gagnes_ibfk_2` FOREIGN KEY (`gift_id`) REFERENCES `gift` (`gift_id`);

--
-- Contraintes pour la table `payement_avec_points`
--
ALTER TABLE `payement_avec_points`
  ADD CONSTRAINT `fk_pay_points` FOREIGN KEY (`id_payement`) REFERENCES `payement` (`id_payement`);

--
-- Contraintes pour la table `points`
--
ALTER TABLE `points`
  ADD CONSTRAINT `points_ibfk_1` FOREIGN KEY (`gift_id`) REFERENCES `gift` (`gift_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
