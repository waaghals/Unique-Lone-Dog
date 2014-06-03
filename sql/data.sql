SET FOREIGN_KEY_CHECKS=0;

INSERT INTO `permission` (`roleName`, `controller`, `action`) VALUES
('Guest', 'account', 'loginForm'),
('Guest', 'account', 'performLogin'),
('Guest', 'account', 'performSignUp'),
('Guest', 'account', 'signUpForm'),
('Guest', 'index', 'index'),
('Users', 'account', 'logout');

INSERT INTO `role` (`name`, `power`) VALUES
('Guest', 1),
('Users', 10),
('Administrator', 255);

INSERT INTO `status` (`name`) VALUES
('non-confirmed');

SET FOREIGN_KEY_CHECKS=1;
