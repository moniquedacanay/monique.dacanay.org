<?php

	// form validation
	function testinput($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = strip_tags($data);
		$data = htmlspecialchars($data);
		return $data;
	}

	// Get our input from HTML get method
	if (!isset($_GET["firstname"])) {
		$firstName = '';
	} else {
		$firstName = testInput($_GET["firstname"]);
		echo "Your first name is " . $firstName . "</br>";
	}

	if (!isset($_GET["lastname"])) {
		$lastName = '';
	} else {
		$lastName = testInput($_GET["lastname"]);
		echo "Your last name is " . $lastName . "</br>";
	}

	$NUM_OF_DICE = 1;

	if (!isset($_GET["diceroll"])) {
		$diceRoll = 0;
	} else {
		$diceRoll = testInput($_GET["diceroll"]);
		echo "You rolled a dice " . $diceRoll . " times</br>";
	}
	
	if (!isset($_GET["brand"])) {
		$brand = '';
	} else {
		$brand = testInput($_GET["brand"]);
		echo "Your shoe brand is " . $brand . "</br>";
	}

	if (!isset($_GET["shoeSize"])) {
		$shoeSize = 0;
	} else {
		$shoeSize = testInput($_GET["shoeSize"]);
		echo "Your shoe size is " . $shoeSize . "</br>";
	}
	
	// $shoeSize = 5;
// 	echo "Test1 Your shoe size is " . $shoeSize . "</br>";
// 	$shoeSize = $_GET["shoeSize"];
// 	echo "Test2 Your shoe size is " . $shoeSize . "</br>";

	if (!isset($_GET["dColor"])) {
		$dColor = "";
	} else {
		$dColor = testInput($_GET["dColor"]);
		echo "The color you thought of is " . $dColor . "</br>";
	}

	// MySQL Database
	$servername = "mysql-dev";
	$username = "usr_moniqued";
	$password = "jPFRf4yU";
	$dbname = "ap18_moniqued";
	

	// Create connection
	$conn = mysqli_connect($servername, $username, $password, $dbname);

	// Check connection
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}

	$GLOBAL_DATA = getTrialData($diceRoll,$NUM_OF_DICE);
	$SUMS = sumsFromTrialData($GLOBAL_DATA);

	if ($firstName != '')
	{
		$sql = "INSERT INTO dPeople (fname, lname)
		        VALUES ('$firstName','$lastName')";

		mysqli_query($conn, $sql);		
		$last_id = mysqli_insert_id($conn);
	
		$sql = "INSERT INTO dShoe (shoeSize, brand, peopleID)
		        VALUES ($shoeSize, '$brand', $last_id)";

		mysqli_query($conn, $sql);
	
		$sql = "INSERT INTO dColor (color, peopleID)
		        VALUES ('$dColor', $last_id)";

		mysqli_query($conn, $sql);
	
		for ($i = 0; $i < $diceRoll; $i++)
		{
			$res = $SUMS[$i];
			$pos = $i + 1;
			$sql = "INSERT INTO dDiceRoll (results, try, peopleID)
			        VALUES ('$res', $pos, $last_id)";
			mysqli_query($conn, $sql);
		}
	}


