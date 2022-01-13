-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 13 jan. 2022 à 22:24
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
  `photo` varchar(255) DEFAULT NULL,
  `birthNameList` varchar(255) NOT NULL COMMENT 'example: if born as mother name',
  `maidenName` varchar(100) NOT NULL,
  `nickNameList` varchar(255) NOT NULL,
  `otherLastNameList` varchar(255) NOT NULL COMMENT 'Autres noms de famille (erreurs sur les documents, patronymes, noms d''emprunts, ...)',
  `gender` tinyint(1) NOT NULL COMMENT '0 -> female, 1 -> male',
  `birthDay` date DEFAULT NULL,
  `deathDate` date DEFAULT NULL,
  `biography` text NOT NULL,
  `author` varchar(25) NOT NULL,
  `lastUpdate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `ancestor`
--

INSERT INTO `ancestor` (`id`, `firstNameList`, `lastName`, `photo`, `birthNameList`, `maidenName`, `nickNameList`, `otherLastNameList`, `gender`, `birthDay`, `deathDate`, `biography`, `author`, `lastUpdate`) VALUES
(1, '&eacute;mile', '&eacute;milien', '', '', '', '', '', 1, NULL, NULL, '', 'geneager', '2022-01-13 19:52:00');

-- --------------------------------------------------------

--
-- Structure de la table `archive`
--

CREATE TABLE `archive` (
  `id` bigint(20) NOT NULL,
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
-- Structure de la table `city`
--

CREATE TABLE `city` (
  `id` int(11) NOT NULL,
  `stateDepartement` bigint(20) NOT NULL,
  `city` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `country`
--

CREATE TABLE `country` (
  `id` int(11) NOT NULL,
  `country` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `country`
--

INSERT INTO `country` (`id`, `country`) VALUES
(4, 'allemagne'),
(2, 'belgique'),
(1, 'france'),
(3, 'pologne');

-- --------------------------------------------------------

--
-- Structure de la table `parameter`
--

CREATE TABLE `parameter` (
  `id` bigint(20) NOT NULL,
  `parameter` varchar(255) NOT NULL,
  `value` text NOT NULL
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
(13, 'passwordMaxLength', '30'),
(14, 'homeSummary', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.'),
(15, 'aboutText', 'Free personnal genealogy website...');

-- --------------------------------------------------------

--
-- Structure de la table `picture`
--

CREATE TABLE `picture` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
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
-- Structure de la table `statedepartement`
--

CREATE TABLE `statedepartement` (
  `id` bigint(20) NOT NULL,
  `country` varchar(150) NOT NULL,
  `stateDepartement` varchar(150) NOT NULL COMMENT 'Etat ou département'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `transitpoint`
--

CREATE TABLE `transitpoint` (
  `id` bigint(20) NOT NULL,
  `ancestor` bigint(20) NOT NULL,
  `descriptionEvent` varchar(255) NOT NULL,
  `transitType` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `transittype`
--

CREATE TABLE `transittype` (
  `id` int(11) NOT NULL,
  `fontAwesome` varchar(50) NOT NULL,
  `title` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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

-- --------------------------------------------------------

--
-- Structure de la table `video`
--

CREATE TABLE `video` (
  `id` bigint(20) NOT NULL,
  `titre` varchar(200) NOT NULL,
  `descript` varchar(255) NOT NULL,
  `resume` text NOT NULL,
  `conversation` mediumtext NOT NULL,
  `filename` varchar(200) NOT NULL,
  `htmlCode` text NOT NULL,
  `dateEvent` int(8) DEFAULT NULL,
  `sourceLink` text NOT NULL,
  `sourceText` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `ancestor`
--
ALTER TABLE `ancestor`
  ADD PRIMARY KEY (`id`),
  ADD KEY `author` (`author`);

--
-- Index pour la table `archive`
--
ALTER TABLE `archive`
  ADD PRIMARY KEY (`id`),
  ADD KEY `auhor` (`author`);

--
-- Index pour la table `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idStateDepartement` (`stateDepartement`);

--
-- Index pour la table `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `country` (`country`);

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
-- Index pour la table `statedepartement`
--
ALTER TABLE `statedepartement`
  ADD PRIMARY KEY (`id`),
  ADD KEY `country` (`country`);

--
-- Index pour la table `transitpoint`
--
ALTER TABLE `transitpoint`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transitType` (`transitType`);

--
-- Index pour la table `transittype`
--
ALTER TABLE `transittype`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `title` (`title`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uniqueUsername` (`username`),
  ADD KEY `role` (`role`);

--
-- Index pour la table `video`
--
ALTER TABLE `video`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `city`
--
ALTER TABLE `city`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `country`
--
ALTER TABLE `country`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `parameter`
--
ALTER TABLE `parameter`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

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
-- AUTO_INCREMENT pour la table `statedepartement`
--
ALTER TABLE `statedepartement`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `transitpoint`
--
ALTER TABLE `transitpoint`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `transittype`
--
ALTER TABLE `transittype`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `video`
--
ALTER TABLE `video`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `ancestor`
--
ALTER TABLE `ancestor`
  ADD CONSTRAINT `author` FOREIGN KEY (`author`) REFERENCES `user` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `archive`
--
ALTER TABLE `archive`
  ADD CONSTRAINT `auhor` FOREIGN KEY (`author`) REFERENCES `user` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `city`
--
ALTER TABLE `city`
  ADD CONSTRAINT `idStateDepartement` FOREIGN KEY (`stateDepartement`) REFERENCES `statedepartement` (`id`);

--
-- Contraintes pour la table `picturetag`
--
ALTER TABLE `picturetag`
  ADD CONSTRAINT `ancestorID` FOREIGN KEY (`ancestor`) REFERENCES `ancestor` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pictureID` FOREIGN KEY (`picture`) REFERENCES `picture` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `statedepartement`
--
ALTER TABLE `statedepartement`
  ADD CONSTRAINT `country` FOREIGN KEY (`country`) REFERENCES `country` (`country`);

--
-- Contraintes pour la table `transitpoint`
--
ALTER TABLE `transitpoint`
  ADD CONSTRAINT `transitType` FOREIGN KEY (`transitType`) REFERENCES `transittype` (`title`);

--
-- Contraintes pour la table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `role` FOREIGN KEY (`role`) REFERENCES `role` (`name`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
