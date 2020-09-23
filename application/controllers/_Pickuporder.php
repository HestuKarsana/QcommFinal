<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Pickuporder extends CI_Controller//MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        //$this->load->model("torder_model");
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

	public function insorder()
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
		$userid="440000024"; //QOB201912120001|9
		//$orderDate='2019-08-19 23:43:21';
		//$PETUGAS=$_POST['PETUGAS'];//htmlspecialchars($this->input->post('username',TRUE),ENT_QUOTES);
		$type='1';
		//$idorder=rand(100000000000,999999999999); //uniqid();
		//$idorder='QOB'.rand(10000000000,99999999999);
		$idorder='-';
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
		//$VA = '60012345678';
		$VA = '-';
		//end of input front end
		
		//$param1=$orderDate."|".$idorder."|".$userid."|".$no_group_order;//;$_POST['IdOrder'];//"3171030101710005"; QOB123456789222
		$param1=$orderDate."|02|".$userid."|".$no_group_order;//;$_POST['IdOrder'];//"3171030101710005"; QOB123456789222
		
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
				{"rc_mess":"00","desk_mess":"SUKSES","userid":"440000024",
				"response_data1":"QOB120000000001",
				"response_data2":"EC2|xxxx1234R|-|200|4500|500|450|20|pakaian|300000|-|-",
				"response_data3":"dede|jalan cijambe saja|cijambe|ujungberung|bandung|jawa barat|indonesia|40601|08823765889|dede@posindonesia.co.id",
				"response_data4":"-|yuyus|perumahan cimahi nagok rt 12\/23 |-|-|cimahi|cimahi|cimahi|cimahi|jawa barat|-|indonesia|40512|086778836633|022432567|yuyus@posindonesia.co.id|-|-"}
				$datakiriman=explode("|",$response['response_data1']);
				$idorder=$datakiriman[0];
				//$pelanggan=$datakiriman[1];
				$htmldata='<h3><strong>ID ORDER : </h3><BR><h1>'.$idorder.'</strong></h1>';
				*/
				/*
				$datakiriman=explode("|",$response['response_data1']);
				$idorder=$datakiriman[0];
				$pelanggan=$datakiriman[1];
				//$htmldata=$idorder;
				$isikiriman=$param2;
				$pengirim=$param3;
				$penerima=$param4;
				*/
				/*"response_data1":"02|-|0|QOB220000147055"*/
				$datakiriman=explode("|",$response['response_data1']);
				$idorder=$datakiriman[3];
				$NoVA=$datakiriman[2];
				$asalOrder=$datakiriman[0];
				//$pelanggan=$datakiriman[1];
				//$htmldata=$idorder;
				$isikiriman=$param2;
				$pengirim=$param3;
				$penerima=$param4;
				$htmldata=$idorder.'~'.$pengirim.'~'.$penerima.'~'.$isikiriman;
			}
		
		
		}
		
		//echo $htmldata;
		echo $htmldata;
	
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
