
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
	
 function getUserInfo(){
 	global $dbConn;
	
	$sql = "SELECT * FROM classes
	WHERE classId = :classId";
	
	$namedParameters = array();
	$namedParameters[':classId'] = $_GET['classId'];
	$statement = $dbConn->prepare($sql);	
	$statement->execute($namedParameters);
	$record = $statement->fetch();
   
	return $record;
 }

if (isset($_GET['updateForm'])) {  //admin submitted the Update Form
	
	
	$sql = "UPDATE classes
			SET className = :className,
			notes = :notes,
			startDate = :startDate
			WHERE classId = :classId";
		
	$namedParameters = array();
	$namedParameters[':className'] = $_GET['className'];
    $namedParameters[':notes'] = $_GET['notes'];
    $namedParameters[':startDate'] = $_GET['startDate'];
    $namedParameters[':classId'] = $_GET['classId'];	

    $dbConn = getDatabaseConnection();	
    $statement = $dbConn->prepare($sql);
    $statement->execute($namedParameters);	
  	

    	
	header('Location: teacherHome.php');
	
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">

  <!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame 
       Remove this if you use the .htaccess -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

  <title>Update Class Info</title>
  <meta name="description" content="">
  <meta name="author" content="smit9960">

  <meta name="viewport" content="width=device-width; initial-scale=1.0">
  <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
  <!-- Replace favicon.ico & apple-touch-icon.png in the root of your domain and delete these references -->
  <link rel="shortcut icon" href="/favicon.ico">
  <link rel="apple-touch-icon" href="/apple-touch-icon.png">

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
  <div class="container">
    <header>
       <div class="col-sm-12 white-background">
           <h1>Update Information</h1>
	   </div>
    </header>
    <div>
    	<?$theUserInfo = getUserInfo()?>
      
      <form>
		<br />
		<p>Class Name:</p> <input type="text" name="className" value="<?=$theUserInfo['className']?>" required/> <br />
      	<br />
        <p>Notes:</p> <textarea rows="50" cols="80" name="notes" id="notes"><?=$theUserInfo['notes']?></textarea><br /><br />
		<input type="hidden" name="startDate" value="<?=$theUserInfo['startDate']?>" required/> <br />
      	</div>
      	<br />          
      	<br />          
      	<br />          
      	<input type="hidden" name="classId" value="<?=$_GET['classId']?>" />
      	<input type="submit" class="btn btn-default btn-lg btn-primary" value="Update
        " name="updateForm" />
      </form>
    </div>
       <footer id="footer">
	      <hr />
	      <p> the information included on this page may not be correct &copy; SpoutTech 2015</p>
		  <img  src="../img/logoSproutBottom.png" alt="Sprout logo" />
	   </footer>
  </div>
</body>
</html>
