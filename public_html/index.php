<?php 

// Require files
require('../config/config.php');
require('../config/init_smarty.php');
require('../includes/library.php');
require('../includes/Session.class.php');
require('../includes/Middleware.class.php');

// Make session handler
$session_handler = new Session();
$logged_in 		 = $session_handler->logged_in();

// Make middleware handler
$middleware 	 = new Middleware();

// Connect to database
$database = initDatabase();

// Set CSRF Token
$session_handler->setCSRFToken();

// User is not logged in yet, but cookies are set.
if(	!empty($session_handler->getVar('username')) &&
	!empty($session_handler->getVar('random_password')) &&
	!empty($session_handler->getVar('random_selector')) &&
	$logged_in == false ){

	// Require User modal
	require('../models/Users.class.php');

	// Create a new user handler
	$user_h = new Users($database);

	// Get the user token
	$user_token = $user_h->getTokenByUser($session_handler->getVar('username'))[0];

	// Verify tokens and expire date
	if($user_token['expire_date'] >= date('Y-m-d') &&
		password_verify($session_handler->getVar('random_password'), $user_token['password_hash']) &&
		password_verify($session_handler->getVar('random_selector'), $user_token['selector_hash'])){

		// Login user
		$user = $user_h->getUser($user_token['username'])[0];
		$session_handler->login($user);
	}
}

// Get page from url
$controller = !empty($_GET['p']) ? $_GET['p'] : '';

if(!DEVELOP){
	$exception  = $session_handler->getException();

	if($exception){
		$smarty->assign('title', 'Error');
		$smarty->assign('error', [$exception->getMessage()]);

		// Show error page
		$smarty->display(TEMPLATE_DIR.'error.tpl.php');
		exit();
	}
}

if($controller === ''){
	$smarty->assign('title', 'Home');
	// Show index page
	$smarty->display(TEMPLATE_DIR.'index.tpl.php');
}
else {
	// Set paths
	$controller_path 	= CONTROLLER_DIR.$controller.'.php';
	$page_path 			= TEMPLATE_DIR.$controller.'.tpl.php';
	$script_path 		= SCRIPT_DIR.$controller.'.js';

	$script = file_exists($script_path) ? $script_path : '';

	// Check if the user has permission to enter the given url
	$permission = $middleware->checkPermission($controller);

	// Check if user can go to the url
	if($permission){
		// Include javascript
		$smarty->assign('script', $script);
		if(file_exists($controller_path)){
			// Require page controller
			require($controller_path);
		}
		elseif(file_exists($page_path)){

			// Show page without controller
			$smarty->assign('title', $controller);
			$smarty->display($page_path);
		}
		// Page not found
		else {
			$smarty->assign('title', 'Page Not Found');
			$smarty->assign('error', DEVELOP?[$controller_path, $page_path, 'Not Found']:['404 Page not found']);

			// Show error page
			$smarty->display(TEMPLATE_DIR.'error.tpl.php');
		}
	}
	// No permission
	else {
		if(DEVELOP){
			// Get user group for error display
			$usr_grp = !empty($session_handler->getVar('user_group')) ? $session_handler->getVar('user_group') : 'Not Logged In';

			// Set template variables
			$smarty->assign('title',	'Page Not Found');
			$smarty->assign('error',	['Requested controller: '.$controller, 'No permission for "'.$usr_grp.'"']);

			// Display page
			$smarty->display('error.tpl.php');
		}
		else {
			// Redirect to index
			header('Location: index.php');
		}
	}
}

// Exit script
exit();

 ?>