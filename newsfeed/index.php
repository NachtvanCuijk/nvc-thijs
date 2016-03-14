<?php ob_start(); ?>
<!DOCTYPE html>
<html>
	<head>
		<link href="stylesheet.css" rel="stylesheet" type="text/css">
	</head>
	<body>
		<?php
		session_start();
		include('../inc/functions.php');
		echo '<div id="newsfeed">';
		getPosts($link);
		echo "</div>";
		echo '<div id="lokalen">';
		echo '<h1 class="lokaal">Lokaal 117:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.LokalenTeller(117).'</h1>';
		echo '<h1 class="lokaal">Lokaal 118:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.LokalenTeller(118).'</h1>';
		echo '<h1 class="lokaal">Lokaal 119:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.LokalenTeller(119).'</h1>';
		echo '<h1 class="lokaal">Lokaal 120:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.LokalenTeller(120).'</h1>';
		echo "</div>";
		?>
	</body>
</html>