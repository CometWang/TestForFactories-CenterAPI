DROP DATABASE IF EXISTS rrsecmain;
CREATE DATABASE rrsecmain;
USE rrsecmain;

DROP TABLE IF EXISTS `rrsectb`;

CREATE TABLE `rrsectb` (
  `uid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `miiodid` varchar(32) DEFAULT NULL,
  `miiokey` varchar(32) DEFAULT NULL,
  `miiomac` varchar(32) DEFAULT NULL,
  `miiosn` varchar(128) DEFAULT NULL,
  `cpusn` varchar(64) DEFAULT NULL,
  `mcuid` varchar(64) DEFAULT NULL,
  `emcuid` varchar(256) DEFAULT NULL,
  `ecpuid` varchar(256) DEFAULT NULL,
  `dkey` varchar(64) DEFAULT NULL,
  `checksum` varchar(64) DEFAULT NULL,
  `clientinfo` varchar(128) DEFAULT NULL,
  `date` varchar(32) DEFAULT NULL,
  `appassword` varchar(64) DEFAULT NULL,
  `prodtype` INT(4) UNSIGNED NOT NULL DEFAULT 0,
  `devtype`  INT(4) UNSIGNED NOT NULL DEFAULT 0,
  `IN_USE` tinyint(1) NOT NULL DEFAULT '0',
  `COMPLETE` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `rrsecdevinfo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rrsecdevinfo` (
  `uid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `miiosn` varchar(128) DEFAULT NULL,
  `lastaccessdate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `isbackup` tinyint(1) NOT NULL DEFAULT '0',
  `macaddr` varchar(128) DEFAULT NULL,
  `bootloaderver` varchar(128) DEFAULT NULL,
  `kernelver` varchar(128) DEFAULT NULL,
  `kernelbuildtime` varchar(128) DEFAULT NULL,
  `emmc`  varchar(128) DEFAULT NULL,
  `ddr`   varchar(128) DEFAULT NULL,
  `compassid` varchar(128) DEFAULT NULL,
  `apver` varchar(128) DEFAULT NULL,
  `ldsver` varchar(128) DEFAULT NULL,
  `ldsid` varchar(128) DEFAULT NULL,
  `mcuver` varchar(128) DEFAULT NULL,
  `testinfo` varchar(128) DEFAULT NULL,
  `pn` varchar(128) DEFAULT NULL,
  `rtc` varchar(128) DEFAULT NULL,
  `mcuid` varchar(128) DEFAULT NULL,
  `batid` varchar(128) DEFAULT NULL,
  `gyroid`  varchar(128) DEFAULT NULL,
  `chargerid` varchar(128) DEFAULT NULL,
  `acccal`  varchar(128) DEFAULT NULL,
  `gyrocal` varchar(128) DEFAULT NULL,
  `wallsensorcal` varchar(128) DEFAULT NULL,
  `cliffcal1` varchar(128) DEFAULT NULL,
  `cliffcal2` varchar(128) DEFAULT NULL,
  `cliffcal3` varchar(128) DEFAULT NULL,
  `cliffcal4` varchar(128) DEFAULT NULL,
  `cliffcal5` varchar(128) DEFAULT NULL,
  `cliffcal6` varchar(128) DEFAULT NULL,
  `WallsensorID` varchar(16) DEFAULT NULL,
  `Compass2ID` varchar(16) DEFAULT NULL,
  `Camera0ID` varchar(128) DEFAULT NULL,
  `Camera1ID` varchar(128) DEFAULT NULL,
  `infofilelength` int(12) NULL,
  `infofileblob` LONGBLOB DEFAULT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=latin1;

