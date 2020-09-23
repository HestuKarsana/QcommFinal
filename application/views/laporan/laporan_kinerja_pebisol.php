<?php $this->load->view('include/header'); ?>
<?php $this->load->view('include/navbar'); ?>

<?php
//$level = $this->session->userdata('ap_level');
session_start();
?>

<div class="container">
	<div class="panel panel-default">
		<div class="panel-body">
			<h5><i class='fa fa-file-text-o fa-fw'></i> Laporan Kinerja Pebisol</h5>
			<hr />

			<?php //echo form_open('laporan', array('id' => 'FormLaporan')); ?>
			<div class="row">
			    <div class="col-sm-4">
				    <div class="form-horizontal">
					    <div class="form-group">
							<label class="col-sm-5 control-label">Regional</label>
							<div class="col-sm-7">
							
							<select name='id_reg' id='id_reg' class='form-control input-sm' <?php echo $disabled; ?> >
								<option value='00' style='resize: vertical; width:100%;'>Nasional</option>
								<?php
								   $i=1;
									while($i<=11) 
										{
											if ($i<10)
											{
												echo "<option  value=0$i>0$i</option>";
											}
											else{
												
												echo "<option  value=$i>$i</option>";
											
											}
											$i=$i+1;
										}
								
								?>
							</select>
							</div>
						</div>	
					</div>		
				</div>
				 <div class="col-sm-4">
				    <div class="form-horizontal">
					    <div class="form-group">
						    <label class="col-sm-2 control-label">Kprk</label>
							<div class="col-sm-9">
							
							<select name='kantorpar' id='kantorpar' class='form-control input-sm' <?php echo $disabled; ?> style='resize: vertical; width:100%;'>
								<!--option value='00' style='resize: vertical; width:100%;'>Reg</option-->
								<?php
								     //echo "<option  value=$i>$i</option>";
								?>
							</select>
							</div>
						</div>	
					</div>		
				</div>
				
			</div>
			<div class="row">					
				<div class="col-sm-4">
					<div class="form-horizontal">
						<div class="form-group">
							<label class="col-sm-5 control-label">Tanggal</label>
							<div class="col-sm-7">
							<input type='text' name='from' class='form-control' id='tanggal_dari' value="<?php echo date('Y-m-d'); ?>">
							</div>
						</div>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="form-horizontal">
						<div class="form-group">
							<label class="col-sm-2 control-label">s/d</label>
							<div class="col-sm-6">
					<input type='text' name='to' style='resize: vertical; width:120%;' class='form-control' id='tanggal_sampai' value="<?php echo date('Y-m-d'); ?>">
							</div>
						</div>
					</div>
				</div>
				
				<div class="col-sm-4">
					<div class="form-horizontal">
						<div class="form-group">
							<div class="col-sm-2"></div>
							<div class="col-sm-9">
							
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
			var TglAwal,TglAkhir,RegNya,KprkNya;
			TglAwal='';
			TglAkhir='';
			RegNya='';
			KprkNya='';
			RegNya=$('#id_reg').val();
			KprkNya=$('#kantorpar').val();
			TglAwal=$('#tanggal_dari').val();
			TglAkhir=$('#tanggal_sampai').val();
			
			
			//$('#tampilOrder').hide();
			$.ajax ({ 
					   url: '<?= base_url() ?>index.php/GetKinerjaPebisol/GetData',
					   type: "post",
					   dataType: 'html',
					   //dataType: 'json',
					   delay: 250,
					 //  data :{kodepossip:kodepossip,kodepossial:kodepossial,berat:berat,anb:anb},
					   data :{TglAwal:TglAwal,TglAkhir:TglAkhir,RegNya:RegNya,KprkNya:KprkNya},
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

$(document).ready(function() {
    $("#id_reg").change(function() 
	{
	    var IdReg = $("#id_reg").val();
		//alert(IdReg);
	    // if(IdReg == 00)
		// {
			  // html += '<option>'+'00000'+'</option>';
			  // $("#kantorpar").html(html);
		// }
		// else{
			$.ajax
			  ({
				url: '<?= base_url() ?>index.php/GetKprk/GetData',
					  type: "post",
					  dataType: 'json',
					  delay: 250,
					  data :{IdReg:IdReg},
							   
				success : function(response) 
				{
				 var html = '';
				  var i;
				  var myData= response.nopend;
				  var mySplitResult = myData.split('#');
				  var pjgdata=response.jml;
				  html += '<option>'+'00000|SEMUA KPRK'+'</option>';
			
				  for(i=0; i<pjgdata; i++)
				  {
					  html += '<option>'+mySplitResult[i]+'</option>';
				  }	
				  $("#kantorpar").html(html);  
				  
				}
			  });
		//}  
      
      
    });
  });
</script>

<?php $this->load->view('include/footer'); ?>