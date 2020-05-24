<?php 

$user_group = $session_handler->getVar('user_group');

if( $user_group !== 'super_admin' || 
	$user_group !== 'admin'){
	// Require classes
	require('../modals/Users.class.php');

	// Declade variables
	$user 	= !empty($_GET['u']) ? $_GET['u'] : '';
	$action = !empty($_GET['a']) ? $_GET['a'] : '';

	// Create new user handler
	$user_h = new Users($database);

	if(empty($user) && empty($action)){
		// Get all users
		$users = $user_h->getAllUsers();
	}
	else {
		switch($action){ // ALL FUNCTIONS HAVE TO BE MADE
			case "user_group":
				$user_h->changeUserGroup($user);
			break;
			case "username":
				$user_h->changeUsername($user);
			break;
			case "email":
				$user_h->changeEmail($user);
			break;
		}

		$users = $user_h->getUserById($user);
	}

	// Set template variables
	$smarty->assign('title',	'Manage users');
	$smarty->assign('users',	$users);

	// Display page
	$smarty->display('manager.tpl.php');
}
else {
	// Set template variables
	$smarty->assign('title',	'Forbidden');
	$smarty->assign('error',	'403 Forbidden');

	// Display page
	$smarty->display('error.tpl.php');
}


 ?>