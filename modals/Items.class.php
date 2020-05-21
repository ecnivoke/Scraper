<?php 

class Items {

// Properties
	private $sql = array();
	private $database;
	private $limit = 3; // Items per page
// End Properties
	public function __construct($database){
		$this->database = $database;
	}
// Getters
// End Getters
// Setters
// End Setters
// Methods
	public function countItemsByUser($user){
		// Build sql
		$this->sql['count_items'] = "
			SELECT 
				COUNT(scrape_items.id)
			FROM 
				scrape_items
			WHERE 1 = 1
				AND scrape_items.user_id = ".$user
		;

		// Get results
		$results = $this->database->getRows($this->sql['count_items']);

		// Output
		return $results;
	}

	public function getItemsByUser($user, $page){
		// Build sql
		$this->sql['get_items'] = "
			SELECT 
				scrape_items.id,
				scrape_items.item_url,
				scrape_items.item_name,
				scrape_items.user_id
			FROM ";

		if($page != 1){
			// Calculate offset
			$page = $page * $this->limit - $this->limit;

			// Build new sql
			$this->sql['get_items'] .= "
				(SELECT 
					ROW_NUMBER() OVER(ORDER BY scrape_items.id) AS row,
					scrape_items.id,
					scrape_items.item_url,
					scrape_items.item_name,
					scrape_items.user_id
				FROM 
					scrape_items
				) AS scrape_items
				WHERE 1 = 1
					AND ".$page." < row
				ORDER BY 
					scrape_items.id
				LIMIT ".$this->limit;
		}
		else {
			// Build default sql
			$this->sql['get_items'] .= "
					scrape_items
				WHERE 1 = 1
					AND scrape_items.user_id = ".$user."
				ORDER BY 
					scrape_items.id ASC
				LIMIT ".$this->limit;
		}

		// Get user
		$results = $this->database->getRows($this->sql['get_items']);

		// Output
		return $results;
	}

	public function addItem($input, $user){
		// Item array
		$item 					= array();
		$item['item_url'] 		= $input['urlR'];
		$item['item_name'] 		= $input['item_nameR'];
		$item['user_id'] 		= $user['user_id'];

		// Insert item
		$this->database->insert('scrape_items', $item);
	}

// End Methods
}





 ?>