-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le :  Dim 08 déc. 2019 à 18:50
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
  `membre_signature` varchar(255) NOT NULL,
  `date_inscription` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `token_name` varchar(65) DEFAULT NULL,
  `role_id` int(11) NOT NULL DEFAULT '3'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Base de donnée regroupant les membres et les informations pour leur profil';

--
-- Déchargement des données de la table `membres`
--

INSERT INTO `membres` (`membre_id`, `membre_pseudo`, `membre_email`, `membre_mdp`, `membre_description`, `membre_photo`, `membre_signature`, `date_inscription`, `token_name`, `role_id`) VALUES
(4, 'Inscrit', 'inscrit@test.com', '$2y$10$NHcZqCkGwr1Hu0l8S93BtOJjPtVVwr7y8hB5mQhUU0oYWNTERzd/y', '', 'defaultAvatar.png', '', '2019-12-07 18:21:50', '909c420454695c790cc21573f84e2361f14e123b76444b6c415ef6061e1e2525', 4),
(5, 'Membre', 'membre@test.com', '$2y$10$fjYH2eV5Fa4dsdwA1ErgRe9i9/xMb9cA/WwSEt0yzpGfrb73O5fqW', '', 'defaultAvatar.png', '', '2019-12-07 18:31:48', '91510e2c2d6564dff50a9a2c200c188bf34be124e0475cd2775e21f7d6325c12', 3),
(6, 'Admin', 'admin@test.com', '$2y$10$j3aQy2/GhZnLigxxwt194u7SqgOI7RWmj8AGm.E9yQxsMqGnLPA.O', 'Test', 'defaultAvatar.png', 'Test', '2019-12-07 18:32:01', '9882ae442679d1cc4b2a6cf30e1fc1f9b412c775ebdc66cf63736df3ebca4893', 1),
(7, 'Modo', 'modo@test.com', '$2y$10$lnJb4EaA0C1Fw5BxDiie9OqN6zkK9JWkA5ytasC/R6EMyPrPcZI82', 'test', 'defaultAvatar.png', '', '2019-12-08 16:10:13', '885cf92c10659b44abed7ad4b31532942121dd5e3be0ee632a91b87c033f9321', 2),
(8, 'Test', 'banni@test.com', '$2y$10$u2l/hh/x..kwCz/fYXwfIOibGVbVZYZPTgtFzAf2LYcKCavOrO3ai', '', 'defaultAvatar.png', '', '2019-12-08 17:56:46', 'b9cf88c9f9a878510f2ed81bea2a7681152610f443fee824ac96a8e57c21d280', 3),
(9, 'Banni', 'test@test.com', '$2y$10$BbNdQz4LwnSpeZpgsLvfLe6cMgUnyFru7UaiJf9y0juV9gCGFji5i', '', 'defaultAvatar.png', '', '2019-12-08 17:58:04', '8ec192272dd2dbc2b4fb5e1f42b9b3c5318fa0544329c61a0ba478b542e0bc35', 3);

-- --------------------------------------------------------

--
-- Structure de la table `membres_bannis`
--

CREATE TABLE `membres_bannis` (
  `banni_id` int(11) NOT NULL,
  `banni_ip` varchar(255) NOT NULL,
  `banni_pseudo` varchar(255) NOT NULL,
  `banni_mail` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `level` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `roles`
--

INSERT INTO `roles` (`id`, `name`, `slug`, `level`) VALUES
(1, 'Administrateur', 'admin', 10),
(2, 'Modérateur', 'modo', 5),
(3, 'Membre', 'member', 2),
(4, 'Inscrit', 'registered', 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `membres`
--
ALTER TABLE `membres`
  ADD PRIMARY KEY (`membre_id`);

--
-- Index pour la table `membres_bannis`
--
ALTER TABLE `membres_bannis`
  ADD PRIMARY KEY (`banni_id`);

--
-- Index pour la table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `membres`
--
ALTER TABLE `membres`
  MODIFY `membre_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `membres_bannis`
--
ALTER TABLE `membres_bannis`
  MODIFY `banni_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
