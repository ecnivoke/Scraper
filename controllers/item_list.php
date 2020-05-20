<?php 

// Require classes
require('../includes/Scraper.class.php');
require('../modals/Items.class.php');

// Declade variables
$scrapers 	= array();
$results 	= array();

// Create item handler
$item_h = new Items($database);

// Get items to scrape from database
$items = $item_h->getItemsByUser($session_handler->getVar('user_id'));

// Create a object per item
foreach($items as $item){
	$scrapers[] = new Scraper($item['item_url']);
}

// Scrape the item from the site
foreach($scrapers as $scraper) {
	$results[] = $scraper->scrape();
}

// Add item name to results
for($i = 0; $i < count($results); $i++){
	$results[$i]['name'] = $items[$i]['item_name'];
}

// Set page variables
$smarty->assign('title',	'Items');
$smarty->assign('results',	$results);

// Display page
$smarty->display('item_list.tpl.php');

 ?>