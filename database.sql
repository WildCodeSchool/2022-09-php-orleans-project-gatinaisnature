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

-- Structure de la table `activity`

--

CREATE TABLE
    `activity` (
        `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
        `title` varchar(255) NOT NULL,
        `description` TEXT NOT NULL,
        `picture` TEXT
    ) ENGINE = InnoDB DEFAULT CHARSET = latin1;

--

-- Structure de la table `event`

--
CREATE TABLE
    `event` (
        `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
        `title` varchar(255) NOT NULL,
        `date` DATE NOT NULL,
        `description` TEXT NOT NULL,
        `cost` DECIMAL(5, 2),
        `picture` TEXT
    ) ENGINE = InnoDB DEFAULT CHARSET = latin1;

--

-- Contenu de la table `activity`

--

INSERT INTO
    `activity` (
        `title`,
        `description`,
        `picture`
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

-- Contenu pour la table `event`

--

INSERT INTO
    `event` (
        `title`,
        `date`,
        `description`,
        `cost`,
        `picture`
    )
VALUES (
        'Réparation des nids de chouette',
        '2022-12-22',
        'ta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia',
        '15',
        null
    ), (
        'Repas de Noël avec l\'association',
        '2023-12-23',
        'ta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia',
        '20',
        null
    ), (
        'Visite de la forêt de Longchamps',
        '2023-01-02',
        'visite en foret',
        '12',
        null
    ), (
        'Visite des forêts alentours',
        '2023-02-28',
        'ta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia',
        '8.50',
        null
    );

CREATE TABLE
    `landscape`(
        `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
        `title` varchar(255) NOT NULL,
        `description` TEXT NOT NULL,
        `picture_link` TEXT
    ) ENGINE = InnoDB DEFAULT CHARSET = latin1;

--

--

/* TABLE OF CIRCUITS */

CREATE TABLE
    `circuit` (
        `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
        `title` VARCHAR(255) NOT NULL,
        `size` DECIMAL(4, 1) NOT NULL,
        `content` TEXT,
        `trace` VARCHAR(20),
        `picture` VARCHAR(255)
    ) ENGINE = InnoDB DEFAULT CHARSET = latin1;

/* INSERT CIRCUITS */

INSERT INTO
    `circuit` (
        `title`,
        `size`,
        `trace`,
        `content`,
        `picture`
    )
VALUES (
        'Le Loing et le canal de Briare à Montcresson',
        5.5,
        'Tracé Jaune',
        'Le départ du circuit se situe à l\’église de Montcresson : se garer sur le parking derrière l\’église. Les sols rencontrés sont principalement des alluvions (anciennes ou récentes) et de l\’argile à silex vers la ferme de Toisy. Le circuit de base (5.5 km), tracé en jaune sur la carte, part de l\’église en direction du canal de Briare, emprunte la D117 pour traverser le canal et tourne à gauche avant le pont sur le Loing. Suivre ce chemin jusqu\’à Montambert. On longe un étang puis une zone inondable plantée de peupliers, avec la possibilité de surprendre, toute l\’année, un grèbe castagneux, une gallinule poule d\’eau, un héron cendré ou même un chevreuil. On trouve également toutes les plantes courantes vivant en milieu humide : reine des prés, salicaire commune, épilobe hirsute, grand consoude, etc… qui fleurissent en juin-juillet.',
        null
    ), (
        'Canal de Briare',
        7,
        'Tracé Orange',
        'Le circuit complémentaire (7 km), tracé en orange, longe le canal de Briare vers le sud et contourne le Château de la Forest. Il permettra d\’observer des paysages typiques du plateau du Gâtinais ainsi que la flore et la faune des zones mélangées de cultures et de bois. Dans le parc du Château, de nombreux trous de pics sont visibles dans les vieux arbres.',
        null
    ), (
        'La vallée de la Cléry à Saint-Hilaire-les-Andrésis et Chantecoq',
        6.5,
        'Tracé Jaune',
        'Le départ du circuit se situe à l\’église de Montcresson : se garer sur le parking derrière l\’église. Les sols rencontrés sont principalement des alluvions (anciennes ou récentes) et de l\’argile à silex vers la ferme de Toisy. Le circuit de base (5.5 km), tracé en jaune sur la carte, part de l\’église en direction du canal de Briare, emprunte la D117 pour traverser le canal et tourne à gauche avant le pont sur le Loing. Suivre ce chemin jusqu\’à Montambert. On longe un étang puis une zone inondable plantée de peupliers, avec la possibilité de surprendre, toute l\’année, un grèbe castagneux, une gallinule poule d\’eau, un héron cendré ou même un chevreuil. On trouve également toutes les plantes courantes vivant en milieu humide : reine des prés, salicaire commune, épilobe hirsute, grand consoude, etc… qui fleurissent en juin-juillet.',
        null
    );

--

--

/* TABLE OF USERS */

CREATE TABLE 
    `user` (
        `id` INT(11) UNSIGNED PRIMARY KEY NOT NULL AUTO_INCREMENT,
        `email` VARCHAR(255) NOT NULL UNIQUE,
        `password` VARCHAR(100) NOT NULL
    ) ENGINE = InnoDB DEFAULT CHARSET = latin1;

--

INSERT INTO
    `user` (
        `email`,
        `password`
    )
VALUES (
    'admin@gatinais.com',
    '$2y$10$e9IPqPJAEqXocHcpBF21sOi4WbuyiHrK0aR6Ht8r2B09u95W/XMAm'
);

/* TABLE OF ORGANISMS */

CREATE TABLE
    `organism` (
        `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
        `name` VARCHAR(255) NOT NULL,
        `link` TEXT NOT NULL,
        `picture` VARCHAR(255) NOT NULL
    ) ENGINE = InnoDB DEFAULT CHARSET = latin1;
    
   
/* TABLES FOR JOINTS */

CREATE TABLE
    `circuit_organism` (
        `id` INT NOT NULL AUTO_INCREMENT,
        `circuit_id` INT(11) UNSIGNED NOT NULL,
        `organism_id` INT(11) UNSIGNED NOT NULL,
        PRIMARY KEY (`id`),
        CONSTRAINT `fk_circuit_organism` 
        FOREIGN KEY (`circuit_id`) REFERENCES `circuit`(id) ON DELETE CASCADE,
        CONSTRAINT `fk_organism` FOREIGN KEY (`organism_id`) REFERENCES `organism`(id) ON DELETE CASCADE
    ) ENGINE = InnoDB DEFAULT CHARSET = latin1;


CREATE TABLE
    `circuit_landscape` (
        `id` INT NOT NULL AUTO_INCREMENT,
        `circuit_id` INT(11) UNSIGNED NOT NULL,
        `landscape_id` INT(11) UNSIGNED NOT NULL,
        PRIMARY KEY (`id`),
        CONSTRAINT `fk_circuit_landscape` FOREIGN KEY (`circuit_id`) REFERENCES `circuit`(id) ON DELETE CASCADE,
        CONSTRAINT `fk_landscape` FOREIGN KEY (`landscape_id`) REFERENCES `landscape`(id) ON DELETE CASCADE
    ) ENGINE = InnoDB DEFAULT CHARSET = latin1;
    