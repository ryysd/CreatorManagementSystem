-- phpMyAdmin SQL Dump
-- version 3.5.7
-- http://www.phpmyadmin.net
--
-- ホスト: 127.0.0.1
-- 生成日時: 2013 年 7 月 02 日 19:26
-- サーバのバージョン: 5.6.10
-- PHP のバージョン: 5.4.9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- データベース: `creator_management_system`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `attachments`
--

CREATE TABLE IF NOT EXISTS `attachments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `model` varchar(20) NOT NULL,
  `foreign_key` int(11) NOT NULL,
  `dir` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `size` int(11) DEFAULT '0',
  `active` tinyint(1) DEFAULT '1',
  `photo` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `is_accepted` tinyint(1) NOT NULL DEFAULT '0',
  `accepted_status_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- テーブルの構造 `cake_sessions`
--

CREATE TABLE IF NOT EXISTS `cake_sessions` (
  `id` varchar(255) NOT NULL DEFAULT '',
  `data` text NOT NULL,
  `expires` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- テーブルの構造 `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `content` varchar(511) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `order_line_id` int(11) NOT NULL,
  `attachment_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- テーブルの構造 `login_tokens`
--

CREATE TABLE IF NOT EXISTS `login_tokens` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `token` char(32) NOT NULL,
  `duration` varchar(32) NOT NULL,
  `used` tinyint(1) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `expires` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=31 ;

-- --------------------------------------------------------

--
-- テーブルの構造 `order_lines`
--

CREATE TABLE IF NOT EXISTS `order_lines` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `order_status_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `commnet_modified` datetime DEFAULT NULL,
  `deadline` datetime NOT NULL,
  `main_attachment_id` int(11) DEFAULT NULL,
  `pre_main_attachment_id` int(11) DEFAULT NULL,
  `pre_order_status_id` int(11) DEFAULT NULL,
  `order_line_log_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=44 ;

-- --------------------------------------------------------

--
-- テーブルの構造 `order_lines_users`
--

CREATE TABLE IF NOT EXISTS `order_lines_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_line_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=35 ;

-- --------------------------------------------------------

--
-- テーブルの構造 `order_line_logs`
--

CREATE TABLE IF NOT EXISTS `order_line_logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `attachment_id` int(11) DEFAULT NULL,
  `order_status_id` int(11) NOT NULL,
  `order_line_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=76 ;

-- --------------------------------------------------------

--
-- テーブルの構造 `order_statuses`
--

CREATE TABLE IF NOT EXISTS `order_statuses` (
  `id` int(11) DEFAULT NULL,
  `name` varchar(63) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `order_statuses`
--

INSERT INTO `order_statuses` (`id`, `name`, `created`, `modified`) VALUES
(2, 'ラフ', '2013-06-01 00:00:00', '2013-06-01 00:00:00'),
(4, '彩色', '2013-06-01 00:00:00', '2013-06-01 00:00:00'),
(3, '線画', '2013-06-01 00:00:00', '2013-06-08 00:00:00'),
(5, 'マスター', '2013-06-01 00:00:00', '2013-06-01 00:00:00'),
(1, '未承認', '2013-06-01 00:00:00', '2013-06-01 00:00:00');

-- --------------------------------------------------------

--
-- テーブルの構造 `projects`
--

CREATE TABLE IF NOT EXISTS `projects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_status_id` int(11) NOT NULL,
  `deadline` datetime NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `title` varchar(255) NOT NULL,
  `remark` varchar(511) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=26 ;

-- --------------------------------------------------------

--
-- テーブルの構造 `project_statuses`
--

CREATE TABLE IF NOT EXISTS `project_statuses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(63) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- テーブルのデータのダンプ `project_statuses`
--

INSERT INTO `project_statuses` (`id`, `name`, `created`, `modified`) VALUES
(1, '準備中', '2013-06-01 00:00:00', '2013-06-01 00:00:00'),
(2, '進行中', '2013-06-01 00:00:00', '2013-06-01 00:00:00'),
(3, '完了', '2013-06-01 00:00:00', '2013-06-01 00:00:00');

-- --------------------------------------------------------

--
-- テーブルの構造 `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_group_id` int(11) unsigned DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `salt` text,
  `email` varchar(100) DEFAULT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `email_verified` int(1) DEFAULT '0',
  `active` int(1) NOT NULL DEFAULT '0',
  `ip_address` varchar(50) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user` (`username`),
  KEY `mail` (`email`),
  KEY `users_FKIndex1` (`user_group_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- テーブルのデータのダンプ `users`
--

INSERT INTO `users` (`id`, `user_group_id`, `username`, `password`, `salt`, `email`, `first_name`, `last_name`, `email_verified`, `active`, `ip_address`, `created`, `modified`) VALUES
(19, 1, 'admin', '7ed98b6645ed16c6ec49b1e81a05283c', '0b25d02fab6bd49ba49b89f355ad1899', 'admin@admin.com', 'testAdmin', 'testAdmin', 1, 1, '::1', '2013-07-02 11:09:07', '2013-07-03 04:22:35'),
(23, 5, 'illustrator', '2e4c6f13f1244db6b3e7751ef6f7f83f', '19a86bb2c1a2c84f2b79ae9c6a1c4fee', 'illustrator@gmail.com', NULL, NULL, 1, 1, NULL, '2013-07-03 03:10:31', '2013-07-03 03:10:31'),
(24, 4, 'client', 'fd4385b9248df2a454dd12b8537f10d3', 'f5906d207843bd77f96e79c7c7ce5f98', 'client@gmail.com', NULL, NULL, 1, 1, NULL, '2013-07-03 03:10:44', '2013-07-03 03:10:44');

-- --------------------------------------------------------

--
-- テーブルの構造 `user_groups`
--

CREATE TABLE IF NOT EXISTS `user_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `alias_name` varchar(100) DEFAULT NULL,
  `allowRegistration` int(1) NOT NULL DEFAULT '1',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- テーブルのデータのダンプ `user_groups`
--

INSERT INTO `user_groups` (`id`, `name`, `alias_name`, `allowRegistration`, `created`, `modified`) VALUES
(1, 'Admin', 'Admin', 0, '2013-07-01 21:20:34', '2013-07-01 21:20:34'),
(2, 'User', 'User', 1, '2013-07-01 21:20:34', '2013-07-01 21:20:34'),
(3, 'Guest', 'Guest', 0, '2013-07-01 21:20:34', '2013-07-01 21:20:34'),
(4, 'Client', 'Client', 0, '2013-07-01 14:20:40', '2013-07-03 02:46:20'),
(5, 'Illustrator', 'Illustrator', 0, '2013-07-03 02:46:47', '2013-07-03 02:46:47');

-- --------------------------------------------------------

--
-- テーブルの構造 `user_group_permissions`
--

CREATE TABLE IF NOT EXISTS `user_group_permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_group_id` int(10) unsigned NOT NULL,
  `controller` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `action` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `allowed` tinyint(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=188 ;

--
-- テーブルのデータのダンプ `user_group_permissions`
--

INSERT INTO `user_group_permissions` (`id`, `user_group_id`, `controller`, `action`, `allowed`) VALUES
(1, 1, 'Pages', 'display', 1),
(2, 2, 'Pages', 'display', 1),
(3, 3, 'Pages', 'display', 1),
(4, 1, 'UserGroupPermissions', 'index', 1),
(5, 2, 'UserGroupPermissions', 'index', 0),
(6, 3, 'UserGroupPermissions', 'index', 0),
(7, 1, 'UserGroupPermissions', 'update', 1),
(8, 2, 'UserGroupPermissions', 'update', 0),
(9, 3, 'UserGroupPermissions', 'update', 0),
(10, 1, 'UserGroups', 'index', 1),
(11, 2, 'UserGroups', 'index', 0),
(12, 3, 'UserGroups', 'index', 0),
(13, 1, 'UserGroups', 'addGroup', 1),
(14, 2, 'UserGroups', 'addGroup', 0),
(15, 3, 'UserGroups', 'addGroup', 0),
(16, 1, 'UserGroups', 'editGroup', 1),
(17, 2, 'UserGroups', 'editGroup', 0),
(18, 3, 'UserGroups', 'editGroup', 0),
(19, 1, 'UserGroups', 'deleteGroup', 1),
(20, 2, 'UserGroups', 'deleteGroup', 0),
(21, 3, 'UserGroups', 'deleteGroup', 0),
(22, 1, 'Users', 'index', 1),
(23, 2, 'Users', 'index', 0),
(24, 3, 'Users', 'index', 0),
(25, 1, 'Users', 'viewUser', 1),
(26, 2, 'Users', 'viewUser', 0),
(27, 3, 'Users', 'viewUser', 0),
(28, 1, 'Users', 'myprofile', 1),
(29, 2, 'Users', 'myprofile', 1),
(30, 3, 'Users', 'myprofile', 0),
(31, 1, 'Users', 'login', 1),
(32, 2, 'Users', 'login', 1),
(33, 3, 'Users', 'login', 1),
(34, 1, 'Users', 'logout', 1),
(35, 2, 'Users', 'logout', 1),
(36, 3, 'Users', 'logout', 1),
(37, 1, 'Users', 'register', 1),
(38, 2, 'Users', 'register', 1),
(39, 3, 'Users', 'register', 1),
(40, 1, 'Users', 'changePassword', 1),
(41, 2, 'Users', 'changePassword', 1),
(42, 3, 'Users', 'changePassword', 0),
(43, 1, 'Users', 'changeUserPassword', 1),
(44, 2, 'Users', 'changeUserPassword', 0),
(45, 3, 'Users', 'changeUserPassword', 0),
(46, 1, 'Users', 'addUser', 1),
(47, 2, 'Users', 'addUser', 0),
(48, 3, 'Users', 'addUser', 0),
(49, 1, 'Users', 'editUser', 1),
(50, 2, 'Users', 'editUser', 0),
(51, 3, 'Users', 'editUser', 0),
(52, 1, 'Users', 'dashboard', 1),
(53, 2, 'Users', 'dashboard', 1),
(54, 3, 'Users', 'dashboard', 0),
(55, 1, 'Users', 'deleteUser', 1),
(56, 2, 'Users', 'deleteUser', 0),
(57, 3, 'Users', 'deleteUser', 0),
(58, 1, 'Users', 'makeActive', 1),
(59, 2, 'Users', 'makeActive', 0),
(60, 3, 'Users', 'makeActive', 0),
(61, 1, 'Users', 'accessDenied', 1),
(62, 2, 'Users', 'accessDenied', 1),
(63, 3, 'Users', 'accessDenied', 1),
(64, 1, 'Users', 'userVerification', 1),
(65, 2, 'Users', 'userVerification', 1),
(66, 3, 'Users', 'userVerification', 1),
(67, 1, 'Users', 'forgotPassword', 1),
(68, 2, 'Users', 'forgotPassword', 1),
(69, 3, 'Users', 'forgotPassword', 1),
(70, 1, 'Users', 'makeActiveInactive', 1),
(71, 2, 'Users', 'makeActiveInactive', 0),
(72, 3, 'Users', 'makeActiveInactive', 0),
(73, 1, 'Users', 'verifyEmail', 1),
(74, 2, 'Users', 'verifyEmail', 0),
(75, 3, 'Users', 'verifyEmail', 0),
(76, 1, 'Users', 'activatePassword', 1),
(77, 2, 'Users', 'activatePassword', 1),
(78, 3, 'Users', 'activatePassword', 1),
(79, 1, 'Admin', 'login', 0),
(80, 2, 'Admin', 'login', 0),
(81, 3, 'Admin', 'login', 0),
(82, 4, 'Admin', 'login', 0),
(83, 4, 'Pages', 'display', 1),
(84, 1, 'Projects', 'updateStatus', 1),
(85, 2, 'Projects', 'updateStatus', 0),
(86, 3, 'Projects', 'updateStatus', 0),
(87, 4, 'Projects', 'updateStatus', 1),
(88, 1, 'Projects', 'index', 1),
(89, 2, 'Projects', 'index', 0),
(90, 3, 'Projects', 'index', 0),
(91, 4, 'Projects', 'index', 0),
(92, 1, 'Projects', 'view', 1),
(93, 2, 'Projects', 'view', 0),
(94, 3, 'Projects', 'view', 0),
(95, 4, 'Projects', 'view', 1),
(96, 1, 'Projects', 'add', 1),
(97, 2, 'Projects', 'add', 0),
(98, 3, 'Projects', 'add', 0),
(99, 4, 'Projects', 'add', 0),
(100, 1, 'Projects', 'edit', 1),
(101, 2, 'Projects', 'edit', 0),
(102, 3, 'Projects', 'edit', 0),
(103, 4, 'Projects', 'edit', 0),
(104, 1, 'Projects', 'delete', 1),
(105, 2, 'Projects', 'delete', 0),
(106, 3, 'Projects', 'delete', 0),
(107, 4, 'Projects', 'delete', 0),
(108, 4, 'Users', 'index', 0),
(109, 5, 'Users', 'index', 0),
(110, 1, 'Users', 'view', 1),
(111, 2, 'Users', 'view', 1),
(112, 3, 'Users', 'view', 0),
(113, 4, 'Users', 'view', 1),
(114, 5, 'Users', 'view', 1),
(115, 4, 'Users', 'dashboard', 1),
(116, 5, 'Users', 'dashboard', 1),
(117, 1, 'Users', 'delete', 0),
(118, 2, 'Users', 'delete', 0),
(119, 3, 'Users', 'delete', 0),
(120, 4, 'Users', 'delete', 0),
(121, 5, 'Users', 'delete', 0),
(122, 1, 'Users', 'edit', 0),
(123, 2, 'Users', 'edit', 0),
(124, 3, 'Users', 'edit', 0),
(125, 4, 'Users', 'edit', 0),
(126, 5, 'Users', 'edit', 0),
(127, 1, 'Users', 'add', 0),
(128, 2, 'Users', 'add', 0),
(129, 3, 'Users', 'add', 0),
(130, 4, 'Users', 'add', 0),
(131, 5, 'Users', 'add', 0),
(132, 5, 'Projects', 'delete', 0),
(133, 5, 'Projects', 'edit', 0),
(134, 5, 'Projects', 'add', 0),
(135, 5, 'Projects', 'view', 0),
(136, 5, 'Projects', 'index', 0),
(137, 5, 'Projects', 'updateStatus', 0),
(138, 1, 'OrderLines', 'rollback_order_status', 1),
(139, 2, 'OrderLines', 'rollback_order_status', 0),
(140, 3, 'OrderLines', 'rollback_order_status', 0),
(141, 4, 'OrderLines', 'rollback_order_status', 1),
(142, 5, 'OrderLines', 'rollback_order_status', 0),
(143, 1, 'OrderLines', 'delete_attachment', 1),
(144, 2, 'OrderLines', 'delete_attachment', 0),
(145, 3, 'OrderLines', 'delete_attachment', 0),
(146, 4, 'OrderLines', 'delete_attachment', 0),
(147, 5, 'OrderLines', 'delete_attachment', 1),
(148, 1, 'OrderLines', 'update_status', 1),
(149, 2, 'OrderLines', 'update_status', 0),
(150, 3, 'OrderLines', 'update_status', 0),
(151, 4, 'OrderLines', 'update_status', 1),
(152, 5, 'OrderLines', 'update_status', 0),
(153, 1, 'OrderLines', 'upload', 1),
(154, 2, 'OrderLines', 'upload', 0),
(155, 3, 'OrderLines', 'upload', 0),
(156, 4, 'OrderLines', 'upload', 0),
(157, 5, 'OrderLines', 'upload', 1),
(158, 1, 'OrderLines', 'delete', 1),
(159, 2, 'OrderLines', 'delete', 0),
(160, 3, 'OrderLines', 'delete', 0),
(161, 4, 'OrderLines', 'delete', 0),
(162, 5, 'OrderLines', 'delete', 0),
(163, 1, 'OrderLines', 'edit', 1),
(164, 2, 'OrderLines', 'edit', 0),
(165, 3, 'OrderLines', 'edit', 0),
(166, 4, 'OrderLines', 'edit', 0),
(167, 5, 'OrderLines', 'edit', 0),
(168, 1, 'OrderLines', 'add', 1),
(169, 2, 'OrderLines', 'add', 0),
(170, 3, 'OrderLines', 'add', 0),
(171, 4, 'OrderLines', 'add', 0),
(172, 5, 'OrderLines', 'add', 0),
(173, 1, 'OrderLines', 'view', 1),
(174, 2, 'OrderLines', 'view', 0),
(175, 3, 'OrderLines', 'view', 0),
(176, 4, 'OrderLines', 'view', 1),
(177, 5, 'OrderLines', 'view', 1),
(178, 1, 'OrderLines', 'index', 1),
(179, 2, 'OrderLines', 'index', 0),
(180, 3, 'OrderLines', 'index', 0),
(181, 4, 'OrderLines', 'index', 0),
(182, 5, 'OrderLines', 'index', 0),
(183, 1, 'Comments', 'add', 1),
(184, 2, 'Comments', 'add', 0),
(185, 3, 'Comments', 'add', 0),
(186, 4, 'Comments', 'add', 1),
(187, 5, 'Comments', 'add', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
