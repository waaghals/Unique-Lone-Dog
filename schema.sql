-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Machine: 127.0.0.1
-- Gegenereerd op: 31 mei 2014 om 22:30
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
-- Tabelstructuur voor tabel `password_change`
--

CREATE TABLE IF NOT EXISTS `password_change` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `userId` int(10) unsigned NOT NULL,
  `ipAddress` varbinary(16) NOT NULL,
  `userAgent` varchar(48) NOT NULL,
  `createdAt` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `usersId` (`userId`),
  KEY `userId` (`userId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `password_reset`
--

CREATE TABLE IF NOT EXISTS `password_reset` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `userId` int(10) unsigned NOT NULL,
  `code` varchar(48) NOT NULL,
  `createdAt` int(10) unsigned NOT NULL,
  `modifiedAt` int(10) unsigned DEFAULT NULL,
  `reset` char(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `usersId` (`userId`),
  KEY `userId` (`userId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `permission`
--

CREATE TABLE IF NOT EXISTS `permission` (
  `roleName` varchar(64) NOT NULL,
  `controller` varchar(16) NOT NULL,
  `action` varchar(16) NOT NULL,
  PRIMARY KEY (`roleName`,`controller`,`action`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `name` varchar(64) NOT NULL,
  `power` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`name`),
  UNIQUE KEY `power` (`power`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `status`
--

CREATE TABLE IF NOT EXISTS `status` (
  `name` varchar(15) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `passhash` char(128) NOT NULL,
  `salt` varchar(64) NOT NULL,
  `roleName` varchar(64) NOT NULL,
  `statusName` varchar(15) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `roleName` (`roleName`),
  KEY `statusName` (`statusName`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Beperkingen voor gedumpte tabellen
--

--
-- Beperkingen voor tabel `password_change`
--
ALTER TABLE `password_change`
  ADD CONSTRAINT `password_change_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `user` (`id`);

--
-- Beperkingen voor tabel `password_reset`
--
ALTER TABLE `password_reset`
  ADD CONSTRAINT `password_reset_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `user` (`id`);

--
-- Beperkingen voor tabel `permission`
--
ALTER TABLE `permission`
  ADD CONSTRAINT `permission_ibfk_1` FOREIGN KEY (`roleName`) REFERENCES `role` (`name`);

--
-- Beperkingen voor tabel `remember_token`
--
ALTER TABLE `remember_token`
  ADD CONSTRAINT `remember_token_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `user` (`id`);

--
-- Beperkingen voor tabel `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_2` FOREIGN KEY (`statusName`) REFERENCES `status` (`name`),
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`roleName`) REFERENCES `role` (`name`);
SET FOREIGN_KEY_CHECKS=1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
