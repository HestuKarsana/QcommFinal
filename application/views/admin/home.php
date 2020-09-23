<?php $this->load->view('include/header'); ?>
<?php $this->load->view('include/navadmin'); ?>
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
	<div class="panel panel-warning">
		<div class="panel-body">

			<div class='row'>
				<div class='col-sm-12'>
					
					
					
					<div class="panel panel-defaut" id='dashboardadmin'>
						<div class="panel-heading"><i class='fa fa-home'></i> DASHBOARD ADMIN <?php 
								echo " [ ".date('d-m-Y H:i:s')." ]";
							?></div>
						<div class="panel-body">
						    <img alt="<?php echo config_item('web_title'); ?>" src="<?php echo config_item('img'); ?>logopos.jpg">
							
							
						</div>
					</div>
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


function check_int(evt) {
	var charCode = ( evt.which ) ? evt.which : event.keyCode;
	return ( charCode >= 48 && charCode <= 57 || charCode == 8 );
}




</script>
<?php $this->load->view('include/footer'); ?>