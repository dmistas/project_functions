-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Янв 26 2021 г., 14:30
-- Версия сервера: 8.0.18
-- Версия PHP: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `project`
--

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `position` varchar(50) DEFAULT NULL,
  `name` varchar(50) NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `role` tinyint(2) NOT NULL DEFAULT '1',
  `img` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `email`, `phone`, `address`, `position`, `name`, `password`, `role`, `img`) VALUES
(1, 'admin@mail.ru', NULL, NULL, NULL, 'admin', '123', 0, NULL),
(13, 'oliver.kopyov@smartadminwebapp.com', '+1 317-456-2564', '15 Charist St, Detroit, MI, 48212, USA', 'IT Director, Gotbootstrap Inc.', 'Oliver Kopyov', '123', 1, 'img/demo/avatars/avatar-b.png'),
(14, 'Alita@smartadminwebapp.com', '+1 313-461-1347', '134 Hamtrammac, Detroit, MI, 48314, USA', 'Project Manager, Gotbootstrap Inc.', 'Alita Gray', '123', 1, 'img/demo/avatars/avatar-c.png'),
(15, 'jim.ketty@smartadminwebapp.com', '+1 313-779-3314', '134 Tasy Rd, Detroit, MI, 48212, USA', 'Staff Orgnizer, Gotbootstrap Inc.', 'Jim Ketty', '123', 1, 'img/demo/avatars/avatar-k.png'),
(16, 'john.oliver@smartadminwebapp.com', '+1 313-779-8134', '134 Gallery St, Detroit, MI, 46214, USA', 'Oncologist, Gotbootstrap Inc.', 'Dr. John Oliver', '123', 1, 'img/demo/avatars/avatar-g.png'),
(17, 'john.oliver@smartadminwebapp.com', '+1 313-779-8134', '134 Gallery St, Detroit, MI, 46214, USA', 'Oncologist, Gotbootstrap Inc.', 'Dr. John Oliver', '123', 1, 'img/demo/avatars/avatar-g.png'),
(18, 'sarah.mcbrook@smartadminwebapp.com', '+1 313-779-7613', '13 Jamie Rd, Detroit, MI, 48313, USA', 'Xray Division, Gotbootstrap Inc.', 'Sarah McBrook', '123', 1, 'img/demo/avatars/avatar-h.png'),
(19, 'jimmy.fallan@smartadminwebapp.com', '+1 313-779-4314', '55 Smyth Rd, Detroit, MI, 48341, USA', 'Accounting, Gotbootstrap Inc.', 'Jimmy Fellan', '123', 1, 'img/demo/avatars/avatar-i.png'),
(20, 'arica.grace@smartadminwebapp.com', '+1 313-779-3347', '798 Smyth Rd, Detroit, MI, 48341, USA', 'Accounting, Gotbootstrap Inc.', 'Arica Grace', '123', 1, 'img/demo/avatars/avatar-j.png');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
