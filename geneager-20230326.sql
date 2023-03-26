-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : dim. 26 mars 2023 à 23:28
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
  `maidenNameList` varchar(255) DEFAULT NULL,
  `nickNameList` varchar(255) DEFAULT NULL,
  `otherLastNameList` varchar(255) DEFAULT NULL COMMENT 'Autres noms de famille (erreurs sur les documents, patronymes, noms d''emprunts, ...)',
  `gender` enum('1','0','2') DEFAULT NULL COMMENT '0 -> female, 1 -> male, 2 -> undefined/other',
  `birthdayY` int(4) DEFAULT NULL,
  `birthdayM` int(2) DEFAULT NULL,
  `birthdayD` int(2) DEFAULT NULL,
  `birthCity` bigint(20) DEFAULT NULL,
  `birthAccuracyLocation` varchar(255) DEFAULT NULL,
  `deathdateM` int(2) DEFAULT NULL,
  `deathdateD` int(2) DEFAULT NULL,
  `deathdateY` int(4) DEFAULT NULL,
  `deathCity` bigint(20) DEFAULT NULL,
  `deathAccuracyLocation` varchar(255) DEFAULT NULL,
  `cemeteryCity` bigint(20) DEFAULT NULL,
  `cemeteryAccuracyLocation` varchar(255) DEFAULT NULL,
  `biography` text DEFAULT NULL,
  `author` varchar(25) NOT NULL,
  `lastUpdate` timestamp NOT NULL DEFAULT current_timestamp(),
  `createDate` timestamp NOT NULL DEFAULT '2020-12-31 23:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `ancestorarchive`
--

