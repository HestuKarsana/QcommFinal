<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ongkir extends CI_Controller {

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
		$this->load->view('v_kodepos');
	}
	
	
	public function get_ongkir( )
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
	$anb=$_POST['anb'];
	*/
	$kodepossip = $this->input->post('kodepossip');
	$kodepossial = $this->input->post('kodepossial');
	$berat = $this->input->post('berat');
	$anb = $this->input->post('anb');
	try {
		// $wsdl=alamat wsdl
	//	$wsdl="http://soa.posindonesia.co.id:9763/services/barc?wsdl";
	//echo base_url('assets/PosWebServices-20161201.wsdl.xml');
		$wsdl=base_url('assets/PosWebServices-20161201.wsdl.xml');  
		//$wsdl="https://ws.posindonesia.co.id:8161/services/PosWebServices.SOAP12Endpoint/";
		// Parameter input gettarif
		// $a='bppt|123|1|12000|10000|234';
		$userId='iwanaja';
		$password='iwan123456';
		$customerId='0'; //retail
		$isDomestic='1'; //kiriman domestik
		$senderPosCode=$kodepossip;//htmlspecialchars($this->input->post('kodepossip',TRUE),ENT_QUOTES);//'44181';
		$receiverPosCode=$kodepossial;//htmlspecialchars($this->input->post('kodepossial',TRUE),ENT_QUOTES);//'40115';
		$weight=$berat;//htmlspecialchars($this->input->post('berat',TRUE),ENT_QUOTES);//'1000';
		$length='0';
		$width='0';
		$height='0';
		$diameter='0';
		$itemValue=$anb;//htmlspecialchars($this->input->post('nb',TRUE),ENT_QUOTES);//'500000'; //harga barang
		// Connect ke web service
		$client=new SoapClient($wsdl);
		$response=$client->getFee(array('userId'=>$userId,'password'=>$password,'customerId'=>$customerId,'isDomestic'=>$isDomestic,
										'senderPosCode'=>$senderPosCode,'receiverPosCode'=>$receiverPosCode,'weight'=>$weight,
										'length'=>$length,'width'=>$width,'height'=>$height,'diameter'=>$diameter,'itemValue'=>$itemValue));
		try 
		{
								$data=$response;
								$data=$response->r_fee;   // asli dari iwan
								//<tr><td class="appid">100</td>
								//$datas = array();
								//style="overflow-x:auto;"
								$htmldata='<p><p><table id="tabeltarif" name="tabeltarif" class="table table-bordered table-hover table-responsive">
											<thead>
												<tr>
													<th class="center">
														<label class="pos-rel">
															
															<span class="lbl"></span>
														</label>
													</th>
													<th class="hidden-200">Kode</th>
													<th class="hidden-600">Layanan</th>
													<th>Tarif</th>
													<th>PPN</th>
													<th class="hidden-480">Asuransi</th>
													<th class="hidden-480">PPN Asuransi</th>
													<th class="hidden-480">Total Tarif</th>
												</tr>
											</thead>

											<tbody>';
								for ($i=0; $i<count($data); $i++){           //  asli dari iwan
									$ndata=$data[$i];   
									/*$datas[] = array("kdlayanan"=>$ndata->serviceCode, "nmlayanan"=>$ndata->serviceName,
													"tarif"=>$ndata->fee,"ppn"=>$ndata->feeTax,"anb"=>$ndata->insurance,
													"ppnanb"=>$ndata->insuranceTax,"ongkir"=>$ndata->totalFee,"nilaibarang"=>$ndata->itemValue,
													"catatan"=>$ndata->notes);
													*/
									$data0=trim($ndata->serviceCode);				
									//$data1=trim($ndata->serviceName .'['.$ndata->serviceCode.']');
									$data1=trim($ndata->serviceName);
									$data2=trim($ndata->fee);
									$data3=trim($ndata->feeTax);
									$data4=trim($ndata->insurance);
									$data5=trim($ndata->totalFee);
									$data6=trim($ndata->insuranceTax);
									//echo "<div>".$data1."</div>";
									if (($data0=='210') || ($data0=='240')|| ($data0=='416')|| ($data0=='417')
										 || ($data0=='446')|| ($data0=='447') || ($data0=='Q9') || ($data0=='EC2')	) {
												$htmldata.='<tr><td class="center"><label class="posradio">
															<input name="posradio" type="radio" class="ace" />
															<span class="lbl"></span>
														</label>
														</td>
													<td class="left">'.$data0.'</td>
													<td class="left">'.$data1.'</td>
													<td class="right">'.$data2.'</td>
													<td class="right">'.$data3.'</td>
													<td class="right">'.$data4.'</td>
													<td class="right">'.$data6.'</td>
													<td class="right">'.$data5.'</td>
												</tr>';
											}	
											
								}
								$htmldata.='</tbody></table><p><p><p>';
								echo $htmldata;
								//echo json_encode($datas);
		} 	catch (Exception $e) {

							$htmldata='<p><p><table id="tabeltarif" name="tabeltarif" class="table table-bordered table-hover table-responsive">
											<thead>
												<tr>
													<th class="center">
														<label class="pos-rel">
															
															<span class="lbl"></span>
														</label>
													</th>
													<th class="hidden-200">Kode</th>
													<th class="hidden-600">Layanan</th>
													<th>Tarif</th>
													<th>PPN</th>
													<th class="hidden-480">Asuransi</th>
													<th class="hidden-480">PPN Asuransi</th>
													<th class="hidden-480">Total Tarif</th>
												</tr>
											</thead>
											<td colspan=8></td>
											<tbody>';
								$htmldata.='</tbody></table><p><p><p>';
								echo $htmldata;

	}					
	} catch (Exception $e) {
		//echo "Exception Error!";
		//echo $e->getMessage();
		//echo 'Data tidak ada!';
		
							$htmldata='<p><p><table id="tabeltarif" name="tabeltarif" class="table table-bordered table-hover table-responsive">
											<thead>
												<tr>
													<th class="center">
														<label class="pos-rel">
															
															<span class="lbl"></span>
														</label>
													</th>
													<th class="hidden-200">Kode</th>
													<th class="hidden-600">Layanan</th>
													<th>Tarif</th>
													<th>PPN</th>
													<th class="hidden-480">Asuransi</th>
													<th class="hidden-480">PPN Asuransi</th>
													<th class="hidden-480">Total Tarif</th>
												</tr>
											</thead>
											<td colspan=8></td>
											<tbody>';
								$htmldata.='</tbody></table><p><p><p>';
								echo $htmldata;
	}

		
	}
}
