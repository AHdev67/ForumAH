-- --------------------------------------------------------
-- Hôte:                         127.0.0.1
-- Version du serveur:           8.0.30 - MySQL Community Server - GPL
-- SE du serveur:                Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Listage de la structure de la base pour antoine_forum
CREATE DATABASE IF NOT EXISTS `antoine_forum` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `antoine_forum`;

-- Listage de la structure de table antoine_forum. category
CREATE TABLE IF NOT EXISTS `category` (
  `id_category` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id_category`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table antoine_forum.category : ~4 rows (environ)
INSERT INTO `category` (`id_category`, `name`) VALUES
	(1, 'Rate my setup'),
	(2, 'Help wanted'),
	(3, 'Troubleshooting'),
	(4, 'Misc');

-- Listage de la structure de table antoine_forum. post
CREATE TABLE IF NOT EXISTS `post` (
  `id_post` int NOT NULL AUTO_INCREMENT,
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `creationDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int DEFAULT NULL,
  `topic_id` int DEFAULT NULL,
  PRIMARY KEY (`id_post`) USING BTREE,
  KEY `user` (`user_id`) USING BTREE,
  KEY `topic` (`topic_id`) USING BTREE,
  CONSTRAINT `post_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`) ON DELETE SET NULL,
  CONSTRAINT `post_ibfk_2` FOREIGN KEY (`topic_id`) REFERENCES `topic` (`id_topic`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table antoine_forum.post : ~4 rows (environ)
INSERT INTO `post` (`id_post`, `content`, `creationDate`, `user_id`, `topic_id`) VALUES
	(4, 'You will perish.', '2024-03-26 14:43:39', NULL, NULL),
	(5, 'Anyone got spare change ?', '2024-03-26 15:05:30', NULL, NULL),
	(6, 'Binbong', '2024-03-26 16:42:24', NULL, NULL),
	(7, 'Dingdong', '2024-03-26 16:42:33', NULL, NULL),
	(12, 'Have u tried unplugging the power and replugging it ?', '2024-04-05 09:25:25', 4, 8),
	(13, 'On another subject, can you go to jail for defaulting on a debt ?', '2024-04-05 10:00:36', 4, 11);

-- Listage de la structure de table antoine_forum. topic
CREATE TABLE IF NOT EXISTS `topic` (
  `id_topic` int NOT NULL AUTO_INCREMENT,
  `title` varchar(150) NOT NULL,
  `content` text NOT NULL,
  `creationDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `category_id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `closed` binary(50) NOT NULL,
  PRIMARY KEY (`id_topic`) USING BTREE,
  KEY `category` (`category_id`) USING BTREE,
  KEY `user` (`user_id`) USING BTREE,
  CONSTRAINT `topic_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`) ON DELETE SET NULL,
  CONSTRAINT `topic_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id_category`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table antoine_forum.topic : ~0 rows (environ)
INSERT INTO `topic` (`id_topic`, `title`, `content`, `creationDate`, `category_id`, `user_id`, `closed`) VALUES
	(8, 'My thing don&#039;t work too good', 'It don&#039;t turn on :(', '2024-04-03 11:33:37', 3, 3, _binary 0x3000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000),
	(11, 'New computer :)', 'New build, high end part, \r\nno more money, downpayment on my mortgage can wait.', '2024-04-05 09:59:34', 1, 4, _binary 0x3000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000);

-- Listage de la structure de table antoine_forum. user
CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `registerDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `role` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`id_user`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table antoine_forum.user : ~3 rows (environ)
INSERT INTO `user` (`id_user`, `username`, `email`, `password`, `registerDate`, `role`) VALUES
	(3, 'Bingus', 'bingus.contact@gmail.com', '$2y$10$Jk1fhvMD0/UKCFifc0vIpeEImw34edVui.9VyYSiOgftDZOmZzlg2', '2024-04-03 09:05:46', 'role_admin'),
	(4, 'John PHP', 'john.php@wanadoo.fr', '$2y$10$mTBO1ggrK9gKzg2MSZEu5O2FXtGFG/Jtu6VXBIfrblAY2MmRecTcq', '2024-04-03 14:14:22', 'role_user'),
	(6, 'bingus2', 'bingus.alt@gmail.com', '$2y$10$UIvguo5ZfTqtv791YvJA8ukkVXFgQjbWW0dEDT35f0I9AWjNPhTwK', '2024-04-05 14:06:33', 'role_user');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
