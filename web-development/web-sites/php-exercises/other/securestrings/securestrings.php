<?php
	// and array containing all words that are encrypted/decrypted in the process
	$securePhrases = array(
		"Baumhaus" => "Montag",
		"Ventilator" => "Dienstag",
		"Unterricht" => "Mittwoch",
		"Behördenwegweiser" => "Donnerstag",
		"Fahrradschloss" => "Freitag",
		"Kettenschaltung" => "Samstag",
		"Montag" => "Sonntag",
		"Freunde" => "Wirtschaftsinformatik",
		"Brezeln" => "Deutsch",
		"Kaugummi" => "Mathematik",
	);

	// determines, whether the current option is encryption (0) or decryption (1)
	$currentOption = 0;

	// returns the current option in a string format
	function currentOptionAsString(){
		global $currentOption;

		if($currentOption == 0){
			return "encrypt";
		}else{
			return "decrypt";
		}
	}

	// returns, whether the button on 'index' should be in active style (bootstrap)
	function btnState ($index) {
		global $currentOption;

		if($index == $currentOption){
			return "active";
		} else {
			return "";
		}
	}

	// prints the current encrpyted/decrypted string
	function printEncDecData() {
		global $securePhrases, $currentOption;

		// if POST contains data, encrypt/decrypt it (depends on 'currentOption')
		if(isset($_POST['data'])){
			$encdata = $_POST['data'];

			if($currentOption == 0){
				// encrypt
				return str_replace(array_keys($securePhrases), array_values($securePhrases), $encdata);
			}else{
				// decrypt
				return str_replace(array_values($securePhrases), array_keys($securePhrases), $encdata);
			}
		} else {	// else, return empty string
			return "";
		}
	}

	// determines the current option by evaluating the 'type' parameter
	if(isset($_GET['type'])){
		if($_GET['type'] == "enc"){
			$currentOption = 0;
		}else{
			$currentOption = 1;
		}
	}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Secure Strings</title>
		<meta charset="utf8">

		<style>
			* {
				padding: 0px;
				margin: 0px;
			}
			<style>
				* {
					padding: 0px;
					margin: 0px;
				}
				#heading {
					margin-top: 100px;
					font-size: 30px;
				}
				#containerForm {
					margin-top: 100px;
				}
			</style>
		</style>

		<link rel="stylesheet" type="text/css" href="/resources/css/bootstrap.css"/>
	</head>

	<body>
		<p id='heading' class='text-center'>Secure Strings</p>

		<div class="container-fluid" id="containerForm">
			<div class="col-6" style="float: none; margin: 0 auto; margin-top: 100px;">
				<form method="set">
					<div class="btn-group" role="group" aria-label="Basic example">
					  <button id="btnEnc" name="type" type="submit" value="enc" class="btn btn-secondary <?php echo btnState(0); ?>">Encrypt</button>
					  <button id="btnDec" name="type" type="submit" value="dec" class="btn btn-secondary <?php echo btnState(1); ?>">Decrypt</button>
					</div>
				</form>
			</div>
		</div>

		<div class="container-fluid">
			<div class="col-6" style="float: none; margin: 0 auto; margin-top: 40px;">
				<form method="post">
					<div class="md-form mb-4 pink-textarea active-pink-textarea">
						<textarea id="txtData" name="data" type="text" id="form18" class="md-textarea form-control" rows="8" placeholder="Text to <?php echo currentOptionAsString(); ?>..."></textarea>
					</div>
					<button id="btnSubmit" name="btnSubmit" type="submit" class="btn btn-primary"><?php echo currentOptionAsString(); ?></button>
				</form>
			</div>
		</div>

		<div class="container-fluid">
			<div class="col-6" style="float: none; margin: 0 auto; margin-top: 40px;">
				<p class='text-left'><?php echo printEncDecData(); ?></p>
			</div>
		</div>

		<script src="/resources/js/jquery-3.3.1.js"></script>
		<script src="/resources/js/bootstrap.js"></script>
	</body>
</html>
