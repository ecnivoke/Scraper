<?php 

$valid = validate($_POST);

// Set page variables
$smarty->assign('title', 	'Register');
$smarty->assign('messages', $valid);

// Display page
$smarty->display('register.tpl.php');

 ?>