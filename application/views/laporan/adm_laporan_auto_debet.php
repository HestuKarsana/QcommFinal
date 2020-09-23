<?php $this->load->view('include/header'); ?>
<?php $this->load->view('include/navadmin'); ?>

<?php
//$level = $this->session->userdata('ap_level');
//session_start();
?>

<div class="container">
	<div class="panel panel-default">
		<div class="panel-body">
			<h5><i class='fa fa-file-text-o fa-fw'></i> Rekap Auto Debet</h5>
			<hr />

			<?php //echo form_open('laporan', array('id' => 'FormLaporan')); ?>
			<div class="row">
				<div class="col-sm-4">
					<div class="form-horizontal">
						<div class="form-group">
							<label class="col-sm-7 control-label">Dari Tanggal</label>
							<div class="col-sm-5">
					<input type='text' name='from' class='form-control' id='tanggal_dari' value="<?php echo date('Y-m-d'); ?>">
							</div>
						</div>
					</div>
				</div>
				<div class="col-sm-3">
					<div class="form-horizontal">
						<div class="form-group">
							<label class="col-sm-6 control-label">Sampai Tanggal</label>
							<div class="col-sm-6">
					<input type='text' name='to' style='resize: vertical; width:120%;' class='form-control' id='tanggal_sampai' value="<?php echo date('Y-m-d'); ?>">
							</div>
						</div>
					</div>
				</div>
				<div class="col-sm-5">
					<div class="form-horizontal">
						<div class="form-group">
							<div class="col-sm-1"></div>
							<div class="col-sm-11">
							
		<button type='button' class='btn btn-primary btn-block' id='CekReport' style='resize: vertical; width:73%;'>
											 <i class='fa fa-file-text-o fa-fw'></i>Tampilkan
								</button><font size='3%'>
								
					<!--button type="button" class="btn btn-primary" style='margin-left: 0px;' id='CekReport'>Tampilkan</button-->
							</div>
						</div>
					</div>
				</div>
				
			</div>	

			<?php //echo form_close(); ?>

			<br />
			<div id='ResponseInput' style='resize: vertical; width:100%; font size=2%'></div>
		</div>
	</div>
</div>
<p class='footer'><?php echo config_item('web_footer'); ?></p>

<link rel="stylesheet" type="text/css" href="<?php echo config_item('plugin'); ?>datetimepicker/jquery.datetimepicker.css"/>
<script src="<?php echo config_item('plugin'); ?>datetimepicker/jquery.datetimepicker.js"></script>
<script> 
$('#tanggal_dari').datetimepicker({
	lang:'en',
	timepicker:false,
	format:'Y-m-d',
	closeOnDateSelect:true
});
$('#tanggal_sampai').datetimepicker({
	lang:'en',
	timepicker:false,
	format:'Y-m-d',
	closeOnDateSelect:true
});
/*
$(document).ready(function(){
	$('#FormLaporan').submit(function(e){
		e.preventDefault();

		var TanggalDari = $('#tanggal_dari').val();
		var TanggalSampai = $('#tanggal_sampai').val();

		if(TanggalDari == '' || TanggalSampai == '')
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
			//var URL = "<?php echo site_url('laporan/laporan_penjualan'); ?>/" + TanggalDari + "/" + TanggalSampai;
			//$('#result').load(URL);
		}
	});
});
*/
function check_int(evt) {
	var charCode = ( evt.which ) ? evt.which : event.keyCode;
	return ( charCode >= 48 && charCode <= 57 || charCode == 8 );
}
$(document).on('click', 'button#CekReport', function(){
	CekReport();
});

function CekReport()
{
		// if($('#idorder').val() !== '')
		// {
			//alert('tes');
			var TglAwal,TglAkhir;
			TglAwal='';
			TglAkhir='';
			TglAwal=$('#tanggal_dari').val();
			TglAkhir=$('#tanggal_sampai').val();
			
			//$('#tampilOrder').hide();
			$.ajax ({ 
					   url: '<?= base_url() ?>index.php/GetReport/GetData',
					   type: "post",
					   dataType: 'html',
					   //dataType: 'json',
					   delay: 250,
					 //  data :{kodepossip:kodepossip,kodepossial:kodepossial,berat:berat,anb:anb},
					   data :{TglAwal:TglAwal,TglAkhir:TglAkhir},
					   success: function (response) {
						   $('#ResponseInput').html(response);
						   // if(response.rc_mess==00){
								
								 
								// $('#ResponseInput').html(response.tabel);	 
						   // }else{
							   
						        // $('#ResponseInput').html(response.tabel);
						  
						   // }
					  },
					   cache: true
				  });
		// }
		// else
		// {
			// $('.modal-dialog').removeClass('modal-lg');
			// $('.modal-dialog').addClass('modal-sm');
			// $('#ModalHeader').html('Oops !');
			// $('#ModalContent').html('Masukkan ID Order!');
			// $('#ModalFooter').html("<button type='button' class='btn btn-primary' data-dismiss='modal' autofocus>Ok</button>");
			// $('#idorder').focus();
			// $('#ModalGue').modal('show');
		// }
	
}

</script>

<?php $this->load->view('include/footer'); ?>