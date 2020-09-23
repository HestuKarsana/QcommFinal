<?php
ob_start();
//session_start();
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * ------------------------------------------------------------------------
 * CLASS NAME : Pemulihan 
 * ------------------------------------------------------------------------
 * template from :
 * @author     Muhammad Akbar <muslim.politekniktelkom@gmail.com>
 * @copyright  2016
 * @license    http://aplikasiphp.net
 *
 *edited :
 * tanggal : 08-12-2019 
 *@author : dtechno 
 */

class Pemulihan extends CI_Controller 
{
	 public function __construct()
    {
        parent::__construct();
 
        // load Session Library
        $this->load->library('session');
         
        // load url helper
        $this->load->helper('url');
    }
	public function index()
	{
		$this->load->view('admin/pemulihan');
		
	}
	
		public function GetData()
	{
			// --------------------------------------
	    /*$result = array(); 
		$key1 = "c67536e59042f4f7049d441a3a5f71e1";
		$key2 = "cd187b9bff4a84415908698f9793098d";
		$tgl=date('Y-m-d') ;
		$password="05144f4e12aaa402aeb51ef2c7dde527";//MD5($key1 + $tgl + "201" + "3171030101710005" + $key2);
		$username='ecom';//"getreport";
		$gab=base64_encode($username.$password);
		//-----------------------------------------------------------------------------------	
		//$kodepossip=$_POST['kodepossip'];
		$messtype="206";//"201";	
		$userid="dede123";
		$param1="975364534|123456789987654321";//;$_POST['IdOrder'];//"3171030101710005";
		$tg1=$_POST['TglAwal'];
		$tg2=$_POST['TglAkhir'];
		$Norek=$_POST['Norek'];
		$tgla=date("Ymd",strtotime($_POST['TglAwal']));
		$tglb=date("Ymd",strtotime($_POST['TglAkhir']));
		
		$param1=$Norek.';'.$tgla.';'.$tglb;
		//$param1="3171030101710005";
		$param2=$Norek;
		$param3="";
		$param4="";
		$param5="";
		
		echo "hasillll : ".$param1;
		echo "<br>norek: ".$param2;
		*/
		// $param1='0200015055;20200102;20200102';//;$_POST['IdOrder'];//"3171030101710005";
		// $param2="0200015055";
		
		
		// $sp_name = 'Ipos_ReportRekapAutoDebet';//'Ipos_ReportRekap';//'Ipos_getPosting';
		// $par_data= $tgl1.'|'.$tgl2;//'00|40000|40511C1|EC2|2019-12-17|2019-12-17';//'900000001|2019-12-19';
		//05|40000|40511C1|EC2|2019-12-17|2019-12-30
		//$sp_name = 'Ipos_ReportRekap';//'Ipos_ReportRekap';//'Ipos_getPosting';
		//$par_data= $RegNya."|".$KprkNya."|0000000|EC2|".$tgl1."|".$tgl2;
		//$par_data= '00|40000|40511C1|EC2|2019-12-17|2019-12-30';
		//$par_data= '00|40000|40511C1|EC2|2019-12-17|2019-12-17';//'2019-12-17|2019-12-24';//'00|40000|40511C1|EC2|2019-12-17|2019-12-17';//'900000001|2019-12-19';
		//echo "pardata : ".$par_data;
	    $result = array(); 
		$key1 = "c67536e59042f4f7049d441a3a5f71e1";
		$key2 = "cd187b9bff4a84415908698f9793098d";
		$tgl=date('Ymd') ;
		$password="05144f4e12aaa402aeb51ef2c7dde527";//MD5($key1 + $tgl + "201" + "3171030101710005" + $key2);
		$username="ecom";
		$gab=base64_encode($username.$password);
		$tg1=$_POST['TglAwal'];
		$tg2=$_POST['TglAkhir'];
		$Norek=$_POST['Norek'];
		$tgla=date("Ymd",strtotime($_POST['TglAwal']));
		$tglb=date("Ymd",strtotime($_POST['TglAkhir']));
		$userlogin=$this->session->userdata('ses_id_user');
		//-----------------------------------------------------------------------------------	
		//$kodepossip=$_POST['kodepossip'];
		$messtype="206";//"201";	
		//$userid="440000024";
		$param1=$Norek.';'.$tgla.';'.$tglb;//;$_POST['IdOrder'];//"3171030101710005";
		
		
		$messtype="303";//"201";	
		$userid="dede123";
		$param1="975364534|123456789987654321";//;$_POST['IdOrder'];//"3171030101710005";
		$param2="";
		$param3="";
		$param4="";
		$param5="";
		$sp_name = 'Ipos_getTblPemulihan';//'Ipos_ReportRekap';//'Ipos_getPosting';
		$par_data=  '1';//$userlogin.'|'.$tg1.'|'.$tg2;//'2019-12-17|2019-12-24';//'00|40000|40511C1|EC2|2019-12-17|2019-12-17';//'900000001|2019-12-19';
		$hash=strtolower (MD5('ecom'.$sp_name.$par_data.$tgl));
			$data_string = '{
				"sp_nama":"'.$sp_name.'",
				"par_data":"'.$par_data.'",
				"hashing":"'.$hash.'"}';
		// $hash=strtolower (MD5($key1.$tgl.$messtype.$param1.$key2));
			// $data_string = '{
				// "messtype":"'.$messtype.'",
				// "param1":"'.$param1.'",
				// "userid":"'.$userid.'",
				// "param2":"'.$param2.'",
				// "param3":"'.$param3.'",
				// "param4":"'.$param4.'",
				// "param5":"'.$param5.'",
				// "hashing":"'.$hash.'"}';
			

		
		$ch = curl_init();
		//curl_setopt($ch, CURLOPT_URL, "https://magenpos.posindonesia.co.id:6466/getreport");  
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
		$response = json_decode($response1, true);
		
