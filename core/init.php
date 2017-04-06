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
		'host' => '127.0.0.1',
		'username' => 'root',
		'password' => '',
		'db' => 'csv_import'
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