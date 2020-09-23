<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Pickuporder extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("torder_model");
        $this->load->library('form_validation');
    }

    public function index()
    {
        //$data["products"] = $this->product_model->getAll();
        //$this->load->view("product/list", $data);
		//$data["products"] = $this->product_model->getBarang('BRG001');
        $this->load->view("trans_order");

    }
	
	/*
	$cek_user=$this->login_model->auth_user($username,$password);
 
        if($cek_user->num_rows() > 0){ //jika login sebagai admin
                $data=$cek_user->row_array();
                $this->session->set_userdata('masuk',TRUE);
                if($data['LEVEL']=='1'){ //Akses admin
                    $this->session->set_userdata('akses','1');
                    $this->session->set_userdata('ses_id',$data['IDPENGGUNA']);
                    $this->session->set_userdata('ses_nama',$data['NAMA']);
                    redirect('page');
	postOrder($username,$password){
        $query=$this->db->query("EXEC SP_INS_T_ORDER '$PETUGAS','$IDORDER','$NAMAPENGIRIM','$ALAMATPENGIRIM',
								'$KOTAPENGIRIM','$KODEPOSPENGIRIM','$TELPPENGIRIM','$WAPENGIRIM','$TELEGRAMPENGIRIM','$FBPENGIRIM',
								'$NAMAPENERIMA','$ALAMATPENERIMA','$KOTAPENERIMA','$KODEPOSPENERIMA','$TELPPENERIMA','$WAPENERIMA',
								'$TELEGRAMPENERIMA','$FBPENERIMA','$KDPRODUK','$ISIKIRIMAN','$DESKRIPSI'");		

postOrder($PETUGAS,$IDORDER,$NAMAPENGIRIM,$ALAMATPENGIRIM,
								$KOTAPENGIRIM,$KODEPOSPENGIRIM,$TELPPENGIRIM,$WAPENGIRIM,$TELEGRAMPENGIRIM,$FBPENGIRIM,
								$NAMAPENERIMA,$ALAMATPENERIMA,$KOTAPENERIMA,$KODEPOSPENERIMA,$TELPPENERIMA,$WAPENERIMA,
								$TELEGRAMPENERIMA,$FBPENERIMA,$KDPRODUK,$ISIKIRIMAN,$DESKRIPSI)	
								
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
								$htmldata.='</tbody></table>';
								echo $htmldata;
					
					
	*/
 //$cek_user=$this->login_model->auth_user($username,$password);
	public function postOrder()
    {
		$PETUGAS='9799878798';//htmlspecialchars($this->input->post('username',TRUE),ENT_QUOTES);
		$IDORDER='POS'.rand(100000,999999).'ID';
		$NAMAPENGIRIM=htmlspecialchars($this->input->post('namapengirim',TRUE),ENT_QUOTES);
        $ALAMATPENGIRIM=htmlspecialchars($this->input->post('alamatpengirim',TRUE),ENT_QUOTES);
		$KOTAPENGIRIM=htmlspecialchars($this->input->post('kotapengirim',TRUE),ENT_QUOTES);
		$KODEPOSPENGIRIM=htmlspecialchars($this->input->post('kodepospengirim',TRUE),ENT_QUOTES);
		$TELPPENGIRIM=htmlspecialchars($this->input->post('telppengirim',TRUE),ENT_QUOTES);
		$EMAILPENGIRIM=htmlspecialchars($this->input->post('emailpengirim',TRUE),ENT_QUOTES);
		$NAMAPENERIMA=htmlspecialchars($this->input->post('namapenerima',TRUE),ENT_QUOTES);
        $ALAMATPENERIMA=htmlspecialchars($this->input->post('alamatpenerima',TRUE),ENT_QUOTES);
		$KOTAPENERIMA=htmlspecialchars($this->input->post('kotapenerima',TRUE),ENT_QUOTES);
		$KODEPOSPENERIMA=htmlspecialchars($this->input->post('kodepospenerima',TRUE),ENT_QUOTES);
		$TELPPENERIMA=htmlspecialchars($this->input->post('telppenerima',TRUE),ENT_QUOTES);
		$EMAILPENERIMA=htmlspecialchars($this->input->post('emailpenerima',TRUE),ENT_QUOTES);
		$ISIKIRIMAN=htmlspecialchars($this->input->post('isikiriman',TRUE),ENT_QUOTES);
        //$product = $this->torder_model;
        //$validation = $this->form_validation;
		$addOrder=$this->torder_model->postOrder($PETUGAS,$IDORDER,$NAMAPENGIRIM,$ALAMATPENGIRIM,
								$KOTAPENGIRIM,$KODEPOSPENGIRIM,$TELPPENGIRIM,$EMAILPENGIRIM,'-','-','-',
								$NAMAPENERIMA,$ALAMATPENERIMA,$KOTAPENERIMA,$KODEPOSPENERIMA,$TELPPENERIMA,$EMAILPENERIMA,'-',
								'-','-','-',$ISIKIRIMAN,'-');
        $data=$addOrder->row_array();
        if($data['RESPON']=='000'){ //Akses admin
			echo $this->session->set_flashdata('success', $IDORDER);
		} else {
			echo $this->session->set_flashdata('success', 'Gagal disimpan');
		}		
		/*$validation->set_rules($product->rules());

        if ($validation->run()) {
            $product->save();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
        }
		*/
        $this->load->view("v_order");
    }
	
	
    public function add()
    {
        $product = $this->product_model;
        $validation = $this->form_validation;
        $validation->set_rules($product->rules());

        if ($validation->run()) {
            $product->save();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
        }

        $this->load->view("product/new_form");
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
	public function addposting()
    {
		date_default_timezone_set('Asia/Jakarta');
		$orderDate=date("Y-m-d H:i:s");
		//$orderDate='2019-08-19 23:43:21';
		$PETUGAS=$_POST['PETUGAS'];//htmlspecialchars($this->input->post('username',TRUE),ENT_QUOTES);
		$type='1';
		$idorder=rand(100000000000,999999999999); //uniqid();
		$externalId='QOB'.rand(10000000000,99999999999);
		$customerId='0';
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
        //$product = $this->torder_model;
        //$validation = $this->form_validation;
		
		$addOrder=$this->torder_model->posting($PETUGAS,$type,$idorder,$externalId,$customerId,$serviceId,$senderName,$senderAddr,$senderVill,
		$senderSubDist,$senderCity,$senderProv,
				$senderCountry,$senderPosCode,$senderEmail,$senderPhone,$receiverName,$receiverAddr,$receiverVill,$receiverSubDist,$receiverCity,
				$receiverProv,$receiverCountry,$receiverPosCode,$receiverEmail,$receiverPhone,$orderDate,$weight,$fee,$feeTax ,
				$insurance,$insuranceTax,$itemValue,$contentDesc);
        //$data=$addOrder->row_array();
		//$data=$addOrder->result();
		//$data = array('success' => true, 'msg'=> 'Berhasil simpan data');
		//$this->session->set_flashdata('success', 'Berhasil simpan data');
		//$data=$idorder;
		$htmldata='<h3><strong>ID ORDER : </h3><BR><h1>'.$externalId.'</strong></h1>';
		echo $htmldata;
		//$data = array('success' => true, 'msg'=> $idorder);
		//echo json_encode($data);
		
         
	
		
		/*
        if($data['RESPON']=='000'){ //Akses admin
			//addposting webservice
										*/
										/* ditutup dulu
										ini_set('soap.wsdl_cache_enabled',0);
										ini_set('soap.wsdl_cache_ttl',0);
										$orderDate=date('Y-m-d H:i:s');
										try {
														//$wsdl="WSPosDev_2016_12_01.wsdl.xml"; //DEV
														$userId='iwanaja';
														$password='iwan123456';
														$wsdl=base_url('assets/PosWebServices-20161201.wsdl.xml');
														// Connect ke web service
														$client = new SoapClient($wsdl, array('cache_wsdl' => WSDL_CACHE_NONE) );
														//$client=new SoapClient($wsdl);
														$response=$client->addPosting
														(array('userId'=>$userId,'password'=>$password,
														'type'=>'-',
														'externalId'=>$externalId,
														'customerId'=>$customerId,
														'serviceId'=>'240',
														'senderName'=>$senderName,
														'senderAddr'=>$senderAddr,
														'senderVill'=>$senderVill,
														'senderSubDist'=>$senderSubDist,
														'senderCity'=>$senderCity,
														'senderProv'=>$senderProv,
														'senderCountry'=>$senderCountry,
														'senderPosCode'=>$senderPosCode,
														'senderEmail'=>$senderEmail,
														'senderPhone'=>$senderPhone,
														'receiverName'=>$receiverName,
														'receiverAddr'=>$receiverAddr,
														'receiverVill'=>$receiverVill,
														'receiverSubDist'=>$receiverSubDist,
														'receiverCity'=>$receiverCity,
														'receiverProv'=>$receiverProv,
														'receiverCountry'=>$receiverCountry,
														'receiverPosCode'=>$receiverPosCode,
														'receiverEmail'=>$receiverEmail,
														'receiverPhone'=>$receiverPhone,
														'orderDate'=>$orderDate,
														'weight'=>$weight,
														'fee'=>$fee,
														'feetax'=>$feeTax,
														'insurance'=>$insurance,
														'insuranceTax'=>$insuranceTax,
														'itemValue'=>$itemValue,
														'contentDesc'=>$contentDesc
														));
														$data=$response;
														$data=$response->r_posting;  
														//echo 'response '.$data->responseId;
														//return 0;
														//$hasil['status']=$data->responseId;
														//echo 'Respon : '.$data->responseId;
														$respon=$data->responseId;
														IF ($respon=='000') {
																	echo $this->session->set_flashdata('success', $idorder);	
														} ELSE IF ($respon=='106') {
															echo $this->session->set_flashdata('success', 'duplikat');	
														} ELSE IF ($respon=='105') {
															echo $this->session->set_flashdata('success', 'layanan tidak ada');	
														} ELSE IF ($respon=='104') {
															echo $this->session->set_flashdata('success', 'id customer kosong');	
														} ELSE IF ($respon=='103') {
															echo $this->session->set_flashdata('success', 'referensi tracking kosong');	
														} ELSE IF ($respon=='102') {
															echo $this->session->set_flashdata('success', 'melampaui maksimum hits ke service pos');	
														} ELSE IF ($respon=='101') {
															echo $this->session->set_flashdata('success', 'user name salah');	
														} ELSE IF ($respon=='999') {
															echo $this->session->set_flashdata('success', 'gagal insert data');	
														}  
												/*
												@RESPONSE='000' = SUCCESS
												106 = DUPLICATE
												999 = GAGAL INSERT DATA
												105 = SERVICE ID KOSONG
												104 = CUSTOMER ID KOSONG
												103 = EXTERNAL ID KOSONG
												102 = MAKSIMUM HITS SUDAH TERLAMPAU
												101 = USER NAME / PASSWORD SALAH
												*/		//return 0;
											/*	
												}
												catch (Exception $e) {
													echo $this->session->set_flashdata('success', 'gagal koneksi ke webservice pos');	
												}
												*/
												
												//end of connect to poswebservice
												
		/*
		} else {
			echo $this->session->set_flashdata('success', 'Gagal disimpan');
		}		
		*/
		/*$validation->set_rules($product->rules());

        if ($validation->run()) {
            $product->save();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
        }
		/*
		echo $this->session->set_flashdata('success', $PETUGAS.','.$type.','.$idorder.','.$externalId.','.$customerId.','.$serviceId.','.$senderName.','.$senderAddr.','.
		$senderVill.','.$senderSubDist.','.$senderCity.','.$senderProv.','.
				$senderCountry.','.$senderPosCode.','.$senderEmail.','.$senderPhone.','.$receiverName.','.$receiverAddr.','.$receiverVill.','.$receiverSubDist.','.
				$receiverCity.','.
				$receiverProv.','.$receiverCountry.','.$receiverPosCode.','.$receiverEmail.','.$receiverPhone.','.$weight.','.$fee.','.$feeTax.','.
				$insurance.','.$insuranceTax.','.$itemValue.','.$contentDesc);
				*/
        //$this->load->view("v_order");
    }
	
	
    public function edit($id = null)
    {
        if (!isset($id)) redirect('products');
       
        $product = $this->product_model;
        $validation = $this->form_validation;
        $validation->set_rules($product->rules());

        if ($validation->run()) {
            $product->update();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
        }

        $data["product"] = $product->getById($id);
        if (!$data["product"]) show_404();
        
        $this->load->view("product/edit_form", $data);
    }

    public function delete($id=null)
    {
        if (!isset($id)) show_404();
        
        if ($this->product_model->delete($id)) {
            redirect(site_url('products'));
        }
    }
}
