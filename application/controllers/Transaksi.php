
<?php

//ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * ------------------------------------------------------------------------
 * CLASS NAME : transaksi
 * ------------------------------------------------------------------------
 *
 * @author     Muhammad Akbar <muslim.politekniktelkom@gmail.com>
 * @copyright  2016
 * @license    http://aplikasiphp.net
 *
 */

class Transaksi extends CI_Controller //MY_Controller 
{
	function __construct()
	{
		parent::__construct();
		/*if($this->session->userdata('ap_level') == 'inventory'){
			redirect();
		}
		*/
		$this->load->library('session');
	}

	public function index()
	{
		$this->transaksi();
	}

	public function transaksi()
	{   //$this->load->view('order/trans_order');
		$this->load->view('transaksi/entri_transaksi');
		
	}
	public function transaksi_cetak()
	{
        require('code128.php');
	
        $tanggal=date('Ymdh:m:s') ;
		
		$nomor_nota 	= $this->input->get('idorder');
		$id_kasir		= $this->input->get('pengirim');
		$datasip=explode("|",$id_kasir);
				$nmsip=$datasip[0];
				$almsip=$datasip[1];
				$kdposip=$datasip[7];
				$tlpsip=$datasip[8];
				
		$almsip1=substr($almsip,0,50);
		$almsip2=substr($almsip,50,strlen($almsip));
		$id_pelanggan	= $this->input->get('penerima');
		$datasial=explode("|",$id_pelanggan);
				$nmsial=$datasial[1];
				$almsial=$datasial[2]." ".$datasial[3]." ".$datasial[4]." ".$datasial[5]." ".$datasial[7]." ".$datasial[8]." ".$datasial[9]." ".$datasial[10]." ".$datasial[11];
				$kdposial=$datasial[12];
				$tlpsial=$datasial[13];
		$almsial1=substr($almsial,0,50);
		$almsial2=substr($almsial,50,strlen($almsial));
				
				
		$cash			= $this->input->get('tarif');
		$datakiriman=explode("|",$cash);
				$produk=$datakiriman[0]."-"."QCOMM";
				$pelanggan=$datakiriman[1];
				$backsheet=$datakiriman[2];
				$berat=$datakiriman[3];
				$beadasar=round($datakiriman[4]);
				$htnb=round($datakiriman[5]);
				$ppn=round($datakiriman[6]);
				$ppnhtnb=round($datakiriman[7]);
				$isikiriman=$datakiriman[8];
				$nilaibarang=$datakiriman[9];
				$subtotal=$beadasar+$ppn+$htnb+$ppnhtnb;
		$catatan		= $this->input->get('catatan');
		$grand_total	= $this->input->get('grand_total');

		$pdf=new PDF_Code128('P','mm','A5');

		$pdf->AddPage();
		$pdf->SetMargins(19,1,10);
		$pdf->SetFont('Arial','B',11);
        $pdf->Image(config_item("img").'pos.jpg',20,10,-150);
        $pdf->Image(config_item("img").'qob.jpg',105,10,-350);
        $pdf->Code128(40,10,$nomor_nota,60,10,'C');
		$pdf->Cell(40, 10, "",20,0);
		$pdf->Ln();
		
		$pdf->Cell(110, 5, $nomor_nota, 0, 0, 'C');
		$pdf->Ln();
		$pdf->SetFont('Times','',9);
		$pdf->Cell(10, 4, "",0,0,'L');
		$pdf->Ln();
		$pdf->Cell(10, 4, "Tanggal",0,0,'L');
		$pdf->Cell(20, 4, ":",0,0,'R');
		$pdf->Cell(35, 4, date('Y-m-d H:i:s', strtotime($tanggal)), 0, 0, 'L'); 
		$pdf->Cell(17, 4, "Layanan",0,0,'R');
		$pdf->Cell(5, 4, ":",0,0,'R');
		$pdf->Cell(30, 4, $produk, 0, 0, 'L'); 
		$pdf->Ln();
		$pdf->Cell(10, 4, "Berat (Gram)",0,0,'L');
		$pdf->Cell(20, 4, ":",0,0,'R');
		$pdf->Cell(35, 4, number_format($berat, 0, ',', '.'), 0, 0, 'L'); 
		$pdf->Cell(20, 4, "Isi Kiriman",0,0,'R');
		$pdf->Cell(2, 4, ":",0,0,'R');
		$pdf->Cell(30, 4, $isikiriman, 0, 0, 'L'); 
		$pdf->Ln();
		$pdf->Cell(10, 4, "Nilai Barang",0,0,'L');
		$pdf->Cell(20, 4, ":",0,0,'R');
		$pdf->Cell(50, 4, number_format($nilaibarang, 0, ',', '.'), 0, 0, 'L'); 
		$pdf->Ln();
		$pdf->Ln();
		$pdf->Cell(10, 4, "Nama Pengirim",0,0,'L');
		$pdf->Cell(20, 4, ":",0,0,'R');
		$pdf->Cell(30, 4, $nmsip, 0, 0, 'L'); 
		$pdf->Ln();
		$pdf->Cell(10, 4, "Alamat",0,0,'L');
		$pdf->Cell(20, 4, ":",0,0,'R');
		$pdf->Cell(50, 4, $almsip1, 0, 0, 'L'); 
		//$pdf->Cell(25, 4, str_pad("ALAMAT", 10, " ", STR_PAD_RIGHT).str_pad(":", 3, " ", STR_PAD_LEFT).str_pad($almsip1, 30, " ", STR_PAD_RIGHT), 0, 0, 'L'); 
		$pdf->Ln();
		$pdf->Cell(10, 4, " ",0,0,'L');
		$pdf->Cell(20, 4, ":",0,0,'R');
		$pdf->Cell(50, 4, $almsip2, 0, 0, 'L'); 
		$pdf->Ln();
		$pdf->Cell(10, 4, "Kodepos",0,0,'L');
		$pdf->Cell(20, 4, ":",0,0,'R');
		$pdf->Cell(35, 4, $kdposip, 0, 0, 'L'); 
		$pdf->Cell(10, 4, "Tlp",0,0,'R');
		$pdf->Cell(11, 4, ":",0,0,'R');
		$pdf->Cell(50, 4, $tlpsip, 0, 0, 'L'); 
		$pdf->Ln();$pdf->Ln();
		$pdf->Cell(10, 4, "Nama Penerima",0,0,'L');
		$pdf->Cell(20, 4, ":",0,0,'R');
		$pdf->Cell(30, 4, $nmsial, 0, 0, 'L'); 
		$pdf->Ln();
		$pdf->Cell(10, 4, "Alamat",0,0,'L');
		$pdf->Cell(20, 4, ":",0,0,'R');
		$pdf->Cell(50, 4, $almsial1, 0, 0, 'L'); 
		$pdf->Ln();
		$pdf->Cell(10, 4, " ",0,0,'L');
		$pdf->Cell(20, 4, ":",0,0,'R');
		$pdf->Cell(50, 4, $almsial2, 0, 0, 'L'); 
		$pdf->Ln();
		$pdf->Cell(10, 4, "Kodepos",0,0,'L');
		$pdf->Cell(20, 4, ":",0,0,'R');
		$pdf->Cell(35, 4, $kdposial, 0, 0, 'L'); 
		$pdf->Cell(10, 4, "Tlp",0,0,'R');
		$pdf->Cell(11, 4, ":",0,0,'R');
		$pdf->Cell(50, 4, $tlpsial, 0, 0, 'L');
		$pdf->Ln();
        $pdf->Ln();
        $pdf->Cell(10, 4, "BEA DASAR",0,0,'L');
		$pdf->Cell(20, 4, ":",0,0,'R');
		$pdf->Cell(72, 4, number_format($beadasar, 2, ',', '.'), 0, 0, 'R'); 
		$pdf->Ln();
		$pdf->Cell(10, 4, "PPN",0,0,'L');
		$pdf->Cell(20, 4, ":",0,0,'R');
		$pdf->Cell(72, 4, number_format($ppn, 2, ',', '.'), 0, 0, 'R'); 
		$pdf->Ln();
		$pdf->Cell(10, 4, "HTNB",0,0,'L');
		$pdf->Cell(20, 4, ":",0,0,'R');
		$pdf->Cell(72, 4, number_format($htnb, 2, ',', '.'), 0, 0, 'R'); 
		$pdf->Ln();
		$pdf->Cell(10, 4, "PPN HTNB ",0,0,'L');
		$pdf->Cell(20, 4, ":",0,0,'R');
		$pdf->Cell(72, 4, number_format($ppnhtnb, 2, ',', '.'), 0, 0, 'R'); 
		$pdf->Ln();
		$pdf->Cell(10, 4, "T O T A L (RP)",0,0,'L');
		$pdf->Cell(20, 4, ":",0,0,'R');
		$pdf->Cell(72, 4, number_format($subtotal, 2, ',', '.'), 0, 0, 'R'); 
		
		$pdf->AddPage();
		$pdf->SetMargins(19,1,10);
		$pdf->SetFont('Arial','B',11);
        $pdf->Image(config_item("img").'pos.jpg',20,10,-150);
        $pdf->Image(config_item("img").'qob.jpg',105,10,-350);
        $pdf->Code128(40,10,$nomor_nota,60,10,'C');
		$pdf->Cell(40, 10, "",20,0);
		
		$pdf->Ln();
		$pdf->Ln();
		
		$pdf->Cell(110, 5, $nomor_nota, 0, 0, 'C');
		$pdf->Ln();
		$pdf->SetFont('Times','',9);
		$pdf->Cell(10, 4, "",0,0,'L');
		$pdf->Ln();
		$pdf->Cell(10, 4, "Tanggal",0,0,'L');
		$pdf->Cell(20, 4, ":",0,0,'R');
		$pdf->Cell(35, 4, date('Y-m-d H:i:s', strtotime($tanggal)), 0, 0, 'L'); 
		$pdf->Cell(17, 4, "Layanan",0,0,'R');
		$pdf->Cell(5, 4, ":",0,0,'R');
		$pdf->Cell(30, 4, $produk, 0, 0, 'L'); 
		$pdf->Ln();
		$pdf->Cell(10, 4, "Berat (Gram)",0,0,'L');
		$pdf->Cell(20, 4, ":",0,0,'R');
		$pdf->Cell(35, 4, number_format($berat, 0, ',', '.'), 0, 0, 'L'); 
		$pdf->Cell(20, 4, "Isi Kiriman",0,0,'R');
		$pdf->Cell(2, 4, ":",0,0,'R');
		$pdf->Cell(30, 4, $isikiriman, 0, 0, 'L'); 
		$pdf->Ln();
		$pdf->Cell(10, 4, "Nilai Barang",0,0,'L');
		$pdf->Cell(20, 4, ":",0,0,'R');
		$pdf->Cell(50, 4, number_format($nilaibarang, 0, ',', '.'), 0, 0, 'L'); 
		$pdf->Ln();
		$pdf->Ln();
		$pdf->Cell(10, 4, "Nama Pengirim",0,0,'L');
		$pdf->Cell(20, 4, ":",0,0,'R');
		$pdf->Cell(30, 4, $nmsip, 0, 0, 'L'); 
		$pdf->Ln();
		$pdf->Cell(10, 4, "Alamat",0,0,'L');
		$pdf->Cell(20, 4, ":",0,0,'R');
		$pdf->Cell(50, 4, $almsip1, 0, 0, 'L'); 
		//$pdf->Cell(25, 4, str_pad("ALAMAT", 10, " ", STR_PAD_RIGHT).str_pad(":", 3, " ", STR_PAD_LEFT).str_pad($almsip1, 30, " ", STR_PAD_RIGHT), 0, 0, 'L'); 
		$pdf->Ln();
		$pdf->Cell(10, 4, " ",0,0,'L');
		$pdf->Cell(20, 4, ":",0,0,'R');
		$pdf->Cell(50, 4, $almsip2, 0, 0, 'L'); 
		$pdf->Ln();
		$pdf->Cell(10, 4, "Kodepos",0,0,'L');
		$pdf->Cell(20, 4, ":",0,0,'R');
		$pdf->Cell(35, 4, $kdposip, 0, 0, 'L'); 
		$pdf->Cell(10, 4, "Tlp",0,0,'R');
		$pdf->Cell(11, 4, ":",0,0,'R');
		$pdf->Cell(50, 4, $tlpsip, 0, 0, 'L'); 
		$pdf->Ln();$pdf->Ln();
		$pdf->Cell(10, 4, "Nama Penerima",0,0,'L');
		$pdf->Cell(20, 4, ":",0,0,'R');
		$pdf->Cell(30, 4, $nmsial, 0, 0, 'L'); 
		$pdf->Ln();
		$pdf->Cell(10, 4, "Alamat",0,0,'L');
		$pdf->Cell(20, 4, ":",0,0,'R');
		$pdf->Cell(50, 4, $almsial1, 0, 0, 'L'); 
		$pdf->Ln();
		$pdf->Cell(10, 4, " ",0,0,'L');
		$pdf->Cell(20, 4, ":",0,0,'R');
		$pdf->Cell(50, 4, $almsial2, 0, 0, 'L'); 
		$pdf->Ln();
		$pdf->Cell(10, 4, "Kodepos",0,0,'L');
		$pdf->Cell(20, 4, ":",0,0,'R');
		$pdf->Cell(35, 4, $kdposial, 0, 0, 'L'); 
		$pdf->Cell(10, 4, "Tlp",0,0,'R');
		$pdf->Cell(11, 4, ":",0,0,'R');
		$pdf->Cell(50, 4, $tlpsial, 0, 0, 'L');
		$pdf->Ln();
        $pdf->Ln();
        $pdf->Cell(10, 4, "BEA DASAR",0,0,'L');
		$pdf->Cell(20, 4, ":",0,0,'R');
		$pdf->Cell(72, 4, number_format($beadasar, 2, ',', '.'), 0, 0, 'R'); 
		$pdf->Ln();
		$pdf->Cell(10, 4, "PPN",0,0,'L');
		$pdf->Cell(20, 4, ":",0,0,'R');
		$pdf->Cell(72, 4, number_format($ppn, 2, ',', '.'), 0, 0, 'R'); 
		$pdf->Ln();
		$pdf->Cell(10, 4, "HTNB",0,0,'L');
		$pdf->Cell(20, 4, ":",0,0,'R');
		$pdf->Cell(72, 4, number_format($htnb, 2, ',', '.'), 0, 0, 'R'); 
		$pdf->Ln();
		$pdf->Cell(10, 4, "PPN HTNB ",0,0,'L');
		$pdf->Cell(20, 4, ":",0,0,'R');
		$pdf->Cell(72, 4, number_format($ppnhtnb, 2, ',', '.'), 0, 0, 'R'); 
		$pdf->Ln();
		$pdf->Cell(10, 4, "T O T A L (RP)",0,0,'L');
		$pdf->Cell(20, 4, ":",0,0,'R');
		$pdf->Cell(72, 4, number_format($subtotal, 2, ',', '.'), 0, 0, 'R'); 
		$pdf->Output();
	}
}
//echo "<script type='text/javascript' src='qrcode.js'></script>";
?>
