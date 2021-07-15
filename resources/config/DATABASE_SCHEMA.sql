DROP DATABASE IF EXISTS DAW; 
CREATE DATABASE DAW;
USE DAW;

CREATE TABLE USERS(
	id INT PRIMARY KEY AUTO_INCREMENT,
	username VARCHAR(255) NOT NULL,
	email VARCHAR(255) UNIQUE NOT NULL,
	displayname VARCHAR(255),
	password VARCHAR(255) NOT NULL,
	deleted BOOL
);

CREATE TABLE STASHES(
	id INT PRIMARY KEY AUTO_INCREMENT,
	name VARCHAR(255),
	location VARCHAR(255),
	user INT,
	deleted BOOL,
	FOREIGN KEY (user) REFERENCES USERS(id)
);


CREATE TABLE CATEGORIES(
	id INT PRIMARY KEY AUTO_INCREMENT,
	name VARCHAR(255),
	stash INT,
	deleted BOOL,
	FOREIGN KEY (stash) REFERENCES STASHES(id)
);


CREATE TABLE ITEMS(
	id INT PRIMARY KEY AUTO_INCREMENT,
	name VARCHAR(255),
	category INT,
	description LONGTEXT,
	quantity INT,
	status VARCHAR(255),
	deleted BOOL,
	FOREIGN KEY (category) REFERENCES CATEGORIES(id)
);

/*CREATE TABLE INVENTORY(
	itemid INT,
	owner INT,
	quantity INT,
	FOREIGN KEY (itemid) REFERENCES ITEMS(id),
	FOREIGN KEY	(owner) REFERENCES USERS(id),
	PRIMARY KEY (itemid, owner)
);*/