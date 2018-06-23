<?php

/*
 * Name: init.php
 * Descr: 
 */ 

/*
 * Set Basic Config - DB settings
 */
$GLOBALS['config'] = array(
	'mysql'=> array(
		'host' => 'localhost',
		'username' => 'web89_2',
		'password' => 'X8&urjmZCBd7HS2r',
		'db' => 'web89_db2'
	)
);
	
/*
 * load php library -> "require_once" only when needed
 * $db = new DB(); == require_once 'classes/DB.php';
 */	
spl_autoload_register(function($class) {
	require_once 'classes/'	. $class . '.php';
});


?>