CREATE TABLE `ancestorarchive` (
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
  `name` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `city`
--

INSERT INTO `city` (`id`, `stateDepartement`, `name`) VALUES
(100, 60, 'Lille'),
(101, 63, 'Arras');

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
(227, '&eacute;gypte'),
(218, '&eacute;mirats Arabes Unis'),
(63, '&eacute;quateur'),
(67, '&eacute;rythr&eacute;e'),
(164, '&eacute;tats F&eacute;d&eacute;r&eacute;s de Micron&eacute;sie'),
(231, '&eacute;tats-Unis'),
(66, '&eacute;thiopie'),
(24, '&icirc;le Bouvet'),
(46, '&icirc;le Christmas'),
(229, '&icirc;le de Man'),
(160, '&icirc;le Norfolk'),
(70, '&icirc;les (malvinas) Falkland'),
(74, '&icirc;les Åland'),
(39, '&icirc;les Ca&iuml;manes'),
(47, '&icirc;les Cocos (Keeling)'),
(53, '&icirc;les Cook'),
(69, '&icirc;les F&eacute;ro&eacute;'),
(97, '&icirc;les Heard et Mcdonald'),
(162, '&icirc;les Mariannes du Nord'),
(165, '&icirc;les Marshall'),
(163, '&icirc;les Mineures &eacute;loign&eacute;es des &eacute;tats-Unis'),
(28, '&icirc;les Salomon'),
(222, '&icirc;les Turks et Ca&iuml;ques'),
(29, '&icirc;les Vierges Britanniques'),
(232, '&icirc;les Vierges des &eacute;tats-Unis'),
(1, 'Afghanistan'),
(201, 'Afrique du Sud'),
(2, 'Albanie'),
(4, 'Alg&eacute;rie'),
(84, 'Allemagne'),
(6, 'Andorre'),
(7, 'Angola'),
(186, 'Anguilla'),
(3, 'Antarctique'),
(8, 'Antigua-et-Barbuda'),
(151, 'Antilles N&eacute;erlandaises'),
(192, 'Arabie Saoudite'),
(10, 'Argentine'),
(16, 'Arm&eacute;nie'),
(152, 'Aruba'),
(11, 'Australie'),
(12, 'Autriche'),
(9, 'Azerba&iuml;djan'),
(34, 'B&eacute;larus'),
(59, 'B&eacute;nin'),
(13, 'Bahamas'),
(14, 'Bahre&iuml;n'),
(15, 'Bangladesh'),
(17, 'Barbade'),
(18, 'Belgique'),
(26, 'Belize'),
(19, 'Bermudes'),
(20, 'Bhoutan'),
(21, 'Bolivie'),
(22, 'Bosnie-Herz&eacute;govine'),
(23, 'Botswana'),
(25, 'Br&eacute;sil'),
(30, 'Brun&eacute;i Darussalam'),
(31, 'Bulgarie'),
(233, 'Burkina Faso'),
(33, 'Burundi'),
(35, 'Cambodge'),
(36, 'Cameroun'),
(37, 'Canada'),
(38, 'Cap-vert'),
(43, 'Chili'),
(44, 'Chine'),
(57, 'Chypre'),
(48, 'Colombie'),
(49, 'Comores'),
(54, 'Costa Rica'),
(110, 'Côte d\'Ivoire'),
(55, 'Croatie'),
(56, 'Cuba'),
(60, 'Danemark'),
(79, 'Djibouti'),
(61, 'Dominique'),
(64, 'El Salvador'),
(203, 'Espagne'),
(68, 'Estonie'),
(182, 'F&eacute;d&eacute;ration de Russie'),
(72, 'Fidji'),
(73, 'Finlande'),
(75, 'France'),
(81, 'G&eacute;orgie'),
(71, 'G&eacute;orgie du Sud et les &icirc;les Sandwich du Sud'),
(80, 'Gabon'),
(82, 'Gambie'),
(85, 'Ghana'),
(86, 'Gibraltar'),
(88, 'Gr&egrave;ce'),
(90, 'Grenade'),
(89, 'Groenland'),
(91, 'Guadeloupe'),
(92, 'Guam'),
(93, 'Guatemala'),
(94, 'Guin&eacute;e'),
(65, 'Guin&eacute;e &eacute;quatoriale'),
(176, 'Guin&eacute;e-Bissau'),
(95, 'Guyana'),
(76, 'Guyane Française'),
(96, 'Ha&iuml;ti'),
(99, 'Honduras'),
(100, 'Hong-Kong'),
(101, 'Hongrie'),
(103, 'Inde'),
(104, 'Indon&eacute;sie'),
(106, 'Iraq'),
(107, 'Irlande'),
(102, 'Islande'),
(108, 'Israël'),
(109, 'Italie'),
(111, 'Jama&iuml;que'),
(125, 'Jamahiriya Arabe Libyenne'),
(112, 'Japon'),
(114, 'Jordanie'),
(113, 'Kazakhstan'),
(115, 'Kenya'),
(119, 'Kirghizistan'),
(87, 'Kiribati'),
(118, 'Kowe&iuml;t'),
(226, 'L\'ex-R&eacute;publique Yougoslave de Mac&eacute;doine'),
(122, 'Lesotho'),
(123, 'Lettonie'),
(124, 'Lib&eacute;ria'),
(121, 'Liban'),
(126, 'Liechtenstein'),
(127, 'Lituanie'),
(128, 'Luxembourg'),
(129, 'Macao'),
(130, 'Madagascar'),
(132, 'Malaisie'),
(131, 'Malawi'),
(133, 'Maldives'),
(134, 'Mali'),
(135, 'Malte'),
(144, 'Maroc'),
(136, 'Martinique'),
(138, 'Maurice'),
(137, 'Mauritanie'),
(50, 'Mayotte'),
(139, 'Mexique'),
(140, 'Monaco'),
(141, 'Mongolie'),
(143, 'Montserrat'),
(145, 'Mozambique'),
(32, 'Myanmar'),
(149, 'N&eacute;pal'),
(147, 'Namibie'),
(148, 'Nauru'),
(156, 'Nicaragua'),
(158, 'Nig&eacute;ria'),
(157, 'Niger'),
(159, 'Niu&eacute;'),
(161, 'Norv&egrave;ge'),
(153, 'Nouvelle-Cal&eacute;donie'),
(155, 'Nouvelle-Z&eacute;lande'),
(146, 'Oman'),
(224, 'Ouganda'),
(235, 'Ouzb&eacute;kistan'),
(171, 'P&eacute;rou'),
(167, 'Pakistan'),
(166, 'Palaos'),
(168, 'Panama'),
(169, 'Papouasie-Nouvelle-Guin&eacute;e'),
(170, 'Paraguay'),
(150, 'Pays-Bas'),
(172, 'Philippines'),
(173, 'Pitcairn'),
(174, 'Pologne'),
(77, 'Polyn&eacute;sie Française'),
(178, 'Porto Rico'),
(175, 'Portugal'),
(179, 'Qatar'),
(211, 'R&eacute;publique Arabe Syrienne'),
(40, 'R&eacute;publique Centrafricaine'),
(52, 'R&eacute;publique D&eacute;mocratique du Congo'),
(120, 'R&eacute;publique D&eacute;mocratique Populaire Lao'),
(117, 'R&eacute;publique de Cor&eacute;e'),
(142, 'R&eacute;publique de Moldova'),
(62, 'R&eacute;publique Dominicaine'),
(51, 'R&eacute;publique du Congo'),
(105, 'R&eacute;publique Islamique d\'Iran'),
(116, 'R&eacute;publique Populaire D&eacute;mocratique de Cor&eacute;e'),
(58, 'R&eacute;publique Tch&egrave;que'),
(230, 'R&eacute;publique-Unie de Tanzanie'),
(180, 'R&eacute;union'),
(181, 'Roumanie'),
(228, 'Royaume-Uni'),
(183, 'Rwanda'),
(193, 'S&eacute;n&eacute;gal'),
(204, 'Sahara Occidental'),
(185, 'Saint-Kitts-et-Nevis'),
(190, 'Saint-Marin'),
(188, 'Saint-Pierre-et-Miquelon'),
(98, 'Saint-Si&egrave;ge (&eacute;tat de la Cit&eacute; du Vatican)'),
(189, 'Saint-Vincent-et-les Grenadines'),
(184, 'Sainte-H&eacute;l&egrave;ne'),
(187, 'Sainte-Lucie'),
(238, 'Samoa'),
(5, 'Samoa Am&eacute;ricaines'),
(191, 'Sao Tom&eacute;-et-Principe'),
(240, 'Serbie-et-Mont&eacute;n&eacute;gro'),
(194, 'Seychelles'),
(195, 'Sierra Leone'),
(196, 'Singapour'),
(199, 'Slov&eacute;nie'),
(197, 'Slovaquie'),
(200, 'Somalie'),
(205, 'Soudan'),
(41, 'Sri Lanka'),
(209, 'Su&egrave;de'),
(210, 'Suisse'),
(206, 'Suriname'),
(207, 'Svalbard et&icirc;le Jan Mayen'),
(208, 'Swaziland'),
(45, 'Ta&iuml;wan'),
(212, 'Tadjikistan'),
(42, 'Tchad'),
(78, 'Terres Australes Françaises'),
(27, 'Territoire Britannique de l\'Oc&eacute;an Indien'),
(83, 'Territoire Palestinien Occup&eacute;'),
(213, 'Tha&iuml;lande'),
(177, 'Timor-Leste'),
(214, 'Togo'),
(215, 'Tokelau'),
(216, 'Tonga'),
(217, 'Trinit&eacute;-et-Tobago'),
(219, 'Tunisie'),
(221, 'Turkm&eacute;nistan'),
(220, 'Turquie'),
(223, 'Tuvalu'),
(225, 'Ukraine'),
(234, 'Uruguay'),
(154, 'Vanuatu'),
(236, 'Venezuela'),
(198, 'Viet Nam'),
(237, 'Wallis et Futuna'),
(239, 'Y&eacute;men'),
(241, 'Zambie'),
(202, 'Zimbabwe');

-- --------------------------------------------------------

--
-- Structure de la table `jobname`
--

CREATE TABLE `jobname` (
  `id` bigint(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `descript` varchar(255) DEFAULT NULL
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
(16, 'albumListSummary', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.'),
(17, 'pictureMaxAge', '86400');

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
  `title` varchar(255) NOT NULL DEFAULT 'Sans titre',
  `descript` varchar(535) DEFAULT NULL,
  `filename` varchar(255) NOT NULL,
  `location` bigint(20) DEFAULT NULL,
  `accuracyLocation` varchar(255) DEFAULT NULL,
  `yearEvent` int(4) DEFAULT NULL COMMENT 'Type date ne convient pas (min an 1000)',
  `monthEvent` int(2) DEFAULT NULL,
  `dayEvent` int(2) DEFAULT NULL,
  `sourceText` varchar(100) DEFAULT NULL,
  `sourceLink` text DEFAULT NULL,
  `folder` bigint(20) NOT NULL,
  `lastUpdate` timestamp NOT NULL DEFAULT current_timestamp(),
  `createDate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `picturefolder`
--

CREATE TABLE `picturefolder` (
  `id` bigint(20) NOT NULL,
  `title` varchar(100) NOT NULL,
  `descript` varchar(535) DEFAULT NULL,
  `author` varchar(25) NOT NULL,
  `cover` bigint(20) DEFAULT NULL COMMENT 'picture for album cover',
  `lastUpdate` timestamp NOT NULL DEFAULT current_timestamp(),
  `createDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `public` enum('0','1') NOT NULL DEFAULT '0' COMMENT '1 - Public\r\n0 - Private (members only)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `name` varchar(150) NOT NULL COMMENT 'Etat ou département'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `statedepartement`
--

INSERT INTO `statedepartement` (`id`, `country`, `name`) VALUES
(1, 'France', 'Ain'),
(2, 'France', 'Aisne'),
(3, 'France', 'Allier'),
(4, 'France', 'Hautes-Alpes'),
(5, 'France', 'Alpes-de-Haute-Provence'),
(6, 'France', 'Alpes-Maritimes'),
(7, 'France', 'Ardèche'),
(8, 'France', 'Ardennes'),
(9, 'France', 'Ariège'),
(10, 'France', 'Aube'),
(11, 'France', 'Aude'),
(12, 'France', 'Aveyron'),
(13, 'France', 'Bouches-du-Rhône'),
(14, 'France', 'Calvados'),
(15, 'France', 'Cantal'),
(16, 'France', 'Charente'),
(17, 'France', 'Charente-Maritime'),
(18, 'France', 'Cher'),
(19, 'France', 'Corrèze'),
(20, 'France', 'Corse-du-sud'),
(21, 'France', 'Haute-corse'),
(22, 'France', 'Côte-d\'or'),
(23, 'France', 'Côtes-d\'armor'),
(24, 'France', 'Creuse'),
(25, 'France', 'Dordogne'),
(26, 'France', 'Doubs'),
(27, 'France', 'Drôme'),
(28, 'France', 'Eure'),
(29, 'France', 'Eure-et-Loir'),
(30, 'France', 'Finistère'),
(31, 'France', 'Gard'),
(32, 'France', 'Haute-Garonne'),
(33, 'France', 'Gers'),
(34, 'France', 'Gironde'),
(35, 'France', 'Hérault'),
(36, 'France', 'Ile-et-Vilaine'),
(37, 'France', 'Indre'),
(38, 'France', 'Indre-et-Loire'),
(39, 'France', 'Isère'),
(40, 'France', 'Jura'),
(41, 'France', 'Landes'),
(42, 'France', 'Loir-et-Cher'),
(43, 'France', 'Loire'),
(44, 'France', 'Haute-Loire'),
(45, 'France', 'Loire-Atlantique'),
(46, 'France', 'Loiret'),
(47, 'France', 'Lot'),
(48, 'France', 'Lot-et-Garonne'),
(49, 'France', 'Lozère'),
(50, 'France', 'Maine-et-Loire'),
(51, 'France', 'Manche'),
(52, 'France', 'Marne'),
(53, 'France', 'Haute-Marne'),
(54, 'France', 'Mayenne'),
(55, 'France', 'Meurthe-et-Moselle'),
(56, 'France', 'Meuse'),
(57, 'France', 'Morbihan'),
(58, 'France', 'Moselle'),
(59, 'France', 'Nièvre'),
(60, 'France', 'Nord'),
(61, 'France', 'Oise'),
(62, 'France', 'Orne'),
(63, 'France', 'Pas-de-Calais'),
(64, 'France', 'Puy-de-Dôme'),
(65, 'France', 'Pyrénées-Atlantiques'),
(66, 'France', 'Hautes-Pyrénées'),
(67, 'France', 'Pyrénées-Orientales'),
(68, 'France', 'Bas-Rhin'),
(69, 'France', 'Haut-Rhin'),
(70, 'France', 'Rhône'),
(71, 'France', 'Haute-Saône'),
(72, 'France', 'Saône-et-Loire'),
(73, 'France', 'Sarthe'),
(74, 'France', 'Savoie'),
(75, 'France', 'Haute-Savoie'),
(76, 'France', 'Paris'),
(77, 'France', 'Seine-Maritime'),
(78, 'France', 'Seine-et-Marne'),
(79, 'France', 'Yvelines'),
(80, 'France', 'Deux-Sèvres'),
(81, 'France', 'Somme'),
(82, 'France', 'Tarn'),
(83, 'France', 'Tarn-et-Garonne'),
(84, 'France', 'Var'),
(85, 'France', 'Vaucluse'),
(86, 'France', 'Vendée'),
(87, 'France', 'Vienne'),
(88, 'France', 'Haute-Vienne'),
(89, 'France', 'Vosges'),
(90, 'France', 'Yonne'),
(91, 'France', 'Territoire de Belfort'),
(92, 'France', 'Essonne'),
(93, 'France', 'Hauts-de-Seine'),
(94, 'France', 'Seine-Saint-Denis'),
(95, 'France', 'Val-de-Marne'),
(96, 'France', 'Val-d\'oise'),
(97, 'France', 'Mayotte'),
(98, 'France', 'Guadeloupe'),
(99, 'France', 'Guyane'),
(100, 'France', 'Martinique'),
(101, 'France', 'Réunion');

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
  `signupDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT 'date inscription',
  `banned` enum('0','1') NOT NULL DEFAULT '0',
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `passwordAlgo` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `username`, `role`, `identity`, `signupDate`, `banned`, `password`, `email`, `passwordAlgo`) VALUES
(1, 'geneager', 'admin', 'Admin', '2023-03-23 23:52:44', '0', '1653392393,0f8770e025b865dca674ac039dcb578265245ed96f30d881688a74e9cdc6ec2784ad055795be04a4', 'admin@system.tld2', 'ripemd320'),
(2, 'user', 'user', 'utilisateur', '2023-03-24 00:00:01', '0', '1653392393,0f8770e025b865dca674ac039dcb578265245ed96f30d881688a74e9cdc6ec2784ad055795be04a4', 'user@system.tld', 'ripemd320');

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
-- Index pour la table `ancestorarchive`
--
ALTER TABLE `ancestorarchive`
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
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `country` (`country`) USING BTREE;

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
  ADD KEY `countryFK` (`country`);

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
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT pour la table `ancestorarchive`
--
ALTER TABLE `ancestorarchive`
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
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT pour la table `country`
--
ALTER TABLE `country`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=242;

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
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT pour la table `parent`
--
ALTER TABLE `parent`
  MODIFY `idRelation` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `picture`
--
ALTER TABLE `picture`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT pour la table `picturefolder`
--
ALTER TABLE `picturefolder`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

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
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

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
-- Contraintes pour la table `ancestorarchive`
--
ALTER TABLE `ancestorarchive`
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
  ADD CONSTRAINT `stateDepartement` FOREIGN KEY (`stateDepartement`) REFERENCES `statedepartement` (`id`);

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
  ADD CONSTRAINT `countryFK` FOREIGN KEY (`country`) REFERENCES `country` (`country`);

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
