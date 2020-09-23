<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CekBerat extends CI_Controller {

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
	public function index()
	{
		$this->load->view('transaksi');
	}
	
	
	public function ValidasiBerat( )
	{
			// --------------------------------------
			$result = array(); 
			$key1 = "c67536e59042f4f7049d441a3a5f71e1";
			$key2 = "cd187b9bff4a84415908698f9793098d";
			$tgl=date('Ymd') ;
			date_default_timezone_set('Asia/Jakarta');
			$orderDate=date("Y-m-d H:i:s");
			$Idorder=$_POST['IdOrder'];	
			$BeratValid=$_POST['BeratValid'];
			$NilaiBarang=$_POST['NilaiBarang'];
			$KdProduk2=explode("-",$_POST['KdProduk']);	
			$KdProduk=$KdProduk2[0];
			$password="05144f4e12aaa402aeb51ef2c7dde527";//MD5($key1 + $tgl + "201" + "3171030101710005" + $key2);
			$username="ecom";
			$gab=base64_encode($username.$password);
			//-----------------------------------------------------------------------------------	
			$messtype="703";	
			
			$nopend_agen=$this->session->userdata('ses_nopen');
			$userlogin=$this->session->userdata('ses_id_user');
						if(($BeratValid<=2000) and ($KdProduk=='210')){
							
							$tanda='0';
						}else{
							$tanda='1';
							
						}
						
						
			$userid=$userlogin;
			//$param1= "#1#0#40212#29564#500#0#0#0#0#0";
			$param1= "#1#".$tanda."#".$nopend_agen."#".$_POST['Kdsial']."#".$BeratValid."#0#0#0#0#".$NilaiBarang;
			$Kdsip=$nopend_agen;
			$param2="";
			$param3="";
			$param4="";
			$param5="";
			//------------------------------------------------------------------------------------
			
			$hash=strtolower(MD5($key1.$tgl.$messtype.$param1.$key2));
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
		//curl_setopt($ch, CURLOPT_URL, "https://magenpos.posindonesia.co.id:6466/a767e8eec95442bda80c4e35e0660dbb");    
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
		//	$code =$response['rc_mess'];
			//print_r("<br>Hasil".$code);
			//print_r("<br>".$data_string);
			//print_r("<br>".$data_string);
			
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
				}else {
					$result["success"] = true;
					$datakiriman=explode("^",$response['response_data1']);
					$jmlproduk=$datakiriman[0];
						for ($i=0; $i < $jmlproduk; $i++)
						{
							$tarif=explode("#",$datakiriman[1]);	
							$kodeproduk[$i]=substr($tarif[$i],0,3);
							if($kodeproduk[$i]==$KdProduk)
							{
								$tarifec2=explode("*",$tarif[$i]);
								$tarifec2a=$tarifec2[1];
								$nilaitarif=explode("|",$tarifec2a);
								$beadasar=$nilaitarif[0];
								$ppn=$nilaitarif[1];
								$htnb=$nilaitarif[2];
								$ppnhtnb=$nilaitarif[3];
								$total=$nilaitarif[4];
								$total=number_format(round($nilaitarif[4]),0, ',', '.');
								$total2=round($nilaitarif[4]);
								
								$datatarif="Bea Dasar :".number_format($beadasar,0, ',', '.')."\n".
								   "htnb : ".number_format($htnb,0, ',', '.')."\n".
								   "ppn :".number_format($ppn,0, ',', '.')."\n".	
								   "ppnhtnb :".number_format($ppnhtnb,0, ',', '.');
								
								////response_data2":"447|QOB1405072375|-|3400|71287.13|2000.0|712.87|200.0|-|900000|-|-
									$response_data2=$kodeproduk[$i]."|".$Idorder."|-|".$BeratValid."|".$beadasar."|".$htnb."|".$ppn."|".$ppnhtnb."|-|".$NilaiBarang."|-|-";
								
								
							}
							 $result = array('rc_mess'=> $response['rc_mess'],'desk_mess'=>$response['desk_mess'],
							'tarifvalid'=>$datatarif,
							'total'=>$total,'total2'=>$total2,'Kdsip'=>$Kdsip,
							'response_data2'=>$response_data2);
						}
						// $result = array('rc_mess'=> $response['rc_mess'],'desk_mess'=>$response['desk_mess'],'tarifvalid'=>$datatarif,
						// 'total'=>$total,'total2'=>$total2,'Kdsip'=>$Kdsip,
						// 'response_data2'=>$response_data2);
					       
				}
			}
			echo json_encode($result);

	}
}	