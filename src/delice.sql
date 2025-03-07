DROP TABLE IF EXISTS admins;

CREATE TABLE admins (
id BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
login VARCHAR(254) NOT NULL,
passwd VARCHAR(254) NOT NULL
) ENGINE = INNODB;

DROP TABLE IF EXISTS players;

CREATE TABLE  players (
id BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
cin VARCHAR( 10 ) NOT NULL ,
nom VARCHAR(254) NOT NULL,
prenom VARCHAR(254) NOT NULL,
age VARCHAR(10) NOT NULL,
tel VARCHAR( 10 ) NOT NULL ,
email VARCHAR(254) NOT NULL,
createdat DATETIME NOT NULL
) ENGINE = INNODB;
