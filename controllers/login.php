<?php 

// Password hash testing
$options = array(
	'cost' => 10
);

$x = password_hash("noodle", PASSWORD_ARGON2I, $options);

$y = password_verify('noodle', $x);

echo $x.'<br>';
echo $y;

exit();

// Set page variables
$smarty->assign('title', 'Login');

// Display page
$smarty->display('login.tpl.php');

 ?>