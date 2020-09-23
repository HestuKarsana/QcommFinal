<?php
//$level = $this->session->userdata('ses_level');

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
		<style>
@page { size A4; margin: 2cm }
div.page { page-break-after: always }
<!-- halaman hvs-->
    body {
        width: 100%;
        height: 100%;
        margin: 0;
        padding: 0;
        background-color: white;
        font: 12pt "Tahoma";
    }
    * {
        box-sizing: border-box;
        -moz-box-sizing: border-box;
    }
    .page {
        width: 210mm;
        min-height: 297mm;
        padding: 20mm;
        margin: 10mm auto;
        border: 1px grey solid;
        border-radius: 5px;
        background: white;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
    }
    .subpage {
        padding: 1cm;
        border: 2px silver solid;
        height: 257mm;
        outline: 2cm white solid;
    }
	
    @page {
        size: A4; /*size 8.5in 11in; margin: 2cm */
        margin: 0;
    }
	
    @media print {
        html, body {
            width: 210mm;
            height: 297mm;        
        }
        .page {
            margin: 0;
            border: initial;
            border-radius: initial;
            width: initial;
            min-height: initial;
            box-shadow: initial;
            background: initial;
            page-break-after: always;
        }
    }

<!-- end of halaman hvs -->
</style>
	</head>

	<body class="no-skin">
	
	<div> <?php //print_r ($kirimans) ?></div>
	<!-- <button onclick="window.print()">Print Content</button> -->
	<div class='page'>
	<table border=1>
	
	<?php //if ($hal % 4 =) {}
				//$datas='{"rc_mess":"00","desk_mess":"SUKSES","userid":"dede123","response_data1":"QOB20146806596","response_data2":"240|QOB20146806596|-|1500|31683.17|15272.73|316.83|1527.27|-|7000000|-|-","response_data3":"dd|bandung bandung - Kel. Cigending Kec. Ujung Berung|-|-|-|-|-|40199|081365610750|","response_data4":"-|ali|cimahi cimahi - Kel. Baros Kec. Baros|-|-|-|-|-|43167|081365610750|"}';
							
		$datas=json_decode($kirimans);
		 // print_r($datas->response_data1."<br>");
		 // print_r($datas->response_data2."<br>");
		 // print_r($datas->response_data3."<br>");
		 // print_r($datas->response_data4."<br>");
		 // print_r(count($datas));
		if ($barcode)
		// if (count($datas)==1) 
		// {
			// echo "Data tidak ada";
			
		// } else 
		//{
		$k=0;$l=0;
		foreach($datas as $key=>$val)
		{
			
			
			$barcode=$datas->response_data1;
			//print_r("<br>Barcodenya : ".$barcode);
			echo "<tr>";
				// for($j=0; $j<=1; $j++)
				// {
					// $l=$k+$j;
					echo "<td>"; ?>
							<center>
							
							<!--h4><img src="<?php //$barcode=$datas->response_data1;
								//echo site_url(); ?>/SimpanData/set_barcode/?<?php //echo $barcode ?>"> 
							</img></h4-->
							
							<?php
							 $generator = new Picqer\Barcode\BarcodeGeneratorPNG();
							<h4><img height='30px' width='150px' src="data:image/png;base64,"<?php.base64_encode($generator->getBarcode($vbarcode, $generator::TYPE_CODE_128));?>> 
							
							</img></h4>
							
								
							
							
							</center>
						<div class="">
							<div><strong>PENERIMA </strong> <br><hr style="border-top: 1px dotted silver"></div>
						
							<h4><?php 
							$arr=explode('|',$datas->response_data4);
							$nama = ucfirst($arr[1]);
							$alamat = ucfirst($arr[2]);
							$kota = ucfirst($arr[5]) . ' '.ucfirst($arr[12]);
							$prov=ucfirst($arr[9]);
							$telp=ucfirst($arr[13]);
							
							echo ucfirst($nama) .'<br>'.ucfirst($alamat) .'<br>'.ucfirst($kota) .
							'<br>'.ucfirst($prov) .'<br>HP. '.ucfirst($telp); ?>
									</h4>
													
						</div>
						<div class="">
								<div><strong>PENGIRIM</strong>
								<hr style="border-top: 1px dotted silver"></div>
								
									
									<h5><?php 
									$arr1=explode('|',$datas->response_data3);
									$namasip = ucfirst($arr1[0]);
									$alamatsip = ucfirst($arr1[1]). ' '.ucfirst($arr1[2]);
									$kotasip = ucfirst($arr1[3]) .' - '.ucfirst($arr1[4]) .' '.ucfirst($arr1[7]);
									$provsip=ucfirst($arr1[5]);
									$telpsip=ucfirst($arr1[8]);
									
									echo ucfirst($namasip) .'<br>'.ucfirst($alamatsip) .'<br>'.ucfirst($kotasip) .
									'<br>'.ucfirst($provsip) .'<br> HP. '.ucfirst($telpsip);  ?>
									</h5>
										
									
						</div>
			
															

				<?php echo "</td>";
									//}
			echo "</tr>"; 
					$k=$k+2;
					$jml=count($datas);
					if ($k>=$jml){break;}
					
		}
																			
   // } //jika ada data   														
	?>
	</table>
														
			

			
		
	<script>
		window.print();
	</script>		
	<script>
function printContent(el){
    var restorepage = document.body.innerHTML;
    var printcontent = document.getElementById(el).innerHTML;
    document.body.innerHTML = printcontent;
    window.print();
    document.body.innerHTML = restorepage;
}

function set_barcode($code)
	{
		//load library
		<?php
		$this->load->library('zend');		//load in folder Zend
		$this->zend->load('Zend/Barcode');
		//generate barcode
		Zend_Barcode::render('code128', 'image', array('text'=>$code), array());
		?>
	}
	
</script>
	</body>
</html>
