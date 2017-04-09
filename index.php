<?php
/*
 * Name: index.php
 * Descr: main index file
 */
require_once 'core/init.php';
require_once 'templates/header.php';

echo '
	<h2 align="center">Import CSV File</h2>  
	
	<div class="csvimporter__container">
	
		<form id="upload_csv" class="csvimporter__form box" method="POST" action="" enctype="multipart/form-data" accept-charset="utf-8">  

			<div class="box__input">
				<input class="box__file" type="file" name="employee_file" id="file" />
				<label for="file"><strong>Choose a file</strong><span class="box__dragndrop"> or drag it here</span>.</label>
				<button class="box__button" type="submit">Upload</button>
			</div>
			
			<div class="box__uploading">Uploading&hellip;</div>
			<div class="box__success">Done!<a href="/" class="box__restart" role="button">Upload more?</a></div>
			<div class="box__error">Done! <span></span>. <a href="/" class="box__restart" role="button">Upload more?</a></div>

			<div class="button__download">
				<a href="#" class="button__download--link">download</a>
			</div>

		</form>  
	
	</div>


	<div class="csvimporter__output">
		
	</div>



';

?>

    <?php require_once 'templates/footer.php'; ?>