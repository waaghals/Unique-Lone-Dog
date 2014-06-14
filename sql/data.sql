SET FOREIGN_KEY_CHECKS=0;

INSERT IGNORE INTO `item` (`id`, `userId`, `name`, `URI`, `comment`) VALUES
(58, 3, 'Test item', 'http://test.com', NULL),
(59, 3, 'test', 'http://google.com', NULL);

INSERT IGNORE INTO `item_tag` (`itemId`, `tagId`) VALUES
(34, 7),
(39, 7),
(40, 7),
(41, 7),
(42, 7),
(43, 7),
(44, 7),
(45, 7),
(46, 7),
(47, 7),
(48, 7),
(49, 7),
(50, 7),
(51, 7),
(52, 7),
(53, 7),
(54, 7),
(55, 7),
(55, 8),
(55, 9),
(56, 7),
(56, 8),
(56, 9),
(57, 7),
(58, 10),
(59, 10);

INSERT IGNORE INTO `namespace_tag` (`id`, `part`) VALUES
(60, 'author'),
(61, 'content'),
(63, 'meta'),
(64, 'name');

INSERT IGNORE INTO `permission` (`roleName`, `controller`, `action`) VALUES
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
('Users', 'group', 'addGroupForm'),
('Users', 'group', 'exploreGroup'),
('Users', 'group', 'mine'),
('Users', 'group', 'performAddFilter'),
('Users', 'group', 'performAddGroup'),
('Users', 'group', 'performSubscribeGroup'),
('Users', 'group', 'performUnsubscribeGroup'),
('Users', 'index', 'tagCreateTest'),
('Users', 'item', 'add'),
('Users', 'item', 'performAddComment'),
('Users', 'item', 'performAddItem');

INSERT IGNORE INTO `predicate_tag` (`id`, `namespace_id`, `part`) VALUES
(2, 60, 'email'),
(1, 60, 'name'),
(3, 61, 'type'),
(4, 63, 'test'),
(5, 63, 'testnr'),
(6, 64, 'pre');

INSERT IGNORE INTO `reputation` (`points`, `userId`, `createdAt`) VALUES
(50, 5, '2014-06-14 23:19:45'),
(2, 5, '2014-06-14 23:19:54'),
(50, 6, '2014-06-14 23:20:13'),
(50, 7, '2014-06-14 23:20:25'),
(2, 7, '2014-06-14 23:20:34'),
(1, 7, '2014-06-14 23:21:45'),
(1, 7, '2014-06-14 23:21:45'),
(1, 7, '2014-06-14 23:22:42'),
(1, 7, '2014-06-14 23:22:42'),
(1, 7, '2014-06-14 23:23:22'),
(1, 7, '2014-06-14 23:23:22'),
(1, 7, '2014-06-14 23:25:05'),
(1, 7, '2014-06-14 23:25:05'),
(1, 7, '2014-06-14 23:25:40'),
(1, 7, '2014-06-14 23:25:40'),
(1, 7, '2014-06-14 23:26:03'),
(1, 7, '2014-06-14 23:26:03'),
(25, 3, '2014-06-14 23:27:33'),
(22, 4, '2014-06-14 23:27:33');

INSERT IGNORE INTO `role` (`name`, `power`) VALUES
('Guest', 0),
('Users', 3),
('Administrator', 99);

INSERT IGNORE INTO `status` (`name`) VALUES
('non-confirmed');

INSERT IGNORE INTO `user` (`id`, `name`, `email`, `passhash`, `salt`, `statusName`) VALUES
(3, 'test', 'test@test.nl', '$2a$08$tolRSHYGfBJLGDWXI6y8cuOy9gs4owrd3DnSq2ZLz6Hr/3Gr6V.fG', '7s06gxuMb5qEyLX66p6O1w', 'non-confirmed'),
(4, 'test2', 'test2@test.nl', '$2a$08$tolRSHYGfBJLGDWXI6y8cuOy9gs4owrd3DnSq2ZLz6Hr/3Gr6V.fG', '7s06gxuMb5qEyLX66p6O1w', 'non-confirmed'),
(5, 'Waaghals', 'test3@test.nl', '$2a$08$haKvHFBOj5EU53rH6d4CAuuEJKNDywfdwIQbNODBuBtqb7VVoc7da', 'u8j5TKXr3PW2B1Rv5uS13g', 'non-confirmed'),
(6, 'Patrickje', 'test4@test.nl', '$2a$08$GxdmaoJwucMH6NyNVAPglulG9UuvqmUMYAR7wvJypdwCxk1IQcYJe', '8IaAvjVh1iY9NewEwYMJDA', 'non-confirmed'),
(7, 'Testje', 'test5@test.nl', '$2a$08$IYl67AVZyxf0CRopixgUeunnFbSjzuhsl4UfRv4LsAhwqMT4aMxOa', 'CeiYVJBisDwpcxkKIBGBHw', 'non-confirmed');

INSERT IGNORE INTO `value_tag` (`id`, `predicate_id`, `part`) VALUES
(4, 1, 'Patrick Berenschot'),
(5, 2, 'parberen@avans.nl'),
(6, 3, 'image/jpg'),
(7, 4, 'true'),
(8, 5, 'one'),
(9, 5, 'two'),
(10, 6, 'val');

SET FOREIGN_KEY_CHECKS=1;
