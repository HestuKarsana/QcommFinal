<?php $this->load->view('include/header'); ?>
<?php $this->load->view('include/navbar'); ?>

<?php
//$level = $this->session->userdata('ap_level');
//session_start();
?>

<div class="container">
	<div class="panel panel-default">
		<div class="panel-body">
			<h5><i class='fa fa-file-text-o fa-fw'></i> Masukkan barcode yang mau dicetak!! </h5>
			<hr />

			<?php //echo form_open('laporan', array('id' => 'FormLaporan')); ?>
			<div class="row">
				<div class="col-sm-6">
					<div class="form-horizontal">
						<div class="form-group">
							<label class="col-sm-7 control-label">Nomor Barcode</label>
							<div class="col-sm-5">
					<input type='text' name='brc_cetak' class='form-control' id='brc_cetak'>
							</div>
						</div>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="form-horizontal">
						<div class="form-group">
							<div class="col-sm-1"></div>
							<div class="col-sm-11">
							
		<button type='button' class='btn btn-primary btn-block' id='CekReport' style='resize: vertical; width:63%;'>
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
		if($('#brc_cetak').val() !== '')
		{
			//alert('tes');
			var NoBarcode;
			NoBarcode='';
			NoBarcode=$('#brc_cetak').val();
			/*
			$.ajax ({ 
					   url: '<?= base_url() ?>index.php/GetDetailTran/GetData',
					   type: "post",
					   dataType: 'html',
					   delay: 250,
					   data :{NoBarcode:NoBarcode},
					   success: function (response) {
						   $('#ResponseInput').html(response);
					  },
					   cache: true
				  });
			*/	  
			
			var FormData = "&idorder="+encodeURI($('#brc_cetak').val());
			// FormData += "&pengirim="+encodeURI($('#data3').val());
			// FormData += "&penerima="+encodeURI($('#data4').val());
			// FormData += "&tarif="+encodeURI($('#data2').val());
			
			window.open("<?php echo site_url('Cetakulang_resi/transaksi_cetak/?'); ?>" + FormData,'_blank');
			
			
		}
		else
		{
			$('.modal-dialog').removeClass('modal-lg');
			$('.modal-dialog').addClass('modal-sm');
			$('#ModalHeader').html('Oops !');
			$('#ModalContent').html('Masukkan Nomor Barcode!');
			$('#ModalFooter').html("<button type='button' class='btn btn-primary' data-dismiss='modal' autofocus>Ok</button>");
			$('#ModalGue').modal('show');
		}
	
}

</script>

<?php $this->load->view('include/footer'); ?>