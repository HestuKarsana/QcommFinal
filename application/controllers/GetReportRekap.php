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

class GetReportRekap extends CI_Controller {

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
		$this->load->view('laporan');
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
		
		$KpcNya1=$_POST['Kpcnya'];
		$KpcNya2=explode("|",$KpcNya1);
		$KpcNya=$KpcNya2[0];	
		
		//$param1="975364534|12345678";
		//$param1="3171030101710005";
		$param2="";
		$param3="";
		$param4="";
		$param5="";
		// $sp_name = 'Ipos_ReportRekapAutoDebet';//'Ipos_ReportRekap';//'Ipos_getPosting';
		// $par_data= $tgl1.'|'.$tgl2;//'00|40000|40511C1|EC2|2019-12-17|2019-12-17';//'900000001|2019-12-19';
		//05|40000|40511C1|EC2|2019-12-17|2019-12-30
		$sp_name = 'Ipos_ReportRekap';//'Ipos_ReportRekap';//'Ipos_getPosting';
		$par_data= $RegNya."|".$KprkNya."|".$KpcNya."|EC2|".$tgl1."|".$tgl2;
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
		curl_close($ch);
		$response = json_decode($response1, true);
		//print_r($response);
		//print_r($response['jmldata']);
		//return 0;
		//print_r("<br>disini");
		$jmlproduk=$response['jmldata'];
		$data=$response['recordnya'];
		//$cars[0]["type"]
		// $data1=$data[0]["tanggal"];
		// $data2=$data[1]["tanggal"];
		//<table id="tabel_autodebet" name="tabel_autodebet" class="table table-bordered table-hover table-responsive">
			  
		$htmldata='<center><div id="outtable">
		          <font size=2%><h3>REKAP TRANSAKSI</h3>
		                 Tanggal : '.$tgl1.' s/d '.$tgl2.'
		                <br>
		      <table cellspacing=0 border=1>
			<thead>
				<tr bgcolor=#DCDCDC>
					<th class="short">#</th>
					<th class="normal" align="center">Kode Kantor</th>
					<th class="normal">Produk</th>
					<th class="normal">Jml</th>
					<th class="normal">Berat</th>
					<th class="normal">Bea</th>
					<th class="normal">HTNB</th>
					<th class="normal">PPN</th>
					<th class="normal">PPN HTNB</th>
					
					
				</tr>
			</thead>
			<tbody>';
		
		// echo"<table border='1'>
		      // <tr>
			     // <td>#</td><td>Tanggal</td><td>UserID</td><td>Nama</td><td>Rekening Giro</td>
				 // <td>Nominal</td><td>Status</td></tr>";
		//$no=0;
			
		$no=0;$tjml_trans=0;$ttotal_berat=0;$ttotal_bea=0;
		$N=1;  $M=1;
		
		for ($i=0; $i < $jmlproduk; $i++)
		{
			if(($RegNya=='00') and ($KprkNya=='00000') and ($KpcNya=='')){
				$reg=$data[$i]["reg"];
			}else if(($RegNya<>'00') and ($KprkNya=='00000') and ($KpcNya=='')){
			
				$reg=$data[$i]["kprk"];
				
			}else if(($RegNya<>'00') and ($KprkNya<>'00000') and ($KpcNya=='0000000')){
			
				$reg=$data[$i]["nopen"];
				
			}
			
			
			$produk=$data[$i]["produk"];
			$jml=$data[$i]["jml"];
			$berat=$data[$i]["berat"];
			$beadasar=$data[$i]["beadasar"];
			$htnb=$data[$i]["htnb"];
			$ppn=$data[$i]["ppn"];
			$ppnhtnb=$data[$i]["ppnhtnb"];
			
			$tjml=$tjml+$jml;
			$tberat=$tberat+$berat;
			$tbeadasar=$tbeadasar+$beadasar;
			$thtnb=$thtnb+$htnb;
			$tppn=$tppn+$ppn;
			$tppnhtnb=$tppnhtnb+$ppnhtnb;
			
			$no=$no+1;
			$htmldata.='<tr><td align=center>'.number_format($no,0, ',', '.').'</td>
							<td align=center>'.$reg.'</td>
							<td align=center>'.$produk.'</td>
							<td align=right>'.number_format($jml,0, ',', '.').'</td>
							<td align=right>'.number_format($berat,0, ',', '.').'</td>
							<td align=right>'.number_format($beadasar,0, ',', '.').'</td>
							
							<td align=right>'.number_format($htnb,0, ',', '.').'</td>
							<td align=right>'.number_format($ppn,0, ',', '.').'</td>
							<td align=right>'.number_format($ppnhtnb,0, ',', '.').'</td>
							
						</tr>';
		}
		$htmldata.='<tr>
	                    <td colspan="3" align=right><b>TOTAL TRANSAKSI </b></td>
						<td align=right>'.number_format($tjml,0, ',', '.').'</td>
						<td align=right>'.number_format($tberat,0, ',', '.').'</td>
						<td align=right>'.number_format($tbeadasar,0, ',', '.').'</td>
						<td align=right>'.number_format($thtnb,0, ',', '.').'</td>
						<td align=right>'.number_format($tppn,0, ',', '.').'</td>
						<td align=right>'.number_format($tppnhtnb,0, ',', '.').'</td>
		
					</tr>
					</tbody></table></font></div></center>';
					
		$result = array('rc_mess'=>'00','tabel'=> $htmldata);
	//	return 0;
		//echo json_encode($result);
        echo $htmldata;
	}
	
	
}
?>
