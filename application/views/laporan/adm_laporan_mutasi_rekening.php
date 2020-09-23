<?php $this->load->view('include/header'); ?>
<?php $this->load->view('include/navadmin'); ?>

<?php
//$level = $this->session->userdata('ap_level');
session_start();
?>

<div class="container">
	<div class="panel panel-default">
		<div class="panel-body">
			<h5><i class='fa fa-file-text-o fa-fw'></i> Mutasi Rekening</h5>
			<hr />

			<?php //echo form_open('laporan', array('id' => 'FormLaporan')); ?>
			<div class="row">					
				<div class="col-sm-3">
					<div class="form-horizontal">
						<div class="form-group">
							<label class="col-sm-7 control-label">Nomor Rekening</label>
							<div class="col-sm-5">
							<input type='text' name='norek' class='form-control' id='norek' style='resize: vertical; width:145%;'>
							</div>
						</div>
					</div>
				</div>
				<div class="col-sm-3">
					<div class="form-horizontal">
						<div class="form-group">
							<label class="col-sm-5 control-label">Tanggal</label>
							<div class="col-sm-7">
							<input type='text' name='from' class='form-control' id='tanggal_dari' value="<?php echo date('Y-m-d'); ?>">
							</div>
						</div>
					</div>
				</div>
				<div class="col-sm-3">
					<div class="form-horizontal">
						<div class="form-group">
							<label class="col-sm-2 control-label">s/d</label>
							<div class="col-sm-6">
					          <input type='text' name='to' style='resize: vertical; width:120%;' class='form-control' id='tanggal_sampai' value="<?php echo date('Y-m-d'); ?>">
							  
							</div>
						</div>
					</div>
				</div>
				
				<div class="col-sm-3">
					<div class="form-horizontal">
						<div class="form-group">
							<div class="col-sm-2"></div>
							<div class="col-sm-8">
							
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
function check_int(evt) {
	var charCode = ( evt.which ) ? evt.which : event.keyCode;
	return ( charCode >= 48 && charCode <= 57 || charCode == 8 );
}
$(document).on('click', 'button#CekReport', function(){
	CekReport();
});

function CekReport()
{
		if($('#norek').val() !== '')
		{
			//alert('tes');
			var TglAwal,TglAkhir,Norek;
			TglAwal='';
			TglAkhir='';
			Norek='';
			Norek=$('#norek').val();
			TglAwal=$('#tanggal_dari').val();
			TglAkhir=$('#tanggal_sampai').val();
			
			
			//$('#tampilOrder').hide();
			$.ajax ({ 
					   url: '<?= base_url() ?>index.php/GetMutasiRekening/GetData',
					   type: "post",
					   dataType: 'html',
					   //dataType: 'json',
					   delay: 250,
					 //  data :{kodepossip:kodepossip,kodepossial:kodepossial,berat:berat,anb:anb},
					   data :{TglAwal:TglAwal,TglAkhir:TglAkhir,Norek:Norek},
					   success: function (response) {
						   $('#ResponseInput').html(response);
						  
					  },
					   cache: true
				  });
		}
		else
		{
			$('.modal-dialog').removeClass('modal-lg');
			$('.modal-dialog').addClass('modal-sm');
			$('#ModalHeader').html('Oops !');
			$('#ModalContent').html('Masukkan Nomor Rekening!');
			$('#ModalFooter').html("<button type='button' class='btn btn-primary' data-dismiss='modal' autofocus>Ok</button>");
			$('#idorder').focus();
			$('#ModalGue').modal('show');
		}
	
}

</script>

<?php $this->load->view('include/footer'); ?>