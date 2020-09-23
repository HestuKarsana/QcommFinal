<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class GetOrder extends CI_Controller {

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
	
	
	public function get_order( )
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
		
		$nopend_agen=$this->session->userdata('ses_kode_agen');
		$userlogin=$this->session->userdata('ses_id_user');
	    $userid=$userlogin;
		
		$param1= strtoupper($_POST['IdOrder']);//"3171030101710005";
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
		//curl_setopt($ch, CURLOPT_URL, "https://magenpos.posindonesia.co.id:6466/a767e8eec95442bda80c4e35e0660dbb");    
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
				
				/*
				Array ( [messtype] => 301 [rc_mess] => 00 
				[desk_mess] => SUKSES [userid] => 440000024 
				[response_data1] => QOB220102556764 
				[response_data2] => 240|-|-|100|18811.88|454.55|188.12|45.45||100000|-|- 
				[response_data3] => ANDI ASTOWO|JL RANGKAH LEBAR NO 15 JL RANGKAH LEBAR NO 15 - Kel. Rangkah Kec. Tambaksari|-|-|-|-|-|60135|08560788688|nsapta@gmail.com 
				[response_data4] => -|DARYANA|JL BANDA NO 30 BANDUNG JL BANDA NO 30 BANDUNG - Kel. Citarum Kec. Bandung Wetan|-|-|-|-|-|40115|0811339886|daryana@posindonesia.co.id 
				[response_data5] => 0|0|0 [wkt_mess] => 2020-01-16 14:17:02.748607 ) 
				
				[response_data4] => -|Martin|Jln krembangan No 73 Surabaya |-|-|Kel. Kemayoran Kec. Krembangan|KEL|KEC|60176|087765654343|Indonesia|KOTA SURABAYA|PROV|Martin@gmail.com|-|-
				*/
				//240|QOB1221717741|-|200|16831.68|1090.91|168.32|109.09|-|500000|-|-
				$par1= $response['response_data1'];
				$par2= $response['response_data2'];
				$par3= $response['response_data3'];
				$par4= $response['response_data4'];
				
						
				//response_data2":"447|QOB1405072375|-|3400|71287.13|2000.0|712.87|200.0|-|900000|-|-
				//$userid_pebisol=$response['userid'];
				$datakiriman=explode("|",$response['response_data2']);
				
				$produk=$datakiriman[0]."-"."QCOMM";
				$produk2=$datakiriman[0];
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
				$total2=round($beadasar+$htnb+$ppn+$ppnhtnb);
				
				//kurniawan|rt 03 rw 04 rt 03 rw 04 - Kel. Kebagusan Kec. Pasar Minggu KOTA ADM. JAKARTA SELATAN DKI JAKARTA 12520|-|-|-|-|-|12520|081231214|iwan@mail.com
				/*
				Array ( [messtype] => 301 [rc_mess] => 00 [desk_mess] => SUKSES [userid] => 440000024 
				[response_data1] => QOB120106683347 
				[response_data2] => 1Q9|0000000099|-|100|NaN|0|0|0|Sepatu|100000|-|- 
				[response_data3] => DARYANA|Jalan Dahlia 4|KEC|-|KOTA BANDUNG|Jawa Barat|Indonesia|40113|081321873952|Mas_daryana@yahoo.com 
				[response_data4] => -|Dede|Jl cihapit 20|-|-|Kel. Cihapit Kec. Bandung Wetan|-|KOTA BANDUNG|Jawa Barat|-|Indonesia|40114|08132312333|Dede@gmail.com|-|- 
				[response_data5] => 0|0|0 [wkt_mess] => 2020-01-16 12:35:26.546865 ) 
				
				
				*/
				$datasip=explode("|",$response['response_data3']);
				$nmsip=$datasip[0];
				$almsip=$datasip[1]." ".$datasip[2]." ".$datasip[3]." ".$datasip[4]." ".$datasip[5]." ".$datasip[6];
				$kdposip=$datasip[7];
				$tlpsip=$datasip[8];
				// $nmsip=$datasip[0];
				// $nmsip=$datasip[0];
				// $nmsip=$datasip[0];
				//-||rw 04 rt 01 rw 04 rt 01 - Kel. Pulau Harapan Kec. Kepulauan Seribu Utara KAB. ADM. KEP. SERIBU DKI JAKARTA 14550|-|-|-|-|-|14550|
				/*
				
				Array ( [messtype] => 301 [rc_mess] => 00 [desk_mess] => SUKSES [userid] => 440000024 
				[response_data1] => QOB120106683347 
				[response_data2] => 1Q9|0000000099|-|100|NaN|0|0|0|Sepatu|100000|-|- 
				[response_data3] => DARYANA|Jalan Dahlia 4|KEC|-|KOTA BANDUNG|Jawa Barat|Indonesia|40113|081321873952|Mas_daryana@yahoo.com 
				[response_data4] => -|Dede|Jl cihapit 20|-|-|Kel. Cihapit Kec. Bandung Wetan|-
				|KOTA BANDUNG|Jawa Barat|-|Indonesia|40114|08132312333|Dede@gmail.com|-|- 
				[response_data5] => 0|0|0 [wkt_mess] => 2020-01-16 12:35:26.546865 ) 
				
				*/
				$datasial=explode("|",$response['response_data4']);
				$nmsial=$datasial[1];
				$almsial=$datasial[2]." ".$datasial[3]." ".$datasial[4]." ".$datasial[5]." ".$datasial[7]." ".$datasial[8]." ".$datasial[9]." ".$datasial[10]." ".$datasial[11];
				
				$kdposial=$datasial[12];
				$tlpsial=$datasial[13]." / ".$datasial[14];
				
				$datalain=explode("|",$response['response_data5']);
				
				
				//number_format(round($ppnhtnb), 0, ',', '.')
				$datatarif="Bea Dasar :".number_format($beadasar,0, ',', '.')."\n".
					       "htnb : ".number_format($htnb,0, ',', '.')."\n".
						   "ppn :".number_format($ppn,0, ',', '.')."\n".	
						   "ppnhtnb :".number_format($ppnhtnb,0, ',', '.')."\n".
						   "Total :".number_format($total2,0, ',', '.');
				
				$datapengirim="Nama :".$nmsip."\n".
					       "Alamat : ".$almsip."\n".
						   "Tlp :".$tlpsip."\n".	
						   "Kodepos :".$kdposip;
				$datapenerima="Nama :".$nmsial."\n".
					       "Alamat : ".$almsial."\n".
						   "Tlp :".$tlpsial."\n".	
						   "Kodepos :".$kdposial;
				
				/*
				Pengecekan tarif sesuai kantor asal
				*/
		                
						$nopend_agen=$this->session->userdata('ses_nopen');
						$userlogin=$this->session->userdata('ses_id_user');
						if(($berat<=2000) and ($produk2=='210')){
							
							$tanda='0';
						}else{
							$tanda='1';
							
						}
		
						$Idorder=$_POST['IdOrder'];	
						$BeratValid=$berat;//_POST['BeratValid'];
						$NilaiBarang=$nilaibarang;//$_POST['NilaiBarang'];
						$password="05144f4e12aaa402aeb51ef2c7dde527";//MD5($key1 + $tgl + "201" + "3171030101710005" + $key2);
						$username="ecom";
						$gab=base64_encode($username.$password);
						//-----------------------------------------------------------------------------------	
						$messtype="703";	
						//$userid="440000024";
						$userid=$userlogin;
		                //$param1= "#1#0#40212#29564#500#0#0#0#0#0";
						$param1= "#1#".$tanda."#".$nopend_agen."#".$kdposial."#".$berat."#0#0#0#0#".$nilaibarang;
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

						
						$response1x = curl_exec($ch);
						$err1 = curl_error($ch);
						curl_close($ch);
						$responsex = json_decode($response1x, true);
						$code = $responsex['rc_mess']; 
						if ($responsex =='') {
							$result["success"] = false;
							$result["errors"]["iderror"] = "801";
							$result["errors"]["error"] = "Data tidak ditemukan";
						} 
						else{
							
							if($code<>'00') {
								$result["success"] = false;
								$result["errors"]["iderror"] = $code;
								$result["errors"]["error"] = $responsex['desk_mess'] ; 
							}else {
								$result["success"] = true;
								$datakir=explode("^",$responsex['response_data1']);
								$jmlprodukx=$datakir[0];
									for ($i=0; $i < $jmlprodukx; $i++)
									{
										$tarifx=explode("#",$datakir[1]);	
										$kodeproduk2[$i]=substr($tarifx[$i],0,3);
										if($kodeproduk2[$i]==$produk2)
										{
											$tarifec2=explode("*",$tarifx[$i]);
											$tarifec2a=$tarifec2[1];
											$nilaitarif2=explode("|",$tarifec2a);
											$beadasar2=$nilaitarif2[0];
											$ppn2=$nilaitarif2[1];
											$htnb2=$nilaitarif2[2];
											$ppnhtnb2=$nilaitarif2[3];
											$totalx=$nilaitarif2[4];
											$totalx=number_format(round($nilaitarif2[4]),0, ',', '.');
											$total2x=round($nilaitarif2[4]);
											
											$datatarif_kantor_asal="Bea Dasar :".number_format($beadasar2,0, ',', '.')."\n".
											   "htnb : ".number_format($htnb2,0, ',', '.')."\n".
											   "ppn :".number_format($ppn2,0, ',', '.')."\n".	
											   "ppnhtnb :".number_format($ppnhtnb2,0, ',', '.')."\n".
											   "Total :".number_format($total2x,0, ',', '.');
				
											$response_data2=$produk2."|".$Idorder."|-|".$BeratValid."|".$beadasar2."|".$htnb2."|".$ppn2."|".$ppnhtnb2."|-|".$NilaiBarang."|-|-";
											
										}
										
									}
									// $result = array('rc_mess'=> $response['rc_mess'],'desk_mess'=>$response['desk_mess'],'datatarif_kantor_asal'=>$datatarif_kantor_asal,
									// 'total'=>$total,'total2'=>$total2,'Kdsip'=>$Kdsip,
									// 'response_data2'=>$response_data2);
								
							}
						}
				/*
				==========================================================================
				*/
				$data='{"rc_mess":"00","desk_mess":"SUKSES","userid":"'.$userid.'","response_data1":"'.$param1.'",
						"response_data2":"'.$response_data2.'",
						"response_data3":"'.$par3.'",
						"response_data4":"'.$par4.'"}';
				
				
				$result = array('rc_mess'=> $response['rc_mess'],'desk_mess'=>$response['desk_mess'],
				                'userid'=> $response['userid'],'response_data1'=>$response['response_data1'],
								'response_data2'=> $response_data2,'response_data3'=>$datapengirim,
								'response_data4'=> $datapenerima,'response_data5'=>$responsex['response_data5'],
								'datatarif'=>$datatarif,'produk'=>$produk,'total'=>$totalx,'berat'=>$berat,
								'par2'=> $response_data2,//$par2,
								'par3'=> $par3,
								'par4'=> $par4,
								'par5'=> $kdposip,
								'par6'=> $kdposial,
								'nilaibarang'=>$nilaibarang,
								'total2'=>$total2x,
								'datasave'=>$data,
								'par1'=>$par1,
								'validasi_tarif'=>$datatarif_kantor_asal,
								'isikiriman'=>$isikiriman
				);
					            $this->session->set_userdata('ses_tmp_data1',$par1);
								$this->session->set_userdata('ses_tmp_data2',$response_data2);
								$this->session->set_userdata('ses_tmp_data3',$par3);
								$this->session->set_userdata('ses_tmp_data4',$par4);
								
			}
		}
		echo json_encode($result);
	}
}