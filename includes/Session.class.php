<?php 

class Session {

// Properties
	
// End Properties

	public function __construct(){

	}

// Getters
	public function getVar($name){
		return $_SESSION[$name];
	}
// End Getters

// Setters
	public function setVar($name, $value){
		$_SESSION[$name] = $value;
	}

	public function unsetVar($name){
		unset($_SESSION[$name]);
	}
// End Setters

// Methods
	public function kill(){
		// Kill session
		session_unset();
		session_destroy();
		session_write_close();
		setcookie(session_name(),'',0,'/');
		// session_regenerate_id(true);
	}

	public function login($user){
		$this->setVar('user_id', 	$user['id']);
		$this->setVar('username', 	$user['username']);
	}

	public function getUser($item = ''){
		// Declade variables
		$result = array();

		// Set output to only requested $item
		if(!empty($item)){
			$result[$item] = $this->getVar($item);
		}
		else {
			// Set output to everything
			$result["user_id"] 	= $this->getVar('user_id');
			$result["username"] = $this->getVar('username');
		}

		// Output
		return $result;
	}

	// public function logout(){ // Not working, not used
	// 	$this->unsetVar($user['id']);
	// 	$this->unsetVar($user['username']);
	// }

	public function logged_in(){
		if(isset($_SESSION['user_id'])){
			$result = true;
		}
		else {
			$result = false;
		}
		return $result;
	}
// End Methods

}



 ?>