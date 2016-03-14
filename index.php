<!DOCTYPE html>
<?php
ob_start();
require("inc/connection.php");
include("inc/functions.php");
?>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Nacht Van Cuijk</title>
		<link rel="stylesheet" type="text/css" href="css/style2.css">
		<link rel="icon" href="img/favicon.png">
		<meta name="description" content="Dit is de site van de nacht van cuijk">
		<meta name="keywords" content="Nacht van Cuijk,Cuijk,Lan Party,De Leijgraaf">
		<meta name="author" content="Thijs-Jan Guelen">
	</head>
	<body>
		<div id="allpage"> <!-- navigatie menu -->
			<?php include 'inc/top2.php'; ?>
			<div id="content"> 
				<video id="bgvid" loop muted autoplay>
					<source src="img/srix.mp4" type="video/mp4">
				</video>				
				<div id="body"><!-- pagina content zelf -->
					<div id="prePost">
					<?php
						getPosts($link);	// hier wordt de newsfeed weergegeven
						echo "</div>";
					?>
				</div>
			</div>
		</div>
		<?php include('inc/footer.php'); ?>
	</body>
</html>