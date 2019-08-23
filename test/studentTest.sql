DROP DATABASE IF EXISTS studentM;
CREATE DATABASE studentM;
USE studentM;

DROP TABLE IF EXISTS `studentcopy`;

CREATE TABLE  `studentcopy`(
`name`  varchar(10)    NOT NULL,
`age`   INT(10)            NOT NULL,
`address`  CHAR(25)    NOT NULL,
`id`    INT(10)            NOT NULL,
);