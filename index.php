<?php
/*
 * Name: index.php
 * Descr: main index file
 */
require_once 'core/init.php';
require_once 'templates/header.php';

/*
$users = DB::getInstance()->query("SELECT * FROM sheet_data");

if(!$users->count()) {
	echo "no user";
} else {
	//echo "ok";
	foreach ($users->results() as $user) {
		echo $user->firstname;
	}
}

//echo phpinfo();	

*/

echo '
	<h2 align="center">Import CSV File Data</h2>  
	<h3 align="center">Employee Data</h3>

	<div class="csvimporter__container">
	
		<form id="upload_csv" class="csvimporter__form" method="POST" enctype="multipart/form-data" accept-charset="utf-8">  

			<div class="csvimporter__file">  
				<input type="file" name="employee_file" />  
			</div>  

			<div class="csvimporter__submit">  
				<input type="submit" name="upload" id="upload" value="Upload" class="btn btn-info" />  
			</div> 

		</form>  
	
	</div>


	<div class="csvimporter__output">
		
	</div>

	<div class="button__download">
		<a href="#" class="button__download--link">download</a>
	</div>

';

?>

<?php require_once 'templates/footer.php'; ?>