<?php
session_start();

 include '../includes/database.inc.php';
 $dbConn = getDatabaseConnection();
 
 function getClassInfo(){
 	global $dbConn;
	$sql = "SELECT * FROM endedClasses  
	        WHERE classId = :classId";
			
	$namedParameters = array();
	$namedParameters[':classId'] = $_GET['classId'];
	$statement = $dbConn->prepare($sql);	
	$statement->execute($namedParameters);
	$record = $statement->fetch();
	return $record;
 }
 
 function sendToEnded(){
    $theInfo = getClassInfo();
   
 	
	$sql = "INSERT INTO classes(classId, className, teacherId, notes)
    		VALUES(:classId, :className, :teacherId, :notes)";
			   


    $namedParameters = array();
    $namedParameters[':classId'] = $theInfo['classId'];
    $namedParameters[':className'] = $theInfo['className'];
	$namedParameters[':teacherId'] = $theInfo['teacherId'];
    $namedParameters[':notes'] = $theInfo['notes'];
      
    $dbConn = getDatabaseConnection();	
    $statement = $dbConn->prepare($sql);
    $statement->execute($namedParameters);
 }

 function deleteClass(){
	 
 
	$sql = "DELETE FROM endedClasses
    		WHERE classId = :classId";
			   
    

    $namedParameters[':classId'] = $_GET['classId'];

    $dbConn = getDatabaseConnection();	
    $statement = $dbConn->prepare($sql);
    $statement->execute($namedParameters);
	
 }
    sendToEnded();
	deleteClass();
   header("Location: teacherHome.php");
?>