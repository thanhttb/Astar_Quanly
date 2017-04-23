-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Dim 16 Avril 2017 à 14:31
-- Version du serveur :  10.1.10-MariaDB
-- Version de PHP :  5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `astar_quanly`
--

-- --------------------------------------------------------

--
-- Structure de la table `accounts`
--

CREATE TABLE `accounts` (
  `id` int(11) NOT NULL,
  `name` varchar(70) NOT NULL,
  `dob` date NOT NULL,
  `type` tinyint(4) NOT NULL,
  `balance` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `accounts`
--

INSERT INTO `accounts` (`id`, `name`, `dob`, `type`, `balance`) VALUES
(2, 'TC9.1', '2017-04-13', 3, 0),
(3, 'TC8.1', '2017-04-13', 3, 0),
(4, 'Nguyễn Đắc Thắng', '2017-04-13', 4, 0),
(5, 'Nguyễn Quyết Thắng', '2017-04-13', 4, 0),
(6, 'test2 Test1', '2017-04-11', 1, 1100000),
(7, 'asd', '2017-04-11', 2, -145000),
(8, 'CASH', '2017-04-11', 5, -955000),
(9, 'VCB', '2017-04-11', 5, 0),
(10, 'TCB', '2017-04-13', 5, 0),
(11, 'VOUCHER', '2017-04-13', 5, 0);

-- --------------------------------------------------------

--
-- Structure de la table `attendances`
--

CREATE TABLE `attendances` (
  `id` int(11) NOT NULL,
  `class_std_id` int(11) NOT NULL,
  `lesson_id` int(11) NOT NULL,
  `status` enum('x','p','kp') DEFAULT NULL,
  `note` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `classes`
--

CREATE TABLE `classes` (
  `id` int(11) NOT NULL,
  `acc_id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `class` tinyint(3) DEFAULT NULL,
  `teacher` varchar(60) NOT NULL,
  `day` set('0','1','2','3','4','5','6') DEFAULT NULL,
  `startTime` time DEFAULT NULL,
  `endTime` time DEFAULT NULL,
  `students` tinyint(4) DEFAULT NULL,
  `cs_id` tinyint(4) DEFAULT NULL,
  `tuition` int(11) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `classes`
--

INSERT INTO `classes` (`id`, `acc_id`, `name`, `class`, `teacher`, `day`, `startTime`, `endTime`, `students`, `cs_id`, `tuition`, `status`) VALUES
(1, 2, 'TC9.1', 9, 'NGuyễn Quyết Thắng', '3', '18:00:00', '21:00:00', 1, NULL, 15000, 1),
(2, 3, 'TC8.1', 8, 'Nguyễn Đắc Thắng', '3', '21:00:00', '19:00:00', 0, NULL, 150000, 1);

-- --------------------------------------------------------

--
-- Structure de la table `class_std`
--

CREATE TABLE `class_std` (
  `id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `firstDay` datetime NOT NULL,
  `lastDay` datetime DEFAULT NULL,
  `note` varchar(111) DEFAULT NULL,
  `discount` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `class_std`
--

INSERT INTO `class_std` (`id`, `class_id`, `student_id`, `firstDay`, `lastDay`, `note`, `discount`) VALUES
(1, 1, 1, '2017-04-22 15:35:00', NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Structure de la table `discount`
--

CREATE TABLE `discount` (
  `id` int(11) NOT NULL,
  `from` int(11) NOT NULL,
  `to` int(11) NOT NULL,
  `discount` int(11) NOT NULL,
  `start` date NOT NULL,
  `expired` date DEFAULT NULL,
  `type` enum('discount','voucher') NOT NULL,
  `user` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `enrolls`
--

CREATE TABLE `enrolls` (
  `id` int(10) UNSIGNED NOT NULL,
  `student_id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `receiver` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `class` smallint(6) NOT NULL,
  `appointment` datetime DEFAULT NULL,
  `showUp` tinyint(1) NOT NULL,
  `testInform` tinyint(1) NOT NULL,
  `teacher` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `receiveTime` date DEFAULT NULL,
  `result` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `resultInform` tinyint(1) NOT NULL,
  `decision` enum('Xếp lớp','Chờ mở lớp','Cân nhắc thêm') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `officalClass` int(11) DEFAULT NULL,
  `firstDay` datetime DEFAULT NULL,
  `inform` tinyint(1) NOT NULL,
  `firstday_showup` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `enrolls`
--

INSERT INTO `enrolls` (`id`, `student_id`, `parent_id`, `receiver`, `subject`, `class`, `appointment`, `showUp`, `testInform`, `teacher`, `receiveTime`, `result`, `resultInform`, `decision`, `officalClass`, `firstDay`, `inform`, `firstday_showup`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Trần Trịnh Bình Thành', 'Taf', 2, NULL, 1, 1, '0', NULL, '', 1, 'Xếp lớp', 2, '2017-04-22 15:35:00', 1, 1, '2017-04-11 20:47:44', '2017-04-12 21:08:41'),
(2, 2, 2, 'Trần Trịnh Bình Thành', 'asdf', 1232, NULL, 0, 0, '0', NULL, '', 0, NULL, NULL, NULL, 0, 0, '2017-04-11 20:49:42', NULL),
(3, 0, 3, 'Trần Trịnh Bình Thành', 'tt', 2, '2017-04-25 00:00:00', 0, 0, '0', NULL, '', 0, NULL, NULL, NULL, 0, 0, '2017-04-12 11:26:19', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `lessons`
--

CREATE TABLE `lessons` (
  `id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `start_time` datetime NOT NULL,
  `end_time` datetime NOT NULL,
  `tuition` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `lessons`
--

INSERT INTO `lessons` (`id`, `class_id`, `teacher_id`, `start_time`, `end_time`, `tuition`) VALUES
(1, 1, 2, '2017-03-04 10:15:00', '2017-03-04 12:15:00', 150000),
(2, 1, 2, '2017-03-11 10:15:00', '2017-03-11 12:15:00', 150000),
(3, 1, 2, '2017-03-18 10:15:00', '2017-03-18 12:15:00', 150000);

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `note`
--

CREATE TABLE `note` (
  `id` int(10) UNSIGNED NOT NULL,
  `user` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `table` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `record_id` int(11) NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `parents`
--

CREATE TABLE `parents` (
  `id` int(10) UNSIGNED NOT NULL,
  `acc_id` int(11) DEFAULT NULL,
  `name` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(13) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `work` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `parents`
--

INSERT INTO `parents` (`id`, `acc_id`, `name`, `phone`, `email`, `work`, `address`) VALUES
(1, 7, 'sdf', '123123', '', '', '');

-- --------------------------------------------------------

--
-- Structure de la table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `payment`
--

CREATE TABLE `payment` (
  `id` int(11) NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `name` varchar(90) NOT NULL,
  `description` text NOT NULL,
  `amount` int(11) NOT NULL,
  `date` date NOT NULL,
  `user` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `receipt`
--

CREATE TABLE `receipt` (
  `id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `receipt`
--

INSERT INTO `receipt` (`id`, `created_at`, `updated_at`) VALUES
(3000, '2017-04-16 05:08:43', '0000-00-00 00:00:00'),
(3001, '2017-04-15 22:09:18', '2017-04-15 22:09:18'),
(3002, '2017-04-15 22:10:21', '2017-04-15 22:10:21'),
(3003, '2017-04-15 22:11:04', '2017-04-15 22:11:04'),
(3004, '2017-04-15 22:14:51', '2017-04-15 22:14:51'),
(3005, '2017-04-15 22:15:57', '2017-04-15 22:15:57'),
(3006, '2017-04-15 22:16:39', '2017-04-15 22:16:39'),
(3007, '2017-04-15 22:19:20', '2017-04-15 22:19:20'),
(3008, '2017-04-15 22:20:49', '2017-04-15 22:20:49'),
(3009, '2017-04-15 22:29:31', '2017-04-15 22:29:31'),
(3010, '2017-04-15 22:29:53', '2017-04-15 22:29:53'),
(3011, '2017-04-15 22:31:15', '2017-04-15 22:31:15'),
(3012, '2017-04-15 22:36:32', '2017-04-15 22:36:32'),
(3013, '2017-04-15 22:36:46', '2017-04-15 22:36:46'),
(3014, '2017-04-15 22:36:56', '2017-04-15 22:36:56'),
(3015, '2017-04-15 22:38:55', '2017-04-15 22:38:55'),
(3016, '2017-04-15 22:42:18', '2017-04-15 22:42:18'),
(3017, '2017-04-15 22:48:20', '2017-04-15 22:48:20'),
(3018, '2017-04-15 22:49:08', '2017-04-15 22:49:08'),
(3019, '2017-04-15 22:49:59', '2017-04-15 22:49:59'),
(3020, '2017-04-15 22:52:15', '2017-04-15 22:52:15'),
(3021, '2017-04-15 22:54:44', '2017-04-15 22:54:44'),
(3022, '2017-04-15 22:57:51', '2017-04-15 22:57:51'),
(3023, '2017-04-15 23:20:39', '2017-04-15 23:20:39'),
(3024, '2017-04-15 23:24:03', '2017-04-15 23:24:03');

-- --------------------------------------------------------

--
-- Structure de la table `students`
--

CREATE TABLE `students` (
  `id` int(10) UNSIGNED NOT NULL,
  `parent_id` int(10) UNSIGNED NOT NULL,
  `acc_id` int(11) DEFAULT NULL,
  `firstName` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastName` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dob` date DEFAULT NULL,
  `gender` enum('Nam','Nữ') COLLATE utf8mb4_unicode_ci NOT NULL,
  `school` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `class` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `students`
--

INSERT INTO `students` (`id`, `parent_id`, `acc_id`, `firstName`, `lastName`, `dob`, `gender`, `school`, `class`, `email`, `phone`) VALUES
(1, 1, 6, 'Test1', 'test2', '2017-04-11', 'Nam', NULL, NULL, NULL, NULL),
(2, 2, NULL, 'sdf', 'sdf', '2017-04-11', 'Nam', NULL, NULL, NULL, NULL),
(3, 3, NULL, 'ta', 're', '2017-04-18', 'Nam', 'fe', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `teachers`
--

CREATE TABLE `teachers` (
  `id` int(10) UNSIGNED NOT NULL,
  `acc_id` int(11) NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` enum('Nam','Nữ') COLLATE utf8mb4_unicode_ci NOT NULL,
  `dob` date DEFAULT NULL,
  `school` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bank_account` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rank` int(11) NOT NULL DEFAULT '70',
  `type` set('Giáo viên','Trợ giảng') COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `teachers`
--

INSERT INTO `teachers` (`id`, `acc_id`, `name`, `gender`, `dob`, `school`, `phone`, `email`, `bank_account`, `rank`, `type`) VALUES
(1, 4, 'Nguyễn Đắc Thắng', 'Nam', NULL, '', '', '', NULL, 70, ''),
(2, 5, 'Nguyễn Quyết Thắng', 'Nam', NULL, '', '', '', NULL, 70, '');

-- --------------------------------------------------------

--
-- Structure de la table `transaction`
--

CREATE TABLE `transaction` (
  `id` int(11) NOT NULL,
  `from` int(11) NOT NULL,
  `to` int(11) NOT NULL,
  `date` date NOT NULL,
  `amount` bigint(20) NOT NULL,
  `rel_id` int(11) DEFAULT NULL,
  `description` text NOT NULL,
  `status` enum('1','2','3','4') NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `user` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `transaction`
--

INSERT INTO `transaction` (`id`, `from`, `to`, `date`, `amount`, `rel_id`, `description`, `status`, `created_at`, `updated_at`, `user`) VALUES
(1, 7, 6, '2017-03-15', 45000, NULL, '#TC9.1  #hp03', '1', '2017-04-15 04:11:10', '2017-04-15 04:11:10', 'Trần Trịnh Bình Thành'),
(3, 7, 6, '2017-04-25', 45000, NULL, '#TC9.1  #hp04', '1', '2017-04-15 04:14:44', '2017-04-15 04:14:44', 'Trần Trịnh Bình Thành'),
(4, 7, 6, '2017-04-12', 60000, NULL, '<p>#TC9.1 #hp05&nbsp;</p>', '1', '2017-04-15 04:14:44', '2017-04-15 04:14:44', 'Trần Trịnh Bình Thành'),
(5, 8, 7, '2017-04-18', 20000, NULL, '<p>#TC9.1 #hp03</p>', '1', '2017-04-15 11:26:56', '0000-00-00 00:00:00', ''),
(6, 10, 7, '2017-04-18', 45000, NULL, '<p>#TC9.1 #hp04</p>', '1', '2017-04-15 11:26:56', '0000-00-00 00:00:00', ''),
(11, 8, 7, '2017-04-15', 25000, NULL, '#TC9.1#hp03', '1', '2017-04-15 14:30:12', '2017-04-15 14:30:12', 'Trần Trịnh Bình Thành'),
(12, 8, 7, '2017-04-15', 50000, NULL, '#TC9.1#hp05', '1', '2017-04-15 14:30:13', '2017-04-15 14:30:13', 'Trần Trịnh Bình Thành'),
(13, 8, 7, '2017-04-16', 10000, NULL, '#TC9.1#hp05', '1', '2017-04-15 20:51:09', '2017-04-15 20:51:09', 'Trần Trịnh Bình Thành'),
(14, 7, 6, '2017-05-30', 60000, NULL, '#TC9.1  #hp06', '1', '2017-04-15 20:53:37', '2017-04-15 20:53:37', 'Trần Trịnh Bình Thành'),
(15, 7, 6, '2017-04-14', 50000, NULL, '<p>#thithuvao10</p>', '1', '2017-04-16 03:53:45', '0000-00-00 00:00:00', ''),
(16, 8, 7, '2017-04-16', 40000, NULL, '#TC9.1#hp06', '1', '2017-04-15 20:55:13', '2017-04-15 20:55:13', 'Trần Trịnh Bình Thành'),
(18, 8, 7, '2017-04-16', 10000, NULL, '#TC9.1#hp06', '1', '2017-04-15 22:10:21', '2017-04-15 22:10:21', 'Trần Trịnh Bình Thành'),
(19, 8, 7, '2017-04-16', 10000, NULL, '#TC9.1#hp06', '1', '2017-04-15 22:11:04', '2017-04-15 22:11:04', 'Trần Trịnh Bình Thành'),
(20, 8, 7, '2017-04-16', 50000, NULL, '#phuphi', '1', '2017-04-15 22:11:05', '2017-04-15 22:11:05', 'Trần Trịnh Bình Thành'),
(26, 7, 6, '2017-04-12', 60000, NULL, '#TC9.1  #hp06', '1', '2017-04-15 22:18:18', '2017-04-15 22:18:18', 'Trần Trịnh Bình Thành'),
(27, 7, 6, '1970-01-01', 60000, NULL, '#TC9.1  #hp04', '1', '2017-04-15 22:18:39', '2017-04-15 22:18:39', 'Trần Trịnh Bình Thành'),
(63, 8, 7, '2017-04-16', 40000, NULL, '#TC9.1#hp04', '1', '2017-04-15 22:57:51', '2017-04-15 22:57:51', 'Trần Trịnh Bình Thành'),
(64, 8, 7, '2017-04-16', 40000, NULL, '#TC9.1#hp06', '1', '2017-04-15 22:57:51', '2017-04-15 22:57:51', 'Trần Trịnh Bình Thành'),
(67, 8, 7, '2017-04-16', 20000, NULL, '#TC9.1#hp04', '1', '2017-04-15 23:24:04', '2017-04-15 23:24:04', 'Trần Trịnh Bình Thành'),
(68, 8, 7, '2017-04-16', 10000, NULL, '#TC9.1#hp06', '1', '2017-04-15 23:24:04', '2017-04-15 23:24:04', 'Trần Trịnh Bình Thành');

-- --------------------------------------------------------

--
-- Structure de la table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `class_id` int(11) DEFAULT NULL,
  `lesson_id` int(10) DEFAULT NULL,
  `day` date DEFAULT NULL,
  `amount` int(11) DEFAULT NULL,
  `balance` int(11) DEFAULT NULL,
  `rel_id` int(11) DEFAULT NULL,
  `note` text,
  `type` set('-1','-2','1','2','3') DEFAULT NULL,
  `user` varchar(200) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `acc_id` int(11) NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(12) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `acc_id`, `name`, `email`, `password`, `remember_token`, `phone`, `address`, `avatar`, `created_at`, `updated_at`) VALUES
(1, 0, 'Trần Trịnh Bình Thành', 'tranthanhuet@gmail.com', '$2y$10$zpVhpQ/xKAzQnJg9ZTRvcuBDmAtp.nP3y3IAy8YWHOMgOy62vRwJO', NULL, NULL, NULL, NULL, '2017-03-25 10:14:29', '2017-03-25 10:14:29');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `attendances`
--
ALTER TABLE `attendances`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `class_std`
--
ALTER TABLE `class_std`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `discount`
--
ALTER TABLE `discount`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `enrolls`
--
ALTER TABLE `enrolls`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `lessons`
--
ALTER TABLE `lessons`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `note`
--
ALTER TABLE `note`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `parents`
--
ALTER TABLE `parents`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Index pour la table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `receipt`
--
ALTER TABLE `receipt`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT pour la table `attendances`
--
ALTER TABLE `attendances`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `classes`
--
ALTER TABLE `classes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `class_std`
--
ALTER TABLE `class_std`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `discount`
--
ALTER TABLE `discount`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `enrolls`
--
ALTER TABLE `enrolls`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `lessons`
--
ALTER TABLE `lessons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `note`
--
ALTER TABLE `note`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `parents`
--
ALTER TABLE `parents`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `receipt`
--
ALTER TABLE `receipt`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3025;
--
-- AUTO_INCREMENT pour la table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;
--
-- AUTO_INCREMENT pour la table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;