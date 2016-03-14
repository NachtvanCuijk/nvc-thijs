<?php
//////////////////////////// WAARSCHUWING! ////////////////////////////
//LET OP!!! in dit script staan wachtwoorden in plain text!
//laat deze niet uitlekken!

//Dit is een script dat de gegenereerde tickets automatischemailed naar de leerlingen.
//In dit script wordt het email adres automatisch gegenereerd door het ovnummer
//
////////////////////////////////////////////////////////////////
function mailTicket($content) {
	require 'PHPMailer-master/PHPMailerAutoload.php';

	$mail = new PHPMailer;
	
	//hier komt de content van de email
	$body = 		"Beste ".$_SESSION['content']['naam'].",<br /><br />Bedankt voor je aanmelding!<br />Om te voorkomen dat je je ticket kwijtraakt mailen we je een kopietje. Je hebt deze namelijk nodig om binnen te komen.<br /><br />Met vriendelijke groet,<br />Organisatie Nacht Van Cuijk<br /><br />";
	$bodyTicket = 	"naam:  ".$_SESSION['content']['naam']."<br />achternaam:  ".$_SESSION['content']['achternaam']."<br />leerlingnumer:  ".$_SESSION['content']['ovnummer']."<br />gekozen lokaal: ".$_SESSION['content']['lokaal']."<br />".'<img id="barcode" style="width: 300px !important; height: 300px !important;" src="http://84.29.137.152/barcode/sample-gd.php?ean='.$_SESSION['content']['ean'].'.gif" /><br /><br />'."onderstaande informatie is voor de mensen die je ticket controleren.<br /><p>indien geen barcode, typ volgende EAN in:</p><br /><h2>".$_SESSION['content']['ean']."</h2><br />".$_SESSION['content']['compcode']." ".$_SESSION['content']['friet'];

	// de variabelen van de mail
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