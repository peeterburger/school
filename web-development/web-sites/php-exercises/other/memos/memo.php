<?php
	$username;
	$lastModifiedDate;
	$filePath;
	$fileContent;

	// returns the username from the current session
	function getUserName() {
		global $username;
		return $username;
	}

	// returns the last modified date form the current memo
	function getLastModified() {
		global $filePath;
		return date('D, d M Y H:i:s', filemtime($filePath));
	}

	// returns the content of the current memo
	function getFileContent() {
		global $filePath;
		return file_get_contents($filePath);
	}

	// builds a bootstrap-based alert
	function buildAlert($heading, $description, $type){
		echo "<div class='alert $type' role='alert'><strong>$heading</strong>$description</div>";
	}

	// check for url parameters
	if(isset($_GET['user'])){	// on user passed in url, open up memo for the curresponding user
		$username = $_GET['user'];
		$filePath = "./usermemos/$username";
		if(isset($_POST['txtNotiz'])){	// on change submit, update current memo
			file_put_contents($filePath, $_POST['txtNotiz']);
		}
	} else {	// if no parameter passed in the url
		die("Error! No Username passed in the URI");
	}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Memo</title>
		<meta charset="utf8">

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

		<link rel="stylesheet" type="text/css" href="/resources/css/bootstrap.css"/>
	</head>

	<body>
		<p id='heading' class='text-center'>Hello, <?php echo getUserName(); ?>!</p>

		<div class="container-fluid" id="containerForm">
			<div class="col-6" style="float: none; margin: 0 auto;">
				<form method="post">
					<div class="md-form mb-4 pink-textarea active-pink-textarea">
						<label>Current Memo:</label>
				    	<textarea name="txtNotiz" class="md-textarea form-control" rows="10" placeholder="Write something..."><?php echo getFileContent(); ?></textarea>
				  	</div>
					<label>Last Modified: <?php echo getLastModified(); ?></label>
					<br><br>
					<button name="btnSubmit" type="submit" class="btn btn-primary">Save</button>
				</form>
			</div>
		</div>

		<script src="/resources/js/jquery-3.3.1.js"></script>
		<script src="/resources/js/bootstrap.js"></script>
	</body>
</html>
