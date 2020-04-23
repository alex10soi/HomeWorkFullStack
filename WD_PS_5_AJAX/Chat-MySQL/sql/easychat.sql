-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Мар 24 2020 г., 14:55
-- Версия сервера: 10.3.13-MariaDB-log
-- Версия PHP: 7.1.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `easychat`
--
CREATE DATABASE IF NOT EXISTS `easychat` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `easychat`;

-- --------------------------------------------------------

--
-- Структура таблицы `chatinfo`
--

CREATE TABLE `chatinfo` (
  `id` int(11) UNSIGNED NOT NULL,
  `chat_username` varchar(50) NOT NULL,
  `time` varchar(20) NOT NULL,
  `sec` int(11) UNSIGNED NOT NULL,
  `message` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `chatinfo`
--

INSERT INTO `chatinfo` (`id`, `chat_username`, `time`, `sec`, `message`) VALUES
(1, 'myNameRT', '18:56:40', 1582477000, 'Привет'),
(2, 'myNameRT', '18:56:44', 1582477004, 'Я здесь '),
(3, 'myNameRT', '18:56:48', 1582477008, 'А ТЫ где'),
(4, 'myNameRT', '18:56:57', 1582477017, 'Я скоро выйду к Тебе :)'),
(5, 'Liza', '12:46:53', 1585046813, 'Привет'),
(24, 'Liza', '13:43:52', 1585050232, 'Очредная проверка');

-- --------------------------------------------------------

--
-- Структура таблицы `registrinfo`
--

CREATE TABLE `registrinfo` (
  `id` int(11) UNSIGNED NOT NULL,
  `chat_username` varchar(50) NOT NULL,
  `pass` varchar(70) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `registrinfo`
--

INSERT INTO `registrinfo` (`id`, `chat_username`, `pass`) VALUES
(1, 'myNameRT', '$2y$10$p7rwQ0WszA8Qm/3q9B.TDeJIrkBmIOkKheUpwt7atTfGoAo.dCAZi'),
(2, 'Liza', '$2y$10$9fzCrKRqX94uhFPNbhJaVeqlSbwtu7ZzxWasvE6tPyO5prgiJx/mC');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `chatinfo`
--
ALTER TABLE `chatinfo`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `registrinfo`
--
ALTER TABLE `registrinfo`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `chatinfo`
--
ALTER TABLE `chatinfo`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT для таблицы `registrinfo`
--
ALTER TABLE `registrinfo`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
