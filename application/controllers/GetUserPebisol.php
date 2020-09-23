<style type="text/css">
	  #outtable{
	  	padding: 20px;
	  	border:1px solid #e3e3e3;
	  	width:1000px;
	  	border-radius: 5px;
	  }
 
	  .short{
	  	width: 50px;
	  }
 
	  .normal{
	  	width: 150px;
	  }
      table{
      	border-collapse: collapse;
      	font-family: arial;
      	color:#5E5B5C;
      }
 
      thead th{
      	text-align: center;
      	padding: 10px;
      }
 
      tbody td{
      	border-top: 1px solid #e3e3e3;
      	padding: 10px;
      }
 
      tbody tr:nth-child(even){
      	background: #F6F5FA;
      }
 
      tbody tr:hover{
      	background: #EAE9F5
      }
	</style>
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class GetUserPebisol extends CI_Controller {

     public function __construct()
    {
        parent::__construct();
 
        // load Session Library
        $this->load->library('session');
         
        // load url helper
        $this->load->helper('url');
    }
	//$datanya='';
	
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
		$this->load->view('laporan/pemulihan_user_pebisol');
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
									$id_external=$data[$i]["id_external"];
									$nmpengirim=$data[$i]["nmpengirim"];
									$alamatpengirim=$data[$i]["alamatpengirim"];
									$kotapengirim=$data[$i]["kotapengirim"];
									$nmpenerima=$data[$i]["nmpenerima"];
									$alamatpenerima=$data[$i]["alamatpenerima"];
									$kotapenerima=$data[$i]["kotapenerima"];
									$status_kiriman=$data[$i]["status_kiriman"];
									//$no=$no+1;
									if($status_kiriman=='1'){
										
										$status='Kolekting';
									}
									else{
										$status='Order';
										
									}
									$htmldata.='<tr><td>'.number_format($no,0, ',', '.').'</td>
																<td>'.$userID.'</td>
																<td>'.$id_external.'</td>
																<td>'.$status.'</td>
																<td style=display:none;>'.$nmpengirim.'</td>
																<td style=display:none;>'.$alamatpengirim.'</td>
																<td style=display:none;>'.$kotapengirim.'</td>
																<td style=display:none;>'.$nmpenerima.'</td>
																<td style=display:none;>'.$alamatpenerima.'</td>
																<td style=display:none;>'.$kotapenerima.'</td>
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
	
	
}
?>
<script>
$(document).ready(function(){

    // code to read selected table row cell data (values).
    $("#myTable").on('click','.btnSelect',function(){
         // get the current row
         var currentRow=$(this).closest("tr"); 
         
         var col4=currentRow.find("td:eq(4)").text(); // get current row 1st TD value
         var col5=currentRow.find("td:eq(5)").text(); // get current row 2nd TD
         var col6=currentRow.find("td:eq(6)").text(); // get current row 3rd TD
         var col7=currentRow.find("td:eq(7)").text(); // get current row 3rd TD
         var col8=currentRow.find("td:eq(8)").text(); // get current row 3rd TD
         var col9=currentRow.find("td:eq(9)").text(); // get current row 3rd TD
         //var data=col7+"\n"+col2+"\n"+col3;
         var data="<table width=100%>"+
		          "<tr><td># Nama Pengirim</td><td>:</td><td>"+col4+"</td></tr>"+
		          "<tr><td>Alamat Pengirim</td><td>:</td><td>"+col5+"</td></tr>"+
				  "<tr><td>Kota Pengirim</td><td>:</td><td>"+col6+"</td></tr>"+
				  "<tr><td># Nama Penerima</td><td>:</td><td>"+col7+"</td></tr>"+
				  "<tr><td>Alamat Penerima</td><td>:</td><td>"+col8+"</td></tr>"+
				  "<tr><td>Kota Penerima</td><td>:</td><td>"+col9+"</td></tr></tabel>";
         
       // alert(data);
		 
	/*	$('.modal-dialog').removeClass('modal-lg');
		$('.modal-dialog').addClass('modal-sm');
		$('#ModalHeader').html('INFO');
		$('#ModalContent').html(data);
		$('#ModalGue').modal('show');
		//$('#ModalGue').width:'auto'
		*/
	$('.modal-dialog').removeClass('modal-sm');
	$('.modal-dialog').removeClass('modal-lg');
	$('#ModalHeader').html('Detail Order');
	$('#ModalContent').html(data);//.load($(this).attr('href'));
	$('#ModalGue').modal('show');
	
    });
});
</script>
