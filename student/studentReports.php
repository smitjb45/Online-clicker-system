<?php

$host = "localhost"; 
$dbname = "smit9960";  //your otterid 
$username = "root"; //your otterid 
$password = "mysql"; 

//creates connection to database 
$dbConn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password); 

// Setting Errorhandling to Exception 
$dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  

function averagePrice(){
	global $dbConn;
$sql = "SELECT AVG( price ) AS average
		FROM final_employee";
		
 $statement = $dbConn->prepare($sql); //prevents SQL Injection 
 $statement->execute(); 
 //$records = $statement->fetchAll(); //fetch and fetchAll 
 $records = $statement->fetch(PDO::FETCH_ASSOC); //fetch and fetchAll 
 

 		echo "<table border = 1>";
				echo "<tr>";
				echo "<td>"; 
    echo $records['average'] .  "<br />"; 
	echo "</td>";
	echo "</tr>";
	echo "</table>";

}

function genusSort(){
	global $dbConn;
	$sql = "SELECT genus, COUNT(genus)
		FROM final_employee
		GROUP BY genus
		LIMIT 0 , 30";
		
 $statement = $dbConn->prepare($sql); //prevents SQL Injection 
 $statement->execute(); 
 //$records = $statement->fetchAll(); //fetch and fetchAll 
 $records = $statement->fetchAll(PDO::FETCH_ASSOC); //fetch and fetchAll 
print_r($records); 
  foreach ($records as $record){
 echo "<table border = 1>";
				echo "<tr>";
				echo "<td>"; 

 echo $record['genus'] . " - " . $record['COUNT(genus)']; 
    echo "</td>";
	echo "</tr>";
	echo "</table>";
 }
}

function maxShipping(){
	global $dbConn;
	$sql = "SELECT MAX( shipmentPrice ) AS shipping
			FROM  va_shipment";
		
		$statement = $dbConn->prepare($sql); //prevents SQL Injection 
 $statement->execute(); 
 //$records = $statement->fetchAll(); //fetch and fetchAll 
 $records = $statement->fetch(PDO::FETCH_ASSOC); //fetch and fetchAll 
 
 
 	echo "<table border = 1>";
				echo "<tr>";
				echo "<td>"; 
    echo $records['shipping'] .  "<br />"; 
	echo "</td>";
	echo "</tr>";
	echo "</table>";

}

function minShipping(){
	global $dbConn;
		$sql = "SELECT MIN( shipmentPrice ) AS shipping
		FROM  va_shipment";
		
		$statement = $dbConn->prepare($sql); //prevents SQL Injection 
 $statement->execute(); 
 //$records = $statement->fetchAll(); //fetch and fetchAll 
 $records = $statement->fetch(PDO::FETCH_ASSOC); //fetch and fetchAll 
 
 	echo "<table border = 1>";
				echo "<tr>";
				echo "<td>"; 
    echo $records['shipping'] .  "<br />"; 
	echo "</td>";
	echo "</tr>";
	echo "</table>";
}

function sumOfProducts(){
	global $dbConn;
		$sql = "SELECT SUM( price ) AS sum
		FROM  va_product";
		
		$statement = $dbConn->prepare($sql); //prevents SQL Injection 
 $statement->execute(); 
 //$records = $statement->fetchAll(); //fetch and fetchAll 
 $records = $statement->fetch(PDO::FETCH_ASSOC); //fetch and fetchAll 
 
 	echo "<table border = 1>";
				echo "<tr>";
				echo "<td>"; 
    echo $records['sum'] .  "<br />"; 
	echo "</td>";
	echo "</tr>";
	echo "</table>";
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">

  <!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame 
       Remove this if you use the .htaccess -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

  <title>Crapple Reports</title>
  <meta name="description" content="">
  <meta name="author" content="snyd4924">

  <meta name="viewport" content="width=device-width; initial-scale=1.0">

  <!-- Replace favicon.ico & apple-touch-icon.png in the root of your domain and delete these references -->
  <link rel="shortcut icon" href="/favicon.ico">
  <link rel="apple-touch-icon" href="/apple-touch-icon.png">
  
</head>

  <header>
      <h1>Reports</h1>
    </header>

<body style="background-color: /* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#b3dced+0,29b8e5+50,bce0ee+100;Blue+Pipe */
background: rgb(179,220,237); /* Old browsers */
background: -moz-linear-gradient(top,  rgba(179,220,237,1) 0%, rgba(41,184,229,1) 50%, rgba(188,224,238,1) 100%); /* FF3.6+ */
background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(179,220,237,1)), color-stop(50%,rgba(41,184,229,1)), color-stop(100%,rgba(188,224,238,1))); /* Chrome,Safari4+ */
background: -webkit-linear-gradient(top,  rgba(179,220,237,1) 0%,rgba(41,184,229,1) 50%,rgba(188,224,238,1) 100%); /* Chrome10+,Safari5.1+ */
background: -o-linear-gradient(top,  rgba(179,220,237,1) 0%,rgba(41,184,229,1) 50%,rgba(188,224,238,1) 100%); /* Opera 11.10+ */
background: -ms-linear-gradient(top,  rgba(179,220,237,1) 0%,rgba(41,184,229,1) 50%,rgba(188,224,238,1) 100%); /* IE10+ */
background: linear-gradient(to bottom,  rgba(179,220,237,1) 0%,rgba(41,184,229,1) 50%,rgba(188,224,238,1) 100%); /* W3C */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#b3dced', endColorstr='#bce0ee',GradientType=0 ); /* IE6-9 */
">
	
	<h2>Report 1: Average Price</h2> 
        <strong>SQL:</strong> 
        <pre>  
SELECT AVG( price ) AS average
FROM final_employee
       </pre>  
       <?= averagePrice() ?>     
         
        <br /><hr><br /> 
        
        <h2>Report 2: amout og genus</h2> 
        <strong>SQL:</strong> 
        <pre>  
SELECT productName, description, price
FROM va_product
GROUP BY price
LIMIT 0 , 30
       </pre>  
       <?= genusSort() ?>     
         
        <br /><hr><br /> 
        



<footer style="text-align: center;
			font-size: .7em;">
	 <hr />
	 <p> the information included on this page may not be correct, it was created in CST336 &copy; Joshua Smith 2015</p>
	 <img class="image-with border" src="../img/csumb-logo.png" alt="csumb logo" />
</footer>
  </div>
</body>
</html>