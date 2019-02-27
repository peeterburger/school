<?php
	// builds a bootstrap-based alert
	function buildAlert($heading, $description, $type) {
		echo "<div class='alert $type' role='alert'><strong>$heading</strong>$description</div>";
	}

	// if POST contains data (happens on login submit), evaluate it
	if(!empty($_POST)){
		$username = $_POST['user'];
		$pass = $_POST['pass'];
        $pass_rep = $_POST['pass_rep'];

		// if the passwords match, check if account already exists
        if($pass == $pass_rep){
			// if the account already exists, throw an alert
            if (file_exists("./users/$username")) {
                buildAlert("Invalid Username!", "Account already exists!", "alert-danger");
            } else {	// else, create it
                $userfile = fopen("./users/$username", "w");
                fwrite($userfile, "$username;$pass");
                fclose($userfile);
            }

			// redirect the user to 'memo.php'
            @header("Location: ./memo.php?user=$username");

        } else {	// else, throw an alert
			buildAlert("Invalid Password!", "Passwords do not match!", "alert-danger");
		}

		// empty POST data
		$_POST = array();
	}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Memo - Registration</title>
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
        <p id='heading' class='text-center'>Notizen - Registration</p>;

		<div class="container-fluid" id="containerForm">
			<div class="col-4" style="float: none; margin: 0 auto;">
                <form method="post">
                    <div class="form-group">
                        <label for="inputUsername">Username:</label>
                        <input type="text" name="user" class="form-control" aria-describedby="emailHelp" placeholder="Enter username...">
                    </div>
                    <div class="form-group">
                        <label for="inputPassword">Password:</label>
                        <input type="password" name="pass" class="form-control" placeholder="Enter password...">
                        <input type="password" name="pass_rep" class="form-control" style="margin-top: 10px;" placeholder="Repeat password...">
                    </div>
                    <br>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Register</button>
                        <button type="button" class="btn btn-secondary" onclick="location.href='./login.php'">Login</button>
                    </div>
                </form>
			</div>
		</div>

		<script src="/resources/js/jquery-3.3.1.js"></script>
		<script src="/resources/js/bootstrap.js"></script>
	</body>
</html>
