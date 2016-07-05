    
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
    
function makeAddCode(){
    $addCodeElements = array("A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M",
                             "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z",
                             "1", "2", "3", "4", "5", "6", "7", "8", "9", "0");
                             
    shuffle($addCodeElements);
    
    $theAddCode = array_slice($addCodeElements, 0, 6);
    
    return implode($theAddCode);
}
	
 
 function checkDataBase(){
        
    global $dbConn; 
	
    $sql = "SELECT addCode FROM addCode";
        
	$records = getDataBySQL($sql);
	
    print_r($records);
	
    return $records;
}
    
$flag = true;
    
while($flag == true){
    
    $theAddcode = makeAddCode();
    $usedAddCodes = checkDataBase();
    
    if(!in_array($theAddcode, $usedAddCodes))
    {
       try{
           $sql = "INSERT INTO addcode(addCode, classId)
    		VALUES(:addCode, :classId);
			";
    
           $namedParameters = array();
           $namedParameters[':addCode'] = $theAddcode;
	       $namedParameters[':classId'] = $_SESSION['classId'];
      
           $dbConn = getDatabaseConnection();	
           $statement = $dbConn->prepare($sql);
           $statement->execute($namedParameters);
    	
	     //  header('Location: teacherHome.php');
         
         $flag = false;
           
       } catch(\PDOException $e){
           if ($e->errorInfo[1] == 1062) {
              //The INSERT query failed due to a key constraint violation.
              echo "Error, Please try to generate add code again!"; 
           }
       }
    }	
}
?>
