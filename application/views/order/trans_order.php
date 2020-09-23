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
/*
$level 		= $this->session->userdata('ap_level');
$readonly	= '';
$disabled	= '';
if($level !== 'admin')
{
	$readonly	= 'readonly';
	$disabled	= 'disabled';
}
*/
//ob_start();
//session_start();
$level 		= $this->session->userdata('ses_level');
?>

<div class="container-fluid">
	<div class="panel panel-default">
		<div class="panel-body">

			<div class='row'>
			<div class='col-sm-2'>
			</div>
				<div class='col-sm-8'>
					<div class="panel panel-default">
						<div class="panel-heading"><span class='glyphicon glyphicon-user'></span>&nbsp;Pengirim</div>
						<div class="panel-body">
						

					
							<div class="form-horizontal">
							
							<div class="form-group">
									<label class="col-sm-3 control-label">Nama</label>
									<div class="col-sm-9">
									<div class="input-group">
										<div class="input-group-addon">
											<span class='glyphicon glyphicon-user'></span>
										</div>
										<input type="text" class="form-control" id="namasip" name="namasip"  autofocus="autofocus" placeholder="Nama" />
										
									</div>
									</div>
							</div>
							<div class="form-group">
									<label class="col-sm-3 control-label">Alamat</label>
									<div class="col-sm-9">
									<div class="input-group">
										<div class="input-group-addon">
											<span class='glyphicon glyphicon-map-marker'></span>
										</div>
										<input type="text" class="form-control" id="alamatsip" name="alamatsip" placeholder="Alamat (Jalan, gang,rt/rw) " />
										
									</div>
									</div>
							</div>
							<div class="form-group">
									<label class="col-sm-3 control-label"></label>
									<div class="col-sm-9">
									<div class="input-group">
										<div class="input-group-addon">
											<span class='glyphicon glyphicon-map-marker'></span>
										</div>
										<select id='kodepospengirim' class="js-example-basic-single js-states form-control input-sm" placeholder="Kabupaten/kecamatan/kelurahan" data-width="100%"></select>
										
									</div>
									</div>
							</div>
			
								
								
							<div class="form-group">
									<label class="col-sm-3 control-label">email</label>
									<div class="col-sm-9">
									<div class="input-group">
										<div class="input-group-addon">
											<span class='glyphicon glyphicon-envelope'></span>
										</div>
										<input type="text" name="emailsip" id="emailsip" class="form-control input-sm" placeholder="email" />
										
									</div>
									</div>
							</div>
							<div class="form-group">
									<label class="col-sm-3 control-label">Telp.</label>
									<div class="col-sm-9">
									<div class="input-group">
										<div class="input-group-addon">
											<span class='glyphicon glyphicon-phone'></span>
										</div>
										<input type="text" id="phonesip" name="phonesip" class="form-control input-sm" placeholder="08123456789" />
										
									</div>
									</div>
							</div>
							<div class="form-group" style="display:none">
									<label class="col-sm-3 control-label"></label>
									<div class="col-sm-9">
										<textarea id="alamatpengirim" class="form-control " style="disabled:false" ></textarea>
										<input type="hidden" name="kodepossip" id="kodepossip"/>
									</div>
								</div>
									<!--
								<div class="form-group">
									<label class="col-sm-3 control-label">email </label>
									<div class="col-sm-9">
										<input type="text" name="emailsip" id="emailsip" class="form-control input-sm" placeholder="email" />
									</div>
								</div>
								
								
								<div class="form-group">
									<label class="col-sm-3 control-label">No. Telp </label>
									<div class="col-sm-9">
										<input type="text" id="phonesip" name="phonesip" class="form-control input-sm" placeholder="08123456789" />
									</div>
								</div>
								-->
								
								
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
				<div class='col-sm-2'>
			</div>
			</div>	
			<div class='row'>	
				<div class='col-sm-2'>
				</div>
				<div class='col-sm-8'>
				<div class="panel panel-default">
						<div class="panel-heading"><i class='fa fa-user'></i>&nbsp;Penerima</div>
						<div class="panel-body">
							<div class="form-horizontal">
							<div class="form-group">
									<label class="col-sm-3 control-label">Nama</label>
									<div class="col-sm-9">
									<div class="input-group">
										<div class="input-group-addon">
											<span class='glyphicon glyphicon-user'></span>
										</div>
										<input type="text" class='form-control input-sm' id="namasial" name="namasial" placeholder="Nama" />
										
									</div>
									</div>
							</div>
							<div class="form-group">
									<label class="col-sm-3 control-label">Alamat</label>
									<div class="col-sm-9">
									<div class="input-group">
										<div class="input-group-addon">
											<span class='glyphicon glyphicon-map-marker'></span>
										</div>
										<input type="text" class='form-control input-sm' id="alamatsial" name="alamatsial" placeholder="Alamat (jalan, gang, rt/rw)" />
									</div>
									</div>
							</div>
							<div class="form-group">
									<label class="col-sm-3 control-label"></label>
									<div class="col-sm-9">
									<div class="input-group">
										<div class="input-group-addon">
											<span class='glyphicon glyphicon-map-marker'></span>
										</div>
										<select id='kodepospenerima' class="js-example-basic-single js-states form-control input-sm" placeholder="Kabupaten/kecamatan/kelurahan" data-width="100%"></select>
										
										
									</div>
									</div>
							</div>
			
								
								
							<div class="form-group">
									<label class="col-sm-3 control-label">email</label>
									<div class="col-sm-9">
									<div class="input-group">
										<div class="input-group-addon">
											<span class='glyphicon glyphicon-envelope'></span>
										</div>
										<input type="text" name="emailsial" id="emailsial" class="form-control input-sm" placeholder="email" />
										
									</div>
									</div>
							</div>
							<div class="form-group">
									<label class="col-sm-3 control-label">Telp.</label>
									<div class="col-sm-9">
									<div class="input-group">
										<div class="input-group-addon">
											<span class='glyphicon glyphicon-phone'></span>
										</div>
										
										<input type="text" id="phonesial" name="phonesial" class="form-control input-sm" placeholder="08123456789" />
										
									</div>
									</div>
							</div>
							<div class="form-group" style="display:none">
									<label class="col-sm-3 control-label"></label>
									<div class="col-sm-9">
										<textarea id="alamatpenerima" class="form-control " style="disabled" ></textarea>
										<input type="hidden" name="kodepossial" id="kodepossial"/>
									</div>
								</div>
							</div>

						</div>
					</div>
					<div class='col-sm-2'>
					</div>
				</div>
			</div>
			<div class='row'>	
				<div class='col-sm-2'>
				</div>
				<div class='col-sm-8'>
					<div class="panel panel-default">
						<div class="panel-heading"><i class='fa fa-dropbox'></i> Informasi Kiriman</div>
						
						<div class="panel-body">
							<div class="col-sm-12" >
							<div class="form-horizontal">
								<!-- 
								<div class="form-group">
									<label class="col-sm-5 control-label">Berat (Gram.) </label>
									<div class="col-sm-7">
										<input type="text" id="berat" name="berat" placeholder="Berat (gram)" class="form-control" value="0"></input>
									</div>
								</div> -->
								<div class="form-group">
									<label class="col-sm-3 control-label">Berat (Gram.)</label>
									<div class="col-sm-9">
									<div class="input-group">
										<div class="input-group-addon">
											<span class='glyphicon glyphicon-scale'></span>
										</div>
										<input type="text" name="berat" id="berat" class="form-control input-sm" placeholder="Berat (gram)" />
										
									</div>
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-sm-3 control-label">Harga Barang (Rp.)</label>
									<div class="col-sm-9">
									<div class="input-group">
										<div class="input-group-addon">
											<span class='glyphicon glyphicon-list-alt'></span>
										</div>
										<input type="text" name="nb" id="nb" class="form-control input-sm" placeholder="Harga Barang (Rp.)" />
										
									</div>
									</div>
								</div>
								<!--
								<div class="form-group">
									<label class="col-sm-5 control-label">Harga Barang (Rp.) </label>
									<div class="col-sm-7">
										<input type="text" id="nb" name="nb" placeholder="Harga Barang (Rp.)" class="form-control" value="0"></input>
									</div>
								</div>
								-->
								<div class="form-group">
									<label class="col-sm-3 control-label">Pilihan COD</label>
									<div class="col-sm-9">
									<div class="input-group">
										<div class="input-group-addon">
											<span class='glyphicon glyphicon-tag'></span>
										</div>
										
										<select id='jeniscod' class="js-example-basic-single js-states form-control input-sm" placeholder=" - pilih COD / Non COD"  data-width="100%">
											<option value='0'> Non COD </option>
											<option value='1'> COD </option>
										
										</select>
									</div>
									</div>
								</div>
								<!--
								<div class="form-group">
									<label class="col-sm-5 control-label">Pilihan COD </label>
									<div class="col-sm-7">
										<select id='jeniscod' class="js-example-basic-single js-states form-control input-sm" placeholder=" - pilih COD / Non COD"  data-width="100%">
											<option value='0'> Non COD </option>
											<option value='1'> COD </option>
										
										</select>
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-sm-5 control-label">Isi Kiriman </label>
									<div class="col-sm-7">
										<textarea id="isikiriman" class="form-control input-sm" rows="5" ></textarea>
									</div>
								</div> -->
								<div class="form-group">
									<label class="col-sm-3 control-label">Isi Kiriman </label>
									<div class="col-sm-9">
									<div class="input-group">
										<div class="input-group-addon">
											<span class='glyphicon glyphicon-file'></span>
										</div>
										<textarea id="isikiriman" class="form-control input-sm" rows="5" ></textarea>
										
									</div>
									</div>
								</div>
								<!-- <div class="form-group"
									<label class="col-sm-5 control-label">Harga Barang (Rp.) </label>
									<div class="col-sm-7">
										<input type="text" id="nb" name="nb" placeholder="Harga Barang" class="form-control" value="0"></input>
									</div>
								</div>
								
								
								<div class="form-group">
									<label class="col-sm-5 control-label">Isi Kiriman</label>
									<div class="col-sm-7">
										<textarea id="isikiriman" class="form-control input-sm" rows="10" ></textarea>
										
									</div>
								</div>
								glyphicon-transfer
								-->
								<div class="form-group">
								
									<label class="col-sm-8 control-label"></label>
									<div class="col-sm-4">
										
										
										
										<button type='button' class='btn btn-warning btn-block' id='cekongkir'>
											 <span class='glyphicon glyphicon-ok-sign'></span> &nbsp;Cek Tarif
										</button>
										
										
									</div>
								</div>
							</div>

						</div>
						<!-- estimasi tarif kiriman-->
						<!-- <div class="col-sm-6" name="estimasiongkir" id="estimasiongkir" style="display:none"> -->
						<div class="col-sm-12" name="estimasiongkir" id="estimasiongkir" style="display:none">
							<div class="form-horizontal">
								<div class="panel panel-success" >
											<div class="panel-heading" ><i class='fa fa-info'></i> Estimasi Tarif Kiriman</div>
											<div class="panel-body">
												<div class="form-horizontal">
													<div id="tampiltarif"> 	
																					
													</div>	
													<div class="form-group">
														<label class="col-sm-8 control-label"></label>
														<div class="col-sm-4">
															<button type='button' class='btn btn-warning btn-block' id='addposting'>
																 Simpan
															</button>
															<textarea id="detail_kiriman" class="form-control " style="display:none" type="hidden" ></textarea>
														</div>
													</div>	
														
														
													<div class="col-sm-12" name="cetaklabelalamat" id="cetaklabelalamat" style="display:none">				
														<div class="form-group">
															<!-- <label class="col-sm-3 control-label">Pilihan COD</label> -->
															<div class="col-sm-12 control-label alert alert-info">
																<div class="input-group">
																	<center><h2>ID ORDER : <label  id="idorder" name="idorder" disabled ></h2></label></center>
																</div>
															</div>
														</div>
														<div class="form-group">
																<label class="col-sm-8 control-label">Cetak Label Alamat ?</label>
																<div class="col-sm-4">
																		<button type="submit" class="btn btn-success" name="btn_cetak_label" id="btn_cetak_label">Ya</button>
																		<button type="submit" class="btn btn-warning" name="btn_nanti_saja" id="btn_cetak_label">Nanti</button>
																
																</div>
														</div>	
														<!--
														<div class="col-sm-12 control-label alert alert-info">
															<center><h2>ID ORDER : <label  id="idorder" name="idorder" disabled ></h2></label></center>
															 
															<textarea id="detail_kiriman" class="form-control " style="display:none" type="hidden" ></textarea>
															
														</div>
														<div class="form-group">
															<label class="col-sm-4 control-label">Cetak Label Alamat ?</label>
															<div class="col-sm-4" style="align:right">
																<button type="submit" class="btn btn-success" name="btn_cetak_label" id="btn_cetak_label">Ya</button></a>
															</div>
															<div class="col-sm-4" style="align:right">
																<button type="submit" class="btn btn-danger" name="btn_nanti_saja" id="btn_cetak_label">Nanti</button></a>
															</div>
														</div>
														-->
													</div>				
														
														
														
														
														
												</div>	
											</div>	
								</div>
							</div>	
						</div>
					</div>
					
				</div>
				<div class='col-sm-2'>
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
		placeholder: ' Alamat (kota / kab. / kec / kel.)',
        minimumInputLength: 6,
         ajax: { 
           //url: '<?= base_url() ?>index.php/getKodepos/kodepos',
		   url: '<?= base_url() ?>index.php/getkodepos/kodepos_api',
           type: "post",
           dataType: 'json',
           delay: 100,
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
		placeholder: ' Alamat (kota / kab. / kec / kel.)',
        minimumInputLength: 6,
         ajax: { 
           url: '<?= base_url() ?>index.php/getkodepos/kodepos_api',
           type: "post",
           dataType: 'json',
           delay: 100,
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
	//fungsi cetak label
	$('#btn_cetak_label').on('click', function (evt) {
			
			//var idorder=$('#idordernya').val();
			var detail_kiriman=$('#detail_kiriman').val();
			//pisahlagi = detail_kiriman.split("~");
			var idorder=detail_kiriman;
			//var idorder=document.getElementById("idorder");
			
			//alert (idorder);
			$.ajax({
						url: "<?php echo base_url('Label_barcode/lewati') ?>", 
						type: "post",
						data : {idorder:idorder},
						dataType: "html",
						success: function( response ) {
															//alert (response);
									var FormData = "idorder="+encodeURI(idorder);
									//FormData += "&pengirim="+encodeURI(response.response_data3);
									//FormData += "&penerima="+response.response_data4;
									window.open("<?php echo site_url('label_barcode/cetak_order/?'); ?>" + FormData,'_blank');
															
														}
												})
	});	
	//end of cetak label
	//fungsi reset layar
	$('#btn_nanti_saja').on('click', function (evt) {
			$('#namasip').val('');
			$('#namasip').focus();
			
			
	});	
	//end of reset layar

	$("#addposting").click(function () {
							var PETUGAS,serviceId,senderName,
								senderAddr,senderVill,senderSubDist,senderCity,senderProv,senderCountry,senderPosCode,
								senderEmail,senderPhone,receiverName,receiverAddr,receiverVill,receiverSubDist,receiverCity,
								receiverProv,receiverCountry,receiverPosCode,receiverEmail,receiverPhone,weight,fee,feeTax,
								insurance,insuranceTax,itemValue,contentDesc,COD;
								COD = $("#jeniscod").val();
								//PETUGAS='9799878798';//htmlspecialchars($this->input->post('username',TRUE),ENT_QUOTES);
								PETUGAS=<?php $this->session->userdata('ses_id_user'); ?>//htmlspecialchars($this->input->post('username',TRUE),ENT_QUOTES);
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
								contentDesc=$("#isikiriman").val();//$("#isikiriman").val();
								
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
										   url: '<?= base_url() ?>pickuporder/insorder',
										   type: "post",
										   dataType: "html",
										   async: true,
										   delay: 250,
										   data :{COD:COD,serviceId:serviceId,fee:fee,feeTax:feeTax,insurance:insurance,insuranceTax:insuranceTax,
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
											   
											    if (response == '') { alert ('Gagal simpan order booking!');$('#addposting').html('Simpan');
												} else {
												
											  
											   $('#detail_kiriman').html(response);
											   //alert (response);
											  //$('#idorder').html(response);
											  var detail_kiriman, pisahlagi,noidorder,pengirim, penerima;
											  detail_kiriman=$('#detail_kiriman').val();
											  
											  
											  pisahlagi = detail_kiriman.split("~");
											  noidorder=pisahlagi[0];
											  pengirim=pisahlagi[1];
											  penerima=pisahlagi[2];
											  
											  $('#idorder').html(noidorder);
											  $('#addposting').html('Simpan');
											  $('#idorder').show();
											  $('#cetaklabelalamat').show(); 
												}
											  //var FormData = "idorder="+encodeURI(noidorder);
											  //window.open("<?php echo site_url('label_barcode/cetak_order/?'); ?>" + FormData,'_blank');
										   },
										   cache: false
									  });
									  
									 
								
			});

	/*
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
	*/
});
/*
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
*/
</script>
<script>
var input = document.getElementById("namasip");
input.addEventListener("keyup", function(event) {
    if (event.keyCode === 13) {
        event.preventDefault();
        document.getElementById("namasip").click();
		//alert ("isi alamat");
		document.getElementById("alamatsip").focus();
		
    }
});

