SET FOREIGN_KEY_CHECKS=0;

INSERT IGNORE INTO `permission` (`roleName`, `controller`, `action`) VALUES
(INSERT INTO `permission` (`roleName`, `controller`, `action`) VALUES
('Administrator', 'item', 'deleteComment'),
('Administrator', 'item', 'deleteItem'),
('Guest', 'account', 'loginForm'),
('Guest', 'account', 'performLogin'),
('Guest', 'account', 'performSignUp'),
('Guest', 'account', 'signUpForm'),
('Guest', 'group', 'show'),
('Guest', 'index', 'index'),
('Guest', 'item', 'overview'),
('Guest', 'item', 'show'),
('Users', 'account', 'logout'),
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


INSERT IGNORE INTO `role` (`name`, `power`) VALUES
('Guest', 1),
('Users', 10),
('Administrator', 99);

INSERT IGNORE INTO `status` (`name`) VALUES
('non-confirmed');

SET FOREIGN_KEY_CHECKS=1;