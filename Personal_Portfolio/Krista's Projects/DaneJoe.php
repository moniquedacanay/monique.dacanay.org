<?php

	function testinput($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = strip_tags($data);
		$data = htmlspecialchars($data);
		return $data;
	}

	if (isset($_GET["first"])) {
		$first = testInput($_GET["first"]);
	} else {
		$first = "Jane";
	}

	if (isset($_GET["last"])) {
		$last = testInput($_GET["last"]);
	} else {
		$last = "Doe";
	}

	$firstNameLength = strlen($first);
	$lastNameLength = strlen($last);

	// Monique Dacanay => Doniquy Macanae
	// $firstNameFirstLetter = D
	// $firstNameLastLetter = y
	// $firstNameMiddle = oniqu
	
	// Array ( [0] => D [1] => a [2] => c [3] => a [4] => n [5] => a [6] => y )
	// substr(string,start,length)
	$firstNameFirstLetter = $last[0];
	$firstNameLastLetter = $last[$lastNameLength - 1];
	$firstNameMiddle = substr($first,1,$firstNameLength-2);

	$lastNameFirstLetter = $first[0];
	$lastNameLastLetter = $first[$firstNameLength - 1];
	$lastNameMiddle = substr($last,1,$lastNameLength-2);

	$firstName = $firstNameFirstLetter . $firstNameMiddle . $firstNameLastLetter;
	// $firstName = $last[0] . substr($first,1,$firstNameLength-2) . $last[$lastNameLength - 1];
	$lastName = $lastNameFirstLetter . $lastNameMiddle . $lastNameLastLetter;

	// echo($firstName . "<br />");
	// echo($lastName);

?>


<!DOCTYPE html>
<html>
	<head>
		<title>Dane Joe</title>
		<style type="text/css">
		
			#F2 {
			border: 3px solid black;
			border-radius: 10px;
			padding: 10px;
			background-color: #48C9B0;
			margin-bottom: 20px;
			}
		</style>
	</head>
	<body>
		<h1>Dane Joe!</h1>
		<form id="F2">
			First name:<input type="text" name="first" required><br><br>
			Last name:<input type="text" name="last" required><br><br>
			<input type="submit" value="Submit">
		</form>
		<h2>
			<?php
				echo($firstName . " ");
				echo($lastName);
			?>
		</h2>
	</body>
</html>