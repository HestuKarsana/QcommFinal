<?php
//baca file txt
/*
$file_handle = fopen("nopenagen_coba.txt", "rb");
while (!feof($file_handle) ) {
    $line_of_text = fgets($file_handle);
	*/
    /*$parts = $line_of_text;//explode('|', $line_of_text);
	$parts = explode('|', $line_of_text);
	$nopen ='';
	$kprk='';
	$ketnopen='';
	$alamat='';
	$kodepos='';
	$param1='';
	$nopen =$parts[0];
		$kprk=$parts[1];
		$ketnopen=$parts[2];
		$alamat=$parts[3];
		$kodepos=$parts[4];
	$param1 =$nopen.'|'.$kprk .'|'.$ketnopen.'|'.$alamat.'|'.$kodepos;
	echo  $line_of_text .'<br>';
	$nopen ='';
	$kprk='';
	$ketnopen='';
	$alamat='';
	$kodepos='';
	$param1='';
	}		
fclose($file_handle);	
return 0;
*/
	
    //echo $nopen.' - '.$ketnopen.' - '.$alamat.' - '.$kodepos. '<br>';
/*
{ "messtype":"306", "param1":"100C001|10000|Agenpos Plazindo|Agenpos Plazindo|10110", 
"userid":"440000024", "param2":"EC2|201912121234R|-|200|4500|500|450|20|kasurkarpet|300000|-|-", 
"param3":"iwan|jalan cimaragas|cimaragas|cilawu|garut|jawa barat|indonesia|44181|08823765889|iwan@posindonesia.co.id", "param4":"-|asepso|perumahan cimahi nagok rt 12/23 |-|-|cimahi|cimahi|cimahi|cimahi|jawa barat|-|indonesia|40512|086778836633|022432567|yuyus@posindonesia.co.id|-|-", "param5":"0|0|-|0", "hashing":"eb00bb245ea4eeee43319b61c959acc4", "wkt_mess":"2019-12-12 14:34:36.000"	}

Array ( [messtype] => 306 [rc_mess] => 00 
[desk_mess] => SUKSES [userid] => 440000024 
[response_data1] => BERHASIL DISIMPAN [response_data2] => [response_data3] => [response_data4] => [response_data5] => [wkt_mess] => 2020-01-13 11:59:32.267148 ) 

{"messtype":"306","rc_mess":"00","desk_mess":"SUKSES","userid":"440000024","response_data1":"BERHASIL DISIMPAN","response_data2":"","response_data3":"","response_data4":"","response_data5":"","wkt_mess":"2020-01-13 11:59:32.267148"}


*/
//end of baca txt
		//$parts ='50134C2|50000|Pekunden|Pekunden Tengah No 1045 Semarang 50134|50134';
		// --------------------------------------
		$result = array(); 
		$key1 = "c67536e59042f4f7049d441a3a5f71e1";
		$key2 = "cd187b9bff4a84415908698f9793098d";
		$tgl=date('Ymd') ;
		date_default_timezone_set('Asia/Jakarta');
		$orderDate=date("Y-m-d H:i:s");
		$password="05144f4e12aaa402aeb51ef2c7dde527";//MD5($key1 + $tgl + "201" + "3171030101710005" + $key2);
		$username="ecom";
		$gab=base64_encode($username.$password);
		//-----------------------------------------------------------------------------------	
		//$kodepossip=$_POST['kodepossip'];
		$messtype="306";//"201";	
		$userid="440000024"; //QOB201912120001|9
		//$idorder='QOB'.rand(10000000000,99999999999);
		  
		$no_group_order='-';
		//$param1=$orderDate."|02|".$userid."|".$no_group_order;
		/*$nopen ='100C001';
		$kprk='10000';
		$ketnopen='Agenpos Plazindo';
		$alamat='Agenpos Plazindo';
		$kodepos='10110';
		*/
		/*$nopen =$parts[0];
		$kprk=$parts[1];
		$ketnopen=$parts[2];
		$alamat=$parts[3];
		$kodepos=$parts[4];
		
		$param1 =$nopen.'|'.$kprk .'|'.$ketnopen.'|'.$alamat.'|'.$kodepos;
	*/
		$param1='40123U1|40000|BANDUNGSUKALUYU|Jl. Pahlawan No.87|40123';
		//;$_POST['IdOrder'];//"3171030101710005"; QOB123456789222
		$param2="EC2|201912121234R|-|200|4500|500|450|20|kasurkarpet|300000|-|-"; //detil kiriman 
		$param3="iwan|jalan cimaragas|cimaragas|cilawu|garut|jawa barat|indonesia|44181|08823765889|iwan@posindonesia.co.id"; //detil pengirim
		$param4="-|asepso|perumahan cimahi nagok rt 12/23 |-|-|cimahi|cimahi|cimahi|cimahi|jawa barat|-|indonesia|40512|086778836633|022432567|yuyus@posindonesia.co.id|-|-"; //detil penerima
		//$param5="0|0"; //kode cod (1:COD , 0 : bukan COD), kodebayar : 0
		//$param5="0|0|60012345678|0"; //kode cod (1:COD , 0 : bukan COD)|nilaiCOD|VA|status kiriman = 0 (pra kolekting)
		$param5="0|0|-|0"; //kode cod (1:COD , 0 : bukan COD)|nilaiCOD|VA|status kiriman = 0 (pra kolekting)
		
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
				"wkt_mess":"2019-12-12 14:34:36.000"			
				}';
			//echo $data_string."<p>";
			
			
		//------------------------------------------------------------------------------------
		
		// $messtype="202";	
		// $userid="dede123";
		// $param1="0000000158";
		// $param2="";
		// $param3="";
		// $param4="";
		// $param5="";
		//hashing = $key1.$tgl.$messtype.$param1.$key2
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
				"hashing":"'.$hash.'",
				"wkt_mess":"'.$orderDate.'"		
				}';
			
	
		
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
		//print_r($response);
		$code = $response['rc_mess']; 
//		$code =$response['rc_mess'];
		//print_r("<br>Hasil".$code);
//		print_r("<br>".$hash);

/*
Array ( 
[messtype] => 306 
[rc_mess] => 00 
[desk_mess] => SUKSES 
[userid] => 440000024 
[response_data1] => BERHASIL DISIMPAN 
[response_data2] => [response_data3] => [response_data4] => [response_data5] => [wkt_mess] => 2020-01-13 11:59:32.267148 ) 
*/
		if ($response =='') {
			$result["success"] = false;
			$result["errors"]["iderror"] = "801";
			$result["errors"]["error"] = "Tidak terhubung ke service";
		} 
		else{
			if($code<>'00') {
				$result["success"] = false;
				$result["errors"]["iderror"] = $code;
				$result["errors"]["error"] = $response['desk_mess'] ; 
			}else {
				$result["success"] = true;
				$result = array('rc_mess'=> $response['rc_mess'],'desk_mess'=>$response['desk_mess'],
				                'userid'=> $response['userid'],'response_data1'=>$response['response_data1'],
								'response_data2'=> $response['response_data2'],'response_data3'=>$response['response_data3'],
								'response_data4'=> $response['response_data4'],'response_data5'=>$response['response_data5']
				);
				
				//$datakiriman=explode("|",$response['response_data1']);
				//$idorder=$datakiriman[0];
				//$pelanggan=$datakiriman[1];
			}
		
		
		}
		echo '['.$response['desk_mess'].' ]';//.$line_of_text.'<br>';
/*
}		
fclose($file_handle);	
*/

		

	

?>