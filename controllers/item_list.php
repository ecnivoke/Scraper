<?php 

// Require classes
require('../includes/Scraper.class.php');
require('../modals/Items.class.php');

// Declade variables
$scrapers 	= array();
$results 	= array();
$page 		= !empty($_GET['c']) ? $_GET['c'] : 1; // Default: page 1

// Create item handler
$item_h = new Items($database);

// Count items
$item_count  = $item_h->countItemsByUser($session_handler->getVar('user_id'))[0];
$item_count  = $item_count[0];
$pages_count = ceil($item_count / $item_h->getLimit());

if($item_count > 0 && SKIP_SCRAPE === 0){
	// Get items to scrape from database
	$items = $item_h->getItemsByUser($session_handler->getVar('user_id'), $page);

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
		$results[$i]['name'] 	= $items[$i]['item_name'];
		$results[$i]['url'] 	= $items[$i]['item_url'];
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