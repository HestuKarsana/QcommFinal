<?php $this->load->view('include/header'); 

?>

<div class="container-fluid">
	<div class="login-panel">
		<center>
			<img src="<?php echo config_item('img'); ?>logo.png" />
		</center>
		<div class='panel panel-default'>
			<div class='panel-body'>
				<?php //echo form_open('secure', array('id' => 'FormLogin')); ?>
				<!-- <form id="login_form" method="post" action="javascript:void(0)"> -->
				<div class="form-group">
						<label>Login sebagai :</label>
						<div class="input-group">
							<div class="input-group-addon">
								<span class='glyphicon glyphicon-user'></span>
							</div>
										<select id='jenislogin' name='jenislogin' class="js-example-basic-single js-states form-control input-sm" placeholder=" - pebisnis online / Agenpos"  data-width="100%" >
											<option value='01'> Agenpos </option>
											<option value='02'> Pebisnis Online </option>
										</select>							
						</div>
					</div>
					<p>
					<hr style="border-top: 1px dotted silver">
				<div id='form_loginagen' style='display:block'>
							<div class="form-group">
								<label>Username</label>
								<div class="input-group">
									<div class="input-group-addon">
										<span class='glyphicon glyphicon-user'></span>
									</div>
									<input type="text" id="username" name="username" class="form-control" placeholder="Username" autocomplete=off required autofocus>
									
								</div>
							</div>
							<div class="form-group">
								<label>Password</label>
								<div class="input-group">
									<div class="input-group-addon">
										<span class='glyphicon glyphicon-lock'></span>
									</div>
									<input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
									
								</div>
							</div>
					</div>	
					<div id='form_loginpebisol' style='display:none'>
							<div class="form-group">
								<label>Username</label>
								<div class="input-group">
									<div class="input-group-addon">
										<span class='glyphicon glyphicon-user'></span>
									</div>
									<input type="text" id="usernamepebisol" name="usernamepebisol" class="form-control" placeholder="Username" autocomplete=off required autofocus>
									
								</div>
							</div>
							<div class="form-group">
								<label>PIN / TOKEN</label>
								<div class="input-group">
									<div class="input-group-addon">
										<span class='glyphicon glyphicon-lock'></span>
									</div>
									<input type="text" id="tokennya" name="tokennya" class="form-control" placeholder="PIN/TOKEN" required>
									
								</div>
							</div>
					</div>	
					<div id="parlogin" style="display:none"></div>
					<button type="submit" class="btn btn-primary" name="btn_login" id="btn_login">
						<span class='glyphicon glyphicon-log-in' aria-hidden="true"></span> Login
					</button>
					<button type="reset" class="btn btn-default" id='ResetData'>Reset</button>
				<?php //echo form_close(); ?>
					<!-- </form>   -->

				<div id='ResponseInput'></div>
			</div>
		</div>
		<p class='footer'><?php echo config_item('web_footer'); ?></p>
	</div>
</div>
<!--
<hr style='border-color:#999; border-style:dashed; '/>
<div class='container'>
<center>
LIST AKSES<br /><br />
<div class='row'>
<div class='col-sm-3'><b>Admin</b> <br />Username : admin<br />Password : admin</div>
<div class='col-sm-3'><b>Kasir</b> <br />Username : kasir<br />Password : kasir</div>
<div class='col-sm-3'><b>Gudang</b> <br />Username : jaka<br />Password : jaka</div>
<div class='col-sm-3'><b>Keuangan</b> <br />Username : joko<br />Password : joko</div>
</div>
</center>
</div>
-->
<script>
$('#btn_login').on('click', function (evt) {
			var username,password;
			
			var jnslogin=$('#jenislogin').val();
			if (jnslogin=='01') {
				username=$('#username').val();
				password=$('#password').val();
			} else {
				username=$('#usernamepebisol').val();
				password=$('#tokennya').val();
				
			}
			var sesslog=username+'|'+password+'|'+jnslogin;
			//alert (sesslog);
			$('#btn_login').html('cek login ...');
			$.ajax ({ 
					   url: '<?= base_url() ?>index.php/Ajax/cek',
					   type: "post",
					   dataType: 'text',
					   delay: 250,
					   data :{sesslog:sesslog},
					   
					   success: function (response) {
						 // alert(response);
						  var pess = response;
						   pesannya = pess.split("|");
						   kodepesan=pesannya[0];
						   deskpesan=pesannya[1];
						   //alert('kd pesan '+kodepesan +' deskpesan'+deskpesan);
						   if (kodepesan=='99'){
							   	$('#btn_login').html('Login'); 
								$('.modal-dialog').removeClass('modal-lg');
								$('.modal-dialog').addClass('modal-sm');
								$('#ModalHeader').html('Error');
								$('#ModalContent').html(deskpesan);
								$('#ModalFooter').html("<button type='button' class='btn btn-primary' data-dismiss='modal' autofocus>Ok</button>");
								$('#ModalGue').modal('show');
								$('#jenislogin').focus();
								//window.open("<?php echo site_url(''); ?>",'_self');
						   } else {
							   //window.open("<?php echo site_url('order'); ?>",'_self');
									alert('Login '+deskpesan);
								   if (deskpesan=='01') {
									   //alert('Login Agen');
														//redirect('qcomm');
										window.open("<?php echo site_url('qcomm'); ?>",'_self');
														
													} else {
														//alert('Login Pebisol');
														//redirect('order');
														window.open("<?php echo site_url('order'); ?>",'_self');
													}
													
							   
							   
						   }
						   
						  
					   },
					   cache: true
				  });
			
	
	});

  //-----------------------Ketika Pilihan Login Diklik-----------------//
	$('#jenislogin').change(function(){
		//alert('ok dech');
		var jenislogin=$('#jenislogin').val();
		if (jenislogin=='01'){
			$('#form_loginagen').show();
			$('#form_loginpebisol').hide();
			
		} else if (jenislogin=='02'){
			$('#form_loginagen').hide();
			$('#form_loginpebisol').show();
		}  
		/*
		var jenislogin=$('#jenislogin').val();
		alert(jenislogin);
		if (jenislogin=='01'){
			alert('agen');
			$('#form_loginagen').show();
			$('#form_loginpebisol').hide();
		} else (jenislogin=='02'){
			alert('pebisol');
			$('#form_loginagen').hide();
			$('#form_loginpebisol').show();
			
		} 
		*/
		
		//$('#ResponseInput').html('');
		//$('#ResponseInput').hide();
		
	});
//-----------------------Ketika Tombol Reset Diklik-----------------//
	$('#ResetData').click(function(){
		$('#form_loginagen').show();
		$('#form_loginpebisol').hide();
		$('#username').val('');
		$('#username').focus();
		$('#password').val('');
		
		
		
	});
</script>



<?php $this->load->view('include/footer'); ?>


