-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Фев 01 2021 г., 05:39
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
  `job_title` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `name` varchar(50) NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `role` tinyint(2) NOT NULL DEFAULT '1',
  `img` varchar(255) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `vk` varchar(255) DEFAULT NULL,
  `telegram` varchar(255) DEFAULT NULL,
  `instagram` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=46 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `email`, `phone`, `address`, `job_title`, `name`, `password`, `role`, `img`, `status`, `vk`, `telegram`, `instagram`) VALUES
(1, 'admin@mail.ru', NULL, NULL, NULL, 'admin', '$2y$10$02vF2IaAT4DWqiev/l7FOO8OaeY5KO411xaKHeh2DU1az3awZ/XIu', 0, NULL, NULL, NULL, NULL, NULL),
(13, 'oliver.kopyov@smartadminwebapp.com', '+7 917-456-2567', '15 Charist St, Detroit, MI, 48212, USA', 'IT Director, Gotbootstrap Inc.', 'Oleg Kopyov', '$2y$10$02vF2IaAT4DWqiev/l7FOO8OaeY5KO411xaKHeh2DU1az3awZ/XIu', 1, 'img/demo/avatars/avatar-b.png', NULL, NULL, NULL, NULL),
(14, 'Alita@smartadminwebapp.com', '+1 313-461-1347', '134 Hamtrammac, Detroit, MI, 48314, USA', 'Project Manager, Gotbootstrap Inc.', 'Alita Gray', '123', 1, 'img/demo/avatars/avatar-c.png', NULL, NULL, NULL, NULL),
(15, 'jim.ketty@smartadminwebapp.com', '+7 313-779-3314', '134 Tasy Rd, Detroit, MI, 48212, USA', 'Staff Orgnizer, Gotbootstrap Inc.', 'Jim Ketty', '123', 1, 'img/demo/avatars/avatar-k.png', NULL, NULL, NULL, NULL),
(16, 'john.oliver@smartadminwebapp.com', '+1 313-779-8134', '134 Gallery St, Detroit, MI, 46214, USA', 'Oncologist, Gotbootstrap Inc.', 'Dr. John Oliver', '123', 1, 'img/demo/avatars/avatar-g.png', NULL, NULL, NULL, NULL),
(17, 'john.oliver@smartadminwebapp.com', '+1 313-779-8134', '134 Gallery St, Detroit, MI, 46214, USA', 'Oncologist, Gotbootstrap Inc.', 'Dr. John Oliver', '123', 1, 'img/demo/avatars/avatar-g.png', NULL, NULL, NULL, NULL),
(18, 'sarah.mcbrook@smartadminwebapp.com', '+1 313-779-7613', '13 Jamie Rd, Detroit, MI, 48313, USA', 'Xray Division, Gotbootstrap Inc.', 'Sarah McBrook', '123', 1, 'img/demo/avatars/avatar-h.png', NULL, NULL, NULL, NULL),
(19, 'jimmy.fallan@smartadminwebapp.com', '+1 313-779-4314', '55 Smyth Rd, Detroit, MI, 48341, USA', 'Accounting, Gotbootstrap Inc.', 'Jimmy Fellan', '123', 1, 'img/demo/avatars/avatar-i.png', NULL, NULL, NULL, NULL),
(20, 'arica.grace@smartadminwebapp.com', '+1 313-779-3347', '798 Smyth Rd, Detroit, MI, 48341, USA', 'Accounting, Gotbootstrap Inc.', 'Arica Grace', '123', 1, 'img/demo/avatars/avatar-j.png', NULL, NULL, NULL, NULL),
(36, 'zywob@mailinator.com', 'rojafyv@mailinator.com', 'qype@mailinator.com', 'juce@mailinator.com', 'lyjy@mailinator.com', 'Pa$$w0rd!', 1, NULL, NULL, NULL, NULL, NULL),
(37, 'remycy@mailinator.com', 'xotiduz@mailinator.com', 'tejapi@mailinator.com', 'daxexazuho@mailinator.com', 'hekifores@mailinator.com', 'Pa$$w0rd!', 1, NULL, 'Онлайн', NULL, NULL, NULL),
(38, 'lihiwe@mailinator.com', 'nowamakup@mailinator.com', 'juteny@mailinator.com', 'kitakify@mailinator.com', 'dilujy@mailinator.com', 'Pa$$w0rd!', 1, NULL, 'Онлайн', NULL, NULL, NULL),
(39, 'dageqadi@mailinator.com', 'myjumaqoti@mailinator.com', 'turo@mailinator.com', 'zahurel@mailinator.com', 'zatutivuc@mailinator.com', 'Pa$$w0rd!', 1, NULL, 'Не беспокоить', NULL, NULL, NULL),
(40, 'rywa@mailinator.com', 'fuqibynar@mailinator.com', 'biqukypo@mailinator.com', 'tinyz@mailinator.com', 'lutybosop@mailinator.com', 'Pa$$w0rd!', 1, 'img/demo/avatars/601143f63bb57.png', 'Отошел', 'Delectus provident', 'Qui occaecat enim ex', 'Ipsa aut est omnis'),
(41, '3new@email.com', '+7123456', 'Moscow', 'mailinator', 'Sapegewyh Mailinator.com', '123', 1, NULL, NULL, NULL, NULL, NULL),
(42, 'rolyrase@mailinator.com', '+7 919 123456', 'detonocom@mailinator.com', 'jepowyqi@mailinator.com', 'mamesuf@mailinator.com', 'Pa$$w0rd!', 1, 'img/demo/avatars/60114488ca629.png', 'Не беспокоить', 'Illo eum voluptate d', 'Dolores aut qui quia', 'Consequat Quos sit '),
(45, 'admin@admin.com', '+7 919 123456', 'Уфа', 'Freelance', 'admin', '$2y$10$02vF2IaAT4DWqiev/l7FOO8OaeY5KO411xaKHeh2DU1az3awZ/XIu', 0, NULL, NULL, NULL, NULL, NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
