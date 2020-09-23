<?php
/*include "../../../../libs/checksession.php";
include "../../../../libs/config.php";
include "../../../../libs/database.php";
include('../config.php');
*/
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
	$messtype="703";	
	$userid="dede12345";
	// $param1="20191213|QOB1247222537|".$userid."|975364534|44100";
	// $param2="EC2|xxxx1234R|-|200|4500|500|450|20|pakaian|300000|-|-";
	// $param3="dede|jalan cijambe saja|cijambe|ujungberung|bandung|jawa barat|indonesia|40601|08823765889|dede@posindonesia.co.id";
	// $param4="-|yuyus|perumahan cimahi nagok rt 12/23 |-|-|cimahi|cimahi|cimahi|cimahi|jawa barat|-|indonesia|40512|086778836633|022432567|yuyus@posindonesia.co.id|-|-";
	// $param5="44100|0|0|1|".$orderDate;
	//------------------------------------------------------------------------------------
	
/*param1 : '20191213|QOB123456789225|UserID|userid_posting|nopen_posting'
  param2 : 'EC2|xxxx1234R|-|200|4500|500|450|20|pakaian|300000|-|-',
  param3 : 'dede|jalan cijambe saja|cijambe|ujungberung|bandung|jawa barat|indonesia|40601|08823765889|dede@posindonesia.co.id',
  param4 : '-|yuyus|perumahan cimahi nagok rt 12/23 |-|-|cimahi|cimahi|cimahi|cimahi|jawa barat|-|indonesia|40512|086778836633|022432567|yuyus@posindonesia.co.id|-|-',
  param5 : 'kantor_tujuan|status_cod|status_bayar|status_kolekting|wkt_kolekting'
  */
	// $messtype="202";	
	// $userid="dede123";
	// $param1="0000000158";
	//$param1="QOB1405072375";
	//$param1= "#1#0#40212#29564#500#0#0#0#0#0";
	//idpel/0ln/1dn/0surat/1paket/asal/tujuan/berat/.../nilai brg
	$berat=200;
	$produk2='240';
	 if(($berat<=2000) and ($produk2=='210')){
							
							$tanda='0';
						}else{
							$tanda='1';
							
						}
	$param1= "#1#".$tanda."#60141#20114#300#0#0#0#0#20000";
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

	
 	$response1 = curl_exec($ch);
 	$err1 = curl_error($ch);
	print_r("<br>".$response1."<br>");
	
	
	curl_close($ch);
	$responsex = json_decode($response1, true);
	//$response = json_decode($response1, true);
	print_r("Hasil <br>".$responsex."<br>");
	$code = $responsex['rc_mess']; 
//	$code =$response['rc_mess'];
	//print_r("<br>Hasil".$code);
	//print_r("<br>".$data_string);
	//print_r("<br>".$data_string);
	
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
										print_r("<br>cekkkk  ".$kodeproduk2[$i]."<br>");
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
									
						
						$result = array('rc_mess'=> $responsex['rc_mess'],'desk_mess'=>$responsex['desk_mess'],
				               'response_data2'=> $response_data2,'tarif'=>$datatarif_kantor_asal
							   );
		}
	}
	echo json_encode($result);
	
?>