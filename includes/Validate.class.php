<?php 

class Validate {

// Properties
	private $valid;
	private $messages;
// End Properties

	public function __construct($valid = true, $messages = array()){
		$this->valid 	= $valid;
		$this->messages = $messages;
	}

// Getters

// End Getters

// Setters

// End Setters

// Methods
	public function validate($input){

		// Loop over the input
		foreach($input as $key => $value){
			if($key === 'password'){
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
				$input[$key] = $this->cleanInput($value);
			}
			elseif(1) {
				$this->messages[$key] = 'Missing';
			}
		}

		return [$this->valid, $this->messages];

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