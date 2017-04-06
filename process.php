<?php

require_once 'core/init.php';

#print_r($_FILES["employee_file"]["name"]); die;

#var_dump($_FILES["employee_file"]["name"]); die;

$file = new Validation;
$file->check($_FILES["employee_file"]["name"]);
$file->tempFile($_FILES["employee_file"]["tmp_name"]);

if($file->passedFile()) {
    
    $content = new Content();
    $content->parse($file->outputTmpFile());

    $filename = $file->getFilename();

    $test = new Export();
    $test->export($filename);


} else {
    echo $file->showErrorCode();
}


?>