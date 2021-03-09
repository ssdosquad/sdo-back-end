-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Мар 09 2021 г., 06:48
-- Версия сервера: 10.4.14-MariaDB
-- Версия PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `slt`
--

-- --------------------------------------------------------

--
-- Структура таблицы `accounts`
--

CREATE TABLE `accounts` (
  `id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `middlename` varchar(255) NOT NULL,
  `login` varchar(120) NOT NULL,
  `password` varchar(255) NOT NULL,
  `atype` enum('admin','teacher','methodist') NOT NULL DEFAULT 'teacher'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `accounts`
--

INSERT INTO `accounts` (`id`, `firstname`, `lastname`, `middlename`, `login`, `password`, `atype`) VALUES
(1, 'Admin', 'Admin', 'Admin', 'admin', '$2y$10$iTtBFOOCeDMXQMlHR4qowuUIKDsbUlQ9zGuXn2XVfCNoFNVlmA8IC', 'admin'),
(2, '123123', 'asdasdasd', 'asdasd', 'petrov', '$2y$10$UhEQoPJ2OqZVfyvZkyY/3uwuGQ3GtY2MEpu85nzfxaAwzCtaLjCc6', 'teacher'),
(3, '13', 'asdasdasd', 'asdasd', 'petrov', '$2y$10$MoAhZCQq/4fojaQlPl07puI7gffxIMDoT3vxfl4JzcRG8hthv69y2', 'teacher'),
(4, '13', 'asdasdasd', 'asdasd', 'lerxer', '$2y$10$dtxFj5BI90vluML.SMkbiuD2LYsqV4iVoIjKplWdiTHs5Y/GWNnCm', 'admin');

-- --------------------------------------------------------

--
-- Структура таблицы `routes`
--

CREATE TABLE `routes` (
  `id` int(11) NOT NULL,
  `url` varchar(120) NOT NULL,
  `method` enum('GET','POST') NOT NULL DEFAULT 'GET',
  `requiredOptions` text NOT NULL,
  `mainframe` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `routes`
--

INSERT INTO `routes` (`id`, `url`, `method`, `requiredOptions`, `mainframe`) VALUES
(1, 'account/auth', 'GET', 'login;password', 'php/auth.php'),
(2, 'student/choice', 'GET', 'type', 'php/student_auth.php'),
(3, 'account/create', 'POST', 'session;firstname;lastname;middlename;login;password;type', 'php/account_create.php');

-- --------------------------------------------------------

--
-- Структура таблицы `sessions`
--

CREATE TABLE `sessions` (
  `id` int(11) NOT NULL,
  `ip` varchar(64) NOT NULL,
  `aid` int(11) NOT NULL,
  `skey` varchar(255) NOT NULL,
  `stime` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `sessions`
--

INSERT INTO `sessions` (`id`, `ip`, `aid`, `skey`, `stime`) VALUES
(1, '::1', 1, '::1', 0),
(2, '::1', 1, '9e19219564247da09f84444d02cab0d49baa10df7384c9fdadb9d649c1a04a3d', 0),
(3, '::1', 1, '8167e65f2a35ead7369cbd632940b753253547397e0100293b6b57eaeca5abd7', 0),
(4, '::1', 1, 'a4f75abf64b1fc8448384f8d4968045be759e4d4b2e99f5715fe6ce89ba297c2', 0),
(5, '::1', 1, 'dd5822aa4283752711fde3ac6a9f555ea66f0987466d3b26fce9ee1c794f1415', 0),
(6, '::1', 1, '9deed4fab140c06a641914600e5cdc926948e5fe7ee8db23d6abf793c16e6363', 0),
(7, '::1', 1, '464df1228b190d9f74bf7895ee80c07e54202f559d4df67368aa24791d8deb21', 0),
(8, '::1', 1, '5bfd5c6b42ccf97b2a7fa8e48711d49359f3a5239409f36223213f8ddd1917ab', 0),
(9, '::1', 1, '5a65d92a89c8cc2cc33af1ffdb9a649d27a4011dcbbdbf56a3b0d2ba046d64d9', 0),
(10, '::1', 1, '3396bd13e0889b6924880bdf4fe776a4dd75379e094c4b110a29fa62b43c839c', 0),
(11, '::1', 1, 'ac01b0fd564437bf1ebd1d54d39ecdff895ea250d2d2206e16a4d70cdd481dbe', 0),
(12, '::1', 1, 'c34deb7391070438044c6ab1ccb2a889d5d9fa62951de05a6c4ad068010d912b', 0),
(13, '::1', 1, '92004d9ab4732b4ca82ce2f6ef4a490e4d19f0234f7cea3114f9bb20cf79c96d', 0),
(14, '::1', 1, 'd028d19b76640f61fd504524a844c65fae1b8391d1e24deec0d5a072e3ea9765', 0),
(15, '::1', 1, 'f302913a0f99fb0e1e16b6e3d34f302179ae4f42b08db6f5d112fd9ff829ed7c', 0),
(16, '192.168.101.93', 1, 'c3121ba0dc7102afa32c0e9ec31e84938b2c6b7233967a6036392e1f3ab3e32b', 0),
(17, '::1', 1, 'ab49df28319bc6bf28b1e21db8a3fe0a7ce8d7262059ce879ec7c6583ac0288a', 0),
(18, '::1', 1, '96f286dea364e400432bc7f2dd438b265f4c7560f24df252626f7cc91d4fcbc7', 0),
(19, '::1', 1, '3063fcf6e916a3e35df3f01b670f5be99224b0b908b9c41e54ab04efacce17c0', 0),
(20, '::1', 1, 'f4e9b2253d12adbc8feff60cf0728e64e185ec09b6ed7478dcbfc54dda849bbf', 0),
(21, '::1', 1, 'f4e9b2253d12adbc8feff60cf0728e64e185ec09b6ed7478dcbfc54dda849bbf', 0),
(22, '::1', 1, 'd8d1f1e007c9344d80cafa6646fe305aa875e843319f93f1c10c0e6659cd4135', 0),
(23, '::1', 1, '6519b104d523203a68ec7f350db3f6722036d8e5a141aeb2d5eef7ebea59887f', 0),
(24, '::1', 1, '6519b104d523203a68ec7f350db3f6722036d8e5a141aeb2d5eef7ebea59887f', 0),
(25, '::1', 1, '0974d6608f4fc7950720b94e641202929fcc296c3c95b6be7033ba956c97d932', 0),
(26, '::1', 1, '7ac66244c77d5297d075e5863db6b790bbfe7b9b373664c6603f8f4b7ba7c189', 0),
(27, '::1', 1, '7ac66244c77d5297d075e5863db6b790bbfe7b9b373664c6603f8f4b7ba7c189', 0),
(28, '::1', 1, '314ed1d0ad81b3c57426fd6067495a15feae44c5d0c3a322a0e6c91c0992b473', 0),
(29, '::1', 1, 'fb0ac5a1740a76fc54aaadeca1eac6d46ddbe8e12f70a75894f172bbc2c1733f', 0),
(30, '::1', 1, '6e580f68b652898035f7693f15e668bb195fd8cb718784e79ac8354c77d01900', 0),
(31, '::1', 1, '10336706ffebc07102cd93c22170e7b0feb58c931a031c96e15eb40d9af2598a', 0),
(32, '::1', 1, '10336706ffebc07102cd93c22170e7b0feb58c931a031c96e15eb40d9af2598a', 0),
(33, '::1', 1, 'dd68fbab12cff9923a56eedfe3eaecd9180b3d393a866ee2063134e1f40c74a7', 0),
(34, '::1', 1, '0acac9f56d63c2507bd3420b25c1a873bf6c84e00e3a0165c8016c7cb64b718d', 0),
(35, '::1', 1, 'c098ccde41a9fafea465c78a814cf77fe975cfb33fce6ceb7a4ceaf339f744fc', 0),
(36, '::1', 1, 'e686b6a9521f3c812c71e7cc3774336ef8ecea7071b29204a199112a0e85e3cf', 0),
(37, '::1', 1, 'e686b6a9521f3c812c71e7cc3774336ef8ecea7071b29204a199112a0e85e3cf', 0),
(38, '::1', 1, '4d56e40681e238a57815f6f54f3b71a24304dc38ed66d58605a4d455eeb79539', 0),
(39, '::1', 1, '4d56e40681e238a57815f6f54f3b71a24304dc38ed66d58605a4d455eeb79539', 0),
(40, '::1', 1, '8e1b0aa90a9b3dc27ed70240d8385df2ca38e5daefa7ef25e0b63e998eb6c7b4', 0),
(41, '::1', 1, 'f9ca56a102eab554979a5c59050e233dda7957bcf96c0816ac937768999f3a48', 0),
(42, '::1', 1, 'f9ca56a102eab554979a5c59050e233dda7957bcf96c0816ac937768999f3a48', 0),
(43, '::1', 1, '53bbe1751b9ace04effdf5b033eb7782edbcdfc7e665619fbf253a3cdf14cb11', 0),
(44, '::1', 1, '53bbe1751b9ace04effdf5b033eb7782edbcdfc7e665619fbf253a3cdf14cb11', 0),
(45, '::1', 1, '34e5c1b1892629ceb82de6bbcc888538e1cc5eb3bcb7926ce7bc1e9888618e0f', 0),
(46, '::1', 1, '1e2c7f866b38b7b31301a4a2cb409a5f685daacf97ff809113f09e363a879d24', 0),
(47, '::1', 1, '1e2c7f866b38b7b31301a4a2cb409a5f685daacf97ff809113f09e363a879d24', 0),
(48, '::1', 1, '79bf113c57600f984ad700779164e29e3c2a419555cae0f4e0d7207d15b71fbe', 0),
(49, '::1', 1, '5a8bbeb0680bbf57e260e1b197a394afb64e76212b2f0729c2018f0c512c588b', 0),
(50, '::1', 1, '95e823864838669516aa55f099d75f5d5a224a06cfada479a3b4c688fc7636d0', 0),
(51, '::1', 1, '95e823864838669516aa55f099d75f5d5a224a06cfada479a3b4c688fc7636d0', 0),
(52, '::1', 1, 'b5ccf0a0893e959588ae2a777127d670e87fe1b75ba2024de7f0a1ee3c26aa6b', 0),
(53, '::1', 1, '60a5e263b8a83785746eeb9db0ed40f14078cc34039b8ac2f77ddec400ba8dcf', 0),
(54, '::1', 1, '77d618573412c56938d33f9befda51fc74132d3f8875e82bb1b0cb7354621e53', 0),
(55, '::1', 1, '5216a803e135f020f74025222df4d03c15fec8d94ab4a086b7d1617fbdf47aa4', 0),
(56, '::1', 1, 'a33e9a77b20d207e00367b62585ecfd32d3d3351e77be3a3af96099be8de4a5b', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `gid` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `middlename` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `students`
--

INSERT INTO `students` (`id`, `gid`, `firstname`, `lastname`, `middlename`) VALUES
(1, 1, 'Данил', 'Ленченков', 'Сергеевич');

-- --------------------------------------------------------

--
-- Структура таблицы `student_group`
--

CREATE TABLE `student_group` (
  `id` int(11) NOT NULL,
  `name` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `student_group`
--

INSERT INTO `student_group` (`id`, `name`) VALUES
(1, 'ИНДУСЫ'),
(2, 'ЛИБЕРАЛЫ');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `routes`
--
ALTER TABLE `routes`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `student_group`
--
ALTER TABLE `student_group`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `routes`
--
ALTER TABLE `routes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `sessions`
--
ALTER TABLE `sessions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT для таблицы `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `student_group`
--
ALTER TABLE `student_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
