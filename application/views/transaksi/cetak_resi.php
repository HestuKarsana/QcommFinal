<?php

include('src/BarcodeGenerator.php');
include('src/BarcodeGeneratorPNG.php');
include('src/BarcodeGeneratorSVG.php');
include('src/BarcodeGeneratorJPG.php');
include('src/BarcodeGeneratorHTML.php');
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<?php //$this->load->view("_dipecah/head.php") ?>
		<?php $this->load->view('include/header'); ?>
<?php		
/*
echo "TESSS ";
$generatorSVG = new Picqer\Barcode\BarcodeGeneratorSVG();
file_put_contents('tests/verified-files/081231723897-ean13.svg', $generatorSVG->getBarcode('081231723897', $generatorSVG::TYPE_EAN_13));

$generatorHTML = new Picqer\Barcode\BarcodeGeneratorHTML();
file_put_contents('tests/verified-files/081231723897-code128.html', $generatorHTML->getBarcode('081231723897', $generatorHTML::TYPE_CODE_128));

$generatorSVG = new Picqer\Barcode\BarcodeGeneratorSVG();
file_put_contents('tests/verified-files/0049000004632-ean13.svg', $generatorSVG->getBarcode('0049000004632', $generatorSVG::TYPE_EAN_13));
*/
$datas=json_decode($kirimans);
echo "Datanya : ".$datas;
/*
PENERIMA

Array ( [messtype] => 301 [rc_mess] => 00 [desk_mess] => SUKSES [userid] => 440000024 
[response_data1] => QOB1375108243 
[response_data2] => 17122|QOB1375108243|-|100|||||-|1000000|-|- 
[response_data3] => | - Kel. Perwira Kec. Bekasi Utara|-|-|-|-|-|17122|| 
[response_data4] => -|| - Kel. Padang Matinggi Kec. Padangsidimpuan Selatan|-|-|-|-|-|22727|| [response_data5] => 0|0|60012345678 [wkt_mess] => 2020-01-07 20:20:21.204089 ) 

*/
$arr_sial=explode('|',$datas->response_data4);
							$nmsial = ucfirst($arr_sial[1]);
							$almsial = ucfirst($arr_sial[2]);
							$kotasial = ucfirst($arr_sial[5]);
							$kdptuj=ucfirst($arr_sial[8]);
							$provinsisial=ucfirst($arr_sial[9]);
							$tlpsial=ucfirst($arr_sial[9]);
/*--------------------------------------------------------------------------------------------*/	
$arr_sip=explode('|',$datas->response_data3);
							$nmsip = ucfirst($arr_sip[0]);
							$almsip = ucfirst($arr_sip[1]);
							$kotasip = ucfirst($arr_sip[2]);
							$kdpsip=ucfirst($arr_sip[7]);
							$provinsisip=ucfirst($arr_sip[9]);
							$tlpsip=ucfirst($arr_sip[8]);


				
$vbarcode='123456789';
$tmpketerangan='SURAT KILAT KHUSUS';
$refpengirim='Syahroni';
$msgpengirim='Coba lagi';
$singkatanktrtujuan='BD';

// $nmsip='JOKO SUSILO';
// $almsip='JL. BANDA NO.30 BANDUNG';
// $kotasip='BANDUNG';
// $kdpsip='40115';
// $provinsisip='JAWA BARAT';
$negarasip='ID';
//$tlpsip='085322692450';

// $nmsial='RENI';
// $almsial='yogyakarta tugu';
// $kotasial='yogyakarta';
// $kdptuj='55110';
// $provinsisial='JAWA TENGAH';
// $tlpsial='0891222221';

$berat='2400';
$in_tutupan='SPPYK';
$out_tutupan='SPPYK';
$ket_cod='NON COD';
$tgltransaksi='07-01-2020';
$cod_value='0';
$ktrsip='BANDUNG';
$kdpsip2='40115';
$jamtransaksi='1';
$brtvlm='2000';
$jml='1';
$kdprod='240';
$estimasi='2 HARI';
$isikiriman='PAKAIAN';
$nilaibrg='10000000';

