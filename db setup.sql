DROP TABLE user;
DROP TABLE product;
DROP TABLE transaction;

CREATE TABLE user (
	userid INT AUTO_INCREMENT,
	email VARCHAR(255) NOT NULL,
	password VARCHAR(255) NOT NULL,
	firstname VARCHAR(63),
	lastname VARCHAR(63),
	city VARCHAR(31),
	postal VARCHAR(15),
	address VARCHAR(255),
	phone VARCHAR(15),
	PRIMARY KEY(userid)
)

CREATE TABLE product (
	pid VARCHAR(63),
	pcategory VARCHAR(127),
	pname VARCHAR(255),
	pdesc VARCHAR(10000),
	imageurl VARCHAR(255),
	price float,
	PRIMARY KEY(pid)
)

CREATE TABLE transaction (
	transid VARCHAR(63),
	userid INT,
	pid VARCHAR(63),	
	PRIMARY KEY (transid),
	FOREIGN KEY (userid) REFERENCES user (userid),
	FOREIGN KEY (pid) REFERENCES product (pid)
)

CREATE TABLE category (
    name VARCHAR(127),
    PRIMARY KEY(name)
)

/* ALL STORES THAT MAKE PURCHASES USE USERID = 1 */
INSERT INTO user VALUES ('1', 'other_stores', 'other_stores', null, null, null, null, null, null);
