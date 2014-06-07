SET FOREIGN_KEY_CHECKS=0;

CREATE TABLE IF NOT EXISTS `permission` (
  `roleName` varchar(64) NOT NULL,
  `controller` varchar(16) NOT NULL,
  `action` varchar(16) NOT NULL,
  PRIMARY KEY (`roleName`,`controller`,`action`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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

CREATE TABLE IF NOT EXISTS `reputation` (
  `points` tinyint(4) NOT NULL,
  `userId` int(10) unsigned NOT NULL,
  `createdAt` datetime NOT NULL,
  KEY `userId` (`userId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `role` (
  `name` varchar(64) NOT NULL,
  `power` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`name`),
  UNIQUE KEY `power` (`power`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `status` (
  `name` varchar(15) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

CREATE TABLE IF NOT EXISTS `value_tag` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `predicate_id` int(10) unsigned NOT NULL,
  `part` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `part` (`part`),
  KEY `predicate_id` (`predicate_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

CREATE TABLE IF NOT EXISTS `group` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

CREATE TABLE IF NOT EXISTS `item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL,
  `name` varchar(25) NOT NULL,
  `URI` varchar(2048) NOT NULL,
  `comment` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

CREATE TABLE IF NOT EXISTS `user_group` (
  `groupId` int(11) unsigned NOT NULL,
  `userId` int(11) unsigned NOT NULL,
  PRIMARY KEY (`groupId`,`userId`),
  KEY `userId` (`userId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `permission`
  ADD CONSTRAINT `permission_ibfk_1` FOREIGN KEY (`roleName`) REFERENCES `role` (`name`);

ALTER TABLE `remember_token`
  ADD CONSTRAINT `remember_token_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `user` (`id`);

ALTER TABLE `reputation`
  ADD CONSTRAINT `reputation_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `user` (`id`);

ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_2` FOREIGN KEY (`statusName`) REFERENCES `status` (`name`),
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`roleName`) REFERENCES `role` (`name`);

ALTER TABLE `user_group`
  ADD CONSTRAINT `user_group_ibfk_1` FOREIGN KEY (`groupId`) REFERENCES `group` (`id`),
  ADD CONSTRAINT `user_group_ibfk_2` FOREIGN KEY (`userId`) REFERENCES `user` (`id`);
SET FOREIGN_KEY_CHECKS=1;
