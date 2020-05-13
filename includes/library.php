<?php 

function connect(){
	// Define connection
	$conn = '';

	// Try to make connection
	try {
	    $conn = new PDO("mysql:host=".SERVERNAME.";dbname=".DATABASE_NAME, USERNAME, PASSWORD);
	    // Set the PDO error mode to exception
	    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	// Connection failed
	catch(PDOException $e) {
	    echo "Connection failed: " . $e->getMessage();
	}

	// Return connection
	return $conn;
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

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}


 ?>