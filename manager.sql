-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 29, 2014 at 10:42 PM
-- Server version: 5.5.35
-- PHP Version: 5.3.10-1ubuntu3.9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `manager`
--

-- --------------------------------------------------------

--
-- Table structure for table `acos`
--

CREATE TABLE IF NOT EXISTS `acos` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) DEFAULT NULL,
  `model` varchar(255) DEFAULT NULL,
  `foreign_key` int(10) DEFAULT NULL,
  `alias` varchar(255) DEFAULT NULL,
  `lft` int(10) DEFAULT NULL,
  `rght` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=363 ;

--
-- Dumping data for table `acos`
--

INSERT INTO `acos` (`id`, `parent_id`, `model`, `foreign_key`, `alias`, `lft`, `rght`) VALUES
(92, NULL, NULL, NULL, 'controllers', 1, 542),
(93, 92, NULL, NULL, 'CategorieFaqs', 2, 23),
(94, 93, NULL, NULL, 'index', 3, 4),
(95, 93, NULL, NULL, 'view', 5, 6),
(96, 93, NULL, NULL, 'add', 7, 8),
(97, 93, NULL, NULL, 'edit', 9, 10),
(98, 93, NULL, NULL, 'delete', 11, 12),
(99, 92, NULL, NULL, 'CategorieTickets', 24, 45),
(100, 99, NULL, NULL, 'index', 25, 26),
(101, 99, NULL, NULL, 'view', 27, 28),
(102, 99, NULL, NULL, 'add', 29, 30),
(103, 99, NULL, NULL, 'edit', 31, 32),
(104, 99, NULL, NULL, 'delete', 33, 34),
(105, 92, NULL, NULL, 'Commentaires', 46, 57),
(106, 105, NULL, NULL, 'index', 47, 48),
(107, 105, NULL, NULL, 'view', 49, 50),
(108, 105, NULL, NULL, 'add', 51, 52),
(109, 105, NULL, NULL, 'edit', 53, 54),
(110, 105, NULL, NULL, 'delete', 55, 56),
(111, 92, NULL, NULL, 'Factures', 58, 69),
(112, 111, NULL, NULL, 'index', 59, 60),
(113, 111, NULL, NULL, 'view', 61, 62),
(114, 111, NULL, NULL, 'add', 63, 64),
(115, 111, NULL, NULL, 'edit', 65, 66),
(116, 111, NULL, NULL, 'delete', 67, 68),
(117, 92, NULL, NULL, 'Faqs', 70, 91),
(118, 117, NULL, NULL, 'index', 71, 72),
(119, 117, NULL, NULL, 'view', 73, 74),
(120, 117, NULL, NULL, 'add', 75, 76),
(121, 117, NULL, NULL, 'edit', 77, 78),
(122, 117, NULL, NULL, 'delete', 79, 80),
(123, 92, NULL, NULL, 'GroupDetails', 92, 143),
(124, 123, NULL, NULL, 'index', 93, 94),
(125, 123, NULL, NULL, 'view', 95, 96),
(126, 123, NULL, NULL, 'add', 97, 98),
(127, 123, NULL, NULL, 'edit', 99, 100),
(128, 123, NULL, NULL, 'delete', 101, 102),
(129, 92, NULL, NULL, 'Groups', 144, 165),
(130, 129, NULL, NULL, 'index', 145, 146),
(131, 129, NULL, NULL, 'view', 147, 148),
(132, 129, NULL, NULL, 'add', 149, 150),
(133, 129, NULL, NULL, 'edit', 151, 152),
(134, 129, NULL, NULL, 'delete', 153, 154),
(135, 92, NULL, NULL, 'Pages', 166, 173),
(136, 135, NULL, NULL, 'display', 167, 168),
(137, 135, NULL, NULL, 'accueil', 169, 170),
(138, 135, NULL, NULL, 'admin_accueil', 171, 172),
(139, 92, NULL, NULL, 'Tickets', 174, 205),
(140, 139, NULL, NULL, 'index', 175, 176),
(141, 139, NULL, NULL, 'view', 177, 178),
(142, 139, NULL, NULL, 'add', 179, 180),
(143, 139, NULL, NULL, 'edit', 181, 182),
(144, 139, NULL, NULL, 'delete', 183, 184),
(145, 92, NULL, NULL, 'UserDetails', 206, 253),
(146, 145, NULL, NULL, 'index', 207, 208),
(147, 145, NULL, NULL, 'view', 209, 210),
(148, 145, NULL, NULL, 'add', 211, 212),
(149, 145, NULL, NULL, 'edit', 213, 214),
(150, 145, NULL, NULL, 'delete', 215, 216),
(151, 92, NULL, NULL, 'Users', 254, 281),
(152, 151, NULL, NULL, 'index', 255, 256),
(153, 151, NULL, NULL, 'view', 257, 258),
(154, 151, NULL, NULL, 'add', 259, 260),
(155, 151, NULL, NULL, 'edit', 261, 262),
(156, 151, NULL, NULL, 'delete', 263, 264),
(157, 151, NULL, NULL, 'login', 265, 266),
(158, 151, NULL, NULL, 'logout', 267, 268),
(159, 92, NULL, NULL, 'Acl', 282, 327),
(160, 159, NULL, NULL, 'Acos', 283, 290),
(161, 160, NULL, NULL, 'admin_index', 284, 285),
(162, 160, NULL, NULL, 'admin_empty_acos', 286, 287),
(163, 160, NULL, NULL, 'admin_build_acl', 288, 289),
(164, 159, NULL, NULL, 'Aros', 291, 326),
(165, 164, NULL, NULL, 'admin_index', 292, 293),
(166, 164, NULL, NULL, 'admin_check', 294, 295),
(167, 164, NULL, NULL, 'admin_users', 296, 297),
(168, 164, NULL, NULL, 'admin_update_user_group', 298, 299),
(169, 164, NULL, NULL, 'admin_ajax_group_permissions', 300, 301),
(170, 164, NULL, NULL, 'admin_group_permissions', 302, 303),
(171, 164, NULL, NULL, 'admin_user_permissions', 304, 305),
(172, 164, NULL, NULL, 'admin_empty_permissions', 306, 307),
(173, 164, NULL, NULL, 'admin_clear_user_specific_permissions', 308, 309),
(174, 164, NULL, NULL, 'admin_grant_all_controllers', 310, 311),
(175, 164, NULL, NULL, 'admin_deny_all_controllers', 312, 313),
(176, 164, NULL, NULL, 'admin_get_group_controller_permission', 314, 315),
(177, 164, NULL, NULL, 'admin_grant_group_permission', 316, 317),
(178, 164, NULL, NULL, 'admin_deny_group_permission', 318, 319),
(179, 164, NULL, NULL, 'admin_get_user_controller_permission', 320, 321),
(180, 164, NULL, NULL, 'admin_grant_user_permission', 322, 323),
(181, 164, NULL, NULL, 'admin_deny_user_permission', 324, 325),
(182, 129, NULL, NULL, 'admin_index', 155, 156),
(183, 129, NULL, NULL, 'admin_view', 157, 158),
(184, 92, NULL, NULL, 'Actualites', 328, 349),
(185, 184, NULL, NULL, 'index', 329, 330),
(186, 184, NULL, NULL, 'view', 331, 332),
(187, 184, NULL, NULL, 'add', 333, 334),
(188, 184, NULL, NULL, 'edit', 335, 336),
(189, 184, NULL, NULL, 'delete', 337, 338),
(190, 184, NULL, NULL, 'admin_index', 339, 340),
(191, 184, NULL, NULL, 'admin_add', 341, 342),
(192, 184, NULL, NULL, 'admin_view', 343, 344),
(193, 184, NULL, NULL, 'admin_edit', 345, 346),
(194, 184, NULL, NULL, 'admin_delete', 347, 348),
(195, 93, NULL, NULL, 'admin_index', 13, 14),
(196, 117, NULL, NULL, 'admin_index', 81, 82),
(197, 93, NULL, NULL, 'admin_add', 15, 16),
(198, 93, NULL, NULL, 'admin_view', 17, 18),
(199, 93, NULL, NULL, 'admin_edit', 19, 20),
(200, 93, NULL, NULL, 'admin_delete', 21, 22),
(201, 117, NULL, NULL, 'admin_add', 83, 84),
(202, 117, NULL, NULL, 'admin_view', 85, 86),
(203, 117, NULL, NULL, 'admin_edit', 87, 88),
(204, 117, NULL, NULL, 'admin_delete', 89, 90),
(205, 129, NULL, NULL, 'admin_add', 159, 160),
(206, 123, NULL, NULL, 'admin_addAdresse', 103, 104),
(207, 123, NULL, NULL, 'admin_add_adresse', 105, 106),
(208, 123, NULL, NULL, 'admin_add_email', 107, 108),
(209, 123, NULL, NULL, 'admin_add_numero', 109, 110),
(210, 129, NULL, NULL, 'admin_edit', 161, 162),
(211, 123, NULL, NULL, 'admin_edit', 111, 112),
(212, 123, NULL, NULL, 'admin_edit_email', 113, 114),
(213, 123, NULL, NULL, 'admin_edit_numero', 115, 116),
(214, 123, NULL, NULL, 'admin_delete_email', 117, 118),
(215, 123, NULL, NULL, 'admin_delete_numero', 119, 120),
(216, 123, NULL, NULL, 'admin_edit_adresse', 121, 122),
(217, 123, NULL, NULL, 'admin_delete_adresse', 123, 124),
(218, 123, NULL, NULL, 'add_email', 125, 126),
(219, 123, NULL, NULL, 'edit_email', 127, 128),
(220, 123, NULL, NULL, 'delete_email', 129, 130),
(221, 123, NULL, NULL, 'add_numero', 131, 132),
(222, 123, NULL, NULL, 'edit_numero', 133, 134),
(223, 123, NULL, NULL, 'delete_numero', 135, 136),
(224, 123, NULL, NULL, 'add_adresse', 137, 138),
(225, 123, NULL, NULL, 'edit_adresse', 139, 140),
(226, 123, NULL, NULL, 'delete_adresse', 141, 142),
(227, 129, NULL, NULL, 'admin_delete', 163, 164),
(228, 151, NULL, NULL, 'admin_index', 269, 270),
(229, 151, NULL, NULL, 'admin_add', 271, 272),
(230, 151, NULL, NULL, 'admin_edit', 273, 274),
(231, 151, NULL, NULL, 'admin_delete', 275, 276),
(232, 151, NULL, NULL, 'admin_view', 277, 278),
(233, 145, NULL, NULL, 'admin_add_email', 217, 218),
(234, 145, NULL, NULL, 'admin_edit_email', 219, 220),
(235, 145, NULL, NULL, 'admin_delete_email', 221, 222),
(236, 145, NULL, NULL, 'admin_add_numero', 223, 224),
(237, 145, NULL, NULL, 'admin_edit_numero', 225, 226),
(238, 145, NULL, NULL, 'admin_delete_numero', 227, 228),
(239, 145, NULL, NULL, 'admin_add_adresse', 229, 230),
(240, 145, NULL, NULL, 'admin_edit_adresse', 231, 232),
(241, 145, NULL, NULL, 'admin_delete_adresse', 233, 234),
(242, 145, NULL, NULL, 'add_adresse', 235, 236),
(243, 145, NULL, NULL, 'edit_adresse', 237, 238),
(244, 145, NULL, NULL, 'delete_adresse', 239, 240),
(245, 145, NULL, NULL, 'add_email', 241, 242),
(246, 145, NULL, NULL, 'edit_email', 243, 244),
(247, 145, NULL, NULL, 'delete_email', 245, 246),
(248, 145, NULL, NULL, 'add_numero', 247, 248),
(249, 145, NULL, NULL, 'edit_numero', 249, 250),
(250, 145, NULL, NULL, 'delete_numero', 251, 252),
(251, 139, NULL, NULL, 'admin_index', 185, 186),
(252, 99, NULL, NULL, 'admin_index', 35, 36),
(253, 99, NULL, NULL, 'admin_view', 37, 38),
(254, 99, NULL, NULL, 'admin_add', 39, 40),
(255, 99, NULL, NULL, 'admin_edit', 41, 42),
(256, 99, NULL, NULL, 'admin_delete', 43, 44),
(257, 139, NULL, NULL, 'admin_view', 187, 188),
(258, 139, NULL, NULL, 'openedToClosed', 189, 190),
(259, 139, NULL, NULL, 'index_closed', 191, 192),
(260, 139, NULL, NULL, 'index_all', 193, 194),
(261, 139, NULL, NULL, 'admin_closedToOpened', 195, 196),
(262, 139, NULL, NULL, 'admin_index_closed', 197, 198),
(263, 139, NULL, NULL, 'admin_index_all', 199, 200),
(264, 139, NULL, NULL, 'admin_edit', 201, 202),
(265, 139, NULL, NULL, 'admin_delete', 203, 204),
(266, 92, NULL, NULL, 'InvoiceTypes', 350, 361),
(267, 266, NULL, NULL, 'index', 351, 352),
(268, 92, NULL, NULL, 'InvoiceStatuts', 362, 371),
(269, 92, NULL, NULL, 'Invoices', 372, 399),
(270, 269, NULL, NULL, 'index', 373, 374),
(271, 269, NULL, NULL, 'admin_index', 375, 376),
(272, 269, NULL, NULL, 'admin_add', 377, 378),
(273, 269, NULL, NULL, 'admin_view', 379, 380),
(274, 269, NULL, NULL, 'admin_delete', 381, 382),
(275, 269, NULL, NULL, 'view', 383, 384),
(276, 269, NULL, NULL, 'admin_sendFile', 385, 386),
(277, 269, NULL, NULL, 'sendFile', 387, 388),
(278, 268, NULL, NULL, 'admin_index', 363, 364),
(279, 266, NULL, NULL, 'admin_index', 353, 354),
(280, 266, NULL, NULL, 'admin_switchActive', 355, 356),
(281, 266, NULL, NULL, 'admin_add', 357, 358),
(282, 266, NULL, NULL, 'admin_edit', 359, 360),
(283, 268, NULL, NULL, 'admin_switchActive', 365, 366),
(284, 268, NULL, NULL, 'admin_add', 367, 368),
(285, 268, NULL, NULL, 'admin_edit', 369, 370),
(286, 92, NULL, NULL, 'Passwords', 400, 417),
(287, 286, NULL, NULL, 'index', 401, 402),
(288, 286, NULL, NULL, 'admin_index', 403, 404),
(289, 286, NULL, NULL, 'add', 405, 406),
(290, 286, NULL, NULL, 'admin_add', 407, 408),
(291, 286, NULL, NULL, 'edit', 409, 410),
(292, 286, NULL, NULL, 'admin_edit', 411, 412),
(293, 286, NULL, NULL, 'delete', 413, 414),
(294, 286, NULL, NULL, 'admin_delete', 415, 416),
(295, 269, NULL, NULL, 'popup', 389, 390),
(296, 269, NULL, NULL, 'admin_popup', 391, 392),
(297, 269, NULL, NULL, 'admin_switchStatut', 393, 394),
(298, 269, NULL, NULL, 'admin_formStatut', 395, 396),
(299, 92, NULL, NULL, 'Tasks', 418, 437),
(300, 299, NULL, NULL, 'admin_index', 419, 420),
(301, 299, NULL, NULL, 'admin_add', 421, 422),
(302, 299, NULL, NULL, 'admin_edit', 423, 424),
(303, 299, NULL, NULL, 'admin_view', 425, 426),
(304, 299, NULL, NULL, 'index', 427, 428),
(305, 299, NULL, NULL, 'view', 429, 430),
(306, 299, NULL, NULL, 'admin_delete', 431, 432),
(307, 92, NULL, NULL, 'TaskProjects', 438, 449),
(308, 307, NULL, NULL, 'admin_index', 439, 440),
(309, 307, NULL, NULL, 'admin_edit', 441, 442),
(310, 307, NULL, NULL, 'admin_add', 443, 444),
(311, 307, NULL, NULL, 'admin_switchActive', 445, 446),
(312, 307, NULL, NULL, 'admin_delete', 447, 448),
(313, 92, NULL, NULL, 'TaskStatuts', 450, 461),
(314, 313, NULL, NULL, 'admin_index', 451, 452),
(315, 313, NULL, NULL, 'admin_edit', 453, 454),
(316, 313, NULL, NULL, 'admin_add', 455, 456),
(317, 313, NULL, NULL, 'admin_switchActive', 457, 458),
(318, 313, NULL, NULL, 'admin_delete', 459, 460),
(319, 92, NULL, NULL, 'TaskTypes', 462, 473),
(320, 319, NULL, NULL, 'admin_index', 463, 464),
(321, 319, NULL, NULL, 'admin_edit', 465, 466),
(322, 319, NULL, NULL, 'admin_add', 467, 468),
(323, 319, NULL, NULL, 'admin_switchActive', 469, 470),
(324, 319, NULL, NULL, 'admin_delete', 471, 472),
(325, 299, NULL, NULL, 'admin_switchStatut', 433, 434),
(326, 299, NULL, NULL, 'admin_formStatut', 435, 436),
(327, 92, NULL, NULL, 'PasswordServices', 474, 483),
(328, 327, NULL, NULL, 'admin_index', 475, 476),
(329, 327, NULL, NULL, 'admin_switchActive', 477, 478),
(330, 327, NULL, NULL, 'admin_add', 479, 480),
(331, 327, NULL, NULL, 'admin_edit', 481, 482),
(332, 92, NULL, NULL, 'PasswordTypes', 484, 493),
(333, 332, NULL, NULL, 'admin_index', 485, 486),
(334, 332, NULL, NULL, 'admin_switchActive', 487, 488),
(335, 332, NULL, NULL, 'admin_add', 489, 490),
(336, 332, NULL, NULL, 'admin_edit', 491, 492),
(337, 269, NULL, NULL, 'admin_search', 397, 398),
(338, 92, NULL, NULL, 'Voips', 494, 531),
(339, 338, NULL, NULL, 'index', 495, 496),
(340, 338, NULL, NULL, 'view', 497, 498),
(341, 338, NULL, NULL, 'admin_index', 499, 500),
(342, 338, NULL, NULL, 'admin_add', 501, 502),
(343, 338, NULL, NULL, 'admin_view', 503, 504),
(344, 338, NULL, NULL, 'admin_edit', 505, 506),
(345, 338, NULL, NULL, 'admin_delete', 507, 508),
(346, 338, NULL, NULL, 'admin_listAccount', 509, 510),
(347, 338, NULL, NULL, 'admin_newAccount', 511, 512),
(348, 338, NULL, NULL, 'admin_consommation', 513, 514),
(349, 338, NULL, NULL, 'admin_configuration', 515, 516),
(350, 338, NULL, NULL, 'user_account_info', 517, 518),
(351, 338, NULL, NULL, 'user_accountInfo', 519, 520),
(352, 338, NULL, NULL, 'accountInfo', 521, 522),
(353, 338, NULL, NULL, 'account', 523, 524),
(354, 338, NULL, NULL, 'user_account', 525, 526),
(355, 338, NULL, NULL, 'voipView', 527, 528),
(356, 151, NULL, NULL, 'voipList', 279, 280),
(357, 92, NULL, NULL, 'Modules', 532, 541),
(358, 357, NULL, NULL, 'admin_index', 533, 534),
(359, 357, NULL, NULL, 'enable', 535, 536),
(360, 357, NULL, NULL, 'admin_disable', 537, 538),
(361, 357, NULL, NULL, 'admin_enable', 539, 540),
(362, 338, NULL, NULL, 'admin_server', 529, 530);

