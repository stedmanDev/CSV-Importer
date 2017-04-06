<?php
/*
 * Name: sanitize.php
 * Descr: Santisize input Data htmlentities
 */

class Sanitize {
	public function escape($string) {
		$string = str_replace('"', '', $string);
		$string = str_replace(',', ' ', $string);
		$string = str_replace('- ', '-', $string);
		$string = str_replace('&#34;', '', $string);
		$string = str_replace('- ', '-', ucwords(str_replace('-', '- ', strtolower($string))));
		$string = strip_tags($string);
		return trim($string);
	}

}


?>