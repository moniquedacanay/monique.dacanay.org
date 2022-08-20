<?php
    
/*$projects[‘Random Hex Code’]= Use rand() to create a random hex code to use as your page’s background or font color.  How could you generate a six-digit code consisting of numbers (0-9) and letters (A-F) using only a random number generator? Use an array to assign numbers to the letters.*/


    
	$rand = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'a', 'b', 'c', 'd', 'e', 'f');
	$color = '#'.$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)];

	// Hex Code #RRGGBB
	//(0,15) index -tells max and min
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Random Hex Code</title>
	</head>
	<body style="background: <?php echo $color; ?>;">
	</body>
</html>