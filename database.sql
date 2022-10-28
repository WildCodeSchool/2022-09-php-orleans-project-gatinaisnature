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

/* TABLE OF CIRCUITS */

CREATE TABLE
    `circuit` (
        `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
        `title` VARCHAR(255) NOT NULL,
        `size` DECIMAL(4, 1) NOT NULL,
        `content` TEXT,
        `map` TEXT,
        `trace` VARCHAR(20)
    ) ENGINE = InnoDB DEFAULT CHARSET = latin1;

/* INSERT CIRCUITS */

INSERT INTO
    `circuit` (
        `title`,
        `size`,
        `trace`,
        `content`,
        `map`
    )
VALUES (
        'Le loing et le canal de Briare à Montcresson',
        5.5,
        'Tracé Jaune',
        'Le départ du circuit se situe à l\’église  de Montcresson, se garer sur le parking derrière l\’église. Les sols rencontrés sont principalement des alluvions (anciennes ou récentes) et de l\’argile à silx vers la ferme de Toisy.Le Circuit de base, 5,5 kms, tracé en jaune sur la carte, part de l\’église en direction du canal de Briare, emprunte la D117 pour traverser le canal et tourne à gauche avant le pont sur le Loing. Suivre ce chemin jusqu\’à Montambert. On longe un étang puis une zone inondable plantée de peupliers, avec la possibilité de surprendre, toute l\’année, un Grèbe castagneux, une Gallinule poule d\’eau, un Héron cendré ou même un Chevreuil. On trouve également toutes les plantes courantes vivant en milieu humide : Reine des prés, Salicaire commune, Epilobe hirsute, Grand consoude, etc … qui fleurissent en juin-juillet.',
        'Carte IGN 1/25.000 ème Est, Montargis'
    ), (
        'Canal de Briare',
        7,
        'Tracé Orange',
        'Le circuit complémentaire, 7 km, tracé en orange, longe le canal de Briare vers le sud et contourne le Château de la Forest, il permettra d’observer des paysages typiques du plateau Gâtinais ains que la flore et la faune des zones mélangées de cultures et de bois, dans le parc du Château, de nombreux trous de pics sont visibles dans les vieux arbres.',
        'Carte IGN 1/25.000 ème Est, Montargis'
    ), (
        'La vallée de la Cléryà Saint Hilaire les Andrésis et Chantecoq',
        6.5,
        'Tracé Jaune',
        'Le départ du circuit se situe sur la route D32 (Ferrières - Courtenay), entre Chantecoq et Saint-Hilaire-les-Andrésis, au lieu-dit les Roches (2 km à l\’Est de Chantecoq), un ancien virage de la D32 servira de parking.Le Circuit de base, de 6,5 km en jaune, se situe sur un sold\’alluvions récentes, départ vers l\’est, le long de la D32, rourner à droite au premier  chemin vers la Valetterie, puis descendre jusqu\’au Marteau et longer vers l\’amont le ruisseau (sans nom, c\’est un affluent de la Cléry) jusqu\’à la passerelle ; de la Valetterie, on domine la vallée, la présence de haies et de zones cultivées permet d\’observer et d\’entendre au printemps, quand ils sont les plus actifs, une bonne vingtaine d\’espèces d\’oiseaux communs, tôt le matin, des Chevreuils se nourrissent dans la vallée.',
        'Carte IGN 1/25.000 ème 2519 Ouest Château-Renard'
    );