		/*
		Array ( [jmldata] => 1 [recordnya] => Array ( [0] => Array ( [respon] => DATA TIDAK DITEMUKAN ) ) )
		*/
		$valid=$response['rc_mess'];
		//print_r("<br>Data ".$valid);
		
			
        $jmldatanya=$response['jmldata'];
		$data=$response['recordnya'];
		$responnya = $response['respon'];
		
		//$cars[0]["type"]
		// $data1=$data[0]["tanggal"];
		// $data2=$data[1]["tanggal"];
		
		
		$htmldata='<center><div id="outtable">
		                
						    <font size=2%><h3>Pemulihan User Pebisol</h3>
									 
									<br>
						  
						     <table id="myTable" name="myTable" class="table table-bordered table-hover table-responsive">
						   
						    <thead>
							<tr bgcolor=#DCDCDC>
							    <th class="short">#</th>
								<th class="normal" align="center">UserID Pebisol</th>
								<th class="normal">Status</th>
								<th class="normal">PIN</th>
								<th class="normal">Pilih</th>
								
								
							</tr>
						</thead>
						<tbody>';
		$no=1;
		if ($jmldatanya=='1') {
			$htmldata.='<tr><td colspan="5">'.$responnya.'</td></tr>';
			
			
		} else {				
								
								for ($i=0; $i < $jmlproduk; $i++)
								{
									$userID=$data[$i]["userID"];
									$statusnya=$data[$i]["status"];
									if($statusnya=='0'){
										
										$status='permintaan generate';
									}
									else if $statusnya=='1' {
										$status=' generate pin berhasil';
										
									} else if $statusnya=='2' {
										$status='pemulihan berhasil';
										
									}
									
									$pin=$data[$i]["pin"];
									
									
									$htmldata.='<tr><td>'.number_format($no,0, ',', '.').'</td>
																<td>'.$userID.'</td>
																<td>'.$status.'</td>
																<td>'.$pin.'</td>
																<td> <button class=btnSelect>Select</button></td>
															</tr>';
									
									
									
									
									$no=$no+1;				
								}
				}				
		           $htmldata.='</tbody></table></font></div></center>';
					$result = array('rc_mess'=>'00','tabel'=> $htmldata);
					echo $htmldata;
		
		curl_close($ch);
	}
	
	
}?>
<script>
$(document).ready(function(){

    // code to read selected table row cell data (values).
    $("#myTable").on('click','.btnSelect',function(){
         // get the current row
         var currentRow=$(this).closest("tr"); 
         
         var col1=currentRow.find("td:eq(1)").text(); // get current row 1st TD value
		 var col2=currentRow.find("td:eq(2)").text(); // get current row 1st TD value
		 var col3=currentRow.find("td:eq(3)").text(); // get current row 1st TD value
         
         var data="<table width=100%>"+
		          "<tr><td>User ID Pebisol</td><td>:</td><td>"+col1+"</td></tr>"+
		          "<tr><td>Status </td><td>:</td><td>"+col2+"</td></tr>"+
				  "<tr><td>PIN</td><td>:</td><td>"+col3+"</td></tr></tabel>";
         
       
	$('.modal-dialog').removeClass('modal-sm');
	$('.modal-dialog').removeClass('modal-lg');
	$('#ModalHeader').html('Detail User Pebisol');
	$('#ModalContent').html(data);//.load($(this).attr('href'));
	$('#ModalGue').modal('show');
	
    });
});
</script>

