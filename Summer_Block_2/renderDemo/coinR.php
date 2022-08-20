<?php
include_once("renderHTML/renderHTML.php");
//CSS variable to store interal 
$css = <<<CSS

 /*All*/
			header, nav, main, footer{
				padding: 5px;
				border: 3px solid gray;
				background-color: peachpuff;
				font-family: Verdana;color: #452c00;
			}
			/* 2 Column layout*/
			.flex_design{
				display: flex;margin: 10px;
			}
			/*Header CSS*/
			header{
				margin: 10px;font-size: 25px;
			}
			/* Navigation CSS */
			nav {width: 25%;
				margin-right: 10px;
				font-size: 20px;
			}

			nav ul{
				list-style-type: none;
			}
			/* Main CSSMain CSS. Where all our content will go */
			main {
				width: 75%;
				font-size: 18px;
				overflow: auto; 
				height: 500px;
			}
			/* Footer CSS */
			footer {
			margin: 10px;
			
			}
			table {
				margin-left:auto;
				margin-right:auto;
			}

			table, th, td {
				border: 3px solid #CCB845;
				padding: 10px;
				border-collapse: collapse;
			}



CSS;
/*makeHTML requires two arguments
1. name of web page
2. CSS styles
*/
echo(makeHTML("Coin Flip", $css));

/*makeBody requires one argument
1. name of web page
*/
echo(makeBody("Coin Flip"));

/*makeMain requires one argument
1. name php file of your desired project
NOTE: that the function call and php filename should be the same
*/
echo(makeMain("coinFlip"));

/*makeFooter requires one argument
1. name of author
*/
echo(makeFooter("Monique Dacanay"));

/*makeClose requires no arguments
*/
echo(makeClose());
?>


