<?php

session_start();	
include 'includes/database.inc.php';

if (isset($_POST['addForm'])) {  //admin submitted form to add user

  $sql = "INSERT INTO user( fName, lName, username, email, password, userType, schoolName) 
          VALUES ( :fName, :lName, :username, :email, :password, :userType, :schoolName)";
		  
    $namedParameters = array();
    $namedParameters[':fName'] = $_POST['fName'];
    $namedParameters[':lName'] = $_POST['lName'];
	$namedParameters[':username'] = $_POST['username'];
    $namedParameters[':email'] = $_POST['email'];
	$namedParameters[':password'] = sha1($_POST['password']);
	$namedParameters[':userType'] = $_POST['userType'];
	$namedParameters[':schoolName'] = strtoupper($_POST['schoolName']);
      
    $dbConn = getDatabaseConnection();	
    $statement = $dbConn->prepare($sql);
    $statement->execute($namedParameters);
	
	session_start();
    session_destroy();
    header('Location: index.php');
    exit;
			
	/*if(strcmp($_POST['userType'], "student") == 0){
         header('Location: student/student.php');
	}
	else if($_POST['userType'], "teacher") == 0){
		header('Location: teacher/teacher.php');
	}
	else{
	   session_start();
            session_destroy();
            header('Location: index.php');
            exit;	
	}*/
	  
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">

  <!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame 
       Remove this if you use the .htaccess -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

  <title>SIGN UP</title>
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
    <script>
  
  	 	
  	function getCity(){
  		
  		//alert($("#zipCode").val());
  		
      $.ajax({
            type: "get",
            url: "http://hosting.otterlabs.org/laramiguel/ajax/zip.php",
            dataType: "json",
            data: { "zip_code":$("#zipCode").val()},
            success: function(data,status) {
                 //alert(data['city']);
                 $("#city").html(data['city']);
                 $("#latitude").html(data['latitude']);
                 $("#longitude").html(data['longitude']);
              },
              complete: function(data,status) { //optional, used for debugging purposes
                  //alert(status);
              }
         }); //end Ajax  		
  		
  	} //endFunction
  	
     function getCounty(){
         	
         	//alert($("#state").val());
         	
         $.ajax({
            type: "get",
            url: "http://hosting.otterlabs.org/laramiguel/ajax/countyList.php",
            dataType: "json",
            data: { "state":$("#state").val() },
            success: function(data,status) {
                 //alert(data['counties'][0].county);
                 
                 $("#county").html("<option> - Select One - </option>");
                 
                 for (var i=0; i < data['counties'].length;  i++) {
                 	
                 	$("#county").append("<option>" + data['counties'][i].county + "</option>");
                 	
                 }
                 
                 
              },
            complete: function(data,status) { //optional, used for debugging purposes
                 //alert(status);
              }
         });

         	
     } //endFunction
  	
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
  	
  	function checkEmail()
  	{
  		if ( !/[@]/.test($('#email').val()) ) {
  			$('#emailError').html("Must be a valid email address");
  			return;
  		}  			
		
		 $.ajax({
            type: "get",
            url: "verifyEmail.php",
            dataType: "json",
            data: {"email" : $('#email').val() },
            success: function(data,status) {
            	
            	if (data['available'] == "false") {
            	
            	   $('#emailError').html("NOT available");	
            	   $('#emailError').css("color","red");
            	   $('#email').css("backgroundColor","red");
            	   
            		
            	} else {
            		
            	   $('#emailError').html("Available!");
            	   $('#emailError').css("color","green");
            	   $('#username').css("backgroundColor","");
            		
            	}
            	
                 
              },
            complete: function(data,status) { //optional, used for debugging purposes
                 //alert(status);
              }
         });  		
  	}
  	
  	function checkPhone()
  	{
  		if ( !/\([0-9]{3}\)[0-9]{3}\-[0-9]{4}/.test($('#phone').val()) ) {
  			$('#phoneError').html("Must be a valid phone number");
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
            url: "verifyUsername.php",
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
        $("#email").change(function(){checkEmail()});
 
     });
  	
  	
  </script>
</head>

<body>
  <div class="container">
    <header>
       <div class="row">
          <div class="col-sm-12 white-background">
             <h1>SIGN UP</h1>
             <br />
          </div>
       </div>
    </header>
    <br />
    <div id="row">
      
      <form method="post">
      	<div class="col-md-6">
      	   <p>First Name:</p> <input type="text" name="fName" required/> <br />
      	   <p>Last Name:</p> <input type="text" name="lName" required/> <br />
      	   <p>Email:</p> <input type="text" name="email" id="email"><span id="emailError"></span><br /><br />
      	   <p>Username:</p> <input type="text" name="username" id="username"><span id="usernameError"></span><br />
		</div>
        <div class="col-md-6">
           <p>Password:</p> <input type="text" name="password" required/> <br />
		   <p>School Name:</p> <input type="text" name="schoolName" required/> <br />
      	
      	   <p>User type:<p/> <select name="userType">
      		                    <option value="student">Student</option>
      		                    <option value="teacher">Teacher</option>
      	                     </select>
        </div>       
      	<input type="submit" id="signup-btn" class="btn btn-default btn-md btn-primary top-button-padding" value="Sign Up!" name="addForm" />
      </form>
    </div>
        <div class="row">
           <div class="col-md-12">
              <footer id="footer">
	             <hr />
	             <p> the information included on this page may not be correct &copy; SpoutTech 2015</p>
		         <img src="../img/logoSproutBottom.png" alt="Sprout logo" />
	          </footer>
           </div>
        </div>
  </div>
</body>
</html>