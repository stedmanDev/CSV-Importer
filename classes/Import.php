<?php




class Import {

    private $_db = null,
            $_processdata;


    public function __construct() {
	    $this->_db = DB::getInstance();

	}

	public function prepare() {
		#echo "UPDATE sheet_data SET active=0 WHERE active=1";
		if(!$this->_db->query("UPDATE sheet_data SET active=0 WHERE active=1")) {
			throw new Exception("Es gab ein Problem beim erstellen des Accounts.");
		}
	}

    public function create($fields = array()) {
        
		#echo "<pre>";  
		#print_r($fields);

		if(count($fields)) {
			$keys = array_keys($fields);
			$sql= "`".implode('`, `', $keys)."`";	
			$sqlv = "'".implode('\', \'', $fields)."'";
		}
		#echo "INSERT INTO sheet_data(".$sql.") VALUES (".$sqlv.")";
		if(!$this->_db->query("INSERT INTO sheet_data ($sql) VALUES ($sqlv)")) {
			throw new Exception("Es gab ein Problem beim erstellen des Accounts.");
		}

    }


}


?>