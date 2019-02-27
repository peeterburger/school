<?php
	class Mannschaft {
		private $mannschaft = array();
	}

    class Spieler {
        private $name;
    }

    class Goalie extends Spieler{
        private $koerperGroesse;
    }

    class Angreifer extends Spieler{
        public function jogTraining() {
            return "Jog Training wird ausgeführt";
        }
    }

    class Verteidiger extends Spieler { }
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Exercise2</title>
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
		<p id='heading' class='text-center'>Exercise2</p>

		<div class="col-6 text-center" style="float: none; margin: 0 auto; margin-top: 100px;">
            <?php ?>
		</div>

		<script src="/resources/js/jquery-3.3.1.js"></script>
		<script src="/resources/js/bootstrap.js"></script>
	</body>
</html>
