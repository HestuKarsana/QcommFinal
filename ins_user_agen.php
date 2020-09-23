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
		$messtype="307";//"201";	
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
		
		param1 : 'userid|password|nama|nohp|email|kprk|nopenagen'
	param2 : 'alamat|propinsi|kota|kecamtan|kelurahan|kodepos'
	MD5($usernamenya.$passwordnya)
	
	LA60135C102	601091256	YUANA	cf0ee3c0bba63bcbda8e5c6c02631123	60135C1	-	-	5	2018-09-05 17:27:27.097	1.3.0
LA60135C101	601124720	yuana	1350e9343a90e550f116f426aa61946d	60135C1	-	-	5	2018-08-13 08:51:27.083	1.3.0
LA60135C103	601194838	Andi	4aaaa8ebd304d1e546bf856913bcb2ca	60135C1	-	-	1	2018-04-06 19:48:37.293	1.3.0
KA60135C1	702957614	ANDI	0bc13b725c38b0860517d5b887cf17bb	60135C1	-	-	1	2016-09-28 18:24:12.030	1.3.0

LA60141C107	601180033	Yuni	a4db2be7961cfb5c3348be1222539eb5	60141C1	-	-	5	2019-01-14 18:00:32.217	1.3.0

60135C1|60000|Agen AA|Jl. Rangka Besar No. 15|60135
60135C1 Agen AA
60141C1|60000|ITC 2|ITC Lantai 1 Blok B8 No. 5|60141

LA40123U103|PASSWORD|SUDIANA|-|-|40000|40123U1|401171239
LA40123U101|PASSWORD|YOPI ISKANDAR|-|-|40000|40123U1|401170801
LA40123U104|PASSWORD|ASEP KOSWARA|-|-|40000|40123U1|401171446
LA40123U105|PASSWORD|GUM GUMURAH|-|-|40000|40123U1|401171546
LA40123U106|PASSWORD|ADI HERYANTO|-|-|40000|40123U1|401171648
LA40123U107|PASSWORD|IWAN DARSONO|-|-|40000|40123U1|401171740
LA40123U110|PASSWORD|INTAN MARTHA LESTARI|-|-|40000|40123U1|401172343
KA40123U1|PASSWORD|GUM|-|-|40000|40123U1|160974709

LA40123U109|PASSWORD|MUHAMMAD RIDWAN|-|-|40000|40123U1|401172040

LA40123U111|PASSWORD|FIKRI RAFIANSYAH|-|-|40000|40123U1|401151924
LA40123U108|PASSWORD|AGUS ZULKARNAEN|-|-|40000|40123U1|401171905

Rika S, [17.01.20 17:38]
LA40123U109

Rika S, [17.01.20 17:38]
AGen123#

CALL Ipos_InsertUserAgen('307','{"param1":"LA40123U102|ae3c3456c343db69b49fc8d46e712554|ASEP KARTIWA|-|-|40000|40123U1|401171025",
    "param2":"-|JAWA BARAT|BANDUNG|SUKALUYU|SUKALUYU|40123"}')

	*/
		$userid='LA40123U109';
		$passwordnya='AGen123#';
		$password= MD5($userid.$passwordnya);
		$nama='MUHAMMAD RIDWAN';
		$nohp='-';
		$email='-';
		$kprk='40000';
		$nopenagen='40123U1';
		$alamat='-';
		$propinsi='JAWA BARAT';
		$kota='BANDUNG';
		$kecamtan='SUKALUYU';
		$kelurahan='SUKALUYU';
		$kodepos='40123';
		$nippos='401172040';
		/*
		param1 = LA40123U102|PASSWORD|ASEP KARTIWA|-|-|40000|40123U1|401171025
				
		param2=BANDUNG|JAWA BARAT|BANDUNG|SUKALUYU|SUKALUYU|40123	
				
		*/
		$param1=$userid.'|'.$password.'|'.$nama.'|'.$nohp.'|'.$email.'|'.$kprk.'|'.$nopenagen.'|'.$nippos;
		$param2=$alamat.'|'.$propinsi.'|'.$kota.'|'.$kecamtan.'|'.$kelurahan.'|'.$kodepos;
		
		//echo 'param1'.$param1 .'<br>param2'.$param2;
		//return 0;
		
		//$param1='60141C1|60000|ITC 2|ITC Lantai 1 Blok B8 No. 5|60141';
		//$param1 : 'LA60135C102|password|nama|nohp|email|kprk|nopenagen'
		//;$_POST['IdOrder'];//"3171030101710005"; QOB123456789222
		//$param2="EC2|201912121234R|-|200|4500|500|450|20|kasurkarpet|300000|-|-"; //detil kiriman 
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
		print_r($response1);
		
		$code = $response['rc_mess']; 
		return 0;
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