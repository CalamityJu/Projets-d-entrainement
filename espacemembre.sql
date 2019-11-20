-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le :  mer. 20 nov. 2019 à 06:40
-- Version du serveur :  5.7.24
-- Version de PHP :  7.2.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `espacemembre`
--

-- --------------------------------------------------------

--
-- Structure de la table `membres`
--

CREATE TABLE `membres` (
  `membre_id` int(11) NOT NULL,
  `membre_pseudo` varchar(50) NOT NULL,
  `membre_email` varchar(50) NOT NULL,
  `membre_mdp` text NOT NULL,
  `membre_description` text NOT NULL,
  `membre_photo` text NOT NULL,
  `membre_thumbnail` text NOT NULL,
  `membre_signature` varchar(255) NOT NULL,
  `date_inscription` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `token_name` varchar(65) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Base de donnée regroupant les membres et les informations pour leur profil';

--
-- Déchargement des données de la table `membres`
--

INSERT INTO `membres` (`membre_id`, `membre_pseudo`, `membre_email`, `membre_mdp`, `membre_description`, `membre_photo`, `membre_thumbnail`, `membre_signature`, `date_inscription`, `token_name`) VALUES
(1, 'test', 'test@test.com', '$2y$10$Vxv0Z/L4yXu1AnCGfb2a5esEU8IyNpo0v4SmmrS1V1H0.Lo3tibEe', 'test', '', '', 'test', '2019-11-19 19:03:04', '513b9b4bd98cbd1e3fd8ac26955828882c3fd62ae5f9c257a58725d70b685453');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `membres`
--
ALTER TABLE `membres`
  ADD PRIMARY KEY (`membre_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `membres`
--
ALTER TABLE `membres`
  MODIFY `membre_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
