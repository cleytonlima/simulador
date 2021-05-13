<?php
require('./fpdf/fpdf.php');



class PDF extends FPDF
{
// Page header
function Header()
{
    // Logo
    $this->Image('./images/Logo.jpg',10,6,30);
    // Arial bold 15
    $this->SetFont('Arial','B',15);
    // Move to the right
    $this->Cell(80);
    // Title
    $this->Cell(30,10,'Title',1,0,'C');
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
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
}

// Instanciation of inherited class
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',12);
$pdf->SetFont('Arial','',11);
$pdf->Cell(190,10,utf8_decode('NOME: '),'T,L,R',1,'L');
$pdf->Cell(190,10,utf8_decode('DATA: '),'L,R',1,'L');
$pdf->Cell(190,5,utf8_decode('LOCAL ORÇAMENTO : '),'L,R,B',0,'L');
$pdf->Ln(15);
$pdf->Output();
?>