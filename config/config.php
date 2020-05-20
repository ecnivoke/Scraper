<?php 

// Define version
define('VERSION', 1);

// Define if a developer is working
define('DEVELOP', 1);

// Set error reporting
ini_set('display_errors', DEVELOP);
ini_set('display_startup_errors', DEVELOP);
ini_set("error_reporting", DEVELOP ? E_ALL : DEVELOP);

// Define session time
define('SESSION_TIME', 3600); // 1 Hour

// Set server session time
ini_set('session.gc_maxlifetime', SESSION_TIME);

// Define database configs
define('DATABASE_NAME', 	'scraper');
define('SERVERNAME', 		'localhost');
define('USERNAME', 			'root');
define('PASSWORD', 			'');
define('DATABASE_PREFIX', 	'');

// Define directories
define('SMARTY_DIR', 	'../includes/Smarty/libs/');
define('TEMPLATE_DIR', 	'../public_html/templates/');
define('SCRIPT_DIR', 	'../public_html/scripts/');
define('STYLE_DIR', 	'../public_html/styles/');
define('IMAGE_DIR', 	'../public_html/images/');

 ?>


