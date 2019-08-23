DROP DATABASE IF EXISTS test2;
CREATE DATABASE test2;
USE test2;

DROP TABLE IF EXISTS `student2`;

CREATE TABLE `student2`(
	`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
	`firstName`   varchar(30)  DEFAULT NULL,
	`lastName`    varchar(30)  DEFAULT NULL,
	`age`        int(10)       DEFAULT NULL,
	`major`      varchar(20)   DEFAULT NULL,
	PRIMARY KEY (`id`)

); 
INSERT INTO student2 (id, firstName, lastName, age, major)VALUES
('NULL','rainbow', 'pppf', '0', 'A&H'),
('null', 'puff' ,'snow', '20','A&H'),
('null', 'Jia', 'Wang', '20', 'computer science'),
('null', 'asdqw', 'Rudhw', '0', '0'),
('null', 'HUiu', 'diww', '0', '0'),
('null', 'qiwue', 'qowiu', '0', '0'),
('null', 'disqw', 'dnoqjwoijf', '0', '0'),
('null', '123','sdj', '10', '23333'),
('null', 'juriwp', 'oiei', '0', '0'),
('NULL','rainbow', 'pppf', '10', 'A&H'),
('null', 'puff' ,'snow', '20','A&H'),
('null', 'Jia', 'Wang', '20', 'computer science'),
('null', 'asdqw', 'Rudhw', '0', '0'),
('null', 'HUiu', 'diww', '0', '0'),
('null', 'qiwue', 'qowiu', '17', '0'),
('null', 'disqw', 'dnoqjwoijf', '8', '0'),
('null', '123','sdj', '10', '23333');