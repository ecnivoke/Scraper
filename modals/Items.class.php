<?php 

class Items {

// Properties
	private $sql = array();
	private $database;
// End Properties
	public function __construct($database){
		$this->database = $database;
	}
// Getters
// End Getters
// Setters
// End Setters
// Methods

	public function getItemsByUser($user){
		// Build sql
		$this->sql['get_items'] = "
			SELECT 
				scrape_items.id,
				scrape_items.item_url,
				scrape_items.item_name,
				scrape_items.user_id
			FROM 
				scrape_items
			WHERE 1 = 1
				AND scrape_items.user_id = ".$user."
		";

		// Get user
		$results = $this->database->getRows($this->sql['get_items']);

		// Output
		return $results;
	}

// End Methods
}





 ?>