<?php $this->load->view('include/header'); ?>
<?php $this->load->view('include/navbar'); ?>

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
</style>

<?php
$level 		= $this->session->userdata('ap_level');
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
			<div class='col-sm-1'>
			</div>
				<div class='col-sm-5'>
					<div class="panel panel-primary">
						<div class="panel-heading"><i class='fa fa-user'></i> Informasi Pengirim</div>
						<div class="panel-body">

							<div class="form-horizontal">
								<div class="form-group">
									<label class="col-sm-3 control-label">Nama </label>
									<div class="col-sm-9">
										<input type="text" class='form-control input-sm' id="namasip" name="namasip" placeholder="Nama" />
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label">Alamat </label>
									<div class="col-sm-9">
										<input type="text" class='form-control input-sm' id="alamatsip" name="alamatsip" placeholder="Alamat (jalan, gang, rt/rw)" />
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-sm-3 control-label"> </label>
									<div class="col-sm-9">
										<!--<input type='text' name='nomor_nota' class='form-control input-sm' id='nomor_nota' value="<?php //echo strtoupper(uniqid()).$this->session->userdata('ap_id_user'); ?>" <?php //echo $readonly; ?>> -->
										<!-- <select id='kodepospengirim' class="form-control input-sm" placeholder="Kabupaten/kecamatan/kelurahan"></select> -->
										<select id='kodepospengirim' class="js-example-basic-single js-states form-control input-sm" placeholder="Kabupaten/kecamatan/kelurahan" data-width="100%"></select>
									
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label"></label>
									<div class="col-sm-9">
										<textarea id="alamatpengirim" class="form-control " style="disabled:false" ></textarea>
										<input type="hidden" name="kodepossip" id="kodepossip" class="col-xs-12 col-sm-6" />
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label">email </label>
									<div class="col-sm-9">
										<input type="text" name="emailsip" id="emailsip" class="form-control input-sm" placeholder="email" />
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label">No. Telp </label>
									<div class="col-sm-9">
										<input type="text" id="phonesip" name="phonesip" />
									</div>
								</div>
								
								
								<!--
								<div class="form-group">
									<label class="col-sm-4 control-label">Tanggal</label>
									<div class="col-sm-8">
										<input type='text' name='tanggal' class='form-control input-sm' id='tanggal' 
										value="<?php //echo date('Y-m-d H:i:s'); ?>" <?php //echo $disabled; ?>>
										
									</div>
								</div> -->
								<!--
								<div class="form-group">
									<label class="col-sm-4 control-label">Kasir</label>
									<div class="col-sm-8">
										<select name='id_kasir' id='id_kasir' class='form-control input-sm' <?php //echo $disabled; ?>>
											<?php
										/*	if($kasirnya->num_rows() > 0)
											{
												foreach($kasirnya->result() as $k)
												{
													$selected = '';
													if($k->id_user == $this->session->userdata('ap_id_user')){
														$selected = 'selected';
													}

													echo "<option value='".$k->id_user."' ".$selected.">".$k->nama."</option>";
												}
											}*/
											?>
										</select>
									</div>
								</div> -->
							</div>

						</div>
					</div>
					
				</div>
				<div class='col-sm-5'>
				<div class="panel panel-primary" id='PelangganArea'>
						<div class="panel-heading"><i class='fa fa-user'></i> Informasi Penerima</div>
						<div class="panel-body">
							<div class="form-horizontal">
							<div class="form-group">
									<label class="col-sm-3 control-label">Nama </label>
									<div class="col-sm-9">
										<input type="text" class='form-control input-sm' id="namasip" name="namasip" placeholder="Nama" />
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label">Alamat </label>
									<div class="col-sm-9">
										<input type="text" class='form-control input-sm' id="alamatsial" name="alamatsial" placeholder="Alamat (jalan, gang, rt/rw)" />
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-sm-3 control-label"> </label>
									<div class="col-sm-9">
										<!--<input type='text' name='nomor_nota' class='form-control input-sm' id='nomor_nota' value="<?php //echo strtoupper(uniqid()).$this->session->userdata('ap_id_user'); ?>" <?php //echo $readonly; ?>> -->
										<!-- <select id='kodepospengirim' class="form-control input-sm" placeholder="Kabupaten/kecamatan/kelurahan"></select> -->
										<select id='kodepospenerima' class="js-example-basic-single js-states form-control input-sm" placeholder="Kabupaten/kecamatan/kelurahan"  data-width="100%"></select>
									
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label"></label>
									<div class="col-sm-9">
										<textarea id="alamatpenerima" class="form-control " style="disabled:false" ></textarea>
										<input type="hidden" name="kodepossial" id="kodepossial" class="col-xs-12 col-sm-6" />
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label">email </label>
									<div class="col-sm-9">
										<input type="text" name="emailsial" id="emailsial" class="form-control input-sm" placeholder="email" />
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label">No. Telp </label>
									<div class="col-sm-9">
										<input type="text" id="phonesial" name="phonesial" />
									</div>
								</div>
							</div>

						</div>
					</div>
					
				</div>
				<div class='col-sm-1'>
				</div>
			</div>	
			<!--
			<div class='row'>	
				<div class='col-sm-2'>
				</div>
				<div class='col-sm-8'>
				<div class="panel panel-primary" id='PelangganArea'>
						<div class="panel-heading"><i class='fa fa-user'></i> Informasi Penerima</div>
						<div class="panel-body">
							<div class="form-horizontal">
							<div class="form-group">
									<label class="col-sm-3 control-label">Nama </label>
									<div class="col-sm-9">
										<input type="text" class='form-control input-sm' id="namasip" name="namasip" placeholder="Nama" />
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label">Alamat </label>
									<div class="col-sm-9">
										<input type="text" class='form-control input-sm' id="alamatsial" name="alamatsial" placeholder="Alamat (jalan, gang, rt/rw)" />
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-sm-3 control-label"> </label>
									<div class="col-sm-9">
										<!--<input type='text' name='nomor_nota' class='form-control input-sm' id='nomor_nota' value="<?php //echo strtoupper(uniqid()).$this->session->userdata('ap_id_user'); ?>" <?php //echo $readonly; ?>> -->
										<!-- <select id='kodepospengirim' class="form-control input-sm" placeholder="Kabupaten/kecamatan/kelurahan"></select> -->
				<!--						<select id='kodepospenerima' class="js-example-basic-single js-states form-control input-sm" placeholder="Kabupaten/kecamatan/kelurahan"  data-width="100%"></select>
									
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label"></label>
									<div class="col-sm-9">
										<textarea id="alamatpenerima" class="form-control " style="disabled:false" ></textarea>
										<input type="hidden" name="kodepossial" id="kodepossial" class="col-xs-12 col-sm-6" />
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label">email </label>
									<div class="col-sm-9">
										<input type="text" name="emailsial" id="emailsial" class="form-control input-sm" placeholder="email" />
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-3 control-label">No. Telp </label>
									<div class="col-sm-9">
										<input type="text" id="phonesial" name="phonesial" />
									</div>
								</div>
							</div>

						</div>
					</div>
					<div class='col-sm-2'>
					</div>
				</div>
			</div>
			-->
			<div class='row'>	
				<div class='col-sm-1'>
				</div>
				<div class='col-sm-10'>
				<div class="panel panel-primary" id='PelangganArea'>
						<div class="panel-heading"><i class='fa fa-user'></i> Informasi Kiriman</div>
						<div class="panel-body">
							<div class="form-horizontal">
								<div class="form-group">
									<label class="col-sm-2 control-label">Berat (Gram.) </label>
									<div class="col-sm-2">
										<input type="text" id="berat" name="berat" placeholder="Berat (gram)" class="form-control" value="0"></input>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label">Harga Barang (Rp.) </label>
									<div class="col-sm-2">
										<input type="text" id="nb" name="nb" placeholder="Harga Barang" class="form-control" value="0"></input>
									</div>
								</div>
								
								
								<div class="form-group">
									<label class="col-sm-2 control-label"></label>
									<div class="col-sm-2">
										<textarea id="isikiriman" class="form-control input-sm" ></textarea>
										
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label"></label>
									<div class="col-sm-2">
										<button type='button' class='btn btn-warning btn-block' id='cekongkir'>
											 Cek Tarif
										</button>
										
									</div>
								</div>
								<div id="tampiltarif"> 	
																
								</div>	
								<div class="form-group" name="estimasiongkir" id="estimasiongkir" style="display:none">
									<label class="col-sm-10 control-label"></label>
									<div class="col-sm-2">
										<button type='button' class='btn btn-warning btn-block' id='addposting'>
											 SIMPAN
										</button>
										
									</div>
								</div>	
							
								
								
								
							</div>
							<div class="form-horizontal">
								
								
							</div>

						</div>
					</div>
					
				</div>
				<div class='col-sm-1'>
					</div>
			</div>
		<!--
			<div class='row'>	
				<div class='col-sm-2'>
				</div>
				<div class='col-sm-8'>
					<div class="panel panel-primary">
						<div class="panel-heading" ><i class='fa fa-user'></i> Estimasi Tarif Kiriman</div>
						<div class="panel-body">
							<div class="form-horizontal">
								<div id="tampiltarif"> 	
																
								</div>	
								<div class="form-group">
									<label class="col-sm-8 control-label"></label>
									<div class="col-sm-4">
										<button type='button' class='btn btn-warning btn-block' id='addposting'>
											 Order
										</button>
										
									</div>
									</div>	
								
							</div>

						</div>
						
					</div>
					<div class='col-sm-2'>
					</div>
				</div>
			</div>
			-->
			
			<div class='row'>	
				<div class='col-sm-1'>
				</div>
				<div class='col-sm-10'>
					
						
				
								
								<div class="form-group" name="sidorder" id="sidorder" style="display:none">
									<div class="col-sm-3">
										
										
									</div>
									<div class="col-sm-6 control-label alert alert-info">
									<center><label  id="idorder" name="idorder" disabled ></center>
									</label>
									</div>
									<div class="col-sm-3">
									</div>
									<!--
									<div class="col-sm-4">
										<center><a href="<?php echo site_url();?>/label_barcode/cetak_label" target="_BLANK">
												<button class="btn btn-info">Cetak Label</button></a></center>
										<button type='button' class='btn btn-warning btn-block' id='cetaklabel'>
											 Order
										</button>		
												
												
										
									</div>
									-->
								</div>	
								
							
					
					</div>
					<div class='col-sm-1'>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<p class='footer'><?php echo config_item('web_footer'); ?></p>

