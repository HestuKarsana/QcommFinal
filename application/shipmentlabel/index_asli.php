<?php
error_reporting(0);

include('src/BarcodeGenerator.php');
include('src/BarcodeGeneratorPNG.php');
include "phpqrcode/qrlib.php"; 

$tempdir = "qrcode/";
$isi_teks = "PKH12345678911";
$namafile ="PKH12345678911.png";
$quality = 'H';
$ukuran = 5; 
$padding = 0;
QRCode::png($isi_teks,$tempdir.$namafile,$quality,$ukuran,$padding);

echo
		"<style>
			.tables{border-collapse:collapse;border-color: gray;width:458px; height:300px; font-family:Tahoma}
			.rows{border-color:gray;color:black;}
			.rotates { 
				text-align: left;
				font-size:12px;
				vertical-align: top;
				-moz-transform: rotate(90.0deg);  /* FF3.5+ */
				-o-transform: rotate(90.0deg);  /* Opera 10.5 */
				-webkit-transform: rotate(90.0deg);  /* Saf3.1+, Chrome */
				filter:  progid:DXImageTransform.Microsoft.BasicImage(rotation=0.083);  /* IE6,IE7 */
				-ms-filter: 'progid:DXImageTransform.Microsoft.BasicImage(rotation=0.083)'; /* IE8 */
			}
		</style>
		<table class='tables' cellspacing=1 cellpadding=3 border=1>
			<tr>
				<td class='rows' colspan=3>
					<div style='width: 100%; overflow: hidden;'>
						<div style='width: 94%; float: left; font-size=2px'>POS KILAT KHUSUS</div>
						<div style='margin-left: 30%; text-align: right;'>
							<img style='display:block;' src='img/posindonesia.png' width='25'>
							
						</div>
					</div>
				</td>
			</tr>
			<tr>
				<td class='rows' colspan=3 style='font-size:25px;text-align:center;'>

					";
					//<img style='display:block;' src='../../../../images/logo.png' height='40' width='70'>
					//<img alt='BarcodeIpos' src='barcode.php?text=".$vkt[5]."&print=true'/>
					$generator = new Picqer\Barcode\BarcodeGeneratorPNG();
					echo '
					<img src="data:image/png;base64,'.base64_encode($generator->getBarcode("PKH12345678911", $generator::TYPE_CODE_128)).' ">
					<br>
					PKH12345678911
					';
				echo "
				</td>
			</tr>
			<tr>
				<td class='rows' colspan=3>
					Ref.Pengirim: A13579
					<div style='width:100%;border:0.5px dotted gray;font-size:10px'>
						<i>Tolong kirim jam 12 siang, telepon di depan gerbang</i>
					</div>
				
					<center>JAT</center>
					<center>".substr($vkt[29]." ".$vkt[36],0,45)."</center>
				</td>
			</tr>
			<tr>
				<td class='rows' id='tdrotate'>
					<div class='rotates' id='divrotate'>
					<br>
						DARI:<br>
						Yusuf kertawidjaya<br>
						Jl Timur Kencana No 167<br>
						Ciamis 46252<br>
						Jawa Barat <br>
						Telp 01222

						".substr($vkt[19],0,25)."<br>
						".substr($vkt[21],0,35)."<br>
						".substr($vkt[22],0,35)."<br>
						".substr($vkt[32],0,35)."<br>
						".substr($vkt[33],0,25)."
					</div>
				</td>
				<td class='rows' rowspan=2 colspan=3 style='font-size:15px'>
						KEPADA:<br>
						Darmawan Setiadi<br>
						Jl. Raya Barat no 4c<br>
						Jakarta Timur 13340<br>
						Indonesia<br><br>
						Telp : 0812222
						".substr($vkt[10],0,25)."<br>
						".substr($vkt[12],0,35)."<br>
						".substr($vkt[13],0,35)."<br>
						".substr($vkt[34],0,35)."<br><br>
						".substr($vkt[35],0,25)."
				</td>
			
			</tr>
			<tr>
				<td class='rows'>
				Berat :
					<center>".number_format((preg_replace("/[^0-9]/", '', $vkt[7])/1000), 1, ',', '.')." Kg</center>
				</td>
			</tr>
			<tr>
				<td class='rows' style='font-size:11px'>	
					BD - SPPBD - SPPJKT -JAT 
				</td>
				<td rowspan=2 align=center>
					<center><img src='qrcode/PKH12345678911.png' /></center>
				</td>

				<td class='rows' style='font-size:15 PX' align=center>
					NON COD
				</td>
			</tr>
			<tr>
				<td style='font-size:10px'>
					Tanggal Transaksi :
					<br>
					20 April 2018
				</td>

				<td style='font-size:10px'>
					Estimasi antaran :
					<br>
					22 April 2018
				</td>
				
			</tr>

			<tr>
				<td colspan=3>
					<div style='width:100%;border:0.5px dotted gray;font-size:10px'>
					</div>
				</td>
			</tr>
			
			<tr>

				<td class='rows'style='font-size:7px' rowspan=2 >
					<center>BUKTI TERIMA KIRIMAN</center>
					<br>
					Kantor Kirim : Bandung 4000
					<br>
					Tgl Posting : 20 April 2018
					<br>
					Wkt Posting : 13:20:15
					
				</td>

				<td style='font-size:8px'>
				Pengirim :
				<br>
				HASAN RANO KARNO
				<br>
				Bandung
				</td>

				<td style='font-size:8px'>
				Penerima :
				<br>
				HASAN RANO KARNO
				<br>
				Bandung
				</td>

			</tr>
			<tr>
				<td colspan=2 rowspan=2 style='font-size:10px'>
				Berat     : [AW] 2.485 GR [VW] 3.000 GR 
				<br>
				Bea Kirim : Rp.17.500 
				</td>
				
			</tr>
			
			<tr>
				<td style='font-size:8px'>
				Jenis kiriman 	 : 240-paket-Kilat Khusus
				<br>
				Estimasi Antaran : 46 Jam
				</td>

			</tr>
			<tr>
				<td colspan=2 rowspan=2 style='font-size:15px;text-align:center;'>
				";
					$generator = new Picqer\Barcode\BarcodeGeneratorPNG();
					echo '
					<img src="data:image/png;base64,'.base64_encode($generator->getBarcode("PKH12345678911", $generator::TYPE_CODE_128)).' ">
					<br>
					PKH12345678911
					<br>
					Lacak di http://www.posindonesia.co.id
					';
				echo "
				</td>

				<td rowspan=2 style='font-size:11px; text-align:justify'>
				Pernyataan Pengirim
				<br>
				1.Setuju dengan ketentuan dan syarat
				  pengiriman yang ditetapkan PT.Pos Indonesia(Persero)<br>
				2.Isi Kiriman : 
				<br>
				3.Nilai pertanggungan isi kiriman
				<br>
				<center>Rp.500.000</center> 

	
				</td>

			</tr>

		
		</table>


		<script>
			var wdt = document.getElementById('divrotate').clientWidth;
			var hgt = document.getElementById('divrotate').clientHeight;
			document.getElementById('tdrotate').style.height = wdt - 70;
			document.getElementById('tdrotate').style.width = hgt + 5;
		</script>";

//http://elevenmillion.blogspot.co.id/2009/12/colspan-dan-rowspan-di-table-html.html
?>