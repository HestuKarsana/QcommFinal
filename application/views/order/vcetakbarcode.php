<?php
require('code128.php');

$datas=json_decode($kirimans,true);
		//$datas=json_decode($hsl,true);
		extract($datas);
		
//$barcode='QOB212345678901';
//get data 
$barcode=$response_data1;
$arr=explode('|',$response_data4);//explode('|',$datas->response_data4);
//data penerima
$nama = ucfirst($arr[1]);
//$alamat = ucfirst($arr[2]);
$alamat = explode('-',$arr[2]);//ucfirst($arr[2]);
$kota = ucfirst($arr[5]) . ' '.ucfirst($arr[12]);
$prov=ucfirst($arr[9]);
$telp=ucfirst($arr[13]);
//data pengirim
$arr1=explode('|',$response_data3);
$namasip = ucfirst($arr1[0]);
//$alamatsip = ucfirst($arr1[1]). ' '.ucfirst($arr1[2]);
$alamatsip = explode('-',$arr1[1].' '.$arr1[2]);//ucfirst($arr1[1]). ' '.ucfirst($arr1[2]);
$kotasip = ucfirst($arr1[3]) .' - '.ucfirst($arr1[4]) .' '.ucfirst($arr1[7]);
$provsip=ucfirst($arr1[5]);
$telpsip=ucfirst($arr1[8]);


$pdf=new PDF_Code128('P','mm','A4');
$pdf->AddPage();
$pdf->SetFont('Arial','B',10);
$pdf->Image(config_item("img").'logopos.jpg',78,10,-200);
$pdf->Code128(20,10,$barcode,50,8);
//$pdf->SetXY(10,45);
//$pdf->Write(5,$barcode);
//$pdf->Output();
		//$this->load->library('cfpdf');		
		//$pdf = new FPDF('P','mm','A5');
		
		//$pdf->Cell(25, 25, 'Barcode', 0, 0, 'L'); 
		$pdf->Cell(70, 24, $barcode, 0, 0, 'C');
		$pdf->Ln(5);
		$pdf->SetFont('Arial','',6);
		$pdf->Cell(10, 24, '..............................................................................................................................................................', 0);
		$pdf->Ln(15);
		
$pdf->SetFont('Arial','',10);
$pdf->Cell(20, 6, 'Penerima : ', 0);
$pdf->SetFont('Arial','',10);
$pdf->Cell(60, 6, $nama, 0);
$pdf->Ln();
$pdf->Cell(20, 6, ' ', 0);
$pdf->Cell(60, 6, ltrim($alamat[0]), 0);
$pdf->Ln();
$pdf->Cell(20, 6, ' ', 0);
$pdf->Cell(60, 6, ltrim($alamat[1]), 0);
$pdf->Ln();
$pdf->Cell(20, 6, ' ', 0);
$pdf->Cell(60, 6, $kota .' - '.$prov, 0);
$pdf->Ln();
$pdf->Cell(20, 6, ' ', 0);
$pdf->Cell(60, 6, 'Telp .'.$telp, 0);

$pdf->SetFont('Arial','',6);
$pdf->Ln(5);
$pdf->Cell(30, 6, '..............................................................................................................................................................', 0);
		$pdf->Ln(5);
$pdf->SetFont('Arial','',8);
$pdf->Cell(20, 6, 'Pengirim', 0);

$pdf->Cell(60, 6, $namasip, 0);
$pdf->Ln();
$pdf->Cell(20, 6, ' ', 0);
$pdf->Cell(60, 6, ltrim($alamatsip[0]), 0);
$pdf->Ln();
$pdf->Cell(20, 6, ' ', 0);
$pdf->Cell(60, 6, ltrim($alamatsip[1]), 0);
$pdf->Ln();
$pdf->Cell(20, 6, ' ', 0);
$pdf->Cell(60, 6, $kotasip .' - '.$provsip, 0);
$pdf->Ln();
$pdf->Cell(20, 6, ' ', 0);
$pdf->Cell(60, 6, 'Telp .'.$telpsip, 0);

$pdf->SetFont('Arial','',6);
$pdf->Ln(5);
$pdf->Cell(30, 6, '..............................................................................................................................................................', 0);
		$pdf->Ln(5);
//$pdf->Ln();
$pdf->Output();

?>
