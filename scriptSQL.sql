-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  jeu. 19 mars 2020 à 15:11
-- Version du serveur :  10.4.10-MariaDB
-- Version de PHP :  7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `discord`
--

-- --------------------------------------------------------

--
-- Structure de la table `appartient`
--

CREATE TABLE `appartient` (
  `utilisateur` int(11) NOT NULL,
  `classe` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `classe`
--

CREATE TABLE `classe` (
  `id_classe` int(11) NOT NULL,
  `niveau_classe` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `communique`
--

CREATE TABLE `communique` (
  `utilisateur` int(11) NOT NULL,
  `salle` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `salle_chat`
--

CREATE TABLE `salle_chat` (
  `id` int(11) NOT NULL,
  `message` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) DEFAULT NULL,
  `prenom` varchar(50) DEFAULT NULL,
  `mail` varchar(500) DEFAULT NULL,
  `est_admin` tinyint(1) NOT NULL,
  `est_professeur` tinyint(1) NOT NULL,
  `mdp` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `nom`, `prenom`, `mail`, `est_admin`, `est_professeur`, `mdp`) VALUES
(1, 'Vandenhove', 'Quentin', 'quentin.vandenhove@viacesi.fr', 1, 0, '$2y$10$gTo4BhapgNxaVzqfmg7vnO/EzBIFB97NdQ7tSvscfsjztiu3GhqGe'),
(2, 'Andrieu', 'Quentin', 'quentin.andrieu1@vaicesi.fr', 1, 0, '$2y$10$PS7J0fz7DB/662q0DrjkFOIZs/EOmXA/Vf/ffoqY.MOUoq6vudDMe'),
(6, 'Caflers', 'Frédéric', 'fcaflers@cesi.fr', 0, 1, '$2y$10$bqrX5qZMYrP39IASAzqszu3iQBuUeXjBTJyNpsdwZUvhX7LoOfKfu');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `appartient`
--
ALTER TABLE `appartient`
  ADD PRIMARY KEY (`utilisateur`,`classe`),
  ADD KEY `FK_Appartient_id_Classe` (`classe`);

--
-- Index pour la table `classe`
--
ALTER TABLE `classe`
  ADD PRIMARY KEY (`id_classe`);

--
-- Index pour la table `communique`
--
ALTER TABLE `communique`
  ADD PRIMARY KEY (`utilisateur`,`salle`),
  ADD KEY `FK_Communique_id_salle_salle_chat` (`salle`);

--
-- Index pour la table `salle_chat`
--
ALTER TABLE `salle_chat`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `appartient`
--
ALTER TABLE `appartient`
  MODIFY `utilisateur` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `classe`
--
ALTER TABLE `classe`
  MODIFY `id_classe` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `communique`
--
ALTER TABLE `communique`
  MODIFY `utilisateur` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `salle_chat`
--
ALTER TABLE `salle_chat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `appartient`
--
ALTER TABLE `appartient`
  ADD CONSTRAINT `FK_Appartient_id_Classe` FOREIGN KEY (`classe`) REFERENCES `classe` (`id_classe`),
  ADD CONSTRAINT `FK_Appartient_id_utilisateur_Utilisateur` FOREIGN KEY (`utilisateur`) REFERENCES `utilisateur` (`id`);

--
-- Contraintes pour la table `communique`
--
ALTER TABLE `communique`
  ADD CONSTRAINT `FK_Communique_id_salle_salle_chat` FOREIGN KEY (`salle`) REFERENCES `salle_chat` (`id`),
  ADD CONSTRAINT `FK_Communique_id_utilisateur_Utilisateur` FOREIGN KEY (`utilisateur`) REFERENCES `utilisateur` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
