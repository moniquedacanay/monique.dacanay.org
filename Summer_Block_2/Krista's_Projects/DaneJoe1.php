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
<html lang ="en">
		<title>Dane Joe</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="shortcut icon" href="../../Personal_Portfolio/Pics/FaviconMonique.png"/>
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
body,h1,h2,h3,h4,h5,h6 {font-family: "Raleway", sans-serif}
body, html {
    height: 100%;
    line-height: 1.8;
    background-color: PaleTurquoise;
}

.w3-bar .w3-button {
    padding: 16px;
    
}

body {
    padding-top: 50px;
}

.w3-black {
    position: fixed;
    left: 0;
    bottom: 0;
    width: 100%;
    text-align: center;
}
#F2 {
			border: 3px solid black;
			border-radius: 10px;
			padding: 10px;
			background-color: #48C9B0;
			margin-bottom: 20px;
			}
</style>
<body>

<!-- Navbar (sit on top) -->
<div class="w3-top">
  <div class="w3-bar w3-white w3-card" id="myNavbar">
    <a href="#home" class="w3-bar-item w3-button w3-wide">MONIQUE ARMELLE Z. DACANAY</a>
    <!-- Right-sided navbar links -->
    <div class="w3-right w3-hide-small">
      <a href="../../index.html" class="w3-bar-item w3-button">HOME</a>
      <a href="../../blog.html" class="w3-bar-item w3-button">BLOG</a>
      <a href="../../portfolio.html" class="w3-bar-item w3-button">PORTFOLIO</a>
      <a href="http://shodor.org" class="w3-bar-item w3-button">SHODOR</a>

    </div>
    <!-- Hide right-floated links on small screens and replace them with a menu icon -->

    <a href="javascript:void(0)" class="w3-bar-item w3-button w3-right w3-hide-large w3-hide-medium" onclick="w3_open()">
      <i class="fa fa-bars"></i>
    </a>
  </div>
</div>

<!-- Sidebar on small screens when clicking the menu icon -->
<nav class="w3-sidebar w3-bar-block w3-black w3-card w3-animate-left w3-hide-medium w3-hide-large" style="display:none" id="mySidebar">
  <a href="javascript:void(0)" onclick="w3_close()" class="w3-bar-item w3-button w3-large w3-padding-16">Close ×</a>
  <a href="../../index.html"  onclick="w3_close()" class="w3-bar-item w3-button">HOME</a>
  <a href="../../blog.html" onclick="w3_close()" class="w3-bar-item w3-button">BLOG</a>
  <a href="../../portfolio.html" onclick="w3_close()" class="w3-bar-item w3-button">PORTFOLIO</a>
  <a href="http://shodor.org" onclick="w3_close()" class="w3-bar-item w3-button">SHODOR</a>
</nav>

<!--Allows images stay to the side-->
    <div class="w3-twothird w3-container">
  

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
	</div>
<!-- Footer -->
<footer class="w3-center w3-black w3-padding-64">
  <a href="#top" class="w3-button w3-light-grey"><i class="fa fa-arrow-up w3-margin-right"></i>To the top</a>
  
  <p>This website was created by Monique Armelle Z. Dacanay. Special Thanks to the Shodor Staff!</p>
</footer>
</body>
</html>

