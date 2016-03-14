<?php
ob_start();
require("../inc/connection.php");
include("../inc/functions.php");
?>
<html>
	<head>
		<title>Nacht Van Cuijk</title>
		<link rel="stylesheet" type="text/css" href="../css/style.css">
		<link rel="icon" href="../img/favicon.png">
		<style>
		.post-content {
			padding-left: 30px;
		}
		td {
			min-width: 100px;
			text-align: center;
		}
		.event {
			min-width: 250px;
			border-bottom: 2px solid grey;
		}
		p {
			text-align: left;
		}
		.event:hover {
			-moz-transition: all .2s ease-in;
			-o-transition: all .2s ease-in;
    		-webkit-transition: all .2s ease-in;
    		transition: all .2s ease-in;
			font-size: 20px;
		}
		</style>
	</head>
	<body>
		<div id="topdiv"> <!-- navigatie menu -->
			<?php include '../inc/top.php'; ?>
		</div>
		<div id="content"> 
			<div id="body"><!-- pagina content zelf -->
				<div class="post">
					<div class="post-content">
					<h1>programma</h1>
					<p>De nacht van cuijk zal plaats vinden van 7 op 8 Juli, van 17:00 tot 7:00.<br />
					<table>
						<tr>
							<th><p>Evenement</p></th>
							<th><p>tijd</p></th>
							<th><p>lokaal</p></th>
						</tr>
					<?php
					require("../inc/connection.php");
					$query = "SELECT * FROM planning";	
					$result = mysqli_query($link, $query) or exit(mysql_error());
					$data = [];
					while ($row = $result->fetch_assoc()) {
						$data[] = $row;
					}
					$j = 0;
					$amount = count($data) - 1;
					for ($i = $amount; $i >= 0; $i--) {
						echo '
							<tr>
								<td class="event"><p>'.($data[$j]['evenement']).'</p></td>
								<td><p>'.($data[$j]['tijd']).'</p></td>
								<td><p>'.($data[$j]['lokaal']).'</p></td>
							</tr>
							';
							$j++;
					}
						?>
						</table>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>