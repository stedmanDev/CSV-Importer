<?php
/*
 * Name: index.php
 * Descr: main index file
 */
require_once 'core/init.php';
require_once 'templates/header.php';

echo '

	<h3>CSV Uploader</h3>

	<div class="csvimporter__container">
	
		<form id="upload_csv" class="csvimporter__form box" method="POST" action="" enctype="multipart/form-data" accept-charset="utf-8">  

			<div class="box__container">

				<div class="box__input">
					<input class="box__file" type="file" name="employee_file" id="file" />
					<label for="file"><strong>Choose a file</strong><span class="box__dragndrop"> or drag it here</span>.</label>
					<button class="box__button" type="submit">Upload</button>
				</div>
				
				<div class="box__uploading">
					<object data="images/ripple.svg" type="image/svg+xml" width="100" height="100">
					<!-- Für Browser ohne SVG-Unterstützung -->
					<img src="images/ripple.svg" width="100" height="100" alt="Alternatives PNG-Bild">
					</object>
				</div>

				<ul>
					<li><div class="box__success"><a href="/" class="box__restart" role="button" title="Restart"><i class="fa fa-repeat fa-5x"></i></a></div></li>
					<li><div class="box__error"><a href="/" class="box__restart" role="button" title="Restart"><i class="fa fa-repeat fa-5x"></i></a></div></li>
					<li><div class="box__download"><a href="#" class="box__download--link" title="Download"><i class="fa fa-download fa-5x"></i></a></div></li>
				</ul>
			
			</div>

		</form>  
	
	</div>

	<div class="csvimporter__output">
		
	</div>

';

?>

    <?php require_once 'templates/footer.php'; ?>