echo
		"<style>
			.tables{border-collapse:collapse;font-family:Tahoma;font-size:11px !important;color:black;}
			.rows{border:1px solid #000;}
			.rotates { 
				text-align: left;
				font-size:11px;
				vertical-align: top;
				-moz-transform: rotate(90.0deg);  /* FF3.5+ */
				-o-transform: rotate(90.0deg);  /* Opera 10.5 */
				-webkit-transform: rotate(90.0deg);  /* Saf3.1+, Chrome */
				filter:  progid:DXImageTransform.Microsoft.BasicImage(rotation=0.083);  /* IE6,IE7 */
				-ms-filter: 'progid:DXImageTransform.Microsoft.BasicImage(rotation=0.083)'; /* IE8 */
			}
		</style>
		<div style='width:363px !important; height:575px !important;overflow:hidden !important;padding:0px;margin:0px;'>
		<table cellpadding='0' cellspacing='0'>
			<tr>
				<td>
					<div style='width:363px !important; height:369px !important;overflow:hidden !important;border-bottom:0px solid blue;'>
					<table class='tables' cellspacing='0' cellpadding='2' border='0'>
						<tr>
							<td class='rows' colspan='2' style='font-size:13px;' width='249' height='22'>
								".substr($tmpketerangan,0,35)."
							</td>
							
							<td  rowspan='2' class='rows' align='center' valign='middle' width='113'>
							<img src='img/pos.jpg' width='64'></td>
						</tr>
						<tr>
							<td class='rows' colspan='2' style='text-align:center;' height='50'>

								";
								
								$generator = new Picqer\Barcode\BarcodeGeneratorPNG();
								echo '
								<img height="30px" width="150px" src="data:image/png;base64,'.base64_encode($generator->getBarcode($vbarcode, $generator::TYPE_CODE_128)).' ">
								<br><span style="font-size:13px;">
								'.$vbarcode.'
								</span>';
								
							echo "
							</td>
						</tr>
						<tr>
							<td class='rows' colspan='3' style='font-size:11px;' height='20'>Ref. Pengirim : ".substr($refpengirim,0,45)."</td>
						</tr>
						<tr>
							<td class='rows' colspan='3' style='font-size:10px;font-style:italic;padding:0px;' height='15'>".substr($msgpengirim,0,55)."</td>
						</tr>
						<tr>
							<td class='rows' colspan='3' style='font-size:13px;' align='center' height='22'>".substr($singkatanktrtujuan,0,50)."</td>
						</tr>
						<tr>
							<td class='rows' style='overflow:hidden;' height='105' width='140'>
								<div style='position:relative;border:0px solid #000;width:140px !important;padding:0px;margin:0px;height:105px;'>
									<div class='rotates' id='tdrotate' style=''>
										<div id='divrotate' style='position:absolute !important;left:56px !important;border:0px solid #000;width:104px !important;height:140px !important;top:-53px;overflow:hidden;'>
											Dari:<br>
											".ucwords(strtolower(substr($nmsip,0,20)))."<br>
											".ucwords(strtolower(substr($almsip,0,60)))."<br>
											".ucwords(strtolower(substr($kotasip,0,14)))." ".$kdpsip."<br>
											".ucwords(strtolower(substr($provinsisip,0,20)))."<br>
											".ucwords(strtolower(substr($negarasip,0,20)))."<br>
											Telp: ".substr($tlpsip,0,16)."
										</div>
									</div>
								</div>
							</td>
							<td class='rows' rowspan='2' colspan='2' style='font-size:11px' style='overflow:hidden;height:124px;' valign='top'>
								<div style='overflow:hidden;height:123px;font-weight:bold;border:0px solid #000;'>
									Kepada:<br>						
									".ucwords(strtolower(substr($nmsial,0,33)))."<br>
									".ucwords(strtolower(substr($almsial,0,66)))."<br>
									".ucwords(strtolower(substr($kotasial,0,26)))." ".$kdptuj."<br>
									".ucwords(strtolower(substr($provinsisial,0,33)))."<br>
									".ucwords(strtolower(substr($negarasip,0,33)))."<br>
									Telp: ".substr($tlpsial,0,16)."
								</div>
							</td>						
						</tr>
						<tr>
						
							<td class='rows' style='font-size:12px' height='20'>Berat : ".number_format($berat, 0, ',', '.')." Gr
							</td>
						</tr>
						<tr>
							<td class='rows' style='font-size:15px' height='51'>	
								".$in_tutupan." - ".$out_tutupan." 
							</td>
							<td rowspan='2' align='center' width='125' height='106' class='rows'>
								<center>";echo "<div id='placeHolder'></div>";
								       echo"
								</center>
							</td>
							<td class='rows' style='font-size:15px' align=center>
								".substr($ket_cod,0,10)."
							</td>
						</tr>
						<tr>
							<td height='55' class='rows'>
								Tanggal Transaksi :
								<br>".$tgltransaksi."
							</td>
							<td class='rows'>
							<center>Rp. ".number_format($cod_value, 0, ',', '.')."</center>
							</td>				
						</tr>
					</table>
					</div>
				</td>
			</tr>
			<tr>
				<td>
					<div style='width:363px !important; height:26px !important;overflow:hidden !important;border-bottom:0px solid blue;'>
					<table class='tables' cellspacing='0' cellpadding='0' border='0'>
						<tr>
							<td height='26'>&nbsp;
							</td>
						</tr>
					</table>
					</div>
				</td>
			</tr>
			<tr>
				<td>
					<div style='width:363px !important; height:157px !important;overflow:hidden !important;border-bottom:0px solid blue;'>
					<table class='tables' cellspacing='0' cellpadding='2' border='0'>	
						<tr>
							<td class='rows'style='font-size:7px;' rowspan='2' width='143' height='68'>
								<center>BUKTI PENGIRIMAN</center>
								<br>
								Kantor Kirim : ".substr($ktrsip,0,16)." ".$kdpsip2."
								<br>
								Tgl Posting : ".$tgltransaksi."
								<br>
								Wkt Posting : ".$jamtransaksi."
								
							</td>
							<td style='font-size:7px' width='109' class='rows'>
							Pengirim :
							<br>
							".ucwords(strtolower(substr($nmsip,0,28)))."
							<br>
							".ucwords(strtolower(substr($kotasip,0,28)))."
							</td>

							<td style='font-size:7px' width='109' class='rows'>
							Penerima :
							<br>
							".ucwords(strtolower(substr($nmsial,0,28)))."
							<br>
							".ucwords(strtolower(substr($kotasial,0,28)))."
							</td>
						</tr>
						<tr>
							<td colspan='2' style='font-size:10px' class='rows'>
							Berat     : [AW] ".number_format($berat, 0, ',', '.')." GR [VW] ".number_format($brtvlm, 1, ',', '.')." GR 
							<br>
							Bea Kirim : Rp. ".number_format($jml, 0, ',', '.')." 
							</td>				
						</tr>			
						<tr>
							<td style='font-size:7px' height='26' class='rows'>
							Jenis kiriman 	 : ".$kdprod."-".substr($tmpketerangan,0,18)."
							<br>
							Estimasi Antaran : ".$estimasi."
							</td>
							<td colspan='2' rowspan='2' style='font-size:9px; text-align:justify;' class='rows'>
							Pernyataan Pengirim
							<br>
							1. Setuju dengan ketentuan dan syarat pengiriman yang ditetapkan PT.Pos Indonesia(Persero)<br>
							2. Isi Kiriman : ".ucwords(strtolower(substr($isikiriman,0,25)))."<br>
							3. Nilai pertanggungan isi kiriman
							<br>
							<center>Rp. ".number_format($nilaibrg, 0, ',', '.')."</center> 
							</td>
						</tr>
						<tr>
							<td style='text-align:center;padding:0px;margin:0px;' height='62' class='rows'>
							";
								$generator = new Picqer\Barcode\BarcodeGeneratorPNG();
								echo '<img height="30px" width="105px" src="data:image/png;base64,'.base64_encode($generator->getBarcode($vbarcode, $generator::TYPE_CODE_128)).' ">
								<br><span style="font-size:8px;">
								'.$vbarcode.'<br></span>
								<span style="font-size:7px;">
								Lacak di http://www.posindonesia.co.id</span>';
							echo "
							</td>
						</tr>
					</table>
					</div>
				</td>
			</tr>
		</table>
		</div>

		<script>
			var wdt = document.getElementById('divrotate').clientWidth;
			var hgt = document.getElementById('divrotate').clientHeight;
			document.getElementById('tdrotate').style.height = wdt - 70;
			document.getElementById('tdrotate').style.width = hgt + 5;
		</script>
		
		<script>
			var typeNumber = 1,
			errorCorrectionLevel = 'L',
			cellSize=4,
			margin=4;
			var qr = qrcode(typeNumber, errorCorrectionLevel);
			qr.addData('".$vbarcode."');
			qr.make();
			document.getElementById('placeHolder').innerHTML = qr.createImgTag(cellSize,margin);
		</script>
	
		";

// echo "<script>window.print();
		// window.close()</script>
		
		
		// ";
?>
<script>
  window.print();
		//window.close();
</script>