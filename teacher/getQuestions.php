<?php

	include '../includes/database.inc.php';
	
    $dbConn = getDatabaseConnection(); //gets database connection
	
    if(!empty($_GET['lectureId'])){
    
       $_SESSION['lectureId'] = $_GET['lectureId'];
    }
	
    if(isset($_GET['lectureId'])){
		
        $sql = "SELECT * FROM questions
			    WHERE lectureId = {$_GET['lectureId']}
                ORDER BY questionOrder";
				
                
					$records = getDataBySql($sql);
			print_r($records);
		
	echo "<table class='table-bordered'>";
	foreach ($records as $record) {
		echo "<tr>";
		echo "<td>";
		echo "<h5 class='word-padding'>Question Number:</h5>&nbsp;";
		echo "</td>";
		echo "<td>";
		echo "<h5 class='word-padding'>{$record['questionOrder']}</h5>&nbsp;"; 
		echo "</td>";
		echo "<td>";
		echo "<h5 class='word-padding'>Question:</h5>&nbsp";
		echo "<td>";
        echo "<p class='word-padding'>{$record['question']}</p>&nbsp;";
		echo "</td>";
		echo "<td>";
		echo "<a href='updateQuestion.php?questionId= {$record['questionId']}'>
                <span class='glyphicon glyphicon-list-alt icon-padding'></span>
             </a>";
		echo "</td>";
		echo "<td>";
		echo "<a href='stats.php?classId= {$record['questionId']}'>
                 <span class='glyphicon glyphicon-stats icon-padding'></span>
              </a>";
		echo "</td>";
		echo "<td>";
		echo "<a href='restart.php?classId= {$record['questionId']}'>
                 <span class='glyphicon glyphicon-eye-open icon-padding'></span>
              </a>";
		echo "</td>";
		echo "<td>";
		echo "<a href='restart.php?classId= {$record['questionId']}'>
                 <span class='glyphicon glyphicon-eye-close icon-padding'></span>
              </a>";
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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

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
  </head>
  <body>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>