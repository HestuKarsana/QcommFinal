<?php
//ob_start();
//session_start();
defined('BASEPATH') OR exit('No direct script access allowed');


class Secure extends MY_Controller 
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
		$this->load->view('secure/login_page');
		
	}
    public function auth()
	{
		//$this->load->library('session');
        $usernamenya=htmlspecialchars($this->input->post('username',TRUE),ENT_QUOTES);
        $passwordnya=htmlspecialchars($this->input->post('password',TRUE),ENT_QUOTES);
		$jnslogin=htmlspecialchars($this->input->post('jenislogin',TRUE),ENT_QUOTES);
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
		$userid=$usernamenya;//"440000024";
		$keyNya='ecom2020';
		/*
		if ($jnslogin=='01') {
				$passMD5=MD5($usernamenya.$passwordnya);
				$param1=$usernamenya.'|'.$passMD5.'|'.$jnslogin;
		} else if ($jnslogin=='02') {
				$passMD5=MD5($usernamenya.$keyNya.$passwordnya);
				$param1=$usernamenya.'|'.$passMD5.'|'.$jnslogin;
		}
		*/
		if ($jnslogin=='01') {
					$passMD5=MD5($usernamenya.$passwordnya);
		} else if ($jnslogin=='02') {
					//$passMD5=$passwordnya;
					$passMD5=MD5($usernamenya.$keyNya.$passwordnya);
		}
						
		//$passMD5=MD5($usernamenya.$passwordnya);
		
		$param1=$usernamenya."|".$passMD5."|".$jnslogin;//;$_POST['IdOrder'];//"3171030101710005";
		//$param1="3171030101710005";
		$param2="";
		$param3="";
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
		//curl_setopt($ch, CURLOPT_URL, "http://10.27.0.79:10444/a767e8eec95442bda80c4e35e0660dbb");    
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
		
		
		//curl_close($ch);
		
		$response = json_decode($response1, true);
		
		
		$code = $response['rc_mess']; 
					if ($response =='') { //jk alamat servce tdk ada 
						
						$url=base_url();
												$error_login = "Tidak terhubung ke service";
												echo $this->session->set_flashdata('msg',$error_login);
												
												redirect($url);
					} 
					else{
						
									if($code<>'00') {
										$url=base_url();
												echo  $error_login = $response['desk_mess'];
												redirect($url);
									}else {
										    
										    //redirect('order');
											$useridnya=$response["userid"];
											
											$useridnya2=explode("|",$useridnya1);
											// $useridnya=$useridnya2[0];
											// $nipposnya=$useridnya2[1];
											
											
											$deskripsi=$response['desk_mess'];
											$kdpetugas=$response['response_data1'];
											$useridnya2=explode("|",$kdpetugas);
											$nipposnya=$useridnya2[1];
											
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
													$this->session->set_userdata('ses_nippos',$nipposnya);
													
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
													
													$this->session->set_userdata('ses_tmp_data1','');
													$this->session->set_userdata('ses_tmp_data2','');
													$this->session->set_userdata('ses_tmp_data3','');
													$this->session->set_userdata('ses_tmp_data4','');
													
													//redirect('home');
													if ($jnslogin=='01') {
														redirect('qcomm');
													} else if ($jnslogin=='02') {
														redirect('order');
													}
													
															
									};

						}
		 //echo json_encode($data);
		 //return 0;
						
	}

	public function logout()
	{
		$this->session->unset_userdata('masuk',FALSE);
		/*
		$this->session->unset_userdata('ses_id_user',$useridnya);
		$this->session->unset_userdata('ses_id_petugas',$kdpetugas);
		$this->session->unset_userdata('ses_nama',$nmpetugas);
		$this->session->unset_userdata('ses_level',$jnslogin);
		//$this->session->unset_userdata('ses_level_caption','Agen');
		$this->session->unset_userdata('ses_kode_agen',$kodeagen);
		$this->session->unset_userdata('ses_nopen',$nopenagen);
		$this->session->unset_userdata('ses_jml_transaksi',$jml_transaksi);
		$this->session->unset_userdata('ses_bsu_transaksi',$bsu_transaksi);
		*/
		redirect();
	}
	
	public function kodepos_api( )
	{
					// --------------------------------------
					// Contoh web service dengan respon 1 row
					// Author : Iwan
					// --------------------------------------
					ini_set('soap.wsdl_cache_enabled',0);
					ini_set('soap.wsdl_cache_ttl',0);
					//$barcode=$_POST['txtlacak'];
					//$selKodepos=$this->input->post('selKodepos',TRUE);
					//$selKodepos=preg_replace('""', '', $selKodepos);
					//$selKodepos='cilawu';
					/*
					$kodepossip=$_POST['kodepossip'];
					$kodepossial=$_POST['kodepossial'];
					$berat=$_POST['berat'];
					$anb=$_POST['anb'];*/
					$searchTerm = $this->input->post('searchTerm');
					try {
						// $wsdl=alamat wsdl
					//	$wsdl="http://soa.posindonesia.co.id:9763/services/barc?wsdl";
					//echo base_url('assets/PosWebServices-20161201.wsdl.xml');
						$wsdl=base_url('assets/PosWebServices-20161201.wsdl.xml');  
						//$wsdl='C:\xampp\htdocs\apitarif\PosWebServices-20161201.wsdl.xml';  
						//$wsdl="https://ws.posindonesia.co.id:8161/services/PosWebServices.SOAP12Endpoint/";
						// Parameter input gettarif
						// $a='bppt|123|1|12000|10000|234';
						$userId='iwanaja';
						$password='iwan123456';
						$city ='';

						/*
						request :
						<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ws="https://ws.posindonesia.co.id">
				   <soapenv:Header/>
				   <soapenv:Body>
					  <ws:getPosCodeByAddrAndCity>
						 <ws:userId>iwanaja</ws:userId>
						 <ws:password>iwan123456</ws:password>
						 <ws:city>garut</ws:city>
						 <ws:address>cilawu</ws:address>
					  </ws:getPosCodeByAddrAndCity>
				   </soapenv:Body>
				</soapenv:Envelope>
				.
				response :
				<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/">
				   <soapenv:Body>
					  <rs_postcode xmlns="https://ws.posindonesia.co.id">
						 <r_postcode>
							<posCode>44181</posCode>
							<address>Ds. Cilawu Kec. Cilawu</address>
							<city>KAB. GARUT</city>
						 </r_postcode>
						 <r_postcode>
							<posCode>44181</posCode>
							<address>Ds. Dangiang Kec. Cilawu</address>
							<city>KAB. GARUT</city>
						 </r_postcode>
						 <r_postcode>
							<posCode>44181</posCode>
							<address>Ds. Dawungsari Kec. Cilawu</address>
							<city>KAB. GARUT</city>
						 </r_postcode>
						 <r_postcode>
							<posCode>44181</posCode>
							<address>Ds. Dayeuhmanggung Kec. Cilawu</address>
							<city>KAB. GARUT</city>
						 </r_postcode>
				 <r_fee>
							<serviceCode>240</serviceCode>
							<serviceName>PAKET KILAT KHUSUS (1-2 HARI)</serviceName>
							<fee>8910.89</fee>
							<feeTax>89.11</feeTax>
							<insurance>0.0</insurance>
							<insuranceTax>0.0</insuranceTax>
							<totalFee>9000.0</totalFee>
							<itemValue>0</itemValue>
							<notes>-</notes>
						 </r_fee>
						*/
						// Connect ke web service
						$client=new SoapClient($wsdl);
						$response=$client->getPosCodeByAddrAndCity(array('userId'=>$userId,'password'=>$password,'city'=>$city,'address'=>$searchTerm));
						try 
						{
												$data = array();
												$datanya=$response;
												$datanya=$response->r_postcode;   // asli dari iwan
												for ($i=0; $i<count($datanya); $i++){           
													$ndata=$datanya[$i];   
													$data[] = array("id"=>$ndata->posCode, "text"=>$ndata->address,"kota"=>$ndata->city);
												}
												echo json_encode($data);
												//echo json_encode($data);
						} 	catch (Exception $e) {
						//echo "Exception Error!";
						//echo $e->getMessage();
						//echo 'Data tidak ada!';
						$data[] = array("id"=>'', "text"=>'data tidak ada');
						echo json_encode($data);
					}					
					} catch (Exception $e) {
						//echo "Exception Error!";
						//echo $e->getMessage();
						$data[] = array("id"=>'', "text"=>$e->getMessage());
						echo json_encode($data);
						//echo 'Data tidak ada!';
					}

	}
	
	public function get_ongkir( )
	{
			// --------------------------------------
	// Contoh web service dengan respon 1 row
	// Author : Iwan
	// --------------------------------------
	ini_set('soap.wsdl_cache_enabled',0);
	ini_set('soap.wsdl_cache_ttl',0);
	//$barcode=$_POST['txtlacak'];
	//$selKodepos=$this->input->post('selKodepos',TRUE);
	//$selKodepos=preg_replace('""', '', $selKodepos);
	//$selKodepos='cilawu';
	/*
	$kodepossip=$_POST['kodepossip'];
	$kodepossial=$_POST['kodepossial'];
	$berat=$_POST['berat'];
	$anb=$_POST['anb'];
	*/
	$kodepossip = $this->input->post('kodepossip');
	$kodepossial = $this->input->post('kodepossial');
	$berat = $this->input->post('berat');
	$anb = $this->input->post('anb');
	try {
		// $wsdl=alamat wsdl
	//	$wsdl="http://soa.posindonesia.co.id:9763/services/barc?wsdl";
	//echo base_url('assets/PosWebServices-20161201.wsdl.xml');
		$wsdl=base_url('assets/PosWebServices-20161201.wsdl.xml');  
		//$wsdl="https://ws.posindonesia.co.id:8161/services/PosWebServices.SOAP12Endpoint/";
		// Parameter input gettarif
		// $a='bppt|123|1|12000|10000|234';
		$userId='iwanaja';
		$password='iwan123456';
		$customerId='0'; //retail
		$isDomestic='1'; //kiriman domestik
		$senderPosCode=$kodepossip;//htmlspecialchars($this->input->post('kodepossip',TRUE),ENT_QUOTES);//'44181';
		$receiverPosCode=$kodepossial;//htmlspecialchars($this->input->post('kodepossial',TRUE),ENT_QUOTES);//'40115';
		$weight=$berat;//htmlspecialchars($this->input->post('berat',TRUE),ENT_QUOTES);//'1000';
		$length='0';
		$width='0';
		$height='0';
		$diameter='0';
		$itemValue=$anb;//htmlspecialchars($this->input->post('nb',TRUE),ENT_QUOTES);//'500000'; //harga barang
		/*
		request :
		.
		<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ws="https://ws.posindonesia.co.id">
   <soapenv:Header/>
   <soapenv:Body>
      <ws:getFee>
         <ws:userId>iwanaja</ws:userId>
         <ws:password>iwan123456</ws:password>
         <ws:customerId>0</ws:customerId>
         <ws:isDomestic>1</ws:isDomestic>
         <ws:senderPosCode>44181</ws:senderPosCode>
         <ws:receiverPosCode>40115</ws:receiverPosCode>
         <ws:weight>100</ws:weight>
         <ws:length>0</ws:length>
         <ws:width>0</ws:width>
         <ws:height>0</ws:height>
         <ws:diameter>0</ws:diameter>
         <ws:itemValue>0</ws:itemValue>
      </ws:getFee>
   </soapenv:Body>
</soapenv:Envelope>
.
	response :
	.
	<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/">
   <soapenv:Body>
      <rs_fee xmlns="https://ws.posindonesia.co.id">
         <r_fee>
            <serviceCode>240</serviceCode>
            <serviceName>PAKET KILAT KHUSUS (1-2 HARI)</serviceName>
            <fee>8910.89</fee>
            <feeTax>89.11</feeTax>
            <insurance>0.0</insurance>
            <insuranceTax>0.0</insuranceTax>
            <totalFee>9000.0</totalFee>
            <itemValue>0</itemValue>
            <notes>-</notes>
         </r_fee>
         <r_fee>
            <serviceCode>447</serviceCode>
            <serviceName>EXPRESS NEXT DAY BARANG (1 HARI)</serviceName>
            <fee>11881.19</fee>
            <feeTax>118.81</feeTax>
            <insurance>0.0</insurance>
            <insuranceTax>0.0</insuranceTax>
            <totalFee>12000.0</totalFee>
            <itemValue>0</itemValue>
            <notes>-</notes>
         </r_fee>
         <r_fee>
            <serviceCode>PDG</serviceCode>
            <serviceName>PAKETPOS DANGEROUS GOODS (3 HARI)</serviceName>
            <fee>12871.29</fee>
            <feeTax>128.71</feeTax>
            <insurance>0.0</insurance>
            <insuranceTax>0.0</insuranceTax>
            <totalFee>13000.0</totalFee>
            <itemValue>0</itemValue>
            <notes>-</notes>
         </r_fee>
         <r_fee>
            <serviceCode>PVG</serviceCode>
            <serviceName>PAKETPOS VALUABLE GOODS (3 HARI)</serviceName>
            <fee>12871.29</fee>
            <feeTax>128.71</feeTax>
            <insurance>0.0</insurance>
            <insuranceTax>0.0</insuranceTax>
            <totalFee>13000.0</totalFee>
            <itemValue>0</itemValue>
            <notes>-</notes>
         </r_fee>
      </rs_fee>
   </soapenv:Body>
</soapenv:Envelope>
		*/
		// Connect ke web service
		$client=new SoapClient($wsdl);
		$response=$client->getFee(array('userId'=>$userId,'password'=>$password,'customerId'=>$customerId,'isDomestic'=>$isDomestic,
										'senderPosCode'=>$senderPosCode,'receiverPosCode'=>$receiverPosCode,'weight'=>$weight,
										'length'=>$length,'width'=>$width,'height'=>$height,'diameter'=>$diameter,'itemValue'=>$itemValue));
		try 
		{
								$data=$response;
								$data=$response->r_fee;   // asli dari iwan
								//<tr><td class="appid">100</td>
								//$datas = array();
								//style="overflow-x:auto;"
								$htmldata='<p><p><table id="tabeltarif" name="tabeltarif" class="table table-bordered table-hover table-responsive">
											<thead>
												<tr>
													<th class="center">
														<label class="pos-rel">
															
															<span class="lbl"></span>
														</label>
													</th>
													<th class="hidden-200">Kode</th>
													<th class="hidden-600">Layanan</th>
													<th>Tarif</th>
													<th>PPN</th>
													<th class="hidden-480">Asuransi</th>
													<th class="hidden-480">PPN Asuransi</th>
													<th class="hidden-480">Total Tarif</th>
												</tr>
											</thead>

											<tbody>';
								for ($i=0; $i<count($data); $i++){           //  asli dari iwan
									$ndata=$data[$i];   
									/*$datas[] = array("kdlayanan"=>$ndata->serviceCode, "nmlayanan"=>$ndata->serviceName,
													"tarif"=>$ndata->fee,"ppn"=>$ndata->feeTax,"anb"=>$ndata->insurance,
													"ppnanb"=>$ndata->insuranceTax,"ongkir"=>$ndata->totalFee,"nilaibarang"=>$ndata->itemValue,
													"catatan"=>$ndata->notes);
													*/
									$data0=trim($ndata->serviceCode);				
									//$data1=trim($ndata->serviceName .'['.$ndata->serviceCode.']');
									$data1=trim($ndata->serviceName);
									$data2=trim($ndata->fee);
									$data3=trim($ndata->feeTax);
									$data4=trim($ndata->insurance);
									$data5=trim($ndata->totalFee);
									$data6=trim($ndata->insuranceTax);
									//echo "<div>".$data1."</div>";
									if (($data0=='210') || ($data0=='240')|| ($data0=='416')|| ($data0=='417')
										 || ($data0=='446')|| ($data0=='447') || ($data0=='Q9') || ($data0=='EC2')	) {
												$htmldata.='<tr><td class="center"><label class="posradio">
															<input name="posradio" type="radio" class="ace" />
															<span class="lbl"></span>
														</label>
														</td>
													<td class="left">'.$data0.'</td>
													<td class="left">'.$data1.'</td>
													<td class="right">'.$data2.'</td>
													<td class="right">'.$data3.'</td>
													<td class="right">'.$data4.'</td>
													<td class="right">'.$data6.'</td>
													<td class="right">'.$data5.'</td>
												</tr>';
											}	
											
								}
								$htmldata.='</tbody></table><p><p><p>';
								echo $htmldata;
								//echo json_encode($datas);
		} 	catch (Exception $e) {
		//echo "Exception Error!";
		//echo $e->getMessage();
		echo 'Data tidak ada!';
	}					
	} catch (Exception $e) {
		echo "Exception Error!";
		echo $e->getMessage();
		//echo 'Data tidak ada!';
	}

		
	}
	public function insOrder()
    {
				// --------------------------------------
		$result = array(); 
		$key1 = "c67536e59042f4f7049d441a3a5f71e1";
		$key2 = "cd187b9bff4a84415908698f9793098d";
		$tgl=date('Ymd') ; //YYMMDD
		
		$password="05144f4e12aaa402aeb51ef2c7dde527";//MD5($key1 + $tgl + "201" + "3171030101710005" + $key2);
		$username="ecom";
		$gab=base64_encode($username.$password);
		//-----------------------------------------------------------------------------------	
		//$kodepossip=$_POST['kodepossip'];
		$messtype="302";//"201";	
		//input dari front end 
				date_default_timezone_set('Asia/Jakarta');
		$orderDate=date("Y-m-d H:i:s");
		$userid="900000001"; //QOB201912120001|9
		//$orderDate='2019-08-19 23:43:21';
		//$PETUGAS=$_POST['PETUGAS'];//htmlspecialchars($this->input->post('username',TRUE),ENT_QUOTES);
		$type='1';
		//$idorder=rand(100000000000,999999999999); //uniqid();
		$idorder='QOB'.rand(10000000000,99999999999);
		$customerId='0';
		$COD=$_POST['COD'];
		$serviceId=$_POST['serviceId'];
		$senderName=$_POST['senderName'];
        $senderAddr=$_POST['senderAddr'];
		$senderVill='-';
		$senderSubDist='-';
		$senderCity='-';//$_POST['kotapengirim'];
		$senderProv='-';
		$senderCountry='-';
		$senderPosCode=$_POST['senderPosCode'];
		$senderEmail=$_POST['senderEmail'];
		$senderPhone=$_POST['senderPhone'];
		
		$receiverName=$_POST['receiverName'];
        $receiverAddr=$_POST['receiverAddr'];
		$receiverVill='-';
		$receiverSubDist='-';
		$receiverCity='-';//$_POST['kotapenerima'];
		$receiverProv='-';
		$receiverCountry='-';
		$receiverPosCode=$_POST['receiverPosCode'];
		$receiverPhone=$_POST['receiverPhone'];
		$receiverEmail=$_POST['receiverEmail'];
		
		
		$weight=$_POST['weight'];
		$fee=$_POST['fee'];
		$feeTax=$_POST['feeTax'];
		$insurance=$_POST['insurance'];
		$insuranceTax=$_POST['insuranceTax'];
		$itemValue=$_POST['itemValue'];
		$contentDesc='-';//$_POST['isikiriman'];
		$no_group_order='001';
		$VA = '60012345678';
		//end of input front end
		//$param1=$tgl."|QOB201912120006|".$userid;//;$_POST['IdOrder'];//"3171030101710005"; QOB123456789222
		$param1=$orderDate."|".$idorder."|".$userid."|".$no_group_order;//;$_POST['IdOrder'];//"3171030101710005"; QOB123456789222
		//$param1="3171030101710005";
		//$param2="EC2|201912121234R|-|200|4500|500|450|20|kasurkarpet|300000|-|-"; //detil kiriman 
		$param2=$serviceId."|".$idorder."|-|".$weight."|".$fee."|".$insurance."|".$feeTax."|".$insuranceTax."|".$contentDesc."|".$itemValue."|-|-"; //detil kiriman 
		//$param3="iwan|jalan cimaragas|cimaragas|cilawu|garut|jawa barat|indonesia|44181|08823765889|iwan@posindonesia.co.id"; //detil pengirim
		$param3=$senderName."|".$senderAddr."|".$senderVill."|".$senderSubDist."|".$senderCity."|".$receiverProv."|".$senderCountry."|".$senderPosCode."|".$senderPhone."|".$senderEmail; //detil pengirim
		//$param4="-|asepso|perumahan cimahi nagok rt 12/23 |-|-|cimahi|cimahi|cimahi|cimahi|jawa barat|-|indonesia|40512|086778836633|022432567|yuyus@posindonesia.co.id|-|-"; //detil penerima
		$param4="-|".$receiverName."|".$receiverAddr."|".$receiverVill."|".$receiverSubDist."|".$receiverCity."|".$receiverProv."|".$receiverCountry."|".$receiverPosCode."|".$receiverPhone."|".$receiverEmail; //detil penerima
		if ($COD=='0') {
			$nilaicod='0';
		} else { $nilaicod=$itemValue;}
		$param5=$COD."|".$nilaicod."|".$VA."|0"; //kode cod (1:COD , 0 : bukan COD)|nilaiCOD|VA|status kiriman = 0 (pra kolekting)
		$hash=strtolower (MD5($key1.$tgl.$messtype.$param1.$key2));
			$data_string = '{
				"messtype":"'.$messtype.'",
				"param1":"'.$param1.'",
				"userid":"'.$userid.'",
				"param2":"'.$param2.'",
				"param3":"'.$param3.'",
				"param4":"'.$param4.'",
				"param5":"'.$param5.'",
				"hashing":"'.$hash.'",
				"wkt_mess":"'.$orderDate.'"		
				}';
			
	
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "https://magenpos.posindonesia.co.id:6466/a767e8eec95442bda80c4e35e0660dbb");    
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
		/*
		{
		"rc_mess":"00","desk_mess":"SUKSES","userid":"900000001",
		"response_data1":"QOB201912120002|900000001",
		"response_data2":"",
		"response_data3":"","response_data4":"",
		"response_data5":"",
		"datatarif":"Bea Dasar : 0\nhtnb : 0\nppn : 0\nppnhtnb : 0","produk":"-QCOMM","total":"0","berat":null}
		*/
		if ($response =='') {
			$result["success"] = false;
			$result["errors"]["iderror"] = "801";
			$result["errors"]["error"] = "Data tidak ditemukan";
			//$response['response_data1']
			//$htmldata='<h3><strong>error<BR> Tidak terhubung ke service</strong></h3>';
			$htmldata='<h1><strong><font color="red">Tidak terhubung ke service</font></strong></h1>';
		} 
		else{
			if($code<>'00') {
				$result["success"] = false;
				$result["errors"]["iderror"] = $code;
				$result["errors"]["error"] = $response['desk_mess'] ; 
				$htmldata='<h1><strong><font color="red">'.$response['desk_mess'].'</font></strong></h1>';
			}else {
				$result["success"] = true;
				/*
				$result = array('rc_mess'=> $response['rc_mess'],'desk_mess'=>$response['desk_mess'],
				                'userid'=> $response['userid'],'response_data1'=>$response['response_data1'],
								'response_data2'=> $response['response_data2'],'response_data3'=>$response['response_data3'],
								'response_data4'=> $response['response_data4'],'response_data5'=>$response['response_data5']
				);
				*/
				$datakiriman=explode("|",$response['response_data1']);
				$idorder=$datakiriman[0];
				//$pelanggan=$datakiriman[1];
				$htmldata='<h3><strong>ID ORDER : </h3><BR><h1>'.$idorder.'</strong></h1>';
			}
		
		
		}
		
		echo $htmldata;
	
	}
	
}
