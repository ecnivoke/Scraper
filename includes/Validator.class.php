<?php 

class Validator {

// Properties
	private $input 		= array();
	private $valid 		= true;
	private $messages 	= array();
	private $csrf_token = '';
// End Properties

	public function __construct($input, $csrf_token = ''){

		$this->input 		= $input;
		$this->csrf_token 	= $csrf_token;
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
		
		// Check CSRF token
		if($this->csrf_token === $this->input['csrf_token'] || DEVELOP_CSRF === 0){
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
		else {
			// Token mismatch
			$this->valid = false;
			$this->messages['csrf'] = 'Token mismatch!';
		}
	}

	public function isValidURL($input){
		$url = $this->input[$input];

		// Validate
		$valid = filter_var($url, FILTER_VALIDATE_URL);

		// Set error message
		if($valid === false) $this->messages[$input] = 'Not a valid URL';

		// Output
		return $valid;
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