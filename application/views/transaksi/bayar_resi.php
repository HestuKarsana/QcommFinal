<style>
.footer {
	margin-bottom: 22px;
}
.panel-primary .form-group {
	margin-bottom: 10px;
}
.form-control {
	border-radius: 0px;
	box-shadow: none;
}
.error_validasi { margin-top: 0px; }

.textareaX {
 left: 0;
 top: 0;
 visibility: hidden;
}

</style>
<?php $this->load->view('include/header'); ?>
<?php $this->load->view('include/navbar'); ?>

<?php
//$level = $this->session->userdata('ap_level');
//session_start();
?>

<div class="container">
	<div class="panel panel-default">
		<div class="panel-body">
			<h5><i class='fa fa-file-text-o fa-fw'></i> Pembayaran transaksi qcomm!! </h5>
			<hr />

			<?php //echo form_open('laporan', array('id' => 'FormLaporan')); ?>
			<div class="row">
				<div class="col-sm-6">
					<div class="form-horizontal">
						<div class="form-group">
							<label class="col-sm-6 control-label">Nomor Barcode</label>
							<div class="col-sm-5">
								<input type='text' name='brc_cetak' class='form-control' id='brc_cetak' onkeyup="myFunction()">
								
							</div>
							<label class="col-sm-1 control-label">Enter</label>
							
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-6">
					<div class="form-horizontal">
						<div class="form-group">
							<label class="col-sm-6 control-label">Jumlah Yang Harus Dibayar</label>
							<div class="col-sm-5">
					        <input type='text' name='BsuNya' class='form-control' id='BsuNya'>
							<textarea name='bsu_byr' id='bsu_byr' class='textareaX' rows='1' ></textarea>
							
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-6">
					<div class="form-horizontal">
						<div class="form-group">
							<label class="col-sm-6 control-label">Nomor Rekening</label>
							<div class="col-sm-5">
					        <input type='text' name='norek' class='form-control' id='norek' onkeypress='return check_int(event)'>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-6">
					<div class="form-horizontal">
						<div class="form-group">
							<label class="col-sm-6 control-label">Nomor Token</label>
							<div class="col-sm-5">
					        <input type='text' name='notoken' class='form-control' id='notoken' onkeypress='return check_int(event)'>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-6">
					<div class="form-horizontal">
						<div class="form-group">
							<label class="col-sm-6 control-label"></label>
							<div class="col-sm-3">
					        <button type='button' class='btn btn-primary btn-block' id='BayarResi' style='resize: vertical; width:100%;'>
									<i class='fa fa-file-text-o fa-fw'></i>Bayar
							</button>
							
							</div>
							<div class="col-sm-2">
					        <button type="reset" class="btn btn-default" id='ResetData' style='resize: vertical; width:100%;'>
								Reset
							</button>
							
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
//-----------------------Ketika Tombol Reset Diklik-----------------//
	$('#ResetData').click(function(){
		$("#bsu_byr").val('');
		$("#brc_cetak").val('');
		$("#norek").val('');
		$("#notoken").val('');
		$("#BsuNya").val('');
		$("#brc_cetak").focus();	
	});
 
function check_int(evt) {
	var charCode = ( evt.which ) ? evt.which : event.keyCode;
	return ( charCode >= 48 && charCode <= 57 || charCode == 8 );
}
$(document).on('click', 'button#BayarResi', function(){
	BayarResi();
});

