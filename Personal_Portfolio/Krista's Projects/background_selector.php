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
<html>
	<body style="background-color: <?php echo $color; ?>">
	<h1>
      <?php echo("The Background Selector"); ?>
    </h1>
		<form>
			<select name="color">
			  <option value="DeepPink">pink</option>
			  <option value="orange">orange</option>
			  <option value="LightGreen">green</option>
			  <option value="DeepSkyBlue">blue</option>
			</select>
			<input type="submit" value="Submit">
		</form>
	</body>
</html>

