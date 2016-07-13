<?php

function theFooter($index){
   
   if($index){
      echo '<footer id="footer">';
      echo '<hr />';
      echo '<p> the information included on this page may not be correct &copy; dodoboost 2015</p>';
      echo '<img src="./img/dodologo.gif" alt="dodoboost logo" />';
      echo '</footer>'; 
   }else{
      echo '<footer id="footer">';
      echo '<hr />';
      echo '<p> the information included on this page may not be correct &copy; dodoboost 2015</p>';
      echo '<img src="../img/dodologo.gif" alt="dodoboost logo" />';
      echo '</footer>';   
   }
}

?>