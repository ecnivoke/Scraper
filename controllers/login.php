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
						// Create random tokens
						$random_password = $session_handler->generateToken(32);
						$random_selector = $session_handler->generateToken(32);

						// Set cookie
						$session_handler->setCookie("username", 		$user['username']);
						$session_handler->setCookie("random_password",  $random_password);
						$session_handler->setCookie("random_selector",  $random_selector);

						// Hash tokens
						$random_password_hash = encryptPassword($random_password);
						$random_selector_hash = encryptPassword($random_selector);

						// Set expire date
						$expire_date = date("Y-m-d H:i:s", time() + $session_handler->getCookieExpireTime());

						// Check if user has an active token
						$user_token = $user_h->checkTokenByUser($user['username']);

						// Set old user token to expired
						if(!empty($user_token[0])){
							$user_h->expireToken($user_token[0]['id']);
						}

						// Create and insert new user token
						$user_h->createUserToken($user['username'], $random_password_hash, $random_selector_hash, $expire_date);
					}
					else {
						// Unset user cookies
						$session_handler->unsetCookie('AUTH');
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