-- --------------------------------------------------------

--
-- Table structure for table `actualites`
--

CREATE TABLE IF NOT EXISTS `actualites` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre_actu` varchar(70) NOT NULL,
  `contenu_actu` text NOT NULL,
  `created` datetime DEFAULT NULL,
  `actif_actu` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `actualites`
--

INSERT INTO `actualites` (`id`, `titre_actu`, `contenu_actu`, `created`, `actif_actu`) VALUES
(1, 'Lancement du manager', '<p>Ceci est la 1&egrave;re news du manager</p>', '2013-04-22 14:57:29', 1),
(2, 'Information', '<p>A titre d''information, j''utilise un <strong>plugin</strong> <span style="text-decoration: underline;">Tinymce</span> pour <em>&eacute;diter</em> mes actualit&eacute;s</p>', '2013-04-22 15:08:46', 1),
(3, 'test', '<p>test tset</p>', '2013-05-30 11:00:14', 0),
(4, 'Plus d''actualité', '<p>euhh</p>', '2013-07-01 17:53:36', 1),
(5, 'Flash', '<p>Couleur en fond vert du message vert</p>', '2013-07-08 16:58:42', 1);

-- --------------------------------------------------------

--
-- Table structure for table `aros`
--

CREATE TABLE IF NOT EXISTS `aros` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) DEFAULT NULL,
  `model` varchar(255) DEFAULT NULL,
  `foreign_key` int(10) DEFAULT NULL,
  `alias` varchar(255) DEFAULT NULL,
  `lft` int(10) DEFAULT NULL,
  `rght` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=33 ;

--
-- Dumping data for table `aros`
--

INSERT INTO `aros` (`id`, `parent_id`, `model`, `foreign_key`, `alias`, `lft`, `rght`) VALUES
(1, NULL, 'Group', 2, NULL, 1, 14),
(2, 1, 'User', 2, NULL, 12, 13),
(3, NULL, 'Group', 3, NULL, 15, 18),
(4, 1, 'User', 3, NULL, 2, 3),
(5, NULL, 'Group', 4, NULL, 19, 20),
(6, NULL, 'Group', 5, NULL, 21, 26),
(7, NULL, 'Group', 6, NULL, 27, 28),
(8, NULL, 'Group', 7, NULL, 29, 36),
(9, NULL, 'Group', 8, NULL, 37, 38),
(10, 3, 'User', 4, NULL, 16, 17),
(11, 6, 'User', 5, NULL, 22, 23),
(12, 6, 'User', 6, NULL, 24, 25),
(13, NULL, 'Group', 9, NULL, 39, 40),
(14, 8, 'User', 7, NULL, 30, 31),
(15, 8, 'User', 8, NULL, 32, 33),
(16, 1, 'User', 9, NULL, 4, 5),
(17, 1, 'User', 10, NULL, 6, 7),
(18, 1, 'User', 11, NULL, 8, 9),
(19, 1, 'User', 12, NULL, 10, 11),
(20, NULL, 'Group', 10, NULL, 41, 42),
(21, NULL, 'Group', 11, NULL, 43, 44),
(22, NULL, 'Group', 12, NULL, 45, 46),
(23, NULL, 'Group', 13, NULL, 47, 48),
(24, NULL, 'Group', 14, NULL, 49, 50),
(25, NULL, 'Group', 15, NULL, 51, 52),
(26, NULL, 'Group', 16, NULL, 53, 54),
(27, NULL, 'Group', 17, NULL, 55, 56),
(28, NULL, 'Group', 18, NULL, 57, 58),
(29, NULL, 'Group', 19, NULL, 59, 60),
(30, NULL, 'Group', 20, NULL, 61, 62),
(31, 8, 'User', 13, NULL, 34, 35),
(32, NULL, 'Group', 10, NULL, 63, 64);

-- --------------------------------------------------------

--
-- Table structure for table `aros_acos`
--

CREATE TABLE IF NOT EXISTS `aros_acos` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `aro_id` int(10) NOT NULL,
  `aco_id` int(10) NOT NULL,
  `_create` varchar(2) NOT NULL DEFAULT '0',
  `_read` varchar(2) NOT NULL DEFAULT '0',
  `_update` varchar(2) NOT NULL DEFAULT '0',
  `_delete` varchar(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `ARO_ACO_KEY` (`aro_id`,`aco_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=112 ;

