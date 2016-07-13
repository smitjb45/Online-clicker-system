<?php
session_start();
include 'includes/database.inc.php';
include 'functions_utills.php'; 
$dbConn = getDatabaseConnection();
 
		
 function getUserInfo(){
 	global $dbConn;
	
	$sql = "SELECT * FROM user
	WHERE userId = :userId";
	
	$namedParameters = array();
	$namedParameters[':userId'] = $_SESSION['userId'];
	$statement = $dbConn->prepare($sql);	
	$statement->execute($namedParameters);
	$record = $statement->fetch();

	return $record;
 }

if (isset($_GET['updateForm'])) {  //admin submitted the Update Form
	
	if(!strcmp($_GET['password'], $_GET['password2']) == 0){
	   
	  echo "password didn't work";
	}
	else{
	
    try{
        
	   $sql = "UPDATE user
	       
			SET fName = :fName,
			lName = :lName,
			username = :username,
			email = :email,
			password = :password,
			schoolName = :schoolName
			WHERE userId = :userId";
			
	   $_SESSION['username'] = $_GET['username'];
	   $_SESSION['fName'] = $_GET['fName'];
		
	   $namedParameters = array();
	   $namedParameters[':userId'] = $_SESSION['userId'];
	   $namedParameters[':fName']  = strtoupper($_GET['fName']);
       $namedParameters[':lName'] = strtoupper($_GET['lName']);
	   $namedParameters[':username'] = $_GET['username'];
       $namedParameters[':email'] = strtoupper($_GET['email']);
       $namedParameters[':password'] = sha1($_GET['password']);
	   $namedParameters[':schoolName'] = strtoupper($_GET['schoolName']);
      
       $dbConn = getDatabaseConnection();
       $dbConn->beginTransaction();	
       $statement = $dbConn->prepare($sql);
       $statement->execute($namedParameters);	
       $dbConn->commit();  	
       
    }catch(\PDOException $e){
       $dbConn->rollBack();
       echo $e->errorInfo[1];
    }

	if(strcmp($_GET['userType'], "student") == 0){
         header('Location: student/studentHome.php');
	}
	else if(strcmp($_GET['userType'], "teacher") == 0){
		header('Location: teacher/teacherHome.php');
	}
	else{
	   session_start();
       session_destroy();
       header('Location: index.php');
       exit;	
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

  <title>Update Employee</title>
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

<link rel="stylesheet" type="text/css" href="css/styles.css">
<link href='https://fonts.googleapis.com/css?family=Shadows+Into+Light|Bangers|Bitter:400,700' rel='stylesheet' type='text/css'>

  
  
    <script>
  	
  	function checkPassword()
  	{
  		if($('#password').val().length < 8){
  			$('#passwordError').html("The password must be longer than 8 characters!");
  			return;
  		}
  		
  		if ( !/[0-9]/.test($('#password').val()) ) {
  			$('#passwordError').html("The password must have one digit!");
  			return;
  		}
  		
  		if ( !/[A-Z]/.test($('#password').val()) ) {
  			$('#passwordError').html("The password must have one uppercase character!");
  			return;
  		}  		
  		
  	}
  	
  	
  	function checkUsername()
  	{
  		//alert($('#username').val());
  		
  		if($('#username').val().length < 5){
  			
  			$('#usernameError').html("Username must be longer than 5 characters!");
  			return;
  			
  		}
  		
  		
         $.ajax({
            type: "get",
            url: "../verifyUsername.php",
            dataType: "json",
            data: {"username" : $('#username').val() },
            success: function(data,status) {
            	
            	if (data['available'] == "false") {
            	
            	   $('#usernameError').html("NOT available");	
            	   $('#usernameError').css("color","red");
            	   $('#username').css("backgroundColor","red");
            	   
            		
            	} else {
            		
            	   $('#usernameError').html("Available!");
            	   $('#usernameError').css("color","green");
            	   $('#username').css("backgroundColor","");
            		
            	}
            	
                 
              },
            complete: function(data,status) { //optional, used for debugging purposes
                 //alert(status);
              }
         });  		
  		
  		
  	}
  	
    $( document ).ready(function() {
      //console.log( "ready!" );

        $("#username").change(function(){checkUsername()});
        $("#password").change(function(){checkPassword()});
       
     });
  	
  	
  </script>
</head>

<body>
  <div class="container">
    <header>
	   <div class="col-sm-12 white-background">
           <h1>Update Information</h1>
           <hr />
	   </div>
    </header>
   
    	<?$theUserInfo = getUserInfo()?>
          <div id="login-wrapper">
      
      <form class="form-horizontal">
      <div class="row">
         <div class="col-sm-4 form-group">
		    <p>First Name:</p> <input type="text" class="form-control" name="fName" value="<?=$theUserInfo['fName']?>" required/> <br />
      	    <p>Last Name:</p> <input type="text" class="form-control" name="lName" value="<?=$theUserInfo['lName']?>" required/> <br />
      	    <p>Username:</p> <input type="text" class="form-control" id="username" name="username" id="username" value="<?=$theUserInfo['username']?>" ><span id="usernameError"></span><br />
		 </div>
		 <div class="col-sm-2">
		 </div>
		 <div class="col-sm-4 form-group">
		    <p>Password:</p> <input type="text" class="form-control" id="password" name="password" required/>  <span id="passwordError"></span> 
		    <br />
		    <p>Confirm Password:</p> <input type="text" class="form-control" id="password2" name="confirmPassword" required/> <br />
		    <p>School Name:</p> <input type="text" class="form-control" name="schoolName" value="<?=$theUserInfo['schoolName']?>" required/> <br />
      	</div>
        <div class="col-sm-2">
		</div>
      </div>
      <div>          
      	<input type="hidden" name="email" value="<?=$theUserInfo['email']?>" />
      	<input type="hidden" name="userId" value="<?=$_SESSION['userId']?>" />
      	<input type="submit" class="btn btn-default btn-md btn-primary" value="Update User" name="updateForm" />
      </div>  	
    </form>
    </div>
          <?= theFooter(); ?>
	  </div>
</body>
</html>