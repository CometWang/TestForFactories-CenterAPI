DROP DATABASE IF EXISTS test;
CREATE DATABASE test;
USE test;

DROP TABLE IF EXISTS `rrsecbk`;

CREATE TABLE `rrsecbk`(
	`uid` int(10) unsigned NOT NULL AUTO_INCREMENT,
	`miiosn`   varchar(30)  DEFAULT NULL,
	`miiodid`    varchar(30)  DEFAULT NULL,
	`miiomac`    varchar(30)  DEFAULT NULL,
	`appassword`        varchar(10)       DEFAULT NULL,
	`cpusn`      varchar(20)   DEFAULT NULL,
	`infor`      varchar(20) DEFAULT NULL,
	PRIMARY KEY (`uid`)

); 
DROP TABLE IF EXISTS `rrsecdevinfobk`;
CREATE TABLE `rrsecdevinfobk`(
	`uid` int(10) unsigned NOT NULL AUTO_INCREMENT,
	`miiosn`   varchar(30)  DEFAULT NULL,
	`pn`    varchar(30)  DEFAULT NULL,
    `infor`  varchar(30) DEFAULT NULL,
	PRIMARY KEY (`uid`)

); 
INSERT INTO rrsecbk (uid, miiosn,miiomac, miiodid, appassword, cpusn, infor)VALUES
('','TN1234567','re1231','aaaads','sdfianis12','sdfsda','bbbbb'),
('','TN1234568','re1231','aaaads','sdfianis12','sdfsda','bbbbb'),
('','TN1234569','re1231','aaaads','sdfianis12','sdfsda','bbbbb'),
('','TN1234577','re1231','aaaads','sdfianis12','sdfsda','bbbbb'),
('','TN1234576','re1231','aaaads','sdfianis12','sdfsda','bbbbb'),
('','TN1234575','re1231','aaaads','sdfianis12','sdfsda','bbbbb'),
('','TN1234574','re1231','aaaads','sdfianis12','sdfsda','bbbbb'),
('','TN1234573','re1231','aaaads','sdfianis12','sdfsda','bbbbb'),
('','TN1234573','re1231','aaaads','sdfianis12','sdfsda','bbbbb'),
('','TN1234576','re1231','aaaads','sdfianis12','sdfsda','bbbbb'),
('','TN1234567','re1231','aaaads','sdfianis12','sdfsda','bbbbb'),
('','TN1234567','re1231','aaaads','sdfianis12','sdfsda','bbbbb'),

('','TN1234568','re122221','aaaads','sdfianis12','sdfsda','bbbbb'),
('','TN1234568','re12111','aaaads','sdfianis12','sdfsda','bbbbb'),
('','TN1234569','re1231','aaaads','sdfianis12','sdfsda','bbbbb'),
('','TN1234569','re1231','aaaads','sdfianis12','sdfsda','bbbbb');


INSERT INTO rrsecdevinfobk (uid, miiosn, pn, infor)VALUES
('','TN1234567','SN1234567','sdfadfsw'),
('','TN1234568','SN1234568','sdfadfsw'),
('','TN1234574','SN1234532','sdfadfsw'),
('','TN1234573','SN1234553','sdfadfsw'),
('','TN1234574','SN1234523','sdfadfsw'),
('','TN1234576','SN1234586','sdfadfsw'),
('','TN1234569','SN1234574','sdfadfsw'),
('','TN1234569','SN1234566','sdfadfsw'),
('','TN1234569','SN1234588','sdfadfsw'),

('','TN1234569','SN1234577','sdfadfsw'),
('','TN1234568','SN1234599','sdfadfsw'),
('','TN1234567','SN1234535','sdfadfsw'),
('','TN1234567','SN1234597','sdfadfsw'),
('','TN1234567','SN1234596','sdfadfsw'),
('','TN1234567','SN1234534','sdfadfsw'),
('','TN1234567','SN1234575','sdfadfsw'),
('','TN1234567','SN1234509','sdfadfsw'),
('','TN1234567','SN1234507','sdfadfsw'),
('','TN1234567','SN1234503','sdfadfsw');