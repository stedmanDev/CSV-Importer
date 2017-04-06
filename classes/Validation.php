<?php 

class Validation {

	private $_passedFile,
			$_error,
			$_data,
			$_filename,
			$_tmpdata,
			$_filetypes,
			$_filetypeLength,
			$_tmpfiletypeLength,
			$_fileExtension,
			$_fileNameLenght,
			$_fileContentArray,
			$_validatedFirstname,
			$_validatedLastname,
			$_validatedSchool,
			$_validatedEmail,
			$_validatedSubscriber,
			$_validatedRegistration,
			$_validatedStringLength,
			$_db = null;

    public function __construct() {
	    $this->_db = DB::getInstance();
		$this->_filetypes = array('csv','txt');
		$this->_filetypeLength = count($this->_filetypes);
		$this->_fileNameLenght = 100;
		$this->_validatedStringLength = 2;
	}

    public function check($file) {
		
		$this->_data = $file;
		$this->_filename = $file;

		if(!empty($this->_data)) {

			if(strlen($this->_data) < ($this->_fileNameLenght)) {

				$this->_fileExtension = pathinfo($this->_data, PATHINFO_EXTENSION);
				
				for($files=0; $files < $this->_filetypeLength; $files++) {
					if (strstr($this->_fileExtension, $this->_filetypes[$files])) {
						$this->_tmpfiletypeLength = $this->_filetypes[$files];
					} 
				}
				if(isset($this->_tmpfiletypeLength)) {
					if($this->_tmpfiletypeLength != '') {
						$this->_passedFile = TRUE;
					}	
				} else {
					$this->_passedFile = FALSE;
					$this->setErrorCode("0");
				}
			} else {
				$this->_passedFile = FALSE;
				$this->setErrorCode("1");
			}
		} else {
			$this->_passedFile = FALSE;
			return $this->setErrorCode("2");
		}
        
    }

	public function checkContent($fileContent) {
		$this->_fileContentArray = $fileContent;

		if(!empty($this->_fileContentArray)) {
			
			$escapeFields = new Sanitize();

			for($numb = 0; $numb < $this->_validatedStringLength; $numb++) {
				$this->_fileContentArray[$numb] = filter_var($this->_fileContentArray[$numb],FILTER_SANITIZE_STRING);
			}

			$this->_validatedFirstname = $escapeFields->escape($this->_fileContentArray[0]);
			$this->_validatedLastname =  $escapeFields->escape($this->_fileContentArray[1]);
			$this->_validatedSchool =  $escapeFields->escape($this->_fileContentArray[2]);
			$this->_validatedEmail = filter_var(trim($this->_fileContentArray[3],FILTER_SANITIZE_EMAIL));
			$this->_validatedSubscriber = filter_var($this->_fileContentArray[4],FILTER_SANITIZE_NUMBER_INT);
			$this->_validatedRegistration = $escapeFields->escape($this->_fileContentArray[5]);

			$csvFields = new Import();
			
			try {
				$csvFields->create(array(
					'firstname' => $this->_validatedFirstname,
					'lastname' => $this->_validatedLastname,
					'school' => $this->_validatedSchool,
					'email' => $this->_validatedEmail,
					'subscriber' => $this->_validatedSubscriber,
					'registration' => $this->getDateForDatabase($this->_validatedRegistration),
					'commit' => $this->getCurrentTime(),
					'active' => '1'
				));
			} catch(exception $e) {
				die($e->getMessage());
			}


		} else {
			$this->_passedFile = FALSE;
			return $this->setErrorCode("3");
		}
		
		
	}

	public function setErrorCode($statusCode) {
		switch ($statusCode) {
			case "0":
				$this->_error = "The filetype is not allowed";
				break;
			case "1":
				$this->_error = "The filelength is not allowed";
				break;
			case "2":
				$this->_error = "The file is empty";
				break;
			case "3":
				$this->_error = "The content is empty";
				break;
			default:
				break;
		}
	}

	function getDateForDatabase(string $date) : string {
		$timestamp = strtotime($date);
		$date_formated = date('Y-m-d H:i:s', $timestamp);
		return $date_formated;
	}

	function getCurrentTime() {
		$currentTimestamp = date('Y-m-d H:i:s');
		return $currentTimestamp;
	}

	function getFilename() {
		return $this->_filename;
	}

	public function showErrorCode() {
		return $this->_error;
	}

	public function passedFile() {
		return $this->_passedFile;
	}

	public function data() {
		return $this->_data;
	}

	public function tempFile($tmpdata) {
		$this->_tmpdata = $tmpdata;
		return $this->_tmpdata;
	}

    public function outputTmpFile() {
        return $this->_tmpdata;
    }

}

?>