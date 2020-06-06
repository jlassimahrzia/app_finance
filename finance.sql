-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  sam. 06 juin 2020 à 15:04
-- Version du serveur :  10.1.33-MariaDB
-- Version de PHP :  7.2.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `finance`
--

-- --------------------------------------------------------

--
-- Structure de la table `effet`
--

CREATE TABLE `effet` (
  `id` int(11) NOT NULL,
  `id_entreprise` int(11) NOT NULL,
  `valeur` double NOT NULL,
  `debut` varchar(200) NOT NULL,
  `fin` varchar(200) NOT NULL,
  `banque` varchar(200) NOT NULL,
  `lieu` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `effet`
--

INSERT INTO `effet` (`id`, `id_entreprise`, `valeur`, `debut`, `fin`, `banque`, `lieu`) VALUES
(3, 3, 3200, '2020-10-08', '2020-10-28', 'BNA', 'GABES'),
(5, 3, 5700, '2020-10-08', '2020-12-04', 'STB', 'tunis'),
(6, 3, 6000, '2020-10-08', '2020-12-25', 'UBCI', 'sfax'),
(7, 3, 4500, '2020-10-08', '2020-11-08', 'biat', 'bizerte'),
(8, 4, 5000, '2020-08-07', '2020-10-07', 'BNA', 'bizerte'),
(9, 4, 1000, '2020-04-05', '2020-06-06', 'biat', 'tunis');

-- --------------------------------------------------------

--
-- Structure de la table `entreprise`
--

CREATE TABLE `entreprise` (
  `id` int(11) NOT NULL,
  `entreprise` varchar(200) NOT NULL,
  `banque` varchar(200) NOT NULL,
  `lieu` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `entreprise`
--

INSERT INTO `entreprise` (`id`, `entreprise`, `banque`, `lieu`) VALUES
(3, 'Focus', 'biat', 'tunis'),
(4, 'xyz', 'biat', 'tunis');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `effet`
--
ALTER TABLE `effet`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_entreprise` (`id_entreprise`);

--
-- Index pour la table `entreprise`
--
ALTER TABLE `entreprise`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `effet`
--
ALTER TABLE `effet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `entreprise`
--
ALTER TABLE `entreprise`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `effet`
--
ALTER TABLE `effet`
  ADD CONSTRAINT `effet_ibfk_1` FOREIGN KEY (`id_entreprise`) REFERENCES `entreprise` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
