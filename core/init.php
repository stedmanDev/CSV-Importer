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
		'username' => 'root',
		'password' => 'root',
		'db' => 'kinderuni'
	)
);
	
/*
 * load php library -> "require_once" only when needed
 * $db = new DB(); == require_once 'classes/DB.php';
 */	
spl_autoload_register(function($class) {
	require_once 'classes/'	. $class . '.php';
});
