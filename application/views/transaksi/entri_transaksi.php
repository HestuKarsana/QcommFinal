<?php $this->load->view('include/header'); ?>
<?php $this->load->view('include/navbar'); ?>
<?php

//session_start();
?>
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

<?php
$level 		= $this->session->userdata('ses_id_user');
$readonly	= '';
$disabled	= '';
if($level !== 'admin')
{
	$readonly	= 'readonly';
	$disabled	= 'disabled';
}
?>

<div class="container-fluid">
	<div class="panel panel-default">
		<div class="panel-body">

			<div class='row'>
				<div class='col-sm-3'>
					<div class="panel panel-primary">
						<div class="panel-heading"><i class='fa fa-file-text-o fa-fw'></i> Referensi Data</div>
						<div class="panel-body">

							<div class="form-horizontal">
								<div class="form-group">
									<label class="col-sm-4 control-label">Tanggal</label>
									<div class="col-sm-8">
										<input type='text' name='tanggal' class='form-control input-sm' id='tanggal' value="<?php echo date('Y-m-d H:i:s'); ?>" <?php echo $disabled; ?>>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-4 control-label">Total Trx</label>
									<div class="col-sm-8">
										<input type='text' name='jmltrx' class='form-control input-sm' id='jmltrx' value="<?php echo number_format($this->session->userdata('ses_jml_transaksi'),0, ',', '.'); ?>" <?php echo $readonly; ?>>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-4 control-label">Jumlah Uang</label>
									<div class="col-sm-8">
									    <input type='text' name='bsutrx' class='form-control input-sm' id='bsutrx' value="<?php echo number_format($this->session->userdata('ses_bsu_transaksi'),0, ',', '.');?>" <?php echo $readonly; ?>>
										
									</div>
								</div>
							</div>

						</div>
					</div>
					
					
					<div class="panel panel-primary" id='PelangganArea'>
						<div class="panel-heading"><i class='fa fa-user'></i> User Login</div>
						<div class="panel-body">
							<div class="form-group">
									<div class="col-sm-8">
									<?php echo "<table><tr>
															<td aligment=center><label class='col-sm-2 control-label'> UserID</td>
															<td aligment=center><label class='col-sm-2 control-label'>".$this->session->userdata('ses_id_user')."</td>
									                   </tr>
													   <tr>
															<td aligment=center><label class='col-sm-2 control-label'> DIA</td>
															<td aligment=center><label class='col-sm-2 control-label'>".$this->session->userdata('ses_nippos')."</td>
									                   </tr>
													   <tr>
															<td aligment=center><label class='col-sm-2 control-label'>Nama</td>
															<td aligment=center style='resize: vertical; width:83%;'><label class='col-sm-2 control-label'>".$this->session->userdata('ses_nama')."</td>
									                   </tr>
													   </table>
									";?>
									</div>
								</div>

						</div>
						
						<div class="panel-body">
							<div class="form-group">
                                 <textarea  id='kdpos' rows='1' class='textareaX' ><?php echo $this->session->userdata('ses_nopen');?></textarea>
							</div>					

							

						</div>
					</div>
					<div class='row'>
					    <textarea  id='dataTmpJml' rows='1' class='textareaX' ><?php echo $this->session->userdata('ses_tmp_jml_transaksi');?></textarea>
						<textarea  id='dataTmpBsu' rows='1'  ><?php echo $this->session->userdata('ses_tmp_bsu_transaksi');?></textarea>
						<textarea  id='dataTmpItem' rows='1'  class='textareaX'><?php echo $this->session->userdata('ses_tmp_item_transaksi');?></textarea>
						
					</div>
				</div>
				<div class='col-sm-9'>
					<h5 class='judul-transaksi'>
						<i class='fa fa-shopping-cart fa-fw'></i> Ritel 
						<i class='fa fa-angle-right fa-fw'></i>
						<i class='fa fa-keyboard-o fa-fw'></i> F3->Bayar
						<i class='fa fa-keyboard-o fa-fw'></i> F7->Validasi Berat
						<i class='fa fa-keyboard-o fa-fw'></i> F8->Get Order
						<i class='fa fa-keyboard-o fa-fw'></i> F9->Cetak Resi
						<i class='fa fa-keyboard-o fa-fw'></i> F10->Simpan Transaksi
								
						<a href="<?php echo site_url('transaksi/transaksi'); ?>" class='pull-right'><i class='fa fa-refresh fa-fw'></i> Refresh Halaman</a>
					</h5>
					<!--table class='table table-bordered' id='TabelTransaksi'>
						<thead>
							<tr>
								<th style='width:35px;'>#</th>
								<th style='width:210px;'>IDORDER</th>
								<th>PENGIRIM & PENERIMA</th>
								<th style='width:120px;'>TARIF</th>
								<th style='width:75px;'>BERAT</th>
								<th style='width:125px;'>SUB TOTAL</th>
								<th style='width:40px;'></th>
							</tr>
						</thead>
						<tbody></tbody>
					</table-->
                    <i class='fa fa-plus fa-fw'></i><font size='3%'>Produk : <span id='Produk'></font></span>
					
					<div class='alert alert-info TotalBayar'>             
						<font size='5%'><b>Total : <span id='TotalBayar'>Rp. 0</b></font></span>
					</div>

					<div class='row'>
						<div class='col-sm-7'>
						    <p><i class='fa fa-keyboard-o fa-fw'></i> <b>ID Order</b></p>
						    <div class='row'>
							     
									<div class='col-sm-6' style='padding-right: 0px;'>
										<input type="text" class='form-control input-sm' id="idorder" name="idorder"  onkeyup="myFunction()" placeholder="Masukkan idorder" style='resize: vertical; width:100%;' />
									</div>
									<div class='col-sm-6'>
										
										<button type='button' class='btn btn-primary btn-block' id='cekOrder' style='resize: vertical; width:100%;'>
											 <i class='fa fa-file-text-o fa-fw'></i>Get Order
								        </button>
										
										
									</div>
							</div>
							
								<font size='3%'><i>
								<div id='ResponseInput'>
								</div></i></font>	<br>	
							<i class='fa fa-user'></i> <b>Pengirim</b>
							
							<textarea name='catatan' id='pengirim' class='form-control' rows='4' placeholder="Data pengirim" style='resize: vertical; width:100%;'disabled></textarea>
							
							<i class='fa fa-user'></i> <b>Penerima</b>
							<textarea name='catatan' id='penerima' class='form-control' rows='4' placeholder="Data Penerima" style='resize: vertical; width:100%;'disabled></textarea>
							<i class='fa fa-keyboard-o fa-fw'></i><b>Isi Kiriman</b>
							<br><textarea name='catatan' id='isikiriman' class='form-control' rows='1' placeholder="Isi Kiriman" style='resize: vertical; width:100%;'disabled></textarea>
							<p><i class='fa fa-keyboard-o fa-fw'></i> <b>Nilai Barang</b> (Rupiah)</p>
							<!--input type="text" class='form-control input-sm' id="berat" name="berat" placeholder="Tarif" style='resize: vertical; width:100%;' disabled /-->
							<textarea name='catatan' id='nilaiBarang' aligment=right rows='1' placeholder="Nilai Barang" style='resize: vertical; width:50%;aligment:right'disabled></textarea>
							
							<br/>
							
						</div>
						<div class='col-sm-5'>
							<div class="form-horizontal">
							
							<p><i class='fa fa-keyboard-o fa-fw'></i> <b>Berat</b> (Gr)</p>
							
							<textarea name='catatan' id='beratkir' aligment=right rows='1' placeholder="Bert Kiriman" style='resize: vertical; width:100%;aligment:right'disabled></textarea>
							<div class='row'>
									<div class='col-sm-6' style='padding-right: 0px;'>
										<input type='text' class='form-control input-sm' id='beratkiriman' name='beratkiriman' style='resize: vertical; width:100%;' onkeypress='return check_int(event)' />
										
									</div>
									<div class='col-sm-6'>
										
										<button type='button' class='btn btn-primary btn-block' id='CekBerat' style='resize: vertical; width:100%;'>
											 <i class='fa fa-file-text-o fa-fw'></i>Validasi Berat
										</button>
										
										
									</div>
							</div><br/>
							
							<p><i class='fa fa-keyboard-o fa-fw'></i> <b>Tarif </b>( Dalam Rupiah )</p>
							Tarif Saat Order<textarea name='catatan' id='tarif' aligment=right rows='4' placeholder="Tarif Kiriman" style='resize: vertical; width:100%;aligment:right'disabled></textarea>
							<br>Tarif Saat Transaksi Di Loket<textarea name='catatan' id='tarif2' aligment=right rows='4' placeholder="Tarif Kiriman2" style='resize: vertical; width:100%;aligment:right'disabled></textarea>
							<br/><br>
							<button type='button' class='btn btn-primary btn-block' id='SimpanData' style='resize: vertical; width:100%;'>
								 <i class='fa fa-floppy-o'></i> Simpan (F10)
							</button>
							<button type='button' class='btn btn-warning btn-block' id='BayarKiriman' style='resize: vertical; width:100%;'>
	                            <i class='fa fa-file-text-o fa-fw'></i>Bayar (F3)
							</button>
							</div>
						</div>	
						               <textarea name='dataProduk' id='dataProduk' class='textareaX' rows='1' placeholder="Data pengirim" style='resize: vertical; width:83%;'></textarea>
								       <textarea name='data1' id='data1'  rows='1' placeholder="Data pengirim" style='resize: vertical; width:83%;'></textarea>
									   <textarea name='data2' id='data2'  rows='1' placeholder="Data pengirim" style='resize: vertical; width:83%;'></textarea>
								       <textarea name='data3' id='data3'   rows='1' placeholder="Data pengirim" style='resize: vertical; width:83%;'></textarea>
									   <textarea name='data4' id='data4'   rows='1' placeholder="Data pengirim" style='resize: vertical; width:83%;'></textarea>
									  
									  <textarea name='data1x' id='data1'  rows='1' placeholder="data1x" style='resize: vertical; width:83%;'><?php echo $this->session->userdata('ses_tmp_data1');?></textarea>
                                       <textarea name='data2x' id='data2x'  rows='1' placeholder="data2x" style='resize: vertical; width:83%;'><?php echo $this->session->userdata('ses_tmp_data2');?></textarea>
								       <textarea name='data3x' id='data3x'   rows='1' placeholder="data3x" style='resize: vertical; width:83%;'><?php echo $this->session->userdata('ses_tmp_data3');?></textarea>
									   <textarea name='data4x' id='data4x'   rows='1' placeholder="data4x" style='resize: vertical; width:83%;'><?php echo $this->session->userdata('ses_tmp_data4');?></textarea>
									 
									  <textarea name='data5' id='data5'  class='textareaX' rows='1' placeholder="Data pengirim" style='resize: vertical; width:83%;'></textarea>
								       <textarea name='Kdsip' id='Kdsip' class='textareaX'  rows='1' placeholder="Data pengirim" style='resize: vertical; width:83%;'></textarea>
									   <textarea name='Kdsial' id='Kdsial' class='textareaX' rows='1' placeholder="Data pengirim" style='resize: vertical; width:83%;'></textarea>
								       <textarea  id='Totalbsutrx' rows='1'  class='textareaX' ><?php echo $this->session->userdata('ses_bsu_transaksi');?></textarea>
								       <textarea name='TotalBayarHidden2' id='TotalBayarHidden2' class='textareaX' rows='1'></textarea>
									   

					</div>

					<br />
				</div>
			</div>

		</div>
	</div>
