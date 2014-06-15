SET FOREIGN_KEY_CHECKS=0;

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

TRUNCATE TABLE `comment`;
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
(13, 4, 13, '-1');
TRUNCATE TABLE `filter`;
TRUNCATE TABLE `group`;
INSERT INTO `group` (`id`, `slug`, `name`, `description`) VALUES
(1, 'banaan', 'banaan', 'eet veel bananen, bananen zijn gezond'),
(2, 'australie', 'australie', 'alles over australie'),
(3, 'belgie', 'belgie', 'alles over belgie'),
(4, 'wereld kampioen', 'wereld kampioen', 'alles over het wk!'),
(5, 'wk', 'wk', 'alles over het wk'),
(6, 'hockey', 'hockey', 'alles over hockey'),
(7, 'schaatsen', 'schaatsen', 'alles over schaatsen'),
(8, 'games', 'games', 'alles over games'),
(9, 'reddit', 'reddit', 'alles over reddit'),
(10, 'computers', 'computers', 'alles over computers'),
(11, 'xbox', 'xbox', 'alles over xbox'),
(12, 'muziek', 'muziek', 'alles over muziek');
TRUNCATE TABLE `item`;
INSERT INTO `item` (`id`, `userId`, `name`, `URI`, `description`, `type`) VALUES
(1, 2, 'banaan', 'http://rack.3.mshcdn.com/media/ZgkyMDEyLzEwLzE5LzExXzMzXzMzXzE3Nl9maWxlCnAJdGh1bWIJMTIwMHg5NjAwPg/462b8072', 'alles over bananen', 'Image'),
(2, 4, 'konijnen filmpje', 'http://video.webmfiles.org/big-buck-bunny_trailer.webm', 'lachen', 'Video'),
(3, 3, 'no-image', 'http://www.surfplanet.it/ecomerce/images/no-image-large.png', 'i use it all the time','Image'),
(4, 1, '9gag', 'http://www.9gag.com', 'funny site','Site'),
(5, 6, 'dumpert', 'http://dumpert.nl', 'leuke filmpjes!','Site'),
(6, 5, 'reddit', 'http://www.reddit.com', 'leerzaam, maar wel de concurrent.','Site'),
(7, 8, 'aarbeitje <3', 'http://oi47.tinypic.com/m9vdy0.jpg', 'lekker lekker om te zien','Image'),
(8, 7, 'nu', 'http://www.nu.nl', 'recent nieuws.','Site'),
(9, 9, 'buienradar', 'http://www.buienradar.nl', 'alles over het weer','Site');
TRUNCATE TABLE `item_tag`;
TRUNCATE TABLE `namespace_tag`;
TRUNCATE TABLE `permission`;
INSERT INTO `permission` (`roleName`, `controller`, `action`) VALUES
('Administrator', 'item', 'deleteComment'),
('Administrator', 'item', 'deleteItem'),
('Administrator', 'group', 'performDeleteGroup'),
('Guest', 'account', 'loginForm'),
('Guest', 'account', 'logout'),
('Guest', 'account', 'performLogin'),
('Guest', 'account', 'performSignUp'),
('Guest', 'account', 'signUpForm'),
('Guest', 'group', 'show'),
('Guest', 'index', 'index'),
('Guest', 'item', 'overview'),
('Guest', 'item', 'show'),
('Users', 'group', 'addFilter'),
('Users', 'group', 'mine'),
('Users', 'group', 'addGroupForm'),
('Users', 'group', 'exploreGroup'),
('Users', 'group', 'index'),
('Users', 'group', 'performAddFilter'),
('Users', 'group', 'performAddGroup'),
('Users', 'group', 'performSubscribeGroup'),
('Users', 'group', 'performUnsubscribeGroup'),
('Users', 'index', 'tagCreateTest'),
('Users', 'item', 'add'),
('Users', 'item', 'performAddComment'),
('Users', 'item', 'performAddItem'),
('Users', 'item', 'view');

TRUNCATE TABLE `predicate_tag`;
TRUNCATE TABLE `remember_token`;
TRUNCATE TABLE `reputation`;
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
(2, 14, '2014-06-15 00:27:24');

TRUNCATE TABLE `role`;
INSERT INTO `role` (`name`, `power`) VALUES
('Guest', -1),
('Users', 0),
('Administrator', 99);

TRUNCATE TABLE `status`;
INSERT INTO `status` (`name`) VALUES
('non-confirmed');

TRUNCATE TABLE `user`;
INSERT INTO `user` (`id`, `name`, `email`, `passhash`, `salt`, `statusName`) VALUES
(8, 'Waaghals', 'waaghals@example.com', '$2a$08$iYiA0dA9xo9uTj08c70i1eafhBaY.VLnvJ3N.c6TC50IVPpUfwiNK', '3JCS5SElpzoATO3BRavasg', 'non-confirmed'),
(9, 'Tojba', 'tojba@example.com', '$2a$08$Mc8iuoVDVRAZAz0Sj4sXHeGrFuqt5VSBuiE..Y2DHfz59E/EHiBju', 'dxi94nkxyb2NhCueoDajZg', 'non-confirmed'),
(10, 'Elmo', 'elmo@example.com', '$2a$08$Mc8iuoVDVRAZAz0Sj4sXHeGrFuqt5VSBuiE..Y2DHfz59E/EHiBju', 'dxi94nkxyb2NhCueoDajZg', 'non-confirmed'),
(11, 'Sietse', 'sietse@example.com', '$2a$08$Mc8iuoVDVRAZAz0Sj4sXHeGrFuqt5VSBuiE..Y2DHfz59E/EHiBju', 'dxi94nkxyb2NhCueoDajZg', 'non-confirmed'),
(12, 'Nennis', 'nennis@example.com', '$2a$08$Mc8iuoVDVRAZAz0Sj4sXHeGrFuqt5VSBuiE..Y2DHfz59E/EHiBju', 'dxi94nkxyb2NhCueoDajZg', 'non-confirmed'),
(13, 'Henk', 'henk@example.com', '$2a$08$Mc8iuoVDVRAZAz0Sj4sXHeGrFuqt5VSBuiE..Y2DHfz59E/EHiBju', 'dxi94nkxyb2NhCueoDajZg', 'non-confirmed'),
(14, 'Piet', 'piet@example.com', '$2a$08$Mc8iuoVDVRAZAz0Sj4sXHeGrFuqt5VSBuiE..Y2DHfz59E/EHiBju', 'dxi94nkxyb2NhCueoDajZg', 'non-confirmed');

TRUNCATE TABLE `user_group`;
INSERT INTO `user_group` (`groupId`, `userId`) VALUES
(1, 8),
(2, 8),
(3, 8),
(4, 9),
(5, 9),
(6, 9);
TRUNCATE TABLE `value_tag`;SET FOREIGN_KEY_CHECKS=1;


SET FOREIGN_KEY_CHECKS=1;