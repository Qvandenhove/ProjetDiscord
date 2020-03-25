-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  mer. 25 mars 2020 à 14:11
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

--
-- Déchargement des données de la table `appartient`
--

INSERT INTO `appartient` (`utilisateur`, `classe`) VALUES
(6, 3),
(9, 3);

-- --------------------------------------------------------

--
-- Structure de la table `classe`
--

CREATE TABLE `classe` (
                          `id_classe` int(11) NOT NULL,
                          `nom_classe` varchar(100) NOT NULL,
                          `niveau_classe` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `classe`
--

INSERT INTO `classe` (`id_classe`, `nom_classe`, `niveau_classe`) VALUES
(1, 'Flandres-Histoire 1', 'Terminale'),
(3, 'AP2019SE', 'BAC+1'),
(5, 'AP2018', 'BAC+2'),
(8, 'TEST', 'Terminale'),
(9, 'TESTClass', 'Terminale');

-- --------------------------------------------------------

--
-- Structure de la table `communique`
--

CREATE TABLE `communique` (
                              `utilisateur` int(11) NOT NULL,
                              `salle` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `communique`
--

INSERT INTO `communique` (`utilisateur`, `salle`) VALUES
(6, 53),
(6, 55),
(9, 53);

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

CREATE TABLE `messages` (
                            `id` int(11) NOT NULL,
                            `salon` int(11) NOT NULL,
                            `utilisateur` int(11) NOT NULL,
                            `message` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `messages`
--

INSERT INTO `messages` (`id`, `salon`, `utilisateur`, `message`) VALUES
(1, 4, 2, 'TESTONS CA'),
(2, 4, 9, 'ça marche'),
(3, 4, 9, '?'),
(4, 4, 9, 'je sais pas?'),
(5, 4, 9, 'TEST'),
(34, 5, 9, 'TEST'),
(35, 6, 16, 'Voici la liste des devoirs à faire cette semaine'),
(36, 6, 17, 'Du travail en plus ..'),
(38, 5, 9, 'Qui est chaud pour une game ?'),
(39, 5, 9, 'Personne?'),
(43, 53, 6, 'TEST'),
(44, 53, 9, 'Petite game?'),
(45, 53, 9, 'Merde mauvais chat dsl fred'),
(46, 53, 6, '... touours sérieux');

-- --------------------------------------------------------

--
-- Structure de la table `salle_chat`
--

CREATE TABLE `salle_chat` (
                              `id` int(11) NOT NULL,
                              `nom` varchar(50) NOT NULL,
                              `classe` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `salle_chat`
--

INSERT INTO `salle_chat` (`id`, `nom`, `classe`) VALUES
(4, 'général', 8),
(5, 'general', 3),
(6, 'général', 9),
(53, 'Caflers_Le-gall', 3),
(54, 'Caflers_Le-gall', 3),
(55, 'Caflers_Caflers', 3);

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
(2, 'Andrieu', 'Quentin', 'quentin.andrieu1@viacesi.fr', 1, 0, '$2y$10$PS7J0fz7DB/662q0DrjkFOIZs/EOmXA/Vf/ffoqY.MOUoq6vudDMe'),
(6, 'Caflers', 'Frédéric', 'fcaflers@cesi.fr', 0, 1, '$2y$10$bqrX5qZMYrP39IASAzqszu3iQBuUeXjBTJyNpsdwZUvhX7LoOfKfu'),
(7, 'Vandamme', 'Kévin', 'kevin.vandamme@viacesi.fr', 0, 0, '$2y$10$SCHOJCVYDmtMhBZj46DdQuXY7i.MNygqaQgSw4P0kBx94BXYJVOWG'),
(8, 'Lejosne', 'Thomas', 'thomas.lejosne@viacesi.fr', 0, 0, '$2y$10$8G4LADJb.GuK7MfRUycvy.jTCytLvwid5R9.V2qqfGW4ul0TTT2N.'),
(9, 'Le gall', 'Martin', 'martin.legall@viacesi.fr', 0, 0, '$2y$10$3j1w6LdAZfsdty1A37oVQ.PEMsPeowhyQglYRrn.YV/ozBpuKUcoO'),
(10, 'Lancry', 'Arno', 'arno.lancry@viacesi.fr', 0, 0, '$2y$10$5mJpUxYiygFAh1pOCrrbwOjto9Il4QSusOeMfURsWXtP6ws2smRh2'),
(13, 'Crépin', 'Benoit', 'benoit.crepin@viacesi.fr', 0, 0, '$2y$10$PZ3hOqVh5i8zhP/C8q1jbe3Tvfjy6Uqap6KPvV283ohnB1cp/e00K'),
(14, 'Lecolier', 'Louis', 'louis.lecolier@viacesi.fr', 0, 0, '$2y$10$TbO5tx9xy22KdwbRpWn1ZuBClloblyB4RV39MdT7WLAQlb.kY3JIS'),
(16, 'TEST', 'Prof', 'lol@mail.fr', 0, 1, '$2y$10$1fb/nt3vSKrtN3mmzyneWOKvAgDGBnBmScyutwiK46IMlNQMv6o6e'),
(17, 'TEST', 'eleve', 'test@mail.fr', 0, 0, '$2y$10$8izJgR2fDshB727wSFNTMuyV7ViLO6wPyOJpE7F63nuUY1s65egwi');

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
-- Index pour la table `messages`
--
ALTER TABLE `messages`
    ADD PRIMARY KEY (`id`),
    ADD KEY `salon_fk` (`salon`),
    ADD KEY `utilisateur_fk` (`utilisateur`);

--
-- Index pour la table `salle_chat`
--
ALTER TABLE `salle_chat`
    ADD PRIMARY KEY (`id`),
    ADD KEY `classe_fk` (`classe`);

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
    MODIFY `utilisateur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT pour la table `classe`
--
ALTER TABLE `classe`
    MODIFY `id_classe` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `communique`
--
ALTER TABLE `communique`
    MODIFY `utilisateur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT pour la table `messages`
--
ALTER TABLE `messages`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT pour la table `salle_chat`
--
ALTER TABLE `salle_chat`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `appartient`
--
ALTER TABLE `appartient`
    ADD CONSTRAINT `FK_Appartient_id_Classe` FOREIGN KEY (`classe`) REFERENCES `classe` (`id_classe`) ON DELETE CASCADE ON UPDATE CASCADE,
    ADD CONSTRAINT `FK_Appartient_id_utilisateur_Utilisateur` FOREIGN KEY (`utilisateur`) REFERENCES `utilisateur` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `communique`
--
ALTER TABLE `communique`
    ADD CONSTRAINT `FK_Communique_id_salle_salle_chat` FOREIGN KEY (`salle`) REFERENCES `salle_chat` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
    ADD CONSTRAINT `FK_Communique_id_utilisateur_Utilisateur` FOREIGN KEY (`utilisateur`) REFERENCES `utilisateur` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `messages`
--
ALTER TABLE `messages`
    ADD CONSTRAINT `salon_fk` FOREIGN KEY (`salon`) REFERENCES `salle_chat` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
    ADD CONSTRAINT `utilisateur_fk` FOREIGN KEY (`utilisateur`) REFERENCES `utilisateur` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `salle_chat`
--
ALTER TABLE `salle_chat`
    ADD CONSTRAINT `classe_fk` FOREIGN KEY (`classe`) REFERENCES `classe` (`id_classe`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
