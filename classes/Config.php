<?php

 /*
 * Name: Config.php
 * Descr: Get Access to all config values from $GLOBALS['config'] Array (init.php) 
 * echo Config::get('mysql/host'); // '127.0.0.1' (index.php)
 */
 
class Config {
	public static function get($path = null) {
		if($path) {
			$config = $GLOBALS['config'];
			$path = explode('/', $path);
			
			// does mysql exist in config
			foreach ($path as $bit) {			
				// set config to mysql
				if(isset($config[$bit])) {
					// does host exist in config
					$config = $config[$bit];
				}
			}
			// return the value
			return $config;
		}
		return false;
	}
}

?>