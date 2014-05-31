-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Machine: 127.0.0.1
-- Gegenereerd op: 31 mei 2014 om 22:31
-- Serverversie: 5.6.16
-- PHP-versie: 5.5.9

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Databank: `uld`
--

--
-- Gegevens worden uitgevoerd voor tabel `permission`
--

INSERT INTO `permission` (`roleName`, `controller`, `action`) VALUES
('Guest', 'account', 'loginForm'),
('Guest', 'account', 'performLogin'),
('Guest', 'account', 'performSignUp'),
('Guest', 'account', 'signUpForm'),
('Guest', 'index', 'index'),
('Users', 'account', 'logout');

--
-- Gegevens worden uitgevoerd voor tabel `role`
--

INSERT INTO `role` (`name`, `power`) VALUES
('Guest', 1),
('Users', 10),
('Administrator', 255);

--
-- Gegevens worden uitgevoerd voor tabel `status`
--

INSERT INTO `status` (`name`) VALUES
('non-confirmed');

--
-- Gegevens worden uitgevoerd voor tabel `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `passhash`, `salt`, `roleName`, `statusName`) VALUES
(2, 'test', 'test@test.nl', '$2a$08$QuMTeTPKtu9ofrU1YOxwLOBmPLnitkI/eFM7JaReqQvmJzJXOcr6m', 'g5qYlLJ6oXPHFzdSKp359g', 'Users', 'non-confirmed');
SET FOREIGN_KEY_CHECKS=1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