--
-- Dumping data for table `aros_acos`
--

INSERT INTO `aros_acos` (`id`, `aro_id`, `aco_id`, `_create`, `_read`, `_update`, `_delete`) VALUES
(3, 1, 92, '1', '1', '1', '1'),
(5, 10, 185, '1', '1', '1', '1'),
(7, 10, 118, '1', '1', '1', '1'),
(8, 10, 119, '1', '1', '1', '1'),
(9, 10, 130, '1', '1', '1', '1'),
(10, 10, 131, '1', '1', '1', '1'),
(11, 10, 136, '1', '1', '1', '1'),
(12, 10, 152, '1', '1', '1', '1'),
(13, 10, 157, '1', '1', '1', '1'),
(14, 10, 158, '1', '1', '1', '1'),
(15, 10, 153, '1', '1', '1', '1'),
(16, 8, 92, '1', '1', '1', '1'),
(19, 3, 158, '1', '1', '1', '1'),
(21, 3, 152, '1', '1', '1', '1'),
(22, 3, 155, '1', '1', '1', '1'),
(23, 3, 157, '1', '1', '1', '1'),
(24, 3, 249, '1', '1', '1', '1'),
(25, 3, 246, '1', '1', '1', '1'),
(26, 3, 243, '1', '1', '1', '1'),
(27, 3, 250, '1', '1', '1', '1'),
(28, 3, 247, '1', '1', '1', '1'),
(29, 3, 244, '1', '1', '1', '1'),
(30, 3, 248, '1', '1', '1', '1'),
(31, 3, 245, '1', '1', '1', '1'),
(32, 3, 242, '1', '1', '1', '1'),
(33, 3, 141, '1', '1', '1', '1'),
(34, 3, 140, '1', '1', '1', '1'),
(35, 3, 143, '1', '1', '1', '1'),
(36, 3, 144, '1', '1', '1', '1'),
(37, 3, 142, '1', '1', '1', '1'),
(38, 3, 136, '1', '1', '1', '1'),
(39, 3, 131, '1', '1', '1', '1'),
(40, 3, 130, '1', '1', '1', '1'),
(41, 3, 222, '1', '1', '1', '1'),
(42, 3, 219, '1', '1', '1', '1'),
(43, 3, 225, '1', '1', '1', '1'),
(44, 3, 223, '1', '1', '1', '1'),
(45, 3, 220, '1', '1', '1', '1'),
(46, 3, 226, '1', '1', '1', '1'),
(47, 3, 221, '1', '1', '1', '1'),
(48, 3, 218, '1', '1', '1', '1'),
(49, 3, 224, '1', '1', '1', '1'),
(50, 3, 119, '1', '1', '1', '1'),
(51, 3, 118, '1', '1', '1', '1'),
(52, 3, 107, '1', '1', '1', '1'),
(53, 3, 106, '1', '1', '1', '1'),
(54, 3, 109, '1', '1', '1', '1'),
(55, 3, 110, '1', '1', '1', '1'),
(56, 3, 108, '1', '1', '1', '1'),
(57, 3, 185, '1', '1', '1', '1'),
(58, 4, 191, '-1', '-1', '-1', '-1'),
(59, 3, 191, '-1', '-1', '-1', '-1'),
(60, 10, 260, '1', '1', '1', '1'),
(61, 10, 259, '1', '1', '1', '1'),
(62, 10, 258, '1', '1', '1', '1'),
(63, 3, 261, '-1', '-1', '-1', '-1'),
(64, 5, 191, '-1', '-1', '-1', '-1'),
(65, 10, 270, '1', '1', '1', '1'),
(67, 10, 275, '1', '1', '1', '1'),
(68, 10, 277, '1', '1', '1', '1'),
(69, 10, 289, '1', '1', '1', '1'),
(70, 10, 293, '1', '1', '1', '1'),
(71, 10, 291, '1', '1', '1', '1'),
(72, 10, 287, '1', '1', '1', '1'),
(73, 10, 305, '1', '1', '1', '1'),
(74, 10, 304, '1', '1', '1', '1'),
(75, 32, 92, '-1', '-1', '-1', '-1'),
(76, 32, 185, '1', '1', '1', '1'),
(77, 32, 118, '1', '1', '1', '1'),
(78, 32, 119, '1', '1', '1', '1'),
(79, 32, 130, '1', '1', '1', '1'),
(80, 32, 131, '1', '1', '1', '1'),
(81, 32, 270, '1', '1', '1', '1'),
(82, 32, 277, '1', '1', '1', '1'),
(83, 32, 275, '1', '1', '1', '1'),
(84, 32, 287, '1', '1', '1', '1'),
(85, 32, 289, '1', '1', '1', '1'),
(86, 32, 293, '1', '1', '1', '1'),
(87, 32, 291, '1', '1', '1', '1'),
(88, 32, 304, '1', '1', '1', '1'),
(89, 32, 305, '1', '1', '1', '1'),
(90, 32, 142, '1', '1', '1', '1'),
(91, 32, 140, '1', '1', '1', '1'),
(92, 32, 260, '1', '1', '1', '1'),
(93, 32, 259, '1', '1', '1', '1'),
(94, 32, 258, '1', '1', '1', '1'),
(95, 32, 141, '1', '1', '1', '1'),
(96, 32, 242, '1', '1', '1', '1'),
(97, 32, 245, '1', '1', '1', '1'),
(98, 32, 248, '1', '1', '1', '1'),
(99, 32, 244, '1', '1', '1', '1'),
(100, 32, 247, '1', '1', '1', '1'),
(101, 32, 250, '1', '1', '1', '1'),
(102, 32, 243, '1', '1', '1', '1'),
(103, 32, 246, '1', '1', '1', '1'),
(104, 32, 249, '1', '1', '1', '1'),
(105, 32, 152, '1', '1', '1', '1'),
(106, 32, 155, '1', '1', '1', '1'),
(107, 32, 157, '1', '1', '1', '1'),
(108, 32, 158, '1', '1', '1', '1'),
(109, 32, 136, '1', '1', '1', '1'),
(111, 10, 193, '-1', '-1', '-1', '-1');

