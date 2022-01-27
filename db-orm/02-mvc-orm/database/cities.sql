-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Počítač: 127.0.0.1:3306
-- Vytvořeno: Stř 19. led 2022, 07:15
-- Verze serveru: 5.7.26
-- Verze PHP: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáze: `cities`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `city`
--

DROP TABLE IF EXISTS `city`;
CREATE TABLE IF NOT EXISTS `city` (
  `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `code` varchar(5) DEFAULT NULL,
  `population` mediumint(8) UNSIGNED NOT NULL DEFAULT '0',
  `region_id` tinyint(3) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_city_region_idx` (`region_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Vypisuji data pro tabulku `city`
--

INSERT INTO `city` (`id`, `name`, `code`, `population`, `region_id`) VALUES
(1, 'Varnsdorf', NULL, 16000, 2),
(2, 'Rumburk', NULL, 11000, 2),
(3, 'Šluknov', NULL, 1019, 2),
(5, 'Nový Bor', NULL, 11679, 5),
(6, 'Zákupy', NULL, 2800, 5),
(7, 'Jiříkov', NULL, 3795, 2),
(8, 'Rybniště', NULL, 645, 2),
(10, 'Dolní Podluží', NULL, 611, 2),
(11, 'Jiřetín pod Jedlovou', NULL, 56, 2),
(12, 'Krásná Lípa', '20', 3125, 2);

-- --------------------------------------------------------

--
-- Struktura tabulky `region`
--

DROP TABLE IF EXISTS `region`;
CREATE TABLE IF NOT EXISTS `region` (
  `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `parent` tinyint(3) UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_region_region1_idx` (`parent`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Vypisuji data pro tabulku `region`
--

INSERT INTO `region` (`id`, `name`, `parent`) VALUES
(1, 'Ústecký kraj', NULL),
(2, 'Děčínský okres', 1),
(3, 'Liberecký kraj', NULL),
(5, 'Českolipský okres', 3);

--
-- Omezení pro exportované tabulky
--

--
-- Omezení pro tabulku `city`
--
ALTER TABLE `city`
  ADD CONSTRAINT `fk_city_region` FOREIGN KEY (`region_id`) REFERENCES `region` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Omezení pro tabulku `region`
--
ALTER TABLE `region`
  ADD CONSTRAINT `fk_region_region1` FOREIGN KEY (`parent`) REFERENCES `region` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
