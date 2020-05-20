<?php 

// Require classes
require('../includes/Scraper.class.php');

// Declade variables
$scrapers 	= array();
$results 	= array();

// Get items to scrape from database
$items = $database->getRows("
	SELECT 
		scrape_items.id,
		scrape_items.item_url,
		scrape_items.item_name,
		scrape_items.user_id
	FROM 
		scrape_items
	WHERE 1 = 1
		AND scrape_items.user_id = ".$session_handler->getVar('user_id')."
");

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