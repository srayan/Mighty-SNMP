<?php
//error_reporting(E_ALL);


try{
	//Creating the PhO-MySQL connection for user-root , with no password
	$handler = new PDO ('mysql:host=localhost;dbname=Ups', 'root', ''); 
	$handler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} 

//Preventing Error messages from exposing file directory:: Can lead to security issues
catch(PDOException $e) {
	echo $e->getMessage();
	die();
}

//Creating class for mapping elements in the Ups database
class BatteryEntry {
	public $upsDeviceDate, $deviceIdentity, $batteryStatus, $outageDuration,
	$estimatedMins, $entry;

//Construct function for fetching all data at once
	public function __construct() {
		$this->entry = "On date {$this->upsDeviceDate} UPS powering 
		{$this->deviceIdentity} computer was running {$this->batteryStatus}. 
		Power outage duration was for {$this->outageDuration} minutes. UPS had 
		{$this->estimatedMins} minutes of power remaining.";
	}
}

//Actual SQL query to retrieve Class information from Ups database
$query = $handler->query('SELECT * FROM BATTERY');
$query->setFetchMode(PDO::FETCH_CLASS, 'BatteryEntry');

//While loop to print all Ups database contents
while($r =$query->fetch()) {
	
	echo $r->entry, '<br><br>';
}
