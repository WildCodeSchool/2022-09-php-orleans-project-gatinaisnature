-- phpMyAdmin SQL Dump

-- version 4.5.4.1deb2ubuntu2

-- http://www.phpmyadmin.net

--

-- Client :  localhost

-- Généré le :  Jeu 26 Octobre 2017 à 13:53

-- Version du serveur :  5.7.19-0ubuntu0.16.04.1

-- Version de PHP :  7.0.22-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";

SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */

;

/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */

;

/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */

;

/*!40101 SET NAMES utf8mb4 */

;

--

-- Base de données :  `simple-mvc`

--

-- --------------------------------------------------------

--

-- Structure de la table `item`

--

CREATE TABLE
    `item` (
        `id` int(11) UNSIGNED NOT NULL,
        `title` varchar(255) NOT NULL
    ) ENGINE = InnoDB DEFAULT CHARSET = latin1;

--

-- Contenu de la table `item`

--

INSERT INTO
    `item` (`id`, `title`)
VALUES (1, 'Stuff'), (2, 'Doodads');

--

-- Index pour les tables exportées

--

--

-- Index pour la table `item`

--

ALTER TABLE `item` ADD PRIMARY KEY (`id`);

--

-- AUTO_INCREMENT pour les tables exportées

--

--

-- AUTO_INCREMENT pour la table `item`

--

ALTER TABLE
    `item` MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 3;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */

;

/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */

;

/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */

;

--

-- Structure de la table `event`

--

--

--

-- Structure de la table `activity`

--

CREATE TABLE
    `activity` (
        `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
        `title` varchar(255) NOT NULL,
        `description` TEXT NOT NULL,
        `picture_link` TEXT
    ) ENGINE = InnoDB DEFAULT CHARSET = latin1;

CREATE TABLE
    `event` (
        `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
        `title` varchar(255) NOT NULL,
        `date` DATE NOT NULL,
        `description` TEXT NOT NULL,
        `cost` DECIMAL(5, 2),
        `picture_link` TEXT
    ) ENGINE = InnoDB DEFAULT CHARSET = latin1;

--

-- Contenu de la table `activity`

-- Contenu de la table `event`

--

INSERT INTO
    `activity` (
        `title`,
        `description`,
        `picture_link`
    )
VALUES (
        'Protection de la chouette',
        'ta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia',
        null
    ), (
        'Comptage des nids de rapaces',
        'ta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia',
        null
    );

--

-- Index pour les tables exportées

--

--

-- Index pour la table `item`

INSERT INTO
    `event` (
        `title`,
        `date`,
        `description`,
        `cost`,
        `picture_link`
    )
VALUES (
        'Reparation des nids de chouette',
        '2022-12-22',
        'ta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia',
        '15',
        null
    ), (
        'Repas de Noel avec l\'association',
        '2023-12-23',
        'ta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia',
        '20',
        null
    ), (
        'Visite de la foret de Longchamps',
        '2023-01-02',
        'visite en foret',
        '12',
        null
    ), (
        'Visite des forets alentours',
        '2023-02-28',
        'ta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia',
        '8.50',
        null
    );

--
