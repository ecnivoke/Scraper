<?php 

class Users {

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
	public function getAllUsers(){
		// Build sql
		$this->sql['get_all_users'] = "SELECT
			users.id,
			users.username,
			users.password,
			users.email,
			users.status,
			user_groups.role AS user_group
		FROM 
			users,
			user_groups
		WHERE 1 = 1
			AND users.user_group_id = user_groups.id
		ORDER BY 
			users.id ASC";

		// Get user
		$results = $this->database->getRows($this->sql['get_all_users']);

		// Output
		return $results;
	}

	public function getUser($username){
		// Build sql
		$this->sql['get_user'] = "SELECT
			users.id,
			users.username,
			users.password,
			users.email,
			users.status,
			user_groups.role AS user_group
		FROM 
			users,
			user_groups
		WHERE 1 = 1
			AND (users.username 		= '".$username."'
			OR 	 users.email 			= '".$username."')
			AND users.user_group_id 	= user_groups.id";

		// Get user
		$results = $this->database->getRows($this->sql['get_user']);

		// Output
		return $results;
	}

	public function getUserById($id){
		// Build sql
		$this->sql['get_user'] = "SELECT
			users.id,
			users.username,
			users.password,
			users.email,
			users.status,
			user_groups.role AS user_group
		FROM 
			users,
			user_groups
		WHERE 1 = 1
			AND users.id 				= ".$id."
			AND users.user_group_id 	= user_groups.id";

		// Get user
		$results = $this->database->getRows($this->sql['get_user']);

		// Output
		return $results;
	}

	public function createUser($input){
		// Set error to empty
		$error = '';

		// Check for duplicate username
		$duplicate = $this->database->getRows("
			SELECT 
				users.username
			FROM
				users 
			WHERE 1 = 1
				AND users.username = '".$input['usernameR']."'
			LIMIT 1
		");

		// Create user
		if(empty($duplicate)){
			// Encrypt password
			$password = $this->encryptPassword($input['passwordR']);

			// User array
			$user 					= array();
			$user['username'] 		= $input['usernameR'];
			$user['password'] 		= $password;
			$user['email'] 			= $input['emailR'];
			$user['user_group_id'] 	= !empty($input['user_group']) ? $input['user_group'] : 3; // Default: default user
			$user['status'] 		= 'a'; // Default: active

			// Insert user
			$this->database->insert('users', $user);
		}
		else {
			// Set error message
			$error = 'Username already exists!';
		}

		// Output
		return $error;
	}

	private function encryptPassword($pass, $method = PASSWORD_BCRYPT, $options = array('cost' => 10)){
		// Hash password 
		/*
		PASSWORD_BCRYPT <- current strongest
		PASSWORD_ARGON2I
		PASSWORD_ARGON2ID
		PASSWORD_DEFAULT
		*/
		$password = password_hash($pass, $method, $options);

		// Output
		return $password;
	}

// End Methods
}





 ?>