<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Counter</title>
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
			#counter {
				margin: 10px;
			}
			#containerForm {
				margin-top: 100px;
			}
		</style>

		<link rel="stylesheet" type="text/css" href="/resources/css/bootstrap.css"/>
	</head>

	<body>
		<p id='heading' class='text-center'>Counter</p>

		<div class="col-6 text-center" style="float: none; margin: 0 auto; margin-top: 100px;">
			<?php
				// outputs 10 20 30... 100 in red and bold
				for($i=0; $i<=100; $i++){
					if($i%10 == 0){
						echo "<strong style='color:red;'>$i </strong>";
					} else {
						echo "$i ";
					}
				}
			?>
		</div>

		<script src="/resources/js/jquery-3.3.1.js"></script>
		<script src="/resources/js/bootstrap.js"></script>
	</body>
</html>
