<?php
//Dit is het script dat de tickets controleert bij de ingang
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
						if(isset($_POST['versturen'])) {
							require("inc/connection.php");
							
							//hier worden de variabelen ingesteld
							$furtherinfo =	true;
							$ovnummer = 	$_POST['ovnummer'];
							$ean =			$_POST['ean'];
							
							//query die alle mensen zoekt waar het ingevulde OV nummer overeen komt
							$query = "SELECT
								*
							FROM
								register
							WHERE
								ovnummer=".'"'.$ovnummer.'"';
							
							$result = mysqli_query($link, $query);
							$data = [];
							while ($row = $result->fetch_assoc()) {
								$data[] = $row;
							}
							
							//Query die telt hoeveel mensen er zijn waar het ovnummer hetzelfde is als het ingevulde EN al binnen zijn.
							$query2 = "SELECT
								COUNT(isbinnen)
							FROM
								register
							WHERE
								ovnummer=".$ovnummer." AND isbinnen = 1";
							$result2 = mysqli_query($link, $query2);
							$data2 = [];
							while ($row2 = $result2->fetch_assoc()) {
								$data2[] = $row2;
							}
							
							//wat dit precies deed weet ik niet meer. Ik zal dit zsm uitzoeken
							$alGebruikt = AlGebruikt($data2);
							$amount = count($data) - 1;
							for ($i = $amount; $i >= 0; $i--) {
								if (isset($_SESSION['name'])) {
									$id = $data[$i]['id'];
									echo "<input type='hidden' value=\"$id\" id='postid'>";
								}
								$registratienaam = ($data[$i]['naam']);
								$registratienaam2 = ($data[$i]['achternaam']);
								$registratieovnummer = ($data[$i]['ovnummer']);
								if(($data[$i]['ovnummer']) == $_POST['ovnummer'] && ($data[$i]['ean']) == $_POST['ean']) { //als het ovnummer en ean nummer gelijk zijn doe dit
									echo '<h2 class="okay">Deze bezoeker heeft toegang tot het evenement.</h2></br>';
									echo $alGebruikt;
									echo "<br />";
									$query = "UPDATE register SET isbinnen=1 WHERE ovnummer=".$_POST['ovnummer'];
									$link->query($query);
									if(($data[$i]['frietkar']) == 1) { //als frietkar gekozen is, doe dit
										echo '<h3 class="noaccess">LET OP! De bezoeker heeft behoefte aan de frietkar. Heeft hij/zij het juiste bandje en betaald?!</h3>';
									} else { //als de frietkar NIET gekozen is, doe dit
										echo '<p>deze bezoeker heeft geen behoefte aan de frietkar.</p>';
									}
								} else { //als het ovnummer en/of EAN NIET overeen komen, doe dit
									echo '<h2 class="noaccess">Deze bezoeker heeft GEEN toegang tot het evenement</h2>';
									$furtherinfo = false;
								}
							}
							if(isset($data[$i]['ovnummer'])) { //als het OVnummer in de database bestaat, return die dan
								echo "</br></br><p>OV nummer van deze student: ".($data[0]['ovnummer']);
							} elseif(($data[0]['ean']) != $_POST['ean']) { //Zo niet, dan krijg je errors
								if($furtherinfo == true) {
								echo '<p class="noaccess">hier klopt iets niet</p>';
								echo '<p class="noaccess">Bij de fout &#34;Undefined offset: 0 in C:\xampp\htdocs\checkin.php on line 61&#34;, is &#243;f het ov nummer fout, &#243;f zowel de ean als het ov nummer.</p></br>';
								echo '<p class="noaccess">ga na of je de gegevens van de bezoeker correct hebt ingevuld. als alle gegevens kloppen met het ov nummer in de EAN en op de leijgraaf pas, vraag Thijs-Jan Guelen om in de database na te gaan of de leerling zich daadwerkelijk heeft ingeschreven.</p>';
								echo '<p class="noaccess">mocht de leerling niet in de database bestaan, dan heeft hij/zij G&#201;&#201;N toegang tot dit evenement.</p>';
								} else {
									echo '<p class="noaccess">De ingevulde EAN komt niet overeen met de opgeslagen gegevens die horen bij dit OV nummer.</p>';
									echo '<p class="noaccess">Controleer de EAN op het blaadje, en eventueel met de ingevulde gegevens in de database.</p>';
								}
							}
							echo "</br></br>";
							echo "<p>ingevulde ovnummer: ".$ovnummer;
							echo "</br><p>ingevulde EAN code: ".$ean;
							echo "<p>Volledige naam van student volgens registratie: ".$registratienaam." ".$registratienaam2;
							echo '</br><a href=checkin.php>terug</a>';
						} else {
					?>
					<form action="" method="post">
						ovnummer:</br>
						<input type="text" name="ovnummer" id="ovnummer" /></br>
						ean:</br>
						<input type="text" name="ean" id="ean" /></br>
						<input type="submit" name="versturen" value="versturen" />
					</form>
					<?php
					}
					?>
				</div>
			</div>
		</div>
	</body>
</html>