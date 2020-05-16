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
		    echo "Connection failed: " . $e->getMessage();
		    $this->messages['connection'] = 0;
		}

		// Return connection
		return $conn;
	}

	public function getRows($sql){

		// Prepare SQL query
		$query = $this->connect()->prepare($sql);

		// Execute SQL query
		$query->execute();

		// Fetch results
		$results = $query->fetchAll();

		// Output
		return $results;
	}

	public function insert($table, $values){

		// Build SQL
		$sql = "INSERT INTO ";
		$sql .= '`'.$table.'`';
		$sql .= " VALUES(NULL";

		// Set values
		foreach($values as $value){
			// Check for int
			if(is_numeric($value)){
				$sql .= ",".$value;
			}
			else {
				$sql .= ",'".$value."'";
			}
		}

		// End of sql
		$sql .= ");";

		// Prepare SQL query
		$query = $this->connect()->prepare($sql);

		// Execute SQL query
		$query->execute();
	}

	public function createUser($input){
		// Set error to empty
		$error = '';

		// Check for duplicate username
		$duplicate = $this->getRows("
			SELECT 
				users.username
			FROM
				users 
			WHERE 
				users.username = '".$input['usernameR']."'
			LIMIT 1
		");

		// Create user
		if(empty($duplicate)){
			// Encrypt password
			$password = $this->encryptPassword($input['passwordR']);

			// User array
			$user 				= array();
			$user['username'] 	= $input['usernameR'];
			$user['password'] 	= $password;

			// Insert user
			$this->insert('users', $user);
		}
		else {
			// Set error message
			$error = 'Username already exists';
		}

		// Output
		return $error;
	}

	private function encryptPassword($pass, $method = PASSWORD_BCRYPT, $options = array('cost' => 10)){
		// Hash password 
		/*
		PASSWORD_BCRYPT <- standard
		PASSWORD_ARGON2I
		PASSWORD_ARGON2ID
		PASSWORD_DEFAULT
		*/
		$password = password_hash($pass, $method, $options);

		return $password;
	}

	public function test(){
		echo "database yeet";
	}
// End methods
}


 ?>