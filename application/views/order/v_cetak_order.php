<?php
//$level = $this->session->userdata('ses_level');
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<?php //$this->load->view("_dipecah/head.php") ?>
		<?php $this->load->view('include/header'); require_once('barcode.php') ;?>
		<style>
table, th, td {
  border: 1px solid silver;
  border-collapse: collapse;
}
th, td {
  padding: 15px;
}
</style>
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
	<div> <?php// print_r ($kirimans) ?></div>
	<!-- <button onclick="window.print()">Print Content</button> -->
	<div class='page'>
	<table border=0>
	
	<?php //if ($hal % 4 =) {}
									
        //print_r($kirimans);		
		
		$datas=json_decode($kirimans,true);
		//$datas=json_decode($hsl,true);
		extract($datas);
 //echo("$rc_mess $desk_mess $response_data1");
		if (count($datas)==1) {
			echo "Data tidak ada";
			
		} else {
		$k=0;$l=0;
		
/*		foreach($datas as $key=>$val){
			echo "<tr>";
				for($j=0; $j<=1; $j++){
					$l=$k+$j;
					*/
					?>
					
					<tr><td border="1"><img alt="" src="<?php echo config_item("img"); ?>logo_small.png"></img></td><td>
																			<center><!-- <h4>
						
						<img src="<?php //$barcode=$response_data1;
						//echo site_url(); ?>/label_barcode/set_barcode/<?php //echo $barcode ?>"> 
						</img>
						
						
						</h4>-->
						<?php 
								//$barcode=$response_data1;//$datas->response_data1;
								$barcode='1234567890';//$response_data1;//$datas->response_data1;
								$img			=	code128BarCode($barcode, 1);
								//Start output buffer to capture the image
								//Output PNG image
								//ob_start();
								imagepng($img);
								//Get the image from the output buffer
								$output_img		=	ob_get_clean();
							echo '<img width=180px height=40px src="data:image/png;base64,' . base64_encode($output_img) . '"/>'; 
							echo '<br>'.$barcode;
																			
						?>
						
						</center>
																				
											<td><img alt="" src="<?php echo config_item("img"); ?>logopos.jpg"></img></td>
											</tr>	
											
											<tr>	
											
											<td colspan=3><p><br>
																			<div class="">
																				<div><strong>PENERIMA </strong> </div>
																			
																				<h4><?php 
																				$arr=explode('|',$response_data4);;//explode('|',$datas->response_data4);
																				$nama = ucfirst($arr[1]);
																				$alamat = ucfirst($arr[2]);
																				$kota = ucfirst($arr[5]) . ' '.ucfirst($arr[12]);
																				$prov=ucfirst($arr[9]);
																				$telp=ucfirst($arr[13]);
																				
																				echo ucfirst($nama) .'<br>'.ucfirst($alamat) .'<br>'.ucfirst($kota) .
																				'<br>'.ucfirst($prov) .'<br>HP. '.ucfirst($telp); ?>
																						</h4>
																					
																			</div>
																			<hr style="border-top: 1px dotted silver">
																			<p>
																			<br>
																			<div class="">
																					<div><h5><strong>PENGIRIM</strong>
																					</div>
																					
																						
																						<?php 
																						$arr1=explode('|',$response_data3);
																						$namasip = ucfirst($arr1[0]);
																						$alamatsip = ucfirst($arr1[1]). ' '.ucfirst($arr1[2]);
																						$kotasip = ucfirst($arr1[3]) .' - '.ucfirst($arr1[4]) .' '.ucfirst($arr1[7]);
																						$provsip=ucfirst($arr1[5]);
																						$telpsip=ucfirst($arr1[8]);
																						
																						echo ucfirst($namasip) .'<br>'.ucfirst($alamatsip) .'<br>'.ucfirst($kotasip) .
																						'<br>'.ucfirst($provsip) .'<br> HP. '.ucfirst($telpsip);  ?>
																						</h5>
																							
																						
																				</div>
																				<hr style="border-top: 1px dotted silver">
			
																			

											</td>
									<?php 		
									}
			echo "</tr>"; 
														
	?>
	</table>
	<!--
	<button onclick="window.print()">Cetak</button> 
	-->
														
			

			
		
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
</script>
	</body>
</html>