</div>

<p class='footer'><?php echo config_item('web_footer'); ?></p>

<link rel="stylesheet" type="text/css" href="<?php echo config_item('plugin'); ?>datetimepicker/jquery.datetimepicker.css"/>
<script src="<?php echo config_item('plugin'); ?>datetimepicker/jquery.datetimepicker.js"></script>
<script>
$('#tanggal').datetimepicker({
	lang:'en',
	timepicker:true,
	format:'Y-m-d H:i:s'
});



$(document).ready(function(){

	for(B=1; B<=1; B++){
		BarisBaru();
	}

	$('#id_pelanggan').change(function(){
		if($(this).val() !== '')
		{
			$.ajax({
				url: "<?php echo site_url('transaksi/ajax-pelanggan'); ?>",
				type: "POST",
				cache: false,
				data: "id_pelanggan="+$(this).val(),
				dataType:'json',
				success: function(json){
					$('#telp_pelanggan').html(json.telp);
					$('#alamat_pelanggan').html(json.alamat);
					$('#info_tambahan_pelanggan').html(json.info_tambahan);
				}
			});
		}
		else
		{
			$('#telp_pelanggan').html('<small><i>Tidak ada</i></small>');
			$('#alamat_pelanggan').html('<small><i>Tidak ada</i></small>');
			$('#info_tambahan_pelanggan').html('<small><i>Tidak ada</i></small>');
		}
	});

	$('#BarisBaru').click(function(){
		BarisBaru();
	});

	$("#TabelTransaksi tbody").find('input[type=text],textarea,select').filter(':visible:first').focus();
});

