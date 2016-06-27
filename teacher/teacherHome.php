<?php
session_start();
include '../includes/database.inc.php';

$dbConn = getDatabaseConnection(); //gets database connection

if (!isset($_SESSION['username'])) {  //checks whether user has logged in
	
	header('Location: ../index.php');
	
}


function displayClasses(){
	
	global $dbConn;
	
// $sql = "SELECT * FROM user LEFT JOIN classes ON user.userId = classes.teacherId WHERE user.userType = "teacher"";
$sql = "SELECT * FROM classes 
        LEFT JOIN user ON classes.teacherId = user.userId		
		WHERE classes.teacherId = {$_SESSION['userId']}";

	$records = getDataBySQL($sql);
	
	
	//print_r($records);
	
	
	echo "<table class='table-bordered'>";
	foreach ($records as $record) {
		echo "<tr>";
		echo "<td>";
		echo "<h5>Class Name:&nbsp;</h5>";
		echo "<td/>";
		echo "<td>";
	    echo "<h5>{$record['className']}&nbsp;</h5>"; 
		echo "<td/>";
		echo "<td>";
		echo "<h5>School:&nbsp;</h5>";
		echo "<td>";
		echo "<h5>{$record['schoolName']}&nbsp;</h5>";
		echo "<td/>";
		echo "<td>";
		echo "<a href='questions.php?classId= {$record['classId']}'>&nbsp;<span class='glyphicon glyphicon-folder-open'>&nbsp;</span></a>";
		echo "<td/>";
		echo "<td>";
		echo "<a href='updateClassInfo.php?classId= {$record['classId']}'>&nbsp;<span class='glyphicon glyphicon-list-alt'>&nbsp;</span></a>";
		echo "<td/>";
		echo "<td>";
		echo "<a href='stats.php?classId= {$record['classId']}'>&nbsp;<span class='glyphicon glyphicon-stats'>&nbsp;</span></a>";
		echo "<td/>";
		echo "<td>";
		echo "<a href='deleteClass.php?classId= {$record['classId']}'>&nbsp;<span class='glyphicon glyphicon-trash'>&nbsp;</span></a>";
		echo "</td>";
	    echo "</tr>";
	}
	echo "</table>";
	
}

function displayClassesEnded(){
	
	global $dbConn;
	
// $sql = "SELECT * FROM user LEFT JOIN endedClasses ON user.userId = endedClasses.teacherId WHERE user.userType = "teacher"";
$sql = "SELECT * FROM endedClasses 
        LEFT JOIN user ON endedClasses.teacherId = user.userId		
		WHERE endedClasses.teacherId = {$_SESSION['userId']}";

	$records = getDataBySQL($sql);
	
	
	//print_r($records);
	
	
	echo "<table class='table-bordered'>";
	foreach ($records as $record) {
		echo "<tr>";
		echo "<td>";
		echo "<h5>Class Name:&nbsp;</h5>";
		echo "<td/>";
		echo "<td>";
		echo "<h5>{$record['className']}&nbsp;</h5> "; 
		echo "<td/>";
		echo "<td>";
		echo "<h5>School:&nbsp;</h5>";
		echo "<td>";
		echo "<h5>{$record['schoolName']}&nbsp;</h5>";
		echo "<td/>";
		echo "<td>";
		echo "<a href='questions.php?classId= {$record['classId']}'>&nbsp;<span class='glyphicon glyphicon-folder-open'>&nbsp;</span></a>";
		echo "<td/>";
		echo "<td>";
		echo "<a href='stats.php?classId= {$record['classId']}'>&nbsp;<span class='glyphicon glyphicon-stats'>&nbsp;</span></a>";
		echo "<td/>";
		echo "<td>";
		echo "<a href='restart.php?classId= {$record['classId']}'>&nbsp;<span class='glyphicon glyphicon-retweet'>&nbsp;</span></a>";
		echo "</td>";
	    echo "</tr>";
	}
	echo "</table>";
	
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">

  <!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame 
       Remove this if you use the .htaccess -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

  <title>Teacher Homepage</title>
  <meta name="description" content="">
  <meta name="author" content="smit9960">

  <meta name="viewport" content="width=device-width; initial-scale=1.0">

  <!-- Replace favicon.ico & apple-touch-icon.png in the root of your domain and delete these references -->
  <link rel="shortcut icon" href="/favicon.ico">
  <link rel="apple-touch-icon" href="/apple-touch-icon.png">
  <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
   <!-- Bootstrap -->
    <link href="../bootstrap-3.3.6-dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
	
	<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"
 integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" 
integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" 
integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

<link rel="stylesheet" type="text/css" href="../css/styles.css">

  
  <script>
     function updateUser(){
		 document.location.href = "../updateUser.php";
	 }
  </script>
</head>

<body>
  <div class="container">
    <header>
	<div class="row white-background">
      <h1>Teacher Homepage</h1>
      <br />
    </div>
    </header>

   
    <div class="row">
	<div class="col-sm-6">
       <strong><h3> Welcome <?=$_SESSION['fName']?>! <h3></strong>
	 </div>
	   	 
             <div class="col-sm-2 top-button-padding">	   
                <input type="button" value="Update Info" class="btn btn-default btn-md btn-primary" onclick="updateUser()" >
             </div>
	         <div class="col-sm-2 top-button-padding">
                <form action="studentReports.php?studentId=" . $employeeRec['studentId'] . "">
                   <input type="submit" id="logout-button" class="btn btn-default btn-md btn-primary" value="reports" />	
                </form>
            </div>
            <div class="col-sm-2 top-button-padding">
               <form action="../logout.php">
                  <input type="submit" id="logout-button" class="btn btn-default btn-md btn-primary" value="Logout" name="logout" />	
               </form>
	       </div>
	</div>
	<hr />
	<div class="row">
	   <div class="col-md-6">
	      <?= displayClasses()?>
	   </div>
	   <div class="col-md-6">
	      <?=displayClassesEnded()?>
	   </div>
    </div>
       <footer id="footer">
	      <hr />
	      <p> the information included on this page may not be correct &copy; SpoutTech 2015</p>
		  <img src="../img/logoSproutBottom.png" alt="Sprout logo" />
	   </footer>
  </div>
</body>
</html>