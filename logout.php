<?php
    include("required_items/config.php");
    session_start();
    
    $_SESSION['username'] = null;
    $_SESSION['clearance'] = null;
   
   if(session_destroy()) {
      header("Location: /");
   }
?>