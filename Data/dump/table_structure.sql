-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: mysql-db:3306
-- Generation Time: Mar 22, 2024 at 01:59 AM
-- Server version: 8.3.0
-- PHP Version: 8.2.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ct07_db`
--

DELIMITER $$
--
-- Procedures
--
DROP PROCEDURE IF EXISTS `GenerateRandomRatings`$$
CREATE DEFINER=`ad_db_ct07`@`%` PROCEDURE `GenerateRandomRatings` ()   BEGIN
    DECLARE i INT DEFAULT 1;
    DECLARE rand_user_id INT;
    DECLARE rand_recipe_id INT;
    DECLARE rand_rating INT;
    
    WHILE i <= 100 DO
        -- Chọn ngẫu nhiên user_id từ 1 đến 4
        SET rand_user_id = FLOOR(RAND() * 4) + 1;
        
        -- Chọn ngẫu nhiên recipe_id từ 1 đến 32
        SET rand_recipe_id = FLOOR(RAND() * 32) + 1;
        
        -- Chọn ngẫu nhiên rating từ 1 đến 5
        SET rand_rating = FLOOR(RAND() * 5) + 1;
        
        -- Chèn dữ liệu vào bảng recipe_ratings
        INSERT INTO recipe_ratings (recipe_id, user_id, rating)
        VALUES (rand_recipe_id, rand_user_id, rand_rating);
        
        SET i = i + 1;
    END WHILE;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `ingredients`
--

DROP TABLE IF EXISTS `ingredients`;
CREATE TABLE IF NOT EXISTS `ingredients` (
  `id` int NOT NULL AUTO_INCREMENT,
  `isActive` tinyint(1) DEFAULT '1',
  `category` varchar(4) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `measurement_unit` varchar(4) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_ingre_cat` (`category`),
  KEY `FK_ingre_unit` (`measurement_unit`)
) ENGINE=InnoDB AUTO_INCREMENT=325 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ingredients`
--

INSERT INTO `ingredients` (`id`, `isActive`, `category`, `measurement_unit`) VALUES
(1, 1, 'MSF', 'g'),
(2, 1, 'VEGI', 'g'),
(3, 1, 'OTHR', 'tbsp'),
(4, 1, 'OTHR', 'tbsp'),
(5, 1, 'MSF', 'g'),
(6, 1, 'VEGI', 'unit'),
(7, 1, 'OTHR', 'tbsp'),
(8, 1, 'HRBS', 'unit'),
(9, 1, 'PRP', 'can'),
(10, 1, 'VEGI', 'cup'),
(11, 1, 'VEGI', 'unit'),
(12, 1, 'HRBS', 'cup'),
(13, 1, 'VEGI', 'unit'),
(14, 1, 'OTHR', 'tbsp'),
(15, 1, 'OTHR', 'tbsp'),
(16, 1, 'VEGI', 'unit'),
(17, 1, 'OTHR', 'tbsp'),
(18, 1, 'HRBS', 'unit'),
(19, 1, 'OTHR', 'tbsp'),
(20, 1, 'OTHR', 'tbsp'),
(26, 1, 'OTHR', 'unit'),
(27, 1, 'OTHR', 'cup'),
(28, 1, 'OTHR', 'cup'),
(29, 1, 'OTHR', 'unit'),
(30, 1, 'OTHR', 'tbsp'),
(31, 1, 'OTHR', 'cup'),
(32, 1, 'OTHR', 'cup'),
(33, 1, 'VEGI', 'unit'),
(34, 1, 'VEGI', 'unit'),
(35, 1, 'HRBS', 'cup'),
(36, 1, 'VEGI', 'unit'),
(37, 1, 'OTHR', 'tbsp'),
(38, 1, 'OTHR', 'unit'),
(39, 1, 'OTHR', 'tsp'),
(40, 1, 'OTHR', 'tsp'),
(41, 1, 'OTHR', 'tsp'),
(42, 1, 'OTHR', 'tsp'),
(43, 1, 'MSF', 'can'),
(44, 1, 'OTHR', 'unit'),
(45, 1, 'OTHR', 'cup'),
(46, 1, 'VEGI', 'unit'),
(47, 1, 'HRBS', 'cup'),
(48, 1, 'OTHR', 'tbsp'),
(49, 1, 'OTHR', 'tbsp'),
(50, 1, 'OTHR', 'tsp'),
(51, 1, 'OTHR', 'tsp'),
(52, 1, 'OTHR', 'cup'),
(60, 1, 'OTHR', 'unit'),
(61, 1, 'OTHR', 'cup'),
(62, 1, 'OTHR', 'tsp'),
(63, 1, 'VEGI', 'unit'),
(64, 1, 'HRBS', 'tbsp'),
(65, 1, 'OTHR', 'tsp'),
(66, 1, 'OTHR', 'tsp'),
(72, 1, 'VEGI', 'unit'),
(73, 1, 'MSF', 'lb'),
(74, 1, 'VEGI', 'unit'),
(75, 1, 'HRBS', 'tbsp'),
(76, 1, 'OTHR', 'tsp'),
(77, 1, 'OTHR', 'unit'),
(78, 1, 'OTHR', 'tbsp'),
(79, 1, 'MSF', 'oz'),
(80, 1, 'OTHR', 'cup'),
(81, 1, 'OTHR', 'cup'),
(82, 1, 'OTHR', 'unit'),
(83, 1, 'OTHR', 'tsp'),
(84, 1, 'VEGI', 'unit'),
(85, 1, 'OTHR', 'oz'),
(86, 1, 'OTHR', 'unit'),
(87, 1, 'MSF', 'lb'),
(88, 1, 'OTHR', 'unit'),
(89, 1, 'HRBS', 'tbsp'),
(90, 1, 'OTHR', 'tbsp'),
(91, 1, 'OTHR', 'oz'),
(92, 1, 'OTHR', 'tbsp'),
(93, 1, 'OTHR', 'tbsp'),
(94, 1, 'OTHR', 'can'),
(95, 1, 'OTHR', 'can'),
(96, 1, 'OTHR', 'can'),
(97, 1, 'MSF', 'lb'),
(98, 1, 'OTHR', 'cup'),
(99, 1, 'HRBS', 'cup'),
(100, 1, 'VEGI', 'cup'),
(101, 1, 'OTHR', 'tbsp'),
(102, 1, 'OTHR', 'tbsp'),
(103, 1, 'OTHR', 'tbsp'),
(104, 1, 'HRBS', 'tbsp'),
(105, 1, 'OTHR', 'cup'),
(106, 1, 'FRU', 'cup'),
(107, 1, 'FRU', 'unit'),
(108, 1, 'HRBS', 'cup'),
(109, 1, 'OTHR', 'tbsp'),
(110, 1, 'FRU', 'tbsp'),
(111, 1, 'FRU', 'tbsp'),
(112, 1, 'OTHR', 'tbsp'),
(113, 1, 'OTHR', 'tsp'),
(114, 1, 'OTHR', 'tsp'),
(118, 1, 'MSF', 'lb'),
(119, 1, 'OTHR', 'cup'),
(120, 1, 'VEGI', 'unit'),
(121, 1, 'HRBS', 'tbsp'),
(122, 1, 'OTHR', 'tbsp'),
(123, 1, 'OTHR', 'tbsp'),
(124, 1, 'OTHR', 'unit'),
(125, 1, 'OTHR', 'tsp'),
(126, 1, 'OTHR', 'tsp'),
(131, 1, 'MSF', 'lb'),
(132, 1, 'VEGI', 'cup'),
(133, 1, 'VEGI', 'unit'),
(134, 1, 'HRBS', 'cup'),
(135, 1, 'FRU', 'cup'),
(136, 1, 'OTHR', 'cup'),
(137, 1, 'OTHR', 'cup'),
(138, 1, 'OTHR', 'tbsp'),
(139, 1, 'OTHR', 'tbsp'),
(140, 1, 'OTHR', 'tsp'),
(141, 1, 'OTHR', 'tsp'),
(146, 1, 'PRP', 'cup'),
(147, 1, 'PRP', 'can'),
(148, 1, 'VEGI', 'cup'),
(149, 1, 'VEGI', 'cup'),
(150, 1, 'HRBS', 'cup'),
(151, 1, 'VEGI', 'unit'),
(152, 1, 'OTHR', 'cup'),
(153, 1, 'OTHR', 'cup'),
(154, 1, 'OTHR', 'tbsp'),
(155, 1, 'OTHR', 'tbsp'),
(156, 1, 'OTHR', 'tsp'),
(157, 1, 'OTHR', 'tsp'),
(158, 1, 'MSF', 'lb'),
(159, 1, 'VEGI', 'unit'),
(160, 1, 'VEGI', 'unit'),
(161, 1, 'HRBS', 'tbsp'),
(162, 1, 'OTHR', 'tbsp'),
(163, 1, 'OTHR', 'oz'),
(164, 1, 'OTHR', 'can'),
(165, 1, 'OTHR', 'can'),
(166, 1, 'OTHR', 'cup'),
(167, 1, 'HRBS', 'tbsp'),
(168, 1, 'MSF', 'lb'),
(169, 1, 'VEGI', 'lb'),
(170, 1, 'OTHR', 'lb'),
(171, 1, 'OTHR', 'cup'),
(172, 1, 'OTHR', 'cup'),
(173, 1, 'OTHR', 'tbsp'),
(174, 1, 'OTHR', 'cup'),
(175, 1, 'OTHR', 'cup'),
(176, 1, 'OTHR', 'cup'),
(177, 1, 'VEGI', 'cup'),
(178, 1, 'VEGI', 'cup'),
(179, 1, 'OTHR', 'cup'),
(180, 1, 'OTHR', 'cup'),
(181, 1, 'OTHR', 'tbsp'),
(182, 1, 'OTHR', 'tbsp'),
(183, 1, 'OTHR', 'tbsp'),
(184, 1, 'VEGI', 'unit'),
(185, 1, 'OTHR', 'cup'),
(186, 1, 'VEGI', 'cup'),
(187, 1, 'VEGI', 'cup'),
(188, 1, 'HRBS', 'tbsp'),
(197, 1, 'OTHR', 'tbsp'),
(198, 1, 'VEGI', 'cup'),
(199, 1, 'VEGI', 'cup'),
(200, 1, 'VEGI', 'tbsp'),
(201, 1, 'OTHR', 'can'),
(202, 1, 'VEGI', 'cup'),
(203, 1, 'VEGI', 'cup'),
(204, 1, 'OTHR', 'tbsp'),
(205, 1, 'OTHR', 'unit'),
(206, 1, 'VEGI', 'cup'),
(207, 1, 'FRU', 'unit'),
(208, 1, 'VEGI', 'cup'),
(209, 1, 'OTHR', 'cup'),
(210, 1, 'OTHR', 'cup'),
(211, 1, 'MSF', 'cup'),
(212, 1, 'OTHR', 'tbsp'),
(213, 1, 'FRU', 'tbsp'),
(214, 1, 'OTHR', 'tbsp'),
(215, 1, 'VEGI', 'cup'),
(216, 1, 'VEGI', 'cup'),
(217, 1, 'VEGI', 'cup'),
(218, 1, 'OTHR', 'tbsp'),
(219, 1, 'OTHR', 'cup'),
(220, 1, 'OTHR', 'can'),
(221, 1, 'OTHR', 'cup'),
(222, 1, 'HRBS', 'tsp'),
(223, 1, 'OTHR', 'unit'),
(224, 1, 'HRBS', 'tbsp'),
(225, 1, 'OTHR', 'tbsp'),
(226, 1, 'OTHR', 'tbsp'),
(227, 1, 'VEGI', 'cup'),
(228, 1, 'VEGI', 'cup'),
(229, 1, 'OTHR', 'tbsp'),
(230, 1, 'MSF', 'lb'),
(231, 1, 'OTHR', 'can'),
(232, 1, 'OTHR', 'can'),
(233, 1, 'OTHR', 'cup'),
(234, 1, 'OTHR', 'cup'),
(235, 1, 'HRBS', 'tsp'),
(236, 1, 'HRBS', 'tsp'),
(237, 1, 'HRBS', 'tsp'),
(238, 1, 'HRBS', 'tsp'),
(239, 1, 'HRBS', 'tsp'),
(240, 1, 'HRBS', 'tsp'),
(241, 1, 'HRBS', 'tsp'),
(242, 1, 'OTHR', 'unit'),
(243, 1, 'HRBS', 'tbsp'),
(244, 1, 'OTHR', 'cup'),
(245, 1, 'VEGI', 'cup'),
(246, 1, 'VEGI', 'cup'),
(247, 1, 'VEGI', 'cup'),
(248, 1, 'VEGI', 'cup'),
(249, 1, 'HRBS', 'cup'),
(250, 1, 'OTHR', 'cup'),
(251, 1, 'OTHR', 'cup'),
(252, 1, 'OTHR', 'cup'),
(253, 1, 'OTHR', 'tbsp'),
(254, 1, 'HRBS', 'tsp'),
(255, 1, 'HRBS', 'tsp'),
(256, 1, 'HRBS', 'tsp'),
(257, 1, 'OTHR', 'lb'),
(258, 1, 'VEGI', 'cup'),
(259, 1, 'VEGI', 'cup'),
(260, 1, 'VEGI', 'cup'),
(261, 1, 'OTHR', 'cup'),
(262, 1, 'OTHR', 'cup'),
(263, 1, 'HRBS', 'tbsp'),
(264, 1, 'OTHR', 'tsp'),
(265, 1, 'OTHR', 'tsp'),
(266, 1, 'MSF', 'unit'),
(267, 1, 'VEGI', 'cup'),
(268, 1, 'OTHR', 'tbsp'),
(269, 1, 'OTHR', 'tsp'),
(270, 1, 'OTHR', 'tsp'),
(271, 1, 'HRBS', 'tsp'),
(272, 1, 'VEGI', 'cup'),
(273, 1, 'VEGI', 'cup'),
(274, 1, 'VEGI', 'cup'),
(275, 1, 'VEGI', 'cup'),
(276, 1, 'VEGI', 'cup'),
(277, 1, 'OTHR', 'tbsp'),
(278, 1, 'OTHR', 'tbsp'),
(279, 1, 'OTHR', 'tsp'),
(281, 1, 'OTHR', 'tsp'),
(282, 1, 'OTHR', 'tsp'),
(283, 1, 'VEGI', 'tbsp'),
(284, 1, 'MSF', 'can'),
(285, 1, 'OTHR', 'cup'),
(286, 1, 'VEGI', 'cup'),
(287, 1, 'VEGI', 'cup'),
(288, 1, 'VEGI', 'cup'),
(289, 1, 'OTHR', 'unit'),
(290, 1, 'OTHR', 'cup'),
(291, 1, 'OTHR', 'tbsp'),
(292, 1, 'OTHR', 'tsp'),
(293, 1, 'MSF', 'lb'),
(294, 1, 'OTHR', 'tbsp'),
(295, 1, 'VEGI', 'cup'),
(296, 1, 'VEGI', 'cup'),
(297, 1, 'VEGI', 'cup'),
(298, 1, 'VEGI', 'cup'),
(299, 1, 'MSF', 'lb'),
(300, 1, 'OTHR', 'tbsp'),
(301, 1, 'OTHR', 'unit'),
(302, 1, 'OTHR', 'tsp'),
(303, 1, 'OTHR', 'tsp'),
(304, 1, 'HRBS', 'tsp'),
(305, 1, 'OTHR', 'cup'),
(306, 1, 'MSF', 'lb'),
(307, 1, 'MSF', 'lb'),
(308, 1, 'VEGI', 'lb'),
(309, 1, 'OTHR', 'unit'),
(310, 1, 'OTHR', 'tbsp'),
(311, 1, 'OTHR', 'tbsp'),
(312, 1, 'OTHR', 'tbsp'),
(313, 1, 'OTHR', 'tsp'),
(314, 1, 'OTHR', 'tsp'),
(315, 1, 'MSF', 'lb'),
(316, 1, 'VEGI', 'unit'),
(317, 1, 'VEGI', 'unit'),
(318, 1, 'OTHR', 'tbsp'),
(319, 1, 'OTHR', 'tsp'),
(320, 1, 'OTHR', 'tsp'),
(321, 1, 'OTHR', 'tsp'),
(322, 1, 'OTHR', 'tsp'),
(323, 1, 'OTHR', 'tsp'),
(324, 1, 'MSF', 'unit');

-- --------------------------------------------------------

--
-- Table structure for table `ingredient_categories`
--

DROP TABLE IF EXISTS `ingredient_categories`;
CREATE TABLE IF NOT EXISTS `ingredient_categories` (
  `id` varchar(4) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `detail` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ingredient_categories`
