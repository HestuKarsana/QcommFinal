<?php
ob_start();
//session_start();
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * ------------------------------------------------------------------------
 * CLASS NAME : Admin
 * ------------------------------------------------------------------------
 * template from :
 * @author     Muhammad Akbar <muslim.politekniktelkom@gmail.com>
 * @copyright  2016
 * @license    http://aplikasiphp.net
 *
 *edited :
 * tanggal : 08-12-2019 
 *@author : dtechno 
 */

class Admin extends CI_Controller 
{
	 public function __construct()
    {
        parent::__construct();
 
        // load Session Library
        $this->load->library('session');
         
        // load url helper
        $this->load->helper('url');
    }
	public function index()
	{
		$this->load->view('secure/login_admin');
		
	}
	
    function auth()
	{
		//$this->load->library('session');
        $usernamenya=htmlspecialchars($this->input->post('usernameadmin',TRUE),ENT_QUOTES);
        $passwordnya=htmlspecialchars($this->input->post('passwordadmin',TRUE),ENT_QUOTES);
		//$jnslogin=htmlspecialchars($this->input->post('jenislogin',TRUE),ENT_QUOTES);
		// --------------------------------------
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
		/*
		$userid="222222222";
		$passw = "*123456#";
		$passwordnya=MD5($userid.$passw);
		//$param1="975364534|123456789987654321|01";//;$_POST['IdOrder'];//"3171030101710005";
		$param1=$userid.'|'.$passwordnya.'|03';
		*/
		$messtype="303";//"201";	
		$userid=$usernamenya;
		$passMD5=MD5($userid.$passwordnya);
		$param1=$usernamenya."|".$passMD5."|03";
		
		$param2="";
		$param3=
		$param4="";
		$param5="";
		//------------------------------------------------------------------------------------
		
		// $messtype="202";	
		// $userid="dede123";
		// $param1="0000000158";
		// $param2="";
		// $param3="";
		// $param4="";
		// $param5="";
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
		
		
		$code = $response['rc_mess']; 
					if ($response =='') { //jk alamat servce tdk ada 
						
						$url=base_url();
												$error_login = "Tidak terhubung ke service";
												echo $this->session->set_flashdata('msg',$error_login);
												
												redirect('admin');
					} 
					else{
						
									if($code<>'00') {
										$url=base_url();
												$error_login = $response['desk_mess'];
												redirect('admin');
									}else {
										    
										    //redirect('order');
											$useridnya=$response["userid"];
											$deskripsi=$response['desk_mess'];
											$kdpetugas=$response['response_data1'];
											$nmpetugas=$response['response_data2'];
											$kodeagen=$response['response_data3'];
											$nopenagen=$response['response_data4'];
											$data_transaksi=$response['response_data5'];
											$data_trans=explode('|',$data_transaksi);
											$jml_transaksi=$data_trans[0];
											$bsu_transaksi=$data_trans[1];
											//$level=$data["level"];
												//echo 'akses '.$akses;
												//return 0;
											//if($akses){			
											
													$this->session->set_userdata('masuk',TRUE);
													
													$this->session->set_userdata('ses_id_user',$useridnya);
													$this->session->set_userdata('ses_id_petugas',$kdpetugas);
													$this->session->set_userdata('ses_nama',$nmpetugas);
													$this->session->set_userdata('ses_level','03');
													
													$this->session->set_userdata('ses_kode_agen',$kodeagen);
													$this->session->set_userdata('ses_nopen',$nopenagen);
													$this->session->set_userdata('ses_jml_transaksi',$jml_transaksi);
													$this->session->set_userdata('ses_bsu_transaksi',$bsu_transaksi);
													redirect('admin/dashboard');
													//$this->load->view('admin/home_admin');
													/*if ($jnslogin=='01') {
														redirect('qcomm');
													} else if ($jnslogin=='02') {
														redirect('order');
													}
													*/
													
															
									};

						}
		 //echo json_encode($data);
		 //return 0;
						
	}

	function logout()
	{
		
		
		$this->session->unset_userdata('masuk',FALSE);
		$this->session->unset_userdata('ses_id_user',$useridnya);
		$this->session->unset_userdata('ses_id_petugas',$kdpetugas);
		$this->session->unset_userdata('ses_nama',$nmpetugas);
		$this->session->unset_userdata('ses_level','03');
		//$this->session->unset_userdata('ses_level_caption','Agen');
		$this->session->unset_userdata('ses_kode_agen',$kodeagen);
		$this->session->unset_userdata('ses_nopen',$nopenagen);
		$this->session->unset_userdata('ses_jml_transaksi',$jml_transaksi);
		$this->session->unset_userdata('ses_bsu_transaksi',$bsu_transaksi);
		redirect('admin');
	}
	public function dashboard()
	{
		$this->load->view('admin/home');
		
	}
	
	public function laporan_rekap()
	{   
		$this->load->view('laporan/adm_laporan_rekap');
	}
	public function laporan_auto_debet()
	{   //$this->load->view('order/trans_order');
		$this->load->view('laporan/adm_laporan_auto_debet');
	}	
	public function laporan_kinerja_pebisol()
	{   //$this->load->view('order/trans_order');
		$this->load->view('laporan/adm_laporan_kinerja_pebisol');
	}
	public function laporan_mutasi_rekening()
	{   
		$this->load->view('laporan/adm_laporan_mutasi_rekening');
	}
	public function pemulihan_user()
	{   
		$this->load->view('laporan/pemulihan_user_pebisol');
	}
	public function kelola_nopen_agen()
	{   
		$this->load->view('laporan/kelola_nopen_agen');
	}


	
}
