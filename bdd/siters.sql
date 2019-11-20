-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  lun. 18 nov. 2019 à 16:02
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
-- Base de données :  `siters`
--
CREATE DATABASE IF NOT EXISTS `siters` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
USE `siters`;

-- --------------------------------------------------------

--
-- Structure de la table `classe`
--

DROP TABLE IF EXISTS `classe`;
CREATE TABLE IF NOT EXISTS `classe` (
  `id_classe` int(10) NOT NULL AUTO_INCREMENT,
  `nom_classe` varchar(255) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id_classe`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `classe`
--

INSERT INTO `classe` (`id_classe`, `nom_classe`) VALUES
(14, 'Non defini'),
(15, 'SLAM'),
(16, 'SISR'),
(17, 'SEN'),
(18, 'TU'),
(19, 'MEI'),
(20, 'CPRP');

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

DROP TABLE IF EXISTS `message`;
CREATE TABLE IF NOT EXISTS `message` (
  `id_message` int(10) NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) COLLATE utf8_bin NOT NULL,
  `texte` varchar(255) COLLATE utf8_bin NOT NULL,
  `date` date NOT NULL,
  `classe` int(10) NOT NULL,
  `utilisateur` int(10) NOT NULL,
  PRIMARY KEY (`id_message`),
  KEY `classe` (`classe`),
  KEY `utilisateur` (`utilisateur`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `message`
--

INSERT INTO `message` (`id_message`, `titre`, `texte`, `date`, `classe`, `utilisateur`) VALUES
(4, 'Demande d\'alternance', 'Bonjour, je suis Ã  la recherche d\'une alternance.\r\n\r\nActuellement en BTS SIO Slam....', '2019-10-14', 15, 5),
(8, 'Recherche d\'alternance', 'Bonjour, \r\nJe suis actuellement en deuxiÃ¨me annÃ©e de BTS et je recherche une alternance pour valider mon BTS.\r\nJe suis motivÃ© et dynamique.\r\nPour plus d\'information contacter moi au 06.23.34.34.56.\r\nCordialement ', '2019-11-18', 15, 28);

-- --------------------------------------------------------

--
-- Structure de la table `post`
--

DROP TABLE IF EXISTS `post`;
CREATE TABLE IF NOT EXISTS `post` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) COLLATE utf8_bin NOT NULL,
  `texte` varchar(1000) COLLATE utf8_bin NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `post`
--

INSERT INTO `post` (`id`, `titre`, `texte`, `date`) VALUES
(39, 'Tournoi de foot', 'Un tournoi de foot est organisÃ© le 31 dÃ©cembre 2019 Ã  lâ€™occasion des fÃªtes de fin d\'annÃ©e.Â ', '2019-11-18'),
(41, 'RÃ©union parents \\ professeurs', 'La rÃ©union parents professeurs aura lieu le Samedi 11 Janvier 2020. N\'oubliÃ© pas de vous inscrire.', '2019-11-18');

-- --------------------------------------------------------

--
-- Structure de la table `role`
--

DROP TABLE IF EXISTS `role`;
CREATE TABLE IF NOT EXISTS `role` (
  `id_role` int(10) NOT NULL AUTO_INCREMENT,
  `nom_role` varchar(255) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id_role`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `role`
--

INSERT INTO `role` (`id_role`, `nom_role`) VALUES
(1, 'etu'),
(2, 'adm');

-- --------------------------------------------------------

--
-- Structure de la table `users_online`
--

DROP TABLE IF EXISTS `users_online`;
CREATE TABLE IF NOT EXISTS `users_online` (
  `id_utilisateur` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `users_online`
--

INSERT INTO `users_online` (`id_utilisateur`) VALUES
(4);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `id_utilisateur` int(10) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8_bin NOT NULL,
  `prenom` varchar(255) COLLATE utf8_bin NOT NULL,
  `email` varchar(255) COLLATE utf8_bin NOT NULL,
  `mdp` varchar(255) COLLATE utf8_bin NOT NULL,
  `classe` int(10) DEFAULT NULL,
  `role` int(10) NOT NULL DEFAULT '1',
  `activite` date DEFAULT NULL,
  `decryptKey` varchar(255) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id_utilisateur`),
  KEY `role` (`role`),
  KEY `classe` (`classe`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id_utilisateur`, `nom`, `prenom`, `email`, `mdp`, `classe`, `role`, `activite`, `decryptKey`) VALUES
(4, 'admin', 'admin', 'admin@admin', 'admin', 14, 2, '2019-11-18', ''),
(26, 'Moulin', 'Louis', 'playfade93@gmail.com', 'Abc123', 15, 1, '2019-11-17', 'Vkf4R4'),
(27, 'Dubois', 'Maxime', 'l.moulin@lprs.fr', 'Passw45', 14, 1, '2019-11-01', 'L7DpNf'),
(28, 'Laillier', 'Corentin', 'c.laillier@lprs.fr', 'Popo14', 15, 1, '2019-11-18', '8CsXfm');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
