<?php 

// Require classes
require('../includes/Validator.class.php');
require('../modals/Users.class.php');

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
		// Create user class
		$user_h = new Users($database);

		// Get user
		$user = $user_h->getUser($input['usernameR']);

		// Remove this and you get errors
		if(!empty($user)){
			$user = $user[0];
		}

		// Verity password
		if(!empty($user['password'])){
			if($user['status'] === 'a'){
				if(password_verify($input['passwordR'], $user['password'])){
					$session_handler->login($user);

					// Remember user
					if(!empty($input['remember'])){
						$session_handler->rememberUser($user);
					}

					// Redirect
					header('Location: ?p=item_list');
					exit();
				}
				else {
					$errors = 'Username or password incorrect!';
				}
			}
			else {
				$errors = 'This user can\'t login right now!';
			}
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