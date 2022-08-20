<?php
/*function makeHTML writes doctype, html tag, head tag, title tag, 
style tag and ends with all tags being closed. When calling 
this function you must pass two aurguments. 
1. the title of the website. 
2. the internal CSS for the website.
When the function is finished it will return the starting syntax for a website
**Note: you could also pass an aurgument that would load the a external CSS file instead
of a internal CSS code.
*/
function makeHTML($title, $style){
	$head = <<<EOT
<!DOCTYPE html>
<html lang ="en">
	<head>
		<title>$title</title>
		<link rel="stylesheet" type="text/css" href="#"/>
		<link rel="shortcut icon" href="../../Personal_Portfolio/Pics/FaviconMonique.png"/>
		<style>
			$style
		</style>
	</head>
EOT;
return($head);
}
/*function makeBody writes the open tag for the body, header tags with nested <h1> tags, 
open tag for the div, ends with navigtion tags. When calling 
this function you must pass one arguments. 
1. the title of the website. 
When the function is finished it will return the partial body syntax for a website.
**Note: you could also seperate out the Navigation elemnts into its own function which would 
easy enable you to create custom URL for each web page you build with this system
*/
function makeBody($title){
	$body = <<<EOT
	<body>
		<!-- HEADER -->
		<header>
			<h1>$title</h1>
		</header>
		<div class="flex_design">
		<!-- NAVIGATION -->
			<nav>
				<ul>
					<li><a href="../../index.html">Home</a></li>
					<li><a href="../../blog.html">Blog</a></li>
					<li><a href="../../portfolio.html">Portfolio</a></li>
					<li><a href="http://shodor.org">Shodor</a></li>
				</ul>
			</nav>
			
			
EOT;
return($body);
}
/*function makeMain writes the main tag. This is where your model, project,
pictures, blogs, etc (Content) go. When calling this function you must pass one argument. 
1. the name of the file which is also the name of the function you must call.
We planned it that way. We will use the name passed from the one aurgment to 
include_once our php file located one directory back and in the content directory 
(NOTE ../ move you back of directory)
When the function is finished it will return the main HTML with content for the web page.
*/
function makeMain($projectName){
	include_once("content/$projectName.php");
	$data = $projectName();
	$main = <<<EOT
			<main>
				$data
			</main>
		</div>
EOT;
	return($main);
}

/*function makeFooter writes the footer tag. This is where your name goes (author).
When calling this function you must pass one aurguments. 
1. your name 
When the function is finished it will return the footer element with content
for the web page.
*/
function makeFooter($name){
	$footer = <<<EOT
	<!-- FOOTER -->
		<footer>
			<h5 class="me">Created by $name</h5>
		</footer>
EOT;
	return($footer);
} 

/*function makeClose writes remaining closing tags to complete the HTML 
When calling this function you pass no aurguments. 
When the function is finished it will return the closing tags for the body and html
*/
function makeClose(){
	$close = <<<EOT
	</body>
</html>
EOT;
	return($close);
}






?>




