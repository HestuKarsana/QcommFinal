<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Getkodepos extends CI_Controller {

   public function __construct(){

      parent::__construct();

      // load base_url
      $this->load->helper('url');

      // Load Model
      $this->load->model('M_kodepos');
   }

   public function index() {
      //$this->load->view('pengguna_view');
	  $this->load->view('secure/login_page');
   }

   // Get users
   public function kodepos(){

      // Search term
      $searchTerm = $this->input->post('searchTerm');

      // Get users
      $response = $this->M_kodepos->getKodeposAlamat($searchTerm);

      echo json_encode($response);
   }
   	public function kodepos_api( )
	{
					// --------------------------------------
					// Contoh web service dengan respon 1 row
					// Author : Iwan
					// --------------------------------------
					ini_set('soap.wsdl_cache_enabled',0);
					ini_set('soap.wsdl_cache_ttl',0);
					//$barcode=$_POST['txtlacak'];
					//$selKodepos=$this->input->post('selKodepos',TRUE);
					//$selKodepos=preg_replace('""', '', $selKodepos);
					//$selKodepos='cilawu';
					/*
					$kodepossip=$_POST['kodepossip'];
					$kodepossial=$_POST['kodepossial'];
					$berat=$_POST['berat'];
					$anb=$_POST['anb'];*/
					$searchTerm = $this->input->post('searchTerm');
					try {
						// $wsdl=alamat wsdl
					//	$wsdl="http://soa.posindonesia.co.id:9763/services/barc?wsdl";
					//echo base_url('assets/PosWebServices-20161201.wsdl.xml');
						$wsdl=base_url('assets/PosWebServices-20161201.wsdl.xml');  
						//$wsdl='C:\xampp\htdocs\apitarif\PosWebServices-20161201.wsdl.xml';  
						//$wsdl="https://ws.posindonesia.co.id:8161/services/PosWebServices.SOAP12Endpoint/";
						// Parameter input gettarif
						// $a='bppt|123|1|12000|10000|234';
						$userId='iwanaja';
						$password='iwan123456';
						$city ='';

						/*
						request :
						<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ws="https://ws.posindonesia.co.id">
				   <soapenv:Header/>
				   <soapenv:Body>
					  <ws:getPosCodeByAddrAndCity>
						 <ws:userId>iwanaja</ws:userId>
						 <ws:password>iwan123456</ws:password>
						 <ws:city>garut</ws:city>
						 <ws:address>cilawu</ws:address>
					  </ws:getPosCodeByAddrAndCity>
				   </soapenv:Body>
				</soapenv:Envelope>
				.
				response :
				<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/">
				   <soapenv:Body>
					  <rs_postcode xmlns="https://ws.posindonesia.co.id">
						 <r_postcode>
							<posCode>44181</posCode>
							<address>Ds. Cilawu Kec. Cilawu</address>
							<city>KAB. GARUT</city>
						 </r_postcode>
						 <r_postcode>
							<posCode>44181</posCode>
							<address>Ds. Dangiang Kec. Cilawu</address>
							<city>KAB. GARUT</city>
						 </r_postcode>
						 <r_postcode>
							<posCode>44181</posCode>
							<address>Ds. Dawungsari Kec. Cilawu</address>
							<city>KAB. GARUT</city>
						 </r_postcode>
						 <r_postcode>
							<posCode>44181</posCode>
							<address>Ds. Dayeuhmanggung Kec. Cilawu</address>
							<city>KAB. GARUT</city>
						 </r_postcode>
				 <r_fee>
							<serviceCode>240</serviceCode>
							<serviceName>PAKET KILAT KHUSUS (1-2 HARI)</serviceName>
							<fee>8910.89</fee>
							<feeTax>89.11</feeTax>
							<insurance>0.0</insurance>
							<insuranceTax>0.0</insuranceTax>
							<totalFee>9000.0</totalFee>
							<itemValue>0</itemValue>
							<notes>-</notes>
						 </r_fee>
						*/
						// Connect ke web service
						$client=new SoapClient($wsdl);
						$response=$client->getPosCodeByAddrAndCity(array('userId'=>$userId,'password'=>$password,'city'=>$city,'address'=>$searchTerm));
						try 
						{
												$data = array();
												$datanya=$response;
												$datanya=$response->r_postcode;   // asli dari iwan
												for ($i=0; $i<count($datanya); $i++){           
													$ndata=$datanya[$i];   
													$data[] = array("id"=>$ndata->posCode, "text"=>$ndata->address,"kota"=>$ndata->city);
												}
												echo json_encode($data);
												//echo json_encode($data);
						} 	catch (Exception $e) {
						//echo "Exception Error!";
						//echo $e->getMessage();
						//echo 'Data tidak ada!';
						$data[] = array("id"=>'', "text"=>'data tidak ada');
						echo json_encode($data);
					}					
					} catch (Exception $e) {
						//echo "Exception Error!";
						//echo $e->getMessage();
						$data[] = array("id"=>'', "text"=>$e->getMessage());
						echo json_encode($data);
						//echo 'Data tidak ada!';
					}

	}

}