// 	$sql = "SELECT dDiceRoll.peopleID, dPeople.fname, dPeople.lname, dShoe.shoeSize, 
// 				dColor.color, dDiceRoll.results, dDiceRoll.try
// 			FROM dDiceRoll
// 			INNER JOIN dPeople ON dDiceRoll.peopleID = dPeople.id
// 			INNER JOIN dShoe ON dShoe.peopleID = dPeople.id
// 			INNER JOIN dColor ON dColor.peopleID = dPeople.id";
			
	
	$sql = "SELECT d.peopleID, p.fname, p.lname, s.shoeSize, c.color, d.results, d.try
			FROM dDiceRoll as d
			INNER JOIN dPeople as p ON d.peopleID = p.id
			INNER JOIN dShoe as s ON s.peopleID = p.id
			INNER JOIN dColor as c ON c.peopleID = p.id";


	$result = mysqli_query($conn, $sql);
	
	$display = "";
	if (mysqli_num_rows($result) > 0)
	{
		// output data of each row
		while($row = mysqli_fetch_assoc($result))
		{
		
			$id = $row["peopleID"];
		
			$query = mysqli_query($conn, "SELECT COUNT(*) AS 'count' FROM dDiceRoll WHERE peopleID=$id");
			$return = mysqli_fetch_assoc($query);
			$count = $return['count'];

			if ($row["try"] == $count)
			{
				$display .= "<tr><td> " . $row["fname"] . "</td><td>" . $row["color"] . "</td><td>" . 
					$row["shoeSize"] . "</td><td>" . $count . "</td></tr>";
				// var_dump($count);
			}
		}
	}
	else
	{
		echo "0 results";
	}
	
	// Popular color
	$query = mysqli_query($conn, "SELECT color AS 'color' 
	                                FROM dColor 
	                            GROUP BY color
								  HAVING count(*) = (SELECT count(*) FROM dColor
									GROUP BY color ORDER BY count(*) DESC LIMIT 1)");
	$return = mysqli_fetch_assoc($query);
	$color = $return['color'];
	
	// Average Shoe size
	$query = mysqli_query($conn, "SELECT AVG(shoeSize) AS 'shoeSize' FROM dShoe");
	$return = mysqli_fetch_assoc($query);
	$avg = $return['shoeSize'];
	
	// Common dice roll
	$query = mysqli_query($conn, "SELECT results AS 'side' FROM dDiceRoll GROUP BY results
									HAVING count(*) = (SELECT count(*) FROM dDiceRoll
									GROUP BY results ORDER BY count(*) DESC LIMIT 1)");
	$return = mysqli_fetch_assoc($query);
	$side = $return['side'];
	
	// Who rolled most dice?
	$query = mysqli_query($conn, "SELECT dPeople.fname, dDiceRoll.try
			FROM dDiceRoll 
			INNER JOIN dPeople ON dDiceRoll.peopleID = dPeople.id
			INNER JOIN dShoe ON dShoe.peopleID = dPeople.id
			INNER JOIN dColor ON dColor.peopleID = dPeople.id
			WHERE dDiceRoll.try = (SELECT MAX(try) FROM dDiceRoll)");
	$return = mysqli_fetch_assoc($query);
	$name = $return['fname'];
	$try = $return['try'];
	
	// All who like blue and have a Shoe size greater than 11
// 	$query = mysqli_query($conn, "SELECT People.fname, dShoe.shoeSize, dColor.color FROM dShoe
// 									INNER JOIN dPeople ON dShoe.peopleID = dPeople.id
// 									INNER JOIN dColor ON dColor.peopleID = dPeople.id
// 									WHERE dShoe.shoeSize >= 10 and dColor.color = 'green'");
// 	$return = mysqli_fetch_assoc($query);
// 	$result = $return['fname'];
	
	$sql = "SELECT dPeople.fname, dShoe.shoeSize, dColor.color FROM dShoe
				INNER JOIN dPeople ON dShoe.peopleID = dPeople.id
				INNER JOIN dColor ON dColor.peopleID = dPeople.id
				WHERE dShoe.shoeSize <= 10 and dColor.color = 'green'";


	$result = mysqli_query($conn, $sql);
	
	$d = "";
	if (mysqli_num_rows($result) > 0)
	{
		// output data of each row
		while($row = mysqli_fetch_assoc($result))
		{

			$d .= "<tr><td> " . $row["fname"] . "</td><td>" . $row["shoeSize"] . "</td><td>" . 
				$row["color"] . "</td></tr>";

		}
	}


/////////////////////// Calculations ////////////////////////////

  // Roll one die
  function dieRoll()
  {
    return rand(1,6);
  }

  // Roll pair of dice, called diceRoll
  function getTrialResults($nDice)
  {
    $results = array();
    for ($k = 0; $k < $nDice; $k++)
    {
      array_push($results, dieRoll());
    }
	return $results;
  }

  // Returns 2D Array of Data
  function getTrialData($nTrials,$nDice)
  {
    $data = array();
    for ($k = 0; $k < $nTrials; $k++)
    {
      array_push($data,getTrialResults($nDice));
    }
    return $data;  // outputs 2D Array
  }

  // array of sums
  // adds results for each trial, push to array
  function sumsFromTrialData($table)
  {
    $trialSums = array();
    for ($j = 0; $j < count($table); $j++)
    {
      array_push($trialSums,array_sum($table[$j]));
    }
    return $trialSums;
  }


/////////////////////////// Table //////////////////////////////

  // Table data
  function getTableContentHTML($data)
  {
    $htmlString = "";
    for ($i = 0; $i < count($data); $i++)
    {
      $htmlString .= getHTMLRow($data[$i],$i);
    }
    return $htmlString;
  }

  // data for each row
  function getHTMLRow($array,$trial)
  {
    $sum = 0;
    $trialNum = $trial + 1;
    $htmlRowString = "<tr><td>" . $trialNum . "</td>";
    for ($k = 0; $k < count($array); $k++)
    {
      $row = "<td>" . $array[$k] . "</td>";   // Dice roll
      $htmlRowString .= $row;
      $sum += $array[$k];
    }
    $htmlRowString .= "</tr>";
    return $htmlRowString;
  }


  // column headings
  function getHTMLHeader($numOfDice)
  {
    $htmlHeader = "<tr><th>Trial #</th>";
    for ($k = 0; $k < $numOfDice; $k++)
    {
      $diceCol = $k + 1;
      $htmlHeader .= "<th>Dice" . $diceCol . "</th>";
    }
    $htmlHeader .= "</tr>";
    return $htmlHeader;
  }


/////////////////// Probability Chart ////////////////////



  function getFrequency($f,$trials)
  {
    $pct = 0;
    $str = "";
    foreach ($f as $key => $value) {
      $bar = "";
      for ($i = 0; $i < $value; $i++)
      {
        $bar .= "-";
      }
      $pct = round($value / (float) $trials * 100, 2);
      $str .= "<tr>
                <td>" . $key . "</td>
                <td>" . $pct . "</td>
                <td>" . $bar . "</td>
              </tr>";
    }
    return $str;
  }

	$frequency = array_count_values($SUMS);
	ksort($frequency);

	mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang ="en">
		<title>DB Dice Roll!</title>
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
    padding-top: 90px;
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
  
  
	<p>This is a survey.  It inserts user information into a MySQL database</p>

  <form>
  
    <h3>First Name: <input type="text" name="firstname" value="" pattern="[A-Za-z]+" id="username" required> </h3>
				<label for="username"> <i>(letters only, no punctuation, numbers, spaces, or 
				special characters)</i></label><br>
				
	<h3>Last Name: <input type="text" name="lastname" value="" pattern="[A-Za-z]+" required></h3>
                <label for="username"> <i>(letters only, no punctuation, numbers, spaces, or 
				special characters)</i></label><br>
				
	<h3>Number of Rolls between 1 - 100:
				<input type="number" name="diceroll" value="0" min="1" max="100" required>
				</h3>
   
	<h3>Shoe Size:
				<input type="number" name="shoeSize" value="0" step=".5" min="1" max="20" required>
				</h3>

	<h3>Shoe Brand: <input type="text" name="brand" value="" pattern="[A-Za-z]+" id="brand" required> </h3>
				<label for="brand"> <i>(letters only, no punctuation, numbers, spaces, or 
				special characters)</i></label><br>
   

	<h3>What Color are you Thinking of: <input type="text" name="dColor" value="" pattern="[A-Za-z]+" id="dColor" required></h3>
				<label for="dColor"> <i>(letters only, no punctuation, numbers, spaces, or 
				special characters)</i></label><br>
 <input type="submit">
 
 	<section>
		<h5><a href="ResultsFinal.php"
          target="_blank">Click Here To Review Results!</a></h5>
	</section>
				
  </form><br>

    </div>
<!-- Footer -->
<footer class="w3-center w3-black w3-padding-64">
  <a href="#top" class="w3-button w3-light-grey"><i class="fa fa-arrow-up w3-margin-right"></i>To the top</a>
  
  <p>This website was created by Monique Armelle Z. Dacanay. Special Thanks to the Shodor Staff!</p>
</footer>
</body>
</html>


