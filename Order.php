<?php
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
		$userid="440000024x";
		$param1='QOB220150424325';//"3171030101710005";
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
		print_r($response);
		/*
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
				$par1= $response['response_data1'];
				$par2= $response['response_data2'];
				$par3= $response['response_data3'];
				$par4= $response['response_data4'];
				
				$data='{"rc_mess":"00","desk_mess":"SUKSES","userid":"'.$userid.'","response_data1":"'.$param1.'",
						"response_data2":"'.$par2.'",
						"response_data3":"'.$par3.'",
						"response_data4":"'.$par4.'"}';
						
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
				$total2=round($beadasar+$htnb+$ppn+$ppnhtnb);
				
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
								'nilaibarang'=>$nilaibarang,
								'total2'=>$total2,
								'datasave'=>$data,
								'par1'=>$par1
				);

			}
		}
		echo json_encode($result);
		*/
?>		