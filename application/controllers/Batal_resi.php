
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

class Batal_resi extends CI_Controller //MY_Controller 
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
		$this->Batal_resi();
	}

	public function Batal_resi()
	{   //$this->load->view('order/trans_order');
		$this->load->view('transaksi/batal_resi');
		//$this->load->controllers('GetDetailTran');
		
	}
	public function SaveBatal()
	{
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
				
					
		}else{
			$result = array('rc_mess'=> $code['rc_mess'],'desk_mess'=>$dsk);
			echo json_encode($result);
		}
		
	}
	
}
//echo "<script type='text/javascript' src='qrcode.js'></script>";
?>
