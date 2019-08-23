DROP DATABASE IF EXISTS userdb;
CREATE DATABASE userdb;
USE userdb;

DROP TABLE IF EXISTS `accountls`;

CREATE TABLE `accountls`(
	`uid` int(10) unsigned NOT NULL AUTO_INCREMENT,
	`username`   varchar(32)   CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
	`psword`    varchar(32)  CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,


	PRIMARY KEY (`uid`)

); 
INSERT INTO accountls (uid, username, psword)VALUES
('', 'asdhiho1', '1234567'),
('', 'asdhiho2', '1234567'),
('', 'asdhiho3', '1234567'),
('', 'asdhiho4', '1234567'),
('', 'asdhiho5', '1234567'),
('', 'asdhiho6', '1234567'),
('', 'asdhiho7', '1234567'),
('', 'asdhiho8', '1234567'),
('', 'asdhiho9', '1234567'),
('', 'asdhiho10', '1234567'),
('', 'asdhiho11', '1234567'),
('', 'asdhiho12', '1234567'),
('', 'asdhiho13', '1234567'),
('', 'asdhiho14', '1234567'),
('', 'asdhiho15', '1234567'),
('', 'asdhiho16', '1234567'),

('', 'asdhiho17', '1234567'),
('', 'asdhiho18', '1234567'),
('', 'asdhiho19', '1234567'),
('', 'asdhiho20', '1234567');
