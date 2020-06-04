<?php 

// Require classes
require('../includes/Validator.class.php');
require('../models/Items.class.php');

// Declade variable
$item_h  = new Items($database);
$item_id = $_GET['id'];
$item 	 = $item_h->getItemById($item_id)[0];
$user_id = $session_handler->getVar('user_id');

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
		if(!empty($input['delete'])){
			// Delete item
			$item_h->deleteItem($item_id);
		}
		else {
			// Update item
			$item_h->updateItem($input);
		}

		// Redirect
		header('Location: index.php?p=item_list');
		exit();
	}

	// Assign template variables
	$smarty->assign('input', 	$input);
	$smarty->assign('messages', $messages);
	$smarty->assign('popups', 	$popups);
}

// Assign template variables
$smarty->assign('title',	'Register');
$smarty->assign('item',		$item);

// Display page
$smarty->display('edit_item.tpl.php');

 ?>