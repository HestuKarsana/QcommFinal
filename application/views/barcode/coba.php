<?php
require('code128.php');

$pdf=new PDF_Code128();
$pdf->AddPage();
$pdf->SetFont('Arial','',10);
$barcode='QOB220000258182';
$penerima='Asep penerima';
$pengirim='Iwan pengirim';

$pdf->Code128(100,10,$barcode,60,10);
$pdf->Cell(25, 4, 'Barcode', 0, 0, 'L'); 
$pdf->Cell(85, 4, $barcode, 0, 0, 'L');
$pdf->Ln();
//$pdf->SetXY(5,4);
//$pdf->Write(100,$barcode);

/*

$pdf->Cell(25, 4, 'Barcode', 0, 0, 'L'); 
$pdf->Cell(85, 4, $barcode, 0, 0, 'L');
$pdf->Ln();


$pdf->Ln();
$pdf->Cell(130, 5, '-----------------------------------------------------------------------------------------------------------', 0, 0, 'L');
$pdf->Ln();
$pdf->Cell(25, 5, $penerima, 0, 0, 'L');
$pdf->Ln();
$pdf->Cell(130, 5, '-----------------------------------------------------------------------------------------------------------', 0, 0, 'L');
$pdf->Ln();
$pdf->Cell(25, 5, $pengirim, 0, 0, 'L');
$pdf->Ln();
*/
$pdf->Output();
?>