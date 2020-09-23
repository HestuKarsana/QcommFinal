
<?php

ob_start();
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

class Cetakulang_resi extends CI_Controller //MY_Controller 
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
		$this->Cetakulang_resi();
	}

	public function Cetakulang_resi()
	{   //$this->load->view('order/trans_order');
		$this->load->view('transaksi/cetakulang_resi');
		//$this->load->controllers('GetDetailTran');
		
	}
	public function transaksi_cetak()
	{
        require('code128.php');
	    $nopend_agen=$this->session->userdata('ses_kode_agen');
		$userlogin=$this->session->userdata('ses_id_user');
		$nippos=$this->session->userdata('ses_nippos');
	    $tanggal=date('Ymdh:m:s') ;
		$nomor_nota 	= $this->input->get('idorder');
		$result = array(); 
		$key1 = "c67536e59042f4f7049d441a3a5f71e1";
		$key2 = "cd187b9bff4a84415908698f9793098d";
		$tgl=date('Ymd') ;
		$password="05144f4e12aaa402aeb51ef2c7dde527";//MD5($key1 + $tgl + "201" + "3171030101710005" + $key2);
		$username="ecom";
		$gab=base64_encode($username.$password);
		
		$messtype="303";//"201";	
		$userid="dede123";
		$param1="975364534|123456789987654321";//;$_POST['IdOrder'];//"3171030101710005";
		$param2="";
		$param3="";
		$param4="";
		$param5="";
		
		$sp_name = 'Ipos_GetIdkolektingBayar';//'Ipos_ReportRekap';//'Ipos_getPosting';
		$par_data= $nomor_nota.'|'.$nippos.'|'.$nopend_agen.'|02';//$userlogin.'|'.$tg1.'|'.$tg2;//'2019-12-17|2019-12-24';//'00|40000|40511C1|EC2|2019-12-17|2019-12-17';//'900000001|2019-12-19';
		$hash=strtolower (MD5('ecom'.$sp_name.$par_data.$tgl));
			$data_string = '{
				"sp_nama":"'.$sp_name.'",
				"par_data":"'.$par_data.'",
				"hashing":"'.$hash.'"}';
		

		//print_r("<br>Data ".$par_data);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "https://qcomm.posindonesia.co.id:10444/getreport");  
		
				curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 20);
				curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");  
				curl_setopt($ch, CURLOPT_POST, true);                                                                   
				curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);     
				curl_setopt($ch, CURLOPT_USERPWD, $username.':'.$password);
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
				curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC); 
				curl_setopt($ch, CURLOPT_HTTPHEADER, array(   
					'Accept: application/json',
					'Content-Type: application/x-www-form-urlencoded')                                                           
				);
	
		
		$response1 = curl_exec($ch);
		$err1 = curl_error($ch);
		curl_close($ch);
		$response = json_decode($response1, true);
		//print_r("<br>Data ".$response1);
		
		$jmlproduk=$response['jmldata'];
		$data=$response['recordnya'];
	    $code = $data[0]['rc']; 
		$dsk= $data[0]['desk_mess']; 
		if($code=='00')
		{
				$par1= $data[0]['keterangan1'];
				$par2= $data[0]['keterangan2'];
				$par3= $data[0]['keterangan3'];
				$par4= $data[0]['keterangan4'];
				$datasip=explode("|",$par3);
						$nmsip=$datasip[0];
						$almsip=$datasip[1];
						$kdposip=$datasip[7];
						$tlpsip=$datasip[8];
						
				$almsip1=substr($almsip,0,50);
				$almsip2=substr($almsip,50,strlen($almsip));
				$datasial=explode("|",$par4);
						$nmsial=$datasial[1];
						$almsial=$datasial[2]." ".$datasial[3]." ".$datasial[4]." ".$datasial[5]." ".$datasial[7]." ".$datasial[8]." ".$datasial[9]." ".$datasial[10]." ".$datasial[11];
						$kdposial=$datasial[12];
						$tlpsial=$datasial[13];
				$almsial1=substr($almsial,0,50);
				$almsial2=substr($almsial,50,strlen($almsial));
				$datakiriman=explode("|",$par2);
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
				
				$pdf=new PDF_Code128('P','mm','A5');

				$pdf->AddPage();
				$pdf->SetMargins(10,1,10);
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
				$pdf->Cell(10, 4, "#Cetak Ulang",0,0,'L');
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
				$pdf->Cell(50, 4, substr($almsip1,0,80), 0, 0, 'L'); 
				//$pdf->Cell(25, 4, str_pad("ALAMAT", 10, " ", STR_PAD_RIGHT).str_pad(":", 3, " ", STR_PAD_LEFT).str_pad($almsip1, 30, " ", STR_PAD_RIGHT), 0, 0, 'L'); 
				$pdf->Ln();
				$pdf->Cell(10, 4, " ",0,0,'L');
				$pdf->Cell(20, 4, ":",0,0,'R');
				$pdf->Cell(50, 4, substr($almsip2,0,80), 0, 0, 'L'); 
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
				$pdf->Cell(50, 4, substr($almsial1,0,80), 0, 0, 'L'); 
				$pdf->Ln();
				$pdf->Cell(10, 4, " ",0,0,'L');
				$pdf->Cell(20, 4, ":",0,0,'R');
				$pdf->Cell(50, 4, substr($almsial2,0,80), 0, 0, 'L'); 
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
				$pdf->SetMargins(10,1,10);
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
				$pdf->Cell(10, 4, "#Cetak Ulang",0,0,'L');
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
				$pdf->Cell(50, 4, substr($almsip1,0,80), 0, 0, 'L'); 
				//$pdf->Cell(25, 4, str_pad("ALAMAT", 10, " ", STR_PAD_RIGHT).str_pad(":", 3, " ", STR_PAD_LEFT).str_pad($almsip1, 30, " ", STR_PAD_RIGHT), 0, 0, 'L'); 
				$pdf->Ln();
				$pdf->Cell(10, 4, " ",0,0,'L');
				$pdf->Cell(20, 4, ":",0,0,'R');
				$pdf->Cell(50, 4, substr($almsip2,0,80), 0, 0, 'L'); 
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
				$pdf->Cell(50, 4, substr($almsial1,0,80), 0, 0, 'L'); 
				$pdf->Ln();
				$pdf->Cell(10, 4, " ",0,0,'L');
				$pdf->Cell(20, 4, ":",0,0,'R');
				$pdf->Cell(50, 4, substr($almsial2,0,80), 0, 0, 'L'); 
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
					
		}else{
			$result = array('rc_mess'=> $code['rc_mess'],'desk_mess'=>$dsk);
			echo json_encode($result);
		}
		
	}
	/*
public function transaksi_cetak_ulang()
	{
        require('code128.php');
	    $tanggal=date('Ymdh:m:s') ;
	    $barcode 	= $this->input->get('idorder');
		$nopend_agen=$this->session->userdata('ses_kode_agen');
		$userlogin=$this->session->userdata('ses_nippos');
		
			$result = array(); 
		$key1 = "c67536e59042f4f7049d441a3a5f71e1";
		$key2 = "cd187b9bff4a84415908698f9793098d";
		$tgl=date('Y-m-d') ;
		$password="05144f4e12aaa402aeb51ef2c7dde527";//MD5($key1 + $tgl + "201" + "3171030101710005" + $key2);
		$username='ecom';//"getreport";
		$gab=base64_encode($username.$password);

		$sp_name = 'Ipos_GetIdkolektingBayar';//'Ipos_ReportRekap';//'Ipos_getPosting';
		$par_data= $barcode'|'.$userlogin.'|'.$nopend_agen.'|02';//$userlogin.'|'.$tg1.'|'.$tg2;//'2019-12-17|2019-12-24';//'00|40000|40511C1|EC2|2019-12-17|2019-12-17';//'900000001|2019-12-19';
		$hash=strtolower (MD5('ecom'.$sp_name.$par_data.$tgl));
			$data_string = '{
				"sp_nama":"'.$sp_name.'",
				"par_data":"'.$par_data.'",
				"hashing":"'.$hash.'"}';
		//print_r("<br>Data ".$par_data);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "https://qcomm.posindonesia.co.id:10444/getreport");  
				curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 20);
				curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");  
				curl_setopt($ch, CURLOPT_POST, true);                                                                   
				curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);     
				curl_setopt($ch, CURLOPT_USERPWD, $username.':'.$password);
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
				curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC); 
				curl_setopt($ch, CURLOPT_HTTPHEADER, array(   
					'Accept: application/json',
					'Content-Type: application/x-www-form-urlencoded')                                                           
				);
		$response1 = curl_exec($ch);
		$err1 = curl_error($ch);
		curl_close($ch);
		$response = json_decode($response1, true);
		
		$data=$response['recordnya'];
		$par1=$data[0]['keterangan1'];
		$par2=$data[0]['keterangan2'];
		$par3=$data[0]['keterangan3'];
		$par4=$data[0]['keterangan4'];

		$nomor_nota 	= $barcode;
		$datasip=explode("|",$par3);
				$nmsip=$datasip[0];
				$almsip=$datasip[1];
				$kdposip=$datasip[7];
				$tlpsip=$datasip[8];
				
		$almsip1=substr($almsip,0,50);
		$almsip2=substr($almsip,50,strlen($almsip));
		$datasial=explode("|",$par4);
				$nmsial=$datasial[1];
				$almsial=$datasial[2]." ".$datasial[3]." ".$datasial[4]." ".$datasial[5]." ".$datasial[7]." ".$datasial[8]." ".$datasial[9]." ".$datasial[10]." ".$datasial[11];
				$kdposial=$datasial[12];
				$tlpsial=$datasial[13];
		$almsial1=substr($almsial,0,50);
		$almsial2=substr($almsial,50,strlen($almsial));
				
				
		$datakiriman=explode("|",$par2);
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
	}	*/
	
}
//echo "<script type='text/javascript' src='qrcode.js'></script>";
?>
