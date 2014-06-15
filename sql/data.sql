SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

INSERT INTO `comment` (`id`, `itemId`, `userId`, `text`) VALUES
(1, 1, 8, 'leuk!'),
(2, 1, 9, 'repost!'),
(3, 5, 10, 'al gezien!'),
(4, 5, 11, 'saai!'),
(5, 1, 12, 'lame!'),
(6, 1, 13, 'hilarisch!'),
(7, 2, 14, 'echt leuk!'),
(8, 6, 8, '+1!'),
(9, 3, 9, '+1!'),
(10, 3, 10, 'whaahhahaahahha!'),
(11, 3, 11, 'lachen man!'),
(12, 4, 12, 'heb hem zelf ook!'),
(13, 4, 13, '-1'),
(14, 7, 8, 'dat lust ik ook wel hoor ^^');

INSERT INTO `group` (`id`, `slug`, `name`, `description`) VALUES
(1, 'banaan', 'banaan', 'eet veel bananen, bananen zijn gezond'),
(2, 'australie', 'australie', 'alles over australie'),
(3, 'belgie', 'belgie', 'alles over belgie'),
(4, 'wereld-kampioen', 'wereld kampioen', 'alles over het wk!'),
(5, 'wk', 'wk', 'alles over het wk'),
(6, 'hockey', 'hockey', 'alles over hockey'),
(7, 'schaatsen', 'schaatsen', 'alles over schaatsen'),
(8, 'games', 'games', 'alles over games'),
(9, 'reddit', 'reddit', 'alles over reddit'),
(10, 'computers', 'computers', 'alles over computers'),
(11, 'xbox', 'xbox', 'alles over xbox'),
(12, 'muziek', 'muziek', 'alles over muziek');

INSERT INTO `group_tag` (`groupId`, `tagId`) VALUES
(1, 16),
(2, 17),
(3, 18),
(4, 19),
(5, 19),
(4, 22),
(5, 22),
(6, 22),
(4, 23),
(5, 23),
(6, 24),
(6, 25),
(9, 26),
(9, 27),
(12, 28),
(12, 29),
(12, 30),
(12, 31),
(12, 32),
(10, 33);

INSERT INTO `item` (`id`, `userId`, `name`, `URI`, `description`, `type`) VALUES
(1, 8, 'banaan', 'http://rack.3.mshcdn.com/media/ZgkyMDEyLzEwLzE5LzExXzMzXzMzXzE3Nl9maWxlCnAJdGh1bWIJMTIwMHg5NjAwPg/462b8072', 'alles over bananen', 'Image'),
(2, 9, 'konijnen filmpje', 'http://video.webmfiles.org/big-buck-bunny_trailer.webm', 'lachen', 'Video'),
(3, 9, 'no-image', 'http://www.surfplanet.it/ecomerce/images/no-image-large.png', 'i use it all the time', 'Image'),
(4, 12, '9gag', 'http://www.9gag.com', 'funny site', 'Site'),
(5, 13, 'dumpert', 'http://dumpert.nl', 'leuke filmpjes!', 'Site'),
(6, 11, 'reddit', 'http://www.reddit.com', 'leerzaam, maar wel de concurrent.', 'Site'),
(7, 8, 'aarbeitje <3', 'http://oi47.tinypic.com/m9vdy0.jpg', 'lekker lekker om te zien', 'Image'),
(8, 10, 'nu', 'http://www.nu.nl', 'recent nieuws.', 'Site'),
(9, 9, 'buienradar', 'http://www.buienradar.nl', 'alles over het weer', 'Site'),
(61, 8, 'AustraliÃ« overklast Nede', 'http://www.nu.nl/algemeen/3802950/australie-overklast-nederlandse-hockeyers-in-wk-finale.html', 'Ben best wel teleurgesteld. Gelukkig deden de dames het beter.', 'Site'),
(62, 8, 'Hockeysters kampioen', 'http://www.nu.nl/sport/3800981/hockeysters-bereiken-finale-wk-simpele-zege-argentinie.html', 'Hockeysters bereiken finale WK na simpele zege op ArgentiniÃ«', 'Site'),
(63, 8, 'Drain you', 'https://play.spotify.com/track/69rd4xBqWRjMpngW9tiwex?play=true&utm_source=open.spotify.com&utm_medium=open', 'Geweldig nummer van Nirvana', 'Site'),
(64, 8, 'Alive', 'http://open.spotify.com/track/620RU5uoEFpfDxAXlnlCW8', 'Goed nummer van Pearl Jam', 'Site');

