DROP TABLE user;
DROP TABLE product;
DROP TABLE productOrders;
DROP TABLE category;
DROP TABLE userOrders;

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
	cart VARCHAR(60000),
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

CREATE TABLE productOrders(
	orderid VARCHAR(255),
	pid VARCHAR(255),
	amount INT,	
	PRIMARY KEY (orderid),
	FOREIGN KEY (orderid) REFERENCES userOrders (orderid),
	FOREIGN KEY (pid) REFERENCES product (pid)
)

CREATE TABLE userOrders(
	orderid VARCHAR(255),
	userid INT,
	delivery_date DATE,	
	PRIMARY KEY (orderid),
	FOREIGN KEY (userid) REFERENCES user (userid)
)

CREATE TABLE category (
    name VARCHAR(127),
    PRIMARY KEY(name)
)