<link rel="stylesheet" type="text/css" href="<?php echo config_item('plugin'); ?>datetimepicker/jquery.datetimepicker.css"/>
<script src="<?php echo config_item('plugin'); ?>datetimepicker/jquery.datetimepicker.js"></script>
<script src="<?php echo config_item('plugin'); ?>datetimepicker/jquery.datetimepicker.js"></script>
<script src="<?php echo config_item('js'); ?>select2.min.js"></script>
<script>
$('#tanggal').datetimepicker({
	lang:'en',
	timepicker:true,
	format:'Y-m-d H:i:s'
});

$(document).ready(function(){
	//autocomplete kodepos pengirim
      $("#kodepospengirim").select2({
		placeholder: '- Ketikkan alamat (kec. / kel. ) -',
        minimumInputLength: 3,
         ajax: { 
           url: '<?= base_url() ?>index.php/getKodepos/kodepos',
           type: "post",
           dataType: 'json',
           delay: 250,
           data: function (params) {
              return {
                searchTerm: params.term // search term
              };
           },
           processResults: function (response) {
              return {
                 results: response
              };
           },
           cache: true
         },
		width: '100%' // need to override the changed default 
     });
	 $('#kodepospengirim').on('change', function (evt) {
		if ($('#kodepospengirim').select2('val') != null){
		var stralamat,strKodepos,alamatsip;
			alamatsip='';
			stralamat='';
			strKodepos='';
			alamatsip=$("#alamatsip").val();
			strKodepos=$("#kodepospengirim").val();
			stralamat=$('#kodepospengirim :selected').text();
			stralamat=alamatsip+' - '+stralamat;
			//console.log(stralamat);		
			$('#alamatpengirim').val(stralamat);
			$('#kodepossip').val(strKodepos);
			$('#kodepospengirim').val('Ketikkan Alamat');
			
	}
	});
	//autocomplete kodepos penerima
      $("#kodepospenerima").select2({
		placeholder: '- Ketikkan alamat (kec. / kel. ) -',
        minimumInputLength: 3,
         ajax: { 
           url: '<?= base_url() ?>index.php/getKodepos/kodepos',
           type: "post",
           dataType: 'json',
           delay: 250,
           data: function (params) {
              return {
                searchTerm: params.term // search term
              };
           },
           processResults: function (response) {
              return {
                 results: response
              };
           },
           cache: true,
			width: '100%'// need to override the changed default 
         }
     });
	 $('#kodepospenerima').on('change', function (evt) {
		if ($('#kodepospenerima').select2('val') != null){
		var stralamat,strKodepos,alamatsial;
			alamatsial='';
			stralamat='';
			strKodepos='';
			alamatsial=$("#alamatsial").val();
			strKodepos=$("#kodepospenerima").val();
			stralamat=$('#kodepospenerima :selected').text();
			stralamat=alamatsial+' - '+stralamat;
			//console.log(stralamat);		
			$('#alamatpenerima').val(stralamat);
			$('#kodepossial').val(strKodepos);
		}
	});
$('#cekongkir').on('click', function (evt) {
			
			var kodepossip,kodepossial,berat,anb;
			kodepossip='';
			kodepossial='';
			berat='';
			anb='';
			kodepossip=$("#kodepossip").val();
			kodepossial=$("#kodepossial").val();
			berat=$("#berat").val();
			anb=$("#nb").val();
			//alert('OK '+kodepossip+'-'+kodepossial+'-'+berat+'-'+anb);
			$('#tampiltarif').hide();
			$('#cekongkir').html('pencarian..');
			$.ajax ({ 
					   url: '<?= base_url() ?>index.php/ongkir/get_ongkir',
					   type: "post",
					   dataType: 'html',
					   delay: 250,
					   data :{kodepossip:kodepossip,kodepossial:kodepossial,berat:berat,anb:anb},
					   /*data: function (params) {
						  return {
							searchTerm: params.term // search term
						  };
					   }, */
					   success: function (response) {
						  /*return {
							 results: response
						  };
						  */
						  //console.log(response);
						  $('#tampiltarif').html(response);
						  $('#tampiltarif').show();
						  $('#cekongkir').html('cek tarif');
						  $('#estimasiongkir').show();
						  
						  
						  
						  
					   },
					   cache: true
				  });
			
			
			//$('#cekongkir').html('pencarian..');
			//alert('OK '+kodepossip+'-'+kodepossial+'-'+berat+'-'+anb);
			//var txtlacak=$('#txtlacak').val();
			/*
			$.ajax({
						url: "<?php echo base_url('ongkir/get_ongkir') ?>", 
						type: "POST",
						data : {txtlacak:txtlacak},
						dataType: "html",
						success: function( response ) {
															alert (response);
															
														}
												})
			*/
	});
	//end of cek ongkir	
$('#cetaklabel').on('click', function (evt) {
			alert ('ok');
			var extID=$('#idorder').val();
			alert (extID);
			
			/*
			$.ajax({
						url: "<?php echo base_url('ongkir/get_ongkir') ?>", 
						type: "POST",
						data : {txtlacak:txtlacak},
						dataType: "html",
						success: function( response ) {
															alert (response);
															
														}
												})
			/*
			var kodepossip,kodepossial,berat,anb;
			kodepossip='';
			kodepossial='';
			berat='';
			anb='';
			kodepossip=$("#kodepossip").val();
			kodepossial=$("#kodepossial").val();
			berat=$("#berat").val();
			anb=$("#nb").val();
			//alert('OK '+kodepossip+'-'+kodepossial+'-'+berat+'-'+anb);
			$('#tampiltarif').hide();
			$('#cekongkir').html('pencarian..');
			$.ajax ({ 
					   url: '<?= base_url() ?>index.php/ongkir/get_ongkir',
					   type: "post",
					   dataType: 'html',
					   delay: 250,
					   data :{kodepossip:kodepossip,kodepossial:kodepossial,berat:berat,anb:anb},
					   /*data: function (params) {
						  return {
							searchTerm: params.term // search term
						  };
					   }, */
			//		   success: function (response) {
						  /*return {
							 results: response
						  };
						  */
						  //console.log(response);
				/*		  $('#tampiltarif').html(response);
						  $('#tampiltarif').show();
						  $('#cekongkir').html('cek tarif');
						  
					   },
					   cache: true
				  });
			*/
			
			//$('#cekongkir').html('pencarian..');
			//alert('OK '+kodepossip+'-'+kodepossial+'-'+berat+'-'+anb);
			//var txtlacak=$('#txtlacak').val();
			/*
			$.ajax({
						url: "<?php echo base_url('ongkir/get_ongkir') ?>", 
						type: "POST",
						data : {txtlacak:txtlacak},
						dataType: "html",
						success: function( response ) {
															alert (response);
															
														}
												})
			*/
	});
	//end of cetak label

	$("#addposting").click(function () {
							var PETUGAS,serviceId,senderName,
								senderAddr,senderVill,senderSubDist,senderCity,senderProv,senderCountry,senderPosCode,
								senderEmail,senderPhone,receiverName,receiverAddr,receiverVill,receiverSubDist,receiverCity,
								receiverProv,receiverCountry,receiverPosCode,receiverEmail,receiverPhone,weight,fee,feeTax,
								insurance,insuranceTax,itemValue,contentDesc;
								
								PETUGAS='9799878798';//htmlspecialchars($this->input->post('username',TRUE),ENT_QUOTES);
								serviceId=$("#kodepossip").val();
								senderName=$("#namasip").val();
								senderAddr=$("#alamatsip").val()+' '+$("#alamatpengirim").val();
								senderVill='-';
								senderSubDist='-';
								senderCity='-';//$("#kotapengirim").val();
								senderProv='-';
								senderCountry='-';
								senderPosCode=$("#kodepossip").val();
								senderEmail=$("#emailsip").val();
								senderPhone=$("#phonesip").val();
								 
								receiverName=$("#namasial").val();
								receiverAddr=$("#alamatsial").val()+' '+$("#alamatpenerima").val();
								receiverVill='-';
								receiverSubDist='-';
								receiverCity='-';//$("#kotapenerima").val();
								receiverProv='-';
								receiverCountry='-';
								receiverPosCode=$("#kodepossial").val();
								receiverPhone=$("#phonesial").val();
								
								receiverEmail=$("#emailsial").val();
								weight=$("#berat").val();
								itemValue=$("#nb").val();
								contentDesc='-';//$("#isikiriman").val();
							var message = ""; 
							//Loop through all checked CheckBoxes in GridView.
							$("#tabeltarif input[name=posradio]:checked").each(function () {
								var row = $(this).closest("tr")[0];
								serviceId=row.cells[1].innerHTML;
								fee=row.cells[3].innerHTML;
								feeTax=row.cells[4].innerHTML;
								insurance=row.cells[5].innerHTML;
								insuranceTax=row.cells[6].innerHTML;
							});
							
								$('#addposting').html('Sedang proses simpan..');
								$.ajax ({ 
										   url: '<?= base_url() ?>index.php/pickuporder/addposting',
										   type: "post",
										   dataType: "html",
										   async: true,
										   delay: 250,
										   data :{serviceId:serviceId,fee:fee,feeTax:feeTax,insurance:insurance,insuranceTax:insuranceTax,
													PETUGAS:PETUGAS,senderName:senderName,
													senderAddr:senderAddr,senderVill:senderVill,senderSubDist:senderSubDist,senderCity:senderCity,senderProv:senderProv,
													senderCountry:senderCountry,senderPosCode:senderPosCode,
													senderEmail:senderEmail,senderPhone:senderPhone,receiverName:receiverName,receiverAddr:receiverAddr,
													receiverVill:receiverVill,receiverSubDist:receiverSubDist,receiverCity:receiverCity,
													receiverProv:receiverProv,receiverCountry:receiverCountry,receiverPosCode:receiverPosCode,
													receiverEmail:receiverEmail,receiverPhone:receiverPhone,weight:weight,
													itemValue:itemValue,
													contentDesc:contentDesc
										   },
										   success: function (response) {
											   
											  $('#idorder').html(response);
											  $('#addposting').html('Order');
											  $('#sidorder').show();
											  
										   },
										   cache: false
									  });
									  
									 
								
			});

	for(B=1; B<=1; B++){
		BarisBaru();
	}

	$('#id_pelanggan').change(function(){
		if($(this).val() !== '')
		{
			$.ajax({
				url: "<?php echo site_url('penjualan/ajax-pelanggan'); ?>",
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
		url: "<?php echo site_url('penjualan/ajax-kode'); ?>",
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
		BarisBaru();
		return false;
	}

	if(charCode == 119) //F8
	{
		$('#UangCash').focus();
		return false;
	}

	if(charCode == 120) //F9
	{
		CetakStruk();
		return false;
	}

	if(charCode == 121) //F10
	{
		$('.modal-dialog').removeClass('modal-lg');
		$('.modal-dialog').addClass('modal-sm');
		$('#ModalHeader').html('Konfirmasi');
		$('#ModalContent').html("Apakah anda yakin ingin menyimpan transaksi ini ?");
		$('#ModalFooter').html("<button type='button' class='btn btn-primary' id='SimpanTransaksi'>Ya, saya yakin</button><button type='button' class='btn btn-default' data-dismiss='modal'>Batal</button>");
		$('#ModalGue').modal('show');

		setTimeout(function(){ 
	   		$('button#SimpanTransaksi').focus();
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
		url: "<?php echo site_url('penjualan/transaksi'); ?>",
		type: "POST",
		cache: false,
		data: FormData,
		dataType:'json',
		success: function(data){
			if(data.status == 1)
			{
				alert(data.pesan);
				window.location.href="<?php echo site_url('penjualan/transaksi'); ?>";
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
	if($('#TotalBayarHidden').val() > 0)
	{
		if($('#UangCash').val() !== '')
		{
			var FormData = "nomor_nota="+encodeURI($('#nomor_nota').val());
			FormData += "&tanggal="+encodeURI($('#tanggal').val());
			FormData += "&id_kasir="+$('#id_kasir').val();
			FormData += "&id_pelanggan="+$('#id_pelanggan').val();
			FormData += "&" + $('#TabelTransaksi tbody input').serialize();
			FormData += "&cash="+$('#UangCash').val();
			FormData += "&catatan="+encodeURI($('#catatan').val());
			FormData += "&grand_total="+$('#TotalBayarHidden').val();

			window.open("<?php echo site_url('penjualan/transaksi-cetak/?'); ?>" + FormData,'_blank');
		}
		else
		{
			$('.modal-dialog').removeClass('modal-lg');
			$('.modal-dialog').addClass('modal-sm');
			$('#ModalHeader').html('Oops !');
			$('#ModalContent').html('Harap masukan Total Bayar');
			$('#ModalFooter').html("<button type='button' class='btn btn-primary' data-dismiss='modal' autofocus>Ok</button>");
			$('#ModalGue').modal('show');
		}
	}
	else
	{
		$('.modal-dialog').removeClass('modal-lg');
		$('.modal-dialog').addClass('modal-sm');
		$('#ModalHeader').html('Oops !');
		$('#ModalContent').html('Harap pilih barang terlebih dahulu');
		$('#ModalFooter').html("<button type='button' class='btn btn-primary' data-dismiss='modal' autofocus>Ok</button>");
		$('#ModalGue').modal('show');

	}
}
</script>

<?php $this->load->view('include/footer'); ?>