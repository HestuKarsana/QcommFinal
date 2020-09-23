<?php 
ob_start();
//session_start();
$this->load->view('include/header'); ?>

<div class="container-fluid">
	<div class="login-panel">
		<center>
			<img src="<?php echo config_item('img'); ?>logo.png" />
		</center>
		<div class='panel panel-default'>
			<div class='panel-body'>
				<!-- <form class="form-signin" action="<?php //echo base_url().'index.php/Secure/auth'?>" method="post"> -->
					<div class="form-group">
						<label>Login sebagai :</label>
						<div class="input-group">
							<div class="input-group-addon">
								<span class='glyphicon glyphicon-user'></span>
							</div>
										<select id='jenislogin' name='jenislogin' class="js-example-basic-single js-states form-control input-sm" placeholder=" - pebisnis online / Agenpos"  data-width="100%" onchange="isiPilihan()">
											<option value='01'> Agenpos </option>
											<option value='02'> Pebisnis Online </option>
										
										</select>							
						</div>
					</div>
					<p>
					<hr style="border-top: 1px dotted silver">
																			<p>
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
						<label id="gantinama">Password</label>
						<div class="input-group">
							<div class="input-group-addon">
								<span class='glyphicon glyphicon-lock'></span>
							</div>
							<input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
							
						</div>
					</div>
				<form class="form-signin" action="<?php echo base_url().'index.php/Secure/auth'?>" method="post">	
					<div id=""></div>
					<button type="submit" class="btn btn-primary">
						<span class='glyphicon glyphicon-log-in' aria-hidden="true"></span> Login
					</button>
					<button type="reset" class="btn btn-default" id='ResetData'>Reset</button>
				</form>

				<?php if (strlen($this->session->flashdata('msg'))>0) { ?>
				<div id='ResponseInput' class="control-label alert alert-danger" style="display:show">
					<center><?php echo $this->session->flashdata('msg'); 
					//echo $_SESSION['msg'];?>
    

					</center>
				</div>
				<?php }; ?>
				<!-- <div id='ResponseInput'></div>-->
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
function isiPilihan() {
  var x = document.getElementById("jenislogin").value;
  if (x=='01'){
	document.getElementById("gantinama").innerHTML = "Password";  
  } else if (x=='02'){
	document.getElementById("gantinama").innerHTML = "PIN / Token";  
  } 
  
}
</script>
<script>
$(function(){
	//------------------------Proses Login Ajax-------------------------//
	$('#FormLogin').submit(function(e){
		e.preventDefault();
		$.ajax({
			url: $(this).attr('action'),
			type: "POST",
			cache: false,
			data: $(this).serialize(),
			dataType:'json',
			success: function(json){
				//response dari json_encode di controller

				if(json.status == 1){ window.location.href = json.url_home; }
				if(json.status == 0){ $('#ResponseInput').html(json.pesan); }
				if(json.status == 2){
					$('#ResponseInput').html(json.pesan);
					$('#InputPassword').val('');
				}
			}
		});
	});

	//-----------------------Ketika Tombol Reset Diklik-----------------//
	$('#ResetData').click(function(){
		$('#ResponseInput').html('');
		$('#ResponseInput').hide();
		
	});
});

setTimeout(function() {
  $('#ResponseInput').fadeOut('fast');
}, 30000); 
</script>

<?php $this->load->view('include/footer'); ?>


