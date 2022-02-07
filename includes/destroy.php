<?php 
session_start();
             
  if (isset($_SESSION["session_username"]) 
  echo $_SESSION["session_username"];
  {
     
      
     //sino, calculamos el tiempo transcurrido  
      
  }else{
    session_destroy(); // destruyo la sesión  
    header("Location: login.php");
  }

 ?>