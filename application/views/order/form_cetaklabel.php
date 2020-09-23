<?php $this->load->view('include/header'); ?>
<?php $this->load->view('include/navbar'); ?>

<?php
//$level = $this->session->userdata('ap_level');
?>

<div class="container">
	<div class="panel panel-default">
		<div class="panel-body">
			<h5><i class='fa fa-file-text-o fa-fw'></i> Cetak label alamat </h5>
			<hr />

			<?php echo form_open('laporan', array('id' => 'FormCetaklabel')); ?>
			<div class="row">
				<div class="col-sm-5">
					<div class="form-horizontal">
						<div class="form-group">
							<label class="col-sm-4 control-label">Tanggal</label>
							<div class="col-sm-8">
								<input type='text' name='from' class='form-control' id='tanggal' value="<?php echo date('Y-m-d'); ?>">
							</div>
						</div>
					</div>
				</div>
				<div class="col-sm-5">
					<div class="form-horizontal">
						<div class="form-group">
							
							<div class="col-sm-8">
								<button type="submit" class="btn btn-primary" style='margin-left: 0px;'><span class='glyphicon glyphicon-open-file'></span> Tampilkan</button>
							</div>
							<div class="col-sm-4"></div>
						</div>
						
						
					</div>
				</div>
				<!--
				<div class="col-sm-5">
					<div class="form-horizontal">
						<div class="form-group">
							<label class="col-sm-4 control-label">Sampai Tanggal</label>
							<div class="col-sm-8">
								<input type='text' name='to' class='form-control' id='tanggal_sampai' value="<?php// echo date('Y-m-d'); ?>">
							</div>
						</div>
					</div>
				</div>
				-->
			</div>	
			<!--
			<div class='row'>
				<div class="col-sm-5">
					<div class="form-horizontal">
						<div class="form-group">
							<div class="col-sm-4"></div>
							<div class="col-sm-8">
								<button type="submit" class="btn btn-primary" style='margin-left: 0px;'>Tampilkan</button>
							</div>
						</div>
					</div>
				</div>
			</div>
			-->
			<?php echo form_close(); ?>

			<br />
			<div id='result'></div>
			<div class="col-sm-4">
										<center><a href="<?php echo site_url();?>label_barcode/cetak_label" target="_BLANK">
												<button class="btn btn-info">Cetak Labelnya</button></a></center>
											
												
												
										
									</div>
		</div>
	</div>
</div>
<p class='footer'><?php //echo config_item('web_footer'); ?></p>

<link rel="stylesheet" type="text/css" href="<?php echo config_item('plugin'); ?>datetimepicker/jquery.datetimepicker.css"/>
<script src="<?php echo config_item('plugin'); ?>datetimepicker/jquery.datetimepicker.js"></script>
<script>
$('#tanggal').datetimepicker({
	lang:'en',
	timepicker:false,
	format:'Y-m-d',
	closeOnDateSelect:true
});
/*
$('#tanggal_sampai').datetimepicker({
	lang:'en',
	timepicker:false,
	format:'Y-m-d',
	closeOnDateSelect:true
});
*/
$(document).ready(function(){
	$('#FormCetaklabel').submit(function(e){
		e.preventDefault();

		var Tanggal= $('#tanggal').val();
		//var TanggalSampai = $('#tanggal_sampai').val();

		//if(TanggalDari == '' || TanggalSampai == '')
		if(Tanggal == '')	
		{
			$('.modal-dialog').removeClass('modal-lg');
			$('.modal-dialog').addClass('modal-sm');
			$('#ModalHeader').html('Oops !');
			$('#ModalContent').html("Tanggal harus diisi !");
			$('#ModalFooter').html("<button type='button' class='btn btn-primary' data-dismiss='modal' autofocus>Ok, Saya Mengerti</button>");
			$('#ModalGue').modal('show');
		}
		else
		{
			//var URL = "<?php echo site_url('laporan/penjualan'); ?>/" + TanggalDari + "/" + TanggalSampai;
			var URL = "<?php echo site_url();?>order/cetak_label";
			$('#result').load(URL);
		}
	});
});
</script>

<?php $this->load->view('include/footer'); ?>