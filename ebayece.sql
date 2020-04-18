-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  ven. 17 avr. 2020 à 09:35
-- Version du serveur :  5.7.26
-- Version de PHP :  7.2.18

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `acheteur`
--

INSERT INTO `acheteur` (`id_acheteur`, `prenom`, `nom`, `email`, `password`, `date_anniversaire`) VALUES
(1, 'Romain', 'Bernard', 'rom1ain92@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', '2020-04-09'),
(3, 'test', 'test', 'test@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', '2020-04-18');

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

-- --------------------------------------------------------

--
-- Structure de la table `enchere`
--

DROP TABLE IF EXISTS `enchere`;
CREATE TABLE IF NOT EXISTS `enchere` (
  `id_enchere` bigint(50) NOT NULL AUTO_INCREMENT,
  `date_debut` datetime NOT NULL,
  `date_fin` datetime NOT NULL,
  `prix` decimal(10,0) NOT NULL,
  `prix_surencheri` decimal(10,0) NOT NULL,
  `id_produit` bigint(50) NOT NULL,
  PRIMARY KEY (`id_enchere`),
  KEY `id_produit` (`id_produit`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `meilleur_offre_vente` decimal(10,0) NOT NULL,
  `meilleur_offre_achat` decimal(10,0) NOT NULL,
  `id_produit` bigint(50) NOT NULL,
  PRIMARY KEY (`id_offre`),
  KEY `id_produit` (`id_produit`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `description` varchar(255) NOT NULL,
  `prix` double NOT NULL,
  `video` varchar(255) NOT NULL,
  `type_vente` varchar(50) NOT NULL,
  `categorie` varchar(11) NOT NULL,
  `id_vendeur` bigint(20) NOT NULL,
  PRIMARY KEY (`id_produit`),
  KEY `id_vendeur` (`id_vendeur`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`id_produit`, `nom`, `description`, `prix`, `video`, `type_vente`, `categorie`, `id_vendeur`) VALUES
(1, 'testproduit', 'blabla', 10, 'video.test', 'achat immediat', 'vip', 1);

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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `vendeur`
--

INSERT INTO `vendeur` (`id_vendeur`, `prenom`, `nom`, `email`, `password`, `date_anniversaire`) VALUES
(1, '', '', 'testvendeur@gmail.com', 'test', '2020-04-01'),
(2, 'Alexandre', 'Bernard', 'alex92@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', '2020-04-26'),
(4, 'aline', 'Bernard', 'rom1ain92@gmail.com', 'f56d6351aa71cff0debea014d13525e42036187a', '2020-04-02'),
(5, 'rrrrrr', 'Bernard', 'rom1ain92@gmail.com', 'f56d6351aa71cff0debea014d13525e42036187a', '2020-04-04');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `enchere`
--
ALTER TABLE `enchere`
  ADD CONSTRAINT `enchere_ibfk_1` FOREIGN KEY (`id_produit`) REFERENCES `enchere` (`id_enchere`);

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
  ADD CONSTRAINT `offre_ibfk_1` FOREIGN KEY (`id_produit`) REFERENCES `offre` (`id_offre`);

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
