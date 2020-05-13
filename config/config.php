<?php 

// Define version
define('VERSION', 1);

// Define if a developer is working
define('DEVELOP', 1);

// Set error reporting
ini_set('display_errors', DEVELOP);
ini_set('display_startup_errors', DEVELOP);
ini_set("error_reporting", DEVELOP ? E_ALL : DEVELOP);

// Define database configs
define('DATABASE_NAME', 	'');
define('SERVERNAME', 		'localhost');
define('USERNAME', 			'root');
define('PASSWORD', 			'');
define('DATABASE_PREFIX', 	'');

 ?>