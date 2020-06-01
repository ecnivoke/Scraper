<?php 

class Items {

// Properties
	private $sql = array();
	private $database;
	private $limit = 3; // Items per page
	private $item_refresh = 172800; // 2 days until refresh
// End Properties
	public function __construct($database){
		$this->database = $database;
	}
// Getters
	public function getLimit(){
		return $this->limit;
	}
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

	public function saveItemByUser($item, $user){
		// Item array
		$save_item 					= array();
		$save_item['item_id'] 		= $item['item_id'];
		$save_item['user_id'] 		= $user;
		$save_item['item_info'] 	= rtrim(json_encode($item), "\n");
		$save_item['expire_date']	= date('Y:m:d', time() + $this->item_refresh);
		$save_item['expired'] 		= 0;
		$save_item['created'] 		= date('Y:m:d H:i:s');
		$save_item['updated'] 		= date('Y:m:d H:i:s');

		// Insert item
		$this->database->insert('saved_items', $save_item);
	}

	public function getSavedItems($user, $page){
		// Build sql
		$this->sql['get_saved_items'] = "
			SELECT
				saved_items.id,
				saved_items.item_id,
				saved_items.user_id,
				saved_items.item_info,
				saved_items.expire_date,
				saved_items.created,
				saved_items.updated
			FROM 
		";

		if($page != 1){
			// Calculate offset
			$page = $page * $this->limit - $this->limit;

			// Build new sql
			$this->sql['get_saved_items'] .= "
				(SELECT 
					ROW_NUMBER() OVER(ORDER BY saved_items.id) AS row,
					saved_items.id,
					saved_items.item_id,
					saved_items.user_id,
					saved_items.item_info,
					saved_items.expire_date,
					saved_items.created,
					saved_items.updated
				FROM 
					saved_items
				) AS saved_items
				WHERE 1 = 1
					AND ".$page." < row
					AND saved_items.user_id = ".$user."
					AND expired = 0
				ORDER BY 
					saved_items.id
				LIMIT ".$this->limit;
		}
		else {
			$this->sql['get_saved_items'] .= "
					saved_items
				WHERE 1 = 1
					AND saved_items.user_id = ".$user."
					AND expired = 0
				ORDER BY 
					saved_items.id ASC
				LIMIT ".$this->limit;
		}

		// Get items
		$results = $this->database->getRows($this->sql['get_saved_items']);

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
					AND scrape_items.user_id = ".$user."
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

		// Get items
		$results = $this->database->getRows($this->sql['get_items']);

		// Output
		return $results;
	}

	public function getItemByUser($item, $user){
		// Build sql
		$this->sql['get_item_by_user'] = "
			SELECT 
				scrape_items.id,
				scrape_items.item_url,
				scrape_items.item_name,
				scrape_items.user_id,
				scrape_items.status,
				scrape_items.created,
				scrape_items.updated
			FROM 
				scrape_items
			WHERE 1 = 1
				AND scrape_items.id 	 = ".$item."
				AND scrape_items.user_id = ".$user
		;

		// Get items
		$results = $this->database->getRows($this->sql['get_item_by_user']);

		// Output
		return $results;
	}

	public function addItem($input, $user){
		// Item array
		$item 					= array();
		$item['item_url'] 		= $input['urlR'];
		$item['item_name'] 		= $input['item_nameR'];
		$item['user_id'] 		= $user['user_id'];
		$item['status']			= 'a'; // Default: active
		$item['created'] 		= date('Y:m:d');
		$item['updated'] 		= date('Y:m:d');

		// Insert item
		$this->database->insert('scrape_items', $item);
	}

	public function expireSavedItem($id){
		// User array
		$item 				= array();
		$item['expired'] 	= 1;

		$this->database->update('saved_items', $item, ['id = '.$id]);
	}

// End Methods
}





 ?>