-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1:3306
-- Thời gian đã tạo: Th12 24, 2023 lúc 03:58 PM
-- Phiên bản máy phục vụ: 8.0.31
-- Phiên bản PHP: 8.1.13
SET
    SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";

START TRANSACTION;

SET
    time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */
;

/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */
;

/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */
;

/*!40101 SET NAMES utf8mb4 */
;

--
-- Cơ sở dữ liệu: `gameweb`
--
CREATE DATABASE IF NOT EXISTS `gameweb` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;

USE `gameweb`;

-- --------------------------------------------------------
--
-- Cấu trúc bảng cho bảng `comment`
--
DROP TABLE IF EXISTS `comment`;

CREATE TABLE IF NOT EXISTS `comment` (
    `commentID` int NOT NULL,
    `customerID` int DEFAULT NULL,
    `customerDescription` varchar(255) DEFAULT NULL,
    PRIMARY KEY (`commentID`),
    KEY `customerID` (`customerID`)
) ENGINE = MyISAM DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci;

--
-- Đang đổ dữ liệu cho bảng `comment`
--
INSERT INTO
    `comment` (`commentID`, `customerID`, `customerDescription`)
VALUES
    (301, 1, 'Trò chơi tuyệt vời!'),
    (302, 2, 'Mình thích chơi cái này.'),
    (303, 3, 'Chờ đợi thêm cập nhật.');

-- --------------------------------------------------------
--
-- Cấu trúc bảng cho bảng `community`
--
DROP TABLE IF EXISTS `community`;

CREATE TABLE IF NOT EXISTS `community` (
    `communityID` int NOT NULL,
    `postID` int DEFAULT NULL,
    `gameID` int DEFAULT NULL,
    PRIMARY KEY (`communityID`),
    KEY `postID` (`postID`),
    KEY `gameID` (`gameID`)
) ENGINE = MyISAM DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci;

--
-- Đang đổ dữ liệu cho bảng `community`
--
INSERT INTO
    `community` (`communityID`, `postID`, `gameID`)
VALUES
    (501, 401, 1),
    (502, 402, 2),
    (503, 403, 3);

-- --------------------------------------------------------
--
-- Cấu trúc bảng cho bảng `customers`
--
DROP TABLE IF EXISTS `customers`;

CREATE TABLE IF NOT EXISTS `customers` (
    `customerID` int NOT NULL,
    `customerName` varchar(50) NOT NULL,
    `age` int DEFAULT NULL,
    `gender` bit(1) DEFAULT NULL,
    `joinDate` date DEFAULT NULL,
    `birthDate` date DEFAULT NULL,
    PRIMARY KEY (`customerID`)
) ENGINE = MyISAM DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci;

--
-- Đang đổ dữ liệu cho bảng `customers`
--
INSERT INTO
    `customers` (
        `customerID`,
        `customerName`,
        `age`,
        `gender`,
        `joinDate`,
        `birthDate`
    )
VALUES
    (
        3,
        'Nguyễn Văn A',
        25,
        b '1',
        '2023-01-01',
        '1998-05-15'
    ),
    (
        4,
        'Trần Thị B',
        30,
        b '0',
        '2023-02-15',
        '1992-09-20'
    ),
    (
        5,
        'Lê Văn C',
        22,
        b '1',
        '2023-03-10',
        '2000-11-08'
    );

-- --------------------------------------------------------
--
-- Cấu trúc bảng cho bảng `game`
--
DROP TABLE IF EXISTS `game`;

CREATE TABLE IF NOT EXISTS `game` (
    `gameID` int NOT NULL,
    `gameName` varchar(50) NOT NULL,
    `gameCategory` varchar(50) NOT NULL,
    `gameImage` varchar(255) DEFAULT NULL,
    `gameVideo` varchar(255) DEFAULT NULL,
    `gameDescription` varchar(255) DEFAULT NULL,
    `gameStudio` varchar(50) NOT NULL,
    `gameAge` int NOT NULL,
    PRIMARY KEY (`gameID`)
) ENGINE = MyISAM DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci;

--
-- Đang đổ dữ liệu cho bảng `game`
--
INSERT INTO
    `game` (
        `gameID`,
        `gameName`,
        `gameCategory`,
        `gameImage`,
        `gameVideo`,
        `gameDescription`,
        `gameStudio`,
        `gameAge`
    )
