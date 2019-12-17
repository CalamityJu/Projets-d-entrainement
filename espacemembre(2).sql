-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le :  mar. 17 déc. 2019 à 15:38
-- Version du serveur :  5.7.24
-- Version de PHP :  7.2.11

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
-- Structure de la table `forum_forum`
--

CREATE TABLE `forum_forum` (
  `forum_id` int(11) NOT NULL,
  `forum_title` varchar(255) NOT NULL,
  `forum_description` varchar(255) NOT NULL,
  `auth_view` tinyint(2) NOT NULL,
  `auth_post` tinyint(2) NOT NULL,
  `auth_topic` tinyint(2) NOT NULL,
  `auth_annonce` tinyint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `forum_forum`
--

INSERT INTO `forum_forum` (`forum_id`, `forum_title`, `forum_description`, `auth_view`, `auth_post`, `auth_topic`, `auth_annonce`) VALUES
(1, 'Test', 'Forum de test', 1, 2, 5, 10);

-- --------------------------------------------------------

--
-- Structure de la table `forum_post`
--

CREATE TABLE `forum_post` (
  `post_id` int(11) NOT NULL,
  `post_message` text NOT NULL,
  `post_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `post_member_id` int(11) NOT NULL,
  `post_topic_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `forum_topic`
--

CREATE TABLE `forum_topic` (
  `topic_id` int(11) NOT NULL,
  `topic_title` varchar(255) NOT NULL,
  `topic_message` text NOT NULL,
  `topic_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `topic_member_id` int(11) NOT NULL,
  `topic_forum_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(4, 'Inscrit', 'inscrit@test.com', '$2y$10$NHcZqCkGwr1Hu0l8S93BtOJjPtVVwr7y8hB5mQhUU0oYWNTERzd/y', '', 'defaultAvatar.png', '', '2019-12-07 18:21:50', '909c420454695c790cc21573f84e2361f14e123b76444b6c415ef6061e1e2525', 3),
(5, 'Membre', 'membre@test.com', '$2y$10$fjYH2eV5Fa4dsdwA1ErgRe9i9/xMb9cA/WwSEt0yzpGfrb73O5fqW', '', 'defaultAvatar.png', '', '2019-12-07 18:31:48', '91510e2c2d6564dff50a9a2c200c188bf34be124e0475cd2775e21f7d6325c12', 3),
(6, 'Admin', 'admin@test.com', '$2y$10$j3aQy2/GhZnLigxxwt194u7SqgOI7RWmj8AGm.E9yQxsMqGnLPA.O', 'Petite description', 'defaultAvatar.png', 'Test', '2019-12-07 18:32:01', '1cda8abf6e7fbf06c724ffef5b5af562dcd7cf7e2d95d83b28731d6b8d0b5f03', 1),
(7, 'Modo', 'modo@test.com', '$2y$10$lnJb4EaA0C1Fw5BxDiie9OqN6zkK9JWkA5ytasC/R6EMyPrPcZI82', 'test', 'defaultAvatar.png', '', '2019-12-08 16:10:13', '885cf92c10659b44abed7ad4b31532942121dd5e3be0ee632a91b87c033f9321', 3),
(9, 'Test', 'test@test.com', '$2y$10$g5p7mhRtLoWlbfwab6C0heID/97DS.9Rmy11bHHlmIr.UwI9hHxzO', '', 'defaultAvatar.png', '', '2019-12-12 11:55:58', NULL, 3),
(10, 'Banni', 'banni@test.com', '$2y$10$2GUB1whbZfbxwaEL2d9Kje9CRZ6C4TYHpOdP1mbkGWb2OB/zXR5kq', '', 'defaultAvatar.png', '', '2019-12-13 12:20:29', NULL, 3);

-- --------------------------------------------------------

--
-- Structure de la table `membres_bannis`
--

CREATE TABLE `membres_bannis` (
  `id` int(11) NOT NULL,
  `banni_id` varchar(255) NOT NULL,
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
(4, 'Inscrit', 'registered', 1),
(5, 'Banni', 'ban', -1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `forum_forum`
--
ALTER TABLE `forum_forum`
  ADD PRIMARY KEY (`forum_id`);

--
-- Index pour la table `forum_post`
--
ALTER TABLE `forum_post`
  ADD PRIMARY KEY (`post_id`);

--
-- Index pour la table `forum_topic`
--
ALTER TABLE `forum_topic`
  ADD PRIMARY KEY (`topic_id`);

--
-- Index pour la table `membres`
--
ALTER TABLE `membres`
  ADD PRIMARY KEY (`membre_id`);

--
-- Index pour la table `membres_bannis`
--
ALTER TABLE `membres_bannis`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `forum_forum`
--
ALTER TABLE `forum_forum`
  MODIFY `forum_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `forum_post`
--
ALTER TABLE `forum_post`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `forum_topic`
--
ALTER TABLE `forum_topic`
  MODIFY `topic_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `membres`
--
ALTER TABLE `membres`
  MODIFY `membre_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `membres_bannis`
--
ALTER TABLE `membres_bannis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
