<?php 

class Session {

// Properties
	private $remember_time;
	private $cookie_time; // About 1 year
// End Properties

	public function __construct(){

		$this->remember_time = SESSION_TIME;
		$this->cookie_time   = COOKIE_TIME;

		if(session_id() !== null){
			// Set client session id timer
			session_set_cookie_params($this->remember_time);
			
			// Start session
			session_start();
		}
	}

// Getters
	public function getVar($name){
		// Declare variable
		$output = '';

		if(!empty($_SESSION[$name]) && $name !== 'csrf_token'){
			$output = $_SESSION[$name];
		}
		elseif(!empty($_COOKIE[$name])){
			$output = $_COOKIE[$name];
		}

		// Output
		return $output;
	}

	public function checkCookie($name){
		// Declade variable
		$output = true;

		// Check if cookie exists
		if(!isset($_COOKIE[$name])){
			$output = false;
		}

		// Output
		return $output;
	}

	public function getCookieExpireTime(){
		return $this->cookie_time;
	}
// End Getters

// Setters
	public function setVar($name, $value){
		$_SESSION[$name] = $value;
	}

	public function unsetVar($name){
		unset($_SESSION[$name]);
	}

	public function setCookie($name, $value){
		setcookie($name, $value, time() + $this->cookie_time);
	}

	public function unsetCookie($name){
		if($name == 'AUTH'){
			$this->unsetCookie('username');
			$this->unsetCookie('random_password');
			$this->unsetCookie('random_selector');
		}
		else {
			setcookie($name, '', time() - $this->cookie_time);
		}
	}
// End Setters

// Methods
	public function kill(){
		// Delete cookies
		$this->unsetCookie('AUTH');
		$this->unsetCookie("csrf_token");

		// Sleep script to ensure that the cookies will be remove
		// Not sure if its normal for cookies to take some time to delete
		// But without this line the user will log right back
		sleep(2);

		// Kill session
		session_unset();
		session_destroy();
		session_write_close();
		setcookie(session_name(),'',0,'/');
		// session_regenerate_id(true);
	}

	public function login($user){
		// Store variable
		$this->setVar('user_id', 	$user['user_id']);
		$this->setVar('username', 	$user['username']);
		$this->setVar('email', 		$user['email']);
		$this->setVar('user_group', $user['user_group']);
	}

	public function loginAsUser($user){
		// Store variable
		$this->setVar('fake_login',	true);
		$this->setVar('_user_id', 	$this->getVar('user_id'));

		$this->login($user);
	}

	public function logoutAsUser($user){
		// Store variable
		$this->setVar('fake_login',	true);
		$this->setVar('_user_id', 	$this->getVar('user_id'));

		$this->login($user);
	}

	public function setCSRFToken(){
		// Generate token
		$token = generateToken(30);

		// Store token
		$this->setVar('csrf_token', 	$token);
		$this->setCookie('csrf_token', 	$token);
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
			$result["user_id"] 		= $this->getVar('user_id');
			$result["username"] 	= $this->getVar('username');
			$result["email"] 		= $this->getVar('email');
			$result["user_group"] 	= $this->getVar('user_group');
		}

		// Output
		return $result;
	}

	public function logged_in(){
		// Check if user is logged in
		if(isset($_SESSION['user_id'])){
			$result = true;
		}
		else {
			$result = false;
		}

		// Output
		return $result;
	}
// End Methods

}



 ?>