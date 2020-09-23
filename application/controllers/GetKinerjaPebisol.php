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

class GetKinerjaPebisol extends CI_Controller {

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
		$this->load->view('laporan_kinerja_pebisol');
	}
	
	public function GetData()
	{
			// --------------------------------------
	$result = array(); 
		$key1 = "c67536e59042f4f7049d441a3a5f71e1";
		$key2 = "cd187b9bff4a84415908698f9793098d";
		$tgl=date('Y-m-d') ;
		$password="05144f4e12aaa402aeb51ef2c7dde527";//MD5($key1 + $tgl + "201" + "3171030101710005" + $key2);
		$username='ecom';//"getreport";
		$gab=base64_encode($username.$password);
		//-----------------------------------------------------------------------------------	
		//$kodepossip=$_POST['kodepossip'];
		$messtype="303";//"201";	
		$userid="dede123";
		$param1="975364534|123456789987654321";//;$_POST['IdOrder'];//"3171030101710005";
		$tgl1=$_POST['TglAwal'];
		$tgl2=$_POST['TglAkhir'];
		$RegNya=$_POST['RegNya'];
		$KprkNya1=$_POST['KprkNya'];
		$KprkNya2=explode("|",$KprkNya1);
		$KprkNya=$KprkNya2[0];		
		
		//$param1="975364534|12345678";
		//$param1="3171030101710005";
		$param2="";
		$param3="";
		$param4="";
		$param5="";
		// $sp_name = 'Ipos_ReportRekapAutoDebet';//'Ipos_ReportRekap';//'Ipos_getPosting';
		// $par_data= $tgl1.'|'.$tgl2;//'00|40000|40511C1|EC2|2019-12-17|2019-12-17';//'900000001|2019-12-19';
		//05|40000|40511C1|EC2|2019-12-17|2019-12-30
		$sp_name = 'Ipos_getRekapPebisol';//'Ipos_ReportRekap';//'Ipos_getPosting';
		$par_data= $RegNya."|".$KprkNya."|00|".$tgl1."|".$tgl2;
		//$par_data= '00|40000|40511C1|EC2|2019-12-17|2019-12-30';
		//$par_data= '00|40000|40511C1|EC2|2019-12-17|2019-12-17';//'2019-12-17|2019-12-24';//'00|40000|40511C1|EC2|2019-12-17|2019-12-17';//'900000001|2019-12-19';
		//echo "pardata : ".$par_data;
		$hash=strtolower (MD5('ecom'.$sp_name.$par_data.$tgl));
			$data_string = '{
				"sp_nama":"'.$sp_name.'",
				"par_data":"'.$par_data.'",
				"hashing":"'.$hash.'"}';
			
	
		
		$ch = curl_init(); //getreport
		//curl_setopt($ch, CURLOPT_URL, "https://magenpos.posindonesia.co.id:6466/a767e8eec95442bda80c4e35e0660dbb");    
		curl_setopt($ch, CURLOPT_URL, "https://qcomm.posindonesia.co.id:10444/getreport"); 
        //curl_setopt($ch, CURLOPT_URL, "https://qcomm.posindonesia.co.id:10444/a767e8eec95442bda80c4e35e0660dbb");    
	 		
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
		//print_r($response);
		//print_r($response['jmldata']);
		//return 0;
		//print_r("<br>disini");
		$jmlproduk=$response['jmldata'];
		$data=$response['recordnya'];
		$Rmpgrp='';
		//$cars[0]["type"]
		// $data1=$data[0]["tanggal"];
		// $data2=$data[1]["tanggal"];
		//<table id="tabel_autodebet" name="tabel_autodebet" class="table table-bordered table-hover table-responsive">
		$htmldata='<center><div id="outtable">
		       <font size=2%>	  
				<h3>LAORAN KINERJA PEBISOL</h3>
		                 Tanggal : '.$tgl1.' s/d '.$tgl2.'
		                <br>
		      <table cellspacing=0 id=myTable border=1>
			  <thead>
				<tr bgcolor=#DCDCDC>
					
					
					<th class="short">#</th>
					<th class="normal" align="center">Regional</th>
					<th class="normal">Kprk</th>
					<th class="normal">Member ID</th>
					<th class="normal">Nama Usaha</th>
					<th class="normal">Omzet /Bln</th>
					<th class="normal">Pilih</th>
								
					
				</tr>
			</thead>
			<tbody>';

			
		$no=0;$tjml_trans=0;$ttotal_berat=0;$ttotal_bea=0;
		$N=1;  $M=1;
		for ($i=0; $i < $jmlproduk; $i++)
		{
			//$userid_posting=$data[$i]["userid_posting"];
			$userID=$data[$i]["userID"];
			$rekgiro=$data[$i]["rekgiro"];
			$detail_usaha=$data[$i]["detail_usaha"];
			$fullname=$data[$i]["fullname"];
			$detail_alamat=$data[$i]["detail_alamat"];
			$nophone=$data[$i]["nophone"];
			$email=$data[$i]["email"];
			$jml_trans=$data[$i]["jml_trans"];
			$total_berat=$data[$i]["total_berat"];
			$total_bea=$data[$i]["total_bea"];
			$kprk=$data[$i]["kprk"];
			$reg=$data[$i]["reg"];
			$tgl_registrasi=$data[$i]["tgl_registrasi"];
			
			$tjml_trans=$tjml_trans+$jml_trans;
			$ttotal_berat=$ttotal_berat+$total_berat;
			$ttotal_bea=$ttotal_bea+$total_bea;
			$group="Regional ".$reg;
			
			$no=$no+1;
			/*
			$htmldata.='<tr><td align=center>'.$no.'</td>
                            <td align=center>'.$reg.'</td>
							<td align=center>'.$kprk.'</td>
			      			<td align=center>'.$userID.'</td>
							<td align=center>'.$detail_usaha.'</td>
							<td align=right>'.number_format($total_bea,0, ',', '.').'</td>
						</tr>';
			*/
			if($group==$Rmpgrp) 
			{
		 		
				$Rmpgrp=$group;
				$htmldata.='<tr><td align=center>'.$no.'</td>
                            <td align=center>'.$reg.'</td>
							<td align=center>'.$kprk.'</td>
			      			<td align=center>'.$userID.'</td>
							<td align=center>'.$detail_usaha.'</td>
							<td align=right>'.number_format($total_bea,0, ',', '.').'</td>
							<td style=display:none;>'.$fullname.'</td>
							<td style=display:none;>'.$detail_alamat.'</td>
							<td style=display:none;>'.$nophone.'</td>
							<td style=display:none;>'.$email.'</td>
							<td style=display:none;>'.$tgl_registrasi.'</td>
							<td style=display:none;>'.$reg.'</td>
							<td style=display:none;>'.$kprk.'</td>
							<td align=center> <button class=btnSelect>Select</button></td>
						</tr>';
				
		 		
		 	} else 
			{
		 		if($Rmpgrp='')
				{
				
		 			$Rmpgrp=$group;
					$htmldata.='<tr>
								<td colspan=2><b>'.$Rmpgrp.' </b></td>
							</tr>
							<tr><td align=center>'.$no.'</td>
                            <td align=center>'.$reg.'</td>
							<td align=center>'.$kprk.'</td>
			      			<td align=center>'.$userID.'</td>
							<td align=center>'.$detail_usaha.'</td>
							<td align=right>'.number_format($total_bea,0, ',', '.').'</td>
							<td style=display:none;>'.$fullname.'</td>
							<td style=display:none;>'.$detail_alamat.'</td>
							<td style=display:none;>'.$nophone.'</td>
							<td style=display:none;>'.$email.'</td>
							<td style=display:none;>'.$tgl_registrasi.'</td>
						    <td style=display:none;>'.$reg.'</td>
							<td style=display:none;>'.$kprk.'</td>
							<td align=center> <button class=btnSelect>Select</button></td>
						</tr>';
						
		 			
		 		} else 
				{
		 			
					$Rmpgrp=$group;
		 			  if($M > 1)
					  {
						 
						$htmldata.="<tr>
							<td colspan='5' class=hdrlapgrp align='center'><b>SUB TOTAL</b></td>
							<td class=hdrlapgrp align='right'>".number_format($tt8,0, ',', '.')."</td>
						</tr>";
						$tt8=0;
						
					}
					$M++;
					$htmldata.='<tr>
								<td colspan=2><b>'.$Rmpgrp.' </b></td>
							</tr>
							<tr><td align=center>'.$no.'</td>
                            <td align=center>'.$reg.'</td>
							<td align=center id=kprk>'.$kprk.'</td>
			      			<td align=center>'.$userID.'</td>
							<td align=center>'.$detail_usaha.'</td>
							<td align=right>'.number_format($total_bea,0, ',', '.').'</td>
							<td style=display:none;>'.$fullname.'</td>
							<td style=display:none;>'.$detail_alamat.'</td>
							<td style=display:none;>'.$nophone.'</td>
							<td style=display:none;>'.$email.'</td>
							<td style=display:none;>'.$tgl_registrasi.'</td>
						    <td style=display:none;>'.$reg.'</td>
							<td style=display:none;>'.$kprk.'</td>
						<td align=center> <button class=btnSelect>Select</button></td>
						</tr>';
		 		}
		 	}
			$tt8 +=$total_bea;
			$N++;
			
			
		}				
		$htmldata.='<tr>
	                    <td colspan="5" align=right><b>SUB TOTAL </b></td>
						<td align=right>'.number_format($tt8,0, ',', '.').'</td>
					</tr>';
		$htmldata.='<tr>
	                    <td colspan="5" align=right><b>TOTAL TRANSAKSI </b></td>
						<td align=right>'.number_format($ttotal_bea,0, ',', '.').'</td>
					</tr></tbody></table></font></div></center>';
					
		$result = array('rc_mess'=>'00','tabel'=> $htmldata);
	//	return 0;
		//echo json_encode($result);
        echo $htmldata;
	}
	
	
}

