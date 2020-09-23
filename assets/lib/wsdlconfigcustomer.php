<?php
	require_once('nusoap.php');
	$proxyhost = isset($_POST['proxyhost']) ? $_POST['proxyhost'] : '';
	$proxyport = isset($_POST['proxyport']) ? $_POST['proxyport'] : '';
	$proxyusername = isset($_POST['proxyusername']) ? $_POST['proxyusername'] : '';
	$proxypassword = isset($_POST['proxypassword']) ? $_POST['proxypassword'] : '';
	$client = new nusoap_client('http://10.33.41.25:9763/services/CRM?wsdl', 'wsdl',
							$proxyhost, $proxyport, $proxyusername, $proxypassword);
	$err = $client->getError();
	if ($err) {
		echo '<h2>Gagal mengakses WSDL</h2><pre>' . $err . '</pre>';
	}
?>