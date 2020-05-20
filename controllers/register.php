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

	if($valid === true){
		// Create the user
		$errors = $database->createUser($input);

		// If error is empty its ok
		if(empty($errors)){
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
					AND user_groups.id = users.user_group_id
					AND users.username = '".$input['usernameR']."'
			")[0];
			// Login the user
			$session_handler->login($user);

			// Redirect
			header('Location: ?p=item_list');
			exit();
		}
	}

	// Assign template variables
	$smarty->assign('input', 	$input);
	$smarty->assign('messages', $messages);
	$smarty->assign('messages', $messages);
	$smarty->assign('errors', 	$errors);
}

// Set page variables
$smarty->assign('title',	'Register');

// Display page
$smarty->display('register.tpl.php');

 ?>