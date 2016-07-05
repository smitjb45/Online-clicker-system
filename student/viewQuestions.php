<?php
session_start();
include '../includes/database.inc.php';

$dbConn = getDatabaseConnection(); //gets database connection

if (!isset($_SESSION['username'])) {  //checks whether user has logged in
	session_start();
    session_destroy();
    header('Location: ../index.php');
    exit;
}


if (isset($_GET['submitForm'])) {  //admin submitted the Update Form

		$sql = "INSERT INTO studentAnswers(questionId, lectureId, classId, correct, studentAnswer, studentId, showQuestionId)
    		   VALUES(:questionId, :lectureId, :classId, :correct, :studentAnswer, :studentId, :showQuestionId)";
			   
       $namedParameters = array();
       $namedParameters[':questionId'] = $_GET['questionId'];
       $namedParameters[':lectureId'] = $_GET['lectureId'];
	   $namedParameters[':classId'] = $_GET['classId'];
       $namedParameters[':correct'] = $_GET['answer'][1];
	   $namedParameters[':studentAnswer'] = $_GET['answer'][0];
	   $namedParameters[':studentId'] = $_SESSION['userId'];
       $namedParameters[':showQuestionId'] = $_GET['showQuestionId'];

       $statement = $dbConn->prepare($sql);
       $statement->execute($namedParameters);
       
      // $_SESSION['questionId'] = $_GET['questionId'];
   	   
       header('Location: ./studentHome.php');
}

function displayQA(){
	
	global $dbConn;
	
$sql = "SELECT * FROM showQuestion 
        NATURAL JOIN questions
        NATURAL JOIN answers
		WHERE classId = {$_GET['classId']}";

	$records = getDataBySQL($sql);
	print_r($records);
	return $records;
}

$theRecords = displayQA();

function checkIfAnswered($question_id){

	global $dbConn;
	
$sql = "SELECT studentId FROM studentAnswers where questionId = {$question_id} AND studentId = {$_SESSION['userId']}";

	$records = getDataBySQL($sql);

    return($records);
}

//    if(isset($theRecords[0]['questionId'])){
//       if(!empty(checkIfAnswered($theRecords[0]['questionId']))){
//          header('Location: ./studentHome.php');
//       }    
//    }
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
  		
        $(function(){
            
         $.ajax({
            type: "get",
            url: "studentGetQuestion.php",
            dataType: "json",
            data: {"classId" : $("#classId").val()},
            success: function(data,status) {
                 

           // alert(jQuery.isEmptyObject(data));
            	if (jQuery.isEmptyObject(data)) {
            	   $('#question').html("NOT available");	
            	   $('#question').css("color","black");
            	   $('#question').css("backgroundColor","red");
                   $('#submitButton').css("display","none");	
            	} else {
            		
            	   $('#question').html(data[0].question);
                   $('#answerOne').html(data[0].answer);
                   $('#answerTwo').html(data[1].answer);
                   $('#answerThree').html(data[2].answer);
                   $('#answerFour').html(data[3].answer);
                   
            	}
              },
            complete: function(data,status) { //optional, used for debugging purposes
                 //alert(status);
              }
         });  		
  		});
  </script>
</head>

<body>
    <header class="white-background">
      <h1>student homepage</h1>
     <form action="../logout.php">
        <input type="submit" id="logout-button" class="btn btn-default btn-md btn-primary" value="Logout" name="logout" />	
     </form>
    </header>
    <div class="container">
     <strong><h2> Welcome <?=$_SESSION['fName']?>! </h2></strong>
	<?php 
       
    ?>
	<hr />
    <div class="row">
       <div class="col-sm-offset-4 col-sm-6">
          <p id="question"></p>
       </div>
       <div class="col-sm-2">
       </div>
    </div>
	<form>
        <div class="row">
            <div class="col-sm-offset-2 col-sm-8">
                <label for="input1">
                    <input type="radio" id="input1" name="answer" value="A<?=$theRecords[0]['correct']?>" /><span id="answerOne" class="word-padding"></span>
                </label>
            </div>
            <div class="col-sm-2">
            </div>
        </div>
        <div class="row">
            <div class="col-sm-offset-2 col-sm-8">
                <label for="input2">
                    <input type="radio" id="input2" name="answer" value="B<?=$theRecords[1]['correct']?>" /><span id="answerTwo" class="word-padding"></span>
                </label>
            </div>
            <div class="col-sm-2">
            </div>
        </div>
        <div class="row">
            <div class="col-sm-offset-2 col-sm-8">
                <label for="input3">
                    <input type="radio" id="input3" name="answer" value="C<?=$theRecords[2]['correct']?>" /><span id="answerThree" class="word-padding"></span>
                </label>
            </div>
            <div class="col-sm-2">
            </div>
        </div>
        <div class="row">
            <div class="col-sm-offset-2 col-sm-8">
                <label for="input4">
                    <input type="radio" id="input4" name="answer" value="D<?=$theRecords[3]['correct']?>" /><span id="answerFour" class="word-padding"></span>
                <label>
            </div>
            <div class="col-sm-2">
            </div>
        </div> 
	   <input type="hidden" name="questionId" value="<?=$theRecords[0]['questionId']?>" />
	   <input type="hidden" name="lectureId" value="<?=$theRecords[0]['lectureId']?>" />
	   <input type="hidden" id="classId" name="classId" value="<?=$theRecords[0]['classId']?>" />
	   
       <div class="row">
           <div class="col-sm-offset-2 col-sm-8">
                <br />
                <input type="submit" id="submitButton" name="submitForm" class="btn btn-default btn-md btn-primary" value="Submit Answers" />
               </div>
           <div class="col-sm-2">
           </div>
       </div>
    </form>

  </div>
      <footer id="footer">
			<hr />
			<p> the information included on this page may not be correct, it was created in CST336 &copy; Joshua Smith 2015</p>
			<img class="image-with border" src="../../img/csumb-logo.png" alt="csumb logo" />
		</footer>
</body>
</html>
