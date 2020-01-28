-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 28 Sty 2020, 12:36
-- Wersja serwera: 10.4.10-MariaDB
-- Wersja PHP: 7.3.12

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
  `user_password` varchar(60) NOT NULL,
  `user_pwd_change` tinyint(1) DEFAULT NULL,
  `user_pwd_change_date` date NOT NULL,
  `group` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_email`, `user_password`, `user_pwd_change`, `user_pwd_change_date`, `group`) VALUES
(1, 'test', 'test@test.pl', '$2y$10$UF0EMjMbHD/9uCgc6Rst3evTXzY2A91V0ZzeZLnvHZBO0JNRIylny', 0, '2020-01-26', 3),
(2, 'user', 'user@user', '$2y$10$vQnIY9p2LGjg2oCAt7pVNeNyQg9rkOG88k0zx7XdIr41jmI.6u92a', 0, '2020-01-26', 1),
(3, 'moderator', 'moderator@moderator', '$2y$10$idvxh/kz8tgerkn8wyFsIej5JdBVjSnOCWHSqUCxGVIO75svAn/Bu', 0, '2020-01-26', 2),
(4, 'admin', 'admin@admin', '$2y$10$7qurgQjRDa8ntPK45LzOVeZy68nYfiCw8Co6H4B9RZdkzmOIYeeQu', 0, '2020-01-26', 3);

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
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

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