-- --------------------------------------------------------

--
-- Table structure for table `categorie_faqs`
--

CREATE TABLE IF NOT EXISTS `categorie_faqs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre_categorie` varchar(45) NOT NULL,
  `description_categorie` varchar(100) NOT NULL,
  `actif_cat_faq` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `categorie_faqs`
--

INSERT INTO `categorie_faqs` (`id`, `titre_categorie`, `description_categorie`, `actif_cat_faq`) VALUES
(1, 'Téléphonie', 'Toutes vos questions concernant la téléphonie', 1),
(2, 'VoIP', 'Toutes vos questions concernant la VoIP', 1),
(3, 'test', 'testest', 0);

-- --------------------------------------------------------

--
-- Table structure for table `categorie_tickets`
--

CREATE TABLE IF NOT EXISTS `categorie_tickets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre_categorie` varchar(45) NOT NULL,
  `actif_cat_ticket` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `categorie_tickets`
--

INSERT INTO `categorie_tickets` (`id`, `titre_categorie`, `actif_cat_ticket`) VALUES
(1, 'Téléphonie', 1),
(2, 'Autre', 1);

-- --------------------------------------------------------

--
-- Table structure for table `commentaires`
--

CREATE TABLE IF NOT EXISTS `commentaires` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `text_commentaire` text NOT NULL,
  `created` datetime DEFAULT NULL,
  `actif_commentaire` tinyint(1) NOT NULL DEFAULT '1',
  `ticket_id` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `task_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_commentaires_tickets1_idx` (`ticket_id`),
  KEY `fk_commentaires_users1_idx` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=45 ;

--
-- Dumping data for table `commentaires`
--

