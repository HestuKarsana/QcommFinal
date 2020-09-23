<?php
//Ipos_GetIdkolektingBayar('QOB220141667172|60135C102|60135C1|02');

$result = array(); 
		$key1 = "c67536e59042f4f7049d441a3a5f71e1";
		$key2 = "cd187b9bff4a84415908698f9793098d";
		$tgl=date('Ymd') ;
		$password="05144f4e12aaa402aeb51ef2c7dde527";//MD5($key1 + $tgl + "201" + "3171030101710005" + $key2);
		$username="ecom";
		$gab=base64_encode($username.$password);
		// $tg1=$_POST['TglAwal'];
		// $tg2=$_POST['TglAkhir'];
		// $Norek=$_POST['Norek'];
		// $tgla=date("Ymd",strtotime($_POST['TglAwal']));
		// $tglb=date("Ymd",strtotime($_POST['TglAkhir']));
		// $userlogin=$this->session->userdata('ses_id_user');
		//-----------------------------------------------------------------------------------	
		//$kodepossip=$_POST['kodepossip'];
		$messtype="206";//"201";	
		//$userid="440000024";
		//$param1=$Norek.';'.$tgla.';'.$tglb;//;$_POST['IdOrder'];//"3171030101710005";
		
		
		$messtype="303";//"201";	
		$userid="dede123";
		$param1="975364534|123456789987654321";//;$_POST['IdOrder'];//"3171030101710005";
		$param2="";
		$param3="";
		$param4="";
		$param5="";
		//Ipos_getTransCurrent_PerLoket
		$sp_name = 'Ipos_getTransCurrent_PerLoket';//'Ipos_ReportRekap';//'Ipos_getPosting';
		//$sp_name = 'Ipos_GetIdkolektingBayar';//'Ipos_ReportRekap';//'Ipos_getPosting';
		$par_data= '20200117|40123U1|401171025';//$userlogin.'|'.$tg1.'|'.$tg2;//'2019-12-17|2019-12-24';//'00|40000|40511C1|EC2|2019-12-17|2019-12-17';//'900000001|2019-12-19';
		$hash=strtolower (MD5('ecom'.$sp_name.$par_data.$tgl));
			$data_string = '{
				"sp_nama":"'.$sp_name.'",
				"par_data":"'.$par_data.'",
				"hashing":"'.$hash.'"}';
		

		//print_r("<br>Data ".$par_data);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "https://qcomm.posindonesia.co.id:10444/getreport");  
		
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
		curl_close($ch);
		$response = json_decode($response1, true);
		//print_r("<br>Data ".$response1);
		$code = $response['rc']; 
		$jmlproduk=$response['jmldata'];
		$data=$response['recordnya'];
		print_r("par1 : ".$data[0]['keterangan1']."<br>");
		print_r("par2 : ".$data[0]['keterangan2']."<br>");
		print_r("par3 : ".$data[0]['keterangan3']."<br>");
		print_r("par4 : ".$data[0]['keterangan4']."<br>");
		print_r($response);
		//print_r("iihhhh  <br>".$response["rc"]);
                $par1= $response['keterangan1'];
				// $par2= $response['response_data2'];
				// $par3= $response['response_data3'];
				// $par4= $response['response_data4'];
				
				//print_r("Hasil <br>".$par1);

?>