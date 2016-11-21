<?php
    session_start();
   include '../../includes/database.inc.php'; 
   $dbConn = getDatabaseConnection();
   

   function getChartData(){
        
   global $dbConn; 
	
    $sql = "SELECT studentAnswer, COUNT(studentAnswer)
            FROM studentAnswers 
            WHERE questionId = " . $_GET["questionId"] . "
            GROUP BY studentAnswer";
        
	$records = getDataBySQL($sql);
	
//    print_r($records);
	
    return $records;
}
//print_r($_GET["questionId"]);

function getChartDataCorrect(){
        
    global $dbConn; 

    $sql = "SELECT correct, COUNT(correct) FROM studentAnswers 
            WHERE questionId = " . $_SESSION["questionId"] . "
            GROUP BY studentAnswer";
        
	$records = getDataBySQL($sql);
	
    //print_r($records);
	
    return $records;
}

function getChartCorrectAnswer(){
        
   global $dbConn; 
	
    $sql = "SELECT * FROM answers   
            WHERE questionId = " . $_GET["questionId"] . " 
            AND correct = 'Y'";
        
	$records = getDataBySQL($sql);
	
 //   print_r($records);
	
    return $records;
}

//getChartDataSex();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>dodoboost</title>
    
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
<link href="../../bootstrap-3.3.6-dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="../../css/styles.css">

<script src="../../Chart.js-master/Chart.js"></script>
<?php $records = getChartData();?>
	

    
    <script>
    
    
    
   //   alert("hi");
                  
        var dataArray = <?php echo json_encode($records); ?>;
                    
        
	var randomScalingFactor = function(){ return Math.round(Math.random()*1000)};
	var barChartData = {
		labels : [],
		datasets : [

			{
				fillColor : "rgba(151,187,205,0.5)",
				strokeColor : "rgba(151,187,205,0.8)",
				highlightFill : "rgba(151,187,205,0.75)",
				highlightStroke : "rgba(151,187,205,1)",
				data : []
			}
		]
	}
    
    
	window.onload = function(){
		var ctx = document.getElementById("myChart").getContext("2d");
		window.myBar = new Chart(ctx).Bar(barChartData, {
			responsive : true,
		});
      
    window.myBar.addData([dataArray[0]['COUNT(studentAnswer)']], [dataArray[0].studentAnswer]);
    window.myBar.addData([dataArray[1]['COUNT(studentAnswer)']], [dataArray[1].studentAnswer]);
    window.myBar.addData([dataArray[2]['COUNT(studentAnswer)']], [dataArray[2].studentAnswer]);
    window.myBar.addData([dataArray[3]['COUNT(studentAnswer)']], [dataArray[3].studentAnswer]);
	}
	</script>
  </head>
  <body>
  
    <div class="container">
       <div class="row">
          <div class="col-sm-4 margin-top">
          </div>
          <div class="col-sm-4 margin-top">
             <span class="chart-answer">Correct Answer: <?=getChartCorrectAnswer()[0]["answer"];?> </span>
             <span class="chart-answer">Correct Option: <?=getChartCorrectAnswer()[0]["letter"];?> </span>
	      </div>
       </div>
     <div>
       <canvas id="myChart" class="white-background" width="200" height="100"></canvas>
    </div>	
    </div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>