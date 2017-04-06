<?php 
 /*
 * Name: DB.php
 * Descr: Database Wrapper - can be used outside
 */
class DB {
	private static $_instance = null;
	private $_pdo, 
			$_query,
			$_error = FALSE,
			$_results,
			$_count = 0; 
			
	/*
	 * Connection
	 * establish a connection and throw error if something went wrong
	 */			
	private function __construct() {
		try {
			$this->_pdo = new PDO('mysql:host='.Config::get('mysql/host').';dbname='.Config::get('mysql/db'),Config::get('mysql/username'),Config::get('mysql/password'));
			//echo "Connected";
		} catch (PDOException $e) {
			die($e->getMessage());	
		}
	}
	
	public static function getInstance() {
		if(!isset(self::$_instance)) {
			self::$_instance = new DB();
		}
		return self::$_instance;
	}
	
	/*
	 * Queries
	 * handle basic queries better
	 */
	public function query($sql, $params = array()) {
	 	$this->_error = FALSE;
		if($this->_query = $this->_pdo->prepare($sql)) {
			//echo "Sucess";
			$x = 1;
			if(count($params)) {
				foreach($params as $param) {
					$this->_query->bindValue($x, $param);
					$x++;
				}
			}
			if($this->_query->execute()) {
				//echo "Sucess";
				$this->_results = $this->_query->fetchAll(PDO::FETCH_OBJ);
				$this->_count = $this->_query->rowCount();
			} else {
				$this->_error = TRUE;
			}
		}
		
		return $this;
	 }

	public function count() {
		return $this->_count;
	}
	
	public function results() {
		return $this->_results;
	}
	
	public function first() {
		return $this->results()[0];
	}	
	 
	public function error() {
		return $this->_error;
	}
}

?>