<?php   
session_start(); //to ensure you are using same session
// remove all session variables
session_unset(); 
session_destroy(); //destroy the session
header("location:/cloudfiles/index.html"); //to redirect back to "index.php" after logging out
exit();
?>
