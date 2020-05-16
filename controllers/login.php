<?php 

// Require classes
require('../includes/Validator.class.php');

if(!empty($_POST)){
	// Create validator and validate input
	$validator = new Validator($_POST);
	$validator->validate();

	// Get variable for template
	$input 		= $validator->getInput();
	$valid 		= $validator->getValid();
	$messages 	= $validator->getMessages();

	$user = $database->getRows("
		SELECT
			users.id,
			users.username,
			users.password
		FROM 
			users
	")[0];

	if(password_verify($input['passwordR'], $user['password'])){
		$session_handler->login($user);

		// Redirect
		header('Location: ?p=item_list');
		exit();
	}

	$smarty->assign('input', 	$input);
	$smarty->assign('messages', $messages);
}

// Set page variables
$smarty->assign('title',	'Login');

// Display page
$smarty->display('login.tpl.php');

 ?>