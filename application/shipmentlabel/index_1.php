<?php
error_reporting(0);

include('src/BarcodeGenerator.php');
include('src/BarcodeGeneratorPNG.php');
include "phpqrcode/qrlib.php"; 

$nmsip=$_GET['nmsip'];
$kotasip=$_GET['kotasip'];
$kotasip2=$_GET['kotasip2'];
$ktrsip=$_GET['ktrsip'];
$kdpsip2=$_GET['kdpsip2'];
$kdpsip=$_GET['kdpsip'];
$tlpsip=$_GET['tlpsip'];
$emailsip=$_GET['emailsip'];
$ems5=$_GET['ems5'];
$perusahaansip=$_GET['perusahaansip'];
$almsip=$_GET['almsip'];
$almsip1=$_GET['almsip1'];
$almsip2=$_GET['almsip2'];
$almsip3=$_GET['almsip3'];
$almsip4=$_GET['almsip4'];
$almsip5=$_GET['almsip5'];
$kodektrkdptlpsip=$_GET['kodektrkdptlpsip'];
$nmsial=$_GET['nmsial'];
$kdsial=$_GET['kdsial'];
$kdalmsial=$_GET['kdalmsial'];
$kotasial=$_GET['kotasial'];
$ktrtuj=$_GET['ktrtuj'];
$kdptuj=$_GET['kdptuj'];
$tlpsial=$_GET['tlpsial'];
$emailsial=$_GET['emailsial'];
$perusahaansial=$_GET['perusahaansial'];
$almsial=$_GET['almsial'];
$almsial1=$_GET['almsial1'];
$almsial2=$_GET['almsial2'];
$almsial3=$_GET['almsial3'];
$almsial4=$_GET['almsial4'];
$almsial5=$_GET['almsial5'];
$kodektrkdptlp=$_GET['kodektrkdptlp'];
$refpengirim=$_GET['refpengirim'];
$msgpengirim=$_GET['msgpengirim'];
$resi=$_GET['resi'];
$singkatanktrasal=$_GET['singkatanktrasal'];
$kantor=$_GET['kantor'];
$singkatanktrtujuan=$_GET['singkatanktrtujuan'];
$berat=$_GET['berat'];
$brtvlm=$_GET['brtvlm'];
$jnstransaksi=$_GET['jnstransaksi'];
$tgltransaksi=$_GET['tgltransaksi'];
$jamtransaksi=$_GET['jamtransaksi'];
$estimasi=$_GET['estimasi'];
$tmpketerangan=$_GET['tmpketerangan'];
$kdprod=$_GET['kdprod'];
$jml=$_GET['jml'];
$nilaibrg=$_GET['nilaibrg'];
$vbarcode=strtoupper($_GET['vbarcode']);
$provinsisip=$_GET['provinsisip'];
$provinsisial=$_GET['provinsisial'];
$tglestimasi=$_GET['tglestimasi'];
$negarasial=$_GET['negarasial'];
$negarasip=$_GET['negarasip'];
$isikiriman=$_GET['isikiriman'];

//nmsip=YUNDAI&kotasip=BANDUNG&kotasip2=&ktrsip=BANDUNG&kdpsip2=40000&kdpsip=40111&tlpsip=0&emailsip=false&ems5=&perusahaansip=&almsip=JL.KOROPEAK&almsip1=JL.KOROPEAK&almsip2=&almsip3=false&almsip4=JL.KOROPEAK&almsip5=false&kodektrkdptlpsip=BANDUNG%2040111%20/TLP.0&nmsial=XXX&kdsial=0&kdalmsial=&kotasial=KOTA%20SUKABUMI&ktrtuj=KOTA%20SUKABUMI&kdptuj=43111&tlpsial=0&emailsial=false&perusahaansial=&almsial=YYY&almsial1=YYY&almsial2=&almsial3=false&almsial4=YYY&almsial5=false&kodektrkdptlp=KOTA%20SUKABUMI%2043111%20/TLP.0&refpengirim=-&msgpengirim=Tolong%20kirim%20jam%2012%20siang,%20telepon%20di%20depan%20gerbang&resi=1840000000000000138&singkatanktrasal=BAN&kantor=BANDUNG&singkatanktrtujuan=KOT&berat=10000&brtvlm=0&jnstransaksi=NON%20COD&tgltransaksi=07%20Mei%202018&jamtransaksi=09:28:27&estimasi=-&tmpketerangan=PAKETPOS%20BIASA&kdprod=230&jml=28300&nilaibrg=123123