--

INSERT INTO `ingredient_categories` (`id`, `detail`) VALUES
('EMMP', 'Eggs, milk and milk products'),
('FAO', 'Fats and oils'),
('FRU', 'Fruits'),
('GNBK', 'Grain, nuts and baking products'),
('HRBS', 'Herbs and spices'),
('MSF', 'Meat, sausages and fish'),
('OTHR', 'Others'),
('PRP', 'Pasta, rice and pulses'),
('VEGI', 'Vegetables');

-- --------------------------------------------------------

--
-- Table structure for table `ingredient_measurement_unit`
--

DROP TABLE IF EXISTS `ingredient_measurement_unit`;
CREATE TABLE IF NOT EXISTS `ingredient_measurement_unit` (
  `id` varchar(4) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `detail` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `ingredient_measurement_unit`
--

INSERT INTO `ingredient_measurement_unit` (`id`, `detail`) VALUES
('can', 'can'),
('cup', 'cup'),
('g', 'gram'),
('lb', 'pound'),
('oz', 'ounce'),
('tbsp', 'tablespoon'),
('tsp', 'teaspoon'),
('unit', 'unit');

-- --------------------------------------------------------

--
-- Table structure for table `ingredient_nutritions`
--

DROP TABLE IF EXISTS `ingredient_nutritions`;
CREATE TABLE IF NOT EXISTS `ingredient_nutritions` (
  `id` int NOT NULL,
  `calories` int DEFAULT '0',
  `calcium` int DEFAULT '0',
  `carbohydrate` int DEFAULT '0',
  `cholesterol` int DEFAULT '0',
  `fiber` int DEFAULT '0',
  `iron` int DEFAULT '0',
  `fat` int DEFAULT '0',
  `monounsaturated_fat` int DEFAULT '0',
  `polyunsaturated_fat` int DEFAULT '0',
  `saturated_fat` int DEFAULT '0',
  `potassium` int DEFAULT '0',
  `protein` int DEFAULT '0',
  `sodium` int DEFAULT '0',
  `sugar` int DEFAULT '0',
  `vitamin_a` int DEFAULT '0',
  `vitamin_c` int DEFAULT '0',
  KEY `FK_ingre_nut` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `ingredient_nutritions`
--

INSERT INTO `ingredient_nutritions` (`id`, `calories`, `calcium`, `carbohydrate`, `cholesterol`, `fiber`, `iron`, `fat`, `monounsaturated_fat`, `polyunsaturated_fat`, `saturated_fat`, `potassium`, `protein`, `sodium`, `sugar`, `vitamin_a`, `vitamin_c`) VALUES
(1, 165, 12, 0, 75, 0, 1, 4, 1, 0, 1, 250, 31, 75, 0, 0, 0),
(2, 50, 20, 10, 0, 2, 1, 0, 0, 0, 0, 200, 5, 50, 3, 20, 10),
(3, 10, 2, 1, 0, 0, 0, 0, 0, 0, 0, 50, 1, 200, 2, 0, 0),
(4, 30, 0, 7, 0, 0, 0, 0, 0, 0, 0, 10, 0, 0, 0, 0, 0),
(5, 120, 50, 0, 150, 0, 2, 2, 0, 0, 0, 180, 20, 200, 0, 0, 0),
(6, 15, 20, 3, 0, 1, 0, 0, 0, 0, 0, 120, 1, 5, 1, 10, 15),
(7, 10, 2, 2, 0, 0, 0, 0, 0, 0, 0, 50, 0, 0, 2, 0, 30),
(8, 5, 0, 1, 0, 0, 0, 0, 0, 0, 0, 30, 0, 0, 1, 5, 10),
(9, 100, 80, 20, 0, 5, 2, 0, 0, 0, 0, 500, 7, 200, 1, 10, 0),
(10, 120, 1, 26, 0, 3, 1, 0, 0, 0, 0, 250, 4, 5, 10, 0, 8),
(11, 20, 8, 4, 0, 1, 0, 0, 0, 0, 0, 100, 1, 10, 2, 15, 20),
(12, 5, 16, 0, 0, 0, 0, 0, 0, 0, 0, 50, 1, 0, 0, 10, 15),
(13, 20, 4, 5, 0, 1, 0, 0, 0, 0, 0, 100, 1, 5, 2, 5, 10),
(14, 10, 2, 2, 0, 0, 0, 0, 0, 0, 0, 50, 0, 0, 2, 0, 30),
(15, 120, 0, 0, 0, 0, 14, 1, 10, 2, 1, 0, 0, 0, 0, 0, 0),
(16, 20, 22, 5, 0, 1, 0, 0, 0, 0, 0, 150, 1, 5, 2, 5, 10),
(17, 90, 2, 3, 0, 1, 8, 2, 5, 1, 1, 50, 3, 10, 1, 0, 0),
(18, 5, 2, 1, 0, 0, 0, 0, 0, 0, 0, 10, 0, 0, 0, 0, 0),
(19, 5, 1, 2, 0, 0, 0, 0, 0, 0, 0, 30, 0, 0, 2, 10, 20),
(20, 120, 0, 0, 0, 0, 14, 1, 10, 2, 1, 0, 0, 0, 0, 0, 0),
(26, 5, 0, 1, 0, 0, 0, 0, 0, 0, 0, 10, 0, 100, 1, 0, 0),
(27, 455, 1, 95, 0, 3, 3, 0, 0, 0, 1, 30, 13, 0, 1, 0, 0),
(28, 455, 2, 95, 0, 3, 3, 0, 0, 0, 1, 30, 13, 0, 1, 0, 0),
(29, 70, 12, 0, 185, 0, 5, 2, 1, 2, 70, 6, 70, 0, 0, 0, 0),
(30, 15, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 400, 0, 0, 0),
(31, 227, 25, 41, 0, 15, 4, 1, 0, 0, 0, 740, 15, 1, 0, 0, 0),
(32, 132, 0, 30, 0, 3, 2, 1, 0, 0, 1, 270, 5, 11, 6, 0, 10),
(33, 22, 6, 5, 0, 1, 1, 0, 0, 0, 0, 237, 1, 6, 3, 8, 16),
(34, 10, 4, 2, 0, 0, 0, 0, 0, 0, 0, 60, 0, 1, 2, 0, 5),
(35, 1, 3, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 1, 12),
(36, 234, 10, 12, 0, 10, 21, 15, 3, 3, 3, 708, 3, 11, 0, 4, 20),
(37, 119, 0, 0, 0, 0, 14, 10, 1, 2, 0, 0, 0, 0, 0, 0, 0),
(38, 8, 2, 3, 0, 0, 0, 0, 0, 0, 0, 23, 0, 0, 0, 0, 14),
(39, 4, 2, 1, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 2),
(40, 8, 8, 1, 0, 0, 0, 0, 0, 0, 0, 22, 0, 1, 0, 1, 0),
(41, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(42, 5, 1, 1, 0, 0, 0, 0, 0, 0, 0, 17, 0, 1, 0, 1, 8),
(43, 157, 120, 0, 47, 0, 1, 7, 2, 1, 0, 295, 23, 440, 0, 0, 0),
(44, 72, 25, 0, 186, 0, 5, 2, 2, 2, 1, 63, 6, 71, 0, 5, 0),
(45, 455, 34, 95, 0, 3, 3, 0, 0, 0, 1, 30, 13, 0, 1, 0, 0),
(46, 4, 2, 1, 0, 0, 0, 0, 0, 0, 0, 2, 0, 1, 2, 0, 5),
(47, 11, 14, 2, 0, 1, 0, 0, 0, 0, 0, 79, 1, 6, 0, 0, 133),
(48, 4, 6, 1, 0, 0, 0, 0, 0, 0, 0, 2, 0, 0, 0, 0, 8),
(49, 15, 4, 1, 0, 0, 1, 1, 1, 0, 0, 17, 1, 140, 0, 0, 0),
(50, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(51, 5, 0, 1, 0, 0, 0, 0, 0, 0, 0, 17, 0, 1, 0, 1, 8),
(52, 1927, 0, 0, 0, 0, 218, 14, 31, 186, 20, 0, 0, 0, 0, 0, 0),
(60, 78, 28, 1, 186, 0, 5, 5, 2, 2, 2, 63, 6, 62, 1, 270, 0),
(61, 916, 8, 2, 126, 0, 101, 15, 12, 16, 4, 0, 1, 844, 1, 204, 0),
(62, 3, 5, 1, 0, 0, 0, 0, 0, 0, 0, 3, 0, 57, 0, 6, 0),
(63, 6, 10, 1, 0, 1, 0, 0, 0, 0, 0, 37, 0, 32, 1, 75, 3),
(64, 1, 8, 0, 0, 0, 0, 0, 0, 0, 0, 3, 0, 1, 0, 435, 58),
(65, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1163, 0, 0, 0),
(66, 5, 0, 1, 0, 0, 0, 0, 0, 0, 0, 17, 0, 1, 0, 1, 8),
(72, 90, 20, 21, 0, 2, 1, 1, 0, 0, 0, 620, 2, 15, 1, 0, 19),
(73, 977, 0, 0, 287, 0, 66, 26, 3, 34, 20, 608, 100, 249, 0, 0, 0),
(74, 64, 20, 15, 0, 3, 0, 0, 0, 0, 0, 146, 1, 4, 7, 0, 10),
(75, 4, 13, 1, 0, 0, 0, 0, 0, 0, 0, 5, 0, 1, 0, 1, 3),
(76, 5, 4, 1, 0, 0, 0, 0, 0, 0, 0, 25, 0, 3, 0, 6, 1),
(77, 460, 0, 64, 0, 3, 7, 2, 1, 5, 0, 0, 9, 7, 4, 0, 0),
(78, 102, 3, 0, 31, 0, 12, 7, 5, 0, 0, 0, 3, 0, 82, 0, 491),
(79, 85, 505, 2, 28, 0, 0, 6, 4, 0, 2, 46, 6, 176, 0, 5, 0),
(80, 455, 24, 95, 0, 3, 3, 0, 0, 0, 1, 30, 13, 0, 1, 0, 0),
(81, 431, 416, 4, 123, 0, 0, 28, 11, 2, 7, 138, 32, 1354, 0, 0, 0),
(82, 70, 12, 0, 185, 0, 5, 2, 1, 2, 70, 6, 70, 0, 0, 0, 0),
(83, 5, 28, 1, 0, 0, 0, 0, 0, 0, 0, 19, 0, 1, 0, 3, 0),
(84, 4, 14, 1, 0, 0, 0, 0, 0, 0, 0, 148, 0, 1, 1, 6, 66),
(85, 51, 24, 2, 16, 0, 0, 5, 3, 0, 2, 49, 1, 50, 2, 165, 0),
(86, 43, 0, 0, 10, 0, 0, 4, 1, 2, 2, 43, 3, 137, 0, 0, 0),
(87, 1024, 25, 0, 294, 0, 73, 24, 6, 34, 15, 1319, 158, 343, 0, 0, 0),
(88, 64, 24, 15, 0, 3, 0, 0, 0, 0, 0, 146, 1, 4, 7, 0, 10),
(89, 4, 13, 1, 0, 0, 0, 0, 0, 0, 0, 5, 0, 1, 0, 1, 3),
(90, 119, 0, 0, 0, 0, 14, 10, 1, 0, 2, 0, 0, 0, 0, 0, 0),
(91, 103, 87, 18, 8, 8, 3, 4, 1, 1, 0, 458, 5, 230, 4, 2640, 50),
(92, 23, 33, 1, 1, 0, 0, 1, 0, 0, 0, 107, 1, 14, 0, 8, 0),
(93, 20, 20, 4, 0, 2, 1, 1, 0, 0, 0, 228, 0, 1, 0, 3381, 9),
(94, 90, 88, 6, 0, 2, 1, 0, 0, 0, 0, 190, 2, 380, 4, 2100, 120),
(95, 86, 40, 20, 0, 4, 1, 0, 0, 0, 0, 700, 4, 400, 12, 4200, 300),
(96, 330, 70, 60, 0, 20, 4, 0, 1, 1, 0, 500, 20, 960, 0, 0, 0),
(97, 935, 4, 0, 287, 0, 48, 12, 6, 11, 17, 1200, 101, 275, 0, 0, 0),
(98, 64, 24, 15, 0, 3, 0, 0, 0, 0, 0, 146, 1, 4, 7, 0, 10),
(99, 52, 20, 12, 0, 4, 0, 0, 0, 0, 0, 212, 1, 42, 6, 270, 10),
(100, 78, 20, 17, 0, 3, 1, 0, 0, 0, 0, 214, 1, 1, 3, 0, 5),
(101, 8, 5, 0, 0, 0, 0, 0, 0, 0, 0, 135, 1, 920, 0, 0, 0),
(102, 42, 4, 8, 0, 0, 0, 0, 0, 0, 0, 54, 1, 283, 6, 0, 0),
(103, 120, 0, 0, 0, 0, 14, 10, 1, 0, 2, 0, 0, 0, 0, 0, 0),
(104, 4, 20, 1, 0, 0, 0, 0, 0, 0, 0, 5, 0, 1, 0, 1, 3),
(105, 176, 7, 36, 0, 2, 2, 0, 0, 0, 0, 58, 6, 9, 0, 0, 0),
(106, 352, 4, 93, 0, 5, 0, 0, 0, 0, 0, 0, 1, 2, 85, 0, 0),
(107, 62, 10, 15, 0, 2, 0, 0, 0, 0, 0, 124, 1, 0, 9, 14, 85),
(108, 11, 14, 2, 0, 1, 1, 0, 0, 0, 0, 156, 1, 22, 0, 8427, 133),
(109, 119, 0, 0, 0, 0, 14, 10, 1, 0, 2, 0, 0, 0, 0, 0, 0),
(110, 8, 1, 2, 0, 0, 0, 0, 0, 0, 0, 25, 0, 0, 2, 5, 23),
(111, 4, 1, 1, 0, 0, 0, 0, 0, 0, 0, 11, 0, 0, 0, 0, 7),
(112, 64, 1, 17, 0, 0, 0, 0, 0, 0, 0, 11, 0, 1, 17, 0, 0),
(113, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 2000, 0, 0, 0),
(114, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(118, 1024, 25, 0, 294, 0, 73, 24, 6, 34, 15, 1319, 158, 343, 0, 0, 0),
(119, 430, 44, 77, 0, 4, 6, 5, 1, 2, 1, 94, 13, 948, 4, 0, 0),
(120, 64, 20, 15, 0, 3, 0, 0, 0, 0, 0, 146, 1, 4, 7, 0, 10),
(121, 4, 13, 1, 0, 0, 0, 0, 0, 0, 0, 5, 0, 1, 0, 1, 3),
(122, 19, 9, 5, 0, 0, 0, 0, 0, 0, 0, 61, 0, 155, 4, 60, 0),
(123, 13, 4, 2, 0, 0, 0, 0, 0, 0, 0, 65, 0, 1348, 2, 58, 0),
(124, 72, 25, 0, 186, 0, 5, 2, 2, 2, 1, 69, 6, 71, 0, 244, 0),
(125, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 2000, 0, 0, 0),
(126, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(131, 164, 0, 0, 73, 0, 1, 4, 1, 1, 1, 232, 31, 74, 0, 0, 0),
(132, 16, 37, 3, 0, 2, 0, 0, 0, 0, 0, 104, 0, 80, 2, 449, 3),
(133, 46, 13, 11, 0, 2, 0, 0, 0, 0, 0, 146, 1, 4, 7, 0, 10),
(134, 22, 20, 4, 0, 2, 1, 0, 0, 0, 0, 303, 1, 2, 0, 4210, 133),
(135, 52, 10, 13, 0, 1, 0, 0, 0, 0, 0, 288, 0, 2, 12, 50, 2),
(136, 916, 12, 8, 129, 0, 1, 103, 17, 21, 3, 11, 1, 1023, 8, 0, 2),
(137, 59, 19, 3, 3, 0, 0, 0, 0, 0, 0, 77, 10, 36, 4, 0, 1),
(138, 4, 3, 1, 0, 0, 0, 0, 0, 0, 0, 5, 0, 0, 0, 6, 15),
(139, 21, 9, 1, 0, 0, 1, 1, 0, 0, 0, 47, 1, 140, 0, 5, 1),
(140, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 2000, 0, 0, 0),
(141, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(146, 230, 18, 40, 0, 16, 3, 1, 0, 1, 0, 369, 18, 4, 1, 0, 2),
(147, 269, 50, 45, 0, 13, 5, 4, 1, 2, 1, 477, 15, 15, 0, 0, 0),
(148, 8, 14, 2, 0, 0, 0, 0, 0, 0, 0, 76, 0, 1, 2, 52, 8),
(149, 19, 8, 4, 0, 2, 0, 0, 0, 0, 0, 156, 1, 3, 2, 3427, 152),
(150, 2, 31, 0, 0, 0, 0, 0, 0, 0, 0, 15, 0, 1, 0, 6748, 1),
(151, 4, 10, 1, 0, 0, 0, 0, 0, 0, 0, 38, 0, 2, 0, 525, 8),
(152, 119, 0, 0, 0, 0, 14, 10, 1, 0, 2, 0, 0, 0, 0, 0, 0),
(153, 4, 3, 1, 0, 0, 0, 0, 0, 0, 0, 5, 0, 0, 0, 6, 15),
(154, 21, 9, 1, 0, 0, 1, 1, 0, 0, 0, 47, 1, 140, 0, 5, 1),
(155, 4, 5, 1, 0, 0, 0, 0, 0, 0, 0, 12, 0, 1, 0, 0, 1),
(156, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 2000, 0, 0, 0),
(157, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(158, 554, 97, 2, 590, 0, 12, 12, 2, 0, 2, 214, 111, 420, 0, 0, 11),
(159, 24, 9, 5, 0, 2, 1, 0, 0, 0, 0, 114, 1, 3, 4, 0, 152),
(160, 44, 8, 10, 0, 1, 0, 0, 0, 0, 0, 146, 1, 4, 5, 0, 7),
(161, 4, 5, 1, 0, 0, 0, 0, 0, 0, 0, 5, 0, 1, 0, 1, 3),
(162, 119, 0, 0, 0, 0, 14, 10, 1, 0, 2, 0, 0, 0, 0, 0, 0),
(163, 87, 15, 18, 0, 7, 1, 0, 1, 0, 0, 330, 5, 1780, 1, 3325, 123),
(164, 90, 88, 6, 0, 2, 1, 0, 0, 0, 0, 190, 2, 380, 4, 2100, 120),
(165, 86, 40, 20, 0, 4, 1, 0, 0, 0, 0, 700, 4, 400, 12, 4200, 300),
(166, 220, 3, 43, 0, 2, 2, 1, 0, 0, 0, 29, 8, 3, 0, 0, 0),
(167, 11, 79, 2, 0, 1, 1, 1, 0, 0, 0, 203, 1, 4, 0, 4213, 133),
(168, 165, 8, 0, 84, 0, 1, 4, 1, 1, 1, 256, 31, 74, 0, 20, 0),
(169, 20, 27, 4, 0, 2, 2, 0, 0, 0, 0, 202, 2, 2, 1, 756, 13),
(170, 220, 18, 43, 0, 2, 2, 1, 0, 0, 0, 29, 8, 3, 0, 0, 0),
(171, 99, 73, 2, 28, 0, 0, 10, 6, 2, 0, 58, 1, 221, 1, 1441, 3),
(172, 119, 0, 0, 0, 0, 14, 10, 1, 0, 2, 0, 0, 0, 0, 0, 0),
(173, 22, 138, 1, 8, 0, 0, 1, 1, 0, 0, 50, 2, 168, 0, 169, 0),
(174, 100, 24, 20, 0, 4, 2, 0, 0, 0, 0, 0, 2, 300, 12, 0, 15),
(175, 122, 28, 11, 10, 0, 0, 7, 4, 0, 2, 406, 8, 110, 11, 395, 0),
(176, 440, 305, 2, 120, 0, 0, 37, 16, 1, 22, 61, 26, 700, 1, 25, 0),
(177, 46, 6, 9, 0, 3, 1, 0, 0, 0, 0, 211, 2, 2, 6, 1577, 95),
(178, 46, 7, 11, 0, 2, 0, 0, 0, 0, 0, 116, 2, 2, 5, 28, 9),
(179, 119, 0, 0, 0, 0, 14, 10, 1, 0, 2, 0, 0, 0, 0, 0, 0),
(180, 28, 3, 0, 0, 0, 0, 0, 0, 0, 0, 8, 0, 2, 1, 0, 1),
(181, 15, 0, 0, 0, 0, 1, 1, 0, 0, 0, 0, 11, 1, 177, 0, 3),
(182, 64, 1, 17, 0, 0, 0, 0, 0, 0, 0, 11, 0, 1, 17, 0, 0),
(183, 1, 16, 0, 0, 0, 0, 0, 0, 0, 0, 15, 0, 1, 0, 1548, 42),
(184, 33, 22, 8, 0, 2, 0, 0, 0, 0, 0, 293, 1, 3, 4, 3726, 209),
(185, 222, 31, 39, 0, 3, 4, 4, 1, 2, 0, 318, 8, 13, 0, 0, 0),
(186, 227, 46, 41, 0, 15, 1, 0, 0, 0, 0, 611, 15, 2, 0, 0, 0),
(187, 132, 2, 30, 0, 4, 1, 2, 0, 0, 0, 270, 5, 15, 7, 1006, 0),
(188, 0, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(197, 119, 1, 0, 0, 0, 0, 14, 10, 1, 0, 2, 0, 0, 0, 0, 0),
(198, 64, 23, 15, 0, 2, 0, 0, 0, 0, 0, 146, 2, 4, 6, 0, 12),
(199, 46, 10, 11, 0, 4, 1, 0, 0, 0, 0, 162, 2, 2, 5, 0, 152),
(200, 4, 15, 1, 0, 0, 0, 0, 0, 0, 0, 12, 0, 1, 0, 0, 0),
(201, 218, 46, 40, 0, 15, 2, 1, 0, 0, 0, 0, 594, 14, 6, 0, 0),
(202, 132, 1, 29, 0, 4, 2, 2, 0, 1, 0, 287, 5, 15, 7, 0, 10),
(203, 32, 18, 7, 0, 2, 1, 0, 0, 0, 0, 427, 2, 7, 5, 767, 21),
(204, 20, 2, 5, 0, 2, 0, 1, 0, 0, 0, 76, 0, 322, 1, 2320, 8),
(205, 104, 17, 21, 0, 1, 2, 1, 0, 0, 0, 79, 2, 207, 1, 100, 0),
(206, 5, 18, 1, 0, 0, 0, 0, 0, 0, 0, 22, 0, 5, 0, 1488, 15),
(207, 95, 2, 25, 0, 4, 0, 0, 0, 0, 195, 0, 2, 19, 194, 54, 14),
(208, 6, 4, 1, 0, 1, 0, 0, 0, 0, 104, 0, 32, 1, 78, 3, 4),
(209, 654, 2, 14, 0, 7, 3, 62, 6, 14, 441, 15, 2, 3, 0, 0, 0),
(210, 434, 4, 115, 0, 5, 2, 0, 0, 0, 322, 3, 11, 86, 0, 0, 3),
(211, 59, 19, 4, 10, 0, 0, 0, 0, 0, 61, 10, 36, 4, 0, 0, 1),
(212, 64, 1, 17, 0, 0, 0, 0, 0, 0, 11, 0, 1, 17, 0, 0, 0),
(213, 4, 1, 1, 0, 0, 0, 0, 0, 0, 7, 0, 1, 0, 0, 0, 8),
(214, 119, 1, 0, 0, 0, 0, 14, 10, 1, 0, 2, 0, 0, 0, 0, 0),
(215, 64, 23, 15, 0, 2, 0, 0, 0, 0, 0, 146, 2, 4, 6, 0, 12),
(216, 50, 20, 12, 0, 4, 0, 0, 0, 0, 0, 230, 1, 42, 6, 10191, 7),
(217, 16, 3, 3, 0, 2, 0, 0, 0, 0, 0, 104, 1, 32, 2, 494, 3),
(218, 4, 15, 1, 0, 0, 0, 0, 0, 0, 0, 12, 0, 1, 0, 0, 0),
(219, 678, 37, 115, 0, 58, 7, 1, 1, 3, 0, 955, 48, 8, 4, 0, 6),
(220, 90, 102, 20, 0, 4, 1, 0, 0, 0, 0, 510, 5, 290, 10, 2040, 16),
(221, 3, 1, 1, 0, 0, 0, 0, 0, 0, 0, 15, 0, 942, 0, 0, 0),
(222, 6, 6, 1, 0, 0, 0, 0, 0, 0, 0, 16, 0, 1, 0, 1644, 1),
(223, 220, 3, 43, 0, 2, 2, 1, 0, 0, 0, 68, 8, 1, 2, 0, 0),
(224, 1, 2, 0, 0, 0, 0, 0, 0, 0, 0, 12, 0, 1, 0, 4216, 5),
(225, 22, 21, 0, 5, 0, 1, 0, 1, 0, 0, 20, 2, 76, 0, 63, 0),
(226, 119, 1, 0, 0, 0, 0, 14, 10, 1, 0, 2, 0, 0, 0, 0, 0),
(227, 64, 23, 15, 0, 2, 0, 0, 0, 0, 0, 146, 2, 4, 6, 0, 12),
(228, 46, 10, 11, 0, 4, 1, 0, 0, 0, 0, 162, 2, 2, 5, 0, 152),
(229, 4, 15, 1, 0, 0, 0, 0, 0, 0, 0, 12, 0, 1, 0, 0, 0),
(230, 776, 1, 0, 243, 0, 3, 71, 34, 15, 4, 921, 101, 222, 0, 0, 0),
(231, 32, 18, 7, 0, 2, 1, 0, 0, 0, 0, 427, 2, 7, 5, 767, 21),
(232, 139, 2, 28, 0, 8, 1, 0, 0, 0, 0, 833, 4, 2438, 17, 1316, 42),
(233, 101, 2, 3, 0, 4, 1, 11, 0, 1, 0, 34, 1, 735, 0, 0, 0),
(234, 434, 4, 115, 0, 5, 2, 0, 0, 0, 322, 3, 11, 86, 0, 0, 3),
(235, 8, 33, 1, 0, 1, 0, 0, 0, 0, 0, 22, 0, 1, 0, 0, 0),
(236, 6, 9, 1, 0, 0, 0, 0, 0, 0, 0, 20, 0, 1, 0, 302, 1),
(237, 5, 16, 1, 0, 0, 0, 0, 0, 0, 0, 11, 0, 1, 0, 0, 2),
(238, 6, 8, 2, 0, 0, 0, 0, 0, 0, 0, 14, 0, 1, 0, 2081, 1),
(239, 6, 27, 1, 0, 0, 0, 0, 0, 0, 0, 13, 0, 1, 0, 0, 0),
(240, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(241, 6, 3, 1, 0, 0, 0, 0, 0, 0, 0, 23, 0, 1, 0, 8, 8),
(242, 206, 1, 45, 0, 1, 2, 0, 0, 0, 0, 35, 4, 1, 0, 0, 0),
(243, 1, 2, 0, 0, 0, 0, 0, 0, 0, 0, 12, 0, 1, 0, 4216, 5),
(244, 678, 36, 115, 0, 58, 7, 1, 1, 3, 0, 955, 48, 8, 4, 0, 6),
(245, 32, 18, 7, 0, 2, 1, 0, 0, 0, 0, 427, 2, 7, 5, 767, 21),
(246, 16, 10, 4, 0, 1, 0, 0, 0, 0, 0, 76, 1, 2, 2, 105, 3),
(247, 67, 10, 16, 0, 1, 0, 0, 0, 0, 0, 94, 2, 4, 7, 57, 10),
(248, 396, 287, 4, 150, 0, 0, 32, 22, 1, 14, 100, 21, 1116, 3, 375, 0),
(249, 11, 17, 2, 0, 1, 0, 0, 0, 0, 0, 203, 1, 4, 0, 4216, 5),
(250, 119, 1, 0, 0, 0, 0, 14, 10, 1, 0, 2, 0, 0, 0, 0, 0),
(251, 4, 1, 1, 0, 0, 0, 0, 0, 0, 0, 12, 0, 1, 0, 0, 0),
(252, 8, 1, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 1, 0, 0, 0),
(253, 4, 15, 1, 0, 0, 0, 0, 0, 0, 0, 12, 0, 1, 0, 0, 0),
(254, 5, 16, 1, 0, 0, 0, 0, 0, 0, 0, 11, 0, 1, 0, 0, 2),
(255, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(256, 6, 3, 1, 0, 0, 0, 0, 0, 0, 0, 23, 0, 1, 0, 8, 8),
(257, 350, 120, 64, 25, 4, 10, 3, 1, 2, 2, 100, 15, 780, 3, 0, 0),
(258, 27, 9, 6, 0, 1, 1, 0, 0, 0, 0, 231, 1, 4, 4, 2026, 12),
(259, 7, 30, 1, 0, 1, 0, 0, 0, 0, 0, 167, 1, 24, 0, 2813, 14),
(260, 16, 10, 4, 0, 1, 0, 0, 0, 0, 0, 56, 0, 2, 2, 60, 4),
(261, 119, 1, 0, 0, 0, 0, 14, 10, 1, 0, 2, 0, 0, 0, 0, 0),
(262, 4, 1, 1, 0, 0, 0, 0, 0, 0, 0, 12, 0, 1, 0, 0, 0),
(263, 4, 15, 1, 0, 0, 0, 0, 0, 0, 0, 12, 0, 1, 0, 0, 0),
(264, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(265, 6, 3, 1, 0, 0, 0, 0, 0, 0, 0, 23, 0, 1, 0, 8, 8),
(266, 130, 12, 0, 65, 0, 0, 2, 0, 0, 0, 0, 28, 75, 0, 0, 0),
(267, 20, 10, 4, 0, 1, 1, 0, 0, 0, 0, 254, 2, 5, 2, 481, 35),
(268, 119, 1, 0, 0, 0, 0, 14, 10, 1, 0, 2, 0, 0, 0, 0, 0),
(269, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(270, 6, 3, 1, 0, 0, 0, 0, 0, 0, 0, 23, 0, 1, 0, 8, 8),
(271, 5, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(272, 200, 5, 40, 0, 2, 1, 1, 0, 0, 0, 40, 7, 0, 0, 0, 0),
(273, 22, 2, 5, 0, 1, 0, 0, 0, 0, 0, 218, 1, 6, 3, 0, 20),
(274, 8, 3, 2, 0, 0, 0, 0, 0, 0, 0, 76, 0, 1, 1, 1, 2),
(275, 12, 7, 3, 0, 1, 0, 0, 0, 0, 0, 106, 0, 2, 1, 36, 152),
(276, 37, 1, 2, 0, 0, 0, 4, 0, 0, 0, 8, 0, 285, 0, 0, 0),
(277, 119, 1, 0, 0, 0, 0, 14, 10, 1, 0, 2, 0, 0, 0, 0, 0),
(278, 3, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0),
(279, 5, 0, 0, 0, 0, 0, 0, 0, 0, 0, 10, 0, 60, 0, 0, 0),
(281, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(282, 6, 3, 1, 0, 0, 0, 0, 0, 0, 0, 23, 0, 1, 0, 8, 8),
(283, 1, 5, 0, 0, 0, 0, 0, 0, 0, 0, 39, 0, 1, 0, 0, 1),
(284, 220, 6, 0, 30, 0, 0, 10, 2, 0, 2, 0, 33, 200, 0, 0, 0),
(285, 680, 3, 0, 95, 0, 0, 76, 12, 20, 10, 10, 0, 600, 0, 0, 0),
(286, 6, 4, 1, 0, 1, 0, 0, 0, 0, 0, 104, 0, 88, 1, 6, 3),
(287, 64, 3, 15, 0, 2, 0, 0, 0, 0, 0, 157, 2, 4, 7, 0, 0),
(288, 45, 3, 10, 0, 2, 0, 0, 0, 0, 0, 230, 1, 88, 5, 11070, 7),
(289, 220, 3, 38, 0, 2, 0, 2, 1, 0, 0, 10, 4, 0, 1, 0, 0),
(290, 680, 3, 0, 95, 0, 0, 76, 12, 20, 10, 0, 600, 0, 0, 0, 0),
(291, 50, 0, 13, 0, 0, 0, 0, 0, 0, 0, 0, 0, 200, 12, 0, 0),
(292, 5, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 10, 0, 1, 0, 0),
(293, 84, 6, 0, 182, 0, 0, 2, 0, 0, 0, 0, 18, 145, 0, 0, 0),
(294, 120, 0, 0, 0, 0, 0, 14, 10, 2, 0, 0, 0, 0, 0, 0, 0),
(295, 10, 3, 2, 0, 1, 0, 0, 0, 0, 0, 93, 1, 10, 1, 3533, 40),
(296, 8, 2, 2, 0, 0, 0, 0, 0, 0, 0, 76, 0, 1, 1, 2, 3),
(297, 45, 3, 10, 0, 2, 0, 0, 0, 0, 0, 230, 1, 88, 5, 11070, 7),
(298, 32, 5, 7, 0, 2, 0, 0, 0, 0, 0, 146, 2, 16, 2, 25, 20),
(299, 260, 4, 0, 130, 0, 0, 18, 4, 2, 7, 0, 29, 65, 0, 0, 0),
(300, 119, 1, 0, 0, 0, 0, 14, 10, 1, 0, 2, 0, 0, 0, 0, 0),
(301, 4, 2, 1, 0, 0, 0, 0, 0, 0, 0, 12, 0, 1, 0, 0, 0),
(302, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(303, 6, 3, 1, 0, 0, 0, 0, 0, 0, 0, 23, 0, 1, 0, 8, 8),
(304, 5, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(305, 80, 2, 11, 0, 2, 1, 3, 0, 0, 0, 330, 2, 420, 7, 1250, 20),
(306, 200, 2, 42, 0, 2, 2, 1, 0, 0, 0, 0, 7, 0, 0, 0, 0),
(307, 250, 1, 0, 85, 0, 0, 17, 7, 0, 8, 0, 25, 60, 0, 0, 0),
(308, 31, 10, 7, 0, 3, 1, 0, 0, 0, 0, 259, 2, 6, 3, 690, 16),
(309, 45, 2, 11, 0, 2, 0, 0, 0, 0, 0, 4, 2, 4, 9, 30, 11),
(310, 8, 2, 1, 0, 0, 0, 0, 0, 0, 0, 138, 1, 920, 0, 60, 0),
(311, 120, 0, 0, 0, 0, 0, 14, 2, 7, 2, 0, 0, 0, 0, 0, 0),
(312, 30, 0, 7, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(313, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(314, 6, 3, 1, 0, 0, 0, 0, 0, 0, 0, 23, 0, 1, 0, 8, 8),
(315, 165, 0, 0, 85, 0, 0, 4, 1, 0, 1, 0, 220, 31, 75, 0, 0),
(316, 25, 2, 5, 0, 2, 1, 0, 0, 0, 0, 190, 1, 5, 3, 448, 152),
(317, 45, 2, 11, 0, 2, 0, 0, 0, 0, 0, 0, 4, 2, 4, 9, 30),
(318, 119, 1, 0, 0, 0, 0, 14, 10, 1, 0, 2, 0, 0, 0, 0, 0),
(319, 8, 1, 2, 0, 1, 1, 0, 0, 0, 0, 0, 0, 135, 0, 2950, 2),
(320, 8, 1, 1, 0, 1, 0, 0, 0, 0, 0, 0, 0, 10, 0, 400, 1),
(321, 10, 0, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(322, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(323, 6, 3, 1, 0, 0, 0, 0, 0, 0, 0, 23, 0, 1, 0, 8, 8),
(324, 70, 2, 12, 0, 1, 1, 1, 0, 0, 0, 0, 40, 2, 220, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `recipes`
--

DROP TABLE IF EXISTS `recipes`;
CREATE TABLE IF NOT EXISTS `recipes` (
  `user_id` int NOT NULL,
  `recipe_id` int NOT NULL AUTO_INCREMENT,
  `isActive` tinyint(1) DEFAULT '1',
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `image_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `preparation_time` int DEFAULT NULL,
  `cooking_time` int DEFAULT NULL,
  `directions` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `course` int NOT NULL,
  `meal` int NOT NULL,
  `method` int NOT NULL,
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`recipe_id`,`user_id`) USING BTREE,
  KEY `recipes_ibfk_2` (`meal`),
  KEY `recipes_ibfk_3` (`method`),
  KEY `recipes_ibfk_4` (`user_id`),
  KEY `recipes_ibfk_1` (`course`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `recipes`
--

INSERT INTO `recipes` (`user_id`, `recipe_id`, `isActive`, `name`, `description`, `image_url`, `preparation_time`, `cooking_time`, `directions`, `course`, `meal`, `method`, `timestamp`) VALUES
(1, 1, 1, 'Chicken Stir Fry', 'Delicious chicken stir fry with mixed vegetab', 'huyzh3gb.png', 15, 20, '1. Marinate chicken with soy sauce and cornstarch.\n2. Stir fry chicken until cooked.\n3. Add mixed vegetables and stir fry until tender.\n4. Serve hot with rice.', 1, 1, 1, '2024-03-21 09:16:24'),
(1, 2, 1, 'Cucumber and Shrimp Aguachile', ' Delicious chicken stir fry with mixed vegetabw', '07thgnst.jpg', 15, 10, '1. Clean and devein shrimp.\r\n2. Slice cucumbers thinly.\r\n3. Mix shrimp, cucumber slices, lime juice, and chili peppers in a bowl.\r\n4. Let marinate in the refrigerator for 15 minutes.\r\n5. Serve chilled.', 2, 2, 3, '2024-03-21 09:16:24'),
(3, 3, 1, 'chieck', 'taodeptrai', '07thgnst.jpg', 43, 24, '1. Clean and devein shrimp.\n2. Slice cucumbers thinly.\n3. Mix shrimp, cucumber slices, lime juice, and chili peppers in a bowl.\n4. Let marinate in the refrigerator for 15 minutes.\n5. Serve chilled.', 2, 1, 6, '2024-03-21 10:07:19'),
(1, 4, 1, 'Baba Ganoush', 'Roasted eggplant mash with tahini, lemon juice, olive oil, and garlic.', 'yzpvtzq8.png', 30, 15, '1. Roast eggplant in the oven until tender and blackened.\n2. Scoop out the flesh and mash it with tahini, lemon juice, olive oil, and garlic.\n3. Season with salt and pepper to taste.\n4. Serve with pita bread or vegetables.', 1, 1, 7, '2024-03-21 09:16:24'),
(1, 5, 1, 'Crispy Cajun Pickle Chips', 'Delicious crispy Cajun-flavored pickle chips, perfect as a snack or side dish.', '09aa3u2j.jpg', 10, 20, '1. Preheat the oven to 400°F (200°C).\n2. Slice the pickles into thin chips.\n3. In a bowl, mix flour, Cajun seasoning, and breadcrumbs.\n4. Dip pickle chips in beaten egg, then coat with breadcrumb mixture.\n5. Place coated pickle chips on a baking sheet.\n6. Bake in the preheated oven until golden brown and crispy, about 15-20 minutes.\n7. Serve hot and enjoy!', 3, 3, 4, '2024-03-21 09:16:24'),
(1, 6, 1, 'Black Bean and Corn Salad', 'A refreshing salad featuring black beans and sweet corn, perfect for a healthy side dish or light meal.', '7volhb7v.jpg', 15, 24, '1. In a large bowl, combine black beans, corn, diced tomatoes, diced red onion, chopped cilantro, and avocado.\n2. In a small bowl, whisk together olive oil, lime juice, minced garlic, cumin, salt, and pepper to make the dressing.\n3. Pour the dressing over the salad ingredients and toss gently to coat.\n4. Chill the salad in the refrigerator for at least 30 minutes before serving.\n5. Serve cold and enjoy!', 3, 2, 3, '2024-03-21 09:16:24'),
(1, 7, 1, 'Salmon Patties', 'Delicious and flavorful salmon patties, perfect for a light meal or appetizer.', '4cm7v3yn.png', 15, 15, '1. Drain and flake the canned salmon.\n2. In a mixing bowl, combine flaked salmon, beaten eggs, breadcrumbs, diced onion, chopped parsley, lemon juice, Dijon mustard, salt, and pepper.\n3. Mix well until thoroughly combined.\n4. Form the mixture into patties of desired size.\n5. Heat oil in a skillet over medium heat.\n6. Fry the salmon patties until golden brown and cooked through, about 3-4 minutes per side.\n7. Remove from the skillet and drain on paper towels.\n8. Serve hot with your favorite dipping sauce or side dishes.', 1, 3, 4, '2024-03-21 09:16:24'),
(4, 8, 1, 'Homemade Ratatouille', 'This delicious summer vegetable stew is truly something. If you love fresh vegetables, grab them from your farmer’s market and plan on making this best ratatouille recipe ASAP. It’s rich and satisfying, yet wonderfully healthy. Be sure to pick up French bread to go with this iconic French dish!', '4cm7v3yn.png', 14, 24, '1. Drain and flake the canned salmon.\n2. In a mixing bowl, combine flaked salmon, beaten eggs, breadcrumbs, diced onion, chopped parsley, lemon juice, Dijon mustard, salt, and pepper.\n3. Mix well until thoroughly combined.\n4. Form the mixture into patties of desired size.\n5. Heat oil in a skillet over medium heat.\n6. Fry the salmon patties until golden brown and cooked through, about 3-4 minutes per side.\n7. Remove from the skillet and drain on paper towels.\n8. Serve hot with your favorite dipping sauce or side dishes.', 1, 2, 7, '2024-03-21 10:09:07'),
(1, 9, 1, 'Egg Salad', 'A simple and tasty egg salad, perfect for sandwiches or as a side dish.', 'ojyw9t2p.jpg', 10, 10, '1. Boil the eggs until hard-cooked, then peel and chop them.\n2. In a mixing bowl, combine the chopped eggs, mayonnaise, mustard, diced celery, chopped chives, salt, and pepper.\n3. Mix well until all ingredients are evenly distributed.\n4. Refrigerate the egg salad for at least 30 minutes before serving to allow the flavors to meld.\n5. Serve as a sandwich filling, on crackers, or as a side dish. Enjoy!', 3, 1, 1, '2024-03-21 09:16:24'),
(2, 10, 1, 'The Perfect Medium Steak Recipe', 'My family loves it when I make their steaks medium. They come out just right and if you blindfolded us, we’d never believe we were eating steaks cooked at home. This is how you make steak if you want it to taste like those big steakhouses do it!', 'rare-steak-recipejpg.jpg', 21, 42, 'After patting your steaks dry, season them with the salt and pepper on both sides. Heat your cast iron skillet with your oil over medium-high, then pop the steaks in when the oil is hot. Sear for 3 to 4 minutes per side and don’t forget the edges (about a minute on those). Turn heat down to medium and add the butter, herbs, and garlic, spooning that sauce over the steaks until the internal temperature is 135F. Remove from heat and cover for 10 minutes to let them rest and arrive at a perfect medium steak temperature of 145F.', 1, 4, 2, '2024-03-21 10:14:58'),
(1, 11, 1, 'Triangles with Potato and Beef', 'Delicious triangles filled with a savory mixture of potatoes and beef, perfect as a snack or appetizer.', '3z66ao3w.jpg', 30, 40, '1. Boil the potatoes until tender, then mash them.\n2. In a skillet, cook the ground beef until browned. Drain excess fat.\n3. Add onion, garlic, and spices to the skillet with the beef. Cook until onion is softened.\n4. Combine the mashed potatoes with the cooked beef mixture.\n5. Lay out the phyllo pastry sheets and cut them into triangles.\n6. Place a spoonful of the potato and beef mixture onto each triangle.\n7. Fold the pastry over the filling to form a triangle shape.\n8. Brush the triangles with melted butter.\n9. Bake in a preheated oven at 375°F (190°C) until golden brown, about 20-25 minutes.\n10. Serve hot and enjoy!', 2, 3, 7, '2024-03-21 09:16:24'),
(1, 12, 1, 'Cheese Sticks', 'Delicious crispy cheese sticks, perfect as an appetizer or snack.', 'd2gol6y5.jpg', 15, 20, '1. Preheat the oven to 375°F (190°C).\n2. Cut the cheese into sticks.\n3. In a bowl, whisk together breadcrumbs, grated Parmesan cheese, and Italian seasoning.\n4. Dip each cheese stick in beaten egg, then coat with breadcrumb mixture.\n5. Place coated cheese sticks on a baking sheet lined with parchment paper.\n6. Bake in the preheated oven until golden brown and crispy, about 15-20 minutes.\n7. Serve hot with marinara sauce for dipping, if desired.', 3, 2, 6, '2024-03-21 09:16:24'),
(1, 13, 1, 'Jalapeno Bites', 'Spicy jalapeno bites stuffed with cheese, perfect as an appetizer or snack.', 'sc6daczv.jpg', 20, 15, '1. Preheat the oven to 375°F (190°C).\n2. Cut jalapenos in half lengthwise and remove seeds.\n3. Fill each jalapeno half with cream cheese.\n4. Wrap each jalapeno with a slice of bacon.\n5. Place jalapeno bites on a baking sheet lined with parchment paper.\n6. Bake in the preheated oven until bacon is crispy and jalapenos are tender, about 15 minutes.\n7. Serve hot and enjoy!', 3, 1, 7, '2024-03-21 09:16:24'),
(1, 14, 1, 'Turkey Chili', 'Hearty and flavorful chili made with ground turkey, beans, and spices.', 'jthgyiwv.png', 15, 30, '1. Heat olive oil in a large pot over medium heat.\n2. Add diced onions and garlic, cook until softened.\n3. Add ground turkey, cook until browned.\n4. Stir in chili powder, cumin, and paprika.\n5. Add diced tomatoes, tomato sauce, and kidney beans.\n6. Season with salt and pepper to taste.\n7. Simmer for 20-25 minutes, stirring occasionally.\n8. Serve hot with your favorite toppings and enjoy!', 2, 2, 2, '2024-03-21 09:16:24'),
(1, 15, 1, 'Chicken Lettuce Cups', 'Delicious and light chicken lettuce cups filled with seasoned chicken, vegetables, and sauces.', 'tcoq4nha.png', 20, 15, '1. Heat olive oil in a pan over medium heat.\n2. Add minced chicken and cook until no longer pink.\n3. Stir in diced onions, carrots, and water chestnuts. Cook until vegetables are tender.\n4. Add soy sauce, hoisin sauce, and sesame oil. Stir to combine.\n5. Season with salt and pepper to taste.\n6. Spoon chicken mixture into lettuce leaves.\n7. Garnish with chopped green onions and serve.\n8. Enjoy!', 3, 3, 4, '2024-03-21 09:16:24'),
(1, 16, 1, 'Couscous Cranberry Orange Salad', 'A refreshing and colorful salad made with couscous, cranberries, oranges, and a citrus dressing.', 'zwgwp0gk.png', 15, 10, '1. Cook couscous according to package instructions. Let it cool.\n2. In a large bowl, combine cooked couscous, dried cranberries, orange segments, and chopped parsley.\n3. In a small bowl, whisk together olive oil, orange juice, lemon juice, honey, salt, and pepper to make the dressing.\n4. Pour the dressing over the salad and toss gently to combine.\n5. Chill in the refrigerator for at least 30 minutes before serving.\n6. Serve chilled and enjoy!', 2, 2, 2, '2024-03-21 09:16:24'),
(2, 17, 1, 'Classic Baklava Recipe', 'Baklava holds a special place in my heart for my husband and I traveled through Europe prior to kids and enjoyed this sweet and delicious dessert together. With crispy phyllo soaked in honey and an aroma that smells like heaven, this Baklava recipe is one of my favorite desserts to make the day before any gathering because it keeps well and impresses everyone.', 'tcoq4nha.png', 234, 24, '1. Heat olive oil in a large pot over medium heat.', 3, 2, 4, '2024-03-21 10:10:01'),
(1, 18, 1, 'Turkey Meatloaf', 'A healthier version of classic meatloaf made with lean ground turkey, breadcrumbs, and savory seasonings.', '4p4tb5jj.png', 15, 60, '1. Preheat the oven to 350°F (175°C). Grease a loaf pan.\n2. In a large bowl, mix together ground turkey, breadcrumbs, chopped onion, minced garlic, ketchup, Worcestershire sauce, egg, salt, and pepper until well combined.\n3. Transfer the mixture into the prepared loaf pan, and shape it into a loaf.\n4. Bake in the preheated oven for 45-50 minutes, or until the internal temperature reaches 165°F (75°C).\n5. Let the meatloaf rest for a few minutes before slicing.\n6. Serve slices of meatloaf with your favorite side dishes and enjoy!', 1, 2, 1, '2024-03-21 09:16:24'),
(1, 19, 1, 'The Best Traditional Chili Recipe', 'For the best chili recipe ever, you want something that takes easy-to-find ingredients and puts it all together in one pot. The recipe calls for stove top cooking though you could easily prep this and throw it in your slow cooker or instant pot to come home to after a long day. All you’ll need are some sides and you’ll be golden!', 'Chili-recipe.jpg', 2, 42, 'Making homemade chili is quite simple. You’ll first need to cook the onions and garlic. Then you’ll add your beef and cook it through. You’ll finally add the peppers and seasonings, stirring it together to get that beautiful flavor together. There is nothing like a real homemade chili recipe to warm you up on a cold day.\r\n\r\nAfter that, you can choose to drain away fat or leave it in for a fuller flavor before adding in the rest of the ingredients and letting it simmer until you can’t stand salivating over the aroma any longer!', 2, 4, 4, '2024-03-21 10:12:36'),
(1, 20, 1, 'Chicken Salad', 'A refreshing salad made with cooked chicken, fresh vegetables, and a creamy dressing.', '3qbxni96.png', 15, 10, '1. In a large bowl, combine cooked chicken, diced celery, diced red onion, chopped fresh parsley, and halved grapes.\n2. In a separate small bowl, mix together mayonnaise, Greek yogurt, lemon juice, Dijon mustard, salt, and pepper to make the dressing.\n3. Pour the dressing over the chicken mixture and toss until well coated.\n4. Serve the chicken salad chilled over a bed of lettuce or in sandwiches, wraps, or on crackers.', 3, 2, 6, '2024-03-21 09:16:24'),
(1, 21, 1, 'Lentil Garbanzo Salad', 'A nutritious salad made with lentils, garbanzo beans, fresh vegetables, and a tangy vinaigrette dressing.', '406g4sbo.png', 20, 10, '1. In a large bowl, combine cooked lentils, drained and rinsed garbanzo beans, diced cucumber, diced red bell pepper, chopped fresh cilantro, and sliced green onions.\n2. In a separate small bowl, whisk together olive oil, lemon juice, Dijon mustard, minced garlic, salt, and pepper to make the dressing.\n3. Pour the dressing over the lentil mixture and toss until well coated.\n4. Serve the salad chilled or at room temperature.', 1, 3, 7, '2024-03-21 09:16:24'),
(1, 22, 1, 'Chickpea and Quinoa Salad', 'A nutritious and delicious salad made with chickpeas, quinoa, and fresh vegetables.', '1l44ovlv.png', 20, 15, '1. Cook quinoa according to package instructions and let it cool.\n2. In a large bowl, combine cooked quinoa, chickpeas, diced cucumber, cherry tomatoes, diced red onion, chopped parsley, and crumbled feta cheese.\n3. In a small bowl, whisk together olive oil, lemon juice, garlic, salt, and pepper to make the dressing.\n4. Pour the dressing over the salad and toss until well combined.\n5. Serve chilled or at room temperature and enjoy!', 2, 3, 3, '2024-03-21 09:16:24'),
(1, 23, 1, 'Cajun Shrimp Pasta', 'Spicy and flavorful pasta dish with Cajun-seasoned shrimp and vegetables.', '2mn2lz7t.png', 20, 20, '1. Cook pasta according to package instructions.\n2. In a large skillet, heat olive oil over medium heat.\n3. Add shrimp and Cajun seasoning, cook until shrimp are pink and cooked through.\n4. Remove shrimp from skillet and set aside.\n5. In the same skillet, add bell peppers, onions, and garlic, cook until softened.\n6. Stir in diced tomatoes, tomato sauce, and cooked pasta.\n7. Add cooked shrimp back to the skillet and toss everything together.\n8. Serve hot and garnish with chopped parsley if desired.', 2, 2, 2, '2024-03-21 09:16:24'),
(1, 24, 1, 'Ziti with Chicken and Asparagus', 'Delicious pasta dish with tender chicken, fresh asparagus, and ziti pasta.', '732bxaw4.png', 15, 25, '1. Cook pasta according to package instructions.\n2. In a large skillet, heat olive oil over medium heat.\n3. Add diced chicken breast, cook until browned and cooked through.\n4. Remove chicken from skillet and set aside.\n5. In the same skillet, add asparagus spears and cook until tender.\n6. Stir in cooked pasta, chicken, and Alfredo sauce.\n7. Season with salt and pepper to taste.\n8. Serve hot and garnish with grated Parmesan cheese if desired.', 1, 2, 1, '2024-03-21 09:16:24'),
(2, 25, 1, 'Homemade Lemon Curd Recipe', 'Lemon curd is delicious, no doubt about it. But making it yourself is better than anything you’ve ever had. Trust me here, once you make it, you’ll find any excuse to make it again and again!', 'Lemon-curd-recipe.jpg', 22, 42, 'You want to place a saucepan of simmering water over medium/medium-low heat and put a heatproof bowl on top of that for a double-broiler effect. Put the egg yolks, sugar, lemon juice, zest, and salt into the heatproof bowl, whisking until thoroughly blended. Keep whisking constantly to keep the yolks from curdling, until the mixture thickens and is like hollandaise sauce in consistency, roughly 10 to 12 minutes. Then take it from the heat. Cut the butter into pieces and whisk it into your lemon curd, then pour it into a glass jar or bowl, add plastic wrap that touches the curd on top and let it cool completely before serving.', 3, 1, 7, '2024-03-21 10:12:36'),
(4, 26, 1, 'Classic New Orleans Gumbo Recipe', 'This is the best gumbo recipe because it’s made with wholesome ingredients. If you’ve ever bought those box kits to make a simple gumbo recipe at home, you can now toss the box and make it fresh yourself.', 'gumbo-recipe.jpg', 24, 15, 'I know the ingredient list looks a little daunting. I’ll admit, it’s long, however, you should have most of those ingredients in your pantry and fridge to begin with so it will all come together quite easily. It does take an hour to prepare but that’s mostly chopping and such. In the end, you get to put your feet up and enjoy the rest of your day off, soon to be better with a bowl full of shrimp and sausage gumbo!', 2, 2, 7, '2024-03-21 10:13:40'),
(1, 27, 1, 'Marinara Mac & Cheese', 'Creamy macaroni and cheese with marinara sauce.', 'xwhgnizp.png', 15, 30, '1. Cook macaroni according to package instructions. Drain and set aside.\n2. In a saucepan, melt butter over medium heat. Stir in flour until smooth. Gradually add milk, stirring constantly until thickened.\n3. Add shredded cheese and stir until melted and smooth.\n4. Mix in cooked macaroni until well coated.\n5. Serve hot topped with marinara sauce and enjoy!', 1, 2, 6, '2024-03-21 09:16:24'),
(1, 28, 1, 'Vegetable Salad with White Beans', 'A refreshing salad made with fresh vegetables and white beans, tossed in a tangy vinaigrette dressing.', 'yhzfq39e.png', 10, 10, '1. In a large mixing bowl, combine white beans, cherry tomatoes, sliced cucumber, diced red bell pepper, and sliced red onion.\n2. In a small bowl, whisk together olive oil, red wine vinegar, Dijon mustard, honey, and chopped fresh parsley to make the dressing.\n3. Pour the dressing over the salad ingredients and toss gently to coat.\n4. Season with salt and pepper to taste.\n5. Serve chilled.\n6. Enjoy!', 2, 2, 1, '2024-03-21 09:16:24'),
(1, 29, 1, 'Vegetarian Stuffed Peppers', 'Delicious vegetarian dish with bell peppers stuffed with a flavorful quinoa and vegetable mixture.', '7toae0nn.png', 10, 20, '1. Preheat the oven to 375°F (190°C).\n2. Cut the tops off the bell peppers and remove the seeds and membranes.\n3. In a large bowl, mix together cooked quinoa, black beans, corn kernels, and chopped cilantro.\n4. Stuff each bell pepper with the quinoa mixture.\n5. Place the stuffed peppers in a baking dish.\n6. Cover the baking dish with aluminum foil and bake for 25-30 minutes, or until the peppers are tender.\n7. Remove the foil and bake for an additional 5 minutes to brown the tops.\n8. Serve hot and enjoy!', 3, 2, 6, '2024-03-21 09:16:24'),
(1, 30, 1, 'Vegetarian Tacos', 'Delicious vegetarian tacos filled with black beans, corn, and bell peppers.', 'ij0zi3nq.png', 15, 20, '1. Heat olive oil in a skillet over medium heat.\n2. Add diced onions, bell peppers, and minced garlic. Cook until softened.\n3. Stir in black beans, corn, diced tomatoes, and taco seasoning. Cook for 5-7 minutes.\n4. Warm tortillas in a separate skillet.\n5. Spoon the bean mixture onto each tortilla.\n6. Top with shredded lettuce.\n7. Serve hot and enjoy!', 1, 1, 7, '2024-03-21 09:16:24'),
(1, 31, 1, 'Vegetarian Waldorf Salad', 'A refreshing and crunchy salad with apples, celery, walnuts, and a creamy dressing.', 'ol58rjg6.png', 15, 10, '1. In a large bowl, combine diced apples, sliced celery, chopped walnuts, and raisins.\n2. In a separate bowl, mix together Greek yogurt, honey, and lemon juice to make the dressing.\n3. Pour the dressing over the salad ingredients and toss until evenly coated.\n4. Serve chilled and enjoy!', 1, 1, 7, '2024-03-21 09:16:24'),
(1, 32, 1, 'Lentil Bolognese', 'A hearty and flavorful vegetarian version of the classic Bolognese sauce made with lentils and tomatoes.', '6mvjq4pk.png', 15, 30, '1. Heat olive oil in a large skillet over medium heat.\n2. Add diced onions, carrots, and celery. Cook until softened.\n3. Stir in minced garlic and cook for another minute.\n4. Add dried lentils, crushed tomatoes, vegetable broth, and Italian seasoning. Bring to a simmer.\n5. Cover and cook for about 20 minutes, or until lentils are tender.\n6. Serve over cooked pasta of your choice.\n7. Garnish with fresh parsley and grated Parmesan cheese if desired.\n8. Enjoy!', 3, 2, 7, '2024-03-21 09:16:24'),
(1, 33, 1, 'Picadillo', 'A traditional Latin American dish made with ground beef, tomatoes, and spices, often served with rice.', '2x1l3hjm.png', 15, 25, '1. Heat olive oil in a skillet over medium heat.\n2. Add diced onions, bell peppers, and minced garlic. Cook until softened.\n3. Add ground beef and cook until browned.\n4. Stir in diced tomatoes, tomato sauce, olives, raisins, and spices.\n5. Simmer for about 15 minutes, or until the flavors meld together.\n6. Serve hot with rice or as desired.\n7. Enjoy!', 3, 2, 5, '2024-03-21 09:16:24'),
(1, 34, 1, 'Mediterranean Lentil Salad', 'A refreshing and nutritious salad featuring lentils, tomatoes, cucumbers, and feta cheese, dressed with a tangy vinaigrette.', 'rjxi9tip.png', 20, 15, '1. Cook lentils according to package instructions. Drain and let cool.\n2. In a large mixing bowl, combine cooked lentils, diced tomatoes, diced cucumbers, chopped red onion, crumbled feta cheese, and chopped parsley.\n3. In a small bowl, whisk together olive oil, lemon juice, red wine vinegar, minced garlic, dried oregano, salt, and black pepper to make the dressing.\n4. Pour the dressing over the salad and toss gently to coat.\n5. Serve immediately or refrigerate for later.\n6. Enjoy!', 2, 3, 5, '2024-03-21 09:16:24'),
(1, 35, 1, 'Spring Tortellini Salad', 'A vibrant salad featuring cheese tortellini, cherry tomatoes, baby spinach, and a lemon vinaigrette.', 'sltvrsun.png', 15, 10, '1. Cook tortellini according to package instructions. Drain and let cool.\n2. In a large mixing bowl, combine cooked tortellini, halved cherry tomatoes, baby spinach leaves, and sliced red onions.\n3. In a small bowl, whisk together olive oil, lemon juice, minced garlic, salt, and black pepper to make the dressing.\n4. Pour the dressing over the salad and toss gently to coat.\n5. Serve immediately or refrigerate for later.\n6. Enjoy!', 2, 3, 5, '2024-03-21 09:16:24'),
(1, 36, 1, 'Turkey Cutlets with Zucchini', 'Juicy turkey cutlets served with sautéed zucchini, perfect for a quick and healthy dinner.', 'b32b2i8s.png', 15, 15, '1. Season turkey cutlets with salt, pepper, and Italian seasoning.\n2. Heat olive oil in a skillet over medium-high heat.\n3. Cook turkey cutlets for 3-4 minutes per side, or until cooked through.\n4. Remove turkey cutlets from skillet and set aside.\n5. In the same skillet, add sliced zucchini and cook until tender.\n6. Serve turkey cutlets with sautéed zucchini.\n7. Enjoy!', 1, 3, 5, '2024-03-21 09:16:24'),
(1, 37, 1, 'Pasta Salad', 'A refreshing pasta salad packed with veggies, perfect for picnics and gatherings.', '3697vtqo.png', 20, 10, '1. Cook pasta according to package instructions.\n2. In a large bowl, combine cooked pasta, cherry tomatoes, cucumber, bell pepper, olives, and feta cheese.\n3. In a small bowl, whisk together olive oil, lemon juice, garlic, salt, and pepper to make the dressing.\n4. Pour dressing over pasta salad and toss to coat.\n5. Refrigerate for at least 30 minutes before serving.\n6. Enjoy!', 3, 2, 2, '2024-03-21 09:16:24'),
(1, 38, 1, 'Carrot Tortilla with Tuna Spread', 'A flavorful tortilla wrap filled with tuna spread and shredded carrots.', '8ni9iwg3.png', 10, 10, '1. In a bowl, mix together canned tuna, mayonnaise, chopped celery, and diced onions to make the tuna spread.\n2. Place a tortilla on a flat surface and spread the tuna mixture evenly on top.\n3. Sprinkle shredded carrots over the tuna spread.\n4. Roll up the tortilla tightly.\n5. Slice the rolled tortilla into halves or quarters.\n6. Serve and enjoy!', 3, 3, 7, '2024-03-21 09:16:24'),
(1, 39, 1, 'Bang Bang Shrimp Salad', 'A delicious salad featuring crispy shrimp tossed in a spicy mayo-based dressing.', 'fytwb94c.png', 20, 10, '1. In a bowl, mix together mayonnaise, sweet chili sauce, and Sriracha to make the dressing.\n2. Heat oil in a skillet over medium heat. Season shrimp with salt and pepper, then cook until golden brown and crispy, about 2-3 minutes per side.\n3. In a large bowl, toss mixed greens, sliced cucumbers, shredded carrots, and chopped green onions.\n4. Add cooked shrimp to the salad and drizzle with the prepared dressing.\n5. Toss everything together until evenly coated.\n6. Serve immediately and enjoy!', 2, 1, 1, '2024-03-21 09:16:24'),
(1, 40, 1, 'Penne with Turkey', 'Delicious penne pasta served with seasoned turkey in a savory sauce.', 'o61vl6ja.png', 15, 20, '1. Cook penne pasta according to package instructions until al dente. Drain and set aside.\n2. In a skillet, heat olive oil over medium heat. Add minced garlic and cook until fragrant.\n3. Add ground turkey to the skillet and cook until browned.\n4. Season turkey with salt, pepper, and Italian seasoning.\n5. Pour marinara sauce over the turkey and let simmer for 5 minutes.\n6. Add cooked penne to the skillet and toss until pasta is evenly coated with the sauce.\n7. Serve hot and enjoy!', 3, 3, 7, '2024-03-21 09:16:24'),
(1, 41, 1, 'Beef and Beans Stir Fry', 'A flavorful stir-fry dish made with tender beef and crisp beans, perfect for a quick and satisfying dinner.', '24ks0fis.png', 15, 20, '1. In a bowl, marinate beef slices with soy sauce, sesame oil, and cornstarch for 15 minutes.\n2. Heat oil in a wok or skillet over high heat.\n3. Add marinated beef and stir-fry until browned. Remove beef from the wok and set aside.\n4. In the same wok, add sliced onions and cook until softened.\n5. Add green beans and stir-fry until tender-crisp.\n6. Return beef to the wok and stir to combine with the vegetables.\n7. Season with salt, pepper, and any additional soy sauce if needed.\n8. Serve hot and enjoy!', 2, 2, 1, '2024-03-21 09:16:24'),
(1, 42, 1, 'Air Fryer Fajitas', 'Quick and easy fajitas made in the air fryer, packed with flavor and perfect for a weeknight dinner.', 'ngsd8sgb.png', 15, 20, '1. Preheat the air fryer to 400°F (200°C).\n2. Slice bell peppers and onions into strips.\n3. In a bowl, toss sliced bell peppers and onions with olive oil, chili powder, cumin, garlic powder, salt, and black pepper.\n4. Place the seasoned vegetables in the air fryer basket.\n5. Cook in the air fryer for 10-12 minutes, shaking the basket halfway through, until vegetables are tender and slightly charred.\n6. While vegetables are cooking, slice chicken breasts into strips.\n7. In another bowl, toss chicken strips with olive oil, chili powder, cumin, garlic powder, salt, and black pepper.\n8. Once the vegetables are done, remove them from the air fryer and set aside.\n9. Place the seasoned chicken strips in the air fryer basket.\n10. Cook in the air fryer for 8-10 minutes, shaking the basket halfway through, until chicken is cooked through.\n11. Serve the cooked chicken and vegetables in warm tortillas.\n12. Garnish with toppings such as salsa, sour cream, guacamole, and cilantro.\n13. Enjoy your air fryer fajitas!', 3, 3, 7, '2024-03-21 09:16:24');

-- --------------------------------------------------------

--
-- Table structure for table `recipe_course_categories`
--

DROP TABLE IF EXISTS `recipe_course_categories`;
CREATE TABLE IF NOT EXISTS `recipe_course_categories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `type_name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `recipe_course_categories`
--

INSERT INTO `recipe_course_categories` (`id`, `type_name`) VALUES
(1, 'Breakfast'),
(2, 'Lunch'),
(3, 'Dinner');

-- --------------------------------------------------------

--
-- Table structure for table `recipe_ingredient`
--

DROP TABLE IF EXISTS `recipe_ingredient`;
CREATE TABLE IF NOT EXISTS `recipe_ingredient` (
  `ingredient_id` int NOT NULL,
  `recipe_id` int NOT NULL,
  `quanity` int DEFAULT NULL,
  KEY `ingredient_id` (`ingredient_id`),
  KEY `recipe_id` (`recipe_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `recipe_ingredient`
--

INSERT INTO `recipe_ingredient` (`ingredient_id`, `recipe_id`, `quanity`) VALUES
(1, 1, 300),
(2, 1, 200),
(3, 1, 2),
(4, 1, 1),
(5, 2, 150),
(6, 2, 1),
(7, 2, 2),
(8, 2, 1),
(16, 4, 2),
(17, 4, 2),
(18, 4, 2),
(19, 4, 2),
(20, 4, 2),
(26, 5, 4),
(27, 5, 1),
(28, 5, 1),
(29, 5, 1),
(30, 5, 2),
(31, 6, 2),
(32, 6, 1),
(33, 6, 1),
(34, 6, 1),
(35, 6, 1),
(36, 6, 1),
(37, 6, 3),
(38, 6, 2),
(39, 6, 1),
(40, 6, 1),
(41, 6, 1),
(42, 6, 1),
(43, 7, 1),
(44, 7, 2),
(45, 7, 1),
(46, 7, 1),
(47, 7, 1),
(48, 7, 1),
(49, 7, 1),
(50, 7, 1),
(51, 7, 1),
(52, 7, 1),
(60, 9, 6),
(61, 9, 1),
(62, 9, 1),
(63, 9, 1),
(64, 9, 2),
(65, 9, 1),
(66, 9, 1),
(72, 11, 2),
(73, 11, 1),
(74, 11, 1),
(75, 11, 2),
(76, 11, 1),
(77, 11, 1),
(78, 11, 2),
(79, 12, 8),
(80, 12, 1),
(81, 12, 1),
(82, 12, 2),
(83, 12, 1),
(84, 13, 12),
(85, 13, 4),
(86, 13, 12),
(87, 14, 1),
(88, 14, 1),
(89, 14, 1),
(90, 14, 2),
(91, 14, 2),
(92, 14, 1),
(93, 14, 1),
(94, 14, 1),
(95, 14, 1),
(96, 14, 1),
(97, 15, 1),
(98, 15, 1),
(99, 15, 1),
(100, 15, 1),
(101, 15, 2),
(102, 15, 1),
(103, 15, 1),
(104, 15, 1),
(105, 16, 1),
(106, 16, 1),
(107, 16, 1),
(108, 16, 1),
(109, 16, 2),
(110, 16, 3),
(111, 16, 1),
(112, 16, 1),
(113, 16, 1),
(114, 16, 1),
(118, 18, 1),
(119, 18, 1),
(120, 18, 1),
(121, 18, 2),
(122, 18, 3),
(123, 18, 1),
(124, 18, 1),
(125, 18, 1),
(126, 18, 1),
(131, 20, 1),
(132, 20, 1),
(133, 20, 1),
(134, 20, 1),
(135, 20, 1),
(136, 20, 1),
(137, 20, 1),
(138, 20, 2),
(139, 20, 1),
(140, 20, 1),
(141, 20, 1),
(146, 21, 2),
(147, 21, 1),
(148, 21, 1),
(149, 21, 1),
(150, 21, 1),
(151, 21, 1),
(152, 21, 1),
(153, 21, 2),
(154, 21, 1),
(155, 21, 1),
(156, 21, 1),
(157, 21, 1),
(158, 23, 1),
(159, 23, 1),
(160, 23, 1),
(161, 23, 2),
(162, 23, 2),
(163, 23, 2),
(164, 23, 1),
(165, 23, 1),
(166, 23, 1),
(167, 23, 1),
(168, 24, 1),
(169, 24, 1),
(170, 24, 8),
(171, 24, 1),
(172, 24, 2),
(173, 24, 1),
(174, 27, 1),
(174, 28, 1),
(175, 27, 1),
(175, 28, 1),
(176, 27, 2),
(176, 28, 1),
(177, 28, 1),
(178, 28, 1),
(179, 28, 2),
(180, 28, 2),
(181, 28, 1),
(182, 28, 1),
(183, 28, 1),
(184, 29, 4),
(185, 29, 1),
(186, 29, 1),
(187, 29, 1),
(188, 29, 2),
(197, 30, 2),
(198, 30, 1),
(199, 30, 1),
(200, 30, 2),
(201, 30, 1),
(202, 30, 1),
(203, 30, 1),
(204, 30, 1),
(205, 30, 4),
(206, 30, 1),
(207, 31, 2),
(208, 31, 1),
(209, 31, 1),
(210, 31, 1),
(211, 31, 1),
(212, 31, 1),
(213, 31, 1),
(214, 32, 2),
(215, 32, 1),
(216, 32, 1),
(217, 32, 1),
(218, 32, 2),
(219, 32, 1),
(220, 32, 1),
(221, 32, 1),
(222, 32, 1),
(223, 32, 8),
(224, 32, 1),
(225, 32, 2),
(226, 33, 2),
(227, 33, 1),
(228, 33, 1),
(229, 33, 2),
(230, 33, 1),
(231, 33, 1),
(232, 33, 1),
(233, 33, 1),
(234, 33, 1),
(235, 33, 1),
(236, 33, 1),
(237, 33, 1),
(238, 33, 1),
(239, 33, 1),
(240, 33, 1),
(241, 33, 1),
(242, 33, 1),
(243, 33, 1),
(244, 34, 1),
(245, 34, 1),
(246, 34, 1),
(247, 34, 1),
(248, 34, 1),
(249, 34, 1),
(250, 34, 1),
(251, 34, 1),
(252, 34, 2),
(253, 34, 1),
(254, 34, 1),
(255, 34, 1),
(256, 34, 1),
(257, 35, 1),
(258, 35, 1),
(259, 35, 2),
(260, 35, 1),
(261, 35, 1),
(262, 35, 1),
(263, 35, 1),
(264, 35, 1),
(265, 35, 1),
(266, 36, 4),
(267, 36, 2),
(268, 36, 2),
(269, 36, 1),
(270, 36, 1),
(271, 36, 1),
(272, 37, 2),
(273, 37, 1),
(274, 37, 1),
(275, 37, 1),
(276, 37, 1),
(277, 37, 1),
(278, 37, 2),
(279, 37, 1),
(281, 37, 1),
(282, 37, 1),
(283, 37, 1),
(284, 38, 1),
(285, 38, 1),
(286, 38, 1),
(287, 38, 1),
(288, 38, 1),
(289, 38, 1),
(290, 39, 1),
(291, 39, 1),
(292, 39, 1),
(293, 39, 1),
(294, 39, 1),
(295, 39, 2),
(296, 39, 1),
(297, 39, 1),
(298, 39, 1),
(299, 40, 1),
(300, 40, 2),
(301, 40, 2),
(302, 40, 1),
(303, 40, 1),
(304, 40, 1),
(305, 40, 1),
(306, 40, 1),
(307, 41, 1),
(308, 41, 1),
(309, 41, 1),
(310, 41, 2),
(311, 41, 1),
(312, 41, 1),
(313, 41, 1),
(314, 41, 1),
(315, 42, 1),
(316, 42, 2),
(317, 42, 1),
(318, 42, 2),
(319, 42, 1),
(320, 42, 1),
(321, 42, 1),
(322, 42, 1),
(323, 42, 1),
(324, 42, 8);

-- --------------------------------------------------------

--
-- Table structure for table `recipe_meal_categories`
--

DROP TABLE IF EXISTS `recipe_meal_categories`;
CREATE TABLE IF NOT EXISTS `recipe_meal_categories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `type_name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `recipe_meal_categories`
--

INSERT INTO `recipe_meal_categories` (`id`, `type_name`) VALUES
(1, 'Appetizer'),
(2, 'Main Dish'),
(3, 'Side Dish'),
(4, 'Dessert');

-- --------------------------------------------------------

--
-- Table structure for table `recipe_method_categories`
--

DROP TABLE IF EXISTS `recipe_method_categories`;
CREATE TABLE IF NOT EXISTS `recipe_method_categories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `method_name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `recipe_method_categories`
--

INSERT INTO `recipe_method_categories` (`id`, `method_name`) VALUES
(1, 'Baked'),
(2, 'Salad'),
(3, 'Sauce'),
(4, 'Snack'),
(5, 'Beverage'),
(6, 'Soup'),
(7, 'Other');

-- --------------------------------------------------------

--
-- Table structure for table `recipe_ratings`
--

DROP TABLE IF EXISTS `recipe_ratings`;
CREATE TABLE IF NOT EXISTS `recipe_ratings` (
  `rating_id` int NOT NULL AUTO_INCREMENT,
  `recipe_id` int NOT NULL,
  `user_id` int NOT NULL,
  `rating` int NOT NULL,
  `comment` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`rating_id`),
  UNIQUE KEY `recipe_id` (`recipe_id`,`user_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=132 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `recipe_ratings`
--

INSERT INTO `recipe_ratings` (`rating_id`, `recipe_id`, `user_id`, `rating`, `comment`, `created_at`) VALUES
(13, 12, 3, 5, NULL, '2024-03-21 10:23:18'),
(14, 9, 4, 4, NULL, '2024-03-21 10:23:18'),
(15, 15, 1, 4, NULL, '2024-03-21 10:23:18'),
(16, 14, 3, 2, NULL, '2024-03-21 10:23:18'),
(18, 11, 3, 3, NULL, '2024-03-21 10:23:26'),
(19, 6, 3, 1, NULL, '2024-03-21 10:23:26'),
(20, 25, 2, 2, NULL, '2024-03-21 10:23:26'),
(21, 32, 3, 1, NULL, '2024-03-21 10:23:26'),
(22, 13, 3, 2, NULL, '2024-03-21 10:23:26'),
(23, 14, 2, 4, NULL, '2024-03-21 10:23:26'),
(24, 21, 1, 4, NULL, '2024-03-21 10:23:26'),
(25, 28, 1, 1, NULL, '2024-03-21 10:23:26'),
(26, 5, 2, 4, NULL, '2024-03-21 10:23:26'),
(27, 2, 4, 5, NULL, '2024-03-21 10:23:26'),
(28, 13, 2, 4, NULL, '2024-03-21 10:23:26'),
(30, 8, 2, 5, NULL, '2024-03-21 10:23:28'),
(31, 18, 1, 3, NULL, '2024-03-21 10:23:28'),
(32, 22, 3, 3, NULL, '2024-03-21 10:23:28'),
(33, 29, 4, 4, NULL, '2024-03-21 10:23:28'),
(34, 28, 4, 5, NULL, '2024-03-21 10:23:28'),
(35, 3, 4, 3, NULL, '2024-03-21 10:23:28'),
(36, 28, 3, 4, NULL, '2024-03-21 10:23:28'),
(37, 25, 1, 2, NULL, '2024-03-21 10:23:28'),
(39, 7, 3, 1, NULL, '2024-03-21 10:23:29'),
(40, 27, 4, 4, NULL, '2024-03-21 10:23:29'),
(43, 10, 3, 5, NULL, '2024-03-21 10:23:30'),
(44, 1, 3, 3, NULL, '2024-03-21 10:23:30'),
(46, 19, 1, 3, NULL, '2024-03-21 10:23:31'),
(49, 32, 1, 3, NULL, '2024-03-21 10:23:32'),
(50, 19, 3, 1, NULL, '2024-03-21 10:23:32'),
(51, 2, 2, 5, NULL, '2024-03-21 10:23:32'),
(53, 21, 3, 5, NULL, '2024-03-21 10:23:32'),
(54, 18, 4, 1, NULL, '2024-03-21 10:23:32'),
(55, 24, 1, 3, NULL, '2024-03-21 10:23:32'),
(56, 4, 3, 5, NULL, '2024-03-21 10:23:32'),
(57, 22, 2, 3, NULL, '2024-03-21 10:23:32'),
(58, 32, 2, 1, NULL, '2024-03-21 10:23:32'),
(59, 31, 2, 3, NULL, '2024-03-21 10:23:32'),
(61, 30, 1, 1, NULL, '2024-03-21 10:23:34'),
(62, 10, 2, 4, NULL, '2024-03-21 10:23:34'),
(65, 23, 4, 5, NULL, '2024-03-21 10:23:36'),
(66, 31, 3, 1, NULL, '2024-03-21 10:23:36'),
(67, 31, 4, 1, NULL, '2024-03-21 10:23:36'),
(68, 7, 4, 1, NULL, '2024-03-21 10:23:36'),
(71, 31, 1, 2, NULL, '2024-03-21 10:23:36'),
(74, 24, 4, 1, NULL, '2024-03-21 10:23:56'),
(75, 27, 2, 4, NULL, '2024-03-21 10:23:56'),
(77, 2, 3, 1, NULL, '2024-03-21 10:23:57'),
(81, 25, 4, 1, NULL, '2024-03-21 10:23:58'),
(82, 12, 1, 2, NULL, '2024-03-21 10:23:58'),
(83, 17, 4, 4, NULL, '2024-03-21 10:23:58'),
(84, 22, 1, 5, NULL, '2024-03-21 10:23:58'),
(85, 13, 1, 2, NULL, '2024-03-21 10:23:58'),
(87, 4, 4, 4, NULL, '2024-03-21 10:23:58'),
(89, 30, 4, 5, NULL, '2024-03-21 10:23:59'),
(90, 8, 4, 5, NULL, '2024-03-21 10:23:59'),
(91, 17, 2, 2, NULL, '2024-03-21 10:23:59'),
(92, 20, 1, 4, NULL, '2024-03-21 10:23:59'),
(96, 12, 2, 4, NULL, '2024-03-21 10:24:00'),
(98, 19, 4, 5, NULL, '2024-03-21 10:24:01'),
(99, 4, 1, 5, NULL, '2024-03-21 10:24:01'),
(100, 8, 1, 3, NULL, '2024-03-21 10:24:01'),
(101, 23, 1, 2, NULL, '2024-03-21 10:24:01'),
(102, 6, 1, 2, NULL, '2024-03-21 10:24:01'),
(103, 6, 4, 3, NULL, '2024-03-21 10:24:01'),
(105, 17, 1, 5, NULL, '2024-03-21 10:24:01'),
(106, 20, 2, 1, NULL, '2024-03-21 10:24:01'),
(107, 22, 4, 5, NULL, '2024-03-21 10:24:01'),
(108, 32, 4, 3, NULL, '2024-03-21 10:24:01'),
(116, 29, 2, 3, NULL, '2024-03-21 10:24:04'),
(120, 6, 2, 5, NULL, '2024-03-21 10:24:08'),
(125, 7, 2, 1, NULL, '2024-03-21 10:24:10'),
(127, 28, 2, 1, NULL, '2024-03-21 10:24:11'),
(128, 12, 4, 5, NULL, '2024-03-21 10:24:11'),
(129, 15, 4, 4, NULL, '2024-03-21 10:24:11'),
(130, 21, 4, 3, NULL, '2024-03-21 10:24:11');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `first_Name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `last_Name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `gender` enum('Male','Female') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'Male',
  `level` enum('1','2','3','4') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `BMI_index` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `first_Name`, `last_Name`, `date_of_birth`, `email`, `gender`, `level`, `BMI_index`) VALUES
(1, 'tao', '$2y$10$ftWSOFRz5zxbkFTd.01PHuKV6vGTmM7ocJOnsRMAWsZEGrpw6NEC6', NULL, NULL, NULL, 'tao@gmail.com', 'Male', '1', NULL),
(2, 'taotao', '$2y$10$nWRRgU7ACr/ytBumq3Zb7OKhiAF6Zp6PmY8fXc9z/dOvNF2K03GoW', NULL, NULL, NULL, 'taotao@gmail.com', 'Male', '2', NULL),
(3, 'admin', '$2y$10$/FTkpPSQPmjB8fAI6zHEI.9hSbZW3Z/LZwq6pTmdVemneiemCUkye', NULL, NULL, NULL, 'admin@gmail.com', NULL, '1', NULL),
(4, 'taotaotao', '$2y$10$u7WYyWQltzYc7VYs3LowTO3BewwXkEUmuestdjaaajuevEsRIgVzG', NULL, NULL, NULL, 'taotaotao@gmail.com', 'Male', '3', NULL);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ingredients`
--
ALTER TABLE `ingredients`
  ADD CONSTRAINT `FK_ingre_cat` FOREIGN KEY (`category`) REFERENCES `ingredient_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_ingre_unit` FOREIGN KEY (`measurement_unit`) REFERENCES `ingredient_measurement_unit` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ingredient_nutritions`
--
ALTER TABLE `ingredient_nutritions`
  ADD CONSTRAINT `FK_ingre_nut` FOREIGN KEY (`id`) REFERENCES `ingredients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `recipes`
--
ALTER TABLE `recipes`
  ADD CONSTRAINT `recipes_ibfk_1` FOREIGN KEY (`course`) REFERENCES `recipe_course_categories` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `recipes_ibfk_2` FOREIGN KEY (`meal`) REFERENCES `recipe_meal_categories` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `recipes_ibfk_3` FOREIGN KEY (`method`) REFERENCES `recipe_method_categories` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `recipes_ibfk_4` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Constraints for table `recipe_ingredient`
--
ALTER TABLE `recipe_ingredient`
  ADD CONSTRAINT `recipe_ingredient_ibfk_1` FOREIGN KEY (`ingredient_id`) REFERENCES `ingredients` (`id`),
  ADD CONSTRAINT `recipe_ingredient_ibfk_2` FOREIGN KEY (`recipe_id`) REFERENCES `recipes` (`recipe_id`);

--
-- Constraints for table `recipe_ratings`
--
ALTER TABLE `recipe_ratings`
  ADD CONSTRAINT `recipe_ratings_ibfk_1` FOREIGN KEY (`recipe_id`) REFERENCES `recipes` (`recipe_id`),
  ADD CONSTRAINT `recipe_ratings_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
