<?php
    $cookie_username = "";
    $cookie_pass = "";

    // builds a bootstrap-based alert
    function buildAlert($heading, $description, $type) {
        echo "<div class='alert $type' role='alert'><strong>$heading</strong>$description</div>";
    }

    // if the 'login_data' cookie is set, load its containing information
    if (isset($_COOKIE["login_data"])) {
        $cookie_username = explode(";", $_COOKIE["login_data"])[0];
        $cookie_pass = explode(";", $_COOKIE["login_data"])[1];
    }

    // if POST contains data (happens on login submit), evaluate it
    if (!empty($_POST)) {
        $username = $_POST['user'];
        $pass = $_POST['pass'];

        // check if the user is already registrated
        if (file_exists("./users/$username")) { // if so, open user file
            $userfile = fopen("./users/$username", "r");
            $line = fgets($userfile);

            $file_username = explode(";", $line)[0];
            $file_pass = explode(";", $line)[1];

            // check if the passwords are correct
            if (!($file_pass == $pass)) {
                buildAlert("Invalid Password!", "The password for this username is incorrect!", "alert-danger");
            }
        } else {    // if not, the user is not registrated
            buildAlert("Invalid Username!", "Your username is not registrated!", "alert-danger");
        }

        // check if the user checked the 'remember'-check
        if (isset($_POST['remember'])) {
            setcookie("login_data", "$username;$pass", time() + 3600, './');
        } else {
            // if 'login_data' cookie is set, but 'remember' is unset, delete coockie
            if (isset($_COOKIE["login_data"])) {
                unset($_COOKIE["login_data"]);
            }
        }

        // redirect user to memo.php. Surpresses warnings
        @header("Location: ./memo.php?user=$username");
        $_POST = array();   // empty POST data
    }
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Memo - Login</title>
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
        <p id='heading' class='text-center'>Memo - Login</p>;

		<div class="container-fluid" id="containerForm">
			<div class="col-4" style="float: none; margin: 0 auto;">
                <form method="post">
                    <div class="form-group">
                        <label for="inputUsername">User:</label>
                        <input type="text" name="user" class="form-control" aria-describedby="emailHelp" placeholder="Enter username..." value="<?php echo $cookie_username?>">
                    </div>
                    <div class="form-group">
                        <label for="inputPassword">Password:</label>
                        <input type="password" name="pass" class="form-control" placeholder="Enter password..." value="<?php echo $cookie_pass?>">
                    </div>
                    <div class="form-check">
                        <input type="checkbox" name="remember" class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1">Save login data</label>
                    </div>
                    <br>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Login</button>
						<button type="button" class="btn btn-secondary" onclick="location.href='./register.php'">Register</button>
                    </div>
                </form>
			</div>
		</div>

		<script src="/resources/js/jquery-3.3.1.js"></script>
		<script src="/resources/js/bootstrap.js"></script>
	</body>
</html>
