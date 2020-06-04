<?php 

// Require classes
require('../includes/Validator.class.php');
require('../models/Users.class.php');

// Declade variable
$errors = '';

if(!empty($_POST)){
	// Create validator and validate input
	$validator = new Validator($_POST, $session_handler->getVar('csrf_token'));
	$validator->validate();

	// Get variable for template
	$input 		= $validator->getInput();
	$valid 		= $validator->getValid();
	$messages 	= $validator->getMessages();
	$popups 	= array();

	if($valid == true){
		// Create user handler
		$user_h = new Users($database);

		// Create the user
		$errors = $user_h->createUser($input);

		// If error is empty its ok
		if(empty($errors) && !isset($input['user_group'])){

			$user = $user_h->getUser($input['usernameR'])[0];

			// Login the user
			$session_handler->login($user);

			// Redirect
			header('Location: ?p=index');
			exit();
		}
		elseif(isset($input['user_group'])) {
			// Set popup message
			$popups[] = "User '".$input['usernameR']."' is created succesfully!";

			// Clear input
			$input = array();
		}
	}

	// Assign template variables
	$smarty->assign('input', 	$input);
	$smarty->assign('messages', $messages);
	$smarty->assign('errors', 	$errors);
	$smarty->assign('popups', 	$popups);
}

// Set page variables
$smarty->assign('title',	'Register');

// Display page
$smarty->display('register.tpl.php');

 ?>