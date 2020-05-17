<?php 

// Require classes
require('../includes/Scraper.class.php');

// Declade variables
$results = array();

// Get items to scrape
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

// d($items);

foreach($items as $item){

	$results[] = new Scraper($item['item_url']);
}

foreach ($results as $site) {
	$site->scrape();

	
	d($site->results);
}

// Set page variables
$smarty->assign('title',	'Items');
$smarty->assign('results',	$results);

// Display page
$smarty->display('item_list.tpl.php');

 ?>