SET FOREIGN_KEY_CHECKS=0;

INSERT INTO `permission` (`roleName`, `controller`, `action`) VALUES
('Guest', 'account', 'loginForm'),
('Guest', 'account', 'performLogin'),
('Guest', 'account', 'performSignUp'),
('Guest', 'account', 'signUpForm'),
('Guest', 'index', 'index'),
('Users', 'account', 'logout'),
('Users', 'group', 'index'),
('Users', 'group', 'exploreGroup'),
('Users', 'group', 'addGroupForm'),
('Users', 'group', 'performAddGroup'),
('Users', 'group', 'performSubscribeGroup'),
('Users', 'group', 'performUnsubscribeGroup'),
('Users', 'item', 'add'),
('Users', 'item', 'performAddItem');

INSERT INTO `role` (`name`, `power`) VALUES
('Guest', 1),
('Users', 10),
('Administrator', 255);

INSERT INTO `status` (`name`) VALUES
('non-confirmed');

SET FOREIGN_KEY_CHECKS=1;