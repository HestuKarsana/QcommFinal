<?php $this->load->view('include/header'); ?>
<?php $this->load->view('include/navadmin'); ?>

<?php
//$level = $this->session->userdata('ap_level');
session_start();
?>

<div class="container">
	<div class="panel panel-default">
		<div class="panel-body">
			<h5><i class='fa fa-file-text-o fa-fw'></i>Pemulihan User Pebisnis Online</h5>
			<hr />

			<?php //echo form_open('laporan', array('id' => 'FormLaporan')); ?>
			<div class="row">					
				
				<div class="col-sm-12">
					<div class="form-horizontal">
						<div class="form-group">
							<div class="col-sm-6">
							
		                       <button type='button' class='btn btn-primary btn-block' id='userpebisol' name='userpebisol' 
							   style='resize: vertical; width:73%;'>
											 <i class='fa fa-file-text-o fa-fw'></i>Tampilkan User Pebisol
								</button>
								
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
$(document).on('click', 'button#userpebisol', function(){
	getUserPebisol();
});

function getUserPebisol()
{
		
		//if($('#norek').val() !== '')
		//{
			//alert('tes');
			var TglAwal,TglAkhir;
			TglAwal='';
			TglAkhir='';
			TglAwal=$('#tanggal_dari').val();
			TglAkhir=$('#tanggal_sampai').val();
			//$('#tampilOrder').hide();
			$.ajax ({ 
					   url: '<?= base_url() ?>index.php/GetUserPebisol/GetData',
					   type: "post",
					   dataType: 'html',
					   //dataType: 'json',
					   delay: 250,
					 //  data :{kodepossip:kodepossip,kodepossial:kodepossial,berat:berat,anb:anb},
					   data :{TglAwal:TglAwal,TglAkhir:TglAkhir},
					   success: function (response) {
						   $('#ResponseInput').html(response);
						  
					  },
					   cache: true
				  });
		/*}
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
		*/
	
}

</script>

<?php $this->load->view('include/footer'); ?>