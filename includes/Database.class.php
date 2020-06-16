<?php 

class Database extends ORM {

// Properties
	private $connection;
	private $servername;
	private $database_name;
	private $username;
	private $password;
	private $prefix;
	public 	$messages = array();

	protected static $sql = array();
// End Properties

	public function __construct($conf){

		$this->servername 		= $conf['servername'];
		$this->database_name 	= $conf['database_name'];
		$this->username 		= $conf['username'];
		$this->password 		= $conf['password'];
		$this->prefix			= $conf['prefix'];
		$this->connection 		= $this->connect();	
	}
// Getters
	public function getPrefix(){
		return $this->prefix;
	}
// End Getters
// Setters
// End Setters
// Methods
	private function connect(){
		// Define connection
		$conn = '';

		// Make connection
		try {
		    $conn = new PDO("mysql:host=".$this->servername.";dbname=".$this->database_name, $this->username, $this->password);
		    // Set the PDO error mode to exception
		    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		    // Set success message
		    $this->messages['connection'] = 1;
		}
		// Connection failed
		catch(PDOException $e) {
		    $this->messages['connection_error'] = $e->getMessage();
		    $this->messages['connection'] = 0;
		}

		// Return connection
		return $conn;
	}

	/*
	* 	For this function the first column of the table has to be primary auto-increment key
	*/
	public function getRows($sql){
		// Push sql to debug
		$this::$sql[] = $sql;

		// Prepare SQL query
		$query = $this->connect()->prepare($sql);

		// Execute SQL query
		$query->execute();

		// Fetch results
		$results = $query->fetchAll();

		// Output
		return $results;
	}

/*
	* 	For this function the first column of the table has to be primary auto-increment key
	* 	Expected input:
	* 
	* 	insert('table_name', 
	*			array('column_name' => 'value')
	*	);
*/
	public function insert($table, $values){

		// See if table exists
		$table_exists = $this->checkTable($table);
		if($table_exists){

			// Build SQL
			$sql = "INSERT INTO ";
			$sql .= '`'.$table.'`(`id`';
			foreach($values as $key => $value){
				$sql .= ',`'.$key.'`';
			}
			$sql .= ") VALUES(NULL";

			// Set values
			foreach($values as $value){
				// Check for interger
				if(is_numeric($value)){
					$sql .= ",".$value;
				}
				else {
					$sql .= ",'".$value."'";
				}
			}

			// End of sql
			$sql .= ");";

			// Push sql to debug
			$this::$sql[] = $sql;

			try {
				// Prepare SQL query
				$query = $this->connect()->prepare($sql);

				// Execute SQL query
				$query->execute();
			}
			// Missing table
			catch(Exception $e){
				// Get Exception message
				$msg = $e->getMessage();
				
				if(CREATE_COLUMNS){
					// Explode string to get column name
					$col = explode('Unknown column \'', $msg);
					$col = explode('\'', $col[1])[0];

					// Build column
					$this->buildColumn($table, $col, $values);
				}
				elseif(DEVELOP){
					d($msg.' <- IGNORED');
				}
			}
		}
		elseif(CREATE_TABLES) {
			$this->buildTable($table, $values);
		}	
	}

/*
	* 	Expected input: 
	*
	* 	update('table_name',
	*			array('column_name' => 'new_column_value'),
	*			array('column_name = column_value')
	*	);
*/
	public function update($table, $values, $where = ''){

		// Build SQL
		$sql  = "UPDATE";
		$sql .= ' `'.$table.'` ';
		$sql .= "SET ";

		$last = end($values);

		// Set values
		foreach($values as $key => $value){
			// Check for interger
			if(is_numeric($value)){
				$sql .= "`".$key."` = ".$value;
			}
			else {
				$sql .= "`".$key."` = '".$value."'";
			}
			if($value !== $last) $sql.= ", ";
		}

		// Build where clause
		$sql .= " WHERE 1 = 1";
		foreach($where as $clause){
			$sql .= " AND ".$clause;
		}

		// Push sql to debug
		$this::$sql[] = $sql;

		// Prepare SQL query
		$query = $this->connect()->prepare($sql);

		// Execute SQL query
		$query->execute();
	}

	protected function executeBuild($sql, $alter = ''){
		// Push sql to debug
		$this::$sql[] = $sql;

		// Prepare SQL query
		$query = $this->connect()->prepare($sql);

		// Execute SQL query
		$query->execute();

		if(!empty($alter)){
			// Push sql to debug
			$this::$sql[] = $alter;

			// Prepare SQL query
			$query = $this->connect()->prepare($alter);

			// Execute SQL query
			$query->execute();
		}
		
	}

	public function debug(){
		// Show all sql
		d($this::$sql);
	}
// End methods
}


 ?>