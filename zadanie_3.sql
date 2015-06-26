-- phpMyAdmin SQL Dump
-- version 4.1.14.8
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 26 Cze 2015, 17:59
-- Server version: 5.5.33-MariaDB
-- PHP Version: 5.4.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `zadanie_3`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `aktorzy`
--

CREATE TABLE IF NOT EXISTS `aktorzy` (
  `id_aktora` int(11) NOT NULL AUTO_INCREMENT,
  `imie` varchar(20) DEFAULT NULL,
  `nazwisko` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id_aktora`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=31 ;

--
-- Zrzut danych tabeli `aktorzy`
--

INSERT INTO `aktorzy` (`id_aktora`, `imie`, `nazwisko`) VALUES
(1, 'Arnold', 'Schwarzenegger'),
(2, 'Tamara', 'Arciuch'),
(3, 'Pawel', 'Wilczak'),
(4, 'Maciej', 'Stuhr'),
(5, 'Ryszard', 'Tymon Tymanski'),
(6, 'Jerzy', 'Rogalski'),
(7, 'Lech', 'Dyblik'),
(8, 'Marian', 'Dziedziel'),
(9, 'Michael', 'Biehn'),
(10, 'Linda', 'Hamilton'),
(11, 'Bill', 'Murray'),
(12, 'Dan', 'Aykroyd'),
(13, 'Sigourney', 'Weaver'),
(14, 'Robert', 'De Niro'),
(15, 'Jodie', 'Foster'),
(16, 'Harvey', 'Keitel'),
(17, 'Cybill', 'Shepherd'),
(18, 'Tom', 'Berenger'),
(19, 'Willem', 'Dafoe'),
(20, 'Charlie', 'Sheen'),
(21, 'Harrison', 'Ford'),
(22, 'Emmanuelle', 'Seigner'),
(23, 'Jean', 'Reno'),
(24, 'Billy', 'Crystal'),
(25, 'Lisa', 'Kudrow'),
(26, 'Gary', 'Oldman'),
(27, 'Natalie', 'Portman'),
(28, 'Tom', 'Cruise'),
(29, 'Szymon', 'Matyla'),
(30, 'Lesly', 'Lesly');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `app_users`
--

CREATE TABLE IF NOT EXISTS `app_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(25) NOT NULL,
  `password` varchar(60) NOT NULL,
  `imie` varchar(45) NOT NULL,
  `nazwisko` varchar(45) NOT NULL,
  `email` varchar(60) DEFAULT NULL,
  `isActive` tinyint(1) NOT NULL DEFAULT '1',
  `isAdmin` tinyint(1) NOT NULL DEFAULT '0',
  `newsletter` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username_UNIQUE` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Zrzut danych tabeli `app_users`
--

INSERT INTO `app_users` (`id`, `username`, `password`, `imie`, `nazwisko`, `email`, `isActive`, `isAdmin`, `newsletter`) VALUES
(1, 'jkowalski', '$2a$12$wpAyvVfVZipvfSLjNkqHOeRbx3IODVcYrfIvTRBb94J7ZjP.sOsmm', 'Jan', 'Kowalski', NULL, 1, 0, 1),
(2, 'anowak', '$2a$12$wpAyvVfVZipvfSLjNkqHOeRbx3IODVcYrfIvTRBb94J7ZjP.sOsmm', 'Anna', 'Nowak', NULL, 1, 0, 1),
(3, 'azielinski', '$2a$12$wpAyvVfVZipvfSLjNkqHOeRbx3IODVcYrfIvTRBb94J7ZjP.sOsmm', 'Arnold', 'Zieliński', NULL, 1, 0, 1),
(4, 'plis', '$2a$12$wpAyvVfVZipvfSLjNkqHOeRbx3IODVcYrfIvTRBb94J7ZjP.sOsmm', 'Paweł', 'Lis', NULL, 1, 0, 1),
(5, 'mwojciechowski', '$2a$12$wpAyvVfVZipvfSLjNkqHOeRbx3IODVcYrfIvTRBb94J7ZjP.sOsmm', 'Maciej', 'Wojciechowski', NULL, 1, 0, 1),
(6, 'jglinnicki', '$2a$12$wpAyvVfVZipvfSLjNkqHOeRbx3IODVcYrfIvTRBb94J7ZjP.sOsmm', 'Jan', 'Glinnicki', NULL, 1, 0, 1),
(7, 'jsmith', '$2a$04$H0qZlpHqW7jXqbqENqcpCuOnqLRdXlRK.U94FvSyew3AGRVd6dWmG', 'John', 'Smith', NULL, 1, 1, 0),
(8, 'bjohnson', '$2a$12$wpAyvVfVZipvfSLjNkqHOeRbx3IODVcYrfIvTRBb94J7ZjP.sOsmm', 'Ben', 'Johnson', NULL, 1, 1, 0),
(9, 'larmstrong', '$2a$12$wpAyvVfVZipvfSLjNkqHOeRbx3IODVcYrfIvTRBb94J7ZjP.sOsmm', 'Louis', 'Armstrong', NULL, 1, 1, 0),
(10, 'jlennon', '$2a$12$wpAyvVfVZipvfSLjNkqHOeRbx3IODVcYrfIvTRBb94J7ZjP.sOsmm', 'John', 'Lennon', NULL, 1, 1, 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `app_users_has_kopie`
--

CREATE TABLE IF NOT EXISTS `app_users_has_kopie` (
  `app_users_id` int(11) NOT NULL,
  `kopie_id_kopii` int(11) NOT NULL,
  `data_wypozyczenia` date NOT NULL,
  `data_zwrotu` date DEFAULT NULL,
  PRIMARY KEY (`app_users_id`,`kopie_id_kopii`),
  KEY `fk_app_users_has_kopie_kopie2_idx` (`kopie_id_kopii`),
  KEY `fk_app_users_has_kopie_app_users2_idx` (`app_users_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `filmy`
--

CREATE TABLE IF NOT EXISTS `filmy` (
  `id_filmu` int(11) NOT NULL AUTO_INCREMENT,
  `tytul` varchar(40) DEFAULT NULL,
  `rok_produkcji` int(11) DEFAULT NULL,
  `cena` double DEFAULT NULL,
  PRIMARY KEY (`id_filmu`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Zrzut danych tabeli `filmy`
--

INSERT INTO `filmy` (`id_filmu`, `tytul`, `rok_produkcji`, `cena`) VALUES
(1, 'Wesele', 2004, 10),
(2, 'Ghostbusters', 1984, 5.5),
(3, 'Terminator', 1984, 8.5),
(4, 'Taksowkarz', 1976, 5),
(5, 'Pluton', 1986, 5),
(6, 'Frantic', 1988, 8.5),
(7, 'Ronin', 1998, 9.5),
(8, 'Depresja gangstera', 1999, 10.5),
(9, 'Leon zawodowiec', 1994, 8.5),
(10, 'Mission Impossible', 1996, 8.5),
(11, 'Hajlihajlo', 2015, 14.5),
(12, 'Hello', 2010, 10.6);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `filmy_has_aktorzy`
--

CREATE TABLE IF NOT EXISTS `filmy_has_aktorzy` (
  `filmy_id_filmu` int(11) NOT NULL,
  `aktorzy_id_aktora` int(11) NOT NULL,
  PRIMARY KEY (`filmy_id_filmu`,`aktorzy_id_aktora`),
  KEY `fk_filmy_has_aktorzy_aktorzy1_idx` (`aktorzy_id_aktora`),
  KEY `fk_filmy_has_aktorzy_filmy1_idx` (`filmy_id_filmu`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `filmy_has_aktorzy`
--

INSERT INTO `filmy_has_aktorzy` (`filmy_id_filmu`, `aktorzy_id_aktora`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 10),
(1, 11),
(2, 4),
(2, 5),
(2, 6),
(2, 7),
(2, 29),
(3, 1),
(5, 1),
(7, 3),
(8, 4),
(10, 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `kontakt`
--

CREATE TABLE IF NOT EXISTS `kontakt` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(45) NOT NULL,
  `tresc` varchar(255) NOT NULL,
  `data_wprowadzenia` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Zrzut danych tabeli `kontakt`
--

INSERT INTO `kontakt` (`id`, `email`, `tresc`, `data_wprowadzenia`) VALUES
(9, 'uio@op.pl', 'jakas wiadomość', '2015-06-14'),
(10, 'uioq@wp.pl', 'Tutaj wpisz tekst zgłoszenia', '2015-06-14'),
(11, 'ttt@wp.pl', 'Tutaj wpisz tekst zgłoszenia', '2015-06-14'),
(12, 'szymon@wp.pl', 'Tutaj wpisz tekst zgłoszenia', '2015-06-16'),
(13, 'asda@wpo.pl', 'Tutaj wpisz tekst zgłoszenia', '2015-06-16'),
(14, 'hello@wp.pl', 'Tutaj wpisz tekst zgłoszenia', '2015-06-16'),
(15, 'dx@wp.pl', 'Tutaj wpisz tekst zgłoszenia', '2015-06-16');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `kopie`
--

CREATE TABLE IF NOT EXISTS `kopie` (
  `id_kopii` int(11) NOT NULL AUTO_INCREMENT,
  `id_filmu` int(11) NOT NULL,
  `czy_dostepna` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id_kopii`),
  KEY `fk_kopie_filmy1_idx` (`id_filmu`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=23 ;

--
-- Zrzut danych tabeli `kopie`
--

INSERT INTO `kopie` (`id_kopii`, `id_filmu`, `czy_dostepna`) VALUES
(1, 1, 0),
(2, 1, 0),
(3, 2, 0),
(4, 3, 0),
(5, 3, 0),
(7, 4, 0),
(8, 5, 1),
(9, 6, 0),
(10, 6, 1),
(11, 6, 1),
(14, 8, 1),
(15, 9, 0),
(16, 10, 0),
(17, 10, 0),
(18, 10, 0),
(19, 10, 0),
(20, 10, 0),
(21, 2, 1),
(22, 4, 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `wypozyczenia`
--

CREATE TABLE IF NOT EXISTS `wypozyczenia` (
  `id_wypozyczenia` int(11) NOT NULL AUTO_INCREMENT,
  `app_users_id` int(11) NOT NULL,
  `kopie_id_kopii` int(11) NOT NULL,
  `data_wypozyczenia` date NOT NULL,
  `data_zwrotu` date DEFAULT NULL,
  PRIMARY KEY (`id_wypozyczenia`),
  UNIQUE KEY `unique_id_wypozyczenia` (`id_wypozyczenia`),
  KEY `fk_app_users_has_kopie_kopie1_idx` (`kopie_id_kopii`),
  KEY `fk_app_users_has_kopie_app_users1_idx` (`app_users_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=25 ;

--
-- Zrzut danych tabeli `wypozyczenia`
--

INSERT INTO `wypozyczenia` (`id_wypozyczenia`, `app_users_id`, `kopie_id_kopii`, `data_wypozyczenia`, `data_zwrotu`) VALUES
(17, 7, 1, '2015-06-25', NULL),
(18, 7, 2, '2015-06-25', NULL),
(19, 7, 3, '2015-06-25', NULL),
(20, 7, 4, '2015-06-25', NULL),
(21, 7, 7, '2015-06-26', NULL),
(22, 7, 15, '2015-06-26', NULL),
(23, 1, 5, '2015-06-26', NULL),
(24, 1, 9, '2015-06-26', NULL);

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `app_users_has_kopie`
--
ALTER TABLE `app_users_has_kopie`
  ADD CONSTRAINT `fk_app_users_has_kopie_app_users2` FOREIGN KEY (`app_users_id`) REFERENCES `app_users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_app_users_has_kopie_kopie2` FOREIGN KEY (`kopie_id_kopii`) REFERENCES `kopie` (`id_kopii`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ograniczenia dla tabeli `filmy_has_aktorzy`
--
ALTER TABLE `filmy_has_aktorzy`
  ADD CONSTRAINT `fk_filmy_has_aktorzy_aktorzy1` FOREIGN KEY (`aktorzy_id_aktora`) REFERENCES `aktorzy` (`id_aktora`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_filmy_has_aktorzy_filmy1` FOREIGN KEY (`filmy_id_filmu`) REFERENCES `filmy` (`id_filmu`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ograniczenia dla tabeli `kopie`
--
ALTER TABLE `kopie`
  ADD CONSTRAINT `fk_kopie_filmy1` FOREIGN KEY (`id_filmu`) REFERENCES `filmy` (`id_filmu`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `wypozyczenia`
--
ALTER TABLE `wypozyczenia`
  ADD CONSTRAINT `fk_app_users_has_kopie_app_users1` FOREIGN KEY (`app_users_id`) REFERENCES `app_users` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_app_users_has_kopie_kopie1` FOREIGN KEY (`kopie_id_kopii`) REFERENCES `kopie` (`id_kopii`) ON DELETE NO ACTION ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
