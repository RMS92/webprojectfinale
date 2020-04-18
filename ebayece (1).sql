-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  sam. 18 avr. 2020 à 14:11
-- Version du serveur :  10.4.10-MariaDB
-- Version de PHP :  7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `ebayece`
--

-- --------------------------------------------------------

--
-- Structure de la table `achat_direct`
--

DROP TABLE IF EXISTS `achat_direct`;
CREATE TABLE IF NOT EXISTS `achat_direct` (
  `id_achat` bigint(50) NOT NULL AUTO_INCREMENT,
  `statut_vente` varchar(50) NOT NULL,
  `id_produit` bigint(50) NOT NULL,
  PRIMARY KEY (`id_achat`),
  KEY `id_produit` (`id_produit`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `achat_direct`
--

INSERT INTO `achat_direct` (`id_achat`, `statut_vente`, `id_produit`) VALUES
(1, 'non vendu', 1),
(2, 'non vendu', 4),
(3, 'non vendu', 5),
(4, 'non vendu', 6),
(5, 'non vendu', 11),
(6, 'non vendu', 12),
(7, 'non vendu', 13),
(8, 'non vendu', 14),
(9, 'non vendu', 15),
(10, 'non vendu', 16),
(11, 'non vendu', 17);

-- --------------------------------------------------------

--
-- Structure de la table `acheteur`
--

DROP TABLE IF EXISTS `acheteur`;
CREATE TABLE IF NOT EXISTS `acheteur` (
  `id_acheteur` bigint(50) NOT NULL AUTO_INCREMENT,
  `prenom` varchar(50) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `date_anniversaire` date NOT NULL,
  PRIMARY KEY (`id_acheteur`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `acheteur`
--

INSERT INTO `acheteur` (`id_acheteur`, `prenom`, `nom`, `email`, `password`, `date_anniversaire`) VALUES
(1, 'Romain', 'Bernard', 'rom1ain92@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', '2020-04-09'),
(3, 'test', 'test', 'test@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', '2020-04-18'),
(5, 'Rian', 'Touchent', 'rt@gmail.com', 'fd01c0d7916f6c1fd4e3a3d8b10cbdeed574632c', '2020-04-01');

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `pseudo_admin` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`pseudo_admin`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`pseudo_admin`, `email`, `password`) VALUES
('admin1', 'admin@gmail.com', 'admin');

-- --------------------------------------------------------

--
-- Structure de la table `enchere`
--

DROP TABLE IF EXISTS `enchere`;
CREATE TABLE IF NOT EXISTS `enchere` (
  `id_enchere` bigint(50) NOT NULL AUTO_INCREMENT,
  `date_fin` date NOT NULL,
  `heure_fin` time NOT NULL,
  `prix_surencheri` decimal(10,0) NOT NULL,
  `statut_vente` varchar(20) NOT NULL,
  `id_produit` bigint(50) NOT NULL,
  PRIMARY KEY (`id_enchere`),
  KEY `id_produit` (`id_produit`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `enchere`
--

INSERT INTO `enchere` (`id_enchere`, `date_fin`, `heure_fin`, `prix_surencheri`, `statut_vente`, `id_produit`) VALUES
(1, '2020-04-21', '13:00:00', '100', 'non vendu', 1),
(2, '2020-04-25', '10:00:00', '10', 'non vendu', 10),
(3, '2020-04-29', '13:00:00', '20', 'non vendu', 13),
(4, '2020-04-25', '13:00:00', '50', 'non vendu', 17);

-- --------------------------------------------------------

--
-- Structure de la table `image`
--

DROP TABLE IF EXISTS `image`;
CREATE TABLE IF NOT EXISTS `image` (
  `id_image` bigint(100) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `file` varchar(255) NOT NULL,
  `id_produit` bigint(50) NOT NULL,
  PRIMARY KEY (`id_image`),
  KEY `id_produit` (`id_produit`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `infolivraison`
--

DROP TABLE IF EXISTS `infolivraison`;
CREATE TABLE IF NOT EXISTS `infolivraison` (
  `id_info` bigint(50) NOT NULL AUTO_INCREMENT,
  `telephone` varchar(10) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `adresse` varchar(100) NOT NULL,
  `ville` varchar(100) NOT NULL,
  `code_postal` varchar(10) NOT NULL,
  `region` varchar(50) NOT NULL,
  `pays` varchar(100) NOT NULL,
  `id_acheteur` bigint(50) NOT NULL,
  PRIMARY KEY (`id_info`),
  KEY `id_acheteur` (`id_acheteur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `offre`
--

DROP TABLE IF EXISTS `offre`;
CREATE TABLE IF NOT EXISTS `offre` (
  `id_offre` bigint(50) NOT NULL AUTO_INCREMENT,
  `statut_vente` varchar(20) NOT NULL,
  `id_produit` bigint(50) NOT NULL,
  PRIMARY KEY (`id_offre`),
  KEY `id_produit` (`id_produit`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `offre`
--

INSERT INTO `offre` (`id_offre`, `statut_vente`, `id_produit`) VALUES
(1, 'non vendu', 2),
(2, 'non vendu', 8),
(3, 'non vendu', 11),
(4, 'non vendu', 14);

-- --------------------------------------------------------

--
-- Structure de la table `panier`
--

DROP TABLE IF EXISTS `panier`;
CREATE TABLE IF NOT EXISTS `panier` (
  `id_panier` bigint(50) NOT NULL AUTO_INCREMENT,
  `prix_total` decimal(10,0) NOT NULL,
  `nb_produits` bigint(30) NOT NULL,
  `id_acheteur` bigint(50) NOT NULL,
  PRIMARY KEY (`id_panier`),
  KEY `id_acheteur` (`id_acheteur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

DROP TABLE IF EXISTS `produit`;
CREATE TABLE IF NOT EXISTS `produit` (
  `id_produit` bigint(50) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `prix` double NOT NULL,
  `categorie` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `video` varchar(255) NOT NULL,
  `id_vendeur` bigint(50) NOT NULL,
  PRIMARY KEY (`id_produit`),
  KEY `id_vendeur` (`id_vendeur`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`id_produit`, `nom`, `prix`, `categorie`, `description`, `photo`, `video`, `id_vendeur`) VALUES
(16, 'pendentif', 100, 'Bon pour le musÃ©e', 'aller marche ', 'C:wamp64	mpphp476F.tmp', '', 6),
(17, 'test2', 100, 'Bon pour le musÃ©e', 'jyjyjyt', 'C:wamp64	mpphp198B.tmp', '', 6);

-- --------------------------------------------------------

--
-- Structure de la table `vendeur`
--

DROP TABLE IF EXISTS `vendeur`;
CREATE TABLE IF NOT EXISTS `vendeur` (
  `id_vendeur` bigint(20) NOT NULL AUTO_INCREMENT,
  `prenom` varchar(50) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `date_anniversaire` date NOT NULL,
  PRIMARY KEY (`id_vendeur`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `vendeur`
--

INSERT INTO `vendeur` (`id_vendeur`, `prenom`, `nom`, `email`, `password`, `date_anniversaire`) VALUES
(1, '', '', 'testvendeur@gmail.com', 'test', '2020-04-01'),
(2, 'Alexandre', 'Bernard', 'alex92@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', '2020-04-26'),
(6, 'client', 'gentil', 'clientgentil@gmail.com', 'bb0b6647e93b6fb3593e649f301d6c4b49990a8a', '2020-04-02'),
(7, 'momo', 'henni', 'mh@gmail.com', 'mh', '2020-04-02');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `achat_direct`
--
ALTER TABLE `achat_direct`
  ADD CONSTRAINT `achat_direct_ibfk_1` FOREIGN KEY (`id_produit`) REFERENCES `produit` (`id_produit`);

--
-- Contraintes pour la table `enchere`
--
ALTER TABLE `enchere`
  ADD CONSTRAINT `enchere_ibfk_1` FOREIGN KEY (`id_produit`) REFERENCES `produit` (`id_produit`);

--
-- Contraintes pour la table `image`
--
ALTER TABLE `image`
  ADD CONSTRAINT `image_ibfk_1` FOREIGN KEY (`id_produit`) REFERENCES `image` (`id_image`);

--
-- Contraintes pour la table `infolivraison`
--
ALTER TABLE `infolivraison`
  ADD CONSTRAINT `infolivraison_ibfk_1` FOREIGN KEY (`id_acheteur`) REFERENCES `infolivraison` (`id_info`);

--
-- Contraintes pour la table `offre`
--
ALTER TABLE `offre`
  ADD CONSTRAINT `offre_ibfk_1` FOREIGN KEY (`id_produit`) REFERENCES `produit` (`id_produit`);

--
-- Contraintes pour la table `panier`
--
ALTER TABLE `panier`
  ADD CONSTRAINT `panier_ibfk_1` FOREIGN KEY (`id_acheteur`) REFERENCES `panier` (`id_panier`);

--
-- Contraintes pour la table `produit`
--
ALTER TABLE `produit`
  ADD CONSTRAINT `produit_ibfk_1` FOREIGN KEY (`id_vendeur`) REFERENCES `vendeur` (`id_vendeur`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