INSERT INTO `commentaires` (`id`, `text_commentaire`, `created`, `actif_commentaire`, `ticket_id`, `user_id`, `task_id`) VALUES
(1, 'un test', '2013-05-16 14:16:39', 1, 2, 2, 0),
(3, 'ticket admin tel', '2013-05-16 14:44:40', 1, 4, 2, 0),
(4, 'admin ticket autre', '2013-05-16 14:47:20', 1, 5, 2, 0),
(7, 'sefs', '2013-05-17 10:53:50', 1, 8, 2, 0),
(8, 'tes new add', '2013-05-17 10:54:33', 0, 9, 2, 0),
(9, 'test 2', '2013-05-17 15:54:57', 1, 5, 2, 0),
(10, 'text 3', '2013-05-17 15:55:37', 1, 5, 4, 0),
(11, 'ser', '2013-05-20 09:29:10', 1, 5, 2, 0),
(12, 'ert', '2013-05-20 09:30:13', 1, 5, 2, 0),
(13, 'test commentaire\r\navec un saut ', '2013-05-20 09:48:42', 1, 1, 2, 0),
(14, 'test commentaire<br />\r\navec un saut<br />\r\nv2', '2013-05-20 09:57:26', 1, 1, 2, 0),
(15, 'test verif status', '2013-05-20 14:08:12', 0, 11, 2, 0),
(16, 'fef', '2013-05-20 14:52:37', 1, 12, 2, 0),
(17, 'comms v3', '2013-05-21 16:40:30', 1, 1, 2, 0),
(18, 'comment4', '2013-05-21 17:15:02', 1, 1, 2, 0),
(19, 'comment 5 flag', '2013-05-24 14:59:14', 1, 1, 2, 0),
(20, 'comment 5 flag', '2013-05-24 15:01:11', 1, 1, 2, 0),
(21, 'comment 6 flag', '2013-05-24 15:01:28', 1, 1, 2, 0),
(22, 'rere', '2013-05-24 15:17:32', 1, 5, 2, 0),
(23, 'titre long', '2013-05-24 15:17:59', 1, 12, 2, 0),
(24, 'test', '2013-05-24 15:19:45', 1, 11, 2, 0),
(25, 'comment 7<br />\r\n', '2013-05-24 15:20:33', 1, 1, 2, 0),
(26, 'comment 8', '2013-05-24 15:20:56', 1, 1, 2, 0),
(27, 'apre s. comm', '2013-05-28 11:12:22', 0, 13, 2, 0),
(28, 'reponse', '2013-05-28 11:13:25', 0, 13, 2, 0),
(29, 'testestsestst', '2013-05-29 16:15:32', 1, 11, 2, 0),
(30, 'test ticket', '2013-06-04 10:48:09', 1, 14, 3, 0),
(31, 'ok. ca marche', '2013-06-19 18:03:47', 1, 11, 2, 0),
(32, 'dsfsd', '2013-07-16 14:20:25', 1, 15, 4, 0),
(34, 'comment depuis que task int&egrave;gre les commentaires', '2013-07-16 15:32:09', 1, 1, 12, 0),
(36, 'First commentaire Task', '2013-07-16 15:34:49', 1, 1, 12, 14),
(37, 'Test', '2013-07-16 15:35:35', 1, 1, 12, 0),
(39, 'Allez fonctionne', '2013-07-16 15:42:13', 1, NULL, 12, 14),
(40, 'Allez re-test une derni&egrave;re fois', '2013-07-16 15:43:17', 1, NULL, 12, 14),
(41, 'Allez re-test une derni&egrave;re fois', '2013-07-16 15:43:37', 1, 1, 12, 0),
(42, 'Communication coupé', '2013-08-16 09:49:34', 1, 16, 4, 0),
(43, 'BLABLA', '2013-08-16 10:16:48', 0, 17, 4, 0),
(44, 'Avec l''id de l''user saved', '2013-08-16 10:56:56', 1, 18, 4, 0);

-- --------------------------------------------------------

--
-- Table structure for table `faqs`
--

CREATE TABLE IF NOT EXISTS `faqs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question` varchar(100) NOT NULL,
  `reponse` text NOT NULL,
  `actif_faq` tinyint(1) NOT NULL DEFAULT '1',
  `categorie_faq_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_faqs_categorie_faqs1_idx` (`categorie_faq_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `faqs`
--

INSERT INTO `faqs` (`id`, `question`, `reponse`, `actif_faq`, `categorie_faq_id`) VALUES
(15, 'Qu''est-ce que la téléphonie sur IP ?', '<p><span style="color: #444444; font-family: arial, sans-serif; font-size: small; line-height: 16px;">C''est tout simplement la possibilit&eacute; de passer et de recevoir les appels t&eacute;l&eacute;phoniques via le r&eacute;seau qui sert aux transmissions de donn&eacute;es.</span></p>', 1, 1),
(16, 'Qu''est-ce que la VoIP ?', '<p><span style="color: #333333; font-family: ''Lucida Grande'', ''Trebuchet MS'', Verdana, Helvetica, Arial, sans-serif; font-size: 13px; line-height: 18.1875px; background-color: #fefefe;">La Voip c''est du "t&eacute;l&eacute;phone par le modem".</span></p>', 1, 2),
(18, 'ert', '<p>ert</p>', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type_group` varchar(45) NOT NULL,
  `nom_group` varchar(45) NOT NULL,
  `actif_group` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `type_group`, `nom_group`, `actif_group`) VALUES
(2, 'Administrator', 'Administrator', 1),
(3, 'Association', 'bo', 1),
(4, 'Association', 'CakePhp', 1),
(5, 'Association', 'OVH', 0),
(6, 'Entreprise', 'venus', 1),
(7, 'Particulier', 'Test', 1),
(8, 'Entreprise', 'venus', 1),
(9, 'Entreprise', 'pluton', 1);

-- --------------------------------------------------------

--
-- Table structure for table `group_details`
--

CREATE TABLE IF NOT EXISTS `group_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(45) NOT NULL,
  `valeur` varchar(100) NOT NULL,
  `key` varchar(100) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `actif_group_detail` tinyint(1) NOT NULL DEFAULT '1',
  `group_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_group_details_groups1_idx` (`group_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=52 ;

--
-- Dumping data for table `group_details`
--

