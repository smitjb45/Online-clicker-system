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
   //print_r($records);
		
	echo "<table class='table-bordered'>";
	foreach ($records as $record) {
		echo "<tr>";
		echo "<td>";
		echo "<h5 class='word-padding'>Question Number:</h5>";
		echo "</td>";
		echo "<td>";
		echo "<h5 class='word-padding'>{$record['questionOrder']}</h5>"; 
		echo "</td>";
		echo "<td>";
		echo "<h5 class='word-padding'>Question:</h5>";
		echo "<td>";
        echo "<a class='word-padding glyphicon glyphicon-menu-down' 
                 data-toggle='popover' title='Question' data-content='{$record['question']}' 
                 data-trigger='focus' tabindex='0' data-placement='bottom'></a>";
		echo "</td>";
		echo "<td>";
		echo "<a href='updateQuestion.php?questionId= {$record['questionId']}'>
                <span class='glyphicon glyphicon-list-alt icon-padding'></span>
             </a>";
		echo "</td>";
		echo "<td>";
		echo "<a target='_parent' href='./charts/classChart.php?questionId= {$record['questionId']}'>
                 <span class='glyphicon glyphicon-stats icon-padding'></span>
              </a>";
		echo "</td>";
		echo "<td>";
		echo "<a target='_parent' href='timer.php?questionId= {$record['questionId']}'>
                 <span class='glyphicon glyphicon-eye-open icon-padding'></span>
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
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="//code.jquery.com/ui/1.11.2/jquery-ui.min.js"></script>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
    <script>$(function () {
                 $('[data-toggle="popover"]').popover({ html : true, container: 'body'})
              })
    </script>
    <link rel="stylesheet" type="text/css" href="../css/styles.css">
</head>
<body>
</body>
</html>