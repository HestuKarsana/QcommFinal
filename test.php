<?php
/*
$config['base'] = BASEPATH .'system/test';
print_r($config);
*/
//echo "tessss";
	
						$param_barcode = 'QOB120185997637|';//character($noQOB1);
						print_r ($param_barcode);
							$totalpipe = substr_count($param_barcode,"|");
							$barcode = explode("|",$param_barcode);
							for ($i=0;$i<$totalpipe;$i++) 
							{
								$content = '{"barcode":"'.$barcode[$i].'"}';
								print_r ("<br>".$content."<br>");
								$curl = curl_init('http://10.32.41.108:8280/ecom/1.0.0/sendjsonecom');
								curl_setopt($curl, CURLOPT_HEADER, false);
								curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
								curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
								curl_setopt($curl, CURLOPT_POST, true);
								curl_setopt($curl, CURLOPT_POSTFIELDS, $content);
								$json_response = curl_exec($curl);
								curl_close($curl);
								
								$response_ipos = json_decode($json_response, true);
								//print_r($response_ipos['respcode']);
							}
							
					$result = array
				    (
					      
						  'respcode'=> $response_ipos['respcode'],
						  'respmsg'=>$response_ipos['respmsg']
					);	
					echo json_encode($result);
?>
