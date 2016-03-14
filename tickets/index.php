<?php
ob_start();
session_start();
require("../inc/connection.php");
include("../inc/functions.php");
?>
<html>
	<head>
		<title>Nacht Van Cuijk</title>
		<link rel="stylesheet" type="text/css" href="../css/style.css">
		<link rel="icon" href="../img/favicon.png">
	</head>
	<body>
	<div id="topdiv"> <!-- navigatie menu -->
		<?php include '../inc/top.php'; ?>
	</div>
	<div id="content"> 
		<div id="body"><!-- pagina content zelf -->
			<div class="post">
			<?php
				if(isset($_POST['food'])) {
					$_SESSION['ticket'] = 0;
					header("Location: inschrijven.php");
				} elseif(isset($_POST['game'])) {
					$_SESSION['ticket'] = 1;
					header("Location: inschrijven.php");
				} else {
			?>
			<table>
				<tr>
					<td class="ticketImgTD"><img class="ticketImg" src="../img/game.png" align="left" /></td>
					<td><h2>Gaming only ticket</h2>
					<p>Dit is het simpelste ticket. Met dit ticket heb je alleen toegang tot het evenemet. Let op! je kunt na het bestellen niet meer wisselen.</td>
					<td style="padding: 0px 75px;"><h2>gratis</h2></td>
					<td><form action="" method="post"><input type="submit" name="game" value="bestellen" /></form></td>
				</tr>
				<tr>
					<td></td>
					<td><hr /></td>
				</tr>
				<tr>
					<td class="ticketImgTD"><img class="ticketImg" src="../img/food.png" align="left" /></td>
					<td><h2>Food ticket</h2>
					<p>Met dit ticket heb je toegang tot het evenement en de frietkar. Hier mag je zoveel friet halen als je wilt. Betalen hoeft pas aan de deur.</td>
					<td style="padding: 0px 75px;"><h2>€2,50</h2></td>
					<td><form action="" method="post"><input type="submit" name="food" value="bestellen" /><td>
				</tr>
				<tr>
					<td></td>
					<td><hr /></td>
				</tr>
				<tr>
					<td class="ticketImgTD"><img class="ticketImg" src="../img/sponsor.png" align="left" /></td>
					<td><h2>Sponsor ticket</h2>
					<p>Met dit ticket krijg je alles dat bovenstaande tickets bieden, plus extra goodies zoals een sponsor t-shirt. Ook mag je van te voren kiezen waar je wilt zitten.</td>
					<td style="padding: 0px 75px;"><h2>€7,50</h2></td>
					<td><form action="" method="post"><input type="submit" name="game" value="bestellen" /></form></td>
				</tr>
			</table>
			<?php
				}
			?>
		</div>
	</div>
	</body>
</html>