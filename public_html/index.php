<?php 

// Require files
require_once('../config/config.php');
require_once('../config/init_smarty.php');
require_once('../includes/library.php');

// Get page from url
$controller = !empty($_GET['p']) ? $_GET['p'] : '';

if($controller == ''){
	// Show index page
	$smarty->display(TEMPLATE_DIR.'index.tpl.php');
}
else {
	// Require page controller
	require_once('../controllers/'.$controller.'.php');
}

// Exit script
exit();

 ?>