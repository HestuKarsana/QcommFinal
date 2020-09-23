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

class GetDetailTran extends CI_Controller {

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
		$this->load->view('laporan_detail_tran');
	}
	
	public function GetData()
	{
			// --------------------------------------
	    $tgl1=date("Ymd",strtotime($_POST['TglAwal']));
		$tgl2=$_POST['TglAwal'];
		//$tgl2=$_POST['TglAkhir'];
		$nopend_agen=$this->session->userdata('ses_kode_agen');
		$userlogin=$this->session->userdata('ses_nippos');
		
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
		
		//$param1="975364534|12345678";
		//$param1="3171030101710005";
		$param2="";
		$param3="";
		$param4="";
		$param5="";
		$sp_name = 'Ipos_getTransCurrent_PerLoket';//'Ipos_ReportRekap';//'Ipos_getPosting';
		$par_data= $tgl1."|".$nopend_agen."|".$userlogin;//'2019-12-17|2019-12-24';//'00|40000|40511C1|EC2|2019-12-17|2019-12-17';//'900000001|2019-12-19';
		//$par_data= '00|40000|40511C1|EC2|2019-12-17|2019-12-17';//'2019-12-17|2019-12-24';//'00|40000|40511C1|EC2|2019-12-17|2019-12-17';//'900000001|2019-12-19';
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
		//$cars[0]["type"]
		// $data1=$data[0]["tanggal"];
		// $data2=$data[1]["tanggal"];
		
		$htmldata='<center><div id="outtable">
		
		   <font size=2%>
		
		      <h3>DETAIL TRANSAKSI</h3>
		                 Tanggal : '.$tgl2.' 
		                <br>
		       <table  id="myTable" name="myTable" cellspacing=0 width=100% border=1>
			  <thead>
				<tr bgcolor=#DCDCDC>
					<th class="short">#</th>
					<th class="normal" align="center">Produk</th>
					<th class="normal">ID_Eexternal</th>
					<th class="normal">Berat</th>
					<th class="normal">Bea</th>
					<th class="normal">HTNB</th>
					<th class="normal">PPN</th>
					<th class="normal">PPN HTNB</th>
					<th class="normal">Sub Total</th>
					<th class="normal">Status</th>
					
				</tr>
			</thead>
			<tbody>';

			
		$no=0;
		$tberat=0;
		$tbeadasar=0;
		$thtnb=0;
		$tppn=0;
		$tppnhtnb=0;
		$tsubtotal=0;
			
		for ($i=0; $i < $jmlproduk; $i++)
		{
			//$userid_posting=$data[$i]["userid_posting"];
			$produk=$data[$i]["kdproduk"];
			$id_external=$data[$i]["id_external"];
			$berat=$data[$i]["berat"];
			$beadasar=$data[$i]["beadasar"];
			$htnb=$data[$i]["htnb"];
			$ppn=$data[$i]["ppn"];
			$ppnhtnb=$data[$i]["ppnhtnb"];
			$status=$data[$i]["status"];
			
			$subtotal=$beadasar+$htnb+$ppn+$ppnhtnb;

						
			$tberat=$tberat+$berat;
			$tbeadasar=$tbeadasar+$beadasar;
			$thtnb=$thtnb+$htnb;
			$tppn=$tppn+$ppn;
			$tppnhtnb=$tppnhtnb+$ppnhtnb;
			$tsubtotal=$tsubtotal+$subtotal;
			
			$no=$no+1;
			
			$htmldata.='<tr><td align=center>'.$no.'</td>
							<td align=center>'.$produk.'</td>
							<td align=center>'.$id_external.'</td>
							<td align=right>'.number_format($berat,0, ',', '.').'</td>
							<td align=right>'.number_format($beadasar,0, ',', '.').'</td>
							<td align=right>'.number_format($htnb,0, ',', '.').'</td>
							<td align=right>'.number_format($ppn,0, ',', '.').'</td>
							<td align=right>'.number_format($ppnhtnb,0, ',', '.').'</td>
							<td align=right>'.number_format($subtotal,0, ',', '.').'</td>
							<td align=center>'.$status.'</td>
							
							
						</tr>';
		}				
		$htmldata.='<tr>
	                    <td colspan="3" align=right><b>TOTAL TRANSAKSI </b></td>
						<td align=right>'.number_format($tberat,0, ',', '.').'</td>
						<td align=right>'.number_format($tbeadasar,0, ',', '.').'</td>
						<td align=right>'.number_format($thtnb,0, ',', '.').'</td>
						<td align=right>'.number_format($tppn,0, ',', '.').'</td>
						<td align=right>'.number_format($tppnhtnb,0, ',', '.').'</td>
						<td align=right>'.number_format($tsubtotal,0, ',', '.').'</td>
						<td align=right></td>
						
					</tr></tbody></table><br>Keterangan : [1=Kolekting, 2=Sudah Bayar]</font></div></center>';
					
		$result = array('rc_mess'=>'00','tabel'=> $htmldata);			
		echo $htmldata;
	}
	
	
}
?>