function BarisBaru()
{
	var Nomor = $('#TabelTransaksi tbody tr').length + 1;
	var Baris = "<tr>";
		Baris += "<td>"+Nomor+"</td>";
		Baris += "<td>";
			Baris += "<input type='text' class='form-control' name='kode_barang[]' id='pencarian_kode' placeholder='Ketik Kode / Nama Barang'>";
			Baris += "<div id='hasil_pencarian'></div>";
		Baris += "</td>";
		Baris += "<td></td>";
		
		Baris += "<td>";
			Baris += "<input type='hidden' name='harga_satuan[]'>";
			Baris += "<span></span>";
		Baris += "</td>";
		
		Baris += "<td><input type='text' class='form-control' id='jumlah_beli' name='jumlah_beli[]' onkeypress='return check_int(event)' disabled></td>";
		Baris += "<td>";
			Baris += "<input type='hidden' name='sub_total[]'>";
			Baris += "<span></span>";
		Baris += "</td>";
		Baris += "<td><button class='btn btn-default' id='HapusBaris'><i class='fa fa-times' style='color:red;'></i></button></td>";
		Baris += "</tr>";

	$('#TabelTransaksi tbody').append(Baris);

	$('#TabelTransaksi tbody tr').each(function(){
		$(this).find('td:nth-child(2) input').focus();
	});

	HitungTotalBayar();
}

$(document).on('click', '#HapusBaris', function(e){
	e.preventDefault();
	$(this).parent().parent().remove();

	var Nomor = 1;
	$('#TabelTransaksi tbody tr').each(function(){
		$(this).find('td:nth-child(1)').html(Nomor);
		Nomor++;
	});

	HitungTotalBayar();
});

function AutoCompleteGue(Lebar, KataKunci, Indexnya)
{
	$('div#hasil_pencarian').hide();
	var Lebar = Lebar + 25;

	var Registered = '';
	$('#TabelTransaksi tbody tr').each(function(){
		if(Indexnya !== $(this).index())
		{
			if($(this).find('td:nth-child(2) input').val() !== '')
			{
				Registered += $(this).find('td:nth-child(2) input').val() + ',';
			}
		}
	});

	if(Registered !== ''){
		Registered = Registered.replace(/,\s*$/,"");
	}

	$.ajax({
		url: "<?php echo site_url('transaksi/ajax-kode'); ?>",
		type: "POST",
		cache: false,
		data:'keyword=' + KataKunci + '&registered=' + Registered,
		dataType:'json',
		success: function(json){
			if(json.status == 1)
			{
				$('#TabelTransaksi tbody tr:eq('+Indexnya+') td:nth-child(2)').find('div#hasil_pencarian').css({ 'width' : Lebar+'px' });
				$('#TabelTransaksi tbody tr:eq('+Indexnya+') td:nth-child(2)').find('div#hasil_pencarian').show('fast');
				$('#TabelTransaksi tbody tr:eq('+Indexnya+') td:nth-child(2)').find('div#hasil_pencarian').html(json.datanya);
			}
			if(json.status == 0)
			{
				$('#TabelTransaksi tbody tr:eq('+Indexnya+') td:nth-child(3)').html('');
				$('#TabelTransaksi tbody tr:eq('+Indexnya+') td:nth-child(4) input').val('');
				$('#TabelTransaksi tbody tr:eq('+Indexnya+') td:nth-child(4) span').html('');
				$('#TabelTransaksi tbody tr:eq('+Indexnya+') td:nth-child(5) input').prop('disabled', true).val('');
				$('#TabelTransaksi tbody tr:eq('+Indexnya+') td:nth-child(6) input').val(0);
				$('#TabelTransaksi tbody tr:eq('+Indexnya+') td:nth-child(6) span').html('');
			}
		}
	});

	HitungTotalBayar();
}

$(document).on('keyup', '#pencarian_kode', function(e){
	if($(this).val() !== '')
	{
		var charCode = e.which || e.keyCode;
		if(charCode == 40)
		{
			if($('#TabelTransaksi tbody tr:eq('+$(this).parent().parent().index()+') td:nth-child(2)').find('div#hasil_pencarian li.autocomplete_active').length > 0)
			{
				var Selanjutnya = $('#TabelTransaksi tbody tr:eq('+$(this).parent().parent().index()+') td:nth-child(2)').find('div#hasil_pencarian li.autocomplete_active').next();
				$('#TabelTransaksi tbody tr:eq('+$(this).parent().parent().index()+') td:nth-child(2)').find('div#hasil_pencarian li.autocomplete_active').removeClass('autocomplete_active');

				Selanjutnya.addClass('autocomplete_active');
			}
			else
			{
				$('#TabelTransaksi tbody tr:eq('+$(this).parent().parent().index()+') td:nth-child(2)').find('div#hasil_pencarian li:first').addClass('autocomplete_active');
			}
		} 
		else if(charCode == 38)
		{
			if($('#TabelTransaksi tbody tr:eq('+$(this).parent().parent().index()+') td:nth-child(2)').find('div#hasil_pencarian li.autocomplete_active').length > 0)
			{
				var Sebelumnya = $('#TabelTransaksi tbody tr:eq('+$(this).parent().parent().index()+') td:nth-child(2)').find('div#hasil_pencarian li.autocomplete_active').prev();
				$('#TabelTransaksi tbody tr:eq('+$(this).parent().parent().index()+') td:nth-child(2)').find('div#hasil_pencarian li.autocomplete_active').removeClass('autocomplete_active');
			
				Sebelumnya.addClass('autocomplete_active');
			}
			else
			{
				$('#TabelTransaksi tbody tr:eq('+$(this).parent().parent().index()+') td:nth-child(2)').find('div#hasil_pencarian li:first').addClass('autocomplete_active');
			}
		}
		else if(charCode == 13)
		{
			var Field = $('#TabelTransaksi tbody tr:eq('+$(this).parent().parent().index()+') td:nth-child(2)');
			var Kodenya = Field.find('div#hasil_pencarian li.autocomplete_active span#kodenya').html();
			var Barangnya = Field.find('div#hasil_pencarian li.autocomplete_active span#barangnya').html();
			var Harganya = Field.find('div#hasil_pencarian li.autocomplete_active span#harganya').html();
			
			Field.find('div#hasil_pencarian').hide();
			Field.find('input').val(Kodenya);

			$('#TabelTransaksi tbody tr:eq('+$(this).parent().parent().index()+') td:nth-child(3)').html(Barangnya);
			$('#TabelTransaksi tbody tr:eq('+$(this).parent().parent().index()+') td:nth-child(4) input').val(Harganya);
			$('#TabelTransaksi tbody tr:eq('+$(this).parent().parent().index()+') td:nth-child(4) span').html(to_rupiah(Harganya));
			$('#TabelTransaksi tbody tr:eq('+$(this).parent().parent().index()+') td:nth-child(5) input').removeAttr('disabled').val(1);
			$('#TabelTransaksi tbody tr:eq('+$(this).parent().parent().index()+') td:nth-child(6) input').val(Harganya);
			$('#TabelTransaksi tbody tr:eq('+$(this).parent().parent().index()+') td:nth-child(6) span').html(to_rupiah(Harganya));
			
			var IndexIni = $(this).parent().parent().index() + 1;
			var TotalIndex = $('#TabelTransaksi tbody tr').length;
			if(IndexIni == TotalIndex){
				BarisBaru();

				$('html, body').animate({ scrollTop: $(document).height() }, 0);
			}
			else {
				$('#TabelTransaksi tbody tr:eq('+$(this).parent().parent().index()+') td:nth-child(5) input').focus();
			}
		}
		else 
		{
			AutoCompleteGue($(this).width(), $(this).val(), $(this).parent().parent().index());
		}
	}
	else
	{
		$('#TabelTransaksi tbody tr:eq('+$(this).parent().parent().index()+') td:nth-child(2)').find('div#hasil_pencarian').hide();
	}

	HitungTotalBayar();
});

