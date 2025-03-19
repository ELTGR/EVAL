-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  mer. 19 mars 2025 à 14:53
-- Version du serveur :  5.7.17
-- Version de PHP :  5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `data_base`
--
CREATE DATABASE IF NOT EXISTS `data_base` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `data_base`;

-- --------------------------------------------------------

--
-- Structure de la table `historique`
--

DROP TABLE IF EXISTS `historique`;
CREATE TABLE `historique` (
  `id_joueur_1` varchar(100) DEFAULT NULL,
  `id_joueur_2` varchar(100) DEFAULT NULL,
  `id_boxeur_j1` varchar(100) DEFAULT NULL,
  `id_boxeur_j2` varchar(100) DEFAULT NULL,
  `id_joueur_vainqueur` varchar(100) DEFAULT NULL,
  `date_du_combat` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `personnages`
--

DROP TABLE IF EXISTS `personnages`;
CREATE TABLE `personnages` (
  `nom` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `prenom` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `pseudonyme` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `point_de_vie` int(100) DEFAULT NULL,
  `vitesse` int(100) DEFAULT NULL,
  `puissance` int(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

DROP TABLE IF EXISTS `utilisateurs`;
CREATE TABLE `utilisateurs` (
  `pseudo` varchar(100) DEFAULT NULL,
  `mdp` varchar(100) DEFAULT NULL,
  `nom` varchar(100) DEFAULT NULL,
  `prenom` varchar(100) DEFAULT NULL,
  `genre` int(10) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
