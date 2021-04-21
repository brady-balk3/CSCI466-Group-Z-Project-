-- Group Z
-- Z1905404, 
-- CSCI466

-- Drop table statements to reset database after it has been ran
DROP TABLE FQ;
DROP TABLE PQ;
DROP TABLE Contributes;
DROP TABLE KaraokeFile;
DROP TABLE Artist;
DROP TABLE User;
DROP TABLE Contributor;
DROP TABLE Title;


-- create table statements to make all required tables in the database
CREATE TABLE Artist(ArtistID int NOT NULL AUTO_INCREMENT, Name varchar(100), PRIMARY KEY(ArtistID));
CREATE TABLE User(UserID int NOT NULL AUTO_INCREMENT, Name varchar(100), PRIMARY KEY(UserID));
CREATE TABLE Contributor(ConID int NOT NULL AUTO_INCREMENT, Name varchar(100), PRIMARY KEY(ConID));
CREATE TABLE Title(TitleID int NOT NULL AUTO_INCREMENT, Name varchar(100), PRIMARY KEY(TitleID));
CREATE TABLE KaraokeFile(FileID int NOT NULL AUTO_INCREMENT, Version int NOT NULL, ArtistID int, TitleID int, PRIMARY KEY(FileID), FOREIGN KEY(ArtistID) REFERENCES Artist(ArtistID), FOREIGN KEY(TitleID) REFERENCES Title(TitleID));
CREATE TABLE Contributes(Position varchar(100) NOT NULL, ConID int, FileID int, PRIMARY KEY(ConID, FileID), FOREIGN KEY(ConID) REFERENCES Contributor(ConID), FOREIGN KEY(FileID) REFERENCES KaraokeFile(FileID));
CREATE TABLE FQ(FQID int NOT NULL AUTO_INCREMENT, UserID int, FileID int, Time TIME, Playing BOOLEAN, PRIMARY KEY(FQID), FOREIGN KEY(UserID) REFERENCES User(UserID), FOREIGN KEY(FileID) REFERENCES KaraokeFile(FileID));
CREATE TABLE PQ(PQID int NOT NULL AUTO_INCREMENT, UserID int, FileID int, Time TIME, Playing BOOLEAN, Price DOUBLE, PRIMARY KEY(PQID), FOREIGN KEY(UserID) REFERENCES User(UserID), FOREIGN KEY(FileID) REFERENCES KaraokeFile(FileID));
