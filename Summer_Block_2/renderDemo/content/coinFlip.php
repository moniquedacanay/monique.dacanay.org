<?php
/*We want to write a function to flip a coin “x” number of times. A coin flip has random chance to be heads or tails. We will need to keep track of the number of times heads appears, the number of times tails appears, and the total of heads and tails. Finally we want to wrap the heads total, tails total, total, and what percent of coin flips were heads and tails into a HTMl table element. We return the HTML table element with our coin flip results. 
*/

//function called CoinFlip
function coinFlip(){
	//Create variables to be our heads counter and tails counter

	$heads=0;
	$tails=0;
	$numberOfFlips = 250;

	for($i=1; $i<=$numberOfFlips; $i++){
		//make a random number.
		$flipResult = rand(0,1);
		//check for heads or tails
		//heads = 1
		//tails = 0
		if($flipResult == 1){
			$heads++;
			//echo("Heads <br>");
		}else{
			$tails = $tails + 1;
			//echo("Tails <br>");
		}
	
	}
	$totals = $heads + $tails;
	$percentH = $heads/$totals*100;
	$percentT = $tails/$totals*100;
	
	$table = <<<TABLE
					<table>
						<tr>
							<td>Heads Count</td>
							<td> $heads </td>
						</tr>
						<tr>
							<td>Tails Count</td>
							<td>$tails</td>
						</tr>
						<tr>
							<td>Total</td>
							<td>$totals</td>
						</tr>
						<tr>
							<td>Heads</td>
							<td>$percentH</td>
						</tr>
						<tr>
							<td>Tails</td>
							<td>$percentT</td>
						</tr>
					</table>
TABLE;
return($table);
	
}
//$test = coinFlip();
//echo($test);
?>