<?php
	class Fabrik {
		private $standort;
		private $mitarbeiterAnzahl;

		public function __construct($standort, $mitarbeiterAnzahl) {
			$this->standort = $standort;
			$this->mitarbeiterAnzahl = $mitarbeiterAnzahl;
		}

		public function produktHerstellen() {
			echo "<p>Neues Produkt hergestellt!</p>";
		}

		public function __toString() {
			return $this->standort.";".$this->mitarbeiterAnzahl;
		}

		public function mitarbeiterAnzahlAendern($neueAnzahl) {
			$this->mitarbeiterAnzahl = $neueAnzahl;
		}

		public function standortAusgegen() {
			echo "<p>$this->standort</p>";
		}
	}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Exercise1</title>
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
		<p id='heading' class='text-center'>Exercise1</p>

		<div class="col-6 text-center" style="float: none; margin: 0 auto; margin-top: 100px;">
			<?php
				$fabrik = new Fabrik("Brixen", 10);
				$fabrik->produktHerstellen();
				$fabrik->standortAusgegen();
				echo "<p>$fabrik</p>";
				$fabrik->mitarbeiterAnzahlAendern(20);
				echo "<p>$fabrik</p>";
			?>
		</div>

		<script src="/resources/js/jquery-3.3.1.js"></script>
		<script src="/resources/js/bootstrap.js"></script>
	</body>
</html>
