-- Adminer 4.8.1 MySQL 10.11.3-MariaDB-1:10.11.3+maria~ubu2004 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `message`;
CREATE TABLE `message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sender_id` int(11) DEFAULT NULL,
  `receiver_id` int(11) DEFAULT NULL,
  `text` text NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `sender_id` (`sender_id`),
  KEY `receiver_id` (`receiver_id`),
  CONSTRAINT `message_ibfk_1` FOREIGN KEY (`sender_id`) REFERENCES `user` (`id`),
  CONSTRAINT `message_ibfk_2` FOREIGN KEY (`receiver_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `password` varchar(255) NOT NULL,
  `firstname` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `picture` varchar(255) DEFAULT 'default.jpg',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `email` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `user` (`id`, `password`, `firstname`, `lastname`, `picture`, `created_at`, `email`) VALUES
(1,	'$2y$10$5qqAej1Loe/YjQUhc9G0Be6SzGeAPyoZW.Xl2ezyNpnhCZgKdqVNW',	'Nicolas',	'Guillotte',	'nicolas.jpeg',	'2023-12-30 18:07:55',	'nicolas@nexora.fr'),
(2,	'$2y$10$g6KJaiXiKmrTgDTbKL/lselsrTP9Z2.aY.W3yxP.nEDyTAs3Bbkwu',	'Idris',	'Ziane',	'idris.jpeg',	'2023-12-30 18:00:44',	'idris@nexora.fr'),
(3,	'$2y$10$2ktMQBpm/71UAxzZCwHCGemgCJDs6Xi0XPnuonbvJrs6tPk39KWCe',	'Geoffroy',	'Pradier',	'geoffroy.jpeg',	'2023-12-30 18:07:03',	'geoffroy@nexora.fr');

-- 2024-01-02 14:31:51