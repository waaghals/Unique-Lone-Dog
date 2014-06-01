-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Machine: 127.0.0.1
-- Gegenereerd op: 01 jun 2014 om 16:37
-- Serverversie: 5.6.16
-- PHP-versie: 5.5.9

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Databank: `uld`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `permission`
--

CREATE TABLE IF NOT EXISTS `permission` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `roleId` int(10) unsigned NOT NULL,
  `resource` varchar(16) NOT NULL,
  `action` varchar(16) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `profilesId` (`roleId`),
  KEY `roleId` (`roleId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=23 ;

--
-- Gegevens worden uitgevoerd voor tabel `permission`
--

INSERT INTO `permission` (`id`, `roleId`, `resource`, `action`) VALUES
(1, 3, 'users', 'index'),
(2, 3, 'users', 'search'),
(3, 3, 'profiles', 'index'),
(4, 3, 'profiles', 'search'),
(5, 1, 'users', 'index'),
(6, 1, 'users', 'search'),
(7, 1, 'users', 'edit'),
(8, 1, 'users', 'create'),
(9, 1, 'users', 'delete'),
(10, 1, 'users', 'changePassword'),
(11, 1, 'profiles', 'index'),
(12, 1, 'profiles', 'search'),
(13, 1, 'profiles', 'edit'),
(14, 1, 'profiles', 'create'),
(15, 1, 'profiles', 'delete'),
(16, 1, 'permissions', 'index'),
(17, 2, 'users', 'index'),
(18, 2, 'users', 'search'),
(19, 2, 'users', 'edit'),
(20, 2, 'users', 'create'),
(21, 2, 'profiles', 'index'),
(22, 2, 'profiles', 'search');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `remember_token`
--

CREATE TABLE IF NOT EXISTS `remember_token` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `userId` int(10) unsigned NOT NULL,
  `token` char(32) NOT NULL,
  `userAgent` varchar(120) NOT NULL,
  `createdAt` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `token` (`token`),
  KEY `userId` (`userId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `reputation`
--

CREATE TABLE IF NOT EXISTS `reputation` (
  `points` tinyint(4) NOT NULL,
  `userId` int(10) unsigned NOT NULL,
  `createdAt` datetime NOT NULL,
  KEY `userId` (`userId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden uitgevoerd voor tabel `reputation`
--

INSERT INTO `reputation` (`points`, `userId`, `createdAt`) VALUES
(100, 3, '2014-06-01 16:14:16'),
(100, 3, '2014-06-01 16:14:17'),
(100, 3, '2014-06-01 16:14:23'),
(100, 3, '2014-06-01 16:14:57'),
(100, 3, '2014-06-01 16:14:59'),
(100, 3, '2014-06-01 16:15:00'),
(100, 3, '2014-06-01 16:15:12'),
(100, 4, '2014-06-01 16:18:45'),
(100, 4, '2014-06-01 16:18:46'),
(100, 4, '2014-06-01 16:20:16'),
(100, 4, '2014-06-01 16:20:16'),
(127, 4, '2014-06-01 16:21:03'),
(127, 4, '2014-06-01 16:21:03'),
(127, 4, '2014-06-01 16:21:04'),
(127, 4, '2014-06-01 16:21:04'),
(127, 4, '2014-06-01 16:21:05'),
(127, 4, '2014-06-01 16:21:05'),
(127, 4, '2014-06-01 16:21:05'),
(127, 4, '2014-06-01 16:21:06'),
(127, 4, '2014-06-01 16:21:06'),
(127, 4, '2014-06-01 16:21:06'),
(127, 4, '2014-06-01 16:21:06'),
(127, 4, '2014-06-01 16:21:07'),
(127, 4, '2014-06-01 16:21:07'),
(127, 4, '2014-06-01 16:21:07'),
(127, 4, '2014-06-01 16:21:07'),
(127, 4, '2014-06-01 16:21:08'),
(127, 4, '2014-06-01 16:21:08'),
(127, 4, '2014-06-01 16:21:08'),
(127, 4, '2014-06-01 16:21:08'),
(127, 4, '2014-06-01 16:21:08'),
(127, 4, '2014-06-01 16:21:09'),
(127, 4, '2014-06-01 16:21:09'),
(127, 4, '2014-06-01 16:21:09'),
(127, 4, '2014-06-01 16:21:09'),
(127, 4, '2014-06-01 16:21:09'),
(127, 4, '2014-06-01 16:21:10'),
(127, 4, '2014-06-01 16:21:10'),
(127, 4, '2014-06-01 16:21:10'),
(127, 4, '2014-06-01 16:21:11'),
(127, 4, '2014-06-01 16:21:11'),
(127, 4, '2014-06-01 16:21:11'),
(127, 4, '2014-06-01 16:21:11'),
(127, 4, '2014-06-01 16:21:11'),
(127, 4, '2014-06-01 16:21:12'),
(127, 4, '2014-06-01 16:21:12'),
(127, 4, '2014-06-01 16:21:12'),
(127, 4, '2014-06-01 16:21:13'),
(127, 4, '2014-06-01 16:21:13'),
(127, 4, '2014-06-01 16:21:13'),
(127, 4, '2014-06-01 16:21:13'),
(100, 3, '2014-06-01 16:21:26'),
(100, 3, '2014-06-01 16:21:26'),
(100, 3, '2014-06-01 16:21:27'),
(100, 3, '2014-06-01 16:21:27');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `role`
--

CREATE TABLE IF NOT EXISTS `role` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  `active` char(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `active` (`active`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Gegevens worden uitgevoerd voor tabel `role`
--

INSERT INTO `role` (`id`, `name`, `active`) VALUES
(1, 'Administrators', 'Y'),
(2, 'Users', 'Y'),
(3, 'Read-Only', 'Y');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `status`
--

CREATE TABLE IF NOT EXISTS `status` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Gegevens worden uitgevoerd voor tabel `status`
--

INSERT INTO `status` (`id`, `name`) VALUES
(2, 'non-confirmed');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `passhash` char(128) NOT NULL,
  `salt` varchar(64) DEFAULT NULL,
  `roleId` int(10) unsigned NOT NULL,
  `statusId` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `profilesId` (`roleId`),
  KEY `roleId` (`roleId`),
  KEY `statusId` (`statusId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Gegevens worden uitgevoerd voor tabel `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `passhash`, `salt`, `roleId`, `statusId`) VALUES
(3, 'test', 'test@test.nl', '$2a$08$gpKVXhOQpMLSJ6GsGKnhYuporEcetbd.6YTdYmf1SFkKa4t5IGg5W', NULL, 2, 2),
(4, 'test2', 'test2@test.nl', '$2a$08$HXl9dmvPXsgArl4Y9B86a.phoNn6XHxg009cjKdxBgUHRM6aa9r9a', 'Q4qCwHQ2AN13RYfxZ32X4w', 2, 2);

--
-- Beperkingen voor gedumpte tabellen
--

--
-- Beperkingen voor tabel `permission`
--
ALTER TABLE `permission`
  ADD CONSTRAINT `permission_ibfk_1` FOREIGN KEY (`roleId`) REFERENCES `role` (`id`);

--
-- Beperkingen voor tabel `remember_token`
--
ALTER TABLE `remember_token`
  ADD CONSTRAINT `remember_token_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `user` (`id`);

--
-- Beperkingen voor tabel `reputation`
--
ALTER TABLE `reputation`
  ADD CONSTRAINT `reputation_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `user` (`id`);

--
-- Beperkingen voor tabel `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`roleId`) REFERENCES `role` (`id`),
  ADD CONSTRAINT `user_ibfk_2` FOREIGN KEY (`statusId`) REFERENCES `status` (`id`);
SET FOREIGN_KEY_CHECKS=1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
