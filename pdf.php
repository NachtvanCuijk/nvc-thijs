<?php
session_start();
$content = $_SESSION['content'];

require('fpdf/fpdf.php');
require('PHPMailer-master/class.phpmailer.php');

class PDF extends FPDF
{
// Page header
function Header()
{
    // Logo
    $this->Image('logo.png',10,6,30);
    // Arial bold 15
    $this->SetFont('Arial','B',15);
    // Move to the right
    $this->Cell(60);
    // Title
    $this->Cell(70,10,'Nacht Van Cuijk ticket',1,0,'C');
    // Line break
    $this->Ln(20);
}

// Page footer
function Footer()
{
    // Position at 1.5 cm from bottom
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Page number
    $this->Cell(0,10,'Pagina '.$this->PageNo().'/{nb}',0,0,'C');
}
}

// Instanciation of inherited class
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',14);
    $pdf->Cell(0,10,'',0,1);
	$pdf->Cell(0,10,'',0,1);
    $pdf->Cell(0,10,'',0,1);
    $pdf->Cell(0,10,'    Naam: '.$content['naam'],0,1);
	$pdf->Cell(0,10,'    Achternaam: '.$content['achternaam'],0,1);
	$pdf->Image('http://84.29.137.152/barcode/sample-gd.php?ean='.$content['ean'].'.gif',0,80,100);
	$pdf->Cell(0,10,'    Ovnummer: '.$content['ovnummer'],0,1);
	$pdf->Cell(0,10,'    Lokaal: '.$content['lokaal'],0,1);
	$pdf->Cell(0,10,'',0,1);
	$pdf->Cell(0,10,'',0,1);
	$pdf->Cell(0,10,'',0,1);
	$pdf->Cell(0,10,'',0,1);
	$pdf->Cell(0,10,'',0,1);
	$pdf->Cell(0,10,'',0,1);
	$pdf->Cell(0,10,'    ean: '.$content['ean'],0,1);
	$pdf->Cell(0,10,'    '.$content['compcode'].' '.$content['friet'],0,1);
$pdf->Output();
?>