//http://10.33.41.76/posapp/modules/apps/MLO002041/php/shipmentlabel/?nmsip=YUNDAI&kotasip=BANDUNG&kotasip2=&ktrsip=BANDUNG&kdpsip2=40000&kdpsip=40111&tlpsip=0899999999999&emailsip=qweasdfghasdfhg@gmai&ems5=&perusahaansip=PT%20YUYUN&almsip=JL.KOROPEAK&almsip1=JL.KOROPEAK&almsip2=PT%20YUYUN&almsip3=false&almsip4=JL.KOROPEAK&almsip5=false&kodektrkdptlpsip=BANDUNG%2040111%20/TLP.0899999999999&nmsial=IBRAHIM&kdsial=0&kdalmsial=&kotasial=KOTA%20BANDUNG&ktrtuj=KOTA%20BANDUNG&kdptuj=40115&tlpsial=082212311231231&emailsial=qwertyqwertyqwerty@g&perusahaansial=CK.COLL&almsial=PERUM%20MANGLAYANG%20REGENCY%20BLOK%20J.11%20&almsial1=PERUM%20MANGLAYANG%20REGENCY%20BLOK%20J.11%20NO.%201&almsial2=CK.COLL&almsial3=NO.%201&almsial4=PERUM%20MANGLAYANG%20REGENCY%20BLOK%20J.11%20NO.%201&almsial5=NO.%201&kodektrkdptlp=KOTA%20BANDUNG%2040115%20/TLP.082212311231231&refpengirim=-&msgpengirim=Tolong%20kirim%20jam%2012%20siang,%20telepon%20di%20depan%20gerbang&resi=1840000000000000140&singkatanktrasal=BAN&kantor=BANDUNG&singkatanktrtujuan=KOT&berat=10000&brtvlm=0&jnstransaksi=NON%20COD&tgltransaksi=08%20Mei%202018&jamtransaksi=13:03:25&estimasi=-&tmpketerangan=EKSPRESS%20BARANG%20NASIONAL&kdprod=447&jml=101300&nilaibrg=123123&vbarcode=16541450048&provinsisip=SUMBAR&provinsisial=JABAR&tglestimasi=-

//http://localhost/posapp/modules/apps/MLO002041/php/shipmentlabel/?nmsip=YUNDAI&kotasip=BANDUNG&kotasip2=&ktrsip=BANDUNG&kdpsip2=40000&kdpsip=40111&tlpsip=087435129327&emailsip=false&ems5=&perusahaansip=&almsip=JL.KOROPEAK&almsip1=JL.KOROPEAK&almsip2=&almsip3=false&almsip4=JL.KOROPEAK&almsip5=false&kodektrkdptlpsip=BANDUNG%2040111%20/TLP.087435129327&nmsial=INDRA%20TATO%20IPOS%20LOKET&kdsial=0&kdalmsial=&kotasial=KAB.%20BANYUMAS&ktrtuj=KAB.%20BANYUMAS&kdptuj=53111&tlpsial=09872312632192&emailsial=false&perusahaansial=&almsial=GRAHA%20POS%20INDONESIA%20LT.%203%20DIVISI%20TE&almsial1=GRAHA%20POS%20INDONESIA%20LT.%203%20DIVISI%20TEKNOLOGI%20JL.%20BANDA%20NO%2030&almsial2=&almsial3=KNOLOGI%20JL.%20BANDA%20NO%2030&almsial4=GRAHA%20POS%20INDONESIA%20LT.%203%20DIVISI%20TEKNOLOGI%20JL.%20BANDA%20NO%2030&almsial5=KNOLOGI%20JL.%20BANDA%20NO%2030&kodektrkdptlp=KAB.%20BANYUMAS%2053111%20/TLP.09872312632192&refpengirim=-&msgpengirim=-&resi=1840000000000000175&singkatanktrasal=Bd&kantor=BANDUNG&singkatanktrtujuan=Tg&berat=1231&brtvlm=0&jnstransaksi=NON%20COD&tgltransaksi=14%20Mei%202018&jamtransaksi=09:20:03&estimasi=24%20JAM&tmpketerangan=EKSPRESS%20DOKUMEN%20NASIONAL&kdprod=417&jml=69800&nilaibrg=3245677&vbarcode=40000RE00000003&provinsisip=SUMBAR&provinsisial=JABAR&tglestimasi=-&negarasip=INDONESIA&negarasial=INDONESIA&pesan_pelanggan=undefined&isikiriman=baju%20hijab


$tempdir = "qrcode/";
$isi_teks = $vbarcode;
$namafile = $vbarcode.".png";
$quality = 'H';
$ukuran = 4; 
$padding = 0;
QRCode::png($isi_teks,$tempdir.$namafile,$quality,$ukuran,$padding);


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
							<td rowspan='2' align='center' valign='middle' width='113' class='rows'>
								<img src='img/pos.jpg' width='64'>
							</td>
						</tr>
						<tr>
							<td class='rows' colspan='2' style='text-align:center;' height='52'>

								";
								//<img style='display:block;' src='../../../../images/logo.png' height='40' width='70'>
								//<img alt='BarcodeIpos' src='barcode.php?text=".$vkt[5]."&print=true'/>
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
							<td class='rows' style='font-size:12px' height='20'>Berat : ".number_format((preg_replace("/[^0-9]/", '', $berat)/1000), 1, ',', '.')." Kg
							</td>
						</tr>
						<tr>
							<td class='rows' height='51'>	
								".$singkatanktrasal." - ".$singkatanktrtujuan." 
							</td>
							<td rowspan='2' align='center' width='125' height='106' class='rows'>
								<center><img src='qrcode/".$vbarcode.".png' /></center>
							</td>
							<td class='rows' style='font-size:15px' align=center>
								".substr($jnstransaksi,0,10)."
							</td>
						</tr>
						<tr>
							<td height='55' class='rows'>
								Tanggal Transaksi :
								<br>".$tgltransaksi."
							</td>
							<td class='rows'>
								Estimasi antaran :
								<br>".$tglestimasi."
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
								//$generator = new Picqer\Barcode\BarcodeGeneratorPNG();
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
		</script>";

/*		echo "<script>window.print();
		window.close()</script>";
*/
echo "<script>window.alert('$tempdir');</script>";
/*$tempdir = "qrcode/";
$isi_teks = $vbarcode;
$namafile = $vbarcode.".png";
$quality = 'H';
$ukuran = 4; 
$padding = 0;
*/
//http://elevenmillion.blogspot.co.id/2009/12/colspan-dan-rowspan-di-table-html.html
?>