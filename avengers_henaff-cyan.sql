-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mer. 21 fév. 2024 à 03:37
-- Version du serveur : 5.7.40
-- Version de PHP : 8.1.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `avengers_henaff-cyan`
--

-- --------------------------------------------------------

--
-- Structure de la table `auteur`
--

DROP TABLE IF EXISTS `auteur`;
CREATE TABLE IF NOT EXISTS `auteur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `auteur`
--

INSERT INTO `auteur` (`id`, `nom`, `prenom`) VALUES
(1, 'de Fombelle', 'Timothée'),
(2, 'Schwab', 'V.E.'),
(3, 'Schwab', 'V.E.');

-- --------------------------------------------------------

--
-- Structure de la table `cailloux`
--

DROP TABLE IF EXISTS `cailloux`;
CREATE TABLE IF NOT EXISTS `cailloux` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `categories_id` int(11) DEFAULT NULL,
  `img` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_5B534BA5A21214B7` (`categories_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `cailloux`
--

INSERT INTO `cailloux` (`id`, `categories_id`, `img`, `nom`, `description`) VALUES
(1, 1, 'media/tricot-raye.jpg', 'Tricot rayé', 'Le tricot rayé est une espèce de serpent non venimeux, reconnaissable par son motif distinctif de bandes de couleurs alternées sur son corps. On le trouve principalement en Amérique du Nord et il se distingue par son comportement docile et son apparence élégante.'),
(2, 1, 'media/cagou.jpg', 'Cagou', 'La cagou est un oiseau endémique de la Nouvelle-Calédonie, reconnaissable par son plumage noir, son bec incurvé et sa crête distinctive. Cet oiseau terrestre, souvent timide, est emblématique de la biodiversité de la région.\r\n'),
(3, 2, 'media/drosera.jpg', 'Drosera', 'Le drosera est une plante carnivore caractérisée par de petites feuilles couvertes de tentacules glandulaires qui sécrètent une substance collante pour capturer les insectes. Originaire de milieux humides, cette plante est souvent appelée \"rossolis\" et est connue pour son adaptation unique pour obtenir des nutriments supplémentaires à partir d\'insectes.'),
(4, 2, 'media/bois-bouchon.jpg', 'Bois bouchon', 'Le bois bouchon est une plante endémique de Nouvelle-Calédonie, reconnaissable par son tronc renflé à la base et son écorce liégeuse. Il est adapté aux milieux arides et a la particularité de stocker l\'eau dans son tronc pour faire face aux périodes de sécheresse.\r\n');

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id`, `nom`) VALUES
(1, 'Faune'),
(2, 'Flore');

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
CREATE TABLE IF NOT EXISTS `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20240214060513', '2024-02-14 06:05:44', 64),
('DoctrineMigrations\\Version20240218214741', '2024-02-18 21:48:09', 100),
('DoctrineMigrations\\Version20240218220153', '2024-02-18 22:02:00', 122),
('DoctrineMigrations\\Version20240218222543', '2024-02-18 22:26:11', 309),
('DoctrineMigrations\\Version20240220092533', '2024-02-20 09:26:20', 261),
('DoctrineMigrations\\Version20240220092915', '2024-02-20 09:29:43', 224),
('DoctrineMigrations\\Version20240220110403', '2024-02-20 11:04:42', 164);

-- --------------------------------------------------------

--
-- Structure de la table `livre`
--

DROP TABLE IF EXISTS `livre`;
CREATE TABLE IF NOT EXISTS `livre` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `annee` int(11) NOT NULL,
  `nb_pages` int(11) NOT NULL,
  `auteur_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_AC634F9960BB6FE6` (`auteur_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `livre`
--

INSERT INTO `livre` (`id`, `titre`, `annee`, `nb_pages`, `auteur_id`) VALUES
(1, 'Le Livre de Perle', 2014, 304, 1),
(2, 'Vicious', 2019, 532, 2),
(3, 'Vicious', 2019, 532, 3);

-- --------------------------------------------------------

--
-- Structure de la table `marque_page`
--

