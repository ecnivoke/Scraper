<?php 

// Logout user
$session_handler->kill();

// Redirect to index
header('Location: index.php');


 ?>