$(document).on('click', '#daftar-autocomplete li', function(){
	$(this).parent().parent().parent().find('input').val($(this).find('span#kodenya').html());
	
	var Indexnya = $(this).parent().parent().parent().parent().index();
	var NamaBarang = $(this).find('span#barangnya').html();
	var Harganya = $(this).find('span#harganya').html();

	$('#TabelTransaksi tbody tr:eq('+Indexnya+') td:nth-child(2)').find('div#hasil_pencarian').hide();
	$('#TabelTransaksi tbody tr:eq('+Indexnya+') td:nth-child(3)').html(NamaBarang);
	$('#TabelTransaksi tbody tr:eq('+Indexnya+') td:nth-child(4) input').val(Harganya);
	$('#TabelTransaksi tbody tr:eq('+Indexnya+') td:nth-child(4) span').html(to_rupiah(Harganya));
	$('#TabelTransaksi tbody tr:eq('+Indexnya+') td:nth-child(5) input').removeAttr('disabled').val(1);
	$('#TabelTransaksi tbody tr:eq('+Indexnya+') td:nth-child(6) input').val(Harganya);
	$('#TabelTransaksi tbody tr:eq('+Indexnya+') td:nth-child(6) span').html(to_rupiah(Harganya));

	var IndexIni = Indexnya + 1;
	var TotalIndex = $('#TabelTransaksi tbody tr').length;
	if(IndexIni == TotalIndex){
		BarisBaru();
		$('html, body').animate({ scrollTop: $(document).height() }, 0);
	}
	else {
		$('#TabelTransaksi tbody tr:eq('+Indexnya+') td:nth-child(5) input').focus();
	}

	HitungTotalBayar();
});

$(document).on('keyup', '#jumlah_beli', function(){
	var Indexnya = $(this).parent().parent().index();
	var Harga = $('#TabelTransaksi tbody tr:eq('+Indexnya+') td:nth-child(4) input').val();
	var JumlahBeli = $(this).val();
	var KodeBarang = $('#TabelTransaksi tbody tr:eq('+Indexnya+') td:nth-child(2) input').val();

	$.ajax({
		url: "<?php echo site_url('barang/cek-stok'); ?>",
		type: "POST",
		cache: false,
		data: "kode_barang="+encodeURI(KodeBarang)+"&stok="+JumlahBeli,
		dataType:'json',
		success: function(data){
			if(data.status == 1)
			{
				var SubTotal = parseInt(Harga) * parseInt(JumlahBeli);
				if(SubTotal > 0){
					var SubTotalVal = SubTotal;
					SubTotal = to_rupiah(SubTotal);
				} else {
					SubTotal = '';
					var SubTotalVal = 0;
				}

				$('#TabelTransaksi tbody tr:eq('+Indexnya+') td:nth-child(6) input').val(SubTotalVal);
				$('#TabelTransaksi tbody tr:eq('+Indexnya+') td:nth-child(6) span').html(SubTotal);
				HitungTotalBayar();
			}
			if(data.status == 0)
			{
				$('.modal-dialog').removeClass('modal-lg');
				$('.modal-dialog').addClass('modal-sm');
				$('#ModalHeader').html('Oops !');
				$('#ModalContent').html(data.pesan);
				$('#ModalFooter').html("<button type='button' class='btn btn-primary' data-dismiss='modal' autofocus>Ok, Saya Mengerti</button>");
				$('#ModalGue').modal('show');

				$('#TabelTransaksi tbody tr:eq('+Indexnya+') td:nth-child(5) input').val('1');
			}
		}
	});
});

$(document).on('keydown', '#jumlah_beli', function(e){
	var charCode = e.which || e.keyCode;
	if(charCode == 9){
		var Indexnya = $(this).parent().parent().index() + 1;
		var TotalIndex = $('#TabelTransaksi tbody tr').length;
		if(Indexnya == TotalIndex){
			BarisBaru();
			return false;
		}
	}

	HitungTotalBayar();
});

$(document).on('keyup', '#UangCash', function(){
	HitungTotalKembalian();
});

function HitungTotalBayar()
{
	var Total = 0;
	$('#TabelTransaksi tbody tr').each(function(){
		if($(this).find('td:nth-child(6) input').val() > 0)
		{
			var SubTotal = $(this).find('td:nth-child(6) input').val();
			Total = parseInt(Total) + parseInt(SubTotal);
		}
	});

	$('#TotalBayar').html(to_rupiah(Total));
	$('#TotalBayarHidden').val(Total);

	$('#UangCash').val('');
	$('#UangKembali').val('');
}

