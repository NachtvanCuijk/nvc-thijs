<html>
	<head>
		<title>Nacht Van Cuijk</title>
		<link rel="stylesheet" type="text/css" href="../css/style.css">
		<link rel="icon" href="../img/favicon.png">
		<style>
		.profPicL {
			padding-right: 10px;
		}
		.profPicR {
			padding-right: 10px;
		}
		.left {
			text-align: left;
		}
		.right {
			text-align: right;
		}
		</style>
	</head>

<!--<video autoplay loop poster="polina.jpg" id="bgvid">
    <source src="css/video.mp4" type="video/mp4">
</video>-->
	<div id="topdiv"> <!-- navigatie menu -->
		<?php include '../inc/top.php'; ?>
	</div>
	<div id="content"> 
<div id="body"><!-- pagina content zelf -->
	<?php
	$klaar = 0;
	if($klaar == 0){
		echo '<div class="post"><h1>Sorry, deze pagina is onder constructie!</h1><p>probeer het later opnieuw</p></div>';
	} else {
	echo '
	<div class="post">
		<div class="left">
			<img class="profPicL" src="../img/Naamloos.png" alt="Siebe Lamers" align="left" />
			<h2>Siebe Lamers</h2><br />
			<p>Ik ben Siebe Lamers. Ik doe thuis veel dingen met computers en vind het leuk en interessant om er mee bezig te zijn. Daarom help ik nu met het organiseren van de LAN-party.</p><br /><br />
		</div>
		<div class="right">
			<img class="profilePicR" src="../img/rick.png" align="right" alt="Rick Heijnen" />
			<h2>Rick Heijnen</h2>
			<p>Hoi, Ik ben Rick Heijnen. Ik volg de opleiding ICT-Beheer Niv 4.<br />Bij het organiseren zal ik verantwoordelijk zijn voor de beveiling en de sponsering.<br /> Tevens zorg ik ook voor de contacten met BICT en de school.<br /></p>
		</div>
		<div class="left">
			<img class="profilePicL" src="../img/Naamloos.png" align="left" alt="Thijs-Jan Guelen" />
			<h2>Thijs-Jan Guelen</h2>
			<p>Hoi, ik ben Thijs. Ik houd van ijs.<br />Ik doe programmeren, al moet ik het een en ander nog leren.	Ik maak onder andere het systeem met de kaartjes, al kostte het me wel een paar haartjes. Geniet maar lekker van de nacht, dan ben ik degene die lacht.</p><br /><br />
		</div>
		<div class="right">
			<img class="profilePic" src="../img/Naamloos.png" align="right" alt="Ron" />
			<h2>Ron Smits</h2>
			<p>Hier wat tekst over ron<br /><br /><br /><br /></p><br /><br />
		</div>
		
		<!--
		<div class="left">
			<img class="profilePic" src="img/" align="left" alt="" />
			<h2></h2>
			<p></p><br /><br />
		</div>
		<div class="right">
			<img class="profilePic" src="img/" align="right" alt="" />
			<h2></h2>
			<p></p><br /><br />
		</div>
		-->
	</div>';
	}
	?>
</div>
</div>
</body>
</html>