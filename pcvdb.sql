-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mar 30 Janvier 2018 à 17:54
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `pcvdb`
--

-- --------------------------------------------------------

--
-- Structure de la table `avis`
--

CREATE TABLE IF NOT EXISTS `avis` (
  `id_avis` int(20) NOT NULL AUTO_INCREMENT,
  `datail` varchar(500) CHARACTER SET latin1 NOT NULL DEFAULT '',
  `id_user` int(20) NOT NULL,
  PRIMARY KEY (`id_avis`),
  KEY `id_user` (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE IF NOT EXISTS `categorie` (
  `id_cat` int(20) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(25) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`id_cat`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Contenu de la table `categorie`
--

INSERT INTO `categorie` (`id_cat`, `libelle`) VALUES
(6, 'Produit laitier'),
(7, 'Viande-Poisson-Oeuf'),
(8, 'Fruit & Légume'),
(9, 'Epicerie'),
(10, 'Boulangerie'),
(11, 'Boisson'),
(12, 'Viande'),
(13, 'croissant'),
(14, 'oeuf');

-- --------------------------------------------------------

--
-- Structure de la table `producteur`
--

CREATE TABLE IF NOT EXISTS `producteur` (
  `id_user` varchar(10) CHARACTER SET latin1 NOT NULL,
  `prenom` varchar(100) CHARACTER SET latin1 NOT NULL,
  `nom` varchar(25) CHARACTER SET latin1 NOT NULL,
  `nphoto` varchar(200) CHARACTER SET latin1 NOT NULL,
  `adresse` varchar(200) CHARACTER SET latin1 NOT NULL,
  `cp` int(11) NOT NULL,
  `ville` varchar(100) CHARACTER SET latin1 NOT NULL,
  `tel` varchar(20) CHARACTER SET latin1 DEFAULT NULL,
  `mail` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `pres` varchar(500) CHARACTER SET latin1 NOT NULL,
  `etat` int(1) NOT NULL,
  `affiche_contact` int(11) NOT NULL DEFAULT '1',
  `lat` float NOT NULL,
  `lon` float NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `producteur`
--

INSERT INTO `producteur` (`id_user`, `prenom`, `nom`, `nphoto`, `adresse`, `cp`, `ville`, `tel`, `mail`, `pres`, `etat`, `affiche_contact`, `lat`, `lon`) VALUES
('13', 'madani', 'meziane', 't?l?chargement.jpg', '9 rue armand berbes', 35000, 'rennes', '0758026177', 'meziane_madani@hotmail.com', 'blablablablablaba ', 0, 1, 48.1112, -1.66362),
('14', 'koko', 'toto', 'photoProducteur/madani03@live.fr.jpeg', '10 rue armand barbes', 35000, 'Rennes', '0652613335', 'madani03@live.fr', ' sfzefze', 0, 1, 48.111, -1.6631),
('15', 'kamal', 'Bello', 'photoProducteur/kam@gmail.com.jpeg', '35 Rue vitor hugo', 75000, 'PARIS', '0652610346', 'kam@gmail.com', ' moi', 0, 2, 48.9016, 2.37017),
('16', 'fifi', 'mimi', 'photoProducteur/mada@hotmail.com.jpeg', '30 av prof Charles Foulon', 35700, 'Rennes', '0758026177', 'mada@hotmail.com', ' dfgdf', 0, 2, 48.1206, -1.64455),
('5', 'Hounkanrin', 'Viviane', 'produits-laitiers.jpg', '31 av prof Charles Foulon', 35700, 'Rennes', '0652613346', 'hounkanrinvg@gmail.com', ' jhghjghj', 0, 1, 48.1235, -1.64264),
('7', 'homb', 'HOUN', 'produits-laitiers.jpg', '31 av prof Charles Foulon', 35700, 'Rennes', '0652613346', 'nvg@gmail.com', ' ', 0, 1, 48.1235, -1.64264);

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

CREATE TABLE IF NOT EXISTS `produit` (
  `id_produit` int(11) NOT NULL AUTO_INCREMENT,
  `nom_produit` varchar(50) CHARACTER SET latin1 NOT NULL,
  `description` varchar(200) CHARACTER SET latin1 NOT NULL,
  `prix` double NOT NULL,
  `id_user` int(20) NOT NULL,
  `id_categorie` int(20) NOT NULL,
  `lien_photo` int(200) NOT NULL,
  PRIMARY KEY (`id_produit`),
  KEY `id_user` (`id_user`),
  KEY `id_categorie` (`id_categorie`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `produit`
--

INSERT INTO `produit` (`id_produit`, `nom_produit`, `description`, `prix`, `id_user`, `id_categorie`, `lien_photo`) VALUES
(1, 'lait', ' lait', 0, 5, 6, 0),
(2, 'Boeuf', ' viande de boeuf', 3, 5, 7, 0),
(3, 'tomate', ' tomate fra?che ', 0.8, 5, 9, 0);

-- --------------------------------------------------------

--
-- Structure de la table `scategorie`
--

CREATE TABLE IF NOT EXISTS `scategorie` (
  `id_scat` int(20) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(200) CHARACTER SET latin1 NOT NULL,
  `id_cat` int(11) NOT NULL,
  PRIMARY KEY (`id_scat`),
  KEY `id_cat` (`id_cat`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `scategorie`
--

INSERT INTO `scategorie` (`id_scat`, `libelle`, `id_cat`) VALUES
(1, 'Lait', 6),
(2, 'Volaille', 7),
(3, 'pain', 10);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(25) CHARACTER SET latin1 NOT NULL,
  `mdp` varchar(200) CHARACTER SET latin1 NOT NULL,
  `user_type` int(1) NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`id_user`, `login`, `mdp`, `user_type`) VALUES
(5, 'Viviane', '548831b7e4aec2af721010c520de7fd622a22d96b6d51a26e53614c330ae1c21', 0),
(6, 'hart', 'dd6b079f455bea52b8550b78cb5ae6c78651d3d1db5039b337354f1b53cbc8a0', 1),
(7, 'homb', '5ee5cf411e99e523d079b8d682a8412ad88593daf4b1b31011d74a6124e4df45', 0),
(11, 'Ines', '2dc899c8e59c150e3ecbb44c2b2d3550bacf41c036de624d3eb1f275120dd733', 1),
(13, 'midou', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 0),
(14, 'kiki', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 0),
(15, 'kamal', 'fa835fb5da1fbbc3988516b4059e18b4adeb0e2facdbc3457ac2cfa5efefdd06', 0),
(16, 'fifi', '5bb080efe2cd3d9f2d0e33944aef97143f7710ba03e99a9f06a53d929bfaa64b', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
