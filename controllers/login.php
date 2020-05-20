<?php 

// Require classes
require('../includes/Validator.class.php');

// Declade variable
$errors = '';

if(!empty($_POST)){
	// Create validator and validate input
	$validator = new Validator($_POST);
	$validator->validate();

	// Get variable for template
	$input 		= $validator->getInput();
	$valid 		= $validator->getValid();
	$messages 	= $validator->getMessages();

	// Get user
	$user = $database->getRows("
		SELECT
			users.id,
			users.username,
			users.password,
			users.email,
			user_groups.role AS user_group
		FROM 
			users,
			user_groups
		WHERE 1 = 1
			AND (users.username 		= '".$input['usernameR']."'
			OR 	 users.email 			= '".$input['usernameR']."')
			AND users.user_group_id 	= user_groups.id
	");

	// Remove this and you get errors
	if(!empty($user)){
		$user = $user[0];
	}

	// Verity password
	if(!empty($user['password'])){
		if(password_verify($input['passwordR'], $user['password'])){
			$session_handler->login($user);

			// Redirect
			header('Location: ?p=item_list');
			exit();
		}
		else {
			$errors = 'Username or password incorrect!';
		}
	}

	// Assign template variables
	$smarty->assign('input', 	$input);
	$smarty->assign('messages', $messages);
	$smarty->assign('errors', 	$errors);
}

// Set page variables
$smarty->assign('title',	'Login');

// Display page
$smarty->display('login.tpl.php');

 ?>