VALUES
    (
        10,
        'Assassins Creed Valhalla',
        'Action-Adventure',
        'https://gamepreorders.com/wp-content/uploads/2020/04/cover-art-2.jpg',
        'https://www.youtube.com/watch?v=1wiclO4a60A&t=1s&ab_channel=Ubisoft',
        NULL,
        'Ubisoft',
        18
    ),
    (
        4,
        'Forza Horizon 4',
        'Racing',
        'https://tse2.mm.bing.net/th?id=OIP.Ji1EMf-BmiT3AShzvoDs5QHaLH&pid=Api&P=0&h=180',
        'https://www.youtube.com/watch?v=5xy4n73WOMM&ab_channel=IGN',
        NULL,
        'Playground Games',
        3
    ),
    (
        5,
        'Minecraft',
        'Sandbox',
        'https://www.pngmart.com/files/7/Minecraft-PNG-Photos.png',
        'https://www.youtube.com/watch?v=rvlwWiskcLk&ab_channel=Minecraft',
        NULL,
        'Mojang',
        7
    ),
    (
        6,
        'Candy Crush Saga',
        'Sweet game',
        'https://venturebeat.com/wp-content/uploads/2017/11/candy-crush-saga.jpg?fit=905%2C953&strip=all',
        'https://www.youtube.com/watch?v=-KXGC4O3UL4&ab_channel=CandyCrushSagaOfficial',
        NULL,
        'King.com',
        0
    ),
    (
        9,
        'FIFA 22',
        'Sports',
        'https://tse1.mm.bing.net/th?id=OIP.0M6pv-C_XQTN_gyfFVYnkgHaEo&pid=Api&P=0&h=180',
        'https://www.youtube.com/watch?v=MCBlop0KlLg&ab_channel=Ninja%5BTv%5D',
        NULL,
        'EA Sports',
        3
    ),
    (
        7,
        'Cyberpunk 2077',
        'Role-Playing',
        'https://tse4.mm.bing.net/th?id=OIP.5lz3a5kc-X-RW9sXZpJhSwHaNK&pid=Api&P=0&h=180',
        'https://www.youtube.com/watch?v=sJbexcm4Trk&ab_channel=Cyberpunk2077',
        NULL,
        'CD Projekt',
        18
    ),
    (
        8,
        'The Legend of Zelda: Breath of the Wild',
        'Action-Adventure',
        'https://tse3.mm.bing.net/th?id=OIP.89c7t46UzIAqA5A5_EW4LwHaEK&pid=Api&P=0&h=180',
        'https://www.youtube.com/watch?v=ebOFIvAGG3Y&ab_channel=NintendoofAmerica',
        NULL,
        'Nintendo',
        12
    ),
    (
        11,
        'Call of Duty: Warzone',
        'First-Person Shooter',
        'https://tse3.mm.bing.net/th?id=OIP.NSNSp4aTWGfwM_gs5uBwDwHaHa&pid=Api&P=0&h=180',
        'https://www.youtube.com/watch?v=DVjCUkrHHcY&ab_channel=CallofDuty',
        NULL,
        'Infinity Ward',
        18
    );

-- --------------------------------------------------------
--
-- Cấu trúc bảng cho bảng `library`
--
DROP TABLE IF EXISTS `library`;

CREATE TABLE IF NOT EXISTS `library` (
    `libraryID` int NOT NULL,
    `customerID` int DEFAULT NULL,
    `gameID` int DEFAULT NULL,
    PRIMARY KEY (`libraryID`),
    KEY `customerID` (`customerID`),
    KEY `gameID` (`gameID`)
) ENGINE = MyISAM DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci;

--
-- Đang đổ dữ liệu cho bảng `library`
--
INSERT INTO
    `library` (`libraryID`, `customerID`, `gameID`)
VALUES
    (501, 1, 1),
    (502, 2, 2),
    (503, 3, 3);

-- --------------------------------------------------------
--
-- Cấu trúc bảng cho bảng `orders`
--
DROP TABLE IF EXISTS `orders`;

CREATE TABLE IF NOT EXISTS `orders` (
    `orderID` int NOT NULL,
    `customerID` int NOT NULL,
    `orderDate` date NOT NULL,
    `gameID` int NOT NULL,
    PRIMARY KEY (`orderID`),
    KEY `customerID` (`customerID`),
    KEY `gameID` (`gameID`)
) ENGINE = MyISAM DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci;

--
-- Đang đổ dữ liệu cho bảng `orders`
--
INSERT INTO
    `orders` (`orderID`, `customerID`, `orderDate`, `gameID`)
VALUES
    (111, 1, '2023-01-02', 1),
    (112, 2, '2023-02-16', 2),
    (113, 3, '2023-03-11', 3),
    (104, 1, '2023-04-05', 4),
    (105, 2, '2023-05-20', 5),
    (106, 3, '2023-06-15', 6);

-- --------------------------------------------------------
--
-- Cấu trúc bảng cho bảng `post`
--
DROP TABLE IF EXISTS `post`;

CREATE TABLE IF NOT EXISTS `post` (
    `postID` int NOT NULL,
    `customerID` int DEFAULT NULL,
    `commentID` int DEFAULT NULL,
    `postDescription` varchar(255) DEFAULT NULL,
    PRIMARY KEY (`postID`),
    KEY `customerID` (`customerID`),
    KEY `commentID` (`commentID`)
) ENGINE = MyISAM DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci;

--
-- Đang đổ dữ liệu cho bảng `post`
--
INSERT INTO
    `post` (
        `postID`,
        `customerID`,
        `commentID`,
        `postDescription`
    )
VALUES
    (
        401,
        1,
        301,
        'Đánh giá của mình về Assassins Creed Valhalla'
    ),
    (402, 2, 302, 'Cảm nhận về Forza Horizon 4'),
    (403, 3, 303, 'Hóng những bản cập nhật mới.');

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */
;

/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */
;

/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */
;