<?php 

class Session {

// Properties
	
// End Properties

	public function __construct(){
		// Start session
		session_start();
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
		session_regenerate_id(true);
	}
// End Methods

}



 ?>