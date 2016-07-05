
<?php
session_start();
include '../includes/database.inc.php';
 $dbConn = getDatabaseConnection();
 
 if(strcmp($_SESSION['userType'], "student") == 0){
		
	session_start();
    session_destroy();
    header('Location: ../index.php');
    exit;	

    }

function getAnswerInfo(){
   global $dbConn;
   
   $sql = "SELECT answer, answerId FROM answers
	WHERE questionId = :questionId";
	
	$namedParameters = array();
	$namedParameters[':questionId'] = $_GET['questionId'];
	$statement = $dbConn->prepare($sql);	
	$statement->execute($namedParameters);
	$record = $statement->fetchAll(PDO::FETCH_ASSOC);
    
    return $record;	
}	
	
 function getUserInfo(){
 	global $dbConn;
	
	$sql = "SELECT * FROM questions
	WHERE questionId = :questionId";
	
	$namedParameters = array();
	$namedParameters[':questionId'] = $_GET['questionId'];
	$statement = $dbConn->prepare($sql);	
	$statement->execute($namedParameters);
	$record = $statement->fetch();
	
	return $record;
 }

if (isset($_GET['updateForm'])) {  //admin submitted the Update Form


	$theUserInfo = getUserInfo();
	$theAnswerInfo = getAnswerInfo();

    if(empty($theAnswerInfo[0]['answer'])){
        insertAnswers();
    }
    else{
 
		$sql = "UPDATE questions
		   	   SET question = :question,
			   questionOrder = :questionOrder
			   WHERE questionId = :questionId";
			   
			   $sql1 = "UPDATE answers
		   	   SET questionId = :questionId,
			   answer = :answerOne,
		 	   correct = :correct1
			   WHERE answerId = :answerId1";
			   
			   $sql2 = "UPDATE answers
		   	   SET questionId = :questionId,
			   answer = :answerTwo,
		 	   correct = :correct2
			   WHERE answerId = :answerId2";
			 
			   $sql3 = "UPDATE answers
		   	   SET questionId = :questionId,
			   answer = :answerThree,
		 	   correct = :correct3
			   WHERE answerId = :answerId3";
			   
			   $sql4 = "UPDATE answers
		   	   SET questionId = :questionId,
			   answer = :answerFour,
		 	   correct = :correct4
			   WHERE answerId = :answerId4
			   ";	   
 
       if(strcmp($_GET['answer'], "A") == 0){
		   $answer1 = "Y";
		   $answer2 = "N";
		   $answer3 = "N";
		   $answer4 = "N";
	   }
	   else if(strcmp($_GET['answer'], "B") == 0){
		   $answer1 = "N";
		   $answer2 = "Y";
		   $answer3 = "N";
		   $answer4 = "N";
	   }
	   else if(strcmp($_GET['answer'], "C") == 0){
		   $answer1 = "N";
		   $answer2 = "N";
		   $answer3 = "Y";
		   $answer4 = "N";
	   }
	   else if(strcmp($_GET['answer'], "D") == 0){
		   $answer1 = "N";
		   $answer2 = "N";
		   $answer3 = "N";
		   $answer4 = "Y";
	   }else{
		throw new Exception('Error, select a correct answer');
	   }
	
       $namedParameters = array();
       $namedParameters[':questionId'] = $_GET['questionId'];
       $namedParameters[':question'] = $_GET['question'];
	   $namedParameters[':questionOrder'] = $_GET['questionOrder'];
	
	
	   $namedParameters1 = array();
	   $namedParameters1[':questionId'] = $_GET['questionId'];
	   $namedParameters1[':answerOne'] = $_GET['answerOne'];
	   $namedParameters1[':correct1'] = $answer1;
	   $namedParameters1[':answerId1'] = $_GET['answerId'];
	
	   $namedParameters2 = array();
	   $namedParameters2[':questionId'] = $_GET['questionId'];
	   $namedParameters2[':answerTwo'] = $_GET['answerTwo'];
	   $namedParameters2[':correct2'] = $answer2;
	   $namedParameters2[':answerId2'] = $_GET['answerId1'];
	
	   $namedParameters3 = array();
	   $namedParameters3[':questionId'] = $_GET['questionId'];
	   $namedParameters3[':answerThree'] = $_GET['answerThree'];
	   $namedParameters3[':correct3'] = $answer3;
	   $namedParameters3[':answerId3'] = $_GET['answerId2'];
	
	   $namedParameters4 = array();
	   $namedParameters4[':questionId'] = $_GET['questionId'];
	   $namedParameters4[':answerFour'] = $_GET['answerFour'];
	   $namedParameters4[':correct4'] = $answer4;
	   $namedParameters4[':answerId4'] = $_GET['answerId3'];

       $statement = $dbConn->prepare($sql);
       $statement->execute($namedParameters);

	   $statement1 = $dbConn->prepare($sql1);
       $statement1->execute($namedParameters1);
	
	   $statement2 = $dbConn->prepare($sql2);
       $statement2->execute($namedParameters2);

	   $statement3 = $dbConn->prepare($sql3);
       $statement3->execute($namedParameters3);
	
	   $statement4 = $dbConn->prepare($sql4);
       $statement4->execute($namedParameters4);

   	   die;
    }
}