INSERT INTO `group_details` (`id`, `type`, `valeur`, `key`, `created`, `actif_group_detail`, `group_id`) VALUES
(1, 'Rue', '25 chemin du bois', 'fa365fe85f417764219cb434a7870423', '2013-04-29 11:16:54', 1, 8),
(2, 'NPA', '74000', 'fa365fe85f417764219cb434a7870423', '2013-04-29 11:16:54', 1, 8),
(3, 'Ville', 'Annecy', 'fa365fe85f417764219cb434a7870423', '2013-04-29 11:16:54', 1, 8),
(4, 'Pays', 'France', 'fa365fe85f417764219cb434a7870423', '2013-04-29 11:16:54', 1, 8),
(9, 'Email', 'yt4h@jtg.fr', '', '2013-04-29 14:36:54', 1, 8),
(11, 'Email', 'abc@fr.fr', '', '2013-04-29 14:39:59', 0, 8),
(12, 'Rue', '7 rue de la paix', 'e55840884dac3635e9caa6d58d84571d', '2013-04-29 14:41:02', 1, 8),
(13, 'NPA', '74000', 'e55840884dac3635e9caa6d58d84571d', '2013-04-29 14:41:02', 1, 8),
(14, 'Ville', 'Evian', 'e55840884dac3635e9caa6d58d84571d', '2013-04-29 14:41:02', 1, 8),
(15, 'Pays', 'France', 'e55840884dac3635e9caa6d58d84571d', '2013-04-29 14:41:02', 1, 8),
(16, 'NumeroFixe', '0450203040', '', '2013-04-30 09:58:22', 1, 8),
(17, 'NumeroMobile', '0610252414', '', '2013-04-30 09:58:52', 1, 8),
(18, 'NumeroFax', '0101010101', '', '2013-04-30 09:59:18', 0, 8),
(19, 'NumeroFixe', '0450468750', '', '2013-04-30 09:59:29', 0, 8),
(20, 'Email', 'bobo@jlh.hyu', '', '2013-04-30 10:55:19', 0, 6),
(21, 'NumeroMobile', '04504587', '', '2013-04-30 14:53:03', 0, 6),
(22, 'Rue', 'bob', '1211aa09be4c37763616b9229a7a4611', '2013-05-02 10:10:22', 0, 8),
(23, 'NPA', 'bob', '1211aa09be4c37763616b9229a7a4611', '2013-05-02 10:10:22', 0, 8),
(24, 'Ville', 'bobo', '1211aa09be4c37763616b9229a7a4611', '2013-05-02 10:10:22', 0, 8),
(25, 'Pays', 'bobob', '1211aa09be4c37763616b9229a7a4611', '2013-05-02 10:10:22', 0, 8),
(26, 'Email', 'admin@admin.fr', '', '2013-05-02 14:41:11', 1, 2),
(27, 'Email', 'tedrgst@ges.rr', '', '2013-05-02 14:53:57', 1, 2),
(28, 'Email', 'uy@ihug.fyg', '', '2013-05-02 14:56:56', 0, 2),
(29, 'Email', 'srg@fgu.gt', '', '2013-05-02 14:57:19', 0, 2),
(30, 'NumeroFixe', '0450845488', '', '2013-05-02 15:31:41', 1, 2),
(31, 'NumeroFax', '573434533698', '', '2013-05-02 15:31:58', 0, 2),
(32, 'Rue', '15 rue d''albigny', '50dab187cdd37dd26803ed1f099f19d8', '2013-05-02 15:42:19', 1, 2),
(33, 'NPA', '74000', '50dab187cdd37dd26803ed1f099f19d8', '2013-05-02 15:42:19', 1, 2),
(34, 'Ville', 'Annecy', '50dab187cdd37dd26803ed1f099f19d8', '2013-05-02 15:42:19', 1, 2),
(35, 'Pays', 'France', '50dab187cdd37dd26803ed1f099f19d8', '2013-05-02 15:42:19', 1, 2),
(36, 'Rue', 't', 'ad2d9bdd08a1d2fda1d95858078f0776', '2013-05-02 15:42:44', 0, 2),
(37, 'NPA', 't', 'ad2d9bdd08a1d2fda1d95858078f0776', '2013-05-02 15:42:44', 0, 2),
(38, 'Ville', 't', 'ad2d9bdd08a1d2fda1d95858078f0776', '2013-05-02 15:42:44', 0, 2),
(39, 'Pays', 't', 'ad2d9bdd08a1d2fda1d95858078f0776', '2013-05-02 15:42:44', 0, 2),
(40, 'Rue', '15 rue de la jeunesse', '833c4fc4db361397c8ff97cef109b54e', '2013-05-03 17:20:43', 0, 7),
(41, 'NPA', '38000', '833c4fc4db361397c8ff97cef109b54e', '2013-05-03 17:20:43', 0, 7),
(42, 'Ville', 'Grenoble', '833c4fc4db361397c8ff97cef109b54e', '2013-05-03 17:20:43', 0, 7),
(43, 'Pays', 'France', '833c4fc4db361397c8ff97cef109b54e', '2013-05-03 17:20:43', 0, 7),
(44, 'Email', 'dfrg@fj', '', '2013-05-16 16:00:48', 0, 2),
(45, 'Rue', 'test', 'a9e831b9965b643957cac8af7510be58', '2013-05-31 17:05:30', 1, 2),
(46, 'NPA', 'test', 'a9e831b9965b643957cac8af7510be58', '2013-05-31 17:05:30', 1, 2),
(47, 'Ville', 'sr', 'a9e831b9965b643957cac8af7510be58', '2013-05-31 17:05:30', 1, 2),
(48, 'Pays', 'test', 'a9e831b9965b643957cac8af7510be58', '2013-05-31 17:05:30', 1, 2),
(49, 'NumeroFixe', '34343141414134314134', '', '2013-06-04 14:57:43', 0, 2),
(50, 'Email', 'etrg@rtg', '', '2013-06-04 15:28:43', 0, 8),
(51, 'NumeroFixe', 'rtqrtqzrtzert', '', '2013-06-05 17:16:55', 0, 6);

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE IF NOT EXISTS `invoices` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `name_file` varchar(150) NOT NULL,
  `link` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `period_begin` date NOT NULL,
  `period_end` date NOT NULL,
  `created` datetime NOT NULL,
  `active_invoice` tinyint(1) NOT NULL,
  `group_id` int(11) NOT NULL,
  `invoice_type_id` int(11) NOT NULL,
  `invoice_statut_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=41 ;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`id`, `name`, `name_file`, `link`, `description`, `period_begin`, `period_end`, `created`, `active_invoice`, `group_id`, `invoice_type_id`, `invoice_statut_id`) VALUES
(27, 'BoardingPass.pdf', 'facture_3_1372858574.pdf', '/home/visionweb/PhpstormProjects/manager/Source/data/3-Test/Invoices/facture_3_1372858574.pdf', 'test', '2013-07-03', '2013-07-03', '2013-07-03 15:36:14', 1, 3, 2, 1),
(28, 'free.pdf', 'invoice_2_1372922793.pdf', '/home/visionweb/PhpstormProjects/manager/Source/data/2-Administrateur/Invoices/invoice_2_1372922793.pdf', '', '2013-07-04', '2013-07-04', '2013-07-04 09:26:33', 1, 2, 3, 2),
(29, 'free.pdf', 'invoice_2_1372922848.pdf', '/home/visionweb/PhpstormProjects/manager/Source/data/2-Administrateur/Invoices/invoice_2_1372922848.pdf', '', '2013-07-04', '2013-07-04', '2013-07-04 09:27:28', 1, 2, 1, 2),
(30, 'free.pdf', 'invoice_7_1372923026.pdf', '/home/visionweb/PhpstormProjects/manager/Source/data/7-bo/Invoices/invoice_7_1372923026.pdf', '', '2013-07-04', '2013-07-04', '2013-07-04 09:30:26', 1, 7, 2, 2),
(31, 'free.pdf', 'invoice_2_1372923240.pdf', '/home/visionweb/PhpstormProjects/manager/Source/data/2-Administrateur/Invoices/invoice_2_1372923240.pdf', '', '2013-07-04', '2013-07-04', '2013-07-04 09:34:00', 1, 2, 3, 4),
(32, 'free.pdf', 'invoice_2_1372923292.pdf', '/home/visionweb/PhpstormProjects/manager/Source/data/2-Administrateur/Invoices/invoice_2_1372923292.pdf', '', '2013-07-04', '2013-07-04', '2013-07-04 09:34:52', 1, 2, 3, 2),
(33, 'free.pdf', 'invoice_7_1372923351.pdf', '/home/visionweb/PhpstormProjects/manager/Source/data/7-bo/Invoices/invoice_7_1372923351.pdf', '', '2013-07-04', '2013-07-04', '2013-07-04 09:35:51', 1, 7, 5, 4),
(34, 'free.pdf', 'invoice_2_1372923485.pdf', '/home/visionweb/PhpstormProjects/manager/Source/data/2-Administrateur/Invoices/invoice_2_1372923485.pdf', '', '2013-07-04', '2013-07-04', '2013-07-04 09:38:05', 1, 2, 2, 2),
(35, 'free.pdf', 'invoice_2_1372923594.pdf', '/home/visionweb/PhpstormProjects/manager/Source/data/2-Administrateur/Invoices/invoice_2_1372923594.pdf', '', '2013-07-04', '2013-07-04', '2013-07-04 09:39:54', 1, 2, 3, 2),
(36, 'free.pdf', 'invoice_2_1372923878.pdf', '/home/visionweb/PhpstormProjects/manager/Source/data/2-Administrateur/Invoices/invoice_2_1372923878.pdf', '', '2013-07-04', '2013-07-04', '2013-07-04 09:44:38', 1, 2, 2, 2),
(37, 'free.pdf', 'invoice_2_1373295925.pdf', '/home/visionweb/PhpstormProjects/manager/Source/data/2-Administrateur/Invoices/invoice_2_1373295925.pdf', 'Description', '2013-07-08', '2013-07-08', '2013-07-08 17:05:25', 1, 2, 2, 2),
(38, 'free.pdf', 'invoice_2_1373296004.pdf', '/home/visionweb/PhpstormProjects/manager/Source/data/2-Administrateur/Invoices/invoice_2_1373296004.pdf', 'Description', '2013-07-08', '2013-07-08', '2013-07-08 17:06:44', 1, 2, 3, 4),
(39, 'free.pdf', 'invoice_7_1373377573.pdf', '/home/visionweb/PhpstormProjects/manager/Source/data/7-bo/Invoices/invoice_7_1373377573.pdf', '', '2013-07-09', '2013-07-09', '2013-07-09 15:46:13', 1, 7, 2, 2),
(40, 'free.pdf', 'invoice_7_1373377597.pdf', '/home/visionweb/PhpstormProjects/manager/Source/data/7-bo/Invoices/invoice_7_1373377597.pdf', '', '2013-07-09', '2013-07-09', '2013-07-09 15:46:37', 1, 7, 2, 4);

-- --------------------------------------------------------

--
-- Table structure for table `invoice_statuts`
--

CREATE TABLE IF NOT EXISTS `invoice_statuts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `label` varchar(150) NOT NULL,
  `active_invoice_statut` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `invoice_statuts`
--

INSERT INTO `invoice_statuts` (`id`, `label`, `active_invoice_statut`) VALUES
(1, 'Acquittée', 1),
(2, 'Ouverte', 1),
(4, 'Retard', 1);

-- --------------------------------------------------------

--
-- Table structure for table `invoice_types`
--

CREATE TABLE IF NOT EXISTS `invoice_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `label` varchar(150) NOT NULL,
  `active_invoice_type` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `invoice_types`
--

INSERT INTO `invoice_types` (`id`, `label`, `active_invoice_type`) VALUES
(1, 'VOIP', 1),
(2, 'ADSL', 1),
(3, 'Hébergement', 1),
(4, 'Infogérance', 0),
(5, 'Nouveau_Type', 1);

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

CREATE TABLE IF NOT EXISTS `modules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `activ` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`id`, `name`, `activ`) VALUES
(1, 'Voip', 1);

-- --------------------------------------------------------

--
-- Table structure for table `numbers`
--

