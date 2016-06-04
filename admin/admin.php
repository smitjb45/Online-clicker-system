

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
  <link rel="stylesheet" type="text/css" href="css/styles.css">
  <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Mountains+of+Christmas" />
</head>

<body>
  <div>
    <header>
      <h1>Secret Admin Login</h1>
    </header>
    <div id="login-wrapper">
    	
    	<form method="post" action="loginProcess.php">
    		
    		<p><strong>User Name:</strong>:</p> <input type="text" name="username" /> <br />
    		<p><strong>Password:</strong></p><input type="password" name="password" /> <br />
    		<input type="submit" class="button" value="Login" name="loginForm" />
    		
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
