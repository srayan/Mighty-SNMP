CREATE DATABASE Ups ;

#Creating UPS Schema

USE Ups;

CREATE TABLE BATTERY (
	upsDeviceDate		date,
	deviceIdentity		char(30),
	batteryStatus		char(8),
	outageDuration		int,
	estimatedMins		int,
	CONSTRAINT pk_Battery primary key (upsDeviceDate)
	);
	
#Insert Statements

USE ups;

INSERT INTO BATTERY VALUES ('2014-07-02', 'Home Desktop', 'Normal', 'NULL', '3600');
INSERT INTO BATTERY VALUES ('2014-07-03', 'Home Desktop', 'Normal', '2275', '1325');
INSERT INTO BATTERY VALUES ('2014-07-04', 'Office Desktop', 'Low', '102', '3498');
INSERT INTO BATTERY VALUES ('2014-07-05', 'Office Desktop', 'Low', '3600', '0');
