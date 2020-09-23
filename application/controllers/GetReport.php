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

class GetReport extends CI_Controller {

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
		
		//$param1="975364534|12345678";
		//$param1="3171030101710005";
		$param2="";
		$param3="";
		$param4="";
		$param5="";
		$sp_name = 'Ipos_ReportRekapAutoDebet';//'Ipos_ReportRekap';//'Ipos_getPosting';
		//$par_data= '2019-12-17|2019-12-24';//'00|40000|40511C1|EC2|2019-12-17|2019-12-17';//'900000001|2019-12-19';
		$par_data= $tgl1.'|'.$tgl2;//'00|40000|40511C1|EC2|2019-12-17|2019-12-17';//'900000001|2019-12-19';
		$hash=strtolower (MD5('ecom'.$sp_name.$par_data.$tgl));
			$data_string = '{
				"sp_nama":"'.$sp_name.'",
				"par_data":"'.$par_data.'",
				"hashing":"'.$hash.'"}';
			
	
		
		$ch = curl_init(); //getreport
		//curl_setopt($ch, CURLOPT_URL, "https://magenpos.posindonesia.co.id:6466/a767e8eec95442bda80c4e35e0660dbb");    
//		curl_setopt($ch, CURLOPT_URL, "https://magenpos.posindonesia.co.id:6466/getreport");
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
		
		$htmldata='<center><div id="outtable">
		   <font size=2%>
		
		<h3>REKAP AUTO DEBET</h3>
		                 Tanggal : '.$tgl1.' s/d '.$tgl2.'
		                <br>
		     <table cellspacing=0 border=1>
			  <thead>
				<tr bgcolor=#DCDCDC>
					
					<th class="short">#</th>
					<th class="normal" align="center">Tanggal</th>
					<th class="normal">UserID</th>
					<th class="normal">Nama</th>
					<th class="normal">Rekening</th>
					<th class="normal">Nominal</th>
					<th class="normal">Status</th>
					
				</tr>
			</thead>
			<tbody>';
		
		$no=0;
		for ($i=0; $i < $jmlproduk; $i++)
		{
			$tanggal=$data[$i]["tanggal"];
			$userid=$data[$i]["userid"];
			$fullname=$data[$i]["fullname"];
			$rekgiro=$data[$i]["rekgiro"];
			$nominal=$data[$i]["nominal"];
			$status=$data[$i]["status"];
			$tnominal=$tnominal+$nominal;
			
			$no=$no+1;
			$htmldata.='<tr><td align=center>'.$no.'</td>
							<td align=center>'.$tanggal.'</td>
							<td align=center>'.$userid.'</td>
							<td align=center>'.$fullname.'</td>
							<td align=center>'.$rekgiro.'</td>
							<td align=right>'.number_format($nominal,0, ',', '.').'</td>
							<td align=center>'.$status.'</td>
						</tr>';
		}
		
		$htmldata.='<tr>
	                    <td colspan="5" align=right><b>TOTAL AUTO DEBET </b></td>
						<td align=right>'.number_format($tnominal,0, ',', '.').'</td>
					    <td></td>
					</tr></tbody></table></font></div></center>';
		$result = array('rc_mess'=>'00','tabel'=> $htmldata);
	//	return 0;
		//echo json_encode($result);
        echo $htmldata;
	}
	
	
}