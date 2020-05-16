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

	if($valid === true){
		// Create the user
		$error = $database->createUser($input);

		// If error is empty its ok
		if(empty($error)){
			$user = $database->getRows("
				SELECT
					users.id,
					users.username,
					users.password
				FROM 
					users
				WHERE
					users.username = '".$input['usernameR']."'
			")[0];
			// Login the user
			$session_handler->login($user);

			// Redirect
			header('Location: ?p=item_list');
			exit();
		}
	}

	// Set page variables
	$smarty->assign('input', 	$input);
	$smarty->assign('messages', $messages);
	$smarty->assign('messages', $messages);
	$smarty->assign('errors', 	$error);
}

// Set page variables
$smarty->assign('title',	'Register');

// Display page
$smarty->display('register.tpl.php');

 ?>