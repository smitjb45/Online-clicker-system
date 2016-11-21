<?php
session_start();

 include 'includes/database.inc.php';
 $dbConn = getDatabaseConnection();
 
	$sql = "DELETE FROM enrolledStudents
    		WHERE studentId = :studentId AND classId = :classId";
			   
    $namedParameters[':studentId'] = $_SESSION['userId'];
    $namedParameters[':classId'] = $_GET['classId'];

    $dbConn = getDatabaseConnection();	
    $statement = $dbConn->prepare($sql);
    $statement->execute($namedParameters);
				
	header("Location: student/studentHome.php");
?>
