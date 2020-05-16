<?php 

class Validator {

// Properties
	private $input;
	private $valid;
	private $messages;
// End Properties

	public function __construct($input, $valid = true, $messages = array()){
		$this->input 	= $input;
		$this->valid 	= $valid;
		$this->messages = $messages;
	}

// Getters
	public function getValid(){
		return $this->valid;
	}

	public function getInput(){
		return $this->input;
	}

	public function getMessages(){
		return $this->messages;
	}
// End Getters

// Setters

// End Setters

// Methods
	public function validate(){

		// Loop over the input
		foreach($this->input as $key => $value){
			if($key === 'password' && !empty($value)){
				// Validate password strength
				$uppercase		= preg_match('@[A-Z]@', $value);
				$lowercase		= preg_match('@[a-z]@', $value);
				$number			= preg_match('@[0-9]@', $value);
				$specialChars	= preg_match('@[^\w]@', $value);

				if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8){
					$this->messages['password_error'] = 'Password is missing Uppercase, Lowercase, Number, Special character or is too short.';
				}
			}
			if(!empty($value)){
				// Clean input
				$this->input[$key] = $this->cleanInput($value);
			}
			elseif(substr($key, strlen($key)-1) === 'R') {
				$this->valid = false;
				$this->messages[$key] = $key.' Missing';
			}
		}
	}

	public function cleanInput($input) {
		$input = trim($input);
		$input = stripslashes($input);
		$input = htmlspecialchars($input);
		return $input;
	}

// End Methods

}



 ?>