<?php
//create variable to store page title
$pageTitle = "Monique's Dynamic Website";

//create an associative array of all our page name
$pageName = array(	"page1"=>"Home",
					"page2"=>"About Monique",
					"page3"=>"About Shodor");
					
//creating a navbar using our associative array and foreach loop
//foreach($arrayName as $key=>$value)
// var_dump($pageName);
$navBar = "<ul class = 'nav navbar-nav'>";
foreach($pageName as $page=>$title){
		$navBar .= "<li><a href='?current=$page'>$title</a></li>";
}
$navBar .= "</ul>";

//create variable to store current Page
if($_GET){
	$currentPage = $_GET["current"];
}else{
	$currentPage = "page1";
}

if(file_exists($currentPage . ".html")){
//create variable to store contents
$contents = file_get_contents($currentPage . ".html");
}else{
	$contents = '<h1>404 File Not Found</h1>
					<a href="?current=page1">Go Home</a>';
}

?>

<!-- Naked HTML that will display on our page -->
<!DOCTYPE html>
<html lang="en">
	<head>
		<link rel="stylesheet" type="text/css" href="yeti.min.css" />
		<link rel="shortcut icon" href="../../Personal_Portfolio/Pics/FaviconMonique.png"/>
		<title><?php echo($pageTitle);?></title>
	</head>
	<body>
		<nav class="navbar navbar-default">
			<div class="container-fluid">
				<div class="navbar-header">
					<a class="navbar-brand" href="#"><?php echo($pageTitle);?></a>
				</div>

				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<?php echo($navBar); ?>
				</div>
			</div>
		</nav>
		<div class="container">
			<?php echo($contents); ?>
		</div>
	</body>
</html>