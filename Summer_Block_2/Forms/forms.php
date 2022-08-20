<?php
//function to do basic validation of form data
//Hey this is our first function that actually 
//does real work.
function cleanMe($data){
	$data = trim($data);
	$data = stripslashes($data);
	$data = strip_tags($data);
	$data = htmlspecialchars($data);
	return($data);
}

//This is PHP
//GET the data from HTML method= GET and store a variable


//Check to see if GET fname exists
if(isset($_GET["fname"])){
	//Store the first Name and display that name
	$name = cleanMe($_GET["fname"]);
	echo($name);
}
//Check to see if GET favA exists
if(isset($_GET["favA"])){
	//Store the fav number and display that number
	$number = cleanMe($_GET["favA"]);
	echo($number);
}

//Check to see if POST lname exists
if(isset($_POST["lname"])){
	//Store the last Name and display that name
	$name = cleanMe($_POST["lname"]);
	echo($name);
}
//Check to see if POST favB exists
if(isset($_POST["favB"])){
	//Store the favorite number between 100-200 and display that number
	$number = cleanMe($_POST["favB"]);
	echo($number);
}

//Check to see if POST nname exists
if(isset($_POST["nname"])){
	//Store the nickname and display that name
	$name = cleanMe($_POST["nname"]);
	echo($name);
}
//Check to see if POST shoe exists
if(isset($_POST["shoe"])){
	//Store the shoe size and display that number
	$number = cleanMe($_POST["shoe"]);
	echo($number);
}
?>


<!DOCTYPE html>
<html lang ="en">
		<title>Form Validation</title>
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
    padding-top: 80px;
}

.w3-black {
    position: fixed;
    left: 0;
    bottom: 0;
    width: 100%;
    text-align: center;
}

.space {
	padding-bottom: 300px;
}


#F1 {
        border: 3px solid black;
        border-radius: 10px;
        padding: 10px;
        background-color: #c2f0c2;
        margin-bottom: 20px;
      }
      #F2 {
        border: 3px solid black;
        border-radius: 10px;
        padding: 10px;
        background-color: #70db70;
        margin-bottom: 20px;
      }
      #F3 {
        border: 3px solid black;
        border-radius: 10px;
        padding: 10px;
        background-color: #33cc33;
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
    <div class="w3-twothird w3-container space">
  
 <!--Form for capturing user input-->
   
   

    <!--Form 1 action="forms.php" method="get"-->
    <div id="F1">
      <h1>Form 1: action="forms.php" method="get"</h1>
      <form action="forms.php" method="get">
        
        <h3>What is your First Name:</h3>
        <input type="text" name="fname" value="Type Here">
        
        <h3>What is your favorite number:</h3>
        <input type="number" name="favA" value="0">
        
        <!-- Submit button for the form-->
        <p>
          <input type="submit" value="Submit">
          <input type="reset">
        </p>

      </form>
    </div>

    <!--Form 2 action="forms.php" method="post"-->
    <div id="F2">
      <h1>Form 2: action="forms.php" method="post"</h1>
      <form action="forms.php" method="post">
        
        <h3>What is your Last name :</h3>
        <input type="text" name="lname" value="Type Here">
        
        <h3>What is your favorite number between 100-200:</h3>
        <input type="number" name="favB" value="0" min="100" max="200">
        
        <!-- Submit button for the form-->
        <p>
          <input type="submit" value="Submit">
          <input type="reset">
        </p>
      </form>
    </div>
    
    <!--Form 3 action="<?php //echo($_SERVER["PHP_SELF"]);?>" method="post"-->
	<div id="F3">
	  <h1>Form 3: action="&lt;?php echo($_SERVER["PHP_SELF"]);?&gt;"</h1>
	  <form action="<?php echo($_SERVER["PHP_SELF"]);?>" method="post">
		
		<h3>What is your Nickname:</h3>
		<input type="text" name="nname" value="Type Here">
		
		<h3>What is your shoe size:</h3>
		<input type="number" name="shoe" value="">
		
		<!-- Submit button for the form-->
		<p>
		  <input type="submit" value="Submit">
		  <input type="reset">
		</p>
	  </form>
	</div>
	</div>
<!-- Footer -->
<footer class="w3-center w3-black w3-padding-64">
  <a href="#top" class="w3-button w3-light-grey"><i class="fa fa-arrow-up w3-margin-right"></i>To the top</a>
  
  <p>This website was created by Monique Armelle Z. Dacanay. Special Thanks to the Shodor Staff!</p>
</footer>
</body>
</html>



