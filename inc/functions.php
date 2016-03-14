<?php
require("connection.php");
function getPosts($daLink) {
    $query = "SELECT
        *
    FROM
        posts";
    $result = mysqli_query($daLink, $query);
    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    $amount = count($data) - 1;
    for ($i = $amount; $i >= 0; $i--) {
        echo "<div class='post'>";
        if (isset($_SESSION['name'])) {
            echo '<div class="buttons">
                <button class="btn btn-danger" id="delete"><span class="glyphicon glyphicon-remove"></span> Verwijderen</button>&nbsp;&nbsp;&nbsp;
                <button class="btn btn-primary" id="edit"><span class="glyphicon glyphicon-pencil"></span> Bewerken</button>
            </div>';
            $id = $data[$i]['id'];
            echo "<input type='hidden' value=\"$id\" id='postid'>";
        }
        echo "<h1>", $data[$i]['title'] ,'</h1>';
        echo '<p style="font-size: 20px;" class="post-text">', nl2br($data[$i]['body']), '</p>';
		echo '<p class="post-footer">';
		echo "</p>";
		echo "<hr />";
        echo "</div>";
    }
}
function AlGebruikt($data) {
	if($data[0]["COUNT(isbinnen)"] >= 1) {
		echo '<h1 class="noaccess">WAARSCHUWING!!! dit ticket is a gebruikt!!!</h1>';
	} else {
		echo " ";
	}
}
function LokalenTellerAanmeld($lokaal) {
	if($lokaal == 116 || $lokaal == 117 || $lokaal == 118 || $lokaal == 120) {
		$MaxAantal = 20;
	} elseif($lokaal == 115) {
		$MaxAantal = 35;
	} elseif($lokaal == 119) {
		$MaxAantal = 80;
	} elseif($lokaal == 12) {
		$MaxAantal = 45;
	}
	
	$host = "127.0.0.1";
	$username = "root";
	$password = "";
	$dbname = "conventionapp";
	$link = new mysqli($host, $username, $password, $dbname);
	
	$query2 = "SELECT COUNT(lokaal) FROM register WHERE lokaal = ".$lokaal;	
	$result2 = mysqli_query($link, $query2) or exit(mysql_error());
	$data2 = [];
	while ($row2 = $result2->fetch_assoc()) {
		$data2[] = $row2;
	}
	if($data2[0]['COUNT(lokaal)'] < $MaxAantal) {
		if($lokaal == 12) {
			$output = '<option value="aula">Aula</option>';
		} else {
			$output = '<option value="'.$lokaal.'">Lokaal '.$lokaal.'</option>';	
		}
	} else {
	}
	return $output;
}
function mailTicket($content) {
	require '../PHPMailer-master/PHPMailerAutoload.php';

	$mail = new PHPMailer;
							
	$body = 		"Beste ".$_SESSION['content']['naam'].",<br /><br />Bedankt voor je aanmelding!<br />Om te voorkomen dat je je ticket kwijtraakt mailen we je een kopietje. Je hebt deze namelijk nodig om binnen te komen.<br /><br />Met vriendelijke groet,<br />Organisatie Nacht Van Cuijk<br /><br />";
	$bodyTicket = 	"naam:  ".$_SESSION['content']['naam']."<br />achternaam:  ".$_SESSION['content']['achternaam']."<br />leerlingnumer:  ".$_SESSION['content']['ovnummer']."<br />gekozen lokaal: ".$_SESSION['content']['lokaal']."<br />".'<img id="barcode" style="width: 300px !important; height: 300px !important;" src="http://84.29.137.152/barcode/sample-gd.php?ean='.$_SESSION['content']['ean'].'.gif" /><br /><br />'."onderstaande informatie is voor de mensen die je ticket controleren.<br /><p>indien geen barcode, typ volgende EAN in:</p><br /><h2>".$_SESSION['content']['ean']."</h2><br />".$_SESSION['content']['compcode']." ".$_SESSION['content']['friet'];

	$mail->SMTPDebug = 0;
	$mail->isSMTP();  // telling the class to use SMTP
	$mail->SMTPAuth   = true;                // enable SMTP authentication
	$mail->Port       = 465;                  // set the SMTP port
	$mail->Host       = "smtp.gmail.com"; // SMTP server
	$mail->Username   = "nvctickets@gmail.com"; // SMTP account username
	$mail->Password   = "N@chtvanCu!jk";     // SMTP account password
	$mail->SMTPSecure = 'ssl';

	$mail->setFrom('nachtvancuijk@gmail.com', 'NVC Tickets');
	$mail->addAddress("00".$_SESSION['content']['ovnummer']."@rocdeleijgraaf.nl", $_SESSION['content']['naam']);
	
	$mail->isHTML(true);

	$mail->Subject   = 'Ticket Nacht Van Cuijk';
	$mail->Body      = $body.$bodyTicket;
	
	if(!$mail->send()) {
    return 'Message could not be sent.';
    return 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    return 'Message has been sent';
}
}
?>