?>
<script>
$(document).ready(function(){

    // code to read selected table row cell data (values).
    $("#myTable").on('click','.btnSelect',function(){
         // get the current row
         var currentRow=$(this).closest("tr"); 
         
         var col6=currentRow.find("td:eq(6)").text(); // get current row 1st TD value
         var col7=currentRow.find("td:eq(7)").text(); // get current row 2nd TD
         var col8=currentRow.find("td:eq(8)").text(); // get current row 3rd TD
         var col9=currentRow.find("td:eq(9)").text(); // get current row 3rd TD
         var col10=currentRow.find("td:eq(10)").text(); // get current row 3rd TD
         var col11=currentRow.find("td:eq(11)").text(); // get current row 3rd TD
         var col12=currentRow.find("td:eq(12)").text(); // get current row 3rd TD
         //var data=col7+"\n"+col2+"\n"+col3;
         var data="<table width=100%><tr><td>Nama</td><td>:</td><td>"+col6+"</td></tr>"+
		          "<tr><td>Alamat</td><td>:</td><td>"+col7+"</td></tr>"+
				  "<tr><td>Tlp</td><td>:</td><td>"+col8+"</td></tr>"+
				  "<tr><td>Email</td><td>:</td><td>"+col9+"</td></tr>"+
				  "<tr><td>Tgl Registrasi</td><td>:</td><td>"+col10+"</td></tr>"+
				  "<tr><td>Regional</td><td>:</td><td>"+col11+"</td></tr>"+
				  "<tr><td>Kprk</td><td>:</td><td>"+col12+"</td></tr></tabel>";
         
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
	$('#ModalHeader').html('Detail MemberID');
	$('#ModalContent').html(data);//.load($(this).attr('href'));
	$('#ModalGue').modal('show');
	
    });
});
</script>
