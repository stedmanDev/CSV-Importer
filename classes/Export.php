<?php




class Export {

    private $_db = null,
            $_processdata,
			$_filename,
			$_evenTitle;


    public function __construct() {
	    $this->_db = DB::getInstance();

	}


    public function export($filename,$duplicates) {

		$this->_filename = $filename;
		$eventName = $this->setEventTitle($this->_filename);

		$resultsDB = $this->_db->query("SELECT * from sheet_data WHERE active=1 ORDER BY lastname ASC, firstname ASC");  

		if($resultsDB->count()) {
			
			header('Content-Encoding: UTF-8');
			header("Content-Type: text/html; charset=UTF-8");

			$output = fopen("php://output", "w") or die('Cannot open the file'); 
			
			fputcsv($output, array('Veranstaltung:')); 
			fputcsv($output, array($eventName)); 
			fputcsv($output, array(''),';','"'); 	

			fputcsv($output, array('Nachname','Vorname','Schule','E-Mail','Anzahl','Anmeldung vom'),';','"'); 
			
			$result = 0;

			foreach($resultsDB->results() as $resultCSV) {

				$result += $resultCSV->subscriber;

				fputcsv($output, array(	utf8_encode($resultCSV->lastname),
										utf8_encode($resultCSV->firstname),
										utf8_encode($resultCSV->school),
										$resultCSV->email,
										$resultCSV->subscriber,
										$resultCSV->registration),';','"');	
			}

			fputcsv($output, array(''),';','"'); 	
			fputcsv($output, array('Teilnehmer'),';','"'); 
			fputcsv($output, array($result)); 

			if($duplicates != 'empty') {
				fputcsv($output, array(''),';','"'); 	
				fputcsv($output, array('Doppelter Nachname','Doppelter Vorname'),';','"'); 

				foreach($duplicates as $firstname => $lastname) {
					fputcsv($output, array( utf8_encode($lastname),
											utf8_encode($firstname)),';','"'); 
				}
			}

			fputcsv($output, array('Dateiname:'.$this->_filename)); 
			fclose($output);  

		}

    }

	public function setEventTitle($title) {
		$title = str_replace('KinderUni___','', $title);
		$title = str_replace('KinderUni_','', $title);
		$title = str_replace('__',' - ', $title);
		$title = str_replace('_',' ', $title);
		$title = str_replace('.csv','', $title);
		$this->_evenTitle = trim($title);
		return $this->_evenTitle;
	}

}


?>