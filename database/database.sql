
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

USE Gameweb;
-- Customers table
CREATE TABLE Customers (
    customerID INT NOT NULL PRIMARY KEY,
    customerName VARCHAR(50) NOT NULL,
    age INT,
    gender BIT,  
    joinDate DATE,
    birthDate DATE
);
CREATE TABLE Game (
  gameID INT NOT NULL PRIMARY KEY,
  gameName VARCHAR(50) NOT NULL,
  gameCategory VARCHAR(50) NOT NULL,
  gameImage VARCHAR(255),
  gameVideo VARCHAR(255),
  gameStudio VARCHAR(50) NOT NULL,
  gameAge INT NOT NULL
);
CREATE TABLE Orders (
    orderID INT NOT NULL PRIMARY KEY,
    customerID INT NOT NULL,
    orderDate DATE NOT NULL,
    gameID INT NOT NULL,
    FOREIGN KEY (customerID) REFERENCES Customers(customerID),
    FOREIGN KEY (gameID) REFERENCES Game(gameID)
);
CREATE TABLE Library (
    libraryID INT NOT NULL PRIMARY KEY,
    customerID INT,
    gameID INT,
    FOREIGN KEY (customerID) REFERENCES Customers(customerID),
    FOREIGN KEY (gameID) REFERENCES Game(gameID)
);

-- Comment table
CREATE TABLE Comment (
    commentID INT NOT NULL PRIMARY KEY,
    customerID INT,
    customerDescription VARCHAR(255),
    FOREIGN KEY (customerID) REFERENCES Customers(customerID)
);

-- Post table
CREATE TABLE Post (
    postID INT NOT NULL PRIMARY KEY,
    customerID INT,
    commentID INT,
    postDescription VARCHAR(255),
    FOREIGN KEY (customerID) REFERENCES Customers(customerID),
    FOREIGN KEY (commentID) REFERENCES Comment(commentID)
);

-- Community table
CREATE TABLE Community (
    communityID INT NOT NULL PRIMARY KEY,
    postID INT,
    gameID INT,
    FOREIGN KEY (postID) REFERENCES Post(postID),
    FOREIGN KEY (gameID) REFERENCES Game(gameID)
);