<?php 

// Require files
require_once('../config/config.php');
require_once('../config/init_smarty.php');
require_once('../includes/library.php');
require_once('../includes/Session.class.php');

// Make session handeler
$session_handler = new Session();

// $session_handler->setVar('logged_in', false);

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
	if($session_handler->getVar('logged_in')){
		if(file_exists($controller_path)){
			// Require page controller
			require_once($controller_path);
		}
		elseif(file_exists($page_path)){

			$smarty->assign('title', $controller);
			// Show page without controller
			$smarty->display($page_path);
		}
		else {
			$smarty->assign('title', 'Page Not Found');
			$smarty->assign('error', DEVELOP?[$controller_path, $page_path, 'Not Found']:['404 Page not found']);

			// Show error page
			$smarty->display(TEMPLATE_DIR.'error.tpl.php');
		}
	}
	elseif($controller === 'login') {
		// Redirect to login
		require_once('../controllers/login.php');
	}
	elseif($controller === 'register') {
		// Redirect to login
		require_once('../controllers/register.php');
	}
}

// Exit script
exit();

 ?>