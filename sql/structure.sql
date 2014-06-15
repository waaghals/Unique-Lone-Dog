SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

DROP TABLE IF EXISTS `comment`;
CREATE TABLE IF NOT EXISTS `comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `itemId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `text` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

DROP TABLE IF EXISTS `group`;
CREATE TABLE IF NOT EXISTS `group` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `slug` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `slug` (`slug`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

DROP TABLE IF EXISTS `group_tag`;
CREATE TABLE IF NOT EXISTS `group_tag` (
  `groupId` int(10) unsigned NOT NULL,
  `tagId` int(10) unsigned NOT NULL,
  PRIMARY KEY (`groupId`,`tagId`),
  KEY `tagId` (`tagId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `item`;
CREATE TABLE IF NOT EXISTS `item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL,
  `name` varchar(25) NOT NULL,
  `URI` varchar(2048) NOT NULL,
  `description` text,
  `type` varchar(25),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=61 ;

DROP TABLE IF EXISTS `item_tag`;
CREATE TABLE IF NOT EXISTS `item_tag` (
  `itemId` int(10) unsigned NOT NULL,
  `tagId` int(10) unsigned NOT NULL,
  PRIMARY KEY (`itemId`,`tagId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `namespace_tag`;
CREATE TABLE IF NOT EXISTS `namespace_tag` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `part` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `part` (`part`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=66 ;

DROP TABLE IF EXISTS `permission`;
CREATE TABLE IF NOT EXISTS `permission` (
  `roleName` varchar(64) NOT NULL,
  `controller` varchar(25) NOT NULL,
  `action` varchar(25) NOT NULL,
  PRIMARY KEY (`roleName`,`controller`,`action`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `predicate_tag`;
CREATE TABLE IF NOT EXISTS `predicate_tag` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `namespace_id` int(11) unsigned NOT NULL,
  `part` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `namespace_id` (`namespace_id`,`part`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

DROP TABLE IF EXISTS `remember_token`;
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

DROP TABLE IF EXISTS `reputation`;
CREATE TABLE IF NOT EXISTS `reputation` (
  `points` tinyint(4) NOT NULL,
  `userId` int(10) unsigned NOT NULL,
  `createdAt` datetime NOT NULL,
  KEY `userId` (`userId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `role`;
CREATE TABLE IF NOT EXISTS `role` (
  `name` varchar(64) NOT NULL,
  `power` tinyint(3) NOT NULL,
  PRIMARY KEY (`name`),
  UNIQUE KEY `power` (`power`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `status`;
CREATE TABLE IF NOT EXISTS `status` (
  `name` varchar(15) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `passhash` char(128) NOT NULL,
  `salt` varchar(64) NOT NULL,
  `statusName` varchar(15) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `statusName` (`statusName`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

DROP TABLE IF EXISTS `user_group`;
CREATE TABLE IF NOT EXISTS `user_group` (
  `groupId` int(11) unsigned NOT NULL,
  `userId` int(11) unsigned NOT NULL,
  PRIMARY KEY (`groupId`,`userId`),
  KEY `userId` (`userId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `value_tag`;
CREATE TABLE IF NOT EXISTS `value_tag` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `predicate_id` int(10) unsigned NOT NULL,
  `part` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `part` (`part`),
  KEY `predicate_id` (`predicate_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;


ALTER TABLE `group_tag`
  ADD CONSTRAINT `group_tag_ibfk_2` FOREIGN KEY (`tagId`) REFERENCES `value_tag` (`id`),
  ADD CONSTRAINT `group_tag_ibfk_1` FOREIGN KEY (`groupId`) REFERENCES `group` (`id`);

ALTER TABLE `permission`
  ADD CONSTRAINT `permission_ibfk_1` FOREIGN KEY (`roleName`) REFERENCES `role` (`name`);

ALTER TABLE `remember_token`
  ADD CONSTRAINT `remember_token_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `user` (`id`);

ALTER TABLE `reputation`
  ADD CONSTRAINT `reputation_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `user` (`id`);

ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_2` FOREIGN KEY (`statusName`) REFERENCES `status` (`name`);

ALTER TABLE `user_group`
  ADD CONSTRAINT `user_group_ibfk_1` FOREIGN KEY (`groupId`) REFERENCES `group` (`id`),
  ADD CONSTRAINT `user_group_ibfk_2` FOREIGN KEY (`userId`) REFERENCES `user` (`id`);
SET FOREIGN_KEY_CHECKS=1;
