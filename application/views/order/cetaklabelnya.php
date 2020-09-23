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
	<body>
		<?php //$this->load->view("_dipecah/head.php") ?>
		<?php $this->load->view('include/header'); ?>
							
							<?php
							$vbarcode='QOB212345678901';
							 $generator = new Picqer\Barcode\BarcodeGeneratorPNG(); 
							 /*echo '<h4><img height="30px" width="150px" src="data:image/png;base64,'
							 .base64_encode($generator->getBarcode($vbarcode, $generator::TYPE_CODE_128)).'/> 
							 */ ?>
							 <h4><img height="30px" width="150px" src="data:image/png;base64,
							 <?php base64_encode($generator->getBarcode($vbarcode, $generator::TYPE_CODE_128)); ?>">COBA</img></h4>
							
	</body>
</html>
