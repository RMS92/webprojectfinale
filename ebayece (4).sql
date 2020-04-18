-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  sam. 18 avr. 2020 à 20:10
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
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `achat_direct`
--

INSERT INTO `achat_direct` (`id_achat`, `statut_vente`, `id_produit`) VALUES
(20, 'non vendu', 26),
(21, 'non vendu', 27),
(22, 'non vendu', 28),
(23, 'non vendu', 32),
(24, 'non vendu', 33),
(25, 'non vendu', 34),
(26, 'non vendu', 36),
(27, 'non vendu', 37),
(28, 'non vendu', 38),
(29, 'non vendu', 41),
(30, 'non vendu', 42),
(31, 'non vendu', 43),
(32, 'non vendu', 45),
(33, 'non vendu', 47),
(34, 'non vendu', 49),
(35, 'non vendu', 51);

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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `enchere`
--

INSERT INTO `enchere` (`id_enchere`, `date_fin`, `heure_fin`, `prix_surencheri`, `statut_vente`, `id_produit`) VALUES
(7, '2020-04-30', '15:00:00', '5', 'non vendu', 31),
(8, '2020-05-06', '14:00:00', '1400', 'non vendu', 35),
(9, '2020-06-13', '15:00:00', '200', 'non vendu', 40),
(10, '2020-05-01', '11:00:00', '100', 'non vendu', 44),
(11, '2020-06-24', '09:01:00', '220', 'non vendu', 48);

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
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `offre`
--

INSERT INTO `offre` (`id_offre`, `statut_vente`, `id_produit`) VALUES
(5, 'non vendu', 27),
(6, 'non vendu', 29),
(7, 'non vendu', 33),
(8, 'non vendu', 37),
(9, 'non vendu', 39),
(10, 'non vendu', 41),
(11, 'non vendu', 43),
(12, 'non vendu', 46),
(13, 'non vendu', 50);

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
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`id_produit`, `nom`, `prix`, `categorie`, `description`, `photo`, `video`, `id_vendeur`) VALUES
(26, 'Double bague', 120, 'feraille ou tresor', 'magnifiques bagues en deux exemplaires', 'double_bague.png', '', 6),
(27, 'Alliances', 80, 'feraille ou tresor', 'Des alliances pour un mariage par exemple', 'alliance.png', '', 6),
(28, 'bijoux royales', 250, 'feraille ou tresor', 'authentique bijoux de la couronne du Danemark', 'Bijoux_royales.jpg', '', 6),
(29, 'Chevaliere rose', 500, 'feraille ou tresor', 'Chevaliere ayant appartenu au roi de Finlande', 'chevaliere_rose.png', '', 6),
(31, 'Kabale', 20, 'feraille ou tresor', 'Porte chance je vous assure', 'roux_Kabale.png', '', 8),
(32, 'collier coeur ', 50, 'feraille ou tresor', 'Parfait pour la saint Valentin', 'collier_coeur.png', '', 8),
(33, 'Tresor africain ', 300, 'feraille ou tresor', 'Rarissime et tendance, vous ne serez insatisfait\r\n', 'tresor_africain.png', '', 8),
(34, 'Perles', 80, 'feraille ou tresor', 'Perles du Guatemala', 'perles.png', '', 8),
(35, 'Joconde', 1500, 'bon pour le muse', 'la joconde de Leonard de Vinci', 'Joconde.png', '', 9),
(36, 'peinture impressioniste ', 600, 'bon pour le muse', 'peinture du 19 eme siecle ', 'peinture_impressioniste.png', '', 9),
(37, 'Art moderne', 550, 'bon pour le muse', 'Peinture de Mr Kobayashi', 'art_moderne.png', '', 9),
(38, 'La Cene vide ', 350, 'bon pour le muse', 'Le cauchemar des acteurs ', 'cÃ¨ne_vide.png', '', 9),
(39, 'Art comtemporain', 190, 'bon pour le muse', 'Peinture d un etudiant en art', 'art_comtemporain.png', '', 6),
(40, 'La folie ', 230, 'bon pour le muse', 'Tableau des plus impressionnants', 'la_folie.png', '', 6),
(41, 'Les joueurs de cartes', 560, 'feraille ou tresor', 'oeuvre historique sur les ravages de la guerre', 'cartes.png', '', 6),
(42, 'Playmobil', 1000, 'bon pour le muse', 'Beau et original, que demander de plus ', 'playmobil.png', '', 6),
(43, 'Veste Gucci', 560, 'accesoires vip', 'Veste en poil de belette', 'veste_gucci.jpg', '', 10),
(44, 'T-shirt Gucci', 140, 'accesoires vip', 'Authentique t-shirt', 'tshirt_gucci.jpg', '', 10),
(45, 'tshirt Versace', 440, 'accesoires vip', 't-shirt luxueux pour personnes luxueuses', 'tshirt_versace.jpg', '', 10),
(46, 'Peignoir Versace', 690, 'accesoires vip', 'Versace pour vous servir, Versace pour vous seduire', 'peignoire_versace.jpg', '', 10),
(47, 'Rolex ', 1200, 'accesoires vip', 'Montre ayant appartenu au fameux  Roger Federer', 'rolex.jpg', '', 8),
(48, 'Montre winner', 280, 'accesoires vip', 'La montre pour les winners ', 'montre_winner.jpg', '', 8),
(49, 'Casquette de luxe ', 230, 'accesoires vip', 'Casquette avec un dessin de tigre ', 'casquette_luxe.jpg', '', 8),
(50, 'Bonnet UGG', 20, 'accesoires vip', 'Bonnet parfait pour la saison hivernale', 'bonnet_ugg.jpg', '', 8),
(51, 'Visiere Louis Vuitton', 540, 'accesoires vip', 'Le soleil ne sera plus votre ennemi', 'visiere_lv.jpg', '', 8);

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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `vendeur`
--

INSERT INTO `vendeur` (`id_vendeur`, `prenom`, `nom`, `email`, `password`, `date_anniversaire`) VALUES
(1, '', '', 'testvendeur@gmail.com', 'test', '2020-04-01'),
(2, 'Alexandre', 'Bernard', 'alex92@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', '2020-04-26'),
(6, 'client', 'gentil', 'clientgentil@gmail.com', 'bb0b6647e93b6fb3593e649f301d6c4b49990a8a', '2020-04-02'),
(7, 'momo', 'henni', 'mh@gmail.com', 'mh', '2020-04-02'),
(8, 'Jean', 'Til', 'jt@gmail.com', '0857133ffcd232122dc51ad55bf5fcc9d60af5d3', '2000-01-03'),
(9, 'Harry', 'Fer', 'hf@gmail.com', 'd3ccb842d38eff2c38fd0e2bf167305b0af6e86e', '2010-02-17'),
(10, 'Momo ', 'Teur', 'mt@gmail.com', '0658929a32fcad205df089c884250dd482df435b', '1997-04-11');

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
