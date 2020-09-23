
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class GetKprk extends CI_Controller {

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
		$this->load->view('laporan_rekap');
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
		$reg=$_POST['IdReg'];
		//$reg='01';
		
		//$param1="975364534|12345678";
		//$param1="3171030101710005";
		$param2="";
		$param3="";
		$param4="";
		$param5="";
		// $sp_name = 'Ipos_ReportRekapAutoDebet';//'Ipos_ReportRekap';//'Ipos_getPosting';
		// $par_data= $tgl1.'|'.$tgl2;//'00|40000|40511C1|EC2|2019-12-17|2019-12-17';//'900000001|2019-12-19';
		
		$sp_name = 'Ipos_getKprk';//'Ipos_ReportRekap';//'Ipos_getPosting';
		$par_data=$reg;// '00|40000|40511C1|EC2|2019-12-17|2019-12-17';
		
		$hash=strtolower (MD5('ecom'.$sp_name.$par_data.$tgl));
			$data_string = '{
				"sp_nama":"'.$sp_name.'",
				"par_data":"'.$par_data.'",
				"hashing":"'.$hash.'"}';
			
	
		
		$ch = curl_init(); //getreport
		//curl_setopt($ch, CURLOPT_URL, "https://magenpos.posindonesia.co.id:6466/a767e8eec95442bda80c4e35e0660dbb");    
	//	curl_setopt($ch, CURLOPT_URL, "https://magenpos.posindonesia.co.id:6466/getreport");  
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
		$no=0;
		$kprk='';
		$namakantor='';
		if($reg=='00'){
			
			$result = array(
			                  'jml'=>'1',
							  'nopend'=>''
							 );
		
		}
		for ($i=0; $i < $jmlproduk; $i++)
		{
			
			$kprk=$kprk.$data[$i]["kprk"]."|".$data[$i]["namakantor"]."#";
			////$namakantor=$namakantor.$data[$i]["namakantor"];
		   // $noidate.="'".$data[$i]["kprk"].$data[$i]["namakantor"]."',";
			//$no=$no+1;
			$result = array(
			                 
							  'nopend'=>$kprk,
							  'jml'=>$jmlproduk
							 );
		
		    $no=$no+1;
				
		}
		//$result = array('rc_mess'=>'00','tabel'=> $htmldata);
		echo json_encode($result);

    }
	
	
}
?>
