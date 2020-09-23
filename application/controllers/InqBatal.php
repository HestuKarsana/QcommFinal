<?php
ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class InqBatal extends CI_Controller {

     public function __construct()
    {
        parent::__construct();
 
        // load Session Library
        $this->load->library('session');
         
        // load url helper
        $this->load->helper('url');
    }
	//$datanya='';
	
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	/* public function index()
	{ 
		$tglawal=date("Y-m-d");
		$tglakhir=date("Y-m-d");
		$data["kirimans"] = $this->torder_model->cekKiriman($tglawal,$tglakhir);
        $this->load->view("v_cetaklabel",$data);
		//$this->load->view("v_formcetak",$data);
	}
	*/
	public function index()
	{
		$this->load->view('transaksi/batal_resi');
		
	}
	
	
	public function set_batal()
	{
			// --------------------------------------
		$result = array(); 
		$key1 = "c67536e59042f4f7049d441a3a5f71e1";
		$key2 = "cd187b9bff4a84415908698f9793098d";
		$tgl=date('Ymd') ;
		$password="05144f4e12aaa402aeb51ef2c7dde527";//MD5($key1 + $tgl + "201" + "3171030101710005" + $key2);
		$username="ecom";
		$gab=base64_encode($username.$password);
		//-----------------------------------------------------------------------------------	
		//$kodepossip=$_POST['kodepossip'];
		$messtype="305";	
	    //$messtype="301";//"201";	
		//$orderDate=date('Ymd hh:mm:ss') ;
		$tanggal=date('Ymdh:m:s') ;
		$orderDate=date('Y-m-d H:i:s', strtotime($tanggal));
		$nopend_agen=$this->session->userdata('ses_kode_agen');
		$userlogin=$this->session->userdata('ses_id_user');
		$nippos=$this->session->userdata('ses_nippos');
		
		$userid=$userlogin;//"440000024";
		
		// $Norek_Giro=$_POST['idrek'];//'0000000059';
		// $Nomor_Token=$_POST['idtoken'];//'447850';
		// $Total_BSU=$_POST['bsuKirnya'];//'18500';
		// $UserID_Agen=$userlogin;//'970341064';
		// $jumlah_Kolekting=$_POST['jmlKirnya'];//'1';
		$data5= strtoupper($_POST['itemKirnya']);
		//$noQOB1=substr($data,0,strlen($data)-1);//'QOB120000192006';
		//$noQOB1=
		/*========================================================*/
		$sp_name = 'Ipos_GetIdkolektingBayar';//'Ipos_ReportRekap';//'Ipos_getPosting';
		$par_data= $data5.'|'.$nippos.'|'.$nopend_agen.'|01';//$userlogin.'|'.$tg1.'|'.$tg2;//'2019-12-17|2019-12-24';//'00|40000|40511C1|EC2|2019-12-17|2019-12-17';//'900000001|2019-12-19';
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
				$par2= $data[0]['keterangan2'];
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
						$subtotal2=number_format($beadasar+$ppn+$htnb+$ppnhtnb,0, ',', '.');
					
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
	
	            $datapengirim="Nama :".$nmsip."\n".
					       "Alamat : ".$almsip."\n".
						   "Tlp :".$tlpsip."\n".	
						   "Kodepos :".$kdposip;
				$datapenerima="Nama :".$nmsial."\n".
					       "Alamat : ".$almsial."\n".
						   "Tlp :".$tlpsial."\n".	
						   "Kodepos :".$kdposial;
						   
					$result = array('rc_mess'=> $code,'desk_mess'=>$dsk,
				                'response_data3'=>$datapengirim,
								'response_data4'=> $datapenerima,
								'nilaibarang'=>$nilaibarang,
								'total2'=>$subtotal2,
								'isikiriman'=>$isikiriman
				);
	
					
		}else{
			$result = array('rc_mess'=> $code,'desk_mess'=>$dsk);
			//echo json_encode($result);
			
		}
		/*=========================================================*/
		
		echo json_encode($result);
		//return json_encode($result);
	}
	
	
}