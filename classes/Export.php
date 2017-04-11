<?php




class Export {

    private $_db = null,
            $_processdata,
			$_filename;


    public function __construct() {
	    $this->_db = DB::getInstance();

	}


    public function export($filename) {

		$resultsDB = $this->_db->query("SELECT * from sheet_data WHERE active=1 ORDER BY lastname ASC, firstname ASC");  
		
		if($resultsDB->count()) {
			
			header('Content-Encoding: UTF-8');
			header("Content-Type: text/html; charset=UTF-8");

			$output = fopen("php://output", "w") or die('Cannot open the file'); 
			fputcsv($output, array('Nachname','Vorname','Schule','E-Mail','Anzahl','Anmeldung vom'),';','"'); 
			
			foreach($resultsDB->results() as $resultCSV) {
				fputcsv($output, array(	utf8_encode($resultCSV->lastname),
										utf8_encode($resultCSV->firstname),
										utf8_encode($resultCSV->school),
										$resultCSV->email,
										$resultCSV->subscriber,
										$resultCSV->registration),';','"');	
			}
			fputcsv($output, array('Dateiname:'.$filename)); 
			fclose($output);  

		}

    }

}


?>