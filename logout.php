<?php
    include("required_items/config.php");
    session_start();
   
   if(session_destroy()) {
      header("Location: /");
   }
?>