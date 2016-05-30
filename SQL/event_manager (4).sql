-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2016 年 5 月 30 日 11:24
-- サーバのバージョン： 5.5.39
-- PHP Version: 5.4.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `event_manager`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `attends`
--

CREATE TABLE IF NOT EXISTS `attends` (
`id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=8 ;

--
-- テーブルのデータのダンプ `attends`
--

INSERT INTO `attends` (`id`, `user_id`, `event_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 2, 1),
(4, 4, 1),
(5, 4, 2),
(6, 4, 3),
(7, 4, 10);

-- --------------------------------------------------------

--
-- テーブルの構造 `events`
--

CREATE TABLE IF NOT EXISTS `events` (
`id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime NOT NULL,
  `place` varchar(255) NOT NULL,
  `group_id` int(11) DEFAULT NULL,
  `detail` text,
  `registered_by` int(11) NOT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=24 ;

--
-- テーブルのデータのダンプ `events`
--

INSERT INTO `events` (`id`, `title`, `start`, `end`, `place`, `group_id`, `detail`, `registered_by`, `created`) VALUES
(1, '第一会議カンファレンス', '2016-05-21 00:00:00', '0000-00-00 00:00:00', '第一会議室', 5, 'みんなで話します\r\n更新したよ。', 1, '2016-05-20 00:00:00'),
(2, 'テストイベント', '2000-11-11 11:11:11', '0000-00-00 00:00:00', '第一会議室', 0, 'アニョハセｙ', 1, '2016-05-23 13:21:22'),
(3, 'ちょうちょうちょう会議', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '函館空港', 3, '超会議するよ', 0, '2016-05-24 15:08:54'),
(4, 'テストカンファレンス', '1999-11-11 11:11:11', '0000-00-00 00:00:00', '首里城', 2, '首里城でカンファレンスでんす', 0, '2016-05-24 15:10:02'),
(5, '井戸端会議yo', '2016-05-27 10:29:56', '0000-00-00 00:00:00', '第一会議室', 1, 'おばばの会議だよ', 0, '2016-05-24 15:10:44'),
(6, '運動会！', '2016-05-27 10:29:56', '0000-00-00 00:00:00', 'フォーラム8', 2, '怪我しないでね', 0, '2016-05-24 16:09:03'),
(7, 'スペシャル会', '2016-05-27 10:29:56', '0000-00-00 00:00:00', 'プレイスやで', 2, 'スペシャルな会だよ', 4, '2016-05-24 16:45:37'),
(8, '超会議', '2016-05-27 10:29:56', '2016-05-24 15:11:11', 'タクロー喫茶', 5, 'テスト太郎「わたしがつくりました」', 4, '2016-05-25 10:35:31'),
(9, 'かかかかかかっかかか会議', '2016-05-27 10:29:56', '0000-00-00 00:00:00', '第一会議室', 2, '<h1>テスト</h1>', 4, '2016-05-25 10:44:02'),
(10, 'テスト', '2016-05-27 10:29:56', '0000-00-00 00:00:00', '第一会議室', 1, 'お\r\nＯｏｏＯＯＯ\r\nＯＯ\r\n<h1>aaaaa</h1>', 4, '2016-05-25 11:35:59'),
(11, 'テスト', '2016-05-27 10:29:56', '0000-00-00 00:00:00', '函館空港', 1, '', 4, '2016-05-25 11:36:43'),
(12, 'テスト', '2016-05-27 10:29:56', '0000-00-00 00:00:00', 'フォーラム8', 0, '', 4, '2016-05-25 11:37:19'),
(13, 'テスト', '2016-05-27 10:29:56', '0000-00-00 00:00:00', 'フォーラム8', 0, '', 4, '2016-05-25 11:37:42'),
(14, 'テスト', '2016-05-27 10:29:56', '0000-00-00 00:00:00', 'フォーラム8', 2, '', 4, '2016-05-25 11:38:13'),
(15, 'テスト', '2016-05-27 10:29:56', '0000-00-00 00:00:00', 'フォーラム8', 0, '', 4, '2016-05-25 11:38:35'),
(16, 'テスト', '2016-05-27 10:29:56', '0000-00-00 00:00:00', '第一会議室', 6, '', 4, '2016-05-25 16:44:01'),
(17, 'あいうえお会議', '2016-05-27 10:29:56', '0000-00-00 00:00:00', 'フォーラム8', 2, '改行おおおおおおおおおおおおおおおおおおおおおおおおおおおおおおおおおおおおおお覆覆おおおおおおおおおおおおおおおおおおおおおおおおおおおおおおお\r\nテスト\r\nだよ', 4, '2016-05-26 10:22:46'),
(18, 'テストタイトル', '2016-05-25 11:11:00', '0000-00-00 00:00:00', 'フォーラム8', 1, 'sad', 1, '2016-05-27 16:03:51'),
(19, '更新しました', '2016-05-25 11:11:11', '0000-00-00 00:00:00', 'フォーラム8', 1, '', 1, '2016-05-30 10:44:55'),
(20, '第一会議カンファレンス', '2016-05-21 00:00:00', '0000-00-00 00:00:00', '井戸', 1, NULL, 1, '2016-05-31 00:00:00'),
(21, '&lt;h1&gt;ヘイヘイ昇平&lt;/h1&gt;', '2016-05-25 11:11:11', '0000-00-00 00:00:00', 'フォーラム8', 1, '&#039;&#039;&#039;&#039;&#039;&#039;&#039;&#039;&#039;&#039;&#039;&#039;&#039;&#039;&#039;&#039;&#039;&#039;&#039;&#039;&#039;&#039;&#039;&#039;&#039;&#039;&#039;&#039;&#039;&#039;&#039;&#039;&#039;&#039;&#039;&#039;&#039;&#039;', 2, '2016-05-30 10:57:37'),
(22, '社長に愛を', '2016-05-31 11:11:11', '0000-00-00 00:00:00', 'フォーラム8', 1, '''''''''''''''''''’’’’’’’’’’’’’’’’’', 12, '2016-05-30 11:12:31'),
(23, 'テスト会議(明日createdした感じ)', '2016-05-21 00:00:00', '0000-00-00 00:00:00', '部屋', 0, NULL, 1, '2016-05-31 00:00:00');

-- --------------------------------------------------------

--
-- テーブルの構造 `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
`id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=12 ;

--
-- テーブルのデータのダンプ `groups`
--

INSERT INTO `groups` (`id`, `name`) VALUES
(1, '社長'),
(2, 'その他'),
(3, '営業部'),
(4, '開発部\r\n'),
(5, '技術部'),
(6, '人事部'),
(7, '事業開発部'),
(8, '経理部'),
(9, '蹴球部'),
(10, '<a href=''#''>google</a>'),
(11, '演劇部');

-- --------------------------------------------------------

--
-- テーブルの構造 `login_log`
--

CREATE TABLE IF NOT EXISTS `login_log` (
`id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `login_at` datetime NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=29 ;

--
-- テーブルのデータのダンプ `login_log`
--

INSERT INTO `login_log` (`id`, `user_id`, `login_at`) VALUES
(1, 1, '2016-05-30 09:38:17'),
(2, 2, '2016-05-30 09:46:18'),
(3, 1, '2016-05-30 09:48:17'),
(4, 1, '2016-05-30 09:48:48'),
(5, 1, '2016-05-30 10:07:26'),
(6, 1, '2016-05-30 10:08:46'),
(7, 1, '2016-05-30 10:11:11'),
(8, 1, '2016-05-30 10:11:43'),
(9, 1, '2016-05-30 10:26:08'),
(10, 1, '2016-05-30 10:27:56'),
(11, 1, '2016-05-30 10:29:05'),
(12, 1, '2016-05-30 10:44:30'),
(13, 1, '2016-05-30 10:45:10'),
(14, 1, '2016-05-30 10:46:18'),
(15, 1, '2016-05-30 10:46:38'),
(16, 1, '2016-05-30 10:48:21'),
(17, 1, '2016-05-30 10:50:38'),
(18, 1, '2016-05-30 10:52:08'),
(19, 1, '2016-05-30 10:55:24'),
(20, 1, '2016-05-30 10:56:17'),
(21, 2, '2016-05-30 10:57:10'),
(22, 1, '2016-05-30 10:58:13'),
(23, 1, '2016-05-30 11:01:53'),
(24, 1, '2016-05-30 11:10:43'),
(25, 12, '2016-05-30 11:11:58'),
(26, 1, '2016-05-30 11:12:48'),
(27, 1, '2016-05-30 11:15:34'),
(28, 1, '2016-05-30 11:18:45');

-- --------------------------------------------------------

--
-- テーブルの構造 `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` int(11) NOT NULL,
  `login_id` varchar(50) NOT NULL,
  `login_pass` varchar(255) NOT NULL,
  `name` varchar(50) NOT NULL,
  `type_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=13 ;

--
-- テーブルのデータのダンプ `users`
--

INSERT INTO `users` (`id`, `login_id`, `login_pass`, `name`, `type_id`, `group_id`, `created`) VALUES
(1, 'kanritarou', 'e794bb42bdd30162cc2ea8714430653d3a2e0d1a', '管理 太郎', 1, 1, '2016-05-18 05:26:19'),
(2, 'ippantarou', '9d05aae35f963e09838fd793960ad39ef18758ef', '一般 太郎', 2, 2, '2016-05-18 00:00:00'),
(3, 'aaaaaa', '2c2393f452c496688585c5e0129e361b6d737dc1', 'そのた大勢', 2, 2, '2016-05-13 00:00:00'),
(4, 'tarrara', 'aeca814da6f8bf6514c4e44e0d940d21d14c81fd', '<h1>そのた大勢</h1>', 2, 2, '2016-05-27 00:00:00'),
(5, 'aaaasaa', '2c2393f452c496688585c5e0129e361b6d737dc1', 'そのた大勢', 2, 2, '2016-05-13 00:00:00'),
(6, 'tarsrara', 'aeca814da6f8bf6514c4e44e0d940d21d14c81fd', '<h1>そのた大勢</h1>', 2, 2, '2016-05-27 00:00:00'),
(7, 'aaadasaa', '2c2393f452c496688585c5e0129e361b6d737dc1', 'そのた大勢', 2, 2, '2016-05-13 00:00:00'),
(8, 'tarsrdara', 'aeca814da6f8bf6514c4e44e0d940d21d14c81fd', '<h1>そのた大勢</h1>', 2, 2, '2016-05-27 00:00:00'),
(9, 'aaaadasaa', '2c2393f452c496688585c5e0129e361b6d737dc1', 'そのた大勢', 2, 2, '2016-05-13 00:00:00'),
(10, 'tarasrdara', 'aeca814da6f8bf6514c4e44e0d940d21d14c81fd', '<h1>そのた大勢</h1>', 2, 2, '2016-05-27 00:00:00'),
(11, 'aaa', 'f7a9e24777ec23212c54d7a350bc5bea5477fdbb', 'オカ　ダ', 0, 1, '2016-05-27 14:03:51'),
(12, 'elly', '50cc3bac506aaabdd6a10e422e64da981a0f0e1a', 'エリー ワトソン', 0, 1, '2016-05-30 11:11:47');

-- --------------------------------------------------------

--
-- テーブルの構造 `user_types`
--

CREATE TABLE IF NOT EXISTS `user_types` (
`id` int(11) NOT NULL,
  `name` varchar(10) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=3 ;

--
-- テーブルのデータのダンプ `user_types`
--

INSERT INTO `user_types` (`id`, `name`) VALUES
(1, '管理者'),
(2, '一般');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attends`
--
ALTER TABLE `attends`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login_log`
--
ALTER TABLE `login_log`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `login_id` (`login_id`);

--
-- Indexes for table `user_types`
--
ALTER TABLE `user_types`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attends`
--
ALTER TABLE `attends`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `login_log`
--
ALTER TABLE `login_log`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `user_types`
--
ALTER TABLE `user_types`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
