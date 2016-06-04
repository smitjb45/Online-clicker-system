<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>SproutTech</title>
    
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
     function signUp(){
		 document.location.href = "addUser.php";
	 }
  </script>
  </head>
  <body>
  
    <div class="container">
       <div class="col-sm-12 white-background">
          <h1>Welcome to Sprout</h1>
          <br />
	   </div>

	   <div class="row">
	     <div class="col-md-11">
            <br />
		    <ul class="nav nav-pills">
	           <li><a href="#">About</a></li>
	           <li><a href="#">Pricing</a></li>
	           <li><a href="#">Instructions</a></li>
               <li><a href="#">Blog</a></li>
               <li><a href="#">Contact</a></li>	   
	        </ul>
		</div>
        
	   <div class="col-md-1">
	      
	   </div>
       <div class="row">
          <div class="col-md-12">
	         <hr />
             <br />
	      </div>
       </div>
	   <div class="row">
            <div class="col-sm-1">
            </div>
	        <div class="col-sm-6 white-background">
		        <h4>
			 Welcome to Sprout! SproutTech makes software tools for teachers to improve their teaching skills
			 and plant spouts of information in their students. This site is under construction.
			 The beta version of this site will be up soon! Thanks for checking out Sprout!
			    </h4>
			</div>
	   <div class="col-md-5">
	       	<form method="post" action="loginProcess.php" class="form-horizontal">
			    <div class="form-group">
				   
				   <label for="inputEmail3" class="col-sm-3 control-label">Username</label>
    		          <div class="col-sm-9">
				   <input type="text" class="form-control" placeholder="User Name" name="username" />
				</div>
		
		</div>
		 <div class="form-group">
            <label for="inputPassword3" class="col-sm-3 control-label">Password</label>
               <div class="col-sm-9">
                  <input type="password" class="form-control" id="inputPassword3" placeholder="Password" name="password">
                </div>
          </div>
		   <div class="form-group">
              <div class="col-sm-offset-3 col-sm-9">
                 <input type="submit" class="btn btn-default btn-lg btn-primary" value="Login" name="loginForm" />
                 <form action="addUser.php">
                    <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                    <input type="button" class="btn btn-default btn-md btn-primary" onclick="signUp()" value="sign up!" />
                 </form>
              </div>
		  
    	 </div>
		</form>	  
	   </div>
	   <div class="row">
	      <div class="col-md-9">

		  </div>
		  <div class="col-md-3">
		    
		  </div>
	   </div>
    </div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
           <footer id="footer">
	      <hr />
	      <p> the information included on this page may not be correct &copy; SpoutTech 2015</p>
		  <img src="../img/logoSproutBottom.png" alt="Sprout logo" />
	   </footer>

</html>