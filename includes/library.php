<?php 

require_once('../includes/Database.class.php');

function initDatabase(){
	// Assemble 
	$conf['servername']		= SERVERNAME;
	$conf['database_name']	= DATABASE_NAME;
	$conf['username']		= USERNAME;
	$conf['password']		= PASSWORD;
	$conf['prefix']			= DATABASE_PREFIX;

	// Create database object
	$database = new Database($conf);

	return $database;
}

function d($debug, $highlight = true, $hidden = false){
	// Highlight debug string
	if($highlight){
		$debug = highlight_string('<?php '.print_r($debug, true).' ?>', true);
		$debug = str_replace(array('&lt;?php&nbsp;','?&gt;'), '', $debug);
	}
	else {
		$debug = print_r($debug, true);
	}

	// Check if debug is hidden
	print($hidden ? "<!--\r\n" : "");

	// Print input
	print("<pre style='text-align: left;'>\r\n");
	print($debug);
	print("</pre>\r\n");

	// Seperate debug call
	print("<hr />\r\n");

	// Check if debug is hidden
	print($hidden ? "-->\r\n" : "");

	// Flush input
	flush();
}

function encryptPassword($pass, $method = PASSWORD_BCRYPT, $options = array('cost' => 10)){
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

function generateToken($length){
	$token = md5(uniqid(rand($length, $length)));
	return $token;
}


 ?>