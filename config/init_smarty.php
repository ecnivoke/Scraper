<?php 

// Include smarty
require(SMARTY_DIR.'Smarty.class.php');

// Init smarty
$smarty = new Smarty(); // SmartyBC for {php}{/php}

// Set smarty variable
$smarty->template_dir 	= TEMPLATE_DIR;
$smarty->compile_dir  	= '../_cache';
$smarty->config_dir   	= '../configs/';
$smarty->cache_dir    	= '../_cache';


 ?>