var input1 = document.getElementById("alamatsip");
input1.addEventListener("keyup", function(event) {
    if (event.keyCode === 13) {
        event.preventDefault();
        document.getElementById("kodepospengirim").click();
		//alert ("isi kecamatan/kelurahan");
		document.getElementById("kodepospengirim").focus();
		
    }
});

function cetakLabel()
{
			var IdOrder;
			IdOrder='';
			IdOrder=$("#idorder").val();
			//$('#tampilOrder').hide();
			$.ajax ({ 
					   url: '<?= base_url() ?>index.php/label_barcode/cetakOrdernya',
					   type: "post",
					   //dataType: 'html',
					   dataType: 'json',
					   delay: 250,
					 //  data :{kodepossip:kodepossip,kodepossial:kodepossial,berat:berat,anb:anb},
					   data :{IdOrder:IdOrder},
					   success: function (response) {
						  
						   if(response.rc_mess==00){
								$('#pengirim').html(response.response_data3);
								 $('#penerima').html(response.response_data4);
								 $('#tarif').html(response.datatarif);
								 $('#Produk').html(response.produk);
								 $('#TotalBayar').html(response.total);
								 $('#beratkir').html(response.berat);
								 $('#beratkiriman').html(response.berat);
								 $('#nilaiBarang').html(response.nilaibarang);
								 
								 $('#data2').html(response.par2);
								 $('#data3').html(response.par3);
								 $('#data4').html(response.par4);
								 
								 $('#Kdsip').html(response.par5);
								 $('#Kdsial').html(response.par6);
								 
								$('#ResponseInput').html('');	 
								var FormData = "barcode="+encodeURI(IdOrder);
								
									FormData += "&pengirim="+encodeURI(response.response_data3);
									FormData += "&penerima="+response.response_data4;
									
									window.open("<?php echo site_url('label_barcode/order_cetak/?'); ?>" + FormData,'_blank');
									//var almt="<?php echo site_url('label_barcode/order_cetak/?'); ?>"+ FormData;
									// alert(almt);

						   }else{
							   
						        $('#ResponseInput').html(response.desk_mess);
						  
						   }
					  },
					   cache: true
				  });
		
	
}

</script>
<!--
<script>  
i = 0;  
$(document).ready(function(){  
    $("input").keypress(function(){  
        $("span").text (i += 1);  
    });  
});  
</script> 
-->
<?php $this->load->view('include/footer'); ?>