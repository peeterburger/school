<?php

// ----------------------- HIT COUNTER --------------------------------------------------

    // IP of the connected client
    $current_ip = $_SERVER['REMOTE_ADDR'];
    // hit counter file handler
    $hit_couner_file = fopen("./_data/index_hit_counter", "r");
    // hit counter file string content
    $hit_couner_file_content = file_get_contents("./_data/index_hit_counter");

    // default counter value is 1
    $new_couter = 1;
    // defualt date is time() <- current date
    $new_date = time();

    // iterates through the hit counter file to check if the client ip already has an entry
    while (($line = fgets($hit_couner_file)) !== false) {
        $entries = explode(";", $line);
        $file_ip = $entries[0];

        // if the client ip is already in the file, increase its counter
        if ($file_ip == $current_ip) {
            $contents = file_get_contents("./_data/index_hit_counter");
            $contents = str_replace($line, '', $contents);
            file_put_contents("./_data/index_hit_counter", $contents);

            $file_date = (int)$entries[2];
            // if the client already connected in the last 30 minuts, do not increase the counter,
            // else, just update the date
            if (time() - $file_date < (3600/2)) {
                $new_date = $file_date;
                $new_couter =  (int)$entries[1];
            } else {
                $new_couter = (int)$entries[1] + 1;
                $contents = file_get_contents("./_data/index_hit_counter");
                $contents = str_replace($line, '', $contents);
                file_put_contents("./_data/index_hit_counter", $contents);
            }
        }
    }

    // close the current handler for the hit counter file
    fclose($hit_couner_file);

    // reopen the hit counter file with 'append' parameter
    $hit_couner_file = fopen("./_data/index_hit_counter", "a");

    // update the file
    $newline = "$current_ip;$new_couter;$new_date\n";
    fwrite($hit_couner_file, $newline);
    fclose($hit_couner_file);

    // sum up all the hits in the hit counter file and return it
    function getHits() {
        $hit_couner_file = fopen("./_data/index_hit_counter", "r");
        $sum = 0;
        while (($line = fgets($hit_couner_file)) !== false) {
            $entries = explode(";", $line);
            $sum += (int)$entries[1];
        }
        return $sum;
    }

// ----------------------- TABLE OF CONTENTS --------------------------------------------

    // starts session
    session_start();

    // sets the root path to '.'
    $filepath = ".";

    // checks, if the 'latestPath' cookie/session exists
    if(!isset($_GET['filepath']) && /*isset($_COOKIE['latestPath']) */ isset($_SESSION['latestPath'])){
        // cookie/session that stores the lates path the user has been at
        $filepath = /*$_COOKIE['latestPath']*/ $_SESSION['latestPath'];
    } elseif (isset($_GET['filepath'])) {   // checks, if GET contains a filepath
        $filepath = $_GET["filepath"];
    }

    // updates the 'filePath' cookie/session
    /*setcookie("latestPath", $filepath, time() + 3600, './');*/
    $_SESSION['latestPath'] = $filepath;

// ------------------------ BACKGROUND ---------------------------------------------------

    // setting default background color
    $background = "";

    function getBackground(){
        global $background;
        return $background;
    }

    // setts the background
    if(isset($_GET['style'])){
        $background = $_GET['style'];
    }
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Index</title>
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
				padding: 10px;
			}
			#containerForm {
				margin-top: 100px;
			}
		</style>

		<link rel="stylesheet" type="text/css" href="/resources/css/bootstrap.css"/>
	</head>

	<body style="background-color: <?php echo getBackground(); ?>;">
        <div class="container-fluid">
            <p id='counter' class='text-left'>Hits: <?php echo getHits(); ?></p>
            <form method="set">
                <div class="btn-group" role="group" aria-label="Basic example">
                    <button name="style" type="submit" value="blue" class="btn btn-primary">Blue</button>
                    <button name="style" type="submit" value="red" class="btn btn-danger">Red</button>
                    <button name="style" type="submit" value="green" class="btn btn-success">Green</button>
                </div>
            </form>
        </div>

		<p id='heading' class='text-center'>Table of Contents</p>

		<div class="col-6" style="float: none; margin: 0 auto; margin-top: 100px;">
			<div class="list-group">
				<?php
                    // scans the directory at 'filepath'
                    $files = scandir($filepath);

                    // add a 'back to root' link
                    echo
                    "<a href='/index.php?filepath=.' class='list-group-item list-group-item-action list-group-item-warning'>
                        <label class='col-10'><- back to root</label>
                    </a>";

                    // iterates over all files in the directory and prints them as list-item (bootstrap)
                    foreach ($files as $file) {
                        // drops '.' and '..' directory
                        if ($file == "." || $file == "..") {
                            continue;
                        }

                        // absole path to the file
                        $realfile = "$filepath/$file";

                        // if the file is a directory, print it blue, else, print it grey
                        if (is_dir($realfile)) {
                            echo
                            "<a href='/index.php?filepath=$realfile' class='list-group-item list-group-item-action list-group-item-primary'>
								<label class='col-10'>$file</label>
							</a>";
                        } else {
                            // file size is in kb
                            $filesize = filesize($realfile)/1000;
                            echo
                            "<a href='$realfile' class='list-group-item list-group-item-action list-group-item-secondary'>
								<label class='col-10'>$file</label><label class='col-2'>$filesize kB</label>
							</a>";
                        }
                    }
                ?>
			</div>
		</div>

		<script src="/resources/js/jquery-3.3.1.js"></script>
		<script src="/resources/js/bootstrap.js"></script>
	</body>
</html>
