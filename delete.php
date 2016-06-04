<?php
session_start();

 include '../includes/database.inc.php';
 $dbConn = getDatabaseConnection();
 
 function getProductById(){
 	global $dbConn;
	$sql = "SELECT * FROM final_employee 
	        NATURAL JOIN final_services 
	        WHERE employeeId = :employeeId";
	$namedParameters = array();
	$namedParameters[':employeeId'] = $_GET['employeeId'];
	$statement = $dbConn->prepare($sql);	
	$statement->execute($namedParameters);
	$record = $statement->fetch();
	return $record;
 }
	$sql = "DELETE FROM final_employee
    		WHERE employeeId = :employeeId";
			   
    

    $namedParameters[':employeeId'] = $_GET['employeeId'];

    $dbConn = getDatabaseConnection();	
    $statement = $dbConn->prepare($sql);
    $statement->execute($namedParameters);
	
	$sql = "DELETE FROM final_services
    		   WHERE employeeId = :employeeId";
			   
    $namedParameters[':employeeId'] = $_GET['employeeId'];

    $dbConn = getDatabaseConnection();	
    $statement = $dbConn->prepare($sql);
    $statement->execute($namedParameters);			
	header("Location: products.php");
	
    $_SESSION['delete'] = "abc";

?>
