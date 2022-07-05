-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 05 juil. 2022 à 20:10
-- Version du serveur : 10.4.19-MariaDB
-- Version de PHP : 8.1.2

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
  `firstNameList` varchar(255) DEFAULT NULL,
  `lastName` varchar(255) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `birthNameList` varchar(255) DEFAULT NULL COMMENT 'example: if born as mother name',
  `maidenName` varchar(100) DEFAULT NULL,
  `nickNameList` varchar(255) DEFAULT NULL,
  `otherLastNameList` varchar(255) DEFAULT NULL COMMENT 'Autres noms de famille (erreurs sur les documents, patronymes, noms d''emprunts, ...)',
  `gender` enum('1','0','2') DEFAULT '2' COMMENT '0 -> female, 1 -> male, 2 -> undefined/other',
  `birthDay` date DEFAULT NULL,
  `birthCity` bigint(20) DEFAULT NULL,
  `birthAccuracyLocation` varchar(255) DEFAULT NULL,
  `deathDate` date DEFAULT NULL,
  `deathCity` bigint(20) DEFAULT NULL,
  `deathAccuracyLocation` varchar(255) DEFAULT NULL,
  `cemeteryCity` bigint(20) DEFAULT NULL,
  `cemeteryAccuracyLocation` bigint(20) DEFAULT NULL,
  `biography` text DEFAULT NULL,
  `author` varchar(25) NOT NULL,
  `lastUpdate` timestamp NOT NULL DEFAULT current_timestamp(),
  `createDate` timestamp NOT NULL DEFAULT '2020-12-31 23:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `ancestor`
--