function BayarResi()
{
		if(($('#brc_cetak').val() !== '') && ($('#bsu_byr').val() !== '') && ($('#norek').val() !== '') && ($('#notoken').val() !== ''))
		{
			
			var jmlKirnya,bsuKirnya,itemKirnya,idrek,idtoken;
			jmlKirnya='';
			bsuKirnya='';
			itemKirnya='';
			idrek='';
			idtoken='';
			jmlKirnya=1;
			bsuKirnya=$("#bsu_byr").val();
			itemKirnya=$("#brc_cetak").val();
			idrek=$("#norek").val();
			idtoken=$("#notoken").val();
			
			$.ajax ({ 
					   url: '<?= base_url() ?>index.php/SetBayar2/set_bayar',
					   type: "post",
					   dataType: 'json',
					   delay: 250,
					   data :{jmlKirnya:jmlKirnya,bsuKirnya:bsuKirnya,itemKirnya:itemKirnya,idrek:idrek,idtoken:idtoken},
					   success: function (response) {
						   
						   if(response.rc_mess==00){
								$('.modal-dialog').removeClass('modal-lg1');
								$('.modal-dialog').addClass('modal-sm1');
								$('#ModalHeader').html('INFO');
								$('#ModalContent').html(response.desk_mess);
								$('#ModalFooter').html("<button type='button' class='btn btn-default' data-dismiss='modal'>OK</button>");
								$('#ModalGue').modal('show');
								
								$("#brc_cetak").val('');
								$("#bsu_byr").val('');
								$("#norek").val('');
								$("#idrek").val('');
								$("#notoken").val('');
								
						   }else{
										$('.modal-dialog').removeClass('modal-lg1');
										$('.modal-dialog').addClass('modal-sm1');
										$('#ModalHeader').html('INFO');
										$('#ModalContent').html(response.desk_mess);
										$('#ModalFooter').html("<button type='button' class='btn btn-default' data-dismiss='modal'>OK</button>");
										$('#ModalGue').modal('show');
										
								
								}
					  },
					   cache: true
				  });
		}
		else
		{
			$('.modal-dialog').removeClass('modal-lg');
			$('.modal-dialog').addClass('modal-sm');
			$('#ModalHeader').html('Oops !');
			$('#ModalContent').html('Lengkapi data terlebih dahulu!');
			$('#ModalFooter').html("<button type='button' class='btn btn-primary' data-dismiss='modal' autofocus>Ok</button>");
			$("#brc_cetak").focus();	
			$('#ModalGue').modal('show');
		}
	
}

$(document).on('change', '#bsu_byr', function(){
	HitungTotalKembalian();
});

function HitungTotalKembalian()
{
	var Cash = $('#bsu_byr').val();
	//var TotalBayar = $('#TotalBayarHidden').val();

	// if(parseInt(Cash) >= parseInt(TotalBayar)){
		// var Selisih = parseInt(Cash) - parseInt(TotalBayar);
		$('#BsuNya').val(to_rupiah(Cash));
	// } else {
		// $('#BsuNya').val('');
	// }
}
function to_rupiah(angka){
    var rev     = parseInt(angka, 10).toString().split('').reverse().join('');
    var rev2    = '';
    for(var i = 0; i < rev.length; i++){
        rev2  += rev[i];
        if((i + 1) % 3 === 0 && i !== (rev.length - 1)){
            rev2 += '.';
        }
    }
    return 'Rp. ' + rev2.split('').reverse().join('');
}
function myFunction() {
    var x = document.getElementById("brc_cetak");
    x.value = x.value.toUpperCase();
}
var input = document.getElementById("brc_cetak");
input.addEventListener("keyup", function(event) {
    if (event.keyCode === 13) {
        event.preventDefault();
        document.getElementById("brc_cetak").click();
        if($('#brc_cetak').val() !== '')
		{
	          
			  
			var itemKirnya;
			itemKirnya='';
			itemKirnya=$("#brc_cetak").val();
			
			$.ajax ({ 
					   url: '<?= base_url() ?>index.php/InqBayar/set_bayar',
					   type: "post",
					   dataType: 'json',
					   delay: 250,
					   data :{itemKirnya:itemKirnya},
					   success: function (response) {
						   
						   if(response.rc_mess==00){
								$("#bsu_byr").val(response.uangnya);
								$("#BsuNya").val(response.uangnya2);
								
								$("#norek").focus();
								
						   }else{
										$('.modal-dialog').removeClass('modal-lg1');
										$('.modal-dialog').addClass('modal-sm1');
										$('#ModalHeader').html('INFO');
										$('#ModalContent').html(response.desk_mess);
										$('#ModalFooter').html("<button type='button' class='btn btn-default' data-dismiss='modal'>OK</button>");
										$('#ModalGue').modal('show');
										
								
								}
					  },
					   cache: true
				  });
		}
		else
		{
			
			
			//alert(<?php echo $userdata['userid'];?>);
			$('.modal-dialog').removeClass('modal-lg');
			$('.modal-dialog').addClass('modal-sm');
			$('#ModalHeader').html('Oops !');
			$('#ModalContent').html('Masukkan ID Order!');
			$('#ModalFooter').html("<button type='button' class='btn btn-primary' data-dismiss='modal' autofocus>Ok</button>");
			$('#idorder').focus();
			$('#ModalGue').modal('show');
			
		}
	
    }
});	

</script>
<?php $this->load->view('include/footer'); ?>