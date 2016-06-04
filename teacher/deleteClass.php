<?php
session_start();

 include '../includes/database.inc.php';
 $dbConn = getDatabaseConnection();
 
 function getClassInfo(){
 	global $dbConn;
	$sql = "SELECT * FROM classes  
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
   
	$sql = "INSERT INTO endedClasses(classId, className, teacherId, notes, startDate)
    		VALUES(:classId, :className, :teacherId, :notes, :startDate)";

    $namedParameters = array();
    $namedParameters[':classId'] = $theInfo['classId'];
    $namedParameters[':className'] = $theInfo['className'];
	$namedParameters[':teacherId'] = $theInfo['teacherId'];
    $namedParameters[':notes'] = $theInfo['notes'];
	$namedParameters[':startDate'] = $theInfo['startDate'];
      
    $dbConn = getDatabaseConnection();	
    $statement = $dbConn->prepare($sql);
    $statement->execute($namedParameters);
 }

 function deleteClass(){
	 
 
	$sql = "DELETE FROM classes
    		WHERE classId = :classId;
			DELETE FROM enrolledStudents
    		WHERE classId = :classId;";
			   
    

    $namedParameters[':classId'] = $_GET['classId'];

    $dbConn = getDatabaseConnection();	
    $statement = $dbConn->prepare($sql);
    $statement->execute($namedParameters);
	
 }
    sendToEnded();
	deleteClass();
    header("Location: teacherHome.php");
?>