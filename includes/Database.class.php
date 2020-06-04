<?php 

class Database {

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

		// Build SQL
		$sql = "INSERT INTO ";
		$sql .= '`'.$table.'`';
		$sql .= " VALUES(NULL";

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

		// Prepare SQL query
		$query = $this->connect()->prepare($sql);

		// Execute SQL query
		$query->execute();
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

	public function debug(){
		// Show all sql
		d($this::$sql);
	}
// End methods
}


 ?>