function insertAnswers(){
	
	global $dbConn;
		global $flagRecords;
	$theUserInfo = getUserInfo();
	
		$sql = "UPDATE questions
		   	   SET 
			   question = :question,
			   questionOrder = :questionOrder
			   WHERE questionId = :questionId";

			
			    $sql1 = "INSERT INTO answers(questionId, answer, correct)
    		   VALUES(:questionId, :answerOne, :correct1);";
			
			    $sql2 = "INSERT INTO answers(questionId, answer, correct)
    		   VALUES(:questionId, :answerTwo, :correct2);";
			
			    $sql3 = "INSERT INTO answers(questionId, answer, correct)
    		   VALUES(:questionId, :answerThree, :correct3,);";
			
			    $sql4 = "INSERT INTO answers(questionId, answer, correct)
    		   VALUES(:questionId, :answerFour, :correct4);";
	
			   
 
    if(strcmp($_GET['answer'], "A") == 0){
		$answer1 = "Y";
		$answer2 = "N";
		$answer3 = "N";
		$answer4 = "N";
	}
	else if(strcmp($_GET['answer'], "B") == 0){
		$answer1 = "N";
		$answer2 = "Y";
		$answer3 = "N";
		$answer4 = "N";
	}
	else if(strcmp($_GET['answer'], "C") == 0){
		$answer1 = "N";
		$answer2 = "N";
		$answer3 = "Y";
		$answer4 = "N";
	}
	else if(strcmp($_GET['answer'], "D") == 0){
		$answer1 = "N";
		$answer2 = "N";
		$answer3 = "N";
		$answer4 = "Y";
	}else{
		throw new Exception('Error, select a correct answer');
	}
	
    $namedParameters = array();
    $namedParameters[':questionId'] = $_GET['questionId'];
    $namedParameters[':question'] = $_GET['question'];
	$namedParameters[':questionOrder'] = $_GET['questionOrder'];
	
	
	
	$namedParameters1 = array();
	$namedParameters1[':questionId'] = $_GET['questionId'];
	$namedParameters1[':answerOne'] = $_GET['answerOne'];
	$namedParameters1[':correct1'] = $answer1;
	
	
	$namedParameters2 = array();
	$namedParameters2[':questionId'] = $_GET['questionId'];
	$namedParameters2[':answerTwo'] = $_GET['answerTwo'];
	$namedParameters2[':correct2'] = $answer2;


	
	$namedParameters3 = array();
	$namedParameters3[':questionId'] = $_GET['questionId'];
	$namedParameters3[':answerThree'] = $_GET['answerThree'];
	$namedParameters3[':correct3'] = $answer3;
	
	
    
    $namedParameters4 = array();
	$namedParameters4[':questionId'] = $_GET['questionId'];
	$namedParameters4[':answerFour'] = $_GET['answerFour'];
	$namedParameters4[':correct4'] = $answer4;


    $statement = $dbConn->prepare($sql);
    $statement->execute($namedParameters);

	$statement1 = $dbConn->prepare($sql1);
    $statement1->execute($namedParameters1);
	
	$statement2 = $dbConn->prepare($sql2);
    $statement2->execute($namedParameters2);

	$statement3 = $dbConn->prepare($sql3);
    $statement3->execute($namedParameters3);
	
		$statement4 = $dbConn->prepare($sql4);
    $statement4->execute($namedParameters4);
    
    die;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">

  <!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame 
       Remove this if you use the .htaccess -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

  <title>Create Question</title>
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
</head>

<body>
  <div>
    <header>
      <h1>Update Question</h1>
    </header>

    <div>
   
    	<?$theUserInfo = getUserInfo()?>
		<?$theAnswerInfo = getAnswerInfo() ?>
          <div id="login-wrapper">
      
      <form>
      	
      </div>
	
		<p>Question Order:</p><input type="text" name="questionOrder" value="<?= $theUserInfo['questionOrder']?>" required/> <br />
		<p>Question:</p> <textarea rows="20" cols="40" name="question" id="question" required><?= $theUserInfo['question']?></textarea><br /><br />
		<p>Answer One:</p> <textarea rows="3" cols="20" name="answerOne" id="answerOne"  required><?= $theAnswerInfo[0]['answer']?></textarea><p>true?</p><input type="radio" name="answer" value="A" required /><br /><br />
	    <p>Answer Two:</p> <textarea rows="3" cols="20" name="answerTwo" id="answerTwo" required><?= $theAnswerInfo[1]['answer']?></textarea><p>true?</p><input type="radio" name="answer" value="B" /><br /><br />
		<p>Answer Three:</p> <textarea rows="3" cols="20" name="answerThree" id="answerThree" required><?= $theAnswerInfo[2]['answer']?></textarea><p>true?</p><input type="radio" name="answer" value="C" /><br /><br />
		<p>Answer Four:</p> <textarea rows="3" cols="20" name="answerFour" id="answerFour" required><?= $theAnswerInfo[3]['answer']?></textarea><p>true?</p><input type="radio" name="answer" value="D" /><br /><br />
		
      	</div>
      	<br />          
      	<br />          
      	
      	
      	<br />          
      	<input type="hidden" name="lectureId" value="<?= $theUserInfo['lectureId']?>" />
		<input type="hidden" name="questionId" value="<?= $theUserInfo['questionId']?>" />
		<input type="hidden" name="answerId" value="<?= $theAnswerInfo[0]['answerId']?>" />
		<input type="hidden" name="answerId1" value="<?= $theAnswerInfo[1]['answerId']?>" />
		<input type="hidden" name="answerId2" value="<?= $theAnswerInfo[2]['answerId']?>" />
		<input type="hidden" name="answerId3" value="<?= $theAnswerInfo[3]['answerId']?>" />
      	<input type="submit" class="btn btn-default btn-md btn-primary" value="Update Question" name="updateForm" />
      </form>
    </div>
  </div>
</body>
</html>