DROP TABLE IF EXISTS `marque_page`;
CREATE TABLE IF NOT EXISTS `marque_page` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_creation` date NOT NULL,
  `commentaire` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `marque_page`
--

INSERT INTO `marque_page` (`id`, `url`, `date_creation`, `commentaire`) VALUES
(1, 'aaa', '2024-02-01', 'ceci est l\'url aaa'),
(2, 'bbb', '2024-02-02', 'ceci est l\'url b'),
(3, 'https://www.symfony.com/', '2024-02-14', 'C\'est un framework PHP très puissant et très pratique'),
(4, 'https://www.symfony.com/', '2024-02-14', 'C\'est un framework PHP très puissant et très pratique'),
(5, 'https://www.symfony.com/', '2024-02-14', 'C\'est un framework PHP très puissant et très pratique'),
(7, 'https://www.symfony.com/', '2024-02-18', 'C\'est un framework PHP très puissant et très pratique'),
(8, 'https://www.symfony.com/', '2024-02-18', 'C\'est un framework PHP très puissant et très pratique'),
(9, 'https://www.symfony.com/', '2024-02-18', 'C\'est un framework PHP très puissant et très pratique'),
(10, 'https://www.symfony.com/', '2024-02-18', 'C\'est un framework PHP très puissant et très pratique'),
(11, 'https://www.symfony.com/', '2024-02-18', 'C\'est un framework PHP très puissant et très pratique'),
(12, 'https://www.symfony.com/', '2024-02-19', 'C\'est un framework PHP très puissant et très pratique'),
(13, 'https://www.symfony.com/', '2024-02-19', 'C\'est un framework PHP très puissant et très pratique'),
(14, 'https://www.symfony.com/', '2024-02-19', 'C\'est un framework PHP très puissant et très pratique'),
(15, 'https://www.symfony.com/', '2024-02-19', 'C\'est un framework PHP très puissant et très pratique'),
(16, 'https://www.symfony.com/', '2024-02-19', 'C\'est un framework PHP très puissant et très pratique'),
(17, 'https://www.symfony.com/', '2024-02-20', 'C\'est un framework PHP très puissant et très pratique');

-- --------------------------------------------------------

--
-- Structure de la table `messenger_messages`
--

DROP TABLE IF EXISTS `messenger_messages`;
CREATE TABLE IF NOT EXISTS `messenger_messages` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `headers` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue_name` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `available_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `delivered_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`),
  KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  KEY `IDX_75EA56E016BA31DB` (`delivered_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `mots_cles`
--

DROP TABLE IF EXISTS `mots_cles`;
CREATE TABLE IF NOT EXISTS `mots_cles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mots_cles` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `mots_cles`
--

INSERT INTO `mots_cles` (`id`, `mots_cles`) VALUES
(1, 'Code'),
(2, 'framework'),
(3, 'php'),
(4, 'framework'),
(5, 'framework'),
(6, 'framework'),
(7, 'framework'),
(8, 'framework'),
(9, 'framework'),
(10, 'php'),
(11, 'framework'),
(12, 'php');

-- --------------------------------------------------------

--
-- Structure de la table `mots_cles_marque_page`
--

DROP TABLE IF EXISTS `mots_cles_marque_page`;
CREATE TABLE IF NOT EXISTS `mots_cles_marque_page` (
  `mots_cles_id` int(11) NOT NULL,
  `marque_page_id` int(11) NOT NULL,
  PRIMARY KEY (`mots_cles_id`,`marque_page_id`),
  KEY `IDX_C3F9F601C0BE80DB` (`mots_cles_id`),
  KEY `IDX_C3F9F601D59CC0F1` (`marque_page_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `mots_cles_marque_page`
--

INSERT INTO `mots_cles_marque_page` (`mots_cles_id`, `marque_page_id`) VALUES
(2, 9),
(3, 10),
(4, 11),
(5, 12),
(6, 13),
(7, 14),
(8, 15),
(9, 16),
(10, 16),
(11, 17),
(12, 17);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

DROP TABLE IF EXISTS `utilisateurs`;
CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `login`, `password`) VALUES
(1, 'cyanhenaff', 'eloisepierre');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `cailloux`
--
ALTER TABLE `cailloux`
  ADD CONSTRAINT `FK_5B534BA5A21214B7` FOREIGN KEY (`categories_id`) REFERENCES `categories` (`id`);

--
-- Contraintes pour la table `livre`
--
ALTER TABLE `livre`
  ADD CONSTRAINT `FK_AC634F9960BB6FE6` FOREIGN KEY (`auteur_id`) REFERENCES `auteur` (`id`);

--
-- Contraintes pour la table `mots_cles_marque_page`
--
ALTER TABLE `mots_cles_marque_page`
  ADD CONSTRAINT `FK_C3F9F601C0BE80DB` FOREIGN KEY (`mots_cles_id`) REFERENCES `mots_cles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_C3F9F601D59CC0F1` FOREIGN KEY (`marque_page_id`) REFERENCES `marque_page` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
