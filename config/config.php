<?php 

// Define version
define('VERSION', 1);

// Define developer settings
define('DEVELOP', 		1);
define('DEVELOP_CSRF', 	1); // 0 = developer can bypass CSRF
define('SKIP_SCRAPE', 	0); // 1 = skip scraping items

// Set error reporting
ini_set('display_errors', DEVELOP);
ini_set('display_startup_errors', DEVELOP);
ini_set("error_reporting", DEVELOP ? E_ALL : DEVELOP);

// Define session time
define('SESSION_TIME', 	3600); 		// 3600 => 1 Hour
define('COOKIE_TIME', 	30000000);	// About 1 year

// Set server session time
ini_set('session.cookie_lifetime', COOKIE_TIME);
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
define('INCLUDE_DIR', 	'../includes/librarys/');

 ?>


