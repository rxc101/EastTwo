-- phpMyAdmin SQL Dump
-- version 4.0.10.12
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 27, 2016 at 09:30 PM
-- Server version: 5.5.46
-- PHP Version: 5.6.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `East`
--

-- --------------------------------------------------------

--
-- Table structure for table `assignments`
--

CREATE TABLE IF NOT EXISTS `assignments` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(50) NOT NULL,
  `MaxPoints` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `assignments`
--

INSERT INTO `assignments` (`ID`, `Name`, `MaxPoints`) VALUES
(1, 'First Assignment ', 23);

-- --------------------------------------------------------

--
-- Table structure for table `assignmentsubmissions`
--

CREATE TABLE IF NOT EXISTS `assignmentsubmissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `AssID` int(11) NOT NULL,
  `SubID` int(11) NOT NULL,
  `StudentID` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `assignmentsubmissions`
--

INSERT INTO `assignmentsubmissions` (`id`, `AssID`, `SubID`, `StudentID`) VALUES
(1, 1, 1, 2),
(2, 1, 2, 3),
(3, 1, 3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `courseassignments`
--

CREATE TABLE IF NOT EXISTS `courseassignments` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `CourseID` int(11) NOT NULL,
  `AssignmentID` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `courseassignments`
--

INSERT INTO `courseassignments` (`ID`, `CourseID`, `AssignmentID`) VALUES
(1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE IF NOT EXISTS `courses` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(50) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`ID`, `Name`) VALUES
(1, 'Volley Ball Course'),
(3, 'Another Class');

-- --------------------------------------------------------

--
-- Table structure for table `semesters`
--

CREATE TABLE IF NOT EXISTS `semesters` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(50) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `semesters`
--

INSERT INTO `semesters` (`ID`, `Name`) VALUES
(1, 'Spring 2016'),
(2, '2015 - Fall'),
(3, 'Summer -2015');

-- --------------------------------------------------------

--
-- Table structure for table `staffcourses`
--

CREATE TABLE IF NOT EXISTS `staffcourses` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `CourseID` int(11) NOT NULL,
  `StaffID` int(11) NOT NULL,
  `SemesterID` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `staffcourses`
--

INSERT INTO `staffcourses` (`ID`, `CourseID`, `StaffID`, `SemesterID`) VALUES
(1, 1, 1, 1),
(3, 3, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `studentcourses`
--

CREATE TABLE IF NOT EXISTS `studentcourses` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `StudentID` int(11) NOT NULL,
  `CourseID` int(11) NOT NULL,
  `SemesterID` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `studentcourses`
--

INSERT INTO `studentcourses` (`ID`, `StudentID`, `CourseID`, `SemesterID`) VALUES
(1, 2, 1, 1),
(3, 3, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `submissions`
--

CREATE TABLE IF NOT EXISTS `submissions` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `comments` varchar(250) NOT NULL,
  `feedback` varchar(250) NOT NULL,
  `graded` int(11) DEFAULT NULL,
  `fileloc` varchar(75) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `submissions`
--

INSERT INTO `submissions` (`ID`, `comments`, `feedback`, `graded`, `fileloc`) VALUES
(1, 'my comment', 'feed back ', 25, 'submissions/1/file.png'),
(2, 'asdf', 'adsf', 2, 'here'),
(3, 'adsf', 'asdf', NULL, '2341');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Email` varchar(30) NOT NULL,
  `AccountType` int(1) NOT NULL,
  `Password` varchar(20) NOT NULL,
  `FirstName` varchar(20) NOT NULL,
  `LastName` int(20) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`Id`, `Email`, `AccountType`, `Password`, `FirstName`, `LastName`) VALUES
(1, 'bob@bob.com', 1, 'password', '', 0),
(2, 'jim@jim.com', 0, 'password', '', 0),
(3, 'kill@kill.com', 0, 'pass', '', 0),
(4, 'pp@pete.com', 0, 'pass', 'Peter', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
