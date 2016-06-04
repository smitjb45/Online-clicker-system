<?php
session_start();
include '../../includes/database.inc.php';
$dbConn = getDatabaseConnection();
 
 if (isset($_POST['submitForm'])) { // checks whether form was submitted
     
      echo "Upload: " . $_FILES["filename"]["name"] . "<br>";
      echo "Type: " . $_FILES["filename"]["type"] . "<br>";
      echo "Size: " . ($_FILES["filename"]["size"] / 1024) . " KB<br>";
      echo "Stored in: " . $_FILES["filename"]["tmp_name"];
	  
	  if ($_FILES["filename"]["size"] / 1024 > 20000) {
		  
		  echo "error file too big";
		  
		  return;
	  }
      
     
     echo "Uploading file...";
    move_uploaded_file($_FILES['filename']["tmp_name"], $_FILES["filename"]["name"]);
	
	echo "<img src='{$_FILES["filename"]["name"]}'/>";
	
	createThumbnail();
	 
	saveToDataBase("{$_FILES["filename"]["name"]}");
	 
	$_SESSION['employeeId'] = null;
	$_SESSION['theUpdate'] = "abc";	
	header("Location: ../products.php");
 }

 
 function createThumbnail(){
    $sourcefile = imagecreatefromstring(file_get_contents($_FILES["filename"]["name"]));
    $newx = 300; $newy = 300;  //new size
    $thumb = imagecreatetruecolor($newx,$newy);
    imagecopyresampled($thumb, $sourcefile, 0,0, 0,0, $newx, $newy,     
    imagesx($sourcefile), imagesy($sourcefile)); 
    imagejpeg($thumb,"{$_FILES["filename"]["name"]}"); //creates jpg image file called "thumb.jpg"
}

function saveToDataBase($pic)
{
	
	$sql = "UPDATE final_employee
			SET pic = :pic
			WHERE employeeId = :employeeId";
			
	 $namedParameters = array();		
	 $namedParameters[':pic'] = $pic;
     $namedParameters[':employeeId'] = $_SESSION['employeeId'];
	
    $dbConn = getDatabaseConnection();	
    $statement = $dbConn->prepare($sql);
    $statement->execute($namedParameters);	
}
 
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">

  <!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame 
       Remove this if you use the .htaccess -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

  <title>login</title>
  <meta name="description" content="">
  <meta name="author" content="smit9960">

  <meta name="viewport" content="width=device-width; initial-scale=1.0">

  <!-- Replace favicon.ico & apple-touch-icon.png in the root of your domain and delete these references -->
  <link rel="shortcut icon" href="/favicon.ico">
  <link rel="apple-touch-icon" href="/apple-touch-icon.png">
  <link rel="stylesheet" type="text/css" href="../css/styles.css">
  <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Mountains+of+Christmas" />
  
</head>

<body>
  <div>
    <header>
      <h1>Upload Picture</h1>
    </header>
    <form method="post" enctype="multipart/form-data">
	
	<h3>select File:</h3> 
	<input type="file" name="filename" class="button" />
	
	<input type="submit" class="button" name="submitForm" value="uploadFile"/>	
	
</form>
      
    </div>

        <footer id="footer">
			<hr />
			<p> the information included on this page may not be correct, it was created in CST336 &copy; Joshua Smith 2015</p>
			
			<img class="image-with border" src="../../../img/csumb-logo.png" alt="csumb logo" />
			
		</footer>
    
    
  </div>
</body>
</html>

