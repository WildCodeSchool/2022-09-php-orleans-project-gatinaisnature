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
        `picture_link` TEXT
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
        `map` VARCHAR(100),
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
        `map`,
        `picture`
    )
VALUES (
        'Le Loing et le canal de Briare à Montcresson',
        5.5,
        'Tracé Jaune',
        'Le départ du circuit se situe à l\’église de Montcresson, se garer sur le parking derrière l\’église. Les sols rencontrés sont principalement des alluvions (anciennes ou récentes) et de l\’argile à silex vers la ferme de Toisy.Le circuit de base, 5,5 kms, tracé en jaune sur la carte, part de l\’église en direction du canal de Briare, emprunte la D117 pour traverser le canal et tourne à gauche avant le pont sur le Loing. Suivre ce chemin jusqu\’à Montambert. On longe un étang puis une zone inondable plantée de peupliers, avec la possibilité de surprendre, toute l\’année, un grèbe castagneux, une gallinule poule d\’eau, un héron cendré ou même un chevreuil. On trouve également toutes les plantes courantes vivant en milieu humide: reine des prés, salicaire commune, epilobe hirsute, grand consoude, etc… qui fleurissent en juin-juillet.',
        'Carte IGN 1/25.000 ème Est, Montargis',
        'loing_canal.webp'
    ), (
        'Canal de Briare',
        7,
        'Tracé Orange',
        'Le circuit complémentaire, 7 km, tracé en orange, longe le canal de Briare vers le sud et contourne le Château de la Forest, il permettra d\’observer des paysages typiques plateau du Gâtinais ainsi que la flore et la faune des zones mélangées de cultures et de bois, dans le parc du Château, de nombreux trous de pics sont visibles dans les vieux arbres.',
        'Carte IGN 1/25.000 ème Est, Montargis',
        'canal_briare.webp'
    ), (
        'La vallée de la Cléry à Saint-Hilaire-les-Andrésis et Chantecoq',
        6.5,
        'Tracé Jaune',
        'Le départ du circuit se situe à l\’église de Montcresson, se garer sur le parking derrière l\’église. Les sols rencontrés sont principalement des alluvions (anciennes ou récentes) et de l\’argile à silex vers la ferme de Toisy.Le circuit de base, 5,5 kms, tracé en jaune sur la carte, part de l\’église en direction du canal de Briare, emprunte la D117 pour traverser le canal et tourne à gauche avant le pont sur le Loing. Suivre ce chemin jusqu\’à Montambert. On longe un étang puis une zone inondable plantée de peupliers, avec la possibilité de surprendre, toute l\’année, un grèbe castagneux, une gallinule poule d\’eau, un héron cendré ou même un chevreuil. On trouve également toutes les plantes courantes vivant en milieu humide: reine des prés, salicaire commune, epilobe hirsute, grand consoude, etc… qui fleurissent en juin-juillet.',
        'Carte IGN 1/25.000 ème 2519 Ouest Château-Renard',
        'laclery_andresis.webp'
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

--

/* TABLE OF RACES */

CREATE TABLE
    `organism` (
        `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
        `name` VARCHAR(255) NOT NULL,
        `link` TEXT NOT NULL,
        `picture` VARCHAR(255) NOT NULL
    ) ENGINE = InnoDB DEFAULT CHARSET = latin1;
    
--

--

CREATE TABLE
`birdsHurt`(
`id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
`title` VARCHAR(255) NOT NULL,
`description` TEXT NOT NULL,
`picture_link` VARCHAR(255)
) ENGINE = InnoDB DEFAULT CHARSET = latin1;


INSERT INTO
`birdsHurt` (
`title`,
`description`,
`picture_link`
)
VALUES (
'Quelques conseils',
' Vous trouvez un animal sauvage en détresse, manipulez le avec des gants ou en l’enveloppant dans un vêtement épais. Méfiez- vous des serres des rapaces, du bec des échassiers, des dents et des griffes des mammifères ainsi que des pattes et des bois des cervidés. - Placez le dans un carton avec du papier absorbant au fond, laissez le au calme. - Ne placez pas un oiseau sauvage dans une cage ou un clapier où il aggravera ses blessures et abîmera son plumage. - Prévenez rapidement le Centre de sauvegarde le plus proche afin que l’animal soit soigné le plus vite possible. A-delà de deux jours sans soins, les chances de relâcher un oiseau victime d’une fracture sont quasiment nulles. - Ne lui donnez rien à manger ni à boire sans nous avoir téléphoné préalablement pour nous demander conseil. - Ne tentez pas de donner vous même des soins qui pourraient laisser des séquelles. - Les soins à la faune sauvage requièrent des connaissances et des installations particulières. - Quelques gestes simples lui permettent de survivre ou de ne pas aggraver ses blessures. - Si son aile est pendante, n’utilisez pas de sparadrap, immobilisez-la le long du corps avec du scotch, qui n’adhère pas aux plumes. Nettoyez la plaie avec du Mercryl uniquement. - Ne le gavez jamais et ne le forcez pas à boire. Laisser à disposition des rapaces ou des mammifères carnivores, quelques dés de viande rouge crue. Jeunes animaux : - N’essayez pas de les élever vous-même : vous les priveriez de toute chance de retrouver un jour une vie sauvage et autonome. - Ne perdez pas de temps : transportez les rapidement au centre le plus proche afins qu’ils ne souffrent pas ultérieurement de carences invalidantes. - Les faons de chevreuil et les jeunes rapaces nocturnes ne sont presque jamais abandonnés. Pour les premiers, éloignez- vous rapidement et tentez de percher les seconds hors de portée des prédateurs ou de leur nid s’il est accessible. Sources : Site Internet www.uncs.org',
'blesse.jpg'
);