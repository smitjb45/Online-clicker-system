<?php
session_start();
include '../includes/database.inc.php';
include '../functions_utills.php';
$dbConn = getDatabaseConnection(); //gets database connection

if (!isset($_SESSION['username'])) {  //checks whether user has logged in
	
	header('Location: ../index.php');
	
}

function getAddcodeClassId(){


    return $record;    
}

function getClassRecords(){
	
	global $dbConn;
	$theIds = array();
$sql = "SELECT * FROM enrolledStudents 
        LEFT JOIN classes ON enrolledStudents.classId = classes.classId
        LEFT JOIN user ON classes.teacherId = user.userId		
		WHERE enrolledStudents.studentId = {$_SESSION['userId']} AND userType LIKE 'teacher'";

	$records = getDataBySQL($sql);
	
//print_r($_SESSION);	
	//print_r($records);
   
  //  echo $records[1]['classId'];    
    
    foreach ($records as $record) {
         $theIds[] = $record['classId'];
    }
    return $theIds;
}

function displayClasses(){
    
    	global $dbConn;
	    
        $theIds = array();
        
        $sql = "SELECT * FROM enrolledStudents 
        LEFT JOIN classes ON enrolledStudents.classId = classes.classId
        LEFT JOIN user ON classes.teacherId = user.userId		
		WHERE enrolledStudents.studentId = {$_SESSION['userId']} AND userType LIKE 'teacher'";

	    $records = getDataBySQL($sql);
    
    	echo "<table class='table-bordered'>";
        foreach ($records as $record) {
		echo "<tr>";
	    echo "<td>";
		echo "<h5 class='word-padding'>Teacher:</h5>";
		echo "<td/>";
		echo "<td>";
		echo "<h5 class='word-padding'>{$record['fName']} {$record['lName']}</h5>";
		echo "<td/>";
		echo "<td>";
		echo "<h5 class='word-padding'>Class Name:</h5>";
		echo "<td/>";
		echo "<td>";
		echo "<h5 class='word-padding'>{$record['className']}</h5>"; 
		echo "</td>";
		echo "<td>";
		echo "<h5 class='word-padding'>School:</h5>";
        echo "</td>";
		echo "<td>";
		echo "<h5 class='word-padding'>{$record['schoolName']}</h5>";
		echo "<td/>";
		echo "<td>";
		echo "<a href='viewQuestions.php?classId= {$record['classId']}'>
                <span class='glyphicon glyphicon-question-sign icon-padding'></span>
             </a>";
		echo " ";
        echo "</td>";
        echo "<td>";
		echo "<a href='../delete.php?classId= {$record['classId']}'>
                   <span class='glyphicon glyphicon-trash icon-padding'></span>
              </a>";
		 "<br>";
		echo "</td>";
	    echo "</tr>";
	}
	echo "</table>";    
}


//print_r($records);
if (isset($_GET['addClass'])) {
	
    global $dbConn;
    
    $sql = "SELECT classId FROM addCodes	
		    WHERE addCode = :addCode";
    
				
	$namedParameters = array();
    $namedParameters[':addCode'] = $_GET['addCode'];				
  			
	$statement = $dbConn->prepare($sql); 
	$statement->execute($namedParameters);
	$record = $statement->fetch(PDO::FETCH_ASSOC);
    
    if(!$record == null){
      //  print_r($record["classId"]);
        $theRecords = getClassRecords();

        if(!in_array($record["classId"], $theRecords) && isset($record["classId"])){

       $sql1 = "INSERT INTO enrolledStudents(classId, studentId)
                VALUES(:classId, :studentId);";
               
       $namedParameters = array();
       $namedParameters[':classId'] = $record['classId'];
       $namedParameters[':studentId'] = $_SESSION['userId'];
    
       $statement = $dbConn->prepare($sql1);
       $statement->execute($namedParameters);
       }
          
    }
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">

  <!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame 
       Remove this if you use the .htaccess -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

  <title>Student Homepage</title>
  <meta name="description" content="">
  <meta name="author" content="smit9960">

  <meta name="viewport" content="width=device-width; initial-scale=1.0">

  <!-- Replace favicon.ico & apple-touch-icon.png in the root of your domain and delete these references -->
  <link rel="shortcut icon" href="/favicon.ico">
  <link rel="apple-touch-icon" href="/apple-touch-icon.png">
  <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
  
      <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
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

<link href='https://fonts.googleapis.com/css?family=Shadows+Into+Light|Bangers|Bitter:400,700' rel='stylesheet' type='text/css'>
<link rel="stylesheet" type="text/css" href="../css/styles.css">
</head>
<body>
  <div class="container">
    <header>
       <div class="row">
          <div class="col-sm-12 margin-top">
             <h1>Student Homepage</h1>
             <br />
          </div>
       </div>
    </header>
    <div class="row">
        <div class="col-sm-6">
           <strong><h3> Welcome <?=$_SESSION['fName']?>! <h3></strong>
        </div>
        <div class="col-sm-2">
        </div>
        <div class="col-sm-2">
           <form class="form-inline" method="get">
              <div >
				    <input type="text" class="form-control" placeholder="Add Code" name="addCode" required/>
                    <input type="submit" id="addCode-button" class="btn btn-default btn-sm btn-bloc" value="Add Class" name="addClass" />
		      </div>	
           </form>
        </div>
        <div class="col-sm-2 top-button-padding">
           <form action="../logout.php">
              <input type="submit" id="logout-button" class="btn btn-default btn-lg btn-bloc" value="Logout" name="logout" />	
           </form>
        </div>
    </div>
  
    <hr />	
    <br />
    
    <div class="row">
       <div class="col-sm-6 top-button-padding">
       <?php 
          displayClasses();
       ?>
       </div>
       <div class="col-sm-6 top-button-padding">

        </div> 
    </div>
    <div class="row">
       <?=theFooter(false)?>
    </div>
  </div>
</body>
</html>
