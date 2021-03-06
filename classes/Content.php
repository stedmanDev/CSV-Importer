<?php




class Content {

    private $_db = null,
            $_fileData,
            $_csvData,
            $_parsedData,
            $_splitData,
            $_csvArray,
            $_vfirstname,
            $_csvDuplicates;


    public function __construct() {
	    $this->_db = DB::getInstance();

	}


    public function parse($checkedfile) {

        $this->_csvData = $checkedfile;

        $r = array_map('str_getcsv', file($this->_csvData));
        foreach( $r as $k => $d ) { 

            if(isset($r[$k][1])) {
               $combine_two_values = $r[$k][0].$r[$k][1];
               $r[$k][0] = $combine_two_values;
               unset($r[$k][1]); 
            }

            if(count($r[0]) == count($r[$k] )){
                $r[$k] = array_combine($r[0], $r[$k]);
            }
        }

        $this->_parsedData = array_values(array_slice($r,1));

        return $this->test($this->_parsedData);

    }

    public function test($tmp) {

        $validateContent = new Validation();
        $sanitizeContent = new Sanitize();

        $index = 0;
        $prepareDataArray = array();
        while(array_key_exists($index, $tmp)) {
            
            $this->_splitData = implode(';',$tmp[$index]);
            array_push($prepareDataArray, $this->_splitData);
            $index++;
        } 
 
        $prepareDataArray = array_unique($prepareDataArray); 

        $duplicatesNameArray = array();
        $duplicatesFamilyArray = array();

        foreach($prepareDataArray as $k=>$v)
        {
            list($name,$family) = explode(';', $v);
            if( isset($temp[$name.$family]) ) {
                array_push($duplicatesNameArray,$sanitizeContent->escape($name));
                array_push($duplicatesFamilyArray,$sanitizeContent->escape($family));
                unset($prepareDataArray[$k]);
            } else {
                $temp[$name.$family] = true;
            }
        }

        if(!empty($duplicatesNameArray)) {
            $this->_csvDuplicates = array_combine($duplicatesNameArray,$duplicatesFamilyArray);
        }else {
            $this->_csvDuplicates = 'empty';
        }

        $tarray = array_values($prepareDataArray);

        $test = (count(array_keys($tarray)));
    
        $csvFields = new Import();
        $csvFields->prepare();

        for($numb = 0; $numb < $test; $numb++) {
            $this->_csvArray = explode(";",$tarray[$numb]);
            $validateContent->checkContent($this->_csvArray);
        }

    }

    public function csvdata() {
        return $this->_csvData;
    }

    public function duplicates() {
        return $this->_csvDuplicates;
    }

}


?>