function HitungTotalKembalian()
{
	var Cash = $('#UangCash').val();
	var TotalBayar = $('#TotalBayarHidden').val();

	if(parseInt(Cash) >= parseInt(TotalBayar)){
		var Selisih = parseInt(Cash) - parseInt(TotalBayar);
		$('#UangKembali').val(to_rupiah(Selisih));
	} else {
		$('#UangKembali').val('');
	}
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

function check_int(evt) {
	var charCode = ( evt.which ) ? evt.which : event.keyCode;
	return ( charCode >= 48 && charCode <= 57 || charCode == 8 );
}

$(document).on('keydown', 'body', function(e){
	var charCode = ( e.which ) ? e.which : event.keyCode;

	if(charCode == 118) //F7
	{
		$('#beratkiriman').focus();
		return false;
	}

	if(charCode == 119) //F8
	{
		//window.location.href="<?php echo site_url('transaksi/transaksi'); ?>";
		
		$('#idorder').val('');
		$('#pengirim').val('');
		$('#penerima').val('');
		$('#tarif').val('');
		$('#Produk').text('');
		// $('#jmltrx').val('');
		// $('#bsutrx').val('');
		
		$('#TotalBayar').html('');
		$('#beratkiriman').val('');
		$('#beratkir').val('');
		
		// $('#data2').val('');
		// $('#data3').val('');
		// $('#data4').val('');
		
		$('#Kdsip').val('');
		$('#Kdsial').val('');
		 $('#nilaiBarang').val('');
		// $('#nilaiBarang').text('');
		// $('.modal-dialog').removeClass('modal-lg');
		// $('.modal-dialog').addClass('modal-sm');
		// $('#ModalHeader').html('Konfirmasi');
		// $('#ModalContent').html("Masukkan ID Order");
		// $('#ModalFooter').html("<button type='button' class='btn btn-primary' id='SimpanData'>Input Sekarang</button><button type='button' class='btn btn-default' data-dismiss='modal'>Batal</button>");
		// $('#ModalGue').modal('show');

		// setTimeout(function(){ 
	   		// $('#idorder').focus();
	    // }, 500);

								
		$('#idorder').focus();
		return false;
	}

	if(charCode == 120) //F9
	{
		CetakStruk();
		return false;
	}

	if(charCode == 114) //F3
	{
		BayarKiriman();
		return false;
	}

	
	if(charCode == 121) //F10
	{
		$('.modal-dialog').removeClass('modal-lg');
		$('.modal-dialog').addClass('modal-sm');
		$('#ModalHeader').html('Konfirmasi');
		$('#ModalContent').html("Apakah anda yakin ingin menyimpan transaksi ini ?");
		$('#ModalFooter').html("<button type='button' class='btn btn-primary' id='SimpanData'>Ya, saya yakin</button><button type='button' class='btn btn-default' data-dismiss='modal'>Batal</button>");
		$('#ModalGue').modal('show');

		setTimeout(function(){ 
	   		$('button#SimpanData').focus();
	    }, 500);

		return false;
	}
});

$(document).on('click', '#Simpann', function(){
	$('.modal-dialog').removeClass('modal-lg');
	$('.modal-dialog').addClass('modal-sm');
	$('#ModalHeader').html('Konfirmasi');
	$('#ModalContent').html("Apakah anda yakin ingin menyimpan transaksi ini ?");
	$('#ModalFooter').html("<button type='button' class='btn btn-primary' id='SimpanTransaksi'>Ya, saya yakin</button><button type='button' class='btn btn-default' data-dismiss='modal'>Batal</button>");
	$('#ModalGue').modal('show');

	setTimeout(function(){ 
   		$('button#SimpanTransaksi').focus();
    }, 500);
});

$(document).on('click', 'button#SimpanTransaksi', function(){
	SimpanTransaksi();
});

$(document).on('click', 'button#CetakStruk', function(){
	CetakStruk();
});
$(document).on('click', 'button#BayarKiriman', function(){
	BayarKiriman();
});
$(document).on('click', 'button#BayarKir', function(){
	BayarKir();
});

function SimpanTransaksi()
{
	var FormData = "nomor_nota="+encodeURI($('#nomor_nota').val());
	FormData += "&tanggal="+encodeURI($('#tanggal').val());
	FormData += "&id_kasir="+$('#id_kasir').val();
	FormData += "&id_pelanggan="+$('#id_pelanggan').val();
	FormData += "&" + $('#TabelTransaksi tbody input').serialize();
	FormData += "&cash="+$('#UangCash').val();
	FormData += "&catatan="+encodeURI($('#catatan').val());
	FormData += "&grand_total="+$('#TotalBayarHidden').val();

	$.ajax({
		url: "<?php echo site_url('transaksi/transaksi'); ?>",
		type: "POST",
		cache: false,
		data: FormData,
		dataType:'json',
		success: function(data){
			if(data.status == 1)
			{
				alert(data.pesan);
				window.location.href="<?php echo site_url('transaksi/transaksi'); ?>";
			}
			else 
			{
				$('.modal-dialog').removeClass('modal-lg');
				$('.modal-dialog').addClass('modal-sm');
				$('#ModalHeader').html('Oops !');
				$('#ModalContent').html(data.pesan);
				$('#ModalFooter').html("<button type='button' class='btn btn-primary' data-dismiss='modal' autofocus>Ok</button>");
				$('#ModalGue').modal('show');
			}	
		}
	});
}

$(document).on('click', '#TambahPelanggan', function(e){
	e.preventDefault();

	$('.modal-dialog').removeClass('modal-sm');
	$('.modal-dialog').removeClass('modal-lg');
	$('#ModalHeader').html('Tambah Pelanggan');
	$('#ModalContent').load($(this).attr('href'));
	$('#ModalGue').modal('show');
});

function CetakStruk()
{
	// if($('#TotalBayarHidden').val() > 0)
	// {
		//if(($('#DataCetak').val() !== '') && (#$('#dataTmpBsu').val()=='0'))
		if($('#data2x').val() !='')
		{
			//DataCetak
			// var FormData = "&idorder="+encodeURI($('#data1').val());
			// FormData += "&pengirim="+encodeURI($('#data3').val());
			// FormData += "&penerima="+encodeURI($('#data4').val());
			// FormData += "&tarif="+encodeURI($('#data2').val());
			
			//var FormData = "&DataCetak="+encodeURI($('#DataCetak').val());
			var FormData = "&idorder="+encodeURI($('#data1x').val());
			FormData += "&pengirim="+encodeURI($('#data3x').val());
			FormData += "&penerima="+encodeURI($('#data4x').val());
			FormData += "&tarif="+encodeURI($('#data2x').val());
			
			window.open("<?php echo site_url('Transaksi/transaksi_cetak/?'); ?>" + FormData,'_blank');
			//window.open("<?php echo site_url('SimpanData/cetak_label/?'); ?>"+ FormData ,'_blank');
			
		}
		else
		{
			$('.modal-dialog').removeClass('modal-lg');
			$('.modal-dialog').addClass('modal-sm');
			$('#ModalHeader').html('Oops !');
			$('#ModalContent').html('Lakukan entri order terlebih dahulu, lanjutkan simpan data dan pembayaran');
			$('#ModalFooter').html("<button type='button' class='btn btn-primary' data-dismiss='modal' autofocus>Ok</button>");
			$('#ModalGue').modal('show');
		}
	// }
	// else
	// {
		// $('.modal-dialog').removeClass('modal-lg');
		// $('.modal-dialog').addClass('modal-sm');
		// $('#ModalHeader').html('Oops !');
		// $('#ModalContent').html('Harap pilih barang terlebih dahulu');
		// $('#ModalFooter').html("<button type='button' class='btn btn-primary' data-dismiss='modal' autofocus>Ok</button>");
		// $('#ModalGue').modal('show');

	// }
}
function BayarKiriman()
{
	if($('#dataTmpItem').val() !== '')
		{
			//DataCetak
			var col4=$('#dataTmpJml').val();
			var col5=$('#dataTmpBsu').val();
			var col6=$('#dataTmpItem').val();
			
			
			 var data="<table width=100%>"+
						  "<tr><td>Jml Kiriman</td><td>:</td><td><input type='text' class='form-control input-sm' id='jmlKirnya' name='jmlKirnya' style='resize: vertical; width:100%;' readonly value="+col4+"></td></tr>"+
						  "<tr><td>Total Yang harus dibayar</td><td>:</td><td><input type='text' class='form-control input-sm' id='bsuKirnya' name='bsuKirnya' style='resize: vertical; width:100%;' readonly value="+col5+"></td></tr>"+
						  "<tr><td>Rincian Item</td><td>:</td><td><input type='text' class='form-control input-sm' id='itemKirnya' name='itemKirnya' style='resize: vertical; width:100%;' readonly value="+col6+"></td></tr>"+
						  "<tr><td>Masukkan Nomor Rekening</td><td>:</td><td><input type='text' class='form-control input-sm' id='idrek' name='idrek' placeholder='Masukkan Nomor Rekening' style='resize: vertical; width:100%;'/></td></tr>"+
						  "<tr><td>Masukkan Token</td><td>:</td><td><input type='text' class='form-control input-sm' id='idtoken' name='idtoken' placeholder='Masukkan Token' style='resize: vertical; width:100%;'/></td></tr></tabel>";

						  
			
			$('.modal-dialog').removeClass('modal-sm-6');
			$('.modal-dialog').addClass('modal-lg');
			$('#idrek').focus();
				
			$('#ModalHeader').html('Detail Transaksi');
			$('#ModalContent').html(data);//.load($(this).attr('href'));
			$('#ModalFooter').html("<button type='button' class='btn btn-primary' id='BayarKir'>Bayar</button><button type='button' class='btn btn-default' data-dismiss='modal'>Batal</button>");
			$('#ModalGue').modal('show');
						
		}
		else
		{
			$('.modal-dialog').removeClass('modal-lg');
			$('.modal-dialog').addClass('modal-sm');
			$('#ModalHeader').html('Oops !');
			$('#ModalContent').html('Lakukan entri data terlebih dahulu');
			$('#ModalFooter').html("<button type='button' class='btn btn-primary' data-dismiss='modal' autofocus>Ok</button>");
			$('#ModalGue').modal('show');
		}
		
	
}
function BayarKir()
{
		if($('#dataTmpItem').val() !== '')
		{
			
			var jmlKirnya,bsuKirnya,itemKirnya,idrek,idtoken;
			jmlKirnya='';
			bsuKirnya='';
			itemKirnya='';
			idrek='';
			idtoken='';
			jmlKirnya=$("#jmlKirnya").val();
			bsuKirnya=$("#bsuKirnya").val();
			itemKirnya=$("#itemKirnya").val();
			idrek=$("#idrek").val();
			idtoken=$("#idtoken").val();
			
			//$('#tampilOrder').hide();
			$.ajax ({ 
					   url: '<?= base_url() ?>index.php/SetBayar/set_bayar',
					   type: "post",
					   //dataType: 'html',
					   dataType: 'json',
					   delay: 250,
					 //  data :{kodepossip:kodepossip,kodepossial:kodepossial,berat:berat,anb:anb},
					   data :{jmlKirnya:jmlKirnya,bsuKirnya:bsuKirnya,itemKirnya:itemKirnya,idrek:idrek,idtoken:idtoken},
					   success: function (response) {
						   
						   // var data2="<table width=100%>"+
						  // "<tr><td>Respon Dari CGS</td><td>:</td><td>"+response.desk_mess+"</td></tr>"+
						  // "<tr><td>Respon Dari IPOS</td><td>:</td><td>"+response.respmsg+"</td></tr></tabel>";

						   if(response.rc_mess==00){
								$('.modal-dialog').removeClass('modal-lg1');
								$('.modal-dialog').addClass('modal-sm1');
								$('#ModalHeader').html('INFO');
								$('#ModalContent').html(response.desk_mess);
								$('#ModalFooter').html("<button type='button' class='btn btn-default' data-dismiss='modal'>OK</button>");
								$('#idorder').focus();
								$('#ModalGue').modal('show');
								
								$("#jmlKirnya").val('0');
								$("#bsuKirnya").val('0');
								$("#itemKirnya").val('');
								$("#idrek").val('');
								$("#idtoken").val('');
								
								$("#jmlKirnya").text('0');
								$("#bsuKirnya").text('0');
								$("#itemKirnya").text('');
								$("#idrek").text('');
								$("#idtoken").text('');
								
								$('#dataTmpJml').val('0');
								$('#dataTmpBsu').val('0');
								$('#dataTmpItem').val('');
								
								$('#data1x').val('');
								$('#data2x').val('');
								$('#data3x').val('');
								$('#data4x').val('');
								
								$('#data1x').val($('#data1').val());
								$('#data2x').val($('#data2').val());
								$('#data3x').val($('#data3').val());
								$('#data4x').val($('#data4').val());
								
						   }else{
										$('.modal-dialog').removeClass('modal-lg1');
										$('.modal-dialog').addClass('modal-sm1');
										$('#ModalHeader').html('INFO');
										$('#ModalContent').html(response.desk_mess);
										$('#ModalFooter').html("<button type='button' class='btn btn-default' data-dismiss='modal'>OK</button>");
								        $('#idorder').focus();
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
			$('#ModalContent').html('Masukkan ID Order!');
			$('#ModalFooter').html("<button type='button' class='btn btn-primary' data-dismiss='modal' autofocus>Ok</button>");
			$('#idorder').focus();
			$('#ModalGue').modal('show');
		}
	
}
var input = document.getElementById("idorder");
input.addEventListener("keyup", function(event) {
    if (event.keyCode === 13) {
        event.preventDefault();
        document.getElementById("idorder").click();
        if($('#idorder').val() !== '')
		{
	          $('#cekOrder').focus();
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
var input = document.getElementById("beratkiriman");
input.addEventListener("keyup", function(event) {
    if (event.keyCode === 13) {
        event.preventDefault();
        document.getElementById("beratkiriman").click();
        if($('#idorder').val() !== '')
		{
	          $('#CekBerat').focus();
		}
		// else if($('#idorder').val() !== '')
		// {
	          // $('#idorder').focus();
		// }
		else
		{
			$('.modal-dialog').removeClass('modal-lg');
			$('.modal-dialog').addClass('modal-sm');
			$('#ModalHeader').html('Masukkan berat sesuai fisik kirimannya, dan input idorder terlebih dahulu !');
			//$('#ModalContent').html("<table><tr> <td>Berat Kiriman</td><td><input type='text' class='form-control input-sm' id='vbrt' name='vbrt' placeholder='Masukkan Berat sesungguhnya='resize: vertical; width:83%;'/></td></tr</table>);
			$('#ModalFooter').html("<button type='button' class='btn btn-primary' data-dismiss='modal' autofocus>Ok</button>");
			$('#beratkir').focus();
			$('#ModalGue').modal('show');
		}
	
    }
});

$(document).on('click', 'button#cekOrder', function(){
	cekOrder();
});

function cekIDOrder()
{
		if($('#idorder').val() !== '')
		{
	          $('#cekOrder').focus();
		}
		else
		{
			$('.modal-dialog').removeClass('modal-lg');
			$('.modal-dialog').addClass('modal-sm');
			$('#ModalHeader').html('Oops !');
			$('#ModalContent').html('Masukkan ID Order!');
			$('#ModalFooter').html("<button type='button' class='btn btn-primary' data-dismiss='modal' autofocus>Ok</button>");
			$('#idorder').focus();
			$('#ModalGue').modal('show');
		}
}
function cekOrder()
{
		if($('#idorder').val() !== '')
		{
			var IdOrder;
			IdOrder='';
			IdOrder=$("#idorder").val();
			$('#tampilOrder').hide();
			$.ajax ({ 
					   url: '<?= base_url() ?>index.php/GetOrder/get_order',
					   type: "post",
					   //dataType: 'html',
					   dataType: 'json',
					   delay: 250,
					 //  data :{kodepossip:kodepossip,kodepossial:kodepossial,berat:berat,anb:anb},
					   data :{IdOrder:IdOrder},
					   success: function (response) {
						   
						   if(response.rc_mess==00){
								$('#pengirim').val(response.response_data3);
								 $('#penerima').val(response.response_data4);
								 $('#tarif').val(response.datatarif);
								 $('#tarif2').val(response.validasi_tarif);
								 
								 $('#Produk').text(response.produk);
								 $('#dataProduk').val(response.produk);
								 $('#TotalBayar').text(response.total);
								 $('#TotalBayarHidden2').val(response.total2);
								 $('#beratkir').val(response.berat);
								 $('#beratkiriman').val(response.berat);
								 $('#nilaiBarang').val(response.nilaibarang);
								 
								 $('#data1x').val('');
								 $('#data2x').val('');
								 $('#data3x').val('');
								 $('#data4x').val('');
								 
								 $('#data1x').val(response.par1);
								 $('#data2x').val(response.par2);
								 $('#data3x').val(response.par3);
								 $('#data4x').val(response.par4);
								 
								 $('#data5').val(response.response_data5);
								 $('#Kdsip').val(response.par5);
								 $('#Kdsial').val(response.par6);
								 $('#isikiriman').val(response.isikiriman);
								 
								$('#ResponseInput').val('');	
                                  if($('#tarif').val()!= $('#tarif2').val()){
									  
									  $('.modal-dialog').removeClass('modal-lg');
										$('.modal-dialog').addClass('modal-sm');
										$('#ModalHeader').html('Oops !');
										$('#ModalContent').html('Ada perbedaan tarif, saat order dan saat transaksi di loket!!');
										$('#ModalFooter').html("<button type='button' class='btn btn-primary' data-dismiss='modal' autofocus>Ok</button>");
										$('#idorder').focus();
										$('#ModalGue').modal('show');
								  }
								
								//$('#DataCetak').html(response.datasave);
						   }else{
							        //$('#ResponseInput').val(response.desk_mess);
						       
										$('.modal-dialog').removeClass('modal-lg');
										$('.modal-dialog').addClass('modal-sm');
										$('#ModalHeader').html('Oops !');
										$('#ModalContent').html(response.desk_mess);
										$('#idorder').focus();
										$('#ModalGue').modal('show');
										
										$('#idorder').val('');
										$('#pengirim').val('');
										$('#penerima').val('');
										$('#tarif').val('');
										$('#Produk').text('');
										$('#TotalBayar').text('');
										$('#beratkiriman').val('');
										$('#beratkir').val('');
										$('#TotalBayarHidden2').val('');	
										$('#Kdsip').val('');
										$('#Kdsial').val('');
										$('#nilaiBarang').val('');
										$('#tarif2').val('');
								       $('#isikiriman').val('');
								
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
			$('#ModalContent').html('Masukkan ID Order!');
			$('#ModalFooter').html("<button type='button' class='btn btn-primary' data-dismiss='modal' autofocus>Ok</button>");
			$('#idorder').focus();
			$('#ModalGue').modal('show');
		}
	
}
$(document).on('click', 'button#CekBerat', function(){
	CekBerat();
});

$(document).on('click', 'button#SimpanData', function(){
	SimpanData();
});


function CekBerat()
{
		if($('#beratkir').val() !== '')
		{
			var Kdsip,Kdsial,BeratValid,IdOrder,NilaiBarang,KdProduk;
			Kdsip='';
			Kdsial='';
			BeratValid='';
			KdProduk='';
			IdOrder='';
			NilaiBarang='';
			Kdsip=$("#kdpos").val();
			Kdsial=$("#Kdsial").val();
			BeratValid=$("#beratkiriman").val();
			IdOrder=$("#idorder").val();
			NilaiBarang =$("#nilaiBarang").val();
			KdProduk = $("#dataProduk").val();
			//$('#tampilOrder').hide();
			$.ajax ({ 
					   url: '<?= base_url() ?>index.php/CekBerat/ValidasiBerat',
					   type: "post",
					   dataType: 'json',
					   delay: 250,
					 //  data :{kodepossip:kodepossip,kodepossial:kodepossial,berat:berat,anb:anb},
					   data :{Kdsip:Kdsip,Kdsial:Kdsial,BeratValid:BeratValid,IdOrder:IdOrder,NilaiBarang:NilaiBarang,KdProduk:KdProduk},
					   success: function (response) {
						   
						   if(response.rc_mess==00){
								/*$('.modal-dialog').removeClass('modal-lg');
								$('.modal-dialog').addClass('modal-sm');
								$('#ModalHeader').html('SUKSES !');
								$('#ModalContent').html(response.desk_mess);
								$('#ModalFooter').html("<button type='button' class='btn btn-primary' data-dismiss='modal' autofocus>Ok</button>");
								*/
								$('#tarif').val(response.tarifvalid);
								$('#TotalBayar').text(response.total);
								$('#TotalBayarHidden2').val(response.total2);
								$('#data2x').val('');
								$('#data2x').val(response.response_data2);
								$('#tarif2').val(response.tarifvalid);
								
								//$('#ModalGue').modal('show');
								//$('#ResponseInput').html(response.Kdsip);					 
									 
						   }else{
							   
						        $('#ResponseInput').html(response.desk_mess);
						  
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
			$('#ModalContent').html('Berat kiriman masih kosong, lakukan get order terlebih dahulu!');
			
			$('#ModalFooter').html("<button type='button' class='btn btn-primary' data-dismiss='modal' autofocus>Ok</button>");
			$('#beratkiriman').focus();
			$('#ModalGue').modal('show');
		}
}

function SimpanData()
{
		if($('#idorder').val() !== '')
		{
			var IdOrder,Param2,Param3,Param4,Param5,TglPosting,JmlTrx,BsuTrx,TotalTampung,TmpJml,TmpBsu,TmpItem,KirJml,KirBsu,KirItem,ByrDuit;
			IdOrder='';
			Param2='';
			Param3='';
			Param4='';
			Param5='';
			TglPosting='';
			TotalTampung='';
			JmlTrx='';
			BsuTrx='';
			TmpJml='';
			TmpBsu='';
			TmpItem='';
			KirJml='';
			KirBsu='';
			KirItem='';
			ByrDuit='';
			IdOrder=$("#idorder").val();
			Param2=$("#data2").val();
			Param3=$("#data3").val();
			Param4=$("#data4").val();
			Param5=$("#data5").val();
			
			TglPosting=$("#tanggal").val();
			ByrDuit=$('#TotalBayarHidden2').val();
			BsuTrx=parseInt($('#Totalbsutrx').val())+parseInt($('#TotalBayarHidden2').val());
			TotalTampung=parseInt($('#Totalbsutrx').val())+parseInt($('#TotalBayarHidden2').val());
			
			// TmpBsu=parseInt($('#TotalBayarHidden2').val());
			// TmpItem=TmpItem+$("#idorder").val()+'|';
			if($('#dataTmpBsu').val()=='0'){
				TmpBsu=parseInt($('#TotalBayarHidden2').val());
			}else{
				TmpBsu=parseInt($('#dataTmpBsu').val())+parseInt($('#TotalBayarHidden2').val());
				
			}
			if($('#dataTmpItem').val()==''){
				TmpItem=$("#idorder").val()+'|';
			}else{
				TmpItem=$("#dataTmpItem").val()+$("#idorder").val()+'|';
				
			}
			// TmpBsu=$('#TotalBayarHidden2').val();
			// TmpItem=$("#idorder").val()+'|';
		
  		   //TmpItem=$("#TotalBayarItem").val($("#idorder").val()+'|');
	       
	
			var bilangan = BsuTrx;
	
				var	number_string = bilangan.toString(),
					sisa 	= number_string.length % 3,
					rupiah 	= number_string.substr(0, sisa),
					ribuan 	= number_string.substr(sisa).match(/\d{3}/g);
						
				if (ribuan) {
					separator = sisa ? '.' : '';
					rupiah += separator + ribuan.join('.');
				}
			
            JmlTrx=parseInt($('#jmltrx').val())+1;
			TmpJml=parseInt($("#dataTmpJml").val())+1;
			
			var bilangan2 = JmlTrx;
	
				var	number_string2 = bilangan2.toString(),
					sisa2 	= number_string2.length % 3,
					rupiah2 	= number_string2.substr(0, sisa2),
					ribuan2 	= number_string2.substr(sisa2).match(/\d{3}/g);
						
				if (ribuan2) {
					separator2 = sisa2 ? '.' : '';
					rupiah2 += separator2 + ribuan2.join('.');
				}
				
               
			$.ajax ({ 
					   url: '<?= base_url() ?>index.php/SimpanData/Save',
					   type: "post",
					   dataType: 'json',
					   delay: 250,
					   data :{IdOrder:IdOrder,Param2:Param2,Param3:Param3,Param4:Param4,Param5:Param5,TglPosting:TglPosting,JmlTrx:JmlTrx,BsuTrx:BsuTrx,TmpJml:TmpJml,TmpBsu:TmpBsu,TmpItem:TmpItem,ByrDuit:ByrDuit},
					   success: function (response) {
						   
						   if(response.rc_mess==00){
								$('.modal-dialog').removeClass('modal-lg');
								$('.modal-dialog').addClass('modal-sm');
								$('#ModalHeader').html('INFO');
								$('#ModalContent').html(response.desk_mess);
								$('#ModalFooter').html("<button type='button' class='btn btn-primary' data-dismiss='modal' autofocus>Ok</button>");
								$('#idorder').val('');
								$('#pengirim').val('');
								$('#penerima').val('');
								$('#tarif').val('');
								$('#Produk').text('');
								$('#jmltrx').val(rupiah2);
								$('#bsutrx').val(rupiah);
								
								$('#dataTmpJml').val('0');
								$('#dataTmpBsu').val('0');
								$('#dataTmpItem').val('');
								
								$('#dataTmpJml').val(TmpJml);
								$('#dataTmpBsu').val(parseInt($('#dataTmpBsu').val())+parseInt(TmpBsu));
								$('#dataTmpItem').val($('#dataTmpItem').val()+TmpItem);
								
									   
								$('#Totalbsutrx').val(TotalTampung);
								$('#TotalBayar').text('');
								$('#beratkiriman').val('');
								$('#tarif2').val('');
								$('#beratkir').val('');
								$('#TotalBayarHidden2').val('');	
								$('#Kdsip').val('');
								$('#Kdsial').val('');
								$('#data5').val('');
								$('#nilaiBarang').val('');
								$('#ModalGue').modal('show');
								$('#idorder').focus();
						   }
						   else if(response.rc_mess=='999'){
							   
							   
								 $('.modal-dialog').removeClass('modal-lg');
										$('.modal-dialog').addClass('modal-sm');
										$('#ModalHeader').html('Oops !');
										$('#ModalContent').html(response.desk_mess);
										$('#ModalFooter').html("<button type='button' class='btn btn-primary' data-dismiss='modal' autofocus>Ok</button>");
										$('#idorder').focus();
										$('#ModalGue').modal('show');
										
						   }
						   else{
							   
						       // $('#ResponseInput').html(response.desk_mess);
							   $('.modal-dialog').removeClass('modal-lg');
										$('.modal-dialog').addClass('modal-sm');
										$('#ModalHeader').html('Oops !');
										$('#ModalContent').html(response.desk_mess);
										$('#ModalFooter').html("<button type='button' class='btn btn-primary' data-dismiss='modal' autofocus>Ok</button>");
										$('#idorder').focus();
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
			$('#ModalContent').html('Masukkan ID Order!');
			$('#ModalFooter').html("<button type='button' class='btn btn-primary' data-dismiss='modal' autofocus>Ok</button>");
			$('#idorder').focus();
			$('#ModalGue').modal('show');
		}
}
function myFunction() {
    var x = document.getElementById("idorder");
    x.value = x.value.toUpperCase();
}

</script>
<?php $this->load->view('include/footer'); ?>