<?php
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
		$messtype="303";//"201";	
		//975364534	123456789987654321
	/*
	pa abdul, [16.01.20 10:34]
token nya 197303

pa abdul, [16.01.20 10:34]
user nya 440000016

 md5(userid + ecom2020 + pin)
 
 $userid="440000016";
		//$passw = "aaAA123*";
		$pin='197303';
		$key='ecom2020';
		
		echo 'token '. md5($userid + $key + $pin)
 
	*/
		$jnslogin='02';
		$userid="440000024";
		$pin='629432';
		$key='ecom2020';
		//d7a50ce287234d405f901a2bef06e6a3
		//$passwordnya='d7a50ce287234d405f901a2bef06e6a3';//md5($userid + $key + $pin);
		if ($jnslogin=='01') {
				$passMD5=MD5($usernamenya.$passwordnya);
		} else if ($jnslogin=='02') {
				//$passMD5=$passwordnya;
				$passMD5=MD5($userid.$key.$pin);
		}
		//$param1="975364534|123456789987654321|01";//;$_POST['IdOrder'];//"3171030101710005";
		$param1=$userid.'|'.$passMD5.'|02';
		//$param1='60135C102|269794568f96b468fcecd1536f6693e3|01';
		//$param1="975364534|12345678";
		/*
		

[16:30, 12/23/2019] pa abdul: tambah satu parameter inputan  CALL Ipos_GetUserLoginAgenpos('975364534|123456789987654321|01')
[16:30, 12/23/2019] pa abdul: 01 untuk user agenpos
[16:31, 12/23/2019] pa abdul: 02 untuk user pebisol
[16:35, 12/23/2019] pa abdul: untuk user password pebisol : 
CALL Ipos_GetUserLoginAgenpos('440000032|24b2024925f736b202e4e88adf10c756|02')



		*/
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
		print_r("<br>".$response1."<br>");
		
		
		curl_close($ch);
		
		$response = json_decode($response1, true);
		//print_r($response);
		$code = $response['rc_mess']; 
//		$code =$response['rc_mess'];
		//print_r("<br>Hasil".$code);
//		print_r("<br>".$hash);
		//print_r("<br>".$response);
		return 0;
		/*
		response sukses :
		{"messtype":"303","rc_mess":"00","desk_mess":"SUKSES",
		"userid":"dede123",
		"response_data1":"975364534",
		"response_data2":"dede kasep",
		"response_data3":"40623S1",
		"response_data4":"40623",
		"response_data5":"1|19699.99", --jumlah transaksi | jumlah uang
		"wkt_mess":"2019-12-17 13:04:29.265838"}
		
		respon gagal :
		{"messtype":"303","rc_mess":"01",
"desk_mess":"USER AGEN TIDAK DITEMUKAN \/ TIDAK AKTIF",
"userid":"dede123",
"response_data1":"",
"response_data2":"",
"response_data3":"",
"response_data4":"",
"response_data5":"",
"wkt_mess":"2019-12-17 13:06:28.832058"}
		
		*/
		return 0;
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
				/*$result["data"]["messtype"] = $response['messtype'];
				$result["data"]["rc_mess"] = $response['rc_mess'];
				$result["data"]["desk_mess"] = $response['desk_mess'];
				$result["data"]["userid"] = $response['userid'];
				$result["data"]["response_data1"] = $response['response_data1'];
				$result["data"]["response_data2"] = $response['response_data2'];
				$result["data"]["response_data3"] = $response['response_data3'];
				$result["data"]["response_data4"] = $response['response_data4'];
				$result["data"]["response_data5"] = $response['response_data5'];
				*/
				//$result["rc_mess"] = $response['rc_mess'];
				//EC2|xxxx1234R|-|200|4500|500|450|20|pakaian|300000|-|-
				//explode(" - ", $vkt);
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
				//number_format(round($ppnhtnb), 0, ',', '.')
				$datatarif="Bea Dasar : ".number_format($beadasar,0, ',', '.')."\n".
					       "htnb : ".number_format($htnb,0, ',', '.')."\n".
						   "ppn : ".number_format($ppn,0, ',', '.')."\n".	
						   "ppnhtnb : ".number_format($ppnhtnb,0, ',', '.');
				
				$result = array('rc_mess'=> $response['rc_mess'],'desk_mess'=>$response['desk_mess'],
				                'userid'=> $response['userid'],'response_data1'=>$response['response_data1'],
								'response_data2'=> $response['response_data2'],'response_data3'=>$response['response_data3'],
								'response_data4'=> $response['response_data4'],'response_data5'=>$response['response_data5'],
								'datatarif'=>$datatarif,'produk'=>$produk,'total'=>$total,'berat'=>$berat
				);

			}
		}
		echo json_encode($result);

?>