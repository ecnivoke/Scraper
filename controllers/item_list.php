<?php 

// Require classes
require('../includes/Scraper.class.php');
require('../models/Items.class.php');

// Declade variables
$scrapers 	= array();
$results 	= array();
$page 		= !empty($_GET['c']) ? $_GET['c'] : 1; // Default: page 1
$user_id 	= $session_handler->getVar('user_id');

// Create item handler
$item_h = new Items($database);

// Count items
$item_count  = $item_h->countItemsByUser($user_id)[0];
$item_count  = $item_count[0];
$pages_count = ceil($item_count / $item_h->getLimit());

if($item_count > 0 && SKIP_SCRAPE === 0){
	// Get saved items from previous load
	$saved_items = $item_h->getSavedItems($user_id, $page);

	if(empty($saved_items)){
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
			$results[$i]['item_name'] 	= $items[$i]['item_name'];
			$results[$i]['item_url'] 	= $items[$i]['item_url'];
			$results[$i]['item_id'] 	= $items[$i]['id'];

			// Save item to user for faster loading
			$item_h->saveItemByUser($results[$i], $user_id);
		}

	}
	else {
		foreach($saved_items as $item){

			if(strtotime($item['expire_date']) > time()){
				// Strip json and decode
				$stripped 	= str_replace("\n", '', $item['item_info']);
				$results[] 	= json_decode($stripped, true);
			}
			else {
				$item_h->expireSavedItem($item['id']);

				$item = $item_h->getItemByUser($item['item_id'], $item['user_id'])[0];

				// Create scraper and scrape item
				$scraper = new Scraper($item['item_url']);
				$results[] = $scraper->scrape();

				// Add item name, url to results
				for($i = 0; $i < count($results); $i++){
					$results[$i]['item_name'] 	= $item['item_name'];
					$results[$i]['item_url'] 	= $item['item_url'];
					$results[$i]['item_id'] 	= $item['id'];

					// Save item to user for faster loading
					$item_h->saveItemByUser($results[$i], $user_id);
				}
			}
		}
	}
}

// Set page variables
$smarty->assign('title',	'Items');
$smarty->assign('results',	$results);
$smarty->assign('count', 	$pages_count);
$smarty->assign('page', 	$page);

// Display page
$smarty->display('item_list.tpl.php');

 ?>