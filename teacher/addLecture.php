
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
	
if (isset($_GET['Form'])) {  
	global $dbConn;
	
	
	$sql = "INSERT INTO lecture(classId, lectureName, lectureOrder)
    		VALUES(:classId, :lectureName, :lectureOrder)
			";
			   
    $namedParameters = array();
    $namedParameters[':classId'] = $_GET['classId'];
    $namedParameters[':lectureOrder'] = $_GET['lectureOrder'];
    $namedParameters[':lectureName'] = $_GET['lectureName'];
      	
    $statement = $dbConn->prepare($sql);
    $statement->execute($namedParameters);

	//header('Location: questions.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">

  <!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame 
       Remove this if you use the .htaccess -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

  <title>Create Lecture</title>
  <meta name="description" content="">
  <meta name="author" content="smit9960">

  <meta name="viewport" content="width=device-width; initial-scale=1.0">

  <!-- Replace favicon.ico & apple-touch-icon.png in the root of your domain and delete these references -->
  <link rel="shortcut icon" href="/favicon.ico">
  <link rel="apple-touch-icon" href="/apple-touch-icon.png">
  <link rel="stylesheet" type="text/css" href="css/styles.css">
  <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Mountains+of+Christmas" />
</head>

<body>
  <div>
    <header>
      <h1>Create Lecture</h1>
    </header>

    <div>
      	
      </div>
		<form>
		
		<p>Lecture Order:</p><input type="text" name="lectureOrder" required/> <br />
		<p>Lecture Name:</p> <input type="text" name="lectureName" id="lectureName" required/><br /><br />
		
      	</div>
      	<br />          
      	<br />          
      	<br />          
		
      	<input type="hidden" name="classId" value="<?=$_GET['classId']?>" />
      	<input type="submit" class="button" value="Add Lecture" name="Form" />
       <?=$_GET['classId']?>
      </form>

    </div>
    <footer id="footer">
			<hr />
			<p> the information included on this page may not be correct, it was created in CST336 &copy; Joshua Smith 2015</p>
			
			<img class="image-with border" src="../../img/csumb-logo.png" alt="csumb logo" />
			
		</footer>
  </div>
</body>
</html>
