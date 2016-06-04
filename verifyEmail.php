<?php

include 'includes/database.inc.php';

$sql = "SELECT username FROM user WHERE email = :email";

$namedParameters = array();
$namedParameters[":email"] = $_GET['email'];

$dbConn = getDatabaseConnection();	
    $statement = $dbConn->prepare($sql);
    $statement->execute($namedParameters);

//print_r($result);

$usernameAvailable = array();

if (empty($result)) {
	//echo "email is available!";
	$usernameAvailable['available'] = "true";
	
} else {
	//echo "email is NOT available!";
	$usernameAvailable['available'] = "false";
} 

echo json_encode($usernameAvailable);

?>