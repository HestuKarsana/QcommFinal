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

class GetMutasiRekening extends CI_Controller {

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
		$this->load->view('adm_laporan_mutasi_rekening');
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
		
		//-----------------------------------------------------------------------------------	
		//$kodepossip=$_POST['kodepossip'];
		$messtype="206";//"201";	
		$userid="440000024";
		//$param1=$usernamenya."|".$passwordnya."|01";//;$_POST['IdOrder'];//"3171030101710005";
		$param1=$Norek.';'.$tgla.';'.$tglb;//;$_POST['IdOrder'];//"3171030101710005";
		//$param1="3171030101710005";
		//$param2="0200015055";
		$param2=trim($Norek);
		$param3=
		$param4="";
		$param5="";
		//Ipos_GetUserLoginAgenpos('440000032|24b2024925f736b202e4e88adf10c756|02')
		
		$hash=strtolower (MD5($key1.$tgl.$messtype.$param1.$key2));
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
		$response = json_decode($response1, true);
		
		
		$valid=$response['rc_mess'];
		//print_r("<br>Data ".$valid);
		
		if($valid=='000')
		{
			
					$datakoran=explode("|",$response['response_data1']);
					$SaldoAwal=$datakoran[0];	
					$SaldoAkhir=$datakoran[1];
					$Trx=$datakoran[2];
					$detiltrx=count(explode("#",$Trx));
					$detiltrx2=explode("#",$Trx);
					$kredit='';$debet='';
					$tgl='';$tgl2='';
					$jam='';$jam2='';
					$va='';$va2='';
					$bsu='';$bsu2='';
					$rinci='';
					$rinci2='';
					
					$htmldata='<center><div id="outtable">
					          <font size=2%><h3>MUTASI REKENING</h3>
									 Nomor Rekening : '.$Norek.'<br>
									 Tanggal : '.$tg1.' s/d '.$tg2.'
									<br>
						  <table cellspacing=0 width=100% border=1>
						<thead>
							<tr bgcolor=#DCDCDC>
								
								<th align=center>No</th>
								<th align=center>Tanggal</th>
								<th align=center>Jam</th>
								<th align=center>Rincian</th>
								<th align=center>VA</th>
								<th align=center>Debet</th>
								<th align=center>Kredit</th>
								
							</tr>
						</thead>
						<tbody>';
						$htmldata.='<tr>
									<td colspan="6" align=right><b>SALDO AWAL </b></td>
									<td align=right>'.number_format($SaldoAwal,0, ',', '.').'</td>
					
								</tr>';
					$no=1;			
					for ($i=0; $i < $detiltrx; $i++)
						{
							if(substr($detiltrx2[$i],0,1)=='D'){
								
								$kredit=$detiltrx2[$i];
								$rinci=explode("~",$kredit);
								$tgl=$rinci[2];
								$jam=$rinci[3];
								$va=$rinci[4];
								$bsu=$rinci[5];
								
								$htmldata.='<tr><td align=center>'.number_format($no,0, ',', '.').'</td>
										<td align=center>'.$tgl.'</td>
										<td align=center>'.$jam.'</td>
										<td align=center>'.$rinci[1].'</td>
										<td align=center>'.$va.'</td>
										<td align=right>'.number_format($bsu,0, ',', '.').'</td>
										<td align=right></td>
									</tr>';
							}
							else{
								$debet=$detiltrx2[$i];
								$rinci2=explode("~",$debet);
								$tgl2=$rinci2[2];
								$jam2=$rinci2[3];
								if($rinci2[4]==''){
									
									$va2='';
								}else{
									
									$va2=$rinci2[4];
									
								}
								if($rinci2[5]==''){
									
									$bsu2='';
								}else{
									
									$bsu2=$rinci2[5];
									
								}
								  $htmldata.='<tr><td align=center>'.number_format($no,0, ',', '.').'</td>
										<td align=center>'.$tgl2.'</td>
										<td align=center>'.$jam2.'</td>
										<td align=center>'.$rinci2[1].'</td>
										<td align=center>'.$va.'</td>
										<td align=right></td>
										<td align=right>'.number_format($bsu2,0, ',', '.').'</td>
										
									</tr>';
							}
							$no=$no+1;
					}
									
									
					
					$htmldata.='<tr>
									<td colspan="6" align=right><b>SALDO AKHIR </b></td>
									<td align=right>'.number_format($SaldoAkhir,0, ',', '.').'</td>
					
								</tr>
								</tbody></table></font></div></center>';
					$result = array('rc_mess'=>'00','tabel'=> $htmldata);
					echo $htmldata;
		}else{
			$htmldata='<p><p><center><font size=3%><h3>'.$response['desk_mess'].'</center><p><p>';
			echo $htmldata;
		}
		curl_close($ch);
	}
	
	
}
?>