CREATE TABLE IF NOT EXISTS `numbers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `prefix` int(11) NOT NULL,
  `phone_number` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=116 ;

--
-- Dumping data for table `numbers`
--

INSERT INTO `numbers` (`id`, `prefix`, `phone_number`, `owner`) VALUES
(108, 33, '1111111111', 'admin'),
(109, 33, '1111111112', 'test'),
(110, 33, '1111111113', 'admin'),
(111, 33, '1111111114', 'admin'),
(112, 33, '1111111115', ''),
(113, 33, '1111111116', ''),
(114, 33, '1111111117', ''),
(115, 33, '1111111118', '');

-- --------------------------------------------------------

--
-- Table structure for table `passwords`
--

CREATE TABLE IF NOT EXISTS `passwords` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(150) NOT NULL,
  `password` varchar(150) NOT NULL,
  `created` datetime NOT NULL,
  `active_password` tinyint(1) NOT NULL,
  `password_service_id` int(11) NOT NULL,
  `password_type_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `passwords`
--

INSERT INTO `passwords` (`id`, `login`, `password`, `created`, `active_password`, `password_service_id`, `password_type_id`, `group_id`) VALUES
(1, 'test', 'test', '0000-00-00 00:00:00', 0, 1, 1, 2),
(2, 'test2', 'test2', '0000-00-00 00:00:00', 0, 1, 1, 2),
(3, '', '', '2013-07-05 12:21:57', 0, 0, 0, 0),
(6, 'gege', 'tutu', '2013-07-05 13:42:36', 0, 1, 1, 3),
(8, 'gege', 'toto', '2013-07-05 17:22:08', 0, 0, 0, 0),
(9, 'gege', 'toto', '2013-07-05 17:27:08', 0, 0, 0, 0),
(10, 'gege', 'toto', '2013-07-05 17:27:15', 0, 0, 0, 0),
(11, 'gege', 'toto', '2013-07-05 17:28:12', 0, 0, 0, 0),
(12, 'mon_pseudo', 'mdp', '2013-07-08 17:01:52', 1, 1, 1, 2),
(13, 'login', 'mdp2', '2013-07-08 17:07:53', 0, 1, 1, 2),
(14, 'gege', 'gege', '2013-07-15 12:34:08', 0, 1, 1, 3),
(15, 'gege', 'gege', '2013-07-15 13:54:52', 1, 1, 1, 3),
(16, 'gege', 'gege', '2013-08-18 18:29:52', 0, 1, 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `password_services`
--

CREATE TABLE IF NOT EXISTS `password_services` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `label` varchar(150) NOT NULL,
  `active_password_service` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `password_services`
--

INSERT INTO `password_services` (`id`, `label`, `active_password_service`) VALUES
(1, 'serveur', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_types`
--

CREATE TABLE IF NOT EXISTS `password_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `label` varchar(150) NOT NULL,
  `active_password_type` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `password_types`
--

INSERT INTO `password_types` (`id`, `label`, `active_password_type`) VALUES
(1, 'mysql', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE IF NOT EXISTS `tasks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` text NOT NULL,
  `subject` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `last_update` datetime NOT NULL,
  `task_project_id` int(11) NOT NULL,
  `task_type_id` int(11) NOT NULL,
  `task_statut_id` int(11) NOT NULL,
  `active_task` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `description`, `subject`, `created`, `last_update`, `task_project_id`, `task_type_id`, `task_statut_id`, `active_task`) VALUES
(1, 'Edition de la description de cette tâche', 'Résumé de la tâche', '2013-07-10 14:00:00', '0000-00-00 00:00:00', 1, 1, 2, 1),
(2, 'C''est le premier projet enregistré depuis l''application.', '1er Projet', '2013-07-10 17:43:49', '0000-00-00 00:00:00', 1, 1, 2, 1),
(3, '', 'ngg', '2013-07-10 17:46:05', '0000-00-00 00:00:00', 1, 1, 2, 0),
(4, 'C''est le deuxième projet enregistré.', '2eme Projet', '2013-07-10 17:57:43', '0000-00-00 00:00:00', 1, 1, 2, 1),
(5, 'C''est le troisième projet enregistré', '3eme Projet', '2013-07-10 18:00:00', '0000-00-00 00:00:00', 1, 1, 2, 1),
(6, 'Test Description', 'Test', '2013-07-10 18:02:50', '0000-00-00 00:00:00', 1, 1, 2, 1),
(7, 'Encore un test, ça fait beaucoup de test comme même', 'Test Again', '2013-07-11 09:17:09', '0000-00-00 00:00:00', 1, 1, 2, 1),
(8, 'azerty', 'azerty', '2013-07-11 09:40:45', '0000-00-00 00:00:00', 1, 1, 2, 1),
(9, 'description', 'summary 2', '2013-07-11 09:45:35', '0000-00-00 00:00:00', 1, 1, 2, 1),
(10, 'Re description', 'Test', '2013-07-11 10:22:01', '2013-07-11 10:22:01', 1, 1, 2, 1),
(11, 'C''est la 1er tâche VoIP, avec le type Maintenance et aucune valeur de test.\r\nA part la description qui est bidon évidemment', '1er tâche VoIP', '2013-07-11 17:51:23', '2013-07-11 17:51:23', 2, 2, 3, 1),
(12, 'lalalala', 'First ADSL', '2013-07-12 17:12:03', '2013-07-12 17:12:03', 3, 2, 2, 1),
(13, 'lolololo', 'Second ADSL', '2013-07-12 17:12:40', '2013-07-12 17:12:40', 3, 3, 1, 1),
(14, 'lululululu', 'Third ADSL', '2013-07-12 17:13:05', '2013-07-12 17:13:05', 3, 2, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `task_projects`
--

CREATE TABLE IF NOT EXISTS `task_projects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `label` varchar(100) NOT NULL,
  `active_task_project` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `task_projects`
--

INSERT INTO `task_projects` (`id`, `label`, `active_task_project`) VALUES
(1, 'Nom Projet', 1),
(2, 'VoIP', 1),
(3, 'ADSL', 1);

-- --------------------------------------------------------

--
-- Table structure for table `task_statuts`
--

CREATE TABLE IF NOT EXISTS `task_statuts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `label` varchar(100) NOT NULL,
  `active_task_statut` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `task_statuts`
--

INSERT INTO `task_statuts` (`id`, `label`, `active_task_statut`) VALUES
(1, 'Nom Statut', 1),
(2, 'En cours', 1),
(3, 'Fini', 1);

-- --------------------------------------------------------

--
-- Table structure for table `task_types`
--

CREATE TABLE IF NOT EXISTS `task_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `label` varchar(100) NOT NULL,
  `active_task_type` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `task_types`
--

INSERT INTO `task_types` (`id`, `label`, `active_task_type`) VALUES
(1, 'Nom Type', 1),
(2, 'Maintenance', 1),
(3, 'Test', 1),
(4, 'Re Test', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE IF NOT EXISTS `tickets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(70) NOT NULL,
  `flag` varchar(15) NOT NULL,
  `status` varchar(6) NOT NULL,
  `created` datetime NOT NULL,
  `actif_ticket` tinyint(1) NOT NULL DEFAULT '1',
  `categorie_ticket_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_tickets_categorie_tickets1_idx` (`categorie_ticket_id`),
  KEY `fk_tickets_groups1_idx` (`group_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `tickets`
--

INSERT INTO `tickets` (`id`, `titre`, `flag`, `status`, `created`, `actif_ticket`, `categorie_ticket_id`, `group_id`, `user_id`) VALUES
(1, 'a', 'admin_answer', 'opened', '0000-00-00 00:00:00', 1, 2, 2, 2),
(2, 'testest', 'admin_read', 'opened', '0000-00-00 00:00:00', 1, 2, 2, 2),
(4, 'ticket admin tel', 'admin_read', 'opened', '0000-00-00 00:00:00', 1, 1, 2, 2),
(5, 'ticket admin autree', 'user_read', 'opened', '0000-00-00 00:00:00', 1, 2, 2, 2),
(8, 'esf', 'admin_read', 'closed', '0000-00-00 00:00:00', 1, 2, 2, 2),
(9, 'new add ', 'user_answer', 'closed', '0000-00-00 00:00:00', 1, 1, 2, 2),
(11, 'test', 'user_read', 'opened', '0000-00-00 00:00:00', 1, 2, 2, 2),
(12, 'créer un ticket avec un titre long pour faire un exemple', 'user_read', 'opened', '0000-00-00 00:00:00', 1, 2, 2, 2),
(13, 'test sans commm', 'admin_answer', 'closed', '0000-00-00 00:00:00', 0, 1, 2, 2),
(14, 'ticket admin1', 'user_answer', 'closed', '0000-00-00 00:00:00', 1, 2, 2, 2),
(15, 'sfgs', 'admin_read', 'opened', '0000-00-00 00:00:00', 1, 2, 3, 2),
(16, 'Problème VoIP', 'admin_read', 'opened', '2013-08-16 09:49:34', 1, 1, 3, 2),
(17, 'BLABLA', 'admin_read', 'closed', '2013-08-16 10:16:48', 0, 2, 3, 0),
(18, 'New Ticket', 'user_answer', 'opened', '2013-08-16 10:56:56', 1, 2, 3, 4);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `civilite` varchar(20) NOT NULL,
  `nom_user` varchar(45) NOT NULL,
  `prenom` varchar(45) NOT NULL,
  `username` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `actif_user` tinyint(1) NOT NULL DEFAULT '1',
  `group_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_users_groups1_idx` (`group_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `civilite`, `nom_user`, `prenom`, `username`, `password`, `actif_user`, `group_id`) VALUES
(1, 'root', 'root', 'root', 'root', '312d8342d46992766b13ac33cf3c74e0d2d8f87b', 1, 2),
(2, 'Monsieur', 'ADMIN', 'Admin', 'admin', '312d8342d46992766b13ac33cf3c74e0d2d8f87b', 1, 2),
(3, 'Monsieur', 'Admin1', 'Admin1', 'admin1', '312d8342d46992766b13ac33cf3c74e0d2d8f87b', 1, 2),
(4, 'Monsieur', 'TEST', 'test', 'test', 'ea4bbbe3a4eb9cf92868a36ca25e57d84f4edb5a', 1, 3),
(5, 'Monsieur', 'tte', 'teest', 'c', '9b739ec4e41b4a3323925c207d5bde0809408709', 0, 5),
(6, 'Mademoiselle', 'm', 'm', 'm', '7fbad67f5bfb24fca9b76a706bd0058d256ec5c6', 0, 5),
(7, 'Monsieur', 'Babou', 'babou', 'babou', '53bc05bd019eec2d2af99326421069a7ebac1665', 1, 7),
(8, 'Monsieur', 'jht', 'ruyj', 'azerty', '14f9c01c07060c37c7b41f368c8bd6cc4641e370', 0, 7),
(9, 'Monsieur', 'r', 'dry', 'totototo', '7a953dbaf66ebc9a0827797eb4845f9b3df37aa7', 0, 2),
(10, 'Monsieur', 'r', 'dry', 'tatatata', 'acac338d555b0013a31dbbc2d52fe6d9ad974ed1', 0, 2),
(11, 'Monsieur', 'r', 'dry', 'titititi', 'c058554194fb5a5d346a44ad76399f47c8f51146', 0, 2),
(12, 'Monsieur', 'Jr', 'Jr', 'Chiffe', '5ee78b7948d8fbb1646731133ced20e85bd94b87', 1, 2),
(13, 'Monsieur', 'Mon nom', 'Mon prénom', 'rayane', 'bf6fbd2fa01ac019dd0214cd8c1b213905315b1c', 1, 7);

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE IF NOT EXISTS `user_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(45) NOT NULL,
  `valeur` varchar(100) NOT NULL,
  `key` varchar(100) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `actif_user_detail` tinyint(1) NOT NULL DEFAULT '1',
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_user_details_users1_idx` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=36 ;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`id`, `type`, `valeur`, `key`, `created`, `actif_user_detail`, `user_id`) VALUES
(1, 'Email', 'gh@y.gt', '', '2013-05-07 09:11:45', 0, 7),
(2, 'Email', 'ete@ske.fr', '', '2013-05-07 09:29:18', 0, 7),
(3, 'Email', 'babou@sfr.fr', '', '2013-05-07 09:39:38', 1, 7),
(4, 'Email', '1245', '', '2013-05-07 09:39:57', 0, 7),
(5, 'Email', '528', '', '2013-05-07 09:47:04', 0, 7),
(6, 'NumeroFixe', '0450121244', '', '2013-05-07 10:37:27', 1, 7),
(7, 'NumeroFax', '538725', '', '2013-05-07 11:02:02', 0, 7),
(8, 'NumeroFixe', '4354', '', '2013-05-07 11:04:19', 0, 7),
(9, 'NumeroFixe', 'e', '', '2013-05-07 11:04:53', 0, 7),
(10, 'NumeroFixe', 'rt', '', '2013-05-07 11:07:11', 0, 7),
(11, 'NumeroFixe', '1234536531', '', '2013-05-07 11:23:00', 0, 7),
(14, 'Rue', '15 rue de la paix', '079f7c8b48dc746e9ebb8cf68b6c615f', '2013-05-07 16:41:07', 1, 7),
(15, 'NPA', '85350', '079f7c8b48dc746e9ebb8cf68b6c615f', '2013-05-07 16:41:07', 1, 7),
(16, 'Ville', 'Saint Etienne', '079f7c8b48dc746e9ebb8cf68b6c615f', '2013-05-07 16:41:07', 1, 7),
(17, 'Pays', 'France', '079f7c8b48dc746e9ebb8cf68b6c615f', '2013-05-07 16:41:07', 1, 7),
(18, 'Rue', '20 rue mongolfier', '99a73053a1818e7104c1c736cd10565b', '2013-05-07 16:41:31', 1, 7),
(19, 'NPA', '45200', '99a73053a1818e7104c1c736cd10565b', '2013-05-07 16:41:31', 1, 7),
(20, 'Ville', 'Lille', '99a73053a1818e7104c1c736cd10565b', '2013-05-07 16:41:31', 1, 7),
(21, 'Pays', 'France', '99a73053a1818e7104c1c736cd10565b', '2013-05-07 16:41:31', 1, 7),
(22, 'Rue', 'gyj', '3f972fb0ce80ee31cb3b81eb189a863a', '2013-05-10 09:09:45', 0, 7),
(26, 'Rue', '81 place de Perrignier', 'fd75549e3792b6eb44ccf12da8415f07', '2013-05-10 10:05:13', 1, 2),
(27, 'NPA', '74550', 'fd75549e3792b6eb44ccf12da8415f07', '2013-05-10 10:05:13', 1, 2),
(28, 'Ville', 'Perrignier', 'fd75549e3792b6eb44ccf12da8415f07', '2013-05-10 10:05:13', 1, 2),
(29, 'Pays', 'France', 'fd75549e3792b6eb44ccf12da8415f07', '2013-05-10 10:05:13', 1, 2),
(33, 'Pays', 'France', 'be91821ac2c769990486fd09c729d808', '2013-05-10 10:05:42', 0, 2),
(34, 'Email', 'ku@drg.fr', '', '2013-05-10 10:19:30', 0, 2),
(35, 'Email', 'sduret@visionweb-online.fr', '', '2013-05-10 10:19:45', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `voips`
--

CREATE TABLE IF NOT EXISTS `voips` (
  `id` int(11) NOT NULL,
  `login` varchar(30) NOT NULL,
  `pass` varchar(30) NOT NULL,
  `ip` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `voips`
--

INSERT INTO `voips` (`id`, `login`, `pass`, `ip`) VALUES
(1, 'managero', 'UBIBOzULRSuh', '178.33.172.71');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `commentaires`
--
ALTER TABLE `commentaires`
  ADD CONSTRAINT `fk_commentaires_tickets1` FOREIGN KEY (`ticket_id`) REFERENCES `tickets` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_commentaires_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `faqs`
--
ALTER TABLE `faqs`
  ADD CONSTRAINT `fk_faqs_categorie_faqs1` FOREIGN KEY (`categorie_faq_id`) REFERENCES `categorie_faqs` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `group_details`
--
ALTER TABLE `group_details`
  ADD CONSTRAINT `fk_group_details_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tickets`
--
ALTER TABLE `tickets`
  ADD CONSTRAINT `fk_tickets_categorie_tickets1` FOREIGN KEY (`categorie_ticket_id`) REFERENCES `categorie_tickets` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tickets_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_users_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `user_details`
--
ALTER TABLE `user_details`
  ADD CONSTRAINT `fk_user_details_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
