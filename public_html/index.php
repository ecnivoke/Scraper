<?php 

// Require files
require_once('../config/config.php');
require_once('../includes/library.php');

// Require classes
require_once('../includes/TemplateHandler.class.php');

$TemplateHandler = new TemplateHandler();

$y = 'yeet';

$x = array();
$x['one'] = 'yeet';
$x['two'] = 'test';
$x['four'] = '4';
$x['five'] = '5';

$TemplateHandler->assign('test', 	$x);
$TemplateHandler->assign('tester', 	$y);

$TemplateHandler->render('home');

 ?>