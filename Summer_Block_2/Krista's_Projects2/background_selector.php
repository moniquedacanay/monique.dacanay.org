<?php

	if (isset($_GET["color"])) {
		$color = $_GET["color"];
	} elseif (isset($_COOKIE["color"])) {
		$color = ($_COOKIE["color"]);
	} else {
		$color = "white";
	}

	setcookie("color",$color,time()+300);

?>



<!DOCTYPE html>
<html lang ="en">
		<title>The Background Selector</title>
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
</style>
<body style="background-color: <?php echo $color; ?>">

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
  

	<h1>
      <?php echo("The Background Selector"); ?>
    </h1>
		<form>
			<select name="color">
			  <option value="HotPink">pink</option>
			  <option value="red">red</option>
			  <option value="orange">orange</option>
			  <option value="yellow">yellow</option>
			  <option value="LightGreen">green</option>
			  <option value="DeepSkyBlue">blue</option>
			  <option value="RebeccaPurple">purple</option>
			  
			</select>
			<input type="submit" value="Submit">
		</form>
	</div>
<!-- Footer -->
<footer class="w3-center w3-black w3-padding-64">
  <a href="#top" class="w3-button w3-light-grey"><i class="fa fa-arrow-up w3-margin-right"></i>To the top</a>
  
  <p>This website was created by Monique Armelle Z. Dacanay. Special Thanks to the Shodor Staff!</p>
</footer>
</body>
</html>

