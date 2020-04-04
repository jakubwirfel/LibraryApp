-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 04 Kwi 2020, 16:52
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
-- Struktura tabeli dla tabeli `contacts`
--

CREATE TABLE `contacts` (
  `contact_id` int(11) NOT NULL,
  `contact_name` varchar(60) NOT NULL,
  `group_id` int(11) NOT NULL,
  `supervisor` varchar(60) NOT NULL,
  `contact_email` varchar(60) NOT NULL,
  `contact_phone` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `contacts`
--

INSERT INTO `contacts` (`contact_id`, `contact_name`, `group_id`, `supervisor`, `contact_email`, `contact_phone`) VALUES
(1, 'Dział IT', 1, 'Jakub Wirfel', 'jakub@mail.com', '000-000-000'),
(2, 'Dyrektor', 2, 'Kowalski Jan', 'kowalski@gan.pl', '978-435-756');

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
-- Struktura tabeli dla tabeli `help_articles`
--

CREATE TABLE `help_articles` (
  `article_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `article_name` varchar(60) NOT NULL,
  `article_title` varchar(100) NOT NULL,
  `article_content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `help_articles`
--

INSERT INTO `help_articles` (`article_id`, `group_id`, `article_name`, `article_title`, `article_content`) VALUES
(2, 1, 'Article', 'Title article', 'Test tekst'),
(4, 3, 'Dupa12', 'dupa12', 'Dupa12');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `notifications`
--

CREATE TABLE `notifications` (
  `notification_id` int(11) NOT NULL,
  `sender` int(11) NOT NULL,
  `recipient` int(11) DEFAULT NULL,
  `date` date NOT NULL,
  `massage` varchar(200) NOT NULL,
  `for_group` tinyint(1) DEFAULT NULL,
  `group_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `notifications`
--

INSERT INTO `notifications` (`notification_id`, `sender`, `recipient`, `date`, `massage`, `for_group`, `group_id`) VALUES
(99, 4, 10, '2020-04-01', 'Test1', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `posts`
--

CREATE TABLE `posts` (
  `post_id` int(11) NOT NULL,
  `creator` int(11) NOT NULL,
  `date` date NOT NULL,
  `img_name` varchar(30) NOT NULL,
  `img_dir` varchar(100) NOT NULL,
  `title` varchar(100) NOT NULL,
  `header` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `footer` varchar(100) NOT NULL,
  `likes` int(111) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `posts`
--

INSERT INTO `posts` (`post_id`, `creator`, `date`, `img_name`, `img_dir`, `title`, `header`, `content`, `footer`, `likes`) VALUES
(13, 4, '2020-03-30', 'cloud.png', './public/uploads/post_img/cloud.png', 'Testowy post1', 'Testowy nagłówek', 'Tekst główny', 'Stopka posta', 0),
(14, 4, '2020-03-30', 'cloud.png', './public/uploads/post_img/cloud.png', 'Tytuł drugi', 'Nagłówek drugi', 'Tekst główny drugi', 'Stopka druga', 0);

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
(10, 'Myszka', 'agasshi@onet.eu', 'Myszka', 'Szczurkowa', '888-888-888', '88-888', 'Gryzonice', 'Serowa', '10', '$2y$10$eu1.yVCPy6VijFss/2MAD.mrkguFiX1PdaiOelclGKKNQca9hcM1O', 0, '2020-03-07', 1);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`contact_id`),
  ADD KEY `group_for` (`group_id`);

--
-- Indeksy dla tabeli `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `help_articles`
--
ALTER TABLE `help_articles`
  ADD PRIMARY KEY (`article_id`),
  ADD KEY `group_id` (`group_id`);

--
-- Indeksy dla tabeli `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`notification_id`),
  ADD KEY `sender` (`sender`),
  ADD KEY `recipient` (`recipient`),
  ADD KEY `group_id` (`group_id`) USING BTREE;

--
-- Indeksy dla tabeli `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`),
  ADD KEY `user_id` (`creator`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `group` (`group`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `contacts`
--
ALTER TABLE `contacts`
  MODIFY `contact_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT dla tabeli `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT dla tabeli `help_articles`
--
ALTER TABLE `help_articles`
  MODIFY `article_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT dla tabeli `notifications`
--
ALTER TABLE `notifications`
  MODIFY `notification_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT dla tabeli `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `contacts`
--
ALTER TABLE `contacts`
  ADD CONSTRAINT `contacts_ibfk_1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`);

--
-- Ograniczenia dla tabeli `help_articles`
--
ALTER TABLE `help_articles`
  ADD CONSTRAINT `help_articles_ibfk_1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`);

--
-- Ograniczenia dla tabeli `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`sender`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `notifications_ibfk_2` FOREIGN KEY (`recipient`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `notifications_ibfk_3` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`);

--
-- Ograniczenia dla tabeli `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`creator`) REFERENCES `users` (`user_id`);

--
-- Ograniczenia dla tabeli `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`group`) REFERENCES `groups` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
