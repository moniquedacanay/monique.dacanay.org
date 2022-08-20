<!-- By Monique Dacanay 8/12/18 -->
<!-- Dice Statistics -->
<?php

	function cleanMe($data){
		$data = trim($data);
		$data = stripslashes($data);
		$data = strip_tags($data);
		$data = htmlspecialchars($data);
		return($data);
	}

	//Check to see if POST numDice exists
	if(isset($_POST["numDice"])) {
		//Store the Number of Dice and display that number
		$nd = cleanMe($_POST["numDice"]);
	} else {
		$nd = 5;
	}
	
	//Check to see if POST numRolls exists
	if(isset($_POST["numRolls"])){
		//Store the Number of Rolls and display that number
		$nr = cleanMe($_POST["numRolls"]);
	} else {
		$nr = 10;
	}
	
	
	function rollDice($numDice, $numRolls) {
		$array = array();
		
		for ($r = 0; $r < $numRolls; $r++) {
			$sum = 0;
			
			// Repeat ($numDice) times
			for ($d = 0; $d < $numDice; $d++) {
				$dice = rand(1,6);
				$sum += $dice;		// accumulation variable
				array_push($array, $dice);
			}
			
			array_push($array, $sum);
		}
		
		return($array);
	}
	
	$arr = rollDice($nd, $nr);
	
	function drawHeading($numDice) {
		$htmlString = '<tr>';
		
		for ($d = 1; $d < $numDice + 1; $d++) {
			$htmlString .= '<th>Dice ' . $d . '</th>';
		}
		
		$htmlString .= '<th>Sum</th></tr>';
		
		return $htmlString;
	}
	
	function drawTable($numDice, $numRolls, $array) {
		$htmlString = '';
		$index = 0;
	
		for ($r = 0; $r < $numRolls; $r++) {
			$htmlString .= '<tr>';
			$col = $numDice + 1;
			
			for ($d = 0; $d < $col; $d++) {
				$htmlString .= '<td>' . $array[$index + $d] . '</td>';
			}
			
			$htmlString .= '</tr>';
			$index += $col;
		}
		
		return $htmlString;
	}
	
	$htmlString = drawHeading($nd) . drawTable($nd, $nr, $arr);
	
	function getSums($numDice, $numRolls, $array) {
		$sumarr = array();
		$index = $numDice;
		
		for ($r = 0; $r < $numRolls; $r++) {
			$sum = $array[$index];
			array_push($sumarr, $sum);
			
			$index += $numDice + 1;
		}
		
		return $sumarr;
	}
	
	$sumarr = getSums($nd, $nr, $arr);
	
	// Sort an associative array in ascending order, according to the value
	asort($sumarr);
	$sumarray = array_count_values($sumarr);
	
	function stars($freq) {
		$starString = '';
		
		for ($k = 0; $k < $freq; $k++) {
			$starString .= '*';
		}
		
		return $starString;
	}
		
	function getFrequency($array) {
		$freqString = '';
		
		foreach($array as $x=>$x_value)
		{
			$freqString .= '<tr>';
			// Value | Frequency
			
			$freqString .= '<td>' . $x . '</td>' . 
						   '<td>' . stars($x_value) . '</td>' . 
						   '<td>' . $x_value . '</td>';
			
			$freqString .= '</tr>';
		}
		
		return $freqString;
	}

	$freqString = getFrequency($sumarray);
	

?>




<!DOCTYPE html>
<html lang ="en">
		<title>Dice Statistics!</title>
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

/* 
.w3-black {
 position: absolute;
  right: 0;
  bottom: 0;
  left: 0;
  padding: 1rem;
  text-align: center;
}
 */
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




#F2 {
				border: 3px solid black;
				border-radius: 10px;
				padding: 10px;
				background-color: #70db70;
				margin-bottom: 20px;
			}
		  
			table {
				font-family: calibri;
				border-collapse: collapse;
				width: 50%;
			}
	
			td, th {
				border: 1px solid #dddddd;
				text-align: left;
				padding: 8px;
			}

			tr:nth-child(even) {
				background-color: #dddddd;
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
    
  

<h1>
			Dice Statistics!
		</h1>
		<div id="F2">
			<form action="DiceStatistics.php" method="post">

				<h3>Number of Dice:</h3>
				<input type="number" name="numDice" value="0" required>

				<h3>Number of Rolls:</h3>
				<input type="number" name="numRolls" value="0" required>

				<!-- Submit button for the form-->
				<p>
					<input type="submit" value="Submit">
					<input type="reset">
				</p>
			</form>
		</div>
		<table>
			<tr>
				<th>Value</th>
				<th>Stars</th>
				<th>Frequency</th>
			</tr>
			<?php echo($freqString); ?>
		</table>
		<br>
		<table>
			<?php echo($htmlString); ?>
		</table>
		
		
	</div>
<!-- Footer -->
<footer class="w3-center w3-black w3-padding-64">
  <a href="#top" class="w3-button w3-light-grey"><i class="fa fa-arrow-up w3-margin-right"></i>To the top</a>
  
  <p>This website was created by Monique Armelle Z. Dacanay. Special Thanks to the Shodor Staff!</p>
</footer>
</body>
</html>

