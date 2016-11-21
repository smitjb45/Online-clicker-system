<?php
session_start();

 include '../includes/database.inc.php';
 $dbConn = getDatabaseConnection();
 
 echo $_GET['classId'];
	$sql = "DELETE FROM addCodes
    		WHERE classId = :classId";
			   
    $namedParameters[':classId'] = $_SESSION['classId'];

    $dbConn = getDatabaseConnection();	
    $statement = $dbConn->prepare($sql);
    $statement->execute($namedParameters);
				
	header("Location: questions.php");
?>