drop table if exists Bid;
drop table if exists Category;
drop table if exists Item;
drop table if exists User;

drop table if exists coachCard;
drop table if exists myCollection;
drop table if exists cart;
drop table if exists serialLibrary;
drop table if exists playerCard;
drop table if exists nbaTeams;
drop table if exists user;



create table user(
        customerID VARCHAR(20) NOT NULL DEFAULT '',
        name varchar(30),
        hashingPassword VARCHAR(255),
	gameCoins INT DEFAULT 1000000,
        PRIMARY KEY(customerID));

create table nbaTeams(
        name varchar(20) not null,
        city varchar(30) not null,
        division varchar(20) not null,
        PRIMARY KEY(name));

create table playerCard(
        playerID INT NOT NULL DEFAULT 0,
        name VARCHAR(30) NOT NULL default '',
        position char(2) NOT NULL,
        height decimal(3,2) DEFAULT 0,
        weight DECIMAL(5,2) DEFAULT 0,
        age int NOT NULL,
        team varchar(20) NOT NULL,
        color VARCHAR(20) not NULL,
        overall int DEFAULT 0,
	inside int default 0,
	outside int default 0,
	playmaking int default 0,
	athleticism int default 0,
	defense int default 0,
	rebound int default 0,
	price int default 0,
        PRIMARY KEY(playerID),
        FOREIGN KEY(team)REFERENCES nbaTeams(name) on delete CASCADE);

create table serialLibrary(
        serialNumber BIGINT not null,
        ID int not null,
	customerID varchar(20),
        PRIMARY KEY(serialNumber),
        FOREIGN KEY(ID) REFERENCES playerCard(playerID) on delete CASCADE,
	FOREIGN KEY(customerID) REFERENCES user(customerID) on delete CASCADE);

create table cart(
        userID VARCHAR(20) NOT NULL DEFAULT '',
        serialNumber BIGINT NOT NULL,
        PRIMARY KEY(serialNumber),
        FOREIGN KEY(userID)REFERENCES user(customerID),
        FOREIGN KEY(serialNumber)REFERENCES serialLibrary(serialNumber) on delete CASCADE);


