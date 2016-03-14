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
					if($_SESSION['ticket'] == 0) {
						echo "<h1>food ticket</h1>";
						$friet = 1;
					} else {
						echo "<h1>gaming only ticket</h1>";
						$friet = 0;
					}
					if(isset($_POST['versturen'])) {
						include("../inc/connection.php");
						$query2 = "SELECT
							COUNT(ovnummer)
						FROM
							register
						WHERE
							ovnummer=".$_POST['ovnummer'];
						$result2 = mysqli_query($link, $query2) or exit(mysql_error());
						$data2 = [];
						while ($row2 = $result2->fetch_assoc()) {
							$data2[] = $row2;
						}
						if($data2[0]['COUNT(ovnummer)'] >= 1) {
							echo "<h1>Sorry, je bent al aangemeld!</h1><br />";
						} else {
						//timezone setting
						date_default_timezone_set('Europe/London');
						
						$compcode = $_POST['comp1'].$_POST['comp2'];
						
						//registratiedatum naar variable
						$RegisterDate = date('F j o');
						//now lets do time
						$RegDateHash = date('dsG');//wordt gebruikt om de EAN te randomizen. dit is een combinatie van datum, seconden en uur.
						$RegisterTime = date('g\:i A T');
						$eanvar = rand(0, 9);
						$naam = isset($_POST['naam'])?$link->real_escape_string($_POST['naam']):"";
						$achternaam = isset($_POST['achternaam'])?$link->real_escape_string($_POST['achternaam']):"";
						$email = isset($_POST['email'])?$link->real_escape_string($_POST['email']):"";	
						$ovnummer = isset($_POST['ovnummer'])?$link->real_escape_string($_POST['ovnummer']):"";
						$ean = $ovnummer . $RegDateHash . $friet;//EAN wordt gegenereerd dmv van ov nummer + registratie dag + frietkar ja/nee
						$lokaal = isset($_POST['lokaal'])?$link->real_escape_string($_POST['lokaal']):"";
						
							$query = "INSERT
								INTO
									register (naam, achternaam, ovnummer, email, frietkar, compcode, date, time, ean, lokaal)
								VALUES ('$naam', '$achternaam', '$ovnummer', '$email', '$friet', '$compcode', '$RegisterDate', '$RegisterTime', '$ean', '$lokaal') ";
							$link->query($query);
							echo "<h1>Bedankt voor je aanmelding!</h1></br>";
							echo "<h2>Print deze pagina uit, deze heb je nodig om binnen te komen!</h2>";
							echo "naam:  $naam</br>";
							echo "achternaam:  $achternaam</br>";
							echo "leerlingnumer:  $ovnummer</br>";
							echo "gekozen lokaal: $lokaal</br>";
							echo '<img id="barcode" style="width: 300px !important; height: 300px !important;" src="../barcode/sample-gd.php?ean='.$ean.'" /><br /><br />';
							echo "onderstaande informatie is voor de mensen die je ticket controleren.</br>";
							echo "<p>indien geen barcode, typ volgende EAN in:</p></br>";
							echo "<h2>".$ean."</h2></br>";
							echo $compcode." ".$friet;
							
							$content = array(
								"naam" => $naam,
								"achternaam" => $achternaam,
								"ovnummer" => $ovnummer,
								"email" => $email,
								"lokaal" => $lokaal,
								"ean" => $ean,
								"compcode" => $compcode,
								"friet" => $friet,	
							);
							$_SESSION['content'] = $content;
							mailTicket($content);
							echo '<br /><input type="submit" name="PDF" id="GenereerPDF" value="Download PDF" onclick="window.open('."'../pdf.php'". ', '."'_blank'".');"';
							}

		} else {

?>
					<form action="" method="post">
						<fieldset>
							<legend><p>Persoonlijke informatie</p></legend>
							<p>Voornaam: *</br>
							<input type="text" id="naam" name="naam" required/></br>
							Achternaam: *</br>
							<input type="text" id="achternaam" name="achternaam" required/></br>
							Leerlingnummer: *</br>
							<input type="text" id="ovnummer" name="ovnummer" maxlength="5" required/></br>
							<span>vul je nummer in waarmee je inlogd op Mijn Leijgraaf zonder nullen (bijvoorbeeld '68639').</br>Oud leerling? stuur een email naar joris albers voor een ticket.</span></br></br>
							<!--E-mail adres:</br>
							<input type="text" id="email" name="email"/></br>-->
							In welk lokaal wil je zitten?</br>
							<select name="lokaal">
								<?php
								echo LokalenTellerAanmeld(12);
								echo LokalenTellerAanmeld(115);
								echo LokalenTellerAanmeld(116); 
								echo LokalenTellerAanmeld(117); 
								echo LokalenTellerAanmeld(118);
								echo LokalenTellerAanmeld(119);
								echo LokalenTellerAanmeld(120);?>
							</select></p>
						</fieldset>
						<fieldset>
							<legend><p>Overige Info</p></legend>
							<p>voor welke competities wil je je aanmelden?</br>
							<select name="comp1">
								<option value="0"></option>
								<option value="1">CS:GO</option>
								<option value="2">League of Ledgends</option>
								<option value="3">Hearthstone</option>
								<option value="4">Rocket League</option>
							</select>
							<select name="comp2">
								<option value="0"></option>
								<option value="1">CS:GO</option>
								<option value="2">League of Ledgends</option>
								<option value="3">Hearthstone</option>
								<option value="4">Rocket League</option>
							</select></p>
						</fieldset>
						<input type="submit" value="versturen" name="versturen" />
					</form>
				</div>
			<?php
		}
		?>
			</div>
		</div>
	</body>
</html>