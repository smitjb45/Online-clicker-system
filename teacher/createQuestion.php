    
<?php
session_start();
include '../includes/database.inc.php';
include '../functions_utills.php';
 $dbConn = getDatabaseConnection();
 
 if(strcmp($_SESSION['userType'], "student") == 0){
		
		session_start();
        session_destroy();
        header('Location: ../index.php');
        exit;	
	}
    
 if(!empty($_GET['lectureId'])){
    $_SESSION['lectureId'] = $_GET['lectureId'];
    }
	
 function getUserInfo(){
 	global $dbConn;
	
	$sql = "SELECT * FROM lecture
	WHERE lectureId = :lectureId";
	
	$namedParameters = array();
	$namedParameters[':lectureId'] = $_GET['lectureId'];
	$statement = $dbConn->prepare($sql);	
	$statement->execute($namedParameters);
	$record = $statement->fetch();
   
	return $record;
 }

if (isset($_GET['Form'])) {  //admin submitted the Update Form
	
	$sql = "INSERT INTO questions(lectureId, question, questionOrder)
    		VALUES(:lectureId, :question,:questionOrder);
			";
			   


    
    $namedParameters = array();
    $namedParameters[':lectureId'] = $_GET['lectureId'];
    $namedParameters[':question'] = $_GET['question'];
	$namedParameters[':questionOrder'] = $_GET['questionOrder'];
      
    $dbConn = getDatabaseConnection();	
    $statement = $dbConn->prepare($sql);
    $statement->execute($namedParameters);
    	
	header('Location: questions.php');
	
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
<link href='https://fonts.googleapis.com/css?family=Shadows+Into+Light|Bangers|Bitter:400,700' rel='stylesheet' type='text/css'>

<link rel="stylesheet" type="text/css" href="../css/styles.css">

</head>

<body>
  <div>
    <header>
      <h1>Create Question</h1>
    </header>
    <div class="container form-group">
    <hr />
    	<?$theUserInfo = getUserInfo()?>
          <div id="login-wrapper">
      
      <form>
      </div>	
		<div class="row">
           <div class="col-md-4">
		      <p>Question Order:</p><input type="text" class="form-control" name="questionOrder" required/> <br />
		   </div>
           <div class="col-md-8">
		   </div>
        </div>
        <div class="row">
           <div class="col-md-6">
              <p>Question:</p> <textarea rows="20" cols="40" class="form-control" name="question"  required></textarea><br /><br />
      	   </div>
           <div class="col-md-6">   
           
           </div>
        </div>
      	<br />          
      	<br />          
      	<input type="hidden" name="classId" value="<?=$_GET['classId']?>" />
		<input type="hidden" name="lectureId" value="<?=$_GET['lectureId']?>" />
      	<input type="submit" class="btn btn-default btn-md btn-primary" value="Create Question" name="Form" />
      </form>
          <?=theFooter(false)?>
      </div>      
    </div>
  </div>
</body>
</html>
