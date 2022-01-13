-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 07 jan. 2022 à 13:36
-- Version du serveur :  10.4.19-MariaDB
-- Version de PHP : 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `geneager`
--
CREATE DATABASE IF NOT EXISTS `geneager` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `geneager`;

-- --------------------------------------------------------

--
-- Structure de la table `ancestor`
--

CREATE TABLE `ancestor` (
  `id` bigint(20) NOT NULL,
  `firstNameList` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `birthNameList` varchar(255) NOT NULL COMMENT 'example: if born as mother name',
  `maidenName` varchar(100) NOT NULL,
  `gender` tinyint(1) NOT NULL COMMENT '0 -> female, 1 -> male',
  `birthDay` date DEFAULT NULL,
  `deathDate` date DEFAULT NULL,
  `biography` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `ancestor`
--

INSERT INTO `ancestor` (`id`, `firstNameList`, `lastName`, `birthNameList`, `maidenName`, `gender`, `birthDay`, `deathDate`, `biography`) VALUES
(1, '&eacute;mile', '&eacute;milien', '', '', 1, NULL, NULL, '');

-- --------------------------------------------------------

--
-- Structure de la table `archive`
--

CREATE TABLE `archive` (
  `id` int(11) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL,
  `dateEvent` int(8) NOT NULL COMMENT 'Date ne convient pas (min l''an 1000)',
  `createDate` date NOT NULL,
  `author` varchar(25) NOT NULL,
  `sourceText` varchar(100) DEFAULT NULL,
  `callNumbers` varchar(50) DEFAULT NULL COMMENT 'cote du document',
  `sourceLink` text DEFAULT NULL,
  `ancestorTag` varchar(255) NOT NULL COMMENT 'id of ancestor for the current doc. ex: 1,4,8'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `parameter`
--

CREATE TABLE `parameter` (
  `id` bigint(20) NOT NULL,
  `parameter` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `parameter`
--

INSERT INTO `parameter` (`id`, `parameter`, `value`) VALUES
(1, 'separator', '&mdash;'),
(3, 'websiteName', 'Geneager'),
(4, 'defaultDescription', 'Site personnel de g&eacute;n&eacute;alogie'),
(5, 'defaultKeywordList', 'g&eacute;n&eacute;logie, site perso, archives'),
(6, 'favicon', 'favicon'),
(7, 'snFacebook', ''),
(8, 'snTwitter', 'test'),
(9, 'snInstagram', ''),
(10, 'usernameMinLength', '4'),
(11, 'usernameMaxLength', '25'),
(12, 'passwordMinLength', '7'),
(13, 'passwordMaxLength', '30');

-- --------------------------------------------------------

--
-- Structure de la table `picture`
--

CREATE TABLE `picture` (
  `id` int(11) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `descript` varchar(535) NOT NULL,
  `finename` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `dateEvent` int(8) NOT NULL COMMENT 'Type date ne convient pas (min an 1000)',
  `sourceText` varchar(100) NOT NULL,
  `sourceLink` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `picturetag`
--

CREATE TABLE `picturetag` (
  `id` bigint(20) NOT NULL,
  `ancestor` bigint(20) NOT NULL,
  `coordinates` varchar(23) NOT NULL COMMENT 'ex: 10,150,70,278',
  `picture` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `role`
--

CREATE TABLE `role` (
  `id` int(2) NOT NULL,
  `name` varchar(10) NOT NULL,
  `description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `role`
--

INSERT INTO `role` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Administrateur syst&egrave;me: poss&egrave;de tous les privill&egrave;ges.'),
(2, 'user', 'Fonctions basiques (commentaires, favoris, ...)');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `role` varchar(10) NOT NULL DEFAULT 'user',
  `identity` varchar(50) NOT NULL,
  `signup_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT 'date inscription',
  `banned` tinyint(1) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password_algo` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `username`, `role`, `identity`, `signup_date`, `banned`, `password`, `email`, `password_algo`) VALUES
(1, 'geneager', 'admin', 'Administrateur syst&egrave;me', '2021-12-02 12:36:44', 0, '1638447301,6c868a7121fd5b4b0fdacc87ed256e6e41fa7e791c0e039df14e6daf17e527022d05fada3aee20bd', 'admin@system.tld', 'ripemd320');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `ancestor`
--
ALTER TABLE `ancestor`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `archive`
--
ALTER TABLE `archive`
  ADD PRIMARY KEY (`id`),
  ADD KEY `auhor` (`author`);

--
-- Index pour la table `parameter`
--
ALTER TABLE `parameter`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `picture`
--
ALTER TABLE `picture`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `picturetag`
--
ALTER TABLE `picturetag`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pictureID` (`picture`),
  ADD KEY `ancestorID` (`ancestor`);

--
-- Index pour la table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uniqueUsername` (`username`),
  ADD KEY `role` (`role`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `ancestor`
--
ALTER TABLE `ancestor`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `archive`
--
ALTER TABLE `archive`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `parameter`
--
ALTER TABLE `parameter`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT pour la table `picture`
--
ALTER TABLE `picture`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `picturetag`
--
ALTER TABLE `picturetag`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `archive`
--
ALTER TABLE `archive`
  ADD CONSTRAINT `auhor` FOREIGN KEY (`author`) REFERENCES `user` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `picturetag`
--
ALTER TABLE `picturetag`
  ADD CONSTRAINT `ancestorID` FOREIGN KEY (`ancestor`) REFERENCES `ancestor` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pictureID` FOREIGN KEY (`picture`) REFERENCES `picture` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `role` FOREIGN KEY (`role`) REFERENCES `role` (`name`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
