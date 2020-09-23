<?php 
		$parLogin=explode('|',$_POST['sesslog']);
		$usernamenya=$parLogin[0];
		$passwordnya=$parLogin[1];
		$jnslogin=$parLogin[2];
		$balikan=$_POST['sesslog'];
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
		$userid=$usernamenya;
		$passMD5=MD5($userid.$passwordnya);
		$param1=$usernamenya."|".$passMD5."|03";
		*/
		$messtype="303";//"201";	
		//$userid=$usernamenya;//"440000024";
		$keyNya='ecom2020';
		if ($jnslogin=='01') {
				$passMD5=MD5($usernamenya.$passwordnya);
				$param1=$userid.'|'.$passMD5.'|'.$jnslogin;
		} else if ($jnslogin=='02') {
				$passMD5=MD5($usernamenya.$keyNya.$passwordnya);
				$param1=$userid.'|'.$passMD5.'|'.$jnslogin;
		}
		
		//$param1=$usernamenya."|".$passMD5."|".$jnslogin;//;$_POST['IdOrder'];//"3171030101710005";
		//$param1="3171030101710005";
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
						//$url=base_url();
						$pesannya = "99|Tidak terhubung ke service";
						//echo $this->session->set_flashdata('msg',$error_login);
						//redirect($url);
						
					} 
					else{
						
									if($code<>'00') {
										//$url=base_url();
												$error_login = $response['desk_mess'];
										//		redirect($url);
										$pesannya = "99|".$error_login;		
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
													$this->session->set_userdata('ses_level',$jnslogin);
													/*
													if ($jnslogin=='01') {
														$this->session->set_userdata('ses_level','01');
														$this->session->set_userdata('ses_level_caption','Agenpos');
													} else if ($jnslogin=='02') {
														$this->session->set_userdata('ses_level','02');
														$this->session->set_userdata('ses_level_caption','Pebisnis Online');
													}
													*/
													$this->session->set_userdata('ses_kode_agen',$kodeagen);
													$this->session->set_userdata('ses_nopen',$nopenagen);
													$this->session->set_userdata('ses_jml_transaksi',$jml_transaksi);
													$this->session->set_userdata('ses_bsu_transaksi',$bsu_transaksi);
													
													$this->session->set_userdata('ses_tmp_jml_transaksi',0);
													$this->session->set_userdata('ses_tmp_bsu_transaksi',0);
													$this->session->set_userdata('ses_tmp_item_transaksi','');
													$pesannya = "00|".$jnslogin;
													//redirect('home');
													/*
													if ($jnslogin=='01') {
														redirect('qcomm');
													} else if ($jnslogin=='02') {
														redirect('order');
													}
													*/
													
															
									};

						}
		 echo $pesannya;//.'user '. $usernamenya. 'pass '. $passwordnya .' login '.$jnslogin;
		 //return 0;

         
    }
	
	
		public function masuk()
    {
		$username=htmlspecialchars($this->input->post('username',TRUE),ENT_QUOTES);
        $password=htmlspecialchars($this->input->post('password',TRUE),ENT_QUOTES);
		
        $cek_user = $this->Form_model->getuser($username,$password);
		/*
		if ($cek_user) {
			$data = array('success' => false, 'msg'=> 'Login sukses '.$cek_user);	
		} else {
			$data = array('gagal' => false, 'msg'=> 'Login sukses '.$cek_user);		
			
		}
		*/
		$data = array('success' => true, 'msg'=> 'Login sukses ');
		
        echo $data;
		?>
