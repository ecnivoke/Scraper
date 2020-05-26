<?php 

// Require classes
require('../includes/Validator.class.php');
require('../models/Items.class.php');

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

	if($valid){
		// Create item handler
		$item_h = new Items($database);

		// Add item
		$item_h->addItem($input, $session_handler->getUser('user_id'));

		// Set popup message
		$popups[] = "Item '".$input['item_nameR']."' is created succesfully!";

		// Clear input
		$input = array();
	}

	// Assign template variables
	$smarty->assign('input', 	$input);
	$smarty->assign('messages', $messages);
	$smarty->assign('errors', 	$errors);
	$smarty->assign('popups', 	$popups);
}

// Set page variables
$smarty->assign('title',	'Add item');

// Display page
$smarty->display('add_item.tpl.php');

 ?>