<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Label_barcode extends CI_Controller {
	public function __construct()
    {
        parent::__construct();
        //$this->load->model("torder_model");
    }
	public function index()
	{ 
		$tglawal=date("Y-m-d");
		$tglakhir=date("Y-m-d");
		$data["kirimans"] = $this->torder_model->cekKiriman($tglawal,$tglakhir);
        $this->load->view("v_cetaklabel",$data);
		//$this->load->view("v_formcetak",$data);
	}
	
	public function tampilkan_order()
	{
		//$tglawal='2019-08-18';tgl_mulai
		//$tglakhir='2019-08-23';
		/*$tglawal=$_POST['tgl_mulai'];
		$tglakhir=$_POST['tgl_akhir'];
		$data["kirimans"] = $this->torder_model->cekKiriman($tglawal,$tglakhir);
        $this->load->view("v_cetaklabel",$data);*/
		$this->load->view("cetak_label");
		
		
	}
	public function cuma_lewat()
	{
		
	}
	public function cetak_labelnya()
	{
		$tglawal='2019-08-18';
		$tglakhir='2019-12-08';
		//$data["kirimans"] = $this->torder_model->cekKiriman($tglawal,$tglakhir);
		//$datanya= $this->getOrdernya('QOB120000000001');
		//$data["kirimans"] = $datanya;
        //$this->load->view("v_cetaklabel",$data);
		$data["kirimans"]='{"rc_mess":"00","desk_mess":"SUKSES","userid":"dede123","response_data1":"QOB120000000001",
		"response_data2":"EC2|xxxx1234R|-|200|4500|500|450|20|pakaian|300000|-|-",
		"response_data3":"dede|jalan cijambe saja|cijambe|ujungberung|bandung|jawa barat|indonesia|40601|08823765889|dede@posindonesia.co.id",
		"response_data4":"-|yuyus|perumahan cimahi nagok rt 12\/23 |-|-|cimahi|cimahi|cimahi|cimahi|jawa barat|-|indonesia|40512|086778836633|022432567|yuyus@posindonesia.co.id|-|-"}';
		//$this->load->view("order/v_cetak_label",$data);
		//$this->load->view("order/cetakan",$data);
		//$this->load->view("v_cetakhvs",$data);
	}

	public function cetak_label()
	{
		$barcode 	= $this->input->get('idorder');
		
		// $idordernya=$_GET['IdOrder'];
		 //$barcode=$idordernya;
		//$barcode 	='QOB45314089646';
		$data["kirimans"] = $this->getOrdernya($barcode);
		
		
		//$data["kirimans"]='{"rc_mess":"00","desk_mess":"SUKSES","userid":"dede123","response_data1":"QOB20146806596","response_data2":"240|QOB20146806596|-|1500|31683.17|15272.73|316.83|1527.27|-|7000000|-|-","response_data3":"dd|bandung bandung - Kel. Cigending Kec. Ujung Berung|-|-|-|-|-|40199|081365610750|","response_data4":"-|ali|cimahi cimahi - Kel. Baros Kec. Baros|-|-|-|-|-|43167|081365610750|"}';
		
		$this->load->view("transaksi/v_cetakan_resi",$data);
	}
	
	public function cetak_order()
	{
		$idorder 	= $this->input->get('idorder');
		//$idorder 	= 'QOB120000000001';
		$idordernya= explode('~',$idorder);
		$data["kirimans"] = $this->getOrdernya($idordernya[0]);
		$this->load->view("order/v_cetak_order",$data);
	}	
	
	public function cetak_resi()
	{
		$idorder 	= $this->input->get('idorder');
		//$barcode 	='QOB120000000001';
		$data["kirimans"] = $this->getOrdernya($idorder);
		$this->load->view("order/v_cetak_order",$data);
		
	}
	public function cetak_label_kiriman()
	{
		$data["kirimans"] = $this->getOrdernya('QOB52732627639');
		$this->load->view("order/v_cetak_hvs",$data);
		//$this->load->view("v_cetakhvs",$data);
	}
	public function set_barcode($code)
	{
		//load library
		$this->load->library('zend');		//load in folder Zend
		$this->zend->load('Zend/barcode');
		//clean buffer
		//ob_end_clean();
		//generate barcode
		Zend_Barcode::render('code128', 'image', array('text'=>$code), array());
		//ob_end_clean();
		
		
		    
		
		
		
		
	}
	
	public function barcode_gen() {
		 require_once('./application/libraries/Zend/Barcode/Barcode.php');
   //adjust the above path to the correct location
    $barcodeOptions = array('text' => 'ZEND-FRAMEWORK');
    $rendererOptions = array();
   Zend_Barcode::factory('code39', 'image', $barcodeOptions, $rendererOptions)->render();
	}
	
	
	
	public function get_order()
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
		$messtype="301";//"201";	
		$userid="dede123";
		$param1=$_POST['IdOrder'];//"3171030101710005";
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
				
			}else {
				$result["success"] = true;
				//240|QOB1221717741|-|200|16831.68|1090.91|168.32|109.09|-|500000|-|-
				$par2= $response['response_data2'];
				$par3= $response['response_data3'];
				$par4= $response['response_data4'];
				//response_data2":"447|QOB1405072375|-|3400|71287.13|2000.0|712.87|200.0|-|900000|-|-
				$datakiriman=explode("|",$response['response_data2']);
				$produk=$datakiriman[0]."-"."QCOMM";
				$pelanggan=$datakiriman[1];
				$backsheet=$datakiriman[2];
				$berat=$datakiriman[3];
				$beadasar=$datakiriman[4];
				$htnb=$datakiriman[5];
				
				$ppn=$datakiriman[6];
				$ppnhtnb=$datakiriman[7];
				$isikiriman=$datakiriman[8];
				$nilaibarang=$datakiriman[9];
				$total=number_format($beadasar+$htnb+$ppn+$ppnhtnb,0, ',', '.');
				//kurniawan|rt 03 rw 04 rt 03 rw 04 - Kel. Kebagusan Kec. Pasar Minggu KOTA ADM. JAKARTA SELATAN DKI JAKARTA 12520|-|-|-|-|-|12520|081231214|iwan@mail.com
				
				$datasip=explode("|",$response['response_data3']);
				$nmsip=$datasip[0];
				$almsip=$datasip[1];
				$kdposip=$datasip[7];
				$tlpsip=$datasip[8];
				// $nmsip=$datasip[0];
				// $nmsip=$datasip[0];
				// $nmsip=$datasip[0];
				//-||rw 04 rt 01 rw 04 rt 01 - Kel. Pulau Harapan Kec. Kepulauan Seribu Utara KAB. ADM. KEP. SERIBU DKI JAKARTA 14550|-|-|-|-|-|14550|
				
				$datasial=explode("|",$response['response_data4']);
				$nmsial=$datasial[1];
				$almsial=$datasial[2];
				$kdposial=$datasial[8];
				$tlpsial=$datasial[9];
				
				$datalain=explode("|",$response['response_data5']);
				
				
				//number_format(round($ppnhtnb), 0, ',', '.')
				$datatarif="Bea Dasar :".number_format($beadasar,0, ',', '.')."\n".
					       "htnb : ".number_format($htnb,0, ',', '.')."\n".
						   "ppn :".number_format($ppn,0, ',', '.')."\n".	
						   "ppnhtnb :".number_format($ppnhtnb,0, ',', '.');
				
				$datapengirim="Nama :".$nmsip."\n".
					       "Alamat : ".$almsip."\n".
						   "Tlp :".$tlpsip."\n".	
						   "Kodepos :".$kdposip;
				$datapenerima="Nama :".$nmsial."\n".
					       "Alamat : ".$almsial."\n".
						   "Tlp :".$tlpsial."\n".	
						   "Kodepos :".$kdposial;
				
				$result = array('rc_mess'=> $response['rc_mess'],'desk_mess'=>$response['desk_mess'],
				                'userid'=> $response['userid'],'response_data1'=>$response['response_data1'],
								'response_data2'=> $response['response_data2'],'response_data3'=>$datapengirim,
								'response_data4'=> $datapenerima,'response_data5'=>$response['response_data5'],
								'datatarif'=>$datatarif,'produk'=>$produk,'total'=>$total,'berat'=>$berat,
								'par2'=> $par2,
								'par3'=> $par3,
								'par4'=> $par4,
								'par5'=> $kdposip,
								'par6'=> $kdposial,
								'nilaibarang'=>$nilaibarang
				);

			}
		}
		echo json_encode($result);
	}

	public function getOrdernya($idordernya)
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
		$messtype="301";//"201";	
		$userid="440000024";
		//$param1=$_POST['IdOrder'];//"3171030101710005";
		//$param1='QOB120000000001';//"3171030101710005";
		$param1=$idordernya;//"3171030101710005";
		
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
		//$response1=htmlspecialchars($response1,ENT_QUOTES);
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
				
			}else {
				$result["success"] = true;
				//240|QOB1221717741|-|200|16831.68|1090.91|168.32|109.09|-|500000|-|-
				$par2= $response['response_data2'];
				$par3= $response['response_data3'];
				$par4= $response['response_data4'];
				//response_data2":"447|QOB1405072375|-|3400|71287.13|2000.0|712.87|200.0|-|900000|-|-
				$datakiriman=explode("|",$response['response_data2']);
				$produk=$datakiriman[0]."-"."QCOMM";
				$pelanggan=$datakiriman[1];
				$backsheet=$datakiriman[2];
				$berat=$datakiriman[3];
				$beadasar=$datakiriman[4];
				$htnb=$datakiriman[5];
				
				$ppn=$datakiriman[6];
				$ppnhtnb=$datakiriman[7];
				$isikiriman=$datakiriman[8];
				$nilaibarang=$datakiriman[9];
				$total=number_format($beadasar+$htnb+$ppn+$ppnhtnb,0, ',', '.');
				//kurniawan|rt 03 rw 04 rt 03 rw 04 - Kel. Kebagusan Kec. Pasar Minggu KOTA ADM. JAKARTA SELATAN DKI JAKARTA 12520|-|-|-|-|-|12520|081231214|iwan@mail.com
				
				$datasip=explode("|",$response['response_data3']);
				$nmsip=$datasip[0];
				$almsip=$datasip[1];
				$kdposip=$datasip[7];
				$tlpsip=$datasip[8];
				// $nmsip=$datasip[0];
				// $nmsip=$datasip[0];
				// $nmsip=$datasip[0];
				//-||rw 04 rt 01 rw 04 rt 01 - Kel. Pulau Harapan Kec. Kepulauan Seribu Utara KAB. ADM. KEP. SERIBU DKI JAKARTA 14550|-|-|-|-|-|14550|
				
				$datasial=explode("|",$response['response_data4']);
				$nmsial=$datasial[1];
				$almsial=$datasial[2];
				$kdposial=$datasial[8];
				$tlpsial=$datasial[9];
				
				$datalain=explode("|",$response['response_data5']);
				
				
				//number_format(round($ppnhtnb), 0, ',', '.')
				$datatarif="Bea Dasar :".number_format($beadasar,0, ',', '.')."\n".
					       "htnb : ".number_format($htnb,0, ',', '.')."\n".
						   "ppn :".number_format($ppn,0, ',', '.')."\n".	
						   "ppnhtnb :".number_format($ppnhtnb,0, ',', '.');
				
				$datapengirim="Nama :".$nmsip."\n".
					       "Alamat : ".$almsip."\n".
						   "Tlp :".$tlpsip."\n".	
						   "Kodepos :".$kdposip;
				$datapenerima="Nama :".$nmsial."\n".
					       "Alamat : ".$almsial."\n".
						   "Tlp :".$tlpsial."\n".	
						   "Kodepos :".$kdposial;
				
				/*$result = array('rc_mess'=> $response['rc_mess'],'desk_mess'=>$response['desk_mess'],
				                'userid'=> $response['userid'],'response_data1'=>$response['response_data1'],
								'response_data2'=> $response['response_data2'],'response_data3'=>$datapengirim,
								'response_data4'=> $datapenerima,'response_data5'=>$response['response_data5'],
								'datatarif'=>$datatarif,'produk'=>$produk,'total'=>$total,'berat'=>$berat,
								'par2'=> $par2,
								'par3'=> $par3,
								'par4'=> $par4,
								'par5'=> $kdposip,
								'par6'=> $kdposial,
								'nilaibarang'=>$nilaibarang */
				
				//);
				$result = array('rc_mess'=> $response['rc_mess'],'desk_mess'=>$response['desk_mess'],
				                'userid'=> $response['userid'],'response_data1'=>$response['response_data1'],
								'response_data2'=> $response['response_data2'],'response_data3'=> $response['response_data3'],
								'response_data4'=> $response['response_data4']);
								

			}
		}
		//echo json_encode($result);
		return json_encode($result);
		//echo json_encode($response);
		//return $response1;
	}
