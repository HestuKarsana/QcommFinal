<?php
	require_once('nusoap.php');
	$proxyhost = isset($_POST['proxyhost']) ? $_POST['proxyhost'] : '';
	$proxyport = isset($_POST['proxyport']) ? $_POST['proxyport'] : '';
	$proxyusername = isset($_POST['proxyusername']) ? $_POST['proxyusername'] : '';
	$proxypassword = isset($_POST['proxypassword']) ? $_POST['proxypassword'] : '';
	//$client = new nusoap_client('http://10.33.41.92:9763/services/ipos?wsdl', 'wsdl',
	
	// $client = new nusoap_client('https://192.168.43.3:9443/services/newipos?wsdl', 'wsdl',
							 // $proxyhost, $proxyport, $proxyusername, $proxypassword);
//	$client = new nusoap_client('http://10.33.41.25:9763/services/Agency.SOAP11Endpoint?wsdl', 'wsdl',
	$client = new nusoap_client('https://10.33.41.25:9443/services/AgencySupportServices?wsdl', 'wsdl',
							 $proxyhost, $proxyport, $proxyusername, $proxypassword);
							 

	// $client = new nusoap_client('../lib/wsdlconfig_new.wsdl', 'wsdl',
							// $proxyhost, $proxyport, $proxyusername, $proxypassword);
	
	$err = $client->getError();
	if ($err) {
		echo '<h2>Gagal mengakses WSDL</h2><pre>' . $err . '</pre>';
	}
?>