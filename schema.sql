-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Machine: 127.0.0.1
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
-- Tabelstructuur voor tabel `namespace_tag`
--

CREATE TABLE IF NOT EXISTS `namespace_tag` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `part` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `part` (`part`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

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
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `roleId` int(10) unsigned NOT NULL,
  `resource` varchar(16) NOT NULL,
  `action` varchar(16) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `profilesId` (`roleId`),
  KEY `roleId` (`roleId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=23 ;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `predicate_tag`
--

CREATE TABLE IF NOT EXISTS `predicate_tag` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `namespace_id` int(10) unsigned NOT NULL,
  `part` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `part` (`part`),
  KEY `namespace_id` (`namespace_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

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

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `status`
--

CREATE TABLE IF NOT EXISTS `status` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

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
  `roleId` int(10) unsigned NOT NULL,
  `statusId` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `profilesId` (`roleId`),
  KEY `roleId` (`roleId`),
  KEY `statusId` (`statusId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;


INSERT INTO `user` (`id`, `name`, `email`, `passhash`, `salt`, `roleId`, `statusId`) VALUES
(3, 'test', 'test@test.nl', '$2a$08$gpKVXhOQpMLSJ6GsGKnhYuporEcetbd.6YTdYmf1SFkKa4t5IGg5W', NULL, 2, 2),
(4, 'test2', 'test2@test.nl', '$2a$08$HXl9dmvPXsgArl4Y9B86a.phoNn6XHxg009cjKdxBgUHRM6aa9r9a', 'Q4qCwHQ2AN13RYfxZ32X4w', 2, 2);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `value_tag`
--


CREATE TABLE IF NOT EXISTS `value_tag` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `predicate_id` int(10) unsigned NOT NULL,
  `part` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `part` (`part`),
  KEY `predicate_id` (`predicate_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;


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
  ADD CONSTRAINT `permission_ibfk_1` FOREIGN KEY (`roleId`) REFERENCES `role` (`id`);

--
-- Beperkingen voor tabel `predicate_tag`
--
ALTER TABLE `predicate_tag`
  ADD CONSTRAINT `predicate_tag_ibfk_1` FOREIGN KEY (`namespace_id`) REFERENCES `namespace_tag` (`id`);

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

--
-- Beperkingen voor tabel `value_tag`
--
ALTER TABLE `value_tag`
  ADD CONSTRAINT `value_tag_ibfk_1` FOREIGN KEY (`predicate_id`) REFERENCES `predicate_tag` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
