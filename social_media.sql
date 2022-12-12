-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 12 déc. 2022 à 23:52
-- Version du serveur : 10.4.22-MariaDB
-- Version de PHP : 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `social_media`
--

-- --------------------------------------------------------

--
-- Structure de la table `certif`
--

CREATE TABLE `certif` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `type_certif` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `certif`
--

INSERT INTO `certif` (`id`, `id_user`, `type_certif`) VALUES
(1, 20, 'php'),
(2, 21, 'php'),
(3, 22, 'html'),
(4, 19, 'html');

-- --------------------------------------------------------

--
-- Structure de la table `chat`
--

CREATE TABLE `chat` (
  `id` int(11) NOT NULL,
  `id_envoi` int(11) NOT NULL,
  `id_recu` int(11) NOT NULL,
  `message` varchar(250) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `chat`
--

INSERT INTO `chat` (`id`, `id_envoi`, `id_recu`, `message`, `date`) VALUES
(1, 18, 17, 'heyy', '2012-12-22'),
(2, 18, 17, 'heyy', '2012-12-22');

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

CREATE TABLE `comments` (
  `id_comments` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `idpub` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `comments`
--

INSERT INTO `comments` (`id_comments`, `id_user`, `description`, `idpub`) VALUES
(1, 18, 'hiii', 1),
(2, 19, 'wiiiii', 2),
(3, 19, '!', 5);

-- --------------------------------------------------------

--
-- Structure de la table `friends`
--

CREATE TABLE `friends` (
  `id` int(11) NOT NULL,
  `id_user1` int(11) NOT NULL,
  `id_user2` int(11) NOT NULL,
  `statu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `friends`
--

INSERT INTO `friends` (`id`, `id_user1`, `id_user2`, `statu`) VALUES
(1, 17, 18, 1),
(2, 19, 17, 0),
(4, 22, 17, 0),
(5, 19, 18, 1),
(6, 19, 18, 0);

-- --------------------------------------------------------

--
-- Structure de la table `like_pub`
--

CREATE TABLE `like_pub` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_pub` int(11) NOT NULL,
  `liked` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `like_pub`
--

INSERT INTO `like_pub` (`id`, `id_user`, `id_pub`, `liked`) VALUES
(0, 18, 1, 1),
(0, 19, 2, 1),
(0, 19, 5, 1);

-- --------------------------------------------------------

--
-- Structure de la table `notification`
--

CREATE TABLE `notification` (
  `id` int(11) NOT NULL,
  `id_user_current` int(11) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `notification`
--

INSERT INTO `notification` (`id`, `id_user_current`, `description`) VALUES
(1, 18, 'hkimienvoyer un invitation'),
(2, 17, 'ghassena accepté votre invitation'),
(3, 17, 'ghassena accepté votre invitation'),
(4, 17, 'ghassenlike your pub'),
(5, 17, 'ghassencomment your pub'),
(6, 17, 'youssefenvoyer un invitation'),
(7, 20, 'Iheb envoyer un invitation'),
(8, 17, 'Lynaenvoyer un invitation'),
(9, 18, 'youssefenvoyer un invitation'),
(10, 18, 'youssefenvoyer un invitation');

-- --------------------------------------------------------

--
-- Structure de la table `pub`
--

CREATE TABLE `pub` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `description` varchar(255) NOT NULL,
  `avatar` varchar(255) NOT NULL,
  `theme` varchar(50) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `pub`
--

INSERT INTO `pub` (`id`, `date`, `description`, `avatar`, `theme`, `id_user`) VALUES
(1, '2022-12-12', 'hello', './pub_photo/1a6283961c221d5520f1ff6e99efc217.png', '', 17),
(2, '2022-12-12', 'viva tunisia <3', '', '#ff2d75', 19),
(3, '2022-12-12', 'merci talel\r\n', '', '#fff', 21),
(4, '2022-12-12', 'hiiii', '', '#ff2d75', 22),
(6, '2022-12-12', '*', '', '#ff2d75', 19);

-- --------------------------------------------------------

--
-- Structure de la table `save`
--

CREATE TABLE `save` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_pub` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `save`
--

INSERT INTO `save` (`id`, `id_user`, `id_pub`) VALUES
(1, 18, 1),
(3, 19, 5);

-- --------------------------------------------------------

--
-- Structure de la table `story`
--

CREATE TABLE `story` (
  `id` int(11) NOT NULL,
  `file` varchar(255) NOT NULL,
  `id_user` int(11) NOT NULL,
  `created_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `story`
--

INSERT INTO `story` (`id`, `file`, `id_user`, `created_at`) VALUES
(1, './storage_story/86c56cadca6970afa6b7a12240e7af27.png', 17, '2022-12-12'),
(2, './storage_story/d2fae9b12af7fd11dbb14d93a93148e6.png', 19, '2022-12-12'),
(3, './storage_story/5970643f20a951fe23faf7f8a5aa7911.png', 20, '2022-12-12');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `iduser` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `photo_user` varchar(250) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `verified` tinyint(1) NOT NULL,
  `password_token` int(11) DEFAULT NULL,
  `date_created` date NOT NULL,
  `corbeille` int(11) NOT NULL,
  `role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`iduser`, `name`, `last_name`, `email`, `password`, `photo_user`, `token`, `verified`, `password_token`, `date_created`, `corbeille`, `role`) VALUES
(10, 'Talel', 'Mejri', 'talelmejri8@gmail.com', '$2y$10$AYdPdabw9.3XPNUt.pMol.yTywUwo0CWee6APC2SeCIgOZJ0icB1y', '/storage/072622220107cbd75570be2851d5f1ad.jpg', 'f09240189e2ef9fd8eeab8ce4c51c98f6275', 0, NULL, '2022-12-12', 0, 1),
(17, 'hkimi', 'amin', 'hkimiamin02@gmail.com', '$2y$10$7lpuz8vICDNoJeMI/xexUe003/qDxunlTyHklnJvBMdFrTb2WFw0u', '/storage/0e53c01c33ea8c0110cb9185569b01fc.jpg', '889a959e017cbdba636731a5e0ea95906958', 1, NULL, '2022-12-12', 0, 0),
(18, 'ghassen', 'ahmed', 'ghassenahmed74@gmail.com', '$2y$10$CpxDPnrQ1PtDBzgVBwLz4.54nLFQ4XOYO2Gf4s3u.juPS1bO5pP4a', '/storage/9be1c46c07b11c5b1a7c24a39cd46ff7.png', 'e9f7c54344b6bf197745536590b18b1b885', 1, NULL, '2022-12-12', 0, 0),
(19, 'youssef', 'chlendi', 'youssef.chlendi@gmail.com', '$2y$10$yzie2G7LpRdnFXk.GIBJC.IK4fwJzFk8JZthGWhUszS6BVAsqulHi', '/storage/842a675a888cf0d8a611188fbfeac74e.png', 'b10c45a5c10400908d3e71f89ce623533611', 1, NULL, '2022-12-12', 0, 0),
(20, 'Ben Hassine', 'Mohamed Rayen', 'rayenmohamed2310@gmail.com', '$2y$10$/YwbL/pNUrRI.tmF3vTTOu7cNzFzEgzN7uJh3x72upn9R91.D7mP.', '/storage/73c5f990cfbc594ef2bdc2b93ea0fc68.png', '614dd0b840825e5092f988b440e235ba6011', 1, NULL, '2022-12-12', 0, 0),
(21, 'Iheb ', 'Sessi', 'iheb.ilsassi001@gmail.com', '$2y$10$3SL5JY/TQ28ItIB9909SE.d94N0UUNue.OsdfvG0EUf2LxHI.pgDe', '/storage/7be598dc679c17cdb679e3e88c73f17b.png', '8fd51d60f46cabf2fd8bc51d2c059caa3366', 1, NULL, '2022-12-12', 0, 0),
(22, 'Lyna', 'Moujahed', 'moujahedlyna@yahoo.com', '$2y$10$pzILdIink1NbeuJzGFNtZ.C7qD5CyCzkM.TvK5EBn304RZkoB9xH.', '/storage/43bdab8ac3576d370a4410fa1d4da7b2.png', '247c6daa8d98fca8c471e9572b5113ff3586', 1, NULL, '2022-12-12', 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `visibilite_users`
--

CREATE TABLE `visibilite_users` (
  `idUser` int(11) NOT NULL,
  `affichage` int(11) NOT NULL,
  `langue` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `visibilite_users`
--

INSERT INTO `visibilite_users` (`idUser`, `affichage`, `langue`) VALUES
(17, 0, 'en'),
(18, 0, 'en'),
(19, 1, 'en'),
(20, 1, 'en'),
(21, 0, 'en'),
(22, 0, 'en');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `certif`
--
ALTER TABLE `certif`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id_user`);

--
-- Index pour la table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `iduser` (`id_envoi`),
  ADD KEY `id_user2` (`id_recu`);

--
-- Index pour la table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id_comments`),
  ADD KEY `id_user_comment` (`id_user`),
  ADD KEY `id_pub_comment` (`idpub`);

--
-- Index pour la table `friends`
--
ALTER TABLE `friends`
  ADD PRIMARY KEY (`id`),
  ADD KEY `friends` (`id_user1`),
  ADD KEY `friends2` (`id_user2`);

--
-- Index pour la table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notif` (`id_user_current`);

--
-- Index pour la table `pub`
--
ALTER TABLE `pub`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `save`
--
ALTER TABLE `save`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_pub` (`id_pub`);

--
-- Index pour la table `story`
--
ALTER TABLE `story`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`iduser`);

--
-- Index pour la table `visibilite_users`
--
ALTER TABLE `visibilite_users`
  ADD PRIMARY KEY (`idUser`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `certif`
--
ALTER TABLE `certif`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `chat`
--
ALTER TABLE `chat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `comments`
--
ALTER TABLE `comments`
  MODIFY `id_comments` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `friends`
--
ALTER TABLE `friends`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `notification`
--
ALTER TABLE `notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `pub`
--
ALTER TABLE `pub`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `save`
--
ALTER TABLE `save`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `story`
--
ALTER TABLE `story`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `iduser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT pour la table `visibilite_users`
--
ALTER TABLE `visibilite_users`
  MODIFY `idUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `certif`
--
ALTER TABLE `certif`
  ADD CONSTRAINT `id` FOREIGN KEY (`id_user`) REFERENCES `users` (`iduser`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `chat`
--
ALTER TABLE `chat`
  ADD CONSTRAINT `id_user2` FOREIGN KEY (`id_recu`) REFERENCES `users` (`iduser`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `iduser` FOREIGN KEY (`id_envoi`) REFERENCES `users` (`iduser`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `friends`
--
ALTER TABLE `friends`
  ADD CONSTRAINT `friends` FOREIGN KEY (`id_user1`) REFERENCES `users` (`iduser`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `friends2` FOREIGN KEY (`id_user2`) REFERENCES `users` (`iduser`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `save`
--
ALTER TABLE `save`
  ADD CONSTRAINT `check_user` FOREIGN KEY (`id_user`) REFERENCES `users` (`iduser`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `story`
--
ALTER TABLE `story`
  ADD CONSTRAINT `id_user` FOREIGN KEY (`id_user`) REFERENCES `users` (`iduser`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `visibilite_users`
--
ALTER TABLE `visibilite_users`
  ADD CONSTRAINT `user_affichage` FOREIGN KEY (`idUser`) REFERENCES `users` (`iduser`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