INSERT INTO `item_tag` (`itemId`, `tagId`) VALUES
(1, 16),
(61, 22),
(62, 22),
(61, 24),
(62, 24),
(61, 25),
(6, 26),
(6, 27),
(63, 31),
(64, 32);

INSERT INTO `namespace_tag` (`id`, `part`) VALUES
(66, 'eten'),
(73, 'hobby'),
(71, 'hockey'),
(67, 'locatie'),
(74, 'muziek'),
(72, 'site'),
(70, 'sport'),
(68, 'voetbal');

INSERT INTO `permission` (`roleName`, `controller`, `action`) VALUES
('Administrator', 'group', 'performDeleteGroup'),
('Administrator', 'item', 'deleteComment'),
('Administrator', 'item', 'deleteItem'),
('Guest', 'account', 'loginForm'),
('Guest', 'account', 'logout'),
('Guest', 'account', 'performLogin'),
('Guest', 'account', 'performSignUp'),
('Guest', 'account', 'signUpForm'),
('Guest', 'group', 'show'),
('Guest', 'index', 'index'),
('Guest', 'index', 'commands'),
('Guest', 'item', 'overview'),
('Guest', 'item', 'show'),
('Users', 'group', 'addFilter'),
('Users', 'group', 'addGroupForm'),
('Users', 'group', 'exploreGroup'),
('Users', 'group', 'index'),
('Users', 'group', 'mine'),
('Users', 'group', 'performAddFilter'),
('Users', 'group', 'performAddGroup'),
('Users', 'group', 'performSubscribeGroup'),
('Users', 'group', 'performUnsubscribeGroup'),
('Users', 'index', 'tagCreateTest'),
('Users', 'item', 'add'),
('Users', 'item', 'performAddComment'),
('Users', 'item', 'performAddItem'),
('Users', 'item', 'view');

INSERT INTO `predicate_tag` (`id`, `namespace_id`, `part`) VALUES
(9, 66, 'fruit'),
(10, 67, 'land'),
(11, 68, 'evenement'),
(13, 70, 'poule'),
(14, 71, 'evenement'),
(15, 72, 'name'),
(16, 72, 'url'),
(17, 73, 'artiest'),
(19, 73, 'soort'),
(18, 74, 'artiest');

INSERT INTO `reputation` (`points`, `userId`, `createdAt`) VALUES
(50, 8, '2014-06-15 00:27:11'),
(2, 8, '2014-06-15 00:27:24'),
(50, 9, '2014-06-15 00:27:11'),
(2, 9, '2014-06-15 00:27:24'),
(50, 10, '2014-06-15 00:27:11'),
(2, 10, '2014-06-15 00:27:24'),
(50, 11, '2014-06-15 00:27:11'),
(2, 11, '2014-06-15 00:27:24'),
(50, 12, '2014-06-15 00:27:11'),
(2, 12, '2014-06-15 00:27:24'),
(50, 13, '2014-06-15 00:27:11'),
(2, 13, '2014-06-15 00:27:24'),
(50, 14, '2014-06-15 00:27:11'),
(2, 14, '2014-06-15 00:27:24'),
(1, 8, '2014-06-15 20:41:36'),
(1, 8, '2014-06-15 20:41:37'),
(1, 8, '2014-06-15 20:41:51'),
(1, 8, '2014-06-15 20:41:52'),
(1, 8, '2014-06-15 20:41:58'),
(1, 8, '2014-06-15 20:41:58'),
(1, 8, '2014-06-15 20:42:09'),
(1, 8, '2014-06-15 20:42:24'),
(1, 8, '2014-06-15 20:42:38'),
(1, 8, '2014-06-15 20:42:39'),
(1, 8, '2014-06-15 20:57:42'),
(1, 8, '2014-06-15 20:57:42'),
(10, 8, '2014-06-15 20:58:09'),
(1, 8, '2014-06-15 20:58:09'),
(1, 8, '2014-06-15 20:58:10'),
(1, 8, '2014-06-15 20:58:12'),
(1, 8, '2014-06-15 20:58:12'),
(1, 8, '2014-06-15 20:59:46'),
(1, 8, '2014-06-15 20:59:47'),
(1, 8, '2014-06-15 20:59:52'),
(1, 8, '2014-06-15 20:59:53'),
(1, 8, '2014-06-15 20:59:55'),
(1, 8, '2014-06-15 20:59:56'),
(1, 8, '2014-06-15 20:59:56'),
(1, 8, '2014-06-15 21:02:19'),
(1, 8, '2014-06-15 21:02:19'),
(1, 8, '2014-06-15 21:06:19'),
(1, 8, '2014-06-15 21:06:19'),
(1, 8, '2014-06-15 21:06:36'),
(1, 8, '2014-06-15 21:06:37'),
(1, 8, '2014-06-15 21:06:43'),
(1, 8, '2014-06-15 21:06:43'),
(50, 8, '2014-06-15 21:29:33'),
(1, 8, '2014-06-15 21:29:33'),
(1, 8, '2014-06-15 21:29:34'),
(50, 8, '2014-06-15 21:32:53'),
(1, 8, '2014-06-15 21:32:54'),
(1, 8, '2014-06-15 21:32:54'),
(50, 8, '2014-06-15 21:37:19'),
(1, 8, '2014-06-15 21:37:19'),
(1, 8, '2014-06-15 21:37:20'),
(50, 8, '2014-06-15 21:38:14'),
(1, 8, '2014-06-15 21:38:15'),
(1, 8, '2014-06-15 21:38:15');

