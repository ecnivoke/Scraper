<?php 

// Require files
require('../config/config.php');
require_once('../config/init_smarty.php');
require('../includes/library.php');
require('../includes/Session.class.php');

// Make session handeler
$session_handler = new Session();

// Connect to database
$database = initDatabase();

// Get page from url
$controller = !empty($_GET['p']) ? $_GET['p'] : '';

if($controller == ''){
	$smarty->assign('title', 'Home');
	// Show index page
	$smarty->display(TEMPLATE_DIR.'index.tpl.php');
}
else {
	// Set paths
	$controller_path 	= '../controllers/'.$controller.'.php';
	$page_path 			= TEMPLATE_DIR.$controller.'.tpl.php';

	// Check if logged in
	if($session_handler->logged_in()){
		if(file_exists($controller_path)){
			// Require page controller
			require($controller_path);
		}
		elseif(file_exists($page_path)){

			// Show page without controller
			$smarty->assign('title', $controller);
			$smarty->display($page_path);
		}
		else {
			$smarty->assign('title', 'Page Not Found');
			$smarty->assign('error', DEVELOP?[$controller_path, $page_path, 'Not Found']:['404 Page not found']);

			// Show error page
			$smarty->display(TEMPLATE_DIR.'error.tpl.php');
		}
	}
	elseif($controller === 'login' || $controller === 'register') {
		// Redirect to login / register
		require($controller_path);
	}
	else {
		// Redirect to index
		header('Location: index.php');
	}
}

// Exit script
exit();

 ?>