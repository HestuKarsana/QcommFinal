<!DOCTYPE html>
<html lang="en">
	<head>
		<?php $this->load->view('include/header'); ?>
		
	</head>
<?php //if ($hal % 4 =) {}
									$datanya = $kirimans;
									$datas=json_decode($datanya);
									//foreach($datas as $key=>$val){
									//	echo $datas->response_data1.'<br>'.$datas->response_data2.'<br>'.$datas->response_data3.'<br>'.$datas->response_data4;
	
									
									?>
	<body class="no-skin">
			
						<!--
						<div class="page-header">
							<h1>
								Order Form
								<!-- <small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									and Validation
								</small> -->
						<!--	</h1>
						</div><!-- /.page-header -->
<div class="container">
	<div class="panel panel-default">
		<div class="panel-body">
			<div class="row">
				
				<div>		
						    <center>
								<h1><img src="<?php $barcode=$datas->response_data1; 
										echo site_url(); ?>/label_barcode/set_barcode/<?php echo $barcode ?>"> 
									</img></h1>
							</center>
								
					</div>						
				<HR>
				
			</div>
			
			<div class="row">
				<div class="col-sm-12">	
						<div class="col-sm-4">					
						    <h3>Kepada : </h3>
							<!-- -|yuyus|perumahan cimahi nagok rt 12/23 |-|-|cimahi|cimahi|cimahi|cimahi|jawa barat|-|indonesia|40512|086778836633|022432567|yuyus@posindonesia.co.id|-|- -->
								<h4><?php 
								$arr=explode('|',$datas->response_data4);
								$nama = $arr[1];
								$alamat = $arr[2];
								$kota = $arr[5] . ' Kodepos '.$arr[12];
								$prov=$arr[9];
								$telp=$arr[13];
								
								echo $nama .'<br>'.$alamat .'<br>'.$kota .'<br>'.$prov .'<br>'.$telp; ?>
										</h4>
								
						</div>	
						<HR>
				
						<div class="col-sm-4">					
						    <h3>Dari : </h3>
							<!-- dede|jalan cijambe saja|cijambe|ujungberung|bandung|jawa barat|indonesia|40601|08823765889|dede@posindonesia.co.id -->
								<h4><?php 
								$arr1=explode('|',$datas->response_data3);
								$namasip = $arr1[0];
								$alamatsip = $arr1[1]. ' Kec. '.$arr1[2];
								$kotasip = $arr1[3] .' - '.$arr1[4] .' Kodepos '.$arr1[7];
								$provsip=$arr1[5];
								$telpsip=$arr1[8];
								
								echo $namasip .'<br>'.$alamatsip .'<br>'.$kotasip .'<br>'.$provsip .'<br>'.$telpsip;  ?>
										</h4>
								
						</div>							
				</div>
			</div>
		</div>
	</div>
</div>
	<script>
		window.print();
	</script>		
	</body>
</html>

