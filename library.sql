-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Czas generowania: 16 Mar 2020, 20:44
-- Wersja serwera: 10.4.11-MariaDB
-- Wersja PHP: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `library`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `groups`
--

CREATE TABLE `groups` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `permissions` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `groups`
--

INSERT INTO `groups` (`id`, `name`, `permissions`) VALUES
(1, 'Standard user', 'user = 1'),
(2, 'Moderator', 'mod = 1'),
(3, 'Administrator', 'admin = 1');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(60) NOT NULL,
  `user_email` varchar(60) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `phone_num` varchar(11) NOT NULL,
  `post_code` varchar(6) NOT NULL,
  `city` varchar(50) NOT NULL,
  `street` varchar(50) NOT NULL,
  `house_num` varchar(7) NOT NULL,
  `user_password` varchar(60) NOT NULL,
  `user_pwd_change` tinyint(1) DEFAULT NULL,
  `user_pwd_change_date` date NOT NULL,
  `group` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_email`, `first_name`, `last_name`, `phone_num`, `post_code`, `city`, `street`, `house_num`, `user_password`, `user_pwd_change`, `user_pwd_change_date`, `group`) VALUES
(2, 'user', 'user@user', 'Usernamek', 'Userlast', '111-111-111', '11-111', 'Userkowo', 'Userkowa', '1/1', '$2y$10$vQnIY9p2LGjg2oCAt7pVNeNyQg9rkOG88k0zx7XdIr41jmI.6u92a', 0, '2020-01-26', 1),
(3, 'moderator', 'moderator@moderator', 'Modernamek', 'Modernlastnek', '222-222-222', '22-222', 'Modernakowo', 'Moderowa', '2/2', '$2y$10$idvxh/kz8tgerkn8wyFsIej5JdBVjSnOCWHSqUCxGVIO75svAn/Bu', 0, '2020-01-26', 2),
(4, 'admin', 'admin@admin', 'Adminamek', 'Admineczek', '333-333-333', '33-333', 'Adminkowo', 'Adminkowa', '3/3', '$2y$10$7qurgQjRDa8ntPK45LzOVeZy68nYfiCw8Co6H4B9RZdkzmOIYeeQu', 0, '2020-01-26', 3),
(10, 'myszka', 'agasshi@onet.eu', 'Myszka', 'Szczurkowa', '888-888-888', '88-888', 'Gryzonice', 'Serowa', '666', '$2y$10$eu1.yVCPy6VijFss/2MAD.mrkguFiX1PdaiOelclGKKNQca9hcM1O', 0, '2020-03-07', 1);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `group` (`group`);

--
-- AUTO_INCREMENT dla tabel zrzutów
--

--
-- AUTO_INCREMENT dla tabeli `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`group`) REFERENCES `groups` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
