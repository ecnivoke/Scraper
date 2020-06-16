<?php 

// Require classes
require('../includes/Scraper.class.php');
require('../models/Items.class.php');

// Declade variables
$scrapers 	= array();
$page 		= !empty($_GET['c']) ? $_GET['c'] : 1; // Default: page 1
$user_id 	= $session_handler->getVar('user_id');

// Create item handler
$item_h = new Items($database);

// Count items
$item_count  = $item_h->countItemsByUser($user_id)[0][0];
$pages_count = ceil($item_count / $item_h->getLimit());

// Set page variables
$smarty->assign('title',	'Items');
$smarty->assign('count', 	$pages_count);
$smarty->assign('page', 	$page);

// Display page
$smarty->display('item_list.tpl.php');

 ?>