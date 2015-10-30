-- phpMyAdmin SQL Dump
-- version 4.0.10.6
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Окт 30 2015 г., 17:02
-- Версия сервера: 5.5.41-log
-- Версия PHP: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `myCMS`
--

-- --------------------------------------------------------

--
-- Структура таблицы `pages`
--

CREATE TABLE IF NOT EXISTS `pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `section` int(11) NOT NULL,
  `header` varchar(250) DEFAULT NULL,
  `content` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `pages`
--

INSERT INTO `pages` (`id`, `section`, `header`, `content`) VALUES
(1, 5, 'Первая новость', 'контент');

-- --------------------------------------------------------

--
-- Структура таблицы `sections`
--

CREATE TABLE IF NOT EXISTS `sections` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) DEFAULT NULL,
  `root` int(11) DEFAULT '-1',
  `txt` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Дамп данных таблицы `sections`
--

INSERT INTO `sections` (`id`, `title`, `root`, `txt`) VALUES
(1, 'Дисковые пилы для стали', -1, 'Информация о разделе'),
(2, 'Дисковые пилы для алюминия', -1, NULL),
(3, 'Линии обработки стальных профилей', -1, NULL),
(4, 'Центры обработки листового металла', -1, NULL),
(5, 'Отрезные станки', 3, NULL),
(6, 'Линии сверления профилей', 3, NULL),
(7, 'Роботы для обработки профилей', 3, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `static`
--

CREATE TABLE IF NOT EXISTS `static` (
  `id` varchar(15) NOT NULL,
  `content` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `static`
--

INSERT INTO `static` (`id`, `content`) VALUES
('contacts', 'Контакты'),
('main', 'Главная страница'),
('prices', 'Прайс листы');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
