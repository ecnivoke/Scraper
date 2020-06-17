<?php 

// Require files
require('../config/config.php');
require_once('../config/init_smarty.php');
require('../includes/library.php');
require('../includes/Session.class.php');

// Make session handeler
$session_handler = new Session();
$logged_in 		 = $session_handler->logged_in();

// Connect to database
$database = initDatabase();

// Set CSRF Token
$session_handler->setCSRFToken();

// User is not logged in yet, but cookies are set.
if(	!empty($session_handler->getVar('username')) &&
	!empty($session_handler->getVar('random_password')) &&
	!empty($session_handler->getVar('random_selector')) &&
	$logged_in == false ){

	// Require User modal
	require('../models/Users.class.php');

	// Create a new user handler
	$user_h = new Users($database);

	// Get the user token
	$user_token = $user_h->getTokenByUser($session_handler->getVar('username'))[0];

	// Verify tokens and expire date
	if($user_token['expire_date'] >= date('Y-m-d') &&
		password_verify($session_handler->getVar('random_password'), $user_token['password_hash']) &&
		password_verify($session_handler->getVar('random_selector'), $user_token['selector_hash'])){

		// Login user
		$user = $user_h->getUser($user_token['username'])[0];
		$session_handler->login($user);
	}
}
	
// Declade variable
$action  = $_GET['action'];
$results = array();

// Call action
switch($action){
	case 'getItems':

		// Require classes
		require('../includes/Scraper.class.php');
		require('../models/Items.class.php');

		// Create new item handler
		$item_h  = new Items($database);

		// Define variable
		$page 	  = $_GET['page'];
		$user_id  = $session_handler->getVar('user_id');

		// Count items
		$item_count  = $item_h->countItemsByUser($user_id)[0][0];
		$pages_count = ceil($item_count / $item_h->getLimit());

		if($item_count > 0){
			// Get items to scrape from database
			$items = $item_h->getItemsByUser($user_id, $page);

			// Create a object per item
			foreach($items as $item){
				$scrapers[] = new Scraper($item['item_url']);
			}

			// Scrape the item from the site
			foreach($scrapers as $scraper) {
				$results[] = $scraper->scrape();
			}

			// Add item name, url to results
			for($i = 0; $i < count($results); $i++){
				if(empty($results[$i])){
					$results[$i]['error'] = 'Not supported yet';
				}
				$results[$i]['item_name'] 	= $items[$i]['item_name'];
				$results[$i]['item_url'] 	= $items[$i]['item_url'];
				$results[$i]['item_id'] 	= $items[$i]['id'];
			}
		}
		else {
			// No items found error
			$results['error'] = array();
			$results['error'][] = true;
			$results['error'][] = 'No Items Found';
		}

	break;
}

// Send results to javascript
$results = json_encode($results);
echo $results;

 ?>