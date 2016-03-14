<?php
ob_start();
require("inc/connection.php");
include("inc/functions.php");
?>
<html>
	<head>
		<title>Nacht Van Cuijk</title>
		<link rel="stylesheet" type="text/css" href="css/style.css">
	</head>
	<body>
	
	<div id="topdiv"> <!-- navigatie menu -->
		<?php include 'inc/top.php'; ?>
	</div>
	<div id="content"> 
<div id="body"><!-- pagina content zelf -->
		<div class="post">
				<?php
	require("inc/connection.php");
	function LokalenTellerMod($lokaal) {
	if($lokaal = "117" || $lokaal = "118" || $lokaal = "120") {
		$MaxAantal = 30;
	} else {
		$MaxAantal = 60;
	}
	
	$host = "127.0.0.1";
	$username = "nvc";
	$password = "{d&WX4yLTaq)";
	$dbname = "conventionapp";
	$link = new mysqli($host, $username, $password, $dbname);
	
	$query3 = "SELECT COUNT(lokaal) FROM register WHERE lokaal = ".$lokaal." AND isbinnen = 1";	
	$result3 = mysqli_query($link, $query3) or exit(mysql_error());
	$data3 = [];
	while ($row3 = $result3->fetch_assoc()) {
		$data3[] = $row3;
	}
	$KanNogErbij = $MaxAantal - $lokaal;
	echo "In lokaal ".$lokaal." zitten ".$data3[0]['COUNT(lokaal)']." bezoekers. er kunnen maximaal ".$MaxAantal." bezoekers in. Er kunnen nog ".$KanNogErbij." bezoekers bij.<br />";
}
	$query = "SELECT
			COUNT(isbinnen)
		FROM
			register
		WHERE
			isbinnen = 1";
		$result = mysqli_query($link, $query);
		$data = [];
		while ($row = $result->fetch_assoc()) {
			$data[] = $row;
		}
	
	$query2 = "SELECT
			COUNT(isbinnen)
		FROM
			register";
		$result2 = mysqli_query($link, $query2);
		$data2 = [];
		while ($row2 = $result2->fetch_assoc()) {
			$data2[] = $row2;
		}
		
	$binnen = $data[0]['COUNT(isbinnen)'];
	$aanmeldingen = $data2[0]['COUNT(isbinnen)'];
	$nog = $aanmeldingen - $binnen;

	echo "Op het moment zijn er ".$binnen." mensen binnen.<br />";
	echo "Er zijn ".$data2[0]['COUNT(isbinnen)']." aanmeldingen.</br>";
	echo "dat houd in dat er nog ".$nog." mensen komen.<br />";
	echo LokalenTellerMod(117);
	echo LokalenTellerMod(118);
	echo LokalenTellerMod(119);
	echo LokalenTellerMod(120);
?>
		</div>
	</div>
</div>
	</body>
</html>