<?php 

if(!empty($session_handler->getVar('fake_login'))){
	// Require classes
	require('../modals/Users.class.php');

	$user_h = new Users($database);

	// Get previous user
	$user_id = $session_handler->getVar('_user_id');
	$user 	 = $user_h->getUserById($user_id)[0];

	// Login previous user
	$session_handler->login($user);
}
else {
	// Logout user
	$session_handler->kill();
}

// Redirect to index
header('Location: index.php');
exit();

 ?>