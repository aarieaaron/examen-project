-- phpMyAdmin SQL Dump
-- version 4.7.1
-- https://www.phpmyadmin.net/
--
-- Host: 10.2.1.117
-- Generation Time: Sep 10, 2017 at 09:16 AM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 7.0.22

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u121456690_exam`
--

--
-- Dumping data for table `Brands`
--

INSERT INTO `Brands` (`brandName`, `brandDescription`) VALUES
('Batavus', 'Batavus is een slecht merk'),
('Gazelle', 'Gazelle'),
('Popal', NULL);

--
-- Dumping data for table `Cart`
--

INSERT INTO `Cart` (`cartID`, `userID`, `lastModified`) VALUES
(4, 42, '2017-06-26 08:56:45');

--
-- Dumping data for table `CartItems`
--

INSERT INTO `CartItems` (`cartItem`, `cartID`, `itemID`) VALUES
(10, 4, 34),
(11, 4, 35),
(12, 4, 59),
(13, 4, 60),
(14, 4, 61);

--
-- Dumping data for table `Category`
--

INSERT INTO `Category` (`category`, `description`) VALUES
('Jongens Fiets', NULL),
('Moederfiets', NULL),
('Omafiets', NULL);

--
-- Dumping data for table `Favorites`
--

INSERT INTO `Favorites` (`userID`, `productID`) VALUES
(1, 10),
(1, 31),
(1, 32),
(1, 33),
(1, 37);

--
-- Dumping data for table `InvoiceAddress`
--

INSERT INTO `InvoiceAddress` (`orderID`, `street`, `zipcode`, `city`, `name`, `email`, `saveForLater`) VALUES
(1, 'haehnj3', '3755jt', 'soest', 'sdsdg', NULL, 0),
(2, 'haehnj3', '3755jt', 'soest', 'sdsdg', NULL, 0),
(3, 'haehnj3', '3755jt', 'soest', 'sdsdg', NULL, 0),
(4, 'Hazepad 6', '3766JT', 'Soest', 'Aaron van Leijenhorst', NULL, 0),
(5, 'Hazepad 6', '3766JT', 'Soest', 'Aaron van Leijenhorst', 'aarieaaron2@live.nl', 0),
(9, 'Industrieweg 37C', '3766AA', 'Soest', 'John van Leijenhorst', NULL, 0),
(10, 'Industrieweg 37C', '3766AA', 'Soest', 'John van Leijenhorst', NULL, 0),
(11, 'Industrieweg 37C', '3766AA', 'Soest', 'John van Leijenhorst', 'aarieaaron2@live.nl', 0),
(12, 'Industrieweg 37C', '3766AA', 'Soest', 'John van Leijenhorst', 'aarieaaron2@live.nl', 0),
(13, 'Industrieweg 37C', '3766AA', 'Soest', 'John van Leijenhorst', 'aarieaaron2@live.nl', 0),
(14, 'Industrieweg 37C', '3766AA', 'Soest', 'John van Leijenhorst', 'aarieaaron2@live.nl', 0),
(15, 'Industrieweg 37C', '3766AA', 'Soest', 'John van Leijenhorst', 'aarieaaron2@live.nl', 0),
(16, 'Industrieweg 37C', '3766AA', 'Soest', 'John van Leijenhorst', 'aarieaaron2@live.nl', 0),
(17, 'Industrieweg 37C', '3766AA', 'Soest', 'John van Leijenhorst', 'aarieaaron2@live.nl', 0),
(18, 'Industrieweg 37C', '3766AA', 'Soest', 'John van Leijenhorst', 'aarieaaron2@live.nl', 0),
(19, 'Industrieweg 37C', '3766AA', 'Soest', 'John van Leijenhorst', 'aarieaaron2@live.nl', 0),
(20, 'Industrieweg 37C', '3766AA', 'Soest', 'John van Leijenhorst', 'aarieaaron2@live.nl', 0),
(21, 'Industrieweg 37C', '3766AA', 'Soest', 'John van Leijenhorst', 'aarieaaron2@live.nl', 0),
(22, 'Industrieweg 37C', '3766AA', 'Soest', 'John van Leijenhorst', 'aarieaaron2@live.nl', 0),
(28, 'Industrieweg 37C', '3766AA', 'Soest', 'John van Leijenhorst', 'aarieaaron2@live.nl', 0),
(29, 'Industrieweg 37C', '3766AA', 'Soest', 'John van Leijenhorst', 'aarieaaron2@live.nl', 0),
(30, 'Industrieweg 37C', '3766AA', 'Soest', 'John van Leijenhorst', 'aarieaaron2@live.nl', 0),
(31, 'Industrieweg 37C', '3766AA', 'Soest', 'John van Leijenhorst', 'aarieaaron2@live.nl', 0),
(32, 'Industrieweg 37C', '3766AA', 'Soest', 'John van Leijenhorst', 'aarieaaron2@live.nl', 0),
(33, 'Industrieweg 37C', '3766AA', 'Soest', 'John van Leijenhorst', 'aarieaaron2@live.nl', 0),
(34, 'Hazepad 6', '3766JT', 'Soest', 'Aaron van Leijenhorst', 'aarieaaron2@live.nl', 0),
(35, 'Industrieweg 37C', '3766AA', 'Soest', 'John van Leijenhorst', 'aarieaaron2@live.nl', 1),
(36, 'Industrieweg 37C', '3766AA', 'Soest', 'John van Leijenhorst', 'aarieaaron2@live.nl', 1),
(37, 'Hazepad 656', '3766JT', 'Soest', 'Aaron van Leijenhorst', 'aarieaaron2@live.nl', 1),
(38, 'Hazepad 656', '3766JT', 'Soest', 'Aaron van Leijenhorst', 'aarieaaron2@live.nl', 1),
(39, 'Hazepad 656', '3766JT', 'Soest', 'Aaron van Leijenhorst', 'aarieaaron2@live.nl', 1),
(40, 'Hazepad 656', '3766JT', 'Soest', 'Aaron van Leijenhorst', 'aarieaaron2@live.nl', 1),
(41, 'Hazepad 656', '3766JT', 'Soest', 'Aaron van Leijenhorst', 'aarieaaron2@live.nl', 1),
(42, 'Hazepad 20', '3766JT', 'Soest', 'Aaron van Leijenhorst', 'aarieaaron2@live.nl', 1),
(43, 'Hazepad 20', '3766JT', 'Soest', 'Aaron van Leijenhorst', 'aarieaaron2@live.nl', 1),
(44, 'Hazepad 20', '3766JT', 'Soest', 'Aaron van Leijenhorst', 'aarieaaron2@live.nl', 1),
(45, 'Hazepad 20', '3766JT', 'Soest', 'Aaron van Leijenhorst', 'aarieaaron2@live.nl', 1),
(46, 'Hazepad 20', '3766JT', 'Soest', 'Aaron van Leijenhorst', 'aarieaaron2@live.nl', 1),
(47, 'Hazepad 20', '3766JT', 'Soest', 'Aaron van Leijenhorst', 'aarieaaron2@live.nl', 1),
(48, 'Hazepad 20', '3766JT', 'Soest', 'Aaron van Leijenhorst', 'aarieaaron2@live.nl', 1),
(49, 'Hazepad 20', '3766JT', 'Soest', 'Aaron van Leijenhorst', 'aarieaaron2@live.nl', 1),
(50, 'Hazepad 20', '3766JT', 'Soest', 'Aaron van Leijenhorst', 'aarieaaron2@live.nl', 1),
(51, 'Hazepad 20', '3766JT', 'Soest', 'Dennis van Wakeren', 'aarieaaron2@live.nl', 1),
(52, 'Hazepad 20', '3766JT', 'Soest', 'Dennis van Wakeren', 'aarieaaron2@live.nl', 1);

--
-- Dumping data for table `Item`
--

INSERT INTO `Item` (`itemID`, `productID`, `status`) VALUES
(1, 31, 'Sold'),
(2, 31, 'Sold'),
(3, 31, 'Sold'),
(4, 31, 'Sold'),
(5, 31, 'Sold'),
(6, 31, 'Sold'),
(7, 31, 'Sold'),
(8, 31, 'Sold'),
(9, 31, 'Sold'),
(10, 31, 'Sold'),
(11, 31, 'Sold'),
(12, 31, 'Sold'),
(13, 31, 'Sold'),
(14, 31, 'Sold'),
(15, 31, 'Sold'),
(16, 10, 'Sold'),
(17, 10, 'Sold'),
(18, 10, 'Sold'),
(19, 10, 'Sold'),
(20, 10, 'Sold'),
(21, 10, 'Sold'),
(22, 10, 'Sold'),
(23, 10, 'Sold'),
(24, 10, 'Sold'),
(25, 10, 'Sold'),
(26, 10, 'Sold'),
(27, 10, 'Sold'),
(28, 10, 'Sold'),
(29, 10, 'Sold'),
(30, 33, 'Sold'),
(31, 33, 'Sold'),
(32, 33, 'Sold'),
(33, 33, 'Sold'),
(34, 33, 'in cart'),
(35, 33, 'in cart'),
(36, 33, 'Sold'),
(37, 33, 'Sold'),
(38, 33, 'Sold'),
(39, 33, 'Sold'),
(40, 33, 'Sold'),
(41, 33, 'Sold'),
(42, 33, 'Sold'),
(43, 33, 'Sold'),
(44, 33, 'Sold'),
(45, 33, 'Sold'),
(46, 33, 'Sold'),
(47, 33, 'Sold'),
(48, 33, 'Sold'),
(49, 33, 'Sold'),
(50, 33, 'Sold'),
(51, 33, 'Sold'),
(52, 33, 'Sold'),
(53, 33, 'Sold'),
(54, 33, 'Sold'),
(55, 33, 'Sold'),
(56, 33, 'Sold'),
(57, 33, 'Sold'),
(58, 33, 'Sold'),
(59, 33, 'in cart'),
(60, 33, 'in cart'),
(61, 33, 'in cart'),
(62, 33, 'Sold'),
(63, 33, 'Sold'),
(64, 33, 'Sold'),
(65, 33, 'Sold'),
(66, 33, 'Sold'),
(67, 33, 'Sold'),
(68, 33, 'Sold'),
(69, 33, 'Sold'),
(70, 33, 'Sold'),
(71, 33, 'Sold'),
(72, 33, 'usable'),
(73, 33, 'usable'),
(74, 33, 'usable'),
(75, 33, 'usable'),
(76, 33, 'usable'),
(77, 33, 'usable'),
(78, 33, 'usable'),
(79, 33, 'usable'),
(80, 32, 'Sold'),
(81, 32, 'Sold'),
(82, 32, 'Sold'),
(83, 32, 'Sold'),
(84, 32, 'Sold'),
(85, 32, 'usable'),
(86, 32, 'usable'),
(87, 32, 'usable'),
(88, 34, 'Sold'),
(89, 34, 'Sold'),
(90, 34, 'Sold'),
(91, 34, 'Sold'),
(92, 34, 'Sold'),
(93, 34, 'Sold'),
(94, 34, 'Sold'),
(95, 34, 'usable'),
(96, 34, 'usable'),
(97, 34, 'usable'),
(98, 34, 'usable'),
(99, 34, 'usable'),
(100, 34, 'usable'),
(101, 34, 'usable'),
(102, 34, 'usable'),
(103, 34, 'usable'),
(104, 34, 'usable'),
(105, 34, 'usable'),
(106, 34, 'usable'),
(107, 34, 'usable'),
(108, 35, 'usable'),
(109, 35, 'usable'),
(110, 35, 'usable'),
(111, 35, 'usable'),
(112, 35, 'usable'),
(113, 35, 'usable'),
(114, 35, 'usable'),
(115, 35, 'usable'),
(116, 35, 'usable'),
(117, 35, 'usable'),
(118, 35, 'usable'),
(119, 35, 'usable'),
(120, 35, 'usable'),
(121, 35, 'usable'),
(122, 35, 'usable'),
(123, 35, 'usable'),
(124, 35, 'usable'),
(125, 35, 'usable'),
(126, 35, 'usable'),
(127, 35, 'usable'),
(128, 35, 'usable'),
(129, 35, 'usable'),
(130, 35, 'usable'),
(131, 35, 'usable'),
(132, 35, 'usable'),
(133, 35, 'usable'),
(134, 35, 'usable'),
(135, 35, 'usable'),
(136, 35, 'usable'),
(137, 35, 'usable'),
(138, 35, 'usable'),
(139, 35, 'usable'),
(140, 35, 'usable'),
(141, 35, 'usable'),
(142, 35, 'usable'),
(143, 36, 'usable'),
(144, 36, 'usable'),
(145, 36, 'usable'),
(146, 36, 'usable'),
(147, 36, 'usable'),
(148, 36, 'usable'),
(149, 36, 'usable'),
(150, 36, 'usable'),
(151, 36, 'usable'),
(152, 36, 'usable'),
(153, 36, 'usable'),
(154, 36, 'usable'),
(155, 36, 'usable'),
(156, 36, 'usable'),
(157, 36, 'usable'),
(158, 36, 'usable'),
(159, 36, 'usable'),
(160, 36, 'usable'),
(161, 36, 'usable'),
(162, 36, 'usable'),
(163, 36, 'usable'),
(164, 36, 'usable'),
(165, 36, 'usable'),
(166, 36, 'usable'),
(167, 36, 'usable'),
(168, 37, 'Sold'),
(169, 37, 'Sold'),
(170, 37, 'Sold'),
(171, 37, 'Sold'),
(172, 37, 'Sold'),
(173, 37, 'Sold'),
(174, 37, 'Sold'),
(175, 37, 'Sold'),
(176, 37, 'usable'),
(177, 37, 'usable'),
(178, 37, 'usable'),
(179, 37, 'usable'),
(180, 37, 'usable'),
(181, 37, 'usable'),
(182, 37, 'usable'),
(183, 37, 'usable'),
(184, 37, 'usable'),
(185, 37, 'usable'),
(186, 37, 'usable'),
(187, 37, 'usable'),
(188, 37, 'usable'),
(189, 37, 'usable'),
(190, 37, 'usable'),
(191, 37, 'usable'),
(192, 37, 'usable');

--
-- Dumping data for table `OrderDetails`
--

INSERT INTO `OrderDetails` (`orderID`, `itemID`) VALUES
(2, 10),
(2, 11),
(4, 12),
(4, 13),
(4, 14),
(4, 15),
(4, 18),
(4, 19),
(5, 1),
(5, 2),
(5, 3),
(5, 4),
(9, 20),
(10, 21),
(11, 22),
(12, 23),
(13, 24),
(14, 25),
(15, 26),
(16, 27),
(17, 28),
(18, 29),
(22, 1),
(28, 3),
(31, 36),
(32, 37),
(32, 38),
(32, 39),
(32, 40),
(32, 41),
(32, 42),
(32, 43),
(33, 44),
(33, 45),
(33, 46),
(34, 47),
(35, 48),
(35, 49),
(36, 50),
(37, 51),
(37, 52),
(37, 53),
(37, 54),
(37, 55),
(38, 56),
(38, 57),
(38, 58),
(39, 88),
(40, 30),
(40, 31),
(40, 89),
(40, 90),
(41, 32),
(41, 33),
(41, 91),
(41, 92),
(42, 62),
(42, 93),
(42, 94),
(43, 63),
(43, 64),
(44, 65),
(44, 66),
(45, 168),
(45, 169),
(46, 80),
(46, 170),
(46, 171),
(47, 81),
(47, 172),
(47, 173),
(48, 82),
(48, 174),
(48, 175),
(49, 67),
(49, 68),
(50, 83),
(51, 69),
(51, 70),
(51, 71),
(52, 84);

--
-- Dumping data for table `Orders`
--

INSERT INTO `Orders` (`orderID`, `email`, `orderPlaced`, `status`) VALUES
(1, 'aarieaaron2@live.nl', '2017-06-06 07:41:26', 'Verwerken'),
(2, 'aarieaaron2@live.nl', '2017-06-06 07:42:34', 'Verwerken'),
(3, 'aarieaaron2@live.nl', '2017-06-06 07:45:17', 'Verwerken'),
(4, 'aarieaaron2@live.nl', '2017-06-07 11:25:02', 'Verwerken'),
(5, 'aarieaaron2@live.nl', '2017-06-07 12:18:31', 'Verwerken'),
(6, 'aarieaaron2@live.nl', '2017-06-09 20:46:57', 'Wachten op betaling'),
(7, 'aarieaaron2@live.nl', '2017-06-09 20:51:28', 'Wachten op betaling'),
(8, 'aarieaaron2@live.nl', '2017-06-09 21:04:10', 'Wachten op betaling'),
(9, 'aarieaaron2@live.nl', '2017-06-09 21:11:04', 'Wachten op betaling'),
(10, 'aarieaaron2@live.nl', '2017-06-09 21:13:16', 'Wachten op betaling'),
(11, 'aarieaaron2@live.nl', '2017-06-09 21:14:38', 'Wachten op betaling'),
(12, 'aarieaaron2@live.nl', '2017-06-09 21:49:12', 'Wachten op betaling'),
(13, 'aarieaaron2@live.nl', '2017-06-09 21:52:25', 'Wachten op betaling'),
(14, 'aarieaaron2@live.nl', '2017-06-09 22:09:29', 'Wachten op betaling'),
(15, 'aarieaaron2@live.nl', '2017-06-09 22:10:56', 'Wachten op betaling'),
(16, 'aarieaaron2@live.nl', '2017-06-09 22:14:52', 'Wachten op betaling'),
(17, 'aarieaaron2@live.nl', '2017-06-09 22:49:33', 'Wachten op betaling'),
(18, 'aarieaaron2@live.nl', '2017-06-09 22:51:23', 'Wachten op betaling'),
(19, 'aarieaaron2@live.nl', '2017-06-09 23:00:06', 'Wachten op betaling'),
(20, 'aarieaaron2@live.nl', '2017-06-09 23:01:58', 'Wachten op betaling'),
(21, 'aarieaaron2@live.nl', '2017-06-09 23:04:08', 'Wachten op betaling'),
(22, 'aarieaaron2@live.nl', '2017-06-10 16:12:25', 'Wachten op betaling'),
(23, 'aarieaaron2@live.nl', '2017-06-10 16:29:24', ''),
(24, 'aarieaaron2@live.nl', '2017-06-10 16:40:50', 'Verwerken'),
(25, 'aarieaaron2@live.nl', '2017-06-10 16:41:03', 'Verwerken'),
(26, 'aarieaaron2@live.nl', '2017-06-10 16:49:55', 'Verwerken'),
(27, 'aarieaaron2@live.nl', '2017-06-10 16:51:29', 'Verwerken'),
(28, 'aarieaaron2@live.nl', '2017-06-10 17:00:13', 'Verwerken'),
(29, 'aarieaaron2@live.nl', '2017-06-12 06:48:17', 'Wachten op betaling'),
(30, 'aarieaaron2@live.nl', '2017-06-12 06:52:36', 'Wachten op betaling'),
(31, 'aarieaaron2@live.nl', '2017-06-12 07:16:37', 'Verwerken'),
(32, 'aarieaaron2@live.nl', '2017-06-12 07:23:29', 'Verwerken'),
(33, 'aarieaaron2@live.nl', '2017-06-13 07:27:57', 'Verwerken'),
(34, 'aarieaaron2@live.nl', '2017-06-13 07:29:04', 'Verwerken'),
(35, 'aarieaaron2@live.nl', '2017-06-13 09:08:37', 'Verwerken'),
(36, 'aarieaaron2@live.nl', '2017-06-13 09:11:40', 'Verwerken'),
(37, 'aarieaaron2@live.nl', '2017-06-13 10:33:48', 'Verwerken'),
(38, 'aarieaaron2@live.nl', '2017-06-13 11:28:12', 'Verwerken'),
(39, 'aarieaaron2@live.nl', '2017-06-26 07:33:04', 'Verwerken'),
(40, 'aarieaaron2@live.nl', '2017-06-26 07:55:39', 'Verwerken'),
(41, 'aarieaaron2@live.nl', '2017-06-26 07:57:00', 'Verwerken'),
(42, 'aarieaaron2@live.nl', '2017-06-26 08:58:27', 'Verwerken'),
(43, 'aarieaaron2@live.nl', '2017-08-22 08:32:28', 'Verwerken'),
(44, 'aarieaaron2@live.nl', '2017-08-22 08:59:03', 'Verwerken'),
(45, 'aarieaaron2@live.nl', '2017-08-22 09:04:30', 'Verwerken'),
(46, 'aarieaaron2@live.nl', '2017-08-22 09:05:38', 'Verwerken'),
(47, 'aarieaaron2@live.nl', '2017-08-22 09:09:12', 'Verwerken'),
(48, 'aarieaaron2@live.nl', '2017-08-22 09:12:24', 'Verwerken'),
(49, 'aarieaaron2@live.nl', '2017-08-22 09:13:29', 'Verwerken'),
(50, 'aarieaaron2@live.nl', '2017-09-08 10:25:33', 'Verwerken'),
(51, 'aarieaaron2@live.nl', '2017-09-08 08:47:30', 'Verwerken'),
(52, 'aarieaaron2@live.nl', '2017-09-08 09:00:39', 'Verwerken');

--
-- Dumping data for table `Product`
--

INSERT INTO `Product` (`productID`, `productName`, `productPrice`, `productDescription`, `productBrand`) VALUES
(10, 'Mambo Deluxe3', 903, 'Voor deze stijlvolle retro fiets liet Gazelle zich inspireren door dé klassieker uit eigen huis: de Tour de France. Het stoere stalen frame verbindt nostalgie met een moderne styling.3', 'Batavus'),
(31, 'Click N7', 599, 'Voor deze stijlvolle retro fiets liet Gazelle zich inspireren door dé klassieker uit eigen huis: de Tour de France. Het stoere stalen frame verbindt nostalgie met een moderne styling.', 'Batavus'),
(32, 'Bloom C7 Dames', 690, 'Voor deze stijlvolle retro fiets liet Gazelle zich inspireren door dé klassieker uit eigen huis: de Tour de France. Het stoere stalen frame verbindt nostalgie met een moderne styling.', 'Gazelle'),
(33, 'Van Stael', 799, 'Voor deze stijlvolle retro fiets liet Gazelle zich inspireren door dé klassieker uit eigen huis: de Tour de France. Het stoere stalen frame verbindt nostalgie met een moderne styling.', 'Gazelle'),
(34, 'Kicks', 259, 'Voor deze stijlvolle retro fiets liet Gazelle zich inspireren door dé klassieker uit eigen huis: de Tour de France. Het stoere stalen frame verbindt nostalgie met een moderne styling.', 'Popal'),
(35, 'Bolero', 779, 'Een stoere en trendy stadsfiets met een sterke, in het frame geïntegreerde bagagedrager en zeer veel rijcomfort. Exclusief bij Batavus Premium en Premium+ dealers.', 'Batavus'),
(36, 'Bolero', 999, 'Test2', 'Batavus'),
(37, 'Bolero', 99, 'test3', 'Batavus');

--
-- Dumping data for table `ProductAttributes`
--

INSERT INTO `ProductAttributes` (`productID`, `attribute`, `attributeValue`) VALUES
(31, 'Aantal versnellingen', '7'),
(32, 'Aantal versnellingen', '7'),
(33, 'Aantal versnellingen', '7'),
(34, 'Aantal versnellingen', '7'),
(10, 'Aantal versnellingen2', '72'),
(35, 'Achterrem soort', 'Rollerbrake'),
(31, 'Frame', 'Staal'),
(32, 'Frame', 'Staal'),
(33, 'Frame', 'Staal'),
(34, 'Frame', 'Staal'),
(35, 'Frame maten', '48, 53, 57, 61'),
(10, 'Frame2', 'Staal2'),
(31, 'Framematen', '54, 59, 64'),
(32, 'Framematen', '54, 59, 64'),
(33, 'Framematen', '54, 59, 64'),
(34, 'Framematen', '54, 59, 64'),
(10, 'Framematen2', '54, 59, 642'),
(31, 'Gewicht in kg', '13,6kg'),
(32, 'Gewicht in kg', '13,6kg'),
(33, 'Gewicht in kg', '13,6kg'),
(34, 'Gewicht in kg', '13,6kg'),
(35, 'Gewicht in kg', '21.1'),
(10, 'Gewicht in kg2', '13,6kg2'),
(31, 'Kleur', 'just grey glans'),
(32, 'Kleur', 'just grey glans'),
(33, 'Kleur', 'just grey glans'),
(34, 'Kleur', 'just grey glans'),
(35, 'Kleur', 'Wit'),
(10, 'Kleur2', 'just grey glans2'),
(36, 'test', 'test'),
(37, 'test', 'test'),
(31, 'Type versnelling', 'naaf'),
(32, 'Type versnelling', 'naaf'),
(33, 'Type versnelling', 'naaf'),
(34, 'Type versnelling', 'naaf'),
(10, 'Type versnelling2', 'naaf2'),
(35, 'Versnellingen', '7');

--
-- Dumping data for table `ProductImages`
--

INSERT INTO `ProductImages` (`productID`, `image`) VALUES
(10, 'images/productPhotos/10/BC100618_1_H_C.png'),
(10, 'images/productPhotos/10/BC100618_2_H_C.png'),
(10, 'images/productPhotos/10/BC100618_2S_H_C.png'),
(10, 'images/productPhotos/10/BC100618_3_H_C.png'),
(10, 'images/productPhotos/10/BC100618_4_H_C.png'),
(31, 'images/productPhotos/31/BC100818_1_H_C.png'),
(31, 'images/productPhotos/31/BC100818_2_H_C.png'),
(31, 'images/productPhotos/31/BC100818_3_H_C.png'),
(31, 'images/productPhotos/31/BC100818_4_H_C.png'),
(31, 'images/productPhotos/31/BC100818_5_H_C.png'),
(32, 'images/productPhotos/32/bloom-2.jpg'),
(32, 'images/productPhotos/32/bloom.jpg'),
(32, 'images/productPhotos/32/c65a4135.jpg'),
(32, 'images/productPhotos/32/c65a4136.jpg'),
(32, 'images/productPhotos/32/c65a4137.jpg'),
(32, 'images/productPhotos/32/c65a4138.jpg'),
(32, 'images/productPhotos/32/c65a4139.jpg'),
(32, 'images/productPhotos/32/c65a4140.jpg'),
(32, 'images/productPhotos/32/c65a4141.jpg'),
(32, 'images/productPhotos/32/c65a4142.jpg'),
(32, 'images/productPhotos/32/c65a4143.jpg'),
(32, 'images/productPhotos/32/c65a4144.jpg'),
(32, 'images/productPhotos/32/c65a4145.jpg'),
(32, 'images/productPhotos/32/c65a4146.jpg'),
(33, 'images/productPhotos/33/download.jpg'),
(34, 'images/productPhotos/34/Jongensfiets Popal Kicks Zwart 24 inch.jpg'),
(35, 'images/productPhotos/35/BC100830_1_H_C.png'),
(35, 'images/productPhotos/35/BC100830_2_H_C.png'),
(35, 'images/productPhotos/35/BC100830_3_H_C.png'),
(35, 'images/productPhotos/35/BC100830_4_H_C.png'),
(37, 'images/productPhotos/37/BC100830_1_H_C.png'),
(37, 'images/productPhotos/37/BC100830_2_H_C.png'),
(37, 'images/productPhotos/37/BC100830_3_H_C.png'),
(37, 'images/productPhotos/37/BC100830_4_H_C.png'),
(37, 'images/productPhotos/37/BC100830_5_H_C.png');

--
-- Dumping data for table `ProductInCategory`
--

INSERT INTO `ProductInCategory` (`productID`, `category`) VALUES
(10, 'Moederfiets'),
(31, 'Moederfiets'),
(32, 'Moederfiets'),
(33, 'Moederfiets'),
(34, 'Moederfiets'),
(35, 'Moederfiets'),
(36, 'Jongens Fiets'),
(37, 'Jongens Fiets');

--
-- Dumping data for table `ProductSale`
--

INSERT INTO `ProductSale` (`productID`, `date`) VALUES
(32, '2017-08-22');

--
-- Dumping data for table `Requests`
--

INSERT INTO `Requests` (`userID`, `productID`, `reason`, `status`) VALUES
(1, 10, 'Ik deze wil', 'Afgewezen'),
(1, 31, 'Ik deze wil heel erg graag', ''),
(1, 32, 'Ik deze fiets voor mijn moeder wil kopen', 'Open');

--
-- Dumping data for table `ShippingAddress`
--

INSERT INTO `ShippingAddress` (`orderID`, `street`, `zipcode`, `city`, `name`, `email`, `saveForLater`) VALUES
(1, 'haehnj3', '3755jt', 'soest', 'sdsdg', NULL, 0),
(2, 'haehnj3', '3755jt', 'soest', 'sdsdg', NULL, 0),
(3, 'haehnj3', '3755jt', 'soest', 'sdsdg', NULL, 0),
(4, 'Hazepad 6', '3766JT', 'Soest', 'Aaron van Leijenhorst', NULL, 0),
(5, 'Hazepad 6', '3766JT', 'Soest', 'Aaron van Leijenhorst', 'aarieaaron2@live.nl', 0),
(9, 'Hazepad 6', '3766JT', 'Soest', 'Aaron van Leijenhorst', NULL, 0),
(10, 'Hazepad 6', '3766JT', 'Soest', 'Aaron van Leijenhorst', NULL, 0),
(11, 'Hazepad 6', '3766JT', 'Soest', 'Aaron van Leijenhorst', 'aarieaaron2@live.nl', 0),
(12, 'Hazepad 6', '3766JT', 'Soest', 'Aaron van Leijenhorst', 'aarieaaron2@live.nl', 0),
(13, 'Hazepad 6', '3766JT', 'Soest', 'Aaron van Leijenhorst', 'aarieaaron2@live.nl', 0),
(14, 'Hazepad 6', '3766JT', 'Soest', 'Aaron van Leijenhorst', 'aarieaaron2@live.nl', 0),
(15, 'Hazepad 6', '3766JT', 'Soest', 'Aaron van Leijenhorst', 'aarieaaron2@live.nl', 0),
(16, 'Hazepad 6', '3766JT', 'Soest', 'Aaron van Leijenhorst', 'aarieaaron2@live.nl', 0),
(17, 'Hazepad 6', '3766JT', 'Soest', 'Aaron van Leijenhorst', 'aarieaaron2@live.nl', 0),
(18, 'Hazepad 6', '3766JT', 'Soest', 'Aaron van Leijenhorst', 'aarieaaron2@live.nl', 0),
(19, 'Hazepad 6', '3766JT', 'Soest', 'Aaron van Leijenhorst', 'aarieaaron2@live.nl', 0),
(20, 'Hazepad 6', '3766JT', 'Soest', 'Aaron van Leijenhorst', 'aarieaaron2@live.nl', 0),
(21, 'Hazepad 6', '3766JT', 'Soest', 'Aaron van Leijenhorst', 'aarieaaron2@live.nl', 0),
(22, 'Hazepad 6', '3766JT', 'Soest', 'Aaron van Leijenhorst', 'aarieaaron2@live.nl', 0),
(23, 'Hazepad 6', '3766JT', 'Soest', 'Aaron van Leijenhorst', 'aarieaaron2@live.nl', 0),
(24, 'Hazepad 6', '3766JT', 'Soest', 'Aaron van Leijenhorst', 'aarieaaron2@live.nl', 0),
(25, 'Hazepad 6', '3766JT', 'Soest', 'Aaron van Leijenhorst', 'aarieaaron2@live.nl', 0),
(26, 'Hazepad 6', '3766JT', 'Soest', 'Aaron van Leijenhorst', 'aarieaaron2@live.nl', 0),
(27, 'Hazepad 6', '3766JT', 'Soest', 'Aaron van Leijenhorst', 'aarieaaron2@live.nl', 0),
(28, 'Hazepad 6', '3766JT', 'Soest', 'Aaron van Leijenhorst', 'aarieaaron2@live.nl', 0),
(29, 'Hazepad 6', '3766JT', 'Soest', 'Aaron van Leijenhorst', 'aarieaaron2@live.nl', 0),
(30, 'Hazepad 6', '3766JT', 'Soest', 'Aaron van Leijenhorst', 'aarieaaron2@live.nl', 0),
(31, 'Hazepad 6', '3766JT', 'Soest', 'Aaron van Leijenhorst', 'aarieaaron2@live.nl', 0),
(32, 'Hazepad 6', '3766JT', 'Soest', 'Aaron van Leijenhorst', 'aarieaaron2@live.nl', 0),
(33, 'Hazepad 6', '3766JT', 'Soest', 'Aaron van Leijenhorst', 'aarieaaron2@live.nl', 0),
(34, 'Hazepad 62', '3766JT', 'Soest', 'Aaron van Leijenhorst', 'aarieaaron2@live.nl', 0),
(35, 'Hazepad 6', '3766JT', 'Soest', 'Aaron van Leijenhorst', '1', 0),
(36, 'Hazepad 65', '3766JT', 'Soest', 'Aaron van Leijenhorst', 'aarieaaron2@live.nl', 1),
(37, 'Hazepad 656', '3766JT', 'Soest', 'Aaron van Leijenhorst', 'aarieaaron2@live.nl', 1),
(38, 'Hazepad 656', '3766JT', 'Soest', 'Aaron van Leijenhorst', 'aarieaaron2@live.nl', 1),
(39, 'Hazepad 656', '3766JT', 'Soest', 'Aaron van Leijenhorst', 'aarieaaron2@live.nl', 1),
(40, 'Hazepad 656', '3766JT', 'Soest', 'Aaron van Leijenhorst', 'aarieaaron2@live.nl', 1),
(41, 'Hazepad 656', '3766JT', 'Soest', 'Aaron van Leijenhorst', 'aarieaaron2@live.nl', 1),
(42, 'Hazepad 20', '3766JT', 'Soest', 'Aaron van Leijenhorst', 'aarieaaron2@live.nl', 1),
(43, 'Hazepad 20', '3766JT', 'Soest', 'Aaron van Leijenhorst', 'aarieaaron2@live.nl', 1),
(44, 'Hazepad 20', '3766JT', 'Soest', 'Aaron van Leijenhorst', 'aarieaaron2@live.nl', 1),
(45, 'Hazepad 20', '3766JT', 'Soest', 'Aaron van Leijenhorst', 'aarieaaron2@live.nl', 1),
(46, 'Hazepad 20', '3766JT', 'Soest', 'Aaron van Leijenhorst', 'aarieaaron2@live.nl', 1),
(47, 'Hazepad 20', '3766JT', 'Soest', 'Aaron van Leijenhorst', 'aarieaaron2@live.nl', 1),
(48, 'Hazepad 20', '3766JT', 'Soest', 'Aaron van Leijenhorst', 'aarieaaron2@live.nl', 1),
(49, 'Hazepad 20', '3766JT', 'Soest', 'Aaron van Leijenhorst', 'aarieaaron2@live.nl', 1),
(50, 'Hazepad 20', '3766JT', 'Soest', 'Aaron van Leijenhorst', 'aarieaaron2@live.nl', 1),
(51, 'Hazepad 20', '3766JT', 'Soest', 'Dennis van Wakeren', 'aarieaaron2@live.nl', 1),
(52, 'Hazepad 20', '3766JT', 'Soest', 'Dennis van Wakeren', 'aarieaaron2@live.nl', 1);

--
-- Dumping data for table `User`
--

INSERT INTO `User` (`userID`, `name`, `email`, `paymentMethod`, `bank`) VALUES
(1, 'Aaron van Leijenhorst', 'aarieaaron2@live.nl', 'ideal', 'ING'),
(2, 'Aaron van undefined', 'aarieaaron3@live.nl', '', NULL),
(27, 'Aaron van Leijenhorst', 'aarieaaron4@live.nl', '', NULL),
(28, 'Aaron van Leijenhorst', 'aarieaaron5@live.nl', '', NULL),
(29, 'Aaron van Leijenhorst', 'aarieaaron6@live.nl', '', NULL),
(30, 'Aaron van Leijenhorst', 'aarieaaron7@live.nl', '', NULL),
(31, 'Aaron van Leijenhorst', 'aarieaaron8@live.nl', '', NULL),
(32, 'Aaron van Leijenhorst', 'aarieaaron10@live.nl', '', NULL),
(33, 'Aaron van Leijenhorst', 'aarieaaron11@live.nl', '', NULL),
(34, 'Aaron van Leijenhorst', 'aarieaaron12@live.nl', '', NULL),
(35, 'test', 'test', 'bank', 'test'),
(36, 'Aaron van Leijenhorst', 'aarieaaron20@live.nl', 'ideal', 'ING'),
(37, 'Hans Odijk', 'hsok@hans.nl', 'ideal', 'ABN_AMRO'),
(38, 'Kenneth kut', 'k.v.miltenburg@gmail.com', 'ideal', 'ING'),
(39, 'Peter Celi', 'test@test.nl', 'paypal', 'ING'),
(40, 'Olaf Smid', 'acc2@test.nl', 'ideal', 'ABN_AMRO'),
(41, 'Yoran van de Erve', 'acc@test2.nl', 'ideal', 'RABO'),
(42, 'Hans Odijk2', 'acceptatietest3@test.nl', 'ideal', 'SNS');

--
-- Dumping data for table `UserRoles`
--

INSERT INTO `UserRoles` (`role`, `userID`) VALUES
('admin', 1),
('admin', 29),
('admin', 30),
('admin', 31),
('admin', 33),
('admin', 34),
('admin', 38),
('admin', 39),
('admin', 40),
('admin', 41),
('admin', 42),
('medewerker', 1),
('medewerker', 29),
('medewerker', 30),
('medewerker', 31),
('medewerker', 33),
('medewerker', 34),
('medewerker', 38),
('medewerker', 39),
('medewerker', 40),
('medewerker', 41),
('medewerker', 42),
('user', 1),
('user', 28),
('user', 29),
('user', 30),
('user', 31),
('user', 32),
('user', 33),
('user', 34),
('user', 36),
('user', 37),
('user', 38),
('user', 39),
('user', 40),
('user', 41),
('user', 42);

--
-- Dumping data for table `UserSecurity`
--

INSERT INTO `UserSecurity` (`userID`, `passwordHash`, `verificationHash`, `accountStatus`) VALUES
(1, '8225ddf5d0df8d23e50302698c1afd5b', 'c4ca4238a0b923820dcc509a6f75849b', 'activated'),
(28, '', '33e75ff09dd601bbe69f351039152189', 'not activated'),
(29, '', '6ea9ab1baa0efb9e19094440c317e21b', 'not activated'),
(30, '', '34173cb38f07f89ddbebc2ac9128303f', 'not activated'),
(31, '1c055e3addf75c2ec8c830d5f912ce41', 'c16a5320fa475530d9583c34fd356ef5', 'not activated'),
(32, '1c055e3addf75c2ec8c830d5f912ce41', '6364d3f0f495b6ab9dcf8d3b5c6e0b01', 'not activated'),
(33, '1c055e3addf75c2ec8c830d5f912ce41', '182be0c5cdcd5072bb1864cdee4d3d6e', 'not activated'),
(34, '1c055e3addf75c2ec8c830d5f912ce41', 'e369853df766fa44e1ed0ff613f563bd', 'activated'),
(36, 'slaapkamer2', '19ca14e7ea6328a42e0eb13d585e4c22', NULL),
(37, 'slaapkamer2', 'a5bfc9e07964f8dddeb95fc584cd965d', 'activated'),
(38, 'slaapkamer2', 'a5771bce93e200c36f7cd9dfd0e5deaa', NULL),
(39, 'slaapkamer2', 'd67d8ab4f4c10bf22aa353e27879133c', NULL),
(40, 'slaapkamer2', 'd645920e395fedad7bbbed0eca3fe2e0', 'activated'),
(41, '701f33b8d1366cde9cb3822256a62c01', '3416a75f4cea9109507cacd8e2f2aefc', 'activated'),
(42, '701f33b8d1366cde9cb3822256a62c01', 'a1d0c6e83f027327d8461063f4ac58a6', 'activated');
SET FOREIGN_KEY_CHECKS=1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
