SET FOREIGN_KEY_CHECKS=0;

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

TRUNCATE TABLE `comment`;
TRUNCATE TABLE `group`;
TRUNCATE TABLE `item`;
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
('Users', 'group', 'mine')
('Users', 'group', 'addFilter'),
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
(2, 8, '2014-06-15 00:27:24');

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
(8, 'Waaghals', 'test@test.nl', '$2a$08$iYiA0dA9xo9uTj08c70i1eafhBaY.VLnvJ3N.c6TC50IVPpUfwiNK', '3JCS5SElpzoATO3BRavasg', 'non-confirmed');

TRUNCATE TABLE `user_group`;
TRUNCATE TABLE `value_tag`;SET FOREIGN_KEY_CHECKS=1;


SET FOREIGN_KEY_CHECKS=1;