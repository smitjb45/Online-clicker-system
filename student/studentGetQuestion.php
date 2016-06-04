<?php
include '../includes/database.inc.php';
	
$namedParameters = array();
$namedParameters[":classId"] = $_GET['classId'];
	

$sql = "SELECT * FROM showQuestion 
        NATURAL JOIN questions
        NATURAL JOIN answers
		WHERE classId = :classId";

	$dbConn = getDatabaseConnection();	
    $statement = $dbConn->prepare($sql);
    $statement->execute($namedParameters);
	$records = $statement->fetchAll(PDO::FETCH_ASSOC);
	
    //print_r($records);
	
    echo json_encode($records);
?>