INSERT INTO `ancestor` (`id`, `firstNameList`, `lastName`, `photo`, `birthNameList`, `maidenName`, `nickNameList`, `otherLastNameList`, `gender`, `birthDay`, `birthCity`, `birthAccuracyLocation`, `deathDate`, `deathCity`, `deathAccuracyLocation`, `cemeteryCity`, `cemeteryAccuracyLocation`, `biography`, `author`, `lastUpdate`, `createDate`) VALUES
(1, 'claudio', 'dupond', 'example.jpeg', NULL, NULL, NULL, NULL, '1', '1944-03-02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'geneager', '2022-01-13 19:52:00', '2020-12-31 23:00:00'),
(7, 'sabrina nad&egrave;ge', 'dupond', NULL, NULL, 'fraise', NULL, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'geneager', '2022-06-06 11:01:29', '2020-12-31 23:00:00'),
(8, '&Eacute;dric', 'dupond', NULL, NULL, NULL, NULL, NULL, '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'geneager', '2022-01-18 12:04:26', '2020-12-31 23:00:00'),
(9, 'nad&egrave;ge', 'lait', NULL, NULL, NULL, NULL, NULL, '0', '1944-01-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'geneager', '2022-06-06 12:05:29', '2020-12-31 23:00:00'),
(10, 'cristiano', 'dupond', NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'geneager', '2022-01-18 12:05:56', '2020-12-31 23:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `ancestor_archive`
--

CREATE TABLE `ancestor_archive` (
  `idRelation` int(11) NOT NULL,
  `idAncestor` bigint(20) NOT NULL,
  `idArchive` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `archive`
--

CREATE TABLE `archive` (
  `id` bigint(20) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL,
  `location` bigint(20) NOT NULL COMMENT 'ID City',
  `accuracyLocation` varchar(255) DEFAULT NULL,
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
  `id` bigint(20) NOT NULL,
  `stateDepartement` bigint(20) NOT NULL,
  `city` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `city`
--

INSERT INTO `city` (`id`, `stateDepartement`, `city`) VALUES
(1, 1, 'lille');

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
-- Structure de la table `jobname`
--

CREATE TABLE `jobname` (
  `id` bigint(20) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `jobname_ancestor`
--

CREATE TABLE `jobname_ancestor` (
  `idRelation` bigint(20) NOT NULL,
  `idJob` bigint(20) NOT NULL,
  `idAncestor` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `parameter`
--

CREATE TABLE `parameter` (
  `id` bigint(20) NOT NULL,
  `parameter` varchar(255) NOT NULL,
  `value` text DEFAULT NULL
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
(15, 'aboutText', 'Free personnal genealogy website...'),
(16, 'albumListSummary', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.');

-- --------------------------------------------------------

--
-- Structure de la table `parent`
--

CREATE TABLE `parent` (
  `idRelation` int(11) NOT NULL,
  `idChildren` bigint(20) NOT NULL,
  `idParent` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `picture`
--

CREATE TABLE `picture` (
  `id` bigint(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `descript` varchar(535) DEFAULT NULL,
  `filename` varchar(255) NOT NULL,
  `location` bigint(20) DEFAULT NULL,
  `accuracyLocation` varchar(255) DEFAULT NULL,
  `dateEvent` int(8) DEFAULT NULL COMMENT 'Type date ne convient pas (min an 1000)',
  `sourceText` varchar(100) DEFAULT NULL,
  `sourceLink` text DEFAULT NULL,
  `folder` bigint(20) NOT NULL,
  `lastUpdate` timestamp NOT NULL DEFAULT current_timestamp(),
  `createDate` timestamp NOT NULL DEFAULT '2020-12-31 23:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `picturefolder`
--

CREATE TABLE `picturefolder` (
  `id` bigint(20) NOT NULL,
  `title` varchar(100) NOT NULL,
  `descript` varchar(535) NOT NULL,
  `author` varchar(25) NOT NULL,
  `cover` bigint(20) DEFAULT NULL COMMENT 'picture for album cover',
  `lastUpdate` timestamp NOT NULL DEFAULT current_timestamp(),
  `createDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `visibility` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `picturefolder`
--

INSERT INTO `picturefolder` (`id`, `title`, `descript`, `author`, `cover`, `lastUpdate`, `createDate`, `visibility`) VALUES
(1, 'Mariage de Martin Dupond', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ad perferendis inventore, nihil libero voluptatem enim.', 'geneager', NULL, '2021-06-07 15:16:03', '2022-06-07 15:16:34', '0'),
(2, 'Mariage de Henri Durant', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ad perferendis inventore, nihil libero voluptatem enim.', 'geneager', NULL, '2022-06-07 15:16:03', '2022-06-07 15:16:34', '0'),
(20, 'Lorem ipsum', 'Test public 999', 'user', NULL, '2022-06-26 13:43:49', '2022-06-26 13:43:49', '0');

-- --------------------------------------------------------

--
-- Structure de la table `picturetag`
--

CREATE TABLE `picturetag` (
  `id` bigint(20) NOT NULL,
  `ancestor` bigint(20) NOT NULL,
  `coordinates` varchar(23) NOT NULL,
  `pictureID` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `relationancestor`
--

CREATE TABLE `relationancestor` (
  `id` bigint(20) NOT NULL,
  `unionType` varchar(60) NOT NULL,
  `ancestor1` bigint(20) NOT NULL,
  `ancestor2` bigint(20) NOT NULL,
  `descript` varchar(255) DEFAULT NULL,
  `dateevt` int(8) DEFAULT NULL,
  `location` bigint(20) DEFAULT NULL,
  `accuracyLocation` varchar(255) DEFAULT NULL,
  `sourceText` varchar(100) DEFAULT NULL,
  `sourceLink` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `relationtype`
--

CREATE TABLE `relationtype` (
  `id` int(2) NOT NULL,
  `name` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `relationtype`
--

INSERT INTO `relationtype` (`id`, `name`) VALUES
(1, 'mariage'),
(2, 'pacse');

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

--
-- Déchargement des données de la table `statedepartement`
--

INSERT INTO `statedepartement` (`id`, `country`, `stateDepartement`) VALUES
(1, 'france', 'nord');

-- --------------------------------------------------------

--
-- Structure de la table `transitpoint`
--

CREATE TABLE `transitpoint` (
  `id` bigint(20) NOT NULL,
  `ancestor` bigint(20) NOT NULL,
  `city` bigint(20) NOT NULL,
  `accuracyLocation` varchar(255) DEFAULT NULL COMMENT 'Eventuel complément d''adresse',
  `descriptionEvent` varchar(255) DEFAULT NULL,
  `transitType` varchar(50) NOT NULL,
  `dateStart` int(8) NOT NULL COMMENT 'date ne supporte pas les années<1000',
  `dateEnd` int(8) DEFAULT NULL COMMENT 'date ne supporte pas les années<1000'
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
  `identity` varchar(50) DEFAULT NULL,
  `signup_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT 'date inscription',
  `banned` enum('0','1') NOT NULL DEFAULT '0',
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password_algo` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `username`, `role`, `identity`, `signup_date`, `banned`, `password`, `email`, `password_algo`) VALUES
(1, 'geneager', 'admin', 'Administrateur syst&egrave;me', '2022-06-24 11:03:11', '0', '1653392393,0f8770e025b865dca674ac039dcb578265245ed96f30d881688a74e9cdc6ec2784ad055795be04a4', 'admin@system.tld', 'ripemd320'),
(2, 'user', 'user', 'Administrateur syst&egrave;me', '2022-05-24 11:40:04', '0', '1653392393,0f8770e025b865dca674ac039dcb578265245ed96f30d881688a74e9cdc6ec2784ad055795be04a4', 'user@system.tld', 'ripemd320');

-- --------------------------------------------------------

--
-- Structure de la table `video`
--

CREATE TABLE `video` (
  `id` bigint(20) NOT NULL,
  `titre` varchar(200) NOT NULL,
  `descript` varchar(255) DEFAULT NULL,
  `location` bigint(20) DEFAULT NULL,
  `accuracyLocation` varchar(255) DEFAULT NULL,
  `resume` text DEFAULT NULL,
  `conversation` mediumtext DEFAULT NULL,
  `filename` varchar(200) NOT NULL,
  `htmlCode` text NOT NULL,
  `dateEvent` int(8) DEFAULT NULL,
  `sourceLink` text DEFAULT NULL,
  `sourceText` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `videotag`
--

CREATE TABLE `videotag` (
  `id` bigint(20) NOT NULL,
  `ancestor` bigint(20) NOT NULL,
  `coordinates` varchar(23) NOT NULL COMMENT 'ex: 10,150,70,278',
  `video` bigint(20) NOT NULL,
  `startShow` int(4) NOT NULL,
  `endShow` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `ancestor`
--
ALTER TABLE `ancestor`
  ADD PRIMARY KEY (`id`),
  ADD KEY `author` (`author`),
  ADD KEY `birthCity` (`birthCity`),
  ADD KEY `deathCity` (`deathCity`),
  ADD KEY `cemeteryCity` (`cemeteryCity`);

--
-- Index pour la table `ancestor_archive`
--
ALTER TABLE `ancestor_archive`
  ADD PRIMARY KEY (`idRelation`),
  ADD KEY `idAncestor` (`idAncestor`),
  ADD KEY `idArchive` (`idArchive`);

--
-- Index pour la table `archive`
--
ALTER TABLE `archive`
  ADD PRIMARY KEY (`id`),
  ADD KEY `auhor` (`author`),
  ADD KEY `locationFKarchive` (`location`);

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
-- Index pour la table `jobname`
--
ALTER TABLE `jobname`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `jobname_ancestor`
--
ALTER TABLE `jobname_ancestor`
  ADD PRIMARY KEY (`idRelation`),
  ADD KEY `idjobFK` (`idJob`),
  ADD KEY `idancestorFK` (`idAncestor`);

--
-- Index pour la table `parameter`
--
ALTER TABLE `parameter`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `parent`
--
ALTER TABLE `parent`
  ADD PRIMARY KEY (`idRelation`),
  ADD KEY `childrenFK` (`idChildren`),
  ADD KEY `parentFK` (`idParent`);

--
-- Index pour la table `picture`
--
ALTER TABLE `picture`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cityFKpicture` (`location`),
  ADD KEY `folderFKidFolder` (`folder`);

--
-- Index pour la table `picturefolder`
--
ALTER TABLE `picturefolder`
  ADD PRIMARY KEY (`id`),
  ADD KEY `authorFK` (`author`);

--
-- Index pour la table `picturetag`
--
ALTER TABLE `picturetag`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pictureFK` (`pictureID`);

--
-- Index pour la table `relationancestor`
--
ALTER TABLE `relationancestor`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ancestor1` (`ancestor1`),
  ADD KEY `ancestor2` (`ancestor2`),
  ADD KEY `uniontypeFK` (`location`),
  ADD KEY `unionFKtype` (`unionType`);

--
-- Index pour la table `relationtype`
--
ALTER TABLE `relationtype`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

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
  ADD KEY `transitType` (`transitType`),
  ADD KEY `city` (`city`),
  ADD KEY `ancestor` (`ancestor`);

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `cityFKvideo` (`location`);

--
-- Index pour la table `videotag`
--
ALTER TABLE `videotag`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ancestorID` (`ancestor`),
  ADD KEY `videoID` (`video`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `ancestor`
--
ALTER TABLE `ancestor`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `ancestor_archive`
--
ALTER TABLE `ancestor_archive`
  MODIFY `idRelation` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `archive`
--
ALTER TABLE `archive`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `city`
--
ALTER TABLE `city`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `country`
--
ALTER TABLE `country`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `jobname`
--
ALTER TABLE `jobname`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `jobname_ancestor`
--
ALTER TABLE `jobname_ancestor`
  MODIFY `idRelation` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `parameter`
--
ALTER TABLE `parameter`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `parent`
--
ALTER TABLE `parent`
  MODIFY `idRelation` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `picture`
--
ALTER TABLE `picture`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `picturefolder`
--
ALTER TABLE `picturefolder`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT pour la table `picturetag`
--
ALTER TABLE `picturetag`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `relationancestor`
--
ALTER TABLE `relationancestor`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `relationtype`
--
ALTER TABLE `relationtype`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `statedepartement`
--
ALTER TABLE `statedepartement`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `video`
--
ALTER TABLE `video`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `videotag`
--
ALTER TABLE `videotag`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `ancestor`
--
ALTER TABLE `ancestor`
  ADD CONSTRAINT `author` FOREIGN KEY (`author`) REFERENCES `user` (`username`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `birthCity` FOREIGN KEY (`birthCity`) REFERENCES `city` (`id`),
  ADD CONSTRAINT `cemeteryCity` FOREIGN KEY (`cemeteryCity`) REFERENCES `city` (`id`),
  ADD CONSTRAINT `deathCity` FOREIGN KEY (`deathCity`) REFERENCES `city` (`id`);

--
-- Contraintes pour la table `ancestor_archive`
--
ALTER TABLE `ancestor_archive`
  ADD CONSTRAINT `idAncestor` FOREIGN KEY (`idAncestor`) REFERENCES `ancestor` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `idArchive` FOREIGN KEY (`idArchive`) REFERENCES `archive` (`id`);

--
-- Contraintes pour la table `archive`
--
ALTER TABLE `archive`
  ADD CONSTRAINT `auhor` FOREIGN KEY (`author`) REFERENCES `user` (`username`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `locationFKarchive` FOREIGN KEY (`location`) REFERENCES `city` (`id`);

--
-- Contraintes pour la table `city`
--
ALTER TABLE `city`
  ADD CONSTRAINT `idStateDepartement` FOREIGN KEY (`stateDepartement`) REFERENCES `statedepartement` (`id`);

--
-- Contraintes pour la table `jobname_ancestor`
--
ALTER TABLE `jobname_ancestor`
  ADD CONSTRAINT `idancestorFK` FOREIGN KEY (`idAncestor`) REFERENCES `ancestor` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `idjobFK` FOREIGN KEY (`idJob`) REFERENCES `jobname` (`id`);

--
-- Contraintes pour la table `parent`
--
ALTER TABLE `parent`
  ADD CONSTRAINT `childrenFK` FOREIGN KEY (`idChildren`) REFERENCES `ancestor` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `parentFK` FOREIGN KEY (`idParent`) REFERENCES `ancestor` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `picture`
--
ALTER TABLE `picture`
  ADD CONSTRAINT `cityFKpicture` FOREIGN KEY (`location`) REFERENCES `city` (`id`),
  ADD CONSTRAINT `folderFKidFolder` FOREIGN KEY (`folder`) REFERENCES `picturefolder` (`id`);

--
-- Contraintes pour la table `picturefolder`
--
ALTER TABLE `picturefolder`
  ADD CONSTRAINT `authorFK` FOREIGN KEY (`author`) REFERENCES `user` (`username`);

--
-- Contraintes pour la table `picturetag`
--
ALTER TABLE `picturetag`
  ADD CONSTRAINT `pictureFK` FOREIGN KEY (`pictureID`) REFERENCES `picture` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `relationancestor`
--
ALTER TABLE `relationancestor`
  ADD CONSTRAINT `ancestor1` FOREIGN KEY (`ancestor1`) REFERENCES `ancestor` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ancestor2` FOREIGN KEY (`ancestor2`) REFERENCES `ancestor` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `locationFKunion` FOREIGN KEY (`location`) REFERENCES `city` (`id`),
  ADD CONSTRAINT `unionFKtype` FOREIGN KEY (`unionType`) REFERENCES `relationtype` (`name`);

--
-- Contraintes pour la table `statedepartement`
--
ALTER TABLE `statedepartement`
  ADD CONSTRAINT `country` FOREIGN KEY (`country`) REFERENCES `country` (`country`);

--
-- Contraintes pour la table `transitpoint`
--
ALTER TABLE `transitpoint`
  ADD CONSTRAINT `ancestor` FOREIGN KEY (`ancestor`) REFERENCES `ancestor` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `city` FOREIGN KEY (`city`) REFERENCES `city` (`id`),
  ADD CONSTRAINT `transitType` FOREIGN KEY (`transitType`) REFERENCES `transittype` (`title`);

--
-- Contraintes pour la table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `role` FOREIGN KEY (`role`) REFERENCES `role` (`name`);

--
-- Contraintes pour la table `video`
--
ALTER TABLE `video`
  ADD CONSTRAINT `cityFKvideo` FOREIGN KEY (`location`) REFERENCES `city` (`id`);

--
-- Contraintes pour la table `videotag`
--
ALTER TABLE `videotag`
  ADD CONSTRAINT `ancestorID` FOREIGN KEY (`ancestor`) REFERENCES `ancestor` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `videoID` FOREIGN KEY (`video`) REFERENCES `video` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
