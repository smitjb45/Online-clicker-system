<?php

function getDatabaseConnection() {
	$host = "localhost";
	$dbname = "smit9960";	//your otterid
	$username = "root"; 	//your otterid
	$password = "password";

    try {
	   //creates connection to database
	   $dbConn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

	   // Setting Errorhandling to Exception
	   $dbConn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	   return $dbConn;
    
    }catch(Exception $e){
       die("Unable to connect: " . $e->getMessage());
    }
}

function getDataBySQL($sql){
	global $dbConn;
	$statement = $dbConn->prepare($sql); //prevents SQL Injection
	$statement->execute();
	$records = $statement->fetchAll(PDO::FETCH_ASSOC); 
	return $records;
}
?>