INSERT INTO `role` (`name`, `power`) VALUES
('Guest', -1),
('Users', 0),
('Administrator', 99);

INSERT INTO `status` (`name`) VALUES
('non-confirmed');

INSERT INTO `user` (`id`, `name`, `email`, `passhash`, `salt`, `statusName`) VALUES
(8, 'Waaghals', 'waaghals@example.com', '$2a$08$iYiA0dA9xo9uTj08c70i1eafhBaY.VLnvJ3N.c6TC50IVPpUfwiNK', '3JCS5SElpzoATO3BRavasg', 'non-confirmed'),
(9, 'Tojba', 'tojba@example.com', '$2a$08$Mc8iuoVDVRAZAz0Sj4sXHeGrFuqt5VSBuiE..Y2DHfz59E/EHiBju', 'dxi94nkxyb2NhCueoDajZg', 'non-confirmed'),
(10, 'Elmo', 'elmo@example.com', '$2a$08$Mc8iuoVDVRAZAz0Sj4sXHeGrFuqt5VSBuiE..Y2DHfz59E/EHiBju', 'dxi94nkxyb2NhCueoDajZg', 'non-confirmed'),
(11, 'Sietse', 'sietse@example.com', '$2a$08$Mc8iuoVDVRAZAz0Sj4sXHeGrFuqt5VSBuiE..Y2DHfz59E/EHiBju', 'dxi94nkxyb2NhCueoDajZg', 'non-confirmed'),
(12, 'Nennis', 'nennis@example.com', '$2a$08$Mc8iuoVDVRAZAz0Sj4sXHeGrFuqt5VSBuiE..Y2DHfz59E/EHiBju', 'dxi94nkxyb2NhCueoDajZg', 'non-confirmed'),
(13, 'Henk', 'henk@example.com', '$2a$08$Mc8iuoVDVRAZAz0Sj4sXHeGrFuqt5VSBuiE..Y2DHfz59E/EHiBju', 'dxi94nkxyb2NhCueoDajZg', 'non-confirmed'),
(14, 'Piet', 'piet@example.com', '$2a$08$Mc8iuoVDVRAZAz0Sj4sXHeGrFuqt5VSBuiE..Y2DHfz59E/EHiBju', 'dxi94nkxyb2NhCueoDajZg', 'non-confirmed');

INSERT INTO `user_group` (`groupId`, `userId`) VALUES
(1, 8),
(2, 8),
(3, 8),
(4, 9),
(5, 9),
(6, 9);

INSERT INTO `value_tag` (`id`, `predicate_id`, `part`) VALUES
(16, 9, 'banaan'),
(17, 10, 'australie'),
(18, 10, 'belgie'),
(23, 11, 'wereld-kampioenschap'),
(19, 11, 'wk'),
(22, 13, 'wereld-kampioenschap'),
(25, 14, 'wereld-kampioenschap'),
(24, 14, 'wk'),
(26, 15, 'reddit'),
(27, 16, 'reddit.com'),
(28, 17, 'muziek'),
(29, 18, 'foo-fighters'),
(30, 18, 'muse'),
(31, 18, 'nirvana'),
(32, 18, 'pearl-jam'),
(33, 19, 'computers');
SET FOREIGN_KEY_CHECKS=1;
COMMIT;
