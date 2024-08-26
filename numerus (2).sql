-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 19, 2024 at 09:16 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `numerus`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `Admin_id` int(11) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`Admin_id`, `Email`, `Name`) VALUES
(2, 'admin1@gmail.com', 'Admin1');

-- --------------------------------------------------------

--
-- Table structure for table `assess`
--

CREATE TABLE `assess` (
  `Assess_ID` int(11) NOT NULL,
  `Assess_Title` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `assess_analysis`
--

CREATE TABLE `assess_analysis` (
  `Analysis_ID` int(11) NOT NULL,
  `Result` varchar(100) NOT NULL,
  `Description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `assess_choice`
--

CREATE TABLE `assess_choice` (
  `Choice_ID` int(11) NOT NULL,
  `Ques_ID` int(11) NOT NULL,
  `Choice_Text` text NOT NULL,
  `Answer` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `assess_choice`
--

INSERT INTO `assess_choice` (`Choice_ID`, `Ques_ID`, `Choice_Text`, `Answer`) VALUES
(1, 1, 'A 5 apples', 0),
(2, 1, 'B 8 apples', 0),
(3, 1, 'C 9 apples', 1),
(4, 1, 'D 13 apples', 0),
(5, 2, 'A 130kg', 1),
(6, 2, 'B 60kg', 0),
(7, 2, 'C 100kg', 0),
(8, 2, 'D 30kg', 0),
(325, 3, 'A 200', 0),
(326, 3, 'B 211', 1),
(327, 3, 'C 201', 0),
(328, 3, 'D 122', 0),
(329, 4, 'A 34', 0),
(330, 4, 'B 37', 0),
(331, 4, 'C 39', 0),
(332, 4, 'D 35', 1),
(333, 5, 'A 11', 1),
(334, 5, 'B 15', 0),
(335, 5, 'C 14', 0),
(336, 5, 'D 7', 0),
(337, 6, 'A 1008, 188, 128, 88, 8, 0', 0),
(338, 6, 'B 0, 1008, 188, 128, 88, 8', 0),
(339, 6, 'C 0,8, 88,188, 128, 1008', 1),
(340, 6, 'D 8, 128, 1008, 0, 88 ,188', 0),
(341, 7, 'A Yes, there are 9 spots', 0),
(342, 7, 'B No, there are 9 spots', 0),
(343, 7, 'C No, there are 8 spots', 1),
(344, 7, 'D Yes, there are 8 spots', 0),
(345, 8, 'A 9+1', 0),
(346, 8, 'B 2+7', 1),
(347, 8, 'C 8+0', 0),
(348, 8, 'D 4+3', 0),
(349, 9, 'A 1/9, 1/7, 1/5, 1/3, 1/2', 0),
(350, 9, 'B 1/2, 1/5, 1/3, 1/7, 1/9', 0),
(351, 9, 'C 1/9, 1/5, 1/7, 1/3, 1/2', 0),
(352, 9, 'D 1/2, 1/3, 1/5, 1/7, 1/9', 1),
(353, 10, 'A 25', 0),
(354, 10, 'B 10', 1),
(355, 10, 'C 70', 0),
(356, 10, 'D 40', 0),
(357, 11, 'A 1', 0),
(358, 11, 'B 0', 0),
(359, 11, 'C 2', 1),
(360, 11, 'D 3', 0),
(361, 12, 'A A', 1),
(362, 12, 'B B', 0),
(363, 12, 'C C', 0),
(364, 12, 'D D', 0),
(365, 13, 'A 75', 0),
(366, 13, 'B 30', 0),
(367, 13, 'C 13', 0),
(368, 13, 'D 35', 1),
(369, 14, 'A 6', 0),
(370, 14, 'B 9', 1),
(371, 14, 'C 11', 0),
(372, 14, 'D 0', 0),
(373, 15, 'A 71', 1),
(374, 15, 'B 60', 0),
(375, 15, 'C 27', 0),
(376, 15, 'D 81', 0),
(377, 16, 'A 54', 0),
(378, 16, 'B 72', 0),
(379, 16, 'C 138', 0),
(380, 16, 'D 62', 1),
(381, 17, 'A 8', 0),
(382, 17, 'B 4', 0),
(383, 17, 'C 2', 0),
(384, 17, 'D 3', 1),
(385, 18, 'A 90-30=60', 0),
(386, 18, 'B 60-30=30', 0),
(387, 18, 'C 90-50=40', 1),
(388, 18, 'D 60-50=10', 0),
(389, 19, 'A 7', 1),
(390, 19, 'B 5', 0),
(391, 19, 'C 17', 0),
(392, 19, 'D 9', 0),
(393, 20, 'A 50', 0),
(394, 20, 'B 15', 1),
(395, 20, 'C 51', 0),
(396, 20, 'D 5', 0),
(397, 21, 'A ×, -, ÷', 0),
(398, 21, 'B +, -, ÷', 1),
(399, 21, 'C +, -, -', 0),
(400, 21, 'D ×, +, -', 0),
(401, 22, 'A 12', 0),
(402, 22, 'B 17', 0),
(403, 22, 'C 5', 0),
(404, 22, 'D 60', 1);

-- --------------------------------------------------------

--
-- Table structure for table `assess_question`
--

CREATE TABLE `assess_question` (
  `Ques_ID` int(11) NOT NULL,
  `Ques_Text` text NOT NULL,
  `URL` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `assess_question`
--

INSERT INTO `assess_question` (`Ques_ID`, `Ques_Text`, `URL`) VALUES
(1, 'How many apples are there in the picture?', 'Question1.png'),
(2, 'What is the total weight of these rice packets combined?', 'Question2.png'),
(3, 'What number should replace x in the sequence:', 'Question3.png'),
(4, 'Find the value of x.', 'Question4.png'),
(5, 'What is the next number in the sequence?', 'Question5.png'),
(6, 'Arrange these numbers in ascending order.', 'Question6.png'),
(7, 'How many spots are there, does this match the number?', 'Question7.png'),
(8, 'Which set of numbers equals the sum of 3 plus 6?', 'Question8.png'),
(9, 'Arrange the fractions from smallest to largest.', 'Question9.png'),
(10, 'What is 50% of 20?', 'Question10.png'),
(11, 'What is the value of the grape in the first column?', 'Question11.png'),
(12, 'Which option is suitable for the blank diagram?', 'Question12.png'),
(13, 'What is 7 times 5?', 'Question13.png'),
(14, 'What is the missing number?', 'Question14.png'),
(15, '22+49=?', 'Question15.png'),
(16, '?+38=100', 'Question16.png'),
(17, '12/4=?', 'Question17.png'),
(18, 'Write the calculations represented below.', 'Question18.png'),
(19, 'A girl had 12 newspapers and sold 5. How many newspapers did she have left?', 'Question19.png'),
(20, 'Which number represents \"fifteen\" in the following options.', 'Question20.png'),
(21, 'Which operators correctly complete the equations 5 _ 3 = 8_ 2= 6 _ 3 = 2?', 'Question21.png'),
(22, 'Sarah has 5 boxes of chocolates. Each box contains 12 chocolates. How many chocolates does she have in total?', 'Question22.png');

-- --------------------------------------------------------

--
-- Table structure for table `assess_result`
--

CREATE TABLE `assess_result` (
  `Aresult_ID` int(11) NOT NULL,
  `Child_ID` int(11) NOT NULL,
  `Result` decimal(5,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `assess_result`
--

INSERT INTO `assess_result` (`Aresult_ID`, `Child_ID`, `Result`) VALUES
(1, 4, 100.00),
(2, 8, 13.64),
(3, 8, 13.64),
(4, 3, 27.27);

-- --------------------------------------------------------

--
-- Table structure for table `avatar`
--

CREATE TABLE `avatar` (
  `Image_ID` int(11) NOT NULL,
  `Image_URL` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `avatar`
--

INSERT INTO `avatar` (`Image_ID`, `Image_URL`) VALUES
(1, '1.png'),
(2, '2.png'),
(3, '3.png'),
(4, '4.png');

-- --------------------------------------------------------

--
-- Table structure for table `chapters`
--

CREATE TABLE `chapters` (
  `Chapters_ID` int(11) NOT NULL,
  `Chapters_Title` varchar(255) NOT NULL,
  `Level_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chapters`
--

INSERT INTO `chapters` (`Chapters_ID`, `Chapters_Title`, `Level_ID`) VALUES
(1, 'Numbers up to 10', 1),
(2, 'Basic Addition and Subtraction', 1),
(3, 'Numbers up to 100', 2),
(4, 'Addition, Subtraction', 2),
(5, 'Basic Fractions and Decimals', 2),
(6, 'Numbers up to 1000', 3),
(7, 'Addition, Subtraction, Multiplication, Division', 3),
(8, 'Fractions, Decimals, and Percentages', 3);

-- --------------------------------------------------------

--
-- Table structure for table `child`
--

CREATE TABLE `child` (
  `Child_ID` int(11) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Identification_Number` char(12) NOT NULL,
  `Gender` varchar(10) NOT NULL,
  `DoB` date NOT NULL,
  `Parent_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `child`
--

INSERT INTO `child` (`Child_ID`, `Email`, `Name`, `Identification_Number`, `Gender`, `DoB`, `Parent_id`) VALUES
(1, 'ngboze@gmail.com', 'Ng Bo Ze', '160101101111', 'Male', '2016-01-01', 1),
(2, 'ngxiaoming@gmail.com', 'Ng Xiao Ming', '180202102222', 'Male', '2018-02-02', 1),
(3, 'martin@gmail.com', 'Martin Ong', '160303103333', 'Male', '2016-03-03', 1),
(4, 'qicai@gmail.com', 'Ong Qi Cai', '180404104444', 'Male', '2018-04-04', 2),
(7, 'hi@gmail.com', 'Da Mei Nv', '888888888888', 'female', '2004-03-22', 1),
(8, 'yw@gmail.com', 'Da Shuai Ge', '777777777777', 'female', '2004-01-15', 1),
(9, 'aa@gmail.com', 'Hii', '111111111111', 'female', '2004-03-22', 1),
(10, 'nihao@gmail.com', 'aa', '222222222222', 'male', '2000-02-22', 1);

-- --------------------------------------------------------

--
-- Table structure for table `child_avatar`
--

CREATE TABLE `child_avatar` (
  `CAvatar_ID` int(11) NOT NULL,
  `Child_ID` int(11) NOT NULL,
  `Image_ID` int(11) NOT NULL,
  `Current_Status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `child_avatar`
--

INSERT INTO `child_avatar` (`CAvatar_ID`, `Child_ID`, `Image_ID`, `Current_Status`) VALUES
(9, 7, 1, 0),
(10, 7, 2, 0),
(11, 7, 3, 0),
(12, 7, 4, 1),
(13, 8, 1, 0),
(14, 8, 2, 0),
(15, 8, 3, 1),
(16, 8, 4, 0),
(17, 9, 1, 0),
(18, 9, 2, 0),
(19, 9, 3, 1),
(20, 9, 4, 0),
(21, 10, 1, 0),
(22, 10, 2, 0),
(23, 10, 3, 0),
(24, 10, 4, 0);

-- --------------------------------------------------------

--
-- Table structure for table `child_progress`
--

CREATE TABLE `child_progress` (
  `Progress_ID` int(11) NOT NULL,
  `Child_ID` int(11) NOT NULL,
  `Subtopic_ID` int(11) DEFAULT 0,
  `Quiz_ID` int(11) DEFAULT 0,
  `Completed` tinyint(1) NOT NULL DEFAULT 0,
  `Game_ID` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `child_progress`
--

INSERT INTO `child_progress` (`Progress_ID`, `Child_ID`, `Subtopic_ID`, `Quiz_ID`, `Completed`, `Game_ID`) VALUES
(1, 1, 3, 0, 1, 0),
(2, 4, 1, 0, 1, 0),
(3, 4, 0, 1, 1, 0),
(4, 4, 4, 0, 1, 0),
(5, 4, 5, 0, 1, 0),
(6, 4, 3, 0, 1, 0),
(7, 4, 0, 3, 1, 0),
(8, 4, 6, 0, 1, 0),
(9, 4, 9, 0, 1, 0),
(10, 4, 7, 0, 1, 0),
(11, 4, 0, 5, 1, 0),
(12, 4, 8, 0, 1, 0),
(13, 4, 0, 1, 1, 0),
(14, 4, 0, 4, 1, 0),
(15, 4, 0, 0, 1, 2),
(16, 4, 0, 0, 1, 2),
(17, 4, 0, 0, 1, 2),
(18, 4, 0, 0, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `level`
--

CREATE TABLE `level` (
  `Level_ID` int(11) NOT NULL,
  `Level_Title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `level`
--

INSERT INTO `level` (`Level_ID`, `Level_Title`) VALUES
(1, 'Level 1'),
(2, 'Level 2'),
(3, 'Level 3');

-- --------------------------------------------------------

--
-- Table structure for table `parent`
--

CREATE TABLE `parent` (
  `Parent_ID` int(11) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Identification_Number` char(12) NOT NULL,
  `Gender` varchar(10) NOT NULL,
  `DoB` date NOT NULL,
  `Phone` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `parent`
--

INSERT INTO `parent` (`Parent_ID`, `Email`, `Name`, `Identification_Number`, `Gender`, `DoB`, `Phone`) VALUES
(1, 'ngyikwei@gmail.com', 'Ng Yik Wei', '950101101234', 'Female', '1995-01-01', '0123456789'),
(2, 'richard@gmail.com', 'Richard Ong', '950123105678', 'Male', '1995-01-23', '0119876543');

-- --------------------------------------------------------

--
-- Table structure for table `quiz`
--

CREATE TABLE `quiz` (
  `Quiz_ID` int(11) NOT NULL,
  `Chapters_ID` int(11) NOT NULL,
  `Quiz_Title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quiz`
--

INSERT INTO `quiz` (`Quiz_ID`, `Chapters_ID`, `Quiz_Title`) VALUES
(1, 1, 'Numbers up to 10 Quiz'),
(2, 2, 'Basic Addition and Subtraction Quiz'),
(3, 3, 'Numbers up to 100 Quiz'),
(4, 4, 'Addition, Subtraction Quiz'),
(5, 5, 'Basic Fractions and Decimals Quiz'),
(6, 6, 'Numbers up to 1000 Quiz'),
(7, 7, 'Addition, Subtraction, Multiplication, Division Quiz'),
(8, 8, 'Fractions, Decimals, and Percentages Quiz');

-- --------------------------------------------------------

--
-- Table structure for table `quiz_choice`
--

CREATE TABLE `quiz_choice` (
  `Choice_ID` int(11) NOT NULL,
  `Question_ID` int(11) NOT NULL,
  `Choice_Text` varchar(255) NOT NULL,
  `Answer` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quiz_choice`
--

INSERT INTO `quiz_choice` (`Choice_ID`, `Question_ID`, `Choice_Text`, `Answer`) VALUES
(1, 1, 'A 4', 0),
(2, 1, 'B 5', 0),
(3, 1, 'C 6', 0),
(4, 1, 'D 7', 1),
(5, 2, 'A 6', 0),
(6, 2, 'B 10', 1),
(7, 2, 'C 8', 0),
(8, 2, 'D 3', 0),
(9, 3, 'A Three', 0),
(10, 3, 'B Two', 1),
(11, 3, 'C Ten', 0),
(12, 3, 'D Six', 0),
(13, 4, 'A 8', 1),
(14, 4, 'B 2', 0),
(15, 4, 'C 1', 0),
(16, 4, 'D 5', 0),
(17, 5, 'A Ten', 0),
(18, 5, 'B Two', 0),
(19, 5, 'C Three', 1),
(20, 5, 'D Nine', 0),
(21, 6, 'A 1', 0),
(22, 6, 'B 6', 0),
(23, 6, 'C 3', 0),
(24, 6, 'D 4', 1),
(25, 7, 'A 2', 1),
(26, 7, 'B 3', 0),
(27, 7, 'C 5', 0),
(28, 7, 'D 1', 0),
(29, 8, 'A 2', 0),
(30, 8, 'B 4', 1),
(31, 8, 'C 6', 0),
(32, 8, 'D 1', 0),
(33, 9, 'A Six', 0),
(34, 9, 'B Four', 0),
(35, 9, 'C Five', 1),
(36, 9, 'D Two', 0),
(37, 10, 'A 9-3=6', 1),
(38, 10, 'B 9-3=7', 0),
(39, 10, 'C 9+3=6', 0),
(40, 10, 'D 3-9=6', 0),
(41, 11, 'A 2+4=5', 0),
(42, 11, 'B 2+4=6', 1),
(43, 11, 'C 6-4=2', 0),
(44, 11, 'D 2+6=6', 0),
(45, 12, 'A Four', 0),
(46, 12, 'B Seven', 0),
(47, 12, 'C Three', 1),
(48, 12, 'D Two', 0),
(49, 13, 'A Four Three', 0),
(50, 13, 'B Fourty Two', 0),
(51, 13, 'C Fifty Three', 0),
(52, 13, 'D Fourty Three', 1),
(53, 14, 'A Ones', 1),
(54, 14, 'B Tens', 0),
(55, 14, 'C Hundreds', 0),
(56, 14, 'D Thousands', 0),
(57, 15, 'A Equal, (L = 3, R = 3)', 0),
(58, 15, 'B Not Equal, (L = 3, R = 2)', 1),
(59, 15, 'C Not Equal, (L = 2, R = 3)', 0),
(60, 15, 'D Equal, (L = 2, R = 2)', 0),
(61, 16, 'A True', 0),
(62, 16, 'B False', 0),
(63, 16, 'C There are more pencils', 1),
(64, 16, 'D There are more erasers', 0),
(65, 17, 'A I, IV', 0),
(66, 17, 'B II, IV', 0),
(67, 17, 'C I, III, IV', 1),
(68, 17, 'D II, III, IV', 0),
(69, 18, 'A 40, 41, 42, 43, 44', 1),
(70, 18, 'B 40, 43, 41, 42, 44', 0),
(71, 18, 'C 44, 43, 42, 41, 40', 0),
(72, 18, 'D 41, 40, 43, 44, 45', 0),
(73, 19, 'A 10, 11, 12, 13, 14', 0),
(74, 19, 'B 13, 14, 11, 10, 12', 0),
(75, 19, 'C 14, 12, 13, 11, 10', 0),
(76, 19, 'D 14, 13, 12, 11, 10', 1),
(77, 20, 'A 84', 1),
(78, 20, 'B  72', 0),
(79, 20, 'C They are equal', 0),
(80, 20, 'D None of the above', 0),
(81, 21, 'A 28', 0),
(82, 21, 'B 20', 1),
(83, 21, 'C They are equal', 0),
(84, 21, 'D None of the above', 0),
(85, 22, 'A 33', 0),
(86, 22, 'B 30', 0),
(87, 22, 'C 32', 1),
(88, 22, 'D 66', 0),
(89, 23, 'A 57, Fifty Six', 0),
(90, 23, 'B 57, Fifty Seven', 1),
(91, 23, 'C 55, Fifty Seven', 0),
(92, 23, 'D 59, Fifty Nine', 0),
(93, 24, 'A 65', 0),
(94, 24, 'B 79', 0),
(95, 24, 'C 99', 0),
(96, 24, 'D 89', 1),
(97, 25, 'C 5 chocolates', 0),
(98, 25, 'D 60 chocolates', 0),
(99, 25, 'C 61\r\n', 1),
(100, 25, 'D 79', 0),
(101, 26, 'A 20\r\n', 0),
(102, 26, 'B 30', 1),
(103, 26, 'C 40', 0),
(104, 26, 'D 10\r\n', 0),
(105, 27, 'A 14', 0),
(106, 27, 'B 20', 0),
(107, 27, 'C 17', 0),
(108, 27, 'D 18', 1),
(109, 28, 'A 16', 0),
(110, 28, 'B 14', 0),
(111, 28, 'C 15', 1),
(112, 28, 'D 10', 0),
(113, 29, 'A 10', 1),
(114, 29, 'B 9', 0),
(115, 29, 'C 12', 0),
(116, 29, 'D 20', 0),
(117, 30, 'A 24', 1),
(118, 30, 'B 32', 0),
(119, 30, 'C 28', 0),
(120, 30, 'D 36', 0),
(121, 31, 'A 9', 0),
(122, 31, 'B 10', 1),
(123, 31, 'C 12', 0),
(124, 31, 'D 14', 0),
(125, 32, 'A 9', 0),
(126, 32, 'B 11', 0),
(127, 32, 'C 13', 1),
(128, 32, 'D 15', 0),
(129, 33, 'A ½', 0),
(130, 33, 'B 1/3', 1),
(131, 33, 'C 1/5', 0),
(132, 33, 'D ¼', 0),
(133, 34, 'A 3/9', 0),
(134, 34, 'B 3/11', 0),
(135, 34, 'C 3/10', 1),
(136, 34, 'D 3/8', 0),
(137, 35, 'A Three point four fifty-six', 0),
(138, 35, 'B Three point four five six', 1),
(139, 35, 'C Three and four hundred fifty-six tenths', 0),
(140, 35, 'D Three and four hundred fifty-six hundredths', 0),
(141, 36, 'A 0.07', 0),
(142, 36, 'B 0.7', 1),
(143, 36, 'C 0.17', 0),
(144, 36, 'D 0.77', 0),
(145, 37, 'A 85/100', 0),
(146, 37, 'B 100/85', 0),
(147, 37, 'C 20/17', 0),
(148, 37, 'D 17/20', 1),
(149, 38, 'A 960', 1),
(150, 38, 'B 860', 0),
(151, 38, 'C 940', 0),
(152, 38, 'D 840', 0),
(153, 39, 'A Five hundred and thirty', 0),
(154, 39, 'B Five hundred and ten', 0),
(155, 39, 'C Five hundred and twenty', 1),
(156, 39, 'D Five hundred and fifteen', 0),
(157, 40, 'A 2', 0),
(158, 40, 'B 5', 1),
(159, 40, 'C 8', 0),
(160, 40, 'D 80', 0),
(161, 41, 'A 670', 0),
(162, 41, 'B 680', 1),
(163, 41, 'C 700', 0),
(164, 41, 'D 770', 0),
(165, 42, 'A 4', 0),
(166, 42, 'B 6', 0),
(167, 42, 'C 8', 1),
(168, 42, 'D 10', 0),
(169, 43, 'A 20', 1),
(170, 43, 'B 10', 0),
(171, 43, 'C 25', 0),
(172, 43, 'D 15', 0),
(173, 44, 'A 2', 0),
(174, 44, 'B 6', 0),
(175, 44, 'C 3', 1),
(176, 44, 'D 1', 0),
(177, 45, 'A 3', 0),
(178, 45, 'B 4', 1),
(179, 45, 'C 6', 0),
(180, 45, 'D 8', 0),
(181, 46, 'A Fourty five Percent', 0),
(182, 46, 'B Twenty five Percent', 1),
(183, 46, 'C Thirty five Percent', 0),
(184, 46, 'D Fifteen', 0),
(185, 47, 'A 45%', 0),
(186, 47, 'B 56%', 0),
(187, 47, 'C 55%', 1),
(188, 47, 'D 60%', 0),
(189, 48, 'A 0.35', 0),
(190, 48, 'B 0.25', 1),
(191, 48, 'C 0.20', 0),
(192, 48, 'D 0.30', 0),
(193, 49, 'A A=2/5, C=60%', 0),
(194, 49, 'B A=3/5, C=40%', 0),
(195, 49, 'C A=4/5, C=20%', 0),
(196, 49, 'D A=2/5, C=40%', 1);

-- --------------------------------------------------------

--
-- Table structure for table `quiz_question`
--

CREATE TABLE `quiz_question` (
  `Question_ID` int(11) NOT NULL,
  `Quiz_ID` int(11) NOT NULL,
  `Ques_Text` text NOT NULL,
  `URL` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quiz_question`
--

INSERT INTO `quiz_question` (`Question_ID`, `Quiz_ID`, `Ques_Text`, `URL`) VALUES
(1, 1, 'Look at the image given. Count the total amount of bees in the image.', '1.1.1.gif'),
(2, 1, 'Look at the image given. Count the total amount of candies in the image.\n', '1.1.2.gif'),
(3, 1, 'Convert the given number into its corresponding word representation.', '1.1.3.gif'),
(4, 1, 'The following word represents a number. What is the correct numerical representation for it?', '1.1.4.gif'),
(5, 1, 'Pei Yi, Farah, and Devi are all best friends from Class 1 Utarid. Select a word that represents the number of people in their group.', '1.1.5.gif'),
(6, 2, 'Given the equation, what will the final result be?', '1.2.1.gif'),
(7, 2, 'There are 5 bunches of bananas on the tree, 3 of which have fallen off. How many bunches of bananas are left on the tree now?', '1.2.2.gif'),
(8, 2, 'An equation is provided. What will the total be at the end?', '1.2.3.gif'),
(9, 2, '2 students were initially tasked to clean the class. However, their class teacher decided to add 3 more students to help. How many students are cleaning the class now?', '1.2.4.gif'),
(10, 2, 'The excavator removed 3 of the original 9 piles of sand. From what you’ve learnt, choose the correct equation and result.', '1.2.5.gif'),
(11, 2, 'Provide the correct equation and answer based on the increase of apples in the video.', '1.2.6.gif'),
(12, 2, 'An equation is provided. What will the total be at the end?', '1.2.7.gif'),
(13, 3, 'What is this number represented in words?', '2.1.1.gif'),
(14, 3, 'What do we call this placement value of the underlined number?', '2.1.2.gif'),
(15, 3, 'From your understanding, are the number of books of both halves of the table equal? Also, how many books are at each side? (Note: L = left, R = right)', '2.1.3.gif'),
(16, 3, 'There are pencils and erasers shown in the image above. Are the number of pencils equal to the number of erasers?', '2.1.4.gif'),
(17, 3, 'Select the correct equations that are equal to the number ‘6’.', '2.1.5.gif'),
(18, 3, '5 numbers are provided. Based on the answer options, which arrangement shows an ascending order?', '2.1.6.gif'),
(19, 3, '5 numbers are provided. Based on the answer options, which arrangement shows a descending order?', '2.1.7.gif'),
(20, 3, 'Given are two numbers. Which number refers to more?', '2.1.8.gif'),
(21, 3, 'Given are two numbers. Which number refers to less?', '2.1.9.gif'),
(22, 4, 'In this equation, there are numbers that were underlined. From this, use the underlined numbers to perform addition based on it’s place value, and choose the correct answer.', '2.2.1.gif'),
(23, 4, 'Mr. Bean buys a sack of rice for RM25 and a 1kg packet of potatoes for RM32. What is the total amount he should pay?', '2.2.2.gif'),
(24, 4, 'Hachimura is a professional basketball player, who has played 2 games so far in this season. He has scored 34 points in Game 1, then scored 55 points in Game 2. In total, how many points did Hachimura obtain from the two games?', '2.2.3.gif'),
(25, 4, 'Given an equation, there are numbers that were underlined. From this, use the underlined numbers to perform subtraction based on it’s place value, and select the right answer.', '2.2.4.gif'),
(26, 4, 'From your understanding, what two-digit numbers should occupy the given spaces?', '2.2.5.gif'),
(27, 4, 'A local movie theatre hall received 77 bookings for the movie titled *Supercalifragilisticexpialidocious*. After the show, 59 attendees are leaving. How many people remain seated after the show?', '2.2.6.gif'),
(28, 4, 'Calculate the total amount of fruits.', '2.2.7.gif'),
(29, 4, 'Solve the equation.', '2.2.8.gif'),
(30, 4, 'There are a total of 50 tomatoes. If 14 tomatoes were relocated to the cow barn, 8 were moved to the horse barn, and 4 were sent to owner Mr. Alvin, how many tomatoes are left?', '2.2.9.gif'),
(31, 4, 'What is the next number in the pattern: 2, 4, 6, 8, ...?', '2.2.10.gif'),
(32, 4, 'Anna is arranging chairs in rows for a school event. Each row has 2 more chairs than the previous row. The first row has 5 chairs. How many chairs are in the 5th row?', '2.2.11.gif'),
(33, 5, 'What is the fraction that represents each slice?', '2.3.1.gif'),
(34, 5, 'Which fraction best represents the number of children in the family tree?', '2.3.2.gif'),
(35, 5, 'Convert 3.456 into words.', '2.3.3.gif'),
(36, 5, 'Which of the following decimals is equal to 7/10? ', '2.3.4.gif'),
(37, 5, 'Based on the decimal provided, help Joao by choosing the correct fraction-format answer, in its simplest form.', '2.3.5.gif'),
(38, 6, 'What is nine hundred and sixty in numbers?', '3.1.1.gif'),
(39, 6, 'What is this number in words?', '3.1.2.gif'),
(40, 6, 'In the number 258, which digit represents the tens place?\r\n', '3.1.3.gif'),
(41, 6, 'What is 677 rounded to the nearest hundred?', '3.1.4.gif'),
(42, 7, 'What is 4 x 2?\r\n', '3.2.1.gif'),
(43, 7, 'Kubo is a talented football player. In his first season for his football club, Real Sociedad, he has scored 5 goals. In his second season, he has massively improved by scoring 4 times the goals compared to his first season. What is his goal tally in his second season?', '3.2.2.gif'),
(44, 7, 'What is 15 divided by 5?\r\n', '3.2.3.gif'),
(45, 7, 'Emily bought 12 candies to share equally among her 3 friends. How many candies will each friend get?\r\n', '3.2.4.gif'),
(46, 8, 'How is 25% written down in words?\r\n', '3.3.1.gif'),
(47, 8, 'What is the percentage of shaded portions?\r\n', '3.3.2.png'),
(48, 8, 'What is X?\r\n', '3.3.3.gif'),
(49, 8, 'What values best match A and B?\r\n', '3.3.4.gif');

-- --------------------------------------------------------

--
-- Table structure for table `result`
--

CREATE TABLE `result` (
  `Result_ID` int(11) NOT NULL,
  `Child_ID` int(11) NOT NULL,
  `Quiz_ID` int(11) NOT NULL,
  `Correct` tinyint(4) NOT NULL,
  `Incorrect` tinyint(4) NOT NULL,
  `Result` decimal(5,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `result`
--

INSERT INTO `result` (`Result_ID`, `Child_ID`, `Quiz_ID`, `Correct`, `Incorrect`, `Result`) VALUES
(16, 8, 1, 0, 0, 0.00),
(17, 1, 1, 1, 4, 20.00),
(18, 8, 1, 0, 0, 0.00),
(20, 8, 1, 3, 2, 60.00),
(21, 8, 1, 3, 2, 60.00),
(22, 8, 1, 4, 1, 80.00),
(23, 8, 1, 5, 0, 100.00),
(24, 8, 1, 5, 0, 100.00),
(25, 3, 1, 5, 0, 100.00),
(26, 8, 1, 5, 0, 100.00),
(27, 8, 1, 5, 0, 100.00),
(28, 8, 1, 3, 2, 60.00),
(29, 8, 1, 5, 0, 100.00),
(30, 8, 3, 7, 2, 77.78),
(31, 8, 3, 8, 1, 88.89),
(32, 8, 3, 8, 1, 88.89),
(33, 3, 3, 9, 0, 100.00),
(34, 3, 3, 8, 1, 88.89),
(35, 8, 3, 4, 5, 44.44),
(36, 8, 1, 5, 0, 100.00),
(37, 4, 1, 1, 4, 20.00),
(38, 4, 1, 5, 0, 100.00),
(39, 4, 3, 9, 0, 100.00),
(40, 4, 5, 5, 0, 100.00),
(41, 4, 4, 11, 0, 100.00),
(42, 4, 1, 5, 0, 100.00),
(43, 4, 4, 11, 0, 100.00);

-- --------------------------------------------------------

--
-- Table structure for table `subtopic`
--

CREATE TABLE `subtopic` (
  `Subtopic_ID` int(11) NOT NULL,
  `Chapters_ID` int(11) NOT NULL,
  `Subtitle_Name` varchar(255) NOT NULL,
  `Video` varchar(255) DEFAULT NULL,
  `Notes` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subtopic`
--

INSERT INTO `subtopic` (`Subtopic_ID`, `Chapters_ID`, `Subtitle_Name`, `Video`, `Notes`) VALUES
(1, 1, 'Number Value, Counting to 10', 'Level1Chapter1.mp4', '(L1C1S1)Counting to 10.pdf'),
(2, 2, 'Concepts of Addition and Subtraction, Addition and Subtraction Up to 10\r\n', 'Level1Chapter2.mp4', '(L1C2S1)Additon and Subtraction.pdf'),
(3, 3, 'Number Representation, Place Value', 'Level2Chapter1.mp4', '(L2C1S1) Number Representation and Place Value.pdf'),
(4, 3, 'Combination Of Numbers', 'Level2Chapter1.2.mp4', '(L2C1S2) Combination of Numbers.pdf'),
(5, 3, 'Quantity Intuitively, Number Sequence, Estimation', 'Level2Chapter1.3.mp4', '(L2C1S3) Quantity Intuitively, Number Sequence, Estimation.pdf'),
(6, 4, 'Addition and subtraction within 100', 'Level2Chapter2.mp4', '(L2C2S1) Addtion and Subtration.pdf'),
(7, 4, 'Number Patterns', 'Level2Chapter2.2.mp4', '(L2C2S2)Number Patterns.pdf'),
(8, 5, 'Fractions Representation', 'Level2Chapter3.mp4', '(L2C3S1)Fractions.pdf'),
(9, 5, 'Decimal Representation', 'Level2Chapter3.2.mp4', '(L2C3S2)Decimals.pdf'),
(10, 6, 'Number Value Up to 1000', 'Level3Chapter1.mp4', '(L3C1S1) Number Value up to 1000.pdf'),
(11, 6, 'Write Numbers up to 1000', 'Level3Chapter1.2.mp4', '(L3C1S2) Write Numbers up to 1000.pdf'),
(12, 6, 'Place Value Up to 1000', 'Level3Chapter1.3.mp4', '(L3C1S3) Place Value up to 1000.pdf'),
(13, 6, 'Round Off Numbers Up to Hundreds', 'Level3Chapter1.4.mp4', '(L3C1S4) Round off Numbers up to Hundreds.pdf'),
(14, 7, 'Basic Multiplication', 'Level3Chapter2.mp4', '(L3C2S1) Basic Multiplication.pdf'),
(15, 7, 'Basic Division', 'Level3Chapter2.2.mp4', '(L3C2S2) Basic Division.pdf'),
(16, 8, 'Conversion of Fractions, Decimals and Percentage', 'Level3Chapter3.mp4', '(L3C3) Conversion of Fractions, Decimals, and Percentages).pdf');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `Email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`Email`, `password`, `role`) VALUES
('aa@gmail.com', '$2y$10$XTUybWdaLSk1H1T5xmbkWO66m4ducj40aU71l9Bmw7qylDFVckxzS', 'Children'),
('admin1@gmail.com', 'admin1234', 'Admin'),
('hi@gmail.com', '$2y$10$.sbh7ZJRosotYH73gCZWS.40ATKcw6ToK.a/COze2XiR1opYJ9iZ.', 'Children'),
('martin@gmail.com', 'martin', 'Children'),
('ngboze@gmail.com', 'ngboze', 'Children'),
('ngxiaoming@gmail.com', 'ngxiaoming', 'Children'),
('ngyikwei@gmail.com', 'ngyikwei', 'Parent'),
('nihao@gmail.com', '$2y$10$tvtJ2cUYS98dsroXWRWeoeuzucd0nlcdDg1.ZhdEzCmtIyNq7dRC2', 'Children'),
('qicai@gmail.com', 'qicai', 'Children'),
('richard@gmail.com', 'richard', 'Parent'),
('yw@gmail.com', 'aaa', 'Children');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`Admin_id`),
  ADD KEY `AEmail` (`Email`);

--
-- Indexes for table `assess`
--
ALTER TABLE `assess`
  ADD PRIMARY KEY (`Assess_ID`);

--
-- Indexes for table `assess_analysis`
--
ALTER TABLE `assess_analysis`
  ADD PRIMARY KEY (`Analysis_ID`);

--
-- Indexes for table `assess_choice`
--
ALTER TABLE `assess_choice`
  ADD PRIMARY KEY (`Choice_ID`),
  ADD KEY `Ques_ID` (`Ques_ID`);

--
-- Indexes for table `assess_question`
--
ALTER TABLE `assess_question`
  ADD PRIMARY KEY (`Ques_ID`);

--
-- Indexes for table `assess_result`
--
ALTER TABLE `assess_result`
  ADD PRIMARY KEY (`Aresult_ID`),
  ADD KEY `Child_ID` (`Child_ID`);

--
-- Indexes for table `avatar`
--
ALTER TABLE `avatar`
  ADD PRIMARY KEY (`Image_ID`);

--
-- Indexes for table `chapters`
--
ALTER TABLE `chapters`
  ADD PRIMARY KEY (`Chapters_ID`),
  ADD KEY `chapters_ibfk_1` (`Level_ID`);

--
-- Indexes for table `child`
--
ALTER TABLE `child`
  ADD PRIMARY KEY (`Child_ID`),
  ADD KEY `CEmail` (`Email`);

--
-- Indexes for table `child_avatar`
--
ALTER TABLE `child_avatar`
  ADD PRIMARY KEY (`CAvatar_ID`),
  ADD KEY `Child_ID` (`Child_ID`),
  ADD KEY `Image_ID` (`Image_ID`);

--
-- Indexes for table `child_progress`
--
ALTER TABLE `child_progress`
  ADD PRIMARY KEY (`Progress_ID`);

--
-- Indexes for table `level`
--
ALTER TABLE `level`
  ADD PRIMARY KEY (`Level_ID`);

--
-- Indexes for table `parent`
--
ALTER TABLE `parent`
  ADD PRIMARY KEY (`Parent_ID`),
  ADD KEY `Email` (`Email`);

--
-- Indexes for table `quiz`
--
ALTER TABLE `quiz`
  ADD PRIMARY KEY (`Quiz_ID`),
  ADD KEY `Chapters_ID` (`Chapters_ID`);

--
-- Indexes for table `quiz_choice`
--
ALTER TABLE `quiz_choice`
  ADD PRIMARY KEY (`Choice_ID`),
  ADD KEY `Question_ID` (`Question_ID`);

--
-- Indexes for table `quiz_question`
--
ALTER TABLE `quiz_question`
  ADD PRIMARY KEY (`Question_ID`),
  ADD KEY `Quiz_ID` (`Quiz_ID`);

--
-- Indexes for table `result`
--
ALTER TABLE `result`
  ADD PRIMARY KEY (`Result_ID`),
  ADD KEY `Child_ID` (`Child_ID`),
  ADD KEY `Quiz_ID` (`Quiz_ID`);

--
-- Indexes for table `subtopic`
--
ALTER TABLE `subtopic`
  ADD PRIMARY KEY (`Subtopic_ID`),
  ADD KEY `subtopic_ibfk_1` (`Chapters_ID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`Email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `Admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `assess`
--
ALTER TABLE `assess`
  MODIFY `Assess_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `assess_analysis`
--
ALTER TABLE `assess_analysis`
  MODIFY `Analysis_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `assess_choice`
--
ALTER TABLE `assess_choice`
  MODIFY `Choice_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=405;

--
-- AUTO_INCREMENT for table `assess_question`
--
ALTER TABLE `assess_question`
  MODIFY `Ques_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `assess_result`
--
ALTER TABLE `assess_result`
  MODIFY `Aresult_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `avatar`
--
ALTER TABLE `avatar`
  MODIFY `Image_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `chapters`
--
ALTER TABLE `chapters`
  MODIFY `Chapters_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `child`
--
ALTER TABLE `child`
  MODIFY `Child_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `child_avatar`
--
ALTER TABLE `child_avatar`
  MODIFY `CAvatar_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `child_progress`
--
ALTER TABLE `child_progress`
  MODIFY `Progress_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `level`
--
ALTER TABLE `level`
  MODIFY `Level_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `parent`
--
ALTER TABLE `parent`
  MODIFY `Parent_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `quiz`
--
ALTER TABLE `quiz`
  MODIFY `Quiz_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `quiz_choice`
--
ALTER TABLE `quiz_choice`
  MODIFY `Choice_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=205;

--
-- AUTO_INCREMENT for table `quiz_question`
--
ALTER TABLE `quiz_question`
  MODIFY `Question_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `result`
--
ALTER TABLE `result`
  MODIFY `Result_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `subtopic`
--
ALTER TABLE `subtopic`
  MODIFY `Subtopic_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `AEmail` FOREIGN KEY (`Email`) REFERENCES `user` (`Email`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `assess_choice`
--
ALTER TABLE `assess_choice`
  ADD CONSTRAINT `assess_choice_ibfk_1` FOREIGN KEY (`Ques_ID`) REFERENCES `assess_question` (`Ques_ID`);

--
-- Constraints for table `assess_result`
--
ALTER TABLE `assess_result`
  ADD CONSTRAINT `assess_result_ibfk_1` FOREIGN KEY (`Child_ID`) REFERENCES `child` (`Child_ID`);

--
-- Constraints for table `chapters`
--
ALTER TABLE `chapters`
  ADD CONSTRAINT `chapters_ibfk_1` FOREIGN KEY (`Level_ID`) REFERENCES `level` (`Level_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `child`
--
ALTER TABLE `child`
  ADD CONSTRAINT `CEmail` FOREIGN KEY (`Email`) REFERENCES `user` (`Email`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `child_avatar`
--
ALTER TABLE `child_avatar`
  ADD CONSTRAINT `child_avatar_ibfk_1` FOREIGN KEY (`Child_ID`) REFERENCES `child` (`Child_ID`),
  ADD CONSTRAINT `child_avatar_ibfk_2` FOREIGN KEY (`Image_ID`) REFERENCES `avatar` (`Image_ID`);

--
-- Constraints for table `parent`
--
ALTER TABLE `parent`
  ADD CONSTRAINT `Email` FOREIGN KEY (`Email`) REFERENCES `user` (`Email`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `quiz`
--
ALTER TABLE `quiz`
  ADD CONSTRAINT `quiz_ibfk_1` FOREIGN KEY (`Chapters_ID`) REFERENCES `chapters` (`Chapters_ID`);

--
-- Constraints for table `quiz_choice`
--
ALTER TABLE `quiz_choice`
  ADD CONSTRAINT `quiz_choice_ibfk_1` FOREIGN KEY (`Question_ID`) REFERENCES `quiz_question` (`Question_ID`);

--
-- Constraints for table `quiz_question`
--
ALTER TABLE `quiz_question`
  ADD CONSTRAINT `quiz_question_ibfk_1` FOREIGN KEY (`Quiz_ID`) REFERENCES `quiz` (`Quiz_ID`);

--
-- Constraints for table `result`
--
ALTER TABLE `result`
  ADD CONSTRAINT `result_ibfk_1` FOREIGN KEY (`Child_ID`) REFERENCES `child` (`Child_ID`),
  ADD CONSTRAINT `result_ibfk_2` FOREIGN KEY (`Quiz_ID`) REFERENCES `quiz` (`Quiz_ID`);

--
-- Constraints for table `subtopic`
--
ALTER TABLE `subtopic`
  ADD CONSTRAINT `subtopic_ibfk_1` FOREIGN KEY (`Chapters_ID`) REFERENCES `chapters` (`Chapters_ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
