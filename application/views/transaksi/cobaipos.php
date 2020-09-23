<?php
echo "tessss";
//$result = array();
/*
$param_barcode = 'QOB120120536722|QOB111111111|abcd1233333|';//character($noQOB1);
$totalpipe = substr_count($param_barcode,"|");
$barcode = explode("|",$param_barcode);
for ($i=0;$i<$totalpipe;$i++) 
{
	//print_r($response_ipos['respcode']);
		$content = '{"barcode":"'.$barcode[$i].'"}';
			print ($content);
												
}
*/
### SERVICE COLLECTING
							//$param_barcode = character($_POS['param_barcode']);
							
							// $param_barcode = 'QOB220141667172XX|';//character($noQOB1);
							// $totalpipe = substr_count($param_barcode,"|");
							// print_r("<br>".$param_barcode."<br>");
							// $barcode = explode("|",$param_barcode);
							// $content =$barcode[0];
							// for ($i=0;$i<$totalpipe;$i++) 
							// {
								// $content = '{"barcode":"'.$barcode[$i].'"}';
								//print ($content);
							/*
							$curl = curl_init('http://10.32.41.108:8280/ecom/1.0.0/sendjsonecom');
								curl_setopt($curl, CURLOPT_HEADER, false);
								curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
								curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
								curl_setopt($curl, CURLOPT_POST, true);
								curl_setopt($curl, CURLOPT_POSTFIELDS, $content);
								$json_response = curl_exec($curl);
								print_r("<br>".$json_response."<br>");
								curl_close($curl);
								
								$response_ipos = json_decode($json_response, true);
								print_r($response_ipos['respcode']);
								*/
							//}
							/*
						$param_barcode = 'QOB220141667172XX|';//character($noQOB1);
						$totalpipe = substr_count($param_barcode,"|");
						print_r("<br>".$param_barcode."<br>");
						$barcode = explode("|",$param_barcode);
						$content =$barcode[0];	
						$ch = curl_init();	
						curl_setopt($ch, CURLOPT_URL, "http://10.32.41.108:8280/ecom/1.0.0/sendjsonecom");    
						curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 20);
						curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");  
						curl_setopt($ch, CURLOPT_POST, true);                                                                   
						curl_setopt($ch, CURLOPT_POSTFIELDS, $content);                                                                  
						curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);     
						curl_setopt($ch, CURLOPT_USERPWD, $username.':'.$password);
						curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
						curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC); 
						curl_setopt($ch, CURLOPT_HTTPHEADER, array(   
							'Accept: application/json',
							'Content-Type: application/x-www-form-urlencoded')                                                           
						);
						$json_response = curl_exec($ch);
								print_r("<br>".$json_response."<br>");
								curl_close($ch);
								
								$response_ipos = json_decode($json_response, true);
								print_r($response_ipos['respcode']);
							
					$result = array
				    (
					      
						  'respcode'=> $response_ipos['respcode'],
						  'respmsg'=>$response_ipos['respmsg']
					);	
							// ### END SERVICE COLLECTING
					 echo json_encode($result);		
					 */
?>							