/*
var FormData = "barcode="+encodeURI(IdOrder);
									FormData += "&pengirim="+encodeURI(response.response_data3);
									FormData += "&penerima="+response.response_data4;
*/
	public function cetakOrdernya()
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
		$messtype="301";//"201";	
		$userid="dede123";
		//$param1=$_POST['IdOrder'];//"3171030101710005";
		$param1=$idordernya;//"3171030101710005";
		//$param1=$_POST['idorder'];//"3171030101710005";
		
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
		//$response1=htmlspecialchars($response1,ENT_QUOTES);
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
				
			}else {
				$result["success"] = true;
				//240|QOB1221717741|-|200|16831.68|1090.91|168.32|109.09|-|500000|-|-
				$par2= $response['response_data2'];
				$par3= $response['response_data3'];
				$par4= $response['response_data4'];
				//response_data2":"447|QOB1405072375|-|3400|71287.13|2000.0|712.87|200.0|-|900000|-|-
				$datakiriman=explode("|",$response['response_data2']);
				$produk=$datakiriman[0]."-"."QCOMM";
				$pelanggan=$datakiriman[1];
				$backsheet=$datakiriman[2];
				$berat=$datakiriman[3];
				$beadasar=$datakiriman[4];
				$htnb=$datakiriman[5];
				
				$ppn=$datakiriman[6];
				$ppnhtnb=$datakiriman[7];
				$isikiriman=$datakiriman[8];
				$nilaibarang=$datakiriman[9];
				$total=number_format($beadasar+$htnb+$ppn+$ppnhtnb,0, ',', '.');
				//kurniawan|rt 03 rw 04 rt 03 rw 04 - Kel. Kebagusan Kec. Pasar Minggu KOTA ADM. JAKARTA SELATAN DKI JAKARTA 12520|-|-|-|-|-|12520|081231214|iwan@mail.com
				
				$datasip=explode("|",$response['response_data3']);
				$nmsip=$datasip[0];
				$almsip=$datasip[1];
				$kdposip=$datasip[7];
				$tlpsip=$datasip[8];
				// $nmsip=$datasip[0];
				// $nmsip=$datasip[0];
				// $nmsip=$datasip[0];
				//-||rw 04 rt 01 rw 04 rt 01 - Kel. Pulau Harapan Kec. Kepulauan Seribu Utara KAB. ADM. KEP. SERIBU DKI JAKARTA 14550|-|-|-|-|-|14550|
				
				$datasial=explode("|",$response['response_data4']);
				$nmsial=$datasial[1];
				$almsial=$datasial[2];
				$kdposial=$datasial[8];
				$tlpsial=$datasial[9];
				
				$datalain=explode("|",$response['response_data5']);
				
				
				//number_format(round($ppnhtnb), 0, ',', '.')
				$datatarif="Bea Dasar :".number_format($beadasar,0, ',', '.')."\n".
					       "htnb : ".number_format($htnb,0, ',', '.')."\n".
						   "ppn :".number_format($ppn,0, ',', '.')."\n".	
						   "ppnhtnb :".number_format($ppnhtnb,0, ',', '.');
				
				$datapengirim="Nama :".$nmsip."\n".
					       "Alamat : ".$almsip."\n".
						   "Tlp :".$tlpsip."\n".	
						   "Kodepos :".$kdposip;
				$datapenerima="Nama :".$nmsial."\n".
					       "Alamat : ".$almsial."\n".
						   "Tlp :".$tlpsial."\n".	
						   "Kodepos :".$kdposial;
				
			
				$result = array('rc_mess'=> $response['rc_mess'],'desk_mess'=>$response['desk_mess'],
				                'userid'=> $response['userid'],'response_data1'=>$response['response_data1'],
								'response_data2'=> $response['response_data2'],'response_data3'=> $response['response_data3'],
								'response_data4'=> $response['response_data4']);
								

			}
		}
		//echo json_encode($result);
		return json_encode($result);
		//echo json_encode($response);
		//return $response1;
	}


	public function order_cetak()
	{
		$barcode 	= $this->input->get('barcode');
		$pengirim		= $this->input->get('pengirim');
		$penerima		= $this->input->get('penerima');
		
		/*
		$this->load->model('m_user');
		$kasir = $this->m_user->get_baris($id_kasir)->row()->nama;
		
		$this->load->model('m_pelanggan');
		$pelanggan = 'umum';
		if( ! empty($id_pelanggan))
		{
			$pelanggan = $this->m_pelanggan->get_baris($id_pelanggan)->row()->nama;
		}
		*/
		$this->load->library('cfpdf');		
		$pdf = new FPDF('P','mm','A5');
		$pdf->AddPage();
		$pdf->SetFont('Arial','',10);

		$pdf->Cell(25, 4, 'Barcode', 0, 0, 'L'); 
		$pdf->Cell(85, 4, $barcode, 0, 0, 'L');
		$pdf->Ln();
		$pdf->Cell(85, 4, site_url()."/label_barcode/set_barcode/".$barcode, 0, 0, 'L');
		$pdf->Ln();
		$pdf->Cell(130, 5, '-----------------------------------------------------------------------------------------------------------', 0, 0, 'L');
		$pdf->Ln();
		$pdf->Cell(25, 5, $penerima, 0, 0, 'L');
		$pdf->Ln();
		$pdf->Cell(130, 5, '-----------------------------------------------------------------------------------------------------------', 0, 0, 'L');
		$pdf->Ln();
		$pdf->Cell(25, 5, $pengirim, 0, 0, 'L');
		$pdf->Ln();

		//$this->load->model('m_barang');
		$this->load->helper('text');
		/*
		$no = 0;
		foreach($_GET['kode_barang'] as $kd)
		{
			if( ! empty($kd))
			{
				$nama_barang = $this->m_barang->get_id($kd)->row()->nama_barang;
				$nama_barang = character_limiter($nama_barang, 20, '..');

				$pdf->Cell(25, 5, $kd, 0, 0, 'L');
				$pdf->Cell(40, 5, $nama_barang, 0, 0, 'L');
				$pdf->Cell(25, 5, str_replace(',', '.', number_format($_GET['harga_satuan'][$no])), 0, 0, 'L');
				$pdf->Cell(15, 5, $_GET['jumlah_beli'][$no], 0, 0, 'L');
				$pdf->Cell(25, 5, str_replace(',', '.', number_format($_GET['sub_total'][$no])), 0, 0, 'L');
				$pdf->Ln();

				$no++;
			}
		}
		*/
		$pdf->Cell(130, 5, '-----------------------------------------------------------------------------------------------------------', 0, 0, 'L');
		$pdf->Ln();

		$pdf->Cell(25, 5, 'Catatan : ', 0, 0, 'L');
		$pdf->Ln();
		$pdf->Cell(130, 5, (($catatan == '') ? 'Tidak Ada' : $catatan), 0, 0, 'L');
		$pdf->Ln();

		$pdf->Cell(130, 5, '-----------------------------------------------------------------------------------------------------------', 0, 0, 'L');
		/*$pdf->Ln();
		$pdf->Ln();
		$pdf->Cell(130, 5, "Terimakasih telah berbelanja dengan kami", 0, 0, 'C');
		*/

		$pdf->Output();
	}

}

?>