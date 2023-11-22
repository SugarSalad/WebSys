-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 22, 2023 at 05:36 AM
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
-- Database: `h20`
--

DELIMITER $$
--
-- Procedures
--
DROP PROCEDURE IF EXISTS `SP_CreateAccount`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_CreateAccount` (IN `username` VARCHAR(100), IN `password` VARCHAR(255), IN `level` VARCHAR(20), IN `name` VARCHAR(100), IN `housenum` VARCHAR(100), IN `sex` VARCHAR(20), IN `email` VARCHAR(100))   INSERT INTO tbl_account(Username, Password, Level, Name, HouseNumber, Sex, Email)
VALUES(username, password, level, name, housenum, sex, email)$$

DROP PROCEDURE IF EXISTS `SP_CreateBill`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_CreateBill` (IN `p_userID` INT, IN `p_date` DATE, IN `p_meter` FLOAT, IN `p_amount` FLOAT, IN `p_status` VARCHAR(20))   BEGIN
    INSERT INTO tbl_bill (UserID, Date, Meter, Amount, Status)
    VALUES (p_userID, p_date, p_meter, p_amount, p_status);
END$$

DROP PROCEDURE IF EXISTS `SP_DeleteAccount`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_DeleteAccount` (IN `id` INT)   DELETE FROM tbl_account WHERE tbl_account.UserID = id$$

DROP PROCEDURE IF EXISTS `SP_DeleteBill`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_DeleteBill` (IN `id` INT)   DELETE FROM tbl_bill WHERE tbl_bill.BillID = id$$

DROP PROCEDURE IF EXISTS `SP_DisplayAccount`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_DisplayAccount` ()   SELECT 
UserID, Name, HouseNumber, Sex, Email, Username, Password, Level
FROM tbl_account$$

DROP PROCEDURE IF EXISTS `SP_DisplayBill`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_DisplayBill` ()   SELECT
    tbl_bill.BillID,
    tbl_account.Name,
    tbl_account.HouseNumber,
    tbl_bill.Date,
    tbl_bill.Meter,
    tbl_bill.Amount,
    tbl_bill.Status
FROM
    tbl_bill
INNER JOIN
    tbl_account ON tbl_bill.UserID = tbl_account.UserID$$

DROP PROCEDURE IF EXISTS `SP_DisplayUserBill`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_DisplayUserBill` (IN `id` INT)   SELECT
tbl_bill.Meter,
tbl_bill.Date,
tbl_bill.Amount,
tbl_bill.Status
FROM tbl_bill
INNER JOIN tbl_account ON tbl_bill.UserID = tbl_account.UserID
WHERE tbl_bill.UserID = id$$

DROP PROCEDURE IF EXISTS `SP_GetAccount`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_GetAccount` (IN `id` VARCHAR(100), IN `password` VARCHAR(255))   SELECT
    tbl_account.UserID,
    tbl_account.Username,
    tbl_account.Password,
    tbl_account.Level,
    tbl_account.Name,
    tbl_account.HouseNumber,
    tbl_account.Sex,
    tbl_account.Email
FROM tbl_account
WHERE tbl_account.Username = id AND tbl_account.Password = password$$

DROP PROCEDURE IF EXISTS `SP_GetName`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_GetName` (IN `p_name` VARCHAR(100), OUT `p_userID` INT)   BEGIN
    SELECT UserID INTO p_userID
    FROM tbl_account
    WHERE Name = p_name;
END$$

DROP PROCEDURE IF EXISTS `SP_UpdateBill`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `SP_UpdateBill` (IN `p_BillID` INT, IN `p_UserID` INT, IN `p_Date` DATE, IN `p_Meter` FLOAT, IN `p_Amount` FLOAT, IN `p_Status` VARCHAR(10))   BEGIN
    UPDATE tbl_bill
    SET 
        UserID = p_UserID,
        Date = p_Date,
        Meter = p_Meter,
        Amount = p_Amount,
        Status = p_Status
    WHERE 
        BillID = p_BillID;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_account`
--

DROP TABLE IF EXISTS `tbl_account`;
CREATE TABLE IF NOT EXISTS `tbl_account` (
  `UserID` int NOT NULL AUTO_INCREMENT,
  `Username` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Level` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `HouseNumber` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Sex` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`UserID`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_account`
--

INSERT INTO `tbl_account` (`UserID`, `Username`, `Password`, `Level`, `Name`, `HouseNumber`, `Sex`, `Email`) VALUES
(2, 'jomar', 'reyes', 'User', 'Jomar Reyes', '189-B', 'Male', 'jomar@gmail.com'),
(3, 'kim', 'pao', 'User', 'Kim Paolo Cuenca', '177-C', 'Male', 'kim@gmail.com'),
(4, 'boy', 'girl', 'Admin', 'Boy Girl', '200-A', 'Male', 'boygirl@gmail.com'),
(13, 'cyrus', 'pogi', 'Admin', 'Cyrus Tapalla', '187-A', 'Male', 'cyrus@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_bill`
--

DROP TABLE IF EXISTS `tbl_bill`;
CREATE TABLE IF NOT EXISTS `tbl_bill` (
  `BillId` int NOT NULL AUTO_INCREMENT,
  `UserID` int NOT NULL,
  `Date` date NOT NULL,
  `Meter` float NOT NULL,
  `Amount` float NOT NULL,
  `Status` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`BillId`),
  KEY `UserID_fk_Bill` (`UserID`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tbl_bill`
--

INSERT INTO `tbl_bill` (`BillId`, `UserID`, `Date`, `Meter`, `Amount`, `Status`) VALUES
(2, 3, '2023-11-16', 124.55, 655.25, 'Paid'),
(3, 2, '2023-11-01', 1233, 544.66, 'Paid'),
(4, 3, '2023-11-18', 124, 655.22, 'Paid'),
(12, 2, '2023-11-18', 556, 555.55, 'Paid'),
(13, 3, '2023-11-21', 127.57, 1000.55, 'Paid'),
(15, 3, '2023-11-21', 124.55, 655.25, 'Unpaid');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_bill`
--
ALTER TABLE `tbl_bill`
  ADD CONSTRAINT `UserID_fk_Bill` FOREIGN KEY (`UserID`) REFERENCES `tbl_account` (`UserID`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
