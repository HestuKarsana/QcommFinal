<?php
ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class SimpanData extends CI_Controller {

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
		$this->load->view('transaksi');
		$this->load->view("v_cetakan_resi",$data);
	}
	
	public function cetak_label()
	{
		$idordernya 	= $this->input->get('idorder');
		$param3			=$this->input->get('pengirim');
		$param4			=$this->input->get('penerima');
		$param2			=$this->input->get('tarif');
		//$param2			=$this->input->get('DataCetak');
		
		$data["kirimans"]='{"rc_mess":"00","desk_mess":"SUKSES","userid":"'.$userid.'","response_data1":"'.$idordernya.'",
						"response_data2":"'.$param2.'",
						"response_data3":"'.$param3.'",
						"response_data4":"'.$param4.'"}';
						
		//$data["kirimans"] =$param2;
	$this->load->view("transaksi/cetak_resi",$data);
	//	$this->load->view("transaksi/v_cetakan_resi",$data);
		
	}
	public function set_barcode($code)
	{
		//load library
		$this->load->library('zend');		//load in folder Zend
		$this->zend->load('Zend/Barcode');
		//generate barcode
		Zend_Barcode::render('code128', 'image', array('text'=>$code), array());
	}
	public function Save()
	{
			// --------------------------------------
		$result = array(); 
		$ByrDuit=$_POST['ByrDuit'];
        if(($ByrDuit=='null')or($ByrDuit=='')or($ByrDuit=='0')){
					$result = array(
					      'rc_mess'=> '999','desk_mess'=>'Biaya kirim tidak boleh nol'
				        );
			
		}
		else
		{
					$key1 = "c67536e59042f4f7049d441a3a5f71e1";
					$key2 = "cd187b9bff4a84415908698f9793098d";
					$tgl=date('Ymd') ;
					$password="05144f4e12aaa402aeb51ef2c7dde527";//MD5($key1 + $tgl + "201" + "3171030101710005" + $key2);
					$username="ecom";
					$gab=base64_encode($username.$password);
					//-----------------------------------------------------------------------------------	
					//$kodepossip=$_POST['kodepossip'];
					$messtype="304";	
					//$messtype="301";//"201";	
					$userid="440000024";
					//$orderDate=date('Ymd hh:mm:ss') ;
					$tanggal=date('Ymdh:m:s') ;
					$orderDate=date('Y-m-d H:i:s', strtotime($tanggal));
					
					$jmltrx=$_POST['JmlTrx'];
					$bsutrx=$_POST['BsuTrx'];
					
					$TmpJml=$_POST['TmpJml'];
					$TmpBsu=$_POST['TmpBsu'];
					$TmpItem=$_POST['TmpItem'];
					//TmpJml,TmpBsu:TmpBsu,TmpItem
					$param5=$_POST['Param5'];
					$idordernya=strtoupper($_POST['IdOrder']);
					$datasial=explode("|",$_POST['Param5']);
					$kdposial=$datasial[0];
					//$orderDate="2019-12-17 11:53:20";//$_POST['TglPosting'];
					/*
						$param1="20191213|QOB1247222537|".$userid."|975364534|44100";
						$param2="EC2|xxxx1234R|-|200|4500|500|450|20|pakaian|300000|-|-";
						$param3="dede|jalan cijambe saja|cijambe|ujungberung|bandung|jawa barat|indonesia|40601|08823765889|dede@posindonesia.co.id";
						$param4="-|yuyus|perumahan cimahi nagok rt 12/23 |-|-|cimahi|cimahi|cimahi|cimahi|jawa barat|-|indonesia|40512|086778836633|022432567|yuyus@posindonesia.co.id|-|-";
						$param5="44100|0|0|1|".$orderDate;
					*/
					//$this->session->set_userdata('ses_kode_agen',$kodeagen);
					$nopend_agen=$this->session->userdata('ses_kode_agen');
					$userlogin=$this->session->userdata('ses_id_user');
					$nippos=$this->session->userdata('ses_nippos');
					
					$param1=$tgl."|".strtoupper($_POST['IdOrder'])."|".$nippos."|".$nippos."|".$nopend_agen;//"3171030101710005";
					$param2=$_POST['Param2'];
					$param3=$_POST['Param3'];
					$param4=$_POST['Param4'];
					//$param5=$userid."|"."44100|45100|0|0|1|".$orderDate;
					//$param5=$nopend_agen.$kdposial."|0|0|1|".$orderDate;
					$param5=$kdposial."|0|0|1|".$orderDate;
					
					//------------------------------------------------------------------------------------
					
					//------------------------------------------------------------------------------------
					
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
					curl_setopt($ch, CURLOPT_URL, "https://qcomm.posindonesia.co.id:10444/a767e8eec95442bda80c4e35e0660dbb"); 
					//curl_setopt($ch, CURLOPT_URL, "https://qcomm.posindonesia.co.id:10444/a767e8eec95442bda80c4e35e0660dbb");    
					
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
							
							
						}else 
						{
							$result["success"] = true;
							
							$data='{"rc_mess":"00","desk_mess":"SUKSES","userid":"'.$userid.'","response_data1":"'.$idordernya.'",
									"response_data2":"'.$param2.'",
									"response_data3":"'.$param3.'",
									"response_data4":"'.$param4.'"}';
							$result = array('rc_mess'=> $response['rc_mess'],'desk_mess'=>$response['desk_mess'],'datasave'=>$data
							 );
					
								 $this->session->set_userdata('ses_jml_transaksi',$jmltrx);
								 $this->session->set_userdata('ses_bsu_transaksi',$bsutrx);
					

								 $this->session->set_userdata('ses_tmp_jml_transaksi',$jmltrx);
								 $this->session->set_userdata('ses_tmp_bsu_transaksi',$bsutrx);
								 
								$this->session->set_userdata('ses_tmp_jml_transaksi',$TmpJml);
								$this->session->set_userdata('ses_tmp_bsu_transaksi',$TmpBsu);
								$this->session->set_userdata('ses_tmp_item_transaksi',$TmpItem);
						}
					}
			
		}
		
		echo json_encode($result);
		
	}
	
	
}