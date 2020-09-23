<?php
ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class SetBayar2 extends CI_Controller {

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
		$this->load->view('transaksi/bayar_resi');
		
	}
	
	
	public function set_bayar()
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
		// $jmltrx=$_POST['JmlTrx'];
		// $bsutrx=$_POST['BsuTrx'];
		// $idordernya=$_POST['IdOrder'];
		//$this->session->set_userdata('ses_kode_agen',$kodeagen);
		$nopend_agen=$this->session->userdata('ses_kode_agen');
		$userlogin=$this->session->userdata('ses_id_user');
		$nippos=$this->session->userdata('ses_nippos');
		
		$userid=$userlogin;//"440000024";
		
		$Norek_Giro=$_POST['idrek'];//'0000000059';
		$Nomor_Token=$_POST['idtoken'];//'447850';
		$Total_BSU=$_POST['bsuKirnya'];//'18500';
		$UserID_Agen=$userlogin;//'970341064';
		$jumlah_Kolekting=$_POST['jmlKirnya'];//'1';
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
						
					if($Total_BSU<>$subtotal){
						$result = array
						  (
							  'rc_mess'=> '99',
							  'desk_mess'=>'Besar uang yang diinput tidak sesuai besar uang kirimannya'
						   );
						
					}else
					{
						
						$param1 = $Norek_Giro."|".$Nomor_Token."|".$Total_BSU."|".$UserID_Agen;
						$param2 = $jumlah_Kolekting."^".$data5;//."|".$noQOB2."|".$noQOB3;

						
						// $param1=$tgl."|".$_POST['IdOrder']."|".$userid."|".$userlogin."|".$nopend_agen;//"3171030101710005";
						// $param2=$_POST['Param2'];
						$param3="";
						$param4="";
						$param5="";
						
						//------------------------------------------------------------------------------------
						
						//------------------------------------------------------------------------------------
						//$hash=strtolower (MD5($key1.$tgl.$messtype.$param1.$key2));
						
						$hash=strtolower (MD5($key1.$tgl.$messtype.$param1.$key2));
							$data_string = '{
								"messtype":"'.$messtype.'",
								"param1":"'.$param1.'",
								"userid":"'.$userid.'",
								"param2":"'.$param2.'",
								"param3":"'.$param3.'",
								"param4":"'.$param4.'",
								"param5":"'.$param5.'",
								"hashing":"'.$hash.'"}';
							
					
						
						$ch = curl_init();
						//curl_setopt($ch, CURLOPT_URL, "https://magenpos.posindonesia.co.id:6466/a767e8eec95442bda80c4e35e0660dbb");  
						curl_setopt($ch, CURLOPT_URL, "https://qcomm.posindonesia.co.id:10444/a767e8eec95442bda80c4e35e0660dbb"); 
						
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
						//print_r("<br>".$response1."<br>");
						
						
						curl_close($ch);
						
						$response = json_decode($response1, true);
						//print_r($response);
						$code = $response['rc_mess']; 
				//		$code =$response['rc_mess'];
						//print_r("<br>Hasil".$code);
				//		print_r("<br>".$hash);
						//print_r("<br>".$data_string);
						
						if ($response =='') {
							$result["success"] = false;
							$result["errors"]["iderror"] = "801";
							$result["errors"]["error"] = "Data tidak ditemukan";
						} 
						else{
							
							if($code<>'00') {
								$result["success"] = false;
								// $result["errors"]["iderror"] = $code;
								// $result["errors"]["error"] = $response['desk_mess'] ; 
								
								
											
											
								$result = array('rc_mess'=> $response['rc_mess'],'desk_mess'=>$response['desk_mess']
								);
								// $result = array
									  // (
										  // 'rc_mess'=> $response['rc_mess'],
										  // 'desk_mess'=>$response['desk_mess'].'|'.$response_ipos['respmsg'],
										  // 'respcode'=> $response_ipos['respcode'],
										  // 'respmsg'=>$response_ipos['respmsg']
									   // );
								
							}else 
							{
								$result["success"] = true;
								
								
									 
									  ### SERVICE COLLECTING
											//$param_barcode = character($_POS['param_barcode']);
											//echo "Hasil ".$data;
											//$param_barcode = character('QOB120148662159|');
											//$param_barcode = character($data);
											$param_barcode = $data5."|";
											$totalpipe = substr_count($param_barcode,"|");
											$barcode = explode("|",$param_barcode);
											//$content =$barcode[0];
											for ($i=0;$i<$totalpipe;$i++) 
											{
												$content = '{"barcode":"'.$barcode[$i].'"}';
												$curl = curl_init("http://10.32.41.108:8280/ecom/1.0.0/sendjsonecom");
												curl_setopt($curl, CURLOPT_HEADER, false);
												curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
												curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
												curl_setopt($curl, CURLOPT_POST, true);
												curl_setopt($curl, CURLOPT_POSTFIELDS, $content);
												$json_response = curl_exec($curl);
												curl_close($curl);
												
												$response_ipos = json_decode($json_response, true);
												
												
												//print_r($response);
											}
											
											### END SERVICE COLLECTING
											
								$result = array
									  (
										  'rc_mess'=> $response['rc_mess'],
										  'desk_mess'=>$response['desk_mess'].'|'.$response_ipos['respcode'].'|'.$content,
										  'respcode'=> $response_ipos['respcode'],
										  'respmsg'=>$response_ipos['respmsg']
									   );	
							}
						}
					}
					
		}else{
			$result = array('rc_mess'=> $code,'desk_mess'=>$dsk);
			//echo json_encode($result);
			
		}
		/*=========================================================*/
		
		echo json_encode($result);
		//return json_encode($result);
	}
	
	
}