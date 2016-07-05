<?php
session_start();

include_once 'includes/database.inc.php';

$conn = getDatabaseConnection(); //gets database connection

if(isset($_POST['loginForm']))
{
	global $conn;
	$username = $_POST['username'];
	$password = sha1($_POST['password']);
			
	$sql = "SELECT * 
			FROM user
			WHERE username = :username
			AND password = :password"; // prevents sql injection
				
	$namedParameters = array();
    $namedParameters[':username'] = $username;				
    $namedParameters[':password'] = $password;
				
	$statement = $conn->prepare($sql); 
	$statement->execute($namedParameters);
	$records = $statement->fetch(PDO::FETCH_ASSOC);

	print_r($records);
	if(empty($records)){
		echo "wrong username or password";
	}
	else
	{
		$_SESSION['userId'] = $records['userId'];
		$_SESSION['username'] = $records['username'];
		$_SESSION['fName'] = $records['fName'];
		$_SESSION['userType'] = $records['userType'];
		
		if(strcmp($_SESSION['userType'], "student") == 0)
		{
		    header("Location: student/studentHome.php");	
		}
		else if(strcmp($_SESSION['userType'], "teacher") == 0)
		{
			header("Location: teacher/teacherHome.php");
		}
		else
		{
			session_start();
            session_destroy();
            header('Location: index.php');
            exit;
		}
		
	}		
}

?>