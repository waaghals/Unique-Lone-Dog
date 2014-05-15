-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Machine: 127.0.0.1
-- Genereertijd: 15 mei 2014 om 10:25
-- Serverversie: 5.6.14
-- PHP-versie: 5.5.6

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
  `mustChangePassword` char(1) DEFAULT NULL,
  `roleId` int(10) unsigned NOT NULL,
  `statusId` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `profilesId` (`roleId`),
  KEY `roleId` (`roleId`),
  KEY `statusId` (`statusId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Gegevens worden uitgevoerd voor tabel `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `passhash`, `mustChangePassword`, `roleId`, `statusId`) VALUES
(3, 'test', 'test@test.nl', '$2a$08$gpKVXhOQpMLSJ6GsGKnhYuporEcetbd.6YTdYmf1SFkKa4t5IGg5W', NULL, 2, 2);

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
-- Beperkingen voor tabel `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`roleId`) REFERENCES `role` (`id`),
  ADD CONSTRAINT `user_ibfk_2` FOREIGN KEY (`statusId`) REFERENCES `status` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
