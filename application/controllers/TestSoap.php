<?php
/**
 * 
 */
Class TestSoap extends CI_Controller{
      public function index(){
            $dataSoap = array(
            'userId' => '',
            'password' => '',
            'type' => '-',
            'externalId' => '',
            'customerId' => '',
            'serviceId' => '',
            'senderName' => '',
            'senderAddr' => '',
            'senderVill' => '',
            'senderSubDist' => '',
            'senderCity' => '',
            'senderProv' => '',
            'senderCountry' => 'Indonesia',
            'senderPosCode' => '',
            'senderEmail' => '-',
            'senderPhone' => '',
            'receiverName' => '',
            'receiverAddr' => '',
            'receiverVill' => '',
            'receiverSubDist' => '',
            'receiverCity' => '',
            'receiverProv' => '',
            'receiverCountry' => 'Indonesia',
            'receiverPosCode' => '',
            'receiverEmail' => '-',
            'receiverPhone' => '',
            'orderDate' => '',
            'weight' => 20,
            'fee' => '',
            'feeTax' => '',
            'insurance' => '',
            'insuranceTax' => '',
            'itemValue' => 0,
            'contentDesc' => ''
            );          

            $push = $this->sendPostingSoap($dataSoap);
            echo json_encode($push);
      }

      private function sendPostingSoap($data){
            $result = array();
        ini_set('soap.wsdl_cache_enabled',0);
        ini_set('soap.wsdl_cache_ttl',0);
            foreach ($data as $key) {
                  $barcode = $key['externalId'];
                  try {
                        $wsdl       = base_url('assets/PosWebServices-20161201.wsdl.xml');
                  $client     = new SoapClient($wsdl, array('cache_wsdl' => WSDL_CACHE_NONE));
                  $response   = $client->addPosting($key);
                  $data       = $response;
                  $data       = $response->r_posting;
                  $respon     = $data->responseId;   
                  $result['success'] = true;
                  $result['message'] = $response;
                  } catch (Exception $e) {
                        $result["success"] = $e;
                  }
            }
            return $result;
      }

}
?>