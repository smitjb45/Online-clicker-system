<?php

include 'includes/database.inc.php';

$sql = "SELECT username FROM user WHERE username = :username";

$namedParameters = array();
$namedParameters[":username"] = $_GET['username'];

$dbConn = getDatabaseConnection();	
    $statement = $dbConn->prepare($sql);
    $statement->execute($namedParameters);

//print_r($result);

$usernameAvailable = array();

if (empty($result)) {
	//echo "Username is available!";
	$usernameAvailable['available'] = "true";
	
} else {
	//echo "Username is NOT available!";
	$usernameAvailable['available'] = "false";
} 

echo json_encode($usernameAvailable);

?>