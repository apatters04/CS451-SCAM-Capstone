-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 06, 2023 at 03:32 AM
-- Server version: 8.0.31
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cs451r`
--

-- --------------------------------------------------------

--
-- Table structure for table `activejobs`
--

DROP TABLE IF EXISTS `activejobs`;
CREATE TABLE IF NOT EXISTS `activejobs` (
  `jobType` text NOT NULL,
  `courseCode` text NOT NULL,
  `courseInstructor` text NOT NULL,
  `courseDays` varchar(10) NOT NULL,
  `courseTime` time(6) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `activejobs`
--

INSERT INTO `activejobs` (`jobType`, `courseCode`, `courseInstructor`, `courseDays`, `courseTime`) VALUES
('Grader', 'CS101', 'Dr. Bob', 'M/W/F', '11:00:00.000000'),
('Lab Instructor', 'CS201L', 'Professor Deb', 'M', '10:00:00.000000'),
('Grader', 'CS191', 'Professor Quinn', 'T/TH', '13:00:00.000000'),
('Grader', 'CS201R', 'Dr. Kim', 'T/TH', '10:00:00.000000'),
('Grader', 'CS291', 'Professor Coleman', 'M/W/F', '15:00:00.000000'),
('Grader', 'CS303', 'Professor Mills', 'T/TH', '14:00:00.000000'),
('Grader', 'CS320', 'Professor Moss', 'M/W/F', '16:00:00.000000'),
('Grader', 'CS441', 'Dr. Bob', 'M/W/F', '10:00:00.000000'),
('Grader', 'CS349', 'Professor Norris', 'T/TH', '11:00:00.000000'),
('Grader', 'CS394R', 'Professor Quinn', 'M/W/TH/F', '09:00:00.000000'),
('Grader', 'CS404', 'Professor Kim', 'M/W/F', '10:00:00.000000'),
('Grader', 'CS449', 'Professor Moss', 'T/TH', '14:00:00.000000'),
('Grader', 'CS456', 'Professor Autumn', 'T/TH', '10:00:00.000000'),
('Grader', 'CS457', 'Dr. Kim', 'M/W/F', '16:00:00.000000'),
('Grader', 'CS458', 'Professor Mills', 'M/W/F', '13:00:00.000000'),
('Grader', 'CS461', 'Professor Autumn', 'M/W/F', '10:00:00.000000'),
('Grader', 'CS465R', 'Professor Deb', 'T/TH', '11:00:00.000000'),
('Grader', 'CS470', 'Professor McLean', 'T/TH', '15:00:00.000000'),
('Grader', 'CS5520', 'Dr. Flynn', 'M/W', '09:00:00.000000'),
('Grader', 'CS5525', 'Dr. Bob', 'T/TH', '08:00:00.000000'),
('Grader', 'CS5552A', 'Dr. Flynn', 'T/TH', '10:00:00.000000'),
('Grader', 'CS5565', 'Dr. Flynn', 'M/W/TH/F', '13:00:00.000000'),
('Grader', 'CS5573', 'Dr. Lin', 'M/W', '15:00:00.000000'),
('Grader', 'CS5590PA', 'Dr. Lin', 'T/TH', '13:00:00.000000'),
('Grader', 'CS5592', 'Professor McLean', 'M/W/F', '14:00:00.000000'),
('Grader', 'CS5596A', 'Dr. Kim', 'M/W/F', '13:00:00.000000'),
('Grader', 'CS5596B', 'Dr. Kim', 'M/W/F', '11:00:00.000000'),
('Grader', 'ECE216', 'Professor Juarez', 'M/W/F', '10:00:00.000000'),
('Grader', 'ECE226', 'Professor Osborne', 'M/W/F', '13:00:00.000000'),
('Grader', 'ECE228', 'Professor Juarez', 'M/W/F', '11:00:00.000000'),
('Grader', 'ECE241', 'Professor Osborne', 'T/TH', '14:00:00.000000'),
('Grader', 'ECE276', 'Professor Gilbert', 'M/W/F', '09:00:00.000000'),
('Grader', 'ECE302', 'Professor Parsons', 'T/TH', '10:00:00.000000'),
('Grader', 'ECE330', 'Professor Gilbert', 'T/TH', '11:00:00.000000'),
('Grader', 'ECE341R', 'Professor Parsons', 'T/TH', '13:00:00.000000'),
('Grader', 'ECE428R', 'Professor Gilbert', 'M/W/F', '13:00:00.000000'),
('Grader', 'ECE458', 'Professor Juarez', 'T/TH', '11:00:00.000000'),
('Grader', 'ECE466', 'Professor Juarez', 'T/TH', '14:00:00.000000'),
('Grader', 'ECE477', 'Professor Osborne', 'M/W', '17:00:00.000000'),
('Grader', 'ECE486', 'Professor Parsons', 'M/W/F', '10:00:00.000000'),
('Grader', 'ECE5558', 'Dr. Reese', 'M/W/F', '10:00:00.000000'),
('Grader', 'ECE5560', 'Dr. Reese', 'M/W/F', '13:00:00.000000'),
('Grader', 'ECE5567', 'Dr. Lang', 'M/W/F', '10:00:00.000000'),
('Grader', 'ECE5577', 'Dr. Lang', 'T/TH', '13:00:00.000000'),
('Grader', 'ECE5578', 'Dr. Reese', 'T/TH', '11:00:00.000000'),
('Grader', 'ECE5586', 'Dr. Lang', 'T/TH', '15:00:00.000000'),
('Grader', 'IT222', 'Professor Munoz', 'M/W/F', '09:00:00.000000'),
('Grader', 'IT321', 'Professor Mann', 'T/TH', '10:00:00.000000'),
('Lab Instructor', 'CS101L', 'Dr. Bob', 'W', '19:00:00.000000'),
('Lab Instructor', 'ECE227', 'Professor Gilbert', 'W', '11:00:00.000000'),
('Lab Instructor', 'ECE229', 'Professor Medina', 'T', '14:00:00.000000'),
('Lab Instructor', 'ECE277', 'Professor Murphy', 'TH', '13:00:00.000000'),
('Lab Instructor', 'ECE303', 'Professor Bishop', 'T/TH', '16:00:00.000000'),
('Lab Instructor', 'ECE377', 'Professor Mendoza', 'M/W', '14:00:00.000000'),
('Lab Instructor', 'ECE331', 'Professor Bishop', 'M/W', '10:00:00.000000'),
('Lab Instructor', 'ECE427', 'Professor Murphy', 'M/W', '13:00:00.000000'),
('Lab Instructor', 'ECE429', 'Professor Medina', 'M', '09:00:00.000000');

-- --------------------------------------------------------

--
-- Table structure for table `application`
--

DROP TABLE IF EXISTS `application`;
CREATE TABLE IF NOT EXISTS `application` (
  `idNo` int NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `studentID` text NOT NULL,
  `email` varchar(255) NOT NULL,
  `phoneNumber` varchar(10) NOT NULL,
  `currentLevel` varchar(255) NOT NULL,
  `graduatingSemester` varchar(6) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `graduatingYear` int NOT NULL,
  `GPA` decimal(3,0) DEFAULT NULL,
  `hoursCompleted` int DEFAULT NULL,
  `degree` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `major` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `applyingJob` varchar(14) NOT NULL DEFAULT 'Grader',
  `internationalStudent` varchar(3) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `GTACert` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `description` varchar(400) NOT NULL,
  `serveInstructor` varchar(255) NOT NULL,
  `resume` varchar(255) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(20) NOT NULL DEFAULT 'Submitted',
  PRIMARY KEY (`idNo`,`timestamp`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `application`
--

INSERT INTO `application` (`idNo`, `firstName`, `lastName`, `studentID`, `email`, `phoneNumber`, `currentLevel`, `graduatingSemester`, `graduatingYear`, `GPA`, `hoursCompleted`, `degree`, `major`, `applyingJob`, `internationalStudent`, `GTACert`, `description`, `serveInstructor`, `resume`, `timestamp`, `status`) VALUES
(6, 'Rupert', 'Leo', '324534', 'testemaildatabseread@email.com', '6666611445', 'PhD', 'Spring', 2024, '4', 69, 'humanities', 'ECE', 'Both', 'Yes', '', '', 'CS101, CS201, IT404', '', '2023-12-06 03:24:37', 'Reviewing'),
(9, 'christian', 'wellcald', '2147483647', 'caldwellchristian2@gmail.com', '9139525135', 'BS', 'Fall', 2023, '3', 0, '', 'CS', 'Grader', 'No', '', '', '2345CS', '', '2023-12-06 03:31:19', 'Interviewing');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

DROP TABLE IF EXISTS `login`;
CREATE TABLE IF NOT EXISTS `login` (
  `username` varchar(20) NOT NULL,
  `firstName` varchar(20) NOT NULL,
  `lastName` varchar(20) NOT NULL,
  `studentID` int NOT NULL,
  `password` varchar(20) NOT NULL,
  `type` varchar(10) NOT NULL DEFAULT 'student',
  `idNo` int NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `phoneNo` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  UNIQUE KEY `username` (`username`),
  KEY `idNo` (`idNo`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`username`, `firstName`, `lastName`, `studentID`, `password`, `type`, `idNo`, `email`, `phoneNo`) VALUES
('chr', 'ChristianA', 'Caldwell', 32, '123', 'admin', 1, 'admindatabseemail@email.com', '6666611445'),
('and', 'andistudent', 'patterson', 42, '123', 'student', 2, 'testemaildatabseread@email.com', '6666611445'),
('cchr', 'Christian', 'Caldwell', 45454545, '123', 'student', 3, 'testemaildatabseread@email.com', '6666611445'),
('studenttestinguserna', 'studentfirstnametest', 'studentlastnamettest', 102901920, 'studenttestpassword', 'student', 4, 'testemaildatabseread@email.com', '6666611445'),
('studenttesdtingusern', 'studentfirstnametest', 'studentlastnamettest', 102901920, 'd', 'student', 5, 'testemaildatabseread@email.com', '6666611445'),
('catman', 'Rupert', 'Leo', 324534, '123', 'student', 6, 'testemaildatabseread@email.com', '6666611445'),
('cheryy', 'cherry', 'boberry', 123456, '123', 'student', 7, 'cher@cheryr', '1122334455'),
('88', 'asdf', 'asdf', 888888, '123', 'student', 8, 'asdf@asdf.com', '1234567890'),
('ccaldwell', 'christian', 'wellcald', 2147483647, '1234', 'student', 9, 'caldwellchristian2@gmail.com', '9139525135');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
