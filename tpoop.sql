-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 17 avr. 2023 à 15:04
-- Version du serveur : 10.4.27-MariaDB
-- Version de PHP : 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `tpoop`
--

-- --------------------------------------------------------

--
-- Structure de la table `imagevoiture`
--

CREATE TABLE `imagevoiture` (
  `id` int(11) NOT NULL,
  `id_voiture` int(11) NOT NULL,
  `image` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `imagevoiture`
--

INSERT INTO `imagevoiture` (`id`, `id_voiture`, `image`) VALUES
(2, 21, 'http://localhost/Rest/image/1.jpg'),
(3, 21, 'http://localhost/Rest/image/1.jpg'),
(4, 21, 'http://localhost/Rest/image/1.jpg'),
(5, 21, 'http://localhost/Rest/image/1.jpg'),
(6, 20, 'http://localhost/Rest/image/1.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `marque`
--

CREATE TABLE `marque` (
  `id` int(11) NOT NULL,
  `nom_marque` varchar(256) NOT NULL,
  `created_at` datetime NOT NULL,
  `updatted_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `marque`
--

INSERT INTO `marque` (`id`, `nom_marque`, `created_at`, `updatted_at`) VALUES
(1, 'mercedes', '2023-04-01 15:58:30', '0000-00-00 00:00:00'),
(2, 'koko', '2023-04-05 14:03:27', '2023-04-13 03:08:34');

-- --------------------------------------------------------

--
-- Structure de la table `model`
--

CREATE TABLE `model` (
  `id` int(11) NOT NULL,
  `nom_model` varchar(10) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `age` int(11) NOT NULL,
  `designation` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updatted_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `model`
--

INSERT INTO `model` (`id`, `nom_model`, `email`, `age`, `designation`, `created_at`, `updatted_at`) VALUES
(1, 'sev1', NULL, 0, '', '2023-04-02 16:04:39', '2023-04-13 02:47:51'),
(7, 'truk1', NULL, 0, '', '2023-04-11 16:55:22', '2023-04-13 03:02:30');

-- --------------------------------------------------------

--
-- Structure de la table `reservation`
--

CREATE TABLE `reservation` (
  `id` int(11) NOT NULL,
  `nom` varchar(10) DEFAULT NULL,
  `adresse` varchar(20) DEFAULT NULL,
  `prenom` varchar(10) DEFAULT NULL,
  `mail` varchar(10) DEFAULT NULL,
  `phone` int(11) DEFAULT NULL,
  `id_voiture` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updatted_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `reservation`
--

INSERT INTO `reservation` (`id`, `nom`, `adresse`, `prenom`, `mail`, `phone`, `id_voiture`, `created_at`, `updatted_at`) VALUES
(23, 'oussama', '9  rue', 'alou', 'e@gmail.co', 11142424, 21, '2023-04-11 19:01:57', '2023-04-11 19:01:57'),
(25, 'oussama', '9 rue', 'alouache', 'ou@gmaail.', 795669408, 21, '2023-04-12 18:38:56', '0000-00-00 00:00:00');

--
-- Déclencheurs `reservation`
--
DELIMITER $$
CREATE TRIGGER `hestorique des reservation` BEFORE INSERT ON `reservation` FOR EACH ROW begin
  insert into reservation_h (id,nom,prenom,adresse,phone,id_voiture,created_at,updatted_at) values (new.id, new.nom,new.prenom,new.adresse,new.phone,                   new.id_voiture,new.created_at,new.updatted_at);
end#
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `reservation_h`
--

CREATE TABLE `reservation_h` (
  `id` int(11) NOT NULL,
  `nom` varchar(10) DEFAULT NULL,
  `adresse` varchar(20) DEFAULT NULL,
  `prenom` varchar(10) DEFAULT NULL,
  `mail` varchar(10) DEFAULT NULL,
  `phone` int(11) DEFAULT NULL,
  `id_voiture` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updatted_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `reservation_h`
--

INSERT INTO `reservation_h` (`id`, `nom`, `adresse`, `prenom`, `mail`, `phone`, `id_voiture`, `created_at`, `updatted_at`) VALUES
(1, 'oussama', '9  rue', 'alou', NULL, 11142424, 21, '2023-04-11 19:01:57', '2023-04-11 19:01:57'),
(2, 'oussama', '9  rue', 'alou', NULL, 11142424, 21, '2023-04-11 19:01:57', '2023-04-11 19:01:57'),
(3, 'oussama', '9 rue', 'alouache', NULL, 795669408, 21, '2023-04-12 18:38:56', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(256) NOT NULL,
  `Lastname` varchar(150) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updatted_at` datetime NOT NULL,
  `adress` varchar(50) DEFAULT NULL,
  `phone` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `name`, `Lastname`, `email`, `created_at`, `updatted_at`, `adress`, `phone`) VALUES
(19, 'ousama', '', 'oussama@oussama.com', '2023-04-03 01:39:19', '2023-04-03 01:39:19', NULL, NULL),
(20, 'oussama', '', NULL, '2023-04-03 01:53:06', '0000-00-00 00:00:00', NULL, NULL),
(21, 'oussama1', '', 'oussùa1ma@gmail.com', '2023-04-03 01:58:11', '0000-00-00 00:00:00', NULL, NULL),
(22, 'oussama1', '', 'oussùa11ma@gmail.com', '2023-04-03 02:14:28', '0000-00-00 00:00:00', NULL, NULL),
(23, 'oussama1', '', 'oussùa11ma@gmail.com', '2023-04-03 02:16:13', '0000-00-00 00:00:00', NULL, NULL),
(24, 'oussama1', '', 'oussùa11ma@gmail.com', '2023-04-03 02:23:44', '0000-00-00 00:00:00', NULL, NULL),
(25, 'oussama1', '', 'oussùa11ma@gmail.com', '2023-04-03 02:24:51', '0000-00-00 00:00:00', NULL, NULL),
(26, 'oussama1', '', 'oussùa11ma@gmail.com', '2023-04-03 02:28:42', '0000-00-00 00:00:00', NULL, NULL),
(27, 'oussama1', '', 'oussùa11ma@gmail.com', '2023-04-03 02:30:17', '0000-00-00 00:00:00', NULL, NULL),
(28, 'oussama1', '', 'oussùa11ma@gmail.com', '2023-04-03 02:46:34', '0000-00-00 00:00:00', NULL, NULL),
(29, 'oussama1', '', 'oussùa11ma@gmail.com', '2023-04-03 03:07:51', '0000-00-00 00:00:00', NULL, NULL),
(30, 'oussama1', '', 'oussùa11ma@gmail.com', '2023-04-03 03:08:02', '0000-00-00 00:00:00', NULL, NULL),
(31, 'oussama1', '', 'oussùa11ma@gmail.com', '2023-04-03 15:04:55', '0000-00-00 00:00:00', NULL, NULL),
(32, 'oussama1', '', 'oussùa11ma@gmail.com', '2023-04-03 15:07:49', '0000-00-00 00:00:00', '123', 123),
(33, 'oussama1', '', 'oussùa11ma@gmail.com', '2023-04-03 15:07:51', '0000-00-00 00:00:00', '123', 123);

-- --------------------------------------------------------

--
-- Structure de la table `voiture`
--

CREATE TABLE `voiture` (
  `id` int(11) NOT NULL,
  `nom` varchar(256) NOT NULL,
  `id_marque` int(11) NOT NULL,
  `id_model` int(11) NOT NULL,
  `matricule` varchar(150) NOT NULL,
  `created_at` datetime NOT NULL,
  `updatted_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `km` int(11) DEFAULT NULL,
  `etat` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `voiture`
--

INSERT INTO `voiture` (`id`, `nom`, `id_marque`, `id_model`, `matricule`, `created_at`, `updatted_at`, `km`, `etat`) VALUES
(89, 'ibiza', 1, 1, '123', '2023-04-12 19:28:33', '2023-04-13 01:49:48', 0, 'bon'),
(90, 'glc', 1, 1, 'fdsfsdfsfs', '2023-04-12 19:35:28', '2023-04-12 17:35:28', 0, 'nouv');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `imagevoiture`
--
ALTER TABLE `imagevoiture`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `marque`
--
ALTER TABLE `marque`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `model`
--
ALTER TABLE `model`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `reservation_h`
--
ALTER TABLE `reservation_h`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `voiture`
--
ALTER TABLE `voiture`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `imagevoiture`
--
ALTER TABLE `imagevoiture`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `marque`
--
ALTER TABLE `marque`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `model`
--
ALTER TABLE `model`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT pour la table `reservation_h`
--
ALTER TABLE `reservation_h`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT pour la table `voiture`
--
ALTER TABLE `voiture`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
